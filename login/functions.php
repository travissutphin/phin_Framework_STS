<?php
/* LOGIN.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	attempt to log the user in and redirect appropriately
  * @param	$_POST['email'] - $_POST['password']
  * @return none
*/
	function validate_Login()
	{			  
		$email = cleanInput_Security($_POST['EMAIL']);
		$password = cleanInput_Security($_POST['PASSWORD']);
		
		$sql = 'SELECT '.COLUMNS_MEMBERS.' FROM MEMBERS mem ';	
	  	$sql.= " WHERE mem.EMAIL = '".$email."' ";	
	  	$sql.= "   AND mem.PASSWORD = '".$password."' ";  

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Validating Login - (validate_Login)',$sql,$result); }
	
		$num_rows = $_SESSION['NUM_ROWS']($result);
		  
		if($num_rows == "1") // login credentials are correct 
		{
			while($row = $_SESSION['FETCH_ARRAY']($result))
			{	
				set_variables_Login($row['MEMBER_ID']); // save session vars for this user
				
				// log users IP address
				$ip = detect_ip_address_Security();
		
				// log failed registration attempt
				create_IP_Log($ip,SITE_ID,'Login - Success',$row['MEMBER_ID']);
				
				header( 'Location: ../dashboard/' ) ;
				exit;
			}
		}else{
		
			// log users IP address
			$ip = detect_ip_address_Security();
		
			// log failed registration attempt
			create_IP_Log($ip,SITE_ID,'Login - Failure',FALSE,$email);
				
			header( 'Location: view.php?message=user_not_found' ) ;
			exit;
		}
		
		return $result;
	}
/*****************************************************************/

/** 
  * @desc
  * @param
  * @return
*/
	function set_variables_Login($id)
	{
		$result = read_Members($id,$email=FALSE);
	
	  	// error reporting 
	  	if($result === false) 
	  	{ 
			error_report_Helpers('Error Setting Login Variables - login.functions.set_variables_Login',$sql,$result);
	  	}
	  
	  	while ($row = $_SESSION['FETCH_ARRAY']($result))
	  	{	

			$_SESSION['members.is_logged_in'] = TRUE ;
		 	$_SESSION['members.id'] = $row['MEMBER_ID'] ;
		 	$_SESSION['members.email'] = $row['EMAIL'] ;
		 	$_SESSION['members.name_first'] = $row['NAME_FIRST'] ;
		 	$_SESSION['members.name_last'] = $row['NAME_LAST'] ;
		 	$_SESSION['members.role_id'] = $row['ROLE_ID'] ;
 		 	$value_roles = read_values_Roles($row['ROLE_ID']);
			$_SESSION['members.role'] = $value_roles['role_name'];
		 	$_SESSION['members.login_attempts'] = $row['LOGIN_ATTEMPTS'] ;
	  	}
	}
/*****************************************************************/

/** 
  * @desc
  * @param
  * @return
*/
	function clear_variables_Login()
	{
	   unset($_SESSION['members.id']) ;
	   unset($_SESSION['members.email']) ;
	   unset($_SESSION['members.name_first']) ;
	   unset($_SESSION['members.name_last']) ;
	   unset($_SESSION['members.role_id']) ;
	   unset($_SESSION['members.login_attempts']) ;
	   unset($_SESSION['members.role']) ;
	   unset($_SESSION['site_id']);
	   unset($_SESSION);
	   
	   session_destroy();
		
	  header( 'Location: '.site_Url().'login/view.php?message=logout' ) ; 	
	  exit;
	}
/*****************************************************************/

/** 
  * @desc
  * @param
  * @return
*/
	function validate_variables_Login()
	{
		if(!isset($_SESSION['members.role_id']))
		{
		  $_SESSION['message'] = "timed_out";
		  header( 'Location: '.site_Url() ) ;
		  exit;
		}
	}
/*****************************************************************/

?>