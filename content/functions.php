<?php
/* CONTENT.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none - redirect will occure accordingly
*/
	function create_Content() {		
		$_POST['CREATED_AT'] = format_Dates_Times( date( 'Y-m-d H:i:s' ),'database_table' ) ; 			
		$_POST['SITE_FK'] = $_SESSION['site_id'];				/*
		if($_POST['CON_ACCESS_TO'] == ""){
			$_POST['CON_ACCESS_TO'] = '8'; // 8 = Public
		}else{		
			$_POST['CON_ACCESS_TO'] = implode(",", $_POST['CON_ACCESS_TO']);
		}		*/
		// NOTE //
		//////////
		// ** if $_POST['CON_PARENT_ID'] = "-1", this page is part of Latest News
		// create alias, use TITLE if ALIAS is blank
		if ( $_POST['CON_ALIAS'] == "" ) {						$_POST['CON_ALIAS'] = create_alias_Helpers( $_POST['CON_TITLE'] ) ;
				}else{						$_POST['CON_ALIAS'] = create_alias_Helpers( $_POST['CON_ALIAS'] ) ;					}
		
		// add current date to the end of the Alias to allow similar Alias' on different dates
		if ( $_POST['CON_PARENT_ID'] == "-1" ) {
						$alias_date = date("Y-m-d");
			$_POST['CON_ALIAS'] = $_POST['CON_ALIAS'].'-'.$alias_date;			
		}
		// check that alias doesn't already exist
		$values_pages = read_values_Content( $id=FALSE,$alias=$_POST['CON_ALIAS'],$type=FALSE ) ;
		if ( isset ( $values_pages['content_id'] ) ) {
		set_postVars_to_sessionVars_Helpers();
			$message = 'alias_duplicate';	
			return $message;
				}else{		
			$data_columns = "";
			$data_values = "";
			foreach ( $_POST as $key => $value ) {			
				// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
				if ( !in_array( $key,$_SESSION['ignore'] ) and strpos( $key, 'x_' ) === FALSE ) { // $_SESSION['ignore'] = _system/config.php
							if ( $key != 'CONTENT' ) {											$value = cleanInput_Security( $value , FALSE , 'replace_html' ) ;														} else {					
						$value = cleanInput_Security( $value , FALSE , FALSE ) ;										}										$data_columns.= $key.",";					$data_values.= "'$value',";					
				}				
			}	
			$data_columns = rtrim($data_columns, ','); // remove comma from end of string
			$data_values = rtrim($data_values, ','); // remove comma from end of string
			$sql = "INSERT INTO content
						($data_columns) 
						VALUES ($data_values) 
						";
			$result = $_SESSION['QUERY']( $_SESSION['connection'],$sql ) ;
			// error reporting 
			if ( $result === false ) { 							error_report_Helpers( 'Error Creating Content - (create_Content)',$sql,$result ) ; 							}
					
			$message = 'created';	
			clear_postVars_to_sessionVars_Helpers();
			return $message;
		}		
	}	
/*****************************************************************/
/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Content( $id=FALSE,$alias=FALSE,$site_id=FALSE,$con_parent_id=FALSE,$num_rows=FALSE,$sub_nav=FALSE,$access_to=FALSE ) {
				$sql = ' SELECT '.COLUMNS_CONTENT.' FROM content con ';		$sql.= " WHERE 0=0 ";		// by id		if ( $id !== FALSE ) {				$sql.= " AND con.CONTENT_ID = '$id' " ;		}		// by alias		if($alias !== FALSE)		{ $sql.= " AND con.CON_ALIAS = '$alias' "; }		// by site		if($site_id !== FALSE)		{ $sql.= " AND con.SITE_FK = '$site_id' "; }				// by type		if($con_parent_id !== FALSE)		{ $sql.= " AND con.CON_PARENT_ID = '$con_parent_id' "; }		// show sub nav		if($sub_nav !== FALSE)		{ $sql.= " AND con.CON_PARENT_ID != '0' "; }				$sql.= " AND con.DELETED_AT IS NULL ";		$sql.= ' ORDER BY con.CON_SEQUENCE ASC ';		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		if($result === false) 
		{ error_report_Helpers('Error Reading Page - (read_Content)',$sql,$result); }
		return $result;
	}
/*****************************************************************/


/** 
  * @desc	read specific value
  * @param	$id
  * @return specific name
*/
	function read_values_Content($id=FALSE,$alias=FALSE,$content_parent_id=FALSE,$num_rows=FALSE,$sub_nav=FALSE,$access_to=FALSE,$archived=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_CONTENT.' FROM content con ';		$sql.= " WHERE 0=0 ";
		// by id
		if($id !== FALSE)
		{ $sql.= " AND con.CONTENT_ID = '$id' "; }
		// by alias
		if($alias !== FALSE)
		{ $sql.= " AND con.CON_ALIAS = '$alias' "; }
		// by type
		if($content_parent_id !== FALSE)
		{ $sql.= " AND con.CON_PARENT_ID = '$content_parent_id' "; }
		// by access_to
		if($access_to !== FALSE)
		{ $sql.= " AND con.CON_ACCESS_TO LIKE '%$access_to%' "; 
			//$sql.= " AND (',' + RTRIM(con.CON_ACCESS_TO) + ',') LIKE '%,' + $access_to + ',%' ";
		}
		// archived
		if($archived !== FALSE)
		{ $sql.= " AND con.ARCHIVED_AT = '2016-01-01' ";}
		$sql.= " AND DELETED_AT IS NULL ";
		$sql.= ' ORDER BY con.CREATED_AT DESC ';
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
	  	// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Reading Content Values - (read_values_Content)',$sql,$result); }
	  	$array = array();
	  	$data = $_SESSION['FETCH_ARRAY']($result);
	  	if($_SESSION['NUM_ROWS']($result) > 0)
	  	{ 
			  foreach($data as $key => $value) // creates assocative array
		  	{
				if(!is_numeric($key))
			  	{ $array = array_merge($array, array(strtolower($key) => $value)); }
		  	}
	  	}
		
	 	return $array;
	}
