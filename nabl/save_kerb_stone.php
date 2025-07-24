<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from kerb_stone WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'kerb_type' => $result['kerb_type'],
			'kerb_grade' => $result['kerb_grade'],
			'chk_dim' => $result['chk_dim'],
			'length1' => $result['length1'],
			'width1' => $result['width1'],
			'thickness1' => $result['thickness1'],
			'chk_wtr' => $result['chk_wtr'],
			'w1_1' => $result['w1_1'],
			'w1_2' => $result['w1_2'],
			'w1_3' => $result['w1_3'],
			'w2_1' => $result['w2_1'],
			'w2_2' => $result['w2_2'],
			'w2_3' => $result['w2_3'],
			'wtr1' => $result['wtr1'],
			'wtr2' => $result['wtr2'],
			'wtr3' => $result['wtr3'],
			'avg_wtr' => $result['avg_wtr'],
			'chk_sur' => $result['chk_sur'],
			'avg_sur' => $result['avg_sur'],
			'chk_tra' => $result['chk_tra'],
			'len1' => $result['len1'],
			'len2' => $result['len2'],
			'len3' => $result['len3'],
			'bre1' => $result['bre1'],
			'bre2' => $result['bre2'],
			'bre3' => $result['bre3'],
			'h1' => $result['h1'],
			'h2' => $result['h2'],
			'h3' => $result['h3'],
			'load1' => $result['load1'],
			'load2' => $result['load2'],
			'load3' => $result['load3'],
			'factor1' => $result['factor1'],
			'factor2' => $result['factor2'],
			'factor3' => $result['factor3'],
			'corr1' => $result['corr1'],
			'corr2' => $result['corr2'],
			'corr3' => $result['corr3'],
			'obs1' => $result['obs1'],
			'obs2' => $result['obs2'],
			'obs3' => $result['obs3'],
			'avg_obs' => $result['avg_obs']
		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr = $_POST['ulr'];
		$amend_date = $_POST['amend_date'];

		$kerb_type = $_POST['kerb_type'];
		$kerb_grade = $_POST['kerb_grade'];
		$chk_dim = $_POST['chk_dim'];
		$length1 = $_POST['length1'];
		$width1 = $_POST['width1'];
		$thickness1 = $_POST['thickness1'];
		$chk_wtr = $_POST['chk_wtr'];
		$w1_1 = $_POST['w1_1'];
		$w1_2 = $_POST['w1_2'];
		$w1_3 = $_POST['w1_3'];
		$w2_1 = $_POST['w2_1'];
		$w2_2 = $_POST['w2_2'];
		$w2_3 = $_POST['w2_3'];
		$wtr1 = $_POST['wtr1'];
		$wtr2 = $_POST['wtr2'];
		$wtr3 = $_POST['wtr3'];
		$avg_wtr = $_POST['avg_wtr'];
		$chk_sur = $_POST['chk_sur'];
		$avg_sur = $_POST['avg_sur'];
		$chk_tra = $_POST['chk_tra'];
		$len1 = $_POST['len1'];
		$len2 = $_POST['len2'];
		$len3 = $_POST['len3'];
		$bre1 = $_POST['bre1'];
		$bre2 = $_POST['bre2'];
		$bre3 = $_POST['bre3'];
		$h1 = $_POST['h1'];
		$h2 = $_POST['h2'];
		$h3 = $_POST['h3'];
		$load1 = $_POST['load1'];
		$load2 = $_POST['load2'];
		$load3 = $_POST['load3'];
		$factor1 = $_POST['factor1'];
		$factor2 = $_POST['factor2'];
		$factor3 = $_POST['factor3'];
		$corr1 = $_POST['corr1'];
		$corr2 = $_POST['corr2'];
		$corr3 = $_POST['corr3'];
		$obs1 = $_POST['obs1'];
		$obs2 = $_POST['obs2'];
		$obs3 = $_POST['obs3'];
		$avg_obs = $_POST['avg_obs'];


		$curr_date = date("Y-m-d");



		$insert = "INSERT INTO `kerb_stone`(`report_no`,`ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `kerb_type`, `kerb_grade`, `chk_dim`, `length1`, `width1`, `thickness1`, `chk_wtr`, `w1_1`, `w1_2`, `w1_3`, `w2_1`, `w2_2`, `w2_3`, `wtr1`, `wtr2`, `wtr3`, `avg_wtr`, `chk_sur`, `avg_sur`, `chk_tra`, `len1`, `len2`, `len3`, `bre1`, `bre2`, `bre3`, `h1`, `h2`, `h3`, `load1`, `load2`, `load3`, `factor1`, `factor2`, `factor3`, `corr1`, `corr2`, `corr3`, `obs1`, `obs2`, `obs3`, `avg_obs`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$kerb_type', '$kerb_grade', '$chk_dim', '$length1', '$width1', '$thickness1', '$chk_wtr', '$w1_1', '$w1_2', '$w1_3', '$w2_1', '$w2_2', '$w2_3', '$wtr1', '$wtr2', '$wtr3', '$avg_wtr', '$chk_sur', '$avg_sur', '$chk_tra', '$len1', '$len2', '$len3', '$bre1', '$bre2', '$bre3', '$h1', '$h2', '$h3', '$load1', '$load2', '$load3', '$factor1', '$factor2', '$factor3', '$corr1', '$corr2', '$corr3', '$obs1', '$obs2', '$obs3', '$avg_obs', '$amend_date')";

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
							<th style="text-align:center;"><label>Report No.</label></th>
							<th style="text-align:center;"><label>Job No.</label></th>
							<th style="text-align:center;"><label>Lab No.</label></th>



						</tr>
						<?php
						$query = "select * from `kerb_stone` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
										<td style="text-align:center;"><?php echo $r['report_no']; ?></td>
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



		$update = "update kerb_stone SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
				`modified_by`='$_SESSION[name]',
				`modified_date`='$curr_date',					
				`checked_by`=NULL,					 
				`kerb_type` = '$_POST[kerb_type]',
				`kerb_grade` = '$_POST[kerb_grade]',
				`chk_dim` = '$_POST[chk_dim]',
				`length1` = '$_POST[length1]',
				`width1` = '$_POST[width1]',
				`thickness1` = '$_POST[thickness1]',
				`chk_wtr` = '$_POST[chk_wtr]',
				`w1_1` = '$_POST[w1_1]',
				`w1_2` = '$_POST[w1_2]',
				`w1_3` = '$_POST[w1_3]',
				`w2_1` = '$_POST[w2_1]',
				`w2_2` = '$_POST[w2_2]',
				`w2_3` = '$_POST[w2_3]',
				`wtr1` = '$_POST[wtr1]',
				`wtr2` = '$_POST[wtr2]',
				`wtr3` = '$_POST[wtr3]',
				`avg_wtr` = '$_POST[avg_wtr]',
				`chk_sur` = '$_POST[chk_sur]',
				`avg_sur` = '$_POST[avg_sur]',
				`chk_tra` = '$_POST[chk_tra]',
				`len1` = '$_POST[len1]',
				`len2` = '$_POST[len2]',
				`len3` = '$_POST[len3]',
				`bre1` = '$_POST[bre1]',
				`bre2` = '$_POST[bre2]',
				`bre3` = '$_POST[bre3]',
				`h1` = '$_POST[h1]',
				`h2` = '$_POST[h2]',
				`h3` = '$_POST[h3]',
				`load1` = '$_POST[load1]',
				`load2` = '$_POST[load2]',
				`load3` = '$_POST[load3]',
				`factor1` = '$_POST[factor1]',
				`factor2` = '$_POST[factor2]',
				`factor3` = '$_POST[factor3]',
				`corr1` = '$_POST[corr1]',
				`corr2` = '$_POST[corr2]',
				`corr3` = '$_POST[corr3]',
				`obs1` = '$_POST[obs1]',
				`obs2` = '$_POST[obs2]',
				`obs3` = '$_POST[obs3]',
				`avg_obs` = '$_POST[avg_obs]',
				`amend_date` = '$_POST[amend_date]'
				WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update kerb_stone SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM kerb_stone WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update kerb_stone SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update kerb_stone SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>