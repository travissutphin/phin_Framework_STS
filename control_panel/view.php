<?php
/* CONTROL_PANEL.VIEW */
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
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    
					<?php if(isset($_SESSION['site_id'])){ ?>
						
						<h1 class="page-header">
							<?php echo $display_values_active_site['display_name']; ?> Dashboard
						</h1>
						
					<?php  }else{ ?>
					
						<h1 class="page-header">
							Please select a site to manage
						</h1>
					
					<?php } ?>
					
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper - from admin_nav.cfm -->
    
    
<?php
/*****************************************************************/
include('../templates/admin_footer.php');
?>