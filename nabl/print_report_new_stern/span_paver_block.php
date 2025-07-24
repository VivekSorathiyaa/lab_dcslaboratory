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
	$select_tiles_query = "select * from span_paver_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$con_sample = "Acceptable";
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
	 $paver_shape = $row_select4['paver_shape'];
        $paver_age = $row_select4['paver_age'];
        $paver_color = $row_select4['paver_color'];
        $paver_thickness = $row_select4['paver_thickness'];
        $paver_grade = $row_select4['paver_grade'];
        $material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
        $material_condition = $row_select4['material_condition'];
	}
		$cnt=1;	
	

 if (($row_select_pipe['chk_abr'] != "" && $row_select_pipe['chk_abr'] != null && $row_select_pipe['chk_abr'] != "0") ||
        ($row_select_pipe['chk_ten'] != "" && $row_select_pipe['chk_ten'] != null && $row_select_pipe['chk_ten'] != "0") ||
        ($row_select_pipe['chk_fle'] != "" && $row_select_pipe['chk_fle'] != null && $row_select_pipe['chk_fle'] != "0")
    ) {
        $totalpage = 2;
    } else {
        $totalpage = 1;
    }

    ?>
    <?php
    if (($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != null && $row_select_pipe['avg_corr'] != "0") || ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0")) { ?>



<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:40px;">
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF PAVER BLOCK
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
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Paver Shape </td>
        <td style="padding:2px;text-align: left;font-weight:bold;" colspan="2"><b>&nbsp; : &nbsp;</b><?php echo $paver_shape;?></td>
        <td style="padding:2px;text-align: center;"><b>&nbsp; : &nbsp;</b>27˚± 2 ˚c</td>
        <td style="padding:2px;text-align: center;"><b></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;paver Color</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $paver_color; ?></td>
    </tr>
	
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $mark; ?></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
</table>				
				
			</td>
		</tr>
		<!--<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - PAVER BLOCK</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
							<td style="width: 21%;padding: 0 2px;text-align: left;">&nbsp;Sample ID No :-</td>
							<td style="padding: 0 2px;border-left: 1px solid;width:36.9%;">&nbsp;<?php echo $lab_no; ?></td>
							<td style="text-align: left;border-left: 1px solid;text-align: left;width:11%;">&nbsp;Report Date :-</td>
							<td style="text-align: left;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>
				</table>
				<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:21%;">&nbsp;Report No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;width:4	0%;">&nbsp;<?php echo $report_no; ?></td>
							<?php if(strlen($row_select_pipe['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $row_select_pipe['ulr']; ?></td>
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
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;width: 21%;font-weight: bold;">&nbsp;Customer Name & Address :-</td>
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
					 <tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Source of Sample & Sample ID :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['paver_shape']." Shape*"; ?></td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Grade of Sample :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['paver_grade']; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px;text-align: left;"colspan="4"></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight:bold;">&nbsp;Method of Test & Specification :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;IS 15658 : 2021</td>
					</tr>
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
					
				
				</table>
				
			</td>
		</tr>-->
	</table>
	<br>
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border-right:1px solid;border-top: 0;">
			<tr>
				<td  colspan="3"  style="font-weight:bold; text-align:left;border-bottom: 1px solid black;"></td>	
				<td  style=" font-weight:bold; text-align:center;border-left:1px solid;border-top:1px solid;border-bottom:1px solid;">IS 15658 : 2006</td>	
				
			</tr>
			<tr style="">
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"> Specimen No.</td>
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Wet Weight of Block <br> (gm) (W1)</td>                            
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Dry Weight of Block <br>(gm) (W2)</td>                            
                
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">% water Absorption W1 - W2 / W2 x 100</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['wtr_w1_1']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['wtr_w2_1']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['wtr_1']?></td>
               
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['wtr_w1_2']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['wtr_w2_2']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['wtr_2']?></td>
               
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['wtr_w1_3']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['wtr_w2_3']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['wtr_3']?></td>
               
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:1px solid;" colspan="3">Avg</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:1px solid;"><?php echo $row_select_pipe['avg_wtr']?></td>
               
            </tr>
			<tr>
				<td  colspan="3"  style="font-weight:bold; text-align:left;"></td>	
				<td  style=" font-weight:bold; text-align:center;border-bottom: 1px solid black;border-left:1px solid;">Max 6%</td>	
				
			</tr>
			
	</table>
	<br>
	<?php $cnt=1?>
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border-right:1px solid;border-top: 0;">
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"> Specimen No.</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Area of Paver Block</td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Load (KN)</td>                            
									  
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Compressive Strength (N/mm2)</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['area_1']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_1']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_1']?></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['area_2']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_2']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_2']?></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['area_3']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_3']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_3']?></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['area_4']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_4']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_4']?></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['area_5']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_5']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_5']?></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['area_6']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_6']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_6']?></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['area_7']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_7']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_7']?></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['area_8']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_8']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_8']?></td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:1px solid;" colspan="3">Avg</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:1px solid;"><?php echo $row_select_pipe['avg_corr']?></td>
               
            </tr>
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
	
	<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:2px solid; border-left:2px solid black; ">

                        <tr style="">
                            <td style="border-top:0px solid;font-size:11px;border-left: 0px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"> Sr.<br>No.</td>
                            <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Identification</td>                            
                            <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Thickness, mm</td>                            
                            
                            <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Plain Surface Area, mm<sup>2</sup></td>
                            <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Failure Load</td>
                            <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9% ">Compressive Strength, Mpa</td>
                            <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9% ">Correction Factor</td>
                            <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9% ">Corrected Comp. Strength, Mpa </td>
                          
                            <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Water Absorption, %</td>
                           
                        </tr>

                        
                        <tr style="">
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['sm1']?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select4['paver_thickness'];?></td>
                            
                            
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != null) {
                                                                                                                                                                                    echo number_format($row_select_pipe['area_1'], 0);
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "-";
                                                                                                                                                                                } ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_1']; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_1']; ?>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php
