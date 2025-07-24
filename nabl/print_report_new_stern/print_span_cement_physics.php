<?php
session_start();
include("../connection.php");
error_reporting(0); ?>
<style>
	@page {
		margin: 0;
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
		font-family: Arial;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Arial;
	}

	.tdclass1 {

		font-size: 12px;
		font-family: Arial;
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

	select {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		border: none;
		/* If you want to remove the border as well */
		background: none;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from span_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

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
		//$rec_sample_date = $row_select2['receive_date'];
		//$rec_sample_date = $row_select2['receive_date'];
		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['fine_agg_source'];
		$material_location = $row_select4['material_location'];
		$grade = $row_select4['cement_grade'];
		$type_of_cement = $row_select4['type_of_cement'];
		$cement_brand = $row_select4['cement_brand'];
		$week_number = $row_select4['week_number'];
		$id_mark = $row_select4['id_mark'];
					$challan_no = $row_select4['challan_no'];
					$challan_no_1 = $row_select4['challan_no_1'];
					$challan_no_2 = $row_select4['challan_no_2'];
					$challan_no_3 = $row_select4['challan_no_3'];
	}




	?>


	<div id="header" style="text-align: center;width: 110px;margin: 0 auto;">


	</div>

			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		

	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
		<tr>
			<td>
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
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
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 54.5%;padding: 0 2px;text-align: right;">&nbsp;Group:- Building Materials</td>
							<?php
								// $select_tilesy = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
								// $result_tiles_select1 = mysqli_query($conn, $select_tilesy);
								// $coming_row = mysqli_num_rows($result_tiles_select1);
			
								// while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
									// $flag++;
								?>
							<td style="padding: 0 2px;width:45%;text-align: right;">&nbsp;Date:<?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<?php //}?>
						</tr>
						
				</table>
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 50%;padding: 0 2px;text-align: center;">&nbsp;Discipline:- Mechanical</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 14px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF CEMENT</td>
					</tr>
				</table>
				<br>	
				<br>
<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border: 1px solid;">
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
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;Type & Brand of Cement </td>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $cement_brand;?></td>
        <td style="text-align: left;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $r_name; ?>&nbsp;&nbsp;<?php
            if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
            ?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
            } else {
            }
        ?></td>
    </tr>	
    <!--<tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Agency </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $agency_name;?></td>
    </tr>-->
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
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php if ($material_location == 1) {echo "In Laboratory";} else {echo "In Field";} ?></td>
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
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Type of sample </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $type_of_cement;?></td>
		<td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Grade </td>
        <td style="padding:2px;text-align: left;" ><b>&nbsp; : &nbsp;</b><?php echo $grade;?></td>
    </tr>
