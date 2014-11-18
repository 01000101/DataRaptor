<?php // POST handling
	include_once('_session.php');

	$error = null;
	$inServer = '0.0.0.0';
	
	if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' &&
		isset($_POST['submit_btn']) ) {
		try {
			$inUsername = strip_tags(trim($_POST['inUsername']));
			$inPassword = strip_tags(trim($_POST['inPassword']));
			$inDatabase = strip_tags(trim($_POST['inDatabase']));
			
			if( $inUsername === "" || $inPassword === "" || $inDatabase === "" )
				throw new ErrorException("All fields are required. Please try again.");
			
			switch( $inDatabase ) {
				case "rockon": {
					$inDatabase = 'rockonfoundation';
					$inServer = '172.16.2.12';
				} break;
				
				default: {
					throw new ErrorException("Invalid database selected");
				} break;
			}
			
			$mysqli = new mysqli($inServer, $inUsername, $inPassword, $inDatabase);
			
			if( $mysqli->connect_error )
				throw new ErrorException($mysqli->connect_error);
			
			
			
		} catch( Exception $ex ) {
			$error = $ex->getMessage();
		}
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
					<h2 class="text-center">Please enter your credentials and select a database to view</h2>
					
					<?php if( isset($error) && $error ) { ?> 
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
							<strong>Error</strong> <?php echo $error; ?>
						</div>
					<?php } ?>
					
					<br /><br />
					<form class="form-horizontal" role="form" method="post">
						<div class="form-group">
							<label for="inUsername" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inUsername" name="inUsername" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label for="inPassword" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="inPassword" name="inPassword" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<label for="inDatabase" class="col-sm-2 control-label">Database</label>
							<div class="col-sm-10">
								<select id="inDatabase" name="inDatabase" class="form-control">
									<option value="rockon" selected="selected">Rock On Foundation</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" id="submit_btn" name="submit_btn" class="btn btn-default">Sign in</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
