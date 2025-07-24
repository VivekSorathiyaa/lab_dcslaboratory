<?php
include('connection.php');
error_reporting(1);
if ($_POST['action_type'] == "display_data") {
	$select_data = "SELECT * FROM `tasks` WHERE `task_deleted`='0'";
	$result_data = mysqli_query($conn, $select_data);
	if (mysqli_num_rows($result_data) > 0) {
		$count = 1;
		while ($row_data = mysqli_fetch_array($result_data)) {
?>
			<tr>
				<td><?php echo $count; ?></td>
				<td><?php echo $row_data['task_asign_to']; ?></td>
				<td><?php echo $row_data['task_name']; ?></td>
				<td><?php echo $row_data['task_end_date']; ?></td>
				<td><?php echo $row_data['task_end_date']; ?></td>
				<td><?php echo $row_data['task_narr']; ?></td>
				<td><?php echo $row_data['task_status']; ?></td>
				<td><?php echo $row_data['task_id']; ?></td>
				<td>
					<i class="fa fa-edit" data-id="<?php echo $row_data['task_id']; ?>"></i>

				</td>
			</tr>
		<?php
			$count++;
		}
	}
}



if ($_POST['action_type'] == "insert_task") {

	$u_id = $_POST['u_id'];
	$task_assign_to = $_POST['task_assign_to'];
	$staff = $_POST['staff'];
	$task_name = $_POST['task_name'];
	$task_narr = $_POST['task_narr'];
	$task_end_date = date('Y-m-d', strtotime($_POST['task_end_date']));
	$task_view_date = date('Y-m-d', strtotime($_POST['task_view_date']));

	$upload1 = $_FILES['upload1']['name'];
	$upload2 = $_FILES['upload2']['name'];
	$upload3 = $_FILES['upload3']['name'];
	$upload4 = $_FILES['upload4']['name'];
	$upload5 = $_FILES['upload5']['name'];
	mkdir("task_upload/" . $u_id);
	if ($upload1 != "") {
		move_uploaded_file($_FILES['upload1']['tmp_name'], 'task_upload/' . $u_id . '/' . $_FILES["upload1"]['name']);
	}
	if ($upload2 != "") {
		move_uploaded_file($_FILES['upload2']['tmp_name'], 'task_upload/' . $u_id . '/' . $_FILES["upload2"]['name']);
	}
	if ($upload3 != "") {
		move_uploaded_file($_FILES['upload3']['tmp_name'], 'task_upload/' . $u_id . '/' . $_FILES["upload3"]['name']);
	}
	if ($upload4 != "") {
		move_uploaded_file($_FILES['upload4']['tmp_name'], 'task_upload/' . $u_id . '/' . $_FILES["upload4"]['name']);
	}
	if ($upload5 != "") {
		move_uploaded_file($_FILES['upload5']['tmp_name'], 'task_upload/' . $u_id . '/' . $_FILES["upload5"]['name']);
	}

	$get_tasks = "SELECT * FROM `tasks` WHERE `task_asign_to`='$task_assign_to' AND `task_completed`=0 AND `task_deleted`=0 ORDER BY `task_priority` DESC";
	$res_tasks = mysqli_query($conn, $get_tasks);
	if (mysqli_num_rows($res_tasks) > 0) {
		$get_tasks_row = mysqli_fetch_array($res_tasks);
		$set_priority = $get_tasks_row['task_priority'];
		$set_priority++;
	} else {
		$set_priority = 1;
	}

	$ins_task = "INSERT INTO `tasks`(`task_u_id`, `task_asign_to`, `task_name`, `task_narr`, `task_view_date`, `task_end_date`, `staff`, `upload1`, `upload2`, `upload3`, `upload4`, `upload5`, `task_priority`) VALUES ('$u_id', '$task_assign_to', '$task_name', '$task_narr', '$task_view_date', '$task_end_date', '$staff', '$upload1', '$upload2', '$upload3', '$upload4', '$upload5', '$set_priority')";
	if (mysqli_query($conn, $ins_task)) {

		echo 'success';
	}
}



//Delete Tasks
if ($_POST['action_type'] == "dlt_task") {
	$task_id = $_POST['task_id'];
	$dlt_task_qry = "UPDATE `tasks` SET `task_deleted`='1' WHERE `task_id`='$task_id'";
	if (mysqli_query($conn, $dlt_task_qry)) {
		echo "success";
	}
}

