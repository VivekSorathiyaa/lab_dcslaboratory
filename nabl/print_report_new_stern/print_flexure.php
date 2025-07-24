<?php
session_start();
include("../connection.php");
include("function_calling.php");
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
		font-family : Calibri;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.tdclass1 {

		font-size: 12px;
		font-family : Calibri;
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
	$select_tiles_query = "select * from flexure_beam WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
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
			include_once 'sample_id.php';
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
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}

	$flag = 0;
	$a = 1;
	$down = 0;
	$up = 7;
	/*for($a=1;$a<=$page_cont;$a++)		{
*/
	?>



<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - FLEXURAL STRENGTH OF CONCRETE BEAM</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
						<td style="width: 14%;padding: 0 2px;">&nbsp;Sample ID No :-</td>
						<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $sample_id; ?></td>
						<td style="text-align: left;border-left: 1px solid;">&nbsp;Report Date :-</td>
						<td style="padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
					</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Report No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;ULR No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $_GET['ulr']; ?></td>
					</tr>
					<!--STATIC AMENDMENT NO AND DATE-->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;--</td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Group :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Building Materials</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp; <?php echo date('d/m/Y', strtotime($row_select_pipe["amend_date"])); ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Discipline :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Mechanical</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part -->
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width: 24.9%;">&nbsp;Customer Name & Address :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
					</tr>
					<?php
						}
						if ($agency_name != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agency Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
					</tr>
					<?php } 
					if ($row_select['tpi_name'] != "") {
						?>
							
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Consultants :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
					</tr>
					<?php
						 }
						if ($agreement_no != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agreement No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
					</tr>
					<?php
						}
						if ($name_of_work != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Project Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;">&nbsp;To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $cc_grade?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Casting Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['casting_date'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Day :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['day_remark'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Identification Mark :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['cc_identification_mark'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Quantity / Report :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['cc_qty'];?></td>
					</tr>
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>

			
			<!-- <tr style="">
                <td>
                    <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                        <tr>
                        	<td style="font-size:13px;font-weight:bold;text-align:left;padding:15px 0 5px;font-family:Times New Roman;">1. Flexural strength of concrete cubes</td>
                        </tr>
                    </table>
                </td>
            </tr> -->
			<?php $cnt = 1; ?>
			<tr>
			    <td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:0px solid;border-right:2px solid;border-left:1px solid black;">

						<tr style="">
							<td style="width:2%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"> Sr.<br>No.</td>
							<td style="width:10%;border-top01px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sample ID</td>
							<td style="width:10%;border-top01px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Date Of Casting *</td>
							<td style="width:11%;border-top01px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Date Of Testing</td>
							<td style="width:6%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Age Of Test <br> (days)</td>
							<td style="width:6%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Grade of Concrete *</td>
							<td style="width:6%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Span (mm)</td>
							<td style="width:6%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Width (mm)</td>
							<td style="width:6%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Depth (mm)</td>
							<td style="width:10%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Max. Load at Failure (KN)</td>
							<td style="width:10%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Position of <br>fracture<br> (a) (cm)</td>
							<td style="width:20%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Flexural Strength<br>N / mm<sup>2</sup></td>
						</tr>

						<?php
						$select_tilesy = "select * from flexure_beam WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;
						?>

							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Beam - 1</td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['day1']; ?></td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cc_grade; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['l1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['b1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['h1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['load_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['cross_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_1']; ?></td>
							</tr>


							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Beam - 2</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; "><?php echo $row_select_pipe['l2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['b2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['h2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['load_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['cross_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_2']; ?></td>
							</tr>


							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Beam - 3</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['l3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['b3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['h3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['load_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['cross_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_3']; ?></td>
							</tr>


							<tr style="">
								<td style="border-bottom:1px solid black;border-left: 1px solid black;border-top: 1px solid black;text-align:right;padding:5px 4px;font-weight:bold;" colspan=11>Average&nbsp;</td>
								<td style="border-bottom:1px solid black;border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['avg_com_s_1']; ?></td>
							</tr>

							<tr>
								<td style="font-size:12px;text-align:left;padding-top:4px;border:1px solid;border-top:0;border-right:0;padding-left:2px;padding-bottom: 4px;" colspan=13><span style="font-weight:bold;font-size:11px;">&raquo; &nbsp;Remark</span> :-<span style="font-weight:bold;font-size:11px;">  If position of fracture (a) is less than 17.0 cm for a 15.0 cm specimen or lass than 11.0 cm for 10.0 cm specimen the results of test shall be discarded.</td>
						    </tr>
							<tr>
								<td style="font-size:12px;text-align:left;padding-top:4px;padding-bottom:4px;font-weight:bold;border-right:0px solid black;border-left:1px solid black;" colspan=13>Requirements as per IS 456 : 2000   Clause No.&nbsp;6.2.2</td>
						    </tr>
							
						<?php
							if ($flag == 7) {
								break;
							}
						}
						?>
					</table>
				</td>
				<!-- <td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

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
						$select_tilesy = "select * from flexure_beam WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;


						?>


							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">1-07</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
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
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
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
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
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
                            <td style="font-size:11px;text-align:left;font-weight:bold;padding:20px 0 5px;font-family:Times New Roman;"> Requirement as per IS 456 : 2000 Table No.2 (Clause 6.1 , 9.2.2, 15.1.1 , and 36.1)</td>
                            </tr>
                        </table>
                    </td>
            </tr>-->
            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;border-left:2px solid black;border-right:2px solid black;">             
           
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
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M50</b></td>
										</tr>
										
										<tr>
												<td style="width:32.5%;font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 4px;">Accepted Strength on 28 days of curing, N/mm<sup>2</sup></td>
												<td style="width;7.50%;text-align:center;border:1px solid black;border-right:0px solid black;">2.21</td>
												<td style="width;7.50%;text-align:center;border:1px solid black;border-right:0px solid black;">2.71</td>
												<td style="width;7.50%;text-align:center;border:1px solid black;border-right:1px solid black;">3.13</td>
                                                <td style="width;7.50%;text-align:center;border:1px solid black;border-right:1px solid black;">3.5</td>
                                                <td style="width;7.50%;text-align:center;border:1px solid black;border-right:1px solid black;">3.83</td>
                                                <td style="width;7.50%;text-align:center;border:1px solid black;border-right:1px solid black;">4.14</td>
                                                <td style="width;7.50%;text-align:center;border:1px solid black;border-right:1px solid black;">4.43</td>
												<td style="width;7.50%;text-align:center;border:1px solid black;border-right:1px solid black;">4.70</td>
												<td style="width;7.50%;text-align:center;border:1px solid black;border-right:1px solid black;">5.51</td>
										</tr>
								</table>

							</td>
            </tr>
		</table>

		<!--<table width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
			<tr>
                <td>
                    <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                        <tr>
                        	<td style="font-size:11px;text-align:left;padding:30px 0 0px;font-family:Times New Roman;">2. Compressive strength of Accelerated concrete cubes</td>
                        </tr>
                    </table>
                </td>
            </tr>

			<tr>
                <td>
                    <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                        <tr>
                        	<td style="font-size:11px;text-align:left;padding:5px 0 5px;font-family:Times New Roman;">A) Concrete Cube Test Results...</td>
                        </tr>
                    </table>
                </td>
            </tr>
		<?php $cnt = 1; ?>
			<tr>
			    <td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:0px solid;border-right:0px solid;">

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
						$select_tilesy = "select * from flexure_beam WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;
						?>

							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Sample-1</td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td rowspan=3 style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
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
								<td style="font-size:11px;text-align:left;padding-top:15px;font-weight:bold;" colspan=11>* Compressive Strength R28 is to be evaluted as per IS 9013-1978 Fig-2 Regression Equation</td>
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

<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
						<tr>
							<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;text-transform: uppercase;font-weight: bold;">Report Issue By:- GEO RESEARCH HOUSE, INDORE.</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr style="vertical-align: bottom;">
							<td style="padding: 1px 2px;height: 45px;">{Mr. Chitrath Purani}</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">Report Reviewed & Authorized by :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">1. The Samples have been Submitted to us by the Customer.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">2. The above given Results Refer only to the sample submitted by the customer for testing.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">3. All the information is Provided to us by the Customer and can affect the Result Validity.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">4. This Report shall not be Reproduced without Approval of the Laboratory.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">5. * As Informed by Client.</td>
						</tr>
						<tr>
							<td style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 1 of 1</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>

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