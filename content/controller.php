<?php
/* CONTENT.CONTROLLER */
/*****************************************************************/
// use datatables on the view page//$show_datatables = TRUE; // showing data table messes up the main page to sub nav page placement$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : false;/**  * @desc	only allow admin to access this section  * @param	  * @return none*/	role_access_only_Security('1') ; // 1 = admin	 /*****************************************************************/

/**
  * @desc	start the create process
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if ( isset ( $_REQUEST['create'] ) ) {
	  
		$message = create_Content();
		header( 'Location: view.php?message='.$message ) ;
	
	}
/*****************************************************************/

/**
  * @desc	update sequence
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if ( isset ( $_REQUEST['update_sequence'] ) ) {
		$sql = " UPDATE content ";
		$sql.= " SET ";
		$sql.= " CON_SEQUENCE = '$_POST[update_sequence]' ";
		$sql.= " WHERE CONTENT_ID = '$_POST[CONTENT_ID]' ";	
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		if ( $result === false ) { 
			
			error_report_Helpers('Error- (updating sequence)',$sql,$result); 
			
		}
		header( 'Location: view.php?message=sequence_updated' ) ;
		
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if ( isset ( $_REQUEST['update'] ) ) {
		$message = update_Content();
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if ( isset ( $_REQUEST['delete'] ) ) {
		$message = delete_Content( $_REQUEST['CONTENT_ID'] ) ;
		header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/**
  * @desc	start the archive unarchive process
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if ( isset ( $_REQUEST['archive'] ) ) {
		$message = archive_Content( $_REQUEST['CONTENT_ID'] );
		header( 'Location: view_latest_news.php?message='.$message ) ;
	}
	if ( isset ( $_REQUEST['unarchive'] ) ) {
		$message = unarchive_Content($_REQUEST['CONTENT_ID']);
		header( 'Location: view_latest_news.php?message='.$message ) ;
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	if ( isset ( $_REQUEST['CONTENT_ID'] ) ) {
		$record_by_id = read_Content( $_REQUEST['CONTENT_ID'],FALSE,$_SESSION['site_id'] ) ; 
	}else{
		$records_all = read_Content( $id=FALSE,$alias=FALSE,$site_id=$_SESSION['site_id'],$con_parent_id='0',$num_rows=FALSE,$sub_nav=FALSE,$access_to=FALSE ) ; 
	}
/*****************************************************************/
?>