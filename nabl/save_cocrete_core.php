<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from cocrete_core WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'mar_1' => $result['mar_1'],
			'mar_2' => $result['mar_2'],
			'mar_3' => $result['mar_3'],
			'dia_1' => $result['dia_1'],
			'dia_2' => $result['dia_2'],
			'dia_3' => $result['dia_3'],
			'len_1' => $result['len_1'],
			'len_2' => $result['len_2'],
			'len_3' => $result['len_3'],
			'corr_1' => $result['corr_1'],
			'corr_2' => $result['corr_2'],
			'corr_3' => $result['corr_3'],
			'load_1' => $result['load_1'],
			'load_2' => $result['load_2'],
			'load_3' => $result['load_3'],
			'com_1' => $result['com_1'],
			'com_2' => $result['com_2'],
			'com_3' => $result['com_3'],
			'ccc_1' => $result['ccc_1'],
			'ccc_2' => $result['ccc_2'],
			'ccc_3' => $result['ccc_3'],
			'ecs_1' => $result['ecs_1'],
			'ecs_2' => $result['ecs_2'],
			'ecs_3' => $result['ecs_3']


		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$bitumin_grade =  $_POST['bitumin_grade'];
		$bitumin_make =  $_POST['bitumin_make'];
		$ulr =  $_POST['ulr'];


		$mar_1 = $_POST['mar_1'];
		$mar_2 = $_POST['mar_2'];
		$mar_3 = $_POST['mar_3'];
		$len_1 = $_POST['len_1'];
		$len_2 = $_POST['len_2'];
		$len_3 = $_POST['len_3'];
		$dia_1 = $_POST['dia_1'];
		$dia_2 = $_POST['dia_2'];
		$dia_3 = $_POST['dia_3'];
		$corr_1 = $_POST['corr_1'];
		$corr_2 = $_POST['corr_2'];
		$corr_3 = $_POST['corr_3'];
		$load_1 = $_POST['load_1'];
		$load_2 = $_POST['load_2'];
		$load_3 = $_POST['load_3'];
		$com_1 = $_POST['com_1'];
		$com_2 = $_POST['com_2'];
		$com_3 = $_POST['com_3'];
		$ccc_1 = $_POST['ccc_1'];
		$ccc_2 = $_POST['ccc_2'];
		$ccc_3 = $_POST['ccc_3'];
		$ecs_1 = $_POST['ecs_1'];
		$ecs_2 = $_POST['ecs_2'];
		$ecs_3 = $_POST['ecs_3'];


		$insert = "insert into cocrete_core (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`,`mar_1`,`mar_2`,`mar_3`,`len_1`,`len_2`,`len_3`,`dia_1`,`dia_2`,`dia_3`,`corr_1`,`corr_2`,`corr_3`,`load_1`,`load_2`,`load_3`,`com_1`,`com_2`,`com_3`,`ccc_1`,`ccc_2`,`ccc_3`,`ecs_1`,`ecs_2`,`ecs_3`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$mar_1', '$mar_2', '$mar_3', '$len_1', '$len_2', '$len_3', '$dia_1', '$dia_2', '$dia_3', '$corr_1', '$corr_2', '$corr_3','$load_1','$load_2','$load_3','$com_1','$com_2','$com_3','$ccc_1','$ccc_2','$ccc_3','$ecs_1','$ecs_2','$ecs_3')";

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
						$query = "select * from cocrete_core WHERE lab_no='$lab_no' and `is_deleted`='0'";

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

		$update = "update cocrete_core SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',`mar_1`='$_POST[mar_1]',`mar_2`='$_POST[mar_2]',`mar_3`='$_POST[mar_3]',`len_1`='$_POST[len_1]',`len_2`='$_POST[len_2]',`len_3`='$_POST[len_3]',`dia_1`='$_POST[dia_1]',`dia_2`='$_POST[dia_2]',`dia_3`='$_POST[dia_3]',`corr_1`='$_POST[corr_1]',`corr_2`='$_POST[corr_2]',`corr_3`='$_POST[corr_3]',`load_1`='$_POST[load_1]',`load_2`='$_POST[load_2]',`load_3`='$_POST[load_3]',`com_1`='$_POST[com_1]',`com_2`='$_POST[com_2]',`com_3`='$_POST[com_3]',`ccc_1`='$_POST[ccc_1]',`ccc_2`='$_POST[ccc_2]',`ccc_3`='$_POST[ccc_3]',`ecs_1`='$_POST[ecs_1]',`ecs_2`='$_POST[ecs_2]',`ecs_3`='$_POST[ecs_3]',`checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update cocrete_core SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM cocrete_core WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update cocrete_core SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update cocrete_core SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>