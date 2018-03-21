<?php
/* PRIVATE_MASSAGES.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Private_Messages()
	{	  		
		// set needed variables
		$_POST['CREATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
		$_POST['MEMBER_FK'] = $_SESSION['members.id'];
		$_POST['RECIPIENT_MEMBER_FK'] = $_SESSION['private_message_member_id'];
		$_POST['SITE_FK'] = $_SESSION['site_id'];
		
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
					
					$sql = "INSERT INTO PRIVATE_MESSAGES
							($data_columns) 
							VALUES ($data_values) 
						   ";
		  
				  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
				  
				  // error reporting 
				  if($result === false) 
				  { error_report_Helpers('Error Creating User - (create_Private Messages)',$sql); }

				  $message = 'created';
				  
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
	function read_Private_Messages($id=FALSE,$site_fk=FALSE,$member_fk=FALSE, $recipient_member_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_PRIVATE_MESSAGES.' FROM PRIVATE_MESSAGES pm ';
		$sql.= ' WHERE 0=0 ';
		
		// by id
		if($id !== FALSE)
		{	$sql.= " AND pm.PRIVATE_MESSAGE_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND pm.SITE_FK = '$site_fk' "; }

		// by member_fk
		if($member_fk !== FALSE and $recipient_member_fk !== FALSE ){
			$sql.= " AND ( ( pm.MEMBER_FK = '$member_fk'  AND pm.RECIPIENT_MEMBER_FK = '$recipient_member_fk'  ) "; 
			$sql.= " OR ( pm.MEMBER_FK = '$recipient_member_fk'  AND pm.RECIPIENT_MEMBER_FK = '$member_fk' ) ) "; 
		}
		
		$sql.= ' ORDER BY pm.CREATED_AT DESC ';
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		if($result === false) 
		{ error_report_Helpers('Error Reading Private Messages - (read_Private Messages)',$sql); }

		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_users = read_values_Private Messages($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_Private_Messages($id=FALSE,$site_fk=FALSE,$advertiser_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_PRIVATE_MESSAGES.' FROM PRIVATE_MESSAGES pm ';
		$sql.= ' WHERE 0=0 ';
		
		// by id
		if($id !== FALSE)
		{	$sql.= " AND pm.PRIVATE_MESSAGE_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND pm.SITE_FK = '$site_fk' "; }

		// by advertiser_fk
		if($advertiser_fk !== FALSE)
		{	$sql.= " AND pm.PRIVATE_MESSAGEVERTISER_FK = '$advertiser_fk' "; }

		$sql.= ' AND pm.DELETED_AT IS NULL ';
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Private Messages Values - (read_values_Private Messages)',$sql); }

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
	function update_Private_Messages()
	{	  	
			$_POST['UPDATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
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
			
			$sql = "UPDATE PRIVATE_MESSAGES
					SET ".$data_update."
					WHERE PRIVATE_MESSAGE_ID = '$_POST[PRIVATE_MESSAGE_ID]'
				   ";

			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			$message = 'updated';
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Updating Private Messages - (update_Private Messages)',$sql); }
		
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Private_Messages( $id=FALSE )
	{
	  $deletedAt = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
	  $message = 'not_able_to_delete';
	  
	  if( $id != FALSE )
	  {
		$sql = 	"UPDATE PRIVATE_MESSAGES
					SET DELETED_AT = '$deletedAt'
					WHERE PRIVATE_MESSAGE_ID = '$_POST[PRIVATE_MESSAGE_ID]'
					";
					
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Private Messages - (delete_Private Messages)',$sql); }
	  
		$message = 'deleted';
	  }
	  
	  return $message;
	}
/*****************************************************************/

/** 	
  * @desc	update all read messages so we know they have been seen
  * @param	$id (specific record)
  * @return none
*/
	function update_read_Private_Messages()
	{	  	
			$_POST['UPDATED_AT'] = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
			$_POST['member_id'] = $_SESSION['members.id'];
			$data_update = "";
			
			$sql = "UPDATE PRIVATE_MESSAGES
						SET UPDATED_AT = '$_POST[UPDATED_AT]'
						WHERE RECIPIENT_MEMBER_FK = '$_POST[member_id]'
						AND UPDATED_AT IS NULL
				   ";

			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			$message = 'updated';
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Updating Private Messages - (update_Private Messages)',$sql); }
		
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_users = read_values_Private Messages($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_unread_Private_Messages($site_fk=FALSE,$member_fk=FALSE,$recipient_member_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_PRIVATE_MESSAGES.' FROM PRIVATE_MESSAGES pm ';
		$sql.= ' WHERE 0=0 ';

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND pm.SITE_FK = '$site_fk' "; }
		
		// by member_fk
		if($member_fk !== FALSE)
		{	$sql.= " AND pm.MEMBER_FK = '$recipient_member_fk' "; }	

		// by recipient_member_fk
		if($recipient_member_fk !== FALSE)
		{	$sql.= " AND pm.RECIPIENT_MEMBER_FK = '$member_fk' "; }			

		$sql.= ' AND pm.UPDATED_AT IS NULL ';
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Private Messages Values - (read_values_Private Messages)',$sql); }

		return $_SESSION['NUM_ROWS']($result);
	}
/*****************************************************************/


/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Private_Messages($id=FALSE,$site_fk=FALSE,$advertiser_fk=FALSE)
	{
	
		// removed, not sure how/why/if we need this.
	 
	}
/*****************************************************************/

/** 
  * @desc	the output view of the ads on the site
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function display_Private_Messages($id=FALSE,$site_fk=FALSE,$advertiser_fk=FALSE)
	{
	
		// need to create this based on details decided on how they will be displayed.
	 
	}
/*****************************************************************/
	
?>