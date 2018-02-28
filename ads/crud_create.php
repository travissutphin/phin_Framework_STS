<?php
/* AD.CREATE */
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
			  <h1>Create an Ad</h1>
			</section>

			<!-- Main content -->
			<section class="content">
					
			  <!-- Default box -->
			  <div class="box">
				
				<?php echo messages($message); ?>
				
				<div class="box-body">

					<form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form">                    
                            
						<div class="col-xs-4">
							Order:<br />
							<input name="AD_SEQ" type="text" class="form-control" value="" />
						</div>
						
						<div class="col-xs-4">
							Advertiser:<br />
							<?php echo html_list_Advertisers($id=FALSE,$_SESSION['site_id'],'class="form-control"'); ?>
						</div>
						
						<div class="col-xs-4">
							Image:<br />
							<input name="AD_IMAGE" type="text" class="form-control" value="" />
						</div>
						
						<div class="col-xs-12">
							&nbsp;
						</div>
						
						<div class="col-xs-4">
							Link:<br />
							<input name="AD_LINK" type="text" class="form-control" value="" />
						</div>

						<div class="col-xs-12">
							&nbsp;
						</div>
						
						<div class="col-xs-8">
							&nbsp;
						</div>

						<div class="col-xs-4">
							<input name="create" class="btn btn-success btn-outline" type="submit" value="Create">               
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