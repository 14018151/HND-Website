<?php 
session_start();
require_once( 'DB_Connector.php' );

include ("create.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale 1.0">
<title>Register</title>
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
		echo "
	<li><a href='admin.php'>Admin</a></li>
	";
	}
}
 ?>
  <li><a href="contact.php">Contact</a></li></ul></nav>
  
  
 <main id="main" style="font-size:1em"><h1> Register</h1>
<form id="regForm" action="" onSubmit="return validateForm()" method="post">

<table width="80%" border="0" style="font-size:2em;">
    <tr>
      <td>Email:</td></tr><tr>
      <td colspan="3"><input type="text" name="email" id="eMail" required></td>
    </tr>
    <tr>
      <td>Username:</td></tr><tr>
      <td colspan="3"><input type="text" name="username" required></td>
    </tr>
    <tr>
      <td>Password: </td></tr><tr>
      <td colspan="3"><input type="password" name="password" id="password" required></td>
    </tr>
    <tr>
      <td> Confirm Password: </td></tr><tr>
      <td colspan="3"><input type="password" name="password2" id="comfpass" required></td>
    </tr>
    <tr>
      <td>DOB:</td></tr><tr>
      <td width="33%">
      <select name="day">
  		<?php
		//creates dropdown with options 1 through 31 (haven't accounted for different month lengths)
			for ($i=1; $i<=31; $i++)
			{
        ?>
        <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
			}
		?>
      </select>
      <select name = "month">
        <?php
		//creates dropdown with options 1 through 12
			for ($i=1; $i<=12; $i++)
			{
		?>
        <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
			}
		?>
      </select >
      <select name="year">
        <?php
		//creates dropdown with options 1915 through to the current year
			for ($i=1915; $i<=date("Y"); $i++)
			{
        ?>
        <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
			}
		?>
      </select></td>
      <td width="33%">&nbsp;</td>
      <td width="33%">&nbsp;</td>
    </tr>
    
      <tr><td>Title: </td></tr>
	  <tr>
      <td colspan="3"><input type="text" name="title" required></td>
    </tr>
    <tr>
      <td>First Name:</td>
</tr><tr>     <td colspan="3"><input type="text" name="forenames" required></td>
    </tr>
    <tr>
      <td>Surname:</td></tr><tr>
      <td colspan="3"><input type="text" name="surname" required></td>
    </tr>
    <tr>
      <td colspan="3" ><input type="submit" value="Submit"></td>
    </tr>
</table>

</form><br>

<p><?php echo $emailError; ?></p>
<p><?php echo $nameErr; ?></p>

</main>
</body>
<script>
function validateForm(){
	//Checks email has @ and . symbols, otherwise will not submit the form
	var y = document.forms["regForm"]["email"].value;
	
	var hasdot = y.includes(".");
	var hasat = y.includes("@");
	
	if(hasdot == false || hasat == false){
		alert("Email must contain both @ and . symbols");
		return false;
		}

	if(!validatePassword || !validateEmail){
		return false;
	}
}

//Checks that both password boxes are the same. If not, refuse to submit the form
function validatePassword(){
	
	var password = document.forms["regForm"]["password"];
	var password2 = document.forms["regForm"]["password2"];

	
	if(password.value!=password2.value){
		password2.setCustomValidity("Passwords don't match!");
		return false;
	}else{
		
		password2.setCustomValidity("");
	}
	
}
//Runs validatePassword function whenever either box is editted.
password.onchange = validatePassword;
comfpass.onkeyup = validatePassword;
</script>
</html>