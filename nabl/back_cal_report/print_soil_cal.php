<?php
session_start();
include("../connection.php");
error_reporting(0);
?>
<style>
	@page {
		margin:30px 40px;
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
		 $select_tiles_query = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
			$no_of_rows = mysqli_num_rows($result_tiles_select);
			$page_cont = round_up($no_of_rows / 3);
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			$r_name= $row_select['refno'];
			// $sr_no= $row_select['sr_no'];
			// $sample_no= $row_select['job_no'];
			$rec_sample_date= $row_select['sample_rec_date'];	
			$cons= $row_select['condition_of_sample_receved'];	


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
			if($cons == 0)
			{
				$con_sample = "Sealed Ok";
			}
			else
			{
				$con_sample = "Unsealed";
			}
			$name_of_work= strip_tags(html_entity_decode($row_select['nameofwork']),"<strong><em>");						

			$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
			$result_select1 = mysqli_query($conn, $select_query1);

			if (mysqli_num_rows($result_select1) > 0) {
				$row_select1 = mysqli_fetch_assoc($result_select1);
				$agency_name= $row_select1['agency_name'];
			}
			
			$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `isdeleted`='0'";
			$result_select2 = mysqli_query($conn, $select_query2);

			if (mysqli_num_rows($result_select2) > 0) {
				$row_select2 = mysqli_fetch_assoc($result_select2);
				$start_date= $row_select2['start_date'];
				$end_date= $row_select2['end_date'];
								
				$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'"; 
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$detail_sample= $row_select3['mt_name'];
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$chainage_no= $row_select4['chainage_no'];
					$type_method= $row_select4['type_method'];
					
				}
				
	$flag = 0;
	$a = 1;
	$down = 0;
	$up = 5;
	for($a=0;$a<$page_cont;$a++)
			{
	
		?>
	<page size="A4">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table align="center" style="width: 94%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 15px;">SAND REPLACEMENT</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;FIELD DRY DENSITY TEST</td>
            </tr>
            <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $row_select_pipe['s_des'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;IS 1208</td>
            </tr>
            <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;3</td>
            </tr>
            <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?></td>
            </tr>  
        </table> 
            <br><br>
   <table align="center" width="100%" class="test" style="font-family:book-Antiqua;font-size:12px;">				
				<tr>
				<td  width="100%">
				<table align="center" width="92%"  class="test" style="height:auto;width:94%;border:1px solid black;" >
									<tr style="text-align:center;height:20px;">
										<td style="border:1px solid black;border-left:1px solid black;width:5%;"><b>Sr. No.</b></td>
										<td style="border:1px solid black;width:50%;"><b>Description</b></td>
										<td  style="border:1px solid black;width:13%;border-right:0px solid black;align:center;"><b>Test Result</b></td>
										<?php
							$select_tilesy = "select * from core_cutter WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
							// $coming_row = mysqli_num_rows($result_tiles_select1);
							$count=0;
							while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
								
								$count++;
										
					?>
					<td style="border: 1px solid black;width:10%;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $count;?></td>
						<?php }?>	
									
									
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>1</b></td>
										<td style="border:1px solid black;text-align:left">Mean Weight of Sand in Cone(of pouring cyclinder)  W2 in gram </td>
											<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21['c1'];?></b></td>	
											<?php } ?>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>2</b></td>
										<td style="border:1px solid black;text-align:left">Volume of Callibrating Cyclinder (V) Cm3</td>
											<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21['c2'];?></b></td>	
											<?php } ?>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>3</b></td>
										<td style="border:1px solid black;text-align:left">Weight of Sand + Cyclinder before pouring into callibrating Container (W1) in gm</td>
										<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21['c3'];?></b></td>	
											<?php } ?>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>4</b></td>
										<td style="border:1px solid black;text-align:left">Mean Weight of Sand = Cyclinder after pouring into calibrating container (W3) in gm </td>
										<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21['c4'];?></b></td>	
										<?php } ?>										
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>5</b></td>
										<td style="border:1px solid black;text-align:left">Weight of sand to fill calibrating cylinder. (Wa = W1 - W2 - W3) in gm.</td>
										<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21['c5'];?></b></td>	
											<?php } ?>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>6</b></td>
										<td style="border:1px solid black;text-align:left">Bulk density of sand Ys = (Wa /V) gm/cm3</td>
										<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo number_format($row_select_pipe21['c6'],2);?></b></td>			
											<?php } ?>
									</tr>
									
								
									
								</table>
				</td>
				
			</tr>
				<tr >
			
			
					<td style="font-size:14px;padding-top:1px;padding-top:1%;padding-bottom:1.5%"><center><b><u>Determination of Density</u></b></center></td>
			
		</tr>
		
		<tr>
					<!--OTHER START-->
					<td>
						
						
						
							
							<table align="center" width="94%"  class="test" style="height:auto;width:94%;border:1px solid black;" >
									<tr style="text-align:center;height:20px;">
										<td rowspan="2" style="border:1px solid black;width:5%;"><b>Sr. No.</b></td>
										<td rowspan="2"  style="border:1px solid black;width:50%;"><b>Description</b></td>
										<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe211 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>		
										<td  style="border:1px solid black;width:13%;border-right:0px solid black;align:center;"><b>Test Result</b></td>
											<?php }?>
										
									</tr>
									<tr style="text-align:center;">		
				<?php $cnt=0;?>
					<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe211 = mysqli_fetch_array($result_tiles_select1)) {
										$cnt++;
											?>				
					<td style="border: 1px solid black;width:13%;border-bottom: 1px solid black;border-left: 1px solid black;"><B><?php echo $cnt;?></b></td>
											<?php }?>														
				</tr>
									<tr style="text-align:center">
					<td style="border: 1px solid black;">7</td>
					<td style="border: 1px solid black;text-align:left;border-left: 1px solid black;">Determination number</td>
					<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
					<td style="border: 1px solid black;border-left: 1px solid black;"><?php if($row_select_pipe21['layer_mt']!="" && $row_select_pipe21['layer_mt']!="0" && $row_select_pipe21['layer_mt']!=null){echo $row_select_pipe21['layer_mt']; }else{echo " <br>";} ?></td>				
					<?php } ?>
				</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>8</b></td>
										<td style="border:1px solid black;text-align:left">Weight of wet material from hole (Ww)</td>
										<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21['d1'];?></b></td>	
											<?php } ?>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>9</b></td>
										<td style="border:1px solid black;text-align:left">Weight of sand (+ cylinder) before pouring into hole (W1) in gm.</td>
										<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21['d2'];?></b></td>	
											<?php } ?>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>10</b></td>
										<td style="border:1px solid black;text-align:left">Weight of sand (+ cylinder) after pouring into hole and cone (W4) in gm.</td>
										<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21['d3'];?></b></td>		
										<?php } ?>										
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>11</b></td>
										<td style="border:1px solid black;text-align:left">Weight of sand in hole, in gm Wb = (W1 - W4- W2)</td>
											<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21['d4'];?></b></td>		
											<?php } ?>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>12</b></td>
										<td style="border:1px solid black;text-align:left">Bulk density Yb = (Ww /Wb) x Ys gm/cm3</td>
											<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo number_format($row_select_pipe21['d5'],2);?></b></td>	
											<?php } ?>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>13</b></td>
										<td style="border:1px solid black;text-align:left"> Moisture Content % (w)</td>
											<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php 
										if($row_select_pipe21['d6']!="")
										{					
										
											echo $row_select_pipe21['d6'];
										}
										else
										{
												echo $row_select_pipe21['mc_od'];
										}
										?></b></td>		
											<?php } ?>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>14</b></td>
										<td style="border:1px solid black;text-align:left">Percentage of Moisture Content % (w) (m/100-m)*100</td>
										<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);
											$total=0;
											//$cnt=0;
											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo number_format($row_select_pipe21['d7'],2); $total += $row_select_pipe21['d7'];?></b></td>
											<?php } ?>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>15</b></td>
										<td style="border:1px solid black;text-align:left">Weight of dry soil from the hole in gm (Wd) = (Ww/100+w)*100</td>
											<?php
											$select_tilesy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
												$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
											// $coming_row = mysqli_num_rows($result_tiles_select1);

											while ($row_select_pipe21 = mysqli_fetch_array($result_tiles_select1)) {
										
											?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21['d8'];?></b></td>
											<?php } ?>
									</tr>
									
									<tr style="text-align:center">
					<td style="border: 1px solid black;">16</td>
					<td style="border: 1px solid black;border-left: 1px solid black;text-align:left;">Dry density Yd = (Wd/ Wb ) x Ys gm/cm3</td>
					<?php //echo $cnt	;?>
					<td colspan="<?php echo $cnt; ?>" style="border: 1px solid black;border-left: 1px solid black;	"><b><?php $ans = $total/$cnt; echo number_format($ans,2);?></td>	
							
				</tr>
								</table>
					</td>					
									
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
		<?php

	if($flag==3)
				{
					$flag=0;
					$down=$up;
					$up +=3;
	?>
	<div class="pagebreak"> </div>
	<?php }


	}

	?>
</body>


</html>


<script type="text/javascript">


</script>