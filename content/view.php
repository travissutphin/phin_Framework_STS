<?php/* CONTENT.VIEW *//*****************************************************************/include('../templates/admin_header.php');include('controller.php');
?>
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
                        <!-- navbar -->
                        <nav class="navbar" role="navigation">

                            <!-- container -->
                            <div class="container">
                                <!-- row -->
                                <div class="row">


                                    <!-- col-md-12 -->
                                    <div class="col-md-12">


                                        <?php include('../templates/admin_nav.php'); ?>


                                        <!-- navbar-collapse -->
                                        <!-- /navbar-collapse -->


                                    </div><!-- /col-md-12 -->


                                </div><!-- /row -->
                            </div><!-- /container -->

                        </nav><!-- /navbar -->



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
								<strong>Content</strong>
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
                                    <th width="135px">
                                    	<button name="crud_create" type="submit" id="nesto-submit" class="btn btn-success btn-xs btn-outline">
	                                    	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
	                                    </button>
									</th>
                                </tr>
                            </thead>
                            </form>
                            <tbody>
                            <?php while ($row = $_SESSION['FETCH_ARRAY']($records_content)){ ?>                      
                              <tr class="info">
                                <td>
                                	<?php if($row['CON_PARENT_ID'] != "0"){ ?>
                                	<form name="manage" action="view.php" method="post">
                                	<input name="update_sequence" size="5px" type="text" value="<?php echo $row['CON_SEQUENCE']; ?>" onchange="this.form.submit()" />
                                	<input name="CONTENT_ID" type="hidden" value="<?php echo $row['CONTENT_ID']; ?>" />
                                	</form>
                                	<?php } ?>
                                </td>
                                <td><?php echo $row['CON_TITLE']; ?></td>
                                <td><?php echo $row['CON_ALIAS']; ?></td>
                                <td>Main Nav</td>                                           
                                <td>
                                <form name="manage" action="crud_update.php" method="post">
                                    <button name="crud_update" type="submit" id="nesto-submit" class="btn btn-info btn-xs btn-outline">
	                                	<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
	                                </button>
                                    <button name="delete" class="btn btn-danger btn-xs btn-outline" onClick="return confirm('Are you sure you want to delete')">Delete</button>
                                    <input name="CONTENT_ID" type="hidden" value="<?php echo $row['CONTENT_ID']; ?>" />
                                </form>
                                </td>
                              </tr>
                            
	                            <?php // sub navigation content ?>
	                            <?php $read_sub_nav = read_Content(FALSE,FALSE,$row['CONTENT_ID'],FALSE,'nav') ?>
	                            <?php while ($row_sub_nav = $_SESSION['FETCH_ARRAY']($read_sub_nav)){ ?>                      
	                              <tr class="warning">
	                                <td align="right">
	                                	<form name="manage" action="view.php" method="post">
	                                	<input name="update_sequence" size="5px" type="text" value="<?php echo $row_sub_nav['CON_SEQUENCE']; ?>" onchange="this.form.submit()" />
	                                	<input name="CONTENT_ID" type="hidden" value="<?php echo $row_sub_nav['CONTENT_ID']; ?>" />
	                                	</form>
	                                </td>
	                                <td><?php echo $row_sub_nav['CON_TITLE']; ?></td>
	                                <td><?php echo $row_sub_nav['CON_ALIAS']; ?></td>
	                                <td>Sub Nav</td>                                           
	                                <td>
	                                <form name="manage" action="crud_update.php" method="post">
                                    	<button name="crud_update" type="submit" id="nesto-submit" class="btn btn-info btn-xs btn-outline">
	                                		<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
	                                	</button>
	                                    <button name="delete" class="btn btn-danger btn-xs btn-outline" onClick="return confirm('Are you sure you want to delete')">Delete</button>
	                                    <input name="CONTENT_ID" type="hidden" value="<?php echo $row_sub_nav['CONTENT_ID']; ?>" />
	                                </form>
	                                </td>
	                              </tr>
	                            <?php } ?>
                            
                            <?php } ?>
                                          
                            
							<?php // Latest News Pages // ?>
							<?php // removed in favor of seperate new section
							/*
							while ($row = $_SESSION['FETCH_ARRAY']($records_content_latest_news_pages)){ ?>                      
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
                                </form>
                                </td>
                              </tr>
                            <?php } 
							 * 
							 * 
							 */?>
                            
                            
                                                        
                            </tbody>
                        </table>
                                	</div>
                                   
                                </div><!-- /col-md-12 -->


                            </div><!-- /row -->
                        </div><!-- /container -->

                </div><!-- /main-section -->

            </div><!-- /light-section -->


<?php include('../templates/admin_footer.php'); ?>
