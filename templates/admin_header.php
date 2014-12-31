<?php include('../_system/config.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Start Bootstrap - SB Admin Version 2.0 Demo</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo site_Url(); ?>assets/sb-admin-v2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo site_Url(); ?>assets/sb-admin-v2/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Tables -->
    <link href="<?php echo site_Url(); ?>assets/sb-admin-v2/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo site_Url(); ?>assets/sb-admin-v2/css/plugins/multiselect/bootstrap-multiselect.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo site_Url(); ?>assets/sb-admin-v2/css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">












<?php /*?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITLE; ?></title>
<link href="<?php echo site_Url(); ?>assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo site_Url(); ?>assets/css/bootstrap-custom.css" rel="stylesheet">
<link href="<?php echo site_Url(); ?>assets/css/bootstrap-third-party.css" rel="stylesheet">
<link href="<?php echo site_Url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo site_Url(); ?>assets/css/calendar.css" rel="stylesheet">
<link href="<?php echo site_Url(); ?>assets/css/bootstrap-timepicker.css" rel="stylesheet">
<link href="<?php echo site_Url(); ?>assets/css/datepicker.css" rel="stylesheet">
<link href="<?php echo site_Url(); ?>assets/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo site_Url(); ?>modules/control_panel/"><?php echo TITLE; ?></a>
    
          <div class="nav-collapse collapse">
            <ul class="nav">            

              <li><a href="<?php echo site_Url(); ?>modules/control_panel/">Control Panel</a></li>
                           
              <?php if($_SESSION['users.role'] == "Admin") { ?>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin Tools <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo site_Url(); ?>modules/users/">Users</a></li>
                  <li><a href="<?php echo site_Url(); ?>modules/roles/">Roles</a></li>
                </ul>
              </li> 
              <?php } ?> 
               
            </ul>
            
            
            <p class="navbar-text pull-right">
            	<?php echo ucfirst($_SESSION['users.name_first']).' '.ucfirst($_SESSION['users.name_last']); ?>
                &nbsp;&nbsp; | &nbsp;&nbsp;
                <a href="<?php echo site_Url(); ?>index.php?message=logout" class="navbar-link">Logout</a>
            </p>
              
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>   

<!-- [s] main content -->
<div class="container-fluid">
  <div class="row-fluid"><?php */?>