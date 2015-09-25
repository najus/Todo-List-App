<?php
session_start ();
require ("top.html");

$error = null;
if (isset ( $_SESSION ['error'] )) {
	$error = $_SESSION ['error'];
	unset ( $_SESSION ['error'] );
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
<title>Sign up</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="container text-center pagination-centered">
		<div class="row">
			<div class="col-lg-12">
				<h1>Todo list app</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form action="signup-submit.php" method="POST">
					<fieldset>
						<legend> New User Sign up: </legend>
						<?php if ($error): ?>
						<div>
							<?= $error?>
						</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-md-4 col-md-offset-4">
								<p>
									<strong>Username: </strong><input type="text" name="name"
										maxlength="50" />
								</p>
								<p>
									<strong>E-mail: </strong><input type="email" name="email"
										maxlength="50" />
								</p>
								<p>
									<strong>Password: </strong><input type="password"
										name="password" maxlength="50" />
								</p>
								<p>
									<strong>Confirm: </strong><input type="password"
										name="confirmpassword" maxlength="50" />
								</p>
								<p>
									<input type="submit" class="btn btn-success" value="Sign Up" />
								</p>
								<p>
									<a href="index.php">Login</a>
								</p>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php
require ("bottom.html");
?>