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
				(ID INT NOT NULL AUTO_INCREMENT ,
				 NAME_FIRST VARCHAR(50) NULL ,
				 NAME_LAST VARCHAR(50) NULL ,
				 EMAIL VARCHAR(50) NULL ,
				 PASSWORD VARCHAR(50) NULL ,
				 ROLE_ID INT NOT NULL ,
				 CREATED_AT DATETIME NOT NULL ,
				 UPDATED_AT DATETIME NOT NULL ,
				 DELETED_AT DATETIME NOT NULL ,
				 PRIMARY KEY (ID) ); ";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}
		//--- event_roles ---//
		$sql = "CREATE TABLE ".$_SESSION['database'].".".$_SESSION['prefix']."system_tbl_roles
				(ID INT NOT NULL AUTO_INCREMENT ,
				 ROLE VARCHAR(55) NULL ,
				 PRIMARY KEY (ID) ); ";
		if(!mysql_query($sql,$conn))
		{
			echo 'error: '.mysql_error();
			exit;
		}
		//--- insert users ---//
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."system_tbl_users (NAME_FIRST, NAME_LAST, EMAIL, ROLE_ID, PASSWORD) VALUES ('default', 'user', 'email', 1, 'password')");
		
		//--- insert roles ---//
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."system_tbl_roles (ROLE) VALUES ('Admin')");				
		$sql = mysql_query("INSERT INTO ".$_SESSION['database'].".".$_SESSION['prefix']."system_tbl_roles (ROLE) VALUES ('Member')");
	}
