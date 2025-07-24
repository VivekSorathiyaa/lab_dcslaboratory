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
	$select_tiles_query = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0'";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
		$dia = explode(",", $row_select4['steel_dia']);
		$dia1=$dia[0];
		$dia2=$dia[1];
		$dia3=$sample_note[2];
		$grade = $row_select4['steel_grade'];
		$brand = $row_select4['steel_brand'];
		$sample_qty1 = $row_select4['steel_sample_qty'];
		$heat = $row_select4['steel_heat'];
		$steel_qty = $row_select4['steel_sample_qty'];
		$steel_source_name = $row_select4['steel_source_name'];
		$grade_data = explode(",", $row_select4['steel_grade']);
	}

	$flag = 0;
	$a = 1;
	$down = 0;
	$up = 5;
	/*for($a=0;$a<$page_cont;$a++)
			{*/
	?>




<br>
	
	<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
		<tr>
			<td style="text-transform: uppercase;font-weight: bold;text-align: center;font-size: 21px;padding: 2px 0;">TEST REPORT</td>
		</tr>
	</table>
	<br>
	<br>
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
		<tr>
			<td style="text-transform: uppercase;font-weight: bold;text-align: right;font-size: 16px;padding: 2px 0;">QSF-1002</td>
		</tr>
	</table>
	<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border: 1px solid;">
    <?php //if ($name_of_work != "") { ?>
	<tr>
        <td style="font-size:15px;padding:2px;text-align: left;border-right:1px solid" rowspan="8">&nbsp;&nbsp;<b>Agency / Name & Address</b><br>&nbsp;&nbsp;<?php echo $clientname;?> <br> &nbsp;&nbsp;<?php echo $client_address;?></td>
    </tr>
	<?php// if ($agency_name != "") { ?>
    <tr>
        <?php if(strlen($_GET['ulr'])>15){?>
				<td style="padding:2px;text-align: left;"><b>&nbsp;&nbsp;ULR no.</b> <b>:-</b> <?php echo $_GET['ulr']; ?></td>
				
				<?php }else{?>
				<td style="text-align: center;">&nbsp;</td>
				<td style="padding: 0 2px;text-align: center;">&nbsp;</td>
				<?php }?>
		
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;&nbsp;DATE OF ISSUE</td>
        <td style="border-top:1px solid;border-left:1px solid;padding:2px;text-align: left;" ><b>&nbsp;&nbsp;</b><?php echo date('d/m/Y', strtotime($issue_date));?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;&nbsp;DATE OF LETTER</td>
        <td style="border-top:1px solid;padding:2px;text-align: left;border-left:1px solid;"><b>&nbsp;&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select["date"]));?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;&nbsp;DATE OF RECIPT.</td>
        <td style="border-top:1px solid;padding:2px;text-align: left;border-left:1px solid;" ><b>&nbsp;&nbsp;</b><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;&nbsp;REFERENCE NO. </td>
        <td style="border-top:1px solid;padding:2px;text-align: left;border-left:1px solid;" ><b>&nbsp;&nbsp;</b><?php echo $r_name;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;&nbsp;REPORT NO. </td>
        <td style="border-top:1px solid;padding:2px;text-align: left;border-left:1px solid;" ><b>&nbsp;&nbsp;</b><?php echo $report_no;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;&nbsp;UNIQUE IDENTITY OF SAMPLE </td>
        <td style="border-top:1px solid;padding:2px;text-align: left;border-left:1px solid;"><b>&nbsp;&nbsp;</b>CC-25/136/07/2024</td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Client Name :-</b> <?php echo $agency_name;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Test Method :-</b> IS 15658</td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Name  of Test* :-</b> Steel</td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Subject / N.O.W* :-</b> <?php echo $name_of_work;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>DESCRIPTION OF SAMPLE :-</b> <?php echo $mt_name;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>CONDITION OF SAMPLE :-</b> <?php echo $con_sample	;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Enrter Quantity :-</b> <?php echo $sample_qty1;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Select Grade :-</b> <?php echo $grade ;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Enrter Name Of Source :-</b> <?php echo $steel_source_name ;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Dia (mm) :-</b> <?php echo $dia;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Brand :-</b> <?php echo $brand;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Mill Heat No. :-</b> <?php echo $heat;?></td>
    </tr>
	<tr>
        <td style="border-top:1px solid;padding:2px;text-align: left;" colspan="3">&nbsp;&nbsp;<b>Lot Quantity :-</b> <?php echo $steel_qty;?></td>
    </tr>
