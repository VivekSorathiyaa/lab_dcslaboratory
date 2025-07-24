<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from slump_test WHERE id='$_POST[id]' AND `is_deleted`='0'";
		$select_result = mysqli_query($conn, $get_query);
		$result = mysqli_fetch_array($select_result);
		$id = $result['id'];
		$report_no = $result['report_no'];
		$job_no = $result['job_no'];
		$lab_no = $result['lab_no'];
		$fill = array(
			'id' => $id,
			'report_no' => $report_no,
			'job_no' => $job_no,
			'lab_no' => $lab_no,
			'ulr' => $result['ulr'],
			'amend_date' => $result['amend_date'],
			'or_1' => $result['or_1'],
			'or_2' => $result['or_2'],
			'or_3' => $result['or_3'],
			'or_4' => $result['or_4'],
			'af_1' => $result['af_1'],
			'af_2' => $result['af_2'],
			'af_3' => $result['af_3'],
			'af_4' => $result['af_4'],
			'sl_1' => $result['sl_1'],
			'sl_2' => $result['sl_2'],
			'sl_3' => $result['sl_3'],
			'sl_4' => $result['sl_4'],
			'Admixture' => $result['Admixture'],
			'slm_temp' => $result['slm_temp'],
			'water' => $result['water'],
			'cement' => $result['cement'],
			'sl_5' => $result['sl_5'],
			'sl_6' => $result['sl_6'],
			'trial' => $result['trial'],
			'cement_1' => $result['cement_1'],
			'init' => $result['init'],
			'min_30' => $result['min_30'],
			'min_60' => $result['min_60'],
			'min_90' => $result['min_90'],
			'min_120' => $result['min_120'],
			'min_150' => $result['min_150']

		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$bitumin_grade =  $_POST['bitumin_grade'];
		$bitumin_make =  $_POST['bitumin_make'];
		$ulr =  $_POST['ulr'];
		$amend_date =  $_POST['amend_date'];


		$slm_temp = $_POST['slm_temp'];
		$or_1 = $_POST['or_1'];
		$or_2 = $_POST['or_2'];
		$or_3 = $_POST['or_3'];
		$or_4 = $_POST['or_4'];
		$af_1 = $_POST['af_1'];
		$af_2 = $_POST['af_2'];
		$af_3 = $_POST['af_3'];
		$af_4 = $_POST['af_4'];
		$sl_1 = $_POST['sl_1'];
		$sl_2 = $_POST['sl_2'];
		$sl_3 = $_POST['sl_3'];
		$sl_4 = $_POST['sl_4'];
		$Admixture = $_POST['Admixture'];
		$water = $_POST['water'];
		$cement = $_POST['cement'];
		$sl_5 = $_POST['sl_5'];
		$sl_6 = $_POST['sl_6'];
		$trial = $_POST['trial'];
		$cement_1 = $_POST['cement_1'];
		$init = $_POST['init'];
		$min_30 = $_POST['min_30'];
		$min_60 = $_POST['min_60'];
		$min_90 = $_POST['min_90'];
		$min_120 = $_POST['min_120'];
		$min_150 = $_POST['min_150'];		


		$insert = "insert into slump_test (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`,`slm_temp`,`or_1`,`or_2`,`or_3`,`or_4`,`af_1`,`af_2`,`af_3`,`af_4`,`sl_1`,`sl_2`,`sl_3`,`sl_4`,`Admixture`,`water`,`cement`,`sl_5`,`sl_6`,`trial`,`cement_1`,`init`,`min_30`,`min_60`,`min_90`,`min_120`,`min_150`,`amend_date`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$slm_temp', '$or_1', '$or_2', '$or_3', '$or_4', '$af_1', '$af_2', '$af_3', '$af_4', '$sl_1', '$sl_2', '$sl_3', '$sl_4', '$Admixture', '$water', '$cement', '$sl_5', '$sl_6', '$trial', '$cement_1', '$init', '$min_30', '$min_60', '$min_90', '$min_120', '$min_150', '$amend_date')";

		$result_of_insert = mysqli_query($conn, $insert);
		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'view') {
		$lab_no = $_POST['lab_no'];

?>
		<div id="display_data">
			<div class="row">
				<div class="col-lg-12">
					<table border="1px solid black" align="center" width="100%" id="aaaa">
						<tr>
							<th style="text-align:center;" width="10%"><label>Actions</label></th>
							<!--<th style="text-align:center;"><label>Report No.</label></th>-->
							<th style="text-align:center;"><label>Lab No.</label></th>
							<th style="text-align:center;"><label>Job No.</label></th>



						</tr>
						<?php
						$query = "select * from slump_test WHERE lab_no='$lab_no' and `is_deleted`='0'";

						$result = mysqli_query($conn, $query);


						if (mysqli_num_rows($result) > 0) {
							while ($r = mysqli_fetch_array($result)) {

								if ($r['is_deleted'] == 0) {
						?>
									<tr>
										<td style="text-align:center;" width="10%">

											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
											<?php
											//	$val =  $_SESSION['isadmin'];
											//	if($val == 0 || $val == 5){
											?>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
											<?php
											//	}
											?>
										</td>
										<!--<td style="text-align:center;"><?php //echo $r['report_no'];
																			?></td>-->
										<td style="text-align:center;"><?php echo $r['job_no']; ?></td>
										<td style="text-align:center;"><?php echo $r['lab_no']; ?></td>
									</tr>
						<?php
								}
							}
						}
						?>

					</table>
				</div>
			</div>

			<hr>
		</div>
		<br>
<?php

	} else if ($_POST['action_type'] == 'edit') {


		$curr_date = date("Y-m-d");

		$update = "update slump_test SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',`slm_temp`='$_POST[slm_temp]',`or_1`='$_POST[or_1]',`or_2`='$_POST[or_2]',`or_3`='$_POST[or_3]',`or_4`='$_POST[or_4]',`af_1`='$_POST[af_1]',`af_2`='$_POST[af_2]',`af_3`='$_POST[af_3]',`af_4`='$_POST[af_4]',`sl_1`='$_POST[sl_1]',`sl_2`='$_POST[sl_2]',`sl_3`='$_POST[sl_3]',
		 `sl_4`='$_POST[sl_4]',
		 `Admixture`='$_POST[Admixture]',
		 `water`='$_POST[water]',
`cement`='$_POST[cement]',
`sl_5`='$_POST[sl_5]',
`sl_6`='$_POST[sl_6]',
`trial`='$_POST[trial]',
`cement_1`='$_POST[cement_1]',
`init`='$_POST[init]',
`min_30`='$_POST[min_30]',
`min_60`='$_POST[min_60]',
`min_90`='$_POST[min_90]',
`min_120`='$_POST[min_120]',
`min_150`='$_POST[min_150]',
`amend_date`='$_POST[amend_date]',

		 `checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update slump_test SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM slump_test WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update slump_test SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update slump_test SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>