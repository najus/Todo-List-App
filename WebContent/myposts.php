<?php
include 'db-connection.php';
require 'posts.php';
session_start ();
$user_id = $_SESSION ['user_id'];

$posts = getUserPost($user_id);
echo json_encode($posts);
?>