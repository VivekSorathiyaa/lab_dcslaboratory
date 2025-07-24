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
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$select_tiles_query = "select * from water_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job,city WHERE city.id = job.client_city AND `report_no`='$report_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$client_city = $row_select6['city_name'];
	$client_address = $row_select['clientaddress'];
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
        $issue_date = $row_select2['issue_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name = $row_select3['mt_name'];
			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['water_source'];
	}


	?>


	<page size="A4">

		<table align="center" width="90%" class="test" border="1px">
			<tr>
				<td colspan="4">
					<center><b>Span Infrastucture Material Testing & Consultancy Services Limited</b></center>
				</td>

			</tr>
			<tr>
				<td colspan="2"><b>Work sheet for Chemical Analysis of Water / Waste Water</b></td>
				<td colspan="2">Format No-QR/210, Rev.-00//01.11.2018</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:left;">Laboratory Ref. No.:&nbsp;&nbsp;<?php echo $row_select_pipe['lab_no']; ?></td>
				<td colspan="2" style="text-align:left;">Report No : <?php echo $row_select_pipe['report_no']; ?></td>

			</tr>
			<tr>
				<td colspan="2" style="text-align:left;">Sample Receive Date : &nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?> </td>
				<td colspan="2" style="text-align:left;">Specification : <?php echo $row_select_pipe['specification']; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:left;">Source : &nbsp;&nbsp;<?php echo $source; ?> </td>
				<td colspan="2" style="text-align:left;">Brand : <?php echo $row_select_pipe['brand']; ?></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:left;">Condition Of Sample On Receipt&nbsp;&nbsp;<?php echo $con_sample; ?></td>
				<td colspan="2" style="text-align:left;">Sample Send by&nbsp;&nbsp;<?php if ($row_select['sample_sent_by'] == "0") {
																						echo "Customer";
																					} else {
																						echo "Agency";
																					} ?></td>


			</tr>


			<tr>
				<td colspan="2" style="text-align:left;">Date Test Started&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
				<td colspan="2" style="text-align:left;">Date Test Completed&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%"><b>01</b></td>
				<td style="text-align:center;width:10%"><b>pH</b></td>
				<td style="text-align:left;width:10%"><b>Test Method</b></td>
				<td style="text-align:center;width:10%"><b>IS 3025, Part - 11</b></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Beaker No.</td>
				<td style="text-align:center;width:10%"><?php echo $row_select_pipe['ph_b_1']; ?></td>
				<td style="text-align:center;width:10%"><?php echo $row_select_pipe['ph_b_2']; ?></td>
				<td style="text-align:center;width:10%"><?php echo $row_select_pipe['ph_b_3']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Measured PH Value (Meter Reading)</td>
				<td style="text-align:center;width:10%"><?php echo $row_select_pipe['ph_v_1']; ?></td>
				<td style="text-align:center;width:10%"><?php echo $row_select_pipe['ph_v_2']; ?></td>
				<td style="text-align:center;width:10%"><?php echo $row_select_pipe['ph_v_3']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Average PH@</td>
				<td style="text-align:center;width:10%" colspan="3"><?php echo $row_select_pipe['ph_value']; ?></td>

			</tr>
			<tr>
				<td style="text-align:left;width:50%"><b>02</b></td>
				<td style="text-align:center;width:10%"><b>Total Dissolved Solids (TDS)</b></td>
				<td style="text-align:left;width:10%"><b>Test Method</b></td>
				<td style="text-align:center;width:10%"><b>IS 3025, Part - 16</b></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Beaker No.</td>
				<td style="text-align:center;width:10%" colspan="3"><?php echo $row_select_pipe['tds_b_1']; ?></td>

			</tr>
			<tr>
				<td style="text-align:left;width:50%">Volume of Sample taken in ml</td>
				<td style="text-align:center;width:10%">V</td>
				<td style="text-align:center;width:10%" colspan="2"><?php echo $row_select_pipe['tds_v']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Mass in gm of Residue and Dish / Beaker before ignition 105 &#8451;</td>
				<td style="text-align:center;width:10%">W1</td>
				<td style="text-align:center;width:10%" colspan="2"><?php echo $row_select_pipe['tds_w1']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Passing Sample Water, Weight of Beaker in gm After ignition (105 &#8451;)</td>
				<td style="text-align:center;width:10%">W2</td>
				<td style="text-align:center;width:10%" colspan="2"><?php echo $row_select_pipe['tds_w2']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">TDS in mg/l = (W2-W1)X 10<sup>6</sup>/V</td>
				<td style="text-align:center;width:10%" colspan="3"><?php echo $row_select_pipe['tds_value']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%"><b>03</b></td>
				<td style="text-align:center;width:10%"><b>Chloride</b></td>
				<td style="text-align:left;width:10%"><b>Test Method</b></td>
				<td style="text-align:center;width:10%"><b>IS 3025, Part - 32</b></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Flask No.</td>
				<td style="text-align:center;width:10%" colspan="3"><?php echo $row_select_pipe['cl_f_1']; ?></td>

			</tr>
			<tr>
				<td style="text-align:left;width:50%">Volume of Sample taken in ml</td>
				<td style="text-align:center;width:10%">V3</td>
				<td style="text-align:center;width:10%" colspan="2"><?php echo $row_select_pipe['cl_v3']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Volume of AgNO<sub>3</sub> used by the sample, in ml</td>
				<td style="text-align:center;width:10%">V1</td>
				<td style="text-align:center;width:10%" colspan="2"><?php echo $row_select_pipe['cl_v1']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Volume of AgNO<sub>3</sub> used by for blank titration, in ml</td>
				<td style="text-align:center;width:10%">V2</td>
				<td style="text-align:center;width:10%" colspan="2"><?php echo $row_select_pipe['cl_v2']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Normality of AgNO<sub>3</sub></td>
				<td style="text-align:center;width:10%">N</td>
				<td style="text-align:center;width:10%" colspan="2"><?php echo $row_select_pipe['cl_n']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Chloride as, mg/l = ((V1-V2) X N X 35450)/V3</td>
				<td style="text-align:center;width:10%" colspan="3"><?php echo $row_select_pipe['cl_value']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%"><b>04</b></td>
				<td style="text-align:center;width:10%"><b>Sulphate</b></td>
				<td style="text-align:left;width:10%"><b>Test Method</b></td>
				<td style="text-align:center;width:10%"><b>IS 3025, Part - 24</b></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Beaker No.</td>
				<td style="text-align:center;width:10%" colspan="3"><?php echo $row_select_pipe['sup_b_1']; ?></td>

			</tr>
			<tr>
				<td style="text-align:left;width:50%">Volume of Sample taken in ml</td>
				<td style="text-align:center;width:10%">V</td>
				<td style="text-align:center;width:10%" colspan="2"><?php echo $row_select_pipe['sup_v']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Volume of empty Crucible in gm</td>
				<td style="text-align:center;width:10%">W1</td>
				<td style="text-align:center;width:10%" colspan="2"><?php echo $row_select_pipe['sup_w1']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">Weight of Crucible & Residue in gm</td>
				<td style="text-align:center;width:10%">W2</td>
				<td style="text-align:center;width:10%" colspan="2"><?php echo $row_select_pipe['sup_w2']; ?></td>
			</tr>
			<tr>
				<td style="text-align:left;width:50%">TDS in mg/l = (W2-W1)X 10<sup>6</sup>/V</td>
				<td style="text-align:center;width:10%" colspan="3"><?php echo $row_select_pipe['sup_value']; ?></td>
			</tr>
		</table>
		<br>
	</page>
	<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: gSTCn;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$("#print_button").on("click", function() {
		$('#print_button').hide();
		window.print();
	});
</script>