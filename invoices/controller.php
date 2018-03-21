<?php
/* INVOICES.CONTROLLER */
/*****************************************************************/

// use datatables on the view page
$show_datatables = TRUE;

// include the print script located in footer
$include_print_area =  TRUE;

$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : false;

/**
  * @desc	only allow admin to access this section
  * @param	
  * @return none
*/

	//role_access_only_Security('1') ; // 1 = admin
	
 /*****************************************************************/
 
/**
  * @desc	start the create process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['create']))
	{
	  $_POST['SITE_FK'] = $_SESSION['site_id'];
	  $message = create_Invoices();
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Invoices();
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  $message = delete_Invoices($_POST['INVOICE_ID']);
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if ( isset ( $_POST['view_invoice'] ) ) {
	  
		$message = read_Invoices( $_POST['INVOICE_ID'], $_SESSION['site_id'], $_SESSION['members.id'] ) ;
	
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	if ( isset ( $_REQUEST['INVOICE_ID'] ) ) {
		$record_by_id= read_Invoices( $_REQUEST['INVOICE_ID'],$_SESSION['site_id'] ) ;
	}
	elseif ( $_SESSION['members.role_id'] == '2' ) {
	
		$records_all = read_Invoices( FALSE,$_SESSION['site_id'],$_SESSION['members.id'] ) ;
		$records_all_num_rows = $_SESSION['NUM_ROWS']($records_all);	
		
	}elseif ( $_SESSION['members.role_id'] == '1' ) {
	
		$records_all = read_Invoices(FALSE,$_SESSION['site_id'],FALSE ) ;
		$records_all_num_rows = $_SESSION['NUM_ROWS'] ( $records_all ) ;	
	
	}
	
	
?>