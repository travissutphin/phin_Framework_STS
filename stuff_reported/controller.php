<?php
/* STUFF.CONTROLLER */
/*****************************************************************/

$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : false;

/**
  * @desc	start the create process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['create']))
	{
	  $message = create_Stuff();
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Stuff();
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  $message = delete_Stuff($_POST['STUFF_ID']);
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	if(isset($_REQUEST['STUFF_ID']))
	{
		$record_by_id= read_Stuff($_REQUEST['STUFF_ID']);
	}
	else
	{
		$records_all = read_Stuff();
		$records_all_num_rows = $_SESSION['NUM_ROWS']($records_all);	
	}
?>