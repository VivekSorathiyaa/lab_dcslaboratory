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
			$select_tiles_query = "select * from solid_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe1	 = mysqli_fetch_array($result_tiles_select);
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
				$letter_date= $row_select2['letter_date'];								
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
					$cc_grade= $row_select4['cc_grade'];
					$cc_set_of_cube= $row_select4['cc_set_of_cube'];
					$cc_no_of_cube= $row_select4['cc_no_of_cube'];
					$cc_identification_mark= $row_select4['cc_identification_mark'];
					$day_remark= $row_select4['day_remark'];
					$casting_date= $row_select4['casting_date'];
					$material_location= $row_select4['material_location'];
				}
				
		?>
		
		<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - HOLLOW & SOLID CONCRETE BLOCK</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
						<td style="width: 14%;padding: 0 2px;">&nbsp;Sample ID No :-</td>
						<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $sample_id; ?></td>
						<td style="text-align: left;border-left: 1px solid;">&nbsp;Report Date :-</td>
						<td style="padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
					</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Report No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;ULR No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $_GET['ulr']; ?></td>
					</tr>
					<!--STATIC AMENDMENT NO AND DATE-->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;--</td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Group :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Building Materials</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp; <?php echo date('d/m/Y', strtotime($row_select_pipe["amend_date"])); ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Discipline :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Mechanical</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part -->
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width: 24.9%;">&nbsp;Customer Name & Address :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
					</tr>
					<?php
						}
						if ($agency_name != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agency Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
					</tr>
					<?php } 
					if ($row_select['tpi_name'] != "") {
						?>
							
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Consultants :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
					</tr>
					<?php
						 }
						if ($agreement_no != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agreement No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
					</tr>
					<?php
						}
						if ($name_of_work != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Project Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;">&nbsp;To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<!-- <tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php //echo $source; ?></td>
					</tr> -->
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>
		
		<table align="center" width="100%"  class="test" style="height:Auto;font-size:12px;border-left:2px solid; border-right:2px solid;" >
				<tr style="text-align:center;">
					<td  style="border:1px solid black;border-top:0px solid black;width:2%;padding:7px 3px;"><b>Sr.<br>No.</b></td>
					<td  style="border:1px solid black;border-top:0px solid black;width:30%;"><b>Test Parameter</b></td>
					<td  style="border:1px solid black;border-top:0px solid black;width:13%;"><b>Unit</b></td>
					<td  style="border:1px solid black;border-top:0px solid black;width:13%;"><b>Test Method</b></td>
					<td  style="border:1px solid black;border-top:0px solid black;width:13%;"><b>Test Result</b></td>
					<td  style="border:1px solid black;border-top:0px solid black;width:8%;"><b>Specification as per IS <br>2185(Pt-1):2005  </b></td>
				</tr>
				<tr>
					<td  style="border:1px solid black; text-align:center;padding:7px 3px;"><b>1</b></td>
					<td colspan="5" style="border:1px solid black;"><b>&nbsp; Dimention</b></td>
				</tr>
				<tr style="text-align:center;">
					<td rowspan="3" style="border:1px solid black; text-align:center;"> &nbsp; </td>
					<td  style="border:1px solid black; text-align:left;padding:7px 3px;">&nbsp; Length</td>
					<td  rowspan="3" style="border:1px solid black; text-align:center;">mm</td>
					<td  rowspan="3" style="border:1px solid black; text-align:center;">IS 2185(Pt-1):2005, Annexure B  </td>
					<td  style="border:1px solid black; text-align:center;"><?php if($row_select_pipe1['avg_length']!="" && $row_select_pipe1['avg_length']!="0" && $row_select_pipe1['avg_length']!=null){echo $row_select_pipe1['avg_length']; }else{echo " <br>";}  ?></td>
					<td  style="border:1px solid black; text-align:center;"> + 5</td>
				</tr>
				<tr style="text-align:center;">
					<td  style="border:1px solid black; text-align:left;padding:7px 3px;">&nbsp; Width</td>
					<td  style="border:1px solid black; text-align:center;"><?php if($row_select_pipe1['avg_width']!="" && $row_select_pipe1['avg_width']!="0" && $row_select_pipe1['avg_width']!=null){echo $row_select_pipe1['avg_width']; }else{echo " <br>";}  ?></td>
					<td  style="border:1px solid black; text-align:center;"> + 3 </td>
				</tr>
				<tr style="text-align:center;">
					<td  style="border:1px solid black; text-align:left;padding:7px 3px;">&nbsp; Height</td>
					<td  style="border:1px solid black; text-align:center;"><?php if($row_select_pipe1['avg_height']!="" && $row_select_pipe1['avg_height']!="0" && $row_select_pipe1['avg_height']!=null){echo $row_select_pipe1['avg_height']; }else{echo " <br>";}  ?></td>
					<td  style="border:1px solid black; text-align:center;"> + 3</td>
				</tr>
				<tr>
					<td  style="border:1px solid black; text-align:center;"><b>2</b></td>
					<td colspan="5" style="border:1px solid black;padding:7px 3px;"><b>&nbsp; Compressve Strength</b></td>
				</tr>
				<tr style="text-align:center;">
					<td rowspan="2" style="border:1px solid black; text-align:center;"> &nbsp; </td>
					<td  style="border:1px solid black; text-align:left;padding:7px 3px;">&nbsp; Average Compressive Strength of 8 blocks</td>
					<td  rowspan="2" style="border:1px solid black; text-align:center;">N/mm<sup>2</sup></td>
					<td  rowspan="2" style="border:1px solid black; text-align:center;">IS 2185(Pt-1):2005, Annexure D  </td>
					<td  style="border:1px solid black; text-align:center;"><?php if($row_select_pipe1['avg_str']!="" && $row_select_pipe1['avg_str']!="0" && $row_select_pipe1['avg_str']!=null){echo $row_select_pipe1['avg_str']; }else{echo " <br>";}  ?></td>
					<td  style="border:1px solid black; text-align:center;"> Grade 4.0 C (4.0), 5.0 C (5.0) Min.</td>
				</tr>
				<tr style="text-align:center;">
					<td  style="border:1px solid black; text-align:left;padding:7px 3px;">&nbsp; Individual Minimum Compressive strength</td>
					<td  style="border:1px solid black; text-align:center;"><?php if($row_select_pipe1['avg_str']!="" && $row_select_pipe1['avg_str']!="0" && $row_select_pipe1['avg_str']!=null){echo $row_select_pipe1['avg_str']; }else{echo " <br>";}  ?></td>
					<td  style="border:1px solid black; text-align:center;"> 3.2 C (4.0), 4.0 C(5.0) Min.</td>
				</tr>
				<tr style="text-align:center;">
					<td  style="border:1px solid black;padding:7px 3px;"><b>3</b></td>
					<td  style="border:1px solid black; text-align:left;"><b>&nbsp; Water Absorption (Average of 3 Blocks)</b></td>
					<td  style="border:1px solid black;">%</td>
					<td  style="border:1px solid black;">IS 2185(Pt-1):2005, Annexure E</b></td>
					<td  style="border:1px solid black;"><?php if($row_select_pipe1['avg_wtr']!="" && $row_select_pipe1['avg_wtr']!="0" && $row_select_pipe1['avg_wtr']!=null){echo $row_select_pipe1['avg_wtr']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black;">10 Max.</td>
				</tr>
				<tr style="text-align:center;">
					<td  style="border:1px solid black;border-bottom:0px;padding:7px 3px;"><b>4</b></td>
					<td  style="border:1px solid black;border-bottom:0px; text-align:left;"><b>&nbsp; Block Density (Average of 3 Blocks)</b></td>
					<td  style="border:1px solid black;border-bottom:0px;">Kg/m<sup>2</sup></td>
					<td  style="border:1px solid black;border-bottom:0px;">IS 2185(Pt-1):2005, Annexure C</td>
					<td  style="border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe1['avg_den']!="" && $row_select_pipe1['avg_den']!="0" && $row_select_pipe1['avg_den']!=null){echo $row_select_pipe1['avg_den']; }else{echo " <br>";}  ?></td>
					<td  style="border:1px solid black;border-bottom:0px;">1800 Min.</td>
				</tr>
				
		</table>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;">
					<tr>
						<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
					</tr>
					<tr>
						<td style="padding: 1px 2px;text-transform: uppercase;font-weight: bold;">Report Issue By:- GEO RESEARCH HOUSE, INDORE.</td>
					</tr>
					<tr>
						<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
					</tr>
					<tr style="vertical-align: bottom;">
						<td style="padding: 1px 2px;height: 45px;">{Mr. Chitrath Purani}</td>
					</tr>
					<tr>
						<td style="padding: 1px 2px;font-weight: bold;">Report Reviewed & Authorized by :-</td>
					</tr>
					<tr>
						<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
					</tr>
					<tr>
						<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
					</tr>
					<tr>
						<td style="padding: 1px 2px;font-weight: bold;">1. The Samples have been Submitted to us by the Customer.</td>
					</tr>
					<tr>
						<td style="padding: 1px 2px;font-weight: bold;">2. The above given Results Refer only to the sample submitted by the customer for testing.</td>
					</tr>
					<tr>
						<td style="padding: 1px 2px;font-weight: bold;">3. All the information is Provided to us by the Customer and can affect the Result Validity.</td>
					</tr>
					<tr>
						<td style="padding: 1px 2px;font-weight: bold;">4. This Report shall not be Reproduced without Approval of the Laboratory.</td>
					</tr>
					<tr>
						<td style="padding: 1px 2px;font-weight: bold;">5. * As Informed by Client.</td>
					</tr>
					<tr>
						<td style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 1 of 1</td>
					</tr>
					<tr>
						<td style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
					</tr>
				</table>
			</td>
			</tr>

		</table>

		
		
			
		</page>
		<?php
			
			if($flag==8)
				{
					$flag=0;
					$down=$up;
					$up +=8;
					?>
					
		
		
					<div class="pagebreak"> </div>
			<?php }
			
			
			
		?>
		
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