<?php 
	require_once('_session.php');
	require_once('_database.php');
	
	if( isset($_GET['table']) && $_GET['table'] !== "" ) {
		if( ($db = db_init()) != null ) {
			$tname = $db->real_escape_string($_GET['table']);
			$dbQuery = $db->query("SELECT * FROM " . $tname);
			$dbNumRows = $dbQuery->num_rows;
			$dbColumns = $dbQuery->fetch_fields();

			var_dump($dbColumns);
		} else {
			$error = "Could not connect to the database";
		}
	} else {
		header('Location: sql_view.php');
		die();
	}
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
				<div class="col-xs-12 col-lg-10 col-lg-offset-1">
					<?php if( isset($error) && $error ) { ?> 
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
							<strong>Error</strong> <?php echo $error; ?>
						</div>
					<?php } ?>
					
					<h2 class="text-center">Abracadabra!</h2>
					<br /><br />
					
					<table class="table table-striped">
						<tr>
							<?php for($col = 0; $col < count($dbColumns); $col++ ) {
								$colName = $dbColumns[$col]->name;
								echo "<th>$colName</th>";
							} ?>
						</tr>
						
						<?php while( ($row = $dbQuery->fetch_assoc()) ) {
							echo "<tr>";
							for($col = 0; $col < count($dbColumns); $col++ ) {
								$colName = $dbColumns[$col]->name;
								
								if( $colName === 'application' ||
								    $colName === 'file_design' ||
									$colName === 'file_consent' ) {
									$item = "<a href=\"$row[$colName]\">$row[$colName]</a>";
								} else {
									$item = $row[$colName];
								}
								echo "<td>$item</td>";
							}
							echo "</tr>";
						} ?>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
