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
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from span_paver_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$cons = $row_select['condition_of_sample_receved'];
	$sample_sent_by = $row_select['sample_sent_by'];
	$branch_name = $row_select['branch_name'];
	
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
			$detail_sample = $row_select3['mt_name'];
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
		$paver_thickNess = $row_select4['paver_thickNess'];
		$paver_grade = $row_select4['paver_grade'];
	}

	$pagecnt = 1;
	$totalcnt = 1;
	$cnt = 1;
	if ($row_select_pipe['avgv'] != "" && $row_select_pipe['avgv'] != "0" && $row_select_pipe['avgv'] != null) {
		$totalcnt++;
	}

	?>

<?php 
	      
	        ?>


	<br>
	<br>
	<page size="A4">
		
		<table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 20px;">Paver Block</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>COMPRESSIVE STRENGTH</td>
            </tr>
            <tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                <td  class="report-cell" style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 15658
				</td>
            </tr>
            <tr>
                <td  class="report-cell" style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>1</td>
            </tr>
            <tr>
                <td class="report-cell"  style=" text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
            </tr>    
    </table>
    <br>
    <table align="center" style="width: 92%;text-align: left;" cellspacing="0" cellpadding="10px">
        <tr>
            <td style="font-weight: bold;">Age of Specimen:</td>
        </tr>
        <tr>
            <td style="font-weight: bold;"> Area Calculation:  A<sub>sw</sub> =  <u> 20000  M<sub>sp</sub></u> mm<sup>2</sup> <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M<sub>std</sub></td>
        </tr>
    </table>
    <br>
        <table align="center" style="width: 92%;text-align: center;" cellspacing="0" cellpadding="5px">
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold;">S.NO</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold;">AREA (mm<sup>2</sup>)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold;">LOAD (kN)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold;border-right: 1px solid;">COMPRESSIVE STRENGTH (N/mm<sup>2</sup>)</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;"></td>
                <td style="border-top: 1px solid;border-left: 1px solid;">A</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">L</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">CS = L/A X 1000</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">1</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['area_1'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_1'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_1'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">2</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['area_2'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_2'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_2'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">3</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['area_3'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_3'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_3'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">4</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['area_4'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_4'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_4'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">5</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['area_5'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_5'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_5'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">6</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['area_6'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_6'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_6'];?></td> 
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">7</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['area_7'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_7'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_7'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">8</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['area_8'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_8'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_8'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-weight: bold;" colspan="3">AVERAGE VALUE </td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;border-right: 1px solid;"><?php 
						$com_values = [
							$row_select_pipe['com_1'],
							$row_select_pipe['com_2'],
							$row_select_pipe['com_3'],
							$row_select_pipe['com_4'],
							$row_select_pipe['com_5'],
							$row_select_pipe['com_6'],
							$row_select_pipe['com_7'],
							$row_select_pipe['com_8']
						];
						
						$average = array_sum($com_values) / count($com_values);
						echo number_format($average, 2);
						?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold;border-right: 1px solid;" colspan="4">As  Per IS 15658 : 2006 from Table No. 5 Correction factor for&nbsp;&nbsp;<u><?php echo $row_select_pipe['factor'];?></u>&nbsp;&nbsp;mm <br> thick&nbsp;&nbsp;<u> <?php echo $row_select_pipe['thick'];?></u>&nbsp;&nbsp;Block is&nbsp;&nbsp;<u> <?php echo $paver_shape;?></u>&nbsp;&nbsp;</td>
                
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid; font-family: 'calibri';font-size: 15px;font-weight: bold;" colspan="3">    CORRECTED VALUE(Average Value × C.F)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;border-right: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['avg_corr'];?></td>
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
        <table style="width: 95%;" align="center">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
          </tr>
        </table>
		<br>
		<br>
		<div class="pagebreak"></div>
		
		<br>
		<br>
		
		<table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 20px;">Paver Block</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>DIMENSION HEIGHT-LENGHT-WIDTH</td>
            </tr>
            <tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 15658
				</td>
            </tr>
            <tr>
                <td  class="report-cell" style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td  class="report-cell" style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>2</td>
            </tr>
            <tr>
                <td class="report-cell"  style=" text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
            </tr>    
    </table>
    <br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family:calibri;border-collapse:collapse;"  cellspacing="0" cellpadding="2px">
		<tr>
			<td style="border: 1px solid;font-weight:bold;width:15%;">S.No</td>
			<td style="border: 1px solid;font-weight:bold;">Height</td>
			<td style="border: 1px solid;font-weight:bold;">Length</td>
			<td style="border: 1px solid;font-weight:bold;">Width</td>
		</tr>
		<tr>
			<td style="border:1px solid;">1</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['h1_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['l1_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['w1_1'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;">2</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['h2_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['l2_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['w2_1'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;">3</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['h3_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['l3_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['w3_1'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;">4</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['h4_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['l4_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['w4_1'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;">5</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['h5_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['l5_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['w5_1'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;">6</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['h6_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['l6_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['w6_1'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;">7</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['h7_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['l7_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['w7_1'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;">8</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['h8_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['l8_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['w8_1'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;font-weight:bold;">Average</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['height_avg'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['length_avg'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['width_avg'];?></td>
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
	 <table style="width: 92%;" align="center">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
          </tr>
        </table>
	<div class="pagebreak"></div>
	<br>
	<br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 20px;">Paver Block</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>WATER ABSORPTION</td>
            </tr>
            <tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 15658
				</td>
            </tr>
            <tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>3</td>
            </tr>
            <tr>
                <td class="report-cell"  style=" text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                <td  class="report-cell" style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
            </tr>    
    </table>
	<br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family:calibri;border-collapse:collapse;"  cellspacing="0" cellpadding="2px">
		<tr>
			<td style="border: 1px solid;font-weight:bold;width:15%;">S.No</td>
			<td style="border: 1px solid;font-weight:bold;">Description</td>
			<td style="border: 1px solid;font-weight:bold;">Sample No.1</td>
			<td style="border: 1px solid;font-weight:bold;">Sample No.2</td>
			<td style="border: 1px solid;font-weight:bold;">Sample No.3</td>
		</tr>
		<tr>
			<td style="border:1px solid;">1</td>
			<td style="border:1px solid;text-align:left;">Wt.of saturated surface dry Paver Block (W1)gm.</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['wtr_w1_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['wtr_w1_2'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['wtr_w1_3'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;">2</td>
			<td style="border:1px solid;text-align:left;">Wt. of oven dried Paver Block (W2)gm.</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['wtr_w2_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['wtr_w2_2'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['wtr_w2_3'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;">3</td>
			<td style="border:1px solid;text-align:left;">Water absorption=(W1-W2)*100/W2(%)</td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['wtr_1'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['wtr_2'];?></td>
			<td style="border:1px solid;"><?php echo $row_select_pipe['wtr_3'];?></td>
		</tr>
		<tr>
			<td style="border:1px solid;"colspan="2">Average=</td>
			<td style="border:1px solid;"colspan="3"><?php echo $row_select_pipe['avg_wtr'];?></td>
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
	 <table style="width: 92%;" align="center">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
          </tr>
        </table>
	
	</page>

		

</body>

</html>


<script type="text/javascript">

</script>