<?php
session_start ();
require ("posts.php");

if (isset ( $_SESSION ['username'] )) {
	$username = $_SESSION ['username'];
	$user_id = $_SESSION ['user_id'];
	
	$posts = getAllPosts();
} else {
	$_SESSION ['error'] = "Please login first";
	header ( "Location: index.php" );
	exit ();
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/listgroup.css" rel="stylesheet" type="text/css"/>
        <script src="scripts/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <script src="scripts/todo.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <div class="row form-group">
                <div class="col-md-10 col-lg-offset-1">
                    <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Add Todo</div>
                        <div class="panel-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Todo.." id="txtNewTodo">

                                <span class="input-group-addon success" id="btnSaveTodo">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </span>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="col-md-2">
                        <label>Filter By:</label>
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <button id="btnAllList" type="button" class="btn btn-default active">All</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button id="btnMyList" type="button" class="btn btn-default">My Todo</button>
                            </div></div>
                    </div></div>
            </div>



            <div class="row">
                <div class="col-md-10 col-lg-offset-1">
                    <hr class="hr-primary" />
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-list"></span>Todo Lists
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                            <?php foreach($posts as $post): ?>
                                <li class="list-group-item titleBox" id="<?= $post["item_id"] ?>">                            
                                    <label id="item-<?= $post["item_id"] ?>"><?= $post["item_text"] ?></label>
                                    <div class="pull-right action-buttons" id="action-buttons-<?= $post["item_text"] ?>">
                                        <a id="editList-<?= $post["item_id"] ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a id="deleteList-<?= $post["item_id"] ?>" class="post-trash trash"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a id="markList-<?= $post["item_id"] ?>" class="flag"><span class="glyphicon glyphicon-ok"></span></a>
                                    </div>
                                    <div class="actionBox" id="actionBox-<?= $post["item_id"] ?>">
                                        <ul class="commentList" id="commentList-<?= $post["item_id"] ?>">
                                        	<? $comments = getAllComments($post["item_id"]); foreach ($comments as $comment): ?>
	                                            <li>
	                                                <div class="commentText" id="commentText-<?= $comment["comment_id"]?>">
	                                                    <p class=""><?= $comment["comment_text"] ?></p> 
	                                                    <div class="pull-right action-buttons">
	                                                        <a id="editComment-<?= $comment["comment_id"]?>"><span class="glyphicon glyphicon-pencil"></span></a>
	                                                        <a id="deleteComment-<?= $comment["comment_id"]?>" class="comment-trash trash"><span class="glyphicon glyphicon-trash"></span></a>
	                                                    </div>
	                                                    <span class="date sub-text">By <?= $comment["user_id"] ?> on <?= $comment["created_date"] ?></span>
	                                                </div>
	                                            </li>
                                        	<? endforeach; ?>
                                        </ul>
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <input class="form-control" id="form-control-<?= $post["item_id"] ?>" type="text" placeholder="Your comments" />
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success" id="btn-<?= $post["item_id"] ?>">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <? endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
