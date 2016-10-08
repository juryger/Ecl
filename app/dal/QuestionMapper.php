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
     * Return random question for required competition from Database.
     * @param int $cmpId <p>competition identifier</p>
     * @return QuestionModel random question
     */
    public function GetRandomQuestion($cmpId)
    {
        $query = "SELECT questionId, questionText FROM Question WHERE cmpId = :1 and questionId = :2";
        $data = $this->dbh->Prepare($query)->Execute($cmpId, rand(1, 5))->FetchAssoc();

        if(!$data) {
            return false;
        }

        return new QuestionModel(
            $data['questionId'],
            $cmpId,
            $data['questionText']);
    }
}