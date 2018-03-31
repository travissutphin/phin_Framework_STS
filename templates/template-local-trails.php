<?php if ( $_REQUEST['alias'] == 'Local-Trails' ) { ?>
	
		<div class="col-12 col-md-9">

		<div class="row">
	
			<div class="col-12 col-lg-12">
				<?php 

					if ( $_SESSION['NUM_ROWS']( $display_trails ) == 0 ) {

						echo '<h3>No Clubs</h3>';

					}else{

						if ( isset ( $_SESSION['search_alias'] ) and $_SESSION['search_alias'] !== FALSE ) { 
						
							echo '<h2>Viewing '.str_replace( ["-", "–"], ' ', $_SESSION['search_alias'] ).'</h2>' ;
							echo '<p><small>'.$_SESSION['NUM_ROWS']($display_trails).' Items</small></p>' ;
						
						} 

					}
				
				?>
			</div>
			
		</div>
		
			<div class="row">

				<?php while ( $row = $_SESSION['FETCH_ARRAY']( $display_trails ) ) { // set in controller.php ?>

					<div class="col-6 col-lg-4 mb-5">

						<h3><?php echo $row['TITLE']; ?></h3>
						<p><?php echo $row['ADDRESS']; ?></p>
						
					</div><!--- col-6 col-lg-4 --->

				<?php } ?>

			</div><!--/row-->
				
		</div> <!--- col-12 col-md-9 --->
	
<?php }elseif ( $_REQUEST['alias'] == 'List-Local-Trail' ) { ?>

<h3>List a Trail</h3>
	
<?php } ?>
