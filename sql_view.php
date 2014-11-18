<?php 
	require_once('_session.php');
	require_once('_database.php');
	
	$db = db_init();
	$dbName = $_SESSION['db_database'];
	$dbQuery = $db->query('SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = "$dbName"');
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
							while( ($row = $dbQuery->fetch_assoc()) ) {
								$tableName = $row['TABLE_NAME'];
								$tableRowCount = $row['TABLE_ROWS'];
								$tableDescription = $row['TABLE_COMMENT'];
								
								echo "<a href='table_view.php?table=$tableName' class='list-group-item active'>";
								echo "<h4 class='list-group-item-heading'>$tableName</h4>";
								echo "<p class='list-group-item-text'>Number of entries: $tableRowCount<br />Description: $tableDescription</p>";
							}
						?>
					</div>
					
					
					<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4 class="list-group-item-heading">List group item heading</h4>
    <p class="list-group-item-text">...</p>
  </a>
</div>
				</div>
			</div>
		</div>
	</body>
</html>
