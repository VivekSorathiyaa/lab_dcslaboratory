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
    $select_vtiles_query = "select * from glazed_tiles WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		 <table align="center" width="90%" class="test" height="8%" style="border: 1px solid black;padding:8px 4px;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;padding:8px 4px;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;padding:8px 4px;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;padding:8px 4px;">
					<center><b>FMT-OBS-10H , 10F</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;padding:8px 4px;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
        <br>
        <table align="center" width="90%" class="test1" height="10%">

				<tbody>
					<tr style="border: 1px solid black;">
						<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp; <?php echo $detail_sample;?></b></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
						<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no . "_01" ?></b></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Job No : </td>
						<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $job_no; ?></b>&nbsp;</td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of Receipt of Sample </td>
						<td style="border-left:1px solid;text-align:left;">&nbsp;  <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?> &nbsp;</td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Testing Start Date :</b></td>
						<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Testing Complete Date:</b></td>
						<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
					</tr>
				</tbody>
			</table>
        <p style="margin-left:40px;font-weight:bold;">1. DIMENTIONS: (IS 13630 P-1)</p>
		<?php $cnt=1;?>
        <table align="center" height="25%" width="90%" class="test" style="border: 1px solid black;margin-top:-1px;">
            <tr>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;">Sr No</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;">Length</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;">Width</td>
                <td style="border: 1px solid black;font-weight:bold;text-align:center;">Thickness</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len1'] != "" && $row_select_pipe['len1'] != "0" && $row_select_pipe['len1'] != null) {echo $row_select_pipe['len1'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid1'] != "" && $row_select_pipe['wid1'] != "0" && $row_select_pipe['wid1'] != null) {echo $row_select_pipe['wid1'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk1'] != "" && $row_select_pipe['thk1'] != "0" && $row_select_pipe['thk1'] != null) {echo $row_select_pipe['thk1'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len2'] != "" && $row_select_pipe['len2'] != "0" && $row_select_pipe['len2'] != null) {echo $row_select_pipe['len2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid2'] != "" && $row_select_pipe['wid2'] != "0" && $row_select_pipe['wid2'] != null) {echo $row_select_pipe['wid2'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk2'] != "" && $row_select_pipe['thk2'] != "0" && $row_select_pipe['thk2'] != null) {echo $row_select_pipe['thk2'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                 <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len3'] != "" && $row_select_pipe['len3'] != "0" && $row_select_pipe['len3'] != null) {echo $row_select_pipe['len3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid3'] != "" && $row_select_pipe['wid3'] != "0" && $row_select_pipe['wid3'] != null) {echo $row_select_pipe['wid3'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk3'] != "" && $row_select_pipe['thk3'] != "0" && $row_select_pipe['thk3'] != null) {echo $row_select_pipe['thk3'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len4'] != "" && $row_select_pipe['len4'] != "0" && $row_select_pipe['len4'] != null) {echo $row_select_pipe['len4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid4'] != "" && $row_select_pipe['wid4'] != "0" && $row_select_pipe['wid4'] != null) {echo $row_select_pipe['wid4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk4'] != "" && $row_select_pipe['thk4'] != "0" && $row_select_pipe['thk4'] != null) {echo $row_select_pipe['thk4'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len5'] != "" && $row_select_pipe['len5'] != "0" && $row_select_pipe['len5'] != null) {echo $row_select_pipe['len5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid5'] != "" && $row_select_pipe['wid5'] != "0" && $row_select_pipe['wid5'] != null) {echo $row_select_pipe['wid5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk5'] != "" && $row_select_pipe['thk5'] != "0" && $row_select_pipe['thk5'] != null) {echo $row_select_pipe['thk5'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len6'] != "" && $row_select_pipe['len6'] != "0" && $row_select_pipe['len6'] != null) {echo $row_select_pipe['len6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid6'] != "" && $row_select_pipe['wid6'] != "0" && $row_select_pipe['wid6'] != null) {echo $row_select_pipe['wid6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk6'] != "" && $row_select_pipe['thk6'] != "0" && $row_select_pipe['thk6'] != null) {echo $row_select_pipe['thk6'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len7'] != "" && $row_select_pipe['len7'] != "0" && $row_select_pipe['len7'] != null) {echo $row_select_pipe['len7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid7'] != "" && $row_select_pipe['wid7'] != "0" && $row_select_pipe['wid7'] != null) {echo $row_select_pipe['wid7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk7'] != "" && $row_select_pipe['thk7'] != "0" && $row_select_pipe['thk7'] != null) {echo $row_select_pipe['thk7'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len8'] != "" && $row_select_pipe['len8'] != "0" && $row_select_pipe['len8'] != null) {echo $row_select_pipe['len8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid8'] != "" && $row_select_pipe['wid8'] != "0" && $row_select_pipe['wid8'] != null) {echo $row_select_pipe['wid8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk8'] != "" && $row_select_pipe['thk8'] != "0" && $row_select_pipe['thk8'] != null) {echo $row_select_pipe['thk8'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len9'] != "" && $row_select_pipe['len9'] != "0" && $row_select_pipe['len9'] != null) {echo $row_select_pipe['len9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid9'] != "" && $row_select_pipe['wid9'] != "0" && $row_select_pipe['wid9'] != null) {echo $row_select_pipe['wid9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk9'] != "" && $row_select_pipe['thk9'] != "0" && $row_select_pipe['thk9'] != null) {echo $row_select_pipe['thk9'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="border: 1px solid black;text-align:center;width:10%;"><?php echo $cnt++;?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['len10'] != "" && $row_select_pipe['len10'] != "0" && $row_select_pipe['len10'] != null) {echo $row_select_pipe['len10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wid10'] != "" && $row_select_pipe['wid10'] != "0" && $row_select_pipe['wid10'] != null) {echo $row_select_pipe['wid10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['thk10'] != "" && $row_select_pipe['thk10'] != "0" && $row_select_pipe['thk10'] != null) {echo $row_select_pipe['thk10'];} else {echo "-";} ?></td>
            </tr>
			<tr>
                <td style="font-weight:bold;border: 1px solid black;text-align:center;width:10%;">Average</td>
                <td style="font-weight:bold;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avglen'] != "" && $row_select_pipe['avglen'] != "0" && $row_select_pipe['avglen'] != null) {echo $row_select_pipe['avglen'];} else {echo "-";} ?></td>
                <td style="font-weight:bold;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avgwid'] != "" && $row_select_pipe['avgwid'] != "0" && $row_select_pipe['avgwid'] != null) {echo $row_select_pipe['avgwid'];} else {echo "-";} ?></td>
                <td style="font-weight:bold;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avgthk'] != "" && $row_select_pipe['avgthk'] != "0" && $row_select_pipe['avgthk'] != null) {echo $row_select_pipe['avgthk'];} else {echo "-";} ?></td>
            </tr>
			
        </table>
        <p style="margin-left:40px;font-weight:bold;">2. WATER ABSORPTION: (IS 13630 P-2)</p>
        <table align="center" height="25%;" width="90%" class="test" style="border: 1px solid black;margin-top:-1px;">
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
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) {
                                                                            echo $row_select_pipe['wtr_1'];
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
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) {
                                                                            echo $row_select_pipe['wtr_2'];
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
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) {
                                                                            echo $row_select_pipe['wtr_3'];
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">4</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_4'] != "" && $row_select_pipe['wtr_a_4'] != "0" && $row_select_pipe['wtr_a_4'] != null) {echo $row_select_pipe['wtr_a_4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_4'] != "" && $row_select_pipe['wtr_b_4'] != "0" && $row_select_pipe['wtr_b_4'] != null) {echo $row_select_pipe['wtr_b_4'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_4'] != "" && $row_select_pipe['wtr_4'] != "0" && $row_select_pipe['wtr_4'] != null) {echo $row_select_pipe['wtr_4'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">5</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_5'] != "" && $row_select_pipe['wtr_a_5'] != "0" && $row_select_pipe['wtr_a_5'] != null) {echo $row_select_pipe['wtr_a_5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_5'] != "" && $row_select_pipe['wtr_b_5'] != "0" && $row_select_pipe['wtr_b_5'] != null) {echo $row_select_pipe['wtr_b_5'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_5'] != "" && $row_select_pipe['wtr_5'] != "0" && $row_select_pipe['wtr_5'] != null) {echo $row_select_pipe['wtr_5'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">6</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_6'] != "" && $row_select_pipe['wtr_a_6'] != "0" && $row_select_pipe['wtr_a_6'] != null) {echo $row_select_pipe['wtr_a_6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_6'] != "" && $row_select_pipe['wtr_b_6'] != "0" && $row_select_pipe['wtr_b_6'] != null) {echo $row_select_pipe['wtr_b_6'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_6'] != "" && $row_select_pipe['wtr_6'] != "0" && $row_select_pipe['wtr_6'] != null) {echo $row_select_pipe['wtr_6'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">7</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_7'] != "" && $row_select_pipe['wtr_a_7'] != "0" && $row_select_pipe['wtr_a_7'] != null) {echo $row_select_pipe['wtr_a_7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_7'] != "" && $row_select_pipe['wtr_b_7'] != "0" && $row_select_pipe['wtr_b_7'] != null) {echo $row_select_pipe['wtr_b_7'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_7'] != "" && $row_select_pipe['wtr_7'] != "0" && $row_select_pipe['wtr_7'] != null) {echo $row_select_pipe['wtr_7'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">8</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_8'] != "" && $row_select_pipe['wtr_a_8'] != "0" && $row_select_pipe['wtr_a_8'] != null) {echo $row_select_pipe['wtr_a_8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_8'] != "" && $row_select_pipe['wtr_b_8'] != "0" && $row_select_pipe['wtr_b_8'] != null) {echo $row_select_pipe['wtr_b_8'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_8'] != "" && $row_select_pipe['wtr_8'] != "0" && $row_select_pipe['wtr_8'] != null) {echo $row_select_pipe['wtr_8'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">9</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_9'] != "" && $row_select_pipe['wtr_a_9'] != "0" && $row_select_pipe['wtr_a_9'] != null) {echo $row_select_pipe['wtr_a_9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_9'] != "" && $row_select_pipe['wtr_b_9'] != "0" && $row_select_pipe['wtr_b_9'] != null) {echo $row_select_pipe['wtr_b_9'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_9'] != "" && $row_select_pipe['wtr_9'] != "0" && $row_select_pipe['wtr_9'] != null) {echo $row_select_pipe['wtr_9'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;">10</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_a_10'] != "" && $row_select_pipe['wtr_a_10'] != "0" && $row_select_pipe['wtr_a_10'] != null) {echo $row_select_pipe['wtr_a_10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_b_10'] != "" && $row_select_pipe['wtr_b_10'] != "0" && $row_select_pipe['wtr_b_10'] != null) {echo $row_select_pipe['wtr_b_10'];} else {echo "-";} ?></td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['wtr_10'] != "" && $row_select_pipe['wtr_10'] != "0" && $row_select_pipe['wtr_10'] != null) {echo $row_select_pipe['wtr_10'];} else {echo "-";} ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:center;"></td>
                <td style="border: 1px solid black;text-align:right;">Average &nbsp; &nbsp;</td>
                <td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_wtr_1'] != "" && $row_select_pipe['avg_wtr_1'] != "0" && $row_select_pipe['avg_wtr_1'] != null) {echo $row_select_pipe['avg_wtr_1'];} else {echo "-";} ?></td>
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