<?php
################################################################################################################
function step1($msg_to_user="")
{
?>

<!-- step 1 -->
    <div class="container">
        <div class="well">
            <h1>phin FrameWork Installation</h1>
            <p></p>
            <legend>Step 1 - Web site details</legend>
            <form name="install" action="index.php" method="post">
                <?php if($msg_to_user != "") { ?>
                    <div class="alert alert-success">
                        <a class="close" data-dismiss="alert" href="#">x</a><?php echo $msg_to_user ?>
                    </div>
                <?php } ?>
                <?php echo $_SESSION['app_directory'] = str_replace('install/', "", $_SERVER["REQUEST_URI"]); ?>
                <div class="input-prepend">
                <span class="add-on">Base URL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input class="form-control" placeholder="" type="text" name="base_url" value="<?php echo $_SESSION['base_url'];?>"> 
                </div>
                <span class="help-inline">
                This should be the http address that leads you to the root of your Web App.<br />
                We have tried to guess based on this installation file ...
                </span>
                <hr />
                
                <div class="input-prepend">
                <span class="add-on">Database Name</span>
                    <input class="form-control" placeholder="" type="text" name="database" value="<?php echo $_SESSION['database'];?>"> 
                </div>
                <span class="help-inline"><strong>You have 2 options to create your database.</strong></span>
                <br />
                <span class="help-inline">1) Create a MySQL database in phpMyAdmin, MySQL WorkBench, Host Control Panel, etc.</span>
                <span class="help-inline">2) Populate the Database Name field above with the name you would like to create and it can be created for you.</span>
                <p></p>
                <input name="key" value="<?php $date=date('YmdHis'); echo $date.'@ci'; ?>" type="hidden">
                
                <p></p>
                <input name="step2" value="1" type="hidden">
                <button class="btn-success btn" type="submit"> Go to next step </button>
            </form>  
            <form name="install" action="index.php" method="post">
                <input name="reset" value="1" type="hidden">
                <button class="btn-danger btn pull-right" type="submit"> Start Over </button>
            </form>
        <br />
		</div>
	</div>
<!--/step 1 -->
<?php
}
?>

<?php
################################################################################################################
function step2($msg_to_user="")
{
?>
<!--- step 2 -->
	<div class="container">
        <div class="well">
            <h1>phin FrameWork Installation</h1>
            <p></p>

			<legend>Step 2 - Connect to your database</legend>
        	<?php if($msg_to_user != "") { ?>
            	<div class="alert alert-danger">
                	<a class="close" data-dismiss="alert" href="#">x</a><?php echo $msg_to_user; ?>
            	</div>
                <?php if(isset($_SESSION['create_db_option'])) { ?>
						<div class="alert alert-info">
							<a class="close" data-dismiss="alert" href="#">x</a>
							<p>
                            Would you like to create a database named <strong><?php echo $_SESSION['database'];?></strong> now?
                             <br /><br />
                             <form name="create_db" action="index.php" method="post">
								<input name="step2x1" value="1" type="hidden">
                             	<button type="submit" class="btn btn-primary"> Create database now </button>
                             </form>
                            </p>
						</div>
                <?php unset($_SESSION['create_db_option']); } ?>
        	<?php } ?>
            
            <form name="install" action="index.php" method="post">            
                <div class="input-prepend">
                <span class="add-on">Database Name</span>
                    <input class="form-control" placeholder="" type="text" name="database" value="<?php echo $_SESSION['database'];?>"> 
                </div><span class="help-inline">This is the MySQL database you created for this Web App.  It can be a blank database.</span>
                <p></p>
                
                <div class="input-prepend">
                <span class="add-on">User Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input class="form-control" placeholder="" type="text" name="user" value="<?php echo $_SESSION['user'];?>">
                </div><span class="help-inline">MySQL username</span>
                <p></p>
                
                <div class="input-prepend">
                <span class="add-on">Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input class="form-control" placeholder="" type="password" name="password">
                </div><span class="help-inline">MySQL password</span>
                <p></p>
                
                <div class="input-prepend">
                <span class="add-on">Host &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>           
                <input class="form-control" placeholder="" type="text" name="server" value="<?php echo $_SESSION['server'];?>">
                </div><span class="help-inline">MySQL host name.  This is either the IP address if you are connection remotely, or localhost if the MySQL server is on your local machine.</span>
                <p></p>
                
                <input name="step3" value="1" type="hidden">
                <button class="btn-success btn" type="submit"> Verify database connection </button>
            </form> 
             
            <form name="install" action="index.php" method="post">
                <input name="reset" value="1" type="hidden">
                <button class="btn-danger btn pull-right" type="submit"> Start Over </button>
            </form>
            
        	<br />       
        </div>
    </div>
<!--/step 2 -->
<?php 
}
?>

