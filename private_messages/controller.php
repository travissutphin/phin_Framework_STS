<?php
/* PRIVATE_MESSAGES.CONTROLLER */
/*****************************************************************/

/**
  * @desc	only allow admin to access this section
  * @param	
  * @return none
*/

	//role_access_only_Security('1') ; // 1 = admin
	
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
		$message = create_Private_Messages();
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  
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
  * @desc	save the member id to chat with
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if(isset($_REQUEST['id']))
	{

		$_SESSION['private_message_member_id'] = $_REQUEST['id'];
		
		// update all messages as ready
		update_read_Private_Messages();
	
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	
	if(isset($_SESSION['private_message_member_id'])) {
	
		$records_private_messages_by_member = read_Private_Messages(FALSE,$_SESSION['site_id'],$_SESSION['members.id'],$_SESSION['private_message_member_id']);
	
	}
	
	$records_members = read_Members(FALSE,FALSE,'by_updated');


/*****************************************************************/
?>