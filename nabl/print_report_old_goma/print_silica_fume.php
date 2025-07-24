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
        width: 21cm;
        height: 29.7cm;
    }

    @media print {
        #header_hide_show {
            display: none !important;

        }
    }
</style>
<style>
    .tdclass {
        border: 1px solid black;
        font-size: 12px;
        font-family: Arial;

    }

    .test {
        border-collapse: collapse;
        font-size: 12px;
        font-family: Arial;
    }

    .tdclass1 {

        font-size: 12px;
        font-family: Arial;
    }

    div.vertical-sentence {
        -ms-writing-mode: tb-rl;
        /* for IE */
        -webkit-writing-mode: vertical-rl;
        /* for Webkit */
        writing-mode: vertical-rl;

    }

    .rotate-characters-back-to-horizontal {
        -webkit-text-orientation: upright;
        /* for Webkit */
        text-orientation: upright;
    }

    @media print {
        .noprint {
            visibility: hidden;
        }
    }
</style>
<html>

<body>
    <?php

    $job_no = $_GET['job_no'];
    $lab_no = $_GET['lab_no'];
    $report_no = $_GET['report_no'];
    $trf_no = $_GET['trf_no'];
    $select_tiles_query = "select * from silica_fume WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
    $result_tiles_select = mysqli_query($conn, $select_tiles_query);
    $row_select_pipe1 = mysqli_fetch_array($result_tiles_select);


    $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
    $result_select = mysqli_query($conn, $select_query);

    $row_select = mysqli_fetch_array($result_select);
    $clientname = $row_select['clientname'];

    $client_address = $row_select['clientaddress'];
    $r_name = $row_select['refno'];
    $r_date = $row_select['date'];
    $agreement_no = $row_select['agreement_no'];

    $rec_sample_date = $row_select['sample_rec_date'];
    $cons = $row_select['condition_of_sample_receved'];
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
        $issue_date = $row_select2['end_date'];
        $select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
        $result_select3 = mysqli_query($conn, $select_query3);

        if (mysqli_num_rows($result_select3) > 0) {
            $row_select3 = mysqli_fetch_assoc($result_select3);
            $mt_name = $row_select3['mt_name'];
        }
    }

    $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
    $result_select4 = mysqli_query($conn, $select_query4);

    if (mysqli_num_rows($result_select4) > 0) {
        $row_select4 = mysqli_fetch_assoc($result_select4);
        $cc_grade = $row_select4['cc_grade'];
        $cc_set_of_cube = $row_select4['cc_set_of_cube'];
        $cc_no_of_cube = $row_select4['cc_no_of_cube'];
        $cc_identification_mark = $row_select4['cc_identification_mark'];
        $day_remark = $row_select4['day_remark'];
        $casting_date = $row_select4['casting_date'];
        $material_location = $row_select4['material_location'];
    }



    ?>

    <!--<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()">-->
    <page size="A4">

        <div id="header">
            <br>
            <br>
        </div>
        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;margin-left:35px; ">
            <tr>
                <td style="text-align:center; font-size:20px; "><b>TEST REPORT</b></td>
            </tr>
        </table>
        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border:1px solid black;margin-left:35px; ">

            <tr style="border: 1px solid black;height:20px;">
                <td width="30%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if ($row_select_pipe1['ulr'] != "" && $row_select_pipe1['ulr'] != "0" && $row_select_pipe1['ulr'] != null) {
                                                                                            echo "<b>ULR:</b> " . $row_select_pipe1['ulr'];
                                                                                        } ?></td>

                <td width="65%" style="text-align:right; margin:15px;border-bottom: 1px solid black;  "><?php if ($report_no != "" && $report_no != "0" && $report_no != null) {
                                                                                                            echo " " . $report_no;
                                                                                                        } ?><b>&nbsp;/&nbsp;Date:</b> <?php echo date('d-m-Y', strtotime($issue_date)); ?>&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr style="border: 1px solid black;height:20px;">
                <td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Report Submited To </b></td>
                <td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
                                                                                        $result_selectc = mysqli_query($conn, $select_queryc);

                                                                                        if (mysqli_num_rows($result_selectc) > 0) {
                                                                                            $row_selectc = mysqli_fetch_assoc($result_selectc);
                                                                                            $ct_nm = $row_selectc['city_name'];
                                                                                        }
                                                                                        echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?> </td>
            </tr>
            <tr style="border: 1px solid black;height:Auto;height:20px;">
                <td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Name of <span id="put_details"></span><select style="font-weight:bold;border:0px;font-size:11px;" onchange="put_details()" id="details_of_sample">
                            <option>Work</option>
                            <option>Project</option>
                        </select></b></td>
                <td colspan="2" style="border-bottom: 1px solid black;padding-left:10px ">&nbsp;&nbsp;<?php echo $name_of_work; ?> </td>
            </tr>
            <tr style="border: 1px solid black;height:Auto;height:20px;">
                <td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Detailes of Sample</b></td>
                <td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $mt_name; ?> </td>
            </tr>
            <tr style="border: 1px solid black;height:20px;">
                <td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Reference Letter No.</b></td>
                <td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php
                                                                                        echo $r_name . " Date:" . date('d/m/Y', strtotime($row_select2["letter_date"]));

                                                                                        ?> </td>
            </tr>
            <tr style="border: 1px solid black;height:20px;">
                <td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Date of Receipt of Sample</b></td>
                <td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?> </td>
            </tr>
            <tr style="border: 1px solid black;height:20px;">
                <td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Condition of Sample during receipt</b></td>
                <td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if ($cons == "1") {
                                                                                            echo "Sealed";
                                                                                        } elseif ($cons == "2") {
                                                                                            echo "Unsealed";
                                                                                        } elseif ($cons == "3") {
                                                                                            echo "Good";
                                                                                        } elseif ($cons == "4") {
                                                                                            echo "Poor";
                                                                                        } else {
                                                                                            echo "Sealed";
                                                                                        } ?> </td>
            </tr>
            <tr style="border: 1px solid black;height:20px;">
                <td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Name of Agency</b></td>
                <td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
                                                                                        $result_selectc1 = mysqli_query($conn, $select_queryc1);

                                                                                        if (mysqli_num_rows($result_selectc1) > 0) {
                                                                                            $row_selectc1 = mysqli_fetch_assoc($result_selectc1);
                                                                                            $ct_nm1 = $row_selectc1['city_name'];
                                                                                        }
                                                                                        echo $agency_name . " " . $ct_nm1; ?> </td>
            </tr>
            <?php if ($agreement_no != "") { ?>
                <tr style="border: 1px solid black;height:20px;">
                    <td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Aggrement No.</b></td>
                    <td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
                </tr>
            <?php } ?>
            <tr style="border: 1px solid black;height:20px;">
                <td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Job No.</b></td>
                <td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
            </tr>
            <tr style="border: 1px solid black;height:20px;">
                <td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Lab No.</b></td>
                <td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php


                                                                                        echo $lab_no;
                                                                                        ?></td>
            </tr>
            <?php
            $first_tag = $row_select['first_tag'];
            $second_tag = $row_select['second_tag'];
            $third_tag = $row_select['third_tag'];
            $fourth_tag = $row_select['fourth_tag'];

            $first_txt = $row_select['first_txt'];
            $second_txt = $row_select['second_txt'];
            $third_txt = $row_select['third_txt'];
            $fourth_txt = $row_select['fourth_txt'];
            if ($first_tag != null && $first_tag != "") { ?>
                <tr>
                    <td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $first_tag; ?></b></td>
                    <td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $first_txt; ?></td>
                </tr>
            <?php }
            if ($second_tag != null && $second_tag != "") { ?>
                <tr>
                    <td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $second_tag; ?></b></td>
                    <td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $second_txt; ?></td>
                </tr>
            <?php }
            if ($third_tag != null && $third_tag != "") { ?>
                <tr>
                    <td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $third_tag; ?></b></td>
                    <td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $third_txt; ?></td>
                </tr>
            <?php }
            if ($fourth_tag != null && $fourth_tag != "") { ?>
                <tr>
                    <td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $fourth_tag; ?></b></td>
                    <td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $fourth_txt; ?></td>
                </tr>
            <?php } ?>



            <tr style="border: 1px solid black;height:20px;">
                <td width="35%" style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Starting Date of Test</b></td>
                <td width="20%" style="border-bottom: 1px solid black; border-right: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
            </TR>
            <tr style="border: 1px solid black;height:20px;">
                <td width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black; text-align:LEFT;">&nbsp;&nbsp;<b> Completion Date of Test &nbsp;</b></td>
                <td width="20%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date)); ?></td>
            </tr>
            <!--<tr>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp; Dear Sir. <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With the refference to your above letter the test result of Concrete Cubes for compressive strength test for <?php //echo $row_select_pipe['day1'];
                                                                                                                                                                                                                                                                                                                        ?> Days as &nbsp; under. The sample are tested as per IS 516(Part 1/Sec 1):2021</td>
				</tr>-->
        </table>
        <br>



        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border:1px solid black;margin-left:35px; ">


            <tr>
                <td style="font-size:15px;text-align:center"><b><u>Test Result</u></b></td>
            </tr>
            <tr>
                <!--OTHER START-->
                <td>
                    <table align="left" width="100%" class="test" style="height:Auto;width:100%;">
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;width:2%;"><b>Sr.<br>No.</b></td>
                            <td style="border:1px solid black;width:30%;"><b>Test Parameter</b></td>
                            <td style="border:1px solid black;width:10%;"><b>Units</b></td>
                            <td style="border:1px solid black;width:13%;"><b>Test Method</b></td>
                            <td style="border:1px solid black;width:13%;"><b>Test Result</b></td>
                            <td style="border:1px solid black;width:20%;"><b>Requirement as per IS <br>15388 : 2003<BR>(RA 2017)</b></td>
                        </tr>

                        <?php
                        $cnt = 0;


                        if ($row_select_pipe1['avg_wet'] != "" && $row_select_pipe1['avg_wet'] != "0" && $row_select_pipe1['avg_wet'] != null) {
                            $cnt++;
                        ?>
                            <tr style="text-align:center;">
                                <td style="border:1px solid black;"><b><?php echo $cnt; ?></b></td>
                                <td style="border:1px solid black; text-align:left;"><b>&nbsp; Wet sieving by 45 &micro; IS sieve</b></td>
                                <td style="border:1px solid black;">%</td>
                                <td style="border:1px solid black;">IS 1727:1967 (RA 2018) </td>
                                <td style="border:1px solid black;"><?php if ($row_select_pipe1['avg_wet'] != "" && $row_select_pipe1['avg_wet'] != "0" && $row_select_pipe1['avg_wet'] != null) {
                                                                        echo $row_select_pipe1['avg_wet'];
                                                                    } else {
                                                                        echo " <br>";
                                                                    } ?></td>
                                <td style="border:1px solid black;">10 Max.</td>
                            </tr>
                        <?php
                        }
                        if ($row_select_pipe1['avg_mo'] != "" && $row_select_pipe1['avg_mo'] != "0" && $row_select_pipe1['avg_mo'] != null) {
                            $cnt++;
                        ?>
                            <tr style="text-align:center;">
                                <td style="border:1px solid black;"><b><?php echo $cnt; ?></b></td>
                                <td style="border:1px solid black; text-align:left;"><b>&nbsp; Moisture Content</b></td>
                                <td style="border:1px solid black;">%</td>
                                <td style="border:1px solid black;">IS 3812 (Part 1):2013<br>(RA : 2017)</td>
                                <td style="border:1px solid black;"><?php if ($row_select_pipe1['avg_mo'] != "" && $row_select_pipe1['avg_mo'] != "0" && $row_select_pipe1['avg_mo'] != null) {
                                                                        echo $row_select_pipe1['avg_mo'];
                                                                    } else {
                                                                        echo " <br>";
                                                                    } ?></td>
                                <td style="border:1px solid black;">3 Max.</td>
                            </tr>
                        <?php
                        }

                        if ($row_select_pipe1['avg_fly'] != "" && $row_select_pipe1['avg_fly'] != "0" && $row_select_pipe1['avg_fly'] != null && $row_select_pipe1['avg_cem'] != "" && $row_select_pipe1['avg_cem'] != "0" && $row_select_pipe1['avg_cem'] != null) {
                            $cnt++;
                        ?>
                            <tr style="text-align:center;">
                                <td rowspan="3" style="border:1px solid black;"><b><?php echo $cnt; ?></b></td>
                                <td style="border:1px solid black; text-align:left;"><b>&nbsp; Compressive Strength at 7 Days, Min.</b></td>
                                <td style="border:1px solid black;">%</td>
                                <td rowspan="3" style="border:1px solid black;">IS 1727:1967 (RA 2018)</td>
                                <td style="border:1px solid black;"><?php
                                                                    $a1 = $row_select_pipe1['avg_fly'];
                                                                    $a2 = $row_select_pipe1['avg_cem'];

                                                                    $and = $a1 / $a2;
                                                                    $ans = $and * 100;

                                                                    echo round($ans);

                                                                    ?></td>
                                <td style="border:1px solid black;">Not Less than 85% of the strength of corresponding plain cement mortar cube</td>
                            </tr>
                            <tr style="text-align:center;">

                                <td style="border:1px solid black; text-align:left;"><b>&nbsp; Compressive Strength of Silica Mortar Cube</b></td>
                                <td style="border:1px solid black;">N/mm<sup>2</sup></td>

                                <td style="border:1px solid black;"><?php if ($row_select_pipe1['avg_fly'] != "" && $row_select_pipe1['avg_fly'] != "0" && $row_select_pipe1['avg_fly'] != null) {
                                                                        echo $row_select_pipe1['avg_fly'];
                                                                    } else {
                                                                        echo " <br>";
                                                                    } ?></td>
                                <td style="border:1px solid black;">-</td>
                            </tr>
                            <tr style="text-align:center;">
                                <td style="border:1px solid black; text-align:left;"><b>&nbsp; Compressive Strength of Plain Cement mortar Cube</b></td>
                                <td style="border:1px solid black;">N/mm<sup>2</sup></td>

                                <td style="border:1px solid black;"><?php if ($row_select_pipe1['avg_cem'] != "" && $row_select_pipe1['avg_cem'] != "0" && $row_select_pipe1['avg_cem'] != null) {
                                                                        echo $row_select_pipe1['avg_cem'];
                                                                    } else {
                                                                        echo " <br>";
                                                                    } ?></td>
                                <td style="border:1px solid black;">-</td>
                            </tr>
                        <?php
                        }

                        ?>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="text-align:center;width:33%;font-weight:bold;">*** END OF REPORT ***</td>
            </tr>
        </table>
        <br>
        <!--  <table align="center" width="92%" class="test" style="border:1px solid black;font-family: Arial;margin-left:35px; ">
            <tr>
                <td width="60px"><b style="">&nbsp; NOTE:- </b> </td>
                <td>
                    <p style="align:justify">[1]Test result related to sample collected by supplier. [2]Results/Report is issued with specific understanding the TMTL will not in any case be involved in action following the interpretation of test results. [3]The Reports/Results are not supposed to be used for publicity. (4) This report can not be reproduced in full or part without written approval of Quality Manager/ Technical Manager.</p>
                </td>
            </tr>
        </table>-->
        <br>
        <br>
        <!--table align="center" width="95%" style="font-family:arial;margin-left:35px;">
            <tr>
                <td style="">
                    <div style="float:right;" id="footer">

                    </div>
                </td>
                <td style="width:25%;">
                    <div style="float:right; text-align:center; padding-right:60px;" id="sign">
                        <img src="../images/stamp.png" width="160px">
                    </div>
                </td>
            </tr>
        </table-->







    </page>


</body>

</html>
<script src="jquery.min.js"></script>
<script type="text/javascript">
    function header() {
        if (document.querySelector('#header_hide_show').checked) {
            document.getElementById('header').innerHTML = '';
            document.getElementById("header").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" width="100%">');
            document.getElementById("footer").insertAdjacentHTML("afterbegin", '<img src="../images/stamp_tag.png" width="160px">');
            document.getElementById('sign').innerHTML = '';
            document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
        } else {
            document.getElementById('header').innerHTML = '';
            document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
            document.getElementById("footer").innerHTML = '';
            document.getElementById('sign').innerHTML = '';
            document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');
        }
    }

    function loading() {

        document.getElementById('header').innerHTML = '';
        document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
        document.getElementById("footer").innerHTML = '';
        document.getElementById('sign').innerHTML = '';
        document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');

    }
</script>