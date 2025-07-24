<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<?php
$job_no = $_GET['job_no'];
$lab_no = $_GET['lab_no'];
$report_no = $_GET['report_no'];
$trf_no = $_GET['trf_no'];
$select_tiles_query = "select * from span_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	}
}

$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
$result_select4 = mysqli_query($conn, $select_query4);

if (mysqli_num_rows($result_select4) > 0) {
	$row_select4 = mysqli_fetch_assoc($result_select4);
	$source = $row_select4['fine_agg_source'];
	$material_location = $row_select4['material_location'];
}


?>
<table border="1" cellpadding="0" cellspacing="0" style="width:728px">
	<tbody>
		<tr>
			<td><a name="RANGE!A1:H31"></a></td>
			<td colspan="7">(M-1)</td>
		</tr>
		<tr>
			<td colspan="8">TITLE: TEST RESULTS OF CEMENT</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="7">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5">Type of cement:- <?php echo $mt_name . " " . $row_select_pipe['cement_grade']; ?></td>
			<td colspan="3">Job No: <?php echo $row_select_pipe['lab_no']; ?></td>
		</tr>
		<tr>
			<td colspan="5">Name of work: <?php echo $name_of_work; ?>&nbsp;</td>
			<td colspan="3">Lab No.<?php echo $row_select_pipe['job_no']; ?></td>
		</tr>
		<tr>
			<td colspan="5">1.Details of sample:</td>
			<td colspan="3">2.Received vide letter No: <?php echo $r_name; ?></td>
		</tr>
		<tr>
			<td colspan="5">3.Sample sent by: <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
												$result_selectc = mysqli_query($conn, $select_queryc);

												if (mysqli_num_rows($result_selectc) > 0) {
													$row_selectc = mysqli_fetch_assoc($result_selectc);
													$ct_nm = $row_selectc['city_name'];
												}
												echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?></td>
			<td colspan="3">4.Identification marks</td>
		</tr>
		<tr>
			<td colspan="8">5.Samples brought by: <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
													$result_selectc1 = mysqli_query($conn, $select_queryc1);

													if (mysqli_num_rows($result_selectc1) > 0) {
														$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
														$ct_nm1 = $row_selectc1['city_name'];
													}
													echo $agency_name . " " . $ct_nm1; ?></td>
		</tr>
		<tr>
			<td colspan="5">6.Condition of sample: <?php echo $con_sample; ?></td>
			<td colspan="3">7.Date of sampling: <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
		</tr>
		<tr>
			<td colspan="5">8.Sampling done by: <?php echo $sample_sent_by; ?></td>
			<td colspan="3">9.Method of sampling: As per IS</td>
		</tr>
		<tr>
			<td colspan="5">10.Quantity from which sample collected : 50 kg</td>
			<td colspan="3">11.Purpose of testing: ok / not</td>
		</tr>
		<tr>
			<td colspan="8">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8">(A)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Physical Properties:</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>FOR PPC</td>
			<td colspan="3">Requirement For OPC grade</td>
			<td>Remarks</td>
		</tr>
		<tr>
			<td rowspan="2">Sr. No.</td>
			<td rowspan="2">Tests</td>
			<td rowspan="2">Results Obtained</td>
			<td>IS 1489&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Part-1)&nbsp;&nbsp; 2015</td>
			<td>IS 269-2015&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Grade 33</td>
			<td>IS 269-2015&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Grade 43</td>
			<td>IS 269-2015&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Grade 53</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Fourth Revision 2015</td>
			<td colspan="3">Sixth Revision - 2015</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>1</td>
			<td>1.Specific Surface area m2/Kg</td>
			<td><?php if ($row_select_pipe['ss_area'] == "" && $row_select_pipe['ss_area'] == null && $row_select_pipe['ss_area'] == "0") {
					echo "-";
				} else {
					echo number_format($row_select_pipe['ss_area'], 0);
				} ?></td>
			<td>Minimum 300</td>
			<td>Minimum 225</td>
			<td>Minimum 225</td>
			<td>Minimum 225</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td rowspan="5">2</td>
			<td>2.Compressive strength&nbsp; in N/mm2</td>
			<td>&nbsp;</td>
			<td>Not Less Than</td>
			<td>Not Less Than</td>
			<td>Not Less Than</td>
			<td>Not Less Than</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>0 3 days</td>
			<td><?php if ($row_select_pipe['avg_com_1'] == "" && $row_select_pipe['avg_com_1'] == null && $row_select_pipe['avg_com_1'] == "0") {
					echo "-";
				} else {
					echo number_format($row_select_pipe['avg_com_1'], 1);
				} ?></td>
			<td>16</td>
			<td>16</td>
			<td>23</td>
			<td>27</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>0 7 days</td>
			<td><?php if ($row_select_pipe['avg_com_2'] == "" && $row_select_pipe['avg_com_2'] == null && $row_select_pipe['avg_com_2'] == "0") {
					echo "-";
				} else {
					echo number_format($row_select_pipe['avg_com_2'], 1);
				} ?></td>
			<td>22</td>
			<td>22</td>
			<td>33</td>
			<td>37</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>28 days</td>
			<td><?php if ($row_select_pipe['avg_com_3'] == "" && $row_select_pipe['avg_com_3'] == null && $row_select_pipe['avg_com_3'] == "0") {
					echo "-";
				} else {
					echo number_format($row_select_pipe['avg_com_3'], 1);
				} ?></td>
			<td>33</td>
			<td>33</td>
			<td>43</td>
			<td>53</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;Max. Compressive strenght in N/mm2</td>
			<td>&nbsp;</td>
			<td>&nbsp;--</td>
			<td>48</td>
			<td>58</td>
			<td>&nbsp;--</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td rowspan="3">3</td>
			<td>3.Setting time in&nbsp; minutes&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Intial min.</td>
			<td><?php if ($row_select_pipe['initial_time'] == "" && $row_select_pipe['initial_time'] == null && $row_select_pipe['initial_time'] == "0") {
					echo "-";
				} else {
					echo round($row_select_pipe['initial_time']);
				} ?></td>
			<td>Not Less Than 30</td>
			<td>Not less than 30</td>
			<td>Not less than 30</td>
			<td>Not less than 30</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Final max.</td>
			<td><?php if ($row_select_pipe['final_time'] == "" && $row_select_pipe['final_time'] == null && $row_select_pipe['final_time'] == "0") {
					echo "-";
				} else {
					echo round($row_select_pipe['final_time']);
				} ?></td>
			<td>Not more than 600</td>
			<td>Not more than 600</td>
			<td>Not more than 600</td>
			<td>Not more than 600</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td rowspan="2">4</td>
			<td>4. Soundness</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Le-Chatelier in mm</td>
			<td><?php if ($row_select_pipe['soundness'] == "" && $row_select_pipe['soundness'] == null && $row_select_pipe['soundness'] == "0") {
					echo "-";
				} else {
					echo number_format($row_select_pipe['soundness'], 1);
				} ?></td>
			<td>Not more than 10</td>
			<td>Not more than 10</td>
			<td>Not more than 10</td>
			<td>Not more than 10</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>5</td>
			<td>5. Standard Consistency in %</td>
			<td><?php if ($row_select_pipe['final_consistency'] == "" && $row_select_pipe['final_consistency'] == null && $row_select_pipe['final_consistency'] == "0") {
					echo "-";
				} else {
					echo number_format($row_select_pipe['final_consistency'], 2);
				} ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="7">Tested By: Akash Goti</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="7">Checked By: Vishal Raiyani</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>
