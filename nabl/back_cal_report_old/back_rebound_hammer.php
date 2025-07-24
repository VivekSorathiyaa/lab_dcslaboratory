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
    $select_tiles_query = "select * from rebound_hammer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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



    <page size="A4">
        <!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/NDT/OS/001</td>
                            <td style="width:20%;text-align:center;font-weight:bold; ">REV : 01</td>
                            <td style="width:25%; font-weight:bold;">RD :- 12.01.2023</td>
                            <td style="width:25%;font-weight:bold;">Page : </td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:70%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
                            <td style="width:30%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:16px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:75%;padding-bottom:3px;padding-top:3px;padding-left:150px; text-align:center;font-weight:bold; ">Goma Engineering and Consultancy, Ahmedabad,</td>
                            <td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:150px; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:150px; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:150px; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:150px; ">Email: gomaconsultancy@gmail.com</td>
                        </tr>

                    </table><br>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:16px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">

                            <td style="width:100%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold; "><span style="">OBSERVATION AND CALCULAITON SHEET FOR REBOUND HAMMER TEST (IS 132311:Part 2)</td>
                        </tr>

                    </table><br>

                </td>
            </tr>


            <?php /* $cnt=1;*/ ?>
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">
                            <td style="width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Location :-</td>
                            <td style="border-left:1px solid;width:45%;text-align:left; ">&nbsp;<?php if ($material_location == 1) {
                                                                                                    echo "In Laboratory";
                                                                                                } else {
                                                                                                    echo "In Field";
                                                                                                } ?> <?php echo $source; ?></td>
                            <td style="border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp; Testing Date :-</td>
                            <td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Date of Casting:-</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp; <?php //echo date('d - m - Y', strtotime(row_select_pipe['rh_cast_date'])); 
                                                                                                                        ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp; Sample Id:-</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; </td>
                        </tr>
                        <tr style="">
                            <?php
                            $select_query10 = "select * from span_cement WHERE `job_no`='$job_no'";
                            $result_select10 = mysqli_query($conn, $select_query10);
                            $row_select10 = mysqli_fetch_array($result_select10);
                            ?>
                            <td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Type of Cement:-</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select10['type_of_cement']; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp; Temperature:-</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp; <?php echo $row_select_pipe['temp']; ?> </td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Type of Aggregate:-</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp;&nbsp; rebound hammer</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp; </td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; </td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Surface Condition:-</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp; <?php echo $con_sample; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp; </td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; </td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Age of Concrete:-</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp;&nbsp; </td>
                            <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp;&nbsp; </td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; </td>
                        </tr>

                    </table><br>

                </td>
            </tr>


            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:13px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:25px;">

                        <tr style="">

                            <td style="width:7%;font-weight:bold;text-align:center; " rowspan=2>Sr No.</td>
                            <td style="border-left:1px solid;width:19%;font-weight:bold;text-align:center; " rowspan=2>Description</td>
                            <td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center; " rowspan=2>Direction</td>
                            <td style="border-left:1px solid;width:7%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px;  " rowspan=2>Angle</td>
                            <td style="border-left:1px solid;width:24%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px; " colspan=6>Rebound Number=N</td>
                            <td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; " rowspan=2>Average Rebound<br>Number</td>
                            <td style="border-left:1px solid;width:19%;font-weight:bold;text-align:center; " rowspan=2>Compressive<br>Strength N/mm&sup2;</td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center; ">1</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding-bottom:3px;padding-top:3px; ">2</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center; ">3</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center; ">4</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center; ">5</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center; ">6</td>
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
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r1'] != "" && $row_select_pipe['rh_r1'] != null && $row_select_pipe['rh_r1'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r1'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r1'] != "" && $row_select_pipe['rh_r1'] != null && $row_select_pipe['rh_r1'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r1'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r1'] != "" && $row_select_pipe['rh_r1'] != null && $row_select_pipe['rh_r1'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r1'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r1'] != "" && $row_select_pipe['rh_r1'] != null && $row_select_pipe['rh_r1'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r1'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['rh_r1'] != "" && $row_select_pipe['rh_r1'] != null && $row_select_pipe['rh_r1'] != "0") {
                                                                                                                                echo $row_select_pipe['rh_r1'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['avg_r_num'] != "" && $row_select_pipe['avg_r_num'] != null && $row_select_pipe['avg_r_num'] != "0") {
                                                                                                                            echo $row_select_pipe['avg_r_num'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['avg_com'] != "" && $row_select_pipe['avg_com'] != null && $row_select_pipe['avg_com'] != "0") {
                                                                                                                            echo $row_select_pipe['avg_com'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                </td>
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


        <tr>
            <td style="text-align:center;font-size:14px; ">

                <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

                    <tr style="">

                        <td style="width:80%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By:-</td>
                        <td style="width:20%;text-align:left;font-weight:bold; ">Checked By:-</td>
                    </tr>

                </table><br>

            </td>
        </tr>

        <tr>
            <td style="text-align:right;font-size:11px; ">

                <table align="right" width="20%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

                    <tr style="">

                        <td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page: 1/1</td>
                    </tr>

                </table>

            </td>
        </tr>


        <div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


        </div>
        </table>
    </page>

</body>

</html>

<script type="text/javascript">


</script>