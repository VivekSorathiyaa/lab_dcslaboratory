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
			$where .= " AND (est_createddate BETWEEN '$fromdate_new' AND '$todate_new')";
		} else if ($fromdate_new != "") {
			$where .= " AND (est_createddate > '$fromdate_new')";
		} else if ($fromdate_new != "") {
			$where .= " AND (est_createddate < '$todate_new')";
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
				$count = 0;
				//$query="select * from job WHERE `jobisdeleted`=0 AND `job_for_rec_and_biller`=1 AND `perfoma_completed_by_biller`=1 ORDER BY job_id DESC";
				$query = "select * from estimate_total_span WHERE `est_isdeleted`=0  AND `perfoma_completed_by_biller`='1'" . $where;
				$result = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_array($result)) {
					$count++;


					if ($row["nabl_type"] == "nabl") {
						$get_one_trf_no = explode(",", $row['trf_no']);
						$one_trf_no = $get_one_trf_no[0];
						$query_job = "select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' ORDER BY job_id DESC";
						$result_job = mysqli_query($conn, $query_job);

						$sel_agency_id = $row["agency_id"];
						$sel_agency = "select * from agency_master where `agency_id`=" . $sel_agency_id;
						$result_agency = mysqli_query($conn, $sel_agency);
						$row_agency = mysqli_fetch_array($result_agency);
						$agency_name = $row_agency["agency_name"];
					} else {
						$get_one_trf_no = explode(",", $row['trf_no']);
						$one_trf_no = $get_one_trf_no[0];

						$get_one_temporary_trf_no = explode(",", $row['temporary_trf_no']);
						$one_temporary_trf_no = $get_one_temporary_trf_no[0];

						$query_job = "select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' AND `temporary_trf_no`='$one_temporary_trf_no' ORDER BY job_id DESC";
						$result_job = mysqli_query($conn_of_non, $query_job);

						$sel_agency_id = $row["agency_id"];
						$sel_agency = "select * from agency_master where `agency_id`=" . $sel_agency_id;
						$result_agency = mysqli_query($conn_of_non, $sel_agency);
						$row_agency = mysqli_fetch_array($result_agency);
						$agency_name = $row_agency["agency_name"];
					}

					$row_job = mysqli_fetch_array($result_job);
					$customer_name = $row_job['clientname'];
					if ($row["perfoma_type"] == "direct_perfoma") {
						$customer_name = $row['customer_name'];
					}

					$name_of_work = strip_tags(html_entity_decode($row_job["nameofwork"]), "<strong><em>");

					if ($row['make_test_bill'] == "1") {
						$make_test_bill = '<img src="images/green_dot.png">';
					} else {
						$make_test_bill = "";
					}
					if ($row['make_material_bill'] == "1") {
						$make_material_bill = '<img src="images/green_dot.png">';
					} else {
						$make_material_bill = "";
					}
					if ($row['make_estimate'] == "1") {
						$make_estiamte = '<img src="images/green_dot.png">';
					} else {
						$make_estiamte = "";
					}

				?>
					<tr>
						<td style="text-align:center;"><?php echo $count; ?></td>
						<td style="text-align:center;">
							<?php
							//if perfoma type is excel then only excel button view
							if ($row["perfoma_type"] == "excel") {
								echo "EXCEL";
							}
							if ($row["perfoma_type"] == "direct_perfoma") {
								echo "DIRECT PERFOMA";
							}
							if ($row["perfoma_type"] != "excel" && $row["perfoma_type"] != "direct_perfoma" && $row["perfoma_type"] != "direct_perfoma_excel") {
								echo "REGULAR";
							}
							if ($row["perfoma_type"] == "direct_perfoma_excel") {
								echo "DIRECT PERFOMA EXCEL";
							}
							?>
						</td>
						<td style="white-space:nowrap;text-align:center;">
							<?php
							$explode_trf = explode(",", $row['trf_no']);
							$set_counts = 1;
							foreach ($explode_trf as $keys => $one_trfs) {
								if ($set_counts == 4) {
									echo $one_trfs . "</br>";
									$set_counts = 0;
								} else {
									echo $one_trfs . ",";
								}

								$set_counts++;
							}
							?>
						</td>
						<td style="white-space:nowrap;text-align:center;">
							<?php
							$explode_job = explode(",", $row['job_no']);
							$set_counts_job = 1;
							foreach ($explode_job as $keys => $one_jobs) {
								if ($set_counts_job == 4) {
									echo $one_jobs . "</br>";
									$set_counts_job = 0;
								} else {
									echo $one_jobs . ",";
								}

								$set_counts_job++;
							}
							?>
						</td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $customer_name; ?></td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name; ?></td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $row["perfoma_no"]; ?></td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $row_job['agreement_no']; ?></td>
						<td style="white-space:nowrap;text-align:center;"><?php
																			$date = new DateTime($row['estimate_date']);
																			echo $date->format('d-m-Y');
																			?></td>
						<td style="text-align:center;">

							<?php
							//if perfoma type is excel then only excel button view
							if ($row["perfoma_type"] == "direct_perfoma_excel") {
							?>
								<a href="span_edit_direct_perfoma_excel_upload.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>Direct perfoma Excel</a>

								<a href="span_invoice_excel_upload_for_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(E) Invoice Excel</a>
								&nbsp;
								<?php
							} else if ($row["perfoma_type"] == "excel") {
								if ($row["nabl_type"] == "nabl") {
								?>
									<a href="span_perfoma_excel_upload.php?chk_array=<?php echo $row['trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(E) perfoma Excel</a>

									<a href="span_invoice_excel_upload.php?chk_array=<?php echo $row['trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(E) Invoice Excel</a>
									&nbsp;
								<?php

								} else { ?>

									<a href="non_nabl_span_perfoma_excel_upload.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(E) perfoma Excel</a>

									<a href="non_nabl_span_invoice_excel_upload.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(E) Invoice Excel</a>
								<?php
								}
							} else {
								?>
								<?php
								if ($row["perfoma_type"] == "direct_perfoma") {
								?>
									<a href="span_edit_new_perfoma.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D) perfoma</a>
									&nbsp;

									<a href="span_set_rate_only_by_test_of_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D)<?php echo $make_test_bill; ?> Invoice By Test</a>

									<a href="span_set_rate_only_by_material_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D)<?php echo $make_material_bill; ?> Invoice By Material</a>

									<a href="span_set_rate_only_for_estimate_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span>(D)<?php echo $make_estiamte; ?> Estimate</a>

									<?php
								} else {
									if ($row["nabl_type"] == "nabl") {
									?>
										<a href="span_set_rate_merging_perfoma.php?chk_array=<?php echo $row['trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> perfoma</a>
										&nbsp;

										<a href="span_set_rate_only_by_test_merging.php?chk_array=<?php echo $row['trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span><?php echo $make_test_bill; ?> Invoice By Test</a>

										<a href="span_set_rate_only_by_material_merging.php?chk_array=<?php echo $row['trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span><?php echo $make_material_bill; ?> Invoice By Material</a>

										<a href="span_set_rate_only_for_estimate_merging.php?chk_array=<?php echo $row['trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span><?php echo $make_estiamte; ?> Estimate</a>
									<?php

									} else {
									?>
										<a href="non_nabl_span_set_rate_merging_perfoma.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> perfoma</a>
										&nbsp;

										<a href="non_nabl_span_set_rate_only_by_test_merging.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span><?php echo $make_test_bill; ?> Invoice By Test</a>

										<a href="non_nabl_span_set_rate_only_by_material_merging.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span><?php echo $make_material_bill; ?> Invoice By Material</a>

										<a href="non_nabl_span_set_rate_only_for_estimate_merging.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span><?php echo $make_estiamte; ?> Estimate</a>
									<?php
									}
								}
							}

							if ($row["perfoma_type"] != "direct_perfoma" && $row["perfoma_type"] != "direct_perfoma_excel") {

								if ($row["nabl_type"] == "nabl") {
									?>
									<a href="list_of_multi_trf.php?chk_array=<?php echo $row['trf_no']; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
									&nbsp;
								<?php
								} else {
								?>
									<a href="non_nabl_list_of_multi_trf.php?chk_array=<?php echo $row['trf_no']; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
									&nbsp;
							<?php
								}
							}
							?>
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>

		</table>
<?php
	}
}
?>
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
</script>
