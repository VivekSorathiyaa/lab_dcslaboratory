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
	function round_up($number, $precision = 0)
	{
		$fig = (int) str_pad('1', $precision, '0');
		return (ceil($number * $fig) / $fig);
	}
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	$page_cont = round_up($no_of_rows / 3);

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
		$con_sample = "Acceptable";
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
		$cc_grade = $row_select4['cc_grade'];
		$cc_set_of_cube = $row_select4['cc_set_of_cube'];
		$cc_no_of_cube = $row_select4['cc_no_of_cube'];
		$cc_identification_mark = $row_select4['cc_identification_mark'];
		$day_remark = $row_select4['day_remark'];
		$casting_date = $row_select4['casting_date'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}

	$flag = 0;
	$a = 1;
	$down = 0;
	$up = 3;
	$avgs=0;
	$avgssum=0;
	$counter=0;
	$avgssum1=0;
	$counter1=0;
	for($a=1;$a<=$page_cont;$a++)		{

	?>



	<br>
<br>
<br>
<br>
<br>
<br>

	<page size="A4">
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
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
							<?php
								$select_tilesy = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
								$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
								$coming_row = mysqli_num_rows($result_tiles_select1);
			
								while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
									$flag++;
								?>
							<td style="padding: 0 2px;width:45%;text-align: right;">&nbsp;Date:<?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<?php }?>
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF CEMENT CONCRETE CUBES</td>
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
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Size of Specimen</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $ans['l1'];?> mm x <?php echo $ans['b1'];?> mm x <?php echo $ans['h1'];?> mm</td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $ans['cc_identification_mark']; ?></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
</table>
				<!--<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 1px solid;border-bottom: 0;">
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Name of Work</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;<?php echo $name_of_work;?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Name of Client</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;<?php echo $clientname;?></td>
						</tr>
						<tr>
							<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Date of Receipt Sample :-</td>
							<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="2">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?></td>
						</tr>
						
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Date of Test Performed :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="2">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Date :- <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Enviromental Condition :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;Temperature :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;27˚± 2 ˚c</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Size of Specimen</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;150 mm x 150 mm x 150 mm</td>
						</tr>
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="2">&nbsp;Sample Collected by the Supplier</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Job No. :- </td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp; <?php echo $job_no;?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark :-</td>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="2">&nbsp;<?php echo $ans['cc_identification_mark']; ?></td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Lab No. :- </td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp; <?php echo $lab_no;?></td>
						</tr>
						
						
				</table>-->
				<br>
			</td>
		</tr>
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
		<!--<tr style="">
			<td>
				<table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
					<tr>
						<td style="font-size:12px;font-weight:bold;text-align:left;font-family:Times New Roman;border-right:2px solid; border-left:2px solid black;">TEST RESULTS:</td>
					</tr>
					<tr>
						<td style="font-size:12px;font-weight:bold;text-align:left;font-family:Times New Roman;border:1px solid black; padding:1px;border-bottom:0px;border-right:2px solid black;border-left:2px solid black;"></td>
					</tr>
				</table>
			</td>
		</tr>-->

		<?php $cnt = 1; ?>
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid; border-left:1px solid black;">
				
					<tr style="">
						<td  style="border-top:1px solid;font-size:11px;text-align:center;padding:5px 4px;font-weight:bold;"> Lab No.</td>
						<td  style="width:10%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Grade of <br>Concrete</td>
						<td  style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Date of <br>Casting</td>
						<td  style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Curing <br>Period<br> (Days)</td>
						<td  style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Date of<br> Receipt<br> Sample</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Due Date of<br> Testing</td>
						
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Actual Date of<br> Testing</td>
						
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Age of<br> Testing <br>(Days)</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Compressive<br> Strength<br> (N/mm<sup>2</sup>)</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Average <br>Compressive <br>Strength<br> (N/mm<sup>2</sup>)</td>
						<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;">Test Method</td>
						
					</tr>

					<?php
					$select_tilesy5 = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
						$coming_row = mysqli_num_rows($result_tiles_select15);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select15)) {
						//$flag++;
						$cnt=1;
					?>

						<tr style="">
							<td style="border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $lab_no;?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['grade1'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo $row_select_pipe['day1']; ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['day1']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_1']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;" rowspan="3"><?php echo $row_select_pipe['avg_com_s_1']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;" rowspan="3">IS 516</td>
							<!--<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_1']; $avgsum += floatval($row_select_pipe['comp_1']); $counter++;?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['mass_1']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;border-right: 1px solid black;"><?php if ($row_select_pipe['fail_pat_1'] != '' && $row_select_pipe['fail_pat_1'] != 0 && $row_select_pipe['fail_pat_1'] != null) {
																																								echo ($row_select_pipe['fail_pat_1']);
																																								$avgsum1 += floatval($row_select_pipe['fail_pat_1']); $counter1++;
																																							} else {
																																								echo '-';
																																							} ?></td>-->
							
							
						</tr>
						
						<tr style="">
							<td style="border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $lab_no;?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['grade1'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo $row_select_pipe['day1']; ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['day1']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_2']; ?></td>
						</tr>
						<tr style="">
							<td style="border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $lab_no;?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['grade1'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo $row_select_pipe['day1']; ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['day1']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_3']; ?></td>
						</tr>
						<?php
						// if ($flag == 3) {
							// break;
						// }
					}
					?>
					
						<!--<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Cube - 2</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['l2']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['b2']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['h2']; ?></td>
							
							
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['load_2']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_2']; $avgsum += floatval($row_select_pipe['comp_2']); $counter++;?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['mass_2']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;border-right: 1px solid black;"><?php if ($row_select_pipe['fail_pat_2'] != '' && $row_select_pipe['fail_pat_2'] != 0 && $row_select_pipe['fail_pat_2'] != null) {
																																								echo ($row_select_pipe['fail_pat_2']);
																																								$avgsum1 += floatval($row_select_pipe['fail_pat_2']); $counter1++;
																																							} else {
																																								echo '-';
																																							} ?></td>
							
							
						</tr>
						
						<tr style="border: 1px solid black;">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Cube - 3</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['l3']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['b3']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['h3']; ?></td>
							
							
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['load_3']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['comp_3']; $avgsum += floatval($row_select_pipe['comp_3']); $counter++;?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['mass_3']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;border-right: 1px solid black;"><?php if ($row_select_pipe['fail_pat_3'] != '' && $row_select_pipe['fail_pat_3'] != 0 && $row_select_pipe['fail_pat_3'] != null) {
																																								echo ($row_select_pipe['fail_pat_3']);
																																								$avgsum1 += floatval($row_select_pipe['fail_pat_3']); $counter1++;
																																							} else {
																																								echo '-';
																																							} ?></td>
							
							
						</tr>


						

						

						

					
					
					
						<tr style="border: 1px solid black;">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:1px;border-right: 1px solid black;"colspan="14"></td>
							
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;text-align:right;" colspan="10">Avg.:</td>
							
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php $avgs = $avgsum / $counter;
							echo number_format($avgs,2);?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;border-right: 1px solid black;">
							<?php $avgs1 = $avgsum1 / $counter1;
							echo number_format($avgs1,0);?>
							
							
							
						</tr>-->

						

				</table>
			</td>
		</tr>


		
		
	
		<!-- footer design -->
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


</body>

</html>
<?php
			
			if($flag==2)
			{
					$avgsum=0;
					$counter=0;
					$avgsum1=0;
					$counter1=0;
					$flag=0;
					$down=$up;
					$up +=2;
					?>
					<div class="pagebreak"> </div>
			<?php }
			
			
			}
			
		?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">


</script>