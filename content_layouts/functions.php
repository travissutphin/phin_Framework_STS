<?php
/* CONTENT_LAYOUTS.FUNCTIONS */
/*****************************************************************/
/** 
  * @desc	read specific value
  * @param	$id
  * @return specific name
*/
	function read_values_Content_Layouts($id=FALSE,$site_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_CONTENT_LAYOUTS.' FROM content_layouts cl ';
		
		$sql.= " WHERE 0=0 ";
		
		// by id
		if($id !== FALSE)
		{ $sql.= " AND cl.CONTENT_LAYOUT_ID = '$id' "; }
		
		// by alias
		if($site_fk !== FALSE)
		{ $sql.= " AND cl.SITE_FK = '$site_fk' "; }
   	  
  	  	$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
  	  
	  	// error reporting 
	  	if($result === false) 
	  	{ echo $sql; exit;error_report_Helpers('Error - (read_values_Content_Layouts)',$sql,$result); }
	  
	  	$array = array();
		
	  	$data = $_SESSION['FETCH_ARRAY']($result);
	  
	  	if($_SESSION['NUM_ROWS']($result) > 0)
	  	{ 
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
  * @desc	create an html select list navigation
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Content_Layout($content_layout_id=FALSE,$site_fk=FALSE)
	{
	  $sql = ' SELECT '.COLUMNS_CONTENT_LAYOUTS.' FROM content_layouts cl ';
	  $sql.= " WHERE 0=0 ";	

	  if($site_fk != FALSE)
	  { $sql.= " AND cl.SITE_FK = '$site_fk' ";}
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { error_report_Helpers('Error - (html_list_Content_Layout)',$sql,$result); }
	  
	  echo '<select name="CON_LAYOUT_FK" "'.$values.'" class="form-control">';
	  while($data = $_SESSION['FETCH_ARRAY']($result))
	  {
		if($data['CONTENT_LAYOUT_ID'] == $content_layout_id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$data['CONTENT_LAYOUT_ID'].'" '.$selected.'>'.$data['CL_DISPLAY_NAME'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/


?>