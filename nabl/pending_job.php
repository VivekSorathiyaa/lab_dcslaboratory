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
					PENDING JOB LISTING

					</h1>
				</div>

		<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">PENDING JOB LISTING</h3>
				</div>
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
										$query="select * from job where send_to_second_reception ='0'";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;

									?>
											<tr>
											<td style="white-space:nowrap;">
											<?php if($row['assign_status']==0){ ?>
													<!--<a href="<?php //echo $base_url; ?>material_assigning.php?report_no=<?php// echo $row['report_no'];?>" class="btn btn-info btn-lg btn3d" title="Material Assign"><span class="glyphicon glyphicon-question-edit"></span> Edit</a>-->

													<a href="<?php echo $base_url; ?>edit_client_form_by_super_admin.php?job_id=<?php echo $row['job_id'];?>" class="btn btn-info btn-lg btn3d" title="Edit Job"><span class="fa fa-pencil"></span> </a>
													&nbsp;&nbsp;&nbsp;

													<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d delete_job" data-id="<?php echo $row['job_id'];?>"title="Delete Job"><span class="fa fa-trash-o"></span></a>

													&nbsp;&nbsp;&nbsp;
													<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d send_to_second" data-id="<?php echo $row['job_id'];?>"title="Send to Second Reception Desk"><span class="glyphicon glyphicon-question-ok"></span> Send To Reception 2</a>

												<?php } ?>
												<?php
													if($row['admin_status_rec_1']!=1){
												?>
												<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d send_to_rec1_for_edit" data-id="<?php echo $row['report_no'];?>"title="SEND QUERIES TO RECEPTION"><span class="glyphicon glyphicon-question-ok"></span>EDIT FOR RECEPTION 1</a>
												<?php
												}
												?>
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
var inv_start_date = "<?php echo $inv_startdate; ?>";
var inv_end_date = "<?php echo $inv_enddate; ?>";
	$('#from_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy',
	  //startDate: new Date(inv_start_date),
	 // endDate: new Date(inv_end_date)
	})
	$('#to_date').datepicker({
	  autoclose: true,
	  format: 'dd/mm/yyyy',
	 // startDate: new Date(inv_start_date),
	  //endDate: new Date(inv_end_date)
	})

	$(function () {
		$('.select2').select2()
	})
</script>
<script>

$(document).on("click", ".send_to_rec1_for_edit", function () {
					var report_no = $(this).attr("data-id");


		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To Send To Edit this Report Job Data ?",
			buttons: {
				confirm: function () {
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>update_status_of_admin.php',
			data: 'action_type=sendrec1&report_no='+report_no,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success:function(html){
				document.getElementById("overlay_div").style.display="none";
				get_jobs();
			}
		});

		},
				cancel: function () {
					return;
				}
				}
			})
	});


	$(document).on("click", ".delete_job", function () {
				var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=delete_job_by_rec&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>pending_job.php";
        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});


$(document).on("click", ".send_to_second", function () {
				var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=send_job_to_second_reception&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>pending_job.php";
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
