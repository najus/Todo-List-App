<?php
session_start ();
require ("top.html");
// require ("db-connection.php");
$error = null;
if (isset ( $_SESSION ['error'] )) {
	$error = $_SESSION ['error'];
	unset ( $_SESSION ['error'] );
}
?>

<div class="container text-center pagination-centered">
	<div class="row">
		<div class="col-lg-12">
			<h1>Todo list app</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<form action="login-submit.php" method="POST">
				<fieldset>
					<legend>Login:</legend>
		<?php if ($error): ?>
        	<div class="highlight"><?= $error ?></div>
    	<?php endif; ?>
    	<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<p>
								<span class="column">Username:</span> <input type="text"
									size="16" name="username" />
							</p>
							<p>
								<span class="column">Password:</span> <input type="password"
									size="16" name="password" />
							</p>
							<p>
								<input type="submit" class="btn btn-success" value="Submit" />
							</p>
						</div>
					</div>
					<p class="signup">
						<a href="signup.php">Sign up</a>
					</p>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<?php
require ("bottom.html");
?>