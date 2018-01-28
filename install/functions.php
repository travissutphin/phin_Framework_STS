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
		// USERS
		// ROLES
		
		//--- users ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."USERS
				(USER_ID INT NOT NULL AUTO_INCREMENT ,
				 NAME_FIRST VARCHAR(50) NULL ,
				 NAME_LAST VARCHAR(50) NULL ,
				 EMAIL VARCHAR(50) NULL ,
				 PASSWORD VARCHAR(50) NULL ,
				 ROLE_FK INT(11) NOT NULL ,
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NOT NULL ,
				 DELETED_AT DATETIME NOT NULL ,
				 PRIMARY KEY (USER_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}

		//--- STUFF ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."STUFF
				(STUFF_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 USER_FK INT(11) NOT NULL ,
				 TITLE VARCHAR(50) NULL ,
				 DESCRIPTION_LONG TEXT NULL ,
				 DESCRIPTION_SHORT VARCHAR(255) NULL ,
				 CATEGORY_FK INT(11) NOT NULL ,
				 MODEL_FK INT(11) NOT NULL ,
				 YEAR_START_DK INT(11) NULL ,
				 YEAR_END_DK INT(11) NULL , 
				 STATUS INT(1) NOT NULL ,
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NULL ,
				 DELETED_AT DATETIME NULL ,
				 PRIMARY KEY (STUFF_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}

		//--- STUFF IMAGES ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."STUFF_IMAGES
				(STUFF_IMAGE_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 IMAGE VARCHAR(50) NOT NULL ,
				 DESCRIPTION VARCHAR(255) NULL ,
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NULL ,
				 DELETED_AT DATETIME NULL ,
				 PRIMARY KEY (STUFF_IMAGE_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}

		//--- STUFF LEVELS ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."STUFF_MEMBERSHIP_LEVELS
				(STUFF_MEMBERSHIP_LEVELS_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 LEVEL VARCHAR(50) NOT NULL ,
				 PRIMARY KEY (STUFF_MEMBERSHIP_LEVELS_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}

		//--- STUFF ABUSE REPORTED ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."STUFF_ABUSE_REPORTED
				(STUFF_ABUSE_REPORTED_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 STUFF_FK INT(11) NULL , 
				 EVENT_FK INT(11) NULL , 
				 GALLERY_FK INT(11) NULL ,
				 REPORTED_AS VARCHAR(50) NULL ,
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NULL ,
				 DELETED_AT DATETIME NULL ,
				 PRIMARY KEY (STUFF_ABUSE_REPORTED_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}	

		//--- STUFF ACTIVITY TRACKING ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."STUFF_ACTIVITY_TRACKING
				(STUFF_ACTIVITY_TRACKING_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 STUFF_FK INT(11) NULL , 
				 DATE_START DATE NULL , 
				 DATE_END DATE NULL , 
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NULL ,
				 DELETED_AT DATETIME NULL ,
				 PRIMARY KEY (STUFF_ACTIVITY_TRACKING_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}	
		
		//--- CATEGORIES ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES
				(CATEGORY_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 PARENT_ID (INT(11) NOT NULL ,
				 NAME VARCHAR(255) NULL ,
				 PRIMARY KEY (CATEGORY_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}	

		//--- MAKES ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."MAKES
				(MAKE_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 MAKE VARCHAR(50) NULL ,
				 PRIMARY KEY (MAKE_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}			
		
		//--- MODELS ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."MODELS
				(MODEL_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 MODEL VARCHAR(50) NULL ,
				 PRIMARY KEY (MODEL_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}				
	
		//--- SITES ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."SITES
				(SITE_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE VARCHAR(50) NULL ,
				 PRIMARY KEY (SITE_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}	
		
		//--- ADS ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."ADS
				(AD_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 IMAGE VARCHAR(50) NULL ,
				 LINK VARCHAR(100) NULL , 
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NULL ,
				 DELETED_AT DATETIME NULL ,
				 PRIMARY KEY (AD_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}		

		//--- IP TRACKING ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."IP_TRACKING
				(IP_TRACKING_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 IP_ADDRESS VARCHAR(25) NULL ,
				 ATTEMPTED_ACCESS_TO VARCHAR(25) NULL , 
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NULL ,
				 DELETED_AT DATETIME NULL ,
				 PRIMARY KEY (IP_TRACKING_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}

		//--- EVENTS ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."EVENTS
				(EVENT_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 TITLE VARCHAR(100) NOT NULL , 
				 DESCRIPTION_LONG TEXT NULL , 
				 DESCRIPTION_SHORT VARCHAR(255) NULL , 
				 DATE_FROM DATETIME NULL.
				 DATE_TO DATETIME NULL , 
				 TIME VARCHAR(100) NULL , 
				 IMAGE VARCHAR(50) NULL ,
				 LINK VARCHAR(100) NULL , 
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NULL ,
				 DELETED_AT DATETIME NULL ,
				 PRIMARY KEY (EVENT_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}

		//--- GALLERY ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."GALLERY
				(GALLERY_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 TITLE VARCHAR(100) NOT NULL , 
				 DESCRIPTION_SHORT VARCHAR(255) NULL , 
				 IMAGE VARCHAR(50) NULL ,
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NULL ,
				 DELETED_AT DATETIME NULL ,
				 PRIMARY KEY GALLERY_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}
		
		//--- GALLERY ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."GALLERY_IMAGES
				(GALLERY_IMAGE_ID INT NOT NULL AUTO_INCREMENT ,
				 SITE_FK INT(11) NOT NULL ,
				 GALLERY_FK INT(11) NULL ,
				 TITLE VARCHAR(100) NOT NULL , 
				 DESCRIPTION_SHORT VARCHAR(255) NULL , 
				 IMAGE VARCHAR(50) NULL ,
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NULL ,
				 DELETED_AT DATETIME NULL ,
				 PRIMARY KEY GALLERY_IMAGE_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}
		
		//--- ROLES ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."ROLES
				(ROLE_ID INT NOT NULL AUTO_INCREMENT ,
				 ROLE_NAME VARCHAR(55) NULL ,
				 PRIMARY KEY (ROLE_ID)
				)ENGINE=InnoDB";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}
				
		//--- insert users ---//
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."USERS (USER_NAME_FIRST, USER_NAME_LAST, USER_EMAIL, USER_ROLE_ID, USER_PASSWORD) VALUES ('default', 'user', 'email@email.com', 1, 'password')");
		
		//--- insert roles ---//
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."ROLES (ROLE_NAME) VALUES ('Admin')");				
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."ROLES (ROLE_NAME) VALUES ('Member')");
		
		//--- insert sites ---//
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE) VALUES ('jeep-stuff.com')");
		
		//--- insert make ---//
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."MAKES (SITE_FK, MAKE) VALUES ('1', 'Jeep' )");
		
		//--- insert model ---//
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'CJ2', '5')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER, '1') VALUES ( '1', 'CJ3', '10')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'CJ5', '15')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'CJ6', '29')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'CJ7', '25')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'CJ8', '30')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'CJ9', '35')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'CJ10', '40')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', Willys Wagon', '45')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'Willys Pickup', '50')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'VJ', '55')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'DJ', '60')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'FC-150 (1956-1965)', '65')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'FC-170 (1957-1965)', '70')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER, '1') VALUES ( '1', 'FJ (1961-1965)', '75')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'SJ	- Wagoneer (1963-1983)', '80')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'SJ - J Serier (1963-1988)', '85')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'SJ - Super Wagoneer (1966-1969)', '90')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'SJ - Cherokee (1974-1983)', '95') ");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'SJ - Grand Wagoneer (1984-1991)', '100')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'C101 - Jeepster Commando (1966-)', '105')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'C014 - Commando (1972-1973)', '110')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'XJ - Cherokee (1984-2001)', '115')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'XJ - Wagon Limited (1984-1999)', '120')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'MJ - Commando (1986-1992)', '125')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'YJ - Wrangler (1997-2006)', '130')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'ZJ - Grand Cherokee (1993-1998)', '135')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'ZJ - Grand Wagoneer (1993-1998)', '140')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'TJ - Wrangler (1997-2006)', '145')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'WJ - Grand Cherokee (1999-2004)', '150')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'KJ - Liberty (2002-2007)', '155')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'WK - Grand Cherokee (2005 - 2010)', '160')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'XK -  Commando (2006-2010)', '165')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'JK - Wrangler (2007-Present)', '170')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'JKU - Wrangler 4D (2007-Present)', '175')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'MK - Compass/Patriot (2007-Present)', '180')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'KK - Liberty (2008-Present)', '185')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'WK2 - Grand Cherokee (2014-Present)', '190')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'KL - Cherokee (2014-Present)', '200')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."SITES (SITE_FK, MODEL_FK, ORDER) VALUES ( '1', 'BU - Renegade (2015-Present)', '205')");

		//-- categories --//
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Engines', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Drivetrain', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Suspension', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'carburetors', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Ignition', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Headers', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Pistons/Rings', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Radiators', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Starters', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Valves/Covers', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Water Pumps', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Body', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Interior', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Electrical', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Wheels (stock/used)', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Tires (stock/used)', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Exhaust', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Brakes', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Tops', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Doors', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Bumpers', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Audio', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Battery', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Cargo', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Lighting', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Recovery-Winches', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Armor-bumpers, skid plates, roll cages, rock guards', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Fender Flares', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Tops', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Intakes', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Guages', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Fuel Storage', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Engine Software', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Tires', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Wheels', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Trailers - Open', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Trailers - Enclosed', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Trailers - Accessories', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Wanted', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Graphics/Decals', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Apparel/Luggage', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Services', '0')");
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."CATEGORIES (SITE_FK, NAME, PARENT_ID) VALUES ('1', 'Restoration/Detailing', '0')");
						
	}
##########################################################################	
?>