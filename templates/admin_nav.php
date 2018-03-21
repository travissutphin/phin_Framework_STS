  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="user-profile treeview">
          <a href="#">
			<img src="<?php echo site_Url(); ?>assets/admin/images/user5-128x128.jpg" alt="user">
            <span><?php echo $_SESSION['members.name_first'].' '.$_SESSION['members.name_last']; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
		  <?php if(isset($_SESSION['site_id'])){ ?>
		  <ul class="treeview-menu">
            <li><a href="<?php echo site_Url(); ?>my_profile/view.php"><i class="fa fa-user mr-5"></i>My Profile </a></li>
			<li><a href="<?php echo site_Url(); ?>private_messages"><i class="fa fa-envelope-open mr-5"></i>Private Messages</a></li>
			<li><a href="<?php echo site_Url(); ?>invoices"><i class="fa fa-cog mr-5"></i>Invoices</a></li>
			<li><a href="<?php echo site_Url(); ?>login/view.php?logout"><i class="fa fa-power-off mr-5"></i>Logout</a></li>
          </ul>
		  <?php } ?>
        </li>

<!--- DASHBOARD --->
        <li>
          <a href="<?php echo site_Url(); ?>dashboard/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
<!--- ADMIN NAVIGATION IF SITE SELECTED --->
<!--------------------------------------------------------------------->

		<?php if(isset($_SESSION['site_id']) and $_SESSION['members.role_id'] == '1'){ ?>
	<!--- ADS --->
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Ads</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?php echo site_Url(); ?>ads/crud_create.php"><i class="fa fa-circle-thin"></i>Add</a></li>
            <li><a href="<?php echo site_Url(); ?>ads/"><i class="fa fa-circle-thin"></i>View</a></li>
          </ul>
        </li>
	<!--- ADVERTISERS --->
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Advertisers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?php echo site_Url(); ?>advertisers/crud_create.php"><i class="fa fa-circle-thin"></i>Add</a></li>
            <li><a href="<?php echo site_Url(); ?>advertisers/view.php"><i class="fa fa-circle-thin"></i>View</a></li>
          </ul>
        </li>

<!--- ADVERTISERS --->
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Advertisers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?php echo site_Url(); ?>advertisers/crud_create.php"><i class="fa fa-circle-thin"></i>Add</a></li>
            <li><a href="<?php echo site_Url(); ?>advertisers/view.php"><i class="fa fa-circle-thin"></i>View</a></li>
          </ul>
        </li>

<!--- CLUBS --->
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Clubs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?php echo site_Url(); ?>clubs/crud_create.php"><i class="fa fa-circle-thin"></i>Add</a></li>
            <li><a href="<?php echo site_Url(); ?>clubs/view.php"><i class="fa fa-circle-thin"></i>View</a></li>
          </ul>
        </li>
		
<!--- CONTENT --->
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Content</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?php echo site_Url(); ?>content/crud_create.php"><i class="fa fa-circle-thin"></i>Add</a></li>
            <li><a href="<?php echo site_Url(); ?>content/view.php"><i class="fa fa-circle-thin"></i>View</a></li>
          </ul>
        </li>
		
<!--- EVENTS --->
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Events</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?php echo site_Url(); ?>events/crud_create.php"><i class="fa fa-circle-thin"></i>Add</a></li>
            <li><a href="<?php echo site_Url(); ?>events/view.php"><i class="fa fa-circle-thin"></i>View</a></li>
          </ul>
        </li>

<!--- MEMBERS--->
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Members</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?php echo site_Url(); ?>members/crud_create.php"><i class="fa fa-circle-thin"></i>Add</a></li>
            <li><a href="<?php echo site_Url(); ?>members/view.php"><i class="fa fa-circle-thin"></i>View</a></li>
          </ul>
        </li>
		
<!--- STUFF --->
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Stuff</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_Url(); ?>stuff/view.php"><i class="fa fa-circle-thin"></i>View</a></li>
          </ul>
        </li>

<!---TRAILS --->
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Trails</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?php echo site_Url(); ?>trails/crud_create.php"><i class="fa fa-circle-thin"></i>Add</a></li>
            <li><a href="<?php echo site_Url(); ?>trails/view.php"><i class="fa fa-circle-thin"></i>View</a></li>
          </ul>
        </li>

<!--- MEMBER NAVIGATION --->
<!------------------------------------------->

<!--- STUFF --->
		<?php }elseif(isset($_SESSION['members.role_id']) and $_SESSION['members.role_id'] == '2'){ ?>
		
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Stuff</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?php echo site_Url(); ?>stuff/crud_create.php"><i class="fa fa-circle-thin"></i>Add</a></li>
            <li><a href="<?php echo site_Url(); ?>stuff/view.php"><i class="fa fa-circle-thin"></i>View</a></li>
          </ul>
        </li>

		<?php } // if(isset($_SESSION['site_id'])){ ?>
        
      </ul>
    </section>
  </aside>
  
<?php /*
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
                                    <a href="<?php echo site_Url(); ?>content/"> Content</a>
                                </li>
								<li>
                                    <a href="<?php echo site_Url(); ?>users/"> Users</a>
                                </li>
								<li>
                                    <a href="<?php echo site_Url(); ?>stuff/"> <?php echo SITE_DISPLAY_NAME; ?> Stuff</a>
                                </li>
								<li>
                                    <a href="<?php echo site_Url(); ?>ads/"> <?php echo SITE_DISPLAY_NAME; ?> Ads</a>
                                </li>
								<li>
                                    <a href="<?php echo site_Url(); ?>advertisers/"> <?php echo SITE_DISPLAY_NAME; ?> Advertisers</a>
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

                        <li>
                            <a href="<?php echo site_Url(); ?>login/view.php?logout"><i class="fa fa-dashboard fa-fw"></i> Log out</a>
                        </li>						

                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
*/ ?>