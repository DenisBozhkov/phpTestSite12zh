<h1>Users</h1>
<a href="create.html">Create new user</a>
<table border="1">
<tr>
	<th>Id</th>
	<th>First name</th>
	<th>Last name</th>
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
				lastname varchar(50) not null)";
		mysqli_query($link,$sql);
	}
	
	$link=mysqli_connect("localhost","root","");
	try
	{
		mysqli_select_db($link,"testPHPSite");
	}
	catch(Exception)
	{
		prepair_db($link);
	}
	
	$result=mysqli_query($link,"select * from users");
	while($data=mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>".$data['id']."</td>";
		echo "<td>".$data['firstname']."</td>";
		echo "<td>".$data['lastname']."</td>";
		echo '<td><a href="delete.php?id='.$data["id"].'">Delete</a></td>';
		echo "</tr>";
	}
?>
</table>