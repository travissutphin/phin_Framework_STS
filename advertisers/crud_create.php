<?php
/* ADVERTISERS.CRUD_CREATE */
/*****************************************************************/
include('../templates/admin_header.php');
include('controller.php');
?>


		<?php include('../templates/admin_nav.php'); ?>

				 <!-- Content Wrapper. Contains page content -->
		  <div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			  <h1>Create Advertiser</h1>
			</section>

			<!-- Main content -->
			<section class="content">
					
			  <!-- Default box -->
			  <div class="box">
				
				<?php echo messages($message); ?>
				
				<div class="box-body">

					<form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form">                    
                            
                            <div class="col-xs-4">
                            	Name:<br />
                            	<input name="NAME" type="text" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-4">
                            	Contact:<br />
                            	<input name="CONTACT" type="text" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                            <div class="col-xs-4">
                            	Link:<br />
                            	<input name="LINK" type="url" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                          	<div class="col-xs-8">
                          		&nbsp;
                          	</div>

                          	<div class="col-xs-4">
								<input name="create" type="submit" class="btn btn-success btn-outline" value="Create" />            
                          	</div>
                        </form>
					
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