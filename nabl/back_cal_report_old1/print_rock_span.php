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
				$select_tiles_query = "select * from span_rock WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
				$result_tiles_select = mysqli_query($conn, $select_tiles_query);
				$row_select_pipe = mysqli_fetch_array($result_tiles_select);

				$select_query = "select * from job WHERE `report_no`='$report_no' AND `jobisdeleted`='0'";
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

					$ro_bhno = $row_select4['ro_bhno'];
				}

				?>

				<br>
				<br>
				<br>
				<br>
				<br>


				<page size="A4" layout="landscape">
					<?php
					if ($row_select_pipe['chk_wtr'] == 1) {
					?>
						<table align="center" width="90%" class="test" border="1px" height="30%">
							<tr>
								<td colspan="12" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Service Limited</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="12"><b>Determination of water Content of Rock (As per IS :13030 - 1991,[RA - 2010])</b></td>
							</tr>
							<tr>
								<td colspan="6"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
							</tr>
							<tr>
								<td colspan="6"><b>Bh No :</b> &nbsp;&nbsp; <?php echo $ro_bhno; ?></td>
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
									<center>Mass in gm of the container with its lid at room temperature, (m<sub>1</sub>)</center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['m1_1']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['m1_2']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['m1_3']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="6">
									<center>Mass in gm of the container with its lid and the sample at room temperature, (m<sub>2</sub>)</center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['m2_1']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['m2_2']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['m2_3']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="6">
									<center>Mass in gm of the container with its lid and the sample after drying(m<sub>3</sub>) </center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['m3_1']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['m3_2']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['m3_3']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="6">
									<center>Water Content <br> W = pore water mass Mw / Grain mass Ms <br> = ((m<sub>2</sub> - m<sub>3</sub>)/(m<sub>3</sub>-m<sub>1</sub>)) X 100 (%)</center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['wtr_1']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['wtr_2']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['wtr_3']; ?></center>
								</td>

							</tr>

							<tr>
								<td colspan="6">
									<center>Average Water Content (%)</center>
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

					<?php }



					if ($row_select_pipe['chk_com'] == 1) {
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
								<td colspan="12"><b>Determination of Unconfined Compression Strength of Rock (As per IS :9143 - 1979,[RA - 2016])</b></td>
							</tr>
							<tr>
								<td colspan="6"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
							</tr>
							<tr>
								<td colspan="6"><b>BH No. :</b> &nbsp;&nbsp; <?php echo $ro_bhno; ?></td>
								<td colspan="6"><b>RECEIVED SAMPLE :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td colspan="6"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
								<td colspan="6"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date . ' + 1 days')); ?></td>
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
									<center>Sample Description</center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['a1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['a2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['a3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['a4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['a5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>Condition of sample during receipt</center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['b1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['b2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['b3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['b4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['b5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>Depth of sample</center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['c1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['c2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['c3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['c4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['c5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>Height of sample in mm</center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['d1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['d2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['d3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['d4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['d5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>Diameter of sample in mm</center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['e1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['e2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['e3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['e4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['e5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>Correction Factor (IS: 516-1959)</center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['f1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['f2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['f3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['f4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['f5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>Area of specimen in mm<sup>2</sup></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['g1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['g2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['g3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['g4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['g5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>Rate of loading MPa</center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['h1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['h2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['h3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['h4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['h5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>Mode of failure</center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['i1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['i2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['i3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['i4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['i5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>Load at failure in KN</center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['j1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['j2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['j3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['j4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['j5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>UCS in N/mm<sup>2</sup></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['k1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['k2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['k3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['k4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['k5']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="7">
									<center>Corrected UCS N/mm<sup>2</sup></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['l1']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['l2']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['l3']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['l4']; ?></center>
								</td>
								<td colspan="1">
									<center><?php echo $row_select_pipe['l5']; ?></center>
								</td>

							</tr>




							<tr>
								<td colspan="6">
									<center>Average UCS (N/mm<sup>2</sup>)</center>
								</td>
								<td colspan="6">
									<center><?php echo $row_select_pipe['avg_com']; ?></center>
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


					<?php } ?>







				</page>
				<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

			</body>

			</html>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script type="text/javascript">
				$("#print_button").on("click", function() {
					$('#print_button').hide();
					window.print();
				});
			</script>