ADS Below
<hr />
<?php

$display_ads = read_Ads(FALSE,$_SESSION['site_id'],FALSE);

	while ( $row = $_SESSION['FETCH_ARRAY']( $display_ads ) ) {
	
		echo $row['AD_IMAGE'];
		echo '<br />';
	
	}
?>