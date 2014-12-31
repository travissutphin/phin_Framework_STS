<?php
/* .CONTROLLER */
/*****************************************************************/

$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : false;

/**
  * @desc	start the create process
  * @param	$_POST
  * @return none
*/
	if(isset($_POST['create']))
	{
	  $message = create_();
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  $message = update_();
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  $message = delete_($_POST['x']);	
	  header( 'Location: view.php?message='.$message ) ;  
	}
/*****************************************************************/


/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	if(isset($_REQUEST['x']))
	{	  
		$records_by_id = read_($_REQUEST['x']);
	}
	else
	{
		$records_all = read_();	
	}
/*****************************************************************/

?>