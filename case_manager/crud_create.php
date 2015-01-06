<?php
/* .CRUD_CREATE */
/*****************************************************************/
include('../templates/admin_header.php');
include('controller.php');

?>
<?php include('../templates/admin_nav.php'); ?>
<div id="page-wrapper">
      
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">TITLE</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
      
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo messages($message); ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
   
                <fieldset>  
        
					<legend></legend>
                        
                        <form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form" >                    
                            
                            <div class="col-xs-4">
                            First Name:<br />
                            <input name="NAME_FIRST" type="text" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-4">
                            Last Name:<br />
                            <input name="NAME_LAST" type="text" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-12">
                            &nbsp;
                            </div>
                            
                            <div class="col-xs-4">
                            Email:<br />
                            <input name="EMAIL" type="email" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-4">
                            	Password:<br />
                            	<input name="PASSWORD" type="password" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                            <div class="col-xs-4">
                            Role:<br />
                            <?php html_list_Roles('',"class='form-control'"); ?>
                          	</div>
                            
                          	<div class="col-xs-8">
                          		&nbsp;
                          	</div>

                          	<div class="col-xs-4">
                          		<button name="cancel" class="btn btn-danger btn-outline"> Cancel </button>
                          		<button name="update" class="btn btn-success btn-outline"> Save </button>
                          		<input name="USER_ID" type="hidden" value="<?php echo $row['ID']; ?>" />               
                          	</div>
                        </form>
                                        
                </fieldset> 
        
                    </div>
                    <!-- /.table-responsive -->
                   
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
            
</div>

<?php
/*****************************************************************/
include('../templates/admin_footer.php');
?>