<?php
/* TEMPLATES.ERROR */
/*****************************************************************/
include('admin_header.php');
?>

<div class="container">
    <div class="row">
      
      <div class="col-xs-12 col-md-12">
        <div class="alert alert-danger" role="alert">
            <h3><?php echo $_SESSION['error_message_for_admin']; ?></h3>
        </div>
      </div>
      
      <div class="col-xs-12 col-md-12">
	      <div class="alert alert-info alert-block">
    	      Please provide the information below to the administrator for further troubleshooting.
          </div>
      </div>
      
      <div class="col-xs-12 col-md-12">
          <div class="alert alert-warning" role="alert">
              <h5>SQL Server Error Message</h5>
              <?php echo $_SESSION['error']; ?>
          </div>      
      </div>
      
      <div class="col-xs-12 col-md-12">
          <div class="alert alert-warning" role="alert">
              <h5>SQL Query</h5>
              <?php echo $_SESSION['error_sql']; ?>
          </div>      
      </div>

      <div class="col-xs-12 col-md-12">
          <div class="alert alert-warning" role="alert">
             <h5>Post Variables</h5>
                <?php
					foreach ($_SESSION['error_post_vars'] as $key => $value)
    				{
						echo $key.' : '.$value.'<br />';
					}
				?>
          </div>      
      </div>

      <div class="col-xs-12 col-md-12">
		<div class="alert alert-warning" role="alert">
			<h5>Get Variables</h5>
                <?php
					if(isset($_SESSION['error_get_vars']))
					{
						foreach ($_SESSION['error_get_vars'] as $key => $value)
						{
							echo $key.' : '.$value.'<br />';
						}
					}
				?>             
          </div>      
      </div>

	<div class="col-xs-12 col-md-12">
    	<div class="alert alert-warning" role="alert">
			<h5>Session Variables</h5>
            <?php print_r($_SESSION['error_session_vars']);?>             
        </div>      
	</div>
      
      
    </div>
</div>


<?php
// clear variables
$_SESSION['error'] = ''; 
$_SESSION['error_sql'] = ''; 
$_SESSION['error_message_for_admin'] = '';
$_SESSION['error_post_vars'] = ''; 
$_SESSION['error_get_vars'] = ''; 
$_SESSION['error_session_vars'] = ''; 
?>

<?php include('admin_footer.php'); ?>