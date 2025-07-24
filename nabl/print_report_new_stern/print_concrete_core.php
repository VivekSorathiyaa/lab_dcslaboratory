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

	@media print {
		#header_hide_show {
			display: none !important;

		}
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
	$select_tiles_query = "select * from concrete_core WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe1 = mysqli_fetch_array($result_tiles_select);
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
		//$source= $row_select4['fine_agg_source'];
		$core_qty = $row_select4['core_qty'];
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF CORE</td>
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
		<td style="padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Location</td>
							<td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php if ($material_location == 1) {echo "In Laboratory";} else {echo "In Field";} ?></td>
    </tr>   
	<tr>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;Type of Material  </td>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Mix CORE</td>
        <td style="text-align: left;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $r_name; ?>&nbsp;&nbsp;<?php
            if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
            ?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
            } else {
            }
        ?></td>
    </tr>
    <tr>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Receipt Sample </td>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
        <td style="padding:2px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;Date <b>&nbsp; : &nbsp;</b> <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
    </tr>
    
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Test Performed </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b>From</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
        <td style="padding:2px;text-align: center;">&nbsp;To</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
         <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $Source;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Enviromental Condition </td>
        <td style="padding:2px;text-align: left;font-weight:bold;" colspan="2"><b>&nbsp; : &nbsp;</b>Temperature</td>
        <td style="padding:2px;text-align: center;"><b>&nbsp; : &nbsp;</b>27˚± 2 ˚c</td>
        <td style="padding:2px;text-align: center;"><b></td>
       <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Quantity from which Sample is Collected </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $no_of_rows;?></td>
         <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Grade </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $row_select_pipe1["amend_date"];?></td>
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
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Type of Material :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;Mix CORE</td>
							<td style="text-align: left;border-left: 1px solid;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
							<td style="padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?></td>
						</tr>
						
						<tr>
							<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Date of Receipt Sample :-</td>
							<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Date :- <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
						</tr>
						
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Date of Test Performed :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;From</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;To</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Identification Mark. :- </td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;-</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Enviromental Condition :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;font-weight:bold;" colspan="2">&nbsp;Temperature :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;" colspan="2">&nbsp;27˚± 2 ˚c</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Job No. :- </td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $job_no;?></td>
						</tr>
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;Sample Collected by the Supplier</td>
							<td style="border-top: 1px solid;border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Lab No. :- </td>
							<td style="border-top: 1px solid;border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $lab_no;?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Quantity from which Sample is Collected</td>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="6">&nbsp;<?php echo $row_select_pipe['eq_cube1']?></td>
							
						</tr>
						
				</table>
				<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;padding-top:20px;padding-bottom:20px;">
						<tr>
							<td style="width: 50%;padding: 0 2px;text-align: left;font-size:15px;">&nbsp;Dimensions Tolerances</td>
						</tr>
						
				</table>-->
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border-bottom: 1px solid;padding-top:20px;">
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"rowspan="2"> Lab No.</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"rowspan="2"> Road No.</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"rowspan="2">Chainage</td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"rowspan="2">Location on Road</td> 
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"rowspan="2">Binder Content (%) <br>Weight of Total Mix</td> 
                <td style="border-top:1px solid;border-right:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">C.D.M. (gm/cc)</td> 
            </tr>
			<tr style="">
                <td style="border-top:1px solid;border-right:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"> as per Test</td>
            </tr>
			
			<?php
						$select_tilesy = "select * from concrete_core WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
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
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $lab_no; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['road_no']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['Chainage']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['location1']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['bic_1']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;border-right:1px solid;"><?php echo $row_select_pipe['den2']?></td>
            </tr>
			<?php
							
						}
						}

						
						?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">IS : 516 - 1959</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;border-right:1px solid;">IS : 516 - 1959</td>
            </tr>
	</table>
	<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border-bottom: 1px solid;padding-top:20px;">
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"> Lab No.</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"> Weight (gm)</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Volume(cc)</td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%;border-right:1px solid;">Density of Core<br>(gm/cc)</td> 
            </tr>
			<?php
						$select_tilesy = "select * from concrete_core WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
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
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $lab_no; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['weight1']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['vol1']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;border-right:1px solid;"><?php echo $row_select_pipe['den1']?></td>
            </tr>
			<?php
							
						}
						}

						
						?>
	</table>-->
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
	<!--<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - concrete core</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
							<td style="width: 22%;padding: 0 2px;text-align: left;">&nbsp;Sample ID No :-</td>
							<td style="padding: 0 2px;border-left: 1px solid;width:37.6%;">&nbsp;<?php echo $lab_no; ?></td>
							<td style="text-align: left;border-left: 1px solid;text-align: left;width:11%;">&nbsp;Report Date :-</td>
							<td style="text-align: left;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>
				</table>
				<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:22%;">&nbsp;Report No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;width:37.6%;">&nbsp;<?php echo $report_no; ?></td>
							<?php if(strlen($ans['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $ans['ulr']; ?></td>
							<?php }else{?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;</td>
							<?php }?>
						</tr>
					<!--STATIC AMENDMENT NO AND DATE->
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Amendment No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;--</td>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Group :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Building Materials</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Amendment Date :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp; --</td>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Discipline :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Mechanical</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part ->
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;width: 22%;font-weight: bold;">&nbsp;Customer Name & Address :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
							</tr>
						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agency Name :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
							</tr>
						<?php }
						if ($row_select['tpi_name'] != "") {
						?>

							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Consultants :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agreement No :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
							</tr>
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Project Name :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
							</tr>
						<?php } ?>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					<tr>
						<td style="border: 1px solid;padding: 1px 0;text-align: left;" colspan="4"></td>
						
					</tr>
					
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;font-weight: bold;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;width:5%;font-weight: bold;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 0px solid;text-align: left;font-weight: bold;"colspan="2">&nbsp;To &nbsp; <?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $source; ?></td>
					</tr>->
					<tr>
						<td style="padding: 1px ;border-top:1px solid black;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>



		<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:11px;">
				    <table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:0px solid;border-right:1px solid; border-left:2px solid black; border-right:2px solid black;">

						<tr style="">
							<td style="width:5%;border-top:0px solid;font-size:11px;border-left: 0px solid black;text-align:center;font-weight:bold;padding:5px 4px;" rowspan=2> Sr.<br>No.</td>
							<td rowspan=2 style="width:5%; border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Specimen Identification</td>
							<td style="width:10%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Diameter of Core</td>
							<td style="width:10%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Height of Core</td>
							<td style="width:10%;border-top:px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Cross Sectional Area</td>
							<td style="width:10%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" >Density of core</td>
							<td style="width:8%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Load</td>
							<td style="width:14%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Measured Compressive Strength</td>
							<td style="width:14%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Corrected Compressive Strength</td>
							<td style="width:14%;border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Equivalent Cube Strength</td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center;">mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px; ">mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">kg/m<sup>3</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">KN</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
						</tr>


						<?php
						$select_tilesy = "select * from concrete_core WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						// $coming_row = mysqli_num_rows($result_tiles_select1);
						$count=0;
						$flag=1;
						$sunoco=0;
						if(mysqli_num_rows($result_tiles_select1)>0){
						while ($row_select_pipe = mysqli_fetch_assoc($result_tiles_select1)) {
							$sunoco += floatval($row_select_pipe['eq_cube1']);
						?>
							<tr style="">
								<td style="border-left: 0px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">Core-<?php echo $count++;?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo $row_select_pipe['dia1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['height1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php echo $row_select_pipe['area1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['den1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['load1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['com1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['corr_com1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['eq_cube1']; ?></td>
								
							</tr>
							<?php
							
						}
						}

						
						?>
							<tr style="">
								<td style="border-left: 0px solid black;border-top: 1px solid black;width:5%;text-align:right;padding-bottom:4px;padding-top:4px; font-weight: bold; border-bottom:0px;" colspan=9 >Average&nbsp:&nbsp </td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:5%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php $ans = $sunoco/$count; echo number_format($ans,2);?></td>
								
								<tr style="">
								<td style="text-align:right;padding-bottom:4px;padding:1px; font-weight: bold; border:1px solid black;" colspan=10 ></td>
								</tr>
							</tr>
					</table>
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
	
	
	<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
	<!--<page size="A4">

		<div id="header">
			<br>
			<br>
		</div>

		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;margin-left:35px; ">
			<tr>
				<td style="text-align:center; font-size:20px; "><b>TEST REPORT</b></td>
			</tr>
		</table>
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;border:1px solid black;margin-left:35px; ">

			<tr style="border: 1px solid black;height:20px;">
				<td width="30%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if ($row_select_pipe1['ulr'] != "" && $row_select_pipe1['ulr'] != "0" && $row_select_pipe1['ulr'] != null) {
																							echo "<b>ULR:</b> " . $row_select_pipe1['ulr'];
																						} ?></td>

				<td width="65%" style="text-align:right; margin:15px;border-bottom: 1px solid black;  "><?php if ($report_no != "" && $report_no != "0" && $report_no != null) {
																											echo " " . $report_no;
																										} ?><b>&nbsp;/&nbsp;Date:</b> <?php echo date('d-m-Y', strtotime($issue_date)); ?>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Report Submited To </b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																						$result_selectc = mysqli_query($conn, $select_queryc);

																						if (mysqli_num_rows($result_selectc) > 0) {
																							$row_selectc = mysqli_fetch_assoc($result_selectc);
																							$ct_nm = $row_selectc['city_name'];
																						}
																						echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Name of <span id="put_details"></span><select style="font-weight:bold;border:0px;font-size:11px;" onchange="put_details()" id="details_of_sample">
							<option>Work</option>
							<option>Project</option>
						</select></b></td>
				<td colspan="2" style="border-bottom: 1px solid black;padding-left:10px ">&nbsp;&nbsp;<?php echo $name_of_work; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Detailes of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo "Concrte Core"; ?> </td>
			</tr>

			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Reference Letter No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php
																						echo $r_name . " Date:" . date('d/m/Y', strtotime($row_select2["letter_date"]));

																						?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Date of Receipt of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Condition of Sample during receipt</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if ($cons == "1") {
																							echo "Sealed";
																						} elseif ($cons == "2") {
																							echo "Unsealed";
																						} elseif ($cons == "3") {
																							echo "Good";
																						} elseif ($cons == "4") {
																							echo "Poor";
																						} else {
																							echo "Sealed";
																						} ?> </td>
			</tr>

			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Name of Agency</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
																						$result_selectc1 = mysqli_query($conn, $select_queryc1);

																						if (mysqli_num_rows($result_selectc1) > 0) {
																							$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																							$ct_nm1 = $row_selectc1['city_name'];
																						}
																						echo $agency_name . " " . $ct_nm1; ?> </td>
			</tr>
			<?php if ($agreement_no != "") { ?>
				<tr style="border: 1px solid black;height:20px;">
					<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Aggrement No.</b></td>
					<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
				</tr>
			<?php } ?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Job No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Lab No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php


																						echo $lab_no;
																						?></td>
			</tr>
			<?php
			$first_tag = $row_select['first_tag'];
			$second_tag = $row_select['second_tag'];
			$third_tag = $row_select['third_tag'];
			$fourth_tag = $row_select['fourth_tag'];

			$first_txt = $row_select['first_txt'];
			$second_txt = $row_select['second_txt'];
			$third_txt = $row_select['third_txt'];
			$fourth_txt = $row_select['fourth_txt'];
			if ($first_tag != null && $first_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $first_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $first_txt; ?></td>
				</tr>
			<?php }
			if ($second_tag != null && $second_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $second_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $second_txt; ?></td>
				</tr>
			<?php }
			if ($third_tag != null && $third_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $third_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $third_txt; ?></td>
				</tr>
			<?php }
			if ($fourth_tag != null && $fourth_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $fourth_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $fourth_txt; ?></td>
				</tr>
			<?php } ?>



			<tr style="border: 1px solid black;height:20px;">
				<td width="35%" style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Starting Date of Test</b></td>
				<td width="20%" style="border-bottom: 1px solid black; border-right: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
			</TR>
			<tr style="border: 1px solid black;height:20px;">
				<td width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black; text-align:LEFT;">&nbsp;&nbsp;<b> Completion Date of Test &nbsp;</b></td>
				<td width="20%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date)); ?></td>
			</tr>

			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Sample Quantity:</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $no_of_rows . " Nos."; ?></td>
			</tr>

			<!--<tr>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp; Dear Sir. <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With the refference to your above letter the test result of Concrete Cubes for compressive strength test for <?php //echo $row_select_pipe['day1'];
																																																																														?> Days as &nbsp; under. The sample are tested as per IS 516(Part 1/Sec 1):2021</td>				
				</tr>>
		</table>
		<br>


		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;border:1px solid black;margin-left:35px; ">
			<tr>
				<td style="font-size:15px;text-align:center"><b><u>Test Result</u></b></td>
			</tr>
			<tr>
				<!--OTHER START>
				<td>
					<table align="center" width="100%" class="test" style="border: 1px solid black;font-size:11px;" cellpadding="3px">
						<tr>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Location of Core</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Weight (gm)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Dia (mm)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Height (mm)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Area (mm<sup>2</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>H/D Ratio</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Volume (m<sup>3</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Density (Kg/m<sup>3</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Load (KN)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Compressive Strength (N/mm<sup>2</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Diameter Correction</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>H/D Correction</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Corrected Comp. Strength</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Equiv.Cube Strength (N/mm<sup>2</sup>)</b></td>

						</tr>
						<?php
						$total_data = 0;
						$select_tiles_query = "select * from concrete_core WHERE `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
						$result_tiles_select = mysqli_query($conn, $select_tiles_query);
						if (mysqli_num_rows($result_tiles_select) > 0) {
							while ($row_select_pipe = mysqli_fetch_array($result_tiles_select)) {
						?>
								<tr>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['location1'] != "" && $row_select_pipe['location1'] != "0" && $row_select_pipe['location1'] != null) {
																								echo $row_select_pipe['location1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['weight1'] != "" && $row_select_pipe['weight1'] != "0" && $row_select_pipe['weight1'] != null) {
																								echo $row_select_pipe['weight1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dia1'] != "" && $row_select_pipe['dia1'] != "0" && $row_select_pipe['dia1'] != null) {
																								echo $row_select_pipe['dia1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['height1'] != "" && $row_select_pipe['height1'] != "0" && $row_select_pipe['height1'] != null) {
																								echo $row_select_pipe['height1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['area1'] != "" && $row_select_pipe['area1'] != "0" && $row_select_pipe['area1'] != null) {
																								echo $row_select_pipe['area1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['hd_ratio1'] != "" && $row_select_pipe['hd_ratio1'] != "0" && $row_select_pipe['hd_ratio1'] != null) {
																								echo $row_select_pipe['hd_ratio1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['vol1'] != "" && $row_select_pipe['vol1'] != "0" && $row_select_pipe['vol1'] != null) {
																								echo $row_select_pipe['vol1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['den1'] != "" && $row_select_pipe['den1'] != "0" && $row_select_pipe['den1'] != null) {
																								echo $row_select_pipe['den1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load1'] != "" && $row_select_pipe['load1'] != "0" && $row_select_pipe['load1'] != null) {
																								echo $row_select_pipe['load1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com1'] != "" && $row_select_pipe['com1'] != "0" && $row_select_pipe['com1'] != null) {
																								echo $row_select_pipe['com1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dia_corr1'] != "" && $row_select_pipe['dia_corr1'] != "0" && $row_select_pipe['dia_corr1'] != null) {
																								echo $row_select_pipe['dia_corr1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['hd_corr1'] != "" && $row_select_pipe['hd_corr1'] != "0" && $row_select_pipe['hd_corr1'] != null) {
																								echo $row_select_pipe['hd_corr1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['corr_com1'] != "" && $row_select_pipe['corr_com1'] != "0" && $row_select_pipe['corr_com1'] != null) {
																								echo $row_select_pipe['corr_com1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['eq_cube1'] != "" && $row_select_pipe['eq_cube1'] != "0" && $row_select_pipe['eq_cube1'] != null) {
																								echo $row_select_pipe['eq_cube1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>

								</tr>
						<?php
								$total_data += floatval($row_select_pipe['eq_cube1']);
							}
						}

						?>
						<tr>
							<td colspan="13" width="5%" style="border: 1px solid black; text-align:right;"><b>Average Equiv.Cube Strength (N/mm<sup>2</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b><?php
																									$ans = $total_data / $no_of_rows;
																									echo number_format($ans, 2);



																									?></b></td>

						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:33%;font-weight:bold;">*** END OF REPORT ***</td>
			</tr>
		</table>

		<br>
		<!--table align="center" width="92%"  class="test" style="border:1px solid black;font-family : Calibri;margin-left:35px; " >
			<tr>
				<td width="60px"><b style="">&nbsp; NOTE:- </b> </td>
				<td><p style="align:justify">[1]Test result related to sample collected by supplier. [2]Results/Report is issued with specific understanding the TMTL will not in any case be involved in action following the interpretation of test results. [3]The Reports/Results are not supposed to be used for publicity.  (4) This report can not be reproduced in full or part without written approval of Quality Manager/ Technical Manager.</p></td>
			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="95%" style="font-family : Calibri;margin-left:35px;">
			<tr>
				<td style="">
					<div style="float:right;" id="footer">

					</div>
				</td>
				<td style="width:25%;">
					<div style="float:right; text-align:center; padding-right:60px;" id="sign">
						<img src="../images/stamp.png" width="160px">
					</div>
				</td>
			</tr>
		</table>
	</page>-->


</body>

</html>
<script src="jquery.min.js"></script>
<script type="text/javascript">
	function header() {
		if (document.querySelector('#header_hide_show').checked) {
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" width="100%">');
			document.getElementById("footer").insertAdjacentHTML("afterbegin", '<img src="../images/stamp_tag.png" width="160px">');
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
		} else {
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
			document.getElementById("footer").innerHTML = '';
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');
		}
	}

	function loading() {

		document.getElementById('header').innerHTML = '';
		document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
		document.getElementById("footer").innerHTML = '';
		document.getElementById('sign').innerHTML = '';
		document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');

	}
</script>