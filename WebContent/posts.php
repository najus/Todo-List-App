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

?>