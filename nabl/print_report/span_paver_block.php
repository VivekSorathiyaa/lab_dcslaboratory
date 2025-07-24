<?php
include("../connection.php");
include("function_calling.php");
session_start();

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
@media print
{    
    #header_hide_show
    {
        display: none !important;
    }
}
/* Container for your content */
.container {
    position: relative;
    z-index: 1;
}

/* Watermark fixed at center of screen */
.watermark {
   position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
    background-image: url('../img/dcs_logo_2.jpg');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    opacity: 1.9;
    pointer-events: none;
    z-index: -1;
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
	$select_tiles_query = "select * from span_paver_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	//$page_cont = round_up($no_of_rows / 5);
	//$row_select_pipe = mysqli_fetch_array($result_tiles_select);

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
	
	$authorize_by = $row_select['reported_by_authorize'];
	$verify_by = $row_select['reported_by_review'];

$user_name = "select * from `multi_login` WHERE `id`='$authorize_by'";
	$result_for_select = mysqli_query($conn, $user_name);
	$user = mysqli_fetch_array($result_for_select);
	
	$a_name = $user['staff_fullname'];
	
	$verify_name = "select * from `multi_login` WHERE `id`='$verify_by'";
	$result_for_verify_select = mysqli_query($conn, $verify_name);
	$user_1 = mysqli_fetch_array($result_for_verify_select);	

	$v_name = $user_1['staff_fullname'];
	
	
	if ($cons == 0) {
		$con_sample = "Acceptable";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
	}


	if ($row_select["agency_name"] != "") {
		$agency_name = $row_select['agency_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `isdeleted`='0'";
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
			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
	 $paver_shape = $row_select4['paver_shape'];
        $paver_age = $row_select4['paver_age'];
        $paver_color = $row_select4['paver_color'];
        $paver_thickNess = $row_select4['paver_thickNess'];
        $paver_grade = $row_select4['paver_grade'];
        $material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
        $material_condition = $row_select4['material_condition'];
	}
		$cnt=1;	
	

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
   // if (($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != null && $row_select_pipe['avg_corr'] != "0") || ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0")) { ?>
<page size="A4">
	<div id="header">
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
 <?php if($_SESSION['isadmin']!=4){ ?>
<?php if($_SESSION['isadmin']==2){ ?>
<div class="watermark"></div>
<div class="container">
<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()">
<?php } ?>
     <table  style="width: 95%;font-family:Calibri;font-size:12px;" align="center">
        <tr>
            <td style="font-size:17px;text-align: right;">QSF-1002</td>
        </tr>
    </table>
    <table  style="width: 95%;font-family:Calibri;font-size:12px;border: 1px solid;text-align: left;" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;width:25%">ULR No.</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;width:25%"><?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;width:25%">Test Report No.</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;width:25%"><?php echo $report_no; ?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Report Issue</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($issue_date));?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Sample Received</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sample Name</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Paver Block</td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Unique Identity of Sample</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo $lab_no;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Letter</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php  if ($row_select['date'] != "" && $row_select['date'] != null && $row_select['date'] != "0") { echo date('d/m/Y', strtotime($row_select["date"])); } else {echo "---NIL---";}?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Letter No.</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php  if ($r_name != "" && $r_name != null && $r_name != "0") { echo $r_name; } else {echo "---NIL---";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Test Start</td>	
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($start_date));?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Test Complete</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($end_date));?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sampling Quantity</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo $row_select_pipe['qty_1']; ?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Source of Sample *</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php if ($mark != "" && $mark != null && $mark != "0") { echo $mark; } else {echo "-";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Name of Client</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo $clientname;?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">X-Sectional Area</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Agency/Name & Address </td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;" colspan="3"><?php echo $clientname;?>,<?php echo $client_address;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;;">Name of Work</td>
            <td style="padding: 2px 5px;;border-bottom: 1px solid;" colspan="3"><?php echo $name_of_work;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;padding: 2px 5px;">Discipline/Group</td>
            <td style="padding: 2px 5px;;" colspan="3">Mechanical- Buildings Materials</td>
		</tr>
	  </table>
 <?php } ?>
 
      <table  style="width: 95%;font-family: 'Calibri';font-size:14px;" cellspacing="0" cellpadding="0" align="center">
				
					<tr style="text-align:center; font-weight: bold;">
    <td style="width:12%; font-weight:bold; border-left: 1px solid black; border-top: 1px solid black; height: 50px;">S.N</td>
    <td style="border-left: 1px solid black; border-top: 1px solid black;">Test Parameters</td>
    <td style="border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black;" rowspan="2">Units</td>
    <td style="border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black;" rowspan="2">Test result</td>
    <td style="border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black;" rowspan="2">Test Method</td>
    <td style="border-left: 1px solid black; border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;" rowspan="2">
        specification as Per<br> <input type="text" style="border:0px solid;width:80%;text-align:center;background-color: transparent;" value="IS 15658 : 2021">
    </td>
</tr>
                    <tr style="text-align:left;font-weight: bold;">
						<td style="width:12%;font-weight:bold;border-left: 1px solid;text-align: center; border-top: 1px solid;border-bottom: 1px solid;">1. </td>
						<td style="border-left: 1px solid;padding: 0 10px;border-top: 1px solid;border-bottom: 1px solid;">Compressive Strength</td>
                    </tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;">A</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;">(i)</td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;"  rowspan="10">N/mm<sup>2</sup></td>
						<td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['com_1'];?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;" rowspan="10">IS 15658 :2021</td>
						<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;text-align: center;" rowspan="10">Individual <br>fck – 3 <br> Average <br>fck + 0.825 × established <br> standard <br> deviation(rounded off to <br> nearest 0.5 MPa) <br> or <br>fck + 3, whichever is <br> greater</td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;">B</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;">(ii)</td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['com_2'];?></td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;">C</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;">(iii)</td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['com_3'];?></td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;">D</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;">(iv)</td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['com_4'];?></td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;">E</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;">(v)</td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['com_5'];?></td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;">F</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;">(vi)</td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['com_6'];?></td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;">G</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;">(vii)</td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['com_7'];?></td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;">H</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;">(viii)</td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['com_8'];?></td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;font-weight: bold;">I</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;font-weight: bold;">Average</td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php 
						$com_values = [
							$row_select_pipe['com_1'],
							$row_select_pipe['com_2'],
							$row_select_pipe['com_3'],
							$row_select_pipe['com_4'],
							$row_select_pipe['com_5'],
							$row_select_pipe['com_6'],
							$row_select_pipe['com_7'],
							$row_select_pipe['com_8']
						];
						
						$average = array_sum($com_values) / count($com_values);
						echo number_format($average, 2);
						?>
						</td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-bottom: 1px solid;font-weight: bold;">J</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-bottom: 1px solid;font-weight: bold;">Corrected Value</td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['avg_corr'];?></td>
					</tr>
                    <tr>
						<td style="width:12%;font-weight:bold;border-left: 1px solid;text-align: center;">2.</td>
						<td style="border-left: 1px solid;padding: 0 10px;font-weight: bold;">Dimension</td>
						<td style="border-left: 1px solid;text-align: center;border-bottom: 1px solid;"  rowspan="4">mm</td>
                        <td style="border-left: 1px solid;"></td>
                        <td style="border-left: 1px solid;text-align: center;border-bottom: 1px solid;" rowspan="4">IS 15658 :2021</td>
                        <td style="border-left: 1px solid;text-align: center;border-right: 1px solid;">ThickNess <br><100 mm>100 mm</td>
                    </tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-top: 1px solid;">A</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-top: 1px solid;">Length</td>
                        <td style="border-left: 1px solid;border-top: 1px solid;text-align: center;"><?php echo $row_select_pipe['length_avg'];?></td>
						<td style="border-left: 1px solid;text-align: center;border-top: 1px solid;border-right: 1px solid;">±2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;±3</td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-top: 1px solid;">B</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-top: 1px solid;">Width</td>
                        <td style="border-left: 1px solid;border-top: 1px solid;text-align: center;"><?php echo $row_select_pipe['width_avg'];?></td>
						<td style="border-left: 1px solid;text-align: center;border-top: 1px solid;border-right: 1px solid;">±2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;±3</td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-top: 1px solid;border-bottom: 1px solid;">C</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-top: 1px solid;border-bottom: 1px solid;">ThickNess</td>
                        <td style="border-left: 1px solid;border-top: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['height_avg'];?></td>
						<td style="border-left: 1px solid;text-align: center;border-top: 1px solid;border-bottom: 1px solid;border-right: 1px solid;">±3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;±4</td>
					</tr>
                    <tr>
						<td style="width:12%;font-weight:bold;border-left: 1px solid;text-align: center;">3.</td>
						<td style="border-left: 1px solid;padding: 0 10px;font-weight: bold;">Water Absorption</td>
						<td style="border-left: 1px solid;text-align: center;"  rowspan="5">%</td>
                        <td style="border-left: 1px solid;text-align: center;"><?php echo $row_select_pipe[''];?></td>
                        <td style="border-left: 1px solid;text-align: center;" rowspan="5">IS 15658 :2021</td>
                        <td style="border-left: 1px solid;text-align: center;border-right: 1px solid;" rowspan="5">Individual&nbsp;&nbsp;&nbsp;&nbsp;Max. 7<br>Average&nbsp;&nbsp;&nbsp;&nbsp;Max 6</td>
                    </tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-top: 1px solid;">A</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-top: 1px solid;">(i)</td>
                        <td style="border-left: 1px solid;border-top: 1px solid;text-align: center;"><?php echo $row_select_pipe['wtr_1'];?></td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-top: 1px solid;">B</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-top: 1px solid;">(ii)</td>
                        <td style="border-left: 1px solid;border-top: 1px solid;text-align: center;"><?php echo $row_select_pipe['wtr_2'];?></td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-top: 1px solid;">C</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-top: 1px solid;">(iii)</td>
                        <td style="border-left: 1px solid;border-top: 1px solid;text-align: center;"><?php echo $row_select_pipe['wtr_3'];?></td>
					</tr>
                    <tr>
						<td style="text-align: center;border-left: 1px solid;border-top: 1px solid;">D</td>
                        <td style="padding: 0 10px;border-left: 1px solid;border-top: 1px solid;">Average</td>
                        <td style="border-left: 1px solid;border-top: 1px solid;text-align: center;"><?php echo $row_select_pipe['avg_wtr'];?></td>
					</tr>
		</table>
        <table  style="width: 95%;font-family: 'Calibri';font-size:15px;border: 1px solid;" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td style="padding: 0 10px;" colspan="5"><i><b> Remarks: - </b>The Sample Confirms to IS 15658 : 2021 w.r.t above test only </i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>.</b>&nbsp;&nbsp;&nbsp;&nbsp;* Indicates information provided by the customer.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>.</b>&nbsp;&nbsp;&nbsp;&nbsp;The test results given above pertain to the sample as received.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;text-align: center;border-top: 1px solid;" colspan="6"><b>***End of Report***<br>(Jai Hind)</b></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;height: 100px;text-align: center;vertical-align: bottom;width:50%;" colspan="3"><i><b>Reviewed By<br><u><?php echo $v_name; ?> </u></b></i></td>
                <td style="border-top: 1px solid;height: 100px;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Authorized By<br></b><u><?php echo $a_name; ?> </u></i></td>
            </tr>
        </table>
		<div id="footer" style="vertical-align: bottom;bottom:0px;position:relative;width:100%; margin: 0 auto; border-collapse: collapse; margin-top: 10px;">


		</div>
		
		</div>

		
	</page>
	

</body>

</html>
<script src="jquery.min.js"></script>
<script type="text/javascript">
	function header() {
    const headerCheckbox = document.querySelector('#header_hide_show');
    const headerElement = document.getElementById('header');
    const footerElement = document.getElementById('footer');

    if (headerCheckbox && headerCheckbox.checked) {
        // Show letterhead header and footer
        headerElement.innerHTML = '<img src="../img/dcs_letter_header.png" width="100%">';
        footerElement.innerHTML = '<img src="../img/dcs_letter_footer.png" width="100%">';
    } else {
        // Add spacing and clear footer
        headerElement.innerHTML = '<br><br><br><br><br><br><br><br><br>';
        footerElement.innerHTML = '';
    }
}
</script>