<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin: 0; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
  width: 21cm;
  height: 29.7cm;  
} 

@media print
{    
    #header_hide_show
    {
        display: none !important;
    }
}
</style>
<style>
.tdclass{
    border: 1px solid black;
    font-size:12px;
	 font-family: Arial;
	
}
.test {
    border-collapse: collapse;
 font-size:12px;
	 font-family: Arial;
}
	.tdclass1{
    
    font-size:12px;
	 font-family: Arial;
}
div.vertical-sentence{
  -ms-writing-mode: tb-rl; /* for IE */
  -webkit-writing-mode: vertical-rl; /* for Webkit */
  writing-mode: vertical-rl;
  
}
.rotate-characters-back-to-horizontal{ 
  -webkit-text-orientation: upright;  /* for Webkit */
  text-orientation: upright; 
}
select {
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
border: none; /* If you want to remove the border as well */
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
			 $select_tiles_query = "select * from flyash_chemical WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			
			$client_address= $row_select['clientaddress'];
			$r_name= $row_select['refno'];
			$agreement_no= $row_select['agreement_no'];
			
				
			$cons= $row_select['condition_of_sample_receved'];			
			if($cons == 0)
			{
				$con_sample = "Sealed";
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
			
			
			if($row_select["agency_name"] !="")
			{
				$agency_name= $row_select['agency_name'];
			}
			
			$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
			$result_select2 = mysqli_query($conn, $select_query2);

			if (mysqli_num_rows($result_select2) > 0) {
				$row_select2 = mysqli_fetch_assoc($result_select2);
				$start_date= $row_select2['start_date'];
				$end_date= $row_select2['end_date'];
				$issue_date= $row_select2['issue_date'];$rec_sample_date= $row_select2['receive_date'];	
				 $rec_sample_date= $row_select2['receive_date'];
				$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'"; 
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$mt_name= $row_select3['mt_name'];
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$grade= $row_select4['cement_grade'];
					$type_of_cement= $row_select4['type_of_cement'];
					$cement_brand= $row_select4['cement_brand'];
					$week_number= $row_select4['fly_source'];
					
				}
				
				
						
			
		?>
		<page size="A4">
	<!-- <input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"> -->
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Chemical Properties of Flyash</b></td>
			</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Chemical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;"> 
						<?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR No.  " . $row_select_pipe['ulr'];  
															} ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:0%;padding-bottom: 4px;;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align:center;"> &raquo;</td>
						<td style="width:40%padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $report_no; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;padding-top: 14px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top: 14px;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;padding-top: 14px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																					$result_selectc = mysqli_query($conn, $select_queryc);

																					if (mysqli_num_rows($result_selectc) > 0) {
																						$row_selectc = mysqli_fetch_assoc($result_selectc);
																						$ct_nm = $row_selectc['city_name'];
																					}
																					echo $clientname; ?>
								</td>
							</tr>
					
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
							<td style="width:12%;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>


						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:4px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
							</tr>
						
						<?php
						}
						if ($row_select['pmc_name'] != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:14px;"><?php echo $row_select['pmc_heading']; ?></td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 14px;"><?php echo $row_select['pmc_name']; ?>
								</td>
							</tr>

						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $letter_no;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $date_of_latter;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<!-- <tr>
							<td style="width:22%;">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family: Cambria;"><b>:</b></td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr> -->

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Brand</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $source; ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Source of Flyash</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $fly_source; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Brand Name of Cement used</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $source; ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Environment Condition</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php if($cons=="1"){ echo "Sealed";}elseif($cons=="2"){ echo "Unsealed";}elseif($cons=="3"){ echo "Good";}elseif($cons=="4"){ echo "Poor";}else{ echo "Sealed";} ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Week No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $source; ?></td>
						</tr>
						
					</table>
				</td>
			</tr>
			<br>
		<?php $cnt = 1; ?>
			<table align="center" width="97%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
			
					<tr style="text-align:center;height:20px;">
						<td rowspan='2' style="width:5%;border:1px solid black;border-right:0px solid;border-bottom:0px;"><b>Sr. No.</b></td>
						<td rowspan='2' style="width:40%;border:1px solid black;border-right:0px solid;border-bottom:0px;"><b>Test</b></td>
						
						<td rowspan='2' style="width:15%;border:1px solid black;border-right:0px solid;border-bottom:0px;"><b>Test Method Ref.</b></td>
						<td rowspan='2' style="width:12%;border:1px solid black;border-right:0px solid;border-bottom:0px;"><b>Result Obtained</b></td>
						
						<td colspan="2" style="width:25%;border:1px solid black;border-bottom:0px;"><b> Requirements As Per<br><?php if($row_select_pipe['com_test_req']!="" && $row_select_pipe['com_test_req']!=null && $row_select_pipe['com_test_req']!="0" && $row_select_pipe['com_test_req']!="undefined"){echo $row_select_pipe['com_test_req'];}else{?> IS 3812(Part-1):2013 (RA 2017) <?php }?></b></td>
					</tr>
					<tr style="text-align:center;">
						<td style="border:1px solid black;border-bottom:0px;border-right:0px"><b>Siliceous Flyash</b></td>
						<td style="border:1px solid black;border-bottom:0px;"><b>Calcareous Flyash</b></td>
						
					</tr>									
					
					
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;">1.</td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:left;"><b>&nbsp; 
						SiO<sub>2</sub> + Al<sub>2</sub>O<sub>3</sub> + Fe<sub>2</sub>O<sub>3</sub> %
						</b></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['com_test_method']);}else{?>IS 1727 : 1967<br>(RA 2018)<?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php echo number_format($row_select_pipe['per1'],2)." %";?></td>
						
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px"><?php if($row_select_pipe['com_test_limit_1']!="" && $row_select_pipe['com_test_limit_1']!=null && $row_select_pipe['com_test_limit_1']!="0" && $row_select_pipe['com_test_limit_1']!="undefined"){echo $row_select_pipe['com_test_limit_1'];}else{?>Min. 70<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe['com_test_limit_2']!="" && $row_select_pipe['com_test_limit_2']!=null && $row_select_pipe['com_test_limit_2']!="0" && $row_select_pipe['com_test_limit_2']!="undefined"){echo $row_select_pipe['com_test_limit_2'];}else{?>Min. 50<?php }?></td>
					</tr>
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;">2.</td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:left;"><b>&nbsp; 
						Silicon Dioxide as SiO<sub>2</sub> %
						</b></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['sio_test_method']!="" && $row_select_pipe['sio_test_method']!=null && $row_select_pipe['sio_test_method']!="0" && $row_select_pipe['sio_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['sio_test_method']);}else{?>IS 1727 : 1967<br>(RA 2018)<?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php echo number_format($row_select_pipe['sio7'],2)." %";?></td>
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px"><?php if($row_select_pipe['sio_test_limit_1']!="" && $row_select_pipe['sio_test_limit_1']!=null && $row_select_pipe['sio_test_limit_1']!="0" && $row_select_pipe['sio_test_limit_1']!="undefined"){echo $row_select_pipe['sio_test_limit_1'];}else{?>Min. 35<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe['sio_test_limit_2']!="" && $row_select_pipe['sio_test_limit_2']!=null && $row_select_pipe['sio_test_limit_2']!="0" && $row_select_pipe['sio_test_limit_2']!="undefined"){echo $row_select_pipe['sio_test_limit_2'];}else{?>Min. 25<?php }?></td>
						
					</tr>
					
					
					
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;">3.</td>
						<td style="border:1px solid black;text-align:left;border-right:0px solid;border-bottom:0px;"><b>&nbsp; Magnesium oxide (Mgo) %</b></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['mang_test_method']!="" && $row_select_pipe['mang_test_method']!=null && $row_select_pipe['mang_test_method']!="0" && $row_select_pipe['mang_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['mang_test_method']);}else{?>IS 1727 : 1967<br>(RA 2018)<?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php if($row_select_pipe['mgo4']=="" && $row_select_pipe['mgo4']==null && $row_select_pipe['mgo4']=="0"){
						echo "-";}else{echo number_format($row_select_pipe['mgo4'],2)." %";}?></td>	
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px"><?php if($row_select_pipe['mang_test_limit_1']!="" && $row_select_pipe['mang_test_limit_1']!=null && $row_select_pipe['mang_test_limit_1']!="0" && $row_select_pipe['mang_test_limit_1']!="undefined"){echo $row_select_pipe['mang_test_limit_1'];}else{?>Max. 5.0<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe['mang_test_limit_2']!="" && $row_select_pipe['mang_test_limit_2']!=null && $row_select_pipe['mang_test_limit_2']!="0" && $row_select_pipe['mang_test_limit_2']!="undefined"){echo $row_select_pipe['mang_test_limit_2'];}else{?>Max. 5.0<?php }?></td>
						
						
					</tr>
					
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;">4.</td>
						<td style="border:1px solid black;text-align:left;border-right:0px solid;border-bottom:0px;"><b>&nbsp; Total sulphur as sulphur trioxide (SO<sub>3</sub>) %</b></td>
						
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['tot_test_method']!="" && $row_select_pipe['tot_test_method']!=null && $row_select_pipe['tot_test_method']!="0" && $row_select_pipe['tot_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['tot_test_method']);}else{?>IS 1727 : 1967<br>(RA 2018)<?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php if($row_select_pipe['so4']=="" && $row_select_pipe['so4']==null && $row_select_pipe['so4']=="0"){
						echo "-";}else{echo number_format($row_select_pipe['so4'],2)." %";}?></td>										
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px"><?php if($row_select_pipe['tot_test_limit_1']!="" && $row_select_pipe['tot_test_limit_1']!=null && $row_select_pipe['tot_test_limit_1']!="0" && $row_select_pipe['tot_test_limit_1']!="undefined"){echo $row_select_pipe['tot_test_limit_1'];}else{?>Max. 3.0<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe['tot_test_limit_2']!="" && $row_select_pipe['tot_test_limit_2']!=null && $row_select_pipe['tot_test_limit_2']!="0" && $row_select_pipe['tot_test_limit_2']!="undefined"){echo $row_select_pipe['tot_test_limit_2'];}else{?>Max. 3.0<?php }?></td>
					</tr>
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;">5.</td>
						<td style="border:1px solid black;text-align:left;border-right:0px solid;border-bottom:0px;"><b>&nbsp; Available Alkali's Na<sub>2</sub>O %</b></td>
						
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['alk_test_method']!="" && $row_select_pipe['alk_test_method']!=null && $row_select_pipe['alk_test_method']!="0" && $row_select_pipe['alk_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['alk_test_method']);}else{?>IS 3812:2013 - P-1 <br>(RA 2017) <?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php if($row_select_pipe['alk2']=="" && $row_select_pipe['alk2']==null && $row_select_pipe['alk2']=="0"){
						echo "-";}else{echo number_format($row_select_pipe['alk2'],2)." %";}?></td>										
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px"><?php if($row_select_pipe['alk_test_limit_1']!="" && $row_select_pipe['alk_test_limit_1']!=null && $row_select_pipe['alk_test_limit_1']!="0" && $row_select_pipe['alk_test_limit_1']!="undefined"){echo $row_select_pipe['alk_test_limit_1'];}else{?>Max. 1.5<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe['alk_test_limit_2']!="" && $row_select_pipe['alk_test_limit_2']!=null && $row_select_pipe['alk_test_limit_2']!="0" && $row_select_pipe['alk_test_limit_2']!="undefined"){echo $row_select_pipe['alk_test_limit_2'];}else{?>Max. 1.5<?php }?></td>
						
					</tr>
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;text-align:center;">6.</td>
						<td style="border:1px solid black;text-align:left;border-right:0px solid;">&nbsp; 
						<b>Total Chlorides %</b>
						</td>
						<td style="border:1px solid black;border-right:0px solid;text-align:center;"><?php if($row_select_pipe['chl_test_method']!="" && $row_select_pipe['chl_test_method']!=null && $row_select_pipe['chl_test_method']!="0" && $row_select_pipe['chl_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['chl_test_method']);}else{?>IS 4032 : 1985<br>(RA 2019)<?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;"><?php echo number_format($row_select_pipe['cl6'],3)." %";?></td>
						
						<td style="text-align:center;border:1px solid black;border-right:0px"><?php if($row_select_pipe['chl_test_limit_1']!="" && $row_select_pipe['chl_test_limit_1']!=null && $row_select_pipe['chl_test_limit_1']!="0" && $row_select_pipe['chl_test_limit_1']!="undefined"){echo $row_select_pipe['chl_test_limit_1'];}else{?>Max. 0.05<?php }?></td>
						<td style="text-align:center;border:1px solid black;"><?php if($row_select_pipe['chl_test_limit_2']!="" && $row_select_pipe['chl_test_limit_2']!=null && $row_select_pipe['chl_test_limit_2']!="0" && $row_select_pipe['chl_test_limit_2']!="undefined"){echo $row_select_pipe['chl_test_limit_2'];}else{?>Max. 0.05<?php }?></td>
					
						
					</tr>
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;text-align:center;border-top:0px">7.</td>
						<td style="border:1px solid black;text-align:left;border-right:0px solid;border-top:0px">
						<b>&nbsp; Total loss on ignition, %</b>
						</td>
						<td style="border:1px solid black;border-right:0px solid;text-align:center;border-top:0px"><?php if($row_select_pipe['los_test_method']!="" && $row_select_pipe['los_test_method']!=null && $row_select_pipe['los_test_method']!="0" && $row_select_pipe['los_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['los_test_method']);}else{?>IS 1727 : 1967<br>(RA 2018)<?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-top:0px"><?php echo number_format($row_select_pipe['ig4'],2)." %";?></td>
						
						<td style="text-align:center;border:1px solid black;border-top:0px;border-right:0px"><?php if($row_select_pipe['los_test_limit_1']!="" && $row_select_pipe['los_test_limit_1']!=null && $row_select_pipe['los_test_limit_1']!="0" && $row_select_pipe['los_test_limit_1']!="undefined"){echo $row_select_pipe['los_test_limit_1'];}else{?>Max. 5.0<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-top:0px"><?php if($row_select_pipe['los_test_limit_2']!="" && $row_select_pipe['los_test_limit_2']!=null && $row_select_pipe['los_test_limit_2']!="0" && $row_select_pipe['los_test_limit_2']!="undefined"){echo $row_select_pipe['los_test_limit_2'];}else{?>Max. 5.0<?php }?></td>
					</tr>
					
			</table>
			<br>
			<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
				<tr>
					<td style="width:60%;text-align:center;font-weight:bold;padding:7px 0;">
							** End of Report ** 
					</td>																		
				</tr>
			</table>

			<table align="center" width="100%" class="test">
					<tr>
						<td style="text-align:center;font-size:10px;">
							<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
								<tr>
									<td><b>Note :-</b></td>
									<td></td>
								</tr>
								<tr>
									<td style="font-size:10px;width:50%;padding:3px 0;"> 1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
									<td style="text-align:center;width:15%;font-style:italic;font-size:11px;"><b>Reviewed & Authorized By</b></td>
								</tr>
								<tr>
									<td style="font-size:10px;padding:3px 0;"> 2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
									<td></td>
								</tr>
								<tr>
									<td style="font-size:10px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
									<td></td>
								</tr>
								<tr>
									<td style="font-size:10px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
									<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
								</tr>
								<tr>
									<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
									<td style="text-align:center;font-style:italic;font-size:11px;"><b>Director/TM</b></td>
								</tr>
							</table>
						</td>
					</tr>
			</table>

			<table width="100%" align="center" style="font-family:Cambria;font-size:10px;">
							<tr>
								<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
									Doc ID : FMT-TST-28/ Page 1/1
								</td>
							</tr>
			</table>
			
		</page>
		
		<!--<page size="A4">
		<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()">
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;margin-left:35px; ">
		<tr>
				<td  style="text-align:center; font-size:20px; "><b>TEST REPORT</b></td>
		</tr>
		</table>
		<table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;border:1px solid black;margin-left:35px;border-bottom: 0px solid black;">
			
			<tr style="border: 1px solid black;height:20px;"> 
				<td  style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null){
					echo "<b>ULR:</b> ".$row_select_pipe['ulr'];}?></td>
				
				<td colspan="3" style="text-align:right; margin:15px;border-bottom: 1px solid black;  "><?php if($report_no != "" && $report_no != "0" && $report_no != null){
					echo " ".$report_no;}?><b>&nbsp;/&nbsp;Date:</b> <?php echo date('d/m/Y', strtotime($issue_date));?>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Name of <span id="put_details"></span><select style="font-weight:bold;border:0px;font-size:11px;" onchange="put_details()" id="details_of_sample"><option>Work</option><option>Project</option></select></b></td>
				<td colspan="3" style="border-bottom: 1px solid black; padding-left:10px;"><?php echo $name_of_work;?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Details of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php
				

				echo $mt_name;
					
				
					
					
					
			?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Report Submitted To </b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'"; 
															$result_selectc = mysqli_query($conn, $select_queryc);

															if (mysqli_num_rows($result_selectc) > 0) {
																$row_selectc = mysqli_fetch_assoc($result_selectc);
																$ct_nm= "";
															}
															echo $clientname; ?> </td>
			</tr>
			
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Reference Letter No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; Date: <?php echo date('d/m/Y', strtotime($row_select2["letter_date"]))." ".$r_name;?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Receipt Date of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Condition of Sample during receipt</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo $con_sample; ?> </td>
			</tr>
			<!--<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Client</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php //echo $clientname; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Consultant</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php // echo $clientname; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Identification Mark</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo $week_number; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Name of Agency</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'"; 
															$result_selectc1 = mysqli_query($conn, $select_queryc1);

															if (mysqli_num_rows($result_selectc1) > 0) {
																$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																$ct_nm1= $row_selectc1['city_name'];
															}
															echo $agency_name." ".$ct_nm1;?> </td>
			</tr>
			<?php if($agreement_no != ""){?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Agreement No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
			</tr>
			<?php } ?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Job No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Lab No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $lab_no;?></td>
			</tr>
			
			<tr style="border: 1px solid black;height:20px;">
				<td width="35%" style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Starting Date of Test</b></td>
				<td width="20%" style="border-bottom: 1px solid black; border-right: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
				<td width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black; text-align:right;">&nbsp;&nbsp;<b> Completion Date of Test &nbsp;</b></td>
				<td width="20%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date));?></td>
			</tr>
			<?php 
				$first_tag = $row_select['first_tag'];
				$second_tag = $row_select['second_tag'];
				$third_tag = $row_select['third_tag'];
				$fourth_tag = $row_select['fourth_tag'];
				
				$first_txt = $row_select['first_txt'];
				$second_txt = $row_select['second_txt'];
				$third_txt = $row_select['third_txt'];
				$fourth_txt = $row_select['fourth_txt'];
				if($first_tag != null && $first_tag != ""){?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $first_tag;?></b></td>
					<td colspan="2" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $first_txt;?></td>				
				</tr>
				<?php }if($second_tag != null && $second_tag != ""){?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $second_tag;?></b></td>
					<td colspan="2" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $second_txt;?></td>				
				</tr>
				<?php }if($third_tag != null && $third_tag != ""){?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $third_tag;?></b></td>
					<td colspan="2" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $third_txt;?></td>				
				</tr>
				<?php }if($fourth_tag != null && $fourth_tag != ""){?>
				<tr >
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $fourth_tag;?></b></td>
					<td colspan="2" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $fourth_txt;?></td>				
				</tr>
				<?php }?>
				<tr>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp; Dear Sir. <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With the refference to your above letter the test result of Concrete Cubes for compressive strength test for <?php //echo $row_select_pipe['day1'];?> Days as &nbsp; under. The sample are tested as per IS 516(Part 1/Sec 1):2021</td>				
				</tr>
		</table>
		<br>
		
		<br>
		<table align="center" width="92%"  class="test" style="border:1px solid black;font-family: Arial;margin-left:35px; " >
			<tr>
				<td width="60px"><b style="">&nbsp; NOTE:- </b> </td>
				<td><p style="align:justify">[1]Test result related to sample collected by supplier. [2]Results/Report is issued with specific understanding the SMTL will not in any case be involved in action following the interpretation of test results. [3]The Reports/Results are not supposed to be used for publicity.  (4) This report can not be reproduced in full or part without written approval of Quality Manager/ Technical Manager.</p></td>
			</tr>
			<tr>				
				<td colspan="2" style="border:0px solid black;border-bottom:0px solid black;"><input Style="width:100%; border:none; font-weight:bold;" type="text" value="<?php echo $row_select_pipe['rem_data'];?>"></td>
			</tr>
		</table>
		<table align="center" width="92%" style="font-family:arial;margin-left:35px; ">
			<tr>
					<td style="">
						<div style="float:right;" id="footer">
							
						</div>
					</td>
					<td style="width:25%;">
						<div style="float:right; text-align:center; padding-right:60px;" id="sign">
							<img src="../images/stamp.png" width="160px">
						</div>
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
		
		
		<table align="center" width="92%" style="font-family:arial;margin-left:35px;margin-top:30px ">
			<tr>
				<td style="font-size:10px;">F/FC/01/TR,Issue No.01 <br> W.e.f. 01.11.2012 </td>
				<td style="text-align:center">&#8226;&#8226; End of Report &#8226;&#8226;</td>
				<td style="text-align:right; font-size:10px;">Page No. 1 of 1</td>
			</tr>
		</table>
		</page>-->
		
	</body>
</html>
<script src="jquery.min.js"></script>		
<script type="text/javascript">
	function header(){
		if(document.querySelector('#header_hide_show').checked){
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" width="100%">');
			document.getElementById("footer").insertAdjacentHTML("afterbegin", '<img src="../images/stamp_tag.png" width="160px">');
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
		} else{
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
			document.getElementById("footer").innerHTML = '';
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');
		}
	}
</script>