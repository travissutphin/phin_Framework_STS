<?php
/* MEMBERS.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Members()
	{	  					
		// set needed variables
		$_POST['CREATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');

		if(!isset($_POST['PASSWORD']) or $_POST['PASSWORD'] == "")
		{ $_POST['PASSWORD'] = random_string_Helpers();	} // create random password

		if(!isset($_POST['ROLE_FK'])) { $_POST['ROLE_FK'] = '2'; } // set role_id if not passed in post

		if(!validate_Email($_POST['EMAIL']))
		{			
			$message = 'email_invalid';
			
			// save values as session vars
			set_postVars_to_sessionVars_Helpers();
		}
		else
		{
			$num_rows = read_Members(FALSE,$_POST['EMAIL']);	
			if($_SESSION['NUM_ROWS']($num_rows))
			{
				$message = 'email_duplicate_on_create';

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
						$data_values.= " '$value',";
					}
				}
		
				$data_columns = rtrim($data_columns, ','); // remove comma from end of string
				$data_values = rtrim($data_values, ','); // remove comma from end of string
				
				$sql = "INSERT INTO MEMBERS
					    ($data_columns) 
					    VALUES ($data_values) 
					   ";

				$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			  
			// error reporting 
			if($result === false) {
				// log users IP address
				$ip = detect_ip_address_Security();
		
				// log failed registration attempt
				create_IP_Log($ip,$_SESSION['site_id'],'Register - Failed',FALSE,$_POST['EMAIL']);
				
				error_report_Helpers('Error Creating User - (create_Members)',$sql); 
			}
			
			$ip = detect_ip_address_Security();
			$user_fk = last_inserted_id_Helpers($result);
			
			// log successful registration
			create_IP_Log($ip,$_SESSION['site_id'],'Register - Success',$user_fk,$_POST['EMAIL']);
			
			// clear values as session vars
			clear_postVars_to_sessionVars_Helpers();
			  
			$message = 'created_new_user';
			 
			//registration_info_Email($id); // email new user login details
			  			
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
	function read_Members($id=FALSE,$email=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_MEMBERS.', '.COLUMNS_ROLES.' FROM MEMBERS mem ';
		$sql.= ' JOIN ROLES roles ON mem.ROLE_FK = roles.ROLE_ID ';	

		// id
		if($id !== FALSE)
		{	$sql.= " AND mem.MEMBER_ID = '$id' "; }

		// by email
		if($email !== FALSE)
		{	$sql.= " AND mem.EMAIL = '$email' "; }

		$sql.= " AND DELETED_AT IS NULL ";

		$sql.= ' ORDER BY mem.NAME_LAST, mem.NAME_FIRST ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		if($result === false) 
		{ error_report_Helpers('Error Reading members - (read_Members)',$sql); }

		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_mem = read_values_Members($id='1');
  *			echo $values_mem['id']; // id would be lowercase
*/
	function read_values_Members($id=FALSE)
	{
		$sql = 'SELECT '.COLUMNS_MEMBERS.' FROM MEMBERS mem ';	
		
		// by id
		if($id !== FALSE)
		{ $sql.= " WHERE mem.MEMBER_ID = '$id' "; }  
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Member Values - (read_values_Members)',$sql); }
		
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
	function update_Members()
	{	  	
		
		if(isset($_POST['ROLE_ID'])){
			$_POST['ROLE_FK'] = $_POST['ROLE_ID'];
		}
		
		$num_rows = read_Members(FALSE,$_POST['EMAIL']);
		
		if(!validate_Email($_POST['EMAIL'])) { // check for valid email

			$message = 'email_invalid'; 
		
		}elseif($_POST['EMAIL'] != $_POST['x_HIDDEN_EMAIL'] and $_SESSION['NUM_ROWS']($num_rows) ) {
				
			$message = 'email_duplicate_on_update';
		
		} else { // update
			
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
			
			$sql = "UPDATE MEMBERS
					SET ".$data_update."
					WHERE MEMBER_ID = '$_POST[MEMBER_ID]'
				   ";

			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Updating Member - (update_Members)',$sql); }
			
			if(isset($_POST['change_password']))
			{
			  clear_variables_Login() ;  
			}else{
			  $message = 'updated';			  
			}
		}
		
		// clear values as session vars
		clear_postVars_to_sessionVars_Helpers();
			  
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Members($id=FALSE)
	{
	  $deletedAt = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
	  $message = 'not_able_to_delete';
	  if($id != FALSE)
	  {
		$sql = "UPDATE MEMBERS
		SET DELETED_AT = '$deletedAt'
		WHERE MEMBER_ID = '$_POST[MEMBER_ID]'
	   ";
					  
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Member - (delete_Members)',$sql); }
	  
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
	function html_list_Members($id=FALSE,$email=FALSE,$values=FALSE)
	{
	  $result = read_Members($id=FALSE,$email=FALSE);
	  
	  echo '<select name="MEMBER_FK" " '.$values.' ">';
	  while($data = $_SESSION['FETCH_ARRAY']($result))
	  {
		if($data['MEMBER_ID'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$data['MEMBER_ID'].'" '.$selected.'>'.$data['NAME_FIRST'].' '.$data['NAME_LAST'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/
	
?>