<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<?php
$job_no = $_GET['job_no'];
$lab_no = $_GET['lab_no'];
$report_no = $_GET['report_no'];
$trf_no = $_GET['trf_no'];
$select_tiles_query = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
<table border="1" cellspacing="0" style="width:551pt">
	<tbody>
		<tr>
			<td colspan="16" style="width:520pt"><a name="RANGE!A1:Q30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; M-5</a></td>
		</tr>
		<tr>
			<td colspan="16">TITLE : TEST RESULT OF&nbsp; STEEL</td>
		</tr>
		<tr>
			<td colspan="16" style="height:25.5pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="16">Name of work :&nbsp; <?php echo $name_of_work; ?>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="16" style="height:31.5pt">Details of sample :</td>
		</tr>
		<tr>
			<td colspan="9" style="height:38.25pt">1. Samples sent by : <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																		$result_selectc = mysqli_query($conn, $select_queryc);

																		if (mysqli_num_rows($result_selectc) > 0) {
																			$row_selectc = mysqli_fetch_assoc($result_selectc);
																			$ct_nm = $row_selectc['city_name'];
																		}
																		echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?></td>
			<td colspan="7" style="width:220pt">2.Vide letter No.:&nbsp; <?php echo $r_name; ?></td>
		</tr>
		<tr>
			<td colspan="9" style="height:37.5pt">3. Samples brought by: <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
																			$result_selectc1 = mysqli_query($conn, $select_queryc1);

																			if (mysqli_num_rows($result_selectc1) > 0) {
																				$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																				$ct_nm1 = $row_selectc1['city_name'];
																			}
																			echo $agency_name . " " . $ct_nm1; ?></td>
			<td colspan="7" style="width:220pt">4.Identification marks:&nbsp;</td>
		</tr>
		<tr>
			<td colspan="9">5. Condition of sample :&nbsp; --</td>
			<td colspan="7" style="width:220pt">6.Name of manufacture :&nbsp; <?php echo $row_select_pipe['brand']; ?></td>
		</tr>
		<tr>
			<td colspan="9" style="height:26.25pt">7. Type of steel: <?php echo $row_select_pipe['grade']; ?></td>
			<td colspan="7" style="width:220pt">8.Date of sampling: <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
		</tr>
		<tr>
			<td colspan="9" style="height:27.0pt">9. Sampling done by: <?php echo $sample_sent_by; ?></td>
			<td colspan="7" style="width:220pt">10.Method of sampling : As per IS</td>
		</tr>
		<tr>
			<td colspan="9" style="height:25.5pt; width:300pt">11.Quantity from which sample collected: 03 Nos</td>
			<td colspan="7" style="width:220pt">12.Purpose of testing : Ok or Not&nbsp; &nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td colspan="9">13. Laboratory No.: <?php echo $row_select_pipe['job_no']; ?></td>
			<td colspan="7" style="width:220pt">14.Job No : <?php echo $row_select_pipe['lab_no']; ?></td>
		</tr>
		<tr>
			<td style="height:21.75pt">&nbsp;</td>
			<td colspan="15">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:21.75pt">&nbsp;</td>
			<td colspan="15">Physical Properties&nbsp; :</td>
		</tr>
		<tr>
			<td rowspan="4" style="height:114.0pt; width:20pt">Sr. No.</td>
			<td style="width:56pt">Tests</td>
			<td colspan="7" style="width:224pt">Results obtained</td>
			<td colspan="7" style="width:220pt">Requirement as per IS : 1786-2008 (Minimum)&nbsp;</td>
		</tr>
		<tr>
			<td rowspan="2" style="height:57.0pt; width:56pt">Lab No.</td>
			<td rowspan="2">&nbsp;</td>
			<td rowspan="2">&nbsp;</td>
			<td rowspan="2">&nbsp;</td>
			<td rowspan="2">&nbsp;</td>
			<td rowspan="2">&nbsp;</td>
			<td rowspan="2">&nbsp;</td>
			<td rowspan="2">&nbsp;</td>
			<td colspan="7" style="width:220pt">Grade Fe 500 / Grade Fe 415</td>
		</tr>
		<tr>
			<td style="height:12.75pt">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="height:12.75pt; width:56pt">Dia. In mm</td>
			<td><?php echo $row_select_pipe['dia'] . " mm "; ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="height:84.0pt">1</td>
			<td style="width:56pt">1.&nbsp; Ultimate tensile Strength (N/mm2)</td>
			<td><?php if ($row_select_pipe['ten_1'] != "" && $row_select_pipe['ten_1'] != null && $row_select_pipe['ten_1'] != "0") {
					echo $row_select_pipe['ten_1'];
				} else {
					echo "-";
				} ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="7" style="width:220pt">For Fe 500 : Ultimate Tensile strength must be 8% more than the&nbsp; yiled stress but not less than 545 N/mm2&nbsp; For Fe 415 : Ultimate Tensile strength must be 10% more then&nbsp; yiled stress but not less than 485 N/mm2 ,&nbsp;</td>
		</tr>
		<tr>
			<td style="height:61.5pt">2</td>
			<td style="width:56pt">2. Yeild stress (Proof stress ) N/mm2</td>
			<td><?php if ($row_select_pipe['ys_1'] != "" && $row_select_pipe['ys_1'] != null && $row_select_pipe['ys_1'] != "0") {
					echo $row_select_pipe['ys_1'];
				} else {
					echo "-";
				} ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="7">&nbsp;&nbsp;For Fe 500 :500 N/mm2&nbsp; /&nbsp; For Fe 415 : 415 N/mm2</td>
		</tr>
		<tr>
			<td style="height:27.0pt">3</td>
			<td style="width:56pt">3.Elongation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; percentage</td>
			<td><?php if ($row_select_pipe['elo_1'] != "" && $row_select_pipe['elo_1'] != null && $row_select_pipe['elo_1'] != "0") {
					echo $row_select_pipe['elo_1'];
				} else {
					echo "-";
				} ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="7">&nbsp;For Fe 500 :12%&nbsp; /&nbsp; For Fe 415 : 14.5%</td>
		</tr>
		<tr>
			<td style="height:12.75pt">&nbsp;</td>
			<td colspan="15">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:12.75pt">&nbsp;</td>
			<td colspan="15" style="width:500pt">Items not confirming with IS specification shown by&nbsp; X</td>
		</tr>
		<tr>
			<td style="height:12.75pt">&nbsp;</td>
			<td style="width:56pt">1</td>
			<td colspan="2" style="width:64pt">2</td>
			<td colspan="2" style="width:64pt">3</td>
			<td colspan="10" style="width:316pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:12.75pt">&nbsp;</td>
			<td colspan="15">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:12.75pt">&nbsp;</td>
			<td colspan="15">Tested by :&nbsp; Soumya Ranjan</td>
		</tr>
		<tr>
			<td style="height:12.75pt">&nbsp;</td>
			<td colspan="15">Checked by :&nbsp; Vishal Raiyani</td>
		</tr>
		<tr>
			<td style="height:12.75pt">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="3">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="height:12.75pt">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="height:12.75pt">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
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
