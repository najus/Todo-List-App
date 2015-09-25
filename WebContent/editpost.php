<?php
include 'db-connection.php';
require 'posts.php';
session_start ();
$post_id = filter_input ( INPUT_POST, 'postId' );
$post = filter_input ( INPUT_POST, 'post' );
$user_id = $_SESSION ['user_id'];

$status = editPost($post_id, $post, $user_id);
echo ($status);
?>