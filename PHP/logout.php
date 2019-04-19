<?php
require_once('db_connect.php');

session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();

header("location: " . "../index.php");
?>