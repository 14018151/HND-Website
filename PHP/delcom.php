<?php
session_start();
require_once('db_connect.php');
//Delete comment
if(isset($_GET['delcom'])){
	$id = $_GET['delcom'];
	
	
	$sql = "DELETE FROM articlecomment WHERE commentID = '".$id."';";

	$result = mysqli_query($conn, $sql);

	header("Location: article.php?article=" . $_SESSION['article']);
	
}else{
	header("Location:" . "../blog.php");
	}	
	
?>