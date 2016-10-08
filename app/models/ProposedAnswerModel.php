<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 6/10/2016
 * Time: 11:36 AM
 */

/**
 * Model for Proposed answer in context of MVC.
 */
class ProposedAnswerModel
{
    public $answerId;
    public $questionId;
    //public $question;
    public $answerText;
    public $isCorrect;

    /**
     * Constructor.
     * @param int $answerId <p>answer identifier</p>
     * @param int $questionId <p>question identifier</p>
     * @param string $answerText <p>answer text</p>
     * @param int $isCorrect <p>flag which shows if question is correct (1)</p>
     */
    public function __construct($answerId, $questionId, $answerText, $isCorrect = 0)
    {
        $this->answerId = $answerId;
        $this->questionId = $questionId;
        $this->answerText = $answerText;
        $this->isCorrect = $isCorrect;
    }
}