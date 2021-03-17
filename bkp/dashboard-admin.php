<?php include './access_control/admin_auth.php'; ?> 
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>
    </head>
    <body>
        <!--navbar-->
		<?php include 'includes/backend-navbar.php'; ?> 
        <!--body content-->
        <section>
            <div class="container wrapper">


                <div class="row justify-content-center mt-5 mb-1">
					<div class="col-lg-12 col-sm-12 text-center">
						<h4><i class="fa fa-cogs"></i> Administrative Configuration</h4>		
					</div>
				</div>
                <div class="row">								
                    <div class="col-lg-2 col-sm-3 col-xs-12 hvr-grow">
                        <a href="addnewadmin.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-users fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-users fa-lg"></i> Admin</h5>
                                    <p class="card-text"><small>Manage System Admins</small></p>
                                </div>                           
                            </div>
                        </a>
                    </div>	
					<div class="col-lg-2 col-sm-3 col-xs-12 hvr-grow">
                        <a href="manage-errand-runners.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-users fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-users fa-lg"></i> Errand Runners</h5>
                                    <p class="card-text">Manage Errand Runners</p>
                                </div>                           
                            </div>
                        </a>
                    </div>  
					<div class="col-lg-2 col-sm-3 col-xs-12 hvr-grow">
                        <a href="manage-errand-requester.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-users fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-users fa-lg"></i> Errand Requester</h5>
                                    <p class="card-text">Manage Errand Requester</p>
                                </div>                           
                            </div>
                        </a>
                    </div>  
					<div class="col-lg-2 col-sm-3 col-xs-12 hvr-grow">
                        <a href="setting.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-cogs fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-cogs fa-lg"></i> Front-End</h5>
                                    <p class="card-text"><small>Configure Front-End Settings</small></p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-sm-3 col-xs-12 hvr-grow">
                        <a href="pages-and-sections.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-file-alt fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-file fa-lg"></i> Pages & Sections</h5>
                                    <p class="card-text"><small>Manage Pages & home page sections</small></p>
                                </div>                           
                            </div>
                        </a>
                    </div>                  			
                </div> 
				<div class="row justify-content-center mt-5 mb-1">
					<div class="col-lg-12 col-sm-12 text-center">
						<h4><i class="fa fa-cogs"></i> Web Application Modules</h4>		
					</div>
				</div>
				<div class="row">								
                    <div class="col-lg-2 col-sm-3 col-xs-12 hvr-grow">
                        <a href="errand-categories.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-th fa-lg fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-th fa-lg"></i> Errand Categories</h5>
                                    <p class="card-text"><small>Errand Categories</small></p>
                                </div>                           
                            </div>
                        </a>
                    </div>	
				</div>


            </div>
        </section>
		<?php
		include './includes/end-block.php';
		include './includes/commonJS.php';
		?>       
    </body>
</html>