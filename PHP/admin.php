<?php 
session_start();

//Only allow admins to access page
if($_SESSION['userType']!='1'){
	header("Location: "."../index.php");}
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
<main id="main" style="font-size:2em; padding-top:30px;text-align:left;">

<p>As an administrator, you can post, edit, and delete articles on the blog page</p>
<br>

<p>Additionally, you can suspend a user to prevent them posting comments on an article, or promote someone to administrator status as well. Click below to view the table where you can suspend or promote users.</p>
<div align="center">
<p><a href="users.php">USERS</a></p>

</div>
</main>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
