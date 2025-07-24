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
</style>
<style>
    .tdclass {
        border: 1px solid black;
        font-size: 11px;
        font-family: Arial;

    }

    .test {
        border-collapse: collapse;
        font-size: 11px;
        font-family: Arial;
    }

    .tdclass1 {

        font-size: 11px;
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
</style>
<html>

<body>
    <?php
    $job_no = $_GET['job_no'];
    $lab_no = $_GET['lab_no'];
    $report_no = $_GET['report_no'];
    $trf_no = $_GET['trf_no'];
    $select_tiles_query = "select * from span_paver_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
    $result_tiles_select = mysqli_query($conn, $select_tiles_query);
    $row_select_pipe = mysqli_fetch_array($result_tiles_select);

    $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
    $result_select = mysqli_query($conn, $select_query);

    $row_select = mysqli_fetch_array($result_select);
    $clientname = $row_select['clientname'];

    $client_address = $row_select['clientaddress'];
    $r_name = $row_select['refno'];
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
        $issue_date = $row_select2['issue_date'];
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
        $paver_shape = $row_select4['paver_shape'];
        $paver_age = $row_select4['paver_age'];
        $paver_color = $row_select4['paver_color'];
        $paver_thickness = $row_select4['paver_thickness'];
        $paver_grade = $row_select4['paver_grade'];
        $material_location = $row_select4['material_location'];
        $material_condition = $row_select4['material_condition'];
    }

    if (($row_select_pipe['chk_abr'] != "" && $row_select_pipe['chk_abr'] != null && $row_select_pipe['chk_abr'] != "0") ||
        ($row_select_pipe['chk_ten'] != "" && $row_select_pipe['chk_ten'] != null && $row_select_pipe['chk_ten'] != "0") ||
        ($row_select_pipe['chk_fle'] != "" && $row_select_pipe['chk_fle'] != null && $row_select_pipe['chk_fle'] != "0")
    ) {
        $totalpage = 2;
    } else {
        $totalpage = 1;
    }

    ?>
    <?php
    if (($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != null && $row_select_pipe['avg_corr'] != "0") || ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0")) { ?>



        <page size="A4">
            <!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
            <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
                <tr>
                    <td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF PAVER BLOCK</u></b></td>
                </tr>
                <tr>
                    <td style="text-align:center;font-size:12px; ">

                        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                            <tr style="">

                                <td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
                                <td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp;
                                    <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
                                    $result_selectc = mysqli_query($conn, $select_queryc);

                                    if (mysqli_num_rows($result_selectc) > 0) {
                                        $row_selectc = mysqli_fetch_assoc($result_selectc);
                                        $ct_nm = $row_selectc['city_name'];
                                    }
                                    echo $clientname; ?>
                                </td>
                                <td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
                                <td style="border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
                            </tr>

                            <tr style="">

                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
                            </tr>
                            <tr style="">
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; </td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; ULR No.</td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
                            </tr>
                            <tr style="">

                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Name of TPI</td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp; <?php echo $row_select['tpi_name']; ?></td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp; Sample Cond.</td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php
                                                                                                                                                        if ($material_condition == "1") {
                                                                                                                                                            echo "Sealed";
                                                                                                                                                        }
                                                                                                                                                        if ($material_condition == "2") {
                                                                                                                                                            echo "Unsealed";
                                                                                                                                                        }
                                                                                                                                                        if ($material_condition == "3") {
                                                                                                                                                            echo "Good";
                                                                                                                                                        }
                                                                                                                                                        if ($material_condition == "4") {
                                                                                                                                                            echo "Poor";
                                                                                                                                                        }
                                                                                                                                                        ?></td>
                            </tr>

                            <tr style="">

                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Agency</td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp; <?php echo $agency_name; ?></td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
                                <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
                            </tr>



                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Receive Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
                </tr>


            </table><br>

            </td>
            </tr>
            <?php $cnt = 1; ?>
            <tr>
                <td>
                    <table align="left" width="70%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
                        <tr>
                            <td style="width:18%;font-weight:bold; text-align:left; ">THICKNESS:</td>
                            <td style="width:10%;font-weight:bold; text-align:left; "><?php echo $paver_thickness; ?></td>
                            <td style="border: 1px solid black;width:72%;text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; "><?php echo $paver_shape; ?> Paver Block ( <?php echo $paver_color; ?> )</td>
                        </tr>
                        <tr>
                            <td style="width:18%;font-weight:bold; text-align:left; ">GRADE:</td>
                            <td style="width:10%;font-weight:bold; text-align:left; "><?php echo $paver_grade; ?></td>
                        </tr>

                    </table><br><br><br>
                </td>
            </tr>

            <tr>
                <td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>Paver Block Compressive Strength Test</u></b></td>
            </tr>
            <tr>
                <td style="text-align:left; font-size:16px; "><b>Testing Procedure Was done as per mentioned in Indian standard Standard IS 15658</b></td>
            </tr>


            <tr>
                <td style="text-align:left;font-size:11px; ">
                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">
                            <td style="border-left: 1px solid black;border-top:1px solid;width:5%;font-weight:bold; text-align:center; ">Sr.NO.</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:13%;text-align:center;font-weight:bold; ">Laboratory <br> ID</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:13%; text-align:center;font-weight:bold;">Area <br>(mm<sup>2</sup>)</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:13%;font-weight:bold;text-align:center; ">Thickness<br>(mm)</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:13%;text-align:center;font-weight:bold;">Load<br> KN</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:13%;border-right: 1px solid;text-align:center;font-weight:bold;">Multiplication <br>on<br> Factor</td>
                            <td style="border-top:1px solid;width:13%;border-right: 1px solid;text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">Crushing <br>Strength <br>N/mm<sup>2</sup></td>
                            <td style="border-top:1px solid;width:17%;border-right: 1px solid;text-align:center;font-weight:bold;">Corrected Crushing<br> Strength<br> N/mm<sup>2</sup></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px; ">O-1</td>
                            <td style="border-left: 1px solid black;width:13%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != null && $row_select_pipe['area_1'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['area_1'], 0);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;"><?php if ($row_select_pipe['thick_1'] != "" && $row_select_pipe['thick_1'] != null && $row_select_pipe['thick_1'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['thick_1'], 2);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != null && $row_select_pipe['load_1'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['load_1'], 1);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['factor'] != "" && $row_select_pipe['factor'] != null && $row_select_pipe['factor'] != "0") {
                                                                                                                                                    echo number_format($row_select_pipe['factor'], 2);
                                                                                                                                                } else {
                                                                                                                                                    echo "-";
                                                                                                                                                } ?></td>
                            <td style="width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != null && $row_select_pipe['com_1'] != "0") {
                                                                                                                        echo $row_select_pipe['com_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <td style="width:17%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != null && $row_select_pipe['corr_1'] != "0") {
                                                                                                                        $ans1 = floatval($row_select_pipe['corr_1']);
                                                                                                                        $dts1 = $ans1 * 10.197;
                                                                                                                        echo number_format(floatval($dts1), 2);
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px; ">O-2</td>
                            <td style="border-left: 1px solid black;width:13%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != null && $row_select_pipe['area_2'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['area_2'], 0);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;"><?php if ($row_select_pipe['thick_2'] != "" && $row_select_pipe['thick_2'] != null && $row_select_pipe['thick_2'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['thick_2'], 2);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != null && $row_select_pipe['load_2'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['load_2'], 1);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['factor'] != "" && $row_select_pipe['factor'] != null && $row_select_pipe['factor'] != "0") {
                                                                                                                                                    echo number_format($row_select_pipe['factor'], 2);
                                                                                                                                                } else {
                                                                                                                                                    echo "-";
                                                                                                                                                } ?></td>
                            <td style="width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != null && $row_select_pipe['com_2'] != "0") {
                                                                                                                        echo number_format(floatval($row_select_pipe['com_2']), 2);
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <td style="width:17%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != null && $row_select_pipe['corr_2'] != "0") {
                                                                                                                        $ans1 = floatval($row_select_pipe['corr_2']);
                                                                                                                        $dts1 = $ans1 * 10.197;
                                                                                                                        echo number_format($dts1, 2);
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px; ">O-3</td>
                            <td style="border-left: 1px solid black;width:13%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != null && $row_select_pipe['area_3'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['area_3'], 0);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;"><?php if ($row_select_pipe['thick_3'] != "" && $row_select_pipe['thick_3'] != null && $row_select_pipe['thick_3'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['thick_3'], 2);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != null && $row_select_pipe['load_3'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['load_3'], 1);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['factor'] != "" && $row_select_pipe['factor'] != null && $row_select_pipe['factor'] != "0") {
                                                                                                                                                    echo number_format($row_select_pipe['factor'], 2);
                                                                                                                                                } else {
                                                                                                                                                    echo "-";
                                                                                                                                                } ?></td>
                            <td style="width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != null && $row_select_pipe['com_3'] != "0") {
                                                                                                                        echo number_format(floatval($row_select_pipe['com_3']), 2);
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <td style="width:17%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != null && $row_select_pipe['corr_3'] != "0") {
                                                                                                                        $ans1 = floatval($row_select_pipe['corr_3']);
                                                                                                                        $dts1 = $ans1 * 10.197;
                                                                                                                        echo number_format($dts1, 2);
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px; ">O-4</td>
                            <td style="border-left: 1px solid black;width:13%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != null && $row_select_pipe['area_4'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['area_4'], 0);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;"><?php if ($row_select_pipe['thick_4'] != "" && $row_select_pipe['thick_4'] != null && $row_select_pipe['thick_4'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['thick_4'], 2);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['load_4'] != "" && $row_select_pipe['load_4'] != null && $row_select_pipe['load_4'] != "0") {
                                                                                                                            echo number_format($row_select_pipe['load_4'], 1);
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['factor'] != "" && $row_select_pipe['factor'] != null && $row_select_pipe['factor'] != "0") {
                                                                                                                                                    echo number_format($row_select_pipe['factor'], 2);
                                                                                                                                                } else {
                                                                                                                                                    echo "-";
                                                                                                                                                } ?></td>
                            <td style="width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != null && $row_select_pipe['com_4'] != "0") {
                                                                                                                        echo number_format(floatval($row_select_pipe['com_4']), 2);
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <td style="width:17%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['corr_4'] != "" && $row_select_pipe['corr_4'] != null && $row_select_pipe['corr_4'] != "0") {
                                                                                                                        $ans1 = floatval($row_select_pipe['corr_4']);
                                                                                                                        $dts1 = $ans1 * 10.197;
                                                                                                                        echo number_format($dts1, 2);
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;padding-bottom:2px;padding-top:2px;" colspan=2> IS Limit</td>
                            <td style="font-weight:bold;border-left: 1px solid black;width:13%; text-align:center;border-top:1px solid;">--</td>
                            <td style="font-weight:bold;border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;"></td>
                            <td style="font-weight:bold;border-left: 1px solid black;width:13%;border-top:1px solid;text-align:center;">--</td>
                            <td style="font-weight:bold;border-left: 1px solid black;width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;">--</td>
                            <td style="font-weight:bold;width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;">Average</td>
                            <td style="font-weight:bold;width:17%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != null && $row_select_pipe['avg_corr'] != "0") {
                                                                                                                                        echo number_format(floatval($row_select_pipe['avg_corr']), 2);
                                                                                                                                    } else {
                                                                                                                                        echo "-";
                                                                                                                                    } ?></td>
                        </tr>

                    </table>

                </td>
            </tr>


            <tr>
                <td style="text-align:center; font-size:18px;padding-bottom:10px;padding-top:10px; "><b><u>Paver Block water Absorption Test</u></b></td>
            </tr>
            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:left;font-size:11px; ">
                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

                        <tr style="">
                            <td style="border-left: 1px solid black;border-top:1px solid;width:5%;font-weight:bold; text-align:center; ">Sr.NO.</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:13%;text-align:center;font-weight:bold; ">Laboratory <br>ID</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:19%;text-align:center;font-weight:bold; ">Surface Dry Weight (gm) (W1)</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:19%;text-align:center;font-weight:bold; ">Oven Dry Weight (gm) (W2)</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:19%;text-align:center;font-weight:bold; ">Water Absorption (%) (W1 – W2) x 100/W2</td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px; ">O-1</td>
                            <td style="border-left: 1px solid black;width:23%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['wtr_w1_1'] != "" && $row_select_pipe['wtr_w1_1'] != "0" && $row_select_pipe['wtr_w1_1'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_w1_1'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;"><?php if ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_w2_1'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_1'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px; ">O-2</td>
                            <td style="border-left: 1px solid black;width:23%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['wtr_w1_2'] != "" && $row_select_pipe['wtr_w1_2'] != "0" && $row_select_pipe['wtr_w1_2'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_w1_2'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;"><?php if ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_w2_2'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_2'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px; ">O-3</td>
                            <td style="border-left: 1px solid black;width:23%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['wtr_w1_3'] != "" && $row_select_pipe['wtr_w1_3'] != "0" && $row_select_pipe['wtr_w1_3'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_w1_3'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;"><?php if ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_w2_3'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_3'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px; ">O-4</td>
                            <td style="border-left: 1px solid black;width:23%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['wtr_w1_4'] != "" && $row_select_pipe['wtr_w1_4'] != "0" && $row_select_pipe['wtr_w1_4'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_w1_4'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;text-align:center; border-top:1px solid;"><?php if ($row_select_pipe['wtr_w2_4'] != "" && $row_select_pipe['wtr_w2_4'] != "0" && $row_select_pipe['wtr_w2_4'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_w2_4'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:13%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_4'] != "" && $row_select_pipe['wtr_4'] != "0" && $row_select_pipe['wtr_4'] != null) {
                                                                                                                            echo $row_select_pipe['wtr_4'];
                                                                                                                        } else {
                                                                                                                            echo " <br>";
                                                                                                                        } ?></td>
                        </tr>


                        <tr style="">

                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;font-weight:bold;padding-bottom:3px;padding-top:3px;" colspan="2"> IS Limit</td>
                            <td style="font-weight:bold;border-left: 1px solid black;width:13%; text-align:center;border-top:1px solid;">--</td>
                            <td style="font-weight:bold;border-left: 1px solid black;width:23%;text-align:center; border-top:1px solid;">--</td>
                            <!--td  style="font-weight:bold;border-left: 1px solid black;width:13%;border-top:1px solid;text-align:center;"></td>
							<td  style="font-weight:bold;border-left: 1px solid black;width:13%;border-right: 1px solid;border-top:1px solid;text-align:center;">--</td-->
                            <td style="border-left: 1px solid black;font-weight:bold;width:13%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null) {
                                                                                                                                            echo $row_select_pipe['avg_wtr'];
                                                                                                                                        } else {
                                                                                                                                            echo " <br>";
                                                                                                                                        } ?></td>
                            <!--td  style="font-weight:bold;width:10%;border-right: 1px solid;border-top:1px solid;text-align:center;">--</td-->
                        </tr>

                    </table>

                </td>
            </tr>



            <tr>
                <td style="text-align:center;font-size:11px; "><br>
                    <table align="center" width="100%" class="test" style="height:auto;font-family: Cambria; ">
                        <tr>
                            <td><b>Note :-</b></td>
                        </tr>
                        <tr>
                            <td><b> > &nbsp;</b>Test rcsults are related to samples submitted by customers only.</td>
                        </tr>
                        <tr>
                            <td><b> > &nbsp;</b> Test results are issued wilh specifïc understanding that GEC will not in any case be involved in action Following the information of the test results.</td>

                        </tr>
                        <tr>
                            <td><b> > &nbsp;</b> The Test reports are not supposed to be used for publicity.</td>

                        </tr>
                        <tr>
                            <td><b> > &nbsp;</b> Test report shall not be reproduced except in full Without written approvaI of GEC.</td>

                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="text-align:right;font-size:11px;padding-right:80px; "><br><br><br><br>
                    <table align="right" width="80%" class="test" style="height:auto;font-family: Cambria; ">
                        <tr>
                            <td style="text-align:right"><b>Approved By</b></td>
                        </tr>
                        <tr>
                            <td style="text-align:right"><b>For, Goma Engineering Consultancy,</b></td>
                        </tr>

                        <tr>

                            <td style="text-align:right"><b>| Darshan Patel |</b></td>

                        </tr>
                        <tr>

                            <td style="text-align:right"><b>Authorized Signatory</b></td>

                        </tr>
                    </table>
                </td>
            </tr>


            </table>



            <br>
            <table align="center" width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
                <tr>

                    <td style="width:40%;text-align:left;font-weight:bold;">
                        Page No. 1 of 1
                    </td>
                    <td style="width:60%;text-align:left;font-weight:bold;">
                        . . . . . . .END OF REPORT. . . . . . .
                    </td>
                </tr>

            </table>
            <div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


            </div>
        </page>
    <?php } ?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>