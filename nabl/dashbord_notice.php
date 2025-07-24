

<?php 
	 session_start();
	 include 'connection.php';
	 if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php $base_url; ?>index.php";
	</script>
	<?php
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $comp_name; ?> </title>		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.7 -->
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Bootstrap 3.3.7 -->
		<!-- <link rel="stylesheet" href="bower_components/buttons/bootstrap.min.css">-->
		<!-- Bootstrap 3.3.7 -->
		<!--<link rel="stylesheet" href="bower_components/buttons/dataTables.bootstrap.min.css">-->
		<!-- Bootstrap 3.3.7 -->
		<!--<link rel="stylesheet" href="bower_components/buttons/buttons.bootstrap.min.css">-->
		<!-- Font Awesome -->
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->




		<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
		<!-- Theme style --> 
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		
		<link rel="stylesheet" href="bower_components/morris.js/morris.css">
		<!-- jvectormap -->
		<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
		<!-- Date Picker -->
		<!-- Daterange picker -->
		<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/bootstrap-datetimepicker.css">
		<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
		<!-- bootstrap datepicker -->
		<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		<!-- iCheck for checkboxes and radio inputs -->
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">		<!-- bootstrap wysihtml5 - text editor -->
		<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.0.3/jquery-confirm.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<style>
			.table-striped>tbody>tr:nth-of-type(odd){
				background-color:#003366;
			}
			.jconfirm-title, .jconfirm-content{
				color:#333;
			}
			.table-condensed>tbody>tr>td,.datepicker .datepicker-switch,.table-condensed>thead>tr>th{
				color:black;
			}
			div.dataTables_wrapper div.dataTables_filter input{
				width:300px;
				margin-top:-1px;
				border-radius: 7px;
			}
			div.dataTables_wrapper div.dataTables_filter label{
				    font-size: 20px;
					margin-top: 15px;
			}
			button.dt-button, div.dt-button, a.dt-button{
				margin-top:20px;
				margin-left:20px;
				width: 100px;
				border-radius: 7px;
			}
		</style>
	</head>
	<body style="background-color:#003366; color:#ffffff"  >
	<section class="title-banner text-white" id="title-banner" style="background-color: #003366;">
		<div class="">
			<div class="row">
				<div class="col-md-11">
					<h1 style="text-align: center;  color:#ffffff;">
					
					<a class="active btn btn-default" href="roles_disribution.php" title="Home" style="width: 70px;height:70px;background:url(images/dashboard.png);background-repeat:no-repeat;background-size:100% 102%"></a> 
					
					</h1>
					
				</div>
				
				<div class="col-md-1">
					<a  class="btn btn-default pull-right dropdown-toggle" data-toggle="dropdown" href="#" title="VIEW" style="width: 70px;height: 70px;background:url(uplode/<?php echo $_SESSION['u_id'].'.jpg';?>);background-repeat:no-repeat;background-size:100% 102%;border-radius: 54px;">
		</a>
		<ul class="dropdown-menu" style="margin: 5px -70% 0px;top: 85px;background-color:#003366;">
		<li class="user-header">
										<img src="uplode/<?php echo $_SESSION['u_id'].'.jpg';?>" class="img-circle" alt="User Image" style="width:100px;height:100px;margin-left: 38%;">
										<p>
											<?php 	$user_nm=$_SESSION['name'];
												$query="select * from staff WHERE `staff_fullname`='$user_nm'";
												$result=mysqli_query($conn,$query);
												$row=mysqli_fetch_array($result);
												?>
												<small style="font-size: 20px;padding: 10px;color: white;">Name : <?php echo $row['staff_fullname'];?></small><br>
												<small style="font-size: 20px;padding: 10px;color: white;">Email : <?php echo $row['staff_email'];?></small><br>
											<small style="font-size: 20px;padding: 10px;color: white;">Mobile :<?php echo $row['staff_contactno'];?></small>
										</p>
									</li>
									<li class="user-footer">
										<div class="pull-left">
											<a href="profile.php" class="btn btn-default btn-flat" style="background:url(images/profile.png);background-repeat:no-repeat;background-size:100% 102%;width: 70px;height: 70px;"title="VIEW PROFILE"></a>
										</div>
										<div class="pull-right">
											<a href="logout.php" class="btn btn-default btn-flat" style="background:url(images/logout.png);background-repeat:no-repeat;background-size:100% 102%;width: 70px;height: 70px;"title="LOGOUT"></a>
										</div>
									</li>
    </ul>
					
				</div>
				
				
			</div>
			
				</div>
			</div>
		</div>
	</section>
	<section class="title-banner text-white" id="title-banner" style="background-color:#36BBFE">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<h2 style="text-align: center; color:#F5F505;margin-top: 5px;"><b>Pending Work</b></h2>
				</div>
				<div class="col-md-4" style="margin-top: 7px;">
				</div>
			</div>
		</div>
	</section>
	<?php $today=date('Y-m-d');?>
	
	<div id="test_common">
	<div class="row">
			<div class="col-md-12" style="width:100%;overflow:auto; ">
				<div class="table-responsive" id="display_data_pending">
					<table id="mytable" class="table table-bordred table-striped" width="100%">
						<thead>
							<th style="text-align:center;"><h3><b>Sr No.</b></h3></th>
							<th style="text-align:center;"><h3><b>Report Number</b></h3></th>
							<th style="text-align:center;"><h3><b>Job Number</b></h3></th>
							<th style="text-align:center;"><h3><b>Sample Receieved Date</b></h3></th>
							<th style="text-align:center;"><h3><b>Action</b></h3></th>
						</thead>
						<tbody>
						<?php
						$count=0;
						$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1' AND `job_lab_progress`= '0' AND `report_job_printing`='0' ORDER BY job_id DESC";
						$result=mysqli_query($conn,$query);
						while($row=mysqli_fetch_array($result))
						{
						$count++;

						?>
						<input type="hidden" id="r_no" name="r_no" value="<?php echo $row['report_no'];?>">
						<input type="hidden" id="j_no" name="j_no" value="<?php echo $row['job_number'];?>">
						<tr>
						<td style="text-align:center;"><b><?php echo $count;?></b></td>
						<td style="white-space:nowrap;text-align:center;" ><b><?php echo $row['report_no'];?></b></td>
						<td style="white-space:nowrap;text-align:center;"><b><?php echo $row['job_number'];?></b></td>
						<td style="white-space:nowrap;text-align:center;"><b><?php 
						$date = new DateTime($row['sample_rec_date']);
						echo $date->format('d-m-Y');
						?></b></td>
						<td style="text-align:center;">
						
						<?php if($row['jobcreatedby_id']==$_SESSION['u_id']){?>
						<input type="button" class="btn btn-info btn-lg view_detail_from_job" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" data-toggle="modal" data-target="#myModal" value="View">
						<!--<a href="view_job_by_eng.php?report_no=<?php //echo $row['report_no'];?>&&job_no=<?php// echo $row['job_number'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>--->
						&nbsp;

						<input type="button" class="btn btn-success btn-lg btn3d submit_data_to_second_screen" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" title="Send To Progress" Value="Send To Progress">

						
						<?php 
						}else{ echo "****";}
						?>
						</td>
						</tr>
						<?php
						}	
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<br>
	<section class="title-banner text-white" id="title-banner" style="background-color:#36BBFE;">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<h2 style="text-align: center;  color:#f9ea3e;margin-top: 5px;"><b>Work In Progress</b></h2>
				</div>
				<div class="col-md-4" style="margin-top: 7px;">
				</div>
			</div>
		</div>
	</section>
	<div class="row">
			<div class="col-md-12" style="width:100%;overflow:auto;">
				<div class="table-responsive" id="second_display_data_pending">
					<table id="mytable2" class="table table-bordred table-striped" width="100%">
						<thead>
							<th style="text-align:center;"><h3><b>Sr No.</b></h3></th>
							<th style="text-align:center;"><h3><b>Report Number</b></h3></th>
							<th style="text-align:center;"><h3><b>Job Number</b></h3></th>
							<th style="text-align:center;"><h3><b>Sample Receieved Date</b></h3></th>
							<th style="text-align:center;"><h3><b>Status</b></h3></th>
							<th style="text-align:center;"><h3><b>Action</b></h3></th>
						</thead>
						<tbody>
						<?php
						$count=0;
						$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='0' ORDER BY job_id DESC";
						$result=mysqli_query($conn,$query);
						while($row=mysqli_fetch_array($result))
						{
						$count++;

						?>
						<input type="hidden" id="screen2_r_no" name="r_no" value="<?php echo $row['report_no'];?>">
						<input type="hidden" id="screen2_j_no" name="j_no" value="<?php echo $row['job_number'];?>">
						<tr>
						<td style="text-align:center;"><b><?php echo $count;?></b></td>
						<td style="white-space:nowrap;text-align:center;" ><b><?php echo $row['report_no'];?></b></td>
						<td style="white-space:nowrap;text-align:center;"><b><?php echo $row['job_number'];?></b></td>
						<td style="white-space:nowrap;text-align:center;"><b><?php 
						$date = new DateTime($row['sample_rec_date']);
						echo $date->format('d-m-Y');
						?></b></td>
						<td style="white-space:nowrap;text-align:center;">
						<?php 
						
						$final_query_off="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_number]' AND `report_no`='$row[report_no]' AND `light_status`=0";
						$final_result_off=mysqli_query($conn,$final_query_off);
						
						$final_query_working="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_number]' AND `report_no`='$row[report_no]' AND `light_status`=1";
						$final_result_working=mysqli_query($conn,$final_query_working);
						
						$final_query_done="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_number]' AND `report_no`='$row[report_no]' AND `light_status`=2";
						$final_result_done=mysqli_query($conn,$final_query_done);
						
						$off=0;
						$working=0;
						$done_light=0;

						if(mysqli_num_rows($final_result_off)>0){
							$off=1;	
							$working=0;
							$done_light=0;
						}else if(mysqli_num_rows($final_result_working)>0){
							$off=0;	
							$working=1;
							$done_light=0;
						}else if(mysqli_num_rows($final_result_done)>0){
							$off=0;	
							$working=0;
							$done_light=1;
						}
						
						if($off==1){
							echo '<img src="images/work_light/off.png">';
						}else if($working==1){
							echo '<img src="images/work_light/work.png">';
						}elseif($done_light==1){
							echo '<img src="images/work_light/done.png">';
						}else{
							
						}
					?>
						</td>
						<td style="text-align:center;">
						
						<?php if($row['jobcreatedby_id']==$_SESSION['u_id']){?>
						<input type="button" class="btn btn-warning btn-lg btn3d submit_reward" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" title="Send To Reward" Value="Reward">
						
						<input type="button" class="btn btn-info btn-lg view_detail_from_job_from_second" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" data-toggle="modal" data-target="#myModal" value="View"></input>
						<!--<a href="view_job_by_eng.php?report_no=<?php //echo $row['report_no'];?>&&job_no=<?php// echo $row['job_number'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>--->
						&nbsp;

						<input type="button" class="btn btn-success btn-lg btn3d job_complete" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" title="Job Complete" value="Job Complete">

						<?php
						}else{
							echo "****";
						}
						
						?>
						
						</td>
						</tr>
						<?php
						}	
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<section class="title-banner text-white" id="title-banner" style="background-color:#36BBFE">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<h2 style="text-align: center; color:#F5F505;margin-top: 5px;"><b>Notification</b></h2>
				</div>
				<div class="col-md-4" style="margin-top: 7px;">
				</div>
			</div>
		</div>
	</section>
	
