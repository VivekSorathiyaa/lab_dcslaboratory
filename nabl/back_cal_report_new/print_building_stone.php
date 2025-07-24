			<?php
			session_start();
			include("../connection.php");
			error_reporting(1); ?>
			<style>
				@page {
					size: 4in 6in;
					margin: auto;
					margin-left: 40px;
					margin-right: 0px;
					margin-top: 0px;
					margin-bottom: 5px;
					padding-top: 10px;
				}

				.pagebreak {
					page-break-before: always;
				}

				@media print {
					@page {
						size: landscape
					}
				}
			</style>
			<style>
				.tdclass {
					border: 1px solid black;
					font-size: 11px;
					font-family: arial;
				}

				.test {
					border-collapse: collapse;
					font-size: 11px;
					font-family: arial;
				}

				.tdclass1 {

					font-size: 11px;
					font-family: arial;
				}
			</style>
			<html>

			<body>
				<?php
				$job_no = $_GET['job_no'];
				$lab_no = $_GET['lab_no'];
				$report_no = $_GET['report_no'];
				$trf_no = $_GET['trf_no'];
				$select_tiles_query = "select * from granite_stone WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
				$result_tiles_select = mysqli_query($conn, $select_tiles_query);
				$row_select_pipe = mysqli_fetch_array($result_tiles_select);

				$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
				$result_select = mysqli_query($conn, $select_query);

				$row_select = mysqli_fetch_array($result_select);
				$clientname = $row_select['clientname'];
				$r_name = $row_select['refno'];
				$sr_no = $row_select['sr_no'];
				$sample_no = $row_select['job_no'];
				$rec_sample_date = $row_select['sample_rec_date'];
				$cons = $row_select['condition_of_sample_receved'];
				if ($cons == 0) {
					$con_sample = "Sealed Ok";
				} else {
					$con_sample = "Unsealed";
				}
				$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

				$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
				$result_select1 = mysqli_query($conn, $select_query1);

				if (mysqli_num_rows($result_select1) > 0) {
					$row_select1 = mysqli_fetch_assoc($result_select1);
					$agency_name = $row_select1['agency_name'];
				}

				$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
				$result_select2 = mysqli_query($conn, $select_query2);

				if (mysqli_num_rows($result_select2) > 0) {
					$row_select2 = mysqli_fetch_assoc($result_select2);
					$start_date = $row_select2['start_date'];
					$end_date = $row_select2['end_date'];
					$issue_date = $row_select2['issue_date'];

					$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
					$result_select3 = mysqli_query($conn, $select_query3);

					if (mysqli_num_rows($result_select3) > 0) {
						$row_select3 = mysqli_fetch_assoc($result_select3);
						$detail_sample = $row_select3['mt_name'];
					}
				}

				$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$depths = $row_select4['bs_depth'];
					$location = $row_select4['bs_location'];
					$bhno = $row_select4['bs_bhno'];
				}

				?>

				<br>

				<page size="A4" layout="landscape">
					<?php
					/*if($row_select_pipe['chk_wtr']== 1)
				{*/
					?>
					<table align="center" width="90%" class="test" border="1px" height="30%">
						<tr>
							<td colspan="12" style="font-size:13px">
								<center><b>Span Infrastructure Material Testing & Consultancy Service Limited</b></center>
							</td>
						</tr>
						<tr>
							<td colspan="12"><b>Determination of water Absorption of Natural Builing stone (As per IS :1127 - 1974,[RA - 2013])</b></td>
						</tr>
						<tr>
							<td colspan="6"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
							<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
						</tr>
						<tr>
							<td colspan="6"><b>Name of Location :</b> &nbsp;&nbsp; <?php echo $location; ?><?php if ($material_location == 1) {
																												echo "In Laboratory";
																											} else {
																												echo "In Field";
																											} ?></td>
							<td colspan="6"><b>RECEIVED SAMPLE :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr>
							<td colspan="6"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							<td colspan="6"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date . ' + 1 days')); ?></td>
						</tr>
						<tr>
							<td colspan="6" rowspan="2">
								<center><b>Observation</b></center>
							</td>
							<td colspan="6">
								<center><b>SAMPLE</b></center>
							</td>

						</tr>
						<tr>

							<td colspan="2">
								<center><b>I</b></center>
							</td>
							<td colspan="2">
								<center><b>II</b></center>
							</td>
							<td colspan="2">
								<center><b>III</b></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Weight of the saturated surface dry test piece in W1 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Weight of oven dry test piece in W2 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Water Absorption (%) (W1 - W2 / W2) X 100</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['wtr1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['wtr2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['wtr3']; ?></center>
							</td>

						</tr>

						<tr>
							<td colspan="6">
								<center>Average Water Absorption (%)</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_wtr']; ?></center>
							</td>

						</tr>

						<br>
						<br>
					</table>
					<br>
					<table align="center" width="90%" class="test" height="5%" border="1">
						<tr>
							<td><b>Tested By :</b></td>
							<td align=""><b>Checked By:</b></td>
						</tr>
					</table>

					<? php/* }
			   if ($row_select_pipe['chk_t_sp'] == 1)
				{*/
					?>
					<br>
					<br>
					<!--Specific Gravity Water Abrasion-->
					<table align="center" width="90%" class="test" border="1px" height="30%">
						<tr>
							<td colspan="12" style="font-size:13px">
								<center><b>Span Infrastructure Material Testing & Consultancy Service Limited</b></center>
							</td>
						</tr>
						<tr>
							<td colspan="12"><b>Determination of True Specific Gravity of Natural Builing stone (As per IS :1122 - 1974,[RA - 2017])</b></td>
						</tr>
						<tr>
							<td colspan="6"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
							<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
						</tr>
						<tr>
							<td colspan="6"><b>Name of Location :</b> &nbsp;&nbsp; <?php echo $location; ?></td>
							<td colspan="6"><b>RECEIVED SAMPLE :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr>
							<td colspan="6"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							<td colspan="6"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date . ' + 1 days')); ?></td>
						</tr>
						<tr>
							<td colspan="6" rowspan="2">
								<center><b>Observation</b></center>
							</td>
							<td colspan="6">
								<center><b>SAMPLE</b></center>
							</td>

						</tr>
						<tr>

							<td colspan="2">
								<center><b>I</b></center>
							</td>
							<td colspan="2">
								<center><b>II</b></center>
							</td>
							<td colspan="2">
								<center><b>III</b></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Weight of the empty specific gravity bottle with stopper W1 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w1_1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w1_2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w1_3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Weight of specific gravity bottle with stopper and stone powder W2 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w2_1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w2_2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w2_3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Weight of specific gravity bottle with stopper and stone powder and distilled water W3 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w3_1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w3_2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w3_3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Weight of specific gravity bottle with stopper and Fully filled with distilled water W4 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w4_1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w4_2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w4_3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>True Specific Gravity = W2 - W1 / [(W4 - W1)-(W3 - W2)]</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['spg_1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['spg_2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['spg_3']; ?></center>
							</td>

						</tr>

						<tr>
							<td colspan="6">
								<center>Average True Specific Gravity</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_spg']; ?></center>
							</td>

						</tr>

						<br>
						<br>
					</table>
					<br>
					<table align="center" width="90%" class="test" height="5%" border="1">
						<tr>
							<td><b>Tested By :</b></td>
							<td align=""><b>Checked By:</b></td>
						</tr>
					</table>
					<div class="pagebreak"></div>

					<? php/* }*/ ?>



					<?php
					/*  if ($row_select_pipe['chk_sp'] == 1)
				{*/
					?>

					<!--Specific Gravity Water Abrasion-->
					<table align="center" width="90%" class="test" border="1px" height="30%">
						<tr>
							<td colspan="12" style="font-size:13px">
								<center><b>Span Infrastructure Material Testing & Consultancy Service Limited</b></center>
							</td>
						</tr>
						<tr>
							<td colspan="12"><b>Determination of Apparent Specific Gravity of Natural Builing stone (As per IS :1124 - 1974,[RA - 2013])</b></td>
						</tr>
						<tr>
							<td colspan="6"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
							<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
						</tr>
						<tr>
							<td colspan="6"><b>Name of Location :</b> &nbsp;&nbsp; <?php echo $location; ?></td>
							<td colspan="6"><b>RECEIVED SAMPLE :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr>
							<td colspan="6"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							<td colspan="6"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date . ' + 1 days')); ?></td>
						</tr>
						<tr>
							<td colspan="6" rowspan="2">
								<center><b>Observation</b></center>
							</td>
							<td colspan="6">
								<center><b>SAMPLE</b></center>
							</td>

						</tr>
						<tr>

							<td colspan="2">
								<center><b>I</b></center>
							</td>
							<td colspan="2">
								<center><b>II</b></center>
							</td>
							<td colspan="2">
								<center><b>III</b></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Weight of Oven-Dry Sample (g)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Weight of Saturated Surface Dry Sample (g) B</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Qunaity of Water Added in 1000 ML jar (g) C</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['c1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['c2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['c3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center>Apparent Specific Gravity = A / (1000-C)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['asg1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['asg2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['asg3']; ?></center>
							</td>

						</tr>


						<tr>
							<td colspan="6">
								<center>Average Apparent Specific Gravity</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_asg']; ?></center>
							</td>

						</tr>

						<br>
						<br>
					</table>
					<br>
					<table align="center" width="90%" class="test" height="5%" border="1">
						<tr>
							<td><b>Tested By :</b></td>
							<td align=""><b>Checked By:</b></td>
						</tr>
					</table>


					<?php /*}*/ ?>
					<?php
					/*  if ($row_select_pipe['chk_com'] == 1)
				{*/
					?>
					<br>
					<br>
					<!--Specific Gravity Water Abrasion-->
					<table align="center" width="90%" class="test" border="1px" height="30%">
						<tr>
							<td colspan="12" style="font-size:13px">
								<center><b>Span Infrastructure Material Testing & Consultancy Service Limited</b></center>
							</td>
						</tr>
						<tr>
							<td colspan="12"><b>Determination of Compressive Strength of Natural Builing stone (As per IS :1121 (P-1) - 1974,[RA - 2017])</b></td>
						</tr>
						<tr>
							<td colspan="6"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
							<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
						</tr>
						<tr>
							<td colspan="6"><b>Name of Location :</b> &nbsp;&nbsp; <?php echo $location; ?></td>
							<td colspan="6"><b>RECEIVED SAMPLE :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr>
							<td colspan="6"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							<td colspan="6"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date . ' + 1 days')); ?></td>
						</tr>
						<tr>
							<td colspan="6"><b>Dia. Of Specimen (b) :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['dia']; ?></td>
							<td colspan="6"><b>Height of Specimen (h) :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['height']; ?></td>
						</tr>
						<tr>
							<td colspan="7" rowspan="2">
								<center><b>Observation</b></center>
							</td>
							<td colspan="5">
								<center><b>SAMPLE</b></center>
							</td>

						</tr>
						<tr>

							<td colspan="1">
								<center><b>I</b></center>
							</td>
							<td colspan="1">
								<center><b>II</b></center>
							</td>
							<td colspan="1">
								<center><b>III</b></center>
							</td>
							<td colspan="1">
								<center><b>IV</b></center>
							</td>
							<td colspan="1">
								<center><b>V</b></center>
							</td>

						</tr>
						<tr>
							<td colspan="7">
								<center>Maximum load applied to the test piece before filure A (kg)</center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['load1']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['load2']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['load3']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['load4']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['load5']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="7">
								<center>Area of bearing face of the test piece B (cm<sup>2</sup>)</center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['area1']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['area2']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['area3']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['area4']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['area5']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="7">
								<center>(i) When ratio of height to diameter is greater then compressive strength (C<sub>p</sub>) = A/B (kg/cm<sup>2</sup>)</center>
							</td>
							<td colspan="1">
								<center><?php echo substr(($row_select_pipe['load1'] / $row_select_pipe['area1']), 0, 5); ?></center>
							</td>
							<td colspan="1">
								<center><?php echo substr(($row_select_pipe['load2'] / $row_select_pipe['area2']), 0, 5); ?></center>
							</td>
							<td colspan="1">
								<center><?php echo substr(($row_select_pipe['load3'] / $row_select_pipe['area3']), 0, 5); ?></center>
							</td>
							<td colspan="1">
								<center><?php echo substr(($row_select_pipe['load4'] / $row_select_pipe['area4']), 0, 5); ?></center>
							</td>
							<td colspan="1">
								<center><?php echo substr(($row_select_pipe['load5'] / $row_select_pipe['area5']), 0, 5); ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="7">
								<center>(ii) When ratio of height to diameter differs from unity by 25% or more compressive strength (C<sub>c</sub>) = (C<sub>p</sub>) / 0.778 + 0.222(b + h) (kg/cm<sup>2</sup>)</center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['ratio1']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['ratio2']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['ratio3']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['ratio4']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['ratio5']; ?></center>
							</td>

						</tr>



						<tr>
							<td colspan="6">
								<center>Average Compressive Strength (kg/cm<sup>2</sup>)</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_com1']; ?></center>
							</td>

						</tr>

						<br>
						<br>
					</table>
					<br>
					<table align="center" width="90%" class="test" height="5%" border="1">
						<tr>
							<td><b>Tested By :</b></td>
							<td align=""><b>Checked By:</b></td>
						</tr>
					</table>


					<?php /*} */ ?>







				</page>
				<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

			</body>

			</html>

			<script src="jquery-1.12.3.min.js"></script>
			<script type="text/javascript">
				$("#print_button").on("click", function() {
					$('#print_button').hide();
					window.print();
				});
			</script>