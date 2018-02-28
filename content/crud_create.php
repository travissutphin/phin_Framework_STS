<?php
/* CONTENT.CRUD_CREATE */
/*****************************************************************/
if(isset($_SESSION['dev_mode'])){
	error_reporting(E_ALL); 
	ini_set('display_errors',1);
}

include('../_system/config.php');
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
								<strong>Create a Content Page</strong>
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
                            
								<form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form" enctype="multipart/form-data">                    
		                        
		                        <div class="col-xs-8">
		                            
		                            <div class="col-xs-4">
		                            	Navigation:<br />
		                            	
		                            	<?php if(isset($_POST['CON_PARENT_ID'])){$v = '-1';}else{$v = FALSE;}?>
		                            	<?php html_list_navigation_Content(FALSE,FALSE,$v,$_SESSION['global_organization_id']); ?>
		                            	
		                            	<?php //html_list_navigation_Content(FALSE,FALSE,FALSE); ?>
		                            	<?php //html_list_Content_Types($id=FALSE,$values='class="form-control" id="template_video" name="template_video"'); ?>
		                            </div>
		                            
		                            <div class="col-xs-4">
		                            	Page Layout:<br />
		                            	<?php  html_list_Content_Layout('2',$_SESSION['global_organization_id']); ?>
		                            </div>		                            

		                            <div class="col-xs-12">
		                            	&nbsp;<!-- spacer -->
		                            </div>
		                            		                           
		                            
		                            <div class="col-xs-6">
		                            	Title:<br />
		                            	<input name="CON_TITLE" type="text" class="form-control" value="<?php echo $_SESSION['CON_TITLE']; ?>" />
		                            </div>
		
		                            <div class="col-xs-6">
		                            	Alias: (if blank, Title will be used)<br />
		                            	<input name="CON_ALIAS" type="text" class="form-control" value="" />
		                            </div>
		                            
		                                
		                            <div class="col-xs-12">
		                                &nbsp;<!-- spacer -->
		                            </div>
									
									<?php if(isset($_POST['CON_PARENT_ID'])){ ?>
									<div class="col-xs-12">
		                            	Preview Content:<br />
		                            	<textarea name="CON_PREVIEW" rows="5" cols="100%"><?php echo $_SESSION['CON_PREVIEW']; ?></textarea>
		                            </div>
		                            
		                            <div class="col-xs-12">
		                            	&nbsp;<!-- spacer -->
		                            </div>
		                            <?php } ?>
		                            		                                                            
		                            <div class="col-xs-12">
		                            	Page Content:
		                                <!--<textarea id="txtarea" class="add_tinymce" data-required="true"></textarea>-->
		                                <textarea id="txtarea" name="CON_CONTENT" rows="5" data-required="true" class="mceEditor"></textarea>
		                            </div>
		                            
		                            <div class="col-xs-12">
		                            	&nbsp;<!-- spacer -->
		                            </div>
		                                
		                          	<div class="col-xs-4">
										<input name="create" type="submit" class="btn btn-success btn-outline" value="Create">
										<input name="CONTENT_TYPE_FK" type="hidden" value="1"> 
										<input name="CON_ACCESS_TO" type="hidden" value="">            
		                          	</div>
		        				
		                        </div>
		                        
		                        <div class="col-xs-4">
		                        	
									<div role="tabpanel">
									
									  <!-- Nav tabs -->
									  <ul class="nav nav-tabs" role="tablist">
									    <li role="presentation" class="active"><a href="#access_to" aria-controls="settings" role="tab" data-toggle="tab">Access</a></li>
									    <li role="presentation"><a href="#templates" aria-controls="settings" role="tab" data-toggle="tab">Templates</a></li>
									    <li role="presentation"><a href="#seo" aria-controls="settings" role="tab" data-toggle="tab">SEO</a></li>
									    <li role="presentation"><a href="#social" aria-controls="settings" role="tab" data-toggle="tab">Social</a></li>
									  </ul>
									
									  <!-- Tab panes -->
									  <div class="tab-content">
									  	
									  	<div role="tabpanel" class="tab-pane active" id="access_to">
									    <br />
									    <?php 
											$array_omit = array("1","2","3");
											html_checkbox_User_Levels(FALSE,FALSE,'CON_ACCESS_TO[]',$array_omit); ?>	
									    </div>
									    
									    
									    <div role="tabpanel" class="tab-pane" id="templates">
									    	<br />
									    	Before Content:<br />
									    	<?php html_list_Content_Templates(FALSE,$_SESSION['global_organization_id'],'CONTENT_TEMPLATE_FK_BEFORE','class=form-control'); // $id, $organization_id, $select_name_value, $values ?>
									    	<br />
									    	After Content:<br />
									    	<?php html_list_Content_Templates(FALSE,$_SESSION['global_organization_id'],'CONTENT_TEMPLATE_FK_AFTER','class=form-control'); // $id, $organization_id, $select_name_value, $values ?>
									    	
									    </div>

									    <div role="tabpanel" class="tab-pane" id="seo">
									    	Title:<br />
									        <input name="CON_META_TITLE" type="text" class="form-control" value="<?php echo $_SESSION['CON_META_TITLE']; ?>" />
									        <br />
									    	Tags:<br />
									        <input name="CON_META_TAGS" type="text" class="form-control" value="<?php echo $_SESSION['CON_META_TAGS']; ?>" />
									        <br />
									        Description:<br />
									        <textarea name="CON_META_DESCRIPTION" rows="6" class="form-control"><?php echo $_SESSION['CON_META_DESCRIPTION']; ?></textarea>
									    </div>
									    
									    <div role="tabpanel" class="tab-pane" id="social">
									    	
									    </div>
									    
									  </div>
									
									</div>
		                            
		                        </div>                         
		                            
		                        </form><!-- /form -->
                                                    	

                            </div><!-- /row -->
                        </div><!-- /container -->

                </div><!-- /main-section -->

            </div><!-- /light-section -->

		<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
		<script>tinyMCE.init({
		        mode : "specific_textareas",
		        editor_selector : "mceEditor"
		});</script>

<?php
/*****************************************************************/
include('../templates/admin_footer.php');
?>