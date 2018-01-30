<?php
/* _SYSTEM.CONFIG */
/*****************************************************************/
	
	session_start();

/**
  * @desc	
  * @param	
  * @return 
*/
	date_default_timezone_set('US/Eastern');
	define("DB_TYPE","MYSQL");// MYSQL or MSSQL
	define("DB_SERVER","127.0.0.1");
	define("DB_DATABASE","phin_framework_sts");
	define("DB_USER","root");
	define("DB_PASSWORD", "");
	define("APP_DIRECTORY", "/phin_Framework_STS/"); // should be "/" if app is on the root
	define("LOGIN_TIMEOUT", "360");	
/*****************************************************************/	


/**
  * @desc	array of form vars not to include in posted loop when 
  *			creating or updating records.	
  * @param	
  * @return 
*/
	$_SESSION['ignore'] = array("create", "update", "delete", "multiselect", "USER_ID", "ROLE_ID", "STUFF_ID", "STUFF_IMAGE_ID", "STUFF_MEMBERSHIP_LEVEL_ID", "STUFF_ABUSE_REPORTED_ID", "STUFF_ACTIVITY_TRACKING_ID", "CATEGORY_ID", "MAKE_ID", "MODEL_ID", "SITE_ID", "AD_ID", "IP_TRACKING_ID", "EVENT_ID", "GALLERY_ID", "GALLERY_IMAGE_ID", "");
	
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
	// system functions
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\security.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\database.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\dates_times.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\email.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\message_center.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\helpers.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_system\\html_select_lists.php");
	
	// not managed in admin pages ( no crud in admin )
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_categories\\functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_models\\functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_roles\\functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."_sites\\functions.php");

	// manage in admin pages ( has crud in admin)
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."login\\functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."stuff\\functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."users\\functions.php");
	
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
	$table_x_alias = array("CATEGORIES"=>"cat","MODELS"=>"model", "ROLES"=>"roles", "SITES"=>"sites", "STUFF"=>"stuff", "USERS"=>"users");	
							
	foreach($table_x_alias as $table => $alias)
	{	
		table_fields_Database($table,$alias);
	}
/*****************************************************************/


/**
  * @desc
  * @param	
  * @return 
*/
	$this_url = $_SERVER['HTTP_HOST'];
	$read_values_Sites = read_values_Sites(FALSE, $this_url);
	// we can use the following to get site details
	define("SITE_ID", $read_values_Sites['site_id']);
	define("SITE", $read_values_Sites['year_start']);
	define("SITE_YEAR_START", $read_values_Sites['year_start']);
	define("SITE_DISPLAY_NAME", $read_values_Sites['display_name']);
/*****************************************************************/


/**
  * @desc	this should only be changed following installation.
  * 		modifying this in anyway once data has been added will 
  *			render all encrypted values unreadable
  * @param	
  * @return 
*/
	define("ENCRYPTION_KEY", "20180128184653@ci");
/*****************************************************************/
?>