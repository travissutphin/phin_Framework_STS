<?php 
include('_system/config.php'); 
include('templates/controller.php');
/* root.INDEX */
/*****************************************************************/
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Fixed top navbar example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo site_Url(); ?>assets/bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Fixed navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
		<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Classifieds</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
				<a class="dropdown-item" href="<?php echo site_Url(); ?>Classifieds">All Classifieds</a>
				<?php
				// DES : DROPDOWN TO DISPLAY ALL CATEGORIES
				// REF : Q102
				// FILE : controller.php
				while ( $row = $_SESSION['FETCH_ARRAY']( $display_categories ) ) { 
				
					echo '<a class="dropdown-item" href=" '.site_Url().''.$row["NAME"].' ">'.$row["NAME"].'</a>' ;
					
				}
				?>
            </div>
        </li>
		<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?php echo site_Url(); ?>Local-Events">View Events</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>List-Local-Event">List Your Event</a>
            </div>
          </li>
		<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Auctions</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?php echo site_Url(); ?>">Schedule</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>">How to List</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>">How to Bid</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>">FAQ</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>">About Auction C.</a>
            </div>
        </li>
		<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clubs</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?php echo site_Url(); ?>Local-Clubs">Local Clubs</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>List-Local-Club">List Your Club</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>">Find by State</a>
            </div>
        </li>
		<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trails</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?php echo site_Url(); ?>Local-Trails">Local Trails</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>List-Local-Trail">List Your Trails</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>">Find by State</a>
            </div>
        </li>
		<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Photo Contest</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?php echo site_Url(); ?>">Details</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>">Submit Photo</a>
			  <a class="dropdown-item" href="<?php echo site_Url(); ?>">Gallery</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_Url(); ?>Partners">Partners</a>
          </li>		  
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_Url(); ?>Contact-Us">Contact Us</a>
          </li>			  
		  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?php echo site_Url(); ?>login">Login</a>
              <a class="dropdown-item" href="<?php echo site_Url(); ?>login/view.php?display_form_register"">Register</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
	
<br /><br /><br />

	<?php
			
			if ( $_SESSION['NUM_ROWS']($alias_stuff) == 1 ) {
			// DES : FOR CLASSIFIEDS DETAIL PAGE
			// REF : Q103 IN CONTROLLER.PHP
			// FILE : controller.php
				$classifieds = TRUE;
				$column_one_css = 'col col-lg-2' ;
				$column_two_css = 'col col-lg-10' ;
				$column_one_template = 'navigation_side.php' ;
				$column_two_template = 'template-classifieds.php' ;
			
				include( 'templates/layout_two_columns.php' ) ;
				
			}elseif ( isset ( $category_stuff['category_id'] ) and $category_stuff['category_id'] > 0 ) {
			// DES : FOR CLASSIFIEDS CATEGORY PAGE TO VIEW ALL IN A SPECIFIC CATEGORY				
			// REF : Q104-1 AND Q104-2 
			// FILE : controller.php
				$classifieds = TRUE;
				$column_one_css = 'col col-lg-2' ;
				$column_two_css = 'col col-lg-10' ;
				$column_one_template = 'navigation_side.php' ;
				$column_two_template = 'template-classifieds.php' ;
			
				include( 'templates/layout_two_columns.php' ) ;			
			
			}else{
			// DES : FOR ALL OTHER PAGES INCLUDING SHOWING ALL CLASSIFIEDS LIST (NO FILTERING)
			// REF : Q105
			// FILE : controller.php
				$column_one_css = 'col col-lg-2' ;
				$column_two_css = 'col col-lg-10' ;
				$column_one_template = 'navigation_side.php' ;
				$column_two_template = $values_templates['ct_template'] ;
				
				include( 'templates/'.$values_layouts['cl_layout'] ) ;
			}
	?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="<?php echo site_Url(); ?>assets/bootstrap-4.0.0/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="<?php echo site_Url(); ?>assets/bootstrap-4.0.0/assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo site_Url(); ?>assets/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>

 