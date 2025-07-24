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



.btn-warning {
    box-shadow:0 0 0 1px #f0ad4e inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #eea236, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#f0ad4e;
}
.form-control {
font-size: 15px;
height: 50px;
}





</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">

<section class="content"  style="padding: 0px;margin-right: auto;margin-left: auto; padding-left: 0px; padding-right: 0px; ">
			<?php include("menu.php") ?>
			<!--<div class="row">

		<h1 style="text-align:center;">
		View Reports
		</h1>
	</div>-->
<div class="row">

		<div class="row">

		<h1 style="text-align:center;">
		Wait for Proceed Job
		</h1>
	</div>
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">

				<!-- /.box-header -->


						<div class="box-body">
						<div id="display_data_third">
								<table id="example3" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">S.R.F. No</th>
										<th style="text-align:center;">Reference No</th>
										<th style="text-align:center;">Agency Name</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from save_material_assign WHERE `is_deleted`=0 AND `isstatus`=2 AND `created_by`='$_GET[userid]'  ORDER BY sm_id DESC";

										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
										$query_ref_no="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$row[trf_no]'";
										$result_ref_no=mysqli_query($conn,$query_ref_no);
										$row_ref_no=mysqli_fetch_array($result_ref_no);

										$sel_agency_id=$row_ref_no["agency"];
										$sel_agency="select * from agency_master where `agency_id`=".$sel_agency_id;
										$result_agency =mysqli_query($conn,$sel_agency);
										$row_agency =mysqli_fetch_array($result_agency);
										$agency_name=$row_agency["agency_name"];

									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row_ref_no['refno'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
											<td style="text-align:center;">

											<!--<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d reward_save_material" data-id="<?php//echo $row['sm_id']."|".$row['trf_no'];?>" title="Reward"><span class="glyphicon glyphicon-question-ok"></span> Reward</a>-->

											<!--<a href="span_set_rate.php?trf_no=<?php //echo $row['trf_no'];?>&&job_no=<?php //echo $row['job_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> perfoma</a>-->
											&nbsp;

											<!--<a href="span_set_rate_only_by_test.php?trf_no=<?php //echo $row['trf_no'];?>&&job_no=<?php //echo $row['job_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Invoice By Test</a>

											<a href="span_set_rate_only_by_material.php?trf_no=<?php //echo $row['trf_no'];?>&&job_no=<?php //echo $row['job_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Invoice By Material</a>

											<a href="span_set_rate_only_for_estimate.php?trf_no=<?php //echo $row['trf_no'];?>&&job_no=<?php //echo $row['job_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Estimate</a>-->

											<a href="print_trf.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_no'];?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> PRINT TRF </a>


											&nbsp;
											<a href="print_job_card.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_no'];?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> PRINT JOB CARD</a>
											&nbsp;
											<a href="print_sample_token.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_no'];?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> SAMPLE TAGS</a>

											&nbsp;
											<a href="print_receipt.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_no'];?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> RECEIPT</a>

											<!--<a href="span_set_rate_only_by_material.php?trf_no=<?php //echo $row['trf_no'];?>&&job_no=<?php //echo $row['job_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Invoice By Material</a>-->
											&nbsp;

											<?php if($row["is_estimate"]==1)
											{
										?>

												<!--<a href="matt_perfoma_bill_print.php?trf_no=<?php //echo $row['trf_no'];?>&&job_no=<?php //echo $row['job_no'];?>" class="btn btn-primary btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Print</a>-->



												<!--<a href="span_bill_print_only_by_materal_rec_two.php?trf_no=<?php //echo $row['trf_no'];?>&&job_no=<?php //echo $row['job_no'];?>" class="btn btn-primary btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Print(M)</a>-->

											<?php
											}
											?>

										<!--condition if estimate ready submit button display-->

										<?php
										//$sel_estimate="select * from save_material_assign where `trf_no`='$row[trf_no]' AND `is_estimate`=1";
										//$query_estimate=mysqli_query($conn,$sel_estimate);
										//if(mysqli_num_rows($query_estimate) > 0){
										?>
											&nbsp;<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d send_to_lab" data-id="<?php echo $row['sm_id']."|".$row['trf_no']."|".$row['job_no'];?>" title="" ><span class="glyphicon glyphicon-question-ok"></span> SUBMIT</a>
										<?php
										//}
										?>
											<!--&nbsp;<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d delete_jobs"data-id="<?php //echo $row['trf_no'];?>" title="" ><span class="glyphicon glyphicon-question-ok"></span> Delete</a>-->

											</td>
										</tr>
									<?php
										}
									?>
								</tbody>

							  </table>

							</div>
							<div class="row">
							<div class="col-md-5">&nbsp;</div>

							<div class="col-md-3">&nbsp;</div>
							</div>
						</div>
				<!-- /.box-body -->
				</div>
			</div>
		</div>
</section>
</div>
<!-- modal for view-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 35%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<div id="display_data" style="text-align:center;">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="myModal_update" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 35%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<div id="display_data_for_update" style="text-align:center;">
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
$(document).ready(function(){

	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [

            { extend: 'excel',
			  footer: true,
			}
        ],
    } );

});

$(document).on("click", ".dispatch_jobs_by_reception", function () {
	var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Completed this job after Report Dispatched?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=dispatch_jobs_by_reception&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_completed_job_report_for_reception.php";

        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});

$(document).on("click", ".update_dispatch_reports", function () {

   var courier_date=$("#courier_date").val();
   var courier_docate_no=$("#courier_docate_no").val();
   var courier_contact_person=$("#courier_contact_person").val();
   var courier_contact_person_mobile=$("#courier_contact_person_mobile").val();
   var courier_contact_address=$("#courier_contact_address").val();
   var hidden_all_ids=$("#hidden_all_ids").val();

	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=update_dispatch_reports&&courier_date='+courier_date+'&courier_docate_no='+courier_docate_no+'&courier_contact_person='+courier_contact_person+'&courier_contact_person_mobile='+courier_contact_person_mobile+'&courier_contact_address='+courier_contact_address+'&hidden_all_ids='+hidden_all_ids,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_dispatched_report_for_reception.php";

        }
    });

});

$(document).on('click','.get_dispatch_report',function(){
			var abc = $(this).attr('data-id');
			$.ajax
			({
				type: 'POST',
				url: '<?php $base_url; ?>span_save_material.php',
				data: 'action_type=get_dispatch_report&abc='+abc,
				success:function(html){
					$('#myModal_update').modal('hide');
					$('#display_data').html(html);
				}
			});
		});




$(document).on("click", ".get_for_update", function () {


		var chk_array = [];
     var oTable = $("#example2").dataTable();
	 $(".dispatch_id:checked", oTable.fnGetNodes()).each(function() {
		 chk_array.push($(this).val());
		 });

		if (chk_array.length === 0) {
			alert("Please Select Atlist One Report");
			$('#myModal_update').modal('hide');
			$('#display_data_for_update').html("");
			return false;
		}

				 $.ajax({
						type: 'POST',
						url: '<?php $base_url; ?>span_save_material.php',
						data: 'action_type=get_for_update&chk_array='+chk_array,
						success:function(html){
							$('#myModal').modal('hide');
							$('#display_data_for_update').html(html);

						}
					});

	});

 $(document).on("click", ".send_to_lab", function () {
	var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job To Submit?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=send_estimate_to_lab&clicked_id='+clicked_id,
        success:function(html){
			//window.location.href="<?php echo $base_url; ?>job_listing_for_second_reception.php";
			location.reload();

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
