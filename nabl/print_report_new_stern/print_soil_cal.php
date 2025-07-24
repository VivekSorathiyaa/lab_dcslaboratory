
<?php
session_start();
include("../connection.php");
include("function_calling.php");
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
	$select_tiles_query = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	$page_cont = round_up($no_of_rows / 5);
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
			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['fine_aggregate_source'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
		$chainage_no = $row_select4['chainage_no'];
		$fdd_desc_sample = $row_select4['fdd_desc_sample'];
	}


	// if ($row_select_pipe['iscompaction'] == "1") {

		// $flag = 0;
		// $a = 1;
		// $down = 0;
		// $up = 5;
		// for ($a = 1; $a <= $page_cont; $a++) {

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
							<td style="width: 58.5%;padding: 0 2px;text-align: right;">&nbsp;Discipline:- Mechanical</td>
							<td style="padding: 0 2px;width:45%;text-align: right;">&nbsp;Date:<?php echo date('d/m/Y', strtotime($issue_date));?></td>
						</tr>
						
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 100%;padding: 0 2px;text-align: center;">&nbsp;Group:- Building Materials</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF FDD BY SAND REPLACEMENT
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
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Type of Material </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $fdd_desc_sample; ?></td>
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
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Type of Material :-</td>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;<?php echo $fdd_desc_sample; ?></td>
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
                <td style="font-size:11px;text-align:right;font-weight:bold;padding:3px 0px;width:9%" colspan="8"> IS: 2720(Part-28)1974</td>
            </tr>
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Lab No.</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Chainage</td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">MDD</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">OMC</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Wet Density of Soil</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Moisture <br>Content</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Dry Density <br>of Soil</td>
                <td style="border-RIGHt:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">COMPACTION</td>
            </tr>
			
			
			<?php $cnt=1;?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">-</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">-</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">gm/cc</td>
                <td style="font-size:11px;text-align:center;border-left:1px solid black;border-TOP:1px solid black;padding:3px 0px;border-bottom:0px;">%</td>
                <td style="font-size:11px;text-align:center;border-TOP:1px solid black;border-left:1px solid black;padding:3px 0px;border-bottom:0px;">gm/cc</td>
                <td style="font-size:11px;text-align:center;border-TOP:1px solid black;border-left:1px solid black;padding:3px 0px;border-bottom:0px;">%</td>
                <td style="font-size:11px;text-align:center;border-TOP:1px solid black;border-left:1px solid black;padding:3px 0px;border-bottom:0px;">gm/cc</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;">%</td>
            </tr>
			<?php
						$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						// $coming_row = mysqli_num_rows($result_tiles_select1);
						$cnt=1;
						$flag=1;
						$sunoco=0;
						if(mysqli_num_rows($result_tiles_select1)>0){
						while ($row_select_pipe = mysqli_fetch_assoc($result_tiles_select1)) {
							$sunoco += floatval($row_select_pipe['eq_cube1']);
						?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $lab_no;?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">-</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['mdd_1'];?></td>
                <td style="font-size:11px;text-align:center;border-left:1px solid black;border-TOP:1px solid black;padding:3px 0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_moi'];?></td>
                <td style="font-size:11px;text-align:center;border-TOP:1px solid black;border-left:1px solid black;padding:3px 0px;border-bottom:0px;"><?php echo $row_select_pipe['soil_ys_1'];?></td>
                <td style="font-size:11px;text-align:center;border-TOP:1px solid black;border-left:1px solid black;padding:3px 0px;border-bottom:0px;"><?php echo $row_select_pipe['fdd_2'];?></td>
                <td style="font-size:11px;text-align:center;border-TOP:1px solid black;border-left:1px solid black;padding:3px 0px;border-bottom:0px;"><?php echo $row_select_pipe['fdd_3'];?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"><?php echo $row_select_pipe['fdd_4'];?></td>
            </tr>
			<?php
							
						}
						}

						
						?>
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - Reinforced Steel</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
						<td style="width: 14%;padding: 0 2px;">Sample ID No :-</td>
						<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;"><?php echo $job_no; ?></td>
						<td style="text-align: center;border-left: 1px solid;">Report Date :-</td>
						<td style="padding: 0 2px;text-align: center;border-left: 1px solid;"><?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
					</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">Report No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;"><?php echo $report_no; ?></td>
						<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">ULR No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;"><?php echo $_GET['ulr']; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">Amendment No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">--</td>
						<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">Group :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">Building Materials</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">Amendment Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">--</td>
						<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">Discipline :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">Mechanical</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part --
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;width: 24.9%;">Customer Name & Address :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3"><?php echo $clientname; ?></td>
					</tr>
					<?php
						}
						if ($agency_name != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Agency Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3"><?php echo $agency_name; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Consultants :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3">--</td>
					</tr>
					<?php
						// }
						if ($agreement_no != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Agreement No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3"><?php echo $agreement_no; ?></td>
					</tr>
					<?php
						}
						if ($name_of_work != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Project Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3"><?php echo $name_of_work; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3"><?php echo $report_no; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3"><?php echo $mt_name; ?> 
								<?php if ($row_select_pipe["grade"] != "" && $row_select_pipe["grade"] != "null") {
										echo $row_select_pipe["grade"];
										}?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3"><?php echo $rec_sample_date; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3"><?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;"> To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;"><?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3"><?php echo $source; ?>--</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">Test Method :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3">IS : 1786 : 2008, Reaffirmed :2018, IS : 1608 (Part-1) :2022 & IS :1599:2019 </td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;">IS Code Specification :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;" colspan="3">IS : 1786 :2008, Reaffirmed : 2018</td>
					</tr>
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>


					<!-- <tr>
						<td style="text-align:center;font-size:12px; ">

							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;">

								<tr style="">

									<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Authority</td>
									<td style="border-left: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																														$result_selectc = mysqli_query($conn, $select_queryc);

																														if (mysqli_num_rows($result_selectc) > 0) {
																															$row_selectc = mysqli_fetch_assoc($result_selectc);
																															$ct_nm = $row_selectc['city_name'];
																														}
																														echo $clientname; ?></td>
									<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
									<td style="border-left: 1px solid black;border-right: 1px solid;width:19%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
								</tr>

								<tr style="">

									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp;Name of Work</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
								</tr>
								<tr style="">

									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  "></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; "></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; ULR No.</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
								</tr>

								<tr style="">

									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Consultant</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select['pmc_name']; ?></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
								</tr>

								<tr style="">

									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Agency</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
								</tr>

								<tr style="">

									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Received Date</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($start_date)); ?></td>
								</tr>


							</table><br>

						</td>
					</tr>
					<tr>
						<td style="text-align:center;font-size:12px; ">

							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

								<tr style="">
									<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:left;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Material under Testing</td>
									<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; GSB Layer</td>

								</tr>
								<tr style="">
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;&nbsp;Source/Location</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php if ($material_location == 1) {
																																						echo "In Laboratory";
																																					} else {
																																						echo "In Field";
																																					} ?></td>
								</tr>
								<tr style="">
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;&nbsp;No.of Sample</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select_pipe['fdd_qty']; ?></td>
								</tr>
								<tr style="">
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;&nbsp;Method Adopted</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IS:2720(Part-28) - 1974</td>
								</tr>

							</table><br>

						</td>
					</tr> 
					<tr>
    <td style="text-align: left; font-size: 11px;">
        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size: 11px; font-family : Calibri;" class="test">
            <tr>
                <td style="width: 60%; text-align: left; font-weight: bold; padding: 8px 0;">
                    A) Test Results:
                </td>
            </tr>
        </table>
    </td>
