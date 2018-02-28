<?php
/* IP_LOG.FUNCTIONS */
/*****************************************************************/
/** 
  * @desc	create record
  * @param	
  * @return none - redirect will occur accordingly
*/
	function create_IP_Log($ip,$site_fk,$attempted_access_to,$member_fk=FALSE,$email=FALSE)
	{
		if($member_fk == FALSE){
			$member_fk = NULL;
		}				if($email == FALSE){			$email = NULL;		}
		$today = date("Y-m-d H:i:s");	  		
		$sql = "INSERT INTO IP_LOG
			  (IP_ADDRESS,SITE_FK,CREATED_AT,ATTEMPTED_ACCESS_TO,MEMBER_FK,EMAIL) 
			  VALUES ('$ip','$site_fk','$today','$attempted_access_to','$member_fk','$email') " ;
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - create_IP_Log()',$sql,$result); }
		$message = 'created';
		return $message;		  
	}
/*****************************************************************/
/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_IP_Log($ip_log_id=FALSE,$ip_address=FALSE,$site_fk=FALSE,$attempted_access_to,$member_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_IP_LOG.' FROM IP_LOG il ';		
		$sql.= " WHERE 0=0 ";
		if($ip_log_id != FALSE){			$sql.= " AND il.IP_LOG_ID = '$ip_log_id' ";		}				if($ip_address != FALSE){
			$sql.= " AND il.IP_ADDRESS = '$ip_address' ";
		}
		if($site_fk != FALSE){
			$sql.= " AND il.SITE_FK = '$site_fk' ";
		}		if($attempted_access_to != FALSE){			$sql.= " AND il.ATTEMPTED_ACCESS_TO = '$attempted_access_to' ";		}		if($user_fk != FALSE){			$sql.= " AND il.MEMBER_FK = '$member_fk' ";		}		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - read_IP_Log()',$sql,$result); }		
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
	function read_values_IP_Log($ip_log_id=FALSE,$ip_address=FALSE,$site_fk=FALSE,$attempted_access_to,$member_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_IP_LOG.' FROM IP_LOG il ';				$sql.= " WHERE 0=0 ";		if($ip_log_id != FALSE){			$sql.= " AND il.IP_LOG_ID = '$ip_log_id' ";		}				if($ip_address != FALSE){			$sql.= " AND il.IP_ADDRESS = '$ip_address' ";		}		if($site_fk != FALSE){			$sql.= " AND il.SITE_FK = '$site_fk' ";		}		if($attempted_access_to != FALSE){			$sql.= " AND il.ATTEMPTED_ACCESS_TO = '$attempted_access_to' ";		}		if($user_fk != FALSE){			$sql.= " AND il.MEMBER_FK = '$member_fk' ";		}				$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - read_values_IP_Log',$sql,$result); }
		// loop over row and create vars
		// create array of values from this record
		$array = array();
		$data = $_SESSION['FETCH_ARRAY']($result);
		if($data != NULL) {
			foreach($data as $key => $value) // creates assocative array
			{
				if(!is_numeric($key))
				{ $array = array_merge($array, array(strtolower($key) => $value)); }
			}  
		}
		return $array;
	}
/*****************************************************************/
/** 
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_IP_Log()
	{
		// will not need to update these records
	}
/*****************************************************************/
/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_IP_Log()
	{
		// will not need to delete these records	
	}
/*****************************************************************/
?>