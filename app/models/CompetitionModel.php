<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 6/10/2016
 * Time: 11:04 AM
 */

/**
 * Model for Competition in context of MVC.
 */
class CompetitionModel
{
    public $cmpId;
    public $title;
    public $description;
    public $startDate;
    public $endDate;

    /**
     * Constructor.
     * @param int $cmpId <p>competition identifier</p>
     * @param string $title <p>title</p>
     * @param string $description <p><description/p>
     * @param date $startDate <p>start of competition</p>
     * @param date $endDate <p>end of competition</p>
     */
    public function __construct($cmpId, $title, $description, $startDate, $endDate)
    {
        $this->cmpId = $cmpId;
        $this->title = $title;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
}