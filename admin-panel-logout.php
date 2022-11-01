<?php
	session_start();
	$_SESSION = array();
	session_destroy();

    $location = 'admin-panel-login.php';
    header("Location: {$location}");
?>