<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from concrete_cover WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'loc_1' => $result['loc_1'],
			'loc_2' => $result['loc_2'],
			'loc_3' => $result['loc_3'],
			'loc_4' => $result['loc_4'],
			'loc_5' => $result['loc_5'],
			'loc_6' => $result['loc_6'],
			'con_1' => $result['con_1'],
			'con_2' => $result['con_2'],
			'con_3' => $result['con_3'],
			'con_4' => $result['con_4'],
			'con_5' => $result['con_5'],
			'con_6' => $result['con_6'],
			'cov_1' => $result['cov_1'],
			'cov_2' => $result['cov_2'],
			'cov_3' => $result['cov_3'],
			'cov_4' => $result['cov_4'],
			'cov_5' => $result['cov_5'],
			'cov_6' => $result['cov_6'],
			'ele_1' => $result['ele_1'],
			'ele_2' => $result['ele_2'],
			'ele_3' => $result['ele_3'],
			'ele_4' => $result['ele_4'],
			'ele_5' => $result['ele_5'],
			'ele_6' => $result['ele_6'],
			'rem_1' => $result['rem_1'],
			'rem_2' => $result['rem_2'],
			'rem_3' => $result['rem_3'],
			'rem_4' => $result['rem_4'],
			'rem_5' => $result['rem_5'],
			'rem_6' => $result['rem_6'],
			'temp' => $result['temp']


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


		$temp = $_POST['temp'];
		$loc_1 = $_POST['loc_1'];
		$loc_2 = $_POST['loc_2'];
		$loc_3 = $_POST['loc_3'];
		$loc_4 = $_POST['loc_4'];
		$loc_5 = $_POST['loc_5'];
		$loc_6 = $_POST['loc_6'];
		$con_1 = $_POST['con_1'];
		$con_2 = $_POST['con_2'];
		$con_3 = $_POST['con_3'];
		$con_4 = $_POST['con_4'];
		$con_5 = $_POST['con_5'];
		$con_6 = $_POST['con_6'];
		$cov_1 = $_POST['cov_1'];
		$cov_2 = $_POST['cov_2'];
		$cov_3 = $_POST['cov_3'];
		$cov_4 = $_POST['cov_4'];
		$cov_5 = $_POST['cov_5'];
		$cov_6 = $_POST['cov_6'];
		$ele_1 = $_POST['ele_1'];
		$ele_2 = $_POST['ele_2'];
		$ele_3 = $_POST['ele_3'];
		$ele_4 = $_POST['ele_4'];
		$ele_5 = $_POST['ele_5'];
		$ele_6 = $_POST['ele_6'];
		$rem_1 = $_POST['rem_1'];
		$rem_2 = $_POST['rem_2'];
		$rem_3 = $_POST['rem_3'];
		$rem_4 = $_POST['rem_4'];
		$rem_5 = $_POST['rem_5'];
		$rem_6 = $_POST['rem_6'];


		$insert = "insert into concrete_cover (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `loc_1`, `loc_2`, `loc_3`, `loc_4`, `loc_5`, `loc_6`, `con_1`, `con_2`, `con_3`, `con_4`, `con_5`, `con_6`, `ele_1`, `ele_2`, `ele_3`, `ele_4`, `ele_5`, `ele_6`, `cov_1`, `cov_2`, `cov_3`, `cov_4`, `cov_5`, `cov_6`, `rem_1`, `rem_2`, `rem_3`, `rem_4`, `rem_5`, `rem_6`, `temp`, `amend_date`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$loc_1','$loc_2','$loc_3','$loc_4','$loc_5','$loc_6','$con_1', '$con_2', '$con_3', '$con_4', '$con_5', '$con_6','$ele_1', '$ele_2', '$ele_3', '$ele_4', '$ele_5', '$ele_6','$cov_1', '$cov_2', '$cov_3', '$cov_4', '$cov_5', '$cov_6','$rem_1', '$rem_2', '$rem_3', '$rem_4', '$rem_5', '$rem_6', '$temp', '$amend_date')";

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
						$query = "select * from concrete_cover WHERE lab_no='$lab_no' and `is_deleted`='0'";

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

		$update = "update concrete_cover SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',`loc_1`='$_POST[loc_1]',`loc_2`='$_POST[loc_2]',`loc_3`='$_POST[loc_3]',`loc_4`='$_POST[loc_4]',`loc_5`='$_POST[loc_5]',`loc_6`='$_POST[loc_6]',`con_1`='$_POST[con_1]',`con_2`='$_POST[con_2]',`con_3`='$_POST[con_3]',`con_4`='$_POST[con_4]',`con_5`='$_POST[con_5]',`con_6`='$_POST[con_6]',`rem_1`='$_POST[rem_1]',`rem_2`='$_POST[rem_2]',`rem_3`='$_POST[rem_3]',`rem_4`='$_POST[rem_4]',`rem_5`='$_POST[rem_5]',`rem_6`='$_POST[rem_6]',`cov_1`='$_POST[cov_1]',`cov_2`='$_POST[cov_2]',`cov_3`='$_POST[cov_3]',`cov_4`='$_POST[cov_4]',`cov_5`='$_POST[cov_5]',`cov_6`='$_POST[cov_6]',`ele_1`='$_POST[ele_1]',`ele_2`='$_POST[ele_2]',`ele_3`='$_POST[ele_3]',`ele_4`='$_POST[ele_4]',`ele_5`='$_POST[ele_5]',`ele_6`='$_POST[ele_6]',`temp`='$_POST[temp]',`amend_date`='$_POST[amend_date]',`checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update concrete_cover SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM concrete_cover WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update concrete_cover SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update concrete_cover SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>