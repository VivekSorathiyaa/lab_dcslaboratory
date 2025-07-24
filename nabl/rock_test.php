<?php
include("header.php");
include("connection.php");
error_reporting(1);
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
	$tank_no = $row_select4['tanker_no'];
	$lot_no = $row_select4['lot_no'];
	$bitumin_grade = $row_select4['bitumin_grade'];
	$bitumin_make = $row_select4['bitumin_make'];
}


?>
<!-- STYLE PUT VAIBHAV-->
<div class="content-wrapper" style="margin-left:0px !important;">
	<!-- Content Header (Page header) -->
	<section class="content common_material p-0">
		<!-- MENU INCLUDE VAIBHAV-->
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">ROCK</h2>
					</div>
					<!--<div class="box-default">-->
					<form class="form" id="Glazed" method="post">
						<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
						<div class="row">
							<Br>
							<div class="col-lg-6">
								<div class="form-group">
									<!--<label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->
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
							<div class="col-lg-6">
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
							<div class="col-lg-6">
								<div class="form-group">
									<div class="col-sm-4">
											<label>Amend Date. :</label>
										</div>								 
									<div class="col-sm-8">
									<input type="text" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Remark :</label>
									<div class="col-sm-4">
										<input type="text" class="form-control inputs" id="remark" name="remark">
									</div>
									<label for="inputEmail3" class="col-sm-2 control-label">Depth :</label>
									<div class="col-sm-4">
										<input type="text" class="form-control inputs" id="rock_depth" name="rock_depth">
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Material taken Wt, g :</label>
									<div class="col-sm-4">
										<input type="text" class="form-control inputs" id="wt_m" name="wt_m">
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Sheet No. :</label>
									<div class="col-sm-4">
										<input type="text" class="form-control inputs" id="Sheet_no" name="Sheet_no">
									</div>
									<label for="inputEmail3" class="col-sm-2 control-label">BH No. :</label>
									<div class="col-sm-4">
										<input type="text" class="form-control inputs" id="bh_no" name="bh_no">
									</div>
								</div>
							</div>
						</div>
						<br>


						<!-- LAB NO PUT VAIBHAV-->
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<!--<label for="inputEmail3" class="col-sm-2 control-label">Tanker No.:</label>-->
									<div class="col-sm-10">
										<input type="hidden" class="form-control inputs" tabindex="4" id="tank_no" value="<?php echo $tank_no; ?>" name="tank_no">
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<!--<label for="inputEmail3" class="col-sm-2 control-label">Lot No.:</label>-->
									<div class="col-sm-10">
										<input type="hidden" class="form-control inputs" tabindex="4" id="lot_no" value="<?php echo $lot_no; ?>" name="lot_no">
									</div>
								</div>
							</div>
						</div>
						<br>
						<!-- LAB NO PUT VAIBHAV-->
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<!--<label for="inputEmail3" class="col-sm-2 control-label">Bitumin Make:</label>-->
									<div class="col-sm-10">
										<input type="hidden" class="form-control inputs" tabindex="4" id="bitumin_make" value="<?php echo $bitumin_make; ?>" name="bitumin_make">
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
									<div class="col-sm-10">
										<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" readonly>
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
										 $querys_job1 = "SELECT * FROM rock WHERE `is_deleted`='0' and lab_no='$lab_no'";
										$qrys_jobno = mysqli_query($conn, $querys_job1);
										$rows = mysqli_num_rows($qrys_jobno);
										if ($rows < 1) { ?>
											<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14">Save</button>
										<?php 
										}
										?>
									</div>
									<div class="col-sm-2">
										<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')" id="btn_edit_data" name="btn_edit_data">Update</button>
									</div>
									<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
									<?php
									$val =  $_SESSION['isadmin'];
									//if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
									?>
									<div class="col-sm-2">
										<a target='_blank' href="<?php echo $base_url; ?>print_report/print_rock.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>&&ulr=<?php echo $ulr; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
									</div>

									<?php //} 
									?>
									<div class="col-sm-2">
										<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/back_rock_test.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

									</div>
								</div>
							</div>
						</div>
						<hr>
						<br>
						<div class="panel-group" id="accordion">
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
														<div class="col-sm-4">
															<div class="col-sm-2">
																<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>">Row Data</a>
															</div>
															<div class="col-sm-4">
																<label for="inputEmail3" class="control-label">Upload Excel :</label>
															</div>
															<div class="col-sm-4">
																<input type="file" class="form-control" id="upload_excel" name="upload_excel">
															</div>
															<div class="col-sm-4">
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
										</div>
										<br>
									</div>
								<?php }	 ?>

								<?php
								$test_check;
								$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								while ($r1 = mysqli_fetch_array($result_select1)) {

									if ($r1['test_code'] == "den") {

										$test_check .= "den,";
								?>
										<div class="panel panel-default" id="den">
											<div class="panel-heading" id="txtpor">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_por">
														<h4 class="panel-title">
															<b>POROSITY & DENSITY & WATER CONTENT</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse_por" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_por">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_por" id="chk_por" value="chk_por"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">POROSITY & DENSITY</label>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature :</label>-->
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" id="pen_temp" name="pen_temp">
																</div>
															</div>
														</div>
													</div>
													<br><BR>




													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">1.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Water Temperature</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr_temp_1" name="wtr_temp_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr_temp_2" name="wtr_temp_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr_temp_3" name="wtr_temp_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">2.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Mass of Sample at Room Temperature with Container - M</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="rt_m_1" name="rt_m_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="rt_m_2" name="rt_m_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="rt_m_3" name="rt_m_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">3.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Saturated Submerged Mass of Basket alone - M₁</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m1_1" name="ss_m1_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m1_2" name="ss_m1_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m1_3" name="ss_m1_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">4.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Saturated Submerged Mass of Basket and Sample - M₂</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m2_1" name="ss_m2_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m2_2" name="ss_m2_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m2_3" name="ss_m2_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">5.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Mass of Container - M<sub>3</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m3_1" name="ss_m3_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m3_2" name="ss_m3_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m3_3" name="ss_m3_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">6.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Saturated Surface Dry Weight of Sample with Container - M<sub>4</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m4_1" name="ss_m4_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m4_2" name="ss_m4_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m4_3" name="ss_m4_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">7.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">	Dry Weight of Sample with Container - M<sub>5</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m5_1" name="ss_m5_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m5_2" name="ss_m5_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ss_m5_3" name="ss_m5_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">8.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Saturated Submerged Mass - M<sub>sub</sub>= M<sub>2</sub> - M<sub>1</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ssm_sub_1" name="ssm_sub_1" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ssm_sub_2" name="ssm_sub_2" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ssm_sub_3" name="ssm_sub_3" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">9.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Saturated Surface Dry Mass - M<sub>sat</sub>= M<sub>4</sub> - M<sub>3</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ssm_sat_1" name="ssm_sat_1" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ssm_sat_2" name="ssm_sat_2" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="ssm_sat_3" name="ssm_sat_3" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">10.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Dry Mass (Grain Weight) - M<sub>s</sub>= M<sub>5</sub> - M<sub>3</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="dm_ms_1" name="dm_ms_1" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="dm_ms_2" name="dm_ms_2" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="dm_ms_3" name="dm_ms_3" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">11.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Bulk Volume - <b>V = (M<sub>sat</sub> - M<sub>sub</sub>) / &Rho;<sub>w</sub></b></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="bvol_1" name="bvol_1" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="bvol_2" name="bvol_2" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="bvol_3" name="bvol_3" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">12.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Pore Volume - V<sub>v</sub> = (M<sub>sat</sub> - M<sub>s</sub>) / &Rho;<sub>w</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="pv_1" name="pv_1" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="pv_2" name="pv_2" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="pv_3" name="pv_3" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">13.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Porosity - n = (V<sub>v</sub> / V) X 100</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="por_1" name="por_1" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="por_2" name="por_2" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="por_3" name="por_3" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">14.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Dry Density - P<sub>d</sub> = M<sub>s</sub> / V</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="pd_1" name="pd_1" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="pd_2" name="pd_2" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="pd_3" name="pd_3" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">15.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label"> Water Content - W = (M<sub>4</sub> - M<sub>3</sub>) -  (M<sub>5</sub> - M<sub>3</sub>)  X 100 / (M<sub>5</sub> - M<sub>3</sub>)</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="wc_1" name="wc_1" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="wc_2" name="wc_2" disabled>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="wc_3" name="wc_3" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>


													<!-- <div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">1.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Mass of container and lid, M3</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_c_1" name="mass_c_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_c_2" name="mass_c_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_c_3" name="mass_c_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">2.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Mass of Dried container M5</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_d_1" name="mass_d_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_d_2" name="mass_d_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_d_3" name="mass_d_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">3.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">specimen</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="sm_1" name="sm_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="sm_2" name="sm_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="sm_3" name="sm_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">4.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Mass of oven Dry rock sample in g M<sub>s</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_o_1" name="mass_o_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_o_2" name="mass_o_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_o_3" name="mass_o_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">5.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Mass of saturated rock sample in g M<sub>sat</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_s_1" name="mass_s_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_s_2" name="mass_s_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="mass_s_3" name="mass_s_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">6.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Density oof Water at Temprature t, P<sub>w</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="dtemp1" name="dtemp1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="dtemp2" name="dtemp2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="dtemp3" name="dtemp3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">7.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Pore Volume Yv = Msat - Ms/P<sub>w</sub></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="pvol1" name="pvol1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="pvol2" name="pvol2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="pvol3" name="pvol3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">8.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Bulk Volume, Y, cc=(I X w X h cm) or (/4 x d<sup>2</sup> x h)</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="bvol1" name="bvol1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="bvol2" name="bvol2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="bvol3" name="bvol3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">9.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Dry Density</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="den1" name="den1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="den2" name="den2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="den3" name="den3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">10.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Porosity n = </label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="por1" name="por1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="por2" name="por2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="por3" name="por3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">11.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Average Porosity </label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="avg_por" name="avg_por">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">12.</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Average Density (gm/cc) </label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="avg_den" name="avg_den">
																</div>
															</div>
														</div>
													</div> -->

												</div>
											</div>
										</div>


									<?php } else if ($r1['test_code'] == "com") {
										$test_check .= "com,"; ?>

										<div class="panel panel-default" id="com">
											<div class="panel-heading" id="txtcom">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_com">
														<h4 class="panel-title">
															<b>UNCONFINED COMPRESSIVE STRENGTH</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse_com" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_com">3.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_com" id="chk_com" value="chk_com"><br>
																</div>
																<label for="inputEmail3" class="col-sm-6 control-label label-right">UNCONFINED COMPRESSIVE STRENGTH TEST</label>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature :</label>-->
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" id="duc_temp" name="duc_temp">
																</div>
															</div>
														</div>
													</div>
													<br><br>

													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Sample ID</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="desc1" name="desc1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="desc2" name="desc2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="desc3" name="desc3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con1" name="con1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con2" name="con2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con3" name="con3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="depth1" name="depth1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="depth2" name="depth2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="depth3" name="depth3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="length1" name="length1">
																</div>
															</div>
														</div>
													</div>
													<br>

													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Sample Depth</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="length2" name="length2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="length3" name="length3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dia1" name="dia1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dia2" name="dia2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dia3" name="dia3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="ratio1" name="ratio1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="ratio2" name="ratio2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="ratio3" name="ratio3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr1" name="corr1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr2" name="corr2">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Diameter of Specimen (D)</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Upper Diameter X-Axis</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr3" name="corr3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area1" name="area1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area2" name="area2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area3" name="area3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="fla1" name="fla1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="fla2" name="fla2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="fla3" name="fla3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="par1" name="par1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="par2" name="par2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="par3" name="par3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Upper Diameter Y-Axis</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="ppl1" name="ppl1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="ppl2" name="ppl2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="ppl3" name="ppl3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="str1" name="str1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="str2" name="str2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="str3" name="str3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rate1" name="rate1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rate2" name="rate2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rate3" name="rate3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mod1" name="mod1">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Middle Diameter X-Axis</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mod2" name="mod2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mod3" name="mod3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load1" name="load1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load2" name="load2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load3" name="load3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="ucs1" name="ucs1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="ucs2" name="ucs2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="ucs3" name="ucs3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="cor1" name="cor1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="cor2" name="cor2">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Middle Diameter Y-Axis</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="cor3" name="cor3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_1" name="com_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_2" name="com_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_3" name="com_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_4" name="com_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_5" name="com_5">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_6" name="com_6">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_7" name="com_7">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_8" name="com_8">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_9" name="com_9">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Lower  Diameter X-Axis</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_10" name="com_10">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_11" name="com_11">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_12" name="com_12">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_13" name="com_13">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_14" name="com_14">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_15" name="com_15">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_16" name="com_16">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_17" name="com_17">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_18" name="com_18">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_19" name="com_19">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Lower Diameter Y-Axis</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_20" name="com_20">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_21" name="com_21">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_22" name="com_22">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_23" name="com_23">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_24" name="com_24">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_25" name="com_25">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_26" name="com_26">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_27" name="com_27">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_28" name="com_28">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_29" name="com_29">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Average Diameter D</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_30" name="com_30">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_31" name="com_31">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_32" name="com_32">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_33" name="com_33">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_34" name="com_34">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_35" name="com_35">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_36" name="com_36">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_37" name="com_37">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_38" name="com_38">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_39" name="com_39">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Length of Specimen L</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_109" name="com_109">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_40" name="com_40">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_41" name="com_41">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_42" name="com_42">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_43" name="com_43">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_44" name="com_44">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_45" name="com_45">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_46" name="com_46">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_47" name="com_47">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_48" name="com_48">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Cross Sectional Area A</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_49" name="com_49">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_50" name="com_50">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_51" name="com_51">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_52" name="com_52">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_53" name="com_53">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_54" name="com_54">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_55" name="com_55">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_56" name="com_56">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_57" name="com_57">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_58" name="com_58">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight W</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_59" name="com_59">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_60" name="com_60">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_61" name="com_61">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_62" name="com_62">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_63" name="com_63">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_64" name="com_64">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_65" name="com_65">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_66" name="com_66">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_67" name="com_67">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_68" name="com_68">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Dry Density y<sub>d</sub></label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_69" name="com_69">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_70" name="com_70">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_71" name="com_71">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_72" name="com_72">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_73" name="com_73">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_74" name="com_74">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_75" name="com_75">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_76" name="com_76">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_77" name="com_77">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_78" name="com_78">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Length to Diameter Ratio R = L / D</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_79" name="com_79" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_80" name="com_80" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_81" name="com_81" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_82" name="com_82" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_83" name="com_83" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_84" name="com_84" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_85" name="com_85" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_86" name="com_86" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_87" name="com_87" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_88" name="com_88" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Failure Load P</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_89" name="com_89">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_90" name="com_90">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_91" name="com_91">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_92" name="com_92">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_93" name="com_93">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_94" name="com_94">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_95" name="com_95">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_96" name="com_96">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_97" name="com_97">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_98" name="com_9">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Unconfined Compressive Strength &sigma; = P / A</label>
															</div>
														</div>
														<div class="">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_99" name="com_99" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_100" name="com_100" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_101" name="com_101" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_102" name="com_102" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_103" name="com_103" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_104" name="com_104" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_105" name="com_105" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_106" name="com_106" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_107" name="com_107" disabled>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_108" name="com_108" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													
												</div>
												<br>
											</div>
										</div>


									<?php } else if ($r1['test_code'] == "rpl") {
										$test_check .= "rpl,"; ?>

										<div class="panel panel-default" id="POI">
											<div class="panel-heading" id="txtpoi">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_poi">
														<h4 class="panel-title">
															<b>POINT LOAD STRENGTH</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse_poi" class="panel-collapse collapse">
												<div class="panel-body">
													<div class="row">

														<div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_poi">4.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_poi" id="chk_poi" value="chk_poi"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">POINT LOAD STRENGTH</label>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" id="sp_temp" name="sp_temp"><br>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Sample ID / Mark</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Depth</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Hight (mm)</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Dia D (mm)</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Failure Load P (Div.)</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Point Load strength (kg/mm<sup>2</sup>)</label>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Cross Sectional area of the fractured surface (cm<sup>2</sup>)</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Failure Load P (Div.)</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Point Load lump strength (kg/mm<sup>2</sup>)</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Unixial compressive strength ((kg/cm<sup>2</sup>))</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam1' name='sam1'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d1' name='d1'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h1' name='h1'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di1' name='di1'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f1' name='f1'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload1' name='pload1'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur1' name='sur1'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload1' name='fload1'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr1' name='pstr1'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom1' name='ucom1'>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam2' name='sam2'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d2' name='d2'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h2' name='h2'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di2' name='di2'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f2' name='f2'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload2' name='pload2'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur2' name='sur2'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload2' name='fload2'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr2' name='pstr2'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom2' name='ucom2'>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam3' name='sam3'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d3' name='d3'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h3' name='h3'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di3' name='di3'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f3' name='f3'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload3' name='pload3'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur3' name='sur3'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload3' name='fload3'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr3' name='pstr3'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom3' name='ucom3'>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam4' name='sam4'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d4' name='d4'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h4' name='h4'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di4' name='di4'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f4' name='f4'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload4' name='pload4'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur4' name='sur4'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload4' name='fload4'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr4' name='pstr4'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom4' name='ucom4'>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam5' name='sam5'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d5' name='d5'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h5' name='h5'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di5' name='di5'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f5' name='f5'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload5' name='pload5'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur5' name='sur5'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload5' name='fload5'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr5' name='pstr5'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom5' name='ucom5'>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam6' name='sam6'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d6' name='d6'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h6' name='h6'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di6' name='di6'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f6' name='f6'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload6' name='pload6'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur6' name='sur6'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload6' name='fload6'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr6' name='pstr6'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom6' name='ucom6'>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam7' name='sam7'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d7' name='d7'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h7' name='h7'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di7' name='di7'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f7' name='f7'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload7' name='pload7'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur7' name='sur7'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload7' name='fload7'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr7' name='pstr7'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom7' name='ucom7'>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam8' name='sam8'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d8' name='d8'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h8' name='h8'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di8' name='di8'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f8' name='f8'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload8' name='pload8'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur8' name='sur8'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload8' name='fload8'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr8' name='pstr8'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom8' name='ucom8'>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam9' name='sam9'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d9' name='d9'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h9' name='h9'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di9' name='di9'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f9' name='f9'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload9' name='pload9'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur9' name='sur9'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload9' name='fload9'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr9' name='pstr9'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom9' name='ucom9'>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam10' name='sam10'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d10' name='d10'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h10' name='h10'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di10' name='di10'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f10' name='f10'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload10' name='pload10'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur10' name='sur10'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload10' name='fload10'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr10' name='pstr10'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom10' name='ucom10'>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='sam11' name='sam11'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='d11' name='d11'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='h11' name='h11'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='di11' name='di11'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='f11' name='f11'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pload11' name='pload11'>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<input type="text" class="form-control" id='sur11' name='sur11'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='fload11' name='fload11'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='pstr11' name='pstr11'>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<input type="text" class="form-control" id='ucom11' name='ucom11'>
															</div>
														</div>
													</div>





												</div>
											</div>
										</div>


									<?php } else if ($r1['test_code'] == "spg") {
										$test_check .= "spg,"; ?>

										<div class="panel panel-default" id="spg">
										<div class="panel-heading" id="txtspg">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
													<h4 class="panel-title">
														<b>SPECIFIC GRAVITY & WATER ABSORPTION</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse3" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">
													<div class="col-lg-8">
														<div class="form-group">
															<div class="col-sm-2">
																<label for="chk_sp">4 / 5.</label>
																<input type="checkbox" class="visually-hidden" name="chk_sp" id="chk_sp" value="chk_sp"><br>
															</div>
															<label for="inputEmail3" class="col-sm-10 control-label label-right">SPECIFIC GRAVITY & WATER ABSORPTION</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-3 control-label label-right">Temperature</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" id="sp_temp" name="sp_temp"><br>
															</div>
														</div>
													</div>
												</div>
												<br><br>

												<div class="row">
													<div class="col-lg-1">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Sample ID</label>
														</div>
													</div>

													<div class="col-lg-1">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Wt. of Oven Dry test piece,A (g)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Wt. of saturated surface dry sample, B (g)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Quantity of water added in 1000 ml jar containing test sample, C (g)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Apparent Specific Gravity,<br> = A / (1000-C)</label>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Water Absorpation,<br> = (B-A)/A X 100</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Apparent Porosity,<br> = B - A / 1000 - C X 100</label>
														</div>
													</div>
												</div>
												<br>


												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<div class="row">
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wt_st_1" name="sp_wt_st_1">
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_s_1" name="sp_w_s_1">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_sur_1" name="sp_w_sur_1">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_agg1" name="sp_agg1">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wat1" name="sp_wat1" disabled>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_specific_gravity_1" name="sp_specific_gravity_1" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_water_abr_1" name="sp_water_abr_1" disabled>
														</div>
													</div>
												</div>
												<br>

												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 2-->
												<div class="row">
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wt_st_2" name="sp_wt_st_2">
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_s_2" name="sp_w_s_2">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_sur_2" name="sp_w_sur_2">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_agg2" name="sp_agg2">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wat2" name="sp_wat2" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_specific_gravity_2" name="sp_specific_gravity_2" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_water_abr_2" name="sp_water_abr_2" disabled>
														</div>
													</div>
												</div>
												<br>

												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 3-->
												<div class="row">
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wt_st_3" name="sp_wt_st_3">
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_s_3" name="sp_w_s_3">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_sur_3" name="sp_w_sur_3">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_agg3" name="sp_agg3">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wat3" name="sp_wat3" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_specific_gravity_3" name="sp_specific_gravity_3" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_water_abr_3" name="sp_water_abr_3" disabled>
														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">

														</div>
													</div>
													<!-- <div class="col-lg-2">
														<div class="col-sm-12">
															<input type="hidden" class="form-control" id="sp_sample_ca" name="sp_sample_ca">
														</div>
													</div> -->
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_specific_gravity" name="sp_specific_gravity" disabled>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
															<input type="text" class="form-control" id="sp_water_abr" name="sp_water_abr" disabled>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_porosity_1" name="sp_porosity_1" disabled>
														</div>
													</div>
												</div>
												<br>
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE OVER-->



												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 4-->
												<div class="row">
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wt_st_4" name="sp_wt_st_4">
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_s_4" name="sp_w_s_4">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_sur_4" name="sp_w_sur_4">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_agg4" name="sp_agg4">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wat4" name="sp_wat4" disabled>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_specific_gravity_4" name="sp_specific_gravity_4" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_water_abr_4" name="sp_water_abr_4" disabled>
														</div>
													</div>
												</div>
												<br>

												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 5-->
												<div class="row">
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wt_st_5" name="sp_wt_st_5">
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_s_5" name="sp_w_s_5">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_sur_5" name="sp_w_sur_5">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_agg5" name="sp_agg5">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wat5" name="sp_wat5" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_specific_gravity_5" name="sp_specific_gravity_5" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_water_abr_5" name="sp_water_abr_5"c disabled>
														</div>
													</div>
												</div>
												<br>

												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 6-->
												<div class="row">
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wt_st_6" name="sp_wt_st_6">
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_s_6" name="sp_w_s_6">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_sur_6" name="sp_w_sur_6">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_agg6" name="sp_agg6">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wat6" name="sp_wat6" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_specific_gravity_6" name="sp_specific_gravity_6" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_water_abr_6" name="sp_water_abr_6" disabled>
														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">

														</div>
													</div>
													<!-- <div class="col-lg-2">
														<div class="col-sm-12">
															<input type="hidden" class="form-control" id="sp_sample_ca" name="sp_sample_ca">
														</div>
													</div> -->
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_sg_avg_2" name="sp_sg_avg_2" disabled>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wa_avg_2" name="sp_wa_avg_2" disabled>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_porosity_2" name="sp_porosity_2" disabled>
														</div>
													</div>
												</div>
												<br>
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE OVER-->

												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 7-->
												<div class="row">
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wt_st_7" name="sp_wt_st_7">
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_s_7" name="sp_w_s_7">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_sur_7" name="sp_w_sur_7">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_agg7" name="sp_agg7">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wat7" name="sp_wat7" disabled>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_specific_gravity_7" name="sp_specific_gravity_7" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_water_abr_7" name="sp_water_abr_7" disabled>
														</div>
													</div>
												</div>
												<br>

												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 8-->
												<div class="row">
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wt_st_8" name="sp_wt_st_8">
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_s_8" name="sp_w_s_8">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_sur_8" name="sp_w_sur_8">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_agg8" name="sp_agg8">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wat8" name="sp_wat8" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_specific_gravity_8" name="sp_specific_gravity_8" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_water_abr_8" name="sp_water_abr_8" disabled>
														</div>
													</div>
												</div>
												<br>

												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 9-->
												<div class="row">
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wt_st_9" name="sp_wt_st_9">
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_s_9" name="sp_w_s_9">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_w_sur_9" name="sp_w_sur_9">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_agg9" name="sp_agg9">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wat9" name="sp_wat9" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_specific_gravity_9" name="sp_specific_gravity_9" disabled>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_water_abr_9" name="sp_water_abr_9" disabled>
														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">

														</div>
													</div>
													<!-- <div class="col-lg-2">
														<div class="col-sm-12">
															<input type="hidden" class="form-control" id="sp_sample_ca" name="sp_sample_ca">
														</div>
													</div> -->
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_sg_avg_3" name="sp_sg_avg_3" disabled>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_wa_avg_3" name="sp_wa_avg_3" disabled>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
																<input type="text" class="form-control" id="sp_porosity_3" name="sp_porosity_3" disabled>
														</div>
													</div>
												</div>
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE OVER-->
											</div>
											<br>


											<!-- <div class="panel-body">
												<div class="row">

													<div class="col-lg-8">
														<div class="form-group">
															<div class="col-sm-2">
																<label for="chk_sp">4 / 5.</label>
																<input type="checkbox" class="visually-hidden" name="chk_sp" id="chk_sp" value="chk_sp"><br>
															</div>
															<label for="inputEmail3" class="col-sm-10 control-label label-right">SPECIFIC GRAVITY & WATER ABSORPTION</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-8">
																<input type="hidden" class="form-control" id="sp_temp" name="sp_temp"><br>
															</div>
														</div>
													</div>

												</div>
												<div class="row">

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Wt. of Saturated Surface Dry (g) A</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Wt. of Oven Dry (g) B</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Mass of Aggregate (g) A1</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Mass of Basket in water (g) A2</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Wt. of Sample in Water (g) C</label>
														</div>
													</div>


													<div class="col-lg-1">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Specific Gravity G=(B)/(A-C)</label>
														</div>
													</div>

													<div class="col-lg-1">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Water Absorption =100 X (A-B)/B</label>
														</div>
													</div>

												</div>
												<br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_wt_st_1" name="sp_wt_st_1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_w_s_1" name="sp_w_s_1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_w_sur_1" name="sp_w_sur_1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_agg1" name="sp_agg1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_wat1" name="sp_wat1">
															</div>
														</div>
													</div>


													<div class="col-lg-1">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_specific_gravity_1" name="sp_specific_gravity_1" readonly>
															</div>
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_water_abr_1" name="sp_water_abr_1" readonly>
															</div>
														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_wt_st_2" name="sp_wt_st_2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_w_s_2" name="sp_w_s_2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_w_sur_2" name="sp_w_sur_2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_agg2" name="sp_agg2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_wat2" name="sp_wat2">
															</div>
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_specific_gravity_2" name="sp_specific_gravity_2" readonly>
															</div>
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_water_abr_2" name="sp_water_abr_2" readonly>
															</div>
														</div>
													</div>
												</div>
												<br>
												
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_wt_st_3" name="sp_wt_st_3">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_w_s_3" name="sp_w_s_3">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_w_sur_3" name="sp_w_sur_3">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_agg3" name="sp_agg3">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_wat3" name="sp_wat3">
															</div>
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_specific_gravity_3" name="sp_specific_gravity_3" readonly>
															</div>
														</div>
													</div>
													<div class="col-lg-1">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_water_abr_3" name="sp_water_abr_3" readonly>
															</div>
														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">

														</div>
													</div>
													<div class="col-lg-2">
														<div class="col-sm-12">
															<input type="hidden" class="form-control" id="sp_sample_ca" name="sp_sample_ca">
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
														</div>
													</div>
													<div class="col-sm-1">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_specific_gravity" name="sp_specific_gravity">
															</div>
														</div>
													</div>
													<div class="col-sm-1">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sp_water_abr" name="sp_water_abr">
															</div>
														</div>
													</div>
												</div>
											</div> -->
										</div>
									</div>


									<?php } else if ($r1['test_code'] == "tes") {
										$test_check .= "tes,"; ?>

										<div class="panel panel-default" id="tes">
											<div class="panel-heading" id="txttes">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_tes">
														<h4 class="panel-title">
															<b>TENSILE STRENGTH</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse_tes" class="panel-collapse collapse">
												<div class="panel-body">
													<div class="row">

														<div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_tes">6.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_tes" id="chk_tes" value="chk_tes"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">TENSILE STRENGTH</label>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
																<div class="col-sm-8">

																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-sm-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Tensile Strength</label>
															</div>
														</div>
														<div class="col-sm-3">
															<div class="form-group">
																<input type="text" class="form-control" id='avg_tes' name='avg_tes'>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>


								<?php }
								} ?>
								</div>

								<hr>
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
												$query = "select * from rock WHERE lab_no='$aa'  and `is_deleted`='0'";

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

								<!-- TEST LIST FILD VAIBHAV-->
								<input type="hidden" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ','); ?>">




					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<?php include("footer.php"); ?>
