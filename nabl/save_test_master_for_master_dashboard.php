<?php
session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {

	/*if($_POST['action_type'] == 'get_material_by_category'){
		 
			$mat_category_id= $_POST["mat_category_id"];
			$get_query = "select * from material WHERE mat_category_id=$mat_category_id AND `mt_isdeleted`='0'"; 
			$select_result = mysqli_query($conn, $get_query);
			$out_materials='<option value="" >Select Material</option>';
			if (mysqli_num_rows($select_result) > 0) {
				while($row = mysqli_fetch_assoc($select_result)) {
					
				$out_materials .='<option value="'.$row['id'].'" >'.$row['mt_name'].'</option>';
				}
				}
			
		 $fill = array('all_material' => $out_materials);	
			
		   
			echo json_encode($fill);
		}
		else*/
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from test_master WHERE test_id='$_POST[id]' and test_isdeleted=
			'0'";
		$select_result = mysqli_query($conn, $get_query);

		$result = mysqli_fetch_array($select_result);
		$test_id = $result['test_id'];
		$mat_category_id = $result['mat_category_id'];
		$test_name = $result['test_name'];
		$hsn_code = $result['hsn_code'];
		$test_rate = $result['test_rate'];
		$test_rate_private = $result['test_rate_private'];
		$test_rate_gov = $result['test_rate_gov'];
		$per_day_limit = $result['per_day_limit'];
		$test_method = $result['test_method'];
		$test_code = $result['test_code'];
		$cap_per_day = $result['cap_per_day'];
		$in_nabl = $result['in_nabl'];
		$fill = array(
			'test_id' => $test_id,
			'mat_category_id' => $mat_category_id,
			'test_name' => $test_name,
			'hsn_code' => $hsn_code,
			'test_rate' => $test_rate,
			'test_rate_private' => $test_rate_private,
			'test_rate_gov' => $test_rate_gov,
			'per_day_limit' => $per_day_limit,
			'test_method' => $test_method,
			'test_code' => $test_code,
			'cap_per_day' => $cap_per_day,
			'in_nabl' => $in_nabl
		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {

		$mat_category_id = $_POST['mat_category_id'];
		$test_name = $_POST['test_name'];
		$hsn_code = $_POST['hsn_code'];
		$test_rate = $_POST['test_rate'];
		$test_rate_private = $_POST['test_rate_private'];
		$test_rate_gov = $_POST['test_rate_gov'];
		$per_day_limit = $_POST['per_day_limit'];
		$test_code = $_POST['test_code'];
		$test_method = $_POST['test_method'];
		$cap_per_day = $_POST['cap_per_day'];
		$in_nabl = $_POST['in_nabl'];
		$test_date_today = date("Y-m-d");
		$insert = "INSERT INTO `test_master`(`mat_category_id`,`test_name`,`test_rate`,`test_rate_private`,`test_rate_gov`,`per_day_limit`,`test_method`,`test_code`,`test_createdby`,`test_createdate`,`test_modifiedby`,`test_modifieddate`,`test_isdeleted`,`hsn_code`,`cap_per_day`,`in_nabl`)VALUES('$mat_category_id','$test_name','$test_rate','$test_rate_private','$test_rate_gov','$per_day_limit','$test_method','$test_code','$_SESSION[name]','$test_date_today','','0000-00-00','0','$hsn_code',$cap_per_day,'$in_nabl')";
		$result_of_insert = mysqli_query($conn, $insert);
		$fill = ($result_of_insert);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'view') { ?>
		<div id="data_test">
			<table class="table table-striped">
				<thead>
					<tr>
						<th></th>
						<th>Category Name</th>

						<th>Test Name</th>
						<th>HSN Code</th>
						<th>Test Rate</th>
						<th>Test Rate Private</th>
						<th>Test Rate Goverment</th>
						<th>Required Day</th>
						<th>Test Method</th>
						<th>Test Code</th>
						<th>Capacity / Day</th>
						<th>In Nabl</th>
					</tr>
				</thead>
				<tbody id="mtData">
					<?php
					$select_record = "select * from test_master where test_isdeleted='0'";
					$select_qry_test = mysqli_query($conn, $select_record);
					if (mysqli_num_rows($select_qry_test) > 0) {
						$count = 1;
						while ($rows_rec = mysqli_fetch_array($select_qry_test)) {
							$cat_id_rec = $rows_rec['mat_category_id'];
							$mat_id_rec = $rows_rec['material_id'];
							$get_cat_name = "select * from material_category where material_cat_id = '$cat_id_rec'";
							$qry_select_cat = mysqli_query($conn, $get_cat_name);
							if (mysqli_num_rows($qry_select_cat) > 0) {
								while ($row_cat = mysqli_fetch_array($qry_select_cat)) {
									$category_name_by_id = $row_cat['material_cat_name'];
								}
							}

					?>
							<tr>
								<td><?php echo '#' . $count; ?></td>
								<td><?php echo $category_name_by_id; ?></td>
								<td><?php echo $rows_rec['test_name']; ?></td>
								<td><?php echo $rows_rec['hsn_code']; ?></td>
								<td><?php echo $rows_rec['test_rate']; ?></td>
								<td><?php echo $rows_rec['test_rate_private']; ?></td>
								<td><?php echo $rows_rec['test_rate_gov']; ?></td>
								<td><?php echo $rows_rec['per_day_limit']; ?></td>
								<td><?php echo $rows_rec['test_method']; ?></td>
								<td><?php echo $rows_rec['test_code']; ?></td>
								<td><?php echo $rows_rec['cap_per_day']; ?></td>
								<td><?php echo $rows_rec['in_nabl']; ?></td>
								<td>
									<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editmt('<?php echo $rows_rec['test_id']; ?>')"></a>
									<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?mate_catAction('delete','<?php echo $rows_rec['test_id']; ?>'):false;"></a>
								</td>
							</tr>
					<?php
							$count++;
						}
					}
					?>
				</tbody>
			</table>
		</div> <?php
			} else if ($_POST['action_type'] == 'edit') {


				$mat_category_id = $_POST['edit_mat_category_id'];
				$test_name = $_POST['edit_test_name'];
				$hsn_code = $_POST['edit_hsn_code'];
				$test_rate = $_POST['edit_test_rate'];
				$test_rate_private = $_POST['edit_test_rate_private'];
				$test_rate_gov = $_POST['edit_test_rate_gov'];
				$per_day_limit = $_POST['edit_per_day_limit'];
				$test_code = $_POST['edit_test_code'];
				$edit_cap_per_day = $_POST['edit_cap_per_day'];
				$edit_in_nabl = $_POST['edit_in_nabl'];
				$test_method = $_POST['test_method'];
				$test_date_today = date("Y-m-d");

				$update = "UPDATE `test_master` SET `mat_category_id`='$_POST[edit_mat_category_id]',`test_name`='$_POST[edit_test_name]',`hsn_code`='$_POST[edit_hsn_code]',`test_rate`='$_POST[edit_test_rate]',`test_rate_private`='$_POST[edit_test_rate_private]',`test_rate_gov`='$_POST[edit_test_rate_gov]',`per_day_limit`='$_POST[edit_per_day_limit]',`test_code`='$_POST[edit_test_code]',`test_method`='$_POST[edit_test_method]',`test_modifiedby`='$_SESSION[name]',`test_modifieddate`='$test_date_today',`cap_per_day`=$edit_cap_per_day,`in_nabl`='$edit_in_nabl' WHERE `test_id`='$_POST[id]'";

				$result_of_update = mysqli_query($conn, $update);


				$fill = array($result_of_update);
				echo json_encode($fill);
			} else {
				$update = "UPDATE `test_master` SET `test_isdeleted`='1' WHERE `test_id`='$_POST[id]'";
				$result_of_update = mysqli_query($conn, $update);
				$fill = array($result_of_update);
				echo json_encode($fill);
			}
			exit;
		}
				?>