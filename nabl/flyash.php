<?php
include("header.php");
//REMOVE SIDE BAR
/*include("sidebar.php");*/
include("connection.php");
error_reporting(0);
session_start();
if ($_SESSION['name'] == "") {
?>
	<script>
		window.location.href = "<?php echo $base_url; ?>index.php";
	</script>
<?php
}



?>

<style>
	#billing label {
		display: block;
		text-align: center;
		line-height: 150%;
		font-size: .85em;
	}

	.visually-hidden {
		position: absolute;
		left: -100vw;

		/* Note, you may want to position the checkbox over top the label and set the opacity to zero instead. It can be better for accessibilty on some touch devices for discoverability. */
	}
</style>
<?php
// GET DATA FROM URL VAIBHAV
if (isset($_GET['report_no'])) {
	$report_no = $_GET['report_no'];
}
if (isset($_GET['trf_no'])) {
	$trf_no = $_GET['trf_no'];
}
if (isset($_GET['job_no'])) {
	$job_no = $_GET['job_no'];
	$job_no_main = $_GET['job_no'];
}
if (isset($_GET['lab_no'])) {
	$lab_no = $_GET['lab_no'];
	$aa	= $_GET['lab_no'];
}
if (isset($_GET['ulr'])) {
	$ulr = $_GET['ulr'];
}

$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
$result_select4 = mysqli_query($conn, $select_query4);

if (mysqli_num_rows($result_select4) > 0) {
	$row_select4 = mysqli_fetch_assoc($result_select4);
	$type_of_cement = $row_select4['type_of_cement'];
	$cement_grade = $row_select4['cement_grade'];
	$cement_brand = $row_select4['cement_brand'];
	$week_number = $row_select4['week_number'];
}
$select_query3 = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0' ";
$result_select3 = mysqli_query($conn, $select_query3);

if (mysqli_num_rows($result_select3) > 0) {
	$row_select3 = mysqli_fetch_assoc($result_select3);
	$rec_sample_date = $row_select3['sample_rec_date'];
}

$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
$result_select2 = mysqli_query($conn, $select_query2);

if (mysqli_num_rows($result_select2) > 0) {
	$row_select2 = mysqli_fetch_assoc($result_select2);
	$start_date = $row_select2['start_date'];
	$end_date = $row_select2['end_date'];
}


?>
<div class="content-wrapper" style="margin-left:0px !important;">

	<section class="content">
		
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">FLYASH</h2>
					</div>
					<div class="box-default">
						<form class="form" id="Glazed" method="post">
							<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">
								<br>
								<div class="col-lg-6">
									<div class="form-group">

										<!-- <label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->

										<div class="col-sm-10">
											<input type="hidden" class="form-control" id="report_no" value="<?php echo $report_no; ?>" name="report_no" ReadOnly>
										</div>


									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Job No.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control" tabindex="1" value="<?php echo $job_no; ?>" id="job_no" name="job_no" ReadOnly>
										</div>
									</div>
								</div>
							</div>
							<!-- </div> -->
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-5">
									<div class="form-group">
										<div class="col-sm-2">
											<label for="chk_auto">Job No. :</label>
											<input type="checkbox" class="visually-hidden" name="chk_auto" id="chk_auto" value="chk_auto">
										</div>
										<div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" ReadOnly>
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<div class="col-sm-4">
											<label for="chk_auto">Make :</label>
											<input type="checkbox" class="visually-hidden" name="chk_auto" id="chk_auto" value="chk_auto">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control inputs" id="makes" name="makes">
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<div class="col-sm-2">
											<label for="chk_auto">Brand :</label>
											<input type="checkbox" class="visually-hidden" name="chk_auto" id="chk_auto" value="chk_auto">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control inputs" id="brand" name="brand">
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Type Of Cement :</label>								 -->




									</div>
								</div>

							</div>

							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">

									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Received Sample Date:</label>	-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="rec_sample_date" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>" name="rec_sample_date" ReadOnly>
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Brand :</label>	-->
									</div>
								</div>


							</div>
							<br>
							<div class="row">
								<div class="col-lg-6">

									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Report Date :</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="hidden" class="form-control" id="report_date" name="report_date" value="<?php echo date('d/m/Y', strtotime($end_date)); ?>">
												<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" ReadOnly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Type Of Cement :</label>
										<div class="col-sm-2">
											<select class="form-control type_of_cement" id="type_of_cement" name="type_of_cement">
												<option value="OPC">OPC</option>
												<option value="PPC">PPC</option>
												<option value="PSC">PSC</option>
											</select>
										</div>

										<label for="inputEmail3" class="col-sm-1 control-label">Grade:</label>
										<div class="col-sm-4">
											<select class="form-control cement_grade" id="cement_grade" name="cement_grade">
												<option value="53 OPC">53 OPC</option>
												<option value="43 OPC">43 OPC</option>
												<option value="33 OPC">33 OPC</option>
												<option value="33_grade">33 grade</option>
												<option value="flyash_type">flyash type</option>
												<option value="OPC - 53 S">OPC - 43 S</option>
												<option value="OPC - 53 S">OPC - 53 S</option>
												<option value="PORTLAND SLAG">PORTLAND SLAG</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">

										<div class="col-sm-2">
											<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)">Back</button>
											<input type="hidden" class="form-control" name="idEdit" id="idEdit" />

										</div>
										<div class="col-sm-2">
											<!-- SAVE BUTTON LOGIC VAIBHAV-->
											<?php
											$querys_job1 = "SELECT * FROM fly_ash WHERE `is_deleted`='0' and lab_no='$lab_no'";
											$qrys_jobno = mysqli_query($conn, $querys_job1);
											$rows = mysqli_num_rows($qrys_jobno);
											if ($rows < 1) { ?>
												<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14">Save</button>
											<?php }
											?>
										</div>
										<div class="col-sm-2">
											<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')" id="btn_edit_data" name="btn_edit_data">Update</button>
										</div>
										<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
										
										<div class="col-sm-3">
											<a target='_blank' href="<?php echo $base_url; ?>print_report/print_flyash.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info" id="btn_report" name="btn_report"><b>Report</b></a>


										</div>



										
										<div class="col-sm-3">
											<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_flyash.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

										</div>
									</div>
								</div>
							</div>

							<hr>
							<br>
							<hr style="border-top: 1px solid #ccc;">
										<!--Nikunj Code Start-->
							<?php
								$is_upload = "select * from span_material_assign WHERE `trf_no`='$trf_no' and `job_number`='$job_no'and isdeleted='0'";

								$result_upload = mysqli_query($conn, $is_upload);
								if (mysqli_num_rows($result_upload) > 0) { ?>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse_file">
													<h4 class="panel-title">
														<b>FILE UPLOAD</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse_file" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">

															<div class="col-md-3">
																<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>&&lab_no=<?php echo $lab_no; ?>">Row Data</a>
															</div>
															<div class="col-md-3">
																<label for="inputEmail3" class="col-md-12 control-label">Upload Excel :</label>
															</div>
															<div class="col-md-3">
																<input type="file" class="form-control" id="upload_excel" name="upload_excel">
															</div>
															<div class="col-md-3">
																<button type="button" class="btn btn-info pull-right" id="btn_upload_excel" name="btn_upload_excel" tabindex="14">Upload</button>
															</div>

														</div>
													</div>
													<div class="col-md-6">
														<div id="view_excel_from_table">
															<table border="1px solid black" align="center" width="100%">
																<tr>
																	<th>Download</th>
																	<th>Action</th>
																</tr>
																<?php
																$query_file = "select * from excel_upload_from_report WHERE lab_no='$lab_no' and job_no='$job_no_main' and report_no='$report_no'";
																$result_file = mysqli_query($conn, $query_file);
																if (mysqli_num_rows($result_file) > 0) {
																	while ($r_file = mysqli_fetch_array($result_file)) {
																?>
																		<tr>
																			<td><a href="<?php echo $base_url . $r_file['excel_sheet']; ?>" download><?php echo $r_file['excel_sheet']; ?></a></td>
																			<td><a href="javascript:void(0);" class="delete_excels" data-id="<?php echo $r_file['id']; ?>">Delete</a></td>
																		</tr>
																<?php
																	}
																}
																?>
															</table>
														</div>


													</div>
												</div>
											</div>
											<br>
										</div>
									<?php }	 ?>

			<div class="panel panel-default">


									<div class="panel-group" id="accordion">

										<?php
										$test_check;
										$select_query12 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
										$result_select12 = mysqli_query($conn, $select_query12);
										while ($r12 = mysqli_fetch_array($result_select12)) {
														//echo $r12['test_code'];				
											if ($r12['test_code'] == "con") {
												$test_check .= "con,";
										?>

												<div class="panel panel-default" id="con">
													<div class="panel-heading" id="consis">
														<h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
																<h4 class="panel-title">
																	<b>CONSISTENCY TEST</b>
																</h4>
															</a>
														</h4>
													</div>
													<div id="collapse2" class="panel-collapse collapse">
														<div class="panel-body">
															<div class="row">
																<div class="col-lg-8">
																	<div class="form-group">
																		<div class="col-sm-1">
																			<label for="chk_con">1.</label>
																			<input type="checkbox" class="visually-hidden" name="chk_con" id="chk_con" value="chk_con"><br>
																		</div>
																		<label for="inputEmail3" class="col-sm-4 control-label label-right">CONSISTENCY TEST</label>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="con_date_test" name="con_date_test">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-8">
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Temp.(&#8451;) :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="con_temp" name="con_temp">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-8">
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Humidity (%) :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="con_humidity" name="con_humidity">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement + FLYASH (50% CEMENT + 50% FLYASH)(gm) :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="con_weight" name="con_weight" value="400">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">


																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">Weight of water (ml)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">% Consistency</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">Penetration (mm)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<!--<label for="inputEmail3" class="col-sm-2 control-label">Remakes</label>-->
																		</div>
																	</div>
																</div>
															</div>
															</br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="vol_1" name="vol_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="wtr_1" name="wtr_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="reading_1" name="reading_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="remark_1" name="remark_1
													">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="vol_2" name="vol_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="wtr_2" name="wtr_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="reading_2" name="reading_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="remark_2" name="remark_2
													">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="vol_3" name="vol_3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="wtr_3" name="wtr_3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="reading_3" name="reading_3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="remark_3" name="remark_3
													">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="vol_4" name="vol_4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="wtr_4" name="wtr_4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="reading_4" name="reading_4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="remark_4" name="remark_4
													">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="vol_5" name="vol_5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="wtr_5" name="wtr_5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="reading_5" name="reading_5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="remark_5" name="remark_5
													">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="vol_6" name="vol_6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="wtr_6" name="wtr_6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="reading_6" name="reading_6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="remark_6" name="remark_6
													">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="vol_7" name="vol_7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="wtr_7" name="wtr_7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="reading_7" name="reading_7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="remark_7" name="remark_7
													">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-6">
																	<div class="col-lg-6">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<label for="inputEmail3" class="col-sm-12 control-label">Consistency of cement (As per IS 4031 Part IV) :</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-3">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<input type="text" class="form-control" id="consistency_of_cement" name="consistency_of_cement">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Final Consistency (%) :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="final_consistency" name="final_consistency">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">

																</div>
																<div class="col-lg-2">

																</div>
																<div class="col-lg-2">

																</div>
															</div>
															<br>
														</div>
													</div>
												</div>

											<?php
											}
										}




										$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
										$result_select1 = mysqli_query($conn, $select_query1);
										while ($r1 = mysqli_fetch_array($result_select1)) {

											if ($r1['test_code'] == "fin") {
												$test_check .= "fin,";
											?>


												<div class="panel panel-default" id="fin">
													<div class="panel-heading" id="fins">
														<h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
																<h4 class="panel-title">
																	<b>DENSITY OF FLYASH &amp; FINENESS BLAINE'S AIR PERMEABILITY</b>
																</h4>
															</a>
														</h4>
													</div>
													<div id="collapse5" class="panel-collapse collapse">
														<div class="panel-body">
															<div class="row">

																<div class="col-lg-8">
																	<div class="form-group">
																		<div class="col-sm-1">
																			<label for="chk_fines">6.</label>
																			<input type="checkbox" class="visually-hidden" name="chk_fines" id="chk_fines" value="chk_fines"><br>
																		</div>
																		<label for="inputEmail3" class="col-sm-4 control-label label-right">DENSITY OF FLYASH &amp; FINENESS BLAINE'S AIR PERMEABILITY</label>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Apparatus Constant (K)= </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="constant_k" name="constant_k">
																			<input type="hidden" class="form-control" id="den_date_test" name="den_date_test">
																		</div>
																	</div>
																</div>


															</div>
															<br>
															<div class="row">
																<div class="col-lg-8">
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Temp. (&#8451;):</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fine_temp" name="fine_temp">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement+ FLYASH (A), gm </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="den_cement" name="den_cement">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Humidity (%) :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fine_humidity" name="fine_humidity">
																		</div>
																	</div>
																</div>
															</div>


															<br>

															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Initial Vol. of Le-Chat. Flask (B), ml </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="den_intial" name="den_intial">
																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Time for Bed 1, Sec </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fines_t_1" name="fines_t_1">
																		</div>
																	</div>
																</div>

															</div>

															<br>

															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Final Vol. of Le-Chat. Flask (C), ml </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="den_final" name="den_final">
																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Time for Bed 1, Sec </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fines_t_2" name="fines_t_2">
																		</div>
																	</div>
																</div>

															</div>

															<br>

															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Density of Cement (&rho;)(A/(C-B)) </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="density" name="density">
																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Time for Bed 2, Sec </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fines_t_3" name="fines_t_3">
																		</div>
																	</div>
																</div>

															</div>

															<br>

															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">

																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">

																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Time for Bed 2, Sec </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fines_t_4" name="fines_t_4">
																		</div>
																	</div>
																</div>

															</div>

															<br>

															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Mass of Cement req. for Cement Bed (0.5 x v x &rho;) <br>
																				<input type="text" id="x" style="width:50px" name="x"> X <input type="text" id="v" style="width:50px" name="v"> X <input type="text" style="width:50px" id="p" name="p">
																			</label>

																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="mass" name="mass">
																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Avg. Time (T),Sec</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="avg_fines_time" name="avg_fines_time">
																		</div>
																	</div>
																</div>

															</div>

															<br>
															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<?php
																			if ($type_of_cement == "OPC") {
																			?>

																				<label for="inputEmail3" class="col-sm-12 control-label">Specific surface area, m<sup>2</sup>/kg (OPC) = K x &#8730;T</label>

																			<?php
																			} else {
																			?>
																				<label for="inputEmail3" class="col-sm-12 control-label">Specific surface area, m<sup>2</sup>/kg (Other than OPC) = K x &#8730;T x &#8730;e<sup>3</sup> / 1 - e</label>
																			<?php
																			}

																			?>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="ss_area" name="ss_area">
																		</div>
																	</div>
																</div>


															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Specific Surface of standard sample</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Specific Gravity of standard sample</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Porosity of standard bed</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">For standard &#8730;e3</label>
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="ss_sample" name="ss_sample">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="gs_sample" name="gs_sample">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="ps_bed" name="ps_bed">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fs_e3" name="fs_e3">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Time taken for standard sample</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Porosity of sample bed</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">For sample &#8730;e3</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Time elapsed from the bottom of the meniscus reaches next to the top mark till the bottom of the meniscus reaches the bottom mark.(in s) T1</label>
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="tts_sample" name="tts_sample">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="por_sample_bed" name="por_sample_bed">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="sample_e3" name="sample_e3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="tt1" name="tt1">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">


																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">1.  FINENESS BY DRY SIEVING</label>
																		</div>
																	</div>
																</div>
															</div>
															<br>

															<div class="row">


																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement, gm</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">45 Micron Retained Weight, gm</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">Percentage</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">Average (%)</label>
																		</div>
																	</div>
																</div>
															</div>
															</br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fbs_w1" name="fbs_w1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fbs_m1" name="fbs_m1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fbs_p1" name="fbs_p1" readonly>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="avg_fbs" name="avg_fbs
													">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fbs_w2" name="fbs_w2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fbs_m2" name="fbs_m2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fbs_p2" name="fbs_p2" readonly>
																		</div>
																	</div>
																</div>

															</div>
															<br>
														</div>
														<br>
													</div>
												</div>

											<?php
											} else if ($r1['test_code'] == "com") {
												$test_check .= "com,";
											?>
												<div class="panel panel-default" id="com">
													<div class="panel-heading" id="comp">
														<h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
																<h4 class="panel-title">
																	<b>COMPRESSIVE STRENGTH</b>
																</h4>
															</a>
														</h4>
													</div>
													<div id="collapse7" class="panel-collapse collapse">
														<div class="panel-body">
															<div class="row">
																<div class="col-lg-8">
																	<div class="form-group">
																		<div class="col-sm-1">
																			<label for="chk_com">4.</label>
																			<input type="checkbox" class="visually-hidden" name="chk_com" id="chk_com" value="chk_com"><br>
																		</div>
																		<label for="inputEmail3" class="col-sm-4 control-label label-right">COMPRESSIVE STRENGTH</label>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="com_date_test" name="com_date_test">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-8">
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">

																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">

																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-8">
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">

																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">

																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of cement + FLYASH (gm):</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="weight_of_cement" name="weight_of_cement">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label"></label>
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of Std. Sand (gm):</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="weight_of_sand" name="weight_of_sand">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label"></label>
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-1">
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label"></label>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Water = [consistency (%) / 4 + 3 ] x 8 = (gm)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="weight_of_water" name="weight_of_water">
																		</div>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-1">
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label"></label>
																		</div>
																	</div>
																</div>
															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Temp. (&deg;C)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="sp_1" name="sp_1" readonly>
																			<input type="text" class="form-control" id="com_temp" name="com_temp">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="sp_2" name="sp_2" readonly>
																			<input type="text" class="form-control" id="com_temp1" name="com_temp1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="sp_3" name="sp_3" readonly>
																			<input type="text" class="form-control" id="com_temp2" name="com_temp2">
																		</div>
																	</div>
																</div>
															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Hmdty (%)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="com_humidity" name="com_humidity">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_humidity1" name="com_humidity1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_humidity2" name="com_humidity2">
																		</div>
																	</div>
																</div>
															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Actual Date of Casting</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="caste_date1" name="caste_date1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="caste_date2" name="caste_date2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="caste_date3" name="caste_date3">
																		</div>
																	</div>
																</div>
															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Casting Time (min)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="caste_time1" name="caste_time1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="caste_time2" name="caste_time2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="caste_time3" name="caste_time3">
																		</div>
																	</div>
																</div>
															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Actual Date of Testing</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="test_date1" name="test_date1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="test_date2" name="test_date2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="test_date3" name="test_date3">
																		</div>
																	</div>
																</div>
															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Testing Time (min)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="test_time1" name="test_time1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="test_time2" name="test_time2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="test_time3" name="test_time3">
																		</div>
																	</div>
																</div>
															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Age of Testing (Days)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="day_1" name="day_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="day_2" name="day_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="day_3" name="day_3">
																		</div>
																	</div>
																</div>
															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of cube (kgs)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="woc_1" name="woc_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="woc_2" name="woc_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="woc_3" name="woc_3">
																		</div>
																	</div>
																</div>
															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">ID</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_1" name="static_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_2" name="static_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_3" name="static_3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_4" name="static_4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_5" name="static_5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_6" name="static_6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_7" name="static_7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_8" name="static_8">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_9" name="static_9">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Length, mm</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l1" name="l1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l2" name="l2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l3" name="l3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l4" name="l4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l5" name="l5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l6" name="l6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l7" name="l7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l8" name="l8">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l9" name="l9">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Width, mm</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b1" name="b1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b2" name="b2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b3" name="b3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b4" name="b4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b5" name="b5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b6" name="b6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b7" name="b7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b8" name="b8">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b9" name="b9">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Cross Sectional Area(mm 2 )</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_1" name="area_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_2" name="area_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_3" name="area_3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_4" name="area_4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_5" name="area_5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_6" name="area_6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_7" name="area_7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_8" name="area_8">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_9" name="area_9">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Load, kN</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_1" name="load_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_2" name="load_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_3" name="load_3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_4" name="load_4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_5" name="load_5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_6" name="load_6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_7" name="load_7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_8" name="load_8">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_9" name="load_9">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Compressive Strength (N/mm 2 )</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_1" name="com_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_2" name="com_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_3" name="com_3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_4" name="com_4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_5" name="com_5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_6" name="com_6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_7" name="com_7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_8" name="com_8">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_9" name="com_9">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Avg. Compressive Strength (N/mm 2 )</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="avg_com_1" name="avg_com_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="avg_com_2" name="avg_com_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="avg_com_3" name="avg_com_3">
																		</div>
																	</div>
																</div>


															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="chk_chk1">For 7 Days</label>
																			<input type="checkbox" class="visually-text" name="chk_chk1" id="chk_chk1" value="chk_chk1"><br>
																		</div>

																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="chk_chk1">For 7 Days</label>
																			<input type="checkbox" class="visually-text" name="chk_chk2" id="chk_chk2" value="chk_chk2"><br>
																		</div>

																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="chk_chk1">For 28 Days</label>
																			<input type="checkbox" class="visually-text" name="chk_chk3" id="chk_chk3" value="chk_chk3"><br>
																		</div>

																	</div>
																</div>


															</div>

															<br>
															<!--dd-->
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Temp. (&deg;C)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="sp_4" name="sp_4" readonly>
																			<input type="text" class="form-control" id="com_temp3" name="com_temp3">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Hmdty (%)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="com_humidity3" name="com_humidity3">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Actual Date of Casting</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="caste_date4" name="caste_date4">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Casting Time (mm)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="caste_time4" name="caste_time4">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Actual Date of Testing</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="test_date4" name="test_date4">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Testing Time (mm)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="test_time4" name="test_time4">
																		</div>
																	</div>
																</div>

															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Age of Testing (Days)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="day_4" name="day_4">
																		</div>
																	</div>
																</div>
															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of cube (kgs)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																			<input type="text" class="form-control" id="woc_4" name="woc_4">
																		</div>
																	</div>
																</div>
															</div>

															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">ID</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_10" name="static_10">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_11" name="static_11">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="static_12" name="static_12">
																		</div>
																	</div>
																</div>


															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Length, mm</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l10" name="l10">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l11" name="l11">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="l12" name="l12">
																		</div>
																	</div>
																</div>


															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Width, mm</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b10" name="b10">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b11" name="b11">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b12" name="b12">
																		</div>
																	</div>
																</div>


															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Cross Sectional Area(mm 2 )</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_10" name="area_10">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_11" name="area_11">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="area_12" name="area_12">
																		</div>
																	</div>
																</div>


															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Load, kN</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_10" name="load_10">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_11" name="load_11">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="load_12" name="load_12">
																		</div>
																	</div>
																</div>


															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Compressive Strength (N/mm 2 )</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_10" name="com_10">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_11" name="com_11">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="com_12" name="com_12">
																		</div>
																	</div>
																</div>


															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Avg. Compressive Strength (N/mm 2 )</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="avg_com_4" name="avg_com_4">
																		</div>
																	</div>
																</div>


															</div>
															<br>


															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">

																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="chk_chk1">For 28 Days</label>
																			<input type="checkbox" class="visually-text" name="chk_chk4" id="chk_chk4" value="chk_chk4"><br>
																		</div>

																	</div>
																</div>



															</div>


														</div>
													</div>


												</div>
											<?php
											} else if ($r1['test_code'] == "mou") {
												$test_check .= "mou,";
											?>
												<div class="panel panel-default" id="mou">
													<div class="panel-heading" id="mous">
														<h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
																<h4 class="panel-title">
																	<b>MOISTURE CONTENT</b>
																</h4>
															</a>
														</h4>
													</div>
													<div id="collapse1" class="panel-collapse collapse">
														<div class="panel-body">
															<!--Impact VALUE Start-->
															<br>
															<div class="row">
																<div class="col-lg-12">
																	<div class="form-group">
																		<div class="col-sm-1">
																			<label for="chk_mou">7.</label>
																			<input type="checkbox" class="visually-hidden" name="chk_mou" id="chk_mou" value="chk_mou"><br>
																		</div>
																		<label for="inputEmail3" class="col-sm-4 control-label label-right">MOISTURE CONTERNT</label>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<!--<div class="col-sm-6">					
						<div class="col-md-3">
							<h6 class="panel-title">
								<b>NOS OF BRICKS:</b>
							</h6>
						</div>
						<div class="col-md-9">
								<input type="text" class="form-control" id="no_of_brick" name="no_of_brick">
						</div>
					</div>-->
															</div>
															<br>
															<div class="row">

																<div class="col-sm-3">
																	<label for="inputEmail3" class="col-sm-12 control-label label-right">Initial weight in (gm) (W1)</label>
																</div>
																<div class="col-sm-3">
																	<label for="inputEmail3" class="col-sm-12 control-label label-right">Oven dry weight in (gm) (W2)</label>
																</div>
																<div class="col-sm-3">
																	<label for="inputEmail3" class="col-sm-12 control-label label-right">Moisture Content (%) = (W1 - W2/W1) x 100</label>
																</div>
																<div class="col-sm-3">
																	<label for="inputEmail3" class="col-sm-12 control-label label-right">Average Moisture Content (%) </label>
																</div>
															</div>

															<div class="row">

																<div class="col-sm-3">
																	<input type="text" class="form-control" id="in_w1" name="in_w1">
																</div>
																<div class="col-sm-3">
																	<input type="text" class="form-control" id="fn_w1" name="fn_w1">
																</div>
																<div class="col-sm-3">
																	<input type="text" class="form-control" id="mo1" name="mo1">
																</div>
																<div class="col-sm-3">
																	<input type="text" class="form-control" id="avg_mo" name="avg_mo">
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-sm-3">
																	<input type="text" class="form-control" id="in_w2" name="in_w2">
																</div>
																<div class="col-sm-3">
																	<input type="text" class="form-control" id="fn_w2" name="fn_w2">
																</div>
																<div class="col-sm-3">
																	<input type="text" class="form-control" id="mo2" name="mo2">
																</div>
																<div class="col-sm-3">

																</div>
															</div>

														</div>
													</div>
												</div>

											<?php }else if ($r1['test_code'] == "sou") {
												$test_check .= "sou,";
											?>

												<div class="panel panel-default" id="sou">
													<div class="panel-heading" id="sound">
														<h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
																<h4 class="panel-title">
																	<b>SOUNDNESS</b>
																</h4>
															</a>
														</h4>
													</div>
													<div id="collapse3" class="panel-collapse collapse">
														<div class="panel-body">
															<div class="row">

																<div class="col-lg-6">
																	<div class="form-group">
																		<div class="col-sm-1">
																			<label for="chk_sou">5.</label>
																			<input type="checkbox" class="visually-hidden" name="chk_sou" id="chk_sou" value="chk_sou"><br>
																		</div>
																		<label for="inputEmail3" class="col-sm-4 control-label label-right">SOUNDNESS</label>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>
																			<input type="text" class="form-control" id="sou_s_d" name="sou_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-4 control-label label-right">END DATE</label>
																			<input type="text" class="form-control" id="sou_e_d" name="sou_e_d" value="<?php echo date('d/m/Y', strtotime("$start_date +1 day")); ?>">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="sou_date_test" name="sou_date_test">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="col-md-3">
																		<div class="form-group">
																			<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
																		</div>
																	</div>
																	<div class="col-md-5">
																		<div class="form-group">
																			<input type="text" class="form-control" id="sou_test_method" name="sou_test_method" Value="<?php echo $sou_test_method; ?>" readonly> 
																			<input type="hidden" class="form-control" id="sou_test_id" name="sou_test_id" Value="<?php echo $r1["test"]; ?>">
																			<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"]; ?>">
																			<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"]; ?>">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="col-md-3">
																		<div class="form-group">
																			<!--<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>-->
																		</div>
																	</div>
																	<div class="col-md-5">
																		<div class="form-group">
																			<input type="hidden" class="form-control" id="sou_test_req" name="sou_test_req" Value="<?php echo $sou_test_req; ?>">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="col-md-3">
																		<div class="form-group">
																			<!--<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>-->
																		</div>
																	</div>
																	<div class="col-md-5">
																		<div class="form-group">
																			<input type="hidden" class="form-control" id="sou_test_limit_1" name="sou_test_limit_1" Value="<?php echo $sou_test_limit_1; ?>">
																			<input type="hidden" class="form-control" id="sou_test_limit_2" name="sou_test_limit_2" Value="<?php echo $sou_test_limit_2; ?>">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="col-md-3">
																		<div class="form-group">
																			<!--<button type="button" class="btn btn-info pull-right" onclick="saveIs('update_sou','<?php echo $r1["test"]; ?>','<?php echo $r1["material_category"]; ?>','<?php echo $r1["material_id"]; ?>')" name="btn_update_is" id="btn_update_is" tabindex="14">Update IS</button>-->
																		</div>
																	</div>

																</div>
															</div>
															<br>
															<div class="row">
																
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Temp. (&#8451;):</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="sou_temp" name="sou_temp">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Humidity (%) :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="sou_humidity" name="sou_humidity">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement (gm) :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="sou_weight" name="sou_weight">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Water (gm) = (0.78 x Consistency in %) x 2 </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="sou_water" name="sou_water">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">


																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Distance between two points
																				after 24 hours in water (mm)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Reading after 3 hrs. in boiling (mm)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">Difference (mm)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">Average (mm)</label>
																		</div>
																	</div>
																</div>
															</div>
															</br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dis_1_1" name="dis_1_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dis_2_1" name="dis_2_1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="diff_1" name="diff_1" readonly>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="soundness" name="soundness
													" readonly>
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dis_1_2" name="dis_1_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dis_2_2" name="dis_2_2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="diff_2" name="diff_2" readonly>
																		</div>
																	</div>
																</div>

															</div>
															<br>

														</div>
													</div>
												</div>

											<?php
											} else if ($r1['test_code'] == "set") {
												$test_check .= "set,";
											?>
												<div class="panel panel-default" id="set">
													<div class="panel-heading" id="sett">
														<h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
																<h4 class="panel-title">
																	<b>SETTING TIME</b>
																</h4>
															</a>
														</h4>
													</div>
													<div id="collapse4" class="panel-collapse collapse">
														<div class="panel-body">

															<div class="row">
																<div class="col-lg-6">
																	<div class="form-group">
																		<div class="col-sm-1">
																			<label for="chk_set">3.</label>
																			<input type="checkbox" class="visually-hidden" name="chk_set" id="chk_set" value="chk_set"><br>
																		</div>
																		<label for="inputEmail3" class="col-sm-4 control-label label-right">SETTING TIME</label>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="set_date_test" name="set_date_test">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>-->
																			<input type="hidden" class="form-control" id="set_s_d" name="set_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-4 control-label label-right">DATE OF TESTING</label>
																			<input type="text" class="form-control" id="set_e_d" name="set_e_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="col-md-3">
																		<div class="form-group">
																			<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
																		</div>
																	</div>
																	<div class="col-md-5">
																		<div class="form-group">
																			<input type="text" class="form-control" id="set_test_method" name="set_test_method" Value="<?php echo $set_test_method; ?>" readonly>
																			<input type="hidden" class="form-control" id="set_test_id" name="set_test_id" Value="<?php echo $r1["test"]; ?>">
																			<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"]; ?>">
																			<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"]; ?>">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="col-md-3">
																		<div class="form-group">
																			<!--<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>-->
																		</div>
																	</div>
																	<div class="col-md-5">
																		<div class="form-group">
																			<input type="hidden" class="form-control" id="set_test_req" name="set_test_req" Value="<?php echo $set_test_req; ?>">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="col-md-3">
																		<div class="form-group">
																			<!--<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>-->
																		</div>
																	</div>
																	<div class="col-md-5">
																		<div class="form-group">
																			<input type="hidden" class="form-control" id="set_test_limit_1" name="set_test_limit_1" Value="<?php echo $set_test_limit_1; ?>">
																			<input type="hidden" class="form-control" id="set_test_limit_2" name="set_test_limit_2" Value="<?php echo $set_test_limit_2; ?>">

																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="col-md-3">
																		<div class="form-group">
																			<!--<button type="button" class="btn btn-info pull-right" onclick="saveIs('update_set','<?php echo $r1["test"]; ?>','<?php echo $r1["material_category"]; ?>','<?php echo $r1["material_id"]; ?>')" name="btn_update_is" id="btn_update_is" tabindex="14">Update IS</button>-->
																		</div>
																	</div>

																</div>


															</div>
															<br>
															<div class="row">
																
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Temp. (&#8451;):</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="set_temp" name="set_temp">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Humidity (%) :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="set_humidity" name="set_humidity">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="set_weight" name="set_weight" value="400" ReadOnly>
																		</div>
																	</div>

																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">gm </label>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Water = 0.85 x Consistency (%) x 4 = </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="set_wtr" name="set_wtr" readonly>
																		</div>
																	</div>

																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">gm </label>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">a) Time when water added : </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control timepicker" id="hr_a" name="hr_a" >
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">hr/min </label>
																		</div>
																	</div>
																</div>

															</div>
															</br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">b) Initial setting time :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="hr_b" name="hr_b">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">hr/min </label>
																		</div>
																	</div>
																</div>

															</div>
															</br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">c) Final setting time : </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="hr_c" name="hr_c">
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">hr/min </label>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Initial setting time :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="initial_time" name="initial_time" ReadOnly>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">min.</label>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Final setting time :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="final_time" name="final_time" ReadOnly>
																		</div>
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">min.</label>
																		</div>
																	</div>
																</div>

															</div>
															<br>
														</div>
													</div>
												</div>

											
											<?php
											} else if ($r1['test_code'] == "fin") {
												$test_check .= "fin,";
											?>
												<div class="panel panel-default" id="fin">
													<div class="panel-heading" id="fins">
														<h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
																<h4 class="panel-title">
																	<b>BLAIN AIR PERMEABILITY</b>
																</h4>
															</a>
														</h4>
													</div>
													<div id="collapse6" class="panel-collapse collapse">
														<div class="panel-body">
															<div class="row">
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-1">
																			<label for="chk_fines">2.</label>
																			<input type="checkbox" class="visually-hidden" name="chk_fines" id="chk_fines" value="chk_fines"><br>
																		</div>
																		<label for="inputEmail3" class="col-sm-4 control-label label-right">BLAIN AIR PERMEABILITY</label>
																	</div>
																</div>
																	<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<!--<label for="inputEmail3" class="col-sm-12 control-label">START DATE:</label>-->
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">

																		</div>
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-4 col-lg-6 control-label label-right">DATE OF TESTING</label>
																			<input class="form-control" id="sba_joining_date" name="sba_joining_date" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<div class="row">

																<div class="col-lg-3">
																	<div class="col-md-3">
																		<div class="form-group">
																			<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
																		</div>
																	</div>
																	<div class="col-md-5">
																		<div class="form-group">
																			<input type="text" class="form-control" id="fine_test_method" name="fine_test_method" Value="<?php echo $fine_test_method; ?>" ReadOnly>
																			<input type="hidden" class="form-control" id="fine_test_id" name="fine_test_id" Value="<?php echo $r1["test"]; ?>">
																			<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"]; ?>">
																			<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"]; ?>">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="col-md-3">
																		<div class="form-group">
																		<!--	<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>-->
																		</div>
																	</div>
																	<div class="col-md-5">
																		<div class="form-group">
																			<input type="hidden" class="form-control" id="fine_test_req" name="fine_test_req" Value="<?php echo $fine_test_req; ?>">
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="col-md-3">
																		<div class="form-group">
																			<!--<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>-->
																		</div>
																	</div>
																	<div class="col-md-5">
																		<div class="form-group">
																			<input type="hidden" class="form-control" id="fine_test_limit" name="fine_test_limit" Value="<?php echo $fine_test_limit; ?>">


																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="col-md-3">
																		<div class="form-group">
																			<!--<button type="button" class="btn btn-info pull-right" onclick="saveIs('update_fin','<?php echo $r1["test"]; ?>','<?php echo $r1["material_category"]; ?>','<?php echo $r1["material_id"]; ?>')" name="btn_update_is" id="btn_update_is" tabindex="14">Update IS</button>-->
																		</div>
																	</div>

																</div>


															</div>
															<br>
															<div class="row">
																
																<div class="col-lg-4">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Apparatus Constant (K)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="constant_k" name="constant_k">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Temp.(&#8451;):</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fine_temp" name="fine_temp">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
															
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Humidity (%) :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fine_humidity" name="fine_humidity">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Time in seconds T : 1)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fines_t_1" name="fines_t_1">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Time in seconds T : 2)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fines_t_2" name="fines_t_2">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Time in seconds T : 3)</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="fines_t_3" name="fines_t_3">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Average :</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="avg_fines_time" name="avg_fines_time" ReadOnly>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">sec</label>
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-12">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Specific surface area S = K X &#8730;T  = </label>
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">
																<div class="col-lg-12">
																	<div class="form-group">

																		<div class="col-sm-2">
																			<input type="text" class="form-control" id="constant_k_1" name="constant_k_1" ReadOnly>
																		</div>
																		<div class="col-sm-1">
																			<label for="inputEmail3" class="col-sm-6 control-label">X</label>
																		</div>
																		<div class="col-sm-2">
																			<input type="text" class="form-control" id="fines_val1" name="fines_val1" ReadOnly>
																		</div>
																		<div class="col-sm-1">
																			<!--<label for="inputEmail3" class="col-sm-6 control-label">/</label>-->
																		</div>
																		<div class="col-sm-2">
																			<input type="hidden" class="form-control" id="fines_val2" name="fines_val2" ReadOnly>
																		</div>
																	</div>
																</div>


															</div>
															<br>
															<div class="row">
																<div class="col-lg-1">
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label"> = </label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="ss_area" name="ss_area" ReadOnly>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">m 2 /Kg</label>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															
															<br>
															<br>
														</div>
														<br>
														<br>
													</div>
												</div>
											

										<?php
											}
										}

										?>
										<hr>
										<hr>
										<!-- DISPLAY DATA LOGIC VAIBHAV-->
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
														$query = "select * from fly_ash WHERE lab_no='$aa'  and `is_deleted`='0'";

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
										</div> <!-- TEST LIST FILD VAIBHAV-->
										<input type="text" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ','); ?>">
						</form>
					</div>

				</div>
			</div>
		</div>
	</section>

</div>








<?php include("footer.php"); ?>
<script>
	$('#con_date_test').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	});
	$('#report_date').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	});
	$('#shr_start_date').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	});

 $('#hr_a,#hr_b,#hr_c').timepicker({
      showInputs: false,
	   use24hours: true
	   
    }); 

	$('.datess').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	});

	$('#chk_con').change(function() {
		if (this.checked) {
			$('#consis').css("background-color", "var(--primary)");
		} else {
			$('#consis').css("background-color", "white");
		}

	});

