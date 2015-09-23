<?php
include 'db-connection.php';
require 'posts.php';

$posts = getAllPosts();
echo json_encode($posts);
?>