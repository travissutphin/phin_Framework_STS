<?php
/* MODELS.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Models()
	{	  
	
		// categories are manually created
		
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Models($id=FALSE,$site_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_MODELS.' FROM MODELS model ';
		$sql.= ' WHERE 0=0 ';
	
		// by id
		if($id !== FALSE)
		{	$sql.= " AND model.MODEL_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND model.SITE_FK = '$site_fk' "; }

		$sql.= ' ORDER BY model.SEQ DESC';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		if($result === false) 
		{ error_report_Helpers('Error Reading Models - (read_Models)',$sql); }

		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_models = read_values_Models($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_Models($id=FALSE,$site_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_MODELS.' FROM MODELS mod ';
		$sql.= ' WHERE 0=0 ';
		
		// by id
		if($id !== FALSE)
		{	$sql.= " AND mod.MODEL_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND mod.SITE_FK = '$site_fk' "; }

		$sql.= ' ORDER BY mod.ORDER ';

		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Models Values - (read_values_Models)',$sql); }

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
	function update_Models()
	{	  	
	
		// categories are manually updated
	
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Models( $id=FALSE )
	{

		// categories are manually deleted
		
	}
/*****************************************************************/

/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Models($id=FALSE,$site_fk=FALSE,$field_name=FALSE,$class=FALSE)
	{
		$result = read_Models($id=FALSE,$site_fk=FALSE);
		
		echo '<select name="'.$field_name.'" class="'.$class.'">';
		while($data = $_SESSION['FETCH_ARRAY']($result))
		{
			if($data['MODEL_ID'] == $id){ $selected="selected"; }else{ $selected=""; }
			echo '<option value="'.$data['MODEL_ID'].'" '.$selected.'>'.$data['MODEL'].'</option>';  
		}
		echo '</select>';
	}
/*****************************************************************/
	
?>