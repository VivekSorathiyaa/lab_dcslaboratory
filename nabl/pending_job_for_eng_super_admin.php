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


$user_id = $_GET['userid'];

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
					PENDING FINAL JOB

					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">PENDING FINAL JOB</h3>
				</div>
				<!-- /.box-header -->

						<div class="box-body">

							<div id="display_data">

								<table id="example1" class="table table-bordered table-striped" style="width:100%">
									<thead>
									<tr>
										<th style="text-align:center;">Assigned To</th>
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
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `job_sent_to_qm`=0 AND `tested_by`='$user_id' AND `job_owner`='2' ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);

										while($row=mysqli_fetch_array($result))
										{
											$count++;
											$report_explode=explode("/",$row['report_no']);

									?>
											<tr id="<?php echo $report_explode[2];?>">
											<td style="white-space:nowrap;">

											<select name="sel_assign_to" class="form-control sel_assign_to">
											<?php
											$sel_staff="select * from staff where `staff_isadmin`=4";
											$query_staff=mysqli_query($conn,$sel_staff);
											if(mysqli_num_rows($query_staff) > 0){

										while($one_staff=mysqli_fetch_array($query_staff)){
											?>

											<option value="<?php echo $one_staff["id"]."|".$row['report_no']; ?>" <?php if($row["tested_by"]==$one_staff["id"]){ echo "selected"; }?>><?php echo $one_staff["staff_fullname"]; ?></option>
											<?php
											} }
											?>
											</select>
											</td>
											<td style="white-space:nowrap;">

												<a href="view_job_by_super_admin.php?report_no=<?php echo $row['report_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>
											&nbsp;

											&nbsp;<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d delete_jobs" data-id="<?php echo $row['report_no'];?>" title="" ><span class="glyphicon glyphicon-question-ok"></span> Delete</a>

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

											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['sample_rec_date']));?></td>
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


	$("#btn_search").click(function(){

					var from_date = $('#from_date').val();
					var to_date = $('#to_date').val();
					var agency = $('#agency').val();
					var user_id = <?php echo $user_id;?>

					var postData = '&from_date='+from_date+'&to_date='+to_date+'&user_id='+user_id;

					$.ajax({
						url : "<?php echo $base_url; ?>search_pending_job_for_engineer_super_admin.php",
						type: "POST",
						data : postData,
						beforeSend: function(){
							document.getElementById("overlay_div").style.display="block";
						},
						success: function(data,status,  xhr)
						 {
							document.getElementById("overlay_div").style.display="none";
							$("#display_data").html(data);

						 }

					});
	});

	$(document).on('change','.sel_assign_to',function(){
  var val = $('option:selected',this).val();

  var idss= val.split('/');
  var delete_tr="#"+idss[2];

  billData = 'action_type=change_assign&val='+val;

  $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>change_assigned_jobs.php',
        data: billData,
        success:function(msg){
            $(delete_tr).remove();
        }
    });
});

//Work FOr delete job by report no from all related tables
 $(document).on("click", ".delete_jobs", function () {
	var clicked_id = $(this).attr("data-id");

		var idss= clicked_id.split('/');
		var delete_tr="#"+idss[2];

	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=delete_the_jobs&clicked_id='+clicked_id,
        success:function(html){
			alert("Job Successfully Deleted..");
			$(delete_tr).remove();
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
