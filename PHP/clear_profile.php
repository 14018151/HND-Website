<?php
//Deletes profile
session_start();
require_once("db_connect.php");
if(isset( $_GET[ 'clear_profile' ])){
	$id = $_SESSION['memberID'];
	
	$sql = "DELETE FROM sitemember ";
	$sql .= "WHERE memberno = '" . $id . "' ";
	$sql .= "LIMIT 1";
	$result = mysqli_query($conn, $sql);
	header("Location:" . "logout.php");
}
?>