<?php
/* TEMPLATE.CONTROLLER */
/*****************************************************************/

// if alias not input we will assume this is the home page
	if ( !isset ( $_REQUEST['alias'] ) ) {
	
		$_REQUEST['alias'] = 'Home' ;
	
	}
/* 
 *
 *
 */
	if(isset($_REQUEST['site_id'])){
		
		$_SESSION['site_id'] = $_REQUEST['site_id'];
		
	}else{ // 2 = members
		
		// get site for member based on the url the member is on
		$this_url = $_SERVER['HTTP_HOST'];
		$read_values_Sites = read_values_Sites(FALSE,$this_url);		
		$_SESSION['site_id'] = $read_values_Sites['site_id'];
	}
	
	if(isset($_SESSION['site_id'])){
	
		$display_values_active_site = read_values_Sites($_SESSION['site_id']); 
		$display_categories = read_Categories(FALSE,$_SESSION['site_id']);
		
		$read_values_Sites = read_values_Sites($_SESSION['site_id']);
		$_SESSION['year_start'] = $read_values_Sites['year_start'];
		
		/*
		// set site specific variables
		$this_url = $_SERVER['HTTP_HOST'];
		$read_values_Sites = read_values_Sites($_SESSION['site_id']);
		// we can use the following to get site details
		define("SITE_ID", $read_values_Sites['site_id']);
		define("SITE", $read_values_Sites['display_name']);
		define("SITE_YEAR_START", $read_values_Sites['year_start']);
		define("SITE_DISPLAY_NAME", $read_values_Sites['display_name']);
		*/
		/*****************************************************************/
		
	}
	
	// used on admin_nav to list avail sites
	$display_sites = read_Sites($id=FALSE); 
 
/*****************************************************************/

?>