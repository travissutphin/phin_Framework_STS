<?php
/* MY_PROFILE..VIEW */
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
      <h1>My Profile</h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xl-4 col-lg-5">

          <!-- Profile Image -->
          <div class="box">
            <div class="box-body box-profile">
              <img class="profile-user-img rounded-circle img-fluid mx-auto d-block" src="../../../images/5.jpg" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $records_by_member['name_first'].' '.$records_by_member['name_last']; ?></h3>

              <p class="text-muted text-center"></p>
				
              <div class="row social-states">
				  <div class="col-6 text-right"><a href="#" class="link"><i class="ion ion-ios-people-outline"></i> </a></div>
				  <div class="col-6 text-left"><a href="#" class="link"><i class="ion ion-images"></i> </a></div>
			  </div>
            
              <div class="row">
              	<div class="col-12">
              		<div class="profile-user-info">
						<p>Email address </p>
						<h6 class="margin-bottom"><?php echo $records_by_member['email']; ?></h6>
						<p>cell</p>
						<h6 class="margin-bottom"><?php echo $records_by_member['cell'] ; ?></h6> 
						<p>Address</p>
						<h6 class="margin-bottom"><!--- address ---></h6>
						<!---
						<div class="map-box">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2805244.1745767146!2d-86.32675167439648!3d29.383165774894163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c1766591562abf%3A0xf72e13d35bc74ed0!2sFlorida%2C+USA!5e0!3m2!1sen!2sin!4v1501665415329" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
						--->
						<p class="margin-bottom">Social Profile</p>
						<div class="user-social-acount">
							
							<?php if ( $records_by_member['social_facebook'] != '' ) { ?>
								<a href= "<?php echo $records_by_member['social_facebook'] ; ?>" target="_blank"><button class="btn btn-circle btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></button></a>
							<?php } ?>
							
							<?php if ( $records_by_member['social_twitter'] != '' ) { ?>
								<a href= "<?php echo $records_by_member['social_twitter'] ; ?>" target="_blank"><button class="btn btn-circle btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></button></a>
							<?php } ?>
							
							<?php if ( $records_by_member['social_instagram'] != '' ) { ?>
								<a href= "<?php echo $records_by_member['social_instagram'] ; ?>" target="_blank"><button class="btn btn-circle btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></button></a>
							<?php } ?>
							
						</div>
					</div>
             	</div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-8 col-lg-7">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
			  <li><a href="#settings" data-toggle="tab" class="active">Settings</a></li>
              <li><a href="#timeline" data-toggle="tab">Some Info</a></li>
              <li><a href="#activity" data-toggle="tab">Some Details</a></li>
            </ul>
                        
            <div class="tab-content">
 
<!--- SETTINGS --->              

              <div class="active tab-pane" id="settings">
               <form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form" enctype="multipart/form-data">     
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input name="NAME_FIRST" type="text" class="form-control" id="inputName" placeholder="" value="<?php echo $records_by_member['name_first']; ?>">
                    </div>
                  </div>
                  
				  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input name="NAME_LAST" type="text" class="form-control" id="inputName" placeholder="" value="<?php echo $records_by_member['name_last']; ?>">
                    </div>
                  </div>
				  
				  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input name="EMAIL" type="email" class="form-control" id="inputEmail" placeholder="" readonly="readonly" value="<?php echo $records_by_member['email']; ?>">
					  <input name="x_HIDDEN_EMAIL" type="hidden" class="form-control" id="inputEmail" placeholder="" value="<?php echo $records_by_member['email']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 control-label">Cell</label>

                    <div class="col-sm-10">
						<input name="CELL" type="text" class="form-control" id="inputName" placeholder="" value="<?php echo $records_by_member['cell']; ?>" maxlength="10">
                    </div>
					
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 control-label">Cell Provider</label>

                    <div class="col-sm-10">
                      
                    </div>
                  </div>

				  <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 control-label">Facebook</label>

                    <div class="col-sm-10">
						<input name="SOCIAL_FACEBOOK" type="text" class="form-control" id="inputName" placeholder="" value="<?php echo $records_by_member['social_facebook']; ?>" >
                    </div>
					
                  </div>

				  <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 control-label">Twitter</label>

                    <div class="col-sm-10">
						<input name="SOCIAL_TWITTER" type="text" class="form-control" id="inputName" placeholder="" value="<?php echo $records_by_member['social_twitter']; ?>" >
                    </div>
					
                  </div>


				  <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 control-label">Instagram</label>

                    <div class="col-sm-10">
						<input name="SOCIAL_INSTAGRAM" type="text" class="form-control" id="inputName" placeholder="" value="<?php echo $records_by_member['social_instagram']; ?>" >
                    </div>
					
                  </div>

				  

                  <div class="form-group row">
                    

                    <div class="col-sm-10">
                      
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="ml-auto col-sm-10">
                      <div class="checkbox">
                       	<input type="checkbox" id="basic_checkbox_1" checked="">
						<label for="basic_checkbox_1"> I agree to the</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Terms and Conditions</a>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="ml-auto col-sm-10">
                      <button name="update" class="btn btn-success btn-outline"> Save </button>
					  <input name="MEMBER_ID" type="hidden" value="<?php echo $records_by_member['member_id']; ?>" />  
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

 <!--- TIMELINE --->
 
			<div class="tab-pane" id="timeline">
 
            </div>    
            <!-- /.tab-pane -->
 
<!--- ACTIVITY ---> 

			<div class="tab-pane" id="activity">
						   
			</div>
			<!-- /.tab-pane -->


 </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
<?php
/*****************************************************************/
include('../templates/admin_footer.php');
?>