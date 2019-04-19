<?php 
session_start();

require_once('db_connect.php');

if(isset($_SESSION['memberID'])){
	$error = "";
	
	$id = $_SESSION['memberID'];
	
	$query = mysqli_query($conn, "SELECT * FROM sitemember WHERE memberno = '$id'");
	
	$rows = mysqli_num_rows($query);
			
	if($rows == 1){
		$row = mysqli_fetch_assoc($query);
	}else
	{
		$error = "No users found";
	}

}
	else{
	Header("Location:"."../index.php");
	}
	
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
<main id="main" style="font-size:1.5em;">
<table width="211" align="center">
<?php echo $error;?>

<tr>
<td width="155">Profile Number:</td>
<td width="23"><?php echo ($row['memberno']);?></td>
</tr>

<tr>
<td>Email: </td>
<td><?php echo ($row['email']);?></td>
</tr>

<tr>
<td>Username: </td>
<td><?php echo ($row['username']);?></td>
</tr>

<tr>
<td>Name: </td>
<td><?php echo ($row['forenames']. " " . $row['surname']);?></td>
</tr>

<tr>
<td>DOB</td>
<td><?php echo ($row['dob']);?></td>
</tr>

<tr>
<td>Access Level: </td>
<td><?php echo ($row['usertype']);?></td>
</tr>

</table>
<?php echo '<p style="text-align:center;"><a href="edit_profile.php?edit_profile='. $id . '">Edit Profile</a></p>';?>

</main>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>