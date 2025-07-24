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
</style>
<html>

<body>
    <?php
    $job_no = $_GET['job_no'];
    $lab_no = $_GET['lab_no'];
    $report_no = $_GET['report_no'];
    $trf_no = $_GET['trf_no'];
    $select_tiles_query = "select * from clc_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
        /* $mark= $row_select4['brick_mark'];
					$brick_specification= $row_select4['brick_specification']; */
        $material_location = $row_select4['material_location'];
    }


    ?>



    <?php
    if ($row_select['nabl_type'] == "nabl") {
    ?>
        <Center><img src="nabl.png" style="padding-right:80px;padding-top:8px;" height="90px" width="80px" /></center>
        <br>
    <?php
    } else {
    ?>
        <br>
        <Center><img src="non_nabl.png" style="padding-right:90px;padding-top:8px;" height="60px" width="200px" /></center>
        <br>
        <br>

    <?php
    }
    ?>
    <page size="A4">
        <center style="font-size:16px;font-family: Arial;margin-left:45px;padding-bottom:3px;font-weight:bold;"><b>TEST REPORT OF CLC BLOCK</b></center>

        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family: Arial;margin-left:45px;margin-right:15px;border:1px solid black;">
            <tr>
                <td>
                    <table align="left" width="100%" border="0px" cellspacing="0" class="test" style="border-bottom:1px solid black;">
                        <tr>
                            <td style="width:9%;padding-top:3px;padding-bottom:3px;"><b>&nbsp;&nbsp;Report No.</b></td>
                            <td style="width:2%;font-family: Arial;font-weight:bold;"><b>:</b></td>
                            <td style="width:15%"><?php echo $report_no; ?></td>
                            <td style="width:9%;"><b>Report Date</b></td>
                            <td style="width:2%;font-family: Arial;font-weight:bold;"><b>:</b></td>
                            <td style="width:15%"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
                            <?php
                            if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "-" && strlen($row_select_pipe['ulr']) >= 5 && $row_select['nabl_type'] == "nabl") {
                            ?>
                                <td style="width:7%;"><b>ULR No.</b></td>
                                <td style="width:2%;font-family: Arial;font-weight:bold;"><b>:</b></td>
                                <td style="width:15%"><?php echo $_GET['ulr']; ?></td>
                            <?php
                            } else {
                            ?>
                                <td style="width:6%;"><b>&nbsp;</b></td>
                                <td style="width:2%;font-family: Arial;font-weight:bold;"><b>&nbsp;</b></td>
                                <td style="width:15%">&nbsp;&nbsp;</td>
                            <?php
                            }

                            ?>
                        </tr>

                    </table>


                </td>
            </tr>



            <tr>
                <td>
                    <table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="border-bottom:1px solid black;">

                        <?php

                        if ($clientname != "") {
                        ?>
                            <tr>
                                <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Name of Customer</b></td>
                                <td style="width:3%;font-family: Arial;font-weight:bold;padding-top:3px;"><b>:</b></td>
                                <td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
                                                                                    $result_selectc = mysqli_query($conn, $select_queryc);

                                                                                    if (mysqli_num_rows($result_selectc) > 0) {
                                                                                        $row_selectc = mysqli_fetch_assoc($result_selectc);
                                                                                        $ct_nm = $row_selectc['city_name'];
                                                                                    }
                                                                                    echo $clientname; ?>
                                </td>
                            </tr>
                        <?php
                        }
                        if ($agency_name != "") {
                        ?>
                            <tr>
                                <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Name of Agency</b></td>
                                <td style="width:3%;font-family: Arial;font-weight:bold;padding-top:3px;"><b>:</b></td>
                                <td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $agency_name; ?>
                                </td>
                            </tr>
                        <?php
                        }
                        if ($row_select['tpi_name'] != "") {
                        ?>
                            <tr>
                                <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b><?php echo $row_select['tpi_or_auth']; ?></b></td>
                                <td style="width:3%;font-family: Arial;font-weight:bold;padding-top:3px;"><b>:</b></td>
                                <td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $row_select['tpi_name']; ?>
                                </td>
                            </tr>
                        <?php
                        }
                        if ($row_select['pmc_name'] != "") {
                        ?>
                            <tr>
                                <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b><?php echo $row_select['pmc_heading']; ?></b></td>
                                <td style="width:3%;font-family: Arial;font-weight:bold;padding-top:3px;"><b>:</b></td>
                                <td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $row_select['pmc_name']; ?>
                                </td>
                            </tr>

                        <?php
                        }
                        if ($name_of_work != "") {
                        ?>

                            <tr>
                                <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Name of Work</b></td>
                                <td style="width:3%;font-family: Arial;font-weight:bold;padding-top:3px;"><b>:</b></td>
                                <td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $name_of_work; ?>
                                </td>
                            </tr>
                        <?php
                        }
                        if ($agreement_no != "") {
                        ?>

                            <tr>
                                <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Agreement No.</b></td>
                                <td style="width:3%;font-family: Arial;font-weight:bold;"><b>:</b></td>
                                <td style="width:77%">&nbsp;&nbsp;<?php echo $agreement_no; ?>
                                </td>
                            </tr>
                        <?php
                        }
                        if ($r_name != "") {
                        ?>
                            <tr>
                                <td style="width:20%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;<b>Reference</b></td>
                                <td style="width:3%;font-family: Arial;font-weight:bold;"><b>:</b></td>
                                <td style="width:77%">&nbsp;&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
                                                                                                    if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {
                                                                                                    ?>Date: <?php echo date('d - m - Y', strtotime($row_select["date"]));
                                                                                                        } else {
                                                                                                        }
                                                                                                            ?>

                                </td>
                            </tr>
                        <?php
                        }

                        ?>
                    </table>
                </td>
            </tr>



            <tr>
                <td>
                    <table align="center" width="100%" border="0px" class="test" style="border-bottom:1px solid black;">
                        <tr>
                            <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Discipline &amp; Group</b></td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
                            <td style="width:40%">&nbsp;&nbsp;Mechanical &amp; Building Material</td>
                            <td style="width:22%">&nbsp;</td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;"></td>
                            <td style="width:22%">&nbsp;</td>

                        </tr>
                        <tr>
                            <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Description of Sample</b></td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
                            <td style="width:40%">&nbsp;&nbsp;<?php echo $mt_name; ?></td>
                            <td style="width:22%;">&nbsp;&nbsp;<b>Date of Receipt</b></td>
                            <td style="width:3%;font-family: Arial;"><b>:</b></td>
                            <td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>

                        </tr>
                        <tr>
                            <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Grade</b></td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
                            <td style="width:40%">&nbsp;&nbsp;<?php echo $row_select_pipe['in_grade']; ?></td>
                            <td style="width:22%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
                            <td style="width:14%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
                        </tr>

                        <tr>
                            <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Density</b></td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
                            <td style="width:40%">&nbsp;&nbsp;<?php echo $row_select_pipe['in_den']; ?></td>
                            <td style="width:22%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
                            <td style="width:14%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($end_date)); ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Condition of Sample</b></td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
                            <td style="width:40%">&nbsp;&nbsp;<?php echo $con_sample; ?></td>
                            <td style="width:22%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;</td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;"></td>
                            <td style="width:14%">&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Location of Test</b></td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
                            <td style="width:40%">&nbsp;&nbsp;<?php if ($material_location == 1) {
                                                                    echo "In Laboratory";
                                                                } else {
                                                                    echo "In Field";
                                                                } ?></td>
                            <td style="width:22%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;</td>
                            <td style="width:3%;font-family:Arial;font-weight:bold;"></td>
                            <td style="width:14%">&nbsp;&nbsp;</td>
                        </tr>



                    </table>
                </td>
            </tr>

            <tr>


                <td style="font-size:12.7px;padding-top:5px;">
                    <center><b>Test Results</b></center>
                </td>

            </tr>

            <tr>
                <!--OTHER START-->
                <td>


                    <table align="left" width="100%" class="test" style="height:auto;width:100%;">
                        <tr style="text-align:center;">

                            <td style="border:1px solid black;border-left:0px solid black;width:7%;"><b>Sr. No.</b></td>
                            <td style="border:1px solid black;border-left:0px solid black;width:13%;"><b>BulkDensity<br>(g/cm<sup>3</sup>)</b></td>
                            <td style="border:1px solid black;border-left:0px solid black;width:10%;"><b>Moisture Content<br>(%)</b></td>
                            <td style="border:1px solid black;border-right:0px solid black;width:11%;"><b>Load<br>(KN)</b></td>
                            <td style="border:1px solid black;border-right:0px solid black;width:11%;"><b>Area of<br>Brick<br>(mm<sup>2</sup>)</b></td>
                            <td style="border:1px solid black;border-right:0px solid black;width:12%;"><b>Comp.<br>Strength<br>(N/mm<sup>2</sup>)</b></td>
                            <td style="border:1px solid black;border-right:0px solid black;width:13%;"><b>Size of Specimen L X W X T<br>(mm)</b></td>
                            <td style="border:1px solid black;border-right:0px solid black;width:10%;"><b>Drying Shrinkage<br>(%)</b></td>
                        </tr>

                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;">1</td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['den_1']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['wa_1']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_1']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_1']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_1']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_1'] . " X " . $row_select_pipe['con_wid_1'] . " X " . $row_select_pipe['con_thi_1']; ?></td>
                            <td style="border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['ds_1']; ?></td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;">2</td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['den_2']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['wa_2']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_2']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_2']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_2']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_2'] . " X " . $row_select_pipe['con_wid_2'] . " X " . $row_select_pipe['con_thi_2']; ?></td>
                            <td style="border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['ds_2']; ?></td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;">3</td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['den_3']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['wa_3']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_3']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_3']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_3']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_3'] . " X " . $row_select_pipe['con_wid_3'] . " X " . $row_select_pipe['con_thi_3']; ?></td>
                            <td style="border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['ds_3']; ?></td>
                        </tr>

                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;"><b>Average</b></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['bdl']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo round($row_select_pipe['mc']); ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;">---</td>
                            <td style="border:1px solid black;border-left:0px solid black;">---</td>

                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo round($row_select_pipe['avg_com'], 1); ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;">---</td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['avg_shrink'] != "" && $row_select_pipe['avg_shrink'] != '0' && $row_select_pipe['avg_shrink'] != 'NAN') {
                                                                                                echo round($row_select_pipe['avg_shrink'], 2);
                                                                                            }  ?></td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;">Method of<br>Testing</td>
                            <td colspan="2" style="border:1px solid black;border-left:0px solid black;">IS:6441 (P 1)-1972 RA. 2012</td>

                            <td colspan="3" style="border:1px solid black;border-left:0px solid black;">IS:6441 (P 5)-1972 RA. 2012</td>
                            <td colspan="2" style="border:1px solid black;border-left:0px solid black;">IS:6441 (P 2)-1972 RA. 2012</td>

                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;">Req.<br>IS. 2185 (P 3) <br>1984 RA. 2015</td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['in_den'] ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;">---</td>

                            <td colspan="3" style="border:1px solid black;border-left:0px solid black;">Compressive Strength Shall Not be less than<br><?php if ($row_select_pipe['in_den'] == "451 to 550" && $row_select_pipe['in_grade'] == "grade 1") {
                                                                                                                                                            echo "2.0";
                                                                                                                                                        } else if ($row_select_pipe['in_den'] == "451 to 550" && $row_select_pipe['in_grade'] == "grade 2") {
                                                                                                                                                            echo "1.5";
                                                                                                                                                        } else if ($row_select_pipe['in_den'] == "551 to 650" && $row_select_pipe['in_grade'] == "grade 1") {
                                                                                                                                                            echo "4.0";
                                                                                                                                                        } else if ($row_select_pipe['in_den'] == "551 to 650" && $row_select_pipe['in_grade'] == "grade 2") {
                                                                                                                                                            echo "3.0";
                                                                                                                                                        } else if ($row_select_pipe['in_den'] == "651 to 750" && $row_select_pipe['in_grade'] == "grade 1") {
                                                                                                                                                            echo "5.0";
                                                                                                                                                        } else if ($row_select_pipe['in_den'] == "651 to 750" && $row_select_pipe['in_grade'] == "grade 2") {
                                                                                                                                                            echo "4.0";
                                                                                                                                                        } else if ($row_select_pipe['in_den'] == "751 to 850" && $row_select_pipe['in_grade'] == "grade 1") {
                                                                                                                                                            echo "6.0";
                                                                                                                                                        } else if ($row_select_pipe['in_den'] == "751 to 850" && $row_select_pipe['in_grade'] == "grade 2") {
                                                                                                                                                            echo "5.0";
                                                                                                                                                        } else if ($row_select_pipe['in_den'] == "851 to 1000" && $row_select_pipe['in_grade'] == "grade 1") {
                                                                                                                                                            echo "7.0";
                                                                                                                                                        } else if ($row_select_pipe['in_den'] == "851 to 1000" && $row_select_pipe['in_grade'] == "grade 2") {
                                                                                                                                                            echo "6.0";
                                                                                                                                                        }
                                                                                                                                                        ?> N/mm<sup>2</sup></td>
                            <td colspan="2" style="border:1px solid black;border-left:0px solid black;">
                                <?php
                                if ($row_select_pipe['in_grade'] == "grade 2") {
                                    echo "Max. 0.1 %";
                                } else {
                                    echo "Max. 0.05 %";
                                }

                                ?>
                            </td>

                        </tr>



                    </table>

                </td>

            </tr>
            <tr>
                <td><br></td>
            </tr>


            <tr>
                <td>
                    <table align="left" class="test" style="height:Auto;width:100%;">
                        <tr style="text-align:center;">
                            <td style="width:40%;border:1px solid black;border-left:0px solid black;">Dimension Test</td>
                            <td style="width:20%;border:1px solid black;border-left:0px solid black;">Length, mm</td>
                            <td style="width:20%;border:1px solid black;border-left:0px solid black;">Width, mm</td>
                            <td style="width:20%;border:1px solid black;border-right:0px solid black;">Thickness, mm</td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;"><b>Results</b></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['dim_length']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['dim_width']; ?></td>
                            <td style="border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['dim_height']; ?></td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;">Requirement as per IS. 2185 (P-3)-1984 RA. 2015</td>
                            <td style="border:1px solid black;border-left:0px solid black;">&plusmn; 5 mm</td>
                            <td style="border:1px solid black;border-left:0px solid black;">&plusmn; 3 mm</td>
                            <td style="border:1px solid black;border-right:0px solid black;">&plusmn; 3 mm</td>

                        </tr>


                    </table>

                </td>
            </tr>
        </table>
        <table cellpadding="0" cellpadding="0" align="center" width="92%" style="font-size:12.7px;font-family: Arial;margin-left:45px;margin-right:15px;" class="test">

            <tr>

                <td style="width:100%;text-align:right;padding-top:70px;padding-right:20px;">Authorized Signature</td>


            </tr>

            <tr>

                <td style="width:100%;text-align:right;">Mr. Kuldip(TM) / Mr. Ankur(QM)</td>


            </tr>
        </table>

        <table width="95%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family: Arial;position:fixed;bottom:60px;">
            <tr>

                <td colspan="2">
                    <table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Arial;margin-left:35px;">
                        <tr>

                            <td style="text-align:left;padding-right:15px;">
                                <p align="justify">Terms &amp; Condition :The results relate only to the sample tested, Sample(s) drawn by party. Test certificate shall not be re-produced except in full without the written approval of Laboratory. RMS has made their best endeavors to provide accurate and reliable information, RMS is not responsible for any financial liability due to any act of omission or error mode.</p>
                            </td>

                        </tr>
                    </table>
                </td>

            </tr>
            <tr>

                <td>
                    <table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Arial;margin-left:45px;">

                        <td style="text-align:left;width:33%">F/7.8/6</td>


                        <td style="text-align:center;width:33%">** END OF REPORT **</td>


                        <td style="text-align:right;width:33%;padding-right:22.5px;">Page No. 1 of 1</td>

                    </table>
                </td>
            </tr>
        </table>






    </page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
