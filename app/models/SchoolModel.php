<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 6/10/2016
 * Time: 11:08 AM
 */

/**
 * Model for School in context of MVC.
 */
class SchoolModel
{
    public $schoolId = -1;
    public $name = '';
    public $phone = '';

    /**
     * Constructor.
     * @param int $schoolId <p>school identifier</p>
     * @param string $name <p>school name</p>
     * @param string $phone <p>school phone number</p>
     */
    public function __construct($schoolId, $name, $phone)
    {
        $this->schoolId = $schoolId;
        $this->name = $name;
        $this->phone = $phone;
    }
}