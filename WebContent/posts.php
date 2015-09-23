<?php
require 'db-connection.php';
function getAllPosts() {
	global $db;
	$stmt_post = $db->prepare ( "SELECT * FROM todolist WHERE item_done = :item_done ORDER BY item_id DESC" );
	$stmt_post->execute ( array (
			':item_done' => 0 
	) );
	
	$posts = $stmt_post->fetchAll ();
	
	return $posts;
}
function getAllComments($post_id) {
	global $db;
	$stmt_comment = $db->prepare ( "SELECT * FROM comments WHERE item_id = :item_id" );
	$stmt_comment->execute ( array (
			':item_id' => $post_id 
	) );
	$comments = $stmt_comment->fetchAll ();
	return $comments;
}
function getUserPost($user_id) {
	global $db;
	$stmt_post = $db->prepare ( "SELECT * FROM todolist WHERE user_id = :user_id AND item_done = :item_done ORDER BY item_id DESC" );
	$stmt_post->execute ( array (
			':user_id' => $user_id,
			':item_done' => 0 
	) );
	
	$posts = $stmt_post->fetchAll ();
	
	return $posts;
}
function updatePost($post_id, $updated_post, $user_id) {
	global $db;
	$stmt_post = $db->prepare ( "UPDATE todolist SET item_text = :updated_post WHERE user_id = :user_id AND item_id = :post_id" );
	$stmt_post->execute ( array (
			':item_text' => $updated_post,
			':user_id' => $user_id,
			':item_id' => $post_id 
	) );
}
function updateComment($comment_id, $updated_comment, $user_id) {
	global $db;
	$stmt_post = $db->prepare ( "UPDATE comments SET comment_text = :updated_comment WHERE user_id = :user_id AND comment_id = :comment_id" );
	$stmt_post->execute ( array (
			':comment_text' => $updated_comment,
			':user_id' => $user_id,
			':comment_id' => $comment_id 
	) );
}
function deletePost($post_id, $user_id) {
	global $db;
	$stmt_post = $db->prepare ( "DELETE FROM todolist WHERE user_id = :user_id AND item_id = :post_id" );
	$stmt_post->execute ( array (
			':user_id' => $user_id,
			':post_id' => $post_id 
	) );
	return $stmt_post->rowCount();
}
function deleteComment($comment_id, $user_id) {
	global $db;
	$stmt_post = $db->prepare ( "DELETE FROM comments WHERE user_id = :user_id AND comment_id = :comment_id" );
	$stmt_post->execute ( array (
			':user_id' => $user_id,
			':comment_id' => $comment_id 
	) );
	return $stmt_post->rowCount();
}
function markTaskAsDone($post_id, $user_id) {
	global $db;
	$stmt_post = $db->prepare ( "UPDATE todolist SET item_done = :item_done WHERE user_id = :user_id AND item_id = :post_id" );
	$stmt_post->execute ( array (
			':item_done' => 1,
			':user_id' => $user_id,
			':post_id' => $post_id 
	) );
	return $stmt_post->rowCount();
}
?>