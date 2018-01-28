<?php
/* STUFF_REPORTED.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Stuff_Reported()
	{	  		
		// set needed variables
		$createdAt = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
				  
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

				$data_columns = rtrim($data_columns, ','); // remove comma from end of string
				$data_values = rtrim($data_values, ','); // remove comma from end of string
				
				$sql = "INSERT INTO STUFF_REPORTED
						($data_columns) 
						VALUES ($data_values) 
					   ";
	  
			  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			  
			  // error reporting 
			  if($result === false) 
			  { error_report_Helpers('Error Creating User - (create_Stuff_Reported)',$sql); }
			
			  $id = last_inserted_id_Helpers($result); // id of the last inserted record

			  $message = 'created';
			  
			  // clear values as session vars
			  clear_postVars_to_sessionVars_Helpers();
			
			}
			
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Stuff_Reported($id=FALSE,$site_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_STUFF_REPORTED.' FROM STUFF_REPORTED sr ';

		// by id
		if($id !== FALSE)
		{	$sql.= " AND sr.STUFF_REPORTED_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND sr.SITE_FK = '$site_fk' "; }

		$sql.= ' ORDER BY sr.CREATED-AT ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		if($result === false) 
		{ error_report_Helpers('Error Reading Stuff_Reported - (read_Stuff_Reported)',$sql); }

		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_users = read_values_Stuff_Reported($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_Stuff_Reported($id=FALSE,$site_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_STUFF_REPORTED.' FROM STUFF_REPORTED sr ';

		// by id
		if($id !== FALSE)
		{	$sql.= " AND sr.STUFF_REPORTED_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND sr.SITE_FK = '$site_fk' "; }

		$sql.= ' ORDER BY sr.CREATED-AT ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Stuff_Reported Values - (read_values_Stuff_Reported)',$sql); }
		
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
	function update_Stuff_Reported()
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
			
			$sql = "UPDATE STUFF_REPORTED
					SET ".$data_update."
					WHERE STUFF_REPORTED_ID = '$_POST[STUFF-REPORTED_ID]'
				   ";
		
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Updating Stuff_Reported - (update_Stuff_Reported)',$sql); }
		
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Stuff_Reported( $id=FALSE )
	{
	  $deletedAt = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
	  $message = 'not_able_to_delete';
	  
	  if( $id != FALSE )
	  {
		$sql = 	"UPDATE STUFF_REPORTED
					SET DELETED_AT = '$deletedAt'
					WHERE STUFF_REPORTED_ID = '$_POST[STUFF_REPORTED_ID]'
					";
					
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Stuff_Reported - (delete_Stuff_Reported)',$sql); }
	  
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
	function html_list_Stuff_Reported($id=FALSE,$values=FALSE,$role_id=FALSE)
	{
	
		// removed, not sure how/why/if we need this.
	 
	}
/*****************************************************************/
	
?>