<?php
################################################################################################################
function step2x1($msg_to_user="")
{
?>
<!--- step 2_1 -->
        <div class="container">
            <div class="well">
                  <h1>phin FrameWork Installation</h1>
                  <p></p>

		<legend>Create a database</legend>
        	<?php if($msg_to_user != "") { ?>
            	<div class="alert alert-error">
                	<a class="close" data-dismiss="alert" href="#">x</a><?php echo $msg_to_user; ?>
            	</div>
        	<?php } ?>
        <p>Please check the values below</p>
		<form name="install" action="index.php" method="post">
            <div class="input-prepend">
            <span class="add-on">Database Name</span>
            	<input class="span4" placeholder="" type="text" name="database" value="<?php echo $_SESSION['database'];?>"> 
            </div>
            <p></p>
            
            <div class="input-prepend">
            <span class="add-on">User Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input class="span4" placeholder="" type="text" name="user" value="<?php echo $_SESSION['user'];?>">
            </div>
            <p></p>
            
            <div class="input-prepend">
            <span class="add-on">Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input class="span4" placeholder="" type="password" name="password">
            </div>
            <p></p>
            
            <div class="input-prepend">
            <span class="add-on">Host &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>           
            <input class="span4" placeholder="" type="text" name="server" value="<?php echo $_SESSION['server'];?>">
            </div>
            <p></p>
            <input name="step2" value="1" type="hidden">
            <input name="create" value="1" type="hidden">
            <button class="btn-success btn" type="submit"> Create database now </button>
        </form>    
        <form name="install" action="index.php" method="post">
	        <input name="reset" value="1" type="hidden">
        	<button class="btn-danger btn pull-right" type="submit"> Start Over </button>
        </form>
        <br />        
            </div>
    </div>
<!--/step 2_1 -->
<?php
}
?>

<?php
################################################################################################################
function step3($msg_to_user="")
{
?>
<!--- step 3 -->
        <div class="container">
            <div class="well">
                  <h1>phin FrameWork Installation</h1>
                  <p></p>

		<legend>Step 3 - Install Web App database</legend>
        <form name="install" action="index.php" method="post">
        	<?php if(isset($msg_to_user)) { ?>
            	<div class="alert alert-success">
                	<a class="close" data-dismiss="alert" href="#">x</a><?php echo $msg_to_user; ?>
            	</div>
        	<?php } ?>
            <p>You can add a prefix to the table names. (this is optional)</p>
			<input name="prefix" class="form-control" value="<?php echo $_SESSION['prefix'];?>" type="text">
            <br />
            <input name="step4" value="1" type="hidden">
            <button class="btn-success btn" type="submit"> Install Web App </button>
        </form>  
        <form name="install" action="index.php" method="post">
	        <input name="reset" value="1" type="hidden">
        	<button class="btn-danger btn pull-right" type="submit"> Start Over </button>
        </form>
        <br />        
            </div>
        </div>
<!--/step 3 -->
<?php 
}
?>

<?php
################################################################################################################
function step4($msg_to_user="")
{
?>
<!--- step 4 -->
        <div class="container">
            <div class="well">
                  <h1>phin FrameWork Installation</h1>
                  <p></p>

		<legend>Step 4 - Installation Progress</legend>
        <form name="complete" action="<?php echo get_base_url(); ?>" method="post">
        	<?php if(isset($msg_to_user)) { ?>
            	<div class="alert alert-success">
                	<a class="close" data-dismiss="alert" href="#">x</a><?php echo $msg_to_user ?>
            	</div>
        	<?php } ?>
            
            <?php create_db_tables();?>
            <br />
            <div class="progress progress-striped active">
              <div class="bar" style="width: 100%;"></div>
            </div>
            <br />
            <input name="username" value="admin" type="hidden">
            <input name="password" value="pswd" type="hidden">
            <button class="btn-success btn" type="submit"> Goto your phin FrameWork Login </button>
        </form>  
        <form name="install" action="index.php" method="post">
	        <input name="reset" value="1" type="hidden">
        	<button class="btn-danger btn pull-right" type="submit"> Start Over </button>
        </form>
        <br />        
            </div>
        </div>
<!--/step 4 -->
<script type="text/JavaScript">
<!--
setTimeout("location.href = '<?php echo get_base_url(); ?>';",7000);
-->
</script>
<?php
}
?>