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
		width: 29.7cm;
		height: 21cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 10px;
		font-family : Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family : Calibri;

	}

	.tdclass1 {

		
		font-family : Calibri;
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
	$select_tiles_query = "select * from `vit_tiles` WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$rec_sample_date = $row_select['sample_rec_date'];
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
		$brand = $row_select4['brand'];
		$speci = $row_select4['tiles_specification'];
		$tiles_specification = $row_select4['tiles_specification'];
		//$pvc_kg= $row_select4['pvc_kg'];

	}
	?>


	<page size="A4">
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

       <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;">
		<tr>
			<td style="text-transform: uppercase;font-weight: bold;text-align: center;font-size: 21px;padding: 2px 0;"><u>TEST REPORT</u></td>
		</tr>
	  </table>
	<br>
	<br>
	  <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;">
		<tr>
			<td style="text-transform: uppercase;font-weight: bold;text-align: right;font-size: 16px;padding: 2px 0;">QSF-1002&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
	  </table>
	  <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border: 1px solid;">
		<tr>
			<td style="font-size:15px;padding:2px;text-align: left;border-right:1px solid;width:40%;border-bottom:1px solid black;" rowspan="8">&nbsp;&nbsp;<b>AGENCY / NAME & ADDRESS</b><br>&nbsp;&nbsp;<?php echo $clientname;?> <br> &nbsp;&nbsp;<?php echo $client_address;?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
		<?php if(strlen($_GET['ulr'])>10){?>
			<td  style="width:25%;font-weight:bold;border-bottom:1px solid black;" ><b>&nbsp;&nbsp;ULR no.</b></td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($_GET['ulr'] != "" && $_GET['ulr'] != null && $_GET['ulr'] != "0") { echo $_GET['ulr']; } else {echo "-";}?></td>
			<?php }else{?>
			<?php }?>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;DATE OF ISSUE</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($issue_date != "" && $issue_date != null && $issue_date != "0") { echo date('d/m/Y', strtotime($issue_date)); } else {echo "-";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;DATE OF LETTER</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($row_select['date'] != "" && $row_select['date'] != null && $row_select['date'] != "0") { echo date('d/m/Y', strtotime($row_select["date"])); } else {echo "---NIL---";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;DATE OF RECIPT.</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($rec_sample_date != "" && $rec_sample_date != null && $rec_sample_date != "0") { echo date('d/m/Y', strtotime($rec_sample_date)); } else {echo "-";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;REFERENCE NO.</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($r_name != "" && $r_name != null && $r_name != "0") { echo $r_name; } else {echo "---NIL---";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;REPORT NO.</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($report_no != "" && $report_no != null && $report_no != "0") { echo $report_no; } else {echo "-";}?></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="font-weight:bold;border-bottom:1px solid black;">&nbsp;&nbsp;UNIQUE IDENTITY OF SAMPLE</td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;TL-123/2136/01/2025</td>
		</tr>
		<?php if ($agency_name != "" && $agency_name != null && $agency_name != "0") {?>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;border-right:1px solid black;" rowspan="2">&nbsp;&nbsp;<b>Client Name :-</b>&nbsp;<?php  if ($agency_name != "" && $agency_name != null && $agency_name != "0") { echo $agency_name; } else {echo "---NIL---";}?></td>
			<td  style="border-bottom:1px solid black;">&nbsp;&nbsp;<b>SOURCE OF SAMPLE*</b></td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($source != "" && $source != null && $source != "0") { echo $source; } else {echo "-";}?></td></td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;">&nbsp;&nbsp;<b>MODE OF RECEIPT OF SAMPLE</b></td>
			<td  style="border-bottom:1px solid black;border-left:1px solid black;">&nbsp;&nbsp;<?php  if ($source != "" && $source != null && $source != "0") { echo $source; } else {echo "-";}?></td></td>
		</tr>
		<?php }?>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;" colspan="3">&nbsp;&nbsp;<b>Test Method :-</b>&nbsp;IS:13630 (Part-2), (Part-13)</td>
		</tr>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;" colspan="3">&nbsp;&nbsp;<b>Name  of Test :-</b>&nbsp; Bulk density, Water absorption and Scratch Hardness Test</td>
		</tr>
		<?php if ($name_of_work != "" && $name_of_work != null && $name_of_work != "0") {?>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;" colspan="3">&nbsp;&nbsp;<b>Subject / N.O.W :-</b>&nbsp;<?php echo $name_of_work;?></td>
		</tr>
		<?php }?>
		<?php if ($mt_name != "" && $mt_name != null && $mt_name != "0") {?>
		<tr style="font-size:12px;text-align:left;">
			<td  style="border-bottom:1px solid black;" colspan="3">&nbsp;&nbsp;<b>DESCRIPTION OF SAMPLE :-</b>&nbsp;<?php echo $mt_name;?> </td>
		</tr>
		<?php }?>
		<?php if ($con_sample != "" && $con_sample != null && $con_sample != "0") {?>
		<tr style="font-size:12px;text-align:left;">
			<td  style="" colspan="3">&nbsp;&nbsp;<b>CONDITION OF SAMPLE :-</b>&nbsp;<?php echo $con_sample;?></td>
		</tr>
		<?php }?>
	  </table>
	  <br>
		
				<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid; border-left:1px solid black;">
				
					<tr style="font-size:14px;text-align:center;">
						<td  style="width:8%;border-top:1px solid;font-weight:bold;">S. No.</td>
						<td  style="width:40%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Test<br>(with unit of measurement)</td>
						<td  style="width:10%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Test Result</td>
						<td  style="width:12%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Test Method</td>
						<td  style="width:20%;border-top:1px solid;border-left: 1px solid black;font-weight:bold;">Requirement as per<br> IS 15622:2017(Code for Pressed Tiles with water<br>absorption E <0.08%)<br>(Group B Ia)</td>
					</tr>
					<?php $cnt = 1; ?>
					<?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != null && $row_select_pipe['wtr_1'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;" rowspan="8"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;Water Absorption(%) by weight</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;font-weight:bold;text-align:left;">&nbsp;&nbsp;Individual</td>
						<td  style="border-left: 1px solid black;"></td>
						<td  style="border-left: 1px solid black;"></td>
						<td  style="border-left: 1px solid black;"></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;(i)</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['wtr_1'];?></td>
						<td  style="border-left: 1px solid black;"></td>
						<td  style="border-left: 1px solid black;"></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;(ii)</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['wtr_2'];?></td>
						<td  style="border-left: 1px solid black;">IS 13630 </td>
						<td  style="border-left: 1px solid black;">Avg, <=0.08,</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;(iii)</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['wtr_3'];?></td>
						<td  style="border-left: 1px solid black;">(Part-2)</td>
						<td  style="border-left: 1px solid black;">Individual Max. 0.1</td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;(iv)</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['wtr_4'];?></td>
						<td  style="border-left: 1px solid black;"></td>
						<td  style="border-left: 1px solid black;"></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;(v)</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['wtr_5'];?></td>
						<td  style="border-left: 1px solid black;"></td>
						<td  style="border-left: 1px solid black;"></td>
					</tr>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-left: 1px solid black;font-weight:bold;text-align:left;">&nbsp;&nbsp;Avg.</td>
						<td  style="border-left: 1px solid black;"><?php echo $row_select_pipe['avg_wtr_1'];?></td>
						<td  style="border-left: 1px solid black;"></td>
						<td  style="border-left: 1px solid black;"></td>
						<td  style="border-left: 1px solid black;"></td>
					</tr>
					<?php } if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != null && $row_select_pipe['pass_sample_1'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;Bulk Density (g/cc)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">IS 13630 (Part-2)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Min 2.20</td>
					</tr>
					<?php } if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != null && $row_select_pipe['pass_sample_1'] != "0") {?>
					<tr style="font-size:12px;text-align:center;">
						<td  style="border-top:1px solid;"><?php echo $cnt++; ?>.</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;text-align:left;">&nbsp;&nbsp;Scratch Hardness (Mohs' scale)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">IS 13630 (Part-13)</td>
						<td  style="border-top:1px solid;border-left: 1px solid black;">Min. 5</td>
					</tr>
					<?php }?>
				</table>
			
		<!-- footer design -->
		<br>
		<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;margin-left:60px;">
        <tr>
            <td><b>D.O.S:-</b> <?php echo date('d/m/Y', strtotime($start_date));?></td>
        </tr>
        <tr>
            <td><b>D.O.C:-</b> <?php echo date('d/m/Y', strtotime($end_date));?></td>
        </tr>
		</table>
		<br>
		<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;padding:0;margin-left:60px;">
		<tr>
            <td style="font-size:12px;font-family : Calibri;"><b>Remarks:-</b></td>
        </tr>
		 </table>
		 <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;padding:0;">
		<ul>
            <li style="font-size:12px;font-family : Calibri;margin-left:60px;">&nbsp;*Indicates information provided by the customer</li>
            <li style="font-size:12px;font-family : Calibri;margin-left:60px;">&nbsp;<b>Note: -</b> The test Results given above pertains to the sample as received.</li>
        </ul>
		</table>
		<table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;">
		<tr>
            <td align="center"><b>*** End Of Report *** </b> </td>
        </tr>
		<tr>
            <td align="center"><b>(Jai Hind)</b><br><br></td>
        </tr>
    </table>
    <br><br>
    <table align="center"  width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;padding:0;margin-left:auto; margin-right:auto;">
        <tr>
            <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REWEWED BY</td>
            <td style="text-align:right;">AUTHORISED BY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Er.YOGINDER CHAUHAN</td>
            <td style="text-align:right;">Er.VISHAL ACHARYA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(SENIOUR ANALYST)</td>
            <td style="text-align:right;">(TECHNICAL MANAGER )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table>
	</page>
	
	<div class="page-break"></div>

</body>

</html>

<script type="text/javascript">


</script>