<?php
ob_start();
session_start();
	include_once('dbconfig.php');
	$email = mysql_real_escape_string($_POST['emailadd']);
	$pass = mysql_real_escape_string($_POST['passwork']);
	$result = ExamDAO::getUser($email, $pass);
	if($result['email'] == $email && $result['password'] == $pass){
		$_SESSION['email'] = strip_tags(stripslashes(mysql_real_escape_string($result['email'])));
		$_SESSION['F_name'] = strip_tags(stripslashes(mysql_real_escape_string($result['first_name'])));
		$_SESSION['L_name'] = strip_tags(stripslashes(mysql_real_escape_string($result['last_name'])));
		session_write_close();
		echo "<script>alert('Successfully Log In!');</script>";
		header('Location: Online_test.php');
	}else{
			echo "<script>alert('Wrong email or Password');window.location.href='index.php';</script>'";
	}
?>