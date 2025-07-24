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
		List Of Bill
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
									<label>Old Bill No:</label>
									</div>
									<div class="col-md-3">
									<label>Bill No:</label>
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
									<input type="text" name="search_old_bill_no" id="search_old_bill_no" placeholder="Enter Old Bill No" class="form-control">
								 </div>

								 <div class="col-md-3">
									<input type="text" name="search_bill_no" id="search_bill_no" placeholder="Enter Bill No" class="form-control">
								 </div>

								 <div class="col-md-3">
									<input type="text" name="search_bill_amnt_id" id="search_bill_amnt_id" placeholder="Enter Bill Amount" class="form-control">
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
									<input type="text" name="search_cheque_no" id="search_cheque_no" placeholder="Enter Cheque No" class="form-control">
								 </div>
								 <div class="col-md-3">
									<input type="text" name="search_bank_name" id="search_bank_name" placeholder="Enter Bank Name" class="form-control">
								 </div>
								 <div class="col-md-3">
									<input type="text" name="search_tds_amt" id="search_tds_amt" placeholder="Enter Tds Amount" class="form-control">
								 </div>
								 <div class="col-md-3">
									<input type="text" name="search_paid_amt" id="search_paid_amt" placeholder="Enter Paid Amount" class="form-control">
								 </div>
							</div>

							<div class="row">
									<div class="col-md-3">
									<label>Cheque Amount:</label>
									</div>
									<div class="col-md-3">
									<label>Remarks:</label>
									</div>
									<div class="col-md-3">
									<label>Customer Name:</label>
									</div>
							</div>
							<div class="row">
							     <div class="col-md-3">
									<input type="text" name="search_cheque_amt" id="search_cheque_amt" placeholder="Enter Cheque Amount" class="form-control">
								 </div>
								 <div class="col-md-3">
									<input type="text" name="search_remarks" id="search_remarks" placeholder="Enter Remarks" class="form-control">
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
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Agency Name</th>
										<th style="text-align:center;">Old Bill No</th>
										<th style="text-align:center;">Bill No</th>
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

										$query="select * from estimate_total_span_bill_sequence WHERE `is_deleted`=0 ORDER BY bill_id DESC";
										$result=mysqli_query($conn,$query);
										if(mysqli_num_rows($result)>0)
										{
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											$estimate_type=$row["estimate_type"];
											// data get from estimate by estimate_test table
											$what="";
											if($estimate_type=="for_test" || $estimate_type=="for_invoice_excel" || $estimate_type=="for_test_direct_perfoma" || $estimate_type=="direct_perfoma_excel")
											{
												$sel_test_table="select * from estimate_total_span_only_for_test where `est_isdeleted`=0 AND `bill_no`='$row[bill_no]'";
												$result_test_table =mysqli_query($conn,$sel_test_table);
												$row_test =mysqli_fetch_array($result_test_table);

												$agency_id=$row_test["agency_id"];
												$bill_amt=$row_test["total_amt"];
												$old_bill_no=$row_test["old_bill_no"];
												$cheque_date=$row_test["ch_date"];
												$cheque_no=$row_test["chequeno"];
												$bank_name=$row_test["bank_name"];
												$tds=$row_test["tds"];
												$paid_amt=$row_test["paid_amt"];
												$remarks=$row_test["remarks"];
												$cheque_amt=$row_test["cheque_amt"];
												$invoice_type=$row_test["invoice_type"];
												$excel_upload=$row_test["invoice_excel_upload"];
												$trf_no=$row_test["trf_no"];
												$perfoma_no=$row_test["perfoma_no"];
												$customer_name=$row_test["customer_name"];
												$est_id=$row_test["est_id"];
												$table_type="test";
												$what="test_mathi";
											}
											// data get from estimate by estimate_materials table
											if($estimate_type=="for_material" || $estimate_type=="for_material_direct_perfoma")
											{
												$sel_mat_table="select * from estimate_total_span_only_for_material where `est_isdeleted`=0 AND `bill_no`='$row[bill_no]'";
												$result_mat_table =mysqli_query($conn,$sel_mat_table);
												$row_mat =mysqli_fetch_array($result_mat_table);

												$agency_id=$row_mat["agency_id"];
												$bill_amt=$row_mat["total_amt"];
												$old_bill_no=$row_mat["old_bill_no"];
												$cheque_date=$row_mat["ch_date"];
												$cheque_no=$row_mat["chequeno"];
												$bank_name=$row_mat["bank_name"];
												$tds=$row_mat["tds"];
												$paid_amt=$row_mat["paid_amt"];
												$remarks=$row_mat["remarks"];
												$cheque_amt=$row_mat["cheque_amt"];
												$invoice_type=$row_mat["invoice_type"];
												$excel_upload="";
												$trf_no=$row_mat["trf_no"];
												$perfoma_no=$row_mat["perfoma_no"];
												$customer_name=$row_mat["customer_name"];
												$est_id=$row_mat["est_id"];
												$table_type="material";
												$what="mat_mathi";
											}

											$sel_agency="select * from agency_master where `agency_id`=".$agency_id;
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];

											$explode_trf=explode(",",$trf_no);
											$set_trf_no=$explode_trf[0];
											$sel_jobs="select * from job where `trf_no`='$set_trf_no'";
											$result_job=mysqli_query($conn,$sel_jobs);
											$row_job =mysqli_fetch_array($result_job);
											$clientname=$row_job["clientname"];

											if($invoice_type=="direct_perfoma" || $invoice_type=="direct" || $invoice_type=="excel_direct_Perfoma")
											{
												$clientname=$customer_name;
											}

									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;"><?php echo $row["estimate_date"];?></td>
											<td style="text-align:center;"><?php echo $agency_name;?></td>
											<td style="text-align:center;"><?php echo $old_bill_no;?></td>
											<td style="text-align:center;"><?php echo $row["bill_no"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $clientname;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $bill_amt;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_date;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_no;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $bank_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $tds;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $paid_amt;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $remarks;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_amt;?></td>

											<td style="text-align:center;">

											<?php
											//if invoice type is excel then only excel button view
											if($invoice_type=="excel_direct_Perfoma")
											{
										    ?>
											<a href="span_edit_direct_perfoma_excel_upload.php??perfoma_no=<?php echo $row['perfoma_no'];?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Edit Bill</a>
											&nbsp;

											<a href="invoice_excel/<?php echo $excel_upload;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Excel Print</a>


											<?php
											}

											if($invoice_type=="excel")
											{
										    ?>
											<a href="span_invoice_excel_upload.php?chk_array=<?php echo $trf_no;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Edit Bill</a>
											&nbsp;

											<a href="invoice_excel/<?php echo $excel_upload;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Excel Print</a>
											&nbsp;
											<a href="list_of_multi_trf.php?chk_array=<?php echo $trf_no;?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>

											<?php
											}
											if($invoice_type=="regular")
											{
												if($table_type=="test")
											     {
											?>
												<a href="span_set_rate_only_by_test_merging.php?chk_array=<?php echo $trf_no;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Edit_ Bill</a>

												<a href="matt_invoice_bill_by_test_print.php?chk_array=<?php echo $trf_no;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Re Test Print</a>

												<a href="list_of_multi_trf.php?chk_array=<?php echo $trf_no;?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
											<?php
											     }
											     if($table_type=="material")
											     {
											?>
												<a href="span_set_rate_only_by_material_merging.php?chk_array=<?php echo $trf_no;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Edit Bill</a>

												<a href="matt_invoice_bill_by_material_print.php?chk_array=<?php echo $trf_no;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Re Material Print</a>

												<a href="list_of_multi_trf.php?chk_array=<?php echo $trf_no;?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
											<?php
											     }
											}
											if($invoice_type=="direct_perfoma" || $invoice_type=="direct")
											{
											     if($table_type=="test")
											     {
											?>
												<a href="span_set_rate_only_by_test_of_direct_perfoma.php?perfoma_no=<?php echo $perfoma_no;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Edit Bill</a>

												<a href="matt_invoice_bill_by_test_direct_perfoma_print.php?perfoma_no=<?php echo $perfoma_no;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Di test Print</a>
											<?php
											     }
											     if($table_type=="material")
											     {
											?>
												<a href="span_set_rate_only_by_material_direct_perfoma.php?perfoma_no=<?php echo $perfoma_no;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Edit Bill</a>

												<a href="matt_invoice_bill_by_material_direct_perfoma_print.php?perfoma_no=<?php echo $perfoma_no;?>" class="btn btn-info btn-lg btn3d" title=""target="_blank"><span class="glyphicon glyphicon-question-list" ></span> Di mate Print</a>
											<?php
											     }
											}
											?>
												<a href="javascript:void(0);" class="btn btn-primary btn-lg btn3d get_bill_for_edit" data-id="<?php echo $what."|".$est_id;?>"  title="Merge" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-question-ok"></span>Edit</a>

												<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d cancel_bill_by_id" data-id="<?php echo $row['bill_no']?>"  title="Merge"><span class="glyphicon glyphicon-question-ok"></span>Cancel</a>
											&nbsp;
											</td>
										</tr>
									<?php
										}
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 90%;">

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

