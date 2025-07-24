<?php
include("../connection.php");
include("function_calling.php");
session_start();

error_reporting(0); ?>
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
	$select_tiles_query = "select * from water WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$source = $row_select4['fine_aggregate_source'];
		$type = $row_select4['fine_agg_type'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}
	
	?>



				<?php// if(($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) || ($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_1_4'] != null) || ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != "0" && $row_select_pipe['avg_finer'] != null) || ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) || ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) || ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) || ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) || ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) || ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) || ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) || ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null)){?>
<page size="A4">

<br>

		<table style="width: 95%;font-family: 'Calibri';font-size:12px;text-align: left;" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td style="width: 15%; text-align: center; vertical-align: middle; border: none; padding: 10px;">
					<img src="../images/logo.jpg" width="50%" height="50%">
				</td>
				<td style="width: 70%; text-align: center; border: none; padding: 10px;">
					<div style="font-size: 20px; font-weight: bold;  margin-bottom: 5px;">Water Analysis Report</div>
					<div style="font-size: 16px; margin-bottom: 5px;">District Level Water Analysis Laboratory</div>
					<div style="font-size: 16px; margin-bottom: 5px;">U.P. Jal Nigam (Rural), Farrukhabad</div>
				</td>
				<td style="width: 15%; text-align: center; vertical-align: middle; border: none; padding: 10px;">
					<img src="../images/nabl.png" width="50%" height="50%">
				</td>
			</tr>
		</table>
    <table  style="width: 95%;font-family: 'Calibri';font-size:12px;border: 1px solid;text-align: left;" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;">ULR No.</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php ECHO "TC-13514-25000000011F"//if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;">Report No.</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo "FBD/2025/96"//$report_no; ?></td>
			<td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;">Date</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo "28.04.2025"?></td>
			<td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;">Page No.</td>
            <td style="text-align:center;border-bottom: 1px solid;padding: 2px 5px;">1</td>
		</tr>
        <tr>
			<td style="text-align:center;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;"colspan="8" >Customer Details</td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"COLSPAN="2">Office Name & Address</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"COLSPAN="6"><?php echo "Khuseem Khan S/o Amir Khan"//date('d/m/Y', strtotime($rec_sample_date));?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"COLSPAN="2">Reference Letter No.</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"COLSPAN="6"><?php echo "0 Date-25.04.2025"//date('d/m/Y', strtotime($rec_sample_date));?></td>
		</tr>
		<tr>
			<td style="text-align:center;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;"colspan="8" >Basic Details of the Sample</td>
		</tr>
        
        <tr>
			<td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">District</td>
            <td COLSPAN="2"style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Shahjahanpur</td>
            <td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Block</td>
            <td COLSPAN="2"style="border-bottom: 1px solid;padding: 2px 5px;">Khudaganj</td>
		</tr>
		<tr>
			<td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Gram Panchayat </td>
            <td COLSPAN="2"style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"></td>
            <td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Village</td>
            <td COLSPAN="2"style="border-bottom: 1px solid;padding: 2px 5px;">Ward No. 5 Moh. Atishbaj Katra</td>
		</tr>
		<tr>
			<td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Habitation</td>
            <td COLSPAN="2"style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">-</td>
            <td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Location</td>
            <td COLSPAN="2"style="border-bottom: 1px solid;padding: 2px 5px;">Station Road Meeranpur Katra</td>
		</tr>
		<tr>
			<td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Water Source</td>
            <td COLSPAN="2"style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Summer/Handpump </td>
            <td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sample No./Code</td>
            <td COLSPAN="2"style="border-bottom: 1px solid;padding: 2px 5px;">FBD/2025/96</td>
		</tr>
		<tr>
			<td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Quantity of the Sample</td>
            <td COLSPAN="2"style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">2 Litre</td>
            <td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Sample Collection</td>
            <td COLSPAN="2"style="border-bottom: 1px solid;padding: 2px 5px;">25.04.2025</td>
		</tr>
		<tr>
			<td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Receiving Date</td>
            <td COLSPAN="2"style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">25.04.2025</td>
            <td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sample Collector</td>
            <td COLSPAN="2"style="border-bottom: 1px solid;padding: 2px 5px;">Khuseem Khan</td>
		</tr>
		<tr>
			<td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sample Depositor</td>
            <td COLSPAN="2"style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Khuseem Khan</td>
            <td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sampling Method</td>
            <td COLSPAN="2"style="border-bottom: 1px solid;padding: 2px 5px;">IS 17614(Part 1):2021 </td>
		</tr>
		<tr>
			<td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Analysis Start Date</td>
            <td COLSPAN="2"style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">26.04.2025</td>
            <td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Analysis Completion Date</td>
            <td COLSPAN="2"style="border-bottom: 1px solid;padding: 2px 5px;">26.04.2025</td>
		</tr>
		<tr>
			<td style="text-align:center;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;"colspan="8" >Environmental Condition</td>
		</tr>
		<tr>
			<td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Temperature</td>
            <td COLSPAN="2"style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">25&deg;C &plusmn; 3&deg;C</td>
            <td COLSPAN="2"style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Humidity</td>
            <td COLSPAN="2"style="border-bottom: 1px solid;padding: 2px 5px;">50% &plusmn; 15%</td>
		</tr>
		<tr>
			<td style="text-align:center;padding: 2px 5px;font-weight: bold;"colspan="8" >Technical Data ofAnalysis</td>
		</tr>		
		
	  </table>
      <table  style="width: 95%;font-family: 'Calibri';font-size:14px;" cellspacing="0" cellpadding="0" align="center">
				
					<tr style="text-align:center;font-weight: bold;">
						<td style="font-weight:bold;border-left: 1px solid;height: 50px;"rowspan="2">S.No</td>
                        <td style="border-left: 1px solid;"rowspan="2">Analysed Parameter</td>
						<td style="border-left: 1px solid;"colspan="2">Observed<br> Values</td>
						<td style="border-left: 1px solid;"colspan="3">Specified Values as per<br> BIS 10500:2012 </td>
						<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;"colspan="2">Ref. Method of Analysis</td>
					</tr>
                    <tr style="text-align:left;font-weight: bold;">
						<td style="width:12%;font-weight:bold;border-left: 1px solid;text-align: center; border-top: 1px solid;">I</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;"colspan="2">Acceptable Limit</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">Permissible Limit</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:center;"colspan="3"></td>
                    </tr>
                   <tr style="text-align:center;font-weight: bold;">
						<td style="width:12%;font-weight:bold;border-left: 1px solid;text-align: center; border-top: 1px solid;">1</td>
						<td style="width:12%;font-weight:bold;border-left: 1px solid;text-align: center; border-top: 1px solid;">2</td>
						<td style="width:12%;font-weight:bold;border-left: 1px solid;text-align: center; border-top: 1px solid;">3</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;"colspan="2">4</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">5</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:center;border-top: 1px solid;"colspan="3">6</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">1</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Odour</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">A </td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">Agreeable</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">Agreeable</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">IS:3025(Part-5):2018</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">2</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Taste</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">A </td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">Agreeable</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">Agreeable</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">IS:3025(Part-8):2023</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">3</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;pH</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">7.45</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">6.5-8.5</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">6.5-8.5</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">IS 3025(Part 11):2022 (Electrometric Method)</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">4</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Turbidity(NTU)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">0.55</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">1</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">5</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">IS 3025 (Part 10):2023</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">5</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;TDS(mg/L)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">341</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">500</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">2000</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">IS 3025 (Part 16):2023</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">6</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Chloride(mg/L)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">28</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">250</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">1000</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">IS 3025 (Part 32):2019</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">7</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Total Alkalinity(mg/L)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">188</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">200</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">600</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">IS 3025 (Part 23):2023</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">8</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Total Hardness(mg/L)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">298</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">200</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">600</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">IS 3025 (Part 21):2019</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">9</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Calcium(mg/L)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">91</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">75</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">200</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">IS 3025 (Part 40):2024</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">10</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Magnesium(mg/L)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">17</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">30</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">100</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">IS 3025 (Part 46):2023</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">11</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Sulphates(mg/L)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">26.73</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">200</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">400</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">APHA 24th Edition 4500 SO, Method E<br>(Turbidimetric Method), 2023</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">12</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Nitrate(mg/L)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">42.13</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">45</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">45</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">APHA 24th Edition<br>Method 4500 NO, Method B,(UV Screnning<br>Method) 2023 </td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">13</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Fluoride(mg/L)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">0.296</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">1</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">1.5</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">APHA 24th Edition<br>4500 F Method C,(Electrode Method) 2023</td>
                    </tr>
                   <tr style="">
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">14</td>
						<td style="width:12%;border-left: 1px solid; border-top: 1px solid;">&nbsp;&nbsp;&nbsp;Iron(mg/L)</td>
						<td style="width:12%;border-left: 1px solid;text-align: center; border-top: 1px solid;">0.142</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;"colspan="2">0.3</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;text-align:center;">1.0</td>
						<td style="border-left: 1px solid;padding: 0 10px;border-right: 1px solid;text-align:left;border-top: 1px solid;"colspan="3">APHA 24th Edition-3500-Fe Method <br>B,(Phenanthroline Method) 2023</td>
                    </tr>
             </table>
        <table  style="width: 95%;font-family: 'Calibri';font-size:15px;border: 1px solid;" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td style="width:3%;border-right:1px solid black;border-bottom:0px solid black;"rowspan="4"> Note </td>
                <td style="width:97%;padding: 0 10px;" colspan="5">1. This certificate refers only to the particular sample(s) submitted for testing.</td>
            </tr>
            <tr>
                <td style="padding: 0 10px;" colspan="5">2. This certificate shall not be reproduced, except in full, unless written permission for the publication of<br>an approved abstract has been obtained from the Head of the Laboratory. </td>
            </tr>
            <tr>
                <td style="padding: 0 10px;" colspan="5">3. The Test results reported in this certificate are valid at the time of and under the stated conditions of <br> Measurements.</td>
            </tr>
            <tr>
                <td style="padding: 0 10px;" colspan="5">4. Sample will be stored up to 7 days (in case of non perishable items only) from the date of issue.</td>
            </tr>
            
            <tr>
                <td style="width:50%;border-top: 1px solid;border-right: 1px solid;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Reviewed By</b></i></td>
                <td style="width:50%;border-top: 1px solid;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Verified By,</b></i></td>
            </tr>
			<tr>
                <td style="border-right: 1px solid;text-align: center;vertical-align: bottom;" colspan="3"><br></td>
                <td style="text-align: center;vertical-align: bottom;" colspan="3"><br></td>
            </tr>
			<tr>
                <td style="border-right: 1px solid;text-align: center;vertical-align: bottom;" colspan="3"><br></td>
                <td style="text-align: center;vertical-align: bottom;" colspan="3"><br></td>
            </tr>
			<tr>
                <td style="border-right: 1px solid;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Guddu <br>(Chemist)</b></i></td>
                <td style="text-align: center;vertical-align: bottom;" colspan="3"><i><b>Zikra Rahman<br>(Authorised Signatory)</b></i></td>
            </tr>
        </table>
		
		<table  style="width: 95%;font-family: 'Calibri';font-size:15px;" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <tr>
                <td style="padding: 0 50px;text-align: center;border-top: 1px solid;" colspan="6"><i><b>***End of Report***<br>(Jai Hind)</b></i></td>
            </tr>
            
        </table>
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