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

<div class="container">
	<h1>Todo list app</h1>
</div>
<form action="login-submit.php" method="POST">
	<fieldset>
		<legend>Login:</legend>
		<?php if ($error): ?>
        	<div><?= $error ?></div>
    	<?php endif; ?>
		<p>
			<span class="column">Username:</span> <input type="text" size="16"
				name="username" />
		</p>
		<p>
			<span class="column">Password:</span> <input type="password"
				size="16" name="password" />
		</p>
		<p>
			<input type="submit" value="Submit" />
		</p>
	</fieldset>

</form>

<?php
require ("bottom.html");
?>