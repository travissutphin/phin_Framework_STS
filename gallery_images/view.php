<?php
/* PARTNER_IMAGES.VIEW */
/*****************************************************************/
if(isset($_SESSION['dev_mode'])){
	error_reporting(E_ALL); 
	ini_set('display_errors',1);
}

include('../_system/config.php');
include('controller.php'); 
?>

<?php include('../templates/admin_header.php'); ?>

        <!-- =========================================
        Main Wrapper
        ========================================== -->
        <!-- main-wrapper -->
        <div id="main-wrapper">




            <!-- =========================================
            Header
            ========================================== -->
            <!-- header -->
            <header class="header top-header-light header-menu-light sub-menu-light">




                <!-- top-header -->
                <!-- /top-header -->




                <!-- header-menu-wrapper -->
                <div class="header-menu-wrapper">
                    <!-- header-menu -->
                    <div class="header-menu">



                        <!-- navbar -->
                        <nav class="navbar" role="navigation">

                            <!-- container -->
                            <div class="container">
                                <!-- row -->
                                <div class="row">


                                    <!-- col-md-12 -->
                                    <div class="col-md-12">


                                        <?php include('../templates/admin_nav.php'); ?>


                                        <!-- navbar-collapse -->
                                        <!-- /navbar-collapse -->


                                    </div><!-- /col-md-12 -->


                                </div><!-- /row -->
                            </div><!-- /container -->

                        </nav><!-- /navbar -->



                    </div><!-- /header-menu -->
                </div><!-- /header-menu-wrapper -->




            </header><!-- /header -->




            <!-- =========================================
            Breadcrumb Section
            ========================================== -->				
			<?php 
				if(isset($message) and $message != FALSE){
					echo '<div class="col-md-2"> </div>';
					echo '<div class="col-md-8">'.messages($message).'</div>';
					echo '<div class="col-md-2"> </div>';
				}else{
					echo '<div class="col-md-2"> </div>';
					echo '<div class="col-md-8">
							<div class="alert alert-info fade in">
								<strong>Partner Images</strong>
				   			</div>
						  </div>';
					echo '<div class="col-md-2"> </div>';
				}
			?>
	            



            <!-- =========================================
            Light Section
            ========================================== -->
            <!-- light-section -->
            <div class="light-section">

                <!-- main-section -->
                <div class="main-section">

                        <!-- container -->
                        <div class="container container-min-height-01">
                            <!-- row -->
                            <div class="row">

                                <!-- col-md-12 -->
                                <div class="col-md-12">
                                                                        
                                	<div class="table-responsive">
                                	<table class="table table-striped table-bordered">
                                		<thead>
                                		<tr>
                                			<th width="10px">Order</th>
                                			<th width="10px">Status</th>
                                			<th>Title</th>
                                			<th>URL</th>
                                			<th width="150px">Image</th>
                                			<th width="50px"></th>
                                			<th width="50px">
												<a href="<?php echo app_Url(); ?>partner_images/crud_create.php">
	                                    		<button type="button" id="nesto-submit" class="btn btn-nesto">
	                                    			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Image
	                                    		</button>
	                                    		</a>
	                                    	</th>
                                		</thead>
                                		
                                		<tbody>
                                		
                                		<?php while($row = $_SESSION['FETCH_ARRAY']($read_Partner_Images)) { ?>
                                		<tr class="info">
                                			<td scope="row"><?php echo $row['PI_ORDER']; ?></td>
                                			<td><?php echo active_status_Helpers($row['PI_STATUS']) ?></td>
                                			<td><?php echo $row['PI_TITLE']; ?></td>
                                			<td><?php echo $row['PI_URL']; ?></td>
											<td><img src="<?php echo site_Url(); ?>upload_repository/<?php echo $row['PI_IMAGE']; ?>" width="150px" /></td>
											<td>

												<form name="user_edit" action="<?php echo app_Url(); ?>partner_images/crud_update.php" method="post">
                                				
	                                    		<button type="submit" id="nesto-submit" class="btn btn-nesto">
	                                    			<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
	                                    		</button>
	                                    		<input name="PARTNER_IMAGE_ID" value="<?php echo $row['PARTNER_IMAGE_ID']; ?>" type="hidden">
	                                    			                                    		
                                    			</form>

											</td>
											<td>
											
												<form name="delete_partner_image" action="view.php" method="post">
	                                    		<button type="submit" name="delete" id="nesto-submit" class="btn btn-nesto" onclick="return confirm('Are you sure you want to delete this image?')">
	                                    			<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Delete
	                                    		</button>
	                                    		<input name="PARTNER_IMAGE_ID" type="hidden" value="<?php echo $row['PARTNER_IMAGE_ID']; ?>"/>
	                                    		<input name="delete_partner_image" type="hidden" value="1"/>
                                    			</form>

											</td>
											
                                		</tr>
                                		<?php } // while($row = $_SESSION['FETCH_ARRAY']($read_Unit_Types)) {  ?>
                                		
                                		</tbody>
                                	</table>
                                	</div>
                                   
                                </div><!-- /col-md-12 -->


                            </div><!-- /row -->
                        </div><!-- /container -->

                </div><!-- /main-section -->

            </div><!-- /light-section -->


<?php include('../templates/admin_footer.php'); ?>