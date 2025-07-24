<!--<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> 1.1.0
    </div>
  <strong>Designed and Developed By <a href="http://whitefoxg.com" target="_blank">WhiteFox Global Solutions</a>.</strong>Copyright © 2018 <?php //echo $comp_name;?> All rights reserved. CONTACT NO. : 9033314227 (Vaibhav Joshi)
    
</footer>-->

<!-- Data Tables -->

	
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="dist/js/jspdf.min.js"></script>
<script src="dist/js/validator.js"></script>
<script src="Math.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>


<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
<script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>
<script src="bower_components/sum().js"></script>



<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>


<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datetimepicker.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- CK Editor -->
<script src="bower_components/ckeditor/ckeditor.js"></script>

<script src="plugins/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="plugins/sweetalert/sweetalert.css">
<script src="bower_components/jquery-confirm.min.js"></script>

	


</body>
</html>
<script>
$(".job_menu").find("a").removeClass("active");

var current = window.location.pathname;
$(".job_menu a").filter(function () {
  var link = $(this).attr("href");
  if (link) {
    if (current.indexOf(link) != -1) {
      $(this).children("a").addClass("active");
      $(this).addClass("active");
      return false;
    }
  }
});

setInterval(function(){ 

	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>send_messages.php',
        data: 'action_type=send_msg',
		success: function(msg,status, xhr){
		
        }
    });
}, 15000);
</script>