<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 8/10/2016
 * Time: 8:47 PM
 */

require_once('../app/models/ProposedAnswerModel.php');

/**
 * Implement DataMapper pattern for ProposedAnswerModel
 * see PEAA, http://martinfowler.com/eaaCatalog/dataMapper.html
 */
class ProposedAnswerMapper
{
    private $db;

    /**
     * Constructor.
     * @param mixed $db <p>database connection</p>
     */
    public function __construct($db = false)
    {
        if (!$db) {
            $dbStage = ''.DB_STAGE;
            $this->db = new $dbStage;
        }
        else {
            $this->db = $db;
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
        $answerList = $this->db->Prepare($query)->Execute($questionId)->FetchAllAssoc();

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

    /**
     * Return required answer from database.
     * @param int $answerId <p>answer identifier</p>
     * @return ProposedAnswerModel required answer
     */
    public function GetAnswer($answerId)
    {
        $query = "SELECT answerText, isCorrect, questionId FROM proposed_answer WHERE answerId = :1";
        $data = $this->db->Prepare($query)->Execute($answerId)->FetchAssoc();

        if(!$data) {
            return false;
        }

        return new ProposedAnswerModel(
            $answerId,
            $data['questionId'],
            $data['answerText'],
            $data['isCorrect']);
    }

}