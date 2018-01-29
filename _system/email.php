<?php
/* _SYSTEM.EMAIL */
/*****************************************************************/

	// LIST OF FUNCTIONS CONTAINED//
	////////////////////////////////
	
	// send_Email() - all purpose to send email
	// retrieve_password_Email()
	// registration_info_Email()
	// validate_Email() - based on email syntax as well as MX and A records

/*****************************************************************/

/**
  * @desc	trigger the php mail() function
  * @param	$email_to, $subject, $message, $from
  * @return none - just sends email
*/
	function send_Email($to,$subject,$message,$from)
	{
	  $return_message = "email_sent";
	  $to = $to;
	  $subject = $subject ;
	  $message = $message ;
	  $headers = "MIME-Version: 1.0\r\n";
	  $headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	  $headers.= "From: ".$from." ";
	  
	  if(!mail($to,$subject,$message,$headers))
	  {
		$return_message = "email_not_sent";  
	  }
	  
	  return $return_message;	  
	}

/*****************************************************************/


/**
  * @desc	
  * @param	
  * @return 
*/
	function retrieve_password_Email()
	{		
		$data_user = read_Users(FALSE,$_POST['EMAIL']);
		$num = $_SESSION['NUM_ROWS']($data_user);  
				
		if($num == "1")// found email
		{
			$email = $_POST['EMAIL'];
			while($data = $_SESION['FETCH_ARRAY']($data_user))
	  		{
				$password = $data['PASSWORD'];
			}
			$subject = TITLE." Password Retrieval";
			$message = "Your password for ".TITLE." is ".$password;
			$message.= '<br /><br /><a href="'.site_Url().'">'.site_Url().'</a>';
			$message.= '<br /><br /><br />';
			$message.= 'Please do not reply to this email. It is not monitored.';

			$return_message = send_Email($email,$subject,$message,EMAIL_GENERAL_REPLY_ADDRESS);
			header( 'Location: '.site_Url().'login/view.php?message='.$return_message.' ' ) ;
			exit;
		}
		else// email not found
		{
			header( 'Location: '.site_Url().'login/view.php?message=email_not_found' ) ;
			exit;	
		}

	}

/*****************************************************************/


/**
  * @desc	send email to new user with login info and password
  * @param	$id
  * @return none - creates format to send email and passes it to 
  *			send_Email()
*/		  
	function registration_info_Email($id)
	{	
		$data_user = read_Users($id,FALSE);
		$num = $_SESSION['NUM_ROWS']($data_user);  

		if($num == "1") // found data
		{
			while ($row = $_SESSION['FETCH_ARRAY']($data_user))
			{
				$return_message = "email_sent";
				// build data for send_Email()
				$email = $_POST['EMAIL'];
				$password = $row['PASSWORD'];
				$subject = "Welcome to ".TITLE;
				$message = "Your password for ".TITLE." is ".$password;
				$message.= '<br /><br /><a href="'.site_Url().'">'.site_Url().'</a>';
				$message.= '<br /><br /><br />';
				$message.= 'Please do not reply to this email. It is not monitored.';
				
				$return_message = send_Email($email,$subject,$message,EMAIL_GENERAL_REPLY_ADDRESS);
			}
		}
		else // data not found
		{
			$return_message = 'email_not_found';
		}
		
		header( 'Location: '.site_Url().'login/view.php?message='.$return_message ) ;
		exit;
	}
/*****************************************************************/



/**
  * @desc	validate an email address.
  * @param	$email
  * @return $isvalid
  *	@note	returns true if the email address has the email 
  *			address format and the domain exists.	
*/	
	function validate_Email($email)
	{
		$isValid = true;
		$atIndex = strrpos($email, "@");
		if (is_bool($atIndex) && !$atIndex)
		{
		  $isValid = false;
		}
		else
		{
		  $domain = substr($email, $atIndex+1);
		  $local = substr($email, 0, $atIndex);
		  $localLen = strlen($local);
		  $domainLen = strlen($domain);
		  if ($localLen < 1 || $localLen > 64)
		  {
			 // local part length exceeded
			 $isValid = false;
		  }
		  else if ($domainLen < 1 || $domainLen > 255)
		  {
			 // domain part length exceeded
			 $isValid = false;
		  }
		  else if ($local[0] == '.' || $local[$localLen-1] == '.')
		  {
			 // local part starts or ends with '.'
			 $isValid = false;
		  }
		  else if (preg_match('/\\.\\./', $local))
		  {
			 // local part has two consecutive dots
			 $isValid = false;
		  }
		  else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
		  {
			 // character not valid in domain part
			 $isValid = false;
		  }
		  else if (preg_match('/\\.\\./', $domain))
		  {
			 // domain part has two consecutive dots
			 $isValid = false;
		  }
		  else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
		  {
			 // character not valid in local part unless 
			 // local part is quoted
			 if (!preg_match('/^"(\\\\"|[^"])+"$/',
				 str_replace("\\\\","",$local)))
			 {
				$isValid = false;
			 }
		  }
		  
		if ($isValid && !(dns_check_record($domain,"MX") || dns_check_record($domain,"A")))
		{
			// domain not found in DNS
			$isValid = false;
		}
		  
	   }
	   return $isValid;
	}
/*****************************************************************/

?>