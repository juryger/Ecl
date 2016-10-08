<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 6/10/2016
 * Time: 11:15 AM
 */

/**
 * Model for Question in context of MVC.
 */
class QuestionModel
{
    public $questionId;
    public $cmpId;
    //public $competition;
    public $questionText;

    /**
     * Constructor.
     * @param int $questionId <p>question identifier</p>
     * @param string $cmpId <p>competition identifier</p>
     * @param string $questionText <p>question text</p>
     */
    public function __construct($questionId, $cmpId, $questionText)
    {
        $this->questionId = $questionId;
        $this->cmpId = $cmpId;
        $this->questionText = $questionText;
    }
}