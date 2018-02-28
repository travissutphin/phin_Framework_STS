<?php
/* _SYSTEM.MESSAGE_CENTER */
/*****************************************************************/

/**
  * @desc	collection of return messages to the user based on param
  * @param	$result
  * @return $return
*/

// *** SECTIONS *** //
// VARIABLES //
// EMAILS //
// REGISTRATION, PASSWORD, LOGIN //
// PAGE MANAGEMENT //
// GENERAL //

	function messages($result)
	{
	  switch($result)
	  {
		
// VARIABLES //
			  
		case("vars_saved"):
		$return = '<div class="alert alert-success ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>All data has been saved</strong>
				   </div>';
		break;
		
		case("vars_cleared"):
		$return = '<div class="alert alert-success ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>All data in this form has been cleared</strong>
				   </div>';
		break;

// EMAILS //
			  
		case("email_duplicate"):
		$return = '<div class="alert alert-warning ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>WELCOME BACK</strong><br />Looks like that email address has already been registered.<br /><br />Use the recover password to get you logged back in.<br /><hr />
					<a href="view.php?display_form_recover_password" class="">Recover password</a> 
				   </div>';
		break;

		case("email_duplicate_on_update"):
		$return = '<div class="alert alert-danger ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>SORRY! UPDATE FAILED</strong><br />That email address is already in use. <br />
				   </div>';
		break;

		case("email_duplicate_on_create"):
		$return = '<div class="alert alert-warning ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>CREATE FAILED</strong><br />Looks like that email address has already been registered.
				   </div>';
		break;		
		
		case("email_invalid"):
		$return = '<div class="alert alert-danger ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Email address is either not formatted correctly or the domain does not exist.</strong>
				   </div>';
		break;

		case("email_not_found"):
		$return = '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Not able to find that email address.</strong>
				   </div>';
		break;

		case("email_sent"):
		$return = '<div class="alert alert-success ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>SENT</strong><br />An email has been sent with your login credentials<br />
					Please verify '.EMAIL_GENERAL_REPLY_ADDRESS.' is in your safe sender list.
				   </div>';
		break;

		case("email_not_sent"):
		$return = '<div class="alert alert-danger ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Email has NOT been sent due to an error.</strong>
				   </div>';
		break;

// REGISTRATION, PASSWORD, LOGIN //

		case("created_new_user"):
		$return = '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Registration complete.  </strong><br />Check your email for the temporary password, then <a href="view.php">Log In</a>
				   </div>';			
		break;
		
		case("change_password"):
		$return = '<div class="alert alert-danger ">
					<strong>Please change your password and email address</strong>
				   </div>
				   <div class="alert alert-info ">
					As a security measure, you must change the login credentials.<br />
					Once you have changed it, you will be logged out and will need to enter your new credentials.<br />
					You will also receive an email to the email address you type below.<br />
				   </div>
				  ';
		break;
		
		case("login"):
		$return = '<div class="alert alert-danger ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Please log in.</strong> 
				   </div>';			
		break;
		
		case("logout"):
		$return = '<div class="alert alert-success ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>You have successfully logged out.</strong> 
				   </div>';			
		break;
		
		case("timed_out"):
		$return = '<div class="alert alert-danger ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Your session has expired.<br />Please login again</strong> 
				   </div>';			
		break;
		
		case("user_not_found"):
		$return = '<div class="alert alert-danger">
					<strong>SORRY!</strong><br />The credentials you entered are not valid
				   </div>';	
		break;

// PAGE MANAGEMENT //
			  
		case("created"):
		$return = '<div class="alert alert-success ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Entry has been created</strong> 
				   </div>';			
		break;
		
		case("updated"):
		$return = '<div class="alert alert-success ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Entry has been updated</strong> 
				   </div>';			
		break;
		
		case("deleted"):
		$return = '<div class="alert alert-success ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Entry has been deleted</strong> 
				   </div>';			
		break;

		case("not_able_to_delete"):
		$return = '<div class="alert alert-success ">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Not able to delete</strong> 
				   </div>';			
		break;

		case("category_duplicate"):
		$return = '<div class="alert alert-danger ">
					<strong>A Category with that name has already been created<br /><br /></strong>
				   </div>';
		break;

// GENERAL //
			  
		case("error"):		
		$return = '<div class="alert alert-danger ">
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