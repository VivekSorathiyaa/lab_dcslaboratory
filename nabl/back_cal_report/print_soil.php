<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 30px 30px;
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
		font-family: Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 13px;
		font-family: Calibri;
	}

	.test1 {
		font-size: 13px;
		border-collapse: collapse;
		font-family: Calibri;

	}

	.tdclass1 {

		font-size: 11px;
		font-family: Calibri;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}

	.tr {
		height: 30px;
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
	$select_tiles_query = "select * from soil WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			$mt_name = $row_select3['mt_name'];

			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$chainage_no = $row_select4['chainage_no'];
		$type_method = $row_select4['type_method'];
		$source = $row_select4['soil_source'];
		$sample_type = $row_select4['sample_type'];
		$soil_location = $row_select4['soil_location'];
		$material_location = $row_select4['material_location'];
	}

	?>


	<page size="A4">



		<br><br>

		<!--harsh-->




		<br>
		<br>
		<page size="A4">


			<!-- WATER CONTENT  -->

			<table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px" cellspacing="0" cellpadding="2px">
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
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 20px;">Soil</td>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6"> ANALYSIS DATA SHEET </td>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;"> QSF-1001</td>
				</tr>
				<tr>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no']; ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:Water Content&nbsp;</b></td>
				</tr>
				<tr>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des']; ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>
					</td>
				</tr>
				<tr>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date'])); ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date'])); ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date'])); ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b></td>
				</tr>
				<tr>
					<td style=" text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['qty_1']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam']; ?></td>
					<td  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret']; ?></td>
				</tr>
			</table>


			<br>
			<table style="border:1px solid black;width: 95%;text-transform: capitalize;font-family:book antiqua;"align="center" cellspacing="0">
				<tr>
					<td style="border:0px solid;border-bottom:1px solid;font-weight:bold;width:15%;" colspan="4">Determination of Water Content of Soil</td>
				</tr>
			<tr align="left">
				<td style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;width:40%;"><b></b></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;width:20%;"><b>1</b></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;"><b>2 </b></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;border-right:0px;"><b>3 </b></td>
			</tr>
			<tr align="left">
				<td style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;font-Weight:bold;">Weight container with lid (m1)</td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;"><?php  echo $row_select_pipe['shr_wm1']; ?></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;"><?php  echo $row_select_pipe['shr_wm2']; ?></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;border-right:0px;"><?php  echo $row_select_pipe['shr_wm3']; ?></td>
			</tr>
			<tr align="left">
				<td style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;font-Weight:bold;">Weight of container with sample (m2)</td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;0px;"><?php  echo $row_select_pipe['shr_v1']; ?></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;0px;"><?php  echo $row_select_pipe['shr_v2']; ?></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;border-right:0px;"><?php  echo $row_select_pipe['shr_v3']; ?></td>
			</tr>
			<tr align="left">
				<td style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;font-Weight:bold;">Weight of  container with sample after dry</td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;0px;"><?php  echo $row_select_pipe['shr_w2_1']; ?></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;0px;"><?php  echo $row_select_pipe['shr_w2_2']; ?></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;border-right:0px;"><?php  echo $row_select_pipe['shr_w2_3']; ?></td>
			</tr>
			<tr align="left">
				<td style="font-size:18px;border-right:1px solid black;border-top:0px;border-left:0px;font-Weight:bold;">Water content</td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;0px;border-bottom:0px;"><?php  echo $row_select_pipe['shr_w3_1']; ?></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;0px;border-bottom:0px;"><?php  echo $row_select_pipe['shr_w3_2']; ?></td>
				<td align="center" style="font-size:18px;border:1px solid black;border-top:0px;border-left:0px;border-right:0px;border-bottom:0px;"><?php  echo $row_select_pipe['shr_w3_3']; ?></td>
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
			<table style="width: 95%;" align="center">
				<tr>
					 <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
				</tr>
			</table>



			<div class="pagebreak"></div>




			<!-- SPECIFIC  GRAVITY OF SOIL -->

			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>


			<table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px" cellspacing="0" cellpadding="2px">
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
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 20px;">Soil</td>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6"> ANALYSIS DATA SHEET </td>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;"> QSF-1001</td>
				</tr>
				<tr>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no']; ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:S.G. of Soil.&nbsp;</b></td>
				</tr>
				<tr>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des']; ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>
					</td>
				</tr>
				<tr>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date'])); ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date'])); ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date'])); ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b></td>
				</tr>
				<tr>
					<td  class="report-cell"  style=" text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['qty_1']; ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam']; ?></td>
					<td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret']; ?></td>
				</tr>
			</table>

			<br>
			<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family:calibri;border-collapse:collapse;" cellspacing="0" cellpadding="2px">
				<tr>
					<td style="border: 0px solid;font-weight:bold;width:30%;">SPECIFIC GRAVITY FINE SOIL</td>

				</tr>
				<tr>
					<td style="border: 0px solid;font-weight:bold;width:30%;">As Per IS : 2720 PART-3</td>

				</tr>
			</table>
			<br>

			<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family:calibri;border-collapse:collapse;" cellspacing="0" cellpadding="2px">
				<tr>
					<td style="border: 1px solid;font-weight:bold;width:30%;"></td>
					<td style="border: 1px solid;font-weight:bold;width:20%;"></td>
					<td style="border: 1px solid;font-weight:bold;width:10%;">Unit</td>
					<td style="border: 1px solid;font-weight:bold;width:10%;">1</td>
					<td style="border: 1px solid;font-weight:bold;width:10%;">2</td>
				</tr>
				<tr>
					<td style="border:1px solid;text-align:left;">Wt. of Density Bottle</td>
					<td style="border:1px solid;">W1</td>
					<td style="border:1px solid;">gm</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['mpykn1']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['mpykn2']; ?></td>
				</tr>
				<tr>
					<td style="border:1px solid;text-align:left;">Wt. of Density Bottle + dry soil</td>
					<td style="border:1px solid;">W2</td>
					<td style="border:1px solid;">gm</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['mpykn_ds1']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['mpykn_ds2']; ?></td>
				</tr>
				<tr>
					<td style="border:1px solid;text-align:left;">Wt. of Density Bottle + Soil + Water</td>
					<td style="border:1px solid;">W3</td>
					<td style="border:1px solid;">gm</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['mpykn_sw1']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['mpykn_sw2']; ?></td>
				</tr>
				<tr>
					<td style="border:1px solid;text-align:left;">Wt. of Density Bottle + Water</td>
					<td style="border:1px solid;">W4</td>
					<td style="border:1px solid;">gm</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['mpykn_fw1']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['mpykn_fw2']; ?></td>
				</tr>
				<tr>
					<td style="border:1px solid;text-align:left;">Specfic Gravity</td>
					<td style="border:1px solid;">W2-W1/<br>(W4-W1) - (W3-W2)</td>
					<td style="border:1px solid;">%</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['sgrt1']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['sgrt2']; ?></td>
				</tr>
				<tr>
					<td colspan="2" style="border:1px solid;text-align:left;">Average</td>
					<td style="border:1px solid;">%</td>
					<td colspan="2"style="border:1px solid;"><?php echo ($row_select_pipe['sgrt2'] + $row_select_pipe['sgrt2'])/ 2; ?></td>
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
			<table style="width: 95%;" align="center">
				<tr>
					 <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
				</tr>
			</table>



			<div class="pagebreak"></div>


			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>




			<!-- Sieve Analysis -->


			<table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px" cellspacing="0" cellpadding="2px">
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
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 20px;">Soil</td>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6"> ANALYSIS DATA SHEET </td>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;"> QSF-1001</td>
				</tr>
				<tr>
					<td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:Sieve Analysis&nbsp;</b></td>
				</tr>
				<tr>
					<td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>
					</td>
				</tr>
				<tr>
					<td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date'])); ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date'])); ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date'])); ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b></td>
				</tr>
				<tr>
					<td style=" text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['qty_1']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret']; ?></td>
				</tr>
			</table>


			<br>
			<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family:calibri;border-collapse:collapse;" cellspacing="0" cellpadding="2px">
				<tr>
					<td style="border: 0px solid;font-weight:bold;width:15%;" colspan="5">GRAIN SIZE ANALYSIS OF SOIL</td>
				</tr>
				<tr>
					<td style="border: 0px solid;font-weight:bold;width:15%;" colspan="5">(As Per IS: 2720 ,Part-4)</td>
				</tr>

				<tr>
					<td style="border:1px solid;width:20%;">IS SIEVE<BR>(mm).</td>
					<td style="border:1px solid;width:20%;">Weight <br>Retained (gms)</td>
					<td style="border:1px solid;width:20%;">Cumulative Wt.<BR> Retained (gms)</td>
					<td style="border:1px solid;width:20%;">Cumulative % <br>Retained </td>
					<td style="border:1px solid;width:20%;">% of Passing</td>

				</tr>
				<tr>
					<td style="border:1px solid;">100 mm</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border:1px solid;">75 mm</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border:1px solid;">20 mm</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;">10 mm</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;">4.75 mm</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;">2.0 mm</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;">425 μ </td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border:1px solid;">75 μ</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border: 0px solid;width:15%; text-align: left;" colspan="5">Gravel Content = <?php echo $row_select_pipe['']; ?> %</td>
				</tr>
				<tr>
					<td style="border: 0px solid;width:15%; text-align: left;" colspan="5">Sand Content = <?php echo $row_select_pipe['']; ?> %</td>
				</tr>
				<tr>
					<td style="border: 0px solid;width:15%; text-align: left;" colspan="5">Sit & Clay Content = <?php echo $row_select_pipe['']; ?> %</td>
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
			<br>
			<br>



			<!-- CBR -->


			<table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px" cellspacing="0" cellpadding="2px">
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
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 20px;">Soil</td>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6"> ANALYSIS DATA SHEET </td>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;"> QSF-1001</td>
				</tr>
				<tr>
					<td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:CBR&nbsp;</b></td>
				</tr>
				<tr>
					<td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>
					</td>
				</tr>
				<tr>
					<td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date'])); ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date'])); ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date'])); ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b></td>
				</tr>
				<tr>
					<td style=" text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['qty_1']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret']; ?></td>
				</tr>
				<tr>
					<td style=" text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;MDD/OMC &nbsp;</b><?php echo $row_select_pipe['qty_1']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Method of Compaction&nbsp;</b><?php echo $row_select_pipe['r_sam']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Period of Soaking&nbsp;</b><?php echo $row_select_pipe['s_ret']; ?></td>
				</tr>
			</table>


			<br>
			<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family:calibri;border-collapse:collapse;" cellspacing="0" cellpadding="2px">
				<tr>
					<td style="border: 0px solid;font-weight:bold;width:15%;" colspan="6">CALIFORNIA BEARING RATIO (CBR) TEST (SOAKED/UNSOAKED)</td>
				</tr>
				<tr>
					<td style="border: 0px solid;font-weight:bold;width:15%;" colspan="6">(As Per IS: 2720 ,Part-16)</td>
				</tr>

				<tr>
					<td style="border:1px solid;width:25%;font-weight:bold;text-align: left;">No. of Blow</td>
					<td style="border:1px solid;width:10%;font-weight:bold;">Unit</td>
					<td style="border:1px solid;width:15%;font-weight:bold;"></td>
					<td style="border:1px solid;width:20%;font-weight:bold;"></td>
					<td style="border:1px solid;width:20%;font-weight:bold;"></td>
					<td style="border:1px solid;width:10%;font-weight:bold;">Remark</td>


				</tr>
				<tr>
					<td style="border:1px solid;text-align: left;">Mould No.</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>


				</tr>
				<tr>
					<td style="border:1px solid;text-align: left;">Volume of Mould</td>
					<td style="border:1px solid;">cc</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border:1px solid;text-align: left;">Wt of Mould</td>
					<td style="border:1px solid;">gms</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;text-align: left;">Wt of Mould + Wet Soil</td>
					<td style="border:1px solid;">gms</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;text-align: left;">Wt of Wet Soil</td>
					<td style="border:1px solid;">gms</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;text-align: left;">Wet Density</td>
					<td style="border:1px solid;">gm/cc</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;text-align: left;">Moisture Content </td>
					<td style="border:1px solid;">%</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border:1px solid;text-align: left;">Dry Density </td>
					<td style="border:1px solid;">gm/cc</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;text-align: left;">% Compaction </td>
					<td style="border:1px solid;">%</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border: 0px solid;width:15%;font-weight: bold; " colspan="6">FINAL MOISTURE CONTENT DETERMINATION</td>
				</tr>


				<tr>
					<td style="border:1px solid;width:25%;font-weight:bold;text-align: left;">No. of Blow</td>
					<td style="border:1px solid;width:10%;font-weight:bold;">Unit</td>
					<td style="border:1px solid;width:15%;font-weight:bold;"></td>
					<td style="border:1px solid;width:20%;font-weight:bold;"></td>
					<td style="border:1px solid;width:20%;font-weight:bold;"></td>
					<td style="border:1px solid;width:10%;font-weight:bold;"></td>


				</tr>
				<tr>
					<td style="border:1px solid;text-align: left;">Container No.</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>


				</tr>
				<tr>
					<td style="border:1px solid;text-align: left;">Wt of Cont. + Wet Soil</td>
					<td style="border:1px solid;">gms</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border:1px solid;text-align: left;">Wt of Cont. + Dry Soil</td>
					<td style="border:1px solid;">gms</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;text-align: left;">Wt of Empty Container</td>
					<td style="border:1px solid;">gms</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;text-align: left;">Wt of Water</td>
					<td style="border:1px solid;">gms</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>

				<tr>
					<td style="border:1px solid;text-align: left;">Wet Dry Soil</td>
					<td style="border:1px solid;">gms</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
			</table>
			<table align="center" style="width: 95%;text-align: center;border:1px solid black; border-top:0px;font-family:calibri;border-collapse:collapse;" cellspacing="0" cellpadding="2px">
			<tr>
				<td style="border: 0px solid;width:15%;text-align: left; " colspan="6"><SPAN style="font-weight: bold;">TEST DATA</SPAN> &nbsp;(Proving Ring Multification Factor = 1 Div = <?php echo $row_select_pipe['']; ?> Kg)</td>
			</tr>

			<tr>
				<td style="border:1px solid;width:25%;font-weight:bold;text-align: left;">No. of Blow</td>
				<td style="border:1px solid;width:20%;font-weight:bold;" colspan="2"></td>
				<td style="border:1px solid;width:20%;font-weight:bold;" colspan="2"></td>
				<td style="border:1px solid;width:20%;font-weight:bold;" colspan="2"></td>
				<td style="border:1px solid;width:15%;font-weight:bold;"></td>
			</tr>

			<tr>
				<td style="border:1px solid;font-weight:bold;">Penetration mm</td>
				<td style="border:1px solid;font-weight:bold;">Divn.</td>
				<td style="border:1px solid;font-weight:bold;">Load (Kg)</td>
				<td style="border:1px solid;font-weight:bold;">Divn.</td>
				<td style="border:1px solid;font-weight:bold;">Load (Kg)</td>
				<td style="border:1px solid;font-weight:bold;">Divn.</td>
				<td style="border:1px solid;font-weight:bold;">Load (Kg)</td>
				<td style="border:1px solid;font-weight:bold;"></td>

			</tr>
			<tr>
				<td style="border:1px solid;">0.5</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>

			<tr>
				<td style="border:1px solid;">1.0</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>

			<tr>
				<td style="border:1px solid;">1.5</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>

			<tr>
				<td style="border:1px solid;">2.0</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>

			<tr>
				<td style="border:1px solid;">2.5</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>

			<tr>
				<td style="border:1px solid;">3.0</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>



			<tr>
				<td style="border:1px solid;">4.0</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>




			<tr>
				<td style="border:1px solid;">5.0</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>

			<tr>
				<td style="border:1px solid;">7.5</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>

			<tr>
				<td style="border:1px solid;">10.0</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>

			<tr>
				<td style="border:1px solid;">12.5</td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>
			<tr>
				<td style="border:1px solid;font-weight: bold;">CBR%</td>
				<td style="border:1px solid;" colspan="2"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;" colspan="2"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;" colspan="2"><?php echo $row_select_pipe['']; ?></td>
				<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

			</tr>

			<tr>
				<td style="border:1px solid;font-weight: bold;text-align: left;">CBR 2.5mm%</td>
				<td style="border:1px solid;" colspan="7"><?php echo $row_select_pipe['']; ?></td>


			</tr>

			<tr>
				<td style="border:1px solid;font-weight: bold;text-align: left;">CBR 5.0mm%</td>
				<td style="border:1px solid;" colspan="7"><?php echo $row_select_pipe['']; ?></td>


			</tr>



			</table>
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
		</page>


		<!--harsh end -->

		<?php if ($row_select_pipe['l1'] != "" && $row_select_pipe['l1'] != "0" && $row_select_pipe['l1'] != null) { ?>
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
								<td style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>
								<td style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
								<td style="width:25%;font-weight:bold;">Page : 7</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
								<td style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
							</tr>

						</table>

					</td>
				</tr>
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
								<td style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:20px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">

							<tr style="">

								<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON SOIL</td>
							</tr>
							<?php
							if ($row_select_pipe['lab_no'] != "") {
								$cnt = 1;
							?>
								<tr style="font-size:10px;">

									<td style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
									<td style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>
									<td style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
								</tr>
							<?php }
							if ($job_no != "") {
							?>
								<tr style="font-size:10px;">

									<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
									<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
								</tr>
							<?php }
							//if($job_no!=""){
							?>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
							</tr>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">

							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">LIGHT COMPACTION (PROCTOR) TEST As Per IS: 2720 (Part-7): 1980 Reaffirmed: 2021, Clause No :-5-Light Compaction</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-bottom:0px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Amount of Sample Taken :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;width: 10%;"><?php echo $row_select_pipe["amts1"] ?>gm</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Type Of Test:-</td>
								<td style="padding: 2px; font-weight: bold; text-align: left;">&nbsp;&nbsp; Light Compation</td>
								<td style="width: 5%;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Diameter of Mould :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["amts2"] ?>cm</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Volume of mould (Vm) :-</td>
								<td style="padding: 2px; font-weight: bold; text-align: left;">&nbsp;&nbsp; <?php echo $row_select_pipe["amts3"] ?>cm</td>
								<td style="width: 5%;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0; padding-bottom:15px;">Height of Mould :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0; padding-bottom:15px;"><?php echo $row_select_pipe["amts4"] ?> cm</td>
								<td></td>
								<td></td>
								<td style="width: 5%;"></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr>
					<?php $cnt = 1; ?>
					<td style="border: 2px solid; border-top:0px solid; border-bottom:0px solid;">
						<table align="center" width="60%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid; border-top:2px solid; border-bottom:2px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="3">Sr.No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> Full Weight of Mould </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> Empty Weight of Mould </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> Bulk Density </td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> m<sub>2</sub> </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> m<sub>1</sub> </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> Xm = (m<sub>2</sub>-m<sub>1</sub>) / Vm<sub>2</sub></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> gm </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> gm </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> g / cm<sup>3</sup> </td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou1"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou2"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou1_1"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou2_1"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou3_1"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou1_2"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou2_2"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou3_2"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou1_3"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou2_3"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou3_3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou1_4"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou2_4"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou3_4"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou1_5"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou2_5"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou3_5"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou1_6"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou2_6"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou3_6"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou1_7"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou2_7"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou3_7"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou1_8"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou2_8"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou3_8"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou1_9"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou2_9"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["mou3_9"] ?></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr>
					<td style="border: 2px solid; border-top:0px solid; border-bottom:0px solid;">
						<?php $cnt = 1; ?>
						<table align="center" width="82%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;
						border-right: 2px solid; border-top:1px solid; margin-top: 10px; border-bottom: 2px solid; margin-bottom: 5px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid; border-bottom: 2px solid;" rowspan="5">Sr.No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid; border-bottom: 2px solid;" rowspan="5" colspan="">Container No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="3">Container Weight</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="2"> Container Weight<br>+ Wet Sample<br> Weight </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="2">Container Weight<br>+ Dry Sample<br>Weight </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="2">Moisture Content </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid; width: 15%;" rowspan="2"> Dry Density </td>
							</tr>
							<tr>

							</tr>
							<tr>
								<!-- <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Load</td> -->
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2"> m<sub>2</sub> </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2px;"> m<sub>3</sub> </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2"> W = (m<sub>2</sub>-m<sub>3</sub>) / (m<sub>2</sub>-m<sub>3</sub>)</u> X 100 </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2"> γ<sup>d</sup> = <u>100γm</u> <br> &nbsp; &nbsp; &nbsp; &nbsp; 10 + w </td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> m<sub>1</sub> </td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; padding: 2px;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; padding: 2px;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; padding: 2px;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">%</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">g / cm<sup>3</sup></td>
								<!-- <td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">cm²</td> -->
								<!-- <td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">kg / cm²</td> -->
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou9"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou4_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou5_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou6_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou7_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou8_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou9_1"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou4_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou5_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou6_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou7_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou8_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou9_2"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou4_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou5_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou6_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou7_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou8_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou9_3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou4_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou5_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou6_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou7_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou8_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou9_4"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou4_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou5_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou6_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou7_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou8_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou9_5"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou4_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou5_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou6_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou7_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou8_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou9_6"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou4_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou5_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou6_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou7_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou8_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou9_7"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou4_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou5_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou6_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou7_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou8_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou9_8"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou4_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou5_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou6_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou7_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou8_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["mou9_9"] ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
							<tr>
								<td style="border-left: 1px solid;width: 10%;"></td>
								<td style="">Maximum Dry Density (MDD) :-</td>
								<td style=""><?php echo $row_select_pipe["l1"] ?> g/cm<sup>2</sup></td>
								<td style="">Optimum Moisture Content (OMC) :-</td>
								<td style=""><?php echo $row_select_pipe["l2"] ?> %</td>
								<td style="border-right: 1px solid;width: 10%;"></td>
							</tr>
							<tr>
								<td colspan="6" style="padding: 6px;border-left: 1px solid; border-right: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>

				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2']; ?></td>
			</tr> -->
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
							</tr>
							<tr>
								<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>

						</table>
					</td>
				</tr>
				<tr>
					<td>

					</td>
				</tr>
			</table>

			<div class="pagebreak"></div>

			<br><br>
		<?php  }
		if ($row_select_pipe['h1'] != "" && $row_select_pipe['h1'] != "0" && $row_select_pipe['h1'] != null) { ?>
			<!-- heavy Compaction -->

			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
								<td style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>
								<td style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
								<td style="width:25%;font-weight:bold;">Page : 7</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
								<td style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
							</tr>

						</table>

					</td>
				</tr>
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
								<td style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:20px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">

							<tr style="">

								<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON SOIL</td>
							</tr>
							<?php
							if ($row_select_pipe['lab_no'] != "") {
								$cnt = 1;
							?>
								<tr style="font-size:10px;">

									<td style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
									<td style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>
									<td style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
								</tr>
							<?php }
							if ($job_no != "") {
							?>
								<tr style="font-size:10px;">

									<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
									<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
								</tr>
							<?php }
							//if($job_no!=""){
							?>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
							</tr>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">

							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">HEAVY COMPACTION (PROCTOR) TEST As Per IS: 2720 (Part-8): 1983 Reaffirmed: 2020, Clause No:-5-Heavy Compaction</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-bottom:0px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Amount of Sample Taken :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;width: 10%;"><?php echo $row_select_pipe["typs1"] ?>gm</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Type Of Test:-</td>
								<td style="padding: 2px; font-weight: bold; text-align: left;">&nbsp;&nbsp; Heavy Compaction</td>
								<td style="width: 5%;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Diameter of Mould :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["typs2"] ?>cm</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Volume of mould (Vm) :-</td>
								<td style="padding: 2px; font-weight: bold; text-align: left;">&nbsp;&nbsp; <?php echo $row_select_pipe["typs3"] ?>cm</td>
								<td style="width: 5%;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0; padding-bottom:15px;">Height of Mould :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0; padding-bottom:15px;"><?php echo $row_select_pipe["typs4"] ?> cm</td>
								<td></td>
								<td></td>
								<td style="width: 5%;"></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr>
					<?php $cnt = 1; ?>
					<td style="border: 2px solid; border-top:0px solid; border-bottom:0px solid;">
						<table align="center" width="60%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid; border-top:2px solid; border-bottom:2px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="3">Sr.No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> Full Weight of Mould </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> Empty Weight of Mould </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> Bulk Density </td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> m<sub>2</sub> </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> m<sub>1</sub> </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> Xm = (m<sub>2</sub>-m<sub>1</sub>) / Vm<sub>2</sub></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> gm </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> gm </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> g / cm<sup>3</sup> </td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy1"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy2"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy1_1"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy2_1"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy3_1"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy1_2"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy2_2"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy3_2"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy1_3"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy2_3"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy3_3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy1_4"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy2_4"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy3_4"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy1_5"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy2_5"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy3_5"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy1_6"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy2_6"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy3_6"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy1_7"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy2_7"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy3_7"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy1_8"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy2_8"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy3_8"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy1_9"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy2_9"] ?></td>
								<td style="font-weight: bold;text-align: center;border: 1px solid;"><?php echo $row_select_pipe["heavy3_9"] ?></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr>
					<td style="border: 2px solid; border-top:0px solid; border-bottom:0px solid;">
						<?php $cnt = 1; ?>
						<table align="center" width="82%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;
					border-right: 2px solid; border-top:1px solid; margin-top: 10px; border-bottom: 2px solid; margin-bottom: 5px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid; border-bottom: 2px solid;" rowspan="5">Sr.No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid; border-bottom: 2px solid;" rowspan="5" colspan="">Container No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="3">Container Weight</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="2"> Container Weight<br>+ Wet Sample<br> Weight </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="2">Container Weight<br>+ Dry Sample<br>Weight </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="2">Moisture Content </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid; width: 15%;" rowspan="2"> Dry Density </td>
							</tr>
							<tr>

							</tr>
							<tr>
								<!-- <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Load</td> -->
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2"> m<sub>2</sub> </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2px;"> m<sub>3</sub> </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2"> W = (m<sub>2</sub>-m<sub>3</sub>) / (m<sub>2</sub>-m<sub>3</sub>)</u> X 100 </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2"> γ<sup>d</sup> = <u>100γm</u> <br> &nbsp; &nbsp; &nbsp; &nbsp; 10 + w </td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> m<sub>1</sub> </td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; padding: 2px;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; padding: 2px;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; padding: 2px;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">%</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">g / cm<sup>3</sup></td>
								<!-- <td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">cm²</td> -->
								<!-- <td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">kg / cm²</td> -->
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy9"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy4_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy5_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy6_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy7_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy8_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy9_1"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy4_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy5_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy6_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy7_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy8_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy9_2"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy4_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy5_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy6_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy7_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy8_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy9_3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy4_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy5_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy6_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy7_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy8_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy9_4"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy4_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy5_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy6_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy7_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy8_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy9_5"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy4_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy5_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy6_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy7_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy8_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy9_6"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy4_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy5_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy6_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy7_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy8_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy9_7"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy4_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy5_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy6_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy7_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy8_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy9_8"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy4_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy5_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy6_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy7_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy8_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["heavy9_9"] ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
							<tr>
								<td style="border-left: 1px solid;width: 10%;"></td>
								<td style="">Maximum Dry Density (MDD) :-</td>
								<td style=""><?php echo $row_select_pipe["h1"] ?> g/cm<sup>2</sup></td>
								<td style="">Optimum Moisture Content (OMC) :-</td>
								<td style=""><?php echo $row_select_pipe["h2"] ?> %</td>
								<td style="border-right: 1px solid;width: 10%;"></td>
							</tr>
							<tr>
								<td colspan="6" style="padding: 6px;border-left: 1px solid; border-right: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>

				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
							</tr>
							<tr>
								<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>

						</table>
					</td>
				</tr>

			</table>

			<div class="pagebreak"></div><br><br>

		<?php }
		if ($row_select_pipe['corre67'] != "" && $row_select_pipe['corre67'] != "0" && $row_select_pipe['corre67'] != null) { ?>
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
								<td style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>
								<td style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
								<td style="width:25%;font-weight:bold;">Page : 7</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
								<td style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
							</tr>

						</table>

					</td>
				</tr>
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
								<td style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:20px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">

							<tr style="">

								<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON SOIL</td>
							</tr>
							<?php
							if ($row_select_pipe['lab_no'] != "") {
								$cnt = 1;

							?>
								<tr style="font-size:10px;">

									<td style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
									<td style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>
									<td style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
								</tr>
							<?php }
							if ($job_no != "") {
							?>
								<tr style="font-size:10px;">

									<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
									<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
								</tr>
							<?php }
							//if($job_no!=""){
							?>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
							</tr>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">

							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">UNCONFINED COMPRESSIVE STRENGTH TEST As Per IS: 2720 (Part-10): 1991 Reaffirmed: 2020, Clause No:- 1.1</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Load cell Capacity:-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["str1"] ?> KN</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Load cell Least Count:-</td>
								<td style="padding: 2px; font-weight: bold;"><?php echo $row_select_pipe["str2"] ?> KN</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Length of Specimen - L<sub>o</sub> :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["str3"] ?> mm</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Diameter of Specimen - Do :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["str4"] ?> mm</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Original Cross Sectional Area - Ao :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["str5"] ?> cm<sup>2</sup></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Initial Volume - Vo :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["str6"] ?> cm<sup>3</sup></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Initial Mass of Specimen :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["str7"] ?> gm</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Initial Density :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["str8"] ?> gm/cm³</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Initial Water Content :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["str9"] ?> %</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Weight of Specimen after Test :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["str10"] ?> gm</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0; padding-bottom: 20px;">Rate of Strain :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0; padding-bottom: 20px;"><?php echo $row_select_pipe["str11"] ?> mm/min</td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<?php $cnt = 1; ?>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid; border-bottom: 2px solid;" rowspan="4">Time</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid; border-bottom: 2px solid;" rowspan="4" colspan="2">Load</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid; height:40px;" rowspan="3">Displacement</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="2">Axial Strain</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="2">Corrected Area</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top: 2px solid;" rowspan="2">Unconfined Compressive<br> Strength</td>
							</tr>
							<tr>

							</tr>
							<tr>
								<!-- <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Load</td> -->
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2"> E = ΔL / Lo </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2px;"> A = Ao / (1 - E) </td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2"> σ<sub>c</sub> = P / A</td>
								<!-- <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Load</td> -->
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> ΔL </td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; padding: 2px;">min</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; padding: 2px;">KN</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; padding: 2px;">kg</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">mm</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">--</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">cm²</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid; border-bottom: 2px solid; border-top: 2px solid; padding: 2px;">kg / cm²</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre67"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.25</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre68"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre69"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.75</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc12"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre70"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">1.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc14"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc15"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre71"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">1.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc16"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc17"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc18"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre12"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre72"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">2.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc19"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc20"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc21"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre14"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre73"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">2.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc22"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc23"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc24"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre15"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre16"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre74"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">3.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc25"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc26"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc27"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre17"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre18"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre75"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">3.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc28"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc29"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc30"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre19"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre20"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre76"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">4.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc31"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc32"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc33"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre21"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre22"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre77"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">4.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc34"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc35"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc36"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre23"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre24"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre78"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">5.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc37"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc38"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc39"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre25"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre26"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre79"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">5.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc40"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc41"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc42"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre27"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre28"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre80"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">6.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc43"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc44"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc45"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre29"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre30"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre81"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">6.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc46"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc47"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc48"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre31"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre32"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre82"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">7.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc50"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc51"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc52"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre33"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre34"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre83"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">7.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc53"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc54"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc55"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre35"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre36"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre84"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">8.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc56"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc57"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc58"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre37"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre38"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre85"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">8.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc59"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc60"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc61"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre39"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre40"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre86"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">9.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc62"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc63"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc64"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre41"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre42"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre87"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">9.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc65"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc66"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc67"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre43"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre44"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre88"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">10.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc68"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc69"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc70"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre45"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre46"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre89"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">10.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc71"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc72"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc73"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre47"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre48"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre90"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">11.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc74"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc75"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc76"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre49"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre50"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre91"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">11.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc77"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc78"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc79"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre51"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre52"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre92"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">12.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc80"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc81"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc82"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre53"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre54"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre93"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">12.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc83"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc84"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc85"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre55"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre56"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre94"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">13.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc86"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc87"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc88"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre57"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre58"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre95"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">13.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc89"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc90"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc91"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre59"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre60"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre96"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">14.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc92"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc93"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc94"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre61"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre62"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre97"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">14.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc95"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc96"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc97"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre63"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre64"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre98"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">15.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc98"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc99"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["unc100"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre65"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre66"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["corre99"] ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
							</tr>
							<tr>
								<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>

						</table>
					</td>
				</tr>

			</table>

			<div class="pagebreak"></div><br><br>
		<?php }
		if ($row_select_pipe['fdry1'] != "" && $row_select_pipe['fdry1'] != "0" && $row_select_pipe['fdry1'] != null) { ?>
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
								<td style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>
								<td style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
								<td style="width:25%;font-weight:bold;">Page : 7</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
								<td style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
							</tr>

						</table>

					</td>
				</tr>
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
								<td style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:20px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">

							<tr style="">

								<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON SOIL</td>
							</tr>
							<?php
							if ($row_select_pipe['lab_no'] != "") {
								$cnt = 1;

							?>
								<tr style="font-size:10px;">

									<td style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
									<td style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>
									<td style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
								</tr>
							<?php }
							if ($job_no != "") {
							?>
								<tr style="font-size:10px;">

									<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
									<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
								</tr>
							<?php }
							//if($job_no!=""){
							?>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
							</tr>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">


							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">Field Dry Density & Field Moisture Content (I.S.: 2720-Part 29-1995, I.S.: 2720-Part 2-1997)</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">

							<tr>
								<td style="padding: 1px;" colspan="2">Sample Extracted from: Shelby / Corecutter</td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- table design -->
				<tr>
					<td>
						<?php $cnt = 1; ?>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;" rowspan="3">Sr. <br>No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">BH <br> No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">BH <br> Sample <br> Depth</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Height <br> of Sellby</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Soil</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Height</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Diameter</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Volume of <br> Soil Sample</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Empty <br> Weight of <br> Shelby</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Weight of <br> Shelby + <br> Wet Soil</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Bulk Density,</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;" rowspan="3">Cont. <br> No</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Cont.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Cont.+ Wet <br> Sample Wt</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Cont.+ Dry <br> Sample Wt</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Moisture <br> Content</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Field Dry Density, <br> gm/cc</td>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Sample ID</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">of Sample</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gb, gm/cc</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Weight</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-bottom: 2px solid;" rowspan="2">(M2-M3)/(M3- <br> M1)</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">mtr.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">cm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">cm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">cm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">(Vs), cm³</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">(We), cm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">(Ws), cm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">(Ws-We)/Vs</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">M1, gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">M2, gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">M3, gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">gb/(1+MC/100)</td>
							</tr>

							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_1"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry1"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_2"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry2"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_3"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry3"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_4"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry4"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_5"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry5"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_6"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry6"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_7"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry7"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_8"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry8"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_9"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry9"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_10"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry10"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_11"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry11"] ?></td>
							</tr>
							<tr>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_no12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bh_d12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hs_12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_id12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height_sam_12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["diam_12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["emp_12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_s_12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["bulk_12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_w_12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_wet12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cont_dry12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["moi_12"] ?></td>
								<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdry12"] ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="17"></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
							</tr>
							<tr>
								<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>

						</table>
					</td>
				</tr>

			</table>


			<div class="pagebreak"></div>
			<br><br><br><br>

		<?php }
		if ($row_select_pipe['avg_shr1'] != "" && $row_select_pipe['avg_shr1'] != "0" && $row_select_pipe['avg_shr1'] != null) { ?>
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
								<td style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>
								<td style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
								<td style="width:25%;font-weight:bold;">Page : 7</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
								<td style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
							</tr>

						</table>

					</td>
				</tr>
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
								<td style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:20px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">

							<tr style="">

								<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON SOIL</td>
							</tr>
							<?php
							if ($row_select_pipe['lab_no'] != "") {
								$cnt = 1;

							?>
								<tr style="font-size:10px;">

									<td style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
									<td style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>
									<td style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
								</tr>
							<?php }
							if ($job_no != "") {
							?>
								<tr style="font-size:10px;">

									<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
									<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
								</tr>
							<?php }
							//if($job_no!=""){
							?>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
							</tr>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">

							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">SHRINKAGE LIMIT TEST As Per IS: 2720 (Part-6): 1972 Reaffirmed: 2021, Clause No.5</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- table design -->
				<tr>
					<td>
						<?php $cnt = 1; ?>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;border-bottom: 2px solid;" rowspan="2">Sr. <br>No.</td>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;border-bottom: 2px solid;" rowspan="2">Description</td>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;border-bottom: 2px solid;" rowspan="2">Unit</td>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;">Results</td>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;">Soil</td>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;">Height</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">i</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">ii</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">iii</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Weight of Shrinkage Dish - W₁</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Weight of Shrinkage Dish with Wet Soil Pat - W₂</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr6"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Weight of Shrinkage Dish with Dry Soil Pat - W3</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr9"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Weight of Oven Dry Soil Pat - W = (W3-W₁)</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr12"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Weight of Water - Ww = (W₂-W3)</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr14"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr15"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Moisture Content of Wet Soil Pat-W(W₂-W3)/(W3-W₁) x 100</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">%</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr16"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr17"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr18"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Weight of Mercury Filling in Shrinkage Dish</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr19"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr20"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr21"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Density of Mercury</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">g/cm³</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr22"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr23"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr24"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Volume of Shrinkage Dish - V</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">cm³</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr25"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr26"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr27"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Weight of Mercury displaced by Dry Soil Pat</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr28"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr29"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr30"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Volume of Dry Soil Pat - V<sub>0</sub></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">cm³</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr31"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr32"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr33"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Shrinkage Limit-W [W-{(V-V)/W}] X 100</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">%</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Shrinkage Ratio - R = W<sub>0</sub>/V<sub>0</sub></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">--</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr34"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr35"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["shr36"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Average Shrinkage Limit</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">%</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" colspan="3"><?php echo $row_select_pipe["avg_shr1"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Average Shrinkage Ratio</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">--</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" colspan="3"><?php echo $row_select_pipe["avg_shr2"] ?></td>
							</tr>


						</table>
					</td>
				</tr>
				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
							</tr>
							<tr>
								<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>

						</table>
					</td>
				</tr>

			</table>

			<div class="pagebreak"></div>
			<br><br><br><br>

		<?php }
		if ($row_select_pipe['sol1'] != "" && $row_select_pipe['sol1'] != "0" && $row_select_pipe['sol1'] != null) { ?>
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
								<td style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>
								<td style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
								<td style="width:25%;font-weight:bold;">Page : 7</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
								<td style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
							</tr>

						</table>

					</td>
				</tr>
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
								<td style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:20px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">

							<tr style="">

								<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON SOIL</td>
							</tr>
							<?php
							if ($row_select_pipe['lab_no'] != "") {
								$cnt = 1;

							?>
								<tr style="font-size:10px;">

									<td style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
									<td style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>
									<td style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
								</tr>
							<?php }
							if ($job_no != "") {
							?>
								<tr style="font-size:10px;">

									<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
									<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
								</tr>
							<?php }
							//if($job_no!=""){
							?>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
							</tr>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">

							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">CONSOLIDATION TEST As Per IS: 2720 (Part-15): 1965 Reaffirmed: 2021</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Dial Guage No:-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["c1"] ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Consolidometer No.</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["c2"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Sample Type :-</td>
								<td style="padding: 2px;">Remoulded/Undisturbed</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Density of Soil :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"> <?php echo $row_select_pipe["c3"] ?> gm/cc</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Moisture Content :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["c4"] ?> %</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Mass of Soil taken :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["c5"] ?> gm</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Amount of water taken :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["c6"] ?> gm</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Specific Gravity of Soil :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["c7"] ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Volume of Consolidometer :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["c8"] ?> cm³</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Area of Specimen :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["c9"] ?> cm²</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Weight of Wet Specimen After Test :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["c10"] ?> gm</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Weight of Dry Specimen After Test :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["c11"] ?> gm</td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- table design -->
				<tr>
					<td>
						<?php $cnt = 1; ?>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:2px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;" rowspan="6">Sr. <br>No.</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;" colspan="9">Description</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 1px solid;" colspan="2">Starting Date :-</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe["s_date1"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe["s_date2"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe["s_date3"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe["s_date4"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe["s_date5"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe["s_date6"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe["s_date7"])); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 1px solid;" colspan="2">Starting Time :-</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_time1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_time2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_time3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_time4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_time5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_time6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["s_time7"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 1px solid;" colspan="2">Pressure Increment kg/cm²</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.10</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.20</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.40</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.80</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">1.60</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">3.20</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">6.40</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 1px solid;">Elapsed Time</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">vt</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["e_time1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["e_time2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["e_time3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["e_time4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["e_time5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["e_time6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["e_time7"] ?></td>
							</tr>

							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 1px solid;">minute</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["mini1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["mini2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["mini3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["mini4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["mini5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["mini6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["mini7"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.25</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.50</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_1"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.50</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.71</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_2"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">1.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">1.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">2.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">1.41</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_4"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">4.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">2.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_5"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">8.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">2.83</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_6"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_6"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">15.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">3.87</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_7"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">30.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">5.48</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_8"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">60.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">7.75</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_9"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">120.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">10.95</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_10"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">240.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">15.49</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_11"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">480.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">21.91</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_12"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_12"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_12"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_12"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_12"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_12"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_12"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">1440.00</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">37.95</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol1_13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol2_13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol3_13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol4_13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol5_13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol6_13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sol7_13"] ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
							</tr>
							<tr>
								<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>

						</table>
					</td>
				</tr>

			</table>

			<div class="pagebreak"></div>
			<br><br>
		<?php }
		if ($row_select_pipe['tri1'] != "" && $row_select_pipe['tri1'] != "0" && $row_select_pipe['tri1'] != null) { ?>

			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
								<td style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>
								<td style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
								<td style="width:25%;font-weight:bold;">Page : 7</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
								<td style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
							</tr>

						</table>

					</td>
				</tr>
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
								<td style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:20px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">

							<tr style="">

								<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON SOIL</td>
							</tr>
							<?php
							if ($row_select_pipe['lab_no'] != "") {
								$cnt = 1;

							?>
								<tr style="font-size:10px;">

									<td style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
									<td style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>
									<td style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
								</tr>
							<?php }
							if ($job_no != "") {
							?>
								<tr style="font-size:10px;">

									<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
									<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
								</tr>
							<?php }
							//if($job_no!=""){
							?>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
							</tr>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">

							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">TRIAXIAL TEST As Per IS: 2720 (Part-15): 1965 Reaffirmed: 2021</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Load cell Capacity :-</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["t1"] ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Load cell Least Count :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["t2"] ?> KN</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Type of Sample :-</td>
								<td style="padding: 2px;">Undisturbed / Remoulded</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Method of test :-</td>
								<td style="padding: 2px;">Unconsolidated Undrained / Consolidated Undrained / Consolidated Drained</td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>

				<!-- table design -->
				<tr>
					<td>
						<?php $cnt = 1; ?>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:2px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;" colspan="3">Specimen Details</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Trial-1</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Trial-2</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Trial-3</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Initial Length of Specimen</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; padding-left: 30px;"></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">cm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp6"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;" colspan="2">Area of Specimen</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">cm²</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp9"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;" colspan="2">Volume of Specimen</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">cm²</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp12"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;" colspan="2">Density of Soil</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gm/cc</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp14"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp15"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;" colspan="2">Moisture Content</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">%</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp16"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp17"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp18"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;" colspan="2">Amount of Soil taken</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp19"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp20"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp21"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;" colspan="2">Amount of Water taken</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">gm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp22"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp23"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["sp24"] ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<?php $cnt = 1; ?>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;" colspan="5"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top:2px solid;" rowspan="4">Sr. No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-top:2px solid;" colspan="4">Description</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;" rowspan="2">Time</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">Pressure - <?php echo $row_select_pipe["pres1"] ?> Kg/cm²</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">Pressure - <?php echo $row_select_pipe["pres2"] ?> Kg/cm²</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">Pressure - <?php echo $row_select_pipe["pres3"] ?> Kg/cm²</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">Load Cell Reading</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">Load Cell Reading</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">Load Cell Reading</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">min</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">KN</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">KN</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">KN</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.25</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri6"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri9"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.75</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri12"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">1.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri14"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri15"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">1.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri16"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri17"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri18"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">2.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri19"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri20"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri21"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">2.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri22"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri23"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri24"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">3.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri25"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri26"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri27"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">3.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri28"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri29"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri30"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">4.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri31"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri32"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri33"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">4.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri34"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri35"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri36"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">5.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri37"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri38"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri39"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">5.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri40"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri41"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri42"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">6.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri43"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri44"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri45"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">6.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri46"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri47"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri48"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">7.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri50"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri51"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri52"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">7.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri53"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri54"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri55"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">8.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri56"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri57"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri58"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">8.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri59"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri60"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri61"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">9.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri62"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri63"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri64"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">9.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri65"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri66"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri67"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">10.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri68"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri69"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri70"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">10.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri71"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri72"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri73"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">11.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri74"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri75"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri76"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">11.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri77"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri78"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri79"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">12.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri80"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri81"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri82"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">12.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri83"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri84"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri85"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">13.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri86"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri87"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri88"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">13.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri89"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri90"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri91"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">14.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri92"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri93"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri94"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">14.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri95"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri96"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri97"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">15.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri98"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri99"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["tri100"] ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
							</tr>
							<tr>
								<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>

						</table>
					</td>
				</tr>

			</table>
			<div class="pagebreak"></div>
			<br>
		<?php }
		if ($row_select_pipe['shear1'] != "" && $row_select_pipe['shear1'] != "0" && $row_select_pipe['shear1'] != null) { ?>

			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
								<td style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>
								<td style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
								<td style="width:25%;font-weight:bold;">Page : 7</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
								<td style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
							</tr>

						</table>

					</td>
				</tr>
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
								<td style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:20px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">

							<tr style="">

								<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON SOIL</td>
							</tr>
							<?php
							if ($row_select_pipe['lab_no'] != "") {
								$cnt = 1;

							?>
								<tr style="font-size:10px;">

									<td style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
									<td style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>
									<td style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
								</tr>
							<?php }
							if ($job_no != "") {
							?>
								<tr style="font-size:10px;">

									<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
									<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
								</tr>
							<?php }
							//if($job_no!=""){
							?>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
							</tr>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">

							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">DIRECT SHEAR TEST As Per IS: 2720 (Part-13): 1986 Reaffirmed: 2021</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Load cell Capacity:-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["di1"] ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Load cell Least Count:-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["di2"] ?> KN</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Rate of Strain :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["rate1"] ?> mm/min</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Sample Type :-</td>
								<td style="text-align: left;padding: 2px;border: 0;">Remoulded / Undisturbed</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Test Method:-</td>
								<td style="text-align: left;padding: 2px;border: 0;">Unconsolidated Undrained / Consolidated Undrained / Consolidated Drained</td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="2">Soil Specimen Measurements</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Density of Soil :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["dens1"] ?> gm/cc</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Moisture Content:-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["moist1"] ?> %</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Mass of Soil taken :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["mass_1"] ?> gm</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Amount of water taken :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["amt_1"] ?> ml</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Area of Specimen :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["amt_2"] ?> cm²</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Volume of Specimen :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["amt_3"] ?> cm³</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<?php $cnt = 1; ?>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-top:2px solid;" rowspan="4">Sr. No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-top:2px solid;" colspan="4">Description</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Time</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Pressure - <?php echo $row_select_pipe["d_pres1"] ?> Kg/cm²</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Pressure - <?php echo $row_select_pipe["d_pres2"] ?> Kg/cm²</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Pressure - <?php echo $row_select_pipe["d_pres3"] ?> Kg/cm²</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Load Cell Reading</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Load Cell Reading</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Load Cell Reading</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">min</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">KN</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">KN</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">KN</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.25</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear6"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear8"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear9"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">0.75</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear10"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear12"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">1.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear14"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear15"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">1.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear16"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear17"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear18"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">2.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear19"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear20"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear21"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">2.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear22"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear23"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear24"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">3.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear25"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear26"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear27"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">3.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear28"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear29"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear30"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">4.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear31"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear32"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear33"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">4.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear34"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear35"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear36"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">5.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear37"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear38"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear39"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">5.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear40"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear41"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear42"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">6.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear43"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear44"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear45"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">6.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear46"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear47"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear48"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">7.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear50"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear51"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear52"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">7.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear53"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear54"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear55"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">8.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear56"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear57"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear58"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">8.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear59"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear60"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear61"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">9.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear62"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear63"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear64"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">9.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear65"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear66"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear67"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">10.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear68"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear69"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear70"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">10.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear71"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear72"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear73"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">11.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear74"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear75"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear76"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">11.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear77"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear78"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear79"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">12.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear80"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear81"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear82"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">12.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear83"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear84"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear85"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">13.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear86"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear87"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear88"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">13.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear89"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear90"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear91"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">14.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear92"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear93"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear94"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">14.50</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear95"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear96"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear97"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;">15.00</td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear98"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear99"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 0px;border: 1px solid;"><?php echo $row_select_pipe["shear100"] ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
							</tr>
							<tr>
								<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>

						</table>
					</td>
				</tr>

			</table>

			<div class="pagebreak"></div>
			<br>
		<?php }
		if ($row_select_pipe['loadpt3'] != "" && $row_select_pipe['loadpt3'] != "0" && $row_select_pipe['loadpt3'] != null) { ?>
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
								<td style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>
								<td style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
								<td style="width:25%;font-weight:bold;">Page : 7</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
								<td style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
							</tr>

						</table>

					</td>
				</tr>
				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">

							<tr style="">

								<td style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
								<td style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
							</tr>
							<tr style="">
								<td style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:20px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">

							<tr style="">

								<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON SOIL</td>
							</tr>
							<?php
							if ($row_select_pipe['lab_no'] != "") {
								$cnt = 1;

							?>
								<tr style="font-size:10px;">

									<td style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
									<td style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>
									<td style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
								</tr>
							<?php }
							if ($job_no != "") {
							?>
								<tr style="font-size:10px;">

									<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
									<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
								</tr>
							<?php }
							//if($job_no!=""){
							?>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							</tr>
							<tr style="font-size:10px;">

								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
								<td style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
							</tr>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">

							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">CALIFORNIA BEARING RATlO TEST As Per IS : 2720 (Part-16) : 1987 Reaffirmed : 2021 , Clause No :- 5</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Type of Sample:-</td>
								<td style="text-align: left;padding: 2px;border: 0;">Undisturbed / Remoulded</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Test Method :-</td>
								<td style="padding: 2px;">Soaked / Unsoaked</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Proving Ring Constant :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["rin1"] ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Proving Ring Capacity :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["rin2"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Dial Guage Least Count :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["rin3"] ?></td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Dial Guage Capacity :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["rin4"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Type of Compaction :-</td>
								<td style="text-align: left;padding: 2px;border: 0;">Static Compaction / Dynamic Compaction <br> Light Compaction / Heavy Compaction</td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="2">Soil Specimen Measurements</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Maximum Dry density of Soil :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["rin5"] ?> gm/cc</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Optimum Moisture Content :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["rin6"] ?> %</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Mass of Soil taken :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["rin7"] ?> gm</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Amount of water taken :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["rin8"] ?> ml</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Surcharge Weight used :-</td>
								<td style="text-align: left;padding: 2px;border: 0;"><?php echo $row_select_pipe["rin9"] ?> Kg</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Volume of Specimen :-</td>
								<td style="padding: 2px;"><?php echo $row_select_pipe["rin10"] ?> cm³</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<?php $cnt = 1; ?>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;" colspan="5"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Sr. No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Penetration Depth</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Proving Ring Dial Guage Reading <br>(PRGDR)</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Load (PT)</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">mm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">mm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">kg</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.0</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove2"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">0.5</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove3"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove4"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">1.0</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove6"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">1.5</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove7"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove8"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">2.0</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove9"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove10"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">2.5</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove11"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove12"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">3.0</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove13"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove14"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">4.0</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove15"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove16"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">5.0</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove17"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove18"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">7.5</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove19"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove20"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">10.0</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove21"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove22"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">12.5</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove23"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["prove24"] ?></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr>
					<td>
						<?php $cnt = 1; ?>
						<table align="left" width="70%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;" colspan="5"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Sr. No.</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Penetration Depth</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Load (PT)</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Total Standard <br>Load (PS)</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">CBR Value <br>PT/PS x 100</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">mm</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">kg</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">kgf</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">%</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">2.5</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["loadpt1"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["loadpt2"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["loadpt3"] ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;"><?php echo $cnt++; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">5.0</td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["loadpt4"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["loadpt5"] ?></td>
								<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["loadpt6"] ?></td>
							</tr>
						</table>
						<table align="right" width="20%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">Conversion Factors</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">1Kg/cm² = 100 KPa</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">1KPa = 100 KN/m²</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid;">1MPa = 1N/mm²</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="right" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px; border-right:0px; " colspan="3">Notes : (i) Air drying soil sample passing 19 mm sieve. If larger portion of sample is retained on 19 mm, replace it by an equal amount which passes 19 mm and is retained on 4.75mm.</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px; border-right:0px;">(ii) Table - 1 for Total Standard Load (PS)</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">Penetration</td>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">Unit Standard</td>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">Total Standard Load</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">Depth</td>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">Load</td>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">Load</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">mm</td>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">kg/cm²</td>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">kgf</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">2.5</td>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">70</td>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">1370</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">5.0</td>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">105</td>
								<td style="font-weight: bold;text-align: center;padding: 6px;border: 1px solid;">2055</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;" colspan="3">(iii) CBR Value at 2.5 mm Penetration will be greater than 5.0 mm for design Purpose. If CBR Value exceed at 5.0 mm penetration then test shall be repeated. If Identical result follow the CBR Value at 5.0 mm Penetration shall be take for design./td>
							</tr>
						</table>
					</td>
				</tr>


				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
								<td style="padding: 5px;border: 0px solid;"></td>
							</tr>
							<tr>
								<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>

						</table>
					</td>
				</tr>

			</table>

		<?php  } ?>

	</page>







	<!-- <page size="A4">
		----------------- page -1 ----------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
	    
		<br>
		
		<table align="center" width="100%" class="test1" height="9%">
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;padding:5px 0px;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $mt_name; ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;width:25%;text-align:left;padding:5px 0px;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;padding:5px 0px;" colspan=3>&nbsp; <?php echo $lab_no . "_01" ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; BH/Sample No.</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo $sample_type; ?></td>
                <td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp;Date of Starting</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo date('d/m/Y', strtotime($start_date)); ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Date of Receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
                <td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Date of Completion</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo date('d/m/Y', strtotime($end_date)); ?></td>
			</tr>
		</table>

         table 1 
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>IS 2720 (Part-16)</b></td>
						</tr>
					</table> 
                    
                    
					<table align="center" width="100%" class="test1" height="9%">
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">Method of Compaction</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">Static/Dynamic</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">Height of Sample (h)</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">127.3 mm</td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">Volume of CBR Mould</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">2250 cm³</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">Surcharge Weights </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> 5 Kgs </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> Rate of Penetration </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> 125 mn/minute </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> Arca of Plunger </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> 20 cm³ </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> Undisturbed Test at </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;">  </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b>FDD =      &nbsp;&nbsp;&nbsp; gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b>FMC =      &nbsp;&nbsp;&nbsp;  % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" rowspan=3> Remoulded Specimen at </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>FDD <b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>FDD =      &nbsp;&nbsp;&nbsp;  gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> FMC =      &nbsp;&nbsp;&nbsp;  % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>MDD </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> 95% of MDD =  &nbsp;&nbsp;&nbsp; gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> OMC =      &nbsp;&nbsp;&nbsp; % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> 70% RD </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> RD =      &nbsp;&nbsp;&nbsp;  gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b> </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=3>1) Weight of Oven dry soil required for cach mould of 2250 cm volume</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=1> gm </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=3>2) Air dry soil (to be taken passing 20mm)</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=1> gm </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=3>3) Water to be added to air dry soil taken to get desired moisture</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=1> cc </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=3>4) Total weight of wet soil for cach mould</td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=1> gm </td>
                        </tr>
                    </table>
					</td>
				</tr>																					
		</table>

         table 2 
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-1</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:7%;padding: 4px 3px;"><center><b>No.</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Particulars</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Soaking</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould + Wet Soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Moisture in %</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Dry Density in gm/cc</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>

          table 3 
         <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:10px;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
                        <tr>
							<td style="padding:5px 0;font-size: 13px;" colspan=6><center><b>Moisture Content %</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;width:30%;"><center><b></b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (Before Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (After Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Average After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Container No</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Weight of container + Wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Weight of container + Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Weight of container in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Weight of Moisture in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"> Moisture Content in%</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
        <br>

        <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

         <div class="pagebreak"></div> 

        ------------------ page -2 ----------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>

         table 4 
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-2</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:7%;padding: 4px 3px;"><center><b>No.</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Particulars</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Soaking</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould + Wet Soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Moisture in %</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Dry Density in gm/cc</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>

         table 5 
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:10px;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
                        <tr>
							<td style="padding:5px 0;font-size: 13px;" colspan=6><center><b>Moisture Content %</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;width:30%;"><center><b></b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (Before Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (After Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Average After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;">Container No</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container + Wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container + Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Moisture in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Moisture Content in%</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>

         table 6 
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-3</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:7%;padding: 4px 3px;"><center><b>No.</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Particulars</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Soaking</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould + Wet Soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Mould in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Moisture in %</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black; padding:3px 3px;">Dry Density in gm/cc</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
        
         table 7 
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:10px;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
                        <tr>
							<td style="padding:5px 0;font-size: 13px;" colspan=6><center><b>Moisture Content %</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;width:30%;"><center><b></b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Before Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>After Compaction</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (Before Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Top 3 Layer (After Soaking)</b></center></td>
                            <td style="border: 1px solid black;padding: 4px 3px;"><center><b>Average After Soaking</b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:3px 3px;">Container No</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container + Wet soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container + Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of container in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Dry soil in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Weight of Moisture in gm</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
                        <tr>
							<td style="border: 1px solid black; padding:3px 3px;">Moisture Content in%</td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:3px 3px;"><center></center></td>		
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:10px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		

		------------------ page 3 ------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>


		  table 8 
		 <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:15px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-1</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=3><center>Penetration</center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>UNSOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>SOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=4><center>Total Standard  Load</center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>   &nbsp; Proving Ring Factor =   </td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>    &nbsp; Proving Ring Factor =   </td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; mm</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Inch</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:12%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Lb</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Kg</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
						
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.1</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3000</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1370</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.2</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4500</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2055</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.3</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5700</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2630</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">10.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.4</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">6900</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3180</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">12.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7800</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3600</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 2.5 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 5.0 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Final CBR%</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Remarks</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>



		------------------ page 4 -----------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>

		  table 9 
		 <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:15px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-2</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=3><center>Penetration</center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>UNSOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>SOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=4><center>Total Standard  Load</center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>   &nbsp; Proving Ring Factor =   </td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>    &nbsp; Proving Ring Factor =   </td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; mm</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Inch</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:12%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Lb</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Kg</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
						
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.1</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3000</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1370</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.2</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4500</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2055</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.3</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5700</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2630</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">10.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.4</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">6900</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3180</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">12.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7800</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3600</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 2.5 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 5.0 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Final CBR%</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Remarks</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>


		---------------------- page 5 -------------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>

		  table 10 
		 <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:15px 0;font-size: 13px;text-underline-offset: 3px;"><b><u>MOULD-3</u></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=3><center>Penetration</center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>UNSOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2><center><b>SOAKED</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2 rowspan=4><center>Total Standard  Load</center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>   &nbsp; Proving Ring Factor =   </td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp;  Proving Ring Capacity/ <br> &nbsp; Load cell =       <br><br>    &nbsp; Proving Ring Factor =   </td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>&nbsp; Date of Testing:</td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; mm</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Inch</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Dial Reading &nbsp; of Proving <br>&nbsp; Ring</td>
							<td style="border: 1px solid black;padding: 4px 3px;">&nbsp; Load</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:12%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">0.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Lb</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;width:10%;">Kg</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
						
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.1</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3000</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">1370</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.2</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">4500</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2055</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.3</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">5700</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">2630</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">10.0</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.4</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">6900</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3180</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">12.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">0.5</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">7800</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;">3600</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 2.5 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">CBR at 5.0 mm Penetration</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Final CBR%</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">Remarks</td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:center;"></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		
		
		-------------------- page 6 -------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		
		  table 11 
		 <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:15px 0 7px;font-size: 13px;"><b>IS 2720 (Part-13)</b></td>
						</tr>
					</table> 
                    
					<table align="center" width="100%" class="test1" style="text-align:center;">
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:6px 3px;width:30%;">Specimen Dimension in cm</td>
                            <td style="border-left:1px solid;padding:6px 3px;width:20%;">L = 60 <br> B = 60 <br> H = 2.5</td>
                            <td style="border-left:1px solid;padding:6px 3px;width:30%;">Normal Stress Kg/cm²</td>
                            <td style="border-left:1px solid;padding:6px 3px; width:20%;">0.5 <br> 1.0 <br> 2.0 <br> 3.0</td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;">Initial Consolidation time in min</td>
                            <td style="border-left:1px solid;padding:3px 0px;">45 min</td>
                            <td style="border-left:1px solid;padding:3px 0px;">Rate of strain in mm/min</td>
                            <td style="border-left:1px solid;padding:3px 0px;">1.25</td>
                        </tr>

                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;" rowspan=3>Type of Test</td>
                            <td style="border-left:1px solid;padding:3px 0px;" colspan=2>(a) Unconsolidated Un drained Test</td>
                            <td style="border-left:1px solid;padding:3px 0px;"></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;" colspan=2>(b) Consolidated Un drained Test</td>
                            <td style="border-left:1px solid;padding:3px 0px;"></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;" colspan=2>(c) Consolidated Drained Test</td>
                            <td style="border-left:1px solid;padding:3px 0px;"></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;">Undisturbed Test at</td>
                            <td style="border-left:1px solid;padding:3px 0px;"></td>
                            <td style="border-left:1px solid;padding:3px 0px;">FDD =   gm/cc</td>
                            <td style="border-left:1px solid;padding:3px 0px;">FMC=    %</td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;padding:3px 0px;" rowspan=3>Remoulded Specimen at</td>
                            <td style="border-left:1px solid;padding:3px 0px;">FDD =   gm/cc</td>
                            <td style="border-left:1px solid;padding:3px 0px;">100% of FDD =   gm/cc</td>
                            <td style="border-left:1px solid;padding:3px 0px;">FMC=    %</td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;">MDD =   gm/cc</td>
                            <td style="border-left:1px solid; padding:3px 0px;">95% of MDD =   gm/cc</td>
                            <td style="border-left:1px solid; padding:3px 0px;">OMC=    %</td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;">70% RD</td>
                            <td style="border-left:1px solid; padding:3px 0px;">RD=    gm/cc</td>
                            <td style="border-left:1px solid; padding:3px 0px;"></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=4>Remoulding of Specimen</td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>1) Volume of Mould in cc</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1>90 cc</td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>2) Weight of oven dry soil to be taken for cake in gm (W = d x V)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>


						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>3) Weight of water to be added in gm (OMC or FMC x W / 100)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>4) Total weight of wet soil in gm (For one cake) (2) + (3)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>
                    </table>
					</td>
				</tr>																					
		</table>
		<br>

		  table 12 
		 <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" rowspan=2><center><b>Failure time in min</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" rowspan=2><center><b>Corrected Area (Ac) cm³</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" rowspan=2><center><b>Normal Stress Kg/cm²</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"colspan=2><center><b>Max. Shear Stress</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;" rowspan=2><center><b>Strain at Failure%</b></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>SF=K x Dial reading (Kg)</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Stress = SF/Ac Kg/cm²</b></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>0.50</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>1.00</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>2.00</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>3.00</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br>
		
		 <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div> 
		
		
		------------------- page 7 -------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br> 

		 table 13 
		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;text-align:center;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;width:20%;" colspan=3><center><b></b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;width:80%;" colspan=12><center><b>Normal Stress Kg/cm<sup>2</sup></b></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=3>Time in min</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=3>Corrected <br>Area in cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=3>Strain in %</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=3>0.5 kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=3>1.0 Kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=3>2.0 Kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=3>3.0 Kg/cm²</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>PR Dial <br> Reading</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Stress <br> Kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>PR Dial <br> Reading</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Stress <br> Kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>PR Dial <br> Reading</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Stress <br> Kg/cm²</td>
							<td style="border: 1px solid black;padding: 4px 3px;" colspan=2>PR Dial <br> Reading</td>
							<td style="border: 1px solid black;padding: 4px 3px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Stress <br> Kg/cm²</td>
						</tr>

						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;">VR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">HR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">VR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">HR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">VR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">HR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">VR</td>
							<td style="border: 1px solid black;padding: 4px 3px;">HR</td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>0.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>36.000</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>0.000</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>

						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>0.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>35.625</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>1.04</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>1.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>35.250</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>2.08</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>1.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>34.875</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>3.13</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>2.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>34.500</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>4.16</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>2.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>34.125</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>5.21</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>3.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>33.750</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>6.25</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>3.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>33.375</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>7.29</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>4.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>33.000</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>8.33</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>4.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>32.625</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>9.38</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>5.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>32.250</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>10.42</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>5.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>31.875</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>11.46</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>6.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>31.500</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>12.50</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>6.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>31.125</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>13.54</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>7.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>30.750</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>14.58</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>7.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>30.375</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>15.03</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>8.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>30.000</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>16.67</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>8.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>29.625</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>17.71</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>9.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>29.250</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>18,75</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>9.50</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>28.875</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>19.79</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black; padding:6px 3px;"><center>10.00</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>28.500</center></td>
							<td style="border: 1px solid black; padding:6px 3px;"><center>20.83</center></td>		
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
                            <td style="border: 1px solid black; padding:6px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br> 

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div> 
		

		-------------------- page 8 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br><br>

		 table 14 
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>IS 2720(Part 12), ASTM D4767 & ASTM D7181</b></td>
						</tr>
					</table> 
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Type of Test</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Saturated/CU/CD</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Lateral Pressure (σ₃)</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Kg/cm<sup>2</sup></center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Deformation rate (mm/min)</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>

		 table 15 
		 <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td style="width:38%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>PRE-SHEAR DATA</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:70%">Initial Diameter (D) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>3.80</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Length (Lo) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>7.60</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Area (Ao) cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>11.34</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Volume (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Dry Density gm/cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Moisture Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wet Weight in gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
					<td style="width:2%;">
					    <table align="center" width="100%" class="test1" style="">
							<tr>
								<td style="">&nbsp;</td>
							</tr>
					    </table>
					</td>
					<td style="width:60%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" >
							<tr>
								<td style="border: 1px solid black;padding: 12px 3px;" colspan=2><center><b>REMOULDING OF SPECIMEN</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:80%;">Desired Dry Density (D) gm/cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Desired Moisture (M) %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Volume of Mould (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of Oven dry soil to be taken (a) = D X Vo</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water to be added to attain Moisture (M) </td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"> Exact Wt. of wet soil for one specimen of volume. (Vo)=  d <br> d = (100+M) (a) (0.01) gm.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br>

		 table 16 
		<table align="center" width="70%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>POST SHEAR MOISTURE CONTENT</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Specimen Reference</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Final Water content%</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Container No.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + wet soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>11.34</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of can gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of Dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Water Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br>


		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div>


		-------------------- page 9 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>

		 table 16 
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=6><center>Saturation</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=6><center>Consolidation</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Date</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Time</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Cell <br> Pressure in <br>Kg/cm<sup>2</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Back <br> pressure in <br>kg/cm<sup>2</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Pore <br> Pressure in <br>Kg/cm<sup>2</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>B value</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Date</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Time</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Time in &#8730;second</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Initial reading</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Final reading</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Change in Volume</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2	</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		

		-------------------- page 10 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>

		 table 17 
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>Cell Pressure (σ₃)  <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u> Kg/cm²</b></td>
						</tr>
					</table> 
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Strain e = &#8710; L/L  %</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Axial Load P Kg</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Corrected Area (Ac) cm² σ<sub>1</sub>=  Ao/(1-e)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Deviator Stress p = P/Ac kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>MP Stress σ<sub>1</sub> = P+σ₃ kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Back pressure kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Pore Pressure (U) kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>σ₃ = (σ₃-U) kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>σ<sub>1</sub> = (σ<sub>1</sub> -U)  kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Remark</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14</td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">4.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">13.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">15.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">16.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">17.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">18.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">19.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">20.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:15px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		
		
		-------------------- page 11 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br> 

		 table 18 
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>IS 2720(Part 12), ASTM D4767 & ASTM D7181</b></td>
						</tr>
					</table> 
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Type of Test</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Unconsolidated-undrained</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Lateral Pressure (σ₃)</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Kg/cm<sup>2</sup></center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>Deformation rate</center></td>
							<td style="border: 1px solid black;padding: 6px 3px;width:10%"><center>1.25 mm / min</center></td>
						</tr>
						
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>

		 table 19 
		 <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td style="width:38%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>PRE-SHEAR DATA</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:70%">Initial Diameter (D) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>3.80</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Length (Lo) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>7.60</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Area (Ao) cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>11.34</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Volume (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Dry Density gm/cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Moisture Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wet Weight in gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
					<td style="width:2%;">
					    <table align="center" width="100%" class="test1" style="">
							<tr>
								<td style="">&nbsp;</td>
							</tr>
					    </table>
					</td>
					<td style="width:60%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" >
							<tr>
								<td style="border: 1px solid black;padding: 12px 3px;" colspan=2><center><b>REMOULDING OF SPECIMEN</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:80%;">Desired Dry Density (D) gm/cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Desired Moisture (M) %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Volume of Mould (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of Oven dry soil to be taken (a) = D X Vo</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water to be added to attain Moisture (M) </td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"> Exact Wt. of wet soil for one specimen of volume. (Vo)=  d <br> d = (100+M) (a) (0.01) gm.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br>

		 table 20 
		 <table align="center" width="70%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>POST SHEAR MOISTURE CONTENT</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Specimen Reference</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Final Water content%</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Container No.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + wet soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>11.34</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>86.20</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of can gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of Dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Water Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br>
		

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		


		-------------------- page 12 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>

		 table 21 
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center> Deformation mm &#8710;L</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Dial Gauge (0.01 mm)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Strain e= &#8710;L/L%</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Lateral pressure (Cell pressure) σ₃</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Axial Load Pkg</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Corrected Area (Ac) cm² = Ao/(1-e)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Deviator Stress p=P/Ac kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>MP Stress σ<sub>1</sub> = p+σ₃ kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Area for quick (UU) test 'A' cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Remark</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14</td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">4.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">13.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">15.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">16.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">17.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">18.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">19.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">20.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:15px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div>
		
		
		 star vivek 
		-------------------- page 13 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>


		 table 22 
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
               <tr>
							<td style="padding:7px 0;font-size: 13px;"><br><b>IS 2720(Part 10)</b></td>
						</tr>
				<tr>
					<td style="width:38%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>PRE-SHEAR DATA</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:70%">Initial Diameter (D) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Length (Lo) cm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Area (Ao) cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Initial Volume (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Dry Density gm/cm²</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Moisture Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wet Weight in gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
					<td style="width:2%;">
					    <table align="center" width="100%" class="test1" style="">
							<tr>
								<td style="">&nbsp;</td>
							</tr>
					    </table>
					</td>
					<td style="width:60%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" >
							<tr>
								<td style="border: 1px solid black;padding: 12px 3px;" colspan=2><center><b>REMOULDING OF SPECIMEN</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:80%;">Desired Dry Density (D) gm/cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Desired Moisture (M) %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Volume of Mould (Vo) cm³</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of Oven dry soil to be taken (a) = D X Vo</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water to be added to attain Moisture (M) </td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"> Exact Wt. of wet soil for one specimen of volume. (Vo)=  d <br> d = (100+M) (a) (0.01) gm.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br> 


		 table 23 
		<table align="center" width="70%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" colspan=2><center><b>POST SHEAR MOISTURE CONTENT</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Specimen Reference</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>Final Water content%</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Container No.</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + wet soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of cont + dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt. of water gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of can gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Wt of Dry soil gm</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;">Water Content %</td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br><br><br><br><br><br><br><br><br><br>
		

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:30px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div>
		


		-------------------- page 14 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>

		 table 24 
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;" ><center>Deformation mm &#8710;L</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Dial Gauge (0.01 mm)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Strain e= &#8710;L/L%</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:10%;"><center>Axial Load P kg</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Corrected Area (Ac) cm² = Ao/(1-e)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Deviator Stress p=P/Ac kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Compressive strength (kg/cm²)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;width:8%;"><center>Remark</center></td>
							</tr>
                       
							<tr>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>1</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>2</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>3</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>5</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>6</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>7</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>8</b></td>
								<td style="padding:6px 3px;text-align:center;border-top:2px solid black;border-bottom:2px solid black; border-right: 1px solid black;"><b>14</b></td>					
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.38</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">38</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.76</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">76</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.14</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">114</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.52</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">152</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.90</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">190</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.50</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.28</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">228</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.04</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">304</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">4.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.80</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">380</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">4.56</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">456</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5.32</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">532</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.08</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">608</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.84</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">684</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">7.60</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">760</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">8.36</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">836</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9.12</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">912</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">9.88</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">988</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">13.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">10.64</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1064</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">11.40</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1140</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">15.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12.16</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1216</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">16.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">12.94</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1294</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">17.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">13.68</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1368</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">18.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">14.44</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1444</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">19.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">15.20</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1520</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">20.00</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
        

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:15px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div>
		 end vivek 



		-------------------- page 15 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>
		
		 table 25 
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
						<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
							<tr>
								<td style="padding:7px 0;font-size: 15px;"><b>IS2720 (Part-17)</b></td>
							</tr>
						</table> 
						<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
							<tr>
								<td style="padding:7px 0;font-size: 13px;"><b>&nbsp;&nbsp; Permeability Test</b></td>
							</tr>
							<tr>
								<td style="text-align:left;padding:3px 3px;">&nbsp;&nbsp; 1. Length of specimen (L) Cm</td>
							</tr>
							<tr>
								<td style="text-align:left;padding:3px 3px;">&nbsp;&nbsp; 2. Area of specimen (A) Cm²</td>
							</tr>
							<tr>
								<td style="text-align:left;padding:3px 3px;">&nbsp;&nbsp; 3 Room Temperature (T) &#8451;</td>
							</tr>
							<tr>
								<td style="text-align:left;padding:3px 3px;">&nbsp;&nbsp; 4. Temperature correction (U) =  <span><u> Viscosity at T°C </u></span> <br> <span style="margin-left:26%;">Viscosity at 27°C </span></td>
							</tr>
							<tr>
								<td style="text-align:left;padding:3px 3px;">&nbsp;&nbsp; 5. Area of stand pipe (a) Cm²</td>
							</tr>
						</table> 
						<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
							<tr>
								<td style="padding:7px 0;font-size: 15px;"><b>Falling Head Permeability Test</b></td>
							</tr>
							<tr>
								<td style="font-size: 13px;">&nbsp;&nbsp; Coefficient of permeability K₁ = <span><u>2.303 X a X L</u></span> Log 10 <u style="text-underline-offset: 2px;">h<sub>1</sub></u></td>
							</tr>
							<tr>
								<td style="font-size: 13px;"><span style="margin-left:30%;">A X t </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; h<sub>2</sub></td>
							</tr>
						</table> 	
					</td>
				</tr>																					
		</table>
		<br>

		 table 26 
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" ><center>Clock time</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Initial head (h<sub>1</sub>) Cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Final head (h<sub>2</sub>) Cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Elapsed time (t) Sec.</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Temperature of water (T) °C</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>K<sub>T</sub> Cm/Sec 10<sup>-6</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>K<sub>27</sub> Cm/Sec 10<sup>-6</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>K<sub>27</sub> Cm/Sec 10<sup>-6</sup></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">5</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>
		
		 table 26 
		 <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;" ><center>Temp.</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>24</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>25</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>26</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>27</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>28</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>29</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>30</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>31</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;"><center>32</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">Temp Corr</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.070</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.047</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.023</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.979</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.958</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.938</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.911</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.899</td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>

		 table 27 
        <?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>Specimen Details</b></td>
						</tr>
					</table> 
                    
                    
					<table align="center" width="100%" class="test1" height="9%">
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;width:30%;"> Undisturbed Test at </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;width:20%;">  </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;width:30%;"><b>FDD =      &nbsp;&nbsp;&nbsp; gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;width:20%;"><b>FMC =      &nbsp;&nbsp;&nbsp;  % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" rowspan=3> Remoulded Specimen at </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>FDD =   &nbsp;&nbsp;&nbsp;  gm/cc <b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>100% of FDD =      &nbsp;&nbsp;&nbsp;  gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> FMC =      &nbsp;&nbsp;&nbsp;  % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b>MDD =   &nbsp;&nbsp;&nbsp;  gm/cc </td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> 95% of MDD =  &nbsp;&nbsp;&nbsp; gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> OMC =      &nbsp;&nbsp;&nbsp; % </b></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> 70% RD </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b> RD =      &nbsp;&nbsp;&nbsp;  gm/cc </b></td>
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;"> <b> </b></td>
                        </tr>
						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:3px 3px;" colspan=4>Remoulding of Specimen</td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>1) Volume of Mould in cc</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>2) Weight of oven dry soil to be taken for cake in gm (W = d x V)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>


						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>3) Weight of water to be added in gm (OMC or FMC x W / 100)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>

						<tr style="border: 1px solid black;">
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=3>4) Total weight of wet soil in gm (For one cake) (2) + (3)</td>
                            <td style="border-left:1px solid; padding:3px 0px;" colspan=1></td>
                        </tr>
                    </table>
					</td>
				</tr>																					
		</table>
		<br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
			


		-------------------- page 17 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>

		 table 32 
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding:7px 0;font-size: 13px;"><b>IS 2720 (Part-15)</b></td>
						</tr>
					</table> 
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 3px 3px;width:35%;" >Dial Gauge No.</td>
								<td style="border: 1px solid black;padding: 3px 3px;width:15%;"><center></center></td>
								<td style="border: 1px solid black;padding: 3px 3px;width:35%;">Least Count of Dial Gauge</td>
								<td style="border: 1px solid black;padding: 3px 3px;width:15%;"><center>0.002 mm</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;">Remoulded/Undisturbed</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;">Sp. Gr. of Soil (G<sub>S</sub>)</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1.023</td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;">Const. Height (2H) in cm</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">2.0</td>
								<td style="border: 1px solid black; padding:3px 3px;">Density of Water (r<sub>W</sub>)</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1.0 gm/cc</td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;">Cont Diameter (D) in cm</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">6.0</td>
								<td style="border: 1px solid black; padding:3px 3px;">Dry Wt. of Specimen (W<sub>S</sub>)</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;">Cont Area (A) cm<sup>2</sup></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">28.26</td>
								<td style="border: 1px solid black; padding:3px 3px;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;">Solid Height (2H<sub>o</sub>) = W<sub>8</sub>/G<sub>s</sub> X r<sub>w</sub> X A</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		 table  33
		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:7%;" ><center>No.</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Particulars</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Before Test</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>After Test</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Container No.</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Wt. of Container + Wt. of Wet soil in gm</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Wt of Container + Wt. of Dry Soil in gm</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Wt. of Water in gm</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Wt of Container in gm</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Wt. of Dry soil in gm</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Water Content in %</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Volume of Specimen in ee</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Dry Density in gm/cc</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Dry Density</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Moisture Content</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"><?php echo $cnt++; ?></td>
								<td style="border: 1px solid black; padding:4px 3px;">Liquid Limit</td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:4px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		 table 34 	
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" colspan=8><center>Results</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" ><center>Range of Pressure "p" Kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Coefficient of consolidation C<sub>v</sub> = </center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Compression Index C<sub>c</sub></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Pre consolidation Pressure P<sub>c</sub> Kg/cm³</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Swelling Control Load (SCL) Kg/cm²</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Coefficient of Volume compressibility (m<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;"><center>Coefficient of Compressibility cm²/gm (a<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;writing-mode: tb-rl;transform: rotate(-180deg);"><center>Remarks</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.0 - 0.1</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"  rowspan=7></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"  rowspan=7></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.1 - 0.2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.2 - 0.4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.4 - 0.8</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.8 - 1.6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">16 - 3.2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.2 - 6.4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
			
		 <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:20px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
         <div class="pagebreak"></div>
			
			

		-------------------- page 18 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>

		 table  35
		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:10px;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;" colspan=2>Date</td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center> </center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;" colspan=2>Time of Starting</td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center> </center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;" colspan=2>Pressure increment Kg/cm² </td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>0.0  - 0.1</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>0.1 - 0.2</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>0.2 - 0.4</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>0.4 - 0.8</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>0.8 - 1.6</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>1.6 - 3.2</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>3.2 - 6.4</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;">Elapsed Time in minute = t </td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;"><center>&#8730;t</center></td>
								<td style="border: 1px solid black;padding:3px 3px;font-weight:bold;" colspan=7><center>Dial Readings (accuracy 1 division = 0.002 mm)</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.00</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.5</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.00</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">0.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1.00</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">2.25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1.5</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">4.00</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">2.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">6.25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">2.5</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">9.00</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">3.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">12.25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">3.5</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">16</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">4.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">5.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">36</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">6.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">49</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">7.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">64</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">8.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr><tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">81</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">9.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">100</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">10.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">121</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">11.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">144</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">12.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">169</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">13.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">196</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">14.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">225</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">15.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">256</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">16.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">289</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">17.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">324</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">18.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">361</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">19.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">400</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">20.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">500</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">22.4</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">600</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">24.5</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1440 (24hrs)</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">38.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;" colspan=2><b>Unloading</b></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">25</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">5.4</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">100</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">10.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">225</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">15.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">1440</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;">38.0</td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:3px 3px;text-align:center;"></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
			
		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:10px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
         <div class="pagebreak"></div>


		 -------------------- page 18 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>

		 table  36
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 3px 3px;width:10%;"><center>1</center></td>
								<td style="border: 1px solid black;padding: 3px 3px;width:20%;">* P<sub>1</sub></td>
								<td style="border: 1px solid black;padding: 3px 3px;width:20%;"><center></center></td>
								<td style="border: 1px solid black;padding: 3px 3px;width:20%;">* P<sub>2</sub></td>
								<td style="border: 1px solid black;padding: 3px 3px;width:20%;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 3px 3px;width:7%;"><center>1</center></td>
								<td style="border: 1px solid black;padding: 3px 3px;" colspan=3> Co-efficient of compressibility "a<sub>v</sub>" 0.435 Cc / 0.5 (P<sub>1</sub> + P<sub>2</sub>) cm²/gm</td>
								<td style="border: 1px solid black;padding: 3px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 3px 3px;width:7%;"><center>3</center></td>
								<td style="border: 1px solid black;padding: 3px 3px;" colspan=3> Compression Index Cc = e<sub>1</sub>-e<sub>2</sub> / log (P<sub>2</sub>/P<sub>1</sub>) Where, P<sub>2</sub> = 2P<sub>1</sub></td>
								<td style="border: 1px solid black;padding: 3px 3px;"><center></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 3px 3px;width:7%;"><center>4</center></td>
								<td style="border: 1px solid black;padding: 3px 3px;" colspan=3>Co-efficient of volume compressibility m<sub>v</sub> = a<sub>v</sub> /( 1+ 	e) cm² / gm Where, e = Original Void Ratio</td>
								<td style="border: 1px solid black;padding: 3px 3px;"><center></center></td>
							</tr>
					    </table>
					</td>
				</tr>																					
		</table>
		<br>

		 table  36
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">	
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2 colspan=2><center>Applied <br> Pressure (p)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2><center>Final Dial <br> Reading (df)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2><center>Change in <br> Dial Reading</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2><center>Thickness of <br> Soil Sample (2H)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2><center>Equivalent <br> of Height of <br> Voids (2H - 2H<sub>o</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" rowspan=2><center>Void Ratio <br> (2H - 2H<sub>o</sub>/2H<sub>o</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;width:10%;" colspan=2><center>Fitting Time</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;writing-mode: tb-rl;transform: rotate(-180deg);width:10%;" rowspan=2><center>Mean <br> Thickness <br> (C<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;writing-mode: tb-rl;transform: rotate(-180deg);width:10%;" colspan=2><center>Coefficient <br> of consolidation <br> (C<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;writing-mode: tb-rl;transform: rotate(-180deg);width:10%;"><center> Coefficient of <br> Compressibility <br> (a<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;writing-mode: tb-rl;transform: rotate(-180deg);width:10%;"><center>Coefficient of <br> Volume  Compressibility <br> (m<sub>v</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;writing-mode: tb-rl;transform: rotate(-180deg);width:10%;"><center>Compression <br>Index</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>t<sub>50</sub></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" ><center>t<sub>90</sub></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>0.197h(C<sup>2</sup>) t<sub>50</sub></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>0.848h t<sub>90</sub></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>= 0.435 Cc/0.5 (P<sub>1</sub> + P<sub>2</sub>)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>= a<sub>v</sub> / (1 + e)</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center> <u>e <sub>1</sub> - e <sub>2</sub></u> <br> 0.30103</center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>Kg/cm<sup>2</sup></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" ><center>cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center></center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" colspan=2><center>See</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center>cm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;" colspan=2><center> cm <sup>2</sup>/See</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center> cm <sup>2</sup>/gm</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center> cm <sup>2</sup>/gmc</center></td>
								<td style="border: 1px solid black;padding: 6px 3px;font-weight:bold;"><center></center></td>
							</tr>

							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P1</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.1</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P3</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">0.8</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P5</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">1.6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P6</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">3.2</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P7</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.4</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							<tr>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;">P18</td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
								<td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
							</tr>
							
					    </table>
					</td>
				</tr>																					
		</table>
		<br><br><br><br><br><br>


		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:10px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
         <div class="pagebreak"></div>



		-------------------- page 19 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br> 

		 table  37
		 <table align="center" width="100%" class="test">
					
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 0px;"><b>IS 2720 (Part-5)</b></td>
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;width:40%;"><b>Particulars</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;width:30%;"><b> Liquid Limit</b></td>
				<td colspan="2 "style="border: 1px solid black;text-align:center;padding:6px 3px;width:30%;"><b> Plastic Limit</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:15%;"><b>1</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:15%;"><b>2</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:15%;"><b>1</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:15%;"><b>2</b></td>
			</tr>		
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Penetration in mm D</td>
				<td colspan="2" style="border: 1px solid black;padding:6px 3px;text-align:center;"><?php echo (($row_select_pipe['pen1'] + $row_select_pipe['pen2']) / 2); ?></td>
				<td colspan="2" style="border: 1px solid black;padding:6px 3px;text-align:center;"><?php echo (($row_select_pipe['pen3'] + $row_select_pipe['pen4']) / 2); ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Container No.</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['cont1']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['cont2']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['cont3']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['cont4']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Wt. of Container + Wt. of wet soil in gm.</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wc1']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wc2']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wc3']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wc4']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Wt. of Container + Wt. of Oven Dry soil in gm.</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['od1']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['od2']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['od3']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['od4']; ?></td>
			</tr>
			
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Wt. of water in gm</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ww1']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ww2']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ww3']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ww4']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Wt. of Container in gm</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wf1']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wf2']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wf3']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['wf4']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Wt. of oven dry soil in gm</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ds1']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ds2']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ds3']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['ds4']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;Moisture content % </td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['mo1']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['mo2']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['mo3']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"><?php echo $row_select_pipe['mo4']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:left;padding:4px 0;">&nbsp;&nbsp;Average percent W<sub>N</sub></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>&nbsp;&nbsp;W<sub>N</sub></b> = &nbsp; &nbsp; <?php echo (($row_select_pipe['mo1'] + $row_select_pipe['mo2']) / 2); ?></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>&nbsp;&nbsp;W<sub>P</sub></b> = &nbsp; &nbsp; <?php echo (($row_select_pipe['mo3'] + $row_select_pipe['mo4']) / 2); ?></td>
			</tr>
			<tr>
				<td colspan="5" style="text-align:left;padding:8px;"></td>
			</tr>
			<tr>
				<td colspan="5" style="border: 1px solid black;text-align:left;padding:15px 0;">&nbsp;&nbsp;W<sub>L</sub> = W<sub>N</sub> / [0.65 + ( 0.0175 x D )] OR W<sub>N</sub> / 0.77 log D &nbsp; &nbsp; = &nbsp; &nbsp; <?php echo $row_select_pipe['avg_ll']; ?></td>
			</tr>
		</table>	
		<br>
	
		 table  38
		 <table align="center" width="100%" class="test">
			<tr>
				<td colspan="5" style="border: 1px solid black;text-align:left;padding:4px;width:100%;text-align:center;"><b>RESULT SUMMARY</b></td>
			</tr>
			<tr>
				<td colspan="3" style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b> LIQUID LIMIT</b></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b>PLASTIC LIMIT</b></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b>PLASTICITY INDEX</b></td>
			</tr>
			<tr>
				<td colspan="3" style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b>W<sub>L</sub></b></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b>W<sub>p</sub></b></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><b>PI = (W<sub>L</sub> - W<sub>P</sub>)</b></td>
			</tr>
			<tr style="height:20px;">
				<td colspan="3" style="border: 1px solid black;text-align:left;padding:8px px;text-align:center;"><?php echo $row_select_pipe['liquide_limit']; ?></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['plastic_limit']; ?></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pi_value']; ?></td>
			</tr>
			<tr style="height:20px;">
				<td colspan="5" style="border: 0px solid black;text-align:left;padding:4px;width:100%;text-align:center;"></td>
			</tr>
			<tr>
				<td colspan="5" style="border: 0px solid black;text-align:left;padding:4px;width:100%;text-align:left;">Where,<br><br> W<sub>L</sub> = Liquid limit of soil <br><br> W<sub>N</sub> = Moisture Content of soil <br><br> D = Depth of penetration in mm</td>
			</tr>
		</table>
		<br><br><br><br><br><br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;">
			<tr style="">
				<td style="width:25%;padding-top:4px;"><center>Amendment No.: 01</center></td>
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
			<tr>
				<td style="text-align:center;">Page  of </td>
			</tr>
		</table>
        <div class="pagebreak"></div>
			


		-------------------- page 20 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		
		 table  39			
		 <table align="center" width="100%"  class="test tr" style="">
					
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 0px;"><b>IS 2720 (Part-3)</b></td>
			</tr>
			<tr>
			    <td  style="border: 1px solid black;text-align:center;width:10%;padding:6px 3px;"><b>Sample ID No.</b></td>
				<td  style="border: 1px solid black;text-align:center;writing-mode: tb-rl;transform: rotate(-180deg);width:6%;padding:6px 3px;"><b>Flask No.</b></td>
				<td  style="border: 1px solid black;text-align:center;writing-mode: tb-rl;transform: rotate(-180deg);width:6%;padding:6px 3px;"><b>Temp. of <br> suspension (T<sup>o</sup>C)</b></td>
				<td  style="border: 1px solid black;text-align:center;width:7%;padding:6px 3px;"><b>Wt. of Flask with stopper +  Water or Kerosene ( W<sub>1</sub> ) in gm</b></td>
				<td  style="border: 1px solid black;text-align:center;width:14%;padding:6px 3px;"><b>Wt. of Flask with stopper  + sample + Water or  Kerosene ( W<sub>2</sub> ) in gm</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of  Flask with  stopper +  Dry soil in gm</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of  Flask  with  stopper in gm</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of  Dry Soil  ( W<sub>s</sub> ) i gm </b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Specific Gravity</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Mean Specific Gravity</b></td>
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black;padding:4px 3px;text-align:center;">1</td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td rowspan="2"  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td rowspan="2"  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td rowspan="2"  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"><td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td  rowspan="2" style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  rowspan="2" style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td rowspan="2"  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td rowspan="2" style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
				<td  style="border: 1px solid black;padding:4px 3px;text-align:center;"></td>
			</tr>
			<tr>
			    <td colspan="10" style="border: 0px solid black;padding:7px 0px;">&nbsp; Specific gravity at 27 <sup>o</sup> C = W<sub>s</sub> / ( W<sub>s</sub> +  W<sub>1</sub> - W<sub>2</sub> ) X G<sub>L</sub></td>
			</tr>
			<tr>
			    <td colspan="10" style="border: 0px solid black;padding:7px 0px;">&nbsp; Where, W<sub>s</sub> = Wt. of Dry Soil in gm<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;W<sub>1</sub> = Wt. of Flask with stopper + Water or Kerosene in gm <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;W<sub>2</sub> = Wt. of Flask with stopper + sample +	 Water or Kerosene in gm</td>
			</tr>
		</table>

		 table  40	
		<table align="center" width="100%" class="test">
					
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 0px;font-weight:bold;">IS 2720 (Part-40)</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:5%;padding:4px 3px;"><b>Sr. No.</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> BH No./Sample No./Identification</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Sample ID No.</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Date of Starting</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Date of Completion</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Time in Hours</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Initial Volume of sample in Kerosene(X)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Final Volume of sample in Distilled water (Y)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:10%;padding:4px 3px;"><b> Swelling Index %</b></td>
			</tr>
			
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">1</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">2</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">3</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">4</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">5</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">6</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">7</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">8</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">9</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">10</td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td colspan="9"  style="border: 0px solid black;text-align:left;padding:6px 3px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Swelling Index = <u>(Y - X)</u> x 100<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X
				     <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Where,Y = Final Volume of sample in Distilled water,
					 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X = Initial Volume of sample in Kerosene 
				</td> 
			</tr>
		</table> 
		
		 <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:20px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
			

		
		-------------------- page 21 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>

		 table  41
		 <table align="center" width="100%"  class="test">
					
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 3px;font-weight:bold;">IS 2720 (Part-4)</td>
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black;text-align:center;padding:7px 3px;width:5%"><b>IS Sieve Designation</b></td>
				<td colspan="3" style="border: 1px solid black;text-align:center;padding:7px 3px;width:11%"><b>Weight Retained</b></td>
				<td rowspan="2" style="border: 1px solid black;text-align:center;padding:7px 3px;width:11%"><b>Soil Passing as % of Soil Taken</b></td>
				<td rowspan="2" style="border: 1px solid black;text-align:center;padding:7px 3px;width:11%"><b>Combined %  Passing as % of Total Soil Taken</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:7px 3px;"><b>Individual</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:7px 3px;"><b>Cumulative</b></td>
				<td  style="border: 1px solid black;text-align:center;padding:7px 3px;"><b>Cumulative %</b></td>
			</tr>
			<tr>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;">80 mm</td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_1']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_1']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_1']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;">63 mm</td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_2']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_2']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_2']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;">40 mm</td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_3']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_3']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_3']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;">25 mm</td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_4']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_4']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_4']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_4']; ?></td>
                <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_4']; ?></td>
            </tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">10 mm</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_5']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_5']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_5']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_5']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_5']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">6.3 mm</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_6']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_6']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_6']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_6']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_6']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">4.75 mm</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_7']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_7']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_7']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_7']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_7']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">2.00 mm</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_8']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_8']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_8']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_8']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_8']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">600 micron </td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_9']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_9']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_9']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_9']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_9']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">425 micron </td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_10']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_10']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_10']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_10']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_10']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">212 micron</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_11']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_11']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_11']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_11']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_11']; ?></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">75 micron</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_wt_gm_12']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['ret_wt_gm_12']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['cum_ret_12']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_12']; ?></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['pass_sample_12']; ?></td>
			</tr>
			<tr>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;font-size: 12px;"><b>TOTAL</b></td>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['blank_extra']; ?></td>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['ret_wt_gm_1'] + $row_select_pipe['ret_wt_gm_2'] + $row_select_pipe['ret_wt_gm_3'] + $row_select_pipe['ret_wt_gm_4'] + $row_select_pipe['ret_wt_gm_5'] + $row_select_pipe['ret_wt_gm_6'] + $row_select_pipe['ret_wt_gm_7'] + $row_select_pipe['ret_wt_gm_8'] + $row_select_pipe['ret_wt_gm_9'] + $row_select_pipe['ret_wt_gm_10'] + $row_select_pipe['ret_wt_gm_11'] + $row_select_pipe['ret_wt_gm_12']); ?></td>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['cum_ret_1'] + $row_select_pipe['cum_ret_2'] + $row_select_pipe['cum_ret_3'] + $row_select_pipe['cum_ret_4'] + $row_select_pipe['cum_ret_5'] + $row_select_pipe['cum_ret_6'] + $row_select_pipe['cum_ret_7'] + $row_select_pipe['cum_ret_8'] + $row_select_pipe['cum_ret_9'] + $row_select_pipe['cum_ret_10'] + $row_select_pipe['cum_ret_11'] + $row_select_pipe['cum_ret_12']); ?></td>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['pass_sample_1'] + $row_select_pipe['pass_sample_2'] + $row_select_pipe['pass_sample_3'] + $row_select_pipe['pass_sample_4'] + $row_select_pipe['pass_sample_5'] + $row_select_pipe['pass_sample_6'] + $row_select_pipe['pass_sample_7'] + $row_select_pipe['pass_sample_8'] + $row_select_pipe['pass_sample_9'] + $row_select_pipe['pass_sample_10'] + $row_select_pipe['pass_sample_11'] + $row_select_pipe['pass_sample_12']); ?></td>
				<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['pass_sample_1'] + $row_select_pipe['pass_sample_2'] + $row_select_pipe['pass_sample_3'] + $row_select_pipe['pass_sample_4'] + $row_select_pipe['pass_sample_5'] + $row_select_pipe['pass_sample_6'] + $row_select_pipe['pass_sample_7'] + $row_select_pipe['pass_sample_8'] + $row_select_pipe['pass_sample_9'] + $row_select_pipe['pass_sample_10'] + $row_select_pipe['pass_sample_11'] + $row_select_pipe['pass_sample_12']); ?></td>
			</tr>
		</table>
		<br>

		
		 table  42
		<table align="left" width="100%"  class="test tr">	
					<td style="width:38%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">
								<tr>
									<td style="border: 1px solid black;text-align: center;width:20%;padding:4px 3px;">D<sub> 10</sub> =</td>
									<td style="border: 1px solid black;padding:4px 3px;width:20%"></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;text-align: center">D<sub> 30</sub> =</td>
									<td style="border: 1px solid black;padding:4px 3px;"></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;text-align: center">D<sub> 60</sub> =</td>
									<td style="border: 1px solid black;padding:4px 3px;"></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;">&nbsp;C<sub>u</sub> = D<sub>60</sub> / D<sub>10</sub></td>
									<td style="border: 1px solid black;padding:4px 3px;"></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;">&nbsp;C<sub>c</sub> = ( D<sub>30</sub>) <sup>2</sup> / D<sub>60</sub> X D<sub>10</sub>  </td>
									<td style="border: 1px solid black;padding:4px 3px;"></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;">&nbsp;Liquid Limit</td>
									<td style="border: 1px solid black;padding:4px 3px;text-align:center;"><?php echo $row_select_pipe['liquide_limit']; ?></td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;">&nbsp;Plasticity Index</td>
									<td style="border: 1px solid black;padding:4px 3px;text-align:center;"><?php echo $row_select_pipe['pi_value']; ?> </td>
								</tr>
								<tr>
									<td style="border: 1px solid black;padding:4px 3px;">&nbsp;IS Classification</td>
									<td style="border: 1px solid black;padding:4px 3px;"></td>
								</tr>
					    </table>
					</td>
					<td style="width:2%;">
					    <table align="center" width="100%" class="test1" style="">
							<tr>
								<td style="">&nbsp;</td>
							</tr>
					    </table>
					</td>
					<td style="width:60%;">
					    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" >
											<tr>
									<td colspan="5" style="border: 1px solid black;text-align:center;font-size: 12px;padding:12px 3px;"><b>SUMMARY</b></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:20%"><b>Fraction</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:20%"><b>Coarse</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:20%"><b>Medium</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:20%"><b>Fine</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:20%"><b>Total %</b></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Gravel</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain1']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain4']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain7']; ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain1'] + $row_select_pipe['grain4'] + $row_select_pipe['grain7']); ?></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Sand</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain2']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain5']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain8']; ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain2'] + $row_select_pipe['grain5'] + $row_select_pipe['grain8']); ?></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Silt</b></td>
									<td rowspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain3']; ?></td>
									<td rowspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain6']; ?></td>
									<td rowspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['grain9']; ?></td>
									<td rowspan="2" style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain3'] + $row_select_pipe['grain6'] + $row_select_pipe['grain9']); ?></td>
								</tr>
								<tr>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><b>Clay</b></td>
								</tr>
								<tr>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;font-size: 12px;"><b>TOTAL</b></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain1'] + $row_select_pipe['grain2'] + $row_select_pipe['grain3']); ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain4'] + $row_select_pipe['grain5'] + $row_select_pipe['grain6']); ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain7'] + $row_select_pipe['grain8'] + $row_select_pipe['grain9']); ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['grain1'] + $row_select_pipe['grain2'] + $row_select_pipe['grain3'] + $row_select_pipe['grain4'] + $row_select_pipe['grain5'] + $row_select_pipe['grain6'] + $row_select_pipe['grain7'] + $row_select_pipe['grain8'] + $row_select_pipe['grain9']); ?></td>
								</tr>
					    </table>
					</td>				
			</tr>
		</table>
		<br><br><br>
		

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:20px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>


		-------------------- page 22 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>

		 table  43
		<table align="center" width="100%" class="test">
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 0px;font-weight:bold;">IS 2720 (Part 7 & 8)</td>
			</tr>
			<tr>
				<td colspan="8"style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>DENSITY</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:2%"><b>Sr. No.</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:20%"><b>Particulars</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>1</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>2</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>3</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>4</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>5</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;width:5%"><b>6</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">1</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of Mould + Compacted soil (W) in gm </td>
				<td  style="border: 1px solid black;padding:6px 3px;padding:6px 3px;"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">2</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of Mould (W<sub>m</sub>) in gm</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">3</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of compacted soil in gm = (1-2)</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">4</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Water Added in %</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">5</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wet Density (m) in gm/cc</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">6</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Moisture Content (M) in %</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">7</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Dry Density (r<sub>d</sub>) in gm/cc</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td colspan="8" style="border: 0px solid black;text-align:left;padding:20px 3px;"></td>
			</tr>
			<tr>
				<td colspan="8"style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>MOISTURE CONTENT</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>Sr. No.</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>Particulars</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>1</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>2</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>3</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>4</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>5</b></td>
				<td  style="border: 1px solid black;text-align:center;font-size: 12px;padding:6px 3px;"><b>6</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">1</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Container No.</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">2</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container + Wt. of wet soil in gm</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">3</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container + Wt. of dry soil in gm</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">4</td>
				<td  style="border: 1px solid black;text-align:left;">&nbsp;Wt. of water in gm = (2) -(3)</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">5</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container in gm</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">6</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of oven dry soil in gm = (3) - (5)</td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:6px 3px;">7</td>
				<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Moisture Content (M) in % </td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
				<td  style="border: 1px solid black;padding:6px 3px;text-align:center"></td>
			</tr>
			
		</table>
		<br><br><br><br><br><br><br><br><br><br><br>

		 <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:20px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>

        <div class="pagebreak"></div>
				

		
		
		-------------------- page 23 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>

		 table  44
		<table align="center" width="100%" class="test">
					
					<tr>
						<td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:12px 3px;font-weight:bold">IS 2720 (Part-2)</td>
					</tr>	
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;width:35%;">&nbsp;Sample ID No.</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;BH / Sample No.</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Depth in mt.</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td colspan="6" style="border: 1px solid black;text-align:center;padding:6px 3px;font-size:13px"><b>NATURAL MOISTURE CONTENT (NMC)</b></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp; Container No.</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container + wet soil (Ww) in gm</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container + dry soil (W<sub>d</sub>) in gm</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of Moisture in gm W<sub>m</sub>=W<sub>w</sub> - W<sub>d</sub></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of container in gm</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Wt. of dry soil (W<sub>ds</sub>) in gm</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;">&nbsp;Moisture Content (m) in % (W<sub>m</sub>/W<sub>ds</sub>) x 100</td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
						<td  style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
					</tr>
		</table>
		

		 table  45
		<table align="center" width="100%" class="test">
					
			<tr>
			    <td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 3px;font-weight:bold;">IS 2720 (Part-14)</td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:4px 3px;"><b>&nbsp;(A) Minimum Density</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Volume of Mould : 3000 cc / 15000 cc</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:10%;">Sr. No.</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:55%;">Description</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:25%;">Result</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:15%;">Unit</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">1</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of sand (Sample) + Mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">2</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Empty Mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">3</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of loose sand in mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
			    <td  style="border: 1px solid black;text-align:center;padding:4px 3px;">4</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wt. of Compacted sand <br> &nbsp;Minimum Density =&nbsp;&nbsp; -------------------------------------	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Volume of Mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm / cc</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 0px solid black;text-align:left;padding:4px 3px;"></td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:4px 3px;width:15%;"><b>&nbsp;(B) mum Density</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:15%;"><b>Volume of Mould : 3000 cc / 15000 cc</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">Sr. No.</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">Description</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">Result</td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">Unit</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">1</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of sand (Sample) + Mould after vibration</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">2</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Empty Mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">3</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of compacted sand in mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm</td>
			</tr>
			<tr>
			    <td  style="border: 1px solid black;text-align:center;padding:4px 3px;">4</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wt. of Compacted sand <br> &nbsp;Minimum Density =&nbsp;&nbsp; -------------------------------------	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Volume of Mould</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;">gm / cc</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 0px solid black;text-align:left;padding:4px 3px;"></td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:4px 3px;width:15%;"><b>&nbsp;(C) Dry Density at 70 % R.D.</b> = 0.70 (Max. - Min.) + min.</td>
				<td  style="border: 1px solid black;text-align:left;padding:4px 3px;"></td>
				<td  style="border: 1px solid black;text-align:center;padding:4px 3px;width:15%;"><b>gm / cc</b></td>
			</tr>
		</table>
		<br>
		
		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:23px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		


		-------------------- page 24 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>

		 table  46
		 <table align="center" width="100%" class="test">
						
				<tr>
					<td VALIGN=BOTTOM colspan="8" style="border: 0px solid black;padding:7px 0px;font-weight:bold;">IS 2720 (Part-6)</td>
				</tr>
				<tr>
					<td rowspan="3" style="border: 1px solid black;text-align:center;padding:7px 3px;width:1%">Sr.<br>No.</td>
					<td rowspan="3" style="border: 1px solid black;text-align:center;padding:7px 3px;width:35%;"><b>Particulars</b></td>
					<td colspan="2" style="border: 1px solid black;text-align:left;padding:7px 3px;width:1%;">&nbsp;<b> Sample ID No..:</b></td>
					<td colspan="2 "style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp;<b> Sample ID No..:</td>
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp;<b> Depth:</b></td>
					<td colspan="2" style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp;<b> Depth:</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:10%">1</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;">2</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;">1</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;">2</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">1</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Container No.</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">2</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Wt. of Container in gm</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">3</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Wt. of container + wet soil pat in gm</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">4</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Volume of wet soil pat(V) in ml</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">5</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Wt. of Container + dry soil pat in gm</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">6</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Volume of dry soil pat (V<sub>o</sub>) in ml</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">7</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Wt. of Oven dry soil pat (W<sub>o</sub>) in gm</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">8</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Wt. of Water in soil in gm</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">9</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Moisture Content of soil pat (W<sub>1</sub>) in % [(8/7) x 100]</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">10</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Shrinkage Limit (W<sub>s</sub>) in %</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">11</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Volumetric Shirnkage Limit (V<sub>s</sub>) in %</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">12</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Shrinkage ratio (R) in %</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">13</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Linear Shrinkage Limit (L<sub>s</sub>) in %</td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%">14</td>
					<td style="border: 1px solid black;text-align:left;padding:7px 3px;width:9%;">&nbsp; Avg. Shrinkage Limit (W<sub>s</sub>) in %</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:7px 3px;width:9%;"></td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:left;padding:7px 0;width:9%;font-size: 14px;"></td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:left;padding:4px 0;width:9%;font-size: 14px;">&nbsp;&#9632;&nbsp;&nbsp; Shrinkage Limit (W<sub>s</sub>) = M.C. - [ Vol. of Wet Pet - Vol. of Dry Pet / Wt. of Dry Pet ] x 100</td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:left;padding:4px 0;width:9%;font-size: 14px;">&nbsp;&#9632;&nbsp;&nbsp; Shrinkage Ratio (R) = W<sub>0</sub> / V<sub>0</sub></td>

				</tr>
				<tr>
					<td colspan="6" style="text-align:left;padding:4px 0;width:9%;font-size: 14px;">&nbsp;&#9632;&nbsp;&nbsp; Volumetric Shrinkage (V<sub>s</sub>) = (W)<sub>1</sub> - W<sub>s</sub> X R</td>
				</tr>
		</table>
		<br><br><br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:23px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>
		
		
		-------------------- page 24 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>

		 table  47
		<table align="center" width="100%" class="test">
				<tr>
					<td VALIGN=BOTTOM colspan="3" style="border: 0px solid black;padding:7px 0px;font-weighr:bold;"><b>IS 2720 (Part-41)</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;font-size:13px;"><b>Description</b></td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Wt. of ring + wet specimen = wl(g)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Wt. of ring = Wr (g)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Diameter of ring D (cm)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Wt. of Wet specimen W=Wl-Wr(g)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Initial thickness of wet Specimen H (cm)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Volume of Specimen V=(&#960;D<sup>2</sup> H) /4 (cc)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Wet Density Yw =W/V (g/cc)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;width:40%;">&nbsp;Dry Density Y<sub>D</sub> (g/cc)</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:4px 3px;width:40%;"><b></b></td>
				</tr>
				<tr>
					<td colspan="3" style="border: 0px solid black;text-align:center;padding:4px 3px;"><b></b></td>
				</tr>
				<tr>
					<td colspan="3" style="border: 1px solid black;text-align:center;padding:4px 3px;font-size: 14px;"><b>MOISTURE CONTENT</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Description</b></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;width:25%;"><b>Before Test</b></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;width:25%;"><b>After Test</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Container No</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Container + Wet Soil Wl (g)</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Container + Dry Soil W2 (g)</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Water W<sub>W</sub> = W1 - W2 (g)</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Container = Wc (g)</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Wt. of Dry Soil Wd = W2-Wc,g</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;Water Content(%) = (W<sub>W</sub> / Wd) * 100</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
					<td style="border: 1px solid black;text-align:left;padding:4px 3px;">&nbsp;</td>
				</tr>	
		</table>
		<br>

		 table  48
		<table align="center" width="100%" class="test">
				<tr>
					<td colspan="3" style="border: 1px solid black;text-align:center;padding:4px 3px;font-size: 14px;"><b>Swell Compression Test</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;width:30%;">Pressure increment (kgf/cm<sup>2</sup>)</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">Compression</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">Change in Thickness of Expanded Specimen</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">0.00-0.05</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">0.05-0.10</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">0.10-0.25</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">0.25-0.50</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">0.50-1.00</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">1.00-2.00</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">2.00-4.00</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">4.00-8.00</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;">8.00-16.00</td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
					<td style="border: 1px solid black;text-align:center;padding:4px 3px;"></td>
				</tr>
				<tr>
					<td colspan="3" style="border: 0px solid black;text-align:left;padding:4px 3px;">&nbsp;NOTE: Change in thickness of expanded specimen =</td>
				</tr>
				<tr>
					<td colspan="3" style="border: 0px solid black;text-align:left;padding:4px 3px;">&nbsp;(Final Reading during compression - Initial Swelling Dial Reading) * Least Count</td>
				</tr>
		</table>
	
		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:23px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>


		-------------------- page 25 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>

		 table  49
		<table align="center" width="100%" class="test">
				<tr>
					<td colspan="3" style="border: 1px solid black;text-align:center;padding:6px 3px;font-size: 14px;"><b>Swelling Testing Readings</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:40%;">Elapsed Time in Hours</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;width:60%;">Swelling Dial Reading (Divn.)</td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">0</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">0.5</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">1</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">2</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">4</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">8</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">12</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">16</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">20</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">24</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">36</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">48</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">60</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">96</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">120</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;padding:6px 3px;">144</td>
					<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"></td>
				</tr>
        </table>
		<br><br><br><br><br><br><br><br><br><br><br><br><br>


		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:23px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
        <div class="pagebreak"></div>

		
		-------------------- page 26 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>

		 table  50
		<table align="center" width="100%" class="test">
					
			<tr>
			    <td colspan="9" style="border: 0px solid black;padding:7px 0px;font-weight:bold;">IS 2720 (Part 29)</td>
			</tr>
			<tr>
				<td colspan="5" style="border: 1px solid black;text-align:left;font-size:14px;padding:7px 3px;"><b>&nbsp;DS No.:-</b></td>
				<td colspan="4" style="border: 1px solid black;text-align:left;font-size:14px;padding:7px 3px;"><b>&nbsp;Test Condition :-</b></td>
			</tr>
			<tr>
				<td colspan="9" style="border: 1px solid black;text-align:center;font-size:14px;padding:7px 3px;"><b>Field Dry Density</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Sr. No.</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Km. No./Sample No</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Volume (cc)</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Wt. of Cutter/Shellby tube-Wet Soil (W<sub>s</sub>)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Wt. of Cutter/Shellby tube(Wc)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Wt. of Wet Soil (W<sub>s</sub> - W<sub>c</sub>)</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;padding:6px 3px;"><b>Wet Density (Dw) gm/cc</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">1</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">2</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">3</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">4</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">5</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			<tr>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;">6</td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td colspan="2" style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
				<td colspan="9" style="border: 1px solid black;text-align:center;font-size:13px;padding:6px 3px;"><b>Field Moisture Content</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:7%;padding:6px 3px;"><b>Sr. No</b></td>
				<td style="border: 1px solid black;text-align:center;width:11%;padding:6px 3px;"><b>Container No.</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of Wet Soil + Container (g)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of Dry Soil + Container (g)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of Container(g)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of Moisture(g)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Wt. of Dry Soil(g)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Moisture Content m(%)</b></td>
				<td style="border: 1px solid black;text-align:center;padding:6px 3px;width:11%"><b>Dry Density Ds = 100 x Dw / 100 + m(gm / cc)</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
				<td style="border: 1px solid black;text-align:left;padding:6px 3px;"></td>
			</tr>
		</table>
		<br><br><br><br><br><br><br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:23px;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
                <tr style="font-size:13px;" >
					<td style="text-align:center;">Page  of </td>
				</tr>
		</table>
		<div class="pagebreak"></div>

		
		-------------------- page 27 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
        <br>

		 table  51
        <?php $cnt = 1; ?>
        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
            <tr>
                <td>
                    <table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
                        <tr>
                            <td style="padding:7px 0;font-size: 13px;"><b>IS 2720 Part-4</b></td>
                        </tr>
                    </table>


                    <table align="center" width="100%" class="test1" height="9%">
                        <tr style="border: 1px solid black;">
                            <td style="width:100px;border-left:1px solid;text-align:left;padding:6px 3px;">Weight of Oven Dry Soil pretreated (W<sub>b</sub>)</td>
                            <td style="width:0px;border-left:1px solid;text-align:left;padding:6px 3px;">25/50 gms</td>
                            <td style="width:0px;border-left:1px solid;text-align:left;padding:6px 3px;">Meniscus Correction (Cm)</td>
                            <td style="width:0px;border-left:1px solid;text-align:left;padding:6px 3px;">0.5</td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">R<sub>h</sub>-Observed Hydrometer reading at Temp T</td>
                            <td style="border-left:1px solid;text-align:center;padding:6px 3px;">°C</td>
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">Temp. Correction (M<sub>1</sub>)</td>
                            <td style="border-left:1px solid;text-align:center;padding:6px 3px;"></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">W = <span style=" padding-bottom: 5px;"> <u>100 G<sub>s</sub>(R<sub>h</sub>+ M<sub>1</sub>-X)</u></span> <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; W<sub>b</sub> (G<sub>s</sub>-G<sub>w</sub>)</td>

                            <td style="border-left:1px solid;text-align:center;padding:6px 3px;">%</td>
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">Dispersing Agent</td>
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">Sodium Hexa-Meta Phosphate + Sodium Carbonate
                            </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">Specific Gravity of Soil Particles (G<sub>s</sub>)</td>
                            <td style="border-left:1px solid;text-align:center;padding:6px 3px;"></td>
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;">Dispersing Agent Correction (X)</td>
                            <td style="border-left:1px solid;text-align:left;padding:6px 3px;"></td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
        <br>

		 table  52
        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
            <tr>
                <td>
                    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">

                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Temp<br>'C'</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Clock<br>Time</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Elapsed Time<br>(t)</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Hydrometer Reading<br>(R' <sub>h</sub>)</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">RH =<br>R'<sub>h</sub>+C'<sub>m</sub><br>(Decimals Only)</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Height of Fall<br>(HR) cms</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Eq. DS<br>(D) mm</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">R<sub>h</sub> + M<sub>1</sub> - X</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Percentage<br>Finer (W)</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Combined % age finer than D as % age of Total Soil</td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">30 Sec</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">1 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">2 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">4 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">8 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">15 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">30 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">60 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">120 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">240 min</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">24 hrs</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br> <br><br><br>

        <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:15px;">
            <tr style="">
                <td style="width:25%;padding-top:5px;">
                    <center>Amendment No.: 01</center>
                </td>
                <td style="width:25%;padding-top:5px;">
                    <center>Amendment Date: 01.04.2023</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Prepared by:</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Approved by:</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Issued by:</center>
                </td>
            </tr>
            <tr>
                <td style="">
                    <center>Issue No.: 03</center>
                </td>
                <td style="">
                    <center>Issue Date: 01.01.2021 </center>
                </td>
                <td style="">
                    <center>Nodal QM</center>
                </td>
                <td style="">
                    <center>Director</center>
                </td>
                <td style="">
                    <center>Nodal QM</center>
                </td>
            </tr>
            <tr style="font-size:13px;">
                <td style="text-align:center;">Page of </td>
            </tr>

        </table>
        <div class="pagebreak"></div>
	

		-------------------- page 28 --------------------
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
					<center><b>FMT-OBS-10</b></center>
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
					<center><b>FMT-OBS-10</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
        <br>

		 table  53
        <?php $cnt = 1; ?>
        <br>
        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
            <tr>
                <td>
                    <table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;">


                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;" rowspan="2">IS Sieve Designation</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;" colspan="3">Weight Retained</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;" rowspan="2">Soil Passing as % of Soil Taken</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;" rowspan="2">Combined % Passing as % of Total Soil Taken</td>

                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Individual</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Cumulative</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">Cumulative %</td>
                        </tr>


                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">25 mm</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_13']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_13']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_13']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_13']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_13']; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">10 mm</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_14']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_14']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_14']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_14']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_14']; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">6.3 mm</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_15']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_15']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_15']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_15']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_15']; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">4.75 mm</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_16']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_16']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_16']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_16']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_16']; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">2.00 mm</td>
                           <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_17']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_17']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_17']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_17']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_17']; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">600 mic</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_18']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_18']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_18']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_18']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_18']; ?></td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">425 mic</td>
                           <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_19']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_19']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_19']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_19']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_19']; ?></td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">212 mic</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_20']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_20']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_20']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_20']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_20']; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;">75 mic</td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_wt_gm_21']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['ret_wt_gm_21']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['cum_ret_21']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_21']; ?></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['pass_sample_21']; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><b>TOTAL</b></td>
                            <td style="border: 1px solid black; padding:6px 3px;text-align:center;"><?php echo $row_select_pipe['blank_extra_1']; ?></td>
                            <td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['ret_wt_gm_13'] + $row_select_pipe['ret_wt_gm_14'] + $row_select_pipe['ret_wt_gm_15'] + $row_select_pipe['ret_wt_gm_16'] + $row_select_pipe['ret_wt_gm_17'] + $row_select_pipe['ret_wt_gm_18'] + $row_select_pipe['ret_wt_gm_19'] + $row_select_pipe['ret_wt_gm_20'] + $row_select_pipe['ret_wt_gm_21']); ?></td>
							<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['cum_ret_13'] + $row_select_pipe['cum_ret_14'] + $row_select_pipe['cum_ret_15'] + $row_select_pipe['cum_ret_16'] + $row_select_pipe['cum_ret_17'] + $row_select_pipe['cum_ret_18'] + $row_select_pipe['cum_ret_19'] + $row_select_pipe['cum_ret_20'] + $row_select_pipe['cum_ret_21']); ?></td>
							<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['pass_sample_13'] + $row_select_pipe['pass_sample_14'] + $row_select_pipe['pass_sample_15'] + $row_select_pipe['pass_sample_16'] + $row_select_pipe['pass_sample_17'] + $row_select_pipe['pass_sample_18'] + $row_select_pipe['pass_sample_19'] + $row_select_pipe['pass_sample_20'] + $row_select_pipe['pass_sample_21']); ?></td>
							<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['pass_sample_13'] + $row_select_pipe['pass_sample_14'] + $row_select_pipe['pass_sample_15'] + $row_select_pipe['pass_sample_16'] + $row_select_pipe['pass_sample_17'] + $row_select_pipe['pass_sample_18'] + $row_select_pipe['pass_sample_19'] + $row_select_pipe['pass_sample_20'] + $row_select_pipe['pass_sample_21']); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br><br>
       
		 table  54-
        <table cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">

            <tr>
                <td style="">
                    <table class="test1" style="border: 1px solid black;font-family : Calibri;">


                        <tr>
                            <td style="width: 220px;border: 1px solid black;padding: 6px 3px;text-align: center">
                                D <sub>10</sub> =
                            </td>
                            <td style="width: 220px;border: 1px solid black;padding: 6px 3px;text-align: center">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 3px;text-align: center">
                                D <sub>30</sub> =
                            </td>
                            <td style="border: 1px solid black;padding: 6px 3px;text-align: center">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 3px;text-align: center">
                                D <sub>60</sub> =
                            </td>
                            <td style="border: 1px solid black;padding: 6px 3px;text-align: center">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                                C<sub>u</sub> = D<sub>60</sub>/ D<sub>10</sub>
                            </td>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                                C<sub>c</sub> = (D<sub>30</sub>)<sub>2</sub> / D<sub>60</sub> X D<sub>10</sub>
                            </td>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                                Liquid Limit
                            </td>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left"><?php echo $row_select_pipe['liquide_limit']; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                                Plasticity Index
                            </td>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left"><?php echo $row_select_pipe['pi_value']; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left">
                                IS Classification
                            </td>
                            <td style="border: 1px solid black;padding: 6px 10px;text-align: left"></td>
                        </tr>
                    </table>
                </td>

                <td style="width:4%;">
                </td>

                <td style="">
                    <table class="test1" style="font-family : Calibri;margin-bottom: 40px;">
                        <tr>
                            <td style="border: 1px solid black;padding: 6px 3px;text-align:center;" colspan=5>
                                <b>SUMMARY</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 90px;border: 1px solid black;padding: 6px 10px;text-align: center">Fraction</td>
                            <td style="width: 90px;border: 1px solid black;padding: 6px 10px;text-align: center">Coarse</td>
                            <td style="width: 90px;border: 1px solid black;padding: 6px 10px;text-align: center">Medium</td>
                            <td style="width: 90px;border: 1px solid black;padding: 6px 10px;text-align: center">Fine</td>
                            <td style="width: 90px;border: 1px solid black;padding: 6px 10px;text-align: center">Total %</td>
                        </tr>
                        <tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Gravel</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g1']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g5']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g9']; ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g1'] + $row_select_pipe['g5'] + $row_select_pipe['g9']); ?></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Sand</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g2']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g6']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g10']; ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g2'] + $row_select_pipe['g6'] + $row_select_pipe['g10']); ?></td>
								</tr>
								<tr>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><b>Silt</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g3']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g7']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g11']; ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g3'] + $row_select_pipe['g7'] + $row_select_pipe['g11']); ?></td>
								</tr>
								<tr>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><b>Clay</b></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g4']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g8']; ?></td>
									<td  style="border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo $row_select_pipe['g12']; ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g4'] + $row_select_pipe['g8'] + $row_select_pipe['g12']); ?></td>
								</tr>
								<tr>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;font-size: 12px;"><b>TOTAL</b></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g1'] + $row_select_pipe['g2'] + $row_select_pipe['g3'] + $row_select_pipe['g4']); ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g5'] + $row_select_pipe['g6'] + $row_select_pipe['g7'] + $row_select_pipe['g8']); ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g9'] + $row_select_pipe['g10'] + $row_select_pipe['g11'] + $row_select_pipe['g12']); ?></td>
									<td  style="font-weight:bold;border: 1px solid black;text-align:center;padding:4px 3px;"><?php echo ($row_select_pipe['g1'] + $row_select_pipe['g2'] + $row_select_pipe['g3'] + $row_select_pipe['g4'] + $row_select_pipe['g5'] + $row_select_pipe['g6'] + $row_select_pipe['g7'] + $row_select_pipe['g8'] + $row_select_pipe['g9'] + $row_select_pipe['g10'] + $row_select_pipe['g11'] + $row_select_pipe['g12']); ?></td>
								</tr>
                      
                    </table>
                </td>
            </tr>
        </table>
        <br><br><br><br>
       
        <table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;margin-top:15px;">
            <tr style="">
                <td style="width:25%;padding-top:5px;">
                    <center>Amendment No.: 01</center>
                </td>
                <td style="width:25%;padding-top:5px;">
                    <center>Amendment Date: 01.04.2023</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Prepared by:</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Approved by:</center>
                </td>
                <td style="width:16.67%;padding-top:5px;">
                    <center>Issued by:</center>
                </td>
            </tr>
            <tr>
                <td style="">
                    <center>Issue No.: 03</center>
                </td>
                <td style="">
                    <center>Issue Date: 01.01.2021 </center>
                </td>
                <td style="">
                    <center>Nodal QM</center>
                </td>
                <td style="">
                    <center>Director</center>
                </td>
                <td style="">
                    <center>Nodal QM</center>
                </td>
            </tr>
            <tr style="font-size:13px;">
                <td style="text-align:center;">Page of </td>
            </tr>

        </table>

	</page>


			<!-- Moisture Content -->


			<!--<table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px" cellspacing="0" cellpadding="2px">
				<tr>
					<td style="width: 20%;text-align: center;font-weight: bold;border-right: 1px solid;" rowspan="6"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
				</tr>
				<tr>
					<td style="text-align: center;font-weight: bold;font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td>
				</tr>
				<tr>
					<td style="text-align: center;font-size: 15px;" colspan="7">(Formerly known as DC Consulant)</td>
				</tr>
				<tr>
					<td style="text-align: center;font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-9816755805,e-mail : officialdcspvtltd@gmail.com</td>
				</tr>
				<tr>
					<td style="text-align: center;font-weight: bold;font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
				</tr>
				<tr>
					<td style="text-align: center;font-weight: bold;font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
				</tr>
				<tr>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 20px;">Moisture Content</td>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6"> ANALYSIS DATA SHEET </td>
					<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;"> QSF-1001</td>
				</tr>
				<tr>
					<td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b></td>
				</tr>
				<tr>
					<td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>
					</td>
				</tr>
				<tr>
					<td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date'])); ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date'])); ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date'])); ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b></td>
				</tr>
				<tr>
					<td style=" text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['qty_1']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam']; ?></td>
					<td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret']; ?></td>
				</tr>
			</table>


			<br>
			<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family:calibri;border-collapse:collapse;" cellspacing="0" cellpadding="2px">
				<tr>
					<td style="border: 0px solid;font-weight:bold;width:15%;" colspan="2">OBSERVATION TABLE</td>
				</tr>

				<tr>
					<td style="border:1px solid;text-align:left;width:50%;">Container No.</td>
					<td style="border:1px solid;width:50%;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border:1px solid;text-align:left;">Wt. of Container (A)</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border:1px solid;text-align:left;">Wt. of Container + Wet Soil (B)</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>

				</tr>
				<tr>
					<td style="border:1px solid;text-align:left;">Wt. of Container + Wet Soil (C)</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				</tr>

				<tr>
					<td style="border:1px solid;text-align:left;">Wt. of Water D=(B-C)</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				</tr>

				<tr>
					<td style="border:1px solid;text-align:left;">Wt. of Dry Soil E=(C-A)</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
				</tr>

				<tr>
					<td style="border:1px solid;text-align:left;">Moisture Content (D/E)X100</td>
					<td style="border:1px solid;"><?php echo $row_select_pipe['']; ?></td>
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
					<td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Checked by</td></b>
					<td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Analyst</td></b>
				</tr>
			</table>



			<div class="pagebreak"></div>



			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>

	-->
</body>

</html>


<script type="text/javascript">
	// window.onload = function() {
	// 	setTimeout(function() {

	// 			window.print();
	// 		},
	// 		1000);

	// }
</script>