<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from upv WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'grade' => $result['grade'],
			'chk_upv' => $result['chk_upv'],
			'upv_detailes' => $result['upv_detailes'],
			'time_1' => $result['time_1'],
			'dist_1' => $result['dist_1'],
			'velo_1' => $result['velo_1'],
			'grading_1' => $result['grading_1'],
			'time_2' => $result['time_2'],
			'dist_2' => $result['dist_2'],
			'velo_2' => $result['velo_2'],
			'grading_2' => $result['grading_2'],
			'time_3' => $result['time_3'],
			'dist_3' => $result['dist_3'],
			'velo_3' => $result['velo_3'],
			'grading_3' => $result['grading_3'],
			'time_4' => $result['time_4'],
			'dist_4' => $result['dist_4'],
			'velo_4' => $result['velo_4'],
			'grading_4' => $result['grading_4'],
			'time_5' => $result['time_5'],
			'dist_5' => $result['dist_5'],
			'velo_5' => $result['velo_5'],
			'grading_5' => $result['grading_5']
		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr = $_POST['ulr'];

		$grade = $_POST['grade'];

		$upv_detailes = $_POST['upv_detailes'];
		$chk_upv = $_POST['chk_upv'];
		$time_1 = $_POST['time_1'];
		$dist_1 = $_POST['dist_1'];
		$velo_1 = $_POST['velo_1'];
		$grading_1 = $_POST['grading_1'];
		$time_2 = $_POST['time_2'];
		$dist_2 = $_POST['dist_2'];
		$velo_2 = $_POST['velo_2'];
		$grading_2 = $_POST['grading_2'];
		$time_3 = $_POST['time_3'];
		$dist_3 = $_POST['dist_3'];
		$velo_3 = $_POST['velo_3'];
		$grading_3 = $_POST['grading_3'];
		$time_4 = $_POST['time_4'];
		$dist_4 = $_POST['dist_4'];
		$velo_4 = $_POST['velo_4'];
		$grading_4 = $_POST['grading_4'];
		$time_5 = $_POST['time_5'];
		$dist_5 = $_POST['dist_5'];
		$velo_5 = $_POST['velo_5'];
		$grading_5 = $_POST['grading_5'];


		$curr_date = date("Y-m-d");

		$insert = "INSERT INTO `upv`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `grade`, `chk_upv`, `upv_detailes`, `time_1`, `dist_1`, `velo_1`, `grading_1`, `time_2`, `dist_2`, `velo_2`, `grading_2`, `time_3`, `dist_3`, `velo_3`, `grading_3`, `time_4`, `dist_4`, `velo_4`, `grading_4`, `time_5`, `dist_5`, `velo_5`, `grading_5`) VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$grade', '$chk_upv', '$upv_detailes', '$time_1', '$dist_1', '$velo_1', '$grading_1', '$time_2', '$dist_2', '$velo_2', '$grading_2', '$time_3', '$dist_3', '$velo_3', '$grading_3', '$time_4', '$dist_4', '$velo_4', '$grading_4', '$time_5', '$dist_5', '$velo_5', '$grading_5')";




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
							<th style="text-align:center;"><label>Time</label></th>
							<th style="text-align:center;"><label>Distance</label></th>



						</tr>
						<?php
						$query = "select * from upv WHERE lab_no='$lab_no' and `is_deleted`='0'";

						$result = mysqli_query($conn, $query);


						if (mysqli_num_rows($result) > 0) {
							while ($r = mysqli_fetch_array($result)) {

								if ($r['is_deleted'] == 0) {
						?>
									<tr>
										<td style="text-align:center;" width="10%">

											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
											<?php
											//$val =  $_SESSION['isadmin'];
											//if($val == 0 || $val == 5){
											?>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
											<?php
											//}
											?>
										</td>
										<!--<td style="text-align:center;"><?php //echo $r['report_no'];
																			?></td>-->
										<td style="text-align:center;"><?php echo $r['job_no']; ?></td>
										<td style="text-align:center;"><?php echo $r['lab_no']; ?></td>
										<td style="text-align:center;"><?php echo $r['time_1']; ?></td>
										<td style="text-align:center;"><?php echo $r['dist_1']; ?></td>
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


		$update = "update `upv` SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
		`ulr`='$_POST[ulr]',
		`grade`='$_POST[grade]',
		`chk_upv`='$_POST[chk_upv]',
		`upv_detailes`='$_POST[upv_detailes]',
		`time_1`='$_POST[time_1]',
		`dist_1`='$_POST[dist_1]',
		`velo_1`='$_POST[velo_1]',
		`grading_1`='$_POST[grading_1]',
		`time_2`='$_POST[time_2]',
		`dist_2`='$_POST[dist_2]',
		`velo_2`='$_POST[velo_2]',
		`grading_2`='$_POST[grading_2]',
		`time_3`='$_POST[time_3]',
		`dist_3`='$_POST[dist_3]',
		`velo_3`='$_POST[velo_3]',
		`grading_3`='$_POST[grading_3]',
		`time_4`='$_POST[time_4]',
		`dist_4`='$_POST[dist_4]',
		`velo_4`='$_POST[velo_4]',
		`grading_4`='$_POST[grading_4]',
		`time_5`='$_POST[time_5]',
		`dist_5`='$_POST[dist_5]',
		`velo_5`='$_POST[velo_5]',
		`grading_5`='$_POST[grading_5]',
		`checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);
		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update upv SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM upv WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update upv SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $cc);
			} else {
				$cc = "update upv SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	
	if ($_POST['action_type'] == 'set_sample_qty') {
		$trf_no = $_POST['trf_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$cc_sample_qty = $_POST['cc_sample_qty'];

		$upd_final = "update final_material_assign_master SET `cc_sample_qty`='$cc_sample_qty' WHERE `job_no`='$job_no' AND `lab_no`='$lab_no'";

		if (mysqli_query($conn, $upd_final)) {
			$fill = array('status' => 'success');
		} else {
			$fill = array('status' => 'failed');
		}
		echo json_encode($fill);
	}
	exit;
}
?>