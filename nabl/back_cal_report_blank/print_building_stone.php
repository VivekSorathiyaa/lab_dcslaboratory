<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 30px;
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
		font-family : Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family : Calibri;

	}

	.tdclass1 {

		font-size: 11px;
		font-family : Calibri;
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
				$branch_name = $row_select['branch_name'];
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
						$mt_name= $row_select3['mt_name'];
						
						include_once 'sample_id.php';
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

	<br><br><br>
	<page size="A4">

				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">GRANITE STONE</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">FMT-OBS-00</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date("d/m/Y",strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;"> Location Name :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
                            <tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS :1127 - 1974</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
						</table>
					</td>
				</tr>	
			<br>


		<!-- <table align="center" width="100%" class="test1" height="15%">
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Location Name</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of starting test</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($start_date)); ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of completion</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($end_date)); ?></td>
			</tr>
		</table>
		<br>																													 -->


				<?php
					/*if($row_select_pipe['chk_wtr']== 1)
				{*/
					?>
				<table align="center" width="100%" class="test" border="1px" style="font-size:13px;">
					<tr>
						<td colspan="12" style="padding:7px 3px;"><b>&nbsp; Determination of water Absorption of Natural Builing stone (As per IS :1127 - 1974,)</b></td>
					</tr>
					<tr >
						<td colspan="6" rowspan="2">
							<center><b>Observation</b></center>
						</td>
						<td colspan="6">
							<center style="padding:7px 3px;"><b>SAMPLE</b></center>
						</td>
					</tr>
						<tr>

							<td colspan="2">
								<center style="padding:7px 3px;"><b>I</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>II</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>III</b></center>
							</td>

						</tr>
						<tr >
							<td colspan="6" width="70%"	>
								<center style="padding:5px 3px;">Weight of the saturated surface dry test piece in W1 (gms)</center>
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
								<center style="padding:5px 3px;">Weight of oven dry test piece in W2 (gms)</center>
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
								<center style="padding:5px 3px;">Water Absorption (%) (W1 - W2 / W2) X 100</center>
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
								<center style="padding:5px 3px;">Average Water Absorption (%)</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_wtr']; ?></center>
							</td>

						</tr>
				</table>
				<br>
					
					<? php/* }
			   if ($row_select_pipe['chk_t_sp'] == 1)
				{*/
					?>
					<!--Specific Gravity Water Abrasion-->
			    <table align="center" width="100%" class="test" border="1px" style="font-size:13px;">
						<tr>
							<td colspan="12" style="padding:7px 3px;"><b>&nbsp;&nbsp; Determination of True Specific Gravity of Natural Builing stone (As per IS :1122 - 1974,)</b></td>
						</tr>
						<tr >
							<td colspan="6" rowspan="2">
								<center><b>Observation</b></center>
							</td>
							<td colspan="6">
								<center style="padding:7px 3px;"><b>SAMPLE</b></center>
							</td>

						</tr>
						<tr>

							<td colspan="2">
								<center style="padding:7px 3px;"><b>I</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>II</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>III</b></center>
							</td>

						</tr>
						<tr	>
							<td colspan="6" width="70%"	>
								<center style="padding:5px 3px;">Weight of the empty specific gravity bottle with stopper W1 (gms)</center>
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
								<center style="padding:5px 3px;">Weight of specific gravity bottle with stopper and stone powder W2 (gms)</center>
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
								<center style="padding:5px 3px;">Weight of specific gravity bottle with stopper and stone powder and distilled water W3 (gms)</center>
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
								<center style="padding:5px 3px;">Weight of specific gravity bottle with stopper and Fully filled with distilled water W4 (gms)</center>
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
								<center style="padding:5px 3px;">True Specific Gravity = W2 - W1 / [(W4 - W1)-(W3 - W2)]</center>
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
								<center style="padding:5px 3px;">Average True Specific Gravity</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_spg']; ?></center>
							</td>

						</tr>
			    </table>
			    <br> 
				<!-- footer design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>

		<!--<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
							</tr>
							<tr>
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
							</tr>
						
						</table>
					</td>
				</tr>-->

				<div class="pagebreak"></div>
				<br><br>


				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">GRANITE STONE</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">FMT-OBS-00</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date("d/m/Y",strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;"> Location Name :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
                            <tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS :1127 - 1974</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
						</table>
					</td>
				</tr>	
			<br>
		
					<? php/* }*/ ?>

					<?php
					/*  if ($row_select_pipe['chk_sp'] == 1)
				{*/
					?>

					<!--Specific Gravity Water Abrasion-->
				<table align="center" width="100%" class="test" border="1px" style="font-size:13px;">
						<tr>
							<td colspan="12" style="padding:7px 3px;"><b>&nbsp;&nbsp; Determination of Apparent Specific Gravity of Natural Builing stone (As per IS :1124 - 1974,)</b></td>
						</tr>
						<tr>
							<td colspan="6" rowspan="2" width="70%"	>
								<center><b>Observation</b></center>
							</td>
							<td colspan="6">
								<center style="padding:7px 3px;"><b>SAMPLE</b></center>
							</td>

						</tr>
						<tr>

							<td colspan="2">
								<center style="padding:7px 3px;"><b>I</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>II</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>III</b></center>
							</td>

						</tr>
						<tr>
							<td colspan="6" width="70%"	>
								<center style="padding:5px 3px;">Weight of Oven-Dry Sample (g)</center>
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
								<center style="padding:5px 3px;">Weight of Saturated Surface Dry Sample (g) B</center>
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
								<center style="padding:5px 3px;">Qunaity of Water Added in 1000 ML jar (g) C</center>
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
								<center style="padding:5px 3px;">Apparent Specific Gravity = A / (1000-C)</center>
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
								<center style="padding:5px 3px;">Average Apparent Specific Gravity</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_asg']; ?></center>
							</td>
						</tr>
				</table>
				<br>

				<?php /*}*/ ?>
				<?php
					/*  if ($row_select_pipe['chk_com'] == 1)
				{*/
					?>

				<!--Specific Gravity Water Abrasion-->
				<table align="center" width="100%" class="test" border="1px" style="font-size:13px;">
						<tr>
							<td colspan="12" style="padding:7px 3px;"><b>&nbsp;&nbsp; Determination of Compressive Strength of Natural Builing stone (As per IS :1121 (P-1) - 1974,)</b></td>
						</tr>
						<tr>
							<td colspan="6" style="padding:7px 3px;"><b>&nbsp;&nbsp; Dia. Of Specimen (b) :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['dia']; ?></td>
							<td colspan="6" style="padding:7px 3px;"><b>&nbsp;&nbsp; Height of Specimen (h) :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['height']; ?></td>
						</tr>
						<tr>
							<td colspan="7" rowspan="2" width="70%"	>
								<center><b>Observation</b></center>
							</td>
							<td colspan="5">
								<center style="padding:7px 3px;"><b>SAMPLE</b></center>
							</td>

						</tr>
						<tr>

							<td colspan="1">
								<center style="padding:7px 3px;"><b>I</b></center>
							</td>
							<td colspan="1">
								<center style="padding:7px 3px;"><b>II</b></center>
							</td>
							<td colspan="1">
								<center style="padding:7px 3px;"><b>III</b></center>
							</td>
							<td colspan="1">
								<center style="padding:7px 3px;"><b>IV</b></center>
							</td>
							<td colspan="1">
								<center style="padding:7px 3px;"><b>V</b></center>
							</td>

						</tr>
						<tr>
							<td colspan="7">
								<center style="padding:7px 3px;">Maximum load applied to the test piece before filure A (kg)</center>
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
								<center style="padding:7px 3px;">Area of bearing face of the test piece B (cm<sup>2</sup>)</center>
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
								<center style="padding:7px 3px;">(i) When ratio of height to diameter is greater then compressive strength (C<sub>p</sub>) = A/B (kg/cm<sup>2</sup>)</center>
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
								<center style="padding:7px 3px;">(ii) When ratio of height to diameter differs from unity by 25% or more compressive strength (C<sub>c</sub>) = (C<sub>p</sub>) / 0.778 + 0.222(b + h) (kg/cm<sup>2</sup>)</center>
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
								<center style="padding:7px 3px;">Average Compressive Strength (kg/cm<sup>2</sup>)</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_com1']; ?></center>
							</td>

						</tr>
				</table>
				<br>

				<?php /*} */ ?>

				<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>

		<!--<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
							</tr>
							<tr>
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
							</tr>
						
						</table>
					</td>
				</tr>-->
		</page>
		<!-- <input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: gSTCn;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT"> -->

	</body>
</html>

			<script src="jquery-1.12.3.min.js"></script>
			<script type="text/javascript">
				$("#print_button").on("click", function() {
					$('#print_button').hide();
					window.print();
				});
			</script>