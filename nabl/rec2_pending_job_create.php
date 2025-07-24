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
					PENDING JOBS CREATE

					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">

				<!-- /.box-header -->

						<div class="box-body">
							<div id="display_data">
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
										$query="select * from job where   `jobisdeleted`='0' and `send_to_second_reception` = '1' and `material_assign` = '0' ";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;

									?>
											<tr id="tr_<?php echo $row['job_id'];?>">
											<td style="white-space:nowrap;">

												<a href="span_material_assigning_by_super_admin.php?report_no=<?php echo $row['report_no'];?>" class="btn btn-primary btn-lg btn3d" title="Material Assign"><span class="glyphicon glyphicon-question-list"></span> Material Selection</a>
											&nbsp;
											<?php if($row['scan_document'] !=""){?>
											<a href="<?php echo $base_url."scan_document/".$row['scan_document'] ?>" class="btn btn-success btn-lg btn3d" title="Downlaod Document" download><span class="glyphicon glyphicon-question-downlaod"></span> Downlaod</a>

										<?php } ?>

										&nbsp;<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d reward_job_by_sadmin" data-id="<?php echo $row['job_id'];?>"title="DELETE"><span class="glyphicon glyphicon-question-ok"></span>Reward</a>

										&nbsp;<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d delete_job_by_sadmin" data-id="<?php echo $row['job_id'];?>"title="DELETE"><span class="glyphicon glyphicon-question-ok"></span>DELETE</a>


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


	// delete the job by job ids
	$(document).on("click", ".delete_job_by_sadmin", function () {
					var delete_ids = $(this).attr("data-id");


		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To Delete This Job ?",
			buttons: {
				confirm: function () {
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>superadmin_delete_bill.php',
			data: 'action_type=delete_job_by_sadmin&delete_ids='+delete_ids,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success:function(html){
				document.getElementById("overlay_div").style.display="none";
				var set_id="#tr_"+delete_ids;
				$(set_id).remove();
				//get_jobs();
			}
		});

		},
				cancel: function () {
					return;
				}
				}
			})
	});




	// reward job to rec 1
	$(document).on("click", ".reward_job_by_sadmin", function () {
					var delete_ids = $(this).attr("data-id");


		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To Reward This Job ?",
			buttons: {
				confirm: function () {
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>superadmin_delete_bill.php',
			data: 'action_type=reward_job_by_sadmin&delete_ids='+delete_ids,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success:function(html){
				document.getElementById("overlay_div").style.display="none";
				var set_id="#tr_"+delete_ids;
				$(set_id).remove();
				//get_jobs();
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