$('#chk_sou').change(function() {
		if (this.checked) {
			$('#sound').css("background-color", "var(--primary)");
		} else {
			$('#sound').css("background-color", "white");
		}

	});

$('#chk_set').change(function() {
		if (this.checked) {
			$('#sett').css("background-color", "var(--primary)");
		} else {
			$('#sett').css("background-color", "white");
		}

	});
	$('#chk_mou').change(function() {
		if (this.checked) {
			$('#mous').css("background-color", "var(--primary)");
		} else {
			$('#mous').css("background-color", "white");
		}

	});

	$('#chk_fines').change(function() {
		if (this.checked) {
			$('#fins').css("background-color", "var(--primary)");
		} else {
			$('#fins').css("background-color", "white");
		}

	});

	$('#chk_com').change(function() {
		if (this.checked) {

			$('#comp').css("background-color", "var(--primary)");
		} else {
			$('#comp').css("background-color", "white");
		}

	});



	$('#caste_date1').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	}).on("change", function() {

		var top = 7;
		var date_input = document.getElementById("caste_date1").value.split('/');
		var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
		var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
		var dd = newdate.getDate();
		var mm = newdate.getMonth() + 1;
		var y = newdate.getFullYear();
		if (mm <= 9)
			mm = '0' + mm;
		if (dd <= 9)
			dd = '0' + dd;
		var someFormattedDate = dd + '/' + mm + '/' + y;
		document.getElementById('test_date1').value = someFormattedDate;
		document.getElementById('day_1').value = top;

	});

	$('#caste_date2').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	}).on("change", function() {

		var top = 7;
		var date_input = document.getElementById("caste_date2").value.split('/');
		var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
		var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
		var dd = newdate.getDate();
		var mm = newdate.getMonth() + 1;
		var y = newdate.getFullYear();
		if (mm <= 9)
			mm = '0' + mm;
		if (dd <= 9)
			dd = '0' + dd;
		var someFormattedDate = dd + '/' + mm + '/' + y;
		document.getElementById('test_date2').value = someFormattedDate;
		document.getElementById('day_2').value = top;

	});

	$('#caste_date3').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	}).on("change", function() {

		var top = 28;
		var date_input = document.getElementById("caste_date3").value.split('/');
		var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
		var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
		var dd = newdate.getDate();
		var mm = newdate.getMonth() + 1;
		var y = newdate.getFullYear();
		if (mm <= 9)
			mm = '0' + mm;
		if (dd <= 9)
			dd = '0' + dd;
		var someFormattedDate = dd + '/' + mm + '/' + y;
		document.getElementById('test_date3').value = someFormattedDate;
		document.getElementById('day_3').value = top;

	});

	$('#caste_date4').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	}).on("change", function() {

		var top = 28;
		var date_input = document.getElementById("caste_date4").value.split('/');
		var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
		var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
		var dd = newdate.getDate();
		var mm = newdate.getMonth() + 1;
		var y = newdate.getFullYear();
		if (mm <= 9)
			mm = '0' + mm;
		if (dd <= 9)
			dd = '0' + dd;
		var someFormattedDate = dd + '/' + mm + '/' + y;
		document.getElementById('test_date4').value = someFormattedDate;
		document.getElementById('day_4').value = top;

	});


	$(function() {
		$('.select2').select2();
	})
	$(document).ready(function() {

		$('#btn_edit_data').hide();
		$('#alert').hide();


		var report_date;
		var con_date_test;
		var con_temp;
		var con_humidity;
		var con_weight;
		var vol_1;
		var vol_2;
		var vol_3;
		var vol_4;
		var vol_5;
		var vol_6;
		var vol_7;
		var wtr_1;
		var wtr_2;
		var wtr_3;
		var wtr_4;
		var wtr_5;
		var wtr_6;
		var wtr_7;
		var reading_1;
		var reading_2;
		var reading_3;
		var reading_4;
		var reading_5;
		var reading_6;
		var reading_7;
		var remark_1;
		var remark_2;
		var remark_3;
		var remark_4;
		var remark_5;
		var remark_6;
		var remark_7;
		var final_consistency;
		var consistency_of_cement;

		function consistency_auto() {
			$('#consis').css("background-color", "var(--primary)");
			con_temp = randomNumberFromRange(26.0, 28.0);
			$('#con_temp').val(con_temp.toFixed(1));
			con_date_test = $('#rec_sample_date').val();
			$('#con_date_test').val(con_date_test);
			con_humidity = randomNumberFromRange(65.0, 68.0);
			$('#con_humidity').val(con_humidity.toFixed());
			con_weight = 400;
			$('#con_weight').val(con_weight.toFixed());
			$('#consistency_of_cement').val('28');

			var t = randomNumberFromRange(1, 50);
			if (t % 2 == 0) {


				var items = Array(29.0, 29.5, 30.0, 30.5, 31.0, 31.5, 32.0, 32.5, 33.0);


				var ab = parseInt(items.length) - 1;

				randomNumber = rand(0, ab);

				randomItem = items[randomNumber];
				final_consistency = randomItem;
				$('#final_consistency').val(final_consistency.toFixed(1));
				wtr_3 = final_consistency;
				reading_3 = randomNumberFromRange(5.00, 7.00);
				var wt = $('#con_weight').val();
				vol_3 = ((+wtr_3) * (+wt)) / 100;
				$('#vol_3').val(vol_3.toFixed(0));
				$('#reading_3').val(reading_3.toFixed(0));
				$('#wtr_3').val(wtr_3.toFixed(1));

				wtr_1 = (+wtr_3) + (+0.5);
				wtr_2 = (+wtr_3)

				$('#wtr_2').val(wtr_2.toFixed(1));
				$('#wtr_1').val(wtr_1.toFixed(1));

				var wtr1 = $('#wtr_1').val();
				var wtr2 = $('#wtr_2').val();
				var wtr3 = $('#wtr_3').val();

				reading_1 = randomNumberFromRange(10.00, 12.00);
				reading_2 = reading_3;

				vol_1 = ((+wtr1) * (+wt)) / 100;
				vol_2 = ((+wtr2) * (+wt)) / 100;

				$('#vol_2').val(vol_2.toFixed(0));
				$('#vol_1').val(vol_1.toFixed(0));
				$('#reading_2').val(reading_2.toFixed(0));
				$('#reading_1').val(reading_1.toFixed(0));

			} else {


				var items = Array(29.0, 29.5, 30.0, 30.5, 31.0, 31.5, 32.0, 32.5, 33.0);

				var ab = parseInt(items.length) - 1;

				randomNumber = rand(0, ab);

				randomItem = items[randomNumber];
				final_consistency = randomItem;
				$('#final_consistency').val(final_consistency);
				wtr_3 = final_consistency;
				reading_3 = randomNumberFromRange(5.00, 7.00);
				var wt = $('#con_weight').val();
				vol_3 = ((+wtr_3) * (+wt)) / 100;
				$('#vol_3').val(vol_3.toFixed(0));
				$('#reading_3').val(reading_3.toFixed(0));
				$('#wtr_3').val(wtr_3.toFixed(1));

				wtr_1 = (+wtr_3) - (+1.0);
				wtr_2 = (+wtr_3)

				$('#wtr_2').val(wtr_2.toFixed(1));
				$('#wtr_1').val(wtr_1.toFixed(1));

				var wtr1 = $('#wtr_1').val();
				var wtr2 = $('#wtr_2').val();
				var wtr3 = $('#wtr_3').val();

				reading_1 = randomNumberFromRange(10.00, 12.00);
				reading_2 = reading_3;

				vol_1 = ((+wtr1) * (+wt)) / 100;
				vol_2 = ((+wtr2) * (+wt)) / 100;

				$('#vol_2').val(vol_2.toFixed(0));
				$('#vol_1').val(vol_1.toFixed(0));
				$('#reading_2').val(reading_2.toFixed(0));
				$('#reading_1').val(reading_1.toFixed(0));

			}

		}


		//CHECK CONSISTENCY
		$('#chk_con').change(function() {
			if (this.checked) {
				consistency_auto();
			} else {
				$('#consis').css("background-color", "white");
				$('#con_temp').val(null);
				$('#con_date_test').val(null);
				$('#con_humidity').val(null);
				$('#con_weight').val(null);
				$('#final_consistency').val(null);
				$('#consistency_of_cement').val(null);
				$('#vol_3').val(null);
				$('#reading_3').val(null);
				$('#wtr_3').val(null);
				$('#vol_2').val(null);
				$('#reading_2').val(null);
				$('#wtr_2').val(null);
				$('#vol_1').val(null);
				$('#reading_1').val(null);
				$('#wtr_1').val(null);

			}
		});



		$('#final_consistency').change(function() {
			$('#consis').css("background-color", "var(--primary)");
			if ($("#chk_con").is(':checked')) {

				con_weight = $('#con_weight').val();
				var t = randomNumberFromRange(1, 50);
				if (t % 2 == 0) {

					final_consistency = $('#final_consistency').val();

					wtr_3 = final_consistency;
					reading_3 = randomNumberFromRange(5.00, 7.00);
					var wt = $('#con_weight').val();
					vol_3 = ((+wtr_3) * (+wt)) / 100;
					$('#vol_3').val(vol_3.toFixed(0));
					$('#reading_3').val(reading_3.toFixed(0));
					$('#wtr_3').val(wtr_3);


					if (final_consistency == "28.0" || final_consistency == "28.5") {
						wtr_1 = (+wtr_3) - (+0.5);
						wtr_2 = (+wtr_3)

						$('#wtr_2').val(wtr_2.toFixed(1));
						$('#wtr_1').val(wtr_1.toFixed(1));

						var wtr1 = $('#wtr_1').val();
						var wtr2 = $('#wtr_2').val();
						var wtr3 = $('#wtr_3').val();

						reading_1 = randomNumberFromRange(10.00, 12.00);
						reading_2 = reading_3;

						vol_1 = ((+wtr1) * (+wt)) / 100;
						vol_2 = ((+wtr2) * (+wt)) / 100;

						$('#vol_2').val(vol_2.toFixed(0));
						$('#vol_1').val(vol_1.toFixed(0));
						$('#reading_2').val(reading_2.toFixed(0));
						$('#reading_1').val(reading_1.toFixed(0));

					} else {

						wtr_1 = (+wtr_3) - (+1.5);
						wtr_2 = (+wtr_3)

						$('#wtr_2').val(wtr_2.toFixed(1));
						$('#wtr_1').val(wtr_1.toFixed(1));

						var wtr1 = $('#wtr_1').val();
						var wtr2 = $('#wtr_2').val();
						var wtr3 = $('#wtr_3').val();

						reading_1 = randomNumberFromRange(10.00, 12.00);
						reading_2 = reading_3;

						vol_1 = ((+wtr1) * (+wt)) / 100;
						vol_2 = ((+wtr2) * (+wt)) / 100;

						$('#vol_2').val(vol_2.toFixed(0));
						$('#vol_1').val(vol_1.toFixed(0));
						$('#reading_2').val(reading_2.toFixed(0));
						$('#reading_1').val(reading_1.toFixed(0));


					}

				} else {
					final_consistency = $('#final_consistency').val();

					wtr_3 = final_consistency;
					reading_3 = randomNumberFromRange(5.00, 7.00);
					var wt = $('#con_weight').val();
					vol_3 = ((+wtr_3) * (+wt)) / 100;
					$('#vol_3').val(vol_3.toFixed(0));
					$('#reading_3').val(reading_3.toFixed(0));
					$('#wtr_3').val(wtr_3);

					if (final_consistency == "28.0" || final_consistency == "28.5" || final_consistency == "28.3") {

						wtr_1 = (+wtr_3) + (+0.5);
						wtr_2 = (+wtr_3)

						$('#wtr_2').val(wtr_2.toFixed(1));
						$('#wtr_1').val(wtr_1.toFixed(1));

						var wtr1 = $('#wtr_1').val();
						var wtr2 = $('#wtr_2').val();
						var wtr3 = $('#wtr_3').val();

						reading_1 = randomNumberFromRange(10.00, 12.00);
						reading_2 = reading_3;

						vol_1 = ((+wtr1) * (+wt)) / 100;
						vol_2 = ((+wtr2) * (+wt)) / 100;

						$('#vol_2').val(vol_2.toFixed(0));
						$('#vol_1').val(vol_1.toFixed(0));
						$('#reading_2').val(reading_2.toFixed(0));
						$('#reading_1').val(reading_1.toFixed(0));



					} else {
						wtr_1 = (+wtr_3) + (+1.0);
						wtr_2 = (+wtr_3)

						$('#wtr_2').val(wtr_2.toFixed(1));
						$('#wtr_1').val(wtr_1.toFixed(1));

						var wtr1 = $('#wtr_1').val();
						var wtr2 = $('#wtr_2').val();
						var wtr3 = $('#wtr_3').val();

						reading_1 = randomNumberFromRange(10.00, 12.00);
						reading_2 = reading_3;

						vol_1 = ((+wtr1) * (+wt)) / 100;
						vol_2 = ((+wtr2) * (+wt)) / 100;

						$('#vol_2').val(vol_2.toFixed(0));
						$('#vol_1').val(vol_1.toFixed(0));
						$('#reading_2').val(reading_2.toFixed(0));
						$('#reading_1').val(reading_1.toFixed(0));
					}

				}



			} else {
				$(this).val("");
				$("#vol_1").focus();
			}

		});

		$('#vol_1').change(function() {
			$('#consis').css("background-color", "var(--primary)");
			con_weight = $('#con_weight').val();
			vol_1 = $('#vol_1').val();
			wtr_1 = ((+vol_1) * 100) / (+con_weight);
			$('#wtr_1').val(wtr_1.toFixed(1));
			$('#final_consistency').val(wtr_1.toFixed(1));
			$('#consis').css("background-color", "var(--primary)");

		});
		$('#vol_2').change(function() {
			$('#consis').css("background-color", "var(--primary)");
			con_weight = $('#con_weight').val();
			vol_2 = $('#vol_2').val();
			wtr_2 = ((+vol_2) * 100) / (+con_weight);
			$('#wtr_2').val(wtr_2.toFixed(1));
			$('#final_consistency').val(wtr_2.toFixed(1));
			$('#consis').css("background-color", "var(--primary)");

		});
		$('#vol_3').change(function() {
			$('#consis').css("background-color", "var(--primary)");
			con_weight = $('#con_weight').val();
			vol_3 = $('#vol_3').val();
			wtr_3 = ((+vol_3) * 100) / (+con_weight);
			$('#wtr_3').val(wtr_3.toFixed(1));
			$('#final_consistency').val(wtr_3.toFixed(1));
			$('#consis').css("background-color", "var(--primary)");

		});


		$('#con_weight').change(function() {

			/*con_weight = $('#con_weight').val();
			wtr_1 = $('#wtr_1').val();
			wtr_2 = $('#wtr_2').val();
			wtr_3 = $('#wtr_3').val();
			wtr_4 = $('#wtr_4').val();
			
			vol_1 = (parseFloat(wtr_1) * parseFloat(con_weight))/100;
			vol_2 = (parseFloat(wtr_2) * parseFloat(con_weight))/100;
			vol_3 = (parseFloat(wtr_3) * parseFloat(con_weight))/100;
			vol_4 = (parseFloat(wtr_4) * parseFloat(con_weight))/100;				
			$('#vol_1').val(vol_1.toFixed(0));
			$('#vol_2').val(vol_2.toFixed(0));
			$('#vol_3').val(vol_3.toFixed(0));
			$('#vol_4').val(vol_4.toFixed(0));*/
			$('#consis').css("background-color", "var(--primary)");
		});



		//MOISTURE CONTERNT
		function mo_auto() {
			$('#mous').css("background-color", "var(--primary)");



			var avgmo = randomNumberFromRange(0.05, 1.00).toFixed(1);
			var in_w_1 = randomNumberFromRange(14.000, 16.000).toFixed(3);
			var in_w_2 = randomNumberFromRange(14.000, 16.000).toFixed(3);
			$('#in_w1').val(in_w_1);
			$('#in_w2').val(in_w_2);

			var in_w1 = $('#in_w1').val();
			var in_w2 = $('#in_w2').val();
			$('#avg_mo').val(avgmo);

			var get_avgdry = $('#avg_mo').val();


			var par1 = (+get_avgdry) + randomNumberFromRange(-0.05, 0.05);
			$('#mo1').val(par1.toFixed(2));

			var par_1 = $('#mo1').val();
			var par2 = ((+get_avgdry) * (+2)) - (+par1);
			$('#mo2').val(par2.toFixed(2));

			var par_2 = $('#mo2').val();

			var final1 = (+in_w1) * (+par_1);
			var final2 = (+in_w2) * (+par_2);

			var fnl_ans_1 = (+final1) / 100;
			var fnl_ans_2 = (+final2) / 100;

			var fnl_ans1 = (+in_w1) - (+fnl_ans_1);
			var fnl_ans2 = (+in_w2) - (+fnl_ans_2);

			$('#fn_w1').val(fnl_ans1.toFixed(3));
			$('#fn_w2').val(fnl_ans2.toFixed(3));

		}

		$('#chk_mou').change(function() {
			if (this.checked) {
				mo_auto();
			} else {
				$('#mous').css("background-color", "white");

				$('#in_w1').val(null);
				$('#in_w2').val(null);
				$('#fn_w1').val(null);
				$('#fn_w2').val(null);
				$('#mo1').val(null);
				$('#mo2').val(null);
				$('#avg_mo').val(null);

			}
		});

		$('#avg_mo').change(function() {
			$('#mous').css("background-color", "var(--primary)");




			var in_w_1 = randomNumberFromRange(14.000, 16.000).toFixed(3);
			var in_w_2 = randomNumberFromRange(14.000, 16.000).toFixed(3);
			$('#in_w1').val(in_w_1);
			$('#in_w2').val(in_w_2);

			var in_w1 = $('#in_w1').val();
			var in_w2 = $('#in_w2').val();

			var get_avgdry = $('#avg_mo').val();


			var par1 = (+get_avgdry) + randomNumberFromRange(-0.05, 0.05);
			$('#mo1').val(par1.toFixed(2));

			var par_1 = $('#mo1').val();
			var par2 = ((+get_avgdry) * (+2)) - (+par1);
			$('#mo2').val(par2.toFixed(2));

			var par_2 = $('#mo2').val();

			var final1 = (+in_w1) * (+par_1);
			var final2 = (+in_w2) * (+par_2);

			var fnl_ans_1 = (+final1) / 100;
			var fnl_ans_2 = (+final2) / 100;

			var fnl_ans1 = (+in_w1) - (+fnl_ans_1);
			var fnl_ans2 = (+in_w2) - (+fnl_ans_2);

			$('#fn_w1').val(fnl_ans1.toFixed(3));
			$('#fn_w2').val(fnl_ans2.toFixed(3));
		});


var sou_weight;
		var sou_water;
		var sou_temp;
		var sou_date_test;
		var sou_humidity;
		var dis_1_1;
		var dis_1_2;
		var dis_2_1;
		var dis_2_2;
		var diff_1;
		var diff_2;
		var soundness;

		function soundness_auto() {
			$('#sound').css("background-color", "var(--primary)");
			sou_temp = randomNumberFromRange(26.0, 28.0);
			$('#sou_temp').val(sou_temp.toFixed(1));
			var top = 2;
			//var date_input = document.getElementById("con_date_test").value.split('/');
			var date_input = $('#rec_sample_date').val().split('/');
			var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
			var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			if (mm <= 9)
				mm = '0' + mm;
			if (dd <= 9)
				dd = '0' + dd;
			var someFormattedDate = dd + '/' + mm + '/' + y;
			document.getElementById('sou_date_test').value = someFormattedDate;

			sou_humidity = randomNumberFromRange(65.0, 69.0);
			$('#sou_humidity').val(sou_humidity.toFixed(1));
			sou_weight = 200;
			$('#sou_weight').val(sou_weight.toFixed(2));

			var consis = $('#final_consistency').val();

			sou_water = (0.78 * parseFloat(consis)) * 2;
			$('#sou_water').val(sou_water.toFixed(1));


			var items1 = randomNumberFromRange(0.60, 1.20).toFixed(2);

			soundness = items1;
			$('#soundness').val(soundness);
			diff_1 = (+soundness) + randomNumberFromRange(-0.08, 0.07);
			$('#diff_1').val(diff_1.toFixed(2));
			var diff1 = $('#diff_1').val();
			diff_2 = ((+soundness) * (+2)) - (+diff1);
			$('#diff_2').val(diff_2.toFixed(2));
			var diff2 = $('#diff_2').val();
			dis_2_1 = randomNumberFromRange(9.00, 12.00);
			dis_2_2 = randomNumberFromRange(9.00, 12.00);
			$('#dis_2_1').val(dis_2_1.toFixed(2));
			$('#dis_2_2').val(dis_2_2.toFixed(2));
			var dis_2_1 = $('#dis_2_1').val();
			var dis_2_2 = $('#dis_2_2').val();
			dis_1_1 = (+dis_2_1) - (+diff1);
			dis_1_2 = (+dis_2_2) - (+diff2);
			$('#dis_1_1').val(dis_1_1.toFixed(2));
			$('#dis_1_2').val(dis_1_2.toFixed(2));
		}


		$('#chk_sou').change(function() {
			if (this.checked) {
				soundness_auto();
			} else {
				$('#sound').css("background-color", "white");
				$('#sou_temp').val(null);
				$('#sou_date_test').val(null);
				$('#sou_humidity').val(null);
				$('#sou_weight').val(null);
				$('#soundness').val(null);
				$('#sou_water').val(null);
				$('#diff_1').val(null);
				$('#diff_2').val(null);
				$('#dis_2_1').val(null);
				$('#dis_2_2').val(null);
				$('#dis_1_1').val(null);
				$('#dis_1_2').val(null);

			}
		});

		function sou_dis_2() {
			$('#sound').css("background-color", "var(--primary)");
			if ($("#chk_sou").is(':checked')) {
				soundness = $('#soundness').val();
				diff_1 = (+soundness) + randomNumberFromRange(-0.08, 0.07).toFixed(2);
				$('#diff_1').val(diff_1.toFixed(2));
				var diff1 = $('#diff_1').val();
				diff_2 = ((+soundness) * (+2)) - (+diff1);
				$('#diff_2').val(diff_2.toFixed(2));
				var diff2 = $('#diff_2').val();
				dis_2_1 = $('#dis_2_1').val();
				dis_2_2 = $('#dis_2_2').val();
				dis_1_1 = (+dis_2_1) - (+diff_1);
				dis_1_2 = (+dis_2_2) - (+diff_2);
				$('#dis_1_1').val(dis_1_1.toFixed(2));
				$('#dis_1_2').val(dis_1_2.toFixed(2));
			}
		}
		$('#soundness').change(function() {
			sou_dis_2();
		});
		$('#dis_2_1').change(function() {
			$('#sound').css("background-color", "var(--primary)");

			dis_1_1 = $('#dis_1_1').val();
			dis_1_2 = $('#dis_1_2').val();
			dis_2_1 = $('#dis_2_1').val();
			dis_2_2 = $('#dis_2_2').val();

			diff_1 = (+dis_2_1) - (+dis_1_1);
			diff_2 = (+dis_2_2) - (+dis_1_2);
			$('#diff_1').val(diff_1.toFixed(2));
			$('#diff_2').val(diff_2.toFixed(2));
			var diff1 = $('#diff_1').val();
			var diff2 = $('#diff_2').val();
			soundness = ((+diff_1) + (+diff_2)) / 2;
			$('#soundness').val(soundness.toFixed(2));

		});
		$('#dis_2_2').change(function() {
			$('#sound').css("background-color", "var(--primary)");

			dis_1_1 = $('#dis_1_1').val();
			dis_1_2 = $('#dis_1_2').val();
			dis_2_1 = $('#dis_2_1').val();
			dis_2_2 = $('#dis_2_2').val();

			diff_1 = (+dis_2_1) - (+dis_1_1);
			diff_2 = (+dis_2_2) - (+dis_1_2);
			$('#diff_1').val(diff_1.toFixed(2));
			$('#diff_2').val(diff_2.toFixed(2));
			var diff1 = $('#diff_1').val();
			var diff2 = $('#diff_2').val();
			soundness = ((+diff_1) + (+diff_2)) / 2;
			$('#soundness').val(soundness.toFixed(2));

		});
		$('#dis_1_1').change(function() {
			$('#sound').css("background-color", "var(--primary)");

			dis_1_1 = $('#dis_1_1').val();
			dis_1_2 = $('#dis_1_2').val();
			dis_2_1 = $('#dis_2_1').val();
			dis_2_2 = $('#dis_2_2').val();

			diff_1 = (+dis_2_1) - (+dis_1_1);
			diff_2 = (+dis_2_2) - (+dis_1_2);
			$('#diff_1').val(diff_1.toFixed(2));
			$('#diff_2').val(diff_2.toFixed(2));
			var diff1 = $('#diff_1').val();
			var diff2 = $('#diff_2').val();
			soundness = ((+diff_1) + (+diff_2)) / 2;
			$('#soundness').val(soundness.toFixed(2));


		});

		$('#dis_1_2').change(function() {
			$('#sound').css("background-color", "var(--primary)");

			dis_1_1 = $('#dis_1_1').val();
			dis_1_2 = $('#dis_1_2').val();
			dis_2_1 = $('#dis_2_1').val();
			dis_2_2 = $('#dis_2_2').val();

			diff_1 = (+dis_2_1) - (+dis_1_1);
			diff_2 = (+dis_2_2) - (+dis_1_2);
			$('#diff_1').val(diff_1.toFixed(2));
			$('#diff_2').val(diff_2.toFixed(2));
			var diff1 = $('#diff_1').val();
			var diff2 = $('#diff_2').val();
			soundness = ((+diff_1) + (+diff_2)) / 2;
			$('#soundness').val(soundness.toFixed(2));


		});

		$('#sou_weight').change(function() {
			$('#sound').css("background-color", "var(--primary)");

			var consis = $('#final_consistency').val();

			sou_water = (0.78 * parseFloat(consis)) * 2;
			$('#sou_water').val(sou_water.toFixed(1));



		});

		function timeConvert(n) {
			var num = n;
			var hours = (num / 60);
			var rhours = Math.floor(hours);
			var minutes = (hours - rhours) * 60;
			var rminutes = Math.round(minutes);
			return rhours + ":" + rminutes + ":00";
		}
		
		function tConvert (time) {
			  // Check correct time format and split into components
			  time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

			  if (time.length > 1) { // If time format correct
				time = time.slice (1);  // Remove full string match value
				time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
				time[0] = +time[0] % 12 || 12; // Adjust hours
			  }
			  return time.join (''); // return adjusted time or original string
			}
			
			
			function tConv24(time24) {
  var ts = time24;
  var H = +ts.substr(0, 2);
  var h = (H % 12) || 12;
  h = (h < 10)?("0"+h):h;  // leading 0 at the left for 1 digit hours
  var ampm = H < 12 ? " AM" : " PM";
  ts = h + ts.substr(2, 3) + ampm;
  return ts;
}



function changeTimeFormat() {
    let date = new Date();
 
    let hours = date.getHours();
    let minutes = date.getMinutes();
 
    // Check whether AM or PM
    let newformat = hours >= 12 ? 'PM' : 'AM';
 
    // Find current hour in AM-PM Format
    hours = hours % 12;
 
    // To display "0" as "12"
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? '0' + minutes : minutes;
 
    return hours + ':' + minutes + ' ' + newformat;
}

		function addTimes(startTime, endTime) {
			var times = [0, 0, 0]
			var max = times.length

			var a = (startTime || '').split(':')
			var b = (endTime || '').split(':')

			// normalize time values
			for (var i = 0; i < max; i++) {
				a[i] = isNaN(parseInt(a[i])) ? 0 : parseInt(a[i])
				b[i] = isNaN(parseInt(b[i])) ? 0 : parseInt(b[i])
			}

			// store time values
			for (var i = 0; i < max; i++) {
				times[i] = a[i] + b[i]
			}

			var hours = times[0]
			var minutes = times[1]
			var seconds = times[2]

			if (seconds >= 60) {
				var m = (seconds / 60) << 0
				minutes += m
				seconds -= 60 * m
			}

			if (minutes >= 60) {
				var h = (minutes / 60) << 0
				hours += h
				minutes -= 60 * h
			}

			return ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);
		}

		var set_temp;
		var set_date_test;
		var set_weight;
		var set_wtr;
		var set_humidity;
		var hr_a;
		var hr_b;
		var hr_c;
		var initial_time;
		var final_time;

		
			function set_auto() {
			$('#sett').css("background-color", "var(--primary)");
			set_temp = randomNumberFromRange(26.0, 28.0);
			$('#set_temp').val(set_temp.toFixed(1));
			var top = 1;
			//var date_input = document.getElementById("con_date_test").value.split('/');	
			var date_input = $('#rec_sample_date').val().split('/');
			var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
			var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			if (mm <= 9)
				mm = '0' + mm;
			if (dd <= 9)
				dd = '0' + dd;
			var someFormattedDate = dd + '/' + mm + '/' + y;
			document.getElementById('set_date_test').value = someFormattedDate;

			set_humidity = randomNumberFromRange(65.0, 69.0);
			$('#set_humidity').val(set_humidity.toFixed(1));

			var consis = $('#final_consistency').val();

			set_wtr = (0.85 * (+consis)) * 4;
			$('#set_wtr').val(set_wtr.toFixed(1));

			var grades = $('#cement_grade').val();
			if (grades == "53 OPC") {
				
				var items = Array(120,130,140,150);
				
				var ab = parseInt(items.length) - 1;

				randomNumber = rand(0, ab);

				randomItem = items[randomNumber];
				initial_time1 = randomItem;

			} else if (grades == "43 OPC") {
				var items = Array(120,130,140,150);
				
				var ab = parseInt(items.length) - 1;

				randomNumber = rand(0, ab);

				randomItem = items[randomNumber];
				initial_time1 = randomItem;
			} else if (grades == "33 OPC") {
				var items = Array(120,130,140,150);
				
				var ab = parseInt(items.length) - 1;

				randomNumber = rand(0, ab);

				randomItem = items[randomNumber];
				initial_time1 = randomItem;
			} else if (grades == "33_grade") {
				var items = Array(150,160,170,180);
				
				var ab = parseInt(items.length) - 1;

				randomNumber = rand(0, ab);

				randomItem = items[randomNumber];
				initial_time1 = randomItem;
			} else if (grades == "flyash_type" || grades == "calcined_clay_type") {
				var items = Array(150,160,170,180);
				
				var ab = parseInt(items.length) - 1;

				randomNumber = rand(0, ab);

				randomItem = items[randomNumber];
				initial_time1 = randomItem;
			} else if (grades == "OPC - 43 S") {
				var items = Array(120,130,140,150);
				
				var ab = parseInt(items.length) - 1;

				randomNumber = rand(0, ab);

				randomItem = items[randomNumber];
				initial_time1 = randomItem;
			} else if (grades == "OPC - 53 S") {
				var items = Array(120,130,140,150);
				
				var ab = parseInt(items.length) - 1;

				randomNumber = rand(0, ab);

				randomItem = items[randomNumber];
				initial_time1 = randomItem;
			} else if (grades == "PORTLAND SLAG") {
				var items = Array(150,160,170,180);
				
				var ab = parseInt(items.length) - 1;

				randomNumber = rand(0, ab);

				randomItem = items[randomNumber];
				initial_time1 = randomItem;

			}
			$('#initial_time').val(initial_time1);
			var initial_time = $('#initial_time').val();
			
				var items1 = Array(60,70);
				
				var ab1 = parseInt(items1.length) - 1;

				randomNumber1 = rand(0, ab1);

				randomItem1 = items[randomNumber1];
				var ff_time = randomItem1;
			
			
			var final_time = (+initial_time) + (+ff_time);
			var set_weight = 400;
			$('#set_weight').val(set_weight.toFixed(0));
			/*var abss1 = parseInt(initial_time.length) - 1; 
			randomNumber1 = rand(0, abss1);
			randomItem1 = initial_time[randomNumber1];*/
			//final_time1 = parseInt(final_time)+parseInt(randomItem1);

			$('#final_time').val(final_time.toFixed());
			var final_time1 = $('#final_time').val();


			var a_time_hr = randomNumberFromRange(10, 15).toFixed();
			var a_time_min = randomNumberFromRange(10, 55).toFixed();
			var a_times = a_time_hr + ":" + a_time_min + ":00";

			var intitalq = timeConvert(initial_time);
			var finals = timeConvert(final_time1);

			var hr_b = addTimes(intitalq, a_times);
			var hr_c = addTimes(finals, a_times);
			//alert("WATER: "+ a_times + "\n INTIAL : "+ intitalq + "\n FINLS : "+finals + "\n MIN "+randomItem1);
			
			var f = tConv24(a_times);
			var bc = tConv24(hr_b);
			var fc = tConv24(hr_c);
			$('#hr_a').val(f);
			$('#hr_b').val(bc);
			$('#hr_c').val(fc);
		}


		$('#chk_set').change(function() {
			if (this.checked) {
				set_auto();
			} else {
				$('#sett').css("background-color", "white");
				$('#set_temp').val(null);
				$('#set_date_test').val(null);
				$('#set_humidity').val(null);
				$('#set_wtr').val(null);
				$('#initial_time').val(null);
				$('#final_time').val(null);
				$('#hr_a').val(null);
				$('#hr_b').val(null);
				$('#hr_c').val(null);
				$('#set_weight').val(null);

			}
		});

		$('#initial_time').change(function() {

			if ($("#chk_set").is(':checked')) {
				initial_time = $('#initial_time').val();
				var a_times = $('#hr_a').val();
				var intital = timeConvert(initial_time);
				var hr_b = addTimes(intital, a_times);
				$('#hr_b').val(hr_b);

			}
			$('#sett').css("background-color", "var(--primary)");


		});
		$('#final_time').change(function() {

			if ($("#chk_set").is(':checked')) {
				final_time = $('#final_time').val();
				var a_times = $('#hr_a').val();
				var finals = timeConvert(final_time);
				var hr_c = addTimes(finals, a_times);
				$('#hr_c').val(hr_c);
			}
			$('#sett').css("background-color", "var(--primary)");

		});


		$('#hr_b').change(function() {
			/*if ($("#chk_set").is(':checked')) {*/
			
			hr_b = $('#hr_b').val();
			var hours = Number(hr_b.match(/^(\d+)/)[1]);
			var minutes = Number(hr_b.match(/:(\d+)/)[1]);
			var AMPM = hr_b.match(/\s(.*)$/)[1];
			if(AMPM == "PM" && hours<12) hours = hours+12;
			if(AMPM == "AM" && hours==12) hours = hours-12;
			var sHours = hours.toString();
			var sMinutes = minutes.toString();
			if(hours<10) sHours = "0" + sHours;
			if(minutes<10) sMinutes = "0" + sMinutes;
			var tts = sHours + ":" + sMinutes + ":00";
			
			
			var a_times1 = $('#hr_a').val();
			var hours = Number(a_times1.match(/^(\d+)/)[1]);
			var minutes = Number(a_times1.match(/:(\d+)/)[1]);
			var AMPM = a_times1.match(/\s(.*)$/)[1];
			if(AMPM == "PM" && hours<12) hours = hours+12;
			if(AMPM == "AM" && hours==12) hours = hours-12;
			var sHours = hours.toString();
			var sMinutes = minutes.toString();
			if(hours<10) sHours = "0" + sHours;
			if(minutes<10) sMinutes = "0" + sMinutes;
			var a_times = sHours + ":" + sMinutes + ":00";
			
			 var tims = tts.split(":");
			var hrs = tims[0];
			var mins = tims[1];
			var hr_cal = parseInt(hrs) * 60;
			var total = parseInt(hr_cal) + parseInt(mins);
			
			
			var wtr_time = a_times.split(":");
			var hrs1 = wtr_time[0];
			var mins1 = wtr_time[1];
			var hr_cal1 = parseInt(hrs1) * 60;
			var water_final = parseInt(hr_cal1) + parseInt(mins1);
			var ans = (+total) - (+water_final);
			
			$('#initial_time').val(ans.toFixed(0));
			/*	}*/
			$('#sett').css("background-color", "var(--primary)");
		});


		$('#hr_c').change(function() {
			/*if ($("#chk_set").is(':checked')) {*/
			hr_c = $('#hr_c').val();
			var hours = Number(hr_c.match(/^(\d+)/)[1]);
			var minutes = Number(hr_c.match(/:(\d+)/)[1]);
			var AMPM = hr_c.match(/\s(.*)$/)[1];
			if(AMPM == "PM" && hours<12) hours = hours+12;
			if(AMPM == "AM" && hours==12) hours = hours-12;
			var sHours = hours.toString();
			var sMinutes = minutes.toString();
			if(hours<10) sHours = "0" + sHours;
			if(minutes<10) sMinutes = "0" + sMinutes;
			var tts = sHours + ":" + sMinutes + ":00";
			
			var a_times1 = $('#hr_a').val();
			var hours = Number(a_times1.match(/^(\d+)/)[1]);
			var minutes = Number(a_times1.match(/:(\d+)/)[1]);
			var AMPM = a_times1.match(/\s(.*)$/)[1];
			if(AMPM == "PM" && hours<12) hours = hours+12;
			if(AMPM == "AM" && hours==12) hours = hours-12;
			var sHours = hours.toString();
			var sMinutes = minutes.toString();
			if(hours<10) sHours = "0" + sHours;
			if(minutes<10) sMinutes = "0" + sMinutes;
			var a_times = sHours + ":" + sMinutes + ":00";
			
			var tims = tts.split(":");
			var hrs = tims[0];
			var mins = tims[1];
			var hr_cal = parseInt(hrs) * 60;
			var total = parseInt(hr_cal) + parseInt(mins);
			var wtr_time = a_times.split(":");
			var hrs1 = wtr_time[0];
			var mins1 = wtr_time[1];
			var hr_cal1 = parseInt(hrs1) * 60;
			var water_final = parseInt(hr_cal1) + parseInt(mins1);
			var ans = (+total) - (+water_final);
			$('#final_time').val(ans.toFixed(0));
			/*}*/
			$('#sett').css("background-color", "var(--primary)");

		});
		$('#hr_a').change(function() {

			var consis = $('#final_consistency').val();
			set_wtr = (0.85 * (+consis)) * 4;
			$('#set_wtr').val(set_wtr.toFixed(1));
			
			

		});




/*
		function timeConvert(n) {
			var num = n;
			var hours = (num / 60);
			var rhours = Math.floor(hours);
			var minutes = (hours - rhours) * 60;
			var rminutes = Math.round(minutes);
			return rhours + ":" + rminutes + ":00";
		}

		function addTimes(startTime, endTime) {
			var times = [0, 0, 0]
			var max = times.length

			var a = (startTime || '').split(':')
			var b = (endTime || '').split(':')

			// normalize time values
			for (var i = 0; i < max; i++) {
				a[i] = isNaN(parseInt(a[i])) ? 0 : parseInt(a[i])
				b[i] = isNaN(parseInt(b[i])) ? 0 : parseInt(b[i])
			}

			// store time values
			for (var i = 0; i < max; i++) {
				times[i] = a[i] + b[i]
			}

			var hours = times[0]
			var minutes = times[1]
			var seconds = times[2]

			if (seconds >= 60) {
				var m = (seconds / 60) << 0
				minutes += m
				seconds -= 60 * m
			}

			if (minutes >= 60) {
				var h = (minutes / 60) << 0
				hours += h
				minutes -= 60 * h
			}

			return ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);
		}
*/

		var fbs_w1;
		var fbs_w2;
		var fbs_m1;
		var fbs_m2;
		var fbs_p1;
		var fbs_p2;
		var avg_fbs;
		var den_intial1;
		var den_intial;
		var den_final1;
		var den_final;
		var den_temp;
		var den_date_test;
		var den_humidity;
		var den_displaced;
		var den_displaced1;
		var density;
		var density1;
		var avg_density;
		var den_m2;
		var den_m3;
		var den_d;
		var den_weight;
		var den_volume;

		function fines_auto() {
			$('#fines').css("background-color", "var(--primary)");


			var top = 1;
			var date_input = document.getElementById("con_date_test").value.split('/');
			var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
			var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			if (mm <= 9)
				mm = '0' + mm;
			if (dd <= 9)
				dd = '0' + dd;
			var someFormattedDate = dd + '/' + mm + '/' + y;
			document.getElementById('den_date_test').value = someFormattedDate;
			fine_temp = randomNumberFromRange(25.0, 29.0);
			$('#fine_temp').val(fine_temp.toFixed(1));
			//fine_humidity = randomNumberFromRange(65.0,69.0);
			fine_humidity = randomNumberFromRange(61.0, 64.0);
			$('#fine_humidity').val(fine_humidity.toFixed());


			fbsw1 = randomNumberFromRange(100, 100).toFixed(2);
			fbsw2 = randomNumberFromRange(100, 100).toFixed(2);
			$('#fbs_w1').val(fbsw1);
			$('#fbs_w2').val(fbsw2);
			var fbs_w1 = $('#fbs_w1').val();
			var fbs_w2 = $('#fbs_w2').val();
			var avgfbs = randomNumberFromRange(3.0, 5.0).toFixed(1);
			$('#avg_fbs').val(avgfbs);
			var avg_fbs = $('#avg_fbs').val();

			fbsp1 = (+avg_fbs) + randomNumberFromRange(-0.10, 0.10);
			$('#fbs_p1').val(fbsp1.toFixed(2));
			var fbs_p1 = $('#fbs_p1').val();
			fbsp2 = ((+avg_fbs) * (+2)) - (+fbsp1);
			$('#fbs_p2').val(fbsp2.toFixed(2));
			var fbs_p2 = $('#fbs_p2').val();

			var m1 = (+fbs_w1) * (+fbs_p1);
			var m2 = (+fbs_w2) * (+fbs_p2);

			var ans1 = (+m1) / 100;
			var ans2 = (+m2) / 100;
			$('#fbs_m1').val(ans1.toFixed(2));
			$('#fbs_m2').val(ans2.toFixed(2));

			//SIDHU
			var f_bsw1 = $('#fbs_w1').val();
			var f_bsw2 = $('#fbs_w2').val();

			var f_bsm1 = $('#fbs_m1').val();
			var f_bsm2 = $('#fbs_m2').val();

			var cal1 = (+100) * (+f_bsm1);
			var cal2 = (+100) * (+f_bsm2);

			var anss1 = (+cal1) / (+f_bsw1);
			var anss2 = (+cal2) / (+f_bsw2);

			$('#fbs_p1').val(anss1.toFixed(2));
			$('#fbs_p2').val(anss2.toFixed(2));

			var f_bsp1 = $('#fbs_p1').val();
			var f_bsp2 = $('#fbs_p2').val();

			var avg = ((+f_bsp1) + (+f_bsp2)) / 2;
			$('#avg_fbs').val(avg.toFixed(1));




			var constant_k = 62.06;


			$('#constant_k').val(constant_k.toFixed(2));

			var den_cement = randomNumberFromRange(55.0000, 60.0000).toFixed(4);
			$('#den_cement').val(den_cement);
			var dencement = $('#den_cement').val();
			var constantk = $('#constant_k').val();



			//ss_area = randomNumberFromRange(280, 350);
			ss_area = randomNumberFromRange(330, 410);

			ss_sample = randomNumberFromRange(330, 410);
			gs_sample = randomNumberFromRange(2.10, 2.90);
			ps_bed = randomNumberFromRange(0.1, 0.9);
			fs_e3 = randomNumberFromRange(0.100, 0.999);
			tts_sample = randomNumberFromRange(10, 90);
			por_sample_bed = randomNumberFromRange(0.1, 0.9);
			sample_e3 = randomNumberFromRange(0.100, 0.999);
			tt1 = randomNumberFromRange(50.1, 90.9);

			//var density = randomNumberFromRange(3.01, 3.15);
			var density = randomNumberFromRange(2.70, 2.92);
			var v = 1.85;



			//ss_sample,gs_sample,ps_bed,fs_e3,tts_sample,por_sample_bed,sample_e3,tt1
			$('#ss_sample').val(ss_sample.toFixed(0));
			$('#gs_sample').val(gs_sample.toFixed(2));
			$('#ps_bed').val(ps_bed.toFixed(1));
			$('#fs_e3').val(fs_e3.toFixed(3));
			$('#tts_sample').val(tts_sample.toFixed(0));
			$('#por_sample_bed').val(por_sample_bed.toFixed(1));
			$('#sample_e3').val(sample_e3.toFixed(3));
			$('#tt1').val(tt1.toFixed(1));

			$('#ss_area').val(ss_area.toFixed(0));
			$('#density').val(density.toFixed(2));
			var ssarea = $('#ss_area').val();
			var density1 = $('#density').val();
			var e = 0.5;
			var roote3 = 0.354;


			var formul = (+1) - (+e);
			var ans = (+ssarea) * (+formul);
			var ans2 = (+constantk) * (+roote3);
			var fin = (+ans) / (+ans2);
			var avg_fines_time = (+fin) * (+fin);
			$('#avg_fines_time').val(avg_fines_time.toFixed(2));
			var avgfines_time = $('#avg_fines_time').val();



			var t = randomNumberFromRange(0, 50).toFixed();
			if (t % 2 == 0) {
				var fines_t_1 = (+avgfines_time) + (+0.05);
				var fines_t_2 = (+avgfines_time) + (+0.15);
				var fines_t_3 = (+avgfines_time) - (+0.18);
				var fines_t_4 = (+avgfines_time) - (+0.02);
			} else {
				var fines_t_1 = (+avgfines_time) - (+0.24);
				var fines_t_2 = (+avgfines_time) - (+0.01);
				var fines_t_3 = (+avgfines_time) + (+0.18);
				var fines_t_4 = (+avgfines_time) + (+0.07);
			}

			$('#fines_t_1').val(fines_t_1.toFixed(2));
			$('#fines_t_2').val(fines_t_2.toFixed(2));
			$('#fines_t_3').val(fines_t_3.toFixed(2));
			$('#fines_t_4').val(fines_t_4.toFixed(2));

			den_intial = randomNumberFromRange(0.1, 0.9);
			$('#den_intial').val(den_intial.toFixed(1));
			var denintial = $('#den_intial').val();

			var tmep = (+dencement) / (+density1);
			var den_final = (+tmep) + (+denintial);
			$('#den_final').val(den_final.toFixed(1));

			var p = density1;
			var x = 0.5;
			$('#v').val(v.toFixed(2));
			$('#x').val(x.toFixed(2));
			$('#p').val(p);

			var v_1 = $('#v').val();
			var x_1 = $('#x').val();
			var p_1 = $('#p').val();
			var mass = (+x_1) * (+v_1) * (+p_1);
			$('#mass').val(mass.toFixed(4));

			//sidhu
			var constantkp = $('#constant_k').val();
			var dencementp = $('#den_cement').val();
			var den_intialp = $('#den_intial').val();
			var den_finalp = $('#den_final').val();

			var cal1 = (+den_finalp) - (+den_intialp);
			var fncal = (+dencementp) / (+cal1);
			$('#density').val(fncal.toFixed(2));

			var x1 = $('#x').val();
			var v1 = $('#v').val();
			var p1 = $('#p').val();
			var mass = (+x1) * (+v1) * (+p1);
			$('#mass').val(mass.toFixed(4));

			var fines_t1 = $('#fines_t_1').val();
			var fines_t2 = $('#fines_t_2').val();
			var fines_t3 = $('#fines_t_3').val();
			var fines_t4 = $('#fines_t_4').val();

			var avgs = ((+fines_t1) + (+fines_t2) + (+fines_t3) + (+fines_t4)) / 4;
			$('#avg_fines_time').val(avgs.toFixed());
			var avg_finestime = $('#avg_fines_time').val();



			var r1 = (+constantkp) * Math.sqrt(avg_finestime) * (+0.354);
			var final_Ans = (+r1) / (+0.5);
			$('#ss_area').val(final_Ans.toFixed());




		}

		$('#chk_fines').change(function() {
			if (this.checked) {

				fines_auto();

			} else {
				$('#fbs_w1').val(null);
				$('#fbs_w2').val(null);
				$('#fbs_m1').val(null);
				$('#fbs_m2').val(null);
				$('#fbs_p1').val(null);
				$('#fbs_p2').val(null);
				$('#avg_fbs').val(null);
				$('#den_date_test').val(null);
				$('#fine_humidity').val(null);
				$('#fine_temp').val(null);
				$('#constant_k').val(null);
				$('#den_cement').val(null);
				$('#den_final').val(null);
				$('#den_intial').val(null);
				$('#mass').val(null);
				$('#x').val(null);
				$('#v').val(null);
				$('#p').val(null);
				$('#ss_area').val(null);

				$('#ss_sample').val(null);
				$('#gs_sample').val(null);
				$('#ps_bed').val(null);
				$('#fs_e3').val(null);
				$('#tts_sample').val(null);
				$('#por_sample_bed').val(null);
				$('#sample_e3').val(null);
				$('#tt1').val(null);
				$('#fines_t_1').val(null);
				$('#fines_t_2').val(null);
				$('#fines_t_3').val(null);
				$('#fines_t_4').val(null);
				$('#avg_fines_time').val(null);
				$('#dens').css("background-color", "white");
			}
		});

		$('#avg_fbs').change(function() {
			$('#txtfbs').css("background-color", "var(--primary)");
			fbs_temp = randomNumberFromRange(26.0, 28.0);
			$('#fbs_temp').val(fbs_temp.toFixed(1));
			fbs_humidity = randomNumberFromRange(65.0, 69.0);
			$('#fbs_humidity').val(fbs_humidity.toFixed(1));

			fbsw1 = randomNumberFromRange(100, 100).toFixed(2);
			fbsw2 = randomNumberFromRange(100, 100).toFixed(2);
			$('#fbs_w1').val(fbsw1);
			$('#fbs_w2').val(fbsw2);
			var fbs_w1 = $('#fbs_w1').val();
			var fbs_w2 = $('#fbs_w2').val();
			var avg_fbs = $('#avg_fbs').val();

			fbsp1 = (+avg_fbs) + randomNumberFromRange(-0.10, 0.10);
			$('#fbs_p1').val(fbsp1.toFixed(2));
			var fbs_p1 = $('#fbs_p1').val();
			fbsp2 = ((+avg_fbs) * (+2)) - (+fbsp1);
			$('#fbs_p2').val(fbsp2.toFixed(2));
			var fbs_p2 = $('#fbs_p2').val();

			var m1 = (+fbs_w1) * (+fbs_p1);
			var m2 = (+fbs_w2) * (+fbs_p2);

			var ans1 = (+m1) / 100;
			var ans2 = (+m2) / 100;
			$('#fbs_m1').val(ans1.toFixed(2));
			$('#fbs_m2').val(ans2.toFixed(2));

			//SIDHU
			var f_bsw1 = $('#fbs_w1').val();
			var f_bsw2 = $('#fbs_w2').val();

			var f_bsm1 = $('#fbs_m1').val();
			var f_bsm2 = $('#fbs_m2').val();

			var cal1 = (+100) * (+f_bsm1);
			var cal2 = (+100) * (+f_bsm2);

			var anss1 = (+cal1) / (+f_bsw1);
			var anss2 = (+cal2) / (+f_bsw2);

			$('#fbs_p1').val(anss1.toFixed(2));
			$('#fbs_p2').val(anss2.toFixed(2));

			var f_bsp1 = $('#fbs_p1').val();
			var f_bsp2 = $('#fbs_p2').val();

			var avg = ((+f_bsp1) + (+f_bsp2)) / 2;
			$('#avg_fbs').val(avg.toFixed(1));

		});


		$('#fbs_w1,#fbs_w2,#fbs_m1,#fbs_m2').change(function() {
			var f_bsw1 = $('#fbs_w1').val();
			var f_bsw2 = $('#fbs_w2').val();

			var f_bsm1 = $('#fbs_m1').val();
			var f_bsm2 = $('#fbs_m2').val();

			var cal1 = (+100) * (+f_bsm1);
			var cal2 = (+100) * (+f_bsm2);

			var anss1 = (+cal1) / (+f_bsw1);
			var anss2 = (+cal2) / (+f_bsw2);

			$('#fbs_p1').val(anss1.toFixed(2));
			$('#fbs_p2').val(anss2.toFixed(2));

			var f_bsp1 = $('#fbs_p1').val();
			var f_bsp2 = $('#fbs_p2').val();

			var avg = ((+f_bsp1) + (+f_bsp2)) / 2;
			$('#avg_fbs').val(avg.toFixed(1));

		});


		$('#ss_area,#density').change(function() {
			$('#dens').css("background-color", "var(--primary)");
			if ($("#chk_fines").is(':checked')) {


				var constant_k = 62.06;

				$('#constant_k').val(constant_k.toFixed(2));

				var den_cement = randomNumberFromRange(55.0000, 60.0000).toFixed(4);
				$('#den_cement').val(den_cement);
				var dencement = $('#den_cement').val();
				var constantk = $('#constant_k').val();




				var v = 1.85;





				var ssarea = $('#ss_area').val();
				var density1 = $('#density').val();


				var formul = (+1) - (+e);
				var ans = (+ssarea) * (+formul);
				var ans2 = (+constantk) * (+roote3);
				var fin = (+ans) / (+ans2);
				var avg_fines_time = (+fin) * (+fin);
				$('#avg_fines_time').val(avg_fines_time.toFixed(2));
				var avgfines_time = $('#avg_fines_time').val();




				var t = randomNumberFromRange(0, 50).toFixed();
				if (t % 2 == 0) {
					var fines_t_1 = (+avgfines_time) + (+0.05);
					var fines_t_2 = (+avgfines_time) + (+0.15);
					var fines_t_3 = (+avgfines_time) - (+0.18);
					var fines_t_4 = (+avgfines_time) - (+0.02);
				} else {
					var fines_t_1 = (+avgfines_time) - (+0.24);
					var fines_t_2 = (+avgfines_time) - (+0.01);
					var fines_t_3 = (+avgfines_time) + (+0.18);
					var fines_t_4 = (+avgfines_time) + (+0.07);
				}

				$('#fines_t_1').val(fines_t_1.toFixed(2));
				$('#fines_t_2').val(fines_t_2.toFixed(2));
				$('#fines_t_3').val(fines_t_3.toFixed(2));
				$('#fines_t_4').val(fines_t_4.toFixed(2));

				den_intial = randomNumberFromRange(0.1, 0.9);
				$('#den_intial').val(den_intial.toFixed(1));
				var denintial = $('#den_intial').val();

				var tmep = (+dencement) / (+density1);
				var den_final = (+tmep) + (+denintial);
				$('#den_final').val(den_final.toFixed(1));

				var p = density1;
				var x = 0.5;
				$('#v').val(v.toFixed(2));
				$('#x').val(x.toFixed(2));
				$('#p').val(p);

				var v_1 = $('#v').val();
				var x_1 = $('#x').val();
				var p_1 = $('#p').val();
				var mass = (+x_1) * (+v_1) * (+p_1);
				$('#mass').val(mass.toFixed(4));


			}
		});
		$('#v,#x,#p').change(function() {

			var v_1 = $('#v').val();
			var x_1 = $('#x').val();
			var p_1 = $('#p').val();
			var mass = (+x_1) * (+v_1) * (+p_1);
			$('#mass').val(mass.toFixed(4));
		});

		$('#constant_k').change(function() {
			$('#dens').css("background-color", "var(--primary)");

			var type_of_cement = $('#type_of_cement').val();
			var den_cement = randomNumberFromRange(55.0000, 60.0000).toFixed(4);
			$('#den_cement').val(den_cement);
			var dencement = $('#den_cement').val();
			var constantk = $('#constant_k').val();


			var grades = $('#cement_grade').val();

			ss_area = randomNumberFromRange(330, 410);
			var density = randomNumberFromRange(3.01, 3.15);
			var v = 1.85;




			$('#ss_area').val(ss_area.toFixed(0));
			$('#density').val(density.toFixed(2));
			var ssarea = $('#ss_area').val();
			var density1 = $('#density').val();


			var formul = (+1) - (+e);
			var ans = (+ssarea) * (+formul);
			var ans2 = (+constantk) * (+roote3);
			var fin = (+ans) / (+ans2);
			var avg_fines_time = (+fin) * (+fin);
			$('#avg_fines_time').val(avg_fines_time.toFixed(2));
			var avgfines_time = $('#avg_fines_time').val();


			var t = randomNumberFromRange(0, 50).toFixed();
			if (t % 2 == 0) {
				var fines_t_1 = (+avgfines_time) + (+0.05);
				var fines_t_2 = (+avgfines_time) + (+0.15);
				var fines_t_3 = (+avgfines_time) - (+0.18);
				var fines_t_4 = (+avgfines_time) - (+0.02);
			} else {
				var fines_t_1 = (+avgfines_time) - (+0.24);
				var fines_t_2 = (+avgfines_time) - (+0.01);
				var fines_t_3 = (+avgfines_time) + (+0.18);
				var fines_t_4 = (+avgfines_time) + (+0.07);
			}

			$('#fines_t_1').val(fines_t_1.toFixed(2));
			$('#fines_t_2').val(fines_t_2.toFixed(2));
			$('#fines_t_3').val(fines_t_3.toFixed(2));
			$('#fines_t_4').val(fines_t_4.toFixed(2));

			den_intial = randomNumberFromRange(0.1, 0.9);
			$('#den_intial').val(den_intial.toFixed(1));
			var denintial = $('#den_intial').val();

			var tmep = (+dencement) / (+density1);
			var den_final = (+tmep) + (+denintial);
			$('#den_final').val(den_final.toFixed(1));

			var p = density1;
			var x = 0.5;
			$('#v').val(v.toFixed(2));
			$('#x').val(x.toFixed(2));
			$('#p').val(p);

			var v_1 = $('#v').val();
			var x_1 = $('#x').val();
			var p_1 = $('#p').val();
			var mass = (+x_1) * (+v_1) * (+p_1);
			$('#mass').val(mass.toFixed(4));

			//sidhu
			var constantkp = $('#constant_k').val();
			var dencementp = $('#den_cement').val();
			var den_intialp = $('#den_intial').val();
			var den_finalp = $('#den_final').val();

			var cal1 = (+den_finalp) - (+den_intialp);
			var fncal = (+dencementp) / (+cal1);
			$('#density').val(fncal.toFixed(2));

			var x1 = $('#x').val();
			var v1 = $('#v').val();
			var p1 = $('#p').val();
			var mass = (+x1) * (+v1) * (+p1);
			$('#mass').val(mass.toFixed(4));

			var fines_t1 = $('#fines_t_1').val();
			var fines_t2 = $('#fines_t_2').val();
			var fines_t3 = $('#fines_t_3').val();
			var fines_t4 = $('#fines_t_4').val();

			var avgs = ((+fines_t1) + (+fines_t2) + (+fines_t3) + (+fines_t4)) / 4;
			$('#avg_fines_time').val(avgs.toFixed());

			var r1 = (+constantkp) * Math.sqrt(avg_finestime) * (+0.354);
			var final_Ans = (+r1) / (+0.5);
			$('#ss_area').val(final_Ans.toFixed());

		});



		$('#avg_fines_time').change(function() {
			var type_of_cement = $('#type_of_cement').val();
			if ($("#chk_fines").is(':checked')) {

				ss_sample = randomNumberFromRange(330, 410);
				gs_sample = randomNumberFromRange(2.10, 2.90);
				ps_bed = randomNumberFromRange(0.1, 0.9);
				fs_e3 = randomNumberFromRange(0.100, 0.999);
				tts_sample = randomNumberFromRange(10, 90);
				por_sample_bed = randomNumberFromRange(0.1, 0.9);
				sample_e3 = randomNumberFromRange(0.100, 0.999);
				tt1 = randomNumberFromRange(50.1, 90.9);

				//ss_sample,gs_sample,ps_bed,fs_e3,tts_sample,por_sample_bed,sample_e3,tt1
				$('#ss_sample').val(ss_sample.toFixed(0));
				$('#gs_sample').val(gs_sample.toFixed(2));
				$('#ps_bed').val(ps_bed.toFixed(1));
				$('#fs_e3').val(fs_e3.toFixed(3));
				$('#tts_sample').val(tts_sample.toFixed(0));
				$('#por_sample_bed').val(por_sample_bed.toFixed(1));
				$('#sample_e3').val(sample_e3.toFixed(3));
				$('#tt1').val(tt1.toFixed(1));

				var dencement = $('#den_cement').val();
				var constantk = $('#constant_k').val();




				var v = 1.85;


				var ssarea = $('#ss_area').val();
				var density1 = $('#density').val();


				var avgfines_time = $('#avg_fines_time').val();


				var t = randomNumberFromRange(0, 50).toFixed();
				if (t % 2 == 0) {
					var fines_t_1 = (+avgfines_time) + (+0.05);
					var fines_t_2 = (+avgfines_time) + (+0.15);
					var fines_t_3 = (+avgfines_time) - (+0.18);
					var fines_t_4 = (+avgfines_time) - (+0.02);
				} else {
					var fines_t_1 = (+avgfines_time) - (+0.24);
					var fines_t_2 = (+avgfines_time) - (+0.01);
					var fines_t_3 = (+avgfines_time) + (+0.18);
					var fines_t_4 = (+avgfines_time) + (+0.07);
				}

				$('#fines_t_1').val(fines_t_1.toFixed(2));
				$('#fines_t_2').val(fines_t_2.toFixed(2));
				$('#fines_t_3').val(fines_t_3.toFixed(2));
				$('#fines_t_4').val(fines_t_4.toFixed(2));

				den_intial = randomNumberFromRange(0.1, 0.9);
				$('#den_intial').val(den_intial.toFixed(1));
				var denintial = $('#den_intial').val();

				var tmep = (+dencement) / (+density1);
				var den_final = (+tmep) + (+denintial);
				$('#den_final').val(den_final.toFixed(1));

				var p = density1;
				var x = 0.5;
				$('#v').val(v.toFixed(2));
				$('#x').val(x.toFixed(2));
				$('#p').val(p);

				var v_1 = $('#v').val();
				var x_1 = $('#x').val();
				var p_1 = $('#p').val();
				var mass = (+x_1) * (+v_1) * (+p_1);
				$('#mass').val(mass.toFixed(4));

				//sidhu
				var constantkp = $('#constant_k').val();
				var dencementp = $('#den_cement').val();
				var den_intialp = $('#den_intial').val();
				var den_finalp = $('#den_final').val();

				var cal1 = (+den_finalp) - (+den_intialp);
				var fncal = (+dencementp) / (+cal1);
				$('#density').val(fncal.toFixed(2));

				var x1 = $('#x').val();
				var v1 = $('#v').val();
				var p1 = $('#p').val();
				var mass = (+x1) * (+v1) * (+p1);
				$('#mass').val(mass.toFixed(4));

				var fines_t1 = $('#fines_t_1').val();
				var fines_t2 = $('#fines_t_2').val();
				var fines_t3 = $('#fines_t_3').val();
				var fines_t4 = $('#fines_t_4').val();

				var avgs = ((+fines_t1) + (+fines_t2) + (+fines_t3) + (+fines_t4)) / 4;
				$('#avg_fines_time').val(avgs.toFixed());

				var r1 = (+constantkp) * Math.sqrt(avg_finestime) * (+0.354);
				var final_Ans = (+r1) / (+0.5);
				$('#ss_area').val(final_Ans.toFixed());
			}
		});

		$('#fines_t_1,#fines_t_2,#fines_t_3,#fines_t_4').change(function() {
			var constantkp = $('#constant_k').val();
			var fines_t1 = $('#fines_t_1').val();
			var fines_t2 = $('#fines_t_2').val();
			var fines_t3 = $('#fines_t_3').val();
			var fines_t4 = $('#fines_t_4').val();
			var type_of_cement = $('#type_of_cement').val();
			var avgs = ((+fines_t1) + (+fines_t2) + (+fines_t3) + (+fines_t4)) / 4;
			$('#avg_fines_time').val(avgs.toFixed());

			var r1 = (+constantkp) * Math.sqrt(avg_finestime) * (+0.354);
			var final_Ans = (+r1) / (+0.5);
			$('#ss_area').val(final_Ans.toFixed());

		});


		$('#den_intial').change(function() {
			$('#dens').css("background-color", "var(--primary)");
			//sidhu
			var constantkp = $('#constant_k').val();
			var dencementp = $('#den_cement').val();
			var den_intialp = $('#den_intial').val();
			var den_finalp = $('#den_final').val();
			var type_of_cement = $('#type_of_cement').val();
			var cal1 = (+den_finalp) - (+den_intialp);
			var fncal = (+dencementp) / (+cal1);
			$('#density').val(fncal.toFixed(2));

			var x1 = $('#x').val();
			var v1 = $('#v').val();
			var p1 = $('#p').val();
			var mass = (+x1) * (+v1) * (+p1);
			$('#mass').val(mass.toFixed(4));

			var fines_t1 = $('#fines_t_1').val();
			var fines_t2 = $('#fines_t_2').val();
			var fines_t3 = $('#fines_t_3').val();
			var fines_t4 = $('#fines_t_4').val();

			var avgs = ((+fines_t1) + (+fines_t2) + (+fines_t3) + (+fines_t4)) / 4;
			$('#avg_fines_time').val(avgs.toFixed());

			var r1 = (+constantkp) * Math.sqrt(avg_finestime) * (+0.354);
			var final_Ans = (+r1) / (+0.5);
			$('#ss_area').val(final_Ans.toFixed());

		});


		$('#den_final').change(function() {
			$('#dens').css("background-color", "var(--primary)");
			//sidhu
			var constantkp = $('#constant_k').val();
			var dencementp = $('#den_cement').val();
			var den_intialp = $('#den_intial').val();
			var den_finalp = $('#den_final').val();
			var type_of_cement = $('#type_of_cement').val();
			var cal1 = (+den_finalp) - (+den_intialp);
			var fncal = (+dencementp) / (+cal1);
			$('#density').val(fncal.toFixed(2));

			var x1 = $('#x').val();
			var v1 = $('#v').val();
			var p1 = $('#p').val();
			var mass = (+x1) * (+v1) * (+p1);
			$('#mass').val(mass.toFixed(4));

			var fines_t1 = $('#fines_t_1').val();
			var fines_t2 = $('#fines_t_2').val();
			var fines_t3 = $('#fines_t_3').val();
			var fines_t4 = $('#fines_t_4').val();

			var avgs = ((+fines_t1) + (+fines_t2) + (+fines_t3) + (+fines_t4)) / 4;
			$('#avg_fines_time').val(avgs.toFixed());

			var r1 = (+constantkp) * Math.sqrt(avg_finestime) * (+0.354);
			var final_Ans = (+r1) / (+0.5);
			$('#ss_area').val(final_Ans.toFixed());

		});


		var com_date_test;
		var com_temp;
		var com_humidity;
		var weight_of_cement;
		var weight_of_water;
		var weight_of_sand;
		var sp_1;
		var sp_2;
		var sp_3;
		var caste_date1;
		var caste_date2;
		var caste_date3;
		var caste_time1;
		var caste_time2;
		var caste_time3;
		var test_date1;
		var test_date2;
		var test_date3;
		var test_time1;
		var test_time2;
		var test_time3;
		var day_1;
		var day_2;
		var day_3;
		var woc_1;
		var woc_2;
		var woc_3;
		var avg_com_1;
		var avg_com_2;
		var avg_com_3;
		var l1;
		var l2;
		var l3;
		var l4;
		var l5;
		var l6;
		var l7;
		var l8;
		var l9;
		var b1;
		var b2;
		var b3;
		var b4;
		var b5;
		var b6;
		var b7;
		var b8;
		var b9;
		var h1;
		var h2;
		var h3;
		var h4;
		var h5;
		var h6;
		var h7;
		var h8;
		var h9;
		var area_1;
		var area_2;
		var area_3;
		var area_4;
		var area_5;
		var area_6;
		var area_7;
		var area_8;
		var area_9;
		var load_1;
		var load_2;
		var load_3;
		var load_4;
		var load_5;
		var load_6;
		var load_7;
		var load_8;
		var load_9;
		var com_1;
		var com_2;
		var com_3;
		var com_4;
		var com_5;
		var com_6;
		var com_7;
		var com_8;
		var com_9;

		function com_auto() {
			$('#comp').css("background-color", "var(--primary)");
			com_temp = randomNumberFromRange(26.0, 28.0);
			$('#com_temp').val(com_temp.toFixed(1));
			com_humidity = randomNumberFromRange(65.0, 69.0);
			$('#com_humidity').val(com_humidity.toFixed());
			var top = 1;
			var date_input = document.getElementById("con_date_test").value.split('/');
			//var date_input = $('#rec_sample_date').val().split('/');			
			var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
			var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			if (mm <= 9)
				mm = '0' + mm;
			if (dd <= 9)
				dd = '0' + dd;
			var someFormattedDate = dd + '/' + mm + '/' + y;
			document.getElementById('com_date_test').value = someFormattedDate;



			weight_of_cement = 200;
			$('#weight_of_cement').val(weight_of_cement.toFixed(0));

			weight_of_sand = 600;
			$('#weight_of_sand').val(weight_of_sand.toFixed(0));


			//$('#final_consistency').val('28');
			var consis = $('#final_consistency').val();
			var temp = ((parseFloat(consis) / 4) + 3);
			weight_of_water = (parseFloat(temp) * 8);
			$('#weight_of_water').val(weight_of_water.toFixed(1));

			com_3_day();
			$("#chk_chk1").prop("checked", true);
			$("#chk_chk2").prop("checked", true);
			$("#chk_chk3").prop("checked", true);
			$("#chk_chk4").prop("checked", true);
			com_7_day();
			com_28_day();
			com_1_day();
		}


		$('#chk_com').change(function() {
			if (this.checked) {
				com_auto();

			} else {
				$('#comp').css("background-color", "var(--primary)");
				$('#com_temp').val(null);
				$('#com_temp1').val(null);
				$('#com_temp2').val(null);
				$('#com_temp3').val(null);
				$('#com_date_test').val(null);
				$('#com_humidity').val(null);
				$('#com_humidity1').val(null);
				$('#com_humidity2').val(null);
				$('#com_humidity3').val(null);
				$('#weight_of_cement').val(null);
				$('#weight_of_sand').val(null);
				$('#weight_of_water').val(null);
				$('#caste_date1').val(null);
				$('#caste_time4').val(null);
				$('#test_time4').val(null);
				$('#woc_4').val(null);
				$('#test_date1').val(null);
				$('#sp_1').val(null);
				$('#caste_time1').val(null);
				$('#test_time1').val(null);
				$('#woc_1').val(null);
				$('#day_1').val(null);
				$('#avg_com_1').val(null);
				$('#com_1').val(null);
				$('#com_2').val(null);
				$('#com_3').val(null);
				$('#l1').val(null);
				$('#l2').val(null);
				$('#l3').val(null);
				$('#b1').val(null);
				$('#b2').val(null);
				$('#b3').val(null);
				$('#h1').val(null);
				$('#h2').val(null);
				$('#h3').val(null);
				$('#area_1').val(null);
				$('#area_2').val(null);
				$('#area_3').val(null);
				$('#load_1').val(null);
				$('#load_2').val(null);
				$('#load_3').val(null);
				$('#caste_date2').val(null);
				$('#caste_time2').val(null);
				$('#test_date2').val(null);
				$('#test_time2').val(null);
				$('#sp_2').val(null);
				$('#day_2').val(null);
				$('#woc_2').val(null);
				$('#avg_com_2').val(null);
				$('#com_4').val(null);
				$('#com_5').val(null);
				$('#com_6').val(null);
				$('#l4').val(null);
				$('#l5').val(null);
				$('#l6').val(null);
				$('#b4').val(null);
				$('#b5').val(null);
				$('#b6').val(null);
				$('#h4').val(null);
				$('#h5').val(null);
				$('#h6').val(null);
				$('#area_4').val(null);
				$('#area_5').val(null);
				$('#area_6').val(null);
				$('#load_4').val(null);
				$('#load_5').val(null);
				$('#load_6').val(null);
				$('#caste_date3').val(null);
				$('#caste_time3').val(null);
				$('#test_date3').val(null);
				$('#test_time3').val(null);
				$('#sp_3').val(null);
				$('#day_3').val(null);
				$('#woc_3').val(null);
				$('#avg_com_3').val(null);
				$('#com_7').val(null);
				$('#com_8').val(null);
				$('#com_9').val(null);
				$('#l7').val(null);
				$('#l8').val(null);
				$('#l9').val(null);
				$('#b7').val(null);
				$('#b8').val(null);
				$('#b9').val(null);
				$('#h7').val(null);
				$('#h8').val(null);
				$('#h9').val(null);
				$('#area_7').val(null);
				$('#area_8').val(null);
				$('#area_9').val(null);
				$('#load_7').val(null);
				$('#load_8').val(null);
				$('#load_9').val(null);
				$('#caste_date4').val(null);
				$('#test_date4').val(null);
				$('#sp_4').val(null);
				$('#day_4').val(null);
				$('#avg_com_4').val(null);
				$('#com_10').val(null);
				$('#com_11').val(null);
				$('#com_12').val(null);
				$('#l10').val(null);
				$('#l11').val(null);
				$('#l12').val(null);
				$('#b10').val(null);
				$('#b11').val(null);
				$('#b12').val(null);
				$('#h10').val(null);
				$('#h11').val(null);
				$('#h12').val(null);
				$('#area_10').val(null);
				$('#area_11').val(null);
				$('#area_12').val(null);
				$('#load_10').val(null);
				$('#load_11').val(null);
				$('#load_12').val(null);
			}
		});



		function com_3_day() {
			$('#comp').css("background-color", "var(--primary)");
			if ($("#chk_com").is(':checked')) {
				com_temp = randomNumberFromRange(26.0, 28.0);
				$('#com_temp').val(com_temp.toFixed(1));
				com_humidity = randomNumberFromRange(65.0, 69.0);
				$('#com_humidity').val(com_humidity.toFixed());
				var grades = $('#cement_grade').val();
				var date_of_casting = $('#com_date_test').val();
				$('#caste_date1').val(date_of_casting);
				day_1 = 7;
				l1 = 70.6;
				l2 = 70.6;
				l3 = 70.6;
				b1 = 70.6;
				b2 = 70.6;
				b3 = 70.6;
				h1 = 70.6;
				h2 = 70.6;
				h3 = 70.6;

				var woc_1 = randomNumberFromRange(8.500, 8.900);
				$('#woc_1').val(woc_1.toFixed(3));
				$('#caste_time1').val('12:00');
				$('#test_time1').val('12:00');

				sp_1 = 22;
				//avg_com_1 = randomNumberFromRange(17.00, 20.00);
				avg_com_1 = randomNumberFromRange(25.00, 30.00);

				$('#sp_1').val(sp_1);
				$('#day_1').val(day_1);
				$('#avg_com_1').val(avg_com_1.toFixed());
				var avg_com1 = $('#avg_com_1').val();
				com_1 = (+avg_com1) + 0.34;
				com_2 = (+avg_com1) - 0.56;
				com_3 = (+avg_com1) + 0.22;
				$('#com_1').val(com_1.toFixed(2));
				$('#com_2').val(com_2.toFixed(2));
				$('#com_3').val(com_3.toFixed(2));

				var com1 = $('#com_1').val();
				var com2 = $('#com_2').val();
				var com3 = $('#com_3').val();

				$('#l1').val(l1.toFixed(1));
				$('#l2').val(l2.toFixed(1));
				$('#l3').val(l3.toFixed(1));
				$('#b1').val(b1.toFixed(1));
				$('#b2').val(b2.toFixed(1));
				$('#b3').val(b3.toFixed(1));
				$('#h1').val(h1.toFixed(1));
				$('#h2').val(h2.toFixed(1));
				$('#h3').val(h3.toFixed(1));

				var l_1 = $('#l1').val();
				var l_2 = $('#l2').val();
				var l_3 = $('#l3').val();

				var b_1 = $('#b1').val();
				var b_2 = $('#b2').val();
				var b_3 = $('#b3').val();

				var h_1 = $('#h1').val();
				var h_2 = $('#h2').val();
				var h_3 = $('#h3').val();

				area_1 = (+l_1) * (+b_1);
				area_2 = (+l_2) * (+b_2);
				area_3 = (+l_3) * (+b_3);

				$('#area_1').val(area_1.toFixed(2));
				$('#area_2').val(area_2.toFixed(2));
				$('#area_3').val(area_3.toFixed(2));

				var area1 = $('#area_1').val();
				var area2 = $('#area_2').val();
				var area3 = $('#area_3').val();

				load_1 = ((+area1) * (+com1)) / 1000;
				load_2 = ((+area2) * (+com2)) / 1000;
				load_3 = ((+area3) * (+com3)) / 1000;

				$('#load_1').val(load_1.toFixed(1));
				$('#load_2').val(load_2.toFixed(1));
				$('#load_3').val(load_3.toFixed(1));


				var load1 = $('#load_1').val();
				var load2 = $('#load_2').val();
				var load3 = $('#load_3').val();



				var coms1 = (1000 * (+load1)) / (+area1);
				var coms2 = (1000 * (+load2)) / (+area2);
				var coms3 = (1000 * (+load3)) / (+area3);
				$('#com_1').val(coms1.toFixed(2));
				$('#com_2').val(coms2.toFixed(2));
				$('#com_3').val(coms3.toFixed(2));
				var co1 = $('#com_1').val();
				var co2 = $('#com_2').val();
				var co3 = $('#com_3').val();

				var avgs = ((+co1) + (+co2) + (+co3)) / 3;
				$('#avg_com_1').val(avgs.toFixed());





				var top = parseInt(day_1);
				var date_input = document.getElementById("com_date_test").value.split('/');
				var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
				var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
				var dd = newdate.getDate();
				var mm = newdate.getMonth() + 1;
				var y = newdate.getFullYear();
				if (mm <= 9)
					mm = '0' + mm;
				if (dd <= 9)
					dd = '0' + dd;
				var someFormattedDate = dd + '/' + mm + '/' + y;
				document.getElementById('test_date1').value = someFormattedDate;
			}

		}

		$('#chk_chk1').change(function() {
			if (this.checked) {
				com_3_day();
			} else {
				$('#com_temp').val(null);
				$('#com_humidity').val(null);
				$('#caste_date1').val(null);
				$('#test_date1').val(null);
				$('#sp_1').val(null);
				$('#caste_time1').val(null);
				$('#test_time1').val(null);
				$('#woc_1').val(null);
				$('#day_1').val(null);
				$('#avg_com_1').val(null);
				$('#com_1').val(null);
				$('#com_2').val(null);
				$('#com_3').val(null);
				$('#l1').val(null);
				$('#l2').val(null);
				$('#l3').val(null);
				$('#b1').val(null);
				$('#b2').val(null);
				$('#b3').val(null);
				$('#h1').val(null);
				$('#h2').val(null);
				$('#h3').val(null);
				$('#area_1').val(null);
				$('#area_2').val(null);
				$('#area_3').val(null);
				$('#load_1').val(null);
				$('#load_2').val(null);
				$('#load_3').val(null);
			}
		});

		function com_7_day() {
			$('#comp').css("background-color", "var(--primary)");
			if ($("#chk_com").is(':checked')) {
				com_temp1 = randomNumberFromRange(26.0, 28.0);
				$('#com_temp1').val(com_temp1.toFixed(1));
				com_humidity1 = randomNumberFromRange(65.0, 69.0);
				$('#com_humidity1').val(com_humidity1.toFixed());
				var grades = $('#cement_grade').val();
				var date_of_casting = $('#com_date_test').val();
				$('#caste_date2').val(date_of_casting);
				day_2 = 7;
				l4 = 70.6;
				l5 = 70.6;
				l6 = 70.6;
				b4 = 70.6;
				b5 = 70.6;
				b6 = 70.6;
				h4 = 70.6;
				h5 = 70.6;
				h6 = 70.6;

				$('#caste_time2').val('12:00');
				$('#test_time2').val('12:00');
				var woc_2 = randomNumberFromRange(8.500, 8.900);
				$('#woc_2').val(woc_2.toFixed(3));

				sp_2 = 22;
				var avg_com_1 = $('#avg_com_1').val();
				avg_com_2 = (+avg_com_1) + (+randomNumberFromRange(-2, -3));


				$('#sp_2').val(sp_2);
				$('#day_2').val(day_2);
				$('#avg_com_2').val(avg_com_2.toFixed());
				var avg_com2 = $('#avg_com_2').val();
				com_4 = (+avg_com2) + (+0.32);
				com_5 = (+avg_com2) - (+0.78);
				com_6 = (+avg_com2) + (+0.46);
				$('#com_4').val(com_4.toFixed(2));
				$('#com_5').val(com_5.toFixed(2));
				$('#com_6').val(com_6.toFixed(2));

				var com4 = $('#com_4').val();
				var com5 = $('#com_5').val();
				var com6 = $('#com_6').val();

				$('#l4').val(l4.toFixed(1));
				$('#l5').val(l5.toFixed(1));
				$('#l6').val(l6.toFixed(1));
				$('#b4').val(b4.toFixed(1));
				$('#b5').val(b5.toFixed(1));
				$('#b6').val(b6.toFixed(1));
				$('#h4').val(h4.toFixed(1));
				$('#h5').val(h5.toFixed(1));
				$('#h6').val(h6.toFixed(1));

				var l_4 = $('#l4').val();
				var l_5 = $('#l5').val();
				var l_6 = $('#l6').val();

				var b_4 = $('#b4').val();
				var b_5 = $('#b5').val();
				var b_6 = $('#b6').val();

				var h_4 = $('#h4').val();
				var h_5 = $('#h5').val();
				var h_6 = $('#h6').val();

				area_4 = (+l_4) * (+b_4);
				area_5 = (+l_5) * (+b_5);
				area_6 = (+l_6) * (+b_6);

				$('#area_4').val(area_4.toFixed(2));
				$('#area_5').val(area_5.toFixed(2));
				$('#area_6').val(area_6.toFixed(2));

				var area4 = $('#area_4').val();
				var area5 = $('#area_5').val();
				var area6 = $('#area_6').val();

				load_4 = ((+area4) * (+com4)) / 1000;
				load_5 = ((+area5) * (+com5)) / 1000;
				load_6 = ((+area6) * (+com6)) / 1000;

				$('#load_4').val(load_4.toFixed(1));
				$('#load_5').val(load_5.toFixed(1));
				$('#load_6').val(load_6.toFixed(1));

				var load4 = $('#load_4').val();
				var load5 = $('#load_5').val();
				var load6 = $('#load_6').val();



				var coms4 = (1000 * (+load4)) / (+area4);
				var coms5 = (1000 * (+load5)) / (+area5);
				var coms6 = (1000 * (+load6)) / (+area6);
				$('#com_4').val(coms4.toFixed(2));
				$('#com_5').val(coms5.toFixed(2));
				$('#com_6').val(coms6.toFixed(2));
				var co4 = $('#com_4').val();
				var co5 = $('#com_5').val();
				var co6 = $('#com_6').val();

				var avgs1 = ((+co4) + (+co5) + (+co6)) / 3;
				$('#avg_com_2').val(avgs1.toFixed());

				var top = parseInt(day_2);
				var date_input = document.getElementById("com_date_test").value.split('/');
				var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
				var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
				var dd = newdate.getDate();
				var mm = newdate.getMonth() + 1;
				var y = newdate.getFullYear();
				if (mm <= 9)
					mm = '0' + mm;
				if (dd <= 9)
					dd = '0' + dd;
				var someFormattedDate = dd + '/' + mm + '/' + y;
				document.getElementById('test_date2').value = someFormattedDate;
			}
		}

		$('#chk_chk2').change(function() {
			if (this.checked) {

				com_7_day();


			} else {
				$('#com_temp1').val(null);
				$('#com_humidity1').val(null);
				$('#caste_date2').val(null);
				$('#caste_time2').val(null);
				$('#test_date2').val(null);
				$('#test_time2').val(null);
				$('#sp_2').val(null);
				$('#day_2').val(null);
				$('#woc_2').val(null);
				$('#avg_com_2').val(null);
				$('#com_4').val(null);
				$('#com_5').val(null);
				$('#com_6').val(null);
				$('#l4').val(null);
				$('#l5').val(null);
				$('#l6').val(null);
				$('#b4').val(null);
				$('#b5').val(null);
				$('#b6').val(null);
				$('#h4').val(null);
				$('#h5').val(null);
				$('#h6').val(null);
				$('#area_4').val(null);
				$('#area_5').val(null);
				$('#area_6').val(null);
				$('#load_4').val(null);
				$('#load_5').val(null);
				$('#load_6').val(null);
			}
		});

		function com_28_day() {
			$('#comp').css("background-color", "var(--primary)");
			if ($("#chk_com").is(':checked')) {
				com_temp2 = randomNumberFromRange(26.0, 28.0);
				$('#com_temp2').val(com_temp2.toFixed(1));
				com_humidity2 = randomNumberFromRange(65.0, 69.0);
				$('#com_humidity2').val(com_humidity2.toFixed());
				var grades = $('#cement_grade').val();
				var date_of_casting = $('#com_date_test').val();
				$('#caste_date3').val(date_of_casting);
				day_3 = 28;
				l7 = 70.6;
				l8 = 70.6;
				l9 = 70.6;
				b7 = 70.6;
				b8 = 70.6;
				b9 = 70.6;
				h7 = 70.6;
				h8 = 70.6;
				h9 = 70.6;

				$('#caste_time3').val('12:00');
				$('#test_time3').val('12:00');
				var woc_3 = randomNumberFromRange(8.500, 8.900);
				$('#woc_3').val(woc_3.toFixed(3));

				sp_3 = 33;
				//avg_com_3 = randomNumberFromRange(35.00, 40.00);
				avg_com_3 = randomNumberFromRange(35.00, 42.00);



				$('#sp_3').val(sp_3);
				$('#day_3').val(day_3);
				$('#avg_com_3').val(avg_com_3.toFixed());
				var avg_com3 = $('#avg_com_3').val();
				com_7 = (+avg_com3) + (+0.32);
				com_8 = (+avg_com3) - (+0.78);
				com_9 = (+avg_com3) + (+0.46);
				$('#com_7').val(com_7.toFixed(2));
				$('#com_8').val(com_8.toFixed(2));
				$('#com_9').val(com_9.toFixed(2));

				var com7 = $('#com_7').val();
				var com8 = $('#com_8').val();
				var com9 = $('#com_9').val();

				$('#l7').val(l7.toFixed(1));
				$('#l8').val(l8.toFixed(1));
				$('#l9').val(l9.toFixed(1));
				$('#b7').val(b7.toFixed(1));
				$('#b8').val(b8.toFixed(1));
				$('#b9').val(b9.toFixed(1));
				$('#h7').val(h7.toFixed(1));
				$('#h8').val(h8.toFixed(1));
				$('#h9').val(h9.toFixed(1));

				var l_7 = $('#l7').val();
				var l_8 = $('#l8').val();
				var l_9 = $('#l9').val();

				var b_7 = $('#b7').val();
				var b_8 = $('#b8').val();
				var b_9 = $('#b9').val();

				var h_7 = $('#h7').val();
				var h_8 = $('#h8').val();
				var h_9 = $('#h9').val();

				area_7 = (+l_7) * (+b_7);
				area_8 = (+l_8) * (+b_8);
				area_9 = (+l_9) * (+b_9);

				$('#area_7').val(area_7.toFixed(2));
				$('#area_8').val(area_8.toFixed(2));
				$('#area_9').val(area_9.toFixed(2));

				var area7 = $('#area_7').val();
				var area8 = $('#area_8').val();
				var area9 = $('#area_9').val();

				load_7 = ((+area7) * (+com7)) / 1000;
				load_8 = ((+area8) * (+com8)) / 1000;
				load_9 = ((+area9) * (+com9)) / 1000;

				$('#load_7').val(load_7.toFixed(1));
				$('#load_8').val(load_8.toFixed(1));
				$('#load_9').val(load_9.toFixed(1));

				var load7 = $('#load_7').val();
				var load8 = $('#load_8').val();
				var load9 = $('#load_9').val();



				var coms7 = (1000 * (+load7)) / (+area7);
				var coms8 = (1000 * (+load8)) / (+area8);
				var coms9 = (1000 * (+load9)) / (+area9);
				$('#com_7').val(coms7.toFixed(2));
				$('#com_8').val(coms8.toFixed(2));
				$('#com_9').val(coms9.toFixed(2));
				var co7 = $('#com_7').val();
				var co8 = $('#com_8').val();
				var co9 = $('#com_9').val();

				var avgs2 = ((+co7) + (+co8) + (+co9)) / 3;
				$('#avg_com_3').val(avgs2.toFixed());

				var top = parseInt(day_3);
				var date_input = document.getElementById("com_date_test").value.split('/');
				var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
				var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
				var dd = newdate.getDate();
				var mm = newdate.getMonth() + 1;
				var y = newdate.getFullYear();
				if (mm <= 9)
					mm = '0' + mm;
				if (dd <= 9)
					dd = '0' + dd;
				var someFormattedDate = dd + '/' + mm + '/' + y;
				document.getElementById('test_date3').value = someFormattedDate;
			}
		}

		$('#chk_chk3').change(function() {
			if (this.checked) {
				com_28_day();
			} else {
				$('#com_temp2').val(null);
				$('#com_humidity2').val(null);
				$('#caste_date3').val(null);
				$('#caste_time3').val(null);
				$('#test_date3').val(null);
				$('#test_time3').val(null);
				$('#sp_3').val(null);
				$('#day_3').val(null);
				$('#woc_3').val(null);
				$('#avg_com_3').val(null);
				$('#com_7').val(null);
				$('#com_8').val(null);
				$('#com_9').val(null);
				$('#l7').val(null);
				$('#l8').val(null);
				$('#l9').val(null);
				$('#b7').val(null);
				$('#b8').val(null);
				$('#b9').val(null);
				$('#h7').val(null);
				$('#h8').val(null);
				$('#h9').val(null);
				$('#area_7').val(null);
				$('#area_8').val(null);
				$('#area_9').val(null);
				$('#load_7').val(null);
				$('#load_8').val(null);
				$('#load_9').val(null);
			}
		});

		function com_1_day() {
			$('#comp').css("background-color", "var(--primary)");
			if ($("#chk_com").is(':checked')) {
				com_temp3 = randomNumberFromRange(26.0, 28.0);
				$('#com_temp3').val(com_temp3.toFixed(1));
				com_humidity3 = randomNumberFromRange(65.0, 69.0);
				$('#com_humidity3').val(com_humidity3.toFixed());
				var grades = $('#cement_grade').val();
				var date_of_casting = $('#com_date_test').val();
				$('#caste_date4').val(date_of_casting);
				day_4 = 28;
				l10 = 70.6;
				l11 = 70.6;
				l12 = 70.6;
				b10 = 70.6;
				b11 = 70.6;
				b12 = 70.6;
				h10 = 70.6;
				h11 = 70.6;
				h12 = 70.6;

				$('#caste_time4').val('12:00');
				$('#test_time4').val('12:00');
				var woc_4 = randomNumberFromRange(8.500, 8.900);
				$('#woc_4').val(woc_4.toFixed(3));

				sp_4 = 33;
				var avg_com_3 = $('#avg_com_3').val();
				avg_com_4 = (+avg_com_3) + randomNumberFromRange(-1, -2);


				$('#sp_4').val(sp_4);
				$('#day_4').val(day_4);
				$('#avg_com_4').val(avg_com_4.toFixed());
				var avg_com4 = $('#avg_com_4').val();
				com_10 = (+avg_com4) + (+0.32);
				com_11 = (+avg_com4) - (+0.78);
				com_12 = (+avg_com4) + (+0.46);
				$('#com_10').val(com_10.toFixed(2));
				$('#com_11').val(com_11.toFixed(2));
				$('#com_12').val(com_12.toFixed(2));

				var com10 = $('#com_10').val();
				var com11 = $('#com_11').val();
				var com12 = $('#com_12').val();

				$('#l10').val(l10.toFixed(1));
				$('#l11').val(l11.toFixed(1));
				$('#l12').val(l12.toFixed(1));
				$('#b10').val(b10.toFixed(1));
				$('#b11').val(b11.toFixed(1));
				$('#b12').val(b12.toFixed(1));
				$('#h10').val(h10.toFixed(1));
				$('#h11').val(h11.toFixed(1));
				$('#h12').val(h12.toFixed(1));

				var l_10 = $('#l10').val();
				var l_11 = $('#l11').val();
				var l_12 = $('#l12').val();

				var b_10 = $('#b10').val();
				var b_11 = $('#b11').val();
				var b_12 = $('#b12').val();

				var h_10 = $('#h10').val();
				var h_11 = $('#h11').val();
				var h_12 = $('#h12').val();

				area_10 = (+l_10) * (+b_10);
				area_11 = (+l_11) * (+b_11);
				area_12 = (+l_12) * (+b_12);

				$('#area_10').val(area_10.toFixed(2));
				$('#area_11').val(area_11.toFixed(2));
				$('#area_12').val(area_12.toFixed(2));

				var area10 = $('#area_10').val();
				var area11 = $('#area_11').val();
				var area12 = $('#area_12').val();

				load_10 = ((+area10) * (+com10)) / 1000;
				load_11 = ((+area11) * (+com11)) / 1000;
				load_12 = ((+area12) * (+com12)) / 1000;

				$('#load_10').val(load_10.toFixed(1));
				$('#load_11').val(load_11.toFixed(1));
				$('#load_12').val(load_12.toFixed(1));

				var load10 = $('#load_10').val();
				var load11 = $('#load_11').val();
				var load12 = $('#load_12').val();



				var coms10 = (1000 * (+load10)) / (+area10);
				var coms11 = (1000 * (+load11)) / (+area11);
				var coms12 = (1000 * (+load12)) / (+area12);
				$('#com_10').val(coms10.toFixed(2));
				$('#com_11').val(coms11.toFixed(2));
				$('#com_12').val(coms12.toFixed(2));
				var co10 = $('#com_10').val();
				var co11 = $('#com_11').val();
				var co12 = $('#com_12').val();

				var avgs2 = ((+co10) + (+co11) + (+co12)) / 3;
				$('#avg_com_4').val(avgs2.toFixed());

				var top = parseInt(day_4);
				var date_input = document.getElementById("com_date_test").value.split('/');
				var date = new Date(date_input[2], date_input[1] - 1, date_input[0]);
				var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
				var dd = newdate.getDate();
				var mm = newdate.getMonth() + 1;
				var y = newdate.getFullYear();
				if (mm <= 9)
					mm = '0' + mm;
				if (dd <= 9)
					dd = '0' + dd;
				var someFormattedDate = dd + '/' + mm + '/' + y;
				document.getElementById('test_date4').value = someFormattedDate;
			}
		}

		$('#chk_chk4').change(function() {
			if (this.checked) {
				com_1_day();
			} else {
				$('#com_temp3').val(null);
				$('#com_humidity3').val(null);
				$('#caste_date4').val(null);
				$('#caste_time4').val(null);
				$('#test_date4').val(null);
				$('#test_time4').val(null);
				$('#sp_4').val(null);
				$('#day_4').val(null);
				$('#woc_4').val(null);
				$('#avg_com_4').val(null);
				$('#com_10').val(null);
				$('#com_11').val(null);
				$('#com_12').val(null);
				$('#l10').val(null);
				$('#l11').val(null);
				$('#l12').val(null);
				$('#b10').val(null);
				$('#b11').val(null);
				$('#b12').val(null);
				$('#h10').val(null);
				$('#h11').val(null);
				$('#h12').val(null);
				$('#area_10').val(null);
				$('#area_11').val(null);
				$('#area_12').val(null);
				$('#load_10').val(null);
				$('#load_11').val(null);
				$('#load_12').val(null);
			}
		});






		function l1_l2_l3() {

			if ($("#chk_com").is(':checked')) {
				l1 = $('#l1').val();
				l2 = $('#l2').val();
				l3 = $('#l3').val();
				b1 = $('#b1').val();
				b2 = $('#b2').val();
				b3 = $('#b3').val();

				area_1 = (+l1) * (+b1);
				area_2 = (+l2) * (+b2);
				area_3 = (+l3) * (+b3);

				$('#area_1').val(area_1.toFixed(2));
				$('#area_2').val(area_2.toFixed(2));
				$('#area_3').val(area_3.toFixed(2));

				var area1 = $('#area_1').val();
				var area2 = $('#area_2').val();
				var area3 = $('#area_3').val();


				com_1 = $('#com_1').val();
				com_2 = $('#com_2').val();
				com_3 = $('#com_3').val();

				avg_com_1 = ((+com_1) + (+com_2) + (+com_3)) / 3;
				$('#avg_com_1').val(avg_com_1.toFixed());

				load_1 = ((+area1) * (+com_1)) / 1000;
				load_2 = ((+area2) * (+com_2)) / 1000;
				load_3 = ((+area3) * (+com_3)) / 1000;

				$('#load_1').val(load_1.toFixed(1));
				$('#load_2').val(load_2.toFixed(1));
				$('#load_3').val(load_3.toFixed(1));
			}
			$('#comp').css("background-color", "var(--primary)");

		}

		function load_3_day() {
			/*if ($("#chk_com").is(':checked')) {*/
			l1 = $('#l1').val();
			l2 = $('#l2').val();
			l3 = $('#l3').val();
			b1 = $('#b1').val();
			b2 = $('#b2').val();
			b3 = $('#b3').val();

			area_1 = (+l1) * (+b1);
			area_2 = (+l2) * (+b2);
			area_3 = (+l3) * (+b3);

			$('#area_1').val(area_1.toFixed(2));
			$('#area_2').val(area_2.toFixed(2));
			$('#area_3').val(area_3.toFixed(2));

			area1 = $('#area_1').val();
			area2 = $('#area_2').val();
			area3 = $('#area_3').val();

			load_1 = $('#load_1').val();
			load_2 = $('#load_2').val();
			load_3 = $('#load_3').val();



			com_1 = (1000 * (+load_1)) / (+area1);
			com_2 = (1000 * (+load_2)) / (+area2);
			com_3 = (1000 * (+load_3)) / (+area3);

			avg_com_1 = ((+com_1) + (+com_2) + (+com_3)) / 3;
			$('#avg_com_1').val(avg_com_1.toFixed());

			$('#com_1').val(com_1.toFixed(2));
			$('#com_2').val(com_2.toFixed(2));
			$('#com_3').val(com_3.toFixed(2));
			/*}*/
			$('#comp').css("background-color", "var(--primary)");
		}

		function load_7_day() {
			/*if ($("#chk_com").is(':checked')) {*/
			l4 = $('#l4').val();
			l5 = $('#l5').val();
			l6 = $('#l6').val();
			b4 = $('#b4').val();
			b5 = $('#b5').val();
			b6 = $('#b6').val();

			area_4 = (+l4) * (+b4);
			area_5 = (+l5) * (+b5);
			area_6 = (+l6) * (+b6);

			$('#area_4').val(area_4.toFixed(2));
			$('#area_5').val(area_5.toFixed(2));
			$('#area_6').val(area_6.toFixed(2));

			area4 = $('#area_4').val();
			area5 = $('#area_5').val();
			area6 = $('#area_6').val();

			load_4 = $('#load_4').val();
			load_5 = $('#load_5').val();
			load_6 = $('#load_6').val();



			com_4 = (1000 * (+load_4)) / (+area4);
			com_5 = (1000 * (+load_5)) / (+area5);
			com_6 = (1000 * (+load_6)) / (+area6);

			avg_com_2 = ((+com_4) + (+com_5) + (+com_6)) / 3;
			$('#avg_com_2').val(avg_com_2.toFixed());

			$('#com_4').val(com_4.toFixed(2));
			$('#com_5').val(com_5.toFixed(2));
			$('#com_6').val(com_6.toFixed(2));
			/*}*/
			$('#comp').css("background-color", "var(--primary)");
		}

		function load_28_day() {
			/*if ($("#chk_com").is(':checked')) {*/
			l7 = $('#l7').val();
			l8 = $('#l8').val();
			l9 = $('#l9').val();
			b7 = $('#b7').val();
			b8 = $('#b8').val();
			b9 = $('#b9').val();

			area_7 = (+l7) * (+b7);
			area_8 = (+l8) * (+b8);
			area_9 = (+l9) * (+b9);

			$('#area_7').val(area_7.toFixed(2));
			$('#area_8').val(area_8.toFixed(2));
			$('#area_9').val(area_9.toFixed(2));

			area7 = $('#area_7').val();
			area8 = $('#area_8').val();
			area9 = $('#area_9').val();

			load_7 = $('#load_7').val();
			load_8 = $('#load_8').val();
			load_9 = $('#load_9').val();



			com_7 = (1000 * (+load_7)) / (+area7);
			com_8 = (1000 * (+load_8)) / (+area8);
			com_9 = (1000 * (+load_9)) / (+area9);

			avg_com_3 = ((+com_7) + (+com_8) + (+com_9)) / 3;
			$('#avg_com_3').val(avg_com_3.toFixed());

			$('#com_7').val(com_7.toFixed(2));
			$('#com_8').val(com_8.toFixed(2));
			$('#com_9').val(com_9.toFixed(2));
			/*}*/
			$('#comp').css("background-color", "var(--primary)");
		}

		function load_1_day() {
			/*if ($("#chk_com").is(':checked')) {*/
			l10 = $('#l10').val();
			l11 = $('#l11').val();
			l12 = $('#l12').val();
			b10 = $('#b10').val();
			b11 = $('#b11').val();
			b12 = $('#b12').val();

			area_10 = (+l10) * (+b10);
			area_11 = (+l11) * (+b11);
			area_12 = (+l12) * (+b12);

			$('#area_10').val(area_10.toFixed(2));
			$('#area_11').val(area_11.toFixed(2));
			$('#area_12').val(area_12.toFixed(2));

			area10 = $('#area_10').val();
			area11 = $('#area_11').val();
			area12 = $('#area_12').val();

			load_10 = $('#load_10').val();
			load_11 = $('#load_11').val();
			load_12 = $('#load_12').val();



			com_10 = (1000 * (+load_10)) / (+area10);
			com_11 = (1000 * (+load_11)) / (+area11);
			com_12 = (1000 * (+load_12)) / (+area12);

			avg_com_4 = ((+com_10) + (+com_11) + (+com_12)) / 3;
			$('#avg_com_4').val(avg_com_4.toFixed());

			$('#com_10').val(com_10.toFixed(2));
			$('#com_11').val(com_11.toFixed(2));
			$('#com_12').val(com_12.toFixed(2));
			/*}*/
			$('#comp').css("background-color", "var(--primary)");
		}

		$('#load_1').change(function() {
			load_3_day();
		});
		$('#load_2').change(function() {
			load_3_day();
		});
		$('#load_3').change(function() {
			load_3_day();
		});
		$('#load_4').change(function() {
			load_7_day();
		});
		$('#load_5').change(function() {
			load_7_day();
		});
		$('#load_6').change(function() {
			load_7_day();
		});
		$('#load_7').change(function() {
			load_28_day();
		});
		$('#load_8').change(function() {
			load_28_day();
		});
		$('#load_9').change(function() {
			load_28_day();
		});

		$('#load_10').change(function() {
			load_1_day();
		});
		$('#load_11').change(function() {
			load_1_day();
		});
		$('#load_12').change(function() {
			load_1_day();
		});

		$('#l1').change(function() {
			l1_l2_l3();
		});
		$('#l2').change(function() {
			l1_l2_l3();
		});
		$('#l3').change(function() {
			l1_l2_l3();
		});
		$('#b1').change(function() {
			l1_l2_l3();
		});
		$('#b2').change(function() {
			l1_l2_l3();
		});
		$('#b3').change(function() {
			l1_l2_l3();
		});


		$('#com_1').change(function() {
			l1_l2_l3();
		});
		$('#com_2').change(function() {
			l1_l2_l3();
		});
		$('#com_3').change(function() {
			l1_l2_l3();
		});

		$('#avg_com_1').change(function() {

			if ($("#chk_com").is(':checked')) {
				var avg_com1 = $('#avg_com_1').val();
				com_1 = (+avg_com1) + (+0.42);
				com_2 = (+avg_com1) - (+0.55);
				com_3 = (+avg_com1) + (+0.13);
				$('#com_1').val(com_1.toFixed(2));
				$('#com_2').val(com_2.toFixed(2));
				$('#com_3').val(com_3.toFixed(2));

				l1 = $('#l1').val();
				l2 = $('#l2').val();
				l3 = $('#l3').val();
				b1 = $('#b1').val();
				b2 = $('#b2').val();
				b3 = $('#b3').val();

				area_1 = (+l1) * (+b1);
				area_2 = (+l2) * (+b2);
				area_3 = (+l3) * (+b3);

				$('#area_1').val(area_1.toFixed(2));
				$('#area_2').val(area_2.toFixed(2));
				$('#area_3').val(area_3.toFixed(2));

				area1 = $('#area_1').val();
				area2 = $('#area_2').val();
				area3 = $('#area_3').val();

				com1 = $('#com_1').val();
				com2 = $('#com_2').val();
				com3 = $('#com_3').val();

				load_1 = ((+area1) * (+com1)) / 1000;
				load_2 = ((+area2) * (+com2)) / 1000;
				load_3 = ((+area3) * (+com3)) / 1000;

				$('#load_1').val(load_1.toFixed(1));
				$('#load_2').val(load_2.toFixed(1));
				$('#load_3').val(load_3.toFixed(1));

				var load1 = $('#load_1').val();
				var load2 = $('#load_2').val();
				var load3 = $('#load_3').val();



				var coms1 = (1000 * (+load1)) / (+area1);
				var coms2 = (1000 * (+load2)) / (+area2);
				var coms3 = (1000 * (+load3)) / (+area3);
				$('#com_1').val(coms1.toFixed(2));
				$('#com_2').val(coms2.toFixed(2));
				$('#com_3').val(coms3.toFixed(2));
				var co1 = $('#com_1').val();
				var co2 = $('#com_2').val();
				var co3 = $('#com_3').val();

				var avgs = ((+co1) + (+co2) + (+co3)) / 3;
				$('#avg_com_1').val(avgs.toFixed());


			}
			$('#comp').css("background-color", "var(--primary)");
		});

		function l4_l5_l6() {
			if ($("#chk_com").is(':checked')) {

				l4 = $('#l4').val();
				l5 = $('#l5').val();
				l6 = $('#l6').val();
				b4 = $('#b4').val();
				b5 = $('#b5').val();
				b6 = $('#b6').val();

				area_4 = (+l4) * (+b4);
				area_5 = (+l5) * (+b5);
				area_6 = (+l6) * (+b6);

				$('#area_4').val(area_4.toFixed(2));
				$('#area_5').val(area_5.toFixed(2));
				$('#area_6').val(area_6.toFixed(2));

				var area4 = $('#area_4').val();
				var area5 = $('#area_5').val();
				var area6 = $('#area_6').val();

				com_4 = $('#com_4').val();
				com_5 = $('#com_5').val();
				com_6 = $('#com_6').val();

				avg_com_2 = ((+com_4) + (+com_5) + (+com_6)) / 3;
				$('#avg_com_2').val(avg_com_2.toFixed());

				load_4 = ((+area4) * (+com_4)) / 1000;
				load_5 = ((+area5) * (+com_5)) / 1000;
				load_6 = ((+area6) * (+com_6)) / 1000;

				$('#load_4').val(load_4.toFixed(1));
				$('#load_5').val(load_5.toFixed(1));
				$('#load_6').val(load_6.toFixed(1));
			}
			$('#comp').css("background-color", "var(--primary)");

		}

		$('#avg_com_2').change(function() {
			if ($("#chk_com").is(':checked')) {
				avg_com_2 = $('#avg_com_2').val();
				com_4 = (+avg_com_2) + 0.63;
				com_5 = (+avg_com_2) - 0.71;
				com_6 = (+avg_com_2) + 0.08;
				$('#com_4').val(com_4.toFixed(2));
				$('#com_5').val(com_5.toFixed(2));
				$('#com_6').val(com_6.toFixed(2));

				var com4 = $('#com_4').val();
				var com5 = $('#com_5').val();
				var com6 = $('#com_6').val();

				l4 = $('#l4').val();
				l5 = $('#l5').val();
				l6 = $('#l6').val();
				b4 = $('#b4').val();
				b5 = $('#b5').val();
				b6 = $('#b6').val();


				area_4 = (+l4) * (+b4);
				area_5 = (+l5) * (+b5);
				area_6 = (+l6) * (+b6);

				$('#area_4').val(area_4.toFixed(2));
				$('#area_5').val(area_5.toFixed(2));
				$('#area_6').val(area_6.toFixed(2));

				var area4 = $('#area_4').val();
				var area5 = $('#area_5').val();
				var area6 = $('#area_6').val();

				load_4 = ((+area4) * (+com4)) / 1000;
				load_5 = ((+area5) * (+com5)) / 1000;
				load_6 = ((+area6) * (+com6)) / 1000;

				$('#load_4').val(load_4.toFixed(1));
				$('#load_5').val(load_5.toFixed(1));
				$('#load_6').val(load_6.toFixed(1));

				var load4 = $('#load_4').val();
				var load5 = $('#load_5').val();
				var load6 = $('#load_6').val();



				var coms4 = (1000 * (+load4)) / (+area4);
				var coms5 = (1000 * (+load5)) / (+area5);
				var coms6 = (1000 * (+load6)) / (+area6);
				$('#com_4').val(coms4.toFixed(2));
				$('#com_5').val(coms5.toFixed(2));
				$('#com_6').val(coms6.toFixed(2));
				var co4 = $('#com_4').val();
				var co5 = $('#com_5').val();
				var co6 = $('#com_6').val();

				var avgs1 = ((+co4) + (+co5) + (+co6)) / 3;
				$('#avg_com_2').val(avgs1.toFixed());
			}
			$('#comp').css("background-color", "var(--primary)");
		});

		$('#l4').change(function() {
			l4_l5_l6();
		});
		$('#l5').change(function() {
			l4_l5_l6();
		});
		$('#l6').change(function() {
			l4_l5_l6();
		});
		$('#b4').change(function() {
			l4_l5_l6();
		});
		$('#b5').change(function() {
			l4_l5_l6();
		});
		$('#b6').change(function() {
			l4_l5_l6();
		});


		$('#com_4').change(function() {
			l4_l5_l6();
		});
		$('#com_5').change(function() {
			l4_l5_l6();
		});
		$('#com_6').change(function() {
			l4_l5_l6();
		});

		function l7_l8_l9() {
			if ($("#chk_com").is(':checked')) {

				l7 = $('#l7').val();
				l8 = $('#l8').val();
				l9 = $('#l9').val();
				b7 = $('#b7').val();
				b8 = $('#b8').val();
				b9 = $('#b9').val();

				area_7 = (+l7) * (+b7);
				area_8 = (+l8) * (+b8);
				area_9 = (+l9) * (+b9);

				$('#area_7').val(area_7.toFixed(2));
				$('#area_8').val(area_8.toFixed(2));
				$('#area_9').val(area_9.toFixed(2));

				var area7 = $('#area_7').val();
				var area8 = $('#area_8').val();
				var area9 = $('#area_9').val();

				com_7 = $('#com_7').val();
				com_8 = $('#com_8').val();
				com_9 = $('#com_9').val();

				avg_com_3 = ((+com_7) + (+com_8) + (+com_9)) / 3;
				$('#avg_com_3').val(avg_com_3.toFixed());

				load_7 = ((+area7) * (+com_7)) / 1000;
				load_8 = ((+area8) * (+com_8)) / 1000;
				load_9 = ((+area9) * (+com_9)) / 1000;

				$('#load_7').val(load_7.toFixed(1));
				$('#load_8').val(load_8.toFixed(1));
				$('#load_9').val(load_9.toFixed(1));
			}
			$('#comp').css("background-color", "var(--primary)");

		}

		$('#avg_com_3').change(function() {
			if ($("#chk_com").is(':checked')) {
				avg_com_3 = $('#avg_com_3').val();
				com_7 = (+avg_com_3) + 0.93;
				com_8 = (+avg_com_3) - 0.71;
				com_9 = (+avg_com_3) + 0.08;
				$('#com_7').val(com_7.toFixed(2));
				$('#com_8').val(com_8.toFixed(2));
				$('#com_9').val(com_9.toFixed(2));

				var com7 = $('#com_7').val();
				var com8 = $('#com_8').val();
				var com9 = $('#com_9').val();

				l7 = $('#l7').val();
				l8 = $('#l8').val();
				l9 = $('#l9').val();
				b7 = $('#b7').val();
				b8 = $('#b8').val();
				b9 = $('#b9').val();

				area_7 = (+l7) * (+b7);
				area_8 = (+l8) * (+b8);
				area_9 = (+l9) * (+b9);

				$('#area_7').val(area_7.toFixed(2));
				$('#area_8').val(area_8.toFixed(2));
				$('#area_9').val(area_9.toFixed(2));

				var area7 = $('#area_7').val();
				var area8 = $('#area_8').val();
				var area9 = $('#area_9').val();


				load_7 = ((+area7) * (+com7)) / 1000;
				load_8 = ((+area8) * (+com8)) / 1000;
				load_9 = ((+area9) * (+com9)) / 1000;

				$('#load_7').val(load_7.toFixed(1));
				$('#load_8').val(load_8.toFixed(1));
				$('#load_9').val(load_9.toFixed(1));

				var load7 = $('#load_7').val();
				var load8 = $('#load_8').val();
				var load9 = $('#load_9').val();



				var coms7 = (1000 * (+load7)) / (+area7);
				var coms8 = (1000 * (+load8)) / (+area8);
				var coms9 = (1000 * (+load9)) / (+area9);
				$('#com_7').val(coms7.toFixed(2));
				$('#com_8').val(coms8.toFixed(2));
				$('#com_9').val(coms9.toFixed(2));
				var co7 = $('#com_7').val();
				var co8 = $('#com_8').val();
				var co9 = $('#com_9').val();

				var avgs2 = ((+co7) + (+co8) + (+co9)) / 3;
				$('#avg_com_3').val(avgs2.toFixed());
			}
			$('#comp').css("background-color", "var(--primary)");
		});

		$('#l7').change(function() {
			l7_l8_l9();
		});
		$('#l8').change(function() {
			l7_l8_l9();
		});
		$('#l9').change(function() {
			l7_l8_l9();
		});
		$('#b7').change(function() {
			l7_l8_l9();
		});
		$('#b8').change(function() {
			l7_l8_l9();
		});
		$('#b9').change(function() {
			l7_l8_l9();
		});


		$('#com_7').change(function() {
			l7_l8_l9();
		});
		$('#com_8').change(function() {
			l7_l8_l9();
		});
		$('#com_9').change(function() {
			l7_l8_l9();
		});




		function l10_l11_l12() {
			if ($("#chk_com").is(':checked')) {

				l10 = $('#l10').val();
				l11 = $('#l11').val();
				l12 = $('#l12').val();
				b10 = $('#b10').val();
				b11 = $('#b11').val();
				b12 = $('#b12').val();

				area_10 = (+l10) * (+b10);
				area_11 = (+l11) * (+b11);
				area_12 = (+l12) * (+b12);

				$('#area_10').val(area_10.toFixed(2));
				$('#area_11').val(area_11.toFixed(2));
				$('#area_12').val(area_12.toFixed(2));

				var area10 = $('#area_10').val();
				var area11 = $('#area_11').val();
				var area12 = $('#area_12').val();

				com_10 = $('#com_10').val();
				com_11 = $('#com_11').val();
				com_12 = $('#com_12').val();

				avg_com_4 = ((+com_10) + (+com_11) + (+com_12)) / 3;
				$('#avg_com_4').val(avg_com_4.toFixed());

				load_10 = ((+area10) * (+com_10)) / 1000;
				load_11 = ((+area11) * (+com_11)) / 1000;
				load_12 = ((+area12) * (+com_12)) / 1000;

				$('#load_10').val(load_10.toFixed(1));
				$('#load_11').val(load_11.toFixed(1));
				$('#load_12').val(load_12.toFixed(1));
			}
			$('#comp').css("background-color", "var(--primary)");

		}

		$('#avg_com_4').change(function() {
			if ($("#chk_com").is(':checked')) {
				avg_com_4 = $('#avg_com_4').val();
				com_10 = (+avg_com_4) + 0.93;
				com_11 = (+avg_com_4) - 0.71;
				com_12 = (+avg_com_4) + 0.08;
				$('#com_10').val(com_10.toFixed(2));
				$('#com_11').val(com_11.toFixed(2));
				$('#com_12').val(com_12.toFixed(2));

				var com10 = $('#com_10').val();
				var com11 = $('#com_11').val();
				var com12 = $('#com_12').val();

				l10 = $('#l10').val();
				l11 = $('#l11').val();
				l12 = $('#l12').val();
				b10 = $('#b10').val();
				b11 = $('#b11').val();
				b12 = $('#b12').val();

				area_10 = (+l10) * (+b10);
				area_11 = (+l11) * (+b11);
				area_12 = (+l12) * (+b12);

				$('#area_10').val(area_10.toFixed(2));
				$('#area_11').val(area_11.toFixed(2));
				$('#area_12').val(area_12.toFixed(2));

				var area10 = $('#area_10').val();
				var area11 = $('#area_11').val();
				var area12 = $('#area_12').val();


				load_10 = ((+area10) * (+com10)) / 1000;
				load_11 = ((+area11) * (+com11)) / 1000;
				load_12 = ((+area12) * (+com12)) / 1000;

				$('#load_10').val(load_10.toFixed(1));
				$('#load_11').val(load_11.toFixed(1));
				$('#load_12').val(load_12.toFixed(1));

				var load10 = $('#load_10').val();
				var load11 = $('#load_11').val();
				var load12 = $('#load_12').val();



				var coms10 = (1000 * (+load10)) / (+area10);
				var coms11 = (1000 * (+load11)) / (+area11);
				var coms12 = (1000 * (+load12)) / (+area12);
				$('#com_10').val(coms7.toFixed(2));
				$('#com_11').val(coms8.toFixed(2));
				$('#com_12').val(coms9.toFixed(2));
				var co10 = $('#com_10').val();
				var co11 = $('#com_11').val();
				var co12 = $('#com_12').val();

				var avgs3 = ((+co10) + (+co11) + (+co12)) / 3;
				$('#avg_com_4').val(avgs3.toFixed(2));
			}
			$('#comp').css("background-color", "var(--primary)");
		});

		$('#l7').change(function() {
			l10_l11_l12();
		});
		$('#l8').change(function() {
			l10_l11_l12();
		});
		$('#l9').change(function() {
			l10_l11_l12();
		});
		$('#b7').change(function() {
			l10_l11_l12();
		});
		$('#b8').change(function() {
			l10_l11_l12();
		});
		$('#b9').change(function() {
			l10_l11_l12();
		});


		$('#com_7').change(function() {
			l10_l11_l12();
		});
		$('#com_8').change(function() {
			l10_l11_l12();
		});
		$('#com_9').change(function() {
			l10_l11_l12();
		});




		$('#weight_of_cement').change(function() {
			$('#comp').css("background-color", "var(--primary)");
			var consis = $('#final_consistency').val();
			var temp = ((parseFloat(consis) / 4) + 3);
			weight_of_water = (parseFloat(temp) * 8);
			$('#weight_of_water').val(weight_of_water.toFixed(1));
		});
		$('#weight_of_sand').change(function() {
			$('#comp').css("background-color", "var(--primary)");
			var consis = $('#final_consistency').val();
			var temp = ((parseFloat(consis) / 4) + 3);
			weight_of_water = (parseFloat(temp) * 8);
			$('#weight_of_water').val(weight_of_water.toFixed(1));
		});
		$('#weight_of_water').change(function() {
			$('#comp').css("background-color", "var(--primary)");

		});







		$('#chk_auto').change(function() {
			if (this.checked) {
				//$('#txtabr').css("background-color","var(--primary)"); 
				//$('#txtwtr').css("background-color","var(--primary)"); 


				var temp = $('#test_list').val();
				var aa = temp.split(",");
				//Consistency
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "con") {
						$('#consis').css("background-color", "var(--primary)");
						$("#chk_con").prop("checked", true);
						consistency_auto();
						break;
					}
				}

				//Soundness
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sou") {

						$("#chk_sou").prop("checked", true);
						soundness_auto();
						break;
					}
				}

				//SETTING TIME
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "set") {

						$("#chk_set").prop("checked", true);
						set_auto();
						break;
					}
				}


				//DENSITY
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "fin") {

						$("#chk_fines").prop("checked", true);
						$('#fins').css("background-color", "var(--primary)");
						fines_auto();
						break;
					}
				}
				//FINES
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "mou") {

						$("#chk_mou").prop("checked", true);
						mo_auto();
						break;
					}
				}

				//COMPRESSIVE
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "com") {

						$("#chk_com").prop("checked", true);
						com_auto();
						com_3_day();
						com_7_day();
						com_28_day();
						com_1_day();
						break;
					}
				}


			}

		});



	});


	function randomNumberFromRange(min, max) {
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}

	function rand(min, max) {
		var offset = min;
		var range = (max - min) + 1;

		var randomNumber = Math.floor(Math.random() * range) + offset;
		return randomNumber;
	}

	$("#btn_edit_data").click(function() {
		$('#btn_edit_data').hide();
		$('#btn_save').show();

	});

	function getGlazedTiles() {
		var lab_no = $('#lab_no').val();
		var report_no = $('#report_no').val();
		var job_no = $('#job_no').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_flyash.php',
			data: 'action_type=view&' + $("#Glazed").serialize() + '&lab_no=' + lab_no,
			success: function(html) {
				$('#display_data').html(html);

			}
		});
	}

	function saveMetal(type, id) {
		id = (typeof id == "undefined") ? '' : id;
		var statusArr = {
			add: "added",
			edit: "updated",
			delete: "deleted"
		};
		var billData = '';
		if (type == 'add') {
			var report_no = $('#report_no').val();
			var makes = $('#makes').val();
			var brand = $('#brand').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();
			var report_date = $('#report_date').val();
			var cement_grade = $('#cement_grade').val();
			var type_of_cement = $('#type_of_cement').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");
			//Consistency
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "con") {
					if (document.getElementById('chk_con').checked) {
						var chk_con = "1";
					} else {
						var chk_con = "0";
					}

					var con_date_test = $('#con_date_test').val();
					var con_temp = $('#con_temp').val();
					var con_humidity = $('#con_humidity').val();
					var con_weight = $('#con_weight').val();
					var vol_1 = $('#vol_1').val();
					var vol_2 = $('#vol_2').val();
					var vol_3 = $('#vol_3').val();
					var vol_4 = $('#vol_4').val();
					var vol_5 = $('#vol_5').val();
					var vol_6 = $('#vol_6').val();
					var vol_7 = $('#vol_7').val();

					var wtr_1 = $('#wtr_1').val();
					var wtr_2 = $('#wtr_2').val();
					var wtr_3 = $('#wtr_3').val();
					var wtr_4 = $('#wtr_4').val();
					var wtr_5 = $('#wtr_5').val();
					var wtr_6 = $('#wtr_6').val();
					var wtr_7 = $('#wtr_7').val();

					var reading_1 = $('#reading_1').val();
					var reading_2 = $('#reading_2').val();
					var reading_3 = $('#reading_3').val();
					var reading_4 = $('#reading_4').val();
					var reading_5 = $('#reading_5').val();
					var reading_6 = $('#reading_6').val();
					var reading_7 = $('#reading_7').val();

					var remark_1 = $('#remark_1').val();
					var remark_2 = $('#remark_2').val();
					var remark_3 = $('#remark_3').val();
					var remark_4 = $('#remark_4').val();
					var remark_5 = $('#remark_5').val();
					var remark_6 = $('#remark_6').val();
					var remark_7 = $('#remark_7').val();
					var final_consistency = $('#final_consistency').val();
					var consistency_of_cement = $('#consistency_of_cement').val();
					break;
				} else {
					var chk_con = "0";
					var con_date_test = "00/00/0000";
					var con_temp = "0";
					var con_humidity = "0";
					var con_weight = "0";
					var vol_1 = "0";
					var vol_2 = "0";
					var vol_3 = "0";
					var vol_4 = "0";
					var vol_5 = "0";
					var vol_6 = "0";
					var vol_7 = "0";

					var wtr_1 = "0";
					var wtr_2 = "0";
					var wtr_3 = "0";
					var wtr_4 = "0";
					var wtr_5 = "0";
					var wtr_6 = "0";
					var wtr_7 = "0";

					var reading_1 = "0";
					var reading_2 = "0";
					var reading_3 = "0";
					var reading_4 = "0";
					var reading_5 = "0";
					var reading_6 = "0";
					var reading_7 = "0";

					var remark_1 = "0";
					var remark_2 = "0";
					var remark_3 = "0";
					var remark_4 = "0";
					var remark_5 = "0";
					var remark_6 = "0";
					var remark_7 = "0";
					var final_consistency = "0";
					var consistency_of_cement = "0";

				}

			}


			//finness by blaine 
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "fin") {
					if (document.getElementById('chk_fines').checked) {
						var chk_fines = "1";
					} else {
						var chk_fines = "0";
					}
					var fbs_w1 = $('#fbs_w1').val();
					var fbs_w2 = $('#fbs_w2').val();

					var fbs_m1 = $('#fbs_m1').val();
					var fbs_m2 = $('#fbs_m2').val();

					var fbs_p1 = $('#fbs_p1').val();
					var fbs_p2 = $('#fbs_p2').val();
					var avg_fbs = $('#avg_fbs').val();
					var den_date_test = $('#den_date_test').val();
					var fine_temp = $('#fine_temp').val();
					var fine_humidity = $('#fine_humidity').val();
					var den_intial = $('#den_intial').val();
					var den_final = $('#den_final').val();
					var density = $('#density').val();
					var den_cement = $('#den_cement').val();
					var mass = $('#mass').val();
					var x = $('#x').val();
					var v = $('#v').val();
					var p = $('#p').val();
					var ss_area = $('#ss_area').val();
					//ss_sample,gs_sample,ps_bed,fs_e3,tts_sample,por_sample_bed,sample_e3,tt1
					var ss_sample = $('#ss_sample').val();
					var gs_sample = $('#gs_sample').val();
					var ps_bed = $('#ps_bed').val();
					var fs_e3 = $('#fs_e3').val();
					var tts_sample = $('#tts_sample').val();
					var por_sample_bed = $('#por_sample_bed').val();
					var sample_e3 = $('#sample_e3').val();
					var tt1 = $('#tt1').val();

					var fines_t_1 = $('#fines_t_1').val();
					var fines_t_2 = $('#fines_t_2').val();
					var fines_t_3 = $('#fines_t_3').val();
					var fines_t_4 = $('#fines_t_4').val();
					var avg_fines_time = $('#avg_fines_time').val();
					var constant_k = $('#constant_k').val();

					break;
				} else {
					var chk_fines = "0";
					var den_date_test = "00/00/0000";
					var fine_temp = "0";
					var fine_humidity = "0";
					var fbs_w1 = "";
					var fbs_w2 = "";

					var fbs_m1 = "";
					var fbs_m2 = "";

					var fbs_p1 = "";
					var fbs_p2 = "";
					var avg_fbs = "";
					var den_intial = "0";
					var den_final = "0";
					var density = "0";
					var den_cement = "0";
					var mass = "0";
					var x = "0";
					var v = "0";
					var p = "0";
					var ss_area = "0";
					var ss_sample = "0";
					var gs_sample = "0";
					var ps_bed = "0";
					var fs_e3 = "0";
					var tts_sample = "0";
					var por_sample_bed = "0";
					var sample_e3 = "0";
					var tt1 = "0";
					var fines_t_1 = "0";
					var fines_t_2 = "0";
					var fines_t_3 = "0";
					var fines_t_4 = "0";
					var avg_fines_time = "0";
					var constant_k = "0";
				}

			}

			//chk_mou
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "mou") {
					if (document.getElementById('chk_mou').checked) {
						var chk_mou = "1";
					} else {
						var chk_mou = "0";
					}
					var in_w1 = $('#in_w1').val();
					var in_w2 = $('#in_w2').val();

					var fn_w1 = $('#fn_w1').val();
					var fn_w2 = $('#fn_w2').val();

					var fbs_m1 = $('#fbs_m1').val();
					var fbs_m2 = $('#fbs_m2').val();

					var mo1 = $('#mo1').val();
					var mo2 = $('#mo2').val();
					var avg_mo = $('#avg_mo').val();


					break;
				} else {
					var chk_mou = "0";
					var in_w1 = "0";
					var in_w2 = "0";

					var fn_w1 = "0";
					var fn_w2 = "0";

					var fbs_m1 = "0";
					var fbs_m2 = "0";

					var mo1 = "0";
					var mo2 = "0";
					var avg_mo = "0";

				}

			}



			//Compressive
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "com") {
					if (document.getElementById('chk_com').checked) {
						var chk_com = "1";
					} else {
						var chk_com = "0";
					}


					var com_date_test = $('#com_date_test').val();
					var com_temp = $('#com_temp').val();
					var com_temp1 = $('#com_temp1').val();
					var com_temp2 = $('#com_temp2').val();
					var com_temp3 = $('#com_temp3').val();
					var com_humidity = $('#com_humidity').val();
					var com_humidity1 = $('#com_humidity1').val();
					var com_humidity2 = $('#com_humidity2').val();
					var com_humidity3 = $('#com_humidity3').val();
					var weight_of_cement = $('#weight_of_cement').val();
					var weight_of_sand = $('#weight_of_sand').val();
					var weight_of_water = $('#weight_of_water').val();
					var sp_1 = $('#sp_1').val();
					var sp_2 = $('#sp_2').val();
					var sp_3 = $('#sp_3').val();
					var sp_4 = $('#sp_4').val();
					var caste_date1 = $('#caste_date1').val();
					var caste_date2 = $('#caste_date2').val();
					var caste_date3 = $('#caste_date3').val();
					var caste_date4 = $('#caste_date4').val();
					var caste_time1 = $('#caste_time1').val();
					var caste_time2 = $('#caste_time2').val();
					var caste_time3 = $('#caste_time3').val();
					var caste_time4 = $('#caste_time4').val();
					var test_date1 = $('#test_date1').val();
					var test_date2 = $('#test_date2').val();
					var test_date3 = $('#test_date3').val();
					var test_date4 = $('#test_date4').val();
					var test_time1 = $('#test_time1').val();
					var test_time2 = $('#test_time2').val();
					var test_time3 = $('#test_time3').val();
					var test_time4 = $('#test_time4').val();
					var day_1 = $('#day_1').val();
					var day_2 = $('#day_2').val();
					var day_3 = $('#day_3').val();
					var day_4 = $('#day_4').val();
					var woc_1 = $('#woc_1').val();
					var woc_2 = $('#woc_2').val();
					var woc_3 = $('#woc_3').val();
					var woc_4 = $('#woc_4').val();
					var avg_com_1 = $('#avg_com_1').val();
					var avg_com_2 = $('#avg_com_2').val();
					var avg_com_3 = $('#avg_com_3').val();
					var avg_com_4 = $('#avg_com_4').val();
					var l1 = $('#l1').val();
					var l2 = $('#l2').val();
					var l3 = $('#l3').val();
					var l4 = $('#l4').val();
					var l5 = $('#l5').val();
					var l6 = $('#l6').val();
					var l7 = $('#l7').val();
					var l8 = $('#l8').val();
					var l9 = $('#l9').val();
					var l10 = $('#l10').val();
					var l11 = $('#l11').val();
					var l12 = $('#l12').val();

					var b1 = $('#b1').val();
					var b2 = $('#b2').val();
					var b3 = $('#b3').val();
					var b4 = $('#b4').val();
					var b5 = $('#b5').val();
					var b6 = $('#b6').val();
					var b7 = $('#b7').val();
					var b8 = $('#b8').val();
					var b9 = $('#b9').val();
					var b10 = $('#b10').val();
					var b11 = $('#b11').val();
					var b12 = $('#b12').val();



					var area_1 = $('#area_1').val();
					var area_2 = $('#area_2').val();
					var area_3 = $('#area_3').val();
					var area_4 = $('#area_4').val();
					var area_5 = $('#area_5').val();
					var area_6 = $('#area_6').val();
					var area_7 = $('#area_7').val();
					var area_8 = $('#area_8').val();
					var area_9 = $('#area_9').val();
					var area_10 = $('#area_10').val();
					var area_11 = $('#area_11').val();
					var area_12 = $('#area_12').val();

					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();
					var load_4 = $('#load_4').val();
					var load_5 = $('#load_5').val();
					var load_6 = $('#load_6').val();
					var load_7 = $('#load_7').val();
					var load_8 = $('#load_8').val();
					var load_9 = $('#load_9').val();
					var load_10 = $('#load_10').val();
					var load_11 = $('#load_11').val();
					var load_12 = $('#load_12').val();

					var com_1 = $('#com_1').val();
					var com_2 = $('#com_2').val();
					var com_3 = $('#com_3').val();
					var com_4 = $('#com_4').val();
					var com_5 = $('#com_5').val();
					var com_6 = $('#com_6').val();
					var com_7 = $('#com_7').val();
					var com_8 = $('#com_8').val();
					var com_9 = $('#com_9').val();
					var com_10 = $('#com_10').val();
					var com_11 = $('#com_11').val();
					var com_12 = $('#com_12').val();
					break;
				} else {
					var chk_com = "0";
					/* var chk_chk3 = "0";	
					var chk_chk2 = "0";	
					var chk_chk1 = "0"; */
					var com_date_test = "0";
					var com_temp = "0";
					var com_temp1 = "0";
					var com_temp2 = "0";
					var com_temp3 = "0";
					var com_humidity = "0";
					var com_humidity1 = "0";
					var com_humidity2 = "0";
					var com_humidity3 = "0";
					var weight_of_cement = "0";
					var weight_of_sand = "0";
					var weight_of_water = "0";
					var sp_1 = "0";
					var sp_2 = "0";
					var sp_3 = "0";
					var sp_4 = "0";
					var caste_date1 = "00/00/0000";
					var caste_date2 = "00/00/0000";
					var caste_date3 = "00/00/0000";
					var caste_date4 = "00/00/0000";
					var caste_time1 = "00:00";
					var caste_time2 = "00:00";
					var caste_time3 = "00:00";
					var caste_time4 = "00:00";
					var test_date1 = "00/00/0000";
					var test_date2 = "00/00/0000";
					var test_date3 = "00/00/0000";
					var test_date4 = "00/00/0000";
					var test_time1 = "00:00";
					var test_time2 = "00:00";
					var test_time3 = "00:00";
					var test_time4 = "00:00";
					var day_1 = "0";
					var day_2 = "0";
					var day_3 = "0";
					var day_4 = "0";

					var woc_1 = "0";
					var woc_2 = "0";
					var woc_3 = "0";
					var woc_4 = "0";

					var avg_com_1 = "0";
					var avg_com_2 = "0";
					var avg_com_3 = "0";
					var avg_com_4 = "0";
					var l1 = "0";
					var l2 = "0";
					var l3 = "0";
					var l4 = "0";
					var l5 = "0";
					var l6 = "0";
					var l7 = "0";
					var l8 = "0";
					var l9 = "0";
					var l10 = "0";
					var l11 = "0";
					var l12 = "0";

					var b1 = "0";
					var b2 = "0";
					var b3 = "0";
					var b4 = "0";
					var b5 = "0";
					var b6 = "0";
					var b7 = "0";
					var b8 = "0";
					var b9 = "0";
					var b10 = "0";
					var b11 = "0";
					var b12 = "0";


					var area_1 = "0";
					var area_2 = "0";
					var area_3 = "0";
					var area_4 = "0";
					var area_5 = "0";
					var area_6 = "0";
					var area_7 = "0";
					var area_8 = "0";
					var area_9 = "0";
					var area_10 = "0";
					var area_11 = "0";
					var area_12 = "0";

					var load_1 = "0";
					var load_2 = "0";
					var load_3 = "0";
					var load_4 = "0";
					var load_5 = "0";
					var load_6 = "0";
					var load_7 = "0";
					var load_8 = "0";
					var load_9 = "0";
					var load_10 = "0";
					var load_11 = "0";
					var load_12 = "0";

					var com_1 = "0";
					var com_2 = "0";
					var com_3 = "0";
					var com_4 = "0";
					var com_5 = "0";
					var com_6 = "0";
					var com_7 = "0";
					var com_8 = "0";
					var com_9 = "0";
					var com_10 = "0";
					var com_11 = "0";
					var com_12 = "0";
				}

			}

			//soundness
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sou") {
					if (document.getElementById('chk_sou').checked) {
						var chk_sou = "1";
					} else {
						var chk_sou = "0";
					}
					var sou_date_test = $('#sou_date_test').val();
					var sou_temp = $('#sou_temp').val();
					var sou_humidity = $('#sou_humidity').val();
					var sou_water = $('#sou_water').val();
					var sou_weight = $('#sou_weight').val();
					var dis_1_1 = $('#dis_1_1').val();
					var dis_1_2 = $('#dis_1_2').val();
					var dis_2_1 = $('#dis_2_1').val();
					var dis_2_2 = $('#dis_2_2').val();
					var diff_1 = $('#diff_1').val();
					var diff_2 = $('#diff_2').val();
					var soundness = $('#soundness').val();
					var sou_s_d = $('#sou_s_d').val();
					var sou_e_d = $('#sou_e_d').val();

					var sou_test_method = $('#sou_test_method').val();
					var sou_test_req = $('#sou_test_req').val();
					var sou_test_limit_1 = $('#sou_test_limit_1').val();
					var sou_test_limit_2 = $('#sou_test_limit_2').val();
					break;
				} else {

					var chk_sou = "0";
					var sou_date_test = "00/00/0000";
					var sou_temp = "0";
					var sou_humidity = "0";
					var sou_water = "0";
					var sou_weight = "0";
					var dis_1_1 = "0";
					var dis_1_2 = "0";
					var dis_2_1 = "0";
					var dis_2_2 = "0";
					var diff_1 = "0";
					var diff_2 = "0";
					var soundness = "0";
					var sou_s_d = "";
					var sou_e_d = "";

					var sou_test_method = "";
					var sou_test_req = "";
					var sou_test_limit_1 = "";
					var sou_test_limit_2 = "";
				}

			}


			//Setting Time
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "set") {
					if (document.getElementById('chk_set').checked) {
						var chk_set = "1";
					} else {
						var chk_set = "0";
					}
					var set_date_test = $('#set_date_test').val();
					var set_temp = $('#set_temp').val();
					var set_wtr = $('#set_wtr').val();
					var set_humidity = $('#set_humidity').val();
					var hr_a = $('#hr_a').val();
					var hr_b = $('#hr_b').val();
					var hr_c = $('#hr_c').val();
					var initial_time = $('#initial_time').val();
					var final_time = $('#final_time').val();
					var set_weight = $('#set_weight').val();
					var set_s_d = $('#set_s_d').val();
					var set_e_d = $('#set_e_d').val();

					var set_test_method = $('#set_test_method').val();
					var set_test_req = $('#set_test_req').val();
					var set_test_limit_1 = $('#set_test_limit_1').val();
					var set_test_limit_2 = $('#set_test_limit_2').val();
					break;
				} else {
					var chk_set = "0";
					var set_date_test = "00/00/0000";
					var set_temp = "0";
					var set_wtr = "0";
					var set_humidity = "0";
					var hr_a = "0";
					var hr_b = "0";
					var hr_c = "0";
					var initial_time = "0";
					var final_time = "0";
					var set_weight = "0";
					var set_s_d = "";
					var set_e_d = "";

					var set_test_method = "";
					var set_test_req = "";
					var set_test_limit_1 = "";
					var set_test_limit_2 = "";
				}

			}





			billData = '&action_type=' + type + '&report_no=' + report_no + '&ulr=' + ulr + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_con=' + chk_con + '&con_date_test=' + con_date_test + '&report_date=' + report_date + '&con_temp=' + con_temp + '&con_humidity=' + con_humidity + '&con_weight=' + con_weight + '&vol_1=' + vol_1 + '&vol_2=' + vol_2 + '&vol_3=' + vol_3 + '&vol_4=' + vol_4 + '&vol_5=' + vol_5 + '&vol_6=' + vol_6 + '&vol_7=' + vol_7 + '&wtr_1=' + wtr_1 + '&wtr_2=' + wtr_2 + '&wtr_3=' + wtr_3 + '&wtr_4=' + wtr_4 + '&wtr_5=' + wtr_5 + '&wtr_6=' + wtr_6 + '&wtr_7=' + wtr_7 + '&reading_1=' + reading_1 + '&reading_2=' + reading_2 + '&reading_3=' + reading_3 + '&reading_4=' + reading_4 + '&reading_5=' + reading_5 + '&reading_6=' + reading_6 + '&reading_7=' + reading_7 + '&remark_1=' + remark_1 + '&remark_2=' + remark_2 + '&remark_3=' + remark_3 + '&remark_4=' + remark_4 + '&remark_5=' + remark_5 + '&remark_6=' + remark_6 + '&remark_7=' + remark_7 + '&final_consistency=' + final_consistency + '&consistency_of_cement=' + consistency_of_cement + '&chk_fines=' + chk_fines + '&den_date_test=' + den_date_test + '&fine_temp=' + fine_temp + '&fine_humidity=' + fine_humidity + '&fbs_w1=' + fbs_w1 + '&fbs_w2=' + fbs_w2 + '&fbs_m1=' + fbs_m1 + '&fbs_m2=' + fbs_m2 + '&fbs_p1=' + fbs_p1 + '&fbs_p2=' + fbs_p2 + '&avg_fbs=' + avg_fbs + '&ss_area=' + ss_area + '&ss_sample=' + ss_sample + '&gs_sample=' + gs_sample + '&ps_bed=' + ps_bed + '&fs_e3=' + fs_e3 + '&tts_sample=' + tts_sample + '&por_sample_bed=' + por_sample_bed + '&sample_e3=' + sample_e3 + '&tt1=' + tt1 + '&constant_k=' + constant_k + '&den_cement=' + den_cement + '&den_intial=' + den_intial + '&den_final=' + den_final + '&density=' + density + '&mass=' + mass + '&x=' + x + '&v=' + v + '&p=' + p + '&fines_t_1=' + fines_t_1 + '&fines_t_2=' + fines_t_2 + '&fines_t_3=' + fines_t_3 + '&fines_t_4=' + fines_t_4 + '&avg_fines_time=' + avg_fines_time + '&chk_com=' + chk_com + '&com_date_test=' + com_date_test + '&com_temp=' + com_temp + '&com_humidity=' + com_humidity + '&weight_of_cement=' + weight_of_cement + '&weight_of_sand=' + weight_of_sand + '&weight_of_water=' + weight_of_water + '&sp_1=' + sp_1 + '&sp_2=' + sp_2 + '&sp_3=' + sp_3 + '&sp_4=' + sp_4 + '&caste_date1=' + caste_date1 + '&caste_date2=' + caste_date2 + '&caste_date3=' + caste_date3 + '&caste_date4=' + caste_date4 + '&caste_time1=' + caste_time1 + '&caste_time2=' + caste_time2 + '&caste_time3=' + caste_time3 + '&caste_time4=' + caste_time4 + '&test_date1=' + test_date1 + '&test_date2=' + test_date2 + '&test_date3=' + test_date3 + '&test_date4=' + test_date4 + '&test_time1=' + test_time1 + '&test_time2=' + test_time2 + '&test_time3=' + test_time3 + '&test_time4=' + test_time4 + '&day_1=' + day_1 + '&day_2=' + day_2 + '&day_3=' + day_3 + '&day_4=' + day_4 + '&woc_1=' + woc_1 + '&woc_2=' + woc_2 + '&woc_3=' + woc_3 + '&woc_4=' + woc_4 + '&avg_com_1=' + avg_com_1 + '&avg_com_2=' + avg_com_2 + '&avg_com_3=' + avg_com_3 + '&avg_com_4=' + avg_com_4 + '&l1=' + l1 + '&l2=' + l2 + '&l3=' + l3 + '&l4=' + l4 + '&l5=' + l5 + '&l6=' + l6 + '&l7=' + l7 + '&l8=' + l8 + '&l9=' + l9 + '&l10=' + l10 + '&l11=' + l11 + '&l12=' + l12 + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&b4=' + b4 + '&b5=' + b5 + '&b6=' + b6 + '&b7=' + b7 + '&b8=' + b8 + '&b9=' + b9 + '&b10=' + b10 + '&b11=' + b11 + '&b12=' + b12 + '&area_1=' + area_1 + '&area_2=' + area_2 + '&area_3=' + area_3 + '&area_4=' + area_4 + '&area_5=' + area_5 + '&area_6=' + area_6 + '&area_7=' + area_7 + '&area_8=' + area_8 + '&area_9=' + area_9 + '&area_10=' + area_10 + '&area_11=' + area_11 + '&area_12=' + area_12 + '&load_1=' + load_1 + '&load_2=' + load_2 + '&load_3=' + load_3 + '&load_4=' + load_4 + '&load_5=' + load_5 + '&load_6=' + load_6 + '&load_7=' + load_7 + '&load_8=' + load_8 + '&load_9=' + load_9 + '&load_10=' + load_10 + '&load_11=' + load_11 + '&load_12=' + load_12 + '&com_1=' + com_1 + '&com_2=' + com_2 + '&com_3=' + com_3 + '&com_4=' + com_4 + '&com_5=' + com_5 + '&com_6=' + com_6 + '&com_7=' + com_7 + '&com_8=' + com_8 + '&com_9=' + com_9 + '&com_10=' + com_10 + '&com_11=' + com_11 + '&com_12=' + com_12 + '&com_humidity1=' + com_humidity1 + '&com_humidity2=' + com_humidity2 + '&com_humidity3=' + com_humidity3 + '&com_temp1=' + com_temp1 + '&com_temp2=' + com_temp2 + '&com_temp3=' + com_temp3 + '&chk_mou=' + chk_mou + '&in_w1=' + in_w1 + '&in_w2=' + in_w2 + '&fn_w1=' + fn_w1 + '&fn_w2=' + fn_w2 + '&mo1=' + mo1 + '&mo2=' + mo2 + '&avg_mo=' + avg_mo + '&makes=' + makes + '&brand=' + brand + '&cement_grade=' + cement_grade + '&type_of_cement=' + type_of_cement + '&chk_sou=' + chk_sou + '&sou_date_test=' + sou_date_test + '&sou_humidity=' + sou_humidity + '&sou_temp=' + sou_temp + '&sou_water=' + sou_water + '&sou_weight=' + sou_weight + '&soundness=' + soundness + '&dis_1_1=' + dis_1_1 + '&dis_1_2=' + dis_1_2 + '&dis_2_1=' + dis_2_1 + '&dis_2_2=' + dis_2_2 + '&diff_1=' + diff_1 + '&diff_2=' + diff_2 + '&chk_set=' + chk_set + '&set_date_test=' + set_date_test + '&set_weight=' + set_weight + '&set_temp=' + set_temp + '&set_wtr=' + set_wtr + '&set_humidity=' + set_humidity + '&hr_a=' + hr_a + '&hr_b=' + hr_b + '&hr_c=' + hr_c + '&initial_time=' + initial_time + '&final_time=' + final_time;




		} else if (type == 'edit') {

			var report_no = $('#report_no').val();
			var makes = $('#makes').val();
			var brand = $('#brand').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var report_date = $('#report_date').val();
			var ulr = $('#ulr').val();
			var cement_grade = $('#cement_grade').val();
			var type_of_cement = $('#type_of_cement').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//Consistency
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "con") {
					if (document.getElementById('chk_con').checked) {
						var chk_con = "1";
					} else {
						var chk_con = "0";
					}

					var con_date_test = $('#con_date_test').val();
					var con_temp = $('#con_temp').val();
					var con_humidity = $('#con_humidity').val();
					var con_weight = $('#con_weight').val();
					var vol_1 = $('#vol_1').val();
					var vol_2 = $('#vol_2').val();
					var vol_3 = $('#vol_3').val();
					var vol_4 = $('#vol_4').val();
					var vol_5 = $('#vol_5').val();
					var vol_6 = $('#vol_6').val();
					var vol_7 = $('#vol_7').val();

					var wtr_1 = $('#wtr_1').val();
					var wtr_2 = $('#wtr_2').val();
					var wtr_3 = $('#wtr_3').val();
					var wtr_4 = $('#wtr_4').val();
					var wtr_5 = $('#wtr_5').val();
					var wtr_6 = $('#wtr_6').val();
					var wtr_7 = $('#wtr_7').val();

					var reading_1 = $('#reading_1').val();
					var reading_2 = $('#reading_2').val();
					var reading_3 = $('#reading_3').val();
					var reading_4 = $('#reading_4').val();
					var reading_5 = $('#reading_5').val();
					var reading_6 = $('#reading_6').val();
					var reading_7 = $('#reading_7').val();

					var remark_1 = $('#remark_1').val();
					var remark_2 = $('#remark_2').val();
					var remark_3 = $('#remark_3').val();
					var remark_4 = $('#remark_4').val();
					var remark_5 = $('#remark_5').val();
					var remark_6 = $('#remark_6').val();
					var remark_7 = $('#remark_7').val();
					var final_consistency = $('#final_consistency').val();
					var consistency_of_cement = $('#consistency_of_cement').val();
					break;
				} else {
					var chk_con = "0";
					var con_date_test = "00/00/0000";
					var con_temp = "0";
					var con_humidity = "0";
					var con_weight = "0";
					var vol_1 = "0";
					var vol_2 = "0";
					var vol_3 = "0";
					var vol_4 = "0";
					var vol_5 = "0";
					var vol_6 = "0";
					var vol_7 = "0";

					var wtr_1 = "0";
					var wtr_2 = "0";
					var wtr_3 = "0";
					var wtr_4 = "0";
					var wtr_5 = "0";
					var wtr_6 = "0";
					var wtr_7 = "0";

					var reading_1 = "0";
					var reading_2 = "0";
					var reading_3 = "0";
					var reading_4 = "0";
					var reading_5 = "0";
					var reading_6 = "0";
					var reading_7 = "0";

					var remark_1 = "0";
					var remark_2 = "0";
					var remark_3 = "0";
					var remark_4 = "0";
					var remark_5 = "0";
					var remark_6 = "0";
					var remark_7 = "0";
					var final_consistency = "0";
					var consistency_of_cement = "";

				}

			}


			//finness by blaine 
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "fin") {
					if (document.getElementById('chk_fines').checked) {
						var chk_fines = "1";
					} else {
						var chk_fines = "0";
					}
					var fbs_w1 = $('#fbs_w1').val();
					var fbs_w2 = $('#fbs_w2').val();

					var fbs_m1 = $('#fbs_m1').val();
					var fbs_m2 = $('#fbs_m2').val();

					var fbs_p1 = $('#fbs_p1').val();
					var fbs_p2 = $('#fbs_p2').val();
					var avg_fbs = $('#avg_fbs').val();

					var den_date_test = $('#den_date_test').val();
					var fine_temp = $('#fine_temp').val();
					var fine_humidity = $('#fine_humidity').val();
					var den_intial = $('#den_intial').val();
					var den_final = $('#den_final').val();
					var density = $('#density').val();
					var den_cement = $('#den_cement').val();
					var mass = $('#mass').val();
					var x = $('#x').val();
					var v = $('#v').val();
					var p = $('#p').val();
					var ss_area = $('#ss_area').val();

					var ss_sample = $('#ss_sample').val();
					var gs_sample = $('#gs_sample').val();
					var ps_bed = $('#ps_bed').val();
					var fs_e3 = $('#fs_e3').val();
					var tts_sample = $('#tts_sample').val();
					var por_sample_bed = $('#por_sample_bed').val();
					var sample_e3 = $('#sample_e3').val();
					var tt1 = $('#tt1').val();

					var fines_t_1 = $('#fines_t_1').val();
					var fines_t_2 = $('#fines_t_2').val();
					var fines_t_3 = $('#fines_t_3').val();
					var fines_t_4 = $('#fines_t_4').val();
					var avg_fines_time = $('#avg_fines_time').val();
					var constant_k = $('#constant_k').val();

					break;
				} else {
					var chk_fines = "0";
					var den_date_test = "00/00/0000";
					var fine_temp = "0";
					var fine_humidity = "0";
					var fbs_w1 = "";
					var fbs_w2 = "";

					var fbs_m1 = "";
					var fbs_m2 = "";

					var fbs_p1 = "";
					var fbs_p2 = "";
					var avg_fbs = "";
					var den_intial = "0";
					var den_final = "0";
					var density = "0";
					var den_cement = "0";
					var mass = "0";
					var x = "0";
					var v = "0";
					var p = "0";
					var ss_area = "0";
					var ss_sample = "0";
					var gs_sample = "0";
					var ps_bed = "0";
					var fs_e3 = "0";
					var tts_sample = "0";
					var por_sample_bed = "0";
					var sample_e3 = "0";
					var tt1 = "0";
					var fines_t_1 = "0";
					var fines_t_2 = "0";
					var fines_t_3 = "0";
					var fines_t_4 = "0";
					var avg_fines_time = "0";
					var constant_k = "0";
				}

			}

			//chk_mou
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "mou") {
					if (document.getElementById('chk_mou').checked) {
						var chk_mou = "1";
					} else {
						var chk_mou = "0";
					}
					var in_w1 = $('#in_w1').val();
					var in_w2 = $('#in_w2').val();

					var fn_w1 = $('#fn_w1').val();
					var fn_w2 = $('#fn_w2').val();

					var fbs_m1 = $('#fbs_m1').val();
					var fbs_m2 = $('#fbs_m2').val();

					var mo1 = $('#mo1').val();
					var mo2 = $('#mo2').val();
					var avg_mo = $('#avg_mo').val();


					break;
				} else {
					var chk_mou = "0";
					var in_w1 = "0";
					var in_w2 = "0";

					var fn_w1 = "0";
					var fn_w2 = "0";

					var fbs_m1 = "0";
					var fbs_m2 = "0";

					var mo1 = "0";
					var mo2 = "0";
					var avg_mo = "0";

				}

			}



			//Compressive
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "com") {
					if (document.getElementById('chk_com').checked) {
						var chk_com = "1";
					} else {
						var chk_com = "0";
					}


					var com_date_test = $('#com_date_test').val();
					var com_temp = $('#com_temp').val();
					var com_temp1 = $('#com_temp1').val();
					var com_temp2 = $('#com_temp2').val();
					var com_temp3 = $('#com_temp3').val();
					var com_humidity = $('#com_humidity').val();
					var com_humidity1 = $('#com_humidity1').val();
					var com_humidity2 = $('#com_humidity2').val();
					var com_humidity3 = $('#com_humidity3').val();
					var weight_of_cement = $('#weight_of_cement').val();
					var weight_of_sand = $('#weight_of_sand').val();
					var weight_of_water = $('#weight_of_water').val();
					var sp_1 = $('#sp_1').val();
					var sp_2 = $('#sp_2').val();
					var sp_3 = $('#sp_3').val();
					var sp_4 = $('#sp_4').val();
					var caste_date1 = $('#caste_date1').val();
					var caste_date2 = $('#caste_date2').val();
					var caste_date3 = $('#caste_date3').val();
					var caste_date4 = $('#caste_date4').val();
					var caste_time1 = $('#caste_time1').val();
					var caste_time2 = $('#caste_time2').val();
					var caste_time3 = $('#caste_time3').val();
					var caste_time4 = $('#caste_time4').val();
					var test_date1 = $('#test_date1').val();
					var test_date2 = $('#test_date2').val();
					var test_date3 = $('#test_date3').val();
					var test_date4 = $('#test_date4').val();
					var test_time1 = $('#test_time1').val();
					var test_time2 = $('#test_time2').val();
					var test_time3 = $('#test_time3').val();
					var test_time4 = $('#test_time4').val();
					var day_1 = $('#day_1').val();
					var day_2 = $('#day_2').val();
					var day_3 = $('#day_3').val();
					var day_4 = $('#day_4').val();
					var woc_1 = $('#woc_1').val();
					var woc_2 = $('#woc_2').val();
					var woc_3 = $('#woc_3').val();
					var woc_4 = $('#woc_4').val();
					var avg_com_1 = $('#avg_com_1').val();
					var avg_com_2 = $('#avg_com_2').val();
					var avg_com_3 = $('#avg_com_3').val();
					var avg_com_4 = $('#avg_com_4').val();
					var l1 = $('#l1').val();
					var l2 = $('#l2').val();
					var l3 = $('#l3').val();
					var l4 = $('#l4').val();
					var l5 = $('#l5').val();
					var l6 = $('#l6').val();
					var l7 = $('#l7').val();
					var l8 = $('#l8').val();
					var l9 = $('#l9').val();
					var l10 = $('#l10').val();
					var l11 = $('#l11').val();
					var l12 = $('#l12').val();

					var b1 = $('#b1').val();
					var b2 = $('#b2').val();
					var b3 = $('#b3').val();
					var b4 = $('#b4').val();
					var b5 = $('#b5').val();
					var b6 = $('#b6').val();
					var b7 = $('#b7').val();
					var b8 = $('#b8').val();
					var b9 = $('#b9').val();
					var b10 = $('#b10').val();
					var b11 = $('#b11').val();
					var b12 = $('#b12').val();



					var area_1 = $('#area_1').val();
					var area_2 = $('#area_2').val();
					var area_3 = $('#area_3').val();
					var area_4 = $('#area_4').val();
					var area_5 = $('#area_5').val();
					var area_6 = $('#area_6').val();
					var area_7 = $('#area_7').val();
					var area_8 = $('#area_8').val();
					var area_9 = $('#area_9').val();
					var area_10 = $('#area_10').val();
					var area_11 = $('#area_11').val();
					var area_12 = $('#area_12').val();

					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();
					var load_4 = $('#load_4').val();
					var load_5 = $('#load_5').val();
					var load_6 = $('#load_6').val();
					var load_7 = $('#load_7').val();
					var load_8 = $('#load_8').val();
					var load_9 = $('#load_9').val();
					var load_10 = $('#load_10').val();
					var load_11 = $('#load_11').val();
					var load_12 = $('#load_12').val();

					var com_1 = $('#com_1').val();
					var com_2 = $('#com_2').val();
					var com_3 = $('#com_3').val();
					var com_4 = $('#com_4').val();
					var com_5 = $('#com_5').val();
					var com_6 = $('#com_6').val();
					var com_7 = $('#com_7').val();
					var com_8 = $('#com_8').val();
					var com_9 = $('#com_9').val();
					var com_10 = $('#com_10').val();
					var com_11 = $('#com_11').val();
					var com_12 = $('#com_12').val();
					break;
				} else {
					var chk_com = "0";
					/* var chk_chk3 = "0";	
					var chk_chk2 = "0";	
					var chk_chk1 = "0"; */
					var com_date_test = "0";
					var com_temp = "0";
					var com_temp1 = "0";
					var com_temp2 = "0";
					var com_temp3 = "0";
					var com_humidity = "0";
					var com_humidity1 = "0";
					var com_humidity2 = "0";
					var com_humidity3 = "0";
					var weight_of_cement = "0";
					var weight_of_sand = "0";
					var weight_of_water = "0";
					var sp_1 = "0";
					var sp_2 = "0";
					var sp_3 = "0";
					var sp_4 = "0";
					var caste_date1 = "00/00/0000";
					var caste_date2 = "00/00/0000";
					var caste_date3 = "00/00/0000";
					var caste_date4 = "00/00/0000";
					var caste_time1 = "00:00";
					var caste_time2 = "00:00";
					var caste_time3 = "00:00";
					var caste_time4 = "00:00";
					var test_date1 = "00/00/0000";
					var test_date2 = "00/00/0000";
					var test_date3 = "00/00/0000";
					var test_date4 = "00/00/0000";
					var test_time1 = "00:00";
					var test_time2 = "00:00";
					var test_time3 = "00:00";
					var test_time4 = "00:00";
					var day_1 = "0";
					var day_2 = "0";
					var day_3 = "0";
					var day_4 = "0";

					var woc_1 = "0";
					var woc_2 = "0";
					var woc_3 = "0";
					var woc_4 = "0";

					var avg_com_1 = "0";
					var avg_com_2 = "0";
					var avg_com_3 = "0";
					var avg_com_4 = "0";
					var l1 = "0";
					var l2 = "0";
					var l3 = "0";
					var l4 = "0";
					var l5 = "0";
					var l6 = "0";
					var l7 = "0";
					var l8 = "0";
					var l9 = "0";
					var l10 = "0";
					var l11 = "0";
					var l12 = "0";

					var b1 = "0";
					var b2 = "0";
					var b3 = "0";
					var b4 = "0";
					var b5 = "0";
					var b6 = "0";
					var b7 = "0";
					var b8 = "0";
					var b9 = "0";
					var b10 = "0";
					var b11 = "0";
					var b12 = "0";


					var area_1 = "0";
					var area_2 = "0";
					var area_3 = "0";
					var area_4 = "0";
					var area_5 = "0";
					var area_6 = "0";
					var area_7 = "0";
					var area_8 = "0";
					var area_9 = "0";
					var area_10 = "0";
					var area_11 = "0";
					var area_12 = "0";

					var load_1 = "0";
					var load_2 = "0";
					var load_3 = "0";
					var load_4 = "0";
					var load_5 = "0";
					var load_6 = "0";
					var load_7 = "0";
					var load_8 = "0";
					var load_9 = "0";
					var load_10 = "0";
					var load_11 = "0";
					var load_12 = "0";

					var com_1 = "0";
					var com_2 = "0";
					var com_3 = "0";
					var com_4 = "0";
					var com_5 = "0";
					var com_6 = "0";
					var com_7 = "0";
					var com_8 = "0";
					var com_9 = "0";
					var com_10 = "0";
					var com_11 = "0";
					var com_12 = "0";
				}

			}

	//soundness
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sou") {
					if (document.getElementById('chk_sou').checked) {
						var chk_sou = "1";
					} else {
						var chk_sou = "0";
					}
					var sou_date_test = $('#sou_date_test').val();
					var sou_temp = $('#sou_temp').val();
					var sou_humidity = $('#sou_humidity').val();
					var sou_water = $('#sou_water').val();
					var sou_weight = $('#sou_weight').val();
					var dis_1_1 = $('#dis_1_1').val();
					var dis_1_2 = $('#dis_1_2').val();
					var dis_2_1 = $('#dis_2_1').val();
					var dis_2_2 = $('#dis_2_2').val();
					var diff_1 = $('#diff_1').val();
					var diff_2 = $('#diff_2').val();
					var soundness = $('#soundness').val();
					var sou_s_d = $('#sou_s_d').val();
					var sou_e_d = $('#sou_e_d').val();

					var sou_test_method = $('#sou_test_method').val();
					var sou_test_req = $('#sou_test_req').val();
					var sou_test_limit_1 = $('#sou_test_limit_1').val();
					var sou_test_limit_2 = $('#sou_test_limit_2').val();
					break;
				} else {

					var chk_sou = "0";
					var sou_date_test = "00/00/0000";
					var sou_temp = "0";
					var sou_humidity = "0";
					var sou_water = "0";
					var sou_weight = "0";
					var dis_1_1 = "0";
					var dis_1_2 = "0";
					var dis_2_1 = "0";
					var dis_2_2 = "0";
					var diff_1 = "0";
					var diff_2 = "0";
					var soundness = "0";
					var sou_s_d = "";
					var sou_e_d = "";

					var sou_test_method = "";
					var sou_test_req = "";
					var sou_test_limit_1 = "";
					var sou_test_limit_2 = "";
				}

			}


			//Setting Time
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "set") {
					if (document.getElementById('chk_set').checked) {
						var chk_set = "1";
					} else {
						var chk_set = "0";
					}
					var set_date_test = $('#set_date_test').val();
					var set_temp = $('#set_temp').val();
					var set_wtr = $('#set_wtr').val();
					var set_humidity = $('#set_humidity').val();
					var hr_a = $('#hr_a').val();
					var hr_b = $('#hr_b').val();
					var hr_c = $('#hr_c').val();
					var initial_time = $('#initial_time').val();
					var final_time = $('#final_time').val();
					var set_weight = $('#set_weight').val();
					var set_s_d = $('#set_s_d').val();
					var set_e_d = $('#set_e_d').val();

					var set_test_method = $('#set_test_method').val();
					var set_test_req = $('#set_test_req').val();
					var set_test_limit_1 = $('#set_test_limit_1').val();
					var set_test_limit_2 = $('#set_test_limit_2').val();
					break;
				} else {
					var chk_set = "0";
					var set_date_test = "00/00/0000";
					var set_temp = "0";
					var set_wtr = "0";
					var set_humidity = "0";
					var hr_a = "0";
					var hr_b = "0";
					var hr_c = "0";
					var initial_time = "0";
					var final_time = "0";
					var set_weight = "0";
					var set_s_d = "";
					var set_e_d = "";

					var set_test_method = "";
					var set_test_req = "";
					var set_test_limit_1 = "";
					var set_test_limit_2 = "";
				}

			}




			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&ulr=' + ulr + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_con=' + chk_con + '&con_date_test=' + con_date_test + '&report_date=' + report_date + '&con_temp=' + con_temp + '&con_humidity=' + con_humidity + '&con_weight=' + con_weight + '&vol_1=' + vol_1 + '&vol_2=' + vol_2 + '&vol_3=' + vol_3 + '&vol_4=' + vol_4 + '&vol_5=' + vol_5 + '&vol_6=' + vol_6 + '&vol_7=' + vol_7 + '&wtr_1=' + wtr_1 + '&wtr_2=' + wtr_2 + '&wtr_3=' + wtr_3 + '&wtr_4=' + wtr_4 + '&wtr_5=' + wtr_5 + '&wtr_6=' + wtr_6 + '&wtr_7=' + wtr_7 + '&reading_1=' + reading_1 + '&reading_2=' + reading_2 + '&reading_3=' + reading_3 + '&reading_4=' + reading_4 + '&reading_5=' + reading_5 + '&reading_6=' + reading_6 + '&reading_7=' + reading_7 + '&remark_1=' + remark_1 + '&remark_2=' + remark_2 + '&remark_3=' + remark_3 + '&remark_4=' + remark_4 + '&remark_5=' + remark_5 + '&remark_6=' + remark_6 + '&remark_7=' + remark_7 + '&final_consistency=' + final_consistency + '&consistency_of_cement=' + consistency_of_cement + '&chk_fines=' + chk_fines + '&den_date_test=' + den_date_test + '&fine_temp=' + fine_temp + '&fine_humidity=' + fine_humidity + '&fbs_w1=' + fbs_w1 + '&fbs_w2=' + fbs_w2 + '&fbs_m1=' + fbs_m1 + '&fbs_m2=' + fbs_m2 + '&fbs_p1=' + fbs_p1 + '&fbs_p2=' + fbs_p2 + '&avg_fbs=' + avg_fbs + '&ss_area=' + ss_area + '&ss_sample=' + ss_sample + '&gs_sample=' + gs_sample + '&ps_bed=' + ps_bed + '&fs_e3=' + fs_e3 + '&tts_sample=' + tts_sample + '&por_sample_bed=' + por_sample_bed + '&sample_e3=' + sample_e3 + '&tt1=' + tt1 + '&constant_k=' + constant_k + '&den_cement=' + den_cement + '&den_intial=' + den_intial + '&den_final=' + den_final + '&density=' + density + '&mass=' + mass + '&x=' + x + '&v=' + v + '&p=' + p + '&fines_t_1=' + fines_t_1 + '&fines_t_2=' + fines_t_2 + '&fines_t_3=' + fines_t_3 + '&fines_t_4=' + fines_t_4 + '&avg_fines_time=' + avg_fines_time + '&chk_com=' + chk_com + '&com_date_test=' + com_date_test + '&com_temp=' + com_temp + '&com_humidity=' + com_humidity + '&weight_of_cement=' + weight_of_cement + '&weight_of_sand=' + weight_of_sand + '&weight_of_water=' + weight_of_water + '&sp_1=' + sp_1 + '&sp_2=' + sp_2 + '&sp_3=' + sp_3 + '&sp_4=' + sp_4 + '&caste_date1=' + caste_date1 + '&caste_date2=' + caste_date2 + '&caste_date3=' + caste_date3 + '&caste_date4=' + caste_date4 + '&caste_time1=' + caste_time1 + '&caste_time2=' + caste_time2 + '&caste_time3=' + caste_time3 + '&caste_time4=' + caste_time4 + '&test_date1=' + test_date1 + '&test_date2=' + test_date2 + '&test_date3=' + test_date3 + '&test_date4=' + test_date4 + '&test_time1=' + test_time1 + '&test_time2=' + test_time2 + '&test_time3=' + test_time3 + '&test_time4=' + test_time4 + '&day_1=' + day_1 + '&day_2=' + day_2 + '&day_3=' + day_3 + '&day_4=' + day_4 + '&woc_1=' + woc_1 + '&woc_2=' + woc_2 + '&woc_3=' + woc_3 + '&woc_4=' + woc_4 + '&avg_com_1=' + avg_com_1 + '&avg_com_2=' + avg_com_2 + '&avg_com_3=' + avg_com_3 + '&avg_com_4=' + avg_com_4 + '&l1=' + l1 + '&l2=' + l2 + '&l3=' + l3 + '&l4=' + l4 + '&l5=' + l5 + '&l6=' + l6 + '&l7=' + l7 + '&l8=' + l8 + '&l9=' + l9 + '&l10=' + l10 + '&l11=' + l11 + '&l12=' + l12 + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&b4=' + b4 + '&b5=' + b5 + '&b6=' + b6 + '&b7=' + b7 + '&b8=' + b8 + '&b9=' + b9 + '&b10=' + b10 + '&b11=' + b11 + '&b12=' + b12 + '&area_1=' + area_1 + '&area_2=' + area_2 + '&area_3=' + area_3 + '&area_4=' + area_4 + '&area_5=' + area_5 + '&area_6=' + area_6 + '&area_7=' + area_7 + '&area_8=' + area_8 + '&area_9=' + area_9 + '&area_10=' + area_10 + '&area_11=' + area_11 + '&area_12=' + area_12 + '&load_1=' + load_1 + '&load_2=' + load_2 + '&load_3=' + load_3 + '&load_4=' + load_4 + '&load_5=' + load_5 + '&load_6=' + load_6 + '&load_7=' + load_7 + '&load_8=' + load_8 + '&load_9=' + load_9 + '&load_10=' + load_10 + '&load_11=' + load_11 + '&load_12=' + load_12 + '&com_1=' + com_1 + '&com_2=' + com_2 + '&com_3=' + com_3 + '&com_4=' + com_4 + '&com_5=' + com_5 + '&com_6=' + com_6 + '&com_7=' + com_7 + '&com_8=' + com_8 + '&com_9=' + com_9 + '&com_10=' + com_10 + '&com_11=' + com_11 + '&com_12=' + com_12 + '&com_humidity1=' + com_humidity1 + '&com_humidity2=' + com_humidity2 + '&com_humidity3=' + com_humidity3 + '&com_temp1=' + com_temp1 + '&com_temp2=' + com_temp2 + '&com_temp3=' + com_temp3 + '&chk_mou=' + chk_mou + '&in_w1=' + in_w1 + '&in_w2=' + in_w2 + '&fn_w1=' + fn_w1 + '&fn_w2=' + fn_w2 + '&mo1=' + mo1 + '&mo2=' + mo2 + '&avg_mo=' + avg_mo + '&makes=' + makes + '&brand=' + brand + '&cement_grade=' + cement_grade + '&type_of_cement=' + type_of_cement + '&chk_sou=' + chk_sou + '&sou_date_test=' + sou_date_test + '&sou_humidity=' + sou_humidity + '&sou_temp=' + sou_temp + '&sou_water=' + sou_water + '&sou_weight=' + sou_weight + '&soundness=' + soundness + '&dis_1_1=' + dis_1_1 + '&dis_1_2=' + dis_1_2 + '&dis_2_1=' + dis_2_1 + '&dis_2_2=' + dis_2_2 + '&diff_1=' + diff_1 + '&diff_2=' + diff_2 + '&chk_set=' + chk_set + '&set_date_test=' + set_date_test + '&set_weight=' + set_weight + '&set_temp=' + set_temp + '&set_wtr=' + set_wtr + '&set_humidity=' + set_humidity + '&hr_a=' + hr_a + '&hr_b=' + hr_b + '&hr_c=' + hr_c + '&initial_time=' + initial_time + '&final_time=' + final_time;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_flyash.php',
			data: billData,
			dataType: 'JSON',
			success: function(msg) {

				$('#btn_save').hide();
				getGlazedTiles();
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				//window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;

			}
		});
	}

	function editData(id) {
		var lab_no = $('#lab_no').val();
		var report_no = $('#report_no').val();
		var job_no = $('#job_no').val();
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: '<?php echo $base_url; ?>save_flyash.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);


				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#makes').val(data.makes);
				$('#brand').val(data.brand);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);
				$('#report_date').val(data.report_date);
				$('#cement_grade').val(data.cement_grade);
				$('#type_of_cement').val(data.type_of_cement);
				$('#ulr').val(data.ulr);
				var temp = $('#test_list').val();
				var aa = temp.split(",");

				//Consistency
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "con") {

						var chk_con = data.chk_con;
						if (chk_con == "1") {
							$('#consis').css("background-color", "var(--primary)");
							$("#chk_con").prop("checked", true);
						} else {
							$('#consis').css("background-color", "white");
							$("#chk_con").prop("checked", false);
						}

						$('#con_date_test').val(data.con_date_test);
						$('#con_temp').val(data.con_temp);
						$('#con_humidity').val(data.con_humidity);
						$('#con_weight').val(data.con_weight);
						$('#final_consistency').val(data.final_consistency);
						$('#consistency_of_cement').val(data.consistency_of_cement);
						$('#vol_1').val(data.vol_1);
						$('#vol_2').val(data.vol_2);
						$('#vol_3').val(data.vol_3);
						$('#vol_4').val(data.vol_4);
						$('#vol_5').val(data.vol_5);
						$('#vol_6').val(data.vol_6);
						$('#vol_7').val(data.vol_7);

						$('#wtr_1').val(data.wtr_1);
						$('#wtr_2').val(data.wtr_2);
						$('#wtr_3').val(data.wtr_3);
						$('#wtr_4').val(data.wtr_4);
						$('#wtr_5').val(data.wtr_5);
						$('#wtr_6').val(data.wtr_6);
						$('#wtr_7').val(data.wtr_7);

						$('#reading_1').val(data.reading_1);
						$('#reading_2').val(data.reading_2);
						$('#reading_3').val(data.reading_3);
						$('#reading_4').val(data.reading_4);
						$('#reading_5').val(data.reading_5);
						$('#reading_6').val(data.reading_6);
						$('#reading_7').val(data.reading_7);

						$('#remark_1').val(data.remark_1);
						$('#remark_2').val(data.remark_2);
						$('#remark_3').val(data.remark_3);
						$('#remark_4').val(data.remark_4);
						$('#remark_5').val(data.remark_5);
						$('#remark_6').val(data.remark_6);
						$('#remark_7').val(data.remark_7);

						break;
					} else {

					}

				}

				//soundness
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sou") {

						var chk_sou = data.chk_sou;
						if (chk_sou == "1") {
							$('#sound').css("background-color", "var(--primary)");
							$("#chk_sou").prop("checked", true);
						} else {
							$('#sound').css("background-color", "white");
							$("#chk_sou").prop("checked", false);
						}

						$('#sou_date_test').val(data.sou_date_test);
						$('#sou_temp').val(data.sou_temp);
						$('#sou_humidity').val(data.sou_humidity);
						$('#sou_weight').val(data.sou_weight);
						$('#sou_water').val(data.sou_water);
						$('#dis_1_1').val(data.dis_1_1);
						$('#dis_1_2').val(data.dis_1_2);
						$('#dis_2_1').val(data.dis_2_1);
						$('#dis_2_2').val(data.dis_2_2);
						$('#diff_1').val(data.diff_1);
						$('#diff_2').val(data.diff_2);
						$('#soundness').val(data.soundness);
						$('#sou_s_d').val(data.sou_s_d);
						$('#sou_e_d').val(data.sou_e_d);

					
						break;
					} else {

					}

				}

				//setting time
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "set") {

						var chk_set = data.chk_set;
						if (chk_set == "1") {
							$('#sett').css("background-color", "var(--primary)");
							$("#chk_set").prop("checked", true);
						} else {
							$('#sett').css("background-color", "white");
							$("#chk_set").prop("checked", false);
						}

						$('#set_date_test').val(data.set_date_test);
						$('#set_temp').val(data.set_temp);
						$('#set_humidity').val(data.set_humidity);
						$('#set_wtr').val(data.set_wtr);
						$('#hr_a').val(data.hr_a);
						$('#hr_b').val(data.hr_b);
						$('#hr_c').val(data.hr_c);
						$('#initial_time').val(data.initial_time);
						$('#final_time').val(data.final_time);
						$('#set_weight').val(data.set_weight);
						$('#set_s_d').val(data.set_s_d);
						$('#set_e_d').val(data.set_e_d);


						break;
					} else {

					}

				}


				//fineness
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "fin") {

						var chk_fines = data.chk_fines;
						if (chk_fines == "1") {
							$('#fins').css("background-color", "var(--primary)");
							$("#chk_fines").prop("checked", true);
						} else {
							$('#fins').css("background-color", "white");
							$("#chk_fines").prop("checked", false);
						}
						$('#fbs_w1').val(data.fbs_w1);
						$('#fbs_w2').val(data.fbs_w2);
						$('#fbs_m1').val(data.fbs_m1);
						$('#fbs_m2').val(data.fbs_m2);
						$('#fbs_p1').val(data.fbs_p1);
						$('#fbs_p2').val(data.fbs_p2);
						$('#avg_fbs').val(data.avg_fbs);
						$('#den_date_test').val(data.den_date_test);
						$('#den_intial').val(data.den_intial);
						$('#den_cement').val(data.den_cement);
						$('#den_final').val(data.den_final);
						$('#density').val(data.density);
						$('#constant_k').val(data.constant_k);
						$('#fines_t_1').val(data.fines_t_1);
						$('#fines_t_2').val(data.fines_t_2);
						$('#fines_t_3').val(data.fines_t_3);
						$('#fines_t_4').val(data.fines_t_3);
						$('#avg_fines_time').val(data.avg_fines_time);
						$('#fine_temp').val(data.fine_temp);
						$('#fine_humidity').val(data.fine_humidity);
						$('#ss_area').val(data.ss_area);

						$('#ss_sample').val(data.ss_sample);
						$('#gs_sample').val(data.gs_sample);
						$('#ps_bed').val(data.ps_bed);
						$('#fs_e3').val(data.fs_e3);
						$('#tts_sample').val(data.tts_sample);
						$('#por_sample_bed').val(data.por_sample_bed);
						$('#sample_e3').val(data.sample_e3);
						$('#tt1').val(data.tt1);

						$('#mass').val(data.mass);
						$('#x').val(data.x);
						$('#v').val(data.v);
						$('#p').val(data.p);

						break;
					} else {

					}

				}


				//compressive
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "com") {

						var chk_com = data.chk_com;

						if (chk_com == "1") {
							$('#comp').css("background-color", "var(--primary)");
							$("#chk_com").prop("checked", true);
						} else {
							$('#comp').css("background-color", "white");
							$("#chk_com").prop("checked", false);
						}

						$('#com_date_test').val(data.com_date_test);
						$('#com_temp').val(data.com_temp);
						$('#com_temp1').val(data.com_temp1);
						$('#com_temp2').val(data.com_temp2);
						$('#com_temp3').val(data.com_temp3);
						$('#com_humidity').val(data.com_humidity);
						$('#com_humidity1').val(data.com_humidity1);
						$('#com_humidity2').val(data.com_humidity2);
						$('#com_humidity3').val(data.com_humidity3);
						$('#weight_of_cement').val(data.weight_of_cement);
						$('#weight_of_sand').val(data.weight_of_sand);
						$('#weight_of_water').val(data.weight_of_water);
						$('#sp_1').val(data.sp_1);
						$('#sp_2').val(data.sp_2);
						$('#sp_3').val(data.sp_3);
						$('#sp_4').val(data.sp_4);
						$('#caste_date1').val(data.caste_date1);
						$('#caste_date2').val(data.caste_date2);
						$('#caste_date3').val(data.caste_date3);
						$('#caste_date4').val(data.caste_date4);
						$('#caste_time1').val(data.caste_time1);
						$('#caste_time2').val(data.caste_time2);
						$('#caste_time3').val(data.caste_time3);
						$('#caste_time4').val(data.caste_time4);
						$('#test_date1').val(data.test_date1);
						$('#test_date2').val(data.test_date2);
						$('#test_date3').val(data.test_date3);
						$('#test_date4').val(data.test_date4);
						$('#test_time1').val(data.test_time1);
						$('#test_time2').val(data.test_time2);
						$('#test_time3').val(data.test_time3);
						$('#test_time4').val(data.test_time4);
						$('#day_1').val(data.day_1);
						$('#day_2').val(data.day_2);
						$('#day_3').val(data.day_3);
						$('#day_4').val(data.day_4);
						$('#woc_1').val(data.woc_1);
						$('#woc_2').val(data.woc_2);
						$('#woc_3').val(data.woc_3);
						$('#woc_4').val(data.woc_4);



						$('#l1').val(data.l1);
						$('#l2').val(data.l2);
						$('#l3').val(data.l3);
						$('#l4').val(data.l4);
						$('#l5').val(data.l5);
						$('#l6').val(data.l6);
						$('#l7').val(data.l7);
						$('#l8').val(data.l8);
						$('#l9').val(data.l9);
						$('#l10').val(data.l10);
						$('#l11').val(data.l11);
						$('#l12').val(data.l12);

						$('#b1').val(data.b1);
						$('#b2').val(data.b2);
						$('#b3').val(data.b3);
						$('#b4').val(data.b4);
						$('#b5').val(data.b5);
						$('#b6').val(data.b6);
						$('#b7').val(data.b7);
						$('#b8').val(data.b8);
						$('#b9').val(data.b9);
						$('#b10').val(data.b10);
						$('#b11').val(data.b11);
						$('#b12').val(data.b12);


						$('#area_1').val(data.area_1);
						$('#area_2').val(data.area_2);
						$('#area_3').val(data.area_3);
						$('#area_4').val(data.area_4);
						$('#area_5').val(data.area_5);
						$('#area_6').val(data.area_6);
						$('#area_7').val(data.area_7);
						$('#area_8').val(data.area_8);
						$('#area_9').val(data.area_9);
						$('#area_10').val(data.area_10);
						$('#area_11').val(data.area_11);
						$('#area_12').val(data.area_12);

						$('#load_1').val(data.load_1);
						$('#load_2').val(data.load_2);
						$('#load_3').val(data.load_3);
						$('#load_4').val(data.load_4);
						$('#load_5').val(data.load_5);
						$('#load_6').val(data.load_6);
						$('#load_7').val(data.load_7);
						$('#load_8').val(data.load_8);
						$('#load_9').val(data.load_9);
						$('#load_10').val(data.load_10);
						$('#load_11').val(data.load_11);
						$('#load_12').val(data.load_12);

						$('#com_1').val(data.com_1);
						$('#com_2').val(data.com_2);
						$('#com_3').val(data.com_3);
						$('#com_4').val(data.com_4);
						$('#com_5').val(data.com_5);
						$('#com_6').val(data.com_6);
						$('#com_7').val(data.com_7);
						$('#com_8').val(data.com_8);
						$('#com_9').val(data.com_9);
						$('#com_10').val(data.com_10);
						$('#com_11').val(data.com_11);
						$('#com_12').val(data.com_12);

						$('#avg_com_1').val(data.avg_com_1);
						$('#avg_com_2').val(data.avg_com_2);
						$('#avg_com_3').val(data.avg_com_3);
						$('#avg_com_4').val(data.avg_com_4);


						break;
					} else {

					}

				}

				//Moisture Contrent
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "mou") {

						var chk_mou = data.chk_mou;

						if (chk_mou == "1") {
							$('#mous').css("background-color", "var(--primary)");
							$("#chk_mou").prop("checked", true);
						} else {
							$('#mous').css("background-color", "white");
							$("#chk_mou").prop("checked", false);
						}

						$('#in_w1').val(data.in_w1);
						$('#in_w2').val(data.in_w2);
						$('#fn_w1').val(data.fn_w1);
						$('#fn_w2').val(data.fn_w2);
						$('#mo1').val(data.mo1);
						$('#mo2').val(data.mo2);
						$('#avg_mo').val(data.avg_mo);


						break;
					} else {

					}

				}


				$('#btn_edit_data').show();
				$('#btn_save').hide();
			}
		});
	}



	$(document).on("click", ".delete_excels", function() {
		var clicked_id = $(this).attr("data-id");


		$.confirm({
			title: "warning",
			content: "Are You Sure To Delete This Excel?",
			buttons: {
				confirm: function() {
					$.ajax({
						type: 'POST',
						url: '<?php $base_url; ?>excel_upload_test.php',
						data: 'action_type=delete_excels&clicked_id=' + clicked_id,
						success: function(html) {
							location.reload();

						}
					});

				},
				cancel: function() {
					return;
				}
			}
		})
	});
	
	
	
	

	$("#btn_upload_excel").click(function() {
		form_data = new FormData();
		var acb = $('#upload_excel').val();
		if (acb == "") {
			alert("Upload excel First");
			return false;
		}
		var lab_no = "<?php echo $lab_no; ?>";
		var job_no = "<?php echo $job_no_main; ?>";
		var report_no = "<?php echo $report_no; ?>";

		var file_data = $('#upload_excel').prop('files')[0];
		var form_data = new FormData(); // Create a FormData object
		form_data.append('file', file_data); // Append all element in FormData  object
		form_data.append('lab_no', lab_no); // Append all element in FormData  object
		form_data.append('job_no', job_no); // Append all element in FormData  object
		form_data.append('report_no', report_no); // Append all element in FormData  object

		$.ajax({
			url: '<?php $base_url; ?>excel_upload_test.php', // point to server-side PHP script 
			dataType: 'text', // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function(output) {
				get_excel_record(); // display response from the PHP script, if any
			}
		});
		$('#upload_excel').val('');


	});

	function get_excel_record() {
		var lab_no = "<?php echo $lab_no; ?>";
		var job_no = "<?php echo $job_no_main; ?>";
		var report_no = "<?php echo $report_no; ?>";
		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>excel_upload_test.php',
			data: 'action_type=get_excel_record&lab_no=' + lab_no + '&job_no=' + job_no + '&report_no=' + report_no,
			success: function(html) {
				$('#view_excel_from_table').html(html);

			}
		});
	}


</script>