<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		Header("Location:login.html");
	}
	if(!isset($_GET['save']))
	{
		try
		{
			$id=$_GET['id']??-1;
			$link=mysqli_connect("localhost","root","","testPHPSite");
			$res=mysqli_query($link,"select * from users where id=$id");
			$data=mysqli_fetch_array($res);
			if(!$data) echo "Element with id $id does not exist!";
			else
				echo "<form action=\"update.php?id=$id&save\" method=\"post\">
						First name: <input name=\"firstname\" value=\"{$data['firstname']}\"><br>
						Last name: <input name=\"lastname\" value=\"{$data['lastname']}\"><br>
						<input type=\"submit\" value=\"Update\">
					</form>";
		}
		catch(Exception $e)
		{
			print_r($e);
		}
	}
	else
	{
		try
		{
			$id=$_GET['id']??-1;
			$link=mysqli_connect("localhost","root","","testPHPSite");
			$firstname=$_POST['firstname'];
			$lastname=$_POST['lastname'];
			mysqli_query($link,"update users set firstname='$firstname',lastname='$lastname' where id=$id");
			Header("Location:index.php");
		}
		catch(Exception $e)
		{
			print_r($e);
		}
	}
?>