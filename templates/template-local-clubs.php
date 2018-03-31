<?php if ( $_REQUEST['alias'] == 'Local-Clubs' ) { ?>
	
		<div class="col-12 col-md-9">

		<div class="row">
	
			<div class="col-12 col-lg-12">
				<?php 

					if ( $_SESSION['NUM_ROWS']( $display_clubs ) == 0 ) {

						echo '<h3>No Clubs</h3>';

					}else{

						if ( isset ( $_SESSION['search_alias'] ) and $_SESSION['search_alias'] !== FALSE ) { 
						
							echo '<h2>Viewing '.str_replace( ["-", "–"], ' ', $_SESSION['search_alias'] ).'</h2>' ;
							echo '<p><small>'.$_SESSION['NUM_ROWS']($display_clubs).' Items</small></p>' ;
						
						} 

					}
				
				?>
			</div>
			
		</div>
		
			<div class="row">

				<?php while ( $row = $_SESSION['FETCH_ARRAY']( $display_clubs ) ) { // set in controller.php ?>

					<div class="col-6 col-lg-4 mb-5">

						<h3><?php echo $row['TITLE']; ?></h3>
						<p><?php echo $row['DESCRIPTION_SHORT']; ?></p>
						
					</div><!--- col-6 col-lg-4 --->

				<?php } ?>

			</div><!--/row-->
				
		</div> <!--- col-12 col-md-9 --->
	
<?php }elseif ( $_REQUEST['alias'] == 'List-Local-Club' ) { ?>

<h3>List your Event</h3>
	
<?php } ?>
