<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 9/09/2016
 * Time: 12:44 PM
 */

/**
 * Model of Contest in context of MVC.
 */
class ContestModel
{
    /**
     * @var CompetitorModel selected competition.
     */
    public $competition;

    /**
     * @var QuestionModel selected question.
     */
    public $question;

    /**
     * @var SchoolModel selected school.
     */
    public $school;

    /**
     * @var CompetitorModel current competitor.
     */
    public $competitor;

    /**
     * @var CompetitionResponseModel competitor's response on selected question
     */
    public $competitonResponse;

    /**
     * @var bool Flag that show does competitor has sent his answer on question.
     */
    public $isSubmitted = false;
}