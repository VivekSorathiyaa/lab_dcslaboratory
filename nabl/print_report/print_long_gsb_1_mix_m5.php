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
	 font-family: Book Antiqua;
	
}
.test {
    border-collapse: collapse;
 font-size:12px;
	 font-family: Book Antiqua;
}
	.tdclass1{
    
    font-size:12px;
	 font-family: Book Antiqua;
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
<head>
    <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
    <script src="Chart1.js"></script>
</head>
<html>
	<body>
			<?php
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$tbl = $_GET['tbl_name'];
			$select_tiles_query = "select * from $tbl WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
					if(strpos($row_select3["mt_name"],"WMM (MIX MATERIAL)") !== false || 
							strpos($row_select3["mt_name"],"GSB - I MIX (M4-1)") !== false || 
							strpos($row_select3["mt_name"],"GSB - II MIX (M4-2)") !== false || 
							strpos($row_select3["mt_name"],"GSB - III MIX (M4-1)") !== false || 
							strpos($row_select3["mt_name"],"GSB - IV MIX (M5)") !== false || 
							strpos($row_select3["mt_name"],"GSB - V MIX (M5)") !== false || 
							strpos($row_select3["mt_name"],"GSB - VI MIX (M5)") !== false || 
							strpos($row_select3["mt_name"],"GSB - I MIX (M5)") !== false || 
							strpos($row_select3["mt_name"],"GSB - III MIX (M5)") !== false || 
							strpos($row_select3["mt_name"],"GSB - II MIX (M5)") !== false || 
							strpos($row_select3["mt_name"],"GSB - I MIX (M4-2)") !== false || 
							strpos($row_select3["mt_name"],"GSB - II MIX (M4-1)") !== false || 
							strpos($row_select3["mt_name"],"GSB - III MIX (M4-2)") !== false || 
							strpos($row_select3["mt_name"],"MSS - A (MIX MATERIAL)") !== false || 
							strpos($row_select3["mt_name"],"MSS - B (MIX MATERIAL)") !== false || 
							strpos($row_select3["mt_name"],"BUSG - CA") !== false || 
							strpos($row_select3["mt_name"],"BUSG - KA") !== false || 
							strpos($row_select3["mt_name"],"BM - 2 (MIX MATERIAL)") !== false|| 
							strpos($row_select3["mt_name"],"BM - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_select3["mt_name"],"BC - 2 (MIX MATERIAL)") !== false|| 
							strpos($row_select3["mt_name"],"BC - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_select3["mt_name"],"DBM - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_select3["mt_name"],"DBM - 2 (MIX MATERIAL)") !== false|| 
							strpos($row_select3["mt_name"],"SDBC - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_select3["mt_name"],"Seal Coat") !== false|| 
							strpos($row_select3["mt_name"],"Premix Carpet") !== false|| 
							strpos($row_select3["mt_name"],"BUSG - KA") !== false|| 
							strpos($row_select3["mt_name"],"BUSG - CA") !== false|| 
							strpos($row_select3["mt_name"],"SDBC - 2 (MIX MATERIAL)") !== false)
							{
									$mt_name= $row_select3['mt_name'];
									
							}
							else
							{
									$ans = substr($row_select3["mt_name"],strpos($row_select3["mt_name"],"(") + 1);
									$explodeing = explode(")",$ans);
									$mt_name = $explodeing[0];																	
							}
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$source= $row_select4['sample_de'];
					$identification= $row_select4['agg_source'];
					$material_location= $row_select4['material_location'];
				}
				
	if($tbl == "gsb_mix_1_m5"){
		$ll_1 =  "100";
		$ll_2 =  "80";
		$ll_3 =  "55";
		$ll_4 =  "35";
		$ll_5 =  "25";
		$ll_6 =  "20";
		$ll_7 =  "10";
		$ll_8 =  "0";
		
		$ul_1 = "100";
		$ul_2 = "100";
		$ul_3 = "90";
		$ul_4 = "65";
		$ul_5 = "55";
		$ul_6 = "40";
		$ul_7 = "15";
		$ul_8 = "5";
	}
	
	if($tbl == "gsb_mix_2_m5"){
		$ll_1 = "100";
		$ll_2 = "70";
		$ll_3 = "50";
		$ll_4 = "40";
		$ll_5 = "30";
		$ll_6 = "10";
		$ll_7 = "0";
		
		$ul_1 = "100";
		$ul_2 = "100";
		$ul_3 = "80";
		$ul_4 = "65";
		$ul_5 = "50";
		$ul_6 = "15";
		$ul_7 = "5";
	}
	
	if($tbl == "gsb_mix_3_m5"){
		$ll_1 = "100";
		$ll_2 = "55";
		$ll_3 = "10";
		$ll_4 = "0";
		
		$ul_1 = "100";
		$ul_2 = "75";
		$ul_3 = "30";
		$ul_4 = "5";
	}
	
	if($tbl == "gsb_mix_4_m5"){
		$ll_1 = "100";
		$ll_2 = "50";
		$ll_3 = "15";
		$ll_4 = "0";
		
		$ul_1 = "100";
		$ul_2 = "100";
		$ul_3 = "35";
		$ul_4 = "5";
	}
	
	if($tbl == "gsb_mix_5_m5"){
		
		$ll_1 = "100";
		$ll_2 = "80";
		$ll_3 = "55";
		$ll_4 = "35";
		$ll_5 = "25";
		$ll_6 = "20";
		$ll_7 = "10";
		$ll_8 = "0";
		
		$ul_1 = "100";
		$ul_2 = "100";
		$ul_3 = "90";
		$ul_4 = "65";
		$ul_5 = "55";
		$ul_6 = "40";
		$ul_7 = "15";
		$ul_8 = "5";
	}
	
	if($tbl == "gsb_mix_6_m5"){
		$ll_1 = "100";
		$ll_2 = "75";
		$ll_3 = "55";
		$ll_4 = "30";
		$ll_5 = "10";
		$ll_6 = "0";
		$ll_7 = "0";
		
		$ul_1 = "100";
		$ul_2 = "100";
		$ul_3 = "75";
		$ul_4 = "55";
		$ul_5 = "25";
		$ul_6 = "8";
		$ul_7 = "3";
	}
						
			
		?>
		
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
			<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
						<tr>
							<td style="width:40%;padding: 0 2px;text-align: left;">&nbsp;<?php echo $report_no; ?></td>
							
							<td style="width:30%;padding: 0 2px;text-align: left;">&nbsp;<?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
							<td style="width:30%;padding: 0 2px;text-align: right;">&nbsp;Page 1 of 1</td>
						</tr>
						<tr>
							<td style="padding: 0 2px;text-align: left;border-top:1px solid;" colspan="2">&nbsp;Prepared by : Technical Manager</td>
							<td style="padding: 0 2px;text-align: right;border-top:1px solid;">&nbsp;Approved by : Quality Manager</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 54.5%;padding: 0 2px;text-align: right;">&nbsp;Group:- Building Materials</td>
							<td style="padding: 0 2px;width:45%;text-align: right;">&nbsp;Date:<?php echo date('d/m/Y', strtotime($issue_date));?></td>
						</tr>
						
				</table>
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 50%;padding: 0 2px;text-align: center;">&nbsp;Discipline:- Mechanical</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF GSB
						</td>
					</tr>
				</table>
				<br>	
				<br>	
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border: 1px solid;">
    <?php if ($name_of_work != "") { ?>
	<tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Work </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $name_of_work;?></td>
    </tr>
	<?php }if ($agency_name != "") { ?>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Agency </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $agency_name;?></td>
    </tr>
	<?php }?>
	<tr>
		<?php
					if ($row_select['tpi_name'] != "") {
						?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Consultant </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $row_select['tpi_name']; ?></td>
					<?php } if ($agreement_no != "") {?>
		<td style="padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agreement No</td>
		<td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $agreement_no; ?></td>
					<?php }?>
	</tr>    
	
    <tr>
		<?php
						if ($clientname != "") {
						?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Client </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $clientname;?></td>
						<?php }?>
    </tr>   
    <tr>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Receipt Sample </td>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
        <td style="text-align: left;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $r_name; ?>&nbsp;&nbsp;<?php
            if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
            ?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
            } else {
            }
        ?></td>
    </tr>
    
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Test Performed </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b>From</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
        <td style="padding:2px;text-align: center;">&nbsp;To</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
        <td style="padding:2px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;Date <b>&nbsp; : &nbsp;</b> <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Enviromental Condition </td>
        <td style="padding:2px;text-align: left;font-weight:bold;" colspan="2"><b>&nbsp; : &nbsp;</b>Temperature</td>
        <td style="padding:2px;text-align: center;"><b>&nbsp; : &nbsp;</b>27˚± 2 ˚c</td>
        <td style="padding:2px;text-align: center;"><b></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Location</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php if ($material_location == 1) {echo "In Laboratory";} else {echo "In Field";} ?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $source; ?></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
</table>
	<br>
	<table class="bg_light" align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;background-color: #eeeeee;font-family: Arial;border: 1px solid black; padding: 2px;margin-bottom: 4px;">
		<tr>
			<td style="text-align:center; font-size:15px; text-transform: uppercase;"colspan="4"><b>PHYSICAL TEST</b></td>
		</tr>
	</table>
	
	<br>
	
	<table class="bg_light" align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border: 1px solid black; padding: 2px;margin-bottom: 4px;">
		<tr>
			<td style="text-align:center;font-size:15px;text-transform:uppercase;"><b>MAXIMUM DRY DENSITY / OPTIMUM MOISTURE CONTENT.</b></td>
		</tr>
	</table>

		<table align="center" width="92%" style="border: 0px solid black;font-size:11px;font-family: Arial;">
	
							<table align="center" width="92%"  class="test" >
							
									<tr style="text-align:left;">
										<td style="border:1px solid black;" colspan="11"><b>Test Method &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp; IS 2720 (Part 8):1983 RA 2015.</b></td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"colspan="2" >Wt. of mould (gm) =  </td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_mould_1']?></td>
										<td style="border:0 solid"colspan="4"></td>
										<td style="border:1px solid black;"colspan="2">volume of mould(cc)=</td>
										<td style="border:1px solid black;">2250</td>
										<td></td>										
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;">Sl. No.</td>
										<td style="border:1px solid black;">wt of mould +compacted sample    (gm)</td>
										<td style="border:1px solid black;">wet density of sample (gm/cc)</td>
										<td style="border:1px solid black;">Tare   No.</td>
										<td style="border:1px solid black;">Wt. of tare.   (gm)</td>
										<td style="border:1px solid black;">wt of tare+wet sample (gm)</td>
										<td style="border:1px solid black;">wt of tare+dry sample (gm)</td>
										<td style="border:1px solid black;">wt of moisture (gm)</td>
										<td style="border:1px solid black;">wt of dry sample (gm)</td>
										<td style="border:1px solid black;">%of moistutre content</td>
										<td style="border:1px solid black;">dry density of sample (gm/cc)</td>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;">1</td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_sample_1']?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['weight_sample_1'] - $row_select_pipe['weight_mould_1']) / 2250,3);?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['mdd_tare_1']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_con_1']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['sam_con_1']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['sam_dry_1']?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['sam_con_1'] - $row_select_pipe['sam_dry_1']),2)?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['sam_dry_1'] - $row_select_pipe['weight_con_1']),2)?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['dry_mc_1']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['dry_den_1']?></td>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;">2</td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_sample_2']?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['weight_sample_2'] - $row_select_pipe['weight_mould_1']) / 2250,3);?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['mdd_tare_2']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_con_2']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['sam_con_2']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['sam_dry_2']?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['sam_con_2'] - $row_select_pipe['sam_dry_2']),2)?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['sam_dry_2'] - $row_select_pipe['weight_con_2']),2)?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['dry_mc_2']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['dry_den_2']?></td>
																				
									</tr>
									
									<tr style="text-align:center;">
										<td style="border:1px solid black;">3</td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_sample_3']?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['weight_sample_3'] - $row_select_pipe['weight_mould_1']) / 2250,3);?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['mdd_tare_3']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_con_3']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['sam_con_3']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['sam_dry_3']?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['sam_con_3'] - $row_select_pipe['sam_dry_3']),2)?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['sam_dry_3'] - $row_select_pipe['weight_con_3']),2)?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['dry_mc_3']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['dry_den_3']?></td>
																				
									</tr>
									
									<tr style="text-align:center;">
										<td style="border:1px solid black;">4</td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_sample_4']?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['weight_sample_4'] - $row_select_pipe['weight_mould_1']) / 2250,3);?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['mdd_tare_4']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_con_4']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['sam_con_4']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['sam_dry_4']?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['sam_con_4'] - $row_select_pipe['sam_dry_4']),2)?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['sam_dry_4'] - $row_select_pipe['weight_con_4']),2)?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['dry_mc_4']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['dry_den_4']?></td>
																				
									</tr>
									
									<tr style="text-align:center;">
										<td style="border:1px solid black;">5</td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_sample_5']?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['weight_sample_5'] - $row_select_pipe['weight_mould_1']) / 2250,3);?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['mdd_tare_5']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['weight_con_5']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['sam_con_5']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['sam_dry_5']?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['sam_con_5'] - $row_select_pipe['sam_dry_5']),2)?></td>
										<td style="border:1px solid black;"><?php echo number_format(($row_select_pipe['sam_dry_5'] - $row_select_pipe['weight_con_5']),2)?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['dry_mc_5']?></td>
										<td style="border:1px solid black;"><?php echo $row_select_pipe['dry_den_5']?></td>
																				
									</tr>
									
									
									</table>
								
		</table>
				

								
									
									<table align="center" width="50%"  class="test" >
									
									
									<tr style="text-align:center;"  >
										<td  colspan="11">
											<canvas id="scatterChart"></canvas>
										</td>
																				
									</tr>
									
									
									
									
									</table>
									
									<br>
									<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border: 0px solid black; padding: 2px;margin-bottom:4px;">
									<tr style="text-align:center;">
										<td style="width:14.20%;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Result : (1) M.D.D. :</td>
									<td style="width:14.20%;text-align:left;"><?php echo $row_select_pipe['dry_den_3'];?></td>
									
									</tr>
									<tr style="text-align:left;">
										<td style="width:14.20%;text-align:center;">   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2) O.M.C. : :</td>
									<td style="width:14.20%;"><?php echo $row_select_pipe['dry_mc_3'];?></td>
									
									</tr>
									</table>
									<br>						
									<br>	
									
			<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr style="height: 20px;">
					<td style="border:0;text-align:center;padding: 4px;text-transform: uppercase;"><b>Page 1 of 4</b></td>
				</tr>
			</table>	
			
									
							<br>
							<br>
							<br>
							<div style="page-break-after: always;"></div>
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
			
			<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border: 0px solid black; padding: 2px;margin-bottom:4px;">
			<br>				
			<br>				
							
		<tr>
			<td style="text-align:left;font-size:15px;"><b> ULR No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row_select_pipe['ulr'];?></b></td>
			<td style="text-align:left;font-size:15px;"><b> </b></td>
		</tr>
	</table>	
	
	<table class="bg_light" align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border: 1px solid black; padding: 2px;margin-bottom: 4px;">
		<tr>
			<td style="text-align:center;font-size:15px;text-transform:uppercase;"><b>LIQUID AND PLASTIC LIMIT</b></td>
		</tr>
	</table>

								<table align="center" width="92%" ;cellspacing="0" cellpadding="0" style="  margin-bottom:6px;border: 0px solid black;font-size:11px;font-family: Arial;padding-top:3px;padding-bottom:2px ">
								
								<table align="center" width="92%"  class="test" >
									<tr style="">
										<td colspan="7" style="border:1px solid black;border-left:1px solid black;width:14.20%;"> &nbsp&nbsp&nbsp&nbsp&nbsp Test Method : IS 2720 (Part 5):1983 RA 2015. </td>
										
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;width:14.20%;">DESCRIPTION</td>
										<td style="border:1px solid black;width:14.20%;"colspan="5"> LIQUID LIMIT</td>
										<td style="border:1px solid black;width:14.20%;"> PLASTIC LIMIT </td>
																				
									</tr>
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">Penetration (mm)</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pene1']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pene2']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pene3']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pene4']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pene5']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"rowspan="8">Non - Plastic</td>
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">Tare No</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['tare_1']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['tare_2']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['tare_3']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['tare_4']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['tare_5']?></td>
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">Wt of Tare</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['wt_tare_1']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['wt_tare_2']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['wt_tare_3']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['wt_tare_4']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['wt_tare_5']?></td>
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">Wt of Tare+wet sample</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['wet_1']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['wet_2']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['wet_3']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['wet_4']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['wet_5']?></td>
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">Wt of Tare+Dry sample</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['dry_1']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['dry_2']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['dry_3']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['dry_4']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['dry_5']?></td>
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">Wt of water</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo ($row_select_pipe['wet_1'] - $row_select_pipe['dry_1']) ?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo ($row_select_pipe['wet_2'] - $row_select_pipe['dry_2']) ?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo ($row_select_pipe['wet_3'] - $row_select_pipe['dry_3']) ?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo ($row_select_pipe['wet_4'] - $row_select_pipe['dry_4']) ?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo ($row_select_pipe['wet_5'] - $row_select_pipe['dry_5']) ?></td>
																				
									</tr>
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">Wt of Dry sample</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo number_format(($row_select_pipe['dry_1'] - $row_select_pipe['wt_tare_1']),2) ?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo number_format(($row_select_pipe['dry_2'] - $row_select_pipe['wt_tare_2']),2) ?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo number_format(($row_select_pipe['dry_3'] - $row_select_pipe['wt_tare_3']),2) ?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo number_format(($row_select_pipe['dry_4'] - $row_select_pipe['wt_tare_4']),2) ?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo number_format(($row_select_pipe['dry_5'] - $row_select_pipe['wt_tare_5']),2) ?></td>
																				
									</tr>
									
									
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">% of Moisture content</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['mc1']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['mc2']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['mc3']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['mc4']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['mc5']?></td>
																				
									</tr>
									
									
									
								</table>
						
					</td>
				
				
				</table>
				
						<br>					
						
						<table align="center" width="50%"  class="test" >
						
						
									<tr style="text-align:center;">
										<td colspan="7" >
											<canvas id="mddchart"></canvas>
										</td>										
									</tr>
									
						
						
						</table>
						
						<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border: 0px solid black; padding: 2px;margin-bottom:4px;">
									<tr style="text-align:center;">
										<td style="width:14.20%;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Liquid Limit =  :</td>
									<td style="width:14.20%;text-align:left;"><?php echo $row_select_pipe['ll1'];?></td>
									
									</tr>
									<tr style="text-align:left;">
										<td style="width:14.20%;text-align:center;">   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plastic Limit = :</td>
									<td style="width:14.20%;"><?php
										
										if (isset($row_select_pipe['pl1']) && $row_select_pipe['pl1'] !== 'NaN' && $row_select_pipe['pl1'] !== '' && $row_select_pipe['pl1'] !== '0') {
											echo $row_select_pipe['pl1'];
										} else {
											echo "Non Plastic";
										}
										?></td>
									
									</tr>
									<tr style="text-align:left;">
										<td style="width:14.20%;text-align:center;">   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plasticity Index = :</td>
									<td style="width:14.20%;"><?php
										
										if (isset($row_select_pipe['pl1']) && $row_select_pipe['pl1'] !== 'NaN' && $row_select_pipe['pl1'] !== '' && $row_select_pipe['pl1'] !== '0') {
											echo $row_select_pipe['pl1'];
										} else {
											echo "Non Plastic";
										}
										?></td>
									
									</tr>
									</table>
									<br>		
									<br>		
									<br>		
									<br>		
						
			
							
						
											
	<table class="bg_light" align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border: 1px solid black; padding: 2px;margin-bottom: 4px;">
		<tr>
			<td style="text-align:center;font-size:15px;text-transform:uppercase;"><b>PHYSICAL TEST</b></td>
		</tr>
	</table>

								<table align="center" width="92%" ;cellspacing="0" cellpadding="0" style="  margin-bottom:6px;border: 0px solid black;font-size:11px;font-family: Arial;padding-top:3px;padding-bottom:2px ">
								
								<table align="center" width="92%"  class="test" >
									
									<tr style="text-align:center;">
										<td style="border:1px solid black;width:14.20%;">SR. No. </td>
										<td style="border:1px solid black;width:14.20%;"> Name of Test </td>
										<td style="border:1px solid black;width:14.20%;"> Method of test </td>
										<td style="border:1px solid black;width:14.20%;"> Result obtained </td>
										<td style="border:1px solid black;width:14.20%;"> Limits as per MoRT&H Rev. 5 </td>
																				
									</tr>
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">1</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">Aggregate Impact Value (%) by Dry</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">IS 2386 (Part 4): 1963 RA 2016</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo number_format(($row_select_pipe['imp_value'] + $row_select_pipe['imp_value_3'])/2,2)?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">Maximum 40%</td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">2</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">Water Absorption (% by mass)</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">IS 2386 (Part 3): 1963 RA 2016</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['sp_water_abr_1']?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">Max 2%</td>
																				
									</tr>
									
									
								</table>
						
					</td>
				
				
				</table>
				
				<br>
				<br>
				<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr style="height: 20px;">
					<td style="border:0;text-align:center;padding: 4px;text-transform: uppercase;"><b>Page 2 of 4</b></td>
				</tr>
			</table>	
				
						
							<br>
							<br>
							<br>
							<div style="page-break-after: always;"></div>
							
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
		<br>
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border: 0px solid black; padding: 2px;margin-bottom:4px;">
			<br>				
			<br>			
		<tr>
			<td style="text-align:left;font-size:15px;"><b> ULR No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row_select_pipe['ulr'];?></b></td>
			<td style="text-align:left;font-size:15px;"><b> </b></td>
		</tr>
	</table>	
	
								<br>					
	<table class="bg_light" align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border: 1px solid black; padding: 2px;margin-bottom: 4px;">
		<tr>
			<td style="text-align:center;font-size:15px;text-transform:uppercase;"><b>CALIFORNIA BEARING RATIO</b></td>
		</tr>
	</table>

								<table align="center" width="92%" ;cellspacing="0" cellpadding="0" style="  margin-bottom:6px;border: 0px solid black;font-size:11px;font-family: Arial;padding-top:3px;padding-bottom:2px ">
								
								<table align="center" width="92%"  class="test" >
									<tr style="">
										<td colspan="7" style="border:1px solid black;border-left:1px solid black;width:14.20%;"> &nbsp&nbsp&nbsp&nbsp&nbsp Test Method : IS 2720 (Part 16):1987 RA 2015. </td>
										
									</tr>
									<tr style="text-align:center;">
										<td colspan="">Condition : Soaked</td>
										
										<td> </td>
										<td colspan="2"> 1 Div. = 5.87 kg </td>
										
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;">Sr.no</td>
										<td style="border:1px solid black;">Penetration in mm</td>
										<td style="border:1px solid black;">Proving ring Reading  (Division)</td>
										<td style="border:1px solid black;">Actual Load (Kg)</td>
										
										
																				
									</tr>
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">1</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">0</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_1'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_1']?></td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">2</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">0.5</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_2'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_2']?></td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">3</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">1</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_3'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_3']?></td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">4</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">1.5</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_4'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_4']?></td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">5</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">2</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_5'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_5']?></td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">6</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">2.5</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_6'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_6']?></td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">7</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">3</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_7'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_7']?></td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">8</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">4</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_8'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_8']?></td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">9</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">5</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_9'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_9']?></td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">10</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">7.5</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_10'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_10']?></td>
										
																				
									</tr>
									
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">11</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">10</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_11'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_11']?></td>
										
																				
									</tr>
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">12</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">12.5</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ring_12'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['act_load_12']?></td>
										
																				
									</tr>
									
									
								</table>
						
					</td>
				
				
				</table>
				
				
						<table align="center" width="50%"  class="test" >

							<tr style="text-align:center;">
								<td  colspan="7" >
									<canvas id="dynamicChart"></canvas>
								</td>										
							</tr>
							
						</table>						
						<br>
				<br>
				<br>
				<br>
						<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr style="height: 20px;">
					<td style="border:0;text-align:center;padding: 4px;text-transform: uppercase;"><b>Page 3 of 4</b></td>
				</tr>
			</table>	
			
									
							<br>
							<br>
							<br>
							<div style="page-break-after: always;"></div>
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
		<br>
							<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border: 0px solid black; padding: 2px;margin-bottom:4px;">
			<br>				
			<br>				
							
		<tr>
			<td style="text-align:left;font-size:15px;"><b> ULR No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row_select_pipe['ulr'];?></b></td>
			<td style="text-align:left;font-size:15px;"><b> </b></td>
		</tr>
	</table>	
	
	
	<table class="bg_light" align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border: 1px solid black; padding: 2px;margin-bottom:4px;">
			<br>				
			<br>				
							
		<tr>
			<td style="text-align:center;font-size:15px;text-transform:uppercase;"><b>SIEVE ANALYSIS</b></td>
		</tr>
	</table>
				
		
								<table align="center" width="92%" ;cellspacing="0" cellpadding="0" style="  margin-bottom:6px;border: 0px solid black;font-size:11px;font-family: Arial;padding-top:3px;padding-bottom:2px ">
								
								<table align="center" width="92%"  class="test" >
									<tr style="">
										<td colspan="7" style="border:1px solid black;border-left:1px solid black;width:14.20%;"> &nbsp&nbsp&nbsp&nbsp&nbsp Sieve Analysis : IS 2386 (Part 1) : 1963 RA 2016</td>
										
									</tr>
									<tr style="text-align:center;">
										<td rowspan="2"  style="border:1px solid black;width:14.20%;">Sieve Size (mm)</td>
										<td style="border:1px solid black;width:14.20%;">Sample Weight (kg))</td>
										<td style="border:1px solid black;width:14.20%;"> <?php echo $row_select_pipe['sample_taken']?> </td>
										<td rowspan="2" style="border:1px solid black;width:14.20%;">Cu. Wt.   Retained   (%)</td>
										<td rowspan="2" style="border:1px solid black;width:14.20%;"> Passing (%) </td>
										<td colspan="2" style="border:1px solid black;width:14.20%;">Limits as per MoRT&H Rev. 5</td>
																				
									</tr>
									<tr style="text-align:center;">
										<td  style="border:1px solid black;border-left:1px solid black;width:14.20%;">Weight Retained (kg) </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">Cumulative Weight retained (kg)</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">Lower Limits  </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;">Upper Limits</td>
																				
									</tr>
									<?php $cnt = 1; if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != null && $row_select_pipe['sieve_1'] != "0") { ?>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:1px solid black;width:14.20%;"><?php echo $row_select_pipe['sieve_1'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_wt_gm_1'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ret_wt_gm_1'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_ret_1'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pass_sample_1'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ll_1;?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ul_1;?></td>
																				
									</tr>
									<?php } if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != null && $row_select_pipe['sieve_2'] != "0") { ?>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:1px solid black;width:14.20%;"><?php echo $row_select_pipe['sieve_2'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_wt_gm_2'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ret_wt_gm_2'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_ret_2'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pass_sample_2'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ll_2;?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ul_2;?></td>
																				
									</tr>
									<?php } if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != null && $row_select_pipe['sieve_3'] != "0") { ?>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:1px solid black;width:14.20%;"><?php echo $row_select_pipe['sieve_3'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_wt_gm_3'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ret_wt_gm_3'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_ret_3'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pass_sample_3'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ll_3;?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ul_3;?></td>
																				
									</tr>
									<?php } if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != null && $row_select_pipe['sieve_4'] != "0") { ?>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:1px solid black;width:14.20%;"><?php echo $row_select_pipe['sieve_4'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_wt_gm_4'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ret_wt_gm_4'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_ret_4'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pass_sample_4'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ll_4;?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ul_4;?></td>
																				
									</tr>
									<?php } if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != null && $row_select_pipe['sieve_5'] != "0") { ?>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:1px solid black;width:14.20%;"><?php echo $row_select_pipe['sieve_5'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_wt_gm_5'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ret_wt_gm_5'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_ret_5'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ll_5;?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ul_5;?></td>
																				
									</tr>
									<?php } if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != null && $row_select_pipe['sieve_6'] != "0") { ?>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:1px solid black;width:14.20%;"><?php echo $row_select_pipe['sieve_6'];?>										</td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_wt_gm_6'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ret_wt_gm_6'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_ret_6'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pass_sample_6'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ll_6;?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ul_6;?></td>
																				
									</tr>
									<?php } if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != null && $row_select_pipe['sieve_7'] != "0") { ?>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:1px solid black;width:14.20%;"><?php echo $row_select_pipe['sieve_7'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_wt_gm_7'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ret_wt_gm_7'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_ret_7'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pass_sample_7'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ll_7;?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ul_7;?></td>
																				
									</tr>
									<?php } if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != null && $row_select_pipe['sieve_8'] != "0") { ?>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:1px solid black;width:14.20%;"><?php echo $row_select_pipe['sieve_8'];?> </td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_wt_gm_8'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['ret_wt_gm_8'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['cum_ret_8'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ll_8;?></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:14.20%;"><?php echo $ul_8;?></td>
																				
									</tr>
									<?php }?>
									
								</table>
						
					</td>
				
				
				</table>
				
		
		<br>
		
						<table align="center" width="60%"  class="test" >

							<tr style="text-align:center;">
								<td colspan="7" >
									<canvas id="gradationChart"></canvas>
								</td>										
							</tr>
							
						</table>							
		
		
		<!--  -->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
						
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;padding-left:60px;" colspan="2">1) Test results related to sample collected by Customer.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;padding-left:60px;" colspan="2">2) Results/Reports are issued with the specific understanding that Stern Testing & Consultancy Pvt. Ltd. will not, in any case, be involved in action following the interpretation of test results.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;padding-left:60px;" colspan="2">3) The reports/results are not supposed to be used for Publicity.</td>
						</tr>
						
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;width:70%;padding-top:50px;"></td>
							<td style="padding: 1px 2px;font-weight: bold;width:30%;">Stern Testing & Consultancy Pvt. Ltd.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;width:70%;padding-top:80px;"></td>
							<td style="padding: 1px 2px;font-weight: bold;width:30%;padding-left:5%;">Authorized Signature</td>
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

