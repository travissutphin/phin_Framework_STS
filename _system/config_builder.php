<?php
/* _SYSTEM.CONFIG */
/*****************************************************************/
	
	session_start();

/**
  * @desc	
  * @param	
  * @return 
*/
	date_default_timezone_set('TIMEZONE');
	define("DB_TYPE","DB_TYPE_VALUE");// MYSQL or MSSQL
	define("DB_SERVER","DB_SERVER_VALUE");
	define("DB_DATABASE","DB_DATABASE_VALUE");
	define("DB_USER","DB_USER_VALUE");
	define("DB_PASSWORD", "DB_PASSWORD_VALUE");
	define("APP_DIRECTORY", "APP_DIRECTORY_VALUE"); // should be "/" if app is on the root
	define("LOGIN_TIMEOUT", "360");
/*****************************************************************/	


/**
  * @desc	array of form vars not to include in posted loop when 
  *			creating or updating records.	
  * @param	
  * @return 
*/
	$_SESSION['ignore'] = array("create", "update", "delete", "multiselect", "USER_ID", "ROLE_ID");
	
/*****************************************************************/	

	
/**
  * @desc	run first to ensure site_Url and root_Url are defined
  * @param	
  * @return 
*/
	include_once('url.php');

/*****************************************************************/
  
/**
  * @desc	system modules required for app to function
  * @param	
  * @return 
*/
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\security.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\database.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\dates_times.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\email.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\message_center.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\helpers.php");
	
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."login\\functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."users\\functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."roles\\functions.php");

/*****************************************************************/
  

  
/**
  * @desc	addon modules for updates to the app
  * @param	
  * @return 
*/

/*****************************************************************/


/**
  * @desc	set db specific function names based on database type
  * @param	DB_TYPE
  * @return $session vars
*/
	connection_Database(DB_TYPE);

	
	if(DB_TYPE == "MYSQL")
	{	
		$_SESSION['QUERY'] = "mysqli_query";
		$_SESSION['NUM_ROWS'] = "mysqli_num_rows";
		$_SESSION['FETCH_ARRAY'] = "mysqli_fetch_array";
		$_SESSION['QUERY_ERROR'] = "mysqli_error";
	}
	elseif(DB_TYPE == "MSSQL")
	{
		$_SESSION['QUERY'] = "sqlsrv_query";
		$_SESSION['NUM_ROWS'] = "sqlsrv_num_rows";
		$_SESSION['FETCH_ARRAY'] = "sqlsrv_fetch_array";
		$_SESSION['QUERY_ERROR'] = "sqlsrv_error";		
	}
/*****************************************************************/


/**
  * @desc	creates defined() lists for each of the tables with corresponding alias
  *			define() name will be "COLUMN_" followed by the table name
  * @param	
  * @return 
  * @ex.use	"SELECT COLUMNS_tbl_users FROM tbl_users" (this will include all fields
  *			within the tbl_users table
  * @creats	define("COLUMNS_system_tbl_roles" ,"roles.ID, roles.NAME, roles.CREATED_AT, roles.UPDATED_AT, roles.DELETED_AT") 
*/ 
	$table_x_alias = array("system_tbl_users"=>"users", "system_tbl_roles"=>"roles");	
							
	foreach($table_x_alias as $table => $alias)
	{	
		table_fields_Database($table,$alias);
	}
/*****************************************************************/


/**
  * @desc	this should only be changed following installation.
  * 		modifying this in ayway once data has been added will 
  *			render all encrypted values unreadable
  * @param	
  * @return 
*/
	define("ENCRYPTION_KEY", "ENCRYPTION_KEY_VALUE");
/*****************************************************************/
?>