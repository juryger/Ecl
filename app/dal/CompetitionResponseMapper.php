<?php
/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 9/10/2016
 * Time: 11:43 PM
 */

require_once('../app/models/CompetitionResponseModel.php');

/**
 * Implement DataMapper pattern for CompetitorResponseModel
 * see PEAA, http://martinfowler.com/eaaCatalog/dataMapper.html
 */
class CompetitionResponseMapper
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
     * Create competition response in database if has not exist yet.
     * @param int $cmpId <p>competition identifier</p>
     * @param string $cmrId <p>competitor identifier</p>
     * @param string $answerId <p>answer identifier</p>
     * @return CompetitionResponseModel model for competition response
     */
    public function CreateCompetitionResponse($cmpId, $cmrId, $answerId)
    {
        $query = "SELECT answerId, entryDate FROM competition_response WHERE cmpId = :1 AND cmrId = :2";
        $data = $this->db->Prepare($query)->Execute($cmpId, $cmrId)->FetchAssoc();

        if($data) {
            $result = new CompetitionResponseModel(
                $cmpId,
                $cmrId,
                $data['answerId'],
                $data['entryDate']);
            $result->isAlreadyRegistered = true;
            return $result;
        }

        $query = "INSERT INTO competition_response(cmpId, cmrId, answerId) VALUES (:1, :2, :3)";
        $this->db->Prepare($query)->Execute($cmpId, $cmrId, $answerId);

        return new CompetitionResponseModel(
            $cmpId,
            $cmrId,
            $answerId,
            new DateTime());
    }
}