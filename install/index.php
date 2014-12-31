<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>phin FrameWork Installation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Core CSS - Include with every page -->
    <link href="../assets/sb-admin-v2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/sb-admin-v2/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Tables -->
    <link href="../assets/sb-admin-v2/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../assets/sb-admin-v2/css/plugins/multiselect/bootstrap-multiselect.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="../assets/sb-admin-v2/css/sb-admin.css" rel="stylesheet">

  </head>

  <body>
<?php include('functions.php'); ?>
<?php include('steps.php'); ?>
<?php $msg_to_user = ""; ?>
<?php if(!isset($_SESSION['server'])){param_default();} ?>

<?php
if(isset($_POST['step4'])) 
	{
		$_SESSION['prefix'] = $_POST['prefix'];
		//--- write config file ---//
		create_config_file();
		//--- display step 4 ---//
		$msg_to_user = 'Congrats!  Your new App is ready to go. You will be automatically redirected';
		step4($msg_to_user);
		//--- kill session vars ---//
		session_unset();
	}
	elseif(isset($_POST['step3'])) 
	{
		//--- test the db connection with posted vars ---//
		$connect = db_connect_test($_POST['server'],$_POST['database'],$_POST['user'],$_POST['password']);
		//--- does the database exist ---//
		if($connect == "db_doesnt_exist")
		{
			//--- save posted vars ---//
			$_SESSION['create_db_option'] = "true";
			$_SESSION['server'] = $_POST['server'];
			$_SESSION['database'] = $_POST['database'];
			$_SESSION['user'] = $_POST['user'];
			$_SESSION['password'] = $_POST['password'];
			//--- display step 2 ---//
			$msg_to_user = 'Connection successfull, however, <strong>'.$_POST['database'].'</strong> database doesn\'t exist.';
			step2($msg_to_user);
		}
		elseif($connect == "true")
		{
			//--- save posted vars ---//
			$_SESSION['server'] = $_POST['server'];
			$_SESSION['database'] = $_POST['database'];
			$_SESSION['user'] = $_POST['user'];
			$_SESSION['password'] = $_POST['password'];
			//--- display step 3 ---//
			$msg_to_user = 'Connection successful and database <strong>'.$_SESSION['database'].'</strong> <br />Time to create the database structure.';
			step3($msg_to_user);
		}
		else
		{
			//--- save posted vars ---//
			$_SESSION['server'] = $_POST['server'];
			$_SESSION['database'] = $_POST['database'];
			$_SESSION['user'] = $_POST['user'];
			//--- display step 2 ---//
			$msg_to_user = 'Not able to connect to your database with those credentials.';
			step2($msg_to_user);
		}
	}
	elseif(isset($_POST['step2x1'])) 
	{
		//--- create database ---//
		create_database();
		//--- display step 3 ---//
		$msg_to_user = 'Database <strong>'.$_SESSION['database'].'</strong> has been created.<br />Time to create the database structure.';
		step3($msg_to_user);
	}
	elseif(isset($_POST['step2'])) 
	{
		//--- save posted vars ---//
		$_SESSION['base_url'] = $_POST['base_url'];
		$_SESSION['database'] = $_POST['database'];
		$_SESSION['key'] = $_POST['key'];
		//--- display step 2 ---//
		step2($msg_to_user);
	}
	elseif(isset($_POST['reset'])) 
	{
		//--- kill session vars ---//
		session_unset();
		//--- set vars to default ---//
		param_default();
		//--- display step 1 ---//
		$msg_to_user = 'All data has been cleared.';
		step1($msg_to_user);
	}
	else
	{
		//--- display step 1 ---//	
		step1();
	}
?>
    <!-- Core Scripts - Include with every page -->
    <script src="../assets/sb-admin-v2/js/jquery-1.10.2.js"></script>
    <script src="../assets/sb-admin-v2/js/bootstrap.min.js"></script>
    <script src="../assets/sb-admin-v2/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../assets/sb-admin-v2/js/sb-admin.js"></script>

    <!-- Page-Level Plugin Scripts - Tables -->
    <script src="../assets/sb-admin-v2/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/sb-admin-v2/js/plugins/dataTables/dataTables.bootstrap.js"></script>
	<script src="../assets/sb-admin-v2/js/plugins/multiselect/bootstrap-multiselect.js"></script>

  </body>
</html>
