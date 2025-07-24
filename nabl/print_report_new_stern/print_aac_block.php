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
	$select_tiles_query = "select * from aac_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
        $in_l = $row_select4['in_l'];
        $in_w = $row_select4['in_w'];
        $in_h = $row_select4['in_h'];
        $in_den = $row_select4['in_den'];
        $in_grade = $row_select4['in_grade'];
	}
		$cnt=1;	
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
							<td style="padding: 0 2px;text-align: left;">&nbsp;<?php echo $report_no; ?></td>
							
							<td style="padding: 0 2px;text-align: left;">&nbsp;<?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
							<td style="padding: 0 2px;text-align: right;">&nbsp;Page 1 of 1</td>
						</tr>
						<tr>
							<td style="width: 80%;padding: 0 2px;text-align: left;border-top:1px solid;" colspan="2">&nbsp;Prepared by : Technical Manager</td>
							<td style="padding: 0 2px;width:20%;text-align: right;border-top:1px solid;">&nbsp;Approved by : Quality Manager</td>
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF AAC BLOCK
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
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Size </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $row_select_pipe['in_l']; ?> x <?php echo $row_select_pipe['in_w']; ?> x <?php echo $row_select_pipe['in_h']; ?> mm</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
	<tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Brand </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b>ACCURATE</td>
    </tr>
	
