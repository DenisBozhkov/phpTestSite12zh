<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		Header("Location:login.html");
	}
	if(isset($_GET['save']))
	{
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$admin=$_POST['admin']==1?1:0;
		try
		{
			$link=mysqli_connect("localhost","root","","testPHPSite");
			$sql='insert into users values(0,"'.$firstname.'","'.$lastname.'","'.$username.'","'.md5($password).'","'.$admin.'")';
			mysqli_query($link,$sql);
			Header("Location:index.php");
		}
		catch(Exception $e)
		{
			print_r($e);
		}
	}
	else
	{
		echo '<form action="create.php?save" method="post">
					First name: <input name="firstname"><br>
					Last name: <input name="lastname"><br>
					Username: <input name="username"><br>
					Password: <input type="password" name="password"><br>';
		if($_SESSION['admin']!='0')
			echo '<input type="checkbox" name="admin" value="1"> Admin<br>';
		echo '
					<input type="submit" value="Create">
				</form>';
	}
?>