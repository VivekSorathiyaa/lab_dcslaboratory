<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"][layout="lanscape"] {
		width: 29.7cm;
		height: 21cm;
	}

	@media print {
		@page {
			size: landscape
		}
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
	$select_tiles_query = "select * from tmtSteel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

	$select_query1 = "select * from agency_master where `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
		$issue_date = $row_select2['issue_date'];

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
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4" layout="landscape">
		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td colspan="12" style="font-size:13px">
					<center><b>Test Results of TMT Steel Bar</b></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" rowspan="6" width="30%"><b>Forwarded to ;</b><?php if ($sent_by == 0) {

																					echo $clientname . "<br>" . $client_address . "<br>" . $client_city;
																				} else {
																					echo $agency_name . "<br>" . $agency_address . "<br>" . $agency_city;
																				}
																				?></td>
				<td colspan="8" rowspan="9" width="60%"><b>Name Of Customer :</b><?php echo $clientname; ?><br><b> Name Of Work :</b><?php echo $name_of_work; ?><br><br><b>Ref.No.& Date :</b><?php echo $r_name; ?><br><b>Sample Sent By :</b> Customer<br><b>Name Of Agency :</b><?php echo $agency_name; ?></td>

			</tr>
			<tr>
			</tr>
			<tr>
			</tr>
			<tr>
			</tr>
			<tr>
			</tr>
			<tr>
			</tr>
			<tr>
				<td colspan="4" rowspan="3"><b>Report No :</b>;<?php echo $report_no; ?><br><b>Page :</b>1 of 1<br><b>Date :</b><?php echo date('d-m-Y', strtotime($end_date)); ?></td>
			</tr>
			<tr>
			</tr>
			<tr>
			</tr>

			<tr>
				<td colspan="6" width="45%"><b>Date Of Sample Received : </b><?php echo date('d-m-Y', strtotime($rec_sample_date)); ?> </td>

				<td colspan="6" width="45%"><b>Type Of Sample : </b>TMT Steel Bar</td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>No. of Sample(s):</b></td>

				<td colspan="6" width="45%"><b>Diameter of Sample:</b> <?php echo $row_select_pipe['dia'] . " MM"; ?></td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Condition Of Sample On Receipt :</b> Satisfactory<?php echo $con_sample; ?></td>

				<td colspan="6" width="45%"><b>Specification Of Sample :</b> <?php echo $mt_name; ?></td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Name Of Test :</b> As Mentioned Below</td>

				<td colspan="6" width="45%"><b>Grade Of Sample :</b><?php echo $row_select_pipe['grade']; ?> </td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Test Method Standard :</b> AS mention below</td>

				<td colspan="6" width="45%"><b>Environmental Condition during test :</b>As per the test</td>

			</tr>
			<tr>
				<td colspan="6" width="45%"><b>Date Of Test Starting : </b><?php echo date('d-m-Y', strtotime($start_date)); ?> </td>

				<td colspan="6" width="45%"><b>Date Of Test Completion :</b><?php echo date('d-m-Y', strtotime($end_date)); ?></td>

			</tr>
			<tr>
				<td colspan="6" width="45%"></td>

				<td colspan="6" width="45%"><b>Brand : </b>&nbsp;<?php echo $row_select_pipe['brand']; ?></center>
				</td>

			</tr>
		</table>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12">
					<center><b>Test Result</b></center>
				</td>
			</tr>
		</table>
		<table align="center" width="90%" class="test" border="1px">
			<tr style="height:20px">
				<td>
					<center><b>Sample ID</b></center>
				</td>
				<td>
					<center><b>Dia (MM)</b></center>
				</td>
				<td>
					<center><b>Mass per Meter(Kg/m)</b></center>
				</td>
				<td>
					<center><b>Yield Stress<br>N/mm<sup>2</sup></b></center>
				</td>
				<td>
					<center><b>Ultimate Tensile<br>Strength N/mm<sup>2</sup></b></center>
				</td>
				<td>
					<center><b>Elongation %</b></center>
				</td>
				<td>
					<center><b>Bend Test</b></center>
				</td>
				<td>
					<center><b>Re-bend Test</b></center>
				</td>
			</tr>
			<tr style="height:20px">
				<td>
					<center><?php echo $row_select_pipe['labno1']; ?></center>
				</td>
				<td>
					<center><?php if ($row_select_pipe['chk1'] == "1") {
								echo $row_select_pipe['dia_1'];
							} ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['w_1']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ys_1']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ten_1']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['elo_1']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['bend_1']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['rebend_1']; ?></center>
				</td>
			</tr>
			<tr style="height:20px">
				<td>
					<center><?php echo $row_select_pipe['labno2']; ?></center>
				</td>
				<td>
					<center><?php if ($row_select_pipe['chk2'] == "1") {
								echo $row_select_pipe['dia_2'];
							} ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['w_2']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ys_2']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ten_2']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['elo_2']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['bend_2']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['rebend_2']; ?></center>
				</td>
			</tr>
			<tr style="height:20px">
				<td>
					<center><?php echo $row_select_pipe['labno3']; ?></center>
				</td>
				<td>
					<center><?php if ($row_select_pipe['chk3'] == "1") {
								echo $row_select_pipe['dia_3'];
							} ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['w_3']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ys_3']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ten_3']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['elo_3']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['bend_3']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['rebend_3']; ?></center>
				</td>
			</tr>
			<tr style="height:20px">
				<td>
					<center><?php echo $row_select_pipe['labno4']; ?></center>
				</td>
				<td>
					<center><?php if ($row_select_pipe['chk4'] == "1") {
								echo $row_select_pipe['dia_4'];
							} ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['w_4']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ys_4']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ten_4']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['elo_4']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['bend_4']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['rebend_4']; ?></center>
				</td>
			</tr>
			<tr style="height:20px">
				<td>
					<center><?php echo $row_select_pipe['labno5']; ?></center>
				</td>
				<td>
					<center><?php if ($row_select_pipe['chk5'] == "1") {
								echo $row_select_pipe['dia_5'];
							} ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['w_5']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ys_5']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ten_5']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['elo_5']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['bend_5']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['rebend_5']; ?></center>
				</td>
			</tr>
			<tr style="height:20px">
				<td>
					<center><?php echo $row_select_pipe['labno6']; ?></center>
				</td>
				<td>
					<center><?php if ($row_select_pipe['chk6'] == "1") {
								echo $row_select_pipe['dia_6'];
							} ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['w_6']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ys_6']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['ten_6']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['elo_6']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['bend_6']; ?></center>
				</td>
				<td>
					<center><?php echo $row_select_pipe['rebend_6']; ?></center>
				</td>
			</tr>
			<tr style="height:20px">
				<td>
					<center>Test Method</center>
				</td>
				<td>
					<center>-</center>
				</td>
				<td>
					<center>IS:1786,RA 2013</center>
				</td>
				<td>
					<center>IS:1608,RA 2005</center>
				</td>
				<td>
					<center>IS:1608,RA 2005</center>
				</td>
				<td>
					<center>IS:1786,RA 2013</center>
				</td>
				<td>
					<center>IS:1599,RA 2012</center>
				</td>
				<td>
					<center>IS:1786,RA 2013</center>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Requirement as per I.S.1786-2008,Clause 6.3 & 7.2.3(Reaffirmed 2013)</b></td>
			</tr>
		</table>
		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td colspan="2" width="20%">
					<center>Diameter(mm)</center>
				</td>
				<td width="10%">
					<center>8.0</center>
				</td>
				<td width="10%">
					<center>10.0</center>
				</td>
				<td width="10%">
					<center>12.0</center>
				</td>
				<td width="10%">
					<center>16.0</center>
				</td>
				<td width="10%">
					<center>20.0</center>
				</td>
				<td width="10%">
					<center>25.0</center>
				</td>
				<td width="10%">
					<center>32.0</center>
				</td>
			</tr>
			<tr>
				<td colspan="2" width="20%">
					<center>Mass per<br>Meter (Kg/m)</center>
				</td>
				<td width="10%">
					<center>0.395</center>
				</td>
				<td width="10%">
					<center>0.617</center>
				</td>
				<td width="10%">
					<center>0.888</center>
				</td>
				<td width="10%">
					<center>1.580</center>
				</td>
				<td width="10%">
					<center>2.470</center>
				</td>
				<td width="10%">
					<center>3.850</center>
				</td>
				<td width="10%">
					<center>6.310</center>
				</td>
			</tr>
			<tr>
				<td colspan="2" width="20%">
					<center>Tolerances on Nominal Mass</center>
				</td>
				<td colspan="2" width="20%">
					<center>&#177; 7%</center>
				</td>
				<td colspan="2" width="20%">
					<center>&#177; 5%</center>
				</td>
				<td colspan="3" width="30%">
					<center>&#177; 3%</center>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="90%" class="test">
			<tr>
				<td colspan="12"><b>Requirement as per I.S.1786-2008,Clause 9.1 Table-3(Reaffirmed 2013)</b></td>
			</tr>
		</table>
		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td width="20%">
					<center>Grade</center>
				</td>
				<td>
					<center>FE 415</center>
				</td>
				<td>
					<center>FE 415D</center>
				</td>
				<td>
					<center>FE 500</center>
				</td>
				<td>
					<center>FE 500D</center>
				</td>
				<td>
					<center>FE550</center>
				</td>
				<td>
					<center>FE550D</center>
				</td>
			</tr>
			<tr>
				<td width="20%">
					<center>Yield Stress N/mm<sup>2</sup></center>
				</td>
				<td>
					<center>415</center>
				</td>
				<td>
					<center>415</center>
				</td>
				<td>
					<center>500.0</center>
				</td>
				<td>
					<center>500.0</center>
				</td>
				<td>
					<center>550.0</center>
				</td>
				<td>
					<center>550.0</center>
				</td>
			</tr>
			<tr>
				<td width="20%">
					<center>Ultimate Tensile Strength N/mm<sup>2</sup></center>
				</td>
				<td>
					<center>485</center>
				</td>
				<td>
					<center>500</center>
				</td>
				<td>
					<center>545.0</center>
				</td>
				<td>
					<center>565.0</center>
				</td>
				<td>
					<center>585.0</center>
				</td>
				<td>
					<center>600.0</center>
				</td>
			</tr>
			<tr>
				<td width="20%">
					<center>Elongation %</center>
				</td>
				<td>
					<center>14.5</center>
				</td>
				<td>
					<center>18</center>
				</td>
				<td>
					<center>12.0</center>
				</td>
				<td>
					<center>16.0</center>
				</td>
				<td>
					<center>10.0</center>
				</td>
				<td>
					<center>14.5</center>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td style="transform: rotate(270deg);">
					<center><B>NOTES</B></center>
				</td>
				<td colspan="8"> * The test result relates to the samples submitted by Customer/Agency.<br>* The Results / Reports are issued with specific understanding that Span Infrastructure will not<br>&nbsp;&nbsp;&nbsp; in way be involved in acting following interpretation of the test results.<br> * The Results / Reports are not supposed to be used for publicity.</td>
				<td colspan="3">
					<center>for <b>Span Material Testing And Consultancy Services Limited</b><br><br><br>Authorised Signatory</center>
				</td>
			</tr>
		</table>



		<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$("#print_button").on("click", function() {
		$('#print_button').hide();
		window.print();
	});
</script>
