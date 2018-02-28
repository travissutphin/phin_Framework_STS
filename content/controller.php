<?php
/* CONTENT.CONTROLLER */
/*****************************************************************/

is_logged_in_Security();

$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : false;

/**
  * @desc	start the create process
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if(isset($_REQUEST['create']))
	{
	  $message = create_Content();
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/



/**
  * @desc	update sequence
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if(isset($_REQUEST['update_sequence']))
	{
		$sql = " UPDATE content ";
		$sql.= " SET ";
		$sql.= " CON_SEQUENCE = '$_POST[update_sequence]' ";
		$sql.= " WHERE CONTENT_ID = '$_POST[CONTENT_ID]' ";	

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		if($result === false) 
		{ error_report_Helpers('Error- (updating sequence)',$sql,$result); }
				
		header( 'Location: view.php?message=sequence_updated' ) ;
	}
/*****************************************************************/


	
/**
  * @desc	start the update process
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if(isset($_REQUEST['update']))
	{
	  $message = update_Content();
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if(isset($_REQUEST['delete']))
	{
	  $message = delete_Content($_REQUEST['CONTENT_ID']);
	  header( 'Location: view.php?message='.$message ) ;
	}
/*****************************************************************/

/**
  * @desc	start the archive unarchive process
  * @param	$_REQUEST
  * @return none - redirect is done within the function
*/
	if(isset($_REQUEST['archive']))
	{
	  $message = archive_Content($_REQUEST['CONTENT_ID']);
	  header( 'Location: view_latest_news.php?message='.$message ) ;
	}

	if(isset($_REQUEST['unarchive']))
	{
	  $message = unarchive_Content($_REQUEST['CONTENT_ID']);
	  header( 'Location: view_latest_news.php?message='.$message ) ;
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/

	if(isset($_REQUEST['CONTENT_ID']))
	{
		echo $_REQUEST['CONTENT_ID'];
		$record_content_by_id= read_Content($_REQUEST['CONTENT_ID']);
	}
	else
	{
		if(!isset($_SESSION['SEQUENCE']) or $_SESSION['SEQUENCE'] == "")
		{$_SESSION['SEQUENCE'] = 0;}
		$records_content = read_Content(FALSE,FALSE,'0',FALSE);//$id,$alias,$content_parent_id,$num_rows
		$records_content_latest_news_pages = read_Content(FALSE,FALSE,'-1',FALSE);//$id,$alias,$content_parent_id,$num_rows
		$records_content_latest_news_pages_archived = read_Content(FALSE,FALSE,'-1',FALSE,FALSE,FALSE,'Archived');//$id,$alias,$content_parent_id,$num_rows
		//$records_files_images = read_Files($id=FALSE,$file_type=FALSE,$file_category='image');
		//$records_files_documents = read_Files($id=FALSE,$file_type=FALSE,$file_category='document');
	}
/*****************************************************************/


/*****************************************************************/
?>