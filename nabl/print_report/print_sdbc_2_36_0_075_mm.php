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
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from sdbc_2_36_0_075_mm WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			include_once 'sample_id.php';
			if (
				strpos($row_select3["mt_name"], "WMM (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - IV MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - V MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - VI MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "MSS - A (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "MSS - B (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
				strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
				strpos($row_select3["mt_name"], "BM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BC - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "DBM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "DBM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "SDBC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "Seal Coat") !== false ||
				strpos($row_select3["mt_name"], "Premix Carpet") !== false ||
				strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
				strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
				strpos($row_select3["mt_name"], "SDBC - 2 (MIX MATERIAL)") !== false
			) {
				$mt_name = $row_select3['mt_name'];
			} else {
				$ans = substr($row_select3["mt_name"], strpos($row_select3["mt_name"], "(") + 1);
				$explodeing = explode(")", $ans);
				$mt_name = $explodeing[0];
			}
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}


	?>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;">
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
							<td style="width: 58.5%;padding: 0 2px;text-align: right;">Discipline:- Mechanical</td>
							<td style="padding: 0 2px;width:45%;text-align: right;">&nbsp;Date:<?php echo date('d/m/Y', strtotime($issue_date));?></td>
						</tr>
						
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 100%;padding: 0 2px;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Group:- Building Materials</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF STONE DUST
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
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $clientname;?></td>
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
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Location</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php if ($material_location == 1) {echo "In Laboratory";} else {echo "In Field";} ?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $source; ?></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
</table>
				<!--<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 1px solid;border-bottom: 0;">
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Name of Work :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="6">&nbsp;<?php echo $name_of_work;?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Name of Client :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="6">&nbsp;<?php echo $clientname;?></td>
						</tr>	
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Name of Agency :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="6">&nbsp;<?php echo $agency_name;?></td>
						</tr>
						<tr>
							<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Date of Receipt Sample :-</td>
							<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
							<td style="text-align: left;border-left: 1px solid;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
							<td style="padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?></td>
						</tr>
						
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Date of Test Performed :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;From</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;To</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Date :- <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Enviromental Condition :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;font-weight:bold;" colspan="2">&nbsp;Temperature :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;" colspan="2">&nbsp;27˚± 2 ˚c</td>
							<td style="padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Location</td>
							<td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php if ($material_location == 1) {echo "In Laboratory";} else {echo "In Field";} ?></td>
						</tr>
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;Sample Collected by the Supplier</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Job No. :- </td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $job_no;?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark :-</td>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;<?php echo $source; ?></td>
							<td style="border-top: 1px solid;border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Lab No. :- </td>
							<td style="border-top: 1px solid;border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $lab_no;?></td>
						</tr>
						
				</table>
				
				<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;padding-top:20px;padding-bottom:20px;">
						<tr>
							<td style="width: 50%;padding: 0 2px;text-align: left;font-size:15px;">&nbsp;Size of Brick <?php echo $row_select4['brick_size'];?> Cm</td>
						</tr>
						
				</table>-->
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; padding-top:20px;border-bottom: 1px solid;">
			
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:2px 0px;width:9%" rowspan="2" colspan="2">Test</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:2px 0px;width:9%">Results</td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:2px 0px;width:9%" rowspan="2">Test Method</td>                            
                <td style="border-top:1px solid;border-right:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:2px 0px;width:9%" rowspan="2">"Requirement as per<br>IS 383-2016"   </td>
            </tr>
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:2px 0px;width:9%"><?php echo $lab_no;?></td>
               
            </tr>
			<?php $cnt=1;?>
			<?php if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") { 
			?>
			
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">Specific Gravity</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['sp_specific_gravity'];?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;" rowspan="2">IS 2386 PART-3</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;" rowspan="2">Max. 2%</td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">Water Absorption (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['sp_water_abr'];?></td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != null && $row_select_pipe['pass_sample_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">Gradation<br>Passing Percentage</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;" rowspan="6">IS 2386 PART-1</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;">Passing Percentage</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">4.75 mm</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;">-</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">2.36 mm</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;">-</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">1.18 mm</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;">-</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">0.300 mm</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['pass_sample_4']; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;">-</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">0.075 mm</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['pass_sample_5']; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;">-</td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != null && $row_select_pipe['imp_value'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">Impact Value (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['imp_value'];?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">IS 2386 PART-4</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;">For Wearing surface 30% <br>for Concrete Othe than <br>wearing surface 45%</td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != null && $row_select_pipe['cru_value'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">Crushing Value (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['cru_value'];?></td>
				<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">IS 2386 PART-4</td>
				<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;">For Wearing surface 30% <br>for Concrete Othe than <br>wearing surface 45%</td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != null && $row_select_pipe['abr_index'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">Abrasion Value (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['abr_index'];?></td>
				<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">IS 2386 PART-4</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;">For Wearing surface 30%<br> for Concrete Othe than <br>wearing surface 50%</td>
                
            </tr>
			<?php 
			} 
			if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">Soundness (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['soundness'];?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">IS 2386 PART-5</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;">12% When test with Na<sub>2</sub>So<sub>4</sub></td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['fi_index'] != "" && $row_select_pipe['fi_index'] != null && $row_select_pipe['fi_index'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">Flakiness Index (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['fi_index']; ?></td>
				<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;" rowspan="2">IS 2386 PART-1</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:1px solid;border-bottom:0px;"rowspan="2"> Flakiness & Elongation<br> Index Combined Max 40% <br>for Uncrushed & Crushed <br>Aggregate</td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['ei_index'] != "" && $row_select_pipe['ei_index'] != null && $row_select_pipe['ei_index'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;">Elongation Index (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['ei_index']; ?> </td>
            </tr>
			<?php } ?>
			
	</table>
	<br>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
			
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
	<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - Properties of Aggregate</td>
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
					<!--STATIC AMENDMENT NO AND DATE->
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
			<!-- header part ->
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
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $source; ?></td>
					</tr>
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>


		

			<!--START->
			<tr>
			    <td>
                    <table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="font-family : Calibri; border-right:2px solid black; border-left:2px solid black;">

					<?php
                                        if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0") {
                                        ?>
                                      
                        <tr>
                             <td colspan="2" style="font-weight:bold;font-size:11px;">A) Sieves Analysis :</td>
                        </tr>

                        <tr style="display:flex; ">
                            <td colspan="2" style="width:100%;vertical-align:top">
							<table align="top" width="100%" class="test" style="max-width:400px;font-size:11px;font-family : Calibri;">
                                     <tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 0px solid black;font-weight:bold;padding:5px 4px;" colspan="3"><b>Particle Size Distribution Test</b></td>
									</tr>
									<tr>
										<td colspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left: 0px solid black;font-weight:bold;padding:5px 4px;" ><b>IS 2386 Part-1</b></td>
									</tr>

									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;padding:5px 4px;"> Sieve Size</td>

												<td style="border-right:1px solid black;">
													<table style="width:100%;border-collapse: collapse;">
														<tr>
															<td style="font-size:11px;text-align:center;border-bottom:0px solid black;padding:5px 4px;">Test Result</td>
														</tr>
														<tr style="">
															<td style="font-size:11px;text-align:center;border-top:1px solid black;padding:5px 4px;">% Passing</td>
														</tr>
													</table>
											    </td>
												<td style="border-right:1px solid black;">
													<table style="width:100%;border-collapse: collapse;">
														<tr>
															<td style="font-size:11px;text-align:center;border-bottom:0px solid black;padding:5px 4px;">% of Retained</td>
														</tr>
													</table>
										       </td>
									</tr>

										<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:2px 0;">4.75 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['cum_ret_1']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:2px 0;">2.36 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['cum_ret_2']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:2px 0;">1.18 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['cum_ret_3']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:2px 0;">0.3 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_4']; ?></td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['cum_ret_4']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:2px 0;">0.075 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_5']; ?></td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px sol)id black;padding:2px 0;"><?php echo $row_select_pipe['cum_ret_5']; ?></td>
									</tr>
                                    <tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:2px 0;">Pan</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"></td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">--</td>
									</tr>
                                </table>
                            </td>

                           
                        </tr>
						<?php
                                      }
                                        ?>
                                      
                        <tr>  
                          <?php
                            if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") || ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") || ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") || ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") || ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0")) {

                            ?>
                                <td colspan="3" style="padding-bottom:4px;font-weight:bold;font-size:11px;padding-top:4px;">B) Other Test :</td>
								<?php } else { ?>
							    <td colspan="3" style="padding-bottom:4px;font-weight:bold;font-size:11px;"><b>&nbsp;</b></td>
                            <?php
                            }
                            ?>
                        </tr>

                        <tr>
                          <td colspan="3" style="width:49%;vertical-align:top">
                                <table align="top" width="100%" class="test" style="height:100%;width:100%;">
                                    <?php
                                    if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") || ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") || ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") || ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") || ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0")) {

                                    ?>
                                       <tr>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 0px solid black;font-weight:bold;padding:5px 4px;">Name Of Test</td>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Test Method</td>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Test Results</td>
												<!-- <td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Req. as per Morth</td> ->
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;border-right: 0px solid black;font-weight:bold;padding:5px 4px;width:25%;">Acceptance Critaria as per MoRTH</td>
											</tr>

                                        <?php
                                        if ($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Flakiness + Elongation %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-1</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['combined_index']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">Max. 35%</td>
                                            </tr>
                                            

                                        <?php
                                        }
                                        if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Impact Value %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['imp_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">Max. 24%</td>
                                            </tr>

									<?php
                                        }
                                        if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Crushing Value %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['cru_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">Max. 30%</td>
                                            </tr>

									<?php
                                        }
                                        if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">LA Abrasion Value %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['abr_index']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">Max. 30%</td>
                                            </tr>


                                        <?php
                                        }
                                        if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Specific Gravity</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-3</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['sp_specific_gravity']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Water Absorption %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-3</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['sp_water_abr']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right: 0px solid black;padding:2px 4px;">Max. 2%</td>
                                            </tr>
                                       

                                        
                                        <?php
                                        }
                                        if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Bulk Density kg/Lit.</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-3</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['bdl']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>


                                        <?php
                                        }
                                        if ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">10% Fine Value KN</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['fines_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>

                                        <?php
                                        }
                                        if ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Liquid Limit (LL)</td>
                                                <td rowspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-5</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['liquide_limit']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max 25%</td>
                                            </tr>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Plastic Limit (PL)</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['plastic_limit']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">Plasticity Index (PI)</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['pi_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">&lt; 6%</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px; border-bottom:0px;">Soundness Na<sub>2</sub>SO<sub>4</sub> %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;border-bottom:0px;">IS 2386 Part-5</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;border-bottom:0px;"><?php echo $row_select_pipe['soundness']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;border-bottom:0px;border-right: 0px solid black;">Max. 12%</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">MDD (g/cc)</td>
                                                <td rowspan="2" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-8</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['mdd']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;padding:2px 4px;">OMC %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['omc']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
										}
										 if ($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != "0") {
											?>
	
												<tr>
													<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Alkali Reactivity Test (Gravimetric Method)</td>
													<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386-7</td>
													<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['alk_10']; ?></td>
													<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--`</td>
													</tr>
	
                                       <?php }
                                        if ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">California Bearing Ratio %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-16</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['cbr']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Min. 30</td>
                                            </tr>
											
											
                                    <?php
										
                                        }
                                    }

                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>

				
			</tr>
		</table>

		
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
		
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid; border-top:0px;">
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

	</table>-->


	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>