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
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo site_Url(); ?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_Url(); ?>About-Us">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_Url(); ?>Classifieds">Classifieds</a>
          </li>
		  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?php echo site_Url(); ?>login">Login</a>
              <a class="dropdown-item" href="<?php echo site_Url(); ?>login/view.php?display_form_register"">Register</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
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
			$alias_stuff = read_Stuff($id=FALSE,$_SESSION['site_id'],$member_fk=FALSE,$category_fk=FALSE,$year_start_dk=FALSE,$year_end_dk=FALSE,$status_dk=FALSE,'dirt-jeep-dirt-edition-2018-03-20');
			
			// FOR CLASSIFIEDS DETAIL PAGE
			if ( $_SESSION['NUM_ROWS']($alias_stuff) == '1' ) {
				
				$column_one_css = 'col col-lg-2' ;
				$column_two_css = 'col col-lg-10' ;
				$column_one_template = 'navigation_side.php' ;
				$column_two_template = 'template-classifieds' ;
			
				include( 'templates/layout_two_columns.php' ) ;
				
			}else{
			
				$values_content = read_values_Content ( FALSE,$_REQUEST['alias'],FALSE ) ; // $id, $alias, $content_parent_id
				$values_layouts = read_values_Content_Layouts ( $values_content['con_layout_fk'],$_SESSION['site_id'] ) ; // $id, $site_id
				$values_templates = read_values_Content_Templates( $values_content['content_template_fk_before'],$_SESSION['site_id'] ) ; //$id, site_id
				
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

 