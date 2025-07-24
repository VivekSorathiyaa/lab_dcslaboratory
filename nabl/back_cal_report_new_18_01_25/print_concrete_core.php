<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 25px;
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
	$select_tiles_query = "select * from concrete_core WHERE `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);
	$amend_date = $row_select_pipe['amend_date'];


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
		$source = $row_select4['agg_source'];
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	?>

<br>
	<br>
	<br>
	<br>
	<br>
		<page size="A4">
			
		<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
            <!-- header design -->
            <tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: REE/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 1</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:85%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:15%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:100px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:85%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:85%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON CONCRETE CORE</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
            <!-- table design -->
            <tr>
                <td>
                    <?php $cnt=1; ?>
					<!--<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 1PX SOLID;width: 8%;" colspan="2"></td>
						</tr>
						<tr>
							<td style="text-align:center;font-weight:bold;padding: 1px;border: 1px solid;" colspan="2">COMPRESSIVE STRENGTH</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="2">&nbsp;</td>
						</tr>
					</table>-->
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr style="border: 1px solid black;">
				<td colspan="16" style="border: 0px solid black;text-align:center;"><b>COMPRESSIVE STRENGTH (IS : 516 - 1959)</b></td>
			</tr>
					  <tr>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;writing-mode: vertical-lr; transform:rotate(-180deg);" rowspan="4">Sr. No.</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;border-bottom: 2px solid;" rowspan="4">Casting Date of Specimen</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;border-bottom: 2px solid;" rowspan="4">Testing Date of Specimen</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;" rowspan="3">Age of Concrete Sample (Days)</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;border-bottom: 2px solid;" rowspan="4">Chain age/ Location of test specimen</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; width:30%; " colspan="3"><br>Dimensions of Specimen <br> (Cylindrical Piece) <br><br></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;" rowspan="3">Height / Diameter ratio</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;" rowspan="3">Correction Factor for <br>Height/Diameter Ratio</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;" rowspan="3">Maximum Observed Failure Load</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;" rowspan="3">Compressive Strength</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;" rowspan="3">Corrected Compressive Strength</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;" rowspan="3">Equivalent cube strength of <br>Concrete</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;" rowspan="3">Weight</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); width:6.5%; height:20%;" rowspan="3">Density</td>
							
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg); " rowspan="2">Height</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg);" rowspan="2">Diameter <br>(Lateral dimensions)</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; writing-mode: vertical-lr; transform:rotate(-180deg);" rowspan="2">Area</td>
                        </tr>
                        <tr>
                           
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">Day</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">mm<sup>2</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">--</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">--</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">KN</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">N/mm<sup>2</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">N/mm<sup>2</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">N/mm<sup>2</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">gm</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">gm/cm<sup>3</sup></td>

                        </tr>
                        <?php
						$select_tilesy = "select * from concrete_core WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						// $coming_row = mysqli_num_rows($result_tiles_select1);
						$count=0;
						$flag=1;
						$sunoco=0;
						if(mysqli_num_rows($result_tiles_select1)>0){
						while ($row_select_pipe = mysqli_fetch_assoc($result_tiles_select1)) {
							$sunoco += floatval($row_select_pipe['eq_cube1']);
						?>

                        <tr>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;width: 18%;"><?php echo date('d/m/Y', strtotime($row_select_pipe["casting_date"])); ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;width: 18%;"><?php echo date('d/m/Y', strtotime($end_date)); ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["age1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["location1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["height1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["dia1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["area1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hd_ratio1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["hd_corr1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["load1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["corr_com1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["eq_cube1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["weight1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["den1"] ?></td>
                        </tr>
                        <?php
							
						}
						}

						
						?>
                        
                    </table>
                </td>
            </tr>
            <!-- footer design -->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 2px;border-left: 2px solid;width: 12%;">Remarks :-</td>
                            <td style="padding: 2px;border-left: 1px solid;border: 1px solid;border: 1px solid;text-align: left;" colspan="3"><?php echo $row_select_pipe["re1"] ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 2px;width: 8%;border-left: 2px solid;border-top: 1px solid;width: 12%;">Checked By :-</td>
                            <td style="padding: 2px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;width: 8%;border: 1px solid;width: 12%;">Tested By :-</td>
                            <td style="padding: 2px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
                        </tr>
                        <tr>
                            <td style="height: 45px;border: 2px solid;border-right: 1px solid;" colspan="4"></td>
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

</body>

</html>


<!-- <script type="text/javascript">
	window.print();
</script> -->