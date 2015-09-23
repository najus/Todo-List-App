<?php
include 'db-connection.php';
require 'posts.php';
session_start ();
$comment_data = filter_input ( INPUT_POST, 'newcomment' );
$post_id = filter_input(INPUT_POST, "postid");
$user_id = $_SESSION ['user_id'];
$current_date = date ( 'Y-m-d H:i:s' );

$stmt = $db->prepare ( "Insert into comments values(NULL, :comment, :userid, :itemid, :createddate)" );
$status = $stmt->execute ( array (
		':comment' => $comment_data,
		':userid' => $user_id,
		':itemid' => $post_id,
		':createddate' => $current_date
) );

$comments = getAllComments($post_id);
echo json_encode($comments);
?>