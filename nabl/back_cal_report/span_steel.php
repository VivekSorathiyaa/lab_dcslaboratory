<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
    @page {
        margin: 0 40px;
    }

    . {
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
    function round_up($number, $precision = 0)
    {
        $fig = (int) str_pad('1', $precision, '0');
        return (ceil($number * $fig) / $fig);
    }
    $job_no = $_GET['job_no'];
    $lab_no = $_GET['lab_no'];
    $report_no = $_GET['report_no'];
    $trf_no = $_GET['trf_no'];
    $select_tiles_query = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
    $result_tiles_select = mysqli_query($conn, $select_tiles_query);
    $no_of_rows = mysqli_num_rows($result_tiles_select);
    $page_cont = round_up($no_of_rows / 5);
    $row_select_pipe = mysqli_fetch_array($result_tiles_select);

    $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
    $result_select = mysqli_query($conn, $select_query);

    $row_select = mysqli_fetch_array($result_select);
    $clientname = $row_select['clientname'];

    $client_address = $row_select['clientaddress'];
    $r_name = $row_select['refno'];
    $agSTCment_no = $row_select['agSTCment_no'];

    $rec_sample_date = $row_select['sample_rec_date'];
    $cons = $row_select['condition_of_sample_receved'];
    $tpi_or_auth = $row_select['tpi_or_auth'];
    $pmc_heading = $row_select['pmc_heading'];
    $branch_name = $row_select['branch_name'];
    if ($cons == 0) {
        $con_sample = "Sealed";
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


    if ($row_select["agency_name"] != "") {
        $agency_name = $row_select['agency_name'];
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
            $mt_name = $row_select3['mt_name'];
			include_once 'sample_id.php';
        }
    }

    $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
    $result_select4 = mysqli_query($conn, $select_query4);

    if (mysqli_num_rows($result_select4) > 0) {
        $row_select4 = mysqli_fetch_assoc($result_select4);
        $material_location = $row_select4['material_location'];
        $dia = explode(",", $row_select4['steel_dia']);
        $grade = $row_select4['steel_grade'];
        $brand = $row_select4['steel_brand'];
        $sample_qty1 = $row_select4['steel_sample_qty'];
        $heat = $row_select4['steel_heat'];
        $steel_qty = $row_select4['steel_sample_qty'];
        $steel_source_name = $row_select4['steel_source_name'];

        $grade_data = explode(",", $row_select4['steel_grade']);
    }

    $flag = 0;
    $a = 1;
    $down = 0;
    $up = 5;
    /*for($a=0;$a<$page_cont;$a++)
			{*/
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON STEEL</td>
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
                    <?php $cnt = 1; ?>
                    <table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;" rowspan="4">Sr. <br>No.</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;" rowspan="2">Diameter of Bar</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;" rowspan="2">Weight of Bar</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 01px solid;" rowspan="2">Length of Bar</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 01px solid;" rowspan="2">Nominal Mass</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;" rowspan="2">Cross Sectional Area</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;" rowspan="2">Initial Gauge Length <br> IS 1608 PART-1</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;" rowspan="2">Final Gauge Length <br> IS 1608 PART-1</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;" rowspan="2">Observed Yield Load<br> IS 1608 PART-1 </td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;" rowspan="2">Yield Stress <br> IS 1608 : Part 1 : 2022</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;" rowspan="2">Observed Ultimate Load<br> IS 1608 PART-1</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 1px solid;" rowspan="2">Ultimate Stress<br> IS 1608 : Part 1 : 2022</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 1px solid;" rowspan="2">Elongation<br>IS 1608 : Part 1 : 2022</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;" rowspan="4">Bend Test<br>IS 1599 : 2019</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 2px solid;" rowspan="4">Rebend Test <br>IS 1599 : 2019</td>
                        </tr>
                        <tr>


                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-bottom: 1px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">Kg</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-TOP: 0px solid;">m</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;border-TOP: 0px solid;">Kg/m</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">mm<sup>2</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">N</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">N/mm<sup>2</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">N</td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">N/mm<sup>2</sup></td>
                            <td style="font-weight: bold;text-align: center;padding: 3px;border: 1px solid;">%</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;"></td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">a</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">b</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">c = a / b</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">d = c / 0.00785</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">e</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">f</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">g</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">g / d x 1000</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">h</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">h / d x 1000</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 2px solid;">(f-e) x 100
                                <hr>e
                            </td>
                        </tr>

                        <?php $count = 1;
						$cnt = 1;
						$cntrw=0;
						$select_tilesy5 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND  `job_no`='$job_no' and `is_deleted`='0'";
						$result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
						$coming_row = mysqli_num_rows($result_tiles_select15);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select15)) {
							$flag5++;
							$br++;
							$cntrw++;
						?>

                        <tr>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $cnt++; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['dia_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['w_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['l_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php if ($row_select_pipe['w_1'] != "" && $row_select_pipe['w_1'] != null && $row_select_pipe['w_1'] != "0") {
																																						if ($row_select_pipe['dia_1'] == "8 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3) ;
																																						} else if ($row_select_pipe['dia_1'] == "10 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3) ;
																																						} else if ($row_select_pipe['dia_1'] == "12 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3);
																																						} else if ($row_select_pipe['dia_1'] == "16 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3) ;
																																						} else if ($row_select_pipe['dia_1'] == "20 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3) ;
																																						} else if ($row_select_pipe['dia_1'] == "25 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3) ;
																																						} else if ($row_select_pipe['dia_1'] == "32 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3);
																																						} else if ($row_select_pipe['dia_1'] == "4 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3) ;
																																						} else if ($row_select_pipe['dia_1'] == "5 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3) ;
																																						} else if ($row_select_pipe['dia_1'] == "6 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3);
																																						} else if ($row_select_pipe['dia_1'] == "28 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3);
																																						} else if ($row_select_pipe['dia_1'] == "36 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3) ;
																																						} else if ($row_select_pipe['dia_1'] == "40 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3) ;
																																						} else if ($row_select_pipe['dia_1'] == "45 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3);
																																						} else if ($row_select_pipe['dia_1'] == "50 MM") {
																																							$w = $row_select_pipe['w_1'];
																																							$l = $row_select_pipe['l_1'];
																																							$ans = $w / $l;
																																							echo round($ans, 3) . "<br>" . "(15.42)";
																																						};
																																								} else {
																																									echo "-";
																																								} ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['cs_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['og_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['fg_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['yp_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['ys_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['up_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['ten_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['elo_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['bend_1']; ?></td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['rebend_1']; ?></td>
                        </tr>
						
						

                        <?php } ?>
						 <?php //if($cntrw<9){ 
							// for($cn=$cntrw;$cn<=9;$cn++)
							// {
						?>
							
						<!--<tr>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
                            <td style="text-align: center;padding: 3px;border: 1px solid;">&nbsp;</td>
							</tr>-->
							
							
							<?php  //}}?>
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
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
				</td>
			</tr>
            
        </table>
    </page>

    <?php

    /*if($flag==5)
				{
					$flag=0;
					$down=$up;
					$up +=5;*/
    ?>



    <!--<div class="pagebreak"> </div>-->
    <?php /*}*/


    /*}*/

    ?>

</body>

</html>


<script type="text/javascript">

</script>