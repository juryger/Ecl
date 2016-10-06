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

    /**
     * MySqlException constructor.
     * @param mysqli $dbh db handler
     * @param bool $message custom exception message
     * @param bool $code custom exception code
     * @return mixed class instance
     */
    public function MySqlException($dbh, $message=false, $code=false)
    {
        if(!$message) {
            $this->message = mysqli_error($dbh);
        }

        if(!$code) {
            $this->code = mysqli_errno($dbh);
        }

        $this->backtrace = debug_backtrace();
    }
}