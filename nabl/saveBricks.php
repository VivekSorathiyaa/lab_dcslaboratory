<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from span_brick WHERE id='$_POST[id]' AND `is_deleted`='0'";
		$select_result = mysqli_query($conn, $get_query);
		$result = mysqli_fetch_array($select_result);
		$id = $result['id'];
		$report_no = $result['report_no'];
		$job_no = $result['job_no'];
		$lab_no = $result['lab_no'];
		$ulr = $result['ulr'];
		$fill = array(
			'id' => $id,
			'report_no' => $report_no,
			'job_no' => $job_no,
			'lab_no' => $lab_no,
			'ulr' => $ulr,
			'amend_date' => $result['amend_date'],
			'remarks' => $result['remarks'],
			'chk_dim' => $result['chk_dim'],
			'no_of_brick' => $result['no_of_brick'],
			'id_mark' => $result['id_mark'],
			'temp1' => $result['temp1'],
			'avg_height' => $result['avg_height'],
			'avg_length' => $result['avg_length'],
			'avg_width' => $result['avg_width'],
			'dim_height' => $result['dim_height'],
			'dim_length' => $result['dim_length'],
			'dim_width' => $result['dim_width'],
			'dim_height1' => $result['dim_height1'],
			'dim_length1' => $result['dim_length1'],
			'dim_width1' => $result['dim_width1'],
			'chk_wtr' => $result['chk_wtr'],
			'avg_wtr' => $result['avg_wtr'],
			'wtr_lab_1' => $result['wtr_lab_1'],
			'wtr_lab_2' => $result['wtr_lab_2'],
			'wtr_lab_3' => $result['wtr_lab_3'],
			'wtr_lab_4' => $result['wtr_lab_4'],
			'wtr_lab_5' => $result['wtr_lab_5'],
			'wtr_lab_6' => $result['wtr_lab_6'],
			'wtr_w1_1' => $result['wtr_w1_1'],
			'wtr_w1_2' => $result['wtr_w1_2'],
			'wtr_w1_3' => $result['wtr_w1_3'],
			'wtr_w1_4' => $result['wtr_w1_4'],
			'wtr_w1_5' => $result['wtr_w1_5'],
			'wtr_w1_6' => $result['wtr_w1_6'],
			'wtr_w2_1' => $result['wtr_w2_1'],
			'wtr_w2_2' => $result['wtr_w2_2'],
			'wtr_w2_3' => $result['wtr_w2_3'],
			'wtr_w2_4' => $result['wtr_w2_4'],
			'wtr_w2_5' => $result['wtr_w2_5'],
			'wtr_w2_6' => $result['wtr_w2_6'],
			'wtr_1' => $result['wtr_1'],
			'wtr_2' => $result['wtr_2'],
			'wtr_3' => $result['wtr_3'],
			'wtr_4' => $result['wtr_4'],
			'wtr_5' => $result['wtr_5'],
			'wtr_6' => $result['wtr_6'],
			'chk_com' => $result['chk_com'],
			'avg_com' => $result['avg_com'],
			'con_grade' => $result['con_grade'],
			'com_lab_1' => $result['com_lab_1'],
			'com_lab_2' => $result['com_lab_2'],
			'com_lab_3' => $result['com_lab_3'],
			'com_lab_4' => $result['com_lab_4'],
			'com_lab_5' => $result['com_lab_5'],
			'com_lab_6' => $result['com_lab_6'],
			'com_l_1' => $result['com_l_1'],
			'com_l_2' => $result['com_l_2'],
			'com_l_3' => $result['com_l_3'],
			'com_l_4' => $result['com_l_4'],
			'com_l_5' => $result['com_l_5'],
			'com_l_6' => $result['com_l_6'],
			'com_b_1' => $result['com_b_1'],
			'com_b_2' => $result['com_b_2'],
			'com_b_3' => $result['com_b_3'],
			'com_b_4' => $result['com_b_4'],
			'com_b_5' => $result['com_b_5'],
			'com_b_6' => $result['com_b_6'],
			'com_h_1' => $result['com_h_1'],
			'com_h_2' => $result['com_h_2'],
			'com_h_3' => $result['com_h_3'],
			'com_h_4' => $result['com_h_4'],
			'com_h_5' => $result['com_h_5'],
			'com_h_6' => $result['com_h_6'],
			'com_area_1' => $result['com_area_1'],
			'com_area_2' => $result['com_area_2'],
			'com_area_3' => $result['com_area_3'],
			'com_area_4' => $result['com_area_4'],
			'com_area_5' => $result['com_area_5'],
			'com_area_6' => $result['com_area_6'],
			'com_load_1' => $result['com_load_1'],
			'com_load_2' => $result['com_load_2'],
			'com_load_3' => $result['com_load_3'],
			'com_load_4' => $result['com_load_4'],
			'com_load_5' => $result['com_load_5'],
			'com_load_6' => $result['com_load_6'],
			'com_1' => $result['com_1'],
			'com_2' => $result['com_2'],
			'com_3' => $result['com_3'],
			'com_4' => $result['com_4'],
			'com_5' => $result['com_5'],
			'com_6' => $result['com_6'],
			'chk_efflo' => $result['chk_efflo'],
			'rbt_efflo1' => $result['rbt_efflo1'],
			'rbt_efflo2' => $result['rbt_efflo2'],
			'rbt_efflo3' => $result['rbt_efflo3'],
			'rbt_efflo4' => $result['rbt_efflo4'],
			'rbt_efflo5' => $result['rbt_efflo5']


		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr = $_POST['ulr'];
		$amend_date = $_POST['amend_date'];
		$remarks = $_POST['remarks'];

		$chk_dim =  $_POST['chk_dim'];
		$no_of_brick =  $_POST['no_of_brick'];
		$id_mark =  $_POST['id_mark'];
		$temp1 =  $_POST['temp1'];
		$dim_height = $_POST['dim_height'];
		$dim_length = $_POST['dim_length'];
		$dim_width = $_POST['dim_width'];
		$dim_height1 = $_POST['dim_height1'];
		$dim_length1 = $_POST['dim_length1'];
		$dim_width1 = $_POST['dim_width1'];
		$avg_height = $_POST['avg_height'];
		$avg_length = $_POST['avg_length'];
		$avg_width = $_POST['avg_width'];


		$chk_wtr = $_POST['chk_wtr'];
		$avg_wtr = $_POST['avg_wtr'];
		$wtr_lab_1 = $_POST['wtr_lab_1'];
		$wtr_lab_2 = $_POST['wtr_lab_2'];
		$wtr_lab_3 = $_POST['wtr_lab_3'];
		$wtr_lab_4 = $_POST['wtr_lab_4'];
		$wtr_lab_5 = $_POST['wtr_lab_5'];
		$wtr_lab_6 = $_POST['wtr_lab_6'];
		$wtr_w1_1 = $_POST['wtr_w1_1'];
		$wtr_w1_2 = $_POST['wtr_w1_2'];
		$wtr_w1_3 = $_POST['wtr_w1_3'];
		$wtr_w1_4 = $_POST['wtr_w1_4'];
		$wtr_w1_5 = $_POST['wtr_w1_5'];
		$wtr_w1_6 = $_POST['wtr_w1_6'];

		$wtr_w2_1 = $_POST['wtr_w2_1'];
		$wtr_w2_2 = $_POST['wtr_w2_2'];
		$wtr_w2_3 = $_POST['wtr_w2_3'];
		$wtr_w2_4 = $_POST['wtr_w2_4'];
		$wtr_w2_5 = $_POST['wtr_w2_5'];
		$wtr_w2_6 = $_POST['wtr_w2_6'];

		$wtr_1 = $_POST['wtr_1'];
		$wtr_2 = $_POST['wtr_2'];
		$wtr_3 = $_POST['wtr_3'];
		$wtr_4 = $_POST['wtr_4'];
		$wtr_5 = $_POST['wtr_5'];
		$wtr_6 = $_POST['wtr_6'];

		$chk_com = $_POST['chk_com'];
		$avg_com = $_POST['avg_com'];
		$con_grade = $_POST['con_grade'];
		$com_lab_1 = $_POST['com_lab_1'];
		$com_lab_2 = $_POST['com_lab_2'];
		$com_lab_3 = $_POST['com_lab_3'];
		$com_lab_4 = $_POST['com_lab_4'];
		$com_lab_5 = $_POST['com_lab_5'];
		$com_lab_6 = $_POST['com_lab_6'];

		$com_l_1 = $_POST['com_l_1'];
		$com_l_2 = $_POST['com_l_2'];
		$com_l_3 = $_POST['com_l_3'];
		$com_l_4 = $_POST['com_l_4'];
		$com_l_5 = $_POST['com_l_5'];
		$com_l_6 = $_POST['com_l_6'];

		$com_b_1 = $_POST['com_b_1'];
		$com_b_2 = $_POST['com_b_2'];
		$com_b_3 = $_POST['com_b_3'];
		$com_b_4 = $_POST['com_b_4'];
		$com_b_5 = $_POST['com_b_5'];
		$com_b_6 = $_POST['com_b_6'];

		$com_h_1 = $_POST['com_h_1'];
		$com_h_2 = $_POST['com_h_2'];
		$com_h_3 = $_POST['com_h_3'];
		$com_h_4 = $_POST['com_h_4'];
		$com_h_5 = $_POST['com_h_5'];
		$com_h_6 = $_POST['com_h_6'];

		$com_area_1 = $_POST['com_area_1'];
		$com_area_2 = $_POST['com_area_2'];
		$com_area_3 = $_POST['com_area_3'];
		$com_area_4 = $_POST['com_area_4'];
		$com_area_5 = $_POST['com_area_5'];
		$com_area_6 = $_POST['com_area_6'];

		$com_load_1 = $_POST['com_load_1'];
		$com_load_2 = $_POST['com_load_2'];
		$com_load_3 = $_POST['com_load_3'];
		$com_load_4 = $_POST['com_load_4'];
		$com_load_5 = $_POST['com_load_5'];
		$com_load_6 = $_POST['com_load_6'];

		$com_1 = $_POST['com_1'];
		$com_2 = $_POST['com_2'];
		$com_3 = $_POST['com_3'];
		$com_4 = $_POST['com_4'];
		$com_5 = $_POST['com_5'];
		$com_6 = $_POST['com_6'];


		$chk_efflo = $_POST['chk_efflo'];

		$rbt_efflo1 = $_POST['rbt_efflo1'];
		$rbt_efflo2 = $_POST['rbt_efflo2'];
		$rbt_efflo3 = $_POST['rbt_efflo3'];
		$rbt_efflo4 = $_POST['rbt_efflo4'];
		$rbt_efflo5 = $_POST['rbt_efflo5'];




		$curr_date = date("Y-m-d");



		$insert = "INSERT INTO `span_brick`(`report_no`,`ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_dim`, `no_of_brick`, `id_mark`, `temp1`, `dim_length`, `dim_width`, `dim_height`,`dim_length1`, `dim_width1`, `dim_height1`,`avg_length`, `avg_width`, `avg_height`, `chk_wtr`,`avg_wtr`, `wtr_lab_1`, `wtr_lab_2`, `wtr_lab_3`, `wtr_lab_4`, `wtr_lab_5`,`wtr_lab_6`, `wtr_w1_1`, `wtr_w1_2`, `wtr_w1_3`, `wtr_w1_4`, `wtr_w1_5`, `wtr_w1_6`, `wtr_w2_1`, `wtr_w2_2`, `wtr_w2_3`, `wtr_w2_4`, `wtr_w2_5`,`wtr_w2_6`, `wtr_1`, `wtr_2`, `wtr_3`, `wtr_4`, `wtr_5`, `wtr_6`, `chk_com`, `avg_com`, `con_grade`, `com_lab_1`, `com_lab_2`, `com_lab_3`, `com_lab_4`, `com_lab_5`, `com_lab_6`, `com_l_1`, `com_l_2`, `com_l_3`, `com_l_4`, `com_l_5`, `com_l_6`, `com_b_1`, `com_b_2`, `com_b_3`, `com_b_4`, `com_b_5`, `com_b_6`, `com_h_1`, `com_h_2`, `com_h_3`, `com_h_4`, `com_h_5`, `com_h_6`, `com_area_1`, `com_area_2`, `com_area_3`, `com_area_4`, `com_area_5`, `com_area_6`, `com_load_1`, `com_load_2`, `com_load_3`, `com_load_4`, `com_load_5`, `com_load_6`, `com_1`, `com_2`, `com_3`, `com_4`, `com_5`, `com_6`, `chk_efflo`, `rbt_efflo1`, `rbt_efflo2`, `rbt_efflo3`, `rbt_efflo4`, `rbt_efflo5`, `remarks`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$chk_dim','$no_of_brick','$id_mark','$temp1','$dim_length','$dim_width','$dim_height','$dim_length1','$dim_width1','$dim_height1','$avg_length','$avg_width','$avg_height','$chk_wtr','$avg_wtr','$wtr_lab_1','$wtr_lab_2','$wtr_lab_3','$wtr_lab_4','$wtr_lab_5','$wtr_lab_6','$wtr_w1_1','$wtr_w1_2','$wtr_w1_3','$wtr_w1_4','$wtr_w1_5','$wtr_w1_6','$wtr_w2_1','$wtr_w2_2','$wtr_w2_3','$wtr_w2_4','$wtr_w2_5','$wtr_w2_6','$wtr_1','$wtr_2','$wtr_3','$wtr_4','$wtr_5','$wtr_6','$chk_com','$avg_com','$con_grade','$com_lab_1','$com_lab_2','$com_lab_3','$com_lab_4','$com_lab_5','$com_lab_6','$com_l_1', '$com_l_2','$com_l_3','$com_l_4','$com_l_5','$com_l_6','$com_b_1','$com_b_2','$com_b_3','$com_b_4','$com_b_5','$com_b_6','$com_h_1','$com_h_2','$com_h_3','$com_h_4','$com_h_5','$com_h_6','$com_area_1','$com_area_2','$com_area_3','$com_area_4','$com_area_5','$com_area_6','$com_load_1','$com_load_2','$com_load_3','$com_load_4','$com_load_5','$com_load_6','$com_1','$com_2','$com_3','$com_4','$com_5','$com_6','$chk_efflo','$rbt_efflo1','$rbt_efflo2','$rbt_efflo3','$rbt_efflo4','$rbt_efflo5','$remarks','$amend_date')";

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
						$query = "select * from `span_brick` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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



		$update = "update span_brick SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 
				 `chk_dim`='$_POST[chk_dim]',
				 `no_of_brick`='$_POST[no_of_brick]',
				 `id_mark`='$_POST[id_mark]',
				 `temp1`='$_POST[temp1]',
				 `dim_height`='$_POST[dim_height]',
				 `dim_length`='$_POST[dim_length]',
				 `dim_width`='$_POST[dim_width]',
				 `dim_height1`='$_POST[dim_height1]',
				 `dim_length1`='$_POST[dim_length1]',
				 `dim_width1`='$_POST[dim_width1]',
				 `avg_height`='$_POST[avg_height]',
				 `avg_length`='$_POST[avg_length]',
				 `avg_width`='$_POST[avg_width]',				 
				 `chk_wtr`='$_POST[chk_wtr]',
				 `avg_wtr`='$_POST[avg_wtr]',
				 `wtr_lab_1`='$_POST[wtr_lab_1]',
				 `wtr_lab_2`='$_POST[wtr_lab_2]',
				 `wtr_lab_3`='$_POST[wtr_lab_3]',
				 `wtr_lab_4`='$_POST[wtr_lab_4]',
				 `wtr_lab_5`='$_POST[wtr_lab_5]',
				 `wtr_lab_6`='$_POST[wtr_lab_6]',
				 `wtr_w1_1`='$_POST[wtr_w1_1]',
				 `wtr_w1_2`='$_POST[wtr_w1_2]',
				 `wtr_w1_3`='$_POST[wtr_w1_3]',
				 `wtr_w1_4`='$_POST[wtr_w1_4]',
				 `wtr_w1_5`='$_POST[wtr_w1_5]',
				 `wtr_w1_6`='$_POST[wtr_w1_6]',
				 `wtr_w2_1`='$_POST[wtr_w2_1]',
				 `wtr_w2_2`='$_POST[wtr_w2_2]',
				 `wtr_w2_3`='$_POST[wtr_w2_3]',
				 `wtr_w2_4`='$_POST[wtr_w2_4]',
				 `wtr_w2_5`='$_POST[wtr_w2_5]',
				 `wtr_w2_6`='$_POST[wtr_w2_6]',
				 `wtr_1`='$_POST[wtr_1]',
				 `wtr_2`='$_POST[wtr_2]',
				 `wtr_3`='$_POST[wtr_3]',
				 `wtr_4`='$_POST[wtr_4]',
				 `wtr_5`='$_POST[wtr_5]',				 
				 `wtr_6`='$_POST[wtr_6]',				 
				 `chk_com`='$_POST[chk_com]',
				 `avg_com`='$_POST[avg_com]',
				 `con_grade`='$_POST[con_grade]',
				 `com_lab_1`='$_POST[com_lab_1]',
				 `com_lab_2`='$_POST[com_lab_2]',
				 `com_lab_3`='$_POST[com_lab_3]',
				 `com_lab_4`='$_POST[com_lab_4]',
				 `com_lab_5`='$_POST[com_lab_5]',
				 `com_lab_6`='$_POST[com_lab_6]',
				 `com_l_1`='$_POST[com_l_1]',
				 `com_l_2`='$_POST[com_l_2]',
				 `com_l_3`='$_POST[com_l_3]',
				 `com_l_4`='$_POST[com_l_4]',
				 `com_l_5`='$_POST[com_l_5]',
				 `com_l_6`='$_POST[com_l_6]',
				 `com_b_1`='$_POST[com_b_1]',
				 `com_b_2`='$_POST[com_b_2]',
				 `com_b_3`='$_POST[com_b_3]',
				 `com_b_4`='$_POST[com_b_4]',
				 `com_b_5`='$_POST[com_b_5]',
				 `com_b_6`='$_POST[com_b_6]',
				 `com_h_1`='$_POST[com_h_1]',
				 `com_h_2`='$_POST[com_h_2]',
				 `com_h_3`='$_POST[com_h_3]',
				 `com_h_4`='$_POST[com_h_4]',
				 `com_h_5`='$_POST[com_h_5]',
				 `com_h_6`='$_POST[com_h_6]',
				 `com_area_1`='$_POST[com_area_1]',
				 `com_area_2`='$_POST[com_area_2]',
				 `com_area_3`='$_POST[com_area_3]',
				 `com_area_4`='$_POST[com_area_4]',
				 `com_area_5`='$_POST[com_area_5]',
				 `com_area_6`='$_POST[com_area_6]',
				 `com_load_1`='$_POST[com_load_1]',
				 `com_load_2`='$_POST[com_load_2]',
				 `com_load_3`='$_POST[com_load_3]',
				 `com_load_4`='$_POST[com_load_4]',
				 `com_load_5`='$_POST[com_load_5]',
				 `com_load_6`='$_POST[com_load_6]',
				 `com_1`='$_POST[com_1]',
				 `com_2`='$_POST[com_2]',
				 `com_3`='$_POST[com_3]',
				 `com_4`='$_POST[com_4]',
				 `com_5`='$_POST[com_5]',				 
				 `com_6`='$_POST[com_6]',				 
				 `chk_efflo`='$_POST[chk_efflo]',
				 `rbt_efflo1`='$_POST[rbt_efflo1]',
				 `rbt_efflo2`='$_POST[rbt_efflo2]',
				 `rbt_efflo3`='$_POST[rbt_efflo3]',
				 `rbt_efflo4`='$_POST[rbt_efflo4]',
				 `rbt_efflo5`='$_POST[rbt_efflo5]',
				 `remarks`='$_POST[remarks]',
				 `amend_date`='$_POST[amend_date]'
				  WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update span_brick SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM span_brick WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update span_brick SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update span_brick SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>