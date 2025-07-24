<?php include("header.php"); ?>
<?php
error_reporting(1);
if ($_SESSION['name'] == "") {
?>
	<script>
		window.location.href = "<?php echo $base_url; ?>index.php";
	</script>
<?php
}
?>



<style>
	/* required style*/
	.none {
		display: none;
	}

	/* optional styles */
	table tr th,
	table tr td {
		font-size: 1.2rem;
	}

	.glyphicon {
		font-size: 20px;
	}

	.glyphicon-plus {
		float: right;
	}

	a.glyphicon {
		text-decoration: none;
	}

	
</style>


<div class="content-wrapper" style="margin-left: 0px !important;">

	<!-- Main content -->
	<section class="content" style="padding: 0px;margin-right: auto;margin-left: auto; padding-left: 0px; padding-right: 0px; ">
		<?php include("menu.php") ?>
		<div class="row" style="margin: 0px 0px 0px 0px;">
			<h1 style="text-align:center;">TASK MASTER </h1>
		</div>
		<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
			<div class="col-md-12">

				<!-- general form elements -->
				<div class="box box-primary">
					<div class="panel panel-default mts-content">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">All Tasks</h3>
								<button type="button" style="float:right;" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Tasks</button>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="col-md-12">
									<!-- Custom Tabs -->
									<div class="nav-tabs-custom">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#pending_task" data-toggle="tab">Pending Task</a></li>
											<li><a href="#comp_task" data-toggle="tab">Completed Task</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="pending_task">
												<table id="example1" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th width="3%">Sr no.</th>
															<th width="10%">Asign To</th>
															<th width="4%">View To</th>
															<th width="10%">Task Name</th>
															<th width="10%">End Date</th>
															<th width="10%">Start View Date</th>
															<th width="15%">Narration</th>
															<th width="10%">Status</th>
															<th width="3%">Files</th>
															<th width="20%">Admin Comment</th>
															<th width="5%">Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$select_data = "SELECT * FROM `tasks` WHERE `task_deleted`='0' AND `accept_by_admin`='0'";
														$result_data = mysqli_query($conn, $select_data);
														if (mysqli_num_rows($result_data) > 0) {
															$count = 1;
															while ($row_data = mysqli_fetch_array($result_data)) {

														?>
																<tr>
																	<td><?php echo $count; ?></td>
																	<td>
																		<?php
																		$get_assign_to = "SELECT * FROM `task_user` WHERE `id`=" . $row_data['task_asign_to'];
																		$res_assign_to = mysqli_query($conn, $get_assign_to);
																		$row_assign_to = mysqli_fetch_array($res_assign_to);
																		echo $row_assign_to['user_name'];
																		?>
																	</td>
																	<td>
																		<?php
																		$staff = explode(',', $row_data['staff']);
																		for ($i = 0; $i < count($staff); $i++) {
																			$get_assign = "SELECT * FROM `multi_login` WHERE `id`=" . $staff[$i];
																			$res_assign = mysqli_query($conn, $get_assign);
																			$row_assign = mysqli_fetch_array($res_assign);
																			echo $row_assign['staff_fullname'] . "<br>";
																		}
																		?>
																	</td>
																	<td><?php echo $row_data['task_name']; ?></td>
																	<td><?php echo date('d/m/Y', strtotime($row_data['task_end_date'])); ?></td>
																	<td><?php echo date('d/m/Y', strtotime($row_data['task_view_date'])); ?></td>
																	<td><?php echo $row_data['task_narr']; ?></td>
																	<td>
																		<?php
																		if ($row_data['accept_by_assiner'] == "0") {
																			echo "<span class='badge bg-red'>Pending</span>";
																		} else {
																			echo "<span class='badge bg-green'>Completed</span>";
																		}
																		?>

																	</td>
																	<td>
																		<?php
																		$url = explode('/', $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
																		//$base_url = $url[0]."/".$url[1]."/".$url[2]."/";

																		if ($row_data['upload1'] != "") {
																			$full_ulr = $base_url . "task_upload/" . $row_data['task_u_id'] . "/" . $row_data['upload1'];
																			echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 1' target='_blank'><i class='fa fa-eye'></i></a>";
																		}
																		if ($row_data['upload2'] != "") {
																			$full_ulr = $base_url . "task_upload/" . $row_data['task_u_id'] . "/" . $row_data['upload2'];
																			echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 2' target='_blank'><i class='fa fa-eye'></i></a>";
																		}
																		if ($row_data['upload3'] != "") {
																			$full_ulr = $base_url . "task_upload/" . $row_data['task_u_id'] . "/" . $row_data['upload3'];
																			echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 3' target='_blank'><i class='fa fa-eye'></i></a>";
																		}
																		if ($row_data['upload4'] != "") {
																			$full_ulr = $base_url . "task_upload/" . $row_data['task_u_id'] . "/" . $row_data['upload4'];
																			echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 4' target='_blank'><i class='fa fa-eye'></i></a>";
																		}
																		if ($row_data['upload5'] != "") {
																			$full_ulr = $base_url . "task_upload/" . $row_data['task_u_id'] . "/" . $row_data['upload5'];
																			echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 5' target='_blank'><i class='fa fa-eye'></i></a>";
																		}
																		?>
																	</td>
																	<td>
																		<a href="#" class="btn btn-primary accept <?php if ($row_data['accept_by_assiner'] == "0") {
																														echo "disabled";
																													} ?>" id="<?php echo $row_data['task_id']; ?>">Accept</a>
																		<a href="#" class="btn btn-success rework <?php if ($row_data['accept_by_assiner'] == "0") {
																														echo "disabled";
																													} ?>" id="<?php echo $row_data['task_id']; ?>">Rework</a>
																		<a href="#" class="btn btn-warning task_info <?php if ($row_data['accept_by_assiner'] == "0") {
																														echo "disabled";
																													} ?>" id="<?php echo $row_data['task_id']; ?>"><i class="fa fa-info"></i></a>


																	</td>
																	<td>
																		<a href="#" data-id="<?php echo $row_data['task_id']; ?>" data-task_asign_to="<?php echo $row_data['task_asign_to']; ?>" data-task_name="<?php echo $row_data['task_name']; ?>" data-task_narr="<?php echo $row_data['task_narr']; ?>" data-task_end_date="<?php echo $row_data['task_end_date']; ?>" data-staff="<?php echo $row_data['staff']; ?>" data-task_view_date="<?php echo $row_data['task_view_date']; ?>" style="font-size:16px; margin:2px;" class="edit_task"><i class="fa fa-edit"></i></a>


																		<a href="#" data-id="<?php echo $row_data['task_id']; ?>" style="font-size:16px; margin:2px;" class="dlt_task"><i class="fa fa-trash"></i></a>
																	</td>
																</tr>
														<?php
																$count++;
															}
														}
														?>
													</tbody>
												</table>
											</div>
											<!-- /.tab-pane -->
											<div class="tab-pane" id="comp_task">
												<table id="example1" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th>Sr no.</th>
															<th>Asign To</th>
															<th>Task Name</th>
															<th>End Date</th>
															<th>Due Date</th>
															<th>Narration</th>
															<th>Status</th>
															<th>Files</th>
															<th>Admin Comment</th>
															<!--<th>Action</th>-->
														</tr>
													</thead>
													<tbody>
														<?php
														$select_data = "SELECT * FROM `tasks` WHERE `task_deleted`='0' AND `accept_by_admin`='1'";
														$result_data = mysqli_query($conn, $select_data);
														if (mysqli_num_rows($result_data) > 0) {
															$count = 1;
															while ($row_data = mysqli_fetch_array($result_data)) {

														?>
																<tr>
																	<td><?php echo $count; ?></td>
																	<td>
																		<?php
																		$get_assign_to = "SELECT * FROM `task_user` WHERE `id`=" . $row_data['task_asign_to'];
																		$res_assign_to = mysqli_query($conn, $get_assign_to);
																		$row_assign_to = mysqli_fetch_array($res_assign_to);
																		echo $row_assign_to['user_name'];
																		?>
																	</td>
																	<td>
																		<?php
																		$staff = explode(',', $row_data['staff']);
																		for ($i = 0; $i < count($staff); $i++) {
																			$get_assign = "SELECT * FROM `multi_login` WHERE `id`=" . $staff[$i];
																			$res_assign = mysqli_query($conn, $get_assign);
																			$row_assign = mysqli_fetch_array($res_assign);
																			echo $row_assign['staff_fullname'] . "<br>";
																		}
																		?>
																	</td>
																	<td><?php echo $row_data['task_name']; ?></td>
																	<td><?php echo date('d/m/Y', strtotime($row_data['task_end_date'])); ?></td>
																	<td><?php echo date('d/m/Y', strtotime($row_data['task_end_date'])); ?></td>
																	<td><?php echo $row_data['task_narr']; ?></td>
																	<td><span class="badge bg-green">Completed</span> <?php //echo $row_data['task_completed'];
																														?></td>
																	<td>
																		<?php
																		$url = explode('/', $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
																		//$base_url = $url[0]."/".$url[1]."/".$url[2]."/";

																		if ($row_data['upload1'] != "") {
																			$full_ulr = $base_url . "task_upload/" . $row_data['task_u_id'] . "/" . $row_data['upload1'];
																			echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 1' target='_blank'><i class='fa fa-eye'></i></a>";
																		}
																		if ($row_data['upload2'] != "") {
																			$full_ulr = $base_url . "task_upload/" . $row_data['task_u_id'] . "/" . $row_data['upload2'];
																			echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 2' target='_blank'><i class='fa fa-eye'></i></a>";
																		}
																		if ($row_data['upload3'] != "") {
																			$full_ulr = $base_url . "task_upload/" . $row_data['task_u_id'] . "/" . $row_data['upload3'];
																			echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 3' target='_blank'><i class='fa fa-eye'></i></a>";
																		}
																		if ($row_data['upload4'] != "") {
																			$full_ulr = $base_url . "task_upload/" . $row_data['task_u_id'] . "/" . $row_data['upload4'];
																			echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 4' target='_blank'><i class='fa fa-eye'></i></a>";
																		}
																		if ($row_data['upload5'] != "") {
																			$full_ulr = $base_url . "task_upload/" . $row_data['task_u_id'] . "/" . $row_data['upload5'];
																			echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 5' target='_blank'><i class='fa fa-eye'></i></a>";
																		}
																		?>
																	</td>
																	<td>
																		<a href="#" class="btn btn-success rework" id="<?php echo $row_data['task_id']; ?>">Rework</a>
																	</td>
																	<!--<td>
							<a href="#" data-id="<?php echo $row_data['task_id']; ?>" 
										data-task_asign_to="<?php echo $row_data['task_asign_to']; ?>"
										data-task_name="<?php echo $row_data['task_name']; ?>"
										data-task_narr="<?php echo $row_data['task_narr']; ?>"
										data-task_end_date="<?php echo $row_data['task_end_date']; ?>"
							style="font-size:16px; margin:2px;" class="edit_task"><i class="fa fa-edit"></i></a>
							
							
							<a href="#" data-id="<?php echo $row_data['task_id']; ?>" style="font-size:16px; margin:2px;" class="dlt_task"><i class="fa fa-trash"></i></a>
						</td>-->
																</tr>
														<?php
																$count++;
															}
														}
														?>
													</tbody>
												</table>
											</div>
											<!-- /.tab-pane -->
										</div>
										<!-- /.tab-content -->
									</div>
									<!-- nav-tabs-custom -->
								</div>

							</div>
							<!-- /.box-body -->
						</div>







					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label>Add New Task</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Unique ID</label>
							<?php
							$get_task = "SELECT * FROM `tasks` ORDER BY `task_id` DESC";
							$res_task = mysqli_query($conn, $get_task);
							if (mysqli_num_rows($res_task) > 0) {
								$task_row = mysqli_fetch_array($res_task);
								$last_row_no = $task_row['task_u_id'] + 1;


								$uniq_no = sprintf("%04d", $last_row_no);
							} else {
								$uniq_no = '0001';
							}
							?>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="task_u_id" id="task_u_id" value="<?php echo $uniq_no; ?>" disabled>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">UPLOAD-1</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="upload1" id="upload1">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Assign to *</label>
							<div class="col-sm-6">
								<select class="form-control select2" name="task_assign_to" id="task_assign_to" style="width: 100%;">
									<option value="" selected>Select Align To Name</option>
									<?php
									$select_user = "SELECT * FROM `task_user` WHERE `is_deleted`=0";
									$res_user = mysqli_query($conn, $select_user);
									if (mysqli_num_rows($res_user) > 0) {
										while ($row_users = mysqli_fetch_array($res_user)) {
											echo "<option value=" . $row_users['id'] . ">" . $row_users['user_name'] . "</option>";
										}
									}
									?>
								</select>
							</div>
							<div class="col-sm-2">
								<button class="btn btn-primary" id="add_user"><i class="fa fa-plus"></i></button>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">UPLOAD-2</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="upload2" id="upload2">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Task Name*</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="task_name" id="task_name" placeholder="Enter Task Name">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">UPLOAD-3</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="upload3" id="upload3">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Narration *</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="task_narr" id="task_narr" placeholder="Enter Task Narration">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">UPLOAD-4</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="upload4" id="upload4">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Task End Date</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="task_end_date" id="task_end_date">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">UPLOAD-5</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="upload5" id="upload5">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">View to *</label>
							<div class="col-sm-8">
								<select class="form-control" name="staff" id="staff" multiple="multiple">
									<?php
									$get_staff = "SELECT * FROM `multi_login` WHERE `staff_isdeleted`='0'";
									$res_staff = mysqli_query($conn, $get_staff);
									while ($row_staff = mysqli_fetch_array($res_staff)) {
										echo "<option value='" . $row_staff['id'] . "' width='100%'>" . $row_staff['staff_fullname'] . "</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6">

					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Start Viewing Date</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="task_view_date" id="task_view_date">
							</div>
						</div>
					</div>
					<div class="col-md-6">

					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-primary form-control" id="tast_submit">Submit</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table width="100%" border="1px">
							<thead>
								<tr>
									<th style="text-align:center;">Sr No.</td>
									<th style="text-align:center;">Unique ID</td>
									<th style="text-align:center;">Task Name</td>
									<th style="text-align:center;">Task Narration</td>
									<th style="text-align:center;">Task End-Date</td>
									<th style="text-align:center;">View To Name</td>
									<th style="text-align:center;">Task Priority</td>
								</tr>
							</thead>
							<tbody id="task_viewer">

							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label>Update Task</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Unique ID</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="task_u_id_edit" id="task_u_id_edit" disabled>
								<input type="hidden" class="form-control" name="task_id" id="task_id">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">UPLOAD-1</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="upload1_edit" id="upload1_edit">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Assign to *</label>
							<div class="col-sm-8">
								<select class="form-control select2" name="task_assign_to_edit" id="task_assign_to_edit" style="width: 100%;">
									<option selected>Select Align To Name</option>
									<?php
									$select_user = "SELECT * FROM `task_user` WHERE `is_deleted`=0";
									$res_user = mysqli_query($conn, $select_user);
									if (mysqli_num_rows($res_user) > 0) {
										while ($row_users = mysqli_fetch_array($res_user)) {
											echo "<option value=" . $row_users['id'] . ">" . $row_users['user_name'] . "</option>";
										}
									}
									?>
								</select>

							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">UPLOAD-2</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="upload2_edit" id="upload2_edit">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Task Name*</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="task_name_edit" id="task_name_edit">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">UPLOAD-3</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="upload3_edit" id="upload3_edit">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Narration *</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="task_narr_edit" id="task_narr_edit">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">UPLOAD-4</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="upload4_edit" id="upload4_edit">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Task End Date</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="task_end_date_edit" id="task_end_date_edit">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">UPLOAD-5</label>
							<div class="col-sm-8">
								<input type="file" class="form-control" name="upload5_edit" id="upload5_edit">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">View to *</label>
							<div class="col-sm-8">
								<select class="form-control" name="staff_edit" id="staff_edit" multiple="multiple">
									<option>Select Staff</option>
									<?php
									$get_staff = "SELECT * FROM `multi_login` WHERE `staff_isdeleted`='0'";
									$res_staff = mysqli_query($conn, $get_staff);
									while ($row_staff = mysqli_fetch_array($res_staff)) {
										echo "<option value='" . $row_staff['id'] . "'>" . $row_staff['staff_fullname'] . "</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6">

					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Start Viewing Date</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="edit_task_view_date" id="edit_task_view_date">
							</div>
						</div>
					</div>
					<div class="col-md-6">

					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-primary form-control" id="tast_submit_edit">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade bd-example-modal-lg-info" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<h2 align="center">Task Information</h2>
							<input type="hidden" id="task_info_id">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" id="show_task_information">

					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-primary form-control" id="tast_accept">Task Accept</button>
							</div>
						</div>
						<br>
						<br>
						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-success form-control" id="tast_rework">Task Rework</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include("footer.php");
//include("connection.php");
?>
<link rel="stylesheet" href="plugins/css/bootstrap-multiselect.css" type="text/css" />
<script type="text/javascript" src="plugins/js/bootstrap-multiselect.js"></script>
<script>
	$(document).ready(function() {
		$('#staff').multiselect('rebuild');
	});

	// Tommorow Date
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var tommorow = now.getFullYear() + "-" + (month) + "-" + ((+day) + 1);
	var today_date = now.getFullYear() + "-" + (month) + "-" + ((+day));
	$('#task_end_date').val(tommorow);

	$('#task_view_date').val(today_date);

	//Display Data Function
	/*function display_data(){
		var ajaxParameter = "action_type=display_data";
		$.ajax({
			type: 'POST',
			url: 'task_save.php',
			data: ajaxParameter,
			success:function(data){
				$('tbody').append(data);
			}
		});
	}

	$(document).ready(function(){
		display_data();
	})*/


	$('#tast_submit').click(function() {
		var u_id = $('#task_u_id').val();
		var task_assign_to = $('#task_assign_to').val();
		var task_name = $('#task_name').val();
		var task_narr = $('#task_narr').val();
		var task_end_date = $('#task_end_date').val();
		var staff = $('#staff').val();
		var task_view_date = $('#task_view_date').val();
		var form_data = new FormData();
		var upload1 = $("#upload1").prop("files")[0];
		var upload2 = $("#upload2").prop("files")[0];
		var upload3 = $("#upload3").prop("files")[0];
		var upload4 = $("#upload4").prop("files")[0];
		var upload5 = $("#upload5").prop("files")[0];

		form_data.append("action_type", 'insert_task');
		form_data.append("u_id", u_id);
		form_data.append("task_assign_to", task_assign_to);
		form_data.append("task_name", task_name);
		form_data.append("task_narr", task_narr);
		form_data.append("task_end_date", task_end_date);
		form_data.append("staff", staff);
		form_data.append("task_view_date", task_view_date);
		form_data.append("upload1", upload1);
		form_data.append("upload2", upload2);
		form_data.append("upload3", upload3);
		form_data.append("upload4", upload4);
		form_data.append("upload5", upload5);

		var validation = "";

		if (task_assign_to == "") {
			validation += "Please Enter Task Assign To Name \n";
		}
		if (task_name == "") {
			validation += "Please Enter Task Name \n";
		}
		if (task_narr == "") {
			validation += "Please Enter Narration \n";
		}
		if (staff == "") {
			validation += "Please Select Staff \n";
		}


		if (validation == "") {
			$.ajax({
				type: 'POST',
				url: 'task_save.php',
				processData: false, // important
				contentType: false, // important
				data: form_data,
				success: function(data) {
					if (data == "success") {
						$('#task_assign_to').val('');
						$('#task_name').val('');
						$('#task_narr').val('');
						$('#task_end_date').val(tommorow);
						$('.bd-example-modal-lg').modal('hide');
						swal('Congratulations!', 'New Task Added', 'success');
						window.location.href = 'tasks.php';
					}
				}
			});
		} else {
			swal('Error!', validation, 'error');
		}

	})

	$('.task_info').click(function() {
		var task_info_id = $(this).attr('id');
		$('#task_info_id').val(task_info_id);
		$.ajax({
			type: 'POST',
			url: 'task_save.php',
			data: "action_type=task_info&task_info_id=" + task_info_id,
			success: function(data) {
				$('#show_task_information').html('');
				$('#show_task_information').append(data);
				$('.bd-example-modal-lg-info').modal('show');
			}
		});
	})

	$('.edit_task').click(function() {
		$('#task_id').val($(this).attr('data-id'));
		//$('#task_u_id_edit').val($(this).attr('data-id'));
		$('#task_assign_to_edit').val($(this).attr('data-task_asign_to'));
		$('#task_name_edit').val($(this).attr('data-task_name'));
		$('#task_narr_edit').val($(this).attr('data-task_narr'));
		$('#task_end_date_edit').val($(this).attr('data-task_end_date'));
		$('#staff_edit').val($(this).attr('data-staff'));
		$('#edit_task_view_date').val($(this).attr('data-task_view_date'));
		$('.bd-example-modal-lg-edit').modal('show');
	})

	$('#add_user').click(function() {
		var user_name = prompt('Enter Username');

		if (user_name != "" && user_name != null) {
			$.ajax({
				type: 'POST',
				url: 'task_save.php',
				dataType: 'JSON',
				data: "action_type=add_new_user&user_name=" + user_name,
				success: function(data) {
					if (data.status == "success") {
						swal('Congratulations!', 'New User Added', 'success');
						$('#task_assign_to').append('<option value=' + data.id + '>' + user_name + '</option>');
						//window.location.href='tasks.php';
					} else {
						swal('Opps!', 'New User Not Added', 'error');
					}
				}
			});
		} else {
			alert('Please Enter Name Properly');
		}

	})

	$('#tast_submit_edit').click(function() {
		var u_id = $('#task_u_id_edit').val();
		var task_id = $('#task_id').val();
		var task_assign_to = $('#task_assign_to_edit').val();
		var task_name = $('#task_name_edit').val();
		var task_narr = $('#task_narr_edit').val();
		var task_end_date = $('#task_end_date_edit').val();
		var staff_edit = $('#staff_edit').val();
		var task_view_date = $('#edit_task_view_date').val();
		var form_data = new FormData();
		var upload1 = $("#upload1_edit").prop("files")[0];
		var upload2 = $("#upload2_edit").prop("files")[0];
		var upload3 = $("#upload3_edit").prop("files")[0];
		var upload4 = $("#upload4_edit").prop("files")[0];
		var upload5 = $("#upload5_edit").prop("files")[0];

		form_data.append("action_type", 'update_task');
		form_data.append("u_id", u_id);
		form_data.append("task_assign_to", task_assign_to);
		form_data.append("task_name", task_name);
		form_data.append("task_narr", task_narr);
		form_data.append("task_end_date", task_end_date);
		form_data.append("staff_edit", staff_edit);
		form_data.append("task_view_date", task_view_date);
		form_data.append("task_id", task_id);
		form_data.append("upload1", upload1);
		form_data.append("upload2", upload2);
		form_data.append("upload3", upload3);
		form_data.append("upload4", upload4);
		form_data.append("upload5", upload5);

		var validation = "";

		if (task_assign_to == "") {
			validation += "Please Enter Task asigning \n";
		}
		if (task_name == "") {
			validation += "Please Enter Task Name \n";
		}
		if (task_narr == "") {
			validation += "Please Enter Narration \n";
		}
		if (staff_edit == "") {
			validation += "Please Select Staff \n";
		}


		if (validation == "") {
			$.ajax({
				type: 'POST',
				url: 'task_save.php',
				processData: false, // important
				contentType: false, // important
				data: form_data,
				success: function(data) {
					if (data == "success") {
						$('#task_assign_to').val('');
						$('#task_name').val('');
						$('#task_narr').val('');
						$('#task_end_date').val(tommorow);
						$('.bd-example-modal-lg').modal('hide');
						swal('Congratulations!', 'Task Updated', 'success');
						window.location.href = 'tasks.php';
					}
				}
			});
		} else {
			swal('Error!', validation, 'error');
		}

	})









	$('.dlt_task').click(function() {
		var task_id = $(this).attr('data-id');
		var ajaxParameter = "action_type=dlt_task&task_id=" + task_id;
		//swal('Congratulations!', 'Task Deleted', 'success');
		swal({
				title: "Are you sure?",
				text: "Task it will  be deleted then not recover  back!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						type: 'POST',
						url: 'task_save.php',
						data: ajaxParameter,
						success: function(data) {
							if (data == "success") {
								swal("Poof! Your imaginary file has been deleted!", {
									icon: "success",
								});
							}
							location.reload();
						}
					});


				} else {
					swal("Task not Deleted.");
				}
			});
	})

	function accept_task(task_id) {
		var ajaxParameter = "action_type=accept_task_by_admin&task_id=" + task_id;
		//swal('Congratulations!', 'Task Deleted', 'success');
		swal({
				title: "Are you sure?",
				text: "Click Ok to Accept This Task.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						type: 'POST',
						url: 'task_save.php',
						data: ajaxParameter,
						success: function(data) {
							if (data == "success") {
								swal("Task Accepted", {
									icon: "success",
								});
							}
							location.reload();
						}
					});


				} else {
					swal("Task not Accept.");
				}
			});
	}

	function rework_task(task_id) {
		var ajaxParameter = "action_type=rework_task_by_admin&task_id=" + task_id;
		//swal('Congratulations!', 'Task Deleted', 'success');
		swal({
				title: "Are you sure?",
				text: "Click Ok To Send Back Rework This Task.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						type: 'POST',
						url: 'task_save.php',
						data: ajaxParameter,
						success: function(data) {
							if (data == "success") {
								swal("Task Send Successfully", {
									icon: "success",
								});
							}
							location.reload();
						}
					});


				} else {
					swal("Task not Accept.");
				}
			});
	}





	$('.accept').click(function() {
		var task_id = $(this).attr('id');
		accept_task(task_id);
	})

	$('.rework').click(function() {
		var task_id = $(this).attr('id');
		rework_task(task_id);
	})


	$('#tast_accept').click(function() {
		var task_id = $('#task_info_id').val();
		accept_task(task_id);
	})

	$('#tast_rework').click(function() {
		var task_id = $('#task_info_id').val();
		accept_task(task_id);
	})

	function task_viewer(get_assigner) {

		var ajaxParameter = "action_type=task_viewer&assign_to=" + get_assigner;
		$.ajax({
			type: 'POST',
			url: 'task_save.php',
			data: ajaxParameter,
			success: function(data) {
				if (data == "failed") {
					alert('No Task Available');
					$('#task_viewer').html('');
				} else {
					$('#task_viewer').html('');
					$('#task_viewer').append(data);
				}
			}
		});
	}





	$('#task_assign_to').change(function() {
		var task_assign_to = $(this).val();

		task_viewer(task_assign_to);
	})


	function set_priority_up(task_id, task_priority, task_asign_to) {

		var ajaxParameter = "action_type=set_priority_up&task_id=" + task_id + "&task_priority=" + task_priority + "&task_asign_to=" + task_asign_to;
		$.ajax({
			type: 'POST',
			url: 'task_save.php',
			data: ajaxParameter,
			success: function(data) {
				if (data == "success") {
					task_viewer(task_asign_to);
				} else {
					alert('Priority Not Set');
				}
			}
		});
	}

	function set_priority_down(task_id, task_priority, task_asign_to) {
		var ajaxParameter = "action_type=set_priority_down&task_id=" + task_id + "&task_priority=" + task_priority + "&task_asign_to=" + task_asign_to;
		$.ajax({
			type: 'POST',
			url: 'task_save.php',
			data: ajaxParameter,
			success: function(data) {
				if (data == "success") {
					task_viewer(task_asign_to);
				} else {
					alert('Priority Not Set');
				}
			}
		});
	}





	$(function() {
		$('#example1').DataTable({
			'paging': false,
			'lengthChange': false,
			'searching': true,
			'ordering': false,
			'info': true,
			'autoWidth': false
		})
		$('#example2').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': false,
			'ordering': true,
			'info': true,
			'autoWidth': false
		})
	})
</script>