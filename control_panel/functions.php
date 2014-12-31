<?php
/* CONTROL_PANEL.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none - redirect will occure accordingly
*/
	function create_Control_Panel()
	{	  
	  $sql = "INSERT INTO table
			  (column) 
			  VALUES ('value') " ;
	  
	  $result = sqlsrv_query($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { 
	  	error_report_Helpers('Error Message to User HERE - file location and function name HERE');
	  }
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Control_Panel($id=FALSE)
	{
	  $sql = 'SELECT column FROM table WHERE 0=0 ';	
	  if($id !== FALSE)
	  {
		$sql.= ' AND id = "'.$id.'" ';	  
	  }  
	  
	  $sql.= ' ORDER BY fields ';
	  
	  $result = sqlsrv_query($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { 
	  	error_report_Helpers('Error Message to User HERE - file location and function name HERE');
	  }
	  
	  return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values of a record stored in an array
  * @to use	
  *		$array_data = read_values_($id);
  *		echo $array_data['id'];
*/
	function read_values_Control_Panel($id=FALSE)
	{
	  $sql = 'SELECT column FROM table ';	
	  if($id !== FALSE)
	  {
		$sql.= ' WHERE id = "'.$id.'" ';	  
	  }  
	  
	  $result = sqlsrv_query($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { 
	  	error_report_Helpers('Error Message to User HERE - file location and function name HERE');
	  }
	  
	  while($data = mysql_fetch_array($result))
	  {
		  $id = $data['id'];
	  }
	  return array('id' => $id);
	}
/*****************************************************************/

/** 
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_Control_Panel()
	{
	  $sql = "UPDATE table
			  SET 
			  column = '".$_POST['value']."' ,
			  column = '".$_POST['value']."'
			  WHERE id = '".$_POST['id']."'
			 ";
			 
	  $result = sqlsrv_query($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { 
	  	error_report_Helpers('Error Message to User HERE - file location and function name HERE');
	  }
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Control_Panel($id="")
	{
	  if($id != "")
	  {
		$sql = 'DELETE FROM table
				WHERE id = "'.$id.'" ';
					  
		$result = sqlsrv_query($_SESSION['connection'],$sql);

		// error reporting 
		if($result === false) 
		{ 
		  error_report_Helpers('Error Message to User HERE - file location and function name HERE');
		}
	  }
	}
/*****************************************************************/

/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Control_Panel($id=FALSE,$values=FALSE)
	{
	  $sql = " SELECT * FROM table ";	
	  $sql.= ' ORDER BY column';
	  
	  $result = sqlsrv_query($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  { 
	  	error_report_Helpers('Error Message to User HERE - file location and function name HERE');
	  }
	  
	  echo '<select name="id" "'.$values.'">';
	  while($row = mysql_fetch_array($result))
	  {
		if($row['id'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['value'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/

?>