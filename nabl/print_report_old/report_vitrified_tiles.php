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
	$select_tiles_query = "select * from `vit_tiles` WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$rec_sample_date = $row_select['sample_rec_date'];
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
		$np_dia = $row_select4['np_dia'];
		//$pvc_kg= $row_select4['pvc_kg'];

	}
	?>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b> Physical Properties of Vitrified Tiles</b></td>
			</tr>


			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding-bottom:6px;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;text-align:left;">
						<?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR No.  " . $row_select_pipe['ulr'];  
															} ?>
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
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $letter_no;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Brand Name</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $cement_brand;?> </td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $date_of_latter;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">Vitified Tiles</td>
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
							<td style="width:40%;padding-bottom: 4px;"><?php echo  "(" . $row_select_pipe['size1'] . " X " . $row_select_pipe['size2'] . " X " . $row_select_pipe['size3'] . ") mm"; ?></td>
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
							<td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp; <?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																																				echo "<b>ULR:</b> " . $row_select_pipe['ulr'];
																																			} ?></td>
						</tr>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Agency</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?><?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
																																									$result_selectc1 = mysqli_query($conn, $select_queryc1);

																																									if (mysqli_num_rows($result_selectc1) > 0) {
																																										$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																																										$ct_nm1 = $row_selectc1['city_name'];
																																									}
																																									echo $agency_name . " " . $ct_nm1; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Agreement No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $agreement_no; ?><?php echo $r_name . " Date:" . date('d - m - Y', strtotime($row_select2["letter_date"])); ?></td>
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
							<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select_pipe['color'] . " Vitrified Tile (" . $row_select_pipe['size1'] . "X" . $row_select_pipe['size2'] . "X" . $row_select_pipe['size3'] . ") mm"; ?></td>

						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  "> Brand</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp;Somani Tiles</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 10</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">Test Method Adopted</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IS-13630-1983</td>
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
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2><b>Dimesion</b></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px; "></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">a</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in Length (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avglen'] != "" && $row_select_pipe['avglen'] != null && $row_select_pipe['avglen'] != "0") {
																																					echo $row_select_pipe['avglen'];
																																				} else {
																																					echo "-";
																																				} ?></td>
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">600 &plusmn; 6 mm</td> -->
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; " rowspan=3>IS 13630 <br>Part:1 to Part:15</td> -->
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan=2>Max &plusmn; 0.1 %</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan=3>IS 13630 Part-1</td>
						</tr>
						


						<tr>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">b</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in Thickness (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avgthk'] != "" && $row_select_pipe['avgthk'] != null && $row_select_pipe['avgthk'] != "0") {
																																						echo $row_select_pipe['avgthk'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">8 &plusmn; 0.4 mm</td> -->
						</tr>


						<tr>
						<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">c</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in Width (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avgwid'] != "" && $row_select_pipe['avgwid'] != null && $row_select_pipe['avgwid'] != "0") {
																																						echo $row_select_pipe['avgwid'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">600 &plusmn; 6 mm</td> -->
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Max &plusmn; 5 %</td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in  straightness of sides (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $row_select_pipe['avgstr'] ?></td>
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Min, lOOO N</td> -->
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Max &plusmn; 0.1%</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">IS 13630 Part-1</td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2> Deviation in Rectangularity (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $row_select_pipe['avgrec'] ?></td>
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Min, lOOO N</td> -->
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Max &plusmn; 0.1%</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">IS 13630 Part-1</td>
						</tr>



						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2><b>Modulus of Rupture (N/mm<sup>2</sup>)</b></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan=3>IS 13630 Part-6</td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>individual (N/mm<sup>2</sup>)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            <table style="width:100%;border-collapse: collapse;">
							  			    <tr>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) { echo $row_select_pipe['mod1'];} else { echo "--";}?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) { echo $row_select_pipe['mod2'];} else { echo "--";}?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) { echo $row_select_pipe['mod3'];} else { echo "--";}?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) { echo $row_select_pipe['mod4'];} else { echo "--";}?></td>
												<td style="font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) { echo $row_select_pipe['mod5'];} else { echo "--";}?></td>
											</tr>
										</table>	
							</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> individual 32 N/mm<sup>2</sup>  (Min)</td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;font-weight:bold;" colspan=2>Average (N/mm<sup>2</sup>)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;font-weight:bold;"><?php if ($row_select_pipe['size3'] > 7.5) { echo ($row_select_pipe['mod1'] + $row_select_pipe['mod2'] + $row_select_pipe['mod3'] + $row_select_pipe['mod4'] + $row_select_pipe['mod5']) / 5;} else { echo "--";}?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Average 32 N/mm<sup>2</sup>  (Min)</td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px; " colspan=2><b>Water Absorption (%)</b></td>
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
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['wtr1'] != "" && $row_select_pipe['wtr1'] != null && $row_select_pipe['wtr1'] != "0") { echo $row_select_pipe['wtr1'];} else {echo "-";} ?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['wtr2'] != "" && $row_select_pipe['wtr2'] != null && $row_select_pipe['wtr2'] != "0") { echo $row_select_pipe['wtr2'];} else {echo "-";} ?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['wtr3'] != "" && $row_select_pipe['wtr3'] != null && $row_select_pipe['wtr3'] != "0") { echo $row_select_pipe['wtr3'];} else {echo "-";} ?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['wtr4'] != "" && $row_select_pipe['wtr4'] != null && $row_select_pipe['wtr4'] != "0") { echo $row_select_pipe['wtr4'];} else {echo "-";} ?></td>
												<td style="font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['wtr5'] != "" && $row_select_pipe['wtr5'] != null && $row_select_pipe['wtr5'] != "0") { echo $row_select_pipe['wtr5'];} else {echo "-";} ?></td>
											</tr>
										</table>		
										</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> individual Max 0.1% </td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;font-weight:bold;" colspan=2>Average (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;font-weight:bold;"><?php if ($row_select_pipe['avgwtr'] != "" && $row_select_pipe['avgwtr'] != null && $row_select_pipe['avgwtr'] != "0") { echo $row_select_pipe['avgwtr'];} else {echo "-";} ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Average &le; 0.08%</td>
						</tr>



						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;font-weight:bold;" colspan=2>Breaking Strength (N)</td>
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
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) {echo $row_select_pipe['brk1'];} else {echo "--";} ?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) {echo $row_select_pipe['brk2'];} else {echo "--";} ?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) {echo $row_select_pipe['brk3'];} else {echo "--";} ?></td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) {echo $row_select_pipe['brk4'];} else {echo "--";} ?></td>
												<td style="font-size:10px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['size3'] > 7.5) {echo $row_select_pipe['brk5'];} else {echo "--";} ?></td>
											</tr>
										</table>																												</td>
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Min, lOOO N</td> -->
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
						</tr> 
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;font-weight:bold;" colspan=2>Average (N)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;font-weight:bold;"><?php if ($row_select_pipe['size3'] > 7.5) {echo ($row_select_pipe['brk1'] + $row_select_pipe['brk2'] + $row_select_pipe['brk3'] + $row_select_pipe['brk4'] + $row_select_pipe['brk5']) / 5;} else {echo "--";} ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> > 700 N for Thickness < 7.5 mm</td>
						</tr>
						<tr style="">
						</tr>



						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Resistance to Surface Abration</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px; ">II</td>
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



			<tr style="font-size:11px;font-family: Cambria;">
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
			<table align="center" width="100%" class="test">
						<tr>
							<td style="text-align:center;font-size:10px;">
								<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
									<tr>
										<td><b>Note :-</b></td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;width:50%;padding:3px 0;"> 1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
										<td style="text-align:center;width:15%;font-style:italic;font-size:11px;"><b>Reviewed & Authorized By</b></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;"> 2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
										<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
										<td style="text-align:center;font-style:italic;font-size:11px;"><b>Director/TM</b></td>
									</tr>
								</table>
							</td>
						</tr>
			</table>
		</tr>
		</table>



		<table width="100%" align="center" style="font-family:Cambria;font-size:10px;">
						<tr>
							<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
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