<script>


    // The rest of your function to ensure it runs after the DOM is fully loaded
	  jkl();
	  
	  var customGraph3;
    function jkl() {

        var xValues = [75, 53, 26.5, 9.5, 4.75, 2.36, 0.445, 0.075];

        // Get initial y-axis values (replace these with actual initial data)
        var yValues = [100 , 100, 90, 65, 55, 40, 15, 5];
       
		var zValues = [100 , 80, 55, 35, 25, 20, 10, 0];
		
		 var initialData1 = [
            parseFloat(document.getElementById('id_33').value) || 0,
            parseFloat(document.getElementById('id_34').value) || 0,
            parseFloat(document.getElementById('id_35').value) || 0,
            parseFloat(document.getElementById('id_36').value) || 0,
            parseFloat(document.getElementById('id_37').value) || 0,
            parseFloat(document.getElementById('id_38').value) || 0,
            parseFloat(document.getElementById('id_39').value) || 0,
            parseFloat(document.getElementById('id_40').value) || 0
        ];

        // Get the canvas element
        var gradationCtx1 = document.getElementById('gradationChart').getContext('2d');
    
        // Create the initial chart
        var customGraph = new Chart(gradationCtx1, {
            type: 'line',
            data: {
                labels: xValues.map(String), // Convert xValues to string labels
                datasets: [{
                    label: 'Upper Limits',
                    data: yValues,
                    borderColor: 'rgba(128, 0, 128, 1)', // Custom color
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Custom background color
                    borderWidth: 1

				}, {

					label: 'Lower Limits',
                    data: zValues,
                    borderColor: 'rgba(0, 128, 0, 1)', // Custom color
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Custom background color
                    borderWidth: 1
                }, {

					label: 'Passing',
                    data: initialData1,
                    borderColor: 'rgba(75, 192, 192, 1)', // Custom color
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Custom background color
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
						 // Use logarithmic scale for y-axis
                        title: {
                            display: true,
                            text: '% Passing -- ' // Customize y-axis label as needed
                        },
						
                    },
                    x: {
						type: 'logarithmic', 
                        title: {
                            display: true,
                            text: '0.1 Sieve Sizes --->' // Customize x-axis label as needed
                        },
						suggestedMin: 0, suggestedMax: 100 
                    }
                }
            }
        });
	}
