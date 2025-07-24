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
				$select_tiles_query = "select * from kapachi_10_mm WHERE `bill_id`='$_GET[id]'  and `is_deleted`='0'";
				$result_tiles_select = mysqli_query($conn, $select_tiles_query);
				$count = mysqli_num_rows($result_tiles_select);
				$flag = 0;

				if (mysqli_num_rows($result_tiles_select) > 0) {
					while ($row_select_pipe = mysqli_fetch_assoc($result_tiles_select)) {

						$id_mark = $row_select_pipe['id_mark'];
						$detail_sample = $row_select_pipe['detail_sample'];
						$id_brand = $row_select_pipe['id_brand'];
						$con_sample = $row_select_pipe['con_sample'];
						$start_date = $row_select_pipe['start_date'];
						$r_name = $row_select_pipe['ref_name'];
						$end_date = $row_select_pipe['end_date'];
						$r_name = $row_select_pipe['ref_name'];
						$today_date = $row_select_pipe['date'];
						$flag++;
						$job_no = $row_select_pipe['job_no'];
						$select_query = "select * from job_invert WHERE `est_sr_no`='$_GET[id]' AND `bt_isdeleted` = '0'";
						$result_select = mysqli_query($conn, $select_query);
						$ess_no = $_GET['id'];

						if (mysqli_num_rows($result_select) > 0) {
							$row_select = mysqli_fetch_assoc($result_select);
							$auth_name = $row_select['auth_name'];
							$sr_no = $row_select['sr_no'];
							$sample_no = $row_select['job_no'];
							$name_of_work = strip_tags(html_entity_decode($row_select['name_of_work']), "<strong><em>");

							$agency_name = $row_select['agency_name'];
							$ref_date = $row_select['rec_date'];
							$ess_no2 = substr($ess_no, 7);
							//$srno2=substr($serial_no1,8);

							/*$select_query1 = "select * from billmaster WHERE `sr_no`='$_GET[id]' AND `bill_isdeleted` = '0'";
					$result_select1 = mysqli_query($conn, $select_query1);

					if (mysqli_num_rows($result_select1) > 0) {
						$row_select1 = mysqli_fetch_assoc($result_select1);
						//$name_of_work= $row_select1['name_of_work'];
						$name_of_work= strip_tags(html_entity_decode($row_select1['name_of_work']),"<strong><em>");
						$ref_id= $row_select1['ref_id'];*/

							//---------------get ref name--------------------

							$select_ref1 = "select * from fyearmaster WHERE `fy_status`='1'";
							$result_ref1 = mysqli_query($conn, $select_ref1);

							$row_ref1 = mysqli_fetch_assoc($result_ref1);
							$fyname = $row_ref1['fy_name'];

				?>

							<br>
							<br>
							<br>
							<br>
							<br>


							<page size="A4" layout="landscape">
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
										<td colspan="6"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['bill_id']; ?></td>
										<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
									</tr>
									<tr>
										<td colspan="6"><b>Name of Quarry & Location :</b> &nbsp;&nbsp;</td>
										<td colspan="6"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
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
											<center>Container</center>
										</td>
										<td colspan="2">
											<center><?php echo $row_select_pipe['blank_extra']; ?></center>
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
								<!--Specific Gravity Water Abrasion-->
								<table align="center" width="90%" class="test" border="1px" height="30%">
									<tr>
										<td colspan="8" style="font-size:13px">
											<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
										</td>
									</tr>
									<tr>
										<td colspan="4"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['bill_id']; ?></td>
										<td colspan="4"><b>Condition of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
									</tr>
									<tr>
										<td colspan="4"><b>Name of Quarry & Location :</b> &nbsp;&nbsp;</td>
										<td colspan="4"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
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
								<table align="center" width="90%" class="test" height="10%">
									<tr>
										<td><b>Tested By :</b></td>
										<td align=""><b>Checked By:</b></td>
									</tr>
								</table>
								<div class="pagebreak"></div>
								<!--Flakiness-->
								<br>
								<br>
								<br>
								<br>
								<br>
								<table align="center" width="90%" class="test" border="1px" height="40%">
									<tr>
										<td colspan="6" style="font-size:13px">
											<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
										</td>
									</tr>
									<tr>
										<td colspan="3"><b>Work sheet for Flakiness of Coarse Aggregate (<?php echo $detail_sample; ?>) (IS :2386 - Part I)</b></td>
										<td colspan="3"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
									</tr>
									<tr>
										<td colspan="3"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['bill_id']; ?></td>
										<td colspan="3"><b>Condition of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
									</tr>
									<tr>
										<td colspan="3"><b>Name of Quarry & Location :</b> &nbsp;&nbsp;</td>
										<td colspan="3"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
									</tr>
									<tr>
										<td colspan="6" style="font-size:13px">
											<center><b>Flakiness Index</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center><b>Size of Aggregate</b></center>
										</td>
										<td>
											<center><b>Weight (B1) (gm)</b></center>
										</td>
										<td>
											<center><b>Passing Weight from thickness gauge (A1) (gm)</b></center>
										</td>
										<td>
											<center><b>% of mass of total number piece (X)= (A1/B1) x 100</b></center>
										</td>
										<td>
											<center><b>Y = (B1/&Sigma;B1)x 100</b></center>
										</td>
										<td>
											<center><b>Weighted % of the mass passing through thickness gauge = (X x Y)/100</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center><?php echo $row_select_pipe['s11']; ?> MM - <?php echo $row_select_pipe['s21']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['a1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['b1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['c1']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d1']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['e1']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<center><?php echo $row_select_pipe['s12']; ?> MM - <?php echo $row_select_pipe['s22']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['a2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['b2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['c2']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d2']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['e2']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<center><?php echo $row_select_pipe['s13']; ?> MM - <?php echo $row_select_pipe['s23']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['a3']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['b3']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['c3']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d3']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['e3']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<center><?php echo $row_select_pipe['s14']; ?> MM - <?php echo $row_select_pipe['s24']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['a4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['b4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['c4']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d4']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['e4']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<center><?php echo $row_select_pipe['s15']; ?> MM - <?php echo $row_select_pipe['s25']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['a5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['b5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['c5']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d5']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['e5']; ?>
										</td>
									</tr>
									<tr>
										<td colspan="5" align="right"><b>Flakiness Index</b></td>
										<td>
											<center><?php echo $row_select_pipe['fi_index']; ?></center>
										</td>
									</tr>
								</table>
								<br>
								<table align="center" width="90%" class="test" border="1px" height="40%">
									<tr>
										<td colspan="6" style="font-size:13px">
											<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
										</td>
									</tr>
									<tr>
										<td colspan="3"><b>Work sheet for Elongation of Coarse Aggregate (<?php echo $detail_sample; ?>) (IS :2386 - Part I)</b></td>
										<td colspan="3"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
									</tr>
									<tr>
										<td colspan="3"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['bill_id']; ?></td>
										<td colspan="3"><b>Condition of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
									</tr>
									<tr>
										<td colspan="3"><b>Name of Quarry & Location :</b> &nbsp;&nbsp;</td>
										<td colspan="3"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
									</tr>
									<tr>
										<td colspan="6" style="font-size:13px">
											<center><b>Elongation Index</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center><b>Size of Aggregate</b></center>
										</td>
										<td>
											<center><b>Weight (B1) (gm)</b></center>
										</td>
										<td>
											<center><b>Passing Weight from thickness gauge (A1) (gm)</b></center>
										</td>
										<td>
											<center><b>% of mass of total number piece (X)= (A1/B1) x 100</b></center>
										</td>
										<td>
											<center><b>Y = (B1/&Sigma;B1)x 100</b></center>
										</td>
										<td>
											<center><b>Weighted % of the mass passing through thickness gauge = (X x Y)/100</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center><?php echo $row_select_pipe['ss11']; ?> MM - <?php echo $row_select_pipe['ss21']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['aa1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bb1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cc1']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dd1']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['ee1']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<center><?php echo $row_select_pipe['ss12']; ?> MM - <?php echo $row_select_pipe['ss22']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['aa2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bb2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cc2']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dd2']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['ee2']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<center><?php echo $row_select_pipe['ss13']; ?> MM - <?php echo $row_select_pipe['ss23']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['aa3']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bb3']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cc3']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dd3']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['ee3']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<center><?php echo $row_select_pipe['ss14']; ?> MM - <?php echo $row_select_pipe['ss24']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['aa4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bb4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cc4']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dd4']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['ee4']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<center><?php echo $row_select_pipe['ss15']; ?> MM - <?php echo $row_select_pipe['ss25']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['aa5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bb5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cc5']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dd5']; ?>
										</td>
										<td>
											<center><?php echo $row_select_pipe['ee5']; ?>
										</td>
									</tr>
									<tr>
										<td colspan="5" align="right"><b>Elongation Index</b></td>
										<td>
											<center><?php echo $row_select_pipe['ei_index']; ?></center>
										</td>
									</tr>

								</table>
								<br>
								<table align="center" width="90%" class="test" height="10%">
									<tr>
										<td><b>Tested By :</b></td>
										<td align=""><b>Checked By:</b></td>
									</tr>
								</table>
								<!--Bulk Density-->
								<table align="center" width="80%" class="test" border="1px">
									<tr>
										<td colspan="12" style="font-size:13px">
											<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
										</td>
									</tr>
									<tr>
										<td colspan="6"><b>Work sheet for Bulk Density of Coarse Aggregate (<?php echo $detail_sample; ?>) (IS :2386 - Part III)</b></td>
										<td colspan="6"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
									</tr>
									<tr>
										<td colspan="6"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['bill_id']; ?></td>
										<td colspan="6"><b>Weight of sample(g) :</b> &nbsp;&nbsp;</td>
									</tr>
									<tr>
										<td colspan="6"><b>Date Of Sample Receipt:</b></td>
										<td colspan="6"><b>Type of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
									</tr>
									<tr>
										<td colspan="6"><b>Date Of Test Strting :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
										<td colspan="6"><b>Date Of Test Completion :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
									</tr>
								</table>
								<table align="center" width="80%" class="test" border="1px">
									<tr>
										<td rowspan="2">
											<center><b>Sr No.</b></center>
										</td>
										<td rowspan="2">
											<center><b>Sample Id</b></center>
										</td>
										<td rowspan="2">
											<center><b>Condition of aggregate at the time of test (Oven dry/Saturated/Given moisture content)</b></center>
										</td>
										<td>
											<center><b>Volume Of Mould</b></center>
										</td>
										<td rowspan="2">
											<center><b>Weight of empty mould (Kg) W<sub>1</sub></b></center>
										</td>
										<td>
											<center><b>Weight of mould + Sample (Loose) KG</b></center>
										</td>
										<td rowspan="2">
											<center><b>Weight of mould + Sample (Compacted) 25 strokes in each of 3 layer (Kg) W<sub>3</sub></b></center>
										</td>
										<td>
											<center><b>Bulk Density (Loose)</b></center>
										</td>
										<td>
											<center><b>Bulk Density (Compacted) Kg/ L</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center><b>(Lit.)"V"</b></center>
										</td>
										<td>
											<center><b>W<sub>2</sub></b></center>
										</td>
										<td>
											<center><b>(W2 - W1)/V</b></center>
										</td>
										<td>
											<center><b>(W3 - W1)/V</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>1</center>
										</td>
										<td>
											<center></center>
										</td>
										<td>
											<center></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m3']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m4']; ?></center>
										</td>
										<td>
											<center></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bulk_density']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>2</center>
										</td>
										<td>
											<center></center>
										</td>
										<td>
											<center></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m3']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m4']; ?></center>
										</td>
										<td>
											<center></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bulk_density']; ?></center>
										</td>
									</tr>
									<tr>
										<td colspan="6">
											<center></center>
										</td>
										<td>
											<center><b>Average</b></center>
										</td>
										<td>
											<center></center>
										</td>
										<td>
											<center></center>
										</td>

									</tr>
									<table align="center" width="80%" class="test">
										<tr>
											<br>

											<td><b>Tested By :</b></td>
											<td><b>Checked By:</b></td>
										</tr>
									</table>
								</table>
								<!--Crushing Value-->

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
										<td colspan="2"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['bill_id']; ?></td>
										<td colspan="2"><b>Condition of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
									</tr>
									<tr>
										<td colspan="2"><b>Name of Quarry & Location :</b> &nbsp;&nbsp;</td>
										<td colspan="2"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
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
											<center><?php echo $row_select_pipe['cr_c_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cr_c_2']; ?></center>
										</td>
									</tr>
									<tr>
										<td>4</td>
										<td>Average Crushing Value(%)=(L + ii)/2</td>
										<td colspan="2"><?php echo $row_select_pipe['cru_value']; ?></td>
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
										<td>Impact Value (%)=C/A x 100</td>
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
										<td>Average Impact Value(%)=(i + ii)/2</td>
										<td colspan="2"><?php echo $row_select_pipe['imp_value']; ?></td>
									</tr>
									<!--Impact Value-->
									<tr>
										<td align="center" colspan="4"><b>Abrasion by Los Angeles Machine</b></td>
									</tr>
									<tr>
										<td colspan="2">Grading:</td>
										<td colspan="2">Weight of charge (gm):</td>
									</tr>
									<tr>
										<td colspan="2">Number of spheres used:</td>
										<td colspan="2">Number of revolution:</td>
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
										<td></td>
									</tr>
									<tr>
										<td>
											<center>2</center>
										</td>
										<td>Weight of specimen after abrasion test coarser than 1.7 mm IS sieve = W2 gram</td>
										<td>
											<center><?php echo $row_select_pipe['abr_wt_t_c_1']; ?></center>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<center>3</center>
										</td>
										<td>% of Wear = (W1 - W2)/W1 x 100</td>
										<td>
											<center><?php echo $row_select_pipe['abr_index']; ?></center>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<center>4</center>
										</td>
										<td>Average Abrasion Value (%)= (i + ii)/2</td>
										<td colspan="2"><?php echo $row_select_pipe['abr_index']; ?></td>
									</tr>
								</table>
								<table align="center" width="80%" class="test" height="10%">
									<tr>
										<br>
										<td><b>Tested By :</b></td>
										<td><b>Checked By:</b></td>
									</tr>
								</table>
								<!--Soundness-->
								<table align="center" width="80%" class="test" border="1px" height="80%">
									<tr>
										<td colspan="9" style="font-size:13px">
											<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
										</td>
									</tr>
									<tr>
										<td colspan="5"><b>Work sheet for Coarse Aggregate Soundness Test By The Use Of Sodium Sulphate<br> (REF:IS-2386 Part - 5)(Reaffirmed 2011)</b></td>
										<td colspan="4"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
									</tr>
									<tr>
										<td colspan="5"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['bill_id']; ?></td>
										<td colspan="4"><b>Condition of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
									</tr>
									<tr>
										<td colspan="5"><b>Name of Quarry & Location :</b> &nbsp;&nbsp;</td>
										<td colspan="4"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
									</tr>
									<tr>
										<th class="tdclass" style="text-align:center;" rowspan="2">Sr. No.</th>
										<th class="tdclass" style="text-align:center;" rowspan="2">Size of agg.</th>
										<th class="tdclass" style="text-align:center;" rowspan="2">Wt. of Sample taken,g</th>
										<th class="tdclass" style="text-align:center;" colspan="5">Weight Of Sample</th>
										<th class="tdclass" style="text-align:center;" rowspan="2">Soundness %</th>
									</tr>
									<tr>
										<th class="tdclass" style="text-align:center;">After 1<sub>st</sub>cycle, g</th>
										<th class="tdclass" style="text-align:center;">After 2<sub>st</sub>cycle, g</th>
										<th class="tdclass" style="text-align:center;">After 3<sub>st</sub>cycle, g</th>
										<th class="tdclass" style="text-align:center;">After 4<sub>st</sub>cycle, g</th>
										<th class="tdclass" style="text-align:center;">After 5<sub>st</sub>cycle, g</th>

									</tr>
									<tr>
										<th class="tdclass" style="text-align:center;">1</th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['sound_sample'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['w1'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['ga1'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gb1'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gc1'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gd1'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['ge1'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['s1'], 2); ?></th>

									</tr>
									<tr>
										<th class="tdclass" style="text-align:center;">2</th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['sound_sample'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['w2'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['ga2'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gb2'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gc2'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gd2'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['ge2'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['s2'], 2); ?></th>
									</tr>
									<tr>
										<th class="tdclass" style="text-align:center;">3</th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['sound_sample'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['w3'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['ga3'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gb3'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gc3'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gd3'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['ge3'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['soundness'], 2); ?></th>

									</tr>
									<tr>
										<th class="tdclass" style="text-align:center;">Total</th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['sound_sample'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['wsum'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gasum'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gbsum'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gcsum'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gdsum'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['gesum'], 2); ?></th>
										<th class="tdclass" style="text-align:center;"><?php echo round($row_select_pipe['soundness'], 2); ?></th>

									</tr>
								</table>
								<table align="center" width="80%" class="test">
									<tr>
										<br>
										<td><b>Tested By :</b></td>
										<td><b>Checked By:</b></td>
									</tr>
								</table>
								<!--LL PL PI-->
								<table align="center" width="80%" class="test" border="1px" height="60%">
									<tr>
										<td colspan="9" style="font-size:13px">
											<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
										</td>
									</tr>
									<tr>
										<td colspan="4"><b>Work sheet for LL, PL, PI Coarse Aggregate (<?php echo $detail_sample; ?>) (IS :2720 - Part V)</b></td>
										<td colspan="5"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
									</tr>
									<tr>
										<td colspan="4"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['bill_id']; ?></td>
										<td colspan="5"><b>Condition of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
									</tr>
									<tr>
										<td colspan="4"><b>Name of Quarry & Location :</b> &nbsp;&nbsp;</td>
										<td colspan="5"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
									</tr>
									<tr>
										<td colspan="3">
											<center><b>Name of Test</b></center>
										</td>
										<td colspan="3">
											<center><b>Amount of soil sample required (g)</b></center>
										</td>
										<td colspan="3">
											<center><b>Passing IS Sieve</b></center>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<center>Liquid Limit</center>
										</td>
										<td colspan="3">
											<center></center>
										</td>
										<td colspan="3">
											<center></center>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<center>Plastic Limit</center>
										</td>
										<td colspan="3">
											<center></center>
										</td>
										<td colspan="3">
											<center></center>
										</td>
									</tr>
									<tr>
										<br>
										<td colspan="4"><b>History of Soil sample - </b></td>
										<td colspan="5"><b>Natural State / Air - dried / Oven dried / Unknown</b></td>
									</tr>
									<tr>
										<td colspan="4"><b>Period of soaking of soil sample before test -</b></td>
										<td colspan="5"></td>
									</tr>
									<tr>
										<td colspan="9">
											<center><b>LIQUID LIMIT (Corie Penetrometer Apparatus) & PLASTIC LIMIT TEST</b></center>
										</td>
									</tr>
									<tr>
										<td rowspan="2">
											<center><b>Sr. No</b></center>
										</td>
										<td rowspan="2">
											<center><b>Details</b></center>
										</td>
										<td colspan="4">
											<center><b>Liquid Limit</b></center>
										</td>
										<td colspan="3">
											<center><b>Plastic Limit</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>1</center>
										</td>
										<td>
											<center>2</center>
										</td>
										<td>
											<center>3</center>
										</td>
										<td>
											<center>4</center>
										</td>
										<td>
											<center>1</center>
										</td>
										<td>
											<center>2</center>
										</td>
										<td>
											<center>3</center>
										</td>
									</tr>
									<tr>
										<td>
											<center>1</center>
										</td>
										<td>
											<center>Penetration in (mm)</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['p_ll_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['p_ll_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['p_ll_4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['p_ll_5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['p_pl_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['p_pl_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['p_pl_3']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>2</center>
										</td>
										<td>
											<center>Container Number</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cn_ll_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cn_ll_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cn_ll_4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cn_ll_5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cn_pl_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cn_pl_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['cn_pl_3']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>3</center>
										</td>
										<td>
											<center>Wt. Of cont. + Wt. Of wet soil (gm)</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wt_ll_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wt_ll_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wt_ll_4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wt_ll_5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wt_pl_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wt_pl_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wt_pl_3']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>4</center>
										</td>
										<td>
											<center>Wt.Of Cont. + of dry Soil (gm)</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dy_ll_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dy_ll_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dy_ll_4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dy_ll_5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dy_pl_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dy_pl_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['dy_pl_3']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>5</center>
										</td>
										<td>
											<center>Wt. Of Water</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wtr_ll_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wtr_ll_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wtr_ll_4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wtr_ll_5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wtr_pl_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wtr_pl_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['wtr_pl_3']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>6</center>
										</td>
										<td>
											<center>Wt. Of Container</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['con_ll_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['con_ll_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['con_ll_4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['con_ll_5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['con_pl_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['con_pl_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['con_pl_3']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>7</center>
										</td>
										<td>
											<center>Wt. Of Oven Dry Soil</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['od_ll_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['od_ll_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['od_ll_4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['od_ll_5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['od_pl_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['od_pl_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['od_pl_3']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>8</center>
										</td>
										<td>
											<center>% Moisture Content</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['mc_ll_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['mc_ll_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['mc_ll_4']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['mc_ll_5']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['mc_pl_1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['mc_pl_2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['mc_pl_3']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>9</center>
										</td>
										<td>
											<center>Average</center>
										</td>
										<td colspan="4">
											<center><b><?php echo $row_select_pipe['avg_ll']; ?></b></center>
										</td>
										<td colspan="3">
											<center><b><?php echo $row_select_pipe['avg_pl']; ?></b></center>
										</td>
									</tr>

								</table>
								<br>
								<table align="center" width="80%" class="test" height="5%">
									<tr>
										<td><b>Liquid Limit % WL:</b>&nbsp;&nbsp;&nbsp; = Wy + 0.01 (25 - y) (Wy + 15)</td>
									</tr>
								</table>
								<br>
								<table align="center" width="80%" class="test" height="5%">
									<tr>
										<td>y = Penetration in mm</td>
									</tr>
									<tr>
										<td>Wy = Water Content Corresponding to the pentration y</td>
									</tr>
								</table>
								<table align="center" width="80%" class="test" height="5%">
									<tr>
										<br>
										<td><b>Liquid Limit % = <?php echo $row_select_pipe['liquide_limit']; ?></b></td>
									</tr>
								</table>
								<table align="center" width="80%" class="test" height="5%">
									<tr>
										<br>
										<td><b>Plastic Limit % = <?php echo $row_select_pipe['plastic_limit']; ?></b></td>
									</tr>
								</table>
								<table align="center" width="80%" class="test" height="10%">
									<tr>
										<br>
										<td><b>Tested By :</b></td>
										<td><b>Checked By:</b></td>
									</tr>
								</table>
								<!--LL PL PI (Atterbeg's Limits)-->
								<table align="center" width="80%" class="test" border="1px">
									<tr>
										<td colspan="12" style="font-size:13px">
											<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
										</td>
									</tr>
								</table>
								<table align="center" width="80%" class="test" border="1px">
									<tr>
										<td colspan="6"><b>Work sheet for LL, PL, PI Coarse Aggregate (<?php echo $detail_sample; ?>) (IS :2720 - Part V)</b></td>
										<td colspan="6"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
									</tr>
									<tr>
										<td colspan="6"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['bill_id']; ?></td>
										<td colspan="6"><b>Condition of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
									</tr>
									<tr>
										<td colspan="6"><b>Name of Quarry & Location :</b> &nbsp;&nbsp;</td>
										<td colspan="6"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
									</tr>
								</table>
								<table align="center" width="80%" class="test" border="1px">
									<tr>
										<td>
											<center><b>Name of Test</b></center>
										</td>
										<td>
											<center><b>Amount of soil sample required (g)</b></center>
										</td>
										<td>
											<center><b>Passing IS Sieve</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>Liquid Limit</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>Plastic Limit</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>

								</table>
								<table align="center" width="80%" class="test">
									<tr>
										<br>
										<td><b>History of Soil sample - </b></td>
										<td><b>Natural State / Air - dried / Oven dried / Unknown</b></td>
									</tr>
									<tr>
										<td><b>Period of soaking of soil sample before test -</b></td>
										<td></td>
									</tr>
								</table>
								<br>
								<table align="center" width="80%" class="test">
									<tr>
										<td>
											<center><b>LIQUID LIMIT (Cassa Grande One Point) & PLASTIC LIMIT TEST</b></center>
										</td>
									</tr>

								</table>
								<br>
								<table align="center" width="80%" class="test" border="1px">
									<tr>
										<td rowspan="2">
											<center><b>Sr. No</b></center>
										</td>
										<td rowspan="2">
											<center><b>Details</b></center>
										</td>
										<td>
											<center><b>Liquid Limit</b></center>
										</td>
										<td colspan="3" rowspan="2">
											<center><b>Plastic Limit</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>1</center>
										</td>
									</tr>
									<tr>
										<td>
											<center>1</center>
										</td>
										<td>
											<center>No. of Blows (N)</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>2</center>
										</td>
										<td>
											<center>Container Number</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>3</center>
										</td>
										<td>
											<center>Wt. Of cont. + Wt. Of wet soil (gm)</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>4</center>
										</td>
										<td>
											<center>Wt.Of Cont. + of dry Soil (gm)</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>5</center>
										</td>
										<td>
											<center>Wt. Of Water</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>6</center>
										</td>
										<td>
											<center>Wt. Of Container</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>7</center>
										</td>
										<td>
											<center>Wt. Of Oven Dry Soil</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>8</center>
										</td>
										<td>
											<center>% Moisture Content</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>9</center>
										</td>
										<td>
											<center>Liquid Limit (%)</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>10</center>
										</td>
										<td>
											<center>Average Plastic Limit (%)</center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['bill_id']; ?></center>
										</td>
									</tr>
								</table>
								<br>
								<table align="center" width="80%" class="test">
									<tr>
										<td><b>Liquid Limit % WL:</b>&nbsp;&nbsp;&nbsp; = Wy + 0.01 (25 - y) (Wy + 15)</td>
									</tr>
								</table>
								<br>
								<table align="center" width="80%" class="test">
									<tr>
										<td>y = Penetration in mm</td>
									</tr>
									<tr>
										<td>Wy = Water Content Corresponding to the pentration y</td>
									</tr>
								</table>
								<table align="center" width="80%" class="test">
									<tr>
										<br>
										<td><b>Liquid Limit % =</b></td>
									</tr>
								</table>
								<table align="center" width="80%" class="test">
									<tr>
										<br>
										<td><b>Plastic Limit % =</b></td>
									</tr>
								</table>
								<table align="center" width="80%" class="test">
									<tr>
										<br>

										<td><b>Tested By :</b></td>
										<td><b>Checked By:</b></td>
									</tr>
								</table>

								<!--MDD OMC-->
								<table align="center" width="80%" class="test" border="1px" height="40%">
									<tr>
										<td colspan="8" style="font-size:13px">
											<center><b>Span Infrastructure Material Testing & Consultancy Service</b></center>
										</td>
									</tr>
									<tr>
										<td colspan="4"><b>Work sheet for LL, PL, PI Coarse Aggregate (<?php echo $detail_sample; ?>) (IS :2720 - Part V)</b></td>
										<td colspan="4"><b>F/Material/01, Issue No.01, Page No. 1 of 1</b></td>
									</tr>
									<tr>
										<td colspan="4"><b>Laboratory ID No. :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['bill_id']; ?></td>
										<td colspan="4"><b>Condition of Sample :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['con_sample']; ?></td>
									</tr>
									<tr>
										<td colspan="4"><b>Name of Quarry & Location :</b> &nbsp;&nbsp;</td>
										<td colspan="4"><b>Testing Date :</b> &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
									</tr>
									<tr>
										<td colspan="2"><b>Height Of Mould = </b> &nbsp;&nbsp;12.80</td>
										<td colspan="2"><b>Diameter of Mould =</b> &nbsp;&nbsp;10.00</td>
										<td colspan="4"><b>Volume of Mould =</b> &nbsp;&nbsp;1005&nbsp;&nbsp;&nbsp;&nbsp;cm<sub>3</sub></td>
									</tr>
									<tr>
										<td colspan="8" style="font-size:13px">
											<center><b>Density</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>1</center>
										</td>
										<td>Determination No</td>
										<td>
											<center>1</center>
										</td>
										<td>
											<center>2</center>
										</td>
										<td>
											<center>3</center>
										</td>
										<td>
											<center>4</center>
										</td>
										<td>
											<center>5</center>
										</td>
										<td>
											<center>6</center>
										</td>
									</tr>
									<tr>
										<td>
											<center>2</center>
										</td>
										<td>Wt.of mould + Compacted soil(W) gms.</td>
										<td>
											<center><?php echo $row_select_pipe['d11']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d12']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d13']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d14']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d15']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d16']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>3</center>
										</td>
										<td>Wt.of mould (wm) gms.</td>
										<td>
											<center><?php echo $row_select_pipe['d31']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d32']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d33']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d34']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d35']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d36']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>4</center>
										</td>
										<td>Wt.of Compacted soil gms. Ym.</td>
										<td>
											<center><?php echo $row_select_pipe['d41']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d42']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d43']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d44']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d45']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d46']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>5</center>
										</td>
										<td>Wet Density (yd) (g/cc)</td>
										<td>
											<center><?php echo $row_select_pipe['d51']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d52']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d53']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d54']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d55']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d56']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>6</center>
										</td>
										<td>Moisture Content (%) M.C.</td>
										<td>
											<center><?php echo $row_select_pipe['d61']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d62']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d63']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d64']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d65']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d66']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>7</center>
										</td>
										<td>Dry Density</td>
										<td>
											<center><?php echo $row_select_pipe['d71']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d72']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d73']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d74']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d75']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['d76']; ?></center>
										</td>
									</tr>
									<tr>
										<td colspan="8" style="font-size:13px">
											<center><b>Moisture Content</b></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>1</center>
										</td>
										<td>Determination No. (Depth of Sample)</td>
										<td>
											<center>1</center>
										</td>
										<td>
											<center>2</center>
										</td>
										<td>
											<center>3</center>
										</td>
										<td>
											<center>4</center>
										</td>
										<td>
											<center>5</center>
										</td>
										<td>
											<center>6</center>
										</td>
									</tr>
									<tr>
										<td>
											<center>2</center>
										</td>
										<td>Container No.</td>
										<td>
											<center><?php echo $row_select_pipe['m11']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m12']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m13']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m14']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m15']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m16']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>3</center>
										</td>
										<td>Wt.of Container + Wet Soil gms (W<sup>2</sup>)</td>
										<td>
											<center><?php echo $row_select_pipe['m21']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m22']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m23']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m24']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m25']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m26']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>4</center>
										</td>
										<td>Wt.of Container + Dry Soil gms (W<sup>3</sup>)</td>
										<td>
											<center><?php echo $row_select_pipe['m31']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m32']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m33']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m34']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m35']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m36']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>5</center>
										</td>
										<td>Wt.of Water gms (W<sup>2</sup> - W<sup>3</sup>)</td>
										<td>
											<center><?php echo $row_select_pipe['m41']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m42']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m43']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m44']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m45']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m46']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>6</center>
										</td>
										<td>Wt.of Container gms (W<sup>1</sup>)</td>
										<td>
											<center><?php echo $row_select_pipe['m51']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m52']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m53']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m54']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m55']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m56']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>7</center>
										</td>
										<td>Wt.of Dry Soil gms (W<sup>3</sup> - W<sup>1</sup>)</td>
										<td>
											<center><?php echo $row_select_pipe['m61']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m62']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m63']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m64']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m65']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m66']; ?></center>
										</td>
									</tr>
									<tr>
										<td>
											<center>8</center>
										</td>
										<td>Moisture (w) (%) = <u>(W<sup>2</sup> - W<sup>3</sup>) x 100</u><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(W<sup>3</sup> - W<sup>1</sup>)</td>
										<td>
											<center><?php echo $row_select_pipe['m61']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m62']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m63']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m64']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m65']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['m66']; ?></center>
										</td>
									</tr>
									<tr>
										<td colspan="4"><b>Maximum Dry Density = &nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['mdd']; ?></b></td>
										<td colspan="4"><b>Maximum Dry Density = &nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['omc']; ?></b></td>
									</tr>
								</table>
								<table align="center" width="90%" class="test" height="10%">
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
			<?php
						if ($flag < $count) {
			?>
				<div class="pagebreak"> </div>
			<?php } ?>

			<?php
					}
				}
			?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script type="text/javascript">
				$("#print_button").on("click", function() {
					$('#print_button').hide();
					window.print();
				});
			</script>