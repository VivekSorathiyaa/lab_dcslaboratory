<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 25px;
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
		font-family: Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family: Calibri;

	}

	.tdclass1 {

		font-size: 11px;
		font-family: Calibri;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}

	.report-cell {
		font-size: 16px;
		/* or use 'large', '18px', etc. */
		padding: 5px 8px;
		font-family: Arial, sans-serif;
	}
</style>
<html>

<body>

	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from concrete_core WHERE `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);
	$amend_date = $row_select_pipe['amend_date'];


	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$branch_name = $row_select['branch_name'];
	$cons = $row_select['condition_of_sample_receved'];

	$tested_by = $row_select['tested_by'];
	$verify_by = $row_select['reported_by_review'];
	$user_name = "select * from `multi_login` WHERE `id`='$tested_by'";
	$result_for_select = mysqli_query($conn, $user_name);
	$user = mysqli_fetch_array($result_for_select);

	$u_name = $user['staff_fullname'];

	$verify_name = "select * from `multi_login` WHERE `id`='$verify_by'";
	$result_for_verify_select = mysqli_query($conn, $verify_name);
	$user_1 = mysqli_fetch_array($result_for_verify_select);

	$v_name = $user_1['staff_fullname'];

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

	$select_query2 = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `isdeleted`='0'";
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
		$source = $row_select4['agg_source'];
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	?>

	<br>
	<br>
	<br>
	<br>
	<br>
	<page size="A4">
		<table align="center"
			style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"
			cellspacing="0" cellpadding="2px">
			<tr>
				<td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img
						src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;">
				</td>

			</tr>
			<tr>
				<td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">
					NextGenLIMS Technologies</td>
			</tr>

			<tr>
				<td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">
					<b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
			</tr>
			<tr>
				<td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">
					District Kangra Himachal Pradesh (176081)</td>
			</tr>
			<tr>
				<td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">
					Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
			</tr>
			<tr>
				<td
					style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 20px;">
					Concrete Core</td>
				<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">
					ANALYSIS DATA SHEET </td>
				<td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;"> QSF-1001</td>
			</tr>
			<tr>
				<td class="report-cell" style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card
						No:&nbsp;</b><?php echo $_GET['job_no']; ?></td>
				<td class="report-cell" style="text-align: left;border-top: 1px solid;border-left: 1px solid;"
					colspan="4"><b>&nbsp;Test:&nbsp;</b>COMPRESSIVE STRENGTH</td>
			</tr>
			<tr>
				<td class="report-cell" style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample
						Description:&nbsp;</b><?php echo $row_select_pipe['s_des']; ?></td>
				<td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">
					<b>&nbsp;Method:&nbsp;</b>IS 15658
				</td>
			</tr>
			<tr>
				<td class="report-cell" style="text-align: left;border-top: 1px solid;" colspan="2">
					<b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date'])); ?></td>
				<td class="report-cell" style="text-align: left;border-top: 1px solid;border-left:1px solid;"
					colspan="2">
					<b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date'])); ?></td>
				<td class="report-cell" style="text-align: left;border-top: 1px solid;border-left: 1px solid;"
					colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date'])); ?>
				</td>
				<td class="report-cell" style="text-align: left;border-top: 1px solid;border-left:1px solid;"
					colspan="2"><b>&nbsp;Page No:&nbsp;</b>1</td>
			</tr>
			<tr>
				<td class="report-cell" style=" text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample
						Qty:&nbsp;</b><?php echo $row_select_pipe['qty_1']; ?></td>
				<td class="report-cell" style="text-align: left;border-top: 1px solid;border-left : 1px solid;"
					colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam']; ?></td>
				<td class="report-cell" style="text-align: left;border-top: 1px solid;border-left : 1px solid;"
					colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret']; ?></td>
			</tr>
		</table>
		<br>
		<table align="center" width="95%" cellpadding="0"
			style="font-size:11px;height:auto;font-family : Calibri;padding: 0;border-collapse: collapse;border-bottom:1px solid;">
			<tr style="">
				<td
					style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					SN.</td>
				<td
					style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					Location</td>
				<td
					style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					Dia (mm)</td>
				<td
					style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					Length (mm)</td>
				<td
					style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					X-Area (mm2)</td>
				<td
					style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					Length of core after<br>capping/grinding (mm)</td>
				<td
					style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					Max Load (KN)</td>
				<td
					style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					Measured Compressive <br>Strength of Core (N/mm2)</td>
				<td
					style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					CF for Dia 75±5 = 1.03 &lt;70 = 1.06</td>
				<td
					style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					CF F=0.11N+0.78</td>
				<td
					style="border-top:1px solid;border-right:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">
					Equivalent<br>Cube Strength = (CF x 1.25)</td>
			</tr>

			<?php
			$select_tilesy = "select * from concrete_core WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
			$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
			// $coming_row = mysqli_num_rows($result_tiles_select1);
			$cnt = 1;
			$flag = 1;
			$sunoco = 0;
			if (mysqli_num_rows($result_tiles_select1) > 0) {
				while ($row_select_pipe = mysqli_fetch_assoc($result_tiles_select1)) {
					$sunoco += floatval($row_select_pipe['eq_cube1']);
					?>
					<tr style="">
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">
							<?php echo $cnt++; ?></td>
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe['location1'] ?></td>
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe['dia1'] ?></td>
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe['height1'] ?></td>
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe['area1'] ?></td>
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe['hd_ratio1'] ?></td>
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe['load1'] ?></td>
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe['com1'] ?></td>
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe['dia_corr1'] ?></td>
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe['corr_com1'] ?></td>
						<td
							style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;border-right:1px solid;">
							<?php echo $row_select_pipe['eq_cube1'] ?></td>
					</tr>
					<?php

				}

				$average = ($cnt - 1) > 0 ? round($sunoco / ($cnt - 1), 2) : 0;

				?>
				<tr>
					<td colspan="10"
						style="font-size:11px;text-align:right;border:1px solid black;border-bottom:0px;border-right:0px;padding:3px 0px;">
						<b>Average Equivalent Cube Strength: &nbsp; </b></td>
					<td style="font-size:11px;text-align:center;border:1px solid black;border-bottom:0px;padding:3px 0px;">
						<?php echo $average; ?></td>
				</tr>
				<?php
			}
			?>

		</table>
		</td>
		</tr>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<!-- footer design -->
		<table style="width: 92%;" align="center">
			<tr>
				<td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by :
						<u><?php echo $u_name; ?> </u></td></b>
				<td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By:
						<u><?php echo $v_name; ?> </u></td></b>
			</tr>
		</table>
		<!--<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
							</tr>
							<tr>
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
							</tr>
						
						</table>
					</td>
				</tr>-->
		</table>

	</page>

</body>

</html>


<!-- <script type="text/javascript">
	window.print();
</script> -->