<?php
/* CONTENT.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none - redirect will occure accordingly
*/
	function create_Content()
	{	
		$_POST['CREATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');			
		$_POST['SITE_FK'] = SITE_ID;
		
		if($_POST['CON_ACCESS_TO'] == ""){
			$_POST['CON_ACCESS_TO'] = '8'; // 8 = Public
		}else{		
			$_POST['CON_ACCESS_TO'] = implode(",", $_POST['CON_ACCESS_TO']);
		}
		
		// NOTE //
		//////////
		// ** if $_POST['CON_PARENT_ID'] = "-1", this page is part of Latest News
		
		// create alias, use TITLE if ALIAS is blank
		if($_POST['CON_ALIAS'] == "")
		{ $_POST['CON_ALIAS'] = create_alias_Helpers($_POST['CON_TITLE']); }
		else
		{ $_POST['CON_ALIAS'] = create_alias_Helpers($_POST['CON_ALIAS']); }
		
		// add current date to the end of the Alias to allow similar Alias' on different dates
		if($_POST['CON_PARENT_ID'] == "-1"){
			$alias_date = date("Y-m-d");
			$_POST['CON_ALIAS'] = $_POST['CON_ALIAS'].'-'.$alias_date;
		}
		
		// check that alias doesn't already exist
		$values_pages = read_values_Content($id=FALSE,$alias=$_POST['CON_ALIAS'],$type=FALSE);
		
		if(is_numeric($values_pages['content_id']))
		{
			set_postVars_to_sessionVars_Helpers();
			$message = 'alias_duplicate';	
			return $message;
		}
		else
		{
			$data_columns = "";
			$data_values = "";
			foreach ($_POST as $key => $value) 
			{
				// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
				if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === FALSE) // $_SESSION['ignore'] = _system/config.php
				{		
					//$value = cleanInput_Security($value);
					$data_columns.= $key.",";
					$data_values.= "'$value',";
				}
			}
			
			$data_columns = rtrim($data_columns, ','); // remove comma from end of string
			$data_values = rtrim($data_values, ','); // remove comma from end of string
			
			$sql = "INSERT INTO content
					($data_columns) 
					VALUES ($data_values) 
				   ";

			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Creating Content - (create_Content)',$sql,$result); }
					
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
	function read_Content($id=FALSE,$alias=FALSE,$con_parent_id=FALSE,$num_rows=FALSE,$sub_nav=FALSE,$access_to=FALSE,$archived=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_CONTENT.', '.COLUMNS_CONTENT_TYPES.' FROM content con ';
		$sql.= ' JOIN content_types ct ON con.CONTENT_TYPE_FK = ct.CONTENT_TYPE_ID ';
		$sql.= " WHERE 0=0 ";
		// by id
		if($id !== FALSE)
		{ $sql.= " AND con.CONTENT_ID = '$id' "; }
		// by alias
		if($alias !== FALSE)
		{ $sql.= " AND con.CON_ALIAS = '$alias' "; }
		// by type
		if($con_parent_id !== FALSE)
		{ $sql.= " AND con.CON_PARENT_ID = '$con_parent_id' "; }		
		// by type
		if($sub_nav !== FALSE)
		{ $sql.= " AND con.CON_PARENT_ID != '0' "; }
		// by access_to
		if($access_to !== FALSE)
		{ $sql.= " AND con.CON_ACCESS_TO LIKE '$access_to%' "; 
			//$sql.= " AND (',' + RTRIM(con.CON_ACCESS_TO) + ',') LIKE '%,' + $access_to + ',%' ";
		}		
		// archived
		if($archived !== FALSE)
		{
			$sql.= " AND con.ARCHIVED_AT IS NOT NULL ";
		}else{
			$sql.= " AND con.ARCHIVED_AT IS NULL ";
		}
		// so we only get content for a specific site
		$sql.= " AND con.SITE_FK = 'SITE_ID' ";
		$sql.= " AND DELETED_AT IS NULL ";
		$sql.= ' ORDER BY con.CON_SEQUENCE, con.CREATED_AT DESC ';
		if($num_rows !== FALSE)
		{	$sql.= "LIMIT ".$num_rows; }
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
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
	 $sql = ' SELECT '.COLUMNS_CONTENT.', '.COLUMNS_CONTENT_TYPES.' FROM content con ';
		
		// join
		$sql.= ' JOIN content_types ct ON con.CONTENT_TYPE_FK = ct.CONTENT_TYPE_ID ';
		
		$sql.= " WHERE 0=0 ";
		
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
		
		// so we only get content for a specific site id
		$sql.= " AND con.ORGANIZATION_FK = SITE_ID ";
		
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
	function update_Content()
	{						  			
		$_POST['UPDATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');	

		if(count($_POST['CON_ACCESS_TO']) == 0){
			$_POST['CON_ACCESS_TO'] = '8'; // 8 = Public
		}else{		
			$_POST['CON_ACCESS_TO'] = implode(",", $_POST['CON_ACCESS_TO']);
		}
			
		// create alias
		if($_POST['CON_ALIAS'] == "")
		{$_POST['CON_ALIAS'] = create_alias_Helpers($_POST['CON_TITLE']); }
		else
		{$_POST['CON_ALIAS'] = create_alias_Helpers($_POST['CON_ALIAS']); }
		
		
		// check that alias doesn't already exist
		$values_pages = read_values_Content($id=FALSE,$alias=$_POST['CON_ALIAS'],$type=FALSE);
		
		// check if the record exists and that it doesn't equal the posted page_id
		if(is_numeric($values_pages['content_id']) and $values_pages['content_id'] != $_POST['CONTENT_ID'])
		{
			set_postVars_to_sessionVars_Helpers();
			$message = 'alias_duplicate';	
			return $message;
		}
		else
		{		
			$data_update = "";
					
			foreach ($_POST as $key => $value) 
			{
				// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
				if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === FALSE) // $_SESSION['ignore'] = _system/config.php
				{
					//$value = cleanInput_Security($value);
					//$value = addslashes($value);
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
			if($result === false) 
			{ error_report_Helpers('Error Updating Page - (update_Content)',$sql,$result); }
	
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
	function delete_Content($id=FALSE)
	{
	  if($id != FALSE)
	  {
		$today = date("Y-m-d");	
		$sql = "UPDATE content
				SET DELETED_AT = '$today'
				WHERE CONTENT_ID = '$id' ";
					  
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Page - (delete_Content)',$sql,$result); }
	  
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
	function html_list_Content($id=FALSE,$values=FALSE)
	{
	  $sql = ' SELECT '.COLUMNS_CONTENT.' FROM content con ';	
	  $sql.= ' ORDER BY con.CON_SEQUENCE, con.CON_TITLE ';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { error_report_Helpers('Error Creating Page HTML List Content - (html_list_Pages)',$sql,$result); }
	  
	  echo '<select name="SECTION_ID" "'.$values.'">';
	  while($data = $_SESSION['FETCH_ARRAY']($result))
	  {
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
	function html_list_navigation_Content($id=FALSE,$values=FALSE,$con_parent_id=FALSE)
	{
	  $sql = ' SELECT '.COLUMNS_CONTENT.' FROM content con ';
	  $sql.= " WHERE con.CON_PARENT_ID = '0' ";	
	  $sql.= "   AND con.DELETED_AT IS NULL ";
	  $sql.= ' ORDER BY con.CON_SEQUENCE ';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { error_report_Helpers('Error - (html_list_navigation_Pages)',$sql,$result); }
	  
	  // -1 are the Latest News Items
	  if($con_parent_id == '-1'){ $selectedA="selected"; }else{ $selectedA=""; }
	  
	  echo '<select name="CON_PARENT_ID" "'.$values.'" class="form-control">';
	  echo '<option value="0">Main Content Page</option>';
	  echo '<option value="-1" '.$selectedA.'>Latest News Item</option>'; // not in main menu
	  while($data = $_SESSION['FETCH_ARRAY']($result))
	  {
		if($data['CONTENT_ID'] == $con_parent_id){ $selected="selected"; }else{ $selected=""; }
		
			if($data['CONTENT_ID'] != "19" AND $data['CONTENT_ID'] != "11" AND $data['CONTENT_ID'] != "14" AND $data['CONTENT_ID'] != "15" ){
				echo '<option value="'.$data['CONTENT_ID'].'" '.$selected.'>Subpage to: '.$data['CON_TITLE'].'</option>';
			}
			  
	  }
	  echo '</select>';
	}
/*****************************************************************/




/** 
  * @desc	checks if database exists and installs if needed
  * @param	
  * @return 
*/
	function install_Content()
	{
		/*
		$sql = ' SELECT 1 FROM pages ';
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		if($result === FALSE)
		{
			$sql = 'CREATE TABLE IF NOT EXISTS pages (
			PAGE_ID int(11) NOT NULL AUTO_INCREMENT,
			TITLE varchar(255) DEFAULT NULL,
			ALIAS varchar(255) DEFAULT NULL,
			CONTENT text,
			PAGE_TYPE_ID int(11) DEFAULT NULL,
			META_TITLE varchar(255) DEFAULT NULL,
			META_TAGS varchar(255) DEFAULT NULL,
			META_DESCRIPTION text,
			VIDEO_EMBED varchar(255) DEFAULT NULL,
			VIDEO_LINK varchar(255) DEFAULT NULL,
			CREATED_AT datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			UPDATED_AT datetime DEFAULT NULL,
			DELETED_AT datetime DEFAULT NULL,
			PRIMARY KEY (PAGE_ID),
			KEY PAGE_ID (PAGE_ID)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1; ';  
			
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql); 
		}	
		*/
	}
/*****************************************************************/
?>