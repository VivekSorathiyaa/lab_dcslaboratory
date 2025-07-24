<!-- DataTables -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php
session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'search') {

		$sel_material = $_POST["sel_material"];
		$todate = $_POST["todate"];
		$fromdate = $_POST["fromdate"];

		if ($sel_material != "") {
			$set_material = " AND `id`=$sel_material";
		} else {
			$set_material = "";
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

		<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
			<thead>
				<tr>
					<th style="text-align:center;">Serial No</th>
					<th style="text-align:center;">Job Date</th>
					<th style="text-align:center;">Material Name</th>
					<th style="text-align:center;">Report No</th>
					<th style="text-align:center;">ulr No</th>
					<th style="text-align:center;">S.R.F. No</th>
					<th style="text-align:center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sele_materials = "select `table_name`,`mt_name`,`print_report`,`print_back` from material where `mt_isdeleted`=0" . $set_material;
				$result_materials = mysqli_query($conn, $sele_materials);
				if (mysqli_num_rows($result_materials) > 0) {
					$counting = 1;
					while ($row_materials = mysqli_fetch_array($result_materials)) {
						$sel_tables = "select * from " . $row_materials['table_name'] . " where 'is_deleted'=0" . $where;
						$result_tables = mysqli_query($conn, $sel_tables);
						if (mysqli_num_rows($result_tables) > 0) {
							while ($row_tables = mysqli_fetch_array($result_tables)) { ?>
								<tr>
									<td><?php echo $counting; ?></td>
									<td>
										<?php
										$date = date_create($row['created_date']);
										echo date_format($date, "d/m/Y");
										?>
									</td>
									<td><?php echo $row_materials["mt_name"] ?></td>
									<td><?php echo $row_tables["report_no"] ?></td>
									<td><?php echo $row_tables["ulr"] ?></td>
									<td><?php echo $row_tables["job_no"] ?></td>
									<td>
										<a href="<?php echo $base_url; ?>print_report/<?php echo $row_materials["print_report"]; ?>?job_no=<?php echo $row_tables["job_no"]; ?>&&report_no=<?php echo $row_tables["report_no"]; ?>&&lab_no=<?php echo $row_tables["lab_no"]; ?>&&trf_no=<?php echo $row_tables["job_no"]; ?>" class="btn btn-primary btn-lg btn3d" target="_blank">REPORT</a>

										<a href="<?php echo $base_url; ?>back_cal_report/<?php echo $row_materials["print_back"]; ?>?job_no=<?php echo $row_tables["job_no"]; ?>&&report_no=<?php echo $row_tables["report_no"]; ?>&&lab_no=<?php echo $row_tables["lab_no"]; ?>&&trf_no=<?php echo $row_tables["job_no"]; ?>&&ulr=<?php echo $row_tables["ulr"]; ?>&&tbl_name=<?php echo $row_materials['table_name']; ?>" class="btn btn-primary btn-lg btn3d" target="_blank">OBSERVATION SHHET</a>
									</td>

								</tr>
				<?php
								$counting++;
							}
						}
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