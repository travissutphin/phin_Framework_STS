<?php
/* INVOICES.CREATE */
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
			  <h1>Invoices</h1>
			</section>

			<!-- Main content -->
			<section class="content">
					
			  <!-- Default box -->
			  <div class="box">
				
				<?php echo messages($message); ?>
				
				<div class="box-body">
					
					<form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form" enctype="multipart/form-data">                    
                            
						<div class="col-xs-4">
							Title:<br />
							<input name="TITLE" type="text" class="form-control" value="" />
						</div>

						<div class="col-xs-4">
							Address:<br />
							<input name="ADDRESS" type="text" class="form-control" value="" />
						</div>

						<div class="col-xs-4">
							City:<br />
							<input name="CITY" type="text" class="form-control" value="" />
						</div>
						
						<div class="col-xs-4">
							State:<br />
							<input name="STATE" type="text" class="form-control" value="" />
						</div>

						<div class="col-xs-4">
							Zip:<br />
							<input name="ZIP" type="text" class="form-control" value="" />
						</div>
						
						<div class="col-xs-12">
							&nbsp;
						</div>

						<div class="col-xs-4">
							Start Date:<br />
							<input name="DATE_FROM" type="text" class="form-control" value="" />
						</div>

						<div class="col-xs-4">
							End Date:<br />
							<input name="DATE_To" type="text" class="form-control" value="" />
						</div>

						<div class="col-xs-4">
							Link:<br />
							<input name="IMAGE" type="text" class="form-control" value="" />
						</div>

						<div class="col-xs-4">
							Image:<br />
							<input name="LINK" type="text" class="form-control" value="" />
						</div>
						
						<div class="col-xs-12">
							&nbsp;
						</div>

						<div class="col-xs-8">
							Short Intro:
							<textarea name="DESCRIPTION_Short" class="form-control" rows=4"></textarea>
						</div>
						
						<div class="col-xs-8">
							Description:
							<textarea name="DESCRIPTION_LONG" class="form-control" rows=8"></textarea>
						</div>

						<div class="col-xs-12">
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