$(document).on("click", ".get_bill_for_edit", function () {
		var abc = $(this).attr('data-id');
		          $.ajax({
						type: 'POST',
						url: '<?php $base_url; ?>save_span_perfoma_excel_upload.php',
						data: 'action_type=get_bill_for_edit&abc='+abc,
						success:function(html){
							$('#display_data_for_update').html(html);
						}
					});
	});

$(document).on("click", ".cancel_bill_by_id", function () {
		var abc = $(this).attr('data-id');
		$.confirm({
        title: "warning",
        content: "Are You Sure To Cancel This Bill ?",
        buttons: {
			confirm: function () {
		          $.ajax({
						type: 'POST',
						url: '<?php $base_url; ?>save_span_perfoma_excel_upload.php',
						data: 'action_type=cancel_bill_by_id&abc='+abc,
						success:function(html){
							window.location.href="<?php echo $base_url; ?>superadmin_pending_bills_of_biller.php";
						}
					});
					},
            cancel: function () {
				return;
            }
			}
        })
	});

$(document).on("click", ".update_bill_by_id", function () {

   var cheque_date=$("#cheque_date").val();
   var chequeno=$("#chequeno").val();
   var bank_name=$("#bank_name").val();
   var old_bill_no=$("#old_bill_no").val();
   var bill_amt=$("#bill_amt").val();
   var tds=$("#tds").val();
   var paid_amt=$("#paid_amt").val();
   var remarks=$("#remarks").val();
   var cheque_amt=$("#cheque_amt").val();
   var hidden_what_and_ids=$("#hidden_what_and_ids").val();

	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_perfoma_excel_upload.php',
        data: 'action_type=update_bill_by_id&&cheque_date='+cheque_date+'&chequeno='+chequeno+'&bank_name='+bank_name+'&old_bill_no='+old_bill_no+'&bill_amt='+bill_amt+'&tds='+tds+'&paid_amt='+paid_amt+'&remarks='+remarks+'&cheque_amt='+cheque_amt+'&hidden_what_and_ids='+hidden_what_and_ids,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>superadmin_pending_bills_of_biller.php";

        }
    });

});

