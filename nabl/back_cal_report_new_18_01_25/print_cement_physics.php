<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 29.7cm;
		height: 21cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 12px;
		font-family : Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family : Calibri;

	}

	.tdclass1 {

		font-size: 12px;
		font-family : Calibri;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from span_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$branch_name = $row_select['branch_name'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	
	if ($cons == 0) {
		$con_sample = "Sealed Ok";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];
        $issue_date = $row_select2['issue_date'];

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
		$source = $row_select4['agg_source'];
		$type_of_cement = $row_select4['type_of_cement'];
		$cement_brand = $row_select4['cement_brand'];
		$week_no = $row_select4['week_no'];
		$in_grade= $row_select4['in_grade'];
	}

	$pagecnt = 0;
	$totalcnt = 0;
	if (($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null) || ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) || ($row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != "0" && $row_select_pipe['ss_area'] != null)) {
		$totalcnt++;
	}
	if(($row_select_pipe['final_time']!="" && $row_select_pipe['final_time']!="0" && $row_select_pipe['final_time']!=null) || ($row_select_pipe['avg_com_1']!="" && $row_select_pipe['avg_com_1']!="0" && $row_select_pipe['avg_com_1']!=null) || ($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null))
					{
		$totalcnt++;
	}


	?>

	<br>
	<br>

	<page size="A4">
		<?php
			if (($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null) || ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) || ($row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != "0" && $row_select_pipe['ss_area'] != null)) {
				$pagecnt++;
		?>
		
		<?php if ($branch_name == "Nadiad") {?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-002</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<?php } else {?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name;?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-002</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<?php }?>	
		
		
		<br>
		<table align="center" width="90%" class="test1" height="9%">

			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $sample_no;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Type of Cement</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $type_of_cement; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Brand Name</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $cement_brand; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Identification Mark</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo "Cement - ".$in_grade; ?> <?php //echo $row_select_pipe['lab_no']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>5</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Sample</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<Br>
		<table align="center" width="90%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center>1.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Density of Cement by Le Chatelier Flask</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS 4031(P-11) 1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:5%;"></td>
				<td style="text-align:left;"><b>Test Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if($row_select_pipe['sou_temp']!='' && $row_select_pipe['sou_temp']!='0' && $row_select_pipe['sou_temp']!=null ){ echo $row_select_pipe['sou_temp'];}else{echo ' - ';}?></b></td>
				<td style="text-align:left;"><b>Humidity(%) - Min. <?php if($row_select_pipe['sou_humidity']!='' && $row_select_pipe['sou_humidity']!='0' && $row_select_pipe['sou_humidity']!=null ){ echo $row_select_pipe['sou_humidity'];}else{echo ' - ';}?> %</b></td>
			</tr>
		</table>
		<table align="center" width="90%" class="test1" height="15%" style="margin-top:-1px;font-size:14px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>1</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Air temperature &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; °C</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['sou_temp']!='' && $row_select_pipe['sou_temp']!='0' && $row_select_pipe['sou_temp']!=null ){ echo $row_select_pipe['sou_temp'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['sou_temp']!='' && $row_select_pipe['sou_temp']!='0' && $row_select_pipe['sou_temp']!=null ){ echo $row_select_pipe['sou_temp'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>2</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Mass of cement used &nbsp; &nbsp; &nbsp; gm</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['sou_weight']!='' && $row_select_pipe['sou_weight']!='0' && $row_select_pipe['sou_weight']!=null ){ echo $row_select_pipe['sou_weight'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['sou_weight']!='' && $row_select_pipe['sou_weight']!='0' && $row_select_pipe['sou_weight']!=null ){ echo $row_select_pipe['sou_weight'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>3</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Initial reading of flask &nbsp; &nbsp; &nbsp; &nbsp; ml</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['dis_1_1']!='' && $row_select_pipe['dis_1_1']!='0' && $row_select_pipe['dis_1_1']!=null ){ echo $row_select_pipe['dis_1_1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['dis_1_2']!='' && $row_select_pipe['dis_1_2']!='0' && $row_select_pipe['dis_1_2']!=null ){ echo $row_select_pipe['dis_1_2'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>4</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Final reading of flask &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ml</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['dis_2_1']!='' && $row_select_pipe['dis_2_1']!='0' && $row_select_pipe['dis_2_1']!=null ){ echo $row_select_pipe['dis_2_1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['dis_2_2']!='' && $row_select_pipe['dis_2_2']!='0' && $row_select_pipe['dis_2_2']!=null ){ echo $row_select_pipe['dis_2_2'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>5</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Displaced volume in cm<sup>3</sup> &nbsp; (4-3)</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['diff_1']!='' && $row_select_pipe['diff_1']!='0' && $row_select_pipe['diff_1']!=null ){ echo $row_select_pipe['diff_1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['diff_2']!='' && $row_select_pipe['diff_2']!='0' && $row_select_pipe['diff_2']!=null ){ echo $row_select_pipe['diff_2'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>6</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Density of Cement (2/5)&nbsp; ,&nbsp; g/cm<sup>3</sup></b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['diff_1']!='' && $row_select_pipe['diff_1']!='0' && $row_select_pipe['diff_1']!=null ){ echo substr(($row_select_pipe['sou_weight'] / $row_select_pipe['diff_1']),0,6);}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['diff_2']!='' && $row_select_pipe['diff_2']!='0' && $row_select_pipe['diff_2']!=null ){ echo substr(($row_select_pipe['sou_weight'] / $row_select_pipe['diff_2']),0,6);}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>7</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Density of Cement &nbsp; ,&nbsp; g/cm <sup>3</sup></b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['diff_1']!='' && $row_select_pipe['diff_1']!='0' && $row_select_pipe['diff_1']!=null ){ echo substr(($row_select_pipe['sou_weight'] / $row_select_pipe['diff_1']),0,6);}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if($row_select_pipe['diff_2']!='' && $row_select_pipe['diff_2']!='0' && $row_select_pipe['diff_2']!=null ){ echo substr(($row_select_pipe['sou_weight'] / $row_select_pipe['diff_2']),0,6);}else{echo ' - ';}?></td>
			</tr>
		</table>
		<Br>
		<table align="center" width="90%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center>2.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Consistency Test</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS 4031(P-4) 1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:5%;"></td>
				<td style="text-align:left;"><b>Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if($row_select_pipe['con_temp']!='' && $row_select_pipe['con_temp']!='0' && $row_select_pipe['con_temp']!=null ){ echo $row_select_pipe['con_temp'];}else{echo ' - ';}?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Humidity(%) - Min. <?php if($row_select_pipe['con_humidity']!='' && $row_select_pipe['con_humidity']!='0' && $row_select_pipe['con_humidity']!=null ){ echo $row_select_pipe['con_humidity'];}else{echo ' - ';}?>%</b></td>
				<td style="text-align:center;"><b>Weight of Cement <?php if($row_select_pipe['con_weight']!='' && $row_select_pipe['con_weight']!='0'){ echo $row_select_pipe['con_weight'];}else{echo ' - ';}?> gm</b></td>
			</tr>
		</table>
		<table align="center" width="90%" class="test1" height="13%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>Sr.No.</center></b></td>
				<td style="width:32%;padding-left:3px;text-align:center;"><b>Volume of Water (cc)</b></td>
				<td style="border-left:1px solid;text-align:center;width:32%;"><b>% of Water</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>Reading on Vicat (mm)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>1</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if($row_select_pipe['vol_1']!='' && $row_select_pipe['vol_1']!='0' && $row_select_pipe['vol_1']!=null ){ echo $row_select_pipe['vol_1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['wtr_1']!='' && $row_select_pipe['wtr_1']!='0' && $row_select_pipe['wtr_1']!=null ){ echo $row_select_pipe['wtr_1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['reading_1']!='' && $row_select_pipe['reading_1']!='0' && $row_select_pipe['reading_1']!=null ){ echo $row_select_pipe['reading_1'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if($row_select_pipe['vol_2']!='' && $row_select_pipe['vol_2']!='0' && $row_select_pipe['vol_2']!=null ){ echo $row_select_pipe['vol_2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['wtr_2']!='' && $row_select_pipe['wtr_2']!='0' && $row_select_pipe['wtr_2']!=null ){ echo $row_select_pipe['wtr_2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['reading_2']!='' && $row_select_pipe['reading_2']!='0' && $row_select_pipe['reading_2']!=null ){ echo $row_select_pipe['reading_2'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>3</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if($row_select_pipe['vol_3']!='' && $row_select_pipe['vol_3']!='0' && $row_select_pipe['vol_3']!=null ){ echo $row_select_pipe['vol_3'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['wtr_3']!='' && $row_select_pipe['wtr_3']!='0' && $row_select_pipe['wtr_3']!=null ){ echo $row_select_pipe['wtr_3'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['reading_3']!='' && $row_select_pipe['reading_3']!='0' && $row_select_pipe['reading_3']!=null ){ echo $row_select_pipe['reading_3'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>4</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if($row_select_pipe['vol_4']!='' && $row_select_pipe['vol_4']!='0' && $row_select_pipe['vol_4']!=null ){ echo $row_select_pipe['vol_4'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['wtr_4']!='' && $row_select_pipe['wtr_4']!='0' && $row_select_pipe['wtr_4']!=null ){ echo $row_select_pipe['wtr_4'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['reading_4']!='' && $row_select_pipe['reading_4']!='0' && $row_select_pipe['reading_4']!=null ){ echo $row_select_pipe['reading_4'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>5</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if($row_select_pipe['vol_5']!='' && $row_select_pipe['vol_5']!='0' && $row_select_pipe['vol_5']!=null ){ echo $row_select_pipe['vol_5'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['wtr_5']!='' && $row_select_pipe['wtr_5']!='0' && $row_select_pipe['wtr_5']!=null ){ echo $row_select_pipe['wtr_5'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['reading_5']!='' && $row_select_pipe['reading_5']!='0' && $row_select_pipe['reading_5']!=null ){ echo $row_select_pipe['reading_5'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;border-width:1px 1px 0 0;">
				<td></td>
				<td></td>
				<td style="padding-left:3px;text-align:right;border-left:1px solid;border-bottom:1px solid;">Consistency &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
				<td style="border-left:1px solid;text-align:center;border-bottom:1px solid;"><?php if($row_select_pipe['final_consistency']!='' && $row_select_pipe['final_consistency']!='0' && $row_select_pipe['final_consistency']!=null ){ echo $row_select_pipe['final_consistency'];}else{echo ' - ';}?></td>
			</tr>
			
		</table>
		<Br>
		<table align="center" width="90%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center>3.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Specific surface area m <sup>2</sup> / Kg.</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS 4031(P-2) &nbsp;  &nbsp;  1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:5%;"></td>
				<td style="text-align:left;"><b>Test Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if($row_select_pipe['fine_temp']!='' && $row_select_pipe['fine_temp']!='0' && $row_select_pipe['fine_temp']!=null ){ echo $row_select_pipe['fine_temp'];}else{echo ' - ';}?></b></td>
				<td style="text-align:left;"><b>Humidity(%) - Min. <?php if($row_select_pipe['fine_humidity']!='' && $row_select_pipe['fine_humidity']!='0' && $row_select_pipe['fine_humidity']!=null ){ echo $row_select_pipe['fine_humidity'];}else{echo ' - ';}?>%</b></td>
			</tr>
		</table>
		<table align="center" width="90%" class="test1" height="13%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td colspan="2" style="width:20%;border-right:1px solid;"><b><center>Time in Seconds (T)</center></b></td>
				<td colspan="2" style="width:80%;padding-left:5px;"><b>Specific surface area of Standard Cement in cm<sup>2</sup> /g, S<sub>o</sub></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:8%;border-right:1px solid;"><b><center>1</center></b></td>
				<td style="width:12%;padding-left:3px;text-align:center;"><?php if($row_select_pipe['fines_t_1']!='' && $row_select_pipe['fines_t_1']!='0' && $row_select_pipe['fines_t_1']!=null ){ echo $row_select_pipe['fines_t_1'];}else{echo ' - ';}?></td>
				<td colspan="2" style="border-left:1px solid;width:80%;padding-left:5px;">Standard Time in seconds, T<sub>o</sub></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if($row_select_pipe['fines_t_2']!='' && $row_select_pipe['fines_t_2']!='0' && $row_select_pipe['fines_t_2']!=null ){ echo $row_select_pipe['fines_t_2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;width:40%;padding-left:5px;">Density of Standard Cement g/cm <sup>3</sup> , ƍ<sub>o</sub></td>
				<td style="border-left:1px solid;width:40%;padding-left:5px;">Density of Cement g/cm <sup>3</sup> , ƍ</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>3</center></b></td>
				<td style="width:13%;padding-left:3px;text-align:center;"><?php if($row_select_pipe['fines_t_3']!='' && $row_select_pipe['fines_t_3']!='0' && $row_select_pipe['fines_t_3']!=null ){ echo $row_select_pipe['fines_t_3'];}else{echo ' - ';}?></td>
				<td rowspan="2" colspan="2" style="border-left:1px solid;width:80%;">
					<table align="center" width="99%" class="test1" height="Auto">
						<tr>
							<td width="40" rowspan="2"> Aparatus Constant	K	=	1.414 &times; S<sub>o</sub> ƍ<sub>o</sub></td>
							<td width="5" style="text-align:center;"> &#8730; 0.1 η<sub>o</sub></td>
							<td width="55" rowspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; &nbsp; <?php if($row_select_pipe['constant_k']!='' && $row_select_pipe['constant_k']!='0' && $row_select_pipe['constant_k']!=null ){ echo $row_select_pipe['constant_k'];}else{echo ' - ';}?></td>
						</tr>
						<tr>
							<td style="text-align:center;border-top:1px solid;">&#8730; t<sub>o</sub></td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:7%;border-right:1px solid;"><b><center>Average</center></b></td>
				<td style="width:13%;padding-left:3px;text-align:center;"><b><?php if($row_select_pipe['avg_fines_time']!='' && $row_select_pipe['avg_fines_time']!='0' && $row_select_pipe['avg_fines_time']!=null ){ echo $row_select_pipe['avg_fines_time'];}else{echo ' - ';}?></b></td>
			</tr>
		</table>
		<table align="center" width="90%" class="test1" height="Auto" style="margin-top:-2px;border:1px solid;">
						<tr>
							<td width="35" rowspan="2">&nbsp;  Specific Surface area		S	=	521.08 &times; K </td>
							<td width="5" style="text-align:center;"> &#8730; t<sub>o</sub></td>
							<td width="60" rowspan="2"> &nbsp; &nbsp; &nbsp;  &nbsp; = &nbsp; &nbsp; &nbsp;  <?php if($row_select_pipe['ss_area']!='' && $row_select_pipe['ss_area']!='0' && $row_select_pipe['ss_area']!=null ){ echo ($row_select_pipe['ss_area'] * 10);}else{echo ' - ';}?> cm<sup>2</sup>/g &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; =   &nbsp; &nbsp; &nbsp;<?php if($row_select_pipe['ss_area']!='' && $row_select_pipe['ss_area']!='0' && $row_select_pipe['ss_area']!=null ){ echo $row_select_pipe['ss_area'];}else{echo ' - ';}?>&nbsp;  m<sup>2</sup> / kg</td>
						</tr>
						<tr>
							<td style="text-align:center;border-top:1px solid;">&#8730; ƍ<sub>o</sub></td>
						</tr>
						
		</table>
		<table align="center" width="90%" class="test1" height="Auto">
			<tr>
				<td style="padding-left:10px;"><br>Where, <br><br> &#8730; 0.1 η<sub>o</sub> = the Viscosity of air at the test temperature taken from Table 1 (IS 4031 Part – 2)</td>
			</tr>	
		</table>
		<br>
		<br>
		<br>
		
		<?php include("../include/footer_p.php");?>

		<?php
			}
		if(($row_select_pipe['final_time']!="" && $row_select_pipe['final_time']!="0" && $row_select_pipe['final_time']!=null) || ($row_select_pipe['avg_com_1']!="" && $row_select_pipe['avg_com_1']!="0" && $row_select_pipe['avg_com_1']!=null) || ($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null))
					{
						$pagecnt++;
		?>

		<div class="pagebreak"> </div>

		<br>
		<?php include('../include/header_p.php'); ?>
		<br>
		<table align="center" width="90%" class="test1" height="17%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center>4.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Setting Time</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS : 4031 ( P - 5 ) 1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:7%;"></td>
				<td style="text-align:left;"><b>Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if($row_select_pipe['set_temp']!='' && $row_select_pipe['set_temp']!='0' && $row_select_pipe['set_temp']!=null ){ echo $row_select_pipe['set_temp'];}else{echo ' - ';}?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Humidity(%) - Min. <?php if($row_select_pipe['set_humidity']!='' && $row_select_pipe['set_humidity']!='0' && $row_select_pipe['set_humidity']!=null ){ echo $row_select_pipe['set_humidity'];}else{echo ' - ';}?>%</td>
				<td style="text-align:center;"><b>Weight of Cement <?php if($row_select_pipe['set_weight']!='' && $row_select_pipe['set_weight']!='0' && $row_select_pipe['set_weight'] != null){ echo $row_select_pipe['set_weight'];}else{echo ' - ';}?> gm</b></td>
			</tr>
			<tr style="border: 1px solid black;font-size:13px;">
				<td colspan="3"><b>&nbsp; &nbsp; &nbsp; Water = 0.85 x Consistency in % X 4 &nbsp; &nbsp; &nbsp;  = &nbsp; &nbsp; &nbsp;  <?php if($row_select_pipe['set_wtr']!='' && $row_select_pipe['set_wtr']!='0'){ echo $row_select_pipe['set_wtr'];}else{echo ' - ';}?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td><b><center> a </center></b></td>
				<td colspan="2" style="padding-left:3px;border-left:1px solid;"><b>&nbsp; Time when water added &nbsp; : - &nbsp; <?php if($row_select_pipe['hr_a']!='' && $row_select_pipe['hr_a']!='0' && $row_select_pipe['hr_a'] != null){ echo $row_select_pipe['hr_a'];}else{echo ' - ';}?> &nbsp; &nbsp; 	hours/min</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td><b><center> b </center></b></td>
				<td colspan="2" style="padding-left:3px;border-left:1px solid;"><b>&nbsp; Initial setting time &nbsp; : - &nbsp; <?php if($row_select_pipe['hr_b']!='' && $row_select_pipe['hr_b']!='0' && $row_select_pipe['hr_b'] != null){ echo $row_select_pipe['hr_b'];}else{echo ' - ';}?> &nbsp; &nbsp; 	hours/min</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td><b><center> c </center></b></td>
				<td colspan="2" style="padding-left:3px;border-left:1px solid;"><b>&nbsp; Final setting time  &nbsp; : - &nbsp; <?php if($row_select_pipe['hr_c']!='' && $row_select_pipe['hr_c']!='0' && $row_select_pipe['hr_c'] != null){ echo $row_select_pipe['hr_c'];}else{echo ' - ';}?> &nbsp; &nbsp; 	hours/min</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3"><b>&nbsp; Initial setting time  &nbsp; : - &nbsp; ( b ) - ( a ) &nbsp; &nbsp; &nbsp; <?php if($row_select_pipe['initial_time']!='' && $row_select_pipe['initial_time']!='0' && $row_select_pipe['initial_time'] != null){ echo $row_select_pipe['initial_time'];}else{echo ' - ';}?> &nbsp; &nbsp; 	min</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3"><b>&nbsp; Final setting time  &nbsp; : - &nbsp; ( c ) - ( a ) &nbsp; &nbsp; &nbsp; <?php if($row_select_pipe['final_time']!='' && $row_select_pipe['final_time']!='0' && $row_select_pipe['final_time'] != null){ echo $row_select_pipe['final_time'];}else{echo ' - ';}?> &nbsp; &nbsp;  min</b></td>
			</tr>
		</table>	
		<br>
		<table align="center" width="90%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center>5.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Compressive Strength</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS 4031 ( P - 6 ) 1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:5%;"></td>
				<td style="text-align:left;"><b>Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if($row_select_pipe['com_temp']!='' && $row_select_pipe['com_temp']!='0' && $row_select_pipe['com_temp']!=null ){ echo $row_select_pipe['com_temp'];}else{echo ' - ';}?></b></td>
				<td style="text-align:left;"><b>Humidity ( % ) &nbsp; = &nbsp; <?php if($row_select_pipe['com_humidity']!='' && $row_select_pipe['com_humidity']!='0' && $row_select_pipe['com_humidity']!=null ){ echo $row_select_pipe['com_humidity'];}else{echo ' - ';}?>&nbsp;%</b></td>
			</tr>
		</table>
		<table align="center" width="90%" class="test1" height="4%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:25%;border-right:1px solid;"><b><center>Weight of Cement <?php if($row_select_pipe['weight_of_cement']!='' && $row_select_pipe['weight_of_cement']!='0' && $row_select_pipe['weight_of_cement']!=null ){ echo $row_select_pipe['weight_of_cement'];}else{echo ' - ';}?> gm</center></b></td>
				<td style="width:30%;padding-left:5px;text-align:center;"><b>Weight of Std. Sand &nbsp; - &nbsp; <?php if($row_select_pipe['weight_of_sand']!='' && $row_select_pipe['weight_of_sand']!='0' && $row_select_pipe['weight_of_sand']!=null ){ echo $row_select_pipe['weight_of_sand'];}else{echo ' - ';}?> gm</b></td>
				<td style="border-left:1px solid;width:45%;">
					<table align="center" width="99%" class="test1" height="Auto">
						<tr>
							<td> Water &nbsp; = &nbsp; </td>
							<td style="border-bottom:1px solid;text-align:center;">% consistency</td>
							<td>&nbsp; + &nbsp; ( 3 x 8 ) &nbsp; &nbsp; = &nbsp; &nbsp; <?php if($row_select_pipe['weight_of_water']!='' && $row_select_pipe['weight_of_water']!='0' && $row_select_pipe['weight_of_water']!=null ){ echo $row_select_pipe['weight_of_water'];}else{echo ' - ';}?> C.C.</td>
						</tr>
						<tr>
							<td style="text-align:center;"></td>
							<td style="text-align:center;">4</td>
							<td style="text-align:center;"></td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3	" style="width:8%;border-right:1px solid;"><b>&nbsp; &nbsp; Age: Days 3 (72 Hrs + 1 Hrs)</b></td>
			</tr>
		</table>
		<table align="center" width="90%" class="test1" height="27%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>Sr.No.</center></b></td>
				<td style="width:11%;text-align:center;"><b>Date of<br>Casting</b></td>
				<td style="border-left:1px solid;text-align:center;width:11%;"><b>Date of<br>Testing</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;"><b>Length<br>(L)<br>mm</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;"><b>Width<br>(B)<br>mm</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;"><b>Area<br>mm<sup>2</sup></b></td>
				<td style="border-left:1px solid;text-align:center;width:14%;"><b>Load (KN)</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><b>Comp.<br>Strength<br>(N/mm<sup>2</sup>)</b></td>
				<td style="border-left:1px solid;text-align:center;width:14%;"><b>Avg. Comp.<br>Strength<br>(N/mm<sup>2</sup>)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>1</center></b></td>
				<td style="text-align:center;"><?php if($row_select_pipe['caste_date1']!='' && $row_select_pipe['caste_date1']!='0' && $row_select_pipe['caste_date1']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date1']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['test_date1']!='' && $row_select_pipe['test_date1']!='0' && $row_select_pipe['test_date1']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date1']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l1']!='' && $row_select_pipe['l1']!='0' && $row_select_pipe['l1']!=null ){ echo $row_select_pipe['l1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b1']!='' && $row_select_pipe['b1']!='0' && $row_select_pipe['b1']!=null ){ echo $row_select_pipe['b1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_1']!='' && $row_select_pipe['area_1']!='0' && $row_select_pipe['area_1']!=null ){ echo $row_select_pipe['area_1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_1']!='' && $row_select_pipe['load_1']!='0' && $row_select_pipe['load_1']!=null ){ echo $row_select_pipe['load_1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_1']!='' && $row_select_pipe['com_1']!='0' && $row_select_pipe['com_1']!=null ){ echo $row_select_pipe['com_1'];}else{echo ' - ';}?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['avg_com_1']!='' && $row_select_pipe['avg_com_1']!='0' && $row_select_pipe['avg_com_1']!=null ){ echo $row_select_pipe['avg_com_1'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="text-align:center;"><?php if($row_select_pipe['caste_date1']!='' && $row_select_pipe['caste_date1']!='0' && $row_select_pipe['caste_date1']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date1']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['test_date1']!='' && $row_select_pipe['test_date1']!='0' && $row_select_pipe['test_date1']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date1']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l2']!='' && $row_select_pipe['l2']!='0' && $row_select_pipe['l2']!=null ){ echo $row_select_pipe['l2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b2']!='' && $row_select_pipe['b2']!='0' && $row_select_pipe['b2']!=null ){ echo $row_select_pipe['b2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_2']!='' && $row_select_pipe['area_2']!='0' && $row_select_pipe['area_2']!=null ){ echo $row_select_pipe['area_2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_2']!='' && $row_select_pipe['load_2']!='0' && $row_select_pipe['load_2']!=null ){ echo $row_select_pipe['load_2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_2']!='' && $row_select_pipe['com_2']!='0' && $row_select_pipe['com_2']!=null ){ echo $row_select_pipe['com_2'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>3</center></b></td>
				<td style="text-align:center;"><?php if($row_select_pipe['caste_date1']!='' && $row_select_pipe['caste_date1']!='0' && $row_select_pipe['caste_date1']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date1']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['test_date1']!='' && $row_select_pipe['test_date1']!='0' && $row_select_pipe['test_date1']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date1']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l3']!='' && $row_select_pipe['l3']!='0' && $row_select_pipe['l3']!=null ){ echo $row_select_pipe['l3'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b3']!='' && $row_select_pipe['b3']!='0' && $row_select_pipe['b3']!=null ){ echo $row_select_pipe['b3'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_3']!='' && $row_select_pipe['area_3']!='0' && $row_select_pipe['area_3']!=null ){ echo $row_select_pipe['area_3'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_3']!='' && $row_select_pipe['load_3']!='0' && $row_select_pipe['load_3']!=null ){ echo $row_select_pipe['load_3'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_3']!='' && $row_select_pipe['com_3']!='0' && $row_select_pipe['com_3']!=null ){ echo $row_select_pipe['com_3'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="9	" style="width:8%;border-right:1px solid;"><b>&nbsp; &nbsp; Age: Days 7 (168 Hrs + 2 Hrs)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>4</center></b></td>
				<td style="text-align:center;"><?php if($row_select_pipe['caste_date2']!='' && $row_select_pipe['caste_date2']!='0' && $row_select_pipe['caste_date2']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date2']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['test_date2']!='' && $row_select_pipe['test_date2']!='0' && $row_select_pipe['test_date2']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date2']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l4']!='' && $row_select_pipe['l4']!='0' && $row_select_pipe['l4']!=null ){ echo $row_select_pipe['l4'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b4']!='' && $row_select_pipe['b4']!='0' && $row_select_pipe['b4']!=null ){ echo $row_select_pipe['b4'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_4']!='' && $row_select_pipe['area_4']!='0' && $row_select_pipe['area_4']!=null ){ echo $row_select_pipe['area_4'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_4']!='' && $row_select_pipe['load_4']!='0' && $row_select_pipe['load_4']!=null ){ echo $row_select_pipe['load_4'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_4']!='' && $row_select_pipe['com_4']!='0' && $row_select_pipe['com_4']!=null ){ echo $row_select_pipe['com_4'];}else{echo ' - ';}?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['avg_com_2']!='' && $row_select_pipe['avg_com_2']!='0' && $row_select_pipe['avg_com_2']!=null ){ echo $row_select_pipe['avg_com_2'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>5</center></b></td>
				<td style="text-align:center;"><?php if($row_select_pipe['caste_date2']!='' && $row_select_pipe['caste_date2']!='0' && $row_select_pipe['caste_date2']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date2']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['test_date2']!='' && $row_select_pipe['test_date2']!='0' && $row_select_pipe['test_date2']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date2']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l5']!='' && $row_select_pipe['l5']!='0' && $row_select_pipe['l5']!=null ){ echo $row_select_pipe['l5'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b5']!='' && $row_select_pipe['b5']!='0' && $row_select_pipe['b5']!=null ){ echo $row_select_pipe['b5'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_5']!='' && $row_select_pipe['area_5']!='0' && $row_select_pipe['area_5']!=null ){ echo $row_select_pipe['area_5'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_5']!='' && $row_select_pipe['load_5']!='0' && $row_select_pipe['load_5']!=null ){ echo $row_select_pipe['load_5'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_5']!='' && $row_select_pipe['com_5']!='0' && $row_select_pipe['com_5']!=null ){ echo $row_select_pipe['com_5'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>6</center></b></td>
				<td style="text-align:center;"><?php if($row_select_pipe['caste_date2']!='' && $row_select_pipe['caste_date2']!='0' && $row_select_pipe['caste_date2']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date2']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['test_date2']!='' && $row_select_pipe['test_date2']!='0' && $row_select_pipe['test_date2']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date2']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l6']!='' && $row_select_pipe['l6']!='0' && $row_select_pipe['l6']!=null ){ echo $row_select_pipe['l6'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b6']!='' && $row_select_pipe['b6']!='0' && $row_select_pipe['b6']!=null ){ echo $row_select_pipe['b6'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_6']!='' && $row_select_pipe['area_6']!='0' && $row_select_pipe['area_6']!=null ){ echo $row_select_pipe['area_6'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_6']!='' && $row_select_pipe['load_6']!='0' && $row_select_pipe['load_6']!=null ){ echo $row_select_pipe['load_6'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_6']!='' && $row_select_pipe['com_6']!='0' && $row_select_pipe['com_6']!=null ){ echo $row_select_pipe['com_6'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="9	" style="width:8%;border-right:1px solid;"><b>&nbsp; &nbsp; Age: Days 28 (672 Hrs + 4 Hrs)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>7</center></b></td>
				<td style="text-align:center;"><?php if($row_select_pipe['caste_date3']!='' && $row_select_pipe['caste_date3']!='0' && $row_select_pipe['caste_date3']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date3']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['test_date3']!='' && $row_select_pipe['test_date3']!='0' && $row_select_pipe['test_date3']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date3']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l7']!='' && $row_select_pipe['l7']!='0' && $row_select_pipe['l7']!=null ){ echo $row_select_pipe['l7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b7']!='' && $row_select_pipe['b7']!='0' && $row_select_pipe['b7']!=null ){ echo $row_select_pipe['b7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_7']!='' && $row_select_pipe['area_7']!='0' && $row_select_pipe['area_7']!=null ){ echo $row_select_pipe['area_7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_7']!='' && $row_select_pipe['load_7']!='0' && $row_select_pipe['load_7']!=null ){ echo $row_select_pipe['load_7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_7']!='' && $row_select_pipe['com_7']!='0' && $row_select_pipe['com_7']!=null ){ echo $row_select_pipe['com_7'];}else{echo ' - ';}?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['avg_com_3']!='' && $row_select_pipe['avg_com_3']!='0' && $row_select_pipe['avg_com_3']!=null ){ echo $row_select_pipe['avg_com_3'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>7</center></b></td>
				<td style="text-align:center;"><?php if($row_select_pipe['caste_date3']!='' && $row_select_pipe['caste_date3']!='0' && $row_select_pipe['caste_date3']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date3']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['test_date3']!='' && $row_select_pipe['test_date3']!='0' && $row_select_pipe['test_date3']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date3']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l7']!='' && $row_select_pipe['l7']!='0' && $row_select_pipe['l7']!=null ){ echo $row_select_pipe['l7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b7']!='' && $row_select_pipe['b7']!='0' && $row_select_pipe['b7']!=null ){ echo $row_select_pipe['b7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_8']!='' && $row_select_pipe['area_8']!='0' && $row_select_pipe['area_8']!=null ){ echo $row_select_pipe['area_8'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_8']!='' && $row_select_pipe['load_8']!='0' && $row_select_pipe['load_8']!=null ){ echo $row_select_pipe['load_8'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_8']!='' && $row_select_pipe['com_8']!='0' && $row_select_pipe['com_8']!=null ){ echo $row_select_pipe['com_8'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>7</center></b></td>
				<td style="text-align:center;"><?php if($row_select_pipe['caste_date3']!='' && $row_select_pipe['caste_date3']!='0' && $row_select_pipe['caste_date3']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date3']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['test_date3']!='' && $row_select_pipe['test_date3']!='0' && $row_select_pipe['test_date3']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date3']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l9']!='' && $row_select_pipe['l9']!='0' && $row_select_pipe['l9']!=null ){ echo $row_select_pipe['l9'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b9']!='' && $row_select_pipe['b9']!='0' && $row_select_pipe['b9']!=null ){ echo $row_select_pipe['b9'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_9']!='' && $row_select_pipe['area_9']!='0' && $row_select_pipe['area_9']!=null ){ echo $row_select_pipe['area_9'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_9']!='' && $row_select_pipe['load_9']!='0' && $row_select_pipe['load_9']!=null ){ echo $row_select_pipe['load_9'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_9']!='' && $row_select_pipe['com_9']!='0' && $row_select_pipe['com_9']!=null ){ echo $row_select_pipe['com_9'];}else{echo ' - ';}?></td>
			</tr>
		</table>
		<Br>
		<table align="center" width="90%" class="test1" height="5%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center>6.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Soundness by Le - chatelier</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS 4031 ( P - 3 ) 1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:5%;"></td>
				<td style="text-align:left;"><b>Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if($row_select_pipe['sou_temp']!='' && $row_select_pipe['sou_temp']!='0' && $row_select_pipe['sou_temp']!=null ){ echo $row_select_pipe['sou_temp'];}else{echo ' - ';}?></b></td>
				<td style="text-align:left;"><b>Humidity ( % ) &nbsp; = &nbsp; <?php if($row_select_pipe['sou_humidity']!='' && $row_select_pipe['sou_humidity']!='0' && $row_select_pipe['sou_humidity']!=null ){ echo $row_select_pipe['sou_humidity'];}else{echo ' - ';}?>&nbsp;%</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="2" style="width:25%;border-right:1px solid;"><b><center>Weight of Cement <?php if($row_select_pipe['sou_weight']!='' && $row_select_pipe['sou_weight']!='0' && $row_select_pipe['sou_weight']!=null ){ echo $row_select_pipe['sou_weight'];}else{echo ' - ';}?> gms</center></b></td>
				<td style="border-left:1px solid;width:45%;">
					
				</td>
			</tr>
		</table>
		<table align="center" width="90%" class="test1" height="2%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:40%;border-right:1px solid;"><b><center>Weight of Cement <?php if($row_select_pipe['sou_weight']!='' && $row_select_pipe['sou_weight']!='0' && $row_select_pipe['sou_weight']!=null ){ echo $row_select_pipe['sou_weight'];}else{echo ' - ';}?> gms</center></b></td>
				<td style="width:60%;border-bottom:1px solid;text-align:center;">Water &nbsp; = &nbsp; ( 0.78 &nbsp; x &nbsp; Consistencyin % ) &nbsp; X &nbsp; 2 &nbsp; = &nbsp; <?php if($row_select_pipe['sou_water']!='' && $row_select_pipe['sou_water']!='0' && $row_select_pipe['sou_water']!=null ){ echo $row_select_pipe['sou_water'];}else{echo ' - ';}?> &nbsp;  C.C.</td>
			</tr>
		</table>
		<table align="center" width="90%" class="test1" height="9%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>Sr.No.</center></b></td>
				<td style="width:30%;padding-left:3px;text-align:center;"><b>Distance between two Points<br>after 24 hrs. in water (mm)</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>Reading after 3 hrs. in boiling<br>(mm) </b></td>
				<td style="border-left:1px solid;text-align:center;width:17%;"><b>Difference (mm)</b> </td>
				<td style="border-left:1px solid;text-align:center;width:17%;"><b>Average (mm) </b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>1</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if($row_select_pipe['dis_1_1']!='' && $row_select_pipe['dis_1_1']!='0' && $row_select_pipe['dis_1_1']!=null ){ echo $row_select_pipe['dis_1_1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['dis_2_1']!='' && $row_select_pipe['dis_2_1']!='0' && $row_select_pipe['dis_2_1']!=null ){ echo $row_select_pipe['dis_2_1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['diff_1']!='' && $row_select_pipe['diff_1']!='0' && $row_select_pipe['diff_1']!=null ){ echo $row_select_pipe['diff_1'];}else{echo ' - ';}?></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['soundness']!='' && $row_select_pipe['soundness']!='0' && $row_select_pipe['soundness']!=null ){ echo $row_select_pipe['soundness'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if($row_select_pipe['dis_1_2']!='' && $row_select_pipe['dis_1_2']!='0' && $row_select_pipe['dis_1_2']!=null ){ echo $row_select_pipe['dis_1_2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['dis_2_2']!='' && $row_select_pipe['dis_2_2']!='0' && $row_select_pipe['dis_2_2']!=null ){ echo $row_select_pipe['dis_2_2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['diff_2']!='' && $row_select_pipe['diff_2']!='0' && $row_select_pipe['diff_2']!=null ){ echo $row_select_pipe['diff_2'];}else{echo ' - ';}?></td>
			</tr>
		</table>
		<br>
		<table align="center" width="90%" class="test1" height="Auto" style="margin-top:-1px;">
			<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br><br>
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewed By:</b>
						</div>
					</td>
					<!--<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td-->
				</tr>
		</table>
		<?php 
			include("../include/footer_p.php");
		?>
		<?php 	} ?>
	</page>

</body>

</html>


<script type="text/javascript">


</script>