</script>


<script>


    // The rest of your function to ensure it runs after the DOM is fully loaded
	
		def();
	
	var customGraph1;
    function def() {
        // Fetching data for initialData1 (Liquid Limit)
        var initialData2 = [
            parseFloat(document.getElementById('id_1').value) || 0,
            parseFloat(document.getElementById('id_2').value) || 0,
            parseFloat(document.getElementById('id_3').value) || 0,
            parseFloat(document.getElementById('id_4').value) || 0,
            parseFloat(document.getElementById('id_5').value) || 0
        ];

        // Fetching data for initialData2 (Moisture Content)
        var initialData1 = [
            parseFloat(document.getElementById('id_6').value) || 0,
            parseFloat(document.getElementById('id_7').value) || 0,
            parseFloat(document.getElementById('id_8').value) || 0,
            parseFloat(document.getElementById('id_9').value) || 0,
            parseFloat(document.getElementById('id_10').value) || 0
        ];

        var scatterCtx1  = document.getElementById('scatterChart').getContext('2d');
		 if (customGraph1) {
            customGraph1.destroy();
        }
        // Define chart with two datasets (Liquid Limit and Moisture Content)
        var customGraph1 = new Chart(scatterCtx1, {
            type: 'line',
            data: {
                //labels: ['Data Point 1', 'Data Point 2', 'Data Point 3', 'Data Point 4', 'Data Point 5'], // X-axis labels
                labels: initialData1.map(String), // X-axis labels
                datasets: [{
                    label: 'PROCTOR DENSITY CURVE',
                    data: initialData2,
                    borderColor: 'rgba(75, 192, 192, 1)', // Custom color for Liquid Limit
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Custom background color
                    borderWidth: 1
                }] 
            },
            options: {
                scales: {
                    y: {
                        type: 'linear',
                        title: {
                            display: true,
                            text: 'DRY DENSITY IN g/cc' // Customize y-axis label
                        },
                        
                    },
                    x: {
                        type: 'linear',
                        title: {
                            display: true,
                            text: '%of moistutre content)' // Customize x-axis label
                        },
                       
                    },
                }
            }
        });

        // Function to check for zero and replace with a small positive value
       
    }
   

