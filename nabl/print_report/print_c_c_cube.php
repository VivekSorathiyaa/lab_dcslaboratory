<?php
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(0); ?>
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
    .header_hide_show
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
	$select_tiles_query = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	$page_cont = round_up($no_of_rows / 3);

	$ans = mysqli_fetch_array($result_tiles_select);


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

	$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
		$cc_grade = $row_select4['cc_grade'];
		$cc_set_of_cube = $row_select4['cc_set_of_cube'];
		$cc_no_of_cube = $row_select4['cc_no_of_cube'];
		$cc_identification_mark = $row_select4['cc_identification_mark'];
		$day_remark = $row_select4['day_remark'];
		$cc_day = $row_select4['cc_day'];
		$casting_date = $row_select4['casting_date'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}

	$flag = 0;
	 $a = 1;
	 $down = 0;
	 $up = 3;
	 $page_count = 0;
	 $page1 = 1;
	 for ($a = 1; $a <= $page_cont; $a++) {

	?>
<page size="A4">
<div id="header_<?php echo $a; ?>">
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
 <input type="checkbox" style="width:30px; height:30px" id="header_hide_show_<?php echo $a; ?>" class="header_hide_show" onclick="header(this)"><br>
 <?php }?>
       <table  style="width: 95%;font-family: 'Calibri';font-size:12px;" align="center">
        <tr>
            <td style="font-size: 16px;text-align: right;">QSF-1002</td>
        </tr>
    </table>
    <table  style="width: 95%;font-family: 'Calibri';font-size:12px;border: 1px solid;text-align: left;" cellspacing="0" cellpadding="0" align="center">
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
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">C.C.CUBE</td>
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
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">03 Nos<?php //echo $row_select_pipe['qty_1']; ?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Source of Sample *</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo $day_remark;?></td>
		</tr>
        <tr>
			<td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Name of Client</td>
            <td style="border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;"><?php echo $clientname;?></td>
            <td style="font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;padding: 2px 5px;">Age of Specimen*</td>
            <td style="border-bottom: 1px solid;padding: 2px 5px;"><?php echo $cc_day;?> Days</td>
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
      <table  style="width: 95%;border-top: 1px solid;font-family: 'Calibri';font-size:14px;text-align: center;" cellspacing="0" cellpadding="0" align="center">
				
					<tr style="text-align:center;font-weight: bold;">
						<td style="width:2%;font-weight:bold;border-left: 1px solid;border-bottom: 1px solid;">S.No</td>
                        <td style="width:14%;border-left: 1px solid;border-bottom: 1px solid;">D.O.C</td>
						<td style="width:14%;border-left: 1px solid;border-bottom: 1px solid;">D.O.T</td>
						<td style="width:14%;border-left: 1px solid;border-bottom: 1px solid;">Weight of Cube (Kg)</td>
						<td style="width:14%;border-left: 1px solid;border-bottom: 1px solid;">X-Area (mm<sup>2</sup>)</td>
						<td style="width:14%;border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;">Faliure of Load <br> (KN)</td>
                        <td style="width:14%;border-bottom: 1px solid;border-bottom: 1px solid;">Compressive Strength <br> (N/mm<sup>2</sup>)</td>
                        <td style="width:14%;border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;">Test Method</td>
					</tr>
					<?php $count = 1;
						$cnt = 1;
						$select_tilesy5 = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select15 = mysqli_query($conn, $select_tilesy5);
						$coming_row = mysqli_num_rows($result_tiles_select15);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select15)) {
							$flag++;
							$br++;
							$cntrw++;
						?>
                    <tr>
						<td style="font-weight:bold;border-left: 1px solid;border-bottom: 1px solid;"><b><?php echo $cnt++; ?>.</b></td>
                        <td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1']));?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1']));?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['mass_1'];?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['cross_1'];?></td>
						<td style="border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['load_1'];?></td>
                        <td style="border-bottom: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['comp_1'];?></td>
                        <td style="border-left: 1px solid;border-right: 1px solid;" rowspan="4">IS 516 <br>(Part-1/Sec-1):2021</td>
					</tr>
                    <tr>
						<td style="font-weight:bold;border-left: 1px solid;border-bottom: 1px solid;"><b><?php echo $cnt++; ?>.</b></td>
                        <td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1']));?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1']));?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['mass_2'];?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['cross_2'];?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['load_2'];?></td>
                        <td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['comp_2'];?></td>
					</tr>
                    <tr>
						<td style="font-weight:bold;border-left: 1px solid;border-bottom: 1px solid;"><b><?php echo $cnt++; ?>.</b></td>
                        <td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1']));?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1']));?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['mass_3'];?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['cross_3'];?></td>
						<td style="border-left: 1px solid;border-bottom: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['load_3'];?></td>
                        <td style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['comp_3'];?></td>
					</tr>
                    <tr>
						<td style="font-weight:bold;border-left: 1px solid;" colspan="6"><b>Average Compressive Strength (N/mm2)</b></td>
                        <td style="border-left: 1px solid;"><b><?php echo $row_select_pipe['avg_com_s_1'];?></b></td>
					</tr>
					<?php
						if ($flag == 3) {
							break;
						}
					}
					?>
             </table>
        <table  style="width: 95%;font-family: 'Calibri';font-size:15px;border: 1px solid;" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td style="padding: 0 10px;" colspan="5"><i><b> Remarks: - </b>The Sample Confirms to IS: 516 (Part-1/Sec-1):2021 above test only </i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>.</b>&nbsp;&nbsp;&nbsp;&nbsp;* Indicates information provided by the customer.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;" colspan="5"><i><b>.</b>&nbsp;&nbsp;&nbsp;&nbsp;The test results given above pertain to the sample as received.</i></td>
            </tr>
            <tr>
                <td style="padding: 0 50px;text-align: center;border-top: 1px solid;" colspan="6"><i><b>***End of Report***<br>(Jai Hind)</b></i></td>
            </tr>
            <tr>
               <td style="border-top: 1px solid;border-right: 1px solid;height: 100px;text-align: center;vertical-align: bottom;width: 50%;" colspan="3"><i><b>Reviewed By<br><u><?php echo $v_name; ?> </u></b></i></td>
                <td style="border-top: 1px solid;height: 100px;text-align: center;vertical-align: bottom;" colspan="3"><i><b>Authorized By<br></b><u><?php echo $a_name; ?> </u></i></td>
            </tr>
        </table>
		</div>
	</page>
	
	<div class="page-break"></div>
