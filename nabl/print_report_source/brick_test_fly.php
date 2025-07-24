<?php
session_start();
include("../connection.php");
error_reporting(1); ?>

<?php
$job_no = $_GET['job_no'];
$lab_no = $_GET['lab_no'];
$report_no = $_GET['report_no'];
$trf_no = $_GET['trf_no'];
$select_tiles_query = "select * from span_brick_fly WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$mark = $row_select4['brick_mark'];
	$brick_specification = $row_select4['brick_specification'];
	$material_location = $row_select4['material_location'];
}


?>
<table border="1" cellspacing="0" style="width:444pt">
	<tbody>
		<tr>
			<td colspan="7" style="height:15.75pt; width:444pt">(M-4)</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.0pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7">TITLE: TEST RESULTS OF&nbsp; BRICKS</td>
		</tr>
		<tr>
			<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Clay / Fly ash)</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">Name of work: <?php echo $name_of_work; ?>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.0pt">Details of Sample :</td>
		</tr>
		<tr>
			<td colspan="4">01&nbsp; Sample sent by : - <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
														$result_selectc = mysqli_query($conn, $select_queryc);

														if (mysqli_num_rows($result_selectc) > 0) {
															$row_selectc = mysqli_fetch_assoc($result_selectc);
															$ct_nm = $row_selectc['city_name'];
														}
														echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?></td>
			<td colspan="3">02&nbsp; Received vide letter No. : - <?php echo $r_name; ?></td>
		</tr>
		<tr>
			<td colspan="4">03&nbsp; Sample brought by : - <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
															$result_selectc1 = mysqli_query($conn, $select_queryc1);

															if (mysqli_num_rows($result_selectc1) > 0) {
																$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																$ct_nm1 = $row_selectc1['city_name'];
															}
															echo $agency_name . " " . $ct_nm1; ?></td>
			<td colspan="3">04 &nbsp;Identification mark : - <?php echo $mark; ?></td>
		</tr>
		<tr>
			<td colspan="4">05 &nbsp;Condition of Sample : <?php echo $con_sample; ?></td>
			<td colspan="3">06&nbsp; Name of Manufacturer : -</td>
		</tr>
		<tr>
			<td colspan="4">07&nbsp; Types of Material : - Flyash Bricks</td>
			<td colspan="3">08&nbsp; Date of casting : - </td>
		</tr>
		<tr>
			<td colspan="4">09&nbsp; Method of Sampling :- As per IS</td>
			<td colspan="3">10 &nbsp;Quantity from which sample collected : - 20 Nos.</td>
		</tr>
		<tr>
			<td colspan="4">11&nbsp; Sampling done by : - <?php echo $sample_sent_by; ?></td>
			<td colspan="3">12 &nbsp;Purpose of testing : - ok / not</td>
		</tr>
		<tr>
			<td colspan="4">13&nbsp;&nbsp; Laboratory No. : - <?php echo $row_select_pipe['job_no']; ?></td>
			<td colspan="3">14&nbsp; Job No : - <?php echo $row_select_pipe['lab_no']; ?></td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.0pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.0pt">1. Dimensions Tolerances</td>
		</tr>
		<tr>
			<td colspan="2" style="height:60.75pt; width:130pt">Tests</td>
			<td colspan="2" style="width:98pt">Results obtained</td>
			<td colspan="3" style="width:216pt">Requirement as per IS:1077-1992 / IS : 13757-1993-Reaffirmed-2007&nbsp; (per 20 bricks)</td>
		</tr>
		<tr>
			<td style="height:35.25pt; width:36pt">(i)</td>
			<td style="width:94pt">Length mm</td>
			<td colspan="2" style="width:98pt"><?php echo $row_select_pipe['avg_length']; ?></td>
			<td colspan="3" style="width:216pt">4520 to 4680 mm</td>
		</tr>
		<tr>
			<td style="height:15.0pt; width:36pt">(ii)</td>
			<td style="width:94pt">Width mm</td>
			<td colspan="2" style="width:98pt"><?php echo $row_select_pipe['avg_width']; ?></td>
			<td colspan="3" style="width:216pt">2160 to 2240 mm</td>
		</tr>
		<tr>
			<td style="height:29.25pt; width:36pt">(iii)</td>
			<td style="width:94pt">Height mm</td>
			<td colspan="2" style="width:98pt"><?php echo $row_select_pipe['avg_height']; ?></td>
			<td colspan="3" style="width:216pt">1360 to 1440 mm</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.0pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">2. Physical Tests:</td>
		</tr>
		<tr>
			<td colspan="2" style="height:47.25pt; width:130pt">Tests</td>
			<td colspan="2" style="width:98pt">Results obtained</td>
			<td colspan="3" style="width:216pt">Requirement as per IS:1077-1992 /&nbsp; IS : 13757-1993-Reaffirmed-2007</td>
		</tr>
		<tr>
			<td style="height:76.5pt; width:36pt">(i)</td>
			<td style="width:94pt">Compressive Strength (N/mm2)</td>
			<td colspan="2" style="width:98pt"><?php echo $row_select_pipe['avg_com']; ?></td>
			<td colspan="3" style="width:216pt">The minimum average compressive strength for various class as per clause 4.1 of IS 1077-1992 / IS : 13757-1993*</td>
		</tr>
		<tr>
			<td style="height:60.0pt; width:36pt">(ii)</td>
			<td style="width:94pt">Water Absorption (%)</td>
			<td colspan="2" style="width:98pt"><?php echo $row_select_pipe['avg_wtr']; ?></td>
			<td colspan="3" style="width:216pt">Average should not be more than 20% for class up to 12.5 &amp; 15% for higher classes.</td>
		</tr>
		<tr>
			<td style="height:45.0pt; width:36pt">(iii)</td>
			<td style="width:94pt">Efflorescence</td>
			<td colspan="2" style="width:98pt"><?php echo $row_select_pipe['rbt_efflo5']; ?></td>
			<td colspan="3" style="width:216pt">Not more than Moderate up to class 12.5 and slight for higher classes.</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.0pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">Items not confirming with IS specification shown by: </td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">1 (i) / 1 (ii) / 1 (iii) / 2 (i) / 2 (ii) / 2 (iii)</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">* The tested brick falls in class :<u><?php echo $brick_specification; ?></u></td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">Classes of Common Burnt ClayBricks clause 4.1 in Is 1077-1992</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.0pt; width:444pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:31.5pt">&nbsp;</td>
			<td rowspan="2" style="width:94pt">Class Designation</td>
			<td colspan="5" style="width:314pt">Average compressive Strength not Less than</td>
		</tr>
		<tr>
			<td style="height:19.5pt">&nbsp;</td>
			<td colspan="2" style="width:98pt">N/mm2</td>
			<td colspan="3" style="width:216pt">(Kg/Cm2) (Approx)</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">35</td>
			<td colspan="2" style="width:98pt">35</td>
			<td colspan="3" style="width:216pt">350</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">30</td>
			<td colspan="2" style="width:98pt">30</td>
			<td colspan="3" style="width:216pt">300</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">25</td>
			<td colspan="2" style="width:98pt">25</td>
			<td colspan="3" style="width:216pt">250</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">20</td>
			<td colspan="2" style="width:98pt">20</td>
			<td colspan="3" style="width:216pt">200</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">17.5</td>
			<td colspan="2" style="width:98pt">17.5</td>
			<td colspan="3" style="width:216pt">175</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">15</td>
			<td colspan="2" style="width:98pt">15</td>
			<td colspan="3" style="width:216pt">150</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">12.5</td>
			<td colspan="2" style="width:98pt">12.5</td>
			<td colspan="3" style="width:216pt">125</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">10</td>
			<td colspan="2" style="width:98pt">10</td>
			<td colspan="3" style="width:216pt">100</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">7.5</td>
			<td colspan="2" style="width:98pt">7.5</td>
			<td colspan="3" style="width:216pt">75</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">5</td>
			<td colspan="2" style="width:98pt">5</td>
			<td colspan="3" style="width:216pt">50</td>
		</tr>
		<tr>
			<td style="height:15.0pt">&nbsp;</td>
			<td style="width:94pt">3.5</td>
			<td colspan="2" style="width:98pt">3.5</td>
			<td colspan="3" style="width:216pt">35</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.0pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">Tested by: Akash Goti</td>
		</tr>
		<tr>
			<td colspan="7" style="height:15.75pt">Checked by: Vishal Raiyani</td>
		</tr>
	</tbody>
</table>