</script>
<script>


    // The rest of your function to ensure it runs after the DOM is fully loaded
	
		abc();
	
	var customGraph1;
    function abc() {
        // Fetching data for initialData1 (Liquid Limit)
        var initialData1 = [
            parseFloat(document.getElementById('id_11').value) || 0,
            parseFloat(document.getElementById('id_12').value) || 0,
            parseFloat(document.getElementById('id_13').value) || 0,
            parseFloat(document.getElementById('id_14').value) || 0,
            parseFloat(document.getElementById('id_15').value) || 0
        ];

        // Fetching data for initialData2 (Moisture Content)
        var initialData2 = [
            parseFloat(document.getElementById('id_16').value) || 0,
            parseFloat(document.getElementById('id_17').value) || 0,
            parseFloat(document.getElementById('id_18').value) || 0,
            parseFloat(document.getElementById('id_19').value) || 0,
            parseFloat(document.getElementById('id_20').value) || 0
        ];

        var mddCtx1  = document.getElementById('mddchart').getContext('2d');
		 if (customGraph1) {
            customGraph1.destroy();
        }
        // Define chart with two datasets (Liquid Limit and Moisture Content)
        var customGraph1 = new Chart(mddCtx1, {
            type: 'line',
            data: {
                //labels: ['Data Point 1', 'Data Point 2', 'Data Point 3', 'Data Point 4', 'Data Point 5'], // X-axis labels
                labels: initialData1.map(String), // X-axis labels
                datasets: [{
                    label: 'LIQUID LIMIT & PLASTIC LIMIT',
                    data: initialData2,
                    borderColor: 'rgba(75, 192, 192, 1)', // Custom color for Liquid Limit
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Custom background color
                    borderWidth: 1
                }] 
            },
            options: {
                scales: {
                    y: {
                        type: 'logarithmic',
                        title: {
                            display: true,
                            text: ' Moisture content' // Customize y-axis label
                        },
                        
                    },
                    x: {
                        type: 'logarithmic',
                        title: {
                            display: true,
                            text: 'Blows)' // Customize x-axis label
                        },
                        
                    },
                }
            }
        });

        // Function to check for zero and replace with a small positive value
       
    }
   

