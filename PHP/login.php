<?php
	require_once('db_connect.php');
	
	include("userLog.php");
		
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale 1.0">
<!-- InstanceBeginEditable name="doctitle" -->
<title></title>
<!-- InstanceEndEditable -->
<link href="../CSS/page.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="nav" -->
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
<!-- InstanceEndEditable -->

<!-- InstanceBeginEditable name="main" -->
<main id="main"  style="font-size:2em;">
<h1> Sign In</h1>

				<form action ="" method = "post">
                  <label>Username</label><br />
                  <input type = "text" name = "username" required class = "box" /><br /><br />
                  <label>Password</label><br />
                  <input type = "password" name = "password" required class = "box" /><br/>
                  <input type = "submit" name="submit" value = "SUBMIT"/><br />
               </form>
				<p>Don't have an account? <a href="register.php">Register here!</a></p>
                <p><?php echo $error; ?></p>
                <p><?php echo $nameErr; ?></p>
					

</main>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
