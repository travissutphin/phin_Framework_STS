<?php
	
	$display_stuff = read_Stuff($id=FALSE,$_SESSION['site_id'],$member_fk=FALSE,$category_fk=FALSE,$year_start_dk=FALSE,$year_end_dk=FALSE,$status_dk=FALSE)
	
?>

<?php if ( isset ( $_REQUEST['details'] ) ) { ?>

	test <?php echo $_REQUEST['details']; ?>

<?php }else{ ?>

<div class="col-12 col-md-9">

          <div class="row">
			
			<?php while ($row = $_SESSION['FETCH_ARRAY']($display_stuff)){ ?>
            
			<div class="col-6 col-lg-4">
			
              <h2><?php echo $row['TITLE']; ?></h2>
              <p><?php echo '<img src='.site_Url().'upload_repository/'.$row['PRIMARY_IMAGE'].' width="100px" class="pull-right">' ; ?></p><p><?php echo $row['DESCRIPTION_LONG']; ?></p>
              <p><a class="btn btn-secondary" href="<?php echo site_Url(); ?>Classifieds?details=10" role="button">View details &raquo;</a></p>
            </div><!--/span-->
			
			<?php } ?>
			
          </div><!--/row-->
		  
        </div><!--/span-->
		
</div>

<?php } ?>