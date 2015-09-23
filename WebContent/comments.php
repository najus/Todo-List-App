<?php
include 'db-connection.php';
require 'posts.php';
session_start ();
$post_id = filter_input ( INPUT_POST, 'postId' );

$comments = getAllComments($post_id);
echo json_encode($comments);
?>