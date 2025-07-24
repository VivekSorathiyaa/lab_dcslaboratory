<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
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

		font-size: 11px;
		font-family : Calibri;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}
	.report-cell {
        font-size: 16px; /* or use 'large', '18px', etc. */
        padding: 5px 8px;
        font-family: Arial, sans-serif;
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



	$page_cont = round_up($no_of_rows / 4);

	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	 $row_select_pipe = mysqli_fetch_array($result_tiles_select);



	$ans = mysqli_fetch_array($result_tiles_select);


	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$r_date = $row_select['date'];
	$agSTCment_no = $row_select['agSTCment_no'];
	$branch_name = $row_select['branch_name'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$l1 = $row_select['l1'];
	$cons = $row_select['condition_of_sample_receved'];
	
	$tested_by = $row_select['tested_by'];
	$verify_by = $row_select['reported_by_review'];
	$user_name = "select * from `multi_login` WHERE `id`='$tested_by'";
	$result_for_select = mysqli_query($conn, $user_name);
	$user = mysqli_fetch_array($result_for_select);
	
	$u_name = $user['staff_fullname'];
	
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
	}

	 $flag = 0;
	 $a = 1;
	 $down = 0;
	 $up = 4;
	 for ($a = 1; $a <= $page_cont; $a++) {


	?>

	
	<page size="A4">
		<table align="center" style="width: 100%;text-align: center;border:0.5px solid;border-bottom:0px;">
		<tr>
		<td>
		<br>
		<table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
        <tbody>
              <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 17px;">Concrete Cubes</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;" colspan="4">
        &nbsp;Job Card No:&nbsp;<?php echo $job_no;?>
    </td>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
        &nbsp;Test:&nbsp;Compressive Strength
    </td>
</tr>
<tr>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;" colspan="4">
        &nbsp;Sample Description:&nbsp;<?php echo $row_select_pipe['s_des'];?>
    </td>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
        &nbsp;Method:&nbsp;IS 516 ( Part 4)
    </td>
</tr>
<tr>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;" colspan="2">
        &nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?>
    </td>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">
        &nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?>
    </td>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">
        &nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?>
    </td>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">
        &nbsp;Page No:&nbsp;1
    </td>
</tr>
<tr>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;" colspan="3">
        &nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['cc_qty'];?>
    </td>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2">
        &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?>
    </td>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">
        &nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?>
    </td>
</tr>
        </tbody>
		
    </table>
	<br>
	<br>
	
    <!-- <hr style="border: 1px solid;">  -->
	</td>
	</tr>
	</table>
	<table align="center" style="width: 100%;border:0.5px solid;">
	<tr>
	<td>
	
	<br>
	<br>
	<br>
    <table align="center" style="width: 100%;">
	
        <tr>
            <td style="font-family: 'calibri';font-size: 18px;font-weight: bold;text-align: center;"><u><?php echo $row_select_pipe['day1'];?></u>&nbsp;&nbsp;Days Testing Compressive Strength of  Concrete Cubes of Grade/Ratio&nbsp;&nbsp;<u><?php echo $row_select_pipe['grade1'];?></u>&nbsp;&nbsp;</td>
        </tr>
		
    </table>
	
    <table align="center" style="width: 95%;">
        <tr>
            <td style="font-family: 'calibri';font-size: 16px;font-weight: bold;text-align: center;"> 
                As Per IS (516:Part1/Sec1: 2021)</td>
        </tr>
    </table>
    <br>
    <table  align="center" style="width: 95%;text-align: center;" cellspacing="0" cellpadding="5px">
        <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;">S.N.</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;">Date of <br>Casting</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;">Date of <br>Testing</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;">X – Section <br>Area (mm<sup>2</sup>)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;">Weight <br>of Cube <br>(Kg)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;">Failure <br>Load (kN)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;border-right: 1px solid;">Compressive <br>Strength <br>(N/mm<sup>2</sup>)</td>
        </tr>
		<?php $count = 1;
						$cnt = 1;
						$select_tilesy5 = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
						$coming_row = mysqli_num_rows($result_tiles_select15);

						while ($row_select_pipe1 = mysqli_fetch_array($result_tiles_select15)) {
							$flag++;
							$br++;
							$cntrw++;
						?>
    <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;">1.</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;" rowspan="3"><?php echo date('d-m-Y', strtotime($row_select_pipe1['caste_date1']));?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;" rowspan="3"><?php echo date('d-m-Y', strtotime($row_select_pipe1['test_date1']));?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;"><?php echo $row_select_pipe1['cross_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;"><?php echo $row_select_pipe1['mass_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;"><?php echo $row_select_pipe1['load_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;border-right: 1px solid;"><?php echo $row_select_pipe1['comp_1'];?></td>
    </tr>
    <tr>
        <td style="border-top: 1px solid;border-left: 1px solid;">2.</td>
        <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;"><?php echo $row_select_pipe1['cross_2'];?></td>
        <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;"><?php echo $row_select_pipe1['mass_2'];?></td>
        <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;"><?php echo $row_select_pipe1['load_2'];?></td>
        <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;border-right: 1px solid;"><?php echo $row_select_pipe1['comp_2'];?></td>
    </tr>
    <tr>
        <td style="border-top: 1px solid;border-left: 1px solid;">3.</td>
        <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;"><?php echo $row_select_pipe1['cross_3'];?></td>
        <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;"><?php echo $row_select_pipe1['mass_3'];?></td>
        <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;"><?php echo $row_select_pipe1['load_3'];?></td>
        <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;border-right: 1px solid;"><?php echo $row_select_pipe1['comp_3'];?></td>
    </tr>
    <tr>
        <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid; font-weight: bold;" colspan="6">Average Compressive Strength (N/mm<sup>2</sup>)</td>
        <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid; font-weight: bold;"><?php echo $row_select_pipe1['avg_com_s_1'];?></td>
    </tr>
	<?php 
		
			if($flag==3)
											{
												
												break;
												
											}
											}
		 ?>

    </table>
    <table align="center" style="width: 95%;" cellpadding="10px">
        <tr>
            <td style="font-family: 'calibri';font-size: 16px;font-weight: bold;"> 
                D.O.S:-&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?> </td>
        </tr>
    </table>
    <table align="center" style="width: 95%;" cellpadding="10px">
        <tr>
            <td style="font-family: 'calibri';font-size: 16px;font-weight: bold;"> 
                D.O.C:-&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
        <table style="width: 92%;" align="center">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
          </tr>
        </table>
		<br>
		<br>
		<br>
		<br>
		</td>
		</tr>
		</table>
	</page>
<?php
			
			if($flag==2)
			{
					$flag=0;
					$down=$up;
					$up +=2;
					?>
					<div class="pagebreak"> </div>
			<?php }
			
			
			}
			
		?>
	<!-- <br>
		<br>


		<page size="A4">
		<?php if ($branch_name == "Nadiad") { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-001</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } else { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name; ?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-001</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>	
		
		<br>	
		<br>
		<table align="center" width="94%" class="test1" height="9%">

			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample; ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no . "_01" ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Specimen Size</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp;<?php echo substr($ans['l1'], 0, 3); ?> &nbsp;x&nbsp; <?php echo substr($ans['b1'], 0, 3); ?> &nbsp;x&nbsp; <?php echo substr($ans['h1'], 0, 3); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>5</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y", strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>
		
		<table align="center" width="94%" class="test1" style="" Height="35%">
			<tr>
				<td colspan="4" style="text-align:center;"><b>Age of Testing : <?php if ($ans['day1'] != '' && $ans['day1'] != 0 && $ans['day1'] != null) {
																					echo $ans['day1'];
																				} else {
																					echo '-';
																				} ?></b></td>
				<td colspan="6" style="text-align:center;"><b>Grade of concrete &nbsp; : &nbsp; <?php echo $cc_grade; ?></b></td>
				<td colspan="3" style="border:1px solid;text-align:center;"><b>Date : - <?php echo date('d-m-Y', strtotime($ans['test_date1'])); ?></b></td>
			</tr>
			<tr>
				<td colspan="4" style="text-align:left;"><b>Start Curing Date : <?php echo date('d-m-Y', strtotime($start_date)); ?></b></td>
				<td colspan="6" style="text-align:left;"><b>End Curing Date : - <?php echo date('d-m-Y', strtotime($end_date)); ?></b></td>
				<td colspan="3" rowspan="2" style="border:1px solid;text-align:center;"><b>IS 516 (Part - 1/Sec -1): 2021</b></td>
			</tr>
			<tr>
				<td colspan="4" style="text-align:left;"><b>Start Curing Temp : </b></td>
				<td colspan="6" style="text-align:left;"><b>End Curing Temp : -</b></td>
			</tr> 
			<tr style="border-top:1px solid;" >
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Sr.<br>No</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Cube<br>ID</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Date of<br>Casting</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Date of<br>Testing</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Weigh<br>t (kg)</b></td>
				<td colspan="3" style="border-left:1px solid;border-bottom:1px solid;text-align:center;"><b>Dimension (mm)</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>C / S<br>Area<br>(mm<sup>2</sup>)A</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Density<br>(kg / m<sup>3</sup>)</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Max<br>Load<br>at<br>failure<br>(KN)<br>F</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Comp.<br>strength<br>= F / A<br>N / mm <sup>2</sup></b></td>
				<td rowspan="2" style="	border-right:1px solid;border-left:1px solid;text-align:center;"><b>Type of <br>Fracture<br>(1 / 2)</b></td>
			</tr>
			<tr>
				<td style="border-left:1px solid;text-align:center;transform:rotate(270deg);"><b>Length </b></td>
				<td style="border-left:1px solid;text-align:center;transform:rotate(270deg);"><b>Width</b></td>
				<td style="border-left:1px solid;text-align:center;transform:rotate(270deg);"><b>Height</b></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">1</td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $cc_grade; ?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;transform:rotate(330deg);"><?php if ($casting_date != '' && $casting_date != 0 && $casting_date != null) {
																												echo date('d-m-Y', strtotime($casting_date));
																											} else {
																												echo '-';
																											} ?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;transform:rotate(330deg);"><?php if ($ans['test_date1'] != '' && $ans['test_date1'] != 0 && $ans['test_date1'] != null) {
																												echo date('d-m-Y', strtotime($ans['test_date1']));
																											} else {
																												echo '-';
																											} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['mass_1'] != '' && $ans['mass_1'] != 0 && $ans['mass_1'] != null) {
																			echo $ans['mass_1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['l1'] != '' && $ans['l1'] != 0 && $ans['l1'] != null) {
																			echo $ans['l1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['b1'] != '' && $ans['b1'] != 0 && $ans['b1'] != null) {
																			echo $ans['b1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['h1'] != '' && $ans['h1'] != 0 && $ans['h1'] != null) {
																			echo $ans['h1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['cross_1'] != '' && $ans['cross_1'] != 0 && $ans['cross_1'] != null) {
																			echo $ans['cross_1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['mass_1'] != '' && $ans['mass_1'] != 0 && $ans['mass_1'] != null) {
																			echo ($ans['mass_1'] / 1000);
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['load_1'] != '' && $ans['load_1'] != 0 && $ans['load_1'] != null) {
																			echo $ans['load_1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['comp_1'] != '' && $ans['comp_1'] != 0 && $ans['comp_1'] != null) {
																			echo $ans['comp_1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;"><?php if ($ans['fail_pat_1'] != '' && $ans['fail_pat_1'] != 0 && $ans['fail_pat_1'] != null) {
																								echo $ans['fail_pat_1'];
																							} else {
																								echo '-';
																							} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">2</td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $cc_grade; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['mass_2'] != '' && $ans['mass_2'] != 0 && $ans['mass_2'] != null) {
																			echo $ans['mass_2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['l2'] != '' && $ans['l2'] != 0 && $ans['l2'] != null) {
																			echo $ans['l2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['b2'] != '' && $ans['b2'] != 0 && $ans['b2'] != null) {
																			echo $ans['b2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['h2'] != '' && $ans['h2'] != 0 && $ans['h2'] != null) {
																			echo $ans['h2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['cross_2'] != '' && $ans['cross_2'] != 0 && $ans['cross_2'] != null) {
																			echo $ans['cross_2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['mass_2'] != '' && $ans['mass_2'] != 0 && $ans['mass_2'] != null) {
																			echo ($ans['mass_2'] / 1000);
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['load_2'] != '' && $ans['load_2'] != 0 && $ans['load_2'] != null) {
																			echo $ans['load_2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['comp_2'] != '' && $ans['comp_2'] != 0 && $ans['comp_2'] != null) {
																			echo $ans['comp_2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;"><?php if ($ans['fail_pat_2'] != '' && $ans['fail_pat_2'] != 0 && $ans['fail_pat_2'] != null) {
																								echo $ans['fail_pat_2'];
																							} else {
																								echo '-';
																							} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">3</td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $cc_grade; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['mass_3'] != '' && $ans['mass_3'] != 0 && $ans['mass_3'] != null) {
																			echo $ans['mass_3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['l3'] != '' && $ans['l3'] != 0 && $ans['l3'] != null) {
																			echo $ans['l3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['b3'] != '' && $ans['b3'] != 0 && $ans['b3'] != null) {
																			echo $ans['b3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['h3'] != '' && $ans['h3'] != 0 && $ans['h3'] != null) {
																			echo $ans['h3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['cross_3'] != '' && $ans['cross_3'] != 0 && $ans['cross_3'] != null) {
																			echo $ans['cross_3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['mass_3'] != '' && $ans['mass_3'] != 0 && $ans['mass_3'] != null) {
																			echo ($ans['mass_3'] / 1000);
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['load_3'] != '' && $ans['load_3'] != 0 && $ans['load_3'] != null) {
																			echo $ans['load_3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['comp_3'] != '' && $ans['comp_3'] != 0 && $ans['comp_3'] != null) {
																			echo $ans['comp_3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;"><?php if ($ans['fail_pat_3'] != '' && $ans['fail_pat_3'] != 0 && $ans['fail_pat_3'] != null) {
																								echo $ans['fail_pat_3'];
																							} else {
																								echo '-';
																							} ?></td>
			</tr>
			<tr style="border-top:1px solid;font-size:15px;">
				<td colspan="11" style="border-left:1px solid;text-align:center;text-align:right;"><b>Average &nbsp; &nbsp; </b></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($ans['avg_com_s_1'] != '' && $ans['avg_com_s_1'] != 0 && $ans['avg_com_s_1'] != null) {
																			echo $ans['avg_com_s_1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;"><?php if ($ans['fail_pat_1'] != '' && $ans['fail_pat_1'] != 0 && $ans['fail_pat_1'] != null) {
																								echo substr((($ans['fail_pat_1'] + $ans['fail_pat_2'] + $ans['fail_pat_3']) / 3), 0, 3);
																							} else {
																								echo '-';
																							} ?></td>
			</tr>
			<tr style="border-top:1px solid;font-size:15px;" >
				<td colspan="13" style="">&nbsp; &nbsp;Rate of Loading 14 N/mm2/min (or 5.25 KN/S)</td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" style="" Height="20%">
			<tr style="font-size:15px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewed By:</b>
					</div>
				</td>
			</tr>		
		</table>
		
		
		
		
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
		</table>
		<table align="center" width="94%" style="" Height="5%">
			<tr style="font-size:15px;" >
				<td style="text-align:center;"><b>Page 1 of 1</b></td>
			</tr>		
		</table>
			
			
			
			
			
		</page>

	<?php
	// }

	?> -->


</body>

</html>


<script type="text/javascript">


</script>