<?php
/* MEMBERS.CONTROLLER */
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
	  $message = create_Members();
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
	  $message = delete_Members($_POST['MEMBER_ID']);
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/

	if(isset($_REQUEST['MEMBER_ID']))
	{
		$record_by_id= read_Members($_REQUEST['MEMBER_ID']);
	}
	else
	{
		$records_all = read_Members();
		$records_all_num_rows = $_SESSION['NUM_ROWS']($records_all);	
	}
?>