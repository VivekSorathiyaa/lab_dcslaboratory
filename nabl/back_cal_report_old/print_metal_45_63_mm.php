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
				$select_tiles_query = "select * from m_45_63_mm WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
					$source = $row_select4['agg_source'];
				}

				?>

				<br>
				<br>
				<br>
				<br>
				<br>


				<page size="A4" layout="landscape">
					<?php
					if ($row_select_pipe['chk_grd'] == 1) {
					?>
						<table align="center" width="90%" class="test" border="1px" height="30%">
							<tr>
								<td colspan="12" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="6"><b>Work sheet for Gradation of Coarse Aggregate (<?php echo $detail_sample; ?>) (IS :2386 - Part I)</b></td>
								<td colspan="6"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
							</tr>
							<tr>
								<td colspan="6"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
							</tr>
							<tr>
								<td colspan="6"><b>Name of Quarry :</b> &nbsp;&nbsp; <?php echo $source; ?></td>
								<td colspan="6"><b>Location :</b> &nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td colspan="6"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
								<td colspan="6"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date . ' + 1 days')); ?></td>
							</tr>
							<tr>
								<td colspan="4">
									<center><b>IS Sleve(mm)</b></center>
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
								<td colspan="8" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="4"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="4"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
							</tr>
							<tr>
								<td colspan="4"><b>Name of Quarry & Location :</b> &nbsp;&nbsp; <?php echo $source; ?></td>
								<td colspan="4"><b>Temp. Of Water :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['sp_temp']; ?></td>
							</tr>
							<tr>
								<td colspan="4"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
								<td colspan="4"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date . ' + 2 days')); ?></td>
							</tr>
							<tr>
								<td colspan="8">
									<center><b>Specific Gravity & Water Absorption</b> </center>
								</td>
							</tr>
							<tr>
								<td>
									<center><b>Sr. No</b></center>
								</td>
								<td>
									<center><b>Weight of empty basket (gm) (A2)</b></center>
								</td>
								<td>
									<center><b>Weight of sample in water with basket (gm) (A1)</b></center>
								</td>
								<td>
									<center><b>Weight of Saturated surface dry (gm) (B)</b></center>
								</td>
								<td>
									<center><b>Weight of sample oven Dry (gm) (C)</b></center>
								</td>
								<td>
									<center><b>Weight of sample in water (gm) A = A1 - A2</b></center>
								</td>
								<td>
									<center><b>Specific Gravity = C/(B - A)</b></center>
								</td>
								<td>
									<center><b>Percentage of Water Absorption in 24 hours = 100 x (B - C)/C</b></center>
								</td>

							</tr>
							<tr>
								<td>
									<center>1</center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_w_b_a2_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_w_b_a1_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_w_sur_1']; ?>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_w_s_1']; ?>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_wt_st_1']; ?>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_specific_gravity_1']; ?>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_water_abr_1']; ?>
								</td>
							</tr>
							<tr>
								<td>
									<center>2</center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_w_b_a2_2']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_w_b_a1_2']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_w_sur_2']; ?>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_w_s_2']; ?>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_wt_st_2']; ?>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_specific_gravity_2']; ?>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_water_abr_2']; ?>
								</td>
							</tr>
							<tr>
								<td colspan="6">
									<center>Average</center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['sp_specific_gravity']; ?></center>
								</td>
								<td>
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
					<?php } ?>

					<!--Flakiness-->
					<br>
					<br>
					<br>
					<br>
					<br>
					<!--Flakiness-->
					<?php
					if ($row_select_pipe['chk_flk'] == "1") {
					?>
						<br>
						<br>
						<br>
						<br>
						<br>
						<table align="center" width="90%" class="test" border="1px" height="80%">
							<tr>
								<td colspan="9" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="5"><b>Work sheet for Flakiness of Coarse Aggregate (<?php echo $detail_sample; ?>) (IS :2386 - Part I)</b></td>
								<td colspan="4"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
							</tr>
							<tr>
								<td colspan="5"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="4"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
							</tr>
							<tr>
								<td colspan="5"><b>Name of Quarry & Location :</b> &nbsp;&nbsp; <?php echo $source; ?></td>
								<td colspan="4"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							</tr>
							<tr>
								<td rowspan="3"><b>
										<center>Size Of Aggregate</center>
									</b></td>
								<td rowspan="3"><b>
										<center>Weight (B1) (gm)</center>
									</b></td>
								<td colspan="4"><b>
										<center>Flakiness Index</center>
									</b></td>
								<td colspan="4"><b>
										<center>Elongation Index</center>
									</b></td>
							</tr>
							<tr>
								<td rowspan="2"><b>
										<center>Passing weight from thickness gauge(A1)(gm)</center>
									</b></td>
								<td rowspan="2"><b>
										<center>% of mass of total number piece (X) = (A1/B1) x 100</center>
									</b></td>
								<td><b>
										<center>Y = </td>
								<td><b>
										<center>weighted % of the mass passing through thickness gauge = </center>
									</b></td>
								<td rowspan="2"><b>
										<center>Retained weight from length gauge(A1)(gm)</center>
									</b></td>
								<td rowspan="2"><b>
										<center>% of mass of total number piece (X) = (A1/B1) x 100</center>
									</b></td>
								<td rowspan="2"><b>
										<center>weighted % of the mass Retained through Length gauge = (X x Y) x 100</center>
									</b></td>
							</tr>
							<tr>
								<td><b>
										<center>(B1/&#931;B1) x 100</center>
									</b></td>
								<td><b>
										<center>(X x Y) x 100</center>
									</b></td>
							</tr>
							<tr>
								<td>
									<center><?php echo $row_select_pipe['s11']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['a1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['b1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['c1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['d1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['e1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['aa1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['bb1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['dd1']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center><?php echo $row_select_pipe['s12']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['a2']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['b2']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['c2']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['d2']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['e2']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['aa2']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['bb2']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['dd2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center><?php echo $row_select_pipe['s13']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['a3']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['b3']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['c3']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['d3']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['e3']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['aa3']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['bb3']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['dd3']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center><?php echo $row_select_pipe['s14']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['a4']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['b4']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['c4']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['d4']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['e4']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['aa4']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['bb4']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['dd4']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center><?php echo $row_select_pipe['s15']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['a5']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['b5']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['c5']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['d5']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['e5']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['aa5']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['bb5']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['dd5']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center><?php echo $row_select_pipe['s16']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['a6']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['b6']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['c6']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['d6']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['e6']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['aa6']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['bb6']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['dd6']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center><?php echo $row_select_pipe['s17']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['a7']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['b7']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['c7']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['d7']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['e7']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['aa7']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['bb7']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['dd7']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center><?php echo $row_select_pipe['s18']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['a8']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['b8']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['c8']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['d8']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['e8']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['aa8']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['bb8']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['dd8']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center><?php echo $row_select_pipe['s19']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['a9']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['b9']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['c9']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['d9']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['e9']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['aa9']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['bb9']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['dd9']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center><b>Total</b></center>
								</td>
								<td>
									<center><b><?php echo $row_select_pipe['suma']; ?></b></center>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td align="right" colspan="4"><b>Flakiness Index (%)=</b></td>
								<td align="center" colspan="2"><b><?php echo $row_select_pipe['fi_index']; ?></b></td>
								<td colspan="2" align="center"><b>Elongation Index (%)=</b></td>
								<td align="center"><b><?php echo $row_select_pipe['ei_index']; ?></b></td>
							</tr>
							<tr>
								<td colspan="9">
									<center>Combined Flakiness and Elongation Index (%)=&nbsp;&nbsp;&nbsp;<b><?php echo $row_select_pipe['combined_index']; ?></b></center>
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
					<?php } ?>


					<div class="pagebreak"></div>
					<br>
					<br>

					<?php
					if ($row_select_pipe['chk_impact'] == 1 || $row_select_pipe['chk_crushing'] == 1 || $row_select_pipe['chk_abr'] == 1) {
					?>
						<br>
						<br>
						<table align="center" width="90%" class="test" border="1px" height="80%">
							<tr>
								<td colspan="4" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="2"><b>Work sheet for Crushing Value, Impact test and Abrasion by Los Angeles for Coarse Aggregate (<?php echo $detail_sample; ?>) (IS :2386 - Part IV)</b></td>
								<td colspan="2"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
							</tr>
							<tr>
								<td colspan="2"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="2"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
							</tr>
							<tr>
								<td colspan="2"><b>Name of Quarry:</b> &nbsp;&nbsp; <?php echo $source; ?></td>
								<td colspan="2"><b>Location:</b> &nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
								<td colspan="2"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							</tr>
							<tr>
								<td colspan="4">
									<center><b>Crushing Value</b></center>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td>
									<center>(i)</center>
								</td>
								<td>
									<center>(ii)</center>
								</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Total weight taken (12.5mm - 10.0mm) into crushing mould in gm (A)</td>
								<td>
									<center><?php echo $row_select_pipe['cr_a_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['cr_a_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Weight of material passing through IS sieve 2.36mm after crushing load (40 T) applied in g (B)</td>
								<td>
									<center><?php echo $row_select_pipe['cr_b_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['cr_b_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Crushing Value (%)=B/A x 100</td>
								<td>
									<center><?php echo $row_select_pipe['cru_value_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['cru_value_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Average Crushing Value(%)=(L + ii)/2</td>
								<td colspan="2">
									<center><b><?php echo $row_select_pipe['cru_value']; ?></b>
										<center>
								</td>
							</tr>
							<!--Impact Value-->
							<tr>
								<td align="center" colspan="4"><b>Impact Value</b></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td>
									<center>(i)</center>
								</td>
								<td>
									<center>(ii)</center>
								</td>
							</tr>
							<tr>
								<td>
									<center>1</center>
								</td>
								<td>Total weight taken (12.5mm - 10.0mm) into crushing mould in gm (A)</td>
								<td>
									<center><?php echo $row_select_pipe['imp_w_m_a_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['imp_w_m_a_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center>2</center>
								</td>
								<td>Weight of material Retain through IS sieve 2.36mm after 15 Blows applied in gm (B)</td>
								<td>
									<center><?php echo $row_select_pipe['imp_w_m_b_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['imp_w_m_b_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center>3</center>
								</td>
								<td>Weight of material passing through IS sieve 2.36mm in gm (C)</td>
								<td>
									<center><?php echo $row_select_pipe['imp_w_m_c_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['imp_w_m_c_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center>4</center>
								</td>
								<td>D = A - (C + B)</td>
								<td>
									<center><?php echo $row_select_pipe['imp_w_m_d_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['imp_w_m_d_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center>5</center>
								</td>
								<td>Impact Value (%)=C/A x 100</td>
								<td>
									<center><?php echo $row_select_pipe['imp_value_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['imp_value_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center>6</center>
								</td>
								<td>Average Impact Value(%)=(i + ii)/2</td>
								<td colspan="2">
									<center><b><?php echo $row_select_pipe['imp_value']; ?></b></center>
								</td>
							</tr>
							<!--Impact Value-->
							<tr>
								<td align="center" colspan="4"><b>Abrasion by Los Angeles Machine</b></td>
							</tr>
							<tr>
								<td colspan="2">Grading:&nbsp;&nbsp;<?php echo $row_select_pipe['abr_grading']; ?></td>
								<td colspan="2">Weight of charge (gm):&nbsp;&nbsp;<?php echo $row_select_pipe['abr_weight_charge']; ?></td>
							</tr>
							<tr>
								<td colspan="2">Number of spheres used:&nbsp;&nbsp;<?php echo $row_select_pipe['abr_sphere']; ?></td>
								<td colspan="2">Number of revolution:&nbsp;&nbsp;<?php echo $row_select_pipe['abr_num_revo']; ?></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td>
									<center>(i)</center>
								</td>
								<td>
									<center>(ii)</center>
								</td>
							</tr>
							<tr>
								<td>
									<center>1</center>
								</td>
								<td>Weight of specimen (Oven dry) = W1 gram</td>
								<td>
									<center><?php echo $row_select_pipe['abr_wt_t_a_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['abr_wt_t_a_2']; ?>
								</td>
							</tr>
							<tr>
								<td>
									<center>2</center>
								</td>
								<td>Weight of specimen after abrasion test coarser than 1.7 mm IS sieve = W2 gram</td>
								<td>
									<center><?php echo $row_select_pipe['abr_wt_t_b_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['abr_wt_t_b_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center>3</center>
								</td>
								<td>% of Wear = (W1 - W2)/W1 x 100</td>
								<td>
									<center><?php echo $row_select_pipe['abr_wt_t_c_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['abr_wt_t_c_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center>4</center>
								</td>
								<td>Average Abrasion Value (%)= (i + ii)/2</td>
								<td colspan="2">
									<center><b><?php echo $row_select_pipe['abr_index']; ?></b></center>
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
						<br>
						<br>
						<br>
					<?php }
					if ($row_select_pipe['chk_sou'] == "1") {
					?>
						<table align="center" width="90%" class="test" border="1px" height="40%">
							<tr>
								<td colspan="10" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Service Limited</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="5"><b>Work sheet for Coarse Aggregate Soundness Test By The Use Of <?php if ($row_select_pipe['s1'] == "NA2SO4") { ?>Na<sub>2</sub>SO<sub>4</sub><?php
																																														} else {
																																															?>
										MgSO<sub>4</sub>
									<?php
																																														}
									?><br> (REF:IS-2386 Part - 5)(Reaffirmed 2011)</b></td>
								<td colspan="5"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
							</tr>
							<tr>
								<td colspan="5"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="5"><b>Condition of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
							</tr>
							<tr>
								<td colspan="5"><b>Name of Quarry & Location :</b> &nbsp;&nbsp;</td>
								<td colspan="5"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<th class="tdclass" style="text-align:center;" Colspan="2">Sieve Size (MM)</th>
								<th class="tdclass" style="text-align:center;" rowspan="2">Weight of test fraction before test (gms)</th>
								<th class="tdclass" style="text-align:center;" rowspan="2">Weight of test fraction after test (gms)</th>
								<th class="tdclass" style="text-align:center;" rowspan="2">Percentage passing finer sieve after test (actual percent loss)</th>
								<th class="tdclass" style="text-align:center;" rowspan="2">Corrected Percent Loss Factor</th>
								<th class="tdclass" style="text-align:center;" rowspan="2">Weight average (corrected percent loss)</th>
							</tr>
							<tr>
								<th class="tdclass" style="text-align:center;">Passing</th>
								<th class="tdclass" style="text-align:center;">Retained on</th>


							</tr>
							<tr>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['s2']; ?></th>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['sou_size1']; ?></th>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['w1']; ?></th>
								<th class="tdclass" style="text-align:center;"></th>
								<th class="tdclass" style="text-align:center;"></th>
								<th class="tdclass" style="text-align:center;"></th>
								<th class="tdclass" style="text-align:center;"></th>

							</tr>
							<tr>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['sound_sample']; ?></th>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['sou_size2']; ?></th>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['w2']; ?></th>
								<th class="tdclass" style="text-align:center;"></th>
								<th class="tdclass" style="text-align:center;"></th>
								<th class="tdclass" style="text-align:center;"></th>
								<th class="tdclass" style="text-align:center;"></th>

							</tr>

							<tr>
								<th class="tdclass" style="text-align:center;" colspan="2">Total</th>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['wsum']; ?></th>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['gasum']; ?></th>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['gbsum']; ?></th>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['gcsum']; ?></th>
								<th class="tdclass" style="text-align:center;"><?php echo $row_select_pipe['soundness']; ?></th>

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

					if ($row_select_pipe['chk_fines'] == "1") {
					?>

						<br>
						<br>
						<!--10%fines value---->
						<table align="center" width="90%" class="test" border="1px" height="80%">
							<tr>
								<td colspan="4" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="2"><b>Work sheet for 10% fines for Aggregate (<?php echo $detail_sample; ?>) (IS :2386 - Part IV) (RA:2016)</b></td>
								<td colspan="2"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
							</tr>
							<tr>
								<td colspan="2"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="2"><b>Condition of Sample :</b> &nbsp;&nbsp;Sealed / Unsealed</td>
							</tr>
							<tr>
								<td colspan="2"><b>Name of Quarry:</b> &nbsp;&nbsp;</td>
								<td colspan="2"><b>Location:</b> &nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
								<td colspan="2"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							</tr>

							<tr>
								<td></td>
								<td></td>
								<td>
									<center>(i)</center>
								</td>
								<td>
									<center>(ii)</center>
								</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Total weight taken (12.5mm - 10.0mm) into crushing mould in gm (A)</td>
								<td>
									<center><?php echo $row_select_pipe['f_a_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['f_a_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Load applied for 20mm penetration of plunger for normal crushed aggregates, in Tonnes, (x)</td>
								<td>
									<center><?php echo $row_select_pipe['f_b_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['f_b_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Weight of material passing through IS sieve 2.36mm after 20mm penetration of plunger in gm (B)</td>
								<td>
									<center><?php echo $row_select_pipe['f_c_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['f_c_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>percentage fines, y = [B / A] * 100</td>
								<td>
									<center><?php echo $row_select_pipe['f_d_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['f_d_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td>Load required for 10% fines = (14 * x)/(y + 4) (Tonnes)</td>
								<td>
									<center><?php echo $row_select_pipe['f_e_1']; ?></center>
								</td>
								<td>
									<center><?php echo $row_select_pipe['f_e_2']; ?></center>
								</td>
							</tr>
							<tr>
								<td>
									<center>6</center>
								</td>
								<td>Mean of Load required for 10% fines (Tonnes)</td>
								<td colspan="2">
									<center><b><?php echo $row_select_pipe['fines_value']; ?></b></center>
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
					<?php

					}
					?>

					<div class="pagebreak"></div>
					<br>
					<br>
					<br>
					<br>
					<br>
					<?php
					if ($row_select_pipe['chk_mdd'] == "1") {
					?>

						<table align="center" width="90%" class="test" border="1px">
							<tr style="height:31px;">
								<td colspan="11" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
								</td>
							</tr>

							<tr style="height:31px;">
								<td colspan="8"><b>Work sheet for MDD OMC OF Coarse Aggregate (data) (IS :2720 - Part V)</b></td>
								<td colspan="3"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
							</tr>

							<tr style="height:10px;">
								<td colspan="11">&nbsp;</td>
							</tr>

							<tr style="height:20px;">
								<td colspan="5"><b>Laboratory ID No. :</b> &nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
								<td colspan="6"><b>Date of Testing :</b><?php echo date('d - m - Y', strtotime($rec_sample_date)); ?> </td>
							</tr>

							<tr style="height:20px;">
								<td colspan="5"><b>Type of Compaction : &nbsp;<span style="">&nbsp;<?php echo $row_select_pipe['type_compaction']; ?></span></b></td>
								<td colspan="6"><b>Condition of Sample : Air Dry</b> </td>
							</tr>

							<tr style="height:20px;">
								<td colspan="5"><b>Weight Of empty mould(W1)(gm): &nbsp;<span style="">&nbsp;<?php echo $row_select_pipe['empty_mould']; ?></span></b></td>
								<td colspan="6"><b>Volume Of empty mould(V)(cc): &nbsp;<span style="">&nbsp;<?php echo $row_select_pipe['volume']; ?></span></b> </td>
							</tr>

							<tr style="height:20px;">
								<td colspan="5"><b>Weight Of Sample Taken(gm): &nbsp;<span style="">&nbsp;<?php echo $row_select_pipe['weight_of_sample']; ?></span></b></td>
								<td colspan="6"><b>Soil fraction replace above-19mm by 19mm to 4.75mm (gm): &nbsp;</b> </td>
							</tr>

							<tr style="height:10px;">
								<td colspan="11">&nbsp;</td>
							</tr>

							<tr style="height:50px;weight:50px;text-align:center;">
								<td><b>Weight of Soil (gm)</b></td>
								<td><b>Water added (%)</b></td>
								<td><b>Water added (ml)</b></td>
								<td><b>Weight of mould with soil after compaction (W2)(gm)</b></td>
								<td><b>Weight of Moist Soil(gm)</b></td>
								<td><b>Bulk Density (gm/cc)</b></td>
								<td><b>Container No</b></td>
								<td><b>Weight of wet soil (W3)(gm)</b></td>
								<td><b>Weight of oven dry soil (W4)(gm)</b></td>
								<td><b>Moisture content (m)</b></td>
								<td><b>Dry Density(gm/cc) </b></td>

							</tr>

							<tr style="height:30px;weight:50px;text-align:center; ">
								<td><b><?php echo $row_select_pipe['wos1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wad1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wra1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wmc1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wms1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bd1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['cnm1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['ww31']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wd41']; ?></b></td>
								<td><b><?php echo $row_select_pipe['omc1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['mdd1']; ?></b></td>

							</tr>
							<tr style="height:30px;weight:50px;text-align:center; ">
								<td><b><?php echo $row_select_pipe['wos2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wad2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wra2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wmc2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wms2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bd2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['cnm2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['ww32']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wd42']; ?></b></td>
								<td><b><?php echo $row_select_pipe['omc2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['mdd2']; ?></b></td>

							</tr>
							<tr style="height:30px;weight:50px;text-align:center; ">
								<td><b><?php echo $row_select_pipe['wos3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wad3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wra3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wmc3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wms3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bd3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['cnm3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['ww33']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wd43']; ?></b></td>
								<td><b><?php echo $row_select_pipe['omc3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['mdd3']; ?></b></td>

							</tr>
							<tr style="height:30px;weight:50px;text-align:center; ">
								<td><b><?php echo $row_select_pipe['wos4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wad4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wra4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wmc4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wms4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bd4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['cnm4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['ww34']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wd44']; ?></b></td>
								<td><b><?php echo $row_select_pipe['omc4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['mdd4']; ?></b></td>

							</tr>
							<tr style="height:30px;weight:50px;text-align:center; ">
								<td><b><?php echo $row_select_pipe['wos5']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wad5']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wra5']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wmc5']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wms5']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bd5']; ?></b></td>
								<td><b><?php echo $row_select_pipe['cnm5']; ?></b></td>
								<td><b><?php echo $row_select_pipe['ww35']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wd45']; ?></b></td>
								<td><b><?php echo $row_select_pipe['omc5']; ?></b></td>
								<td><b><?php echo $row_select_pipe['mdd5']; ?></b></td>

							</tr>
							<tr style="height:30px;weight:50px;text-align:center; ">
								<td><b><?php echo $row_select_pipe['wos6']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wad6']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wra6']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wmc6']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wms6']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bd6']; ?></b></td>
								<td><b><?php echo $row_select_pipe['cnm6']; ?></b></td>
								<td><b><?php echo $row_select_pipe['ww36']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wd46']; ?></b></td>
								<td><b><?php echo $row_select_pipe['omc6']; ?></b></td>
								<td><b><?php echo $row_select_pipe['mdd6']; ?></b></td>

							</tr>

							<tr style="height:30px;weight:50px;text-align:center;">
								<td colspan="2"><b>Final Result from graph</b></td>
								<td colspan="3">Maximum Dry Density (gm/cc): &nbsp;<span style="">&nbsp;<?php echo $row_select_pipe['mdd']; ?></span></td>
								<td colspan="6">optimum Moisture Content (%):&nbsp;<span style="">&nbsp;<?php echo $row_select_pipe['omc']; ?></span></td>
							</tr>

						</table>
						<table align="center" width="90%" class="test" height="5%" border="1">
							<tr>
								<td><b>Tested By : </b></td>
								<td align=""><b>Checked By:</b></td>
							</tr>
						</table>
						<br>
						<div class="pagebreak"></div>
						<br>
						<br>
						<br>
					<?php
					}
					if ($row_select_pipe['chk_ll'] == "1") {
					?>
						<table align="center" width="90%" class="test" border="1px">
							<tr style="height:31px;">
								<td colspan="11" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
								</td>
							</tr>

							<tr style="height:31px;">
								<td colspan="9"><b>Work sheet for Liquid Limit (Ref.: IS 2720 Part V)(RA:2015)</b></td>
								<td colspan="2"><b>F/SOIL/02, Issue No. 01, Page No. 1 of 1</b></td>
							</tr>

							<tr style="height:31px;">
								<td colspan="9"><b>Date of testing </b><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
								<td colspan="2"><b>History of sample : Oven Dry</b></td>
							</tr>



							<tr style="height:50px;weight:50px;text-align:center;">
								<td><b>Bh No</b></td>
								<td><b>Depth of sample in(m)</b></td>
								<td><b>Laboratory ID No.</b></td>
								<td><b>Bowl No.</b></td>
								<td><b>Weight of sample (gm)50 gm fix</b></td>
								<td><b>Number of blows(N)18-30</b></td>
								<td><b>Container no Fix no</b></td>
								<td><b>Weight of wet sample (gm)</b></td>
								<td><b>Weight of dry sample (gm) =3000/(ll*(1.3215-0.23*LOG(blow))+100)</b></td>
								<td><b>Moisture content(%)=(wet-dry)*100/dry</b></td>
								<td><b>Liquid limit(%)18.00-100.00</b></td>

							</tr>

							<tr style="height:30px;weight:50px;text-align:center; ">
								<td><b>1</b></td>
								<td><b><?php echo $row_select_pipe['dep_1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['lab_no_1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bo_1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['weight_sample_1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bo_1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['con1']; ?></b></td>
								<td style="background-color:yellow;"><b><?php echo $row_select_pipe['wws1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wds1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['mc1']; ?></b></td>
								<td><b><?php echo $row_select_pipe['liquide_limit']; ?></b></td>

							</tr>

							<tr style="height:20px;weight:50px;">
								<td colspan="11"><b>MC(Moisture content) (%) = (Wet weight – dry weight) x 100/ Dry weight</b></td>
							</tr>

							<tr style="height:20px;weight:50px;">
								<td colspan="11"><b>Liquid Limit (%) = MC/(1.3215 – 0.23 x log (N))</b></td>
							</tr>

						</table>
						<br>
						<br>
						<table align="center" width="90%" class="test" height="5%" border="1">
							<tr>
								<td><b>Tested By : </b></td>
								<td align=""><b>Checked By:</b></td>
							</tr>
						</table>
						<br>
						<br>
						<table align="center" width="90%" class="test" border="1px">
							<tr style="height:31px;">
								<td colspan="10" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
								</td>
							</tr>

							<tr style="height:31px;">
								<td colspan="5"><b>Work sheet for Plastic Limit (Ref.: IS 2720 Part V)(RA:2015)</b></td>
								<td colspan="5"><b>F/SOIL/03, Issue No. 01, Page No. 1 of 1</b></td>
							</tr>

							<tr style="height:31px;">
								<td colspan="5"><b>Date of testing </b><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
								<td colspan="5"><b>History of sample : Oven Dry</b></td>
							</tr>



							<tr style="height:50px;weight:50px;text-align:center;">
								<td><b>Bh No</b></td>
								<td><b>Depth of sample (m)</b></td>
								<td><b>Laboratory ID No.</b></td>
								<td><b>Bowl No.</b></td>
								<td><b>Container no</b></td>
								<td><b>Weightof wetsample(gm)20 fixed</b></td>
								<td><b>Weight of drysample (gm)=2000/(pl_1)+100)</b></td>
								<td><b>Plastic limit (%)</b></td>
								<td><b>Average Plastic limit (%)</b></td>
								<td><b>Plastic index(%)</b></td>
							</tr>

							<tr style="height:30px;weight:50px;text-align:center; ">
								<td><b>2</b></td>
								<td><b><?php echo $row_select_pipe['dep_2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['lab_no_2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bo_2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['con2']; ?></b></td>
								<td style="background-color:yellow;"><b><?php echo $row_select_pipe['wws2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wds2']; ?></b></td>
								<td><b><?php echo $row_select_pipe['pl1']; ?></b></td>
								<td rowspan="3"><b><?php echo $row_select_pipe['plastic_limit']; ?></b></td>
								<td rowspan="3"><b><?php echo $row_select_pipe['pi_value']; ?></b></td>

							</tr>

							<tr style="height:30px;weight:50px;text-align:center; ">
								<td><b>3</b></td>
								<td><b><?php echo $row_select_pipe['dep_3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['lab_no_3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bo_3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['con3']; ?></b></td>
								<td style="background-color:yellow;"><b><?php echo $row_select_pipe['wws3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wds3']; ?></b></td>
								<td><b><?php echo $row_select_pipe['pl2']; ?></b></td>
							</tr>

							<tr style="height:30px;weight:50px;text-align:center; ">
								<td><b>4</b></td>
								<td><b><?php echo $row_select_pipe['dep_4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['lab_no_4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['bo_4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['con4']; ?></b></td>
								<td style="background-color:yellow;"><b><?php echo $row_select_pipe['wws4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['wds4']; ?></b></td>
								<td><b><?php echo $row_select_pipe['pl3']; ?></b></td>
							</tr>

							<tr style="height:20px;weight:50px;">
								<td colspan="11"><b>Plastic Limit (%) = Weight of (wet sample – dry sample) x 100/ Weight of dry sample</b></td>
							</tr>

							<tr style="height:20px;weight:50px;">
								<td colspan="11"><b>Plastic Index (%)= Liquid limit (%) – Plastic limit(%)</b></td>
							</tr>

						</table>
						<br>
						<br>
						<table align="center" width="90%" class="test" height="5%" border="1">
							<tr>
								<td><b>Tested By : </b></td>
								<td align=""><b>Checked By:</b></td>
							</tr>
						</table>
						<div class="pagebreak"></div>
						<br>
						<br>
						<br>

					<?php
					}
					if ($row_select_pipe['chk_den'] == "1") {
					?>
						<table align="center" width="90%" class="test" border="1px" height="40%">
							<tr>
								<td colspan="12" style="font-size:13px">
									<center><b>Span Infrastructure Material Testing & Consultancy Services Limited</b></center>
								</td>
							</tr>
							<tr>
								<td colspan="6"><b>Work sheet for Bulk Density </b></td>
								<td colspan="6"><b>(IS :2386 - Part I)-1963 (RA 2016)</b></td>
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
								<td colspan="6"><b>Testing Start Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
								<td colspan="6"><b>Testing Completion Date :</b> &nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date . ' + 1 days')); ?></td>
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
						<table align="center" width="80%" class="test" height="5%" border="1px">
							<tr>
								<td><b>Tested By :</b></td>
								<td align=""><b>Checked By:</b></td>
							</tr>
						</table>

					<?php

					}
					?>

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