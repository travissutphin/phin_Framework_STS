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
      <h1>Private Messages</h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-lg-4 col-md-12">
			<div class="box">
				<div class="box-header with-border p-0 pt-10">
					<div class="form-element">
						<input class="form-control p-20" type="text" placeholder="Search Contact">
					</div>
				</div>
				<div class="box-body p-0">
				  <div class="media-list media-list-hover media-list-divided ">
<!--- SHOW MEMBER AVAIL TO MESSAGE --->				
					<?php while ($row = $_SESSION['FETCH_ARRAY']($records_members)){ ?>
						<?php if($row['MEMBER_ID'] != $_SESSION['members.id']){ ?>
						<div class="media media-single">
							<a href="#">
							<img class="avatar avatar-xl" src="" alt="...">
							</a>						
							<div class="media-body">
							<form name="member_select" action="view.php" method="post">
								<input name="member_select" type="submit" class="btn btn-info btn-xs btn-outline pull-right" value="Message">
								<input name="id" type="hidden" value="<?php echo $row['MEMBER_ID']; ?>" >
							</form>
							<h6><?php echo $row['NAME_FIRST'].' '.$row['NAME_LAST']; ?></h6>
							<?php $unread_messages = read_unread_Private_Messages($_SESSION['site_id'],$_SESSION['members.id'],$row['MEMBER_ID']); // session is the logged in member and $row is the recipient member ?>
							<?php if($unread_messages > 0){ ?>
							<small class="text-success"><?php echo $unread_messages; ?> New Message</small>
							<?php } ?>
							</div>					
						</div>
						<?php } //  if($row['MEMBER_ID'] != $_SESSION['members.id']){ ?>
					<?php } // while ($row = $_SESSION['FETCH_ARRAY']($records_members)){ ?>
											
				  </div>
				</div>
            </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-lg-8 col-md-12">
          <div class="box direct-chat">
            <div class="box-header with-border">
              <h3 class="box-title">Messages</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div id="chat-app" class="direct-chat-messages chat-app">

<!--- NO MEMBER SELECTED TO MESSAGE WITH --->
				<?php if(!isset($_SESSION['private_message_member_id'])) { ?>
					
					<h3>Select a Member to Message</h3>
					
				<?php }else{ ?>

<!--- GET BOTH MEMBERS INFO --->
					<?php $logged_in_member = read_values_Members($_SESSION['members.id']); ?>
					<?php $messaging_member = read_values_Members($_SESSION['private_message_member_id']); ?>
					
<!--- NO ACTIVE MESSAGES WITH MEMBER --->
				<?php if($_SESSION['NUM_ROWS']($records_private_messages_by_member) == 0) { ?>
				
					<div class="alert alert-info ">
						<strong>No active messages with <?php echo $messaging_member['name_first'].' '.$messaging_member['name_last']; ?>
					</div>
				
				<?php } ?>
					
<!--- SHOW PRIVATE MESSAFGES BETWEEN MEMBERS --->				
					<?php while ($row = $_SESSION['FETCH_ARRAY']($records_private_messages_by_member)){ ?>
					
	<!--- SHOW MESSAGES FROM LOGGED IN MEMBER --->					
						<?php if($row['MEMBER_FK'] == $_SESSION['members.id']) { ?>
						
						<div class="direct-chat-msg mb-30">
							<div class="clearfix mb-15">
								<span class="direct-chat-name"><?php echo $logged_in_member['name_first'].' '.$logged_in_member['name_last']; ?></span>
								<span class="direct-chat-timestamp pull-right"><?php echo date('F d Y h:i:s A',strtotime($row['CREATED_AT'])); ?> </span>
							</div>
							<!-- /.direct-chat-info -->
							<img class="direct-chat-img avatar" src="" alt="">
							<!-- /.direct-chat-img -->
					  
							<div class="direct-chat-text">
								<?php echo $row['MESSAGE']; ?>
							</div>					
						<!-- /.direct-chat-text -->
						</div>
						<!-- /.direct-chat-msg -->
						
						<?php }else{ ?>
	<!--- SHOW MESSAGES FROM OTHER MEMBER --->						
							<!-- Message to the right -->
							<div class="direct-chat-msg right mb-30">
							  <div class="clearfix mb-15">
								<span class="direct-chat-name pull-right"><?php echo $messaging_member['name_first'].' '.$messaging_member['name_last']; ?></span>
								<span class="direct-chat-timestamp "><?php echo date('F d Y h:i:s A',strtotime($row['CREATED_AT'])); ?></span>
							  </div>
							  <!-- /.direct-chat-info -->
							  <img class="direct-chat-img avatar" src="" alt="">
							  <!-- /.direct-chat-img -->
							  <div class="direct-chat-text">
								<?php echo $row['MESSAGE']; ?>
							  </div>
							  <!-- /.direct-chat-text -->
							</div>
							<!-- /.direct-chat-msg -->
						
						<?php }  // if($row['MEMBER_FK'] == $_SESSION['members.id'])?>
						
					<?php } // while ($row = $_SESSION['FETCH_ARRAY']($records_private_messages_by_member)){ ?>
				
				<?php } // if(!isset($_SESSION['private_message_member_id'])) ?>
								  
              </div>
              <!--/.direct-chat-messages-->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <form action="#" method="post">
                <div class="input-group">
                  <input type="text" name="MESSAGE" maxlength="100" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                       <input name="create" class="btn btn-success btn-outline" type="submit" value="Send">  
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /. box -->
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