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
    public $compId;
    public $title;
    public $description;
    public $startDate;
    public $endDate;

    /**
     * Constructor.
     * @param int $compId
     * @param string $title
     * @param string $description
     * @param date $startDate
     * @param date $endDate
     * @return mixed Instance of class
     */
    public function CompetitionModel($compId, $title, $description, $startDate, $endDate)
    {
        $this->compId = $compId;
        $this->title = $title;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
}