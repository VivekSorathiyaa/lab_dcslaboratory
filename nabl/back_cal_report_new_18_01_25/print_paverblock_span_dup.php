<?php
session_start();
include("../connection.php");
error_reporting(1); ?>

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
$cons1 = $row_select['sample_sent_by'];
if ($cons1 == 0) {
	$sample_sent_by = "Client";
} else {
	$sample_sent_by = "agency";
}
$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

$select_query1 = "select * from agency_master where `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
	$paver_thickness = $row_select4['paver_thickness'];
	$paver_grade = $row_select4['paver_grade'];
	$material_location = $row_select4['material_location'];
}


?>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<p><strong>GUJARAT ENGINEERING RESEARCH INSTITUTE</strong></p>

<p><strong>Narmada</strong><strong>, Water Resources, Water Supply &amp; Kalpsar Department</strong></p>

<p><strong>Road &amp; Building Department</strong></p>

<p>&nbsp;</p>

<table border="1" cellspacing="0">
	<tbody>
		<tr>
			<td style="width:241.9pt">
				<p>TITLE: <strong>RESULTS OF PAVER BLOCK</strong></p>
			</td>
			<td style="width:241.95pt">
				<p>Accompaniment to letter No.</p>

				<p>&nbsp;</p>

				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date:</p>
			</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<table border="1" cellspacing="0">
	<tbody>
		<tr>
			<td colspan="8" style="width:486.9pt">
				<p>Name of work: <?php echo $name_of_work; ?>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td colspan="8" style="width:486.9pt">
				<p>Details of sample</p>
			</td>
		</tr>
		<tr>
			<td style="width:27.9pt">
				<p>1</p>
			</td>
			<td style="width:112.5pt">
				<p>Sample sent by</p>
			</td>
			<td style="width:13.5pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:94.5pt">
				<p><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
					$result_selectc = mysqli_query($conn, $select_queryc);

					if (mysqli_num_rows($result_selectc) > 0) {
						$row_selectc = mysqli_fetch_assoc($result_selectc);
						$ct_nm = $row_selectc['city_name'];
					}
					echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?></p>
			</td>
			<td style="width:27.0pt">
				<p>2</p>
			</td>
			<td style="width:112.5pt">
				<p>Vide letter No.</p>
			</td>
			<td style="width:14.55pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:84.45pt">
				<p><?php echo $r_name; ?></p>
			</td>
		</tr>
		<tr>
			<td style="width:27.9pt">
				<p>3</p>
			</td>
			<td style="width:112.5pt">
				<p>Sample brought by</p>
			</td>
			<td style="width:13.5pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:94.5pt">
				<p><?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
					$result_selectc1 = mysqli_query($conn, $select_queryc1);

					if (mysqli_num_rows($result_selectc1) > 0) {
						$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
						$ct_nm1 = $row_selectc1['city_name'];
					}
					echo $agency_name . " " . $ct_nm1; ?></p>
			</td>
			<td style="width:27.0pt">
				<p>4</p>
			</td>
			<td style="width:112.5pt">
				<p>Identification mark Grade / Thickness / Area</p>
			</td>
			<td style="width:14.55pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:84.45pt">
				<p><?php echo $paver_grade . " / " . $paver_thickness . " mm "; ?></p>
			</td>
		</tr>
		<tr>
			<td style="width:27.9pt">
				<p>5</p>
			</td>
			<td style="width:112.5pt">
				<p>Condition of sample</p>
			</td>
			<td style="width:13.5pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:94.5pt">
				<p><?php echo $con_sample; ?></p>
			</td>
			<td style="width:27.0pt">
				<p>6</p>
			</td>
			<td style="width:112.5pt">
				<p>Name of manufacturer</p>
			</td>
			<td style="width:14.55pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:84.45pt">
				<p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td style="width:27.9pt">
				<p>7</p>
			</td>
			<td style="width:112.5pt">
				<p>Type of material</p>
			</td>
			<td style="width:13.5pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:94.5pt">
				<p>Paver Block (<?php echo $paver_shape; ?>)</p>
			</td>
			<td style="width:27.0pt">
				<p>8</p>
			</td>
			<td style="width:112.5pt">
				<p>Date of sampling</p>
			</td>
			<td style="width:14.55pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:84.45pt">
				<p><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></p>
			</td>
		</tr>
		<tr>
			<td style="width:27.9pt">
				<p>9</p>
			</td>
			<td style="width:112.5pt">
				<p>Method of sampling</p>
			</td>
			<td style="width:13.5pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:94.5pt">
				<p>As per IS</p>
			</td>
			<td style="width:27.0pt">
				<p>10</p>
			</td>
			<td style="width:112.5pt">
				<p>Quantity from which sample collected</p>
			</td>
			<td style="width:14.55pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:84.45pt">
				<p>11 Nos.</p>
			</td>
		</tr>
		<tr>
			<td style="width:27.9pt">
				<p>11</p>
			</td>
			<td style="width:112.5pt">
				<p>Sampling done by</p>
			</td>
			<td style="width:13.5pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:94.5pt">
				<p><?php echo $sample_sent_by; ?></p>
			</td>
			<td style="width:27.0pt">
				<p>12</p>
			</td>
			<td style="width:112.5pt">
				<p>Purpose of testing</p>
			</td>
			<td style="width:14.55pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:84.45pt">
				<p>ok / not</p>
			</td>
		</tr>
		<tr>
			<td style="width:27.9pt">
				<p>13</p>
			</td>
			<td style="width:112.5pt">
				<p>Laboratory No.</p>
			</td>
			<td style="width:13.5pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:94.5pt">
				<p><?php echo $row_select_pipe['job_no']; ?></p>
			</td>
			<td style="width:27.0pt">
				<p>14</p>
			</td>
			<td style="width:112.5pt">
				<p>Job No.</p>
			</td>
			<td style="width:14.55pt">
				<p><strong>:</strong></p>
			</td>
			<td style="width:84.45pt">
				<p><?php echo $row_select_pipe['lab_no']; ?></p>
			</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Physical Tests:</strong></p>

