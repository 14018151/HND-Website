<?php

//Connect to database

$dbhost = '10.7.64.136';
$dbuser = 'DW14018151';
$dbpass = 'password1';
$dbname = 'DW14018151';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


if(mysqli_connect_errno()){
$msg = "Database connection failed ";
$msg .= mysqli_connect_errno();
$msg .= " (" . mysqli_connect_errno() . ")";
exit($msg);
}

?>

