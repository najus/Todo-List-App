<?php
session_start ();
include ("db-connection.php");
/* @var $_POST type */
$username = filter_input ( INPUT_POST, "name" );
$password = filter_input ( INPUT_POST, "password" );
$confirmpassword = filter_input ( INPUT_POST, "confirmpassword" );
$email = filter_input ( INPUT_POST, "email" );
$currentDate = date ( 'Y-m-d' );

if (empty ( $username ) || empty ( $password ) || empty ( $confirmpassword ) || empty ( $email )) {
	$_SESSION ['error'] = "Fields cannot be empty";
	header ( "Location: signup.php" );
	exit ();
} else if ($password !== $confirmpassword) {
	$_SESSION ['error'] = "Passwords do not match";
	header ( "Location: signup.php" );
	exit ();
}
try {
	$selectStmnt = $db->prepare ( "SELECT username FROM users WHERE username= :username" );
	$selectStmnt->execute ( array (
			':username' => $username 
	) );
	$status = $selectStmnt->fetch ();
	
	if ($status) {
		echo "Username already exists";
	} else {
		$stmt = $db->prepare ( "INSERT INTO users values(NULL, :name, :pass, :email, :createddate)" );
		$stmt->execute ( array (
				':name' => $username,
				':pass' => $password,
				':email' => $email,
				':createddate' => $currentDate 
		) );
	}
	$_SESSION ['error'] = "Signup complete";
	header ( "Location: index.php" );
} catch ( Exception $e ) {
	echo 'Caught exception: ', $e->getMessage (), "\n";
}

