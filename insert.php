<?php 
	include "dbconfig.php";
	
	$first_name = $_POST['f_name'];
	$last_name = $_POST['l_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$arr = array(
		'_fname' => $first_name,
		'_lname' => $last_name,
		'_email' => $email,
		'_password' => $password);

	$result = new ExamDAO();
	$result->createUser($arr['_fname'],$arr['_lname'],$arr['_email'],$arr['_password']);
	if ($result === false) {
		echo "<script>alert('An Error Occur!');</script>";
		header('Location: index.php');
	} else {
		echo "<script> window.location.href = 'index.php'; alert('Successfully Registered!'); </script>";
	}
 
 ?>