// Assuming $row_select4['paver_thickness'] contains the value you want to check
$E25 = $row_select4['paver_thickness'];

if ($E25 == 50) {
    $result = "1.03";
} elseif ($E25 == 60) {
    $result = "1.06";
} elseif ($E25 == 80) {
    $result = "1.18";
} else {
    $result = ""; // Default case if none match
}

echo $result; // This will output the corresponding value based on $E25
?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_1']; ?>
                            </td>
                           
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null && $row_select_pipe['wtr_1'] != "NaN") {
                                                                                                                                                                                    echo $row_select_pipe['wtr_1'];
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo " -- ";
                                                                                                                                                                                } ?>
                            </td>
                           
                        </tr>
                        <tr style="">
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['sm2']?></td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select4['paver_thickness'];?></td>
                            
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != null) {
                                                                                                                                                                                    echo number_format($row_select_pipe['area_2'], 0);
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "--";
                                                                                                                                                                                } ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_2']; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_2']; ?>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php
// Assuming $row_select4['paver_thickness'] contains the value you want to check
$E25 = $row_select4['paver_thickness'];

if ($E25 == 50) {
    $result = "1.03";
} elseif ($E25 == 60) {
    $result = "1.06";
} elseif ($E25 == 80) {
    $result = "1.18";
} else {
    $result = ""; // Default case if none match
}

echo $result; // This will output the corresponding value based on $E25
?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_2']; ?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null && $row_select_pipe['wtr_2'] != "NaN") {
                                                                                                                                                                                    echo $row_select_pipe['wtr_2'];
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo " -- ";
                                                                                                                                                                                } ?>
                            </td>
                        </tr>
                        <tr style="">
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['sm3']?></td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select4['paver_thickness'];?></td>
                            
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != null) {
                                                                                                                                                                                    echo number_format($row_select_pipe['area_3'], 0);
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "--";
                                                                                                                                                                                } ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_3']; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_3']; ?>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php
