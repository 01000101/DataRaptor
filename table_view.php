<?php 
	require_once('_session.php');
	require_once('_database.php');
	
	if( isset($_GET['table']) && $_GET['table'] !== "" ) {
		if( ($db = db_init()) != null ) {
			$dbQuery = $db->query("SELECT * FROM $db->real_escape_string($_GET['table'])");
			$dbNumRows = $dbQuery->num_rows;
			$dbColumns = $dbQuery->fetch_fields();
			$dbRows = $dbQuery->fetch_array();
			
			var_dump($dbColumns);
			var_dump($dbRows);
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
					
					<h2 class="text-center">Abracadabra!</h2>
					<br /><br />
					
					<table class="table table-striped">
						<tr>
							<?php for($col = 0; $col < count($dbColumns); $col++ ) {
								echo "<th>$dbColumns[$col]->name</th>";
							} ?>
						</tr>
						
						<?php for($col = 0; $col < count($dbColumns); $col++ ) {
							echo "<tr>";
							for($row = 0; $row < $dbNumRows; $row++ ) {
								echo "<td>$dbRows[$row][$col]</td>";
							}
							echo "</tr>";
						} ?>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
