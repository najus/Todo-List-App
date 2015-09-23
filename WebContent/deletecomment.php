<?php
include 'db-connection.php';
require 'posts.php';
session_start ();
$comment_id = filter_input ( INPUT_POST, 'commentId' );
$user_id = $_SESSION ['user_id'];
$status = deleteComment ( $comment_id, $user_id );
echo ($status);
?>