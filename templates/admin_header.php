<?php include('../_system/config.php'); ?>
<?php include('../templates/controller.php'); ?>
<?php is_logged_in_Security(); ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Start Bootstrap - SB Admin Version 2.0 Demo </title>

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
	
	<?php echo detect_ip_address_Security(); ?>