$(document).on("change", "input[name='gst_type']", function () {

		var gst_type=$( 'input[name=gst_type]:checked' ).val();
		var bill_amnts=$('#bill_amt').val();
		$('#tds_percent').val("0");

		if(gst_type=="direct"){

			$('#grand_total').val(bill_amnts);
		}
		if(gst_type=="cut_gst"){
			var gst_amt= (+bill_amnts)/1.18;
			//var grands_total= (+bill_amnts)-(+gst_amt);
			$('#grand_total').val(gst_amt.toFixed(2));
		}
});

$(document).on("change", "#tds_percent", function () {

		var bill_amnts=$('#bill_amt').val();
		var grand_total=$('#grand_total').val();
		var tds_percent=$('#tds_percent').val();

		var tds_amt= (+grand_total)*(+tds_percent)/100;
		$('#tds').val(tds_amt);
		var get_tds= $('#tds').val();
		var paid_total=(+bill_amnts)-(+get_tds);
		$('#paid_amt').val(paid_total.toFixed());
});

$(".search_job_by_agency").click(function()
{

	var sel_agency_ids = $('#sel_agency_ids').val();
	var old_bill_no = $('#search_old_bill_no').val();
	var bill_no = $('#search_bill_no').val();
	var bill_amnt_id = $('#search_bill_amnt_id').val();
	var cheque_no = $('#search_cheque_no').val();
	var bank_name = $('#search_bank_name').val();
	var tds_amt = $('#search_tds_amt').val();
	var paid_amt = $('#search_paid_amt').val();
	var cheque_amt = $('#search_cheque_amt').val();
	var remarks = $('#search_remarks').val();
    var customer_name = $('#search_customer_name').val();

	if(sel_agency_ids =="" && old_bill_no =="" && bill_no =="" && bill_amnt_id =="" && cheque_no =="" && bank_name =="" && tds_amt =="" && paid_amt =="" && cheque_amt =="" && remarks =="" && customer_name =="")
	{
		alert("Please Atlist One select");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&sel_agency_ids='+sel_agency_ids+'&old_bill_no='+old_bill_no+'&bill_no='+bill_no+'&bill_amnt_id='+bill_amnt_id+'&cheque_no='+cheque_no+'&bank_name='+bank_name+'&tds_amt='+tds_amt+'&paid_amt='+paid_amt+'&cheque_amt='+cheque_amt+'&remarks='+remarks+'&customer_name='+customer_name;

		$.ajax({
			url : "<?php echo $base_url; ?>search_list_of_final_bill_by_biller.php",
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
