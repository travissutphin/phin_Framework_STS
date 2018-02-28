<?php
/* 	PAGE_TYPES.CONTROLLER */
/*****************************************************************/

is_logged_in_Security();

/** 
  * @desc	create record
  * @param	$_POST
  * @return - redirect done in function
*/
	if(isset($_POST['create']))
	{
	  $message = create_Page_Types();
	}
/*****************************************************************/

/** 
  * @desc	update record
  * @param	$_POST
  * @return none - redirect done in function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Page_Types();
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
	  $message = delete_Page_Types($_POST['PAGE_TYPE_ID']);
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/** 
  * @desc	read record
  * @param	
  * @return 
*/
	$records_all = read_Page_Types();
	
	if(isset($_POST['PAGE_TYPE_ID']))
	{
	  $record_by_id= read_Page_Types($_POST['PAGE_TYPE_ID']);
	}
/*****************************************************************/

?>