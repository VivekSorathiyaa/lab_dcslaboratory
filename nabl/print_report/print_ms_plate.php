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
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from ms_plate WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
				$issue_date= $row_select2['issue_date'];$rec_sample_date= $row_select2['receive_date'];								
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
					$mark= $row_select4['brick_mark'];
					$brick_specification= $row_select4['brick_specification'];
					$material_location= $row_select4['material_location'];
				}
						
			
		?>
		
		<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - MECHANICAL PROPERTIES OF STRUCTURAL STEEL</td>
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
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Enrter Quantity :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_sample_qty'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Select Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_grade'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Enrter Name Of Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_source_name'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Dia (mm) :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_dia'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Brand :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_brand'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Mill Heat No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_heat'];?></td>
					</tr>
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>
		
		<table align="center" width="100%" class="test" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:2px solid;border-left:2px solid;">
			<tr>
				<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Sr No.</td>
				<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Type of Structural Steel*</td>
				<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Size</td>
				<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Weight</td>
				<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Yield Strength <br> (N/mm<sup>2</sup>)</td>
				<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Tensile Strength <br> (N/mm<sup>2</sup>)</td>
				<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Elongation %</td>
				<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Heat No</td>
			</tr>
			<?php
				$count = 1;
				$select_tiles_query = "select * from ms_plate WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
				$result_tiles_select = mysqli_query($conn, $select_tiles_query);
				if(mysqli_num_rows($result_tiles_select) > 0){
					while($row_select_pipe = mysqli_fetch_array($result_tiles_select)){
			?>
						<tr>
							<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $count; ?></td>
							<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['sample_type']; ?></td>
							<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['ms_grade']!="" && $row_select_pipe['ms_grade']!="0" && $row_select_pipe['ms_grade']!=null){echo $row_select_pipe['ms_grade']; }else{echo " <br>";}?></td>
							<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['weight1']!="" && $row_select_pipe['weight1']!="0" && $row_select_pipe['weight1']!=null){echo $row_select_pipe['weight1']; }else{echo " <br>";}?></td>
						
							<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['str1']!="" && $row_select_pipe['str1']!="0" && $row_select_pipe['str1']!=null){echo $row_select_pipe['str1']; }else{echo " <br>";}?></td>
							<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['ten1']!="" && $row_select_pipe['ten1']!="0" && $row_select_pipe['ten1']!=null){echo $row_select_pipe['ten1']; }else{echo " <br>";}?></td>
							<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['elo1']!="" && $row_select_pipe['elo1']!="0" && $row_select_pipe['elo1']!=null){echo $row_select_pipe['elo1']; }else{echo " <br>";}?></td>
							<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['heat_no']; ?></td>
						</tr>
			
			<?php $count++; } ?>
			            <tr>
							<td colspan=3 style="font-size:11px;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;text-align:left;">Method of test</td>
							<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS : 1786-2008</td>
							<td colspan=3 style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS:1608-2018</td>
							<td colspan=1 style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
						</tr>
					
			<?php	
				$count++;
				}
			?>
			
		</table>
		<!-- <table align="center" width="92%" class="test" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;margin-top:15px;">
			<tr style="border: 0px solid black;">
				<td colspan="5" style="border: 1px solid black;">&nbsp;</td>
			</tr>
			<tr>
				<td  style="width:10%;border: 1px solid black;text-align:center;font-weight:bold;">Sr No.</td>
				<td  style="width:20%;border: 1px solid black;text-align:center;font-weight:bold;">Dimension (mm)</td>
				<td  style="width:20%;border: 1px solid black;text-align:center;font-weight:bold;">Ultimate Tensile Strength (N/mm<sup>2</sup>)</td>
				<td  style="width:25%;border: 1px solid black;text-align:center;font-weight:bold;">Yield Stress (Proof Stress)N/mm<sup>2</sup></td>
				<td  style="width:25%;border: 1px solid black;text-align:center;font-weight:bold;">Elongation %</td>
			</tr>
			<?php
				$count = 1;
				$select_tiles_query = "select * from ms_plate WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
				$result_tiles_select = mysqli_query($conn, $select_tiles_query);
				if(mysqli_num_rows($result_tiles_select) > 0){
					while($row_select_pipe = mysqli_fetch_array($result_tiles_select)){
			?>
						<tr>
							<td  style="border: 1px solid black;text-align:center;"><?php echo $count; ?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['dia1']!="" && $row_select_pipe['dia1']!="0" && $row_select_pipe['dia1']!=null){echo $row_select_pipe['dia1']; }else{echo " <br>";}?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['ten1']!="" && $row_select_pipe['ten1']!="0" && $row_select_pipe['ten1']!=null){echo $row_select_pipe['ten1']; }else{echo " <br>";}?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['str1']!="" && $row_select_pipe['str1']!="0" && $row_select_pipe['str1']!=null){echo $row_select_pipe['str1']; }else{echo " <br>";}?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['elo1']!="" && $row_select_pipe['elo1']!="0" && $row_select_pipe['elo1']!=null){echo $row_select_pipe['elo1']; }else{echo " <br>";}?></td>
						</tr>
			
			<?php
					$count++;
					}
				}
				for($i=$count;$i<=10;$i++){
			?>
					<tr>
						<td  style="border: 1px solid black;text-align:center;"><?php echo $count; ?></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
					</tr>
			<?php	
				$count++;
				}
			?>
			
		</table> -->
		

			<tr>
                <td>
                    <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:11px;text-align:left;font-weight:bold;font-family:Times New Roman; border-left:2px solid;border-right:2px solid;">I.S. Requirement (I.S  2062-2011)</td>
                            </tr>
                    </table>
                </td>
            </tr>

			<?php $cnt = 1; ?>
			<tr>
                <td>
								<table align="top" width="100%" class="test" style="font-size:11px;font-family : Calibri; border-right:2px solid;border-left:2px solid;">             
           
										<tr>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Sr. No.</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Properties</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Requirements</b></td>
										</tr>
										
										<tr>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><?php echo $cnt++; ?></td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Yield Strength Minimum</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">250 N/mm<sup>2</sup></td>
										</tr>
										<tr>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><?php echo $cnt++; ?></td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Tensile Strength Minimum</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">410 N/mm<sup>2</sup></td>
										</tr>
										<tr>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><?php echo $cnt++; ?></td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Elongation % Minimum</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">23.00%</td>
										</tr>
								</table>
				</td>
            </tr>
		
			<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
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