<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include ("db-connection.php");
/* @var $_POST type */
$username = filter_input ( INPUT_POST, "name" );
$password = filter_input ( INPUT_POST, "password" );
$email = filter_input ( INPUT_POST, "email" );
$currentDate = date ( 'Y-m-d' );
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
} catch ( Exception $e ) {
	echo 'Caught exception: ', $e->getMessage (), "\n";
}

