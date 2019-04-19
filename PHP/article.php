<?php
session_start();
require('db_connect.php');

//Takes the article clicked on and selects its details
if(isset($_GET['article'])){
	$id=$_GET['article'];
	
	$query = mysqli_query($conn, "SELECT * FROM blogarticle WHERE blogID= ".$id.";");
	
	$query2 = mysqli_query($conn, "SELECT * FROM articlecomment, sitemember WHERE mainarticle = ".$id." AND commentposter = memberno;");

	function is_post_request(){
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

//Inserts article into blogpost table in database after clicking submit            
if(is_post_request()){
	$posterID = $_SESSION['memberID'];
	$details =[];
	$details['comment']= isset($_POST['comment']) ? $_POST['comment'] : '';
	
	$t = time();
	$details['comTime'] = date("Y-m-d",$t)." " .date("h:m:s",$t);
	$details['comPoster']= $posterID;
			
			
			$sql = "INSERT INTO articlecomment";
 			$sql .= "(commenttext, commenttime, commentposter, mainarticle)";
 			$sql .= "VALUES (";
 			$sql .= "'" . $details['comment'] . "', ";
 			$sql .= "'" . $details['comTime'] . "', ";
			$sql .= "'" . $details['comPoster'] . "', ";
			$sql .= "'" . $id . "')";
 
 $result = mysqli_query($conn, $sql);
 header("Location: article.php?article=" . $id);
}

	}
	else{
	header("Location:"."../index.php");
	}

?>

<!doctype html>
<html>
<head>
<link href="../CSS/page.css" rel="stylesheet" type="text/css">
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale 1.0">
<title>Article</title>
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
  	<?php
	//Displays article title and content
		while($row = mysqli_fetch_assoc($query)){
			$_SESSION['article'] = $row['blogID'];
			echo "<table><tr>";
			echo "<td style='font-size: 1.5em;'>" . $row['articletitle'] . "</td>";
			echo "<td>".$row['blogtime']."</td>";
			//Allows admins to edit and delete articles
		if($_SESSION['userType'] == '1'){
			echo '<td width="10%"><a href="edit.php?edit=' . $id . '">Edit Article</td></p>';
			echo '<td width="10%"><a href="delete.php?delete=' . $id . '">Delete Article</td></p>';
		}
			echo "</tr><tr><td colspan='2'>" . $row['articletext'] . "</td></tr></table>";
		
		break;
		
		}


		//Allows users that are not suspended to post comments
		if(isset($_SESSION['memberID']) )
	{
		if($_SESSION['userType'] != -1){ 
		echo '</br></br>
<form action="" method="post">
<table width="80%" border="0" style="font-size:1em;">
  <tbody>
    <tr>
      <td style="font-size:1em;"> <input type="text" name="comment" placeholder="Write a comment here... " required></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" value="SUBMIT" required></td>
    </tr>
</table>
</form>
	';}}
	?>
    
	
	<button id="show-comments">SHOW COMMENTS</button>
	
	<div id ="comments">
    <h3>Comments</h3>
    <?php
	//Displays comments
	while($crow = mysqli_fetch_assoc($query2)){
		echo "<table><tr>";
		echo "<td><b>" . $crow['username'] . "<b></td>";
		if($_SESSION['memberID'] == $crow['commentposter'] || $_SESSION['userType'] == 1)
		{
			echo '<td><a href="delcom.php?delcom=' . $crow['commentID'] . '">Delete Comment</a></td>';
		}
		echo "</tr><tr><td colspan='2'>" . $crow['commenttext'] . "</td></td></br></table>";
		
		}
	

		?>
		</div>
		
  </main>
  <script>
  	var content = document.getElementById("comments");
	var button = document.getElementById("show-comments");
    
	button.onclick = function () {
		if (comments.className === "open") {
			//shrink the comments
			comments.className = "";
			button.innerHTML = "SHOW COMMENTS";
		} else {
			//expand the comments
			comments.className = "open";
			button.innerHTML = "HIDE COMMENTS";
		}
	};
  </script>
  
</body>
</html>