<div style="width:100%;overflow:auto;border-style: solid;border-width: 5px;border-color:red;min-height:270px;">
			<br>
		
			<marquee onmouseover="this.stop();" onmouseout="this.start();">
			<div style="font-size: 20px;margin-left: 15px;font-weight: bold;">
			<?php
			
			$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1'  AND `report_job_printing`='0' ORDER BY job_id DESC";
			$result=mysqli_query($conn,$query);
			$current_date= date("Y-m-d");
			$next_date= date('Y-m-d', strtotime($current_date. ' + 2 days'));
			
			
			while($row=mysqli_fetch_array($result))
			{
				if($row["job_lab_progress"]=='0')
				{
					
					 $final_query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_number]' AND `expected_date` <= '$next_date' AND `expected_date` >= '$current_date'  AND `light_status` != 2 ORDER BY final_material_id DESC";
					$final_result=mysqli_query($conn,$final_query);
				if(mysqli_num_rows($final_result) > 0)
				{
					while($final_row=mysqli_fetch_array($final_result))
					{
						
						//echo "gg".$row["job_number"]."'s ".$final_row["lab_no"]."<br>";
						echo '<a href="" class="view_detail_from_job" data-id="'.$row['report_no'].'|'.$row['job_number'].'" data-toggle="modal" data-target="#myModal">';
						echo '&#9679;<span style="color: yellow;">There Is Less Than '.'<span class="demo" style="background-color: red;padding: 5px;border-radius: 20px;"></span>'." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;left For Job No : ".$row["job_number"]." And  Lab No : ".$final_row["lab_no"].'</span><br><br>';
						echo '</a>';
					}
				}
					
				}else{
					
					$final_query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_number]' AND `expected_date` <= '$next_date' AND `expected_date` >= '$current_date' AND `light_status` != 2 ORDER BY final_material_id DESC";
					$final_result=mysqli_query($conn,$final_query);
				if(mysqli_num_rows($final_result) > 0)
				{
					while($final_row=mysqli_fetch_array($final_result))
					{
						//echo "jj".$row["job_number"]."'s ".$final_row["lab_no"]."<br>";
						echo '<a href="" class="view_detail_from_job_from_second" data-id="'.$row['report_no'].'|'.$row['job_number'].'" data-toggle="modal" data-target="#myModal">';
						echo '&#9679;<span style="color: red;">There Is Less Than '.'<span class="demo" style="background-color: red;padding: 5px;border-radius: 20px;color:white;"></span>'."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;left For Job No : ".$row["job_number"]." And Lab No : ".$final_row["lab_no"].'</span><br><br>';
						echo '</a>';
						
					}
				}
					
				}
				
				
			}
			
			?>
			
			
			
			</div></marquee>
			<div>
		</div>
	</div>	
		
	<!--model for view-->
	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 90%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<div class="row">
			<div class="col-md-6"><h3 class="modal-title" style="color:black;">Report Number :<span id="report_span"></span></h3></div>
			<div class="col-md-6" style="margin-top: -15px;"><h3 class="modal-title" style="color:black;">Job Number :<span id="job_span"></span></h3></div>
		</div>
        
      </div>
      <div class="modal-body">
		<div id="display_data">
		
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.0.3/jquery-confirm.min.js"></script>

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
<script src="https://cdn.datatables.net/plug-ins/1.10.16/api/sum().js"></script>

	<script>
	 $(document).ready(function() {
    var table = $('#mytable').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
		"oLanguage": {
   "sSearch": "Search Pending Jobs"
 }
		
    } );
	
	var table2 = $('#mytable2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
		"oLanguage": {
   "sSearch": "Search Progressing Jobs"
 }
		
    } );
 } );
		$('#datepicker').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy'
		});
		
		$('.expdate_class').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy'
		});
		
		
		function getdata_after_refresh(){
				$.ajax({
					type: 'POST',
					url: '<?php $base_url; ?>span_save_data_lab_screen.php',
					data: 'action_type=getdata_after_refresh',
					success:function(html){
						$('#test_common').html(html);
					}
				});
			}
		// for first portion	
		$(document).on('click','.view_detail_from_job',function(){
			var abc = $(this).attr('data-id');
			$.ajax
			({
				type: 'POST',
				url: '<?php $base_url; ?>span_save_data_lab_screen.php',
				data: 'action_type=view_detail_from_job&abc='+abc,
				success:function(html){
					$('#display_data').html(html);
					var ss=abc.split("|");
					$('#report_span').text(ss[0]);
					$('#job_span').text(ss[1]);
					
				}
			});
		});
		
		// forsecond portion
		$(document).on('click','.view_detail_from_job_from_second',function(){
			var abc = $(this).attr('data-id');
			$.ajax
			({
				type: 'POST',
				url: '<?php $base_url; ?>span_save_data_lab_screen.php',
				data: 'action_type=view_detail_from_job_from_second&abc='+abc,
				success:function(html){
					$('#display_data').html(html);
					var ss=abc.split("|");
					$('#report_span').text(ss[0]);
					$('#job_span').text(ss[1]);
					
				}
			});
		});
		$(document).on('click','.submit_data_to_second_screen',function(){
			var abc = $(this).attr('data-id');
			var ss=abc.split("|");
			var r_no = ss[0];
			var j_no = ss[1];
			$.confirm({
				   title: "warning",
				   content: "Are You Sure To Send This Job To Submit?",
				   buttons: {
			confirm: function () {
			$.ajax
			({
				type: 'POST',
				url: '<?php $base_url; ?>span_save_data_lab_screen.php',
				data: 'action_type=submit_data_to_second_screen&r_no='+r_no+'&j_no='+j_no,
				success:function(html){
					getdata_after_refresh();
				 }
			 });
			 },
           cancel: function () {
return;
           }
}
       })
		});
		
		$(document).on('click','.submit_reward',function(){
			var abc = $(this).attr('data-id');
			var ss=abc.split("|");
			var r_no = ss[0];
			var j_no = ss[1];
			$.confirm({
				   title: "warning",
				   content: "Are You Sure To Reward This Job?",
				   buttons: {
			confirm: function () {
			$.ajax
			({
				type: 'POST',
				url: '<?php $base_url; ?>span_save_data_lab_screen.php',
				data: 'action_type=submit_reward&r_no='+r_no+'&j_no='+j_no,
				success:function(html){
					getdata_after_refresh();
				 }
			 });
			 },
           cancel: function () {
return;
           }
}
       })
		});
		
		$(document).on('click','.job_complete',function(){
			var abc = $(this).attr('data-id');
			var ss=abc.split("|");
			
			var screen2_r_no = ss[0];
			var screen2_j_no = ss[1];
			$.confirm({
				   title: "warning",
				   content: "Are You Sure To Send This Job To Submit?",
				   buttons: {
			confirm: function () {
			$.ajax
			({
				type: 'POST',
				url: '<?php $base_url; ?>span_save_data_lab_screen.php',
				data: 'action_type=job_complete&screen2_r_no='+screen2_r_no+'&screen2_j_no='+screen2_j_no,
				success:function(html){
					getdata_after_refresh();
					
				 }
			 });
			 },
           cancel: function () {
return;
           }
}
       })
		});
		
