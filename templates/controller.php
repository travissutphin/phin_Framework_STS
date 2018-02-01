<?php
/* TEMPLATE.CONTROLLER */
/*****************************************************************/

/* 
 *
 *
 */
	if(isset($_REQUEST['site_id'])){
		
		$_SESSION['site_id'] = $_REQUEST['site_id'];
		
	}
	
	if(isset($_SESSION['site_id'])){
	
		$display_values_active_site = read_values_Sites($_SESSION['site_id']); 
		$display_categories = read_Categories(FALSE,$_SESSION['site_id']);
		
	}
	
	// used on admin_nav to list avail sites
	$display_sites = read_Sites($id=FALSE); 
 
/*****************************************************************/

?>