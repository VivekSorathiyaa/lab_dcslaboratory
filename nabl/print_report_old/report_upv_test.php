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
	$select_tiles_query = "select * from upv WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$agreement_no = $row_select['agreement_no'];
	$cons = $row_select['condition_of_sample_receved'];
	// // $job_no= $row_select['job_no'];			
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
		$issue_date = $row_select2['issue_date'];
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
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	?>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF ULTRASONIC PULSE VELOCITY</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px;   ">&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																										$result_selectc = mysqli_query($conn, $select_queryc);

																										if (mysqli_num_rows($result_selectc) > 0) {
																											$row_selectc = mysqli_fetch_assoc($result_selectc);
																											$ct_nm = $row_selectc['city_name'];
																										}
																										echo $clientname; ?></td>
							<td style="border-left: 1px solid black;width:12%; font-weight:bold;">&nbsp; Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:18%;">&nbsp; <?php echo $agreement_no; ?></td>
						</tr>
						<tr style="">

							<td style="border-top: 1px solid black;border-left: 1px solid black;width:11%;font-weight:bold;">&nbsp;&nbsp; </td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp;</td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;width:11%; font-weight:bold;padding-bottom:5px;padding-top:5px; ">&nbsp;&nbsp; ULR No.</td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid;">&nbsp; <?php echo $report_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp; Consultant</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php echo $agency_name; ?>-</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid; ">&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp; Contractor</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php echo $row_select['pmc_name']; ?>-</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp; Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid; ">&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp; Ref No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php
																																	if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {
																																	?>Date: <?php echo date('d - m - Y', strtotime($row_select["date"]));
																																	} else {
																																	}
							?> </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp; Grade of Concrete</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid; ">&nbsp; </td>
						</tr>


					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-top:1px solid;border-right:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:15%;font-weight:bold;border-bottom:1px solid;padding-bottom:2px;padding-top:2px;  ">&nbsp; Location</td>
							<td style="border-left: 1px solid black;width:38%;text-align:left; border-bottom:1px solid;">&nbsp; <?php if ($bs_location != "") {
																																	echo $bs_location;
																																} ?><?php if ($material_location == 1) {
																																													echo "In Laboratory";
																																												} else {
																																													echo "In Field";
																																												} ?></td>
							<td style="border-left: 1px solid black;width:11%; font-weight:bold;border-bottom:1px solid;">&nbsp; Temperature</td>
							<td style="border-left: 1px solid black;width:19%;border-bottom:1px solid;">&nbsp; <?php echo $row_select_pipe['temp']; ?> °C</td>
						</tr>

					</table>
				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="left" width="63.85%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Structure Type</td>
							<td style="border-left: 1px solid black;width:38%;text-align:left; " colspan=3><?php echo $source; ?>&nbsp; Framed Structure<?php if ($material_location == 1) {
																																							echo "In Laboratory";
																																						} else {
																																							echo "In Field";
																																						} ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Test Method Adopted</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:38%;text-align:left; " colspan=3>&nbsp; IS-13311-1992 (Part-1),R.A.2019</td>
						</tr>

					</table><br>

				</td>
			</tr>




			<tr>
				<td style="text-align:center;font-weight:bold; font-size:16px;padding-top:10px;"><b><u>ULTRASONIC PULSE VELOCITY TEST RESULTS</u></b></td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:12px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;border-top:1px solid;width:5%;font-weight:bold; text-align:center; ">Sr.<br>NO.</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:17%;text-align:center;font-weight:bold; ">Chainage</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:15%; text-align:center;font-weight:bold;">Type of Transmission</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:12%;font-weight:bold;text-align:center; ">Dist. Bet.Transducers,<br>in mm</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:11%;text-align:center;font-weight:bold;">Time,in <br>µ sec</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:11%;text-align:center;font-weight:bold;">Correction<br> for<br> Velocity</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:12%;text-align:center;font-weight:bold;">Corrected<br> Velocity,<br>km/sec</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:17%;text-align:center;font-weight:bold;padding-bottom:7px;padding-top:7px;">Corrected Quality<br>(Grade) as per IS-516-Part-5 seel-AMD No.1 NOV-2019</td>
						</tr>
						<?php
						// $count=1;
						// while($row_select_pipe = mysqli_fetch_array($result_tiles_select)){
						?>
						<?php $count = 1;
						$cnt = 1;
						$select_tilesy5 = "select * from upv WHERE `lab_no`='$lab_no' AND  `job_no`='$job_no' and `is_deleted`='0'";
						$result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
						$coming_row = mysqli_num_rows($result_tiles_select15);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select15)) {
							$flag5++;
							$br++;
							$cntrw++;

						?>
							<tr style="">
								<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"><?php echo $cnt; ?></td>
								<td style="border-left: 1px solid black;width:17%;text-align:center;border-top:1px solid;padding-bottom:7px;padding-top:7px; "><?php if ($row_select_pipe['upv_detailes'] != "" && $row_select_pipe['upv_detailes'] != null && $row_select_pipe['upv_detailes'] != "0") {
																																									echo $row_select_pipe['upv_detailes'];
																																								} else {
																																									echo "-";
																																								} ?></td>
								<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;"><?php if ($row_select_pipe['trm_1'] != "" && $row_select_pipe['trm_1'] != null && $row_select_pipe['trm_1'] != "0") {
																																echo $row_select_pipe['trm_1'];
																															} else {
																																echo "-";
																															} ?></td>
								<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['dist_1'] != "" && $row_select_pipe['dist_1'] != null && $row_select_pipe['dist_1'] != "0") {
																																echo $row_select_pipe['dist_1'];
																															} else {
																																echo "-";
																															} ?></td>
								<td style="border-left: 1px solid black;width:11%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['time_1'] != "" && $row_select_pipe['time_1'] != null && $row_select_pipe['time_1'] != "0") {
																																echo $row_select_pipe['time_1'];
																															} else {
																																echo "-";
																															} ?></td>
								<td style="border-left: 1px solid black;width:11%;border-top:1px solid;text-align:center;">0.00</td>
								<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['velo_1'] != "" && $row_select_pipe['velo_1'] != null && $row_select_pipe['velo_1'] != "0") {
																																echo $row_select_pipe['velo_1'];
																															} else {
																																echo "-";
																															} ?></td>
								<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['grading_1'] != "" && $row_select_pipe['grading_1'] != null && $row_select_pipe['grading_1'] != "0") {
																																echo $row_select_pipe['grading_1'];
																															} else {
																																echo "-";
																															} ?></td>
							</tr>
						<?php
							$cnt++;
						}
						?>

					</table>

				</td>
			</tr>

			<!--tr>
				<td  style="text-align:center;font-size:11px; ">
				<br>
				</td>
		</tr>
		<tr>
				<td  style="text-align:center;font-size:11px; "><br>
				<table align="center" width="100%"  class="test" style="height:auto;font-family: Cambria; " >
						<tr>
							<td ><b>Note :-</b></td>
						</tr>
						<tr>
							<td ><b> > &nbsp;</b> Test results are issued  wilh specifïc understanding that GEC will not in any case be involved  in action  Following  the information  of the  test results.</td>
							
						</tr>
						<tr>
							<td ><b> > &nbsp;</b>  The Test reports are not supposed to be used  for  publicity.</td>
							
						</tr>
						<tr>
							<td ><b> > &nbsp;</b> Test report shall not  be reproduced  except in  full Without  written approvaI of GEC.</td>
							
						</tr>
						
				</table>
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:right;font-size:11px;padding-right:80px; "><br><br><br><br><br><br>
				<table align="right" width="80%"  class="test" style="height:auto;font-family: Cambria; " >
						<tr>
							<td style="text-align:right"><b>Approved By</b></td>
						</tr>
						<!--tr>
							<td style="text-align:right"><b>For, Goma Engineering Consultancy,</b></td>
						</tr>
						
						<tr>
							
							<td style="text-align:right"><b>Mr. Darshan Patel</b></td>
							
						</tr>
						<tr>
							
							<td style="text-align:right"><b>Authorized Signatory</b></td>
							
						</tr>
				</table>
				</td>
		</tr>
		
		
		</table-->



			<table align="center" width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
				<tr><br><br><br>

					<td style="width:40%;text-align:left;font-weight:bold;">
						Page No. 1 of 1
					</td>
					<td style="width:60%;text-align:left;font-weight:bold;">
						. . . . . . .END OF REPORT. . . . . . .
					</td>
				</tr>

			</table>
			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div>
		</table>
	</page>

</body>

</html>

<script type="text/javascript">


</script>