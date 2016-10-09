<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 9/09/2016
 * Time: 12:50 PM
 */

require_once('../app/dal/Db.php');
require_once('../app/dal/CompetitionMapper.php');
require_once('../app/dal/SchoolMapper.php');
require_once('../app/dal/QuestionMapper.php');
require_once('../app/dal/CompetitorMapper.php');
require_once('../app/dal/ProposedAnswerMapper.php');
require_once('../app/dal/CompetitionResponseMapper.php');

/**
 * Controller for processing Content page commands
 */
class Contest extends Controller
{
    /**
     * Perform navigation on selected section at local navigation list of Home page
     * @param array $data <p>
     * Optional data for navigation
     * </p>
     * @return void
     * @throws Exception if default competition is not found in database
     */
    public function Index($data = [])
    {
        ECL\WebDiagnostics\Console::Log('contest/index');

        ECL\WebDiagnostics\Console::Log('Creating model for Contest');
        $contestInfo = $this->CreateModel('ContestModel');

        ECL\WebDiagnostics\Console::Log('Creating database connection');
        $dbStage = ''.DB_STAGE;
        $db = new $dbStage;

        try{
            // Get default competition
            $compMapper = new CompetitionMapper($db);
            $defaultCompetition = $compMapper->FindByCompId(1);
            if (!$defaultCompetition)
            {
                throw new Exception("Competition is not found in database by requested id: " . "1");
            }

            // Get school list
            $schoolMapper = new SchoolMapper($db);
            $schoolList = $schoolMapper->GetSchoolList();
            ECL\WebDiagnostics\Console::Log('ContestController/index, schoolList: ' . count($schoolList));

            // Get random question
            $questionMapper = new QuestionMapper($db);
            $randomQuestion = $questionMapper->GetRandomQuestion($defaultCompetition->cmpId);

            // Get question's answers
            $proposedAnswerMapper = new ProposedAnswerMapper($db);
            $answerList = $proposedAnswerMapper->GetAnswerList($randomQuestion->questionId);
        }
        catch(MySqlException $e) {
            print_r($e);
            return;
        }
        finally{
            $db->Close();
        }

        $contestInfo->competition = $defaultCompetition;
        $contestInfo->question = $randomQuestion;
        $contestInfo->proposedAnswers = $answerList;
        $contestInfo->schoolList = $schoolList;
        $contestInfo->isSubmitted = false;

        ECL\WebDiagnostics\Console::Log('Creating view for Contest');
        $this->CreateView('contest/index', ['contestInfo' => $contestInfo]);
    }

    public function Submit($data = [])
    {
        ECL\WebDiagnostics\Console::Log('contest/submit');

        $cmpId = $_POST['cmpId'];
        $classRoom = $_POST['classRoom'];
        $pupilEmail = $_POST['pupilEmail'];
        $schoolParams = explode(";", $_POST['schoolSelect']);
        $schoolId = $schoolParams[0];
        $schoolOriginalPhone = $schoolParams[1];
        $schoolPhone = $_POST['schoolPhone'];
        $questionId = $_POST['questionId'];
        $answerId = $_POST['selectedAnswerId'];

        ECL\WebDiagnostics\Console::Log('Competition ID: '.$cmpId);
        ECL\WebDiagnostics\Console::Log('School: '.$schoolId);
        ECL\WebDiagnostics\Console::Log('Class room: '.$classRoom);
        ECL\WebDiagnostics\Console::Log('Pupil email: '.$pupilEmail);
        ECL\WebDiagnostics\Console::Log('School phone number: '.$schoolPhone);
        ECL\WebDiagnostics\Console::Log('Question ID: '.$questionId);
        ECL\WebDiagnostics\Console::Log('Answer ID: '.$answerId);

        ECL\WebDiagnostics\Console::Log('Creating database connection');
        $dbStage = ''.DB_STAGE;
        $db = new $dbStage;

        try {
            // Get competition
            $compMapper = new CompetitionMapper($db);
            $competition = $compMapper->FindByCompId($cmpId);
            if (!$competition)
            {
                throw new Exception("Competition is not found in database by requested id: " . $cmpId);
            }

            // Create competitor
            $cmrMapper = new CompetitorMapper($db);
            $competitor = $cmrMapper->CreateCompetitor($schoolId, $pupilEmail, $classRoom);
            if (!$competitor) {
                throw new Exception("Failed to save competitor to database.");
            }

            // Create competition response
            $cmpResponseMapper = new CompetitionResponseMapper($db);
            $response = $cmpResponseMapper->CreateCompetitionResponse($cmpId, $competitor->cmrId, $answerId);

            $answer = null;
            $school = null;

            if (!$response->isAlreadyRegistered) {
                // Get question
                $questionMapper = new QuestionMapper($db);
                $question = $questionMapper->GetQuestion($questionId);

                // Get answer
                $proposedAnswerMapper = new ProposedAnswerMapper($db);
                $answer = $proposedAnswerMapper->GetAnswer($answerId);

                // Update school phone number
                if ($schoolOriginalPhone != $schoolPhone) {
                    $schoolMapper = new SchoolMapper($db);
                    $schoolMapper->UpdateSchoolPhoneNumber($schoolId, $schoolPhone);
                }

                // Get school
                $schoolMapper = new SchoolMapper($db);
                $school = $schoolMapper->GetSchool($schoolId);
            }
        }
        catch(MySqlException $e) {
            print_r($e);
            return;
        }
        finally{
            $db->Close();
        }

        ECL\WebDiagnostics\Console::Log('Creating model for Contest');
        $contestInfo = $this->CreateModel('ContestModel');
        $contestInfo->isSubmitted = true;
        $contestInfo->competition = $competition;
        $contestInfo->question = $question;
        $contestInfo->selectedAnswer = $answer;
        $contestInfo->selectedSchool = $school;
        $contestInfo->response = $response;
        $contestInfo->competitor = $competitor;

        ECL\WebDiagnostics\Console::Log('Creating view for Contest');
        $this->CreateView('contest/index', ['contestInfo' => $contestInfo]);
    }
}