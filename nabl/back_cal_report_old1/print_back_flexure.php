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
				$select_tiles_query = "select * from flexure_beam WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
				$result_tiles_select = mysqli_query($conn, $select_tiles_query);
				$count = mysqli_num_rows($result_tiles_select);
				$flag = 0;
				if ($count > 0) {
					while ($row_select_pipe = mysqli_fetch_array($result_tiles_select)) {

						$result_tiles_select = mysqli_query($conn, $select_tiles_query);
						$row_select_pipe = mysqli_fetch_array($result_tiles_select);

						$select_query = "select * from job WHERE `report_no`='$report_no' AND `jobisdeleted`='0'";
						$result_select = mysqli_query($conn, $select_query);
						$flag++;
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

						//for forwared to
						$sent_by = $row_select['report_sent_to'];

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

							$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
							$result_select3 = mysqli_query($conn, $select_query3);

							if (mysqli_num_rows($result_select3) > 0) {
								$row_select3 = mysqli_fetch_assoc($result_select3);
								$mt_name = $row_select3['mt_name'];
							}
						}

						$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
						$result_select4 = mysqli_query($conn, $select_query4);

						if (mysqli_num_rows($result_select4) > 0) {
							$row_select4 = mysqli_fetch_assoc($result_select4);
							$cc_grade = $row_select4['cc_grade'];
							$cc_set_of_cube = $row_select4['cc_set_of_cube'];
							$cc_no_of_cube = $row_select4['cc_no_of_cube'];
							$day_remark = $row_select4['day_remark'];
							$casting_date = $row_select4['casting_date'];
						}


				?>

						<br>
						<br>
						<br>
						<br>
						<br>


						<page size="A4" layout="landscape">
							<table align="center" width="90%" class="test" border="1px">
								<tr>
									<td colspan="12" style="font-size:13px">
										<center><b>Span Infrastructure Material Testing &amp; Consultancy Services-Mehsana</b></center>
									</td>
								</tr>
								<tr>
									<td colspan="8"><b>Worksheet for Flexural strength of Moulded flexural test specimen : IS: 516-1959 (Reff-2008) (RA:2018)</b></td>
									<td colspan="4">F/Material/16, Issue No.01, Page No. 1of 1</td>
								</tr>
								<tr>
									<td colspan="6" width="45%"><b>Lab. Ref. ID:</b>&nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
									<td colspan="6" width="45%"><b>Curing conditions :</b></td>
								</tr>
								<tr>
									<td colspan="6" width="45%"><b>Sample Received date:</b></td>
									<td colspan="6" width="45%"><b>Sample testing date:</b></td>
								</tr>




								<tr>
									<td rowspan="2" style="height:50px;">
										<center><b>Sample ID</b></center>
									</td>
									<td rowspan="2">
										<center><b>Date<br>Of<br>Casting</b></center>
									</td>
									<td rowspan="2">
										<center><b>Date<br>Of<br>Testing</b></center>
									</td>
									<td rowspan="2">
										<center><b>Age of<br>specimen<br>(Days)</b></center>
									</td>
									<td colspan="3">
										<center><b>Size of specimen(cm)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Span<br>Length (l)<br>(cm)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Max load.<br>(p)<br>(kN)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Max load.<br>(p)<br>(kg)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Position of<br>Fracture<br>(a)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Flexure<br>Strength<br>(f<sub> b </sub>)((kg/cm <sup>2</sup> )</b></center>
									</td>


								</tr>
								<tr>
									<td>
										<center><b>L</b></center>
									</td>
									<td>
										<center><b>B</b></center>
									</td>
									<td>
										<center><b>H</b></center>
									</td>
								</tr>
								<?php
								if ($row_select_pipe['chk_chk1'] == 1) {
								?>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_1']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day1']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l1'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b1'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h1'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_1']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_1'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_1'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_1']; ?></center>
										</td>
										<td rowspan="3">
											<center><?php echo $row_select_pipe['avg_com_s_1']; ?></center>
										</td>
									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_2']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date2'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date2'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day2']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l2'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b2'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h2'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_2']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_2'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_2'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_2']; ?></center>
										</td>

									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_3']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date3'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date3'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day3']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l3'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b3'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h3'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_3']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_3'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_3'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_3']; ?></center>
										</td>

									</tr>
								<?php
								}

								if ($row_select_pipe['chk_chk2'] == 1) {
								?>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_4']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date4'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date4'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day4']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l4'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b4'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h4'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_4']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_4'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_4'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_4']; ?></center>
										</td>
										<td rowspan="3">
											<center><?php echo $row_select_pipe['avg_com_s_2']; ?></center>
										</td>
									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_5']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date5'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date5'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day5']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l5'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b5'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h5'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_5']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_5'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_5'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_5']; ?></center>
										</td>

									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_6']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date6'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date6'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day6']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l6'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b6'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h6'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_6']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_6'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_6'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_6']; ?></center>
										</td>

									</tr>
								<?php
								}

								if ($row_select_pipe['chk_chk3'] == 1) {
								?>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_7']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date7'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date7'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day7']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l7'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b7'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h7'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_7']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_7'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_7'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_7']; ?></center>
										</td>
										<td rowspan="3">
											<center><?php echo $row_select_pipe['avg_com_s_3']; ?></center>
										</td>
									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_8']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date8'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date8'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day8']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l8'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b8'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h8'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_8']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_8'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_8'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_8']; ?></center>
										</td>

									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_9']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date9'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date9'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day9']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l9'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b9'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h9'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_9']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_9'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_9'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_9']; ?></center>
										</td>

									</tr>
								<?php
								}

								if ($row_select_pipe['chk_chk4'] == 1) {
								?>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_10']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date10'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date10'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day10']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l10'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b10'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h10'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_10']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_10'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_10'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_10']; ?></center>
										</td>
										<td rowspan="3">
											<center><?php echo $row_select_pipe['avg_com_s_4']; ?></center>
										</td>
									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_11']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date11'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date11'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day11']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l11'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b11'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h11'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_11']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['mass_11'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_11'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_11']; ?></center>
										</td>

									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_12']; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date12'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date12'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day12']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['l12'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['b12'], 1); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['h12'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cross_12']; ?></center>
										</td>

										<td>
											<center><?php echo round($row_select_pipe['mass_12'], 0); ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['load_12'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_12']; ?></center>
										</td>
									</tr>
								<?php
								}
								?>
								<tr>
									<td colspan="12"><b>f<sub>b</sub> = (p x l)/(b*d <sup>2</sup>)</b>when ‘a’ is greater than 20.0 cm for 15.0 cm specimen, or greater than 13.3 cm for a 10.0 cm specimen</td>
								</tr>
								<tr>
									<td colspan="12"><b>f<sub>b</sub> = (3p x a)/(b*d <sup>2<sup> )</b>when ‘a’ is less than 20.0 cm but greater than 17.0 cm for 15.0 cm specimen, or less than 13.3 cm but greater than 11.0 cm for a

										10.0cm specimen</td>
								</tr>
							</table>
							<br>
							<br>
							<table align="center" width="90%" class="test" border="1px">
								<tr>
									<td colspan="6" style="height:30px;"><b>Tested By:</b></td>
									<td colspan="6" style="height:30px;"><b>Checked By:</b></td>
								</tr>
							</table>

						</page>

						<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">


						<?php
						if ($flag < $count) {
						?>
							<div class="pagebreak"> </div>
						<?php } ?>
				<?php
					}
				}
				?>

			</body>

			</html>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script type="text/javascript">
				$("#print_button").on("click", function() {
					$('#print_button').hide();
					window.print();
				});
			</script>