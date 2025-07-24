<?php
session_start();
include("header.php");
include("connection.php");
error_reporting(0);
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
if (isset($_GET['trf_no'])) {
	$trf_no = $_GET['trf_no'];
}
$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
$result_select4 = mysqli_query($conn, $select_query4);

if (mysqli_num_rows($result_select4) > 0) {
	$row_select4 = mysqli_fetch_array($result_select4);
	$zone = $row_select4['grd_zone'];
}

?>
<!-- STYLE PUT VAIBHAV-->
<div class="content-wrapper" style="margin-left:0px !important;">
	<!-- Content Header (Page header) -->

	<section class="content">
		<!-- MENU INCLUDE VAIBHAV-->
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">FINE AGGREGATE</h2>
					</div>
					<!--<div class="box-default">-->
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

							<div class="col-lg-3">
								<div class="form-group">
									<!-- <label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->


									<div class="col-sm-10">
										<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" ReadOnly>
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
									<div class="col-sm-2">
										<label for="inputEmail3">Sample ID :</label>
									</div>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="sp_sample_ca" name="sp_sample_ca" value="<?php echo $lab_no . "_01" ?>">
									</div>
								</div>
							</div>
						</div>
						<br>



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
								<?php } ?>
								<?php
								$test_check;
								$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
								$result_select1 = mysqli_query($conn, $select_query1);
								while ($r1 = mysqli_fetch_array($result_select1)) {

									if ($r1['test_code'] == "grd") {
										$test_check .= "grd,";
								?>
										<div class="panel panel-default" id="grd">

											<div class="panel-heading" id="txtgrd">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
														<h4 class="panel-title">
															<b>GRADATION OF TESTING</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse1" class="panel-collapse collapse">
												<div class="panel-body">
													<div class="row">

														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_grd">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_grd" id="chk_grd" value="chk_grd"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">GRADATION OF TESTING</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-12 control-label">SAMPLE TAKEN :</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="sample_taken" name="sample_taken">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2"></div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">Sieve Size In MM</label>
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">Retained Wt.in gm</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">Cum. Wt.in gm</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">Cum. % retained</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">% passing of sample</label>
																</div>
															</div>
														</div>
													</div>
													</br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">1.</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">10 (mm)</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_wt_gm_1" name="cum_wt_gm_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="ret_wt_gm_1" name="ret_wt_gm_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_ret_1" name="cum_ret_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="pass_sample_1" name="pass_sample_1">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">2.</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">4.75 (mm)</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_wt_gm_2" name="cum_wt_gm_2">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="ret_wt_gm_2" name="ret_wt_gm_2">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_ret_2" name="cum_ret_2">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="pass_sample_2" name="pass_sample_2">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">3.</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">2.36 (mm)</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_wt_gm_3" name="cum_wt_gm_3">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="ret_wt_gm_3" name="ret_wt_gm_3">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_ret_3" name="cum_ret_3">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="pass_sample_3" name="pass_sample_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">4.</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">1.18 (mm)</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_wt_gm_4" name="cum_wt_gm_4">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="ret_wt_gm_4" name="ret_wt_gm_4">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_ret_4" name="cum_ret_4">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="pass_sample_4" name="pass_sample_4">
																</div>
															</div>
														</div>
													</div>

													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">5.</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">600 mic</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_wt_gm_5" name="cum_wt_gm_5">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="ret_wt_gm_5" name="ret_wt_gm_5">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_ret_5" name="cum_ret_5">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="pass_sample_5" name="pass_sample_5">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">6.</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">300 mic</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_wt_gm_6" name="cum_wt_gm_6">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="ret_wt_gm_6" name="ret_wt_gm_6">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_ret_6" name="cum_ret_6">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="pass_sample_6" name="pass_sample_6">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">7.</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">150 mic</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_wt_gm_7" name="cum_wt_gm_7">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="ret_wt_gm_7" name="ret_wt_gm_7">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_ret_7" name="cum_ret_7">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="pass_sample_7" name="pass_sample_7">
																</div>
															</div>
														</div>
													</div>

													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">8.</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-2 control-label">0.075</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_wt_gm_8" name="cum_wt_gm_8">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="ret_wt_gm_8" name="ret_wt_gm_8">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cum_ret_8" name="cum_ret_8">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="pass_sample_8" name="pass_sample_8">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">

														</div>
														<div class="col-lg-2">

														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="blank_extra" name="blank_extra">
																</div>
															</div>
														</div>


														<div class="col-lg-3">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:right">Selected Zone</label>
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="col-sm-6">
																<select class="form-control" id="grd_zone" name="grd_zone">
																	<option value="Zone II" <?php if ($zone == "Zone II") {
																								echo "selected";
																							} ?>>Zone II</option>
																	<option value="Zone I" <?php if ($zone == "Zone I") {
																								echo "selected";
																							} ?>>Zone I</option>
																	<option value="Zone III" <?php if ($zone == "Zone III") {
																									echo "selected";
																								} ?>>Zone III</option>
																	<option value="Zone IV" <?php if ($zone == "Zone IV") {
																								echo "selected";
																							} ?>>Zone IV</option>
																</select>
															</div>
														</div>
													</div>
													<br>

													<div class="row">
														<div class="col-lg-8">
															<div class="form-group">

																<div class="col-sm-8">

																	<input type="checkbox" class="visually-hidden" name="chk_fm" id="chk_fm" value="chk_fm"><br>
																</div>
															</div>
														</div>

														<div class="col-lg-4">

															<div class="form-group">
																<div class="col-sm-6">
																	<label for="inputEmail3" class="col-sm-6 control-label">FINENESS MODULUS</label>
																</div>
																<div class="col-sm-6">
																	<input type="text" class="form-control" id="grd_fm" name="grd_fm">
																</div>
															</div>


														</div>

													</div>
													<div class="row">
														<div class="col-lg-12">
															<hr>
														</div>
													</div>

													<br>
													<div class="row">
														<div class="col-lg-8">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-4 control-label label-right">SILT CONTENT</label>
																<div class="col-sm-8">

																	<input type="checkbox" class="visually-hidden" name="chk_silt" id="chk_silt" value="chk_silt"><br>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-3">
															<div class="col-md-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label">Weight of Oven Dry Sample (B) gm</label>
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="silt_1" name="silt_1">
																	</div>
																</div>
															</div>

														</div>
														<div class="col-md-3">
															<div class="col-md-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label">Retain On 75 Micron Sieve (C) gm</label>
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="silt_2" name="silt_2">
																	</div>
																</div>
															</div>

														</div>
														<div class="col-md-3">
															<div class="col-md-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label">Silt Content</label>
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="silt_content" name="silt_content">
																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>
											</div>
										</div>

										<br>
									<?php } else if ($r1['test_code'] == "wtr") {
										$test_check .= "wtr,"; ?>
										<div class="panel panel-default" id="wtr">
											<div class="panel panel-default" id="wtr">
												<div class="panel-heading" id="txtwtr">
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
																	<div class="col-sm-1">
																		<label for="chk_sp">2.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_sp" id="chk_sp" value="chk_sp"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">SPECIFIC GRAVITY & WATER ABSORPTION</label>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">Temp. of Water</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control" id="sp_temp" name="sp_temp"><br>
																	</div>
																</div>
															</div>

														</div>
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Sample ID</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Wt. of<br>Saturated<br>Surface Dry<br>(gm)</label>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Wt. of Pycnometer Containing Sample & Filled With Distilled Water, B</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Wt. of Pycnometer Filled With distilled Water only, C (g)</label>
																</div>
															</div>



															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Wt. of<br>Sample Oven<br>Dry (gm)</label>
																</div>
															</div>


															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Specific Gravity Based <br> On Dry Agreegate</label>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Specific Gravity Based <br> on Saturated Surface Dry Agreegate</label>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Specific<br>Gravity</label>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Water Absorption<br>(%)<br></label>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-lg-1"></div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label text-center">A</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label text-center">B</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label text-center">C</label>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label text-center">D</label>
																</div>
															</div>


															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label text-center">D/(A - (B-C))</label>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label text-center">A/(A - (B-C))</label>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label text-center">D/(D-(B-A))</label>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label text-center">100 x (A-D)/D</label>
																</div>
															</div>
														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sam_1" name="sam_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py1_1" name="sp_wt_py1_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py2_1" name="sp_wt_py2_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_st_1" name="sp_wt_st_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_w_s_1" name="sp_w_s_1">
																	</div>
																</div>
															</div>


															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp1_1" name="sp1_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp1_2" name="sp1_2" DISABLED>
																	</div>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_specific_gravity_1" name="sp_specific_gravity_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr_1" name="sp_water_abr_1" DISABLED>
																	</div>
																</div>
															</div>
														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 2-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sam_2" name="sam_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py1_2" name="sp_wt_py1_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py2_2" name="sp_wt_py2_2">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_st_2" name="sp_wt_st_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_w_s_2" name="sp_w_s_2">
																	</div>
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp2_1" name="sp2_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp2_2" name="sp2_2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_specific_gravity_2" name="sp_specific_gravity_2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr_2" name="sp_water_abr_2" DISABLED>
																	</div>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-lg-3">
																<div class="col-sm-12">

																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_specific_gravity" name="sp_specific_gravity" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr" name="sp_water_abr" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_gravity" name="sp_gravity" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_avg" name="sp_avg" DISABLED>
																	</div>
																</div>
															</div>

															<div class="col-lg-4">
																<div class="form-group">

																</div>
															</div>
														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 3-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sam_3" name="sam_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py1_3" name="sp_wt_py1_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py2_3" name="sp_wt_py2_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_st_3" name="sp_wt_st_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_w_s_3" name="sp_w_s_3">
																	</div>
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp3_1" name="sp3_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp3_2" name="sp3_2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_specific_gravity_3" name="sp_specific_gravity_3" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr_3" name="sp_water_abr_3" DISABLED>
																	</div>
																</div>
															</div>
														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 4-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sam_4" name="sam_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py1_4" name="sp_wt_py1_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py2_4" name="sp_wt_py2_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_st_4" name="sp_wt_st_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_w_s_4" name="sp_w_s_4">
																	</div>
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp4_1" name="sp4_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp4_2" name="sp4_2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_specific_gravity_4" name="sp_specific_gravity_4" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr_4" name="sp_water_abr_4" DISABLED>
																	</div>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-lg-3">
																<div class="col-sm-12">

																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
																</div>
															</div>

															<div class="col-sm-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_specific_gravity2_1" name="sp_specific_gravity2_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr1_1" name="sp_water_abr1_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_gravity_1" name="sp_gravity_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_avg_1" name="sp_avg_1" DISABLED>
																	</div>
																</div>
															</div>

															<div class="col-lg-4">
																<div class="form-group">

																</div>
															</div>
														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 5-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sam_5" name="sam_5">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py1_5" name="sp_wt_py1_5">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py2_5" name="sp_wt_py2_5">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_st_5" name="sp_wt_st_5">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_w_s_5" name="sp_w_s_5">
																	</div>
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp5_1" name="sp5_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp5_2" name="sp5_2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_specific_gravity_5" name="sp_specific_gravity_5" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr_5" name="sp_water_abr_5" DISABLED>
																	</div>
																</div>
															</div>
														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 6-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sam_6" name="sam_6">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py1_6" name="sp_wt_py1_6">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_py2_6" name="sp_wt_py2_6">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_wt_st_6" name="sp_wt_st_6">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_w_s_6" name="sp_w_s_6">
																	</div>
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp6_1" name="sp6_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp6_2" name="sp6_2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_specific_gravity_6" name="sp_specific_gravity_6" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr_6" name="sp_water_abr_6" DISABLED>
																	</div>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-lg-3">
																<div class="col-sm-12">

																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_specific_gravity2_2" name="sp_specific_gravity2_2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr2_1" name="sp_water_abr2_1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_gravity_2" name="sp_gravity_2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_avg_2" name="sp_avg_2" DISABLED>
																	</div>
																</div>
															</div>

															<div class="col-lg-4">
																<div class="form-group">

																</div>
															</div>
														</div>
														<br>

														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE OVER-->


													</div>
												</div>
											</div>

											
											<br>
										<?php } else if ($r1['test_code'] == "fne") {
										$test_check .= "fne,"; ?>
											<div class="panel panel-default" id="fne">
												<div class="panel-heading" id="txtfne">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
															<h4 class="panel-title">
																<b>MATERIAL FINER THEN 75 MICRON</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse6" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_finer">3.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_finer" id="chk_finer" value="chk_finer"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">MATERIAL FINER THEN 75 MICRON</label>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group">

																</div>
															</div>

														</div>
														<div class="row">



															<div class="col-lg-12">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Material finer then 75 Micron IS sieve shall be calclated as follows:</label>
																</div>
															</div>



														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">


															<div class="col-lg-4">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label"> A. Original Weight (A)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="finer_a" name="finer_a">
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">


															<div class="col-lg-4">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label"> B. Dry Weight after washing (B)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="finer_b" name="finer_b">
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 2-->
														<div class="row">


															<div class="col-lg-4">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label"> Finer then 75 Micron = A - B / A X 100 =</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="avg_finer" name="avg_finer" DISABLED>
																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>
											</div>
											<br>
										<?php } else if ($r1['test_code'] == "sou") {
										$test_check .= "sou,"; ?>
											<Br>
											<div class="panel panel-default" id="sou">
												<div class="panel-heading" id="txtsou">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
															<h4 class="panel-title">
																<b>SOUNDNESS</b>
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
																		<label for="chk_sou">4.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_sou" id="chk_sou" value="chk_sou"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">SOUNDNESS</label>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Temperature</label>
																</div>
																<div class="form-group">
																	<div class="col-sm-8">
																		<input type="text" class="form-control" id="temp1" name="temp1">
																	</div>
																</div>
															</div>


														</div>
														<Br>
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">SIEVE SIZE</label>
																</div>
															</div>

														</div>
														<Br>
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Passing</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Retained</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Weight of test fractions before test</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">weight of each fraction <br>T1 gm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">weight of each fraction <br>T2 gm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">weight of each fraction <br>T3 gm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">weight of each fraction <br>T4 gm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">weight of each fraction <br>T5 gm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Grading of original sample percent</label>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Percentage passing finer sieve after test (Actual Percentage loss)</label>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Weight average(Corrected Percentage loss)</label>
																</div>
															</div>
														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">10 mm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">4.75 mm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="go7" name="go7">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t1_1" name="t1_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t1_2" name="t1_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t1_3" name="t1_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t1_4" name="t1_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t1_5" name="t1_5">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wt7" name="wt7" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="pp7" name="pp7" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wa7" name="wa7" DISABLED>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">4.75 mm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">2.36 mm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="go6" name="go6">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t2_1" name="t2_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t2_2" name="t2_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t2_3" name="t2_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t2_4" name="t2_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t2_5" name="t2_5">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wt6" name="wt6" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="pp6" name="pp6" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wa6" name="wa6" DISABLED>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">2.36 mm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">1.18 mm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="go5" name="go5">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t3_1" name="t3_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t3_2" name="t3_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t3_3" name="t3_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t3_4" name="t3_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t3_5" name="t3_5">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wt5" name="wt5" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="pp5" name="pp5" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wa5" name="wa5" DISABLED>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">1.18 mm</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">600 mic</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="go4" name="go4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t4_1" name="t4_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t4_2" name="t4_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t4_3" name="t4_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t4_4" name="t4_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t4_5" name="t4_5">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wt4" name="wt4" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="pp4" name="pp4" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wa4" name="wa4" DISABLED>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">600 mic</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">300 mic</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="go3" name="go3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t5_1" name="t5_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t5_2" name="t5_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t5_3" name="t5_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t5_4" name="t5_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t5_5" name="t5_5">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wt3" name="wt3" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="pp3" name="pp3" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wa3" name="wa3" DISABLED>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">300 mic</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">150 mic</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="go2" name="go2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t6_1" name="t6_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t6_2" name="t6_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t6_3" name="t6_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t6_4" name="t6_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t6_5" name="t6_5">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wt2" name="wt2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="pp2" name="pp2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wa2" name="wa2" DISABLED>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">150 mic</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">-</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="go1" name="go1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t7_1" name="t7_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t7_2" name="t7_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t7_3" name="t7_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t7_4" name="t7_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="t7_5" name="t7_5">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wt1" name="wt1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="pp1" name="pp1" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wa1" name="wa1" DISABLED>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-lg-2">
																<div class="form-group">

																</div>
															</div>
															<div class="col-lg-5 text-right">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Total</label>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="total_go" name="total_go" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label">Result : Soundness : =</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="soundness" name="soundness" DISABLED>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<br>
										<?php } else if ($r1['test_code'] == "den") {
										$test_check .= "den,"; ?>
											<div class="panel panel-default" id="den">
												<div class="panel-heading" id="txtden">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse15">
															<h4 class="panel-title">
																<b>RODDED BULK DENSITY</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse15" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_den">5.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_den" id="chk_den" value="chk_den"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">RODDED BULK DENSITY</label>
																</div>
															</div>
															<div class="col-md-4">

															</div>

														</div>
														<br>
														<br>
														<div class="row">
															<div class="col-md-12">
																<div class="col-md-3">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-12 control-label">Particular</label>
																	</div>
																</div>

																<div class="col-md-3">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-12 control-label">(I)</label>
																	</div>
																</div>


																<div class="col-md-3">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-12 control-label">(II)</label>
																	</div>
																</div>

																<div class="col-md-3">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-12 control-label">(III)</label>
																	</div>
																</div>
															</div>



														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-md-12">
																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of Mould + Material in kg</label>
																		</div>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m11" name="m11">
																		</div>
																	</div>
																</div>

																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m12" name="m12">
																		</div>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m13" name="m13">
																		</div>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-md-12">
																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of Mould in kg</label>
																		</div>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m21" name="m21">
																		</div>
																	</div>
																</div>

																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m22" name="m22">
																		</div>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m23" name="m23">
																		</div>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
														<div class="row">
															<div class="col-md-12">
																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-12 control-label">Weight of Material in kg</label>
																		</div>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="wom1" name="wom1">
																		</div>
																	</div>
																</div>

																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="wom2" name="wom2">
																		</div>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="wom3" name="wom3">
																		</div>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<div class="row">


															<div class="col-md-12">
																<div class="col-lg-3">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
																	</div>
																</div>
																<div class="col-sm-9">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="avg_wom" name="avg_wom">
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-12">
																<div class="col-lg-12">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-6 control-label">Sand Confition at that time :- (Oven dry/S.S.D./Moisturized)</label>
																	</div>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-12">
																<div class="col-lg-4">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-6 control-label">Rodded Bulk Density = Weight of Material / Volume of Mould = </label>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<input type="text" class="form-control" id="avg_wom1" name="avg_wom1">
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-6 control-label">/ </label>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<input type="text" class="form-control" id="vol" name="vol">
																	</div>
																</div>
																<div class="col-lg-1">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-6 control-label">= </label>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<input type="text" class="form-control" id="bdl" name="bdl"> Kg/Lit.
																	</div>
																</div>
															</div>




														</div>
													</div>
												</div>
											</div>
										</div>

									<?php
									} else if ($r1['test_code'] == "lbd") {
										$test_check .= "lbd,"; ?>
										<div class="panel panel-default" id="lbd">
											<div class="panel-heading" id="txtlbd">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapselbd">
														<h4 class="panel-title">
															<b>LOOSE BULK DENSITY</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapselbd" class="panel-collapse collapse">
												<div class="panel-body">
													<div class="row">

														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_lbd">5.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_lbd" id="chk_lbd" value="chk_lbd"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">LOOSE BULK DENSITY</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">Sample Taken</label>
															</div>
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="sample_taken1" name="sample_taken1">
																</div>
															</div>
														</div>

													</div>
													<br>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">Particular</label>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">(I)</label>
																</div>
															</div>


															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">(II)</label>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-12 control-label">(III)</label>
																</div>
															</div>
														</div>



													</div>
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label">Volume of Container (M<SUB>1</SUB>)</label>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_m11" name="lbd_m11">
																	</div>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_m12" name="lbd_m12">
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_m13" name="lbd_m13">
																	</div>
																</div>
															</div>
														</div>

													</div>
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label">Container Weight with Sample (M<SUB>2</SUB>)</label>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_m21" name="lbd_m21">
																	</div>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_m22" name="lbd_m22">
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_m23" name="lbd_m23">
																	</div>
																</div>
															</div>
														</div>

													</div>
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label">Container Empty Weight (M<SUB>3</SUB>)</label>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_wom1" name="lbd_wom1">
																	</div>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_wom2" name="lbd_wom2">
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_wom3" name="lbd_wom3">
																	</div>
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">


														<div class="col-md-12">
															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-6 control-label">Weight OF Sample (M<sub>4</sub> = M<sub>2</sub> - M<sub>3</sub>)</label>
																</div>
															</div>
															<div class="col-sm-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_avg_wom" name="lbd_avg_wom" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_vol" name="lbd_vol" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-sm-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="lbd_avg_wom1" name="lbd_avg_wom1" DISABLED>
																	</div>
																</div>
															</div>

														</div>
													</div>
													<br>
													<!-- <div class="row">
									<div class="col-md-12">
									<div class="col-lg-12">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">Sand Confition at that time :- (Oven dry/S.S.D./Moisturized)</label>
									</div>
									</div>															
									</div>
								</div>
								<br> -->

													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-12 control-label">Bulk Density (G = M<sub>4</sub> / M<sub>1</sub>)</label>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="bulk1" name="bulk1" DISABLED>
																	</div>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="bulk2" name="bulk2" DISABLED>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="bulk3" name="bulk3" DISABLED>
																	</div>
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-6 control-label">Average Bulk Density = </label>
																</div>
															</div>

															<div class="col-lg-9">
																<div class="form-group">
																	<input type="text" class="form-control" id="lbd_bdl" name="lbd_bdl" DISABLED>
																</div>
															</div>
														</div>




													</div>
												</div>
											</div>
										</div>
										<br>
									<?php
									} else if ($r1['test_code'] == "dtm") {
										$test_check .= "dtm,"; ?>

										<div class="panel panel-default" id="dtm">
											<div class="panel-heading" id="txtdtm">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_dtm">
														<h4 class="panel-title">
															<b>DELETERIOUS MATERIAL</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse_dtm" class="panel-collapse collapse">
												<div class="panel-body">
													<!--Impact VALUE Start-->
													<br>
													<div class="row">
														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_dtm">8.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_dtm" id="chk_dtm" value="chk_dtm"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">DELETERIOUS MATERIAL</label>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">Deleterious Material </label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">i. % Finer than 75u</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Weight of sample gm (B)</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_1_1" name="dele_1_1" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">After washing through wter, then over dry weight</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_1_2" name="dele_1_2" >
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">Weight of sample gm C</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_1_3" name="dele_1_3" readonly>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-12 control-label">% finer then 75u</label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" id="dele_1_4" name="dele_1_4" readonly>
						</div>
					</div>
				</div>
													<br>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">i. % Clay nd Lumps</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">Wt of Saample gm (W)</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_2_1" name="dele_2_1">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">After broken with finger then passing 2.36mm IS sieve gm (R)</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_2_2" name="dele_2_2">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">% Clay lumps = (W-R)/B*100</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_2_3" name="dele_2_3" readonly>
															</div>
														</div>
													</div>
													<br>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">ii. % Coal And Lignite</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">Wt of sample gm (W1)</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_3_1" name="dele_3_1">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">Introduce in to heavy liquid wt gm (W2)</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_3_2" name="dele_3_2">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">% Coal & Lignite = (W1-W2)/W1*100</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_3_3" name="dele_3_3" readonly>
															</div>
														</div>
													</div>
													<br>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">iii. % Soft Particle</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">Weight of sample as per IS 2386(P-2), CL no 5.3.1 gms(A)</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_4_1" name="dele_4_1">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">Weight of soft particle broken from surfce after brass rod rubbing gms (B)</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_4_2" name="dele_4_2">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">% Soft particle :- B/A *100</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_4_3" name="dele_4_3" readonly>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>

								<?php
									}
								} ?>
								<div class="panel panel-default" id="reamrks">
									<div class="panel-heading" id="txtreamrks">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse_remarks">
												<h4 class="panel-title">
													<b>Remarks</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse_remarks" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-4">
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-4 control-label label-right">Remarks</label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="col-md-2">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">Heading;</label>
															</div>
														</div>
													</div>
													<div class="col-lg-10">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tag_heading" name="tag_heading">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="col-md-2">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">Data;</label>
															</div>
														</div>
													</div>
													<div class="col-lg-10">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tag_data" name="tag_data">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								</div>
								<Br>
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
												$querys_job1 = "SELECT * FROM sand WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
											// $val =  $_SESSION['isadmin'];
											// if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
											?>
											<div class="col-sm-2">
												<a target='_blank' href="<?php echo $base_url; ?>print_report/print_sand.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

											</div>

											<?php // } 
											?>
											<div class="col-sm-2">
												<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_sand.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Observation Sheet</b></a>

											</div>
										</div>
									</div>
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
												$query = "select * from sand WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	$('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });
	$(function() {
		$('.select2').select2();
	})
	$(document).ready(function() {
		$('#btn_edit_data').hide();
		$('#alert').hide();




		$('#chk_silt').change(function() {
			if (this.checked) {
				$('#txtsil').css("background-color", "var(--success)");
			} else {
				$('#txtsil').css("background-color", "white");
			}

		});

		$('#chk_grd').change(function() {
			if (this.checked) {
				$('#txtgrd').css("background-color", "var(--success)");
			} else {
				$('#txtgrd').css("background-color", "white");
			}

		});



		$('#chk_sp').change(function() {
			if (this.checked) {
				$('#txtwtr').css("background-color", "var(--success)");
			} else {
				$('#txtwtr').css("background-color", "white");
			}

		});



		$('#chk_den').change(function() {
			if (this.checked) {
				$('#txtden').css("background-color", "var(--success)");
			} else {
				$('#txtden').css("background-color", "white");
			}

		});
		$('#chk_lbd').change(function() {
			if (this.checked) {
				$('#txtlbd').css("background-color", "var(--success)");
			} else {
				$('#txtlbd').css("background-color", "white");
			}

		});
		$('#chk_finer').change(function() {
			if (this.checked) {
				$('#txtfne').css("background-color", "var(--success)");
			} else {
				$('#txtfne').css("background-color", "white");
			}

		});
		$('#chk_sou').change(function() {
			if (this.checked) {
				$('#txtsou').css("background-color", "var(--success)");
			} else {
				$('#txtsou').css("background-color", "white");
			}

		});


		function soundness_auto() {
			$('#txtsou').css("background-color", "var(--success)");

			var t1_1 = randomNumberFromRange(1.00, 4.00).toFixed(2);
			var t1_2 = randomNumberFromRange(11.00, 18.00).toFixed(2);
			var t1_3 = randomNumberFromRange(5.00, 12.50).toFixed(2);
			var t1_4 = randomNumberFromRange(9.00, 18.00).toFixed(2);
			var t1_5 = randomNumberFromRange(20.00, 31.00).toFixed(2);
			var t2_1 = randomNumberFromRange(10.00, 15.00).toFixed(2);
			var t2_2 = randomNumberFromRange(1.00, 4.00).toFixed(2);
			var t2_3 = randomNumberFromRange(11.00, 18.00).toFixed(2);
			var t2_4 = randomNumberFromRange(5.00, 12.50).toFixed(2);
			var t2_5 = randomNumberFromRange(9.00, 18.00).toFixed(2);
			var t3_1 = randomNumberFromRange(20.00, 31.00).toFixed(2);
			var t3_2 = randomNumberFromRange(10.00, 15.00).toFixed(2);
			var t3_3 = randomNumberFromRange(1.00, 4.00).toFixed(2);
			var t3_4 = randomNumberFromRange(11.00, 18.00).toFixed(2);
			var t3_5 = randomNumberFromRange(5.00, 12.50).toFixed(2);
			var t4_1 = randomNumberFromRange(9.00, 18.00).toFixed(2);
			var t4_2 = randomNumberFromRange(20.00, 31.00).toFixed(2);
			var t4_3 = randomNumberFromRange(10.00, 15.00).toFixed(2);
			var t4_4 = randomNumberFromRange(1.00, 4.00).toFixed(2);
			var t4_5 = randomNumberFromRange(11.00, 18.00).toFixed(2);
			var t5_1 = randomNumberFromRange(5.00, 12.50).toFixed(2);
			var t5_2 = randomNumberFromRange(9.00, 18.00).toFixed(2);
			var t5_3 = randomNumberFromRange(20.00, 31.00).toFixed(2);
			var t5_4 = randomNumberFromRange(10.00, 15.00).toFixed(2);
			var t5_5 = randomNumberFromRange(1.00, 4.00).toFixed(2);
			var t6_1 = randomNumberFromRange(11.00, 18.00).toFixed(2);
			var t6_2 = randomNumberFromRange(5.00, 12.50).toFixed(2);
			var t6_3 = randomNumberFromRange(9.00, 18.00).toFixed(2);
			var t6_4 = randomNumberFromRange(20.00, 31.00).toFixed(2);
			var t6_5 = randomNumberFromRange(10.00, 15.00).toFixed(2);
			var t7_1 = randomNumberFromRange(1.00, 4.00).toFixed(2);
			var t7_2 = randomNumberFromRange(11.00, 18.00).toFixed(2);
			var t7_3 = randomNumberFromRange(5.00, 12.50).toFixed(2);
			var t7_4 = randomNumberFromRange(10.00, 15.00).toFixed(2);
			var t7_5 = randomNumberFromRange(10.00, 15.00).toFixed(2);
			var go7 = randomNumberFromRange(1.00, 4.00).toFixed(2);
			var go6 = randomNumberFromRange(11.00, 18.00).toFixed(2);
			var go5 = randomNumberFromRange(5.00, 12.50).toFixed(2);
			var go4 = randomNumberFromRange(9.00, 18.00).toFixed(2);
			var go3 = randomNumberFromRange(20.00, 31.00).toFixed(2);
			var go2 = randomNumberFromRange(10.00, 15.00).toFixed(2);
			var go1 = 0;


			$('#t1_1').val(t1_1);
			$('#t1_2').val(t1_2);
			$('#t1_3').val(t1_3);
			$('#t1_4').val(t1_4);
			$('#t1_5').val(t1_5);
			$('#t2_1').val(t2_1);
			$('#t2_2').val(t2_2);
			$('#t2_3').val(t2_3);
			$('#t2_4').val(t2_4);
			$('#t2_5').val(t2_5);
			$('#t3_1').val(t3_1);
			$('#t3_2').val(t3_2);
			$('#t3_3').val(t3_3);
			$('#t3_4').val(t3_4);
			$('#t3_5').val(t3_5);
			$('#t4_1').val(t4_1);
			$('#t4_2').val(t4_2);
			$('#t4_3').val(t4_3);
			$('#t4_4').val(t4_4);
			$('#t4_5').val(t4_5);
			$('#t5_1').val(t5_1);
			$('#t5_2').val(t5_2);
			$('#t5_3').val(t5_3);
			$('#t5_4').val(t5_4);
			$('#t5_5').val(t5_5);
			$('#t6_1').val(t6_1);
			$('#t6_2').val(t6_2);
			$('#t6_3').val(t6_3);
			$('#t6_4').val(t6_4);
			$('#t6_5').val(t6_5);
			$('#t7_1').val(t7_1);
			$('#t7_2').val(t7_2);
			$('#t7_3').val(t7_3);
			$('#t7_4').val(t7_4);
			$('#t7_5').val(t7_5);

			$('#go2').val(go2);
			$('#go3').val(go3);
			$('#go4').val(go4);
			$('#go5').val(go5);
			$('#go6').val(go6);
			$('#go7').val(go7);

			var g1 = $('#go1').val();
			var g2 = $('#go2').val();
			var g3 = $('#go3').val();
			var g4 = $('#go4').val();
			var g5 = $('#go5').val();
			var g6 = $('#go6').val();
			var g7 = $('#go7').val();

			var temp_total_go = 100 - ((+g2) + (+g3) + (+g4) + (+g5) + (+g6) + (+g7));
			g1 = (+temp_total_go).toFixed(2);
			$('#go1').val(g1);


			var total_go = (+g1) + (+g2) + (+g3) + (+g4) + (+g5) + (+g6) + (+g7);
			$('#total_go').val((+total_go).toFixed(2));



			var wt1 = 0;
			var wt2 = 0;
			var wt3 = 100;
			var wt4 = 100;
			var wt5 = 100;
			var wt6 = 100;
			var wt7 = 0;

			$('#wt1').val(wt1);
			$('#wt2').val(wt2);
			$('#wt3').val(wt3);
			$('#wt4').val(wt4);
			$('#wt5').val(wt5);
			$('#wt6').val(wt6);
			$('#wt7').val(wt7);

			var wa1 = 0;
			var wa2 = 0;
			var wa3 = randomNumberFromRange(0.20, 0.50).toFixed(2);
			var wa4 = randomNumberFromRange(0.20, 0.50).toFixed(2);
			var wa5 = randomNumberFromRange(0.20, 0.50).toFixed(2);
			var wa6 = randomNumberFromRange(0.20, 0.50).toFixed(2);
			var wa7 = randomNumberFromRange(0.20, 0.50).toFixed(2);
			$('#wa1').val(wa1);
			$('#wa2').val(wa2);
			$('#wa3').val(wa3);
			$('#wa4').val(wa4);
			$('#wa5').val(wa5);
			$('#wa6').val(wa6);
			$('#wa7').val(wa7);

			var soundness = (+wa3) + (+wa4) + (+wa5) + (+wa6) + (+wa7);
			$('#soundness').val(soundness.toFixed(1));

			var g3 = $('#go3').val();
			var g4 = $('#go4').val();
			var g5 = $('#go5').val();
			var g6 = $('#go6').val();
			var g7 = $('#go7').val();

			var t3 = $('#wt3').val();
			var t4 = $('#wt4').val();
			var t5 = $('#wt5').val();
			var t6 = $('#wt6').val();
			var t7 = $('#wt7').val();

			var a3 = $('#wa3').val();
			var a4 = $('#wa4').val();
			var a5 = $('#wa5').val();
			var a6 = $('#wa6').val();
			var a7 = $('#wa7').val();

			var eqa3 = (+a3) / (+g3);
			var eqa4 = (+a4) / (+g4);
			var eqa5 = (+a5) / (+g5);
			var eqa6 = (+a6) / (+g6);
			var eqa7 = (+a7) / (+g7);

			var pp3 = (+eqa3) * 100;
			var pp4 = (+eqa4) * 100;
			var pp5 = (+eqa5) * 100;
			var pp6 = (+eqa6) * 100;
			var pp7 = (+eqa6) * 100;

			$('#pp1').val(0);
			$('#pp2').val(0);
			$('#pp3').val(pp3.toFixed(2));
			$('#pp4').val(pp4.toFixed(2));
			$('#pp5').val(pp5.toFixed(2));
			$('#pp6').val(pp6.toFixed(2));
			$('#pp7').val(pp6.toFixed(2));

			var g_3 = $('#go3').val();
			var g_4 = $('#go4').val();
			var g_5 = $('#go5').val();
			var g_6 = $('#go6').val();
			var g_7 = $('#go7').val();

			var pp_3 = $('#pp3').val();
			var pp_4 = $('#pp4').val();
			var pp_5 = $('#pp5').val();
			var pp_6 = $('#pp6').val();
			var pp_7 = $('#pp7').val();

			var temp3 = (+g_3) * (+pp_3);
			var temp4 = (+g_4) * (+pp_4);
			var temp5 = (+g_5) * (+pp_5);
			var temp6 = (+g_6) * (+pp_6);
			var temp7 = (+g_7) * (+pp_7);

			var wa_3 = (+temp3) / 100;
			var wa_4 = (+temp4) / 100;
			var wa_5 = (+temp5) / 100;
			var wa_6 = (+temp6) / 100;
			var wa_7 = (+temp7) / 100;

			$('#wa3').val(wa_3.toFixed(2));
			$('#wa4').val(wa_4.toFixed(2));
			$('#wa5').val(wa_5.toFixed(2));
			$('#wa6').val(wa_6.toFixed(2));
			$('#wa7').val(wa_7.toFixed(2));

			var w_a3 = $('#wa3').val();
			var w_a4 = $('#wa4').val();
			var w_a5 = $('#wa5').val();
			var w_a6 = $('#wa6').val();
			var w_a7 = $('#wa7').val();

			var soundness2 = (+w_a3) + (+w_a4) + (+w_a5) + (+w_a6) + (+w_a7);
			$('#soundness').val(soundness2.toFixed(2));
		}

		//SOUNDNESS
		$('#chk_sou').change(function() {
			if (this.checked) {

				soundness_auto();

			} else {

				$('#soundness').val(null);
				$('#pp1').val(null);
				$('#pp2').val(null);
				$('#pp3').val(null);
				$('#pp4').val(null);
				$('#pp5').val(null);
				$('#pp6').val(null);
				$('#pp7').val(null);
				$('#wa1').val(null);
				$('#wa2').val(null);
				$('#wa3').val(null);
				$('#wa4').val(null);
				$('#wa5').val(null);
				$('#wa6').val(null);
				$('#wa7').val(null);
				$('#go1').val(null);
				$('#go2').val(null);
				$('#go3').val(null);
				$('#go4').val(null);
				$('#go5').val(null);
				$('#go6').val(null);
				$('#go7').val(null);
				$('#wt1').val(null);
				$('#wt2').val(null);
				$('#wt3').val(null);
				$('#wt4').val(null);
				$('#wt5').val(null);
				$('#wt6').val(null);
				$('#wt7').val(null);
				$('#total_go').val(null);

				$('#t1_1').val(null);
				$('#t1_2').val(null);
				$('#t1_3').val(null);
				$('#t1_4').val(null);
				$('#t1_5').val(null);
				$('#t2_1').val(null);
				$('#t2_2').val(null);
				$('#t2_3').val(null);
				$('#t2_4').val(null);
				$('#t2_5').val(null);
				$('#t3_1').val(null);
				$('#t3_2').val(null);
				$('#t3_3').val(null);
				$('#t3_4').val(null);
				$('#t3_5').val(null);
				$('#t4_1').val(null);
				$('#t4_2').val(null);
				$('#t4_3').val(null);
				$('#t4_4').val(null);
				$('#t4_5').val(null);
				$('#t5_1').val(null);
				$('#t5_2').val(null);
				$('#t5_3').val(null);
				$('#t5_4').val(null);
				$('#t5_5').val(null);
				$('#t6_1').val(null);
				$('#t6_2').val(null);
				$('#t6_3').val(null);
				$('#t6_4').val(null);
				$('#t6_5').val(null);
				$('#t7_1').val(null);
				$('#t7_2').val(null);
				$('#t7_3').val(null);
				$('#t7_4').val(null);
				$('#t7_5').val(null);
				$('#temp1').val(null);

				//$('#txtsou').css("background-color","white");
			}
		});

		/*function frnt_cal()
		{
			var g1 = $('#go1').val();
			var g2 = $('#go2').val();
			var g3 = $('#go3').val();
			var g4 = $('#go4').val();
			var g5 = $('#go5').val();
			var g6 = $('#go6').val();
			var g7 = $('#go7').val();
			
			var p1 = $('#pp1').val();
			var p2 = $('#pp2').val();
			var p3 = $('#pp3').val();
			var p4 = $('#pp4').val();
			var p5 = $('#pp5').val();
			var p6 = $('#pp6').val();
			var p7 = $('#pp7').val();
			
			var wa1 = ((+p1) * (+g1)) / 100;
			var wa2 = ((+p2) * (+g2)) / 100;
			var wa3 = ((+p3) * (+g3)) / 100;
			var wa4 = ((+p4) * (+g4)) / 100;
			var wa5 = ((+p5) * (+g5)) / 100;
			var wa6 = ((+p6) * (+g6)) / 100;
			var wa7 = ((+p7) * (+g7)) / 100;
			
			$('#wa1').val(wa1.toFixed(2));
			$('#wa2').val(wa2.toFixed(2));
			$('#wa3').val(wa3.toFixed(2));
			$('#wa4').val(wa4.toFixed(2));
			$('#wa5').val(wa5.toFixed(2));
			$('#wa6').val(wa6.toFixed(2));
			$('#wa7').val(wa7.toFixed(2));
			
			var w1 = $('#wa1').val();
			var w2 = $('#wa2').val();
			var w3 = $('#wa3').val();
			var w4 = $('#wa4').val();
			var w5 = $('#wa5').val();
			var w6 = $('#wa6').val();
			var w7 = $('#wa7').val();
			
			var soundness = (+wa1) + (+wa2) + (+wa3) + (+wa4) + (+wa5) + (+wa6) + (+wa7);
			$('#soundness').val(soundness.toFixed(1));
				
			
		}*/

		function frnt_cal() {
			var g1 = $('#go1').val();
			var g2 = $('#go2').val();
			var g3 = $('#go3').val();
			var g4 = $('#go4').val();
			var g5 = $('#go5').val();
			var g6 = $('#go6').val();
			var g7 = $('#go7').val();

			var total_go = (+g1) + (+g2) + (+g3) + (+g4) + (+g5) + (+g6) + (+g7);
			$('#total_go').val((+total_go).toFixed(2));


			var p1 = $('#pp1').val();
			var p2 = $('#pp2').val();
			var p3 = $('#pp3').val();
			var p4 = $('#pp4').val();
			var p5 = $('#pp5').val();
			var p6 = $('#pp6').val();
			var p7 = $('#pp7').val();

			var wa1 = ((+p1) * (+g1)) / 100;
			var wa2 = ((+p2) * (+g2)) / 100;
			var wa3 = ((+p3) * (+g3)) / 100;
			var wa4 = ((+p4) * (+g4)) / 100;
			var wa5 = ((+p5) * (+g5)) / 100;
			var wa6 = ((+p6) * (+g6)) / 100;
			var wa7 = ((+p7) * (+g7)) / 100;

			$('#wa1').val(wa1.toFixed(2));
			$('#wa2').val(wa2.toFixed(2));
			$('#wa3').val(wa3.toFixed(2));
			$('#wa4').val(wa4.toFixed(2));
			$('#wa5').val(wa5.toFixed(2));
			$('#wa6').val(wa6.toFixed(2));
			$('#wa7').val(wa7.toFixed(2));

			var w1 = $('#wa1').val();
			var w2 = $('#wa2').val();
			var w3 = $('#wa3').val();
			var w4 = $('#wa4').val();
			var w5 = $('#wa5').val();
			var w6 = $('#wa6').val();
			var w7 = $('#wa7').val();

			var soundness = (+wa1) + (+wa2) + (+wa3) + (+wa4) + (+wa5) + (+wa6) + (+wa7);
			$('#soundness').val(soundness.toFixed(2));
		}









		function finer_auto() {
			$('#txtfne').css("background-color", "var(--success)");
			var avg_finer = randomNumberFromRange(1.20, 2.78).toFixed(2);
			$('#avg_finer').val(avg_finer);
			var avg_finer1 = $('#avg_finer').val();
			var finer_a = randomNumberFromRange(250, 400).toFixed(2);
			var eq1 = (+avg_finer1) * (+finer_a);
			var eq2 = (+finer_a) * 100;
			var eq3 = (+eq2) - (+eq1);
			var finer_b = (+eq3) / 100;
			$('#finer_a').val(finer_a);
			$('#finer_b').val(finer_b.toFixed(2));
		}



		// sahil change Soundness




		$('#t1_1,#t1_2,#t1_3,#t1_4,#t1_5,#go7,#t2_1,#t2_2,#t2_3,#t2_4,#t2_5,#go6,#t3_1,#t3_2,#t3_3,#t3_4,#t3_5,#go5,#t4_1,#t4_2,#t4_3,#t4_4,#t4_5,#go4,#t5_1,#t5_2,#t5_3,#t5_4,#t5_5,#go3,#t6_1,#t6_2,#t6_3,#t6_4,#t6_5,#go2,#t7_1,#t7_2,#t7_3,#t7_4,#t7_5,#go1').change(function() {

			var t1_1 = $('#t1_1').val();
			var t1_2 = $('#t1_2').val();
			var t1_3 = $('#t1_3').val();
			var t1_4 = $('#t1_4').val();
			var t1_5 = $('#t1_5').val();
			var t2_1 = $('#t2_1').val();
			var t2_2 = $('#t2_2').val();
			var t2_3 = $('#t2_3').val();
			var t2_4 = $('#t2_4').val();
			var t2_5 = $('#t2_5').val();
			var t3_1 = $('#t3_1').val();
			var t3_2 = $('#t3_2').val();
			var t3_3 = $('#t3_3').val();
			var t3_4 = $('#t3_4').val();
			var t3_5 = $('#t3_5').val();
			var t4_1 = $('#t4_1').val();
			var t4_2 = $('#t4_2').val();
			var t4_3 = $('#t4_3').val();
			var t4_4 = $('#t4_4').val();
			var t4_5 = $('#t4_5').val();
			var t5_1 = $('#t5_1').val();
			var t5_2 = $('#t5_2').val();
			var t5_3 = $('#t5_3').val();
			var t5_4 = $('#t5_4').val();
			var t5_5 = $('#t5_5').val();
			var t6_1 = $('#t6_1').val();
			var t6_2 = $('#t6_2').val();
			var t6_3 = $('#t6_3').val();
			var t6_4 = $('#t6_4').val();
			var t6_5 = $('#t6_5').val();
			var t7_1 = $('#t7_1').val();
			var t7_2 = $('#t7_2').val();
			var t7_3 = $('#t7_3').val();
			var t7_4 = $('#t7_4').val();
			var t7_5 = $('#t7_5').val();
			var go7 = $('#go7').val();
			var go6 = $('#go6').val();
			var go5 = $('#go5').val();
			var go4 = $('#go4').val();
			var go3 = $('#go3').val();
			var go2 = $('#go2').val();
			var go1 = $('#go1').val();



			var avg_1 = ((+t1_1) + (+t1_2) + (+t1_3) + (+t1_4) + (+t1_5)) / (+5);
			var avg_2 = ((+t2_1) + (+t2_2) + (+t2_3) + (+t2_4) + (+t2_5)) / (+5);
			var avg_3 = ((+t3_1) + (+t3_2) + (+t3_3) + (+t3_4) + (+t3_5)) / (+5);
			var avg_4 = ((+t4_1) + (+t4_2) + (+t4_3) + (+t4_4) + (+t4_5)) / (+5);
			var avg_5 = ((+t5_1) + (+t5_2) + (+t5_3) + (+t5_4) + (+t5_5)) / (+5);
			var avg_6 = ((+t6_1) + (+t6_2) + (+t6_3) + (+t6_4) + (+t6_5)) / (+5);
			var avg_7 = ((+t7_1) + (+t7_2) + (+t7_3) + (+t7_4) + (+t7_5)) / (+5);





			var wt7 = (((+go7) * (+100)) / (+avg_1));
			$('#wt7').val(wt7.toFixed(2));
			var wt7 = $('#wt7').val();


			var pp7 = (((+100) - ((+100) * (+t1_5))) / (+go7));
			$('#pp7').val(pp7.toFixed(2));
			var pp7 = $('#pp7').val();




			var wt6 = (((+go6) * (+100)) / (+avg_2));
			$('#wt6').val(wt6.toFixed(2));
			var wt6 = $('#wt6').val();


			var pp6 = (((+100) - ((+100) * (+t2_5))) / (+go6));
			$('#pp6').val(pp6.toFixed(2));
			var pp6 = $('#pp6').val();



			var wt5 = (((+go5) * (+100)) / (+avg_3));
			$('#wt5').val(wt5.toFixed(2));
			var wt5 = $('#wt5').val();


			var pp5 = (((+100) - ((+100) * (+t3_5))) / (+go5));
			$('#pp5').val(pp5.toFixed(2));
			var pp5 = $('#pp5').val();




			var wt4 = (((+go4) * (+100)) / (+avg_4));
			$('#wt4').val(wt4.toFixed(2));
			var wt4 = $('#wt4').val();


			var pp4 = (((+100) - ((+100) * (+t4_5))) / (+go4));
			$('#pp4').val(pp4.toFixed(2));
			var pp4 = $('#pp4').val();


			var wt3 = (((+go3) * (+100)) / (+avg_5));
			$('#wt3').val(wt3.toFixed(2));
			var wt3 = $('#wt3').val();


			var pp3 = (((+100) - ((+100) * (+t5_5))) / (+go3));
			$('#pp3').val(pp3.toFixed(2));
			var pp3 = $('#pp3').val();


			var wt2 = (((+go2) * (+100)) / (+avg_6));
			$('#wt2').val(wt2.toFixed(2));
			var wt2 = $('#wt2').val();


			var pp2 = (((+100) - ((+100) * (+t6_5))) / (+go2));
			$('#pp2').val(pp2.toFixed(2));
			var pp2 = $('#pp2').val();


			var wt1 = (((+go1) * (+100)) / (+avg_7));
			$('#wt1').val(wt1.toFixed(2));
			var wt1 = $('#wt1').val();


			var pp1 = (((+100) - ((+100) * (+t7_5))) / (+go1));
			$('#pp1').val(pp1.toFixed(2));
			var pp1 = $('#pp1').val();


			var wa7 = (((+wt7) * (+pp7)) / (+100));
			$('#wa7').val(wa7.toFixed(2));
			var wa7 = $('#wa7').val();

			var wa6 = (((+wt6) * (+pp6)) / (+100));
			$('#wa6').val(wa6.toFixed(2));
			var wa6 = $('#wa6').val();

			var wa5 = (((+wt5) * (+pp5)) / (+100));
			$('#wa5').val(wa5.toFixed(2));
			var wa5 = $('#wa5').val();

			var wa4 = (((+wt4) * (+pp4)) / (+100));
			$('#wa4').val(wa4.toFixed(2));
			var wa4 = $('#wa4').val();

			var wa3 = (((+wt3) * (+pp3)) / (+100));
			$('#wa3').val(wa3.toFixed(2));
			var wa3 = $('#wa3').val();

			var wa2 = (((+wt2) * (+pp2)) / (+100));
			$('#wa2').val(wa2.toFixed(2));
			var wa2 = $('#wa2').val();

			var wa1 = (((+wt1) * (+pp1)) / (+100));
			$('#wa1').val(wa1.toFixed(2));
			var wa1 = $('#wa1').val();



			var soundness = ((+wa7) + (+wa6) + (+wa5) + (+wa4) + (+wa3) + (+wa2) + (+wa1)) / (+7);
			$('#soundness').val(soundness.toFixed(2));



		});



		// sahil change SPECIFIC GRAVITY & WATER ABSORPTION


		$('#sp_w_s_1,#sp_wt_py1_1,#sp_wt_py2_1,#sp_wt_st_1,#sp_w_s_2,#sp_wt_py1_2,#sp_wt_py2_2,#sp_wt_st_2,#sp_w_s_3,#sp_wt_py1_3,#sp_wt_py2_3,#sp_wt_st_3,#sp_w_s_4,#sp_wt_py1_4,#sp_wt_py2_4,#sp_wt_st_4,#sp_w_s_5,#sp_wt_py1_5,#sp_wt_py2_5,#sp_wt_st_5,#sp_w_s_6,#sp_wt_py1_6,#sp_wt_py2_6,#sp_wt_st_6').change(function() {

			var sp_w_s_1 = $('#sp_w_s_1').val();
			var sp_wt_py1_1 = $('#sp_wt_py1_1').val();
			var sp_wt_py2_1 = $('#sp_wt_py2_1').val();
			var sp_wt_st_1 = $('#sp_wt_st_1').val();
			var sp_w_s_2 = $('#sp_w_s_2').val();
			var sp_wt_py1_2 = $('#sp_wt_py1_2').val();
			var sp_wt_py2_2 = $('#sp_wt_py2_2').val();
			var sp_wt_st_2 = $('#sp_wt_st_2').val();
			var sp_w_s_3 = $('#sp_w_s_3').val();
			var sp_wt_py1_3 = $('#sp_wt_py1_3').val();
			var sp_wt_py2_3 = $('#sp_wt_py2_3').val();
			var sp_wt_st_3 = $('#sp_wt_st_3').val();
			var sp_w_s_4 = $('#sp_w_s_4').val();
			var sp_wt_py1_4 = $('#sp_wt_py1_4').val();
			var sp_wt_py2_4 = $('#sp_wt_py2_4').val();
			var sp_wt_st_4 = $('#sp_wt_st_4').val();
			var sp_w_s_5 = $('#sp_w_s_5').val();
			var sp_wt_py1_5 = $('#sp_wt_py1_5').val();
			var sp_wt_py2_5 = $('#sp_wt_py2_5').val();
			var sp_wt_st_5 = $('#sp_wt_st_5').val();
			var sp_w_s_6 = $('#sp_w_s_6').val();
			var sp_wt_py1_6 = $('#sp_wt_py1_6').val();
			var sp_wt_py2_6 = $('#sp_wt_py2_6').val();
			var sp_wt_st_6 = $('#sp_wt_st_6').val();



			var sp1_1 = ((+sp_w_s_1) / ((+sp_wt_py1_1) - ((+sp_wt_py2_1) - (+sp_wt_st_1))));
			$('#sp1_1').val(sp1_1.toFixed(2));
			var sp1_1 = $('#sp1_1').val();

			var sp1_2 = ((+sp_wt_py1_1) / ((+sp_wt_py1_1) - ((+sp_wt_py2_1) - (+sp_wt_st_1))));
			$('#sp1_2').val(sp1_2.toFixed(2));
			var sp1_2 = $('#sp1_2').val();


			var sp_specific_gravity_1 = ((+sp_w_s_1) / ((+sp_w_s_1) - ((+sp_wt_py2_1) - (+sp_wt_py1_1))));
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
			var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();


			var sp_water_abr_1 = ((+100) * (((+sp_wt_py1_1) - (+sp_w_s_1)) / (+sp_w_s_1)));
			$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
			var sp_water_abr_1 = $('#sp_water_abr_1').val();

			var sp2_1 = ((+sp_w_s_2) / ((+sp_wt_py1_2) - ((+sp_wt_py2_2) - (+sp_wt_st_2))));
			$('#sp2_1').val(sp2_1.toFixed(2));
			var sp2_1 = $('#sp2_1').val();

			var sp2_2 = ((+sp_wt_py1_2) / ((+sp_wt_py1_2) - ((+sp_wt_py2_2) - (+sp_wt_st_2))));
			$('#sp2_2').val(sp2_2.toFixed(2));
			var sp2_2 = $('#sp2_2').val();


			var sp_specific_gravity_2 = ((+sp_w_s_2) / ((+sp_w_s_2) - ((+sp_wt_py2_2) - (+sp_wt_py1_2))));
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
			var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();


			var sp_water_abr_2 = ((+100) * (((+sp_wt_py1_2) - (+sp_w_s_2)) / (+sp_w_s_2)));
			$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
			var sp_water_abr_2 = $('#sp_water_abr_2').val();

			var sp3_1 = ((+sp_w_s_3) / ((+sp_wt_py1_3) - ((+sp_wt_py2_3) - (+sp_wt_st_3))));
			$('#sp3_1').val(sp3_1.toFixed(2));
			var sp3_1 = $('#sp3_1').val();

			var sp3_2 = ((+sp_wt_py1_3) / ((+sp_wt_py1_3) - ((+sp_wt_py2_3) - (+sp_wt_st_3))));
			$('#sp3_2').val(sp3_2.toFixed(2));
			var sp3_2 = $('#sp3_2').val();


			var sp_specific_gravity_3 = ((+sp_w_s_3) / ((+sp_w_s_3) - ((+sp_wt_py2_3) - (+sp_wt_py1_3))));
			$('#sp_specific_gravity_3').val(sp_specific_gravity_3.toFixed(2));
			var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();


			var sp_water_abr_3 = ((+100) * (((+sp_wt_py1_3) - (+sp_w_s_3)) / (+sp_w_s_3)));
			$('#sp_water_abr_3').val(sp_water_abr_3.toFixed(2));
			var sp_water_abr_3 = $('#sp_water_abr_3').val();


			var sp4_1 = ((+sp_w_s_4) / ((+sp_wt_py1_4) - ((+sp_wt_py2_4) - (+sp_wt_st_4))));
			$('#sp4_1').val(sp4_1.toFixed(2));
			var sp4_1 = $('#sp4_1').val();

			var sp4_2 = ((+sp_wt_py1_4) / ((+sp_wt_py1_4) - ((+sp_wt_py2_4) - (+sp_wt_st_4))));
			$('#sp4_2').val(sp4_2.toFixed(2));
			var sp4_2 = $('#sp4_2').val();


			var sp_specific_gravity_4 = ((+sp_w_s_4) / ((+sp_w_s_4) - ((+sp_wt_py2_4) - (+sp_wt_py1_4))));
			$('#sp_specific_gravity_4').val(sp_specific_gravity_4.toFixed(2));
			var sp_specific_gravity_4 = $('#sp_specific_gravity_4').val();


			var sp_water_abr_4 = ((+100) * (((+sp_wt_py1_4) - (+sp_w_s_4)) / (+sp_w_s_4)));
			$('#sp_water_abr_4').val(sp_water_abr_4.toFixed(2));
			var sp_water_abr_4 = $('#sp_water_abr_4').val();



			var sp5_1 = ((+sp_w_s_5) / ((+sp_wt_py1_5) - ((+sp_wt_py2_5) - (+sp_wt_st_5))));
			$('#sp5_1').val(sp5_1.toFixed(2));
			var sp5_1 = $('#sp5_1').val();

			var sp5_2 = ((+sp_wt_py1_5) / ((+sp_wt_py1_5) - ((+sp_wt_py2_5) - (+sp_wt_st_5))));
			$('#sp5_2').val(sp5_2.toFixed(2));
			var sp5_2 = $('#sp5_2').val();


			var sp_specific_gravity_5 = ((+sp_w_s_5) / ((+sp_w_s_5) - ((+sp_wt_py2_5) - (+sp_wt_py1_5))));
			$('#sp_specific_gravity_5').val(sp_specific_gravity_5.toFixed(2));
			var sp_specific_gravity_5 = $('#sp_specific_gravity_5').val();


			var sp_water_abr_5 = ((+100) * (((+sp_wt_py1_5) - (+sp_w_s_5)) / (+sp_w_s_5)));
			$('#sp_water_abr_5').val(sp_water_abr_5.toFixed(2));
			var sp_water_abr_5 = $('#sp_water_abr_5').val();

			var sp6_1 = ((+sp_w_s_6) / ((+sp_wt_py1_6) - ((+sp_wt_py2_6) - (+sp_wt_st_6))));
			$('#sp6_1').val(sp6_1.toFixed(2));
			var sp6_1 = $('#sp6_1').val();

			var sp6_2 = ((+sp_wt_py1_6) / ((+sp_wt_py1_6) - ((+sp_wt_py2_6) - (+sp_wt_st_6))));
			$('#sp6_2').val(sp6_2.toFixed(2));
			var sp6_2 = $('#sp6_2').val();


			var sp_specific_gravity_6 = ((+sp_w_s_6) / ((+sp_w_s_6) - ((+sp_wt_py2_6) - (+sp_wt_py1_6))));
			$('#sp_specific_gravity_6').val(sp_specific_gravity_6.toFixed(2));
			var sp_specific_gravity_6 = $('#sp_specific_gravity_6').val();


			var sp_water_abr_6 = ((+100) * (((+sp_wt_py1_6) - (+sp_w_s_6)) / (+sp_w_s_6)));
			$('#sp_water_abr_6').val(sp_water_abr_6.toFixed(2));
			var sp_water_abr_6 = $('#sp_water_abr_6').val();


			// avrage

			var sp_gravity = (((+sp1_1) + (+sp2_1)) / (+2));
			$('#sp_gravity').val(sp_gravity.toFixed(2));


			var sp_avg = (((+sp1_2) + (+sp2_2)) / (+2));
			$('#sp_avg').val(sp_avg.toFixed(2));


			var sp_gravity_1 = (((+sp3_1) + (+sp4_1)) / (+2));
			$('#sp_gravity_1').val(sp_gravity_1.toFixed(2));


			var sp_avg_1 = (((+sp3_2) + (+sp4_2)) / (+2));
			$('#sp_avg_1').val(sp_avg_1.toFixed(2));



			var sp_gravity_2 = (((+sp5_1) + (+sp6_1)) / (+2));
			$('#sp_gravity_2').val(sp_gravity_2.toFixed(2));


			var sp_avg_2 = (((+sp5_2) + (+sp6_2)) / (+2));
			$('#sp_avg_2').val(sp_avg_2.toFixed(2));


			var sp_specific_gravity = (((+sp_specific_gravity_1) + (+sp_specific_gravity_2)) / (+2));
			$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));

			var sp_water_abr = (((+sp_water_abr_1) + (+sp_water_abr_2)) / (+2));
			$('#sp_water_abr').val(sp_water_abr.toFixed(2));


			var sp_specific_gravity2_1 = (((+sp_specific_gravity_3) + (+sp_specific_gravity_4)) / (+2));
			$('#sp_specific_gravity2_1').val(sp_specific_gravity2_1.toFixed(2));


			var sp_water_abr1_1 = (((+sp_water_abr_3) + (+sp_water_abr_4)) / (+2));
			$('#sp_water_abr1_1').val(sp_water_abr1_1.toFixed(2));


			var sp_specific_gravity2_2 = (((+sp_specific_gravity_5) + (+sp_specific_gravity_6)) / (+2));
			$('#sp_specific_gravity2_2').val(sp_specific_gravity2_2.toFixed(2));


			var sp_water_abr2_1 = (((+sp_water_abr_5) + (+sp_water_abr_6)) / (+2));
			$('#sp_water_abr2_1').val(sp_water_abr2_1.toFixed(2));




		});




		// sahil chnage LOOSE BULK DENSITY

		$('#lbd_m11,#lbd_m12,#lbd_m13,#lbd_m21,#lbd_m22,#lbd_m23,#lbd_wom1,#lbd_wom2,#lbd_wom3').change(function() {

			var lbd_m11 = $('#lbd_m11').val();
			var lbd_m12 = $('#lbd_m12').val();
			var lbd_m13 = $('#lbd_m13').val();
			var lbd_m21 = $('#lbd_m21').val();
			var lbd_m22 = $('#lbd_m22').val();
			var lbd_m23 = $('#lbd_m23').val();
			var lbd_wom1 = $('#lbd_wom1').val();
			var lbd_wom2 = $('#lbd_wom2').val();
			var lbd_wom3 = $('#lbd_wom3').val();

			var lbd_avg_wom = ((+lbd_m21) - (+lbd_wom1));
			$('#lbd_avg_wom').val(lbd_avg_wom.toFixed(2));
			var lbd_avg_wom = $('#lbd_avg_wom').val();


			var lbd_vol = ((+lbd_m22) - (+lbd_wom2));
			$('#lbd_vol').val(lbd_vol.toFixed(2));
			var lbd_vol = $('#lbd_vol').val();


			var lbd_avg_wom1 = ((+lbd_m23) - (+lbd_wom3));
			$('#lbd_avg_wom1').val(lbd_avg_wom1.toFixed(2));
			var lbd_avg_wom1 = $('#lbd_avg_wom1').val();


			var bulk1 = ((+lbd_avg_wom) / (+lbd_m11));
			$('#bulk1').val(bulk1.toFixed(2));



			var bulk2 = ((+lbd_vol) / (+lbd_m12));
			$('#bulk2').val(bulk2.toFixed(2));



			var bulk3 = ((+lbd_avg_wom1) / (+lbd_m13));
			$('#bulk3').val(bulk3.toFixed(2));



			var lbd_bdl = (((+bulk1) + (+bulk2) + (+bulk3)) / (+3));
			$('#lbd_bdl').val(lbd_bdl.toFixed(2));






		});


		//FINER
		$('#chk_finer').change(function() {
			if (this.checked) {
				finer_auto();

			} else {
				$('#avg_finer').val(null);
				$('#finer_a').val(null);
				$('#finer_b').val(null);
				$('#txtfne').css("background-color", "white");
			}
		});





		var sp_w_b_a1_2;
		var sp_w_b_a2_2;
		var sp_wt_st_1;
		var sp_wt_st_2;
		var sp_w_s_2;
		var sp_specific_gravity_1;
		var sp_specific_gravity_2;
		var sp_water_abr_1;
		var sp_water_abr_2;
		var sp_w_sur_1;
		var sp_w_sur_2;
		var sp_temp;


		function sp_auto() {


			var sp_temp = randomNumberFromRange(25.0, 27.0);
			$('#sp_temp').val(sp_temp.toString().substring(0, sp_temp.toString().indexOf(".") + 2));
			var sp_specific_gravity = randomNumberFromRange(2.640, 2.670).toFixed(3); //(sp_specific_gravity)
			$('#sp_specific_gravity').val(sp_specific_gravity);
			var spspecific_gravity = $('#sp_specific_gravity').val();
			var sp_specific_gravity_1 = (+spspecific_gravity) + randomNumberFromRange(-0.010, 0.010); //(sp_specific_gravity_1)_1
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(3));
			var spspecific_gravity_1 = $('#sp_specific_gravity_1').val();
			var tems1 = ((+spspecific_gravity) * 2);
			var sp_specific_gravity_2 = ((+tems1) - (+spspecific_gravity_1)); //(sp_specific_gravity_2)_2
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(3));
			var spspecific_gravity_2 = $('#sp_specific_gravity_2').val();
			var sp_water_abr = randomNumberFromRange(1.40, 1.80).toFixed(2); // (sp_water_abr)_1
			$('#sp_water_abr').val(sp_water_abr);
			var spwater_abr = $('#sp_water_abr').val();
			var sp_water_abr_1 = (+spwater_abr) + randomNumberFromRange(-0.02, 0.02) ////(sp_water_abr_1)_1
			$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
			var spwater_abr_1 = $('#sp_water_abr_1').val();
			var tems11 = ((spwater_abr) * 2);
			var sp_water_abr_2 = ((+tems11) - (+spwater_abr_1)); // (sp_water_abr_2)_1 
			$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
			var spwater_abr_2 = $('#sp_water_abr_2').val();
			var sp_wt_py1_1 = randomNumberFromRange(1490, 1510);
			var sp_wt_py2_1 = randomNumberFromRange(1800, 1830);
			var sp_wt_py1_2 = randomNumberFromRange(1490, 1510);
			var sp_wt_py2_2 = randomNumberFromRange(1800, 1830);
			$('#sp_wt_py1_1').val((+sp_wt_py1_1).toFixed());
			$('#sp_wt_py2_1').val((+sp_wt_py2_1).toFixed());
			$('#sp_wt_py1_2').val((+sp_wt_py1_2).toFixed());
			$('#sp_wt_py2_2').val((+sp_wt_py2_2).toFixed());
			var sp_wt_py_1_1 = $('#sp_wt_py1_1').val();
			var sp_wt_py_2_1 = $('#sp_wt_py2_1').val();
			var sp_wt_py_1_2 = $('#sp_wt_py1_2').val();
			var sp_wt_py_2_2 = $('#sp_wt_py2_2').val();

			$('#sp_wt_st_1').val(randomNumberFromRange(501.11, 508.11).toFixed(2));
			$('#sp_wt_st_2').val(randomNumberFromRange(501.11, 508.11).toFixed(2));

			var a1 = $('#sp_wt_st_1').val();
			var a2 = $('#sp_wt_st_2').val();
			var g1 = $('#sp_specific_gravity_1').val();
			var g2 = $('#sp_specific_gravity_2').val();
			var wtr1 = $('#sp_water_abr_1').val();
			var wtr2 = $('#sp_water_abr_2').val();


			var equp1 = (+a1) * 100;
			var equp2 = (+a2) * 100;
			var eqdn1 = (+wtr1) + 100;
			var eqdn2 = (+wtr2) + 100;
			//var sp_w_s_1 = (+equp1) / (+eqdn1);
			//var sp_w_s_2 = (+equp2) / (+eqdn2);

			var sp_w_s_1 = randomNumberFromRange(493.11, 498.11);
			var sp_w_s_2 = randomNumberFromRange(493.11, 498.11);
			$('#sp_w_s_1').val(sp_w_s_1.toFixed(2));
			$('#sp_w_s_2').val(sp_w_s_2.toFixed(2));
			var b1 = $('#sp_w_s_1').val();
			var b2 = $('#sp_w_s_2').val();
			//var sp_w_sur_1 = (+a1) - ((+b1) / (+g1));
			//var sp_w_sur_2 = (+a2) - ((+b2) / (+g2));

			var sp_w_sur_1 = (+sp_wt_py_2_1) - ((+sp_wt_py_1_1));
			var sp_w_sur_2 = (+sp_wt_py_2_2) - ((+sp_wt_py_1_2));
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));







			// sahil auto SPECIFIC GRAVITY & WATER ABSORPTION

			 $('#sp_w_s_1').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py1_1').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py2_1').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_st_1').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_w_s_2').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py1_2').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py2_2').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_st_2').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_w_s_3').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py1_3').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py2_3').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_st_3').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_w_s_4').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py1_4').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py2_4').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_st_4').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_w_s_5').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py1_5').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py2_5').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_st_5').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_w_s_6').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py1_6').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_py2_6').val(randomNumberFromRange(20.00,99.00).toFixed(2));
			 $('#sp_wt_st_6').val(randomNumberFromRange(20.00,99.00).toFixed(2));



			var sp_w_s_1 = $('#sp_w_s_1').val();
			var sp_wt_py1_1 = $('#sp_wt_py1_1').val();
			var sp_wt_py2_1 = $('#sp_wt_py2_1').val();
			var sp_wt_st_1 = $('#sp_wt_st_1').val();
			var sp_w_s_2 = $('#sp_w_s_2').val();
			var sp_wt_py1_2 = $('#sp_wt_py1_2').val();
			var sp_wt_py2_2 = $('#sp_wt_py2_2').val();
			var sp_wt_st_2 = $('#sp_wt_st_2').val();
			var sp_w_s_3 = $('#sp_w_s_3').val();
			var sp_wt_py1_3 = $('#sp_wt_py1_3').val();
			var sp_wt_py2_3 = $('#sp_wt_py2_3').val();
			var sp_wt_st_3 = $('#sp_wt_st_3').val();
			var sp_w_s_4 = $('#sp_w_s_4').val();
			var sp_wt_py1_4 = $('#sp_wt_py1_4').val();
			var sp_wt_py2_4 = $('#sp_wt_py2_4').val();
			var sp_wt_st_4 = $('#sp_wt_st_4').val();
			var sp_w_s_5 = $('#sp_w_s_5').val();
			var sp_wt_py1_5 = $('#sp_wt_py1_5').val();
			var sp_wt_py2_5 = $('#sp_wt_py2_5').val();
			var sp_wt_st_5 = $('#sp_wt_st_5').val();
			var sp_w_s_6 = $('#sp_w_s_6').val();
			var sp_wt_py1_6 = $('#sp_wt_py1_6').val();
			var sp_wt_py2_6 = $('#sp_wt_py2_6').val();
			var sp_wt_st_6 = $('#sp_wt_st_6').val();



			var sp1_1 = ((+sp_w_s_1) / ((+sp_wt_py1_1) - ((+sp_wt_py2_1) - (+sp_wt_st_1))));
			$('#sp1_1').val(sp1_1.toFixed(2));
			var sp1_1 = $('#sp1_1').val();

			var sp1_2 = ((+sp_wt_py1_1) / ((+sp_wt_py1_1) - ((+sp_wt_py2_1) - (+sp_wt_st_1))));
			$('#sp1_2').val(sp1_2.toFixed(2));
			var sp1_2 = $('#sp1_2').val();


			var sp_specific_gravity_1 = ((+sp_w_s_1) / ((+sp_w_s_1) - ((+sp_wt_py2_1) - (+sp_wt_py1_1))));
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
			var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();


			var sp_water_abr_1 = ((+100) * (((+sp_wt_py1_1) - (+sp_w_s_1)) / (+sp_w_s_1)));
			$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
			var sp_water_abr_1 = $('#sp_water_abr_1').val();

			var sp2_1 = ((+sp_w_s_2) / ((+sp_wt_py1_2) - ((+sp_wt_py2_2) - (+sp_wt_st_2))));
			$('#sp2_1').val(sp2_1.toFixed(2));
			var sp2_1 = $('#sp2_1').val();

			var sp2_2 = ((+sp_wt_py1_2) / ((+sp_wt_py1_2) - ((+sp_wt_py2_2) - (+sp_wt_st_2))));
			$('#sp2_2').val(sp2_2.toFixed(2));
			var sp2_2 = $('#sp2_2').val();


			var sp_specific_gravity_2 = ((+sp_w_s_2) / ((+sp_w_s_2) - ((+sp_wt_py2_2) - (+sp_wt_py1_2))));
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
			var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();


			var sp_water_abr_2 = ((+100) * (((+sp_wt_py1_2) - (+sp_w_s_2)) / (+sp_w_s_2)));
			$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
			var sp_water_abr_2 = $('#sp_water_abr_2').val();

			var sp3_1 = ((+sp_w_s_3) / ((+sp_wt_py1_3) - ((+sp_wt_py2_3) - (+sp_wt_st_3))));
			$('#sp3_1').val(sp3_1.toFixed(2));
			var sp3_1 = $('#sp3_1').val();

			var sp3_2 = ((+sp_wt_py1_3) / ((+sp_wt_py1_3) - ((+sp_wt_py2_3) - (+sp_wt_st_3))));
			$('#sp3_2').val(sp3_2.toFixed(2));
			var sp3_2 = $('#sp3_2').val();


			var sp_specific_gravity_3 = ((+sp_w_s_3) / ((+sp_w_s_3) - ((+sp_wt_py2_3) - (+sp_wt_py1_3))));
			$('#sp_specific_gravity_3').val(sp_specific_gravity_3.toFixed(2));
			var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();


			var sp_water_abr_3 = ((+100) * (((+sp_wt_py1_3) - (+sp_w_s_3)) / (+sp_w_s_3)));
			$('#sp_water_abr_3').val(sp_water_abr_3.toFixed(2));
			var sp_water_abr_3 = $('#sp_water_abr_3').val();


			var sp4_1 = ((+sp_w_s_4) / ((+sp_wt_py1_4) - ((+sp_wt_py2_4) - (+sp_wt_st_4))));
			$('#sp4_1').val(sp4_1.toFixed(2));
			var sp4_1 = $('#sp4_1').val();

			var sp4_2 = ((+sp_wt_py1_4) / ((+sp_wt_py1_4) - ((+sp_wt_py2_4) - (+sp_wt_st_4))));
			$('#sp4_2').val(sp4_2.toFixed(2));
			var sp4_2 = $('#sp4_2').val();


			var sp_specific_gravity_4 = ((+sp_w_s_4) / ((+sp_w_s_4) - ((+sp_wt_py2_4) - (+sp_wt_py1_4))));
			$('#sp_specific_gravity_4').val(sp_specific_gravity_4.toFixed(2));
			var sp_specific_gravity_4 = $('#sp_specific_gravity_4').val();


			var sp_water_abr_4 = ((+100) * (((+sp_wt_py1_4) - (+sp_w_s_4)) / (+sp_w_s_4)));
			$('#sp_water_abr_4').val(sp_water_abr_4.toFixed(2));
			var sp_water_abr_4 = $('#sp_water_abr_4').val();



			var sp5_1 = ((+sp_w_s_5) / ((+sp_wt_py1_5) - ((+sp_wt_py2_5) - (+sp_wt_st_5))));
			$('#sp5_1').val(sp5_1.toFixed(2));
			var sp5_1 = $('#sp5_1').val();

			var sp5_2 = ((+sp_wt_py1_5) / ((+sp_wt_py1_5) - ((+sp_wt_py2_5) - (+sp_wt_st_5))));
			$('#sp5_2').val(sp5_2.toFixed(2));
			var sp5_2 = $('#sp5_2').val();


			var sp_specific_gravity_5 = ((+sp_w_s_5) / ((+sp_w_s_5) - ((+sp_wt_py2_5) - (+sp_wt_py1_5))));
			$('#sp_specific_gravity_5').val(sp_specific_gravity_5.toFixed(2));
			var sp_specific_gravity_5 = $('#sp_specific_gravity_5').val();


			var sp_water_abr_5 = ((+100) * (((+sp_wt_py1_5) - (+sp_w_s_5)) / (+sp_w_s_5)));
			$('#sp_water_abr_5').val(sp_water_abr_5.toFixed(2));
			var sp_water_abr_5 = $('#sp_water_abr_5').val();

			var sp6_1 = ((+sp_w_s_6) / ((+sp_wt_py1_6) - ((+sp_wt_py2_6) - (+sp_wt_st_6))));
			$('#sp6_1').val(sp6_1.toFixed(2));
			var sp6_1 = $('#sp6_1').val();

			var sp6_2 = ((+sp_wt_py1_6) / ((+sp_wt_py1_6) - ((+sp_wt_py2_6) - (+sp_wt_st_6))));
			$('#sp6_2').val(sp6_2.toFixed(2));
			var sp6_2 = $('#sp6_2').val();


			var sp_specific_gravity_6 = ((+sp_w_s_6) / ((+sp_w_s_6) - ((+sp_wt_py2_6) - (+sp_wt_py1_6))));
			$('#sp_specific_gravity_6').val(sp_specific_gravity_6.toFixed(2));
			var sp_specific_gravity_6 = $('#sp_specific_gravity_6').val();


			var sp_water_abr_6 = ((+100) * (((+sp_wt_py1_6) - (+sp_w_s_6)) / (+sp_w_s_6)));
			$('#sp_water_abr_6').val(sp_water_abr_6.toFixed(2));
			var sp_water_abr_6 = $('#sp_water_abr_6').val();


			// avrage

			var sp_gravity = (((+sp1_1) + (+sp2_1)) / (+2));
			$('#sp_gravity').val(sp_gravity.toFixed(2));


			var sp_avg = (((+sp1_2) + (+sp2_2)) / (+2));
			$('#sp_avg').val(sp_avg.toFixed(2));


			var sp_gravity_1 = (((+sp3_1) + (+sp4_1)) / (+2));
			$('#sp_gravity_1').val(sp_gravity_1.toFixed(2));


			var sp_avg_1 = (((+sp3_2) + (+sp4_2)) / (+2));
			$('#sp_avg_1').val(sp_avg_1.toFixed(2));



			var sp_gravity_2 = (((+sp5_1) + (+sp6_1)) / (+2));
			$('#sp_gravity_2').val(sp_gravity_2.toFixed(2));


			var sp_avg_2 = (((+sp5_2) + (+sp6_2)) / (+2));
			$('#sp_avg_2').val(sp_avg_2.toFixed(2));


			var sp_specific_gravity = (((+sp_specific_gravity_1) + (+sp_specific_gravity_2)) / (+2));
			$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));

			var sp_water_abr = (((+sp_water_abr_1) + (+sp_water_abr_2)) / (+2));
			$('#sp_water_abr').val(sp_water_abr.toFixed(2));


			var sp_specific_gravity2_1 = (((+sp_specific_gravity_3) + (+sp_specific_gravity_4)) / (+2));
			$('#sp_specific_gravity2_1').val(sp_specific_gravity2_1.toFixed(2));


			var sp_water_abr1_1 = (((+sp_water_abr_3) + (+sp_water_abr_4)) / (+2));
			$('#sp_water_abr1_1').val(sp_water_abr1_1.toFixed(2));


			var sp_specific_gravity2_2 = (((+sp_specific_gravity_5) + (+sp_specific_gravity_6)) / (+2));
			$('#sp_specific_gravity2_2').val(sp_specific_gravity2_2.toFixed(2));


			var sp_water_abr2_1 = (((+sp_water_abr_5) + (+sp_water_abr_6)) / (+2));
			$('#sp_water_abr2_1').val(sp_water_abr2_1.toFixed(2));





		}

		$('#chk_sp').change(function() {
			if (this.checked) {
				sp_auto();

			} else {

				$('#sp_w_sur_1').val(null);
				$('#sp_w_s_1').val(null);
				$('#sp_wt_st_1').val(null);


				$('#sp_w_sur_2').val(null);
				$('#sp_w_s_2').val(null);
				$('#sp_wt_st_2').val(null);

				$('#sp_specific_gravity_1').val(null);
				$('#sp_specific_gravity_2').val(null);
				$('#sp_specific_gravity').val(null);
				$('#sp_water_abr_1').val(null);
				$('#sp_water_abr_2').val(null);
				$('#sp_water_abr').val(null);
				$('#sp_wt_py1_1').val(null);
				$('#sp_wt_py2_1').val(null);
				$('#sp_wt_py1_2').val(null);
				$('#sp_wt_py2_2').val(null);


				$('#sam_1').val(null);
				$('#sam_2').val(null);
				$('#sam_3').val(null);
				$('#sam_4').val(null);
				$('#sam_5').val(null);
				$('#sam_6').val(null);
				$('#sp_wt_py1_3').val(null);
				$('#sp_wt_py1_4').val(null);
				$('#sp_wt_py1_5').val(null);
				$('#sp_wt_py1_6').val(null);
				$('#sp_wt_py2_3').val(null);
				$('#sp_wt_py2_4').val(null);
				$('#sp_wt_py2_5').val(null);
				$('#sp_wt_py2_6').val(null);
				$('#sp_wt_st_3').val(null);
				$('#sp_wt_st_4').val(null);
				$('#sp_wt_st_5').val(null);
				$('#sp_wt_st_6').val(null);
				$('#sp_w_s_3').val(null);
				$('#sp_w_s_4').val(null);
				$('#sp_w_s_5').val(null);
				$('#sp_w_s_6').val(null);
				$('#sp_w_sur_3').val(null);
				$('#sp_w_sur_4').val(null);
				$('#sp_w_sur_5').val(null);
				$('#sp_w_sur_6').val(null);
				$('#sp1_1').val(null);
				$('#sp1_2').val(null);
				$('#sp2_1').val(null);
				$('#sp2_2').val(null);
				$('#sp3_1').val(null);
				$('#sp3_2').val(null);
				$('#sp4_1').val(null);
				$('#sp4_2').val(null);
				$('#sp5_1').val(null);
				$('#sp5_2').val(null);
				$('#sp6_1').val(null);
				$('#sp6_2').val(null);
				$('#sp_specific_gravity_3').val(null);
				$('#sp_specific_gravity_4').val(null);
				$('#sp_specific_gravity_5').val(null);
				$('#sp_specific_gravity_6').val(null);
				$('#sp_water_abr_3').val(null);
				$('#sp_water_abr_4').val(null);
				$('#sp_water_abr_5').val(null);
				$('#sp_water_abr_6').val(null);
				$('#sp_specific_gravity2_1').val(null);
				$('#sp_specific_gravity2_2').val(null);
				$('#sp_water_abr1_1').val(null);
				$('#sp_water_abr2_1').val(null);
			}
		});




		function den_auto() {
			$('#txtden').css("background-color", "var(--success)");
			var bdl = randomNumberFromRange(1.62, 1.69).toFixed(2);
			var vol = 3.05;
			var avg_wom = parseFloat(bdl) * vol;
			var m21 = 2.70;
			var m22 = 2.70;
			var m23 = 2.70;

			var r1 = randomNumberFromRange(-0.20, 0.10).toFixed(2);
			var r2 = randomNumberFromRange(-0.30, 0.10).toFixed(2);
			var r3 = randomNumberFromRange(-0.10, 0.10).toFixed(2);


			var wom1 = (+avg_wom) + (+r1);
			var wom2 = (+avg_wom) - ((+r1) + (+r3));
			var wom3 = (+avg_wom) + (+r3);

			var m11 = (+m21) + (+wom1);
			var m12 = (+m22) + (+wom2);
			var m13 = (+m23) + (+wom3);



			$('#bdl').val(bdl);
			$('#vol').val(vol);
			$('#avg_wom').val(avg_wom.toFixed(2));
			$('#avg_wom1').val(avg_wom.toFixed(2));

			$('#m11').val(m11.toFixed(2));
			$('#m12').val(m12.toFixed(2));
			$('#m13').val(m13.toFixed(2));
			$('#m21').val(m21.toFixed(2));
			$('#m22').val(m22.toFixed(2));
			$('#m23').val(m23.toFixed(2));

			$('#wom1').val(wom1.toFixed(2));
			$('#wom2').val(wom2.toFixed(2));
			$('#wom3').val(wom3.toFixed(2));

		}


		$('#chk_den').change(function() {
			if (this.checked) {
				den_auto();


			} else {
				$('#bdl').val(null);
				$('#vol').val(null);
				$('#avg_wom').val(null);
				$('#m21').val(null);
				$('#m22').val(null);
				$('#m23').val(null);
				$('#m11').val(null);
				$('#m12').val(null);
				$('#m13').val(null);
				$('#wom1').val(null);
				$('#wom2').val(null);
				$('#wom3').val(null);
				$('#txtden').css("background-color", "white");


			}
		});

		function lbd_auto() {
			$('#txtlbd').css("background-color", "var(--success)");
			var lbd_bdl = randomNumberFromRange(1.62,1.69).toFixed(2);
			var lbd_vol = 3.05;
			var lbd_avg_wom = parseFloat((+lbd_bdl)) * lbd_vol;

			var lbd_m21 = 2.70;
			var lbd_m22 = 2.70;
			var lbd_m23 = 2.70;

			var lbd_r1 = randomNumberFromRange(-0.20,0.10).toFixed(2);
			var lbd_r2 = randomNumberFromRange(-0.30,0.10).toFixed(2);
			var lbd_r3 = randomNumberFromRange(-0.10,0.10).toFixed(2);


			var lbd_wom1 = (+lbd_avg_wom) + (+lbd_r1);
			var lbd_wom2 = (+lbd_avg_wom) - ((+lbd_r1) + (+lbd_r3));
			var lbd_wom3 = (+lbd_avg_wom) + (+lbd_r3);

			var lbd_m11 = (+lbd_m21) + (+lbd_wom1);
			var lbd_m12 = (+lbd_m22) + (+lbd_wom2);
			var lbd_m13 = (+lbd_m23) + (+lbd_wom3);



			$('#lbd_bdl').val(lbd_bdl);
			$('#lbd_vol').val(lbd_vol);
			$('#lbd_avg_wom').val(lbd_avg_wom.toFixed(2));			
			$('#lbd_avg_wom1').val(lbd_avg_wom.toFixed(2));			

			$('#lbd_m11').val(lbd_m11.toFixed(2));
			$('#lbd_m12').val(lbd_m12.toFixed(2));
			$('#lbd_m13').val(lbd_m13.toFixed(2));
			$('#lbd_m21').val(lbd_m21.toFixed(2));
			$('#lbd_m22').val(lbd_m22.toFixed(2));
			$('#lbd_m23').val(lbd_m23.toFixed(2));

			$('#lbd_wom1').val(lbd_wom1.toFixed(2));		
			$('#lbd_wom2').val(lbd_wom2.toFixed(2));		
			$('#lbd_wom3').val(lbd_wom3.toFixed(2));		

			
			var bulk1 = ((+lbd_avg_wom) / (+lbd_m11));
			$('#bulk1').val(bulk1.toFixed(2));



			var bulk2 = ((+lbd_vol) / (+lbd_m12));
			$('#bulk2').val(bulk2.toFixed(2));



			var bulk3 = ((+lbd_avg_wom1) / (+lbd_m13));
			$('#bulk3').val(bulk3.toFixed(2));


		
		
		}


		$('#chk_lbd').change(function() {
			if (this.checked) {
				lbd_auto();


			} else {
				$('#txtlbd').css("background-color", "white");
				$('#lbd_bdl').val(null);
				$('#lbd_vol').val(null);
				$('#lbd_avg_wom').val(null);
				$('#lbd_m21').val(null);
				$('#lbd_m22').val(null);
				$('#lbd_m23').val(null);
				$('#lbd_m11').val(null);
				$('#lbd_m12').val(null);
				$('#lbd_m13').val(null);
				$('#lbd_wom1').val(null);
				$('#lbd_wom2').val(null);
				$('#lbd_wom3').val(null);
				$('#lbd_avg_wom1').val(null);


				$('#sample_taken1').val(null);
				$('#bulk1').val(null);
				$('#bulk2').val(null);
				$('#bulk3').val(null);



			}
		});


		function bulk_den() {
			$('#txtden').css("background-color", "var(--success)");
			if ($("#chk_den").is(':checked')) {
				var bdl = $('#bdl').val();
				var vol = 3.05;
				var avg_wom = (+bdl) * (+vol);
				var m21 = 2.70;
				var m22 = 2.70;
				var m23 = 2.70;

				var r1 = randomNumberFromRange(-0.20, 0.10).toFixed(2);
				var r2 = randomNumberFromRange(-0.30, 0.10).toFixed(2);
				var r3 = randomNumberFromRange(-0.10, 0.10).toFixed(2);


				var wom1 = (+avg_wom) + (+r1);
				var wom2 = (+avg_wom) - ((+r1) + (+r3));
				var wom3 = (+avg_wom) + (+r3);

				var m11 = (+m21) + (+wom1);
				var m12 = (+m22) + (+wom2);
				var m13 = (+m23) + (+wom3);



				//$('#bdl').val(bdl.toString().substring(0, bdl.toString().indexOf(".") + 3));
				$('#vol').val(vol);
				$('#avg_wom').val(avg_wom.toFixed(2));
				$('#avg_wom1').val(avg_wom.toFixed(2));

				$('#m11').val(m11.toFixed(2));
				$('#m12').val(m12.toFixed(2));
				$('#m13').val(m13.toFixed(2));
				$('#m21').val(m21.toFixed(2));
				$('#m22').val(m22.toFixed(2));
				$('#m23').val(m23.toFixed(2));

				$('#wom1').val(wom1.toFixed(2));
				$('#wom2').val(wom2.toFixed(2));
				$('#wom3').val(wom3.toFixed(2));

			}
		}








		var sieve_1;
		var sieve_2;
		var sieve_3;
		var sieve_4;
		var sieve_5;
		var sieve_6;
		var sieve_7;


		function grd_auto() {
			sieve_1 = "10.00 (mm)";
			sieve_2 = "4.75 (mm)";
			sieve_3 = "2.36 (mm)";
			sieve_4 = "1.18 (mm)";
			sieve_5 = "0.600 (mm)";
			sieve_6 = "0.300 (mm)";
			sieve_7 = "0.150 (mm)";
			sieve_8 = "0.75 (mm)";

			var sample_taken = 1000;

			var grd_zone = $("#grd_zone").val();
			var silt_1 = 200;
			var silt_2 = randomNumberFromRange(196.2, 197.6).toFixed(1);
			var silt_content = ((((+silt_1) - (+silt_2)) * 100) / (+silt_2));
			if (grd_zone == "Zone I") {
				//PASSING RANGE
				var pass_sample_1 = randomNumberFromRange(100, 100);
				var pass_sample_2 = randomNumberFromRange(91.00, 99.00);
				var pass_sample_3 = randomNumberFromRange(65.00, 89.00);
				var pass_sample_4 = randomNumberFromRange(34.00, 63.00);
				var pass_sample_5 = randomNumberFromRange(18.00, 30.00);
				var pass_sample_6 = randomNumberFromRange(7.00, 16.00);
				var pass_sample_7 = randomNumberFromRange(0.50, 2.00);
				var pass_sample_8 = randomNumberFromRange(0.50, 2.00);

			} else if (grd_zone == "Zone II") {
				//PASSING RANGE
				var pass_sample_1 = randomNumberFromRange(100, 100);
				var pass_sample_2 = randomNumberFromRange(91.00, 99.00);
				var pass_sample_3 = randomNumberFromRange(80.00, 89.00);
				var pass_sample_4 = randomNumberFromRange(59.00, 78.00);
				var pass_sample_5 = randomNumberFromRange(36.00, 57.00);
				var pass_sample_6 = randomNumberFromRange(10.00, 29.00);
				var pass_sample_7 = randomNumberFromRange(0.50, 4.00);
				var pass_sample_8 = randomNumberFromRange(0.50, 4.00);

			} else if (grd_zone == "Zone III") {
				//PASSING RANGE
				var pass_sample_1 = randomNumberFromRange(100, 100);
				var pass_sample_2 = randomNumberFromRange(93.00, 99.00);
				var pass_sample_3 = randomNumberFromRange(86.00, 92.00);
				var pass_sample_4 = randomNumberFromRange(76.00, 85.00);
				var pass_sample_5 = randomNumberFromRange(61.00, 75.00);
				var pass_sample_6 = randomNumberFromRange(13.00, 39.00);
				var pass_sample_7 = randomNumberFromRange(0.50, 4.00);
				var pass_sample_8 = randomNumberFromRange(0.50, 4.00);

			} else if (grd_zone == "Zone IV") {
				//PASSING RANGE
				var pass_sample_1 = randomNumberFromRange(100, 100);
				var pass_sample_2 = randomNumberFromRange(98.00, 100.00);
				var pass_sample_3 = randomNumberFromRange(95.50, 97.50);
				var pass_sample_4 = randomNumberFromRange(90.50, 94.50);
				var pass_sample_5 = randomNumberFromRange(81.00, 90.00);
				var pass_sample_6 = randomNumberFromRange(16.00, 49.00);
				var pass_sample_7 = randomNumberFromRange(0.50, 6.00);
				var pass_sample_8 = randomNumberFromRange(0.50, 6.00);

			}

			$('#pass_sample_1').val(pass_sample_1.toFixed(2));
			$('#pass_sample_2').val(pass_sample_2.toFixed(2));
			$('#pass_sample_3').val(pass_sample_3.toFixed(2));
			$('#pass_sample_4').val(pass_sample_4.toFixed(2));
			$('#pass_sample_5').val(pass_sample_5.toFixed(2));
			$('#pass_sample_6').val(pass_sample_6.toFixed(2));
			$('#pass_sample_7').val(pass_sample_7.toFixed(2));
			$('#pass_sample_8').val(pass_sample_8.toFixed(2));

			var pass_sample1 = $('#pass_sample_1').val();
			var pass_sample2 = $('#pass_sample_2').val();
			var pass_sample3 = $('#pass_sample_3').val();
			var pass_sample4 = $('#pass_sample_4').val();
			var pass_sample5 = $('#pass_sample_5').val();
			var pass_sample6 = $('#pass_sample_6').val();
			var pass_sample7 = $('#pass_sample_7').val();
			var pass_sample8 = $('#pass_sample_8').val();



			//(100 - PASSING SAMPLE)
			var cum_ret_1 = 100 - (+pass_sample1);
			var cum_ret_2 = 100 - (+pass_sample2);
			var cum_ret_3 = 100 - (+pass_sample3);
			var cum_ret_4 = 100 - (+pass_sample4);
			var cum_ret_5 = 100 - (+pass_sample5);
			var cum_ret_6 = 100 - (+pass_sample6);
			var cum_ret_7 = 100 - (+pass_sample7);
			var cum_ret_8 = 100 - (+pass_sample8);

			$('#cum_ret_1').val(cum_ret_1.toFixed(2));
			$('#cum_ret_2').val(cum_ret_2.toFixed(2));
			$('#cum_ret_3').val(cum_ret_3.toFixed(2));
			$('#cum_ret_4').val(cum_ret_4.toFixed(2));
			$('#cum_ret_5').val(cum_ret_5.toFixed(2));
			$('#cum_ret_6').val(cum_ret_6.toFixed(2));
			$('#cum_ret_7').val(cum_ret_7.toFixed(2));
			$('#cum_ret_8').val(cum_ret_8.toFixed(2));

			var cum_ret1 = $('#cum_ret_1').val();
			var cum_ret2 = $('#cum_ret_2').val();
			var cum_ret3 = $('#cum_ret_3').val();
			var cum_ret4 = $('#cum_ret_4').val();
			var cum_ret5 = $('#cum_ret_5').val();
			var cum_ret6 = $('#cum_ret_6').val();
			var cum_ret7 = $('#cum_ret_7').val();
			var cum_ret8 = $('#cum_ret_8').val();




			//(CUMRET*100)
			var ret_wt_gm_1 = ((+cum_ret1) * (+sample_taken)) / 100;
			var ret_wt_gm_2 = ((+cum_ret2) * (+sample_taken)) / 100;
			var ret_wt_gm_3 = ((+cum_ret3) * (+sample_taken)) / 100;
			var ret_wt_gm_4 = ((+cum_ret4) * (+sample_taken)) / 100;
			var ret_wt_gm_5 = ((+cum_ret5) * (+sample_taken)) / 100;
			var ret_wt_gm_6 = ((+cum_ret6) * (+sample_taken)) / 100;
			var ret_wt_gm_7 = ((+cum_ret7) * (+sample_taken)) / 100;
			var ret_wt_gm_8 = ((+cum_ret8) * (+sample_taken)) / 100;

			$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed());
			$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed());
			$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed());
			$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed());
			$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed());
			$('#ret_wt_gm_6').val(ret_wt_gm_6.toFixed());
			$('#ret_wt_gm_7').val(ret_wt_gm_7.toFixed());
			$('#ret_wt_gm_8').val(ret_wt_gm_8.toFixed());

			var ret_wt_gm1 = $('#ret_wt_gm_1').val();
			var ret_wt_gm2 = $('#ret_wt_gm_2').val();
			var ret_wt_gm3 = $('#ret_wt_gm_3').val();
			var ret_wt_gm4 = $('#ret_wt_gm_4').val();
			var ret_wt_gm5 = $('#ret_wt_gm_5').val();
			var ret_wt_gm6 = $('#ret_wt_gm_6').val();
			var ret_wt_gm7 = $('#ret_wt_gm_7').val();
			var ret_wt_gm8 = $('#ret_wt_gm_8').val();


			//MINUS PLUS
			var cum_wt_gm_1 = ret_wt_gm1;
			var cum_wt_gm_2 = (+ret_wt_gm2) - (+ret_wt_gm1);
			var cum_wt_gm_3 = (+ret_wt_gm3) - (+ret_wt_gm2);
			var cum_wt_gm_4 = (+ret_wt_gm4) - (+ret_wt_gm3);
			var cum_wt_gm_5 = (+ret_wt_gm5) - (+ret_wt_gm4);
			var cum_wt_gm_6 = (+ret_wt_gm6) - (+ret_wt_gm5);
			var cum_wt_gm_7 = (+ret_wt_gm7) - (+ret_wt_gm6);
			var cum_wt_gm_8 = (+ret_wt_gm8) - (+ret_wt_gm7);

			$('#cum_wt_gm_1').val(cum_wt_gm_1);
			$('#cum_wt_gm_2').val((+cum_wt_gm_2).toFixed(1));
			$('#cum_wt_gm_3').val((+cum_wt_gm_3).toFixed(1));
			$('#cum_wt_gm_4').val((+cum_wt_gm_4).toFixed(1));
			$('#cum_wt_gm_5').val((+cum_wt_gm_5).toFixed(1));
			$('#cum_wt_gm_6').val((+cum_wt_gm_6).toFixed(1));
			$('#cum_wt_gm_7').val((+cum_wt_gm_7).toFixed(1));
			$('#cum_wt_gm_8').val((+cum_wt_gm_8).toFixed(1));

			var cum_wt_gm1 = $('#cum_wt_gm_1').val();
			var cum_wt_gm2 = $('#cum_wt_gm_2').val();
			var cum_wt_gm3 = $('#cum_wt_gm_3').val();
			var cum_wt_gm4 = $('#cum_wt_gm_4').val();
			var cum_wt_gm5 = $('#cum_wt_gm_5').val();
			var cum_wt_gm6 = $('#cum_wt_gm_6').val();
			var cum_wt_gm7 = $('#cum_wt_gm_7').val();
			var cum_wt_gm8 = $('#cum_wt_gm_8').val();


			var sums = (+cum_ret2) + (+cum_ret3) + (+cum_ret4) + (+cum_ret5) + (+cum_ret6) + (+cum_ret7);
			var ans = (+sums) / 100;
			$('#grd_fm').val(ans.toFixed(2));




			//(SUM OF CUM. WAIGHT)
			var blank_extra = (+cum_wt_gm_1) + (+cum_wt_gm_2) + (+cum_wt_gm_3) + (+cum_wt_gm_4) + (+cum_wt_gm_5) + (+cum_wt_gm_6) + (+cum_wt_gm_7);
			$('#blank_extra').val(blank_extra.toFixed());
			$('#sample_taken').val(sample_taken);
			$('#silt_1').val(silt_1);
			$('#silt_2').val(silt_2);
			$('#silt_content').val(silt_content.toFixed(2));


			var sampletaken1 = $('#sample_taken').val();
			var cum_wtgm1 = $('#cum_wt_gm_1').val();
			var cum_wtgm2 = $('#cum_wt_gm_2').val();
			var cum_wtgm3 = $('#cum_wt_gm_3').val();
			var cum_wtgm4 = $('#cum_wt_gm_4').val();
			var cum_wtgm5 = $('#cum_wt_gm_5').val();
			var cum_wtgm6 = $('#cum_wt_gm_6').val();
			var cum_wtgm7 = $('#cum_wt_gm_7').val();
			var cum_wtgm8 = $('#cum_wt_gm_8').val();

			//MINUS PLUS
			var ret_wtgm1 = cum_wtgm1;
			var ret_wtgm2 = (+cum_wtgm2) + (+ret_wtgm1);
			var ret_wtgm3 = (+cum_wtgm3) + (+ret_wtgm2);
			var ret_wtgm4 = (+cum_wtgm4) + (+ret_wtgm3);
			var ret_wtgm5 = (+cum_wtgm5) + (+ret_wtgm4);
			var ret_wtgm6 = (+cum_wtgm6) + (+ret_wtgm5);
			var ret_wtgm7 = (+cum_wtgm7) + (+ret_wtgm6);
			var ret_wtgm8 = (+cum_wtgm8) + (+ret_wtgm7);

			$('#ret_wt_gm_1').val(ret_wtgm1);
			$('#ret_wt_gm_2').val((+ret_wtgm2).toFixed(1));
			$('#ret_wt_gm_3').val((+ret_wtgm3).toFixed(1));
			$('#ret_wt_gm_4').val((+ret_wtgm4).toFixed(1));
			$('#ret_wt_gm_5').val((+ret_wtgm5).toFixed(1));
			$('#ret_wt_gm_6').val((+ret_wtgm6).toFixed(1));
			$('#ret_wt_gm_7').val((+ret_wtgm7).toFixed(1));
			$('#ret_wt_gm_8').val((+ret_wtgm8).toFixed(1));

			var blank_extra = (+cum_wtgm1) + (+cum_wtgm2) + (+cum_wtgm3) + (+cum_wtgm4) + (+cum_wtgm5) + (+cum_wtgm6) + (+cum_wtgm7);
			$('#blank_extra').val(blank_extra.toFixed());

			var ret_wtgm1 = $('#ret_wt_gm_1').val();
			var ret_wtgm2 = $('#ret_wt_gm_2').val();
			var ret_wtgm3 = $('#ret_wt_gm_3').val();
			var ret_wtgm4 = $('#ret_wt_gm_4').val();
			var ret_wtgm5 = $('#ret_wt_gm_5').val();
			var ret_wtgm6 = $('#ret_wt_gm_6').val();
			var ret_wtgm7 = $('#ret_wt_gm_7').val();
			var ret_wtgm8 = $('#ret_wt_gm_8').val();

			var cumret1 = ((+ret_wtgm1) / (+sampletaken1)) * 100;
			var cumret2 = ((+ret_wtgm2) / (+sampletaken1)) * 100;
			var cumret3 = ((+ret_wtgm3) / (+sampletaken1)) * 100;
			var cumret4 = ((+ret_wtgm4) / (+sampletaken1)) * 100;
			var cumret5 = ((+ret_wtgm5) / (+sampletaken1)) * 100;
			var cumret6 = ((+ret_wtgm6) / (+sampletaken1)) * 100;
			var cumret7 = ((+ret_wtgm7) / (+sampletaken1)) * 100;
			var cumret8 = ((+ret_wtgm8) / (+sampletaken1)) * 100;

			$('#cum_ret_1').val(cumret1.toFixed(2));
			$('#cum_ret_2').val(cumret2.toFixed(2));
			$('#cum_ret_3').val(cumret3.toFixed(2));
			$('#cum_ret_4').val(cumret4.toFixed(2));
			$('#cum_ret_5').val(cumret5.toFixed(2));
			$('#cum_ret_6').val(cumret6.toFixed(2));
			$('#cum_ret_7').val(cumret7.toFixed(2));

			var cum__ret1 = $('#cum_ret_1').val();
			var cum__ret2 = $('#cum_ret_2').val();
			var cum__ret3 = $('#cum_ret_3').val();
			var cum__ret4 = $('#cum_ret_4').val();
			var cum__ret5 = $('#cum_ret_5').val();
			var cum__ret6 = $('#cum_ret_6').val();
			var cum__ret7 = $('#cum_ret_7').val();
			var cum__ret8 = $('#cum_ret_8').val();

			var passsample1 = 100.00;
			var passsample2 = (+100.00) - (+cum__ret2);
			var passsample3 = (+100.00) - (+cum__ret3);
			var passsample4 = (+100.00) - (+cum__ret4);
			var passsample5 = (+100.00) - (+cum__ret5);
			var passsample6 = (+100.00) - (+cum__ret6);
			var passsample7 = (+100.00) - (+cum__ret7);

			$('#pass_sample_1').val(passsample1);
			$('#pass_sample_2').val(passsample2.toFixed(2));
			$('#pass_sample_3').val(passsample3.toFixed(2));
			$('#pass_sample_4').val(passsample4.toFixed(2));
			$('#pass_sample_5').val(passsample5.toFixed(2));
			$('#pass_sample_6').val(passsample6.toFixed(2));
			$('#pass_sample_7').val(passsample7.toFixed(2));

			var sums = (+cum__ret2) + (+cum__ret3) + (+cum__ret4) + (+cum__ret5) + (+cum__ret6) + (+cum__ret7);
			var ans = (+sums) / 100;
			$('#grd_fm').val(ans.toFixed(2));
		}

		$('#chk_grd').change(function() {
			if (this.checked) {
				grd_auto();

			} else {
				$('#cum_wt_gm_1').val(null);
				$('#cum_wt_gm_2').val(null);
				$('#cum_wt_gm_3').val(null);
				$('#cum_wt_gm_4').val(null);
				$('#cum_wt_gm_5').val(null);
				$('#cum_wt_gm_6').val(null);
				$('#cum_wt_gm_7').val(null);
				$('#cum_wt_gm_8').val(null);


				$('#ret_wt_gm_1').val(null);
				$('#ret_wt_gm_2').val(null);
				$('#ret_wt_gm_3').val(null);
				$('#ret_wt_gm_4').val(null);
				$('#ret_wt_gm_5').val(null);
				$('#ret_wt_gm_6').val(null);
				$('#ret_wt_gm_7').val(null);
				$('#ret_wt_gm_8').val(null);



				$('#cum_ret_1').val(null);
				$('#cum_ret_2').val(null);
				$('#cum_ret_3').val(null);
				$('#cum_ret_4').val(null);
				$('#cum_ret_5').val(null);
				$('#cum_ret_6').val(null);
				$('#cum_ret_7').val(null);
				$('#cum_ret_8').val(null);


				$('#pass_sample_1').val(null);
				$('#pass_sample_2').val(null);
				$('#pass_sample_3').val(null);
				$('#pass_sample_4').val(null);
				$('#pass_sample_5').val(null);
				$('#pass_sample_6').val(null);
				$('#pass_sample_7').val(null);
				$('#pass_sample_8').val(null);


				$('#blank_extra').val(null);
				$('#sample_taken').val(null);
				$('#grd_fm').val(null);
				$('#silt_1').val(null);
				$('#silt_2').val(null);
				$('#silt_content').val(null);
			}
		});


		$('#sample_taken').change(function() {
			$('#txtgrd').css("background-color", "var(--success)");
			if ($("#chk_grd").is(':checked')) {
				grds_func();
			}
		});



		function grds_func() {

			$('#txtgrd').css("background-color", "var(--success)");
			sieve_1 = "10.00 (mm)";
			sieve_2 = "4.75 (mm)";
			sieve_3 = "2.36 (mm)";
			sieve_4 = "1.18 (mm)";
			sieve_5 = "0.600 (mm)";
			sieve_6 = "0.300 (mm)";
			sieve_7 = "0.150 (mm)";

			var sample_taken = $('#sample_taken').val();
			//PASSING RANGE


			var pass_sample1 = $('#pass_sample_1').val();
			var pass_sample2 = $('#pass_sample_2').val();
			var pass_sample3 = $('#pass_sample_3').val();
			var pass_sample4 = $('#pass_sample_4').val();
			var pass_sample5 = $('#pass_sample_5').val();
			var pass_sample6 = $('#pass_sample_6').val();
			var pass_sample7 = $('#pass_sample_7').val();


			//(100 - PASSING SAMPLE)
			var cum_ret_1 = 100 - (+pass_sample1);
			var cum_ret_2 = 100 - (+pass_sample2);
			var cum_ret_3 = 100 - (+pass_sample3);
			var cum_ret_4 = 100 - (+pass_sample4);
			var cum_ret_5 = 100 - (+pass_sample5);
			var cum_ret_6 = 100 - (+pass_sample6);
			var cum_ret_7 = 100 - (+pass_sample7);

			$('#cum_ret_1').val(cum_ret_1.toFixed(2));
			$('#cum_ret_2').val(cum_ret_2.toFixed(2));
			$('#cum_ret_3').val(cum_ret_3.toFixed(2));
			$('#cum_ret_4').val(cum_ret_4.toFixed(2));
			$('#cum_ret_5').val(cum_ret_5.toFixed(2));
			$('#cum_ret_6').val(cum_ret_6.toFixed(2));
			$('#cum_ret_7').val(cum_ret_7.toFixed(2));

			var cum_ret1 = $('#cum_ret_1').val();
			var cum_ret2 = $('#cum_ret_2').val();
			var cum_ret3 = $('#cum_ret_3').val();
			var cum_ret4 = $('#cum_ret_4').val();
			var cum_ret5 = $('#cum_ret_5').val();
			var cum_ret6 = $('#cum_ret_6').val();
			var cum_ret7 = $('#cum_ret_7').val();




			//(CUMRET*100)
			var ret_wt_gm_1 = ((+cum_ret1) * (+sample_taken)) / 100;
			var ret_wt_gm_2 = ((+cum_ret2) * (+sample_taken)) / 100;
			var ret_wt_gm_3 = ((+cum_ret3) * (+sample_taken)) / 100;
			var ret_wt_gm_4 = ((+cum_ret4) * (+sample_taken)) / 100;
			var ret_wt_gm_5 = ((+cum_ret5) * (+sample_taken)) / 100;
			var ret_wt_gm_6 = ((+cum_ret6) * (+sample_taken)) / 100;
			var ret_wt_gm_7 = ((+cum_ret7) * (+sample_taken)) / 100;

			$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed());
			$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed());
			$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed());
			$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed());
			$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed());
			$('#ret_wt_gm_6').val(ret_wt_gm_6.toFixed());
			$('#ret_wt_gm_7').val(ret_wt_gm_7.toFixed());

			var ret_wt_gm1 = $('#ret_wt_gm_1').val();
			var ret_wt_gm2 = $('#ret_wt_gm_2').val();
			var ret_wt_gm3 = $('#ret_wt_gm_3').val();
			var ret_wt_gm4 = $('#ret_wt_gm_4').val();
			var ret_wt_gm5 = $('#ret_wt_gm_5').val();
			var ret_wt_gm6 = $('#ret_wt_gm_6').val();
			var ret_wt_gm7 = $('#ret_wt_gm_7').val();


			//MINUS PLUS
			var cum_wt_gm_1 = ret_wt_gm1;
			var cum_wt_gm_2 = (+ret_wt_gm2) - (+ret_wt_gm1);
			var cum_wt_gm_3 = (+ret_wt_gm3) - (+ret_wt_gm2);
			var cum_wt_gm_4 = (+ret_wt_gm4) - (+ret_wt_gm3);
			var cum_wt_gm_5 = (+ret_wt_gm5) - (+ret_wt_gm4);
			var cum_wt_gm_6 = (+ret_wt_gm6) - (+ret_wt_gm5);
			var cum_wt_gm_7 = (+ret_wt_gm7) - (+ret_wt_gm6);

			$('#cum_wt_gm_1').val(cum_wt_gm_1);
			$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed());
			$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed());
			$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed());
			$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed());
			$('#cum_wt_gm_6').val(cum_wt_gm_6.toFixed());
			$('#cum_wt_gm_7').val(cum_wt_gm_7.toFixed());

			var cum_wt_gm1 = $('#cum_wt_gm_1').val();
			var cum_wt_gm2 = $('#cum_wt_gm_2').val();
			var cum_wt_gm3 = $('#cum_wt_gm_3').val();
			var cum_wt_gm4 = $('#cum_wt_gm_4').val();
			var cum_wt_gm5 = $('#cum_wt_gm_5').val();
			var cum_wt_gm6 = $('#cum_wt_gm_6').val();
			var cum_wt_gm7 = $('#cum_wt_gm_7').val();


			var sums = (+cum_ret2) + (+cum_ret3) + (+cum_ret4) + (+cum_ret5) + (+cum_ret6) + (+cum_ret7);
			var ans = (+sums) / 100;
			$('#grd_fm').val(ans.toFixed(2));




			//(SUM OF CUM. WAIGHT)
			var blank_extra = (+cum_wt_gm_1) + (+cum_wt_gm_2) + (+cum_wt_gm_3) + (+cum_wt_gm_4) + (+cum_wt_gm_5) + (+cum_wt_gm_6) + (+cum_wt_gm_7);
			$('#blank_extra').val(blank_extra.toFixed());
			$('#sample_taken').val(sample_taken);
			//$('#silt_1').val(silt_1.toFixed(2));
			// $('#silt_2').val(silt_2.toFixed(2));
			// $('#silt_content').val(silt_content.toFixed(2));


			var sampletaken1 = $('#sample_taken').val();
			var cum_wtgm1 = $('#cum_wt_gm_1').val();
			var cum_wtgm2 = $('#cum_wt_gm_2').val();
			var cum_wtgm3 = $('#cum_wt_gm_3').val();
			var cum_wtgm4 = $('#cum_wt_gm_4').val();
			var cum_wtgm5 = $('#cum_wt_gm_5').val();
			var cum_wtgm6 = $('#cum_wt_gm_6').val();
			var cum_wtgm7 = $('#cum_wt_gm_7').val();

			//MINUS PLUS
			var ret_wtgm1 = cum_wtgm1;
			var ret_wtgm2 = (+cum_wtgm2) + (+ret_wtgm1);
			var ret_wtgm3 = (+cum_wtgm3) + (+ret_wtgm2);
			var ret_wtgm4 = (+cum_wtgm4) + (+ret_wtgm3);
			var ret_wtgm5 = (+cum_wtgm5) + (+ret_wtgm4);
			var ret_wtgm6 = (+cum_wtgm6) + (+ret_wtgm5);
			var ret_wtgm7 = (+cum_wtgm7) + (+ret_wtgm6);

			$('#ret_wt_gm_1').val(ret_wtgm1);
			$('#ret_wt_gm_2').val(ret_wtgm2.toFixed());
			$('#ret_wt_gm_3').val(ret_wtgm3.toFixed());
			$('#ret_wt_gm_4').val(ret_wtgm4.toFixed());
			$('#ret_wt_gm_5').val(ret_wtgm5.toFixed());
			$('#ret_wt_gm_6').val(ret_wtgm6.toFixed());
			$('#ret_wt_gm_7').val(ret_wtgm7.toFixed());

			var blank_extra = (+cum_wtgm1) + (+cum_wtgm2) + (+cum_wtgm3) + (+cum_wtgm4) + (+cum_wtgm5) + (+cum_wtgm6) + (+cum_wtgm7);
			$('#blank_extra').val(blank_extra.toFixed());

			var ret_wtgm1 = $('#ret_wt_gm_1').val();
			var ret_wtgm2 = $('#ret_wt_gm_2').val();
			var ret_wtgm3 = $('#ret_wt_gm_3').val();
			var ret_wtgm4 = $('#ret_wt_gm_4').val();
			var ret_wtgm5 = $('#ret_wt_gm_5').val();
			var ret_wtgm6 = $('#ret_wt_gm_6').val();
			var ret_wtgm7 = $('#ret_wt_gm_7').val();

			var cumret1 = ((+ret_wtgm1) / (+sampletaken1)) * 100;
			var cumret2 = ((+ret_wtgm2) / (+sampletaken1)) * 100;
			var cumret3 = ((+ret_wtgm3) / (+sampletaken1)) * 100;
			var cumret4 = ((+ret_wtgm4) / (+sampletaken1)) * 100;
			var cumret5 = ((+ret_wtgm5) / (+sampletaken1)) * 100;
			var cumret6 = ((+ret_wtgm6) / (+sampletaken1)) * 100;
			var cumret7 = ((+ret_wtgm7) / (+sampletaken1)) * 100;

			$('#cum_ret_1').val(cumret1.toFixed(2));
			$('#cum_ret_2').val(cumret2.toFixed(2));
			$('#cum_ret_3').val(cumret3.toFixed(2));
			$('#cum_ret_4').val(cumret4.toFixed(2));
			$('#cum_ret_5').val(cumret5.toFixed(2));
			$('#cum_ret_6').val(cumret6.toFixed(2));
			$('#cum_ret_7').val(cumret7.toFixed(2));

			var cum__ret1 = $('#cum_ret_1').val();
			var cum__ret2 = $('#cum_ret_2').val();
			var cum__ret3 = $('#cum_ret_3').val();
			var cum__ret4 = $('#cum_ret_4').val();
			var cum__ret5 = $('#cum_ret_5').val();
			var cum__ret6 = $('#cum_ret_6').val();
			var cum__ret7 = $('#cum_ret_7').val();

			var passsample1 = 100.00;
			var passsample2 = (+100.00) - (+cum__ret2);
			var passsample3 = (+100.00) - (+cum__ret3);
			var passsample4 = (+100.00) - (+cum__ret4);
			var passsample5 = (+100.00) - (+cum__ret5);
			var passsample6 = (+100.00) - (+cum__ret6);
			var passsample7 = (+100.00) - (+cum__ret7);

			$('#pass_sample_1').val(passsample1);
			$('#pass_sample_2').val(passsample2.toFixed(2));
			$('#pass_sample_3').val(passsample3.toFixed(2));
			$('#pass_sample_4').val(passsample4.toFixed(2));
			$('#pass_sample_5').val(passsample5.toFixed(2));
			$('#pass_sample_6').val(passsample6.toFixed(2));
			$('#pass_sample_7').val(passsample7.toFixed(2));

			var sums = (+cum__ret2) + (+cum__ret3) + (+cum__ret4) + (+cum__ret5) + (+cum__ret6) + (+cum__ret7);
			var ans = (+sums) / 100;
			$('#grd_fm').val(ans.toFixed(2));
		}




		$("#grd_zone").change(function() {
			$('#txtgrd').css("background-color", "var(--success)");
			if ($("#chk_grd").is(':checked')) {

				sieve_1 = "10.00 (mm)";
				sieve_2 = "4.75 (mm)";
				sieve_3 = "2.36 (mm)";
				sieve_4 = "1.18 (mm)";
				sieve_5 = "0.600 (mm)";
				sieve_6 = "0.300 (mm)";
				sieve_7 = "0.150 (mm)";
				var sample_taken = 1000;

				grd_zone = $("#grd_zone").val();

				if (grd_zone == "Zone I") {
					//PASSING RANGE
					var pass_sample_1 = randomNumberFromRange(100, 100);
					var pass_sample_2 = randomNumberFromRange(91.00, 99.00);
					var pass_sample_3 = randomNumberFromRange(65.00, 89.00);
					var pass_sample_4 = randomNumberFromRange(34.00, 63.00);
					var pass_sample_5 = randomNumberFromRange(18.00, 30.00);
					var pass_sample_6 = randomNumberFromRange(7.00, 16.00);
					var pass_sample_7 = randomNumberFromRange(0.50, 6.00);

				} else if (grd_zone == "Zone II") {
					//PASSING RANGE
					var pass_sample_1 = randomNumberFromRange(100, 100);
					var pass_sample_2 = randomNumberFromRange(91.00, 99.00);
					var pass_sample_3 = randomNumberFromRange(80.00, 89.00);
					var pass_sample_4 = randomNumberFromRange(59.00, 78.00);
					var pass_sample_5 = randomNumberFromRange(36.00, 57.00);
					var pass_sample_6 = randomNumberFromRange(10.00, 29.00);
					var pass_sample_7 = randomNumberFromRange(0.50, 8.00);

				} else if (grd_zone == "Zone III") {
					//PASSING RANGE
					var pass_sample_1 = randomNumberFromRange(100, 100);
					var pass_sample_2 = randomNumberFromRange(93.00, 99.00);
					var pass_sample_3 = randomNumberFromRange(86.00, 92.00);
					var pass_sample_4 = randomNumberFromRange(76.00, 85.00);
					var pass_sample_5 = randomNumberFromRange(61.00, 75.00);
					var pass_sample_6 = randomNumberFromRange(13.00, 39.00);
					var pass_sample_7 = randomNumberFromRange(0.50, 7.00);

				} else if (grd_zone == "Zone IV") {
					//PASSING RANGE
					var pass_sample_1 = randomNumberFromRange(100, 100);
					var pass_sample_2 = randomNumberFromRange(98.00, 100.00);
					var pass_sample_3 = randomNumberFromRange(95.50, 97.50);
					var pass_sample_4 = randomNumberFromRange(90.50, 94.50);
					var pass_sample_5 = randomNumberFromRange(81.00, 90.00);
					var pass_sample_6 = randomNumberFromRange(16.00, 49.00);
					var pass_sample_7 = randomNumberFromRange(0.50, 14.00);

				}

				$('#pass_sample_1').val(pass_sample_1.toFixed(2));
				$('#pass_sample_2').val(pass_sample_2.toFixed(2));
				$('#pass_sample_3').val(pass_sample_3.toFixed(2));
				$('#pass_sample_4').val(pass_sample_4.toFixed(2));
				$('#pass_sample_5').val(pass_sample_5.toFixed(2));
				$('#pass_sample_6').val(pass_sample_6.toFixed(2));
				$('#pass_sample_7').val(pass_sample_7.toFixed(2));

				var pass_sample1 = $('#pass_sample_1').val();
				var pass_sample2 = $('#pass_sample_2').val();
				var pass_sample3 = $('#pass_sample_3').val();
				var pass_sample4 = $('#pass_sample_4').val();
				var pass_sample5 = $('#pass_sample_5').val();
				var pass_sample6 = $('#pass_sample_6').val();
				var pass_sample7 = $('#pass_sample_7').val();



				//(100 - PASSING SAMPLE)
				var cum_ret_1 = 100 - (+pass_sample1);
				var cum_ret_2 = 100 - (+pass_sample2);
				var cum_ret_3 = 100 - (+pass_sample3);
				var cum_ret_4 = 100 - (+pass_sample4);
				var cum_ret_5 = 100 - (+pass_sample5);
				var cum_ret_6 = 100 - (+pass_sample6);
				var cum_ret_7 = 100 - (+pass_sample7);

				$('#cum_ret_1').val(cum_ret_1.toFixed(2));
				$('#cum_ret_2').val(cum_ret_2.toFixed(2));
				$('#cum_ret_3').val(cum_ret_3.toFixed(2));
				$('#cum_ret_4').val(cum_ret_4.toFixed(2));
				$('#cum_ret_5').val(cum_ret_5.toFixed(2));
				$('#cum_ret_6').val(cum_ret_6.toFixed(2));
				$('#cum_ret_7').val(cum_ret_7.toFixed(2));

				var cum_ret1 = $('#cum_ret_1').val();
				var cum_ret2 = $('#cum_ret_2').val();
				var cum_ret3 = $('#cum_ret_3').val();
				var cum_ret4 = $('#cum_ret_4').val();
				var cum_ret5 = $('#cum_ret_5').val();
				var cum_ret6 = $('#cum_ret_6').val();
				var cum_ret7 = $('#cum_ret_7').val();




				//(CUMRET*100)
				var ret_wt_gm_1 = ((+cum_ret1) * (+sample_taken)) / 100;
				var ret_wt_gm_2 = ((+cum_ret2) * (+sample_taken)) / 100;
				var ret_wt_gm_3 = ((+cum_ret3) * (+sample_taken)) / 100;
				var ret_wt_gm_4 = ((+cum_ret4) * (+sample_taken)) / 100;
				var ret_wt_gm_5 = ((+cum_ret5) * (+sample_taken)) / 100;
				var ret_wt_gm_6 = ((+cum_ret6) * (+sample_taken)) / 100;
				var ret_wt_gm_7 = ((+cum_ret7) * (+sample_taken)) / 100;

				$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed());
				$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed());
				$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed());
				$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed());
				$('#ret_wt_gm_5').val(ret_wt_gm_5.toFixed());
				$('#ret_wt_gm_6').val(ret_wt_gm_6.toFixed());
				$('#ret_wt_gm_7').val(ret_wt_gm_7.toFixed());

				var ret_wt_gm1 = $('#ret_wt_gm_1').val();
				var ret_wt_gm2 = $('#ret_wt_gm_2').val();
				var ret_wt_gm3 = $('#ret_wt_gm_3').val();
				var ret_wt_gm4 = $('#ret_wt_gm_4').val();
				var ret_wt_gm5 = $('#ret_wt_gm_5').val();
				var ret_wt_gm6 = $('#ret_wt_gm_6').val();
				var ret_wt_gm7 = $('#ret_wt_gm_7').val();


				//MINUS PLUS
				var cum_wt_gm_1 = ret_wt_gm1;
				var cum_wt_gm_2 = (+ret_wt_gm2) - (+ret_wt_gm1);
				var cum_wt_gm_3 = (+ret_wt_gm3) - (+ret_wt_gm2);
				var cum_wt_gm_4 = (+ret_wt_gm4) - (+ret_wt_gm3);
				var cum_wt_gm_5 = (+ret_wt_gm5) - (+ret_wt_gm4);
				var cum_wt_gm_6 = (+ret_wt_gm6) - (+ret_wt_gm5);
				var cum_wt_gm_7 = (+ret_wt_gm7) - (+ret_wt_gm6);

				$('#cum_wt_gm_1').val(cum_wt_gm_1);
				$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed());
				$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed());
				$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed());
				$('#cum_wt_gm_5').val(cum_wt_gm_5.toFixed());
				$('#cum_wt_gm_6').val(cum_wt_gm_6.toFixed());
				$('#cum_wt_gm_7').val(cum_wt_gm_7.toFixed());

				var cum_wt_gm1 = $('#cum_wt_gm_1').val();
				var cum_wt_gm2 = $('#cum_wt_gm_2').val();
				var cum_wt_gm3 = $('#cum_wt_gm_3').val();
				var cum_wt_gm4 = $('#cum_wt_gm_4').val();
				var cum_wt_gm5 = $('#cum_wt_gm_5').val();
				var cum_wt_gm6 = $('#cum_wt_gm_6').val();
				var cum_wt_gm7 = $('#cum_wt_gm_7').val();


				var sums = (+cum_ret2) + (+cum_ret3) + (+cum_ret4) + (+cum_ret5) + (+cum_ret6) + (+cum_ret7);
				var ans = (+sums) / 100;
				$('#grd_fm').val(ans.toFixed(2));




				//(SUM OF CUM. WAIGHT)
				var blank_extra = (+cum_wt_gm_1) + (+cum_wt_gm_2) + (+cum_wt_gm_3) + (+cum_wt_gm_4) + (+cum_wt_gm_5) + (+cum_wt_gm_6) + (+cum_wt_gm_7);
				$('#blank_extra').val(blank_extra.toFixed());
				$('#sample_taken').val(sample_taken.toFixed());
				// $('#silt_1').val(silt_1.toFixed(2));
				// $('#silt_2').val(silt_2.toFixed(2));
				// $('#silt_content').val(silt_content.toFixed(2));


				var sampletaken1 = $('#sample_taken').val();
				var cum_wtgm1 = $('#cum_wt_gm_1').val();
				var cum_wtgm2 = $('#cum_wt_gm_2').val();
				var cum_wtgm3 = $('#cum_wt_gm_3').val();
				var cum_wtgm4 = $('#cum_wt_gm_4').val();
				var cum_wtgm5 = $('#cum_wt_gm_5').val();
				var cum_wtgm6 = $('#cum_wt_gm_6').val();
				var cum_wtgm7 = $('#cum_wt_gm_7').val();

				//MINUS PLUS
				var ret_wtgm1 = cum_wtgm1;
				var ret_wtgm2 = (+cum_wtgm2) + (+ret_wtgm1);
				var ret_wtgm3 = (+cum_wtgm3) + (+ret_wtgm2);
				var ret_wtgm4 = (+cum_wtgm4) + (+ret_wtgm3);
				var ret_wtgm5 = (+cum_wtgm5) + (+ret_wtgm4);
				var ret_wtgm6 = (+cum_wtgm6) + (+ret_wtgm5);
				var ret_wtgm7 = (+cum_wtgm7) + (+ret_wtgm6);

				$('#ret_wt_gm_1').val(ret_wtgm1);
				$('#ret_wt_gm_2').val(ret_wtgm2.toFixed());
				$('#ret_wt_gm_3').val(ret_wtgm3.toFixed());
				$('#ret_wt_gm_4').val(ret_wtgm4.toFixed());
				$('#ret_wt_gm_5').val(ret_wtgm5.toFixed());
				$('#ret_wt_gm_6').val(ret_wtgm6.toFixed());
				$('#ret_wt_gm_7').val(ret_wtgm7.toFixed());

				var blank_extra = (+cum_wtgm1) + (+cum_wtgm2) + (+cum_wtgm3) + (+cum_wtgm4) + (+cum_wtgm5) + (+cum_wtgm6) + (+cum_wtgm7);
				$('#blank_extra').val(blank_extra.toFixed());

				var ret_wtgm1 = $('#ret_wt_gm_1').val();
				var ret_wtgm2 = $('#ret_wt_gm_2').val();
				var ret_wtgm3 = $('#ret_wt_gm_3').val();
				var ret_wtgm4 = $('#ret_wt_gm_4').val();
				var ret_wtgm5 = $('#ret_wt_gm_5').val();
				var ret_wtgm6 = $('#ret_wt_gm_6').val();
				var ret_wtgm7 = $('#ret_wt_gm_7').val();

				var cumret1 = ((+ret_wtgm1) / (+sampletaken1)) * 100;
				var cumret2 = ((+ret_wtgm2) / (+sampletaken1)) * 100;
				var cumret3 = ((+ret_wtgm3) / (+sampletaken1)) * 100;
				var cumret4 = ((+ret_wtgm4) / (+sampletaken1)) * 100;
				var cumret5 = ((+ret_wtgm5) / (+sampletaken1)) * 100;
				var cumret6 = ((+ret_wtgm6) / (+sampletaken1)) * 100;
				var cumret7 = ((+ret_wtgm7) / (+sampletaken1)) * 100;

				$('#cum_ret_1').val(cumret1.toFixed(2));
				$('#cum_ret_2').val(cumret2.toFixed(2));
				$('#cum_ret_3').val(cumret3.toFixed(2));
				$('#cum_ret_4').val(cumret4.toFixed(2));
				$('#cum_ret_5').val(cumret5.toFixed(2));
				$('#cum_ret_6').val(cumret6.toFixed(2));
				$('#cum_ret_7').val(cumret7.toFixed(2));

				var cum__ret1 = $('#cum_ret_1').val();
				var cum__ret2 = $('#cum_ret_2').val();
				var cum__ret3 = $('#cum_ret_3').val();
				var cum__ret4 = $('#cum_ret_4').val();
				var cum__ret5 = $('#cum_ret_5').val();
				var cum__ret6 = $('#cum_ret_6').val();
				var cum__ret7 = $('#cum_ret_7').val();

				var passsample1 = 100.00;
				var passsample2 = (+100.00) - (+cum__ret2);
				var passsample3 = (+100.00) - (+cum__ret3);
				var passsample4 = (+100.00) - (+cum__ret4);
				var passsample5 = (+100.00) - (+cum__ret5);
				var passsample6 = (+100.00) - (+cum__ret6);
				var passsample7 = (+100.00) - (+cum__ret7);

				$('#pass_sample_1').val(passsample1);
				$('#pass_sample_2').val(passsample2.toFixed(2));
				$('#pass_sample_3').val(passsample3.toFixed(2));
				$('#pass_sample_4').val(passsample4.toFixed(2));
				$('#pass_sample_5').val(passsample5.toFixed(2));
				$('#pass_sample_6').val(passsample6.toFixed(2));
				$('#pass_sample_7').val(passsample7.toFixed(2));

				var sums = (+cum__ret2) + (+cum__ret3) + (+cum__ret4) + (+cum__ret5) + (+cum__ret6) + (+cum__ret7);
				var ans = (+sums) / 100;
				$('#grd_fm').val(ans.toFixed(2));
			}
		});

		//Deleterias Material
		function dtm_auto() {
			$('#txtdtm').css("background-color", "var(--success)");

			var dele_1_1 = randomNumberFromRange(498.000, 503.000).toFixed(3);
			$('#dele_1_1').val(dele_1_1);
			var dele11 = $('#dele_1_1').val();


			var dele_1_2 = (+dele11) * (+randomNumberFromRange(0.9950, 0.9990).toFixed(4));
			$('#dele_1_2').val(dele_1_2.toFixed(3));
			var dele12 = $('#dele_1_2').val();

			var dele_1_3 = (+dele11) - (+dele12);
			$('#dele_1_3').val(dele_1_3.toFixed(3));
			var dele13 = $('#dele_1_3').val();

			var dele_1_4 = ((+dele13) / (+dele11)) * (+100);

			$('#dele_1_4').val(dele_1_4.toFixed(3));


			var dele_2_1 = randomNumberFromRange(498.000, 503.000).toFixed(3);
			$('#dele_2_1').val(dele_2_1);
			var dele21 = $('#dele_2_1').val();


			var dele_2_2 = (+dele21) * (+randomNumberFromRange(0.9990, 0.9995).toFixed(4));
			$('#dele_2_2').val(dele_2_2.toFixed(3));
			var dele22 = $('#dele_2_2').val();

			var dele_2_3 = (+dele21) - (+dele22);
			var dele_2_3 = ((+dele_2_3) / (+dele21)) * (+100);

			$('#dele_2_3').val(dele_2_3.toFixed(3));


			var dele_3_1 = randomNumberFromRange(498.000, 503.000).toFixed(3);
			$('#dele_3_1').val(dele_3_1);
			var dele31 = $('#dele_3_1').val();


			var dele_3_2 = (+dele31) * (+randomNumberFromRange(0.9999, 1.0000).toFixed(4));
			$('#dele_3_2').val(dele_3_2.toFixed(3));
			var dele32 = $('#dele_3_2').val();

			var dele_3_3 = (+dele31) - (+dele32);
			var dele_3_3 = ((+dele_3_3) / (+dele31)) * (+100);

			$('#dele_3_3').val(dele_3_3.toFixed(3));


			var dele_4_1 = randomNumberFromRange(498.000, 503.000).toFixed(3);
			$('#dele_4_1').val(dele_4_1);
			var dele41 = $('#dele_4_1').val();


			var dele_4_2 = (+dele41) * (+randomNumberFromRange(0.9990, 0.9995).toFixed(4));
			$('#dele_4_2').val(dele_4_2.toFixed(3));
			var dele42 = $('#dele_4_2').val();

			var dele_4_3 = (+dele41) - (+dele42);
			var dele_4_3 = ((+dele_4_3) / (+dele41)) * (+100);

			$('#dele_4_3').val(dele_4_3.toFixed(3));


		}
		
			

		$('#chk_dtm').change(function() {
			if (this.checked) {
				dtm_auto();
			} else {
				$('#txtdtm').css("background-color", "#fff");
				$('#avg_dtm').val(null);
			}
		});
		
		$('#finer_a,#finer_b').change(function(){
			
			var finer_a = $('#finer_a').val();
			var finer_b = $('#finer_b').val();
			
			var avg_finer = (((+finer_a) - (+finer_b))/(+finer_a)*100);
			$('#avg_finer').val(avg_finer.toFixed(2));
		});



		$('#chk_auto').change(function() {
			if (this.checked) {
				//$('#txtabr').css("background-color","var(--success)"); 
				//$('#txtwtr').css("background-color","var(--success)"); 


				var temp = $('#test_list').val();
				var aa = temp.split(",");
				//grd
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "grd") {
						$('#txtgrd').css("background-color", "var(--success)");
						$("#chk_grd").prop("checked", true);
						grd_auto();
						break;
					}
				}

				//density
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "den") {

						$("#chk_den").prop("checked", true);
						den_auto();
						break;
					}
				}
				//Loose density
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "lbd") {

						$("#chk_lbd").prop("checked", true);
						lbd_auto();
						break;
					}
				}

				//Deleterias Material
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "dtm") {
						$("#chk_dtm").prop("checked", true);
						dtm_auto();
						break;
					}
				}

				//SPG
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "wtr") {
						$('#txtwtr').css("background-color", "var(--success)");
						$("#chk_sp").prop("checked", true);
						sp_auto();
						break;
					}
				}

				//DENSITY
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "fne") {

						$("#chk_finer").prop("checked", true);
						finer_auto();
						break;
					}
				}
				//soundness
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sou") {

						$("#chk_sou").prop("checked", true);
						soundness_auto();
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
			url: '<?php echo $base_url; ?>save_sand.php',
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
			var tag_heading = $('#tag_heading').val();
			var tag_data = $('#tag_data').val();
			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//GRADATION
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "grd") {
					if (document.getElementById('chk_grd').checked) {
						var chk_grd = "1";
					} else {
						var chk_grd = "0";
					}
					var chk_fm = "1";
					var grd_fm = $('#grd_fm').val();
					var sieve_1 = "10 (mm)";
					var sieve_2 = "4.75 (mm)";
					var sieve_3 = "2.36 (mm)";
					var sieve_4 = "1.18 (mm)";
					var sieve_5 = "0.600 (mm)";
					var sieve_6 = "0.300 (mm)";
					var sieve_7 = "0.150 (mm)";

					var sample_taken = $('#sample_taken').val();
					var blank_extra = $('#blank_extra').val();
					var grd_zone = $('#grd_zone').val();
					var silt_content = $('#silt_content').val();
					var silt_1 = $('#silt_1').val();
					var silt_2 = $('#silt_2').val();
					var chk_silt = "1";
					var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
					var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
					var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
					var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
					var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
					var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
					var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
					var cum_wt_gm_8 = $('#cum_wt_gm_8').val();

					var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
					var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
					var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
					var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
					var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
					var ret_wt_gm_6 = $('#ret_wt_gm_6').val();
					var ret_wt_gm_7 = $('#ret_wt_gm_7').val();
					var ret_wt_gm_8 = $('#ret_wt_gm_8').val();

					var cum_ret_1 = $('#cum_ret_1').val();
					var cum_ret_2 = $('#cum_ret_2').val();
					var cum_ret_3 = $('#cum_ret_3').val();
					var cum_ret_4 = $('#cum_ret_4').val();
					var cum_ret_5 = $('#cum_ret_5').val();
					var cum_ret_6 = $('#cum_ret_6').val();
					var cum_ret_7 = $('#cum_ret_7').val();
					var cum_ret_8 = $('#cum_ret_8').val();

					var pass_sample_1 = $('#pass_sample_1').val();
					var pass_sample_2 = $('#pass_sample_2').val();
					var pass_sample_3 = $('#pass_sample_3').val();
					var pass_sample_4 = $('#pass_sample_4').val();
					var pass_sample_5 = $('#pass_sample_5').val();
					var pass_sample_6 = $('#pass_sample_6').val();
					var pass_sample_7 = $('#pass_sample_7').val();
					var pass_sample_8 = $('#pass_sample_8').val();

					break;
				} else {
					var chk_grd = "0";
					var grd_zone = "0";
					var chk_fm = "0";
					var grd_fm = "0";
					var silt_1 = "0";
					var silt_2 = "0";
					var cum_wt_gm_1 = "0";
					var cum_wt_gm_2 = "0";
					var cum_wt_gm_3 = "0";
					var cum_wt_gm_4 = "0";
					var cum_wt_gm_5 = "0";
					var cum_wt_gm_6 = "0";
					var cum_wt_gm_7 = "0";
					var cum_wt_gm_8 = "0";

					var ret_wt_gm_1 = "0";
					var ret_wt_gm_2 = "0";
					var ret_wt_gm_3 = "0";
					var ret_wt_gm_4 = "0";
					var ret_wt_gm_5 = "0";
					var ret_wt_gm_6 = "0";
					var ret_wt_gm_7 = "0";
					var ret_wt_gm_8 = "0";


					var cum_ret_1 = "0";
					var cum_ret_2 = "0";
					var cum_ret_3 = "0";
					var cum_ret_4 = "0";
					var cum_ret_5 = "0";
					var cum_ret_6 = "0";
					var cum_ret_7 = "0";
					var cum_ret_8 = "0";

					var pass_sample_1 = "0";
					var pass_sample_2 = "0";
					var pass_sample_3 = "0";
					var pass_sample_4 = "0";
					var pass_sample_5 = "0";
					var pass_sample_6 = "0";
					var pass_sample_7 = "0";
					var pass_sample_8 = "0";

					var blank_extra = "0";
					var sample_taken = "0";
					var silt_content = "0";
					var chk_silt = "0";
				}

			}

			//DTM
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "dtm") {
					if (document.getElementById('chk_dtm').checked) {
						var chk_dtm = "1";
					} else {
						var chk_dtm = "0";
					}

					var dele_1_1 = $('#dele_1_1').val();
					var dele_1_2 = $('#dele_1_2').val();
					var dele_1_3 = $('#dele_1_3').val();
					var dele_1_4 = $('#dele_1_4').val();
					var dele_2_1 = $('#dele_2_1').val();
					var dele_2_2 = $('#dele_2_2').val();
					var dele_2_3 = $('#dele_2_3').val();
					var dele_3_1 = $('#dele_3_1').val();
					var dele_3_2 = $('#dele_3_2').val();
					var dele_3_3 = $('#dele_3_3').val();
					var dele_4_1 = $('#dele_4_1').val();
					var dele_4_2 = $('#dele_4_2').val();
					var dele_4_3 = $('#dele_4_3').val();
					break;
				} else {
					var chk_dtm = "0";
					var dele_1_1 = "0";
					var dele_1_2 = "0";
					var dele_1_3 = "0";
					var dele_1_4 = "0";
					var dele_2_1 = "0";
					var dele_2_2 = "0";
					var dele_2_3 = "0";
					var dele_3_1 = "0";
					var dele_3_2 = "0";
					var dele_3_3 = "0";
					var dele_4_1 = "0";
					var dele_4_2 = "0";
					var dele_4_3 = "0";
				}
			}

			// bulk density
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "den") {

					if (document.getElementById('chk_den').checked) {
						var chk_den = "1";
					} else {
						var chk_den = "0";
					}


					var m11 = $('#m11').val();
					var m12 = $('#m12').val();
					var m13 = $('#m13').val();
					var m21 = $('#m21').val();
					var m22 = $('#m22').val();
					var m23 = $('#m23').val();
					var wom1 = $('#wom1').val();
					var wom2 = $('#wom2').val();
					var wom3 = $('#wom3').val();
					var avg_wom = $('#avg_wom').val();
					var vol = $('#vol').val();
					var bdl = $('#bdl').val();

					break;
				} else {
					var chk_den = "0";
					var m11 = "0";
					var m12 = "0";
					var m13 = "0";
					var m21 = "0";
					var m22 = "0";
					var m23 = "0";
					var wom1 = "0";
					var wom2 = "0";
					var wom3 = "0";
					var avg_wom = "0";
					var vol = "0";
					var bdl = "0";

				}

			}

			//Loose bulk density
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "lbd") {

					if (document.getElementById('chk_lbd').checked) {
						var chk_lbd = "1";
					} else {
						var chk_lbd = "0";
					}


					var lbd_m11 = $('#lbd_m11').val();
					var lbd_m12 = $('#lbd_m12').val();
					var lbd_m13 = $('#lbd_m13').val();
					var lbd_m21 = $('#lbd_m21').val();
					var lbd_m22 = $('#lbd_m22').val();
					var lbd_m23 = $('#lbd_m23').val();
					var lbd_wom1 = $('#lbd_wom1').val();
					var lbd_wom2 = $('#lbd_wom2').val();
					var lbd_wom3 = $('#lbd_wom3').val();
					var lbd_avg_wom = $('#lbd_avg_wom').val();
					var lbd_vol = $('#lbd_vol').val();
					var lbd_bdl = $('#lbd_bdl').val();

					var sample_taken1 = $('#sample_taken1').val();
					var bulk1 = $('#bulk1').val();
					var bulk2 = $('#bulk2').val();
					var bulk3 = $('#bulk3').val();

					break;
				} else {
					var lbd_chk_den = "0";
					var lbd_m11 = "0";
					var lbd_m12 = "0";
					var lbd_m13 = "0";
					var lbd_m21 = "0";
					var lbd_m22 = "0";
					var lbd_m23 = "0";
					var lbd_wom1 = "0";
					var lbd_wom2 = "0";
					var lbd_wom3 = "0";
					var lbd_avg_wom = "0";
					var lbd_vol = "0";
					var lbd_bdl = "0";

					var sample_taken1 = "0";
					var bulk1 = "0";
					var bulk2 = "0";
					var bulk3 = "0";

				}

			}

			// FINER
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "fne") {

					if (document.getElementById('chk_finer').checked) {
						var chk_finer = "1";
					} else {
						var chk_finer = "0";
					}


					var finer_a = $('#finer_a').val();
					var finer_b = $('#finer_b').val();
					var avg_finer = $('#avg_finer').val();


					break;
				} else {
					var chk_finer = "0";
					var finer_a = "0";
					var finer_b = "0";
					var avg_finer = "0";


				}

			}

			//SP AND WATER ABR
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "wtr") {
					if (document.getElementById('chk_sp').checked) {
						var chk_sp = "1";
					} else {
						var chk_sp = "0";
					}
					//specific gravity and water abrasion-5							
					var sp_w_sur_1 = $('#sp_w_sur_1').val();
					var sp_w_sur_2 = $('#sp_w_sur_2').val();
					var sp_w_s_1 = $('#sp_w_s_1').val();
					var sp_w_s_2 = $('#sp_w_s_2').val();
					var sp_wt_st_1 = $('#sp_wt_st_1').val();
					var sp_wt_st_2 = $('#sp_wt_st_2').val();
					var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
					var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
					var sp_specific_gravity = $('#sp_specific_gravity').val();
					var sp_gravity = $('#sp_gravity').val();
					var sp_avg = $('#sp_avg').val();
					var sp_gravity_1 = $('#sp_gravity_1').val();
					var sp_avg_1 = $('#sp_avg_1').val();
					var sp_gravity_2 = $('#sp_gravity_2').val();
					var sp_avg_2 = $('#sp_avg_2').val();
					var sp_water_abr = $('#sp_water_abr').val();
					var sp_water_abr_1 = $('#sp_water_abr_1').val();
					var sp_water_abr_2 = $('#sp_water_abr_2').val();
					var sp_sample_ca = $('#sp_sample_ca').val();
					var sp_temp = $('#sp_temp').val();
					var sp_wt_py1_1 = $('#sp_wt_py1_1').val();
					var sp_wt_py2_1 = $('#sp_wt_py2_1').val();
					var sp_wt_py1_2 = $('#sp_wt_py1_2').val();
					var sp_wt_py2_2 = $('#sp_wt_py2_2').val();

					var sam_1 = $('#sam_1').val();
					var sam_2 = $('#sam_2').val();
					var sam_3 = $('#sam_3').val();
					var sam_4 = $('#sam_4').val();
					var sam_5 = $('#sam_5').val();
					var sam_6 = $('#sam_6').val();
					var sp_wt_py1_3 = $('#sp_wt_py1_3').val();
					var sp_wt_py1_4 = $('#sp_wt_py1_4').val();
					var sp_wt_py1_5 = $('#sp_wt_py1_5').val();
					var sp_wt_py1_6 = $('#sp_wt_py1_6').val();
					var sp_wt_py2_3 = $('#sp_wt_py2_3').val();
					var sp_wt_py2_4 = $('#sp_wt_py2_4').val();
					var sp_wt_py2_5 = $('#sp_wt_py2_5').val();
					var sp_wt_py2_6 = $('#sp_wt_py2_6').val();
					var sp_wt_st_3 = $('#sp_wt_st_3').val();
					var sp_wt_st_4 = $('#sp_wt_st_4').val();
					var sp_wt_st_5 = $('#sp_wt_st_5').val();
					var sp_wt_st_6 = $('#sp_wt_st_6').val();
					var sp_w_s_3 = $('#sp_w_s_3').val();
					var sp_w_s_4 = $('#sp_w_s_4').val();
					var sp_w_s_5 = $('#sp_w_s_5').val();
					var sp_w_s_6 = $('#sp_w_s_6').val();
					var sp_w_sur_3 = $('#sp_w_sur_3').val();
					var sp_w_sur_4 = $('#sp_w_sur_4').val();
					var sp_w_sur_5 = $('#sp_w_sur_5').val();
					var sp_w_sur_6 = $('#sp_w_sur_6').val();
					var sp1_1 = $('#sp1_1').val();
					var sp1_2 = $('#sp1_2').val();
					var sp2_1 = $('#sp2_1').val();
					var sp2_2 = $('#sp2_2').val();
					var sp3_1 = $('#sp3_1').val();
					var sp3_2 = $('#sp3_2').val();
					var sp4_1 = $('#sp4_1').val();
					var sp4_2 = $('#sp4_2').val();
					var sp5_1 = $('#sp5_1').val();
					var sp5_2 = $('#sp5_2').val();
					var sp6_1 = $('#sp6_1').val();
					var sp6_2 = $('#sp6_2').val();
					var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();
					var sp_specific_gravity_4 = $('#sp_specific_gravity_4').val();
					var sp_specific_gravity_5 = $('#sp_specific_gravity_5').val();
					var sp_specific_gravity_6 = $('#sp_specific_gravity_6').val();
					var sp_water_abr_3 = $('#sp_water_abr_3').val();
					var sp_water_abr_4 = $('#sp_water_abr_4').val();
					var sp_water_abr_5 = $('#sp_water_abr_5').val();
					var sp_water_abr_6 = $('#sp_water_abr_6').val();
					var sp_water_abr1_1 = $('#sp_water_abr1_1').val();
					var sp_water_abr2_1 = $('#sp_water_abr2_1').val();
					var sp_specific_gravity2_1 = $('#sp_specific_gravity2_1').val();
					var sp_specific_gravity2_2 = $('#sp_specific_gravity2_2').val();

					break;
				} else {
					var chk_sp = "0";
					var sp_w_sur_1 = "0";
					var sp_w_s_1 = "0";
					var sp_wt_st_1 = "0";
					var sp_w_sur_2 = "0";
					var sp_w_s_2 = "0";
					var sp_wt_st_2 = "0";
					var sp_specific_gravity_1 = "0";
					var sp_specific_gravity_2 = "0";
					var sp_specific_gravity = "0";
					var sp_gravity = "0";
					var sp_avg = "0";
					var sp_gravity_1 = "0";
					var sp_avg_1 = "0";
					var sp_gravity_2 = "0";
					var sp_avg_2 = "0";
					var sp_water_abr_1 = "0";
					var sp_water_abr_2 = "0";
					var sp_water_abr = "0";
					var sp_sample_ca = "0";
					var sp_temp = "0";
					var sp_wt_py1_1 = "0";
					var sp_wt_py2_1 = "0";
					var sp_wt_py1_2 = "0";
					var sp_wt_py2_2 = "0";
					var sam_1 = "";
					var sam_2 = "";
					var sam_3 = "";
					var sam_4 = "";
					var sam_5 = "";
					var sam_6 = "";
					var sp_wt_py1_3 = "";
					var sp_wt_py1_4 = "";
					var sp_wt_py1_5 = "";
					var sp_wt_py1_6 = "";
					var sp_wt_py2_3 = "";
					var sp_wt_py2_4 = "";
					var sp_wt_py2_5 = "";
					var sp_wt_py2_6 = "";
					var sp_wt_st_3 = "";
					var sp_wt_st_4 = "";
					var sp_wt_st_5 = "";
					var sp_wt_st_6 = "";
					var sp_w_s_3 = "";
					var sp_w_s_4 = "";
					var sp_w_s_5 = "";
					var sp_w_s_6 = "";
					var sp_w_sur_3 = "";
					var sp_w_sur_4 = "";
					var sp_w_sur_5 = "";
					var sp_w_sur_6 = "";
					var sp1_1 = "";
					var sp1_2 = "";
					var sp2_1 = "";
					var sp2_2 = "";
					var sp3_1 = "";
					var sp3_2 = "";
					var sp4_1 = "";
					var sp4_2 = "";
					var sp5_1 = "";
					var sp5_2 = "";
					var sp6_1 = "";
					var sp6_2 = "";
					var sp_specific_gravity_3 = "";
					var sp_specific_gravity_4 = "";
					var sp_specific_gravity_5 = "";
					var sp_specific_gravity_6 = "";
					var sp_water_abr_3 = "";
					var sp_water_abr_4 = "";
					var sp_water_abr_5 = "";
					var sp_water_abr_6 = "";
					var sp_water_abr1_1 = "";
					var sp_water_abr2_1 = "";
					var sp_specific_gravity2_1 = "";
					var sp_specific_gravity2_2 = "";
				}

			}

			//SOUNDNESS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sou") {
					if (document.getElementById('chk_sou').checked) {
						var chk_sou = "1";
					} else {
						var chk_sou = "0";
					}

					var go1 = $('#go1').val();
					var go2 = $('#go2').val();
					var go3 = $('#go3').val();
					var go4 = $('#go4').val();
					var go5 = $('#go5').val();
					var go6 = $('#go6').val();
					var go7 = $('#go7').val();
					var wt1 = $('#wt1').val();
					var wt2 = $('#wt2').val();
					var wt3 = $('#wt3').val();
					var wt4 = $('#wt4').val();
					var wt5 = $('#wt5').val();
					var wt6 = $('#wt6').val();
					var wt7 = $('#wt7').val();
					var pp1 = $('#pp1').val();
					var pp2 = $('#pp2').val();
					var pp3 = $('#pp3').val();
					var pp4 = $('#pp4').val();
					var pp5 = $('#pp5').val();
					var pp6 = $('#pp6').val();
					var pp7 = $('#pp7').val();
					var wa1 = $('#wa1').val();
					var wa2 = $('#wa2').val();
					var wa3 = $('#wa3').val();
					var wa4 = $('#wa4').val();
					var wa5 = $('#wa5').val();
					var wa6 = $('#wa6').val();
					var wa7 = $('#wa7').val();
					var total_go = $('#total_go').val();
					var soundness = $('#soundness').val();
					var t1_1 = $('#t1_1').val();
					var t1_2 = $('#t1_2').val();
					var t1_3 = $('#t1_3').val();
					var t1_4 = $('#t1_4').val();
					var t1_5 = $('#t1_5').val();
					var t2_1 = $('#t2_1').val();
					var t2_2 = $('#t2_2').val();
					var t2_3 = $('#t2_3').val();
					var t2_4 = $('#t2_4').val();
					var t2_5 = $('#t2_5').val();
					var t3_1 = $('#t3_1').val();
					var t3_2 = $('#t3_2').val();
					var t3_3 = $('#t3_3').val();
					var t3_4 = $('#t3_4').val();
					var t3_5 = $('#t3_5').val();
					var t4_1 = $('#t4_1').val();
					var t4_2 = $('#t4_2').val();
					var t4_3 = $('#t4_3').val();
					var t4_4 = $('#t4_4').val();
					var t4_5 = $('#t4_5').val();
					var t5_1 = $('#t5_1').val();
					var t5_2 = $('#t5_2').val();
					var t5_3 = $('#t5_3').val();
					var t5_4 = $('#t5_4').val();
					var t5_5 = $('#t5_5').val();
					var t6_1 = $('#t6_1').val();
					var t6_2 = $('#t6_2').val();
					var t6_3 = $('#t6_3').val();
					var t6_4 = $('#t6_4').val();
					var t6_5 = $('#t6_5').val();
					var t7_1 = $('#t7_1').val();
					var t7_2 = $('#t7_2').val();
					var t7_3 = $('#t7_3').val();
					var t7_4 = $('#t7_4').val();
					var t7_5 = $('#t7_5').val();
					var temp1 = $('#temp1').val();


					break;
				} else {
					var chk_sou = "0";
					var soundness = "0";
					var total_go = "0";
					var go1 = "0";
					var go2 = "0";
					var go3 = "0";
					var go4 = "0";
					var go5 = "0";
					var go6 = "0";
					var go7 = "0";
					var wt1 = "0";
					var wt2 = "0";
					var wt3 = "0";
					var wt4 = "0";
					var wt5 = "0";
					var wt6 = "0";
					var wt7 = "0";
					var pp1 = "0";
					var pp2 = "0";
					var pp3 = "0";
					var pp4 = "0";
					var pp5 = "0";
					var pp6 = "0";
					var pp7 = "0";
					var wa1 = "0";
					var wa2 = "0";
					var wa3 = "0";
					var wa4 = "0";
					var wa5 = "0";
					var wa6 = "0";
					var wa7 = "0";

					var t1_1 = "";
					var t1_2 = "";
					var t1_3 = "";
					var t1_4 = "";
					var t1_5 = "";
					var t2_1 = "";
					var t2_2 = "";
					var t2_3 = "";
					var t2_4 = "";
					var t2_5 = "";
					var t3_1 = "";
					var t3_2 = "";
					var t3_3 = "";
					var t3_4 = "";
					var t3_5 = "";
					var t4_1 = "";
					var t4_2 = "";
					var t4_3 = "";
					var t4_4 = "";
					var t4_5 = "";
					var t5_1 = "";
					var t5_2 = "";
					var t5_3 = "";
					var t5_4 = "";
					var t5_5 = "";
					var t6_1 = "";
					var t6_2 = "";
					var t6_3 = "";
					var t6_4 = "";
					var t6_5 = "";
					var t7_1 = "";
					var t7_2 = "";
					var t7_3 = "";
					var t7_4 = "";
					var t7_5 = "";
					var temp1 = "";


				}

			}



			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_grd=' + chk_grd + '&sieve_1=' + sieve_1 + '&sieve_2=' + sieve_2 + '&sieve_3=' + sieve_3 + '&sieve_4=' + sieve_4 + '&sieve_5=' + sieve_5 + '&sieve_6=' + sieve_6 + '&sieve_7=' + sieve_7 + '&cum_wt_gm_1=' + cum_wt_gm_1 + '&cum_wt_gm_2=' + cum_wt_gm_2 + '&cum_wt_gm_3=' + cum_wt_gm_3 + '&cum_wt_gm_4=' + cum_wt_gm_4 + '&cum_wt_gm_5=' + cum_wt_gm_5 + '&cum_wt_gm_6=' + cum_wt_gm_6 + '&cum_wt_gm_7=' + cum_wt_gm_7 + '&cum_wt_gm_8=' + cum_wt_gm_8 + '&ret_wt_gm_1=' + ret_wt_gm_1 + '&ret_wt_gm_2=' + ret_wt_gm_2 + '&ret_wt_gm_3=' + ret_wt_gm_3 + '&ret_wt_gm_4=' + ret_wt_gm_4 + '&ret_wt_gm_5=' + ret_wt_gm_5 + '&ret_wt_gm_6=' + ret_wt_gm_6 + '&ret_wt_gm_7=' + ret_wt_gm_7 + '&ret_wt_gm_8=' + ret_wt_gm_8 + '&cum_ret_1=' + cum_ret_1 + '&cum_ret_2=' + cum_ret_2 + '&cum_ret_3=' + cum_ret_3 + '&cum_ret_4=' + cum_ret_4 + '&cum_ret_5=' + cum_ret_5 + '&cum_ret_6=' + cum_ret_6 + '&cum_ret_7=' + cum_ret_7 + '&cum_ret_8=' + cum_ret_8 + '&pass_sample_1=' + pass_sample_1 + '&pass_sample_2=' + pass_sample_2 + '&pass_sample_3=' + pass_sample_3 + '&pass_sample_4=' + pass_sample_4 + '&pass_sample_5=' + pass_sample_5 + '&pass_sample_6=' + pass_sample_6 + '&pass_sample_7=' + pass_sample_7 + '&pass_sample_8=' + pass_sample_8 + '&blank_extra=' + blank_extra + '&sample_taken=' + sample_taken + '&grd_zone=' + grd_zone + '&chk_fm=' + chk_fm + '&grd_fm=' + grd_fm + '&chk_silt=' + chk_silt + '&silt_content=' + silt_content + '&sp_temp=' + sp_temp + '&silt_1=' + silt_1 + '&silt_2=' + silt_2 + '&chk_sp=' + chk_sp + '&sp_sample_ca=' + sp_sample_ca + '&sp_w_sur_1=' + sp_w_sur_1 + '&sp_w_sur_2=' + sp_w_sur_2 + '&sp_w_s_1=' + sp_w_s_1 + '&sp_w_s_2=' + sp_w_s_2 + '&sp_wt_st_1=' + sp_wt_st_1 + '&sp_wt_st_2=' + sp_wt_st_2 + '&sp_specific_gravity=' + sp_specific_gravity + '&sp_gravity=' + sp_gravity + '&sp_avg=' + sp_avg + '&sp_gravity_1=' + sp_gravity_1 + '&sp_avg_1=' + sp_avg_1 + '&sp_gravity_2=' + sp_gravity_2 + '&sp_avg_2=' + sp_avg_2 + '&sp_specific_gravity_1=' + sp_specific_gravity_1 + '&sp_specific_gravity_2=' + sp_specific_gravity_2 + '&sp_water_abr=' + sp_water_abr + '&sp_water_abr_1=' + sp_water_abr_1 + '&sp_water_abr_2=' + sp_water_abr_2 + '&chk_den=' + chk_den + '&m11=' + m11 + '&m12=' + m12 + '&m13=' + m13 + '&m21=' + m21 + '&m22=' + m22 + '&m23=' + m23 + '&wom1=' + wom1 + '&wom2=' + wom2 + '&wom3=' + wom3 + '&avg_wom=' + avg_wom + '&vol=' + vol + '&bdl=' + bdl + '&chk_lbd=' + chk_lbd + '&lbd_m11=' + lbd_m11 + '&lbd_m12=' + lbd_m12 + '&lbd_m13=' + lbd_m13 + '&lbd_m21=' + lbd_m21 + '&lbd_m22=' + lbd_m22 + '&lbd_m23=' + lbd_m23 + '&lbd_wom1=' + lbd_wom1 + '&lbd_wom2=' + lbd_wom2 + '&lbd_wom3=' + lbd_wom3 + '&lbd_avg_wom=' + lbd_avg_wom + '&lbd_vol=' + lbd_vol + '&lbd_bdl=' + lbd_bdl + '&chk_sou=' + chk_sou + '&soundness=' + soundness + '&total_go=' + total_go + '&go1=' + go1 + '&go2=' + go2 + '&go3=' + go3 + '&go4=' + go4 + '&go5=' + go5 + '&go6=' + go6 + '&go7=' + go7 + '&wt1=' + wt1 + '&wt2=' + wt2 + '&wt3=' + wt3 + '&wt4=' + wt4 + '&wt5=' + wt5 + '&wt6=' + wt6 + '&wt7=' + wt7 + '&pp1=' + pp1 + '&pp2=' + pp2 + '&pp3=' + pp3 + '&pp4=' + pp4 + '&pp5=' + pp5 + '&pp6=' + pp6 + '&pp7=' + pp7 + '&wa1=' + wa1 + '&wa2=' + wa2 + '&wa3=' + wa3 + '&wa4=' + wa4 + '&wa5=' + wa5 + '&wa6=' + wa6 + '&wa7=' + wa7 + '&chk_finer=' + chk_finer + '&finer_a=' + finer_a + '&finer_b=' + finer_b + '&avg_finer=' + avg_finer + '&ulr=' + ulr + '&sp_wt_py1_1=' + sp_wt_py1_1 + '&sp_wt_py2_1=' + sp_wt_py2_1 + '&sp_wt_py1_2=' + sp_wt_py1_2 + '&sp_wt_py2_2=' + sp_wt_py2_2 + '&chk_dtm=' + chk_dtm + '&dele_1_1=' + dele_1_1 + '&dele_1_2=' + dele_1_2 + '&dele_1_3=' + dele_1_3 + '&dele_1_4=' + dele_1_4 + '&dele_2_1=' + dele_2_1 + '&dele_2_2=' + dele_2_2 + '&dele_2_3=' + dele_2_3 + '&dele_3_1=' + dele_3_1 + '&dele_3_2=' + dele_3_2 + '&dele_3_3=' + dele_3_3 + '&dele_4_1=' + dele_4_1 + '&dele_4_2=' + dele_4_2 + '&dele_4_3=' + dele_4_3 + '&t1_1=' + t1_1 + '&t1_2=' + t1_2 + '&t1_3=' + t1_3 + '&t1_4=' + t1_4 + '&t1_5=' + t1_5 + '&t2_1=' + t2_1 + '&t2_2=' + t2_2 + '&t2_3=' + t2_3 + '&t2_4=' + t2_4 + '&t2_5=' + t2_5 + '&t3_1=' + t3_1 + '&t3_2=' + t3_2 + '&t3_3=' + t3_3 + '&t3_4=' + t3_4 + '&t3_5=' + t3_5 + '&t4_1=' + t4_1 + '&t4_2=' + t4_2 + '&t4_3=' + t4_3 + '&t4_4=' + t4_4 + '&t4_5=' + t4_5 + '&t5_1=' + t5_1 + '&t5_2=' + t5_2 + '&t5_3=' + t5_3 + '&t5_4=' + t5_4 + '&t5_5=' + t5_5 + '&t6_1=' + t6_1 + '&t6_2=' + t6_2 + '&t6_3=' + t6_3 + '&t6_4=' + t6_4 + '&t6_5=' + t6_5 + '&t7_1=' + t7_1 + '&t7_2=' + t7_2 + '&t7_3=' + t7_3 + '&t7_4=' + t7_4 + '&t7_5=' + t7_5 + '&temp1=' + temp1 + '&sam_1=' + sam_1 + '&sam_2=' + sam_2 + '&sam_3=' + sam_3 + '&sam_4=' + sam_4 + '&sam_5=' + sam_5 + '&sam_6=' + sam_6 + '&sp_wt_py1_3=' + sp_wt_py1_3 + '&sp_wt_py1_4=' + sp_wt_py1_4 + '&sp_wt_py1_5=' + sp_wt_py1_5 + '&sp_wt_py1_6=' + sp_wt_py1_6 + '&sp_wt_py2_3=' + sp_wt_py2_3 + '&sp_wt_py2_4=' + sp_wt_py2_4 + '&sp_wt_py2_5=' + sp_wt_py2_5 + '&sp_wt_py2_6=' + sp_wt_py2_6 + '&sp_wt_st_3=' + sp_wt_st_3 + '&sp_wt_st_4=' + sp_wt_st_4 + '&sp_wt_st_5=' + sp_wt_st_5 + '&sp_wt_st_6=' + sp_wt_st_6 + '&sp_w_s_3=' + sp_w_s_3 + '&sp_w_s_4=' + sp_w_s_4 + '&sp_w_s_5=' + sp_w_s_5 + '&sp_w_s_6=' + sp_w_s_6 + '&sp_w_sur_3=' + sp_w_sur_3 + '&sp_w_sur_4=' + sp_w_sur_4 + '&sp_w_sur_5=' + sp_w_sur_5 + '&sp_w_sur_6=' + sp_w_sur_6 + '&sp1_1=' + sp1_1 + '&sp1_2=' + sp1_2 + '&sp2_1=' + sp2_1 + '&sp2_2=' + sp2_2 + '&sp3_1=' + sp3_1 + '&sp3_2=' + sp3_2 + '&sp4_1=' + sp4_1 + '&sp4_2=' + sp4_2 + '&sp5_1=' + sp5_1 + '&sp5_2=' + sp5_2 + '&sp6_1=' + sp6_1 + '&sp6_2=' + sp6_2 + '&sp_specific_gravity_3=' + sp_specific_gravity_3 + '&sp_specific_gravity_4=' + sp_specific_gravity_4 + '&sp_specific_gravity_5=' + sp_specific_gravity_5 + '&sp_specific_gravity_6=' + sp_specific_gravity_6 + '&sp_water_abr_3=' + sp_water_abr_3 + '&sp_water_abr_4=' + sp_water_abr_4 + '&sp_water_abr_5=' + sp_water_abr_5 + '&sp_water_abr_6=' + sp_water_abr_6 + '&sp_water_abr1_1=' + sp_water_abr1_1 + '&sp_water_abr2_1=' + sp_water_abr2_1 + '&sp_specific_gravity2_1=' + sp_specific_gravity2_1 + '&sp_specific_gravity2_2=' + sp_specific_gravity2_2 + '&sample_taken1=' + sample_taken1 + '&bulk1=' + bulk1 + '&bulk2=' + bulk2 + '&bulk3=' + bulk3 + '&tag_heading=' + tag_heading + '&tag_data=' + tag_data+ '&amend_date=' + amend_date;

		} else if (type == 'edit') {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();
			var tag_heading = $('#tag_heading').val();
			var tag_data = $('#tag_data').val();
			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//GRADATION
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "grd") {
					if (document.getElementById('chk_grd').checked) {
						var chk_grd = "1";
					} else {
						var chk_grd = "0";
					}
					var chk_fm = "1";
					var grd_fm = $('#grd_fm').val();
					var sieve_1 = "10 (mm)";
					var sieve_2 = "4.75 (mm)";
					var sieve_3 = "2.36 (mm)";
					var sieve_4 = "1.18 (mm)";
					var sieve_5 = "0.600 (mm)";
					var sieve_6 = "0.300 (mm)";
					var sieve_7 = "0.150 (mm)";

					var sample_taken = $('#sample_taken').val();
					var blank_extra = $('#blank_extra').val();
					var grd_zone = $('#grd_zone').val();
					var silt_content = $('#silt_content').val();
					var silt_1 = $('#silt_1').val();
					var silt_2 = $('#silt_2').val();
					var chk_silt = "1";
					var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
					var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
					var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
					var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
					var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
					var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
					var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
					var cum_wt_gm_8 = $('#cum_wt_gm_8').val();

					var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
					var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
					var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
					var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
					var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
					var ret_wt_gm_6 = $('#ret_wt_gm_6').val();
					var ret_wt_gm_7 = $('#ret_wt_gm_7').val();
					var ret_wt_gm_8 = $('#ret_wt_gm_8').val();

					var cum_ret_1 = $('#cum_ret_1').val();
					var cum_ret_2 = $('#cum_ret_2').val();
					var cum_ret_3 = $('#cum_ret_3').val();
					var cum_ret_4 = $('#cum_ret_4').val();
					var cum_ret_5 = $('#cum_ret_5').val();
					var cum_ret_6 = $('#cum_ret_6').val();
					var cum_ret_7 = $('#cum_ret_7').val();
					var cum_ret_8 = $('#cum_ret_8').val();

					var pass_sample_1 = $('#pass_sample_1').val();
					var pass_sample_2 = $('#pass_sample_2').val();
					var pass_sample_3 = $('#pass_sample_3').val();
					var pass_sample_4 = $('#pass_sample_4').val();
					var pass_sample_5 = $('#pass_sample_5').val();
					var pass_sample_6 = $('#pass_sample_6').val();
					var pass_sample_7 = $('#pass_sample_7').val();
					var pass_sample_8 = $('#pass_sample_8').val();

					break;
				} else {
					var chk_grd = "0";
					var grd_zone = "0";
					var chk_fm = "0";
					var grd_fm = "0";
					var silt_1 = "0";
					var silt_2 = "0";
					var cum_wt_gm_1 = "0";
					var cum_wt_gm_2 = "0";
					var cum_wt_gm_3 = "0";
					var cum_wt_gm_4 = "0";
					var cum_wt_gm_5 = "0";
					var cum_wt_gm_6 = "0";
					var cum_wt_gm_7 = "0";
					var cum_wt_gm_8 = "0";

					var ret_wt_gm_1 = "0";
					var ret_wt_gm_2 = "0";
					var ret_wt_gm_3 = "0";
					var ret_wt_gm_4 = "0";
					var ret_wt_gm_5 = "0";
					var ret_wt_gm_6 = "0";
					var ret_wt_gm_7 = "0";
					var ret_wt_gm_8 = "0";


					var cum_ret_1 = "0";
					var cum_ret_2 = "0";
					var cum_ret_3 = "0";
					var cum_ret_4 = "0";
					var cum_ret_5 = "0";
					var cum_ret_6 = "0";
					var cum_ret_7 = "0";
					var cum_ret_8 = "0";

					var pass_sample_1 = "0";
					var pass_sample_2 = "0";
					var pass_sample_3 = "0";
					var pass_sample_4 = "0";
					var pass_sample_5 = "0";
					var pass_sample_6 = "0";
					var pass_sample_7 = "0";
					var pass_sample_8 = "0";

					var blank_extra = "0";
					var sample_taken = "0";
					var silt_content = "0";
					var chk_silt = "0";
				}

			}


			// bulk density
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "den") {

					if (document.getElementById('chk_den').checked) {
						var chk_den = "1";
					} else {
						var chk_den = "0";
					}


					var m11 = $('#m11').val();
					var m12 = $('#m12').val();
					var m13 = $('#m13').val();
					var m21 = $('#m21').val();
					var m22 = $('#m22').val();
					var m23 = $('#m23').val();
					var wom1 = $('#wom1').val();
					var wom2 = $('#wom2').val();
					var wom3 = $('#wom3').val();
					var avg_wom = $('#avg_wom').val();
					var vol = $('#vol').val();
					var bdl = $('#bdl').val();

					break;
				} else {
					var chk_den = "0";
					var m11 = "0";
					var m12 = "0";
					var m13 = "0";
					var m21 = "0";
					var m22 = "0";
					var m23 = "0";
					var wom1 = "0";
					var wom2 = "0";
					var wom3 = "0";
					var avg_wom = "0";
					var vol = "0";
					var bdl = "0";

				}

			}
			// loose bulk density
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "lbd") {

					if (document.getElementById('chk_lbd').checked) {
						var chk_lbd = "1";
					} else {
						var chk_lbd = "0";
					}


					var lbd_m11 = $('#lbd_m11').val();
					var lbd_m12 = $('#lbd_m12').val();
					var lbd_m13 = $('#lbd_m13').val();
					var lbd_m21 = $('#lbd_m21').val();
					var lbd_m22 = $('#lbd_m22').val();
					var lbd_m23 = $('#lbd_m23').val();
					var lbd_wom1 = $('#lbd_wom1').val();
					var lbd_wom2 = $('#lbd_wom2').val();
					var lbd_wom3 = $('#lbd_wom3').val();
					var lbd_avg_wom = $('#lbd_avg_wom').val();
					var lbd_vol = $('#lbd_vol').val();
					var lbd_bdl = $('#lbd_bdl').val();

					var sample_taken1 = $('#sample_taken1').val();
					var bulk1 = $('#bulk1').val();
					var bulk2 = $('#bulk2').val();
					var bulk3 = $('#bulk3').val();

					break;
				} else {
					var lbd_chk_den = "0";
					var lbd_m11 = "0";
					var lbd_m12 = "0";
					var lbd_m13 = "0";
					var lbd_m21 = "0";
					var lbd_m22 = "0";
					var lbd_m23 = "0";
					var lbd_wom1 = "0";
					var lbd_wom2 = "0";
					var lbd_wom3 = "0";
					var lbd_avg_wom = "0";
					var lbd_vol = "0";
					var lbd_bdl = "0";
					var sample_taken1 = "0";
					var bulk1 = "0";
					var bulk2 = "0";
					var bulk3 = "0";
				}

			}

			// FINER
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "fne") {

					if (document.getElementById('chk_finer').checked) {
						var chk_finer = "1";
					} else {
						var chk_finer = "0";
					}


					var finer_a = $('#finer_a').val();
					var finer_b = $('#finer_b').val();
					var avg_finer = $('#avg_finer').val();


					break;
				} else {
					var chk_finer = "0";
					var finer_a = "0";
					var finer_b = "0";
					var avg_finer = "0";


				}

			}

			//SP AND WATER ABR
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "wtr") {
					if (document.getElementById('chk_sp').checked) {
						var chk_sp = "1";
					} else {
						var chk_sp = "0";
					}
					//specific gravity and water abrasion-5							
					var sp_w_sur_1 = $('#sp_w_sur_1').val();
					var sp_w_sur_2 = $('#sp_w_sur_2').val();
					var sp_w_s_1 = $('#sp_w_s_1').val();
					var sp_w_s_2 = $('#sp_w_s_2').val();
					var sp_wt_st_1 = $('#sp_wt_st_1').val();
					var sp_wt_st_2 = $('#sp_wt_st_2').val();
					var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
					var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
					var sp_specific_gravity = $('#sp_specific_gravity').val();
					var sp_gravity = $('#sp_gravity').val();
					var sp_avg = $('#sp_avg').val();
					var sp_gravity_1 = $('#sp_gravity_1').val();
					var sp_avg_1 = $('#sp_avg_1').val();
					var sp_gravity_2 = $('#sp_gravity_2').val();
					var sp_avg_2 = $('#sp_avg_2').val();
					var sp_water_abr = $('#sp_water_abr').val();
					var sp_water_abr_1 = $('#sp_water_abr_1').val();
					var sp_water_abr_2 = $('#sp_water_abr_2').val();
					var sp_sample_ca = $('#sp_sample_ca').val();
					var sp_temp = $('#sp_temp').val();
					var sp_wt_py1_1 = $('#sp_wt_py1_1').val();
					var sp_wt_py2_1 = $('#sp_wt_py2_1').val();
					var sp_wt_py1_2 = $('#sp_wt_py1_2').val();
					var sp_wt_py2_2 = $('#sp_wt_py2_2').val();

					var sam_1 = $('#sam_1').val();
					var sam_2 = $('#sam_2').val();
					var sam_3 = $('#sam_3').val();
					var sam_4 = $('#sam_4').val();
					var sam_5 = $('#sam_5').val();
					var sam_6 = $('#sam_6').val();
					var sp_wt_py1_3 = $('#sp_wt_py1_3').val();
					var sp_wt_py1_4 = $('#sp_wt_py1_4').val();
					var sp_wt_py1_5 = $('#sp_wt_py1_5').val();
					var sp_wt_py1_6 = $('#sp_wt_py1_6').val();
					var sp_wt_py2_3 = $('#sp_wt_py2_3').val();
					var sp_wt_py2_4 = $('#sp_wt_py2_4').val();
					var sp_wt_py2_5 = $('#sp_wt_py2_5').val();
					var sp_wt_py2_6 = $('#sp_wt_py2_6').val();
					var sp_wt_st_3 = $('#sp_wt_st_3').val();
					var sp_wt_st_4 = $('#sp_wt_st_4').val();
					var sp_wt_st_5 = $('#sp_wt_st_5').val();
					var sp_wt_st_6 = $('#sp_wt_st_6').val();
					var sp_w_s_3 = $('#sp_w_s_3').val();
					var sp_w_s_4 = $('#sp_w_s_4').val();
					var sp_w_s_5 = $('#sp_w_s_5').val();
					var sp_w_s_6 = $('#sp_w_s_6').val();
					var sp_w_sur_3 = $('#sp_w_sur_3').val();
					var sp_w_sur_4 = $('#sp_w_sur_4').val();
					var sp_w_sur_5 = $('#sp_w_sur_5').val();
					var sp_w_sur_6 = $('#sp_w_sur_6').val();
					var sp1_1 = $('#sp1_1').val();
					var sp1_2 = $('#sp1_2').val();
					var sp2_1 = $('#sp2_1').val();
					var sp2_2 = $('#sp2_2').val();
					var sp3_1 = $('#sp3_1').val();
					var sp3_2 = $('#sp3_2').val();
					var sp4_1 = $('#sp4_1').val();
					var sp4_2 = $('#sp4_2').val();
					var sp5_1 = $('#sp5_1').val();
					var sp5_2 = $('#sp5_2').val();
					var sp6_1 = $('#sp6_1').val();
					var sp6_2 = $('#sp6_2').val();
					var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();
					var sp_specific_gravity_4 = $('#sp_specific_gravity_4').val();
					var sp_specific_gravity_5 = $('#sp_specific_gravity_5').val();
					var sp_specific_gravity_6 = $('#sp_specific_gravity_6').val();
					var sp_water_abr_3 = $('#sp_water_abr_3').val();
					var sp_water_abr_4 = $('#sp_water_abr_4').val();
					var sp_water_abr_5 = $('#sp_water_abr_5').val();
					var sp_water_abr_6 = $('#sp_water_abr_6').val();
					var sp_water_abr1_1 = $('#sp_water_abr1_1').val();
					var sp_water_abr2_1 = $('#sp_water_abr2_1').val();
					var sp_specific_gravity2_1 = $('#sp_specific_gravity2_1').val();
					var sp_specific_gravity2_2 = $('#sp_specific_gravity2_2').val();

					break;
				} else {
					var chk_sp = "0";
					var sp_w_sur_1 = "0";
					var sp_w_s_1 = "0";
					var sp_wt_st_1 = "0";
					var sp_w_sur_2 = "0";
					var sp_w_s_2 = "0";
					var sp_wt_st_2 = "0";
					var sp_specific_gravity_1 = "0";
					var sp_specific_gravity_2 = "0";
					var sp_specific_gravity = "0";
					var sp_gravity = "0";
					var sp_avg = "0";
					var sp_gravity_1 = "0";
					var sp_avg_1 = "0";
					var sp_gravity_2 = "0";
					var sp_avg_2 = "0";
					var sp_water_abr_1 = "0";
					var sp_water_abr_2 = "0";
					var sp_water_abr = "0";
					var sp_sample_ca = "0";
					var sp_temp = "0";
					var sp_wt_py1_1 = "0";
					var sp_wt_py2_1 = "0";
					var sp_wt_py1_2 = "0";
					var sp_wt_py2_2 = "0";

					var sam_1 = "";
					var sam_2 = "";
					var sam_3 = "";
					var sam_4 = "";
					var sam_5 = "";
					var sam_6 = "";
					var sp_wt_py1_3 = "";
					var sp_wt_py1_4 = "";
					var sp_wt_py1_5 = "";
					var sp_wt_py1_6 = "";
					var sp_wt_py2_3 = "";
					var sp_wt_py2_4 = "";
					var sp_wt_py2_5 = "";
					var sp_wt_py2_6 = "";
					var sp_wt_st_3 = "";
					var sp_wt_st_4 = "";
					var sp_wt_st_5 = "";
					var sp_wt_st_6 = "";
					var sp_w_s_3 = "";
					var sp_w_s_4 = "";
					var sp_w_s_5 = "";
					var sp_w_s_6 = "";
					var sp_w_sur_3 = "";
					var sp_w_sur_4 = "";
					var sp_w_sur_5 = "";
					var sp_w_sur_6 = "";
					var sp1_1 = "";
					var sp1_2 = "";
					var sp2_1 = "";
					var sp2_2 = "";
					var sp3_1 = "";
					var sp3_2 = "";
					var sp4_1 = "";
					var sp4_2 = "";
					var sp5_1 = "";
					var sp5_2 = "";
					var sp6_1 = "";
					var sp6_2 = "";
					var sp_specific_gravity_3 = "";
					var sp_specific_gravity_4 = "";
					var sp_specific_gravity_5 = "";
					var sp_specific_gravity_6 = "";
					var sp_water_abr_3 = "";
					var sp_water_abr_4 = "";
					var sp_water_abr_5 = "";
					var sp_water_abr_6 = "";
					var sp_water_abr1_1 = "";
					var sp_water_abr2_1 = "";
					var sp_specific_gravity2_1 = "";
					var sp_specific_gravity2_2 = "";
				}

			}

			//SOUNDNESS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sou") {
					if (document.getElementById('chk_sou').checked) {
						var chk_sou = "1";
					} else {
						var chk_sou = "0";
					}

					var go1 = $('#go1').val();
					var go2 = $('#go2').val();
					var go3 = $('#go3').val();
					var go4 = $('#go4').val();
					var go5 = $('#go5').val();
					var go6 = $('#go6').val();
					var go7 = $('#go7').val();
					var wt1 = $('#wt1').val();
					var wt2 = $('#wt2').val();
					var wt3 = $('#wt3').val();
					var wt4 = $('#wt4').val();
					var wt5 = $('#wt5').val();
					var wt6 = $('#wt6').val();
					var wt7 = $('#wt7').val();
					var pp1 = $('#pp1').val();
					var pp2 = $('#pp2').val();
					var pp3 = $('#pp3').val();
					var pp4 = $('#pp4').val();
					var pp5 = $('#pp5').val();
					var pp6 = $('#pp6').val();
					var pp7 = $('#pp7').val();
					var wa1 = $('#wa1').val();
					var wa2 = $('#wa2').val();
					var wa3 = $('#wa3').val();
					var wa4 = $('#wa4').val();
					var wa5 = $('#wa5').val();
					var wa6 = $('#wa6').val();
					var wa7 = $('#wa7').val();
					var soundness = $('#soundness').val();
					var total_go = $('#total_go').val();

					var t1_1 = $('#t1_1').val();
					var t1_2 = $('#t1_2').val();
					var t1_3 = $('#t1_3').val();
					var t1_4 = $('#t1_4').val();
					var t1_5 = $('#t1_5').val();
					var t2_1 = $('#t2_1').val();
					var t2_2 = $('#t2_2').val();
					var t2_3 = $('#t2_3').val();
					var t2_4 = $('#t2_4').val();
					var t2_5 = $('#t2_5').val();
					var t3_1 = $('#t3_1').val();
					var t3_2 = $('#t3_2').val();
					var t3_3 = $('#t3_3').val();
					var t3_4 = $('#t3_4').val();
					var t3_5 = $('#t3_5').val();
					var t4_1 = $('#t4_1').val();
					var t4_2 = $('#t4_2').val();
					var t4_3 = $('#t4_3').val();
					var t4_4 = $('#t4_4').val();
					var t4_5 = $('#t4_5').val();
					var t5_1 = $('#t5_1').val();
					var t5_2 = $('#t5_2').val();
					var t5_3 = $('#t5_3').val();
					var t5_4 = $('#t5_4').val();
					var t5_5 = $('#t5_5').val();
					var t6_1 = $('#t6_1').val();
					var t6_2 = $('#t6_2').val();
					var t6_3 = $('#t6_3').val();
					var t6_4 = $('#t6_4').val();
					var t6_5 = $('#t6_5').val();
					var t7_1 = $('#t7_1').val();
					var t7_2 = $('#t7_2').val();
					var t7_3 = $('#t7_3').val();
					var t7_4 = $('#t7_4').val();
					var t7_5 = $('#t7_5').val();
					var temp1 = $('#temp1').val();


					break;
				} else {
					var chk_sou = "0";
					var soundness = "0";
					var total_go = "0";
					var go1 = "0";
					var go2 = "0";
					var go3 = "0";
					var go4 = "0";
					var go5 = "0";
					var go6 = "0";
					var go7 = "0";
					var wt1 = "0";
					var wt2 = "0";
					var wt3 = "0";
					var wt4 = "0";
					var wt5 = "0";
					var wt6 = "0";
					var wt7 = "0";
					var pp1 = "0";
					var pp2 = "0";
					var pp3 = "0";
					var pp4 = "0";
					var pp5 = "0";
					var pp6 = "0";
					var pp7 = "0";
					var wa1 = "0";
					var wa2 = "0";
					var wa3 = "0";
					var wa4 = "0";
					var wa5 = "0";
					var wa6 = "0";
					var wa7 = "0";

					var t1_1 = "";
					var t1_2 = "";
					var t1_3 = "";
					var t1_4 = "";
					var t1_5 = "";
					var t2_1 = "";
					var t2_2 = "";
					var t2_3 = "";
					var t2_4 = "";
					var t2_5 = "";
					var t3_1 = "";
					var t3_2 = "";
					var t3_3 = "";
					var t3_4 = "";
					var t3_5 = "";
					var t4_1 = "";
					var t4_2 = "";
					var t4_3 = "";
					var t4_4 = "";
					var t4_5 = "";
					var t5_1 = "";
					var t5_2 = "";
					var t5_3 = "";
					var t5_4 = "";
					var t5_5 = "";
					var t6_1 = "";
					var t6_2 = "";
					var t6_3 = "";
					var t6_4 = "";
					var t6_5 = "";
					var t7_1 = "";
					var t7_2 = "";
					var t7_3 = "";
					var t7_4 = "";
					var t7_5 = "";
					var temp1 = "";


				}

			}

			//DTM
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "dtm") {
					if (document.getElementById('chk_dtm').checked) {
						var chk_dtm = "1";
					} else {
						var chk_dtm = "0";
					}

					var dele_1_1 = $('#dele_1_1').val();
					var dele_1_2 = $('#dele_1_2').val();
					var dele_1_3 = $('#dele_1_3').val();
					var dele_1_4 = $('#dele_1_4').val();
					var dele_2_1 = $('#dele_2_1').val();
					var dele_2_2 = $('#dele_2_2').val();
					var dele_2_3 = $('#dele_2_3').val();
					var dele_3_1 = $('#dele_3_1').val();
					var dele_3_2 = $('#dele_3_2').val();
					var dele_3_3 = $('#dele_3_3').val();
					var dele_4_1 = $('#dele_4_1').val();
					var dele_4_2 = $('#dele_4_2').val();
					var dele_4_3 = $('#dele_4_3').val();
					break;
				} else {
					var chk_dtm = "0";
					var dele_1_1 = "0";
					var dele_1_2 = "0";
					var dele_1_3 = "0";
					var dele_1_4 = "0";
					var dele_2_1 = "0";
					var dele_2_2 = "0";
					var dele_2_3 = "0";
					var dele_3_1 = "0";
					var dele_3_2 = "0";
					var dele_3_3 = "0";
					var dele_4_1 = "0";
					var dele_4_2 = "0";
					var dele_4_3 = "0";
				}
			}

			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_grd=' + chk_grd + '&sieve_1=' + sieve_1 + '&sieve_2=' + sieve_2 + '&sieve_3=' + sieve_3 + '&sieve_4=' + sieve_4 + '&sieve_5=' + sieve_5 + '&sieve_6=' + sieve_6 + '&sieve_7=' + sieve_7 + '&cum_wt_gm_1=' + cum_wt_gm_1 + '&cum_wt_gm_2=' + cum_wt_gm_2 + '&cum_wt_gm_3=' + cum_wt_gm_3 + '&cum_wt_gm_4=' + cum_wt_gm_4 + '&cum_wt_gm_5=' + cum_wt_gm_5 + '&cum_wt_gm_6=' + cum_wt_gm_6 + '&cum_wt_gm_7=' + cum_wt_gm_7 + '&cum_wt_gm_8=' + cum_wt_gm_8 + '&ret_wt_gm_1=' + ret_wt_gm_1 + '&ret_wt_gm_2=' + ret_wt_gm_2 + '&ret_wt_gm_3=' + ret_wt_gm_3 + '&ret_wt_gm_4=' + ret_wt_gm_4 + '&ret_wt_gm_5=' + ret_wt_gm_5 + '&ret_wt_gm_6=' + ret_wt_gm_6 + '&ret_wt_gm_7=' + ret_wt_gm_7 + '&ret_wt_gm_8=' + ret_wt_gm_8 + '&cum_ret_1=' + cum_ret_1 + '&cum_ret_2=' + cum_ret_2 + '&cum_ret_3=' + cum_ret_3 + '&cum_ret_4=' + cum_ret_4 + '&cum_ret_5=' + cum_ret_5 + '&cum_ret_6=' + cum_ret_6 + '&cum_ret_7=' + cum_ret_7 + '&cum_ret_8=' + cum_ret_8 + '&pass_sample_1=' + pass_sample_1 + '&pass_sample_2=' + pass_sample_2 + '&pass_sample_3=' + pass_sample_3 + '&pass_sample_4=' + pass_sample_4 + '&pass_sample_5=' + pass_sample_5 + '&pass_sample_6=' + pass_sample_6 + '&pass_sample_7=' + pass_sample_7 + '&pass_sample_8=' + pass_sample_8 + '&blank_extra=' + blank_extra + '&sample_taken=' + sample_taken + '&grd_zone=' + grd_zone + '&chk_fm=' + chk_fm + '&grd_fm=' + grd_fm + '&chk_silt=' + chk_silt + '&silt_content=' + silt_content + '&sp_temp=' + sp_temp + '&silt_1=' + silt_1 + '&silt_2=' + silt_2 + '&chk_sp=' + chk_sp + '&sp_sample_ca=' + sp_sample_ca + '&sp_w_sur_1=' + sp_w_sur_1 + '&sp_w_sur_2=' + sp_w_sur_2 + '&sp_w_s_1=' + sp_w_s_1 + '&sp_w_s_2=' + sp_w_s_2 + '&sp_wt_st_1=' + sp_wt_st_1 + '&sp_wt_st_2=' + sp_wt_st_2 + '&sp_specific_gravity=' + sp_specific_gravity + '&sp_gravity=' + sp_gravity + '&sp_avg=' + sp_avg + '&sp_gravity_1=' + sp_gravity_1 + '&sp_avg_1=' + sp_avg_1 + '&sp_gravity_2=' + sp_gravity_2 + '&sp_avg_2=' + sp_avg_2 + '&sp_specific_gravity_1=' + sp_specific_gravity_1 + '&sp_specific_gravity_2=' + sp_specific_gravity_2 + '&sp_water_abr=' + sp_water_abr + '&sp_water_abr_1=' + sp_water_abr_1 + '&sp_water_abr_2=' + sp_water_abr_2 + '&chk_den=' + chk_den + '&m11=' + m11 + '&m12=' + m12 + '&m13=' + m13 + '&m21=' + m21 + '&m22=' + m22 + '&m23=' + m23 + '&wom1=' + wom1 + '&wom2=' + wom2 + '&wom3=' + wom3 + '&avg_wom=' + avg_wom + '&vol=' + vol + '&bdl=' + bdl + '&chk_lbd=' + chk_lbd + '&lbd_m11=' + lbd_m11 + '&lbd_m12=' + lbd_m12 + '&lbd_m13=' + lbd_m13 + '&lbd_m21=' + lbd_m21 + '&lbd_m22=' + lbd_m22 + '&lbd_m23=' + lbd_m23 + '&lbd_wom1=' + lbd_wom1 + '&lbd_wom2=' + lbd_wom2 + '&lbd_wom3=' + lbd_wom3 + '&lbd_avg_wom=' + lbd_avg_wom + '&lbd_vol=' + lbd_vol + '&lbd_bdl=' + lbd_bdl + '&chk_sou=' + chk_sou + '&soundness=' + soundness + '&total_go=' + total_go + '&go1=' + go1 + '&go2=' + go2 + '&go3=' + go3 + '&go4=' + go4 + '&go5=' + go5 + '&go6=' + go6 + '&go7=' + go7 + '&wt1=' + wt1 + '&wt2=' + wt2 + '&wt3=' + wt3 + '&wt4=' + wt4 + '&wt5=' + wt5 + '&wt6=' + wt6 + '&wt7=' + wt7 + '&pp1=' + pp1 + '&pp2=' + pp2 + '&pp3=' + pp3 + '&pp4=' + pp4 + '&pp5=' + pp5 + '&pp6=' + pp6 + '&pp7=' + pp7 + '&wa1=' + wa1 + '&wa2=' + wa2 + '&wa3=' + wa3 + '&wa4=' + wa4 + '&wa5=' + wa5 + '&wa6=' + wa6 + '&wa7=' + wa7 + '&chk_finer=' + chk_finer + '&finer_a=' + finer_a + '&finer_b=' + finer_b + '&avg_finer=' + avg_finer + '&ulr=' + ulr + '&sp_wt_py1_1=' + sp_wt_py1_1 + '&sp_wt_py2_1=' + sp_wt_py2_1 + '&sp_wt_py1_2=' + sp_wt_py1_2 + '&sp_wt_py2_2=' + sp_wt_py2_2 + '&chk_dtm=' + chk_dtm + '&dele_1_1=' + dele_1_1 + '&dele_1_2=' + dele_1_2 + '&dele_1_3=' + dele_1_3 + '&dele_1_4=' + dele_1_4 + '&dele_2_1=' + dele_2_1 + '&dele_2_2=' + dele_2_2 + '&dele_2_3=' + dele_2_3 + '&dele_3_1=' + dele_3_1 + '&dele_3_2=' + dele_3_2 + '&dele_3_3=' + dele_3_3 + '&dele_4_1=' + dele_4_1 + '&dele_4_2=' + dele_4_2 + '&dele_4_3=' + dele_4_3 + '&t1_1=' + t1_1 + '&t1_2=' + t1_2 + '&t1_3=' + t1_3 + '&t1_4=' + t1_4 + '&t1_5=' + t1_5 + '&t2_1=' + t2_1 + '&t2_2=' + t2_2 + '&t2_3=' + t2_3 + '&t2_4=' + t2_4 + '&t2_5=' + t2_5 + '&t3_1=' + t3_1 + '&t3_2=' + t3_2 + '&t3_3=' + t3_3 + '&t3_4=' + t3_4 + '&t3_5=' + t3_5 + '&t4_1=' + t4_1 + '&t4_2=' + t4_2 + '&t4_3=' + t4_3 + '&t4_4=' + t4_4 + '&t4_5=' + t4_5 + '&t5_1=' + t5_1 + '&t5_2=' + t5_2 + '&t5_3=' + t5_3 + '&t5_4=' + t5_4 + '&t5_5=' + t5_5 + '&t6_1=' + t6_1 + '&t6_2=' + t6_2 + '&t6_3=' + t6_3 + '&t6_4=' + t6_4 + '&t6_5=' + t6_5 + '&t7_1=' + t7_1 + '&t7_2=' + t7_2 + '&t7_3=' + t7_3 + '&t7_4=' + t7_4 + '&t7_5=' + t7_5 + '&temp1=' + temp1 + '&sam_1=' + sam_1 + '&sam_2=' + sam_2 + '&sam_3=' + sam_3 + '&sam_4=' + sam_4 + '&sam_5=' + sam_5 + '&sam_6=' + sam_6 + '&sp_wt_py1_3=' + sp_wt_py1_3 + '&sp_wt_py1_4=' + sp_wt_py1_4 + '&sp_wt_py1_5=' + sp_wt_py1_5 + '&sp_wt_py1_6=' + sp_wt_py1_6 + '&sp_wt_py2_3=' + sp_wt_py2_3 + '&sp_wt_py2_4=' + sp_wt_py2_4 + '&sp_wt_py2_5=' + sp_wt_py2_5 + '&sp_wt_py2_6=' + sp_wt_py2_6 + '&sp_wt_st_3=' + sp_wt_st_3 + '&sp_wt_st_4=' + sp_wt_st_4 + '&sp_wt_st_5=' + sp_wt_st_5 + '&sp_wt_st_6=' + sp_wt_st_6 + '&sp_w_s_3=' + sp_w_s_3 + '&sp_w_s_4=' + sp_w_s_4 + '&sp_w_s_5=' + sp_w_s_5 + '&sp_w_s_6=' + sp_w_s_6 + '&sp_w_sur_3=' + sp_w_sur_3 + '&sp_w_sur_4=' + sp_w_sur_4 + '&sp_w_sur_5=' + sp_w_sur_5 + '&sp_w_sur_6=' + sp_w_sur_6 + '&sp1_1=' + sp1_1 + '&sp1_2=' + sp1_2 + '&sp2_1=' + sp2_1 + '&sp2_2=' + sp2_2 + '&sp3_1=' + sp3_1 + '&sp3_2=' + sp3_2 + '&sp4_1=' + sp4_1 + '&sp4_2=' + sp4_2 + '&sp5_1=' + sp5_1 + '&sp5_2=' + sp5_2 + '&sp6_1=' + sp6_1 + '&sp6_2=' + sp6_2 + '&sp_specific_gravity_3=' + sp_specific_gravity_3 + '&sp_specific_gravity_4=' + sp_specific_gravity_4 + '&sp_specific_gravity_5=' + sp_specific_gravity_5 + '&sp_specific_gravity_6=' + sp_specific_gravity_6 + '&sp_water_abr_3=' + sp_water_abr_3 + '&sp_water_abr_4=' + sp_water_abr_4 + '&sp_water_abr_5=' + sp_water_abr_5 + '&sp_water_abr_6=' + sp_water_abr_6 + '&sp_water_abr1_1=' + sp_water_abr1_1 + '&sp_water_abr2_1=' + sp_water_abr2_1 + '&sp_specific_gravity2_1=' + sp_specific_gravity2_1 + '&sp_specific_gravity2_2=' + sp_specific_gravity2_2 + '&sample_taken1=' + sample_taken1 + '&bulk1=' + bulk1 + '&bulk2=' + bulk2 + '&bulk3=' + bulk3 + '&tag_heading=' + tag_heading + '&tag_data=' + tag_data+ '&amend_date=' + amend_date;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_sand.php',
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
			url: '<?php echo $base_url; ?>save_sand.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);
				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);
				$('#ulr').val(data.ulr);
				$('#amend_date').val(data.amend_date);
				$('#tag_heading').val(data.tag_heading);
				$('#tag_data').val(data.tag_data);
				var temp = $('#test_list').val();
				var aa = temp.split(",");
				//GRADATION
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "grd") {

						var chk_grd = data.chk_grd;
						if (chk_grd == "1") {
							$('#txtgrd').css("background-color", "var(--success)");
							$("#chk_grd").prop("checked", true);
							$("#chk_fm").prop("checked", true);
							$("#chk_silt").prop("checked", true);
						} else {
							$('#txtgrd').css("background-color", "white");
							$("#chk_grd").prop("checked", false);
							$("#chk_fm").prop("checked", false);
							$("#chk_silt").prop("checked", false);
						}
						//GRADATION DATA FETCH-1
						$('#sample_taken').val(data.sample_taken);
						$('#grd_fm').val(data.grd_fm);
						$('#silt_content').val(data.silt_content);
						$('#silt_2').val(data.silt_2);
						$('#silt_1').val(data.silt_1);


						$('#cum_wt_gm_1').val(data.cum_wt_gm_1);
						$('#cum_wt_gm_2').val(data.cum_wt_gm_2);
						$('#cum_wt_gm_3').val(data.cum_wt_gm_3);
						$('#cum_wt_gm_4').val(data.cum_wt_gm_4);
						$('#cum_wt_gm_5').val(data.cum_wt_gm_5);
						$('#cum_wt_gm_6').val(data.cum_wt_gm_6);
						$('#cum_wt_gm_7').val(data.cum_wt_gm_7);
						$('#cum_wt_gm_8').val(data.cum_wt_gm_8);

						$('#ret_wt_gm_1').val(data.ret_wt_gm_1);
						$('#ret_wt_gm_2').val(data.ret_wt_gm_2);
						$('#ret_wt_gm_3').val(data.ret_wt_gm_3);
						$('#ret_wt_gm_4').val(data.ret_wt_gm_4);
						$('#ret_wt_gm_5').val(data.ret_wt_gm_5);
						$('#ret_wt_gm_6').val(data.ret_wt_gm_6);
						$('#ret_wt_gm_7').val(data.ret_wt_gm_7);
						$('#ret_wt_gm_8').val(data.ret_wt_gm_8);

						$('#cum_ret_1').val(data.cum_ret_1);
						$('#cum_ret_2').val(data.cum_ret_2);
						$('#cum_ret_3').val(data.cum_ret_3);
						$('#cum_ret_4').val(data.cum_ret_4);
						$('#cum_ret_5').val(data.cum_ret_5);
						$('#cum_ret_6').val(data.cum_ret_6);
						$('#cum_ret_7').val(data.cum_ret_7);
						$('#cum_ret_8').val(data.cum_ret_8);

						$('#pass_sample_1').val(data.pass_sample_1);
						$('#pass_sample_2').val(data.pass_sample_2);
						$('#pass_sample_3').val(data.pass_sample_3);
						$('#pass_sample_4').val(data.pass_sample_4);
						$('#pass_sample_5').val(data.pass_sample_5);
						$('#pass_sample_6').val(data.pass_sample_6);
						$('#pass_sample_7').val(data.pass_sample_7);
						$('#pass_sample_8').val(data.pass_sample_8);

						$('#blank_extra').val(data.blank_extra);
						$('#grd_zone').val(data.grd_zone);

						sieve_1 = data.sieve_1;
						sieve_2 = data.sieve_2;
						sieve_3 = data.sieve_3;
						sieve_4 = data.sieve_4;
						sieve_5 = data.sieve_5;
						sieve_6 = data.sieve_6;
						sieve_7 = data.sieve_7;

						break;
					} else {

					}

				}


				//sp and water
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "wtr") {
						var chk_sp = data.chk_sp;
						if (chk_sp == "1") {
							$('#txtwtr').css("background-color", "var(--success)");
							$("#chk_sp").prop("checked", true);
						} else {
							$('#txtwtr').css("background-color", "white");
							$("#chk_sp").prop("checked", false);
						}
						//specific gravity and water abr
						$('#sp_sample_ca').val(data.sp_sample_ca);
						$('#sp_w_sur_1').val(data.sp_w_sur_1);
						$('#sp_w_sur_2').val(data.sp_w_sur_2);
						$('#sp_w_s_1').val(data.sp_w_s_1);
						$('#sp_w_s_2').val(data.sp_w_s_2);
						$('#sp_wt_st_1').val(data.sp_wt_st_1);
						$('#sp_wt_st_2').val(data.sp_wt_st_2);
						$('#sp_specific_gravity_1').val(data.sp_specific_gravity_1);
						$('#sp_specific_gravity_2').val(data.sp_specific_gravity_2);
						$('#sp_specific_gravity').val(data.sp_specific_gravity);
						$('#sp_gravity').val(data.sp_gravity);
						$('#sp_avg').val(data.sp_avg);
						$('#sp_gravity_1').val(data.sp_gravity_1);
						$('#sp_avg_1').val(data.sp_avg_1);
						$('#sp_gravity_2').val(data.sp_gravity_2);
						$('#sp_avg_2').val(data.sp_avg_2);
						$('#sp_water_abr').val(data.sp_water_abr);
						$('#sp_water_abr_1').val(data.sp_water_abr_1);
						$('#sp_water_abr_2').val(data.sp_water_abr_2);
						$('#sp_temp').val(data.sp_temp);
						$('#sp_wt_py1_1').val(data.sp_wt_py1_1);
						$('#sp_wt_py2_1').val(data.sp_wt_py2_1);
						$('#sp_wt_py1_2').val(data.sp_wt_py1_2);
						$('#sp_wt_py2_2').val(data.sp_wt_py2_2);

						$('#sam_1').val(data.sam_1);
						$('#sam_2').val(data.sam_2);
						$('#sam_3').val(data.sam_3);
						$('#sam_4').val(data.sam_4);
						$('#sam_5').val(data.sam_5);
						$('#sam_6').val(data.sam_6);
						$('#sp_wt_py1_3').val(data.sp_wt_py1_3);
						$('#sp_wt_py1_4').val(data.sp_wt_py1_4);
						$('#sp_wt_py1_5').val(data.sp_wt_py1_5);
						$('#sp_wt_py1_6').val(data.sp_wt_py1_6);
						$('#sp_wt_py2_3').val(data.sp_wt_py2_3);
						$('#sp_wt_py2_4').val(data.sp_wt_py2_4);
						$('#sp_wt_py2_5').val(data.sp_wt_py2_5);
						$('#sp_wt_py2_6').val(data.sp_wt_py2_6);
						$('#sp_wt_st_3').val(data.sp_wt_st_3);
						$('#sp_wt_st_4').val(data.sp_wt_st_4);
						$('#sp_wt_st_5').val(data.sp_wt_st_5);
						$('#sp_wt_st_6').val(data.sp_wt_st_6);
						$('#sp_w_s_3').val(data.sp_w_s_3);
						$('#sp_w_s_4').val(data.sp_w_s_4);
						$('#sp_w_s_5').val(data.sp_w_s_5);
						$('#sp_w_s_6').val(data.sp_w_s_6);
						$('#sp_w_sur_3').val(data.sp_w_sur_3);
						$('#sp_w_sur_4').val(data.sp_w_sur_4);
						$('#sp_w_sur_5').val(data.sp_w_sur_5);
						$('#sp_w_sur_6').val(data.sp_w_sur_6);
						$('#sp1_1').val(data.sp1_1);
						$('#sp1_2').val(data.sp1_2);
						$('#sp2_1').val(data.sp2_1);
						$('#sp2_2').val(data.sp2_2);
						$('#sp3_1').val(data.sp3_1);
						$('#sp3_2').val(data.sp3_2);
						$('#sp4_1').val(data.sp4_1);
						$('#sp4_2').val(data.sp4_2);
						$('#sp5_1').val(data.sp5_1);
						$('#sp5_2').val(data.sp5_2);
						$('#sp6_1').val(data.sp6_1);
						$('#sp6_2').val(data.sp6_2);
						$('#sp_specific_gravity_3').val(data.sp_specific_gravity_3);
						$('#sp_specific_gravity_4').val(data.sp_specific_gravity_4);
						$('#sp_specific_gravity_5').val(data.sp_specific_gravity_5);
						$('#sp_specific_gravity_6').val(data.sp_specific_gravity_6);
						$('#sp_water_abr_3').val(data.sp_water_abr_3);
						$('#sp_water_abr_4').val(data.sp_water_abr_4);
						$('#sp_water_abr_5').val(data.sp_water_abr_5);
						$('#sp_water_abr_6').val(data.sp_water_abr_6);
						$('#sp_water_abr1_1').val(data.sp_water_abr1_1);
						$('#sp_water_abr2_1').val(data.sp_water_abr2_1);
						$('#sp_specific_gravity2_1').val(data.sp_specific_gravity2_1);
						$('#sp_specific_gravity2_2').val(data.sp_specific_gravity2_2);


						break;
					} else {

					}

				}

				//bulk density
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "den") {
						$('#m11').val(data.m11);
						$('#m12').val(data.m12);
						$('#m13').val(data.m13);
						$('#m21').val(data.m21);
						$('#m22').val(data.m22);
						$('#m23').val(data.m23);
						$('#wom1').val(data.wom1);
						$('#wom2').val(data.wom2);
						$('#wom3').val(data.wom3);
						$('#avg_wom').val(data.avg_wom);
						$('#avg_wom1').val(data.avg_wom);
						$('#vol').val(data.vol);
						$('#bdl').val(data.bdl);
						var chk_den = data.chk_den;
						if (chk_den == "1") {
							$('#txtden').css("background-color", "var(--success)");
							$("#chk_den").prop("checked", true);
						} else {
							$('#txtden').css("background-color", "white");
							$("#chk_den").prop("checked", false);
						}
						break;
					} else {

					}

				}

				//Loose bulk density
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "lbd") {
						$('#lbd_m11').val(data.lbd_m11);
						$('#lbd_m12').val(data.lbd_m12);
						$('#lbd_m13').val(data.lbd_m13);
						$('#lbd_m21').val(data.lbd_m21);
						$('#lbd_m22').val(data.lbd_m22);
						$('#lbd_m23').val(data.lbd_m23);
						$('#lbd_wom1').val(data.lbd_wom1);
						$('#lbd_wom2').val(data.lbd_wom2);
						$('#lbd_wom3').val(data.lbd_wom3);
						$('#lbd_avg_wom').val(data.lbd_avg_wom);
						$('#lbd_avg_wom1').val(data.lbd_avg_wom);
						$('#lbd_vol').val(data.lbd_vol);
						$('#lbd_bdl').val(data.lbd_bdl);

						$('#sample_taken1').val(data.sample_taken1);
						$('#bulk1').val(data.bulk1);
						$('#bulk2').val(data.bulk2);
						$('#bulk3').val(data.bulk3);

						var chk_den = data.chk_lbd;
						if (chk_lbd == "1") {
							$('#txtlbd').css("background-color", "var(--success)");
							$("#chk_lbd").prop("checked", true);
						} else {
							$('#txtlbd').css("background-color", "var(--success)");
							$("#chk_lbd").prop("checked", false);
						}
						break;
					} else {

					}
				}

				//FINER
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "fne") {
						$('#finer_a').val(data.finer_a);
						$('#finer_b').val(data.finer_b);
						$('#avg_finer').val(data.avg_finer);

						var chk_finer = data.chk_finer;
						if (chk_finer == "1") {
							$('#txtfne').css("background-color", "var(--success)");
							$("#chk_finer").prop("checked", true);
						} else {
							$('#txtfne').css("background-color", "white");
							$("#chk_finer").prop("checked", false);
						}
						break;
					} else {

					}

				}

				//soundness
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sou") {
						$('#go1').val(data.go1);
						$('#go2').val(data.go2);
						$('#go3').val(data.go3);
						$('#go4').val(data.go4);
						$('#go5').val(data.go5);
						$('#go6').val(data.go6);
						$('#go7').val(data.go7);

						$('#wt1').val(data.wt1);
						$('#wt2').val(data.wt2);
						$('#wt3').val(data.wt3);
						$('#wt4').val(data.wt4);
						$('#wt5').val(data.wt5);
						$('#wt6').val(data.wt6);
						$('#wt7').val(data.wt7);

						$('#pp1').val(data.pp1);
						$('#pp2').val(data.pp2);
						$('#pp3').val(data.pp3);
						$('#pp4').val(data.pp4);
						$('#pp5').val(data.pp5);
						$('#pp6').val(data.pp6);
						$('#pp7').val(data.pp7);

						$('#wa1').val(data.wa1);
						$('#wa2').val(data.wa2);
						$('#wa3').val(data.wa3);
						$('#wa4').val(data.wa4);
						$('#wa5').val(data.wa5);
						$('#wa6').val(data.wa6);
						$('#wa7').val(data.wa7);

						$('#soundness').val(data.soundness);
						$('#total_go').val(data.total_go);

						$('#t1_1').val(data.t1_1);
						$('#t1_2').val(data.t1_2);
						$('#t1_3').val(data.t1_3);
						$('#t1_4').val(data.t1_4);
						$('#t1_5').val(data.t1_5);
						$('#t2_1').val(data.t2_1);
						$('#t2_2').val(data.t2_2);
						$('#t2_3').val(data.t2_3);
						$('#t2_4').val(data.t2_4);
						$('#t2_5').val(data.t2_5);
						$('#t3_1').val(data.t3_1);
						$('#t3_2').val(data.t3_2);
						$('#t3_3').val(data.t3_3);
						$('#t3_4').val(data.t3_4);
						$('#t3_5').val(data.t3_5);
						$('#t4_1').val(data.t4_1);
						$('#t4_2').val(data.t4_2);
						$('#t4_3').val(data.t4_3);
						$('#t4_4').val(data.t4_4);
						$('#t4_5').val(data.t4_5);
						$('#t5_1').val(data.t5_1);
						$('#t5_2').val(data.t5_2);
						$('#t5_3').val(data.t5_3);
						$('#t5_4').val(data.t5_4);
						$('#t5_5').val(data.t5_5);
						$('#t6_1').val(data.t6_1);
						$('#t6_2').val(data.t6_2);
						$('#t6_3').val(data.t6_3);
						$('#t6_4').val(data.t6_4);
						$('#t6_5').val(data.t6_5);
						$('#t7_1').val(data.t7_1);
						$('#t7_2').val(data.t7_2);
						$('#t7_3').val(data.t7_3);
						$('#t7_4').val(data.t7_4);
						$('#t7_5').val(data.t7_5);
						$('#temp1').val(data.temp1);


						var chk_sou = data.chk_sou;
						if (chk_sou == "1") {
							$('#txtsou').css("background-color", "var(--success)");
							$("#chk_sou").prop("checked", true);
						} else {
							$('#txtsou').css("background-color", "white");
							$("#chk_sou").prop("checked", false);
						}
						break;
					} else {

					}

				}

				//DTM
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "dtm") {
						var chk_dtm = data.chk_dtm;
						if (chk_dtm == "1") {
							$('#txtdtm').css("background-color", "var(--success)");
							$("#chk_dtm").prop("checked", true);
						} else {
							$('#txtdtm').css("background-color", "white");
							$("#chk_dtm").prop("checked", false);
						}
						$('#dele_1_1').val(data.dele_1_1);
						$('#dele_1_2').val(data.dele_1_2);
						$('#dele_1_3').val(data.dele_1_3);
						$('#dele_1_4').val(data.dele_1_4);
						$('#dele_2_1').val(data.dele_2_1);
						$('#dele_2_2').val(data.dele_2_2);
						$('#dele_2_3').val(data.dele_2_3);
						$('#dele_3_1').val(data.dele_3_1);
						$('#dele_3_2').val(data.dele_3_2);
						$('#dele_3_3').val(data.dele_3_3);
						$('#dele_4_1').val(data.dele_4_1);
						$('#dele_4_2').val(data.dele_4_2);
						$('#dele_4_3').val(data.dele_4_3)
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