<?php include './access_control/superadmin_auth.php'; ?> 
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
                <div class="row">
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="user.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-users fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-users fa-lg"></i> Users</h5>
                                    <p class="card-text">Configure Users</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-female fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-users fa-lg"></i> Models</h5>
                                    <p class="card-text">Configure Models</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-cog fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-users fa-lg"></i> Front End Settings</h5>
                                    <p class="card-text">Configure Front End Website Data</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-cogs fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-users fa-lg"></i> System Settings</h5>
                                    <p class="card-text">Configure System Common Settings and Payment Settings</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-file fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-users fa-lg"></i> Order</h5>
                                    <p class="card-text">Manage Customer Orders</p>
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