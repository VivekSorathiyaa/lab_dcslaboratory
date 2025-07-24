<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0;
		-webkit-transform: scale(.68, .68);
		-moz-transform: scale(.58, .58);
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 21cm;
		height: 29.7cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 12px;
		font-family: Arial;

	}

	.test {
		border-collapse: collapse;
		
		font-family: Arial;
	}

	.tdclass1 {

		font-size: 12px;
		font-family: Arial;
	}

	div.vertical-sentence {
		-ms-writing-mode: tb-rl;
		/* for IE */
		-webkit-writing-mode: vertical-rl;
		/* for Webkit */
		writing-mode: vertical-rl;

	}

	.rotate-characters-back-to-horizontal {
		-webkit-text-orientation: upright;
		/* for Webkit */
		text-orientation: upright;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from soil WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$agreement_no = $row_select['agreement_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	if ($cons == 0) {
		$con_sample = "Sealed";
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


	if ($row_select["agency_name"] != "") {
		$agency_name = $row_select['agency_name'];
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
			$mt_name = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['soil_source'];
		$soil_location = $row_select4['soil_location'];
		$material_location = $row_select4['material_location'];
	}
	$cnt = 1;

	?>


	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF SOIL</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Authority

							</td>
							<td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																										$result_selectc = mysqli_query($conn, $select_queryc);

																										if (mysqli_num_rows($result_selectc) > 0) {
																											$row_selectc = mysqli_fetch_assoc($result_selectc);
																											$ct_nm = $row_selectc['city_name'];
																										}
																										echo $clientname; ?></td>
							<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;<?php echo $agreement_no; ?></td>
						</tr>


						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;ULR No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo $_GET['ulr']; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Consultant</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo $row_select['pmc_name']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;<?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:13%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp;Client</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:38%;text-align:left; ">&nbsp;<?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:13%;font-weight:bold; ">&nbsp;Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;<?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:13%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Ref No./Ref.Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:38%;text-align:left; ">&nbsp;&nbsp;<?php echo $r_name; ?>&nbsp;<?php
																																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {
																																									?> <span style="font-weight:bold;"> Date :</span> <?php echo date('d - m - Y', strtotime($row_select["date"]));
																																									} else {
																																									}
																					?> </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:13%;font-weight:bold; ">&nbsp;Received Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:left;padding-bottom:3px;padding-top:3px;  ">&nbsp;&nbsp; Sample Description</td>
							<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; Soil</td>

						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:3px;padding-top:3px;   ">&nbsp;&nbsp; Material Source</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php echo $source; ?> ( by <?php if ($sample_sent_by == 1) {
																																											echo 'Agency';
																																										} else if ($sample_sent_by == 0) {
																																											echo 'Client';
																																										} ?> )</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:3px;padding-top:3px;   ">&nbsp;&nbsp; No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 1</td>
						</tr>
					</table><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:14px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;border-top:1px solid;width:5%;font-weight:bold; text-align:center;padding-bottom:6px;padding-top:6px;  ">Sr.NO.</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:44%;text-align:center;font-weight:bold; " colspan=2>Test</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:13%; text-align:center;font-weight:bold;">Results</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:12%;text-align:center;font-weight:bold;">Unit</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:26%;text-align:center;font-weight:bold;">Test Method Adopted</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;" rowspan=3> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:22%;text-align:center;border-top:1px solid;font-weight:bold; " rowspan=3>Grain Size Analysis</td>
							<td style="border-left: 1px solid black;width:22%; text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; ">Gravel</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['grain1']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">%</td>
							<td style="border-left: 1px solid black;width:26%;border-top:1px solid;text-align:center;" rowspan=3>IS 2720(part 4):2022</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:22%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px; "> Sand</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center;border-top:1px solid;font-weight:bold; "><?php echo $row_select_pipe['grain2']; ?></td>
							<td style="border-left: 1px solid black;width:12%; text-align:center;border-top:1px solid;">%</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:22%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px; "> Silt & Clay</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center;border-top:1px solid;font-weight:bold; "><?php echo $row_select_pipe['grain3']; ?></td>
							<td style="border-left: 1px solid black;width:12%; text-align:center;border-top:1px solid;">%</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:44%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;  " colspan=2>Specific Gravity</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['sp1']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">-</td>
							<td style="border-left: 1px solid black;width:26%;border-top:1px solid;text-align:center;">IS 2720(part 3):2022</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:44%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;  " colspan=2>Soil Classification</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['so1']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">--</td>
							<td style="border-left: 1px solid black;width:26%;border-top:1px solid;text-align:center;">IS 1498:1970</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:44%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;  " colspan=2>Maximum Dry Density</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['h1']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">gm/cc</td>
							<td style="border-left: 1px solid black;width:26%;border-top:1px solid;text-align:center;" rowspan=2>IS 2720(part 8):2020</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:44%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;  " colspan=2>Optimum Moisture Content</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['h2']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">%</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;" rowspan=3> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:22%;text-align:center;border-top:1px solid;font-weight:bold; " rowspan=3>Atterberg's Limit</td>
							<td style="border-left: 1px solid black;width:22%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; ">Liquid Limit </td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['a1']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">%</td>
							<td style="border-left: 1px solid black;width:26%;border-top:1px solid;text-align:center;" rowspan=3>IS 2720(part 5):2020</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:22%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;  ">Plastic Limit</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['a2']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">%</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:22%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;  ">Plasticity Index</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['a3']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">%</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:44%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;  " colspan=2>Free Swell Index</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['f1']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">%</td>
							<td style="border-left: 1px solid black;width:26%;border-top:1px solid;text-align:center;">IS:2720:2020(part-40)</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:22%;text-align:center;border-top:1px solid;font-weight:bold; ">California Bearing Ratio</td>
							<td style="border-left: 1px solid black;width:22%;text-align:center;border-top:1px solid; ">Unsoaked</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['cbr1']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">%</td>
							<td style="border-left: 1px solid black;width:26%;border-top:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">IS:2720:1978(part-16)<br>R.A.2011</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:22%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;font-weight:bold;  ">California Bearing Ratio</td>
							<td style="border-left: 1px solid black;width:22%;text-align:center;border-top:1px solid; ">soaked</td>
							<td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo $row_select_pipe['cbr2']; ?></td>
							<td style="border-left: 1px solid black;width:12%;border-top:1px solid;text-align:center;">%</td>
							<td style="border-left: 1px solid black;width:26%;border-top:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">IS:2720:1978(part-16)<br>R.A.2011</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">
					<br>
				</td>
			</tr>
			<tr>
				<td style="text-align:center; "><br>
					<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;font-size:14px; ">
						<tr>
							<td><b>Note :-</b></td>
						</tr>
						<tr>
							<td><b> > &nbsp;</b>Test rcsults are related to samples submitted by customers only.</td>
						</tr>
						<tr>
							<td><b> > &nbsp;</b> Test results are issued wilh specifïc understanding that GEC will not in any case be involved in action Following the information of the test results.</td>

						</tr>
						<tr>
							<td><b> > &nbsp;</b> The Test reports are not supposed to be used for publicity.</td>

						</tr>
						<tr>
							<td><b> > &nbsp;</b> Test report shall not be reproduced except in full Without written approvaI of GEC.</td>

						</tr>

					</table>
				</td>
			</tr>

			<tr>
				<td style="text-align:right;font-size:11px;padding-right:80px; "><br><br><br><br><br><br>
					<table align="right" width="80%" class="test" style="height:auto;font-family: Cambria; ">
						<tr>
							<td style="text-align:right"><b>Approved By</b></td>
						</tr>
						<tr>
							<td style="text-align:right"><b>For, Goma Engineering Consultancy,</b></td>
						</tr>

						<tr>

							<td style="text-align:right"><b>| Darshan Patel |</b></td>

						</tr>
						<tr>

							<td style="text-align:right"><b>Authorized Signatory</b></td>

						</tr>
					</table>
				</td>
			</tr>


		</table>



		<br>
		<table align="center" width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
			<tr>

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
	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>