<?php
/* DASHBOARD.VIEW */
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
			  <h1><?php if(isset($display_values_active_site['display_name'])){ echo $display_values_active_site['display_name']; } ?> Dashboard</h1>
			</section>

			<!-- Main content -->
			<section class="content">
			
<?php // SHOW FOR ADMIN ONLY ?>
			<?php if(isset($_SESSION['members.role_id']) and $_SESSION['members.role_id'] == '1'){ ?>
					
			  <!-- Default box -->
			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Select a site to manage</h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
							title="Collapse">
					  <i class="fa fa-minus"></i></button>
				  </div>
				</div>
				<div class="box-body">
					
						<?php while ($row = $_SESSION['FETCH_ARRAY']($display_sites)){ ?>
										
							<a href="<?php echo site_Url(); ?>dashboard/view.php?site_id=<?php echo $row['SITE_ID']; ?> "> <?php echo $row['DISPLAY_NAME']; ?> </a> &nbsp;&nbsp; | &nbsp;&nbsp;
										
						<?php } ?>
					
					<?php } ?>
				  
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
				  
				</div>
				<!-- /.box-footer-->
			  </div>
			  <!-- /.box -->
<?php // end SHOW FOR ADMIN ONLY ?>

			</section>
			<!-- /.content -->
		  </div>
		  <!-- /.content-wrapper -->   
    
<?php
/*****************************************************************/
include('../templates/admin_footer.php');
?>