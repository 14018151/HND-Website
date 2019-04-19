<?php
require('db_connect.php');
session_start();

if(isset($_GET['edit'])){
	$id=$_GET['edit'];
	$result = mysqli_query($conn, "SELECT * FROM blogarticle WHERE blogID = ".$id);
	$query = mysqli_fetch_assoc($result);
	}
	else{
	Header("Location: blog.php");
	}
	
	//Updates article details based on user form input
if(isset($_POST['new_aTitle'])){
	$postid=$_POST['id'];
	$new_aTitle = $_POST['new_aTitle'];
	$new_aText =$_POST['new_aText'];
	$sql = "UPDATE blogarticle SET articletitle = '".$new_aTitle."',";
	$sql .="articletext = '" . $new_aText . "'";
	$sql .="WHERE blogID = '".$postid."'";
	$result = mysqli_query($conn, $sql);
	
	header("Location: article.php?article=" . $_SESSION['article'] . "");
}

?>
<!doctype html>
<html>
<head>
<link href="../CSS/page.css" rel="stylesheet" type="text/css">
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale 1.0">
<title>Edit Article</title>
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
  <main id="main" >
  <!-- Fill in existing article details ready to be editted and posted-->
<form action="" method="post">
	<table width="80%">
    	<tr>
        <td style = "font-size:1.5em;">Title</td></tr><tr>
        	<td>
            	<input type="hidden" name="id"
                	value="<?php echo $query['blogID'];?> ">
				<input type="text" name="new_aTitle" style="font-size:1.5em;"
                	value="<?php echo $query['articletitle'];?>">
			</td>
         </tr>
       	 <tr>
         <td style = "font-size:1.5em;">Content</td></tr><tr>
         	<td>
            	<textarea name="new_aText" cols="150" rows="10"><?php echo $query['articletext'];?></textarea>
              
            </td>
          </tr>
          <tr>
            <td>
            	<input type="submit" name="edit" value="SUBMIT">
            </td>  		
           </tr>
        </table>
</form>
</main>
</body>
</html>