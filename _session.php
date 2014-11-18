<?php
	session_start();
	
	// User is not allowed here, send them back to the gate keeper
	if( !isset($_SESSION['db_username']) || $_SESSION['db_username'] === "" ||
	    !isset($_SESSION['db_password']) || $_SESSION['db_password'] === "" ||
		!isset($_SESSION['db_database']) || $_SESSION['db_database'] === "" ||
		!isset($_SESSION['db_server']) || $_SESSION['db_server'] === "" ) {
		session_destroy();
		header('Location: login.php');
		die(); // Muahaha
	}