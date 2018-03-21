<?php
/* ADVERTISERS.CONTROLLER */
/*****************************************************************/

 // use datatables on the view page
$show_datatables = TRUE;

/**
  * @desc	only allow admin to access this section
  * @param	
  * @return none
*/

	role_access_only_Security('1') ; // 1 = admin
	
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
		$_POST['SITE_FK'] = $_SESSION['site_id'];
		$message = create_Advertisers();
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Advertisers();
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  $message = delete_Advertisers($_POST['ADVERTISER_ID']);
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/


/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['view_ads']))
	{
		header( 'Location: ../ads/view.php?advertiser_id='.$_POST['ADVERTISER_ID'] ) ;
	}
/*****************************************************************/


/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	if(isset($_REQUEST['ADVERTISER_ID']))
	{
		$record_by_id= read_Advertisers($_REQUEST['ADVERTISER_ID'], $_SESSION['site_id']);
	}
	else
	{
		$records_all = read_Advertisers(FALSE,$_SESSION['site_id']);
		$records_all_num_rows = $_SESSION['NUM_ROWS']($records_all);	
	}
?>