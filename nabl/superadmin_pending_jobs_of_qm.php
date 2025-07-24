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



.form-control {
font-size: 15px;
height: 50px;
}





</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">

<section class="content"  style="padding: 0px;
     margin-right: auto;
     margin-left: auto;
     padding-left: 0px;
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<!--<div class="row">

		<h1 style="text-align:center;">
		View Reports
		</h1>
	</div>-->
<div class="row">

		<div class="row">

		<h1 style="text-align:center;">
		View Pending Jobs
		</h1>
	</div>
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">

				<!-- /.box-header -->


						<div class="box-body">
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Action</th>
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

										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `job_owner_eng_and_qm`='2'  ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{


									?>
											<tr>
											<td style="text-align:center;">

											<a href="view_job_by_qlty_manager.php?report_no=<?php echo $row['report_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>
											&nbsp;
											<?php if($row['accepted_by_qm']==0){ ?>

											<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d job_send_to_accept" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span> Accept job</a>

											<?php }else{ ?>

											<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d job_send_to_print" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span>job Send To Print</a>

											<?php } ?>


											</td>


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
$(document).ready(function(){

	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
    } );

});

//send job to accept

$(document).on("click", ".job_send_to_accept", function () {
				var clicked_id = $(this).attr("data-id");
	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Job ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=send_job_to_accept&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_pending_job_report_for_qm.php";

        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});



//send job to print

$(document).on("click", ".job_send_to_print", function () {
				var clicked_id = $(this).attr("data-id");
	$.confirm({
        title: "warning",
        content: "Are You Sure To SentTo Print This Job ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=job_send_to_print&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_pending_job_report_for_qm.php";

        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});
$(document).on("click", ".report_send_to_accept", function () {
				var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=report_send_to_accept&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_pending_job_report_for_qm.php";

        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});

//send report to print

$(document).on("click", ".report_send_to_print", function () {
				var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=report_send_to_print&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_pending_job_report_for_qm.php";

        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});

//send job to accept

$(document).on("click", ".job_send_to_accept", function () {
				var clicked_id = $(this).attr("data-id");
	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Job ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=send_job_to_accept&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_pending_job_report_for_qm.php";

        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});



//send job to print

$(document).on("click", ".job_send_to_print", function () {
				var clicked_id = $(this).attr("data-id");
	$.confirm({
        title: "warning",
        content: "Are You Sure To SentTo Print This Job ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=job_send_to_print&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_pending_job_report_for_qm.php";

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
