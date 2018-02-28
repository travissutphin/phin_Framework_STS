<?php
/* DASHBOARD.CONTROLLER */
/*****************************************************************/

/**
  * @desc	start the create process
  * @param	$_POST
  * @return none
*/
	if(isset($_POST['create']))
	{
	  create_Dashboard();
  	  header( 'Location: view.php' ) ;	
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  update_Dashboard();	  
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  delete_Dashboard($_POST['id']);	  
	}
/*****************************************************************/

/**
  * @desc	
  * @param	
  * @return 
*/
	//$records_all = read_Dashboard();
/*****************************************************************/

?>