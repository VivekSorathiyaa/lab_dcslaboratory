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
		<!-- <input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"> -->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Properties of Emulsion</b></td>
			</tr>

			<tr>
				<table align="center" width="95%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
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
					<table align="center" width="95%" cellspacing="0" cellpadding="0" class="test" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;">

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
							<td style="width:12%;padding-bottom: 4px;padding-top: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;text-align:left;padding-bottom: 4px;padding-top: 4px;"><?php echo $name_of_work; ?>
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
								<td style="width:12%;padding-bottom:14px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 14px;"><?php echo $r_name; ?></td>
							</tr>

						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="95%" cellspacing="0" cellpadding="0" class="test" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">
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
							<td style="width:40%;font-size: 11px;text-align:left;padding-bottom: 4px;">Emulsion (RS-1)</td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Specification Requireme</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;">BIS E887-2018</td>
						</tr>
						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Supplier</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 11px;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>
						
					</table>
				</td>
			</tr>
			
			<table align="center" width="95%" height="35%" class="test" style="font-size:13px;font-family: Cambria;border-top:1px solid;border-bottom:1px solid;border-right:1px solid;margin-top:15px;">
				<tr>
					<td style="width:8%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:11px 4px;">Sr. No.</td>
					<td style="width:50%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:11px 4px;">Name of Test</td>
					<td style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:11px 4px;">Test Method </td>								
					<td style="width:15%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:11px 4px;">Test Rcsults</td>								
					<td style="width:15%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:11px 4px;">Requirement as Per<br>IS 8887-2018</td>	
				</tr>
				<tr>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">1</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:left;padding:5px 4px;">&nbsp; Residue on 600 micron %</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 8887</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php if($row_select_pipe['ems8']!=""  && $row_select_pipe['ems8']!=null  && $row_select_pipe['ems8']!="0"){ echo $row_select_pipe['ems8'];}?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Max.0.05</td>
				</tr>
				<tr>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">2</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:left;padding:5px 4px;">&nbsp; Viscosity @ 50&deg;C Sec</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3117</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php if($row_select_pipe['ems1']!=""  && $row_select_pipe['ems1']!=null  && $row_select_pipe['ems1']!="0"){ echo $row_select_pipe['ems1'];}?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">20 - 100</td>
				</tr>
				<tr>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">3</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:left;padding:5px 4px;">&nbsp; Prticle Charge</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 8887</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php if($row_select_pipe['ems7']!=""  && $row_select_pipe['ems7']!=null  && $row_select_pipe['ems7']!="0"){ echo $row_select_pipe['ems7'];}?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Positive</td>
				</tr>
				<tr>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">4</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:left;padding:5px 4px;">&nbsp; Storage Stability after 24 hr. %</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 8887</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php if($row_select_pipe['ems9']!=""  && $row_select_pipe['ems9']!=null  && $row_select_pipe['ems9']!="0"){ echo $row_select_pipe['ems9'];}?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Max 2%</td>
				</tr>
				<tr>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">5</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:left;padding:5px 4px;">&nbsp; Miscibility with water</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 8887</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php if($row_select_pipe['ems6']!=""  && $row_select_pipe['ems6']!=null  && $row_select_pipe['ems6']!="0"){ echo $row_select_pipe['ems6'];}?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">No Coagulation</td>
				</tr>
				<tr>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">6</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:left;padding:5px 4px;">&nbsp; Residue by Evaporation at 163&deg; C %</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 8887</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php if($row_select_pipe['ems4']!=""  && $row_select_pipe['ems4']!=null  && $row_select_pipe['ems4']!="0"){ echo $row_select_pipe['ems4'];}?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Min . 60 %</td>
				</tr>
				<tr>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">7</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:left;padding:5px 4px;">&nbsp; Penetration</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 8887</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php if($row_select_pipe['ems2']!=""  && $row_select_pipe['ems2']!=null  && $row_select_pipe['ems2']!="0"){ echo $row_select_pipe['ems2'];}?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">80 - l.50</td>
				</tr>
				<tr>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">8</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:left;padding:5px 4px;">&nbsp; Ductility (cm)</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 8887</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php if($row_select_pipe['ems3']!=""  && $row_select_pipe['ems3']!=null  && $row_select_pipe['ems3']!="0"){ echo $row_select_pipe['ems3'];}?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Min.50</td>
				</tr>
				<tr>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">9</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:left;padding:5px 4px;">&nbsp; Solubility in Trichloroethylene %</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 8887</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php if($row_select_pipe['ems5']!=""  && $row_select_pipe['ems5']!=null  && $row_select_pipe['ems5']!="0"){ echo $row_select_pipe['ems5'];}?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Min.98 %</td>
				</tr>
				
			</table>
		</table>



		<table cellpadding="0" cellpadding="0" align="center" width="95%" style="font-size:11px;font-family: Cambria;" class="test">
			<tr>
				<td style="width:60%;text-align:center;font-weight:bold;padding:7px 0;">
						** End of Report ** 
				</td>																		
			</tr>
		</table>

	    <table align="center" width="95%" class="test">
		        <tr>
					<td style="text-align:center;font-size:11px;">
						<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
							<tr>
								<td><b>Note :-</b></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:11px;width:50%;padding:3px 0;"> 1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
								<td style="text-align:center;width:15%;font-style:italic;font-size:11px;"><b>Reviewed & Authorized By</b></td>
							</tr>
							<tr>
								<td style="font-size:11px;padding:3px 0;"> 2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:11px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:11px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
							</tr>
							<tr>
								<td style="font-size:11px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>Director/TM</b></td>
							</tr>
						</table>
					</td>
			    </tr>
		</table>

		<table width="95%" align="center" style="font-family:Cambria;font-size:11px;">
						<tr>
							<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
								Doc ID : FMT-TST-28/ Page 1/1
							</td>
						</tr>
		</table>

		</page>
		
	</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
<script type="text/javascript">

</script>