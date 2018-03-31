<?php
/* _SYSTEM.DATE_TIMES */
/*****************************************************************/

/**
  * @desc	convert military time to standard time
  * @param	$time
  * @return $result
*/
	function military_to_standard_Dates_Times($time)
	{
		$result = date('h:i:s A', strtotime($time));
		$result = str_replace(':00 ', '',$result);
		return $result;
	}
/*****************************************************************/

/**
  * @desc	convert standard time to military
  * @param	$time
  * @return $result
*/
	function standard_to_military_Dates_Times($time)
	{
		$result = date('H:i:s A', strtotime($time));
		$result = substr($result, 0, 5);
		return $result;  
	}
/*****************************************************************/

/**
  * @desc	format date depending on $format requested
  * @param	$date, $format(this will tell function which format
  *			to use.  This should grow as requirements are needed
  * @return $result
*/
	function format_Dates_Times($date,$format)
	{
		if($format == "full") // returns ex. January 1, 2025
		{
		  $result = date('F d, Y', strtotime($date));
		}
		elseif($format == "month") // returns ex. February
		{
		  $result = date('F', strtotime($date));
		}
		elseif($format == "database_table") // returns ex. 2025-01-31 22:01:03
		{
		  $result = date('Y-m-d H:i:s', strtotime($date));
		}
		elseif($format == "date_only") // returns ex. 2025-01-31 22:01:03
		{
		  $result = date('Y-m-d', strtotime($date));
		}		
		return $result;
	}
/*****************************************************************/

/**
  * @desc	calculate the current week dates from Sunday to Saturday
  * @param	$full_date(todays date, function calculates week based on
  *			today)
  * @return $this_week as an array
*/
	function sun_to_sat_Dates_Times($full_date)
	{
		$time = strtotime($full_date);
		$start = strtotime('last sunday, 12pm', $time);
		$end = strtotime('next saturday, 11:59am', $time);
		$format = 'Y-m-d';
		$start_day = date($format, $start);
		$end_day = date($format, $end);

		$this_week = array("start"=>$start_day,"end"=>$end_day);	
		return $this_week;
	}
/*****************************************************************/

/**
  * @desc	list years starting with this year + "plus_year" (ex. '+2') 
  * @param	$year
  * @return none
*/
	function html_list_years_Helper($year=FALSE,$select_name=FALSE,$values=FALSE,$plus_year=FALSE) 
	{ 
		if($plus_year === FALSE){ $plus_year = '+2'; }
		$year = date('Y');
		$end_year = strtotime ( $plus_year.' year' , strtotime ( $year ) ) ;
		$end_year = date ( 'Y' , $end_year );
	
		echo '<select name="'.$select_name.'" "'.$values.'">';
		for ($x=date('Y'); $x<=$end_year ; $x++)
		{
		  if($year == $x){ $selected = "selected"; }else{ $selected = "";}
		  echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';  
		}
		echo '</select>';	 
	}
/*****************************************************************/
?>