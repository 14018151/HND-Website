<?php 
	session_start();
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale 1.0">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Home</title>
<!-- InstanceEndEditable -->
<link href="CSS/page.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="nav" -->
<nav id="nav">

<ul><li><a href='index.php'>Home</a></li>
<li><a href='PHP/blog.php'>Blog</a></li>
 <!-- PHP checks if user is logged in. If they aren't insert link to login.php. 
If they are insert dropdown linking to logout.php and view_profile.php and check if user is an admin.
If user is an admin also insert link to admin.php-->
<?php 
if(!isset($_SESSION['memberID'])){
	echo "<li><a href='PHP/login.php'>Login</a></li>";
}
else
{
	echo "
		<li><div class='dropdown'>
			<button class='dropbtn'>PROFILE</button>
			<div class='dropdown-content'>
			<a href='PHP/profile.php'>View Profile</a>
			<a href='PHP/logout.php'>Logout</a>
  </div>
</div> ";

	if($_SESSION['userType'] == '1')
	{
		echo "
	<li><a href='PHP/admin.php'>Admin</a></li>
	";
	}
}
 ?>
 <li><a href='PHP/contact.php'>Contact</a></li></ul>


</nav>
<!-- InstanceEndEditable -->

<!-- InstanceBeginEditable name="main" -->
<main id="main" style="font-size:2.5em; padding-top:30px;text-align:center;">

<img src="Images/LogoWithText.jpg" width="453" height="95" alt="theLocalTheatre"/>
<div align="center">
<p>Welcome to the Local Theatre website! </p>
<br>

<p>From here you can check out reviews from both us and our customers, as well as any upcoming films that are being shown on our blog page. Or, if you have any questions have a look at the contact page to see how to get in touch!</p>

<p><a href="gallery/page/gallery.php">View Our Gallery!</a></p>
</div>
</main>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>