</tr>

					<?php $cnt = 1; ?>
					<tr>
						<td>
							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;margin-top:0px;">

								<tr style="">
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Lab NO.</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Particulars</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">MDD g/cc</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OMC (%)</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Field Moisture Content %</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Field Density g/cc</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Compaction %</td>
								</tr>
								
								<tr style="">
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $lab_no; ?></td>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $material_location; ?></td>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $row_select_pipe['cal_mdd']; ?></td>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;">-</td>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php if ($row_select_pipe['mc_od'] != "") { echo $row_select_pipe['mc_od']; } else { echo $row_select_pipe['mc_od']; } ?></td>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php if ($row_select_pipe['d7'] != "" && $row_select_pipe['d7'] != "0" && $row_select_pipe['d7'] != null) {
																			echo $row_select_pipe['d7'];
																		} else {
																			echo "-";
																		} ?></td>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $row_select_pipe['d8']; ?></td>
								</tr>
							</table>

						</td>
					</tr>

					<tr>
							<td style="text-align:center;font-size:11px; ">
									<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family : Calibri;" class="test">
											<tr>
												<td style="width:60%;text-align:center;font-weight:bold;padding:7px 0;">
														** End of Report ** 
												</td>																		
											</tr>
									</table>
							</td>		
					</tr>


					<tr>
						<td style="text-align:center;font-size:11px;">
								<table align="center" width="100%" class="test" style="height:auto;font-family : Calibri;border-top:1px solid black;border-bottom:1px solid black;">
								<tr>
										<td style= "font-size:11px;padding:3px 0;">Note :-</td>
										<td></td>
									</tr>

							
							
									<tr>
										<td style="font-size:11px;padding:3px 0;">1. &nbsp;The test report shall not be reproduced except in full , without written approval of the laboratory.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:11px;padding:3px 0;">2. &nbsp;Manglam Consultancy Services is not responsible for any kind of interpretation of test results.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:11px;padding:3px 0;">3. &nbsp;The results/Report are not used for publicity.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:11px;padding:3px 0;">4. &nbsp;*As informed by Customer/Agency.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:11px;width:50%;padding:3px 0;"></td>
										<td style="text-align:center;width:15%;font-style:italic;"><b>Reviewed & Authorized By</b></td>
									</tr>
									<tr><td><br></td></tr>
									<tr><td><br></td></tr>
									<tr><td><br></td></tr>
							
									<tr>
									<td></td>
										<td style="text-align:center;font-style:italic;"><b>(<?php echo naming($row_select['branch_short_code'],$conn);?>)</b></td>
									</tr>
								
									<tr>
									<td></td>
										<td style="text-align:center;font-style:italic;padding:3px 0;"><b>Director/T.M.</b></td>
									</tr>
									
								</table>
						</td>
					</tr>
				</table>


				<table width="100%" align="center" style="font-family:Times New Roman;font-size:11px;">
						<tr>
							<td style="width:40%;text-align:right;;font-style:italic;font-size:12px;">
								MCS Page 1/1
							</td>
						</tr>
		        </table>


				
				<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


				</div>
			</page>
			<?php

			if ($flag == 5) {
				$flag = 0;
				$down = $up;
				$up += 5;
			?>



				<div class="pagebreak"> </div>
			<?php //}
		//}

	} else {


		//second
		if ($row_select['nabl_type'] == "nabl") {
			?>
			
			<br><br>
		<?php
		}
		?>


		
			<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"->
			
		<page size="A4">
		<?php if (($row_select_pipe['chainage_no'] != "" && $row_select_pipe['chainage_no'] != "0" && $row_select_pipe['chainage_no'] != null) || ($row_select_pipe['mdd_1'] != "" && $row_select_pipe['mdd_1'] != "0" && $row_select_pipe['mdd_1'] != null) || ($row_select_pipe['avg_moi'] != "" && $row_select_pipe['avg_moi'] != "0" && $row_select_pipe['avg_moi'] != null) || ($row_select_pipe['avg_dry'] != "" && $row_select_pipe['avg_dry'] != "0" && $row_select_pipe['avg_dry'] != null) || ($row_select_pipe['fdd_4'] != "" && $row_select_pipe['fdd_4'] != "0" && $row_select_pipe['fdd_4'] != null)) { ?>	
			<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - OBSERVATION OF CONCRETE SAND REPLACEMENT</td>
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
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Description :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['fdd_desc_sample'];?></td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Chainage No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['chainage_no']; ?></td>
					</tr>
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>



			<td style="text-align: left; font-size: 11px;">
        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size: 11px; font-family : Calibri;" class="test">
            <tr>
                <td style="width: 60%; text-align: left; font-weight: bold; padding: 8px 0;border-left: 2px solid black;border-RIGHt: 2px solid black;text-align:center;font-weight:bold;padding:10px 4px;font-size: 12px;">
                    A) Test Results:
                </td>
            </tr>
        </table>
    </td>
</tr>
		


				<?php $cnt = 1; ?>
				<tr>
						<td>
							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:2px solid;border-left:1px solid;">

								<tr style="">
								
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Lab NO.</td>
									<?php if ($row_select_pipe['chainage_no'] != "" && $row_select_pipe['chainage_no'] != "0" && $row_select_pipe['chainage_no'] != null) { ?>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Particulars</td>
									<?php } if (($row_select_pipe['mdd_1'] != "" && $row_select_pipe['mdd_1'] != "0" && $row_select_pipe['mdd_1'] != null)) { ?>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">MDD g/cc</td>
									<?php } if (($row_select_pipe['avg_moi'] != "" && $row_select_pipe['avg_moi'] != "0" && $row_select_pipe['avg_moi'] != null)) { ?>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Field Moisture Content %</td>
									<?php } if (($row_select_pipe['avg_dry'] != "" && $row_select_pipe['avg_dry'] != "0" && $row_select_pipe['avg_dry'] != null)) { ?>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Field Density g/cc</td>
									<?php } if (($row_select_pipe['fdd_4'] != "" && $row_select_pipe['fdd_4'] != "0" && $row_select_pipe['fdd_4'] != null)) { ?>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Compaction %</td>
									<?php } ?>
								</tr>
								
								<tr style="">
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $lab_no; ?></td>
	<?php if ($row_select_pipe['chainage_no'] != "" && $row_select_pipe['chainage_no'] != "0" && $row_select_pipe['chainage_no'] != null) { ?>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $row_select_pipe['chainage_no']; ?></td>
	<?php } if (($row_select_pipe['mdd_1'] != "" && $row_select_pipe['mdd_1'] != "0" && $row_select_pipe['mdd_1'] != null)) { ?>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $row_select_pipe['mdd_1']; ?></td>
	<?php } if (($row_select_pipe['avg_moi'] != "" && $row_select_pipe['avg_moi'] != "0" && $row_select_pipe['avg_moi'] != null)) { ?>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php
																																	if ($row_select_pipe['avg_moi'] != "") {

																																		echo $row_select_pipe['avg_moi'];
																																	} else {
																																		echo $row_select_pipe['mc_od'];
																																	}
																																	?></td>
	<?php } if (($row_select_pipe['avg_dry'] != "" && $row_select_pipe['avg_dry'] != "0" && $row_select_pipe['avg_dry'] != null)) { ?>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $row_select_pipe['avg_dry']; ?></td>
	<?php } if (($row_select_pipe['fdd_4'] != "" && $row_select_pipe['fdd_4'] != "0" && $row_select_pipe['fdd_4'] != null)) { ?>
									<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $row_select_pipe['fdd_4']; ?></td>
	<?php } ?>
								</tr>
							</table>

						</td>
					</tr>

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

		</table>-->
		</page>
















	<?php
	} }
	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>