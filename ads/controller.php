<?php
/* ADS.CONTROLLER */
/*****************************************************************/

// use datatables on the view page
$show_datatables = TRUE;

/**
  * @desc	only allow admin to access this section
  * @param	
  * @return none
*/
	is_logged_in_Security() ;
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
  * @desc	save passed advertiser info
  * @param	$_POST
  * @return none -
*/
	if(isset($_REQUEST['advertiser_id'])){
		
		$_SESSION['ADVERTISER_ID'] = $_REQUEST['advertiser_id'];
		
	}elseif(isset($_REQUEST['unset']) and $_REQUEST['unset'] = 'advertiser_id' ){
	
		$_SESSION['ADVERTISER_ID'] = NULL ;
	
	}
	
	if(isset($_SESSION['ADVERTISER_ID'])){
	
		$values_advertisers = read_values_Advertisers($_SESSION['ADVERTISER_ID'],$_SESSION['site_id']);
	
	}
	
/*****************************************************************/

/**
  * @desc	start the create process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['create']))
	{
	  $_POST['SITE_FK'] = $_SESSION['site_id'];
	  $message = create_Ads();
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Ads();
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  $message = delete_Ads($_POST['AD_ID']);
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	if(isset($_REQUEST['AD_ID'])){
	
		$record_by_id= read_Ads($_REQUEST['AD_ID']);
	
	}elseif(isset($_SESSION['ADVERTISER_ID'])){

		$records_all = read_Ads(FALSE,$_SESSION['site_id'],$_SESSION['ADVERTISER_ID'] );
		$records_all_num_rows = $_SESSION['NUM_ROWS']($records_all);	
		
	}else{
	
		$records_all = read_Ads(FALSE,$_SESSION['site_id'],FALSE );
		$records_all_num_rows = $_SESSION['NUM_ROWS']($records_all);	
	
	}
?>