<p>&nbsp;</p>

<table border="1" cellspacing="0">
	<tbody>
		<tr>
			<td colspan="2" style="width:171.9pt">
				<p><strong>Tests</strong></p>
			</td>
			<td style="width:76.5pt">
				<p><strong>Results obtained</strong></p>
			</td>
			<td style="width:206.6pt">
				<p><strong>Requirement</strong><strong> as per IS:15658:2006</strong></p>

				<p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td style="width:36.9pt">
				<p>(i)</p>
			</td>
			<td style="width:135.0pt">
				<p>Compressive Strength</p>

				<p>(N/mm2) (&nbsp; M45 )grade</p>

				<p>&nbsp;</p>
			</td>
			<td style="width:76.5pt">
				<p><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != null && $row_select_pipe['avg_corr'] != "0") {
						echo number_format($row_select_pipe['avg_corr'], 2);
					} else {
						echo "-";
					} ?></p>
			</td>
			<td style="width:206.6pt">
				<p>As per thickness &amp; grade, IS 15658 : 2006 i.e. 45.0N/mm2</p>
			</td>
		</tr>
		<tr>
			<td style="width:36.9pt">
				<p>(ii)</p>
			</td>
			<td style="width:135.0pt">
				<p>Water Absorption</p>
			</td>
			<td style="width:76.5pt">
				<p><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0") {
						echo number_format($row_select_pipe['avg_wtr'], 2);
					} else {
						echo "-";
					} ?></p>
			</td>
			<td style="width:206.6pt">
				<p>Average should not be more than 6%</p>
			</td>
		</tr>
	</tbody>
</table>

<p>Items not confirming with IS specification shown by:</p>

<p>&nbsp;</p>

<p>1 (i) / 1 (ii)</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>Note:</p>

<p>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tests results related to sample collected by supplier.&nbsp;&nbsp;</p>

<p>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Results/reports are issued with specific understanding that GERI will not in any case by involved in actions following the interpretation of test results.</p>

<p>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The reports/results are not supposed to be used for publicity.</p>

<p>&nbsp;</p>

<p>Tested by: Tushar Patel</p>

<p>&nbsp;</p>

<table border="1" cellspacing="0" style="width:491.05pt">
	<tbody>
		<tr>
			<td style="width:163.65pt">
				<p>Checked by:Vishal Raiyani</p>
			</td>
			<td style="width:163.7pt">
				<p>Assistant Research Officer</p>

				<p>M.T.Unit, M.T.Dn., GERI, Vadodara.</p>
			</td>
			<td style="width:163.7pt">
				<p>Research Officer</p>

				<p>M.T.Dn., GERI, Vadodara.</p>

				<p>&nbsp;</p>
			</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>
