<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 8/10/2016
 * Time: 8:47 PM
 */

require_once('../app/models/ProposedAnswerModel.php');

/**
 * Implement DataMapper pattern for SchoolModel
 * see PEAA, http://martinfowler.com/eaaCatalog/dataMapper.html
 */
class ProposedAnswerMapper
{
    private $dbh;

    /**
     * Constructor.
     * @param mixed $dbh <p>database handler</p>
     */
    public function __construct($dbh = false)
    {
        if (!$dbh) {
            $dbStage = ''.DB_STAGE;
            $this->dbh = new $dbStage;
        }
        else {
            $this->dbh = $dbh;
        }
    }

    /**
     * Return list of answers for required question from Database.
     * @param int $questionId <p>question identifier</p>
     * @return SchoolModel competition related with required id
     */
    public function GetAnswerList($questionId)
    {
        $query = "SELECT answerId, questionId, answerText, isCorrect FROM proposed_answer WHERE questionId = :1";
        $answerList = $this->dbh->Prepare($query)->Execute($questionId)->FetchAllAssoc();

        $result = [];
        foreach($answerList as $answer) {
            array_push($result,
                new ProposedAnswerModel(
                    $answer['answerId'],
                    $answer['questionId'],
                    $answer['answerText'],
                    $answer['isCorrect']));
        }

        return $result;
    }
}