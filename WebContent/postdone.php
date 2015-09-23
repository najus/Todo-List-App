<?php
include 'db-connection.php';
require 'posts.php';
session_start ();
$post_id = filter_input ( INPUT_POST, 'postId' );
$user_id = $_SESSION ['user_id'];

$status = markTaskAsDone ( $post_id, $user_id );
echo ($status);
?>