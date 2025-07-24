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
    $select_tiles_query = "select * from upv WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
    // $job_no= $row_select['job_no'];
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


  <br><br><br>
 <page size="A4">
                 <tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
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
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON ULTRASONIC PULSE VELOCITY</td>
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
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
                            <tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;"></td>
								<td style="padding: 5px;" colspan="3"></td>
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
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp;Surface Condition</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $con_sample; ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of Testing</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d/m/Y', strtotime($start_date)); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of Casting</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d/m/Y', strtotime($row_select_pipe['start_date'])); ?></td>
			</tr>
		</table>
		<br> -->
        
        
            <tr>
                <td style="text-align:center;font-size:17px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;">

                        <tr style="">

                            <td style="width:100%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold; "><span style=""> OBSERVATION AND CALCULAITON SHEET FOR ULTRASONIC PULSE VELOCITY (IS 516 : Part-5- Sec-1-AMD No.1 )</td>
                        </tr>
                    </table><br>

                </td>
            </tr>


           

            <?php //$cnt = 1;
            ?>
            <tr>
                <td style="text-align:center;font-size:13px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;border:1px solid;margin-bottom:15px;">

                        <tr style="">

                            <td style="width:5%;font-weight:bold;padding-bottom:10px;text-align:center; ">Sr.<br> No.</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; ">Elements</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center;padding-bottom:10px;padding-top:10px;  ">Dist. Bet.<br>Transducers<br>in mm</td>
                            <td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Time in<br>µ sec</td>
                            <td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Velocity<br>km/sec</td>
                            <td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Quality of<br>Concrete</td>
                        </tr>
                        <?php
                        // $count=1;
                        // while($row_select_pipe = mysqli_fetch_array($result_tiles_select)){
                        ?>
                        <?php $count = 1;
                        // $cnt = 1;
                        // $select_tilesy5 = "select * from upv WHERE `lab_no`='$lab_no' AND  `job_no`='$job_no' and `is_deleted`='0'";
                        // $result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
                        // $coming_row = mysqli_num_rows($result_tiles_select15);

                        // while ($row_select_pipe = mysqli_fetch_array($result_tiles_select15)) {
                            // $flag5++;
                            // $br++;
                            // $cntrw++;

                        ?>
						<?php if($row_select_pipe['dist_1']!="" && $row_select_pipe['dist_1']!=null && $row_select_pipe['dist_1']!="0"){?>
                            <tr style="">
                                <td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $count++; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center;padding-bottom:10px;padding-top:10px; ">Beam B - 01</td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['dist_1'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['time_1'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['velo_1'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['grading_1'];?></td>
                            </tr>
						<?php } if($row_select_pipe['dist_2']!="" && $row_select_pipe['dist_2']!=null && $row_select_pipe['dist_2']!="0"){?>
						
						<tr style="">
                                <td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $count++; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center;padding-bottom:10px;padding-top:10px; ">Beam B - 02</td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['dist_2'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['time_2'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['velo_2'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['grading_2'];?></td>
                            </tr>
						<?php } if($row_select_pipe['dist_3']!="" && $row_select_pipe['dist_3']!=null && $row_select_pipe['dist_3']!="0"){?>
						
						<tr style="">
                                <td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $count++; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center;padding-bottom:10px;padding-top:10px; ">Beam B - 03</td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['dist_3'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['time_3'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['velo_3'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['grading_3'];?></td>
                            </tr>
						<?php } if($row_select_pipe['dist_4']!="" && $row_select_pipe['dist_4']!=null && $row_select_pipe['dist_4']!="0"){?>
						
						<tr style="">
                                <td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $count++; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center;padding-bottom:10px;padding-top:10px; ">Beam B - 04</td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['dist_4'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['time_4'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['velo_4'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['grading_4'];?></td>
                            </tr>
						<?php } if($row_select_pipe['dist_5']!="" && $row_select_pipe['dist_5']!=null && $row_select_pipe['dist_5']!="0"){?>
						
						<tr style="">
                                <td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $count++; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center;padding-bottom:10px;padding-top:10px; ">Beam B - 0</td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['dist_5'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['time_5'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['velo_5'];?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php echo $row_select_pipe['grading_5'];?></td>
                            </tr>
						
						<?php }?>
                        <?php
                            // $cnt++;
                        // }
                        ?>


                    </table>

                </td>
            </tr>
            <br>

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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
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


            <div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


            </div>
        </table>
    </page>

</body>

</html>

<script type="text/javascript">


</script>
