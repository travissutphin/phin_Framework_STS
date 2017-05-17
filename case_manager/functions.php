<?php
/* .FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	all posted vars
  * @return none - redirect will occur accordingly
*/
	function create_()
	{	  
		$data_columns = "";
		$data_values = "";
		
		foreach ($_POST as $key => $value) 
		{
			// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
			if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === FALSE) // $_SESSION['ignore'] = _system/config.php
			{
			  $value = cleanInput_Security($value,'encrypt');
			  $data_columns.= $key.",";
			  $data_values.= "'$value',";
			}
		}
		$data_columns = rtrim($data_columns, ','); // remove comma from end of string
		$data_values = rtrim($data_values, ','); // remove comma from end of string
		
		$sql = "INSERT INTO case_manager
			  ($data_columns) 
			  VALUES ($data_values) " ;
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Message to User HERE - file location and function name HERE',$sql,$result); }
		
		$message = 'created';
		
		return $message;		  
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_($id=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_CASE_MANAGER.' FROM case_manager WHERE 0=0 ';	
		
		if($id !== FALSE)
		{ $sql.= " AND id = '$id' "; }  
		
		$sql.= " ORDER BY fields ";
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Message to User HERE - file location and function name HERE',$sql,$result); }
		
		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read table, create array of values
  * @param	$id
  * @return specific values of a record stored in an array
  * @to use	
  *			$array_data = read_values_($id);
  *			echo $array_data['id'];
*/
	function read_values_($id=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_CASE_MANAGER.' FROM case_manager  WHERE 0=0 ';	
		if($id !== FALSE)
		{ $sql.= " AND ID = '$id' "; }  
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Message to User HERE - file location and function name HERE',$sql,$result); }
		
		// loop over row and create vars
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
	function update_()
	{
		$data_update = "";
		foreach ($_POST as $key => $value) 
		{
			// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
			if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === FALSE) // $_SESSION['ignore'] = _system/config.php
			{
		  		$value = cleanInput_Security($value,'encrypt');
				$data_update.= $key." = '".$value."',";
		  	}
		}
		$data_update = rtrim($data_update, ','); // remove comma from end of string
			  
		$sql = "UPDATE your_table_name_goes_here
				SET ".$data_update."
				WHERE ID = '$_POST[ID]'
			   ";
			 
	  	$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  	// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Message to User HERE - file location and function name HERE',$sql,$result); }
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_($id=FALSE)
	{
		if($id !== FALSE)
		{
			$sql = "DELETE FROM case_manager
					WHERE id = '$id' ";
						  
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Message to User HERE - file location and function name HERE',$sql,$result); }
		}
	}
/*****************************************************************/

/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_($id=FALSE,$values=FALSE)
	{
	  $sql = ' SELECT '.COLUMNS_CASE_MANAGER.' FROM case_manager ';	
	  $sql.= ' ORDER BY column';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  {	error_report_Helpers('Error Message to User HERE - file location and function name HERE',$sql,$result); }
	  
	  echo '<select name="id" "'.$values.'">';
	  while($row = sqlsrv_fetch_array($result))
	  {
		if($row['ID'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$row['ID'].'" '.$selected.'>'.$row['your_value'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/

?>
