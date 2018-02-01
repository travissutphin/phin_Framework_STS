    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
					
					<?php
					if(isset($_SESSION['site_id'])){ 
					
						echo $display_values_active_site['display_name'];
					
					 } 
					 ?>
					
				</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                       
                        <li>
                            <a href="<?php echo site_Url(); ?>control_panel/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						
						<?php if(isset($_SESSION['site_id'])){ ?>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Admin Tools<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_Url(); ?>stuff/"> Stuff</a>
                                </li>
								<li>
                                    <a href="<?php echo site_Url(); ?>users/"> Users</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						
						<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Categories<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
									
									<?php while ($row = $_SESSION['FETCH_ARRAY']($display_categories)){ ?>
                                    
									<a href="<?php echo site_Url(); ?>control_panel/view.php?site_id=<?php echo $row['CATEGORY_ID']; ?> "> <?php echo $row['NAME']; ?> </a>
									
									<?php } ?>
									
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						
						<?php } ?>
						
						<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Sites<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
									
									<?php while ($row = $_SESSION['FETCH_ARRAY']($display_sites)){ ?>
                                    
									<a href="<?php echo site_Url(); ?>control_panel/view.php?site_id=<?php echo $row['SITE_ID']; ?> "> <?php echo $row['DISPLAY_NAME']; ?> </a>
									
									<?php } ?>
									
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>						

                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>