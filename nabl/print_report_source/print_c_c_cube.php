<?php
session_start();
include("../connection.php");
error_reporting(1); ?>

<?php
$job_no = $_GET['job_no'];
$lab_no = $_GET['lab_no'];
$report_no = $_GET['report_no'];
$trf_no = $_GET['trf_no'];
$select_tiles_query = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
$result_tiles_select = mysqli_query($conn, $select_tiles_query);
$row_select_pipe = mysqli_fetch_array($result_tiles_select);

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
	$cc_grade = $row_select4['cc_grade'];
	$cc_set_of_cube = $row_select4['cc_set_of_cube'];
	$cc_no_of_cube = $row_select4['cc_no_of_cube'];
	$cc_identification_mark = $row_select4['cc_identification_mark'];
	$day_remark = $row_select4['day_remark'];
	$casting_date = $row_select4['casting_date'];
	$material_location = $row_select4['material_location'];
}


?>


<table border="1" cellspacing="0" style="width:515pt">
	<tbody>
		<tr>
			<td colspan="11" style="width:515pt"><a name="RANGE!A1:K23"></a></td>
		</tr>
		<tr>
			<td colspan="11" style="height:15.0pt">(M-6)</td>
		</tr>
		<tr>
			<td colspan="11">TITLE : TEST&nbsp; RESULT&nbsp; OF CEMENT CONCRETE CUBES</td>
		</tr>
		<tr>
			<td colspan="11" rowspan="2" style="height:31.5pt">&nbsp;</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td colspan="6" style="height:15.0pt">No: - __________________</td>
			<td colspan="5">Accompaniment to letter No.&nbsp;</td>
		</tr>
		<tr>
			<td colspan="6" style="height:15.0pt">&nbsp;</td>
			<td colspan="5">Date : -________________</td>
		</tr>
		<tr>
			<td colspan="11" style="height:15.0pt">Name of work : -<?php echo $name_of_work; ?>&nbsp</td>
		</tr>
		<tr>
			<td colspan="6">01&nbsp; Specimen sent by : -<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
															$result_selectc = mysqli_query($conn, $select_queryc);

															if (mysqli_num_rows($result_selectc) > 0) {
																$row_selectc = mysqli_fetch_assoc($result_selectc);
																$ct_nm = $row_selectc['city_name'];
															}
															echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?></td>
			<td colspan="5">02&nbsp; Received vide letter No. : -<?php echo $r_name; ?></td>
		</tr>
		<tr>
			<td colspan="6">03&nbsp; Specimen brought by : -<?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
															$result_selectc1 = mysqli_query($conn, $select_queryc1);

															if (mysqli_num_rows($result_selectc1) > 0) {
																$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																$ct_nm1 = $row_selectc1['city_name'];
															}
															echo $agency_name . " " . $ct_nm1; ?></td>
			<td colspan="5">04 &nbsp;Identification mark : -<?php echo $cc_identification_mark; ?></td>
		</tr>
		<tr>
			<td colspan="6">05 &nbsp;Condition of specimen : <?php echo $con_sample; ?></td>
			<td colspan="5">06&nbsp; Grade of concrete : -<?php echo $row_select_pipe['grade1']; ?></td>
		</tr>
		<tr>
			<td colspan="6">07&nbsp; No. of specimen : -03 Nos</td>
			<td colspan="5">08&nbsp; Date of casting : -<?php echo date('d.m.Y', strtotime($start_date)); ?></td>
		</tr>
		<tr>
			<td colspan="6">09&nbsp; Sampling done by :-<?php echo $sample_sent_by; ?></td>
			<td colspan="5">10 &nbsp;Purpose of testing : -Ok or Not</td>
		</tr>
		<tr>
			<td colspan="6">11&nbsp; Size of specimen : - <?php echo $row_select_pipe['l1'] . "X" . $row_select_pipe['b1'] . "X" . $row_select_pipe['h1']; ?></td>
			<td colspan="5">12&nbsp; Laboratory No : -&nbsp; <?php echo $row_select_pipe['job_no']; ?></td>
		</tr>
		<tr>
			<td colspan="6">13&nbsp;&nbsp; Age of curing : -<?php echo $row_select_pipe['day1']; ?> Days</td>
			<td colspan="5">14&nbsp; Job No : -<?php echo $row_select_pipe['lab_no']; ?></td>
		</tr>
		<tr>
			<td style="height:93.0pt; width:41pt">Lab No./ Grade of Conc.</td>
			<td style="width:46pt">Date of casting of C.C. cubes</td>
			<td style="width:36pt">Curing period in days</td>
			<td style="width:46pt">Due date of testing</td>
			<td style="width:45pt">Date of receipt of cubes in lab</td>
			<td style="width:52pt">Actual date of testing</td>
			<td style="width:44pt">Age of testing in days</td>
			<td style="width:50pt">S.S.D. of concrete in gm/C.C.</td>
			<td style="width:73pt">Compressive strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (N / mm2)&nbsp;</td>
			<td colspan="2" style="width:82pt">Remarks</td>
		</tr>
		<tr>
			<td style="height:15.75pt">01</td>
			<td>02</td>
			<td>03</td>
			<td>04</td>
			<td>05</td>
			<td>06</td>
			<td>07</td>
			<td>08</td>
			<td>09</td>
			<td colspan="2">10</td>
		</tr>
		<tr>
			<td style="height:24.95pt"><?php echo $row_select_pipe['grade1']; ?></td>
			<td><?php echo date('d.m.Y', strtotime($start_date)); ?></td>
			<td><?php echo $row_select_pipe['day1']; ?></td>
			<td><?php echo date('d.m.Y', strtotime($end_date)); ?></td>
			<td><?php echo date('d.m.Y', strtotime($rec_sample_date)); ?></td>
			<td><?php echo date('d.m.Y', strtotime($end_date)); ?></td>
			<td><?php echo $row_select_pipe['day1']; ?></td>
			<td><?php
				$height = strval($row_select_pipe['h1']);
				$weight = strval($row_select_pipe['mass_1']);
				$area = strval($row_select_pipe['cross_1']);

				$mul1 = $area * $height;
				$mul2 = $weight / $mul1;
				echo $result = substr($mul2, 0, 4);


				?></td>
			<td><?php echo $row_select_pipe['comp_1']; ?></td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:24.95pt"><?php echo $row_select_pipe['grade1']; ?></td>
			<td><?php echo date('d.m.Y', strtotime($start_date)); ?></td>
			<td><?php echo $row_select_pipe['day1']; ?></td>
			<td><?php echo date('d.m.Y', strtotime($end_date)); ?></td>
			<td><?php echo date('d.m.Y', strtotime($rec_sample_date)); ?></td>
			<td><?php echo date('d.m.Y', strtotime($end_date)); ?></td>
			<td><?php echo $row_select_pipe['day1']; ?></td>
			<td><?php
				$height2 = strval($row_select_pipe['h2']);
				$weight2 = strval($row_select_pipe['mass_2']);
				$area2 = strval($row_select_pipe['cross_2']);

				$mul12 = $area2 * $height2;
				$mul22 = $weight2 / $mul12;
				echo $result2 = substr($mul22, 0, 4);


				?></td>
			<td><?php echo $row_select_pipe['comp_2']; ?></td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:24.95pt"><?php echo $row_select_pipe['grade1']; ?></td>
			<td><?php echo date('d.m.Y', strtotime($start_date)); ?></td>
			<td><?php echo $row_select_pipe['day1']; ?></td>
			<td><?php echo date('d.m.Y', strtotime($end_date)); ?></td>
			<td><?php echo date('d.m.Y', strtotime($rec_sample_date)); ?></td>
			<td><?php echo date('d.m.Y', strtotime($end_date)); ?></td>
			<td><?php echo $row_select_pipe['day1']; ?></td>
			<td><?php
				$height3 = strval($row_select_pipe['h3']);
				$weight3 = strval($row_select_pipe['mass_3']);
				$area3 = strval($row_select_pipe['cross_3']);

				$mul13 = $area3 * $height3;
				$mul23 = $weight3 / $mul13;
				echo $result3 = substr($mul23, 0, 4);


				?></td>
			<td><?php echo $row_select_pipe['comp_3']; ?></td>
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr>
			<td colspan="8" style="height:37.5pt; width:360pt">Average of 3 specimens =</td>
			<td style="width:73pt"><?php echo $row_select_pipe['avg_com_s_1']; ?></td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="11">Tested by&nbsp; :Tushar Patel</td>
		</tr>
		<tr>
			<td colspan="11">Checked by&nbsp; : Vishal Raiyani</td>
		</tr>
	</tbody>
</table>