// Assuming $row_select4['paver_thickness'] contains the value you want to check
$E25 = $row_select4['paver_thickness'];

if ($E25 == 50) {
    $result = "1.03";
} elseif ($E25 == 60) {
    $result = "1.06";
} elseif ($E25 == 80) {
    $result = "1.18";
} else {
    $result = ""; // Default case if none match
}

echo $result; // This will output the corresponding value based on $E25
?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_3']; ?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null && $row_select_pipe['wtr_3'] != "NaN") {
                                                                                                                                                                                    echo $row_select_pipe['wtr_3'];
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo " -- ";
                                                                                                                                                                                } ?>
                            </td>
                        <tr style="">
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['sm4']?></td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select4['paver_thickness'];?></td>
                            
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != null) {
                                                                                                                                                                                    echo number_format($row_select_pipe['area_4'], 0);
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "--";
                                                                                                                                                                                } ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_4']; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_4']; ?>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px;border-bottom:0px;"><?php
// Assuming $row_select4['paver_thickness'] contains the value you want to check
$E25 = $row_select4['paver_thickness'];

if ($E25 == 50) {
    $result = "1.03";
} elseif ($E25 == 60) {
    $result = "1.06";
} elseif ($E25 == 80) {
    $result = "1.18";
} else {
    $result = ""; // Default case if none match
}

echo $result; // This will output the corresponding value based on $E25
?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_4']; ?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px;border-bottom:0px;">-
                            </td>
                        </tr>
                        <tr style="">
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['sm5']?></td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select4['paver_thickness'];?></td>
                            
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != null) {
                                                                                                                                                                                    echo number_format($row_select_pipe['area_5'], 0);
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "--";
                                                                                                                                                                                } ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_5']; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_5']; ?>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px;border-bottom:0px;"><?php
// Assuming $row_select4['paver_thickness'] contains the value you want to check
$E25 = $row_select4['paver_thickness'];

if ($E25 == 50) {
    $result = "1.03";
} elseif ($E25 == 60) {
    $result = "1.06";
} elseif ($E25 == 80) {
    $result = "1.18";
} else {
    $result = ""; // Default case if none match
}

echo $result; // This will output the corresponding value based on $E25
?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_5']; ?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px;border-bottom:0px;">--
                            </td>
                        </tr>
                        <tr style="">
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['sm6']?></td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select4['paver_thickness'];?></td>
                            
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != null) {
                                                                                                                                                                                    echo number_format($row_select_pipe['area_6'], 0);
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "--";
                                                                                                                                                                                } ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_6']; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_6']; ?>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px;border-bottom:0px;"><?php
// Assuming $row_select4['paver_thickness'] contains the value you want to check
$E25 = $row_select4['paver_thickness'];

if ($E25 == 50) {
    $result = "1.03";
} elseif ($E25 == 60) {
    $result = "1.06";
} elseif ($E25 == 80) {
    $result = "1.18";
} else {
    $result = ""; // Default case if none match
}

echo $result; // This will output the corresponding value based on $E25
?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_6']; ?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px;border-bottom:0px;">--
                            </td>
                        </tr>
                        <tr style="">
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['sm7']?></td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select4['paver_thickness'];?></td>
                            
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != null) {
                                                                                                                                                                                    echo number_format($row_select_pipe['area_7'], 0);
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "-";
                                                                                                                                                                                } ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_7']; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_7']; ?>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px;border-bottom:0px;"><?php
// Assuming $row_select4['paver_thickness'] contains the value you want to check
$E25 = $row_select4['paver_thickness'];

if ($E25 == 50) {
    $result = "1.03";
} elseif ($E25 == 60) {
    $result = "1.06";
} elseif ($E25 == 80) {
    $result = "1.18";
} else {
    $result = ""; // Default case if none match
}

