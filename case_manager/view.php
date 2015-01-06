<?php
/* .VIEW */
/*****************************************************************/
include('../templates/header.php');
include('controller.php');
$activate_table_filter = TRUE;
?>

<div class="widget stacked widget-table action-table">

	<div class="container-fluid" id="container">
    				
        <div class="span12" id="content">
         
            <div class="row-fluid">
            
                <div class="widget-header">
                    <i class="icon-th-list"></i>
                    <h3>PAGE NAME</h3>
                    <input type="search" id="search" value="" class="form-control" placeholder="Filter Table">
                    <?php echo $message; ?>
                </div> <!-- /widget-header -->
                
                <table class="table table-striped table-bordered" id="activate_table_filter">
                    <form name="manager" action="crud_create.php" method="post">
                    <thead>
                        <tr>
                            <th>COLUMN</th>
                            <th><input name="crud_update" type="submit" class="btn btn-mini btn-success" value="Add"></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    </form>
                    <tbody>
                       <?php while ($row = $_SESSION['FETCH_ARRAY']($records_all)){ ?> 
                        <form name="manage" action="crud_update.php" method="post">
                        <tr>
                            <td>VALUE</td>
                            <td><button name="crud_update" class="btn btn-mini btn-info" type="button">Update</button></td>
                            <td><button name="delete" class="btn btn-mini btn-danger" type="button" onClick="return confirm('Are you sure you want to delete')">Delete</button></td>
                        </tr>
                        <input name="ID" type="hidden" value="<?php echo trim($row['ID']); ?>" />
                        </form>
                        <?php } ?>
                    </tbody>
                </table>
            
            </div> <!-- //row-fluid -->
             
        </div> <!-- //container-fluid -->
    
    </div> <!-- //container-fluid --> 
        
</div> <!-- widget stacked widget-table action-table -->

<?php
/*****************************************************************/
include('../templates/footer.php');
?>