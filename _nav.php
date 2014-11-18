			<nav class="navbar navbar-default" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#" style="padding: 0 !important;">
						<img alt="DataRaptor" src="/style/images/logo.png" height="50">
					</a>
				</div>
			
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<?php if( $_SESSION['current_db'] ) { ?>
							<li><a href="/login.php">Change Database</a></li>
						<?php } ?>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>