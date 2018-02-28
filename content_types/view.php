<?php
/* PAGE_TYPES.VIEW */
/*****************************************************************/
include('../templates/admin_header.php');
include('controller.php');
?>
<?php include('../templates/admin_nav.php'); ?>

<div id="page-wrapper">
      
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Page Types</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
      
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo messages($_REQUEST['message']); ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <form name="manager" action="crud_create.php" method="post">	
                    	<thead>
                      		<th>Type</th>
                      		<th><input name="crud_create" type="submit" class="btn btn-success btn-xs btn-outline" value="Add"></th>
                    	</thead>
                    	</form>
                    
                        <tbody>
							<?php while ($row = $_SESSION['FETCH_ARRAY']($records_all)){ ?>
                            <form name="manage" action="crud_update.php" method="post">
                            <tr>
                            	<td><?php echo $row['TYPE']; ?></td>                                    
                            	<td>
                              	<button name="crud_update" class="btn btn-info btn-xs btn-outline">Update</button>
                            	<button name="delete" class="btn btn-danger btn-xs btn-outline" onClick="return confirm('Are you sure you want to delete')">Delete</button>
                            	<input name="PAGE_TYPE_ID" type="hidden" value="<?php echo $row['PAGE_TYPE_ID']; ?>" />
                            	</td>
                            </tr>
                            </form>
                            <?php } ?>
                        </tbody>
                    </table>
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
include('../templates/admin_footer.php');
?>