##########################################################################	
	function time_zones()
	{		
	?>
		<select name="timezone">
			<option timeZoneId="1" gmtAdjustment="GMT-12:00" useDaylightTime="0" value="-12">(GMT-12:00) International Date Line West</option>
			<option timeZoneId="2" gmtAdjustment="GMT-11:00" useDaylightTime="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
			<option timeZoneId="3" gmtAdjustment="GMT-10:00" useDaylightTime="0" value="-10">(GMT-10:00) Hawaii</option>
			<option timeZoneId="4" gmtAdjustment="GMT-09:00" useDaylightTime="1" value="-9">(GMT-09:00) Alaska</option>
			<option timeZoneId="5" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
			<option timeZoneId="6" gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
			<option timeZoneId="7" gmtAdjustment="GMT-07:00" useDaylightTime="0" value="-7">(GMT-07:00) Arizona</option>
			<option timeZoneId="8" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
			<option timeZoneId="9" gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
			<option timeZoneId="10" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Central America</option>
			<option timeZoneId="11" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
			<option timeZoneId="12" gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
			<option timeZoneId="13" gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Saskatchewan</option>
			<option timeZoneId="14" gmtAdjustment="GMT-05:00" useDaylightTime="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
			<option timeZoneId="15" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5" selected="selected">(GMT-05:00) Eastern Time (US & Canada)</option>
			<option timeZoneId="16" gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Indiana (East)</option>
			<option timeZoneId="17" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
			<option timeZoneId="18" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
			<option timeZoneId="19" gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Manaus</option>
			<option timeZoneId="20" gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Santiago</option>
			<option timeZoneId="21" gmtAdjustment="GMT-03:30" useDaylightTime="1" value="-3.5">(GMT-03:30) Newfoundland</option>
			<option timeZoneId="22" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Brasilia</option>
			<option timeZoneId="23" gmtAdjustment="GMT-03:00" useDaylightTime="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
			<option timeZoneId="24" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Greenland</option>
			<option timeZoneId="25" gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Montevideo</option>
			<option timeZoneId="26" gmtAdjustment="GMT-02:00" useDaylightTime="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
			<option timeZoneId="27" gmtAdjustment="GMT-01:00" useDaylightTime="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
			<option timeZoneId="28" gmtAdjustment="GMT-01:00" useDaylightTime="1" value="-1">(GMT-01:00) Azores</option>
			<option timeZoneId="29" gmtAdjustment="GMT+00:00" useDaylightTime="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
			<option timeZoneId="30" gmtAdjustment="GMT+00:00" useDaylightTime="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
			<option timeZoneId="31" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
			<option timeZoneId="32" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
			<option timeZoneId="33" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
			<option timeZoneId="34" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
			<option timeZoneId="35" gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) West Central Africa</option>
			<option timeZoneId="36" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Amman</option>
			<option timeZoneId="37" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
			<option timeZoneId="38" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Beirut</option>
			<option timeZoneId="39" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Cairo</option>
			<option timeZoneId="40" gmtAdjustment="GMT+02:00" useDaylightTime="0" value="2">(GMT+02:00) Harare, Pretoria</option>
			<option timeZoneId="41" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
			<option timeZoneId="42" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Jerusalem</option>
			<option timeZoneId="43" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Minsk</option>
			<option timeZoneId="44" gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Windhoek</option>
			<option timeZoneId="45" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
			<option timeZoneId="46" gmtAdjustment="GMT+03:00" useDaylightTime="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
			<option timeZoneId="47" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Nairobi</option>
			<option timeZoneId="48" gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Tbilisi</option>
			<option timeZoneId="49" gmtAdjustment="GMT+03:30" useDaylightTime="1" value="3.5">(GMT+03:30) Tehran</option>
			<option timeZoneId="50" gmtAdjustment="GMT+04:00" useDaylightTime="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
			<option timeZoneId="51" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Baku</option>
			<option timeZoneId="52" gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Yerevan</option>
			<option timeZoneId="53" gmtAdjustment="GMT+04:30" useDaylightTime="0" value="4.5">(GMT+04:30) Kabul</option>
			<option timeZoneId="54" gmtAdjustment="GMT+05:00" useDaylightTime="1" value="5">(GMT+05:00) Yekaterinburg</option>
			<option timeZoneId="55" gmtAdjustment="GMT+05:00" useDaylightTime="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
			<option timeZoneId="56" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
			<option timeZoneId="57" gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
			<option timeZoneId="58" gmtAdjustment="GMT+05:45" useDaylightTime="0" value="5.75">(GMT+05:45) Kathmandu</option>
			<option timeZoneId="59" gmtAdjustment="GMT+06:00" useDaylightTime="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
			<option timeZoneId="60" gmtAdjustment="GMT+06:00" useDaylightTime="0" value="6">(GMT+06:00) Astana, Dhaka</option>
			<option timeZoneId="61" gmtAdjustment="GMT+06:30" useDaylightTime="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
			<option timeZoneId="62" gmtAdjustment="GMT+07:00" useDaylightTime="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
			<option timeZoneId="63" gmtAdjustment="GMT+07:00" useDaylightTime="1" value="7">(GMT+07:00) Krasnoyarsk</option>
			<option timeZoneId="64" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
			<option timeZoneId="65" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
			<option timeZoneId="66" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
			<option timeZoneId="67" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Perth</option>
			<option timeZoneId="68" gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Taipei</option>
			<option timeZoneId="69" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
			<option timeZoneId="70" gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Seoul</option>
			<option timeZoneId="71" gmtAdjustment="GMT+09:00" useDaylightTime="1" value="9">(GMT+09:00) Yakutsk</option>
			<option timeZoneId="72" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Adelaide</option>
			<option timeZoneId="73" gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Darwin</option>
			<option timeZoneId="74" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Brisbane</option>
			<option timeZoneId="75" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
			<option timeZoneId="76" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Hobart</option>
			<option timeZoneId="77" gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
			<option timeZoneId="78" gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Vladivostok</option>
			<option timeZoneId="79" gmtAdjustment="GMT+11:00" useDaylightTime="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
			<option timeZoneId="80" gmtAdjustment="GMT+12:00" useDaylightTime="1" value="12">(GMT+12:00) Auckland, Wellington</option>
			<option timeZoneId="81" gmtAdjustment="GMT+12:00" useDaylightTime="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
			<option timeZoneId="82" gmtAdjustment="GMT+13:00" useDaylightTime="0" value="13">(GMT+13:00) Nuku'alofa</option>
		</select>
	<?php
    }		
?>