<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 6/10/2016
 * Time: 10:14 AM
 */

require_once('../app/models/CompetitionModel.php');

/**
 * Implement DataMapper pattern for CompetitionModel
 * see PEAA, http://martinfowler.com/eaaCatalog/dataMapper.html
 */
class CompetitionMapper
{
    private $dbh;

    /**
     * CompetitionMapper constructor.
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
     * Return competition with required id from Database.
     * @param int $cmpId <p>competition identifier</p>
     * @return CompetitorModel competition related with required id
     */
    public function FindByCompId($cmpId)
    {
        $query = "SELECT title, description, startDate, endDate FROM Competition WHERE cmpId = :1";
        $data = $this->dbh->Prepare($query)->Execute($cmpId)->FetchAssoc();

        if(!$data) {
            return false;
        }

        return new CompetitionModel(
            $cmpId,
            $data['title'],
            $data['description'],
            $data['startDate'],
            $data['endDate']);
    }
}