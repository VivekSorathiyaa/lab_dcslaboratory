<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from span_building_stone WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'location_source' => $result['location_source'],
			'bh_no' => $result['bh_no'],
			'depths' => $result['depths'],
			'chk_wtr' => $result['chk_wtr'],
			'w1_d_1' => $result['w1_d_1'],
			'w1_d_2' => $result['w1_d_2'],
			'w1_d_3' => $result['w1_d_3'],
			'w2_d_1' => $result['w2_d_1'],
			'w2_d_2' => $result['w2_d_2'],
			'w2_d_3' => $result['w2_d_3'],
			'sp_water_abr_1' => $result['sp_water_abr_1'],
			'sp_water_abr_2' => $result['sp_water_abr_2'],
			'sp_water_abr_3' => $result['sp_water_abr_3'],
			'sp_water_abr' => $result['sp_water_abr'],
			'chk_com' => $result['chk_com'],
			'dia' => $result['dia'],
			'height' => $result['height'],
			'a1' => $result['a1'],
			'a2' => $result['a2'],
			'a3' => $result['a3'],
			'a4' => $result['a4'],
			'a5' => $result['a5'],
			'b1' => $result['b1'],
			'b2' => $result['b2'],
			'b3' => $result['b3'],
			'b4' => $result['b4'],
			'b5' => $result['b5'],
			'c1' => $result['c1'],
			'c2' => $result['c2'],
			'c3' => $result['c3'],
			'c4' => $result['c4'],
			'c5' => $result['c5'],
			'comp_1' => $result['comp_1'],
			'comp_2' => $result['comp_2'],
			'comp_3' => $result['comp_3'],
			'comp_4' => $result['comp_4'],
			'comp_5' => $result['comp_5'],
			'avg_comp' => $result['avg_comp'],
			'chk_t_sp' => $result['chk_t_sp'],
			'w1_c_1' => $result['w1_c_1'],
			'w1_c_2' => $result['w1_c_2'],
			'w1_c_3' => $result['w1_c_3'],
			'w2_c_1' => $result['w2_c_1'],
			'w2_c_2' => $result['w2_c_2'],
			'w2_c_3' => $result['w2_c_3'],
			'w3_c_1' => $result['w3_c_1'],
			'w3_c_2' => $result['w3_c_2'],
			'w3_c_3' => $result['w3_c_3'],
			'w4_c_1' => $result['w4_c_1'],
			'w4_c_2' => $result['w4_c_2'],
			'w4_c_3' => $result['w4_c_3'],
			'sp_1' => $result['sp_1'],
			'sp_2' => $result['sp_2'],
			'sp_3' => $result['sp_3'],
			'avg_true_sp' => $result['avg_true_sp'],
			'chk_sp' => $result['chk_sp'],
			'od_1' => $result['od_1'],
			'od_2' => $result['od_2'],
			'od_3' => $result['od_3'],
			'sd_1' => $result['sd_1'],
			'sd_2' => $result['sd_2'],
			'sd_3' => $result['sd_3'],
			'wa_1' => $result['wa_1'],
			'wa_2' => $result['wa_2'],
			'wa_3' => $result['wa_3'],
			'app_sp_1' => $result['app_sp_1'],
			'app_sp_2' => $result['app_sp_2'],
			'app_sp_3' => $result['app_sp_3'],
			'avg_app_sp' => $result['avg_app_sp']

		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$location_source =  $_POST['location_source'];
		$bh_no =  $_POST['bh_no'];
		$depths =  $_POST['depths'];

		$chk_wtr = $_POST['chk_wtr'];
		$w1_d_1 = $_POST['w1_d_1'];
		$w1_d_2 = $_POST['w1_d_2'];
		$w1_d_3 = $_POST['w1_d_3'];
		$w2_d_1 = $_POST['w2_d_1'];
		$w2_d_2 = $_POST['w2_d_2'];
		$w2_d_3 = $_POST['w2_d_3'];
		$sp_water_abr = $_POST['sp_water_abr'];
		$sp_water_abr_1 = $_POST['sp_water_abr_1'];
		$sp_water_abr_2 = $_POST['sp_water_abr_2'];
		$sp_water_abr_3 = $_POST['sp_water_abr_3'];


		$chk_com = $_POST['chk_com'];
		$dia = $_POST['dia'];
		$height = $_POST['height'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$b1 = $_POST['b1'];
		$b2 = $_POST['b2'];
		$b3 = $_POST['b3'];
		$b4 = $_POST['b4'];
		$b5 = $_POST['b5'];
		$c1 = $_POST['c1'];
		$c2 = $_POST['c2'];
		$c3 = $_POST['c3'];
		$c4 = $_POST['c4'];
		$c5 = $_POST['c5'];
		$comp_1 = $_POST['comp_1'];
		$comp_2 = $_POST['comp_2'];
		$comp_3 = $_POST['comp_3'];
		$comp_4 = $_POST['comp_4'];
		$comp_5 = $_POST['comp_5'];
		$avg_comp = $_POST['avg_comp'];
		$chk_t_sp = $_POST['chk_t_sp'];
		$w1_c_1 = $_POST['w1_c_1'];
		$w1_c_2 = $_POST['w1_c_2'];
		$w1_c_3 = $_POST['w1_c_3'];
		$w2_c_1 = $_POST['w2_c_1'];
		$w2_c_2 = $_POST['w2_c_2'];
		$w2_c_3 = $_POST['w2_c_3'];
		$w3_c_1 = $_POST['w3_c_1'];
		$w3_c_2 = $_POST['w3_c_2'];
		$w3_c_3 = $_POST['w3_c_3'];
		$w4_c_1 = $_POST['w4_c_1'];
		$w4_c_2 = $_POST['w4_c_2'];
		$w4_c_3 = $_POST['w4_c_3'];
		$sp_1 = $_POST['sp_1'];
		$sp_2 = $_POST['sp_2'];
		$sp_3 = $_POST['sp_3'];
		$avg_true_sp = $_POST['avg_true_sp'];
		$chk_sp = $_POST['chk_sp'];
		$od_1 = $_POST['od_1'];
		$od_2 = $_POST['od_2'];
		$od_3 = $_POST['od_3'];
		$sd_1 = $_POST['sd_1'];
		$sd_2 = $_POST['sd_2'];
		$sd_3 = $_POST['sd_3'];
		$wa_1 = $_POST['wa_1'];
		$wa_2 = $_POST['wa_2'];
		$wa_3 = $_POST['wa_3'];
		$app_sp_1 = $_POST['app_sp_1'];
		$app_sp_2 = $_POST['app_sp_2'];
		$app_sp_3 = $_POST['app_sp_3'];
		$avg_app_sp = $_POST['avg_app_sp'];



		$curr_date = date("Y-m-d");



		$insert = "insert into span_building_stone ( `report_no`, `job_no`, `lab_no`, `location_source`, `bh_no`, `depths`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `chk_wtr`, `w1_d_1`, `w1_d_2`, `w1_d_3`, `w2_d_1`, `w2_d_2`, `w2_d_3`, `sp_water_abr_1`, `sp_water_abr_2`, `sp_water_abr_3`, `sp_water_abr`, `chk_com`, `dia`, `height`, `a1`, `a2`, `a3`, `a4`, `a5`, `b1`, `b2`, `b3`, `b4`, `b5`, `c1`, `c2`, `c3`, `c4`, `c5`, `comp_1`, `comp_2`, `comp_3`, `comp_4`, `comp_5`, `avg_comp`, `chk_t_sp`, `w1_c_1`, `w1_c_2`, `w1_c_3`, `w2_c_1`, `w2_c_2`, `w2_c_3`, `w3_c_1`, `w3_c_2`, `w3_c_3`, `w4_c_1`, `w4_c_2`, `w4_c_3`, `sp_1`, `sp_2`, `sp_3`, `avg_true_sp`, `chk_sp`, `od_1`, `od_2`, `od_3`, `sd_1`, `sd_2`, `sd_3`, `wa_1`, `wa_2`, `wa_3`, `app_sp_1`, `app_sp_2`, `app_sp_3`, `avg_app_sp`) values(
				'$report_no','$job_no','$lab_no','$location_source','$bh_no','$depths','0','$_SESSION[name]','$curr_date','','0000-00-00','0','',
				'$chk_wtr','$w1_d_1','$w1_d_2','$w1_d_3','$w2_d_1','$w2_d_2','$w2_d_3','$sp_water_abr_1','$sp_water_abr_2','$sp_water_abr_3','$sp_water_abr','$chk_com','$dia','$height','$a1','$a2','$a3','$a4','$a5','$b1','$b2','$b3','$b4','$b5','$c1','$c2','$c3','$c4','$c5','$comp_1','$comp_2','$comp_3','$comp_4','$comp_5','$avg_comp','$chk_t_sp','$w1_c_1','$w1_c_2','$w1_c_3','$w2_c_1','$w2_c_2','$w2_c_3','$w3_c_1','$w3_c_2','$w3_c_3','$w4_c_1','$w4_c_2','$w4_c_3','$sp_1','$sp_2','$sp_3','$avg_true_sp','$chk_sp','$od_1','$od_2','$od_3','$sd_1','$sd_2','$sd_3','$wa_1','$wa_2','$wa_3','$app_sp_1','$app_sp_2','$app_sp_3','$avg_app_sp')";

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
						$query = "select * from span_building_stone WHERE lab_no='$lab_no' and `is_deleted`='0'";

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

		$update = "update span_building_stone SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',`location_source`='$_POST[location_source]',`bh_no`='$_POST[bh_no]',`depths`='$_POST[depths]',`chk_wtr`='$_POST[chk_wtr]',`w1_d_1`='$_POST[w1_d_1]',`w1_d_2`='$_POST[w1_d_2]',`w1_d_3`='$_POST[w1_d_3]',`w2_d_1`='$_POST[w2_d_1]',`w2_d_2`='$_POST[w2_d_2]',`w2_d_3`='$_POST[w2_d_3]',`sp_water_abr_1`='$_POST[sp_water_abr_1]',`sp_water_abr_2`='$_POST[sp_water_abr_2]',`sp_water_abr`='$_POST[sp_water_abr]',`chk_com`='$_POST[chk_com]',`dia`='$_POST[dia]',`height`='$_POST[height]',`a1`='$_POST[a1]',`a2`='$_POST[a2]',`a3`='$_POST[a3]',`a4`='$_POST[a4]',`a5`='$_POST[a5]',`b1`='$_POST[b1]',`b2`='$_POST[b2]',`b3`='$_POST[b3]',`b4`='$_POST[b4]',`b5`='$_POST[b5]',`c1`='$_POST[c1]',`c2`='$_POST[c2]',`c3`='$_POST[c3]',
				 `c4`='$_POST[c4]',
				 `c5`='$_POST[c5]',
				 `comp_1`='$_POST[comp_1]',
				 `comp_2`='$_POST[comp_2]',
				 `comp_3`='$_POST[comp_3]',
				 `comp_4`='$_POST[comp_4]',
				 `comp_5`='$_POST[comp_5]',
				 `avg_comp`='$_POST[avg_comp]',
				 `chk_t_sp`='$_POST[chk_t_sp]',
				 `w1_c_1`='$_POST[w1_c_1]',
				 `w1_c_2`='$_POST[w1_c_2]',
				 `w1_c_3`='$_POST[w1_c_3]',
				 `w2_c_1`='$_POST[w2_c_1]',
				 `w2_c_2`='$_POST[w2_c_2]',
				 `w2_c_3`='$_POST[w2_c_3]',
				 `w3_c_1`='$_POST[w3_c_1]',
				 `w3_c_2`='$_POST[w3_c_2]',
				 `w3_c_3`='$_POST[w3_c_3]',
				 `w4_c_1`='$_POST[w4_c_1]',
				 `w4_c_2`='$_POST[w4_c_2]',
				 `w4_c_3`='$_POST[w4_c_3]',
				 `sp_1`='$_POST[sp_1]',
				 `sp_2`='$_POST[sp_2]',
				 `sp_3`='$_POST[sp_3]',
				 `avg_true_sp`='$_POST[avg_true_sp]',
				 `chk_sp`='$_POST[chk_sp]',
				 `od_1`='$_POST[od_1]',
				 `od_2`='$_POST[od_2]',
				 `od_3`='$_POST[od_3]',
				 `sd_1`='$_POST[sd_1]',
				 `sd_2`='$_POST[sd_2]',
				 `sd_3`='$_POST[sd_3]',
				 `wa_1`='$_POST[wa_1]',
				 `wa_2`='$_POST[wa_2]',
				 `wa_3`='$_POST[wa_3]',
				 `app_sp_1`='$_POST[app_sp_1]',
				 `app_sp_2`='$_POST[app_sp_2]',
				 `app_sp_3`='$_POST[app_sp_3]',
				 `avg_app_sp`='$_POST[avg_app_sp]',`modified_by`='$_SESSION[name]',`modified_date`='$curr_date' WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update span_building_stone SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM span_building_stone WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update span_building_stone SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update span_building_stone SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>