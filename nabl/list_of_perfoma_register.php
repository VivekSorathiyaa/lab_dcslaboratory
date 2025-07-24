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
		Perfoma Register
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
									<label>Bill Amount:</label>
									</div>
							</div>
							<div class="row">
							     <div class="col-md-3">
									<select name="sel_agency_ids" id="sel_agency_ids" class="form-control select2" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 230px;">
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
									<input type="text" name="perfoma_no" id="perfoma_no" placeholder="Enter Perfoma No" class="form-control">
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
									<input type="text" name="bill_amnt_id" id="bill_amnt_id" placeholder="Enter Bill Amount" class="form-control">
								 </div>
							</div>

							<div class="row">
									<div class="col-md-3">
									<label>Cheque No:</label>
									</div>
									<div class="col-md-3">
									<label>Bank Name:</label>
									</div>
									<div class="col-md-3">
									<label>Tds:</label>
									</div>
									<div class="col-md-3">
									<label>Paid Amount:</label>
									</div>
							</div>
							<div class="row">
							     <div class="col-md-3">
									<input type="text" name="cheque_no" id="cheque_no" placeholder="Enter Cheque No" class="form-control">
								 </div>
								 <div class="col-md-3">
									<input type="text" name="bank_name" id="bank_name" placeholder="Enter Bank Name" class="form-control">
								 </div>
								 <div class="col-md-3">
									<input type="text" name="tds_amt" id="tds_amt" placeholder="Enter Tds Amount" class="form-control">
								 </div>
								 <div class="col-md-3">
									<input type="text" name="paid_amt" id="paid_amt" placeholder="Enter Paid Amount" class="form-control">
								 </div>
							</div>

							<div class="row">
									<div class="col-md-3">
									<label>Cheque Amount:</label>
									</div>
									<div class="col-md-3">
									<label>Remarks:</label>
									</div>
							</div>
							<div class="row">
							     <div class="col-md-3">
									<input type="text" name="cheque_amt" id="cheque_amt" placeholder="Enter Cheque Amount" class="form-control">
								 </div>
								 <div class="col-md-3">
									<input type="text" name="remarks" id="remarks" placeholder="Enter Remarks" class="form-control">
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
										<th style="text-align:center;">Perfoma Date</th>
										<th style="text-align:center;">Agency No</th>
										<th style="text-align:center;">Perfoma No</th>
										<th style="text-align:center;">Name of Department</th>

										<th style="text-align:center;">Bill Amount</th>
										<th style="text-align:center;">Cheque Date</th>
										<th style="text-align:center;">Cheque No.</th>
										<th style="text-align:center;">Bank Name</th>
										<th style="text-align:center;">TDS</th>
										<th style="text-align:center;">Paid Amount</th>
										<th style="text-align:center;">Remarks</th>
										<th style="text-align:center;">Cheque Amount</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from estimate_total_span WHERE `est_isdeleted`=0  AND `perfoma_completed_by_biller`='1' ORDER BY est_id DESC LIMIT 0,200";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											$sel_agency_id=$row["agency_id"];
											$sel_agency="select * from agency_master where `agency_id`=".$sel_agency_id;

											$get_one_trf_no=explode(",",$row['trf_no']);
											$one_trf_no=$get_one_trf_no[0];
											$query_job="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' ORDER BY job_id DESC";
											if($row["nabl_type"]=="nabl")
											{
												$result_job =mysqli_query($conn,$query_job);
												$result_agency =mysqli_query($conn,$sel_agency);
											}
											else
											{
												$result_job =mysqli_query($conn_of_non,$query_job);
												$result_agency =mysqli_query($conn_of_non,$sel_agency);

											}
											$row_job =mysqli_fetch_array($result_job);
											$clientname=$row_job["clientname"];
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];
											$name_of_work= strip_tags(html_entity_decode($row_job["nameofwork"]),"<strong><em>");

											if($row["perfoma_type"]=="direct_perfoma" || $row["perfoma_type"]=="direct_perfoma_excel")
											{
												$clientname=$row['customer_name'];
											}

									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php
											$date = new DateTime($row['estimate_date']);
											echo $date->format('d-m-Y');
											?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["perfoma_no"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $clientname;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["total_amt"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php
											$c_date = new DateTime($row['ch_date']);
											echo $c_date->format('d-m-Y');
											?>
											</td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["chequeno"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["bank_name"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["tds"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["paid_amt"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["remarks"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["cheque_amt"];?></td>

											<td style="text-align:center;">

											<?php
											//if perfoma type is excel then only excel button view
											//if($row["perfoma_type"]=="excel")
											//{
										    ?>
										<!--	<a href="span_perfoma_excel_upload.php?chk_array=<?php// echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(E) perfoma Excel</a>

											<a href="span_invoice_excel_upload.php?chk_array=<?php //echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(E) Invoice Excel</a>
											&nbsp;
											<?php
											//}else
											//{
											?>
											<?php
                                            //if($row["perfoma_type"]=="direct_perfoma")
											//{
											?>
											<a href="span_edit_new_perfoma.php?perfoma_no=<?php //echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D) perfoma</a>
											&nbsp;

											<a href="span_set_rate_only_by_test_of_direct_perfoma.php?perfoma_no=<?php //echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D) Invoice By Test</a>

											<a href="span_set_rate_only_by_material_direct_perfoma.php?perfoma_no=<?php //echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D) Invoice By Material</a>

											<a href="span_set_rate_only_for_estimate_direct_perfoma.php?perfoma_no=<?php //echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D) Estimate</a>

											<?php
											//}
											//else
											//{
											?>
											<a href="span_set_rate_merging_perfoma.php?chk_array=<?php//echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> perfoma</a>
											&nbsp;

											<a href="span_set_rate_only_by_test_merging.php?chk_array=<?php// echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Invoice By Test</a>

											<a href="span_set_rate_only_by_material_merging.php?chk_array=<?php //echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Invoice By Material</a>

											<a href="span_set_rate_only_for_estimate_merging.php?chk_array=<?php// echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Estimate</a>
											<?php
											//}
											//}
											//if($row["perfoma_type"] !="direct_perfoma")
											//{
											?>
											<a href="list_of_multi_trf.php?chk_array=<?php //echo $row['trf_no'];?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
											&nbsp;
											<?php
											//}
											?>
											<a href="javascript:void(0);" class="btn btn-primary btn-lg btn3d get_peroma_for_edit" data-id="<?php //echo $row['est_id'];?>"  title="Merge" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-question-ok"></span>Edit</a>-->

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

$(".search_job_by_agency").click(function()
{

	var sel_agency_ids = $('#sel_agency_ids').val();
	var perfoma_no = $('#perfoma_no').val();
	var customer_name = $('#search_customer_name').val();
	var bill_amnt_id = $('#bill_amnt_id').val();
	var cheque_no = $('#cheque_no').val();
	var bank_name = $('#bank_name').val();
	var tds_amt = $('#tds_amt').val();
	var paid_amt = $('#paid_amt').val();
	var cheque_amt = $('#cheque_amt').val();
	var remarks = $('#remarks').val();

	if(sel_agency_ids =="" && perfoma_no =="" && customer_name =="" && bill_amnt_id =="" && cheque_no =="" && bank_name =="" && tds_amt =="" && paid_amt =="" && cheque_amt =="" && remarks =="")
	{
		alert("Please Atlist One select");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&sel_agency_ids='+sel_agency_ids+'&perfoma_no='+perfoma_no+'&customer_name='+customer_name+'&bill_amnt_id='+bill_amnt_id+'&cheque_no='+cheque_no+'&bank_name='+bank_name+'&tds_amt='+tds_amt+'&paid_amt='+paid_amt+'&cheque_amt='+cheque_amt+'&remarks='+remarks;

		$.ajax({
			url : "<?php echo $base_url; ?>search_perfoma_register.php",
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
