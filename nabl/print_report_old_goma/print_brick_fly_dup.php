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
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from span_brick_fly WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$mark = $row_select4['brick_mark'];
		$brick_specification = $row_select4['brick_specification'];
		$brick_size = $row_select4['brick_size'];
		$material_location = $row_select4['material_location'];

		if ($brick_size == "190 X 90 X 90") {
			$b_l = 3800;
			$b_w = 1800;
			$b_h = 1800;
		} else if ($brick_size == "190 X 90 X 40") {
			$b_l = 3800;
			$b_w = 1800;
			$b_h = 800;
		} else if ($brick_size == "230 X 110 X 70") {
			$b_l = 4600;
			$b_w = 2200;
			$b_h = 1400;
		} else if ($brick_size == "230 X 110 X 30") {
			$b_l = 4600;
			$b_w = 2200;
			$b_h = 600;
		} else if ($brick_size == "NS 225 X 100 X 75") {
			$b_l = "L";
			$b_w = "W";
			$b_h = "H";
		} else if ($brick_size == "Other") {
			$b_l = "L X 20";
			$b_w = "W X 20";
			$b_h = "H X 20";
		} else {
			$b_l = "L X 20";
			$b_w = "W X 20";
			$b_h = "H X 20";
		}
	}


	?>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF BRICKS</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">
						<?php
						if ($clientname != "") {
						?>
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
						<?php }
						?>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; ULR No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name of EPC</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; PMC</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select['pmc_name']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>



						<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Receive Date</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
			</tr>


		</table>

		</td>
		</tr>

		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-right:1px solid;border-left:1px solid;">
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="text-align:center;font-size:11px; ">

				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

					<tr style="">
						<td style="border-left: 1px solid black;width:4%;font-weight:bold; text-align:center; "> 1</td>
						<td style="border-left: 1px solid black;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;font-weight:bold; ">Bricks Description</td>
						<td style="border-left: 1px solid black;width:28%; text-align:center;"><?php echo $mt_name; ?></td>
						<td style="border-left: 1px solid black;width:4%;font-weight:bold;text-align:center; ">4</td>
						<td style="border-left: 1px solid black;width:18%;text-align:center;font-weight:bold;">Sample No.</td>
						<td style="border-left: 1px solid black;width:28%;border-right: 1px solid;text-align:center;">25 NOS</td>
					</tr>

					<tr style="">

						<td style="border-left: 1px solid black;width:4%;font-weight:bold; text-align:center; border-top:1px solid;"> 2</td>
						<td style="border-left: 1px solid black;width:18%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;font-weight:bold; ">Frog ID</td>
						<td style="border-left: 1px solid black;width:28%; text-align:center;border-top:1px solid;">--</td>
						<td style="border-left: 1px solid black;width:4%;font-weight:bold;text-align:center; border-top:1px solid;">5</td>
						<td style="border-left: 1px solid black;width:18%;border-top:1px solid;text-align:center;font-weight:bold;">Testing Starting Date</td>
						<td style="border-left: 1px solid black;width:28%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
					</tr>
					<tr style="">

						<td style="border-left: 1px solid black;width:4%;font-weight:bold; text-align:center; border-top:1px solid;"> 3</td>
						<td style="border-left: 1px solid black;width:18%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;font-weight:bold; ">Sample Recevied</td>
						<td style="border-left: 1px solid black;width:28%; text-align:center;border-top:1px solid;"><?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						<td style="border-left: 1px solid black;width:4%;font-weight:bold;text-align:center; border-top:1px solid;">6</td>
						<td style="border-left: 1px solid black;width:18%;border-top:1px solid;text-align:center;font-weight:bold;">Completion Date</td>
						<td style="border-left: 1px solid black;width:28%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
					</tr>


				</table>

			</td>
		</tr>
		<tr>
			<td style="text-align:center;font-size:11px; ">
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:18px;font-family: Cambria;">
					<TR>
						<td style="text-align:center;font-weight:bold;">DIMENSION TEST</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="text-align:center;font-size:11px; ">

				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

					<tr style="">

						<td style="border-left: 1px solid black;width:25%;font-weight:bold; text-align:center; " rowspan=2>Size of Bricks</td>
						<td style="border-left: 1px solid black;width:20%;text-align:center;font-weight:bold; " rowspan=2>Result(mm)</td>
						<td style="border-left: 1px solid black;width:55%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;" colspan=2>Requirement as per IS 1077-1992 RA 2021</td>

					</tr>

					<tr style="">

						<td style="border-left: 1px solid black;width:27.5%;font-weight:bold; text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;">Modular</td>
						<td style="border-left: 1px solid black;width:27.5%;text-align:center;border-top:1px solid;font-weight:bold; ">Non-Modular</td>
					</tr>
					<tr style="">

						<td style="border-left: 1px solid black;width:25%; text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;"> Length</td>
						<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid; "><?php echo $row_select_pipe['avg_length']; ?></td>
						<td style="border-left: 1px solid black;width:27.5%; text-align:center;border-top:1px solid;">3800 &plusmn; 80 mm</td>
						<td style="border-left: 1px solid black;width:27.5%;text-align:center; border-top:1px solid;">4600 &plusmn; 80 mm</td>
					</tr>
					<tr style="">

						<td style="border-left: 1px solid black;width:25%; text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;"> Width</td>
						<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid; "><?php echo $row_select_pipe['avg_width']; ?></td>
						<td style="border-left: 1px solid black;width:27.5%; text-align:center;border-top:1px solid;">1800 &plusmn; 40 mm</td>
						<td style="border-left: 1px solid black;width:27.5%;text-align:center; border-top:1px solid;">2200 &plusmn; 40 mm</td>
					</tr>
					<tr style="">

						<td style="border-left: 1px solid black;width:25%; text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;"> Height</td>
						<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid; "><?php echo $row_select_pipe['avg_height']; ?></td>
						<td style="border-left: 1px solid black;width:27.5%; text-align:center;border-top:1px solid;">1800 &plusmn; 40 mm / 800 &plusmn; 40 mm</td>
						<td style="border-left: 1px solid black;width:27.5%;text-align:center; border-top:1px solid;">1400 &plusmn; 40 mm / 600 &plusmn; 40 mm</td>
					</tr>


				</table>

			</td>
		</tr>





		<?php $cnt = 1; ?>
		<?php $cnts = 1; ?>
		<tr>
			<td style="text-align:center;font-size:11px; ">
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

					<tr style="">
						<td style="border-left: 1px solid black;width:10%;font-weight:bold;text-align:center; "> Sr.No</td>
						<td style="border-left: 1px solid black;width:12%;text-align:center;font-weight:bold; ">Lab Sample No.</td>
						<td style="border-left: 1px solid black;width:12%; font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px;">Compressive Strength <br>N/mm<sup>2</sup></td>
						<td style="border-left: 1px solid black;width:12%;font-weight:bold;text-align:center; ">Lab Sample No.</td>
						<td style="border-left: 1px solid black;width:18%;font-weight:bold;text-align:center; ">Water Absorption(%)</td>
						<td style="border-left: 1px solid black;width:12%;font-weight:bold;text-align:center; ">Lab Sample No.</td>
						<td style="border-left: 1px solid black;width:16%;font-weight:bold;text-align:center; ">Efflorescence</td>
					</tr>

					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;padding-bottom:5px;padding-top:5px;font-weight:bold; "><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">CS-01</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;"><?php echo $row_select_pipe['com_1']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">WA-01</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['wtr_1']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">EF-01</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] != "") {
																																echo $row_select_pipe['rbt_efflo1'];
																															} else {
																																echo "-";
																															} ?></td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;padding-bottom:5px;padding-top:5px;font-weight:bold; "><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">CS-02</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;"><?php echo $row_select_pipe['com_2']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">WA-02</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['wtr_2']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">EF-02</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] != "") {
																																echo $row_select_pipe['rbt_efflo1'];
																															} else {
																																echo "-";
																															} ?></td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;padding-bottom:5px;padding-top:5px;font-weight:bold; "><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">CS-03</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;"><?php echo $row_select_pipe['com_3']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">WA-03</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['wtr_3']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">EF-03</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] != "") {
																																echo $row_select_pipe['rbt_efflo1'];
																															} else {
																																echo "-";
																															} ?></td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;padding-bottom:5px;padding-top:5px;font-weight:bold; "><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">CS-04</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;"><?php echo $row_select_pipe['com_4']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">WA-04</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['wtr_4']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">EF-04</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] != "") {
																																echo $row_select_pipe['rbt_efflo1'];
																															} else {
																																echo "-";
																															} ?></td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;padding-bottom:5px;padding-top:5px;font-weight:bold; "><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">CS-05</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;"><?php echo $row_select_pipe['com_5']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">WA-05</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['wtr_5']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">EF-05</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] != "") {
																																echo $row_select_pipe['rbt_efflo1'];
																															} else {
																																echo "-";
																															} ?></td>
					</tr>

					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:22%;text-align:center;padding-bottom:3px;padding-top:3px;font-weight:bold; " colspan=2>Avg.</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; font-weight:bold;"><?php echo $row_select_pipe['avg_com']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;font-weight:bold;">Avg.</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; font-weight:bold;"><?php echo $row_select_pipe['avg_wtr']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; font-weight:bold;">Avg.</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; font-weight:bold;">---</td>
					</tr>
					<tr style="">
						<td style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:22%;text-align:center;padding-bottom:3px;padding-top:3px; " colspan=2>Requirement as per<br> IS 3495:2019 <br>(Part-1&2)</td>
						<td style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">Not less than <?php echo $brick_specification; ?> N/mm<sup>2</sup></td>
						<td style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;">-</td>
						<td style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; ">Not more than 20%</td>
						<td style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">-</td>
						<td style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "></td>
						</tr-->

				</table>
			</td>

		</tr>


		<tr>
			<td style="text-align:center;font-size:11px; ">
				<br>
			</td>
		</tr>
		<tr>
			<td style="text-align:center;font-size:11px; "><br>
				<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;font-weight:bold; ">
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