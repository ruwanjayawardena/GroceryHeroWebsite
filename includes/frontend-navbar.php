<nav class="navbar navbar-expand-lg bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand hvr-backward" href="index.php">
			<span class="logoDisplyModule"></span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">			
			<i class="fas fa-bars fa-inverse" id="mobiletogglebutton"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent"> 
			<div class="container">
				<div class="row justify-content-left">

					<div class="col-lg-9 col-12">						
						<ul class="navbar-nav loadadwebsite float-lg-right pt-3">

						</ul>
					</div>
					<div class="col-lg-3 col-12 text-right">
						<?php
						if (isset($_SESSION['usr_id']) && !empty($_SESSION['usr_id'])) {
							?>
							<div class="row">
								<div class="col-12">
									<div class="navbar-text text-light">
										<i class="fas fa-user-circle fa-lg fa-inverse"></i> Welcome, <?php echo $_SESSION['usr_first_name']; ?> 
									</div>
								</div>
								<div class="col-12">								
									<button class="btn btn-sm btn-outline-dark" onclick="navigateDashboard();">Dashboard</button>
									<button class="btn btn-sm btn-outline-danger logout"><i class="fas fa-power-off"></i></button>
								</div>
							</div>
							<?php
						}
						?>
						<?php if (!isset($_SESSION['usr_id']) && empty($_SESSION['usr_id'])) { ?>
							<div class="row">
								<div class="col-12 text-center">
									<button class="btn btn-light btn-block" id="btn-login" onclick="window.location.href = 'login.php'"><i class="fas fa-sign-in-alt"></i> Sign in</button>&nbsp;							
									<button class="btn btn-link text-dark" style="font-size: 0.8rem;text-decoration: underline" onclick="window.location.href = 'signup.php'"><i class="fas fa-user-plus"></i> Join Now</button>
<!--									<button class="btn btn-link text-dark" style="font-size: 0.8rem;text-decoration: underline" onclick="window.location.href = 'signup.php'"><i class="fas fa-user-plus"></i> Join Now</button>-->
								</div>
							</div>						

						<?php } ?>
					</div>
				</div>
			</div>
		</div>

	</div>

</nav>
<div class="sysMessage w-100" hidden></div>

