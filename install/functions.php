<?php
	session_start();
##########################################################################
	function database_connection($s,$d,$u,$p)
	{
		$server = $s;
		$database = $d;
		$user = $u;
		$password = $p;
		$connection = mysql_connect($server, $user, $password);
		if(isset($d)){$db = mysql_select_db("$d",$connection) or die(mysql_error());} 	
		return $connection;
	}
##########################################################################
	function get_base_url()
	{
		$base_url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$base_url = 'http://'.str_replace('install/', "", $base_url);
		$base_url = str_replace('index.php', "", $base_url);
		$_SESSION['app_directory'] = str_replace('install/', "", $_SERVER["REQUEST_URI"]);
		return $base_url;
	}
##########################################################################
	function get_config_path()
	{
		$config_path = getcwd();
		$config_path = str_replace('\\install', "", $config_path);
		//$config_path = $config_path.'\\application\\config\\';
		$config_path = $config_path.'\\_system\\';
		return $config_path;
	}
##########################################################################
	function db_connect_test($s,$d,$u,$p)
	{
		$server = $s;
		$database = $d;
		$user = $u;
		$password = $p;
		
		$connect = @mysql_connect($server, $user, $password, TRUE);
		
		if($connect)
		{
			$db = mysql_select_db("$database");
			if($db === FALSE)
			{
				return $connect = "db_doesnt_exist";
			}
			else
			{
				return $connect = "true";
			}
		}
		else
		{
			return $connect = "false";
		}
	}
##########################################################################
	function create_database()
	{
		$conn = mysql_connect($_SESSION['server'], $_SESSION['user'], $_SESSION['password']);
		$create = mysql_query("CREATE DATABASE ".$_SESSION['database'], $conn);			
	}
##########################################################################
	function param_default()
	{
		$_SESSION['server'] = "";
		$_SESSION['database'] = "";
		$_SESSION['user'] = "";
		$_SESSION['prefix'] = "";
		$_SESSION['base_url'] = get_base_url();
		$_SESSION['key'] = "";	
	}
##########################################################################
	function create_config_file()
	{
		$myFile = get_config_path().'config_builder.php';		
		$fh = fopen($myFile, 'r');
		$theData = fread($fh, filesize($myFile));
		fclose($fh);
		$theData = str_replace("APP_DIRECTORY_VALUE",$_SESSION['app_directory'],$theData);
		$theData = str_replace("ENCRYPTION_KEY_VALUE",$_SESSION['key'],$theData);
		
		$theData = str_replace("DB_TYPE_VALUE",'MYSQL',$theData);
		$theData = str_replace("DB_SERVER_VALUE",$_SESSION['server'],$theData);
		$theData = str_replace("DB_USER_VALUE",$_SESSION['user'],$theData);
		$theData = str_replace("DB_PASSWORD_VALUE",$_SESSION['password'],$theData);
		$theData = str_replace("DB_DATABASE_VALUE",$_SESSION['database'],$theData);
		
		$theData = str_replace("TIMEZONE",'US/Eastern',$theData);// default time zone
		
		$myFile = get_config_path().'config.php';
		$fh = fopen($myFile, 'w');
		fwrite($fh, $theData);
		fclose($fh);	
	}
##########################################################################
	function create_db_tables()
	{		
		$conn = mysql_connect($_SESSION['server'], $_SESSION['user'], $_SESSION['password']);
		// system_tbl_users
		// system_tbl_roles
		
		//--- event_users ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."system_tbl_users
				(USER_ID INT NOT NULL AUTO_INCREMENT ,
				 USER_NAME_FIRST VARCHAR(50) NULL ,
				 USER_NAME_LAST VARCHAR(50) NULL ,
				 USER_EMAIL VARCHAR(50) NULL ,
				 USER_PASSWORD VARCHAR(50) NULL ,
				 USER_ROLE_ID INT(11) NOT NULL ,
				 USER_CREATED_AT DATETIME NOT NULL ,
				 USER_UPDATED_AT DATETIME NOT NULL ,
				 USER_DELETED_AT DATETIME NOT NULL ,
				 PRIMARY KEY (USER_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}

		//--- event_roles ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."system_tbl_roles
				(ROLE_ID INT NOT NULL AUTO_INCREMENT ,
				 ROLE_NAME VARCHAR(55) NULL ,
				 PRIMARY KEY (ROLE_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}

		//--- case_manager ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."case_manager
				(CASE_ID INT NOT NULL AUTO_INCREMENT ,
				 USER_ID INT NULL ,
				 CASE_TYPE_ID INT NULL ,
				 ERROR_DESCRIPTION TEXT NULL ,
				 RECREATE_ERROR TEXT NULL ,
				 PRIORITY VARCHAR(50) NULL ,
				 OPERATING_SYSTEM VARCHAR(100) NULL ,
				 BROWSER VARCHAR(100) NULL ,
				 SOLUTION TEXT NULL ,
				 PRIMARY KEY (CASE_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}
				
		//--- insert users ---//
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."system_tbl_users (USER_NAME_FIRST, USER_NAME_LAST, USER_EMAIL, USER_ROLE_ID, USER_PASSWORD) VALUES ('default', 'user', 'email@email.com', 1, 'password')");
		
		//--- insert roles ---//
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."system_tbl_roles (ROLE_NAME) VALUES ('Admin')");				
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."system_tbl_roles (ROLE_NAME) VALUES ('Member')");
	}
##########################################################################	
?>