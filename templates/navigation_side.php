<?php if ( $_SESSION['NUM_ROWS']( $display_stuff_details ) == 0 ) { // DO NOT DISPLAY FOR STUFF DETAILS ?>

Search <?php echo str_replace(["-", "–"], ' ', $_REQUEST['alias'] ) ; // REMOVE DASHES FROM THE ALIAS TO DISPLAY ?> 
<form name="search" action="<?php echo $_REQUEST['alias'] ; ?>" method="post">

	<input name="search" type="text" value="">
	<input name="update" type="submit" class="btn btn-success btn-outline" value="Search" />
	<input name="alias" type="hidden" value= "<?php echo $_REQUEST['alias'] ; ?>">
</form>

<?php } ?>

<hr />
<?php

$display_ads = read_Ads(FALSE,$_SESSION['site_id'],FALSE);

	while ( $row = $_SESSION['FETCH_ARRAY']( $display_ads ) ) {
	
		echo $row['AD_IMAGE'];
		echo '<br />';
	
	}
?>