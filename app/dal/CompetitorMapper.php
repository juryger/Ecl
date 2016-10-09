<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 9/10/2016
 * Time: 10:48 PM
 */

require_once('../app/models/CompetitorModel.php');

/**
 * Implement DataMapper pattern for CompetitorModel
 * see PEAA, http://martinfowler.com/eaaCatalog/dataMapper.html
 */
class CompetitorMapper
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
     * Create competitor in database or return existing one.
     * @param int $schoolId <p>school identifier</p>
     * @param string $email <p>pupil email</p>
     * @param string $classNumber <p>class room</p>
     * @return CompetitorModel competitor
     */
    public function CreateCompetitor($schoolId, $email, $classNumber)
    {
        $query = "SELECT cmrId FROM competitor WHERE schoolId = :1 AND email = :2 AND classNumber = :3";
        $data = $this->db->Prepare($query)->Execute($schoolId, $email, $classNumber)->FetchAssoc();

        if($data) {
            return new CompetitorModel(
                $data['cmrId'],
                $schoolId,
                $email,
                $classNumber);
        }

        $query = "INSERT INTO competitor(schoolId, email, classNumber) VALUES (:1, :2, :3)";
        $this->db->Prepare($query)->Execute($schoolId, $email, $classNumber);

        return new CompetitorModel(
            $this->db->LastInsertedId(),
            $schoolId,
            $email,
            $classNumber);
    }
}