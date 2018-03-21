<?php
/* CLUBS.VIEW */
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
			  <h1>Clubs</h1>
			</section>

			<!-- Main content -->
			<section class="content">
					
			  <!-- Default box -->
			  <div class="box">
				
				<?php echo messages($message); ?>
				
				<div class="box-body">
					
				<table id="example1" class="table table-bordered table-striped table-responsive">

                            <form name="manager" action="crud_create.php" method="post">
                            <thead>
                                <tr>
                                    <th>Title</th>
									<th>Address</th>
									<th>Dates</th>
									<th>Time</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            </form>
                            <tbody>
                            <?php while ($row = $_SESSION['FETCH_ARRAY']($records_all)){ ?>
                              <tr>
                                <td><?php echo $row['TITLE']; ?></td>
								<td><?php echo $row['ADDRESS'].' '.$row['CITY'].' '.$row['STATE'].' '.$row['ZIP']; ?></td>
								<td><?php echo $row['DATE_FROM'].' '.$row['DATE_TO']; ?></td>
								<td><?php echo $row['TIME_START'].' '.$row['TIME_END']; ?></td>
                                <td>
                                <form name="manage" action="crud_update.php" method="post">
                                    <input name="crud_update" type="submit" class="btn btn-info btn-xs btn-outline" value="Update">
                                    <button name="delete" class="btn btn-danger btn-xs btn-outline pull-right" onClick="return confirm('Are you sure you want to delete')">Delete</button>
                                    <input name="CLUB_ID" type="hidden" value="<?php echo $row['CLUB_ID']; ?>" />
                                </form>
                                </td>
                              </tr>
                            <?php } ?>
                            </tbody>
                        </table>					
					
				  
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
				  
				</div>
				<!-- /.box-footer-->
			  </div>
			  <!-- /.box -->

			</section>
			<!-- /.content -->
		  </div>
		  <!-- /.content-wrapper -->   
    
<?php
/*****************************************************************/
include('../templates/admin_footer.php');
?>