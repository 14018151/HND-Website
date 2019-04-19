<?php
require 'db_connect.php';


function is_post_request(){
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}
            
//Takes the details posted from register.php and inserts them into sitemember table in database
if(is_post_request()){
	
			$details =[];
			$details['username']= isset($_POST['username']) ? $_POST['username'] : '';
			
			
			$details['day'] =isset($_POST['day']) ? $_POST['day'] : '';
			$details['month'] = isset($_POST['month']) ? $_POST['month'] : '';
			$details['year'] = isset($_POST['year']) ? $_POST['year'] : '';	
			
			//Takes separate inputs of day, month, and year and combines them into dob
			$details['dob']="{$details['year']}-{$details['month']}-{$details['day']}";
			
			$details['title'] = isset($_POST['title']) ? $_POST['title'] : '';
			$details['forenames']=isset($_POST['forenames']) ? $_POST['forenames'] : '';
			$details['surname']= isset($_POST['surname']) ? $_POST['surname'] : '';
			$details['email']= isset($_POST['email']) ? $_POST['email'] : '';
			$details['password']= isset($_POST['password']) ? $_POST['password'] : '';
			
			$details['hash'] = password_hash($details['password'], PASSWORD_BCRYPT);
			
			$query = mysqli_query($conn, "SELECT * FROM sitemember WHERE username = '". $details['username'] ."';");
			
			$rows = mysqli_num_rows($query);
			
			if($rows > 0)
			{
				$nameErr = "Username already exists";
			}
			else
			{
				$sql = mysqli_query($conn, "SELECT * FROM sitemember WHERE email = '". $details['email']. "'");
				}
				
				$row = mysqli_num_rows($sql);
				
				if($row > 0){
					$emailError = "Email already exists";
				}
				else{
			$sql = "INSERT INTO sitemember";
 			$sql .= "(username, dob, salutation, forenames, surname, email, userpass, tnc) ";
 			$sql .= "VALUES (";
 			$sql .= "'" . $details['username'] . "', ";
 			$sql .= "'" . $details['dob'] . "', ";
			$sql .= "'" . $details['title'] . "', ";
			$sql .= "'" . $details['forenames'] . "', ";
			$sql .= "'" . $details['surname'] . "', ";
			$sql .= "'" . $details['email'] . "', ";
			$sql .= "'" . $details['hash'] . "',";
			$sql .= "'1'";
 			$sql .= ")";
 
 $result = mysqli_query($conn, $sql);
			header("location: " . "login.php");	}
}
 ?>