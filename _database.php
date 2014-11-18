<?php
	function db_init() { 
		try {
			
			$db = new mysqli($_SESSION['db_server'],
							 $_SESSION['db_username'],
							 $_SESSION['db_password'],
							 $_SESSION['db_database']);
			
			if( $db->connect_error ) {
				throw new Exception("mysqli() failed");
			}
			
			return $db;
		} catch ( Exception $ex ) {
			error_log("[error]: " . $ex->getMessage());
			return null;
		}
	}