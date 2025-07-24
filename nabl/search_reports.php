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
			$fromdate_new = "";
		}
		$where = "";
		if ($fromdate_new != "" && $todate_new != "") {
			$where .= "AND (sample_rec_date BETWEEN '$fromdate_new' AND '$todate_new')";
		} else if ($fromdate_new != "") {
			$where .= "AND (sample_rec_date > '$fromdate_new')";
		} else if ($fromdate_new != "") {
			$where .= "AND (sample_rec_date < '$todate_new')";
		} else {
			$where .= "";
		}

		if ($_POST["sel_agency"] != "") {
			$where .= $where . " AND `agency`='$_POST[sel_agency]'";
		}
?>


		<?php
		if ($sel_material != "") {
			if ($sel_material == "FINE AGGREGATE") {

				$cnt = 0;

		?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='132'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query = "select * from sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select = mysqli_query($conn, $select_tiles_query);
										if (mysqli_num_rows($result_tiles_select) > 0) {
											$row_select_pipe = mysqli_fetch_array($result_tiles_select);
											$cnt++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_sand.php?job_no=<?php echo $row_select_pipe["job_no"]; ?>&&report_no=<?php echo $row_select_pipe["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>


						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//BITUMEN
			else if ($sel_material == "BITUMEN") {

				$cnt1 = 0;

			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='134'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from bitumin_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_bitumin.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>

						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//BURNT CLAY BRICK
			else if ($sel_material == "BURNT CLAY BRICK") {

				$cnt1 = 0;

			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='128'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from span_brick WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_sand.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>

						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//FLY ASH BRICK
			else if ($sel_material == "FLY ASH BRICK") {

				$cnt1 = 0;

			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='166'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from span_brick_fly WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_brick_fly.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>

						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>

			<?php
			}
			//CEMENT
			else if ($sel_material == "CEMENT") {

				$cnt1 = 0;

			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='131'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from span_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_span_cement.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>


						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//PAVER BLOCK
			else if ($sel_material == "PAVER BLOCK") {

				$cnt1 = 0;

			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='130'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from span_paver_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/span_paver_block.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>





						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//CONCRETE CUBE
			else if ($sel_material == "CONCRETE CUBE") {

				$cnt1 = 0;
			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='129'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_c_c_cube.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>




						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//FLEXURAL BEAM
			else if ($sel_material == "FLEXURAL BEAM") {

				$cnt1 = 0;
			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='143'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from flexure_beam WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_flexure.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>


						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//STEEL
			else if ($sel_material == "STEEL") {

				$cnt1 = 0;
			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='135'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/span_steel.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>



						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//BITUMEN MIX
			else if ($sel_material == "BITUMEN MIX") {

				$cnt1 = 0;
			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='167'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from bitumin_span_mix WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_bitumen_mix.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>


						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//SOIL
			else if ($sel_material == "SOIL") {

				$cnt1 = 0;
			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='171'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from soil WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_soil.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>


						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//MURRUM
			else if ($sel_material == "MURRUM") {

				$cnt1 = 0;
			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='173'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from murrum WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_murrum.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>

						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//SAND REPLACEMENT
			else if ($sel_material == "SAND REPLACEMENT") {

				$cnt1 = 0;
			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='172'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_soil_cal.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>
						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//DCP
			else if ($sel_material == "DCPT") {

				$cnt1 = 0;
			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='170'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from dcp WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_dcp.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>
						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//CORE CUTTER
			else if ($sel_material == "CORE CUTTER") {

				$cnt1 = 0;
			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='169'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$report_no = $row_test2['report_no'];
										$job_no = $row_test2['job_no'];
										$lab_no = $row_test2['lab_no'];
										$select_tiles_query1 = "select * from core_cutter WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
										$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
										if (mysqli_num_rows($result_tiles_select1) > 0) {
											$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
											$cnt1++;
						?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
												<td style="text-align:center"><a href="print_report/print_core_cutter.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

											</tr>
						<?php
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
			//COARSE AGGREGATE
			else if ($sel_material == "COARSE AGGREGATE") {

				$cnt1 = 0;
			?>
				<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
					<thead>
						<tr>
							<th style="text-align:center;">Sr.No.</th>

							<th style="text-align:center;">Name of <br>Customer</th>
							<th style="text-align:center;">Name of <br>Agency & Client</th>

							<th style="text-align:center;">Date of<Br>Received</th>
							<th style="text-align:center;">Job<Br>No.</th>
							<th style="text-align:center;">Lab<br>No.</th>
							<th style="text-align:center;">Report<br>No.</th>
							<th style="text-align:center;">Report</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
						$result_select = mysqli_query($conn, $select_query);
						if (mysqli_num_rows($result_select) > 0) {

							while ($row_test = mysqli_fetch_array($result_select)) {

								$clientname = $row_test['clientname'];
								$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
								$rec_sample_date = $row_test['sample_rec_date'];
								$r_name = $row_test['refno'];
								$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								$agency_name = "";
								if (mysqli_num_rows($result_select1) > 0) {
									$row_select1 = mysqli_fetch_assoc($result_select1);
									$agency_name = $row_select1['agency_name'];
								}

								$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_category`='1'";
								$result_select2 = mysqli_query($conn, $select_query2);

								if (mysqli_num_rows($result_select2) > 0) {
									while ($row_test2 = mysqli_fetch_array($result_select2)) {

										$select_query3  = "select * from material WHERE `mat_category_id`='$row_test2[material_category]' AND `id` = '$row_test2[material_id]' AND `mt_status`='1' ";
										$result_select3 = mysqli_query($conn, $select_query3);
										if (mysqli_num_rows($result_select3) > 0) {
											while ($row_test3 = mysqli_fetch_array($result_select3)) {

												$report_no = $row_test2['report_no'];
												$job_no = $row_test2['job_no'];
												$lab_no = $row_test2['lab_no'];
												$tbl = $row_test3['table_name'];
												$select_tiles_query1 = "select * from $tbl WHERE `lab_no`='$lab_no' AND `job_no`='$job_no' and `is_deleted`='0'";
												$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
												if (mysqli_num_rows($result_tiles_select1) > 0) {
													while ($row_select_pipe1 = mysqli_fetch_array($result_tiles_select1)) {
														$cnt1++;
						?>

														<tr>
															<td style="text-align:center"><?php echo $cnt1; ?></td>

															<td style="text-align:center"><?php echo $clientname; ?></td>
															<td style="text-align:center"><?php echo $agency_name; ?></td>

															<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
															<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
															<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
															<td style="text-align:center"><?php echo $row_select_pipe1["report_no"]; ?></td>
															<td style="text-align:center"><a href="print_report/print_sand.php?job_no=<?php echo $row_select_pipe1["job_no"]; ?>&&report_no=<?php echo $row_select_pipe1["report_no"]; ?>&&lab_no=<?php echo $row_select_pipe1["lab_no"]; ?>&&trf_no=<?php echo $row_select_pipe1["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a></td>

														</tr>


						<?php						}
												}
											}
										}
									}
								}
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
		} else { ?>

			<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
				<thead>
					<tr>
						<th style="text-align:center;">Sr.No.</th>
						<th style="text-align:center;">Materisal.</th>

						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>

						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Report<br>No.</th>
						<th style="text-align:center;">Report</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$select_query = "select * from job WHERE `jobisdeleted`='0' " . $where;
					$result_select = mysqli_query($conn, $select_query);
					if (mysqli_num_rows($result_select) > 0) {

						while ($row_test = mysqli_fetch_array($result_select)) {

							$clientname = $row_test['clientname'];
							$name_of_work = strip_tags(html_entity_decode($row_test['nameofwork']), "<strong><em>");
							$rec_sample_date = $row_test['sample_rec_date'];
							$r_name = $row_test['refno'];
							$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
							$result_select1 = mysqli_query($conn, $select_query1);
							$agency_name = "";
							if (mysqli_num_rows($result_select1) > 0) {
								$row_select1 = mysqli_fetch_assoc($result_select1);
								$agency_name = $row_select1['agency_name'];
							}

							$select_query2  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `is_status`='1' AND `material_id`='132'";
							$result_select2 = mysqli_query($conn, $select_query2);

							if (mysqli_num_rows($result_select2) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select2)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									//$select_tiles_query = "select * from sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
									//$result_tiles_select = mysqli_query($conn, $select_tiles_query);
									//if (mysqli_num_rows($result_tiles_select) > 0) {
									//$row_select_pipe = mysqli_fetch_array($result_tiles_select);
									$cnt++;
					?>

									<tr>
										<td style="text-align:center"><?php echo $cnt; ?></td>
										<td style="text-align:center">FINE AGGREGATE</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query = "select * from sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select = mysqli_query($conn, $select_tiles_query);
											if (mysqli_num_rows($result_tiles_select) > 0) {
											?>
												<a href="print_report/print_sand.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>


								<?php
									//}


								}
							}

							$select_query3  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='134'";
							$result_select3 = mysqli_query($conn, $select_query3);

							if (mysqli_num_rows($result_select3) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select3)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$select_tiles_query1 = "select * from bitumin_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
									$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
									//if (mysqli_num_rows($result_tiles_select1) > 0) {
									//$row_select_pipe1 = mysqli_fetch_array($result_tiles_select1);
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">BITUMEN</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from bitumin_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/print_bitumin.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>

								<?php
									//}
								}
							}

							$select_query4  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='128'";
							$result_select4 = mysqli_query($conn, $select_query4);

							if (mysqli_num_rows($result_select4) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select4)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];

									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">BURNT CLAY BRICK</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from span_brick WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>

												<a href="print_report/print_sand.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>

											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>

								<?php
									//}
								}
							}

							$select_query5  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='166'";
							$result_select5 = mysqli_query($conn, $select_query5);

							if (mysqli_num_rows($result_select5) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select5)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">FLY ASH BRICK</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from span_brick_fly WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/print_brick_fly.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>

								<?php
									//}
								}
							}

							$select_query6  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='131'";
							$result_select6 = mysqli_query($conn, $select_query6);

							if (mysqli_num_rows($result_select6) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select6)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">CEMENT</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from span_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/print_span_cement.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>


								<?php
									//}
								}
							}

							$select_query7  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='130'";
							$result_select7 = mysqli_query($conn, $select_query7);

							if (mysqli_num_rows($result_select7) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select7)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];

									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">PAVER BLOCK</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from span_paver_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>

												<a href="print_report/span_paver_block.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>
								<?php
									//}
								}
							}

							$select_query8  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='129'";
							$result_select8 = mysqli_query($conn, $select_query8);

							if (mysqli_num_rows($result_select8) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select8)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];

									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">CONCRETE CUBE</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>

												<a href="print_report/print_c_c_cube.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>
								<?php
									//}
								}
							}
							$select_query9  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='143'";
							$result_select9 = mysqli_query($conn, $select_query9);

							if (mysqli_num_rows($result_select9) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select9)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">FLEXURAL BEAM</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from flexure_beam WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/print_flexure.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>


								<?php
									//}
								}
							}

							$select_query10  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='135'";
							$result_select10 = mysqli_query($conn, $select_query10);

							if (mysqli_num_rows($result_select10) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select10)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">STEEL</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/span_steel.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>



								<?php
									//}
								}
							}

							$select_query11  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='167'";
							$result_select11 = mysqli_query($conn, $select_query11);

							if (mysqli_num_rows($result_select11) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select11)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">BITUMEN MIX</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from bitumin_span_mix WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/print_bitumen_mix.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>


								<?php
									//}
								}
							}

							$select_query12  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='171'";
							$result_select12 = mysqli_query($conn, $select_query12);

							if (mysqli_num_rows($result_select12) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select12)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">SOIL</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from soil WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/print_soil.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>
								<?php
									//}
								}
							}

							$select_query13  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='173'";
							$result_select13 = mysqli_query($conn, $select_query13);

							if (mysqli_num_rows($result_select13) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select13)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">MURRUM</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from murrum WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/print_murrum.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>

								<?php
									//}
								}
							}

							$select_query14  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='172'";
							$result_select14 = mysqli_query($conn, $select_query14);

							if (mysqli_num_rows($result_select14) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select14)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">SAND REPLACEMENT</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/print_soil_cal.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
											<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
										</td>

									</tr>
								<?php
									//}
								}
							}

							$select_query15  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='170'";
							$result_select15 = mysqli_query($conn, $select_query15);

							if (mysqli_num_rows($result_select15) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select15)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">DCPT</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from dcp WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/print_dcp.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
										</td>
									<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
									</tr>
								<?php
									//}
								}
							}

							$select_query16  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `eng_light_status`='2' AND `is_status`='1' AND `material_id`='169'";
							$result_select16 = mysqli_query($conn, $select_query16);

							if (mysqli_num_rows($result_select16) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select16)) {

									$report_no = $row_test2['report_no'];
									$job_no = $row_test2['job_no'];
									$lab_no = $row_test2['lab_no'];
									$cnt1++;
								?>

									<tr>
										<td style="text-align:center"><?php echo $cnt1; ?></td>
										<td style="text-align:center">CORE CUTTER</td>

										<td style="text-align:center"><?php echo $clientname; ?></td>
										<td style="text-align:center"><?php echo $agency_name; ?></td>

										<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
										<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
										<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
										<td style="text-align:center">
											<?php
											$select_tiles_query1 = "select * from core_cutter WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
											if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
												<a href="print_report/print_core_cutter.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>
										</td>
									<?php } else {
												echo '<span style="color:red;">PENDING</span>';
											} ?>
									</tr>
									<?php
									//}
								}
							}

							$select_query17  = "select * from final_material_assign_master WHERE `trf_no`='$row_test[trf_no]' AND `is_status`='1' AND `material_category`='1'";
							$result_select17 = mysqli_query($conn, $select_query17);

							if (mysqli_num_rows($result_select17) > 0) {
								while ($row_test2 = mysqli_fetch_array($result_select17)) {

									$select_query3  = "select * from material WHERE `mat_category_id`='$row_test2[material_category]' AND `id` = '$row_test2[material_id]' AND `mt_status`='1' ";
									$result_select3 = mysqli_query($conn, $select_query3);
									if (mysqli_num_rows($result_select3) > 0) {
										while ($row_test3 = mysqli_fetch_array($result_select3)) {

											$report_no = $row_test2['report_no'];
											$job_no = $row_test2['job_no'];
											$lab_no = $row_test2['lab_no'];
											$tbl = $row_test3['table_name'];
											//$select_tiles_query1 = "select * from $tbl WHERE `lab_no`='$lab_no' AND `job_no`='$job_no' and `is_deleted`='0'";
											//$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);

											//if (mysqli_num_rows($result_tiles_select1) > 0) {
											//while($row_select_pipe1 = mysqli_fetch_array($result_tiles_select1))
											//{
											$cnt1++;
									?>

											<tr>
												<td style="text-align:center"><?php echo $cnt1; ?></td>
												<td style="text-align:center">COARSE AGGREGATE</td>

												<td style="text-align:center"><?php echo $clientname; ?></td>
												<td style="text-align:center"><?php echo $agency_name; ?></td>

												<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
												<td style="text-align:center"><?php echo $row_test2["job_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_test2["lab_no"]; ?></td>
												<td style="text-align:center"><?php echo $row_test2["report_no"]; ?></td>
												<td style="text-align:center">
													<?php
													$select_tiles_query1 = "select * from $tbl WHERE `lab_no`='$lab_no' AND `job_no`='$job_no' and `is_deleted`='0'";
													$result_tiles_select1 = mysqli_query($conn, $select_tiles_query1);
													if (mysqli_num_rows($result_tiles_select1) > 0) { ?>
														<a href="print_report/print_sand.php?job_no=<?php echo $row_test2["job_no"]; ?>&&report_no=<?php echo $row_test2["report_no"]; ?>&&lab_no=<?php echo $row_test2["lab_no"]; ?>&&trf_no=<?php echo $row_test2["job_no"]; ?>" target="_blank" class="btn btn-primary">Report</a>

													<?php } else {
														echo '<span style="color:red">PENDING</span>';
													} ?>

												</td>

											</tr>


					<?php						//}
											//}
										}
									}
								}
							}
						}
					}
					?>
				</tbody>
			</table>

		<?php }
		?>


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