<script>
	$(function() {
		$('.select2').select2();
	});
	$('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });
	$(document).ready(function() {
		$('#btn_edit_data').hide();
		$('#alert').hide();

		// $('#btn_save').click(function(){
		// $('#btn_save').hide();
		// });

		//POROSITY & DENSITY
		function por_auto() {
			$('#txtpor').css("background-color", "var(--success)");
			$('#mass_d_1').val(1);
			$('#mass_d_2').val(1);
			$('#mass_d_3').val(1);
			$('#mass_c_1').val(1);
			$('#mass_c_2').val(1);
			$('#mass_c_3').val(1);
			$('#sm_1').val(1);
			$('#sm_2').val(1);
			$('#sm_3').val(1);
			$('#mass_o_1').val(1);
			$('#mass_o_2').val(1);
			$('#mass_o_3').val(1);
			$('#mass_s_1').val(1);
			$('#mass_s_2').val(1);
			$('#mass_s_3').val(1);
			$('#dtemp1').val(1);
			$('#dtemp2').val(1);
			$('#dtemp3').val(1);
			$('#pvol1').val(1);
			$('#pvol2').val(1);
			$('#pvol3').val(1);
			$('#bvol1').val(1);
			$('#bvol2').val(1);
			$('#bvol3').val(1);
			$('#den1').val(1);
			$('#den2').val(1);
			$('#den3').val(1);
			$('#por1').val(1);
			$('#por2').val(1);
			$('#por3').val(1);
			$('#avg_por').val(1);
			$('#avg_den').val(1);
			$('#m_1_1').val(1);
			$('#m_1_2').val(1);
			$('#m_1_3').val(1);
			$('#m_2_1').val(1);
			$('#m_2_2').val(1);
			$('#m_2_3').val(1);
			$('#m_3_1').val(1);
			$('#m_3_2').val(1);
			$('#m_3_3').val(1);
			$('#wtr1').val(1);
			$('#wtr2').val(1);
			$('#wtr3').val(1);
			$('#avg_wtr').val(1);
		}

		$('#chk_pen').change(function() {
			if (this.checked) {
				por_auto();
			} else {
				$('#txtpor').css("background-color", "white");
				$('#mass_d_1').val(null);
				$('#mass_d_2').val(null);
				$('#mass_d_3').val(null);
				$('#mass_c_1').val(null);
				$('#mass_c_2').val(null);
				$('#mass_c_3').val(null);
				$('#sm_1').val(null);
				$('#sm_2').val(null);
				$('#sm_3').val(null);
				$('#mass_o_1').val(null);
				$('#mass_o_2').val(null);
				$('#mass_o_3').val(null);
				$('#mass_s_1').val(null);
				$('#mass_s_2').val(null);
				$('#mass_s_3').val(null);
				$('#dtemp_1').val(null);
				$('#dtemp_2').val(null);
				$('#dtemp_3').val(null);
				$('#pvol_1').val(null);
				$('#pvol_2').val(null);
				$('#pvol_3').val(null);
				$('#bvol_1').val(null);
				$('#bvol_2').val(null);
				$('#bvol_3').val(null);
				$('#den1').val(null);
				$('#den2').val(null);
				$('#den3').val(null);
				$('#por1').val(null);
				$('#por2').val(null);
				$('#por3').val(null);
				$('#avg_por').val(null);
				$('#avg_den').val(null);
				$('#m_1_1').val(null);
				$('#m_1_2').val(null);
				$('#m_1_3').val(null);
				$('#m_2_1').val(null);
				$('#m_2_2').val(null);
				$('#m_2_3').val(null);
				$('#m_3_1').val(null);
				$('#m_3_2').val(null);
				$('#m_3_3').val(null);
				$('#wtr1').val(null);
				$('#wtr2').val(null);
				$('#wtr3').val(null);
				$('#avg_wtr').val(null);
			}

		});


		//WATER CONTENT
		function wtr_auto() {
			$('#txtwtr').css("background-color", "var(--success)");
			// $('#m_1_1').val(1);
			// $('#m_1_2').val(1);
			// $('#m_1_3').val(1);
			// $('#m_2_1').val(1);
			// $('#m_2_2').val(1);
			// $('#m_2_3').val(1);
			// $('#m_3_1').val(1);
			// $('#m_3_2').val(1);
			// $('#m_3_3').val(1);
			// $('#wtr1').val(1);
			// $('#wtr2').val(1);
			// $('#wtr3').val(1);
			// $('#avg_wtr').val(1);
		}

		$('#chk_wtr').change(function() {
			if (this.checked) {
				wtr_auto();
			} else {
				$('#txtwtr').css("background-color", "white");
				// $('#m_1_1').val(null);
				// $('#m_1_2').val(null);
				// $('#m_1_3').val(null);
				// $('#m_2_1').val(null);
				// $('#m_2_2').val(null);
				// $('#m_2_3').val(null);
				// $('#m_3_1').val(null);
				// $('#m_3_2').val(null);
				// $('#m_3_3').val(null);
				// $('#wtr1').val(null);
				// $('#wtr2').val(null);
				// $('#wtr3').val(null);
				// $('#avg_wtr').val(null);
			}

		});


		//COMPRESSIVE STRENGTH
		function com_auto() {
			$('#txtcom').css("background-color", "var(--success)");
			var desc1 = $('#desc1').val(randomNumberFromRange(1, 9).toFixed(2));
				var desc2 = $('#desc2').val(randomNumberFromRange(1, 9).toFixed(2));
				var desc3 = $('#desc3').val(randomNumberFromRange(1, 9).toFixed(2));
				var con1 = $('#con1').val(randomNumberFromRange(1, 9).toFixed(2));
				var con2 = $('#con2').val(randomNumberFromRange(1, 9).toFixed(2));
				var con3 = $('#con3').val(randomNumberFromRange(1, 9).toFixed(2));
				var depth1 = $('#depth1').val(randomNumberFromRange(1, 9).toFixed(2));
				var depth2 = $('#depth2').val(randomNumberFromRange(1, 9).toFixed(2));
				var depth3 = $('#depth3').val(randomNumberFromRange(1, 9).toFixed(2));
				var length1 = $('#length1').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Sample Depth
				var length2 = $('#length2').val(randomNumberFromRange(1, 9).toFixed(2));
				var length3 = $('#length3').val(randomNumberFromRange(1, 9).toFixed(2));
				var dia1 = $('#dia1').val(randomNumberFromRange(1, 9).toFixed(2));
				var dia2 = $('#dia2').val(randomNumberFromRange(1, 9).toFixed(2));
				var dia3 = $('#dia3').val(randomNumberFromRange(1, 9).toFixed(2));
				var ratio1 = $('#ratio1').val(randomNumberFromRange(1, 9).toFixed(2));
				var ratio2 = $('#ratio2').val(randomNumberFromRange(1, 9).toFixed(2));
				var ratio3 = $('#ratio3').val(randomNumberFromRange(1, 9).toFixed(2));
				var corr1 = $('#corr1').val(randomNumberFromRange(1, 9).toFixed(2));
				var corr2 = $('#corr2').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Upper Diameter X-Axis
				var corr3 = $('#corr3').val(randomNumberFromRange(1, 9).toFixed(2));
				var area1 = $('#area1').val(randomNumberFromRange(1, 9).toFixed(2));
				var area2 = $('#area2').val(randomNumberFromRange(1, 9).toFixed(2));
				var area3 = $('#area3').val(randomNumberFromRange(1, 9).toFixed(2));
				var fla1 = $('#fla1').val(randomNumberFromRange(1, 9).toFixed(2));
				var fla2 = $('#fla2').val(randomNumberFromRange(1, 9).toFixed(2));
				var fla3 = $('#fla3').val(randomNumberFromRange(1, 9).toFixed(2));
				var par1 = $('#par1').val(randomNumberFromRange(1, 9).toFixed(2));
				var par2 = $('#par2').val(randomNumberFromRange(1, 9).toFixed(2));
				var par3 = $('#par3').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Upper Diameter Y-Axis
				var ppl1 = $('#ppl1').val(randomNumberFromRange(1, 9).toFixed(2));
				var ppl2 = $('#ppl2').val(randomNumberFromRange(1, 9).toFixed(2));
				var ppl3 = $('#ppl3').val(randomNumberFromRange(1, 9).toFixed(2));
				var str1 = $('#str1').val(randomNumberFromRange(1, 9).toFixed(2));
				var str2 = $('#str2').val(randomNumberFromRange(1, 9).toFixed(2));
				var str3 = $('#str3').val(randomNumberFromRange(1, 9).toFixed(2));
				var rate1 = $('#rate1').val(randomNumberFromRange(1, 9).toFixed(2));
				var rate2 = $('#rate2').val(randomNumberFromRange(1, 9).toFixed(2));
				var rate3 = $('#rate3').val(randomNumberFromRange(1, 9).toFixed(2));
				var mod1 = $('#mod1').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Middle Diameter X-Axis
				var mod2 = $('#mod2').val(randomNumberFromRange(1, 9).toFixed(2));
				var mod3 = $('#mod3').val(randomNumberFromRange(1, 9).toFixed(2));
				var load1 = $('#load1').val(randomNumberFromRange(1, 9).toFixed(2));
				var load2 = $('#load2').val(randomNumberFromRange(1, 9).toFixed(2));
				var load3 = $('#load3').val(randomNumberFromRange(1, 9).toFixed(2));
				var ucs1 = $('#ucs1').val(randomNumberFromRange(1, 9).toFixed(2));
				var ucs2 = $('#ucs2').val(randomNumberFromRange(1, 9).toFixed(2));
				var ucs3 = $('#ucs3').val(randomNumberFromRange(1, 9).toFixed(2));
				var cor1 = $('#cor1').val(randomNumberFromRange(1, 9).toFixed(2));
				var cor2 = $('#cor2').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Middle Diameter Y-Axis
				var cor3 = $('#cor3').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_1 = $('#com_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_2 = $('#com_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_3 = $('#com_3').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_4 = $('#com_4').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_5 = $('#com_5').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_6 = $('#com_6').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_7 = $('#com_7').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_8 = $('#com_8').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_9 = $('#com_9').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Lower Diameter X-Axis
				var com_10 = $('#com_10').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_11 = $('#com_11').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_12 = $('#com_12').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_13 = $('#com_13').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_14 = $('#com_14').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_15 = $('#com_15').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_16 = $('#com_16').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_17 = $('#com_17').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_18 = $('#com_18').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_19 = $('#com_19').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Lower Diameter Y-Axis
				var com_20 = $('#com_20').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_21 = $('#com_21').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_22 = $('#com_22').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_23 = $('#com_23').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_24 = $('#com_24').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_25 = $('#com_25').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_26 = $('#com_26').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_27 = $('#com_27').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_28 = $('#com_28').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_29 = $('#com_29').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Average Diameter D
				var com_30 = $('#com_30').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_31 = $('#com_31').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_32 = $('#com_32').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_33 = $('#com_33').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_34 = $('#com_34').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_35 = $('#com_35').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_36 = $('#com_36').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_37 = $('#com_37').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_38 = $('#com_38').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_39 = $('#com_39').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Length of Specimen L
				var com_109 = $('#com_109').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_40 = $('#com_40').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_41 = $('#com_41').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_42 = $('#com_42').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_43 = $('#com_43').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_44 = $('#com_44').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_45 = $('#com_45').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_46 = $('#com_46').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_47 = $('#com_47').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_48 = $('#com_48').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Cross Sectional Area A
				var com_49 = $('#com_49').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_50 = $('#com_50').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_51 = $('#com_51').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_52 = $('#com_52').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_53 = $('#com_53').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_54 = $('#com_54').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_55 = $('#com_55').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_56 = $('#com_56').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_57 = $('#com_57').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_58 = $('#com_58').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Weight W
				var com_59 = $('#com_59').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_60 = $('#com_60').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_61 = $('#com_61').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_62 = $('#com_62').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_63 = $('#com_63').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_64 = $('#com_64').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_65 = $('#com_65').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_66 = $('#com_66').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_67 = $('#com_67').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_68 = $('#com_68').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Dry Density yd
				var com_69 = $('#com_69').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_70 = $('#com_70').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_71 = $('#com_71').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_72 = $('#com_72').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_73 = $('#com_73').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_74 = $('#com_74').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_75 = $('#com_75').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_76 = $('#com_76').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_77 = $('#com_77').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_78 = $('#com_78').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Length to Diameter Ratio R = L / D
				var com_79 = $('#com_109').val() / $('#com_30').val();
				var com_80 = $('#com_40').val() / $('#com_31').val();
				var com_81 = $('#com_41').val() / $('#com_32').val();
				var com_82 = $('#com_42').val() / $('#com_33').val();
				var com_83 = $('#com_43').val() / $('#com_34').val();
				var com_84 = $('#com_44').val() / $('#com_35').val();
				var com_85 = $('#com_45').val() / $('#com_36').val();
				var com_86 = $('#com_46').val() / $('#com_37').val();
				var com_87 = $('#com_47').val() / $('#com_38').val();
				var com_88 = $('#com_48').val() / $('#com_39').val();
				
				$('#com_79').val(com_79.toFixed(2));
				$('#com_80').val(com_80.toFixed(2));
				$('#com_81').val(com_81.toFixed(2));
				$('#com_82').val(com_82.toFixed(2));
				$('#com_83').val(com_83.toFixed(2));
				$('#com_84').val(com_84.toFixed(2));
				$('#com_85').val(com_85.toFixed(2));
				$('#com_86').val(com_86.toFixed(2));
				$('#com_87').val(com_87.toFixed(2));
				$('#com_88').val(com_88.toFixed(2));
				
				//Failure Load P
				var com_89 = $('#com_89').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_90 = $('#com_90').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_91 = $('#com_91').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_92 = $('#com_92').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_93 = $('#com_93').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_94 = $('#com_94').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_95 = $('#com_95').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_96 = $('#com_96').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_97 = $('#com_97').val(randomNumberFromRange(1, 9).toFixed(2));
				var com_98 = $('#com_98').val(randomNumberFromRange(1, 9).toFixed(2));
				
				//Unconfined Compressive Strength σ = P / A
				var com_99 =  $('#com_89').val() / $('#com_49').val() ;
				var com_100 = $('#com_90').val() / $('#com_50').val() ;
				var com_101 = $('#com_91').val() / $('#com_51').val() ;
				var com_102 = $('#com_92').val() / $('#com_52').val() ;
				var com_103 = $('#com_93').val() / $('#com_53').val() ;
				var com_104 = $('#com_94').val() / $('#com_54').val() ;
				var com_105 = $('#com_95').val() / $('#com_55').val() ;
				var com_106 = $('#com_96').val() / $('#com_56').val() ;
				var com_107 = $('#com_97').val() / $('#com_57').val() ;
				var com_108 = $('#com_98').val() / $('#com_58').val() ;
				
				$('#com_99').val(com_99.toFixed(2));
				$('#com_100').val(com_100.toFixed(2));
				$('#com_101').val(com_101.toFixed(2));
				$('#com_102').val(com_102.toFixed(2));
				$('#com_103').val(com_103.toFixed(2));
				$('#com_104').val(com_104.toFixed(2));
				$('#com_105').val(com_105.toFixed(2));
				$('#com_106').val(com_106.toFixed(2));
				$('#com_107').val(com_107.toFixed(2));
				$('#com_108').val(com_108.toFixed(2));
		}

		$('#chk_com').change(function() {
			if (this.checked) {
				com_auto();
			} else {
				$('#txtcom').css("background-color", "white");
				$('#desc1').val(null);
				$('#desc2').val(null);
				$('#desc3').val(null);
				$('#con1').val(null);
				$('#con2').val(null);
				$('#con3').val(null);
				$('#depth1').val(null);
				$('#depth2').val(null);
				$('#depth3').val(null);
				$('#length1').val(null);
				$('#length2').val(null);
				$('#length3').val(null);
				$('#dia1').val(null);
				$('#dia2').val(null);
				$('#dia3').val(null);
				$('#ratio1').val(null);
				$('#ratio2').val(null);
				$('#ratio3').val(null);
				$('#corr1').val(null);
				$('#corr2').val(null);
				$('#corr3').val(null);
				$('#area1').val(null);
				$('#area2').val(null);
				$('#area3').val(null);
				$('#fla1').val(null);
				$('#fla2').val(null);
				$('#fla3').val(null);
				$('#par1').val(null);
				$('#par2').val(null);
				$('#par3').val(null);
				$('#ppl1').val(null);
				$('#ppl2').val(null);
				$('#ppl3').val(null);
				$('#str1').val(null);
				$('#str2').val(null);
				$('#str3').val(null);
				$('#rate1').val(null);
				$('#rate2').val(null);
				$('#rate3').val(null);
				$('#mod1').val(null);
				$('#mod2').val(null);
				$('#mod3').val(null);
				$('#load1').val(null);
				$('#load2').val(null);
				$('#load3').val(null);
				$('#ucs1').val(null);
				$('#ucs2').val(null);
				$('#ucs3').val(null);
				$('#cor1').val(null);
				$('#cor2').val(null);
				$('#cor3').val(null);
				$('#avg_ucs').val(null);
				$('#com_1').val(null);
				$('#com_2').val(null);
				$('#com_3').val(null);
				$('#com_4').val(null);
				$('#com_5').val(null);
				$('#com_6').val(null);
				$('#com_7').val(null);
				$('#com_8').val(null);
				$('#com_9').val(null);
				$('#com_10').val(null);
				$('#com_11').val(null);
				$('#com_12').val(null);
				$('#com_13').val(null);
				$('#com_14').val(null);
				$('#com_15').val(null);
				$('#com_16').val(null);
				$('#com_17').val(null);
				$('#com_18').val(null);
				$('#com_19').val(null);
				$('#com_20').val(null);
				$('#com_21').val(null);
				$('#com_22').val(null);
				$('#com_23').val(null);
				$('#com_24').val(null);
				$('#com_25').val(null);
				$('#com_26').val(null);
				$('#com_27').val(null);
				$('#com_28').val(null);
				$('#com_29').val(null);
				$('#com_30').val(null);
				$('#com_31').val(null);
				$('#com_32').val(null);
				$('#com_33').val(null);
				$('#com_34').val(null);
				$('#com_35').val(null);
				$('#com_36').val(null);
				$('#com_37').val(null);
				$('#com_38').val(null);
				$('#com_39').val(null);
				$('#com_40').val(null);
				$('#com_41').val(null);
				$('#com_42').val(null);
				$('#com_43').val(null);
				$('#com_44').val(null);
				$('#com_45').val(null);
				$('#com_46').val(null);
				$('#com_47').val(null);
				$('#com_48').val(null);
				$('#com_49').val(null);
				$('#com_50').val(null);
				$('#com_51').val(null);
				$('#com_52').val(null);
				$('#com_53').val(null);
				$('#com_54').val(null);
				$('#com_55').val(null);
				$('#com_56').val(null);
				$('#com_57').val(null);
				$('#com_58').val(null);
				$('#com_59').val(null);
				$('#com_60').val(null);
				$('#com_61').val(null);
				$('#com_62').val(null);
				$('#com_63').val(null);
				$('#com_64').val(null);
				$('#com_65').val(null);
				$('#com_66').val(null);
				$('#com_67').val(null);
				$('#com_68').val(null);
				$('#com_69').val(null);
				$('#com_70').val(null);
				$('#com_71').val(null);
				$('#com_72').val(null);
				$('#com_73').val(null);
				$('#com_74').val(null);
				$('#com_75').val(null);
				$('#com_76').val(null);
				$('#com_77').val(null);
				$('#com_78').val(null);
				$('#com_79').val(null);
				$('#com_80').val(null);
				$('#com_81').val(null);
				$('#com_82').val(null);
				$('#com_83').val(null);
				$('#com_84').val(null);
				$('#com_85').val(null);
				$('#com_86').val(null);
				$('#com_87').val(null);
				$('#com_88').val(null);
				$('#com_89').val(null);
				$('#com_90').val(null);
				$('#com_91').val(null);
				$('#com_92').val(null);
				$('#com_93').val(null);
				$('#com_94').val(null);
				$('#com_95').val(null);
				$('#com_96').val(null);
				$('#com_97').val(null);
				$('#com_98').val(null);
				$('#com_99').val(null);
				$('#com_100').val(null);
				$('#com_101').val(null);
				$('#com_102').val(null);
				$('#com_103').val(null);
				$('#com_104').val(null);
				$('#com_105').val(null);
				$('#com_106').val(null);
				$('#com_107').val(null);
				$('#com_108').val(null);
				$('#com_109').val(null);
			}

		});



		//POINT LOAD STRENGTH
		function poi_auto() {
			$('#txtpor').css("background-color", "var(--success)");
			    var wtr_temp_1 = $('#wtr_temp_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var wtr_temp_2 = $('#wtr_temp_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var wtr_temp_3 = $('#wtr_temp_3').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var rt_m_1 = $('#rt_m_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var rt_m_2 = $('#rt_m_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var rt_m_3 = $('#rt_m_3').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var ss_m1_1 = $('#ss_m1_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var ss_m1_2 = $('#ss_m1_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var ss_m1_3 = $('#ss_m1_3').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var ss_m2_1 = $('#ss_m2_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var ss_m2_2 = $('#ss_m2_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var ss_m2_3 = $('#ss_m2_3').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var ss_m3_1 = $('#ss_m3_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var ss_m3_2 = $('#ss_m3_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var ss_m3_3 = $('#ss_m3_3').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var ss_m4_1 = $('#ss_m4_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var ss_m4_2 = $('#ss_m4_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var ss_m4_3 = $('#ss_m4_3').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var ss_m5_1 = $('#ss_m5_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var ss_m5_2 = $('#ss_m5_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var ss_m5_3 = $('#ss_m5_3').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var ssm_sub_1 = $('#ss_m2_1').val() - $('#ss_m1_1').val();
				var ssm_sub_2 = $('#ss_m2_2').val() - $('#ss_m1_2').val();
				var ssm_sub_3 = $('#ss_m2_3').val() - $('#ss_m1_3').val();
				
				$('#ssm_sub_1').val(ssm_sub_1.toFixed(2));
				$('#ssm_sub_2').val(ssm_sub_2.toFixed(2));
				$('#ssm_sub_3').val(ssm_sub_3.toFixed(2));
				
				var ssm_sat_1 = $('#ss_m4_1').val() - $('#ss_m3_1').val();
				var ssm_sat_2 = $('#ss_m4_2').val() - $('#ss_m3_2').val();
				var ssm_sat_3 = $('#ss_m4_3').val() - $('#ss_m3_3').val();
				
				$('#ssm_sat_1').val(ssm_sat_1.toFixed(2));
				$('#ssm_sat_2').val(ssm_sat_2.toFixed(2));
				$('#ssm_sat_3').val(ssm_sat_3.toFixed(2));
				
				var dm_ms_1 = $('#ss_m5_1').val() - $('#ss_m3_1').val();
				var dm_ms_2 = $('#ss_m5_2').val() - $('#ss_m3_2').val();
				var dm_ms_3 = $('#ss_m5_3').val() - $('#ss_m3_3').val();
				
				$('#dm_ms_1').val(dm_ms_1.toFixed(2));
				$('#dm_ms_2').val(dm_ms_2.toFixed(2));
				$('#dm_ms_3').val(dm_ms_3.toFixed(2));
				
				var bvol_1 = ($('#ssm_sat_1').val() - $('#ssm_sub_1').val()) / 1000;
                var bvol_2 = ($('#ssm_sat_2').val() - $('#ssm_sub_2').val()) / 1000;
                var bvol_3 = ($('#ssm_sat_3').val() - $('#ssm_sub_3').val()) / 1000;
				
				$('#bvol_1').val(bvol_1.toFixed(2));
				$('#bvol_2').val(bvol_2.toFixed(2));
				$('#bvol_3').val(bvol_3.toFixed(2));
				
				var pv_1 = ($('#ssm_sat_1').val() - $('#dm_ms_1').val()) / 1000;
				var pv_2 = ($('#ssm_sat_2').val() - $('#dm_ms_2').val()) / 1000;
				var pv_3 = ($('#ssm_sat_3').val() - $('#dm_ms_3').val()) / 1000;
				
				
				$('#pv_1').val(pv_1.toFixed(2));
				$('#pv_2').val(pv_2.toFixed(2));
				$('#pv_3').val(pv_3.toFixed(2));
				
				var por_1 = ($('#pv_1').val() / $('#bvol_1').val()) * 100;
				var por_2 = ($('#pv_2').val() / $('#bvol_2').val()) * 100;
				var por_3 = ($('#pv_3').val() / $('#bvol_3').val()) * 100;
				
				
				$('#por_1').val(por_1.toFixed(2));
				$('#por_2').val(por_2.toFixed(2));
				$('#por_3').val(por_3.toFixed(2));
				
				var pd_1 = $('#dm_ms_1').val() / $('#bvol_1').val();
				var pd_2 = $('#dm_ms_2').val() / $('#bvol_2').val();
				var pd_3 = $('#dm_ms_3').val() / $('#bvol_3').val();
				
				
				$('#pd_1').val(pd_1.toFixed(2));
				$('#pd_2').val(pd_2.toFixed(2));
				$('#pd_3').val(pd_3.toFixed(2));
				
				var wc_1 = ($('#ss_m4_1').val() - $('#ss_m3_1').val()) - ($('#ss_m5_1').val() - $('#ss_m3_1').val()) / ($('#ss_m5_1').val() - $('#ss_m3_1').val()) * 100;
				var wc_2 = ($('#ss_m4_2').val() - $('#ss_m3_2').val()) - ($('#ss_m5_2').val() - $('#ss_m3_2').val()) / ($('#ss_m5_2').val() - $('#ss_m3_2').val()) * 100;
				var wc_3 = ($('#ss_m4_3').val() - $('#ss_m3_3').val()) - ($('#ss_m5_3').val() - $('#ss_m3_3').val()) / ($('#ss_m5_3').val() - $('#ss_m3_3').val()) * 100;
				
				$('#wc_1').val(wc_1.toFixed(2));
				$('#wc_2').val(wc_2.toFixed(2));
				$('#wc_3').val(wc_3.toFixed(2));
		}

		$('#chk_por').change(function() {
			if (this.checked) {
				poi_auto();
			} else {
				$('#txtpor').css("background-color", "white");
				$('#wtr_temp_1').val(null);
				$('#wtr_temp_2').val(null);
				$('#wtr_temp_3').val(null);
				$('#rt_m_1').val(null);
				$('#rt_m_2').val(null);
				$('#rt_m_3').val(null);
				$('#ss_m1_1').val(null);
				$('#ss_m1_2').val(null);
				$('#ss_m1_3').val(null);
				$('#ss_m2_1').val(null);
				$('#ss_m2_2').val(null);
				$('#ss_m2_3').val(null);
				$('#ss_m3_1').val(null);
				$('#ss_m3_2').val(null);
				$('#ss_m3_3').val(null);
				$('#ss_m4_1').val(null);
				$('#ss_m4_2').val(null);
				$('#ss_m4_3').val(null);
				$('#ss_m5_1').val(null);
				$('#ss_m5_2').val(null);
				$('#ss_m5_3').val(null);
				$('#ssm_sub_1').val(null);
				$('#ssm_sub_2').val(null);
				$('#ssm_sub_3').val(null);
				$('#ssm_sat_1').val(null);
				$('#ssm_sat_2').val(null);
				$('#ssm_sat_3').val(null);
				$('#dm_ms_1').val(null);
				$('#dm_ms_2').val(null);
				$('#dm_ms_3').val(null);
				$('#bvol_1').val(null);
				$('#bvol_2').val(null);
				$('#bvol_3').val(null);
				$('#pv_1').val(null);
				$('#pv_2').val(null);
				$('#pv_3').val(null);
				$('#por_1').val(null);
				$('#por_2').val(null);
				$('#por_3').val(null);
				$('#pd_1').val(null);
				$('#pd_2').val(null);
				$('#pd_3').val(null);
				$('#wc_1').val(null);
				$('#wc_2').val(null);
				$('#wc_3').val(null);
			}

		});
		

		// Specific GRAVITY & Water Absorption
		function sp_auto() {
			$('#txtspg').css("background-color", "var(--success)");
			
			    var sp_wt_st_1 = $('#sp_wt_st_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_wt_st_2 = $('#sp_wt_st_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_wt_st_3 = $('#sp_wt_st_3').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_wt_st_4 = $('#sp_wt_st_4').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_wt_st_5 = $('#sp_wt_st_5').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_wt_st_6 = $('#sp_wt_st_6').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_wt_st_7 = $('#sp_wt_st_7').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_wt_st_8 = $('#sp_wt_st_8').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_wt_st_9 = $('#sp_wt_st_9').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var sp_w_s_1 = $('#sp_w_s_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_s_2 = $('#sp_w_s_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_s_3 = $('#sp_w_s_3').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_s_4 = $('#sp_w_s_4').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_s_5 = $('#sp_w_s_5').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_s_6 = $('#sp_w_s_6').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_s_7 = $('#sp_w_s_7').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_s_8 = $('#sp_w_s_8').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_s_9 = $('#sp_w_s_9').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var sp_w_sur_1 = $('#sp_w_sur_1').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_sur_2 = $('#sp_w_sur_2').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_sur_3 = $('#sp_w_sur_3').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_sur_4 = $('#sp_w_sur_4').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_sur_5 = $('#sp_w_sur_5').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_sur_6 = $('#sp_w_sur_6').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_sur_7 = $('#sp_w_sur_7').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_sur_8 = $('#sp_w_sur_8').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_w_sur_9 = $('#sp_w_sur_9').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var sp_agg1 = $('#sp_agg1').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_agg2 = $('#sp_agg2').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_agg3 = $('#sp_agg3').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_agg4 = $('#sp_agg4').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_agg5 = $('#sp_agg5').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_agg6 = $('#sp_agg6').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_agg7 = $('#sp_agg7').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_agg8 = $('#sp_agg8').val(randomNumberFromRange(1, 9).toFixed(2));
				var sp_agg9 = $('#sp_agg9').val(randomNumberFromRange(1, 9).toFixed(2));
				
				var sp_wat1 = $('#sp_w_s_1').val() / (1000 - $('#sp_agg1').val());
				var sp_wat2 = $('#sp_w_s_2').val() / (1000 - $('#sp_agg2').val());
				var sp_wat3 = $('#sp_w_s_3').val() / (1000 - $('#sp_agg3').val());
				var sp_wat4 = $('#sp_w_s_4').val() / (1000 - $('#sp_agg4').val());
				var sp_wat5 = $('#sp_w_s_5').val() / (1000 - $('#sp_agg5').val());
				var sp_wat6 = $('#sp_w_s_6').val() / (1000 - $('#sp_agg6').val());
				var sp_wat7 = $('#sp_w_s_7').val() / (1000 - $('#sp_agg7').val());
				var sp_wat8 = $('#sp_w_s_8').val() / (1000 - $('#sp_agg8').val());
				var sp_wat9 = $('#sp_w_s_9').val() / (1000 - $('#sp_agg9').val());
				
				
				
				$('#sp_wat1').val(sp_wat1.toFixed(2));
				$('#sp_wat2').val(sp_wat2.toFixed(2));
				$('#sp_wat3').val(sp_wat3.toFixed(2));
				$('#sp_wat4').val(sp_wat4.toFixed(2));
				$('#sp_wat5').val(sp_wat5.toFixed(2));
				$('#sp_wat6').val(sp_wat6.toFixed(2));
				$('#sp_wat7').val(sp_wat7.toFixed(2));
				$('#sp_wat8').val(sp_wat8.toFixed(2));
				$('#sp_wat9').val(sp_wat9.toFixed(2));
				
				var sp_specific_gravity_1 = ($('#sp_w_sur_1').val() - $('#sp_w_s_1').val()) / $('#sp_w_s_1').val() * 100;
				var sp_specific_gravity_2 = ($('#sp_w_sur_2').val() - $('#sp_w_s_2').val()) / $('#sp_w_s_2').val() * 100;
				var sp_specific_gravity_3 = ($('#sp_w_sur_3').val() - $('#sp_w_s_3').val()) / $('#sp_w_s_3').val() * 100;
				var sp_specific_gravity_4 = ($('#sp_w_sur_4').val() - $('#sp_w_s_4').val()) / $('#sp_w_s_4').val() * 100;
				var sp_specific_gravity_5 = ($('#sp_w_sur_5').val() - $('#sp_w_s_5').val()) / $('#sp_w_s_5').val() * 100;
				var sp_specific_gravity_6 = ($('#sp_w_sur_6').val() - $('#sp_w_s_6').val()) / $('#sp_w_s_6').val() * 100;
				var sp_specific_gravity_7 = ($('#sp_w_sur_7').val() - $('#sp_w_s_7').val()) / $('#sp_w_s_7').val() * 100;
				var sp_specific_gravity_8 = ($('#sp_w_sur_8').val() - $('#sp_w_s_8').val()) / $('#sp_w_s_8').val() * 100;
				var sp_specific_gravity_9 = ($('#sp_w_sur_9').val() - $('#sp_w_s_9').val()) / $('#sp_w_s_9').val() * 100;
				
			
				$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
				$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
				$('#sp_specific_gravity_3').val(sp_specific_gravity_3.toFixed(2));
				$('#sp_specific_gravity_4').val(sp_specific_gravity_4.toFixed(2));
				$('#sp_specific_gravity_5').val(sp_specific_gravity_5.toFixed(2));
				$('#sp_specific_gravity_6').val(sp_specific_gravity_6.toFixed(2));
				$('#sp_specific_gravity_7').val(sp_specific_gravity_7.toFixed(2));
				$('#sp_specific_gravity_8').val(sp_specific_gravity_8.toFixed(2));
				$('#sp_specific_gravity_9').val(sp_specific_gravity_9.toFixed(2));
				
				var sp_water_abr_1 = $('#sp_w_sur_1').val() - $('#sp_w_s_1').val() / 1000 - $('#sp_agg1').val() * 100;
				var sp_water_abr_2 = $('#sp_w_sur_2').val() - $('#sp_w_s_2').val() / 1000 - $('#sp_agg2').val() * 100;
				var sp_water_abr_3 = $('#sp_w_sur_3').val() - $('#sp_w_s_3').val() / 1000 - $('#sp_agg3').val() * 100;
				var sp_water_abr_4 = $('#sp_w_sur_4').val() - $('#sp_w_s_4').val() / 1000 - $('#sp_agg4').val() * 100;
				var sp_water_abr_5 = $('#sp_w_sur_5').val() - $('#sp_w_s_5').val() / 1000 - $('#sp_agg5').val() * 100;
				var sp_water_abr_6 = $('#sp_w_sur_6').val() - $('#sp_w_s_6').val() / 1000 - $('#sp_agg6').val() * 100;
				var sp_water_abr_7 = $('#sp_w_sur_7').val() - $('#sp_w_s_7').val() / 1000 - $('#sp_agg7').val() * 100;
				var sp_water_abr_8 = $('#sp_w_sur_8').val() - $('#sp_w_s_8').val() / 1000 - $('#sp_agg8').val() * 100;
				var sp_water_abr_9 = $('#sp_w_sur_9').val() - $('#sp_w_s_9').val() / 1000 - $('#sp_agg9').val() * 100;
				
				$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
				$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
				$('#sp_water_abr_3').val(sp_water_abr_3.toFixed(2));
				$('#sp_water_abr_4').val(sp_water_abr_4.toFixed(2));
				$('#sp_water_abr_5').val(sp_water_abr_5.toFixed(2));
				$('#sp_water_abr_6').val(sp_water_abr_6.toFixed(2));
				$('#sp_water_abr_7').val(sp_water_abr_7.toFixed(2));
				$('#sp_water_abr_8').val(sp_water_abr_8.toFixed(2));
				$('#sp_water_abr_9').val(sp_water_abr_9.toFixed(2));
				
				var sp_specific_gravity = ((+sp_wat1) + (+sp_wat2) + (+sp_wat3)) / 3;
				var sp_sg_avg_2 = ((+sp_wat4) + (+sp_wat5) + (+sp_wat6)) / 3;
				var sp_sg_avg_3 = ((+sp_wat7) + (+sp_wat8) + (+sp_wat9)) / 3;
				
				$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
				$('#sp_sg_avg_2').val(sp_sg_avg_2.toFixed(2));
				$('#sp_sg_avg_3').val(sp_sg_avg_3.toFixed(2));
				
				var sp_water_abr = ((+sp_specific_gravity_1) + (+sp_specific_gravity_2) + (+sp_specific_gravity_3)) / 3;
				var sp_wa_avg_2 = ((+sp_specific_gravity_4) + (+sp_specific_gravity_5) + (+sp_specific_gravity_6)) / 3;
				var sp_wa_avg_3 = ((+sp_specific_gravity_7) + (+sp_specific_gravity_8) + (+sp_specific_gravity_9)) / 3;
				
				$('#sp_water_abr').val(sp_water_abr.toFixed(2));
				$('#sp_wa_avg_2').val(sp_wa_avg_2.toFixed(2));
				$('#sp_wa_avg_3').val(sp_wa_avg_3.toFixed(2));
				
				var sp_porosity_1 = ((+sp_water_abr_1) + (+sp_water_abr_2) + (+sp_water_abr_3)) / 3;
				var sp_porosity_2 = ((+sp_water_abr_4) + (+sp_water_abr_5) + (+sp_water_abr_6)) / 3;
				var sp_porosity_3 = ((+sp_water_abr_7) + (+sp_water_abr_8) + (+sp_water_abr_9)) / 3;
				
				
				$('#sp_porosity_1').val(sp_porosity_1.toFixed(2));
				$('#sp_porosity_2').val(sp_porosity_2.toFixed(2));
				$('#sp_porosity_3').val(sp_porosity_3.toFixed(2));
		}


		//SPECIFIC GRAVITY
		$('#chk_sp').change(function() {
			if (this.checked) {
				sp_auto();

			} else {
				$('#sp_wt_st_1').val(null);
				$('#sp_wt_st_2').val(null);
				$('#sp_wt_st_3').val(null);
				$('#sp_wt_st_4').val(null);
				$('#sp_wt_st_5').val(null);
				$('#sp_wt_st_6').val(null);
				$('#sp_wt_st_7').val(null);
				$('#sp_wt_st_8').val(null);
				$('#sp_wt_st_9').val(null);
				
				$('#sp_temp').val(null);
				
				$('#sp_w_s_1').val(null);
				$('#sp_w_s_2').val(null);
				$('#sp_w_s_3').val(null);
				$('#sp_w_s_4').val(null);
				$('#sp_w_s_5').val(null);
				$('#sp_w_s_6').val(null);
				$('#sp_w_s_7').val(null);
				$('#sp_w_s_8').val(null);
				$('#sp_w_s_9').val(null);
				
				$('#sp_w_sur_1').val(null);
				$('#sp_w_sur_2').val(null);
				$('#sp_w_sur_3').val(null);
				$('#sp_w_sur_4').val(null);
				$('#sp_w_sur_5').val(null);
				$('#sp_w_sur_6').val(null);
				$('#sp_w_sur_7').val(null);
				$('#sp_w_sur_8').val(null);
				$('#sp_w_sur_9').val(null);
				
				$('#sp_agg1').val(null);
				$('#sp_agg2').val(null);
				$('#sp_agg3').val(null);
				$('#sp_agg4').val(null);
				$('#sp_agg5').val(null);
				$('#sp_agg6').val(null);
				$('#sp_agg7').val(null);
				$('#sp_agg8').val(null);
				$('#sp_agg9').val(null);
				
				
				$('#sp_wat1').val(null);
				$('#sp_wat2').val(null);
				$('#sp_wat3').val(null);
				$('#sp_wat4').val(null);
				$('#sp_wat5').val(null);
				$('#sp_wat6').val(null);
				$('#sp_wat7').val(null);
				$('#sp_wat8').val(null);
				$('#sp_wat9').val(null);
				
				
				$('#sp_specific_gravity_1').val(null);
				$('#sp_specific_gravity_2').val(null);
				$('#sp_specific_gravity_3').val(null);
				$('#sp_specific_gravity_4').val(null);
				$('#sp_specific_gravity_5').val(null);
				$('#sp_specific_gravity_6').val(null);
				$('#sp_specific_gravity_7').val(null);
				$('#sp_specific_gravity_8').val(null);
				$('#sp_specific_gravity_9').val(null);
				
				
				$('#sp_water_abr_1').val(null);
				$('#sp_water_abr_2').val(null);
				$('#sp_water_abr_3').val(null);
				$('#sp_water_abr_4').val(null);
				$('#sp_water_abr_5').val(null);
				$('#sp_water_abr_6').val(null);
				$('#sp_water_abr_7').val(null);
				$('#sp_water_abr_8').val(null);
				$('#sp_water_abr_9').val(null);
				
				
				$('#sp_specific_gravity').val(null);
				$('#sp_sg_avg_2').val(null);
				$('#sp_sg_avg_3').val(null);
				
				
				$('#sp_water_abr').val(null);
				$('#sp_wa_avg_2').val(null);
				$('#sp_wa_avg_3').val(null);
				
				
				
				$('#sp_porosity_1').val(null);
				$('#sp_porosity_2').val(null);
				$('#sp_porosity_3').val(null);
				
			}
		});

		$('#desc1,#desc2,#desc3,#con1,#con2,#con3,#depth1,#depth2,#depth3,#length1,#length2,#length3,#dia1,#dia2,#dia3,#ratio1,#ratio2,#ratio3,#corr1,#corr2,#corr3,#area1,#area2,#area3,#fla1,#fla2,#fla3,#par1,#par2,#par3,#ppl1,#ppl2,#ppl3,#str1,#str2,#str3,#rate1,#rate2,#rate3,#mod1,#com_30,#com_31,#com_32,#com_33,#com_34,#com_35,#com_36,#com_37,#com_38,#com_39,#com_109,#com_40,#com_41,#com_42,#com_43,#com_44,#com_45,#com_46,#com_47,#com_48,#com_49,#com_50,#com_51,#com_52,#com_53,#com_54,#com_55,#com_56,#com_57,#com_58,#com_59,#com_60,#com_61,#com_62,#com_63,#com_64,#com_65,#com_66,#com_67,#com_68,#com_69,#com_70,#com_71,#com_72,#com_73,#com_74,#com_75,#com_76,#com_77,#com_78,#com_79,#com_80,#com_81,#com_82,#com_83,#com_84,#com_85,#com_86,#com_87,#com_88,#com_89,#com_90,#com_91,#com_92,#com_93,#com_94,#com_95,#com_96,#com_97,#com_98,#com_99,#com_100,#com_101,#com_102,#com_103,#com_104,#com_105,#com_106,#com_107,#com_108').change(function() {
			
				$('#txtcom').css("background-color", "var(--success)");
				//Sample ID
				var desc1 = $('#desc1').val();
				var desc2 = $('#desc2').val();
				var desc3 = $('#desc3').val();
				var con1 = $('#con1').val();
				var con2 = $('#con2').val();
				var con3 = $('#con3').val();
				var depth1 = $('#depth1').val();
				var depth2 = $('#depth2').val();
				var depth3 = $('#depth3').val();
				var length1 = $('#length1').val();
				
				//Sample Depth
				var length2 = $('#length2').val();
				var length3 = $('#length3').val();
				var dia1 = $('#dia1').val();
				var dia2 = $('#dia2').val();
				var dia3 = $('#dia3').val();
				var ratio1 = $('#ratio1').val();
				var ratio2 = $('#ratio2').val();
				var ratio3 = $('#ratio3').val();
				var corr1 = $('#corr1').val();
				var corr2 = $('#corr2').val();
				
				//Upper Diameter X-Axis
				var corr3 = $('#corr3').val();
				var area1 = $('#area1').val();
				var area2 = $('#area2').val();
				var area3 = $('#area3').val();
				var fla1 = $('#fla1').val();
				var fla2 = $('#fla2').val();
				var fla3 = $('#fla3').val();
				var par1 = $('#par1').val();
				var par2 = $('#par2').val();
				var par3 = $('#par3').val();
				
				//Upper Diameter Y-Axis
				var ppl1 = $('#ppl1').val();
				var ppl2 = $('#ppl2').val();
				var ppl3 = $('#ppl3').val();
				var str1 = $('#str1').val();
				var str2 = $('#str2').val();
				var str3 = $('#str3').val();
				var rate1 = $('#rate1').val();
				var rate2 = $('#rate2').val();
				var rate3 = $('#rate3').val();
				var mod1 = $('#mod1').val();
				
				//Middle Diameter X-Axis
				var mod2 = $('#mod2').val();
				var mod3 = $('#mod3').val();
				var load1 = $('#load1').val();
				var load2 = $('#load2').val();
				var load3 = $('#load3').val();
				var ucs1 = $('#ucs1').val();
				var ucs2 = $('#ucs2').val();
				var ucs3 = $('#ucs3').val();
				var cor1 = $('#cor1').val();
				var cor2 = $('#cor2').val();
				
				//Middle Diameter Y-Axis
				var cor3 = $('#cor3').val();
				var com_1 = $('#com_1').val();
				var com_2 = $('#com_2').val();
				var com_3 = $('#com_3').val();
				var com_4 = $('#com_4').val();
				var com_5 = $('#com_5').val();
				var com_6 = $('#com_6').val();
				var com_7 = $('#com_7').val();
				var com_8 = $('#com_8').val();
				var com_9 = $('#com_9').val();
				
				//Lower Diameter X-Axis
				var com_10 = $('#com_10').val();
				var com_11 = $('#com_11').val();
				var com_12 = $('#com_12').val();
				var com_13 = $('#com_13').val();
				var com_14 = $('#com_14').val();
				var com_15 = $('#com_15').val();
				var com_16 = $('#com_16').val();
				var com_17 = $('#com_17').val();
				var com_18 = $('#com_18').val();
				var com_19 = $('#com_19').val();
				
				//Lower Diameter Y-Axis
				var com_20 = $('#com_20').val();
				var com_21 = $('#com_21').val();
				var com_22 = $('#com_22').val();
				var com_23 = $('#com_23').val();
				var com_24 = $('#com_24').val();
				var com_25 = $('#com_25').val();
				var com_26 = $('#com_26').val();
				var com_27 = $('#com_27').val();
				var com_28 = $('#com_28').val();
				var com_29 = $('#com_29').val();
				
				//Average Diameter D
				var com_30 = $('#com_30').val();
				var com_31 = $('#com_31').val();
				var com_32 = $('#com_32').val();
				var com_33 = $('#com_33').val();
				var com_34 = $('#com_34').val();
				var com_35 = $('#com_35').val();
				var com_36 = $('#com_36').val();
				var com_37 = $('#com_37').val();
				var com_38 = $('#com_38').val();
				var com_39 = $('#com_39').val();
				
				//Length of Specimen L
				var com_109 = $('#com_109').val();
				var com_40 = $('#com_40').val();
				var com_41 = $('#com_41').val();
				var com_42 = $('#com_42').val();
				var com_43 = $('#com_43').val();
				var com_44 = $('#com_44').val();
				var com_45 = $('#com_45').val();
				var com_46 = $('#com_46').val();
				var com_47 = $('#com_47').val();
				var com_48 = $('#com_48').val();
				
				//Cross Sectional Area A
				var com_49 = $('#com_49').val();
				var com_50 = $('#com_50').val();
				var com_51 = $('#com_51').val();
				var com_52 = $('#com_52').val();
				var com_53 = $('#com_53').val();
				var com_54 = $('#com_54').val();
				var com_55 = $('#com_55').val();
				var com_56 = $('#com_56').val();
				var com_57 = $('#com_57').val();
				var com_58 = $('#com_58').val();
				
				//Weight W
				var com_59 = $('#com_59').val();
				var com_60 = $('#com_60').val();
				var com_61 = $('#com_61').val();
				var com_62 = $('#com_62').val();
				var com_63 = $('#com_63').val();
				var com_64 = $('#com_64').val();
				var com_65 = $('#com_65').val();
				var com_66 = $('#com_66').val();
				var com_67 = $('#com_67').val();
				var com_68 = $('#com_68').val();
				
				//Dry Density yd
				var com_69 = $('#com_69').val();
				var com_70 = $('#com_70').val();
				var com_71 = $('#com_71').val();
				var com_72 = $('#com_72').val();
				var com_73 = $('#com_73').val();
				var com_74 = $('#com_74').val();
				var com_75 = $('#com_75').val();
				var com_76 = $('#com_76').val();
				var com_77 = $('#com_77').val();
				var com_78 = $('#com_78').val();
				
				//Length to Diameter Ratio R = L / D
				var com_79 = (+com_109) / (+com_30);
				var com_80 = (+com_40) / (+com_31);
				var com_81 = (+com_41) / (+com_32);
				var com_82 = (+com_42) / (+com_33);
				var com_83 = (+com_43) / (+com_34);
				var com_84 = (+com_44) / (+com_35);
				var com_85 = (+com_45) / (+com_36);
				var com_86 = (+com_46) / (+com_37);
				var com_87 = (+com_47) / (+com_38);
				var com_88 = (+com_48) / (+com_39);
				
				$('#com_79').val(com_79.toFixed(2));
				$('#com_80').val(com_80.toFixed(2));
				$('#com_81').val(com_81.toFixed(2));
				$('#com_82').val(com_82.toFixed(2));
				$('#com_83').val(com_83.toFixed(2));
				$('#com_84').val(com_84.toFixed(2));
				$('#com_85').val(com_85.toFixed(2));
				$('#com_86').val(com_86.toFixed(2));
				$('#com_87').val(com_87.toFixed(2));
				$('#com_88').val(com_88.toFixed(2));
				
				//Failure Load P
				var com_89 = $('#com_89').val();
				var com_90 = $('#com_90').val();
				var com_91 = $('#com_91').val();
				var com_92 = $('#com_92').val();
				var com_93 = $('#com_93').val();
				var com_94 = $('#com_94').val();
				var com_95 = $('#com_95').val();
				var com_96 = $('#com_96').val();
				var com_97 = $('#com_97').val();
				var com_98 = $('#com_98').val();
				
				//Unconfined Compressive Strength σ = P / A
				var com_99 = (+com_89) / (com_49);
				var com_100 = (+com_90) / (com_50);
				var com_101 = (+com_91) / (com_51);
				var com_102 = (+com_92) / (com_52);
				var com_103 = (+com_93) / (com_53);
				var com_104 = (+com_94) / (com_54);
				var com_105 = (+com_95) / (com_55);
				var com_106 = (+com_96) / (com_56);
				var com_107 = (+com_97) / (com_57);
				var com_108 = (+com_98) / (com_58);
				
				$('#com_99').val(com_99.toFixed(2));
				$('#com_100').val(com_100.toFixed(2));
				$('#com_101').val(com_101.toFixed(2));
				$('#com_102').val(com_102.toFixed(2));
				$('#com_103').val(com_103.toFixed(2));
				$('#com_104').val(com_104.toFixed(2));
				$('#com_105').val(com_105.toFixed(2));
				$('#com_106').val(com_106.toFixed(2));
				$('#com_107').val(com_107.toFixed(2));
				$('#com_108').val(com_108.toFixed(2));
		});

         		
				$('#wtr_temp_1,#wtr_temp_2,#wtr_temp_3,#rt_m_1,#rt_m_2,#rt_m_3,#ss_m1_1,#ss_m1_2,#ss_m1_3,#ss_m2_1,#ss_m2_2,#ss_m2_3,#ss_m3_1,#ss_m3_2,#ss_m3_3,#ss_m4_1,#ss_m4_2,#ss_m4_3,#ss_m5_1,#ss_m5_2,#ss_m5_3,#ssm_sub_1,#ssm_sub_2,#ssm_sub_3,#ssm_sat_1,#ssm_sat_2,#ssm_sat_3,#dm_ms_1,#dm_ms_2,#dm_ms_3,#bvol_1,#bvol_2,#bvol_3,#pv_1,#pv_2,#pv_3,#por_1,#por_2,#por_3,#pd_1,#pd_2,#pd_3,#wc_1,#wc_2,#wc_3').change(function() {
			
				$('#txtpor').css("background-color", "var(--success)");
				//Sample ID
				
				var wtr_temp_1 = $('#wtr_temp_1').val();
				var wtr_temp_2 = $('#wtr_temp_2').val();
				var wtr_temp_3 = $('#wtr_temp_3').val();
				
				var rt_m_1 = $('#rt_m_1').val();
				var rt_m_2 = $('#rt_m_2').val();
				var rt_m_3 = $('#rt_m_3').val();
				
				var ss_m1_1 = $('#ss_m1_1').val();
				var ss_m1_2 = $('#ss_m1_2').val();
				var ss_m1_3 = $('#ss_m1_3').val();
				
				var ss_m2_1 = $('#ss_m2_1').val();
				var ss_m2_2 = $('#ss_m2_2').val();
				var ss_m2_3 = $('#ss_m2_3').val();
				
				var ss_m3_1 = $('#ss_m3_1').val();
				var ss_m3_2 = $('#ss_m3_2').val();
				var ss_m3_3 = $('#ss_m3_3').val();
				
				var ss_m4_1 = $('#ss_m4_1').val();
				var ss_m4_2 = $('#ss_m4_2').val();
				var ss_m4_3 = $('#ss_m4_3').val();
				
				var ss_m5_1 = $('#ss_m5_1').val();
				var ss_m5_2 = $('#ss_m5_2').val();
				var ss_m5_3 = $('#ss_m5_3').val();
				
				var ssm_sub_1 = (+ss_m2_1) - (+ss_m1_1);
				var ssm_sub_2 = (+ss_m2_2) - (+ss_m1_2);
				var ssm_sub_3 = (+ss_m2_3) - (+ss_m1_3);
				
				$('#ssm_sub_1').val(ssm_sub_1.toFixed(2));
				$('#ssm_sub_2').val(ssm_sub_2.toFixed(2));
				$('#ssm_sub_3').val(ssm_sub_3.toFixed(2));
				
				
				var ssm_sat_1 = (+ss_m4_1) - (+ss_m3_1);
				var ssm_sat_2 = (+ss_m4_2) - (+ss_m3_2);
				var ssm_sat_3 = (+ss_m4_3) - (+ss_m3_3);
				
				$('#ssm_sat_1').val(ssm_sat_1.toFixed(2));
				$('#ssm_sat_2').val(ssm_sat_2.toFixed(2));
				$('#ssm_sat_3').val(ssm_sat_3.toFixed(2));
				
				var dm_ms_1 = (+ss_m5_1) - (+ss_m3_1);
				var dm_ms_2 = (+ss_m5_2) - (+ss_m3_2);
				var dm_ms_3 = (+ss_m5_3) - (+ss_m3_3);
				
				$('#dm_ms_1').val(dm_ms_1.toFixed(2));
				$('#dm_ms_2').val(dm_ms_2.toFixed(2));
				$('#dm_ms_3').val(dm_ms_3.toFixed(2));
				
				var bvol_1 = ((+ssm_sat_1) - (+ssm_sub_1)) / 1000;
				var bvol_2 = ((+ssm_sat_2) - (+ssm_sub_2)) / 1000;
				var bvol_3 = ((+ssm_sat_3) - (+ssm_sub_3)) / 1000;
				
				$('#bvol_1').val(bvol_1.toFixed(2));
				$('#bvol_2').val(bvol_2.toFixed(2));
				$('#bvol_3').val(bvol_3.toFixed(2));
				
				var pv_1 = ((+ssm_sat_1) - (+dm_ms_1)) / 1000;
				var pv_2 = ((+ssm_sat_2) - (+dm_ms_2)) / 1000;
				var pv_3 = ((+ssm_sat_3) - (+dm_ms_3)) / 1000;
				
				$('#pv_1').val(pv_1.toFixed(2));
				$('#pv_2').val(pv_2.toFixed(2));
				$('#pv_3').val(pv_3.toFixed(2));
				
				var por_1 = ((+pv_1) / (+bvol_1)) * 100;
				var por_2 = ((+pv_2) / (+bvol_2)) * 100;
				var por_3 = ((+pv_3) / (+bvol_3)) * 100;
				
				$('#por_1').val(por_1.toFixed(2));
				$('#por_2').val(por_2.toFixed(2));
				$('#por_3').val(por_3.toFixed(2));
				
				var pd_1 = (+dm_ms_1) / (+bvol_1);
				var pd_2 = (+dm_ms_2) / (+bvol_2);
				var pd_3 = (+dm_ms_3) / (+bvol_3);
				
				$('#pd_1').val(pd_1.toFixed(2));
				$('#pd_2').val(pd_2.toFixed(2));
				$('#pd_3').val(pd_3.toFixed(2));
				
				var wc_1 = ((+ss_m4_1) - (+ss_m3_1)) - ((+ss_m5_1) - (+ss_m3_1)) / ((+ss_m5_1) - (+ss_m3_1)) * 100;
				var wc_2 = ((+ss_m4_2) - (+ss_m3_2)) - ((+ss_m5_2) - (+ss_m3_2)) / ((+ss_m5_2) - (+ss_m3_2)) * 100;
				var wc_3 = ((+ss_m4_3) - (+ss_m3_3)) - ((+ss_m5_3) - (+ss_m3_3)) / ((+ss_m5_3) - (+ss_m3_3)) * 100;
				
				$('#wc_1').val(wc_1.toFixed(2));
				$('#wc_2').val(wc_2.toFixed(2));
				$('#wc_3').val(wc_3.toFixed(2));
				
		});

         		
				
				$('#sp_wt_st_1,#sp_wt_st_2,#sp_wt_st_3,#sp_wt_st_4,#sp_wt_st_5,#sp_wt_st_6,#sp_wt_st_7,#sp_wt_st_8,#sp_wt_st_9,#sp_w_s_1,#sp_w_s_2,#sp_w_s_3,#sp_w_s_4,#sp_w_s_5,#sp_w_s_6,#sp_w_s_7,#sp_w_s_8,#sp_w_s_9,#sp_w_sur_1,#sp_w_sur_2,#sp_w_sur_3,#sp_w_sur_4,#sp_w_sur_5,#sp_w_sur_6,#sp_w_sur_7,#sp_w_sur_8,#sp_w_sur_9,#sp_agg1,#sp_agg2,#sp_agg3,#sp_agg4,#sp_agg5,#sp_agg6,#sp_agg7,#sp_agg8,#sp_agg9').change(function() {
			
				$('#txtpor').css("background-color", "var(--success)");
				//Sample ID
				
				var sp_wt_st_1 = $('#sp_wt_st_1').val();
				var sp_wt_st_2 = $('#sp_wt_st_2').val();
				var sp_wt_st_3 = $('#sp_wt_st_3').val();
				var sp_wt_st_4 = $('#sp_wt_st_4').val();
				var sp_wt_st_5 = $('#sp_wt_st_5').val();
				var sp_wt_st_6 = $('#sp_wt_st_6').val();
				var sp_wt_st_7 = $('#sp_wt_st_7').val();
				var sp_wt_st_8 = $('#sp_wt_st_8').val();
				var sp_wt_st_9 = $('#sp_wt_st_9').val();
				
				var sp_temp = $('#sp_temp').val();
				
				var sp_w_s_1 = $('#sp_w_s_1').val();
				var sp_w_s_2 = $('#sp_w_s_2').val();
				var sp_w_s_3 = $('#sp_w_s_3').val();
				var sp_w_s_4 = $('#sp_w_s_4').val();
				var sp_w_s_5 = $('#sp_w_s_5').val();
				var sp_w_s_6 = $('#sp_w_s_6').val();
				var sp_w_s_7 = $('#sp_w_s_7').val();
				var sp_w_s_8 = $('#sp_w_s_8').val();
				var sp_w_s_9 = $('#sp_w_s_9').val();
				
				var sp_w_sur_1 = $('#sp_w_sur_1').val();
				var sp_w_sur_2 = $('#sp_w_sur_2').val();
				var sp_w_sur_3 = $('#sp_w_sur_3').val();
				var sp_w_sur_4 = $('#sp_w_sur_4').val();
				var sp_w_sur_5 = $('#sp_w_sur_5').val();
				var sp_w_sur_6 = $('#sp_w_sur_6').val();
				var sp_w_sur_7 = $('#sp_w_sur_7').val();
				var sp_w_sur_8 = $('#sp_w_sur_8').val();
				var sp_w_sur_9 = $('#sp_w_sur_9').val();
				
				var sp_agg1 = $('#sp_agg1').val();
				var sp_agg2 = $('#sp_agg2').val();
				var sp_agg3 = $('#sp_agg3').val();
				var sp_agg4 = $('#sp_agg4').val();
				var sp_agg5 = $('#sp_agg5').val();
				var sp_agg6 = $('#sp_agg6').val();
				var sp_agg7 = $('#sp_agg7').val();
				var sp_agg8 = $('#sp_agg8').val();
				var sp_agg9 = $('#sp_agg9').val();
				
				var sp_wat1 = (+sp_w_s_1) / (1000 - (+sp_agg1));
				var sp_wat2 = (+sp_w_s_2) / (1000 - (+sp_agg2));
				var sp_wat3 = (+sp_w_s_3) / (1000 - (+sp_agg3));
				var sp_wat4 = (+sp_w_s_4) / (1000 - (+sp_agg4));
				var sp_wat5 = (+sp_w_s_5) / (1000 - (+sp_agg5));
				var sp_wat6 = (+sp_w_s_6) / (1000 - (+sp_agg6));
				var sp_wat7 = (+sp_w_s_7) / (1000 - (+sp_agg7));
				var sp_wat8 = (+sp_w_s_8) / (1000 - (+sp_agg8));
				var sp_wat9 = (+sp_w_s_9) / (1000 - (+sp_agg9));
				
				$('#sp_wat1').val(sp_wat1.toFixed(2));
				$('#sp_wat2').val(sp_wat2.toFixed(2));
				$('#sp_wat3').val(sp_wat3.toFixed(2));
				$('#sp_wat4').val(sp_wat4.toFixed(2));
				$('#sp_wat5').val(sp_wat5.toFixed(2));
				$('#sp_wat6').val(sp_wat6.toFixed(2));
				$('#sp_wat7').val(sp_wat7.toFixed(2));
				$('#sp_wat8').val(sp_wat8.toFixed(2));
				$('#sp_wat9').val(sp_wat9.toFixed(2));
				
				var sp_specific_gravity_1 = ((+sp_w_sur_1) - (+sp_w_s_1)) / (+sp_w_s_1) * 100;
				var sp_specific_gravity_2 = ((+sp_w_sur_2) - (+sp_w_s_2)) / (+sp_w_s_2) * 100;
				var sp_specific_gravity_3 = ((+sp_w_sur_3) - (+sp_w_s_3)) / (+sp_w_s_3) * 100;
				var sp_specific_gravity_4 = ((+sp_w_sur_4) - (+sp_w_s_4)) / (+sp_w_s_4) * 100;
				var sp_specific_gravity_5 = ((+sp_w_sur_5) - (+sp_w_s_5)) / (+sp_w_s_5) * 100;
				var sp_specific_gravity_6 = ((+sp_w_sur_6) - (+sp_w_s_6)) / (+sp_w_s_6) * 100;
				var sp_specific_gravity_7 = ((+sp_w_sur_7) - (+sp_w_s_7)) / (+sp_w_s_7) * 100;
				var sp_specific_gravity_8 = ((+sp_w_sur_8) - (+sp_w_s_8)) / (+sp_w_s_8) * 100;
				var sp_specific_gravity_9 = ((+sp_w_sur_9) - (+sp_w_s_9)) / (+sp_w_s_9) * 100;
				
				$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
				$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
				$('#sp_specific_gravity_3').val(sp_specific_gravity_3.toFixed(2));
				$('#sp_specific_gravity_4').val(sp_specific_gravity_4.toFixed(2));
				$('#sp_specific_gravity_5').val(sp_specific_gravity_5.toFixed(2));
				$('#sp_specific_gravity_6').val(sp_specific_gravity_6.toFixed(2));
				$('#sp_specific_gravity_7').val(sp_specific_gravity_7.toFixed(2));
				$('#sp_specific_gravity_8').val(sp_specific_gravity_8.toFixed(2));
				$('#sp_specific_gravity_9').val(sp_specific_gravity_9.toFixed(2));
				
				var sp_water_abr_1 = (+sp_w_sur_1) - (+sp_w_s_1) / 1000 - (+sp_agg1) * 100;
				var sp_water_abr_2 = (+sp_w_sur_2) - (+sp_w_s_2) / 1000 - (+sp_agg2) * 100;
				var sp_water_abr_3 = (+sp_w_sur_3) - (+sp_w_s_3) / 1000 - (+sp_agg3) * 100;
				var sp_water_abr_4 = (+sp_w_sur_4) - (+sp_w_s_4) / 1000 - (+sp_agg4) * 100;
				var sp_water_abr_5 = (+sp_w_sur_5) - (+sp_w_s_5) / 1000 - (+sp_agg5) * 100;
				var sp_water_abr_6 = (+sp_w_sur_6) - (+sp_w_s_6) / 1000 - (+sp_agg6) * 100;
				var sp_water_abr_7 = (+sp_w_sur_7) - (+sp_w_s_7) / 1000 - (+sp_agg7) * 100;
				var sp_water_abr_8 = (+sp_w_sur_8) - (+sp_w_s_8) / 1000 - (+sp_agg8) * 100;
				var sp_water_abr_9 = (+sp_w_sur_9) - (+sp_w_s_9) / 1000 - (+sp_agg9) * 100;
				
				$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
				$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
				$('#sp_water_abr_3').val(sp_water_abr_3.toFixed(2));
				$('#sp_water_abr_4').val(sp_water_abr_4.toFixed(2));
				$('#sp_water_abr_5').val(sp_water_abr_5.toFixed(2));
				$('#sp_water_abr_6').val(sp_water_abr_6.toFixed(2));
				$('#sp_water_abr_7').val(sp_water_abr_7.toFixed(2));
				$('#sp_water_abr_8').val(sp_water_abr_8.toFixed(2));
				$('#sp_water_abr_9').val(sp_water_abr_9.toFixed(2));
				
				var sp_specific_gravity = ((+sp_wat1) + (+sp_wat2) + (+sp_wat3)) / 3;
				var sp_sg_avg_2 = ((+sp_wat4) + (+sp_wat5) + (+sp_wat6)) / 3;
				var sp_sg_avg_3 = ((+sp_wat7) + (+sp_wat8) + (+sp_wat9)) / 3;
				
				$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
				$('#sp_sg_avg_2').val(sp_sg_avg_2.toFixed(2));
				$('#sp_sg_avg_3').val(sp_sg_avg_3.toFixed(2));
				
				var sp_water_abr = ((+sp_specific_gravity_1) + (+sp_specific_gravity_2) + (+sp_specific_gravity_3)) / 3;
				var sp_wa_avg_2 = ((+sp_specific_gravity_4) + (+sp_specific_gravity_5) + (+sp_specific_gravity_6)) / 3;
				var sp_wa_avg_3 = ((+sp_specific_gravity_7) + (+sp_specific_gravity_8) + (+sp_specific_gravity_9)) / 3;
				
				$('#sp_water_abr').val(sp_water_abr.toFixed(2));
				$('#sp_wa_avg_2').val(sp_wa_avg_2.toFixed(2));
				$('#sp_wa_avg_3').val(sp_wa_avg_3.toFixed(2));
				
				var sp_porosity_1 = ((+sp_water_abr_1) + (+sp_water_abr_2) + (+sp_water_abr_3)) / 3;
				var sp_porosity_2 = ((+sp_water_abr_4) + (+sp_water_abr_5) + (+sp_water_abr_6)) / 3;
				var sp_porosity_3 = ((+sp_water_abr_7) + (+sp_water_abr_8) + (+sp_water_abr_9)) / 3;
				
				$('#sp_porosity_1').val(sp_porosity_1.toFixed(2));
				$('#sp_porosity_2').val(sp_porosity_2.toFixed(2));
				$('#sp_porosity_3').val(sp_porosity_3.toFixed(2));
		});

         		


		//SPECIFIC GRAVITY
		/* function spg_auto() {
			$('#txtspg').css("background-color", "var(--success)");
			$('#avg_spg').val(1);
		}

		$('#chk_spg').change(function() {
			if (this.checked) {
				spg_auto();
			} else {
				$('#txtspg').css("background-color", "white");
				$('#avg_spg').val(null);
			}

		}); */

		//TENSILE STRENGTH
		function tes_auto() {
			$('#txttes').css("background-color", "var(--success)");
			$('#avg_tes').val(1);
		}

		$('#chk_tes').change(function() {
			if (this.checked) {
				tes_auto();
			} else {
				$('#txttes').css("background-color", "white");
				$('#avg_tes').val(null);
			}

		});


		var global_temp = randomNumberFromRange(26.0, 28.5).toFixed(1);
		var pen_temp;
		var pen_1;
		var pen_2;
		var pen_3;
		var avg_pen;


		function randomNumberFromRange(min, max) {
			//return Math.floor(Math.random()*(max-min+1)+min);
			return Math.random() * (max - min) + min;
		}



		$('#chk_auto').change(function() {
			if (this.checked) {
				//$('#txtabr').css("background-color","var(--success)"); 
				//$('#txtwtr').css("background-color","var(--success)"); 


				var temp = $('#test_list').val();
				var aa = temp.split(",");

				//POROSITY & DENSITY
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "den") {
						$('#txtpor').css("background-color", "var(--success)");
						$("#chk_por").prop("checked", true);
						por_auto();
						break;
					}
				}

				//WATER CONTENT
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "wtr") {
						$('#txtwtr').css("background-color", "var(--success)");
						$("#chk_wtr").prop("checked", true);
						wtr_auto()
						break;
					}
				}

				//COMPRESSIVE STRENGTH
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "com") {
						$('#txtcom').css("background-color", "var(--success)");
						$("#chk_com").prop("checked", true);
						com_auto();
						break;
					}
				}

				//POINT LOAD STRENGTH
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "rpl") {
						$('#txtpoi').css("background-color", "var(--success)");
						$("#chk_poi").prop("checked", true);
						poi_auto();
						break;
					}
				}

				//SPECIFIC GRAVITY
				/* for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "spg") {
						$('#txtspg').css("background-color", "var(--success)");
						$("#chk_spg").prop("checked", true);
						spg_auto();
						break;
					}
				}
 */
				//TENSILE STRENGTH
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "tes") {
						$('#txttes').css("background-color", "var(--success)");
						$("#chk_tes").prop("checked", true);
						tes_auto();
						break;
					}
				}
				
				//wtr&sp
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "spg") {
						$('#txtspg').css("background-color", "var(--success)");
						$("#chk_sp").prop("checked", true);
						sp_auto();
						break;
					}
				}



			}

		});



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

	$("#btn_edit_data").click(function() {
		$('#btn_edit_data').hide();

	});

	function getGlazedTiles() {
		var lab_no = $('#lab_no').val();
		var report_no = $('#report_no').val();
		var job_no = $('#job_no').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_rock_test.php',
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
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();
			var bh_no = $('#bh_no').val();
			var rock_depth = $('#rock_depth').val();
			var remark = $('#remark').val();
			var Sheet_no = $('#Sheet_no').val();
			var wt_m = $('#wt_m').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//POROSITY & DENSITY
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "den") {
					if (document.getElementById('chk_por').checked) {
						var chk_por = "1";
					} else {
						var chk_por = "0";
					}
					var wtr_temp_1 = $('#wtr_temp_1').val();
				    var wtr_temp_2 = $('#wtr_temp_2').val();
				    var wtr_temp_3 = $('#wtr_temp_3').val();
				    var rt_m_1 = $('#rt_m_1').val();
				    var rt_m_2 = $('#rt_m_2').val();
				    var rt_m_3 = $('#rt_m_3').val();
				    var ss_m1_1 = $('#ss_m1_1').val();
				    var ss_m1_2 = $('#ss_m1_2').val();
				    var ss_m1_3 = $('#ss_m1_3').val();
				    var ss_m2_1 = $('#ss_m2_1').val();
				    var ss_m2_2 = $('#ss_m2_2').val();
				    var ss_m2_3 = $('#ss_m2_3').val();
				    var ss_m3_1 = $('#ss_m3_1').val();
				    var ss_m3_2 = $('#ss_m3_2').val();
				    var ss_m3_3 = $('#ss_m3_3').val();
				    var ss_m4_1 = $('#ss_m4_1').val();
				    var ss_m4_2 = $('#ss_m4_2').val();
				    var ss_m4_3 = $('#ss_m4_3').val();
				    var ss_m5_1 = $('#ss_m5_1').val();
				    var ss_m5_2 = $('#ss_m5_2').val();
				    var ss_m5_3 = $('#ss_m5_3').val();
				    var ssm_sub_1 = $('#ssm_sub_1').val();
				    var ssm_sub_2 = $('#ssm_sub_2').val();
				    var ssm_sub_3 = $('#ssm_sub_3').val();
				    var ssm_sat_1 = $('#ssm_sat_1').val();
				    var ssm_sat_2 = $('#ssm_sat_2').val();
				    var ssm_sat_3 = $('#ssm_sat_3').val();
				    var dm_ms_1 = $('#dm_ms_1').val();
				    var dm_ms_2 = $('#dm_ms_2').val();
				    var dm_ms_3 = $('#dm_ms_3').val();
				    var bvol_1 = $('#bvol_1').val();
				    var bvol_2 = $('#bvol_2').val();
				    var bvol_3 = $('#bvol_3').val();
				    var pv_1 = $('#pv_1').val();
				    var pv_2 = $('#pv_2').val();
				    var pv_3 = $('#pv_3').val();
				    var por_1 = $('#por_1').val();
				    var por_2 = $('#por_2').val();
				    var por_3 = $('#por_3').val();
				    var pd_1 = $('#pd_1').val();
				    var pd_2 = $('#pd_2').val();
				    var pd_3 = $('#pd_3').val();
				    var wc_1 = $('#wc_1').val();
				    var wc_2 = $('#wc_2').val();
				    var wc_3 = $('#wc_3').val();
					
					
					break;
				} else {
					var chk_poi = "0";
					var wtr_temp_1 = "0";
				    var wtr_temp_2 = "0";
				    var wtr_temp_3 = "0";
				    var rt_m_1 = "0";
				    var rt_m_2 = "0";
				    var rt_m_3 = "0";
				    var ss_m1_1 = "0";
				    var ss_m1_2 = "0";
				    var ss_m1_3 = "0";
				    var ss_m2_1 = "0";
				    var ss_m2_2 = "0";
				    var ss_m2_3 = "0";
				    var ss_m3_1 = "0";
				    var ss_m3_2 = "0";
				    var ss_m3_3 = "0";
				    var ss_m4_1 = "0";
				    var ss_m4_2 = "0";
				    var ss_m4_3 = "0";
				    var ss_m5_1 = "0";
				    var ss_m5_2 = "0";
				    var ss_m5_3 = "0";
				    var ssm_sub_1 = "0";
				    var ssm_sub_2 = "0";
				    var ssm_sub_3 = "0";
				    var ssm_sat_1 = "0";
				    var ssm_sat_2 = "0";
				    var ssm_sat_3 = "0";
				    var dm_ms_1 = "0";
				    var dm_ms_2 = "0";
				    var dm_ms_3 = "0";
				    var bvol_1 = "0";
				    var bvol_2 = "0";
				    var bvol_3 = "0";
				    var pv_1 = "0";
				    var pv_2 = "0";
				    var pv_3 = "0";
				    var por_1 = "0";
				    var por_2 = "0";
				    var por_3 = "0";
				    var pd_1 = "0";
				    var pd_2 = "0";
				    var pd_3 = "0";
				    var wc_1 = "0";
				    var wc_2 = "0";
				    var wc_3 = "0";

				}

			}


			// COMPRESSIVE STRENGTH
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "com") {

					if (document.getElementById('chk_com').checked) {
						var chk_com = "1";
					} else {
						var chk_com = "0";
					}
					var desc1 = $('#desc1').val();
					var desc2 = $('#desc2').val();
					var desc3 = $('#desc3').val();
					var con1 = $('#con1').val();
					var con2 = $('#con2').val();
					var con3 = $('#con3').val();
					var depth1 = $('#depth1').val();
					var depth2 = $('#depth2').val();
					var depth3 = $('#depth3').val();
					var length1 = $('#length1').val();
					var length2 = $('#length2').val();
					var length3 = $('#length3').val();
					var dia1 = $('#dia1').val();
					var dia2 = $('#dia2').val();
					var dia3 = $('#dia3').val();
					var ratio1 = $('#ratio1').val();
					var ratio2 = $('#ratio2').val();
					var ratio3 = $('#ratio3').val();
					var corr1 = $('#corr1').val();
					var corr2 = $('#corr2').val();
					var corr3 = $('#corr3').val();
					var area1 = $('#area1').val();
					var area2 = $('#area2').val();
					var area3 = $('#area3').val();
					var fla1 = $('#fla1').val();
					var fla2 = $('#fla2').val();
					var fla3 = $('#fla3').val();
					var par1 = $('#par1').val();
					var par2 = $('#par2').val();
					var par3 = $('#par3').val();
					var ppl1 = $('#ppl1').val();
					var ppl2 = $('#ppl2').val();
					var ppl3 = $('#ppl3').val();
					var str1 = $('#str1').val();
					var str2 = $('#str2').val();
					var str3 = $('#str3').val();
					var rate1 = $('#rate1').val();
					var rate2 = $('#rate2').val();
					var rate3 = $('#rate3').val();
					var mod1 = $('#mod1').val();
					var mod2 = $('#mod2').val();
					var mod3 = $('#mod3').val();
					var load1 = $('#load1').val();
					var load2 = $('#load2').val();
					var load3 = $('#load3').val();
					var ucs1 = $('#ucs1').val();
					var ucs2 = $('#ucs2').val();
					var ucs3 = $('#ucs3').val();
					var cor1 = $('#cor1').val();
					var cor2 = $('#cor2').val();
					var cor3 = $('#cor3').val();
					var avg_ucs = $('#avg_ucs').val();
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
					var com_13 = $('#com_13').val();
					var com_14 = $('#com_14').val();
					var com_15 = $('#com_15').val();
					var com_16 = $('#com_16').val();
					var com_17 = $('#com_17').val();
					var com_18 = $('#com_18').val();
					var com_19 = $('#com_19').val();
					var com_20 = $('#com_20').val();
					var com_21 = $('#com_21').val();
					var com_22 = $('#com_22').val();
					var com_23 = $('#com_23').val();
					var com_24 = $('#com_24').val();
					var com_25 = $('#com_25').val();
					var com_26 = $('#com_26').val();
					var com_27 = $('#com_27').val();
					var com_28 = $('#com_28').val();
					var com_29 = $('#com_29').val();
					var com_30 = $('#com_30').val();
					var com_31 = $('#com_31').val();
					var com_32 = $('#com_32').val();
					var com_33 = $('#com_33').val();
					var com_34 = $('#com_34').val();
					var com_35 = $('#com_35').val();
					var com_36 = $('#com_36').val();
					var com_37 = $('#com_37').val();
					var com_38 = $('#com_38').val();
					var com_39 = $('#com_39').val();
					var com_40 = $('#com_40').val();
					var com_41 = $('#com_41').val();
					var com_42 = $('#com_42').val();
					var com_43 = $('#com_43').val();
					var com_44 = $('#com_44').val();
					var com_45 = $('#com_45').val();
					var com_46 = $('#com_46').val();
					var com_47 = $('#com_47').val();
					var com_48 = $('#com_48').val();
					var com_49 = $('#com_49').val();
					var com_50 = $('#com_50').val();
					var com_51 = $('#com_51').val();
					var com_52 = $('#com_52').val();
					var com_53 = $('#com_53').val();
					var com_54 = $('#com_54').val();
					var com_55 = $('#com_55').val();
					var com_56 = $('#com_56').val();
					var com_57 = $('#com_57').val();
					var com_58 = $('#com_58').val();
					var com_59 = $('#com_59').val();
					var com_60 = $('#com_60').val();
					var com_61 = $('#com_61').val();
					var com_62 = $('#com_62').val();
					var com_63 = $('#com_63').val();
					var com_64 = $('#com_64').val();
					var com_65 = $('#com_65').val();
					var com_66 = $('#com_66').val();
					var com_67 = $('#com_67').val();
					var com_68 = $('#com_68').val();
					var com_69 = $('#com_69').val();
					var com_70 = $('#com_70').val();
					var com_71 = $('#com_71').val();
					var com_72 = $('#com_72').val();
					var com_73 = $('#com_73').val();
					var com_74 = $('#com_74').val();
					var com_75 = $('#com_75').val();
					var com_76 = $('#com_76').val();
					var com_77 = $('#com_77').val();
					var com_78 = $('#com_78').val();
					var com_79 = $('#com_79').val();
					var com_80 = $('#com_80').val();
					var com_81 = $('#com_81').val();
					var com_82 = $('#com_82').val();
					var com_83 = $('#com_83').val();
					var com_84 = $('#com_84').val();
					var com_85 = $('#com_85').val();
					var com_86 = $('#com_86').val();
					var com_87 = $('#com_87').val();
					var com_88 = $('#com_88').val();
					var com_89 = $('#com_89').val();
					var com_90 = $('#com_90').val();
					var com_91 = $('#com_91').val();
					var com_92 = $('#com_92').val();
					var com_93 = $('#com_93').val();
					var com_94 = $('#com_94').val();
					var com_95 = $('#com_95').val();
					var com_96 = $('#com_96').val();
					var com_97 = $('#com_97').val();
					var com_98 = $('#com_98').val();
					var com_99 = $('#com_99').val();
					var com_100 = $('#com_100').val();
					var com_101 = $('#com_101').val();
					var com_102 = $('#com_102').val();
					var com_103 = $('#com_103').val();
					var com_104 = $('#com_104').val();
					var com_105 = $('#com_105').val();
					var com_106 = $('#com_106').val();
					var com_107 = $('#com_107').val();
					var com_108 = $('#com_108').val();
					var com_109 = $('#com_109').val();


					break;
				} else {
					var chk_com = "0";
					var desc1 = "0";
					var desc2 = "0";
					var desc3 = "0";
					var con1 = "0";
					var con2 = "0";
					var con3 = "0";
					var depth1 = "0";
					var depth2 = "0";
					var depth3 = "0";
					var length1 = "0";
					var length2 = "0";
					var length3 = "0";
					var dia1 = "0";
					var dia2 = "0";
					var dia3 = "0";
					var ratio1 = "0";
					var ratio2 = "0";
					var ratio3 = "0";
					var corr1 = "0";
					var corr2 = "0";
					var corr3 = "0";
					var area1 = "0";
					var area2 = "0";
					var area3 = "0";
					var fla1 = "0";
					var fla2 = "0";
					var fla3 = "0";
					var par1 = "0";
					var par2 = "0";
					var par3 = "0";
					var ppl1 = "0";
					var ppl2 = "0";
					var ppl3 = "0";
					var str1 = "0";
					var str2 = "0";
					var str3 = "0";
					var rate1 = "0";
					var rate2 = "0";
					var rate3 = "0";
					var mod1 = "0";
					var mod2 = "0";
					var mod3 = "0";
					var load1 = "0";
					var load2 = "0";
					var load3 = "0";
					var ucs1 = "0";
					var ucs2 = "0";
					var ucs3 = "0";
					var cor1 = "0";
					var cor2 = "0";
					var cor3 = "0";
					var avg_ucs = "0";
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
					var com_13 = "0";
					var com_14 = "0";
					var com_15 = "0";
					var com_16 = "0";
					var com_17 = "0";
					var com_18 = "0";
					var com_19 = "0";
					var com_20 = "0";
					var com_21 = "0";
					var com_22 = "0";
					var com_23 = "0";
					var com_24 = "0";
					var com_25 = "0";
					var com_26 = "0";
					var com_27 = "0";
					var com_28 = "0";
					var com_29 = "0";
					var com_30 = "0";
					var com_31 = "0";
					var com_32 = "0";
					var com_33 = "0";
					var com_34 = "0";
					var com_35 = "0";
					var com_36 = "0";
					var com_37 = "0";
					var com_38 = "0";
					var com_39 = "0";
					var com_40 = "0";
					var com_41 = "0";
					var com_42 = "0";
					var com_43 = "0";
					var com_44 = "0";
					var com_45 = "0";
					var com_46 = "0";
					var com_47 = "0";
					var com_48 = "0";
					var com_49 = "0";
					var com_50 = "0";
					var com_51 = "0";
					var com_52 = "0";
					var com_53 = "0";
					var com_54 = "0";
					var com_55 = "0";
					var com_56 = "0";
					var com_57 = "0";
					var com_58 = "0";
					var com_59 = "0";
					var com_60 = "0";
					var com_61 = "0";
					var com_62 = "0";
					var com_63 = "0";
					var com_64 = "0";
					var com_65 = "0";
					var com_66 = "0";
					var com_67 = "0";
					var com_68 = "0";
					var com_69 = "0";
					var com_70 = "0";
					var com_71 = "0";
					var com_72 = "0";
					var com_73 = "0";
					var com_74 = "0";
					var com_75 = "0";
					var com_76 = "0";
					var com_77 = "0";
					var com_78 = "0";
					var com_79 = "0";
					var com_80 = "0";
					var com_81 = "0";
					var com_82 = "0";
					var com_83 = "0";
					var com_84 = "0";
					var com_85 = "0";
					var com_86 = "0";
					var com_87 = "0";
					var com_88 = "0";
					var com_89 = "0";
					var com_90 = "0";
					var com_91 = "0";
					var com_92 = "0";
					var com_93 = "0";
					var com_94 = "0";
					var com_95 = "0";
					var com_96 = "0";
					var com_97 = "0";
					var com_98 = "0";
					var com_99 = "0";
					var com_100 = "0";
					var com_101 = "0";
					var com_102 = "0";
					var com_103 = "0";
					var com_104 = "0";
					var com_105 = "0";
					var com_106 = "0";
					var com_107 = "0";
					var com_108 = "0";
					var com_109 = "0";


				}

			}

			
			//SP AND WATER ABR
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "spg") {
					if (document.getElementById('chk_sp').checked) {
						var chk_sp = "1";
					} else {
						var chk_sp = "0";
					}
				//specific gravity and water abrasion-5							
				var sp_wt_st_1 = $('#sp_wt_st_1').val();
				var sp_wt_st_2 = $('#sp_wt_st_2').val();
				var sp_wt_st_3 = $('#sp_wt_st_3').val();
				var sp_wt_st_4 = $('#sp_wt_st_4').val();
				var sp_wt_st_5 = $('#sp_wt_st_5').val();
				var sp_wt_st_6 = $('#sp_wt_st_6').val();
				var sp_wt_st_7 = $('#sp_wt_st_7').val();
				var sp_wt_st_8 = $('#sp_wt_st_8').val();
				var sp_wt_st_9 = $('#sp_wt_st_9').val();
				var sp_temp = $('#sp_temp').val();
				var sp_w_s_1 = $('#sp_w_s_1').val();
				var sp_w_s_2 = $('#sp_w_s_2').val();
				var sp_w_s_3 = $('#sp_w_s_3').val();
				var sp_w_s_4 = $('#sp_w_s_4').val();
				var sp_w_s_5 = $('#sp_w_s_5').val();
				var sp_w_s_6 = $('#sp_w_s_6').val();
				var sp_w_s_7 = $('#sp_w_s_7').val();
				var sp_w_s_8 = $('#sp_w_s_8').val();
				var sp_w_s_9 = $('#sp_w_s_9').val();
				var sp_w_sur_1 = $('#sp_w_sur_1').val();
				var sp_w_sur_2 = $('#sp_w_sur_2').val();
				var sp_w_sur_3 = $('#sp_w_sur_3').val();
				var sp_w_sur_4 = $('#sp_w_sur_4').val();
				var sp_w_sur_5 = $('#sp_w_sur_5').val();
				var sp_w_sur_6 = $('#sp_w_sur_6').val();
				var sp_w_sur_7 = $('#sp_w_sur_7').val();
				var sp_w_sur_8 = $('#sp_w_sur_8').val();
				var sp_w_sur_9 = $('#sp_w_sur_9').val();
				var sp_agg1 = $('#sp_agg1').val();
				var sp_agg2 = $('#sp_agg2').val();
				var sp_agg3 = $('#sp_agg3').val();
				var sp_agg4 = $('#sp_agg4').val();
				var sp_agg5 = $('#sp_agg5').val();
				var sp_agg6 = $('#sp_agg6').val();
				var sp_agg7 = $('#sp_agg7').val();
				var sp_agg8 = $('#sp_agg8').val();
				var sp_agg9 = $('#sp_agg9').val();
				var sp_wat1 = $('#sp_wat1').val();
				var sp_wat2 = $('#sp_wat2').val();
				var sp_wat3 = $('#sp_wat3').val();
				var sp_wat4 = $('#sp_wat4').val();
				var sp_wat5 = $('#sp_wat5').val();
				var sp_wat6 = $('#sp_wat6').val();
				var sp_wat7 = $('#sp_wat7').val();
				var sp_wat8 = $('#sp_wat8').val();
				var sp_wat9 = $('#sp_wat9').val();
				var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
				var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
				var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();
				var sp_specific_gravity_4 = $('#sp_specific_gravity_4').val();
				var sp_specific_gravity_5 = $('#sp_specific_gravity_5').val();
				var sp_specific_gravity_6 = $('#sp_specific_gravity_6').val();
				var sp_specific_gravity_7 = $('#sp_specific_gravity_7').val();
				var sp_specific_gravity_8 = $('#sp_specific_gravity_8').val();
				var sp_specific_gravity_9 = $('#sp_specific_gravity_9').val();
				var sp_water_abr_1 = $('#sp_water_abr_1').val();
				var sp_water_abr_2 = $('#sp_water_abr_2').val();
				var sp_water_abr_3 = $('#sp_water_abr_3').val();
				var sp_water_abr_4 = $('#sp_water_abr_4').val();
				var sp_water_abr_5 = $('#sp_water_abr_5').val();
				var sp_water_abr_6 = $('#sp_water_abr_6').val();
				var sp_water_abr_7 = $('#sp_water_abr_7').val();
				var sp_water_abr_8 = $('#sp_water_abr_8').val();
				var sp_water_abr_9 = $('#sp_water_abr_9').val();
				var sp_specific_gravity = $('#sp_specific_gravity').val();
				var sp_sg_avg_2 = $('#sp_sg_avg_2').val();
				var sp_sg_avg_3 = $('#sp_sg_avg_3').val();
				var sp_water_abr = $('#sp_water_abr').val();
				var sp_wa_avg_2 = $('#sp_wa_avg_2').val();
				var sp_wa_avg_3 = $('#sp_wa_avg_3').val();
				var sp_porosity_1 = $('#sp_porosity_1').val();
				var sp_porosity_2 = $('#sp_porosity_2').val();
				var sp_porosity_3 = $('#sp_porosity_3').val();
				
					break;
				} else {
				var chk_sp = "";
				var sp_wt_st_1 = "";
				var sp_wt_st_2 = "";
				var sp_wt_st_3 = "";
				var sp_wt_st_4 = "";
				var sp_wt_st_5 = "";
				var sp_wt_st_6 = "";
				var sp_wt_st_7 = "";
				var sp_wt_st_8 = "";
				var sp_wt_st_9 = "";
				var sp_temp = "";
				var sp_w_s_1 = "";
				var sp_w_s_2 = "";
				var sp_w_s_3 = "";
				var sp_w_s_4 = "";
				var sp_w_s_5 = "";
				var sp_w_s_6 = "";
				var sp_w_s_7 = "";
				var sp_w_s_8 = "";
				var sp_w_s_9 = "";
				var sp_w_sur_1 = "";
				var sp_w_sur_2 = "";
				var sp_w_sur_3 = "";
				var sp_w_sur_4 = "";
				var sp_w_sur_5 = "";
				var sp_w_sur_6 = "";
				var sp_w_sur_7 = "";
				var sp_w_sur_8 = "";
				var sp_w_sur_9 = "";
				var sp_agg1 = "";
				var sp_agg2 = "";
				var sp_agg3 = "";
				var sp_agg4 = "";
				var sp_agg5 = "";
				var sp_agg6 = "";
				var sp_agg7 = "";
				var sp_agg8 = "";
				var sp_agg9 = "";
				var sp_wat1 = "";
				var sp_wat2 = "";
				var sp_wat3 = "";
				var sp_wat4 = "";
				var sp_wat5 = "";
				var sp_wat6 = "";
				var sp_wat7 = "";
				var sp_wat8 = "";
				var sp_wat9 = "";
				var sp_specific_gravity_1 = "";
				var sp_specific_gravity_2 = "";
				var sp_specific_gravity_3 = "";
				var sp_specific_gravity_4 = "";
				var sp_specific_gravity_5 = "";
				var sp_specific_gravity_6 = "";
				var sp_specific_gravity_7 = "";
				var sp_specific_gravity_8 = "";
				var sp_specific_gravity_9 = "";
				var sp_water_abr_1 = "";
				var sp_water_abr_2 = "";
				var sp_water_abr_3 = "";
				var sp_water_abr_4 = "";
				var sp_water_abr_5 = "";
				var sp_water_abr_6 = "";
				var sp_water_abr_7 = "";
				var sp_water_abr_8 = "";
				var sp_water_abr_9 = "";
				var sp_specific_gravity = "";
				var sp_sg_avg_2 = "";
				var sp_sg_avg_3 = "";
				var sp_water_abr = "";
				var sp_wa_avg_2 = "";
				var sp_wa_avg_3 = "";
				var sp_porosity_1 = "";
				var sp_porosity_2 = "";
				var sp_porosity_3 = "";
				

				}

			}
		
			

			//SPECIFIC GRAVITY
			/* for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "spg") {
					if (document.getElementById('chk_spg').checked) {
						var chk_spg = "1";
					} else {
						var chk_spg = "0";
					}
					var avg_spg = $('#avg_spg').val();
					break;
				} else {
					var chk_spg = "0";
					var avg_spg = "0";

				}

			} */

			//TENSILE STRENGTH
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "tes") {
					if (document.getElementById('chk_tes').checked) {
						var chk_tes = "1";
					} else {
						var chk_tes = "0";
					}
					var avg_tes = $('#avg_tes').val();
					break;
				} else {
					var chk_tes = "0";
					var avg_tes = "0";

				}

			}
			
			
			



			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&bh_no=' + bh_no + '&rock_depth=' + rock_depth + '&chk_por=' + chk_por + '&chk_com=' + chk_com + '&desc1=' + desc1 + '&desc2=' + desc2 + '&desc3=' + desc3 + '&con1=' + con1 + '&con2=' + con2 + '&con3=' + con3 + '&depth1=' + depth1 + '&depth2=' + depth2 + '&depth3=' + depth3 + '&length1=' + length1 + '&length2=' + length2 + '&length3=' + length3 + '&dia1=' + dia1 + '&dia2=' + dia2 + '&dia3=' + dia3 + '&ratio1=' + ratio1 + '&ratio2=' + ratio2 + '&ratio3=' + ratio3 + '&corr1=' + corr1 + '&corr2=' + corr2 + '&corr3=' + corr3 + '&area1=' + area1 + '&area2=' + area2 + '&area3=' + area3 + '&fla1=' + fla1 + '&fla2=' + fla2 + '&fla3=' + fla3 + '&par1=' + par1 + '&par2=' + par2 + '&par3=' + par3 + '&ppl1=' + ppl1 + '&ppl2=' + ppl2 + '&ppl3=' + ppl3 + '&str1=' + str1 + '&str2=' + str2 + '&str3=' + str3 + '&rate1=' + rate1 + '&rate2=' + rate2 + '&rate3=' + rate3 + '&mod1=' + mod1 + '&mod2=' + mod2 + '&mod3=' + mod3 + '&load1=' + load1 + '&load2=' + load2 + '&load3=' + load3 + '&ucs1=' + ucs1 + '&ucs2=' + ucs2 + '&ucs3=' + ucs3 + '&cor1=' + cor1 + '&cor2=' + cor2 + '&cor3=' + cor3 + '&avg_ucs=' + avg_ucs + '&chk_poi=' + chk_poi + '&chk_sp=' + chk_sp + '&sp_w_sur_1=' + sp_w_sur_1 + '&sp_w_sur_2=' + sp_w_sur_2 + '&sp_w_sur_3=' + sp_w_sur_3 + '&sp_w_s_1=' + sp_w_s_1 + '&sp_w_s_2=' + sp_w_s_2 + '&sp_w_s_3=' + sp_w_s_3 + '&sp_wt_st_1=' + sp_wt_st_1 + '&sp_wt_st_2=' + sp_wt_st_2 + '&sp_wt_st_3=' + sp_wt_st_3 + '&sp_agg1=' + sp_agg1 + '&sp_agg2=' + sp_agg2 + '&sp_agg3=' + sp_agg3 + '&sp_wat1=' + sp_wat1 + '&sp_wat2=' + sp_wat2 + '&sp_wat3=' + sp_wat3 + '&sp_specific_gravity=' + sp_specific_gravity + '&sp_specific_gravity_1=' + sp_specific_gravity_1 + '&sp_specific_gravity_2=' + sp_specific_gravity_2 + '&sp_specific_gravity_3=' + sp_specific_gravity_3 + '&sp_water_abr=' + sp_water_abr + '&sp_water_abr_1=' + sp_water_abr_1 + '&sp_water_abr_2=' + sp_water_abr_2 + '&sp_water_abr_3=' + sp_water_abr_3 + '&ulr=' + ulr +  '&com_1=' + com_1 +  '&com_2=' + com_2 +  '&com_3=' + com_3 +  '&com_4=' + com_4 +  '&com_5=' + com_5 +  '&com_6=' + com_6 +  '&com_7=' + com_7 +  '&com_8=' + com_8 +  '&com_9=' + com_9 +  '&com_10=' + com_10 +  '&com_11=' + com_11 +  '&com_12=' + com_12 +  '&com_13=' + com_13 +  '&com_14=' + com_14 +  '&com_15=' + com_15 +  '&com_16=' + com_16 +  '&com_17=' + com_17 +  '&com_18=' + com_18 +  '&com_19=' + com_19 +  '&com_20=' + com_20 +  '&com_21=' + com_21 +  '&com_22=' + com_22 +  '&com_23=' + com_23 +  '&com_24=' + com_24 +  '&com_25=' + com_25 +  '&com_26=' + com_26 +  '&com_27=' + com_27 +  '&com_28=' + com_28 +  '&com_29=' + com_29 +  '&com_30=' + com_30 +  '&com_31=' + com_31 +  '&com_32=' + com_32 +  '&com_33=' + com_33 +  '&com_34=' + com_34 +  '&com_35=' + com_35 +  '&com_36=' + com_36 +  '&com_37=' + com_37 +  '&com_38=' + com_38 +  '&com_39=' + com_39 +  '&com_40=' + com_40 +  '&com_41=' + com_41 +  '&com_42=' + com_42 +  '&com_43=' + com_43 +  '&com_44=' + com_44 +  '&com_45=' + com_45 +  '&com_46=' + com_46 +  '&com_47=' + com_47 +  '&com_48=' + com_48 +  '&com_49=' + com_49 +  '&com_50=' + com_50 +  '&com_51=' + com_51 +  '&com_52=' + com_52 +  '&com_53=' + com_53 +  '&com_54=' + com_54 +  '&com_55=' + com_55 +  '&com_56=' + com_56 +  '&com_57=' + com_57 +  '&com_58=' + com_58 +  '&com_59=' + com_59 +  '&com_60=' + com_60 +  '&com_61=' + com_61 +  '&com_62=' + com_62 +  '&com_63=' + com_63 +  '&com_64=' + com_64 +  '&com_65=' + com_65 +  '&com_66=' + com_66 +  '&com_67=' + com_67 +  '&com_68=' + com_68 +  '&com_69=' + com_69 +  '&com_70=' + com_70 +  '&com_71=' + com_71 +  '&com_72=' + com_72 +  '&com_73=' + com_73 +  '&com_74=' + com_74 +  '&com_75=' + com_75 +  '&com_76=' + com_76 +  '&com_77=' + com_77 +  '&com_78=' + com_78 +  '&com_79=' + com_79 +  '&com_80=' + com_80 +  '&com_81=' + com_81 +  '&com_82=' + com_82 +  '&com_83=' + com_83 +  '&com_84=' + com_84 +  '&com_85=' + com_85 +  '&com_86=' + com_86 +  '&com_87=' + com_87 +  '&com_88=' + com_88 +  '&com_89=' + com_89 +  '&com_90=' + com_90 +  '&com_91=' + com_91 +  '&com_92=' + com_92 +  '&com_93=' + com_93 +  '&com_94=' + com_94 +  '&com_95=' + com_95 +  '&com_96=' + com_96 +  '&com_97=' + com_97 +  '&com_98=' + com_98 +  '&com_99=' + com_99 +  '&com_100=' + com_100 +  '&com_101=' + com_101 +  '&com_102=' + com_102 +  '&com_103=' + com_103 +  '&com_104=' + com_104 +  '&com_105=' + com_105 +  '&com_106=' + com_106 +  '&com_107=' + com_107 +  '&com_108=' + com_108 + '&com_109=' +com_109 +  '&sp_wt_st_4=' + sp_wt_st_4 +  '&sp_wt_st_5=' + sp_wt_st_5 +  '&sp_wt_st_6=' + sp_wt_st_6 +  '&sp_wt_st_7=' + sp_wt_st_7 +  '&sp_wt_st_8=' + sp_wt_st_8 +  '&sp_wt_st_9=' + sp_wt_st_9 +  '&sp_w_s_4=' + sp_w_s_4 +  '&sp_w_s_5=' + sp_w_s_5 +  '&sp_w_s_6=' + sp_w_s_6 +  '&sp_w_s_7=' + sp_w_s_7 +  '&sp_w_s_8=' + sp_w_s_8 +  '&sp_w_s_9=' + sp_w_s_9 +  '&sp_w_sur_4=' + sp_w_sur_4 +  '&sp_w_sur_5=' + sp_w_sur_5 +  '&sp_w_sur_6=' + sp_w_sur_6 +  '&sp_w_sur_7=' + sp_w_sur_7 +  '&sp_w_sur_8=' + sp_w_sur_8 +  '&sp_w_sur_9=' + sp_w_sur_9 +  '&sp_agg4=' + sp_agg4 +  '&sp_agg5=' + sp_agg5 +  '&sp_agg6=' + sp_agg6 +  '&sp_agg7=' + sp_agg7 +  '&sp_agg8=' + sp_agg8 +  '&sp_agg9=' + sp_agg9 +  '&sp_wat4=' + sp_wat4 +  '&sp_wat5=' + sp_wat5 +  '&sp_wat6=' + sp_wat6 +  '&sp_wat7=' + sp_wat7 +  '&sp_wat8=' + sp_wat8 +  '&sp_wat9=' + sp_wat9 +  '&sp_specific_gravity_4=' + sp_specific_gravity_4 +  '&sp_specific_gravity_5=' + sp_specific_gravity_5 +  '&sp_specific_gravity_6=' + sp_specific_gravity_6 +  '&sp_specific_gravity_7=' + sp_specific_gravity_7 +  '&sp_specific_gravity_8=' + sp_specific_gravity_8 +  '&sp_specific_gravity_9=' + sp_specific_gravity_9 +  '&sp_water_abr_4=' + sp_water_abr_4 +  '&sp_water_abr_5=' + sp_water_abr_5 +  '&sp_water_abr_6=' + sp_water_abr_6 +  '&sp_water_abr_7=' + sp_water_abr_7 +  '&sp_water_abr_8=' + sp_water_abr_8 +  '&sp_water_abr_9=' + sp_water_abr_9 +  '&sp_sg_avg_2=' + sp_sg_avg_2 +  '&sp_sg_avg_3=' + sp_sg_avg_3 +  '&sp_wa_avg_2=' + sp_wa_avg_2 +  '&sp_wa_avg_3=' + sp_wa_avg_3 +  '&sp_porosity_1=' + sp_porosity_1 +  '&sp_porosity_2=' + sp_porosity_2 +  '&sp_porosity_3=' + sp_porosity_3 + '&sp_temp=' +sp_temp + '&remark=' + remark + '&Sheet_no=' +Sheet_no + '&wt_m=' +wt_m +  '&wtr_temp_1=' + wtr_temp_1 +  '&wtr_temp_2=' + wtr_temp_2 +  '&wtr_temp_3=' + wtr_temp_3 +  '&rt_m_1=' + rt_m_1 +  '&rt_m_2=' + rt_m_2 +  '&rt_m_3=' + rt_m_3 +  '&ss_m1_1=' + ss_m1_1 +  '&ss_m1_2=' + ss_m1_2 +  '&ss_m1_3=' + ss_m1_3 +  '&ss_m2_1=' + ss_m2_1 +  '&ss_m2_2=' + ss_m2_2 +  '&ss_m2_3=' + ss_m2_3 +  '&ss_m3_1=' + ss_m3_1 +  '&ss_m3_2=' + ss_m3_2 +  '&ss_m3_3=' + ss_m3_3 +  '&ss_m4_1=' + ss_m4_1 +  '&ss_m4_2=' + ss_m4_2 +  '&ss_m4_3=' + ss_m4_3 +  '&ss_m5_1=' + ss_m5_1 +  '&ss_m5_2=' + ss_m5_2 +  '&ss_m5_3=' + ss_m5_3 +  '&ssm_sub_1=' + ssm_sub_1 +  '&ssm_sub_2=' + ssm_sub_2 +  '&ssm_sub_3=' + ssm_sub_3 +  '&ssm_sat_1=' + ssm_sat_1 +  '&ssm_sat_2=' + ssm_sat_2 +  '&ssm_sat_3=' + ssm_sat_3 +  '&dm_ms_1=' + dm_ms_1 +  '&dm_ms_2=' + dm_ms_2 +  '&dm_ms_3=' + dm_ms_3 +  '&bvol_1=' + bvol_1 +  '&bvol_2=' + bvol_2 +  '&bvol_3=' + bvol_3 +  '&pv_1=' + pv_1 +  '&pv_2=' + pv_2 +  '&pv_3=' + pv_3 +  '&por_1=' + por_1 +  '&por_2=' + por_2 +  '&por_3=' + por_3 +  '&pd_1=' + pd_1 +  '&pd_2=' + pd_2 +  '&pd_3=' + pd_3 +  '&wc_1=' + wc_1 +  '&wc_2=' + wc_2 +  '&wc_3=' + wc_3+  '&amend_date=' + amend_date;
			
			// +  '&wtr_temp_1=' + wtr_temp_1 +  '&wtr_temp_2=' + wtr_temp_2 +  '&wtr_temp_3=' + wtr_temp_3 +  '&rt_m_1=' + rt_m_1 +  '&rt_m_2=' + rt_m_2 +  '&rt_m_3=' + rt_m_3 +  '&ss_m1_1=' + ss_m1_1 +  '&ss_m1_2=' + ss_m1_2 +  '&ss_m1_3=' + ss_m1_3 +  '&ss_m2_1=' + ss_m2_1 +  '&ss_m2_2=' + ss_m2_2 +  '&ss_m2_3=' + ss_m2_3 +  '&ss_m3_1=' + ss_m3_1 +  '&ss_m3_2=' + ss_m3_2 +  '&ss_m3_3=' + ss_m3_3 +  '&ss_m4_1=' + ss_m4_1 +  '&ss_m4_2=' + ss_m4_2 +  '&ss_m4_3=' + ss_m4_3 +  '&ss_m5_1=' + ss_m5_1 +  '&ss_m5_2=' + ss_m5_2 +  '&ss_m5_3=' + ss_m5_3 +  '&ssm_sub_1=' + ssm_sub_1 +  '&ssm_sub_2=' + ssm_sub_2 +  '&ssm_sub_3=' + ssm_sub_3 +  '&ssm_sat_1=' + ssm_sat_1 +  '&ssm_sat_2=' + ssm_sat_2 +  '&ssm_sat_3=' + ssm_sat_3 +  '&dm_ms_1=' + dm_ms_1 +  '&dm_ms_2=' + dm_ms_2 +  '&dm_ms_3=' + dm_ms_3 +  '&bvol_1=' + bvol_1 +  '&bvol_2=' + bvol_2 +  '&bvol_3=' + bvol_3 +  '&pv_1=' + pv_1 +  '&pv_2=' + pv_2 +  '&pv_3=' + pv_3 +  '&por_1=' + por_1 +  '&por_2=' + por_2 +  '&por_3=' + por_3 +  '&pd_1=' + pd_1 +  '&pd_2=' + pd_2 +  '&pd_3=' + pd_3 +  '&wc_1=' + wc_1 +  '&wc_2=' + wc_2 +  '&wc_3=' + wc_3 

		} else if (type == 'edit') {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var bh_no = $('#bh_no').val();
			var rock_depth = $('#rock_depth').val();
			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();
			var remark = $('#remark').val();
			var Sheet_no = $('#Sheet_no').val();
			var wt_m = $('#wt_m').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//POROSITY & DENSITY
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "den") {
					if (document.getElementById('chk_por').checked) {
						var chk_por = "1";
					} else {
						var chk_por = "0";
					}
					var wtr_temp_1 = $('#wtr_temp_1').val();
				    var wtr_temp_2 = $('#wtr_temp_2').val();
				    var wtr_temp_3 = $('#wtr_temp_3').val();
				    var rt_m_1 = $('#rt_m_1').val();
				    var rt_m_2 = $('#rt_m_2').val();
				    var rt_m_3 = $('#rt_m_3').val();
				    var ss_m1_1 = $('#ss_m1_1').val();
				    var ss_m1_2 = $('#ss_m1_2').val();
				    var ss_m1_3 = $('#ss_m1_3').val();
				    var ss_m2_1 = $('#ss_m2_1').val();
				    var ss_m2_2 = $('#ss_m2_2').val();
				    var ss_m2_3 = $('#ss_m2_3').val();
				    var ss_m3_1 = $('#ss_m3_1').val();
				    var ss_m3_2 = $('#ss_m3_2').val();
				    var ss_m3_3 = $('#ss_m3_3').val();
				    var ss_m4_1 = $('#ss_m4_1').val();
				    var ss_m4_2 = $('#ss_m4_2').val();
				    var ss_m4_3 = $('#ss_m4_3').val();
				    var ss_m5_1 = $('#ss_m5_1').val();
				    var ss_m5_2 = $('#ss_m5_2').val();
				    var ss_m5_3 = $('#ss_m5_3').val();
				    var ssm_sub_1 = $('#ssm_sub_1').val();
				    var ssm_sub_2 = $('#ssm_sub_2').val();
				    var ssm_sub_3 = $('#ssm_sub_3').val();
				    var ssm_sat_1 = $('#ssm_sat_1').val();
				    var ssm_sat_2 = $('#ssm_sat_2').val();
				    var ssm_sat_3 = $('#ssm_sat_3').val();
				    var dm_ms_1 = $('#dm_ms_1').val();
				    var dm_ms_2 = $('#dm_ms_2').val();
				    var dm_ms_3 = $('#dm_ms_3').val();
				    var bvol_1 = $('#bvol_1').val();
				    var bvol_2 = $('#bvol_2').val();
				    var bvol_3 = $('#bvol_3').val();
				    var pv_1 = $('#pv_1').val();
				    var pv_2 = $('#pv_2').val();
				    var pv_3 = $('#pv_3').val();
				    var por_1 = $('#por_1').val();
				    var por_2 = $('#por_2').val();
				    var por_3 = $('#por_3').val();
				    var pd_1 = $('#pd_1').val();
				    var pd_2 = $('#pd_2').val();
				    var pd_3 = $('#pd_3').val();
				    var wc_1 = $('#wc_1').val();
				    var wc_2 = $('#wc_2').val();
				    var wc_3 = $('#wc_3').val();
					
					
					break;
				} else {
					var chk_poi = "0";
					var wtr_temp_1 = "0";
				    var wtr_temp_2 = "0";
				    var wtr_temp_3 = "0";
				    var rt_m_1 = "0";
				    var rt_m_2 = "0";
				    var rt_m_3 = "0";
				    var ss_m1_1 = "0";
				    var ss_m1_2 = "0";
				    var ss_m1_3 = "0";
				    var ss_m2_1 = "0";
				    var ss_m2_2 = "0";
				    var ss_m2_3 = "0";
				    var ss_m3_1 = "0";
				    var ss_m3_2 = "0";
				    var ss_m3_3 = "0";
				    var ss_m4_1 = "0";
				    var ss_m4_2 = "0";
				    var ss_m4_3 = "0";
				    var ss_m5_1 = "0";
				    var ss_m5_2 = "0";
				    var ss_m5_3 = "0";
				    var ssm_sub_1 = "0";
				    var ssm_sub_2 = "0";
				    var ssm_sub_3 = "0";
				    var ssm_sat_1 = "0";
				    var ssm_sat_2 = "0";
				    var ssm_sat_3 = "0";
				    var dm_ms_1 = "0";
				    var dm_ms_2 = "0";
				    var dm_ms_3 = "0";
				    var bvol_1 = "0";
				    var bvol_2 = "0";
				    var bvol_3 = "0";
				    var pv_1 = "0";
				    var pv_2 = "0";
				    var pv_3 = "0";
				    var por_1 = "0";
				    var por_2 = "0";
				    var por_3 = "0";
				    var pd_1 = "0";
				    var pd_2 = "0";
				    var pd_3 = "0";
				    var wc_1 = "0";
				    var wc_2 = "0";
				    var wc_3 = "0";

				}

			}


			// COMPRESSIVE STRENGTH
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "com") {

					if (document.getElementById('chk_com').checked) {
						var chk_com = "1";
					} else {
						var chk_com = "0";
					}
					var desc1 = $('#desc1').val();
					var desc2 = $('#desc2').val();
					var desc3 = $('#desc3').val();
					var con1 = $('#con1').val();
					var con2 = $('#con2').val();
					var con3 = $('#con3').val();
					var depth1 = $('#depth1').val();
					var depth2 = $('#depth2').val();
					var depth3 = $('#depth3').val();
					var length1 = $('#length1').val();
					var length2 = $('#length2').val();
					var length3 = $('#length3').val();
					var dia1 = $('#dia1').val();
					var dia2 = $('#dia2').val();
					var dia3 = $('#dia3').val();
					var ratio1 = $('#ratio1').val();
					var ratio2 = $('#ratio2').val();
					var ratio3 = $('#ratio3').val();
					var corr1 = $('#corr1').val();
					var corr2 = $('#corr2').val();
					var corr3 = $('#corr3').val();
					var area1 = $('#area1').val();
					var area2 = $('#area2').val();
					var area3 = $('#area3').val();
					var fla1 = $('#fla1').val();
					var fla2 = $('#fla2').val();
					var fla3 = $('#fla3').val();
					var par1 = $('#par1').val();
					var par2 = $('#par2').val();
					var par3 = $('#par3').val();
					var ppl1 = $('#ppl1').val();
					var ppl2 = $('#ppl2').val();
					var ppl3 = $('#ppl3').val();
					var str1 = $('#str1').val();
					var str2 = $('#str2').val();
					var str3 = $('#str3').val();
					var rate1 = $('#rate1').val();
					var rate2 = $('#rate2').val();
					var rate3 = $('#rate3').val();
					var mod1 = $('#mod1').val();
					var mod2 = $('#mod2').val();
					var mod3 = $('#mod3').val();
					var load1 = $('#load1').val();
					var load2 = $('#load2').val();
					var load3 = $('#load3').val();
					var ucs1 = $('#ucs1').val();
					var ucs2 = $('#ucs2').val();
					var ucs3 = $('#ucs3').val();
					var cor1 = $('#cor1').val();
					var cor2 = $('#cor2').val();
					var cor3 = $('#cor3').val();
					var avg_ucs = $('#avg_ucs').val();
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
					var com_13 = $('#com_13').val();
					var com_14 = $('#com_14').val();
					var com_15 = $('#com_15').val();
					var com_16 = $('#com_16').val();
					var com_17 = $('#com_17').val();
					var com_18 = $('#com_18').val();
					var com_19 = $('#com_19').val();
					var com_20 = $('#com_20').val();
					var com_21 = $('#com_21').val();
					var com_22 = $('#com_22').val();
					var com_23 = $('#com_23').val();
					var com_24 = $('#com_24').val();
					var com_25 = $('#com_25').val();
					var com_26 = $('#com_26').val();
					var com_27 = $('#com_27').val();
					var com_28 = $('#com_28').val();
					var com_29 = $('#com_29').val();
					var com_30 = $('#com_30').val();
					var com_31 = $('#com_31').val();
					var com_32 = $('#com_32').val();
					var com_33 = $('#com_33').val();
					var com_34 = $('#com_34').val();
					var com_35 = $('#com_35').val();
					var com_36 = $('#com_36').val();
					var com_37 = $('#com_37').val();
					var com_38 = $('#com_38').val();
					var com_39 = $('#com_39').val();
					var com_40 = $('#com_40').val();
					var com_41 = $('#com_41').val();
					var com_42 = $('#com_42').val();
					var com_43 = $('#com_43').val();
					var com_44 = $('#com_44').val();
					var com_45 = $('#com_45').val();
					var com_46 = $('#com_46').val();
					var com_47 = $('#com_47').val();
					var com_48 = $('#com_48').val();
					var com_49 = $('#com_49').val();
					var com_50 = $('#com_50').val();
					var com_51 = $('#com_51').val();
					var com_52 = $('#com_52').val();
					var com_53 = $('#com_53').val();
					var com_54 = $('#com_54').val();
					var com_55 = $('#com_55').val();
					var com_56 = $('#com_56').val();
					var com_57 = $('#com_57').val();
					var com_58 = $('#com_58').val();
					var com_59 = $('#com_59').val();
					var com_60 = $('#com_60').val();
					var com_61 = $('#com_61').val();
					var com_62 = $('#com_62').val();
					var com_63 = $('#com_63').val();
					var com_64 = $('#com_64').val();
					var com_65 = $('#com_65').val();
					var com_66 = $('#com_66').val();
					var com_67 = $('#com_67').val();
					var com_68 = $('#com_68').val();
					var com_69 = $('#com_69').val();
					var com_70 = $('#com_70').val();
					var com_71 = $('#com_71').val();
					var com_72 = $('#com_72').val();
					var com_73 = $('#com_73').val();
					var com_74 = $('#com_74').val();
					var com_75 = $('#com_75').val();
					var com_76 = $('#com_76').val();
					var com_77 = $('#com_77').val();
					var com_78 = $('#com_78').val();
					var com_79 = $('#com_79').val();
					var com_80 = $('#com_80').val();
					var com_81 = $('#com_81').val();
					var com_82 = $('#com_82').val();
					var com_83 = $('#com_83').val();
					var com_84 = $('#com_84').val();
					var com_85 = $('#com_85').val();
					var com_86 = $('#com_86').val();
					var com_87 = $('#com_87').val();
					var com_88 = $('#com_88').val();
					var com_89 = $('#com_89').val();
					var com_90 = $('#com_90').val();
					var com_91 = $('#com_91').val();
					var com_92 = $('#com_92').val();
					var com_93 = $('#com_93').val();
					var com_94 = $('#com_94').val();
					var com_95 = $('#com_95').val();
					var com_96 = $('#com_96').val();
					var com_97 = $('#com_97').val();
					var com_98 = $('#com_98').val();
					var com_99 = $('#com_99').val();
					var com_100 = $('#com_100').val();
					var com_101 = $('#com_101').val();
					var com_102 = $('#com_102').val();
					var com_103 = $('#com_103').val();
					var com_104 = $('#com_104').val();
					var com_105 = $('#com_105').val();
					var com_106 = $('#com_106').val();
					var com_107 = $('#com_107').val();
					var com_108 = $('#com_108').val();
					var com_109 = $('#com_109').val();


					break;
				} else {
					var chk_com = "0";
					var desc1 = "0";
					var desc2 = "0";
					var desc3 = "0";
					var con1 = "0";
					var con2 = "0";
					var con3 = "0";
					var depth1 = "0";
					var depth2 = "0";
					var depth3 = "0";
					var length1 = "0";
					var length2 = "0";
					var length3 = "0";
					var dia1 = "0";
					var dia2 = "0";
					var dia3 = "0";
					var ratio1 = "0";
					var ratio2 = "0";
					var ratio3 = "0";
					var corr1 = "0";
					var corr2 = "0";
					var corr3 = "0";
					var area1 = "0";
					var area2 = "0";
					var area3 = "0";
					var fla1 = "0";
					var fla2 = "0";
					var fla3 = "0";
					var par1 = "0";
					var par2 = "0";
					var par3 = "0";
					var ppl1 = "0";
					var ppl2 = "0";
					var ppl3 = "0";
					var str1 = "0";
					var str2 = "0";
					var str3 = "0";
					var rate1 = "0";
					var rate2 = "0";
					var rate3 = "0";
					var mod1 = "0";
					var mod2 = "0";
					var mod3 = "0";
					var load1 = "0";
					var load2 = "0";
					var load3 = "0";
					var ucs1 = "0";
					var ucs2 = "0";
					var ucs3 = "0";
					var cor1 = "0";
					var cor2 = "0";
					var cor3 = "0";
					var avg_ucs = "0";
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
					var com_13 = "0";
					var com_14 = "0";
					var com_15 = "0";
					var com_16 = "0";
					var com_17 = "0";
					var com_18 = "0";
					var com_19 = "0";
					var com_20 = "0";
					var com_21 = "0";
					var com_22 = "0";
					var com_23 = "0";
					var com_24 = "0";
					var com_25 = "0";
					var com_26 = "0";
					var com_27 = "0";
					var com_28 = "0";
					var com_29 = "0";
					var com_30 = "0";
					var com_31 = "0";
					var com_32 = "0";
					var com_33 = "0";
					var com_34 = "0";
					var com_35 = "0";
					var com_36 = "0";
					var com_37 = "0";
					var com_38 = "0";
					var com_39 = "0";
					var com_40 = "0";
					var com_41 = "0";
					var com_42 = "0";
					var com_43 = "0";
					var com_44 = "0";
					var com_45 = "0";
					var com_46 = "0";
					var com_47 = "0";
					var com_48 = "0";
					var com_49 = "0";
					var com_50 = "0";
					var com_51 = "0";
					var com_52 = "0";
					var com_53 = "0";
					var com_54 = "0";
					var com_55 = "0";
					var com_56 = "0";
					var com_57 = "0";
					var com_58 = "0";
					var com_59 = "0";
					var com_60 = "0";
					var com_61 = "0";
					var com_62 = "0";
					var com_63 = "0";
					var com_64 = "0";
					var com_65 = "0";
					var com_66 = "0";
					var com_67 = "0";
					var com_68 = "0";
					var com_69 = "0";
					var com_70 = "0";
					var com_71 = "0";
					var com_72 = "0";
					var com_73 = "0";
					var com_74 = "0";
					var com_75 = "0";
					var com_76 = "0";
					var com_77 = "0";
					var com_78 = "0";
					var com_79 = "0";
					var com_80 = "0";
					var com_81 = "0";
					var com_82 = "0";
					var com_83 = "0";
					var com_84 = "0";
					var com_85 = "0";
					var com_86 = "0";
					var com_87 = "0";
					var com_88 = "0";
					var com_89 = "0";
					var com_90 = "0";
					var com_91 = "0";
					var com_92 = "0";
					var com_93 = "0";
					var com_94 = "0";
					var com_95 = "0";
					var com_96 = "0";
					var com_97 = "0";
					var com_98 = "0";
					var com_99 = "0";
					var com_100 = "0";
					var com_101 = "0";
					var com_102 = "0";
					var com_103 = "0";
					var com_104 = "0";
					var com_105 = "0";
					var com_106 = "0";
					var com_107 = "0";
					var com_108 = "0";
					var com_109 = "0";


				}

			}

			
			//SP AND WATER ABR
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "spg") {
					if (document.getElementById('chk_sp').checked) {
						var chk_sp = "1";
					} else {
						var chk_sp = "0";
					}
				//specific gravity and water abrasion-5							
				var sp_wt_st_1 = $('#sp_wt_st_1').val();
				var sp_wt_st_2 = $('#sp_wt_st_2').val();
				var sp_wt_st_3 = $('#sp_wt_st_3').val();
				var sp_wt_st_4 = $('#sp_wt_st_4').val();
				var sp_wt_st_5 = $('#sp_wt_st_5').val();
				var sp_wt_st_6 = $('#sp_wt_st_6').val();
				var sp_wt_st_7 = $('#sp_wt_st_7').val();
				var sp_wt_st_8 = $('#sp_wt_st_8').val();
				var sp_wt_st_9 = $('#sp_wt_st_9').val();
				var sp_temp = $('#sp_temp').val();
				var sp_w_s_1 = $('#sp_w_s_1').val();
				var sp_w_s_2 = $('#sp_w_s_2').val();
				var sp_w_s_3 = $('#sp_w_s_3').val();
				var sp_w_s_4 = $('#sp_w_s_4').val();
				var sp_w_s_5 = $('#sp_w_s_5').val();
				var sp_w_s_6 = $('#sp_w_s_6').val();
				var sp_w_s_7 = $('#sp_w_s_7').val();
				var sp_w_s_8 = $('#sp_w_s_8').val();
				var sp_w_s_9 = $('#sp_w_s_9').val();
				var sp_w_sur_1 = $('#sp_w_sur_1').val();
				var sp_w_sur_2 = $('#sp_w_sur_2').val();
				var sp_w_sur_3 = $('#sp_w_sur_3').val();
				var sp_w_sur_4 = $('#sp_w_sur_4').val();
				var sp_w_sur_5 = $('#sp_w_sur_5').val();
				var sp_w_sur_6 = $('#sp_w_sur_6').val();
				var sp_w_sur_7 = $('#sp_w_sur_7').val();
				var sp_w_sur_8 = $('#sp_w_sur_8').val();
				var sp_w_sur_9 = $('#sp_w_sur_9').val();
				var sp_agg1 = $('#sp_agg1').val();
				var sp_agg2 = $('#sp_agg2').val();
				var sp_agg3 = $('#sp_agg3').val();
				var sp_agg4 = $('#sp_agg4').val();
				var sp_agg5 = $('#sp_agg5').val();
				var sp_agg6 = $('#sp_agg6').val();
				var sp_agg7 = $('#sp_agg7').val();
				var sp_agg8 = $('#sp_agg8').val();
				var sp_agg9 = $('#sp_agg9').val();
				var sp_wat1 = $('#sp_wat1').val();
				var sp_wat2 = $('#sp_wat2').val();
				var sp_wat3 = $('#sp_wat3').val();
				var sp_wat4 = $('#sp_wat4').val();
				var sp_wat5 = $('#sp_wat5').val();
				var sp_wat6 = $('#sp_wat6').val();
				var sp_wat7 = $('#sp_wat7').val();
				var sp_wat8 = $('#sp_wat8').val();
				var sp_wat9 = $('#sp_wat9').val();
				var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
				var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
				var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();
				var sp_specific_gravity_4 = $('#sp_specific_gravity_4').val();
				var sp_specific_gravity_5 = $('#sp_specific_gravity_5').val();
				var sp_specific_gravity_6 = $('#sp_specific_gravity_6').val();
				var sp_specific_gravity_7 = $('#sp_specific_gravity_7').val();
				var sp_specific_gravity_8 = $('#sp_specific_gravity_8').val();
				var sp_specific_gravity_9 = $('#sp_specific_gravity_9').val();
				var sp_water_abr_1 = $('#sp_water_abr_1').val();
				var sp_water_abr_2 = $('#sp_water_abr_2').val();
				var sp_water_abr_3 = $('#sp_water_abr_3').val();
				var sp_water_abr_4 = $('#sp_water_abr_4').val();
				var sp_water_abr_5 = $('#sp_water_abr_5').val();
				var sp_water_abr_6 = $('#sp_water_abr_6').val();
				var sp_water_abr_7 = $('#sp_water_abr_7').val();
				var sp_water_abr_8 = $('#sp_water_abr_8').val();
				var sp_water_abr_9 = $('#sp_water_abr_9').val();
				var sp_specific_gravity = $('#sp_specific_gravity').val();
				var sp_sg_avg_2 = $('#sp_sg_avg_2').val();
				var sp_sg_avg_3 = $('#sp_sg_avg_3').val();
				var sp_water_abr = $('#sp_water_abr').val();
				var sp_wa_avg_2 = $('#sp_wa_avg_2').val();
				var sp_wa_avg_3 = $('#sp_wa_avg_3').val();
				var sp_porosity_1 = $('#sp_porosity_1').val();
				var sp_porosity_2 = $('#sp_porosity_2').val();
				var sp_porosity_3 = $('#sp_porosity_3').val();
				
					break;
				} else {
				var chk_sp = "";
				var sp_wt_st_1 = "";
				var sp_wt_st_2 = "";
				var sp_wt_st_3 = "";
				var sp_wt_st_4 = "";
				var sp_wt_st_5 = "";
				var sp_wt_st_6 = "";
				var sp_wt_st_7 = "";
				var sp_wt_st_8 = "";
				var sp_wt_st_9 = "";
				var sp_temp = "";
				var sp_w_s_1 = "";
				var sp_w_s_2 = "";
				var sp_w_s_3 = "";
				var sp_w_s_4 = "";
				var sp_w_s_5 = "";
				var sp_w_s_6 = "";
				var sp_w_s_7 = "";
				var sp_w_s_8 = "";
				var sp_w_s_9 = "";
				var sp_w_sur_1 = "";
				var sp_w_sur_2 = "";
				var sp_w_sur_3 = "";
				var sp_w_sur_4 = "";
				var sp_w_sur_5 = "";
				var sp_w_sur_6 = "";
				var sp_w_sur_7 = "";
				var sp_w_sur_8 = "";
				var sp_w_sur_9 = "";
				var sp_agg1 = "";
				var sp_agg2 = "";
				var sp_agg3 = "";
				var sp_agg4 = "";
				var sp_agg5 = "";
				var sp_agg6 = "";
				var sp_agg7 = "";
				var sp_agg8 = "";
				var sp_agg9 = "";
				var sp_wat1 = "";
				var sp_wat2 = "";
				var sp_wat3 = "";
				var sp_wat4 = "";
				var sp_wat5 = "";
				var sp_wat6 = "";
				var sp_wat7 = "";
				var sp_wat8 = "";
				var sp_wat9 = "";
				var sp_specific_gravity_1 = "";
				var sp_specific_gravity_2 = "";
				var sp_specific_gravity_3 = "";
				var sp_specific_gravity_4 = "";
				var sp_specific_gravity_5 = "";
				var sp_specific_gravity_6 = "";
				var sp_specific_gravity_7 = "";
				var sp_specific_gravity_8 = "";
				var sp_specific_gravity_9 = "";
				var sp_water_abr_1 = "";
				var sp_water_abr_2 = "";
				var sp_water_abr_3 = "";
				var sp_water_abr_4 = "";
				var sp_water_abr_5 = "";
				var sp_water_abr_6 = "";
				var sp_water_abr_7 = "";
				var sp_water_abr_8 = "";
				var sp_water_abr_9 = "";
				var sp_specific_gravity = "";
				var sp_sg_avg_2 = "";
				var sp_sg_avg_3 = "";
				var sp_water_abr = "";
				var sp_wa_avg_2 = "";
				var sp_wa_avg_3 = "";
				var sp_porosity_1 = "";
				var sp_porosity_2 = "";
				var sp_porosity_3 = "";
				

				}

			}
			
			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&bh_no=' + bh_no + '&rock_depth=' + rock_depth + '&chk_por=' + chk_por + '&chk_com=' + chk_com + '&desc1=' + desc1 + '&desc2=' + desc2 + '&desc3=' + desc3 + '&con1=' + con1 + '&con2=' + con2 + '&con3=' + con3 + '&depth1=' + depth1 + '&depth2=' + depth2 + '&depth3=' + depth3 + '&length1=' + length1 + '&length2=' + length2 + '&length3=' + length3 + '&dia1=' + dia1 + '&dia2=' + dia2 + '&dia3=' + dia3 + '&ratio1=' + ratio1 + '&ratio2=' + ratio2 + '&ratio3=' + ratio3 + '&corr1=' + corr1 + '&corr2=' + corr2 + '&corr3=' + corr3 + '&area1=' + area1 + '&area2=' + area2 + '&area3=' + area3 + '&fla1=' + fla1 + '&fla2=' + fla2 + '&fla3=' + fla3 + '&par1=' + par1 + '&par2=' + par2 + '&par3=' + par3 + '&ppl1=' + ppl1 + '&ppl2=' + ppl2 + '&ppl3=' + ppl3 + '&str1=' + str1 + '&str2=' + str2 + '&str3=' + str3 + '&rate1=' + rate1 + '&rate2=' + rate2 + '&rate3=' + rate3 + '&mod1=' + mod1 + '&mod2=' + mod2 + '&mod3=' + mod3 + '&load1=' + load1 + '&load2=' + load2 + '&load3=' + load3 + '&ucs1=' + ucs1 + '&ucs2=' + ucs2 + '&ucs3=' + ucs3 + '&cor1=' + cor1 + '&cor2=' + cor2 + '&cor3=' + cor3 + '&avg_ucs=' + avg_ucs + '&chk_poi=' + chk_poi + '&chk_sp=' + chk_sp + '&sp_w_sur_1=' + sp_w_sur_1 + '&sp_w_sur_2=' + sp_w_sur_2 + '&sp_w_sur_3=' + sp_w_sur_3 + '&sp_w_s_1=' + sp_w_s_1 + '&sp_w_s_2=' + sp_w_s_2 + '&sp_w_s_3=' + sp_w_s_3 + '&sp_wt_st_1=' + sp_wt_st_1 + '&sp_wt_st_2=' + sp_wt_st_2 + '&sp_wt_st_3=' + sp_wt_st_3 + '&sp_agg1=' + sp_agg1 + '&sp_agg2=' + sp_agg2 + '&sp_agg3=' + sp_agg3 + '&sp_wat1=' + sp_wat1 + '&sp_wat2=' + sp_wat2 + '&sp_wat3=' + sp_wat3 + '&sp_specific_gravity=' + sp_specific_gravity + '&sp_specific_gravity_1=' + sp_specific_gravity_1 + '&sp_specific_gravity_2=' + sp_specific_gravity_2 + '&sp_specific_gravity_3=' + sp_specific_gravity_3 + '&sp_water_abr=' + sp_water_abr + '&sp_water_abr_1=' + sp_water_abr_1 + '&sp_water_abr_2=' + sp_water_abr_2 + '&sp_water_abr_3=' + sp_water_abr_3 + '&ulr=' + ulr+  '&com_1=' + com_1 +  '&com_2=' + com_2 +  '&com_3=' + com_3 +  '&com_4=' + com_4 +  '&com_5=' + com_5 +  '&com_6=' + com_6 +  '&com_7=' + com_7 +  '&com_8=' + com_8 +  '&com_9=' + com_9 +  '&com_10=' + com_10 +  '&com_11=' + com_11 +  '&com_12=' + com_12 +  '&com_13=' + com_13 +  '&com_14=' + com_14 +  '&com_15=' + com_15 +  '&com_16=' + com_16 +  '&com_17=' + com_17 +  '&com_18=' + com_18 +  '&com_19=' + com_19 +  '&com_20=' + com_20 +  '&com_21=' + com_21 +  '&com_22=' + com_22 +  '&com_23=' + com_23 +  '&com_24=' + com_24 +  '&com_25=' + com_25 +  '&com_26=' + com_26 +  '&com_27=' + com_27 +  '&com_28=' + com_28 +  '&com_29=' + com_29 +  '&com_30=' + com_30 +  '&com_31=' + com_31 +  '&com_32=' + com_32 +  '&com_33=' + com_33 +  '&com_34=' + com_34 +  '&com_35=' + com_35 +  '&com_36=' + com_36 +  '&com_37=' + com_37 +  '&com_38=' + com_38 +  '&com_39=' + com_39 +  '&com_40=' + com_40 +  '&com_41=' + com_41 +  '&com_42=' + com_42 +  '&com_43=' + com_43 +  '&com_44=' + com_44 +  '&com_45=' + com_45 +  '&com_46=' + com_46 +  '&com_47=' + com_47 +  '&com_48=' + com_48 +  '&com_49=' + com_49 +  '&com_50=' + com_50 +  '&com_51=' + com_51 +  '&com_52=' + com_52 +  '&com_53=' + com_53 +  '&com_54=' + com_54 +  '&com_55=' + com_55 +  '&com_56=' + com_56 +  '&com_57=' + com_57 +  '&com_58=' + com_58 +  '&com_59=' + com_59 +  '&com_60=' + com_60 +  '&com_61=' + com_61 +  '&com_62=' + com_62 +  '&com_63=' + com_63 +  '&com_64=' + com_64 +  '&com_65=' + com_65 +  '&com_66=' + com_66 +  '&com_67=' + com_67 +  '&com_68=' + com_68 +  '&com_69=' + com_69 +  '&com_70=' + com_70 +  '&com_71=' + com_71 +  '&com_72=' + com_72 +  '&com_73=' + com_73 +  '&com_74=' + com_74 +  '&com_75=' + com_75 +  '&com_76=' + com_76 +  '&com_77=' + com_77 +  '&com_78=' + com_78 +  '&com_79=' + com_79 +  '&com_80=' + com_80 +  '&com_81=' + com_81 +  '&com_82=' + com_82 +  '&com_83=' + com_83 +  '&com_84=' + com_84 +  '&com_85=' + com_85 +  '&com_86=' + com_86 +  '&com_87=' + com_87 +  '&com_88=' + com_88 +  '&com_89=' + com_89 +  '&com_90=' + com_90 +  '&com_91=' + com_91 +  '&com_92=' + com_92 +  '&com_93=' + com_93 +  '&com_94=' + com_94 +  '&com_95=' + com_95 +  '&com_96=' + com_96 +  '&com_97=' + com_97 +  '&com_98=' + com_98 +  '&com_99=' + com_99 +  '&com_100=' + com_100 +  '&com_101=' + com_101 +  '&com_102=' + com_102 +  '&com_103=' + com_103 +  '&com_104=' + com_104 +  '&com_105=' + com_105 +  '&com_106=' + com_106 +  '&com_107=' + com_107 +  '&com_108=' + com_108 + '&com_109=' +com_109  +  '&sp_wt_st_4=' + sp_wt_st_4 +  '&sp_wt_st_5=' + sp_wt_st_5 +  '&sp_wt_st_6=' + sp_wt_st_6 +  '&sp_wt_st_7=' + sp_wt_st_7 +  '&sp_wt_st_8=' + sp_wt_st_8 +  '&sp_wt_st_9=' + sp_wt_st_9 +  '&sp_w_s_4=' + sp_w_s_4 +  '&sp_w_s_5=' + sp_w_s_5 +  '&sp_w_s_6=' + sp_w_s_6 +  '&sp_w_s_7=' + sp_w_s_7 +  '&sp_w_s_8=' + sp_w_s_8 +  '&sp_w_s_9=' + sp_w_s_9 +  '&sp_w_sur_4=' + sp_w_sur_4 +  '&sp_w_sur_5=' + sp_w_sur_5 +  '&sp_w_sur_6=' + sp_w_sur_6 +  '&sp_w_sur_7=' + sp_w_sur_7 +  '&sp_w_sur_8=' + sp_w_sur_8 +  '&sp_w_sur_9=' + sp_w_sur_9 +  '&sp_agg4=' + sp_agg4 +  '&sp_agg5=' + sp_agg5 +  '&sp_agg6=' + sp_agg6 +  '&sp_agg7=' + sp_agg7 +  '&sp_agg8=' + sp_agg8 +  '&sp_agg9=' + sp_agg9 +  '&sp_wat4=' + sp_wat4 +  '&sp_wat5=' + sp_wat5 +  '&sp_wat6=' + sp_wat6 +  '&sp_wat7=' + sp_wat7 +  '&sp_wat8=' + sp_wat8 +  '&sp_wat9=' + sp_wat9 +  '&sp_specific_gravity_4=' + sp_specific_gravity_4 +  '&sp_specific_gravity_5=' + sp_specific_gravity_5 +  '&sp_specific_gravity_6=' + sp_specific_gravity_6 +  '&sp_specific_gravity_7=' + sp_specific_gravity_7 +  '&sp_specific_gravity_8=' + sp_specific_gravity_8 +  '&sp_specific_gravity_9=' + sp_specific_gravity_9 +  '&sp_water_abr_4=' + sp_water_abr_4 +  '&sp_water_abr_5=' + sp_water_abr_5 +  '&sp_water_abr_6=' + sp_water_abr_6 +  '&sp_water_abr_7=' + sp_water_abr_7 +  '&sp_water_abr_8=' + sp_water_abr_8 +  '&sp_water_abr_9=' + sp_water_abr_9 +  '&sp_sg_avg_2=' + sp_sg_avg_2 +  '&sp_sg_avg_3=' + sp_sg_avg_3 +  '&sp_wa_avg_2=' + sp_wa_avg_2 +  '&sp_wa_avg_3=' + sp_wa_avg_3 +  '&sp_porosity_1=' + sp_porosity_1 +  '&sp_porosity_2=' + sp_porosity_2 +  '&sp_porosity_3=' + sp_porosity_3 + '&sp_temp=' +sp_temp+ '&remark=' + remark + '&Sheet_no=' +Sheet_no + '&wt_m=' +wt_m +  '&wtr_temp_1=' + wtr_temp_1 +  '&wtr_temp_2=' + wtr_temp_2 +  '&wtr_temp_3=' + wtr_temp_3 +  '&rt_m_1=' + rt_m_1 +  '&rt_m_2=' + rt_m_2 +  '&rt_m_3=' + rt_m_3 +  '&ss_m1_1=' + ss_m1_1 +  '&ss_m1_2=' + ss_m1_2 +  '&ss_m1_3=' + ss_m1_3 +  '&ss_m2_1=' + ss_m2_1 +  '&ss_m2_2=' + ss_m2_2 +  '&ss_m2_3=' + ss_m2_3 +  '&ss_m3_1=' + ss_m3_1 +  '&ss_m3_2=' + ss_m3_2 +  '&ss_m3_3=' + ss_m3_3 +  '&ss_m4_1=' + ss_m4_1 +  '&ss_m4_2=' + ss_m4_2 +  '&ss_m4_3=' + ss_m4_3 +  '&ss_m5_1=' + ss_m5_1 +  '&ss_m5_2=' + ss_m5_2 +  '&ss_m5_3=' + ss_m5_3 +  '&ssm_sub_1=' + ssm_sub_1 +  '&ssm_sub_2=' + ssm_sub_2 +  '&ssm_sub_3=' + ssm_sub_3 +  '&ssm_sat_1=' + ssm_sat_1 +  '&ssm_sat_2=' + ssm_sat_2 +  '&ssm_sat_3=' + ssm_sat_3 +  '&dm_ms_1=' + dm_ms_1 +  '&dm_ms_2=' + dm_ms_2 +  '&dm_ms_3=' + dm_ms_3 +  '&bvol_1=' + bvol_1 +  '&bvol_2=' + bvol_2 +  '&bvol_3=' + bvol_3 +  '&pv_1=' + pv_1 +  '&pv_2=' + pv_2 +  '&pv_3=' + pv_3 +  '&por_1=' + por_1 +  '&por_2=' + por_2 +  '&por_3=' + por_3 +  '&pd_1=' + pd_1 +  '&pd_2=' + pd_2 +  '&pd_3=' + pd_3 +  '&wc_1=' + wc_1 +  '&wc_2=' + wc_2 +  '&wc_3=' + wc_3+  '&amend_date=' + amend_date;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_rock_test.php',
			data: billData,
			dataType: 'html',
			success: function(msg) {
				console.log(msg);
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
			url: '<?php echo $base_url; ?>save_rock_test.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);
				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);
				$('#ulr').val(data.ulr);
				$('#amend_date').val(data.amend_date);
				$('#bh_no').val(data.bh_no);
				$('#rock_depth').val(data.rock_depth);
				$('#remark').val(data.remark);
				$('#Sheet_no').val(data.Sheet_no);
				$('#wt_m').val(data.wt_m);


				var temp = $('#test_list').val();
				var aa = temp.split(",");
				//POROSITY & DENSITY
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "den") {

						var chk_por = data.chk_por;
						if (chk_por == "1") {
							$('#txtpor').css("background-color", "var(--success)");
							$("#chk_por").prop("checked", true);

						} else {
							$('#txtpor').css("background-color", "white");
							$("#chk_por").prop("checked", false);

						}

						$('#wtr_temp_1').val(data.wtr_temp_1);
				        $('#wtr_temp_2').val(data.wtr_temp_2);
				        $('#wtr_temp_3').val(data.wtr_temp_3);
				        $('#rt_m_1').val(data.rt_m_1);
				        $('#rt_m_2').val(data.rt_m_2);
				        $('#rt_m_3').val(data.rt_m_3);
				        $('#ss_m1_1').val(data.ss_m1_1);
				        $('#ss_m1_2').val(data.ss_m1_2);
				        $('#ss_m1_3').val(data.ss_m1_3);
				        $('#ss_m2_1').val(data.ss_m2_1);
				        $('#ss_m2_2').val(data.ss_m2_2);
				        $('#ss_m2_3').val(data.ss_m2_3);
				        $('#ss_m3_1').val(data.ss_m3_1);
				        $('#ss_m3_2').val(data.ss_m3_2);
				        $('#ss_m3_3').val(data.ss_m3_3);
				        $('#ss_m4_1').val(data.ss_m4_1);
				        $('#ss_m4_2').val(data.ss_m4_2);
				        $('#ss_m4_3').val(data.ss_m4_3);
				        $('#ss_m5_1').val(data.ss_m5_1);
				        $('#ss_m5_2').val(data.ss_m5_2);
				        $('#ss_m5_3').val(data.ss_m5_3);
				        $('#ssm_sub_1').val(data.ssm_sub_1);
				        $('#ssm_sub_2').val(data.ssm_sub_2);
				        $('#ssm_sub_3').val(data.ssm_sub_3);
				        $('#ssm_sat_1').val(data.ssm_sat_1);
				        $('#ssm_sat_2').val(data.ssm_sat_2);
				        $('#ssm_sat_3').val(data.ssm_sat_3);
				        $('#dm_ms_1').val(data.dm_ms_1);
				        $('#dm_ms_2').val(data.dm_ms_2);
				        $('#dm_ms_3').val(data.dm_ms_3);
				        $('#bvol_1').val(data.bvol_1);
				        $('#bvol_2').val(data.bvol_2);
				        $('#bvol_3').val(data.bvol_3);
				        $('#pv_1').val(data.pv_1);
				        $('#pv_2').val(data.pv_2);
				        $('#pv_3').val(data.pv_3);
				        $('#por_1').val(data.por_1);
				        $('#por_2').val(data.por_2);
				        $('#por_3').val(data.por_3);
				        $('#pd_1').val(data.pd_1);
				        $('#pd_2').val(data.pd_2);
				        $('#pd_3').val(data.pd_3);
				        $('#wc_1').val(data.wc_1);
				        $('#wc_2').val(data.wc_2);
				        $('#wc_3').val(data.wc_3);
						

						break;
					} else {

					}

				}


				
				//COMPRESSIVE STRENGTH 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "com") {
						var chk_com = data.chk_com;
						if (chk_com == "1") {
							$('#txtcom').css("background-color", "var(--success)");
							$("#chk_com").prop("checked", true);
						} else {
							$('#txtcom').css("background-color", "white");
							$("#chk_com").prop("checked", false);
						}
						$('#desc1').val(data.desc1);
						$('#desc2').val(data.desc2);
						$('#desc3').val(data.desc3);
						$('#con1').val(data.con1);
						$('#con2').val(data.con2);
						$('#con3').val(data.con3);
						$('#depth1').val(data.depth1);
						$('#depth2').val(data.depth2);
						$('#depth3').val(data.depth3);
						$('#length1').val(data.length1);
						$('#length2').val(data.length2);
						$('#length3').val(data.length3);
						$('#dia1').val(data.dia1);
						$('#dia2').val(data.dia2);
						$('#dia3').val(data.dia3);
						$('#ratio1').val(data.ratio1);
						$('#ratio2').val(data.ratio2);
						$('#ratio3').val(data.ratio3);
						$('#corr1').val(data.corr1);
						$('#corr2').val(data.corr2);
						$('#corr3').val(data.corr3);
						$('#area1').val(data.area1);
						$('#area2').val(data.area2);
						$('#area3').val(data.area3);
						$('#fla1').val(data.fla1);
						$('#fla2').val(data.fla2);
						$('#fla3').val(data.fla3);
						$('#par1').val(data.par1);
						$('#par2').val(data.par2);
						$('#par3').val(data.par3);
						$('#ppl1').val(data.ppl1);
						$('#ppl2').val(data.ppl2);
						$('#ppl3').val(data.ppl3);
						$('#str1').val(data.str1);
						$('#str2').val(data.str2);
						$('#str3').val(data.str3);
						$('#rate1').val(data.rate1);
						$('#rate2').val(data.rate2);
						$('#rate3').val(data.rate3);
						$('#mod1').val(data.mod1);
						$('#mod2').val(data.mod2);
						$('#mod3').val(data.mod3);
						$('#load1').val(data.load1);
						$('#load2').val(data.load2);
						$('#load3').val(data.load3);
						$('#ucs1').val(data.ucs1);
						$('#ucs2').val(data.ucs2);
						$('#ucs3').val(data.ucs3);
						$('#cor1').val(data.cor1);
						$('#cor2').val(data.cor2);
						$('#cor3').val(data.cor3);
						$('#avg_ucs').val(data.avg_ucs);
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
						$('#com_13').val(data.com_13);
						$('#com_14').val(data.com_14);
						$('#com_15').val(data.com_15);
						$('#com_16').val(data.com_16);
						$('#com_17').val(data.com_17);
						$('#com_18').val(data.com_18);
						$('#com_19').val(data.com_19);
						$('#com_20').val(data.com_20);
						$('#com_21').val(data.com_21);
						$('#com_22').val(data.com_22);
						$('#com_23').val(data.com_23);
						$('#com_24').val(data.com_24);
						$('#com_25').val(data.com_25);
						$('#com_26').val(data.com_26);
						$('#com_27').val(data.com_27);
						$('#com_28').val(data.com_28);
						$('#com_29').val(data.com_29);
						$('#com_30').val(data.com_30);
						$('#com_31').val(data.com_31);
						$('#com_32').val(data.com_32);
						$('#com_33').val(data.com_33);
						$('#com_34').val(data.com_34);
						$('#com_35').val(data.com_35);
						$('#com_36').val(data.com_36);
						$('#com_37').val(data.com_37);
						$('#com_38').val(data.com_38);
						$('#com_39').val(data.com_39);
						$('#com_40').val(data.com_40);
						$('#com_41').val(data.com_41);
						$('#com_42').val(data.com_42);
						$('#com_43').val(data.com_43);
						$('#com_44').val(data.com_44);
						$('#com_45').val(data.com_45);
						$('#com_46').val(data.com_46);
						$('#com_47').val(data.com_47);
						$('#com_48').val(data.com_48);
						$('#com_49').val(data.com_49);
						$('#com_50').val(data.com_50);
						$('#com_51').val(data.com_51);
						$('#com_52').val(data.com_52);
						$('#com_53').val(data.com_53);
						$('#com_54').val(data.com_54);
						$('#com_55').val(data.com_55);
						$('#com_56').val(data.com_56);
						$('#com_57').val(data.com_57);
						$('#com_58').val(data.com_58);
						$('#com_59').val(data.com_59);
						$('#com_60').val(data.com_60);
						$('#com_61').val(data.com_61);
						$('#com_62').val(data.com_62);
						$('#com_63').val(data.com_63);
						$('#com_64').val(data.com_64);
						$('#com_65').val(data.com_65);
						$('#com_66').val(data.com_66);
						$('#com_67').val(data.com_67);
						$('#com_68').val(data.com_68);
						$('#com_69').val(data.com_69);
						$('#com_70').val(data.com_70);
						$('#com_71').val(data.com_71);
						$('#com_72').val(data.com_72);
						$('#com_73').val(data.com_73);
						$('#com_74').val(data.com_74);
						$('#com_75').val(data.com_75);
						$('#com_76').val(data.com_76);
						$('#com_77').val(data.com_77);
						$('#com_78').val(data.com_78);
						$('#com_79').val(data.com_79);
						$('#com_80').val(data.com_80);
						$('#com_81').val(data.com_81);
						$('#com_82').val(data.com_82);
						$('#com_83').val(data.com_83);
						$('#com_84').val(data.com_84);
						$('#com_85').val(data.com_85);
						$('#com_86').val(data.com_86);
						$('#com_87').val(data.com_87);
						$('#com_88').val(data.com_88);
						$('#com_89').val(data.com_89);
						$('#com_90').val(data.com_90);
						$('#com_91').val(data.com_91);
						$('#com_92').val(data.com_92);
						$('#com_93').val(data.com_93);
						$('#com_94').val(data.com_94);
						$('#com_95').val(data.com_95);
						$('#com_96').val(data.com_96);
						$('#com_97').val(data.com_97);
						$('#com_98').val(data.com_98);
						$('#com_99').val(data.com_99);
						$('#com_100').val(data.com_100);
						$('#com_101').val(data.com_101);
						$('#com_102').val(data.com_102);
						$('#com_103').val(data.com_103);
						$('#com_104').val(data.com_104);
						$('#com_105').val(data.com_105);
						$('#com_106').val(data.com_106);
						$('#com_107').val(data.com_107);
						$('#com_108').val(data.com_108);
						$('#com_109').val(data.com_109);

						break;
					} else {

					}

				}




				
				//sp and water
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "spg") {
						var chk_sp = data.chk_sp;
						if (chk_sp == "1") {
							$('#txtspg').css("background-color", "var(--success)");
							$("#chk_sp").prop("checked", true);
						} else {
							$('#txtspg').css("background-color", "white");
							$("#chk_sp").prop("checked", false);
						}
						//specific gravity and water abr
						$('#sp_w_sur_1').val(data.sp_w_sur_1);
						$('#sp_w_sur_2').val(data.sp_w_sur_2);
						$('#sp_w_sur_3').val(data.sp_w_sur_3);
						$('#sp_w_s_1').val(data.sp_w_s_1);
						$('#sp_w_s_2').val(data.sp_w_s_2);
						$('#sp_w_s_3').val(data.sp_w_s_3);
						$('#sp_wt_st_1').val(data.sp_wt_st_1);
						$('#sp_wt_st_2').val(data.sp_wt_st_2);
						$('#sp_wt_st_3').val(data.sp_wt_st_3);
						$('#sp_agg1').val(data.sp_agg1);
						$('#sp_agg2').val(data.sp_agg2);
						$('#sp_agg3').val(data.sp_agg3);
						$('#sp_wat1').val(data.sp_wat1);
						$('#sp_wat2').val(data.sp_wat2);
						$('#sp_wat3').val(data.sp_wat3);
						$('#sp_specific_gravity_1').val(data.sp_specific_gravity_1);
						$('#sp_specific_gravity_2').val(data.sp_specific_gravity_2);
						$('#sp_specific_gravity_3').val(data.sp_specific_gravity_3);
						$('#sp_specific_gravity').val(data.sp_specific_gravity);
						$('#sp_water_abr').val(data.sp_water_abr);
						$('#sp_water_abr_1').val(data.sp_water_abr_1);
						$('#sp_water_abr_2').val(data.sp_water_abr_2);
						$('#sp_water_abr_3').val(data.sp_water_abr_3);
						$('#sp_wt_st_4').val(data.sp_wt_st_4);
						$('#sp_wt_st_5').val(data.sp_wt_st_5);
						$('#sp_wt_st_6').val(data.sp_wt_st_6);
						$('#sp_wt_st_7').val(data.sp_wt_st_7);
						$('#sp_wt_st_8').val(data.sp_wt_st_8);
						$('#sp_wt_st_9').val(data.sp_wt_st_9);
						$('#sp_w_s_4').val(data.sp_w_s_4);
						$('#sp_w_s_5').val(data.sp_w_s_5);
						$('#sp_w_s_6').val(data.sp_w_s_6);
						$('#sp_w_s_7').val(data.sp_w_s_7);
						$('#sp_w_s_8').val(data.sp_w_s_8);
						$('#sp_w_s_9').val(data.sp_w_s_9);
						$('#sp_w_sur_4').val(data.sp_w_sur_4);
						$('#sp_w_sur_5').val(data.sp_w_sur_5);
						$('#sp_w_sur_6').val(data.sp_w_sur_6);
						$('#sp_w_sur_7').val(data.sp_w_sur_7);
						$('#sp_w_sur_8').val(data.sp_w_sur_8);
						$('#sp_w_sur_9').val(data.sp_w_sur_9);
						$('#sp_agg4').val(data.sp_agg4);
						$('#sp_agg5').val(data.sp_agg5);
						$('#sp_agg6').val(data.sp_agg6);
						$('#sp_agg7').val(data.sp_agg7);
						$('#sp_agg8').val(data.sp_agg8);
						$('#sp_agg9').val(data.sp_agg9);
						$('#sp_wat4').val(data.sp_wat4);
						$('#sp_wat5').val(data.sp_wat5);
						$('#sp_wat6').val(data.sp_wat6);
						$('#sp_wat7').val(data.sp_wat7);
						$('#sp_wat8').val(data.sp_wat8);
						$('#sp_wat9').val(data.sp_wat9);
						$('#sp_specific_gravity_4').val(data.sp_specific_gravity_4);
						$('#sp_specific_gravity_5').val(data.sp_specific_gravity_5);
						$('#sp_specific_gravity_6').val(data.sp_specific_gravity_6);
						$('#sp_specific_gravity_7').val(data.sp_specific_gravity_7);
						$('#sp_specific_gravity_8').val(data.sp_specific_gravity_8);
						$('#sp_specific_gravity_9').val(data.sp_specific_gravity_9);
						$('#sp_water_abr_4').val(data.sp_water_abr_4);
						$('#sp_water_abr_5').val(data.sp_water_abr_5);
						$('#sp_water_abr_6').val(data.sp_water_abr_6);
						$('#sp_water_abr_7').val(data.sp_water_abr_7);
						$('#sp_water_abr_8').val(data.sp_water_abr_8);
						$('#sp_water_abr_9').val(data.sp_water_abr_9);
						$('#sp_sg_avg_2').val(data.sp_sg_avg_2);
						$('#sp_sg_avg_3').val(data.sp_sg_avg_3);
						$('#sp_wa_avg_2').val(data.sp_wa_avg_2);
						$('#sp_wa_avg_3').val(data.sp_wa_avg_3);
						$('#sp_porosity_1').val(data.sp_porosity_1);
						$('#sp_porosity_2').val(data.sp_porosity_2);
						$('#sp_porosity_3').val(data.sp_porosity_3);
						$('#sp_temp').val(data.sp_temp);

						break;
					} else {

					}

				}

				//SPECIFIC GRAVITY
				// for (var i = 0; i < aa.length; i++) {
					// if (aa[i] == "spg") {
						// var chk_spg = data.chk_spg;
						// if (chk_spg == "1") {
							// $('#txtspg').css("background-color", "var(--success)");
							// $("#chk_spg").prop("checked", true);
						// } else {
							// $('#txtspg').css("background-color", "white");
							// $("#chk_spg").prop("checked", false);
						// }

						// $('#avg_spg').val(data.avg_spg);
						// break;
					// } else {

					// }
				// }

				
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
</script>