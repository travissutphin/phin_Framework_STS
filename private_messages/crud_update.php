<?php
/* ADS_UPDATE.VIEW */
/*****************************************************************/
include('../templates/admin_header.php');
include('controller.php');
/**
  * @desc	all body content would go inside here
  * @param	
  * @return 
*/
?>
		<?php include('../templates/admin_nav.php'); ?>

				 <!-- Content Wrapper. Contains page content -->
		  <div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			  <h1>Update an Ad</h1>
			</section>

			<!-- Main content -->
			<section class="content">
					
			  <!-- Default box -->
			  <div class="box">
				
				<?php echo messages($message); ?>
				
				<div class="box-body">
					
					<?php while ($row = $_SESSION['FETCH_ARRAY']($record_by_id)){ ?>
                        
                        <form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form" >                    
                            
                             <div class="col-xs-4">
                            	Order:<br />
                            	<input name="AD_SEQ" type="text" class="form-control" value="<?php echo $row['AD_SEQ']; ?>" />
                            </div>
  
							<div class="col-xs-4">
								Advertiser:<br />
								<?php echo html_list_Advertisers($row['ADVERTISER_FK'],$_SESSION['site_id'],'class="form-control"'); ?>
							</div>
						
                            <div class="col-xs-4">
                            	Image:<br />
                            	<input name="AD_IMAGE" type="text" class="form-control" value="<?php echo $row['AD_IMAGE']; ?>" />
                            </div>
                            
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                            <div class="col-xs-4">
                            	Link:<br />
                            	<input name="AD_LINK" type="text" class="form-control" value="<?php echo $row['AD_LINK']; ?>" />
                            </div>

                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                          	<div class="col-xs-8">
                          		&nbsp;
                          	</div>

                          	<div class="col-xs-4">
								<button name="update" class="btn btn-success btn-outline"> Save </button>
                          		<input name="AD_ID" type="hidden" value="<?php echo $row['AD_ID']; ?>" />                
                          	</div>
                        </form>
                        
                    <?php } ?>
					
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
				  
				</div>
				<!-- /.box-footer-->
			  </div>
			  <!-- /.box -->

			</section>
			<!-- /.content -->
		  </div>
		  <!-- /.content-wrapper -->   
    
<?php
/*****************************************************************/
include('../templates/admin_footer.php');
?>