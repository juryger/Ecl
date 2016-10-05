<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 17/08/2016
 * Time: 2:57 AM
 */

// for development use E_ALL
error_reporting(E_ALL);

session_start();

// application initialization & client commands procession
require_once '../app/init.php';
$app = new App();

?>