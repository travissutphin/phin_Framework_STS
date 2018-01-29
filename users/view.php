<?php
/* USERS.VIEW */
/*****************************************************************/
include('../templates/admin_header.php');
include('controller.php');
?>
<?php include('../templates/admin_nav.php'); ?>

<div id="page-wrapper">
      
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users</h1>
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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th><input name="crud_create" type="submit" class="btn btn-success btn-xs btn-outline" value="Add"></th>
                                </tr>
                            </thead>
                            </form>
                            <tbody>
                            <?php while ($row = $_SESSION['FETCH_ARRAY']($records_all)){ ?>                      
                              <tr>
                                <td><?php echo $row['NAME_FIRST']; ?></td>
                                <td><?php echo $row['NAME_LAST']; ?></td>
                                <td><?php echo $row['EMAIL']; ?></td>                                           
                                <td><?php echo $row['ROLE_NAME']; ?></td>
                                <td>
                                <form name="manage" action="crud_update.php" method="post">
                                    <input name="crud_update" type="submit" class="btn btn-info btn-xs btn-outline" value="Update">
                                    <?php if($records_all_num_rows != 1 and $row['USER_ID'] != 1) { ?>
                                    <button name="delete" class="btn btn-danger btn-xs btn-outline" onClick="return confirm('Are you sure you want to delete')">Delete</button>
                                    <?php } ?>
                                    <input name="USER_ID" type="hidden" value="<?php echo $row['USER_ID']; ?>" />
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