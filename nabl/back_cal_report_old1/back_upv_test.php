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
        font-size: 10px;
        font-family: Arial;
    }

    .test {
        border-collapse: collapse;
        font-size: 12px;
        font-family: Arial;
    }

    .test1 {
        font-size: 12px;
        border-collapse: collapse;
        font-family: Arial;

    }

    .tdclass1 {

        font-size: 11px;
        font-family: Arial;
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
            $detail_sample = $row_select3['mt_name'];
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


  <br><br>
    <page size="A4">
        <table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
                <tr>
                    <td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
                    <td colspan="2" style="font-size:14px;border: 1px solid black;">
                        <center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px;border: 1px solid black;">
                        <center><b>FMT-OBS</b></center>
                    </td>
                    <td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
                        <center><b>OBSERVATION & CALCULATION SHEET FOR Ultrasonic Pulse Vilocity</b></center>
                    </td>
                </tr>
            </table>
            <br><br>

            <table align="center" width="94%" class="test1" height="12%">
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
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of Testing</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of Casting</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d - m - Y', strtotime($row_select_pipe['start_date'])); ?></td>
			</tr>
		</table>
		<br>
        
          

          

            <tr>
                <td style="text-align:center;font-size:17px; ">

                    <table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:12px;">

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

                    <table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border:1px solid;margin-bottom:15px;">

                        <tr style="">

                            <td style="width:5%;font-weight:bold;padding-bottom:10px;text-align:center; ">Sr.<br> No.</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; ">Elements</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; ">Transmission<br>Type</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center;padding-bottom:10px;padding-top:10px;  ">Dist. Bet.<br>Transducers<br>in mm</td>
                            <td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Time in<br>µ sec</td>
                            <td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Velocity<br>km/sec</td>
                            <td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Temp.corr.<br>Factor</td>
                            <td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Moisture<br>condition</td>
                            <td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Quality of<br>Concrete</td>
                        </tr>
                        <?php
                        // $count=1;
                        // while($row_select_pipe = mysqli_fetch_array($result_tiles_select)){
                        ?>
                        <?php $count = 1;
                        $cnt = 1;
                        $select_tilesy5 = "select * from upv WHERE `lab_no`='$lab_no' AND  `job_no`='$job_no' and `is_deleted`='0'";
                        $result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
                        $coming_row = mysqli_num_rows($result_tiles_select15);

                        while ($row_select_pipe = mysqli_fetch_array($result_tiles_select15)) {
                            $flag5++;
                            $br++;
                            $cntrw++;

                        ?>
                            <tr style="">
                                <td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $count++; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['upv_detailes'] != "" && $row_select_pipe['upv_detailes'] != null && $row_select_pipe['upv_detailes'] != "0") {
                                                                                                                                                                echo $row_select_pipe['upv_detailes'];
                                                                                                                                                            } else {
                                                                                                                                                                echo "-";
                                                                                                                                                            } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if($row_select_pipe['trm_1']!="" && $row_select_pipe['trm_1']!=null && $row_select_pipe['trm_1']!="0"){echo $row_select_pipe['trm_1'];}else{echo "-";}
                                                                                                                        ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['dist_1'] != "" && $row_select_pipe['dist_1'] != null && $row_select_pipe['dist_1'] != "0") {
                                                                                                                            echo $row_select_pipe['dist_1'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['time_1'] != "" && $row_select_pipe['time_1'] != null && $row_select_pipe['time_1'] != "0") {
                                                                                                                            echo $row_select_pipe['time_1'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['velo_1'] != "" && $row_select_pipe['velo_1'] != null && $row_select_pipe['velo_1'] != "0") {
                                                                                                                            echo $row_select_pipe['velo_1'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['tecf_1'] != "" && $row_select_pipe['tecf_1'] != null && $row_select_pipe['tecf_1'] != "0") {
                                                                                                                            echo $row_select_pipe['tecf_1'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if($row_select_pipe['mco_1']!="" && $row_select_pipe['mco_1']!=null && $row_select_pipe['mco_1']!="0"){echo $row_select_pipe['mco_1'];}else{echo "-";}
                                                                                                                        ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['grading_1'] != "" && $row_select_pipe['grading_1'] != null && $row_select_pipe['grading_1'] != "0") {
                                                                                                                            echo $row_select_pipe['grading_1'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            </tr>
                        <?php
                            $cnt++;
                        }
                        ?>


                    </table>

                </td>
            </tr>


        <table align="center" width="94%" class="test1" style="margin-bottom: 20px;" Height="20%">
			<tr style="font-size:16px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Tested By: </b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
			</tr>		
		</table>
		<br><br><br><br>
				<table align="center" width="94%" class="test" height="Auto" style="border-top:1px solid black;">
			<tr style="">
				<td style="width:25%;padding-top:2px;"><center>Amendment No.: 00</center></td>
				<td style="width:25%;padding-top:2px;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;padding-top:2px;"><center>Prepared by:</center></td>
				<td style="width:16.67%;padding-top:2px;"><center>Approved by:</center></td>
				<td style="width:16.67%;padding-top:2px;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 01</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
            <tr >
				<td><center>Page 1 of 1</center></td>
			</tr>
		</table>


            <div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


            </div>
        </table>
    </page>

</body>

</html>

<script type="text/javascript">


</script>
