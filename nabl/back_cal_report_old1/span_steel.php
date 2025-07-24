<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
    @page {
        margin: 30px 10px;
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
    function round_up($number, $precision = 0)
    {
        $fig = (int) str_pad('1', $precision, '0');
        return (ceil($number * $fig) / $fig);
    }
    $job_no = $_GET['job_no'];
    $lab_no = $_GET['lab_no'];
    $report_no = $_GET['report_no'];
    $trf_no = $_GET['trf_no'];
    $select_tiles_query = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
    $result_tiles_select = mysqli_query($conn, $select_tiles_query);
    $no_of_rows = mysqli_num_rows($result_tiles_select);
    $page_cont = round_up($no_of_rows / 5);
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
    $tpi_or_auth = $row_select['tpi_or_auth'];
    $pmc_heading = $row_select['pmc_heading'];
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
        $material_location = $row_select4['material_location'];
        $dia = explode(",", $row_select4['steel_dia']);
        $grade = $row_select4['steel_grade'];
        $brand = $row_select4['steel_brand'];
        $sample_qty1 = $row_select4['steel_sample_qty'];
        $heat = $row_select4['steel_heat'];
        $steel_qty = $row_select4['steel_sample_qty'];
        $steel_source_name = $row_select4['steel_source_name'];

        $grade_data = explode(",", $row_select4['steel_grade']);
    }

    $flag = 0;
    $a = 1;
    $down = 0;
    $up = 5;
    /*for($a=0;$a<$page_cont;$a++)
			{*/
    ?>

    <br>
    <page size="A4">
        <table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-003</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR <br> TEST ON STEEL </b></center>
				</td>
			</tr>
		</table>
		<br><br>
		<table align="center" width="94%" class="test1" height="9%">
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Brand</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $row_select_pipe['brand']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Type of steel & Grade</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; Reinforcement Steel <?php echo $row_select_pipe['grade']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of sample</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - Y",strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>
        <table align="center" width="94%" class="test1">
			<tr>
				<td style="font-size: 17px;"><b>(As Per IS: 1786-2008    IS: 1599-2019 IS: 1608-2022 P -1)</b></td>
			</tr>
		</table>
        <br>

        <table align="center" width="94%" class="test1" height="9%" style="border: 1px solid;">
            <tr style="">
                <td style="width:100%; text-align:center;font-weight:bold;padding-top:7px;padding-bottom:7px; border-top: 0;">Determination of Mass Per Meter, Tensile strength, Ultimate Tensile strength Yield stress/proof stress and Elongation percent</td>
            </tr>

            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-top:1px solid;">
                        <tr style="">
                            <td style="width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;width:50%;text-align:center; " colspan=3>Diameter in mm</td>
                            <?php
                            $select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select1 = mysqli_query($conn, $select_tilesy);
                            $coming_row = mysqli_num_rows($result_tiles_select1);

                            while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
                                $flag++;
                            ?>
                                <td style="border-left:1px solid;text-align:center; "><?php echo mb_substr($row_select_pipe2['dia_1'], 0, -2);  ?></td>
                            <?php
                                if ($flag == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Weight of Bar W (kg)</td>
                            <?php
                            $select_tilesy5 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
                            $coming_row = mysqli_num_rows($result_tiles_select15);

                            while ($row_select_pipe25 = mysqli_fetch_array($result_tiles_select15)) {
                                $flag5++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php
                                                                                                                    echo $row_select_pipe25['w_1']; ?></td>
                            <?php
                                if ($flag5 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Length of Bar L (m)</td>
                            <?php
                            $select_tilesy6 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select16 = mysqli_query($conn, $select_tilesy6);
                            $coming_row = mysqli_num_rows($result_tiles_select16);

                            while ($row_select_pipe26 = mysqli_fetch_array($result_tiles_select16)) {
                                $flag6++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php echo $row_select_pipe26['len_1']; ?></td>
                            <?php
                                if ($flag6 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%; text-align:center;  " rowspan=2><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; " rowspan=2>&nbsp; Cross sectional area &nbsp;&nbsp;&nbsp;=</td>
                            <td style="border-top:1px solid;width:10%;text-align:center;padding-bottom:2px;padding-top:2px; ">W</td>
                            <td style="border-top:1px solid;width:20%;text-align:center; " rowspan=2>mm&sup2;</td>
                            <?php
                            $select_tilesy5 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
                            $coming_row = mysqli_num_rows($result_tiles_select15);

                            while ($row_select_pipe25 = mysqli_fetch_array($result_tiles_select15)) {
                                $flag15++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; " rowspan=2><?php if ($row_select_pipe25['w_1'] != "" && $row_select_pipe25['w_1'] != null && $row_select_pipe25['w_1'] != "0") {
                                                                                                                                    echo substr(($row_select_pipe25['w_1'] / 0.00785), 0, 5);
                                                                                                                                } ?></td>
                            <?php
                                if ($flag15 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:8%;text-align:center;padding-bottom:2px;padding-top:2px; ">0.00785 L</td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Initial gauge length 5.65√A.....mm</td>
                            <?php
                            $select_tilesy9 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select19 = mysqli_query($conn, $select_tilesy9);
                            $coming_row = mysqli_num_rows($result_tiles_select19);

                            while ($row_select_pipe9 = mysqli_fetch_array($result_tiles_select19)) {
                                $flag9++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php if ($row_select_pipe9['og_1'] != "" && $row_select_pipe9['og_1'] != null && $row_select_pipe9['og_1'] != "0") {
                                                                                                                        echo $row_select_pipe9['og_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag9 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Dial reading of Yield point load(T)</td>
                            <?php
                            $select_tilesy25 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select25 = mysqli_query($conn, $select_tilesy25);
                            $coming_row = mysqli_num_rows($result_tiles_select25);

                            while ($row_select_pipe25 = mysqli_fetch_array($result_tiles_select25)) {
                                $flag25++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php if ($row_select_pipe25['yp_1'] != "" && $row_select_pipe25['yp_1'] != null && $row_select_pipe25['yp_1'] != "0") {
                                                                                                                        echo $row_select_pipe25['yp_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag25 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Dial reading of Ultimate tensile load(T)</td>
                            <?php
                            $select_tilesy10 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select10 = mysqli_query($conn, $select_tilesy10);
                            $coming_row = mysqli_num_rows($result_tiles_select10);

                            while ($row_select_pipe10 = mysqli_fetch_array($result_tiles_select10)) {
                                $flag10++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php if ($row_select_pipe10['up_1'] != "" && $row_select_pipe10['up_1'] != null && $row_select_pipe10['up_1'] != "0") {
                                                                                                                        echo $row_select_pipe10['up_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag10 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Yield stress = load/area=(N/mm&sup2)(True load)</td>
                            <?php
                            $select_tilesy25 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select25 = mysqli_query($conn, $select_tilesy25);
                            $coming_row = mysqli_num_rows($result_tiles_select25);

                            while ($row_select_pipe25 = mysqli_fetch_array($result_tiles_select25)) {
                                $flag25++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php if ($row_select_pipe25['w_1'] != "" && $row_select_pipe25['w_1'] != null && $row_select_pipe25['w_1'] != "0") {
                                                                                                                        echo substr(($row_select_pipe25['yp_1'] / ($row_select_pipe25['w_1'] / 0.00785)), 0, 5);
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag10 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Ultimate tensile strength(N/mm&sup2)=load/area</td>
                            <?php
                            $select_tilesy24 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select24 = mysqli_query($conn, $select_tilesy24);
                            $coming_row = mysqli_num_rows($result_tiles_select24);

                            while ($row_select_pipe24 = mysqli_fetch_array($result_tiles_select24)) {
                                $flag24++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php if ($row_select_pipe24['ten_1'] != "" && $row_select_pipe24['ten_1'] != null && $row_select_pipe24['ten_1'] != "0") {
                                                                                                                        echo $row_select_pipe24['ten_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag24 == 5) {
                                    break;
                                }
                            }

                            ?>

                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Original gauge length = 0<sub>1</sub>(mm)</td>
                            <?php
                            $select_tilesy27 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select27 = mysqli_query($conn, $select_tilesy27);
                            $coming_row = mysqli_num_rows($result_tiles_select27);

                            while ($row_select_pipe27 = mysqli_fetch_array($result_tiles_select27)) {
                                $flag27++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php if ($row_select_pipe27['ys_1'] != "" && $row_select_pipe27['ys_1'] != null && $row_select_pipe27['ys_1'] != "0") {
                                                                                                                        echo round(($row_select_pipe27['ten_1'] / $row_select_pipe27['ys_1']), 2);
                                                                                                                    } ?></td>
                            <?php
                                if ($flag27 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Final gauge length = f<sub>1</sub>= (mm)</td>
                            <?php
                            $select_tilesy28 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select28 = mysqli_query($conn, $select_tilesy28);
                            $coming_row = mysqli_num_rows($result_tiles_select28);

                            while ($row_select_pipe28 = mysqli_fetch_array($result_tiles_select28)) {
                                $flag28++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php if ($row_select_pipe28['fg_1'] != "" && $row_select_pipe28['fg_1'] != null && $row_select_pipe28['fg_1'] != "0") {
                                                                                                                        echo $row_select_pipe28['fg_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag28 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>%age of elongation= (f<sub>1</sub>-0<sub>1</sub> )x100/0<sub>1</sub></td>
                            <?php
                            $select_tilesy29 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select29 = mysqli_query($conn, $select_tilesy29);
                            $coming_row = mysqli_num_rows($result_tiles_select29);

                            while ($row_select_pipe29 = mysqli_fetch_array($result_tiles_select29)) {
                                $flag29++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php if ($row_select_pipe29['elo_1'] != "" && $row_select_pipe29['elo_1'] != null && $row_select_pipe29['elo_1'] != "0") {
                                                                                                                        echo $row_select_pipe29['elo_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag29 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Bend test</td>
                            <?php
                            $select_tilesy31 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select31 = mysqli_query($conn, $select_tilesy31);
                            $coming_row = mysqli_num_rows($result_tiles_select31);

                            while ($row_select_pipe31 = mysqli_fetch_array($result_tiles_select31)) {
                                $flag31++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;text-align:center; "><?php if ($row_select_pipe31['bend_1'] != "" && $row_select_pipe31['bend_1'] != null && $row_select_pipe31['bend_1'] != "0") {
                                                                                                                        echo $row_select_pipe31['bend_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag31 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                    </table>

                </td>
            </tr>
		</table>
        <br>

        <table align="center" width="94%" class="test1" style="margin-bottom: 20px;" Height="20%">
			<tr style="font-size:16px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Tested By: </b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
			</tr>		
		</table>







        <!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
        <!-- <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;"> -->
            <!-- <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/H/OS/1</td>
                            <td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
                            <td style="width:25%; font-weight:bold;">RD :- 05/01/2023</td>
                            <td style="width:25%;font-weight:bold;">Page : </td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:65%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
                            <td style="width:35%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:16px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;">

                        <tr style="">

                            <td style="width:75%;padding-bottom:3px;padding-top:2px;padding-left:150px; text-align:center;font-weight:bold; ">Goma Engineering and Consultancy, Ahmedabad,</td>
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
                            <td style="width:75%;padding-bottom:8px;padding-top:3px; text-align:center;padding-left:150px; ">Email: gomaconsultancy@gmail.com</td>
                        </tr>

                    </table><br>

                </td>
            </tr>

            <tr>
                <td style="text-align:center;font-size:16px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;">

                        <tr style="">

                            <td style="width:100%; text-align:center;font-weight:bold; "> OBSERVATION AND CALCULAITON SHEET FOR TEST ON STEEL HSD AND TMT BAR</td>
                        </tr>

                    </table><br>

                </td>
            </tr> -->


            <?php $cnt = 1; ?>
            <!-- <tr>
                <td style="text-align:center;font-size:15px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:15px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

                        <tr style="">
                            <td style="width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; Job No.</td>
                            <td style="border-left:1px solid;width:63%;text-align:left; ">&nbsp;&nbsp; <?php echo $lab_no; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; Laboratory No.</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:63%;text-align:left; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; Sample sent by</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:63%;text-align:left; ">&nbsp;&nbsp; <?php if ($row_select['sel_report_to'] == 1) {
                                                                                                                                echo 'Agency';
                                                                                                                            } else {
                                                                                                                                echo 'Client';
                                                                                                                            } ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; Received vide Letter No.</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:63%;text-align:left; ">&nbsp;&nbsp; </td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; Quantity of sample</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:63%;text-align:left; ">&nbsp;&nbsp; <?php echo $sample_qty1; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; Identification mark</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:63%;text-align:left; ">&nbsp;&nbsp; </td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; Details of Steel</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:63%;text-align:left; ">&nbsp;&nbsp; Reinforcement Steel</td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; Date of receipt of sample</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:63%;text-align:left;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; Date of starting test</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:63%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; Probable date of completion</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:63%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;text-align:center; "><?php echo $cnt++; ?></td>
                            <td style="border-left:1px solid;border-top:1px solid;width:32%;padding-bottom:2px;padding-top:2px;text-align:left; ">&nbsp;&nbsp; As per IS Code</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:63%;text-align:left; ">&nbsp;&nbsp; IS : 1608-1995,IS:1599-2012 RA 2017,IS: 1786-2008 RA 2013</td>
                        </tr>

                    </table><br>

                </td>
            </tr> -->

            <!-- <tr>
                <td style="text-align:center;font-size:15px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:15px;font-family: Cambria;border-top:1px solid;margin-top:7px;">

                        <tr style="">

                            <td style="width:100%; text-align:center;font-weight:bold;padding-top:7px;padding-bottom:2px; ">1. Determination of Tensile Strength, Yield Stress, Mass Per Meter and Elongation Percent</td>
                        </tr>

                    </table>

                </td>
            </tr>

            <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:center;font-size:14px; ">

                    <table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;">

                        <tr style="">
                            <td style="width:45%;text-align:center;padding-bottom:2px;padding-top:2px; " colspan=4></td>
                            <td style="border-left:1px solid;width:9%; text-align:center;padding-bottom:2px;padding-top:2px;">1</td>
                            <td style="border-left:1px solid;width:9%; text-align:center; ">2 </td>
                            <td style="border-left:1px solid;width:9%; text-align:center;  ">3</td>
                            <td style="border-left:1px solid;width:9%; text-align:center;  ">4</td>
                            <td style="border-left:1px solid;width:9%; text-align:center;  ">5</td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%; text-align:center;  "></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center;font-weight:bold;padding-bottom:2px;padding-top:2px; " colspan=3>Lab No.</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo $lab_no; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo $lab_no; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo $lab_no; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo $lab_no; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo $lab_no; ?></td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Diameter in mm</td>
                            <?php
                            $select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select1 = mysqli_query($conn, $select_tilesy);
                            $coming_row = mysqli_num_rows($result_tiles_select1);

                            while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
                                $flag++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo mb_substr($row_select_pipe2['dia_1'], 0, -2);  ?></td>


                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo mb_substr($row_select_pipe2['dia_2'], 0, -2);  ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo mb_substr($row_select_pipe2['dia_3'], 0, -2);  ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo mb_substr($row_select_pipe2['dia_4'], 0, -2);  ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo mb_substr($row_select_pipe2['dia_5'], 0, -2);  ?></td>
                            <?php
                                if ($flag == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Weight of Bar W (kg)</td>
                            <?php
                            $select_tilesy5 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
                            $coming_row = mysqli_num_rows($result_tiles_select15);

                            while ($row_select_pipe25 = mysqli_fetch_array($result_tiles_select15)) {
                                $flag5++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php
                                                                                                                    echo $row_select_pipe25['w_1']; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php
                                                                                                                    echo $row_select_pipe25['w_2']; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php
                                                                                                                    echo $row_select_pipe25['w_3']; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php
                                                                                                                    echo $row_select_pipe25['w_4']; ?></td>
                            <?php
                                if ($flag5 == 5) {
                                    break;
                                }
                            }

                            ?>
                            <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "></td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Length of Bar L (m)</td>
                            <?php
                            $select_tilesy6 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select16 = mysqli_query($conn, $select_tilesy6);
                            $coming_row = mysqli_num_rows($result_tiles_select16);

                            while ($row_select_pipe26 = mysqli_fetch_array($result_tiles_select16)) {
                                $flag6++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo $row_select_pipe26['len_1']; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo $row_select_pipe26['len_2']; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo $row_select_pipe26['len_3']; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo $row_select_pipe26['len_4']; ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php echo $row_select_pipe26['len_5']; ?></td>
                            <?php
                                if ($flag6 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%; text-align:center;  " rowspan=2><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; " rowspan=2>Cross sectional area=</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;padding-bottom:2px;padding-top:2px; ">W</td>
                            <td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; " rowspan=2>mm&sup2;</td>
                            <?php
                            $select_tilesy5 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
                            $coming_row = mysqli_num_rows($result_tiles_select15);

                            while ($row_select_pipe25 = mysqli_fetch_array($result_tiles_select15)) {
                                $flag5++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; " rowspan=2><?php if ($row_select_pipe25['w_1'] != "" && $row_select_pipe25['w_1'] != null && $row_select_pipe25['w_1'] != "0") {
                                                                                                                                    echo substr(($row_select_pipe25['w_1'] / 0.00785), 0, 5);
                                                                                                                                } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; " rowspan=2><?php if ($row_select_pipe25['w_2'] != "" && $row_select_pipe25['w_2'] != null && $row_select_pipe25['w_2'] != "0") {
                                                                                                                                    echo ($row_select_pipe25['w_1'] / 0.00785);
                                                                                                                                } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; " rowspan=2><?php if ($row_select_pipe25['w_3'] != "" && $row_select_pipe25['w_3'] != null && $row_select_pipe25['w_3'] != "0") {
                                                                                                                                    echo ($row_select_pipe25['w_3'] / 0.00785);
                                                                                                                                } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; " rowspan=2><?php if ($row_select_pipe25['w_4'] != "" && $row_select_pipe25['w_4'] != null && $row_select_pipe25['w_4'] != "0") {
                                                                                                                                    echo ($row_select_pipe25['w_4'] / 0.00785);
                                                                                                                                }   ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; " rowspan=2><?php if ($row_select_pipe25['w_5'] != "" && $row_select_pipe25['w_5'] != null && $row_select_pipe25['w_5'] != "0") {
                                                                                                                                    echo ($row_select_pipe25['w_5'] / 0.00785);
                                                                                                                                } ?></td>
                            <?php
                                if ($flag5 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;border-left:1px solid;width:8%;text-align:center;padding-bottom:2px;padding-top:2px; ">0.00785 L</td>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Initial gauge length 5.65√A.....mm</td>
                            <?php
                            $select_tilesy9 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select19 = mysqli_query($conn, $select_tilesy9);
                            $coming_row = mysqli_num_rows($result_tiles_select19);

                            while ($row_select_pipe9 = mysqli_fetch_array($result_tiles_select19)) {
                                $flag9++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe9['og_1'] != "" && $row_select_pipe9['og_1'] != null && $row_select_pipe9['og_1'] != "0") {
                                                                                                                        echo $row_select_pipe9['og_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe9['og_2'] != "" && $row_select_pipe9['og_2'] != null && $row_select_pipe9['og_2'] != "0") {
                                                                                                                        echo $row_select_pipe9['og_2'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe9['og_3'] != "" && $row_select_pipe9['og_3'] != null && $row_select_pipe9['og_3'] != "0") {
                                                                                                                        echo $row_select_pipe9['og_3'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe9['og_4'] != "" && $row_select_pipe9['og_4'] != null && $row_select_pipe9['og_4'] != "0") {
                                                                                                                        echo $row_select_pipe9['og_4'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe9['og_5'] != "" && $row_select_pipe9['og_5'] != null && $row_select_pipe9['og_5'] != "0") {
                                                                                                                        echo $row_select_pipe9['og_5'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag9 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Yield point load=..........KN</td>
                            <?php
                            $select_tilesy25 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select25 = mysqli_query($conn, $select_tilesy25);
                            $coming_row = mysqli_num_rows($result_tiles_select25);

                            while ($row_select_pipe25 = mysqli_fetch_array($result_tiles_select25)) {
                                $flag25++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe25['yp_1'] != "" && $row_select_pipe25['yp_1'] != null && $row_select_pipe25['yp_1'] != "0") {
                                                                                                                        echo $row_select_pipe25['yp_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe25['yp_2'] != "" && $row_select_pipe25['yp_2'] != null && $row_select_pipe25['yp_2'] != "0") {
                                                                                                                        echo $row_select_pipe25['yp_2'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe25['yp_3'] != "" && $row_select_pipe25['yp_3'] != null && $row_select_pipe25['yp_3'] != "0") {
                                                                                                                        echo $row_select_pipe25['yp_3'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe25['yp_4'] != "" && $row_select_pipe25['yp_4'] != null && $row_select_pipe25['yp_4'] != "0") {
                                                                                                                        echo $row_select_pipe25['yp_4'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe25['yp_5'] != "" && $row_select_pipe25['yp_5'] != null && $row_select_pipe25['yp_5'] != "0") {
                                                                                                                        echo $row_select_pipe25['yp_5'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag25 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Ultimate tensile load= .....KN</td>
                            <?php
                            $select_tilesy10 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select10 = mysqli_query($conn, $select_tilesy10);
                            $coming_row = mysqli_num_rows($result_tiles_select10);

                            while ($row_select_pipe10 = mysqli_fetch_array($result_tiles_select10)) {
                                $flag10++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe10['up_1'] != "" && $row_select_pipe10['up_1'] != null && $row_select_pipe10['up_1'] != "0") {
                                                                                                                        echo $row_select_pipe10['up_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe10['up_2'] != "" && $row_select_pipe10['up_2'] != null && $row_select_pipe10['up_2'] != "0") {
                                                                                                                        echo $row_select_pipe10['up_2'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe10['up_3'] != "" && $row_select_pipe10['up_3'] != null && $row_select_pipe10['up_3'] != "0") {
                                                                                                                        echo $row_select_pipe10['up_3'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe10['up_4'] != "" && $row_select_pipe10['up_4'] != null && $row_select_pipe10['up_4'] != "0") {
                                                                                                                        echo $row_select_pipe10['up_4'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe10['up_5'] != "" && $row_select_pipe10['up_5'] != null && $row_select_pipe10['up_5'] != "0") {
                                                                                                                        echo $row_select_pipe10['up_5'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag10 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Yield stress = load/area=.....N/mm&sup2;</td>
                            <?php
                            $select_tilesy25 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select25 = mysqli_query($conn, $select_tilesy25);
                            $coming_row = mysqli_num_rows($result_tiles_select25);

                            while ($row_select_pipe25 = mysqli_fetch_array($result_tiles_select25)) {
                                $flag25++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe25['w_1'] != "" && $row_select_pipe25['w_1'] != null && $row_select_pipe25['w_1'] != "0") {
                                                                                                                        echo substr(($row_select_pipe25['yp_1'] / ($row_select_pipe25['w_1'] / 0.00785)), 0, 5);
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe25['w_2'] != "" && $row_select_pipe25['w_2'] != null && $row_select_pipe25['w_2'] != "0") {
                                                                                                                        echo ($row_select_pipe25['yp_2'] / ($row_select_pipe25['w_2'] / 0.00785));
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe25['w_3'] != "" && $row_select_pipe25['w_3'] != null && $row_select_pipe25['w_3'] != "0") {
                                                                                                                        echo ($row_select_pipe25['yp_3'] / ($row_select_pipe25['w_3'] / 0.00785));
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe25['w_4'] != "" && $row_select_pipe25['w_4'] != null && $row_select_pipe25['w_4'] != "0") {
                                                                                                                        echo ($row_select_pipe25['yp_4'] / ($row_select_pipe25['w_4'] / 0.00785));
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe25['w_5'] != "" && $row_select_pipe25['w_5'] != null && $row_select_pipe25['w_5'] != "0") {
                                                                                                                        echo ($row_select_pipe25['yp_5'] / ($row_select_pipe25['w_5'] / 0.00785));
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag10 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Ultimate tensile strength=.....N/mm&sup2;</td>
                            <?php
                            $select_tilesy24 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select24 = mysqli_query($conn, $select_tilesy24);
                            $coming_row = mysqli_num_rows($result_tiles_select24);

                            while ($row_select_pipe24 = mysqli_fetch_array($result_tiles_select24)) {
                                $flag24++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe24['ten_1'] != "" && $row_select_pipe24['ten_1'] != null && $row_select_pipe24['ten_1'] != "0") {
                                                                                                                        echo $row_select_pipe24['ten_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe24['ten_2'] != "" && $row_select_pipe24['ten_2'] != null && $row_select_pipe24['ten_2'] != "0") {
                                                                                                                        echo $row_select_pipe24['ten_2'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe24['ten_3'] != "" && $row_select_pipe24['ten_3'] != null && $row_select_pipe24['ten_3'] != "0") {
                                                                                                                        echo $row_select_pipe24['ten_3'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe24['ten_4'] != "" && $row_select_pipe24['ten_4'] != null && $row_select_pipe24['ten_4'] != "0") {
                                                                                                                        echo $row_select_pipe24['ten_4'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe24['ten_5'] != "" && $row_select_pipe24['ten_5'] != null && $row_select_pipe24['ten_5'] != "0") {
                                                                                                                        echo $row_select_pipe24['ten_5'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag24 == 5) {
                                    break;
                                }
                            }

                            ?>

                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Original gauge length 0<sub>1</sub> =....mm</td>
                            <?php
                            $select_tilesy27 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select27 = mysqli_query($conn, $select_tilesy27);
                            $coming_row = mysqli_num_rows($result_tiles_select27);

                            while ($row_select_pipe27 = mysqli_fetch_array($result_tiles_select27)) {
                                $flag27++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe27['ys_1'] != "" && $row_select_pipe27['ys_1'] != null && $row_select_pipe27['ys_1'] != "0") {
                                                                                                                        echo round(($row_select_pipe27['ten_1'] / $row_select_pipe27['ys_1']), 2);
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php
                                                                                                                    if ($row_select_pipe27['ys_2'] != "" && $row_select_pipe27['ys_2'] != null && $row_select_pipe27['ys_2'] != "0") {
                                                                                                                        echo round(($row_select_pipe27['ten_2'] / $row_select_pipe27['ys_2']), 2);
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe27['ys_3'] != "" && $row_select_pipe27['ys_3'] != null && $row_select_pipe27['ys_3'] != "0") {
                                                                                                                        echo round(($row_select_pipe27['ten_3'] / $row_select_pipe27['ys_3']), 2);
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe27['ys_4'] != "" && $row_select_pipe27['ys_4'] != null && $row_select_pipe27['ys_4'] != "0") {
                                                                                                                        echo round(($row_select_pipe27['ten_4'] / $row_select_pipe27['ys_4']), 2);
                                                                                                                    }   ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe27['ys_5'] != "" && $row_select_pipe27['ys_5'] != null && $row_select_pipe27['ys_5'] != "0") {
                                                                                                                        echo round(($row_select_pipe27['ten_5'] / $row_select_pipe27['ys_5']), 2);
                                                                                                                    }  ?></td>
                            <?php
                                if ($flag27 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Final gauge length f<sub>1</sub>=....mm</td>
                            <?php
                            $select_tilesy28 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select28 = mysqli_query($conn, $select_tilesy28);
                            $coming_row = mysqli_num_rows($result_tiles_select28);

                            while ($row_select_pipe28 = mysqli_fetch_array($result_tiles_select28)) {
                                $flag28++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe28['fg_1'] != "" && $row_select_pipe28['fg_1'] != null && $row_select_pipe28['fg_1'] != "0") {
                                                                                                                        echo $row_select_pipe28['fg_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe28['fg_2'] != "" && $row_select_pipe28['fg_2'] != null && $row_select_pipe28['fg_2'] != "0") {
                                                                                                                        echo $row_select_pipe28['fg_2'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe28['fg_3'] != "" && $row_select_pipe28['fg_3'] != null && $row_select_pipe28['fg_3'] != "0") {
                                                                                                                        echo $row_select_pipe28['fg_3'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe28['fg_4'] != "" && $row_select_pipe28['fg_4'] != null && $row_select_pipe28['fg_4'] != "0") {
                                                                                                                        echo $row_select_pipe28['fg_4'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe28['fg_5'] != "" && $row_select_pipe28['fg_5'] != null && $row_select_pipe28['fg_5'] != "0") {
                                                                                                                        echo $row_select_pipe28['fg_5'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag28 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>%age of elongation= (f<sub>1</sub>-0<sub>1</sub> )x100/0<sub>1</sub></td>
                            <?php
                            $select_tilesy29 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select29 = mysqli_query($conn, $select_tilesy29);
                            $coming_row = mysqli_num_rows($result_tiles_select29);

                            while ($row_select_pipe29 = mysqli_fetch_array($result_tiles_select29)) {
                                $flag29++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe29['elo_1'] != "" && $row_select_pipe29['elo_1'] != null && $row_select_pipe29['elo_1'] != "0") {
                                                                                                                        echo $row_select_pipe29['elo_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe29['elo_2'] != "" && $row_select_pipe29['elo_2'] != null && $row_select_pipe29['elo_2'] != "0") {
                                                                                                                        echo $row_select_pipe29['elo_2'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe29['elo_3'] != "" && $row_select_pipe29['elo_3'] != null && $row_select_pipe29['elo_3'] != "0") {
                                                                                                                        echo $row_select_pipe29['elo_3'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe29['elo_4'] != "" && $row_select_pipe29['elo_4'] != null && $row_select_pipe29['elo_4'] != "0") {
                                                                                                                        echo $row_select_pipe29['elo_4'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe29['elo_5'] != "" && $row_select_pipe29['elo_5'] != null && $row_select_pipe29['elo_5'] != "0") {
                                                                                                                        echo $row_select_pipe29['elo_5'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag29 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Bend test......</td>
                            <?php
                            $select_tilesy31 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select31 = mysqli_query($conn, $select_tilesy31);
                            $coming_row = mysqli_num_rows($result_tiles_select31);

                            while ($row_select_pipe31 = mysqli_fetch_array($result_tiles_select31)) {
                                $flag31++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe31['bend_1'] != "" && $row_select_pipe31['bend_1'] != null && $row_select_pipe31['bend_1'] != "0") {
                                                                                                                        echo $row_select_pipe31['bend_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe31['bend_2'] != "" && $row_select_pipe31['bend_2'] != null && $row_select_pipe31['bend_2'] != "0") {
                                                                                                                        echo $row_select_pipe31['bend_2'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe31['bend_3'] != "" && $row_select_pipe31['bend_3'] != null && $row_select_pipe31['bend_3'] != "0") {
                                                                                                                        echo $row_select_pipe31['bend_3'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe31['bend_4'] != "" && $row_select_pipe31['bend_4'] != null && $row_select_pipe31['bend_4'] != "0") {
                                                                                                                        echo $row_select_pipe31['bend_4'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe31['bend_5'] != "" && $row_select_pipe31['bend_5'] != null && $row_select_pipe31['bend_5'] != "0") {
                                                                                                                        echo $row_select_pipe31['bend_5'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag31 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>
                        <tr style="">
                            <td style="border-top:1px solid;width:5%;padding-bottom:2px;padding-top:2px; text-align:center;  "><?php echo $cnt++; ?></td>
                            <td style="border-top:1px solid;border-left:1px solid;width:50%;text-align:center; " colspan=3>Re-bend test......</td>
                            <?php
                            $select_tilesy32 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
                            $result_tiles_select32 = mysqli_query($conn, $select_tilesy32);
                            $coming_row = mysqli_num_rows($result_tiles_select32);

                            while ($row_select_pipe32 = mysqli_fetch_array($result_tiles_select32)) {
                                $flag32++;
                            ?>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe32['rebend_1'] != "" && $row_select_pipe32['rebend_1'] != null && $row_select_pipe32['rebend_1'] != "0") {
                                                                                                                        echo $row_select_pipe32['rebend_1'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe32['rebend_2'] != "" && $row_select_pipe32['rebend_2'] != null && $row_select_pipe32['rebend_2'] != "0") {
                                                                                                                        echo $row_select_pipe32['rebend_2'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe32['rebend_3'] != "" && $row_select_pipe32['rebend_3'] != null && $row_select_pipe32['rebend_3'] != "0") {
                                                                                                                        echo $row_select_pipe32['rebend_3'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe32['rebend_4'] != "" && $row_select_pipe32['rebend_4'] != null && $row_select_pipe32['rebend_4'] != "0") {
                                                                                                                        echo $row_select_pipe32['rebend_4'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                                <td style="border-top:1px solid;border-left:1px solid;width:9%;text-align:center; "><?php if ($row_select_pipe32['rebend_5'] != "" && $row_select_pipe32['rebend_5'] != null && $row_select_pipe32['rebend_5'] != "0") {
                                                                                                                        echo $row_select_pipe32['rebend_5'];
                                                                                                                    } else {
                                                                                                                        echo "-";
                                                                                                                    } ?></td>
                            <?php
                                if ($flag32 == 5) {
                                    break;
                                }
                            }

                            ?>
                        </tr>


                    </table>

                </td>
            </tr>


            <tr>
                <td style="text-align:center;font-size:18px; ">

                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:18px;font-family: Cambria;">

                        <tr style="">

                            <td style="width:80%;padding-bottom:15px;padding-top:2px;padding-left:60px;  ">&nbsp;&nbsp;Tested By :-</td>
                            <td style="width:20%;text-align:left; ">Checked By :-</td>
                        </tr>

                    </table><br>

                </td>
            </tr>

            <tr>
                <td style="text-align:right;font-size:11px; ">

                    <table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

                        <tr style="">

                            <td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page:1/1</td>
                        </tr>

                    </table>

                </td>
            </tr> -->


            <div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


            </div>
        <!-- </table> -->
    </page>
    <?php

    /*if($flag==5)
				{
					$flag=0;
					$down=$up;
					$up +=5;*/
    ?>



    <!--<div class="pagebreak"> </div>-->
    <?php /*}*/


    /*}*/

    ?>

</body>

</html>


<script type="text/javascript">

</script>
