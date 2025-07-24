<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 40px;
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
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b> Physical Properties of Ceramic Tiles</b></td>
			</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding-bottom:6px;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;text-align:left;">
						<?php echo "ULR No.  " . $_GET['ulr']; ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:0%;padding-bottom: 4px;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"> <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;">Report Ref No</td>
						<td style="width:6%;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;"><?php echo $r_name; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-collapse: inherit;padding-top:14px;padding-bottom:14px;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;font-size: 11px;padding-bottom: 4px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
								<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																					$result_selectc = mysqli_query($conn, $select_queryc);

																					if (mysqli_num_rows($result_selectc) > 0) {
																						$row_selectc = mysqli_fetch_assoc($result_selectc);
																						$ct_nm = $row_selectc['city_name'];
																					}
																					echo $clientname; ?>
								</td>
							</tr>
					
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
							<td style="width:12%;font-size: 11px;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;font-size: 11px;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;font-size: 11px;">Agg No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;font-size: 11px;text-align:left;"> <?php echo $agreement_no; ?></td>
							</tr>
						
						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-collapse: inherit;padding:4px 0;margin-bottom:6px;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Brand Name</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $cement_brand;?> </td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">Ceramic Tiles</td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;"></td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;text-align:right;padding-bottom: 4px;">Size of Sample (mm)</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;">
							<?php if ($row_select_pipe['avgthk'] != "" && $row_select_pipe['avgthk'] != null && $row_select_pipe['avgthk'] != "0") {
																																					echo "(" . $row_select_pipe['size1'] . " X " . $row_select_pipe['size2'] . " X " . 			$row_select_pipe['size3'] . ") mm";
																																				} else {
																																					echo "*";
																																				} ?>																													
						</tr>


						<tr>
						    <td style="width:12%;"></td>
							<td style="width:6%;text-align: center;"> </td>
							<td style="width:40%;font-size: 10px;text-align:left;"></td>
							<td style="width:21%;text-align:right;"> Thickness (mm)</td>
							<td style="width:6%;text-align: center;p"> &raquo;</td>
							<td style="width:40%;"><?php if ($row_select_pipe['avgthk'] != "" && $row_select_pipe['avgthk'] != null && $row_select_pipe['avgthk'] != "0") {
																																					echo $row_select_pipe['avgthk'];
																																				} else {
																																					echo "*";
																																				} ?>	
						</tr>
						
					</table>
				</td>
			</tr>


			<!-- <tr>
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
			</tr> -->

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:8px;">
						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sr No.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" colspan=2>Name of Test</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;width:27%;">Test Results</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"> Acceptance Criteria As per IS <br> 15622-2017 (B-I a)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Test Method</td>
						</tr>
						
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Dimesion</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px; "></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">a</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in Length (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avg_1'] != "" && $row_select_pipe['avg_1'] != null && $row_select_pipe['avg_1'] != "0") {
																																					echo $row_select_pipe['avg_1'];
																																				} else {
																																					echo "-";
																																				} ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan=2>Max &plusmn; 0.1 %</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan=3>IS 13630 Part-1</td>
						</tr>
						


						<tr>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">b</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in Thickness (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avg_3'] != "" && $row_select_pipe['avg_3'] != null && $row_select_pipe['avg_3'] != "0") {
																																						echo $row_select_pipe['avg_3'];
																																					} else {
																																						echo "-";
																																					} ?></td>
						</tr>


						<tr>
						<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">c</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in Width (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avg_2'] != "" && $row_select_pipe['avg_2'] != null && $row_select_pipe['avg_2'] != "0") {
																																						echo $row_select_pipe['avg_2'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Max &plusmn; 5 %</td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in  straightness of sides (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $row_select_pipe['avgstr']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Max &plusmn; 0.1%</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">IS 13630 Part-1</td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2> Deviation in Rectangularity (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $row_select_pipe['avgrec']; ?></td>
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Min, lOOO N</td> -->
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Max &plusmn; 0.1%</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">IS 13630 Part-1</td>
						</tr>



						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Modulus of Rupture (N/mm<sup>2</sup>)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $row_select_pipe['avg_rstr']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan=3>IS 13630 Part-6</td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>individual (N/mm<sup>2</sup>)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            <table style="width:100%;border-collapse: collapse;">
							  			    <tr>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['avg_rstr'] != "" && $row_select_pipe['avg_rstr'] != null && $row_select_pipe['avg_rstr'] != "0") {
																																						echo $row_select_pipe['avg_rstr'];
																																					} else {
																																						echo "-";
																																					} ?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
												<td style="font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
											</tr>
										</table>	
							</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> individual 27 N/mm<sup>2</sup>  (Min)</td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Average (N/mm<sup>2</sup>)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Average 30 N/mm<sup>2</sup>  (Min)</td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px; " colspan=2>Water Absorption (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan="3">IS 13630 Part-2</td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>individual (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							<table style="width:100%;border-collapse: collapse;">
										    <tr>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0") {
																																						echo $row_select_pipe['avg_wtr'];
																																					} else {
																																						echo "-";
																																					} ?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
												<td style="font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
											</tr>
										</table>		
										</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> individual 3.3% (Max)</td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Average (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Average 0.08% to &le; 3%</td>
						</tr>



						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Breaking Strength (N)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan="4">IS 13630 Part-6</td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>individual (N)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            <table style="width:100%;border-collapse: collapse;">
										    <tr>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) {																							echo $row_select_pipe['avgbrk'];
																																											} else {
																																												echo "--";
																																											} ?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
												<td style="font-size:10px;text-align:center;padding:4px 4px;width:20%;"></td>
											</tr>
										</table>																												</td>
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Min, lOOO N</td> -->
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
						</tr> 
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2 rowspan=2>Average (N)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> > 700 N for Thickness < 7.5 mm</td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> > 1100 N for Thickness &ge; 7.5 mm</td>
						</tr>



						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Resistance to Surface Abration</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px; ">I</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Class II,Min.</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Scretch Hardness of Surface</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avghrd'] != "" && $row_select_pipe['avghrd'] != null && $row_select_pipe['avghrd'] != "0") {
																																						echo $row_select_pipe['avghrd'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Min.5 Mohs</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Mohs</td>
						</tr>
					</table>
				</td>
			</tr>


			<!-- <tr>
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
			</tr> -->


			<tr>
			    <td style="text-align:center;font-size:11px; ">
					<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
							<tr>
								<td style="width:60%;text-align:center;font-weight:bold;padding:3px 0;">
										** End of Report ** 
								</td>																		
							</tr>
					</table>
				</td>																	
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px;">
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