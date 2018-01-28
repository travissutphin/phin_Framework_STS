<?php
/* PARTNER_IMAGES.CONTROLLER */
/*****************************************************************/

is_logged_in_Security();

//has_access_to_page_Security($permission=1);

$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : false;

/**
  * @desc	start the create process
  * @param	$_POST
  * @return none
*/
	if(isset($_POST['create']))
	{
	  $message = create_Partner_Images();
	  header('Location: view.php?message='.$message);
	  exit;
	}
/*****************************************************************/


/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Partner_Images();
	  header('Location: view.php?message='.$message);
	  exit;
	}
/*****************************************************************/



/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete_partner_image']))
	{
	  $message = delete_Partner_Images($_POST['PARTNER_IMAGE_ID']);	
	  header( 'Location: view.php?message='.$message ) ;  
	}
/*****************************************************************/



/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	if(isset($_POST['PARTNER_IMAGE_ID'])){
		$read_Partner_Image = read_Partner_Images($_POST['PARTNER_IMAGE_ID'],$_SESSION['global_organization_id']);	
	}else{
		$read_Partner_Images = read_Partner_Images(FALSE,$_SESSION['global_organization_id']);		
	}
		
/*****************************************************************/
	

?>