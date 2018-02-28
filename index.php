<?php
/* root.INDEX */
/*****************************************************************/
	if (!file_exists('_system/config.php'))
	{
		// if the config file does not exist, we need to redirect to the install
		header('Location: install/');
		exit;
	}

	include('_system/config.php');

  // detect if smartphone and redirect
  
  // mobile web app
  	
  // full web app
  if(isset($_REQUEST['message']))
  {
	session_destroy(); 
	header( 'Location: '.site_Url().'login/view.php?message=logout' ); 
	exit;  
  }
  
  echo $_REQUEST['alias'];
  // send user to the login page
  header( 'Location: login/' ) ;
 