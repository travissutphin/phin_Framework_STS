<?php
/* LOGIN.CONTROLLER */
/*****************************************************************/

/** 
  * @desc	start login process 
  * @param	$_POST vars
  * @return non - redirect occurs within the function
*/
	if(isset($_POST['submit']))
	{
		validate_Login(); 
	}
/*****************************************************************/


/** 
  * @desc	logout
  * @param	$_POST vars
  * @return non
*/
	if(isset($_REQUEST['logout']))
	{
		clear_variables_Login(); 
	}
/*****************************************************************/


/** 
  * @desc	start registration process
  * @param	$_POST vars
  * @return non - redirect occurs within the function
*/
	if(isset($_POST['create']))
	{
		$_SESSION['message'] = create_Users(); 	  
	}
/*****************************************************************/


/* forgot password
 *
 *
 */
	if(isset($_POST['recover_password']))
	{
		retrieve_password_Email($_POST['EMAIL']);
	}
/*****************************************************************/

?>