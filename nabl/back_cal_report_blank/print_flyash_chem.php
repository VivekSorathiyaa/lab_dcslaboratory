<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin:0px 30px; }
.pagebreak { page-break-before: always; }
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
		 $select_tiles_query = "select * from flyash_chemical WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			$r_name= $row_select['refno'];
			$sr_no= $row_select['sr_no'];
			$sample_no= $row_select['job_no'];
			$branch_name = $row_select['branch_name'];
			$rec_sample_date= $row_select['sample_rec_date'];	
			$cons= $row_select['condition_of_sample_receved'];			
			if($cons == 0)
			{
				$con_sample = "Sealed Ok";
			}
			else
			{
				$con_sample = "Unsealed";
			}
			$name_of_work= strip_tags(html_entity_decode($row_select['nameofwork']),"<strong><em>");						

			$select_query1 = "select * from agency_master where `isdeleted`=0 and `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
				$issue_date= $row_select2['issue_date'];
								
				$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'"; 
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$detail_sample= $row_select3['mt_name'];
					include_once 'sample_id.php';
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
						$source= $row_select4['agg_source'];
					
					$week_number= $row_select4['fly_source'];
				}
					
				
				
		?>
		
		
	<br>
	<br><br>

	<page size="A4">
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border:1px solid; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">FLYASH CHEMICAL</td>
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
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;"> ICT/OBS//IND-010924-27</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $detail_sample; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
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
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 1727:1967 </td>
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

		<!-- <table align="center" width="100%" class="test1" height="12%">

			<tbody>
				<tr style="border: 1px solid black;">
					<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
					<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $job_no; ?></b></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Laboratory No :</b>&nbsp;</td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $lab_no; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Testing Start Date :</b></td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Testing Complete Date:</b></td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
				</tr>
			</tbody>
		</table> -->


		<h5 style="font-size:12px; text-align:center;margin:0px 0px 8px;">OBSERVATION SHEET OF FLYASH CHEMICAL ANALYSIS <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 <?php }?> GRAVIMETRIC METHOD</h5>
			<table align="center" width="100%" class="test1" style="" height="3%">
				<tr style="">
					<td  colspan="2" style="width:55%;border: 1px solid black;text-align:center;font-weight:bold;" >DESCRIPTION</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">READING</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;font-weight:bold;">RESULT</td>
				</tr>
			</table>
			
		    <table align="center" width="100%" class="test1" style="text-transform: lowercase;" height="Auto">
				<tr >
					<td style="text-align:left;padding:8px 0px;" colspan="4"><b>1. LOSS ON IGNITION (LOI) <?php if($row_select_pipe['los_test_method']!="" && $row_select_pipe['los_test_method']!=null && $row_select_pipe['los_test_method']!="0" && $row_select_pipe['los_test_method']!="undefined"){echo $row_select_pipe['los_test_method'];}else{?>IS 1727 : 1967 <?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center;padding:4px 0px;" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">&nbsp; WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >2</td>
					<td  style="text-align:left; border: 1px solid black;">&nbsp; WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >3</td>
					<td  style="text-align:left; border: 1px solid black;">&nbsp; WEIGHT OF CRUCIBLE + SAMPLE (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo number_format((floatval($row_select_pipe['ig1']) + floatval($row_select_pipe['ig2'])),4);?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >4</td>
					<td  style="text-align:left; border: 1px solid black;">&nbsp; WEIGHT OF CRUCIBLE AFTER IGNITION (W3) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >5</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W3</td>
								<td></td>
						</tr>
						<tr>
								<td>LOSS ON IGNITION  =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo number_format((floatval($row_select_pipe['ig1']) + floatval($row_select_pipe['ig2'])),4);?> - <?php echo $row_select_pipe['ig3'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>L.O.I  =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['ig1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig4'];?> %</td>
				</tr>
			
				<tr >
					
					<td style="text-align:left;padding:8px 0px;" colspan="4"><b>2. SILICA, (SiO<sub>2</sub>) <?php if($row_select_pipe['sio_test_method']!="" && $row_select_pipe['sio_test_method']!=null && $row_select_pipe['sio_test_method']!="0" && $row_select_pipe['sio_test_method']!="undefined"){echo $row_select_pipe['sio_test_method'];}else{?>IS 1727 : 1967 <?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center;padding:4px 0px;" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">&nbsp; WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >2</td>
					<td  style="text-align:left; border: 1px solid black;">&nbsp; WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >3</td>
					<td  style="text-align:left; border: 1px solid black;">&nbsp; WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >4</td>
					<td  style="text-align:left; border: 1px solid black;">&nbsp; WEIGHT OF CRUCIBLE AFTER HF (W3) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio4'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center;padding:4px 0px;" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;padding:4px 0px;"><b>&nbsp; FORMULA BEFORE HF</b></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >5</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;padding:4px 0px;	">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio3'];?> - <?php echo $row_select_pipe['sio2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio5'];?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;padding:4px 0px;"><b>&nbsp; FORMULA AFTER HF</b></td>
					
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W3</td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio3'];?> - <?php echo $row_select_pipe['sio4'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio6'];?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >7</td>
					<td  style="text-align:left; border: 1px solid black;">
					<B>&nbsp; R = R1 - R2</B>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<?php echo $row_select_pipe['sio5'];?> - <?php echo $row_select_pipe['sio6'];?></td>
						
					<td  style="text-align:center; border: 1px solid black;"><?php echo $r_silica = $row_select_pipe['sio5'] - $row_select_pipe['sio6'];?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px;" >8</td>
					<td  style="text-align:left; border: 1px solid black;">
					<B>&nbsp; PURE SILICA = R + R2(SILICA FROM R<sub>2</sub>O<sub>3</sub>)</B>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<?php echo $r_silica;?> + <?php echo $row_select_pipe['r2o6'];?></td>
						
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio7'];?>%</td>
				</tr>
		 	</table>
			<br><br>
			
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
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;text-align:right;" colspan="4"><b>Page 1 of 4</b></td>
			</tr>
			
		</table>
                </td>
            </tr>
            
				
			<div class="pagebreak"> </div>
			<br><bR><br>
			

				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">FLYASH CHEMICAL</td>
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
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">ICT/OBS//IND-010924-27</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $detail_sample; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
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
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 1727:1967 </td>
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

			<table align="center" width="100%" class="test1" style="" height="3%">
				<tr style="">
					<td  colspan="2" style="width:55%;border: 1px solid black;text-align:center;font-weight:bold;" >DESCRIPTION</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">READING</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;font-weight:bold;">RESULT</td>
				</tr>
			</table>
			

			<table align="center" width="100%" class="test1" style="text-transform: lowercase;" height="Auto">
				<tr >
					<td style="text-align:left;padding:5px 0px" colspan="4"><b>3. COMBINED FERRIC OXIDE AND ALUMINA (R<sub>2</sub>O<sub>3</sub>) <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 <?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; WEIGHT OF CRUCIBLE AFTER HF (W3) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o4'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;padding:4px 0px"><b>&nbsp; FORMULA BEFORE HF</b></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px" >5</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o3'];?> - <?php echo $row_select_pipe['r2o2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o5'];?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;padding:4px 0px"><b>&nbsp; FORMULA AFTER HF</b></td>
					
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W3</td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o3'];?> - <?php echo $row_select_pipe['r2o4'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o6'];?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >7</td>
					<td  style="text-align:left; border: 1px solid black;padding:4px 0px">
					<B>R = R1 - R2</B>
					</td>
					<td  style="text-align:center; border: 1px solid black;">										
						<?php echo $row_select_pipe['r2o5'];?> - <?php echo $row_select_pipe['r2o6'];?>					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o7'];?> %</td>
				</tr>
				
				<tr >
					
					<td style="text-align:left;padding:5px 0px" colspan="4"><b>4(A). FERRIC OXIDE, (Fe<sub>2</sub>O<sub>3</sub>) <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 <?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['feo1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; TITRANT (V) ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['feo2'];?></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;padding:4px 0px">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.7985 X V</td>
								<td></td>
						</tr>
						<tr>
								<td>FERRIC OXIDE (Fe<sub>2</sub>O<sub>3</sub>) =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>W</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.7985 X <?php echo $row_select_pipe['feo2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td> FERRIC OXIDE =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['feo1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['feo3'];?> %</td>
				</tr>
				<tr >
					
					<td style="text-align:left;padding:5px 0px" colspan="4"><b>4(B). ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 <?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php //echo $row_select_pipe['feo1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; TITRANT (V) ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php //echo $row_select_pipe['feo2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;padding:4px 0px">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.5098 X V</td>
								<td></td>
						</tr>
						<tr>
								<td>ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>W</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.5098 X V</td>
								<td></td>
						</tr>
						<tr>
								<td>ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>W</td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php //echo $row_select_pipe['feo3'];?></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >4</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) = R<sub>2</sub>O<sub>3</sub> - Fe<sub>2</sub>O<sub>3</sub> </td>
					<td  style="width:30%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o7'];?> - <?php echo $row_select_pipe['feo3'];?></td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['alo1'];?> %</td>
				</tr>
			</table>
			<br><br>
			
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
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;text-align:right;" colspan="4"><b>Page 2 of 4</b></td>
			</tr>
			
		</table>
                </td>
            </tr>

			<div class="pagebreak"> </div>
			<br><br>

				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">FLYASH CHEMICAL</td>
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
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">ICT/OBS//IND-010924-27</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $detail_sample; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
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
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 1727:1967 </td>
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

			<table align="center" width="100%" class="test1" style="" height="3%">
				<tr style="">
					<td  colspan="2" style="width:55%;border: 1px solid black;text-align:center;font-weight:bold;" >DESCRIPTION</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">READING</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;font-weight:bold;">RESULT</td>
				</tr>
			</table>
			
			<table align="center" width="100%" class="test1" style="text-transform: lowercase;" height="Auto">
					<tr >
					
					<td style="text-align:left;padding:5px 0px" colspan="4"><b>5. CALCIUM OXIDE (CaO) <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 <?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;padding:4px 0px">&nbsp; WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center;padding:4px 0px" >4</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>CaO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['cao3'];?> - <?php echo $row_select_pipe['cao2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>CaO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['cao1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao4'];?> %</td>
				</tr>
				<tr >
					<td style="text-align:left;padding:8px 0px;" colspan="4"><b>6. MAGNESIUM OXIDE (MgO) <?php if($row_select_pipe['mang_test_method']!="" && $row_select_pipe['mang_test_method']!=null && $row_select_pipe['mang_test_method']!="0" && $row_select_pipe['mang_test_method']!="undefined"){echo $row_select_pipe['mang_test_method'];}else{?>IS 1727 : 1967 <?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:5px 5px;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;padding:5px 5px;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;padding:5px 5px;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>MgO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 36.22</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['mgo3'];?> - <?php echo $row_select_pipe['mgo2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>MgO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 36.22</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['mgo1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo4'];?> %</td>
				</tr>
				
				<tr >
					
					<td style="text-align:left;padding:8px 0px;" colspan="4"><b>7. SULPHURIC ANHYDRIDE, SO<sub>3</sub> <?php if($row_select_pipe['tot_test_method']!="" && $row_select_pipe['tot_test_method']!=null && $row_select_pipe['tot_test_method']!="0" && $row_select_pipe['tot_test_method']!="undefined"){echo $row_select_pipe['tot_test_method'];}else{?>IS 1727 : 1967 <?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:5px 5px;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;padding:5px 5px;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;padding:5px 5px;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>SULPHURIC ANHYDRIDE =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 34.3</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['so3'];?> - <?php echo $row_select_pipe['so2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>SO<sub>3</sub> =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 34.3</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['so1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so4'];?> %</td>
				</tr>
			</table>
			<br>

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
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;text-align:right;" colspan="4"><b>Page 3 of 4</b></td>
			</tr>
			
		</table>
                </td>
            </tr>
			<div class="pagebreak"> </div>
			<br><br>

				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">FLYASH CHEMICAL</td>
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
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">ICT/OBS//IND-010924-27</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $detail_sample; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
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
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 1727:1967 </td>
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

			<table align="center" width="100%" class="test1" style="" height="2%">
				<tr style="">
					<td  colspan="2" style="width:55%;border: 1px solid black;text-align:center;font-weight:bold;" >DESCRIPTION</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">READING</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;font-weight:bold;">RESULT</td>
					
				</tr>
			</table>
			<table align="center" width="100%" class="test1" style="text-transform: lowercase;"  height="Auto">
					<tr >
					
					<td style="text-align:left;padding:8px 0px;" colspan="4"><b>8. CHLORIDE <?php if($row_select_pipe['chl_test_method']!="" && $row_select_pipe['chl_test_method']!=null && $row_select_pipe['chl_test_method']!="0" && $row_select_pipe['chl_test_method']!="undefined"){echo $row_select_pipe['chl_test_method'];}else{?>IS 4032:1985 <?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center;" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:5px 5px;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;padding:5px 5px;">TITRANT USED FOR SAMPLE (X), ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;padding:5px 5px;">TITRANT USED FOR BLANK (Y), ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;padding:5px 5px;">Z = 10 - (X-Y) </td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl4'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;padding:5px 5px;"> N = Normality of NH<sub>4</sub>SCN</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl5'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>(Z X 0.03546 X N X 100)</td>
								<td></td>
						</tr>
						<tr>
								<td>Cl =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>(<?php echo $row_select_pipe['cl4'];?> X 0.03546 X <?php echo $row_select_pipe['cl5'];?> X 100)</td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['cl1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl6'];?> %</td>
				</tr>
				<tr >
					
					<td style="text-align:left;border-left:0px solid;padding:8px 0px;" colspan="5"><b>9. ALAKALI CONTENT Na<sub>2</sub>O <?php if($row_select_pipe['alk_test_method']!="" && $row_select_pipe['alk_test_method']!=null && $row_select_pipe['alk_test_method']!="0" && $row_select_pipe['alk_test_method']!="undefined"){echo $row_select_pipe['alk_test_method'];}else{?>IS 3812 (Part-1):2013   ANNEX C<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:5px 5px;">WEIGHT OF SAMPLE (W) GM</td>
					<td colspan="2" style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['alk1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  rowspan="2" style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  rowspan="2" style="width:50%;text-align:left; border: 1px solid black;"padding:5px 5px;> ALAKALI CONTENT Na<sub>2</sub>O</b> EQUIVALENT % <br> = Na<sub>2</sub>O% + 0.658 x K<sub>2</sub>O%</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >3</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk2'];?></td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk3'];?></td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk4'];?> %</td>
				</tr>
			</table>

			<h3 style="font-size:14px; text-align:center;margin:7px 0px;">PERCENTAGE OF FLYASH</h3>
			
			<table align="center" width="80%" class="test1"  style="text-transform: lowercase;"  height="Auto">
				<tr style="border: 1px solid black;">
					<td  style="width:20%;border: 1px solid black;text-align:center" >SR.NO.</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:8px 5px;">PRESENT CHEMICAL COMPOUND</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">PERCENTAGE</td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:20%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:8px 5px;"> SILICA</td>
					<td  style="width:30%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['sio7'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:8px 5px;"> COMBINED FERRIC OXIDE AND ALUMINA</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['r2o7'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >3</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:8px 5px;"> CALCUIM OXIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['cao4'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >4</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:8px 5px;"> MAGNESIUM OXIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['mgo4'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >5</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:8px 5px;"> SULPHURIC ANHYDRIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['so4'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >6</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:8px 5px;"> LOSS ON IGNITION</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['ig4'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >7</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:8px 5px;"> CHLORIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['cl6'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >8</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;padding:8px 5px;"> ALKALI</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo number_format($row_select_pipe['alk2'],2);?></td>
					
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  colspan="2" style="width:70%;border: 1px solid black;text-align:center;padding:8px 5px;" >TOTAL</td>
					
					<td  style="width:30%;border: 1px solid black;text-align:center" >
					
					<?php 
					$ans = floatval($row_select_pipe['sio7']) + floatval($row_select_pipe['r2o7']) + floatval($row_select_pipe['cao4']) + floatval($row_select_pipe['mgo4']) + floatval($row_select_pipe['so4']) + floatval($row_select_pipe['ig4']) + floatval($row_select_pipe['cl6']) + floatval($row_select_pipe['alk2']);
					
					echo number_format($ans,2);
					
					?></td>
					
				</tr>
				
				</table>
			
			
			<br>
			

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
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;text-align:right;" colspan="4"><b>Page 4 of 4</b></td>
			</tr>
			
		</table>
                </td>
            </tr>
			</page>
	</body>
</html> 
		
	
<script type="text/javascript">


</script>