<?php
/* USERS.CONTROLLER */
/*****************************************************************/

$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : false;

/**
  * @desc	start the create process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['create']))
	{
	  $message = create_Users();
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Users();
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  $message = delete_Users($_POST['USER_ID']);
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/

	
	if(isset($_REQUEST['USER_ID']))
	{
		$record_by_id= read_Users($_REQUEST['USER_ID']);
	}
	else
	{
		$records_all = read_Users();
		$records_all_num_rows = $_SESSION['NUM_ROWS']($records_all);	
	}
?>