<?php
/* TEMPLATE.CONTROLLER */
/*****************************************************************/

/*
*	@desc : 	IF NO ALIAS PASSED THEN WE MUST BE ON THE HOME PAGE
*	
*/	
	if ( !isset ( $_REQUEST['alias'] ) ) {
	
		$_REQUEST['alias'] = 'Home' ;
	
	}

/*****************************************************************/

/*
*	@desc : 	DETERMINE THE SITE TO LOAD BASED ON
*					1) ADMIN CLICKED ON DASHBOAD
*					2) CURRENT URL
*	
*/	
	if ( isset ( $_REQUEST['site_id'] ) ) {
		
		$_SESSION['site_id'] = $_REQUEST['site_id'];
		
	}elseif ( !isset ( $_SESSION['members.role_id'] ) or $_SESSION['members.role_id'] == 2 ) { // 2 = members so get site base don url
		
		// get site for member based on the url the member is on
		$this_url = $_SERVER['HTTP_HOST'];
		$read_values_Sites = read_values_Sites(FALSE,$this_url);		
		$_SESSION['site_id'] = $read_values_Sites['site_id'];
	}
	
	if ( isset ( $_SESSION['site_id'] ) ) {
	
		$display_values_active_site = read_values_Sites($_SESSION['site_id'] ) ; 
		$display_categories = read_Categories(FALSE,$_SESSION['site_id'] ) ;
		
		$read_values_Sites = read_values_Sites($_SESSION['site_id'] ) ;
		$_SESSION['year_start'] = $read_values_Sites['year_start'] ;	
	}

/*****************************************************************/

/*
*	@desc : 	THROW 404 IF ALIAS DOES NOT EXIST
*					IN CONTENT, STUFF, CATEGORIES
*	
*/	
	// DOES ALIAS EXIST IN CONTENT
	$exists_content = read_Content( $id=FALSE,$alias=$_REQUEST['alias'],$site_id=$_SESSION['site_id'],$con_parent_id=FALSE,$num_rows=FALSE,$sub_nav=FALSE,$access_to=FALSE ) ;
	
	// DOES ALIAS EXIST IN STUFF
	$exists_stuff = read_Stuff( $id=FALSE,$site_fk=$_SESSION['site_id'],$member_fk=FALSE,$category_fk=FALSE,$year_start_dk=FALSE,$year_end_dk=FALSE,$status_dk=FALSE,$alias=$_REQUEST['alias'] ) ;
	
	// DOES ALIAS EXIST IN CATEGORIES
	$exists_categories = read_Categories( $id=FALSE,$site_fk=$_SESSION['site_id'],$name=$_REQUEST['alias'] ) ;
	
	// IF NONE OF THE ABOVE ARE TRUE, WILL WILL REDIRECT TO THE 404 PAGE
	if ( $_SESSION['NUM_ROWS']( $exists_content ) == 0 and $_SESSION['NUM_ROWS']( $exists_stuff ) == 0 and $_SESSION['NUM_ROWS']( $exists_categories ) == 0 ) {
	
		header( 'Location: '.site_Url().'404.php' ) ;
		exit;
	}
	
/*****************************************************************/ 

/*
*	@desc	: 	GET ALL CATEGORIES
*	@ref		:	Q102
*	@file		:	index.php
*	
*/	 
	$display_categories = read_Categories( $id=FALSE,$site_fk=$_SESSION['site_id'],$name=FALSE ) ; 
 
/*****************************************************************/


///////////////////////////////////////////////////////////////////////////////////
// CLASSIFIEDS
///////////////////////////////////////////////////////////////////////////////////

/*
*	@desc :	IS THE REQUEST ALIAS PASSED PART OF THE STUFF TABLE
*					IF SO, WE WILL SHOW THE STUFF DETAILS
*	@ref : 		Q103
*	@file : 		index.php
*					
*/	
	$alias_stuff = read_Stuff($id=FALSE,$_SESSION['site_id'],$member_fk=FALSE,$category_fk=FALSE,$year_start_dk=FALSE,$year_end_dk=FALSE,$status_dk=FALSE,$_REQUEST['alias'] ) ;

/*****************************************************************/
	
/*
*	@desc :	IS THE CURRENT ALIAS IS A SPECIFIC STUFF RECORD
*					IF IT IS, WE WILL DISPLAY THAT STUFF RECORDS DETAILS ON THE template-classified.php FILE
*	@file :		template-classifieds.php
*/
	$display_stuff_details = read_Stuff($id=FALSE,$_SESSION['site_id'],$member_fk=FALSE,$category_fk=FALSE,$year_start_dk=FALSE,$year_end_dk=FALSE,$status_dk=FALSE,$_REQUEST['alias'] ) ;

/*****************************************************************/

