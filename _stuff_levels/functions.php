<?php
/* STUFF_MEMBERSHIP_LEVELS.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Stuff_Membership_Levels()
	{	  
	
		// models are manually created
		
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Stuff_Membership_Levels($id=FALSE,$site_fk=FALSE)
	{
	  $sql = ' SELECT '.COLUMNS_STUFF_MEMBERSHIP_LEVELS.' FROM STUFF_MEMBERSHIP_LEVELS sml ';

	  // by id
	  if($id !== FALSE)
	  {	$sql.= " AND sml.STUFF_MEMBERSHIP_LEVEL = '$id' "; }

	  // by site_fk
	  if($site_fk !== FALSE)
	  {	$sql.= " AND sml.SITE_FK = '$site_fk' "; }
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  if($result === false) 
	  { error_report_Helpers('Error Reading Stuff_Membership_Levels - (read_Stuff_Membership_Levels)',$sql); }
	  
	  return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_smlels = read_values_Stuff_Membership_Levels($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_Stuff_Membership_Levels($id=FALSE,$site_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_STUFF_MEMBERSHIP_LEVELS.' FROM STUFF_MEMBERSHIP_LEVELS sml ';

	  // by id
	  if($id !== FALSE)
	  {	$sql.= " AND sml.STUFF_MEMBERSHIP_LEVEL = '$id' "; }

	  // by site_fk
	  if($site_fk !== FALSE)
	  {	$sql.= " AND sml.SITE_FK = '$site_fk' "; }
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Stuff_Membership_Levels Values - (read_values_Stuff_Membership_Levels)',$sql); }
		
		// create array of values from this record
		$array = array();
		$data = $_SESSION['FETCH_ARRAY']($result);

		foreach($data as $key => $value) // creates assocative array
		{
			if(!is_numeric($key))
			{ $array = array_merge($array, array(strtolower($key) => $value)); }
		}  
		
		return $array;
	}
/*****************************************************************/

/** 	
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_Stuff_Membership_Levels()
	{	  	
	
		// categories are manually updated
	
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Stuff_Membership_Levels( $id=FALSE )
	{

		// categories are manually deleted
		
	}
/*****************************************************************/

/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Stuff_Membership_Levels($id=FALSE,$site_fk=FALSE,$values=FALSE)
	{
		$result = read_Stuff_Membership_Levels($id=FALSE,$site_fk=FALSE);

		echo '<select name="STUFF_MEMBERSHIP_LEVEL" "'.$values.'">';
		while($data = $_SESSION['FETCH_ARRAY']($result))
		{
			if($data['CATEGORY_ID'] == $id){ $selected="selected"; }else{ $selected=""; }
			echo '<option value="'.$data['STUFF_MEMBERSHIP_LEVEL_ID'].'" '.$selected.'>'.$data['LEVEL'].'</option>';  
		}
		echo '</select>';
	 
	}
/*****************************************************************/
	
?>