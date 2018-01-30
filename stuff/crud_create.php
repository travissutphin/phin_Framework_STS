<?php
/* STUFF.CRUD_CREATE */
/*****************************************************************/
include('../templates/admin_header.php');
include('controller.php');
?>

<?php include('../templates/admin_nav.php'); ?>
<div id="page-wrapper">
      
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create <?php echo SITE_DISPLAY_NAME; ?> Stuff</h1>
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

                        <form name="manage" action="<?php echo current_page_Url(); ?>" method="post" role="form">                    
                            
                            <div class="col-xs-4">
                            	Title:<br />
                            	<input name="TITLE" type="text" class="form-control" value="" />
                            </div>
                            
                            <div class="col-xs-4">
                            	Year Start:<br />
                            	<?php html_list_Years_to_Present_HTML_Select_Lists($field_name="YEAR_START_DK",$value=FALSE,$class='form-control'); ?>
                            </div>

                            <div class="col-xs-4">
                            	Year End:<br />
                            	<?php html_list_Years_to_Present_HTML_Select_Lists($field_name='YEAR_END_DK',$value=FALSE,$class='form-control'); ?>
                            </div>
                            
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
                            
                            <div class="col-xs-4">
                            	Model:<br />
                            	<?php html_list_Models($id=FALSE,$site_fk=FALSE, $field_name='MODEL_FK', $class='form-control'); ?>
                            </div>
                            
                            <div class="col-xs-4">
                            	Category:<br />
                            	<?php html_list_Categories($id=FALSE,$site_fk=FALSE,$field_name='CATEGORY_FK',$class='form-control'); ?>
                            </div>
                            
							<div class="col-xs-4">
                            	Status:<br />
                            	<?php html_list_Status_HTML_Select_Lists($field_name='STATUS',$value=FALSE,$class='form-control') ?>
                            </div>
							
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>

                            <div class="col-xs-4">
                            	Image:
								<input type="file" />
                            </div>
							
							<div class="col-xs-8">
                            	Description:
								<textarea name="DESCRIPTION_LONG" class="form-control" rows=8"></textarea>
                            </div>
	
                            <div class="col-xs-12">
                            	&nbsp;
                            </div>
							
                          	<div class="col-xs-4">
								<input name="create" class="btn btn-success btn-outline" type="submit" value="create"> 
                          		<input name="cancel" class="btn btn-danger btn-outline" type="submit" value="cancel">              
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