<?php
/* CONTENT_TEMPLATES.FUNCTIONS */
/*****************************************************************/



/** 
  * @desc	
  * @param	$id
  * @return 
*/
	function read_values_Content_Templates($id=FALSE,$site_id=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_CONTENT_TEMPLATES.' FROM content_templates ct ';		
		$sql.= " WHERE 0=0 ";
		
		if($id != FALSE){
			$sql.= " AND ct.CONTENT_TEMPLATE_ID = '$id' ";
		}

		if($site_id != FALSE){
			$sql.= " AND ct.SITE_FK = '$site_id' ";
		}	

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - read_values_Content_Templates)',$sql,$result); }
		
		// loop over row and create vars
		// create array of values from this record
		$array = array();
		$data = $_SESSION['FETCH_ARRAY']($result);
		
		if($data != NULL) {
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
  * @desc	html_list_Content_Templates
  * @param	
  * @return 
*/
	function html_list_Content_Templates($id=FALSE,$site_fk=FALSE,$select_name_value=FALSE,$values=FALSE)
	{	  		
		$sql = " SELECT ".COLUMNS_CONTENT_TEMPLATES." FROM content_templates ct ";
		$sql.= " WHERE 0=0 ";
		
		if($site_fk != ""){
			$sql.= " AND ct.SITE_FK = '$site_fk' ";	
		}
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - html_list_Content_Templates()',$sql,$result); }
		
		  echo '<select name="'.$select_name_value.'" '.$values.'>';
		  echo '<option value="">Select a template</option>';
		  while($data = $_SESSION['FETCH_ARRAY']($result))
		  {
			if($data['CONTENT_TEMPLATE_ID'] == $id){ $selected="selected"; }else{ $selected=""; }
			echo '<option value="'.$data['CONTENT_TEMPLATE_ID'].'" '.$selected.'>'.$data['CT_TEMPLATE_NAME'].'</option>';  
		  }
		  echo '</select>';		  
	}
/*****************************************************************/


?>