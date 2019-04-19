<?php
	require_once('db_connect.php');
	session_start();
	
	$error = "";

	$nameErr = "";
	
	//Removes special characters
	function test_input($data){
		$data=trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;		
	}
	
	
	if(isset($_POST['submit'])){
		if(empty($_POST['username']) || empty($_POST['password'])){
			$error = "You need to enter your Username & Password.";
		}else
		{
			$username = $_POST['username'];
			$password = $_POST['password'];

			//Checks for special characters
			if(!preg_match("/^[a-zA-Z ]*$/",$username)){
				$nameErr = "Only letters and white space allowed";
			}
			$query = mysqli_query($conn, "SELECT * FROM sitemember WHERE username = '$username';");
			
			$rows = mysqli_num_rows($query);
			
			if($rows == 1){
				$row = mysqli_fetch_assoc($query);
				
				if(password_verify($password,$row['userpass'])){
				$_SESSION['memberID'] = $row['memberno'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['userType'] = $row['usertype'];
				header("Location: "."	../index.php");
			}
			else{
				$error = "Username or password incorrect";}
			}
			else{
				$error = "Username or password incorrect";
			}
			mysqli_close($conn);
		}
		
	}



?>
