<?php
/* 	ROLES.CONTROLLER */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	$_POST
  * @return - redirect done in function
*/
	if(isset($_POST['create']))
	{
	  $message = create_Roles();
	}
/*****************************************************************/

/** 
  * @desc	update record
  * @param	$_POST
  * @return none - redirect done in function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Roles();
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/** 
  * @desc	delete record
  * @param	$_POST
  * @return - redirect done in function
*/
	if(isset($_POST['delete']))
	{
	  $message = delete_Roles($_POST['ROLE_ID']);
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/** 
  * @desc	read record
  * @param	
  * @return 
*/
	$records_all = read_Roles();
	
	if(isset($_POST['ROLE_ID']))
	{
	  $record_by_id= read_Roles($_POST['ROLE_ID']);
	}
/*****************************************************************/

?>