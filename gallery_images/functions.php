<?php
/* GALLERIES.FUNCTIONS */
/*****************************************************************/
/** 
  * @desc	create record
  * @param	all posted vars
  * @return none - redirect will occur accordingly
*/
	function create_Gallery_Images()
	{
		$_POST['CREATED_AT'] = date("Y-m-d H:i:s");
		$data_columns = "";
		$data_values = "";
		foreach ($_POST as $key => $value) 
		{
			// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
			if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === FALSE) // $_SESSION['ignore'] = _system/config.php
			{	
				$data_columns.= $key.",";
				$data_values.= "'$value',";
			}
		}
		$data_columns = rtrim($data_columns, ','); // remove comma from end of string
		$data_values = rtrim($data_values, ','); // remove comma from end of string
		$sql = "INSERT INTO GALLERY_IMAGES
			  ($data_columns) 
			  VALUES ($data_values) " ;			  
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		// error reporting
		if($result === false) 
		{ echo $sql; exit; error_report_Helpers('Error - create_Gallery_Images)',$sql,$result); }
		$gallery_id = last_inserted_id_Helpers($result);
		//** Do not add trailing / to $move_to
		if($_FILES['IMAGE']["name"] != ''){
			$image = file_Upload('IMAGE','../../upload_repository',FALSE); // $name, $move_to, $max_size
		}else{
			$image = "";	
		}		
		$src_filename = '../../upload_repository/'.$image;
		$dst_filename = '../../upload_repository/'.$image;
		$dst_width = '600';
		$dst_height = '400';
		$fill = 'squeeze';
		resize_Images($src_filename, $dst_filename, $dst_width, $dst_height, $fill, $quality=100, $png_filters=PNG_NO_FILTER);
		$sql = " UPDATE GALLERY_IMAGES ";
		$sql.= " SET ";
		$sql.= " IMAGE = '$image' ";
		$sql.= " WHERE GALLERY_IMAGES_ID = '$gallery_id' ";		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - create_Gallery_Images : uploading files)',$sql,$result); }
		$message = 'created';		
		return $message;		  
	}
/*****************************************************************/
/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Gallery_Images($id=FALSE,$site_fk=FALSE,$gallery_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_GALLERIES.' FROM GALLERY_IMAGES gi ';		
		$sql.= " WHERE 0=0 ";	
		if($id != FALSE){
			$sql.= " AND gi.GALLERY_IMAGE_ID = '$id' ";
		}
		if($site_fk != FALSE){
			$sql.= " AND gi.SITE_FK = '$site_fk' ";
		}
		if($gallery_fk != FALSE){
			$sql.= " AND gi.GALLERY_FK = '$gallery_fk' ";
		}
		
		$sql.= " AND gi.DELETED_AT IS NULL ";	
		$sql.= " ORDER BY gi.ORDER ";	
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - read_Gallery_Images)',$sql,$result); }
		return $result;
	}
/*****************************************************************/
/** 
  * @desc	read table, create array of values
  * @param	$id
  * @return specific values of a record stored in an array
  * @to use	
  *			$array_data = read_values_($id);
  *			echo $array_data['id'];
*/
	function read_values_Gallery_Images($id=FALSE,$site_fk=FALSE,$gallery_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_GALLERIES.' FROM GALLERY_IMAGES gi ';		
		$sql.= " WHERE 0=0 ";
	
		if($id != FALSE){
			$sql.= " AND gi.GALLERY_IMAGE_ID = '$id' ";
		}

		if($site_fk != FALSE){
			$sql.= " AND gi.SITE_FK = '$site_fk' ";
		}

		if($gallery_fk != FALSE){
			$sql.= " AND gi.GALLERY_FK = '$gallery_fk' ";
		}
		
		$sql.= " AND gi.DELETED_AT IS NULL ";	
		$sql.= " ORDER BY gi.ORDER ";	

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - read_values_Gallery_Images',$sql,$result); }
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
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_Gallery_Images()
	{
		$_POST['UPDATED_AT'] = date("Y-m-d H:i:s");		
		$data_update = "";		
		foreach ($_POST as $key => $value) 
		{
			// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
			if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === false) // $_SESSION['ignore'] = _system/config.php
			{
				$value = cleanInput_Security($value);
				$data_update.= $key." = '".$value."',";	
			}
		}
		$data_update = rtrim($data_update, ','); // remove comma from end of string
		$sql = "UPDATE GALLERY_IMAGES
				SET ".$data_update."
				WHERE GALLERY_IMAGE_ID = '$_POST[GALLERY_IMAGE_ID]'
			   ";			   
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - update_Gallery_Images)',$sql); }
		//** Do not add trailing / to $move_to
		if($_FILES['IMAGE']["name"] != ''){
			$image = file_Upload('IMAGE','../../upload_repository',FALSE); // $name, $move_to, $max_size	
			$src_filename = '../../upload_repository/'.$image;
			$dst_filename = '../../upload_repository/'.$image;
			$dst_width = '600';
			$dst_height = '400';
			$fill = 'squeeze';
			resize_Images($src_filename, $dst_filename, $dst_width, $dst_height, $fill, $quality=100, $png_filters=PNG_NO_FILTER);
			$sql = " UPDATE GALLERY_IMAGE ";
			$sql.= " SET ";
			$sql.= " IMAGE = '$image' ";
			$sql.= " WHERE GALLERY_IMAGE_ID = '$_POST[GALLERY_IMAGE_ID]' ";
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error - create_Gallery_Images : uploading files)',$sql,$result); }
		}
		// clear values as session vars
		clear_postVars_to_sessionVars_Helpers();		
		$message = "updated"; // _system/message_center.php
		return $message;		
	}
/*****************************************************************/
/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Gallery_Images($id=FALSE)
	{
		$message = 'not_able_to_delete';	  		if($id !== FALSE)
		{
			$sql = 	"DELETE FROM GALLERY_IMAGES						WHERE GALLERY_IMAGE_ID = '$id'						";
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Message - delete_Gallery_Images',$sql,$result); }			
			// delete the old image
			// NEED TO WRITE CODE TO DELETE OLD IMAGE
			
			$message = "deleted"; // _system/message_center.php
			return $message;
		}
	}
/*****************************************************************/
/** 
  * @desc	create an html select list
  * @param	
  * @return 
  * 
*/
	function display_Gallery_Images()
	{
		// need to create this based on details decided on how they will be displayed.	
	}
/*****************************************************************/
?>