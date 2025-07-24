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
        width: 21cm;
        height: 29.7cm;
    }
</style>
<style>
    .tdclass {
        border: 1px solid black;
        
        font-family: Arial;

    }

    .test {
        border-collapse: collapse;
        
        font-family: Arial;
    }

    .tdclass1 {

        
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
            <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-top:80px;">
                <tr>
                    <td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
                </tr>
                <tr>
                    <td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Mechanical Properties of Concrete Paver Block</b></td>
                </tr>

            <tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding-bottom:6px;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical Properties of Metals</td>
						<td style="width:21%;padding-bottom: 4px;text-align:left;">
						<?php echo "ULR No.  " . $_GET['ulr']; ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:0%;padding-bottom: 4px;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"> <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;">Report Ref No</td>
						<td style="width:6%;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;"><?php echo $r_name; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-collapse: inherit;padding-top:14px;padding-bottom:14px;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
						if ($name_of_work != "") {
						?>
							<tr>
							<td style="width:12%;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;">Agg No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;"> <?php echo $agreement_no; ?></td>
							</tr>
						
						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-collapse: inherit;padding:4px 0;margin-bottom:6px;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Date of Sample Received</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">Concrete Paver Block</td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
                        <td style="width:12%;padding-bottom: 4px;">Concrete Grade</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;">&raquo;</td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $paver_grade; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Shap of Block</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $paver_shape;?></td>									
						</tr>

						<tr>
						    <td style="width:12%;">Correction Factor</td>
							<td style="width:6%;text-align: center;">&raquo;</td>
							<td style="width:40%;font-size: 10px;text-align:left;"><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != null && $row_select_pipe['avg_corr'] != "0") { echo number_format($row_select_pipe['avg_corr'], 0);} else { echo "-";} ?></td>
							<td style="width:21%;text-align:right;">Avg. Thickness of Block (cm)</td>
							<td style="width:6%;text-align: center;"> &raquo; </td>
							<td style="width:40%;"><?php echo $paver_thickness;?></td>
						</tr>
					</table>
				</td>
			</tr>

                <!-- <tr>
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
                </tr> -->
            </table>
          </td>
        </tr>

            
            <!-- <tr>
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
            </tr> -->


        <?php $cnt = 1; ?>
            <tr>
                <td style="text-align:left;font-size:11px; ">
                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:10px;">

                    <tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" rowspan=2> Sr.<br>No.</td>
							<td rowspan=2 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sample Mark</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Weight</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Density</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Area</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" >Failure Load</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Comp. Strength</td>
							<td  rowspan=2 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Corrected Comp. Strength (N/mm<sup>2</sup>)</td>
							<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Avg. Corrected Comp. Strength</td>
							<td  rowspan=2 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Water Absorption (%)</td>
                            <td  rowspan=2 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Avg. Water Absorption (%)</td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;padding:5px 4px;">(gm)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;padding:5px 4px;">(gm/cc)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;padding:5px 4px;">(cm<sup>2</sup>)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;padding:5px 4px;">(KN)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;padding:5px 4px;">(N/mm<sup>2</sup>)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;padding:5px 4px;">(N/mm<sup>2</sup>)</td>
						</tr>
                        <tr style="">
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">PB-1</td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['grade_1']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo ($row_select_pipe['grade_1'] / 1000); ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != null && $row_select_pipe['area_1'] != "0") { echo number_format($row_select_pipe['area_1'], 0);} else { echo "-";} ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['fload1']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_1']; ?>
                            </td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_1']; ?>
                            </td>
                            <td rowspan=3 style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != "0" && $row_select_pipe['corr_1'] != null) { echo (($row_select_pipe['corr_1'] + $row_select_pipe['corr_2'] + $row_select_pipe['corr_3']) / 3); } else {  echo " - ";} ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) { echo $row_select_pipe['wtr_1']; } else {  echo " - ";} ?>
                            </td>
                            <td rowspan=3 style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null) { echo $row_select_pipe['avg_wtr'];} else {echo " <br>";} ?>
                            </td>
                        </tr>
						<tr style="">
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">PB-1</td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['grade_2']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo ($row_select_pipe['grade_2'] / 1000); ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != null && $row_select_pipe['area_2'] != "0") { echo number_format($row_select_pipe['area_2'], 0);} else { echo "-";} ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['fload2']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_2']; ?>
                            </td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_2']; ?>
                            </td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) { echo $row_select_pipe['wtr_2']; } else {  echo " - ";} ?>
                            </td>
                        </tr>
						<tr style="">
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">PB-1</td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['grade_3']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo ($row_select_pipe['grade_3'] / 1000); ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != null && $row_select_pipe['area_3'] != "0") { echo number_format($row_select_pipe['area_3'], 0);} else { echo "-";} ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['fload3']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['com_3']; ?>
                            </td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['corr_3']; ?>
                            </td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) { echo $row_select_pipe['wtr_3']; } else {  echo " - ";} ?>
                            </td>
                        </tr>
                        <tr style="">
                            <td colspan=6 style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">Method of Test</td>
                            <td  colspan=3 style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">I.S. 15658 : 2021 ANNEX D</td>
                            <td  style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">I.S. 15658 : 2021 ANNEX C</td>
                            <td  style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">-
                            </td>
                        </tr>

                        <tr style="">
                            <td colspan=4 style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">Correction Factors for Thickness and Arris/Chamfer of Paver Block for Calculation of Coup Strength</td>
                            <td colspan=7 style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;border-right:0px;border-bottom:0px;">
												<table style="width:100%;border-collapse: collapse;">
														<tr>
															<td style="font-size:10px;text-align:left;border-bottom:0px solid black;border-right:1px solid black;padding:5px 4px;">for plain block</td>
                                                            <td rowspan=2 style="font-size:10px;text-align:center;border-right:1px solid black;border-bottom:0px solid black;padding:5px 4px;">50 <br> mm</td>
                                                            <td style="font-size:10px;text-align:center;border-bottom:1px solid black;padding:5px 4px;border-right:1px solid black;"><em>0.96</em></td>
                                                            <td rowspan=2 style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;">60 <br> mm</td>
                                                            <td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;"><em>1.60</em></td>
                                                            <td rowspan=2 style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;">80 <br> mm</td>
                                                            <td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;"><em>1.12</em></td>
                                                            <td rowspan=2 style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;">100 <br> mm</td>
                                                            <td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;"><em>1.18</em></td>
                                                            <td rowspan=2 style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;">120 <br> mm</td>
                                                            <td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;"><em>1.28</em></td>
														</tr>
														<tr style="">
															<td style="font-size:10px;text-align:left;border-top:1px solid black;padding:5px 4px;border-right:1px solid black;">for chamfered block</td>
                                                            <td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;"><em>1.03</em></td>
                                                            <td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;border-top:1px solid black;"><em>1.06</em></td>
                                                            <td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;border-top:1px solid black;"><em>1.18</em></td>
                                                            <td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-right:1px solid black;border-top:1px solid black;"><em>1.24</em></td>
                                                            <td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;border-top:1px solid black;"><em>1.34</em></td>
														</tr>
												</table>
                            </td>
                            
                        </tr>

                        <tr style="">
                            <td colspan=11 style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"> For other thickness of paver blocks between 50mm and 120mm, liner extrapolation of concrete factor shall be made.</td>
                        </tr>

                        <!-- <tr style="">

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
                        </tr> -->

                    </table>
                </td>

                <!-- <td style="text-align:left;font-size:11px; ">
                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;margin-top:20px;">

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

                </td> -->
            </tr>


                <tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-family: Cambria;" class="test">
                            <tr>
                            <td style="font-size:10px;text-align:left;font-weight:bold;padding:7px 0">I.S. Requirement as per IS 15658-2021</td>
                            </tr>
                        </table>
                    </td>
                </tr>


            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family: Cambria;font-size:10px;">    
										<tr>
											<td rowspan=2 style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Test Description</td>
                                            <td colspan=6 style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Grade of    Paver Block
                                            </td>
										</tr>

                                        <tr>
                                           <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-25</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-30</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-35</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-40</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-45</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-50</b></td>                                                                                                                   </tr>
										

											<tr>
												<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">Minimum Average Compressive Strength required at <br> 28 days as per Table-3, N/mm<sup>2</sup> <br> S= f <sub>ck</sub> + 0.825 x S.D.</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">28.3</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">34.1</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">39.1</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">44.1</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">49.1</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">54.1</td>
											</tr>

                                            <tr>
												<td colspan=1 style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">Water Absorption</td>
												<td colspan=6 style="text-align:center;border:1px solid black;border-right:1px solid black;">Average shall not be more than 6% and individual samples should be restricted to 7%</td>
											</tr>

                                            <tr>
												<td colspan=7 style="font-size:10px;text-align:left;border:1px solid black;border-left:0px solid black;border-right:0px solid black;padding:5px 0;">S.D - Standard Deviation considered as per IS 456-2000</td>
											</tr>
								</table>

							</td>
            </tr>
			<br>
			<br>

            <?php $cnt = 1; ?>
             <tr>
                <td style="text-align:left;font-size:11px; ">
                    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;">

                        <tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" rowspan=4> Sr.<br>No.</td>
							<td rowspan=4 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sample Mark</td>
							<td rowspan=3 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Flextural Strength</td>
							<td rowspan=3 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Avg. Flextural Strength</td>
							<td rowspan=3 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Split Tensile Strength</td>
							<td rowspan=3 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" >Avg. Split Tensile Strength</td>
							<td colspan=4 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;border-right:1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Abrasion Resistance, mm<sup>3</sup>/5000mm<sup>2</sup></td>
						</tr>

                        <tr style="">
							<td colspan=2 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Dry Condition</td>
							<td colspan=2 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;border-right:1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Wet Condition</td>
						</tr>
                        <tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">individual</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Average</td>
                            <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">individual</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;border-right:1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Average</td>
						</tr>


                        <tr style="">
							<td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:5px 4px;">(N/mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:5px 4px;">(N/mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:5px 4px;">(N/mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:5px 4px;">(N/mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:5px 4px;">mm<sup>3</sup>/5000 mm<sup>2</sup></td>
							<td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:5px 4px;" >mm<sup>3</sup>/5000 mm<sup>2</sup></td>
							<td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;text-align:center;padding:5px 4px; ">mm<sup>3</sup>/5000 mm<sup>2</sup></td>
                            <td style="border-top:1px solid;font-size:9px;border-left: 1px solid black;border-right:1px solid black;text-align:center;padding:5px 4px; ">mm<sup>3</sup>/5000 mm<sup>2</sup></td>
						</tr>

                        <tr style="">
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;border-right:0px;padding:2px 0;border-bottom: 0;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['sm9']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['fle1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;" rowspan=3><?php echo $row_select_pipe['avg_fle']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['sten1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;" rowspan=3><?php echo $row_select_pipe['avg_tensile']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['v1']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;" rowspan=3><?php echo $row_select_pipe['avgv']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['v4']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;border-right:1px solid black;padding:2px 0;" rowspan=3><?php echo $row_select_pipe['avgv2']; ?></td>
						</tr>


                        <tr style="">
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;border-right:0px;padding:2px 0;border-bottom: 0;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['sm10']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['fle1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['sten1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['v2']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;border-bottom: 0;"><?php echo $row_select_pipe['v5']; ?></td>
						</tr>


                        <tr style="">
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;border-right:0px;padding:2px 0;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;"><?php echo $row_select_pipe['sm11']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;"><?php echo $row_select_pipe['fle1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;"><?php echo $row_select_pipe['sten1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;"><?php echo $row_select_pipe['v3']; ?></td>
                            <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;border-right:0px;"><?php echo $row_select_pipe['v6']; ?></td>
						</tr>

                        <!-- <tr style="">

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
                        </tr> -->
                    </table>

                </td>
            </tr> 
			<div class="pagebreak"></div>
			<br>
			<br>
			<br>

            <tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-family: Cambria;" class="test">
                            <tr>
                            <td style="font-size:10px;text-align:left;font-weight:bold;padding:7px 0">I.S. Requirements as per IS 15658-2021</td>
                            </tr>
                        </table>
                    </td>
            </tr>
           
            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family: Cambria;font-size:10px;">    
										<tr>
											<td rowspan=2 colspan=2 style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Test Description</td>
                                            <td colspan=6 style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Grade of Paver Block
                                            </td>
										</tr>

                                        <tr>
                                           <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-30</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-35</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-40</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-45</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-50</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>M-55</b></td>                                                                                                                   </tr>

											<tr>
												<td rowspan=2 style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">Tensile Spliting  Strength, N/mm<sup>2</sup></td>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">individual Min.</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">2.4</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">2.8</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.0</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.0</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.0</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.0</td>
											</tr>

                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">Average Min.</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">2.6</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">3.0</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.6</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.6</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.6</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.6</td>
											</tr>


                                            <tr>
												<td rowspan=2 style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">Flexural Strength <br> N/mm<sup>2</sup></td>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">individual Min.</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">3.0</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">3.5</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">4.0</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">4.5</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">5.0</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">5.5</td>
											</tr>

                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">Average Min.</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">3.3</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">3.9</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">4.4</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">5.0</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">5.5</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">6.1</td>
											</tr>

                                            <tr>
                                                <td rowspan=4 style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">Abration Resistance, <br> mm<sup>2</sup>/5000 mm<sup>2</sup></td>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">Dry condition, individual, Max.</td>
												<td colspan=6 style="text-align:center;border:1px solid black;border-right:0px solid black;">20000</td>
											</tr>

                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">Dry condition, Average, Max.</td>
												<td colspan=6 style="text-align:center;border:1px solid black;border-right:0px solid black;">18000</td>
											</tr>
                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">Wet condition, individual, Max.</td>
												<td colspan=6 style="text-align:center;border:1px solid black;border-right:0px solid black;">22000</td>
											</tr>
                                            <tr>
                                                <td style="font-size:10px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">Wet condition, Average, Max.</td>
												<td colspan=6 style="text-align:center;border:1px solid black;border-right:0px solid black;">20000</td>
											</tr>

                                            <tr>
												<td colspan=8 style="font-size:10px;text-align:left;border:1px solid black;border-left:0px solid black;border-right:0px solid black;padding:5px 0;">S.D - Standard Deviation considered as per IS 456-2000</td>
											</tr>
								</table>

							</td>
            </tr>


            <tr>
                <td style="text-align:center;font-size:11px; ">
					<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
							<tr>
								<td style="width:60%;text-align:center;font-weight:bold;padding:3px 0;">
										** End of Report ** 
								</td>																		
							</tr>
					</table>
				</td>	
            </tr>

            <tr>
                <td style="text-align:center;font-size:11px;">
					<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
						<tr>
							<td><b>Note :-</b></td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;width:50%;padding:3px 0;">1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
							<td style="text-align:center;width:15%;font-style:italic;"><b>Reviewed & Authorized By</b></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;">2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
							<td style="text-align:center;font-style:italic;"><b>(D.H.Shah/M.D.Shah)</b></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
							<td style="text-align:center;font-style:italic;"><b>Director/TM</b></td>
						</tr>
					</table>
				</td>
            </tr>
        </table>



        <table width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
			<tr>
				<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;">
					Doc ID : FMT-TST-28/ Page 1/1
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