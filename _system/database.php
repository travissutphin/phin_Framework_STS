<?php
/* _SYSTEM.DATABASE */
/*****************************************************************/

/**
  * @desc	create database connection for MySQL or MSSQL (MSSQL needs to be completed through entire site)
  * MySQL code is complete
  * @param	
  * @return $_SESSION['connection']
*/
	function connection_Database($db_type)
	{				
		if($db_type == "MYSQL")
		{
			
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
			
			if (mysqli_connect_errno($connection))
  			{
  				$_SESSION['error'] = mysqli_connect_error();
  				error_report_Helpers('Error Connecting to MySQL database - _system.database.database_connection',$sql,$result);
  			}
		}
		elseif($db_type == "MSSQL")
		{
			$connectionOptions = array("Database" => DB_DATABASE, 
    								   "UID" => DB_USER,
                    		       	   "PWD" => DB_PASSWORD,
									   "ReturnDatesAsStrings"=>true, // required for datetime to be displayed in php
									   "MultipleActiveResultSets" => true);				   	
			$connection = sqlsrv_connect(DB_SERVER, $connectionOptions);
		} 	  	
		
		$_SESSION['connection'] = $connection; // set database connection
  	}
/*****************************************************************/


/**
  * @desc	creates a list of field names for each table/alias passed to it
  * @param	$table to get fields from / $alias to use for each table
  * @return define() with table name and all fields
*/
	function table_fields_Database( $table,$alias ) {
		
		// NEED TO ADD MSSQL version
		// SELECT *
		// FROM Northwind.INFORMATION_SCHEMA.COLUMNS
		// WHERE TABLE_NAME = N'Customers'

		$build_column = "";
		$sql = "SHOW COLUMNS FROM $table";
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		if ( !$result ) {
			
			echo 'Could not run query: ' . $_SESSION['QUERY_ERROR']();
			exit;
		
		}
		
		if ($_SESSION['NUM_ROWS']($result) > 0) {
			
			while ( $row = $_SESSION['FETCH_ARRAY']( $result ) ) {
				
				foreach( $row as $key => $value ) {
				
					if ( $key == 'FIELD' ) { // "FIELD" value holds the value we need 
						
						$build_column.= $alias.'.'.$value.', '; // concat the alias with the field name
					
					}
				
				}
			
			}
			
			$build_column = rtrim($build_column, ', ');// remove comma from end of string 
			$column_name = "COLUMNS_".strtoupper($table); // this will be the NAME of the define function
			define($column_name,$build_column);	// build the define() function
			$build_column = ""; // clear the columns for the next table
		
		}	
	
	}
/*****************************************************************/


/**
  * @desc	get field data type 
  * @param	$table to get fields from / $field to get properties of the field
  * @return the following values  Field   Type    Null    Key     Default     Extra 
*/
	function table_field_data_types_Database( $table,$field, $return_field ) {
		
		$sql = " SHOW FIELDS FROM $table where Field = '$field' ";
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		if ( !$result ) {
			
			echo 'Could not run query: ' . $_SESSION['QUERY_ERROR']();
			exit;
		
		}
		
		while ( $row = $_SESSION['FETCH_ARRAY']( $result ) ) {
			
			foreach( $row as $key => $value ) {

				if ( $return_field == $key ) { // "FIELD" value holds the value we need 
					
					$return = $value;
				
				}
			
			}
		
		}
		
		return $return;
	
	}
/*****************************************************************/
?>