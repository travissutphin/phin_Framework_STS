<?php
/* MEMBER.UPDATE */
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
			  <h1>Update a Member</h1>
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
                            First Name:<br />
                            <input name="NAME_FIRST" type="text" class="form-control" value="<?php echo $row['NAME_FIRST']; ?>" />
                            </div>
                            
                            <div class="col-xs-4">
                            Last Name:<br />
                            <input name="NAME_LAST" type="text" class="form-control" value="<?php echo $row['NAME_LAST']; ?>" />
                            </div>
                            
                            <div class="col-xs-12">
                            &nbsp;
                            </div>
                            
                            <div class="col-xs-4">
                            Email:<br />
                            <input name="EMAIL" type="email" class="form-control" value="<?php echo $row['EMAIL']; ?>" />
							<input name="x_HIDDEN_EMAIL" type="hidden" value="<?php echo $row['EMAIL']; ?>" />
                            </div>
                            
                            <div class="col-xs-4">
                            	Password:<br />
                            	<input name="PASSWORD" type="password" class="form-control" value="<?php echo $row['PASSWORD']; ?>" />
                            </div>
                            
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                            <div class="col-xs-4">
                            Role:<br />
                            <?php html_list_Roles($row['ROLE_FK'],'class="form-control"'); ?>
                          	</div>
                            
                          	<div class="col-xs-8">
                          		&nbsp;
                          	</div>

                          	<div class="col-xs-4">
                          		<input name="update" type="submit" class="btn btn-success btn-outline" value="Update" />
                          		<input name="MEMBER_ID" type="hidden" value="<?php echo $row['MEMBER_ID']; ?>" />               
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