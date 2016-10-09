<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 8/10/2016
 * Time: 10:45 AM
 */

require_once('../app/models/SchoolModel.php');

/**
 * Implement DataMapper pattern for SchoolModel
 * see PEAA, http://martinfowler.com/eaaCatalog/dataMapper.html
 */
class SchoolMapper
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
     * Return list of schools from Database.
     * @return SchoolModel competition related with required id
     */
    public function GetSchoolList()
    {
        $query = "SELECT schoolId, name, phone FROM school";
        $schoolList = $this->db->Execute($query)->FetchAllAssoc();

        $result = [];
        foreach($schoolList as $school) {
            array_push($result, new SchoolModel($school['schoolId'], $school['name'], $school['phone']));
        }

        return $result;
    }

    /**
     * Update school phone number.
     * @param int $schoolId <p>school identifier</p>
     * @param string $phoneNumber <p>school phone number</p>
     */
    public function UpdateSchoolPhoneNumber($schoolId, $phoneNumber)
    {
        $query = "UPDATE school SET phone = :1 WHERE schoolId = :2";
        $this->db->Prepare($query)->Execute($phoneNumber, $schoolId);
    }

    /**
     * Return required school from database.
     * @param int $schoolId <p>school identifier</p>
     * @return SchoolModel required school
     */
    public function GetSchool($schoolId)
    {
        $query = "SELECT name, phone FROM school WHERE schoolId = :1";
        $data = $this->db->Prepare($query)->Execute($schoolId)->FetchAssoc();

        if(!$data) {
            return false;
        }

        return new SchoolModel(
            $schoolId,
            $data['name'],
            $data['phone']);
    }
}