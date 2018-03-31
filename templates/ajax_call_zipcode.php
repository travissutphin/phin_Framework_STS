<?php 
	
	include('../_system/config.php');
	$query = read_Gelocator($geolocator_id=FALSE,$state=FALSE,$city=FALSE,$zipcode=FALSE,$longitude=FALSE,$latitude=FALSE,$order_by=FALSE) ; 

	while ($row = $_SESSION['FETCH_ARRAY']($query)) {
        $data[] = $row['GE_ZIPCODE'];
    }
    
    //return json data
    echo json_encode($data);

?>