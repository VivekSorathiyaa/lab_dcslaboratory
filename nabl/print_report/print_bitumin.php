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
	$select_tiles_query = "select * from bitumin_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		 $bitumin_grade = $row_select4['bitumin_grade'];
		$lot_no = $row_select4['lot_no'];
		$bitumin_make = $row_select4['bitumin_make'];
		$tank_no = $row_select4['tanker_no'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}
		$cnt=1;	
	?>



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
 <table  style="width: 95%;font-family: 'Calibri';font-size:12px;" align="center">
        <tr>
            <td style="font-size:16px;text-align: right;">QSF-1002</td>
        </tr>
    </table>
	<table align="center" width="95%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
		<tr>
			<td>
				<table  style="width: 100%;font-family: 'Calibri';font-size:12px;border: 1px solid;border-bottom:0px solid;text-align: left;" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;width: 25%;">ULR No.</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;width: 25%;"><?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;font-weight: bold;width: 25%;">Test Report No.</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;width: 25%;"><?php echo $report_no; ?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Report Issue</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($issue_date));?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Date of Sample Received</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Sample Name</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">BITUMEN <?php echo $bitumin_grade;?></td>
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
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">5 Kg</td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Source of Sample *</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php if ($bitumin_make != "" && $bitumin_make != null && $bitumin_make != "0") { echo $bitumin_make; } else {echo "-";}?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Name of Client</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo $clientname;?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Age of Specimen</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;">-</td>
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
				
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom: 1px solid;border-left: 1px solid;border-right: 1px solid;">
			
			<tr style="font-size:14px;text-align:center;">
						<td  style="width:5%;border-top:1px solid;font-weight:bold;vertical-align:text-top;">S. No.</td>
						<td  style="width:35%;border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;font-weight:bold;padding-bottom:6px;">Test Parameters</td>
						<td  style="width:10%;border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;font-weight:bold;">Units</td>
						<td  style="width:15%;border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;font-weight:bold;">Test result</td>
						<td  style="width:15%;border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;font-weight:bold;">Test Method</td>
						<td  style="width:20%;border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;font-weight:bold;">Specification as Per <br>IS: 73 :2013</td>
					</tr>
					<?php $cnt = 1; ?>
					<?php if ($row_select_pipe['avg_duc'] != "" && $row_select_pipe['avg_duc'] != null && $row_select_pipe['avg_duc'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;vertical-align:text-top;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;text-align:left;vertical-align:text-top;">&nbsp;&nbsp;Ductility at 250c</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">cm</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;"><?php echo $row_select_pipe['avg_duc'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">IS 1208 </td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">Min.</td>
					</tr>
					<?php } if ($row_select_pipe['avg_sp'] != "" && $row_select_pipe['avg_sp'] != null && $row_select_pipe['avg_sp'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;vertical-align:text-top;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;text-align:left;">&nbsp;&nbsp;Fire Point  (Cleveland open cup)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">&degc</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;"><?php echo $row_select_pipe['avg_sp'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">IS 1448 (P-69) </td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">-</td>
					</tr>
					<?php } if ($row_select_pipe['sp_1'] != "" && $row_select_pipe['sp_1'] != null && $row_select_pipe['sp_1'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;vertical-align:text-top;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;text-align:left;">&nbsp;&nbsp;Flash Point  (Cleveland open cup)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">&degc</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;"><?php echo $row_select_pipe['sp_1'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">IS 1448 (P-69) </td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">Min. 220</td>
					</tr>
					<?php } if ($row_select_pipe['avg_pen'] != "" && $row_select_pipe['avg_pen'] != null && $row_select_pipe['avg_pen'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;vertical-align:text-top;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;text-align:left;">&nbsp;&nbsp;Penetration at 25&degc, 100g, 5 sec, 0.1mm</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">mm</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;"><?php echo $row_select_pipe['avg_pen'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">IS 1203 </td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">Min. 80</td>
					</tr>
					<?php } if ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != null && $row_select_pipe['avg_sof'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;vertical-align:text-top;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;text-align:left;">&nbsp;&nbsp;Softening point , &degc</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">&degc</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;"><?php echo $row_select_pipe['avg_sof'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">IS 1203 </td>
						<td  style="border-top:1px solid;border-left: 1px solid black;vertical-align:text-top;">Min. 80</td>
					</tr>
					<?php }?>
	</table>
	 <table  style="width: 100%;font-family:Calibri;font-size:15px;border: 1px solid;border-top:0px solid;" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td style="padding: 0 10px;" colspan="5"><i><b> Remarks: - </b>The Sample Confirms to IS: 383 :2016 w.r.t above test only </i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>&#8226;</b>&nbsp;&nbsp;&nbsp;&nbsp;* Indicates information provided by the customer.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>&#8226;</b>&nbsp;&nbsp;&nbsp;&nbsp;The test results given above pertain to the sample as received.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;text-align: center;border-top: 1px solid;" colspan="6"><i><b>***End of Report***<br>(Jai Hind)</b></i></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;height: 100px;text-align: center;vertical-align: bottom; width:50%;" colspan="3"><i><b>Reviewed By<br><u><?php echo $v_name; ?> </u></b></i></td>
                <td style="border-top: 1px solid;height: 100px;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Authorized By<br></b><u><?php echo $a_name; ?> </u></i></td>
            </tr>
        </table>
			</td>
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