<?php
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(1); ?>
<style>
    @page {
        margin: 0 40px;
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
        font-family : Calibri;

    }

    .test {
        border-collapse: collapse;
        font-size: 12px;
        font-family : Calibri;
    }

    .tdclass1 {

        font-size: 12px;
        font-family : Calibri;
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
			include_once 'sample_id.php';
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
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
    }



    ?>

    <!--<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()">-->
    <page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - SILICA FUME TEST</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
						<td style="width: 14%;padding: 0 2px;">&nbsp;Sample ID No :-</td>
						<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $sample_id; ?></td>
						<td style="text-align: left;border-left: 1px solid;">&nbsp;Report Date :-</td>
						<td style="padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
					</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Report No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;ULR No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $_GET['ulr']; ?></td>
					</tr>
					<!--STATIC AMENDMENT NO AND DATE-->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;--</td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Group :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Building Materials</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp; <?php echo date('d/m/Y', strtotime($row_select_pipe1["amend_date"])); ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Discipline :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Mechanical</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part -->
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width: 24.9%;">&nbsp;Customer Name & Address :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
					</tr>
					<?php
						}
						if ($agency_name != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agency Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
					</tr>
					<?php } 
					if ($row_select['tpi_name'] != "") {
						?>
							
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Consultants :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
					</tr>
					<?php
						 }
						if ($agreement_no != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agreement No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
					</tr>
					<?php
						}
						if ($name_of_work != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Project Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?></td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;">&nbsp;To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<!-- <tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php //echo $source; ?></td>
					</tr> -->
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>
        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;border:0px solid black; ">
            
            <tr>
                <!--OTHER START-->
                <td>
                    <table align="left" width="100%" class="test" style="height:Auto;width:100%;font-family : Calibri; border-left:2px solid; border-right:2px solid black; border-bottom:0px;">
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-top:0px solid black;width:7%;padding:7px 3px;"><b>Sr.<br>No.</b></td>
                            <td style="border:1px solid black;border-top:0px solid black;width:30%;padding:7px 3px;"><b>Test Parameter</b></td>
                            <td style="border:1px solid black;border-top:0px solid black;width:10%;padding:7px 3px;"><b>Units</b></td>
                            <td style="border:1px solid black;border-top:0px solid black;width:13%;padding:7px 3px;"><b>Test Method</b></td>
                            <td style="border:1px solid black;border-top:0px solid black;width:13%;padding:7px 3px;"><b>Test Result</b></td>
                            <td style="border:1px solid black;border-top:0px solid black;width:20%;padding:7px 3px;"><b>Requirement as per IS <br>15388 : 2003<BR></b></td>
                        </tr>

                        <?php
                        $cnt = 0;


                        if ($row_select_pipe1['avg_wet'] != "" && $row_select_pipe1['avg_wet'] != "0" && $row_select_pipe1['avg_wet'] != null) {
                            $cnt++;
                        ?>
                            <tr style="text-align:center;">
                                <td style="border:1px solid black;padding:7px 3px;"><b><?php echo $cnt; ?></b></td>
                                <td style="border:1px solid black; text-align:left;"><b>&nbsp; Wet sieving by 45 &micro; IS sieve</b></td>
                                <td style="border:1px solid black;">%</td>
                                <td style="border:1px solid black;">IS 1727:1967  </td>
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
                                <td style="border:1px solid black;padding:7px 3px;"><b><?php echo $cnt; ?></b></td>
                                <td style="border:1px solid black; text-align:left;"><b>&nbsp; Moisture Content</b></td>
                                <td style="border:1px solid black;">%</td>
                                <td style="border:1px solid black;">IS 3812 (Part 1):2013</td>
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
                                <td rowspan="3" style="border:1px solid black;padding:7px 3px;"><b><?php echo $cnt; ?></b></td>
                                <td style="border:1px solid black; text-align:left;padding:7px 3px;"><b>&nbsp; Compressive Strength at 7 Days, Min.</b></td>
                                <td style="border:1px solid black;">%</td>
                                <td rowspan="3" style="border:1px solid black;">IS 1727:1967 </td>
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

                                <td style="border:1px solid black; text-align:left;padding:7px 3px;"><b>&nbsp; Compressive Strength of Silica Mortar Cube</b></td>
                                <td style="border:1px solid black;">N/mm<sup>2</sup></td>

                                <td style="border:1px solid black;"><?php if ($row_select_pipe1['avg_fly'] != "" && $row_select_pipe1['avg_fly'] != "0" && $row_select_pipe1['avg_fly'] != null) {
                                                                        echo $row_select_pipe1['avg_fly'];
                                                                    } else {
                                                                        echo " <br>";
                                                                    } ?></td>
                                <td style="border:1px solid black;">-</td>
                            </tr>
                            <tr style="text-align:center;">
                                <td style="border:1px solid black; text-align:left;padding:7px 3px;"><b>&nbsp; Compressive Strength of Plain Cement mortar Cube</b></td>
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

            


            <tr style="font-size:11px;font-family : Calibri;">
			    <td style="text-align:center;font-size:11px; ">
					
				</td>																	
			</tr>


        </table>

        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;">
						<tr>
							<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;text-transform: uppercase;font-weight: bold;">Report Issue By:- GEO RESEARCH HOUSE, INDORE.</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr style="vertical-align: bottom;">
							<td style="padding: 1px 2px;height: 45px;">{Mr. Chitrath Purani}</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">Report Reviewed & Authorized by :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">1. The Samples have been Submitted to us by the Customer.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">2. The above given Results Refer only to the sample submitted by the customer for testing.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">3. All the information is Provided to us by the Customer and can affect the Result Validity.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">4. This Report shall not be Reproduced without Approval of the Laboratory.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">5. * As Informed by Client.</td>
						</tr>
						<tr>
							<td style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 1 of 1</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>


        <!--  <table align="center" width="92%" class="test" style="border:1px solid black;font-family : Calibri;margin-left:35px; ">
            <tr>
                <td width="60px"><b style="">&nbsp; NOTE:- </b> </td>
                <td>
                    <p style="align:justify">[1]Test result related to sample collected by supplier. [2]Results/Report is issued with specific understanding the TMTL will not in any case be involved in action following the interpretation of test results. [3]The Reports/Results are not supposed to be used for publicity. (4) This report can not be reproduced in full or part without written approval of Quality Manager/ Technical Manager.</p>
                </td>
            </tr>
        </table>-->
        <br>
        <br>
        <!--table align="center" width="95%" style="font-family : Calibri;margin-left:35px;">
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