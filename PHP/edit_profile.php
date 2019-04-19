<?php
session_start();
require('db_connect.php');

$error = "";

if(!isset($_SESSION['memberID'])){
	Header("Location:"."../index.php");
}

if(isset($_GET['edit_profile'])){
	$id=$_GET['edit_profile'];
	
	$result = mysqli_query($conn, "SELECT * FROM sitemember WHERE memberno= ".$id);
	
	$query = mysqli_fetch_assoc($result);
	}
	else{
	Header("Location:"."profile.php");
	}

//taskes submitted details and updates database
if(isset($_POST['id'])){
	$memberID=$_SESSION['memberID'];
			
	$new_first = $_POST['new_first'];
	$new_email = $_POST['new_email'];
	$new_title = $_POST['new_title'];
	$new_last=$_POST['new_last'];
	$new_username = $_POST['new_username'];
	$new_password = $_POST['new_password'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$new_dob="{$year}-{$month}-{$day}";
	
	$sql = "UPDATE sitemember SET username = '".$new_username."'," ;
	$sql .="dob = '" . $new_dob . "',";
	$sql .="salutation = '" . $new_title. "',";
	$sql .="forenames = '" . $new_first. "',";
	$sql .="surname = '" . $new_last. "',";
	$sql .="email= '" . $new_email. "'";
	$sql .="WHERE memberno = ".$memberID.";";
	$result = mysqli_query($conn, $sql);
	
	if($_POST['new_password']!=null){
		$hash = password_hash($new_password, PASSWORD_BCRYPT );
		$updatepass = "UPDATE sitemember SET userpass = '".$hash."'WHERE memberno = ".$memberID.";";
		$result2 = mysqli_query($conn, $updatepass);
	}
	header("Location: profile.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale 1.0">
<title>Edit Profile</title>
<link href="../CSS/page.css" rel="stylesheet" type="text/css">
</head>

<body>
<nav id="nav">
<ul>
  <li><a href="../index.php">Home</a></li>
  <li><a href="blog.php">Blog</a></li>
   <!-- PHP checks if user is logged in. If they aren't insert link to login.php. 
If they are insert dropdown linking to logout.php and view_profile.php and check if user is an admin.
If user is an admin also insert link to admin.php-->
  <?php 
if(!isset($_SESSION['memberID'])){
	echo "<li><a href='login.php'>Login</a></li>";
}
else
{
	echo "
		<li><div class='dropdown'>
			<button class='dropbtn'>PROFILE</button>
			<div class='dropdown-content'>
			<a href='profile.php'>View Profile</a>
			<a href='logout.php'>Logout</a>
  </div>
</div> ";

	if($_SESSION['userType'] == '1')
	{
		echo "<li><a href='admin.php'>Admin</a></li>";
	}
}
 ?>
  <li><a href="contact.php">Contact</a></li></ul></nav>
  
<main id ="main">
<form id="editForm" action="	" onSubmit="return validateEdit()" method="post">
<?php echo $error; //Displays details of member ready to be edited and submitted?>
	<table style="font-size:2em;" align="center">
    	<tr>
        <td>Email: </td></tr><tr>
        	<td  colspan="3">
            	<input type="hidden" name="id" required
                	value="<?php echo $query['memberno'];?> ">
				<input type="text" name="new_email"
                	value="<?php echo $query['email'];?>">
			</td>
         </tr>
		 <tr>
         <td>Username:</td></tr><tr>
         	<td  colspan="3"> 
            	<input type="text" name="new_username" required 
                	value="<?php echo $query['username'];?>">
            </td>
          </tr>
		  <tr>
      <td>New Password: </td></tr><tr>
      <td colspan="3"><input type="password" name="new_password" 
	  value = ""></td>
    </tr>
    <tr>
      <td>Confirm New Password: </td></tr><tr>
      <td colspan="3"><input type="password" name="new_password2" 
	  value = ""></td>
    </tr>
		 
    <tr>
      <td>DOB:</td></tr><tr>
      <td width="33%">
      <select name="day">
  		<?php
		$oldday = substr($query['dob'],8,2);
		
			for ($i=1; $i<=31; $i++)
			{
				if($i == $oldday)
				{
					echo "<option value='$i' selected> $i</option>";
				}
				else
				{	
        			echo "<option value='$i'> $i</option>";
				}
			}
		?>
      </select></td>
      <td width="33%"><select name = "month">
		<?php
		$oldmonth = substr($query['dob'],5,2);
		
			for ($i=1; $i<=12; $i++)
			{		
            if($i == $oldmonth)
				{
					echo "<option value='$i' selected> $i</option>";
				}
				else
				{	
        			echo "<option value='$i'> $i</option>";
				}

			}
		?>
	   </select ></td>
      <td width="33%"><select name="year">
		<?php
		
		$oldyear = substr($query['dob'],0,4);
			for ($i=1915; $i<=date("Y"); $i++){
			if($i == $oldyear)
				{
					echo "<option value='$i' selected> $i</option>";
				}
				else
				{	
        			echo "<option value='$i'> $i</option>";
				}

		
			}
		?>
</select></td>
    </tr>
	 <tr>
         <td>Title:</td></tr><tr>
         	<td  colspan="3">
            	<input type="text" name="new_title" required
                	value="<?php echo $query['salutation'];?>">
            </td>
          </tr>
		  <tr>
         <td>Forename:</td></tr><tr>
         	<td  colspan="3">
            	<input type="text" name="new_first" required
                	value="<?php echo $query['forenames'];?>">
            </td>
          </tr>
       	 <tr>
         <td>Surname:</td></tr><tr>
         	<td  colspan="3"> 
            	<input type="text" name="new_last" required
                	value="<?php echo $query['surname'];?>">
            </td>
          </tr>
          <tr>
          	<td></td>
            <td>
            	<input type="submit" name="edit" value="SUBMIT">
            </td>  

				<td>
                
            	<?php 

				echo '<p><a href="clear_profile.php?clear_profile='. $id . '">Delete Profile</a></p>';?>
            </td>
           </tr>
        </table>
					</form>
</main>
</body>
</html>