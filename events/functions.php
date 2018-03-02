<?php
/* EVENTS.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Events()
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
			}
				$data_columns = rtrim($data_columns, ','); // remove comma from end of string
				$data_values = rtrim($data_values, ','); // remove comma from end of string
				
				$sql = "INSERT INTO EVENTS
						($data_columns) 
						VALUES ($data_values) 
					   ";
	  
			  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			  
			  // error reporting 
			  if($result === false) 
			  { error_report_Helpers('Error Creating User - (create_Events)',$sql); }
			
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
	function read_Events($id=FALSE,$site_fk=FALSE,$address=FALSE,$city=FALSE,$state=FALSE,$zip=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_EVENTS.' FROM EVENTS ev ';

		// by id
		if($id !== FALSE)
		{	$sql.= " AND ev.EVENTS_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND ev.SITE_FK = '$site_fk' "; }

		// by address
		if($address !== FALSE)
		{	$sql.= " AND ev.ADDRESS LIKE %'$address'% "; }

		// by city
		if($city !== FALSE)
		{	$sql.= " AND ev.CITY = '$city' "; }

		// by state
		if($state !== FALSE)
		{	$sql.= " AND ev.STATE = '$state' "; }

		// by zip
		if($zip !== FALSE)
		{	$sql.= " AND ev.ZIP = '$zip' "; }

		$sql.= ' ORDER BY ev.DATE_FROM ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		if($result === false) 
		{ error_report_Helpers('Error Reading Events - (read_Events)',$sql); }

		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_users = read_values_Events($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_Events($id=FALSE,$site_fk=FALSE,$address=FALSE,$city=FALSE,$state=FALSE,$zip=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_EVENTS.' FROM EVENTS ev ';

		// by id
		if($id !== FALSE)
		{	$sql.= " AND ev.EVENTS_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND ev.SITE_FK = '$site_fk' "; }

		// by address
		if($address !== FALSE)
		{	$sql.= " AND ev.ADDRESS LIKE %'$address'% "; }

		// by city
		if($city !== FALSE)
		{	$sql.= " AND ev.CITY = '$city' "; }

		// by state
		if($state !== FALSE)
		{	$sql.= " AND ev.STATE = '$state' "; }

		// by zip
		if($zip !== FALSE)
		{	$sql.= " AND ev.ZIP = '$zip' "; }

		$sql.= ' ORDER BY ev.DATE_FROM ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Events Values - (read_values_Events)',$sql); }
		
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
	function update_Events()
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
			
			$sql = "UPDATE EVENTS
					SET ".$data_update."
					WHERE EVENT_ID = '$_POST[EVENT_ID]'
				   ";
		
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Updating Events - (update_Events)',$sql); }
		
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Events( $id=FALSE )
	{
	  $deletedAt = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
	  $message = 'not_able_to_delete';
	  
	  if( $id != FALSE )
	  {
		$sql = 	"UPDATE EVENTS
					SET DELETED_AT = '$deletedAt'
					WHERE EVENT_ID = '$_POST[EVENT_ID]'
					";
					
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Events - (delete_Events)',$sql); }
	  
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
	function html_list_Events($id=FALSE,$values=FALSE,$role_id=FALSE)
	{
	
		// removed, not sure how/why/if we need this.
	 
	}
/*****************************************************************/
	
?>