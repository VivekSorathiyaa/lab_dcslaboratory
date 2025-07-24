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
					<th style="text-align:center;">Perfoma Date</th>
					<th style="text-align:center;">Agency No</th>
					<th style="text-align:center;">Perfoma No</th>
					<th style="text-align:center;">Name of Department</th>
					<th style="text-align:center;">Grand Total</th>
					<th style="text-align:center;">Discount Percent</th>
					<th style="text-align:center;">Discount Amount</th>
					<th style="text-align:center;">Bill Amount</th>

					<th style="text-align:center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$count = 0;
				$query = "select * from estimate_total_span_only_for_estimate WHERE `est_isdeleted`=0 ORDER BY est_id DESC LIMIT 0,200";
				$result = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_array($result)) {
					$count++;
					$sel_agency_id = $row["agency_id"];
					$sel_agency = "select * from agency_master where `agency_id`=" . $sel_agency_id;

					if ($row["nabl_type"] == "non_nabl") {
						$result_agency = mysqli_query($conn_of_non, $sel_agency);
					} else {
						$result_agency = mysqli_query($conn, $sel_agency);
					}
					$row_agency = mysqli_fetch_array($result_agency);
					$agency_name = $row_agency["agency_name"];

					$get_one_trf_no = explode(",", $row['trf_no']);
					$one_trf_no = $get_one_trf_no[0];
					$query_job = "select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' ORDER BY job_id DESC";

					if ($row["nabl_type"] == "non_nabl") {
						$result_job = mysqli_query($conn_of_non, $query_job);
					} else {
						$result_job = mysqli_query($conn, $query_job);
					}

					$row_job = mysqli_fetch_array($result_job);
					$clientname = $row_job["clientname"];
					$name_of_work = strip_tags(html_entity_decode($row_job["nameofwork"]), "<strong><em>");

					if ($row["estimate_type"] == "direct_perfoma") {
						$clientname = $row['customer_name'];
					}

				?>
					<tr>
						<td style="text-align:center;"><?php echo $count; ?></td>
						<td style="white-space:nowrap;text-align:center;"><?php
																			$date = new DateTime($row['estimate_date']);
																			echo $date->format('d-m-Y');
																			?></td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name; ?></td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $row["perfoma_no"]; ?></td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $clientname; ?></td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $row["grand_total"]; ?></td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $row["discount_percent"]; ?>(%)</td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $row["discount_amount"]; ?></td>
						<td style="white-space:nowrap;text-align:center;"><?php echo $row["total_amt"]; ?></td>


						<td style="text-align:center;">
							<?php if ($row["estimate_type"] == "direct_perfoma") { ?>
								<a href="matt_estimate_direct_perfoma_print.php?perfoma_no=<?php echo $row["perfoma_no"]; ?>" class="btn btn-info" title="" target="_blank" style="width:150px;font-size:20px;"><span class="glyphicon glyphicon-question-list"></span> D Print</a>
								<?php } else {
								if ($row["nabl_type"] == "non_nabl") {
								?>

									<a href="non_nabl_matt_estimate_print.php?chk_array=<?php echo $row["trf_no"]; ?>&&temporary_trf_no=<?php echo $row["temporary_trf_no"]; ?>" class="btn btn-info" title="" target="_blank" style="width:150px;font-size:20px;"><span class="glyphicon glyphicon-question-list"></span> Print</a>
								<?php
								} else {
								?>
									<a href="matt_estimate_print.php?chk_array=<?php echo $row["trf_no"]; ?>" class="btn btn-info" title="" target="_blank" style="width:150px;font-size:20px;"><span class="glyphicon glyphicon-question-list"></span> Print</a>
							<?php
								}
							} ?>
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
