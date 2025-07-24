<?php include("header.php");?>
<?php
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}



?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">

		<!-- Main content -->
		<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto;
     padding-left: 0px;
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row" style="margin: 0px 0px 0px 0px;">

					<h1 style="text-align:center;">
					WORK IN PROGRESS

					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">WORK IN PROGRESS</h3>
				</div>
				<!-- /.box-header -->

						<div class="box-body">

							<div id="">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;"></th>
										<th style="text-align:center;">Client Name</th>
										<th style="text-align:center;">Client Address</th>
										<th style="text-align:center;">Client Phone</th>
										<th style="text-align:center;">Email</th>
										<th style="text-align:center;">Client Gst No</th>
										<th style="text-align:center;">Client city</th>
										<th style="text-align:center;">Agency</th>
										<th style="text-align:center;">Agency Address</th>
										<th style="text-align:center;" >Agency Mobile</th>
										<th style="text-align:center;">Agency City</th>
										<th style="text-align:center;">Agency Gstno</th>
										<th style="text-align:center;">Agency Email</th>
										<th style="text-align:center;">Name of Work</th>
										<th style="text-align:center;">Authorized Name</th>
										<th style="text-align:center;">Ref No</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Job Number</th>
										<th style="text-align:center;">Sample Sent By</th>
										<th style="text-align:center;">Sample Rec Date</th>
										<th style="text-align:center;">Condition of Sample Receved</th>


									</tr>
								</thead>
								<tbody>
									<?php

										$count=0;
										$query="select * from job   WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='0' ORDER BY job_id DESC ";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;

									?>
											<tr>
											<td style="white-space:nowrap;">

												<input type="button" class="btn btn-warning btn-lg btn3d submit_reward" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" title="Send To Reward" Value="Reward">

												<input type="button" class="btn btn-info btn-lg view_detail_from_job_from_second" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" data-toggle="modal" data-target="#myModal" value="View">

												<input type="button" class="btn btn-success btn-lg btn3d job_complete" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>" title="Job Complete" value="Job Complete">

											</td>

											<td><?php echo $count;?></td>
											<td style="white-space:nowrap;"><?php echo $row['clientname'];?></td>
											<td><?php echo $row['clientaddress'];?></td>
											<td><?php echo $row['clientphone'];?></td>
											<td><?php echo $row['email'];?></td>
											<td><?php echo $row['client_gstno'];?></td>

											<?php
											$sel_city="select * from city where id=".$row['client_city'];
											$query_city = mysqli_query($conn, $sel_city);
											$get_city = mysqli_fetch_array($query_city);
											?>
											<td><?php echo $get_city['city_name'];?></td>

											<?php $sel_agency="select * from agency_master where `agency_id`=".$row["agency"];
											$query_agency = mysqli_query($conn, $sel_agency);
											$get_agency = mysqli_fetch_array($query_agency);
											?>
											<td><?php echo $get_agency['agency_name'];?></td>
											<td><?php echo $row['agency_address'];?></td>
											<td><?php echo $row['agency_mobile'];?></td>
											<?php $sel_agency_city="select * from city where `id`=".$row["agency_city"];
											$query_agency_city = mysqli_query($conn, $sel_agency_city);
											$get_agency_city = mysqli_fetch_array($query_agency_city);
											?>
											<td><?php echo $get_agency_city['city_name'];?></td>
											<td><?php echo $row['agency_gstno'];?></td>
											<td><?php echo $row['agency_email'];?></td>
											<td><?php echo $row['nameofwork'];?></td>
											<td><?php echo $row['person_name'];?></td>
											<td><?php echo $row['refno'];?></td>
											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['date']));?></td>
											<td><?php echo $row['report_no'];?></td>
											<td><?php echo $row['job_number'];?></td>
											<td>
											<?php if($row['sample_sent_by']=='0'){
												echo $row['clientname'];
											}else{
												echo $get_agency['agency_name'];
											}?>
											</td>

											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row[	'sample_rec_date']));?></td>
											<td>
											<?php if($row['condition_of_sample_receved']=='0'){
												echo $row['clientname'];
											}else{
												echo $get_agency['agency_name'];
											}?>
											</td>

										</tr>
									<?php
										}
									?>
								</tbody>

							  </table>
							</div>
						</div>
				<!-- /.box-body -->
				</div>
			</div>
		</div>
</section>
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
<?php include("footer.php");?>

<script>
    $(document).ready(function() {
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
	 buttons: [

            { extend: 'excel',
			  footer: true,
			}
        ],

    } );
 } );



	$(function () {
		$('.select2').select2()
	})
</script>
<script>

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
					//getdata_after_refresh();
					window.location.href="<?php echo $base_url; ?>lab_work_in_progress.php";
				 }
			 });
			 },
           cancel: function () {
return;
           }
}
       })
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
					window.location.href="<?php echo $base_url; ?>lab_work_in_progress.php";

				 }
			 });
			 },
           cancel: function () {
return;
           }
}
       })
		});


</script>
