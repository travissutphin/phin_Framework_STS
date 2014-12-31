<?php
/* .CRUD_CREATE */
/*****************************************************************/
include('../templates/header.php');
include('controller.php');
$activate_form_validation = TRUE;
?>
<div class="widget stacked widget-table action-table">

	<div class="container-fluid" id="container">
		
		<?php echo messages($message); ?>
        
        <form name="manage" action="crud_create.php" method="post"> 
            
        <fieldset>  
        
            <legend>Form Heading</legend>
            
            <!-- [s row] -->
            <div class="span12" id="content">
            
                <div class="span3" id="content">
                    <div class="controls">
                        Field Name: <br />
                        <span id="validation_numbers_and_dashes_01">
                            <input name="Field Value" type="text" class="span10" placeholder="" value="<?php echo $_SESSION['Field_Value']; ?>" />
                            <br />
                            <span class="textfieldRequiredMsg">A value is required.</span>
                            <span class="textfieldInvalidFormatMsg">Invalid format.</span>
                        </span>
                  </div>
                </div>
                
                <div class="span3" id="content">
                    <div class="controls">
                        Field Name: <br />
                        <span id="validation_date_01">
                        	<input name="Field Name" type="text" class="span10" placeholder="yyyy-mm-dd" value="<?php echo $_SESSION['Field_Value']; ?>">
                        	<br />
                            <span class="textfieldRequiredMsg">A value is required.</span>
                            <span class="textfieldInvalidFormatMsg">Invalid format. (yyyy-mm-dd)</span>
                        </span>                        
                    </div>
                </div>
                
                <div class="span2" id="content">
                    <div class="controls">
                        Field Name: <br /> <?php echo html_list_X_Select_Lists('Field_Name','',$class='span8'); ?>
                    </div>
                </div>
                
                <div class="span2" id="content">
                    <div class="controls">
                        Field_Name: <br /> <input name="Field_Name" type="text" class="span5" placeholder="" value="<?php echo $_SESSION['Field_Value']; ?>">
                    </div>
                </div>
                
            </div>
        
            	<div class="span12" id="content">
                <!-- spacer -->
                
            </div>                    
            <!-- [e row] -->
                              
            <legend> </legend> 
                                                            
            <!-- [s row] -->
            <div class="span12" id="content">
                <button name="cancel" class="btn" onClick="return confirm('Are you sure you want to clear this form?')"> Cancel </button>
                <button name="create" class="btn btn-success"> Add </button>
            </div>
            <!-- [e row] -->       
                                            
        </fieldset> 
        
        </form>
                
    </div> <!-- //container-fluid --> 
        
</div> <!-- widget stacked widget-table action-table -->

<?php
/*****************************************************************/
include('../templates/footer.php');
?>