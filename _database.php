<?php
	function db_init($user, $pass, $database) { 
		try {
			$user = mysqli_escape_string($user);
			$pass = mysqli_escape_string($pass);
			$database = mysqli_escape_string($database);
			
			$db = new mysqli('localhost', $user, $pass, $database);
			
			if( $db->connect_error ) {
				throw new Exception("mysqli(localhost) failed");
			}
			
			return $db;
		} catch ( Exception $ex ) {
			error_log("[error]: " . $ex->getMessage());
			return null;
		}
	}