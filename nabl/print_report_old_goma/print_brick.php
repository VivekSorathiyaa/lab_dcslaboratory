<?php 
session_start();
include("../connection.php");
error_reporting(1);?>
<style>
@page { margin: 0 40px; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
  width: 21cm;
  height: 29.7cm;  
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

</style>
<html>
	<body>
			<?php
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from span_brick WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			
			$client_address= $row_select['clientaddress'];
			$r_name= $row_select['refno'];
			$agreement_no= $row_select['agreement_no'];
			
			$rec_sample_date= $row_select['sample_rec_date'];	
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
				$issue_date= $row_select2['issue_date'];								
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
					$mark= $row_select4['brick_mark'];
					$brick_specification= $row_select4['brick_specification'];
					$material_location= $row_select4['material_location'];
				}
						
			
		?>
		
		
		
		<br>
		<br>
		<br>
		<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Physical Properties of Burt Clay Building Bricks</b></td>
			</tr>
		

		<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">

						<td style="width:12%;padding-bottom: 6px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;">&nbsp;&nbsp; <?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR- " . $row_select_pipe['ulr'];
															} ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
						<td style="width:2%;padding-bottom: 4px;">&nbsp;&nbsp; Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align: left;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $report_no; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 14px 0;">
					<tr style="">
						<td style="width:12%;font-size: 11px;padding-bottom: 4px;">Customer</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;">
							<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
								$result_selectc = mysqli_query($conn, $select_queryc);

								if (mysqli_num_rows($result_selectc) > 0) {
									$row_selectc = mysqli_fetch_assoc($result_selectc);
									$ct_nm = $row_selectc['city_name'];
								}
								echo $clientname; ?>
						</td>
					</tr>
					<tr style="">
						<td style="width:12%;font-size: 11px;padding-bottom: 4px;">Name of Work</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?></td>
					</tr>
					<tr style="">
						<td style="width:12%;font-size: 11px;padding-bottom: 4px;">Agency</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
						</td>
					</tr>
					<tr style="">
						<td style="width:12%;font-size: 11px;padding-bottom: 4px;">Agg No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"><?php echo $agreement_no; ?></td>
					</tr>
				</table>
			</tr>
			
			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 14px 0;margin-bottom: 18px;">
					<tr style="">

						<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;padding-bottom: 4px;"></td>
						<td style="width:21%;padding-bottom: 4px; text-align:left;">Frog Mark</td>
						<td style="width:6%;padding-bottom: 4px;"> &raquo;</td>
						<td style="width:40%;padding-bottom: 4px;">*</td>
					</tr>
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Date of Letter</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;padding-bottom: 4px;"><?php echo $date_of_latter;?></td>
						<td style="width:21%;padding-bottom: 4px;text-align:left;">Test Started</td>
						<td style="width:6%;padding-bottom: 4px;"> &raquo;</td>
						<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Material Received</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;padding-bottom: 4px;">Burnt Clay Building Bricks (25 Nos.)</td>
						<td style="width:21%;padding-bottom: 4px;text-align:left;">Test Completed</td>
						<td style="width:6%;padding-bottom: 4px;"> &raquo;</td>
						<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
					</tr>
				</table>
			</tr>

		
		
		<!-- <tr>
				<td  style="text-align:center;font-size:11px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">
			
						<tr style=""> 
							<td  style="border-left: 1px solid black;width:4%;font-weight:bold; text-align:center; "> 1</td>
							<td  style="border-left: 1px solid black;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;font-weight:bold; ">Bricks Description</td>				
							<td  style="border-left: 1px solid black;width:28%; text-align:center;"><?php echo $mt_name;?></td>
							<td  style="border-left: 1px solid black;width:4%;font-weight:bold;text-align:center; ">4</td>
							<td  style="border-left: 1px solid black;width:18%;text-align:center;font-weight:bold;">Sample No.</td>
							<td  style="border-left: 1px solid black;width:28%;border-right: 1px solid;text-align:center;">25 NOS</td>
						</tr>
						
						<tr style=""> 
							
							<td  style="border-left: 1px solid black;width:4%;font-weight:bold; text-align:center; border-top:1px solid;"> 2</td>
							<td  style="border-left: 1px solid black;width:18%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;font-weight:bold; ">Frog ID</td>				
							<td  style="border-left: 1px solid black;width:28%; text-align:center;border-top:1px solid;">--</td>
							<td  style="border-left: 1px solid black;width:4%;font-weight:bold;text-align:center; border-top:1px solid;">5</td>
							<td  style="border-left: 1px solid black;width:18%;border-top:1px solid;text-align:center;font-weight:bold;">Testing Starting Date</td>
							<td  style="border-left: 1px solid black;width:28%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php echo date('d - m - Y', strtotime($start_date));?></td>
						</tr>
						<tr style=""> 
							
							<td  style="border-left: 1px solid black;width:4%;font-weight:bold; text-align:center; border-top:1px solid;"> 3</td>
							<td  style="border-left: 1px solid black;width:18%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;font-weight:bold; ">Sample Recevied</td>				
							<td  style="border-left: 1px solid black;width:28%; text-align:center;border-top:1px solid;"><?php echo date('d - m - Y', strtotime($rec_sample_date));?></td>
							<td  style="border-left: 1px solid black;width:4%;font-weight:bold;text-align:center; border-top:1px solid;">6</td>
							<td  style="border-left: 1px solid black;width:18%;border-top:1px solid;text-align:center;font-weight:bold;">Completion Date</td>
							<td  style="border-left: 1px solid black;width:28%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php echo date('d - m - Y', strtotime($end_date));?></td>
						</tr>
						
						
					</table>
				
				</td>
		</tr>

		<tr>
		  <td style="text-align:center;font-size:11px; ">
			<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:18px;font-family: Cambria;">
				<TR>
					<td style="text-align:center;font-weight:bold;">DIMENSION TEST</td>
				</tr>
			</table>
		  </td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:11px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">
			
						<tr style=""> 
							
							<td  style="border-left: 1px solid black;width:25%;font-weight:bold; text-align:center; " rowspan=2>Size of Bricks</td>
							<td  style="border-left: 1px solid black;width:20%;text-align:center;font-weight:bold; "rowspan=2>Result(mm)</td>				
							<td  style="border-left: 1px solid black;width:55%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;" colspan=2>Requirement as per IS 1077-1992 RA 2021</td>
							
						</tr>
						
						<tr style=""> 
							
							<td  style="border-left: 1px solid black;width:27.5%;font-weight:bold; text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;">Modular</td>
							<td  style="border-left: 1px solid black;width:27.5%;text-align:center;border-top:1px solid;font-weight:bold; ">Non-Modular</td>	
						</tr>
						<tr style=""> 
							
							<td  style="border-left: 1px solid black;width:25%; text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;"> Length</td>
							<td  style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid; "><?php  echo $row_select_pipe['avg_length'];?></td>				
							<td  style="border-left: 1px solid black;width:27.5%; text-align:center;border-top:1px solid;">3800 ± 80 mm</td>
							<td  style="border-left: 1px solid black;width:27.5%;text-align:center; border-top:1px solid;">4600 ± 80 mm</td>
						</tr>
						<tr style=""> 
							
							<td  style="border-left: 1px solid black;width:25%; text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;"> Width</td>
							<td  style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid; "><?php  echo $row_select_pipe['avg_width'];?></td>				
							<td  style="border-left: 1px solid black;width:27.5%; text-align:center;border-top:1px solid;">1800 ± 40 mm</td>
							<td  style="border-left: 1px solid black;width:27.5%;text-align:center; border-top:1px solid;">2200 ± 40 mm</td>
						</tr>
						<tr style=""> 
							
							<td  style="border-left: 1px solid black;width:25%; text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;"> Height</td>
							<td  style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid; "><?php  echo $row_select_pipe['avg_height'];?></td>				
							<td  style="border-left: 1px solid black;width:27.5%; text-align:center;border-top:1px solid;">1800 ± 40 mm / 800 ± 80 mm</td>
							<td  style="border-left: 1px solid black;width:27.5%;text-align:center; border-top:1px solid;">1400 ± 40 mm / 600 ± 40 mm</td>
						</tr>
						
						
					</table>
				
				</td>
		</tr> -->
		
	
		<?php $cnt = 1; ?>
		<tr>
			<td style="text-align:center;font-size:10px; ">
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;">

					<tr style="">
						<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:11%;"> Sr.No</td>
						<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:9%;">Test Sample Mark</td>
						<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:10%;">Water Absorption(%)</td>
						<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:9%;">Test Sample Mark</td>
						<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:9%;">Load (kN)</td>
						<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:9%;">Area of Brick (cm<sup>2</sup>)</td>
						<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:9%;">Comp. Strength (N/mm<sup>2</sup>)</td>
						
						<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:9%;">Test Sample Mark</td>
						<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:10%;">Efflorescence</td>
					</tr>

					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">WA 1</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center; padding:5px 4px;"><?php echo $row_select_pipe['wtr_1']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; ">CS 1</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; "><?php echo $row_select_pipe['com_load_1']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; "><?php echo $row_select_pipe['com_area_1']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $row_select_pipe['com_1']; ?></td>
						
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; ">EF 1</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; "><?php echo $row_select_pipe['rbt_efflo1'];?></td>
					</tr>


					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">WA 2</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['wtr_2']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">CS 2</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['com_load_2']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['com_area_2']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;"><?php echo $row_select_pipe['com_2']; ?></td>
						
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">EF 2</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['rbt_efflo2'];?></td>
					</tr>


					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;padding:5px 4px;text-align:center;"><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">WA 3</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['wtr_3']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">CS 3</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['com_load_3']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['com_area_3']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;"><?php echo $row_select_pipe['com_3']; ?></td>
						
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">EF 3</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['rbt_efflo3'];?></td>
					</tr>


					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid blackpadding:5px 4px;text-align:center;"><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">WA 4</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['wtr_4']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">CS 4</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['com_load_4']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['com_area_4']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;"><?php echo $row_select_pipe['com_4']; ?></td>
						
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">EF 4</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;;text-align:center; "><?php echo $row_select_pipe['rbt_efflo4'];?></td>
					</tr>


					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;"><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;;text-align:center; ">WA 5</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['wtr_5']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">CS 5</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['com_load_5']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; "><?php echo $row_select_pipe['com_area_5']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;"><?php echo $row_select_pipe['com_5']; ?></td>
						
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">EF 5</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; ">
						<?php echo $row_select_pipe['rbt_efflo5'];?></td>
					</tr>

					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:right;font-weight:bold;padding: 4px 3px;" colspan=2>Average</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;"><?php echo $row_select_pipe['avg_wtr']; ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;font-weight:bold; "></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; font-weight:bold;"></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; font-weight:bold;"></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; font-weight:bold;"></td>
						
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;;text-align:center; font-weight:bold;" colspan=2>---</td>
					</tr>

					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;" >Method of Testing</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; " colspan=2>IS:3495 (P 2) - 2019</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; " colspan=4>I.S.3495 (P 1) 2019</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; " colspan=2>IS:3495 (P 3) - 2019</td>
					</tr>

					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;"colspan=2>Requirement as per Indian Standard I.S. 1077-1992</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center; " >Shall Not be More than 20% (Clause 7.2)</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;" colspan=4>Compressive Strength Shall not be less than <?php echo $brick_specification; ?> N/mm<sup>2</sup>(Table-1 Clause 4.1)</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;padding:5px 4px;text-align:center;" colspan=2>Nil/Slight/ Moderate/  Heavy/ Serious(Clause 7.3)</td>
					</tr>

				</table>
			</td>

		</tr>

		<tr>
			<td style="text-align:center;font-size:10px;">

				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="margin-top: 18px; font-size:10px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

					<tr style="">

						<td style="border-left: 1px solid black;width:55%; border-bottom: 0; text-align:center; padding: 4px 4px;">Dimension Test Result of 20 Nos. Bricks</td>
						<td style="border-left: 1px solid black;width:16%;text-align:center;padding: 4px 4px;">Length, mm</td>
						<td style="border-left: 1px solid black;width:16%;text-align:center; padding: 4px 4px;">Width, mm</td>
						<td style="border-left: 1px solid black;width:24%; text-align:center;padding: 4px 4px;">Thickness, mm</td>

					</tr>

					<tr style="">

						<td style="border-left: 1px solid black;width:55%; font-weight:bold;text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;">Results</td>
						<td style="border-left: 1px solid black;width:16%;text-align:center;border-top:1px solid; "><?php echo $row_select_pipe['avg_length']; ?></td>
						<td style="border-left: 1px solid black;width:16%; text-align:center;border-top:1px solid;"><?php echo $row_select_pipe['avg_width']; ?></td>
						<td style="border-left: 1px solid black;width:24%;text-align:center; border-top:1px solid;"><?php echo $row_select_pipe['avg_height']; ?></td>
					</tr>
					<tr style="">

						<td style="border-left: 1px solid black;width:55%; text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;">Requirement as per Indian Standard 1077-1992 (Clause 6.2)</td>
						<td style="border-left: 1px solid black;width:16%;text-align:center;border-top:1px solid; ">4600 &plusmn; 80 mm</td>
						<td style="border-left: 1px solid black;width:16%; text-align:center;border-top:1px solid;">2200 &plusmn; 40 mm</td>
						<td style="border-left: 1px solid black;width:24%;text-align:center; border-top:1px solid;">1400 &plusmn; 40 mm</td>
					</tr>
				</table>

			</td>
		</tr>

		
		<?php $cnt=1; ?>
		<!-- <tr>
				<td  style="text-align:center;font-size:11px;margin-top:20px;">
		             <table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">
			
						<tr style=""> 
							<td  style="border-left: 1px solid black;width:10%;font-weight:bold;text-align:center; "> Sr.No</td>
							<td  style="border-left: 1px solid black;width:12%;text-align:center;font-weight:bold; ">Lab Sample No.</td>				
							<td  style="border-left: 1px solid black;width:12%; font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px;">Compressive Strength <br>N/mm<sup>2</sup></td>
							<td  style="border-left: 1px solid black;width:12%;font-weight:bold;text-align:center; ">Lab Sample No.</td>
							<td  style="border-left: 1px solid black;width:18%;font-weight:bold;text-align:center; ">Water Absorption(%)</td>
							<td  style="border-left: 1px solid black;width:12%;font-weight:bold;text-align:center; ">Lab Sample No.</td>
							<td  style="border-left: 1px solid black;width:16%;font-weight:bold;text-align:center; " >Efflorescence</td>
						</tr>
						
						<tr style=""> 
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;padding-bottom:5px;padding-top:5px;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">CS-01</td>				
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;"><?php  echo $row_select_pipe['com_1'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">WA-01</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['wtr_1'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">EF-01</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['rbt_efflo1'];?></td>
						</tr>
						<tr style=""> 
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;padding-bottom:5px;padding-top:5px;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">CS-02</td>				
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;"><?php  echo $row_select_pipe['com_2'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">WA-02</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['wtr_2'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">EF-02</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['rbt_efflo2'];?></td>
						</tr>
						<tr style=""> 
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;padding-bottom:5px;padding-top:5px;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">CS-03</td>				
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;"><?php  echo $row_select_pipe['com_3'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">WA-03</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['wtr_3'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">EF-03</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['rbt_efflo3'];?></td>
						</tr>
						<tr style=""> 
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;padding-bottom:5px;padding-top:5px;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">CS-04</td>				
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;"><?php  echo $row_select_pipe['com_4'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">WA-04</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['wtr_4'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">EF-04</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['rbt_efflo4'];?></td>
						</tr>
						<tr style=""> 
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;padding-bottom:5px;padding-top:5px;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">CS-05</td>				
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;"><?php  echo $row_select_pipe['com_5'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">WA-05</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['wtr_5'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">EF-05</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['rbt_efflo5'];?></td>
						</tr>
						
						<tr style=""> 
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:22%;text-align:center;padding-bottom:3px;padding-top:3px;font-weight:bold; "colspan=2>Avg.</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; font-weight:bold;"><?php  echo $row_select_pipe['avg_com'];?></td>				
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;font-weight:bold;">Avg.</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; font-weight:bold;"><?php echo $row_select_pipe['avg_wtr'];?></td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; font-weight:bold;">Avg.</td>
							<td  style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; font-weight:bold;">---</td>
						</tr>
						<tr style=""> 
							<td  style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:22%;text-align:center;padding-bottom:3px;padding-top:3px; "colspan=2>Requirement as per<br> IS 3495:2019 <br>(Part-1&2)</td>
							<td  style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">Not less than <?php echo $brick_specification; ?> N/mm<sup>2</sup></td>				
							<td  style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:12%; text-align:center;">-</td>
							<td  style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; ">Not more than 20%</td>
							<td  style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">-</td>
							<td  style="font-weight:bold;border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "></td>
						</tr>
						
					</table>
		    </td>
		</tr>		 -->
		
		
		<tr>
			<td style="text-align:center;font-size:10px; ">
				<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria; margin-top: 10px;">
					<tr>
						<td style="width:60%;text-align:center;font-weight:bold;padding: 5px 0;">
								** End of Report ** 
						</td>	
					</tr>
				</table>
			</td>
		</tr>
		<tr>
		   <td style="text-align:center;font-size:10px;">
					<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
						<tr>
							<td><b>Note :-</b></td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;width:50%;padding:3px 0;"><b> 1. &nbsp;</b>The results are given only for the sample submitted by the Customer/Agency.</td>
							<td style="font-size:11px;text-align:center;width:15%;font-style:italic;"><b>Reviewed & Authorized By</b></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;"><b> 2. &nbsp;</b>The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;"><b> 3. &nbsp;</b>Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;"><b> 4. &nbsp;</b>The Results/Report are not used for publicity.</td>
							<td style="font-size:11px;text-align:center;font-style:italic;"><b>(D.H.Shah/M.D.Shah)</b></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;"><b> 5. &nbsp;</b>*As informed by Customer/Agency.</td>
							<td style="font-size:11px;text-align:center;font-style:italic;"><b>Director/TM</b></td>
						</tr>
					</table>
				</td>
		</tr>
		</table>
	
		
		<table width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
			<tr>
				<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
					Doc ID : FMT-TST-004/ Page 1/1
				</td>
			</tr>
		</table>

		
		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">
			
			
		</div>
		</page>
		
	</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
<script type="text/javascript">

</script>