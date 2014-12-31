<?php
/* _SYSTEM.HTML_SELECT_LISTS */
/*****************************************************************/

/**
  * @desc	html select list AM / PM 
  * @param	
  * @return none
*/
	function html_list_AM_PM_HTML_Select_Lists($name='AMPM',$value='AM',$class='span3')
	{
		if($value == 'AM'){ $selected_am="selected"; }else{ $selected_am=""; }
		if($value == 'PM'){ $selected_pm="selected"; }else{ $selected_pm=""; }
		
		echo "<select name='$name' class='$class'>";
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
	function html_list_Yes_No_HTML_Select_Lists($name='',$value='',$class='span5')
	{
		if($value == '1'){ $selected_yes="selected"; }else{ $selected_yes=""; }
		if($value == '0'){ $selected_no="selected"; }else{ $selected_no=""; }
		
		echo "<select name='$name' class='$class'>";
		echo '<option value="">Select Yes or No</option>'; 
		echo '<option value="1" '.$selected_yes.'>Yes</option>'; 
		echo '<option value="0" '.$selected_no.'>No</option>';  
		echo '</select>';		
	}
/*****************************************************************/

?>