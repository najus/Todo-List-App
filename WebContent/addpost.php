<?php
include 'db-connection.php';
session_start ();
$postData = filter_input ( INPUT_POST, 'newpost' );
$userId = $_SESSION ['user_id'];
$currentDate = date ( 'Y-m-d' );

$stmt = $db->prepare ( "Insert sinto todolist values(NULL, :post, :itemdone, :userid, :createddate)" );
$status = $stmt->execute ( array (
		':post' => $postData,
		':itemdone' => 0,
		':userid' => $userId,
		':createddate' => $currentDate 
) );

print $status;

?>