echo $result; // This will output the corresponding value based on $E25
?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_7']; ?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px;border-bottom:0px;">--
                            </td>
                        </tr>
                        <tr style="">
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['sm8']?></td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select4['paver_thickness'];?></td>
                            
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != null) {
                                                                                                                                                                                    echo number_format($row_select_pipe['area_8'], 0);
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "--";
                                                                                                                                                                                } ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['load_8']; ?></td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_8']; ?>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px;border-bottom:0px;"><?php
// Assuming $row_select4['paver_thickness'] contains the value you want to check
$E25 = $row_select4['paver_thickness'];

if ($E25 == 50) {
    $result = "1.03";
} elseif ($E25 == 60) {
    $result = "1.06";
} elseif ($E25 == 80) {
    $result = "1.18";
} else {
    $result = ""; // Default case if none match
}

echo $result; // This will output the corresponding value based on $E25
?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_8']; ?>
                            </td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px;border-bottom:0px;">--
                            </td>
                        </tr>
                        <tr style="">
                            <td colspan=7 style="font-size:11px;text-align:right;border:1px solid black;border-left:0px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><b>Average : - </b>&nbsp;</td>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != null && $row_select_pipe['avg_corr'] != "NaN") {
                                                                                                                                                                                                echo number_format(floatval($row_select_pipe['avg_corr']), 2);
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo "--";
                                                                                                                                                                                            } ?>
                            </td>
                          
 
 <td rowspan=7 style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "NaN") {
                                                                                                                                                                                                echo $row_select_pipe['avg_wtr'];
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo "--";
                                                                                                                                                                                            } ?>
                            </td>
                            
                        </tr>

                        

                       
		</table>	
		
		<!-- <table  align="center" width="100%" class="test" style="font-family : Calibri;font-size:11px; border-left:2px solid black; border-right:2px solid black;border-top:0px solid black;">
                        <tr>
                            <td rowspan=2 style="font-size:11px;text-align:center;border-top:0px solid black;border-left:1px solid black;font-weight:bold;padding:3px 0px;">Test Description</td>
                            <td colspan=6 style="font-size:11px;text-align:center;border-top:0px solid black;border-left:1px solid black;font-weight:bold;padding:3px 0px;">Grade of Paver Block
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:3px 0px;"><b>M-25</b></td>
                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:3px 0px;"><b>M-30</b></td>
                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:3px 0px;"><b>M-35</b></td>
                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:3px 0px;"><b>M-40</b></td>
                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:3px 0px;"><b>M-45</b></td>
                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:3px 0px;"><b>M-50</b></td>
                        </tr>


                        <tr>
                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">Minimum Average Compressive Strength required at <br> 28 days as per Table-3, N/mm<sup>2</sup> <br> S= f <sub>ck</sub> + 0.825 x S.D.</td>
                            <td style="text-align:center;border:1px solid black;border-right:0px solid black;">28.3</td>
                            <td style="text-align:center;border:1px solid black;border-right:0px solid black;">34.1</td>
                            <td style="text-align:center;border:1px solid black;border-right:1px solid black;">39.1</td>
                            <td style="text-align:center;border:1px solid black;border-right:1px solid black;">44.1</td>
                            <td style="text-align:center;border:1px solid black;border-right:1px solid black;">49.1</td>
                            <td style="text-align:center;border:1px solid black;border-right:1px solid black;">54.1</td>
                        </tr>

                        <tr>
                            <td colspan=1 style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">Water Absorption</td>
                            <td colspan=6 style="text-align:center;border:1px solid black;border-right:1px solid black;">Average shall not be more than 6% and individual samples should be restricted to 7%</td>
                        </tr>

                        <tr>
                            <td colspan=7 style="font-size:11px;text-align:left;border:1px solid black;border-left:0px solid black;border-right:0px solid black;padding:5px 0;">S.D - Standard Deviation considered as per IS 456-2000</td>
                        </tr>
                    </table>-->
		
		
		<!-- footer design >
		
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 2px solid;border-top: 0;">
						<tr>
							<td style="padding: 10px 0;border-bottom: 1px solid;" colspan="2"></td>
						</tr>
						<tr>
						<td style="padding: 1px 0;border-bottom: 1px solid;" colspan="2"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;text-transform: uppercase;font-weight: bold;" colspan="2">Report issued by:- GEO RESEARCH HOUSE, INDORE.</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
						</tr>
						<tr style="vertical-align: bottom;">
							<td style="padding: 1px 2px;height: 45px;" colspan="2"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;text-transform: uppercase;" colspan="2">Reviewed by & Authorized signatory </td>
						</tr>
						<tr style="vertical-align: bottom;">
							<td style="padding: 1px 2px;height: 45px;" colspan="2"></td>
						</tr>
						<tr>
							<td style="padding: 1px;border-bottom: 1px solid;border: 1px solid;" colspan="2"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;" colspan="2">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;" colspan="2">1. <?php echo $firsting;?></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;" colspan="2">2. <?php echo $seconding;?></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;" colspan="2">3. All the intormation is Provided to us by the Customer and can affect the Results validity.</td>
						</tr>
						
						<tr>
							<td style="padding: 1px 2px;" colspan="2">4. This Report shall not be reproduced without Approval of the Laboratory.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;" colspan="2">5. *This information is provided by the customer.</td>
							
						</tr>
						<tr>
							<td style="padding-right: 53px;text-align:right;"colspan="2">
							<?php if(strlen($row_select_pipe['ulr'])>15){?>
							<img src="../images/logos.png" height="50px" width="50px"/>
							<?php }?>
							</td>
						</tr>
						<tr>
							<td style="padding: 1px 40px;font-weight: bold;text-align: right;" colspan="2">
							Page no:- 1 of 1
							</td>
							
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>


		
		
	<?php }
 
