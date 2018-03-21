<?php
/* MY_PROFILE.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_My_Profile()
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
					
					$sql = "INSERT INTO ADS
							($data_columns) 
							VALUES ($data_values) 
						   ";
		  
				  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
				  
				  // error reporting 
				  if($result === false) 
				  { error_report_Helpers('Error Creating User - (create_Ad)',$sql); }

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
	function read_My_Profile($id=FALSE,$site_fk=FALSE,$advertiser_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_ADS.', '.COLUMNS_ADVERTISERS.' FROM ADS ad ';
		$sql.= ' JOIN ADVERTISERS adv ON adv.ADVERTISER_ID = ad.ADVERTISER_FK  ';
		$sql.= ' WHERE 0=0 ';
		
		// by id
		if($id !== FALSE)
		{	$sql.= " AND ad.AD_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND ad.SITE_FK = '$site_fk' "; }

		// by advertiser_fk
		if($advertiser_fk !== FALSE)
		{	$sql.= " AND ad.ADVERTISER_FK = '$advertiser_fk' "; }
		
		$sql.= ' AND ad.DELETED_AT IS NULL ';
		
		$sql.= ' AND adv.DELETED_AT IS NULL ';
		
		$sql.= ' ORDER BY NAME ';
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		if($result === false) 
		{ error_report_Helpers('Error Reading Ad - (read_Ad)',$sql); }

		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_users = read_values_Ad($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_My_Profile($id=FALSE,$site_fk=FALSE,$advertiser_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_ADS.' FROM ADS ad ';
		$sql.= ' WHERE 0=0 ';
		
		// by id
		if($id !== FALSE)
		{	$sql.= " AND ad.AD_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND ad.SITE_FK = '$site_fk' "; }

		// by advertiser_fk
		if($advertiser_fk !== FALSE)
		{	$sql.= " AND ad.ADVERTISER_FK = '$advertiser_fk' "; }

		$sql.= ' AND ad.DELETED_AT IS NULL ';
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Ad Values - (read_values_Ad)',$sql); }

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
	function update_My_Profile()
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
			
			$sql = "UPDATE ADS
					SET ".$data_update."
					WHERE AD_ID = '$_POST[AD_ID]'
				   ";

			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			$message = 'updated';
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Updating Ad - (update_Ad)',$sql); }
		
		return $message;
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_My_Profile( $id=FALSE )
	{
	  $deletedAt = format_Dates_Times(date('Y-m-d H:i:s'),'database_table');
	  $message = 'not_able_to_delete';
	  
	  if( $id != FALSE )
	  {
		$sql = 	"UPDATE ADS
					SET DELETED_AT = '$deletedAt'
					WHERE AD_ID = '$_POST[AD_ID]'
					";
					
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  	
		// error reporting 
	  	if($result === false) 
	  	{ error_report_Helpers('Error Deleting Ad - (delete_Ad)',$sql); }
	  
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
	function html_list_My_Profile($id=FALSE,$site_fk=FALSE,$advertiser_fk=FALSE)
	{
	
		// removed, not sure how/why/if we need this.
	 
	}
/*****************************************************************/

/** 
  * @desc	the output view of the ads on the site
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function display_My_Profile($id=FALSE,$site_fk=FALSE,$advertiser_fk=FALSE)
	{
	
		// need to create this based on details decided on how they will be displayed.
	 
	}
/*****************************************************************/
	
?>