<div id="footer_<?php echo $a; ?>" style="vertical-align: bottom;bottom:2px;position:fixed;">
            </div>
</body>

</html>
<?php
			
			if($flag==3)
			{
					$flag=0;
					$down=$up;
					$up +=3;
					?>
					<div class="pagebreak"> </div>
			<?php }
			
			
			}
			
		?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

function header(checkbox) {
		var pageNum = checkbox.id.split('_').pop();
		
		if(checkbox.checked) {
			// Get all header and footer divs
			var headerDivs = document.querySelectorAll('[id^="header_"]');
			var footerDivs = document.querySelectorAll('[id^="footer_"]');
			
			// Update all header divs
			headerDivs.forEach(function(div) {
				div.innerHTML = '';
				div.insertAdjacentHTML("afterbegin", '<img src="../img/dcs_letter_header.png" width="100%">');
			});
			
			// Update all footer divs
			footerDivs.forEach(function(div) {
				div.innerHTML = '';
				div.insertAdjacentHTML("afterbegin", '<img src="../img/dcs_letter_footer.png" width="100%">');
			});
			
			// Check all other header checkboxes
			document.querySelectorAll('.header_hide_show').forEach(function(cb) {
				if(cb.id !== checkbox.id) {
					cb.checked = true;
				}
			});
		} else {
			// Get all header and footer divs
			var headerDivs = document.querySelectorAll('[id^="header_"]');
			var footerDivs = document.querySelectorAll('[id^="footer_"]');
			
			// Clear all header divs
			headerDivs.forEach(function(div) {
				div.innerHTML = '';
				div.insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
			});
			
			// Clear all footer divs
			footerDivs.forEach(function(div) {
				div.innerHTML = '';
			});
			
			// Uncheck all other header checkboxes
			document.querySelectorAll('.header_hide_show').forEach(function(cb) {
				if(cb.id !== checkbox.id) {
					cb.checked = false;
				}
			});
		}
	}
</script>