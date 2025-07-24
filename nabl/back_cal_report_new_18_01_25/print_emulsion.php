<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin: 0px 30px; }
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
	 font-family : Calibri;
	
}
.test {
    border-collapse: collapse;
 font-size:12px;
	 font-family : Calibri;
}
	.tdclass1{
    
    font-size:12px;
	 font-family : Calibri;
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


.tdclass{
    border: 1px solid black;
    font-size:11px;
	 font-family : Calibri;
}
.test {
   border-collapse: collapse;
	font-size:12px;
	 font-family : Calibri;
}
.test1 {
   font-size:12px;
   border-collapse: collapse;
	 font-family : Calibri;
	 
}
	.tdclass1{
    
    font-size:11px;
	 font-family : Calibri;
}
.details{
	margin:0px auto;
	padding:0px;
}

</style>
<html>
	<body>
			<?php
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from emulsion WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			  $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			
			$client_address= $row_select['clientaddress'];
			$r_name= $row_select['refno'];
			$agreement_no= $row_select['agreement_no'];
			$branch_name = $row_select['branch_name'];
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
					include_once 'sample_id.php';
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$bitumin_grade= $row_select4['bitumin_grade'];
					$lot_no= $row_select4['lot_no'];
					$bitumin_make= $row_select4['bitumin_make'];
					$tank_no= $row_select4['tanker_no'];
					$material_location= $row_select4['material_location'];
				}
		?>
		

		<br><br><br><br><br>

	<page size="A4">
		<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">			
			<tr>
				<td>
				<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						<tr>
							<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">BITUMEN EMULSION</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: left;padding-bottom: 5px; font-size: 12px;">Format No :- ICT-BE-TST-01</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding-bottom: 5px;border: 0;">Sample ID :-</td>
							<td style="padding: 2px;"><?php echo $sample_id; ?></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding-bottom: 5px;border: 0;">Material Description :-</td>
							<td style="padding: 2px;"><?php echo $mt_name; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Testing Date :-</td>
							<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date)); ?>&nbsp; To &nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Bitumen Grade :-</td>
							<td style="padding: 2px;"><?php echo $bitumin_grade; ?></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 0px solid;" colspan="4"></td>
						</tr>
					</table>
				</td>
			</tr>

				<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">Residue on 600 micron</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Reference: -</td>
								<td style="padding: 2px;">IS 8887: 2018</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Date: -</td>
								<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			
			
				<tr>
					<td>
						<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
						
							<tr>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Sr <br> No.</b></td>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Wt. of Sieve + pan <br>
										(g)</b></td>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Wt. of Emulsion <br> (g)</b></td>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Wt. of sieve + pan + residue <br> (g) </b></td>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Wt. of residue <br> (g)</b></td>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Residue <br> % </b></td>
							</tr>
							<tr>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>1</b></td>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems20'];?></b></td>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems19'];?></b></td>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems21'];?></b></td>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems8'];?></b></td>
								<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems9'];?></b></td>

							</tr>
					
					</table>
					</td>
				</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">VISCOSITY BY SYOLTFUROL</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Reference: -</td>
								<td style="padding: 2px;">IS 3117 : 2004, IS:8887 : 2018</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Date: -</td>
								<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			
			<tr>
					<td>

			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				
					<tr>
						<td width="10%" rowspan="2" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Sr <br> No.</b></td>
						<td width="10%" colspan="2" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>25 <sup>0</sup>C</b></td>
						<td width="10%" colspan="3" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>50 <sup>0</sup>C</td>
					</tr>

					<tr>

						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>SS1</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>SS2 </b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>RS1</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>RS2</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>MS</b></td>
					</tr>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;">1</td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['ems1'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['ems15'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['ems16'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['ems17'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['ems18'];?></td>

					</tr>
				
			</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">Storage Stability after 24<sup>th</sup> hrs</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Reference: -</td>
								<td style="padding: 2px;">IS 8887: 2018</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Date: -</td>
								<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date." +1 day")); ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			
			
			<tr>
					<td>
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Sr <br> No.</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Wt. of beaker + rod<br>(W1)<br>g</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Wt. of beaker + rod + <br> residue (W2) <br> g</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Difference <br> (W2-W1) <br> g</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Residue <br> % </b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Average <br> %</b></td>
					</tr>
					<tr>
						<td width="10%" rowspan="2" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Top</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_3'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_7'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo substr(($row_select_pipe['wt_7'] -$row_select_pipe['wt_3']),0,5);?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems11'];?></b></td>
						<td width="10%" rowspan="4" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo substr((($row_select_pipe['ems11'] + $row_select_pipe['ems12'] + $row_select_pipe['ems13'] + $row_select_pipe['ems14']) / 4),0,5);?></b></td>

					</tr>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_4'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_8'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo substr(($row_select_pipe['wt_8'] -$row_select_pipe['wt_4']),0,5);?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems12'];?></b></td>

					</tr>
					<tr>
						<td width="10%" rowspan="2" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Bottom</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_5'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_9'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo substr(($row_select_pipe['wt_9'] -$row_select_pipe['wt_5']),0,5);?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems13'];?></b></td>

					</tr>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_6'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_10'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo substr(($row_select_pipe['wt_10'] -$row_select_pipe['wt_6']),0,5);?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems14'];?></b></td>

					</tr>
				
			</table>
			</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">Residue by evaporation</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Reference: -</td>
								<td style="padding: 2px;">IS 8887: 2018</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Date: -</td>
								<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date." +1 day")); ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			
		
			<tr>
				<td>
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Sr <br> No.</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Wt. of beaker + rod<br>(W1)<br>g</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Wt. of beaker + rod + <br> residue (W2) <br> g</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Difference <br> (W2-W1) <br> g</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Residue <br> % </b></td>
					</tr>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>1</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_1'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_2'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo substr(($row_select_pipe['wt_2'] -$row_select_pipe['wt_1']),0,5);?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems4'];?></b></td>

					</tr>
				</tbody>
			</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">Solubility in trichloroethylenen</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Reference: -</td>
								<td style="padding: 2px;">IS 1216: 1978</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Date: -</td>
								<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date." +2 day")); ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			

			<tr>
					<td>
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Sr <br> No.</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Wt. of Bitumen (W1)<br>g</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Wt. of residue (W2) <br> g</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Solubility <br> % </b></td>
					</tr>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>1</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['w1_1'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['w2_1'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems5'];?></b></td>

					</tr>
				</tbody>
			</table>
				</td>
			</tr>
			<tr>
					<td>
			<table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<!-- <tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
								<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
							</tr> -->
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
								<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
								<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
							</tr>
							<tr>
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				
			</table>
					</td>
			</tr>
			</table>

		    <div class="pagebreak"></div>
			<br><br><br><br><br>
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">			
			<tr>
				<td>
				<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						<tr>
							<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">BITUMEN EMULSION</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: left;padding-bottom: 5px; font-size: 12px;">Format No :- ICT-BE-TST-02</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding-bottom: 5px;border: 0;">Sample ID :-</td>
							<td style="padding: 2px;"><?php echo $sample_id; ?></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding-bottom: 5px;border: 0;">Material Description :-</td>
							<td style="padding: 2px;"><?php echo $mt_name; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Testing Date :-</td>
							<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date)); ?>&nbsp; To &nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 2px;border: 0;">Bitumen Grade :-</td>
							<td style="padding: 2px;"><?php echo $bitumin_grade; ?></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 0px solid;" colspan="4"></td>
						</tr>
					</table>
				</td>
			</tr>

				<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">Penetration</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Reference: -</td>
								<td style="padding: 2px;">IS 1203-2022</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Date: -</td>
								<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4">Test Temp 25°C</td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			
			
			<tr>
					<td>
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>1</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>2</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>3</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>4</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>5</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Average Value</b></td>
					</tr>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['ems2'];?></b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['pen_1'];?></b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['pen_2'];?></b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['pen_3'];?></b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['pen_4'];?></b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo substr((($row_select_pipe['ems2'] + $row_select_pipe['pen_1'] + $row_select_pipe['pen_2'] + $row_select_pipe['pen_3'] + $row_select_pipe['pen_4']) / 5),0,5);?></b></td>

					</tr>
				</tbody>
			</table>
			</td>
				</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">Ductility</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Reference: -</td>
								<td style="padding: 2px;">IS 1208 Part 1</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Date: -</td>
								<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4">Test Temp 25°C</td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			
			
			<tr>
					<td>
			
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>1</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>2</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>3</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b>Average Value (In cm)</b></td>
					</tr>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['ems3'];?></b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['duc_1'];?></b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['duc_2'];?></b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo substr((($row_select_pipe['ems3'] + $row_select_pipe['duc_1'] + $row_select_pipe['duc_2']) / 3),0,5);?></b></td>

					</tr>
				</tbody>
			</table>
				</td>
			</tr>
			
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">Miscibility with water</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Reference: -</td>
								<td style="padding: 2px;">IS 1208 Part 1</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Date: -</td>
								<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			
			
			<tr>
				<td>
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:7px 0px;"><b><?php echo $row_select_pipe['ems6'];?></b></td>
					</tr>
				</tbody>
			</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;"> Particle Charge (Positive/Negative)</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Reference: -</td>
								<td style="padding: 2px;">IS 1208 Part 1</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Date: -</td>
								<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:7px 0px;"><b><?php echo $row_select_pipe['ems7'];?></b></td>
					</tr>
				</tbody>
			</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;"> Coagulation at low temperature</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Reference: -</td>
								<td style="padding: 2px;">IS 1208 Part 1</td>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width: 15%;">Date: -</td>
								<td style="padding: 2px;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			
			<tr>
					<td>
			
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:7px 0px;"><b><?php echo $row_select_pipe['ems10'];?></b></td>
					</tr>
				</tbody>
			</table>
					</td>
			</tr>

			<!-- Table Close -->
			
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<!-- <tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
								<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
							</tr> -->
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
								<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
								<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
							</tr>
							<tr>
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				
			</table>
		</page>
		
	</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
<script type="text/javascript">

</script>