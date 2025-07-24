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
/* Container for your content */
.container {
    position: relative;
    z-index: 1;
}

/* Watermark fixed at center of screen */
.watermark {
   position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
    background-image: url('../img/dcs_logo_2.jpg');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    opacity: 1.9;
    pointer-events: none;
    z-index: -1;
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
	
	$authorize_by = $row_select['reported_by_authorize'];
	$verify_by = $row_select['reported_by_review'];

$user_name = "select * from `multi_login` WHERE `id`='$authorize_by'";
	$result_for_select = mysqli_query($conn, $user_name);
	$user = mysqli_fetch_array($result_for_select);
	
	$a_name = $user['staff_fullname'];
	
	$verify_name = "select * from `multi_login` WHERE `id`='$verify_by'";
	$result_for_verify_select = mysqli_query($conn, $verify_name);
	$user_1 = mysqli_fetch_array($result_for_verify_select);	

	$v_name = $user_1['staff_fullname'];
	
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

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `isdeleted`='0'";
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
	
	<page size="A4">
<div id="header">
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
 <?php if($_SESSION['isadmin']!=4){ ?>
<?php if($_SESSION['isadmin']==2){ ?>
<div class="watermark"></div>
<div class="container">
<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()">
<?php } ?>
       <table  style="width: 95%;font-family: 'Calibri';font-size:12px;" align="center">
        <tr>
            <td style="font-size:16px;text-align: right;">QSF-1002</td>
        </tr>
    </table>
    <table  style="width: 95%;font-family: 'Calibri';font-size:12px;border: 1px solid;border-bottom:1px solid;text-align: left;" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;width: 25%;">ULR No.</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;width: 25%;"><?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;width: 25%;">Test Report No.</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;width: 25%;"><?php echo $report_no; ?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Report Issue</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($issue_date));?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Sample Received</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sample Name</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">CEMENT <?php echo $row_select_pipe['cement_grade'];?> GRADE</td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Unique Identity of Sample</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo $lab_no;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Letter</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php  if ($row_select['date'] != "" && $row_select['date'] != null && $row_select['date'] != "0") { echo date('d/m/Y', strtotime($row_select["date"])); } else {echo "---NIL---";}?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Letter No.</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php  if ($r_name != "" && $r_name != null && $r_name != "0") { echo $r_name; } else {echo "---NIL---";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Test Start</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($start_date));?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Test Complete</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($end_date));?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sampling Quantity</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php// echo $no_of_rows; ?>1 Nos.</td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Source of Sample *</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php if ($mark != "" && $mark != null && $mark != "0") { echo $mark; } else {echo "-";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Name of Client</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo $clientname;?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Make*</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo $cement_brand;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Agency/Name & Address </td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;" colspan="3"><?php echo $clientname;?>,<?php echo $client_address;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;;">Name of Work</td>
            <td style="padding: 2px 5px;;border-bottom: 1px solid;" colspan="3"><?php echo $name_of_work;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;border-right: 1px solid;padding: 2px 5px;">Discipline/Group</td>
            <td style="padding: 2px 5px;;" colspan="3">Mechanical- Buildings Materials</td>
		</tr>
	  </table>
	    <?php } ?>
	 
      <table  style="width: 95%;font-family: 'Calibri';font-size:14px; border-top: 1px solid;" cellspacing="0" cellpadding="0" align="center">
				
				<tr style="text-align:center;font-weight: bold;">
					<td style="width:12%;font-weight:bold;border-left: 1px solid;height: 50px;width: 5%;">S.No</td>
                       <td style="border-left: 1px solid;">Test Parameters</td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;" rowspan="2">Units</td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;" rowspan="2">Test result</td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;" rowspan="2">Test Method</td>
					<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;" rowspan="2">specification as Per<br>
					<?php
							if ($grade == "PPC") {
								echo "IS 1489 (Part -1): 2015 RA2020";
							} else {
								echo "IS 269 2015 RA2020";
							}
							?>
					</td>
				</tr>
				<?php
				$cnt = 1;
				if (!empty($row_select_pipe['avg_com_1']) && $row_select_pipe['avg_com_1'] != "0") {
				?>
					<tr style="text-align:left; font-weight: bold;">
						<td style="width:12%; font-weight: bold; border: 1px solid;border-right: 0px solid; text-align: center;"><?php echo $cnt++; ?>.</td>
						<td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;border-top: 1px solid;">Compressive Strength</td>
					</tr>
					<tr>
						<td style="text-align: center; border-left: 1px solid; border-bottom: 1px solid;">A</td>
						<td style="padding: 0 10px; border-left: 1px solid; border-bottom: 1px solid;">3 Days (72±1h)</td>
						<td style="border-left: 1px solid; border-bottom: 1px solid; text-align: center;" rowspan="3">(N/mm<sup>2</sup>)</td>
						<td style="padding: 0 10px; border-left: 1px solid; border-bottom: 1px solid; text-align: center;"><?php echo $row_select_pipe['avg_com_1']; ?></td>
						<td style="border-left: 1px solid; border-bottom: 1px solid; text-align: center;" rowspan="3">IS 4031 (P6):1988 RA 2019</td>
						<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;text-align: center;">
							<?php
							$grade = $row_select_pipe['cement_grade'];
							if ($grade == "33 OPC" || $grade == "PPC") {
								echo "16";
							} elseif ($grade == "43 OPC") {
								echo "23";
							} elseif ($grade == "53 OPC") {
								echo "27";
							} else {
								echo "-";
							}
							?> Min.
						</td>
					</tr>
					<tr>
						<td style="text-align: center; border-left: 1px solid; border-bottom: 1px solid;">B</td>
						<td style="padding: 0 10px; border-left: 1px solid; border-bottom: 1px solid;">7 Days (168±2h)</td>
						<td style="padding: 0 10px; border-left: 1px solid; border-bottom: 1px solid; text-align: center;"><?php echo $row_select_pipe['avg_com_2']; ?></td>
						<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;text-align: center;">
							<?php
							if ($grade == "33 OPC" || $grade == "PPC") {
								echo "22";
							} elseif ($grade == "43 OPC") {
								echo "33";
							} elseif ($grade == "53 OPC") {
								echo "37";
							} else {
								echo "-";
							}
							?> Min.
						</td>
					</tr>
					<tr>
						<td style="text-align: center; border-left: 1px solid; border-bottom: 1px solid;">C</td>
						<td style="padding: 0 10px; border-left: 1px solid; border-bottom: 1px solid;">28 Days (672±4h)</td>
						<td style="padding: 0 10px; border-left: 1px solid; border-bottom: 1px solid; text-align: center;"><?php echo $row_select_pipe['avg_com_3']; ?></td>
						<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;text-align: center;">
							<?php
							if ($grade == "33 OPC" || $grade == "PPC") {
								echo "33";
							} elseif ($grade == "43 OPC") {
								echo "43";
							} elseif ($grade == "53 OPC") {
								echo "53";
							} else {
								echo "-";
							}
							?> Min.
						</td>
					</tr>
				<?php
				}
				if (!empty($row_select_pipe['ss_area']) && $row_select_pipe['ss_area'] != "0") {
				?>
					<tr>
						<td style="text-align: center; border-left: 1px solid; border-bottom: 1px solid;"><b><?php echo $cnt++; ?>.</b></td>
						<td style="padding: 0 10px; border-left: 1px solid; border-bottom: 1px solid;"><b>Fineness</b></td>
						<td style="border-left: 1px solid; border-bottom: 1px solid; text-align: center;">m<sup>2</sup>/kg</td>
						<td style="padding: 0 10px; border-left: 1px solid; border-bottom: 1px solid; text-align: center;"><?php echo $row_select_pipe['ss_area']; ?></td>
						<td style="border-left: 1px solid; border-bottom: 1px solid; text-align: center;">IS 4031 (P-2):1999 RA 2018</td>
						<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;text-align: center;">
							<?php
							if ($grade == "PPC") {
								echo "300";
							} else {
								echo "225";
							}
							?> Min.
						</td>
					</tr>
				<?php  
				} if ($row_select_pipe['ss_area_1'] != "" && $row_select_pipe['ss_area_1'] != null && $row_select_pipe['ss_area_1'] != "0") { 
				?>
                <tr>
					<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;"><b>3.</b></td>
                       <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;"><b>Fineness By Dry Sieving</b></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" >%</td>
					<td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['ss_area_1'];?></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" >IS 4031 (P-1):1996 RA 2021</td>
					<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;text-align: center;">-</td>
				</tr>
				<?php  
				} if ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != null && $row_select_pipe['final_consistency'] != "0") { 
				?>
				<tr>
					<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;"><b>4.</b></td>
                       <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;"><b>Consistency</b></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" >%</td>
					<td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['final_consistency'];?></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" >IS 4031 (P-4):1988 RA 2019</td>
					<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;text-align: center;">-</td>
				</tr>
                <?php  
				} if ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != null && $row_select_pipe['avg_density'] != "0") { 
				?>
				<tr>
					<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;"><b>5.</b></td>
                       <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;"><b>Density</b></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" >grams/cc</td>
					<td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['avg_density'];?></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" >IS 4031 (P-11):1988 RA 2019</td>
					<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;text-align: center;">-</td>
				</tr>
				<?php  
				} if ($row_select_pipe['final_time'] != "" && $row_select_pipe['final_time'] != null && $row_select_pipe['final_time'] != "0") { 
				?>
                <tr>
					<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;"><b>6.</b></td>
                       <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;"><b>Final Setting Time</b></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" >min.</td>
					<td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['final_time'];?></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" >IS 4031 (P-5):1988 RA 2019</td>
					<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;text-align: center;">600 Max.</td>
				</tr>
                <?php  
				} if ($row_select_pipe['initial_time'] != "" && $row_select_pipe['initial_time'] != null && $row_select_pipe['initial_time'] != "0") { 
				?>
				<tr>
					<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;"><b>7.</b></td>
                    <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;"><b>Initial Setting Time</b></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" >min.</td>
					<td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['initial_time'];?></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" >IS 4031 (P-5):1988 RA 2019</td>
					<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;text-align: center;">30 Min.</td>
				</tr>
                <?php  
				} if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "0") { 
				?>
				<tr>
					<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;"><b>8.</b></td>
                    <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;"><b>Soundness By Le-chetelier </b></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;">mm</td>
					<td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['soundness'];?></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;">IS 4031 (P-3):1988 RA 2019</td>
					<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom:1px solid;text-align: center;">10 Max.</td>
				</tr>
				<?php } ?>
             </table>
        <table  style="width: 95%;font-family: 'Calibri';font-size:15px;border: 1px solid;border-top: 0px solid;" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td style="padding: 0 10px;" colspan="5"><i><b> Remarks: - </b>The Sample Confirms to <?php
							if ($grade == "PPC") {
								echo "IS 1489 (Part -1): 2015 RA2020";
							} else {
								echo "IS 269 2015 RA2020";
							}
							?> w.r.t above test only </i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>.</b>&nbsp;&nbsp;&nbsp;&nbsp;* Indicates information provided by the customer.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>.</b>&nbsp;&nbsp;&nbsp;&nbsp;The test results given above pertain to the sample as received.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;text-align: center;border-top: 1px solid;" colspan="6"><i><b>***End of Report***<br>(Jai Hind)</b></i></td>
            </tr>
            <tr>
               <td style="border-top: 1px solid;border-right: 1px solid;height: 100px;text-align: center;vertical-align: bottom;width:50%;" colspan="3"><i><b>Reviewed By<br><u><?php echo $v_name; ?> </u></b></i></td>
                <td style="border-top: 1px solid;height: 100px;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Authorized By<br></b><u><?php echo $a_name; ?> </u></i></td>
            </tr>
        </table>
<div id="footer" style="vertical-align: bottom;bottom:0px;position:relative;width:100%; margin: 0 auto; border-collapse: collapse; margin-top: 10px;">


		</div>
		</div>
	</page>
	
</body>

</html>
<script src="jquery.min.js"></script>
<script type="text/javascript">
	function header() {
    const headerCheckbox = document.querySelector('#header_hide_show');
    const headerElement = document.getElementById('header');
    const footerElement = document.getElementById('footer');

    if (headerCheckbox && headerCheckbox.checked) {
        // Show letterhead header and footer
        headerElement.innerHTML = '<img src="../img/dcs_letter_header.png" width="100%">';
        footerElement.innerHTML = '<img src="../img/dcs_letter_footer.png" width="100%">';
    } else {
        // Add spacing and clear footer
        headerElement.innerHTML = '<br><br><br><br><br><br><br><br><br>';
        footerElement.innerHTML = '';
    }
}
</script>