<?php
/**
 * mysql_connect is deprecated
 * using mysqli_connect instead
 */

$databaseHost     = 'localhost';
$databaseName     = 'php_project_manag';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);