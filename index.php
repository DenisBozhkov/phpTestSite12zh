<?php
	session_start();
	$link=mysqli_connect("localhost","root","");
	try
	{
		mysqli_select_db($link,"testPHPSite");
	}
	catch(Exception)
	{
		prepair_db($link);
	}
	if(!isset($_SESSION['id']))
		Header("Location:login.html");
	else if($_SESSION['admin']==0)
		Header("Location:update.php?id={$_SESSION['id']}&home");
	echo "<h2>Hello, {$_SESSION['user']}! | <a href='logout.php'>Log out</a></h2>";
?>
<h1>Users</h1>
<a href="create.php">Create new user</a>
<table border="1">
<tr>
	<th>Id</th>
	<th>First name</th>
	<th>Last name</th>
	<th>Username</th>
	<th>Admin status</th>
	<th>Update</th>
	<th>Delete</th>
</tr>
<?php
	function prepair_db($link)
	{
		mysqli_query($link,"create database testPHPSite");
		mysqli_select_db($link,"testPHPSite");
		$sql="create table users(
				id int auto_increment primary key,
				firstname varchar(50) not null,
				lastname varchar(50) not null,
				username varchar(50) not null,
				password varchar(255) not null,
				admin int default 0)";
		mysqli_query($link,$sql);
		$sql="insert into users values(0,'Admin','Admin','admin','".md5("123")."',2)";
		mysqli_query($link,$sql);
	}
	
	$result=mysqli_query($link,"select * from users");
	while($data=mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>".$data['id']."</td>";
		echo "<td>".$data['firstname']."</td>";
		echo "<td>".$data['lastname']."</td>";
		echo "<td>".$data['username']."</td>";
		echo "<td>".$data['admin']."</td>";
		if($data['admin']<=$_SESSION['admin'])
		{
			echo '<td><a href="update.php?id='.$data["id"].'">Update</a></td>';
			echo '<td><a href="delete.php?id='.$data["id"].'">Delete</a></td>';
		}
		else
		{
			echo '<td></td><td></td>';
		}
		echo "</tr>";
	}
?>
</table>