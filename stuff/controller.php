<?php
/* STUFF.CONTROLLER */
/*****************************************************************/

/**
  * @desc	only allow admin to access this section
  * @param	
  * @return none
*/
	
	is_logged_in_Security() ;

// use datatables on the view page
$show_datatables = TRUE;

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
		// if this is a member we will show only the members stuff for current site
		if(isset($_SESSION['site_id']) and isset($_SESSION['members.role_id']) and $_SESSION['members.role_id'] == '2'){
		
			$records_all = read_Stuff(FALSE,$_SESSION['site_id'], $_SESSION['members.id']);
			$records_all_num_rows = $_SESSION['NUM_ROWS']($records_all);	
		
		// if this is the admin, we will show all stuff for current site
		}elseif(isset($_SESSION['members.role_id']) and $_SESSION['members.role_id'] == '1'){
		
			$records_all = read_Stuff(FALSE,$_SESSION['site_id']);
			$records_all_num_rows = $_SESSION['NUM_ROWS']($records_all);	
		
		}
	}
?>