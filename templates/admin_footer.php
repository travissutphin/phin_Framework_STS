    </div>
    <!-- /#wrapper -->
    
    
    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/jquery-1.10.2.js"></script>
    <script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/bootstrap.min.js"></script>
    <script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/sb-admin.js"></script>

    <!-- Page-Level Plugin Scripts - Tables -->
    <script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/plugins/dataTables/dataTables.bootstrap.js"></script>
	<script src="<?php echo site_Url(); ?>assets/sb-admin-v2/js/plugins/multiselect/bootstrap-multiselect.js"></script>

    <!-- Tables -->
    <script>
    $(d
	ocument).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

	<script type="text/javascript">
      $(document).ready(function() {
        $('.multiselect').multiselect();
      });
    </script>

    <footer>
    	<p>Footer data <?php echo date('Y'); ?></p>
	</footer>

</body>

</html>