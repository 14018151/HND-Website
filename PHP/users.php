<?php
session_start();
require('db_connect.php');
$query = mysqli_query($conn, "SELECT * FROM sitemember");

if($_SESSION['userType']!='1'){
	header("Location: "."../index.php");}
?>
<!doctype html>
<html>
<head>
<link href="../CSS/page.css" rel="stylesheet" type="text/css">
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale 1.0">
<title>View Users</title>
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
  <li><a href="contact.php">ContacT</a></li></ul></nav>
  </nav>
  
<main id="main">
<div class="userTable">
<table width="66%" border="1" align="center">
    <tr>
    	<td width="124">USER NUMBER</td>
      <td width="130">USERNAME</td>
      <td width="133">ACCESS</td>
      

    </tr>
	<?php
		while($row = mysqli_fetch_assoc($query)){
		//Displays user details
		$usertype = $row['usertype'];
		echo "<tr>";
		
		echo "<td>" . $row['memberno'] . "</td>";
		echo "<td>" . $row['username'] . "</td>";
		echo "<td>" . $row['usertype'] . "</td>";
		
		//Gives options to promote or suspend/resume non admin members
	if($usertype!=1){
		echo '<td width="100px" style="text-align:center;"><a href="promote.php?promote=' . $row['memberno'] . '">PROMOTE</a></td>';
		if($usertype=='0'){
		echo '<td width="100px" style="text-align:center;"><a href="suspend.php?suspend=' . $row['memberno']. '">SUSPEND</a></td>';}}
		if($usertype=='-1'){
			
			echo '<td width="100px" style="text-align:center;"><a href="resume.php?resume=' . $row['memberno']. '">RESUME</a></td>';
		}
		echo "</tr>";
		
		}
		?>
       
</table>
</div> 
</main>
</body>
</html>