<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from wall_concrete_core WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'chk_com' => $result['chk_com'],
			'location1' => $result['location1'],
			'location2' => $result['location2'],
			'location3' => $result['location3'],
			'location4' => $result['location4'],
			'road_no' => $result['road_no'],
			'Chainage' => $result['Chainage'],
			'bic_1' => $result['bic_1'],
			'weight1' => $result['weight1'],
			'weight2' => $result['weight2'],
			'weight3' => $result['weight3'],
			'weight4' => $result['weight4'],
			'dia1' => $result['dia1'],
			'length1' => $result['length1'],
			'width1' => $result['width1'],
			'dia2' => $result['dia2'],
			'dia3' => $result['dia3'],
			'dia4' => $result['dia4'],
			'height1' => $result['height1'],
			'height2' => $result['height2'],
			'height3' => $result['height3'],
			'height4' => $result['height4'],
			'area1' => $result['area1'],
			'area2' => $result['area2'],
			'area3' => $result['area3'],
			'area4' => $result['area4'],
			'hd_ratio1' => $result['hd_ratio1'],
			'hd_ratio2' => $result['hd_ratio2'],
			'hd_ratio3' => $result['hd_ratio3'],
			'hd_ratio4' => $result['hd_ratio4'],
			'vol1' => $result['vol1'],
			'vol2' => $result['vol2'],
			'vol3' => $result['vol3'],
			'vol4' => $result['vol4'],
			'den1' => $result['den1'],
			'den2' => $result['den2'],
			'den3' => $result['den3'],
			'den4' => $result['den4'],
			'load1' => $result['load1'],
			'load2' => $result['load2'],
			'load3' => $result['load3'],
			'load4' => $result['load4'],
			'com1' => $result['com1'],
			'com2' => $result['com2'],
			'com3' => $result['com3'],
			'com4' => $result['com4'],
			'dia_corr1' => $result['dia_corr1'],
			'dia_corr2' => $result['dia_corr2'],
			'dia_corr3' => $result['dia_corr3'],
			'dia_corr4' => $result['dia_corr4'],
			'hd_corr1' => $result['hd_corr1'],
			'hd_corr2' => $result['hd_corr2'],
			'hd_corr3' => $result['hd_corr3'],
			'hd_corr4' => $result['hd_corr4'],
			'corr_com1' => $result['corr_com1'],
			'corr_com2' => $result['corr_com2'],
			'corr_com3' => $result['corr_com3'],
			'corr_com4' => $result['corr_com4'],
			'eq_cube1' => $result['eq_cube1'],
			'eq_cube2' => $result['eq_cube2'],
			'eq_cube3' => $result['eq_cube3'],
			'eq_cube4' => $result['eq_cube4'],
			'casting_date' => $result['casting_date'],
			'age1' => $result['age1'],
			're1' => $result['re1'],
		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr =  $_POST['ulr'];
		$amend_date =  $_POST['amend_date'];

		$chk_com = $_POST['chk_com'];
		$location1 = $_POST['location1'];
		$location2 = $_POST['location2'];
		$location3 = $_POST['location3'];
		$location4 = $_POST['location4'];
		$road_no = $_POST['road_no'];
		$Chainage = $_POST['Chainage'];
		$bic_1 = $_POST['bic_1'];
		$weight1 = $_POST['weight1'];
		$weight2 = $_POST['weight2'];
		$weight3 = $_POST['weight3'];
		$weight4 = $_POST['weight4'];
		$dia1 = $_POST['dia1'];
		$length1 = $_POST['length1'];
		$width1 = $_POST['width1'];
		$dia2 = $_POST['dia2'];
		$dia3 = $_POST['dia3'];
		$dia4 = $_POST['dia4'];
		$height1 = $_POST['height1'];
		$height2 = $_POST['height2'];
		$height3 = $_POST['height3'];
		$height4 = $_POST['height4'];
		$area1 = $_POST['area1'];
		$area2 = $_POST['area2'];
		$area3 = $_POST['area3'];
		$area4 = $_POST['area4'];
		$hd_ratio1 = $_POST['hd_ratio1'];
		$hd_ratio2 = $_POST['hd_ratio2'];
		$hd_ratio3 = $_POST['hd_ratio3'];
		$hd_ratio4 = $_POST['hd_ratio4'];
		$vol1 = $_POST['vol1'];
		$vol2 = $_POST['vol2'];
		$vol3 = $_POST['vol3'];
		$vol4 = $_POST['vol4'];
		$den1 = $_POST['den1'];
		$den2 = $_POST['den2'];
		$den3 = $_POST['den3'];
		$den4 = $_POST['den4'];
		$load1 = $_POST['load1'];
		$load2 = $_POST['load2'];
		$load3 = $_POST['load3'];
		$load4 = $_POST['load4'];
		$com1 = $_POST['com1'];
		$com2 = $_POST['com2'];
		$com3 = $_POST['com3'];
		$com4 = $_POST['com4'];
		$dia_corr1 = $_POST['dia_corr1'];
		$dia_corr2 = $_POST['dia_corr2'];
		$dia_corr3 = $_POST['dia_corr3'];
		$dia_corr4 = $_POST['dia_corr4'];
		$hd_corr1 = $_POST['hd_corr1'];
		$hd_corr2 = $_POST['hd_corr2'];
		$hd_corr3 = $_POST['hd_corr3'];
		$hd_corr4 = $_POST['hd_corr4'];
		$corr_com1 = $_POST['corr_com1'];
		$corr_com2 = $_POST['corr_com2'];
		$corr_com3 = $_POST['corr_com3'];
		$corr_com4 = $_POST['corr_com4'];
		$eq_cube1 = $_POST['eq_cube1'];
		$eq_cube2 = $_POST['eq_cube2'];
		$eq_cube3 = $_POST['eq_cube3'];
		$eq_cube4 = $_POST['eq_cube4'];

		$casting_date = $_POST['casting_date'];
		$age1 = $_POST['age1'];
		$re1 = $_POST['re1'];


		$curr_date = date("Y-m-d");
		$insert = "insert into wall_concrete_core (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_com`, `location1`, `location2`, `location3`, `location4`, `road_no`, `Chainage`, `bic_1`, `weight1`, `weight2`, `weight3`, `weight4`, `dia1`, `length1`, `width1`, `dia2`, `dia3`, `dia4`, `height1`, `height2`, `height3`, `height4`, `area1`, `area2`, `area3`, `area4`, `hd_ratio1`, `hd_ratio2`, `hd_ratio3`, `hd_ratio4`, `vol1`, `vol2`, `vol3`, `vol4`, `den1`, `den2`, `den3`, `den4`, `load1`, `load2`, `load3`, `load4`, `com1`, `com2`, `com3`, `com4`, `dia_corr1`, `dia_corr2`, `dia_corr3`, `dia_corr4`, `hd_corr1`, `hd_corr2`, `hd_corr3`, `hd_corr4`, `corr_com1`, `corr_com2`, `corr_com3`, `corr_com4`, `eq_cube1`, `eq_cube2`, `eq_cube3`, `eq_cube4`, `casting_date`, `age1`,`re1`,`amend_date`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_com', '$location1', '$location2', '$location3', '$location4', '$road_no', '$Chainage', '$bic_1', '$weight1', '$weight2', '$weight3', '$weight4', '$dia1','$length1','$width1', '$dia2', '$dia3', '$dia4', '$height1', '$height2', '$height3', '$height4', '$area1', '$area2', '$area3', '$area4', '$hd_ratio1', '$hd_ratio2', '$hd_ratio3', '$hd_ratio4', '$vol1', '$vol2', '$vol3', '$vol4', '$den1', '$den2', '$den3', '$den4', '$load1', '$load2', '$load3', '$load4', '$com1', '$com2', '$com3', '$com4', '$dia_corr1', '$dia_corr2', '$dia_corr3', '$dia_corr4', '$hd_corr1', '$hd_corr2', '$hd_corr3', '$hd_corr4', '$corr_com1', '$corr_com2', '$corr_com3', '$corr_com4', '$eq_cube1', '$eq_cube2', '$eq_cube3', '$eq_cube4', '$casting_date', '$age1', '$re1', '$amend_date')";
		$result_of_insert = mysqli_query($conn, $insert);

		$query = "select * from wall_concrete_core WHERE lab_no='$lab_no' AND job_no='$job_no' and `is_deleted`='0'";
		$result = mysqli_query($conn, $query);
		$fill = array('lab_no' => $_POST['lab_no'], 'row_count' => mysqli_num_rows($result));
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'view') {
		$lab_no = $_POST['lab_no'];
		$job_no = $_POST['job_no'];

?>
		<div id="display_data">
			<div class="row">
				<div class="col-lg-12">
					<table border="1px solid black" align="center" width="100%" id="aaaa">
						<tr>
							<th style="text-align:center;" width="2%"><label>Actions</label></th>
							<th style="text-align:center;width:10%;"><label>Lab No.</label></th>
							<!--<th style="text-align:center;"><label>Job No.</label></th>-->
							<th style="text-align:center;width:5%;"><label>Weight</label></th>
							<th style="text-align:center;width:5%;"><label>Dia</label></th>
							<th style="text-align:center;width:5%;"><label>Height</label></th>
							<th style="text-align:center;width:5%;"><label>Area</label></th>
							<th style="text-align:center;width:5%;"><label>H/D <br> Ratio</label></th>
							<th style="text-align:center;width:5%;"><label>Volume</label></th>
							<th style="text-align:center;width:5%;"><label>Density</label></th>
							<th style="text-align:center;width:5%;"><label>Load</label></th>
							<th style="text-align:center;width:8%;"><label>Comp. Str.</label></th>
							<th style="text-align:center;width:8%;"><label>Diameter <br> Correction</label></th>
							<th style="text-align:center;width:8%;"><label>H/D <br> Correction</label></th>
							<th style="text-align:center;width:8%;"><label>Corrected <br> Comp. Str.</label></th>
							<th style="text-align:center;width:8%;"><label>Equiv. Cube <br> Strength</label></th>
						</tr>
						<?php
						$query = "select * from wall_concrete_core WHERE lab_no='$lab_no' AND job_no='$job_no' and `is_deleted`='0'";
						$result = mysqli_query($conn, $query);
						if (mysqli_num_rows($result) > 0) {
							while ($r = mysqli_fetch_array($result)) {
								if ($r['is_deleted'] == 0) {
						?>
									<tr>
										<td style="text-align:center;">
											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
										</td>
										<td style="text-align:center;"><?php echo $r['job_no']; ?></td>
										<!--<td style="text-align:center;"><?php echo $r['lab_no']; ?></td>-->
										<td style="text-align:center;"><?php echo $r['weight1']; ?></td>
										<td style="text-align:center;"><?php echo $r['dia1']; ?></td>
										<td style="text-align:center;"><?php echo $r['height1']; ?></td>
										<td style="text-align:center;"><?php echo $r['area1']; ?></td>
										<td style="text-align:center;"><?php echo $r['hd_ratio1']; ?></td>
										<td style="text-align:center;"><?php echo $r['vol1']; ?></td>
										<td style="text-align:center;"><?php echo $r['den1']; ?></td>
										<td style="text-align:center;"><?php echo $r['load1']; ?></td>
										<td style="text-align:center;"><?php echo $r['com1']; ?></td>
										<td style="text-align:center;"><?php echo $r['dia_corr1']; ?></td>
										<td style="text-align:center;"><?php echo $r['hd_corr1']; ?></td>
										<td style="text-align:center;"><?php echo $r['corr_com1']; ?></td>
										<td style="text-align:center;"><?php echo $r['eq_cube1']; ?></td>
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

		$update = "update wall_concrete_core SET 
		`job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',
		`chk_com`='$_POST[chk_com]',
		`location1`='$_POST[location1]',
		`location2`='$_POST[location2]',
		`location3`='$_POST[location3]',
		`location4`='$_POST[location4]',
		`road_no`='$_POST[road_no]',
		`Chainage`='$_POST[Chainage]',
		`bic_1`='$_POST[bic_1]',
		`weight1`='$_POST[weight1]',
		`weight2`='$_POST[weight2]',
		`weight3`='$_POST[weight3]',
		`weight4`='$_POST[weight4]',
		`dia1`='$_POST[dia1]',
		`length1`='$_POST[length1]',
		`width1`='$_POST[width1]',
		`dia2`='$_POST[dia2]',
		`dia3`='$_POST[dia3]',
		`dia4`='$_POST[dia4]',
		`height1`='$_POST[height1]',
		`height2`='$_POST[height2]',
		`height3`='$_POST[height3]',
		`height4`='$_POST[height4]',
		`area1`='$_POST[area1]',
		`area2`='$_POST[area2]',
		`area3`='$_POST[area3]',
		`area4`='$_POST[area4]',
		`hd_ratio1`='$_POST[hd_ratio1]',
		`hd_ratio2`='$_POST[hd_ratio2]',
		`hd_ratio3`='$_POST[hd_ratio3]',
		`hd_ratio4`='$_POST[hd_ratio4]',
		`vol1`='$_POST[vol1]',
		`vol2`='$_POST[vol2]',
		`vol3`='$_POST[vol3]',
		`vol4`='$_POST[vol4]',
		`den1`='$_POST[den1]',
		`den2`='$_POST[den2]',
		`den3`='$_POST[den3]',
		`den4`='$_POST[den4]',
		`load1`='$_POST[load1]',
		`load2`='$_POST[load2]',
		`load3`='$_POST[load3]',
		`load4`='$_POST[load4]',
		`com1`='$_POST[com1]',
		`com2`='$_POST[com2]',
		`com3`='$_POST[com3]',
		`com4`='$_POST[com4]',
		`dia_corr1`='$_POST[dia_corr1]',
		`dia_corr2`='$_POST[dia_corr2]',
		`dia_corr3`='$_POST[dia_corr3]',
		`dia_corr4`='$_POST[dia_corr4]',
		`hd_corr1`='$_POST[hd_corr1]',
		`hd_corr2`='$_POST[hd_corr2]',
		`hd_corr3`='$_POST[hd_corr3]',
		`hd_corr4`='$_POST[hd_corr4]',
		`corr_com1`='$_POST[corr_com1]',
		`corr_com2`='$_POST[corr_com2]',
		`corr_com3`='$_POST[corr_com3]',
		`corr_com4`='$_POST[corr_com4]',
		`eq_cube1`='$_POST[eq_cube1]',
		`eq_cube2`='$_POST[eq_cube2]',
		`eq_cube3`='$_POST[eq_cube3]',
		`eq_cube4`='$_POST[eq_cube4]',
		`casting_date`='$_POST[casting_date]',
		`age1`='$_POST[age1]',
		`re1`='$_POST[re1]',
		`amend_date`='$_POST[amend_date]',
		`checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {
		$id = $_POST['id'];
		$lab_no = $_POST['lab_no'];
		$job_no = $_POST['job_no'];
		$delete = "update wall_concrete_core SET `is_deleted`='1', `deleted_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
		if (mysqli_query($conn, $delete)) {
			$query = "select * from wall_concrete_core WHERE lab_no='$lab_no' AND job_no='$job_no' and `is_deleted`='0'";
			$result = mysqli_query($conn, $query);
			$fill = array('status' => 'success', 'row_count' => mysqli_num_rows($result));
		} else {
			$query = "select * from wall_concrete_core WHERE lab_no='$lab_no' AND job_no='$job_no' and `is_deleted`='0'";
			$result = mysqli_query($conn, $query);
			$fill = array('status' => 'success', 'row_count' => mysqli_num_rows($result));
		}
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM wall_concrete_core WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update wall_concrete_core SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update wall_concrete_core SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
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