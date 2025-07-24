<?php
include("../connection.php");
include("function_calling.php");
session_start();

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
	@media print
{    
    #header_hide_show
    {
        display: none !important;
    }
}
/* Container for your content */
.container {
    position: relative;
    z-index: 1;
}

/* Watermark fixed at center of screen */
.watermark {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
    background-image: url('../img/dcs_logo_2.jpg');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    opacity: 1.9;
    pointer-events: none;
    z-index: -1;
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
	$select_tiles_query = "select * from span_brick WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	//$page_cont = round_up($no_of_rows / 5);
	//$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$agreement_no = $row_select['agreement_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	$tpi_or_auth = $row_select['tpi_or_auth'];
	$pmc_heading = $row_select['pmc_heading'];
	$authorize_by = $row_select['reported_by_authorize'];
	$verify_by = $row_select['reported_by_review'];
	
	$user_name = "select * from `multi_login` WHERE `id`='$authorize_by'";
	$result_for_select = mysqli_query($conn, $user_name);
	$user = mysqli_fetch_array($result_for_select);
	
	$a_name = $user['staff_fullname'];
	
	$verify_name = "select * from `multi_login` WHERE `id`='$verify_by'";
	$result_for_verify_select = mysqli_query($conn, $verify_name);
	$user_1 = mysqli_fetch_array($result_for_verify_select);	

	$v_name = $user_1['staff_fullname'];
	
	if ($cons == 0) {
		$con_sample = "Sealed";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
	}


	if ($row_select["agency_name"] != "") {
		$agency_name = $row_select['agency_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `isdeleted`='0'";
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
		$mark = $row_select4['brick_mark'];
		$brick_specification = $row_select4['brick_specification'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
		 /* $mark= $row_select4['brick_mark'];
					$brick_specification= $row_select4['brick_specification']; */
					$in_l= $row_select4['in_l'];
					$in_w= $row_select4['in_w'];
					$in_h= $row_select4['in_h'];
					$in_den= $row_select4['in_den'];
					$in_grade= $row_select4['in_grade'];
	}
	
	?>


	<?php// if(($row_select_pipe['avg_length'] != "" && $row_select_pipe['avg_length'] != "0" && $row_select_pipe['avg_length'] != null) || ($row_select_pipe['avg_width'] != "" && $row_select_pipe['avg_width'] != "0" && $row_select_pipe['avg_width'] != null) || ($row_select_pipe['avg_height'] != "" && $row_select_pipe['avg_height'] != "0" && $row_select_pipe['avg_height'] != null) || ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) || ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) || ($row_select_pipe['rbt_efflo1'] != "" && $row_select_pipe['rbt_efflo1'] != "0" && $row_select_pipe['rbt_efflo1'] != null)){?>
	
	<page size="A4">
	<div id="header">
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
	  
	  <?php if($_SESSION['isadmin']!=4){ ?>
<?php if($_SESSION['isadmin']==2){ ?>
<div class="watermark"></div>
<div class="container">
<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()">
<?php } ?>
 <table  style="width: 95%;font-family: 'Calibri';font-size:12px;" align="center">
        <tr>
            <td style="font-size:16px;text-align: right;">QSF-1002</td>
        </tr>
    </table>
	  <table  style="width: 95%;font-family: 'Calibri';font-size:12px;border: 1px solid;text-align: left;" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;width: 25%;">ULR No.</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;width: 25%;"><?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;width: 25%;">Test Report No.</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;width: 25%;"><?php echo $report_no; ?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Report Issue</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($issue_date));?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Sample Received</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sample Name</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Burnt Clay Brick<?php //echo $mt_name;?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Unique Identity of Sample</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo $lab_no;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Letter</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php  if ($row_select['date'] != "" && $row_select['date'] != null && $row_select['date'] != "0") { echo date('d/m/Y', strtotime($row_select["date"])); } else {echo "---NIL---";}?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Letter No.</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php  if ($r_name != "" && $r_name != null && $r_name != "0") { echo $r_name; } else {echo "---NIL---";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Test Start</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($start_date));?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Test Complete</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($end_date));?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sampling Quantity</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo $row_select_pipe['no_of_brick']; ?>Nos.</td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Source of Sample *</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php if ($mark != "" && $mark != null && $mark != "0") { echo $mark; } else {echo "-";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Name of Client</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo $clientname;?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Mark*</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php  if ($mark != "" && $mark != null && $mark != "0") { echo $mark; } else {echo "-";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Agency/Name & Address </td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;" colspan="3"><?php echo $clientname;?>,<?php echo $client_address;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;;">Name of Work</td>
            <td style="padding: 2px 5px;;border-bottom: 1px solid;" colspan="3"><?php echo $name_of_work;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;padding: 2px 5px;">Discipline/Group</td>
            <td style="padding: 2px 5px;;" colspan="3">Mechanical- Buildings Materials</td>
		</tr>
	  </table>
	  <?php } ?>
	  
	  <br>
				<table align="center"  width="95%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid; border-left:1px solid black;">
				
					<tr style="font-size:14px;text-align:center;">
						<td  style="width: 6%; border-top:1px solid;font-weight:bold;">S.No.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Test Parameters</td>
						<td  style="border:1px solid black;border-top:1px solid;border-right:0px solid black;font-weight:bold;"rowspan="2">Units</td>
						<td  style="border:1px solid black;border-top:1px solid;border-right:0px solid black;font-weight:bold;"rowspan="2">Test Result</td>
						<td  style="border:1px solid black;border-top:1px solid;border-right:0px solid black;font-weight:bold;"rowspan="2">Test Method</td>
						<td  style="border:1px solid black;border-top:1px solid;border-right:0px solid black;font-weight:bold;"rowspan="2">Requirement as per<br>IS 1077:1992<br>(Non - Modular) for CD</td>
					</tr>
					<?php $cnt = 1; ?>
					<?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != null && $row_select_pipe['com_1'] != "0") {?>
					<tr style="font-size:14px;text-align:center;">
						<td  style="width: 6%; border-top:1px solid;font-weight:bold;"><?php echo $cnt++;?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Compressive Strength (N/mm<sup>2</sup>)</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td style="border:1px solid;border-left:0px solid;border-right: 0px solid;border-bottom: 0px solid;">A</td>
						<td style="border:1px solid;border-left:1px solid;border-right: 0px solid black;text-align:left;">&nbsp;&nbsp;(i)</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid black;">N/mm<sup>2</sup></td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid black;"><?php echo $row_select_pipe['com_1'];?></td>
						<td style="border:1px solid black;border-top:0px solid;border-bottom:0px solid;border-right: 0px solid black;" rowspan="7">IS 3495(P-1):2019</td>
						<td style="border:1px solid black;border-top:0px solid;border-right:0px solid;" rowspan="7">Any Individual brick shall <br> not fall below by more <br> than 10% of 10 N/mm<sup>2</sup></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td style="border:1px solid;border-left:0px solid;border-right: 0px solid black;">B</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;text-align:left;">&nbsp;&nbsp;(ii)</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid black;">N/mm<sup>2</sup></td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;"><?php echo $row_select_pipe['com_2'];?></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td style="border:1px solid;border-top:0px solid;border-left:0px solid;border-right: 0px solid;">C</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;text-align:left;">&nbsp;&nbsp;(iii)</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;border-left:1px solid;border-right: 0px solid black;">N/mm<sup>2</sup></td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;"><?php echo $row_select_pipe['com_3'];?></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td style="border:1px solid;border-top:0px solid;border-left:0px solid;border-right: 0px solid;">D</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;text-align:left;">&nbsp;&nbsp;(iv)</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;border-left:1px solid;border-right: 0px solid black;">N/mm<sup>2</sup></td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;"><?php echo $row_select_pipe['com_4'];?></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td style="border:1px solid;border-top:0px solid;border-left:0px solid;border-right: 0px solid;">E</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;text-align:left;">&nbsp;&nbsp;(v)</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;border-left:1px solid;border-right: 0px solid black;">N/mm<sup>2</sup></td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;"><?php echo $row_select_pipe['com_5'];?></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td style="border:1px solid;border-top:0px solid;border-left:0px solid;border-right: 0px solid;">F</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;text-align:left;">&nbsp;&nbsp;(vi)</td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;border-left:1px solid;border-right: 0px solid black;">N/mm<sup>2</sup></td>
						<td style="border:1px solid;border-top:0px solid;border-left:1px solid;border-right: 0px solid;"><?php echo $row_select_pipe['com_6'];?></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td style="border:0px solid;border-top:0px solid;border-left:0px solid;border-right: 0px solid;">G</td>
						<td style="border:0px solid black;border-left: 1px solid black;text-align:left;font-weight:bold;">&nbsp;&nbsp;Average</td>
						<td style="border:1px solid;border-top:0px solid;border-bottom:0px solid;border-left:1px solid;border-right: 0px solid black;">N/mm<sup>2</sup></td>
						<td style="border:0px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_com'];?></td>
					</tr>
					<?php } if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;Water Absorption (%)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">%</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_wtr'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">IS 3495(P-2):2019</td>
						<td  style="border-top:0px solid;border-left: 1px solid black;">Up to Class 12.5 –<br>Not more than 20%<br>Higher than Class12.5 –<br>Not more than 15 %</td>
					</tr>
					<?php } if ($row_select_pipe['rbt_efflo1'] != "" && $row_select_pipe['rbt_efflo1'] != null && $row_select_pipe['rbt_efflo1'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;Efflorescence Test</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['rbt_efflo1'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">IS 3495(P-3):2019</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Up to Class 12.5–<br>Not More than  (Moderate)<br>Higher than Class 12.5 –<br>Not more than (Slight)</td>
					</tr>
					<?php } if ($row_select_pipe['avg_length'] != "" && $row_select_pipe['avg_length'] != null && $row_select_pipe['avg_length'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;padding:4px 4px;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;Dimension (mm)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;border-left: 0px solid black;">A</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;Length</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">mm</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_length'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"rowspan="3">IS 1077:1992 RA 2021</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">4600±80 mm</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;border-left: 0px solid black;">B</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;Width</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">mm</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_width'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">2200±40 mm</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;border-left: 0px solid black;">C</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;Height</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">mm</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_height'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">1400±40 mm</td>
					</tr>
					<?php }?>
				</table>
				 <table  style="width: 95%;font-family:Calibri;font-size:15px;border: 1px solid;" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td style="padding: 0 10px;" colspan="5"><i><b> Remarks: - </b>The Sample Confirms to IS: 1077 : 1992 w.r.t above test only  </i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>&#8226;</b>&nbsp;&nbsp;&nbsp;&nbsp;* Indicates information provided by the customer.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>&#8226;</b>&nbsp;&nbsp;&nbsp;&nbsp;The test results given above pertain to the sample as received.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;text-align: center;border-top: 1px solid;" colspan="6"><i><b>***End of Report***<br>(Jai Hind)</b></i></td>
            </tr>
            <tr>
				<td style="border-top: 1px solid;border-right: 1px solid;height: 100px;text-align: center;vertical-align: bottom;width:50%;" colspan="3"><i><b>Reviewed By<br><u><?php echo $v_name; ?> </u></b></i></td>
                <td style="border-top: 1px solid;height: 100px;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Authorized By<br></b><u><?php echo $a_name; ?> </u></i></td>
            </tr>
        </table>
<div id="footer" style="vertical-align: bottom;bottom:0px;position:relative;width:100%; margin: 0 auto; border-collapse: collapse; margin-top: 10px;">


		</div>
		</div>
	</page>
	
	

</body>

</html>
<script src="jquery.min.js"></script>
<script type="text/javascript">
	function header() {
    const headerCheckbox = document.querySelector('#header_hide_show');
    const headerElement = document.getElementById('header');
    const footerElement = document.getElementById('footer');

    if (headerCheckbox && headerCheckbox.checked) {
        // Show letterhead header and footer
        headerElement.innerHTML = '<img src="../img/dcs_letter_header.png" width="100%">';
        footerElement.innerHTML = '<img src="../img/dcs_letter_footer.png" width="100%">';
    } else {
        // Add spacing and clear footer
        headerElement.innerHTML = '<br><br><br><br><br><br><br><br><br>';
        footerElement.innerHTML = '';
    }
}
</script>