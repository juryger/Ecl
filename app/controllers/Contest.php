<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 9/09/2016
 * Time: 12:50 PM
 */

require_once('../app/dal/Db.php');
require_once('../app/dal/CompetitionMapper.php');

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

        $dbStage = ''.DB_STAGE;
        $dbh = new $dbStage;

        try{
            $compMapper = new CompetitionMapper($dbh);

            $defaultCompetition = $compMapper->FindByCompId(1);
            if (!$defaultCompetition)
            {
                throw new Exception("Competition is not found in database by requested id: " . "1");
            }
        }
        catch(MySqlException $e) {
            //ECL\WebDiagnostics\Console::Error('Find competition by id is failed with error: ' . print_r($e, true));
            print_r($e);
            return;
        }
        finally{
            $dbh->Close();
        }

        $contestInfo->competition = $defaultCompetition;
        $contestInfo->isSubmitted = false;

        ECL\WebDiagnostics\Console::Log('Creating view for Contest');
        $this->CreateView('contest/index', ['contestInfo' => $contestInfo]);
    }

    public function Submit($data = [])
    {
        ECL\WebDiagnostics\Console::Log('contest/submit');

        ECL\WebDiagnostics\Console::Log('url: '.$_GET['url']);
        ECL\WebDiagnostics\Console::Log('school value: '.$_POST['schoolName']);
        ECL\WebDiagnostics\Console::Log('submit command: '.$_POST['submitCompForm']);

        ECL\WebDiagnostics\Console::Log('Creating model for Contest');
        $contestInfo = $this->CreateModel('ContestModel');
        $contestInfo->isSubmitted = true;
        $contestInfo->submissionMessage = "Congratulations! (should come from Db)";

        ECL\WebDiagnostics\Console::Log('Creating view for Contest');
        $this->CreateView('contest/index', ['contestInfo' => $contestInfo]);
    }
}