</table>				
				
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;padding-top:20px;padding-bottom:20px;">
						<tr>
							<td style="width: 50%;padding: 0 2px;text-align: left;font-size:15px;">&nbsp;Dimensions Tolerances</td>
						</tr>
						
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border-right:1px solid;border-top: 1px solid;border-bottom: 1px solid;">
			<tr style="">
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%" colspan="2"> Test</td>
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Results Obtained</td>                            
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Requirement as per</td> 
            </tr>
			<?php 
			if ($row_select_pipe['dim_length'] != "" && $row_select_pipe['dim_length'] != null && $row_select_pipe['dim_length'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Length (mm)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['dim_length']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">600 ± 5 mm</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Width (mm)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['dim_width']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">230 ± 3 mm</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Height (mm)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['dim_height']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">200 ± 3 mm</td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['bdl_kg'] != "" && $row_select_pipe['bdl_kg'] != null && $row_select_pipe['bdl_kg'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Density (kg/m<sup>3</sup>)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['bdl_kg']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">551-650 Kg/m<sup>3</sup></td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['avg_com'] != "" && $row_select_pipe['avg_com'] != null && $row_select_pipe['avg_com'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Compressive Strength <br>(Kg/cm<sup>2</sup>)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_com']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Shall be more than  35 kg/cm<sup>2</sup></td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['avg_shrink'] != "" && $row_select_pipe['avg_shrink'] != null && $row_select_pipe['avg_shrink'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Drying Shrinkage (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_shrink']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">< 0.1 %</td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['mc'] != "" && $row_select_pipe['mc'] != null && $row_select_pipe['mc'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Moisture Content (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['mc']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">551-650 Kg/m<sup>3</sup></td>
            </tr>
			
			<?php 
			}
			if ($row_select_pipe['avg_thr'] != "" && $row_select_pipe['avg_thr'] != null && $row_select_pipe['avg_thr'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Thermal Conductivity</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_thr']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">0.24 to 0.42 W/M2k</td>
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
		<!--<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">TEST REPORT - AAC BLOCK</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
							<td style="width: 14%;padding: 0 2px;text-align: right;">&nbsp;Sample ID No :-</td>
							<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $lab_no; ?></td>
							<td style="text-align: center;border-left: 1px solid;text-align: right;">&nbsp;Report Date :-</td>
							<td style="padding: 0 2px;text-align: center;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Report No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
							<?php if(strlen($_GET['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;<?php echo $_GET['ulr']; ?></td>
							<?php }else{?>
							<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">&nbsp;</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;</td>
							<?php }?>
						</tr>
					<!--STATIC AMENDMENT NO AND DATE->
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Amendment No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;--</td>
							<td style="border-bottom: 1px solid;text-align: right;border-left: 1px solid;">&nbsp;Group :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;-</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Amendment Date :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp; Building Materials</td>
							<td style="border-bottom: 1px solid;text-align: right;border-left: 1px solid;">&nbsp;Discipline :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;Mechanical</td>
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
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;width: 24.9%;font-weight: bold;">&nbsp;Customer Name & Address :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
							</tr>
						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Agency Name :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
							</tr>
						<?php }
						if ($row_select['tpi_name'] != "") {
						?>

							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Consultants :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Agreement No :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
							</tr>
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Project Name :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
							</tr>
						<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;">&nbsp;To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Size Of Block :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;(<?php echo $in_l; ?> X <?php echo $in_w; ?> X <?php echo $in_h; ?>) </td>
					</tr>
					
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Density :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $in_den; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $in_grade; ?></td>
					</tr>
					
				</table>
				
			</td>
		</tr>
	</table>
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-left:2px solid; border-right:2px solid;border-top: 0;">
			<tr>
				<td  colspan="5"  style="border: 0px solid black; font-weight:bold; text-align:center;border-bottom: 1px solid black;">TEST RESULT</td>	
				
			</tr>
	</table>
	<?php $cnt=1;?>
	<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;">
                        <tr>
                            <td style="text-align:center; font-size:11px;padding-top:5px;padding-bottom:5px;border-left: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black; " colspan=9><b><u>Concrete Block Dimensional Analysis</u></b></td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;width:7%;font-weight:bold;text-align:center; "> Sr. No.</td>
                            <td style="border-left: 1px solid black;width:17%;text-align:center;font-weight:bold; padding-top:5px;padding-bottom:5px;">Lab ID </td>
                            <td style="border-left: 1px solid black;width:18%;font-weight:bold;text-align:center; " colspan=3>Block Size(mm)</td>
                            <td style="border-left: 1px solid black;width:45%;font-weight:bold;text-align:center; " colspan=3> <input type="text" value="As per IS 2185 (Part-III) Requirement" style="border:0;width:95%;text-align:center;font-size:11px;font-family:Times New Roman;font-weight:bold;"><br></td>
                            <td style="border-left: 1px solid black;border-right: 1px solid black;width:20%;font-weight:bold;text-align:center; " rowspan=2>Block ID</td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; padding-bottom:3px;padding-top:3px;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;font-weight:bold;text-align:center; padding-top:5px;padding-bottom:5px; ">L</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;font-weight:bold;text-align:center; ">B</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;font-weight:bold;text-align:center; ">H</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;text-align:center; " >Length</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;text-align:center; " >Width</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;text-align:center; " >Height</td>
                        </tr>
                       
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;text-align:center;font-weight:bold;" rowspan=24>600mm &plusmn; <br>5mm</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;text-align:center;font-weight:bold;" rowspan=24>230mm &plusmn; <br>3mm</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;text-align:center;font-weight:bold;" rowspan=24>230mm &plusmn; <br>3mm</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block1']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block2']; ?></td>
                        </tr>

                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block3']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l4']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w4']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h4']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block4']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:1%;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l5']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w5']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h5']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block5']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l6']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w6']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h6']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block6']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l7']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w7']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h7']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block7']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l8']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w8']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h8']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block8']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l9']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w9']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h9']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block9']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l10']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w10']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h10']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block10']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l11']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w11']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h11']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block11']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l12']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w12']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h12']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block12']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l13']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w13']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h13']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block13']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l14']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w14']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h14']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block14']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l15']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w15']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h15']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block15']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l16']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w16']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h16']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block16']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l17']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w17']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h17']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block17']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l18']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w18']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h18']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block18']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l19']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w19']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h19']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block19']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l20']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w20']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h20']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block20']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l21']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w21']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h21']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block21']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><?php echo $row_select_pipe['dim_l22']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"> <?php echo $row_select_pipe['dim_w22']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"> <?php echo $row_select_pipe['dim_h22']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block22']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l23']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w23']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h23']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block23']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding-bottom:3px;padding-top:3px;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><input type="text" value="<?php $newj = explode("ICT/RPT/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l24']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w24']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h24']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;	border-right:1px solid;padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dim_block24']; ?></td>
                        </tr>


                    </table>
		
		<!-- footer design ->
		
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
							<td style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 1 of 2</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>


	<div class="pagebreak"></div>
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">TEST REPORT - AAC BLOCK</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
							<td style="width: 14%;padding: 0 2px;text-align: right;">&nbsp;Sample ID No :-</td>
							<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $lab_no; ?></td>
							<td style="text-align: center;border-left: 1px solid;text-align: right;">&nbsp;Report Date :-</td>
							<td style="padding: 0 2px;text-align: center;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Report No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
							<?php if(strlen($_GET['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;<?php echo $_GET['ulr']; ?></td>
							<?php }else{?>
							<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">&nbsp;</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;</td>
							<?php }?>
						</tr>
					<!--STATIC AMENDMENT NO AND DATE->
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Amendment No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;--</td>
							<td style="border-bottom: 1px solid;text-align: right;border-left: 1px solid;">&nbsp;Group :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;-</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Amendment Date :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp; Building Materials</td>
							<td style="border-bottom: 1px solid;text-align: right;border-left: 1px solid;">&nbsp;Discipline :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;Mechanical</td>
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
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;width: 24.9%;font-weight: bold;">&nbsp;Customer Name & Address :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
							</tr>
						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Agency Name :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
							</tr>
						<?php }
						if ($row_select['tpi_name'] != "") {
						?>

							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Consultants :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Agreement No :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
							</tr>
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Project Name :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
							</tr>
						<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
					</td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;">&nbsp;To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Size Of Block :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;(<?php echo $in_l; ?> X <?php echo $in_w; ?> X <?php echo $in_h; ?>) </td>
					</tr>
					
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Density :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $in_den; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $in_grade; ?></td>
					</tr>
					
				</table>
				
			</td>
		</tr>
	<tr>
			<!-- header part ->
			<td>
	<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:3px;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">
						<tr>
							<td style="text-align:center; font-size:11px;margin-bottom;border-bottom:1px solid;border-left:1px solid;padding-top:8px;padding-bottom:8px;" colspan="11" ><b><u>Concrete Block Density Test</u></b></td>
						</tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;width:7%;font-weight:bold; text-align:center;padding-bottom:2px;padding-top:2px;  ">Sr.No.</td>
                            <td style="border-left: 1px solid black;width:12%;text-align:center;font-weight:bold; ">Lab ID</td>
                            <td style="border-left: 1px solid black;width:21%;text-align:center;font-weight:bold; " colspan=3>Block Size(mm) </td>
                            <td style="border-left: 1px solid black;width:12%;text-align:center;font-weight:bold; ">Volume(m&sup3;)</td>
                            <td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Saturated Weight</td>
                            <td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Wet Density</td>
                            <td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Dry Weight</td>
                            <td style="border-left: 1px solid black;width:8%;text-align:center;font-weight:bold;padding-bottom:2px;padding-top:2px; ">Moisture Content</td>
                            <td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Dry Density</td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top	: 1px solid black;font-weight:bold; text-align:center;  "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;font-weight:bold; "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; font-weight:bold;padding-bottom:2px;padding-top:2px;">L</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;font-weight:bold; ">B</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;font-weight:bold; ">H</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;font-weight:bold; ">L &times; B &times; H</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;font-weight:bold; ">Kg</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;font-weight:bold; ">kg/m&sup3;</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;font-weight:bold; ">Kg</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;font-weight:bold; ">%</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;font-weight:bold; ">kg/m&sup3;</td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top	: 1px solid black; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dl_1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['dw_1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['dh_1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo substr($row_select_pipe['vol_1'] / 1000000, 0, 7); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo ($row_select_pipe['weight_1'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo ($row_select_pipe['den_1'] * 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo ($row_select_pipe['w1'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php if ($row_select_pipe['wa_1'] != "") {
                                                                                                                                    echo $row_select_pipe['wa_1'];
                                                                                                                                } else {
                                                                                                                                    echo "-";
                                                                                                                                } ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo substr(($row_select_pipe['w1'] / 1000) / ($row_select_pipe['vol_1'] / 1000000), 0, 6); ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top	: 1px solid black;text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dl_2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['dw_2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['dh_2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo substr($row_select_pipe['vol_2'] / 1000000, 0, 7); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo ($row_select_pipe['weight_2'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo ($row_select_pipe['den_2'] * 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo ($row_select_pipe['w2'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php if ($row_select_pipe['wa_2'] != "") {
                                                                                                                                    echo $row_select_pipe['wa_2'];
                                                                                                                                } else {
                                                                                                                                    echo "-";
                                                                                                                                } ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo substr(($row_select_pipe['w2'] / 1000) / ($row_select_pipe['vol_2'] / 1000000), 0, 6); ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top	: 1px solid black;text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px;"><?php echo $row_select_pipe['dl_3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['dw_3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['dh_3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo substr($row_select_pipe['vol_3'] / 1000000, 0, 7); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo ($row_select_pipe['weight_3'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo ($row_select_pipe['den_3'] * 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo ($row_select_pipe['w3'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php if ($row_select_pipe['wa_3'] != "") {
                                                                                                                                    echo $row_select_pipe['wa_3'];
                                                                                                                                } else {
                                                                                                                                    echo "-";
                                                                                                                                } ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo substr(($row_select_pipe['w3'] / 1000) / ($row_select_pipe['vol_3'] / 1000000), 0, 6); ?></td>
                        </tr>


                    </table>
				
		</td>
		</tr>		
				<tr>
                <td style="text-align:center;font-size:11px; "><br>
                    <table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;">
                        <tr>
                            <td style="text-align:center; font-size:11px;border-left: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;padding-top:8px;padding-bottom:8px;" colspan=7><b><u>Concrete Block Compressive Strength Test</u></b></td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;width:10%;font-weight:bold;text-align:center; "> Sr. No.</td>
                            <td style="border-left: 1px solid black;width:15%;text-align:center;font-weight:bold; padding-top:5px;padding-bottom:5px;">Lab ID</td>
                            <td style="border-left: 1px solid black;width:20%;font-weight:bold;text-align:center; " colspan=2>Block Size(mm)</td>
                            <td style="border-left: 1px solid black;width:18%;font-weight:bold;text-align:center; ">Load</td>
                            <td style="border-left: 1px solid black;width:16%;font-weight:bold;text-align:center; ">Compressive Strength</td>
                            <td style="border-left: 1px solid black;border-right: 1px solid black;width:22%;font-weight:bold;text-align:center; ">Average</td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;font-weight:bold;text-align:center; "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;font-weight:bold;text-align:center; padding-top:5px;padding-bottom:5px; ">L</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;font-weight:bold;text-align:center; ">B</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;font-weight:bold;text-align:center; ">kN</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;font-weight:bold;text-align:center; ">N/mm&sup2;</td>
                            <td style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;width:22%;font-weight:bold;text-align:center; ">N/mm&sup2;</td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_1']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_1']; ?></td>
                            <td style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;text-align:center;font-weight:bold;" rowspan=12><?php echo $row_select_pipe['avg_com']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_2']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_2']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_3']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_3']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_4']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_4']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_4']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_4']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_5']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_5']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_5']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_5']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/0".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_6']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_6']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_6']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_6']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_7']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_7']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_7']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_7']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_8']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_8']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_8']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_8']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_9']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_9']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_9']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_9']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_10']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_10']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_10']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_10']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_11']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_11']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_11']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_11']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><input type="text" value="<?php $newj = explode("/GP/",$report_no);echo $newj[1]."/".$lab_id++;?>" style="border:0;font-size:11px;font-family:Times New Roman;text-align:center;width:95%;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding-bottom:2px;padding-top:2px; "><?php echo $row_select_pipe['l_12']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['w_12']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['load_12']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; "><?php echo $row_select_pipe['com_12']; ?></td>
                        </tr>
                    </table><br>
                </td>

            </tr>
	
		
		
		<!-- footer design ->
		
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
							<td style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 2 of 2</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
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
		</table> -->

		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


		</div>
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