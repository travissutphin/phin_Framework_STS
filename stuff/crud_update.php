<?php
/* STUFF_UPDATE.VIEW */
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
			  <h1><?php if(isset($display_values_active_site['display_name'])){ echo $display_values_active_site['display_name']; } ?> Stuff</h1>
			</section>

			<!-- Main content -->
			<section class="content">
					
			  <!-- Default box -->
			  <div class="box">
				
				<?php echo messages($message); ?>
				
				<div class="box-body">
					
					 <?php while ($row = $_SESSION['FETCH_ARRAY']($record_by_id)){ ?>
					<form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form" enctype="multipart/form-data">                    
                            
						<div class="col-xs-4">
							Title:<br />
							<input name="TITLE" type="text" class="form-control" value="<?php echo $row['TITLE']; ?>" />
						</div>

						<div class="col-xs-4">
							Year Start:<br />
							<?php html_list_Years_to_Present_HTML_Select_Lists($field_name="YEAR_START_DK",$value=$row['YEAR_START_DK'],$class='form-control'); ?>
						</div>

						<div class="col-xs-4">
							Year End:<br />
							<?php html_list_Years_to_Present_HTML_Select_Lists($field_name='YEAR_END_DK',$value=$row['YEAR_END_DK'],$class='form-control'); ?>
						</div>

						<div class="col-xs-12">
							&nbsp;
						</div>

						<div class="col-xs-4">
							Model:<br />
							<?php html_list_Models($id=$row['MODEL_FK'],$site_fk=SITE_ID, $field_name='MODEL_FK', $class='form-control'); ?>
						</div>

						<div class="col-xs-4">
							Category:<br />
							<?php html_list_Categories($id=$row['CATEGORY_FK'],$site_fk=SITE_ID,$field_name='CATEGORY_FK',$class='form-control'); ?>
						</div>

						<div class="col-xs-4">
							Status:<br />
							<?php html_list_Status_HTML_Select_Lists($field_name='STATUS',$value=$row['STATUS'],$class='form-control') ?>
						</div>

						<div class="col-xs-12">
							&nbsp;
						</div>

						<div class="col-xs-4">
							Image:
							<input name="PRIMARY_IMAGE" type="file" class="form-control" value="" />
							<?php
								
								if($row['PRIMARY_IMAGE'] != ''){
								
									echo '<img src="../../upload_repository/'.$row['PRIMARY_IMAGE'].' width="150" class="img-responsive" />';
								
								}
							
							?>
						</div>
							
						<div class="col-xs-8">
                            Description:
							<textarea name="DESCRIPTION_LONG" class="form-control" rows=8"><?php echo $row['DESCRIPTION_LONG'] ?></textarea>
                        </div>

						<div class="col-xs-12">
							&nbsp;
						</div>

						<div class="col-xs-4">
                          		<button name="update" class="btn btn-success btn-outline"> Save </button>
                          		<input name="STUFF_ID" type="hidden" value="<?php echo $row['STUFF_ID']; ?>" />               
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