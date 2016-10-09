<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 8/10/2016
 * Time: 4:06 PM
 */

require_once('../app/models/QuestionModel.php');

/**
 * Implement DataMapper pattern for QuestionModel
 * see PEAA, http://martinfowler.com/eaaCatalog/dataMapper.html
 */
class QuestionMapper
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
     * Return random question for required competition from Database.
     * @param int $cmpId <p>competition identifier</p>
     * @return QuestionModel random question
     */
    public function GetRandomQuestion($cmpId)
    {
        $query = "SELECT questionId, questionText FROM Question WHERE cmpId = :1 and questionId = :2";
        $data = $this->db->Prepare($query)->Execute($cmpId, rand(1, 5))->FetchAssoc();

        if(!$data) {
            return false;
        }

        return new QuestionModel(
            $data['questionId'],
            $cmpId,
            $data['questionText']);
    }

    /**
     * Return required question from database.
     * @param int $questionId <p>question identifier</p>
     * @return QuestionModel required question
     */
    public function GetQuestion($questionId)
    {
        $query = "SELECT cmpId, questionText FROM question WHERE questionId = :1";
        $data = $this->db->Prepare($query)->Execute($questionId)->FetchAssoc();

        if(!$data) {
            return false;
        }

        return new QuestionModel(
            $questionId,
            $data['cmpId'],
            $data['questionText']);
    }
}