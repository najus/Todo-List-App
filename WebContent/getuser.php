<?php
include 'db-connection.php';
require 'posts.php';
$user_id = filter_input(INPUT_POST, "userId");

$username = getUser($user_id);
echo $username;
?>