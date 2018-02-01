<?php
/* STUFF.VIEW */
/*****************************************************************/
include('../templates/admin_header.php');
include('controller.php');
?>
<?php include('../templates/admin_nav.php'); ?>

<div id="page-wrapper">
      
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo SITE_DISPLAY_NAME; ?> Stuff</h1>
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
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <form name="manager" action="crud_create.php" method="post">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Year</th>
                                    <th>Model</th>
                                    <th>Category</th>
									<th>Status</th>
                                    <th><input name="crud_create" type="submit" class="btn btn-success btn-xs btn-outline" value="Add"></th>
                                </tr>
                            </thead>
                            </form>
                            <tbody>
                            <?php while ($row = $_SESSION['FETCH_ARRAY']($records_all)){ ?>
								<?php $display_model = read_values_Models($row['MODEL_FK'],$site_fk=FALSE); ?>
								<?php $display_category = read_values_Categories($row['CATEGORY_FK'],$site_fk=FALSE); ?>
                              <tr>
                                <td><?php echo $row['TITLE']; ?></td>
                                <td><?php echo $row['YEAR_START_DK'].' '.$row['YEAR_END_DK']; ?></td>
                                <td><?php echo $display_model['model'];  ?></td>                                           
                                <td><?php echo $display_category['name']; ?></td>
								<td><?php echo $row['STATUS']; ?></td>
                                <td>
                                <form name="manage" action="crud_update.php" method="post">
                                    <input name="crud_update" type="submit" class="btn btn-info btn-xs btn-outline" value="Update">
                                    <?php if($records_all_num_rows != 1 and $row['STUFF_ID'] != 1) { ?>
                                    <button name="delete" class="btn btn-danger btn-xs btn-outline" onClick="return confirm('Are you sure you want to delete')">Delete</button>
                                    <?php } ?>
                                    <input name="STUFF_ID" type="hidden" value="<?php echo $row['STUFF_ID']; ?>" />
                                </form>
                                </td>
                              </tr>
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