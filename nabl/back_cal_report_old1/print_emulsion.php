<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin:30px 40px; }
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


.tdclass{
    border: 1px solid black;
    font-size:10px;
	 font-family: Cambria;
}
.test {
   border-collapse: collapse;
	font-size:12px;
	 font-family: Cambria;
}
.test1 {
   font-size:12px;
   border-collapse: collapse;
	 font-family: Cambria;
	 
}
	.tdclass1{
    
    font-size:11px;
	 font-family: Cambria;
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
					$bitumin_grade= $row_select4['bitumin_grade'];
					$lot_no= $row_select4['lot_no'];
					$bitumin_make= $row_select4['bitumin_make'];
					$tank_no= $row_select4['tanker_no'];
					$material_location= $row_select4['material_location'];
				}
						
			
		?>
		
		<page size="A4">
		    <table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
				<tbody>
					<tr>
						<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
						<td colspan="2" style="font-size:14px;border: 1px solid black;">
							<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
						</td>
					</tr>
					<tr>
						<td style="font-size:11px;border: 1px solid black;">
							<center><b>FMT-OBS-023</b></center>
						</td>
						<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
							<center><b>OBSERVATION &amp; CALCULATION SHEET FOR TEST ON EMULSION</b></center>
						</td>
					</tr>
				</tbody>
			</table>
			<br>

			<table align="center" width="100%" class="test1" height="9%">
				<tbody>
					<tr style="border: 1px solid black;">
						<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;padding:5px 0px;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo  $row_select_pipe['emu_type'];?></b></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="border-left:1px solid;width:25%;text-align:left;padding:5px 0px;"><b>&nbsp; Sample ID No.</b></td>
						<td style="border-left:1px solid;width:70%;text-align:left;padding:5px 0px;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Type of  Emulsion</b></td>
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp;<?php echo  $row_select_pipe['emu_type'];?> </td>
					</tr>
					<tr style="border: 1px solid black;">
					   <td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of sample</b></td>
				      <td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($rec_sample_date)); ?></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Date of Testing</b></td>
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo date("d - m - y",strtotime($start_date)); ?></td>
					</tr>
				</tbody>
			</table>

		     <!-- Table = 2 -->
			<!-- Rapid Chloride penetration Test -->
			<!-- Table start -->
			<table align="center" width="100%" class="test" cellpadding="5px">
				<tr>
					<td style="padding-top:5px;"><b>IS 8887: 2018 And. 2020</b></td>
				</tr>
				<tr>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>1. Residue on 600 micron</b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:center;"><b></b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>Date:-</b></td>
				</tr>
			</table>
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
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
				</tbody>
			</table>

			<br>
			<table align="center" width="100%" class="test" cellpadding="5px">
				<tr>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>2. Saybolt Furol Viscosity</b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:center;padding:4px 0px;"><b></b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>Date:-</b></td>
				</tr>
			</table>

			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
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
				</tbody>
			</table>

			<br>
			<table align="center" width="100%" class="test" cellpadding="5px">
				<tr>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>3. Storage Stability after 24<sup>th</sup> hrs</b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:center;"><b></b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>Date:-</b></td>
				</tr>
			</table>

			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
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
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems13'];?></td>

					</tr>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_6'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo $row_select_pipe['wt_10'];?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><?php echo substr(($row_select_pipe['wt_10'] -$row_select_pipe['wt_6']),0,5);?></td>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:4px 0px;"><b><?php echo $row_select_pipe['ems14'];?></td>

					</tr>
				</tbody>
			</table>

			<br>
			<table align="center" width="100%" class="test" cellpadding="5px">
				<tr>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>4. Residue by evaporation</b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:center;padding:4px 0px;"><b></b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>Date:-</b></td>
				</tr>
			</table>

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
			<br>

			<table align="center" width="100%" class="test" cellpadding="5px">
				<tr>
					<td width="10%" colspan="2" style=" border:none; text-align:left;"><b>5. Solubility in trichloroethylenen</b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:center;"><b></b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:left;"><b>Date:-</b></td>
				</tr>
			</table>

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
			</table><br><br>

			
			<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tbody>
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 00</center></td>
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
				<tr>
				<td style="padding-top: 0px; text-align: center;">Page 1 of 2</td>
				</tr>
				</tbody>
			</table>

			<br><br><br><br>
		    <div class="pagebreak"></div>


			<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
				<tbody>
					<tr>
						<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
						<td colspan="2" style="font-size:14px;border: 1px solid black;">
							<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
						</td>
					</tr>
					<tr>
						<td style="font-size:11px;border: 1px solid black;">
							<center><b>FMT-OBS-023</b></center>
						</td>
						<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
							<center><b>OBSERVATION &amp; CALCULATION SHEET FOR TEST ON EMULSION</b></center>
						</td>
					</tr>
				</tbody>
			</table>
			<br>

			<table align="center" width="100%" class="test" cellpadding="5px">
				<tr>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>6. Penetration Test IS 1203-2022</b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:center;padding:4px 0px;"><b></b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>Test Temp 25°C</b></td>
				</tr>
			</table>

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
			<br>

			<table align="center" width="100%" class="test" cellpadding="5px">
				<tr>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>7. Ductility Test IS 1208 Part 1-2023</b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:center;padding:4px 0px;"><b></b></td>
					<td width="10%" colspan="2" style=" border:none; text-align:left;padding:4px 0px;"><b>Test Temp 25°C</b></td>
				</tr>
			</table>
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

			<br>
			<table align="center" width="100%" class="test" cellpadding="5px">
				<tr>
					<td width="10%" style=" border:none; text-align:left;"><b>8. Miscibility with water:-</b></td>
				</tr>
			</table>

			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:7px 0px;"><b><?php echo $row_select_pipe['ems6'];?></b></td>
					</tr>
				</tbody>
			</table>

			<br>
			<table align="center" width="100%" class="test" cellpadding="5px">
				<tr>
					<td width="10%" style=" border:none; text-align:left;"><b>9. Particle Charge (Positive/Negative):-</b></td>
				</tr>
			</table>
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:7px 0px;"><b><?php echo $row_select_pipe['ems7'];?></b></td>
					</tr>
				</tbody>
			</table>

			<br>
			<table align="center" width="100%" class="test" cellpadding="5px">
				<tr>
					<td width="10%" style=" border:none; text-align:left;"><b>10. Coagulation at low temperature:-</b></td>
				</tr>
			</table>
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;padding:7px 0px;"><b><?php echo $row_select_pipe['ems10'];?></b></td>
					</tr>
				</tbody>
			</table>
			<!-- Table Close -->


			<table align="center" width="100%" class="test1" style="" height="20%">
				<tbody>
					<tr style="font-size:15px;">
						<td>
							<div style="float:left;">
								<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br><br>
								<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br><br><br>
								<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewed By:</b>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<br><br>

			<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tbody>
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 00</center></td>
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
				<tr>
				<td style="padding-top: 0px; text-align: center;">Page 2 of 2</td>
				</tr>
				</tbody>
			</table>
		</page>
		
	</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
<script type="text/javascript">

</script>