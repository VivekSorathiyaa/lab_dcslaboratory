<?php
session_start();
include("../connection.php");
error_reporting(0); ?>
<style>
	@page {
		margin: 0 40px;
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
	$select_tiles_query = "select * from hard_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$cast_date = $row_select_pipe['cast_date'];
		$cast_time = $row_select_pipe['cast_time'];
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
		$paver_shape = $row_select4['paver_shape'];
		$paver_age = $row_select4['paver_age'];
		$paver_color = $row_select4['paver_color'];
		$paver_thickness = $row_select4['paver_thickness'];
		$paver_grade = $row_select4['paver_grade'];
	}

	$pagecnt = 1;
	$totalcnt = 1;
	if ($row_select_pipe['avgv'] != "" && $row_select_pipe['avgv'] != "0" && $row_select_pipe['avgv'] != null) {
		$totalcnt++;
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
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
                        <tr>
                            <td style="font-size: 15px;font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">ACCELERATED CURED CONCRETE CUBE</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">Compressive strength</td>
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
								<td style="font-weight: bold;text-align: left;padding: 10px 4px 4px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 4px 4px;width:35%;"> FMT-OBS-24</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 4px 4px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 4px 4px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 4px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 4px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 4px;border: 0;">Testing Date :-</td>
								<td style="font-weight: bold;padding: 4px;"><?php echo date('d/m/Y', strtotime($start_date));?> &nbsp; &nbsp; To &nbsp; &nbsp; <?php echo date('d/m/Y', strtotime($end_date));?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 4px 4px 10px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 4px 4px 10px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 4px 4px 10px;border: 0;"></td>
								<td style="font-weight: bold;padding: 4px 4px 10px;"></td>
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
                            <td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 17%;">Test Method :-</td>
                            <td style="padding: 5px;border-left: 1px solid;">IS:9013:1978 REAFFIRMED : 2018 , IS : 516(part-1)(sec-1):2021</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;font-weight: bold;text-align: center;padding: 5px;border-top: 0;width: 8%;" colspan="2">Observation Table</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;border: 1px solid;" colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- table design -->
            <tr>
                <td>
                    <?php $cnt=1; ?>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;width:3%;" rowspan="4">Sr. <br>No.</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;width:5%;" rowspan="2">Concrete Grade</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;width:5%;" colspan="3">Specimen Dimensions</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;width:5%;" rowspan="4">Casting Date of Specimen</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;width:5%;" rowspan="4">Testing Date of Specimen</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;width:5%;" rowspan="2">Weight</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;width:5%;" rowspan="2">Density</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;width:5%;" rowspan="2">Observed <br> Failure Load</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;width:5%;" rowspan="2">Compressive Strength (X)</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;width:5%;" rowspan="2">Corrected Compressive Strength</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;width:5%;" rowspan="3">Average Compressive Strength</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;width:5%;" rowspan="4">Remarks</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">Length</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">Breadth</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">Height</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;" rowspan="2">M</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">L</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">B</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">H</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">W</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">W / (LXBXH)X 10<sup>9</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">P</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">PX1000 / (LXB)</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">Y</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;">Kg</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;">Kg / m<sup>3</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;">KN</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;">N/mm<sup>2</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;">N/mm<sup>2</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;">N/mm<sup>2</sup></td>
                        </tr>

                        <tr>
                            <td style="text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['cube_grade']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_l1'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_width1'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_height1'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['cast_date'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['cast_date'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_w1'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['den1'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_load1'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_com1'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;" rowspan="3"><?php echo $row_select_pipe['acc_cor_avg1'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;" rowspan="3"><?php echo $row_select_pipe['acc_avg1'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['remark'];?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['cube_grade']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_l2']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_width2']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_height2']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['cast_date'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['cast_date'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_w2']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['den2'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_load2'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_com2'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['remark_1'];?></td>
                        </tr>
                       <tr>
                            <td style="text-align: center;padding: 5px;border: 1px solid;"><?php echo $cnt++; ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['cube_grade']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_l3']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_width3']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_height3']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['cast_date'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['cast_date'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_w3']?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['den3'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_load3'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['acc_com3'];?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['remark_2'];?></td>
                        </tr>
                       
                       
                        
                        
                    </table>
                </td>
            </tr>
             <!-- footer design -->
             <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border-left: 2px solid;width:15%;">Remarks :-</td>
                            <td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['remark']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;width: 8%;border-left: 2px solid;border-top: 1px solid;width:15%;">Checked By :-</td>
                            <td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;width: 8%;border: 1px solid;width:15%;">Tested By :-</td>
                            <td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
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

<!-- 
<script type="text/javascript">
	window.print();
</script> -->