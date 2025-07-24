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
    $select_tiles_query = "select * from bitumin_con WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
    $agreement_no = $row_select['agreement_no'];
    $cons = $row_select['condition_of_sample_receved'];
    // // $job_no= $row_select['job_no'];			
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
    $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
    $result_select4 = mysqli_query($conn, $select_query4);

    if (mysqli_num_rows($result_select4) > 0) {
        $row_select4 = mysqli_fetch_assoc($result_select4);
        $source = $row_select4['agg_source'];
        $material_location = $row_select4['material_location'];
    }
    ?>



    <page size="A4">
        <!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;margin-left:35px;">
            <tr>
                <td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF DENSE BITUMINOUS CONCRETE</u></b></td>
            </tr>
            <tr>
                <td style="text-align:center;font-size:12px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">

                            <td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Authority</td>
                            <td style="border-left: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
                                                                                                                $result_selectc = mysqli_query($conn, $select_queryc);

                                                                                                                if (mysqli_num_rows($result_selectc) > 0) {
                                                                                                                    $row_selectc = mysqli_fetch_assoc($result_selectc);
                                                                                                                    $ct_nm = $row_selectc['city_name'];
                                                                                                                }
                                                                                                                echo $clientname; ?></td>
                            <td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
                            <td style="border-left: 1px solid black;border-right: 1px solid;width:19%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:11%;font-weight:bold;">&nbsp; </td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;</td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:11%; font-weight:bold; ">&nbsp; ULR No.</td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp; <?php echo $_GET['ulr']; ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Name Of Work</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Consultant</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Contractor</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select['pmc_name']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; padding-bottom:1px;padding-top:1px; ">&nbsp;&nbsp; Received Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
                        </tr>


                    </table><br>

                </td>
            </tr>
            <tr>
                <td style="text-align:center;font-size:12px; ">

                    <table align="left" width="70%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

                        <tr style="">
                            <td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:left;padding-bottom:4px;padding-top:4px;  ">&nbsp;&nbsp; Description of Sample</td>
                            <td style="border-left: 1px solid black;width:70%;text-align:left;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Dense Bituminous Concrete</td>

                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:4px;padding-top:4px;padding-bottom:1px;padding-top:1px;    ">&nbsp;&nbsp; Material Source</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp;<?php if ($row_select['sel_report_to'] == 1) {
                                                                                                                                                echo 'Agency';
                                                                                                                                            } else {
                                                                                                                                                echo 'Client';
                                                                                                                                            } ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:4px;padding-top:4px;padding-bottom:1px;padding-top:1px;    ">&nbsp;&nbsp; No.of Sample</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 01 / 03 To 03 / 03</td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:4px;padding-top:4px;padding-bottom:1px;padding-top:1px;    ">&nbsp;&nbsp; Test Method Adopted</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IRC SP 11 : 1984 , ASTM D 6927</td>
                        </tr>

                    </table>

                </td>
            </tr>


            <tr>
                <td style="text-align:center; font-size:18px;padding-bottom:15px;padding-top:15px; "><b><u>TEST RESULTS</u></b></td>
            </tr>
            <tr>
                <td style="text-align:left; font-size:17px;"><b><u>Marshal Calculatuion </u></b></td>
            </tr>


            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:left;font-size:12px; ">
                    <br>
                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

                        <tr style="">
                            <td style="border-left: 1px solid black;border-top:1px solid;width:5%;font-weight:bold; text-align:center; ">SR.<BR>NO.</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:17%;text-align:center;font-weight:bold; ">Sample ID</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:8%; text-align:center;font-weight:bold;">Binder<br> Content</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:17%;text-align:center;font-weight:bold;">Density</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:17%;text-align:center;font-weight:bold;">Average<br> Density</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:17%;text-align:center;font-weight:bold;">Marshall<br> Stability</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:19%;text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px;">Average<br> Marshall<br> Stability</td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;">-</td>
                            <td style="border-left: 1px solid black;width:17%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">-</td>
                            <td style="border-left: 1px solid black;width:8%; text-align:center;border-top:1px solid;">%</td>
                            <td style="border-left: 1px solid black;width:17%; text-align:center;border-top:1px solid;">(gm/cc)</td>
                            <td style="border-left: 1px solid black;width:17%;text-align:center; border-top:1px solid;">(gm/cc)</td>
                            <td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;">(kN)</td>
                            <td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">(kN)</td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:17%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">M-01</td>
                            <td style="border-left: 1px solid black;width:8%; text-align:center;border-top:1px solid;" rowspan=3><?php if ($row_select_pipe['bic_1'] != "" && $row_select_pipe['bic_1'] != null && $row_select_pipe['bic_1'] != "0") {
                                                                                                                                        echo $row_select_pipe['bic_1'];
                                                                                                                                    } else {
                                                                                                                                        echo "-";
                                                                                                                                    } ?></td>
                            <td style="border-left: 1px solid black;width:17%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['den_1'] != "" && $row_select_pipe['den_1'] != null && $row_select_pipe['den_1'] != "0") {
                                                                                                                            echo $row_select_pipe['den_1'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:17%;text-align:center; border-top:1px solid;" rowspan=3><?php if ($row_select_pipe['den_1'] != "" && $row_select_pipe['den_1'] != null && $row_select_pipe['den_1'] != "0") {
                                                                                                                                        echo substr((($row_select_pipe['den_1'] + $row_select_pipe['den_2'] + $row_select_pipe['den_3']) / 3), 0, 4);
                                                                                                                                    } else {
                                                                                                                                        echo "-";
                                                                                                                                    } ?></td>
                            <td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['ms_1'] != "" && $row_select_pipe['ms_1'] != null && $row_select_pipe['ms_1'] != "0") {
                                                                                                                            echo $row_select_pipe['ms_1'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;" rowspan=3><?php if ($row_select_pipe['ms_1'] != "" && $row_select_pipe['ms_1'] != null && $row_select_pipe['ms_1'] != "0") {
                                                                                                                                        echo substr((($row_select_pipe['ms_1'] + $row_select_pipe['ms_2'] + $row_select_pipe['ms_3']) / 3), 0, 4);
                                                                                                                                    } else {
                                                                                                                                        echo "-";
                                                                                                                                    } ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:17%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">M-02</td>
                            <td style="border-left: 1px solid black;width:17%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['den_2'] != "" && $row_select_pipe['den_2'] != null && $row_select_pipe['den_2'] != "0") {
                                                                                                                            echo $row_select_pipe['den_2'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['ms_2'] != "" && $row_select_pipe['ms_2'] != null && $row_select_pipe['ms_2'] != "0") {
                                                                                                                            echo $row_select_pipe['ms_2'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
                            <td style="border-left: 1px solid black;width:17%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">M-03</td>
                            <td style="border-left: 1px solid black;width:17%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['den_3'] != "" && $row_select_pipe['den_3'] != null && $row_select_pipe['den_3'] != "0") {
                                                                                                                            echo $row_select_pipe['den_3'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                            <td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['ms_3'] != "" && $row_select_pipe['ms_3'] != null && $row_select_pipe['ms_3'] != "0") {
                                                                                                                            echo $row_select_pipe['ms_3'];
                                                                                                                        } else {
                                                                                                                            echo "-";
                                                                                                                        } ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px; " colspan=2>Requirement as per Morth 5th Revision</td>
                            <td style="border-left: 1px solid black;width:8%;text-align:center;border-top:1px solid; ">4500</td>
                            <td style="border-left: 1px solid black;width:17%; text-align:center;border-top:1px solid;">-</td>
                            <td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;">-</td>
                            <td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;">Min.9.0</td>
                            <td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">-</td>
                        </tr>

                    </table>

                </td>
            </tr>


            <tr>
                <td style="text-align:center; "><br>
                    <table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;font-size:14px; ">
                        <tr>
                            <td><b>Note :-</b></td>
                        </tr>
                        <tr>
                            <td><b> > &nbsp;</b>Test rcsults are related to samples submitted by customers only.<br></td>
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
                <td style="text-align:right;font-size:11px;padding-right:80px; "><br><br><br><br><br><br>
                    <table align="right" width="80%" class="test" style="height:auto;font-family: Cambria; ">
                        <tr>
                            <td style="text-align:right"><b>Approved By<br><br></b></td>
                        </tr>
                        <tr>
                            <td style="text-align:right"><b></b></td>
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


</body>

</html>

<script type="text/javascript">


</script>