			<?php
			session_start();
			include("../connection.php");
			error_reporting(1); ?>
			<style>
				@page {}

				.pagebreak {
					page-break-before: always;
				}
			</style>
			<style>
				.tdclass {
					border: 1px solid black;
					font-size: 11px;
					font-family : Calibri;
				}

				.test {
					border-collapse: collapse;
					font-size: 11px;
					font-family : Calibri;
				}

				.tdclass1 {

					font-size: 11px;
					font-family : Calibri;
				}
			</style>
			<html>

			<body>
				<?php
				$job_no = $_GET['job_no'];
				$lab_no = $_GET['lab_no'];
				$report_no = $_GET['report_no'];
				$select_tiles_query = "select * from mo_sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

					$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
					$result_select3 = mysqli_query($conn, $select_query3);

					if (mysqli_num_rows($result_select3) > 0) {
						$row_select3 = mysqli_fetch_assoc($result_select3);
						$mt_name= $row_select3['mt_name'];
						include_once 'sample_id.php';
					}
				}

				$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$source = $row_select4['agg_source'];
				}

				?>

				<br>
				<br>
				<br>
				<br>
				<br>


				<page size="A4">
					<?php
					if ($row_select_pipe['chk_grd'] == 1) {
					?>
						<table align="center" width="90%" class="test" border="1px" height="30%">
							<tr>
								<td colspan="12" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Services Limited</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="6"><b>Work sheet for Gradation,Fineness Modulus & Silt Content [For Fine Aggregate] </b></td>
								<td colspan="6"><b>(IS :2386 - Part I)-1963 </b></td>
							</tr>
							<tr>
								<td colspan="6"><b>Report No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['report_no']; ?></td>
								<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
							</tr>
							<tr>
								<td colspan="6"><b>Lab No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="6"><b>Job No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['job_no']; ?></td>
							</tr>
							<tr>
								<td colspan="6"><b>Name of Quarry & Location:</b> &nbsp;&nbsp; <?php echo $source; ?></td>
								<td colspan="6"><b>Weight of sample (gm) :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['sample_taken']; ?></td>
							</tr>
							<tr>
								<td colspan="6"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
								<td colspan="6"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date . ' + 1 days')); ?></td>
							</tr>
							<tr>
								<td colspan="4">
									<center><b>IS Sieve(mm)</b></center>
								</td>
								<td colspan="2">
									<center><b>Mass Retain on sieve (gm)</b></center>
								</td>
								<td colspan="2">
									<center><b>Mass Cumulative retain on sieve (gm)</b></center>
								</td>
								<td colspan="2">
									<center><b>% Cumulative retain</b></center>
								</td>
								<td colspan="2">
									<center><b>% Cumulative pass</b></center>
								</td>

							</tr>
							<tr>
								<td colspan="4">
									<center><?php echo $row_select_pipe['sieve_1']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_wt_gm_1']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['ret_wt_gm_1']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_ret_1']; ?>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['pass_sample_1']; ?>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<center><?php echo $row_select_pipe['sieve_2']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_wt_gm_2']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['ret_wt_gm_2']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_ret_2']; ?>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['pass_sample_2']; ?>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<center><?php echo $row_select_pipe['sieve_3']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_wt_gm_3']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['ret_wt_gm_3']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_ret_3']; ?>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['pass_sample_3']; ?>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<center><?php echo $row_select_pipe['sieve_4']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_wt_gm_4']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['ret_wt_gm_4']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_ret_4']; ?>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['pass_sample_4']; ?>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<center><?php echo $row_select_pipe['sieve_5']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_wt_gm_5']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['ret_wt_gm_5']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_ret_5']; ?>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['pass_sample_5']; ?>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<center><?php echo $row_select_pipe['sieve_6']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_wt_gm_6']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['ret_wt_gm_6']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_ret_6']; ?>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['pass_sample_6']; ?>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<center><?php echo $row_select_pipe['sieve_7']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_wt_gm_7']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['ret_wt_gm_7']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_ret_7']; ?>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['pass_sample_7']; ?>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<center><?php echo $row_select_pipe['sieve_8']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_wt_gm_8']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['ret_wt_gm_8']; ?></center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['cum_ret_8']; ?>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['pass_sample_8']; ?>
								</td>
							</tr>

							<tr>
								<td colspan="4">
									<center>Total</center>
								</td>
								<td colspan="2">
									<center><?php echo $row_select_pipe['sample_taken']; ?></center>
								</td>
								<td colspan="2">
									<center></center>
								</td>
								<td colspan="2">
									<center></center>
								</td>
								<td colspan="2">
									<center></center>
								</td>
							</tr>
							<tr>
								<td colspan="8">Fineness Modulus (%) = Total % Cumulative Retain upto 0.150 mm/100 = </td>
								<td colspan="4">
									<center><?php echo $row_select_pipe['grd_fm']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="6">Weight of Wet sand sample (B) gm : <?php echo $row_select_pipe['silt_1']; ?> </td>
								<td colspan="6">Weight of oven dry sample (C) gm : <?php echo $row_select_pipe['silt_2']; ?> </td>


							</tr>
							<tr>
								<td colspan="8">Silt Content (%) = (B-C) X 100 /C </td>
								<td colspan="4">
									<center><?php echo $row_select_pipe['silt_content']; ?></center>
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
					if ($row_select_pipe['chk_sp'] == 1) {
					?>
						<br>
						<br>
						<!--Specific Gravity Water Abrasion-->

						<table align="center" width="90%" class="test" border="1px" height="30%">
							<tr>
								<td colspan="12" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Services Limited</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="6"><b>Work sheet for Gradation,Fineness Modulus & Silt Content [For Fine Aggregate] </b></td>
								<td colspan="6"><b>(IS :2386 - Part I)-1963 </b></td>
							</tr>
							<tr>
								<td colspan="6"><b>Report No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['report_no']; ?></td>
								<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
							</tr>
							<tr>
								<td colspan="6"><b>Lab No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="6"><b>Job No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['job_no']; ?></td>
							</tr>
							<tr>
								<td colspan="6"><b>Name of Quarry & Location:</b> &nbsp;&nbsp; <?php echo $source; ?></td>
								<td colspan="6"><b>Weight of sample (gm) :</b> &nbsp;&nbsp;500 gms</td>
							</tr>
							<tr>
								<td colspan="6"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
								<td colspan="6"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date . ' + 1 days')); ?></td>
							</tr>
							<tr>
								<td colspan="12">
									<center><b>Specific Gravity & Water Absorption</b> </center>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<center><b>Observation</b></center>
								</td>
								<td colspan="3">
									<center><b>I</b></center>
								</td>
								<td colspan="3">
									<center><b>II</b></center>
								</td>
								<td colspan="3">
									<center><b>Average</b></center>
								</td>

							</tr>
							<tr>
								<td colspan="3"><b>Weight of oven dry sample D (gms)</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_w_b_a1_1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_w_b_a1_2']; ?></center>
								</td>
								<td colspan="3">
									<center><b></b></center>
								</td>


							</tr>
							<tr>
								<td colspan="3"><b>Weight of Saturated surface dry sample C (gms)</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_w_b_a2_1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_w_b_a2_2']; ?></center>
								</td>
								<td colspan="3">
									<center><b></b></center>
								</td>


							</tr>
							<tr>
								<td colspan="3"><b>Weight of Pycnometer filled with water at same temperature as water used in test B (gms)</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_wt_st_1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_wt_st_2']; ?></center>
								</td>
								<td colspan="3">
									<center><b></b></center>
								</td>


							</tr>
							<tr>
								<td colspan="3"><b>Weight of Pycnometer with water and sand sample A (gms)</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_w_sur_1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_w_sur_2']; ?></center>
								</td>
								<td colspan="3">
									<center><b></b></center>
								</td>


							</tr>
							<tr>
								<td colspan="3"><b>Specific Gravity = D / C - (A - B)</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_w_s_1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_w_s_2']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['avg_sp_w_s']; ?></center>
								</td>



							</tr>
							<tr>
								<td colspan="3"><b>Apparent Specific Gravity = D / D - (A - B)</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_specific_gravity_1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_specific_gravity_2']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_specific_gravity']; ?></center>
								</td>

							</tr>
							<tr>
								<td colspan="3"><b>Water Absorption (%) = 100(C- D) / D</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_water_abr_1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_water_abr_2']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['sp_water_abr']; ?></center>
								</td>

							</tr>

						</table>
						<br>
						<table align="center" width="90%" class="test" height="5%" border="1">
							<tr>
								<td><b>Tested By :</b></td>
								<td align=""><b>Checked By:</b></td>
							</tr>
						</table>
						<div class="pagebreak"></div>
					<?php }

					if ($row_select_pipe['chk_den'] == "1") {
					?>
						<br>
						<br>
						<table align="center" width="90%" class="test" border="1px" height="40%">
							<tr>
								<td colspan="12" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Services Limited</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="6"><b>Work sheet for Bulk Density </b></td>
								<td colspan="6"><b>(IS :2386 - Part I)-1963 </b></td>
							</tr>
							<tr>
								<td colspan="6"><b>Report No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['report_no']; ?></td>
								<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
							</tr>
							<tr>
								<td colspan="6"><b>Lab No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="6"><b>Job No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['job_no']; ?></td>
							</tr>
							<tr>
								<td colspan="6"><b>Name of Quarry & Location:</b> &nbsp;&nbsp; <?php echo $source; ?></td>
								<td colspan="6"><b>Weight of sample (gm) :</b> &nbsp;&nbsp;500 gms</td>
							</tr>
							<tr>
								<td colspan="6"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
								<td colspan="6"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date . ' + 1 days')); ?></td>
							</tr>

							<tr>
								<td colspan="3">
									<center><b>Observation</b></center>
								</td>
								<td colspan="3">
									<center><b>I</b></center>
								</td>
								<td colspan="3">
									<center><b>II</b></center>
								</td>
								<td colspan="3">
									<center><b>Average</b></center>
								</td>

							</tr>
							<tr>
								<td colspan="3"><b>Weight of empty mould (kg), W1</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['wt1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['wt2']; ?></center>
								</td>
								<td colspan="3">
									<center><b></b></center>
								</td>


							</tr>
							<tr>
								<td colspan="3"><b>Weight of mould + Sample (loose) (kg), W2</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['wm1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['wm2']; ?></center>
								</td>
								<td colspan="3">
									<center><b></b></center>
								</td>


							</tr>
							<tr>
								<td colspan="3"><b>weight of mould + Sample (Compacted) (kg), W3</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['ws1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['ws2']; ?></center>
								</td>
								<td colspan="3">
									<center><b></b></center>
								</td>


							</tr>
							<tr>
								<td colspan="3"><b>Volume of cylinder in (litre), V</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['v1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['v2']; ?></center>
								</td>
								<td colspan="3">
									<center><b></b></center>
								</td>


							</tr>
							<tr>
								<td colspan="3"><b>Bulk Density, Loose (kg/l) = W2 - W1/V</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['bdl1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['bdl2']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['bdl']; ?></center>
								</td>



							</tr>
							<tr>
								<td colspan="3"><b>Bulk Density, Compacted (kg/l) = W3 - W1 / V</b></td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['bdc1']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['bdc2']; ?></center>
								</td>
								<td colspan="3">
									<center><?php echo $row_select_pipe['bdc']; ?></center>
								</td>

							</tr>
						</table>
						<br>
						<table align="center" width="90%" class="test" height="5%" border="1px">
							<tr>
								<td><b>Tested By :</b></td>
								<td align=""><b>Checked By:</b></td>
							</tr>
						</table>

					<?php

					}
					?>

				</page>
				<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: gSTCn;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

			</body>

			</html>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script type="text/javascript">
				$("#print_button").on("click", function() {
					$('#print_button').hide();
					window.print();
				});
			</script>