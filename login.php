<?php
	session_start();
	if(isset($_SESSION['id']))
	{
		Header("Location:index.php");
	}
	if(!isset($_POST['username'])||!isset($_POST['password']))
		die('<h2>No login data!</h2>');
	$link=mysqli_connect("localhost","root","","testPHPSite");
	$res=mysqli_query($link,"select * from users where username='{$_POST['username']}'");
	$data=mysqli_fetch_array($res);
	if($data&&$data['password']==md5(trim($_POST['password'])))
	{
		$_SESSION['id']=$data['id'];
		$_SESSION['user']=$data['username'];
		$_SESSION['admin']=$data['admin'];
		Header("Location:index.php");
	}
	else die('<h2>Invalid login data!</h2><a href="login.html">Go back</a>');
?>