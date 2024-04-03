<?php
	session_start();
	if(isset($_SESSION['user']))
	{
		Header("Location:index.php");
	}
	if(!isset($_POST['username'])||!isset($_POST['password']))
		die('<h2>No login data!</h2>');
	if($_POST['password']=='123'&&$_POST['username']=='admin')
	{
		$_SESSION['user']='admin';
		Header("Location:index.php");
	}
	else die('<h2>Invalid login data!</h2><a href="login.html">Go back</a>');
?>