<?php
session_start();
require('db_connect.php');

//Sets usertype to -1, suspending user and banning them from posting comments
if(isset($_GET['suspend'])){
	$id=$_GET['suspend'];
	
	$result = mysqli_query($conn, "SELECT * FROM sitemember WHERE memberno= ".$id);
	
	$query = mysqli_fetch_assoc($result);
	
	$sql = "UPDATE sitemember SET usertype = '-1' WHERE memberno =".$id.";";
		$result = mysqli_query($conn, $sql);
	Header("Location:"."users.php");
	}
	else{
	Header("Location:"."../index.php");
	}
	
?>