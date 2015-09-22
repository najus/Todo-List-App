<?php
session_start ();
require ("top.html");
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
<div class="container text-center pagination-centered">
	<div class="col-lg-12">
		<h1>Todo list app</h1>
	</div>
</div>
<div class="container text-center pagination-centered">
	<div class="row">
		<div class="col-lg-12">
			<span> New post: </span><input class="new-post add-post-height"
				id="newpost" type="text" />
			<button id="submit-post" class="btn-primary add-post-height">+ Add</button>
		</div>
	</div>
	<div id="posts">
	<?php foreach ($posts as $post):?>
		<div class="row posts">
			<div class="col-lg-12 <?php
			
			if ($user_id === $post ['user_id']) {
				echo "admin";
			} else {
				echo "user";
			}
			?>"><?php echo ($post['item_text']);
			$comments = getAllComments($post['item_id']);
			foreach ($comments as $comment):
			?>
			<div class="row comments">
				<div class="col-lg-6 <?php
			
			if ($user_id === $post ['user_id']) {
				echo "admin";
			} else {
				echo "user";
			}
			?>"><?= $comment['comment_text'] ?></div>
			</div>
			<?php endforeach;?>
			<input type="text" /><button class="btn-primary add-post-height">+ Comment</button>
			</div>
		</div>
	<?php endforeach;?>
	</div>
</div>

<?php
require ("bottom.html");
?>