<?php
/* _SYSTEM.HTML_SELECT_LISTS */
/*****************************************************************/

/**
  * @desc	html select list AM / PM 
  * @param	
  * @return none
*/
	function html_list_AM_PM_HTML_Select_Lists($field_namename='AMPM',$value='AM',$class='form-control')
	{
		if($value == 'AM'){ $selected_am="selected"; }else{ $selected_am=""; }
		if($value == 'PM'){ $selected_pm="selected"; }else{ $selected_pm=""; }
		
		echo "<select name='$field_name' class='$class'>";
		echo '<option value="AM" '.$selected_am.'>AM</option>'; 
		echo '<option value="PM" '.$selected_pm.'>PM</option>';  
		echo '</select>';		
	}
/*****************************************************************/


/**
  * @desc	html select list Yes No 
  * @param	
  * @return none
*/
	function html_list_Yes_No_HTML_Select_Lists($field_name='',$value='',$class='form-control')
	{
		if($value == '1'){ $selected_yes="selected"; }else{ $selected_yes=""; }
		if($value == '0'){ $selected_no="selected"; }else{ $selected_no=""; }
		
		echo "<select name='$field_name' class='$class'>";
		echo '<option value="">Select Yes or No</option>'; 
		echo '<option value="1" '.$selected_yes.'>Yes</option>'; 
		echo '<option value="0" '.$selected_no.'>No</option>';  
		echo '</select>';		
	}
/*****************************************************************/

/**
  * @desc	html select list Loop over Years
  * @param	
  * @return none
*/
	function html_list_Years_to_Present_HTML_Select_Lists($field_name='',$value=FALSE,$class='form-control')
	{
		$year_loop = SITE_YEAR_START; // SITE_YEAR_START from _system/config.php
		$year_current = date('Y');
		
		echo "<select name='$field_name' class='$class'>";
		echo '<option value="">Select Year</option>'; 
		while($year_loop <= $year_current){
			if($value == $year_current){ $selected_yes="selected"; }else{ $selected_yes=""; }
			echo '<option value=" '.$year_current.' " '.$selected_yes.'>'.$year_current.'</option>'; 
			$year_current--;
		}
		echo '</select>';		
	}
/*****************************************************************/

/**
  * @desc	html select list Status 
  * @param	
  * @return none
*/
	function html_list_Status_HTML_Select_Lists($field_name='',$value=FALSE,$class='form-control')
	{
		if($value == 'active'){ $selected_active="selected"; }else{ $selected_active=""; }
		if($value == 'inactive'){ $selected_inactive="selected"; }else{ $selected_inactive=""; }
		
		echo "<select name='$field_name' class='$class'>";
		echo '<option value="">Status</option>'; 
		echo '<option value="active" '.$selected_active.'>Active</option>'; 
		echo '<option value="inactive" '.$selected_inactive.'>Inactive</option>';  
		echo '</select>';		
	}
/*****************************************************************/

?>