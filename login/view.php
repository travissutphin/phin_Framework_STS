<?php
/* LOGIN.VIEW */
/*****************************************************************/
include('../_system/config.php');
include('controller.php'); 
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Start Bootstrap - SB Admin Version 2.0 Demo</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo site_Url(); ?>assets/sb-admin-v2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo site_Url(); ?>assets/sb-admin-v2/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo site_Url(); ?>assets/sb-admin-v2/css/sb-admin.css" rel="stylesheet">

</head>

<body>

<?php if(isset($_REQUEST['display_form_register'])){ ?>

<!--- REGISTER NEW USER FORM --->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register</h3>
						<?php if(isset($_GET['message'])) { echo messages($_GET['message']); } ?>
						<?php if(isset($_SESSION['message'])) { echo messages($_SESSION['message']); unset($_SESSION['message']); } ?>
                    </div>
                    <div class="panel-body">
                        <form name="login" action="view.php" method="post" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="First Name" name="NAME_FIRST" type="text" autofocus>
                                </div>
								<div class="form-group">
                                    <input class="form-control" placeholder="Last Name" name="NAME_LAST" type="text">
                                </div>
								<div class="form-group">
                                    <input class="form-control" placeholder="Email" name="EMAIL" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Temp password will be emailed to you" name="" type="text" value="" readonly="readonly">
                                </div>
                                <button name="submit" type="submit" class="btn btn-md btn-success btn-block">Submit Registration</button>
								<button name="display_form_login" type="submit" class="btn btn-md btn-block">Login Here</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }else{ ?>

<!--- LOGIN EXISTING USER --->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
						<?php if(isset($_GET['message'])) { echo messages($_GET['message']); } ?>
						<?php if(isset($_SESSION['message'])) { echo messages($_SESSION['message']); unset($_SESSION['message']); } ?>
                    </div>
                    <div class="panel-body">
                        <form name="login" action="view.php" method="post" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="EMAIL" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="PASSWORD" type="password" value="">
                                </div>
                                <button name="submit" type="submit" class="btn btn-md btn-success btn-block">Login</button>
								<button name="display_form_register" type="submit" class="btn btn-md btn-block">Register</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
	
    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/jquery-1.10.2.js"></script>
    <script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/bootstrap.min.js"></script>
    <script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/sb-admin.js"></script>

</body>

</html>
