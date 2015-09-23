<?php
	date_default_timezone_set ( "America/Chicago" );
	$db = new PDO ( "mysql:dbname=todoappdb;host=localhost", "root", "root" );
	$db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>