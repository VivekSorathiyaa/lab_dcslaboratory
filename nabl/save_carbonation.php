<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from carbonation WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'len_1' => $result['len_1'],
			'len_2' => $result['len_2'],
			'len_3' => $result['len_3'],
			'len_4' => $result['len_4'],
			'len_5' => $result['len_5'],
			'len_6' => $result['len_6'],
			'len_7' => $result['len_7'],
			'len_8' => $result['len_8'],
			'len_9' => $result['len_9'],
			'len_10' => $result['len_10'],
			'acd_1' => $result['acd_1'],
			'acd_2' => $result['acd_2'],
			'acd_3' => $result['acd_3'],
			'acd_4' => $result['acd_4'],
			'acd_5' => $result['acd_5'],
			'acd_6' => $result['acd_6'],
			'acd_7' => $result['acd_7'],
			'acd_8' => $result['acd_8'],
			'acd_9' => $result['acd_9'],
			'acd_10' => $result['acd_10'],
			'aph_1' => $result['aph_1'],
			'aph_2' => $result['aph_2'],
			'aph_3' => $result['aph_3'],
			'aph_4' => $result['aph_4'],
			'aph_5' => $result['aph_5'],
			'aph_6' => $result['aph_6'],
			'aph_7' => $result['aph_7'],
			'aph_8' => $result['aph_8'],
			'aph_9' => $result['aph_9'],
			'aph_10' => $result['aph_10'],
			'con_1' => $result['con_1'],
			'con_2' => $result['con_2'],
			'con_3' => $result['con_3'],
			'con_4' => $result['con_4'],
			'con_5' => $result['con_5'],
			'con_6' => $result['con_6'],
			'con_7' => $result['con_7'],
			'con_8' => $result['con_8'],
			'con_9' => $result['con_9'],
			'con_10' => $result['con_10'],
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


		$len_1 = $_POST['len_1'];
		$len_2 = $_POST['len_2'];
		$len_3 = $_POST['len_3'];
		$len_4 = $_POST['len_4'];
		$len_5 = $_POST['len_5'];
		$len_6 = $_POST['len_6'];
		$len_7 = $_POST['len_7'];
		$len_8 = $_POST['len_8'];
		$len_9 = $_POST['len_9'];
		$len_10 = $_POST['len_10'];
		$acd_1 = $_POST['acd_1'];
		$acd_2 = $_POST['acd_2'];
		$acd_3 = $_POST['acd_3'];
		$acd_4 = $_POST['acd_4'];
		$acd_5 = $_POST['acd_5'];
		$acd_6 = $_POST['acd_6'];
		$acd_7 = $_POST['acd_7'];
		$acd_8 = $_POST['acd_8'];
		$acd_9 = $_POST['acd_9'];
		$acd_10 = $_POST['acd_10'];
		$aph_1 = $_POST['aph_1'];
		$aph_2 = $_POST['aph_2'];
		$aph_3 = $_POST['aph_3'];
		$aph_4 = $_POST['aph_4'];
		$aph_5 = $_POST['aph_5'];
		$aph_6 = $_POST['aph_6'];
		$aph_7 = $_POST['aph_7'];
		$aph_8 = $_POST['aph_8'];
		$aph_9 = $_POST['aph_9'];
		$aph_10 = $_POST['aph_10'];
		$con_1 = $_POST['con_1'];
		$con_2 = $_POST['con_2'];
		$con_3 = $_POST['con_3'];
		$con_4 = $_POST['con_4'];
		$con_5 = $_POST['con_5'];
		$con_6 = $_POST['con_6'];
		$con_7 = $_POST['con_7'];
		$con_8 = $_POST['con_8'];
		$con_9 = $_POST['con_9'];
		$con_10 = $_POST['con_10'];
		$temp = $_POST['temp'];


		$insert = "insert into carbonation (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`,`acd_1`,`acd_2`,`acd_3`,`acd_4`,`acd_5`,`acd_6`,`acd_7`,`acd_8`,`acd_9`,`acd_10`,`aph_1`,`aph_2`,`aph_3`,`aph_4`,`aph_5`,`aph_6`,`aph_7`,`aph_8`,`aph_9`,`aph_10`,`len_1`,`len_2`,`len_3`,`len_4`,`len_5`,`len_6`,`len_7`,`len_8`,`len_9`,`len_10`,`con_1`,`con_2`,`con_3`,`con_4`,`con_5`,`con_6`,`con_7`,`con_8`,`con_9`,`con_10`,`temp`,`amend_date`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$acd_1', '$acd_2', '$acd_3', '$acd_4', '$acd_5', '$acd_6', '$acd_7', '$acd_8', '$acd_9', '$acd_10', '$aph_1', '$aph_2', '$aph_3', '$aph_4', '$aph_5', '$aph_6', '$aph_7', '$aph_8', '$aph_9', '$aph_10', '$len_1', '$len_2', '$len_3', '$len_4', '$len_5', '$len_6', '$len_7', '$len_8', '$len_9', '$len_10', '$con_1', '$con_2', '$con_3', '$con_4', '$con_5', '$con_6', '$con_7', '$con_8', '$con_9', '$con_10', '$temp', '$amend_date')";

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
						$query = "select * from carbonation WHERE lab_no='$lab_no' and `is_deleted`='0'";

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

		$update = "update carbonation SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',`acd_1`='$_POST[acd_1]',`acd_2`='$_POST[acd_2]',`acd_3`='$_POST[acd_3]',`acd_4`='$_POST[acd_4]',`acd_5`='$_POST[acd_5]',`acd_6`='$_POST[acd_6]',`acd_7`='$_POST[acd_7]',`acd_8`='$_POST[acd_8]',`acd_9`='$_POST[acd_9]',`acd_10`='$_POST[acd_10]',`aph_1`='$_POST[aph_1]',`aph_2`='$_POST[aph_2]',`aph_3`='$_POST[aph_3]',`aph_4`='$_POST[aph_4]',`aph_5`='$_POST[aph_5]',`aph_6`='$_POST[aph_6]',`aph_7`='$_POST[aph_7]',`aph_8`='$_POST[aph_8]',`aph_9`='$_POST[aph_9]',`aph_10`='$_POST[aph_10]',`len_1`='$_POST[len_1]',`len_2`='$_POST[len_2]',`len_3`='$_POST[len_3]',`len_4`='$_POST[len_4]',`len_5`='$_POST[len_5]',`len_6`='$_POST[len_6]',`len_7`='$_POST[len_7]',`len_8`='$_POST[len_8]',`len_9`='$_POST[len_9]',`len_10`='$_POST[len_10]',`con_1`='$_POST[con_1]',`con_2`='$_POST[con_2]',`con_3`='$_POST[con_3]',`con_4`='$_POST[con_4]',`con_5`='$_POST[con_5]',`con_6`='$_POST[con_6]',`con_7`='$_POST[con_7]',`con_8`='$_POST[con_8]',`con_9`='$_POST[con_9]',`con_10`='$_POST[con_10]',`temp`='$_POST[temp]',`amend_date`='$_POST[amend_date]',`checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update carbonation SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM carbonation WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update carbonation SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update carbonation SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>