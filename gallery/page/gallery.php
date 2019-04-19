<?php 
	session_start();
?>

<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gallery</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=550, initial-scale=1">

	
	<link href="../../CSS/page.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../dist/jquery.flipster.min.css">

    <script src="jquery.min.js"></script>
    <script src="../dist/jquery.flipster.min.js"></script>
</head>
<body>
<nav id="nav">

<ul><li><a href='../../index.php'>Home</a></li>
<li><a href='../../PHP/blog.php'>Blog</a></li>

<!-- PHP checks if user is logged in. If they aren't insert link to login.php. 
If they are insert dropdown linking to logout.php and view_profile.php and check if user is an admin.
If user is an admin also insert link to admin.php-->

<?php 
if(!isset($_SESSION['memberID'])){
	echo "<li><a href='../../PHP/login.php'>Login</a></li>";
}
else
{
	echo "
		<li><div class='dropdown'>
			<button class='dropbtn'>PROFILE</button>
			<div class='dropdown-content'>
			<a href='../../PHP/profile.php'>View Profile</a>
			<a href='../../PHP/logout.php'>Logout</a>
  </div>
</div> ";

	if($_SESSION['userType'] == '1')
	{
		echo "
	<li><a href='../../PHP/admin.php'>Admin</a></li>
	";
	}
}
 ?>
 <li><a href='../../PHP/contact.php'>Contact</a></li></ul>


</nav>

<h1 style="text-align: center;">Gallery</h1>
<!-- Inserts the images to be made into a slideshow by javascript files-->
<article id="gallery" class="gallery">
    <div id="coverflow">
        <ul class="flip-items">
			 <li>
                <img src="img/shakespeare.jpg" height="300px">
            </li>
			 <li>
                <img src="img/admission.jpg" height="300px">
            </li>
			<li>
                <img src="img/yorik.jpg" height="300px">
            </li>
			<li>
                <img src="img/rose.jpg" height="300px">
            </li>
			
        </ul>
    </div>

<script>
    var coverflow = $("#coverflow").flipster();
</script>

</article>



</body>
</html>