</table>
<br>
<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
		
		<!--<tr>
			<!-- header part -->
			<!--<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:21%;">&nbsp;Report No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;width:4	0%;">&nbsp;<?php echo $report_no; ?></td>
							<?php if(strlen($ans['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $ans['ulr']; ?></td>
							<?php }else{?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;</td>
							<?php }?>
						</tr>
					<!--STATIC AMENDMENT NO AND DATE>
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
							<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sample Source :-</td>
							<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php if($day_remark!=""){echo $day_remark."<sup>*</sup>";}else{ echo "--";} ?></td>
						</tr>
						
						<tr>
							<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sample Identification No. :-</td>
							<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $ans['cc_identification_mark']; ?></td>
						</tr>
						<tr>
							<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Test Method :-</td>
							<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;IS: 516: (Part 1) (Sec-1) : 2021</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;IS Code Specification :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;IS: 456: 2000 Reaffirmed : 2021</td>
						</tr>
						<tr>
							<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
						</tr>
					</table>

				</td>
			</tr>-->
		</table>
<br>
		<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid; border-left:1px solid black;">
				
					<tr style="">
						<td  style="width:12%;border-top:1px solid;font-size:11px;text-align:right;padding:5px 4px;font-weight:bold;"><u>Test Repor</u></td>
						<td  style="width:12%;border-top:1px solid;font-size:11px;text-align:center;padding:5px 4px;font-weight:bold;"></td>
						
					</tr>
					<tr style="">
						<td  style="width:12%;font-size:11px;text-align:left;padding:5px 4px;font-weight:bold;">&nbsp;&nbsp;Discipline : - Mechanical</td>
						<td  style="width:12%;font-size:11px;text-align:right;padding:5px 4px;font-weight:bold;">Group : - Building Material&nbsp;&nbsp;</td>
					</tr>
					
				</table>
		<tr>
			<td>
				<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid; border-left:1px solid black;">
				
					<tr style="">
						<td  style="width:12%;font-size:11px;text-align:center;padding:5px 4px;font-weight:bold;" rowspan="2">Sr. No.</td>
						<td  style="font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Test</td>
						<td  style="font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Result Obtained</td>
						<td  style="font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Result Obtained</td>
						<td  style="font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Result Obtained</td>
						<td  style="font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;" >Method Of Test</td>
					</tr>
					<tr style="">
					<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;" >Dia. (mm)</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;" ><?php echo $row_select_pipe['dia_1'];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;" ><?php echo $row_select_pipe[''];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;" ><?php echo $row_select_pipe[''];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;" rowspan="5">I.S. 1786-2008 (RA 2018), 1608 (Part-1) : 2022</td>
					</tr>
					<tr style="text-align:left">
						<td  style="width:12%;border-top:1px solid;font-size:11px;text-align:center;padding:5px 4px;font-weight:bold;">1</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;text-align:left">Yield strength (N/mm2)</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['ys_1'];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe[''];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe[''];?></td>
						
					</tr>
					<tr style="text-align:left">
						<td  style="width:12%;border-top:1px solid;font-size:11px;text-align:center;padding:5px 4px;font-weight:bold;">2</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;text-align:left">Ultimate tensile strength (N/mm2)</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['ten_1'];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe[''];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe[''];?></td>
						
					</tr>
					<tr style="text-align:left">
						<td  style="width:12%;border-top:1px solid;font-size:11px;text-align:center;padding:5px 4px;font-weight:bold;">3</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;text-align:left">Elongation (%)</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['elo_1'];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe[''];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe[''];?></td>
						
					</tr>
					<tr style="text-align:left">
						<td  style="width:12%;border-top:1px solid;font-size:11px;text-align:center;padding:5px 4px;font-weight:bold;">4</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;text-align:left">Wt./m length (Kg.)</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['l_1'];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe[''];?></td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe[''];?></td>
						
					</tr>
				</table>
			</td>
		</tr>
	
		<tr>
			<td>
				<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				
					<tr style="">
						<td  style="width:12%;font-size:11px;text-align:center;padding:5px 4px;font-weight:bold;" rowspan="2">Requirement as per I.S. 1786 – 2008, Clause 6.3 & 7.2.3</td>
						
					</tr>
					
				</table>
			</td>
		</tr>
		
		<tr>
			<td>
				<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid; border-left:1px solid black;">
				
					<tr style="text-align:center;">
						<td  style="width:12%;border-top:1px solid;padding:5px 4px;">Diameter(mm)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">4</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">5</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">6</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">8</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">10</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">12</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">16</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">20</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">25</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">28</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">32</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">36</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;padding:5px 4px;">40</td>
					</tr>
					<tr style="text-align:center;">
						<td  style="width:12%;border-top:1px solid;font-size:11px;padding:5px 4px;">Mass per meter</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">0.099</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">0.154</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">0.222</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">0.395</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">0.617</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">0.888</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">1.58</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">2.47</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">3.85</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">4.83</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">6.31</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">7.99</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;">9.86</td>
					</tr>
					<tr style="text-align:center;">
						<td  style="width:12%;border-top:1px solid;font-size:11px;padding:5px 4px;">Tolerances on Nominal Mass</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;" colspan="5">-8%</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;" colspan="2">-6%</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;padding:5px 4px;" colspan="6">-4%</td>
						
					</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				
					<tr style="">
						<td  style="width:12%;font-size:11px;text-align:center;padding:5px 4px;font-weight:bold;" rowspan="2">Requirement as per I.S. 1786 – 2008, Clause 9.1, Table 3</td>
						
					</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid; border-left:1px solid black;">
				
					<tr style="">
						<td  style="width:12%;border-top:1px solid;font-size:11px;text-align:left;padding:5px 4px;font-weight:bold;">Property</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;font-weight:bold;">Fe 415</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;font-weight:bold;">Fe 415D</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;font-weight:bold;">Fe 500</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;font-weight:bold;">Fe 500D</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;font-weight:bold;">Fe 550</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;font-weight:bold;">Fe 550D</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:left;padding:5px 4px;font-weight:bold;">Fe 600</td>
					</tr>
					<tr style="">
						<td  style="width:12%;border-top:1px solid;font-size:11px;text-align:center;padding:5px 4px;">0.2 % percent proof stress (minimum) in N/mm2</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">415</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">415</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">500</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">500</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">550</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">550</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">600</td>
						
					</tr>
					<tr style="">
						<td  style="width:12%;border-top:1px solid;font-size:11px;text-align:center;padding:5px 4px;">Ultimate Tensile Stress (Minimum) in N/mm2</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">10% more than actual 0.2% proof stress but not less than 485 N/mm2</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">12% more than actual 0.2% proof stress but not less than 500 N/mm2</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">8% more than actual 0.2% proof stress but more than 545 N/mm2</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">10% more than actual 0.2% proof stress but more than 565 N/mm2</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">6% more than actual 0.2% proof stress but more than 585 N/mm2</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">8% more than actual 0.2% proof stress but more than 600 N/mm2</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">6% more than actual 0.2% proof stress but more than 660 N/mm2</td>
						
					</tr>
					<tr style="">
						<td  style="width:12%;border-top:1px solid;font-size:11px;text-align:center;padding:5px 4px;">Min. Elongation in %</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">14.5</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">18</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">12</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">16</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">10</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">14.5</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;">10</td>
						
					</tr>
				</table>
			</td>
		</tr>
				</table>
			</td>
		</tr>
	
		<!-- footer design -->
		<br>
		<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-left:60px;">
        <tr>
            <td><b>D.O.S:</b> 24.07.2024</td>
        </tr>
        <tr>
            <td><b>D.O.C:</b> 26.08.2024</b></td>
        </tr>
		</table>
		<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;padding:0;">
		<ul>
            <li style="font-size:11px;font-family : Calibri;margin-left:60px;">*Indicates information provided by the customer</td>
        
            <li style="font-size:11px;font-family : Calibri;margin-left:60px;"><b>Note: -</b> The test Results given above pertains to the sample as received.</td>
        </ul>
       </table>
		<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
		<tr>
            <td align="center"><b>*** End Of Report *** </b> </td>
        </tr>
		<tr>
            <td align="center"><b>(Jai Hind)</b><br><br></td>
        </tr>
            
    </table>
    <br><br>
    <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;padding:0;margin-left:auto; margin-right:auto;">
        <tr>
            <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REWEWED BY</td>
            <td style="text-align:right;">AUTHORISED BY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Er.YOGINDER CHAUHAN</td>
            <td style="text-align:right;">Er.VISHAL ACHARYA &nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(SENIOUR ANALYST)</td>
            <td style="text-align:right;">(TECHNICAL MANAGER )</td>
        </tr>
    </table>
	
	
	<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;">
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF STEEL
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
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Agency </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $agency_name;?></td>
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
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo date('d/m/Y', strtotime($end_date)); ?></td>
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
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $mark; ?></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
	<tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;grade  </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $row_select_pipe['grade']; ?></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;brand  </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $brand;?></td>
    </tr>
	
</table>
				
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; padding-top:20px;border-bottom: 1px solid;">
			
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9.6%" rowspan="2">Test</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
				
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Test Result</td>  
										<?php }?>
				
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%" rowspan="2">Testing Method</td>                            
                <td style="border-top:1px solid;border-right:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%" rowspan="2">Requirements as per <br>IS 1786-2018</td>
            </tr>
			<tr style="">
                <?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
				<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%"><?php echo $lab_no;?></td>
										<?php }?>
            </tr>
			<?php $cnt=1;?>
			<?php if ($row_select4['steel_dia'] != "" && $row_select4['steel_dia'] != null && $row_select4['steel_dia'] != "0") { 
			?>
			
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Diameter (mm)</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										$cnt=0;
										?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe2['dia'];?><?php //echo $row_select4['steel_dia'];?></td>
										<?php }?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" >IS 1608 PART-1,<br>IS 1786-2018</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"></td>
            </tr>
			
			<?php 
			} 
			if ($row_select_pipe['gl_1'] != "" && $row_select_pipe['gl_1'] != null && $row_select_pipe['gl_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Initial Gauge length (5.65√A) mm</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe2['gl_1'];?></td>
										<?php }?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" >IS 1608 PART-1,<br>IS 1786-2018</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"></td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['yp_1'] != "" && $row_select_pipe['yp_1'] != null && $row_select_pipe['yp_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Yield Load (N)</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe2['yp_1'];?></td>
										<?php }?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" >IS 1608 PART-1,<br>IS 1786-2018</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"></td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['up_1'] != "" && $row_select_pipe['up_1'] != null && $row_select_pipe['up_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Tensile Load (N)</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe2['up_1'];?></td>
										<?php }?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" >IS 1608 PART-1,<br>IS 1786-2018</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"></td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['ys_1'] != "" && $row_select_pipe['ys_1'] != null && $row_select_pipe['ys_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Yield Stress (N/mm<sup>2</sup>)</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe2['ys_1'];?></td>
										<?php }?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" >IS 1608 : Part 1 : 2022</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;">> <?php if($row_select_pipe['grade'] == "FE 415") { echo "415";} else if($row_select_pipe['grade'] == "FE 415 D") { echo "415";} else if($row_select_pipe['grade'] == "FE 500") { echo "500";} else if($row_select_pipe['grade'] == "FE 500 D") { echo "500";} else if($row_select_pipe['grade'] == "FE 550") { echo "550";} else if($row_select_pipe['grade'] == "FE 550 D") { echo "550";} else if($row_select_pipe['grade'] == "FE 600") { echo "600";}?></td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['fg_1'] != "" && $row_select_pipe['fg_1'] != null && $row_select_pipe['fg_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Final Gauge length f1(mm)</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe2['fg_1'];?></td>
										<?php }?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" >IS 1608 PART-1,<br>IS 1786-2018</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"></td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['elo_1'] != "" && $row_select_pipe['elo_1'] != null && $row_select_pipe['elo_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Elongation (%)</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe2['elo_1'];?></td>
										<?php }?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" >IS 1608 : Part 1 : 2022</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;">> <?php if($row_select_pipe['grade'] == "FE 415") { echo "14.5";} else if($row_select_pipe['grade'] == "FE 415 D") { echo "18";} else if($row_select_pipe['grade'] == "FE 500") { echo "12";} else if($row_select_pipe['grade'] == "FE 500 D") { echo "16";} else if($row_select_pipe['grade'] == "FE 550") { echo "10";} else if($row_select_pipe['grade'] == "FE 550 D") { echo "14.5";} else if($row_select_pipe['grade'] == "FE 600") { echo "10";}?>%</td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['ten_1'] != "" && $row_select_pipe['ten_1'] != null && $row_select_pipe['ten_1'] != "0") { 
			?>
			
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Ultimate Tensile Strength<br>(N/mm<sup>2</sup>)</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe2['ten_1'];?></td><?php }?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" >IS 1608 : Part 1 : 2022</td>
				<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;"><?php if($row_select_pipe['grade'] == "FE 415") { echo "485";} else if($row_select_pipe['grade'] == "FE 415 D") { echo "500";} else if($row_select_pipe['grade'] == "FE 500") { echo "545";} else if($row_select_pipe['grade'] == "FE 500 D") { echo "565";} else if($row_select_pipe['grade'] == "FE 550") { echo "585";} else if($row_select_pipe['grade'] == "FE 550 D") { echo "600";} else if($row_select_pipe['grade'] == "FE 600") { echo "660";}?></td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['bend_1'] != "" && $row_select_pipe['bend_1'] != null && $row_select_pipe['bend_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Bend Test 180 °</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe2['bend_1'];?></td>
										<?php }?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" >IS 1599 : 2019</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;">A) No Visible Rupture or Cracks<br>(B) Found Visible Rupture or Cracks</td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['rebend_1'] != "" && $row_select_pipe['rebend_1'] != null && $row_select_pipe['rebend_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Re Bend Test</td>
				<?php
										$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
										// $coming_row = mysqli_num_rows($result_tiles_select1);

										while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
										
										?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe2['rebend_1'];?></td>
										<?php }?>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" >IS 1599 : 2019</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:1px solid;border-bottom:0px;">A) No Visible Rupture or Cracks<br>(B) Found Visible Rupture or Cracks</td>
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report -  REINFORCMENT STEEL</td>
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
							<?php if(strlen($row_select_pipe['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;<?php echo $row_select_pipe['ulr']; ?></td>
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
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;Metal &amp; Alloy</td>
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
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Enrter Quantity :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php //echo $row_select4['steel_sample_qty'];?></td>
					</tr>->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Select Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php 
						$rr = explode(",",$row_select4['steel_grade']);
						echo $rr[0];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Enrter Name Of Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_source_name'];?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Dia (mm) :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_dia'];?></td>
					</tr>->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Brand :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php 
						$rr1 = explode(",",$row_select4['steel_brand']);
						echo $rr1[0];
						//echo $row_select4['steel_brand'];?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Mill Heat No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_heat'];?></td>
					</tr>->
					
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>

	<!-- data table design ->
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-top: 0;border-left: 1px solid;border-right: 1px solid;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
					<?php $cnt = 1; ?>
					<tr>
						<td style="text-align:left;font-size:11px; ">
							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;margin-top:2px;">

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
							<table cellpadding="0" cellpadding="0" align="center" width="100%" style="border-left: 1px solid;border-right: 1px solid;" class="test">
								<tr>
								<td style="font-size:11px;text-align:left;font-weight:bold;padding:15px 0 5px;font-family:Times New Roman;"> Requirement as per IS 1786-2008, CI-8.1, Table-3 (Amend No. 1 to IS 1786 : 2008)</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>>
						<td colspan="3" style="width:100%;vertical-align:top">
							<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;">             

									<tr>
										<td style="font-size:11px;text-align:left;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Property</td>
										<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 415</b></td>
										<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 415D</b></td>
										<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 500</b></td>
										<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 500D</b></td>
										<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 550</b></td>
										<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 550D</b></td>
										<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 600</b></td>
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
							<table cellpadding="0" cellpadding="0" align="center" width="100%" style="border-left: 1px solid;border-right: 1px solid;" class="test">
								<tr>
								<td style="font-size:11px;text-align:left;font-weight:bold;padding:15px 0 5px;font-family:Times New Roman;"> Requirement as per IS 1786-2008, CI6.3 & 7.2.3</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="width:100%;vertical-align:top">
							<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;">             
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
				</table>
			</td>
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
							<td style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 1 of 1</td>
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
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 415</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 415D</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 500</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 500D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 550</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 550D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>FE 600</b></td>
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
	<div class="pagebreak"> </div>
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