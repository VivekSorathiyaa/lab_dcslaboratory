<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from modified_bitumen WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'tank_no' => $result['tank_no'],
			'lot_no' => $result['lot_no'],
			'bitumin_grade' => $result['bitumin_grade'],
			'bitumin_make' => $result['bitumin_make'],
			'room_temp' => $result['room_temp'],
			'chk_pen' => $result['chk_pen'],
			'pen_temp' => $result['pen_temp'],
			'pen_1' => $result['pen_1'],
			'pen_2' => $result['pen_2'],
			'pen_3' => $result['pen_3'],
			'pint_1' => $result['pint_1'],
			'pint_2' => $result['pint_2'],
			'pint_3' => $result['pint_3'],
			'pfin_1' => $result['pfin_1'],
			'pfin_2' => $result['pfin_2'],
			'pfin_3' => $result['pfin_3'],
			'avg_pen' => $result['avg_pen'],
			'chk_sof' => $result['chk_sof'],
			'sof_0' => $result['sof_0'],
			'sof_1' => $result['sof_1'],
			'sof_2' => $result['sof_2'],
			'sof_temp' => $result['sof_temp'],
			'ela_temp' => $result['ela_temp'],
			'avg_sof' => $result['avg_sof'],
			'chk_ela' => $result['chk_ela'],
			'ela_0' => $result['ela_0'],
			'ela_1' => $result['ela_1'],
			'ela_2' => $result['ela_2'],
			'avg_ela' => $result['avg_ela'],
			'chk_duc' => $result['chk_duc'],
			'duc_temp' => $result['duc_temp'],
			'duc_1' => $result['duc_1'],
			'duc_2' => $result['duc_2'],
			'duc_3' => $result['duc_3'],
			'dint_1' => $result['dint_1'],
			'dint_2' => $result['dint_2'],
			'dint_3' => $result['dint_3'],
			'dfin_1' => $result['dfin_1'],
			'dfin_2' => $result['dfin_2'],
			'dfin_3' => $result['dfin_3'],
			'avg_duc' => $result['avg_duc'],
			'duc_bit' => $result['duc_bit'],
			'chk_sp' => $result['chk_sp'],
			'sp_temp' => $result['sp_temp'],
			'sp_a_1' => $result['sp_a_1'],
			'sp_a_2' => $result['sp_a_2'],
			'sp_b_1' => $result['sp_b_1'],
			'sp_b_2' => $result['sp_b_2'],
			'sp_c_1' => $result['sp_c_1'],
			'sp_c_2' => $result['sp_c_2'],
			'sp_d_1' => $result['sp_d_1'],
			'sp_d_2' => $result['sp_d_2'],
			'sp_1' => $result['sp_1'],
			'sp_2' => $result['sp_2'],
			'avg_sp' => $result['avg_sp'],
			'chk_abs' => $result['chk_abs'],
			'abs_1_1' => $result['abs_1_1'],
			'abs_1_2' => $result['abs_1_2'],
			'abs_2_1' => $result['abs_2_1'],
			'abs_2_2' => $result['abs_2_2'],
			'abs_3_1' => $result['abs_3_1'],
			'abs_3_2' => $result['abs_3_2'],
			'abs_4_1' => $result['abs_4_1'],
			'abs_4_2' => $result['abs_4_2'],
			'abs_5_1' => $result['abs_5_1'],
			'abs_5_2' => $result['abs_5_2'],
			'abs_6_1' => $result['abs_6_1'],
			'abs_6_2' => $result['abs_6_2'],
			'abs_7_1' => $result['abs_7_1'],
			'abs_7_2' => $result['abs_7_2'],
			'abs_8_1' => $result['abs_8_1'],
			'abs_8_2' => $result['abs_8_2'],
			'abs_9_1' => $result['abs_9_1'],
			'abs_9_2' => $result['abs_9_2'],
			'abs_temp' => $result['abs_temp'],
			'abs_vac' => $result['abs_vac'],
			'avg_abs' => $result['avg_abs'],
			'chk_kin' => $result['chk_kin'],
			'kin_1_1' => $result['kin_1_1'],
			'kin_1_2' => $result['kin_1_2'],
			'kin_2_1' => $result['kin_2_1'],
			'kin_2_2' => $result['kin_2_2'],
			'kin_3_1' => $result['kin_3_1'],
			'kin_3_2' => $result['kin_3_2'],
			'kin_4_1' => $result['kin_4_1'],
			'kin_4_2' => $result['kin_4_2'],
			'kin_5_1' => $result['kin_5_1'],
			'kin_5_2' => $result['kin_5_2'],
			'kin_6_1' => $result['kin_6_1'],
			'kin_6_2' => $result['kin_6_2'],
			'kin_temp' => $result['kin_temp'],
			'kin_vac' => $result['kin_vac'],
			'avg_kin' => $result['avg_kin'],
			'chk_los' => $result['chk_los'],
			'los_temp' => $result['los_temp'],
			'los_w1_1' => $result['los_w1_1'],
			'los_w1_2' => $result['los_w1_2'],
			'los_w2_1' => $result['los_w2_1'],
			'los_w2_2' => $result['los_w2_2'],
			'los_wt_1' => $result['los_wt_1'],
			'los_wt_2' => $result['los_wt_2'],
			'los_1' => $result['los_1'],
			'los_2' => $result['los_2'],

			'caste_date1' => $result['caste_date1'],
			'caste_date2' => $result['caste_date2'],
			'caste_date3' => $result['caste_date3'],

			'test_date1' => $result['test_date1'],
			'test_date2' => $result['test_date2'],
			'test_date3' => $result['test_date3'],
			'chk_fla' => $result['chk_fla'],
			'fla_1' => $result['fla_1'],


			'avg_los' => $result['avg_los']
		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$tank_no =  $_POST['tank_no'];
		$lot_no =  $_POST['lot_no'];
		$bitumin_grade =  $_POST['bitumin_grade'];
		$bitumin_make =  $_POST['bitumin_make'];
		$ulr =  $_POST['ulr'];
		$amend_date =  $_POST['amend_date'];

		$room_temp = $_POST['room_temp'];
		$chk_pen = $_POST['chk_pen'];
		$pen_temp = $_POST['pen_temp'];
		$pen_1 = $_POST['pen_1'];
		$pen_2 = $_POST['pen_2'];
		$pen_3 = $_POST['pen_3'];
		$pint_1 = $_POST['pint_1'];
		$pint_2 = $_POST['pint_2'];
		$pint_3 = $_POST['pint_3'];
		$pfin_1 = $_POST['pfin_1'];
		$pfin_2 = $_POST['pfin_2'];
		$pfin_3 = $_POST['pfin_3'];
		$avg_pen = $_POST['avg_pen'];
		$chk_sof = $_POST['chk_sof'];
		$chk_ela = $_POST['chk_ela'];
		$sof_0 = $_POST['sof_0'];
		$sof_1 = $_POST['sof_1'];
		$sof_2 = $_POST['sof_2'];
		$ela_0 = $_POST['ela_0'];
		$ela_1 = $_POST['ela_1'];
		$ela_2 = $_POST['ela_2'];
		$caste_date1 = $_POST['caste_date1'];
		$caste_date2 = $_POST['caste_date2'];
		$caste_date3 = $_POST['caste_date3'];
		$test_date1 = $_POST['test_date1'];
		$test_date2 = $_POST['test_date2'];
		$test_date3 = $_POST['test_date3'];

		$sof_ball_1 = $_POST['sof_ball_1'];
		$sof_ball_2 = $_POST['sof_ball_2'];
		$avg_sof = $_POST['avg_sof'];
		$avg_ela = $_POST['avg_ela'];
		$chk_duc = $_POST['chk_duc'];
		$duc_temp = $_POST['duc_temp'];
		$duc_1 = $_POST['duc_1'];
		$duc_2 = $_POST['duc_2'];
		$duc_3 = $_POST['duc_3'];
		$dint_1 = $_POST['dint_1'];
		$dint_2 = $_POST['dint_2'];
		$dint_3 = $_POST['dint_3'];
		$dfin_1 = $_POST['dfin_1'];
		$dfin_2 = $_POST['dfin_2'];
		$dfin_3 = $_POST['dfin_3'];
		$avg_duc = $_POST['avg_duc'];
		$duc_bit = $_POST['duc_bit'];
		$chk_sp = $_POST['chk_sp'];
		$sp_temp = $_POST['sp_temp'];
		$sp_a_1 = $_POST['sp_a_1'];
		$sp_a_2 = $_POST['sp_a_2'];
		$sp_b_1 = $_POST['sp_b_1'];
		$sp_b_2 = $_POST['sp_b_2'];
		$sp_c_1 = $_POST['sp_c_1'];
		$sp_c_2 = $_POST['sp_c_2'];
		$sp_d_1 = $_POST['sp_d_1'];
		$sp_d_2 = $_POST['sp_d_2'];
		$sp_1 = $_POST['sp_1'];
		$sp_2 = $_POST['sp_2'];
		$avg_sp = $_POST['avg_sp'];
		$chk_abs = $_POST['chk_abs'];
		$abs_1_1 = $_POST['abs_1_1'];
		$abs_1_2 =  $_POST['abs_1_2'];
		$abs_2_1 = $_POST['abs_2_1'];
		$abs_2_2 =  $_POST['abs_2_2'];
		$abs_3_1 = $_POST['abs_3_1'];
		$abs_3_2 =  $_POST['abs_3_2'];
		$abs_4_1 = $_POST['abs_4_1'];
		$abs_4_2 =  $_POST['abs_4_2'];
		$abs_5_1 = $_POST['abs_5_1'];
		$abs_5_2 =  $_POST['abs_5_2'];
		$abs_6_1 = $_POST['abs_6_1'];
		$abs_6_2 =  $_POST['abs_6_2'];
		$abs_7_1 = $_POST['abs_7_1'];
		$abs_7_2 =  $_POST['abs_7_2'];
		$abs_8_1 = $_POST['abs_8_1'];
		$abs_8_2 =  $_POST['abs_8_2'];
		$abs_9_1 = $_POST['abs_9_1'];
		$abs_9_2 =  $_POST['abs_9_2'];
		$abs_temp =  $_POST['abs_temp'];
		$abs_vac =  $_POST['abs_vac'];
		$avg_abs =  $_POST['avg_abs'];
		$chk_kin = $_POST['chk_kin'];
		$kin_1_1 = $_POST['kin_1_1'];
		$kin_1_2 =  $_POST['kin_1_2'];
		$kin_2_1 = $_POST['kin_2_1'];
		$kin_2_2 =  $_POST['kin_2_2'];
		$kin_3_1 = $_POST['kin_3_1'];
		$kin_3_2 =  $_POST['kin_3_2'];
		$kin_4_1 = $_POST['kin_4_1'];
		$kin_4_2 =  $_POST['kin_4_2'];
		$kin_5_1 = $_POST['kin_5_1'];
		$kin_5_2 =  $_POST['kin_5_2'];
		$kin_6_1 = $_POST['kin_6_1'];
		$kin_6_2 =  $_POST['kin_6_2'];
		$kin_vac =  $_POST['kin_vac'];
		$kin_temp =  $_POST['kin_temp'];
		$avg_kin =  $_POST['avg_kin'];
		$chk_fla =  $_POST['chk_fla'];
		$fla_1 =  $_POST['fla_1'];
		$sof_temp =  $_POST['sof_temp'];
		$ela_temp =  $_POST['ela_temp'];


		$chk_los =  $_POST['chk_los'];
		$los_temp =  $_POST['los_temp'];
		$los_w1_1 =  $_POST['los_w1_1'];
		$los_w1_2 =  $_POST['los_w1_2'];
		$los_w2_1 =  $_POST['los_w2_1'];
		$los_w2_2 =  $_POST['los_w2_2'];
		$los_wt_1 =  $_POST['los_wt_1'];
		$los_wt_2 =  $_POST['los_wt_2'];
		$los_1 =  $_POST['los_1'];
		$los_2 =  $_POST['los_2'];
		$avg_los =  $_POST['avg_los'];

		$curr_date = date("Y-m-d");


		$insert = "insert into modified_bitumen (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `tank_no`, `lot_no`, `bitumin_grade`, `bitumin_make`, `chk_pen`, `pen_temp`, `pen_1`, `pen_2`, `pen_3`, `pint_1`, `pint_2`, `pint_3`, `pfin_1`, `pfin_2`, `pfin_3`, `avg_pen`, `chk_sof`, `sof_0`, `sof_1`, `sof_2`, `avg_sof`, `chk_ela`, `ela_0`, `ela_1`, `ela_2`, `avg_ela`, `chk_duc`, `duc_temp`, `duc_1`, `duc_2`, `duc_3`, `dint_1`, `dint_2`, `dint_3`, `dfin_1`, `dfin_2`, `dfin_3`, `avg_duc`, `duc_bit`, `caste_date1`, `caste_date2`, `caste_date3`, `test_date1`, `test_date2`, `test_date3`, `chk_sp`, `sp_temp`, `sp_a_1`, `sp_a_2`, `sp_b_1`, `sp_b_2`, `sp_c_1`, `sp_c_2`, `sp_d_1`, `sp_d_2`, `avg_sp`, `chk_abs`, `abs_1_1`, `abs_1_2`, `abs_2_1`, `abs_2_2`, `abs_3_1`, `abs_3_2`, `abs_4_1`, `abs_4_2`, `abs_5_1`, `abs_5_2`, `abs_6_1`, `abs_6_2`, `abs_7_1`, `abs_7_2`, `abs_8_1`, `abs_8_2`, `abs_9_1`, `abs_9_2`, `abs_vac`, `abs_temp`, `avg_abs`, `chk_kin`, `kin_1_1`, `kin_1_2`, `kin_2_1`, `kin_2_2`, `kin_3_1`, `kin_3_2`, `kin_4_1`, `kin_4_2`, `kin_5_1`, `kin_5_2`, `kin_6_1`, `kin_6_2`, `kin_temp`, `kin_vac`, `avg_kin`, `chk_los`, `los_temp`, `los_w1_1`, `los_w1_2`, `los_w2_1`, `los_w2_2`, `los_wt_1`, `los_wt_2`, `avg_los`,`sp_1`,`sp_2`,`los_1`,`room_temp`,`los_2`,`sof_temp`,`ela_temp`,`chk_fla`,`fla_1`,`amend_date`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$tank_no', '$lot_no', '$bitumin_grade', '$bitumin_make', '$chk_pen', '$pen_temp', '$pen_1', '$pen_2', '$pen_3', '$pint_1', '$pint_2', '$pint_3', '$pfin_1', '$pfin_2', '$pfin_3', '$avg_pen', '$chk_sof', '$sof_0','$sof_1', '$sof_2', '$avg_sof', '$chk_ela', '$ela_0','$ela_1', '$ela_2', '$avg_ela', '$chk_duc', '$duc_temp', '$duc_1', '$duc_2', '$duc_3', '$caste_date1', '$caste_date2', '$caste_date3', '$test_date1', '$test_date2', '$test_date3', '$dint_1', '$dint_2', '$dint_3', '$dfin_1', '$dfin_2', '$dfin_3', '$avg_duc', '$duc_bit', '$chk_sp', '$sp_temp', '$sp_a_1', '$sp_a_2', '$sp_b_1', '$sp_b_2', '$sp_c_1', '$sp_c_2', '$sp_d_1', '$sp_d_2', '$avg_sp', '$chk_abs', '$abs_1_1', '$abs_1_2', '$abs_2_1', '$abs_2_2', '$abs_3_1', '$abs_3_2', '$abs_4_1', '$abs_4_2', '$abs_5_1', '$abs_5_2', '$abs_6_1', '$abs_6_2', '$abs_7_1', '$abs_7_2', '$abs_8_1', '$abs_8_2', '$abs_9_1', '$abs_9_2', '$abs_vac', '$abs_temp', '$avg_abs', '$chk_kin', '$kin_1_1', '$kin_1_2', '$kin_2_1', '$kin_2_2', '$kin_3_1', '$kin_3_2', '$kin_4_1', '$kin_4_2', '$kin_5_1', '$kin_5_2', '$kin_6_1', '$kin_6_2', '$kin_temp', '$kin_vac', '$avg_kin', '$chk_los', '$los_temp', '$los_w1_1', '$los_w1_2', '$los_w2_1', '$los_w2_2', '$los_wt_1', '$los_wt_2', '$avg_los','$sp_1','$sp_2','$los_1','$room_temp','$los_2','$sof_temp','$ela_temp','$chk_fla','$fla_1','$amend_date')";

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
						$query = "select * from modified_bitumen WHERE lab_no='$lab_no' and `is_deleted`='0'";

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

		$update = "update modified_bitumen SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',
		 `chk_pen`='$_POST[chk_pen]',`pen_temp`='$_POST[pen_temp]',`pen_1`='$_POST[pen_1]',`pen_2`='$_POST[pen_2]',`pen_3`='$_POST[pen_3]',`pint_1`='$_POST[pint_1]',`pint_2`='$_POST[pint_2]',`pint_3`='$_POST[pint_3]',`pfin_1`='$_POST[pfin_1]',`pfin_2`='$_POST[pfin_2]',`pfin_3`='$_POST[pfin_3]',`avg_pen`='$_POST[avg_pen]',`chk_sof`='$_POST[chk_sof]',`sof_0`='$_POST[sof_0]',`sof_1`='$_POST[sof_1]',`sof_2`='$_POST[sof_2]',`avg_sof`='$_POST[avg_sof]',`chk_ela`='$_POST[chk_ela]',`ela_0`='$_POST[ela_0]',`ela_1`='$_POST[ela_1]',`ela_2`='$_POST[ela_2]',`avg_ela`='$_POST[avg_ela]',`chk_duc`='$_POST[chk_duc]',`duc_temp`='$_POST[duc_temp]',`duc_1`='$_POST[duc_1]',`duc_2`='$_POST[duc_2]',`duc_3`='$_POST[duc_3]',`dint_1`='$_POST[dint_1]',`dint_2`='$_POST[dint_2]',`dint_3`='$_POST[dint_3]',`dfin_1`='$_POST[dfin_1]',`dfin_2`='$_POST[dfin_2]',`dfin_3`='$_POST[dfin_3]',`avg_duc`='$_POST[avg_duc]',`duc_bit`='$_POST[duc_bit]',`caste_date1`='$_POST[caste_date1]',`caste_date2`='$_POST[caste_date2]',`caste_date3`='$_POST[caste_date3]',`test_date1`='$_POST[test_date1]',`test_date2`='$_POST[test_date2]',`test_date3`='$_POST[test_date3]',`chk_sp`='$_POST[chk_sp]',`sp_temp`='$_POST[sp_temp]',`sp_a_1`='$_POST[sp_a_1]',`sp_a_2`='$_POST[sp_a_2]',`sp_b_1`='$_POST[sp_b_1]',`sp_b_2`='$_POST[sp_b_2]',`sp_c_1`='$_POST[sp_c_1]',`sp_c_2`='$_POST[sp_c_2]',`sp_d_1`='$_POST[sp_d_1]',`sp_d_2`='$_POST[sp_d_2]',`sp_1`='$_POST[sp_1]',`sp_2`='$_POST[sp_2]',`avg_sp`='$_POST[avg_sp]',`chk_abs`='$_POST[chk_abs]',`abs_1_1`='$_POST[abs_1_1]',`abs_1_2`='$_POST[abs_1_2]',`abs_2_1`='$_POST[abs_2_1]',`abs_2_2`='$_POST[abs_2_2]',`abs_3_1`='$_POST[abs_3_1]',`abs_3_2`='$_POST[abs_3_2]',`abs_4_1`='$_POST[abs_4_1]',`abs_4_2`='$_POST[abs_4_2]',`abs_5_1`='$_POST[abs_5_1]',`abs_5_2`='$_POST[abs_5_2]',`abs_6_1`='$_POST[abs_6_1]',`abs_6_2`='$_POST[abs_6_2]',`abs_7_1`='$_POST[abs_7_1]',`abs_7_2`='$_POST[abs_7_2]',`abs_8_1`='$_POST[abs_8_1]',`abs_8_2`='$_POST[abs_8_2]',`abs_9_1`='$_POST[abs_9_1]',`abs_9_2`='$_POST[abs_9_2]',`abs_temp`='$_POST[abs_temp]',`abs_vac`='$_POST[abs_vac]',`avg_abs`='$_POST[avg_abs]',`chk_kin`='$_POST[chk_kin]',`kin_1_1`='$_POST[kin_1_1]',`kin_1_2`='$_POST[kin_1_2]',`kin_2_1`='$_POST[kin_2_1]',`kin_2_2`='$_POST[kin_2_2]',`kin_3_1`='$_POST[kin_3_1]',`kin_3_2`='$_POST[kin_3_2]',`kin_4_1`='$_POST[kin_4_1]',`kin_4_2`='$_POST[kin_4_2]',`kin_5_1`='$_POST[kin_5_1]',`kin_5_2`='$_POST[kin_5_2]',`kin_6_1`='$_POST[kin_6_1]',`kin_6_2`='$_POST[kin_6_2]',`kin_temp`='$_POST[kin_temp]',`kin_vac`='$_POST[kin_vac]',`avg_kin`='$_POST[avg_kin]',`chk_los`='$_POST[chk_los]',`los_temp`='$_POST[los_temp]',`los_w1_1`='$_POST[los_w1_1]',`los_w1_2`='$_POST[los_w1_2]',`los_w2_1`='$_POST[los_w2_1]',`los_w2_2`='$_POST[los_w2_2]',`los_wt_1`='$_POST[los_wt_1]',`los_wt_2`='$_POST[los_wt_2]',`los_1`='$_POST[los_1]',`los_2`='$_POST[los_2]',`avg_los`='$_POST[avg_los]',`tank_no`='$_POST[tank_no]',`room_temp`='$_POST[room_temp]',`sof_temp`='$_POST[sof_temp]',`ela_temp`='$_POST[ela_temp]',`chk_fla`='$_POST[chk_fla]',`amend_date`='$_POST[amend_date]',`fla_1`='$_POST[fla_1]',`checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update modified_bitumen SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM modified_bitumen WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update modified_bitumen SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update modified_bitumen SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>