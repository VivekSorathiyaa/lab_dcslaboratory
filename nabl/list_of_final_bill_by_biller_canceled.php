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
		List Of Cancel Bill
		</h1>
	</div>
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				<div class="box-body">

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

										$query="select * from estimate_total_span_bill_sequence WHERE `is_deleted`=1 ORDER BY bill_id DESC";
										$result=mysqli_query($conn,$query);
										if(mysqli_num_rows($result)>0)
										{
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											$estimate_type=$row["estimate_type"];
											// data get from estimate by estimate_test table
											$what="";
											if($estimate_type=="for_test" || $estimate_type=="for_invoice_excel" || $estimate_type=="for_test_direct_perfoma")
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

											if($row["nabl_type"]=="nabl")
											{
											$get_one_trf_no=explode(",",$row['trf_no']);
											$one_trf_no=$get_one_trf_no[0];
											$query_job="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' ORDER BY job_id DESC";
											$result_job =mysqli_query($conn,$query_job);
											}
											else
											{
											$get_one_trf_no=explode(",",$row['trf_no']);
											$one_trf_no=$get_one_trf_no[0];

											$get_one_temporary_trf_no=explode(",",$row['temporary_trf_no']);
											$one_temporary_trf_no=$get_one_temporary_trf_no[0];
											$query_job="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' AND `temporary_trf_no`='$one_temporary_trf_no' ORDER BY job_id DESC";
											$result_job =mysqli_query($conn_of_non,$query_job);
											}

											$row_job =mysqli_fetch_array($result_job);
											$clientname=$row_job["clientname"];

											if($invoice_type=="direct_perfoma" || $invoice_type=="direct")
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

											<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d restore_bill_by_id" data-id="<?php echo $row['bill_no']?>"  title="Merge"><span class="glyphicon glyphicon-question-ok"></span>Restore</a>
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



$(document).on("click", ".restore_bill_by_id", function () {
		var abc = $(this).attr('data-id');
		$.confirm({
        title: "warning",
        content: "Are You Sure To Restore This Bill ?",
        buttons: {
			confirm: function () {
		          $.ajax({
						type: 'POST',
						url: '<?php $base_url; ?>save_span_perfoma_excel_upload.php',
						data: 'action_type=restore_bill_by_id&abc='+abc,
						success:function(html){
							window.location.href="<?php echo $base_url; ?>list_of_final_bill_by_biller_canceled.php";
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
