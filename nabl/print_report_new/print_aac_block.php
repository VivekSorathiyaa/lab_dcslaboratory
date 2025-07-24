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
    $select_tiles_query = "select * from aac_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
    $result_tiles_select = mysqli_query($conn, $select_tiles_query);
    $row_select_pipe = mysqli_fetch_array($result_tiles_select);

    $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
    $result_select = mysqli_query($conn, $select_query);

    $row_select = mysqli_fetch_array($result_select);
    $clientname = $row_select['clientname'];
    $pmc_heading = $row_select['pmc_name'];

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


    <div id="header">
        <br>
    </div>


    <page size="A4">
        <!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
            <tr>
                <td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF AUTOCLAVED AERATED CONCRETE(AAC) BLOCK</u></b></td>
            </tr>
            <tr>
                <td style="text-align:center;font-size:11px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">

                            <td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
                            <td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
                                                                                                                $result_selectc = mysqli_query($conn, $select_queryc);

                                                                                                                if (mysqli_num_rows($result_selectc) > 0) {
                                                                                                                    $row_selectc = mysqli_fetch_assoc($result_selectc);
                                                                                                                    $ct_nm = $row_selectc['city_name'];
                                                                                                                }
                                                                                                                echo $clientname; ?></td>
                            <td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
                            <td style="border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; </td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp;</td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; ULR No.</td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; PMC</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <!--First PMC--><?php echo $pmc_heading; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Agency</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Receive Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
                        </tr>


                    </table>

                </td>
            </tr>


            <tr>
                <td style="text-align:center;font-size:11px; ">

                    <table align="left" width="70%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;margin-bottom:18px;margin-top:18px;">

                        <tr style="">
                            <td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:left;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Material under Testing</td>
                            <td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php echo $mt_name; ?>&nbsp;&nbsp; (AUTOCLAVED AERATED CONCRETE (AAC) BLOCKS </td>

                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;&nbsp; Material Brand</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; By <?php if ($sample_sent_by == 1) {
                                                                                                                                                    echo 'Agency';
                                                                                                                                                } else if ($sample_sent_by == 0) {
                                                                                                                                                    echo 'Client';
                                                                                                                                                } ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;&nbsp; No.of Sample</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 24 NOS</td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;&nbsp; Method Adopted</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IS-2185(Part-III):2005 & IS-6441(Part-V)-19972</td>
                        </tr>

                    </table>

                </td>
            </tr>


            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:11px; ">
                    <table align="left" width="75%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">
                        <tr>
                            <td style="text-align:center; font-size:18px;padding-bottom:5px;border-left: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black; " colspan=9><b><u>Concrete Block Dimensional Analysis</u></b></td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;width:7%;font-weight:bold;text-align:center; "> Sr.No</td>
                            <td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; padding-top:5px;padding-bottom:5px;">Lab ID Mark</td>
                            <td style="border-left: 1px solid black;width:18%;font-weight:bold;text-align:center; " colspan=3>Block Size(mm)</td>
                            <td style="border-left: 1px solid black;width:45%;font-weight:bold;text-align:center; " colspan=3>As per IS-2185(Part-III)<br>Reqirment</td>
                            <td style="border-left: 1px solid black;border-right: 1px solid black;width:20%;font-weight:bold;text-align:center; " rowspan=3>Block ID</td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center; "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;font-weight:bold;text-align:center; padding-top:5px;padding-bottom:5px; ">L</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;font-weight:bold;text-align:center; ">B</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;font-weight:bold;text-align:center; ">H</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;text-align:center; " rowspan=2>Length</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;text-align:center; " rowspan=2>Width</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;text-align:center; " rowspan=2>Height</td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"> &nbsp;</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold;"></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center;font-weight:bold;" colspan=3></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;text-align:center;font-weight:bold;" rowspan=24>600mm &plusmn; <br>5mm</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;text-align:center;font-weight:bold;" rowspan=24>230mm &plusmn; <br>3mm</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;text-align:center;font-weight:bold;" rowspan=24>230mm &plusmn; <br>3mm</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block1']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block2']; ?></td>
                        </tr>

                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block3']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l4']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w4']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h4']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block4']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:1%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l5']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w5']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h5']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block5']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l6']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w6']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h6']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block6']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l7']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w7']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h7']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block7']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l8']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w8']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h8']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block8']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l9']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w9']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h9']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block9']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l10']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w10']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h10']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block10']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l11']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w11']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h11']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block11']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l12']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w12']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h12']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block12']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l13']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w13']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h13']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block13']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l14']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w14']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h14']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block14']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l15']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w15']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h15']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block15']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l16']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w16']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h16']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block16']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l17']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w17']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h17']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block17']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l18']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w18']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h18']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block18']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l19']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w19']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h19']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block19']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l20']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w20']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h20']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block20']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l21']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w21']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h21']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block21']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;"><?php echo $row_select_pipe['dim_l22']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"> <?php echo $row_select_pipe['dim_w22']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"> <?php echo $row_select_pipe['dim_h22']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block22']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l23']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w23']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h23']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block23']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;font-weight:bold;text-align:center;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_l24']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_w24']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:6%;text-align:center;"><?php echo $row_select_pipe['dim_h24']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;text-align:center;	border-right:1px solid;padding-top:3px;padding-bottom:3px;"><?php echo $row_select_pipe['dim_block24']; ?></td>
                        </tr>


                    </table><br>
                </td>

            </tr>

            <!--tr>
				<td  style="text-align:right;font-size:11px;padding-right:80px; "><br><br><br><br>
				<table align="right" width="80%"  class="test" style="height:auto;font-family: Cambria; " >
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
		</tr-->







            <tr>
                <td style="text-align:center; ">
                    <br><br><br><br><br><br>
                    <table align="center" width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
                        <td style="width:40%;text-align:left;font-weight:bold;">
                            Page No. 1 of 2
                        </td>
                        <td style="width:60%;text-align:left;font-weight:bold;">
                            . . . . . . .END OF REPORT. . . . . . .
                        </td>
                    </table>
                </td>
            </tr>


            <div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


            </div>
        </table>


        <div class="pagebreak"></div>
        <br>
        <br>
        <br>

        <div id="header">
            <br>
        </div>
        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
            <!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
            <tr>
                <td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF AUTOCLAVED AERATED CONCRETE(AAC) BLOCK</u></b></td>
            </tr>
            <tr>
                <td style="text-align:center;font-size:11px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">

                            <td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
                            <td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
                                                                                                                $result_selectc = mysqli_query($conn, $select_queryc);

                                                                                                                if (mysqli_num_rows($result_selectc) > 0) {
                                                                                                                    $row_selectc = mysqli_fetch_assoc($result_selectc);
                                                                                                                    $ct_nm = $row_selectc['city_name'];
                                                                                                                }
                                                                                                                echo $clientname; ?></td>
                            <td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
                            <td style="border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; </td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp;</td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; ULR No.</td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; PMC</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select['pmc_heading']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Agency</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Receive Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
                        </tr>


                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center; font-size:18px;"><b><u>Concrete Block Density Test</u></b></td>
            </tr>

            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:11px; ">

                    <table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

                        <tr style="">
                            <td style="border-left: 1px solid black;width:7%;font-weight:bold; text-align:center;padding-bottom:1px;padding-top:1px;  ">Sr.No.</td>
                            <td style="border-left: 1px solid black;width:11%;text-align:center;font-weight:bold; ">Lab ID <br> Mark </td>
                            <td style="border-left: 1px solid black;width:21%;text-align:center;font-weight:bold; " colspan=3>Block Size(mm) </td>
                            <td style="border-left: 1px solid black;width:12%;text-align:center;font-weight:bold; ">Volume(m&sup3;)</td>
                            <td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Saturated<br> Weight</td>
                            <td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Wet Density</td>
                            <td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Dry Weight</td>
                            <td style="border-left: 1px solid black;width:8%;text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">Moisture <br>Content</td>
                            <td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Dry Density</td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top	: 1px solid black;width:7%;font-weight:bold; text-align:center;  "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; font-weight:bold;padding-bottom:3px;padding-top:3px;">L</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;font-weight:bold; ">B</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;font-weight:bold; ">H</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;font-weight:bold; ">L &times; B &times; H</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Kg</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">kg/m&sup3;</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Kg</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center;font-weight:bold; ">%</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; ">kg/m&sup3;</td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top	: 1px solid black;width:7%;font-weight:bold; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; padding-bottom:3px;padding-top:3px;"><?php echo $row_select_pipe['dl_1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; "><?php echo $row_select_pipe['dw_1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; "><?php echo $row_select_pipe['dh_1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; "><?php echo substr($row_select_pipe['vol_1'] / 1000000, 0, 7); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo ($row_select_pipe['weight_1'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo ($row_select_pipe['den_1'] * 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo ($row_select_pipe['w1'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php if ($row_select_pipe['wa_1'] != "") {
                                                                                                                                    echo $row_select_pipe['wa_1'];
                                                                                                                                } else {
                                                                                                                                    echo "-";
                                                                                                                                } ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo substr(($row_select_pipe['w1'] / 1000) / ($row_select_pipe['vol_1'] / 1000000), 0, 6); ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top	: 1px solid black;width:7%;font-weight:bold; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; padding-bottom:3px;padding-top:3px;"><?php echo $row_select_pipe['dl_2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; "><?php echo $row_select_pipe['dw_2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; "><?php echo $row_select_pipe['dh_2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; "><?php echo substr($row_select_pipe['vol_2'] / 1000000, 0, 7); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo ($row_select_pipe['weight_2'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo ($row_select_pipe['den_2'] * 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo ($row_select_pipe['w2'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php if ($row_select_pipe['wa_2'] != "") {
                                                                                                                                    echo $row_select_pipe['wa_2'];
                                                                                                                                } else {
                                                                                                                                    echo "-";
                                                                                                                                } ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo substr(($row_select_pipe['w2'] / 1000) / ($row_select_pipe['vol_2'] / 1000000), 0, 6); ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top	: 1px solid black;width:7%;font-weight:bold; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt - 1; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; padding-bottom:3px;padding-top:3px;"><?php echo $row_select_pipe['dl_3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; "><?php echo $row_select_pipe['dw_3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; "><?php echo $row_select_pipe['dh_3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; "><?php echo substr($row_select_pipe['vol_3'] / 1000000, 0, 7); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo ($row_select_pipe['weight_3'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo ($row_select_pipe['den_3'] * 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo ($row_select_pipe['w3'] / 1000); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php if ($row_select_pipe['wa_3'] != "") {
                                                                                                                                    echo $row_select_pipe['wa_3'];
                                                                                                                                } else {
                                                                                                                                    echo "-";
                                                                                                                                } ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo substr(($row_select_pipe['w3'] / 1000) / ($row_select_pipe['vol_3'] / 1000000), 0, 6); ?></td>
                        </tr>


                    </table>

                </td>
            </tr>


            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:11px; "><br>
                    <table align="left" width="80%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">
                        <tr>
                            <td style="text-align:center; font-size:18px;padding-bottom:5px;border-left: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black; " colspan=7><b><u>Concrete Block Compressive Strength Test</u></b></td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;width:10%;font-weight:bold;text-align:center; "> Sr.No</td>
                            <td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; padding-top:5px;padding-bottom:5px;">Lab ID <br>Mark</td>
                            <td style="border-left: 1px solid black;width:20%;font-weight:bold;text-align:center; " colspan=2>Block Size(mm)</td>
                            <td style="border-left: 1px solid black;width:18%;font-weight:bold;text-align:center; ">Load</td>
                            <td style="border-left: 1px solid black;width:16%;font-weight:bold;text-align:center; ">Compressive Strength</td>
                            <td style="border-left: 1px solid black;border-right: 1px solid black;width:22%;font-weight:bold;text-align:center; ">Average</td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;font-weight:bold;text-align:center; "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;font-weight:bold;text-align:center; padding-top:5px;padding-bottom:5px; ">L</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;font-weight:bold;text-align:center; ">B</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;font-weight:bold;text-align:center; ">kN</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;font-weight:bold;text-align:center; ">N/mm&sup2;</td>
                            <td style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;width:22%;font-weight:bold;text-align:center; ">N/mm&sup2;</td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_1']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_1']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_1']; ?></td>
                            <td style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;width:22%;text-align:center;font-weight:bold;" rowspan=12><?php echo $row_select_pipe['avg_com']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_2']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_2']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_2']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_3']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_3']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_3']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_4']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_4']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_4']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_4']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_5']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_5']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_5']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_5']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_6']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_6']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_6']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_6']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_7']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_7']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_7']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_7']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_8']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_8']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_8']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_8']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_9']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_9']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_9']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_9']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_10']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_10']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_10']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_10']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_11']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_11']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_11']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_11']; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">O-0<?php echo $cnt + 2; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; padding-top:3px;padding-bottom:3px; "><?php echo $row_select_pipe['l_12']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php echo $row_select_pipe['w_12']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;text-align:center; "><?php echo $row_select_pipe['load_12']; ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:16%;text-align:center; "><?php echo $row_select_pipe['com_12']; ?></td>
                        </tr>
                    </table><br>
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
                <td style="text-align:right;font-size:11px;padding-right:80px; "><br><br>
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





            <br>
            <tr>
                <td style="text-align:center; ">
                    <table align="center" width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
                        <td style="width:40%;text-align:left;font-weight:bold;">
                            Page No. 2 of 2
                        </td>
                        <td style="width:60%;text-align:left;font-weight:bold;">
                            . . . . . . .END OF REPORT. . . . . . .
                        </td>
                    </table>
                </td>
            </tr>
            <div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


            </div>
        </table>
    </page>



    <!--page size="A4">
		<center style="font-size:16px;font-family: Arial;margin-left:45px;padding-bottom:3px;font-weight:bold;"><b>TEST REPORT OF AAC BLOCK</b></center>

		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family: Arial;margin-left:45px;margin-right:15px;border:1px solid black;">
		<tr>
			<td>
				<table align="left" width="100%"  border="0px" cellspacing="0" class="test" style="border-bottom:1px solid black;">
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
				<table align="center" width="100%"   cellspacing="0" cellpadding="0" class="test" style="border-bottom:1px solid black;">

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
				<table align="center" width="100%"  border="0px" class="test" style="border-bottom:1px solid black;">
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

		<tr >


					<td style="font-size:12.7px;padding-top:5px;"><center><b>Test Results</b></center></td>

		</tr>

		<tr>
					<!-OTHER START->
					<td>


							<table align="left" width="100%"  class="test" style="height:auto;width:100%;" >
									<tr style="text-align:center;">

										<td style="border:1px solid black;border-left:0px solid black;width:7%;"><b>Sr. No.</b></td>
										<td style="border:1px solid black;border-left:0px solid black;width:13%;"><b>BulkDensity<br>(g/cm<sup>3</sup>)</b></td>
										<td style="border:1px solid black;border-left:0px solid black;width:10%;"><b>Moisture Content<br>(%)</b></td>
										<td style="border:1px solid black;border-right:0px solid black;width:11%;"><b>Load<br>(KN)</b></td>
										<td style="border:1px solid black;border-right:0px solid black;width:11%;"><b>Area of<br>Acc Block<br>(mm<sup>2</sup>)</b></td>
										<td style="border:1px solid black;border-right:0px solid black;width:12%;"><b>Comp.<br>Strength<br>(N/mm<sup>2</sup>)</b></td>
										<td style="border:1px solid black;border-right:0px solid black;width:13%;"><b>Size of Specimen L X W X T<br>(mm)</b></td>
										<td style="border:1px solid black;border-right:0px solid black;width:10%;"><b>Drying Shrinkage<br>(%)</b></td>
									</tr>

									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">1</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_1'] != "") {
                                            echo $row_select_pipe['den_1'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_1'] != "") {
                                            echo $row_select_pipe['wa_1'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>

										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_1']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_1']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_1']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_1'] . " - " . $row_select_pipe['con_wid_1'] . "  " . $row_select_pipe['con_thi_1']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_1'] != "") {
                                            echo $row_select_pipe['ds_1'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">2</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_2'] != "") {
                                            echo $row_select_pipe['den_2'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_2'] != "") {
                                            echo $row_select_pipe['wa_2'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_2']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_2']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_2']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_2'] . " - " . $row_select_pipe['con_wid_2'] . "  " . $row_select_pipe['con_thi_2']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_2'] != "") {
                                            echo $row_select_pipe['ds_2'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">3</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_3'] != "") {
                                            echo $row_select_pipe['den_3'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_3'] != "") {
                                            echo $row_select_pipe['wa_3'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_3']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_3']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_3']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_3'] . " - " . $row_select_pipe['con_wid_3'] . "  " . $row_select_pipe['con_thi_3']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_3'] != "") {
                                            echo $row_select_pipe['ds_3'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">4</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_4'] != "") {
                                            echo $row_select_pipe['den_4'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_4'] != "") {
                                            echo $row_select_pipe['wa_4'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_4']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_4']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_4']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_4'] . " - " . $row_select_pipe['con_wid_4'] . "  " . $row_select_pipe['con_thi_4']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_4'] != "") {
                                            echo $row_select_pipe['ds_4'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">5</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_5'] != "") {
                                            echo $row_select_pipe['den_5'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_5'] != "") {
                                            echo $row_select_pipe['wa_5'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_5']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_5']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_5']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_5'] . " - " . $row_select_pipe['con_wid_5'] . "  " . $row_select_pipe['con_thi_5']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_5'] != "") {
                                            echo $row_select_pipe['ds_5'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">6</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_6'] != "") {
                                            echo $row_select_pipe['den_6'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_6'] != "") {
                                            echo $row_select_pipe['wa_6'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_6']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_6']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_6']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_6'] . " - " . $row_select_pipe['con_wid_6'] . "  " . $row_select_pipe['con_thi_6']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_6'] != "") {
                                            echo $row_select_pipe['ds_6'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">7</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_7'] != "") {
                                            echo $row_select_pipe['den_7'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_7'] != "") {
                                            echo $row_select_pipe['wa_7'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_7']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_7']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_7']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_7'] . " - " . $row_select_pipe['con_wid_7'] . "  " . $row_select_pipe['con_thi_7']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_7'] != "") {
                                            echo $row_select_pipe['ds_7'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">8</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_8'] != "") {
                                            echo $row_select_pipe['den_8'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										-

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_8']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_8']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_8']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_8'] . " - " . $row_select_pipe['con_wid_8'] . "  " . $row_select_pipe['con_thi_8']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_8'] != "") {
                                            echo $row_select_pipe['ds_8'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">9</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_9'] != "") {
                                            echo $row_select_pipe['den_9'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_9'] != "") {
                                            echo $row_select_pipe['wa_9'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_9']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_9']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_9']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_9'] . " - " . $row_select_pipe['con_wid_9'] . "  " . $row_select_pipe['con_thi_9']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_9'] != "") {
                                            echo $row_select_pipe['ds_9'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">10</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_10'] != "") {
                                            echo $row_select_pipe['den_10'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_10'] != "") {
                                            echo $row_select_pipe['wa_10'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_10']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_10']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_10']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_10'] . " - " . $row_select_pipe['con_wid_10'] . "  " . $row_select_pipe['con_thi_10']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_10'] != "") {
                                            echo $row_select_pipe['ds_10'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">11</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_11'] != "") {
                                            echo $row_select_pipe['den_11'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_11'] != "") {
                                            echo $row_select_pipe['wa_11'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_11']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_11']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_11']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_11'] . " - " . $row_select_pipe['con_wid_11'] . "  " . $row_select_pipe['con_thi_11']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_11'] != "") {
                                            echo $row_select_pipe['ds_11'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;">12</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['den_12'] != "") {
                                            echo $row_select_pipe['den_12'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php
                                        if ($row_select_pipe['wa_12'] != "") {
                                            echo $row_select_pipe['wa_12'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_12']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_12']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_12']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_12'] . " - " . $row_select_pipe['con_wid_12'] . "  " . $row_select_pipe['con_thi_12']; ?></td>
										<td style="border:1px solid black;border-right:0px solid black;">
										<?php
                                        if ($row_select_pipe['ds_12'] != "") {
                                            echo $row_select_pipe['ds_12'];
                                        } else {
                                            echo "-";
                                        } ?>

										</td>
									</tr>

									<tr style="text-align:center;">
										<td style="border:1px solid black;border-left:0px solid black;"><b>Average</b></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['bdl']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['mc']; ?></td>
										<td style="border:1px solid black;border-left:0px solid black;" colspan="2">Average</td>


										<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['avg_com'], 2);; ?></td>
										<td  style="border:1px solid black;border-left:0px solid black;">-</td>
										<td style="border:1px solid black;border-left:0px solid black;">
										<?php if ($row_select_pipe['avg_shrink'] != 0) {
                                            echo round($row_select_pipe['avg_shrink'], 2);
                                        } else {
                                            echo "-";
                                        } ?></td>
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
										<td  style="border:1px solid black;border-left:0px solid black;">-</td>

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
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['dim_length'] != "undefined") {
                                                                                                    echo $row_select_pipe['dim_length'];
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['dim_width'] != "undefined") {
                                                                                                    echo $row_select_pipe['dim_width'];
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?></td>
								<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['dim_height'] != "undefined") {
                                                                                                        echo $row_select_pipe['dim_height'];
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?></td>
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

		<table  width="95%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family: Arial;position:fixed;bottom:70px;">
			<tr>

					<td colspan="2">
					<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Arial;margin-left:35px;">
							<tr>

								<td style="text-align:left;padding-right:15px;"><p align="justify">Terms &amp; Condition :The results relate only to the sample tested, Sample(s) drawn by party. Test certificate shall not be re-produced except in full without the written approval of Laboratory. RMS has made their best endeavors to provide accurate and reliable information, RMS is not responsible for any financial liability due to any act of omission or error mode.</p></td>

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

		</page-->

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
<script src="jquery.min.js"></script>
<script type="text/javascript">
    var num = 7;
    if (num % 2 == 0) {
        //alert("Even");
    } else {
        //alert("Odd");
    }

    function header() {
        if (document.querySelector('#header_hide_show').checked) {
            document.getElementById('header').innerHTML = '';
            document.getElementById("header").insertAdjacentHTML("afterbegin", '<img src="images/header.jpeg" width="100%">');
            document.getElementById("footer").insertAdjacentHTML("afterbegin", '<img src="images/footer.jpeg" width="100%">');
            document.getElementById('sign').innerHTML = '';
            //document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
        } else {
            document.getElementById('header').innerHTML = '';
            document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
            document.getElementById("footer").innerHTML = '';
            document.getElementById('sign').innerHTML = '';
            //document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');
        }
    }

    function put_details() {
        var get_data = document.getElementById('details_of_sample').value;
        document.getElementById('put_details').innerHTML = get_data;
    }
</script>