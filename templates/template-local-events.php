<?php if ( $_REQUEST['alias'] == 'Local-Events' ) { ?>
		
		<div class="col-12 col-md-9">

		<div class="row">
	
			<div class="col-12 col-lg-12">
				<?php 

					if ( $_SESSION['NUM_ROWS']( $display_events ) == 0 ) {

						echo '<h3>No Events</h3>';

					}else{

						if ( isset ( $_SESSION['search_alias'] ) and $_SESSION['search_alias'] !== FALSE ) { 
						
							echo '<h2>Viewing '.str_replace( ["-", "–"], ' ', $_SESSION['search_alias'] ).'</h2>' ;
							echo '<p><small>'.$_SESSION['NUM_ROWS']($display_events).' Items</small></p>' ;
						
						} 

					}
				
				?>
			</div>
			
		</div>
		
			<div class="row">

				<?php while ( $row = $_SESSION['FETCH_ARRAY']( $display_events ) ) { // set in controller.php ?>

					<div class="col-6 col-lg-4 mb-5">

						<h3><?php echo $row['TITLE']; ?></h3>
						<p><?php echo $row['ADDRESS']; ?></p>
						<p><?php echo $row['DATE_FROM']; ?></p>
						
					</div><!--- col-6 col-lg-4 --->

				<?php } ?>

			</div><!--/row-->
				
		</div> <!--- col-12 col-md-9 --->
	
<?php }elseif ( $_REQUEST['alias'] == 'List-Local-Event' ) { ?>
			
			<div class="row">
					
					<div class="col-12 col-lg-12 mb-5">
						
						<h3>List your Event</h3>
						
					</div>
					
					<div class="col-12 col-lg-12 mb-5">

						<form name="add_event" action="Local-Events" method="post">
						
						<div class="col-10 mb-3">
							Title:<br />
							<input name="TITLE" type="text" class="form-control" value="" />
						</div>
						
						<div class="col-10 mb-3">
							Event Address:<br />
							<?php html_list_Zip_Code_Geolocator($id=FALSE,$values=FALSE,$state=FALSE,$city=FALSE,$select_form_name=FALSE) ; ?>
						</div>
						
						<div class="col-10 mb-3">
							Event Location Zip Code:<br />
							<input name="ZIP" type="text" class="form-control" value="" />
						</div>
						
						<div class="col-10 mb-3">
							Information:<br />
							<input name="DESCRIPTION_LONG" type="text" class="form-control" value="" />
						</div>
						
						<div class="col-10 mb-3">
							Event Starts On:<br />
							<input name="DATE_FROM" type="text" class="form-control" value="" />
						</div>

						<div class="col-10 mb-3">
							Event Ends On:<br />
							<input name="DATE_TO" type="text" class="form-control" value="" />
						</div>

						<div class="col-10 mb-3">
							Link:<br />
							<input name="LINK" type="text" class="form-control" value="" />
						</div>						

						</form>
						
					</div><!--- col-6 col-lg-4 --->

			</div><!--/row-->
				
		</div> <!--- col-12 col-md-9 --->

	
<?php } ?>
