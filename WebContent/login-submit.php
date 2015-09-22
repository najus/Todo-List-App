<?php
include 'db-connection.php';

$username = filter_input ( INPUT_POST, 'username' );
$password = filter_input ( INPUT_POST, 'password' );
// $pass_hash = password_hash ( $password, PASSWORD_DEFAULT );
session_start ();

$stmt = $db->prepare ( "SELECT * FROM users WHERE username = :username AND password = :password" );
$stmt->execute ( array (
		':username' => $username,
		':password' => $password 
) );
$user = $stmt->fetch ();
if ($user) {
	$_SESSION ['username'] = $username;
	$_SESSION ['email'] = $user ['email'];
	$_SESSION ['user_id'] = $user ['user_id'];
	$_SESSION ['created_date'] = $user ['created_date'];
	header ( "Location: home1.php" );
} else {
	$_SESSION ['error'] = "Incorrect username or password";
	header ( "Location: index.php" );
}
?>
