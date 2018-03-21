<?php
/* EVENTS.CONTROLLER */
/*****************************************************************/

// use datatables on the view page
$show_datatables = TRUE;

$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : false;

/**
  * @desc	only allow admin to access this section
  * @param	
  * @return none
*/

	role_access_only_Security('1') ; // 1 = admin
	
 /*****************************************************************/
 
/**
  * @desc	start the create process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['create']))
	{
	  $_POST['SITE_FK'] = $_SESSION['site_id'];
	  $message = create_Events();
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Events();
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  $message = delete_Events($_POST['EVENT_ID']);
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	if(isset($_REQUEST['EVENT_ID']))
	{
		$record_by_id= read_Events($_REQUEST['EVENT_ID']);
	}
	else
	{
		$records_all = read_Events(FALSE,$_SESSION['site_id']);
		$records_all_num_rows = $_SESSION['NUM_ROWS']($records_all);	
	}
?>