</table>				
				
				
				<br>
			</td>
		</tr>
		</table>
	<table class="bg_light" align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;background-color: #eeeeee;font-family: Arial;border: 1px solid black; padding: 2px;margin-bottom: 4px;">
		<tr>
			<td style="text-align:center; font-size:15px; text-transform: uppercase;"><b>PHYSICAL TESTS</b></td>
		</tr>
	</table>

	<table align="center" width="92%" class="test" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Calibri; margin-bottom: 6px; border: 1px solid black; ">
		<tr>
			<td style="width: 18%;padding-top: 2px;">&nbsp;<b>Discipline</b></td>
			<td style="padding-top: 2px;">: &nbsp;&nbsp;Mechanical </td>
		</tr>
		<tr>
			<td style="width: 18%;padding-bottom: 2px;">&nbsp;<b>Group</b></td>
			<td style="padding-bottom: 2px;">: &nbsp;&nbsp;Building Material</td>
		</tr>
	</table>



	<!-- data add Pending [static] -->
	<?php
	if ($grade == "53 OPC") {


	?>

		<table align="center" width="92%" class="test" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;margin-top: 14px; margin-bottom: 4px; border: 1px solid black; ">
			<tr style="text-align:center;">
				<td style="border:1px solid black;border-left:0px solid black;width:3%; vertical-align: top; font-size: 13px"><b>SI.<br>No.</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:16%; vertical-align: top;font-size: 13px"><b>Name of Test</b></td>

				<td style="border:1px solid black;border-left:0px solid black;width:12%; vertical-align: top; font-size: 13px"><b>Date of Testing</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:12%; vertical-align: top; font-size: 13px"><b>Method of Test</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:9%; vertical-align: top; font-size: 13px"><b>Result obtained</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:12%; vertical-align: top; font-size: 13px"><b>Limits as per<br>IS 269 : 2015 RA 2020</b></td>
			</tr>
			<?php
			$cnt = 0;
			if ($row_select_pipe['avg_fbs'] != null && $row_select_pipe['avg_fbs'] != "" && $row_select_pipe['avg_fbs'] != "undefined" && $row_select_pipe['avg_fbs'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Fineness by dry Sieving</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['fbs_s_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 1)1996 <br> RA 2021</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['avg_fbs']; ?> %</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">-</td>
				</tr>
			<?php
			}

			if ($row_select_pipe['ss_area'] != null && $row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != "undefined" && $row_select_pipe['ss_area'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Fineness by Blain air permeability </td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['sba_joining_date'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 2)1999 <br> RA 2018</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['ss_area']; ?> m<sup>2</sup>/kg</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['fine_test_limit']) {
																										echo $row_select_pipe['fine_test_limit'];
																									} ?> m<sup>2</sup>/kg</td>
				</tr>
			<?php
			}

			if ($row_select_pipe['final_consistency'] != null && $row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "undefined" && $row_select_pipe['finsl_consistency'] != "0" && $row_select_pipe['final_consistency'] != "-") { ?>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Standard Consistency</td>
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['con_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px; ">IS 4031 (PART 4)1988 <br> RA 2019</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px; "><?php if ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) {
																											echo $row_select_pipe['final_consistency'];
																										} else {
																											echo "-";
																										} ?> %</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"> - </td>
				</tr>
			<?php
			}
			if ($row_select_pipe['initial_time'] != null && $row_select_pipe['initial_time'] != "" && $row_select_pipe['initial_time'] != "undefined" && $row_select_pipe['initial_time'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Initial setting time</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['set_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 5)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['initial_time'] . " min" ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['set_test_limit_1'] . " min"; ?></td>
				</tr>
			<?php
			}
			if ($row_select_pipe['final_time'] != null && $row_select_pipe['final_time'] != "" && $row_select_pipe['final_time'] != "undefined" && $row_select_pipe['final_time'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Final Setting Time</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['set_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 5)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['final_time'] . " min" ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['set_test_limit_2'] . " min"; ?></td>
				</tr>

			<?php
			}
			if ($row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "undefined" && $row_select_pipe['soundness'] != "0") { ?>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Soundness by Le-Chatelier method</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['sou_s_d'])); ?>&nbsp;&nbsp;to&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['sou_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 3)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['soundness'] . " mm"; ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['sou_test_limit_1'] . " mm"; ?></td>
				</tr>
			<?php
			}
			if ($row_select_pipe['sba_res_obtained'] != null && $row_select_pipe['sba_res_obtained'] != "" && $row_select_pipe['sba_res_obtained'] != "undefined" && $row_select_pipe['sba_res_obtained'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Soundness by Autoclave Method</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['fin_s_d'])); ?>&nbsp;&nbsp;to&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['fin_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 3)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['sba_res_obtained']) {
																										echo $row_select_pipe['sba_res_obtained'] . " %";
																									} ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"> <?php if ($row_select_pipe['sba_test_limit']) {
																											echo "maximun " . $row_select_pipe['sba_test_limit'] . " %";
																										} ?></td>
				</tr>
			<?php
			}
			if ($row_select_pipe['density'] != null && $row_select_pipe['density'] != "" && $row_select_pipe['density'] != "undefined" && $row_select_pipe['density'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Specific Gravity</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['den_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 11)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['density']; ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">-</td>
				</tr>
			<?php
			}
			if ($row_select_pipe['avg_com_1'] != null && $row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "undefined" && $row_select_pipe['avg_com_1'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Compressive strength of cement &nbsp;</td>
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['caste_date1'])); ?></td>
					<td rowspan="4" style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 6)1988 <br> RA 2019</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px; vertical-align: top;"></td>
				</tr>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 10px; font-size: 12px"></td>
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 6px; font-size: 12px; text-align:start;">&nbsp;&nbsp; 72 &plusmn; 1 hr</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null  && $row_select_pipe['test_date1'] != "1970-01-01" && $row_select_pipe['test_date1'] != "0000-00-00") {
																														echo date("d/m/Y", strtotime($row_select_pipe['test_date1']));
																													} ?></td>

					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) {
																										echo $row_select_pipe['avg_com_1'] . "&nbsp;N/mm<sup>2</sup>";
																									} else {
																										echo "Awaited";
																									} ?> </td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">minimum <?php if ($grade == '53 OPC' && $row_select_pipe['com_test_limit_2'] != ""  && $row_select_pipe['com_test_limit_2'] != null  && $row_select_pipe['com_test_limit_2'] != "0"  && $row_select_pipe['com_test_limit_2'] != "undefined") {
																												echo $row_select_pipe['com_test_limit_2'];
																											} else { ?>27<?php } ?> N/mm<sup>2</sup></td>
				</tr>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><b></b></td>
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 6px; font-size: 12px; text-align:start;">&nbsp;&nbsp; 168 &plusmn; 2 hr</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php if ($row_select_pipe['test_date2'] != "" && $row_select_pipe['test_date2'] != "0" && $row_select_pipe['test_date2'] != null  && $row_select_pipe['test_date2'] != "1970-01-01" && $row_select_pipe['test_date2'] != "0000-00-00") {
																														echo date("d/m/Y", strtotime($row_select_pipe['test_date2']));
																													} ?></td>

					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != null) {
																										echo $row_select_pipe['avg_com_2'] . "&nbsp;N/mm<sup>2</sup>";
																									} else {
																										echo "Awaited";
																									} ?> </td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">minimum <?php if ($grade == '53 OPC' && $row_select_pipe['com_test_limit_3'] != ""  && $row_select_pipe['com_test_limit_3'] != null  && $row_select_pipe['com_test_limit_3'] != "0"  && $row_select_pipe['com_test_limit_3'] != "undefined") {
																												echo $row_select_pipe['com_test_limit_3'];
																											} else { ?>37 <?php } ?> N/mm<sup>2</sup></td>
				</tr>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><b></b></td>
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 6px; font-size: 12px; text-align:start;">&nbsp;&nbsp; 672 &plusmn; 4 hr</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php if ($row_select_pipe['test_date3'] != "" && $row_select_pipe['test_date3'] != "0" && $row_select_pipe['test_date3'] != null && $row_select_pipe['test_date3'] != "1970-01-01" && $row_select_pipe['test_date3'] != "0000-00-00") {
																														echo date("d/m/Y", strtotime($row_select_pipe['test_date3']));
																													} ?></td>

					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != null) {
																										echo $row_select_pipe['avg_com_3'] . "&nbsp;N/mm<sup>2</sup>";
																									} else {
																										echo "Awaited";
																									} ?> </td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">minimum 53 N/mm<sup>2</sup></td>
				</tr>
			<?php
			}
			?>
		</table>

	<?php
	} else if ($grade == "43 OPC") {

	?>

		<table align="center" width="92%" class="test" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;margin-top: 14px; margin-bottom: 4px; border: 1px solid black; ">
			<tr style="text-align:center;">
				<td style="border:1px solid black;border-left:0px solid black;width:3%; vertical-align: top; font-size: 13px"><b>SI.<br>No.</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:16%; vertical-align: top;font-size: 13px"><b>Name of Test</b></td>

				<td style="border:1px solid black;border-left:0px solid black;width:12%; vertical-align: top; font-size: 13px"><b>Date of Testing</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:12%; vertical-align: top; font-size: 13px"><b>Method of Test</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:9%; vertical-align: top; font-size: 13px"><b>Result obtained</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:12%; vertical-align: top; font-size: 13px"><b>Limits as per<br>IS 269 : 2015 RA 2020</b></td>
			</tr>
			<?php
			$cnt = 0;
			if ($row_select_pipe['avg_fbs'] != null && $row_select_pipe['avg_fbs'] != "" && $row_select_pipe['avg_fbs'] != "undefined" && $row_select_pipe['avg_fbs'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Fineness by dry Sieving</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['fbs_s_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 1)1996 <br> RA 2021</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['avg_fbs']; ?> %</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">-</td>
				</tr>
			<?php
			}

			if ($row_select_pipe['ss_area'] != null && $row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != "undefined" && $row_select_pipe['ss_area'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Fineness by Blain air permeability</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['sba_joining_date'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 2)1999 <br> RA 2018</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['ss_area']; ?>  m<sup>2</sup>/kg</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"> minimum 225  m<sup>2</sup>/kg</td>
				</tr>
			<?php
			}

			if ($row_select_pipe['final_consistency'] != null && $row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "undefined" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != "-") { ?>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Standard Consistency</td>
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['con_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px; ">IS 4031 (PART 4)1988 <br> RA 2019</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px; "><?php if ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) {
																											echo $row_select_pipe['final_consistency'];
																										} else {
																											echo "-";
																										} ?> %</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"> - </td>
				</tr>
			<?php
			}
			if ($row_select_pipe['initial_time'] != null && $row_select_pipe['initial_time'] != "" && $row_select_pipe['initial_time'] != "undefined" && $row_select_pipe['initial_time'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Initial setting time</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['set_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 5)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['initial_time'] . " min" ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo "minimum 30 min"; ?></td>
				</tr>
			<?php
			}
			if ($row_select_pipe['final_time'] != null && $row_select_pipe['final_time'] != "" && $row_select_pipe['final_time'] != "undefined" && $row_select_pipe['final_time'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Final Setting Time</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['set_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 5)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['final_time'] . " min" ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo "maximum 600 min"; ?></td>
				</tr>

			<?php
			}
			if ($row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "undefined" && $row_select_pipe['soundness'] != "0") { ?>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Soundness by Le-Chatelier method</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['sou_s_d'])); ?>&nbsp;&nbsp;to&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['sou_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 3)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['soundness'] . " mm"; ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo "maximum 10 mm"; ?></td>
				</tr>
			<?php
			}
			if ($row_select_pipe['sba_res_obtained'] != null && $row_select_pipe['sba_res_obtained'] != "" && $row_select_pipe['sba_res_obtained'] != "undefined" && $row_select_pipe['sba_res_obtained'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Soundness by Autoclave Method</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['fin_s_d'])); ?>&nbsp;&nbsp;to&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['fin_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 3)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['sba_res_obtained']) {
																										echo $row_select_pipe['sba_res_obtained'] . " %";
																									} ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"> <?php echo "maximun 0.8 %"; ?></td>
				</tr>
			<?php
			}
			if ($row_select_pipe['avg_density'] != null && $row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "undefined" && $row_select_pipe['avg_density'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Specific Gravity</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['den_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 11)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['avg_density']; ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">-</td>
				</tr>
			<?php
			}
			if ($row_select_pipe['avg_com_1'] != null && $row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "undefined" && $row_select_pipe['avg_com_1'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Compressive strength of cement &nbsp;</td>
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['caste_date1'])); ?></td>
					<td rowspan="4" style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 6)1988 <br> RA 2019</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px; vertical-align: top;"></td>
				</tr>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 10px; font-size: 12px"></td>
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 6px; font-size: 12px; text-align:start;">&nbsp;&nbsp; 72 &plusmn; 1 hr</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null  && $row_select_pipe['test_date1'] != "1970-01-01" && $row_select_pipe['test_date1'] != "0000-00-00") {
																														echo date("d/m/Y", strtotime($row_select_pipe['test_date1']));
																													} ?></td>

					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) {
																										echo $row_select_pipe['avg_com_1'] . "&nbsp;N/mm<sup>2</sup>";
																									} else {
																										echo "Awaited";
																									} ?> </td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">minimum 23 N/mm<sup>2</sup></td>
				</tr>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><b></b></td>
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 6px; font-size: 12px; text-align:start;">&nbsp;&nbsp; 168 &plusmn; 2 hr</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php if ($row_select_pipe['test_date2'] != "" && $row_select_pipe['test_date2'] != "0" && $row_select_pipe['test_date2'] != null  && $row_select_pipe['test_date2'] != "1970-01-01" && $row_select_pipe['test_date2'] != "0000-00-00") {
																														echo date("d/m/Y", strtotime($row_select_pipe['test_date2']));
																													} ?></td>

					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != null) {
																										echo $row_select_pipe['avg_com_2'] . "&nbsp;N/mm<sup>2</sup>";
																									} else {
																										echo "Awaited";
																									} ?> </td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">minimum 33 N/mm<sup>2</sup></td>
				</tr>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><b></b></td>
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 6px; font-size: 12px; text-align:start;">&nbsp;&nbsp; 672 &plusmn; 4 hr</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php if ($row_select_pipe['test_date3'] != "" && $row_select_pipe['test_date3'] != "0" && $row_select_pipe['test_date3'] != null && $row_select_pipe['test_date3'] != "1970-01-01" && $row_select_pipe['test_date3'] != "0000-00-00") {
																														echo date("d/m/Y", strtotime($row_select_pipe['test_date3']));
																													} ?></td>

					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != null) {
																										echo $row_select_pipe['avg_com_3'] . "&nbsp;N/mm<sup>2</sup>";
																									} else {
																										echo "Awaited";
																									} ?> </td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">minimum 43-58 N/mm<sup>2</sup></td>
				</tr>
			<?php
			}
			?>
		</table>


	<?php

	} else if ($grade == "33 OPC") {


	?>

	<?php


	} else if ($type_of_cement == "PPC") {



	?>
		<table align="center" width="92%" class="test" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;margin-top: 14px; margin-bottom: 4px; border: 1px solid black; ">
			<tr style="text-align:center;">
				<td style="border:1px solid black;border-left:0px solid black;width:3%; vertical-align: top; font-size: 13px"><b>SI.<br>No.</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:16%; vertical-align: top;font-size: 13px"><b>Name of Test</b></td>

				<td style="border:1px solid black;border-left:0px solid black;width:12%; vertical-align: top; font-size: 13px"><b>Date of Testing</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:12%; vertical-align: top; font-size: 13px"><b>Method of Test</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:9%; vertical-align: top; font-size: 13px"><b>Result obtained</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:12%; vertical-align: top; font-size: 13px"><b>Limits as per<br>IS 1489 (Part 1): 2015 RA 2020</b></td>
			</tr>
			<?php
			$cnt = 0;
			if ($row_select_pipe['avg_fbs'] != null && $row_select_pipe['avg_fbs'] != "" && $row_select_pipe['avg_fbs'] != "undefined" && $row_select_pipe['avg_fbs'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Fineness by dry Sieving</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['fbs_s_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 1)1996 <br> RA 2021</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['avg_fbs']; ?> %</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">-</td>
				</tr>
			<?php
			}

			if ($row_select_pipe['ss_area'] != null && $row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != "undefined" && $row_select_pipe['ss_area'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Fineness by Blain air permeability</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['sba_joining_date'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 2)1999 <br> RA 2018</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['ss_area']; ?>  m<sup>2</sup>/kg</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"> minimum 300  m<sup>2</sup>/kg</td>
				</tr>
			<?php
			}

			if ($row_select_pipe['final_consistency'] != null && $row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "undefined" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != "-") { ?>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Standard Consistency</td>
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['con_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px; ">IS 4031 (PART 4)1988 <br> RA 2019</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px; "><?php if ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) {
																											echo $row_select_pipe['final_consistency'];
																										} else {
																											echo "-";
																										} ?> %</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"> - </td>
				</tr>
			<?php
			}
			if ($row_select_pipe['initial_time'] != null && $row_select_pipe['initial_time'] != "" && $row_select_pipe['initial_time'] != "undefined" && $row_select_pipe['initial_time'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Initial setting time</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['set_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 5)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['initial_time'] . " min" ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo "minimum 30 min"; ?></td>
				</tr>
			<?php
			}
			if ($row_select_pipe['final_time'] != null && $row_select_pipe['final_time'] != "" && $row_select_pipe['final_time'] != "undefined" && $row_select_pipe['final_time'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Final Setting Time</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['set_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 5)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['final_time'] . " min" ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo "maximum 600 min"; ?></td>
				</tr>

			<?php
			}
			if ($row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "undefined" && $row_select_pipe['soundness'] != "0") { ?>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Soundness by Le-Chatelier method</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['sou_s_d'])); ?>&nbsp;&nbsp;to&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['sou_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 3)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['soundness'] . " mm"; ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo "maximum 10 mm"; ?></td>
				</tr>
			<?php
			}
			if ($row_select_pipe['sba_res_obtained'] != null && $row_select_pipe['sba_res_obtained'] != "" && $row_select_pipe['sba_res_obtained'] != "undefined" && $row_select_pipe['sba_res_obtained'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Soundness by Autoclave Method</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['fin_s_d'])); ?>&nbsp;&nbsp;to&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['fin_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 3)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['sba_res_obtained']) {
																										echo $row_select_pipe['sba_res_obtained'] . " %";
																									} ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"> <?php echo "maximun 0.8 %"; ?></td>
				</tr>
			<?php
			}
			if ($row_select_pipe['avg_density'] != null && $row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "undefined" && $row_select_pipe['avg_density'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Specific Gravity</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['den_e_d'])); ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 11)1988 <br> RA 2019</td>
					</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php echo $row_select_pipe['avg_density']; ?></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">-</td>
				</tr>
			<?php
			}
			if ($row_select_pipe['avg_com_1'] != null && $row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "undefined" && $row_select_pipe['avg_com_1'] != "0") { ?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><?php $cnt++;
																										echo $cnt; ?></td>
					<td style="border:1px solid black;border-left:0px solid black;  text-align:start; font-size: 12px">&nbsp;Compressive strength of cement &nbsp;</td>
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['caste_date1'])); ?></td>
					<td rowspan="4" style="border:1px solid black;border-left:0px solid black; font-size: 12px">IS 4031 (PART 6)1988 <br> RA 2019</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"></td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px; vertical-align: top;"></td>
				</tr>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 10px; font-size: 12px"></td>
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 6px; font-size: 12px; text-align:start;">&nbsp;&nbsp; 72 &plusmn; 1 hr</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null  && $row_select_pipe['test_date1'] != "1970-01-01" && $row_select_pipe['test_date1'] != "0000-00-00") {
																														echo date("d/m/Y", strtotime($row_select_pipe['test_date1']));
																													} ?></td>

					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) {
																										echo $row_select_pipe['avg_com_1'] . "&nbsp;N/mm<sup>2</sup>";
																									} else {
																										echo "Awaited";
																									} ?> </td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">minimum 16 N/mm<sup>2</sup></td>
				</tr>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><b></b></td>
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 6px; font-size: 12px; text-align:start;">&nbsp;&nbsp; 168 &plusmn; 2 hr</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php if ($row_select_pipe['test_date2'] != "" && $row_select_pipe['test_date2'] != "0" && $row_select_pipe['test_date2'] != null  && $row_select_pipe['test_date2'] != "1970-01-01" && $row_select_pipe['test_date2'] != "0000-00-00") {
																														echo date("d/m/Y", strtotime($row_select_pipe['test_date2']));
																													} ?></td>

					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != null) {
																										echo $row_select_pipe['avg_com_2'] . "&nbsp;N/mm<sup>2</sup>";
																									} else {
																										echo "Awaited";
																									} ?> </td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">minimum 22 N/mm<sup>2</sup></td>
				</tr>

				<tr style="text-align:center;">
					<td style="border:1px solid black;border-left:0px solid black;  font-size: 12px"><b></b></td>
					<td style="border:1px solid black;border-left:0px solid black; padding: 0 0 6px; font-size: 12px; text-align:start;">&nbsp;&nbsp; 672 &plusmn; 4 hr</td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">&nbsp;&nbsp; <?php if ($row_select_pipe['test_date3'] != "" && $row_select_pipe['test_date3'] != "0" && $row_select_pipe['test_date3'] != null && $row_select_pipe['test_date3'] != "1970-01-01" && $row_select_pipe['test_date3'] != "0000-00-00") {
																														echo date("d/m/Y", strtotime($row_select_pipe['test_date3']));
																													} ?></td>

					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px"><?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != null) {
																										echo $row_select_pipe['avg_com_3'] . "&nbsp;N/mm<sup>2</sup>";
																									} else {
																										echo "Awaited";
																									} ?> </td>
					<td style="border:1px solid black;border-left:0px solid black; font-size: 12px">minimum 33 N/mm<sup>2</sup></td>
				</tr>
			<?php
			
			}
			
			?>
		</table>
	<?php
	
	} else if ($type_of_cement == "PSC") {
	
	?>

	<?php
	
	}
	
	?>

	<!--  -->
	<br>
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
			
			<tr>
				<td>
					<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
						
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
<script src="jquery.min.js"></script>
<script type="text/javascript">
	function header() {
		if (document.querySelector('#header_hide_show').checked) {
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" width="150px">');
			document.getElementById("footer").insertAdjacentHTML("afterbegin", '<img src="../images/stamp_tag.png" width="160px">');
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
		} else {
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br>');
			document.getElementById("footer").innerHTML = '';
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');
		}
	}
</script>