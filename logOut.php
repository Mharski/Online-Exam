<?php 
session_start();
session_destroy();
echo "<script>alert('Thank you for taking the Exam ... :D!');</script>";
header('Location: index.php');
 ?>