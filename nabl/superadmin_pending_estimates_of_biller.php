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
font-size: 20px;
height: 50px;
}





</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">


<section class="content"  style="padding: 0px;margin-right: auto;margin-left: auto; padding-left: 0px; padding-right: 0px; ">
<?php include("menu.php") ?>

	<div class="row">

		<h1 style="text-align:center;">
		List Of Completed Perfoma
	<a href="span_add_new_perfoma.php" class="btn btn-info btn-lg btn3d pull-right" style="margin-right:20px;margin-bottom: 20px;" title="Add Direct Perfoma"><span class="glyphicon glyphicon-question-list"></span>ADD DIRECT PERFOMA</a>
		</h1>
	</div>
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				<div class="box-body">
					<a data-toggle="collapse" href="#collapse1" class="btn btn-primary" style="margin-left:45%;width:3%;;" id="add_material_button"><i class="fa fa-search" aria-hidden="true"></i></a>
						<br>
						<br>
						<div id="collapse1" class="panel-collapse collapse">
							<div class="row">
									<div class="col-md-3">
									<label>Agency:</label>
									</div>
									<div class="col-md-3">
									<label>Perfoma No:</label>
									</div>
									<div class="col-md-3">
									<label>Customer Name:</label>
									</div>
									<div class="col-md-3">
									<label>Agreement No:</label>
									</div>
							</div>
							<div class="row">
							     <div class="col-md-3">
									<select name="search_sel_agency_ids" id="search_sel_agency_ids" class="form-control select2" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 230px;">
									<option value="">Select-Agency</option>
									<?php
									$sel_agencys="select * from agency_master where `isdeleted`=0";
									$query_agencys = mysqli_query($conn, $sel_agencys);
									if(mysqli_num_rows($query_agencys)> 0)
									{
									while($get_one_agency=mysqli_fetch_array($query_agencys))
									{ ?>
								    <option value="<?php echo $get_one_agency['agency_id'];?>"><?php echo $get_one_agency['agency_name'];?></option>
									<?php } }?>
									</select>
								 </div>
								 <div class="col-md-3">
									<input type="text" name="search_perfoma_no" id="search_perfoma_no" placeholder="Enter Perfoma No" class="form-control">
								 </div>

								 <div class="col-md-3">
									<select name="search_customer_name" id="search_customer_name" class="form-control select2" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 230px;">
									<option value="">Select-Customer</option>
									<?php
									$sel_client="select * from client where `clientisdeleted`=0";
									$query_client = mysqli_query($conn, $sel_client);
									if(mysqli_num_rows($query_client)> 0)
									{
									while($get_one_client=mysqli_fetch_array($query_client))
									{ ?>
								    <option value="<?php echo $get_one_client['client_code'];?>"><?php echo $get_one_client['clientname'];?></option>
									<?php } }?>
									</select>
								 </div>

								 <div class="col-md-3">
									<input type="text" name="search_agree_no" id="search_agree_no" placeholder="Enter Agreement No" class="form-control">
								 </div>
							</div>
							<div class="row">
								<div class="col-md-5">
								</div>
								<div class="col-md-3">
									<a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_agency" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> Search</a>
									<a href="javascript:void(0);" class="btn btn-primary" onclick="location.reload()" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> View All</a>
								</div>
							</div>
						</div>
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Type</th>
										<th style="text-align:center;">S.R.F. No</th>
										<th style="text-align:center;">Job No</th>
										<th style="text-align:center;">Name Of Customer</th>
										<th style="text-align:center;">Agency No</th>
										<th style="text-align:center;">Perfoma No</th>
										<th style="text-align:center;">Agreement No</th>
										<th style="text-align:center;">Perfoma Date</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										//$query="select * from job WHERE `jobisdeleted`=0 AND `job_for_rec_and_biller`=1 AND `perfoma_completed_by_biller`=1 ORDER BY job_id DESC";
										$query="select * from estimate_total_span WHERE `est_isdeleted`=0  AND `perfoma_completed_by_biller`='0' ORDER BY est_id DESC LIMIT 0,200";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											$sel_agency_id=$row["agency_id"];
											$sel_agency="select * from agency_master where `agency_id`=".$sel_agency_id;
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];

											$get_one_trf_no=explode(",",$row['trf_no']);
											$one_trf_no=$get_one_trf_no[0];
											$query_job="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' ORDER BY job_id DESC";
											$result_job =mysqli_query($conn,$query_job);
											$row_job =mysqli_fetch_array($result_job);
											$customer_name=$row_job['clientname'];
											if($row["perfoma_type"]=="direct_perfoma")
											{
												$customer_name=$row['customer_name'];
											}

											$name_of_work= strip_tags(html_entity_decode($row_job["nameofwork"]),"<strong><em>");

											if($row['make_test_bill']=="1"){ $make_test_bill='<img src="images/green_dot.png">';}else { $make_test_bill="";}
											if($row['make_material_bill']=="1"){ $make_material_bill='<img src="images/green_dot.png">';}else { $make_material_bill="";}
											if($row['make_estimate']=="1"){ $make_estiamte='<img src="images/green_dot.png">';}else { $make_estiamte="";}

									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;">
											<?php
											//if perfoma type is excel then only excel button view
											if($row["perfoma_type"]=="excel")
											{
												echo "EXCEL";
											}
											if($row["perfoma_type"]=="direct_perfoma")
											{
												echo "DIRECT PERFOMA";
											}
											if($row["perfoma_type"] != "excel" && $row["perfoma_type"]!= "direct_perfoma" && $row["perfoma_type"] != "direct_perfoma_excel")
											{
												echo "REGULAR";
											}
											if($row["perfoma_type"] == "direct_perfoma_excel")
											{
												echo "DIRECT PERFOMA EXCEL";
											}
										    ?>
											</td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['job_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $customer_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["perfoma_no"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row_job['agreement_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php
											$date = new DateTime($row['estimate_date']);
											echo $date->format('d-m-Y');
											?></td>
											<td style="text-align:center;">

											<?php
											//if perfoma type is excel then only excel button view
											if($row["perfoma_type"]=="direct_perfoma_excel")
											{
										    ?>
											<a href="span_edit_direct_perfoma_excel_upload.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>Direct perfoma Excel</a>

											<a href="span_invoice_excel_upload_for_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(E) Invoice Excel</a>
											&nbsp;
											<?php
											}
											else if($row["perfoma_type"]=="excel")
											{
										    ?>
											<a href="span_perfoma_excel_upload.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(E) perfoma Excel</a>

											<a href="span_invoice_excel_upload.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(E) Invoice Excel</a>
											&nbsp;
											<?php
											}else
											{
											?>
											<?php
                                            if($row["perfoma_type"]=="direct_perfoma")
											{
											?>
											<a href="span_edit_new_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D) perfoma</a>
											&nbsp;

											<a href="span_set_rate_only_by_test_of_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D)<?php echo $make_test_bill;?> Invoice By Test</a>

											<a href="span_set_rate_only_by_material_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D)<?php echo $make_material_bill;?> Invoice By Material</a>

											<a href="span_set_rate_only_for_estimate_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D)<?php echo $make_estiamte;?> Estimate</a>

											<?php
											}
											else
											{
											?>
											<a href="span_set_rate_merging_perfoma.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> perfoma</a>
											&nbsp;

											<a href="span_set_rate_only_by_test_merging.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span><?php echo $make_test_bill;?> Invoice By Test</a>

											<a href="span_set_rate_only_by_material_merging.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span><?php echo $make_material_bill;?> Invoice By Material</a>

											<a href="span_set_rate_only_for_estimate_merging.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span><?php echo $make_estiamte;?> Estimate</a>
											<?php
											}
											}

											if($row["perfoma_type"] !="direct_perfoma" && $row["perfoma_type"] !="direct_perfoma_excel")
											{
											?>
											<a href="list_of_multi_trf.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
											&nbsp;
											<?php
											}
											?>
											<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d perfoma_complete_by_est_id" data-id="<?php echo $row['est_id'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span>Complete</a>

											<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d perfoma_cancel_by_est_id" data-id="<?php echo $row['est_id'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span>Cancel</a>



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
        'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [

            { extend: 'excel',
			  footer: true,
			}
        ],
    });
	$(function () {
		$('.select2').select2()
	})

});