if ($_POST['action_type'] == "update_task") {

	$task_id = $_POST['task_id'];
	$u_id = $_POST['u_id'];
	$task_assign_to = $_POST['task_assign_to'];
	$staff = $_POST['staff_edit'];
	$task_name = $_POST['task_name'];
	$task_narr = $_POST['task_narr'];
	$task_end_date = date('Y-m-d', strtotime($_POST['task_end_date']));
	$task_view_date = date('Y-m-d', strtotime($_POST['task_view_date']));

	$upload1 = $_FILES['upload1']['name'];
	$upload2 = $_FILES['upload2']['name'];
	$upload3 = $_FILES['upload3']['name'];
	$upload4 = $_FILES['upload4']['name'];
	$upload5 = $_FILES['upload5']['name'];
	mkdir("task_upload/" . $task_name);
	if ($upload1 != "") {
		move_uploaded_file($_FILES['upload1']['tmp_name'], 'task_upload/' . $task_name . '/' . $_FILES["upload1"]['name']);
	}
	if ($upload2 != "") {
		move_uploaded_file($_FILES['upload2']['tmp_name'], 'task_upload/' . $task_name . '/' . $_FILES["upload2"]['name']);
	}
	if ($upload3 != "") {
		move_uploaded_file($_FILES['upload3']['tmp_name'], 'task_upload/' . $task_name . '/' . $_FILES["upload3"]['name']);
	}
	if ($upload4 != "") {
		move_uploaded_file($_FILES['upload4']['tmp_name'], 'task_upload/' . $task_name . '/' . $_FILES["upload4"]['name']);
	}
	if ($upload5 != "") {
		move_uploaded_file($_FILES['upload5']['tmp_name'], 'task_upload/' . $task_name . '/' . $_FILES["upload5"]['name']);
	}


	$update_task = "UPDATE `tasks` SET `task_asign_to`='$task_assign_to', `task_name`='$task_name', `task_narr`='$task_narr', `staff`='$staff', `task_end_date`='$task_end_date',`task_view_date`='$task_view_date', `upload1`='$upload1', `upload2`='$upload2', `upload3`='$upload3', `upload4`='$upload4', `upload5`='$upload5' WHERE `task_id`='$task_id'";

	if (mysqli_query($conn, $update_task)) {

		echo 'success';
	}
}

if ($_POST['action_type'] == "accept_task_by_admin") {

	$task_id = $_POST['task_id'];

	$update_task = "UPDATE `tasks` SET `accept_by_admin`='1' WHERE `task_id`='$task_id'";

	if (mysqli_query($conn, $update_task)) {

		echo 'success';
	}
}

if ($_POST['action_type'] == "rework_task_by_admin") {

	$task_id = $_POST['task_id'];

	$update_task = "UPDATE `tasks` SET `task_completed`='0', `accept_by_assiner`='0', `accept_by_admin`='0' WHERE `task_id`='$task_id'";

	if (mysqli_query($conn, $update_task)) {

		echo 'success';
	}
}



//Tasks Viewer
if ($_POST['action_type'] == "task_viewer") {
	$assign_to = $_POST['assign_to'];

	$sel_task = "SELECT * FROM `tasks` WHERE `task_completed`='0' AND `task_deleted`='0' AND `accept_by_assiner`='0' AND `task_asign_to`='$assign_to' ORDER BY `task_priority` ASC";
	$res_task = mysqli_query($conn, $sel_task);
	if (mysqli_num_rows($res_task) > 0) {
		$count = 1;
		while ($row_task = mysqli_fetch_array($res_task)) {
		?>
			<tr style="height:60px;">
				<td style="text-align:center;"><?php echo $count; ?></td>
				<td style="text-align:center;"><?php echo $row_task['task_u_id']; ?></td>
				<td style="text-align:center;"><?php echo $row_task['task_name']; ?></td>
				<td style="text-align:center;"><?php echo $row_task['task_narr']; ?></td>
				<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($row_task['task_end_date'])); ?></td>
				<td style="text-align:center;">
					<?php
					$staff = explode(',', $row_task['staff']);
					for ($i = 0; $i < count($staff); $i++) {
						$get_assign = "SELECT * FROM `multi_login` WHERE `id`=" . $staff[$i];
						$res_assign = mysqli_query($conn, $get_assign);
						$row_assign = mysqli_fetch_array($res_assign);
						echo $row_assign['staff_fullname'] . "<br>";
					}
					?>
				</td>
				<td style="text-align:center;">
					<a href="#" class="btn btn-primary set_priority_up" onclick="set_priority_up(<?php echo $row_task['task_id']; ?>,<?php echo $row_task['task_priority']; ?>,<?php echo $row_task['task_asign_to']; ?>)"><i class="fa fa-angle-up"></i></a>
					<a href="#" class="btn btn-success set_priority_down" onclick="set_priority_down(<?php echo $row_task['task_id']; ?>,<?php echo $row_task['task_priority']; ?>,<?php echo $row_task['task_asign_to']; ?>)"><i class="fa fa-angle-down"></i></a>


					<?php //echo $row_task['task_priority'];
					?>
				</td>
			</tr>
	<?php
			$count++;
		}
	} else {
		echo 'failed';
	}
}




