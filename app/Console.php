<?php
/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 18/08/2016
 * Time: 2:00 AM
 */

namespace ECL\WebDiagnostics;

/**
 * Class used for writing diagnostic
 * information to browser console window.
 */
class Console
{
    /**
     * Write Info message to console
     * @param string $message <p>
     * Info message
     * </p>
     * @return void
     */
    public static function Log($message)
    {
        echo('<script>console.log("'.$message.'");</script>');
    }

    /**
     * Write Error message to console
     * @param string $error <p>
     * Error message
     * </p>
     * @return void
     */
    public static function Error($error)
    {
        echo('<script>console.error("'.$error.'");</script>');
    }

}