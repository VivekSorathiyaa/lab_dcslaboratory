<!-- DataTables -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php
session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'search') {

		$todate = $_POST["todate"];
		$fromdate = $_POST["fromdate"];

		if ($fromdate != "") {
			$ref_dayc1_0 = substr($fromdate, 0, 2);
			$ref_monthc1_0 = substr($fromdate, 3, 2);
			$ref_yearc1_0 = substr($fromdate, 6, 4);
			$fromdate_new = $ref_yearc1_0 . "-" . $ref_monthc1_0 . "-" . $ref_dayc1_0;
		} else {
			$fromdate_new = "";
		}

		if ($todate != "") {
			$ref_dayc1_1 = substr($todate, 0, 2);
			$ref_monthc1_1 = substr($todate, 3, 2);
			$ref_yearc1_1 = substr($todate, 6, 4);
			$todate_new = $ref_yearc1_1 . "-" . $ref_monthc1_1 . "-" . $ref_dayc1_1;
		} else {
			$todate_new = "";
		}
		$where = "";
		if ($fromdate_new != "" && $todate_new != "") {
			$where .= " AND (created_date BETWEEN '$fromdate_new' AND '$todate_new')";
		} else if ($fromdate_new != "") {
			$where .= " AND (created_date > '$fromdate_new')";
		} else if ($fromdate_new != "") {
			$where .= " AND (created_date < '$todate_new')";
		} else {
			$where .= "";
		}

?>


		<!--<a href="<?php //echo $base_url;
						?>set_material_print.php?sel_material=<?php //echo $sel_material;
																					?>&&todate=<?php //echo $todate;
																															?>&&fromdate=<?php //echo $fromdate;
																																							?>" target="_blank" class="btn btn-primary">PRINT</a>-->

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
				$count = 0;

				$query = "select * from estimate_total_span_bill_sequence WHERE `is_deleted`=0" . $where;
				$result = mysqli_query($conn, $query);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_array($result)) {
						$count++;
						$estimate_type = $row["estimate_type"];
						// data get from estimate by estimate_test table
						$what = "";
						if ($estimate_type == "for_test" || $estimate_type == "for_invoice_excel" || $estimate_type == "for_test_direct_perfoma" || $estimate_type == "direct_perfoma_excel") {
							$sel_test_table = "select * from estimate_total_span_only_for_test where `est_isdeleted`=0 AND `bill_no`='$row[bill_no]'";
							$result_test_table = mysqli_query($conn, $sel_test_table);
							$row_test = mysqli_fetch_array($result_test_table);

							$agency_id = $row_test["agency_id"];
							$bill_amt = $row_test["total_amt"];
							$old_bill_no = $row_test["old_bill_no"];
							$cheque_date = $row_test["ch_date"];
							$cheque_no = $row_test["chequeno"];
							$bank_name = $row_test["bank_name"];
							$tds = $row_test["tds"];
							$paid_amt = $row_test["paid_amt"];
							$remarks = $row_test["remarks"];
							$cheque_amt = $row_test["cheque_amt"];
							$invoice_type = $row_test["invoice_type"];
							$excel_upload = $row_test["invoice_excel_upload"];
							$trf_no = $row_test["trf_no"];
							$perfoma_no = $row_test["perfoma_no"];
							$customer_name = $row_test["customer_name"];
							$est_id = $row_test["est_id"];
							$table_type = "test";
							$what = "test_mathi";
						}
						// data get from estimate by estimate_materials table
						if ($estimate_type == "for_material" || $estimate_type == "for_material_direct_perfoma") {
							$sel_mat_table = "select * from estimate_total_span_only_for_material where `est_isdeleted`=0 AND `bill_no`='$row[bill_no]'";
							$result_mat_table = mysqli_query($conn, $sel_mat_table);
							$row_mat = mysqli_fetch_array($result_mat_table);

							$agency_id = $row_mat["agency_id"];
							$bill_amt = $row_mat["total_amt"];
							$old_bill_no = $row_mat["old_bill_no"];
							$cheque_date = $row_mat["ch_date"];
							$cheque_no = $row_mat["chequeno"];
							$bank_name = $row_mat["bank_name"];
							$tds = $row_mat["tds"];
							$paid_amt = $row_mat["paid_amt"];
							$remarks = $row_mat["remarks"];
							$cheque_amt = $row_mat["cheque_amt"];
							$invoice_type = $row_mat["invoice_type"];
							$excel_upload = "";
							$trf_no = $row_mat["trf_no"];
							$perfoma_no = $row_mat["perfoma_no"];
							$customer_name = $row_mat["customer_name"];
							$est_id = $row_mat["est_id"];
							$table_type = "material";
							$what = "mat_mathi";
						}

						$sel_agency = "select * from agency_master where `agency_id`=" . $agency_id;
						$result_agency = mysqli_query($conn, $sel_agency);
						$row_agency = mysqli_fetch_array($result_agency);
						$agency_name = $row_agency["agency_name"];

						$explode_trf = explode(",", $trf_no);
						$set_trf_no = $explode_trf[0];
						$sel_jobs = "select * from job where `trf_no`='$set_trf_no'";
						$result_job = mysqli_query($conn, $sel_jobs);
						$row_job = mysqli_fetch_array($result_job);
						$clientname = $row_job["clientname"];

						if ($invoice_type == "direct_perfoma" || $invoice_type == "direct" || $invoice_type == "excel_direct_Perfoma") {
							$clientname = $customer_name;
						}

				?>
						<tr>
							<td style="text-align:center;"><?php echo $count; ?></td>
							<td style="text-align:center;"><?php echo $row["estimate_date"]; ?></td>
							<td style="text-align:center;"><?php echo $agency_name; ?></td>
							<td style="text-align:center;"><?php echo $old_bill_no; ?></td>
							<td style="text-align:center;"><?php echo $row["bill_no"]; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $clientname; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $bill_amt; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_date; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_no; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $bank_name; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $tds; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $paid_amt; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $remarks; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_amt; ?></td>

							<td style="text-align:center;">

								<?php
								//if invoice type is excel then only excel button view
								if ($invoice_type == "excel_direct_Perfoma") {
								?>
									<a href="span_edit_direct_perfoma_excel_upload.php??perfoma_no=<?php echo $row['perfoma_no']; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Edit Bill</a>
									&nbsp;

									<a href="invoice_excel/<?php echo $excel_upload; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Excel Print</a>


									<?php
								}

								if ($invoice_type == "excel") {
									if ($row["temporary_trf_no"] == NULL || $row["temporary_trf_no"] == "") {
									?>
										<a href="span_invoice_excel_upload.php?chk_array=<?php echo $trf_no; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Edit Bill</a>
										&nbsp;

										<a href="invoice_excel/<?php echo $excel_upload; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Excel Print</a>
										&nbsp;
										<a href="list_of_multi_trf.php?chk_array=<?php echo $trf_no; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>

									<?php
									} else {
									?>
										<a href="non_nabl_span_invoice_excel_upload.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Edit Bill</a>
										&nbsp;

										<a href="invoice_excel/<?php echo $excel_upload; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Excel Print</a>
										&nbsp;
										<a href="non_nabl_list_of_multi_trf.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>

										<?php
									}
								}
								if ($invoice_type == "regular") {
									if ($table_type == "test") {
										if ($row["temporary_trf_no"] == NULL || $row["temporary_trf_no"] == "") {
										?>
											<a href="span_set_rate_only_by_test_merging.php?chk_array=<?php echo $trf_no; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Edit_ Bill</a>

											<a href="matt_invoice_bill_by_test_print.php?chk_array=<?php echo $trf_no; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Re Test Print</a>

											<a href="list_of_multi_trf.php?chk_array=<?php echo $trf_no; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
										<?php
										} else {
										?>
											<a href="non_nabl_span_set_rate_only_by_test_merging.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Edit_ Bill</a>

											<a href="non_nabl_matt_invoice_bill_by_test_print.php?chk_array=<?php echo $trf_no; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Re Test Print</a>

											<a href="non_nabl_list_of_multi_trf.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
										<?php
										}
									}
									if ($table_type == "material") {
										if ($row["temporary_trf_no"] == NULL || $row["temporary_trf_no"] == "") {
										?>
											<a href="span_set_rate_only_by_material_merging.php?chk_array=<?php echo $trf_no; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Edit Bill</a>

											<a href="matt_invoice_bill_by_material_print.php?chk_array=<?php echo $trf_no; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Re Material Print</a>

											<a href="list_of_multi_trf.php?chk_array=<?php echo $trf_no; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
										<?php
										} else {
										?>
											<a href="non_nabl_span_set_rate_only_by_material_merging.php.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Edit Bill</a>

											<a href="non_nabl_matt_invoice_bill_by_material_print.php?chk_array=<?php echo $trf_no; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Re Material Print</a>

											<a href="non_nabl_list_of_multi_trf.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
										<?php
										}
									}
								}
								if ($invoice_type == "direct_perfoma" || $invoice_type == "direct") {
									if ($table_type == "test") {
										?>
										<a href="span_set_rate_only_by_test_of_direct_perfoma.php?perfoma_no=<?php echo $perfoma_no; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Edit Bill</a>

										<a href="matt_invoice_bill_by_test_direct_perfoma_print.php?perfoma_no=<?php echo $perfoma_no; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Di test Print</a>
									<?php
									}
									if ($table_type == "material") {
									?>
										<a href="span_set_rate_only_by_material_direct_perfoma.php?perfoma_no=<?php echo $perfoma_no; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Edit Bill</a>

										<a href="matt_invoice_bill_by_material_direct_perfoma_print.php?perfoma_no=<?php echo $perfoma_no; ?>" class="btn btn-info btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Di mate Print</a>
								<?php
									}
								}
								?>
								<a href="javascript:void(0);" class="btn btn-primary btn-lg btn3d get_bill_for_edit" data-id="<?php echo $what . "|" . $est_id; ?>" title="Merge" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-question-ok"></span>Edit</a>


								&nbsp;
							</td>
						</tr>
				<?php
					}
				}

				?>
			</tbody>

		</table>
<?php
	}
}
?>
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
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
<script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
	$(document).ready(function() {
		var table = $('#example2').DataTable({
			'autoWidth': true,
			'scrollX': true,
			buttons: ['copy'],
			dom: 'Bfrtip',
			buttons: [

				{
					extend: 'excel',
					footer: true,
				}
			],
		});

		$(function() {
			$('.select2').select2();
		})

	});

	$(document).on("click", ".get_bill_for_edit", function() {
		var abc = $(this).attr('data-id');
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_perfoma_excel_upload.php',
			data: 'action_type=get_bill_for_edit&abc=' + abc,
			success: function(html) {
				$('#display_data_for_update').html(html);
			}
		});
	});
</script>
