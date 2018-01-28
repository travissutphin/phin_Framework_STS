<?php
/* PARTNER_IMAGES.CRUD_UPDATE */
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
								<strong>Update Partner Banner</strong>
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
                            	
                            
                            <?php while($row = $_SESSION['FETCH_ARRAY']($read_Partner_Image)){ ?>
                            	 
                            <form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form" enctype="multipart/form-data">                    
                            
                            
<!-- row 1 -->
                            <div class="col-xs-2">
                            	Order:<br />
                            	<input name="PI_ORDER" type="text" class="form-control" value="<?php echo $row['PI_ORDER']; ?>" />
                            </div>
                            
                            <div class="col-xs-2">
                            	Status:<br />
                            	<?php partner_images_status_HTML_Select_Lists($row['PI_STATUS']) ?>
                            </div>
                            
                            <div class="col-xs-4">
                            	Title:<br />
                            	<input name="PI_TITLE" type="text" class="form-control" value="<?php echo $row['PI_TITLE']; ?>" />
                            </div>

                            <div class="col-xs-4">
                            	URL: ( include http:// )<br />
                            	<input name="PI_URL" type="text" class="form-control" value="<?php echo $row['PI_URL']; ?>" />
                            </div>
                                                        							
							<!-- spacer between rows -->
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>

<!-- row 2 -->
                            
                            <div class="col-xs-4">
                            	Banner Image:<br />
                            	<input name="PI_IMAGE" type="file" class="form-control" />
                            	<?php if($row['PI_IMAGE'] != ""){ ?>
                            		<br /><br />
                            		<img src="<?php echo site_Url(); ?>upload_repository/<?php echo $row['PI_IMAGE']; ?>" width="250px" />
                            	<?php } ?>
                            </div>
 
 							<!-- spacer between rows -->
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                                                                                   
                            <!-- buttons -->
                            <div class="col-xs-4">
                            	 <button type="submit" name="update" id="nesto-submit" class="btn btn-nesto">Update</button>
                            	 <input name="PARTNER_IMAGE_ID" value="<?php echo $row['PARTNER_IMAGE_ID']; ?>" type="hidden" /> 
                            	 <input name="ORGANIZATION_FK" value="<?php echo $_SESSION['global_organization_id']; ?>" type="hidden" /> 
                            </div>
                            

                            </form><!-- /form -->
                            
                            <?php } ?>                    	

                            </div><!-- /row -->
                        </div><!-- /container -->

                </div><!-- /main-section -->

            </div><!-- /light-section -->

<?php include('../templates/admin_footer.php'); ?>
  