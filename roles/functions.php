<?php
/* ROLES.FUNCTIONS */
/*****************************************************************/


/** 
  * @desc	create record
  * @param	$_POST
  * @return none - redirect done in function
*/
	function create_Roles()
	{	  
		$data_columns = "";
		$data_values = "";

		foreach ($_POST as $key => $value) 
		{
			// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
			if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === false) // $_SESSION['ignore'] = _system/config.php
			{
				$value = cleanInput_Security($value);
				$data_columns.= $key.",";
				$data_values.= "'$value',";
			}
		}

		$data_columns = rtrim($data_columns, ','); // remove comma from end of string
		$data_values = rtrim($data_values, ','); // remove comma from end of string
		
		$sql = "INSERT INTO system_tbl_roles
				($data_columns) 
				VALUES ($data_values) 
			   ";

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Creating Role - (create_Roles)',$sql); }
	  
		$message = 'created';
		
		return $message;	  
	}
/*****************************************************************/


/** 
  * @desc	read 
  * @param	$id
  * @return complete query
*/
	function read_Roles($id=FALSE)
	{
		$sql = 'SELECT '.COLUMNS_SYSTEM_TBL_ROLES.' FROM system_tbl_roles roles ';	
		
		// by id
		if($id !== FALSE)
		{ $sql.= " WHERE roles.ROLE_ID = '$id' "; }  
		
		$sql.= ' ORDER BY roles.ROLE ';
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Role - (read_Roles)',$sql); }
		
		return $result;
	}
/*****************************************************************/


/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_roles = read_values_Roles($id='1');
  *			echo $values_roles['id']; // id would be lowercase
*/
	function read_values_Roles($id=FALSE)
	{
		$sql = 'SELECT '.COLUMNS_SYSTEM_TBL_ROLES.' FROM system_tbl_roles roles ';	
		
		// by id
		if($id !== FALSE)
		{ $sql.= " WHERE roles.ROLE_ID = '".$id."' "; }  
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
		// error reporting 
		if($result === false) 
		{ 
		  error_report_Helpers('Error Reading Role Values - (read_values_Roles)',$sql);
		}	  	
		
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
  * @param	
  * @return none
*/
	function update_Roles()
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
			  
		$sql = "UPDATE system_tbl_roles
				SET ".$data_update."
				WHERE ROLE_ID = '$_POST[ROLE_ID]'
			   ";

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Updating Role - (update_Roles)',$sql); }	
		
		$message = 'updated';
		
		return $message;
	  	  
	}
/*****************************************************************/


/** 
  * @desc	delete
  * @param	
  * @return none
*/
	function delete_Roles($id=FALSE)
	{
	  $message = 'not_able_to_deleted';
	  if($id !== FALSE)
	  {
		$sql = "DELETE FROM system_tbl_roles
				WHERE ROLE_ID = '$id' ";
					  
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
	
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Deleting Role - (delete_Roles)',$sql); }
		
		$message = 'deleted';
	  
		return $message;	
	  }
	}
/*****************************************************************/


/** 
  * @desc	html select list
  * @param	
  * @return echo out
*/
	function html_list_Roles($id=FALSE,$values=FALSE)
	{
	  $sql = ' SELECT '.COLUMNS_SYSTEM_TBL_ROLES.' FROM system_tbl_roles roles ';	
	  $sql.= ' ORDER BY roles.ROLE';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { error_report_Helpers('Error Creating Roles HTML List - roles.functions.html_list_Roles',$sql); }
	  
	  echo '<select name="ROLE_ID" '.$values.'>';
	  while($data = $_SESSION['FETCH_ARRAY']($result))
	  {
		if($data['ROLE_ID'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$data['ROLE_ID'].'" '.$selected.'>'.$data['ROLE'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/