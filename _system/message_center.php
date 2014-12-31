<?php
/* _SYSTEM.MESSAGE_CENTER */
/*****************************************************************/

/**
  * @desc	collection of return messages to the user based on param
  * @param	$result
  * @return $return
*/
	function messages($result)
	{
	  switch($result)
	  {
		case("vars_saved"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>All data has been saved</strong>
				   </div>';
		break;
		
		case("vars_cleared"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>All data in this form has been cleared</strong>
				   </div>';
		break;
		
		case("email_duplicate"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Email address has already been registered<br /><br /></strong>
					<a data-toggle="modal" href="#forgot-password" class="btn btn-danger">Forgot Password</a> 
				   </div>';
		break;
		
		case("email_invalid"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Email address is either not formatted correctly or the domain does not exist.</strong>
				   </div>';
		break;

		case("email_not_found"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Not able to find that email address.</strong>
				   </div>';
		break;

		case("email_sent"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Email has been sent with login credentials</strong><br />
					Please check your email for detials and verify '.EMAIL_GENERAL_REPLY_ADDRESS.' is in your safe sender list.
				   </div>';
		break;

		case("email_not_sent"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Email has NOT been sent due to an error.</strong>
				   </div>';
		break;
		
		case("change_password"):
		$return = '<div class="alert alert-danger fade in">
					<strong>Please change your password and email address</strong>
				   </div>
				   <div class="alert alert-info fade in">
					As a security measure, you must change the login credentials.<br />
					Once you have changed it, you will be logged out and will need to enter your new credentials.<br />
					You will also receive an email to the email address you type below.<br />
				   </div>
				  ';
		break;
		
		case("category_duplicate"):
		$return = '<div class="alert alert-danger fade in">
					<strong>A Category with that name has already been created<br /><br /></strong>
				   </div>';
		break;
		
		case("login"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Please log in.</strong> 
				   </div>';			
		break;
		
		case("logout"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>You have successfully logged out.</strong> 
				   </div>';			
		break;
		
		case("timed_out"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Your session has expired.<br />Please login again</strong> 
				   </div>';			
		break;
		
		case("user_not_found"):
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Invalid login credentials</strong> 
				   </div>';	
		break;
		
		case("created"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Entry has been created</strong> 
				   </div>';			
		break;
		
		case("updated"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Entry has been updated</strong> 
				   </div>';			
		break;
		
		case("deleted"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Entry has been deleted</strong> 
				   </div>';			
		break;

		case("not_able_to_delete"):
		$return = '<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Not able to delete</strong> 
				   </div>';			
		break;
				
		case("error"):		
		$return = '<div class="alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>An error has occured.</strong> 
				   </div>';
		break;

		default:
		$return = '';
		
	  }
	  return $return;
	}
/*****************************************************************/

?>