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
	$select_tiles_query = "select * from ceramic_tiles WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	// $job_no= $row_select['job_no'];			
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
	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$material_location = $row_select4['material_location'];
	}
	?>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<br>
		<br>
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT FOR CERAMIC TILES</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
										$result_selectc = mysqli_query($conn, $select_queryc);

										if (mysqli_num_rows($result_selectc) > 0) {
										$row_selectc = mysqli_fetch_assoc($result_selectc);
										$ct_nm = $row_selectc['city_name'];
										}
									echo $clientname; ?></td>
							<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
						</tr>
						<tr style="">

							<td style="border-top: 1px solid black;border-left: 1px solid black;width:11%;font-weight:bold;">&nbsp; </td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;</td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;width:11%; font-weight:bold; ">&nbsp; ULR No.</td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Agency</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Agreement No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>


			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:center;padding-bottom:2px;padding-top:2px; ">Material Under Testing</td>
							<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; Ceramic Tiles ( 300 * 300 mm )</td>

						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  "> Brand</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; RAK Tiles</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 10</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">Test Method Adopted</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IS - 13630 - 1983</td>
						</tr>

					</table><br>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:10%;font-weight:bold; text-align:center;padding-bottom:1px;padding-top:1px;  ">Sr.No.</td>
							<td style="border-left: 1px solid black;width:24%;text-align:center;font-weight:bold; " colspan=2>Test Description</td>
							<td style="border-left: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">Unit</td>
							<td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Test Results</td>
							<td style="border-left: 1px solid black;width:13.5%;text-align:center;font-weight:bold;padding-bottom:10px;padding-top:10px; ">Test Requirements <br>IS-13801-1993</td>
							<td style="border-left: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">Test Method</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;" rowspan=2><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; " rowspan=2>Dimesion</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; padding-bottom:6px;padding-top:6px; ">Length</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; " rowspan=2>mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_1'] != "" && $row_select_pipe['avg_1'] != null && $row_select_pipe['avg_1'] != "0") {
																																					echo $row_select_pipe['avg_1'];
																																				} else {
																																					echo "-";
																																				} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">300 &plusmn; 1</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; " rowspan=5>IS 13630 Part:1 to Part:15</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; padding-bottom:6px;padding-top:6px; ">Width</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_2'] != "" && $row_select_pipe['avg_2'] != null && $row_select_pipe['avg_2'] != "0") {
																																						echo $row_select_pipe['avg_2'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">300 &plusmn; 1</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; " colspan=2>Water Absorption</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; padding-bottom:6px;padding-top:6px; ">%</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0") {
																																						echo $row_select_pipe['avg_wtr'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">301.0</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; " colspan=2>Modulus of Rupture</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; padding-bottom:6px;padding-top:6px; ">N/mm&sup2;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_rstr'] != "" && $row_select_pipe['avg_rstr'] != null && $row_select_pipe['avg_rstr'] != "0") {
																																						echo $row_select_pipe['avg_rstr'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">-</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; " colspan=2>Resistance to Surface Abration</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; padding-bottom:6px;padding-top:6px; ">Class</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">I</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Class I,Min.</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="width:60%;text-align:center;font-weight:bold;"><br>
						** End of Report ** 
			     </td>																		
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px;"><br>
					<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
						<tr>
							<td><b>Note :-</b></td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;width:50%;padding:3px 0;">1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
							<td style="text-align:center;width:15%;font-style:italic;"><b>Reviewed & Authorized By</b></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;">2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
							<td style="text-align:center;font-style:italic;"><b>(D.H.Shah/M.D.Shah)</b></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
							<td style="text-align:center;font-style:italic;"><b>Director/TM</b></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<table width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
			<tr>
				<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;">
					Doc ID : FMT-TST-28/ Page 1/1
				</td>
			</tr>
		</table>

		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">

		</div>
	</page>

</body>
</html>


<script type="text/javascript">
</script>