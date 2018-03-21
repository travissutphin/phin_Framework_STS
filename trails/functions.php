<?php
/* TRAILS.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Trails()
	{	  		
		// set needed variables
		$_POST['CREATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
				  
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
				
				$sql = "INSERT INTO TRAILS
						($data_columns) 
						VALUES ($data_values) 
					   ";
	  
			  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			  
			  // error reporting 
			  if($result === false) 
			  { error_report_Helpers('Error Creating User - (create_Trails)',$sql); }
			
			  $id = last_inserted_id_Helpers($result); // id of the last inserted record

			  $message = 'created';
			 
			  //registration_info_Email($id); // email new user login details
			  
			  // clear values as session vars
			  clear_postVars_to_sessionVars_Helpers();
			  //foreach ($_POST as $key => $value) 
			  //{
			//	$_SESSION[$key] = '';		  
			  //}
			
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Trails($id=FALSE,$site_fk=FALSE,$address=FALSE,$city=FALSE,$state=FALSE,$zip=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_TRAILS.' FROM TRAILS trail ';
		$sql.= ' WHERE 0=0 ';

		// by id
		if($id !== FALSE)
		{	$sql.= " AND trail.TRAIL_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND trail.SITE_FK = '$site_fk' "; }

		// by address
		if($address !== FALSE)
		{	$sql.= " AND trail.ADDRESS LIKE %'$address'% "; }

		// by city
		if($city !== FALSE)
		{	$sql.= " AND trail.CITY = '$city' "; }

		// by state
		if($state !== FALSE)
		{	$sql.= " AND trail.STATE = '$state' "; }

		// by zip
		if($zip !== FALSE)
		{	$sql.= " AND trail.ZIP = '$zip' "; }
		
		$sql.= ' AND trail.DELETED_AT IS NULL ';
		
		$sql.= ' ORDER BY trail.TITLE ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		if($result === false) 
		{ error_report_Helpers('Error Reading Trails - (read_Trails)',$sql); }

		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_users = read_values_Trails($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_Trails($id=FALSE,$site_fk=FALSE,$address=FALSE,$city=FALSE,$state=FALSE,$zip=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_TRAILS.' FROM TRAILS trail ';
		$sql.= ' WHERE 0=0 ';
		// by id
		if($id !== FALSE)
		{	$sql.= " AND trail.TRAIL_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND trail.SITE_FK = '$site_fk' "; }

		// by address
		if($address !== FALSE)
		{	$sql.= " AND trail.ADDRESS LIKE %'$address'% "; }

		// by city
		if($city !== FALSE)
		{	$sql.= " AND trail.CITY = '$city' "; }

		// by state
		if($state !== FALSE)
		{	$sql.= " AND trail.STATE = '$state' "; }

		// by zip
		if($zip !== FALSE)
		{	$sql.= " AND trail.ZIP = '$zip' "; }

		$sql.= ' AND trail.DELETED_AT IS NULL ';
		
		$sql.= ' ORDER BY trail.TITLE ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Trails Values - (read_values_Trails)',$sql); }
		
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
	function update_Trails()
	{	  	
			$_POST['UPDATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
			
			$data_update = "";
			
			$message = 'updated';	
			
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
			
			$sql = "UPDATE TRAILS
					SET ".$data_update."
					WHERE TRAIL_ID = '$_POST[TRAIL_ID]'
				   ";
		
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Updating Trails - (update_Trails)',$sql); }
		
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Trails( $id=FALSE )
	{
	  $deletedAt = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
	  $message = 'not_able_to_delete';
	  
	  if( $id != FALSE )
	  {
		$sql = 	"UPDATE TRAILS
					SET DELETED_AT = '$deletedAt'
					WHERE TRAIL_ID = '$_POST[TRAIL_ID]'
					";
					
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Trails - (delete_Trails)',$sql); }
	  
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
	function html_list_Trails($id=FALSE,$values=FALSE,$role_id=FALSE)
	{
	
		// removed, not sure how/why/if we need this.
	 
	}
/*****************************************************************/
	
?>