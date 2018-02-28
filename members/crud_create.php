<?php
/* MEMBERS.CREATE */
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
			  <h1>Create a Member</h1>
			</section>

			<!-- Main content -->
			<section class="content">
					
			  <!-- Default box -->
			  <div class="box">
				
				<?php echo messages($message); ?>
				
				<div class="box-body">

					<form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form">                    
                            
                            <div class="col-xs-4">
                            	First Name:<br />
                            	<input name="NAME_FIRST" type="text" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-4">
                            	Last Name:<br />
                            	<input name="NAME_LAST" type="text" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                            <div class="col-xs-4">
                            	Email:<br />
                            	<input name="EMAIL" type="email" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-4">
                            	Password:<br />
                            	<input name="PASSWORD" type="password" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                            <div class="col-xs-4">
                            	Role:<br />
                            	<?php html_list_Roles(FALSE,'class="form-control"'); ?>
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