</script>

<script>


    // The rest of your function to ensure it runs after the DOM is fully loaded
	
		ghi();
	
	var customGraph1;
    function ghi() {
        // Fetching data for initialData1 (Liquid Limit)
        var initialData2 = [
            parseFloat(document.getElementById('id_21').value) || 0,
            parseFloat(document.getElementById('id_22').value) || 0,
            parseFloat(document.getElementById('id_23').value) || 0,
            parseFloat(document.getElementById('id_24').value) || 0,
            parseFloat(document.getElementById('id_25').value) || 0,
			parseFloat(document.getElementById('id_26').value) || 0,
            parseFloat(document.getElementById('id_27').value) || 0,
            parseFloat(document.getElementById('id_28').value) || 0,
            parseFloat(document.getElementById('id_29').value) || 0,
            parseFloat(document.getElementById('id_30').value) || 0,
            parseFloat(document.getElementById('id_31').value) || 0,
            parseFloat(document.getElementById('id_32').value) || 0
        ];

        // Fetching data for initialData2 (Moisture Content)
        var initialData1 = [0, 0.5, 1.0, 1.5, 2.0, 2.5, 3.0, 4.0, 5.0, 7.5, 10.0, 12.5];

        var dynamicCtx1  = document.getElementById('dynamicChart').getContext('2d');
		 if (customGraph1) {
            customGraph1.destroy();
        }
        // Define chart with two datasets (Liquid Limit and Moisture Content)
        var customGraph1 = new Chart(dynamicCtx1, {
            type: 'line',
            data: {
                //labels: ['Data Point 1', 'Data Point 2', 'Data Point 3', 'Data Point 4', 'Data Point 5'], // X-axis labels
                labels: initialData1.map(String), // X-axis labels
                datasets: [{
                    label: 'PENETRATION CURVE',
                    data: initialData2,
                    borderColor: 'rgba(75, 192, 192, 1)', // Custom color for Liquid Limit
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Custom background color
                    borderWidth: 1
                }] 
            },
            options: {
                scales: {
                    y: {
                        type: 'linear',
                        title: {
                            display: true,
                            text: '' // Customize y-axis label
                        },
                        
                    },
                    x: {
                        type: 'linear',
                        title: {
                            display: true,
                            text: '' // Customize x-axis label
                        },
                        
                    },
                }
            }
        });

        // Function to check for zero and replace with a small positive value
       
    }
   

</script>
