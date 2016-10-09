<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 6/10/2016
 * Time: 11:44 AM
 */

/**
 * Model for Competition response in context of MVC.
 */
class CompetitionResponseModel
{
    public $cmpId = -1;
    //public $competition;
    public $cmrId = -1;
    //public $competitor;
    public $answerId = -1;
    //public answer;
    public $entryDate;
    public $isAlreadyRegistered;

    /**
     * Constructor.
     * @param int $cmpId <p>competition identifier</p>
     * @param int $cmrId <p>competitor identifier</p>
     * @param int $answerId <p>answer identifier</p>
     * @param date $entryDate <p>date of taking part of competitor in competition</p>
     */
    public function __construct($cmpId, $cmrId, $answerId, $entryDate)
    {
        $this->isAlreadyRegistered = false;

        $this->cmpId = $cmpId;
        $this->cmrId = $cmrId;
        $this->answerId = $answerId;
        $this->entryDate = $entryDate;
    }
}