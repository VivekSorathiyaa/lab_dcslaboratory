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
	/* $tank_no= $row_select4['tanker_no'];
					$lot_no= $row_select4['lot_no'];
					$bitumin_grade= $row_select4['bitumin_grade'];
					$bitumin_make= $row_select4['bitumin_make']; */
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
						<h2 style="text-align:center;">CONSTRUCTION WATER TEST</h2>
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
							<div class="col-lg-7">
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
							<!--div class="col-lg-5">
									<div class="form-group">
									 <div class="col-sm-4">
													<label>TEMPERATURE :-</label>
												</div>
										<div class="col-sm-8">
											<input type="text" class="form-control inputs" tabindex="4" id="temp" name="temp">
										</div>
									</div>
								</div-->

						</div><br>


						<br>
						<!-- LAB NO PUT VAIBHAV-->
						<div class="row">

						</div>
						<br>
						<!-- LAB NO PUT VAIBHAV-->
						<div class="row">

							<div class="col-lg-6">
								<div class="form-group">
									<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
									<div class="col-sm-10">
										<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" ReadOnly>
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
										$querys_job1 = "SELECT * FROM water_test WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
									<?php
									$val =  $_SESSION['isadmin'];
									if ($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type'] == "direct_nabl" || $_SESSION['nabl_type'] == "direct_non_nabl") {
									?>
										<div class="col-sm-2">
											<a target='_blank' href="<?php echo $base_url; ?>print_report/report_water_test.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>

									<?php } ?>
									<!--div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/back_water_test.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
											
										</div-->
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
																<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>&&lab_no=<?php echo $lab_no; ?>">Row Data</a>
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

									if ($r1['test_code'] == "phv") {

										$test_check .= "phv,";
								?>
										<div class="panel panel-default" id="phv">
											<div class="panel-heading" id="txtphv">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
														<h4 class="panel-title">
															<b>PH TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse5" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-12">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_phv">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_phv" id="chk_phv" value="chk_phv"><br>
																</div>
																<label for="inputEmail3" class="col-sm-11 control-label label-right">PH TEST</label>
															</div>
														</div>
													</div>
													<br>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">OBSERVED VALUE</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="p1" name="p1">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="p2" name="p2">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="p3" name="p3">
																</div>
															</div>

														</div>

													</div>

													<br>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">

															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">RESULTS</label-->
															</div>
														</div>
														<!--div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="control-label" style="text-align:center;">WIDTH (mm)</label>
									</div>
								</div-->

													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label" style="text-align:left;">AVERAGE PH VALUE</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="phv_res1" name="phv_res1">
																</div>
															</div>

														</div>
													</div>
													<br>

												</div>



												<br>




											</div>



										</div>


								<?php }
								} ?>

								<?php
								$test_check;
								$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								while ($r1 = mysqli_fetch_array($result_select1)) {

									if ($r1['test_code'] == "WAC") {

										$test_check .= "WAC,";
								?>
										<div class="panel panel-default" id="wac">
											<div class="panel-heading" id="txtwac">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
														<h4 class="panel-title">
															<b>ACIDITY TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse6" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-12">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_wac">2.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_wac" id="chk_wac" value="chk_wac"><br>
																</div>
																<label for="inputEmail3" class="col-sm-11 control-label label-right">ACIDITY TEST</label>
															</div>
														</div>
														<!--div class="col-lg-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature :</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="wac_temp" name="wac_temp" >
											</div>
									</div>
								</div-->
														<!--div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CASTING DATE</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="caste_date1" name="caste_date1" >
											</div>
										</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label label-right">TESTING DATE :</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="test_date1" name="test_date1" >
											</div>
									</div>
								</div-->
													</div>

													<br>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label"></label>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">

															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">LENGTH (mm)</label-->
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">WIDTH (mm)</label-->
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label" style="text-align:center;">Test Result</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="wac_res1" name="wac_res1">
																</div>
															</div>

														</div>
													</div>
													<br>

												</div>



												<br>




											</div>



										</div>


								<?php }
								} ?>

								<?php
								$test_check;
								$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								while ($r1 = mysqli_fetch_array($result_select1)) {

									if ($r1['test_code'] == "WAL") {

										$test_check .= "WAL,";
								?>
										<div class="panel panel-default" id="wal">
											<div class="panel-heading" id="txtwal">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
														<h4 class="panel-title">
															<b>ALKALINITY TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse7" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-12">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_wal">3.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_wal" id="chk_wal" value="chk_wal"><br>
																</div>
																<label for="inputEmail3" class="col-sm-11 control-label label-right">ALKALINITY TEST</label>
															</div>
														</div>
													</div>

													<br>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label"></label>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">

															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">LENGTH (mm)</label-->
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">WIDTH (mm)</label-->
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label" style="text-align:center;">Test Result</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="wal_res1" name="wal_res1">
																</div>
															</div>

														</div>
													</div>
													<br>

												</div>



												<br>




											</div>



										</div>


								<?php }
								} ?>

								<?php
								$test_check;
								$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								while ($r1 = mysqli_fetch_array($result_select1)) {

									if ($r1['test_code'] == "chl") {

										$test_check .= "chl,";
								?>
										<div class="panel panel-default" id="chl">
											<div class="panel-heading" id="txtchl">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
														<h4 class="panel-title">
															<b>CHLORIDE TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse8" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-12">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_chl">4.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_chl" id="chk_chl" value="chk_chl"><br>
																</div>
																<label for="inputEmail3" class="col-sm-11 control-label label-right">CHLORIDE TEST</label>
															</div>
														</div>
													</div>

													<br>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label"></label>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">

															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">LENGTH (mm)</label-->
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">WIDTH (mm)</label-->
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label" style="text-align:center;">Test Result</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="chl_res1" name="chl_res1">
																</div>
															</div>

														</div>
													</div>
													<br>

												</div>



												<br>




											</div>



										</div>


								<?php }
								} ?>

								<?php
								$test_check;
								$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								while ($r1 = mysqli_fetch_array($result_select1)) {

									if ($r1['test_code'] == "sul") {

										$test_check .= "sul,";
								?>
										<div class="panel panel-default" id="sul">
											<div class="panel-heading" id="txtsul">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
														<h4 class="panel-title">
															<b>SULPHATE TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse9" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-12">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_sul">5.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_sul" id="chk_sul" value="chk_sul"><br>
																</div>
																<label for="inputEmail3" class="col-sm-11 control-label label-right">SULPHATE TEST</label>
															</div>
														</div>
													</div>

													<br>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label"></label>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">

															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">LENGTH (mm)</label-->
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">WIDTH (mm)</label-->
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label" style="text-align:center;">Test Result</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="sul_res1" name="sul_res1">
																</div>
															</div>

														</div>
													</div>
													<br>

												</div>



												<br>




											</div>



										</div>


								<?php }
								} ?>

								<?php
								$test_check;
								$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								while ($r1 = mysqli_fetch_array($result_select1)) {

									if ($r1['test_code'] == "WOS") {

										$test_check .= "WOS,";
								?>
										<div class="panel panel-default" id="wos">
											<div class="panel-heading" id="txtwos">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
														<h4 class="panel-title">
															<b>ORGANIC SOLID TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse10" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-12">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_wos">6.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_wos" id="chk_wos" value="chk_wos"><br>
																</div>
																<label for="inputEmail3" class="col-sm-11 control-label label-right">ORGANIC SOLID TEST</label>
															</div>
														</div>
													</div>

													<br>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label"></label>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">

															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">LENGTH (mm)</label-->
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">WIDTH (mm)</label-->
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label" style="text-align:center;">Test Results</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="wos_res1" name="wos_res1">
																</div>
															</div>

														</div>
													</div>
													<br>

												</div>



												<br>




											</div>



										</div>


								<?php }
								} ?>

								<?php
								$test_check;
								$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								while ($r1 = mysqli_fetch_array($result_select1)) {

									if ($r1['test_code'] == "WIS") {

										$test_check .= "WIS,";
								?>
										<div class="panel panel-default" id="wis">
											<div class="panel-heading" id="txtwis">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse11">
														<h4 class="panel-title">
															<b>INORGANIC SOLID TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse11" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-12">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_wis">7.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_wis" id="chk_wis" value="chk_wis"><br>
																</div>
																<label for="inputEmail3" class="col-sm-11 control-label label-right">INORGANIC SOLID TEST</label>
															</div>
														</div>
													</div>

													<br>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label"></label>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">

															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">LENGTH (mm)</label-->
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">WIDTH (mm)</label-->
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label" style="text-align:center;">Test Results</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="wis_res1" name="wis_res1">
																</div>
															</div>

														</div>
													</div>
													<br>

												</div>



												<br>




											</div>



										</div>


								<?php }
								} ?>


								<?php
								$test_check;
								$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								while ($r1 = mysqli_fetch_array($result_select1)) {

									if ($r1['test_code'] == "TSS") {

										$test_check .= "TSS,";
								?>
										<div class="panel panel-default" id="tss">
											<div class="panel-heading" id="txttss">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse12">
														<h4 class="panel-title">
															<b>TOTAL DISSOLVED SILIDS TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse12" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-12">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_tss">8.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_tss" id="chk_tss" value="chk_tss"><br>
																</div>
																<label for="inputEmail3" class="col-sm-11 control-label label-right">TOTAL DISSOLVED SILIDS TEST</label>
															</div>
														</div>
													</div>

													<br>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label"></label>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-2">
															<div class="form-group">

															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">LENGTH (mm)</label-->
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<!--label for="inputEmail3" class="control-label" style="text-align:center;">WIDTH (mm)</label-->
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label" style="text-align:center;">Test Results</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="tss_res1" name="tss_res1">
																</div>
															</div>

														</div>
													</div>
													<br>

												</div>



												<br>




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
												$query = "select * from water_test WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	$(document).ready(function() {
		$('#btn_edit_data').hide();
		$('#alert').hide();

		/* $('#caste_date1,#caste_date2,#caste_date3,#test_date1,#test_date2,#test_date3').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
	});
	 */



		$('#chk_phv').change(function() {
			if (this.checked) {
				$('#txtphv').css("background-color", "var(--success)");
			} else {
				$('#txtphv').css("background-color", "white");
			}

		});
		$('#chk_wac').change(function() {
			if (this.checked) {
				$('#txtwac').css("background-color", "var(--success)");
			} else {
				$('#txtwac').css("background-color", "white");
			}

		});
		$('#chk_wal').change(function() {
			if (this.checked) {
				$('#txtwal').css("background-color", "var(--success)");
			} else {
				$('#txtwal').css("background-color", "white");
			}

		});
		$('#chk_chl').change(function() {
			if (this.checked) {
				$('#txtchl').css("background-color", "var(--success)");
			} else {
				$('#txtchl').css("background-color", "white");
			}

		});

		$('#chk_sul').change(function() {
			if (this.checked) {
				$('#txtsul').css("background-color", "var(--success)");
			} else {
				$('#txtsul').css("background-color", "white");
			}

		});

		$('#chk_wos').change(function() {
			if (this.checked) {
				$('#txtwos').css("background-color", "var(--success)");
			} else {
				$('#txtwos').css("background-color", "white");
			}

		});
		$('#chk_wis').change(function() {
			if (this.checked) {
				$('#txtwis').css("background-color", "var(--success)");
			} else {
				$('#txtwis').css("background-color", "white");
			}

		});
		$('#chk_tss').change(function() {
			if (this.checked) {
				$('#txttss').css("background-color", "var(--success)");
			} else {
				$('#txttss').css("background-color", "white");
			}

		});


		/* var global_temp = randomNumberFromRange(26.0,28.5).toFixed(1);
	var pen_temp;
	var pen_1;
	var pen_2;
	var pen_3;
	var avg_pen;	
	
	function pen_auto()
	{
		var pen_temp = global_temp;	
			$('#pen_temp').val(pen_temp);
			var grades = $('#bitumin_grade').val();
			if(grades=="vg-10")
			{
				var avgpen = randomNumberFromRange(84.00,95.00).toFixed();
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();
				
				var pen_3 = (+avg_pen)+ 2;
				var pen_2 = (+avg_pen) ;
				var pen_1 = (+avg_pen)- 2 ; 
				
									
				
			}
			else if(grades=="vg-20")
			{
				var avgpen = randomNumberFromRange(65.00,75.00).toFixed();
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();
				
				var pen_3 = (+avg_pen)+ 2;
				var pen_2 = (+avg_pen) ;
				var pen_1 = (+avg_pen) - 2; 
				
			}
			else if(grades=="vg-30")
			{
				var avgpen = randomNumberFromRange(48.00,53.00).toFixed();
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();				
				
				
				var pen_3 = (+avg_pen) - 2;
				var pen_2 = (+avg_pen) ;
				var pen_1 = (+avg_pen)  + 2; 
				
			}
			else if(grades=="vg-40")
			{
				var avgpen = randomNumberFromRange(38.00,42.00).toFixed(); 
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();
				
				var pen_3 = (+avg_pen) + 1;
				var pen_2 = (+avg_pen) - 1;
				var pen_1 = (+avg_pen); 
				
			}
			
			$('#pen_1').val(pen_1.toFixed());
			$('#pen_2').val(pen_2.toFixed());
			$('#pen_3').val(pen_3.toFixed());
			
			
			
										
			
			$('#pen_temp').val(pen_temp.toString().substring(0, pen_temp.toString().indexOf(".") + 2));
			
			
	}
	
	$('#chk_pen').change(function(){
        if(this.checked)
		{  
			pen_auto();
			
		}
		else
		{
			$('#avg_pen').val(null);
			$('#pen_1').val(null);
			$('#pen_2').val(null);
			$('#pen_3').val(null);
			$('#pen_temp').val(null);
			
			
		}
	});
	
	$('#avg_pen').change(function(){
		if ($("#chk_pen").is(':checked')) {
        var grades = $('#bitumin_grade').val();
			if(grades=="vg-10")
			{
				var avg_pen = $('#avg_pen').val();
				
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var pen_3 = parseInt(avg_pen) - 2;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 2; 
				}
				else{
				var pen_3 = parseInt(avg_pen);
				var pen_2 = parseInt(avg_pen) + 2;
				var pen_1 = parseInt(avg_pen) - 2; 
				}
									
				
			}
			else if(grades=="vg-20")
			{
				var avg_pen = $('#avg_pen').val();
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var pen_3 = parseInt(avg_pen) - 2;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 2; 
				}
				else{
				var pen_3 = parseInt(avg_pen);
				var pen_2 = parseInt(avg_pen) + 2;
				var pen_1 = parseInt(avg_pen) - 2; 
				}
			}
			else if(grades=="vg-30")
			{
				var avg_pen = $('#avg_pen').val(); 
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var pen_3 = parseInt(avg_pen) - 2;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 2; 
				}
				else{
				var pen_3 = parseInt(avg_pen);
				var pen_2 = parseInt(avg_pen) + 2;
				var pen_1 = parseInt(avg_pen) - 2; 
				}
			}
			else if(grades=="vg-40")
			{
				var avg_pen = $('#avg_pen').val();
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{
					
				var pen_3 = parseInt(avg_pen) - 1;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 1; 
				}
				else{
				var pen_3 = parseInt(avg_pen) + 1;
				var pen_2 = parseInt(avg_pen) - 1;
				var pen_1 = parseInt(avg_pen); 
				}
			}
			$('#pen_1').val(pen_1.toFixed());
			$('#pen_2').val(pen_2.toFixed());
			$('#pen_3').val(pen_3.toFixed());
			
		}
		else
		{
			$('#txtpen').css("background-color","var(--success)");	
		}
			
	});
	 */


		$('#chk_auto').change(function() {
			if (this.checked) {
				//$('#txtabr').css("background-color","var(--success)"); 
				//$('#txtwtr').css("background-color","var(--success)"); 


				var temp = $('#test_list').val();
				var temp = $('#temp').val();
				var aa = temp.split(",");
				//phv
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "phv") {
						$('#txtphv').css("background-color", "var(--success)");
						$("#chk_phv").prop("checked", true);
						chk_auto();
						break;
					}
				}
				//wac
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "WAC") {
						$('#txtwac').css("background-color", "var(--success)");
						$("#chk_wac").prop("checked", true);
						chk_auto();
						break;
					}
				}
				//WAL
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "WAL") {
						$('#txtwal').css("background-color", "var(--success)");
						$("#chk_wal").prop("checked", true);
						chk_auto();
						break;
					}
				}
				//chl
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "chl") {
						$('#txtchl').css("background-color", "var(--success)");
						$("#chk_chl").prop("checked", true);
						chk_auto();
						break;
					}
				}
				//sul
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sul") {
						$('#txtsul').css("background-color", "var(--success)");
						$("#chk_sul").prop("checked", true);
						chk_auto();
						break;
					}
				}
				//WOS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "WOS") {
						$('#txtwos').css("background-color", "var(--success)");
						$("#chk_wos").prop("checked", true);
						chk_auto();
						break;
					}
				}
				//WIS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "WIS") {
						$('#txtwis').css("background-color", "var(--success)");
						$("#chk_wis").prop("checked", true);
						chk_auto();
						break;
					}
				}

				//TSS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "TSS") {
						$('#txttss').css("background-color", "var(--success)");
						$("#chk_tss").prop("checked", true);
						chk_auto();
						break;
					}
				}




			}

		});

		function phv_auto() {
			var phv_res1 = randomNumberFromRange(6.75, 8.23).toFixed(2);
			$('#phv_res1').val(phv_res1);
			var phv_res1 = $('#phv_res1').val();

			var i = randomNumberFromRange(-99, 99).toFixed();
			if (i % 2 == 0) {
				if (i < 99) {
					var p1 = (+phv_res1) + (+0.37);
					var p2 = (+phv_res1) - (+0.49);
					var p3 = (+phv_res1) + (+0.12);
				} else {
					var p1 = (+phv_res1) - (+0.37);
					var p2 = (+phv_res1) + (+0.49);
					var p3 = (+phv_res1) - (+0.12);
				}
			} else {
				if (i < 99) {
					var p1 = (+phv_res1) - (+0.24);
					var p2 = (+phv_res1) - (+0.17);
					var p3 = (+phv_res1) + (+0.41);
				} else {
					var p1 = (+phv_res1) + (+0.24);
					var p2 = (+phv_res1) + (+0.17);
					var p3 = (+phv_res1) - (+0.41);
				}
			}
			$('#p1').val(p1.toFixed(2));
			$('#p2').val(p2.toFixed(2));
			$('#p3').val(p3.toFixed(2));

		}

		$('#chk_phv').change(function() {
			if (this.checked) {
				phv_auto();
			} else {
				$('#phv_res1').val(null);
				$('#p1').val(null);
				$('#p2').val(null);
				$('#p3').val(null);
				$('#wac_res1').val(80);
				$('#wal_res1').val(80);
				$('#chl_res1').val(80);
				$('#sul_res1').val(80);
				$('#wos_res1').val(80);
				$('#wis_res1').val(80);
				$('#tss_res1').val(80);

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
			url: '<?php echo $base_url; ?>save_water_test.php',
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
			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//phv
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "phv") {
					if (document.getElementById('chk_phv').checked) {
						var chk_phv = "1";
					} else {
						var chk_phv = "0";
					}
					var p1 = $('#p1').val();
					var p2 = $('#p2').val();
					var p3 = $('#p3').val();
					var phv_res1 = $('#phv_res1').val();


					break;
				} else {
					var phv_res1 = "0";
					var p1 = "0";
					var p2 = "0";
					var p3 = "0";
					//var phv_res2  =  "0";

				}

			}

			//wac
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WAC") {
					if (document.getElementById('chk_wac').checked) {
						var chk_wac = "1";
					} else {
						var chk_wac = "0";
					}
					var wac_res1 = $('#wac_res1').val();
					//var wac_res2 = $('#wac_res2').val();													


					break;
				} else {
					var wac_res1 = "0";
					//var wac_res2  =  "0";

				}

			}

			//WAL
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WAL") {
					if (document.getElementById('chk_wal').checked) {
						var chk_wal = "1";
					} else {
						var chk_wal = "0";
					}
					var wal_res1 = $('#wal_res1').val();
					//var wal_res2 = $('#wal_res2').val();													


					break;
				} else {
					var wal_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//chl
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "chl") {
					if (document.getElementById('chk_chl').checked) {
						var chk_chl = "1";
					} else {
						var chk_chl = "0";
					}
					var chl_res1 = $('#chl_res1').val();
					//var chl_res2 = $('#chl_res2').val();													


					break;
				} else {
					var chl_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//sul
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sul") {
					if (document.getElementById('chk_sul').checked) {
						var chk_sul = "1";
					} else {
						var chk_sul = "0";
					}
					var sul_res1 = $('#sul_res1').val();
					//var sul_res2 = $('#sul_res2').val();													


					break;
				} else {
					var sul_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//WOS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WOS") {
					if (document.getElementById('chk_wos').checked) {
						var chk_wos = "1";
					} else {
						var chk_wos = "0";
					}
					var wos_res1 = $('#wos_res1').val();
					//var wos_res2 = $('#wos_res2').val();													


					break;
				} else {
					var wos_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//WIS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WIS") {
					if (document.getElementById('chk_wis').checked) {
						var chk_wis = "1";
					} else {
						var chk_wis = "0";
					}
					var wis_res1 = $('#wis_res1').val();
					//var wis_res2 = $('#wis_res2').val();													


					break;
				} else {
					var wis_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//WOS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WOS") {
					if (document.getElementById('chk_wos').checked) {
						var chk_wos = "1";
					} else {
						var chk_wos = "0";
					}
					var wos_res1 = $('#wos_res1').val();
					//var wos_res2 = $('#wos_res2').val();													


					break;
				} else {
					var wos_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//TSS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "TSS") {
					if (document.getElementById('chk_tss').checked) {
						var chk_tss = "1";
					} else {
						var chk_tss = "0";
					}
					var tss_res1 = $('#tss_res1').val();
					//var tss_res2 = $('#tss_res2').val();													


					break;
				} else {
					var tss_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}






			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_phv=' + chk_phv + '&chk_wac=' + chk_wac + '&chk_wal=' + chk_wal + '&chk_chl=' + chk_chl + '&chk_sul=' + chk_sul + '&chk_wos=' + chk_wos + '&chk_wis=' + chk_wis + '&chk_tss=' + chk_tss + '&p1=' + p1 + '&p2=' + p2 + '&p3=' + p3 + '&phv_res1=' + phv_res1 + '&wac_res1=' + wac_res1 + '&wal_res1=' + wal_res1 + '&chl_res1=' + chl_res1 + '&sul_res1=' + sul_res1 + '&wos_res1=' + wos_res1 + '&wis_res1=' + wis_res1 + '&tss_res1=' + tss_res1 + '&ulr=' + ulr;

		} else if (type == 'edit') {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();

			var temp = $('#test_list').val();
			var room_temp = $('#room_temp').val();
			var aa = temp.split(",");

			//phv
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "phv") {
					if (document.getElementById('chk_phv').checked) {
						var chk_phv = "1";
					} else {
						var chk_phv = "0";
					}
					var p1 = $('#p1').val();
					var p2 = $('#p2').val();
					var p3 = $('#p3').val();
					var phv_res1 = $('#phv_res1').val();


					break;
				} else {
					var phv_res1 = "0";
					var p1 = "0";
					var p2 = "0";
					var p3 = "0";
					//var phv_res2  =  "0";

				}

			}

			//wac
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WAC") {
					if (document.getElementById('chk_wac').checked) {
						var chk_wac = "1";
					} else {
						var chk_wac = "0";
					}
					var wac_res1 = $('#wac_res1').val();
					//var wac_res2 = $('#wac_res2').val();													


					break;
				} else {
					var wac_res1 = "0";
					//var wac_res2  =  "0";

				}

			}

			//WAL
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WAL") {
					if (document.getElementById('chk_wal').checked) {
						var chk_wal = "1";
					} else {
						var chk_wal = "0";
					}
					var wal_res1 = $('#wal_res1').val();
					//var wal_res2 = $('#wal_res2').val();													


					break;
				} else {
					var wal_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//chl
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "chl") {
					if (document.getElementById('chk_chl').checked) {
						var chk_chl = "1";
					} else {
						var chk_chl = "0";
					}
					var chl_res1 = $('#chl_res1').val();
					//var chl_res2 = $('#chl_res2').val();													


					break;
				} else {
					var chl_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//sul
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sul") {
					if (document.getElementById('chk_sul').checked) {
						var chk_sul = "1";
					} else {
						var chk_sul = "0";
					}
					var sul_res1 = $('#sul_res1').val();
					//var sul_res2 = $('#sul_res2').val();													


					break;
				} else {
					var sul_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//WOS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WOS") {
					if (document.getElementById('chk_wos').checked) {
						var chk_wos = "1";
					} else {
						var chk_wos = "0";
					}
					var wos_res1 = $('#wos_res1').val();
					//var wos_res2 = $('#wos_res2').val();													


					break;
				} else {
					var wos_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//WIS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WIS") {
					if (document.getElementById('chk_wis').checked) {
						var chk_wis = "1";
					} else {
						var chk_wis = "0";
					}
					var wis_res1 = $('#wis_res1').val();
					//var wis_res2 = $('#wis_res2').val();													


					break;
				} else {
					var wis_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//WOS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WOS") {
					if (document.getElementById('chk_wos').checked) {
						var chk_wos = "1";
					} else {
						var chk_wos = "0";
					}
					var wos_res1 = $('#wos_res1').val();
					//var wos_res2 = $('#wos_res2').val();													


					break;
				} else {
					var wos_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}

			//TSS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "TSS") {
					if (document.getElementById('chk_tss').checked) {
						var chk_tss = "1";
					} else {
						var chk_tss = "0";
					}
					var tss_res1 = $('#tss_res1').val();
					//var tss_res2 = $('#tss_res2').val();													


					break;
				} else {
					var tss_res1 = "0";
					//ar wal_res2  =  "0";

				}

			}



			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&p1=' + p1 + '&p2=' + p2 + '&p3=' + p3 + '&phv_res1=' + phv_res1 + '&wac_res1=' + wac_res1 + '&wal_res1=' + wal_res1 + '&chl_res1=' + chl_res1 + '&sul_res1=' + sul_res1 + '&wos_res1=' + wos_res1 + '&wis_res1=' + wis_res1 + '&tss_res1=' + tss_res1 + '&ulr=' + ulr;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_water_test.php',
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
			url: '<?php echo $base_url; ?>save_water_test.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);
				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);
				$('#ulr').val(data.ulr);

				var temp = $('#test_list').val();
				var room_temp = $('#room_temp').val();
				var aa = temp.split(",");
				//phv
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "phv") {

						var chk_phv = data.chk_phv;
						if (chk_phv == "1") {
							$('#txtphv').css("background-color", "var(--success)");
							$("#chk_phv").prop("checked", true);



						} else {
							$('#txtphv').css("background-color", "var(--success)");
							$("#chk_phv").prop("checked", false);

						}
						$('#phv_res1').val(data.phv_res1);
						$('#p1').val(data.p1);
						$('#p2').val(data.p2);
						$('#p3').val(data.p3);
						break;
					} else {

					}

				}

				//WAT
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "WAC") {

						var chk_wac = data.chk_wac;
						if (chk_wac == "1") {
							$('#txtwac').css("background-color", "var(--success)");
							$("#chk_wac").prop("checked", true);



						} else {
							$('#txtwac').css("background-color", "var(--success)");
							$("#chk_wac").prop("checked", false);

						}
						$('#wac_res1').val(data.wac_res1);
						break;
					} else {

					}

				}

				//WAL
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "WAL") {

						var chk_wal = data.chk_wal;
						if (chk_wal == "1") {
							$('#txtwal').css("background-color", "var(--success)");
							$("#chk_wal").prop("checked", true);



						} else {
							$('#txtwal').css("background-color", "var(--success)");
							$("#chk_wal").prop("checked", false);

						}

						$('#wal_res1').val(data.wal_res1);

						break;
					} else {

					}

				}

				//chl
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "chl") {

						var chk_chl = data.chk_chl;
						if (chk_chl == "1") {
							$('#txtchl').css("background-color", "var(--success)");
							$("#chk_chl").prop("checked", true);



						} else {
							$('#txtchl').css("background-color", "var(--success)");
							$("#chk_chl").prop("checked", false);

						}

						$('#chl_res1').val(data.chl_res1);

						break;
					} else {

					}

				}

				//sul
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sul") {

						var chk_sul = data.chk_sul;
						if (chk_sul == "1") {
							$('#txtsul').css("background-color", "var(--success)");
							$("#chk_sul").prop("checked", true);



						} else {
							$('#txtsul').css("background-color", "var(--success)");
							$("#chk_sul").prop("checked", false);

						}

						$('#sul_res1').val(data.sul_res1);

						break;
					} else {

					}

				}

				//WOS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "WOS") {

						var chk_wos = data.chk_wos;
						if (chk_wos == "1") {
							$('#txtwos').css("background-color", "var(--success)");
							$("#chk_wos").prop("checked", true);



						} else {
							$('#txtwos').css("background-color", "var(--success)");
							$("#chk_wos").prop("checked", false);

						}

						$('#wos_res1').val(data.wos_res1);

						break;
					} else {

					}

				}

				//WIS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "WIS") {

						var chk_wis = data.chk_wis;
						if (chk_wis == "1") {
							$('#txtwis').css("background-color", "var(--success)");
							$("#chk_wis").prop("checked", true);



						} else {
							$('#txtwis').css("background-color", "var(--success)");
							$("#chk_wis").prop("checked", false);

						}

						$('#wis_res1').val(data.wis_res1);

						break;
					} else {

					}

				}

				//TSS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "TSS") {

						var chk_tss = data.chk_tss;
						if (chk_tss == "1") {
							$('#txttss').css("background-color", "var(--success)");
							$("#chk_tss").prop("checked", true);



						} else {
							$('#txttss').css("background-color", "var(--success)");
							$("#chk_tss").prop("checked", false);

						}

						$('#tss_res1').val(data.tss_res1);

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
</script>