if ($_POST['action_type'] == "set_priority_up") {

	$task_id = $_POST['task_id'];
	$task_asign_to = $_POST['task_asign_to'];
	$task_priority = $_POST['task_priority'];
	$upd_task_priority = "";
	$set_priority = 0;
	if ($task_priority != 1 && $task_priority > 1) {
		$set_priority = $task_priority - 1;
	} else {
		echo "failed";
		exit;
	}

	$sel_task = "SELECT * FROM `tasks` WHERE `task_asign_to`='$task_asign_to' AND `task_priority`='$set_priority' AND `task_completed`='0' AND `task_deleted`='0'";
	$res_task = mysqli_query($conn, $sel_task);
	if (mysqli_num_rows($res_task) > 0) {
		$row_task = mysqli_fetch_array($res_task);
		$upd_task = "UPDATE `tasks` SET `task_priority`='$task_priority' WHERE `task_id`=" . $row_task['task_id'];
		if (mysqli_query($conn, $upd_task)) {
			$upd_priority = "UPDATE `tasks` SET `task_priority`='$set_priority' WHERE `task_id`=" . $task_id;
			mysqli_query($conn, $upd_priority);
			echo 'success';
		} else {
			echo "failed";
		}
	}
}


if ($_POST['action_type'] == "set_priority_down") {

	$task_id = $_POST['task_id'];
	$task_asign_to = $_POST['task_asign_to'];
	$task_priority = $_POST['task_priority'];
	$upd_task_priority = "";
	$set_priority = 0;
	if ($task_priority != 0 && $task_priority >= 1) {
		$set_priority = $task_priority + 1;
	} else {
		echo "failed";
		exit;
	}

	$sel_task = "SELECT * FROM `tasks` WHERE `task_asign_to`='$task_asign_to' AND `task_priority`='$set_priority' AND `task_completed`='0' AND `task_deleted`='0'";
	$res_task = mysqli_query($conn, $sel_task);
	if (mysqli_num_rows($res_task) > 0) {
		$row_task = mysqli_fetch_array($res_task);
		$upd_task = "UPDATE `tasks` SET `task_priority`='$task_priority' WHERE `task_id`=" . $row_task['task_id'];
		if (mysqli_query($conn, $upd_task)) {
			$upd_priority = "UPDATE `tasks` SET `task_priority`='$set_priority' WHERE `task_id`=" . $task_id;
			mysqli_query($conn, $upd_priority);
			echo 'success';
		} else {
			echo "failed";
		}
	}
}


if ($_POST['action_type'] == "view_task") {

	$task_id = $_POST['task_id'];


	$sel_task = "SELECT * FROM `tasks` WHERE `task_id`='$task_id'";
	$res_task = mysqli_query($conn, $sel_task);
	$task_row = mysqli_fetch_array($res_task);

	$return_json = array(
		'status' => 'success',
		'task_u_id' => $task_row['task_u_id'],
		'task_asign_to' => $task_row['task_asign_to'],
		'task_name' => $task_row['task_name'],
		'task_narr' => $task_row['task_narr'],
		'task_end_date' => $task_row['task_end_date'],
		'upload1' => $task_row['upload1'],
		'upload2' => $task_row['upload2'],
		'upload3' => $task_row['upload3'],
		'upload4' => $task_row['upload4'],
		'upload5' => $task_row['upload5']
	);
	echo json_encode($return_json);
}


if ($_POST['action_type'] == "add_new_user") {

	$user_name = $_POST['user_name'];

	$ins_new_user = "INSERT INTO `task_user`(`user_name`,`user_status`) VALUES ('$user_name','0')";

	if (mysqli_query($conn, $ins_new_user)) {
		$return = array(
			'status' => 'success',
			'id' => mysqli_insert_id($conn)
		);
		echo json_encode($return);
	} else {
		echo 'failed';
	}
}

if ($_POST['action_type'] == "task_accept_by_assiner") {

	$task_id = $_POST['task_id'];

	$update_task = "UPDATE `tasks` SET `accept_by_assiner`='1' WHERE `task_id`='$task_id'";

	if (mysqli_query($conn, $update_task)) {

		echo 'success';
	}
}

