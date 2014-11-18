<?php 
	require_once('_session.php');
	require_once('_database.php');
	
	$db = db_init();
	$dbQuery = $db->query('SHOW TABLES');
	$dbNumTables = $dbQuery->num_rows;
	$dbTables = $dbQuery->fetch_array();
?>

<!DOCTYPE html>

<html> <!-- Login form -->
	<head>
		<title>DataRaptor - Database Exploration Portal</title>
		
		<?php require_once('_header.php'); ?>
	</head>

	<body>
		<div class="container-fluid">
			<?php include_once('_nav.php'); ?>
			
			<div class="row">
				<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-6 col-lg-offset-3">
					<?php if( isset($error) && $error ) { ?> 
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
							<strong>Error</strong> <?php echo $error; ?>
						</div>
					<?php } ?>
					
					<h2 class="text-center">Select a table to view</h2>
					<br /><br />
					
					<div class="list-group">
						<?php
							for($i = 0; $i < $dbNumTables; $i++) {
								echo "<a href='#$dbTables[0]' class='list-group-item'>$dbTables[0]</a>";
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