// on date change
$(document).on('change','.expdate_class',function(){
    var get_date= $(this).val();         //Date in full format alert(new Date(this.value)); 
    var get_attr= $(this).attr('data-id');
	
	$.ajax({
				type: 'POST',
				url: '<?php $base_url; ?>span_save_data_lab_screen.php',
				data: 'action_type=update_date_by_id&get_date='+get_date+'&get_attr='+get_attr,
				success:function(html){
					alert("Date update Successfully..");
					window.location.href="<?php $base_url; ?>dashbord_notice.php";
					//getdata_after_refresh();
					
				 }
	});
	
});

// on material save for light status
$(document).on('click','.update_light_status',function(){
    var get_attr= $(this).attr('data-id');
	
	$.ajax({
				type: 'POST',
				url: '<?php $base_url; ?>span_save_data_lab_screen.php',
				data: 'action_type=update_final_for_light_by_id&&get_attr='+get_attr,
				success:function(html){
					window.location.href="<?php $base_url; ?>dashbord_notice.php";
					//getdata_after_refresh();
					
				 }
	});
	
});
	
	</script>
	
<script>
// Set the date we're counting down to

var today = new Date();
today.setHours(0,0,0,0);
    var newdate = new Date();
    newdate.setHours(0,0,0,0)
    newdate.setDate(today.getDate()+2);
var countDownDate = newdate.getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    //document.getElementByClassName("demo").innerHTML = days + "d " + hours + "h "
   // + minutes + "m " + seconds + "s ";
    $(".demo").text("d:h:m:s="+days + ":" + hours + ":"+ minutes + ":" + seconds);
    
}, 1000);
</script>