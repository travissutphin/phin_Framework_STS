<?php if ( $_SESSION['NUM_ROWS']( $display_stuff_details ) == 1 ) {  // set in controller.php ?>

<!--- STUFF DETAIL --->
<!------------------------------>

	<div class="col-12 col-md-9">
	
		<div class="row">

			<?php while ( $row = $_SESSION['FETCH_ARRAY']($display_stuff_details ) ) { // set in controller.php ?>

				<div class="col-12 col-lg-12">

					<h3><?php echo $row['TITLE']; ?></h3>
					<p><?php echo '<img src='.site_Url().'upload_repository/'.$row['PRIMARY_IMAGE'].' width="100px" class="pull-right">' ; ?></p><p><?php echo $row['DESCRIPTION_LONG']; ?></p>
					<p>Tiny URL: <?php echo get_tiny_url(site_Url().''.$row['ALIAS']) ; ?></p>
					
				</div><!--- col-6 col-lg-4 --->

			<?php } ?>

		</div><!--/row-->
			
	</div> <!--- col-12 col-md-9 --->

<?php }else{ ?>

<!--- ALL STUFF RECORDS --->
<!------------------------------------------>

	<div class="col-12 col-md-9">
	
		<div class="row">
	
			<div class="col-12 col-lg-12">
				<?php 

					if ( $_SESSION['NUM_ROWS']( $display_stuff_all ) == 0 ) {

						echo '<h3>No Records for '.$_REQUEST['alias'].'</h3>';

					}else{

						if ( isset ( $_SESSION['search_alias'] ) and $_SESSION['search_alias'] !== FALSE ) { 
						
							echo '<h2>Viewing '.$_SESSION['search_alias'].'</h2>' ;
							echo '<p><small>'.$_SESSION['NUM_ROWS']($display_stuff_all).' Items</small></p>' ;
						
						} 

					}
				
				?>
			</div>
			
		</div>
		
		<div class="row">
			
			<div class="col-12 col-lg-12">
				
			</div>
			
			<?php while ( $row = $_SESSION['FETCH_ARRAY']($display_stuff_all ) ) { // set in controller.php ?>

				<div class="col-6 col-lg-4">
					
					<?php
						if ( isset ( $_REQUEST['search_classifieds'] ) and $_REQUEST['search_classifieds'] != '' ) {
							
							$keyword = $_REQUEST['search_classifieds'];
							$row['DESCRIPTION_LONG'] = preg_replace("/($keyword)/i","<span class='text-warning'>$1</span>",$row['DESCRIPTION_LONG']);
							
							$keyword = $_REQUEST['search_classifieds'];
							$row['TITLE'] = preg_replace("/($keyword)/i","<span class='text-warning'>$1</span>",$row['TITLE']);
						}
						$record_category = read_Values_Categories( $id=$row['CATEGORY_FK'],$site_fk=$_SESSION['site_id'],$name=FALSE ) ; 
					?>
				  <h3><?php $title = strtolower ( $row['TITLE'] ) ; echo ucwords( $title ) ; ?></h3>
				  <span class="badge badge-primary"><?php echo $record_category['name'] ; ?></span>
				  <p><small><?php echo date( 'F d, Y', strtotime( $row['CREATED_AT'] ) ) ; ?></small></p>
				  <p><?php echo '<img src='.site_Url().'upload_repository/'.$row['PRIMARY_IMAGE'].' width="100px" class="pull-right">' ; ?></p><p><?php echo $row['DESCRIPTION_LONG']; ?></p>
				  <p><a class="btn btn-secondary" href="<?php echo site_Url().''.$row['ALIAS']; ?>" role="button">View details &raquo;</a></p>
					
				</div><!--- col-6 col-lg-4 --->

			<?php } ?>

		</div><!--/row-->
			
	</div> <!--- col-12 col-md-9 --->

<?php } ?>