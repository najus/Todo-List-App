<?php
include 'db-connection.php';

$username = filter_input ( INPUT_POST, 'username' );
$password = filter_input ( INPUT_POST, 'password' );
session_start ();

$stmt = $db->prepare ( "SELECT * FROM users WHERE username = :username" );
$stmt->execute ( array (
		':username' => $username 
) );
$user = $stmt->fetch ();
if ($user) {
	if (password_verify ( $password, $user ["password"] )) {
		$_SESSION ['username'] = $username;
		$_SESSION ['email'] = $user ['email'];
		$_SESSION ['user_id'] = $user ['user_id'];
		$_SESSION ['created_date'] = $user ['created_date'];
		header ( "Location: home.php" );
	} else {
		$_SESSION ['error'] = "Incorrect username or password";
		header ( "Location: index.php" );
	}
} else {
	$_SESSION ['error'] = "Incorrect username or password";
	header ( "Location: index.php" );
}
?>
