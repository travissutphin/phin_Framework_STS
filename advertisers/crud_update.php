<?php
/* ADVERTISERS.CRUD_UPDATE */
/*****************************************************************/
include('../templates/admin_header.php');
include('controller.php');

?>

	<?php include('../templates/admin_nav.php'); ?>

				 <!-- Content Wrapper. Contains page content -->
		  <div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			  <h1>Update Advertiser</h1>
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
                            	Name:<br />
                            	<input name="NAME" type="text" class="form-control" value="<?php echo $row['NAME']; ?>" />
                            </div>
                            
                            <div class="col-xs-4">
                            	Contact:<br />
                            	<input name="CONTACT" type="text" class="form-control" value="<?php echo $row['CONTACT']; ?>" />
                            </div>
                            
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                            <div class="col-xs-4">
                            	Link:<br />
                            	<input name="LINK" type="url" class="form-control" value="<?php echo $row['LINK']; ?>" />
                            </div>
                            
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                          	<div class="col-xs-8">
                          		&nbsp;
                          	</div>

                          	<div class="col-xs-4">
                          		<input name="update" type="submit" class="btn btn-success btn-outline" value="Update" />
                          		<input name="ADVERTISER_ID" type="hidden" value="<?php echo $row['ADVERTISER_ID']; ?>" />               
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