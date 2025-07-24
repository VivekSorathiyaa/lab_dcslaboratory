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

?>


		<a href="<?php echo $base_url; ?>set_material_print.php?sel_material=<?php echo $sel_material; ?>&&todate=<?php echo $todate; ?>&&fromdate=<?php echo $fromdate; ?>" target="_blank" class="btn btn-primary mb-3">PRINT</a>


		<?php
		if ($sel_material == "FINE AGGREGATE") {

			$cnt = 0;

		?>
			<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
				<thead>
					<tr>
						<th style="text-align:center;">Sr.No.</th>
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Specific<Br>Gravity</th>
						<th style="text-align:center;">Water <br>Absorption (%)</th>
						<th style="text-align:center;">Bulk <br>Density<br>(kg/ Lit.)</th>
						<th style="text-align:center;">F.M.</th>
						<th style="text-align:center;">Zone</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe["sp_specific_gravity"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe["sp_water_abr"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe["bdl"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe["grd_fm"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe["grd_zone"]; ?></td>
											<td style="text-align:center">Chintan</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Type of<Br>Bitumen</th>
						<th style="text-align:center;">Penetration<br>in mm</th>
						<th style="text-align:center;">Softning<br>Point<br>(&#8451;)</th>
						<th style="text-align:center;">Ductility<br>in cm</th>
						<th style="text-align:center;">Specific Gravity</th>
						<th style="text-align:center;">Kinematics<br>Viscosity<br>at 135 &#8451;<br>(C.st)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["bitumin_grade"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_pen"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_sof"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_duc"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_sp"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_kin"]; ?></td>
											<td style="text-align:center">Parth</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">L<BR>(mm)</th>
						<th style="text-align:center;">B<br>(mm)</th>
						<th style="text-align:center;">H<br>(mm)</th>
						<th style="text-align:center;">Efflorence</th>
						<th style="text-align:center;">Compressive<br>Strength<br>N/mm<sup>2</sup></th>
						<th style="text-align:center;">Water<br>Absorption<br>(%)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_length"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_width"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_height"]; ?></td>
											<td style="text-align:center"><?php
																			$ans = "";
																			if ($row_select_pipe1["rbt_efflo1"] == "NIL") {
																				$ans .= "N-";
																			} else if ($row_select_pipe1["rbt_efflo1"] == "SLIGHT") {
																				$ans .= "S-";
																			}
																			if ($row_select_pipe1["rbt_efflo2"] == "NIL") {
																				$ans .= "N-";
																			} else if ($row_select_pipe1["rbt_efflo2"] == "SLIGHT") {
																				$ans .= "S-";
																			}
																			if ($row_select_pipe1["rbt_efflo3"] == "NIL") {
																				$ans .= "N-";
																			} else if ($row_select_pipe1["rbt_efflo3"] == "SLIGHT") {
																				$ans .= "S-";
																			}
																			if ($row_select_pipe1["rbt_efflo4"] == "NIL") {
																				$ans .= "N-";
																			} else if ($row_select_pipe1["rbt_efflo4"] == "SLIGHT") {
																				$ans .= "S-";
																			}
																			if ($row_select_pipe1["rbt_efflo5"] == "NIL") {
																				$ans .= "N";
																			} else if ($row_select_pipe1["rbt_efflo5"] == "SLIGHT") {
																				$ans .= "S";
																			}

																			echo $ans; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_com"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_wtr"]; ?></td>
											<td style="text-align:center">Akash</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">L<BR>(mm)</th>
						<th style="text-align:center;">B<br>(mm)</th>
						<th style="text-align:center;">H<br>(mm)</th>
						<th style="text-align:center;">Efflorence</th>
						<th style="text-align:center;">Compressive<br>Strength<br>N/mm<sup>2</sup></th>
						<th style="text-align:center;">Water<br>Absorption<br>(%)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_length"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_width"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_height"]; ?></td>
											<td style="text-align:center"><?php
																			$ans = "";
																			if ($row_select_pipe1["rbt_efflo1"] == "NIL") {
																				$ans .= "N-";
																			} else if ($row_select_pipe1["rbt_efflo1"] == "SLIGHT") {
																				$ans .= "S-";
																			}
																			if ($row_select_pipe1["rbt_efflo2"] == "NIL") {
																				$ans .= "N-";
																			} else if ($row_select_pipe1["rbt_efflo2"] == "SLIGHT") {
																				$ans .= "S-";
																			}
																			if ($row_select_pipe1["rbt_efflo3"] == "NIL") {
																				$ans .= "N-";
																			} else if ($row_select_pipe1["rbt_efflo3"] == "SLIGHT") {
																				$ans .= "S-";
																			}
																			if ($row_select_pipe1["rbt_efflo4"] == "NIL") {
																				$ans .= "N-";
																			} else if ($row_select_pipe1["rbt_efflo4"] == "SLIGHT") {
																				$ans .= "S-";
																			}
																			if ($row_select_pipe1["rbt_efflo5"] == "NIL") {
																				$ans .= "N";
																			} else if ($row_select_pipe1["rbt_efflo5"] == "SLIGHT") {
																				$ans .= "S";
																			}

																			echo $ans; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_com"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_wtr"]; ?></td>
											<td style="text-align:center">Akash</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Brand<br>Name</th>
						<th style="text-align:center;">Consistency</th>
						<th style="text-align:center;">Initial<Br>Setting<br>Time<bR>(Min)</th>
						<th style="text-align:center;">Final<Br>Setting<br>Time<bR>(Min)</th>
						<th style="text-align:center;">Compressive<br>Strength<br>3 Days<br>N/mm<sup>2</sup></th>
						<th style="text-align:center;">Compressive<br>Strength<br>7 Days<br>N/mm<sup>2</sup></th>
						<th style="text-align:center;">Compressive<br>Strength<br>28 Days<br>N/mm<sup>2</sup></th>
						<th style="text-align:center;">Soundness<br>(%)</th>
						<th style="text-align:center;">Fineness<br>by Blain<br>Air<br>(m<sup>2</sup>/kg)</th>
						<th style="text-align:center;">Specific<br>Gravity<br>(g/cm<sup>3</sup>)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["cement_brand"] . "<br>" . $row_select_pipe1["cement_grade"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["final_consistency"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["initial_time"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["final_time"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_com_1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_com_2"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_com_3"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["soundness"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["ss_area"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_density"]; ?></td>
											<td style="text-align:center">Akash</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Grade of<br>Concrete</th>
						<th style="text-align:center;">Compressive<br>Strength<br>N/mm<sup>2</sup></th>
						<th style="text-align:center;">Water Absorption<br>(%)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["paver_grade"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_corr"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_wtr"]; ?></td>
											<td style="text-align:center">Tushar</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Grade of<br>Concrete</th>
						<th style="text-align:center;">Compressive<br>Strength<br>N/mm<sup>2</sup></th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["cc_grade"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_com_s_1"]; ?></td>
											<td style="text-align:center">Tushar</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Grade of<br>Concrete</th>
						<th style="text-align:center;">Flexural<br>Strength<br>N/mm<sup>2</sup></th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["cc_grade"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_com_s_1"]; ?></td>
											<td style="text-align:center">Tushar</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Brand Name</th>
						<th style="text-align:center;">Dia<br>(mm)</th>
						<th style="text-align:center;">Cross Sectional<br>Area<br>(mm<sup>2</sup>)</th>
						<th style="text-align:center;">Yield<br>Stress<br>(N/mm<sup>2</sup>)</th>
						<th style="text-align:center;">Ultimate<br>Stress<br>(N/mm<sup>2</sup>)</th>
						<th style="text-align:center;">Elongation<br>(%)</th>
						<th style="text-align:center;">Bend</th>
						<th style="text-align:center;">Re-bend</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["brand"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["dia_1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["cs_1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["ys_1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["ten_1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["elo_1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["bend_1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["rebend_1"]; ?></td>
											<td style="text-align:center">Soumya</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Flow<br>(mm)</th>
						<th style="text-align:center;">Marshal Stability<br>(KN)</th>
						<th style="text-align:center;">Density<br>(gm/cc)</th>
						<th style="text-align:center;">Binder<br>Content Mix<br>(%)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_flow"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_stabilty"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_density"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_bin"]; ?></td>
											<td style="text-align:center">Parth</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Gravel</th>
						<th style="text-align:center;">Sand</th>
						<th style="text-align:center;">Silt + Clay</th>
						<th style="text-align:center;">Classification</th>
						<th style="text-align:center;">CBR<br>(%)</th>
						<th style="text-align:center;">MDD<br>(%)</th>
						<th style="text-align:center;">OMC<br>(%)</th>
						<th style="text-align:center;">LL<br>(%)</th>
						<th style="text-align:center;">PL<br>(%)</th>
						<th style="text-align:center;">PI<br>(%)</th>
						<th style="text-align:center;">4.75<br>(mm)</th>
						<th style="text-align:center;">2.36<br>(mm)</th>
						<th style="text-align:center;">2.00<br>(mm)</th>
						<th style="text-align:center;">0.425<br>(mm)</th>
						<th style="text-align:center;">0.60<br>(mm)</th>
						<th style="text-align:center;">0.075<br>(mm)</th>
						<th style="text-align:center;">Shrinkage<br>Limit (%)</th>
						<th style="text-align:center;">Free Swell<br>Index (%)</th>
						<th style="text-align:center;">Specific<br>Gravity</th>
						<th style="text-align:center;">Relative<br>Density (gm/cc)</th>
						<th style="text-align:center;">Unconfined<br>Comp. Strength (kg/cm<sup>2</sup>)</th>
						<th style="text-align:center;">Swelling<br>Pressure (kg/cm<sup>2</sup>)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["g1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["g2"]; ?></td>
											<td style="text-align:center"><?php echo (number_format($row_select_pipe1["g3"]) + number_format($row_select_pipe1["g4"])); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["so1"]; ?></td>
											<td style="text-align:center"><?php if ($row_select_pipe1["cbr2"] != "") {
																				echo $row_select_pipe1["cbr2"];
																			} else {
																				echo $row_select_pipe1["cbr1"];
																			} ?></td>
											<td style="text-align:center"><?php if ($row_select_pipe1["l1"] != "") {
																				echo $row_select_pipe1["l1"];
																			} else {
																				echo $row_select_pipe1["h1"];
																			} ?></td>
											<td style="text-align:center"><?php if ($row_select_pipe1["l2"] != "") {
																				echo $row_select_pipe1["l2"];
																			} else {
																				echo $row_select_pipe1["h2"];
																			} ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["a1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["a2"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["a3"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_2"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_3"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_4"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_5"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_6"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["s1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["f1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["sp1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["r1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["u1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["sw1"]; ?></td>
											<td style="text-align:center">Radha</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Gravel</th>
						<th style="text-align:center;">Sand</th>
						<th style="text-align:center;">Silt + Clay</th>
						<th style="text-align:center;">Classification</th>
						<th style="text-align:center;">CBR<br>(%)</th>
						<th style="text-align:center;">MDD<br>(%)</th>
						<th style="text-align:center;">OMC<br>(%)</th>
						<th style="text-align:center;">LL<br>(%)</th>
						<th style="text-align:center;">PL<br>(%)</th>
						<th style="text-align:center;">PI<br>(%)</th>
						<th style="text-align:center;">4.75<br>(mm)</th>
						<th style="text-align:center;">2.36<br>(mm)</th>
						<th style="text-align:center;">2.00<br>(mm)</th>
						<th style="text-align:center;">0.425<br>(mm)</th>
						<th style="text-align:center;">0.60<br>(mm)</th>
						<th style="text-align:center;">0.075<br>(mm)</th>
						<th style="text-align:center;">Shrinkage<br>Limit (%)</th>
						<th style="text-align:center;">Free Swell<br>Index (%)</th>
						<th style="text-align:center;">Specific<br>Gravity</th>
						<th style="text-align:center;">Relative<br>Density (gm/cc)</th>
						<th style="text-align:center;">Unconfined<br>Comp. Strength (kg/cm<sup>2</sup>)</th>
						<th style="text-align:center;">Swelling<br>Pressure (kg/cm<sup>2</sup>)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["g1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["g2"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["g3"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["so1"]; ?></td>
											<td style="text-align:center"><?php if ($row_select_pipe1["cbr2"] != "") {
																				echo $row_select_pipe1["cbr2"];
																			} else {
																				echo $row_select_pipe1["cbr1"];
																			} ?></td>
											<td style="text-align:center"><?php if ($row_select_pipe1["l1"] != "") {
																				echo $row_select_pipe1["l1"];
																			} else {
																				echo $row_select_pipe1["h1"];
																			} ?></td>
											<td style="text-align:center"><?php if ($row_select_pipe1["l2"] != "") {
																				echo $row_select_pipe1["l2"];
																			} else {
																				echo $row_select_pipe1["h2"];
																			} ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["a1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["a2"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["a3"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_2"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_3"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_4"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_5"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["grd_6"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["s1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["f1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["sp1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["r1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["u1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["sw1"]; ?></td>
											<td style="text-align:center">Radha</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">MDD (gm/cc)</th>
						<th style="text-align:center;">Moisture<br> Content (%)</th>
						<th style="text-align:center;">Bulk Density<br>(gm/cc)</th>
						<th style="text-align:center;">Compaction (%)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["cal_mdd"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["d6"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["d7"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["d8"]; ?></td>
											<td style="text-align:center">Radha</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">DCP</th>
						<th style="text-align:center;">CBR (%)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["avg_c"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["cbr"]; ?></td>
											<td style="text-align:center">Radha</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">MDD (gm/cc)</th>
						<th style="text-align:center;">Wet Density<br>(gm/cc)</th>
						<th style="text-align:center;">Moisture Content<br>(%)</th>
						<th style="text-align:center;">Field Dry Density</th>
						<th style="text-align:center;">Compaction (%)</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
											<td style="text-align:center"><?php echo $name_of_work; ?></td>
											<td style="text-align:center"><?php echo $clientname; ?></td>
											<td style="text-align:center"><?php echo $agency_name; ?></td>
											<td style="text-align:center"><?php echo $r_name; ?> </td>
											<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["field_mdd"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["fdd_1"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["fdd_2"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["fdd_3"]; ?></td>
											<td style="text-align:center"><?php echo $row_select_pipe1["fdd_4"]; ?></td>
											<td style="text-align:center">Radha</td>
											<td style="text-align:center"></td>

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
						<th style="text-align:center;">Name of Work</th>
						<th style="text-align:center;">Name of <br>Customer</th>
						<th style="text-align:center;">Name of <br>Agency & Client</th>
						<th style="text-align:center;">Ref.No. &<br> Date</th>
						<th style="text-align:center;">Date of<Br>Received</th>
						<th style="text-align:center;">Job<Br>No.</th>
						<th style="text-align:center;">Lab<br>No.</th>
						<th style="text-align:center;">Size of Aggregate</th>
						<th style="text-align:center;">Specific Gravity</th>
						<th style="text-align:center;">W.A.<br>(%)</th>
						<th style="text-align:center;">Impact<br>Value<br>(%)</th>
						<th style="text-align:center;">F.I &amp;<br>E.I. (%)</th>
						<th style="text-align:center;">Crushing<br>Value<br>(%)</th>
						<th style="text-align:center;">Soundness<br>(%)</th>
						<th style="text-align:center;">Abrasion<br>Value<br>(%)</th>
						<th style="text-align:center;">Bulk<br>Density<br>(kg/lit.)</th>
						<th style="text-align:center;">10 %<br>Fineness<br>Value<br>(KN)</th>
						<th style="text-align:center;">125 mm</th>
						<th style="text-align:center;">90 mm</th>
						<th style="text-align:center;">80 mm</th>
						<th style="text-align:center;">75 mm</th>
						<th style="text-align:center;">63 mm</th>
						<th style="text-align:center;">53 mm</th>
						<th style="text-align:center;">45 mm</th>
						<th style="text-align:center;">40 mm</th>
						<th style="text-align:center;">37.5 mm</th>
						<th style="text-align:center;">26.5 mm</th>
						<th style="text-align:center;">25 mm</th>
						<th style="text-align:center;">22.4 mm</th>
						<th style="text-align:center;">20 mm</th>
						<th style="text-align:center;">19 mm</th>
						<th style="text-align:center;">16 mm</th>
						<th style="text-align:center;">13.2 mm</th>
						<th style="text-align:center;">12.5 mm</th>
						<th style="text-align:center;">11.2 mm</th>
						<th style="text-align:center;">10 mm</th>
						<th style="text-align:center;">9.5 mm</th>
						<th style="text-align:center;">6.3 mm</th>
						<th style="text-align:center;">5.6 mm</th>
						<th style="text-align:center;">4.75 mm</th>
						<th style="text-align:center;">2.8 mm</th>
						<th style="text-align:center;">2.36 mm</th>
						<th style="text-align:center;">1.18 mm</th>
						<th style="text-align:center;">0.85 mm</th>
						<th style="text-align:center;">0.6 mm</th>
						<th style="text-align:center;">0.425 mm</th>
						<th style="text-align:center;">0.3 mm</th>
						<th style="text-align:center;">0.18 mm</th>
						<th style="text-align:center;">0.15 mm</th>
						<th style="text-align:center;">0.09 mm</th>
						<th style="text-align:center;">0.075 mm</th>
						<th style="text-align:center;">Tested By</th>
						<th style="text-align:center;">Remarks</th>
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
							$select_query1 = "select * from agency_master where `agency_id`='$row_test[agency]' AND `isdeleted`='0'";
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
														<td style="text-align:center"><?php echo $name_of_work; ?></td>
														<td style="text-align:center"><?php echo $clientname; ?></td>
														<td style="text-align:center"><?php echo $agency_name; ?></td>
														<td style="text-align:center"><?php echo $r_name; ?> </td>
														<td style="text-align:center"><?php echo date('d-m-yy', strtotime($rec_sample_date)); ?></td>
														<td style="text-align:center"><?php echo $row_select_pipe1["job_no"]; ?></td>
														<td style="text-align:center"><?php echo $row_select_pipe1["lab_no"]; ?></td>
														<?php if ($tbl == "general_ca") {
														?>
															<td style="text-align:center"><?php echo $row_select_pipe1['sample_de']; ?></td>
														<?php } else { ?>
															<td style="text-align:center"><?php echo $row_test3['mt_name']; ?></td>
														<?php }
														?>

														<td style="text-align:center"><?php if ($row_select_pipe1["sp_specific_gravity"] != "" && $row_select_pipe1["sp_specific_gravity"] != "0") {
																							echo $row_select_pipe1["sp_specific_gravity"];
																						} ?></td>
														<td style="text-align:center"><?php if ($row_select_pipe1["sp_water_abr"] != "" && $row_select_pipe1["sp_water_abr"] != "0") {
																							echo $row_select_pipe1["sp_water_abr"];
																						} ?></td>
														<td style="text-align:center"><?php if ($row_select_pipe1["imp_value"] != "" && $row_select_pipe1["imp_value"] != "0") {
																							echo $row_select_pipe1["imp_value"];
																						} ?></td>
														<td style="text-align:center"><?php if ($row_select_pipe1["combined_index"] != "" && $row_select_pipe1["combined_index"] != "0") {
																							echo $row_select_pipe1["combined_index"];
																						} ?></td>

														<td style="text-align:center"><?php if ($row_select_pipe1["cru_value"] != "" && $row_select_pipe1["cru_value"] != "0") {
																							echo $row_select_pipe1["cru_value"];
																						} ?></td>
														<td style="text-align:center"><?php if ($row_select_pipe1["soundness"] != "" && $row_select_pipe1["soundness"] != "0") {
																							echo $row_select_pipe1["soundness"];
																						} ?></td>
														<td style="text-align:center"><?php if ($row_select_pipe1["abr_index"] != "" && $row_select_pipe1["abr_index"] != "0") {
																							echo $row_select_pipe1["abr_index"];
																						} ?></td>
														<td style="text-align:center"><?php if ($row_select_pipe1["bdl"] != "" && $row_select_pipe1["bdl"] != "0") {
																							echo $row_select_pipe1["bdl"];
																						} ?></td>
														<td style="text-align:center"><?php if ($row_select_pipe1["fines_value"] != "" && $row_select_pipe1["fines_value"] != "0") {
																							echo $row_select_pipe1["fines_value"];
																						} ?></td>

														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "125" || $row_select_pipe1["sieve_1"] == "125.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "125" || $row_select_pipe1["sieve_2"] == "125.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "125" || $row_select_pipe1["sieve_3"] == "125.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "125" || $row_select_pipe1["sieve_4"] == "125.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "125" || $row_select_pipe1["sieve_5"] == "125.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "125" || $row_select_pipe1["sieve_6"] == "125.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "125" || $row_select_pipe1["sieve_7"] == "125.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "125" || $row_select_pipe1["sieve_8"] == "125.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "125" || $row_select_pipe1["sieve_9"] == "125.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "125" || $row_select_pipe1["sieve_10"] == "125.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "125" || $row_select_pipe1["sieve_11"] == "125.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "125" || $row_select_pipe1["sieve_12"] == "125.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "90" || $row_select_pipe1["sieve_1"] == "90.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "90" || $row_select_pipe1["sieve_2"] == "90.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "90" || $row_select_pipe1["sieve_3"] == "90.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "90" || $row_select_pipe1["sieve_4"] == "90.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "90" || $row_select_pipe1["sieve_5"] == "90.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "90" || $row_select_pipe1["sieve_6"] == "90.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "90" || $row_select_pipe1["sieve_7"] == "90.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "90" || $row_select_pipe1["sieve_8"] == "90.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "90" || $row_select_pipe1["sieve_9"] == "90.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "90" || $row_select_pipe1["sieve_10"] == "90.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "90" || $row_select_pipe1["sieve_11"] == "90.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "90" || $row_select_pipe1["sieve_12"] == "90.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "80" || $row_select_pipe1["sieve_1"] == "80.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "80" || $row_select_pipe1["sieve_2"] == "80.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "80" || $row_select_pipe1["sieve_3"] == "80.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "80" || $row_select_pipe1["sieve_4"] == "80.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "80" || $row_select_pipe1["sieve_5"] == "80.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "80" || $row_select_pipe1["sieve_6"] == "80.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "80" || $row_select_pipe1["sieve_7"] == "80.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "80" || $row_select_pipe1["sieve_8"] == "80.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "80" || $row_select_pipe1["sieve_9"] == "80.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "80" || $row_select_pipe1["sieve_10"] == "80.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "80" || $row_select_pipe1["sieve_11"] == "80.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "80" || $row_select_pipe1["sieve_12"] == "80.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "75" || $row_select_pipe1["sieve_1"] == "75.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "75" || $row_select_pipe1["sieve_2"] == "75.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "75" || $row_select_pipe1["sieve_3"] == "75.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "75" || $row_select_pipe1["sieve_4"] == "75.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "75" || $row_select_pipe1["sieve_5"] == "75.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "75" || $row_select_pipe1["sieve_6"] == "75.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "75" || $row_select_pipe1["sieve_7"] == "75.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "75" || $row_select_pipe1["sieve_8"] == "75.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "75" || $row_select_pipe1["sieve_9"] == "75.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "75" || $row_select_pipe1["sieve_10"] == "75.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "75" || $row_select_pipe1["sieve_11"] == "75.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "75" || $row_select_pipe1["sieve_12"] == "75.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "63" || $row_select_pipe1["sieve_1"] == "63.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "63" || $row_select_pipe1["sieve_2"] == "63.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "63" || $row_select_pipe1["sieve_3"] == "63.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "63" || $row_select_pipe1["sieve_4"] == "63.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "63" || $row_select_pipe1["sieve_5"] == "63.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "63" || $row_select_pipe1["sieve_6"] == "63.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "63" || $row_select_pipe1["sieve_7"] == "63.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "63" || $row_select_pipe1["sieve_8"] == "63.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "63" || $row_select_pipe1["sieve_9"] == "63.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "63" || $row_select_pipe1["sieve_10"] == "63.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "63" || $row_select_pipe1["sieve_11"] == "63.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "63" || $row_select_pipe1["sieve_12"] == "63.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "53" || $row_select_pipe1["sieve_1"] == "53.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "53" || $row_select_pipe1["sieve_2"] == "53.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "53" || $row_select_pipe1["sieve_3"] == "53.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "53" || $row_select_pipe1["sieve_4"] == "53.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "53" || $row_select_pipe1["sieve_5"] == "53.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "53" || $row_select_pipe1["sieve_6"] == "53.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "53" || $row_select_pipe1["sieve_7"] == "53.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "53" || $row_select_pipe1["sieve_8"] == "53.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "53" || $row_select_pipe1["sieve_9"] == "53.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "53" || $row_select_pipe1["sieve_10"] == "53.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "53" || $row_select_pipe1["sieve_11"] == "53.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "53" || $row_select_pipe1["sieve_12"] == "53.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "45" || $row_select_pipe1["sieve_1"] == "45.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "45" || $row_select_pipe1["sieve_2"] == "45.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "45" || $row_select_pipe1["sieve_3"] == "45.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "45" || $row_select_pipe1["sieve_4"] == "45.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "45" || $row_select_pipe1["sieve_5"] == "45.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "45" || $row_select_pipe1["sieve_6"] == "45.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "45" || $row_select_pipe1["sieve_7"] == "45.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "45" || $row_select_pipe1["sieve_8"] == "45.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "45" || $row_select_pipe1["sieve_9"] == "45.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "45" || $row_select_pipe1["sieve_10"] == "45.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "45" || $row_select_pipe1["sieve_11"] == "45.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "45" || $row_select_pipe1["sieve_12"] == "45.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "40" || $row_select_pipe1["sieve_1"] == "40.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "40" || $row_select_pipe1["sieve_2"] == "40.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "40" || $row_select_pipe1["sieve_3"] == "40.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "40" || $row_select_pipe1["sieve_4"] == "40.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "40" || $row_select_pipe1["sieve_5"] == "40.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "40" || $row_select_pipe1["sieve_6"] == "40.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "40" || $row_select_pipe1["sieve_7"] == "40.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "40" || $row_select_pipe1["sieve_8"] == "40.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "40" || $row_select_pipe1["sieve_9"] == "40.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "40" || $row_select_pipe1["sieve_10"] == "40.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "40" || $row_select_pipe1["sieve_11"] == "40.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "40" || $row_select_pipe1["sieve_12"] == "40.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "37.5" || $row_select_pipe1["sieve_1"] == "37.50") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "37.5" || $row_select_pipe1["sieve_2"] == "37.50") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "37.5" || $row_select_pipe1["sieve_3"] == "37.50") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "37.5" || $row_select_pipe1["sieve_4"] == "37.50") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "37.5" || $row_select_pipe1["sieve_5"] == "37.50") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "37.5" || $row_select_pipe1["sieve_6"] == "37.50") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "37.5" || $row_select_pipe1["sieve_7"] == "37.50") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "37.5" || $row_select_pipe1["sieve_8"] == "37.50") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "37.5" || $row_select_pipe1["sieve_9"] == "37.50") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "37.5" || $row_select_pipe1["sieve_10"] == "37.50") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "37.5" || $row_select_pipe1["sieve_11"] == "37.50") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "37.5" || $row_select_pipe1["sieve_12"] == "37.50") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "26.5" || $row_select_pipe1["sieve_1"] == "26.50") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "26.5" || $row_select_pipe1["sieve_2"] == "26.50") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "26.5" || $row_select_pipe1["sieve_3"] == "26.50") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "26.5" || $row_select_pipe1["sieve_4"] == "26.50") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "26.5" || $row_select_pipe1["sieve_5"] == "26.50") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "26.5" || $row_select_pipe1["sieve_6"] == "26.50") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "26.5" || $row_select_pipe1["sieve_7"] == "26.50") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "26.5" || $row_select_pipe1["sieve_8"] == "26.50") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "26.5" || $row_select_pipe1["sieve_9"] == "26.50") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "26.5" || $row_select_pipe1["sieve_10"] == "26.50") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "26.5" || $row_select_pipe1["sieve_11"] == "26.50") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "26.5" || $row_select_pipe1["sieve_12"] == "26.50") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "25" || $row_select_pipe1["sieve_1"] == "25.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "25" || $row_select_pipe1["sieve_2"] == "25.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "25" || $row_select_pipe1["sieve_3"] == "25.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "25" || $row_select_pipe1["sieve_4"] == "25.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "25" || $row_select_pipe1["sieve_5"] == "25.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "25" || $row_select_pipe1["sieve_6"] == "25.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "25" || $row_select_pipe1["sieve_7"] == "25.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "25" || $row_select_pipe1["sieve_8"] == "25.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "25" || $row_select_pipe1["sieve_9"] == "25.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "25" || $row_select_pipe1["sieve_10"] == "25.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "25" || $row_select_pipe1["sieve_11"] == "25.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "25" || $row_select_pipe1["sieve_12"] == "25.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "22.4" || $row_select_pipe1["sieve_1"] == "22.40") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "22.4" || $row_select_pipe1["sieve_2"] == "22.40") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "22.4" || $row_select_pipe1["sieve_3"] == "22.40") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "22.4" || $row_select_pipe1["sieve_4"] == "22.40") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "22.4" || $row_select_pipe1["sieve_5"] == "22.40") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "22.4" || $row_select_pipe1["sieve_6"] == "22.40") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "22.4" || $row_select_pipe1["sieve_7"] == "22.40") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "22.4" || $row_select_pipe1["sieve_8"] == "22.40") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "22.4" || $row_select_pipe1["sieve_9"] == "22.40") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "22.4" || $row_select_pipe1["sieve_10"] == "22.40") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "22.4" || $row_select_pipe1["sieve_11"] == "22.40") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "22.4" || $row_select_pipe1["sieve_12"] == "22.40") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "20" || $row_select_pipe1["sieve_1"] == "20.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "20" || $row_select_pipe1["sieve_2"] == "20.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "20" || $row_select_pipe1["sieve_3"] == "20.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "20" || $row_select_pipe1["sieve_4"] == "20.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "20" || $row_select_pipe1["sieve_5"] == "20.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "20" || $row_select_pipe1["sieve_6"] == "20.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "20" || $row_select_pipe1["sieve_7"] == "20.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "20" || $row_select_pipe1["sieve_8"] == "20.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "20" || $row_select_pipe1["sieve_9"] == "20.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "20" || $row_select_pipe1["sieve_10"] == "20.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "20" || $row_select_pipe1["sieve_11"] == "20.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "20" || $row_select_pipe1["sieve_12"] == "20.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "19" || $row_select_pipe1["sieve_1"] == "19.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "19" || $row_select_pipe1["sieve_2"] == "19.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "19" || $row_select_pipe1["sieve_3"] == "19.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "19" || $row_select_pipe1["sieve_4"] == "19.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "19" || $row_select_pipe1["sieve_5"] == "19.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "19" || $row_select_pipe1["sieve_6"] == "19.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "19" || $row_select_pipe1["sieve_7"] == "19.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "19" || $row_select_pipe1["sieve_8"] == "19.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "19" || $row_select_pipe1["sieve_9"] == "19.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "19" || $row_select_pipe1["sieve_10"] == "19.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "19" || $row_select_pipe1["sieve_11"] == "19.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "19" || $row_select_pipe1["sieve_12"] == "19.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "16" || $row_select_pipe1["sieve_1"] == "16.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "16" || $row_select_pipe1["sieve_2"] == "16.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "16" || $row_select_pipe1["sieve_3"] == "16.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "16" || $row_select_pipe1["sieve_4"] == "16.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "16" || $row_select_pipe1["sieve_5"] == "16.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "16" || $row_select_pipe1["sieve_6"] == "16.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "16" || $row_select_pipe1["sieve_7"] == "16.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "16" || $row_select_pipe1["sieve_8"] == "16.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "16" || $row_select_pipe1["sieve_9"] == "16.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "16" || $row_select_pipe1["sieve_10"] == "16.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "16" || $row_select_pipe1["sieve_11"] == "16.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "16" || $row_select_pipe1["sieve_12"] == "16.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "13.2" || $row_select_pipe1["sieve_1"] == "13.20") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "13.2" || $row_select_pipe1["sieve_2"] == "13.20") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "13.2" || $row_select_pipe1["sieve_3"] == "13.20") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "13.2" || $row_select_pipe1["sieve_4"] == "13.20") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "13.2" || $row_select_pipe1["sieve_5"] == "13.20") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "13.2" || $row_select_pipe1["sieve_6"] == "13.20") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "13.2" || $row_select_pipe1["sieve_7"] == "13.20") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "13.2" || $row_select_pipe1["sieve_8"] == "13.20") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "13.2" || $row_select_pipe1["sieve_9"] == "13.20") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "13.2" || $row_select_pipe1["sieve_10"] == "13.20") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "13.2" || $row_select_pipe1["sieve_11"] == "13.20") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "13.2" || $row_select_pipe1["sieve_12"] == "13.20") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "12.5" || $row_select_pipe1["sieve_1"] == "12.50") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "12.5" || $row_select_pipe1["sieve_2"] == "12.50") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "12.5" || $row_select_pipe1["sieve_3"] == "12.50") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "12.5" || $row_select_pipe1["sieve_4"] == "12.50") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "12.5" || $row_select_pipe1["sieve_5"] == "12.50") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "12.5" || $row_select_pipe1["sieve_6"] == "12.50") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "12.5" || $row_select_pipe1["sieve_7"] == "12.50") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "12.5" || $row_select_pipe1["sieve_8"] == "12.50") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "12.5" || $row_select_pipe1["sieve_9"] == "12.50") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "12.5" || $row_select_pipe1["sieve_10"] == "12.50") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "12.5" || $row_select_pipe1["sieve_11"] == "12.50") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "12.5" || $row_select_pipe1["sieve_12"] == "12.50") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "11.2" || $row_select_pipe1["sieve_1"] == "11.20") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "11.2" || $row_select_pipe1["sieve_2"] == "11.20") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "11.2" || $row_select_pipe1["sieve_3"] == "11.20") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "11.2" || $row_select_pipe1["sieve_4"] == "11.20") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "11.2" || $row_select_pipe1["sieve_5"] == "11.20") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "11.2" || $row_select_pipe1["sieve_6"] == "11.20") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "11.2" || $row_select_pipe1["sieve_7"] == "11.20") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "11.2" || $row_select_pipe1["sieve_8"] == "11.20") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "11.2" || $row_select_pipe1["sieve_9"] == "11.20") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "11.2" || $row_select_pipe1["sieve_10"] == "11.20") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "11.2" || $row_select_pipe1["sieve_11"] == "11.20") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "11.2" || $row_select_pipe1["sieve_12"] == "11.20") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "10" || $row_select_pipe1["sieve_1"] == "10.0") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "10" || $row_select_pipe1["sieve_2"] == "10.0") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "10" || $row_select_pipe1["sieve_3"] == "10.0") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "10" || $row_select_pipe1["sieve_4"] == "10.0") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "10" || $row_select_pipe1["sieve_5"] == "10.0") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "10" || $row_select_pipe1["sieve_6"] == "10.0") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "10" || $row_select_pipe1["sieve_7"] == "10.0") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "10" || $row_select_pipe1["sieve_8"] == "10.0") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "10" || $row_select_pipe1["sieve_9"] == "10.0") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "10" || $row_select_pipe1["sieve_10"] == "10.0") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "10" || $row_select_pipe1["sieve_11"] == "10.0") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "10" || $row_select_pipe1["sieve_12"] == "10.0") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "9.5" || $row_select_pipe1["sieve_1"] == "9.50") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "9.5" || $row_select_pipe1["sieve_2"] == "9.50") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "9.5" || $row_select_pipe1["sieve_3"] == "9.50") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "9.5" || $row_select_pipe1["sieve_4"] == "9.50") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "9.5" || $row_select_pipe1["sieve_5"] == "9.50") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "9.5" || $row_select_pipe1["sieve_6"] == "9.50") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "9.5" || $row_select_pipe1["sieve_7"] == "9.50") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "9.5" || $row_select_pipe1["sieve_8"] == "9.50") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "9.5" || $row_select_pipe1["sieve_9"] == "9.50") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "9.5" || $row_select_pipe1["sieve_10"] == "9.50") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "9.5" || $row_select_pipe1["sieve_11"] == "9.50") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "9.5" || $row_select_pipe1["sieve_12"] == "9.50") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "6.3" || $row_select_pipe1["sieve_1"] == "6.30") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "6.3" || $row_select_pipe1["sieve_2"] == "6.30") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "6.3" || $row_select_pipe1["sieve_3"] == "6.30") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "6.3" || $row_select_pipe1["sieve_4"] == "6.30") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "6.3" || $row_select_pipe1["sieve_5"] == "6.30") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "6.3" || $row_select_pipe1["sieve_6"] == "6.30") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "6.3" || $row_select_pipe1["sieve_7"] == "6.30") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "6.3" || $row_select_pipe1["sieve_8"] == "6.30") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "6.3" || $row_select_pipe1["sieve_9"] == "6.30") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "6.3" || $row_select_pipe1["sieve_10"] == "6.30") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "6.3" || $row_select_pipe1["sieve_11"] == "6.30") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "6.3" || $row_select_pipe1["sieve_12"] == "6.30") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "5.6" || $row_select_pipe1["sieve_1"] == "5.60") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "5.6" || $row_select_pipe1["sieve_2"] == "5.60") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "5.6" || $row_select_pipe1["sieve_3"] == "5.60") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "5.6" || $row_select_pipe1["sieve_4"] == "5.60") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "5.6" || $row_select_pipe1["sieve_5"] == "5.60") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "5.6" || $row_select_pipe1["sieve_6"] == "5.60") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "5.6" || $row_select_pipe1["sieve_7"] == "5.60") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "5.6" || $row_select_pipe1["sieve_8"] == "5.60") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "5.6" || $row_select_pipe1["sieve_9"] == "5.60") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "5.6" || $row_select_pipe1["sieve_10"] == "5.60") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "5.6" || $row_select_pipe1["sieve_11"] == "5.60") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "5.6" || $row_select_pipe1["sieve_12"] == "5.60") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "4.75" || $row_select_pipe1["sieve_1"] == "4.75") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "4.75" || $row_select_pipe1["sieve_2"] == "4.75") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "4.75" || $row_select_pipe1["sieve_3"] == "4.75") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "4.75" || $row_select_pipe1["sieve_4"] == "4.75") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "4.75" || $row_select_pipe1["sieve_5"] == "4.75") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "4.75" || $row_select_pipe1["sieve_6"] == "4.75") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "4.75" || $row_select_pipe1["sieve_7"] == "4.75") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "4.75" || $row_select_pipe1["sieve_8"] == "4.75") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "4.75" || $row_select_pipe1["sieve_9"] == "4.75") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "4.75" || $row_select_pipe1["sieve_10"] == "4.75") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "4.75" || $row_select_pipe1["sieve_11"] == "4.75") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "4.75" || $row_select_pipe1["sieve_12"] == "4.75") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "2.8" || $row_select_pipe1["sieve_1"] == "2.80") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "2.8" || $row_select_pipe1["sieve_2"] == "2.80") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "2.8" || $row_select_pipe1["sieve_3"] == "2.80") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "2.8" || $row_select_pipe1["sieve_4"] == "2.80") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "2.8" || $row_select_pipe1["sieve_5"] == "2.80") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "2.8" || $row_select_pipe1["sieve_6"] == "2.80") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "2.8" || $row_select_pipe1["sieve_7"] == "2.80") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "2.8" || $row_select_pipe1["sieve_8"] == "2.80") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "2.8" || $row_select_pipe1["sieve_9"] == "2.80") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "2.8" || $row_select_pipe1["sieve_10"] == "2.80") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "2.8" || $row_select_pipe1["sieve_11"] == "2.80") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "2.8" || $row_select_pipe1["sieve_12"] == "2.80") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "2.36" || $row_select_pipe1["sieve_1"] == "2.36") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "2.36" || $row_select_pipe1["sieve_2"] == "2.36") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "2.36" || $row_select_pipe1["sieve_3"] == "2.36") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "2.36" || $row_select_pipe1["sieve_4"] == "2.36") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "2.36" || $row_select_pipe1["sieve_5"] == "2.36") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "2.36" || $row_select_pipe1["sieve_6"] == "2.36") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "2.36" || $row_select_pipe1["sieve_7"] == "2.36") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "2.36" || $row_select_pipe1["sieve_8"] == "2.36") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "2.36" || $row_select_pipe1["sieve_9"] == "2.36") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "2.36" || $row_select_pipe1["sieve_10"] == "2.36") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "2.36" || $row_select_pipe1["sieve_11"] == "2.36") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "2.36" || $row_select_pipe1["sieve_12"] == "2.36") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "1.18" || $row_select_pipe1["sieve_1"] == "1.18") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "1.18" || $row_select_pipe1["sieve_2"] == "1.18") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "1.18" || $row_select_pipe1["sieve_3"] == "1.18") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "1.18" || $row_select_pipe1["sieve_4"] == "1.18") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "1.18" || $row_select_pipe1["sieve_5"] == "1.18") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "1.18" || $row_select_pipe1["sieve_6"] == "1.18") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "1.18" || $row_select_pipe1["sieve_7"] == "1.18") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "1.18" || $row_select_pipe1["sieve_8"] == "1.18") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "1.18" || $row_select_pipe1["sieve_9"] == "1.18") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "1.18" || $row_select_pipe1["sieve_10"] == "1.18") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "1.18" || $row_select_pipe1["sieve_11"] == "1.18") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "1.18" || $row_select_pipe1["sieve_12"] == "1.18") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "0.85" || $row_select_pipe1["sieve_1"] == "0.850") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "0.85" || $row_select_pipe1["sieve_2"] == "0.850") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "0.85" || $row_select_pipe1["sieve_3"] == "0.850") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "0.85" || $row_select_pipe1["sieve_4"] == "0.850") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "0.85" || $row_select_pipe1["sieve_5"] == "0.850") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "0.85" || $row_select_pipe1["sieve_6"] == "0.850") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "0.85" || $row_select_pipe1["sieve_7"] == "0.850") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "0.85" || $row_select_pipe1["sieve_8"] == "0.850") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "0.85" || $row_select_pipe1["sieve_9"] == "0.850") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "0.85" || $row_select_pipe1["sieve_10"] == "0.850") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "0.85" || $row_select_pipe1["sieve_11"] == "0.850") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "0.85" || $row_select_pipe1["sieve_12"] == "0.850") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "0.6" || $row_select_pipe1["sieve_1"] == "0.60" || $row_select_pipe1["sieve_1"] == "0.600") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "0.6" || $row_select_pipe1["sieve_2"] == "0.60" || $row_select_pipe1["sieve_2"] == "0.600") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "0.6" || $row_select_pipe1["sieve_3"] == "0.60" || $row_select_pipe1["sieve_3"] == "0.600") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "0.6" || $row_select_pipe1["sieve_4"] == "0.60" || $row_select_pipe1["sieve_4"] == "0.600") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "0.6" || $row_select_pipe1["sieve_5"] == "0.60" || $row_select_pipe1["sieve_5"] == "0.600") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "0.6" || $row_select_pipe1["sieve_6"] == "0.60" || $row_select_pipe1["sieve_6"] == "0.600") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "0.6" || $row_select_pipe1["sieve_7"] == "0.60" || $row_select_pipe1["sieve_7"] == "0.600") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "0.6" || $row_select_pipe1["sieve_8"] == "0.60" || $row_select_pipe1["sieve_8"] == "0.600") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "0.6" || $row_select_pipe1["sieve_9"] == "0.60" || $row_select_pipe1["sieve_9"] == "0.600") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "0.6" || $row_select_pipe1["sieve_10"] == "0.60" || $row_select_pipe1["sieve_10"] == "0.600") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "0.6" || $row_select_pipe1["sieve_11"] == "0.60" || $row_select_pipe1["sieve_11"] == "0.600") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "0.6" || $row_select_pipe1["sieve_12"] == "0.60" || $row_select_pipe1["sieve_12"] == "0.600") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "0.425" || $row_select_pipe1["sieve_1"] == "0.425") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "0.425" || $row_select_pipe1["sieve_2"] == "0.425") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "0.425" || $row_select_pipe1["sieve_3"] == "0.425") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "0.425" || $row_select_pipe1["sieve_4"] == "0.425") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "0.425" || $row_select_pipe1["sieve_5"] == "0.425") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "0.425" || $row_select_pipe1["sieve_6"] == "0.425") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "0.425" || $row_select_pipe1["sieve_7"] == "0.425") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "0.425" || $row_select_pipe1["sieve_8"] == "0.425") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "0.425" || $row_select_pipe1["sieve_9"] == "0.425") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "0.425" || $row_select_pipe1["sieve_10"] == "0.425") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "0.425" || $row_select_pipe1["sieve_11"] == "0.425") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "0.425" || $row_select_pipe1["sieve_12"] == "0.425") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "0.3" || $row_select_pipe1["sieve_1"] == "0.30" || $row_select_pipe1["sieve_1"] == "0.300") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "0.3" || $row_select_pipe1["sieve_2"] == "0.30" || $row_select_pipe1["sieve_2"] == "0.300") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "0.3" || $row_select_pipe1["sieve_3"] == "0.30" || $row_select_pipe1["sieve_3"] == "0.300") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "0.3" || $row_select_pipe1["sieve_4"] == "0.30" || $row_select_pipe1["sieve_4"] == "0.300") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "0.3" || $row_select_pipe1["sieve_5"] == "0.30" || $row_select_pipe1["sieve_5"] == "0.300") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "0.3" || $row_select_pipe1["sieve_6"] == "0.30" || $row_select_pipe1["sieve_6"] == "0.300") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "0.3" || $row_select_pipe1["sieve_7"] == "0.30" || $row_select_pipe1["sieve_7"] == "0.300") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "0.3" || $row_select_pipe1["sieve_8"] == "0.30" || $row_select_pipe1["sieve_8"] == "0.300") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "0.3" || $row_select_pipe1["sieve_9"] == "0.30" || $row_select_pipe1["sieve_9"] == "0.300") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "0.3" || $row_select_pipe1["sieve_10"] == "0.30" || $row_select_pipe1["sieve_10"] == "0.300") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "0.3" || $row_select_pipe1["sieve_11"] == "0.30" || $row_select_pipe1["sieve_11"] == "0.300") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "0.3" || $row_select_pipe1["sieve_12"] == "0.30" || $row_select_pipe1["sieve_12"] == "0.300") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "0.18" || $row_select_pipe1["sieve_1"] == "0.180") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "0.18" || $row_select_pipe1["sieve_2"] == "0.180") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "0.18" || $row_select_pipe1["sieve_3"] == "0.180") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "0.18" || $row_select_pipe1["sieve_4"] == "0.180") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "0.18" || $row_select_pipe1["sieve_5"] == "0.180") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "0.18" || $row_select_pipe1["sieve_6"] == "0.180") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "0.18" || $row_select_pipe1["sieve_7"] == "0.180") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "0.18" || $row_select_pipe1["sieve_8"] == "0.180") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "0.18" || $row_select_pipe1["sieve_9"] == "0.180") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "0.18" || $row_select_pipe1["sieve_10"] == "0.180") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "0.18" || $row_select_pipe1["sieve_11"] == "0.180") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "0.18" || $row_select_pipe1["sieve_12"] == "0.180") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "0.15" || $row_select_pipe1["sieve_1"] == "0.150") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "0.15" || $row_select_pipe1["sieve_2"] == "0.150") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "0.15" || $row_select_pipe1["sieve_3"] == "0.150") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "0.15" || $row_select_pipe1["sieve_4"] == "0.150") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "0.15" || $row_select_pipe1["sieve_5"] == "0.150") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "0.15" || $row_select_pipe1["sieve_6"] == "0.150") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "0.15" || $row_select_pipe1["sieve_7"] == "0.150") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "0.15" || $row_select_pipe1["sieve_8"] == "0.150") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "0.15" || $row_select_pipe1["sieve_9"] == "0.150") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "0.15" || $row_select_pipe1["sieve_10"] == "0.150") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "0.15" || $row_select_pipe1["sieve_11"] == "0.150") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "0.15" || $row_select_pipe1["sieve_12"] == "0.150") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "0.09" || $row_select_pipe1["sieve_1"] == "0.09") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "0.09" || $row_select_pipe1["sieve_2"] == "0.09") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "0.09" || $row_select_pipe1["sieve_3"] == "0.09") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "0.09" || $row_select_pipe1["sieve_4"] == "0.09") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "0.09" || $row_select_pipe1["sieve_5"] == "0.09") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "0.09" || $row_select_pipe1["sieve_6"] == "0.09") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "0.09" || $row_select_pipe1["sieve_7"] == "0.09") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "0.09" || $row_select_pipe1["sieve_8"] == "0.09") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "0.09" || $row_select_pipe1["sieve_9"] == "0.09") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "0.09" || $row_select_pipe1["sieve_10"] == "0.09") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "0.09" || $row_select_pipe1["sieve_11"] == "0.09") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "0.09" || $row_select_pipe1["sieve_12"] == "0.09") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">
															<?php
															if ($row_select_pipe1["sieve_1"] == "0.075" || $row_select_pipe1["sieve_1"] == "0.075") {
																echo $row_select_pipe1["pass_sample_1"];
															} else if ($row_select_pipe1["sieve_2"] == "0.075" || $row_select_pipe1["sieve_2"] == "0.075") {
																echo $row_select_pipe1["pass_sample_2"];
															} else if ($row_select_pipe1["sieve_3"] == "0.075" || $row_select_pipe1["sieve_3"] == "0.075") {
																echo $row_select_pipe1["pass_sample_3"];
															} else if ($row_select_pipe1["sieve_4"] == "0.075" || $row_select_pipe1["sieve_4"] == "0.075") {
																echo $row_select_pipe1["pass_sample_4"];
															} else if ($row_select_pipe1["sieve_5"] == "0.075" || $row_select_pipe1["sieve_5"] == "0.075") {
																echo $row_select_pipe1["pass_sample_5"];
															} else if ($row_select_pipe1["sieve_6"] == "0.075" || $row_select_pipe1["sieve_6"] == "0.075") {
																echo $row_select_pipe1["pass_sample_6"];
															} else if ($row_select_pipe1["sieve_7"] == "0.075" || $row_select_pipe1["sieve_7"] == "0.075") {
																echo $row_select_pipe1["pass_sample_7"];
															} else if ($row_select_pipe1["sieve_8"] == "0.075" || $row_select_pipe1["sieve_8"] == "0.075") {
																echo $row_select_pipe1["pass_sample_8"];
															} else if ($row_select_pipe1["sieve_9"] == "0.075" || $row_select_pipe1["sieve_9"] == "0.075") {
																echo $row_select_pipe1["pass_sample_9"];
															} else if ($row_select_pipe1["sieve_10"] == "0.075" || $row_select_pipe1["sieve_10"] == "0.075") {
																echo $row_select_pipe1["pass_sample_10"];
															} else if ($row_select_pipe1["sieve_11"] == "0.075" || $row_select_pipe1["sieve_11"] == "0.075") {
																echo $row_select_pipe1["pass_sample_11"];
															} else if ($row_select_pipe1["sieve_12"] == "0.075" || $row_select_pipe1["sieve_12"] == "0.075") {
																echo $row_select_pipe1["pass_sample_12"];
															}
															?>

														</td>
														<td style="text-align:center">Chintan</td>
														<td style="text-align:center"></td>

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
		} ?>


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