$(document).on("click", ".perfoma_complete_by_est_id", function () {
				var clicked_id = $(this).attr("data-id");
	$.confirm({
        title: "warning",
        content: "Are You Sure To Complete This Perfoma ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=perfoma_complete_by_est_id&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>superadmin_pending_estimates_of_biller.php";

        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});

$(document).on("click", ".perfoma_cancel_by_est_id", function () {
				var clicked_id = $(this).attr("data-id");
	$.confirm({
        title: "warning",
        content: "Are You Sure To Cancel This Perfoma ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=perfoma_cancel_by_est_id&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>superadmin_pending_estimates_of_biller.php";

        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});

$(".search_job_by_agency").click(function()
{

	var sel_agency_ids = $('#search_sel_agency_ids').val();
	var perfoma_no = $('#search_perfoma_no').val();
	var customer_name = $('#search_customer_name').val();
	var search_agree_no = $('#search_agree_no').val();

	if(sel_agency_ids =="" && perfoma_no =="" && customer_name =="" && search_agree_no =="")
	{
		alert("Please Atlist One select");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&sel_agency_ids='+sel_agency_ids+'&perfoma_no='+perfoma_no+'&customer_name='+customer_name+'&search_agree_no='+search_agree_no;

		$.ajax({
			url : "<?php echo $base_url; ?>search_list_of_completed_perfoma_for_biller.php",
			type: "POST",
			data : postData,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success: function(data,status,  xhr)
			{
				document.getElementById("overlay_div").style.display="none";
				$("#display_data_report").html(data);
			}
			});
});

</script>
