<?php
/* CLUBS.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Clubs()
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
				
				$sql = "INSERT INTO CLUBS
						($data_columns) 
						VALUES ($data_values) 
					   ";
	  
			  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			  
			  // error reporting 
			  if($result === false) 
			  { error_report_Helpers('Error Creating User - (create_Clubs)',$sql); }
			
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
	function read_Clubs($id=FALSE,$site_fk=FALSE,$address=FALSE,$city=FALSE,$state=FALSE,$zip=FALSE,$search=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_CLUBS.' FROM CLUBS club ';
		$sql.= ' WHERE 0=0 ';

		// by id
		if($id !== FALSE)
		{	$sql.= " AND club.CLUB_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND club.SITE_FK = '$site_fk' "; }

		// by address
		if($address !== FALSE)
		{	$sql.= " AND club.ADDRESS LIKE %'$address'% "; }

		// by city
		if($city !== FALSE)
		{	$sql.= " AND club.CITY = '$city' "; }

		// by state
		if($state !== FALSE)
		{	$sql.= " AND club.STATE = '$state' "; }

		// by zip
		if($zip !== FALSE)
		{	$sql.= " AND club.ZIP = '$zip' "; }

		// search
		if ( $search !== FALSE )
		{ $sql.= " AND club.TITLE LIKE '%$search%' " ; }
		
		$sql.= ' AND club.DELETED_AT IS NULL ';
		
		$sql.= ' ORDER BY club.DATE_FROM ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		if($result === false) 
		{ error_report_Helpers('Error Reading Clubs - (read_Clubs)',$sql); }

		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_users = read_values_Clubs($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_Clubs($id=FALSE,$site_fk=FALSE,$address=FALSE,$city=FALSE,$state=FALSE,$zip=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_CLUBS.' FROM CLUBS club ';
		$sql.= ' WHERE 0=0 ';
		// by id
		if($id !== FALSE)
		{	$sql.= " AND club.CLUB_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND club.SITE_FK = '$site_fk' "; }

		// by address
		if($address !== FALSE)
		{	$sql.= " AND club.ADDRESS LIKE %'$address'% "; }

		// by city
		if($city !== FALSE)
		{	$sql.= " AND club.CITY = '$city' "; }

		// by state
		if($state !== FALSE)
		{	$sql.= " AND club.STATE = '$state' "; }

		// by zip
		if($zip !== FALSE)
		{	$sql.= " AND club.ZIP = '$zip' "; }

		$sql.= ' AND club.DELETED_AT IS NULL ';
		
		$sql.= ' ORDER BY club.DATE_FROM ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Clubs Values - (read_values_Clubs)',$sql); }
		
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
	function update_Clubs()
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
			
			$sql = "UPDATE CLUBS
					SET ".$data_update."
					WHERE CLUB_ID = '$_POST[CLUB_ID]'
				   ";
		
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Updating Clubs - (update_Clubs)',$sql); }
		
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Clubs( $id=FALSE )
	{
	  $deletedAt = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
	  $message = 'not_able_to_delete';
	  
	  if( $id != FALSE )
	  {
		$sql = 	"UPDATE CLUBS
					SET DELETED_AT = '$deletedAt'
					WHERE CLUB_ID = '$_POST[CLUB_ID]'
					";
					
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Clubs - (delete_Clubs)',$sql); }
	  
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
	function html_list_Clubs($id=FALSE,$values=FALSE,$role_id=FALSE)
	{
	
		// removed, not sure how/why/if we need this.
	 
	}
/*****************************************************************/
	
?>