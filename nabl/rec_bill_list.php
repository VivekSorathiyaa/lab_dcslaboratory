<?php include("header.php");?>
<?php
if($_SESSION['name']=="")
{
	?>
	<script>
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





.form-control {
font-size: 20px;;
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">


<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto;
     padding-left: 0px;
     padding-right: 0px; ">
			<?php include("menu.php") ?>
	<div class="row">

		<h3 style="text-align:center;">
		Billing List
		</h3>
	</div>
	<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">

					<!-- /.box-header -->


							<div class="box-body">

								<hr style="border-top: 1px solid;">

								<br>
								<div id="display_data_report">
								<table class="table no-margin" id="example1" width="100%">
										  <thead>
										  <tr>
											<th>Report No </th>
											<th>Job No </th>
											<th>Estimaste No </th>
											<th>Agency Name</th>
											<th>Bill Amount</th>
											<th>Action</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
											$sel_estimate="select * from estimate_total_span where `est_isdeleted`=0 AND `is_billing`=1 AND `is_delivered` =0 AND `job_send_to_dispatch` =1";
											$query_estimate=mysqli_query($conn,$sel_estimate);

											if(mysqli_num_rows($query_estimate) > 0){
											while($get_estimate=mysqli_fetch_array($query_estimate)){

										  ?>
										  <tr>
											<td><?php echo $get_estimate["report_no"]; ?></td>
											<td><?php echo $get_estimate["job_no"]; ?></td>
											<td><?php echo $get_estimate["estimate_no"]; ?></td>
											<td><?php
											$age_id= $get_estimate["agency_id"];
											$sel_agency="select * from agency_master where `agency_id`=".$age_id;
											$query_agency=mysqli_query($conn,$sel_agency);
											$result_agency=mysqli_fetch_array($query_agency);

											echo $result_agency["agency_name"];
											?>
											</td>
											<td><?php echo $get_estimate["total_amt"]; ?></td>

											<td>

											<?php
											 $sel_jobs="select * from job where `report_no`='$get_estimate[report_no]'";
											 $result_jobs=mysqli_query($conn,$sel_jobs);
											 $get_jobs=mysqli_fetch_array($result_jobs);

											 if($get_jobs["jobcreatedby_id"]==$_SESSION['u_id'] || $_SESSION['isadmin']==0)
											 {
											?>

											  <a href="edit_span_set_rate_only_by_biller.php?report_no=<?php echo $get_estimate['report_no'];?>&&job_no=<?php echo $get_estimate['job_no'];?>" class="btn btn-primary btn-lg btn3d"><span class="glyphicon glyphicon-question-list"></span> Edit</a>

											  <a href="span_bill_print.php?report_no=<?php echo $get_estimate['report_no'];?>&&job_no=<?php echo $get_estimate['job_no'];?>" class="btn btn-primary btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Print</a>

												<?php if($get_estimate['iscorh'] == NULL)
												{?>

												<a href="dilevery_detail.php?report_no=<?php echo $get_estimate['report_no'];?>&&job_no=<?php echo $get_estimate['job_no'];?>" class="btn btn-success btn-lg btn3d" data-id="<?php echo $get_estimate['report_no'];?>"title="Fill Receiver Details"><span class="glyphicon glyphicon-question-ok"></span> Fill Receiver Details </a>
												<?php
												}
												else
												{?>
													<a href="dilevery_detail.php?report_no=<?php echo $get_estimate['report_no'];?>&&job_no=<?php echo $get_estimate['job_no'];?>" class="btn btn-info btn-lg btn3d" data-id="<?php echo $get_estimate['report_no'];?>"title="Edit Receiver Details"><span class="glyphicon glyphicon-question-ok"></span> Edit Delivery Data </a>
													<?php if($get_estimate["rbt"] == 1 && $get_estimate["bill"] == 1){?>
													<a href="download_data.php?report_no=<?php echo $get_estimate['report_no'];?>&&job_no=<?php echo $get_estimate['job_no'];?>" class="btn btn-danger btn-lg btn3d" data-d="<?php echo $get_estimate['report_no'];?>"title="Submited Successfully"><span class="glyphicon glyphicon-question-ok"></span>DOWNLOAD DATA</a>

													<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d send_to_second" data-id="<?php echo $get_estimate['report_no'];?>"title="Submited Successfully"><span class="glyphicon glyphicon-question-ok"></span>FINAL SUBMISSION</a>


												<?php
													}
												}
												?>
											<?php
											}else{
												echo "****";
											}
											?>
											</td>
										  </tr>
										 <?php
										 }
										 }

										 ?>

										  </tbody>
										</table>

							</div>
					<!-- /.box-body -->
					</div>
				</div>
	</div>

	<br>

<?php

		/* $query1="select * from job WHERE `admin_status_rec_1`=1 ORDER BY job_id DESC";
		$result1=mysqli_query($conn,$query1);
		if(mysqli_num_rows($result1) > 0)
		{ */

	?>
	<!--<div class="row">

		<h1 style="text-align:center;">
			Admin Queries
		</h1>
	</div>-->
	<!--<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">




							<div class="box-body">

								<hr style="border-top: 1px solid;">

								<br>
								<div id="display_data">
									<table id="example2" class="table table-bordered table-striped" style="width:100%;">
										<thead>
										<tr>
											<th style="text-align:center;">Serial No</th>
											<th style="text-align:center;">Date</th>
											<th style="text-align:center;">Customer Name</th>
											<th style="text-align:center;">Agency Name</th>
											<th style="text-align:center;">Report No</th>
											<th style="text-align:center;">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											/* $count=0;
											$query1="select * from job WHERE `admin_status_rec_1`=1 ORDER BY job_id DESC";
											$result1=mysqli_query($conn,$query1);
											while($row1=mysqli_fetch_array($result1))
											{
												$count++; */

										?>
												<tr>
												<td style="text-align:center;"><?php //echo $count;?></td>
												<td style="text-align:center;"><?php //echo date("d-m-Y", strtotime($row1['date']));?></td>
												<td style="text-align:center;"><?php //echo $row1['clientname'];?></td>
												<td style="text-align:center;"><?php

												/* $query_agency1="select * from agency_master where `agency_id`=".$row1['agency'];
												$result_agency1=mysqli_query($conn,$query_agency1);
												$row_result1=mysqli_fetch_array($result_agency1);
												echo $row_result1["agency_name"]; */
												?></td>
												<td style="white-space:nowrap;text-align:center;"><?php //echo $row1['report_no'];?></td>
												<td style="text-align:center;">

													<a href="<?php// echo $base_url; ?>edit_client_form.php?job_id=<?php //echo $row1['job_id'];?>" class="btn btn-info btn-lg btn3d" title="Material Assign"><span class="glyphicon glyphicon-question-edit"></span> Edit</a>

												</td>
											</tr>
										<?php
											//}
										?>
									</tbody>

								  </table>

								</div>
							</div>

					</div>
				</div>
	</div>-->
<?php
		//}
?>

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

	$('#from_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	})
	$('#to_date').datepicker({
	  autoclose: true,
	  format: 'dd-mm-yyyy'
	})

	$(function () {
		$('.select2').select2()
	})
</script>
<script>


	$("#btn_search").click(function(){

					var from_date = $('#from_date').val();
					var to_date = $('#to_date').val();

					var postData = '&from_date='+from_date+'&to_date='+to_date+'&get_by_rece_second=get_by_rece_second';

					$.ajax({
						url : "<?php echo $base_url; ?>search_job_listing.php",
						type: "POST",
						data : postData,

						success: function(data,status,  xhr)
						 {
							document.getElementById("overlay_div").style.display="none";
							$("#display_data").html(data);

						 }

					});
	});


	function deleteData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';

     if (type == 'delete'){

			billData = 'action_type='+type+'&id='+id;

    }
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>delete_ess_bill.php',
        data: billData,
        success:function(msg){

            if(msg == 'ok'){
                alert('Bill data has been '+statusArr[type]+' successfully.');
                getbills();

				  window.location.href="<?php echo $base_url; ?>view_est_bill.php";

            }else{
                alert('Bill data has been '+statusArr[type]+' successfully.');
				 window.location.href="<?php echo $base_url; ?>view_est_bill.php";
            }
        }
    });
}


	$(document).on("click", ".send_to_second", function () {
				var report_no = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Print Reports?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>saveDeilivery.php',
        data: 'action_type=sendbill&report_no='+report_no,
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

function get_jobs(){

    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>saveDeilivery.php',
        data: 'action_type=get_jobing_for_first_reception',
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(html){
			document.getElementById("overlay_div").style.display="none";
            $('#display_data_report').html(html);
        }
    });
}

</script>
