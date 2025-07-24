<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 30px;
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
	$select_tiles_query = "select * from pozzolonic_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	$branch_name = $row_select['branch_name'];
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

	$cnt = 1;
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

				<tr>
					<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CEMENT</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;"> POZZOLONIC CEMENT</td>
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
								<td style="font-weight: bold;text-align: left;padding: 4px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 4px;width:30%;">FMT-OBS-020</td>
								<td style="font-weight: bold;text-align: left;padding: 4px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 4px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 4px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 4px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 4px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 4px;"><?php echo $mt_name; ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 4px;border: 0;">Type of Pozzolona :-</td>
								<td style="font-weight: bold;padding: 4px;"><?php echo $type_of_cement; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 4px;border: 0;">Identification Mark :-</td>
								<td style="font-weight: bold;padding: 4px;"><?php echo "Cement - ".$in_grade; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 15%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 1727 - 1967</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
		
		<table align="center" width="100%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;padding:4px 3px;" rowspan=2><b><center><?php echo $cnt++;?>.</center></b></td>
				<td style="width:65%;padding:4px 3px;" rowspan=2><b>Consistency Test</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;padding:4px 3px;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:center;width:30%;padding:4px 3px;"><b>IS 1727 - 1967</b></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1" style="margin-top:-1px;">
		    <tr style="border: 1px solid black;">
				<td></td>
				<td style="text-align:center;padding:3px 3px;"><b>Weight of Pozzolonic Material <?php if($row_select_pipe['con_weight']!='' && $row_select_pipe['con_weight']!='0'){ echo $row_select_pipe['con_weight'];}else{echo ' - ';}?> in Prop. 0.2N : 0.8,</b></td>
				<td style="text-align:left;padding:3px 3px;"><b>Temperature &nbsp; = &nbsp; <?php if($row_select_pipe['con_temp']!='' && $row_select_pipe['con_temp']!='0' && $row_select_pipe['con_temp']!=null ){ echo $row_select_pipe['con_temp'];}else{echo ' - ';}?> ( &deg;C )  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Humidity - <?php if($row_select_pipe['con_humidity']!='' && $row_select_pipe['con_humidity']!='0' && $row_select_pipe['con_humidity']!=null ){ echo $row_select_pipe['con_humidity'];}else{echo ' - ';}?>RH</b></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1" height="13%" style="margin-top:-1px;margin-bottom:10px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;padding:3px 3px;"><b><center>Sr.No.</center></b></td>
				<td style="width:32%;padding-left:3px;text-align:center;padding:3px 3px;"><b>Weight/Volume of Water (gm/ml)</b></td>
				<td style="border-left:1px solid;text-align:center;width:32%;padding:3px 3px;"><b>% of Water</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;padding:3px 3px;"><b>Reading on Vicat (mm)</b></td>
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
		
		<table align="center" width="100%" class="test1">
			<tr style="border: 1px solid black;">
				<td style="width:5%;padding:4px 3px;"><b><center><?php echo $cnt++;?>.</center></b></td>
				<td style="width:65%;padding:4px 3px;"><b>Specific Gravity Test</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;padding:4px 3px;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;width:30%;padding:4px 3px;" colspan=2><b>&nbsp;&nbsp;&nbsp;&nbsp; Temperature &nbsp; = &nbsp; <?php if($row_select_pipe['den_temp']!='' && $row_select_pipe['den_temp']!='0' && $row_select_pipe['den_temp']!=null ){ echo $row_select_pipe['den_temp'];}else{echo ' - ';}?> ( &deg;C )  </b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;padding:4px 3px;"><b>IS 1727 - 1967</b></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1" height="13%" style="margin-top:-1px;margin-bottom:10px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;padding:3px 3px;"><b><center>Sr.No.</center></b></td>
				<td style="width:10%;border-right:1px solid;text-align:center;padding:3px 3px;"><b>Weight Sample (g) (W)</b></td>
				<td style="width:10%;border-right:1px solid;text-align:center;padding:3px 3px;"><b>Initial Reading of Kerosene on flask (A)</b></td>
				<td style="width:10%;text-align:center;padding:3px 3px;"><b>Final Reading of Kerosene + Cement on flask (B)</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;padding:3px 3px;"><b>Difference A - B = (C)</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;padding:3px 3px;"><b>Specific Gravity (S) = W/C</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>1</center></b></td>
				<td style="padding-left:3px;text-align:center;">64 gm</td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['den_intial']!='' && $row_select_pipe['den_intial']!='0' && $row_select_pipe['den_intial']!=null ){ echo $row_select_pipe['den_intial'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['den_final']!='' && $row_select_pipe['den_final']!='0' && $row_select_pipe['den_final']!=null ){ echo $row_select_pipe['den_final'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['den_displaced']!='' && $row_select_pipe['den_displaced']!='0' && $row_select_pipe['den_displaced']!=null ){ echo $row_select_pipe['den_displaced'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['density']!='' && $row_select_pipe['density']!='0' && $row_select_pipe['density']!=null ){ echo $row_select_pipe['density'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="padding-left:3px;text-align:center;">64 gm</td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['den_intial1']!='' && $row_select_pipe['den_intial1']!='0' && $row_select_pipe['den_intial1']!=null ){ echo $row_select_pipe['den_intial1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['den_final1']!='' && $row_select_pipe['den_final1']!='0' && $row_select_pipe['den_final1']!=null ){ echo $row_select_pipe['den_final1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['den_displaced1']!='' && $row_select_pipe['den_displaced1']!='0' && $row_select_pipe['den_displaced1']!=null ){ echo $row_select_pipe['den_displaced1'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['density1']!='' && $row_select_pipe['density1']!='0' && $row_select_pipe['density1']!=null ){ echo $row_select_pipe['density1'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>3</center></b></td>
				<td style="padding-left:3px;text-align:center;">64 gm</td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['den_intial2']!='' && $row_select_pipe['den_intial2']!='0' && $row_select_pipe['den_intial2']!=null ){ echo $row_select_pipe['den_intial2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['den_final2']!='' && $row_select_pipe['den_final2']!='0' && $row_select_pipe['den_final2']!=null ){ echo $row_select_pipe['den_final2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['den_displaced2']!='' && $row_select_pipe['den_displaced2']!='0' && $row_select_pipe['den_displaced2']!=null ){ echo $row_select_pipe['den_displaced2'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['density2']!='' && $row_select_pipe['density2']!='0' && $row_select_pipe['density2']!=null ){ echo $row_select_pipe['density2'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;border-width:1px 1px 0 0;">
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="padding-left:3px;text-align:center;border-left:1px solid;border-bottom:1px solid;">Average &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
				<td style="border-left:1px solid;text-align:center;border-bottom:1px solid;"><?php if($row_select_pipe['avg_density']!='' && $row_select_pipe['avg_density']!='0' && $row_select_pipe['avg_density']!=null ){ echo $row_select_pipe['avg_density'];}else{echo ' - ';}?></td>
			</tr>
		</table>
		
		<table align="center" width="100%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;padding:4px 3px;"><b><center><?php echo $cnt++;?>.</center></b></td>
				<td style="width:65%;padding:4px 3px;"><b>Specific surface area m <sup>2</sup> / Kg.</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;adding:4px 3px;"><b>IS 4031(P-2) &nbsp;  &nbsp;  1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style=""></td>
				<td style="text-align:left;padding:4px 3px;"><b>Test Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if($row_select_pipe['fine_temp']!='' && $row_select_pipe['fine_temp']!='0' && $row_select_pipe['fine_temp']!=null ){ echo $row_select_pipe['fine_temp'];}else{echo ' - ';}?></b></td>
				<td style="text-align:left;padding:4px 3px;"><b>Humidity(%) - Min. <?php if($row_select_pipe['fine_humidity']!='' && $row_select_pipe['fine_humidity']!='0' && $row_select_pipe['fine_humidity']!=null ){ echo $row_select_pipe['fine_humidity'];}else{echo ' - ';}?>%</b></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1" height="13%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td colspan="2" style="width:20%;border-right:1px solid;padding:4px 3px;"><b><center>Time in Seconds (T)</center></b></td>
				<td colspan="2" style="width:80%;padding-left:5px;padding:4px 3px;"><b>Specific surface area of Standard Cement in cm<sup>2</sup> /g, S<sub>o</sub></b></td>
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
		<table align="center" width="100%" class="test1" height="Auto" style="margin-top:-2px;border:1px solid;border-top:0px;">
						<tr>
							<td width="35" rowspan="2">&nbsp;  Specific Surface area		S	=	521.08 &times; K </td>
							<td width="5" style="text-align:center;"> &#8730; t<sub>o</sub></td>
							<td width="60" rowspan="2"> &nbsp; &nbsp; &nbsp;  &nbsp; = &nbsp; &nbsp; &nbsp;  <?php if($row_select_pipe['ss_area']!='' && $row_select_pipe['ss_area']!='0' && $row_select_pipe['ss_area']!=null ){ echo ($row_select_pipe['ss_area'] * 10);}else{echo ' - ';}?> cm<sup>2</sup>/g &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; =   &nbsp; &nbsp; &nbsp;<?php if($row_select_pipe['ss_area']!='' && $row_select_pipe['ss_area']!='0' && $row_select_pipe['ss_area']!=null ){ echo $row_select_pipe['ss_area'];}else{echo ' - ';}?>&nbsp;  m<sup>2</sup> / kg</td>
						</tr>
						<tr>
							<td style="text-align:center;border-top:1px solid;">&#8730; ƍ<sub>o</sub></td>
						</tr>
						
		</table>
		<table align="center" width="100%" class="test1" height="Auto" style="margin-bottom:10px;">
			<tr>
				<td style="padding-left:10px;"><br>Where,  &nbsp;&#8730; 0.1 η<sub>o</sub> = the Viscosity of air at the test temperature taken from Table 1 (IS 4031 Part – 2)</td>
			</tr>	
		</table>
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
                            <td style="height: 15px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
                        </tr>
                       
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  02</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :-  <?php echo date('d/m/Y', strtotime($row_select_pipe["amend_date"])); ?></td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 2</td>
                        </tr>
                       
                    </table>
                </td>
            </tr>
		</table>


		<?php
			}
		if(($row_select_pipe['final_time']!="" && $row_select_pipe['final_time']!="0" && $row_select_pipe['final_time']!=null) || ($row_select_pipe['avg_com_1']!="" && $row_select_pipe['avg_com_1']!="0" && $row_select_pipe['avg_com_1']!=null) || ($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null))
					{
						$pagecnt++;
		?>

		<div class="pagebreak"> </div>
		<br><br>

				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CEMENT</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;"> POZZOLONIC CEMENT</td>
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
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 5px;width:30%;">FMT-OBS-020</td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $mt_name; ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Type of Pozzolona :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $type_of_cement; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Identification Mark :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo "Cement - ".$in_grade; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 15%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 1727 - 1967</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
		<br>


		<table align="center" width="100%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;padding:4px 3px;" rowspan=2><b><center><?php echo $cnt++;?>.</center></b></td>
				<td style="width:65%;padding:4px 3px;" rowspan=2><b>Compressive Strength</b></td>
				<td style="border-left:1px solid;text-align:left;width:30%;padding:4px 3px;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;width:30%;padding:4px 3px;"><b>Pozzolonic Material</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:left;padding:4px 3px;" colspan=2><b>&nbsp; &nbsp; Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if($row_select_pipe['com_temp']!='' && $row_select_pipe['com_temp']!='0' && $row_select_pipe['com_temp']!=null ){ echo $row_select_pipe['com_temp'];}else{echo ' - ';}?></b></td>
				<td style="text-align:left;padding:4px 3px;"><b>Humidity  &nbsp; = &nbsp; <?php if($row_select_pipe['com_humidity']!='' && $row_select_pipe['com_humidity']!='0' && $row_select_pipe['com_humidity']!=null ){ echo $row_select_pipe['com_humidity'];}else{echo ' - ';}?>&nbsp;RH</b></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="border-right:0px solid;padding:6px 3px;width:65%;"><b>&nbsp; &nbsp; Age - 168 Hrs &#177; 2 Hr.</b></td>
				<td style="border-left:0px solid;padding:6px 3px;width:35%;"><b>&nbsp; &nbsp; End curing Date & temp. - &nbsp;&nbsp;   &   &nbsp;&nbsp; &deg;C</b></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;padding:4px 3px;"><b><center>Sr.No.</center></b></td>
				<td style="width:11%;text-align:center;padding:4px 3px;"><b>Date of<br>Casting</b></td>
				<td style="border-left:1px solid;text-align:center;width:11%;padding:4px 3px;"><b>Date of<br>Testing</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;padding:4px 3px;"><b>Length<br>(L)<br>mm</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;padding:4px 3px;"><b>Width<br>(B)<br>mm</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;padding:4px 3px;"><b>Area<br>mm<sup>2</sup></b></td>
				<td style="border-left:1px solid;text-align:center;width:14%;padding:4px 3px;"><b>Load (KN)</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;padding:4px 3px;"><b>Comp. Strength<br>(N/mm<sup>2</sup>)</b></td>
				<td style="border-left:1px solid;text-align:center;width:14%;padding:4px 3px;"><b>Avg. Comp.<br>Strength<br>(N/mm<sup>2</sup>)</b></td>
			
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>1</center></b></td>
				<td style="text-align:center;" rowspan=3><?php if($row_select_pipe['caste_date2']!='' && $row_select_pipe['caste_date2']!='0' && $row_select_pipe['caste_date2']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date2']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"  rowspan=3><?php if($row_select_pipe['test_date2']!='' && $row_select_pipe['test_date2']!='0' && $row_select_pipe['test_date2']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date2']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l4']!='' && $row_select_pipe['l4']!='0' && $row_select_pipe['l4']!=null ){ echo $row_select_pipe['l4'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b4']!='' && $row_select_pipe['b4']!='0' && $row_select_pipe['b4']!=null ){ echo $row_select_pipe['b4'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_4']!='' && $row_select_pipe['area_4']!='0' && $row_select_pipe['area_4']!=null ){ echo $row_select_pipe['area_4'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_4']!='' && $row_select_pipe['load_4']!='0' && $row_select_pipe['load_4']!=null ){ echo $row_select_pipe['load_4'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_4']!='' && $row_select_pipe['com_4']!='0' && $row_select_pipe['com_4']!=null ){ echo $row_select_pipe['com_4'];}else{echo ' - ';}?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['avg_com_2']!='' && $row_select_pipe['avg_com_2']!='0' && $row_select_pipe['avg_com_2']!=null ){ echo $row_select_pipe['avg_com_2'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l5']!='' && $row_select_pipe['l5']!='0' && $row_select_pipe['l5']!=null ){ echo $row_select_pipe['l5'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b5']!='' && $row_select_pipe['b5']!='0' && $row_select_pipe['b5']!=null ){ echo $row_select_pipe['b5'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_5']!='' && $row_select_pipe['area_5']!='0' && $row_select_pipe['area_5']!=null ){ echo $row_select_pipe['area_5'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_5']!='' && $row_select_pipe['load_5']!='0' && $row_select_pipe['load_5']!=null ){ echo $row_select_pipe['load_5'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_5']!='' && $row_select_pipe['com_5']!='0' && $row_select_pipe['com_5']!=null ){ echo $row_select_pipe['com_5'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>3</center></b></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l6']!='' && $row_select_pipe['l6']!='0' && $row_select_pipe['l6']!=null ){ echo $row_select_pipe['l6'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b6']!='' && $row_select_pipe['b6']!='0' && $row_select_pipe['b6']!=null ){ echo $row_select_pipe['b6'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_6']!='' && $row_select_pipe['area_6']!='0' && $row_select_pipe['area_6']!=null ){ echo $row_select_pipe['area_6'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_6']!='' && $row_select_pipe['load_6']!='0' && $row_select_pipe['load_6']!=null ){ echo $row_select_pipe['load_6'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_6']!='' && $row_select_pipe['com_6']!='0' && $row_select_pipe['com_6']!=null ){ echo $row_select_pipe['com_6'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan=6 style="width:8%;border-right:0px solid;padding:6px 3px;"><b>&nbsp; &nbsp; Age - 672 Hrs &#177; 4 Hr.</b></td>
				<td colspan=3 style="border-left:0px solid;padding:6px 3px;text-align:center;"><b>&nbsp; &nbsp; End curing Date & temp. - &nbsp;&nbsp;   &   &nbsp;&nbsp; &deg;C</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;padding:4px 3px;"><b><center>Sr.No.</center></b></td>
				<td style="width:11%;text-align:center;padding:4px 3px;"><b>Date of<br>Casting</b></td>
				<td style="border-left:1px solid;text-align:center;width:11%;padding:4px 3px;"><b>Date of<br>Testing</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;padding:4px 3px;"><b>Length<br>(L)<br>mm</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;padding:4px 3px;"><b>Width<br>(B)<br>mm</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;padding:4px 3px;"><b>Area<br>mm<sup>2</sup></b></td>
				<td style="border-left:1px solid;text-align:center;width:14%;padding:4px 3px;"><b>Load (KN)</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;padding:4px 3px;"><b>Comp. Strength<br>(N/mm<sup>2</sup>)</b></td>
				<td style="border-left:1px solid;text-align:center;width:14%;padding:4px 3px;"><b>Avg. Comp.<br>Strength<br>(N/mm<sup>2</sup>)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>1</center></b></td>
				<td style="text-align:center;"  rowspan=3><?php if($row_select_pipe['caste_date3']!='' && $row_select_pipe['caste_date3']!='0' && $row_select_pipe['caste_date3']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['caste_date3']));}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"  rowspan=3><?php if($row_select_pipe['test_date3']!='' && $row_select_pipe['test_date3']!='0' && $row_select_pipe['test_date3']!=null ){ echo Date('d-m-Y',strtotime($row_select_pipe['test_date3']))	;}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l7']!='' && $row_select_pipe['l7']!='0' && $row_select_pipe['l7']!=null ){ echo $row_select_pipe['l7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b7']!='' && $row_select_pipe['b7']!='0' && $row_select_pipe['b7']!=null ){ echo $row_select_pipe['b7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_7']!='' && $row_select_pipe['area_7']!='0' && $row_select_pipe['area_7']!=null ){ echo $row_select_pipe['area_7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_7']!='' && $row_select_pipe['load_7']!='0' && $row_select_pipe['load_7']!=null ){ echo $row_select_pipe['load_7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_7']!='' && $row_select_pipe['com_7']!='0' && $row_select_pipe['com_7']!=null ){ echo $row_select_pipe['com_7'];}else{echo ' - ';}?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['avg_com_3']!='' && $row_select_pipe['avg_com_3']!='0' && $row_select_pipe['avg_com_3']!=null ){ echo $row_select_pipe['avg_com_3'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l7']!='' && $row_select_pipe['l7']!='0' && $row_select_pipe['l7']!=null ){ echo $row_select_pipe['l7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b7']!='' && $row_select_pipe['b7']!='0' && $row_select_pipe['b7']!=null ){ echo $row_select_pipe['b7'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_8']!='' && $row_select_pipe['area_8']!='0' && $row_select_pipe['area_8']!=null ){ echo $row_select_pipe['area_8'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_8']!='' && $row_select_pipe['load_8']!='0' && $row_select_pipe['load_8']!=null ){ echo $row_select_pipe['load_8'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_8']!='' && $row_select_pipe['com_8']!='0' && $row_select_pipe['com_8']!=null ){ echo $row_select_pipe['com_8'];}else{echo ' - ';}?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>3</center></b></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['l9']!='' && $row_select_pipe['l9']!='0' && $row_select_pipe['l9']!=null ){ echo $row_select_pipe['l9'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['b9']!='' && $row_select_pipe['b9']!='0' && $row_select_pipe['b9']!=null ){ echo $row_select_pipe['b9'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['area_9']!='' && $row_select_pipe['area_9']!='0' && $row_select_pipe['area_9']!=null ){ echo $row_select_pipe['area_9'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['load_9']!='' && $row_select_pipe['load_9']!='0' && $row_select_pipe['load_9']!=null ){ echo $row_select_pipe['load_9'];}else{echo ' - ';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($row_select_pipe['com_9']!='' && $row_select_pipe['com_9']!='0' && $row_select_pipe['com_9']!=null ){ echo $row_select_pipe['com_9'];}else{echo ' - ';}?></td>
			</tr>
		</table>
		<Br>
		<table align="center" width="100%" class="test1" style="margin-top:-1px;">
		  	<tr><td style="font-size:15px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Normal mortar Compressive Strength at 28 days  <u></u>  N/mm<sup>2</sup></b></td></tr>
		</table>
		<Br><Br>

		<table align="center" width="100%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;padding:6px 3px;" rowspan=2><b><center><?php echo $cnt++;?>.</center></b></td>
				<td style="width:65%;padding:6px 3px;" rowspan=2><b>Residue on 45 Micron Sieve (Wet Analysis)</b></td>
				<td style="border-left:1px solid;text-align:left;width:30%;padding:6px 3px;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;width:30%;padding:6px 3px;"><b>Pozzolonic Material</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:left;padding:8px 3px;" colspan=2><b>&nbsp; &nbsp; Temperature ( &deg;C ) &nbsp; - &nbsp; <?php if($row_select_pipe['com_temp']!='' && $row_select_pipe['com_temp']!='0' && $row_select_pipe['com_temp']!=null ){ echo $row_select_pipe['com_temp'];}else{echo ' - ';}?></b></td>
				<td style="text-align:left;padding:8px 3px;"><b>Humidity  &nbsp; - &nbsp; <?php if($row_select_pipe['com_humidity']!='' && $row_select_pipe['com_humidity']!='0' && $row_select_pipe['com_humidity']!=null ){ echo $row_select_pipe['com_humidity'];}else{echo ' - ';}?>&nbsp;RH</b></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1" style="margin-top:-1px;">
		  	<tr style="border: 1px solid black;">
				<td style="padding:8px 3px;border-right:1px solid;"><b>1. Initial Weight of Sample , gms</b></td>
				<td style="padding:8px 10px;width:20%;"><b><?php echo $row_select_pipe['w1_1']; ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="padding:8px 3px;border-right:1px solid;"><b>2. Final Weight of Sample (Retained on 45 mic. Sieving), gms</b></td>
				<td style="padding:8px 10px;"><b><?php echo $row_select_pipe['w2_1']; ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="padding:8px 3px;border-right:1px solid;"><b>Residue on 45 micron Sieve , %</b></td>
				<td style="padding:8px 10px;"><b><?php echo $row_select_pipe['avg_wet']; ?></b></td>
			</tr>
		</table>
		<br>
		
		<table align="center" width="100%" class="test1" height="Auto" style="margin-top:-1px;">
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
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  02</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :-  <?php echo date('d/m/Y', strtotime($row_select_pipe["amend_date"])); ?></td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 2 of 2</td>
                        </tr>
                       
                    </table>
                </td>
            </tr>
		</table>
		<?php 	} ?>
	</page>

</body>

</html>


<script type="text/javascript">


</script>