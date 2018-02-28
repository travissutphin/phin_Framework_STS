<?php
/* CONTENT_TYPES.FUNCTIONS */
/*****************************************************************/


/** 
  * @desc	create record
  * @param	$_POST
  * @return none - redirect done in function
*/
	function create_Content_Types()
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
		
		$sql = "INSERT INTO content_types
				($data_columns) 
				VALUES ($data_values) 
			   ";

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Creating Content Type - (create_Content_Types)',$sql,$result); }
	  
		$message = 'created';
		
		return $message;	  
	}
/*****************************************************************/


/** 
  * @desc	read 
  * @param	$id
  * @return complete query
*/
	function read_Content_Types($id=FALSE)
	{
		$sql = 'SELECT '.COLUMNS_CONTENT_TYPES.' FROM content_types ct ';	
		
		// by id
		if($id !== FALSE)
		{ $sql.= " WHERE ct.CONTENT_TYPE_ID = '$id' "; }  
		
		$sql.= ' ORDER BY ct.TYPE ';
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Content Type - (read_Content_Types)',$sql,$result); }
		
		return $result;
	}
/*****************************************************************/


/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_roles = read_values_Content_Types($id='1');
  *			echo $values_content_types['id']; // id would be lowercase
*/
	function read_values_Content_Types($id=FALSE)
	{
		$sql = 'SELECT '.COLUMNS_CONTENT_TYPES.' FROM content_types ct ';	
		
		// by id
		if($id !== FALSE)
		{ $sql.= " WHERE ct.CONTENT_TYPE_ID = '$id' "; }  
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Content Type Values - (read_values_Content_Types)',$sql,$result); }	  	
		
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
	function update_Content_Types()
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
			  
		$sql = "UPDATE content_types
				SET ".$data_update."
				WHERE CONTENT_TYPE_ID = '$_POST[CONTENT_TYPE_ID]'
			   ";

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Updating Content Type - (update_Content_Types)',$sql,$result); }	
		
		$message = 'updated';
		
		return $message;
	  	  
	}
/*****************************************************************/


/** 
  * @desc	delete
  * @param	
  * @return none
*/
	function delete_Content_Types($id=FALSE)
	{
		$message = 'not_able_to_deleted';
		
		if($id !== FALSE)
		{
		  $sql = "DELETE FROM content_types
				  WHERE CONTENT_TYPE_ID = '$id' ";
						
		  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		  // error reporting 
		  if($result === false) 
		  { error_report_Helpers('Error Deleting Content Type - (delete_Content_Types)',$sql,$result); }
		  
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
	function html_list_Content_Types($id=FALSE,$values=FALSE)
	{
	  $sql = ' SELECT '.COLUMNS_CONTENT_TYPES.' FROM content_types ct ';	
	  $sql.= ' ORDER BY ct.TYPE';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { error_report_Helpers('Error Creating Content Types HTML List - html_list_Content_Types',$sql,$result); }
	  
	  echo '<select name="CONTENT_TYPE_ID" '.$values.'>';
	  while($data = $_SESSION['FETCH_ARRAY']($result))
	  {
		if($data['CONTENT_TYPE_ID'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$data['CONTENT_TYPE_ID'].'" '.$selected.'>'.$data['PT_TYPE'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/