<?php 
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(0);?>
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
			$select_tiles_query = "select * from hard_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);
			$no_of_rows=mysqli_num_rows($result_tiles_select);
			 $page_cont = round_up($no_of_rows/7);
			
			$ans = mysqli_fetch_array($result_tiles_select);
				
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			
			$client_address= $row_select['clientaddress'];
			$r_name= $row_select['refno'];
			$r_date= $row_select['date'];
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
					include_once 'sample_id.php';
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
				}
		?>
	
<page size="A4">
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family:Times New Roman;margin-top:80px;border-bottom:0px solid black;">
            <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Properties of  Flexural Strength of Beam</b></td>
			</tr>


			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;"> 
						<?php //if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																//echo "ULR No.  " . $row_select_pipe['ulr'];  
															//} ?><?php echo "ULR No.  " . $_GET['ulr']; ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $job_no;?></td>
						<td style="width:0%;padding-bottom: 4px;;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align:center;"> &raquo;</td>
						<td style="width:40%padding-bottom: 4px;"><?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
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
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;">
                        <tr>
                            <td style="padding-top:10px;"></td>
                        </tr>
						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
								<td style="width:12%;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;"><?php echo $r_name; ?></td>
							</tr>

						<?php
						}
						?>
                         <tr>
                            <td style="padding-bottom:10px;"></td>
                        </tr>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $r_name;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Method</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;">ASTM D 2726s</td>
						</tr>

						<tr>
							<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {echo date('d/m/Y', strtotime($row_select["date"]));}?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Date of Test starting</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;">Material Received</td>
							<td style="width:6%;text-align: center;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;"><?php echo $mt_name; ?></td>
							<td style="width:21%;text-align:right;">Date of Test Completed</td>
							<td style="width:6%;text-align: center;"> &raquo;</td>
							<td style="width:40%;"><?php echo date('d/m/Y', strtotime($end_date)); ?></td>
						</tr>
						
					</table>
				</td>
			</tr>
		</table>
		<br>

		<table align="center" width="100%"  style="height:auto;font-size:13px;font-family : Calibri;">
			<tr>
				<!--OTHER START-->
				<td>
					<table align="center" width="100%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td width="10%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
					<td colspan="3" style="border: 1px solid black; text-align:center;"><b>Size of Specimen (mm)</b></td>
					<td width="20%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Distance of fracture from nearest roller in mm <br> (A)</b></td>
					<td width="10%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Load (kN) <br> (P)</b></td>
					<td width="10%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Beam Type)</b></td>
					<td width="10%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Modulus of rupture (N/mm<sup>2</sup>) </b></td>
					<td rowspan="2"style="border: 1px solid black; text-align:center;"><b>Average</b></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; text-align:center;"><b>B</b></td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><b>D</b></td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><b>L</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">1</b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['b1']!="" && $row_select_pipe['b1']!="0" && $row_select_pipe['b1']!=null){echo $row_select_pipe['b1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['d1']!="" && $row_select_pipe['d1']!="0" && $row_select_pipe['d1']!=null){echo $row_select_pipe['d1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['l1']!="" && $row_select_pipe['l1']!="0" && $row_select_pipe['l1']!=null){echo $row_select_pipe['l1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['len1']!="" && $row_select_pipe['len1']!="0" && $row_select_pipe['len1']!=null){echo $row_select_pipe['len1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['max1']!="" && $row_select_pipe['max1']!="0" && $row_select_pipe['max1']!=null){echo $row_select_pipe['max1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['pos1']!="" && $row_select_pipe['pos1']!="0" && $row_select_pipe['pos1']!=null){echo $row_select_pipe['pos1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['mod1']!="" && $row_select_pipe['mod1']!="0" && $row_select_pipe['mod1']!=null){echo $row_select_pipe['mod1']; }else{echo " <br>";}  ?></b></td>
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avg1']!="" && $row_select_pipe['avg1']!="0" && $row_select_pipe['avg1']!=null){echo $row_select_pipe['avg1']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">2</b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['b2']!="" && $row_select_pipe['b2']!="0" && $row_select_pipe['b2']!=null){echo $row_select_pipe['b2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['d2']!="" && $row_select_pipe['d2']!="0" && $row_select_pipe['d2']!=null){echo $row_select_pipe['d2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['l2']!="" && $row_select_pipe['l2']!="0" && $row_select_pipe['l2']!=null){echo $row_select_pipe['l2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['len2']!="" && $row_select_pipe['len2']!="0" && $row_select_pipe['len2']!=null){echo $row_select_pipe['len2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['max2']!="" && $row_select_pipe['max2']!="0" && $row_select_pipe['max2']!=null){echo $row_select_pipe['max2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['pos2']!="" && $row_select_pipe['pos2']!="0" && $row_select_pipe['pos2']!=null){echo $row_select_pipe['pos2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['mod2']!="" && $row_select_pipe['mod2']!="0" && $row_select_pipe['mod2']!=null){echo $row_select_pipe['mod2']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">3</b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['b3']!="" && $row_select_pipe['b3']!="0" && $row_select_pipe['b3']!=null){echo $row_select_pipe['b3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['d3']!="" && $row_select_pipe['d3']!="0" && $row_select_pipe['d3']!=null){echo $row_select_pipe['d3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['l3']!="" && $row_select_pipe['l3']!="0" && $row_select_pipe['l3']!=null){echo $row_select_pipe['l3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['len3']!="" && $row_select_pipe['len3']!="0" && $row_select_pipe['len3']!=null){echo $row_select_pipe['len3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['max3']!="" && $row_select_pipe['max3']!="0" && $row_select_pipe['max3']!=null){echo $row_select_pipe['max3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['pos3']!="" && $row_select_pipe['pos3']!="0" && $row_select_pipe['pos3']!=null){echo $row_select_pipe['pos3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['mod3']!="" && $row_select_pipe['mod3']!="0" && $row_select_pipe['mod3']!=null){echo $row_select_pipe['mod3']; }else{echo " <br>";}  ?></b></td>
				</tr>
		</table>


		<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family : Calibri;" class="test">
			<tr>
				<td style="width:60%;text-align:center;font-weight:bold;padding:7px 0;">
						** End of Report ** 
				</td>																		
			</tr>
		</table>

	    <table align="center" width="100%" class="test">
		        <tr>
					<td style="text-align:center;font-size:11px;">
						<table align="center" width="100%" class="test" style="height:auto;font-family : Calibri;border-top:1px solid black;border-bottom:1px solid black;">
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
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>(<?php echo naming($row_select['branch_short_code'],$conn);?>)</b></td>
							</tr>
							<tr>
								<td style="font-size:11px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b><?php echo degins($row_select['branch_short_code'],$conn);?></b></td>
							</tr>
						</table>
					</td>
			    </tr>
		</table>


		<table width="100%" align="center" style="font-family:Times New Roman;font-size:11px;">
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