if ($_POST['action_type'] == "submit_by_viewer") {

	$task_submit_id = $_POST['task_submit_id'];
	$task_remarks = $_POST['task_remarks'];

	$task_file_1 = "";
	$task_file_2 = "";
	$task_file_3 = "";
	$task_file_4 = "";
	$task_file_5 = "";


	if ($_FILES['task_file_1']['name'] != "") {
		$task_file_1 = rand(00001, 99999) . $_FILES['task_file_1']['name'];
		move_uploaded_file($_FILES['task_file_1']['tmp_name'], 'task_upload/uploded_by_viewer/' . $task_file_1);
	}
	if ($_FILES['task_file_2']['name'] != "") {
		$task_file_2 = rand(00001, 99999) . $_FILES['task_file_2']['name'];
		move_uploaded_file($_FILES['task_file_2']['tmp_name'], 'task_upload/uploded_by_viewer/' . $task_file_2);
	}
	if ($_FILES['task_file_3']['name'] != "") {
		$task_file_3 = rand(00001, 99999) . $_FILES['task_file_3']['name'];
		move_uploaded_file($_FILES['task_file_3']['tmp_name'], 'task_upload/uploded_by_viewer/' . $task_file_3);
	}
	if ($_FILES['task_file_4']['name'] != "") {
		$task_file_4 = rand(00001, 99999) . $_FILES['task_file_4']['name'];
		move_uploaded_file($_FILES['task_file_4']['tmp_name'], 'task_upload/uploded_by_viewer/' . $task_file_4);
	}
	if ($_FILES['task_file_5']['name'] != "") {
		$task_file_5 = rand(00001, 99999) . $_FILES['task_file_5']['name'];
		move_uploaded_file($_FILES['task_file_5']['tmp_name'], 'task_upload/uploded_by_viewer/' . $task_file_5);
	}


	$update_task = "UPDATE `tasks` SET `submit_by_viewer`='1', `viewer_remarks`='$task_remarks', `uploded_by_viewer1`='$task_file_1', `uploded_by_viewer2`='$task_file_2', `uploded_by_viewer3`='$task_file_3', `uploded_by_viewer4`='$task_file_4', `uploded_by_viewer5`='$task_file_5' WHERE `task_id`='$task_submit_id' ";

	if (mysqli_query($conn, $update_task)) {

		echo 'success';
	}
}

if ($_POST['action_type'] == "task_info") {

	$task_info_id = $_POST['task_info_id'];
	$task_info = "SELECT * FROM `tasks` WHERE `task_id`='$task_info_id'";
	$res_task_info = mysqli_query($conn, $task_info);
	$row_task_info = mysqli_fetch_array($res_task_info);
	$return_html = "<div class='row'><div class='col-md-12'><div class='form-group'><label class='col-sm-12 control-labe'>Remarks By Viewer</label></div><div class='col-md-12'>" . $row_task_info['viewer_remarks'] . "</div><br><br><br>";




	if ($row_task_info['uploded_by_viewer1'] != '') {
		$return_html .= '<a class="btn btn-primary" style="margin:5px;" href="task_upload/uploded_by_viewer/' . $row_task_info['uploded_by_viewer1'] . '" target="_blank">View File 1</a>';
	}
	if ($row_task_info['uploded_by_viewer2'] != '') {
		$return_html .= '<a class="btn btn-primary" style="margin:5px;" href="task_upload/uploded_by_viewer/' . $row_task_info['uploded_by_viewer2'] . '" target="_blank">View File 2</a>';
	}
	if ($row_task_info['uploded_by_viewer3'] != '') {
		$return_html .= '<a class="btn btn-primary" style="margin:5px;" href="task_upload/uploded_by_viewer/' . $row_task_info['uploded_by_viewer3'] . '" target="_blank">View File 3</a>';
	}
	if ($row_task_info['uploded_by_viewer4'] != '') {
		$return_html .= '<a class="btn btn-primary" style="margin:5px;" href="task_upload/uploded_by_viewer/' . $row_task_info['uploded_by_viewer4'] . '" target="_blank">View File 4</a>';
	}
	if ($row_task_info['uploded_by_viewer5'] != '') {
		$return_html .= '<a class="btn btn-primary" style="margin:5px;" href="task_upload/uploded_by_viewer/' . $row_task_info['uploded_by_viewer5'] . '" target="_blank">View File 5</a>';
	}
	$return_html .= "</div></div>";
	?>
	<div>
		<?php echo $return_html; ?>
	</div>
<?php
}



?>