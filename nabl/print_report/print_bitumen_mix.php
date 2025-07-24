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
	$select_tiles_query = "select * from bitumin_span_mix WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
		$bit_mix = $row_select4['bit_mix'];
		$bitumin_mix = $row_select4['bitumin_mix'];
	}
		$cnt=1;	
	?>
<page size="A4">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<?php if($_SESSION['isadmin']!=4){ ?>
	<table align="center" width="95%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
		<tr>
			<td>
				<table  style="width: 100%;font-family: 'Calibri';font-size:12px;border: 1px solid;border-bottom:0px solid;text-align: left;" cellspacing="0" cellpadding="0" align="center">
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
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">BITUMEN <?php echo $bitumin_grade;?></td>
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
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">5 Kg</td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Bitumen Grade *</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php if ($bit_mix != "" && $bit_mix != null && $bit_mix != "0") { echo $bit_mix; } else {echo "-";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Name of Client</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo $clientname;?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Age of Specimen</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;">-</td>
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
				
				<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid; border-left:1px solid black;">
				
					<tr style="font-size:14px;text-align:center;">
						<td  style="width:8%;border-top:1px solid;font-weight:bold;">S. No.</td>
						<td  style="width:40%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Test<br>(with unit of measurement)</td>
						<td  style="width:10%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Test Result</td>
						<td  style="width:12%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Test Method</td>
						<td  style="width:20%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Requirement as per <br>MORTH</td>
					</tr>
					<?php $cnt = 1; ?>
					<?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != null && $row_select_pipe['pass_sample_1'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;" rowspan="12"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Sieve Analysis, (%) Passing</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;" rowspan="12">IS 2386(P-1):1963</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">Sieve Size</td>
						<td  style="border-left: 1px solid black;"></td>
						<td  style="border-left: 1px solid black;"></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">19 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_1'];?></td>
						<td  style="border-left: 1px solid black;">100</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">13.2 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_3'];?></td>
						<td  style="border-left: 1px solid black;">90-100</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">9.5 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
						<td  style="border-left: 1px solid black;">70-88</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">4.75 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
						<td  style="border-left: 1px solid black;">53-71</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">2.36 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_1'];?></td>
						<td  style="border-left: 1px solid black;">42-58</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">1.18 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_3'];?></td>
						<td  style="border-left: 1px solid black;">34-48</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">0.600 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
						<td  style="border-left: 1px solid black;">26-38</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">0.300 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
						<td  style="border-left: 1px solid black;">18-28</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">0.150 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
						<td  style="border-left: 1px solid black;">12-20</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">0.075 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
						<td  style="border-left: 1px solid black;">4-10</td>
					</tr>
					<?php }if ($row_select_pipe['avg_bin'] != "" && $row_select_pipe['avg_bin'] != null && $row_select_pipe['avg_bin'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Bitumen Content %</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_bin'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">ASTM D-2172</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
					</tr>
					<?php }if ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != null && $row_select_pipe['avg_density'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Density (g/cc)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_density'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">ASTM D-2726</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
					</tr>
					<?php }if ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != null && $row_select_pipe['avg_density'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Thickness</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_density'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
					</tr>
					<?php }?>
				</table>
	 <table  style="width: 100%;font-family:Calibri;font-size:15px;border: 1px solid;border-top:0px solid;" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td style="padding: 0 10px;" colspan="5"><i><b> Remarks: - </b>The Sample Confirms to IS: 383 :2016 w.r.t above test only </i></td>
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
                <td style="border-top: 1px solid;border-right: 1px solid;height: 100px;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Reviewed By<br><u><?php echo $v_name; ?> </u></b></i></td>
                <td style="border-top: 1px solid;height: 100px;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Authorized By<br></b><u><?php echo $a_name; ?> </u></i></td>
            </tr>
        </table>
			</td>
		</tr>
		</table>






<!--
       <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;">
		<tr>
			<td style="text-transform: uppercase;font-weight: bold;text-align: center;font-size: 21px;padding: 2px 0;"><u>TEST REPORT</u></td>
		</tr>
	  </table>
	<br>
	<br>
	  <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;">
		<tr>
			<td style="text-transform: uppercase;font-weight: bold;text-align: right;font-size: 16px;padding: 2px 0;">QSF-1002&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
	  </table>
	  <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border: 1px solid;">
		<tr>
			<td style="font-size:15px;padding:2px;text-align: left;border-right:1px solid;width:40%;border-bottom:1px solid black;" rowspan="9">&nbsp;&nbsp;<b>AGENCY / NAME & ADDRESS</b><br>&nbsp;&nbsp;<?php echo $clientname;?> <br> &nbsp;&nbsp;<?php echo $client_address;?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
		<?php if(strlen($_GET['ulr'])>10){?>
			<td  style="width:25%;font-weight:bold;border-bottom:1px solid black;" ><b>&nbsp;&nbsp;ULR no.</b></td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($_GET['ulr'] != "" && $_GET['ulr'] != null && $_GET['ulr'] != "0") { echo $_GET['ulr']; } else {echo "-";}?></td>
			<?php }else{?>
			<?php }?>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;DATE OF ISSUE</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($issue_date != "" && $issue_date != null && $issue_date != "0") { echo date('d/m/Y', strtotime($issue_date)); } else {echo "-";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;DATE OF LETTER</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($row_select['date'] != "" && $row_select['date'] != null && $row_select['date'] != "0") { echo date('d/m/Y', strtotime($row_select["date"])); } else {echo "---NIL---";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;DATE OF RECIPT.</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($rec_sample_date != "" && $rec_sample_date != null && $rec_sample_date != "0") { echo date('d/m/Y', strtotime($rec_sample_date)); } else {echo "-";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;REFERENCE NO.</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($r_name != "" && $r_name != null && $r_name != "0") { echo $r_name; } else {echo "---NIL---";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;REPORT NO.</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($report_no != "" && $report_no != null && $report_no != "0") { echo $report_no; } else {echo "-";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;UNIQUE IDENTITY OF SAMPLE</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;BC-206/1496/10/2024</td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;LOCATION</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php echo $row_select_pipe['Location_1'];?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;" colspan="3">&nbsp;&nbsp;<b>Client Name :-</b>&nbsp;<?php  if ($agency_name != "" && $agency_name != null && $agency_name != "0") { echo $agency_name; } else {echo "-";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;" colspan="3">&nbsp;&nbsp;<b>Test Method :-</b>&nbsp;IS 2386 (p-1):1963, ASTM D-2726, ASTM S-2172</td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;" colspan="3">&nbsp;&nbsp;<b>Name  of Test :-</b>&nbsp;Sieve Analysis, Bitumen Content, Density, Thickness</td>
		</tr>
		<?php if ($name_of_work != "" && $name_of_work != null && $name_of_work != "0") {?>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;" colspan="3">&nbsp;&nbsp;<b>Subject / N.O.W :-</b>&nbsp;<?php echo $name_of_work;?></td>
		</tr>
		<?php }?>
		<?php if ($mt_name != "" && $mt_name != null && $mt_name != "0") {?>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;" colspan="3">&nbsp;&nbsp;<b>DESCRIPTION OF SAMPLE :-</b>&nbsp;<?php echo $mt_name;?></td>
		</tr>
		<?php }?>
		<?php if ($con_sample != "" && $con_sample != null && $con_sample != "0") {?>
		<tr style="font-size:12px;text-align:left;">
			<td  style="" colspan="3">&nbsp;&nbsp;<b>CONDITION OF SAMPLE :-</b>&nbsp;<?php echo $con_sample;?></td>
		</tr>
		<?php }?>
	  </table>
	  <br>

				<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid; border-left:1px solid black;">
				
					<tr style="font-size:14px;text-align:center;">
						<td  style="width:8%;border-top:1px solid;font-weight:bold;">S. No.</td>
						<td  style="width:40%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Test<br>(with unit of measurement)</td>
						<td  style="width:10%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Test Result</td>
						<td  style="width:12%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Test Method</td>
						<td  style="width:20%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Requirement as per <br>MORTH</td>
					</tr>
					<?php $cnt = 1; ?>
					<?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != null && $row_select_pipe['pass_sample_1'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;" rowspan="12"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Sieve Analysis, (%) Passing</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;" rowspan="12">IS 2386(P-1):1963</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">Sieve Size</td>
						<td  style="border-left: 1px solid black;"></td>
						<td  style="border-left: 1px solid black;"></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">19 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_1'];?></td>
						<td  style="border-left: 1px solid black;">100</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">13.2 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_3'];?></td>
						<td  style="border-left: 1px solid black;">90-100</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">9.5 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
						<td  style="border-left: 1px solid black;">70-88</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">4.75 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
						<td  style="border-left: 1px solid black;">53-71</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">2.36 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_1'];?></td>
						<td  style="border-left: 1px solid black;">42-58</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">1.18 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_3'];?></td>
						<td  style="border-left: 1px solid black;">34-48</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">0.600 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
						<td  style="border-left: 1px solid black;">26-38</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">0.300 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
						<td  style="border-left: 1px solid black;">18-28</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">0.150 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
						<td  style="border-left: 1px solid black;">12-20</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;">0.075 mm</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
						<td  style="border-left: 1px solid black;">4-10</td>
					</tr>
					<?php }if ($row_select_pipe['avg_bin'] != "" && $row_select_pipe['avg_bin'] != null && $row_select_pipe['avg_bin'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Bitumen Content %</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_bin'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">ASTM D-2172</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
					</tr>
					<?php }if ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != null && $row_select_pipe['avg_density'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Density (g/cc)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_density'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">ASTM D-2726</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
					</tr>
					<?php }if ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != null && $row_select_pipe['avg_density'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Thickness</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['avg_density'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">-</td>
					</tr>
					<?php }?>
				</table>
	
		<!-- footer design --
		<br>
		<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;margin-left:60px;">
        <tr>
            <td><b>D.O.S:</b> <?php echo date('d/m/Y', strtotime($start_date));?></td>
        </tr>
        <tr>
            <td><b>D.O.C:</b> <?php echo date('d/m/Y', strtotime($end_date));?></td>
        </tr>
		</table>
		<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;padding:0;margin-left:60px;">
		<tr>
            <td style="font-size:12px;font-family : Calibri;"><b>Remarks:-</b></td>
        </tr>
		 </table>
		 <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;padding:0;">
		<ul>
            <li style="font-size:12px;font-family : Calibri;margin-left:60px;">&nbsp;*Indicates information provided by the customer</li>
            <li style="font-size:12px;font-family : Calibri;margin-left:60px;">&nbsp;<b>Note: -</b> The test Results given above pertains to the sample as received.</li>
        </ul>
		</table>
		<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;">
		<tr>
            <td align="center"><b>*** End Of Report *** </b> </td>
        </tr>
		<tr>
            <td align="center"><b>(Jai Hind)</b><br><br></td>
        </tr>
    </table>
    <br><br>
    <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;padding:0;margin-left:auto; margin-right:auto;">
        <tr>
            <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REWEWED BY</td>
            <td style="text-align:right;">AUTHORISED BY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Er.YOGINDER CHAUHAN</td>
            <td style="text-align:right;">Er.VISHAL ACHARYA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(SENIOUR ANALYST)</td>
            <td style="text-align:right;">(TECHNICAL MANAGER )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table>
	</page>
	
	<div class="page-break"></div>
	<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
						<tr>
							<td style="width:40%;padding: 0 2px;text-align: left;">&nbsp;<?php echo $report_no; ?></td>
							
							<td style="width:30%;padding: 0 2px;text-align: left;">&nbsp;<?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
							<td style="width:30%;padding: 0 2px;text-align: right;">&nbsp;Page 1 of 1</td>
						</tr>
						<tr>
							<td style="padding: 0 2px;text-align: left;border-top:1px solid;" colspan="2">&nbsp;Prepared by : Technical Manager</td>
							<td style="padding: 0 2px;text-align: right;border-top:1px solid;">&nbsp;Approved by : Quality Manager</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 54.5%;padding: 0 2px;text-align: right;">&nbsp;Group:- Building Materials</td>
							<td style="padding: 0 2px;width:45%;text-align: right;">&nbsp;Date:<?php echo date('d/m/Y', strtotime($issue_date));?></td>
						</tr>
						
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 50%;padding: 0 2px;text-align: center;">&nbsp;Discipline:- Mechanical</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF BITUMEN MIX
						</td>
					</tr>
				</table>
				<br>	
				<br>	
				
	<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border: 1px solid;">
    <?php if ($name_of_work != "") { ?>
	<tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Work </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $name_of_work;?></td>
    </tr>
	<?php }if ($agency_name != "") { ?>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Agency </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $agency_name;?></td>
    </tr>
	<?php }?>
	<tr>
		<?php
					if ($row_select['tpi_name'] != "") {
						?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Consultant </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $row_select['tpi_name']; ?></td>
					<?php } if ($agreement_no != "") {?>
		<td style="padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agreement No</td>
		<td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $agreement_no; ?></td>
					<?php }?>
	</tr>    
	
    <tr>
		<?php
						if ($clientname != "") {
						?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Client </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $clientname;?></td>
						<?php }?>
    </tr>   
    <tr>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Receipt Sample </td>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
        <td style="text-align: left;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $r_name; ?>&nbsp;&nbsp;<?php
            if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
            ?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
            } else {
            }
        ?></td>
    </tr>
    
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Test Performed </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b>From</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
        <td style="padding:2px;text-align: center;">&nbsp;To</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
        <td style="padding:2px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;Date <b>&nbsp; : &nbsp;</b> <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Enviromental Condition </td>
        <td style="padding:2px;text-align: left;font-weight:bold;" colspan="2"><b>&nbsp; : &nbsp;</b>Temperature</td>
        <td style="padding:2px;text-align: center;"><b>&nbsp; : &nbsp;</b>27˚± 2 ˚c</td>
        <td style="padding:2px;text-align: center;"><b></td>
		<?php
						if ($tank_no != "") {
						?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Truck no.</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $tank_no;?></td>
						<?PHP }?>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
	<?php
						if ($lot_no != "") {
						?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Gate Pass no.</td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $lot_no; ?></td>
						<?PHP }?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
	 <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Remark  </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $bitumin_make;?></td>
		<td style="padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Location</td>
							<td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php if ($material_location == 1) {echo "In Laboratory";} else {echo "In Field";} ?></td>
    </tr>
</table>
				
			</td>
		</tr>
	</table>
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-top: 0;">
			<tr>
				<td  colspan="5"  style="border: 0px solid black; font-weight:bold; text-align:center;"><BR></td>	
				
			</tr>
	</table>
	<?php $cnt=1;?>
	 <table align="center" width="100%"  class="test" style="height:auto;width:100%;" >
									<tr style="text-align:center;height:45px;">
										<td  style="border:1px solid black;border-left:1px solid black;width:20%;"><b>Description</b></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:20%;"><b>Flow<Br>(mm)</b></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:20%;"><b>Marshal Stability<br>(KN)</b></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:20%;"><b>Density<br>(gm/cc)</b></td>
										<td  style="border:1px solid black;border-right:1px solid black;width:20%;"><b>Binder Content by<br>Mix(%)</b></td>
									</tr>
									
									
									
									<tr style="text-align:center;height:45px;">
										<td style="border:1px solid black;border-left:1px solid black;">Result</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php 
										if($row_select_pipe['avg_flow'] == "" or is_null($row_select_pipe['avg_flow']))
										{
											echo "---";
										}
										else
										{
											echo number_format($row_select_pipe['avg_flow'],2);
										}
										?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php 
										if($row_select_pipe['avg_stabilty'] == "" or is_null($row_select_pipe['avg_stabilty']))
										{
											echo "---";
										}
										else
										{		
											echo number_format($row_select_pipe['avg_stabilty'],2);
										}
										?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php 
										if($row_select_pipe['avg_density'] == "" or is_null($row_select_pipe['avg_density']))
										{
											echo "---";
										}
										else
										{		
										echo number_format($row_select_pipe['avg_density'],3);
										}
										?></td>
										<td style="border:1px solid black;border-right:1px solid black;"><?php 
										if($row_select_pipe['avg_bin'] == "" or is_null($row_select_pipe['avg_bin']))
										{
											echo "---";
										}
										else
										{	
											echo number_format($row_select_pipe['avg_bin'],2);
										}
										?></td>
									</tr>
									
									<tr style="text-align:center;height:45px;">
										<td style="border:1px solid black;border-left:1px solid black;">Test Method</td>							
										<td style="border:1px solid black;border-left:0px solid black;">ASTM D 6927:2015</td>
										<td style="border:1px solid black;border-left:0px solid black;">ASTM D 6927:2015</td>
										<td style="border:1px solid black;border-left:0px solid black;">ASTM D 2726:2019</td>
										<td style="border:1px solid black;border-right:1px solid black;">ASTM D 2172:2017</td>
									</tr>
									<tr style="text-align:center;height:45px;">
										<td style="border:1px solid black;border-left:1px solid black;">Requirement<br>As Per IRC/MoRTH</td>							
										<td style="border:1px solid black;border-left:0px solid black;">2-4</td>
										<td style="border:1px solid black;border-left:0px solid black;">Min. 9 KN</td>
										<td style="border:1px solid black;border-left:0px solid black;">---</td>
										<td style="border:1px solid black;border-right:1px solid black;">---</td>
									</tr>
									
									
								</table>
		
		
		
		<!-- footer design ->
		
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
			<br>
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
						
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;padding-left:60px;" colspan="2">1) Test results related to sample collected by Customer.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;padding-left:60px;" colspan="2">2) Results/Reports are issued with the specific understanding that Stern Testing & Consultancy Pvt. Ltd. will not, in any case, be involved in action following the interpretation of test results.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;padding-left:60px;" colspan="2">3) The reports/results are not supposed to be used for Publicity.</td>
						</tr>
						
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;width:70%;padding-top:50px;"></td>
							<td style="padding: 1px 2px;font-weight: bold;width:30%;">Stern Testing & Consultancy Pvt. Ltd.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;width:70%;padding-top:80px;"></td>
							<td style="padding: 1px 2px;font-weight: bold;width:30%;padding-left:5%;">Authorized Signature</td>
						</tr>
						
					</table>
				</td>
			</tr>

		</table>
				</td>
			</tr>

		</table>


<!-- old code -->


		<!-- <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:80px;">
			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:11px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sr.<br>NO.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Bar Dia (mm) *</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Mass in Kg/m</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Cross Sectional Area (mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Yield Stress (Mpa)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Tensile Stress (Mpa)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Elongation %</td>
							<td colspan="15" style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Bend & Rebend Test</td>
						</tr>

						<?php
								$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
								$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
								// $coming_row = mysqli_num_rows($result_tiles_select1);

								while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
								
								?>
						<tr style="">
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"> <?php echo $cnt++; ?></td>
								

							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe2['dia_1'];  ?></td>
							


		<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['w_1'] != "" && $row_select_pipe2['w_1'] != null && $row_select_pipe2['w_1'] != "0") {
																															if ($row_select_pipe2['dia_1'] == "8 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "10 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "12 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "16 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "20 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "25 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "32 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "4 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "5 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "6 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "28 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "36 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "40 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "45 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "50 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) . "<br>" . "(15.42)";
																															};
																																	} else {
																																		echo "-";
																																	} ?></td>

							
					<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['cs_1'] != "" && $row_select_pipe2['cs_1'] != null && $row_select_pipe2['cs_1'] != "0") {echo $row_select_pipe2['cs_1'];} else {echo "-";} ?></td>
							
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['ys_1'] != "" && $row_select_pipe2['ys_1'] != null && $row_select_pipe2['ys_1'] != "0") {echo $row_select_pipe2['ys_1'];} else {echo "-";} ?></td>

					
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['ten_1'] != "" && $row_select_pipe2['ten_1'] != null && $row_select_pipe2['ten_1'] != "0") {
																																								echo $row_select_pipe2['ten_1'];
																																							} else {
																																								echo "-";
																																							} ?></td>
							
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['elo_1'] != "" && $row_select_pipe2['elo_1'] != null && $row_select_pipe2['elo_1'] != "0") {
																																							echo $row_select_pipe2['elo_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>

						
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['bend_1'] != "" && $row_select_pipe2['bend_1'] != null && $row_select_pipe2['bend_1'] != "0" && $row_select_pipe2['bend_1'] != "undefined") {
																																							echo $row_select_pipe2['bend_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							



						
					</tr>
					<?php
								/* if ($flag6 == 5) {
									break;
								} */
							}

							?>

						<tr style="">
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;" colspan=3>Method of Test</td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">IS 1786-2008</td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;" colspan=3>IS 1608-2022 (Part-1)</td>
							<td colspan="15" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">IS 1599-2019</td>
						</tr>
					</table>


				</td>
			</tr>

			    <tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:11px;text-align:left;font-weight:bold;padding:15px 0 5px;font-family:Times New Roman;"> Requirement as per IS 1786-2008, CI-8.1, Table-3 (Amend No. 1 to IS 1786 : 2008)</td>
                            </tr>
                        </table>
                    </td>
                </tr>


            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;">             
           
										<tr>
											<td style="font-size:11px;text-align:left;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Property</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 415</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 415D</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 500</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 500D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 550</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 550D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 600</b></td>
										</tr>
										
										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Yield Stress (Min)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">415</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">415</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">500</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">500</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">550</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">550</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">600</td>
										</tr>

										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Tensile Stress N/mm<sup>2</sup> . Min/ % more than actual Yield stress</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">485 / 10%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">500 / 12%</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">545 / 81%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">565 / 10%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">585 / 6%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">600 / 8%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">660 / 6%</td>
										</tr>

										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Elongation % (Min)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">14.5</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">18</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">12</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">16</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">10</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">14.5</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">10</td>
										</tr>

										<tr>
											<td style="font-size:11px;text-align:left;border:1px solid black;padding:5px 4px;" >&nbsp; Bend Test</td>
											<td style="font-size:11px;text-align:center;border:1px solid black;padding:5px 4px;" colspan=7> There Shall not be any transverse crack/ruputre in the bent portion</td>
                           				 </tr>
								</table>

							</td>
            </tr>


			<tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:11px;text-align:left;font-weight:bold;padding:15px 0 5px;font-family:Times New Roman;"> Requirement as per IS 1786-2008, CI6.3 & 7.2.3</td>
                            </tr>
                        </table>
                    </td>
                </tr>


            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;margin-bottom:10px;">             
           
										<tr>
											<td style="font-size:11px;text-align:left;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Diameter in mm</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>4</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>5</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>6</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>8</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>10</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>12</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>16</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>20</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>25</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>28</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>32</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>36</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>40</b></td>
										</tr>
										
											<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp;Mass per meter (Kg)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.099</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.154</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.222</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.395</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.617</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.888</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">1.580</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">2.470</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.850</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">4.830</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">6.310</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">7.990</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">9.860</td>
											</tr>
											<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp;Tolerances on Nominal Mass</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;" colspan="5">-8%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;" colspan="2">-6%</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;" colspan="6">-4%</td>
											</tr>
								</table>

							</td>
            </tr>			
		</table> ->

		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


		</div>-->
	</page>
	<?php

	/*if($flag==5)
				{
					$flag=0;
					$down=$up;
					$up +=5;*/
	?>



	<!--<div class="pagebreak"> </div>-->
	<?php /*}*/


	/*}*/

	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>