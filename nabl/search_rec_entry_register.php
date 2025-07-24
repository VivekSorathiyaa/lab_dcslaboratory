<!-- DataTables -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php
session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'search') {

		$sel_user = $_POST["sel_user"];
		$todate = $_POST["todate"];
		$fromdate = $_POST["fromdate"];

		if ($sel_user != "") {
			$set_user = " AND `jobcreatedby_id`='$sel_user'";
		} else {
			$set_user = "";
		}

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
			$where .= "AND (jobcreateddate BETWEEN '$fromdate_new' AND '$todate_new')";
		} else if ($fromdate_new != "") {
			$where .= "AND (jobcreateddate > '$fromdate_new')";
		} else if ($fromdate_new != "") {
			$where .= "AND (jobcreateddate < '$todate_new')";
		} else {
			$where .= "";
		}

?>


		<!--<a href="<?php //echo $base_url;
						?>set_material_print.php?sel_material=<?php //echo $sel_material;
																					?>&&todate=<?php //echo $todate;
																															?>&&fromdate=<?php //echo $fromdate;
																																							?>" target="_blank" class="btn btn-primary">PRINT</a>-->

		<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
			<thead>
				<tr>
					<th style="text-align:center;">Serial No</th>
					<th style="text-align:center;">Job Date</th>
					<th style="text-align:center;">Job By</th>
					<th style="text-align:center;">S.R.F. No</th>
					<th style="text-align:center;">Reference No</th>
					<th style="text-align:center;">Agency Name</th>
					<th style="text-align:center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where . $set_user;
				$result_select = mysqli_query($conn, $select_query);
				if (mysqli_num_rows($result_select) > 0) {
					$cnt = 1;
					while ($row = mysqli_fetch_array($result_select)) {
						$sel_agency_id = $row["agency"];
						$sel_agency = "select * from agency_master where `agency_id`=" . $sel_agency_id;
						$result_agency = mysqli_query($conn, $sel_agency);
						$row_agency = mysqli_fetch_array($result_agency);
						$agency_name = $row_agency["agency_name"];
				?>
						<tr>
							<td style="text-align:center;"><?php echo $cnt; ?></td>
							<td style="white-space:nowrap;text-align:center;">
								<?php
								$date = date_create($row['jobcreateddate']);
								echo date_format($date, "d/m/Y");
								?>
							</td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $row['jobcreatedby']; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no']; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $row['refno']; ?></td>
							<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name; ?></td>
							<td style="text-align:center;">

								<a href="print_trf.php?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_number']; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> PRINT TRF </a>


								&nbsp;
								<a href="print_job_card.php?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_number']; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> PRINT JOB CARD</a>
								&nbsp;
								<a href="print_sample_token.php?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_number']; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> SAMPLE TAGS</a>

								&nbsp;
								<a href="print_receipt.php?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_number']; ?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> RECEIPT</a>



							</td>
						</tr>
						</tr>
				<?php
						$cnt++;
					}
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