if (($row_select_pipe['chk_abr'] != "" && $row_select_pipe['chk_abr'] != null && $row_select_pipe['chk_abr'] != "0") ||
        ($row_select_pipe['chk_ten'] != "" && $row_select_pipe['chk_ten'] != null && $row_select_pipe['chk_ten'] != "0") ||
        ($row_select_pipe['chk_fle'] != "" && $row_select_pipe['chk_fle'] != null && $row_select_pipe['chk_fle'] != "0")){?>
	
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">TEST REPORT - PAVER BLOCK</td>
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
					<!--STATIC AMENDMENT NO AND DATE>
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Amendment No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;--</td>
							<td style="border-bottom: 1px solid;text-align: right;border-left: 1px solid;">&nbsp;Group :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;Building Materials</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Amendment Date :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp; --</td>
							<td style="border-bottom: 1px solid;text-align: right;border-left: 1px solid;">&nbsp;Discipline :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;Mechanical</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part >
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
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Shape :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['paver_shape']; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Age :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['paver_age']; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Color :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['paver_color']; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Thickness(mm) :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['paver_thickness']; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['paver_grade']; ?></td>
					</tr>
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
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
	
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border-left:2px solid black; border-right:1px solid black;">

                            <tr style="">
                                <td style="border-top:0px solid;font-size:11px;border-left: 0px solid black;text-align:center;font-weight:bold;padding:3px 0px;" rowspan=4> Sr.<br>No.</td>
                                <td rowspan=4 style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Sample Mark</td>
                                <td rowspan=3 style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Flextural Strength</td>
                                <td rowspan=3 style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Avg. Flextural Strength</td>
                                <td rowspan=3 style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Split Tensile Strength</td>
                                <td rowspan=3 style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Avg. Split Tensile Strength</td>
                                <td colspan=4 style="border-top:0px solid;font-size:11px;border-left: 1px solid black;border-right:1px solid black;text-align:center;font-weight:bold;padding:3px 0px; ">Abrasion Resistance, mm<sup>3</sup>/5000mm<sup>2</sup></td>
                            </tr>

                            <tr style="">
                                <td colspan=2 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Dry Condition</td>
                                <td colspan=2 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;border-right:1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Wet Condition</td>
                            </tr>
                            <tr style="">
                                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">individual</td>
                                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Average</td>
                                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">individual</td>
                                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;border-right:1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Average</td>
                            </tr>


                            <tr style="">
                                <td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:3px 0px;">(N/mm<sup>2</sup>)</td>
                                <td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:3px 0px;">(N/mm<sup>2</sup>)</td>
                                <td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:3px 0px;">(N/mm<sup>2</sup>)</td>
                                <td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:3px 0px; ">(N/mm<sup>2</sup>)</td>
                                <td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:3px 0px;">mm<sup>3</sup>/5000 mm<sup>2</sup></td>
                                <td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:3px 0px;">mm<sup>3</sup>/5000 mm<sup>2</sup></td>
                                <td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:3px 0px; ">mm<sup>3</sup>/5000 mm<sup>2</sup></td>
                                <td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;border-right:1px solid black;text-align:center;padding:3px 0px; ">mm<sup>3</sup>/5000 mm<sup>2</sup></td>
                            </tr>

                            <tr style="">
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;border-right:0px;padding:2px 0;border-bottom: 0;"><?php echo $cnt++; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['sm9']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['fle1']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;" rowspan=8><?php echo $row_select_pipe['avg_fle']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['sten1']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;" rowspan=8><?php echo $row_select_pipe['avg_tensile']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['v1']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;" rowspan=8><?php echo $row_select_pipe['avgv']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['v4']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;border-right:1px solid black;padding:2px 0; border-bottom:0px;" rowspan=8><?php echo $row_select_pipe['avgv2']; ?></td>
                            </tr>


                            <tr style="">
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;border-right:0px;padding:2px 0;border-bottom: 0;"><?php echo $cnt++; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['sm10']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['fle2']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['sten2']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['v2']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['v5']; ?></td>
                            </tr>


                            <tr style="">
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;border-right:0px;padding:2px 0; border-bottom:0px;"><?php echo $cnt++; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sm11']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['fle3']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sten3']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['v3']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['v6']; ?></td>
                            </tr>

                            <tr style="">
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;border-right:0px;padding:2px 0; border-bottom:0px;"><?php echo $cnt++; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sm12']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['fle4']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sten4']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;">-</td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;">-</td>
                            </tr>
                            <tr style="">
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;border-right:0px;padding:2px 0; border-bottom:0px;"><?php echo $cnt++; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sm13']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['fle5']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sten5']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;">-</td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;">-</td>
                            </tr>
                            <tr style="">
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;border-right:0px;padding:2px 0; border-bottom:0px;"><?php echo $cnt++; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sm14']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['fle6']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sten6']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;">-</td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;">-</td>
                            </tr>
                            <tr style="">
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;border-right:0px;padding:2px 0; border-bottom:0px;"><?php echo $cnt++; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sm15']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['fle7']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sten7']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;">-</td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;">-</td>
                            </tr>
                            <tr style="">
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;border-right:0px;padding:2px 0; border-bottom:0px;"><?php echo $cnt++; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sm16']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['fle8']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;"><?php echo $row_select_pipe['sten8']; ?></td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;">-</td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px; border-bottom:0px;">-</td>
                            </tr>
                            <tr style="">
                                <td style=" border-top:0px; font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;border-right:0px;padding:2px 0;" colspan="2">Test Method</td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;" colspan="2">IS 15658 : 2021 ANNEX-G</td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;" colspan="2">IS 15658 : 2021 ANNEX-F</td>
                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:1px solid black;" colspan="4">IS 15658 : 2021 ANNEX-E</td>
                            </tr>
	
		</table>
	
		<!-- footer design >
		
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
	<?php }
   ?>




		
	</page>
	

	

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>