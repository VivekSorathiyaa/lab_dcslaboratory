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
    $agreement_no = $row_select['agreement_no'];
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
        <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
            <tr>
                <td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF REBOUND HAMMER</u></b></td>
            </tr>
            <tr>
                <td style="text-align:center;font-size:11px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">

                            <td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp; Authority</td>
                            <td style="border-left: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
                                                                                                        $result_selectc = mysqli_query($conn, $select_queryc);

                                                                                                        if (mysqli_num_rows($result_selectc) > 0) {
                                                                                                            $row_selectc = mysqli_fetch_assoc($result_selectc);
                                                                                                            $ct_nm = $row_selectc['city_name'];
                                                                                                        }
                                                                                                        echo $clientname; ?></td>
                            <td style="border-left: 1px solid black;width:12%; font-weight:bold;">&nbsp; Project No.</td>
                            <td style="border-left: 1px solid black;border-right: 1px solid;width:18%;">&nbsp; <?php echo $agreement_no; ?></td>
                        </tr>
                        <tr style="">

                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:11%;font-weight:bold;">&nbsp; </td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;</td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;width:11%; font-weight:bold; ">&nbsp; ULR No.</td>
                            <td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp; <?php echo $_GET['ulr']; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp; Name Of Work</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php echo $name_of_work; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp; Report No.</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid;">&nbsp; <?php echo $report_no; ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp; Consultant</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; <!--First PMC--><?php echo $row_select['pmc_heading']; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp; Report Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid; ">&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp; Agency</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php echo $agency_name; ?></td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp; Testing Date</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid; ">&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
                        </tr>

                        <tr style="">

                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp; Ref No.</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;<?php if ($material_location == 1) {
                                                                                                                                        echo "In Laboratory";
                                                                                                                                    } else {
                                                                                                                                        echo "In Field";
                                                                                                                                    } ?> </td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp; grade of Concrete</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid; ">&nbsp; M - 25</td>
                        </tr>


                    </table><br>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:11px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

                        <tr style="">

                            <td style="border-left: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp; Location</td>
                            <td style="border-left: 1px solid black;width:38%;text-align:left; ">&nbsp;<?php if ($material_location == 1) {
                                                                                                            echo "In Laboratory";
                                                                                                        } else {
                                                                                                            echo "In Field";
                                                                                                        } ?> <?php echo $source; ?></td>
                            <td style="border-left: 1px solid black;width:12%; font-weight:bold;">&nbsp; date of Casting</td>
                            <td style="border-left: 1px solid black;width:18%;">&nbsp; <?php echo date('d - m - Y', strtotime($rh_cast_date)); ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp; Structure Location</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:85%;text-align:left; " colspan=3><?php echo $source; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp; Test Method Adopted</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:85%;text-align:left; " colspan=3>&nbsp; IS - 13311 - 1992 (Part - 2), R. A. 2019</td>
                        </tr>
                        <tr style="">
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp; Temperature</td>
                            <td style="border-left: 1px solid black;border-top: 1px solid black;width:85%;text-align:left; " colspan=3><?php echo $row_select_pipe['temp']; ?></td>
                        </tr>

                    </table><br>

                </td>
            </tr>




            <tr>
                <td style="text-align:center; font-size:15px;padding-bottom:10px;"><b><u>REBOUND HAMMER TEST RESULTS</u></b></td>
            </tr>

            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:left;font-size:11px; ">
                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

                        <tr style="">
                            <td style="border-left: 1px solid black;border-top:1px solid;width:3%;font-weight:bold; text-align:center; ">Sr.<br>NO.</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:10%;text-align:center;font-weight:bold; ">Chainage</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:15%; text-align:center;font-weight:bold;">Readings</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:24%;font-weight:bold;text-align:center; " colspan=6>Rebound Hammer</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:7%;text-align:center;font-weight:bold;">Angle</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:10%;text-align:center;font-weight:bold;">Direction of Hammer</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:10%;text-align:center;font-weight:bold;">Average Rebound Number</td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:11%;text-align:center;font-weight:bold;padding-bottom:1px;padding-top:1px;">Compressive Strength N/mm<sup>2</sup></td>
                            <td style="border-left: 1px solid black;border-top:1px solid;width:10%;text-align:center;font-weight:bold;">Average Compressive Strength</td>
                        </tr>
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
                                <td style="border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;"><?php echo $count; ?></td>
                                <td style="border-left: 1px solid black;width:10%;text-align:center;border-top:1px solid; ">Beam at <?php echo $cnt; ?> mtr</td>
                                <td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;">Actual</td>
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
                                <td style="border-left: 1px solid black;width:7%;border-top:1px solid;text-align:center;">0&deg;</td>
                                <td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;padding-bottom:2px;padding-top:2px;">Horizontal</td>
                                <td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['avg_r_num'] != "" && $row_select_pipe['avg_r_num'] != null && $row_select_pipe['avg_r_num'] != "0") {
                                                                                                                                echo $row_select_pipe['avg_r_num'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:11%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != null && $row_select_pipe['com_1'] != "0") {
                                                                                                                                echo $row_select_pipe['com_1'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                                <td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['avg_com'] != "" && $row_select_pipe['avg_com'] != null && $row_select_pipe['avg_com'] != "0") {
                                                                                                                                echo $row_select_pipe['avg_com'];
                                                                                                                            } else {
                                                                                                                                echo "-";
                                                                                                                            } ?></td>
                            <?php
                            $count++;
                            $cnt += 3;
                        }
                        //for($i=$count; $i<=10; $i++){
                            ?>
                            <!--tr style="">
							<td style="border: 1px solid black;border-right: 0;border-bottom: 0;text-align:center;"><?php //echo $i;
                                                                                                                    ?></td>
							<td  style="border-left: 1px solid black;width:10%;text-align:center;border-top:1px solid; " rowspan=2>Beam at 0 mtr</td>	
							<td  style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;"><b>Corrected</b></td>
							<td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:7%;border-top:1px solid;text-align:center;">0&deg;</td>
							<td  style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;padding-bottom:2px;padding-top:2px;">Horizontal</td>
							<td  style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:11%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:11%;border-top:1px solid;text-align:center;"></td>
						</tr-->
                            <?php
                            //}
                            ?>



                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:11px; ">
                    <br>
                </td>
            </tr>
            <tr>
                <td style="text-align:center;font-size:11px; "><br>
                    <table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;font-size:14px; ">
                        <tr>
                            <td><b>Note :-</b></td>
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
                <td style="text-align:right;font-size:11px;padding-right:80px; "><br><br><br>
                    <table align="right" width="80%" class="test" style="height:auto;font-family: Cambria; ">
                        <tr>
                            <td style="text-align:right"><b>Approved By</b></td>
                        </tr>
                        <!--tr>
							<td style="text-align:right"><b>For, Goma Engineering Consultancy,</b></td>
						</tr>
						
						<tr>
							
							<td style="text-align:right"><b>Mr. Darshan Patel</b></td>
							
						</tr-->
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
        </table>
    </page>

</body>

</html>

<script type="text/javascript">


</script>