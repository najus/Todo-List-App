<?php
session_start ();
require ("top.html");
require ("db-connection.php");
$error = null;
if (isset ( $_SESSION ['error'] )) {
	$error = $_SESSION ['error'];
	unset ( $_SESSION ['error'] );
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
</div>

<?php
require ("bottom.html");
?>