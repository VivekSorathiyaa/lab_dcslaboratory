<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin:30px 40px;
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
		font-size: 10px;
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

		font-size: 11px;
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
	$select_tiles_query = "select * from core_cutter WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$branch_name = $row_select['branch_name'];
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
		$chainage_no = $row_select4['chainage_no'];
		$type_method = $row_select4['type_method'];
		$soil_location = $row_select4['soil_location'];
	}

	?>

<br><br>
<page size="A4">
	    
<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse; ">
            <!-- header design -->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
                        <tr>
                            <td style="padding: 1px;border: 1px solid;"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;">Soil Field</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;"></td>
                        </tr>
						<tr>
                            <td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;">IN Situ Density by Core Cutter Method</td>
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
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;">Format No :-</td>
                            <td style="padding: 5px;">FMT-OBS-021</td>
                            <td style="font-weight: bold;">Sheet No:- </td>
                            <td><?php echo $row_select_pipe["sheet"] ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Job No :-</td>
                            <td style="padding: 5px;"><?php echo $job_no; ?></td>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;">Testing Date :-</td>
                            <td style="padding: 5px;"><?php echo date('d/m/Y', strtotime($start_date)); ?>&nbsp; To &nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
                            <td style="padding: 5px;"><?php echo $mt_name; ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="4"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 10%;">Test Method :-</td>
                            <td style="padding: 5px;border-left: 1px solid;">As Per IS : 2720 (Part - 29) : 1975 Reaffirmed : 2020, Clause No.3 & IS :2720 (Part-2):1973, <br> Clause No. 5</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="6"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;width: 8%;" colspan="6">Observation Table</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="6"></td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="6">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>


			<!-- Table Start -->

			<tr>
                <td>
                    <?php $cnt=1; ?>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-bottom:1px solid;">
                        <tr>
						    <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; width:4%;" rowspan="2" >Sr. No.</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;width:40%;" rowspan="2"> Description </td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;width:8%;" rowspan="2">Unit</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" colspan="3">Results</td>
						</tr>
						<tr>
						    <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;width: 15%;">i</td>
						    <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;width: 15%;">ii</td>
						    <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;width: 10%;">iii</td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Weight of Core Cutter and Wet Soil - <b>W<sub>s</sub></b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">gm</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["field_mdd"] ?></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["field_mdd1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["field_mdd2"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Weight of Core Cutter - <b>W<sub>c</sub></b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">gm</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["chainage_no"] ?></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["chainage_no1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["chainage_no2"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Weight Wet Soil - <b>W<sub>w</sub> = W<sub>s</sub> - W<sub>c</sub></b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">gm</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["empty_core"] ?></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["empty_core1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["empty_core2"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Volume of Core Cutter - <b>V<sub>c</sub> = ℼ/4*D<sup>2</sup>*H</b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">cm<sup>3</sup></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_core"] ?></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_core1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["vol_core2"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Bulk Density of Soil - γ<sub>b</sub>= W<sub>w</sub>/V<sub>c</sub></b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">gm/cm<sup>3</sup></td?>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["soil_core"]?>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["soil_core1"]?>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["soil_core2"]?>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Container Number</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">No.</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_soil_core"] ?></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_soil_core1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wet_soil_core2"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Weight of Container - <b>W<sub>1</sub></b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">gm</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["con_weight"] ?></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["con_weight1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["con_weight2"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Weight of Container With Wet Soil - <b>W<sub>2</sub></b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">gm</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wt_con_wt_soil"] ?></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wt_con_wt_soil1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wt_con_wt_soil2"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Weight of Container With Dry Soil - <b>W<sub>3</sub></b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">gm</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wt_con_dry_soil"] ?></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wt_con_dry_soil1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wt_con_dry_soil2"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Field Moisture Content - W = (W<sub>2</sub> - W<sub>3</sub>)/(W<sub>3</sub> - W<sub>1</sub>)*100</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">%</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdd_2"] ?></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdd_2_1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdd_2_2"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;">Field Dry Density - γ<sub>d</sub> = (100γ<sub>b</sub>/100+W)</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">gm/cm<sup>3</sup></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdd_3"] ?></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdd_3_1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["fdd_3_2"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;"><b>Average of Field Moisture Content</b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">%</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;" colspan="3"><?php echo $row_select_pipe["avg_moi"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;"><b>Average of Field Dry Density</b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">gm/cm<sup>3</sup></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;" colspan="3"><?php echo $row_select_pipe["avg_dry"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="text-align: left;padding: 2px;border: 1px solid;"><b>Maximum Dry Density (MDD)</b></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">gm/cm<sup>3</sup></td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;" colspan="3"><?php echo $row_select_pipe["mdd_1"] ?></td>
						</tr>
						<tr>
						    <td style="text-align: center;padding: 2px;border: 1px solid; width:15%;"><?php echo $cnt++; ?></td>
						    <td style="font-weight: bold;text-align: left;padding: 2px;border: 1px solid;">Percentage of Compaction - (FDD / MDD)x 100</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;">%</td>
						    <td style="text-align: center;padding: 2px;border: 1px solid;" colspan="3"><?php echo $row_select_pipe["fdd_4"] ?></td>
						</tr>
					</table>
				</td>
			</tr>

			
			<!-- footer design -->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; border-left:1px solid;border-right:1px solid; ">
                        <tr>
                            <td colspan="" style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; border-right:1px solid" >Remarks :-</td>
							<td colspan="3" style="border-top:1px solid; border-bottom:1px solid;">&nbsp;<?php echo $row_select_pipe["remark"] ?></td>
						</tr>
						<tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; border-right:1px solid; border-top:1px solid; border-bottom:1px solid; width:15%" >Checked By :-</td>
							<td  style="border-top:1px solid; border-bottom:1px solid;"></td>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; border-right:1px solid; border-top:1px solid; border-bottom:1px solid; width:15%" >Tested By :-</td>
							<td  style="border-top:1px solid; border-bottom:1px solid;"></td>	
						</tr>
						<tr>
							<td style="height: 40px;border: 1px solid;font-weight: bold;border-right: 1px solid; padding: 5px; border-bottom:0px; border-top:2px solid; "colspan="4"></td>
						</tr>
                    </table>
                </td>
            </tr>
            <!--<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
							</tr>
							<tr>
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
							</tr>
						
						</table>
					</td>
				</tr>-->
        </table>


		
</page>	
		

		<!--
		<table align="center" width="100%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>GOMA ENGINEERING AND CONSULTANCY</b></center>
				</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
			</tr>
			<tr>

				<td rowspan="3" style="font-size:12px;border: 1px solid black;">
					<center><b>Field Dry Density Test By Core Cutter Method IS 2720 (Part 29) : 1975</b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>
			</tr>
			<tr>


				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>
			</tr>

		</table>
		<br>
		
		<table align="center" width="90%" class="test1" height="5%">

			<tr>
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="width:20%;"><b>Laboratory No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $job_no; ?></td>
				<td style="text-align:center;width:5%;"><b>5</b></td>
				<td style="width:20%;"><b>Date of start</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>

			</tr>
			<tr>
				<td style="text-align:center;width:5%;"><b>2</b></td>
				<td style="width:20%;"><b>Job No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['lab_no']; ?></td>
				<td style="text-align:center;width:5%;"><b>6</b></td>
				<td style="width:20%;"><b>Date of Completion</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d/m/Y', strtotime($end_date)); ?></td>

			</tr>
			<tr>
				<td style="text-align:center;width:5%;"><b>3</b></td>
				<td style="width:20%;"><b>Type of Material</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['type_method']; ?></td>
				<td style="text-align:center;width:5%;"><b>7</b></td>
				<td style="width:20%;"><b>Lab Density of Material (MDD)</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['field_mdd']; ?> g/cc</td>

			</tr>
			<tr>
				<td style="text-align:center;width:5%;"><b>4</b></td>
				<td><b>Size of Core Cutter Mould</b></td>
				<td><b>:-</b></td>
				<td style="text-align:right;"><b>Height -</b> <u>130 &plusmn; 0.25 mm</u></td>
				<td style="text-align:center;width:5%;"><b>&nbsp;</b></td>
				<td style="width:20%;"><b>&nbsp;</b></td>
				<td style="width:5%;"><b>&nbsp;</b></td>
				<td style="width:20%;">&nbsp;</td>

			</tr>
			<tr>
				<td style="text-align:center;width:5%;"><b></b></td>
				<td><b></b></td>
				<td><b></b></td>
				<td style="text-align:right;"><b>Dia. -</b> <u>100 &plusmn; 0.25 mm</u></td>
				<td style="text-align:center;width:5%;"><b>&nbsp;</b></td>
				<td style="width:20%;"><b>&nbsp;</b></td>
				<td style="width:5%;"><b>&nbsp;</b></td>
				<td style="width:20%;">&nbsp;</td>

			</tr>



		</table>
		<Br>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="47%">
			<tr style="text-align:center;font-weight:bold;">
				<td style="border: 1px solid black;width:11%;border-bottom: 2px solid black;border-left: 2px solid black;">Sr. No.</td>
				<td style="border: 1px solid black;width:50%;border-bottom: 2px solid black;border-left: 2px solid black;">TESTING</td>
				<td style="border: 1px solid black;width:39%;border-bottom: 2px solid black;border-left: 2px solid black;">1</td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">1</td>
				<td style="border: 1px solid black;text-align:left;border-left: 2px solid black;">Chainage No.</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php echo $chainage_no; ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;text-align:left;border-left: 2px solid black;">Wt. of Empty Core Cutter (gm) (W<sub>1</sub>)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['empty_core'] != "" && $row_select_pipe['empty_core'] != "0" && $row_select_pipe['empty_core'] != null) {
																						echo $row_select_pipe['empty_core'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;text-align:left;border-left: 2px solid black;">Vol. of Core Cutter (cc) (V)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['vol_core'] != "" && $row_select_pipe['vol_core'] != "0" && $row_select_pipe['vol_core'] != null) {
																						echo $row_select_pipe['vol_core'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">4</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Soil + Core Cutter (gm) (W<sub>2</sub>)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['soil_core'] != "" && $row_select_pipe['soil_core'] != "0" && $row_select_pipe['soil_core'] != null) {
																						echo $row_select_pipe['soil_core'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">5</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Wet Soil (gm) (W<sub>3</sub>) = (W<sub>2</sub>) - (W<sub>1</sub>)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['wet_soil_core'] != "" && $row_select_pipe['wet_soil_core'] != "0" && $row_select_pipe['wet_soil_core'] != null) {
																						echo $row_select_pipe['wet_soil_core'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">6</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wet Density (gm/cc) W<sub>4</sub> = W<sub>3</sub> / V</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['fdd_1'] != "" && $row_select_pipe['fdd_1'] != "0" && $row_select_pipe['fdd_1'] != null) {
																						echo $row_select_pipe['fdd_1'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">7</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Moisture Content from Moisture Meter W(%)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['mc_soil'] != "" && $row_select_pipe['mc_soil'] != "0" && $row_select_pipe['mc_soil'] != null) {
																						echo $row_select_pipe['mc_soil'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">8</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Container No.</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['con_no'] != "" && $row_select_pipe['con_no'] != "0" && $row_select_pipe['con_no'] != null) {
																						echo $row_select_pipe['con_no'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">9</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Container Empty wt. (gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['con_weight'] != "" && $row_select_pipe['con_weight'] != "0" && $row_select_pipe['con_weight'] != null) {
																						echo $row_select_pipe['con_weight'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">10</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Container + Wet soil(gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['wt_con_wt_soil'] != "" && $row_select_pipe['wt_con_wt_soil'] != "0" && $row_select_pipe['wt_con_wt_soil'] != null) {
																						echo $row_select_pipe['wt_con_wt_soil'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">11</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Container + Dry soil(gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['wt_con_dry_soil'] != "" && $row_select_pipe['wt_con_dry_soil'] != "0" && $row_select_pipe['wt_con_dry_soil'] != null) {
																						echo $row_select_pipe['wt_con_dry_soil'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">12</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Moisture Content from Oven Dry W(%)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['fdd_2'] != "" && $row_select_pipe['fdd_2'] != "0" && $row_select_pipe['fdd_2'] != null) {
																						echo $row_select_pipe['fdd_2'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">13</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Field Dry Density (gm/cc) D<sub>Dry</sub> = W<sub>4</sub> / ( 1 + (w/100))</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['fdd_3'] != "" && $row_select_pipe['fdd_3'] != "0" && $row_select_pipe['fdd_3'] != null) {
																						echo $row_select_pipe['fdd_3'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">14</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Compaction (%) = (D<sub>Dry</sub>/ MDD) x 100</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['fdd_4'] != "" && $row_select_pipe['fdd_4'] != "0" && $row_select_pipe['fdd_4'] != null) {
																						echo $row_select_pipe['fdd_4'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr> 			
			<br>
		</table>
		<br>
		-->	

</body>

</html>


<script type="text/javascript">
	
</script>