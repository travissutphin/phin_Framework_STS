<?php/* MEMBERS.VIEW *//*****************************************************************/include('../templates/admin_header.php');include('controller.php');/**  * @desc	all body content would go inside here  * @param	  * @return */?>		<?php include('../templates/admin_nav.php'); ?>		 <!-- Content Wrapper. Contains page content -->		  <div class="content-wrapper">			<!-- Content Header (Page header) -->			<section class="content-header">				<h1 class="page-header">Content</h1>			</section>			<!-- Main content -->			<section class="content">								  <!-- Default box -->			  <div class="box">								<?php echo messages($message); ?>								<div class="box-body">								         <table class="table" id="example1">                            <thead>                                <tr>                                    <th width="125px">Ordering</th>                                    <th>Title</th>                                    <th>Alias</th>                                    <th>Navigation</th>                                    <th>									</th>                                </tr>                            </thead>                            <tbody>                            <?php while ($row = $_SESSION['FETCH_ARRAY']($records_all)){ ?>                                                    <tr class="alert alert-secondary">                                <td>                                	<?php if($row['CON_PARENT_ID'] != "0"){ ?>                                	<form name="manage" action="view.php" method="post">                                	<input name="update_sequence" size="5px" type="text" value="<?php echo $row['CON_SEQUENCE']; ?>" onchange="this.form.submit()" />                                	<input name="CONTENT_ID" type="hidden" value="<?php echo $row['CONTENT_ID']; ?>" />                                	</form>                                	<?php } ?>                                </td>                                <td><?php echo $row['CON_TITLE']; ?></td>                                <td><?php echo $row['CON_ALIAS']; ?></td>                                <td>Main Nav</td>                                                                           <td>                                <form name="manage" action="crud_update.php" method="post">                                    <button name="crud_update" type="submit" id="nesto-submit" class="btn btn-info btn-xs btn-outline pull-left">	                                	<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Update	                                </button>                                    <button name="delete" class="btn btn-danger btn-xs btn-outline pull-right" onClick="return confirm('Are you sure you want to delete')">Delete</button>                                    <input name="CONTENT_ID" type="hidden" value="<?php echo $row['CONTENT_ID']; ?>" />                                </form>                                </td>                              </tr><?php // SUB NAVIGATION ?>	                            <?php $read_sub_nav = read_Content(FALSE,FALSE,$_SESSION['site_id'],$row['CONTENT_ID'],FALSE,'Yes',FALSE); // $id, $alias, $site_id, $con_parent_id, $num_rows, $sub_nav, $access ?>	                            <?php while ($row_sub_nav = $_SESSION['FETCH_ARRAY']($read_sub_nav)){ ?>                      	                              <tr class="alert">	                                <td align="right">	                                	<form name="manage" action="view.php" method="post">	                                	<input name="update_sequence" size="5px" type="text" value="<?php echo $row_sub_nav['CON_SEQUENCE']; ?>" onchange="this.form.submit()" />	                                	<input name="CONTENT_ID" type="hidden" value="<?php echo $row_sub_nav['CONTENT_ID']; ?>" />	                                	</form>	                                </td>	                                <td><?php echo $row_sub_nav['CON_TITLE']; ?></td>	                                <td><?php echo $row_sub_nav['CON_ALIAS']; ?></td>	                                <td>Sub Nav</td>                                           	                                <td>	                                <form name="manage" action="crud_update.php" method="post">                                    	<button name="crud_update" type="submit" id="nesto-submit" class="btn btn-info btn-xs btn-outline pull-left">	                                		<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Update	                                	</button>	                                    <button name="delete" class="btn btn-danger btn-xs btn-outline pull-right" onClick="return confirm('Are you sure you want to delete')">Delete</button>	                                    <input name="CONTENT_ID" type="hidden" value="<?php echo $row_sub_nav['CONTENT_ID']; ?>" />	                                </form>	                                </td>	                              </tr>	                            <?php } ?><?php // SUB NAVIGATION ?>                            <?php } ?>                            </tbody>                        </table>				  				</div>				<!-- /.box-body -->				<div class="box-footer">				  				</div>				<!-- /.box-footer-->			  </div>			  <!-- /.box -->			</section>			<!-- /.content -->		  </div>		  <!-- /.content-wrapper -->       <?php/*****************************************************************/include('../templates/admin_footer.php');?>
