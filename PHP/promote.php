<?php
session_start();
require('db_connect.php');

$query = mysqli_query($conn, "SELECT * FROM blogarticle, articlecomment WHERE bl");

//Set user's usertype to 1, thereby making them an admin
if(isset($_GET['promote'])){
	$id=$_GET['promote'];
	
	$result = mysqli_query($conn, "SELECT * FROM sitemember WHERE memberno= ".$id);
	
	$query = mysqli_fetch_assoc($result);
	
	$sql = "UPDATE sitemember SET usertype = '1' WHERE memberno =".$id.";";
		$result = mysqli_query($conn, $sql);
	Header("Location:"."users.php");
}else{
	Header("Location:"."../index.php");
}
	
?>