/*****************************************************************/
/** 	
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_Content() {						  			
		$_POST['UPDATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');	
		// create alias
		if($_POST['CON_ALIAS'] == "")
		{$_POST['CON_ALIAS'] = create_alias_Helpers($_POST['CON_TITLE']); }
		else
		{$_POST['CON_ALIAS'] = create_alias_Helpers($_POST['CON_ALIAS']); }
		// check that alias doesn't already exist
		$values_content = read_values_Content($id=FALSE,$alias=$_POST['CON_ALIAS'],$type=FALSE);		
		// check if the record exists and that it doesn't equal the posted page_id
		if ( isset ( $values_content['content_id'] ) and $values_content['content_id'] != $_POST['CONTENT_ID'] ) {
			set_postVars_to_sessionVars_Helpers();
			$message = 'alias_duplicate';	
			return $message;
		}else{		
			$data_update = "";					foreach ($_POST as $key => $value) {
				// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']				if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === FALSE)  { // $_SESSION['ignore'] = _system/config.php
										$value = cleanInput_Security($value);
					$value = addslashes($value);
					$data_update.= $key." = '".$value."',";					
				}				
			}
			$data_update = rtrim($data_update, ','); // remove comma from end of string
			$sql = "UPDATE content
					SET ".$data_update."
					WHERE CONTENT_ID = '$_POST[CONTENT_ID]'
				   ";				  
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			// error reporting 
			if($result === false) { 							error_report_Helpers('Error Updating Page - (update_Content)',$sql,$result); 						}
			$message = 'updated';	
			clear_postVars_to_sessionVars_Helpers();
			return $message;
		}
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Content($id=FALSE) {
		if($id != FALSE) {
			$today = date("Y-m-d");	
			$sql = "UPDATE content
					SET DELETED_AT = '$today'
					WHERE CONTENT_ID = '$id' ";
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			// error reporting 
			if($result === false) { 				error_report_Helpers('Error Deleting Page - (delete_Content)',$sql,$result); 							}
			$message = 'deleted';
		}	  
	  return $message;	  
	}
/*****************************************************************/

/** 
  * @desc	archive
  * @param	$id
  * @return none
*/
	function archive_Content($id=FALSE)
	{
	  if($id != FALSE)
	  {
		$today = date("Y-m-d");	
		$sql = "UPDATE content
				SET ARCHIVED_AT = '$today'
				WHERE CONTENT_ID = '$id' ";
		  
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Page - (archive_Content)',$sql,$result); }
	  
		$message = 'archived';
	  }
	  
	  return $message;
	  
	}
/*****************************************************************/


/** 
  * @desc	unarchive
  * @param	$id
  * @return none
*/
	function unarchive_Content($id=FALSE)
	{
	  if($id != FALSE)
	  {
		$today = date("Y-m-d");	
		$sql = "UPDATE content
				SET ARCHIVED_AT = NULL
				WHERE CONTENT_ID = '$id' ";
					  
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Page - (unarchive_Content)',$sql,$result); }
	  
		$message = 'unarchived';
	  }
	  
	  return $message;
	  
	}
/*****************************************************************/

/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Content($id=FALSE,$values=FALSE) {
		$sql = ' SELECT '.COLUMNS_CONTENT.' FROM content con ';			$sql.= ' ORDER BY con.CON_SEQUENCE, con.CON_TITLE ';
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Creating Page HTML List Content - (html_list_Pages)',$sql,$result); }

		echo '<select name="SECTION_ID" "'.$values.'">';
		while( $data = $_SESSION['FETCH_ARRAY'] ( $result ) ) {
			if($data['CONTENT_ID'] == $id){ $selected="selected"; }else{ $selected=""; }
			echo '<option value="'.$data['CONTENT_ID'].'" '.$selected.'>'.$data['CON_TITLE'].'</option>';  
		}
		echo '</select>';
	}
/*****************************************************************/

/** 
  * @desc	create an html select list navigation
  * @param	if -1 is passed this means the page is not in the main menu 
  * @return none - echo out list
*/
	function html_list_navigation_Content($id=FALSE,$values=FALSE,$con_parent_id=FALSE) {
		$sql = ' SELECT '.COLUMNS_CONTENT.' FROM content con ';
		$sql.= " WHERE con.CON_PARENT_ID = '0' ";	
		$sql.= "   AND con.DELETED_AT IS NULL ";
		$sql.= ' ORDER BY con.CON_SEQUENCE ';
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		// error reporting 
		if($result === false) { 					error_report_Helpers('Error - (html_list_navigation_Pages)',$sql,$result); 					}
		// -1 are the Latest News Items
		if($con_parent_id == '-1'){ $selectedA="selected"; }else{ $selectedA=""; }
		echo '<select name="CON_PARENT_ID" "'.$values.'" class="form-control">';
		echo '<option value="0">Main Content Page</option>';
		echo '<option value="-1" '.$selectedA.'>Latest News Item</option>'; // not in main menu
		while($data = $_SESSION['FETCH_ARRAY']($result)) {
			if($data['CONTENT_ID'] == $con_parent_id){ $selected="selected"; }else{ $selected=""; }			echo '<option value="'.$data['CONTENT_ID'].'" '.$selected.'>Subpage to: '.$data['CON_TITLE'].'</option>';		  		}
	echo '</select>';
	}
/*****************************************************************/
?>