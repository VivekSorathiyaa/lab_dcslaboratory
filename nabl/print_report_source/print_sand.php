<?php
session_start();
include("../connection.php");
error_reporting(1); ?>

<?php
$job_no = $_GET['job_no'];
$lab_no = $_GET['lab_no'];
$report_no = $_GET['report_no'];
$trf_no = $_GET['trf_no'];
$select_tiles_query = "select * from sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$source = $row_select4['fine_aggregate_source'];
	$type = $row_select4['fine_agg_type'];
	$material_location = $row_select4['material_location'];
}


?>
<table border="1" cellspacing="0" style="width:469pt">
	<tbody>
		<tr>
			<td colspan="5" style="width:469pt"><a name="RANGE!A1:E46">(M-3)</a></td>
		</tr>
		<tr>
			<td colspan="5">TITLE :&nbsp;&nbsp; TEST RESULT OF FINE AGGREGATE</td>
		</tr>
		<tr>
			<td colspan="5">Name of work :&nbsp;<?php echo $name_of_work; ?>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5" style="height:24.0pt">Details of Fine Aggregate :</td>
		</tr>
		<tr>
			<td style="height:16.5pt; width:30pt">1</td>
			<td style="width:162pt">Sample sent by : <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
														$result_selectc = mysqli_query($conn, $select_queryc);

														if (mysqli_num_rows($result_selectc) > 0) {
															$row_selectc = mysqli_fetch_assoc($result_selectc);
															$ct_nm = $row_selectc['city_name'];
														}
														echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?></td>
			<td style="width:59pt">2</td>
			<td colspan="2" style="width:218pt">Received vide letter No.: <?php echo $r_name; ?></td>
		</tr>
		<tr>
			<td style="height:23.25pt; width:30pt">3</td>
			<td style="width:162pt">Sample brought by: <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
														$result_selectc1 = mysqli_query($conn, $select_queryc1);

														if (mysqli_num_rows($result_selectc1) > 0) {
															$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
															$ct_nm1 = $row_selectc1['city_name'];
														}
														echo $agency_name . " " . $ct_nm1; ?></td>
			<td style="width:59pt">4</td>
			<td colspan="2" style="width:218pt">Identification Mark</td>
		</tr>
		<tr>
			<td style="height:32.25pt; width:30pt">5</td>
			<td style="width:162pt">Condition of sample : <?php echo $con_sample; ?></td>
			<td style="width:59pt">6</td>
			<td colspan="2" style="width:218pt">Name of quarry &amp; location:&nbsp; <?php echo $source; ?></td>
		</tr>
		<tr>
			<td style="height:27.0pt; width:30pt">7</td>
			<td style="width:162pt">Type of sample: Fine Aggregate</td>
			<td style="width:59pt">8</td>
			<td colspan="2" style="width:218pt">Date of sampling: <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
		</tr>
		<tr>
			<td style="height:29.25pt; width:30pt">9</td>
			<td style="width:162pt">Sampling done by : <?php echo $sample_sent_by; ?></td>
			<td style="width:59pt">10</td>
			<td colspan="2" style="width:218pt">Method of sampling: As per IS</td>
		</tr>
		<tr>
			<td style="height:36.75pt; width:30pt">11</td>
			<td style="width:162pt">Quantity from which sample collected : 15 kg</td>
			<td style="width:59pt">12</td>
			<td colspan="2" style="width:218pt">Purpose of testing: ok / not</td>
		</tr>
		<tr>
			<td style="height:25.5pt; width:30pt">13</td>
			<td style="width:162pt">Laboratory no.<?php echo $row_select_pipe['job_no']; ?></td>
			<td style="width:59pt">14</td>
			<td colspan="2" style="width:218pt">Job No.<?php echo $row_select_pipe['lab_no']; ?></td>
		</tr>
		<tr>
			<td style="height:29.25pt">&nbsp;</td>
			<td colspan="3">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="height:30.75pt; width:30pt">Itm</td>
			<td style="width:162pt">Tests</td>
			<td style="width:59pt">Results Obtained</td>
			<td colspan="2" style="width:218pt">Requirement as per&nbsp; IS 383:2016&nbsp;</td>
		</tr>
		<tr>
			<td style="height:20.25pt; width:30pt">1</td>
			<td style="width:162pt">2</td>
			<td style="width:59pt">3</td>
			<td colspan="2" style="width:218pt">4</td>
		</tr>
		<tr>
			<td style="height:18.0pt; width:30pt">1</td>
			<td style="width:162pt">Specific Gravity</td>
			<td style="width:59pt"><?php if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") {

										echo number_format($row_select_pipe['sp_specific_gravity'], 3);
									} else {
										echo "-";
									} ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:18.0pt; width:30pt">2</td>
			<td style="width:162pt">Water absorption (%)</td>
			<td style="width:59pt"><?php if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") {
										echo number_format($row_select_pipe['sp_water_abr'], 2);
									} else {
										echo "-";
									} ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:20.25pt; width:30pt">3</td>
			<td style="width:162pt">Bulk density Kg/m3</td>
			<td style="width:59pt"><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0") {
										echo number_format($row_select_pipe['bdl'], 2);
									} else {
										echo "-";
									} ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td rowspan="10" style="height:222.75pt; width:30pt">4</td>
			<td rowspan="2" style="width:162pt">Gradation percent passing on IS Sieve</td>
			<td rowspan="2" style="width:59pt">&nbsp;</td>
			<td colspan="2" rowspan="2" style="width:218pt">Table 9 (Clause 6.3) Page No.7 PERCENTAGE PASSING FOR&nbsp; Z0NE I/&nbsp; II /&nbsp; III/ IV&nbsp;</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td style="height:16.5pt; width:162pt">10 mm</td>
			<td style="width:59pt"><?php echo number_format($row_select_pipe['pass_sample_1'], 2); ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:18.0pt; width:162pt">4.75 mm</td>
			<td style="width:59pt"><?php echo number_format($row_select_pipe['pass_sample_2'], 2); ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:18.0pt; width:162pt">2.36 mm</td>
			<td style="width:59pt"><?php echo number_format($row_select_pipe['pass_sample_3'], 2); ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:17.25pt; width:162pt">1.18 mm</td>
			<td style="width:59pt"><?php echo number_format($row_select_pipe['pass_sample_4'], 2); ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:17.25pt; width:162pt">600 Micron</td>
			<td style="width:59pt"><?php echo number_format($row_select_pipe['pass_sample_5'], 2); ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:16.5pt; width:162pt">300 Micron</td>
			<td style="width:59pt"><?php echo number_format($row_select_pipe['pass_sample_6'], 2); ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:16.5pt; width:162pt">150 Micron</td>
			<td style="width:59pt"><?php echo number_format($row_select_pipe['pass_sample_7'], 2); ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:162pt">75Micron</td>
			<td style="width:59pt">&nbsp;</td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:17.25pt; width:30pt">5</td>
			<td style="width:162pt">Fineness Modulus (F.M.)</td>
			<td style="width:59pt"><?php echo number_format($row_select_pipe['grd_fm'], 2); ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:16.5pt; width:30pt">6</td>
			<td style="width:162pt">ZONE (I/II/III/IV)</td>
			<td style="width:59pt"><?php echo $row_select_pipe['grd_zone']; ?></td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td rowspan="8" style="height:204.0pt; width:30pt">7</td>
			<td style="width:162pt">Deleterious Material / Silt content</td>
			<td style="width:59pt">&nbsp;</td>
			<td colspan="2" style="width:218pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:45.75pt; width:162pt">&nbsp;</td>
			<td style="width:59pt">&nbsp;</td>
			<td colspan="2" style="width:218pt">Uncrushed/&nbsp;&nbsp; Crushed/Mixed (in percentage by mass, Max)</td>
		</tr>
		<tr>
			<td style="height:16.5pt; width:162pt">i) Coal &amp; Lignite</td>
			<td style="width:59pt">&nbsp;</td>
			<td colspan="2" style="width:218pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1&nbsp; /&nbsp; 1</td>
		</tr>
		<tr>
			<td style="height:19.5pt; width:162pt">ii) Clay Lumps</td>
			<td style="width:59pt">&nbsp;</td>
			<td colspan="2" style="width:218pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1&nbsp;&nbsp; / 1</td>
		</tr>
		<tr>
			<td rowspan="2" style="height:51.0pt; width:162pt">iii) Material finer than 75 micron IS sieve (Silt content)</td>
			<td rowspan="2" style="width:59pt"><?php if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != null && $row_select_pipe['avg_finer'] != "0") {
													echo number_format($row_select_pipe['avg_finer'], 2);
												} else {
													echo "-";
												} ?></td>
			<td colspan="2" style="width:218pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3 (Uncrushed) / 15 (Crushed sand)</td>
		</tr>
		<tr>
			<td colspan="2" style="width:218pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 12 (for mixed sand)</td>
		</tr>
		<tr>
			<td style="height:21.75pt; width:162pt">iv) Shale</td>
			<td style="width:59pt">&nbsp;</td>
			<td colspan="2" style="width:218pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1 /&nbsp;&nbsp; -</td>
		</tr>
		<tr>
			<td style="height:17.25pt; width:162pt">Total of all the deleterious material</td>
			<td style="width:59pt">&nbsp;</td>
			<td colspan="2" style="width:218pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 5 /&nbsp; 2</td>
		</tr>
		<tr>
			<td style="height:39.75pt; width:30pt">8</td>
			<td style="width:162pt">Soundness (%)</td>
			<td style="width:59pt"><?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "0") {
										echo number_format($row_select_pipe['soundness'], 2);
									} else {
										echo "-";
									} ?></td>
			<td colspan="2" style="width:218pt">10% When tested with Na2SO4&nbsp;&nbsp; &amp;&nbsp; 15% When tested&nbsp; with&nbsp; MgSO4 &nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" style="height:15.75pt">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5">Items not conforming with IS specification shown by&nbsp;&nbsp;&nbsp;&nbsp; X</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:30pt">&nbsp;</td>
			<td style="width:162pt">7</td>
			<td style="width:59pt">8</td>
			<td style="width:170pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:30pt">&nbsp;</td>
			<td style="width:162pt">&nbsp;</td>
			<td style="width:59pt">&nbsp;</td>
			<td style="width:170pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5" style="height:15.0pt">Tested by: Chintan Maniyar</td>
		</tr>
		<tr>
			<td colspan="5" style="height:15.0pt">Checked by: Vishal Raiyani</td>
		</tr>
	</tbody>
</table>
