<?php
session_start();
require('db_connect.php');
$query = mysqli_query($conn, "SELECT * FROM blogarticle");


function is_post_request(){
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}
            
//Insert blog details upon clicking submit
if(is_post_request()){
	$posterID = $_SESSION['memberID'];
	
	$details =[];
	$details['blogtitle']= isset($_POST['aTitle']) ? $_POST['aTitle'] : '';
	$details['blogText']=isset($_POST['aText']) ? $_POST['aText'] : '';
	$t = time();
	$details['blogTime'] = date("Y-m-d",$t)." " .date("h:m:s",$t);
	$details['blogPoster']= $posterID;
			
			$sql = "INSERT INTO blogarticle";
 			$sql .= "(articletitle, articletext, blogtime, blogposter)";
 			$sql .= "VALUES (";
 			$sql .= "'" . $details['blogtitle'] . "', ";
 			$sql .= "'" . $details['blogText'] . "', ";
			$sql .= "'" . $details['blogTime'] . "', ";
			$sql .= "'" . $details['blogPoster'] . "')";
 
 $result = mysqli_query($conn, $sql);
 header("Location: " . "blog.php");
}

?>

<!doctype html>
<html>
<head>
<link href="../CSS/page.css" rel="stylesheet" type="text/css">
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale 1.0">
<title>Blog</title>
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
  </nav>
  
<main id="main">
<!-- Allows admins to post a blog -->
	<?php if($_SESSION['userType'] == '1')
	{
		echo '
<form action="" method="post">
<table width="80%" border="0" style="font-size:1em;">
  <tbody>
    <tr>
      <td style="font-size:1em;">Title</td></tr><tr>
      <td style="font-size:1em;"> <input type="text" name="aTitle" required></td>
    </tr>
    <tr>
      <td style="font-size:1em;">Article Text</td></tr><tr>
      <td style="font-size:1em;">
	  <textarea name="aText" cols="120" rows="5"></textarea></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" value="SUBMIT" required></td>
    </tr>
</table>
</form>
	';
	}
	//Displays articles
	while($row = mysqli_fetch_assoc($query)){
		echo '<p style="font-size: 1.5em;"><a href="article.php?article=' . $row['blogID'] . '">'.$row['articletitle']. '</a></p>';
		echo "<p>" .$row['articletext'] ."</p>";
		
	}
	?>




</main>
</body>
</html>
