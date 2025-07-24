<?php
session_start();
include("../connection.php");
error_reporting(0); ?>
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
    $select_vtiles_query = "select * from vit_tiles WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
    $result_vtiles_select = mysqli_query($conn, $select_vtiles_query);
    $row_select_pipe = mysqli_fetch_array($result_vtiles_select);

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
        $mark = $row_select4['brick_mark'];
        $brick_specification = $row_select4['brick_specification'];
    }
    ?>

    <page size="A4">
        <br>
        <br>
        <table align="center" height="15%;" width="90%" class="test" style="border: 1px solid black;">
            <tr>
                <td colspan="4" style="border: 1px solid black;text-align:center;font-size:16px;"><b>TEC Material Testing Laboratory</b></td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black;width:50%;padding-left:10px;"> OBSERVATION AND CALCULATION SHEET FOR VITREOUS/GLAZED vtiles </td>
                <td colspan="2" style="border: 1px solid black;width:50%;padding-left:10px;"> F/Material/27, Issue No. 01,, <br>Page No. 1 of 1</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;width:25%;font-weight:bold;">&nbsp; Job No.</td>
                <td style="width:25%;">&nbsp; <?php echo $job_no; ?></td>
                <td style="width:25%;border: 1px solid black;font-weight:bold;text-align:right;"> Test Starting Date &nbsp;</td>
                <td style="width:25%;border: 1px solid black;">&nbsp; <?php echo date('d/m/Y', strtotime($start_date)); ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-weight:bold;">&nbsp; Lab No.</td>
                <td style="border: 1px solid black;">&nbsp; <?php echo $lab_no; ?></td>
                <td style="border: 1px solid black;font-weight:bold;text-align:right;"> Test Complition Date &nbsp;</td>
                <td style="border: 1px solid black;">&nbsp; <?php echo date('d/m/Y', strtotime($end_date)); ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-weight:bold;">&nbsp; Sample Details </td>
                <td colspan="3" style="border: 1px solid black;">&nbsp; <?php echo $mt_name; ?></td>
            </tr>
        </table>
        <p style="margin-left:40px;font-weight:bold;">1. DIMENTIONS: (IS 13630 P-1)</p>
        <table align="center" width="90%" class="test" style="border: 1px solid black;margin-top:-1px;">
            <tr>
                <td rowspan="2" style="border: 1px solid black;font-weight:bold;text-align:center;">Sr No</td>
                <td colspan="4" style="border: 1px solid black;font-weight:bold;text-align:center;">Length</td>
                <td colspan="4" style="border: 1px solid black;font-weight:bold;text-align:center;">Width</td>
                <td colspan="4" style="border: 1px solid black;font-weight:bold;text-align:center;">Thickness</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black;font-weight:bold;text-align:center;">Side-1</td>
                <td colspan="2" style="border: 1px solid black;font-weight:bold;text-align:center;">Side-2</td>
                <td colspan="2" style="border: 1px solid black;font-weight:bold;text-align:center;">Side-3</td>
                <td colspan="2" style="border: 1px solid black;font-weight:bold;text-align:center;">Side-4</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;">Side-1</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;">Side-2</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;">Side-3</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;">Side-4</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;width:4%;">1</td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['length_1_1'] != "" && $row_select_pipe['length_1_1'] != "0" && $row_select_pipe['length_1_1'] != null) {
                                                                                    echo $row_select_pipe['length_1_1'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['length_1_2'] != "" && $row_select_pipe['length_1_2'] != "0" && $row_select_pipe['length_1_2'] != null) {
                                                                                    echo $row_select_pipe['length_1_2'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['length_1_3'] != "" && $row_select_pipe['length_1_3'] != "0" && $row_select_pipe['length_1_3'] != null) {
                                                                                    echo $row_select_pipe['length_1_3'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['length_1_4'] != "" && $row_select_pipe['length_1_4'] != "0" && $row_select_pipe['length_1_4'] != null) {
                                                                                    echo $row_select_pipe['length_1_4'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['width_1_1'] != "" && $row_select_pipe['width_1_1'] != "0" && $row_select_pipe['width_1_1'] != null) {
                                                                                    echo $row_select_pipe['width_1_1'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['width_1_2'] != "" && $row_select_pipe['width_1_2'] != "0" && $row_select_pipe['width_1_2'] != null) {
                                                                                    echo $row_select_pipe['width_1_2'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['width_1_3'] != "" && $row_select_pipe['width_1_3'] != "0" && $row_select_pipe['width_1_3'] != null) {
                                                                                    echo $row_select_pipe['width_1_3'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['width_1_4'] != "" && $row_select_pipe['width_1_4'] != "0" && $row_select_pipe['width_1_4'] != null) {
                                                                                    echo $row_select_pipe['width_1_4'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['thick_1_1'] != "" && $row_select_pipe['thick_1_1'] != "0" && $row_select_pipe['thick_1_1'] != null) {
                                                                                    echo $row_select_pipe['thick_1_1'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['thick_1_2'] != "" && $row_select_pipe['thick_1_2'] != "0" && $row_select_pipe['thick_1_2'] != null) {
                                                                                    echo $row_select_pipe['thick_1_2'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['thick_1_3'] != "" && $row_select_pipe['thick_1_3'] != "0" && $row_select_pipe['thick_1_3'] != null) {
                                                                                    echo $row_select_pipe['thick_1_3'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
                <td style="border: 1px solid black;text-align:center;width:8%;"><?php if ($row_select_pipe['thick_1_4'] != "" && $row_select_pipe['thick_1_4'] != "0" && $row_select_pipe['thick_1_4'] != null) {
                                                                                    echo $row_select_pipe['thick_1_4'];
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">2</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_2_1'] != "" && $row_select_pipe['length_2_1'] != "0" && $row_select_pipe['length_2_1'] != null) {
                                                                            echo $row_select_pipe['length_2_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_2_2'] != "" && $row_select_pipe['length_2_2'] != "0" && $row_select_pipe['length_2_2'] != null) {
                                                                            echo $row_select_pipe['length_2_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_2_3'] != "" && $row_select_pipe['length_2_3'] != "0" && $row_select_pipe['length_2_3'] != null) {
                                                                            echo $row_select_pipe['length_2_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_2_4'] != "" && $row_select_pipe['length_2_4'] != "0" && $row_select_pipe['length_2_4'] != null) {
                                                                            echo $row_select_pipe['length_2_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_2_1'] != "" && $row_select_pipe['width_2_1'] != "0" && $row_select_pipe['width_2_1'] != null) {
                                                                            echo $row_select_pipe['width_2_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_2_2'] != "" && $row_select_pipe['width_2_2'] != "0" && $row_select_pipe['width_2_2'] != null) {
                                                                            echo $row_select_pipe['width_2_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_2_3'] != "" && $row_select_pipe['width_2_3'] != "0" && $row_select_pipe['width_2_3'] != null) {
                                                                            echo $row_select_pipe['width_2_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_2_4'] != "" && $row_select_pipe['width_2_4'] != "0" && $row_select_pipe['width_2_4'] != null) {
                                                                            echo $row_select_pipe['width_2_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_2_1'] != "" && $row_select_pipe['thick_2_1'] != "0" && $row_select_pipe['thick_2_1'] != null) {
                                                                            echo $row_select_pipe['thick_2_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_2_2'] != "" && $row_select_pipe['thick_2_2'] != "0" && $row_select_pipe['thick_2_2'] != null) {
                                                                            echo $row_select_pipe['thick_2_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_2_3'] != "" && $row_select_pipe['thick_2_3'] != "0" && $row_select_pipe['thick_2_3'] != null) {
                                                                            echo $row_select_pipe['thick_2_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_2_4'] != "" && $row_select_pipe['thick_2_4'] != "0" && $row_select_pipe['thick_2_4'] != null) {
                                                                            echo $row_select_pipe['thick_2_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">3</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_3_1'] != "" && $row_select_pipe['length_3_1'] != "0" && $row_select_pipe['length_3_1'] != null) {
                                                                            echo $row_select_pipe['length_3_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_3_2'] != "" && $row_select_pipe['length_3_2'] != "0" && $row_select_pipe['length_3_2'] != null) {
                                                                            echo $row_select_pipe['length_3_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_3_3'] != "" && $row_select_pipe['length_3_3'] != "0" && $row_select_pipe['length_3_3'] != null) {
                                                                            echo $row_select_pipe['length_3_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_3_4'] != "" && $row_select_pipe['length_3_4'] != "0" && $row_select_pipe['length_3_4'] != null) {
                                                                            echo $row_select_pipe['length_3_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_3_1'] != "" && $row_select_pipe['width_3_1'] != "0" && $row_select_pipe['width_3_1'] != null) {
                                                                            echo $row_select_pipe['width_3_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_3_2'] != "" && $row_select_pipe['width_3_2'] != "0" && $row_select_pipe['width_3_2'] != null) {
                                                                            echo $row_select_pipe['width_3_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_3_3'] != "" && $row_select_pipe['width_3_3'] != "0" && $row_select_pipe['width_3_3'] != null) {
                                                                            echo $row_select_pipe['width_3_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_3_4'] != "" && $row_select_pipe['width_3_4'] != "0" && $row_select_pipe['width_3_4'] != null) {
                                                                            echo $row_select_pipe['width_3_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_3_1'] != "" && $row_select_pipe['thick_3_1'] != "0" && $row_select_pipe['thick_3_1'] != null) {
                                                                            echo $row_select_pipe['thick_3_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_3_2'] != "" && $row_select_pipe['thick_3_2'] != "0" && $row_select_pipe['thick_3_2'] != null) {
                                                                            echo $row_select_pipe['thick_3_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_3_3'] != "" && $row_select_pipe['thick_3_3'] != "0" && $row_select_pipe['thick_3_3'] != null) {
                                                                            echo $row_select_pipe['thick_3_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_3_4'] != "" && $row_select_pipe['thick_3_4'] != "0" && $row_select_pipe['thick_3_4'] != null) {
                                                                            echo $row_select_pipe['thick_3_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">4</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_4_1'] != "" && $row_select_pipe['length_4_1'] != "0" && $row_select_pipe['length_4_1'] != null) {
                                                                            echo $row_select_pipe['length_4_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_4_2'] != "" && $row_select_pipe['length_4_2'] != "0" && $row_select_pipe['length_4_2'] != null) {
                                                                            echo $row_select_pipe['length_4_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_4_3'] != "" && $row_select_pipe['length_4_3'] != "0" && $row_select_pipe['length_4_3'] != null) {
                                                                            echo $row_select_pipe['length_4_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_4_4'] != "" && $row_select_pipe['length_4_4'] != "0" && $row_select_pipe['length_4_4'] != null) {
                                                                            echo $row_select_pipe['length_4_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_4_1'] != "" && $row_select_pipe['width_4_1'] != "0" && $row_select_pipe['width_4_1'] != null) {
                                                                            echo $row_select_pipe['width_4_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_4_2'] != "" && $row_select_pipe['width_4_2'] != "0" && $row_select_pipe['width_4_2'] != null) {
                                                                            echo $row_select_pipe['width_4_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_4_3'] != "" && $row_select_pipe['width_4_3'] != "0" && $row_select_pipe['width_4_3'] != null) {
                                                                            echo $row_select_pipe['width_4_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_4_4'] != "" && $row_select_pipe['width_4_4'] != "0" && $row_select_pipe['width_4_4'] != null) {
                                                                            echo $row_select_pipe['width_4_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_4_1'] != "" && $row_select_pipe['thick_4_1'] != "0" && $row_select_pipe['thick_4_1'] != null) {
                                                                            echo $row_select_pipe['thick_4_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_4_2'] != "" && $row_select_pipe['thick_4_2'] != "0" && $row_select_pipe['thick_4_2'] != null) {
                                                                            echo $row_select_pipe['thick_4_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_4_3'] != "" && $row_select_pipe['thick_4_3'] != "0" && $row_select_pipe['thick_4_3'] != null) {
                                                                            echo $row_select_pipe['thick_4_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_4_4'] != "" && $row_select_pipe['thick_4_4'] != "0" && $row_select_pipe['thick_4_4'] != null) {
                                                                            echo $row_select_pipe['thick_4_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">5</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_5_1'] != "" && $row_select_pipe['length_5_1'] != "0" && $row_select_pipe['length_5_1'] != null) {
                                                                            echo $row_select_pipe['length_5_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_5_2'] != "" && $row_select_pipe['length_5_2'] != "0" && $row_select_pipe['length_5_2'] != null) {
                                                                            echo $row_select_pipe['length_5_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_5_3'] != "" && $row_select_pipe['length_5_3'] != "0" && $row_select_pipe['length_5_3'] != null) {
                                                                            echo $row_select_pipe['length_5_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_5_4'] != "" && $row_select_pipe['length_5_4'] != "0" && $row_select_pipe['length_5_4'] != null) {
                                                                            echo $row_select_pipe['length_5_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_5_1'] != "" && $row_select_pipe['width_5_1'] != "0" && $row_select_pipe['width_5_1'] != null) {
                                                                            echo $row_select_pipe['width_5_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_5_2'] != "" && $row_select_pipe['width_5_2'] != "0" && $row_select_pipe['width_5_2'] != null) {
                                                                            echo $row_select_pipe['width_5_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_5_3'] != "" && $row_select_pipe['width_5_3'] != "0" && $row_select_pipe['width_5_3'] != null) {
                                                                            echo $row_select_pipe['width_5_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_5_4'] != "" && $row_select_pipe['width_5_4'] != "0" && $row_select_pipe['width_5_4'] != null) {
                                                                            echo $row_select_pipe['width_5_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_5_1'] != "" && $row_select_pipe['thick_5_1'] != "0" && $row_select_pipe['thick_5_1'] != null) {
                                                                            echo $row_select_pipe['thick_5_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_5_2'] != "" && $row_select_pipe['thick_5_2'] != "0" && $row_select_pipe['thick_5_2'] != null) {
                                                                            echo $row_select_pipe['thick_5_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_5_3'] != "" && $row_select_pipe['thick_5_3'] != "0" && $row_select_pipe['thick_5_3'] != null) {
                                                                            echo $row_select_pipe['thick_5_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_5_4'] != "" && $row_select_pipe['thick_5_4'] != "0" && $row_select_pipe['thick_5_4'] != null) {
                                                                            echo $row_select_pipe['thick_5_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">6</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_6_1'] != "" && $row_select_pipe['length_6_1'] != "0" && $row_select_pipe['length_6_1'] != null) {
                                                                            echo $row_select_pipe['length_6_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_6_2'] != "" && $row_select_pipe['length_6_2'] != "0" && $row_select_pipe['length_6_2'] != null) {
                                                                            echo $row_select_pipe['length_6_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_6_3'] != "" && $row_select_pipe['length_6_3'] != "0" && $row_select_pipe['length_6_3'] != null) {
                                                                            echo $row_select_pipe['length_6_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_6_4'] != "" && $row_select_pipe['length_6_4'] != "0" && $row_select_pipe['length_6_4'] != null) {
                                                                            echo $row_select_pipe['length_6_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_6_1'] != "" && $row_select_pipe['width_6_1'] != "0" && $row_select_pipe['width_6_1'] != null) {
                                                                            echo $row_select_pipe['width_6_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_6_2'] != "" && $row_select_pipe['width_6_2'] != "0" && $row_select_pipe['width_6_2'] != null) {
                                                                            echo $row_select_pipe['width_6_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_6_3'] != "" && $row_select_pipe['width_6_3'] != "0" && $row_select_pipe['width_6_3'] != null) {
                                                                            echo $row_select_pipe['width_6_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_6_4'] != "" && $row_select_pipe['width_6_4'] != "0" && $row_select_pipe['width_6_4'] != null) {
                                                                            echo $row_select_pipe['width_6_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_6_1'] != "" && $row_select_pipe['thick_6_1'] != "0" && $row_select_pipe['thick_6_1'] != null) {
                                                                            echo $row_select_pipe['thick_6_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_6_2'] != "" && $row_select_pipe['thick_6_2'] != "0" && $row_select_pipe['thick_6_2'] != null) {
                                                                            echo $row_select_pipe['thick_6_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_6_3'] != "" && $row_select_pipe['thick_6_3'] != "0" && $row_select_pipe['thick_6_3'] != null) {
                                                                            echo $row_select_pipe['thick_6_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_6_4'] != "" && $row_select_pipe['thick_6_4'] != "0" && $row_select_pipe['thick_6_4'] != null) {
                                                                            echo $row_select_pipe['thick_6_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">7</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_7_1'] != "" && $row_select_pipe['length_7_1'] != "0" && $row_select_pipe['length_7_1'] != null) {
                                                                            echo $row_select_pipe['length_7_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_7_2'] != "" && $row_select_pipe['length_7_2'] != "0" && $row_select_pipe['length_7_2'] != null) {
                                                                            echo $row_select_pipe['length_7_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_7_3'] != "" && $row_select_pipe['length_7_3'] != "0" && $row_select_pipe['length_7_3'] != null) {
                                                                            echo $row_select_pipe['length_7_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_7_4'] != "" && $row_select_pipe['length_7_4'] != "0" && $row_select_pipe['length_7_4'] != null) {
                                                                            echo $row_select_pipe['length_7_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_7_1'] != "" && $row_select_pipe['width_7_1'] != "0" && $row_select_pipe['width_7_1'] != null) {
                                                                            echo $row_select_pipe['width_7_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_7_2'] != "" && $row_select_pipe['width_7_2'] != "0" && $row_select_pipe['width_7_2'] != null) {
                                                                            echo $row_select_pipe['width_7_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_7_3'] != "" && $row_select_pipe['width_7_3'] != "0" && $row_select_pipe['width_7_3'] != null) {
                                                                            echo $row_select_pipe['width_7_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_7_4'] != "" && $row_select_pipe['width_7_4'] != "0" && $row_select_pipe['width_7_4'] != null) {
                                                                            echo $row_select_pipe['width_7_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_7_1'] != "" && $row_select_pipe['thick_7_1'] != "0" && $row_select_pipe['thick_7_1'] != null) {
                                                                            echo $row_select_pipe['thick_7_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_7_2'] != "" && $row_select_pipe['thick_7_2'] != "0" && $row_select_pipe['thick_7_2'] != null) {
                                                                            echo $row_select_pipe['thick_7_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_7_3'] != "" && $row_select_pipe['thick_7_3'] != "0" && $row_select_pipe['thick_7_3'] != null) {
                                                                            echo $row_select_pipe['thick_7_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_7_4'] != "" && $row_select_pipe['thick_7_4'] != "0" && $row_select_pipe['thick_7_4'] != null) {
                                                                            echo $row_select_pipe['thick_7_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">8</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_8_1'] != "" && $row_select_pipe['length_8_1'] != "0" && $row_select_pipe['length_8_1'] != null) {
                                                                            echo $row_select_pipe['length_8_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_8_2'] != "" && $row_select_pipe['length_8_2'] != "0" && $row_select_pipe['length_8_2'] != null) {
                                                                            echo $row_select_pipe['length_8_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_8_3'] != "" && $row_select_pipe['length_8_3'] != "0" && $row_select_pipe['length_8_3'] != null) {
                                                                            echo $row_select_pipe['length_8_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_8_4'] != "" && $row_select_pipe['length_8_4'] != "0" && $row_select_pipe['length_8_4'] != null) {
                                                                            echo $row_select_pipe['length_8_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_8_1'] != "" && $row_select_pipe['width_8_1'] != "0" && $row_select_pipe['width_8_1'] != null) {
                                                                            echo $row_select_pipe['width_8_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_8_2'] != "" && $row_select_pipe['width_8_2'] != "0" && $row_select_pipe['width_8_2'] != null) {
                                                                            echo $row_select_pipe['width_8_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_8_3'] != "" && $row_select_pipe['width_8_3'] != "0" && $row_select_pipe['width_8_3'] != null) {
                                                                            echo $row_select_pipe['width_8_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_8_4'] != "" && $row_select_pipe['width_8_4'] != "0" && $row_select_pipe['width_8_4'] != null) {
                                                                            echo $row_select_pipe['width_8_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_8_1'] != "" && $row_select_pipe['thick_8_1'] != "0" && $row_select_pipe['thick_8_1'] != null) {
                                                                            echo $row_select_pipe['thick_8_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_8_2'] != "" && $row_select_pipe['thick_8_2'] != "0" && $row_select_pipe['thick_8_2'] != null) {
                                                                            echo $row_select_pipe['thick_8_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_8_3'] != "" && $row_select_pipe['thick_8_3'] != "0" && $row_select_pipe['thick_8_3'] != null) {
                                                                            echo $row_select_pipe['thick_8_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_8_4'] != "" && $row_select_pipe['thick_8_4'] != "0" && $row_select_pipe['thick_8_4'] != null) {
                                                                            echo $row_select_pipe['thick_8_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">9</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_9_1'] != "" && $row_select_pipe['length_9_1'] != "0" && $row_select_pipe['length_9_1'] != null) {
                                                                            echo $row_select_pipe['length_9_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_9_2'] != "" && $row_select_pipe['length_9_2'] != "0" && $row_select_pipe['length_9_2'] != null) {
                                                                            echo $row_select_pipe['length_9_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_9_3'] != "" && $row_select_pipe['length_9_3'] != "0" && $row_select_pipe['length_9_3'] != null) {
                                                                            echo $row_select_pipe['length_9_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_9_4'] != "" && $row_select_pipe['length_9_4'] != "0" && $row_select_pipe['length_9_4'] != null) {
                                                                            echo $row_select_pipe['length_9_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_9_1'] != "" && $row_select_pipe['width_9_1'] != "0" && $row_select_pipe['width_9_1'] != null) {
                                                                            echo $row_select_pipe['width_9_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_9_2'] != "" && $row_select_pipe['width_9_2'] != "0" && $row_select_pipe['width_9_2'] != null) {
                                                                            echo $row_select_pipe['width_9_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_9_3'] != "" && $row_select_pipe['width_9_3'] != "0" && $row_select_pipe['width_9_3'] != null) {
                                                                            echo $row_select_pipe['width_9_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_9_4'] != "" && $row_select_pipe['width_9_4'] != "0" && $row_select_pipe['width_9_4'] != null) {
                                                                            echo $row_select_pipe['width_9_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_9_1'] != "" && $row_select_pipe['thick_9_1'] != "0" && $row_select_pipe['thick_9_1'] != null) {
                                                                            echo $row_select_pipe['thick_9_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_9_2'] != "" && $row_select_pipe['thick_9_2'] != "0" && $row_select_pipe['thick_9_2'] != null) {
                                                                            echo $row_select_pipe['thick_9_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_9_3'] != "" && $row_select_pipe['thick_9_3'] != "0" && $row_select_pipe['thick_9_3'] != null) {
                                                                            echo $row_select_pipe['thick_9_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_9_4'] != "" && $row_select_pipe['thick_9_4'] != "0" && $row_select_pipe['thick_9_4'] != null) {
                                                                            echo $row_select_pipe['thick_9_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">10</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_10_1'] != "" && $row_select_pipe['length_10_1'] != "0" && $row_select_pipe['length_10_1'] != null) {
                                                                            echo $row_select_pipe['length_10_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_10_2'] != "" && $row_select_pipe['length_10_2'] != "0" && $row_select_pipe['length_10_2'] != null) {
                                                                            echo $row_select_pipe['length_10_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_10_3'] != "" && $row_select_pipe['length_10_3'] != "0" && $row_select_pipe['length_10_3'] != null) {
                                                                            echo $row_select_pipe['length_10_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['length_10_4'] != "" && $row_select_pipe['length_10_4'] != "0" && $row_select_pipe['length_10_4'] != null) {
                                                                            echo $row_select_pipe['length_10_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_10_1'] != "" && $row_select_pipe['width_10_1'] != "0" && $row_select_pipe['width_10_1'] != null) {
                                                                            echo $row_select_pipe['width_10_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_10_2'] != "" && $row_select_pipe['width_10_2'] != "0" && $row_select_pipe['width_10_2'] != null) {
                                                                            echo $row_select_pipe['width_10_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_10_3'] != "" && $row_select_pipe['width_10_3'] != "0" && $row_select_pipe['width_10_3'] != null) {
                                                                            echo $row_select_pipe['width_10_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['width_10_4'] != "" && $row_select_pipe['width_10_4'] != "0" && $row_select_pipe['width_10_4'] != null) {
                                                                            echo $row_select_pipe['width_10_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_10_1'] != "" && $row_select_pipe['thick_10_1'] != "0" && $row_select_pipe['thick_10_1'] != null) {
                                                                            echo $row_select_pipe['thick_10_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_10_2'] != "" && $row_select_pipe['thick_10_2'] != "0" && $row_select_pipe['thick_10_2'] != null) {
                                                                            echo $row_select_pipe['thick_10_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_10_3'] != "" && $row_select_pipe['thick_10_3'] != "0" && $row_select_pipe['thick_10_3'] != null) {
                                                                            echo $row_select_pipe['thick_10_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thick_10_4'] != "" && $row_select_pipe['thick_10_4'] != "0" && $row_select_pipe['thick_10_4'] != null) {
                                                                            echo $row_select_pipe['thick_10_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">Average</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_1'] != "" && $row_select_pipe['avg_1_1'] != "0" && $row_select_pipe['avg_1_1'] != null) {
                                                                            echo $row_select_pipe['avg_1_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_2'] != "" && $row_select_pipe['avg_1_2'] != "0" && $row_select_pipe['avg_1_2'] != null) {
                                                                            echo $row_select_pipe['avg_1_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_3'] != "" && $row_select_pipe['avg_1_3'] != "0" && $row_select_pipe['avg_1_3'] != null) {
                                                                            echo $row_select_pipe['avg_1_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_4'] != "" && $row_select_pipe['avg_1_4'] != "0" && $row_select_pipe['avg_1_4'] != null) {
                                                                            echo $row_select_pipe['avg_1_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_5'] != "" && $row_select_pipe['avg_1_5'] != "0" && $row_select_pipe['avg_1_5'] != null) {
                                                                            echo $row_select_pipe['avg_1_5'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_6'] != "" && $row_select_pipe['avg_1_6'] != "0" && $row_select_pipe['avg_1_6'] != null) {
                                                                            echo $row_select_pipe['avg_1_6'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_7'] != "" && $row_select_pipe['avg_1_7'] != "0" && $row_select_pipe['avg_1_7'] != null) {
                                                                            echo $row_select_pipe['avg_1_7'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_8'] != "" && $row_select_pipe['avg_1_8'] != "0" && $row_select_pipe['avg_1_8'] != null) {
                                                                            echo $row_select_pipe['avg_1_8'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_9'] != "" && $row_select_pipe['avg_1_9'] != "0" && $row_select_pipe['avg_1_9'] != null) {
                                                                            echo $row_select_pipe['avg_1_9'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_10'] != "" && $row_select_pipe['avg_1_10'] != "0" && $row_select_pipe['avg_1_10'] != null) {
                                                                            echo $row_select_pipe['avg_1_10'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_11'] != "" && $row_select_pipe['avg_1_11'] != "0" && $row_select_pipe['avg_1_11'] != null) {
                                                                            echo $row_select_pipe['avg_1_11'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_1_12'] != "" && $row_select_pipe['avg_1_12'] != "0" && $row_select_pipe['avg_1_12'] != null) {
                                                                            echo $row_select_pipe['avg_1_12'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;"></td>
                <td colspan="4" style="border: 1px solid black;font-weight:bold;text-align:center;"><?php if ($row_select_pipe['avg_1'] != "" && $row_select_pipe['avg_1'] != "0" && $row_select_pipe['avg_1'] != null) {
                                                                                                        echo $row_select_pipe['avg_1'];
                                                                                                    } else {
                                                                                                        echo "-";
                                                                                                    } ?></td>
                <td colspan="4" style="border: 1px solid black;font-weight:bold;text-align:center;"><?php if ($row_select_pipe['avg_2'] != "" && $row_select_pipe['avg_2'] != "0" && $row_select_pipe['avg_2'] != null) {
                                                                                                        echo $row_select_pipe['avg_2'];
                                                                                                    } else {
                                                                                                        echo "-";
                                                                                                    } ?></td>
                <td colspan="4" style="border: 1px solid black;font-weight:bold;text-align:center;"><?php if ($row_select_pipe['avg_3'] != "" && $row_select_pipe['avg_3'] != "0" && $row_select_pipe['avg_3'] != null) {
                                                                                                        echo $row_select_pipe['avg_3'];
                                                                                                    } else {
                                                                                                        echo "-";
                                                                                                    } ?></td>
            </tr>
        </table>
        <p style="margin-left:40px;font-weight:bold;">2. WATER ABSORPTION: (IS 13630 P-2)</p>
        <table align="center" width="90%" class="test" style="border: 1px solid black;margin-top:-1px;">
            <tr>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:10%">Sr No</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:30%">Weight of Oven Dry <br> Sample in gm (A)</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:30%">Weight of Saturated <br> Surface Dry in gm (B)</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;width:30%">Water Absorption in % <br> = 100(B-A)/A</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">1</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_1'] != "" && $row_select_pipe['wtr_a_1'] != "0" && $row_select_pipe['wtr_a_1'] != null) {
                                                                            echo $row_select_pipe['wtr_a_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_1'] != "" && $row_select_pipe['wtr_b_1'] != "0" && $row_select_pipe['wtr_b_1'] != null) {
                                                                            echo $row_select_pipe['wtr_b_1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr1'] != "" && $row_select_pipe['wtr1'] != "0" && $row_select_pipe['wtr1'] != null) {
                                                                            echo $row_select_pipe['wtr1'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">2</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_2'] != "" && $row_select_pipe['wtr_a_2'] != "0" && $row_select_pipe['wtr_a_2'] != null) {
                                                                            echo $row_select_pipe['wtr_a_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_2'] != "" && $row_select_pipe['wtr_b_2'] != "0" && $row_select_pipe['wtr_b_2'] != null) {
                                                                            echo $row_select_pipe['wtr_b_2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr2'] != "" && $row_select_pipe['wtr2'] != "0" && $row_select_pipe['wtr2'] != null) {
                                                                            echo $row_select_pipe['wtr2'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">3</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_3'] != "" && $row_select_pipe['wtr_a_3'] != "0" && $row_select_pipe['wtr_a_3'] != null) {
                                                                            echo $row_select_pipe['wtr_a_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_3'] != "" && $row_select_pipe['wtr_b_3'] != "0" && $row_select_pipe['wtr_b_3'] != null) {
                                                                            echo $row_select_pipe['wtr_b_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr3'] != "" && $row_select_pipe['wtr3'] != "0" && $row_select_pipe['wtr3'] != null) {
                                                                            echo $row_select_pipe['wtr3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">4</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_4'] != "" && $row_select_pipe['wtr_a_4'] != "0" && $row_select_pipe['wtr_a_4'] != null) {
                                                                            echo $row_select_pipe['wtr_a_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_4'] != "" && $row_select_pipe['wtr_b_4'] != "0" && $row_select_pipe['wtr_b_4'] != null) {
                                                                            echo $row_select_pipe['wtr_b_4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr4'] != "" && $row_select_pipe['wtr4'] != "0" && $row_select_pipe['wtr4'] != null) {
                                                                            echo $row_select_pipe['wtr4'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">5</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_5'] != "" && $row_select_pipe['wtr_a_5'] != "0" && $row_select_pipe['wtr_a_5'] != null) {
                                                                            echo $row_select_pipe['wtr_a_5'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_5'] != "" && $row_select_pipe['wtr_b_5'] != "0" && $row_select_pipe['wtr_b_5'] != null) {
                                                                            echo $row_select_pipe['wtr_b_5'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr5'] != "" && $row_select_pipe['wtr5'] != "0" && $row_select_pipe['wtr5'] != null) {
                                                                            echo $row_select_pipe['wtr5'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">6</td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">7</td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">8</td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">9</td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">10</td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:right;">Average &nbsp; &nbsp;</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null) {
                                                                            echo $row_select_pipe['avg_wtr'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <table align="center" width="90%" class="test" style="margin-top:-1px;">
            <tr>
                <td style="text-align:center;width:50%">Tested By:</td>
                <td style="text-align:center;width:50%">Checked By:</td>
            </tr>
        </table>
    </page>
</body>

</html>