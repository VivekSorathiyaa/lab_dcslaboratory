<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
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
        font-size: 12px;
        font-family: Calibri;
    }

    .test {
        border-collapse: collapse;
        font-size: 12px;
        font-family: Calibri;
    }

    .test1 {
        font-size: 12px;
        border-collapse: collapse;
        font-family: Calibri;

    }

    .tdclass1 {

        font-size: 12px;
        font-family: Calibri;
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
    $select_tiles_query = "select * from span_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
    $branch_name = $row_select['branch_name'];
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

    $select_query2 = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
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
        $source = $row_select4['agg_source'];
        $type_of_cement = $row_select4['type_of_cement'];
        $cement_brand = $row_select4['cement_brand'];
        $cement_grade = $row_select4['cement_grade'];
        $week_no = $row_select4['week_no'];
        $in_grade = $row_select4['in_grade'];
    }

    $cnt = 1;
    $pagecnt = 0;
    $totalcnt = 0;
    if (($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) || ($row_select_pipe['initial_time'] != "" && $row_select_pipe['initial_time'] != "0" && $row_select_pipe['initial_time'] != null) || ($row_select_pipe['final_time'] != "" && $row_select_pipe['final_time'] != "0" && $row_select_pipe['final_time'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) || ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null)) {
        $totalcnt++;
    }
    if (($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) || ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null)) {
        $totalcnt++;
    }


    ?>


    <br>
    <br>
    <br>
    <page size="A4">
        <table align="center"
            style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"
            cellspacing="0" cellpadding="2px" bordercolor="black">
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img
                        src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;">
                </td>

            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">
                    NextGenLIMS Technologies</td>
            </tr>

            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">
                    <b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">
                    District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">
                    Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td
                    style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;">
                    <?php echo $mt_name; ?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;"
                    colspan="6"> ANALYSIS DATA SHEET </td>
                <td
                    style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">
                    QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card
                    No:&nbsp;<? php// echo $job_no; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
                    &nbsp;Test:&nbsp;<? php// echo $mt_name; ?>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample
                    Description:&nbsp;<?php echo $sample_de; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
                    &nbsp;Method:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">
                    &nbsp;DOR:&nbsp;<?php //echo date('d/m/Y', strtotime($row_select['sample_rec_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">
                    &nbsp;DOS:&nbsp;<? php// echo date('d-m-y', strtotime($row_select2['start_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">
                    &nbsp;DOC:&nbsp;<?php //echo date('d-m-y', strtotime($row_select2['end_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page
                    No:&nbsp;1</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample
                    Qty:&nbsp;<?php //echo $row_select_pipe['qty_1']; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual
                    Sample:&nbsp;<?php //echo $row_select_pipe['r_sam']; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample
                    Retention:&nbsp;<?php //echo $row_select_pipe['s_ret']; ?> </td>
            </tr>
        </table>

        <br><br><br>

        <table align="center" style="width: 95%;" cellpadding="10px">
            <tr>
                <td>1) Consistency of cement % :- IS 4031 (Part-4)</td>
            </tr>

        </table>

        <table align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0"
            cellpadding="5px">
            <tr>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    S. No.</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Wt. of Water (gm)</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Penetration (mm)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">Consistency (%)</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">1</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['vol_1']; ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['reading_1']; ?>
                </td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['wtr_1']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">2</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['vol_2']; ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['reading_2']; ?>
                </td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['wtr_2']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">3</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['vol_3']; ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['reading_3']; ?>
                </td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['wtr_3']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">4</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['vol_4']; ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['reading_4']; ?>
                </td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['wtr_4']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">5</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['vol_5']; ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['reading_5']; ?>
                </td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['wtr_5']; ?></td>
            </tr>

        </table>
        <br><br><br>

        <table align="center" style="width: 95%;" cellpadding="10px">
            <tr>
                <td>2) Setting Time (Min.):- IS 4031 (Part-5) &nbsp;&nbsp;&nbsp;&nbsp; Water=0.85 x P</td>
            </tr>

        </table>

        <table align="center" style="width: 95%;text-align: left;border-bottom:1px solid;" cellspacing="0"
            cellpadding="5px">
            <tr>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Starting Time:-&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row_select_pipe['hr_a']; ?></td>
                <td style="border-top: 1px solid;border-left: 0px solid;border-right: 1px solid;"></td>
            </tr>
            <tr>
                <td style="border-top: 0px solid;border-left: 1px solid;">
                    Initial:-&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['hr_b']; ?></td>
                <td style="border-top:0px solid;border-left:0px solid;border-right:1px solid;"></td>
            </tr>
            <tr>
                <td style="border-top:0px solid;border-left: 1px solid;">
                    Final:-&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['hr_c']; ?></td>
                <td style="border-top:0px solid;border-left:0px solid;border-right:1px solid;"></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">Initial Setting
                    Time:-&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['initial_time']; ?></td>
                <td style="border-top:1px solid;border-left:0px solid;border-right:1px solid;"></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">Final Setting
                    Time:-&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['final_time']; ?></td>
                <td style="border-top:1px solid;border-left:0px solid;border-right:1px solid;"></td>
            </tr>

        </table>

        <br><br><br>

        <table align="center" style="width: 95%;" cellpadding="10px">
            <tr>
                <td>3) Soundness By Le-Chatelier's:- IS 4031 (Part-3)</td>
            </tr>

        </table>

        <table align="center" style="width: 95%;text-align: left;border-bottom:1px solid;" cellspacing="0"
            cellpadding="5px">
            <tr>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    1</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Distance <sub>Before</sub> Heating (A) mm</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    <?php echo $row_select_pipe['dis_1_1']; ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">
                    <?php echo $row_select_pipe['dis_1_2']; ?></td>
            </tr>
            <tr>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    2</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Distance After Heating (B) mm</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    <?php echo $row_select_pipe['dis_2_1']; ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">
                    <?php echo $row_select_pipe['dis_2_2']; ?></td>
            </tr>
            <tr>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    3</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Expansion (B-A)</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    <?php echo $row_select_pipe['diff_1']; ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">
                    <?php echo $row_select_pipe['diff_2']; ?></td>
            </tr>
            <tr>
                <td colspan="2" style="border-top: 1px solid;border-left: 1px solid;font-weight: bold">Average</td>
                <td colspan="2" style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['soundness']; ?></td>
            </tr>
        </table>

        <br>
        <br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by :
                        <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By:
                        <u><?php echo $v_name; ?> </u></td></b>
            </tr>
        </table>
        <div class="pagebreak"></div>
        <br>
        <br>
        <br>
        <table align="center"
            style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"
            cellspacing="0" cellpadding="2px" bordercolor="black">
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img
                        src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;">
                </td>

            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">
                    NextGenLIMS Technologies</td>
            </tr>

            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">
                    <b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">
                    District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">
                    Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td
                    style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;">
                    <?php echo $mt_name; ?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;"
                    colspan="6"> ANALYSIS DATA SHEET </td>
                <td
                    style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">
                    QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card
                    No:&nbsp;<?php //echo $job_no; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
                    &nbsp;Test:&nbsp;<?php //echo $mt_name; ?>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample
                    Description:&nbsp;<?php echo $sample_de; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
                    &nbsp;Method:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">
                    &nbsp;DOR:&nbsp;<?php //echo //date('d/m/Y', strtotime($row_select['sample_rec_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">
                    &nbsp;DOS:&nbsp;<?php //echo date('d-m-y', strtotime($row_select2['start_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">
                    &nbsp;DOC:&nbsp;<? php// echo date('d-m-y', strtotime($row_select2['end_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page
                    No:&nbsp;1</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample
                    Qty:&nbsp;<?php //echo $row_select_pipe['qty_1']; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual
                    Sample:&nbsp;<?php //echo $row_select_pipe['r_sam']; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample
                    Retention:&nbsp;<? php// echo $row_select_pipe['s_ret']; ?> </td>
            </tr>
        </table>

        <br><br><br>

        <table align="center" style="width: 95%;" cellpadding="10px">
            <tr>
                <td>4) Compressive Strength % :- IS 4031 (Part-6)</td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>DOC:-<?php echo date("d/m/Y", strtotime($row_select_pipe['caste_date1'])); ?></td>
            </tr>

            <tr>
                <td>DOT:-<?php echo date("d/m/Y", strtotime($row_select_pipe['test_date1'])); ?></td>
            </tr>

            <tr>
                <td>Days:-<?php echo $row_select_pipe['day_1'] . " Day"; ?></td>
            </tr>

        </table>

        <table align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0"
            cellpadding="5px">
            <tr>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    S. No.</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Area(mm<sup>2</sup>)</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Load (KN)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">Compressive Strength
                    (N/mm<sup>2</sup>)</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">1</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">
                    <?php echo number_format($row_select_pipe['l1'] * $row_select_pipe['b1'], 2); ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_1']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['com_1']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">2</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">
                    <?php echo number_format($row_select_pipe['l2'] * $row_select_pipe['b2'], 2); ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_2']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['com_2']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">3</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">
                    <?php echo number_format($row_select_pipe['l3'] * $row_select_pipe['b3'], 2); ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_3']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['com_3']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;" colspan="3">Average</td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['avg_com_1']; ?></td>
            </tr>

        </table>

        <br><br><br>

        <table align="center" style="width: 95%;" cellpadding="10px">

            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>DOC:-<?php echo date("d/m/Y", strtotime($row_select_pipe['caste_date2'])); ?></td>
            </tr>

            <tr>
                <td>DOT:-<?php echo date("d/m/Y", strtotime($row_select_pipe['test_date2'])); ?></td>
            </tr>

            <tr>
                <td>Days:-<?php echo $row_select_pipe['day_2'] . " Day"; ?></td>
            </tr>

        </table>

        <table align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0"
            cellpadding="5px">
            <tr>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    S. No.</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Area(mm<sup>2</sup>)</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Load (KN)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">Compressive Strength
                    (N/mm<sup>2</sup>)</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">1</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">
                    <?php echo number_format($row_select_pipe['l4'] * $row_select_pipe['b4'], 2); ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_4']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['com_4']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">2</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">
                    <?php echo number_format($row_select_pipe['l5'] * $row_select_pipe['b5'], 2); ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_5']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['com_5']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">3</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">
                    <?php echo number_format($row_select_pipe['l6'] * $row_select_pipe['b6'], 2); ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_6']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['com_6']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;" colspan="3">Average</td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['avg_com_2']; ?></td>
            </tr>

        </table>

        <br><br><br>

        <table align="center" style="width: 95%;" cellpadding="10px">

            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>DOC:-<?php echo date("d/m/Y", strtotime($row_select_pipe['caste_date3'])); ?></td>
            </tr>

            <tr>
                <td>DOT:-<?php echo date("d/m/Y", strtotime($row_select_pipe['test_date3'])); ?></td>
            </tr>

            <tr>
                <td>Days:-<?php echo $row_select_pipe['day_3'] . " Day"; ?></td>
            </tr>

        </table>

        <table align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0"
            cellpadding="5px">
            <tr>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    S. No.</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Area(mm<sup>2</sup>)</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Load (KN)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">Compressive Strength
                    (N/mm<sup>2</sup>)</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">1</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">
                    <?php echo number_format($row_select_pipe['l7'] * $row_select_pipe['b7'], 2); ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_7']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['com_7']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">2</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">
                    <?php echo number_format($row_select_pipe['l8'] * $row_select_pipe['b8'], 2); ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_8']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['com_8']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">3</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">
                    <?php echo number_format($row_select_pipe['l9'] * $row_select_pipe['b9'], 2); ?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['load_9']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['com_9']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;" colspan="3">Average</td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['avg_com_3']; ?></td>
            </tr>

        </table>
        <br>
        <br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by :
                        <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By:
                        <u><?php echo $v_name; ?> </u></td></b>
            </tr>
        </table>
        <div class="pagebreak"></div>
        <br>
        <br>
        <br>
        <table align="center"
            style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"
            cellspacing="0" cellpadding="2px" bordercolor="black">
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img
                        src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;">
                </td>

            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">
                    NextGenLIMS Technologies</td>
            </tr>

            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">
                    <b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">
                    District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">
                    Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td
                    style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;">
                    <?php echo $mt_name; ?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;"
                    colspan="6"> ANALYSIS DATA SHEET </td>
                <td
                    style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">
                    QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card
                    No:&nbsp;<?php //echo $job_no; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
                    &nbsp;Test:&nbsp;<? php// echo $mt_name; ?>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample
                    Description:&nbsp;<?php //echo $sample_de; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
                    &nbsp;Method:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">
                    &nbsp;DOR:&nbsp;<? php// echo date('d/m/Y', strtotime($row_select['sample_rec_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">
                    &nbsp;DOS:&nbsp;<? php// echo date('d-m-y', strtotime($row_select2['start_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">
                    &nbsp;DOC:&nbsp;<? php// echo date('d-m-y', strtotime($row_select2['end_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page
                    No:&nbsp;1</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample
                    Qty:&nbsp;<?php //echo $row_select_pipe['qty_1']; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual
                    Sample:&nbsp;<?php //echo $row_select_pipe['r_sam']; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample
                    Retention:&nbsp;<?php //echo $row_select_pipe['s_ret']; ?> </td>
            </tr>
        </table>

        <br><br><br>
        <table align="center" style="width: 95%;text-align: center;border:0px solid;" cellspacing="5px"
            cellpadding="5px" bordercolor="black">
            <tr>
                <td style="font-family: 'Calibri';font-size: 25px;font-weight: bold;" colspan="7">DETERMINATION OF
                    DENSITY</td>
            </tr>
            <tr>
                <td style="font-family: 'Calibri';font-size: 15px;" colspan="7">As Per IS 4031 Part-11</td>
            </tr>
        </table>
        <br>

        <table align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0"
            cellpadding="5px">
            <tr>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    S. No.</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    DETERMINATION</td>
                <td
                    style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">
                    Trial-1</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">Trial-2</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">1</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">Temperature &deg;C</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['den_temp']; ?>
                </td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['den_temp']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">2</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">Weight of Sample gm</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">64 gm</td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">64 gm</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">3</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">Initial Reading ml</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['den_intial']; ?>
                </td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['den_intial1']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">4</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">Final Reading ml</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['den_final']; ?>
                </td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['den_final1']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">5</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">Volume ml</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">
                    <?php echo $row_select_pipe['den_displaced']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['den_displaced1']; ?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">6</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">Cement Density =
                    <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mass of Cement,g
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    P<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Displaced Volume,ml</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['density']; ?></td>
                <td style="border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['density1']; ?></td>
            </tr>

        </table>

        <br>
        <br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by :
                        <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By:
                        <u><?php echo $v_name; ?> </u></td></b>
            </tr>
        </table>
        <div class="pagebreak"></div>
        <br>
        <br>
        <br>
        <table align="center"
            style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"
            cellspacing="0" cellpadding="2px" bordercolor="black">
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img
                        src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;">
                </td>

            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">
                    NextGenLIMS Technologies</td>
            </tr>

            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">
                    <b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">
                    District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">
                    Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td
                    style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;">
                    <?php echo $mt_name; ?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;"
                    colspan="6"> ANALYSIS DATA SHEET </td>
                <td
                    style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">
                    QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card
                    No:&nbsp;<?php //echo $job_no; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
                    &nbsp;Test:&nbsp;<?php //echo $mt_name; ?>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample
                    Description:&nbsp;<?php //echo $sample_de; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
                    &nbsp;Method:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">
                    &nbsp;DOR:&nbsp;<?php //echo date('d/m/Y', strtotime($row_select['sample_rec_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">
                    &nbsp;DOS:&nbsp;<? php// echo date('d-m-y', strtotime($row_select2['start_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">
                    &nbsp;DOC:&nbsp;<?php //echo date('d-m-y', strtotime($row_select2['end_date'])); ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page
                    No:&nbsp;1</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample
                    Qty:&nbsp;<?php //echo $row_select_pipe['qty_1']; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual
                    Sample:&nbsp;<?php //echo $row_select_pipe['r_sam']; ?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample
                    Retention:&nbsp;<? php// echo $row_select_pipe['s_ret']; ?> </td>
            </tr>
        </table>

        <br><br><br>
        <table align="center" style="width: 95%;text-align: center;border:0px solid;" cellspacing="5px"
            cellpadding="5px" bordercolor="black">
            <tr>
                <td style="font-family: 'Calibri';font-size: 25px;font-weight: bold;" colspan="7">FINENESS BY DRY
                    SIEVING</td>
            </tr>
            <tr>
                <td style="font-family: 'Calibri';font-size: 15px;" colspan="7">IS 4031 Part-1</td>
            </tr>
        </table>
        <br>

        <table align="center" style="width: 95%;text-align:left;border-bottom:1px solid;" cellspacing="0"
            cellpadding="5px">
            <tr>
                <td
                    style="text-align: center;border-top: 1px solid;border-left: 1px solid;font-family:calibri;font-size: 15px;font-weight: bold">
                    S. No.</td>
                <td
                    style="text-align: center;border-top: 1px solid;border-left: 1px solid;font-family:calibri;font-size: 15px;font-weight: bold">
                    DETERMINATION</td>
                <td
                    style="text-align: center;border-top: 1px solid;border-left: 1px solid;font-family:calibri;font-size: 15px;font-weight: bold">
                    Trial-1</td>
                <td style="text-align: center;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">
                    Trial-2</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;border-left: 1px solid;">1</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">Wt. of Sample in gms (A)</td>
                <td style="text-align: center;border-top: 1px solid;border-left: 1px solid;">
                    <?php echo $row_select_pipe['d_t_1']; ?></td>
                <td style="text-align: center;border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['d_t_2']; ?></td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;border-left: 1px solid;">2</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">Wt. of Residue Retained on 90μ in gms (B)</td>
                <td style="text-align: center;border-top: 1px solid;border-left: 1px solid;">
                    <?php echo $row_select_pipe['w_t_1']; ?></td>
                <td style="text-align: center;border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['w_t_2']; ?></td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;border-left: 1px solid;">3</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">% Residue (B)/AX100</td>
                <td style="text-align: center;border-top: 1px solid;border-left: 1px solid;">
                    <?php echo $row_select_pipe['c_t_1']; ?></td>
                <td style="text-align: center;border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['c_t_2']; ?></td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;border-left: 1px solid;">4</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">Average</td>
                <td colspan="2"
                    style="text-align: center;border-top:1px solid;border-left:1px solid;border-right:1px solid;">
                    <?php echo $row_select_pipe['ss_area_1']; ?></td>
            </tr>

        </table>

        <br>
        <br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by :
                        <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By:
                        <u><?php echo $v_name; ?> </u></td></b>
            </tr>
        </table>


    </page>



</body>

</html>


<script type="text/javascript">

</script>