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
     * @var ProposedAnswerModel array of answers for selected question.
     */
    public $proposedAnswers;

    /**
     * @var SchoolModel array of schools.
     */
    public $schoolList;

    /**
     * @var CompetitorModel current competitor.
     */
    public $competitor;

    /**
     * @var SchoolModel selected school.
     */
    public $selectedSchool;

    /**
     * @var ProposedAnswerModel selected answer for random question
     */
    public $selectedAnswer;

    /**
     * @var CompetitionResponseModel competition response
     */
    public $response;

    /**
     * @var bool Flag that show does competitor has sent his answer on question.
     */
    public $isSubmitted = false;
}