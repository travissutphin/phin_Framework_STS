<?php
/* USERS.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Users()
	{	  		
		// set needed variables
		$createdAt = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
		
		if(!isset($_POST['USER_PASSWORD']) or $_POST['USER_PASSWORD'] == "")
		{ $_POST['USER_PASSWORD'] = random_string_Helpers();	} // create random password
		
		if(!isset($_POST['ROLE_ID'])) { $_POST['ROLE_ID'] = '2'; } // set role_id if not passed in post
		
		if(!validate_Email($_POST['USER_EMAIL']))
		{			
			$message = 'email_invalid';
			
			// save values as session vars
			set_postVars_to_sessionVars_Helpers();
			//foreach ($_POST as $key => $value) 
			//{
			 // $_SESSION[$key] = $value;		  
			//}
		}
		else
		{
			$num_rows = read_Users(FALSE,$_POST['USER_EMAIL']);	
			if($_SESSION['NUM_ROWS']($num_rows))
			{
				$message = 'email_duplicate';

				// save values as session vars
				set_postVars_to_sessionVars_Helpers();
								  
			}else{
				  
				$data_columns = "";
				$data_values = "";
		
				foreach ($_POST as $key => $value) 
				{
					// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
					if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === FALSE) // $_SESSION['ignore'] = _system/config.php
					{
						$value = cleanInput_Security($value);
						$data_columns.= $key.",";
						$data_values.= "'$value',";
					}
				}
		
				$data_columns = rtrim($data_columns, ','); // remove comma from end of string
				$data_values = rtrim($data_values, ','); // remove comma from end of string
				
				$sql = "INSERT INTO system_tbl_users
					    ($data_columns) 
					    VALUES ($data_values) 
					   ";
 	  
			  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			  
			  // error reporting 
			  if($result === false) 
			  { error_report_Helpers('Error Creating User - (create_Users)',$sql); }
			
			  $id = last_inserted_id_Helpers($result); // id of the last inserted record

			  $message = 'created';
			 
			  //registration_info_Email($id); // email new user login details
			  
			  // clear values as session vars
			  clear_postVars_to_sessionVars_Helpers();
			  //foreach ($_POST as $key => $value) 
			  //{
			//	$_SESSION[$key] = '';		  
			  //}
				
			}
		}
		
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Users($id=FALSE,$email=FALSE)
	{
	  $sql = ' SELECT '.COLUMNS_SYSTEM_TBL_USERS.', '.COLUMNS_SYSTEM_TBL_ROLES.' FROM system_tbl_users users ';
	  $sql.= ' JOIN system_tbl_roles roles ON users.ROLE_ID = roles.ROLE_ID ';	

	  // id
	  if($id !== FALSE)
	  {	$sql.= " AND users.USER_ID = '$id' "; }
	  
	  // by email
	  if($email !== FALSE)
	  {	$sql.= " AND users.USER_EMAIL = '$email' "; }
	  
	  $sql.= ' ORDER BY users.USER_NAME_LAST, users.USER_NAME_FIRST ';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  if($result === false) 
	  { error_report_Helpers('Error Reading User - (read_Users)',$sql); }
	  
	  return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_users = read_values_Users($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_Users($id=FALSE)
	{
		$sql = 'SELECT '.COLUMNS_SYSTEM_TBL_USERS.' FROM system_tbl_users users ';	
		
		// by id
		if($id !== FALSE)
		{ $sql.= " WHERE users.USER_ID = '$id' "; }  
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading User Values - (read_values_Users)',$sql); }
		
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
	function update_Users()
	{	  	
		if(!validate_Email($_POST['USER_EMAIL'])) // check for valid email
		{ $message = 'email_invalid'; }
		else // update
		{			
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
			
			$sql = "UPDATE system_tbl_users
					SET ".$data_update."
					WHERE USER_ID = '$_POST[USER_ID]'
				   ";
		
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Updating User - (update_Users)',$sql); }
			
			if(isset($_POST['change_password']))
			{
			  clear_variables_Login() ;  
			}else{
			  $message = 'updated';			  
			}
		}
		
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Users($id=FALSE)
	{
	  $message = 'not_able_to_delete';
	  if($id != FALSE)
	  {
		$sql = "DELETE FROM system_tbl_users
				WHERE USER_ID = '$id' ";
					  
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting User - (delete_Users)',$sql); }
	  
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
	function html_list_Users($id=FALSE,$values=FALSE,$role_id=FALSE)
	{
	  $sql = ' SELECT '.COLUMNS_SYSTEM_TBL_USERS.' FROM system_tbl_users users ';	
	  
	  if($role_id != FALSE)
	  { $sql.= " WHERE users.ROLE_ID = '$role_id' "; }
	  
	  $sql.= ' ORDER BY users.USER_NAME_LAST, users.USER_NAME_FIRST ';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { error_report_Helpers('Error Generating User HTML List - (html_list_Users)',$sql); }
	  
	  echo '<select name="user_id" "'.$values.'">';
	  while($data = $_SESSION['FETCH_ARRAY']($result))
	  {
		if($data['USER_ID'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$data['USER_ID'].'" '.$selected.'>'.$data['USER_NAME_FIRST'].' '.$data['USER_NAME_LAST'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/
	
?>