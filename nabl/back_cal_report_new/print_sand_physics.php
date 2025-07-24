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
    $select_tiles_query = "select * from sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
    }
    $pagecnt = 1;
    $totalcnt = 1;
    if (($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != "0" && $row_select_pipe['avg_finer'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) {
        $totalcnt++;
    }
    ?>

    <br>
    <br>


    <page size="A4">
        <!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/C/OS/001</td>
                            <td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
                            <td style="width:25%; font-weight:bold;">RD :- 05/01/2023</td>
                            <td style="width:25%;font-weight:bold;">Page : 1</td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px;padding-left:15px;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
                            <td style="width:40%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:16px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:75%;padding-bottom:3px;padding-top:5px;padding-left:150px; text-align:center;font-weight:bold; ">Goma Engineering and Consultancy, Ahmedabad,</td>
                            <td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:150px; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:150px; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:1px;padding-top:3px; text-align:center;padding-left:150px; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:8px;padding-top:3px; text-align:center;padding-left:150px; ">Email: <u>gomaconsultancy@gmail.com</u></td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:18px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:18px;font-family: Cambria;">

                        <tr style="">

                            <td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; "><span style=""> OBSERVATION AND CALCULAITON SHEET FOR TEST ON FINE AGGREGATE</td>
                        </tr>

                    </table>

                </td>
            </tr>


            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">

                            <td style="width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Job No.</td>
                            <td style="border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Laboratory No</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Date of receipt of sample</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Date of starting test</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Probable date of completion</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
                        </tr>

                    </table><br>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">

                            <td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">1</td>
                            <td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Sieve Analyasis (IS:2386 Part-1)</td>

                        </tr>

                    </table><br>

                </td>
            </tr>


            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 0px 0px;margin-bottom:30px;">

                        <tr style="">

                            <td style="width:15%;text-align:center;font-weight:bold;  " rowspan=2>IS Sieve<br>Designation</td>
                            <td style="border-left:1px solid;width:65%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; " colspan=3>Weight retained</td>
                            <td style="border-left:1px solid;width:20%; text-align:center;font-weight:bold; " rowspan=2>Sand passing as %<br> of sand taken</td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;border-left:1px solid;width:20%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  ">Ind</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:center;font-weight:bold; ">Cum</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold; ">Cum%</td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:15%;padding-bottom:5px;padding-top:5px; text-align:center;  ">10mm</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_wt_gm_1'] != "" && $row_select_pipe['cum_wt_gm_1'] != "0" && $row_select_pipe['cum_wt_gm_1'] != null) {
                                                                                                                        echo $row_select_pipe['cum_wt_gm_1'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:center; "><?php if ($row_select_pipe['ret_wt_gm_1'] != "" && $row_select_pipe['ret_wt_gm_1'] != "0" && $row_select_pipe['ret_wt_gm_1'] != null) {
                                                                                                                        echo $row_select_pipe['ret_wt_gm_1'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_ret_1'] != "" && $row_select_pipe['cum_ret_1'] != "0" && $row_select_pipe['cum_ret_1'] != null) {
                                                                                                                        echo $row_select_pipe['cum_ret_1'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0" && $row_select_pipe['pass_sample_1'] != null) {
                                                                                                                        echo $row_select_pipe['pass_sample_1'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:15%;padding-bottom:5px;padding-top:5px; text-align:center;  ">4.75mm</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_wt_gm_2'] != "" && $row_select_pipe['cum_wt_gm_2'] != "0" && $row_select_pipe['cum_wt_gm_2'] != null) {
                                                                                                                        echo $row_select_pipe['cum_wt_gm_2'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:center; "><?php if ($row_select_pipe['ret_wt_gm_2'] != "" && $row_select_pipe['ret_wt_gm_2'] != "0" && $row_select_pipe['ret_wt_gm_2'] != null) {
                                                                                                                        echo $row_select_pipe['ret_wt_gm_2'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_ret_2'] != "" && $row_select_pipe['cum_ret_2'] != "0" && $row_select_pipe['cum_ret_2'] != null) {
                                                                                                                        echo $row_select_pipe['cum_ret_2'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['pass_sample_2'] != "" && $row_select_pipe['pass_sample_2'] != "0" && $row_select_pipe['pass_sample_2'] != null) {
                                                                                                                        echo $row_select_pipe['pass_sample_2'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:15%;padding-bottom:5px;padding-top:5px; text-align:center;  ">2.36mm</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_wt_gm_3'] != "" && $row_select_pipe['cum_wt_gm_3'] != "0" && $row_select_pipe['cum_wt_gm_3'] != null) {
                                                                                                                        echo $row_select_pipe['cum_wt_gm_3'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:center; "><?php if ($row_select_pipe['ret_wt_gm_3'] != "" && $row_select_pipe['ret_wt_gm_3'] != "0" && $row_select_pipe['ret_wt_gm_3'] != null) {
                                                                                                                        echo $row_select_pipe['ret_wt_gm_3'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_ret_3'] != "" && $row_select_pipe['cum_ret_3'] != "0" && $row_select_pipe['cum_ret_3'] != null) {
                                                                                                                        echo $row_select_pipe['cum_ret_3'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['pass_sample_3'] != "" && $row_select_pipe['pass_sample_3'] != "0" && $row_select_pipe['pass_sample_3'] != null) {
                                                                                                                        echo $row_select_pipe['pass_sample_3'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:15%;padding-bottom:5px;padding-top:5px; text-align:center;  ">1.18 mm</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_wt_gm_4'] != "" && $row_select_pipe['cum_wt_gm_4'] != "0" && $row_select_pipe['cum_wt_gm_4'] != null) {
                                                                                                                        echo $row_select_pipe['cum_wt_gm_4'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:center; "><?php if ($row_select_pipe['ret_wt_gm_4'] != "" && $row_select_pipe['ret_wt_gm_4'] != "0" && $row_select_pipe['ret_wt_gm_4'] != null) {
                                                                                                                        echo $row_select_pipe['ret_wt_gm_4'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_ret_4'] != "" && $row_select_pipe['cum_ret_4'] != "0" && $row_select_pipe['cum_ret_4'] != null) {
                                                                                                                        echo $row_select_pipe['cum_ret_4'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['pass_sample_4'] != "" && $row_select_pipe['pass_sample_4'] != "0" && $row_select_pipe['pass_sample_4'] != null) {
                                                                                                                        echo $row_select_pipe['pass_sample_4'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:15%;padding-bottom:5px;padding-top:5px; text-align:center;  ">600micron</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_wt_gm_5'] != "" && $row_select_pipe['cum_wt_gm_5'] != "0" && $row_select_pipe['cum_wt_gm_5'] != null) {
                                                                                                                        echo $row_select_pipe['cum_wt_gm_5'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:center; "><?php if ($row_select_pipe['ret_wt_gm_5'] != "" && $row_select_pipe['ret_wt_gm_5'] != "0" && $row_select_pipe['ret_wt_gm_5'] != null) {
                                                                                                                        echo $row_select_pipe['ret_wt_gm_5'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_ret_5'] != "" && $row_select_pipe['cum_ret_5'] != "0" && $row_select_pipe['cum_ret_5'] != null) {
                                                                                                                        echo $row_select_pipe['cum_ret_5'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['pass_sample_5'] != "" && $row_select_pipe['pass_sample_5pass_sample_5pass_sample_5pass_sample_5'] != "0" && $row_select_pipe['pass_sample_5'] != null) {
                                                                                                                        echo $row_select_pipe['pass_sample_5'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:15%;padding-bottom:5px;padding-top:5px; text-align:center;  ">300micron</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_wt_gm_6'] != "" && $row_select_pipe['cum_wt_gm_6'] != "0" && $row_select_pipe['cum_wt_gm_6'] != null) {
                                                                                                                        echo $row_select_pipe['cum_wt_gm_6'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:center; "><?php if ($row_select_pipe['ret_wt_gm_6'] != "" && $row_select_pipe['ret_wt_gm_6'] != "0" && $row_select_pipe['ret_wt_gm_6'] != null) {
                                                                                                                        echo $row_select_pipe['ret_wt_gm_6'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_ret_6'] != "" && $row_select_pipe['cum_ret_6'] != "0" && $row_select_pipe['cum_ret_6'] != null) {
                                                                                                                        echo $row_select_pipe['cum_ret_6'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['pass_sample_6'] != "" && $row_select_pipe['pass_sample_6'] != "0" && $row_select_pipe['pass_sample_6'] != null) {
                                                                                                                        echo $row_select_pipe['pass_sample_6'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:15%;padding-bottom:5px;padding-top:5px; text-align:center;  ">150micron</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_wt_gm_7'] != "" && $row_select_pipe['cum_wt_gm_7'] != "0" && $row_select_pipe['cum_wt_gm_7'] != null) {
                                                                                                                        echo $row_select_pipe['cum_wt_gm_7'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:center; "><?php if ($row_select_pipe['ret_wt_gm_7'] != "" && $row_select_pipe['ret_wt_gm_7'] != "0" && $row_select_pipe['ret_wt_gm_7'] != null) {
                                                                                                                        echo $row_select_pipe['ret_wt_gm_7'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_ret_7'] != "" && $row_select_pipe['cum_ret_7'] != "0" && $row_select_pipe['cum_ret_7'] != null) {
                                                                                                                        echo $row_select_pipe['cum_ret_7'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    }  ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['pass_sample_7'] != "" && $row_select_pipe['pass_sample_7'] != "0" && $row_select_pipe['pass_sample_7'] != null) {
                                                                                                                        echo $row_select_pipe['pass_sample_7'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
            </tr>
            <tr style="">

                <td style="border-top:1px solid;width:15%;padding-bottom:5px;padding-top:5px; text-align:center;  ">Pan</td>
                <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_wt_gm_8'] != "" && $row_select_pipe['cum_wt_gm_8'] != "0" && $row_select_pipe['cum_wt_gm_8'] != null) {
                                                                                                            echo $row_select_pipe['cum_wt_gm_8'];
                                                                                                        } else {
                                                                                                            echo "&nbsp;";
                                                                                                        }  ?></td>
                <td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:center; "><?php if ($row_select_pipe['ret_wt_gm_8'] != "" && $row_select_pipe['ret_wt_gm_8'] != "0" && $row_select_pipe['ret_wt_gm_8'] != null) {
                                                                                                            echo $row_select_pipe['ret_wt_gm_8'];
                                                                                                        } else {
                                                                                                            echo "&nbsp;";
                                                                                                        } ?></td>
                <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['cum_ret_8'] != "" && $row_select_pipe['cum_ret_8'] != "0" && $row_select_pipe['cum_ret_8'] != null) {
                                                                                                            echo $row_select_pipe['cum_ret_8'];
                                                                                                        } else {
                                                                                                            echo "&nbsp;";
                                                                                                        }  ?></td>
                <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['pass_sample_8'] != "" && $row_select_pipe['pass_sample_8'] != "0" && $row_select_pipe['pass_sample_8'] != null) {
                                                                                                            echo $row_select_pipe['pass_sample_8'];
                                                                                                        } else {
                                                                                                            echo "&nbsp;";
                                                                                                        } ?></td>
            </tr>
            </tr>
            <tr style="">

                <td style="border-top:1px solid;width:15%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  ">TOTAL</td>
                <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['blank_extra'] != "" && $row_select_pipe['blank_extra'] != "0" && $row_select_pipe['blank_extra'] != null) {
                                                                                                                            echo $row_select_pipe['blank_extra'];
                                                                                                                        } else {
                                                                                                                            echo "&nbsp;";
                                                                                                                        }  ?></td>
                <td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:center;font-weight:bold; "><?php echo ($row_select_pipe['ret_wt_gm_1'] + $row_select_pipe['ret_wt_gm_2'] + $row_select_pipe['ret_wt_gm_3'] + $row_select_pipe['ret_wt_gm_4'] + $row_select_pipe['ret_wt_gm_5'] + $row_select_pipe['ret_wt_gm_6'] + $row_select_pipe['ret_wt_gm_7'] + $row_select_pipe['ret_wt_gm_8']); ?></td>
                <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold; "><?php echo ($row_select_pipe['cum_ret_1'] + $row_select_pipe['cum_ret_2'] + $row_select_pipe['cum_ret_3'] + $row_select_pipe['cum_ret_4'] + $row_select_pipe['cum_ret_5'] + $row_select_pipe['cum_ret_6'] + $row_select_pipe['cum_ret_7'] + $row_select_pipe['cum_ret_8']); ?></td>
                <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold; "><?php echo ($row_select_pipe['pass_sample_1'] + $row_select_pipe['pass_sample_2'] + $row_select_pipe['pass_sample_3'] + $row_select_pipe['pass_sample_4'] + $row_select_pipe['pass_sample_5'] + $row_select_pipe['pass_sample_6'] + $row_select_pipe['pass_sample_7'] + $row_select_pipe['pass_sample_8']); ?></td>
            </tr>
            </tr>
            <tr style="">

                <td style="border-top:1px solid;width:15%; text-align:center;font-weight:bold;  " colspan=4></td>
                <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:5px;padding-top:5px; ">&nbsp; F.M. =&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if ($row_select_pipe['grd_fm'] != "" && $row_select_pipe['grd_fm'] != "0" && $row_select_pipe['grd_fm'] != null) {
                                                                                                                                                                                                        echo $row_select_pipe['grd_fm'];
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo "&nbsp;";
                                                                                                                                                                                                    } ?></td>
            </tr>
            </tr>
            <tr style="">

                <td style="width:15%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  " colspan=4></td>
                <td style="border-top:1px solid;border-bottom:1px solid;border-left:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:5px;padding-top:5px; ">&nbsp; Zone = &nbsp;&nbsp;&nbsp;<?php if ($row_select_pipe['grd_zone'] != "" && $row_select_pipe['grd_zone'] != "0" && $row_select_pipe['grd_zone'] != null) {
                                                                                                                                                                                                                    echo $row_select_pipe['grd_zone'];
                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                    echo "&nbsp;";
                                                                                                                                                                                                                }  ?></td>
            </tr>

        </table>

        </td>
        </tr>

        <tr>
            <td style="text-align:right;font-size:11px; ">

                <table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

                    <tr style="">

                        <td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page:1/2</td>
                    </tr>

                </table>

            </td>
        </tr>


        <div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


        </div>
        </table>




        <div class="pagebreak"></div>

        <br>
        <br>








        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/C/OS/001</td>
                            <td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
                            <td style="width:25%; font-weight:bold;">RD :- 05/01/2023</td>
                            <td style="width:25%;font-weight:bold;">Page : 2</td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
                            <td style="width:40%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:15px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:15px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:75%;padding-bottom:3px;padding-top:5px;padding-left:170px; text-align:center;font-weight:bold; ">Goma Engineering and Consultancy, Ahmedabad,</td>
                            <td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:170px; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:170px; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:1px;padding-top:3px; text-align:center;padding-left:170px; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
                        </tr>
                        <tr style="">
                            <td style="width:75%;padding-bottom:8px;padding-top:3px; text-align:center;padding-left:170px; ">Email: <u>gomaconsultancy@gmail.com</u></td>
                        </tr>

                    </table><br>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">

                            <td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">2</td>
                            <td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Specific Gravity and Water Absorption ( IS : 2386 Part-3)</td>

                        </tr>

                    </table><br>

                </td>
            </tr>


            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:30px;">

                        <tr style="">

                            <td style="width:10%;text-align:center;font-weight:bold;  ">Sr. No.</td>
                            <td style="border-left:1px solid;width:46%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; "><u>Particular</u></td>
                            <td style="border-left:1px solid;width:22%; text-align:center;font-weight:bold; "><u>1</u></td>
                            <td style="border-left:1px solid;width:22%; text-align:center;font-weight:bold; "><u>2</u></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Total taken sand weight (A)</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_wt_st_1'] != "" && $row_select_pipe['sp_wt_st_1'] != "0" && $row_select_pipe['sp_wt_st_1'] != null) {
                                                                                                                        echo number_format($row_select_pipe['sp_wt_st_1'], 1);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_wt_st_2'] != "" && $row_select_pipe['sp_wt_st_2'] != "0" && $row_select_pipe['sp_wt_st_2'] != null) {
                                                                                                                        echo number_format($row_select_pipe['sp_wt_st_2'], 1);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Empty Pycnometer bottle weight</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; ">120</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; ">125</td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Pycnometer with filled Distlled water (C )</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_w_sur_1'] != "" && $row_select_pipe['sp_w_sur_1'] != "0" && $row_select_pipe['sp_w_sur_1'] != null) {
                                                                                                                        echo $row_select_pipe['sp_w_sur_1'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_w_sur_2'] != "" && $row_select_pipe['sp_w_sur_2'] != "0" && $row_select_pipe['sp_w_sur_2'] != null) {
                                                                                                                        echo $row_select_pipe['sp_w_sur_2'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Bottle + Sand + Distlled Water (B)</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_w_sur_1'] != "" && $row_select_pipe['sp_w_sur_1'] != "0" && $row_select_pipe['sp_w_sur_1'] != null) {
                                                                                                                        echo ($row_select_pipe['sp_w_sur_1'] + $row_select_pipe['sp_wt_st_1'] + 120);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_w_sur_2'] != "" && $row_select_pipe['sp_w_sur_2'] != "0" && $row_select_pipe['sp_w_sur_2'] != null) {
                                                                                                                        echo ($row_select_pipe['sp_w_sur_2'] + $row_select_pipe['sp_wt_st_2'] + 125);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Oven dry sand (D)</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_w_s_1'] != "" && $row_select_pipe['sp_w_s_1'] != "0" && $row_select_pipe['sp_w_s_1'] != null) {
                                                                                                                        echo $row_select_pipe['sp_w_s_1'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_w_s_2'] != "" && $row_select_pipe['sp_w_s_2'] != "0" && $row_select_pipe['sp_w_s_2'] != null) {
                                                                                                                        echo $row_select_pipe['sp_w_s_2'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; S.P. Gravity = D/(A-(B-C))</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_specific_gravity_1'] != "" && $row_select_pipe['sp_specific_gravity_1'] != "0" && $row_select_pipe['sp_specific_gravity_1'] != null) {
                                                                                                                        echo $row_select_pipe['sp_specific_gravity_1'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_specific_gravity_2'] != "" && $row_select_pipe['sp_specific_gravity_2'] != "0" && $row_select_pipe['sp_specific_gravity_2'] != null) {
                                                                                                                        echo $row_select_pipe['sp_specific_gravity_2'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Water absorption = {(A-D)/D}*100</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_water_abr_1'] != "" && $row_select_pipe['sp_water_abr_1'] != "0" && $row_select_pipe['sp_water_abr_1'] != null) {
                                                                                                                        echo $row_select_pipe['sp_water_abr_1'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['sp_water_abr_2'] != "" && $row_select_pipe['sp_water_abr_2'] != "0" && $row_select_pipe['sp_water_abr_2'] != null) {
                                                                                                                        echo $row_select_pipe['sp_water_abr_2'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Average Specific Gravity</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; " colspan=2><?php if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) {
                                                                                                                                echo $row_select_pipe['sp_specific_gravity'];
                                                                                                                            } else {
                                                                                                                                echo "&nbsp;";
                                                                                                                            } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Average Water Absorption</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; " colspan=2><?php if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) {
                                                                                                                                echo $row_select_pipe['sp_water_abr'];
                                                                                                                            } else {
                                                                                                                                echo "&nbsp;";
                                                                                                                            } ?></td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">

                            <td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">3</td>
                            <td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Material Finer Than 75 Micron Sieve ( IS : 2386 Part-1)</td>

                        </tr>

                    </table><br>

                </td>
            </tr>


            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:30px;">

                        <tr style="">

                            <td style="width:10%;text-align:center;font-weight:bold;  ">Sr. No.</td>
                            <td style="border-left:1px solid;width:54%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; "><u>Particular</u></td>
                            <td style="border-left:1px solid;width:12%; text-align:center;font-weight:bold; "><u>1</u></td>
                            <td style="border-left:1px solid;width:12%; text-align:center;font-weight:bold; "><u>2</u></td>
                            <td style="border-left:1px solid;width:12%; text-align:center;font-weight:bold; "><u>3</u></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:54%;text-align:left; ">&nbsp;&nbsp; Wt in g of the Original Dry Sample(W1)</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['finer_a'] != "" && $row_select_pipe['finer_a'] != "0" && $row_select_pipe['finer_a'] != null) {
                                                                                                                        echo $row_select_pipe['finer_a'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['finer_c'] != "" && $row_select_pipe['finer_c'] != "0" && $row_select_pipe['finer_c'] != null) {
                                                                                                                        echo $row_select_pipe['finer_c'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['finer_d'] != "" && $row_select_pipe['finer_d'] != "0" && $row_select_pipe['finer_d'] != null) {
                                                                                                                        echo $row_select_pipe['finer_d'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:54%;text-align:left; ">&nbsp;&nbsp; Wt in g of of Dry Sample after Washing (W2)</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['finer_b'] != "" && $row_select_pipe['finer_b'] != "0" && $row_select_pipe['finer_b'] != null) {
                                                                                                                        echo number_format($row_select_pipe['finer_b'], 1);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['finer_e'] != "" && $row_select_pipe['finer_e'] != "0" && $row_select_pipe['finer_e'] != null) {
                                                                                                                        echo number_format($row_select_pipe['finer_e'], 1);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['finer_f'] != "" && $row_select_pipe['finer_f'] != "0" && $row_select_pipe['finer_f'] != null) {
                                                                                                                        echo number_format($row_select_pipe['finer_f'], 1);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:54%;text-align:left;padding-bottom:5px;padding-top:5px; ">&nbsp;&nbsp; Material Finer than 75 micron in %<br>&nbsp;&nbsp; = (W1-W2)/(W1)*100 </td>
                            <td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != "0" && $row_select_pipe['avg_finer'] != null) {
                                                                                                                        echo $row_select_pipe['avg_finer'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?> %</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['avg_finer1'] != "" && $row_select_pipe['avg_finer1'] != "0" && $row_select_pipe['avg_finer1'] != null) {
                                                                                                                        echo $row_select_pipe['avg_finer1'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?> %</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['avg_finer2'] != "" && $row_select_pipe['avg_finer2'] != "0" && $row_select_pipe['avg_finer2'] != null) {
                                                                                                                        echo $row_select_pipe['avg_finer2'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?> %</td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">

                            <td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">4</td>
                            <td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Bulk density ( IS : 2386 Part-3)</td>

                        </tr>

                    </table><br>

                </td>
            </tr>


            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:10px;">

                        <tr style="">

                            <td style="width:10%;text-align:center;font-weight:bold;  ">Sr. No.</td>
                            <td style="border-left:1px solid;width:46%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; "><u>Particular</u></td>
                            <td style="border-left:1px solid;width:22%; text-align:center;font-weight:bold; "><u>1</u></td>
                            <td style="border-left:1px solid;width:22%; text-align:center;font-weight:bold; "><u>2</u></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Volume of cylinder (cm&sup3;) V</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['m31'] != "" && $row_select_pipe['m31'] != "0" && $row_select_pipe['m31'] != null) {
                                                                                                                        echo $row_select_pipe['m31'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['m32'] != "" && $row_select_pipe['m32'] != "0" && $row_select_pipe['m32'] != null) {
                                                                                                                        echo $row_select_pipe['m32'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Empty Weight of Cylinder M<sub>1</sub> gm</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['m41'] != "" && $row_select_pipe['m41'] != "0" && $row_select_pipe['m41'] != null) {
                                                                                                                        echo $row_select_pipe['m41'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['m42'] != "" && $row_select_pipe['m42'] != "0" && $row_select_pipe['m42'] != null) {
                                                                                                                        echo $row_select_pipe['m42'];
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Weight of Cylinder + Aggregate M<sub>2</sub> gm</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['m41'] != "" && $row_select_pipe['m41'] != "0" && $row_select_pipe['m41'] != null) {
                                                                                                                        echo ($row_select_pipe['m41'] + $row_select_pipe['m51']);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['m42'] != "" && $row_select_pipe['m42'] != "0" && $row_select_pipe['m42'] != null) {
                                                                                                                        echo ($row_select_pipe['m42'] + $row_select_pipe['m52']);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Weight of Aggregate M<sub>3</sub>= M<sub>2</sub>-M<sub>1</sub> gm</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['m51'] != "" && $row_select_pipe['m51'] != "0" && $row_select_pipe['m51'] != null) {
                                                                                                                        echo ($row_select_pipe['m51'] - $row_select_pipe['m41']);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['m52'] != "" && $row_select_pipe['m52'] != "0" && $row_select_pipe['m52'] != null) {
                                                                                                                        echo ($row_select_pipe['m52'] - $row_select_pipe['m42']);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top:1px solid;width:10%;padding-bottom:5px;padding-top:5px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Bulk Density of Aggregate = M<sub>3</sub>/V ( gm/cc)</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['m51'] != "" && $row_select_pipe['m51'] != "0" && $row_select_pipe['m51'] != null) {
                                                                                                                        echo (($row_select_pipe['m51'] - $row_select_pipe['m41']) / $row_select_pipe['m31']);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['m52'] != "" && $row_select_pipe['m52'] != "0" && $row_select_pipe['m52'] != null) {
                                                                                                                        echo (($row_select_pipe['m52'] - $row_select_pipe['m42']) / $row_select_pipe['m32']);
                                                                                                                    } else {
                                                                                                                        echo "&nbsp;";
                                                                                                                    } ?></td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

                        <tr style="">

                            <td style="width:80%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By:-</td>
                            <td style="width:20%;text-align:left;font-weight:bold; ">Checked By:-</td>
                        </tr>

                    </table><br>

                </td>
            </tr>

            <tr>
                <td style="text-align:right;font-size:11px; ">

                    <table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

                        <tr style="">

                            <td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page:2/2</td>
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