/*
*	@desc :	IS THE REQUEST ALIAS PASSED PART OF THE CATEGORY TABLE
*					IF SO, WE NEED TO STUFF BASED ON CATEGORIES
*					THIS IS USED TO VERIFY AND NOT TO OUTPUT
*	@ref 	:	Q104-1
*	@file 	:		index.php
*/	
	$category_stuff = read_Values_Categories( $id=FALSE,$site_fk=FALSE,$_REQUEST['alias'] ) ;

/*****************************************************************/

/*
*	@desc :	IF CATEGORY_ID IS NOT RETURNED, SET IT TO FALSE
*					THIS WILL MEAN WE ARE NOT LOOKING TO DISPLAY STUFF CATEGORIES
*					- THIS WILL POPULATE THE $display_stuff_all VAR BELOW
*	@ref 	:	Q104-2
*	@file  	:	index.php
*/	
	if ( !isset ( $category_stuff['category_id'] ) ) {
	
		$category_stuff['category_id'] = FALSE;
	
	}
/*****************************************************************/

/*
*	@desc :	USED IF SEARCHING THE CLASSIFIEDS.  
*					SET IT TO FALSE HERE IF WE ARE NOT SEARCHING THE CLASSIFIEDS
*	
*	@file  	:	template-classifieds.php
*/	
	if ( isset ( $_REQUEST['alias'] ) ) {
	
		$_SESSION['search_alias'] = $_REQUEST['alias'] ;
	
	}

	if ( !isset ( $_REQUEST['search'] ) ) {
	
		$_REQUEST['search'] = FALSE ;
	
	}
/*****************************************************************/

/*
*	@desc :	1) IF category_id IS FALSE, READ ALL STUFF RECORDS IN THE DATABASE TO DISPLAY
*					2) IF category_id IS NOT FALSE, READ ALL STUFF RECORDS IN THE category_id PASSED
*	
*	@file		:		template-classifieds.php
*/	

	$display_stuff_all = read_Stuff($id=FALSE,$_SESSION['site_id'],$member_fk=FALSE,$category_fk=$category_stuff['category_id'],$year_start_dk=FALSE,$year_end_dk=FALSE,$status_dk=FALSE,$alias=FALSE, $search=$_REQUEST['search']  ) ;
 
 /*****************************************************************/

///////////////////////////////////////////////////////////////////////////////////
// REGULAR PAGE CONTENT
///////////////////////////////////////////////////////////////////////////////////

 /*
*	@desc :	IF ALIAS IS NOT STUFF, CATEGORY NOR CONTENT
*					THIS WILL MEAN WE ARE NOT LOOKING TO DISPLAY STUFF CATEGORIES
*					- THIS WILL POPULATE THE $display_stuff_all VAR BELOW
*	@ref		:	Q105
*	@file		:	index.php
*/	
	if ( $_SESSION['NUM_ROWS']($alias_stuff) == 0 and isset ( $category_stuff['category_id'] ) and $category_stuff['category_id'] == 0 ) {

		$values_content = read_values_Content ( FALSE,$_REQUEST['alias'],FALSE ) ; // $id, $alias, $content_parent_id
		$values_layouts = read_values_Content_Layouts ( $values_content['con_layout_fk'],$_SESSION['site_id'] ) ; // $id, $site_id
		$values_templates = read_values_Content_Templates( $values_content['content_template_fk_before'],$_SESSION['site_id'] ) ; //$id, site_id
		
 }
 /*****************************************************************/

///////////////////////////////////////////////////////////////////////////////////
// EVENTS
///////////////////////////////////////////////////////////////////////////////////

/*
*	@desc :	DISPLAY EVENTS
*	
*	@file		:	template-local-events.php
*/	

	$display_events = read_Events( $id=FALSE,$site_fk=$_SESSION['site_id'],$address=FALSE,$city=FALSE,$state=FALSE,$zip=FALSE,$search=$_REQUEST['search'] ) ; 

 /*****************************************************************/

///////////////////////////////////////////////////////////////////////////////////
// CLUBS
///////////////////////////////////////////////////////////////////////////////////

/*
*	@desc :	DISPLAY CLUBS
*	
*	@file		:	template-local-clubs.php
*/	

	$display_clubs = read_Clubs( $id=FALSE,$site_fk=$_SESSION['site_id'],$address=FALSE,$city=FALSE,$state=FALSE,$zip=FALSE,$search=$_REQUEST['search'] ) ; 
	
 /*****************************************************************/
 
///////////////////////////////////////////////////////////////////////////////////
// TRAILS
///////////////////////////////////////////////////////////////////////////////////

/*
*	@desc :	DISPLAY TRAILS
*	
*	@file		:	template-local-trails.php
*/	

	$display_trails = read_Trails( $id=FALSE,$site_fk=$_SESSION['site_id'],$address=FALSE,$city=FALSE,$state=FALSE,$zip=FALSE,$search=$_REQUEST['search'] ) ; 
	
 /*****************************************************************/

 ?>