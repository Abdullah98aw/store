<?php 
session_start();


if(isset($_SESSION['logged_in'])){

	$_SESSION = [];
	$_SESSION['success_message'] = 'you are logged out ';
	header('location:index.php');
	die();

}
 
?>