<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from carbonation_depth WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'loc_7' => $result['loc_7'],
			'loc_8' => $result['loc_8'],
			'val_1' => $result['val_1'],
			'val_2' => $result['val_2'],
			'val_3' => $result['val_3'],
			'val_4' => $result['val_4'],
			'val_5' => $result['val_5'],
			'val_6' => $result['val_6'],
			'val_7' => $result['val_7'],
			'val_8' => $result['val_8'],
			'corr_1' => $result['corr_1'],
			'corr_2' => $result['corr_2'],
			'corr_3' => $result['corr_3'],
			'corr_4' => $result['corr_4'],
			'corr_5' => $result['corr_5'],
			'corr_6' => $result['corr_6'],
			'corr_7' => $result['corr_7'],
			'corr_8' => $result['corr_8'],
			'con_1' => $result['con_1'],
			'con_2' => $result['con_2'],
			'con_3' => $result['con_3'],
			'con_4' => $result['con_4'],
			'con_5' => $result['con_5'],
			'con_6' => $result['con_6'],
			'con_7' => $result['con_7'],
			'con_8' => $result['con_8'],
			'volt_1' => $result['volt_1'],
			'volt_2' => $result['volt_2'],
			'volt_3' => $result['volt_3'],
			'volt_4' => $result['volt_4'],
			'volt_5' => $result['volt_5'],
			'volt_6' => $result['volt_6'],
			'volt_7' => $result['volt_7'],
			'volt_8' => $result['volt_8'],
			'rem_1' => $result['rem_1'],
			'rem_2' => $result['rem_2'],
			'rem_3' => $result['rem_3'],
			'rem_4' => $result['rem_4'],
			'rem_5' => $result['rem_5'],
			'rem_6' => $result['rem_6'],
			'rem_7' => $result['rem_7'],
			'rem_8' => $result['rem_8'],
			'ph_1' => $result['ph_1'],
			'ph_2' => $result['ph_2'],
			'ph_3' => $result['ph_3'],
			'ph_4' => $result['ph_4'],
			'ph_5' => $result['ph_5'],
			'ph_6' => $result['ph_6'],
			'ph_7' => $result['ph_7'],
			'ph_8' => $result['ph_8'],
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
		$loc_7 = $_POST['loc_7'];
		$loc_8 = $_POST['loc_8'];
		$val_1 = $_POST['val_1'];
		$val_2 = $_POST['val_2'];
		$val_3 = $_POST['val_3'];
		$val_4 = $_POST['val_4'];
		$val_5 = $_POST['val_5'];
		$val_6 = $_POST['val_6'];
		$val_7 = $_POST['val_7'];
		$val_8 = $_POST['val_8'];
		$corr_1 = $_POST['corr_1'];
		$corr_2 = $_POST['corr_2'];
		$corr_3 = $_POST['corr_3'];
		$corr_4 = $_POST['corr_4'];
		$corr_5 = $_POST['corr_5'];
		$corr_6 = $_POST['corr_6'];
		$corr_7 = $_POST['corr_7'];
		$corr_8 = $_POST['corr_8'];
		$con_1 = $_POST['con_1'];
		$con_2 = $_POST['con_2'];
		$con_3 = $_POST['con_3'];
		$con_4 = $_POST['con_4'];
		$con_5 = $_POST['con_5'];
		$con_6 = $_POST['con_6'];
		$con_7 = $_POST['con_7'];
		$con_8 = $_POST['con_8'];
		$volt_1 = $_POST['volt_1'];
		$volt_2 = $_POST['volt_2'];
		$volt_3 = $_POST['volt_3'];
		$volt_4 = $_POST['volt_4'];
		$volt_5 = $_POST['volt_5'];
		$volt_6 = $_POST['volt_6'];
		$volt_7 = $_POST['volt_7'];
		$volt_8 = $_POST['volt_8'];
		$rem_1 = $_POST['rem_1'];
		$rem_2 = $_POST['rem_2'];
		$rem_3 = $_POST['rem_3'];
		$rem_4 = $_POST['rem_4'];
		$rem_5 = $_POST['rem_5'];
		$rem_6 = $_POST['rem_6'];
		$rem_7 = $_POST['rem_7'];
		$rem_8 = $_POST['rem_8'];
		$ph_1 = $_POST['ph_1'];
		$ph_2 = $_POST['ph_2'];
		$ph_3 = $_POST['ph_3'];
		$ph_4 = $_POST['ph_4'];
		$ph_5 = $_POST['ph_5'];
		$ph_6 = $_POST['ph_6'];
		$ph_7 = $_POST['ph_7'];
		$ph_8 = $_POST['ph_8'];


		$insert = "insert into carbonation_depth (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`,`temp`,`loc_1`,`loc_2`,`loc_3`,`loc_4`,`loc_5`,`loc_6`,`loc_7`,`loc_8`,`val_1`,`val_2`,`val_3`,`val_4`,`val_5`,`val_6`,`val_7`,`val_8`,`corr_1`,`corr_2`,`corr_3`,`corr_4`,`corr_5`,`corr_6`,`corr_7`,`corr_8`,`con_1`,`con_2`,`con_3`,`con_4`,`con_5`,`con_6`,`con_7`,`con_8`,`volt_1`,`volt_2`,`volt_3`,`volt_4`,`volt_5`,`volt_6`,`volt_7`,`volt_8`,`rem_1`,`rem_2`,`rem_3`,`rem_4`,`rem_5`,`rem_6`,`rem_7`,`rem_8`,`ph_1`,`ph_2`,`ph_3`,`ph_4`,`ph_5`,`ph_6`,`ph_7`,`ph_8`,`amend_date`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$temp','$loc_1','$loc_2','$loc_3','$loc_4','$loc_5','$loc_6','$loc_7','$loc_8','$val_1','$val_2','$val_3','$val_4','$val_5','$val_6','$val_7','$val_8','$corr_1','$corr_2','$corr_3','$corr_4','$corr_5','$corr_6','$corr_7','$corr_8','$con_1','$con_2','$con_3','$con_4','$con_5','$con_6','$con_7','$con_8','$volt_1','$volt_2','$volt_3','$volt_4','$volt_5','$volt_6','$volt_7','$volt_8','$rem_1','$rem_2','$rem_3','$rem_4','$rem_5','$rem_6','$rem_7','$rem_8','$ph_1','$ph_2','$ph_3','$ph_4','$ph_5','$ph_6','$ph_7','$ph_8','$amend_date')";

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
						$query = "select * from carbonation_depth WHERE lab_no='$lab_no' and `is_deleted`='0'";

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

		$update = "update carbonation_depth SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',`temp`='$_POST[temp]',`loc_1`='$_POST[loc_1]',`loc_2`='$_POST[loc_2]',`loc_3`='$_POST[loc_3]',`loc_4`='$_POST[loc_4]',`loc_5`='$_POST[loc_5]',`loc_6`='$_POST[loc_6]',`loc_7`='$_POST[loc_7]',`loc_8`='$_POST[loc_8]',`val_1`='$_POST[val_1]',`val_2`='$_POST[val_2]',`val_3`='$_POST[val_3]',`val_4`='$_POST[val_4]',`val_5`='$_POST[val_5]',`val_6`='$_POST[val_6]',`val_7`='$_POST[val_7]',`val_8`='$_POST[val_8]',`corr_1`='$_POST[corr_1]',`corr_2`='$_POST[corr_2]',`corr_3`='$_POST[corr_3]',`corr_4`='$_POST[corr_4]',`corr_5`='$_POST[corr_5]',`corr_6`='$_POST[corr_6]',`corr_7`='$_POST[corr_7]',`corr_8`='$_POST[corr_8]',`con_1`='$_POST[con_1]',`con_2`='$_POST[con_2]',`con_3`='$_POST[con_3]',`con_4`='$_POST[con_4]',`con_5`='$_POST[con_5]',`con_6`='$_POST[con_6]',`con_7`='$_POST[con_7]',`con_8`='$_POST[con_8]',`volt_1`='$_POST[volt_1]',`volt_2`='$_POST[volt_2]',`volt_3`='$_POST[volt_3]',`volt_4`='$_POST[volt_4]',`volt_5`='$_POST[volt_5]',`volt_6`='$_POST[volt_6]',`volt_7`='$_POST[volt_7]',`volt_8`='$_POST[volt_8]',`rem_1`='$_POST[rem_1]',`rem_2`='$_POST[rem_2]',`rem_3`='$_POST[rem_3]',`rem_4`='$_POST[rem_4]',`rem_5`='$_POST[rem_5]',`rem_6`='$_POST[rem_6]',`rem_7`='$_POST[rem_7]',`rem_8`='$_POST[rem_8]',`ph_1`='$_POST[ph_1]',`ph_2`='$_POST[ph_2]',`ph_3`='$_POST[ph_3]',`ph_4`='$_POST[ph_4]',`ph_5`='$_POST[ph_5]',`ph_6`='$_POST[ph_6]',`ph_7`='$_POST[ph_7]',`ph_8`='$_POST[ph_8]',`amend_date`='$_POST[amend_date]',`checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update carbonation_depth SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM carbonation_depth WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update carbonation_depth SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update carbonation_depth SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>