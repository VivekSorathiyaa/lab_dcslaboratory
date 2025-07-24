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
		font-size: 12px;
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
	function round_up($number, $precision = 0)
	{
		$fig = (int) str_pad('1', $precision, '0');
		return (ceil($number * $fig) / $fig);
	}
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from mortar_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	$page_cont = round_up($no_of_rows / 7);

	$ans = mysqli_fetch_array($result_tiles_select);


	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$r_date = $row_select['date'];
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
		$cc_grade = $row_select4['cc_grade'];
		$cc_set_of_cube = $row_select4['cc_set_of_cube'];
		$cc_no_of_cube = $row_select4['cc_no_of_cube'];
		$cc_identification_mark = $row_select4['cc_identification_mark'];
		$day_remark = $row_select4['day_remark'];
		$casting_date = $row_select4['casting_date'];
		$material_location = $row_select4['material_location'];
	}

	$flag = 0;
	$a = 1;
	$down = 0;
	$up = 7;
	/*for($a=1;$a<=$page_cont;$a++)		{
*/
	?>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-top:80px;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Compressive Strength of Mortar Cubes</b></td>
			</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;"> <?php echo "ULR No.  " . $_GET['ulr']; ?> </td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:0%;padding-bottom: 4px;;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align:center;"> &raquo;</td>
						<td style="width:40%padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $report_no; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;padding-top: 14px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top: 14px;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;padding-top: 14px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
							<td style="width:12%;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>


						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:4px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom:4px;"><?php echo $r_name; ?></td>
							</tr>

						<?php
						}
						if ($row_select['pmc_name'] != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:14px;"><?php echo $row_select['pmc_heading']; ?></td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom:14px;"><?php echo $row_select['pmc_name']; ?>
								</td>
							</tr>

							
						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $letter_no;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Date of Sample Received</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Location</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $material_location;?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Method of Test</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">(IS 516 (P-1/S-1): 2021 Clause 3.0) , (IS 9013-1978)</td>
							<td style="width:21%;text-align:right;padding-bottom: 4px;"></td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>
						
						<tr>
						    <td style="width:12%;">Specimen Size</td>
							<td style="width:6%;text-align: center;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;"></td>
							<td style="width:21%;text-align:right;"></td>
							<td style="width:6%;text-align: center;"></td>
							<td style="width:40%;"></td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr style="">
                <td>
                    <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                        <tr>
                        	<td style="font-size:13px;font-weight:bold;text-align:left;padding:15px 0 5px;font-family:Cambria;">1. Compressive strength of Mortar cubes</td>
                        </tr>
                    </table>
                </td>
            </tr>

			<?php $cnt = 1; ?>
			<tr>
			    <td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:0px solid;border-right:0px solid;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"> Sr.<br>No.</td>
							<td style="width:10%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Identificetion Mark </td>
							<td style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Grede Mix *</td>
							<td style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Date Of Casting *</td>
							<td style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Date Of Testing</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Compressive Strength (N / mm<sup>2</sup>)</td>
							<td style="border-right:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Days</td>
						</tr>

						<?php
						$select_tilesy = "select * from mortar_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;
						?>

							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">cube - 1</td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo $row_select_pipe['grade1']; ?></td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_1']; ?></td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;border-right: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['day1']; ?></td>
							</tr>


							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">cube-2</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_2']; ?></td>
							</tr>


							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">cube-3</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_3']; ?></td>
							</tr>


							<tr style="">
								<td style="border-bottom:1px solid black;border-left: 1px solid black;border-top: 1px solid black;text-align:right;padding:5px 4px;font-weight:bold;" colspan=5>Average</td>
								<td style="border-bottom:1px solid black;border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['avg_com_s_1']; ?></td>
								<td style="border-right:1px solid;border-bottom:1px solid black;border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"></td>
							</tr>
							<tr style="">
								<td><br></td>
							</tr>
							<tr style="">
								<td><br></td>
							</tr>
							
						<?php
							if ($flag == 7) {
								break;
							}
						}
						?>
							<tr>
								<td style="font-size:10px;text-align:left;padding-top:4px;" colspan=13>&raquo; &nbsp; <span style="font-weight:bold;font-size:11px;">Remark</span> :- The Average of Three Sample Values Shall be taken as the Representative of the Batch provided the individual variation is not more than &plusmn; 15% of the Average. Otherwise repeat tests shall be made per IS 516-Clause-5.6</td>
						    </tr>
							<tr>
								<td colspan=13><br></td>
						    </tr>
							
					</table>
				</td>
				<!-- <td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

						<tr style="">
							<td style="border-left: 1px solid black;width:4%;font-weight:bold;text-align:center; "> Sr.<br>No.</td>
							<td style="border-left: 1px solid black;width:8%;text-align:center;font-weight:bold; ">Lab ID Mark</td>
							<td style="border-left: 1px solid black;width:8.88%; font-weight:bold;text-align:center;">Date Of Casting (By Client)</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">Date Of Testing</td>
							<td style="border-left: 1px solid black;width:8%;font-weight:bold;text-align:center; ">Age Of Concrete</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center; " colspan="3">Cube Size(mm)</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">Area <br>(mm <sup>2</sup>)</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">Axial Load At failure</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">Compressive Strength</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;">Average of Compressive Strength</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center;">Weight(kg)</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center;border-right: 1px solid; ">Failure Pattern</td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;font-weight:bold;text-align:center; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center;font-weight:bold; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;"></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px; ">Days</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">L</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">B</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">H</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">L x B</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">Kn</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;"></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center;border-right: 1px solid; "></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:1px;padding-top:1px;  ">1</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">2</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;">3</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; ">4</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">5</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; " colspan=3>6</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; ">7</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; ">8</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; ">9</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; ">8.88</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; ">11</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;border-right: 1px solid; ">12</td>
						</tr>

						<?php
						$select_tilesy = "select * from mortar_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;


						?>


							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">1-07</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php echo $row_select_pipe['day1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['l1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['b1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['h1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['cross_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['load_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['comp_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; " rowspan=3><?php echo $row_select_pipe['avg_com_s_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;"><?php echo $row_select_pipe['mass_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;border-right: 1px solid; ">satisfactory</td>
							</tr>

							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">1-08</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php echo $row_select_pipe['day1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['l2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['b2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['h2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['cross_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['load_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['comp_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;"><?php echo $row_select_pipe['mass_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;border-right: 1px solid; ">satisfactory</td>
							</tr>
							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">1-09</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php echo $row_select_pipe['day1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['l3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['b3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['h3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['cross_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['load_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['comp_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;"><?php echo $row_select_pipe['mass_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;border-right: 1px solid; ">satisfactory</td>

							</tr>




						<?php
							if ($flag == 7) {
								break;
							}
						}

						?>
					</table><br>
				</td> -->
			</tr>

			<!--<tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:10px;text-align:left;font-weight:bold;padding:20px 0 5px;font-family:Cambria;"> Requirement as per IS 456 : 2000 Table No.2 (Clause 6.1 , 9.2.2, 15.1.1 , and 36.1)</td>
                            </tr>
                        </table>
                    </td>
            </tr>-->
            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family: Cambria;font-size:10px;">             
           
										<tr>
											<td style="font-size:11px;text-align:left;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Grade of Concrete</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>M10</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>M15</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M20</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M25</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M30</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M35</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M40</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M45</b></td>
										</tr>
										
										<tr>
												<td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">Accepted Strength on 28 days of curing for Nominal Mix, N/mm<sup>2</sup></td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">10</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">15</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">20</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">25</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">30</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">35</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">40</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">45</td>
										</tr>
								</table>

							</td>
            </tr>
		</table>

		<!--<table width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
                <td>
                    <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                        <tr>
                        	<td style="font-size:10px;text-align:left;padding:30px 0 0px;font-family:Cambria;">2. Compressive strength of Accelerated concrete cubes</td>
                        </tr>
                    </table>
                </td>
            </tr>

			<tr>
                <td>
                    <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                        <tr>
                        	<td style="font-size:10px;text-align:left;padding:5px 0 5px;font-family:Cambria;">A) Concrete Cube Test Results...</td>
                        </tr>
                    </table>
                </td>
            </tr>
		<?php $cnt = 1; ?>
			<tr>
			    <td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:0px solid;border-right:0px solid;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"> Sr.<br>No.</td>
							<td style="width:10%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sample ID</td>
							<td style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Date Of Casting *</td>
							<td style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Date Of Testing</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Age Of Test</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Grade of Concrete *</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Weight of Spec. (kg)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Max. Load at Failure (KN)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Compressive Strength R<sub>a</sub> (N/mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Estimated Compressive Strength R<sub>28</sub> (N/mm<sup>2</sup>)</td>
							<td style="border-right:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sample Density (Kg/m<sup>2</sup>)</td>
						</tr>

						<?php
						$select_tilesy = "select * from mortar_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;
						?>

							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Sample-1</td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Accelerated Curing as per IS 9013-1978</td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cc_grade; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['mass_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['load_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_1']; ?></td>
								<td style="border-right:1px solid;border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"></td>
								<td style="border-right:1px solid;border-top: 1px solid black;text-align:center;padding:5px 4px;"></td>
							</tr>


							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Sample-2</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['mass_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['load_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_2']; ?></td>
								<td style="border-right:1px solid;border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"></td>
								<td style="border-right:1px solid;border-top: 1px solid black;text-align:center;padding:5px 4px;"></td>
							</tr>


							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Sample-3</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['mass_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['load_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_3']; ?></td>
								<td style="border-right:1px solid;border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"></td>
								<td style="border-right:1px solid;border-top: 1px solid black;text-align:center;padding:5px 4px;"></td>
							</tr>


							<tr style="">
								<td style="border-bottom:1px solid black;border-left: 1px solid black;border-top: 1px solid black;text-align:right;padding:5px 4px;font-weight:bold;" colspan=8>Average</td>
								<td style="border-bottom:1px solid black;border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['avg_com_s_1']; ?></td>
								<td style="border-bottom:1px solid black;border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"></td>
								<td style="border-right:1px solid;border-bottom:1px solid black;border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"></td>
							</tr>

							<tr>
								<td style="font-size:10px;text-align:left;padding-top:15px;font-weight:bold;" colspan=11>* Compressive Strength R28 is to be evaluted as per IS 9013-1978 Fig-2 Regression Equation</td>
						    </tr>

						<?php
							if ($flag == 7) {
								break;
							}
						}
						?>
					</table>
				</td>
			</tr>
		</table>-->

		<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
				<tr>
					<td style="width:60%;text-align:center;font-weight:bold;padding:15px 0px 5px;">
							** End of Report ** 
					</td>																		
				</tr>
		</table>

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
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
							</tr>

							<tr>
							<td style="text-align:left;font-style:italic;font-size:11px;font-weight:bold;padding:3px 0;">Witness By : </td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>Director/TM</b></td>
							</tr>
						</table>
					</td>
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
	<?php

	/*if($flag==8)
				{
					$flag=0;
					$down=$up;
					$up +=8;*/
	?>



	<!--<div class="pagebreak"> </div>-->
	<?php /*}
			
			
			}*/

	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">


</script>