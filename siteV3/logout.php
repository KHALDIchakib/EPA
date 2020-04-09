<?php
	require 'inc/db.php';
	session_destroy();

	header('Location: index.html');
?>
