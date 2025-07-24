<?php 
session_start();
include("../connection.php");
error_reporting(1);?>
<style>
@page { margin: 0 40px; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
  width: 29.7cm;
  height: 21cm;  
} 

</style>
<style>
.tdclass{
    border: 1px solid black;
    font-size:11px;
	 font-family : Calibri;
}
.test {
   border-collapse: collapse;
	font-size:12px;
	 font-family : Calibri;
}
.test1 {
   font-size:12px;
   border-collapse: collapse;
	 font-family : Calibri;
	 
}
	.tdclass1{
    
    font-size:11px;
	 font-family : Calibri;
}
.details{
	margin:0px auto;
	padding:0px;
}
</style>
<html>
	<body>
						<?php
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from admixture WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			$r_name= $row_select['refno'];
			$sr_no= $row_select['sr_no'];
			$sample_no= $row_select['job_no'];
			$rec_sample_date= $row_select['sample_rec_date'];	
			$cons= $row_select['condition_of_sample_receved'];
			$branch_name = $row_select['branch_name'];			
			$type_of_material= $row_select['type_of_material'];			
			if($cons == 0)
			{
				$con_sample = "Sealed Ok";
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
			
			$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
			$result_select2 = mysqli_query($conn, $select_query2);

			if (mysqli_num_rows($result_select2) > 0) {
				$row_select2 = mysqli_fetch_assoc($result_select2);
				$start_date= $row_select2['start_date'];
				$end_date= $row_select2['end_date'];
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
					$mark= $row_select4['brick_mark'];
					$brick_specification= $row_select4['brick_specification'];
				}
		?>
		

		<br>
	<br>
	<br>
	<br>
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
                            <td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;">ADMIXTURE</td>
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
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;">Job No :- </td>
                            <td style="padding: 5px;"> <?php echo $lab_no; ?></td>
						
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;">Format No :-</td>
                            <td style="padding: 5px;"> ICT-ADX-TST-01</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
                            <td style="padding: 5px;"> <?php echo $sample_id; ?></td>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;"></td>
                            <td style="padding: 5px;"></td>
                        </tr>
						<tr>
                            <td colspan="2" style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Testing Date :-</td>
                            <td colspan="2" style="padding: 5px;"><?php echo date('d/m/Y', strtotime($start_date)); ?>&nbsp; To &nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
                            <td colspan="2" style="padding: 5px;"><?php echo $mt_name; ?></td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                  
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr>
				<td colspan="4" style="border: 1px solid black; padding: 5px;text-align:center">&nbsp; <b> ASH CONTENT</b></td>
			</tr>
			<tr style="border: 0px solid black;">
					<td rowspan="2" colspan="2" style="border: 0px solid black;">&nbsp; <b>Reference Code :</b> IS 9103 : 1999, Annex E  </td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['ash_s_d']!="0000-00-00")
					{
						echo date("d/m/Y", strtotime($row_select_pipe['ash_s_d']));
					}
					?></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['ash_e_d']!="0000-00-00")
					{
						echo date("d/m/Y", strtotime($row_select_pipe['ash_e_d']));
					}
					?></td>
				</tr>
		</table>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">1</td>
				<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; WEIGHT OF CRUCIBLE AND LID (W1)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ash_w1'] != "" && $row_select_pipe['ash_w1'] != "0" && $row_select_pipe['ash_w1'] != null) {
																						echo $row_select_pipe['ash_w1'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">2</td>
				<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; WEIGHT OF CRUCIBLE, LID AND SAMPLE (W2)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ash_w2'] != "" && $row_select_pipe['ash_w2'] != "0" && $row_select_pipe['ash_w2'] != null) {
																						echo $row_select_pipe['ash_w2'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">3</td>
				<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; WEIGHT OF CRUCIBLE, LID AND ASH (W3)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ash_w3'] != "" && $row_select_pipe['ash_w3'] != "0" && $row_select_pipe['ash_w3'] != null) {
																						echo $row_select_pipe['ash_w3'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">4</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp;
					<table class="test">
						<tr>
							<td width="150px" rowspan="2" style="text-align:center;font-weight:bold;">ASH CONTENT =</td>
							<td width="100px" style="border-bottom: 1px solid black; text-align:center;font-weight:bold;">W3 - W1</td>
							<td width="50px" rowspan="2" style="text-align:center;font-weight:bold;"> x 100</td>
						</tr>
						<tr>
							<td style="text-align:center;font-weight:bold;">W2 - W1</td>
						</tr>
					</table>
				</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ash_content'] != "" && $row_select_pipe['ash_content'] != "0" && $row_select_pipe['ash_content'] != null) {
																						echo $row_select_pipe['ash_content'] . " %";
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
		</table>
                </td>
            </tr>


			<!-- Table Start -->

			
			<tr>
                <td>
				<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr>
				<td colspan="4" style="border: 1px solid black; padding: 5px;text-align:center">&nbsp; <b> pH VALUE</b></td>
			</tr>
			<tr style="border: 0px solid black;">
					<td rowspan="2" colspan="2" style="border: 0px solid black;">&nbsp; <b>Reference Code :</b> IS 9103 : 1999, Annex E  </td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['phv_s_d']!="0000-00-00")
					{
						echo date("d/m/Y", strtotime($row_select_pipe['phv_s_d']));
					}
					?></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['phv_e_d']!="0000-00-00")
					{
						echo date("d/m/Y", strtotime($row_select_pipe['phv_e_d']));
					}
					?></td>
				</tr>
		</table>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr style="height:20px;">
				<td style="width:10%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">SAMPLE ID</td>
				<td style="width:30%;border: 1px solid black;text-align:center;font-weight:bold;">BEFORE SET</td>
				<td style="width:30%;border: 1px solid black;text-align:center;font-weight:bold;">AFTER SET</td>
				<td style="width:30%;border: 1px solid black;text-align:center;font-weight:bold;">TEMPERATURE (<sup>o</sup>C)</td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">1</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_before1'] != "" && $row_select_pipe['phv_before1'] != "0" && $row_select_pipe['phv_before1'] != null) {
																			echo $row_select_pipe['phv_before1'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_after1'] != "" && $row_select_pipe['phv_after1'] != "0" && $row_select_pipe['phv_after1'] != null) {
																			echo $row_select_pipe['phv_after1'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_temp1'] != "" && $row_select_pipe['phv_temp1'] != "0" && $row_select_pipe['phv_temp1'] != null) {
																			echo $row_select_pipe['phv_temp1'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">2</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_before2'] != "" && $row_select_pipe['phv_before2'] != "0" && $row_select_pipe['phv_before2'] != null) {
																			echo $row_select_pipe['phv_before2'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_after2'] != "" && $row_select_pipe['phv_after2'] != "0" && $row_select_pipe['phv_after2'] != null) {
																			echo $row_select_pipe['phv_after2'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_temp2'] != "" && $row_select_pipe['phv_temp2'] != "0" && $row_select_pipe['phv_temp2'] != null) {
																			echo $row_select_pipe['phv_temp2'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">3</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_before3'] != "" && $row_select_pipe['phv_before3'] != "0" && $row_select_pipe['phv_before3'] != null) {
																			echo $row_select_pipe['phv_before3'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_after3'] != "" && $row_select_pipe['phv_after3'] != "0" && $row_select_pipe['phv_after3'] != null) {
																			echo $row_select_pipe['phv_after3'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_temp3'] != "" && $row_select_pipe['phv_temp3'] != "0" && $row_select_pipe['phv_temp3'] != null) {
																			echo $row_select_pipe['phv_temp3'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">Average</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_avg_before'] != "" && $row_select_pipe['phv_avg_before'] != "0" && $row_select_pipe['phv_avg_before'] != null) {
																			echo $row_select_pipe['phv_avg_before'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_avg_after'] != "" && $row_select_pipe['phv_avg_after'] != "0" && $row_select_pipe['phv_avg_after'] != null) {
																			echo $row_select_pipe['phv_avg_after'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_avg_temp'] != "" && $row_select_pipe['phv_avg_temp'] != "0" && $row_select_pipe['phv_avg_temp'] != null) {
																			echo $row_select_pipe['phv_avg_temp'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
		</table>
               </td>
            </tr>
			
			 <tr>
                <td>
                    <table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
						<tr>
							<td colspan="4" style="border: 1px solid black; padding: 5px;text-align:center">&nbsp; <b> CHLORIDE ION CONCENTRATION</b></td>
						</tr>
						<tr style="border: 0px solid black;">
								<td rowspan="2" colspan="2" style="border: 0px solid black;">&nbsp; <b>Reference Code :</b> IS 9103 : 1999, Annex E </td>
								<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
								<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['clr_s_d']!="0000-00-00")
								{
									echo date("d/m/Y", strtotime($row_select_pipe['clr_s_d']));
								}
								?></td>
							</tr>
							<tr style="border: 0px solid black;">
								<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
								<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['clr_e_d']!="0000-00-00")
								{
									echo date("d/m/Y", strtotime($row_select_pipe['clr_e_d']));
								}
								?></td>
							</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
						<tr style="height:20px;">
							<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">1</td>
							<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; WEIGHT OF SAMPLE, GM</td>
							<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_w'] != "" && $row_select_pipe['clr_w'] != "0" && $row_select_pipe['clr_w'] != null) {
																									echo $row_select_pipe['clr_w'];
																								} else {
																									echo " <br>";
																								} ?></td>
						</tr>
						<tr style="height:20px;">
							<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">2</td>
							<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; WEIGHT OF CHLORIDE, GM (From Graph)</td>
							<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_x'] != "" && $row_select_pipe['clr_x'] != "0" && $row_select_pipe['clr_x'] != null) {
																									echo $row_select_pipe['clr_x'];
																								} else {
																									echo " <br>";
																								} ?></td>
						</tr>

						<tr style="height:20px;">
							<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">3</td>
							<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; CHLORIDE CONTENT (%) = (WEIGHT OF CHLORIDE / WEIGHT OF SAMPLE) X 100</td>
							<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['chloride_content'] != "" && $row_select_pipe['chloride_content'] != "0" && $row_select_pipe['chloride_content'] != null) {
																									echo $row_select_pipe['chloride_content'] . " %";
																								} else {
																									echo " <br>";
																								} ?></td>
						</tr>


					</table>
                </td>
            </tr>
			
		
			

			<!-- footer design -->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
                </td>
            </tr>
            
        </table>



		<div class="pagebreak"></div>
			<br>
			<br>
			<br>
			<br>
		<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse; ">
            <!-- header design -->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
                        <tr>
                            <td style="padding: 1px;border: 1px solid;"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;">ADMIXTURE</td>
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
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;">Job No :- </td>
                            <td style="padding: 5px;"> <?php echo $lab_no; ?></td>
						
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;">Format No :-</td>
                            <td style="padding: 5px;"> ICT-ADX-TST-02</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
                            <td style="padding: 5px;"> <?php echo $sample_id; ?></td>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;"></td>
                            <td style="padding: 5px;"></td>
                        </tr>
						<tr>
                            <td colspan="2" style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Testing Date :-</td>
                            <td colspan="2" style="padding: 5px;"><?php echo date('d/m/Y', strtotime($start_date)); ?>&nbsp; To &nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
                            <td colspan="2" style="padding: 5px;"><?php echo $mt_name; ?></td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
			<tr>
                <td>
				<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr>
				<td colspan="4" style="border: 1px solid black; padding: 5px;text-align:center">&nbsp; <b> pH VALUE</b></td>
			</tr>
			<tr style="border: 0px solid black;">
					<td rowspan="2" colspan="2" style="border: 0px solid black;">&nbsp; <b>Reference Code :</b> IS 9103 : 1999, Annex E  </td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['phv_s_d']!="0000-00-00")
					{
						echo date("d/m/Y", strtotime($row_select_pipe['phv_s_d']));
					}
					?></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['phv_e_d']!="0000-00-00")
					{
						echo date("d/m/Y", strtotime($row_select_pipe['phv_e_d']));
					}
					?></td>
				</tr>
		</table>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr style="height:20px;">
				<td style="width:10%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">SAMPLE ID</td>
				<td style="width:30%;border: 1px solid black;text-align:center;font-weight:bold;">BEFORE SET</td>
				<td style="width:30%;border: 1px solid black;text-align:center;font-weight:bold;">AFTER SET</td>
				<td style="width:30%;border: 1px solid black;text-align:center;font-weight:bold;">TEMPERATURE (<sup>o</sup>C)</td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">1</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_before1'] != "" && $row_select_pipe['phv_before1'] != "0" && $row_select_pipe['phv_before1'] != null) {
																			echo $row_select_pipe['phv_before1'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_after1'] != "" && $row_select_pipe['phv_after1'] != "0" && $row_select_pipe['phv_after1'] != null) {
																			echo $row_select_pipe['phv_after1'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_temp1'] != "" && $row_select_pipe['phv_temp1'] != "0" && $row_select_pipe['phv_temp1'] != null) {
																			echo $row_select_pipe['phv_temp1'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">2</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_before2'] != "" && $row_select_pipe['phv_before2'] != "0" && $row_select_pipe['phv_before2'] != null) {
																			echo $row_select_pipe['phv_before2'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_after2'] != "" && $row_select_pipe['phv_after2'] != "0" && $row_select_pipe['phv_after2'] != null) {
																			echo $row_select_pipe['phv_after2'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_temp2'] != "" && $row_select_pipe['phv_temp2'] != "0" && $row_select_pipe['phv_temp2'] != null) {
																			echo $row_select_pipe['phv_temp2'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">3</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_before3'] != "" && $row_select_pipe['phv_before3'] != "0" && $row_select_pipe['phv_before3'] != null) {
																			echo $row_select_pipe['phv_before3'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_after3'] != "" && $row_select_pipe['phv_after3'] != "0" && $row_select_pipe['phv_after3'] != null) {
																			echo $row_select_pipe['phv_after3'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_temp3'] != "" && $row_select_pipe['phv_temp3'] != "0" && $row_select_pipe['phv_temp3'] != null) {
																			echo $row_select_pipe['phv_temp3'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">Average</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_avg_before'] != "" && $row_select_pipe['phv_avg_before'] != "0" && $row_select_pipe['phv_avg_before'] != null) {
																			echo $row_select_pipe['phv_avg_before'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_avg_after'] != "" && $row_select_pipe['phv_avg_after'] != "0" && $row_select_pipe['phv_avg_after'] != null) {
																			echo $row_select_pipe['phv_avg_after'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_avg_temp'] != "" && $row_select_pipe['phv_avg_temp'] != "0" && $row_select_pipe['phv_avg_temp'] != null) {
																			echo $row_select_pipe['phv_avg_temp'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
		</table>
               </td>
            </tr>
			
			 
			<tr>
                <td>
                   <table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
						<tr>
							<td colspan="4" style="border: 1px solid black; padding: 5px;text-align:center">&nbsp; <b>DRY MATERIAL CONTENT</b></td>
						</tr>
						<tr style="border: 0px solid black;">
								<td rowspan="2" colspan="2" style="border: 0px solid black;">&nbsp; <b>Reference Code :</b> IS 9103 : 1999, Annex E </td>
								<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
								<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['dmc_s_d']!="0000-00-00")
								{
									echo date("d/m/Y", strtotime($row_select_pipe['dmc_s_d']));
								}
								?></td>
							</tr>
							<tr style="border: 0px solid black;">
								<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
								<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['dmc_e_d']!="0000-00-00")
								{
									echo date("d/m/Y", strtotime($row_select_pipe['dmc_e_d']));
								}
								?></td>
							</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center;font-weight:bold; padding: 5px;">Sr No.</td>
				<td style="width:50%;border: 1px solid black;text-align:center;font-weight:bold;">PERTICULARS</td>
				<td style="width:19%;border: 1px solid black;text-align:center;font-weight:bold;">LIQUID ADMIXTURE</td>
				<td style="width:19%;border: 1px solid black;text-align:center;font-weight:bold;">NON LIQUID ADMIXTURE</td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">1</td>
				<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; WEIGHT OF BOTTLE AND SAND (W1)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_w1'] != "" && $row_select_pipe['dmc_w1'] != "0" && $row_select_pipe['dmc_w1'] != null) {
																						echo $row_select_pipe['dmc_w1'];
																					} else {
																						echo " -";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_non_w1'] != "" && $row_select_pipe['dmc_non_w1'] != "0" && $row_select_pipe['dmc_non_w1'] != null) {
																						echo $row_select_pipe['dmc_non_w1'];
																					} else {
																						echo " -";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">2</td>
				<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; WEIGHT OF BOTTLE + SAND + SAMPLE (W2)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_w2'] != "" && $row_select_pipe['dmc_w2'] != "0" && $row_select_pipe['dmc_w2'] != null) {
																						echo $row_select_pipe['dmc_w2'];
																					} else {
																						echo " -";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_non_w2'] != "" && $row_select_pipe['dmc_non_w2'] != "0" && $row_select_pipe['dmc_non_w2'] != null) {
																						echo $row_select_pipe['dmc_non_w2'];
																					} else {
																						echo " -";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">3</td>
				<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; WEIGHT OF SAMPLE (W2-W1)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_w2_w1'] != "" && $row_select_pipe['dmc_w2_w1'] != "0" && $row_select_pipe['dmc_w2_w1'] != null) {
																						echo $row_select_pipe['dmc_w2_w1'];
																					} else {
																						echo "-";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_non_w2_w1'] != "" && $row_select_pipe['dmc_non_w2_w1'] != "0" && $row_select_pipe['dmc_non_w2_w1'] != null) {
																						echo $row_select_pipe['dmc_non_w2_w1'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">4</td>
				<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; WEIGHT OF BOTTLE, SAND AND DRIED RESIDUE (W3)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_w3'] != "" && $row_select_pipe['dmc_w3'] != "0" && $row_select_pipe['dmc_w3'] != null) {
																						echo $row_select_pipe['dmc_w3'];
																					} else {
																						echo "-";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center; padding: 5px;"><?php if ($row_select_pipe['dmc_non_w3'] != "" && $row_select_pipe['dmc_non_w3'] != "0" && $row_select_pipe['dmc_non_w3'] != null) {
																									echo $row_select_pipe['dmc_non_w3'];
																								} else {
																									echo " -";
																								} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">5</td>
				<td style="width:50%;border: 1px solid black;text-align:left;font-weight:bold;">&nbsp; WEIGHT OF DRIED RESIDUE (W3-W1)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_w3_w1'] != "" && $row_select_pipe['dmc_w3_w1'] != "0" && $row_select_pipe['dmc_w3_w1'] != null) {
																						echo $row_select_pipe['dmc_w3_w1'];
																					} else {
																						echo "-";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_non_w3_w1'] != "" && $row_select_pipe['dmc_non_w3_w1'] != "0" && $row_select_pipe['dmc_non_w3_w1'] != null) {
																						echo $row_select_pipe['dmc_non_w3_w1'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;font-weight:bold;">6</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp;
					<table class="test">
						<tr>
							<td width="250px" rowspan="2" style="text-align:center;font-weight:bold;">PERCENT RESIDUE ON DRYING =</td>
							<td width="150px" style="border-bottom: 1px solid black; text-align:center;font-weight:bold;">W3 - W1</td>
							<td width="50px" rowspan="2" style="text-align:center;font-weight:bold;"> x 100</td>
						</tr>
						<tr>
							<td style="text-align:center;font-weight:bold;">W2 - W1</td>
						</tr>
					</table>
				</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_content'] != "" && $row_select_pipe['dmc_content'] != "0" && $row_select_pipe['dmc_content'] != null) {
																						echo $row_select_pipe['dmc_content'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_non_content'] != "" && $row_select_pipe['dmc_non_content'] != "0" && $row_select_pipe['dmc_non_content'] != null) {
																						echo $row_select_pipe['dmc_non_content'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
		</table>
				</td>
			</tr>

			

			<!-- footer design -->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
                </td>
            </tr>
            
        </table>
		</page>


			
	</body>
</html> 
		
	
<script type="text/javascript">

</script>