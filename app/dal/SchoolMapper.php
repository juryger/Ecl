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
     * Return list of schools from Database.
     * @return SchoolModel competition related with required id
     */
    public function GetSchoolList()
    {
        $query = "SELECT schoolId, name, phone FROM school";
        $schoolList = $this->dbh->Execute($query)->FetchAllAssoc();

        $result = [];
        foreach($schoolList as $school) {
            array_push($result, new SchoolModel($school['schoolId'], $school['name'], $school['phone']));
        }

        return $result;
    }
}