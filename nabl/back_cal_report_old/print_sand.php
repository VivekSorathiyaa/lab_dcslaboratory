<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 29.7cm;
		height: 21cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 10px;
		font-family: Arial;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Arial;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family: Arial;

	}

	.tdclass1 {

		font-size: 11px;
		font-family: Arial;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$detail_sample = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
	}
	$pagecnt = 1;
	$totalcnt = 1;
	if (($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != "0" && $row_select_pipe['avg_finer'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) {
		$totalcnt++;
	}
	?>

	<br>
	<br>

	<page size="A4">

		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>GOMA ENGINEERING AND CONSULTANCY</b></center>
				</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
			</tr>
			<tr>

				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>
							Fine Aggregate</b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>
			</tr>
			<tr>


				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>
			</tr>

		</table>

		<p class="test1" style="margin-left:5%;">Detail of Sample</p>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="5%">

			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="width:20%;"><b>Laboratory No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $job_no; ?></td>
				<td style="text-align:center;width:5%;"><b>3</b></td>
				<td style="width:20%;"><b>Date of start</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>2</b></td>
				<td style="width:20%;"><b>Job No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['lab_no']; ?></td>
				<td style="text-align:center;width:5%;"><b>4</b></td>
				<td style="width:20%;"><b>Date of Complete</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>

			</tr>


		</table>
		<!--table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
				<tr style="border: 0px solid black;">
					<td colspan="10" style="border: 0px solid black;"><b>Test - 1 Gradation</b></td>
					<td colspan="4" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part 1</b></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td colspan="10" style="border: 0px solid black;" ><b></b></td>
					<td colspan="4" style="text-align:center; border: 0px solid black;"><b>Total Weight   = </b>  <?php if ($row_select_pipe['sample_taken'] != "" && $row_select_pipe['sample_taken'] != "0" && $row_select_pipe['sample_taken'] != null) {
																														echo $row_select_pipe['sample_taken'];
																													} else {
																														echo "&nbsp;";
																													} ?><b>  gm</b></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><center>Sieve Size</center></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;"><center>Wt. of mass <br> retained, gm</center></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;"><center>Cum. mass <br> retained</center></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;"><center>Cum. % mass <br> retained</center></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;"><center>% of passing</center></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;"><center>Requirement</center></td>
					
				</tr>
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;">12.5 mm</td>
					<td colspan="2" style="border: 1px solid black;"></td>
					<td colspan="2" style="border: 1px solid black;"></td>
					<td colspan="2" style="border: 1px solid black;"></td>
					<td colspan="2" style="border: 1px solid black;"></td>
					<td colspan="2" style="border: 1px solid black;"></td>
					
				</tr>
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;">10.0 mm</td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_1'] != "" && $row_select_pipe['cum_wt_gm_1'] != "0" && $row_select_pipe['cum_wt_gm_1'] != null) {
																			echo $row_select_pipe['cum_wt_gm_1'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_1'] != "" && $row_select_pipe['ret_wt_gm_1'] != "0" && $row_select_pipe['ret_wt_gm_1'] != null) {
																			echo $row_select_pipe['ret_wt_gm_1'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_1'] != "" && $row_select_pipe['cum_ret_1'] != "0" && $row_select_pipe['cum_ret_1'] != null) {
																			echo $row_select_pipe['cum_ret_1'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0" && $row_select_pipe['pass_sample_1'] != null) {
																			echo $row_select_pipe['pass_sample_1'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;">4.75 mm</td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_2'] != "" && $row_select_pipe['cum_wt_gm_2'] != "0" && $row_select_pipe['cum_wt_gm_2'] != null) {
																			echo $row_select_pipe['cum_wt_gm_2'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_2'] != "" && $row_select_pipe['ret_wt_gm_2'] != "0" && $row_select_pipe['ret_wt_gm_2'] != null) {
																			echo $row_select_pipe['ret_wt_gm_2'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_2'] != "" && $row_select_pipe['cum_ret_2'] != "0" && $row_select_pipe['cum_ret_2'] != null) {
																			echo $row_select_pipe['cum_ret_2'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_2'] != "" && $row_select_pipe['pass_sample_2'] != "0" && $row_select_pipe['pass_sample_2'] != null) {
																			echo $row_select_pipe['pass_sample_2'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;">2.36 mm</td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_3'] != "" && $row_select_pipe['cum_wt_gm_3'] != "0" && $row_select_pipe['cum_wt_gm_3'] != null) {
																			echo $row_select_pipe['cum_wt_gm_3'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_3'] != "" && $row_select_pipe['ret_wt_gm_3'] != "0" && $row_select_pipe['ret_wt_gm_3'] != null) {
																			echo $row_select_pipe['ret_wt_gm_3'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_3'] != "" && $row_select_pipe['cum_ret_3'] != "0" && $row_select_pipe['cum_ret_3'] != null) {
																			echo $row_select_pipe['cum_ret_3'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_3'] != "" && $row_select_pipe['pass_sample_3'] != "0" && $row_select_pipe['pass_sample_3'] != null) {
																			echo $row_select_pipe['pass_sample_3'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;">1.18 mm</td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_4'] != "" && $row_select_pipe['cum_wt_gm_4'] != "0" && $row_select_pipe['cum_wt_gm_4'] != null) {
																			echo $row_select_pipe['cum_wt_gm_4'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_4'] != "" && $row_select_pipe['ret_wt_gm_4'] != "0" && $row_select_pipe['ret_wt_gm_4'] != null) {
																			echo $row_select_pipe['ret_wt_gm_4'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_4'] != "" && $row_select_pipe['cum_ret_4'] != "0" && $row_select_pipe['cum_ret_4'] != null) {
																			echo $row_select_pipe['cum_ret_4'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_4'] != "" && $row_select_pipe['pass_sample_4'] != "0" && $row_select_pipe['pass_sample_4'] != null) {
																			echo $row_select_pipe['pass_sample_4'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;">600 mic</td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_5'] != "" && $row_select_pipe['cum_wt_gm_5'] != "0" && $row_select_pipe['cum_wt_gm_5'] != null) {
																			echo $row_select_pipe['cum_wt_gm_5'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_5'] != "" && $row_select_pipe['ret_wt_gm_5'] != "0" && $row_select_pipe['ret_wt_gm_5'] != null) {
																			echo $row_select_pipe['ret_wt_gm_5'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_5'] != "" && $row_select_pipe['cum_ret_5'] != "0" && $row_select_pipe['cum_ret_5'] != null) {
																			echo $row_select_pipe['cum_ret_5'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_5'] != "" && $row_select_pipe['pass_sample_5'] != "0" && $row_select_pipe['pass_sample_5'] != null) {
																			echo $row_select_pipe['pass_sample_5'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;">300 mic</td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_6'] != "" && $row_select_pipe['cum_wt_gm_6'] != "0" && $row_select_pipe['cum_wt_gm_6'] != null) {
																			echo $row_select_pipe['cum_wt_gm_6'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_6'] != "" && $row_select_pipe['ret_wt_gm_6'] != "0" && $row_select_pipe['ret_wt_gm_6'] != null) {
																			echo $row_select_pipe['ret_wt_gm_6'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_6'] != "" && $row_select_pipe['cum_ret_6'] != "0" && $row_select_pipe['cum_ret_6'] != null) {
																			echo $row_select_pipe['cum_ret_6'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_6'] != "" && $row_select_pipe['pass_sample_6'] != "0" && $row_select_pipe['pass_sample_6'] != null) {
																			echo $row_select_pipe['pass_sample_6'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;">150 mic</td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_7'] != "" && $row_select_pipe['cum_wt_gm_7'] != "0" && $row_select_pipe['cum_wt_gm_7'] != null) {
																			echo $row_select_pipe['cum_wt_gm_7'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_7'] != "" && $row_select_pipe['ret_wt_gm_7'] != "0" && $row_select_pipe['ret_wt_gm_7'] != null) {
																			echo $row_select_pipe['ret_wt_gm_7'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_7'] != "" && $row_select_pipe['cum_ret_7'] != "0" && $row_select_pipe['cum_ret_7'] != null) {
																			echo $row_select_pipe['cum_ret_7'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_7'] != "" && $row_select_pipe['pass_sample_7'] != "0" && $row_select_pipe['pass_sample_7'] != null) {
																			echo $row_select_pipe['pass_sample_7'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
			
				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;">Total</td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['blank_extra'] != "" && $row_select_pipe['blank_extra'] != "0" && $row_select_pipe['blank_extra'] != null) {
																			echo $row_select_pipe['blank_extra'];
																		} else {
																			echo "&nbsp;";
																		}  ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
					<td colspan="2" style="border: 1px solid black;"></td>
					<td colspan="2" style="border: 1px solid black;"></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;">F.M.</td>
					<td colspan="2" style="border: 1px solid black;"></td>
					<td colspan="2" style="border: 1px solid black;"></td>
					<td colspan="2" style="border: 1px solid black;"></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['grd_fm'] != "" && $row_select_pipe['grd_fm'] != "0" && $row_select_pipe['grd_fm'] != null) {
																			echo $row_select_pipe['grd_fm'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
					
				</tr>
				
				<br>
				<br>
			</table>
				<br>	
				<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
					<tr style="border: 1px solid black;">
						<td colspan="4" style="border: 0px solid black;"><b>Test-2&3 Specific Gravity & Water Absorption of Fine Aggregate </b></td>
						<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part 3</b></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;font-weight:bold;width:10%;"><center><b>Sr.No.</b></center></td>
						<td style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Weight of<br>saturated<br>surface Dry<br>(gm) (A)</b></center></td>
						<td  style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Weight of<Br>sample oven<Br>dry (gm)<Br>(B)</b></center></td>						
						<td   style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Weight of sample,<br>in Water<br>(gm) (C)</b></center></td>						
						<td style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Specific<br>gravity<hr width="100%">B/(A-C)</b></center></td>						
						<td  style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>water absorption <br>(%)<hr width="100%">100(A-B)/B</b></center></td>						
						
					</tr>
					<tr>
						<td  style="border: 1px solid black;"><center>1</b></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_wt_st_1'] != "" && $row_select_pipe['sp_wt_st_1'] != "0" && $row_select_pipe['sp_wt_st_1'] != null) {
																			echo number_format($row_select_pipe['sp_wt_st_1'], 1);
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_s_1'] != "" && $row_select_pipe['sp_w_s_1'] != "0" && $row_select_pipe['sp_w_s_1'] != null) {
																			echo $row_select_pipe['sp_w_s_1'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_sur_1'] != "" && $row_select_pipe['sp_w_sur_1'] != "0" && $row_select_pipe['sp_w_sur_1'] != null) {
																			echo $row_select_pipe['sp_w_sur_1'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_specific_gravity_1'] != "" && $row_select_pipe['sp_specific_gravity_1'] != "0" && $row_select_pipe['sp_specific_gravity_1'] != null) {
																			echo $row_select_pipe['sp_specific_gravity_1'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_water_abr_1'] != "" && $row_select_pipe['sp_water_abr_1'] != "0" && $row_select_pipe['sp_water_abr_1'] != null) {
																			echo $row_select_pipe['sp_water_abr_1'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>						
						
					</tr>
					<tr>
						<td  style="border: 1px solid black;"><center>2</center></td>
						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_wt_st_2'] != "" && $row_select_pipe['sp_wt_st_2'] != "0" && $row_select_pipe['sp_wt_st_2'] != null) {
																			echo number_format($row_select_pipe['sp_wt_st_2'], 1);
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_s_2'] != "" && $row_select_pipe['sp_w_s_2'] != "0" && $row_select_pipe['sp_w_s_2'] != null) {
																			echo $row_select_pipe['sp_w_s_2'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_sur_2'] != "" && $row_select_pipe['sp_w_sur_2'] != "0" && $row_select_pipe['sp_w_sur_2'] != null) {
																			echo $row_select_pipe['sp_w_sur_2'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_specific_gravity_2'] != "" && $row_select_pipe['sp_specific_gravity_2'] != "0" && $row_select_pipe['sp_specific_gravity_2'] != null) {
																			echo $row_select_pipe['sp_specific_gravity_2'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_water_abr_2'] != "" && $row_select_pipe['sp_water_abr_2'] != "0" && $row_select_pipe['sp_water_abr_2'] != null) {
																			echo $row_select_pipe['sp_water_abr_2'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>						
						
					</tr>
					<tr>
						<td style="border: 1px solid black;" align="right" colspan="4"><b>Average</b></td>
											
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) {
																			echo $row_select_pipe['sp_specific_gravity'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) {
																			echo $row_select_pipe['sp_water_abr'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>						
						
					</tr>
				
					
				</table>
				<br>
			
				<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
						<tr style="border: 1px solid black;">
							<td colspan="3" style="border: 0px solid black;"><b>Test-4 Bulk Density</b></td>
							<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part 3</b></td>
						</tr>
					
					
						<tr>
						<td style="border: 1px solid black;width:5%;"><center><b>Sr.No.</b></center></td>
						<td style="border: 1px solid black;width:50%;"><center><b>Particular</b></center></td>
						<td style="border: 1px solid black;width:15%;"><center><b>(I)</b></center></td>
						<td style="border: 1px solid black;width:15%;"><center><b>(II)</b></center></td>						
						<td style="border: 1px solid black;width:15%;"><center><b>(III)</b></center></td>						
						
						</tr>
						<tr>
						<td style="border: 1px solid black;"><center><b>1</b></center></td>
						<td style="border: 1px solid black;"><b>Weight of Mould + Material in kg</b></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m11'] != "" && $row_select_pipe['m11'] != "0" && $row_select_pipe['m11'] != null) {
																			echo $row_select_pipe['m11'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m12'] != "" && $row_select_pipe['m12'] != "0" && $row_select_pipe['m12'] != null) {
																			echo $row_select_pipe['m12'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m13'] != "" && $row_select_pipe['m13'] != "0" && $row_select_pipe['m13'] != null) {
																			echo $row_select_pipe['m13'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						</tr>
						<tr>
						<td style="border: 1px solid black;"><center><b>2</b></center></td>
						<td style="border: 1px solid black;"><b>Weight of Mould in kg</b></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m21'] != "" && $row_select_pipe['m21'] != "0" && $row_select_pipe['m21'] != null) {
																			echo $row_select_pipe['m21'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m22'] != "" && $row_select_pipe['m22'] != "0" && $row_select_pipe['m22'] != null) {
																			echo $row_select_pipe['m22'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m23'] != "" && $row_select_pipe['m23'] != "0" && $row_select_pipe['m23'] != null) {
																			echo $row_select_pipe['m23'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						</tr>
						<tr>
						<td style="border: 1px solid black;"><center><b>3</b></center></td>
						<td style="border: 1px solid black;"><b>Weight of Material in kg</b></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wom1'] != "" && $row_select_pipe['wom1'] != "0" && $row_select_pipe['wom1'] != null) {
																			echo $row_select_pipe['wom1'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wom2'] != "" && $row_select_pipe['wom2'] != "0" && $row_select_pipe['wom2'] != null) {
																			echo $row_select_pipe['wom2'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wom3'] != "" && $row_select_pipe['wom3'] != "0" && $row_select_pipe['wom3'] != null) {
																			echo $row_select_pipe['wom3'];
																		} else {
																			echo "&nbsp;";
																		} ?></center></td>
						</tr>
						<tr>
						<td colspan="2" style="border: 1px solid black;text-align:right;"><b>Average</b></td>
					
						<td colspan="3" style="border: 1px solid black;"><center><?php if ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null) {
																						echo $row_select_pipe['avg_wom'];
																					} else {
																						echo "&nbsp;";
																					} ?></center></td>
						
						</tr>
						
						</table>
						<table align="center" width="90%" class="test1" style="border: 2px solid black;border-top: 0px solid black;" height="Auto">
						<tr>
							<td colspan="4" style="border: 0px solid black;text-align:left;"><b>Sand condition at that time :-</b></td>
						
							<td colspan="4" style="border: 0px solid black;text-align:left;"><b>(Oven dry/S.S.D./Moisturized)</b></td>
						
						</tr>
						
						<tr>
							<td  style="border: 0px solid black;"><b>&nbsp;&nbsp; Bulk Density</b></td>
						
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td  style="border: 0px solid black;text-align:center;">Weight of Material <hr></td>
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td  style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null) {
																						echo $row_select_pipe['avg_wom'];
																					} else {
																						echo "&nbsp;";
																					} ?><hr></td>
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td  style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null) {
																						echo $row_select_pipe['bdl'];
																					} else {
																						echo "&nbsp;";
																					} ?><hr></td>
							<td  style="border: 0px solid black;text-align:left;">kg/Lit.</td>
							
						</tr>
						<tr>
							<td  style="border: 0px solid black;"><b></b></td>
						
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;">Volume of Mould</td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['vol'] != "" && $row_select_pipe['vol'] != "0" && $row_select_pipe['vol'] != null) {
																						echo $row_select_pipe['vol'];
																					} else {
																						echo "&nbsp;";
																					} ?></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:left;"></td>
							<td  style="border: 0px solid black;text-align:left;"></td>
							
						</tr>
						
						
					
					</table>
					
					
					<?php
					/*if(($row_select_pipe['avg_finer']!="" && $row_select_pipe['avg_finer']!="0" && $row_select_pipe['avg_finer']!=null) || ($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null))
						{
							$pagecnt++;*/

					?>
				<div class="pagebreak"> </div>
		
				<br>
				<br>
				
				<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black;">
				<tr >
					<td  rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
					<td rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>GOMA ENGINEERING AND CONSULTANCY</b></center></td>					
					<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
				</tr>
				<tr >
					
					<td  rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>
					Fine Aggregate</b></center></td>					
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>					
				</tr>
				<tr >
					
										
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>					
				</tr>                             
				<tr >													
					<td colspan="4"style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>					
				</tr>
				
			</table>
			<br>
			<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
						<tr>
							<td colspan="5" style="border: 0px solid black;text-align:left;"><b>Test-5 Material Finer Then 75 Micron</b></td>
						
							<td colspan="4" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part 1</b></td>
						
						</tr>
						
						<tr>
							<td colspan="9" style="border: 0px solid black;text-align:left;height:70px;"><b>Material finer then 75 Micron IS sieve shall be calculated as follows:</b></td>
						</tr>
						
						<tr>
							<td  style="border: 0px solid black;text-align:left;"><b>&nbsp;&nbsp; A  Original Weight (A)</b></td>
							<td  style="border: 0px solid black;text-align:left;text-align:center"><b>=</b></td>
						
							<td colspan="7" style="border: 0px solid black;text-align:left;padding-left:12px;"><?php if ($row_select_pipe['finer_a'] != "" && $row_select_pipe['finer_a'] != "0" && $row_select_pipe['finer_a'] != null) {
																													echo $row_select_pipe['finer_a'];
																												} else {
																													echo "&nbsp;";
																												} ?></td>
						
						</tr>
						<tr>
							<td  style="border: 0px solid black;"><b></b></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"> <hr></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;">&nbsp;</td>
							
							
						</tr>
						<tr>
							<td style="border: 0px solid black;"><b>&nbsp;&nbsp; B  Dry Weight after washing (B)</b></td>
							<td  style="border: 0px solid black;text-align:center"><b>=</b></td>
							<td colspan="7" style="border: 0px solid black;text-align:left;padding-left:12px;"><?php if ($row_select_pipe['finer_b'] != "" && $row_select_pipe['finer_b'] != "0" && $row_select_pipe['finer_b'] != null) {
																													echo number_format($row_select_pipe['finer_b'], 1);
																												} else {
																													echo "&nbsp;";
																												} ?></td>
						
						</tr>
						<tr>
							<td  style="border: 0px solid black;"><b></b></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"> <hr></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;">&nbsp;</td>
							
							
						</tr>
						<tr>
							<td  style="border: 0px solid black;"><b>&nbsp;&nbsp; Finer than 75 Micron</b></td>
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td  style="border: 0px solid black;text-align:center;">A-B <hr></td>
							<td  style="border: 0px solid black;text-align:center;">X</td>
							<td  style="border: 0px solid black;text-align:center;">100</td>
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td  style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['finer_a'] != "" && $row_select_pipe['finer_a'] != "0" && $row_select_pipe['finer_a'] != null) {
																						echo $row_select_pipe['finer_a'];
																					} else {
																						echo "&nbsp;";
																					} ?> - <?php if ($row_select_pipe['finer_b'] != "" && $row_select_pipe['finer_b'] != "0" && $row_select_pipe['finer_b'] != null) {
																																																																		echo number_format($row_select_pipe['finer_b'], 1);
																																																																	} else {
																																																																		echo "&nbsp;";
																																																																	} ?><hr></td>
							<td  style="border: 0px solid black;text-align:center;">X</td>
							<td  style="border: 0px solid black;text-align:center;">100</td>
							
							
						</tr>
						
						<tr>
							<td  style="border: 0px solid black;"><b></b></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;">A</td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['finer_a'] != "" && $row_select_pipe['finer_a'] != "0" && $row_select_pipe['finer_a'] != null) {
																						echo $row_select_pipe['finer_a'];
																					} else {
																						echo "&nbsp;";
																					} ?></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							
							
						</tr>
						
						<tr>
							<td  colspan="5" style="border: 0px solid black;text-align:right;height:70px;"><b>Finer than 75 Micron</b></td>
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td colspan="3" style="border: 0px solid black;"><b><?php if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != "0" && $row_select_pipe['avg_finer'] != null) {
																					echo $row_select_pipe['avg_finer'];
																				} else {
																					echo "&nbsp;";
																				} ?> %</b></td>
							
							
							
						</tr>
						
						
					</table-->
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="40%">
			<tr style="border: 0px solid black;">
				<td style="border: 0px solid black;border-right: 1px solid black;"><b>Test - 1</b></td>
				<td colspan="3" style="border: 0px solid black;"><b>Soundness Test</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part 5</b></td>
			</tr>

			<tr style="border: 1px solid black;font-weight:bold;">
				<td colspan="2" style="border: 1px solid black;">
					<center>Sieve Size</center>
				</td>
				<td style="border: 1px solid black;" rowspan="2">
					<center>Grading of <br> Original <br> sample percent</center>
				</td>
				<td style="border: 1px solid black;" rowspan="2">
					<center>Weight of test <br> fractions before test</center>
				</td>
				<td style="border: 1px solid black;" rowspan="2">
					<center>Percentage passing <br> finer sieve after test <br> (Actual Percentage loss)</center>
				</td>
				<td style="border: 1px solid black;" rowspan="2">
					<center>Weighted average <br> (corrected percent <br> loss)</center>
				</td>

			</tr>
			<tr style="text-align:center;font-weight:bold;">
				<td style="border: 1px solid black;font-weight:bold;">Passing</td>
				<td style="border: 1px solid black;font-weight:bold;">Retained</td>


			</tr>
			<tr style="border: 1px solid black;font-weight:bold;">
				<td style="border: 1px solid black;">
					<center>1</center>
				</td>
				<td style="border: 1px solid black;">
					<center>2</center>
				</td>
				<td style="border: 1px solid black;">
					<center>3</center>
				</td>
				<td style="border: 1px solid black;">
					<center>4</center>
				</td>
				<td style="border: 1px solid black;">
					<center>5</center>
				</td>
				<td style="border: 1px solid black;">
					<center>6</center>
				</td>

			</tr>
			<tr style="text-align:center">
				<td colspan="6" style="border: 1px solid black;font-weight:bold;">Soundness Test for Fine Aggregate</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>150 mic</center>
				</td>
				<td style="border: 1px solid black;">
					<center>--</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['go1'] != "" && $row_select_pipe['go1'] != "0" && $row_select_pipe['go1'] != null) {
								echo $row_select_pipe['go1'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wt1'] != "" && $row_select_pipe['wt1'] != "0" && $row_select_pipe['wt1'] != null) {
								echo $row_select_pipe['wt1'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pp1'] != "" && $row_select_pipe['pp1'] != "0" && $row_select_pipe['pp1'] != null) {
								echo $row_select_pipe['pp1'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa1'] != "" && $row_select_pipe['wa1'] != "0" && $row_select_pipe['wa1'] != null) {
								echo $row_select_pipe['wa1'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>300 mic</center>
				</td>
				<td style="border: 1px solid black;">
					<center>150 mic</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['go2'] != "" && $row_select_pipe['go2'] != "0" && $row_select_pipe['go2'] != null) {
								echo $row_select_pipe['go2'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wt2'] != "" && $row_select_pipe['wt2'] != "0" && $row_select_pipe['wt2'] != null) {
								echo $row_select_pipe['wt2'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pp2'] != "" && $row_select_pipe['pp2'] != "0" && $row_select_pipe['pp2'] != null) {
								echo $row_select_pipe['pp2'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa2'] != "" && $row_select_pipe['wa2'] != "0" && $row_select_pipe['wa2'] != null) {
								echo $row_select_pipe['wa2'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>600 mic</center>
				</td>
				<td style="border: 1px solid black;">
					<center>300 mic</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['go3'] != "" && $row_select_pipe['go3'] != "0" && $row_select_pipe['go3'] != null) {
								echo $row_select_pipe['go3'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wt3'] != "" && $row_select_pipe['wt3'] != "0" && $row_select_pipe['wt3'] != null) {
								echo $row_select_pipe['wt3'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pp3'] != "" && $row_select_pipe['pp3'] != "0" && $row_select_pipe['pp3'] != null) {
								echo $row_select_pipe['pp3'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa3'] != "" && $row_select_pipe['wa3'] != "0" && $row_select_pipe['wa3'] != null) {
								echo $row_select_pipe['wa3'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>1.18 mm</center>
				</td>
				<td style="border: 1px solid black;">
					<center>600 mic</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['go4'] != "" && $row_select_pipe['go4'] != "0" && $row_select_pipe['go4'] != null) {
								echo $row_select_pipe['go4'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wt4'] != "" && $row_select_pipe['wt4'] != "0" && $row_select_pipe['wt4'] != null) {
								echo $row_select_pipe['wt4'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pp4'] != "" && $row_select_pipe['pp4'] != "0" && $row_select_pipe['pp4'] != null) {
								echo $row_select_pipe['pp4'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa4'] != "" && $row_select_pipe['wa4'] != "0" && $row_select_pipe['wa4'] != null) {
								echo $row_select_pipe['wa4'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>2.36 mm</center>
				</td>
				<td style="border: 1px solid black;">
					<center>1.18 mm</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['go5'] != "" && $row_select_pipe['go5'] != "0" && $row_select_pipe['go5'] != null) {
								echo $row_select_pipe['go5'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wt5'] != "" && $row_select_pipe['wt5'] != "0" && $row_select_pipe['wt5'] != null) {
								echo $row_select_pipe['wt5'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pp5'] != "" && $row_select_pipe['pp5'] != "0" && $row_select_pipe['pp5'] != null) {
								echo $row_select_pipe['pp5'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa5'] != "" && $row_select_pipe['wa5'] != "0" && $row_select_pipe['wa5'] != null) {
								echo $row_select_pipe['wa5'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>4.75 mm</center>
				</td>
				<td style="border: 1px solid black;">
					<center>2.36 mm</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['go6'] != "" && $row_select_pipe['go6'] != "0" && $row_select_pipe['go6'] != null) {
								echo $row_select_pipe['go6'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wt6'] != "" && $row_select_pipe['wt6'] != "0" && $row_select_pipe['wt6'] != null) {
								echo $row_select_pipe['wt6'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pp6'] != "" && $row_select_pipe['pp6'] != "0" && $row_select_pipe['pp6'] != null) {
								echo $row_select_pipe['pp6'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa6'] != "" && $row_select_pipe['wa6'] != "0" && $row_select_pipe['wa6'] != null) {
								echo $row_select_pipe['wa6'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>10 mm</center>
				</td>
				<td style="border: 1px solid black;">
					<center>4.75 mm</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['go7'] != "" && $row_select_pipe['go7'] != "0" && $row_select_pipe['go7'] != null) {
								echo $row_select_pipe['go7'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wt7'] != "" && $row_select_pipe['wt7'] != "0" && $row_select_pipe['wt7'] != null) {
								echo $row_select_pipe['wt7'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pp7'] != "" && $row_select_pipe['pp7'] != "0" && $row_select_pipe['pp7'] != null) {
								echo $row_select_pipe['pp7'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa7'] != "" && $row_select_pipe['wa7'] != "0" && $row_select_pipe['wa7'] != null) {
								echo $row_select_pipe['wa7'];
							} else {
								echo "&nbsp;";
							}  ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>&nbsp;</center>
				</td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 0px solid black;">Results :-</td>
				<td style="border: 0px solid black;">Soundness</td>
				<td style="border: 0px solid black;">=</td>
				<td colspan="3" style="border: 0px solid black;text-align:left;"> <?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {
																						echo $row_select_pipe['soundness'];
																					} else {
																						echo "&nbsp;";
																					}  ?> %</td>


			</tr>

			<br>
			<br>
		</table>
		<div class="pagebreak"></div>
		<br>
		<br>
		<br>
		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>GOMA ENGINEERING AND CONSULTANCY</b></center>
				</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
			</tr>
			<tr>

				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>Coarse Aggregate</b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>
			</tr>
			<tr>


				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>
			</tr>
		</table>

		<p style="margin-left:50px;">1. Chloride Content (BS EN 1744 - 1)</p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;" height="Auto" cellpadding="3px">
			<tr>
				<td width="60%" style="border: 1px solid black;"><b>Method</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S1 gm</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S2 gm</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Weight of Soil Sample</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_1'] != "" && $row_select_pipe['clr_s1_1'] != "0" && $row_select_pipe['clr_s1_1'] != null) {
															echo $row_select_pipe['clr_s1_1'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_1'] != "" && $row_select_pipe['clr_s2_1'] != "0" && $row_select_pipe['clr_s2_1'] != null) {
															echo $row_select_pipe['clr_s2_1'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Weight of Water</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_2'] != "" && $row_select_pipe['clr_s1_2'] != "0" && $row_select_pipe['clr_s1_2'] != null) {
															echo $row_select_pipe['clr_s1_2'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_2'] != "" && $row_select_pipe['clr_s2_2'] != "0" && $row_select_pipe['clr_s2_2'] != null) {
															echo $row_select_pipe['clr_s2_2'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Weight of Soil Ratio gm/g (W)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_3'] != "" && $row_select_pipe['clr_s1_3'] != "0" && $row_select_pipe['clr_s1_3'] != null) {
															echo $row_select_pipe['clr_s1_3'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_3'] != "" && $row_select_pipe['clr_s2_3'] != "0" && $row_select_pipe['clr_s2_3'] != null) {
															echo $row_select_pipe['clr_s2_3'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Volume of AgNo3.0.1M Solution ml (V5)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_4'] != "" && $row_select_pipe['clr_s1_4'] != "0" && $row_select_pipe['clr_s1_4'] != null) {
															echo $row_select_pipe['clr_s1_4'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_4'] != "" && $row_select_pipe['clr_s2_4'] != "0" && $row_select_pipe['clr_s2_4'] != null) {
															echo $row_select_pipe['clr_s2_4'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Volume of STD NH45CN Solution (ml) (V6)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_5'] != "" && $row_select_pipe['clr_s1_5'] != "0" && $row_select_pipe['clr_s1_5'] != null) {
															echo $row_select_pipe['clr_s1_5'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_5'] != "" && $row_select_pipe['clr_s2_5'] != "0" && $row_select_pipe['clr_s2_5'] != null) {
															echo $row_select_pipe['clr_s2_5'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>CT - Normality of NH4SCN</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_6'] != "" && $row_select_pipe['clr_s1_6'] != "0" && $row_select_pipe['clr_s1_6'] != null) {
															echo $row_select_pipe['clr_s1_6'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_6'] != "" && $row_select_pipe['clr_s2_6'] != "0" && $row_select_pipe['clr_s2_6'] != null) {
															echo $row_select_pipe['clr_s2_6'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Chloride = 0.003546*W {(V5-(10*CT*V6))}</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_7'] != "" && $row_select_pipe['clr_s1_7'] != "0" && $row_select_pipe['clr_s1_7'] != null) {
															echo $row_select_pipe['clr_s1_7'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_7'] != "" && $row_select_pipe['clr_s2_7'] != "0" && $row_select_pipe['clr_s2_7'] != null) {
															echo $row_select_pipe['clr_s2_7'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>% Average</b></td>
				<td colspan="2" style="border: 1px solid black;"><b><?php if ($row_select_pipe['avg_clr'] != "" && $row_select_pipe['avg_clr'] != "0" && $row_select_pipe['avg_clr'] != null) {
																		echo $row_select_pipe['avg_clr'];
																	} else {
																		echo " <br>";
																	} ?></b></td>
			</tr>
		</table>
		<p style="margin-left:50px;">2. pH (IS 2720 - 26)</p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td width="60%" style="border: 1px solid black;"><b>Method</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S1 gm</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S2 gm</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Volume in ml of sample taken (V)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['ph_s1_1'] != "" && $row_select_pipe['ph_s1_1'] != "0" && $row_select_pipe['ph_s1_1'] != null) {
															echo $row_select_pipe['ph_s1_1'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['ph_s2_1'] != "" && $row_select_pipe['ph_s2_1'] != "0" && $row_select_pipe['ph_s2_1'] != null) {
															echo $row_select_pipe['ph_s2_1'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>pH</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['ph_s1_2'] != "" && $row_select_pipe['ph_s1_2'] != "0" && $row_select_pipe['ph_s1_2'] != null) {
															echo $row_select_pipe['ph_s1_2'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['ph_s2_2'] != "" && $row_select_pipe['ph_s2_2'] != "0" && $row_select_pipe['ph_s2_2'] != null) {
															echo $row_select_pipe['ph_s2_2'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>% Average</b></td>
				<td colspan="2" style="border: 1px solid black;"><b><?php if ($row_select_pipe['avg_ph'] != "" && $row_select_pipe['avg_ph'] != "0" && $row_select_pipe['avg_ph'] != null) {
																		echo $row_select_pipe['avg_ph'];
																	} else {
																		echo " <br>";
																	} ?></b></td>
			</tr>
		</table>
		<p style="margin-left:50px;">3. Sulphate (IS 2720 - 27)</p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="60%" style="border: 1px solid black;"><b>Method</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S1 gm</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S2 gm</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Initial Weight of Sample (A) gm</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s1_1'] != "" && $row_select_pipe['slp_s1_1'] != "0" && $row_select_pipe['slp_s1_1'] != null) {
															echo $row_select_pipe['slp_s1_1'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s2_1'] != "" && $row_select_pipe['slp_s2_1'] != "0" && $row_select_pipe['slp_s2_1'] != null) {
															echo $row_select_pipe['slp_s2_1'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Empty weight of Crucible + Sample After Ignition (C) gm</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s1_2'] != "" && $row_select_pipe['slp_s1_2'] != "0" && $row_select_pipe['slp_s1_2'] != null) {
															echo $row_select_pipe['slp_s1_2'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s2_2'] != "" && $row_select_pipe['slp_s2_2'] != "0" && $row_select_pipe['slp_s2_2'] != null) {
															echo $row_select_pipe['slp_s2_2'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Weight of Residue after Ignition D = (C-B) gm</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s1_3'] != "" && $row_select_pipe['slp_s1_3'] != "0" && $row_select_pipe['slp_s1_3'] != null) {
															echo $row_select_pipe['slp_s1_3'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s2_3'] != "" && $row_select_pipe['slp_s2_3'] != "0" && $row_select_pipe['slp_s2_3'] != null) {
															echo $row_select_pipe['slp_s2_3'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>S04 (%) = 41.15-D/A</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s1_4'] != "" && $row_select_pipe['slp_s1_4'] != "0" && $row_select_pipe['slp_s1_4'] != null) {
															echo $row_select_pipe['slp_s1_4'];
														} else {
															echo " <br>";
														} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s2_4'] != "" && $row_select_pipe['slp_s2_4'] != "0" && $row_select_pipe['slp_s2_4'] != null) {
															echo $row_select_pipe['slp_s2_4'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>% Average</b></td>
				<td colspan="2" style="border: 1px solid black;"><b><?php if ($row_select_pipe['avg_sul'] != "" && $row_select_pipe['avg_sul'] != "0" && $row_select_pipe['avg_sul'] != null) {
																		echo $row_select_pipe['avg_sul'];
																	} else {
																		echo " <br>";
																	} ?></b></td>
			</tr>
		</table>

		<div class="pagebreak"></div>
		<br>
		<br>
		<br>
		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>GOMA ENGINEERING AND CONSULTANCY</b></center>
				</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
			</tr>
			<tr>

				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>Coarse Aggregate</b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>
			</tr>
			<tr>


				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>
			</tr>
		</table>
		<p style="margin-left:50px;"><b>Deleterius Materials (IS 2686 - 1 & 2) - 1963</b></p>
		<p style="margin-left:50px; "><b>(i) % finer than 75u</b></p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Weight of Sample, gm (B)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_1_1'] != "0" && $row_select_pipe['dele_1_1'] != null) {
															echo $row_select_pipe['dele_1_1'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>After washing through water, then oven dry weight</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_2'] != "" && $row_select_pipe['dele_1_2'] != "0" && $row_select_pipe['dele_1_2'] != null) {
															echo $row_select_pipe['dele_1_2'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Weight of Sample, gm (C)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_3'] != "" && $row_select_pipe['dele_1_3'] != "0" && $row_select_pipe['dele_1_3'] != null) {
															echo $row_select_pipe['dele_1_3'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>% finer than 75u (A) = (B-C)/B * 100</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_1_4'] != null) {
															echo $row_select_pipe['dele_1_4'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
		</table>

		<p style="margin-left:50px; "><b>(ii) % Clay and Lumps</b></p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Wt of Sample gm (W)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_2_1'] != "0" && $row_select_pipe['dele_2_1'] != null) {
															echo $row_select_pipe['dele_2_1'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>After broken with fingre then paassing 2.36mm IS Sieve gm (R)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_2_2'] != "" && $row_select_pipe['dele_2_2'] != "0" && $row_select_pipe['dele_2_2'] != null) {
															echo $row_select_pipe['dele_2_2'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>% Clay Lumps = (W-R)/B * 100</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) {
															echo $row_select_pipe['dele_2_3'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
		</table>

		<p style="margin-left:50px; "><b>(iii) % Coal and Lignite</b></p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Wt of Sample gm (W1)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_3_1'] != "0" && $row_select_pipe['dele_3_1'] != null) {
															echo $row_select_pipe['dele_3_1'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Introduce in to heavy liquid then wt gm (W2)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_3_2'] != "" && $row_select_pipe['dele_3_2'] != "0" && $row_select_pipe['dele_3_2'] != null) {
															echo $row_select_pipe['dele_3_2'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>% Coal & Ligntie = (W1 - W2)/W1 * 100</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_3_3'] != "") {
															echo $row_select_pipe['dele_3_3'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
		</table>

		<p style="margin-left:50px; "><b>(iv) % Soft Particle</b></p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Weight of Sample as per IS 2386 (P-2), CL no S 3.1 gms (A)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_4_1'] != "0" && $row_select_pipe['dele_4_1'] != null) {
															echo $row_select_pipe['dele_4_1'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Weight of Soft Particle broken from surface after brass rod rubbing, gms (B)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_4_2'] != "" && $row_select_pipe['dele_4_2'] != "0" && $row_select_pipe['dele_4_2'] != null) {
															echo $row_select_pipe['dele_4_2'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>% Soft Particle :- B/A * 100</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_4_3'] != "0" && $row_select_pipe['dele_4_3'] != null) {
															echo $row_select_pipe['dele_4_3'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
		</table>

		<p style="margin-left:50px;"><b>ORGANIC IMPURITIES (IS 2686 - 2) - 1963</b></p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Fill Solutions upto Mark</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['aoi_1'] != "" && $row_select_pipe['aoi_1'] != "0" && $row_select_pipe['aoi_1'] != null) {
															echo $row_select_pipe['aoi_1'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Fill Sand upto mark</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['aoi_2'] != "" && $row_select_pipe['aoi_2'] != "0" && $row_select_pipe['aoi_2'] != null) {
															echo $row_select_pipe['aoi_2'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Further fill solution upto mark</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['aoi_3'] != "" && $row_select_pipe['aoi_3'] != "0" && $row_select_pipe['aoi_3'] != null) {
															echo $row_select_pipe['aoi_3'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Observation</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['aoi_4'] != "" && $row_select_pipe['aoi_4'] != "0" && $row_select_pipe['aoi_4'] != null) {
															echo $row_select_pipe['aoi_4'];
														} else {
															echo " <br>";
														} ?></b></td>
			</tr>
		</table>
		<?php
		/*}*/
		?>
	</page>

</body>

</html>


<script type="text/javascript">


</script>