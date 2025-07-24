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
		width: 29.7cm;
		height: 21cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 10px;
		font-family : Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family : Calibri;

	}

	.tdclass1 {

		
		font-family : Calibri;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from ceramic_tiles WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);


	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$agreement_no = $row_select['agreement_no'];
	$cons = $row_select['condition_of_sample_receved'];
	// $job_no= $row_select['job_no'];			
	if ($cons == 0) {
		$con_sample = "Sealed Ok";
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
		$source = $row_select4['agg_source'];
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$brand = $row_select4['water_brand'];
		$speci = $row_select4['water_specification'];
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF CERAMIC TILE
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
		<td style="padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Location</td>
							<td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php if ($material_location == 1) {echo "In Laboratory";} else {echo "In Field";} ?></td>
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
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;TYPE</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $mt_name;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>600 X 600<?php echo $mark; ?></td>
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
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Type</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $mt_name;?></td>
						</tr>
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;Sample Collected by the Supplier</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Job No. :- </td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $job_no;?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark :-</td>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;600 X 600<?php echo $mark; ?></td>
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
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Sr. No.</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Test</td>                            
                <td style="border-top:1px solid;border-right:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Result</td>
            </tr>
			<?php $cnt=1;?>
			<?php
			
			if ($row_select_pipe['avg_1'] != "" && $row_select_pipe['avg_1'] != null && $row_select_pipe['avg_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;width:10%;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;width:50%;">Length (mm)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;width:40%;"><?php echo $row_select_pipe['avg_1'];?></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Width (mm)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"><?php echo $row_select_pipe['avg_2'];?></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Thickness (mm)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"><?php echo $row_select_pipe['avg_3'];?></td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Water Absorption (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"><?php echo $row_select_pipe['avg_wtr'];?></td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['avg_s'] != "" && $row_select_pipe['avg_s'] != null && $row_select_pipe['avg_s'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Flexural Strength (N/mm<sup>2</sup>)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"><?php echo $row_select_pipe['avg_s'];?></td>
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report -  PHYSICAL PROPERTIES OF CERAMIC TILES</td>
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
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Specification :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['water_specification'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Brand :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['water_brand'];?></td>
					</tr>
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>

			<!-- <tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;">

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
						<tr style="">

							<td style="border-top: 1px solid black;border-left: 1px solid black;width:11%;font-weight:bold;">&nbsp; </td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;</td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;width:11%; font-weight:bold; ">&nbsp; ULR No.</td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp;Name of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Agency</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Agreement No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:center;padding-bottom:2px;padding-top:2px; ">Material Under Testing</td>
							<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; Ceramic Tiles ( 300 * 300 mm )</td>

						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  "> Brand</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; RAK Tiles</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 10</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">Test Method Adopted</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IS - 13630 - 1983</td>
						</tr>

					</table><br>

				</td>
			</tr> ->

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:2px solid;border-left:1px solid;">
						<tr style="">
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sr No.</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" colspan=2>Name of Test</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;width:27%;">Test Results</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"> Acceptance Criteria As per IS <br> 15622-2017 (B-I a)</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Test Method</td>
						</tr>
						
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2><b>Dimesion</b></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px; "></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">a</td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in Length (%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avg_1'] != "" && $row_select_pipe['avg_1'] != null && $row_select_pipe['avg_1'] != "0") {
																																					echo $row_select_pipe['avg_1'];
																																				} else {
																																					echo "-";
																																				} ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan=2>Max &plusmn; 0.1 %</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan=3>IS 13630 Part-1</td>
						</tr>
						


						<tr>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">b</td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in Thickness (%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avg_3'] != "" && $row_select_pipe['avg_3'] != null && $row_select_pipe['avg_3'] != "0") {
																																						echo $row_select_pipe['avg_3'];
																																					} else {
																																						echo "-";
																																					} ?></td>
						</tr>


						<tr>
						<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">c</td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Deviation in Width (%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avg_2'] != "" && $row_select_pipe['avg_2'] != null && $row_select_pipe['avg_2'] != "0") {
																																						echo $row_select_pipe['avg_2'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Max &plusmn; 5 %</td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2><b>Deviation in  straightness of sides (%)</b></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $row_select_pipe['avgstr'] ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Max &plusmn; 0.1%</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">IS 13630 Part-1</td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2><B>Deviation in Rectangularity (%)</B></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $row_select_pipe['avgrec'] ?></td>
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Min, lOOO N</td> ->
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Max &plusmn; 0.1%</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">IS 13630 Part-1</td>
						</tr>



						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2><b>Modulus of Rupture (N/mm<sup>2</sup>)</b></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan=3>IS 13630 Part-6</td>
						</tr>
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>individual (N/mm<sup>2</sup>)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            <table style="width:100%;border-collapse: collapse;">
							  			    <tr>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['rstr1'] != "" && $row_select_pipe['rstr1'] != null && $row_select_pipe['rstr1'] != "0") { echo $row_select_pipe['rstr1']; } else { echo "-"; } ?></td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['rstr2'] != "" && $row_select_pipe['rstr2'] != null && $row_select_pipe['rstr2'] != "0") { echo $row_select_pipe['rstr2']; } else { echo "-"; } ?></td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['rstr3'] != "" && $row_select_pipe['rstr3'] != null && $row_select_pipe['rstr3'] != "0") { echo $row_select_pipe['rstr3']; } else { echo "-"; } ?></td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['rstr4'] != "" && $row_select_pipe['rstr4'] != null && $row_select_pipe['rstr4'] != "0") { echo $row_select_pipe['rstr4']; } else { echo "-"; } ?></td>
												<td style="font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['rstr5'] != "" && $row_select_pipe['rstr5'] != null && $row_select_pipe['rstr5'] != "0") { echo $row_select_pipe['rstr5']; } else { echo "-"; } ?></td>
											</tr>
										</table>	
							</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> individual 27 N/mm<sup>2</sup>  (Min)</td>
						</tr>
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2><b>Average (N/mm<sup>2</sup>)</b></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['rstr5'] != "" && $row_select_pipe['rstr5'] != null && $row_select_pipe['rstr5'] != "0") { echo ($row_select_pipe['rstr1'] + $row_select_pipe['rstr2'] + $row_select_pipe['rstr3'] + $row_select_pipe['rstr4'] + $row_select_pipe['rstr5']) / 5; } else { echo "-"; } ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Average 30 N/mm<sup>2</sup>  (Min)</td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px; " colspan=2><b>Water Absorption (%)</b></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan="3">IS 13630 Part-2</td>
						</tr>
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>individual (%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							<table style="width:100%;border-collapse: collapse;">
										    <tr>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['wtr1'] != "" && $row_select_pipe['wtr1'] != null && $row_select_pipe['wtr1'] != "0") { echo $row_select_pipe['wtr1']; } else { echo "-"; } ?></td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['wtr2'] != "" && $row_select_pipe['wtr2'] != null && $row_select_pipe['wtr2'] != "0") { echo $row_select_pipe['wtr2']; } else { echo "-"; } ?></td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['wtr3'] != "" && $row_select_pipe['wtr3'] != null && $row_select_pipe['wtr3'] != "0") { echo $row_select_pipe['wtr3']; } else { echo "-"; } ?></td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['wtr4'] != "" && $row_select_pipe['wtr4'] != null && $row_select_pipe['wtr4'] != "0") { echo $row_select_pipe['wtr4']; } else { echo "-"; } ?></td>
												<td style="font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['wtr5'] != "" && $row_select_pipe['wtr5'] != null && $row_select_pipe['wtr5'] != "0") { echo $row_select_pipe['wtr5']; } else { echo "-"; } ?></td>
											</tr>
										</table>		
										</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> individual 3.3% (Max)</td>
						</tr>
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2><b>Average (%)</b></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['wtr5'] != "" && $row_select_pipe['wtr5'] != null && $row_select_pipe['wtr5'] != "0") { echo ($row_select_pipe['wtr1'] + $row_select_pipe['wtr2'] + $row_select_pipe['wtr3'] + $row_select_pipe['wtr4'] + $row_select_pipe['wtr5']) / 5; } else { echo "-"; } ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Average 0.08% to &le; 3%</td>
						</tr>



						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2><b>Breaking Strength (N)</b></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan="4">IS 13630 Part-6</td>
						</tr>
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>individual (N)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            <table style="width:100%;border-collapse: collapse;">
										    <tr>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['str1'] != "" && $row_select_pipe['str1'] != null && $row_select_pipe['str1'] != "0") { echo $row_select_pipe['str1']; } else { echo "-"; } ?></td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['str2'] != "" && $row_select_pipe['str2'] != null && $row_select_pipe['str2'] != "0") { echo $row_select_pipe['str2']; } else { echo "-"; } ?></td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['str3'] != "" && $row_select_pipe['str3'] != null && $row_select_pipe['str3'] != "0") { echo $row_select_pipe['str3']; } else { echo "-"; } ?></td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['str4'] != "" && $row_select_pipe['str4'] != null && $row_select_pipe['str4'] != "0") { echo $row_select_pipe['str4']; } else { echo "-"; } ?></td>
												<td style="font-size:11px;text-align:center;padding:4px 4px;width:20%;"><?php if ($row_select_pipe['str5'] != "" && $row_select_pipe['str5'] != null && $row_select_pipe['str5'] != "0") { echo $row_select_pipe['str5']; } else { echo "-"; } ?></td>
											</tr>
										</table>																												</td>
							<!-- <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Min, lOOO N</td> ->
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
						</tr> 
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2 rowspan=2><b>Average (N)</b></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" rowspan=2><?php if ($row_select_pipe['str5'] != "" && $row_select_pipe['str5'] != null && $row_select_pipe['str5'] != "0") { echo ($row_select_pipe['str1'] + $row_select_pipe['str2'] + $row_select_pipe['str3'] + $row_select_pipe['str4'] + $row_select_pipe['str5']) / 5; } else { echo "-"; } ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> > 700 N for Thickness < 7.5 mm</td>
						</tr>
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> > 1100 N for Thickness &ge; 7.5 mm</td>
						</tr>



						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Resistance to Surface Abration</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px; ">I</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Class II,Min.</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
						</tr>
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;" colspan=2>Scretch Hardness of Surface</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avghrd'] != "" && $row_select_pipe['avghrd'] != null && $row_select_pipe['avghrd'] != "0") {
																																						echo $row_select_pipe['avghrd'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Min.5 Mohs</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Mohs</td>
						</tr>
					</table>
				</td>
			</tr>


			<!-- <tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:10%;font-weight:bold; text-align:center;padding-bottom:1px;padding-top:1px;  ">Sr.No.</td>
							<td style="border-left: 1px solid black;width:24%;text-align:center;font-weight:bold; " colspan=2>Test Description</td>
							<td style="border-left: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">Unit</td>
							<td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Test Results</td>
							<td style="border-left: 1px solid black;width:13.5%;text-align:center;font-weight:bold;padding-bottom:10px;padding-top:10px; ">Test Requirements <br>IS-13801-1993</td>
							<td style="border-left: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">Test Method</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;" rowspan=2><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; " rowspan=2>Dimesion</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; padding-bottom:6px;padding-top:6px; ">Length</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; " rowspan=2>mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_1'] != "" && $row_select_pipe['avg_1'] != null && $row_select_pipe['avg_1'] != "0") {
																																					echo $row_select_pipe['avg_1'];
																																				} else {
																																					echo "-";
																																				} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">300 &plusmn; 1</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; " rowspan=5>IS 13630 Part:1 to Part:15</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; padding-bottom:6px;padding-top:6px; ">Width</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_2'] != "" && $row_select_pipe['avg_2'] != null && $row_select_pipe['avg_2'] != "0") {
																																						echo $row_select_pipe['avg_2'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">300 &plusmn; 1</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; " colspan=2>Water Absorption</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; padding-bottom:6px;padding-top:6px; ">%</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0") {
																																						echo $row_select_pipe['avg_wtr'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">301.0</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; " colspan=2>Modulus of Rupture</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; padding-bottom:6px;padding-top:6px; ">N/mm&sup2;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_rstr'] != "" && $row_select_pipe['avg_rstr'] != null && $row_select_pipe['avg_rstr'] != "0") {
																																						echo $row_select_pipe['avg_rstr'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">-</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; " colspan=2>Resistance to Surface Abration</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; padding-bottom:6px;padding-top:6px; ">Class</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">I</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Class I,Min.</td>
						</tr>

					</table>

				</td>
			</tr> ->


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

</body>
</html>


<script type="text/javascript">
</script>