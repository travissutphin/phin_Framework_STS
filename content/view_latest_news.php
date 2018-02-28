<?php
/* CONTENT.VIEW */
/*****************************************************************/
if(isset($_SESSION['dev_mode'])){
	error_reporting(E_ALL); 
	ini_set('display_errors',1);
}

include('../_system/config.php');

$content_type = "Latest_News";

include('controller.php'); 
?>

<?php include('../templates/admin_header.php'); ?>

        <!-- =========================================
        Main Wrapper
        ========================================== -->
        <!-- main-wrapper -->
        <div id="main-wrapper">




            <!-- =========================================
            Header
            ========================================== -->
            <!-- header -->
            <header class="header top-header-light header-menu-light sub-menu-light">




                <!-- top-header -->
                <!-- /top-header -->




                <!-- header-menu-wrapper -->
                <div class="header-menu-wrapper">
                    <!-- header-menu -->
                    <div class="header-menu">

                        <div class="col-md-12">

                        	<?php include('../templates/admin_nav.php'); ?>

                        </div><!-- /col-md-12 -->

                    </div><!-- /header-menu -->
                </div><!-- /header-menu-wrapper -->




            </header><!-- /header -->




            <!-- =========================================
            Breadcrumb Section
            ========================================== -->				
			<?php 
				if(isset($message) and $message != FALSE){
					echo '<div class="col-md-2"> </div>';
					echo '<div class="col-md-8">'.messages($message).'</div>';
					echo '<div class="col-md-2"> </div>';
				}else{
					echo '<div class="col-md-2"> </div>';
					echo '<div class="col-md-8">
							<div class="alert alert-info fade in">
								<strong>Content - Latest News</strong>
				   			</div>
						  </div>';
					echo '<div class="col-md-2"> </div>';
				}
			?>
	            



            <!-- =========================================
            Light Section
            ========================================== -->
            <!-- light-section -->
            <div class="light-section">

                <!-- main-section -->
                <div class="main-section">

                        <!-- container -->
                        <div class="container container-min-height-01">
                            <!-- row -->
                            <div class="row">

                                <!-- col-md-12 -->
                                <div class="col-md-12">
                                                                        
                                	<div class="table-responsive">
                                	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <form name="manager" action="crud_create.php" method="post">
                            <thead>
                                <tr>
                                    <th width="125px">Ordering</th>
                                    <th>Title</th>
                                    <th>Alias</th>
                                    <th width="125px">Navigation</th>
                                    <th width="210px">
                                    	<button name="crud_create" type="submit" id="nesto-submit" class="btn btn-success btn-xs btn-outline">
	                                    	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
	                                    </button>
									</th>
                                </tr>
                            </thead>
                            <input name="CON_PARENT_ID" value="-1" type="hidden" />
                            </form>
                            <tbody>                    
                            
							<?php // Latest News Pages // ?>
							<?php while ($row = $_SESSION['FETCH_ARRAY']($records_content_latest_news_pages)){ ?>                      
                              <tr class="success">
                                <td>
                                	<form name="manage" action="view.php" method="post">
                                	<input name="update_sequence" size="5px" type="text" value="<?php echo $row['CON_SEQUENCE']; ?>" onchange="this.form.submit()" />
                                	<input name="CONTENT_ID" type="hidden" value="<?php echo $row['CONTENT_ID']; ?>" />
                                	</form>
                                </td>
                                <td><?php echo $row['CON_TITLE']; ?></td>
                                <td><?php echo $row['CON_ALIAS']; ?></td>
                                <td><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Latest News</td>                                           
                                <td>
                                <form name="manage" action="crud_update.php" method="post">
                                    <button name="crud_update" type="submit" id="nesto-submit" class="btn btn-info btn-xs btn-outline">
	                                	<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
	                                </button>
                                    <button name="delete" class="btn btn-danger btn-xs btn-outline" onClick="return confirm('Are you sure you want to delete')">Delete</button>
                                    <input name="CONTENT_ID" type="hidden" value="<?php echo $row['CONTENT_ID']; ?>" />
                                    
                                    <button name="archive" class="btn btn-warning btn-xs btn-outline" onClick="return confirm('Are you sure you want to archive this?')">Archive</button>
                                    
                                </form>
                                </td>
                              </tr>
                            <?php } ?>
                            
 							<tr class="warning">
 								<td colspan="5"><h3>Archived</h3></td>
 							</tr>
 
 							<?php // Archived Latest News Pages // ?>
							<?php while ($rowB = $_SESSION['FETCH_ARRAY']($records_content_latest_news_pages_archived)){ ?>                      
                              <tr class="default">
                                <td>
                                	<form name="manage" action="view.php" method="post">
                                	<input name="update_sequence" size="5px" type="text" value="<?php echo $rowB['CON_SEQUENCE']; ?>" onchange="this.form.submit()" />
                                	<input name="CONTENT_ID" type="hidden" value="<?php echo $rowB['CONTENT_ID']; ?>" />
                                	</form>
                                </td>
                                <td><?php echo $rowB['CON_TITLE']; ?></td>
                                <td><?php echo $rowB['CON_ALIAS']; ?></td>
                                <td><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Latest News</td>                                           
                                <td>
                                <form name="manage" action="crud_update.php" method="post">
                                    <button name="crud_update" type="submit" id="nesto-submit" class="btn btn-info btn-xs btn-outline">
	                                	<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
	                                </button>
                                    <button name="delete" class="btn btn-danger btn-xs btn-outline" onClick="return confirm('Are you sure you want to delete')">Delete</button>
                                    <input name="CONTENT_ID" type="hidden" value="<?php echo $rowB['CONTENT_ID']; ?>" />
                                    
                                    <button name="unarchive" class="btn btn-warning btn-xs btn-outline" onClick="return confirm('Are you sure you want to unarchive this?')">Un-Archive</button>
                                    
                                </form>
                                </td>
                              </tr>
                            <?php } ?>                           
                                                        
                            </tbody>
                        </table>
                                	</div>
                                   
                                </div><!-- /col-md-12 -->


                            </div><!-- /row -->
                        </div><!-- /container -->

                </div><!-- /main-section -->

            </div><!-- /light-section -->


<?php include('../templates/admin_footer.php'); ?>
