<?php
/* CATEGORIES.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none
*/
	function create_Categories()
	{	  
	
		// categories are manually created
		
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Categories($id=FALSE,$site_fk=FALSE,$name=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_CATEGORIES.' FROM CATEGORIES cat ';
		$sql.= ' WHERE 0=0 ';
		
		// by id
		if($id !== FALSE)
		{	$sql.= " AND cat.CATEGORY_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND cat.SITE_FK = '$site_fk' "; }

		// by name
		if($name !== FALSE)
		{	$sql.= " AND cat.NAME = '$name' "; }

		$sql.= ' ORDER BY cat.SEQ, cat.NAME ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

		if($result === false) 
		{ error_report_Helpers('Error Reading Categories - (read_Categories)',$sql); }

		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values
  *	@ex.	$values_users = read_values_Categories($id='1');
  *			echo $values_users['id']; // id would be lowercase
*/
	function read_values_Categories($id=FALSE,$site_fk=FALSE,$name=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_CATEGORIES.' FROM CATEGORIES cat ';
		$sql.= ' WHERE 0=0 ';
		
		// by id
		if($id !== FALSE)
		{	$sql.= " AND cat.CATEGORY_ID = '$id' "; }

		// by site_fk
		if($site_fk !== FALSE)
		{	$sql.= " AND cat.SITE_FK = '$site_fk' "; }

		// by name
		if($name !== FALSE)
		{	$sql.= " AND cat.NAME = '$name' "; }
		
		$sql.= ' ORDER BY cat.SEQ, cat.NAME ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error Reading Categories Values - (read_values_Categories)',$sql); }
		
		// create array of values from this record
		$array = array();
		
		if ( $_SESSION['NUM_ROWS']( $result ) == '1' ) {
		
			$data = $_SESSION['FETCH_ARRAY']($result);

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
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_Categories()
	{	  	
	
		// categories are manually updated
	
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Categories( $id=FALSE )
	{

		// categories are manually deleted
		
	}
/*****************************************************************/

/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Categories($id=FALSE,$site_fk=FALSE,$field_name=FALSE,$class='form-control')
	{
		$result = read_Categories(FALSE,$site_fk);

		echo '<select name="'.$field_name.'" class="'.$class.'">';
		while($data = $_SESSION['FETCH_ARRAY']($result))
		{
			if($data['CATEGORY_ID'] == $id){ $selected="selected"; }else{ $selected=""; }
			echo '<option value="'.$data['CATEGORY_ID'].'" '.$selected.'>'.$data['NAME'].'</option>';  
		}
		echo '</select>';
	 
	}
/*****************************************************************/
	
?>