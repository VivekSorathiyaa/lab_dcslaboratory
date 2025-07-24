<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from clc_block WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'in_l' => $result['in_l'],
			'in_w' => $result['in_w'],
			'in_h' => $result['in_h'],
			'in_grade' => $result['in_grade'],
			'in_den' => $result['in_den'],
			'chk_com' => $result['chk_com'],
			'avg_com' => $result['avg_com'],
			'sample_1' => $result['sample_1'],
			'sample_2' => $result['sample_2'],
			'sample_3' => $result['sample_3'],
			'l_1' => $result['l_1'],
			'l_2' => $result['l_2'],
			'l_3' => $result['l_3'],
			'w_1' => $result['w_1'],
			'w_2' => $result['w_2'],
			'w_3' => $result['w_3'],
			'h_1' => $result['h_1'],
			'h_2' => $result['h_2'],
			'h_3' => $result['h_3'],
			'load_1' => $result['load_1'],
			'load_2' => $result['load_2'],
			'load_3' => $result['load_3'],
			'area_1' => $result['area_1'],
			'area_2' => $result['area_2'],
			'area_3' => $result['area_3'],
			'com_1' => $result['com_1'],
			'com_2' => $result['com_2'],
			'com_3' => $result['com_3'],
			'chk_dim' => $result['chk_dim'],
			'dim_length' => $result['dim_length'],
			'dim_width' => $result['dim_width'],
			'dim_height' => $result['dim_height'],
			'dim_l1' => $result['dim_l1'],
			'dim_l2' => $result['dim_l2'],
			'dim_l3' => $result['dim_l3'],
			'dim_l4' => $result['dim_l4'],
			'dim_h1' => $result['dim_h1'],
			'dim_h2' => $result['dim_h2'],
			'dim_h3' => $result['dim_h3'],
			'dim_h4' => $result['dim_h4'],
			'dim_h5' => $result['dim_h5'],
			'dim_h6' => $result['dim_h6'],
			'dim_w1' => $result['dim_w1'],
			'dim_w2' => $result['dim_w2'],
			'dim_w3' => $result['dim_w3'],
			'dim_w4' => $result['dim_w4'],
			'dim_w5' => $result['dim_w5'],
			'dim_w6' => $result['dim_w6'],
			'chk_den' => $result['chk_den'],
			'dl_1' => $result['dl_1'],
			'dl_2' => $result['dl_2'],
			'dl_3' => $result['dl_3'],
			'dw_1' => $result['dw_1'],
			'dw_2' => $result['dw_2'],
			'dw_3' => $result['dw_3'],
			'dh_1' => $result['dh_1'],
			'dh_2' => $result['dh_2'],
			'dh_3' => $result['dh_3'],
			'vol_1' => $result['vol_1'],
			'vol_2' => $result['vol_2'],
			'vol_3' => $result['vol_3'],
			'weight_1' => $result['weight_1'],
			'weight_2' => $result['weight_2'],
			'weight_3' => $result['weight_3'],
			'den_1' => $result['den_1'],
			'den_2' => $result['den_2'],
			'den_3' => $result['den_3'],
			'wa_1' => $result['wa_1'],
			'wa_2' => $result['wa_2'],
			'wa_3' => $result['wa_3'],
			'w1' => $result['w1'],
			'w2' => $result['w2'],
			'w3' => $result['w3'],
			'mc' => $result['mc'],
			'bdl' => $result['bdl'],
			'bdl_kg' => $result['bdl_kg'],
			'chk_shr' => $result['chk_shr'],
			'con_1' => $result['con_1'],
			'con_2' => $result['con_2'],
			'con_3' => $result['con_3'],
			'fr_1' => $result['fr_1'],
			'fr_2' => $result['fr_2'],
			'fr_3' => $result['fr_3'],
			'fi_1' => $result['fi_1'],
			'fi_2' => $result['fi_2'],
			'fi_3' => $result['fi_3'],
			'ds_1' => $result['ds_1'],
			'ds_2' => $result['ds_2'],
			'ds_3' => $result['ds_3'],
			'con_wid_1' => $result['con_wid_1'],
			'con_wid_2' => $result['con_wid_2'],
			'con_wid_3' => $result['con_wid_3'],
			'con_thi_1' => $result['con_thi_1'],
			'con_thi_2' => $result['con_thi_2'],
			'con_thi_3' => $result['con_thi_3'],
			'avg_shrink' => $result['avg_shrink']


		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr = $_POST['ulr'];
		$amend_date = $_POST['amend_date'];

		$in_l = $_POST['in_l'];
		$in_w = $_POST['in_w'];
		$in_h = $_POST['in_h'];
		$in_grade = $_POST['in_grade'];
		$in_den = $_POST['in_den'];
		$chk_com = $_POST['chk_com'];
		$avg_com = $_POST['avg_com'];
		$sample_1 = $_POST['sample_1'];
		$sample_2 = $_POST['sample_2'];
		$sample_3 = $_POST['sample_3'];
		$l_1 = $_POST['l_1'];
		$l_2 = $_POST['l_2'];
		$l_3 = $_POST['l_3'];
		$w_1 = $_POST['w_1'];
		$w_2 = $_POST['w_2'];
		$w_3 = $_POST['w_3'];
		$h_1 = $_POST['h_1'];
		$h_2 = $_POST['h_2'];
		$h_3 = $_POST['h_3'];
		$load_1 = $_POST['load_1'];
		$load_2 = $_POST['load_2'];
		$load_3 = $_POST['load_3'];
		$area_1 = $_POST['area_1'];
		$area_2 = $_POST['area_2'];
		$area_3 = $_POST['area_3'];
		$com_1 = $_POST['com_1'];
		$com_2 = $_POST['com_2'];
		$com_3 = $_POST['com_3'];
		$chk_dim = $_POST['chk_dim'];
		$dim_length = $_POST['dim_length'];
		$dim_width = $_POST['dim_width'];
		$dim_height = $_POST['dim_height'];
		$dim_l1 = $_POST['dim_l1'];
		$dim_l2 = $_POST['dim_l2'];
		$dim_l3 = $_POST['dim_l3'];
		$dim_l4 = $_POST['dim_l4'];
		$dim_h1 = $_POST['dim_h1'];
		$dim_h2 = $_POST['dim_h2'];
		$dim_h3 = $_POST['dim_h3'];
		$dim_h4 = $_POST['dim_h4'];
		$dim_h5 = $_POST['dim_h5'];
		$dim_h6 = $_POST['dim_h6'];
		$dim_w1 = $_POST['dim_w1'];
		$dim_w2 = $_POST['dim_w2'];
		$dim_w3 = $_POST['dim_w3'];
		$dim_w4 = $_POST['dim_w4'];
		$dim_w5 = $_POST['dim_w5'];
		$dim_w6 = $_POST['dim_w6'];
		$chk_den = $_POST['chk_den'];
		$dl_1 = $_POST['dl_1'];
		$dl_2 = $_POST['dl_2'];
		$dl_3 = $_POST['dl_3'];
		$dw_1 = $_POST['dw_1'];
		$dw_2 = $_POST['dw_2'];
		$dw_3 = $_POST['dw_3'];
		$dh_1 = $_POST['dh_1'];
		$dh_2 = $_POST['dh_2'];
		$dh_3 = $_POST['dh_3'];
		$vol_1 = $_POST['vol_1'];
		$vol_2 = $_POST['vol_2'];
		$vol_3 = $_POST['vol_3'];
		$weight_1 = $_POST['weight_1'];
		$weight_2 = $_POST['weight_2'];
		$weight_3 = $_POST['weight_3'];
		$den_1 = $_POST['den_1'];
		$den_2 = $_POST['den_2'];
		$den_3 = $_POST['den_3'];
		$wa_1 = $_POST['wa_1'];
		$wa_2 = $_POST['wa_2'];
		$wa_3 = $_POST['wa_3'];
		$w1 = $_POST['w1'];
		$w2 = $_POST['w2'];
		$w3 = $_POST['w3'];
		$mc = $_POST['mc'];
		$bdl = $_POST['bdl'];
		$bdl_kg = $_POST['bdl_kg'];
		$chk_shr = $_POST['chk_shr'];
		$con_1 = $_POST['con_1'];
		$con_2 = $_POST['con_2'];
		$con_3 = $_POST['con_3'];
		$fr_1 = $_POST['fr_1'];
		$fr_2 = $_POST['fr_2'];
		$fr_3 = $_POST['fr_3'];
		$fi_1 = $_POST['fi_1'];
		$fi_2 = $_POST['fi_2'];
		$fi_3 = $_POST['fi_3'];
		$ds_1 = $_POST['ds_1'];
		$ds_2 = $_POST['ds_2'];
		$ds_3 = $_POST['ds_3'];
		$con_wid_1 = $_POST['con_wid_1'];
		$con_wid_2 = $_POST['con_wid_2'];
		$con_wid_3 = $_POST['con_wid_3'];
		$con_thi_1 = $_POST['con_thi_1'];
		$con_thi_2 = $_POST['con_thi_2'];
		$con_thi_3 = $_POST['con_thi_3'];
		$avg_shrink = $_POST['avg_shrink'];



		$curr_date = date("Y-m-d");



		$insert = "INSERT INTO `clc_block`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `in_l`, `in_w`, `in_h`, `in_den`, `in_grade`, `chk_dim`, `dim_length`, `dim_width`, `dim_height`, `dim_l1`, `dim_l2`, `dim_l3`, `dim_l4`, `dim_w1`, `dim_w2`, `dim_w3`, `dim_w4`, `dim_w5`, `dim_w6`, `dim_h1`, `dim_h2`, `dim_h3`, `dim_h4`, `dim_h5`, `dim_h6`, `chk_com`, `sample_1`, `sample_2`, `sample_3`, `l_1`, `l_2`, `l_3`, `w_1`, `w_2`, `w_3`, `h_1`, `h_2`, `h_3`, `load_1`, `load_2`, `load_3`, `area_1`, `area_2`, `area_3`, `com_1`, `com_2`, `com_3`, `avg_com`, `chk_den`, `dl_1`, `dl_2`, `dl_3`, `dw_1`, `dw_2`, `dw_3`, `dh_1`, `dh_2`, `dh_3`, `vol_1`, `vol_2`, `vol_3`, `weight_1`, `weight_2`, `weight_3`, `den_1`, `den_2`, `den_3`, `bdl`, `bdl_kg`, `w1`, `w2`, `w3`, `wa_1`, `wa_2`, `wa_3`, `mc`, `chk_shr`, `con_1`, `con_2`, `con_3`, `fr_1`, `fr_2`, `fr_3`, `fi_1`, `fi_2`, `fi_3`, `ds_1`, `ds_2`, `ds_3`, `avg_shrink`, `con_wid_1`, `con_wid_2`, `con_wid_3`, `con_thi_1`, `con_thi_2`, `con_thi_3`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$in_l', '$in_w', '$in_h', '$in_den', '$in_grade', '$chk_dim', '$dim_length', '$dim_width', '$dim_height', '$dim_l1', '$dim_l2', '$dim_l3', '$dim_l4', '$dim_w1', '$dim_w2', '$dim_w3', '$dim_w4', '$dim_w5', '$dim_w6', '$dim_h1', '$dim_h2', '$dim_h3', '$dim_h4', '$dim_h5', '$dim_h6', '$chk_com', '$sample_1', '$sample_2', '$sample_3', '$l_1', '$l_2', '$l_3', '$w_1', '$w_2', '$w_3', '$h_1', '$h_2', '$h_3', '$load_1', '$load_2', '$load_3', '$area_1', '$area_2', '$area_3', '$com_1', '$com_2', '$com_3', '$avg_com', '$chk_den', '$dl_1', '$dl_2', '$dl_3', '$dw_1', '$dw_2', '$dw_3', '$dh_1', '$dh_2', '$dh_3', '$vol_1', '$vol_2', '$vol_3', '$weight_1', '$weight_2', '$weight_3', '$den_1', '$den_2', '$den_3', '$bdl', '$bdl_kg', '$w1', '$w2', '$w3', '$wa_1', '$wa_2', '$wa_3', '$mc', '$chk_shr', '$con_1', '$con_2', '$con_3', '$fr_1', '$fr_2', '$fr_3', '$fi_1', '$fi_2', '$fi_3', '$ds_1', '$ds_2', '$ds_3', '$avg_shrink', '$con_wid_1', '$con_wid_2', '$con_wid_3', '$con_thi_1', '$con_thi_2', '$con_thi_3', '$amend_date')";

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
						$query = "select * from `clc_block` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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



		$update = "update clc_block SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,	
					`in_l`= '$_POST[in_l]',
					`in_w`= '$_POST[in_w]',
					`in_h`= '$_POST[in_h]',
					`in_grade`= '$_POST[in_grade]',
					`in_den`= '$_POST[in_den]',
					`chk_com`= '$_POST[chk_com]',
					`avg_com`= '$_POST[avg_com]',												
					`sample_1`= '$_POST[sample_1]',							
					`sample_2`= '$_POST[sample_2]',							
					`sample_3`= '$_POST[sample_3]',
					`l_1`= '$_POST[l_1]',							
					`l_2`= '$_POST[l_2]',							
					`l_3`= '$_POST[l_3]',
					`w_1`= '$_POST[w_1]',							
					`w_2`= '$_POST[w_2]',							
					`w_3`= '$_POST[w_3]',
					`h_1`= '$_POST[h_1]',							
					`h_2`= '$_POST[h_2]',							
					`h_3`= '$_POST[h_3]',
					`load_1`= '$_POST[load_1]',							
					`load_2`= '$_POST[load_2]',							
					`load_3`= '$_POST[load_3]',
					`area_1`= '$_POST[area_1]',							
					`area_2`= '$_POST[area_2]',							
					`area_3`= '$_POST[area_3]',
					`com_1`= '$_POST[com_1]',							
					`com_2`= '$_POST[com_2]',							
					`com_3`= '$_POST[com_3]',
					`chk_dim`= '$_POST[chk_dim]',
					`dim_length`= '$_POST[dim_length]',
					`dim_width`= '$_POST[dim_width]',
					`dim_height`= '$_POST[dim_height]',							
					`dim_l1`= '$_POST[dim_l1]',							
					`dim_l2`= '$_POST[dim_l2]',							
					`dim_l3`= '$_POST[dim_l3]',
					`dim_l4`= '$_POST[dim_l4]',
					`dim_h1`= '$_POST[dim_h1]',							
					`dim_h2`= '$_POST[dim_h2]',							
					`dim_h3`= '$_POST[dim_h3]',
					`dim_h4`= '$_POST[dim_h4]',							
					`dim_h5`= '$_POST[dim_h5]',							
					`dim_h6`= '$_POST[dim_h6]',							
					`dim_w1`= '$_POST[dim_w1]',							
					`dim_w2`= '$_POST[dim_w2]',							
					`dim_w3`= '$_POST[dim_w3]',
					`dim_w4`= '$_POST[dim_w4]',							
					`dim_w5`= '$_POST[dim_w5]',							
					`dim_w6`= '$_POST[dim_w6]',							
					`chk_den`= '$_POST[chk_den]',							
					`dl_1`= '$_POST[dl_1]',							
					`dl_2`= '$_POST[dl_2]',							
					`dl_3`= '$_POST[dl_3]',
					`dw_1`= '$_POST[dw_1]',							
					`dw_2`= '$_POST[dw_2]',							
					`dw_3`= '$_POST[dw_3]',
					`dh_1`= '$_POST[dh_1]',							
					`dh_2`= '$_POST[dh_2]',							
					`dh_3`= '$_POST[dh_3]',
					`vol_1`= '$_POST[vol_1]',							
					`vol_2`= '$_POST[vol_2]',							
					`vol_3`= '$_POST[vol_3]',
					`weight_1`= '$_POST[weight_1]',							
					`weight_2`= '$_POST[weight_2]',							
					`weight_3`= '$_POST[weight_3]',
					`den_1`= '$_POST[den_1]',							
					`den_2`= '$_POST[den_2]',							
					`den_3`= '$_POST[den_3]',
					`wa_1`= '$_POST[wa_1]',							
					`wa_2`= '$_POST[wa_2]',							
					`wa_3`= '$_POST[wa_3]',
					`w1`= '$_POST[w1]',							
					`w2`= '$_POST[w2]',							
					`w3`= '$_POST[w3]',
					`mc`= '$_POST[mc]',
					`bdl`= '$_POST[bdl]',
					`bdl_kg`= '$_POST[bdl_kg]',												
					`chk_shr`= '$_POST[chk_shr]',
					`con_1`= '$_POST[con_1]',							
					`con_2`= '$_POST[con_2]',							
					`con_3`= '$_POST[con_3]',
					`fr_1`= '$_POST[fr_1]',							
					`fr_2`= '$_POST[fr_2]',							
					`fr_3`= '$_POST[fr_3]',
					`fi_1`= '$_POST[fi_1]',							
					`fi_2`= '$_POST[fi_2]',							
					`fi_3`= '$_POST[fi_3]',
					`ds_1`= '$_POST[ds_1]',							
					`ds_2`= '$_POST[ds_2]',							
					`ds_3`= '$_POST[ds_3]',
					`con_wid_1`= '$_POST[con_wid_1]',							
					`con_wid_2`= '$_POST[con_wid_2]',							
					`con_wid_3`= '$_POST[con_wid_3]',
					`con_thi_1`= '$_POST[con_thi_1]',							
					`con_thi_2`= '$_POST[con_thi_2]',							
					`con_thi_3`= '$_POST[con_thi_3]',
					`avg_shrink`= '$_POST[avg_shrink]',
					`amend_date`= '$_POST[amend_date]'
				 
				  WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update clc_block SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM clc_block WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update clc_block SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update clc_block SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>