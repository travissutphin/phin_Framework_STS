<?php
/* LOGIN.VIEW */
/*****************************************************************/
include('../_system/config.php');
include('controller.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/favicon.ico">

    <title>MinimalPro Admin - Log in </title>
  
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="<?php echo site_Url(); ?>assets/admin/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
	
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="<?php echo site_Url(); ?>assets/admin/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">
	
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo site_Url(); ?>assets/admin/ser/css/master_style.css">

	<!-- MinimalPro Admin Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo site_Url(); ?>assets/admin/ser/css/skins/_all-skins.css">	

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo site_Url(); ?>"> <?php echo $read_values_Sites['display_name']; ?> </a><h6>powered by Thorium CMS</h6>
  </div>

  <!-- /.login-logo -->
  <div class="login-box-body">

  <!--- MESSAGES --->

  	<?php if(isset($_GET['message'])) { echo messages($_GET['message']); } ?>
	<?php if(isset($_SESSION['message'])) { echo messages($_SESSION['message']); unset($_SESSION['message']); } ?>
						
	<?php if(isset($_REQUEST['display_form_register'])){ ?>
		
<!--- CREATE AN ACCOUNT --->
		
		<p class="login-box-msg">Create an account</p>
		<form name="login" action="view.php" method="post" role="form-element">
			<fieldset>
				<div class="form-group">
					<input class="form-control" placeholder="First Name" name="NAME_FIRST" type="text" autofocus>
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Last Name" name="NAME_LAST" type="text">
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Email" name="EMAIL" type="email">
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Temp password will be emailed to you" name="" type="text" value="" readonly="readonly">
				</div>
				<button name="create" type="submit" class="btn btn-info btn-block margin-top-10">Submit Registration</button>
			</fieldset>
		</form>
		
		<div class="margin-top-30 text-center">
			<p>Already have an account <a href="view.php" class="text-info m-l-5">Log in</a></p>
			<p>Forgot password? <a href="view.php?display_form_recover_password" class="text-info m-l-5">Recover password</a></p>
		</div>
	
	<?php }elseif(isset($_REQUEST['display_form_recover_password'])){ ?>

<!--- FORGOT PASSWORD --->

		<p class="login-box-msg">Recover Password</p>
		<form name="login" action="view.php" method="post" role="form-element">
			<fieldset>
				<div class="form-group">
					<input class="form-control" placeholder="Email" name="EMAIL" type="email" autofocus>
				</div>
				<button name="recover_password" type="submit" class="btn btn-info btn-block margin-top-10">Recover</button>
			</fieldset>
		</form>
		
		<div class="margin-top-30 text-center">
			<p>Already have an account <a href="view.php" class="text-info m-l-5">Log in</a></p>
			<p>Forgot password? <a href="view.php?display_form_recover_password" class="text-info m-l-5">Recover password</a></p>
		</div>
		
	<?php }else{ ?>

<!--- LOGIN FORM --->	
		
		<p class="login-box-msg">Log In</p>
		<form name="login" action="view.php" method="post" class="form-element">
		  <div class="form-group has-feedback">
			<input name="EMAIL" type="email" class="form-control" placeholder="Email">
			<span class="ion ion-email form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			<input name="PASSWORD" type="password" class="form-control" placeholder="Password">
			<span class="ion ion-locked form-control-feedback"></span>
		  </div>
		  <div class="row">

			<div class="col-12 text-center">
			  <button name="submit" type="submit" class="btn btn-info btn-block margin-top-10">LOG IN</button>
			</div>
			<!-- /.col -->
		  </div>
		</form>
	
	<div class="margin-top-30 text-center">
    	<p>Forgot password? <a href="view.php?display_form_recover_password" class="text-info m-l-5">Recover password</a></p>
		<p>Don't have an account? <a href="view.php?display_form_register" class="text-info m-l-5">Create an account</a></p>
    </div>
	
	<?php } ?>
	

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


	<!-- jQuery 3 -->
	<script src="<?php echo site_Url(); ?>assets/admin/assets/vendor_components/jquery/dist/jquery.min.js"></script>
	
	<!-- popper -->
	<script src="<?php echo site_Url(); ?>assets/admin/assets/vendor_components/popper/dist/popper.min.js"></script>
	
	<!-- Bootstrap 4.0-->
	<script src="<?php echo site_Url(); ?>assets/admin/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
