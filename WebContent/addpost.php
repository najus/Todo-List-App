<?php
include 'db-connection.php';
require 'posts.php';
session_start ();
$postData = filter_input ( INPUT_POST, 'newpost' );
$userId = $_SESSION ['user_id'];
$currentDate = date ( 'Y-m-d H:i:s' );

$stmt = $db->prepare ( "Insert into todolist values(NULL, :post, :itemdone, :userid, :createddate)" );
$status = $stmt->execute ( array (
		':post' => $postData,
		':itemdone' => 0,
		':userid' => $userId,
		':createddate' => $currentDate 
) );

$posts = getAllPosts();
// print_r($posts);
echo json_encode($posts);

?>
