<?php
/* ADS.CONTROLLER */
/*****************************************************************/

/**
  * @desc	only allow admin to access this section
  * @param	
  * @return none
*/

	role_access_only_Security('1') ; // 1 = admin
	
 /*****************************************************************/
 

/**
  * @desc	set message var based on $_REQUEST value
  * @param	$_POST
  * @return none -
*/

	$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : false;

/*****************************************************************/


/**
  * @desc	start the create process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['create']))
	{

	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Members();
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{

	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/

	$records_by_member = read_values_Members($_SESSION['members.id'],$email=FALSE);


/*****************************************************************/
?>