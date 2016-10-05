<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 4/10/2016
 * Time: 3:40 PM
 */
class MySqlException extends Exception
{
    public $backtrace;

    public function MySqlException($message=false, $code=false)
    {
        if(!$message) {
            $this->message = mysqli_error();
        }

        if(!$code) {
            $this->code = mysqli_errno();
        }

        $this->backtrace = debug_backtrace();
    }
}