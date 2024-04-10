<?php
	session_start();
	if(!isset($_SESSION['id']))
	{
		Header("Location:login.html");
	}
	if(isset($_GET['home']))
		echo "<h2>Hello, {$_SESSION['user']}! | <a href='logout.php'>Log out</a></h2>";
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
			{
				echo "<form action=\"update.php?id=$id&save\" method=\"post\">
						First name: <input name=\"firstname\" value=\"{$data['firstname']}\"><br>
						Last name: <input name=\"lastname\" value=\"{$data['lastname']}\"><br>
						Username: <input name=\"username\" value=\"{$data['username']}\"><br>
						Set new password: <input name=\"password\" type=\"password\"><br>";	
				if($_SESSION['admin']!='0')
				{
					if($data['admin']==0)
						echo '<input type="checkbox" name="admin" value="1"> Admin<br>';
					else 
						echo '<input type="checkbox" name="admin" value="1" checked="checked"> Admin<br>';
				}
				echo "<input type=\"submit\" value=\"Update\"\>
					</form>";
			}
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
			$username=$_POST['username'];
			$admin=isset($_POST['admin'])?($_POST['admin']==1?1:0):0;
			$sql="update users set firstname='$firstname',
			lastname='$lastname',
			username='$username',";
			if(isset($_POST['password'])&&trim($_POST['password'])!="")
				$sql.="password='".md5($_POST['password'])."',";
			$sql.="admin=$admin where id=$id";
			mysqli_query($link,$sql);
			Header("Location:index.php");
		}
		catch(Exception $e)
		{
			print_r($e);
		}
	}
?>