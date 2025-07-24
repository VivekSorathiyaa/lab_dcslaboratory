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
					include_once 'sample_id.php';
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">TEST REPORT - PULVERIZED FUEL ASH</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
						<td style="width: 25%;padding: 0 2px;">&nbsp;Sample ID No :-</td>
						<td style="width: 34%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $sample_id; ?></td>
						<td style="text-align: left;border-left: 1px solid;">&nbsp;Report Date :-</td>
						<td style="padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
					</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="width: 25%;border-bottom: 1px solid;padding: 0 2px;">&nbsp;Report No :-</td>
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
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:25%;">&nbsp;Customer Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;width:34%;">&nbsp;<?php echo $clientname; ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:16%;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<?php
						}
						if ($client_address != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:25%;">&nbsp;Customer Address :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;width:34%;">&nbsp;<?php echo $client_address; ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<?php
						}
						if ($agency_name != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agency Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $agency_name; ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
						
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Consultants :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $source; ?></td>
					</tr>
					<?php
						 }
						if ($agreement_no != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agreement No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $agreement_no; ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
					</tr>
					
					<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 0px solid;text-align: left;width:4%;">&nbsp;Sample End Date </td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
						
					</tr>
					
					<tr>
						
					</tr>
					<tr>
						
					</tr>
					<tr>
						
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Project Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
						
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

			<?php $cnt = 1; ?>
			<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border-top:0px; border-bottom:0px;border-right:1px solid;border-left:1px solid;">
			
					<tr style="text-align:center;">
						<td rowspan='2' style="width:5%;border:1px solid black;border-right:0px solid;border-bottom:0px;border-top:0px;padding:5px 3px;"><b>Sr. No.</b></td>
						
						<td rowspan='2' style="width:15%;border:1px solid black;border-right:0px solid;border-bottom:0px;border-top:0px;padding:5px 3px;"><b>Test Method Ref.</b></td>
						<td rowspan='2' style="width:12%;border:1px solid black;border-right:0px solid;border-bottom:0px;border-top:0px;padding:5px 3px;"><b>Result Obtained</b></td>
						<td rowspan='2' style="width:40%;border:1px solid black;border-right:0px solid;border-bottom:0px;border-top:0px;padding:5px 3px;"><b>Test</b></td>
						
						<td colspan="2" style="width:25%;border:1px solid black;border-bottom:0px;padding:5px 3px;border-top:0px;"><b> Requirements As Per<br><?php if($row_select_pipe['com_test_req']!="" && $row_select_pipe['com_test_req']!=null && $row_select_pipe['com_test_req']!="0" && $row_select_pipe['com_test_req']!="undefined"){echo $row_select_pipe['com_test_req'];}else{?> IS 3812(Part-1):2013  <?php }?></b></td>
					</tr>
					<tr style="text-align:center;">
						<td style="border:1px solid black;border-bottom:0px;border-right:0px;padding:5px 3px;"><b>Siliceous Flyash</b></td>
						<td style="border:1px solid black;border-bottom:0px;padding:5px 3px;"><b>Calcareous Flyash</b></td>
						
					</tr>									
					
					
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php echo $cnt++;?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:left;"><b>&nbsp; 
						SiO<sub>2</sub> + Al<sub>2</sub>O<sub>3</sub> + Fe<sub>2</sub>O<sub>3</sub> %
						</b></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['com_test_method']);}else{?>IS 1727 : 1967<br><?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php echo number_format($row_select_pipe['per1'],2)." %";?></td>
						
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px"><?php if($row_select_pipe['com_test_limit_1']!="" && $row_select_pipe['com_test_limit_1']!=null && $row_select_pipe['com_test_limit_1']!="0" && $row_select_pipe['com_test_limit_1']!="undefined"){echo $row_select_pipe['com_test_limit_1'];}else{?>Min. 70<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe['com_test_limit_2']!="" && $row_select_pipe['com_test_limit_2']!=null && $row_select_pipe['com_test_limit_2']!="0" && $row_select_pipe['com_test_limit_2']!="undefined"){echo $row_select_pipe['com_test_limit_2'];}else{?>Min. 50<?php }?></td>
					</tr>
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php echo $cnt++;?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:left;"><b>&nbsp; Al<sub>2</sub>O<sub>3</sub> + Fe<sub>2</sub>O<sub>3</sub> %
						</b></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['com_test_method']);}else{?>IS 1727 : 1967<br><?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php echo number_format(($row_select_pipe['per1'] - $row_select_pipe['sio7']),2)." %";?></td>
						
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px">--</td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;">--</td>
					</tr>
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php echo $cnt++;?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:left;"><b>&nbsp; 
						Silicon Dioxide as SiO<sub>2</sub> %
						</b></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['sio_test_method']!="" && $row_select_pipe['sio_test_method']!=null && $row_select_pipe['sio_test_method']!="0" && $row_select_pipe['sio_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['sio_test_method']);}else{?>IS 1727 : 1967<br><?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php echo number_format($row_select_pipe['sio7'],2)." %";?></td>
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px"><?php if($row_select_pipe['sio_test_limit_1']!="" && $row_select_pipe['sio_test_limit_1']!=null && $row_select_pipe['sio_test_limit_1']!="0" && $row_select_pipe['sio_test_limit_1']!="undefined"){echo $row_select_pipe['sio_test_limit_1'];}else{?>Min. 35<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe['sio_test_limit_2']!="" && $row_select_pipe['sio_test_limit_2']!=null && $row_select_pipe['sio_test_limit_2']!="0" && $row_select_pipe['sio_test_limit_2']!="undefined"){echo $row_select_pipe['sio_test_limit_2'];}else{?>Min. 25<?php }?></td>
						
					</tr>
					
					
					
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php echo $cnt++;?></td>
						<td style="border:1px solid black;text-align:left;border-right:0px solid;border-bottom:0px;"><b>&nbsp; Magnesium oxide (Mgo) %</b></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['mang_test_method']!="" && $row_select_pipe['mang_test_method']!=null && $row_select_pipe['mang_test_method']!="0" && $row_select_pipe['mang_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['mang_test_method']);}else{?>IS 1727 : 1967<br><?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php if($row_select_pipe['mgo4']=="" && $row_select_pipe['mgo4']==null && $row_select_pipe['mgo4']=="0"){
						echo "-";}else{echo number_format($row_select_pipe['mgo4'],2)." %";}?></td>	
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px"><?php if($row_select_pipe['mang_test_limit_1']!="" && $row_select_pipe['mang_test_limit_1']!=null && $row_select_pipe['mang_test_limit_1']!="0" && $row_select_pipe['mang_test_limit_1']!="undefined"){echo $row_select_pipe['mang_test_limit_1'];}else{?>Max. 5.0<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe['mang_test_limit_2']!="" && $row_select_pipe['mang_test_limit_2']!=null && $row_select_pipe['mang_test_limit_2']!="0" && $row_select_pipe['mang_test_limit_2']!="undefined"){echo $row_select_pipe['mang_test_limit_2'];}else{?>Max. 5.0<?php }?></td>
						
						
					</tr>
					
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php echo $cnt++;?></td>
						<td style="border:1px solid black;text-align:left;border-right:0px solid;border-bottom:0px;"><b>&nbsp; Total sulphur as sulphur trioxide (SO<sub>3</sub>) %</b></td>
						
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['tot_test_method']!="" && $row_select_pipe['tot_test_method']!=null && $row_select_pipe['tot_test_method']!="0" && $row_select_pipe['tot_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['tot_test_method']);}else{?>IS 1727 : 1967<br><?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php if($row_select_pipe['so4']=="" && $row_select_pipe['so4']==null && $row_select_pipe['so4']=="0"){
						echo "-";}else{echo number_format($row_select_pipe['so4'],2)." %";}?></td>										
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px"><?php if($row_select_pipe['tot_test_limit_1']!="" && $row_select_pipe['tot_test_limit_1']!=null && $row_select_pipe['tot_test_limit_1']!="0" && $row_select_pipe['tot_test_limit_1']!="undefined"){echo $row_select_pipe['tot_test_limit_1'];}else{?>Max. 3.0<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe['tot_test_limit_2']!="" && $row_select_pipe['tot_test_limit_2']!=null && $row_select_pipe['tot_test_limit_2']!="0" && $row_select_pipe['tot_test_limit_2']!="undefined"){echo $row_select_pipe['tot_test_limit_2'];}else{?>Max. 3.0<?php }?></td>
					</tr>
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php echo $cnt++;?></td>
						<td style="border:1px solid black;text-align:left;border-right:0px solid;border-bottom:0px;"><b>&nbsp; Available Alkali's Na<sub>2</sub>O %</b></td>
						
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;text-align:center;"><?php if($row_select_pipe['alk_test_method']!="" && $row_select_pipe['alk_test_method']!=null && $row_select_pipe['alk_test_method']!="0" && $row_select_pipe['alk_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['alk_test_method']);}else{?>IS 3812:2013 - P-1 <br> <?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-bottom:0px;"><?php if($row_select_pipe['alk2']=="" && $row_select_pipe['alk2']==null && $row_select_pipe['alk2']=="0"){
						echo "-";}else{echo number_format($row_select_pipe['alk2'],2)." %";}?></td>										
						
						<td style="text-align:center;border:1px solid black;border-bottom:0px;border-right:0px"><?php if($row_select_pipe['alk_test_limit_1']!="" && $row_select_pipe['alk_test_limit_1']!=null && $row_select_pipe['alk_test_limit_1']!="0" && $row_select_pipe['alk_test_limit_1']!="undefined"){echo $row_select_pipe['alk_test_limit_1'];}else{?>Max. 1.5<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-bottom:0px;"><?php if($row_select_pipe['alk_test_limit_2']!="" && $row_select_pipe['alk_test_limit_2']!=null && $row_select_pipe['alk_test_limit_2']!="0" && $row_select_pipe['alk_test_limit_2']!="undefined"){echo $row_select_pipe['alk_test_limit_2'];}else{?>Max. 1.5<?php }?></td>
						
					</tr>
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;text-align:center;"><?php echo $cnt++;?></td>
						<td style="border:1px solid black;text-align:left;border-right:0px solid;">&nbsp; 
						<b>Total Chlorides %</b>
						</td>
						<td style="border:1px solid black;border-right:0px solid;text-align:center;"><?php if($row_select_pipe['chl_test_method']!="" && $row_select_pipe['chl_test_method']!=null && $row_select_pipe['chl_test_method']!="0" && $row_select_pipe['chl_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['chl_test_method']);}else{?>IS 4032 : 1985<br><?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;"><?php echo number_format($row_select_pipe['cl6'],3)." %";?></td>
						
						<td style="text-align:center;border:1px solid black;border-right:0px"><?php if($row_select_pipe['chl_test_limit_1']!="" && $row_select_pipe['chl_test_limit_1']!=null && $row_select_pipe['chl_test_limit_1']!="0" && $row_select_pipe['chl_test_limit_1']!="undefined"){echo $row_select_pipe['chl_test_limit_1'];}else{?>Max. 0.05<?php }?></td>
						<td style="text-align:center;border:1px solid black;"><?php if($row_select_pipe['chl_test_limit_2']!="" && $row_select_pipe['chl_test_limit_2']!=null && $row_select_pipe['chl_test_limit_2']!="0" && $row_select_pipe['chl_test_limit_2']!="undefined"){echo $row_select_pipe['chl_test_limit_2'];}else{?>Max. 0.05<?php }?></td>
					
						
					</tr>
					<tr style="text-align:center;height:25px;">
						<td style="border:1px solid black;border-right:0px solid;text-align:center;border-top:0px"><?php echo $cnt++;?></td>
						<td style="border:1px solid black;text-align:left;border-right:0px solid;border-top:0px">
						<b>&nbsp; Total loss on ignition, %</b>
						</td>
						<td style="border:1px solid black;border-right:0px solid;text-align:center;border-top:0px"><?php if($row_select_pipe['los_test_method']!="" && $row_select_pipe['los_test_method']!=null && $row_select_pipe['los_test_method']!="0" && $row_select_pipe['los_test_method']!="undefined"){echo str_replace(" (","<br />(",$row_select_pipe['los_test_method']);}else{?>IS 1727 : 1967<br><?php }?></td>
						<td style="border:1px solid black;border-right:0px solid;border-top:0px"><?php echo number_format($row_select_pipe['ig4'],2)." %";?></td>
						
						<td style="text-align:center;border:1px solid black;border-top:0px;border-right:0px"><?php if($row_select_pipe['los_test_limit_1']!="" && $row_select_pipe['los_test_limit_1']!=null && $row_select_pipe['los_test_limit_1']!="0" && $row_select_pipe['los_test_limit_1']!="undefined"){echo $row_select_pipe['los_test_limit_1'];}else{?>Max. 5.0<?php }?></td>
						<td style="text-align:center;border:1px solid black;border-top:0px"><?php if($row_select_pipe['los_test_limit_2']!="" && $row_select_pipe['los_test_limit_2']!=null && $row_select_pipe['los_test_limit_2']!="0" && $row_select_pipe['los_test_limit_2']!="undefined"){echo $row_select_pipe['los_test_limit_2'];}else{?>Max. 5.0<?php }?></td>
					</tr>
					
			</table>
		
			
			
		
		
		<!-- footer design -->
		
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
						<tr>
							<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
							<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;text-transform: uppercase;font-weight: bold;">Report Issue By:- GEO RESEARCH HOUSE, INDORE.</td>
						</tr>
						<tr>
							<td colspan="2"  style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr style="vertical-align: bottom;">
							<td colspan="2" style="padding: 1px 2px;height: 45px;">{Mr. Chitrath Purani}</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">Report Reviewed <BR>  Name & Sign </td>
							<td style="padding: 1px 2px;font-weight: bold;text-align: right;">Authorized by <BR> Technical Manager (Name & Sign)</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">1. The Samples have been Submitted to us by the Customer.</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">2. The above given Results Refer only to the sample submitted by the customer for testing.</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">3. All the information is Provided to us by the Customer and can affect the Result Validity.</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">4. This Report shall not be Reproduced without Approval of the Laboratory.</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">5. * As Informed by Client.</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 1 of 1</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>
			
		</page>
		
		<!--<page size="A4">
		<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()">
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;margin-left:35px; ">
		<tr>
				<td  style="text-align:center; font-size:20px; "><b>TEST REPORT</b></td>
		</tr>
		</table>
		<table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black;margin-left:35px;border-bottom: 0px solid black;">
			
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
		<table align="center" width="92%"  class="test" style="border:1px solid black;font-family : Calibri;margin-left:35px; " >
			<tr>
				<td width="60px"><b style="">&nbsp; NOTE:- </b> </td>
				<td><p style="align:justify">[1]Test result related to sample collected by supplier. [2]Results/Report is issued with specific understanding the SMTL will not in any case be involved in action following the interpretation of test results. [3]The Reports/Results are not supposed to be used for publicity.  (4) This report can not be reproduced in full or part without written approval of Quality Manager/ Technical Manager.</p></td>
			</tr>
			<tr>				
				<td colspan="2" style="border:0px solid black;border-bottom:0px solid black;"><input Style="width:100%; border:none; font-weight:bold;" type="text" value="<?php echo $row_select_pipe['rem_data'];?>"></td>
			</tr>
		</table>
		<table align="center" width="92%" style="font-family : Calibri;margin-left:35px; ">
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
		
		
		<table align="center" width="92%" style="font-family : Calibri;margin-left:35px;margin-top:30px ">
			<tr>
				<td style="font-size:11px;">F/FC/01/TR,Issue No.01 <br> W.e.f. 01.11.2012 </td>
				<td style="text-align:center">&#8226;&#8226; End of Report &#8226;&#8226;</td>
				<td style="text-align:right; font-size:11px;">Page No. 1 of 1</td>
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