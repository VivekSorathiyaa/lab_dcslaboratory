<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {}

	.pagebreak {
		page-break-before: always;
	}

	@media print {
		@page
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 11px;
		font-family: arial;
	}

	.test {
		border-collapse: collapse;
		font-size: 11px;
		font-family: arial;
	}

	.tdclass1 {

		font-size: 11px;
		font-family: arial;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$select_tiles_query = "select * from span_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `report_no`='$report_no' AND `jobisdeleted`='0'";
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

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
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

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
	}

	?>

	<br>
	<br>
	<br>
	<br>
	<br>


	<page size="A4">
		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td colspan="12" style="font-size:13px">
					<center><b>Span Infrastructure Material Testing &amp; Consultancy Services Limited </b></center>
				</td>
			</tr>
			<tr>
				<td colspan="8"><b>DETERMINATION OF CEMENT CHEMICAL ANALYSIS</b></td>
				<td colspan="4"><b>[AS PER IS: 4032 - 1985 (RA-2014)]</b></td>
			</tr>
		</table>
		<br>
		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td colspan="6">Type of Cement :&nbsp;&nbsp;<?php echo $row_select_pipe['type_of_cement']; ?></td>
				<td colspan="6">Manu, Week and Month :&nbsp;&nbsp;<?php echo $row_select_pipe['week_number']; ?></td>
			</tr>
			<tr>
				<td colspan="6">Grade of Cement :&nbsp;&nbsp;<?php echo $row_select_pipe['cement_grade']; ?></td>
				<td colspan="6">Sample Receive Date :&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
			</tr>
			<tr>
				<td colspan="6">Identification Mark :&nbsp;&nbsp;<?php echo $row_select_pipe['type_of_cement']; ?></td>
				<td colspan="6">Laboratory ID No. :&nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
			</tr>
			<tr>
				<td colspan="6">Report No :&nbsp;&nbsp;<?php echo $row_select_pipe['report_no']; ?></td>
				<td colspan="6">Condition of sample during receipt :&nbsp;&nbsp;Sealed Ok</td>
			</tr>
		</table>
		<br>
		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td>
					<center>Sr. No.</center>
				</td>
				<td colspan="2">Parameters</td>
			</tr>

			<tr>
				<td>
					<center>1</center>
				</td>
				<td colspan="2">Silica</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_s_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_s_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_s_w']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Empty Crucible (W1) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_s_w1']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Crucible after ignition (W2) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_s_w2']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Crucible after HF (W3) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_s_w3']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula Before HF : <br> Silica (%) = (W2-W1)*100/Weight of Sample</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_s_hf']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (R1) %</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_s_r1']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula After HF : <br> Silica (%) = (W2-W3)*100/Weight of Sample</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_s_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (R2) %</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_s_r2']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Pure Silica (%) = R2+ R(Silica from R<sub>2</sub>O<sub>3</sub></td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_s_r']; ?></td>
			</tr>


			<tr>
				<td>
					<center>2</center>
				</td>
				<td colspan="2">R<sub>2</sub>O<sub>3</sub> (Combined Ferric Oxide & Alumina)</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_ro_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_ro_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ro_w']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Empty Crucible (W1) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ro_w1']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Crucible after ignition (W2) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ro_w2']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Crucible after HF (W3) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ro_w3']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula Before HF : <br> Silica (%) = (W2-W1)*100/Weight of Sample</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ro_hf']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (R1) %</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ro_r1']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula After HF : <br> Silica (%) = (W3-W1)*100/Weight of Sample</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ro_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (R2) %</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ro_r2']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">R (%) = R1 - R2</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ro_r']; ?></td>
			</tr>

		</table>

		<br>
		<table align="center" width="90%" class="test" border="1px" height="5%">
			<tr>
				<td colspan="6">Tested by :</td>
				<td colspan="6">Checked by :</td>
			</tr>
		</table>
		<div class="pagebreak"></div>
		<br>
		<br>
		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td>
					<center>Sr. No.</center>
				</td>
				<td colspan="2">Parameters</td>
			</tr>

			<tr>
				<td>
					<center>3</center>
				</td>
				<td colspan="2">CaO (Calcium Oxide)</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_co_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_co_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_co_w']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Empty Crucible (W1) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_co_w1']; ?></td>
			</tr>

			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula : <br> CaO (%) = (W2-W1)*100/Weight of Sample</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_co_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_co_r']; ?></td>
			</tr>

			<tr>
				<td>
					<center>4</center>
				</td>
				<td colspan="2">MgO (Magnesium Oxide)</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_mg_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_mg_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_mg_w']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Empty Crucible (W1) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_mg_w1']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Crucible after ignition (W2) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_mg_w2']; ?></td>
			</tr>

			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula : <br> MgO (%) = (W2-W1)*36.22/Weight of Sample</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_mg_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_mg_r']; ?></td>
			</tr>

			<tr>
				<td>
					<center>5</center>
				</td>
				<td colspan="2">Insoluble Residue</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_ir_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_ir_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ir_w']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Empty Crucible (W1) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ir_w1']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Crucible after ignition (W2) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ir_w2']; ?></td>
			</tr>

			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula : <br> IR (%) = (W2-W1)*100/Weight of Sample</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ir_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ir_r']; ?></td>
			</tr>

			<tr>
				<td>
					<center>6</center>
				</td>
				<td colspan="2">Sulphuric Anhydride</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_sa_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_sa_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_sa_w']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Empty Crucible (W1) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_sa_w1']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Crucible after ignition (W2) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_sa_w2']; ?></td>
			</tr>

			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula : <br> IR (%) = (W2-W1)*34.3/Weight of Sample</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_sa_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_sa_r']; ?></td>
			</tr>

			<tr>
				<td>
					<center>7</center>
				</td>
				<td colspan="2">Loss Ignition</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_lo_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_lo_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_lo_w']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Empty Crucible (W1) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_lo_w1']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Crucible + Sample (W2) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_lo_w2']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Crucible After ignition (W3) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_lo_w3']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula : <br> LOI (%) = (W2-W3)*100/Weight of Sample</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_lo_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_lo_r']; ?></td>
			</tr>

			<tr>
				<td>
					<center>8</center>
				</td>
				<td colspan="2">Ferric Oxide</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_fo_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_fo_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_fo_w']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Volume of EDTA Used in Titration (V) ml</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_fo_v']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula : <br> Fe<sub>2</sub>O<sub>3</sub> (%) = 0.7985*V/W</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_fo_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_fo_r']; ?></td>
			</tr>

		</table>
		<br>
		<table align="center" width="90%" class="test" border="1px" height="5%">
			<tr>
				<td colspan="6">Tested by :</td>
				<td colspan="6">Checked by :</td>
			</tr>
		</table>
		<div class="pagebreak"></div>
		<br>
		<br>
		<br>

		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td>
					<center>Sr. No.</center>
				</td>
				<td colspan="2">Parameters</td>
			</tr>

			<tr>
				<td>
					<center>9</center>
				</td>
				<td colspan="2">Aluminum Oxide</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_ao_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_ao_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ao_w']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Titrant (V) ml</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ao_v']; ?></td>
			</tr>

			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula : <br> Al<sub>2</sub>O<sub>3</sub> (%) = 0.5098*V/W <br> [V=V1-V2-(V3*E)] <br> V1 = Total EDTA Volume V2 = EDTA Used for Iron <br> V3 = Volume Of Bismuth Nitrate <br> E = Equivalence of 1 ml Bismuth Nitrate Solution (0.08) OR Al<sub>2</sub>O<sub>3</sub> (%) = R<sub>2</sub>O<sub>3</sub> (%) - Fe<sub>2</sub>O<sub>3</sub> (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ao_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ao_r']; ?></td>
			</tr>

			<tr>
				<td>
					<center>10</center>
				</td>
				<td colspan="2">Chloride</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_ch_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_ch_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ch_w']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Titrant Used For Sample (X) ml</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ch_x']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Tirant Used For Blank (Y) ml</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ch_y']; ?></td>
			</tr>

			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula : <br> Chloride (%) = (Z*0.03546*N*100)/Wt. Of Sample <br> Z = [10-(10-y)-X]; <br> N = Normality Of AgNO<sub>3<sub></td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ch_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ch_r']; ?></td>
			</tr>

			<tr>
				<td>
					<center>11</center>
				</td>
				<td colspan="2">Na<sub>2</sub>O (sodium Oxide)</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_na_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_na_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_na_w']; ?></td>
			</tr>

			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula : <br> Na<sub>2</sub>O (%) = <br> ppm from graph * 100 * 100/Wt. of Sample * 10<sup>6</sup></td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_na_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_na_r']; ?></td>
			</tr>

			<tr>
				<td>
					<center>12</center>
				</td>
				<td colspan="2">K<sub>2</sub>O (Potassium Oxide)</td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test Start Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_ko_d1'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Test End Date</td>
				<td width="30%" style="text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['ch_ko_d2'])); ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Weight of Sample (W) gm</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ko_w']; ?></td>
			</tr>

			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Formula : <br> K<sub>2</sub>O (%) =<br> ppm from graph * 100 * 100/Wt. of sample * 10<sup>6</sup></td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ko_per']; ?></td>
			</tr>
			<tr>
				<td width="10%">
					<center></center>
				</td>
				<td width="60%">Result (%)</td>
				<td width="30%" style="text-align:center;"><?php echo $row_select_pipe['ch_ko_r']; ?></td>
			</tr>



		</table>
		<br>
		<table align="center" width="90%" class="test" border="1px" height="5%">
			<tr>
				<td colspan="6">Tested by :</td>
				<td colspan="6">Checked by :</td>
			</tr>
		</table>








	</page>
	<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$("#print_button").on("click", function() {
		$('#print_button').hide();
		window.print();
	});
</script>