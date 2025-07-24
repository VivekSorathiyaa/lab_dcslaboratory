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
    $select_tiles_query = "select * from rebound_hammer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
    $result_tiles_select = mysqli_query($conn, $select_tiles_query);
    $row_select_pipe = mysqli_fetch_array($result_tiles_select);
    //$amend_date = $row_select_pipe['amend_date'];


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
	<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid;border-right: 1px solid; ">
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
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:100px;width:120px;background-blend-mode:multiply;"></td>
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style="" > OBSERVATION AND CALCULATION SHEET FOR TEST ON REBOUND HAMMER</td>
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
							
							<td  style="border-bottom:1px solid;border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-bottom:1px solid;border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-bottom:1px solid;border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
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
				
				<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 1PX SOLID;width: 8%;" colspan="2">REBOUND HAMMER (IS-516 (Part 5):2020)</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="2">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
					
		<tr>
			<td>
        <!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid;">   
            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:13px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;">

                        <tr style="">

                            <td style="width:7%;font-weight:bold;text-align:center;padding:7px 3px;" rowspan=2>Sr No.</td>
                            <td style="border-left:1px solid;width:19%;font-weight:bold;text-align:center;padding:7px 3px;" rowspan=2>Description</td>
                            <td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;padding:7px 3px; " rowspan=2>Direction</td>
                            <td style="border-left:1px solid;width:7%;font-weight:bold;text-align:center;padding:7px 3px; " rowspan=2>Angle</td>
                            <td style="border-left:1px solid;width:24%;font-weight:bold;text-align:center;padding:7px 3px; " colspan=9>Rebound Number=N</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; padding:7px 3px;" rowspan=2>Average Rebound<br>Number</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; padding:7px 3px;"rowspan=2 >Standrard Deviation (S)</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; padding:7px 3px;"rowspan=2 >Max. Rb</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; padding:7px 3px;"rowspan=2 >Min. Rb</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; padding:7px 3px;"rowspan=2 >Range (R)</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; padding:7px 3px;"rowspan=2 >R / S</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; padding:7px 3px;"rowspan=2 >R / S. As per IS 8900:1978 table 4. for 5% significance level</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; padding:7px 3px;"rowspan=2 >OUTLIERS REQUIREMENTS</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; padding:7px 3px;"rowspan=2 >By Relationship Y=1.369X-12.66</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; padding:7px 3px;"rowspan=2 >Vertical up/Down</td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding:7px 3px;">1</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding:7px 3px; ">2</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding:7px 3px; ">3</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding:7px 3px; ">4</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding:7px 3px; ">5</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding:7px 3px; ">6</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding:7px 3px; ">7</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding:7px 3px; ">8</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding:7px 3px; ">9</td>
                           
                        </tr>
                        <?php
                        // $count=1;
                        // while($row_select_pipe = mysqli_fetch_array($result_tiles_select)){
                        ?>
                        <?php $count = 1;
                        $cnt = 0;
                        $select_tilesy5 = "select * from rebound_hammer WHERE `lab_no`='$lab_no' AND  `job_no`='$job_no' and `is_deleted`='0'";
                        $result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
                        $coming_row = mysqli_num_rows($result_tiles_select15);

                        while ($row_select_pipe = mysqli_fetch_array($result_tiles_select15)) {
                            $flag5++;
                            $br++;
                            $cntrw++;

                        ?>
                            <tr style="">
                                <td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $count; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center;padding-bottom:5px;padding-top:5px; ">Beam at <?php echo $cnt; ?> mtr</td>
                                <td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">Horizontal</td>
                                <td style="border-top:1px solid;border-left:1px solid;width:7%;text-align:center; ">0&deg;</td>
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r1'] != "" && $row_select_pipe['rh_r1'] != null && $row_select_pipe['rh_r1'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r1'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r2'] != "" && $row_select_pipe['rh_r2'] != null && $row_select_pipe['rh_r2'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r2'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r3'] != "" && $row_select_pipe['rh_r3'] != null && $row_select_pipe['rh_r3'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r3'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r4'] != "" && $row_select_pipe['rh_r4'] != null && $row_select_pipe['rh_r4'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r4'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r5'] != "" && $row_select_pipe['rh_r5'] != null && $row_select_pipe['rh_r5'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r5'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r6'] != "" && $row_select_pipe['rh_r6'] != null && $row_select_pipe['rh_r6'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r6'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
								<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r7'] != "" && $row_select_pipe['rh_r7'] != null && $row_select_pipe['rh_r7'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r7'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
								<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r8'] != "" && $row_select_pipe['rh_r8'] != null && $row_select_pipe['rh_r8'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r8'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
								<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r9'] != "" && $row_select_pipe['rh_r9'] != null && $row_select_pipe['rh_r9'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r9'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['avg_r_num'] != "" && $row_select_pipe['avg_r_num'] != null && $row_select_pipe['avg_r_num'] != "0") {
                                                                                                                            echo $row_select_pipe['avg_r_num'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                       
								 <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['std_dev'] != "" && $row_select_pipe['std_dev'] != null && $row_select_pipe['std_dev'] != "0") {
                                                                                                                            echo $row_select_pipe['std_dev'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                       
								 <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['rh_max'] != "" && $row_select_pipe['rh_max'] != null && $row_select_pipe['rh_max'] != "0") {
                                                                                                                            echo $row_select_pipe['rh_max'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                       
								 <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['rh_min'] != "" && $row_select_pipe['rh_min'] != null && $row_select_pipe['rh_min'] != "0") {
                                                                                                                            echo $row_select_pipe['rh_min'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                        
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['rh_range'] != "" && $row_select_pipe['rh_range'] != null && $row_select_pipe['rh_range'] != "0") {
                                                                                                                            echo $row_select_pipe['rh_range'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                       
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['rh_rs'] != "" && $row_select_pipe['rh_rs'] != null && $row_select_pipe['rh_rs'] != "0") {
                                                                                                                            echo $row_select_pipe['rh_rs'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                       
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['rh_level'] != "" && $row_select_pipe['rh_level'] != null && $row_select_pipe['rh_level'] != "0") {
                                                                                                                            echo $row_select_pipe['rh_level'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                       
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['rh_out'] != "" && $row_select_pipe['rh_out'] != null && $row_select_pipe['rh_out'] != "0") {
                                                                                                                            echo $row_select_pipe['rh_out'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                      
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['rh_relation'] != "" && $row_select_pipe['rh_relation'] != null && $row_select_pipe['rh_relation'] != "0") {
                                                                                                                            echo $row_select_pipe['rh_relation'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                       
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['rh_verticle'] != "" && $row_select_pipe['rh_verticle'] != null && $row_select_pipe['rh_verticle'] != "0") {
                                                                                                                            echo $row_select_pipe['rh_verticle'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                       
                                    </tr>
                                <?php
                                                    $count++;
                                                    $cnt += 3;
                                                }
                                                //for($i=$count; $i<=10; $i++){
                                ?>
                                <!--tr style=""> 
                                                    <td  style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php //echo $i;
                                                                                                                                    ?></td>
                                                    <td  style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center;padding-bottom:5px;padding-top:5px; "></td>
                                                    <td  style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">Horizontal</td>
                                                    <td  style="border-top:1px solid;border-left:1px solid;width:7%;text-align:center; ">0&deg;</td>
                                                    <td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
                                                    <td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
                                                    <td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
                                                    <td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
                                                    <td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
                                                    <td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
                                                    <td  style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "></td>
                                                    <td  style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "></td>
                                                </tr-->
                                <?php
                                //}
                                ?>


                    </table>

                    </td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
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