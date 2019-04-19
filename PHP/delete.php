<?php
require_once('db_connect.php');

//Delete article and all associated comments from database
if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	
	$sql = "DELETE b.*,a.*
		FROM blogarticle b
		LEFT JOIN articlecomment a ON b.blogID = a.mainarticle
		WHERE b.blogID = '".$id."';";

	$result = mysqli_query($conn, $sql);
		
	header("Location: blog.php");
	
}else{
	header("Location:" . "../index.php");}	

?>