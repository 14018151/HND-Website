<?php
session_start();
require('db_connect.php');

//Sets usertype to 0, removing the suspension
if(isset($_GET['resume'])){
	$id=$_GET['resume'];
	
	$result = mysqli_query($conn, "SELECT * FROM sitemember WHERE memberno= ".$id);
	
	$query = mysqli_fetch_assoc($result);
	
	$sql = "UPDATE sitemember SET usertype = '0' WHERE memberno =".$id.";";
		$result = mysqli_query($conn, $sql);
	Header("Location:"."users.php");
	}
	else{
	Header("Location:"."../index.php");
	}
	
?>