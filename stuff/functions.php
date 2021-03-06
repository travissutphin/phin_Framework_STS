<?php
/* STUFF.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Stuff()
	{	  		
		// set needed variables
		$_POST['CREATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
	
		// set the SITE_ID
		$_POST['SITE_FK'] = $_SESSION['site_id'];
		
		// set the MEMBER_ID
		$_POST['MEMBER_FK'] = $_SESSION['members.id'];
		
		// create the STUFF ALIAS
		// get category name
		$record_category = read_values_Categories( $id=$_POST['CATEGORY_FK'],$site_fk=$_SESSION['site_id'] ) ;
		// add dashes to spaces in title
		$title = create_alias_Helpers( $_POST['TITLE'] ) ; 
		// add dashes to spacces in category
		$category = create_alias_Helpers( $record_category['name'] ) ;
		// put alias string together
		$alias = $title.'-'.$category.'-'.format_Dates_Times( date('Y-m-d'),'date_only' ) ;
		// make entire string lower case
		$_POST['ALIAS'] = strtolower( $alias ) ;
		
		//** Do not add trailing / to $move_to

		if($_FILES['PRIMARY_IMAGE']["name"] != ''){

			$_POST['PRIMARY_IMAGE'] = file_Uploads('PRIMARY_IMAGE','../upload_repository/',FALSE); // $name, $move_to, $max_size			
		
			// resize the image
			/*
			$src_filename = '../temp/'.$_POST['PRIMARY_IMAGE'];
			$dst_filename = '../upload_repository/'.$_POST['PRIMARY_IMAGE'];
			$dst_width = '350';
			$dst_height = '350';
			$fill = 'squeeze';
			resize_Images($src_filename, $dst_filename, $dst_width, $dst_height, $fill, $quality=100, $png_filters=PNG_NO_FILTER);
			*/
		}
		
				$data_columns = "";
				$data_values = "";

				foreach ($_POST as $key => $value) 
				{				
					// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
					if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === FALSE) // $_SESSION['ignore'] = _system/config.php
					{
						$value = cleanInput_Security($value);
						$data_columns.= $key.",";
						$data_values.= " '$value',";
					}
				}
					$data_columns = rtrim($data_columns, ','); // remove comma from end of string
					$data_values = rtrim($data_values, ','); // remove comma from end of string

					$sql = "INSERT INTO STUFF
							($data_columns) 
							VALUES ($data_values) 
						   ";

				 $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
				  
				 // error reporting 
				 if($result === false) 
				 { error_report_Helpers('Error Creating Stuff - (create_Stuff)',$sql); }
				
				  //$id = last_inserted_id_Helpers($result); // id of the last inserted record

				  $message = 'created';
				 
				  //registration_info_Email($id); // email new user login details
				  
				  // clear values as session vars
				  clear_postVars_to_sessionVars_Helpers();

		return $message;
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Stuff($id=FALSE,$site_fk=FALSE,$member_fk=FALSE,$category_fk=FALSE,$year_start_dk=FALSE,$year_end_dk=FALSE,$status_dk=FALSE,$alias=FALSE,$search=FALSE)
	{
	  $sql = ' SELECT '.COLUMNS_STUFF.' FROM STUFF stuff ';
	  $sql.= ' WHERE 0=0 ';

	  // by id
	  if($id !== FALSE)
	  {	$sql.= " AND stuff.STUFF_ID = '$id' "; }

	  // by site_fk
	  if($site_fk !== FALSE)
	  {	$sql.= " AND stuff.SITE_FK = '$site_fk' "; }
	  
	  // by member_fk
	  if($member_fk !== FALSE)
	  {	$sql.= " AND stuff.MEMBER_FK = '$member_fk' "; }

	  // by category_fk
	  if($category_fk !== FALSE)
	  {	$sql.= " AND stuff.CATEGORY_FK = '$category_fk' "; }

	  // by year_start_dk ( "dynamic key" build in _system/html_select_lists.php)
	  if($year_start_dk !== FALSE)
	  {	$sql.= " AND stuff.YEAR_START_FK = '$year_start_dk' "; }

	  // by year_end_dk ( "dynamic key" build in _system/html_select_lists.php)
	  if($year_end_dk !== FALSE)
	  {	$sql.= " AND stuff.YEAR_FK = '$year_end_dk' "; }
	  
	  // by status_dk ( "dynamic key" build in _system/html_select_lists.php)
	  if($status_dk !== FALSE)
	  {	$sql.= " AND stuff.YEAR_DK = '$year_dk' "; }

	  // by status_dk ( "dynamic key" build in _system/html_select_lists.php)
	  if($alias !== FALSE)
	  {	$sql.= " AND stuff.alias = '$alias' "; }
	  
		// seach query
		if ( $search !== FALSE )
		{ $sql.= " AND  ( stuff.TITLE LIKE '%$search%' OR stuff.DESCRIPTION_LONG LIKE '%$search%' ) " ; }
	  
	  $sql.= ' AND stuff.DELETED_AT IS NULL ';
	  
	  $sql.= ' ORDER BY stuff.CREATED_AT DESC ';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  if($result === false) 
	  { error_report_Helpers('Error Reading Stuff - (read_Stuff)',$sql); }
	  
	  return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_users = read_values_Stuff($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_Stuff($id=FALSE,$site_fk=FALSE,$user_fk=FALSE,$category_fk=FALSE,$year_start_dk=FALSE,$year_end_dk=FALSE,$status_dk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_STUFF.' FROM STUFF stuff ';

		// by id
		if($id !== FALSE)
		{	$sql.= " AND stuff.STUFF_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND stuff.SITE_FK = '$site_fk' "; }

		// by user_fk
		if($stuff_fk !== FALSE)
		{	$sql.= " AND stuff.USER_FK = '$user_fk' "; }

		// by category_fk
		if($category_fk !== FALSE)
		{	$sql.= " AND stuff.CATEGORY_FK = '$category_fk' "; }

		// by year_start_dk ( "dynamic key" build in _system/html_select_lists.php)
		if($year_start_dk !== FALSE)
		{	$sql.= " AND stuff.YEAR_START_FK = '$year_start_dk' "; }

		// by year_end_dk ( "dynamic key" build in _system/html_select_lists.php)
		if($year_end_dk !== FALSE)
		{	$sql.= " AND stuff.YEAR_FK = '$year_end_dk' "; }

		// by status_dk ( "dynamic key" build in _system/html_select_lists.php)
		if($status_dk !== FALSE)
		{	$sql.= " AND stuff.YEAR_DK = '$year_dk' "; }
		
		$sql.= ' ORDER BY stuff.CREATED_AT ';
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Stuff Values - (read_values_Stuff)',$sql); }
		
		// create array of values from this record
		$array = array();
		$data = $_SESSION['FETCH_ARRAY']($result);

		foreach($data as $key => $value) // creates assocative array
		{
			if(!is_numeric($key))
			{ $array = array_merge($array, array(strtolower($key) => $value)); }
		}  
		
		return $array;
	}
/*****************************************************************/

/** 	
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_Stuff()
	{	  	
			$_POST['UPDATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
			
			$message = 'updated';	
		
			$data_update = "";
			foreach ($_POST as $key => $value) 
			{
				// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
				if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === false) // $_SESSION['ignore'] = _system/config.php
				{
					$value = cleanInput_Security($value);
					$data_update.= $key." = '".$value."',";
			  	}
			}
			$data_update = rtrim($data_update, ','); // remove comma from end of string
			
			$sql = "UPDATE STUFF
					SET ".$data_update."
					WHERE STUFF_ID = '$_POST[STUFF_ID]'
				   ";
		
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Updating Stuff - (update_Stuff)',$sql); }
		
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Stuff( $id=FALSE )
	{
	  $deletedAt = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
	  $message = 'not_able_to_delete';
	  
	  if( $id != FALSE )
	  {
		$sql = 	"UPDATE STUFF
					SET DELETED_AT = '$deletedAt'
					WHERE STUFF_ID = '$_POST[STUFF_ID]'
					";
					
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Stuff - (delete_Stuff)',$sql); }
	  
		$message = 'deleted';
	  }
	  
	  return $message;
	}
/*****************************************************************/

/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Stuff($id=FALSE,$values=FALSE,$role_id=FALSE)
	{
	
		// removed, not sure how/why/if we need this.
	 
	}
/*****************************************************************/
	
?>