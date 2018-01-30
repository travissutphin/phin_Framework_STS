<?php
/* SITES.FUNCTIONS */
/*****************************************************************/


/** 
  * @desc	create record
  * @param	$_POST
  * @return none - redirect done in function
*/
	function create_Sites()
	{	  
  
	}
/*****************************************************************/


/** 
  * @desc	read 
  * @param	$id
  * @return complete query
*/
	function read_Sites($id=FALSE)
	{
		$sql = 'SELECT '.COLUMNS_SITES.' FROM SITES sites ';	
		
		// by id
		if($id !== FALSE)
		{ $sql.= " WHERE sites.SITE_ID = '$id' "; }  
		
		$sql.= ' ORDER BY sites.SITE_ID ';
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Role - (read_Sites)',$sql,$result); }
		
		return $result;
	}
/*****************************************************************/


/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_roles = read_values_Sites($id='1');
  *			echo $values_roles['id']; // id would be lowercase
*/
	function read_values_Sites($id=FALSE, $site=FALSE)
	{
		$sql = 'SELECT '.COLUMNS_SITES.' FROM SITES sites ';	
		$sql.= ' WHERE 0 = 0 ';
		
		// by id
		if($id !== FALSE)
		{ $sql.= " AND sites.SITE_ID = '$id' "; }  

		// by site
		if($site !== FALSE)
		{ $sql.= " AND sites.SITE = '$site' "; }  
		
		$sql.= ' ORDER BY sites.SITE_ID ';
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
		// error reporting 
		if($result === false) 
		{ 
		  error_report_Helpers('Error Reading Role Values - (read_values_Sites)',$sql,$result);
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
	function update_Sites()
	{
	  	  
	}
/*****************************************************************/


/** 
  * @desc	delete
  * @param	
  * @return none
*/
	function delete_Sites()
	{

	}
/*****************************************************************/


/** 
  * @desc	html select list
  * @param	
  * @return echo out
*/
	function html_list_Sites()
	{

	}
/*****************************************************************/