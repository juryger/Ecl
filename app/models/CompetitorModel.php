<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 6/10/2016
 * Time: 11:40 AM
 */

/**
 * Model for Competitor in context of MVC.
 */
class CompetitorModel
{
    public $cmrId = -1;
    public $schoolId = -1;
    //public $school;
    public $email = '';
    public $classNumber;

    /**
     * Constructor.
     * @param int $cmrId <p>competitor identifier</p>
     * @param string $schoolId <p>school identifier</p>
     * @param string $email <p>pupil email</p>
     * @param string $classNumber <p>class number</p>
     */
    public function __construct($cmrId, $schoolId, $email, $classNumber)
    {
        $this->cmrId = $cmrId;
        $this->schoolId = $schoolId;
        $this->email = $email;
        $this->classNumber = $classNumber;
    }
}