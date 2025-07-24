	<?php
	session_start();
	include("header.php");
	//REMOVE SIDE BAR
	/*include("sidebar.php");*/
	include("connection.php");
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
	if (isset($_GET['ulr'])) {
		$ulr = $_GET['ulr'];
	}
	if (isset($_GET['lab_no'])) {
		$lab_no = $_GET['lab_no'];
		$aa	= $_GET['lab_no'];
	}

	?>


	<div class="content-wrapper" style="margin-left:0px !important;">

		<section class="content common_material p-0">
			<?php include("menu.php") ?>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h2 style="text-align:center;">20 MM</h2>
						</div>
						<div class="box-default">
							<form class="form" id="Glazed" method="post">
								<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
								<div class="row">

									<div class="col-lg-6">
										<div class="form-group">

											<!--<label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->

											<div class="col-sm-10">
												<input type="hidden" class="form-control" id="report_no" value="<?php echo $report_no; ?>" name="report_no" disabled>
											</div>


										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-2 control-label">Job No.:</label>-->
											<div class="col-sm-10">
												<input type="hidden" class="form-control" tabindex="1" value="<?php echo $job_no; ?>" id="job_no" name="job_no" disabled>
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
												<input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" disabled>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="control-label">AMOUNT OF SAMPLE TAKEN :</label>
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

									<div class="col-lg-6">
										<div class="form-group">


											<div class="col-sm-10">
												<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" disabled>
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

										<!-- TEST WISE LOGIC VAIBHAV-->
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
																	<b>SIEVE ANALYSIS TEST</b>
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
																		<label for="inputEmail3" class="col-sm-4 control-label label-right">SIEVE ANALYSIS TEST</label>
																	</div>
																</div>

															</div>
															<br>
															<div class="row">

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
																			<label for="inputEmail3" class="col-sm-2 control-label">Cum. Percentage Retained %</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">Percentage Passing %</label>
																		</div>
																	</div>
																</div>
															</div>
															</br>
															<div class="row">

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">40</label>
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
																			<label for="inputEmail3" class="col-sm-2 control-label">20</label>
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
																			<label for="inputEmail3" class="col-sm-2 control-label">10</label>
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
																			<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
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
																			<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
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
																			<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
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
																			<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
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
																			<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
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
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="cum_wt_gm_9" name="cum_wt_gm_9">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="ret_wt_gm_9" name="ret_wt_gm_9">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="cum_ret_9" name="cum_ret_9">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pass_sample_9" name="pass_sample_9">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="cum_wt_gm_10" name="cum_wt_gm_10">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="ret_wt_gm_10" name="ret_wt_gm_10">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="cum_ret_10" name="cum_ret_10">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pass_sample_10" name="pass_sample_10">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="cum_wt_gm_11" name="cum_wt_gm_11">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="ret_wt_gm_11" name="ret_wt_gm_11">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="cum_ret_11" name="cum_ret_11">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pass_sample_11" name="pass_sample_11">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="cum_wt_gm_12" name="cum_wt_gm_12">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="ret_wt_gm_12" name="ret_wt_gm_12">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="cum_ret_12" name="cum_ret_12">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pass_sample_12" name="pass_sample_12">
																		</div>
																	</div>
																</div>
															</div>
															<br>
															<div class="row">

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="cum_wt_gm_13" name="cum_wt_gm_13">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="ret_wt_gm_13" name="ret_wt_gm_13">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="cum_ret_13" name="cum_ret_13">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pass_sample_13" name="pass_sample_13">
																		</div>
																	</div>
																</div>
															</div>


															<br>
															<div class="row">

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<label for="inputEmail3" class="col-sm-2 control-label">Total</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="blank_extra" name="blank_extra" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="blank_extra1" name="blank_extra1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="blank_extra2" name="blank_extra2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="blank_extra3" name="blank_extra3">
																		</div>
																	</div>
																</div>
															</div>
															<br>
														</div>
													</div>
												</div>


											<?php } else if ($r1['test_code'] == "flk") {
												$test_check .= "flk,";

											?>
												<div class="panel panel-default" id="flk">
													<div class="panel-heading" id="txtflk">
														<h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
																<h4 class="panel-title">
																	<b>FLAKINESS INDEX & ELONGATION INDEX</b>
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
																			<label for="chk_flk">8.</label>
																			<input type="checkbox" class="visually-hidden" name="chk_flk" id="chk_flk" value="chk_flk"><br>
																		</div>
																		<label for="inputEmail3" class="col-sm-4 control-label label-right">FLAKINESS</label>
																	</div>
																</div>

															</div>
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label"></label>
																	</div>
																</div>

																<!--div class="col-lg-1">
																<div class="form-group">
																	<!-- <label for="inputEmail3" class="control-label">Percentage(%)</label>>
																</div>
															</div-->


																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Weight of Fraction Retained on Each Seive (A)</label>
																	</div>
																</div>


																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Mass of Pieces passing through Appropraite Gauge (B)</label>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Percentage of Mass of Total Number of Pieces Pass in Each Fraction X = (b/a*100)</label>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Percentage of Each Fraction of Pieces to the Total Mass of Sample Y = (a/A*100)</label>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Weighted Percentage of the Mass of Pieces Passing F = ((X * Y)/100)</label>
																	</div>
																</div>

															</div>

															<br>
															<!--Flakiness Index VALUE SR 1-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">
																			<!--<input type="checkbox" name="chk_f1"  id="chk_f1" value="chk_f1">-->

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s11" name="s11" value="63MM - 50MM">
																		</div>
																	</div>
																</div>




																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="a1" name="a1">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b1" name="b1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="aa1" name="aa1" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dd1" name="dd1" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="x1" name="x1" disabled>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<!--Flakiness Index VALUE SR 2-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s12" name="s12" value="50MM - 40MM">
																		</div>
																	</div>
																</div>


																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="a2" name="a2">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b2" name="b2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="aa2" name="aa2" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dd2" name="dd2" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="x2" name="x2" disabled>
																		</div>
																	</div>
																</div>
																<!-- <div class="col-lg-2">
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
																</div> -->

																<!-- <div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="y2" name="y2">
																		</div>
																	</div>
																</div> -->
															</div>
															<br>
															<!--Flakiness Index VALUE SR 3-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s13" name="s13" value="40MM - 31.5MM">
																		</div>
																	</div>
																</div>

																<!--div class="col-lg-1">
															<div class="form-group">
															<div class="col-sm-12">
																
															</div>
															</div>
															</div-->


																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="a3" name="a3">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b3" name="b3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="aa3" name="aa3" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dd3" name="dd3" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="x3" name="x3" disabled>
																		</div>
																	</div>
																</div>
																<!-- <div class="col-lg-2">
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
																</div> -->

																<!-- <div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="y3" name="y3">
																		</div>
																	</div>
																</div> -->
															</div>
															<br>
															<!--Flakiness Index VALUE SR 4-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s14" name="s14" value="31.5MM - 25MM">
																		</div>
																	</div>
																</div>

																<!--div class="col-lg-1">
															<div class="form-group">
															<div class="col-sm-12">
																
															</div>
															</div>
															</div-->


																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="a4" name="a4">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b4" name="b4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="aa4" name="aa4" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dd4" name="dd4" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="x4" name="x4" disabled>
																		</div>
																	</div>
																</div>
																<!-- <div class="col-lg-2">
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

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="y4" name="y4">
																		</div>
																	</div>
																</div> -->
															</div>
															<br>
															<!--Flakiness Index VALUE SR 5-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s15" name="s15" value="25MM - 20MM">
																		</div>
																	</div>
																</div>

																<!--div class="col-lg-1">
																	<div class="form-group">
																	<div class="col-sm-12">
																		
																	</div>
																	</div>
																	</div-->


																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="a5" name="a5">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b5" name="b5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="aa5" name="aa5" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dd5" name="dd5" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="x5" name="x5" disabled>
																		</div>
																	</div>
																</div>
																<!-- <div class="col-lg-2">
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

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="y5" name="y5">
																		</div>
																	</div>
																</div> -->
															</div>
															<br>
															<!--Flakiness Index VALUE SR 6-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s16" name="s16" value="20MM - 16MM">
																		</div>
																	</div>
																</div>

																<!--div class="col-lg-1">
																	<div class="form-group">
																	<div class="col-sm-12">
																		
																	</div>
																	</div>
																	</div-->


																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="a6" name="a6">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b6" name="b6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="aa6" name="aa6" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dd6" name="dd6" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="x6" name="x6" disabled>
																		</div>
																	</div>
																</div>
																<!-- <div class="col-lg-2">
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

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="y6" name="y6">
																		</div>
																	</div>
																</div> -->
															</div>
															<br>
															<!--Flakiness Index VALUE SR 7-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s17" name="s17" value="16MM - 12.5MM">
																		</div>
																	</div>
																</div>

																<!--div class="col-lg-1">
															<div class="form-group">
															<div class="col-sm-12">
																
															</div>
															</div>
															</div-->


																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="a7" name="a7">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b7" name="b7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="aa7" name="aa7" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dd7" name="dd7" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="x7" name="x7" disabled>
																		</div>
																	</div>
																</div>
																<!-- <div class="col-lg-2">
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

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="y7" name="y7">
																		</div>
																	</div>
																</div> -->
															</div>
															<br>
															<!--Flakiness Index VALUE SR 8-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s18" name="s18" value="12.5MM - 10MM">
																		</div>
																	</div>
																</div>

																<!--div class="col-lg-1">
																<div class="form-group">
																<div class="col-sm-12">
																	
																</div>
																</div>
																</div-->


																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="a8" name="a8">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b8" name="b8">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="aa8" name="aa8" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dd8" name="dd8" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="x8" name="x8" disabled>
																		</div>
																	</div>
																</div>
																<!-- <div class="col-lg-2">
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

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="y8" name="y8">
																		</div>
																	</div>
																</div> -->
															</div>
															<br>
															<!--Flakiness Index VALUE SR 9-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s19" name="s19" value="10MM - 6.3MM">
																		</div>
																	</div>
																</div>

																<!--div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																	
																	</div>
																</div>
															</div-->


																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="a9" name="a9">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="b9" name="b9">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="aa9" name="aa9" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="dd9" name="dd9" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="x9" name="x9" disabled>
																		</div>
																	</div>
																</div>
																<!-- <div class="col-lg-2">
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

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" class="form-control" id="y9" name="y9">
																		</div>
																	</div>
																</div> -->
															</div>
														</div>
														<br>


														<!--Flakiness Index TOTAL -->
														<div class="row">


															<div class="col-lg-12">
																<div class="form-group">
																	<div class="col-lg-2 d-flex justify-content-center">
																		<label for="text" class="control-label">Total</label>
																	</div>


																	<div class="col-lg-2">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<input type="text" class="form-control" id="suma" name="suma" disabled>
																			</div>
																		</div>
																	</div>

																	<div class="col-lg-2">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<input type="text" class="form-control" id="sumb" name="sumb" disabled>
																			</div>
																		</div>
																	</div>

																	<div class="col-lg-2">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<!-- <input type="text" class="form-control" id="sumb" name="sumb" disabled> -->
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<!-- <input type="text" class="form-control" id="sumb" name="sumb" disabled> -->
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<input type="text" class="form-control" id="sumy" name="sumy" disabled>
																			</div>
																		</div>
																	</div>

																	<!-- <div class="col-sm-2">
																		<input type="text" class="form-control" id="suma" name="suma">
																	</div>
																	<div class="col-sm-2">
																		<input type="text" class="form-control" id="suma" name="suma">
																	</div>
																	<div class="col-sm-2">
																		<input type="hidden" class="form-control" id="sumb" name="sumb">
																	</div>
																	<div class="col-sm-2">
																		<input type="hidden" class="form-control" id="sumaa" name="sumaa">
																	</div>
																	<div class="col-sm-2">
																		<input type="text" class="form-control" id="sumdd" name="sumdd">
																	</div>
																	<div class="col-sm-2">

																	</div>
																	<div class="col-sm-2">
																		<input type="hidden" class="form-control" id="sumx" name="sumx">
																	</div>
																	<div class="col-sm-2">
																		<input type="hidden" class="form-control" id="sumy" name="sumy">
																	</div> -->

																</div>
															</div>


														</div>
														<br>
														<div class="row">


															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-4 d-flex justify-content-center">
																		<label for="inputEmail3" class="control-label">FLAKINESS INDEX,F = </label>
																	</div>
																	<div class="col-sm-4">
																		<input type="text" class="form-control" id="fi_index" name="fi_index" disabled>
																	</div>
																	<div class="col-sm-4">
																		<label for="inputEmail3" class="control-label">%</label>
																	</div>
																</div>
															</div>

															<!-- <div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-4">
																	<label for="inputEmail3" class="control-label">ELONGATION INDEX, 100 * C/D = </label>
																</div>
																<div class="col-sm-4">
																	<input type="text" class="form-control" id="ei_index" name="ei_index">
																</div>
																<div class="col-sm-4">
																	<label for="inputEmail3" class="control-label">%</label>
																</div>
															</div>
														</div> -->

														</div>
														<!--Flakiness Index VALUE OVER-->
														<br>
														<div class="row">

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																	</div>
																</div>
															</div>


															<!-- <div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-6">
																	<label for="inputEmail3" class="control-label">Combined Flakiness and Elongation Index (%) =</label>
																</div>
																<div class="col-sm-6">
																	<input type="text" class="form-control" id="combined_index" name="combined_index">
																</div>
																<div class="col-sm-4">
										 							<label for="inputEmail3" class="control-label">%</label>
									  							</div
															</div>
														</div> -->

														</div>



														<div class="panel-body">

															<div class="row">

																<div class="col-lg-8">
																	<div class="form-group">
																		<div class="col-sm-1">
																			<label for="chk_flk"></label>
																			<input type="checkbox" class="visually-hidden" name="chk_flk" id="chk_flk" value="chk_flk"><br>
																		</div>
																		<label for="inputEmail3" class="col-sm-4 control-label label-right">ELONGATION</label>
																	</div>
																</div>

															</div>
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label"></label>
																	</div>
																</div>

																<!--div class="col-lg-1">
																<div class="form-group">
																	<!-- <label for="inputEmail3" class="control-label">Percentage(%)</label>>
																</div>
															</div-->


																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Sample Retained on Each Sieve Fraction (A)</label>
																	</div>
																</div>


																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Mass of Pieces Retained through Appropriate Geuge (B)</label>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Percentage of Mass of Total Number of Pieces Retained in Each Fraction X = b / a * 100</label>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Percentage of Each Fraction of Pieces to the Total Mass of Sample Y = a / A * 100</label>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Weighted Percentage of the Mass of Pieces Retained F = (X*Y)/100</label>
																	</div>
																</div>


															</div>

															<br>
															<!--Flakiness Index VALUE SR 1-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">
																			<!--<input type="checkbox" name="chk_f1"  id="chk_f1" value="chk_f1">-->

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s11" name="s11" value="50mm - 40mm">
																		</div>
																	</div>
																</div>




																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="s1" name="s1">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m1" name="m1">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="p1" name="p1" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pp1" name="pp1" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="w1" name="w1" disabled>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<!--Flakiness Index VALUE SR 2-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s12" name="s12" value="40mm - 25mm">
																		</div>
																	</div>
																</div>



																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="s2" name="s2">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m2" name="m2">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="p2" name="p2" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pp2" name="pp2" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="w2" name="w2" disabled>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<!--Flakiness Index VALUE SR 3-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s13" name="s13" value="25mm - 20mm">
																		</div>
																	</div>
																</div>


																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="s3" name="s3">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m3" name="m3">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="p3" name="p3" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pp3" name="pp3" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="w3" name="w3" disabled>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<!--Flakiness Index VALUE SR 4-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s14" name="s14" value="20mm - 16mm">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="s4" name="s4">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m4" name="m4">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="p4" name="p4" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pp4" name="pp4" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="w4" name="w4" disabled>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<!--Flakiness Index VALUE SR 5-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s15" name="s15" value="16mm - 12.5mm">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="s5" name="s5">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m5" name="m5">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="p5" name="p5" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pp5" name="pp5" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="w5" name="w5" disabled>
																		</div>
																	</div>
																</div>

															</div>
															<br>
															<!--Flakiness Index VALUE SR 6-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s16" name="s16" value="12.5mm - 10mm">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="s6" name="s6">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m6" name="m6">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="p6" name="p6" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pp6" name="pp6" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="w6" name="w6" disabled>
																		</div>
																	</div>
																</div>


															</div>
															<br>
															<!--Flakiness Index VALUE SR 7-->
															<div class="row">
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-3">

																		</div>
																		<div class="col-sm-9">
																			<input type="text" class="form-control" id="s17" name="s17" value="10mm - 6.3mm">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="s7" name="s7">
																		</div>
																	</div>
																</div>

																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="m7" name="m7">
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="p7" name="p7" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="pp7" name="pp7" disabled>
																		</div>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="text" class="form-control" id="w7" name="w7" disabled>
																		</div>
																	</div>
																</div>

															</div>
															<br>
														</div>
														<br>


														<!--Flakiness Index TOTAL -->
														<div class="row">


															<div class="col-lg-12">
																<div class="form-group">
																	<div class="col-lg-2 d-flex justify-content-center">
																		<label for="text" class="control-label">Total</label>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<input type="text" class="form-control" id="suma1" name="suma1" disabled>
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<input type="text" class="form-control" id="suma2" name="suma2" disabled>
																			</div>
																		</div>
																	</div>


																	<div class="col-lg-2">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<!-- <input type="text" class="form-control" id="sumb" name="sumb" disabled> -->
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<!-- <input type="text" class="form-control" id="sumb" name="sumb" disabled> -->
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<div class="col-sm-12">
																				<input type="text" class="form-control" id="sumy1" name="sumy1" disabled>
																			</div>
																		</div>
																	</div>
																	<!-- <div class="col-sm-1">
																		<input type="text" class="form-control" id="suma1" name="suma1">
																	</div>
																	<div class="col-sm-1">
																		<input type="text" class="form-control" id="suma2" name="suma2">
																	</div>
																	<div class="col-sm-1">
																		<input type="hidden" class="form-control" id="sumb" name="sumb">
																	</div>
																	<div class="col-sm-1">
																		<input type="hidden" class="form-control" id="sumaa1" name="sumaa">
																	</div>
																	<div class="col-sm-1">
																		<input type="text" class="form-control" id="sumdd1" name="sumdd">
																	</div>
																	<div class="col-sm-1">

																	</div>
																	<div class="col-sm-1">
																		<input type="hidden" class="form-control" id="sumx1" name="sumx">
																	</div>
																	<div class="col-sm-1">
																		<input type="hidden" class="form-control" id="sumy1" name="sumy">
																	</div> -->

																</div>
															</div>


														</div>
														<br>
														<div class="row">


															<div class="col-lg-6">
																<div class="form-group align-items-center">
																	<div class="col-sm-4 d-flex justify-content-center">
																		<label for="inputEmail3" class="control-label">Elongation Index,E = </label>
																	</div>
																	<div class="col-sm-4">
																		<input type="text" class="form-control" id="fi_index1" name="fi_index1" disabled>
																	</div>
																	<div class="col-sm-4">
																		<label for="inputEmail3" class="control-label">%</label>
																	</div>
																</div>
															</div>


															<!-- <div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-4">
																	<label for="inputEmail3" class="control-label">ELONGATION INDEX, 100 * C/D = </label>
																</div>
																<div class="col-sm-4">
																	<input type="text" class="form-control" id="ei_index" name="ei_index">
																</div>
																<div class="col-sm-4">
																	<label for="inputEmail3" class="control-label">%</label>
																</div>
															</div>
														</div> -->

														</div>
														<!--Flakiness Index VALUE OVER-->
														<br>
														<div class="row">

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																	</div>
																</div>
															</div>


															<!-- <div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-6">
																	<label for="inputEmail3" class="control-label">Combined Flakiness and Elongation Index (%) =</label>
																</div>
																<div class="col-sm-6">
																	<input type="text" class="form-control" id="combined_index" name="combined_index">
																</div>
																<div class="col-sm-4">
										 							<label for="inputEmail3" class="control-label">%</label>
									  							</div
															</div>
														</div> -->

														</div>

													</div>

												</div>
										</div>
									<?php } else if ($r1['test_code'] == "wtr") {
												$test_check .= "wtr,"; ?>

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
																	<label for="chk_sp">2/3.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_sp" id="chk_sp" value="chk_sp"><br>
																</div>
																<label for="inputEmail3" class="col-sm-8 control-label label-right">SPECIFIC GRAVITY & WATER ABSORPTION</label>
															</div>
														</div>
														<div class="col-lg-12">
															<div class="form-group">
																<div class="col-sm-8">
																	<label for="chk_sp" class="d-flex align-items-center">Amount of Sample taken:-
																		<div class="col-sm-15">
																			<input type="text" class="form-control" id="taken_1" name="taken_1">
																		</div>
																		<span style="font-weight: 400;">gm</span>
																		<span class="new_span">(Shall be not less than 2000gm)</span>
																	</label>
																</div>

																<div class="col-sm-4">
																	<label for="chk_sp" class="d-flex align-items-center">Temperature:-
																		<div class="col-sm-15">
																			<input type="text" class="form-control" id="taken_2" name="taken_2">
																		</div>°C
																	</label>
																</div>
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
													<br>
													<br>
													<br>
													<br>
													<div class="row">



														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail2" class="control-label">Sample ID</label>
															</div>
														</div>


														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail2" class="control-label">Wt. of Saturated Surface Dry Sample, A (g)</label>
															</div>
														</div>

														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail2" class="control-label">Wt. of Pycnometer Containing Sample & Filled With Distilled Water, B (g)</label>
															</div>
														</div>

														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail2" class="control-label">Wt. of Pycnometer Filled With distilled Water only, C (g)</label>
															</div>
														</div>

														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail2" class="control-label">Wt. of Oven Dry Sample, D (g)</label>
															</div>
														</div>

														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail2" class="control-label">Specific Gravity Based on Dry Aggregate G = (D)/(A-(B-C))</label>
															</div>
														</div>


														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail2" class="control-label">Specific Gravity Based on Saturated Surface Dry Aggregate G = (A)/(A-(B-C))</label>
															</div>
														</div>

														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail2" class="control-label">Apparent Specific Gravity G = (D)/(D-(B-C))</label>
															</div>
														</div>

														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail2" class="control-label">Water Absorption =100 X (A-D)/D</label>
															</div>
														</div>

													</div>
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
													<div class="row">


														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wt_st_1" name="sp_wt_st_1">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_s_1" name="sp_w_s_1">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_sur_1" name="sp_w_sur_1">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_agg1" name="sp_agg1">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wat1" name="sp_wat1">
																</div>
															</div>
														</div>


														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_a_1" name="sp_specific_gravity_a_1" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_b_1" name="sp_specific_gravity_b_1" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_1" name="sp_specific_gravity_1" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_water_abr_1" name="sp_water_abr_1" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 2-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wt_st_2" name="sp_wt_st_2">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_s_2" name="sp_w_s_2">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_sur_2" name="sp_w_sur_2">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_agg2" name="sp_agg2">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wat2" name="sp_wat2">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_a_2" name="sp_specific_gravity_a_2" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_b_2" name="sp_specific_gravity_b_2" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_2" name="sp_specific_gravity_2" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_water_abr_2" name="sp_water_abr_2" disabled>
																</div>
															</div>
														</div>
													</div>



													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">

															</div>
														</div>
														<!-- <div class="col-lg-2">
														<div class="col-sm-12">
															<input type="hidden" class="form-control" id="sp_sample_ca" name="sp_sample_ca">
														</div>
													</div>  -->
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_a" name="sp_specific_gravity_a" disabled>
																</div>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_b" name="sp_specific_gravity_b" disabled>
																</div>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity" name="sp_specific_gravity" disabled>
																</div>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_water_abr" name="sp_water_abr" disabled>
																</div>
															</div>
														</div>
													</div>

													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE OVER-->


													<br>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 3-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wt_st_3" name="sp_wt_st_3">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_s_3" name="sp_w_s_3">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_sur_3" name="sp_w_sur_3">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_agg3" name="sp_agg3">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wat3" name="sp_wat3">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_a_3" name="sp_specific_gravity_a_3" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_b_3" name="sp_specific_gravity_b_3" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_3" name="sp_specific_gravity_3" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_water_abr_3" name="sp_water_abr_3" disabled>
																</div>
															</div>
														</div>
													</div>
													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 4-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wt_st_4" name="sp_wt_st_4">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_s_4" name="sp_w_s_4">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_sur_4" name="sp_w_sur_4">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_agg4" name="sp_agg4">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wat4" name="sp_wat4">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_a_4" name="sp_specific_gravity_a_4" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_b_4" name="sp_specific_gravity_b_4" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_4" name="sp_specific_gravity_4" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_water_abr_4" name="sp_water_abr_4" disabled>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">

															</div>
														</div>
														<!-- <div class="col-lg-2">
														<div class="col-sm-12">
															<input type="hidden" class="form-control" id="sp_sample_ca" name="sp_sample_ca">
														</div>
													</div>  -->
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_a1" name="sp_specific_gravity_a1" disabled>
																</div>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_b1" name="sp_specific_gravity_b1" disabled>
																</div>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity1" name="sp_specific_gravity1" disabled>
																</div>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_water_abr1" name="sp_water_abr1" disabled>
																</div>
															</div>
														</div>
													</div>

													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 5-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wt_st_5" name="sp_wt_st_5">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_s_5" name="sp_w_s_5">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_sur_5" name="sp_w_sur_5">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_agg5" name="sp_agg5">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wat5" name="sp_wat5">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_a_5" name="sp_specific_gravity_a_5" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_b_5" name="sp_specific_gravity_b_5" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_5" name="sp_specific_gravity_5" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_water_abr_5" name="sp_water_abr_5" disabled>
																</div>
															</div>
														</div>
													</div>

													<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 6-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wt_st_6" name="sp_wt_st_6">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_s_6" name="sp_w_s_6">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_w_sur_6" name="sp_w_sur_6">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_agg6" name="sp_agg6">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_wat6" name="sp_wat6">
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_a_6" name="sp_specific_gravity_a_6" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_b_6" name="sp_specific_gravity_b_6" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_6" name="sp_specific_gravity_6" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_water_abr_6" name="sp_water_abr_6" disabled>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">

															</div>
														</div>
														<!-- <div class="col-lg-2">
														<div class="col-sm-12">
															<input type="hidden" class="form-control" id="sp_sample_ca" name="sp_sample_ca">
														</div>
													</div>  -->
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_a2" name="sp_specific_gravity_a2" disabled>
																</div>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity_b2" name="sp_specific_gravity_b2" disabled>
																</div>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_specific_gravity2" name="sp_specific_gravity2" disabled>
																</div>
															</div>
														</div>
														<div class="col-sm-1">
															<div class="form-group">
																<div class="col-sm-15">
																	<input type="text" class="form-control" id="sp_water_abr2" name="sp_water_abr2" disabled>
																</div>
															</div>
														</div>
													</div>


												</div>
											</div>
										</div>
									<?php
											} else if ($r1['test_code'] == "abr") {
												$test_check .= "abr,";
									?>

										<div class="panel panel-default" id="abr">
											<div class="panel-heading" id="txtabr">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
														<h4 class="panel-title">
															<b>ABRASION VALUE</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse4" class="panel-collapse collapse">
												<div class="panel-body">

													<!--ABRASION VALUE START-->

													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_abr">6.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_abr" id="chk_abr" value="chk_abr"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">ABRASION VALUE</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Grading :</label>-->
																<div class="col-sm-8" style="display:none;">
																	<select class="form-control" id="abr_grading" name="abr_grading">
																		<option value="B">Type : B</option>
																		<option value="A">Type : A</option>

																		<option value="C">Type : C</option>
																		<option value="D">Type : D</option>
																		<option value="E">Type : E</option>
																		<option value="F">Type : F</option>
																		<option value="G">Type : G</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Weight of Charge (gm):</label>-->
																<div class="col-sm-8" style="display:none;">
																	<input type="text" class="form-control" id="abr_weight_charge" name="abr_weight_charge">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Number of spheres used :</label>-->
																<div class="col-sm-8" style="display:none;">
																	<input type="text" class="form-control" id="abr_sphere" name="abr_sphere">
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Number of revolution :</label>-->
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" id="abr_num_revo" name="abr_num_revo">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Sample ID</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Initial Weight (A)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Fraction Retained on 1.70 mm IS Sieve (B)</label>
															</div>
														</div>


														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Fraction Passing on 1.70 mm IS Sieve C = (A-B)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Aggregate Abrasion Value % = C/A X 100</label>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="abr_wt_t_d_1" name="abr_wt_t_d_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="abr_wt_t_a_1" name="abr_wt_t_a_1">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="abr_wt_t_b_1" name="abr_wt_t_b_1">
																</div>
															</div>
														</div>


														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control two-digits" id="abr_wt_t_c_1" name="abr_wt_t_c_1" disabled>
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control two-digits" id="abr_1" name="abr_1" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="abr_wt_t_d_2" name="abr_wt_t_d_2">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="abr_wt_t_a_2" name="abr_wt_t_a_2">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="abr_wt_t_b_2" name="abr_wt_t_b_2">
																</div>
															</div>
														</div>


														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control two-digits" id="abr_wt_t_c_2" name="abr_wt_t_c_2" disabled>
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control two-digits" id="abr_2" name="abr_2" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>

													<div class="row">


														<div class="col-lg-12">
															<div class="form-group">

																<div class="col-lg-2">
																	<div class="form-group">
																		<label for="inputEmail3" class="control-label">Average Abrasion Value (%) :</label>
																	</div>
																</div>

																<div class="col-sm-2">
																	<input type="text" class="form-control two-digits" id="abr_index" name="abr_index" disabled>
																</div>
															</div>
														</div>
													</div>
													<!--ABRASION VALUE OVER-->


												</div>
											</div>
										</div>
									<?php } else if ($r1['test_code'] == "cru") {
												$test_check .= "cru,"; ?>

										<div class="panel panel-default" id="cru">
											<div class="panel-heading" id="txtcru">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
														<h4 class="panel-title">
															<b>CRUSHING VALUE</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse5" class="panel-collapse collapse">
												<div class="panel-body">
													<!--Crushing VALUE Start-->
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_crushing">7.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_crushing" id="chk_crushing" value="chk_crushing"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">CRUSHING VALUE</label>
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Sample ID </label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Fraction Passing on 12.5 mm and Retained on 10 mm IS Sieve (A)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Fraction Passing on 2.36 mm IS Sieve (B)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Fraction Passing on 2.36 mm IS Sieve (C)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Aggregate Crushing Value % = B/A X 100</label>
															</div>
														</div>

													</div>
													<br>
													<!--Crushing VALUE SR 1-->
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cr_d_1" name="cr_d_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cr_a_1" name="cr_a_1">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cr_b_1" name="cr_b_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cr_c_1" name="cr_c_1">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cru_value_1" name="cru_value_1" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<!--Crushing VALUE SR 2-->
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cr_d_2" name="cr_d_2">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cr_a_2" name="cr_a_2">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cr_b_2" name="cr_b_2">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cr_c_2" name="cr_c_2">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cru_value_2" name="cru_value_2" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">

															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">

															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">

															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">Average Crushing Value % :</label>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="cru_value" name="cru_value" disabled>
																</div>
															</div>
														</div>
													</div>

													<!--Crushing VALUE OVER-->


												</div>
											</div>
										</div>
									<?php } else if ($r1['test_code'] == "sou") {
												$test_check .= "sou,"; ?>


										<div class="panel panel-default" id="sou">
											<div class="panel-heading" id="txtsou">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
														<h4 class="panel-title">
															<b>SOUNDNESS</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse6" class="panel-collapse collapse">
												<div class="panel-body">

													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_sou">9.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_sou" id="chk_sou" value="chk_sou"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">SOUNDNESS</label>
															</div>
														</div>

													</div> <!--SOUNDNESS VALUE Start-->
													<br>

													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">Passing</label>
															</div>
														</div>

														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">Retained</label>
															</div>
														</div>


														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-8 control-label" style="text-align:center;">Grading of original Sample percent</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">Weight of test fractions before test</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">Percentage passing finer sieve after test (actual percentage loss)</label>
															</div>
														</div>


														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">Weight average (corrected percent loss)</label>
															</div>
														</div>

													</div>
													<br>

													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">1</label>
															</div>
														</div>

														<div class="col-lg-1">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">2</label>
															</div>
														</div>


														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-8 control-label" style="text-align:center;">3</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">4</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">5</label>
															</div>
														</div>


														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">6</label>
															</div>
														</div>

													</div>
													<br>

													<div class="row">
														<div class="col-lg-12">
															<div class="form-group">
																<label for="inputEmail3" class="control-label" style="text-align:center;">Soundness Test for Coarse Aggregate</label>
															</div>
														</div>



													</div>


													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="border:1px solid black;">63 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="border:1px solid black;">40 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s31" name="s31">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s41" name="s41" value="3000 gm">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s51" name="s51">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s61" name="s61">
																</div>
															</div>
														</div>

													</div>
													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">63 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">50 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s32" name="s32" value="50">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s42" name="s42">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s52" name="s52">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s62" name="s62">
																</div>
															</div>
														</div>

													</div>

													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">50 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">40 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s33" name="s33" value="50">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s43" name="s43">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s53" name="s53">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s63" name="s63">
																</div>
															</div>
														</div>

													</div>
													<!--FIRST OVER-->

													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="border:1px solid black;">40 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="border:1px solid black;">20 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s34" name="s34">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s44" name="s44" value="1500 gm">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s54" name="s54">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s64" name="s64">
																</div>
															</div>
														</div>

													</div>
													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">40 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">25 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s35" name="s35" value="67">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s45" name="s45">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s55" name="s55">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s65" name="s65">
																</div>
															</div>
														</div>

													</div>

													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">25 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">20 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s36" name="s36" value="33">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s46" name="s46">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s56" name="s56">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s66" name="s66">
																</div>
															</div>
														</div>

													</div>
													<!--SECOND OVER-->
													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="border:1px solid black;">20 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="border:1px solid black;">10 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s37" name="s37">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s47" name="s47" value="1000 gm">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s57" name="s57">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s67" name="s67">
																</div>
															</div>
														</div>

													</div>
													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">20 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">12.5 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s38" name="s38" value="67">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s48" name="s48">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s58" name="s58">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s68" name="s68">
																</div>
															</div>
														</div>

													</div>

													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">12.5 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="text-align:center">10 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s39" name="s39" value="33">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s49" name="s49">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s59" name="s59">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s69" name="s69">
																</div>
															</div>
														</div>

													</div>
													<!--THIRD OVER-->
													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="border:1px solid black;">10 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label" style="border:1px solid black;">4.75 MM</label>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s30" name="s30">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s40" name="s40" value="300 gm">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s50" name="s50">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s60" name="s60">
																</div>
															</div>
														</div>

													</div>


													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Total</label>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
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
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="s6total" name="s6total">
																</div>
															</div>
														</div>

													</div>


													<br>
													<!--SOUNDNESS VALUE SR 1-->
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">Result: - Soundness</label>
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="soundness" name="soundness" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1">
															<div class="form-group">
																<div class="col-sm-12">
																	<label for="inputEmail3" class="control-label">%</label>
																</div>
															</div>
														</div>

													</div>

												</div>
											</div>
										</div>
									<?php } else if ($r1['test_code'] == "den") {
												$test_check .= "den,"; ?>



										<div class="panel panel-default" id="den">
											<div class="panel-heading" id="txtden">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse15">
														<h4 class="panel-title">
															<b>BULK DENSITY</b>
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
																	<label for="chk_den">4.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_den" id="chk_den" value="chk_den"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">BULK DENSITY</label>
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
																	<label for="inputEmail3" class="control-label">Particular</label>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">(I)</label>
																</div>
															</div>


															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">(II)</label>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">(III)</label>
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
																		<label for="inputEmail3" class="control-label">Volume of Container<br>M<sub>1</sub></label>
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
																		<label for="inputEmail3" class="control-label">Container Weight with Sample<br>M<sub>2</sub></label>
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
																		<label for="inputEmail3" class="control-label">Container Empty Weight<br>M<sub>3</sub></label>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="m31" name="m31">
																	</div>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="m32" name="m32">
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="m33" name="m33">
																	</div>
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Weight of Sample <br>M<sub>4</sub>=M<sub>2</sub>-M<sub>3</sub></label>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="m41" name="m41" disabled>
																	</div>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="m42" name="m42" disabled>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="m43" name="m43" disabled>
																	</div>
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Bulk Density <br>g=M<sub>4</sub>/M<sub>1</sub></label>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="m51" name="m51" disabled>
																	</div>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="m52" name="m52" disabled>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="m53" name="m53" disabled>
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
															<div class="col-sm-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="avg_wom" name="avg_wom" disabled>
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
												<br>
												<div class="row">
													<div class="col-md-12">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">Bulk Density = Weight of Material / Volume of Mould = </label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="avg_wom1" name="avg_wom1" disabled>
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




												</div> -->
												</div>
											</div>
										</div>
									<?php } else if ($r1['test_code'] == "fin") {
												$test_check .= "fin,";
									?>

										<div class="panel panel-default" id="fin">
											<div class="panel-heading" id="txtfin">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
														<h4 class="panel-title">
															<b>10% FINES VALUE</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse7" class="panel-collapse collapse">
												<div class="panel-body">

													<!--Impact VALUE Start-->
													<br>
													<div class="row">

														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_fines">10.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_fines" id="chk_fines" value="chk_fines"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">10% FINES VALUE</label>
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of sample taken in Mould in gm(A)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Sample after Penetration, passing through 2.36mm IS sieve in gm (B) </label>
															</div>
														</div>


														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">percentage fines y = (B/A) * 100</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Load applied for 20mm penetration of plunger for normal crushed aggregates, in Tonnes, (X)</label>
															</div>
														</div>







													</div>
													<br>
													<!--IMPACT VALUE SR 1-->
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="f_a_1" name="f_a_1">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="f_c_1" name="f_c_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="f_d_1" name="f_d_1" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="f_b_1" name="f_b_1">
																</div>
															</div>
														</div>

													</div>
													<br>
													<!--IMPACT VALUE SR 2-->
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="f_a_2" name="f_a_2">
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="f_c_2" name="f_c_2">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="f_d_2" name="f_d_2" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="f_b_2" name="f_b_2">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-lg-2"></div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Average Value</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="avg_f_d" name="avg_f_d" disabled>(Y)
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="avg_f_c" name="avg_f_c" disabled>(X)
															</div>
														</div>


													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">10 % Fine Value = 14 x X / Y + 4</label>
															</div>
														</div>

														<div class="col-sm-4">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="fines_value" name="fines_value" disabled>
																</div>
															</div>
														</div>




													</div>

													<!--fines VALUE OVER-->

												</div>
											</div>
										</div>

									<?php } else if ($r1['test_code'] == "alk") {
												$test_check .= "alk,"; ?>


										<div class="panel panel-default" id="alk">
											<div class="panel-heading" id="txtalk">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
														<h4 class="panel-title">
															<b>ALKALI REACTIVITY</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse8" class="panel-collapse collapse">
												<div class="panel-body">
													<div class="row">

														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_alkali">11.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_alkali" id="chk_alkali" value="chk_alkali"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">ALKALI REACTIVITY</label>
															</div>
														</div>

													</div>
													<br>

													<div class="row">
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">Sc Observed</label>

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">Weight (W1)</label>

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">Weight (W2)</label>

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">Sc = W1-W2 X 3330</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" id="alk_1" name="alk_1">
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" id="alk_2" name="alk_3">
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" id="alk_3" name="alk_3">

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" id="alk_4" name="alk_4" disabled> milli mol/Lit.
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">V1(ml)</label>

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">V2(ml)</label>

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">V3(ml)</label>

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">Rc = (20 X N(V2-V3)X1000)/V1</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" id="alk_5" name="alk_5">
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" id="alk_6" name="alk_6">
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" id="alk_7" name="alk_7">

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" id="alk_8" name="alk_8" disabled> milli mol/Lit.
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label"></label>

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">Aggregate</label>

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">Ratio = Sc/Rc</label>

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">

															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-3">
															<div class="form-group">
																<input type="hidden" class="form-control" id="alk_9" name="alk_9">
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" id="alk_10" name="alk_10">
															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">
																<input type="text" class="form-control" id="alk_11" name="alk_11">

															</div>
														</div>
														<div class="col-lg-3">
															<div class="form-group">

															</div>
														</div>
													</div>
													<br>

													<!--ABRASION VALUE OVER-->


												</div>
											</div>
										</div>


									<?php } else if ($r1['test_code'] == "lll") {
												$test_check .= "lll,"; ?>


										<div class="panel panel-default" id="lll">
											<div class="panel-heading" id="txtlll">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse11">
														<h4 class="panel-title">
															<b>LIQUID LIMIT</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse11" class="panel-collapse collapse">
												<div class="panel-body">

													<br>

													<br>
													<div class="row">

														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_ll">12.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_ll" id="chk_ll" value="chk_ll"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">LIQUID LIMIT</label>
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-12">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-center">SAMPLE PASSING THROUGH 425 MICRON IS SIEVE</label>
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-6">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-center">SAMPLE WEIGHT ABOUT : 150 gm</label>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-center">PERIOD OF SOAKING BEFORE TEST : 24 Hrs</label>
															</div>
														</div>

													</div>

													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">

															</div>
														</div>

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-center">Liquid Limit</label>
															</div>
														</div>

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-center">Plastic Limit</label>
															</div>
														</div>


													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">Determination No.</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">1</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">2</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">1</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">2</label>
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">No. of Penetration (D) (mm)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="pen1" name="pen1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="pen2" name="pen2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="pen3" name="pen3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="pen4" name="pen4">
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">Container No.</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="cont1" name="cont1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="cont2" name="cont2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="cont3" name="cont3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="cont4" name="cont4">
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">Weight of Container + Wet Soil (gm)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="wc1" name="wc1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="wc2" name="wc2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="wc3" name="wc3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="wc4" name="wc4">
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">Weight of Container + Oven Dry Soil (gm)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="od1" name="od1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="od2" name="od2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="od3" name="od3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="od4" name="od4">
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">Weight of Water (gm)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ww1" name="ww1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ww2" name="ww2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ww3" name="ww3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ww4" name="ww4">
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">Weight of Container (gm)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="wf1" name="wf1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="wf2" name="wf2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="wf3" name="wf3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="wf4" name="wf4">
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">Weight of Oven Dry Soil (gm)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ds1" name="ds1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ds2" name="ds2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ds3" name="ds3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ds4" name="ds4">
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">Moisture % (W<sub>N</sub>)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="mo1" name="mo1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="mo2" name="mo2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="mo3" name="mo3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="mo4" name="mo4">
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">Moisture % (W<sub>L</sub>) = (W<sub>N</sub>)/(0.65 + 0.0175 D)</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ln1" name="ln1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ln2" name="ln2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ln3" name="ln3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ln4" name="ln4">
															</div>
														</div>

													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-left">Average</label>
															</div>
														</div>

														<div class="col-lg-4">
															<div class="form-group">
																<input type="text" class="form-control" id="avg_ll" name="avg_ll">
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<input type="text" class="form-control" id="avg_pl" name="avg_pl">
															</div>
														</div>


													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-center">Liquid Limit % (W<sub>L</sub>)</label>
															</div>
														</div>

														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-center">Plastic Limit % (W<sub>P</sub>)</label>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label label-center">Plasticity Index % (I<sub>P</sub>)</label>
															</div>
														</div>


													</div>
													<br>
													<div class="row">

														<div class="col-lg-4">
															<div class="form-group">
																<input type="text" class="form-control" id="liquide_limit" name="liquide_limit">
															</div>
														</div>

														<div class="col-lg-4">
															<div class="form-group">
																<input type="text" class="form-control" id="plastic_limit" name="plastic_limit">
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<input type="text" class="form-control" id="pi_value" name="pi_value">
															</div>
														</div>


													</div>




												</div>
											</div>
										</div>

									<?php } else if ($r1['test_code'] == "imp") {
												$test_check .= "imp,"; ?>

										<div class="panel panel-default" id="imp">
											<div class="panel-heading" id="txtimp">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse12">
														<h4 class="panel-title">
															<b>IMPACT VALUE</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse12" class="panel-collapse collapse">
												<div class="panel-body">
													<!--Impact VALUE Start-->
													<br>
													<div class="row">

														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_impact">5.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_impact" id="chk_impact" value="chk_impact"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">IMPACT VALUE</label>
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Sample ID:</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Fraction Passing on 12.5 mm and Retained on 10 mm IS Sieve (A):</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Fraction Passing on 2.36 mm IS Sieve (B) :</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Fraction Retained on 2.36 mm IS Sieve (C) :</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Total Weight of Fraction Passing and Retained on 2.36 mm IS Sieve (B + C) :</label>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Aggregate Impact Value (B/A X 100)</label>
															</div>
														</div>
													</div>
													<br>
													<!--IMPACT VALUE SR 1-->
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_w_m_e_1" name="imp_w_m_e_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_w_m_a_1" name="imp_w_m_a_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_w_m_b_1" name="imp_w_m_b_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_w_m_c_1" name="imp_w_m_c_1">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_w_m_d_1" name="imp_w_m_d_1" disabled>
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_value_1" name="imp_value_1" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<!--IMPACT VALUE SR 2-->
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_w_m_e_2" name="imp_w_m_e_2">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_w_m_a_2" name="imp_w_m_a_2">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_w_m_b_2" name="imp_w_m_b_2">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_w_m_c_2" name="imp_w_m_c_2">
																</div>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_w_m_d_2" name="imp_w_m_d_2" disabled>
																</div>
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_value_2" name="imp_value_2" disabled>
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2"></div>

														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-6 control-label">Impact Value %:</label>
															</div>
														</div>
														<div class="col-sm-2">
															<div class="form-group">
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="imp_value" name="imp_value" disabled>
																</div>
															</div>
														</div>
														<div class="col-lg-1"></div>
													</div>
													<!--Impact VALUE OVER-->
												</div>
											</div>
										</div>

									<?php
											} else if ($r1['test_code'] == "pha") {
												$test_check .= "pha,"; ?>

										<div class="panel panel-default" id="pha">
											<div class="panel-heading" id="txtpha">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_pha">
														<h4 class="panel-title">
															<b>pH </b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse_pha" class="panel-collapse collapse">
												<div class="panel-body">
													<!--Impact VALUE Start-->
													<br>
													<div class="row">

														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_pha">6.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_pha" id="chk_pha" value="chk_pha"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">pH</label>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Methods</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">S1</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">S2</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Volume in ml of sample taken (V)</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ph_s1_1" name="ph_s1_1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ph_s2_1" name="ph_s2_1">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">pH)</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ph_s1_2" name="ph_s1_2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="ph_s2_2" name="ph_s2_2">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Average pH</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="avg_ph" name="avg_ph" disabled>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									<?php
											} else if ($r1['test_code'] == "clr") {
												$test_check .= "clr,"; ?>

										<div class="panel panel-default" id="clr">
											<div class="panel-heading" id="txtclr">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_clr">
														<h4 class="panel-title">
															<b>Chloride Content</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse_clr" class="panel-collapse collapse">
												<div class="panel-body">
													<!--Impact VALUE Start-->
													<br>
													<div class="row">
														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_clr">7.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_clr" id="chk_clr" value="chk_clr"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">Chloride Content</label>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Methods</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">S1</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">S2</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Soil Sample</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s1_1" name="clr_s1_1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s2_1" name="clr_s2_1">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Water</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s1_2" name="clr_s1_2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s2_2" name="clr_s2_2">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Water / Soil Ratio (gm/g) W</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s1_3" name="clr_s1_3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s2_3" name="clr_s2_3">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Volume of AgNo3.0.1 Solution (ml), V5</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s1_4" name="clr_s1_4">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s2_4" name="clr_s2_4">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Volume of STD NH4SCn Solutions (ml), V6</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s1_5" name="clr_s1_5">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s2_5" name="clr_s2_5">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">CT - normality of NH4SCn</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s1_6" name="clr_s1_6">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s2_6" name="clr_s2_6">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Chloride = 0.003546*W X {(V5 - (10 x CT x V6))}</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s1_7" name="clr_s1_7">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="clr_s2_7" name="clr_s2_7">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Average</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="av_clr" name="av_clr">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									<?php
											} else if ($r1['test_code'] == "slp") {
												$test_check .= "slp,"; ?>

										<div class="panel panel-default" id="slp">
											<div class="panel-heading" id="txtslp">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_slp">
														<h4 class="panel-title">
															<b>Sulphate</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse_slp" class="panel-collapse collapse">
												<div class="panel-body">
													<!--Impact VALUE Start-->
													<br>
													<div class="row">
														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_slp">7.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_slp" id="chk_slp" value="chk_slp"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">Sulphate</label>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Methods</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">S1</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">S2</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Initial Weight of Sample (A) gm</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="slp_s1_1" name="slp_s1_1">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="slp_s2_1" name="slp_s2_1">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Empty Weight of Crucible (B) gm</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="slp_s1_2" name="slp_s1_2">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="slp_s2_2" name="slp_s2_2">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight o Crucible + Sample after Ignition (C) gm</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="slp_s1_3" name="slp_s1_3">
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="slp_s2_3" name="slp_s2_3">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of Residue after ignition d = (C-B) gm</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="slp_s1_4" name="slp_s1_4" disabled>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="slp_s2_4" name="slp_s2_4" disabled>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">S04 (%) = 41.15*D/A</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="slp_s1_5" name="slp_s1_5" disabled>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="slp_s2_5" name="slp_s2_5" disabled>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-2">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Average</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="avg_sul" name="avg_sul" disabled>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">

															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

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
																<label for="inputEmail3" class="control-label">Deleterious Material </label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">i. % Finer than 75u</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of sample gm (B)</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_1_1" name="dele_1_1">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">After washing through wter, then over dry weight</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_1_2" name="dele_1_2">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of sample gm C</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_1_3" name="dele_1_3" disabled>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">% finer then 75u</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_1_4" name="dele_1_4" disabled>
															</div>
														</div>
													</div>
													<br>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">ii. % Clay nd Lumps</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Wt of Saample gm (W)</label>
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
																<label for="inputEmail3" class="control-label">After broken with finger then passing 2.36mm IS sieve gm (R)</label>
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
																<label for="inputEmail3" class="control-label">% Clay lumps = (W-R)/B*100</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_2_3" name="dele_2_3" disabled>
															</div>
														</div>
													</div>
													<br>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">iii. % Coal And Lignite</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Wt of sample gm (W1)</label>
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
																<label for="inputEmail3" class="control-label">Introduce in to heavy liquid wt gm (W2)</label>
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
																<label for="inputEmail3" class="control-label">% Coal & Ligntie = (W1-W2)/W1*100</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_3_3" name="dele_3_3" disabled>
															</div>
														</div>
													</div>
													<br>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">iv. % Soft Particle</label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Weight of sample as per IS 2386(P-2), CL no 5.3.1 gms(A)</label>
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
																<label for="inputEmail3" class="control-label">Weight of soft particle broken from surfce after brass rod rubbing gms (B)</label>
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
																<label for="inputEmail3" class="control-label">% Soft particle :- B/A *100</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="dele_4_3" name="dele_4_3" disabled>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>

									<?php
											} else if ($r1['test_code'] == "aoi") {
												$test_check .= "aoi,"; ?>
										<div class="panel panel-default" id="aoi">
											<div class="panel-heading" id="txtaoi">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse_aoi">
														<h4 class="panel-title">
															<b>ORGANIC IMPURITIES</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse_aoi" class="panel-collapse collapse">
												<div class="panel-body">
													<!--Impact VALUE Start-->
													<br>
													<div class="row">
														<div class="col-lg-8">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_aoi">9.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_aoi" id="chk_aoi" value="chk_aoi"><br>
																</div>
																<label for="inputEmail3" class="col-sm-4 control-label label-right">ORGANIC IMPURITIES</label>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">ORGANIC IMPURITIES </label>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Fill Solutions upto Mark</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="aoi_1" name="aoi_1">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Fill Sand upto mark</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="aoi_2" name="aoi_2">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Further fill solution upto mark</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="aoi_3" name="aoi_3">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Observation</label>
															</div>
														</div>
														<div class="col-lg-2">
															<div class="form-group">
																<input type="text" class="form-control" id="aoi_4" name="aoi_4" value="Visual Match With Standard Solution, Organic Impurities Not Detected.">
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>


								<?php
											}
										} ?>

								</div>
								<br>
								<hr>
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
												$querys_job1 = "SELECT * FROM kapachi_20_mm WHERE `is_deleted`='0' and lab_no='$lab_no'";
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

											<div class="col-sm-2">
												<a target='_blank' href="<?php echo $base_url; ?>print_report/print_kapchi_20_mm_physics.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

											</div>

											<div class="col-sm-2">
												<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_kapchi_20_physics.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>&&tbl_name=kapachi_20_mm" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

											</div>
										</div>
									</div>
								</div>
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
												$query = "select * from kapachi_20_mm WHERE lab_no='$aa'  and `is_deleted`='0'";

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
								</div> <!-- TEST LIST FILD VAIBHAV-->
								<input type="hidden" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ','); ?>">
							</form>
						</div>

					</div>
				</div>
			</div>
		</section>

	</div>





	<?php include("footer.php"); ?>
	<script>
		$(function() {
			$('.select2').select2();
		})
		$(document).ready(function() {
			$('#btn_edit_data').hide();
			$('#alert').hide();

			//ABRASION INDEX
			function abr_auto() {
				console.log("----dd-d-d-d-d-");
				$('#txtabr').css("background-color", "var(--success)");
				var abr_grading = $("#abr_grading").val();
				if (abr_grading == "A") {
					var abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
					var abr_sphere = 12;
					var abr_num_revo = 500;
					$('#abr_sphere').val(abr_sphere);
					$('#abr_num_revo').val(abr_num_revo);
					$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));

					var abr_index = randomNumberFromRange(16.0, 23.0);
					$('#abr_index').val(abr_index.toFixed(1));
					var abrindex = $('#abr_index').val();
					var tt = randomNumberFromRange(-0.99, 0.99).toFixed(2);
					var r = randomNumberFromRange(0, 9).toFixed();
					if (r % 2 == 0) {
						abr_1 = (+abrindex) + (+tt);
						abr_2 = (+abrindex) - (+tt);
					} else {
						abr_1 = (+abrindex) - (+tt);
						abr_2 = (+abrindex) + (+tt);
					}
					var abr_wt_t_a_1 = 5000;
					var abr_wt_t_a_2 = 5000;
					$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
					$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
					$('#abr_1').val(abr_1.toFixed(2));
					$('#abr_2').val(abr_2.toFixed(2));
					var abr1 = $('#abr_1').val();
					var abr2 = $('#abr_2').val();
					var abr_wt_t_a1 = $('#abr_wt_t_a_1').val();
					var abr_wt_t_a2 = $('#abr_wt_t_a_2').val();
					var aa1 = (+abr1) / 100;
					var aa2 = (+abr2) / 100;
					var abr_wt_t_c_1 = (+aa1) * (+abr_wt_t_a1);
					var abr_wt_t_c_2 = (+aa2) * (+abr_wt_t_a2);
					$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed());
					$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed());
					var abr_wt_t_c1 = $('#abr_wt_t_c_1').val();
					var abr_wt_t_c2 = $('#abr_wt_t_c_2').val();
					var abr_wt_t_b_1 = (+abr_wt_t_a1) - (+abr_wt_t_c1);
					var abr_wt_t_b_2 = (+abr_wt_t_a2) - (+abr_wt_t_c2);
					$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());
					$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());



				} else if (abr_grading == "B") {
					var abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
					var abr_sphere = 12;
					var abr_num_revo = 500;
					$('#abr_sphere').val(abr_sphere);
					$('#abr_num_revo').val(abr_num_revo);
					$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));

					var abr_index = randomNumberFromRange(18.0, 23.0);
					$('#abr_index').val(abr_index.toFixed(1));
					var abrindex = $('#abr_index').val();
					var tt = randomNumberFromRange(-0.99, 0.99).toFixed(2);
					var r = randomNumberFromRange(0, 9).toFixed();
					if (r % 2 == 0) {
						abr_1 = (+abrindex) + (+tt);
						abr_2 = (+abrindex) - (+tt);
					} else {
						abr_1 = (+abrindex) - (+tt);
						abr_2 = (+abrindex) + (+tt);
					}

					var abr_wt_t_a_1 = 5000;
					var abr_wt_t_a_2 = 5000;
					$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
					$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
					$('#abr_1').val(abr_1.toFixed(2));
					$('#abr_2').val(abr_2.toFixed(2));
					var abr1 = $('#abr_1').val();
					var abr2 = $('#abr_2').val();
					var abr_wt_t_a1 = $('#abr_wt_t_a_1').val();
					var abr_wt_t_a2 = $('#abr_wt_t_a_2').val();
					var aa1 = (+abr1) / 100;
					var aa2 = (+abr2) / 100;
					var abr_wt_t_c_1 = (+aa1) * (+abr_wt_t_a1);
					var abr_wt_t_c_2 = (+aa2) * (+abr_wt_t_a2);
					$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed());
					$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed());
					var abr_wt_t_c1 = $('#abr_wt_t_c_1').val();
					var abr_wt_t_c2 = $('#abr_wt_t_c_2').val();
					var abr_wt_t_b_1 = (+abr_wt_t_a1) - (+abr_wt_t_c1);
					var abr_wt_t_b_2 = (+abr_wt_t_a2) - (+abr_wt_t_c2);
					$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());
					$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());

				} else if (abr_grading == "C") {
					var abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
					var abr_sphere = 6;
					var abr_num_revo = 500;
					$('#abr_sphere').val(abr_sphere);
					$('#abr_num_revo').val(abr_num_revo);
					$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));

					var abr_index = randomNumberFromRange(16.0, 23.0);
					$('#abr_index').val(abr_index.toFixed(1));
					var abrindex = $('#abr_index').val();
					var tt = randomNumberFromRange(-0.99, 0.99).toFixed(2);
					var r = randomNumberFromRange(0, 9).toFixed();
					if (r % 2 == 0) {
						abr_1 = (+abrindex) + (+tt);
						abr_2 = (+abrindex) - (+tt);
					} else {
						abr_1 = (+abrindex) - (+tt);
						abr_2 = (+abrindex) + (+tt);
					}
					var abr_wt_t_a_1 = 5000;
					var abr_wt_t_a_2 = 5000;
					$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
					$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
					$('#abr_1').val(abr_1.toFixed(2));
					$('#abr_2').val(abr_2.toFixed(2));
					var abr1 = $('#abr_1').val();
					var abr2 = $('#abr_2').val();
					var abr_wt_t_a1 = $('#abr_wt_t_a_1').val();
					var abr_wt_t_a2 = $('#abr_wt_t_a_2').val();
					var aa1 = (+abr1) / 100;
					var aa2 = (+abr2) / 100;
					var abr_wt_t_c_1 = (+aa1) * (+abr_wt_t_a1);
					var abr_wt_t_c_2 = (+aa2) * (+abr_wt_t_a2);
					$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed());
					$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed());
					var abr_wt_t_c1 = $('#abr_wt_t_c_1').val();
					var abr_wt_t_c2 = $('#abr_wt_t_c_2').val();
					var abr_wt_t_b_1 = (+abr_wt_t_a1) - (+abr_wt_t_c1);
					var abr_wt_t_b_2 = (+abr_wt_t_a2) - (+abr_wt_t_c2);
					$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());
					$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());
				} else if (abr_grading == "D") {
					var abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
					var abr_sphere = 6;
					var abr_num_revo = 500;
					$('#abr_sphere').val(abr_sphere);
					$('#abr_num_revo').val(abr_num_revo);
					$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));

					var abr_index = randomNumberFromRange(16.0, 23.0);
					$('#abr_index').val(abr_index.toFixed(1));
					var abrindex = $('#abr_index').val();
					var tt = randomNumberFromRange(-0.99, 0.99).toFixed(2);
					var r = randomNumberFromRange(0, 9).toFixed();
					if (r % 2 == 0) {
						abr_1 = (+abrindex) + (+tt);
						abr_2 = (+abrindex) - (+tt);
					} else {
						abr_1 = (+abrindex) - (+tt);
						abr_2 = (+abrindex) + (+tt);
					}
					var abr_wt_t_a_1 = 5000;
					var abr_wt_t_a_2 = 5000;
					$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
					$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
					$('#abr_1').val(abr_1.toFixed(2));
					$('#abr_2').val(abr_2.toFixed(2));
					var abr1 = $('#abr_1').val();
					var abr2 = $('#abr_2').val();
					var abr_wt_t_a1 = $('#abr_wt_t_a_1').val();
					var abr_wt_t_a2 = $('#abr_wt_t_a_2').val();
					var aa1 = (+abr1) / 100;
					var aa2 = (+abr2) / 100;
					var abr_wt_t_c_1 = (+aa1) * (+abr_wt_t_a1);
					var abr_wt_t_c_2 = (+aa2) * (+abr_wt_t_a2);
					$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed());
					$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed());
					var abr_wt_t_c1 = $('#abr_wt_t_c_1').val();
					var abr_wt_t_c2 = $('#abr_wt_t_c_2').val();
					var abr_wt_t_b_1 = (+abr_wt_t_a1) - (+abr_wt_t_c1);
					var abr_wt_t_b_2 = (+abr_wt_t_a2) - (+abr_wt_t_c2);
					$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());
					$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());
				} else if (abr_grading == "E") {
					var abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
					var abr_sphere = 12;
					var abr_num_revo = 500;
					$('#abr_sphere').val(abr_sphere);
					$('#abr_num_revo').val(abr_num_revo);
					$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));

					var abr_index = randomNumberFromRange(16.0, 23.0);
					$('#abr_index').val(abr_index.toFixed(1));
					var abrindex = $('#abr_index').val();
					var tt = randomNumberFromRange(-0.99, 0.99).toFixed(2);
					var r = randomNumberFromRange(0, 9).toFixed();
					if (r % 2 == 0) {
						abr_1 = (+abrindex) + (+tt);
						abr_2 = (+abrindex) - (+tt);
					} else {
						abr_1 = (+abrindex) - (+tt);
						abr_2 = (+abrindex) + (+tt);
					}
					var abr_wt_t_a_1 = 5000;
					var abr_wt_t_a_2 = 5000;
					$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
					$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
					$('#abr_1').val(abr_1.toFixed(2));
					$('#abr_2').val(abr_2.toFixed(2));
					var abr1 = $('#abr_1').val();
					var abr2 = $('#abr_2').val();
					var abr_wt_t_a1 = $('#abr_wt_t_a_1').val();
					var abr_wt_t_a2 = $('#abr_wt_t_a_2').val();
					var aa1 = (+abr1) / 100;
					var aa2 = (+abr2) / 100;
					var abr_wt_t_c_1 = (+aa1) * (+abr_wt_t_a1);
					var abr_wt_t_c_2 = (+aa2) * (+abr_wt_t_a2);
					$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed());
					$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed());
					var abr_wt_t_c1 = $('#abr_wt_t_c_1').val();
					var abr_wt_t_c2 = $('#abr_wt_t_c_2').val();
					var abr_wt_t_b_1 = (+abr_wt_t_a1) - (+abr_wt_t_c1);
					var abr_wt_t_b_2 = (+abr_wt_t_a2) - (+abr_wt_t_c2);
					$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());
					$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());
				} else if (abr_grading == "F") {
					var abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
					var abr_sphere = 12;
					var abr_num_revo = 500;
					$('#abr_sphere').val(abr_sphere);
					$('#abr_num_revo').val(abr_num_revo);
					$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));

					var abr_index = randomNumberFromRange(16.0, 23.0);
					$('#abr_index').val(abr_index.toFixed(1));
					var abrindex = $('#abr_index').val();
					var tt = randomNumberFromRange(-0.99, 0.99).toFixed(2);
					var r = randomNumberFromRange(0, 9).toFixed();
					if (r % 2 == 0) {
						abr_1 = (+abrindex) + (+tt);
						abr_2 = (+abrindex) - (+tt);
					} else {
						abr_1 = (+abrindex) - (+tt);
						abr_2 = (+abrindex) + (+tt);
					}
					var abr_wt_t_a_1 = 5000;
					var abr_wt_t_a_2 = 5000;
					$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
					$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
					$('#abr_1').val(abr_1.toFixed(2));
					$('#abr_2').val(abr_2.toFixed(2));
					var abr1 = $('#abr_1').val();
					var abr2 = $('#abr_2').val();
					var abr_wt_t_a1 = $('#abr_wt_t_a_1').val();
					var abr_wt_t_a2 = $('#abr_wt_t_a_2').val();
					var aa1 = (+abr1) / 100;
					var aa2 = (+abr2) / 100;
					var abr_wt_t_c_1 = (+aa1) * (+abr_wt_t_a1);
					var abr_wt_t_c_2 = (+aa2) * (+abr_wt_t_a2);
					$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed());
					$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed());
					var abr_wt_t_c1 = $('#abr_wt_t_c_1').val();
					var abr_wt_t_c2 = $('#abr_wt_t_c_2').val();
					var abr_wt_t_b_1 = (+abr_wt_t_a1) - (+abr_wt_t_c1);
					var abr_wt_t_b_2 = (+abr_wt_t_a2) - (+abr_wt_t_c2);
					$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());
					$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());
				} else if (abr_grading == "G") {
					var abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
					var abr_sphere = 12;
					var abr_num_revo = 500;
					$('#abr_sphere').val(abr_sphere);
					$('#abr_num_revo').val(abr_num_revo);
					$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));

					var abr_index = randomNumberFromRange(16.0, 23.0);
					$('#abr_index').val(abr_index.toFixed(1));
					var abrindex = $('#abr_index').val();
					var tt = randomNumberFromRange(-0.99, 0.99).toFixed(2);
					var r = randomNumberFromRange(0, 9).toFixed();
					if (r % 2 == 0) {
						abr_1 = (+abrindex) + (+tt);
						abr_2 = (+abrindex) - (+tt);
					} else {
						abr_1 = (+abrindex) - (+tt);
						abr_2 = (+abrindex) + (+tt);
					}
					var abr_wt_t_a_1 = 5000;
					var abr_wt_t_a_2 = 5000;
					$('#abr_wt_t_a_1').val(abr_wt_t_a_1);
					$('#abr_wt_t_a_2').val(abr_wt_t_a_2);
					$('#abr_1').val(abr_1.toFixed(2));
					$('#abr_2').val(abr_2.toFixed(2));
					var abr1 = $('#abr_1').val();
					var abr2 = $('#abr_2').val();
					var abr_wt_t_a1 = $('#abr_wt_t_a_1').val();
					var abr_wt_t_a2 = $('#abr_wt_t_a_2').val();
					var aa1 = (+abr1) / 100;
					var aa2 = (+abr2) / 100;
					var abr_wt_t_c_1 = (+aa1) * (+abr_wt_t_a1);
					var abr_wt_t_c_2 = (+aa2) * (+abr_wt_t_a2);
					$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed());
					$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed());
					var abr_wt_t_c1 = $('#abr_wt_t_c_1').val();
					var abr_wt_t_c2 = $('#abr_wt_t_c_2').val();
					var abr_wt_t_b_1 = (+abr_wt_t_a1) - (+abr_wt_t_c1);
					var abr_wt_t_b_2 = (+abr_wt_t_a2) - (+abr_wt_t_c2);
					$('#abr_wt_t_b_1').val(abr_wt_t_b_1.toFixed());
					$('#abr_wt_t_b_2').val(abr_wt_t_b_2.toFixed());
				}
				//SIDHU
				var abr_a1 = $('#abr_wt_t_a_1').val();
				var abr_a2 = $('#abr_wt_t_a_2').val();
				var abr_b1 = $('#abr_wt_t_b_1').val();
				var abr_b2 = $('#abr_wt_t_b_2').val();

				var abr_c_1 = (+abr_a1) - (+abr_b1);
				var abr_c_2 = (+abr_a2) - (+abr_b2);

				$('#abr_wt_t_c_1').val(abr_c_1.toFixed());
				$('#abr_wt_t_c_2').val(abr_c_2.toFixed());

				var abr_c1 = $('#abr_wt_t_c_1').val();
				var abr_c2 = $('#abr_wt_t_c_2').val();

				var tempabr1 = (+abr_c1) / (+abr_a1);
				var tempabr2 = (+abr_c2) / (+abr_a2);

				var abra_1 = (+tempabr1) * 100;
				var abra_2 = (+tempabr2) * 100;
				$('#abr_1').val(abra_1.toFixed(2));
				$('#abr_2').val(abra_2.toFixed(2));

				var abr_ans1 = $('#abr_1').val();
				var abr_ans2 = $('#abr_2').val();

				var avg_temp = (+abr_ans1) + (+abr_ans2);
				var ans_abr = (+avg_temp) / 2;




				$('#abr_index').val(ans_abr.toFixed(1));


			 $('#abr_wt_t_a_1').val( randomNumberFromRange(4975.00, 5025.00).toFixed(2));
			 $('#abr_wt_t_a_2').val( randomNumberFromRange(4975.00, 5025.00).toFixed(2));
			 $('#abr_wt_t_b_1').val( randomNumberFromRange(4975.00, 5025.00).toFixed(2));
			 $('#abr_wt_t_b_2').val( randomNumberFromRange(4975.00, 5025.00).toFixed(2));

				var abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
				var abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
				var abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
				var abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();

				var abr_wt_t_c_1 = ((+abr_wt_t_a_1) - (+abr_wt_t_b_1));
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
				var abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();

				var abr_wt_t_c_2 = ((+abr_wt_t_a_2) - (+abr_wt_t_b_2));
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed(2));
				var abr_wt_t_c_2 = $('#abr_wt_t_c_2').val();

				var abr_1 = (((+abr_wt_t_c_1) / (+abr_wt_t_a_1)) * (+100));
				$('#abr_1').val(abr_1.toFixed(2));
				var abr_1 = $('#abr_1').val();

				var abr_2 = (((+abr_wt_t_c_2) / (+abr_wt_t_a_2)) * (+100));
				$('#abr_2').val(abr_2.toFixed(2));
				var abr_2 = $('#abr_2').val();

				var abr_index = ((+abr_1) + (+abr_2)) / (+2);
				$('#abr_index').val(abr_index.toFixed(2));
				var abr_index = $('#abr_index').val();
			}





			// Vivek : Change
			$('#s1,#s2,#s3,#s4,#s5,#s6,#s7,#m1,#m2,#m3,#m4,#m5,#m6,#m7').change(function() {
				var s1 = $('#s1').val();
				var s2 = $('#s2').val();
				var s3 = $('#s3').val();
				var s4 = $('#s4').val();
				var s5 = $('#s5').val();
				var s6 = $('#s6').val();
				var s7 = $('#s7').val();

				var m1 = $('#m1').val();
				var m2 = $('#m2').val();
				var m3 = $('#m3').val();
				var m4 = $('#m4').val();
				var m5 = $('#m5').val();
				var m6 = $('#m6').val();
				var m7 = $('#m7').val();

				var p1 = (((+m1) / (+s1)) * (+100));
				$('#p1').val(p1.toFixed(2));
				var p1 = $('#p1').val();

				var p2 = (((+m2) / (+s2)) * (+100));
				$('#p2').val(p2.toFixed(2));
				var p2 = $('#p2').val();

				var p3 = (((+m3) / (+s3)) * (+100));
				$('#p3').val(p3.toFixed(2));
				var p3 = $('#p3').val();

				var p4 = (((+m4) / (+s4)) * (+100));
				$('#p4').val(p4.toFixed(2));
				var p4 = $('#p4').val();

				var p5 = (((+m5) / (+s5)) * (+100));
				$('#p5').val(p5.toFixed(2));
				var p5 = $('#p5').val();

				var p6 = (((+m6) / (+s6)) * (+100));
				$('#p6').val(p6.toFixed(2));
				var p6 = $('#p6').val();

				var p7 = (((+m7) / (+s7)) * (+100));
				$('#p7').val(p7.toFixed(2));
				var p7 = $('#p7').val();


				var suma1 = (((+s1) + (+s2) + (+s3) + (+s4) + (+s5) + (+s6) + (+s7)));
				$('#suma1').val(suma1.toFixed(2));
				var suma1 = $('#suma1').val();


				var suma2 = (((+m1) + (+m2) + (+m3) + (+m4) + (+m5) + (+m6) + (+m7)));
				$('#suma2').val(suma2.toFixed(2));
				var suma2 = $('#suma2').val();


				var pp1 = (((+s1) / (+suma1)) * (+100));
				$('#pp1').val(pp1.toFixed(2));
				var pp1 = $('#pp1').val();

				var pp2 = (((+s2) / (+suma1)) * (+100));
				$('#pp2').val(pp2.toFixed(2));
				var pp2 = $('#pp2').val();

				var pp3 = (((+s3) / (+suma1)) * (+100));
				$('#pp3').val(pp3.toFixed(2));
				var pp3 = $('#pp3').val();

				var pp4 = (((+s4) / (+suma1)) * (+100));
				$('#pp4').val(pp4.toFixed(2));
				var pp4 = $('#pp4').val();

				var pp5 = (((+s5) / (+suma1)) * (+100));
				$('#pp5').val(pp5.toFixed(2));
				var pp5 = $('#pp5').val();

				var pp6 = (((+s6) / (+suma1)) * (+100));
				$('#pp6').val(pp6.toFixed(2));
				var pp6 = $('#pp6').val();

				var pp7 = (((+s7) / (+suma1)) * (+100));
				$('#pp7').val(pp7.toFixed(2));
				var pp7 = $('#pp7').val();


				var w1 = (((+p1) * (+pp1)) / (+100));
				$('#w1').val(w1.toFixed(2));
				var w1 = $('#w1').val();

				var w2 = (((+p2) * (+pp2)) / (+100));
				$('#w2').val(w2.toFixed(2));
				var w2 = $('#w2').val();

				var w3 = (((+p3) * (+pp3)) / (+100));
				$('#w3').val(w3.toFixed(2));
				var w3 = $('#w3').val();

				var w4 = (((+p4) * (+pp4)) / (+100));
				$('#w4').val(w4.toFixed(2));
				var w4 = $('#w4').val();

				var w5 = (((+p5) * (+pp5)) / (+100));
				$('#w5').val(w5.toFixed(2));
				var w5 = $('#w5').val();

				var w6 = (((+p6) * (+pp6)) / (+100));
				$('#w6').val(w6.toFixed(2));
				var w6 = $('#w6').val();

				var w7 = (((+p7) * (+pp7)) / (+100));
				$('#w7').val(w7.toFixed(2));
				var w7 = $('#w7').val();



				var sumy1 = (((+w1) + (+w2) + (+w3) + (+w4) + (+w5) + (+w6) + (+w7)));
				$('#sumy1').val(sumy1.toFixed(2));
				var sumy1 = $('#sumy1').val();



				var fi_index1 = (+sumy1) / (+5);
				$('#fi_index1').val(fi_index1.toFixed(2));
				var fi_index1 = $('#fi_index1').val();



			});




			// Vivek : Change
			$('#a1,#a2,#a3,#a4,#a5,#a6,#a7,#a8,#a9,#b1,#b2,#b3,#b4,#b5,#b6,#b7,#b8,#b9').change(function() {
				var a1 = $('#a1').val();
				var a2 = $('#a2').val();
				var a3 = $('#a3').val();
				var a4 = $('#a4').val();
				var a5 = $('#a5').val();
				var a6 = $('#a6').val();
				var a7 = $('#a7').val();
				var a8 = $('#a8').val();
				var a9 = $('#a9').val();

				var b1 = $('#b1').val();
				var b2 = $('#b2').val();
				var b3 = $('#b3').val();
				var b4 = $('#b4').val();
				var b5 = $('#b5').val();
				var b6 = $('#b6').val();
				var b7 = $('#b7').val();
				var b8 = $('#b8').val();
				var b9 = $('#b9').val();

				var aa1 = (((+b1) / (+a1)) * (+100));
				$('#aa1').val(aa1.toFixed(2));
				var aa1 = $('#aa1').val();

				var aa2 = (((+b2) / (+a2)) * (+100));
				$('#aa2').val(aa2.toFixed(2));
				var aa2 = $('#aa2').val();

				var aa3 = (((+b3) / (+a3)) * (+100));
				$('#aa3').val(aa3.toFixed(2));
				var aa3 = $('#aa3').val();

				var aa4 = (((+b4) / (+a4)) * (+100));
				$('#aa4').val(aa4.toFixed(2));
				var aa4 = $('#aa4').val();

				var aa5 = (((+b5) / (+a5)) * (+100));
				$('#aa5').val(aa5.toFixed(2));
				var aa5 = $('#aa5').val();

				var aa6 = (((+b6) / (+a6)) * (+100));
				$('#aa6').val(aa6.toFixed(2));
				var aa6 = $('#aa6').val();

				var aa7 = (((+b7) / (+a7)) * (+100));
				$('#aa7').val(aa7.toFixed(2));
				var aa7 = $('#aa7').val();

				var aa8 = (((+b8) / (+a8)) * (+100));
				$('#aa8').val(aa8.toFixed(2));
				var aa8 = $('#aa8').val();

				var aa9 = (((+b9) / (+a9)) * (+100));
				$('#aa9').val(aa9.toFixed(2));
				var aa9 = $('#aa9').val();

				var suma = (((+a1) + (+a2) + (+a3) + (+a4) + (+a5) + (+a6) + (+a7) + (+a8) + (+a9)));
				$('#suma').val(suma.toFixed(2));
				var suma = $('#suma').val();


				var sumb = (((+b1) + (+b2) + (+b3) + (+b4) + (+b5) + (+b6) + (+b7) + (+b8) + (+b9)));
				$('#sumb').val(sumb.toFixed(2));
				var sumb = $('#sumb').val();

				var dd1 = (((+a1) / (+suma)) * (+100));
				$('#dd1').val(dd1.toFixed(2));
				var dd1 = $('#dd1').val();

				var dd2 = (((+a2) / (+suma)) * (+100));
				$('#dd2').val(dd2.toFixed(2));
				var dd2 = $('#dd2').val();

				var dd3 = (((+a3) / (+suma)) * (+100));
				$('#dd3').val(dd3.toFixed(2));
				var dd3 = $('#dd3').val();

				var dd4 = (((+a4) / (+suma)) * (+100));
				$('#dd4').val(dd4.toFixed(2));
				var dd4 = $('#dd4').val();

				var dd5 = (((+a5) / (+suma)) * (+100));
				$('#dd5').val(dd5.toFixed(2));
				var dd5 = $('#dd5').val();

				var dd6 = (((+a6) / (+suma)) * (+100));
				$('#dd6').val(dd6.toFixed(2));
				var dd6 = $('#dd6').val();

				var dd7 = (((+a7) / (+suma)) * (+100));
				$('#dd7').val(dd7.toFixed(2));
				var dd7 = $('#dd7').val();

				var dd8 = (((+a8) / (+suma)) * (+100));
				$('#dd8').val(dd8.toFixed(2));
				var dd8 = $('#dd8').val();

				var dd9 = (((+a9) / (+suma)) * (+100));
				$('#dd9').val(dd9.toFixed(2));
				var dd9 = $('#dd9').val();

				var x1 = (((+aa1) * (+dd1)) / (+100));
				$('#x1').val(x1.toFixed(2));
				var x1 = $('#x1').val();

				var x2 = (((+aa2) * (+dd2)) / (+100));
				$('#x2').val(x2.toFixed(2));
				var x2 = $('#x2').val();

				var x3 = (((+aa3) * (+dd3)) / (+100));
				$('#x3').val(x3.toFixed(2));
				var x3 = $('#x3').val();

				var x4 = (((+aa4) * (+dd4)) / (+100));
				$('#x4').val(x4.toFixed(2));
				var x4 = $('#x4').val();

				var x5 = (((+aa5) * (+dd5)) / (+100));
				$('#x5').val(x5.toFixed(2));
				var x5 = $('#x5').val();

				var x6 = (((+aa6) * (+dd6)) / (+100));
				$('#x6').val(x6.toFixed(2));
				var x6 = $('#x6').val();

				var x7 = (((+aa7) * (+dd7)) / (+100));
				$('#x7').val(x7.toFixed(2));
				var x7 = $('#x7').val();

				var x8 = (((+aa8) * (+dd8)) / (+100));
				$('#x8').val(x8.toFixed(2));
				var x8 = $('#x8').val();

				var x9 = (((+aa9) * (+dd9)) / (+100));
				$('#x9').val(x9.toFixed(2));
				var x9 = $('#x9').val();


				var sumy = (((+x1) + (+x2) + (+x3) + (+x4) + (+x5) + (+x6) + (+x7) + (+x8) + (+x9)));
				$('#sumy').val(sumy.toFixed(2));
				var sumy = $('#sumy').val();


				var fi_index = (+sumy) / (+5);
				$('#fi_index').val(fi_index.toFixed(2));
				var fi_index = $('#fi_index').val();

			});




			function general_flk_elo1() {
				$('#txtflk').css("background-color", "var(--success)");


				var a1 = randomNumberFromRange(29950.0, 32000.0).toFixed(2);
				var a2 = randomNumberFromRange(15000.0, 16000.0).toFixed(2);
				var a3 = randomNumberFromRange(11500.0, 13500.0).toFixed(2);
				var a4 = randomNumberFromRange(7500.0, 8500.0).toFixed(2);
				var a5 = randomNumberFromRange(400.0, 509.0).toFixed(2);
				var a6 = randomNumberFromRange(1600.0, 1700.0).toFixed(2);
				var a7 = randomNumberFromRange(850.0, 900.0).toFixed(2);
				var a8 = randomNumberFromRange(200.0, 300.0).toFixed(2);
				var a9 = randomNumberFromRange(100.0, 209.0).toFixed(2);
				$('#a1').val(a1);
				$('#a2').val(a2);
				$('#a3').val(a3);
				$('#a4').val(a4);
				$('#a5').val(a5);
				$('#a6').val(a6);
				$('#a7').val(a7);
				$('#a8').val(a8);
				$('#a9').val(a9);


				var b1 = randomNumberFromRange(1000.0, 1200.0).toFixed(2);
				var b2 = randomNumberFromRange(1000.0, 1200.0).toFixed(2);
				var b3 = randomNumberFromRange(1000.0, 1200.0).toFixed(2);
				var b4 = randomNumberFromRange(1000.0, 1200.0).toFixed(2);
				var b5 = randomNumberFromRange(80.0, 120.0).toFixed(2);
				var b6 = randomNumberFromRange(500.0, 600.0).toFixed(2);
				var b7 = randomNumberFromRange(550.0, 620.0).toFixed(2);
				var b8 = randomNumberFromRange(60.0, 100.0).toFixed(2);
				var b9 = randomNumberFromRange(50.0, 120.0).toFixed(2);


				$('#b1').val(b1);
				$('#b2').val(b2);
				$('#b3').val(b3);
				$('#b4').val(b4);
				$('#b5').val(b5);
				$('#b6').val(b6);
				$('#b7').val(b7);
				$('#b8').val(b8);
				$('#b9').val(b9);

				var aa1 = (((+b1) / (+a1)) * (+100));
				$('#aa1').val(aa1.toFixed(2));
				var aa1 = $('#aa1').val();

				var aa2 = (((+b2) / (+a2)) * (+100));
				$('#aa2').val(aa2.toFixed(2));
				var aa2 = $('#aa2').val();

				var aa3 = (((+b3) / (+a3)) * (+100));
				$('#aa3').val(aa3.toFixed(2));
				var aa3 = $('#aa3').val();

				var aa4 = (((+b4) / (+a4)) * (+100));
				$('#aa4').val(aa4.toFixed(2));
				var aa4 = $('#aa4').val();

				var aa5 = (((+b5) / (+a5)) * (+100));
				$('#aa5').val(aa5.toFixed(2));
				var aa5 = $('#aa5').val();

				var aa6 = (((+b6) / (+a6)) * (+100));
				$('#aa6').val(aa6.toFixed(2));
				var aa6 = $('#aa6').val();

				var aa7 = (((+b7) / (+a7)) * (+100));
				$('#aa7').val(aa7.toFixed(2));
				var aa7 = $('#aa7').val();

				var aa8 = (((+b8) / (+a8)) * (+100));
				$('#aa8').val(aa8.toFixed(2));
				var aa8 = $('#aa8').val();

				var aa9 = (((+b9) / (+a9)) * (+100));
				$('#aa9').val(aa9.toFixed(2));
				var aa9 = $('#aa9').val();

				var suma = (((+a1) + (+a2) + (+a3) + (+a4) + (+a5) + (+a6) + (+a7) + (+a8) + (+a9)));
				$('#suma').val(suma.toFixed(2));
				var suma = $('#suma').val();


				var sumb = (((+b1) + (+b2) + (+b3) + (+b4) + (+b5) + (+b6) + (+b7) + (+b8) + (+b9)));
				$('#sumb').val(sumb.toFixed(2));
				var sumb = $('#sumb').val();

				var dd1 = (((+a1) / (+suma)) * (+100));
				$('#dd1').val(dd1.toFixed(2));
				var dd1 = $('#dd1').val();

				var dd2 = (((+a2) / (+suma)) * (+100));
				$('#dd2').val(dd2.toFixed(2));
				var dd2 = $('#dd2').val();

				var dd3 = (((+a3) / (+suma)) * (+100));
				$('#dd3').val(dd3.toFixed(2));
				var dd3 = $('#dd3').val();

				var dd4 = (((+a4) / (+suma)) * (+100));
				$('#dd4').val(dd4.toFixed(2));
				var dd4 = $('#dd4').val();

				var dd5 = (((+a5) / (+suma)) * (+100));
				$('#dd5').val(dd5.toFixed(2));
				var dd5 = $('#dd5').val();

				var dd6 = (((+a6) / (+suma)) * (+100));
				$('#dd6').val(dd6.toFixed(2));
				var dd6 = $('#dd6').val();

				var dd7 = (((+a7) / (+suma)) * (+100));
				$('#dd7').val(dd7.toFixed(2));
				var dd7 = $('#dd7').val();

				var dd8 = (((+a8) / (+suma)) * (+100));
				$('#dd8').val(dd8.toFixed(2));
				var dd8 = $('#dd8').val();

				var dd9 = (((+a9) / (+suma)) * (+100));
				$('#dd9').val(dd9.toFixed(2));
				var dd9 = $('#dd9').val();

				var x1 = (((+aa1) * (+dd1)) / (+100));
				$('#x1').val(x1.toFixed(2));
				var x1 = $('#x1').val();

				var x2 = (((+aa2) * (+dd2)) / (+100));
				$('#x2').val(x2.toFixed(2));
				var x2 = $('#x2').val();

				var x3 = (((+aa3) * (+dd3)) / (+100));
				$('#x3').val(x3.toFixed(2));
				var x3 = $('#x3').val();

				var x4 = (((+aa4) * (+dd4)) / (+100));
				$('#x4').val(x4.toFixed(2));
				var x4 = $('#x4').val();

				var x5 = (((+aa5) * (+dd5)) / (+100));
				$('#x5').val(x5.toFixed(2));
				var x5 = $('#x5').val();

				var x6 = (((+aa6) * (+dd6)) / (+100));
				$('#x6').val(x6.toFixed(2));
				var x6 = $('#x6').val();

				var x7 = (((+aa7) * (+dd7)) / (+100));
				$('#x7').val(x7.toFixed(2));
				var x7 = $('#x7').val();

				var x8 = (((+aa8) * (+dd8)) / (+100));
				$('#x8').val(x8.toFixed(2));
				var x8 = $('#x8').val();

				var x9 = (((+aa9) * (+dd9)) / (+100));
				$('#x9').val(x9.toFixed(2));
				var x9 = $('#x9').val();


				var sumy = (((+x1) + (+x2) + (+x3) + (+x4) + (+x5) + (+x6) + (+x7) + (+x8) + (+x9)));
				$('#sumy').val(sumy.toFixed(2));
				var sumy = $('#sumy').val();


				var fi_index = (+sumy) / (+5);
				$('#fi_index').val(fi_index.toFixed(2));
				var fi_index = $('#fi_index').val();


				var aa1 = a1; //a_1;
				var aa2 = a2; //a_2;
				var aa3 = a3; //a_3;
				var aa4 = a4; //a_4;
				var aa5 = a5;
				var aa6 = a6;
				var aa7 = a7;
				var aa8 = a8;
				var aa9 = a9;



				$('#s1').val(aa1);
				$('#s2').val(aa2);
				$('#s3').val(aa3);
				$('#s4').val(aa4);
				$('#s5').val(aa5);
				$('#s6').val(aa6);
				$('#s7').val(aa7);

				var s1 = $('#s1').val();
				var s2 = $('#s2').val();
				var s3 = $('#s3').val();
				var s4 = $('#s4').val();
				var s5 = $('#s5').val();
				var s6 = $('#s6').val();
				var s7 = $('#s7').val();




				$('#m1').val(randomNumberFromRange(90.0, 150.0).toFixed(2));
				$('#m2').val(randomNumberFromRange(100.0, 150.0).toFixed(2));
				$('#m3').val(randomNumberFromRange(100.0, 150.0).toFixed(2));
				$('#m4').val(randomNumberFromRange(800.0, 850.0).toFixed(2));
				$('#m5').val(randomNumberFromRange(700.0, 750.0).toFixed(2));
				$('#m6').val(randomNumberFromRange(200.0, 260.0).toFixed(2));
				$('#m7').val(randomNumberFromRange(100.0, 190.0).toFixed(2));

				var m1 = $('#m1').val();
				var m2 = $('#m2').val();
				var m3 = $('#m3').val();
				var m4 = $('#m4').val();
				var m5 = $('#m5').val();
				var m6 = $('#m6').val();
				var m7 = $('#m7').val();

				var p1 = (((+m1) / (+s1)) * (+100));
				$('#p1').val(p1.toFixed(2));
				var p1 = $('#p1').val();

				var p2 = (((+m2) / (+s2)) * (+100));
				$('#p2').val(p2.toFixed(2));
				var p2 = $('#p2').val();

				var p3 = (((+m3) / (+s3)) * (+100));
				$('#p3').val(p3.toFixed(2));
				var p3 = $('#p3').val();

				var p4 = (((+m4) / (+s4)) * (+100));
				$('#p4').val(p4.toFixed(2));
				var p4 = $('#p4').val();

				var p5 = (((+m5) / (+s5)) * (+100));
				$('#p5').val(p5.toFixed(2));
				var p5 = $('#p5').val();

				var p6 = (((+m6) / (+s6)) * (+100));
				$('#p6').val(p6.toFixed(2));
				var p6 = $('#p6').val();

				var p7 = (((+m7) / (+s7)) * (+100));
				$('#p7').val(p7.toFixed(2));
				var p7 = $('#p7').val();


				var suma1 = (((+s1) + (+s2) + (+s3) + (+s4) + (+s5) + (+s6) + (+s7)));
				$('#suma1').val(suma1.toFixed(2));
				var suma1 = $('#suma1').val();


				var suma2 = (((+m1) + (+m2) + (+m3) + (+m4) + (+m5) + (+m6) + (+m7)));
				$('#suma2').val(suma2.toFixed(2));
				var suma2 = $('#suma2').val();


				var pp1 = (((+s1) / (+suma1)) * (+100));
				$('#pp1').val(pp1.toFixed(2));
				var pp1 = $('#pp1').val();

				var pp2 = (((+s2) / (+suma1)) * (+100));
				$('#pp2').val(pp2.toFixed(2));
				var pp2 = $('#pp2').val();

				var pp3 = (((+s3) / (+suma1)) * (+100));
				$('#pp3').val(pp3.toFixed(2));
				var pp3 = $('#pp3').val();

				var pp4 = (((+s4) / (+suma1)) * (+100));
				$('#pp4').val(pp4.toFixed(2));
				var pp4 = $('#pp4').val();

				var pp5 = (((+s5) / (+suma1)) * (+100));
				$('#pp5').val(pp5.toFixed(2));
				var pp5 = $('#pp5').val();

				var pp6 = (((+s6) / (+suma1)) * (+100));
				$('#pp6').val(pp6.toFixed(2));
				var pp6 = $('#pp6').val();

				var pp7 = (((+s7) / (+suma1)) * (+100));
				$('#pp7').val(pp7.toFixed(2));
				var pp7 = $('#pp7').val();


				var w1 = (((+p1) * (+pp1)) / (+100));
				$('#w1').val(w1.toFixed(2));
				var w1 = $('#w1').val();

				var w2 = (((+p2) * (+pp2)) / (+100));
				$('#w2').val(w2.toFixed(2));
				var w2 = $('#w2').val();

				var w3 = (((+p3) * (+pp3)) / (+100));
				$('#w3').val(w3.toFixed(2));
				var w3 = $('#w3').val();

				var w4 = (((+p4) * (+pp4)) / (+100));
				$('#w4').val(w4.toFixed(2));
				var w4 = $('#w4').val();

				var w5 = (((+p5) * (+pp5)) / (+100));
				$('#w5').val(w5.toFixed(2));
				var w5 = $('#w5').val();

				var w6 = (((+p6) * (+pp6)) / (+100));
				$('#w6').val(w6.toFixed(2));
				var w6 = $('#w6').val();

				var w7 = (((+p7) * (+pp7)) / (+100));
				$('#w7').val(w7.toFixed(2));
				var w7 = $('#w7').val();



				var sumy1 = (((+w1) + (+w2) + (+w3) + (+w4) + (+w5) + (+w6) + (+w7)));
				$('#sumy1').val(sumy1.toFixed(2));
				var sumy1 = $('#sumy1').val();



				var fi_index1 = (+sumy1) / (+5);
				$('#fi_index1').val(fi_index1.toFixed(2));
				var fi_index1 = $('#fi_index1').val();
			}



			// Vivek : Change
			$('#sp_w_s_1,#sp_w_s_2,#sp_w_s_3,#sp_w_s_4,#sp_w_s_5,#sp_w_s_6,#sp_w_sur_1,#sp_w_sur_2,#sp_w_sur_3,#sp_w_sur_4,#sp_w_sur_5,#sp_w_sur_6,#sp_agg1,#sp_agg2,#sp_agg3,#sp_agg4,#sp_agg5,#sp_agg6,#sp_wat1,#sp_wat2,#sp_wat3,#sp_wat4,#sp_wat5,#sp_wat6').change(function() {

				var sp_w_s_1 = $('#sp_w_s_1').val();
				var sp_w_s_2 = $('#sp_w_s_2').val();
				var sp_w_s_3 = $('#sp_w_s_3').val();
				var sp_w_s_4 = $('#sp_w_s_4').val();
				var sp_w_s_5 = $('#sp_w_s_5').val();
				var sp_w_s_6 = $('#sp_w_s_6').val();

				var sp_w_sur_1 = $('#sp_w_sur_1').val();
				var sp_w_sur_2 = $('#sp_w_sur_2').val();
				var sp_w_sur_3 = $('#sp_w_sur_3').val();
				var sp_w_sur_4 = $('#sp_w_sur_4').val();
				var sp_w_sur_5 = $('#sp_w_sur_5').val();
				var sp_w_sur_6 = $('#sp_w_sur_6').val();

				var sp_agg1 = $('#sp_agg1').val();
				var sp_agg2 = $('#sp_agg2').val();
				var sp_agg3 = $('#sp_agg3').val();
				var sp_agg4 = $('#sp_agg4').val();
				var sp_agg5 = $('#sp_agg5').val();
				var sp_agg6 = $('#sp_agg6').val();

				var sp_wat1 = $('#sp_wat1').val();
				var sp_wat2 = $('#sp_wat2').val();
				var sp_wat3 = $('#sp_wat3').val();
				var sp_wat4 = $('#sp_wat4').val();
				var sp_wat5 = $('#sp_wat5').val();
				var sp_wat6 = $('#sp_wat6').val();


				var sp_specific_gravity_a_1 = ((+sp_wat1) / ((+sp_w_s_1) - ((+sp_w_sur_1) - (+sp_agg1))));
				$('#sp_specific_gravity_a_1').val(sp_specific_gravity_a_1.toFixed(2));
				var sp_specific_gravity_a_1 = $('#sp_specific_gravity_a_1').val();

				var sp_specific_gravity_a_2 = ((+sp_wat2) / ((+sp_w_s_2) - ((+sp_w_sur_2) - (+sp_agg2))));
				$('#sp_specific_gravity_a_2').val(sp_specific_gravity_a_2.toFixed(2));
				var sp_specific_gravity_a_2 = $('#sp_specific_gravity_a_2').val();

				var sp_specific_gravity_a = (((+sp_specific_gravity_a_1) + (+sp_specific_gravity_a_2)) / (+2));
				$('#sp_specific_gravity_a').val(sp_specific_gravity_a.toFixed(2));
				var sp_specific_gravity_a = $('#sp_specific_gravity_a').val();

				var sp_specific_gravity_a_3 = ((+sp_wat3) / ((+sp_w_s_3) - ((+sp_w_sur_3) - (+sp_agg3))));
				$('#sp_specific_gravity_a_3').val(sp_specific_gravity_a_3.toFixed(2));
				var sp_specific_gravity_a_3 = $('#sp_specific_gravity_a_3').val();

				var sp_specific_gravity_a_4 = ((+sp_wat4) / ((+sp_w_s_4) - ((+sp_w_sur_4) - (+sp_agg4))));
				$('#sp_specific_gravity_a_4').val(sp_specific_gravity_a_4.toFixed(2));
				var sp_specific_gravity_a_4 = $('#sp_specific_gravity_a_4').val();

				var sp_specific_gravity_a1 = (((+sp_specific_gravity_a_3) + (+sp_specific_gravity_a_4)) / (+2));
				$('#sp_specific_gravity_a1').val(sp_specific_gravity_a1.toFixed(2));
				var sp_specific_gravity_a1 = $('#sp_specific_gravity_a1').val();

				var sp_specific_gravity_a_5 = ((+sp_wat3) / ((+sp_w_s_3) - ((+sp_w_sur_3) - (+sp_agg3))));
				$('#sp_specific_gravity_a_5').val(sp_specific_gravity_a_5.toFixed(2));
				var sp_specific_gravity_a_5 = $('#sp_specific_gravity_a_5').val();

				var sp_specific_gravity_a_6 = ((+sp_wat4) / ((+sp_w_s_4) - ((+sp_w_sur_4) - (+sp_agg4))));
				$('#sp_specific_gravity_a_6').val(sp_specific_gravity_a_6.toFixed(2));
				var sp_specific_gravity_a_6 = $('#sp_specific_gravity_a_6').val();

				var sp_specific_gravity_a2 = (((+sp_specific_gravity_a_5) + (+sp_specific_gravity_a_6)) / (+2));
				$('#sp_specific_gravity_a2').val(sp_specific_gravity_a2.toFixed(2));
				var sp_specific_gravity_a2 = $('#sp_specific_gravity_a2').val();


				var sp_specific_gravity_b_1 = ((+sp_w_s_1) / ((+sp_w_s_1) - ((+sp_w_sur_1) - (+sp_agg1))));
				$('#sp_specific_gravity_b_1').val(sp_specific_gravity_b_1.toFixed(2));
				var sp_specific_gravity_b_1 = $('#sp_specific_gravity_b_1').val();


				var sp_specific_gravity_b_2 = ((+sp_w_s_2) / ((+sp_w_s_2) - ((+sp_w_sur_2) - (+sp_agg2))));
				$('#sp_specific_gravity_b_2').val(sp_specific_gravity_b_2.toFixed(2));
				var sp_specific_gravity_b_2 = $('#sp_specific_gravity_b_2').val();

				var sp_specific_gravity_b = (((+sp_specific_gravity_b_1) + (+sp_specific_gravity_b_2)) / (+2));
				$('#sp_specific_gravity_b').val(sp_specific_gravity_b.toFixed(2));
				var sp_specific_gravity_b = $('#sp_specific_gravity_b').val();



				var sp_specific_gravity_b_3 = ((+sp_w_s_3) / ((+sp_w_s_3) - ((+sp_w_sur_3) - (+sp_agg3))));
				$('#sp_specific_gravity_b_3').val(sp_specific_gravity_b_3.toFixed(2));
				var sp_specific_gravity_b_3 = $('#sp_specific_gravity_b_3').val();


				var sp_specific_gravity_b_4 = ((+sp_w_s_4) / ((+sp_w_s_4) - ((+sp_w_sur_4) - (+sp_agg4))));
				$('#sp_specific_gravity_b_4').val(sp_specific_gravity_b_4.toFixed(2));
				var sp_specific_gravity_b_4 = $('#sp_specific_gravity_b_4').val();

				var sp_specific_gravity_b1 = (((+sp_specific_gravity_b_3) + (+sp_specific_gravity_b_4)) / (+2));
				$('#sp_specific_gravity_b1').val(sp_specific_gravity_b1.toFixed(2));
				var sp_specific_gravity_b1 = $('#sp_specific_gravity_b1').val();


				var sp_specific_gravity_b_5 = ((+sp_w_s_5) / ((+sp_w_s_5) - ((+sp_w_sur_5) - (+sp_agg5))));
				$('#sp_specific_gravity_b_5').val(sp_specific_gravity_b_5.toFixed(2));
				var sp_specific_gravity_b_5 = $('#sp_specific_gravity_b_5').val();




				var sp_specific_gravity_b_6 = ((+sp_w_s_6) / ((+sp_w_s_6) - ((+sp_w_sur_6) - (+sp_agg6))));
				$('#sp_specific_gravity_b_6').val(sp_specific_gravity_b_6.toFixed(2));
				var sp_specific_gravity_b_6 = $('#sp_specific_gravity_b_6').val();


				var sp_specific_gravity_b2 = (((+sp_specific_gravity_b_5) + (+sp_specific_gravity_b_6)) / (+2));
				$('#sp_specific_gravity_b2').val(sp_specific_gravity_b2.toFixed(2));
				var sp_specific_gravity_b2 = $('#sp_specific_gravity_b2').val();



				var sp_specific_gravity_1 = ((+sp_wat1) / ((+sp_wat1) - ((+sp_w_sur_1) - (+sp_agg1))));
				$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
				var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();

				var sp_specific_gravity_2 = ((+sp_wat2) / ((+sp_wat2) - ((+sp_w_sur_2) - (+sp_agg2))));
				$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
				var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();

				var sp_specific_gravity = (((+sp_specific_gravity_1) + (+sp_specific_gravity_2)) / (+2));
				$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
				var sp_specific_gravity = $('#sp_specific_gravity').val();

				var sp_specific_gravity_3 = ((+sp_wat3) / ((+sp_wat3) - ((+sp_w_sur_3) - (+sp_agg3))));
				$('#sp_specific_gravity_3').val(sp_specific_gravity_3.toFixed(2));
				var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();

				var sp_specific_gravity_4 = ((+sp_wat4) / ((+sp_wat4) - ((+sp_w_sur_4) - (+sp_agg4))));
				$('#sp_specific_gravity_4').val(sp_specific_gravity_4.toFixed(2));
				var sp_specific_gravity_4 = $('#sp_specific_gravity_4').val();

				var sp_specific_gravity1 = (((+sp_specific_gravity_3) + (+sp_specific_gravity_4)) / (+2));
				$('#sp_specific_gravity1').val(sp_specific_gravity1.toFixed(2));
				var sp_specific_gravity1 = $('#sp_specific_gravity1').val();

				var sp_specific_gravity_5 = ((+sp_wat3) / ((+sp_wat3) - ((+sp_w_sur_3) - (+sp_agg3))));
				$('#sp_specific_gravity_5').val(sp_specific_gravity_5.toFixed(2));
				var sp_specific_gravity_5 = $('#sp_specific_gravity_5').val();

				var sp_specific_gravity_6 = ((+sp_wat4) / ((+sp_wat4) - ((+sp_w_sur_4) - (+sp_agg4))));
				$('#sp_specific_gravity_6').val(sp_specific_gravity_6.toFixed(2));
				var sp_specific_gravity_6 = $('#sp_specific_gravity_6').val();

				var sp_specific_gravity2 = (((+sp_specific_gravity_5) + (+sp_specific_gravity_6)) / (+2));
				$('#sp_specific_gravity2').val(sp_specific_gravity2.toFixed(2));
				var sp_specific_gravity2 = $('#sp_specific_gravity2').val();



				var sp_water_abr_1 = ((+100) * ((+sp_w_s_1) - (+sp_wat1)) / (+sp_wat1));
				$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
				var sp_water_abr_1 = $('#sp_water_abr_1').val();

				var sp_water_abr_2 = ((+100) * ((+sp_w_s_2) - (+sp_wat2)) / (+sp_wat2));
				$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
				var sp_water_abr_2 = $('#sp_water_abr_2').val();

				var sp_water_abr = (((+sp_water_abr_1) + (+sp_wat2)) / (+2));
				$('#sp_water_abr').val(sp_water_abr.toFixed(2));
				var sp_water_abr = $('#sp_water_abr').val();

				var sp_water_abr_3 = ((+100) * ((+sp_w_s_3) - (+sp_wat3)) / (+sp_wat3));
				$('#sp_water_abr_3').val(sp_water_abr_3.toFixed(2));
				var sp_water_abr_3 = $('#sp_water_abr_3').val();

				var sp_water_abr_4 = ((+100) * ((+sp_w_s_4) - (+sp_wat4)) / (+sp_wat4))
				$('#sp_water_abr_4').val(sp_water_abr_4.toFixed(2));
				var sp_water_abr_4 = $('#sp_water_abr_4').val();

				var sp_water_abr1 = (((+sp_water_abr_3) + (+sp_wat4)) / (+2));
				$('#sp_water_abr1').val(sp_water_abr1.toFixed(2));
				var sp_water_abr1 = $('#sp_water_abr1').val();

				var sp_water_abr_5 = ((+100) * ((+sp_w_s_5) - (+sp_wat5)) / (+sp_wat5))
				$('#sp_water_abr_5').val(sp_water_abr_5.toFixed(2));
				var sp_water_abr_5 = $('#sp_water_abr_5').val();

				var sp_water_abr_6 = ((+100) * ((+sp_w_s_6) - (+sp_wat6)) / (+sp_wat6))
				$('#sp_water_abr_6').val(sp_water_abr_6.toFixed(2));
				var sp_water_abr_6 = $('#sp_water_abr_6').val();

				var sp_water_abr2 = (((+sp_water_abr_5) + (+sp_wat6)) / (+2));
				$('#sp_water_abr2').val(sp_water_abr2.toFixed(2));
				var sp_water_abr2 = $('#sp_water_abr2').val();





			});

			// Vivek : Change
			$('#abr_wt_t_a_1,#abr_wt_t_a_2,#abr_wt_t_b_1,#abr_wt_t_b_2').change(function() {
				var abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
				var abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
				var abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
				var abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();

				var abr_wt_t_c_1 = ((+abr_wt_t_a_1) - (+abr_wt_t_b_1));
				$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed(2));
				var abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();

				var abr_wt_t_c_2 = ((+abr_wt_t_a_2) - (+abr_wt_t_b_2));
				$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed(2));
				var abr_wt_t_c_2 = $('#abr_wt_t_c_2').val();

				var abr_1 = (((+abr_wt_t_c_1) / (+abr_wt_t_a_1)) * (+100));
				$('#abr_1').val(abr_1.toFixed(2));
				var abr_1 = $('#abr_1').val();

				var abr_2 = (((+abr_wt_t_c_2) / (+abr_wt_t_a_2)) * (+100));
				$('#abr_2').val(abr_2.toFixed(2));
				var abr_2 = $('#abr_2').val();

				var abr_index = ((+abr_1) + (+abr_2)) / (+2);
				$('#abr_index').val(abr_index.toFixed(2));
				var abr_index = $('#abr_index').val();
			});

			// Vivek : Change
			$('#imp_w_m_a_1,#imp_w_m_a_2,#imp_w_m_b_1,#imp_w_m_b_2,#imp_w_m_c_1,#imp_w_m_c_2').change(function() {
				var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
				var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
				var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
				var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
				var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
				var imp_w_m_c_2 = $('#imp_w_m_c_2').val();

				var imp_w_m_d_1 = ((+imp_w_m_b_1) + (+imp_w_m_c_1));
				$('#imp_w_m_d_1').val(imp_w_m_d_1.toFixed(2));
				var imp_w_m_d_1 = $('#imp_w_m_d_1').val();

				var imp_w_m_d_2 = ((+imp_w_m_b_2) + (+imp_w_m_c_2));
				$('#imp_w_m_d_2').val(imp_w_m_d_2.toFixed(2));
				var imp_w_m_d_2 = $('#imp_w_m_d_2').val();

				var imp_value_1 = (((+imp_w_m_b_1) / (+imp_w_m_a_1)) * (+100));
				$('#imp_value_1').val(imp_value_1.toFixed(2));
				var imp_value_1 = $('#imp_value_1').val();

				var imp_value_2 = (((+imp_w_m_b_2) / (+imp_w_m_a_2)) * (+100));
				$('#imp_value_2').val(imp_value_2.toFixed(2));
				var imp_value_2 = $('#imp_value_2').val();

				var imp_value = ((+imp_value_1) + (+imp_value_2)) / (+2);
				$('#imp_value').val(imp_value.toFixed(2));
				var imp_value = $('#imp_value').val();
			});

			// Vivek : Change
			$('#cr_a_1,#cr_a_2,#cr_b_1,#cr_b_2,#cr_c_1,#cr_c_2').change(function() {
				var cr_a_1 = $('#cr_a_1').val();
				var cr_a_2 = $('#cr_a_2').val();
				var cr_b_1 = $('#cr_b_1').val();
				var cr_b_2 = $('#cr_b_2').val();
				var cr_c_1 = $('#cr_c_1').val();
				var cr_c_2 = $('#cr_c_2').val();

				var cru_value_1 = (((+cr_b_1) / (+cr_a_1)) * (+100));
				$('#cru_value_1').val(cru_value_1.toFixed(2));
				var cru_value_1 = $('#cru_value_1').val();

				var cru_value_2 = (((+cr_b_2) / (+cr_a_2)) * (+100));
				$('#cru_value_2').val(cru_value_2.toFixed(2));
				var cru_value_2 = $('#cru_value_2').val();

				var cru_value = ((+cru_value_1) + (+cru_value_2)) / (+2);
				$('#cru_value').val(cru_value.toFixed(2));
				var cru_value = $('#cru_value').val();
			});

			// Vivek : Change
			$('#m11,#m12,#m13,#m21,#m22,#m23,#m31,#m32,#m33').change(function() {
				var m11 = $('#m11').val();
				var m12 = $('#m12').val();
				var m13 = $('#m13').val();
				var m31 = $('#m31').val();
				var m32 = $('#m32').val();
				var m33 = $('#m33').val();
				var m21 = $('#m21').val();
				var m22 = $('#m22').val();
				var m23 = $('#m23').val();

				var m41 = ((+m21) - (+m31));
				$('#m41').val(m41.toFixed(2));
				var m41 = $('#m41').val();

				var m42 = ((+m22) - (+m32));
				$('#m42').val(m42.toFixed(2));
				var m42 = $('#m42').val();

				var m43 = ((+m23) - (+m33));
				$('#m43').val(m43.toFixed(2));
				var m43 = $('#m43').val();

				var m51 = ((+m41) / (+m31));
				$('#m51').val(m51.toFixed(2));
				var m51 = $('#m51').val();

				var m52 = ((+m42) / (+m32));
				$('#m52').val(m52.toFixed(2));
				var m52 = $('#m52').val();

				var m53 = ((+m43) / (+m33));
				$('#m53').val(m53.toFixed(2));
				var m53 = $('#m53').val();

				var avg_wom = (((+m51) + (+m52) + (+m53)) / (+3));
				$('#avg_wom').val(avg_wom.toFixed(2));
				var avg_wom = $('#avg_wom').val();


			});

			$('#chk_abr').change(function() {
				console.debug('----vvvvv-----');
				if (this.checked) {
					abr_auto();


				} else {
					$('#txtabr').css("background-color", "white");
					$('#abr_sample_abr').val(null);
					$('#abr_wt_t_a_1').val(null);
					$('#abr_wt_t_b_1').val(null);
					$('#abr_wt_t_c_1').val(null);
					$('#abr_wt_t_a_2').val(null);
					$('#abr_wt_t_b_2').val(null);
					$('#abr_wt_t_c_2').val(null);
					$('#abr_1').val(null);
					$('#abr_2').val(null);
					$('#abr_index').val(null);
					$('#abr_sphere').val(null);
					$('#abr_num_revo').val(null);
					$('#abr_weight_charge').val(null);
				}

			});




			function sp_auto() {
				$('#txtwtr').css("background-color", "var(--success)");
				var sp_specificgravity = randomNumberFromRange(2.700, 2.750).toFixed(3); //(sp_specific_gravity)
				$('#sp_specific_gravity').val(sp_specificgravity);
				var sp_specific_gravity = $('#sp_specific_gravity').val();
				var tt = randomNumberFromRange(-0.010, 0.010).toFixed(3);
				var sp_specific_gravity1 = (+sp_specific_gravity) + (+tt); //(sp_specific_gravity_1)_1
				$('#sp_specific_gravity_1').val(sp_specific_gravity1.toFixed(3));
				var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
				var tems1 = (+sp_specific_gravity) * 2;
				var sp_specific_gravity2 = ((+tems1) - (+sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
				$('#sp_specific_gravity_2').val(sp_specific_gravity2.toFixed(3));
				var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
				var sp_specific_gravity3 = ((+tems1) - (+sp_specific_gravity_2)); //(sp_specific_gravity_3)_3
				$('#sp_specific_gravity_3').val(sp_specific_gravity3.toFixed(3));
				var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();
				var sp_waterabr = randomNumberFromRange(1.00, 1.25).toFixed(2); // (sp_water_abr)_1
				$('#sp_water_abr').val(sp_waterabr);
				var sp_water_abr = $('#sp_water_abr').val();
				var ttt = randomNumberFromRange(-0.02, 0.02).toFixed(2);
				var sp_water_abr1 = (+sp_water_abr) + (+ttt); ////(sp_water_abr_1)_1
				$('#sp_water_abr_1').val(sp_water_abr1.toFixed(2));
				var sp_water_abr_1 = $('#sp_water_abr_1').val();
				var tems11 = (+sp_water_abr) * 2;
				var sp_water_abr2 = (+tems11) - (+sp_water_abr_1); // (sp_water_abr_2)_1 
				$('#sp_water_abr_2').val(sp_water_abr2.toFixed(2));
				var sp_water_abr_2 = $('#sp_water_abr_2').val();
				var sp_water_abr3 = (+tems11) - (+sp_water_abr_2); // (sp_water_abr_3)_1 
				$('#sp_water_abr_3').val(sp_water_abr3.toFixed(2));
				var sp_water_abr_3 = $('#sp_water_abr_3').val();


				$('#sp_wt_st_1').val(2000);
				$('#sp_wt_st_2').val(2000);
				$('#sp_wt_st_3').val(2000);

				var a1 = $('#sp_wt_st_1').val();
				var a2 = $('#sp_wt_st_2').val();
				var a3 = $('#sp_wt_st_3').val();
				var g1 = $('#sp_specific_gravity_1').val();
				var g2 = $('#sp_specific_gravity_2').val();
				var g3 = $('#sp_specific_gravity_3').val();
				var wtr1 = $('#sp_water_abr_1').val();
				var wtr2 = $('#sp_water_abr_2').val();
				var wtr3 = $('#sp_water_abr_3').val();
				var equp1 = a1 * 100;
				var equp2 = a2 * 100;
				var equp3 = a3 * 100;
				var eqdn1 = (+wtr1) + 100;
				var eqdn2 = (+wtr2) + 100;
				var eqdn3 = (+wtr3) + 100;
				var sp_w_s_1 = equp1 / eqdn1;
				var sp_w_s_2 = equp2 / eqdn2;
				var sp_w_s_3 = equp3 / eqdn3;
				$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));
				$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));
				$('#sp_w_s_3').val(sp_w_s_3.toString().substring(0, sp_w_s_3.toString().indexOf(".") + 2));
				var b1 = $('#sp_w_s_1').val();
				var b2 = $('#sp_w_s_2').val();
				var b3 = $('#sp_w_s_3').val();
				var sp_w_sur_1 = (+a1) - ((+b1) / (+g1));
				var sp_w_sur_2 = (+a2) - ((+b2) / (+g2));
				var sp_w_sur_3 = (+a3) - ((+b3) / (+g3));
				$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));
				$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
				$('#sp_w_sur_3').val(sp_w_sur_3.toFixed(1));
				// $('#sp_sample_ca').val(sp_sample_ca);
				//sidhu
				var aa1 = $('#sp_wt_st_1').val();
				var aa2 = $('#sp_wt_st_2').val();
				var aa3 = $('#sp_wt_st_3').val();
				var bb1 = $('#sp_w_s_1').val();
				var bb2 = $('#sp_w_s_2').val();
				var bb3 = $('#sp_w_s_3').val();
				var cc1 = $('#sp_w_sur_1').val();
				var cc2 = $('#sp_w_sur_2').val();
				var cc3 = $('#sp_w_sur_3').val();


				var tempr1 = (+aa1) - (+cc1);
				var tempr2 = (+aa2) - (+cc2);
				var tempr3 = (+aa3) - (+cc3);
				var spg1 = (+bb1) / (+tempr1);
				var spg2 = (+bb2) / (+tempr2);
				var spg3 = (+bb3) / (+tempr3);

				$('#sp_specific_gravity_1').val(spg1.toFixed(3));
				$('#sp_specific_gravity_2').val(spg2.toFixed(3));
				$('#sp_specific_gravity_3').val(spg3.toFixed(3));

				var spg_1 = $('#sp_specific_gravity_1').val();
				var spg_2 = $('#sp_specific_gravity_2').val();
				var spg_3 = $('#sp_specific_gravity_3').val();

				var avg_t = (+spg_1) + (+spg_2) + (+spg_3);
				var sp_specific_ans = (+avg_t) / 3;
				$('#sp_specific_gravity').val(sp_specific_ans.toFixed(3));

				var temp_wtr1 = (+aa1) - (+bb1);
				var temp_wtr2 = (+aa2) - (+bb2);
				var temp_wtr3 = (+aa3) - (+bb3);

				var t_wtr1 = (+temp_wtr1) / (+bb1);
				var t_wtr2 = (+temp_wtr2) / (+bb2);
				var t_wtr3 = (+temp_wtr3) / (+bb3);

				var wtr11 = (+t_wtr1) * 100;
				var wtr22 = (+t_wtr2) * 100;
				var wtr23 = (+t_wtr3) * 100;

				$('#sp_water_abr_1').val(wtr11.toFixed(2));
				$('#sp_water_abr_2').val(wtr22.toFixed(2));
				$('#sp_water_abr_3').val(wtr23.toFixed(2));



				$('#sp_w_s_1').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_w_s_2').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_w_s_3').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_w_s_4').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_w_s_5').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_w_s_6').val(randomNumberFromRange(2.700, 8.750).toFixed(3));


				$('#sp_w_sur_1').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_w_sur_2').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_w_sur_3').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_w_sur_4').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_w_sur_5').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_w_sur_6').val(randomNumberFromRange(2.700, 8.750).toFixed(3));


				$('#sp_agg1').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_agg2').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_agg3').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_agg4').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_agg5').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_agg6').val(randomNumberFromRange(2.700, 8.750).toFixed(3));


				$('#sp_wat1').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_wat2').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_wat3').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_wat4').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_wat5').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#sp_wat6').val(randomNumberFromRange(2.700, 8.750).toFixed(3));

				$('#taken_1').val(randomNumberFromRange(2.700, 8.750).toFixed(3));
				$('#taken_2').val(randomNumberFromRange(2.700, 8.750).toFixed(3));

				var sp_w_s_1 = $('#sp_w_s_1').val();
				var sp_w_s_2 = $('#sp_w_s_2').val();
				var sp_w_s_3 = $('#sp_w_s_3').val();
				var sp_w_s_4 = $('#sp_w_s_4').val();
				var sp_w_s_5 = $('#sp_w_s_5').val();
				var sp_w_s_6 = $('#sp_w_s_6').val();

				var sp_w_sur_1 = $('#sp_w_sur_1').val();
				var sp_w_sur_2 = $('#sp_w_sur_2').val();
				var sp_w_sur_3 = $('#sp_w_sur_3').val();
				var sp_w_sur_4 = $('#sp_w_sur_4').val();
				var sp_w_sur_5 = $('#sp_w_sur_5').val();
				var sp_w_sur_6 = $('#sp_w_sur_6').val();

				var sp_agg1 = $('#sp_agg1').val();
				var sp_agg2 = $('#sp_agg2').val();
				var sp_agg3 = $('#sp_agg3').val();
				var sp_agg4 = $('#sp_agg4').val();
				var sp_agg5 = $('#sp_agg5').val();
				var sp_agg6 = $('#sp_agg6').val();

				var sp_wat1 = $('#sp_wat1').val();
				var sp_wat2 = $('#sp_wat2').val();
				var sp_wat3 = $('#sp_wat3').val();
				var sp_wat4 = $('#sp_wat4').val();
				var sp_wat5 = $('#sp_wat5').val();
				var sp_wat6 = $('#sp_wat6').val();


				var sp_specific_gravity_a_1 = ((+sp_wat1) / ((+sp_w_s_1) - ((+sp_w_sur_1) - (+sp_agg1))));
				$('#sp_specific_gravity_a_1').val(sp_specific_gravity_a_1.toFixed(2));
				var sp_specific_gravity_a_1 = $('#sp_specific_gravity_a_1').val();

				var sp_specific_gravity_a_2 = ((+sp_wat2) / ((+sp_w_s_2) - ((+sp_w_sur_2) - (+sp_agg2))));
				$('#sp_specific_gravity_a_2').val(sp_specific_gravity_a_2.toFixed(2));
				var sp_specific_gravity_a_2 = $('#sp_specific_gravity_a_2').val();

				var sp_specific_gravity_a = (((+sp_specific_gravity_a_1) + (+sp_specific_gravity_a_2)) / (+2));
				$('#sp_specific_gravity_a').val(sp_specific_gravity_a.toFixed(2));
				var sp_specific_gravity_a = $('#sp_specific_gravity_a').val();

				var sp_specific_gravity_a_3 = ((+sp_wat3) / ((+sp_w_s_3) - ((+sp_w_sur_3) - (+sp_agg3))));
				$('#sp_specific_gravity_a_3').val(sp_specific_gravity_a_3.toFixed(2));
				var sp_specific_gravity_a_3 = $('#sp_specific_gravity_a_3').val();

				var sp_specific_gravity_a_4 = ((+sp_wat4) / ((+sp_w_s_4) - ((+sp_w_sur_4) - (+sp_agg4))));
				$('#sp_specific_gravity_a_4').val(sp_specific_gravity_a_4.toFixed(2));
				var sp_specific_gravity_a_4 = $('#sp_specific_gravity_a_4').val();

				var sp_specific_gravity_a1 = (((+sp_specific_gravity_a_3) + (+sp_specific_gravity_a_4)) / (+2));
				$('#sp_specific_gravity_a1').val(sp_specific_gravity_a1.toFixed(2));
				var sp_specific_gravity_a1 = $('#sp_specific_gravity_a1').val();

				var sp_specific_gravity_a_5 = ((+sp_wat3) / ((+sp_w_s_3) - ((+sp_w_sur_3) - (+sp_agg3))));
				$('#sp_specific_gravity_a_5').val(sp_specific_gravity_a_5.toFixed(2));
				var sp_specific_gravity_a_5 = $('#sp_specific_gravity_a_5').val();

				var sp_specific_gravity_a_6 = ((+sp_wat4) / ((+sp_w_s_4) - ((+sp_w_sur_4) - (+sp_agg4))));
				$('#sp_specific_gravity_a_6').val(sp_specific_gravity_a_6.toFixed(2));
				var sp_specific_gravity_a_6 = $('#sp_specific_gravity_a_6').val();

				var sp_specific_gravity_a2 = (((+sp_specific_gravity_a_5) + (+sp_specific_gravity_a_6)) / (+2));
				$('#sp_specific_gravity_a2').val(sp_specific_gravity_a2.toFixed(2));
				var sp_specific_gravity_a2 = $('#sp_specific_gravity_a2').val();


				var sp_specific_gravity_b_1 = ((+sp_w_s_1) / ((+sp_w_s_1) - ((+sp_w_sur_1) - (+sp_agg1))));
				$('#sp_specific_gravity_b_1').val(sp_specific_gravity_b_1.toFixed(2));
				var sp_specific_gravity_b_1 = $('#sp_specific_gravity_b_1').val();


				var sp_specific_gravity_b_2 = ((+sp_w_s_2) / ((+sp_w_s_2) - ((+sp_w_sur_2) - (+sp_agg2))));
				$('#sp_specific_gravity_b_2').val(sp_specific_gravity_b_2.toFixed(2));
				var sp_specific_gravity_b_2 = $('#sp_specific_gravity_b_2').val();

				var sp_specific_gravity_b = (((+sp_specific_gravity_b_1) + (+sp_specific_gravity_b_2)) / (+2));
				$('#sp_specific_gravity_b').val(sp_specific_gravity_b.toFixed(2));
				var sp_specific_gravity_b = $('#sp_specific_gravity_b').val();



				var sp_specific_gravity_b_3 = ((+sp_w_s_3) / ((+sp_w_s_3) - ((+sp_w_sur_3) - (+sp_agg3))));
				$('#sp_specific_gravity_b_3').val(sp_specific_gravity_b_3.toFixed(2));
				var sp_specific_gravity_b_3 = $('#sp_specific_gravity_b_3').val();


				var sp_specific_gravity_b_4 = ((+sp_w_s_4) / ((+sp_w_s_4) - ((+sp_w_sur_4) - (+sp_agg4))));
				$('#sp_specific_gravity_b_4').val(sp_specific_gravity_b_4.toFixed(2));
				var sp_specific_gravity_b_4 = $('#sp_specific_gravity_b_4').val();

				var sp_specific_gravity_b1 = (((+sp_specific_gravity_b_3) + (+sp_specific_gravity_b_4)) / (+2));
				$('#sp_specific_gravity_b1').val(sp_specific_gravity_b1.toFixed(2));
				var sp_specific_gravity_b1 = $('#sp_specific_gravity_b1').val();


				var sp_specific_gravity_b_5 = ((+sp_w_s_5) / ((+sp_w_s_5) - ((+sp_w_sur_5) - (+sp_agg5))));
				$('#sp_specific_gravity_b_5').val(sp_specific_gravity_b_5.toFixed(2));
				var sp_specific_gravity_b_5 = $('#sp_specific_gravity_b_5').val();




				var sp_specific_gravity_b_6 = ((+sp_w_s_6) / ((+sp_w_s_6) - ((+sp_w_sur_6) - (+sp_agg6))));
				$('#sp_specific_gravity_b_6').val(sp_specific_gravity_b_6.toFixed(2));
				var sp_specific_gravity_b_6 = $('#sp_specific_gravity_b_6').val();


				var sp_specific_gravity_b2 = (((+sp_specific_gravity_b_5) + (+sp_specific_gravity_b_6)) / (+2));
				$('#sp_specific_gravity_b2').val(sp_specific_gravity_b2.toFixed(2));
				var sp_specific_gravity_b2 = $('#sp_specific_gravity_b2').val();



				var sp_specific_gravity_1 = ((+sp_wat1) / ((+sp_wat1) - ((+sp_w_sur_1) - (+sp_agg1))));
				$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toFixed(2));
				var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();

				var sp_specific_gravity_2 = ((+sp_wat2) / ((+sp_wat2) - ((+sp_w_sur_2) - (+sp_agg2))));
				$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toFixed(2));
				var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();

				var sp_specific_gravity = (((+sp_specific_gravity_1) + (+sp_specific_gravity_2)) / (+2));
				$('#sp_specific_gravity').val(sp_specific_gravity.toFixed(2));
				var sp_specific_gravity = $('#sp_specific_gravity').val();

				var sp_specific_gravity_3 = ((+sp_wat3) / ((+sp_wat3) - ((+sp_w_sur_3) - (+sp_agg3))));
				$('#sp_specific_gravity_3').val(sp_specific_gravity_3.toFixed(2));
				var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();

				var sp_specific_gravity_4 = ((+sp_wat4) / ((+sp_wat4) - ((+sp_w_sur_4) - (+sp_agg4))));
				$('#sp_specific_gravity_4').val(sp_specific_gravity_4.toFixed(2));
				var sp_specific_gravity_4 = $('#sp_specific_gravity_4').val();

				var sp_specific_gravity1 = (((+sp_specific_gravity_3) + (+sp_specific_gravity_4)) / (+2));
				$('#sp_specific_gravity1').val(sp_specific_gravity1.toFixed(2));
				var sp_specific_gravity1 = $('#sp_specific_gravity1').val();

				var sp_specific_gravity_5 = ((+sp_wat3) / ((+sp_wat3) - ((+sp_w_sur_3) - (+sp_agg3))));
				$('#sp_specific_gravity_5').val(sp_specific_gravity_5.toFixed(2));
				var sp_specific_gravity_5 = $('#sp_specific_gravity_5').val();

				var sp_specific_gravity_6 = ((+sp_wat4) / ((+sp_wat4) - ((+sp_w_sur_4) - (+sp_agg4))));
				$('#sp_specific_gravity_6').val(sp_specific_gravity_6.toFixed(2));
				var sp_specific_gravity_6 = $('#sp_specific_gravity_6').val();

				var sp_specific_gravity2 = (((+sp_specific_gravity_5) + (+sp_specific_gravity_6)) / (+2));
				$('#sp_specific_gravity2').val(sp_specific_gravity2.toFixed(2));
				var sp_specific_gravity2 = $('#sp_specific_gravity2').val();



				var sp_water_abr_1 = ((+100) * ((+sp_w_s_1) - (+sp_wat1)) / (+sp_wat1));
				$('#sp_water_abr_1').val(sp_water_abr_1.toFixed(2));
				var sp_water_abr_1 = $('#sp_water_abr_1').val();

				var sp_water_abr_2 = ((+100) * ((+sp_w_s_2) - (+sp_wat2)) / (+sp_wat2));
				$('#sp_water_abr_2').val(sp_water_abr_2.toFixed(2));
				var sp_water_abr_2 = $('#sp_water_abr_2').val();

				var sp_water_abr = (((+sp_water_abr_1) + (+sp_wat2)) / (+2));
				$('#sp_water_abr').val(sp_water_abr.toFixed(2));
				var sp_water_abr = $('#sp_water_abr').val();

				var sp_water_abr_3 = ((+100) * ((+sp_w_s_3) - (+sp_wat3)) / (+sp_wat3));
				$('#sp_water_abr_3').val(sp_water_abr_3.toFixed(2));
				var sp_water_abr_3 = $('#sp_water_abr_3').val();

				var sp_water_abr_4 = ((+100) * ((+sp_w_s_4) - (+sp_wat4)) / (+sp_wat4))
				$('#sp_water_abr_4').val(sp_water_abr_4.toFixed(2));
				var sp_water_abr_4 = $('#sp_water_abr_4').val();

				var sp_water_abr1 = (((+sp_water_abr_3) + (+sp_wat4)) / (+2));
				$('#sp_water_abr1').val(sp_water_abr1.toFixed(2));
				var sp_water_abr1 = $('#sp_water_abr1').val();

				var sp_water_abr_5 = ((+100) * ((+sp_w_s_5) - (+sp_wat5)) / (+sp_wat5))
				$('#sp_water_abr_5').val(sp_water_abr_5.toFixed(2));
				var sp_water_abr_5 = $('#sp_water_abr_5').val();

				var sp_water_abr_6 = ((+100) * ((+sp_w_s_6) - (+sp_wat6)) / (+sp_wat6))
				$('#sp_water_abr_6').val(sp_water_abr_6.toFixed(2));
				var sp_water_abr_6 = $('#sp_water_abr_6').val();

				var sp_water_abr2 = (((+sp_water_abr_5) + (+sp_wat6)) / (+2));
				$('#sp_water_abr2').val(sp_water_abr2.toFixed(2));
				var sp_water_abr2 = $('#sp_water_abr2').val();

			}

			//SPECIFIC GRAVITY
			$('#chk_sp').change(function() {
				if (this.checked) {
					sp_auto();

				} else {
					$('#txtwtr').css("background-color", "white");
					$('#sp_w_sur_1').val(null);
					$('#sp_w_s_1').val(null);
					$('#sp_wt_st_1').val(null);


					$('#sp_w_sur_2').val(null);
					$('#sp_w_s_2').val(null);
					$('#sp_wt_st_2').val(null);

					$('#sp_w_sur_3').val(null);
					$('#sp_w_s_3').val(null);
					$('#sp_wt_st_3').val(null);

					$('#sp_specific_gravity_1').val(null);
					$('#sp_specific_gravity_2').val(null);
					$('#sp_specific_gravity_3').val(null);
					$('#sp_specific_gravity').val(null);
					$('#sp_water_abr_1').val(null);
					$('#sp_water_abr_2').val(null);
					$('#sp_water_abr_3').val(null);
					$('#sp_water_abr').val(null);
					$('#sp_sample_ca').val(null);
				}
			});



			function sou_auto() {
				$('#txtsou').css("background-color", "var(--success)");
				var s31 = "";
				var s32 = 50;
				var s33 = 50;
				var s34 = "";
				var s35 = 67;
				var s36 = 33;
				var s37 = "";
				var s38 = 67;
				var s39 = 33;
				var s30 = "";
				var s41 = "3000 gm";
				var s44 = "1500 gm";
				var s47 = "1000 gm";
				var s40 = "300 gm";
				var s42 = 1500;
				var s43 = 1500;
				var s45 = 1005;
				var s46 = 495;
				var s48 = 670;
				var s49 = 330;

				$('#s31').val(s31);
				$('#s32').val(s32);
				$('#s33').val(s33);
				$('#s34').val(s34);
				$('#s35').val(s35);
				$('#s36').val(s36);
				$('#s37').val(s37);
				$('#s38').val(s38);
				$('#s39').val(s39);
				$('#s30').val(s30);
				$('#s41').val(s41);
				$('#s44').val(s44);
				$('#s47').val(s47);
				$('#s40').val(s40);
				$('#s42').val(s42);
				$('#s43').val(s43);
				$('#s45').val(s45);
				$('#s46').val(s46);
				$('#s48').val(s48);
				$('#s49').val(s49);
				var s_31 = $('#s31').val();
				var s_34 = $('#s34').val();
				var s_37 = $('#s37').val();
				var s_30 = $('#s30').val();
				var s_42 = $('#s42').val();
				var s_43 = $('#s43').val();
				var s_45 = $('#s45').val();
				var s_46 = $('#s46').val();
				var s_48 = $('#s48').val();
				var s_49 = $('#s49').val();

				var soundness = randomNumberFromRange(0.50, 2.00);
				var s6total = soundness;
				$('#soundness').val(soundness.toFixed(1));
				$('#s6total').val(s6total.toFixed(2));
				var ans = $('#s6total').val();
				var random1 = randomNumberFromRange(-0.1, 100.0);
				if (random1 % 2 == 0) {
					if (random1 > 50) {
						var s68 = (+ans) * (+0.26);
						$('#s68').val(s68.toFixed(2));
						var s_68 = $('#s68').val();
						var s69 = (+ans) - (+s_68);
						$('#s69').val(s69.toFixed(2));
						var s_69 = $('#s69').val();
					} else {
						var s68 = (+ans) * (+0.23);
						$('#s68').val(s68.toFixed(2));
						var s_68 = $('#s68').val();
						var s69 = (+ans) - (+s_68);
						$('#s69').val(s69.toFixed(2));
						var s_69 = $('#s69').val();
					}
				} else {
					if (random1 > 50) {
						var s68 = (+ans) * (+0.29);
						$('#s68').val(s68.toFixed(2));
						var s_68 = $('#s68').val();
						var s69 = (+ans) - (+s_68);
						$('#s69').val(s69.toFixed(2));
						var s_69 = $('#s69').val();
					} else {
						var s68 = (+ans) * (+0.27);
						$('#s68').val(s68.toFixed(2));
						var s_68 = $('#s68').val();
						var s69 = (+ans) - (+s_68);
						$('#s69').val(s69.toFixed(2));
						var s_69 = $('#s69').val();
					}

				}


				var s_temp1 = (+s_68) * 100;
				var s_temp2 = (+s_69) * 100;
				var s_38 = $('#s38').val();
				var s_39 = $('#s39').val();
				var s58 = (+s_temp1) / (+s_38);
				var s59 = (+s_temp2) / (+s_39);

				$('#s58').val(s58.toFixed(1));
				$('#s59').val(s59.toFixed(1));
				var s_58 = $('#s58').val();
				var s_59 = $('#s59').val();


				var s_58 = $('#s58').val();
				var s_59 = $('#s59').val();

				var stemp1 = (+s_38) * (+s_58);
				var stemp2 = (+s_39) * (+s_59);
				var s6_8 = (+stemp1) / 100;
				var s6_9 = (+stemp2) / 100;

				$('#s68').val(s6_8.toFixed(2));
				$('#s69').val(s6_9.toFixed(2));
				var s_6_8 = $('#s68').val();
				var s_6_9 = $('#s69').val();
				var s6total_1 = (+s_6_8) + (+s_6_9);
				$('#s6total').val(s6total_1.toFixed(2));
				$('#soundness').val(s6total_1.toFixed(1));
			}
			// PART 3
			//SOUNDNESS	
			$('#chk_sou').change(function() {
				if (this.checked) {
					sou_auto();
				} else {
					$('#txtsou').css("background-color", "var(--success)");
					$('#soundness').val(null);
					$('#s6total').val(null);

					$('#s31').val(null);
					$('#s32').val(null);
					$('#s33').val(null);
					$('#s34').val(null);
					$('#s35').val(null);
					$('#s36').val(null);
					$('#s37').val(null);
					$('#s38').val(null);
					$('#s39').val(null);
					$('#s30').val(null);
					$('#s41').val(null);
					$('#s42').val(null);
					$('#s43').val(null);
					$('#s44').val(null);
					$('#s45').val(null);
					$('#s46').val(null);
					$('#s47').val(null);
					$('#s48').val(null);
					$('#s49').val(null);
					$('#s40').val(null);
					$('#s51').val(null);
					$('#s52').val(null);
					$('#s53').val(null);
					$('#s54').val(null);
					$('#s55').val(null);
					$('#s56').val(null);
					$('#s57').val(null);
					$('#s58').val(null);
					$('#s59').val(null);
					$('#s50').val(null);
					$('#s61').val(null);
					$('#s62').val(null);
					$('#s63').val(null);
					$('#s64').val(null);
					$('#s65').val(null);
					$('#s66').val(null);
					$('#s67').val(null);
					$('#s68').val(null);
					$('#s69').val(null);
					$('#s60').val(null);

				}
			});



			function flk_auto() {
				$('#txtflk').css("background-color", "var(--success)");
				$('#fi_index').val(0);
				$('#ei_index').val(0);
				$('#combined_index').val(0);

				$('#s1').val(0);
				$('#s2').val(0);
				$('#s3').val(0);
				$('#s4').val(0);
				$('#s5').val(0);
				$('#s6').val(0);
				$('#s7').val(0);
				$('#suma1').val(0);
				$('#suma2').val(0);


				$('#m1').val(0);
				$('#m2').val(0);
				$('#m3').val(0);
				$('#m4').val(0);
				$('#m5').val(0);
				$('#m6').val(0);
				$('#m7').val(0);

				$('#p1').val(0);
				$('#p2').val(0);
				$('#p3').val(0);
				$('#p4').val(0);
				$('#p5').val(0);
				$('#p6').val(0);
				$('#p7').val(0);

				$('#pp1').val(0);
				$('#pp2').val(0);
				$('#pp3').val(0);
				$('#pp4').val(0);
				$('#pp5').val(0);
				$('#pp6').val(0);
				$('#pp7').val(0);

				$('#w1').val(0);
				$('#w2').val(0);
				$('#w3').val(0);
				$('#w4').val(0);
				$('#w5').val(0);
				$('#w6').val(0);
				$('#w7').val(0);
				$('#fi_index1').val(0);
				$('#sumdd1').val(0);

				$('#a1').val(0);
				$('#a2').val(0);
				$('#a3').val(0);
				$('#a4').val(0);
				$('#a5').val(0);
				$('#a6').val(0);
				$('#a7').val(0);
				$('#a8').val(0);
				$('#a9').val(0);
				$('#suma').val(0);

				$('#b1').val(0);
				$('#b2').val(0);
				$('#b3').val(0);
				$('#b4').val(0);
				$('#b5').val(0);
				$('#b6').val(0);
				$('#b7').val(0);
				$('#b8').val(0);
				$('#b9').val(0);
				$('#sumb').val(0);



				$('#aa1').val(0);
				$('#aa2').val(0);
				$('#aa3').val(0);
				$('#aa4').val(0);
				$('#aa5').val(0);
				$('#aa6').val(0);
				$('#aa7').val(0);
				$('#aa8').val(0);
				$('#aa9').val(0);
				$('#sumaa').val(0);



				$('#dd1').val(0);
				$('#dd2').val(0);
				$('#dd3').val(0);
				$('#dd4').val(0);
				$('#dd5').val(0);
				$('#dd6').val(0);
				$('#dd7').val(0);
				$('#dd8').val(0);
				$('#dd9').val(0);
				$('#sumdd').val(0);

				$('#x1').val(0);
				$('#x2').val(0);
				$('#x3').val(0);
				$('#x4').val(0);
				$('#x5').val(0);
				$('#x6').val(0);
				$('#x7').val(0);
				$('#x8').val(0);
				$('#x9').val(0);
				$('#sumx').val(0);

				$('#y1').val(0);
				$('#y2').val(0);
				$('#y3').val(0);
				$('#y4').val(0);
				$('#y5').val(0);
				$('#y6').val(0);
				$('#y7').val(0);
				$('#y8').val(0);
				$('#y9').val(0);
				$('#sumy').val(0);



				general_flk_elo1();
			}

			//FLAKINESS
			$('#chk_flk').change(function() {
				if (this.checked) {
					flk_auto();
				} else {
					$('#txtflk').css("background-color", "white");
					$('#fi_index').val(null);
					$('#ei_index').val(null);
					$('#combined_index').val(null);

					$('#s1').val(null);
					$('#s2').val(null);
					$('#s3').val(null);
					$('#s4').val(null);
					$('#s5').val(null);
					$('#s6').val(null);
					$('#s7').val(null);

					$('#m1').val(null);
					$('#m2').val(null);
					$('#m3').val(null);
					$('#m4').val(null);
					$('#m5').val(null);
					$('#m6').val(null);
					$('#m7').val(null);

					$('#p1').val(null);
					$('#p2').val(null);
					$('#p3').val(null);
					$('#p4').val(null);
					$('#p5').val(null);
					$('#p6').val(null);
					$('#p7').val(null);

					$('#pp1').val(null);
					$('#pp2').val(null);
					$('#pp3').val(null);
					$('#pp4').val(null);
					$('#pp5').val(null);
					$('#pp6').val(null);
					$('#pp7').val(null);

					$('#w1').val(null);
					$('#w2').val(null);
					$('#w3').val(null);
					$('#w4').val(null);
					$('#w5').val(null);
					$('#w6').val(null);
					$('#w7').val(null);
					$('#fi_index1').val(null);
					$('#sumdd1').val(null);


					$('#a1').val(null);
					$('#a2').val(null);
					$('#a3').val(null);
					$('#a4').val(null);
					$('#a5').val(null);
					$('#a6').val(null);
					$('#a7').val(null);
					$('#a8').val(null);
					$('#a9').val(null);
					$('#suma').val(null);


					$('#b1').val(null);
					$('#b2').val(null);
					$('#b3').val(null);
					$('#b4').val(null);
					$('#b5').val(null);
					$('#b6').val(null);
					$('#b7').val(null);
					$('#b8').val(null);
					$('#b9').val(null);
					$('#sumb').val(null);

					$('#aa1').val(null);
					$('#aa2').val(null);
					$('#aa3').val(null);
					$('#aa4').val(null);
					$('#aa5').val(null);
					$('#aa6').val(null);
					$('#aa7').val(null);
					$('#aa8').val(null);
					$('#aa9').val(null);
					$('#sumaa').val(null);

					$('#dd1').val(null);
					$('#dd2').val(null);
					$('#dd3').val(null);
					$('#dd4').val(null);
					$('#dd5').val(null);
					$('#dd6').val(null);
					$('#dd7').val(null);
					$('#dd8').val(null);
					$('#dd9').val(null);
					$('#sumdd').val(null);

					$('#x1').val(null);
					$('#x2').val(null);
					$('#x3').val(null);
					$('#x4').val(null);
					$('#x5').val(null);
					$('#x6').val(null);
					$('#x7').val(null);
					$('#x8').val(null);
					$('#x9').val(null);
					$('#sumx').val(null);

					$('#y1').val(null);
					$('#y2').val(null);
					$('#y3').val(null);
					$('#y4').val(null);
					$('#y5').val(null);
					$('#y6').val(null);
					$('#y7').val(null);
					$('#y8').val(null);
					$('#y9').val(null);
					$('#sumy').val(null);

				}

			});





			function imp_auto() {
				$('#txtimp').css("background-color", "var(--success)");
				var imp_value4 = randomNumberFromRange(13.00, 17.00);
				$('#imp_value').val(imp_value4.toFixed(1));
				var imp_value = $('#imp_value').val();
				var imp_w_m_a_1 = randomNumberFromRange(310.0, 335.0);
				var imp_w_m_a_2 = randomNumberFromRange(310.0, 335.0);
				$('#imp_w_m_a_1').val(imp_w_m_a_1.toFixed(1));
				$('#imp_w_m_a_2').val(imp_w_m_a_2.toFixed(1));
				var imp_wma1 = $('#imp_w_m_a_1').val();
				var imp_wma2 = $('#imp_w_m_a_2').val();

				var r = randomNumberFromRange(-0.3, 0.3);
				var imp_value_1 = (+imp_value) + (+r); //G1
				var imp_value_2 = (+imp_value) - (+r);
				$('#imp_value_1').val(imp_value_1.toFixed(1));
				$('#imp_value_2').val(imp_value_2.toFixed(1));
				var imp_value1 = $('#imp_value_1').val();
				var imp_value2 = $('#imp_value_2').val();

				var imp_w_m_b_1 = ((imp_value1) / 100) * (+imp_wma1);
				var imp_w_m_b_2 = ((imp_value2) / 100) * (+imp_wma2);
				$('#imp_w_m_b_1').val(imp_w_m_b_1.toFixed(1));
				$('#imp_w_m_b_2').val(imp_w_m_b_2.toFixed(1));
				var imp_wmb1 = $('#imp_w_m_b_1').val();
				var imp_wmb2 = $('#imp_w_m_b_2').val();

				var imp_w_m_c_1 = ((+imp_wma1) - (+imp_wmb1));
				var imp_w_m_c_2 = ((+imp_wma2) - (+imp_wmb2));


				$('#imp_w_m_c_1').val(imp_w_m_c_1.toFixed(1));
				$('#imp_w_m_c_2').val(imp_w_m_c_2.toFixed(1));

				$('#imp_w_m_a_1').val(randomNumberFromRange(310.0, 335.0).toFixed(2));
				$('#imp_w_m_a_2').val(randomNumberFromRange(310.0, 335.0).toFixed(2));
				$('#imp_w_m_b_1').val(randomNumberFromRange(310.0, 335.0).toFixed(2));
				$('#imp_w_m_b_2').val(randomNumberFromRange(310.0, 335.0).toFixed(2));
				$('#imp_w_m_c_1').val(randomNumberFromRange(310.0, 335.0).toFixed(2));
				$('#imp_w_m_c_2').val(randomNumberFromRange(310.0, 335.0).toFixed(2));

				var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
				var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
				var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
				var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
				var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
				var imp_w_m_c_2 = $('#imp_w_m_c_2').val();

				var imp_w_m_d_1 = ((+imp_w_m_b_1) + (+imp_w_m_c_1));
				$('#imp_w_m_d_1').val(imp_w_m_d_1.toFixed(2));
				var imp_w_m_d_1 = $('#imp_w_m_d_1').val();

				var imp_w_m_d_2 = ((+imp_w_m_b_2) + (+imp_w_m_c_2));
				$('#imp_w_m_d_2').val(imp_w_m_d_2.toFixed(2));
				var imp_w_m_d_2 = $('#imp_w_m_d_2').val();

				var imp_value_1 = (((+imp_w_m_b_1) / (+imp_w_m_a_1)) * (+100));
				$('#imp_value_1').val(imp_value_1.toFixed(2));
				var imp_value_1 = $('#imp_value_1').val();

				var imp_value_2 = (((+imp_w_m_b_2) / (+imp_w_m_a_2)) * (+100));
				$('#imp_value_2').val(imp_value_2.toFixed(2));
				var imp_value_2 = $('#imp_value_2').val();

				var imp_value = ((+imp_value_1) + (+imp_value_2)) / (+2);
				$('#imp_value').val(imp_value.toFixed(2));
				var imp_value = $('#imp_value').val();
			}
			//IMPACT VALUE 
			$('#chk_impact').change(function() {
				if (this.checked) {
					imp_auto();


				} else {
					$('#txtimp').css("background-color", "white");
					$('#imp_value').val(null);
					$('#imp_value_1').val(null);
					$('#imp_value_2').val(null);
					$('#imp_w_m_a_1').val(null);
					$('#imp_w_m_b_1').val(null);
					$('#imp_w_m_c_1').val(null);
					$('#imp_w_m_a_2').val(null);
					$('#imp_w_m_b_2').val(null);
					$('#imp_w_m_c_2').val(null);
				}

			});



			//FINES VALUE
			function fine_auto() {
				$('#txtfin').css("background-color", "var(--success)");
				var fines_value = randomNumberFromRange(260, 298).toFixed();
				$('#fines_value').val(fines_value);
				var finevalue = $('#fines_value').val();
				var f_a_1 = randomNumberFromRange(2850.0, 3150.0);
				var f_a_2 = randomNumberFromRange(2850.0, 3150.0);
				var f_d_1 = randomNumberFromRange(8.0, 11.0);
				var f_d_2 = randomNumberFromRange(8.0, 11.0);
				$('#f_a_1').val(f_a_1.toFixed(1));
				$('#f_a_2').val(f_a_2.toFixed(1));
				$('#f_d_1').val(f_d_1.toFixed(1));
				$('#f_d_2').val(f_d_2.toFixed(1));
				var f_a1 = $('#f_a_1').val();
				var f_a2 = $('#f_a_2').val();
				var f_d1 = $('#f_d_1').val();
				var f_d2 = $('#f_d_2').val();
				var avg_f_d = ((+f_d1) + (+f_d2)) / 2;
				$('#avg_f_d').val(avg_f_d.toFixed(1));
				var avg_fd = $('#avg_f_d').val();
				var te1 = ((+f_d1) * (+f_a1));
				var te2 = ((+f_d2) * (+f_a2));
				var f_c_1 = (+te1) / 100;
				var f_c_2 = (+te2) / 100;
				$('#f_c_1').val(f_c_1.toFixed(1));
				$('#f_c_2').val(f_c_2.toFixed(1));
				var f_c1 = $('#f_c_1').val();
				var f_c2 = $('#f_c_2').val();
				var y4 = (+avg_fd) + (+4);
				var yinto = (+y4) * (+finevalue);
				var avg_f_c = (+yinto) / 14;
				$('#avg_f_c').val(avg_f_c.toFixed(1));
				var avg_fc = $('#avg_f_c').val();
				var rrr = randomNumberFromRange(-0.3, 0.3).toFixed(1);
				var f_b_1 = (+avg_fc) + (+rrr);
				$('#f_b_1').val(f_b_1.toFixed(1));
				var f_b1 = $('#f_b_1').val();
				var tems1 = ((+avg_fc) * 2);
				var f_b_2 = ((+tems1) - (+f_b1));
				$('#f_b_2').val(f_b_2.toFixed(1));
			}
			$('#chk_fines').change(function() {
				if (this.checked) {
					fine_auto();
				} else {
					$('#txtfin').css("background-color", "white");
					$('#fines_value').val(null);
					$('#avg_f_c').val(null);
					$('#avg_f_d').val(null);
					$('#f_a_1').val(null);
					$('#f_a_2').val(null);
					$('#f_b_1').val(null);
					$('#f_b_2').val(null);
					$('#f_c_1').val(null);
					$('#f_c_2').val(null);
					$('#f_d_1').val(null);
					$('#f_d_2').val(null);

				}

			});




			//ALKALI
			function alk_auto() {
				$('#txtalk').css("background-color", "var(--success)");
				var alk_1 = "Innoucous Aggregate";
				var alk_10 = "Innoucous Aggregate";
				var alk_3 = randomNumberFromRange(0.001, 0.005).toFixed(3);
				var alk_4 = randomNumberFromRange(100, 250).toFixed(0);
				var alk_6 = randomNumberFromRange(11.0, 14.0).toFixed(1);
				var alk_7 = randomNumberFromRange(3.0, 5.0).toFixed(1);
				var alk_8 = randomNumberFromRange(280, 400).toFixed(0);
				$('#alk_1').val(alk_1);
				$('#alk_10').val(alk_10);
				$('#alk_3').val(alk_3);
				$('#alk_4').val(alk_4);
				$('#alk_6').val(alk_6);
				$('#alk_7').val(alk_7);
				$('#alk_8').val(alk_8);
				var alk3 = $('#alk_3').val();
				var alk4 = $('#alk_4').val();
				var alk6 = $('#alk_6').val();
				var alk7 = $('#alk_7').val();
				var alk8 = $('#alk_8').val();
				var alk_2 = (+alk4 / 3330) + (+alk3);
				$('#alk_2').val(alk_2.toFixed(3));
				var tes = (+alk6) - (+alk7);
				var N = 1;
				var eqw1 = (+N) * (+tes);
				var finale = (+eqw1) * 1000 * 20;
				var alk_5 = (+finale) / (+alk8);
				$('#alk_5').val(alk_5.toFixed(1));
				var alk_11 = (+alk4) / (+alk8);
				var alk_9 = alk_11;
				$('#alk_11').val(alk_11.toFixed(3));
				$('#alk_9').val(alk_9.toFixed(3));
			}
			$('#chk_alkali').change(function() {
				if (this.checked) {
					alk_auto();

				} else {
					$('#txtalk').css("background-color", "white");
					$('#alk_1').val(null);
					$('#alk_2').val(null);
					$('#alk_3').val(null);
					$('#alk_4').val(null);
					$('#alk_5').val(null);
					$('#alk_6').val(null);
					$('#alk_7').val(null);
					$('#alk_8').val(null);
					$('#alk_9').val(null);
					$('#alk_10').val(null);
					$('#alk_11').val(null);

				}

			});



			//CRUSHING LOGIC
			function crush_auto() {
				$('#txtcru').css("background-color", "var(--success)");
				var cru_value = randomNumberFromRange(20.0, 26.0).toFixed(1);
				$('#cru_value').val(cru_value);
				var cru_val = $('#cru_value').val();
				var r = randomNumberFromRange(-0.3, 0.3).toFixed(1);
				var cru_value_1 = (+cru_val) + (+r); //G1
				var cru_value_2 = (+cru_val) - (+r); //G1
				$('#cru_value_1').val(cru_value_1.toFixed(1));
				$('#cru_value_2').val(cru_value_2.toFixed(1));
				var cru_value1 = $('#cru_value_1').val();
				var cru_value2 = $('#cru_value_2').val();
				var cr_a_1 = randomNumberFromRange(2850.0, 3150.0).toFixed(1);
				var cr_a_2 = randomNumberFromRange(2850.0, 3150.0).toFixed(1);
				$('#cr_a_1').val(cr_a_1);
				$('#cr_a_2').val(cr_a_2);
				var cr_a1 = $('#cr_a_1').val();
				var cr_a2 = $('#cr_a_2').val();
				var cr_b_1 = ((+cr_a1) / (+100)) * (+cru_value1);
				var cr_b_2 = ((+cr_a2) / (+100)) * (+cru_value2);
				$('#cr_b_1').val(cr_b_1.toFixed(1));
				$('#cr_b_2').val(cr_b_2.toFixed(1));

				$('#cr_a_1').val(randomNumberFromRange(2850.0, 3150.0).toFixed(1));
				$('#cr_a_2').val(randomNumberFromRange(2850.0, 3150.0).toFixed(1));
				$('#cr_b_1').val(randomNumberFromRange(2850.0, 3150.0).toFixed(1));
				$('#cr_b_2').val(randomNumberFromRange(2850.0, 3150.0).toFixed(1));
				$('#cr_c_1').val(randomNumberFromRange(2850.0, 3150.0).toFixed(1));
				$('#cr_c_2').val(randomNumberFromRange(2850.0, 3150.0).toFixed(1));

				var cr_a_1 = $('#cr_a_1').val();
				var cr_a_2 = $('#cr_a_2').val();
				var cr_b_1 = $('#cr_b_1').val();
				var cr_b_2 = $('#cr_b_2').val();
				var cr_c_1 = $('#cr_c_1').val();
				var cr_c_2 = $('#cr_c_2').val();

				var cru_value_1 = (((+cr_b_1) / (+cr_a_1)) * (+100));
				$('#cru_value_1').val(cru_value_1.toFixed(2));
				var cru_value_1 = $('#cru_value_1').val();

				var cru_value_2 = (((+cr_b_2) / (+cr_a_2)) * (+100));
				$('#cru_value_2').val(cru_value_2.toFixed(2));
				var cru_value_2 = $('#cru_value_2').val();

				var cru_value = ((+cru_value_1) + (+cru_value_2)) / (+2);
				$('#cru_value').val(cru_value.toFixed(2));
				var cru_value = $('#cru_value').val();

			}
			$('#chk_crushing').change(function() {
				if (this.checked) {
					crush_auto();
				} else {
					$('#txtcru').css("background-color", "white");
					$('#cru_value').val(null);
					$('#cru_value_1').val(null);
					$('#cr_a_1').val(null);
					$('#cr_a_2').val(null);
					$('#cr_b_1').val(null);
					$('#cru_value_2').val(null);
					$('#cr_b_2').val(null);

				}
			});


			function lll_auto() {
				$('#txtlll').css("background-color", "var(--success)");
				var avg_ll = randomNumberFromRange(21.00, 25.00).toFixed(2);
				$('#avg_ll').val(avg_ll);
				var liquide_limit = (+avg_ll);
				$('#liquide_limit').val(liquide_limit.toFixed());
				var avgll = $('#avg_ll').val();
				var rr = randomNumberFromRange(-0.80, 0.80).toFixed(2);
				var t = randomNumberFromRange(1, 9).toFixed();
				if (t % 2 == 0) {
					var ln1 = (+avgll) + (+rr);
					var ln2 = (+avgll) - (+rr);
				} else {
					var ln1 = (+avgll) - (+rr);
					var ln2 = (+avgll) + (+rr);
				}
				$('#ln1').val(ln1.toFixed(2));
				$('#ln2').val(ln2.toFixed(2));
				var ln_1 = $('#ln1').val();
				var ln_2 = $('#ln2').val();
				$('#avg_pl').val("NP");
				$('#plastic_limit').val("NP");
				$('#pi_value').val("NP");
				var pen1 = randomNumberFromRange(16.0, 24.0).toFixed(1);
				var pen2 = randomNumberFromRange(16.0, 24.0).toFixed(1);
				$('#pen1').val(pen1);
				$('#pen2').val(pen2);
				var pen_1 = $('#pen1').val();
				var pen_2 = $('#pen2').val();
				var cont1 = randomNumberFromRange(1, 360).toFixed();
				var cont2 = randomNumberFromRange(1, 360).toFixed();
				$('#cont1').val(cont1);
				$('#cont2').val(cont2);
				var cont_1 = $('#cont1').val();
				var cont_2 = $('#cont2').val();
				getWeight(cont_1, cont_2);
				var wf_1 = $('#wf1').val();
				var wf_2 = $('#wf2').val();
				var ds1 = randomNumberFromRange(30.00, 40.00).toFixed(2);
				var ds2 = randomNumberFromRange(30.00, 40.00).toFixed(2);
				$('#ds1').val(ds1);
				$('#ds2').val(ds2);
				var ds_1 = $('#ds1').val();
				var ds_2 = $('#ds1').val();

				var temps1 = 0.0175 * (+pen_1);
				var temps2 = 0.0175 * (+pen_2);

				var tme1 = (+temps1) + (+0.65);
				var tme2 = (+temps2) + (+0.65);

				var mo1 = (+ln_1) * (+tme1);
				var mo2 = (+ln_2) * (+tme2);
				$('#mo1').val(mo1.toFixed(2));
				$('#mo2').val(mo2.toFixed(2));
				var mo_1 = $('#mo1').val();
				var mo_2 = $('#mo2').val();

				var ww1 = ((+mo_1) * (+ds_1)) / 100;
				var ww2 = ((+mo_2) * (+ds_2)) / 100;
				$('#ww1').val(ww1.toFixed(2));
				$('#ww2').val(ww2.toFixed(2));
				var ww_1 = $('#ww1').val();
				var ww_2 = $('#ww2').val();

				var od1 = (+ds_1) + (+wf_1);
				var od2 = (+ds_2) + (+wf_2);
				$('#od1').val(od1.toFixed(2));
				$('#od2').val(od2.toFixed(2));
				var od_1 = $('#od1').val();
				var od_2 = $('#od2').val();

				var wc1 = (+od_1) + (+ww_1);
				var wc2 = (+od_2) + (+ww_2);
				$('#wc1').val(wc1.toFixed(2));
				$('#wc2').val(wc2.toFixed(2));
				var wc_1 = $('#wc1').val();
				var wc_2 = $('#wc2').val();



			}

			//Liquid Limit
			$('#chk_ll').change(function() {
				if (this.checked) {
					lll_auto();


				} else {
					$('#txtlll').css("background-color", "white");
					$('#pen1').val(null);
					$('#pen2').val(null);
					$('#pen3').val(null);
					$('#pen4').val(null);
					$('#cont1').val(null);
					$('#cont2').val(null);
					$('#cont3').val(null);
					$('#cont4').val(null);
					$('#wc1').val(null);
					$('#wc2').val(null);
					$('#wc3').val(null);
					$('#wc4').val(null);
					$('#od1').val(null);
					$('#od2').val(null);
					$('#od3').val(null);
					$('#od4').val(null);
					$('#ww1').val(null);
					$('#ww2').val(null);
					$('#ww3').val(null);
					$('#ww4').val(null);
					$('#wf1').val(null);
					$('#wf2').val(null);
					$('#wf3').val(null);
					$('#wf4').val(null);
					$('#ds1').val(null);
					$('#ds2').val(null);
					$('#ds3').val(null);
					$('#ds4').val(null);
					$('#mo1').val(null);
					$('#mo2').val(null);
					$('#mo3').val(null);
					$('#mo4').val(null);
					$('#ln1').val(null);
					$('#ln2').val(null);
					$('#ln3').val(null);
					$('#ln4').val(null);

					$('#avg_ll').val(null);
					$('#avg_pl').val(null);
					$('#liquide_limit').val(null);
					$('#pi_value').val(null);
					$('#plastic_limit').val(null);

				}
			});

			function ll() {
				var avgll = $('#avg_ll').val();
				var liquide_limit = (+avgll);
				$('#liquide_limit').val(liquide_limit.toFixed());
				var liquide_limit = $('#liquide_limit').val();
				var rr = randomNumberFromRange(-0.80, 0.80).toFixed(2);
				var t = randomNumberFromRange(1, 9).toFixed();
				if (t % 2 == 0) {
					var ln1 = (+avgll) + (+rr);
					var ln2 = (+avgll) - (+rr);
				} else {
					var ln1 = (+avgll) - (+rr);
					var ln2 = (+avgll) + (+rr);
				}
				$('#ln1').val(ln1.toFixed(2));
				$('#ln2').val(ln2.toFixed(2));
				var ln_1 = $('#ln1').val();
				var ln_2 = $('#ln2').val();
				$('#avg_pl').val("NP");
				$('#plastic_limit').val("NP");
				$('#pi_value').val("NP");
				var pen1 = randomNumberFromRange(16.0, 24.0).toFixed(1);
				var pen2 = randomNumberFromRange(16.0, 24.0).toFixed(1);
				$('#pen1').val(pen1);
				$('#pen2').val(pen2);
				var pen_1 = $('#pen1').val();
				var pen_2 = $('#pen2').val();
				var cont1 = randomNumberFromRange(1, 360).toFixed();
				var cont2 = randomNumberFromRange(1, 360).toFixed();
				$('#cont1').val(cont1);
				$('#cont2').val(cont2);
				var cont_1 = $('#cont1').val();
				var cont_2 = $('#cont2').val();
				getWeight(cont_1, cont_2);
				var wf_1 = $('#wf1').val();
				var wf_2 = $('#wf2').val();
				var ds1 = randomNumberFromRange(30.00, 40.00).toFixed(2);
				var ds2 = randomNumberFromRange(30.00, 40.00).toFixed(2);
				$('#ds1').val(ds1);
				$('#ds2').val(ds2);
				var ds_1 = $('#ds1').val();
				var ds_2 = $('#ds1').val();

				var temps1 = 0.0175 * (+pen_1);
				var temps2 = 0.0175 * (+pen_2);

				var tme1 = (+temps1) + (+0.65);
				var tme2 = (+temps2) + (+0.65);

				var mo1 = (+ln_1) * (+tme1);
				var mo2 = (+ln_2) * (+tme2);
				$('#mo1').val(mo1.toFixed(2));
				$('#mo2').val(mo2.toFixed(2));
				var mo_1 = $('#mo1').val();
				var mo_2 = $('#mo2').val();

				var ww1 = ((+mo_1) * (+ds_1)) / 100;
				var ww2 = ((+mo_2) * (+ds_2)) / 100;
				$('#ww1').val(ww1.toFixed(2));
				$('#ww2').val(ww2.toFixed(2));
				var ww_1 = $('#ww1').val();
				var ww_2 = $('#ww2').val();

				var od1 = (+ds_1) + (+wf_1);
				var od2 = (+ds_2) + (+wf_2);
				$('#od1').val(od1.toFixed(2));
				$('#od2').val(od2.toFixed(2));
				var od_1 = $('#od1').val();
				var od_2 = $('#od2').val();

				var wc1 = (+od_1) + (+ww_1);
				var wc2 = (+od_2) + (+ww_2);
				$('#wc1').val(wc1.toFixed(2));
				$('#wc2').val(wc2.toFixed(2));
				var wc_1 = $('#wc1').val();
				var wc_2 = $('#wc2').val();



			}

			function getWeight(wt1, wt2) {
				$.ajax({
					dataType: 'JSON',
					type: 'POST',
					url: '<?php echo $base_url; ?>get_contanier.php',
					data: 'action_type=get_excel_record&wt=' + wt1,
					success: function(data) {

						$('#wf1').val(data.id);

					}
				});
				$.ajax({
					dataType: 'JSON',
					type: 'POST',
					url: '<?php echo $base_url; ?>get_contanier.php',
					data: 'action_type=get_excel_record&wt=' + wt2,
					success: function(data) {

						$('#wf2').val(data.id);

					}
				});
			}



			function den_auto() {
				$('#txtden').css("background-color", "var(--success)");
				var bdl = randomNumberFromRange(1.61, 1.66).toFixed(2);
				var vol = 15.27;
				$('#bdl').val(bdl);
				$('#vol').val(vol);
				var bdl1 = $('#bdl').val();
				var avg_wom = (+bdl1) * (+vol);
				$('#avg_wom').val(avg_wom.toFixed(2));
				$('#avg_wom1').val(avg_wom.toFixed(2));
				var avg = $('#avg_wom').val();
				var m21 = 10.90;
				var m22 = 10.90;
				var m23 = 10.90;

				var m31 = (+avg) + randomNumberFromRange(-0.20, 0.10);
				var m32 = (+avg) - randomNumberFromRange(-0.30, 0.10);
				$('#m31').val(m31.toFixed(2));
				$('#m32').val(m32.toFixed(2));
				var wo1 = $('#m31').val();
				var wo2 = $('#m32').val();
				var tem1 = (+avg) * 3;
				var tem2 = (+wo1) + (+wo2);
				var m33 = (+tem1) - (+tem2);
				$('#m33').val(m33.toFixed(2));
				var wo3 = $('#m33').val();

				var m11 = (+m21) + (+wo1);
				var m12 = (+m22) + (+wo2);
				var m13 = (+m23) + (+wo3);

				$('#m11').val(m11.toFixed(2));
				$('#m12').val(m12.toFixed(2));
				$('#m13').val(m13.toFixed(2));
				$('#m21').val(m21.toFixed(2));
				$('#m22').val(m22.toFixed(2));
				$('#m23').val(m23.toFixed(2));

				$('#m11').val(randomNumberFromRange(1.61, 9.66).toFixed(2));
				$('#m12').val(randomNumberFromRange(1.61, 9.66).toFixed(2));
				$('#m13').val(randomNumberFromRange(1.61, 9.66).toFixed(2));
				$('#m31').val(randomNumberFromRange(1.61, 9.66).toFixed(2));
				$('#m32').val(randomNumberFromRange(1.61, 9.66).toFixed(2));
				$('#m33').val(randomNumberFromRange(1.61, 9.66).toFixed(2));
				$('#m21').val(randomNumberFromRange(1.61, 9.66).toFixed(2));
				$('#m22').val(randomNumberFromRange(1.61, 9.66).toFixed(2));
				$('#m23').val(randomNumberFromRange(1.61, 9.66).toFixed(2));

				var m11 = $('#m11').val();
				var m12 = $('#m12').val();
				var m13 = $('#m13').val();
				var m31 = $('#m31').val();
				var m32 = $('#m32').val();
				var m33 = $('#m33').val();
				var m21 = $('#m21').val();
				var m22 = $('#m22').val();
				var m23 = $('#m23').val();

				var m41 = ((+m21) - (+m31));
				$('#m41').val(m41.toFixed(2));
				var m41 = $('#m41').val();

				var m42 = ((+m22) - (+m32));
				$('#m42').val(m42.toFixed(2));
				var m42 = $('#m42').val();

				var m43 = ((+m23) - (+m33));
				$('#m43').val(m43.toFixed(2));
				var m43 = $('#m43').val();

				var m51 = ((+m41) / (+m31));
				$('#m51').val(m51.toFixed(2));
				var m51 = $('#m51').val();

				var m52 = ((+m42) / (+m32));
				$('#m52').val(m52.toFixed(2));
				var m52 = $('#m52').val();

				var m53 = ((+m43) / (+m33));
				$('#m53').val(m53.toFixed(2));
				var m53 = $('#m53').val();

				var avg_wom = (((+m51) + (+m52) + (+m53)) / (+3));
				$('#avg_wom').val(avg_wom.toFixed(2));
				var avg_wom = $('#avg_wom').val();

			}

			//BULK DENSITY
			$('#chk_den').change(function() {
				if (this.checked) {
					den_auto();


				} else {
					$('#bdl').val(null);
					$('#vol').val(null);
					$('#avg_wom').val(null);
					$('#avg_wom1').val(null);
					$('#m21').val(null);
					$('#m22').val(null);
					$('#m23').val(null);
					$('#m11').val(null);
					$('#m12').val(null);
					$('#m13').val(null);
					$('#m31').val(null);
					$('#m32').val(null);
					$('#m33').val(null);
					$('#txtden').css("background-color", "white");


				}
			});

			function bulk_den() {
				$('#txtden').css("background-color", "var(--success)");
				var bdl = $('#bdl').val();
				var vol = 15.27;
				$('#vol').val(vol);
				var avg_wom = (+bdl) * (+vol);
				$('#avg_wom').val(avg_wom.toFixed(2));
				$('#avg_wom1').val(avg_wom.toFixed(2));
				var avg = $('#avg_wom').val();
				var m21 = 10.90;
				var m22 = 10.90;
				var m23 = 10.90;

				var m31 = (+avg) + randomNumberFromRange(-0.20, 0.10);
				var m32 = (+avg) - randomNumberFromRange(-0.30, 0.10);
				$('#m31').val(m31.toFixed(2));
				$('#m32').val(m32.toFixed(2));
				var wo1 = $('#m31').val();
				var wo2 = $('#m32').val();
				var tem1 = (+avg) * 3;
				var tem2 = (+wo1) + (+wo2);
				var m33 = (+tem1) - (+tem2);
				$('#m33').val(m33.toFixed(2));
				var wo3 = $('#m33').val();

				var m11 = (+m21) + (+wo1);
				var m12 = (+m22) + (+wo2);
				var m13 = (+m23) + (+wo3);

				$('#m11').val(m11.toFixed(2));
				$('#m12').val(m12.toFixed(2));
				$('#m13').val(m13.toFixed(2));
				$('#m21').val(m21.toFixed(2));
				$('#m22').val(m22.toFixed(2));
				$('#m23').val(m23.toFixed(2));



			}



			function grd_auto() {
				$('#txtgrd').css("background-color", "var(--success)");
				var sieve_1 = "40";
				var sieve_2 = "20";
				var sieve_3 = "10";
				var sieve_4 = "4.75";

				var sample_taken = 5000;
				//PASSING RANGE
				var pass_sample_1 = randomNumberFromRange(100, 100).toFixed(2);
				var pass_sample_2 = randomNumberFromRange(90.00, 99.00).toFixed(2);
				var pass_sample_3 = randomNumberFromRange(6.00, 19.00).toFixed(2);
				var pass_sample_4 = randomNumberFromRange(0.00, 4.00).toFixed(2);

				$('#pass_sample_1').val(pass_sample_1);
				$('#pass_sample_2').val(pass_sample_2);
				$('#pass_sample_3').val(pass_sample_3);
				$('#pass_sample_4').val(pass_sample_4);

				var pass_sample1 = $('#pass_sample_1').val();
				var pass_sample2 = $('#pass_sample_2').val();
				var pass_sample3 = $('#pass_sample_3').val();
				var pass_sample4 = $('#pass_sample_4').val();


				//(100 - PASSING SAMPLE)
				var cum_ret_1 = 100 - (+pass_sample1);
				var cum_ret_2 = 100 - (+pass_sample2);
				var cum_ret_3 = 100 - (+pass_sample3);
				var cum_ret_4 = 100 - (+pass_sample4);

				$('#cum_ret_1').val(cum_ret_1.toFixed(2));
				$('#cum_ret_2').val(cum_ret_2.toFixed(2));
				$('#cum_ret_3').val(cum_ret_3.toFixed(2));
				$('#cum_ret_4').val(cum_ret_4.toFixed(2));

				var cum_ret1 = $('#cum_ret_1').val();
				var cum_ret2 = $('#cum_ret_2').val();
				var cum_ret3 = $('#cum_ret_3').val();
				var cum_ret4 = $('#cum_ret_4').val();


				//(CUMRET*100)
				var ret_wt_gm_1 = ((+cum_ret1) * (+sample_taken)) / 100;
				var ret_wt_gm_2 = ((+cum_ret2) * (+sample_taken)) / 100;
				var ret_wt_gm_3 = ((+cum_ret3) * (+sample_taken)) / 100;
				var ret_wt_gm_4 = ((+cum_ret4) * (+sample_taken)) / 100;

				$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
				$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
				$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
				$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));

				var ret_wt_gm1 = $('#ret_wt_gm_1').val();
				var ret_wt_gm2 = $('#ret_wt_gm_2').val();
				var ret_wt_gm3 = $('#ret_wt_gm_3').val();
				var ret_wt_gm4 = $('#ret_wt_gm_4').val();



				//MINUS PLUS
				var cum_wt_gm_1 = ret_wt_gm1;
				var cum_wt_gm_2 = parseFloat(ret_wt_gm2) - parseFloat(ret_wt_gm1);
				var cum_wt_gm_3 = parseFloat(ret_wt_gm3) - parseFloat(ret_wt_gm2);
				var cum_wt_gm_4 = parseFloat(ret_wt_gm4) - parseFloat(ret_wt_gm3);


				$('#cum_wt_gm_1').val(cum_wt_gm_1);
				$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
				$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
				$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));

				var cum_wt_gm1 = $('#cum_wt_gm_1').val();
				var cum_wt_gm2 = $('#cum_wt_gm_2').val();
				var cum_wt_gm3 = $('#cum_wt_gm_3').val();
				var cum_wt_gm4 = $('#cum_wt_gm_4').val();


				//(SUM OF CUM. WAIGHT)
				var blank_extra = (+cum_wt_gm1) + (+cum_wt_gm2) + (+cum_wt_gm3) + (+cum_wt_gm4);

				$('#blank_extra').val(blank_extra.toFixed(0));
				$('#sample_taken').val(sample_taken.toFixed(0));
				var sample_taken = $('#sample_taken').val();
				//PASSING RANGE
				var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
				var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
				var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
				var cum_wt_gm_4 = $('#cum_wt_gm_4').val();

				//MINUS PLUS
				var ret_wt_gm_1 = cum_wt_gm_1;
				var ret_wt_gm_2 = (+cum_wt_gm_2) + (+ret_wt_gm_1);
				var ret_wt_gm_3 = (+cum_wt_gm_3) + (+ret_wt_gm_2);
				var ret_wt_gm_4 = (+cum_wt_gm_4) + (+ret_wt_gm_3);

				$('#ret_wt_gm_1').val(ret_wt_gm_1);
				$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
				$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
				$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));

				var blank_extra = (+cum_wt_gm_1) + (+cum_wt_gm_2) + (+cum_wt_gm_3) + (+cum_wt_gm_4);
				$('#blank_extra').val(blank_extra.toFixed(0));

				var ret_wt_gm1 = $('#ret_wt_gm_1').val();
				var ret_wt_gm2 = $('#ret_wt_gm_2').val();
				var ret_wt_gm3 = $('#ret_wt_gm_3').val();
				var ret_wt_gm4 = $('#ret_wt_gm_4').val();

				var cum_ret_1 = ((+ret_wt_gm1) / (+sample_taken)) * 100;
				var cum_ret_2 = ((+ret_wt_gm2) / (+sample_taken)) * 100;
				var cum_ret_3 = ((+ret_wt_gm3) / (+sample_taken)) * 100;
				var cum_ret_4 = ((+ret_wt_gm4) / (+sample_taken)) * 100;

				$('#cum_ret_1').val(cum_ret_1.toFixed(2));
				$('#cum_ret_2').val(cum_ret_2.toFixed(2));
				$('#cum_ret_3').val(cum_ret_3.toFixed(2));
				$('#cum_ret_4').val(cum_ret_4.toFixed(2));

				var cum_ret1 = $('#cum_ret_1').val();
				var cum_ret2 = $('#cum_ret_2').val();
				var cum_ret3 = $('#cum_ret_3').val();
				var cum_ret4 = $('#cum_ret_4').val();

				var pass_sample_1 = 100.00;
				var pass_sample_2 = (+100.00) - (+cum_ret2);
				var pass_sample_3 = (+100.00) - (+cum_ret3);
				var pass_sample_4 = (+100.00) - (+cum_ret4);

				$('#pass_sample_1').val(pass_sample_1);
				$('#pass_sample_2').val(pass_sample_2.toFixed(2));
				$('#pass_sample_3').val(pass_sample_3.toFixed(2));
				$('#pass_sample_4').val(pass_sample_4.toFixed(2));
			}
			//GRADATION

			$('#chk_grd').change(function() {
				if (this.checked) {
					grd_auto();

				} else {
					$('#txtgrd').css("background-color", "white");
					$('#cum_wt_gm_1').val(null);
					$('#cum_wt_gm_2').val(null);
					$('#cum_wt_gm_3').val(null);
					$('#cum_wt_gm_4').val(null);


					$('#ret_wt_gm_1').val(null);
					$('#ret_wt_gm_2').val(null);
					$('#ret_wt_gm_3').val(null);
					$('#ret_wt_gm_4').val(null);



					$('#cum_ret_1').val(null);
					$('#cum_ret_2').val(null);
					$('#cum_ret_3').val(null);
					$('#cum_ret_4').val(null);


					$('#pass_sample_1').val(null);
					$('#pass_sample_2').val(null);
					$('#pass_sample_3').val(null);
					$('#pass_sample_4').val(null);

					$('#blank_extra').val(null);
					$('#sample_taken').val(null);
				}
			});

			function grd_func() {
				$('#txtgrd').css("background-color", "var(--success)");
				var sieve_1 = "40";
				var sieve_2 = "20";
				var sieve_3 = "10";
				var sieve_4 = "4.75";

				var sample_taken = $('#sample_taken').val();
				//PASSING RANGE
				var pass_sample_1 = $('#pass_sample_1').val();
				var pass_sample_2 = $('#pass_sample_2').val();
				var pass_sample_3 = $('#pass_sample_3').val();
				var pass_sample_4 = $('#pass_sample_4').val();


				//(100 - PASSING SAMPLE)
				var cum_ret_1 = 100 - (+pass_sample_1);
				var cum_ret_2 = 100 - (+pass_sample_2);
				var cum_ret_3 = 100 - (+pass_sample_3);
				var cum_ret_4 = 100 - (+pass_sample_4);

				$('#cum_ret_1').val(cum_ret_1.toFixed(2));
				$('#cum_ret_2').val(cum_ret_2.toFixed(2));
				$('#cum_ret_3').val(cum_ret_3.toFixed(2));
				$('#cum_ret_4').val(cum_ret_4.toFixed(2));

				var cum_ret1 = $('#cum_ret_1').val();
				var cum_ret2 = $('#cum_ret_2').val();
				var cum_ret3 = $('#cum_ret_3').val();
				var cum_ret4 = $('#cum_ret_4').val();

				//(CUMRET*100)
				var ret_wt_gm_1 = (parseFloat(cum_ret1) * parseFloat(sample_taken)) / 100;
				var ret_wt_gm_2 = (parseFloat(cum_ret2) * parseFloat(sample_taken)) / 100;
				var ret_wt_gm_3 = (parseFloat(cum_ret3) * parseFloat(sample_taken)) / 100;
				var ret_wt_gm_4 = (parseFloat(cum_ret4) * parseFloat(sample_taken)) / 100;

				$('#ret_wt_gm_1').val(ret_wt_gm_1.toFixed(0));
				$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
				$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
				$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));

				var ret_wt_gm1 = $('#ret_wt_gm_1').val();
				var ret_wt_gm2 = $('#ret_wt_gm_2').val();
				var ret_wt_gm3 = $('#ret_wt_gm_3').val();
				var ret_wt_gm4 = $('#ret_wt_gm_4').val();


				//MINUS PLUS
				var cum_wt_gm_1 = ret_wt_gm1;
				var cum_wt_gm_2 = parseFloat(ret_wt_gm2) - parseFloat(ret_wt_gm1);
				var cum_wt_gm_3 = parseFloat(ret_wt_gm3) - parseFloat(ret_wt_gm2);
				var cum_wt_gm_4 = parseFloat(ret_wt_gm4) - parseFloat(ret_wt_gm3);

				$('#cum_wt_gm_1').val(cum_wt_gm_1.toFixed(0));
				$('#cum_wt_gm_2').val(cum_wt_gm_2.toFixed(0));
				$('#cum_wt_gm_3').val(cum_wt_gm_3.toFixed(0));
				$('#cum_wt_gm_4').val(cum_wt_gm_4.toFixed(0));

				var cum_wt_gm1 = $('#cum_wt_gm_1').val();
				var cum_wt_gm2 = $('#cum_wt_gm_2').val();
				var cum_wt_gm3 = $('#cum_wt_gm_3').val();
				var cum_wt_gm4 = $('#cum_wt_gm_4').val();

				//(SUM OF CUM. WAIGHT)
				var blank_extra = (+cum_wt_gm1) + (+cum_wt_gm2) + (+cum_wt_gm3) + (+cum_wt_gm4);
				$('#blank_extra').val(blank_extra.toFixed(0));

			}



			function weight_cum_gm() {
				var sieve_1 = "40";
				var sieve_2 = "20";
				var sieve_3 = "10";
				var sieve_4 = "4.75";

				$('#txtgrd').css("background-color", "var(--success)");
				var sample_taken = $('#sample_taken').val();
				//PASSING RANGE
				var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
				var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
				var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
				var cum_wt_gm_4 = $('#cum_wt_gm_4').val();

				//MINUS PLUS
				var ret_wt_gm_1 = cum_wt_gm_1;
				var ret_wt_gm_2 = (+cum_wt_gm_2) + (+ret_wt_gm_1);
				var ret_wt_gm_3 = (+cum_wt_gm_3) + (+ret_wt_gm_2);
				var ret_wt_gm_4 = (+cum_wt_gm_4) + (+ret_wt_gm_3);

				$('#ret_wt_gm_1').val(ret_wt_gm_1);
				$('#ret_wt_gm_2').val(ret_wt_gm_2.toFixed(0));
				$('#ret_wt_gm_3').val(ret_wt_gm_3.toFixed(0));
				$('#ret_wt_gm_4').val(ret_wt_gm_4.toFixed(0));

				var blank_extra = (+cum_wt_gm_1) + (+cum_wt_gm_2) + (+cum_wt_gm_3) + (+cum_wt_gm_4);
				$('#blank_extra').val(blank_extra.toFixed(0));

				var ret_wt_gm1 = $('#ret_wt_gm_1').val();
				var ret_wt_gm2 = $('#ret_wt_gm_2').val();
				var ret_wt_gm3 = $('#ret_wt_gm_3').val();
				var ret_wt_gm4 = $('#ret_wt_gm_4').val();
				var sample_taken = $('#sample_taken').val();

				var cum_ret_1 = ((+ret_wt_gm1) / (+sample_taken)) * 100;
				var cum_ret_2 = ((+ret_wt_gm2) / (+sample_taken)) * 100;
				var cum_ret_3 = ((+ret_wt_gm3) / (+sample_taken)) * 100;
				var cum_ret_4 = ((+ret_wt_gm4) / (+sample_taken)) * 100;

				$('#cum_ret_1').val(cum_ret_1.toFixed(2));
				$('#cum_ret_2').val(cum_ret_2.toFixed(2));
				$('#cum_ret_3').val(cum_ret_3.toFixed(2));
				$('#cum_ret_4').val(cum_ret_4.toFixed(2));


				var cum_ret1 = $('#cum_ret_1').val();
				var cum_ret2 = $('#cum_ret_2').val();
				var cum_ret3 = $('#cum_ret_3').val();
				var cum_ret4 = $('#cum_ret_4').val();

				var pass_sample_1 = 100.00;
				var pass_sample_2 = (+100.00) - (+cum_ret2);
				var pass_sample_3 = (+100.00) - (+cum_ret3);
				var pass_sample_4 = (+100.00) - (+cum_ret4);

				$('#pass_sample_1').val(pass_sample_1);
				$('#pass_sample_2').val(pass_sample_2.toFixed(2));
				$('#pass_sample_3').val(pass_sample_3.toFixed(2));
				$('#pass_sample_4').val(pass_sample_4.toFixed(2));




			}



			function slp_auto() {
				$('#txtslp').css("background-color", "var(--success)");
				var slp_s1_1 = randomNumberFromRange(10.0100, 10.0300).toFixed(4);
				$('#slp_s1_1').val(slp_s1_1);
				var slp_s11 = $('#slp_s1_1').val();

				var slp_s2_1 = randomNumberFromRange(10.0100, 10.0300).toFixed(4);
				$('#slp_s2_1').val(slp_s2_1);
				var slp_s21 = $('#slp_s2_1').val();

				var slp_s1_2 = randomNumberFromRange(69.0000, 71.0000).toFixed(4);
				$('#slp_s1_2').val(slp_s1_2);
				var slp_s12 = $('#slp_s1_2').val();

				var slp_s2_2 = randomNumberFromRange(69.0000, 71.0000).toFixed(4);
				$('#slp_s2_2').val(slp_s2_2);
				var slp_s22 = $('#slp_s2_2').val();

				var slp_s1_3 = (+slp_s12) * (+randomNumberFromRange(1.00005, 1.00012).toFixed(5));
				$('#slp_s1_3').val(slp_s1_3.toFixed(4));
				var slp_s13 = $('#slp_s1_3').val();

				var slp_s2_3 = (+slp_s22) * (+randomNumberFromRange(1.00005, 1.00012).toFixed(5));
				$('#slp_s2_3').val(slp_s2_3.toFixed(4));
				var slp_s23 = $('#slp_s2_3').val();

				var slp_s1_4 = (+slp_s13) - (+slp_s12);
				var slp_s2_4 = (+slp_s23) - (+slp_s22);
				$('#slp_s1_4').val(slp_s1_4.toFixed(4));
				$('#slp_s2_4').val(slp_s2_4.toFixed(4));
				var slp_s14 = $('#slp_s1_4').val();
				var slp_s24 = $('#slp_s2_4').val();

				var slp_s1_5 = ((+41.15) * (+slp_s14)) / (+slp_s11);
				var slp_s2_5 = ((+41.15) * (+slp_s24)) / (+slp_s21);
				$('#slp_s1_5').val(slp_s1_5.toFixed(4));
				$('#slp_s2_5').val(slp_s2_5.toFixed(4));
				var slp_s15 = $('#slp_s1_5').val();
				var slp_s25 = $('#slp_s2_5').val();

				var avg = ((+slp_s15) + (+slp_s25)) / 2;
				$('#avg_sul').val(avg.toFixed(3));
			}

			$('#chk_slp').change(function() {
				if (this.checked) {
					slp_auto();
				} else {
					$('#txtslp').css("background-color", "white");
					$('#slp_s1_1').val(null);
					$('#slp_s1_2').val(null);
					$('#slp_s1_3').val(null);
					$('#slp_s1_4').val(null);
					$('#slp_s1_5').val(null);
					$('#slp_s2_1').val(null);
					$('#slp_s2_2').val(null);
					$('#slp_s2_3').val(null);
					$('#slp_s2_4').val(null);
					$('#slp_s2_5').val(null);
					$('#avg_sul').val(null);
				}
			});


			function clr_auto() {
				$('#txtclr').css("background-color", "var(--success)");
				var clr_s1_1 = randomNumberFromRange(498.000, 503.000).toFixed(3);
				$('#clr_s1_1').val(clr_s1_1);
				var clr_s11 = $('#clr_s1_1').val();

				var clr_s1_2 = randomNumberFromRange(498.000, 503.000).toFixed(3);
				$('#clr_s1_2').val(clr_s1_2);
				var clr_s12 = $('#clr_s1_2').val();

				var clr_s1_3 = (+clr_s11) / (+clr_s12);
				$('#clr_s1_3').val(clr_s1_3.toFixed(3));
				var clr_s13 = $('#clr_s1_3').val();

				var clr_s2_1 = randomNumberFromRange(498.000, 503.000).toFixed(3);
				$('#clr_s2_1').val(clr_s2_1);
				var clr_s21 = $('#clr_s2_1').val();

				var clr_s2_2 = randomNumberFromRange(498.000, 503.000).toFixed(3);
				$('#clr_s2_2').val(clr_s2_2);
				var clr_s22 = $('#clr_s2_2').val();

				var clr_s2_3 = (+clr_s21) / (+clr_s22);
				$('#clr_s2_3').val(clr_s2_3.toFixed(3));
				var clr_s23 = $('#clr_s2_3').val();


				var clr_s1_4 = randomNumberFromRange(9.95, 10.05);
				var clr_s2_4 = randomNumberFromRange(9.95, 10.05);
				$('#clr_s1_4').val(clr_s1_4.toFixed(2));
				$('#clr_s2_4').val(clr_s2_4.toFixed(2));
				var clr_s14 = $('#clr_s1_4').val();
				var clr_s24 = $('#clr_s2_4').val();

				var clr_s1_5 = randomNumberFromRange(9.60, 9.70);
				var clr_s2_5 = randomNumberFromRange(9.60, 9.70);
				$('#clr_s1_5').val(clr_s1_5.toFixed(2));
				$('#clr_s2_5').val(clr_s2_5.toFixed(2));
				var clr_s15 = $('#clr_s1_5').val();
				var clr_s25 = $('#clr_s2_5').val();
				var clr_s1_6 = 0.10;
				var clr_s2_6 = 0.10;
				$('#clr_s1_6').val(clr_s1_6.toFixed(2));
				$('#clr_s2_6').val(clr_s2_6.toFixed(2));
				var clr_s16 = $('#clr_s1_6').val();
				var clr_s26 = $('#clr_s2_6').val();

				var so1_1 = (+10) * (+clr_s16) * (+clr_s15);
				var so2_1 = (+10) * (+clr_s26) * (+clr_s25);

				var sol1_1 = (+clr_s14) - (+so1_1);
				var sol2_1 = (+clr_s24) - (+so2_1);

				var fin1_1 = (+0.003546) * (+clr_s13) * (+sol1_1);
				var fin2_1 = (+0.003546) * (+clr_s23) * (+sol2_1);

				$('#clr_s1_7').val(fin1_1.toFixed(4));
				$('#clr_s2_7').val(fin2_1.toFixed(4));

				var clr_s17 = $('#clr_s1_7').val();
				var clr_s27 = $('#clr_s2_7').val();

				var avgs = ((+clr_s17) + (+clr_s27)) / 2;
				$('#av_clr').val(avgs.toFixed(3));



			}

			$('#chk_clr').change(function() {
				if (this.checked) {
					clr_auto();
				} else {
					$('#txtclr').css("background-color", "white");
					$('#clr_s1_1').val(null);
					$('#clr_s1_2').val(null);
					$('#clr_s1_3').val(null);
					$('#clr_s1_4').val(null);
					$('#clr_s1_5').val(null);
					$('#clr_s1_6').val(null);
					$('#clr_s1_7').val(null);
					$('#clr_s2_1').val(null);
					$('#clr_s2_2').val(null);
					$('#clr_s2_3').val(null);
					$('#clr_s2_4').val(null);
					$('#clr_s2_5').val(null);
					$('#clr_s2_6').val(null);
					$('#clr_s2_7').val(null);
					$('#av_clr').val(null);
				}
			});

			function pha_auto() {
				$('#txtpha').css("background-color", "var(--success)");
				var ph_s1_1 = randomNumberFromRange(30.00, 30.10).toFixed(2);
				$('#ph_s1_1').val(ph_s1_1);
				var ph_s11 = $('#ph_s1_1').val();

				var ph_s2_1 = randomNumberFromRange(30.00, 30.10).toFixed(2);
				$('#ph_s2_1').val(ph_s2_1);
				var ph_s21 = $('#ph_s2_1').val();

				var ph_s1_2 = randomNumberFromRange(7.10, 7.15).toFixed(2);
				$('#ph_s1_2').val(ph_s1_2);
				var ph_s12 = $('#ph_s1_2').val();

				var ph_s2_2 = randomNumberFromRange(7.10, 7.15).toFixed(2);
				$('#ph_s2_2').val(ph_s2_2);
				var ph_s22 = $('#ph_s2_2').val();

				var avg = ((+ph_s12) + (+ph_s22)) / 2;
				$('#avg_ph').val(avg.toFixed(2));


			}

			$('#chk_pha').change(function() {
				if (this.checked) {
					pha_auto();
				} else {
					$('#txtpha').css("background-color", "white");
					$('#ph_s1_1').val(null);
					$('#ph_s1_2').val(null);
					$('#ph_s2_1').val(null);
					$('#ph_s2_2').val(null);
					$('#avg_ph').val(null);
				}
			});

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
					$('#txtdtm').css("background-color", "white");
					$('#dele_1_1').val(null);
					$('#dele_1_2').val(null);
					$('#dele_1_3').val(null);
					$('#dele_1_4').val(null);
					$('#dele_2_1').val(null);
					$('#dele_2_2').val(null);
					$('#dele_2_3').val(null);
					$('#dele_3_1').val(null);
					$('#dele_3_2').val(null);
					$('#dele_3_3').val(null);
					$('#dele_4_1').val(null);
					$('#dele_4_2').val(null);
					$('#dele_4_3').val(null);
					$('#avg_dtm').val(null);
				}
			});

			//Organic Impurities

			function aoi_auto() {
				$('#txtaoi').css("background-color", "var(--success)");
				var aoi_1 = 75;
				var aoi_2 = 125;
				var aoi_3 = 200;
				var aoi_4 = "Visual Match With Standard Solution, Organic Impurities Not Detected.";
				$('#aoi_1').val(aoi_1);
				$('#aoi_2').val(aoi_2);
				$('#aoi_3').val(aoi_3);
				$('#aoi_4').val(aoi_4);

			}


			$('#chk_aoi').change(function() {
				if (this.checked) {
					aoi_auto();
				} else {
					$('#txtaoi').css("background-color", "#fff");
					$('#avg_org').val(null);
				}
			});
			
				




			$('#chk_auto').change(function() {
				if (this.checked) {
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

					//den
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "den") {
							$('#txtden').css("background-color", "var(--success)");
							$("#chk_den").prop("checked", true);
							den_auto();
							break;
						}
					}
					//pha
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "pha") {
							$('#txtpha').css("background-color", "var(--success)");
							$("#chk_pha").prop("checked", true);
							pha_auto();
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

					//Organic Impurities
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "aoi") {
							$("#chk_aoi").prop("checked", true);
							aoi_auto();
							break;
						}
					}

					//clr
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "clr") {
							$('#txtclr').css("background-color", "var(--success)");
							$("#chk_clr").prop("checked", true);
							clr_auto();
							break;
						}
					}

					//slp
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "slp") {
							$('#txtslp').css("background-color", "var(--success)");
							$("#chk_slp").prop("checked", true);
							slp_auto();
							break;
						}
					}
					//dtm
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "dtm") {
							$('#txtdtm').css("background-color", "var(--success)");
							$("#chk_dtm").prop("checked", true);
							dtm_auto();
							break;
						}
					}
					//lll
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "lll") {
							$('#txtlll').css("background-color", "var(--success)");
							$("#chk_ll").prop("checked", true);
							lll_auto();
							break;
						}
					}

					//cru
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "cru") {
							$('#txtcru').css("background-color", "var(--success)");
							$("#chk_crushing").prop("checked", true);
							crush_auto();
							break;
						}
					}

					//alk
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "alk") {
							$('#txtalk').css("background-color", "var(--success)");
							$("#chk_alkali").prop("checked", true);
							alk_auto();
							break;
						}
					}

					//fine
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "fin") {
							$('#txtfin').css("background-color", "var(--success)");
							$("#chk_fines").prop("checked", true);
							fine_auto();
							break;
						}
					}

					//imp
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "imp") {
							$('#txtimp').css("background-color", "var(--success)");
							$("#chk_impact").prop("checked", true);
							imp_auto();
							break;
						}
					}

					//flk
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "flk") {
							$('#txtflk').css("background-color", "var(--success)");
							$("#chk_flk").prop("checked", true);
							flk_auto();
							break;
						}
					}

					//sou
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "sou") {
							$('#txtsou').css("background-color", "var(--success)");
							$("#chk_sou").prop("checked", true);
							sou_auto();
							break;
						}
					}

					//wtr&sp
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "wtr") {
							$('#txtwtr').css("background-color", "var(--success)");
							$("#chk_sp").prop("checked", true);
							sp_auto();
							break;
						}
					}

					//abr
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "abr") {
							$('#txtabr').css("background-color", "var(--success)");
							$("#chk_abr").prop("checked", true);
							abr_auto();
							break;
						}
					}

					//cbr
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "cbr") {
							$('#txtcbr').css("background-color", "var(--success)");
							$("#chk_cbr").prop("checked", true);
							cbr_auto();
							break;
						}
					}

					//omc
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "omc") {
							$('#txtomc').css("background-color", "var(--success)");
							$("#chk_omc").prop("checked", true);
							omc_auto();
							break;
						}
					}

					//mdd
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "mdd") {
							$('#txtmdd').css("background-color", "var(--success)");
							$("#chk_mdd").prop("checked", true);
							mdd_auto();
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
				url: '<?php echo $base_url; ?>save_20.php',
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

				//GRADATION
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "grd") {
						if (document.getElementById('chk_grd').checked) {
							var chk_grd = "1";
						} else {
							var chk_grd = "0";
						}
						var sieve_1 = "40";
						var sieve_2 = "20";
						var sieve_3 = "10";
						var sieve_4 = "4.75";
						var sample_taken = $('#sample_taken').val();
						var blank_extra = $('#blank_extra').val();
						var blank_extra1 = $('#blank_extra1').val();
						var blank_extra2 = $('#blank_extra2').val();
						var blank_extra3 = $('#blank_extra3').val();

						var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
						var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
						var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
						var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
						var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
						var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
						var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
						var cum_wt_gm_8 = $('#cum_wt_gm_8').val();
						var cum_wt_gm_9 = $('#cum_wt_gm_9').val();
						var cum_wt_gm_10 = $('#cum_wt_gm_10').val();
						var cum_wt_gm_11 = $('#cum_wt_gm_11').val();
						var cum_wt_gm_12 = $('#cum_wt_gm_12').val();
						var cum_wt_gm_13 = $('#cum_wt_gm_13').val();

						var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
						var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
						var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
						var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
						var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
						var ret_wt_gm_6 = $('#ret_wt_gm_6').val();
						var ret_wt_gm_7 = $('#ret_wt_gm_7').val();
						var ret_wt_gm_8 = $('#ret_wt_gm_8').val();
						var ret_wt_gm_9 = $('#ret_wt_gm_9').val();
						var ret_wt_gm_10 = $('#ret_wt_gm_10').val();
						var ret_wt_gm_11 = $('#ret_wt_gm_11').val();
						var ret_wt_gm_12 = $('#ret_wt_gm_12').val();
						var ret_wt_gm_13 = $('#ret_wt_gm_13').val();

						var cum_ret_1 = $('#cum_ret_1').val();
						var cum_ret_2 = $('#cum_ret_2').val();
						var cum_ret_3 = $('#cum_ret_3').val();
						var cum_ret_4 = $('#cum_ret_4').val();
						var cum_ret_5 = $('#cum_ret_5').val();
						var cum_ret_6 = $('#cum_ret_6').val();
						var cum_ret_7 = $('#cum_ret_7').val();
						var cum_ret_8 = $('#cum_ret_8').val();
						var cum_ret_9 = $('#cum_ret_9').val();
						var cum_ret_10 = $('#cum_ret_10').val();
						var cum_ret_11 = $('#cum_ret_11').val();
						var cum_ret_12 = $('#cum_ret_12').val();
						var cum_ret_13 = $('#cum_ret_13').val();


						var pass_sample_1 = $('#pass_sample_1').val();
						var pass_sample_2 = $('#pass_sample_2').val();
						var pass_sample_3 = $('#pass_sample_3').val();
						var pass_sample_4 = $('#pass_sample_4').val();
						var pass_sample_5 = $('#pass_sample_5').val();
						var pass_sample_6 = $('#pass_sample_6').val();
						var pass_sample_7 = $('#pass_sample_7').val();
						var pass_sample_8 = $('#pass_sample_8').val();
						var pass_sample_9 = $('#pass_sample_9').val();
						var pass_sample_10 = $('#pass_sample_10').val();
						var pass_sample_11 = $('#pass_sample_11').val();
						var pass_sample_12 = $('#pass_sample_12').val();
						var pass_sample_13 = $('#pass_sample_13').val();


						break;
					} else {
						var chk_grd = "0";
						var cum_wt_gm_1 = "0";
						var cum_wt_gm_2 = "0";
						var cum_wt_gm_3 = "0";
						var cum_wt_gm_4 = "0";
						var cum_wt_gm_5 = "0";
						var cum_wt_gm_6 = "0";
						var cum_wt_gm_7 = "0";
						var cum_wt_gm_8 = "0";
						var cum_wt_gm_9 = "0";
						var cum_wt_gm_10 = "0";
						var cum_wt_gm_11 = "0";
						var cum_wt_gm_12 = "0";
						var cum_wt_gm_13 = "0";

						var ret_wt_gm_1 = "0";
						var ret_wt_gm_2 = "0";
						var ret_wt_gm_3 = "0";
						var ret_wt_gm_4 = "0";
						var ret_wt_gm_5 = "0";
						var ret_wt_gm_6 = "0";
						var ret_wt_gm_7 = "0";
						var ret_wt_gm_8 = "0";
						var ret_wt_gm_9 = "0";
						var ret_wt_gm_10 = "0";
						var ret_wt_gm_11 = "0";
						var ret_wt_gm_12 = "0";
						var ret_wt_gm_13 = "0";

						var cum_ret_1 = "0";
						var cum_ret_2 = "0";
						var cum_ret_3 = "0";
						var cum_ret_4 = "0";
						var cum_ret_5 = "0";
						var cum_ret_6 = "0";
						var cum_ret_7 = "0";
						var cum_ret_8 = "0";
						var cum_ret_9 = "0";
						var cum_ret_10 = "0";
						var cum_ret_11 = "0";
						var cum_ret_12 = "0";
						var cum_ret_13 = "0";

						var pass_sample_1 = "0";
						var pass_sample_2 = "0";
						var pass_sample_3 = "0";
						var pass_sample_4 = "0";
						var pass_sample_5 = "0";
						var pass_sample_6 = "0";
						var pass_sample_7 = "0";
						var pass_sample_8 = "0";
						var pass_sample_9 = "0";
						var pass_sample_10 = "0";
						var pass_sample_11 = "0";
						var pass_sample_12 = "0";
						var pass_sample_13 = "0";

						var blank_extra = "0";
						var blank_extra1 = "0";
						var blank_extra2 = "0";
						var blank_extra3 = "0";
						var sample_taken = "0";
					}

				}

				//IMPACT
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "imp") {

						if (document.getElementById('chk_impact').checked) {
							var chk_impact = "1";
						} else {
							var chk_impact = "0";
						}
						//impact value-3
						var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
						var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
						var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
						var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
						var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
						var imp_w_m_c_2 = $('#imp_w_m_c_2').val();
						var imp_value_1 = $('#imp_value_1').val();
						var imp_value_2 = $('#imp_value_2').val();
						var imp_value = $('#imp_value').val();
						break;
					} else {
						var chk_impact = "0";
						var imp_value = "0";
						var imp_value_1 = "0";
						var imp_value_2 = "0";
						var imp_w_m_a_1 = "0";
						var imp_w_m_b_1 = "0";
						var imp_w_m_c_1 = "0";
						var imp_w_m_a_2 = "0";
						var imp_w_m_b_2 = "0";
						var imp_w_m_c_2 = "0";

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
						var m31 = $('#m31').val();
						var m32 = $('#m32').val();
						var m33 = $('#m33').val();
						var avg_wom = $('#avg_wom').val();
						var avg_wom1 = $('#avg_wom').val();
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
						var m31 = "0";
						var m32 = "0";
						var m33 = "0";
						var avg_wom = "0";
						var avg_wom1 = "0";
						var vol = "0";
						var bdl = "0";
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
						var sp_w_sur_3 = $('#sp_w_sur_3').val();
						var sp_w_sur_4 = $('#sp_w_sur_4').val();
						var sp_w_sur_5 = $('#sp_w_sur_5').val();
						var sp_w_sur_6 = $('#sp_w_sur_6').val();
						var sp_w_s_1 = $('#sp_w_s_1').val();
						var sp_w_s_2 = $('#sp_w_s_2').val();
						var sp_w_s_3 = $('#sp_w_s_3').val();
						var sp_w_s_4 = $('#sp_w_s_4').val();
						var sp_w_s_5 = $('#sp_w_s_5').val();
						var sp_w_s_6 = $('#sp_w_s_6').val();
						var sp_wt_st_1 = $('#sp_wt_st_1').val();
						var sp_wt_st_2 = $('#sp_wt_st_2').val();
						var sp_wt_st_3 = $('#sp_wt_st_3').val();
						var sp_wt_st_4 = $('#sp_wt_st_4').val();
						var sp_wt_st_5 = $('#sp_wt_st_5').val();
						var sp_wt_st_6 = $('#sp_wt_st_6').val();
						var taken_1 = $('#taken_1').val();
						var taken_2 = $('#taken_2').val();
						var sp_agg1 = $('#sp_agg1').val();
						var sp_agg2 = $('#sp_agg2').val();
						var sp_agg3 = $('#sp_agg3').val();
						var sp_agg4 = $('#sp_agg4').val();
						var sp_agg5 = $('#sp_agg5').val();
						var sp_agg6 = $('#sp_agg6').val();
						var sp_wat1 = $('#sp_wat1').val();
						var sp_wat2 = $('#sp_wat2').val();
						var sp_wat3 = $('#sp_wat3').val();
						var sp_wat4 = $('#sp_wat4').val();
						var sp_wat5 = $('#sp_wat5').val();
						var sp_wat6 = $('#sp_wat6').val();
						var sp_specific_gravity_b2 = $('#sp_specific_gravity_b2').val();
						var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
						var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
						var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();
						var sp_specific_gravity = $('#sp_specific_gravity').val();
						var sp_specific_gravity_a_1 = $('#sp_specific_gravity_a_1').val();
						var sp_specific_gravity_a_2 = $('#sp_specific_gravity_a_2').val();
						var sp_specific_gravity_a_3 = $('#sp_specific_gravity_a_3').val();
						var sp_specific_gravity_a_4 = $('#sp_specific_gravity_a_4').val();
						var sp_specific_gravity_a_5 = $('#sp_specific_gravity_a_5').val();
						var sp_specific_gravity_a_6 = $('#sp_specific_gravity_a_6').val();
						var sp_specific_gravity_b_1 = $('#sp_specific_gravity_b_1').val();
						var sp_specific_gravity_b_2 = $('#sp_specific_gravity_b_2').val();
						var sp_specific_gravity_b_3 = $('#sp_specific_gravity_b_3').val();
						var sp_specific_gravity_b_4 = $('#sp_specific_gravity_b_4').val();
						var sp_specific_gravity_b_5 = $('#sp_specific_gravity_b_5').val();
						var sp_specific_gravity_b_6 = $('#sp_specific_gravity_b_6').val();
						var sp_water_abr = $('#sp_water_abr').val();
						var sp_water_abr_1 = $('#sp_water_abr_1').val();
						var sp_water_abr_2 = $('#sp_water_abr_2').val();
						var sp_water_abr_3 = $('#sp_water_abr_3').val();
						var sp_specific_gravity_a = $('#sp_specific_gravity_a').val();
						var sp_specific_gravity_a1 = $('#sp_specific_gravity_a1').val();
						var sp_specific_gravity_a2 = $('#sp_specific_gravity_a2').val();
						var sp_specific_gravity_b = $('#sp_specific_gravity_b').val();
						var sp_specific_gravity_b1 = $('#sp_specific_gravity_b1').val();
						var sp_specific_gravity = $('#sp_specific_gravity').val();
						var sp_specific_gravity1 = $('#sp_specific_gravity1').val();
						var sp_specific_gravity2 = $('#sp_specific_gravity2').val();

						break;
					} else {
						var sp_specific_gravity_a = "0";
						var sp_specific_gravity_a1 = "0";
						var sp_specific_gravity_a2 = "0";
						var sp_specific_gravity_b = "0";
						var sp_specific_gravity_b1 = "0";
						var sp_specific_gravity = "0";
						var sp_specific_gravity1 = "0";
						var sp_specific_gravity2 = "0";
						var chk_sp = "0";
						var sp_w_sur_1 = "0";
						var sp_w_s_1 = "0";
						var sp_wt_st_1 = "0";
						var taken_1 = "0";
						var taken_2 = "0";
						var sp_specific_gravity_a_1 = "0";
						var sp_specific_gravity_a_2 = "0";
						var sp_specific_gravity_a_3 = "0";
						var sp_specific_gravity_a_4 = "0";
						var sp_specific_gravity_a_5 = "0";
						var sp_specific_gravity_a_6 = "0";
						var sp_specific_gravity_b_1 = "0";
						var sp_specific_gravity_b_2 = "0";
						var sp_specific_gravity_b_3 = "0";
						var sp_specific_gravity_b_4 = "0";
						var sp_specific_gravity_b_5 = "0";
						var sp_specific_gravity_b_6 = "0";
						var sp_wt_agg_1 = "0";
						var sp_wt_wat_1 = "0";
						var sp_w_sur_2 = "0";
						var sp_w_s_2 = "0";
						var sp_wt_st_2 = "0";
						var sp_w_sur_3 = "0";
						var sp_w_sur_4 = "0";
						var sp_w_sur_5 = "0";
						var sp_w_sur_6 = "0";
						var sp_w_s_3 = "0";
						var sp_w_s_4 = "0";
						var sp_w_s_5 = "0";
						var sp_w_s_6 = "0";
						var sp_wt_st_3 = "0";
						var sp_wt_st_4 = "0";
						var sp_wt_st_5 = "0";
						var sp_wt_st_6 = "0";
						var sp_agg1 = "0";
						var sp_agg2 = "0";
						var sp_agg3 = "0";
						var sp_agg4 = "0";
						var sp_agg5 = "0";
						var sp_agg6 = "0";
						var sp_wat1 = "0";
						var sp_wat2 = "0";
						var sp_wat3 = "0";
						var sp_wat4 = "0";
						var sp_wat5 = "0";
						var sp_wat6 = "0";
						var sp_specific_gravity_b2 = "0";
						var sp_specific_gravity_1 = "0";
						var sp_specific_gravity_2 = "0";
						var sp_specific_gravity_3 = "0";
						var sp_specific_gravity = "0";
						var sp_water_abr_1 = "0";
						var sp_water_abr_2 = "0";
						var sp_water_abr_3 = "0";
						var sp_water_abr = "0";

					}

				}

				//ABRASION VALUE
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "abr") {
						if (document.getElementById('chk_abr').checked) {
							var chk_abr = "1";
						} else {
							var chk_abr = "0";
						}
						//Abrasion-2
						var abr_index = $('#abr_index').val();
						var abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
						var abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
						var abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
						var abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();
						var abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
						var abr_wt_t_c_2 = $('#abr_wt_t_c_2').val();
						var abr_1 = $('#abr_1').val();
						var abr_2 = $('#abr_2').val();
						var abr_grading = $('#abr_grading').val();
						var abr_num_revo = $('#abr_num_revo').val();
						var abr_weight_charge = $('#abr_weight_charge').val();
						var abr_sphere = $('#abr_sphere').val();
						break;
					} else {
						var chk_abr = "0";
						var abr_wt_t_a_1 = "0";
						var abr_wt_t_b_1 = "0";
						var abr_wt_t_c_1 = "0";
						var abr_wt_t_a_2 = "0";
						var abr_wt_t_b_2 = "0";
						var abr_grading = "0";
						var abr_wt_t_c_2 = "0";
						var abr_1 = "0";
						var abr_2 = "0";
						var abr_index = "0";
						var abr_sphere = "0";
						var abr_num_revo = "0";
						var abr_weight_charge = "0";
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


						var s31 = $('#s31').val();
						var s32 = $('#s32').val();
						var s33 = $('#s33').val();
						var s34 = $('#s34').val();
						var s35 = $('#s35').val();
						var s36 = $('#s36').val();
						var s37 = $('#s37').val();
						var s38 = $('#s38').val();
						var s39 = $('#s39').val();
						var s30 = $('#s30').val();
						var s41 = $('#s41').val();
						var s42 = $('#s42').val();
						var s43 = $('#s43').val();
						var s44 = $('#s44').val();
						var s45 = $('#s45').val();
						var s46 = $('#s46').val();
						var s47 = $('#s47').val();
						var s48 = $('#s48').val();
						var s49 = $('#s49').val();
						var s40 = $('#s40').val();
						var s51 = $('#s51').val();
						var s52 = $('#s52').val();
						var s53 = $('#s53').val();
						var s54 = $('#s54').val();
						var s55 = $('#s55').val();
						var s56 = $('#s56').val();
						var s57 = $('#s57').val();
						var s58 = $('#s58').val();
						var s59 = $('#s59').val();
						var s50 = $('#s50').val();
						var s61 = $('#s61').val();
						var s62 = $('#s62').val();
						var s63 = $('#s63').val();
						var s64 = $('#s64').val();
						var s65 = $('#s65').val();
						var s66 = $('#s66').val();
						var s67 = $('#s67').val();
						var s68 = $('#s68').val();
						var s69 = $('#s69').val();
						var s60 = $('#s60').val();
						var s6total = $('#s6total').val();
						var soundness = $('#soundness').val();


						break;
					} else {
						var chk_sou = "0";
						var s31 = "0";
						var s32 = "0";
						var s33 = "0";
						var s34 = "0";
						var s35 = "0";
						var s36 = "0";
						var s37 = "0";
						var s38 = "0";
						var s39 = "0";
						var s30 = "0";
						var s41 = "0";
						var s42 = "0";
						var s43 = "0";
						var s44 = "0";
						var s45 = "0";
						var s46 = "0";
						var s47 = "0";
						var s48 = "0";
						var s49 = "0";
						var s40 = "0";
						var s51 = "0";
						var s52 = "0";
						var s53 = "0";
						var s54 = "0";
						var s55 = "0";
						var s56 = "0";
						var s57 = "0";
						var s58 = "0";
						var s59 = "0";
						var s50 = "0";
						var s61 = "0";
						var s62 = "0";
						var s63 = "0";
						var s64 = "0";
						var s65 = "0";
						var s66 = "0";
						var s67 = "0";
						var s68 = "0";
						var s69 = "0";
						var s60 = "0";
						var s6total = "0";
						var soundness = "0";
					}

				}

				//FLAKINESS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "flk") {

						if (document.getElementById('chk_flk').checked) {
							var chk_flk = "1";
						} else {
							var chk_flk = "0";

						}
						//Flakiness INDEX

						var ei_index = $('#ei_index').val();
						var fi_index = $('#fi_index').val();
						var combined_index = $('#combined_index').val();
						var a1 = $('#a1').val();
						var a2 = $('#a2').val();
						var a3 = $('#a3').val();
						var a4 = $('#a4').val();
						var a5 = $('#a5').val();
						var a6 = $('#a6').val();
						var a7 = $('#a7').val();
						var a8 = $('#a8').val();
						var a9 = $('#a9').val();
						var suma = $('#suma').val();

						var b1 = $('#b1').val();
						var b2 = $('#b2').val();
						var b3 = $('#b3').val();
						var b4 = $('#b4').val();
						var b5 = $('#b5').val();
						var b6 = $('#b6').val();
						var b7 = $('#b7').val();
						var b8 = $('#b8').val();
						var b9 = $('#b9').val();
						var sumb = $('#sumb').val();


						var aa1 = $('#aa1').val();
						var aa2 = $('#aa2').val();
						var aa3 = $('#aa3').val();
						var aa4 = $('#aa4').val();
						var aa5 = $('#aa5').val();
						var aa6 = $('#aa6').val();
						var aa7 = $('#aa7').val();
						var aa8 = $('#aa8').val();
						var aa9 = $('#aa9').val();
						var sumaa = $('#sumaa').val();

						var dd1 = $('#dd1').val();
						var dd2 = $('#dd2').val();
						var dd3 = $('#dd3').val();
						var dd4 = $('#dd4').val();
						var dd5 = $('#dd5').val();
						var dd6 = $('#dd6').val();
						var dd7 = $('#dd7').val();
						var dd8 = $('#dd8').val();
						var dd9 = $('#dd9').val();
						var sumdd = $('#sumdd').val();

						var x1 = $('#x1').val();
						var x2 = $('#x2').val();
						var x3 = $('#x3').val();
						var x4 = $('#x4').val();
						var x5 = $('#x5').val();
						var x6 = $('#x6').val();
						var x7 = $('#x7').val();
						var x8 = $('#x8').val();
						var x9 = $('#x9').val();
						var sumx = $('#sumx').val();

						var y1 = $('#y1').val();
						var y2 = $('#y2').val();
						var y3 = $('#y3').val();
						var y4 = $('#y4').val();
						var y5 = $('#y5').val();
						var y6 = $('#y6').val();
						var y7 = $('#y7').val();
						var y8 = $('#y8').val();
						var y9 = $('#y9').val();
						var sumy = $('#sumy').val();

						var s11 = $('#s11').val();
						var s12 = $('#s12').val();
						var s13 = $('#s13').val();
						var s14 = $('#s14').val();
						var s15 = $('#s15').val();
						var s16 = $('#s16').val();
						var s17 = $('#s17').val();
						var s18 = $('#s18').val();
						var s19 = $('#s19').val();

						var s1 = $('#s1').val();
						var s2 = $('#s2').val();
						var s3 = $('#s3').val();
						var s4 = $('#s4').val();
						var s5 = $('#s5').val();
						var s6 = $('#s6').val();
						var s7 = $('#s7').val();
						var suma1 = $("#suma1").val();
						var suma2 = $("#suma2").val();


						var m1 = $('#m1').val();
						var m2 = $('#m2').val();
						var m3 = $('#m3').val();
						var m4 = $('#m4').val();
						var m5 = $('#m5').val();
						var m6 = $('#m6').val();
						var m7 = $('#m7').val();

						var p1 = $('#p1').val();
						var p2 = $('#p2').val();
						var p3 = $('#p3').val();
						var p4 = $('#p4').val();
						var p5 = $('#p5').val();
						var p6 = $('#p6').val();
						var p7 = $('#p7').val();

						var pp1 = $('#pp1').val();
						var pp2 = $('#pp2').val();
						var pp3 = $('#pp3').val();
						var pp4 = $('#pp4').val();
						var pp5 = $('#pp5').val();
						var pp6 = $('#pp6').val();
						var pp7 = $('#pp7').val();

						var w1 = $('#w1').val();
						var w2 = $('#w2').val();
						var w3 = $('#w3').val();
						var w4 = $('#w4').val();
						var w5 = $('#w5').val();
						var w6 = $('#w6').val();
						var w7 = $('#w7').val();
						var sumdd1 = $("#sumdd1").val();
						var fi_index1 = $("#fi_index1").val();

						break;
					} else {
						var chk_flk = "0";
						var fi_index = "0";
						var ei_index = "0";
						var combined_index = "0";

						var a1 = "0";
						var a2 = "0";
						var a3 = "0";
						var a4 = "0";
						var a5 = "0";
						var a6 = "0";
						var a7 = "0";
						var a8 = "0";
						var a9 = "0";
						var suma = "0";

						var b1 = "0";
						var b2 = "0";
						var b3 = "0";
						var b4 = "0";
						var b5 = "0";
						var b6 = "0";
						var b7 = "0";
						var b8 = "0";
						var b9 = "0";
						var sumb = "0";

						var aa1 = "0";
						var aa2 = "0";
						var aa3 = "0";
						var aa4 = "0";
						var aa5 = "0";
						var aa6 = "0";
						var aa7 = "0";
						var aa8 = "0";
						var aa9 = "0";
						var sumaa = "0";


						var dd1 = "0";
						var dd2 = "0";
						var dd3 = "0";
						var dd4 = "0";
						var dd5 = "0";
						var dd6 = "0";
						var dd7 = "0";
						var dd8 = "0";
						var dd9 = "0";
						var sumdd = "0";

						var x1 = "0";
						var x2 = "0";
						var x3 = "0";
						var x4 = "0";
						var x5 = "0";
						var x6 = "0";
						var x7 = "0";
						var x8 = "0";
						var x9 = "0";
						var sumx = "0";

						var y1 = "0";
						var y2 = "0";
						var y3 = "0";
						var y4 = "0";
						var y5 = "0";
						var y6 = "0";
						var y7 = "0";
						var y8 = "0";
						var y9 = "0";
						var sumy = "0";

						var s11 = "";
						var s12 = "";
						var s13 = "";
						var s14 = "";
						var s15 = "";
						var s16 = "";
						var s17 = "";
						var s18 = "";
						var s19 = "";

						var s1 = "";
						var s2 = "";
						var s3 = "";
						var s4 = "";
						var s5 = "";
						var s6 = "";
						var s7 = "";

						var m1 = "";
						var m2 = "";
						var m3 = "";
						var m4 = "";
						var m5 = "";
						var m6 = "";
						var m7 = "";

						var p1 = "";
						var p2 = "";
						var p3 = "";
						var p4 = "";
						var p5 = "";
						var p6 = "";
						var p7 = "";

						var p1 = "";
						var p2 = "";
						var pp3 = "";
						var pp4 = "";
						var pp5 = "";
						var pp6 = "";
						var pp7 = "";

						var w1 = "";
						var w2 = "";
						var w3 = "";
						var w4 = "";
						var w5 = "";
						var w6 = "";
						var w7 = "";


						var sumdd1 = "";
						var fi_index1 = "";
					}

				}


				//FINEVALUES
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "fin") {
						if (document.getElementById('chk_fines').checked) {
							var chk_fines = "1";
						} else {
							var chk_fines = "0";
						}
						//alkali strip and fines_value
						var fines_value = $('#fines_value').val();
						var f_a_1 = $('#f_a_1').val();
						var f_a_2 = $('#f_a_2').val();
						var f_b_1 = $('#f_b_1').val();
						var f_b_2 = $('#f_b_2').val();
						var f_c_1 = $('#f_c_1').val();
						var f_c_2 = $('#f_c_2').val();
						var f_d_1 = $('#f_d_1').val();
						var f_d_2 = $('#f_d_2').val();
						var avg_f_d = $('#avg_f_d').val();
						var avg_f_c = $('#avg_f_c').val();
						break;
					} else {
						var chk_fines = "0";
						var fines_value = "0";
						var f_a_1 = "0";
						var f_a_2 = "0";
						var f_b_1 = "0";
						var f_b_2 = "0";
						var f_c_1 = "0";
						var f_c_2 = "0";
						var f_d_1 = "0";
						var f_d_2 = "0";
						var avg_f_d = "0";
						var avg_f_c = "0";
					}
				}
				
			
				

				//ALKALI REACTION
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "alk") {
						if (document.getElementById('chk_alkali').checked) {
							var chk_alkali = "1";
						} else {
							var chk_alkali = "0";
						}
						var alk_1 = $('#alk_1').val();
						var alk_2 = $('#alk_2').val();
						var alk_3 = $('#alk_3').val();
						var alk_4 = $('#alk_4').val();
						var alk_5 = $('#alk_5').val();
						var alk_6 = $('#alk_6').val();
						var alk_7 = $('#alk_7').val();
						var alk_8 = $('#alk_8').val();
						var alk_9 = $('#alk_9').val();
						var alk_10 = $('#alk_10').val();
						var alk_11 = $('#alk_11').val();
						break;
					} else {
						var chk_alkali = "0";
						var alk_1 = "0";
						var alk_2 = "0";
						var alk_3 = "0";
						var alk_4 = "0";
						var alk_5 = "0";
						var alk_6 = "0";
						var alk_7 = "0";
						var alk_8 = "0";
						var alk_9 = "0";
						var alk_10 = "0";
						var alk_11 = "0";
					}
				}

				//CRUSHING
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "cru") {
						if (document.getElementById('chk_crushing').checked) {
							var chk_crushing = "1";
						} else {
							var chk_crushing = "0";
						}
						//crushing value-4

						var cru_value = $('#cru_value').val();
						var cru_value_1 = $('#cru_value_1').val();
						var cru_value_2 = $('#cru_value_2').val();
						var cr_a_1 = $('#cr_a_1').val();
						var cr_a_2 = $('#cr_a_2').val();
						var cr_b_1 = $('#cr_b_1').val();
						var cr_b_2 = $('#cr_b_2').val();

						break;
					} else {
						var chk_crushing = "0";
						var cru_value = "0";
						var cru_value_1 = "0";
						var cr_a_1 = "0";
						var cr_a_2 = "0";
						var cr_b_1 = "0";
						var cru_value_2 = "0";
						var cr_b_2 = "0";

					}
				}


				//LIQUIDE LIMIT AND PLASTICITY VALUE
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "lll") { //ll and pl
						if (document.getElementById('chk_ll').checked) {
							var chk_ll = "1";
						} else {
							var chk_ll = "0";
						}

						var pen1 = $('#pen1').val();
						var pen2 = $('#pen2').val();
						var pen3 = $('#pen3').val();
						var pen4 = $('#pen4').val();

						var cont1 = $('#cont1').val();
						var cont2 = $('#cont2').val();
						var cont3 = $('#cont3').val();
						var cont4 = $('#cont4').val();

						var wc1 = $('#wc1').val();
						var wc2 = $('#wc2').val();
						var wc3 = $('#wc3').val();
						var wc4 = $('#wc4').val();

						var od1 = $('#od1').val();
						var od2 = $('#od2').val();
						var od3 = $('#od3').val();
						var od4 = $('#od4').val();

						var ww1 = $('#ww1').val();
						var ww2 = $('#ww2').val();
						var ww3 = $('#ww3').val();
						var ww4 = $('#ww4').val();

						var wf1 = $('#wf1').val();
						var wf2 = $('#wf2').val();
						var wf3 = $('#wf3').val();
						var wf4 = $('#wf4').val();

						var ds1 = $('#ds1').val();
						var ds2 = $('#ds2').val();
						var ds3 = $('#ds3').val();
						var ds4 = $('#ds4').val();

						var mo1 = $('#mo1').val();
						var mo2 = $('#mo2').val();
						var mo3 = $('#mo3').val();
						var mo4 = $('#mo4').val();

						var ln1 = $('#ln1').val();
						var ln2 = $('#ln2').val();
						var ln3 = $('#ln3').val();
						var ln4 = $('#ln4').val();


						var plastic_limit = $('#plastic_limit').val();
						var pi_value = $('#pi_value').val();
						var liquide_limit = $('#liquide_limit').val();
						var avg_ll = $('#avg_ll').val();
						var avg_pl = $('#avg_pl').val();

						break;
					} else {
						var chk_ll = "0";
						var pen1 = "0";
						var pen2 = "0";
						var pen3 = "0";
						var pen4 = "0";


						var cont1 = "0";
						var cont2 = "0";
						var cont3 = "0";
						var cont4 = "0";

						var wc1 = "0";
						var wc2 = "0";
						var wc3 = "0";
						var wc4 = "0";

						var od1 = "0";
						var od2 = "0";
						var od3 = "0";
						var od4 = "0";

						var ww1 = "0";
						var ww2 = "0";
						var ww3 = "0";
						var ww4 = "0";

						var wf1 = "0";
						var wf2 = "0";
						var wf3 = "0";
						var wf4 = "0";

						var ds1 = "0";
						var ds2 = "0";
						var ds3 = "0";
						var ds4 = "0";

						var mo1 = "0";
						var mo2 = "0";
						var mo3 = "0";
						var mo4 = "0";

						var ln1 = "0";
						var ln2 = "0";
						var ln3 = "0";
						var ln4 = "0";

						var plastic_limit = "0";
						var pi_value = "0";
						var liquide_limit = "0";
						var avg_ll = "0";
						var avg_pl = "0";

					}

				}

				//Ph
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "pha") {
						if (document.getElementById('chk_pha').checked) {
							var chk_pha = "1";
						} else {
							var chk_pha = "0";
						}

						var ph_s1_1 = $('#ph_s1_1').val();
						var ph_s1_2 = $('#ph_s1_2').val();
						var ph_s2_1 = $('#ph_s2_1').val();
						var ph_s2_2 = $('#ph_s2_2').val();
						var avg_ph = $('#avg_ph').val();
						break;
					} else {
						var chk_pha = "0";
						var ph_s1_1 = "0";
						var ph_s1_2 = "0";
						var ph_s2_1 = "0";
						var ph_s2_2 = "0";
						var avg_ph = "0";
					}
				}

				//CLR
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "clr") {
						if (document.getElementById('chk_clr').checked) {
							var chk_clr = "1";
						} else {
							var chk_clr = "0";
						}

						var clr_s1_1 = $('#clr_s1_1').val();
						var clr_s1_2 = $('#clr_s1_2').val();
						var clr_s1_3 = $('#clr_s1_3').val();
						var clr_s1_4 = $('#clr_s1_4').val();
						var clr_s1_5 = $('#clr_s1_5').val();
						var clr_s1_6 = $('#clr_s1_6').val();
						var clr_s1_7 = $('#clr_s1_7').val();
						var clr_s2_1 = $('#clr_s1_1').val();
						var clr_s2_2 = $('#clr_s1_2').val();
						var clr_s2_3 = $('#clr_s1_3').val();
						var clr_s2_4 = $('#clr_s1_4').val();
						var clr_s2_5 = $('#clr_s1_5').val();
						var clr_s2_6 = $('#clr_s1_6').val();
						var clr_s2_7 = $('#clr_s1_7').val();
						var avg_clr = $('#av_clr').val();
						break;
					} else {
						var chk_clr = "0";
						var clr_s1_1 = "0";
						var clr_s1_2 = "0";
						var clr_s1_3 = "0";
						var clr_s1_4 = "0";
						var clr_s1_5 = "0";
						var clr_s1_6 = "0";
						var clr_s1_7 = "0";
						var clr_s2_1 = "0";
						var clr_s2_2 = "0";
						var clr_s2_3 = "0";
						var clr_s2_4 = "0";
						var clr_s2_5 = "0";
						var clr_s2_6 = "0";
						var clr_s2_7 = "0";
						var avg_clr = "0";
					}
				}

				//SLP
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "slp") {
						if (document.getElementById('chk_slp').checked) {
							var chk_slp = "1";
						} else {
							var chk_slp = "0";
						}

						var slp_s1_1 = $('#slp_s1_1').val();
						var slp_s1_2 = $('#slp_s1_2').val();
						var slp_s1_3 = $('#slp_s1_3').val();
						var slp_s1_4 = $('#slp_s1_4').val();
						var slp_s1_5 = $('#slp_s1_5').val();
						var slp_s2_1 = $('#slp_s1_1').val();
						var slp_s2_2 = $('#slp_s1_2').val();
						var slp_s2_3 = $('#slp_s1_3').val();
						var slp_s2_4 = $('#slp_s1_4').val();
						var slp_s2_5 = $('#slp_s1_5').val();
						var avg_sul = $('#avg_sul').val();
						break;
					} else {
						var chk_slp = "0";
						var slp_s1_1 = "0";
						var slp_s1_2 = "0";
						var slp_s1_3 = "0";
						var slp_s1_4 = "0";
						var slp_s1_5 = "0";
						var slp_s2_1 = "0";
						var slp_s2_2 = "0";
						var slp_s2_3 = "0";
						var slp_s2_4 = "0";
						var slp_s2_5 = "0";
						var avg_sul = "0";
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


				//aoi
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "aoi") {
						if (document.getElementById('chk_aoi').checked) {
							var chk_aoi = "1";
						} else {
							var chk_aoi = "0";
						}

						var aoi_1 = $('#aoi_1').val();
						var aoi_2 = $('#aoi_2').val();
						var aoi_3 = $('#aoi_3').val();
						var aoi_4 = $('#aoi_4').val();

						break;
					} else {
						var chk_aoi = "0";
						var aoi_1 = "0";
						var aoi_2 = "0";
						var aoi_3 = "0";
						var aoi_4 = "0";

					}
				}



				billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_sou=' + chk_sou + '&s6total=' + s6total + '&soundness=' + soundness + '&s31=' + s31 + '&s32=' + s32 + '&s33=' + s33 + '&s34=' + s34 + '&s35=' + s35 + '&s36=' + s36 + '&s37=' + s37 + '&s38=' + s38 + '&s39=' + s39 + '&s30=' + s30 + '&s41=' + s41 + '&s42=' + s42 + '&s43=' + s43 + '&s44=' + s44 + '&s45=' + s45 + '&s46=' + s46 + '&s47=' + s47 + '&s48=' + s48 + '&s49=' + s49 + '&s40=' + s40 + '&s51=' + s51 + '&s52=' + s52 + '&s53=' + s53 + '&s54=' + s54 + '&s55=' + s55 + '&s56=' + s56 + '&s57=' + s57 + '&s58=' + s58 + '&s59=' + s59 + '&s50=' + s50 + '&s61=' + s61 + '&s62=' + s62 + '&s63=' + s63 + '&s64=' + s64 + '&s65=' + s65 + '&s66=' + s66 + '&s67=' + s67 + '&s68=' + s68 + '&s69=' + s69 + '&s60=' + s60 + '&chk_sp=' + chk_sp + '&sp_w_sur_1=' + sp_w_sur_1 + '&sp_w_sur_2=' + sp_w_sur_2 + '&sp_w_sur_3=' + sp_w_sur_3 + '&sp_w_sur_4=' + sp_w_sur_4 + '&sp_w_sur_5=' + sp_w_sur_5 + '&sp_w_sur_6=' + sp_w_sur_6 + +'&sp_w_s_1=' + sp_w_s_1 + '&sp_w_s_2=' + sp_w_s_2 + '&sp_w_s_3=' + sp_w_s_3 + '&sp_w_s_4=' + sp_w_s_4 + '&sp_w_s_5=' + sp_w_s_5 + '&sp_w_s_6=' + sp_w_s_6 + '&taken_1=' + taken_1 + '&taken_2=' + taken_2 + '&sp_wt_st_1=' + sp_wt_st_1 + '&sp_wt_st_2=' + sp_wt_st_2 + '&sp_wt_st_3=' + sp_wt_st_3 + '&sp_wt_st_4=' + sp_wt_st_4 + '&sp_wt_st_5=' + sp_wt_st_5 + '&sp_wt_st_6=' + sp_wt_st_6 + '&sp_agg1=' + sp_agg1 + '&sp_agg2=' + sp_agg2 + '&sp_agg3=' + sp_agg3 + '&sp_agg4=' + sp_agg4 + '&sp_agg5=' + sp_agg5 + '&sp_agg6=' + sp_agg6 + '&sp_wat1=' + sp_wat1 + '&sp_wat2=' + sp_wat2 + '&sp_wat3=' + sp_wat3 + '&sp_wat4=' + sp_wat4 + '&sp_wat5=' + sp_wat5 + '&sp_wat6=' + sp_wat6 + '&sp_specific_gravity=' + sp_specific_gravity + '&sp_specific_gravity_1=' + sp_specific_gravity_1 + '&sp_specific_gravity_2=' + sp_specific_gravity_2 + '&sp_specific_gravity_3=' + sp_specific_gravity_3 + '&sp_water_abr=' + sp_water_abr + '&sp_water_abr_1=' + sp_water_abr_1 + '&sp_water_abr_2=' + sp_water_abr_2 + '&sp_water_abr_3=' + sp_water_abr_3 + '&chk_abr=' + chk_abr + '&abr_index=' + abr_index + '&abr_wt_t_a_1=' + abr_wt_t_a_1 + '&abr_wt_t_a_2=' + abr_wt_t_a_2 + '&abr_wt_t_b_1=' + abr_wt_t_b_1 + '&abr_wt_t_b_2=' + abr_wt_t_b_2 + '&abr_wt_t_c_1=' + abr_wt_t_c_1 + '&abr_wt_t_c_2=' + abr_wt_t_c_2 + '&abr_1=' + abr_1 + '&abr_2=' + abr_2 + '&abr_grading=' + abr_grading + '&abr_weight_charge=' + abr_weight_charge + '&abr_sphere=' + abr_sphere + '&abr_num_revo=' + abr_num_revo + '&chk_alkali=' + chk_alkali + '&alk_1=' + alk_1 + '&alk_2=' + alk_2 + '&alk_3=' + alk_3 + '&alk_4=' + alk_4 + '&alk_5=' + alk_5 + '&alk_6=' + alk_6 + '&alk_7=' + alk_7 + '&alk_8=' + alk_8 + '&alk_9=' + alk_9 + '&alk_10=' + alk_10 + '&alk_11=' + alk_11 + '&chk_den=' + chk_den + '&m11=' + m11 + '&m12=' + m12 + '&m13=' + m13 + '&m21=' + m21 + '&m22=' + m22 + '&m23=' + m23 + '&m31=' + m31 + '&m32=' + m32 + '&m33=' + m33 + '&avg_wom=' + avg_wom + '&vol=' + vol + '&bdl=' + bdl + '&chk_crushing=' + chk_crushing + '&cru_value=' + cru_value + '&cr_a_1=' + cr_a_1 + '&cr_a_2=' + cr_a_2 + '&cr_b_1=' + cr_b_1 + '&cr_b_2=' + cr_b_2 + '&cru_value_1=' + cru_value_1 + '&cru_value_2=' + cru_value_2 + '&chk_fines=' + chk_fines + '&fines_value=' + fines_value + '&f_a_1=' + f_a_1 + '&f_a_2=' + f_a_2 + '&f_b_1=' + f_b_1 + '&f_b_2=' + f_b_2 + '&f_c_1=' + f_c_1 + '&f_c_2=' + f_c_2 + '&f_d_1=' + f_d_1 + '&f_d_2=' + f_d_2 + '&avg_f_d=' + avg_f_d + '&avg_f_c=' + avg_f_c + '&chk_flk=' + chk_flk + '&fi_index=' + fi_index + '&sp_specific_gravity_b2=' + sp_specific_gravity_b2 + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&a4=' + a4 + '&a5=' + a5 + '&a6=' + a6 + '&a7=' + a7 + '&a8=' + a8 + '&a9=' + a9 + '&s1=' + s1 + '&s2=' + s2 + '&s3=' + s3 + '&s4=' + s4 + '&s5=' + s5 + '&s6=' + s6 + '&s7=' + s7 + '&m1=' + m1 + '&m2=' + m2 + '&m3=' + m3 + '&m4=' + m4 + '&m5=' + m5 + '&m6=' + m6 + '&m7=' + m7 + '&p1=' + p1 + '&p2=' + p2 + '&p3=' + p3 + '&p4=' + p4 + '&p5=' + p5 + '&p6=' + p6 + '&p7=' + p7 + '&pp1=' + pp1 + '&pp2=' + pp2 + '&pp3=' + pp3 + '&pp4=' + pp4 + '&pp5=' + pp5 + '&pp6=' + pp6 + '&pp7=' + pp7 + '&w1=' + w1 + '&w2=' + w2 + '&w3=' + w3 + '&w4=' + w4 + '&w5=' + w5 + '&w6=' + w6 + '&w7=' + w7 + '&suma1=' + suma1 + '&suma2=' + suma2 + '&sumdd1=' + sumdd1 + '&fi_index1=' + fi_index1 + '&suma=' + suma + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&b4=' + b4 + '&b5=' + b5 + '&b6=' + b6 + '&b7=' + b7 + '&b8=' + b8 + '&b9=' + b9 + '&s11=' + s11 + '&s12=' + s12 + '&s13=' + s13 + '&s14=' + s14 + '&s15=' + s15 + '&s16=' + s16 + '&s17=' + s17 + '&s18=' + s18 + '&s19=' + s19 + '&ei_index=' + ei_index + '&aa1=' + aa1 + '&aa2=' + aa2 + '&aa3=' + aa3 + '&aa4=' + aa4 + '&aa5=' + aa5 + '&aa6=' + aa6 + '&aa7=' + aa7 + '&aa8=' + aa8 + '&aa9=' + aa9 + '&dd1=' + dd1 + '&dd2=' + dd2 + '&dd3=' + dd3 + '&dd4=' + dd4 + '&dd5=' + dd5 + '&dd6=' + dd6 + '&dd7=' + dd7 + '&dd8=' + dd8 + '&dd9=' + dd9 + '&x1=' + x1 + '&x2=' + x2 + '&x3=' + x3 + '&x4=' + x4 + '&x5=' + x5 + '&x6=' + x6 + '&x7=' + x7 + '&x8=' + x8 + '&x9=' + x9 + '&sumx=' + sumx + '&y1=' + y1 + '&y2=' + y2 + '&y3=' + y3 + '&y4=' + y4 + '&y5=' + y5 + '&y6=' + y6 + '&y7=' + y7 + '&y8=' + y8 + '&y9=' + y9 + '&sumy=' + sumy + '&combined_index=' + combined_index + '&sumb=' + sumb + '&sumaa=' + sumaa + '&sumdd=' + sumdd + '&chk_grd=' + chk_grd + '&sieve_1=' + sieve_1 + '&sieve_2=' + sieve_2 + '&sieve_3=' + sieve_3 + '&sieve_4=' + sieve_4 + '&cum_wt_gm_1=' + cum_wt_gm_1 + '&cum_wt_gm_2=' + cum_wt_gm_2 + '&cum_wt_gm_3=' + cum_wt_gm_3 + '&cum_wt_gm_4=' + cum_wt_gm_4 + '&cum_wt_gm_5=' + cum_wt_gm_5 + '&cum_wt_gm_6=' + cum_wt_gm_6 + '&cum_wt_gm_7=' + cum_wt_gm_7 + '&cum_wt_gm_8=' + cum_wt_gm_8 + '&cum_wt_gm_9=' + cum_wt_gm_9 + '&cum_wt_gm_10=' + cum_wt_gm_10 + '&cum_wt_gm_11=' + cum_wt_gm_11 + '&cum_wt_gm_12=' + cum_wt_gm_12 + '&cum_wt_gm_13=' + cum_wt_gm_13 + '&ret_wt_gm_1=' + ret_wt_gm_1 + '&ret_wt_gm_2=' + ret_wt_gm_2 + '&ret_wt_gm_3=' + ret_wt_gm_3 + '&ret_wt_gm_4=' + ret_wt_gm_4 + '&ret_wt_gm_5=' + ret_wt_gm_5 + '&ret_wt_gm_6=' + ret_wt_gm_6 + '&ret_wt_gm_7=' + ret_wt_gm_7 + '&ret_wt_gm_8=' + ret_wt_gm_8 + '&ret_wt_gm_9=' + ret_wt_gm_9 + '&ret_wt_gm_10=' + ret_wt_gm_10 + '&ret_wt_gm_11=' + ret_wt_gm_11 + '&ret_wt_gm_12=' + ret_wt_gm_12 + '&ret_wt_gm_13=' + ret_wt_gm_13 + '&cum_ret_1=' + cum_ret_1 + '&cum_ret_2=' + cum_ret_2 + '&cum_ret_3=' + cum_ret_3 + '&cum_ret_4=' + cum_ret_4 + '&cum_ret_5=' + cum_ret_5 + '&cum_ret_6=' + cum_ret_6 + '&cum_ret_7=' + cum_ret_7 + '&cum_ret_8=' + cum_ret_8 + '&cum_ret_9=' + cum_ret_9 + '&cum_ret_10=' + cum_ret_10 + '&cum_ret_11=' + cum_ret_11 + '&cum_ret_12=' + cum_ret_12 + '&cum_ret_13=' + cum_ret_13 + '&pass_sample_1=' + pass_sample_1 + '&pass_sample_2=' + pass_sample_2 + '&pass_sample_3=' + pass_sample_3 + '&pass_sample_4=' + pass_sample_4 + '&pass_sample_5=' + pass_sample_5 + '&pass_sample_6=' + pass_sample_6 + '&pass_sample_7=' + pass_sample_7 + '&pass_sample_8=' + pass_sample_8 + '&pass_sample_9=' + pass_sample_9 + '&pass_sample_10=' + pass_sample_10 + '&pass_sample_11=' + pass_sample_11 + '&pass_sample_12=' + pass_sample_12 + '&pass_sample_13=' + pass_sample_13 + '&blank_extra=' + blank_extra + '&blank_extra1=' + blank_extra1 + '&blank_extra2=' + blank_extra2 + '&blank_extra3=' + blank_extra3 + '&sample_taken=' + sample_taken + '&chk_impact=' + chk_impact + '&imp_w_m_a_1=' + imp_w_m_a_1 + '&imp_w_m_a_2=' + imp_w_m_a_2 + '&imp_w_m_b_1=' + imp_w_m_b_1 + '&imp_w_m_b_2=' + imp_w_m_b_2 + '&imp_w_m_c_1=' + imp_w_m_c_1 + '&imp_w_m_c_2=' + imp_w_m_c_2 + '&imp_value_1=' + imp_value_1 + '&imp_value_2=' + imp_value_2 + '&imp_value=' + imp_value + '&chk_ll=' + chk_ll + '&pen1=' + pen1 + '&pen2=' + pen2 + '&pen3=' + pen3 + '&pen4=' + pen4 + '&cont1=' + cont1 + '&cont2=' + cont2 + '&cont3=' + cont3 + '&cont4=' + cont4 + '&wc1=' + wc1 + '&wc2=' + wc2 + '&wc3=' + wc3 + '&wc4=' + wc4 + '&od1=' + od1 + '&od2=' + od2 + '&od3=' + od3 + '&od4=' + od4 + '&ww1=' + ww1 + '&ww2=' + ww2 + '&ww3=' + ww3 + '&ww4=' + ww4 + '&wf1=' + wf1 + '&wf2=' + wf2 + '&wf3=' + wf3 + '&wf4=' + wf4 + '&ds1=' + ds1 + '&ds2=' + ds2 + '&ds3=' + ds3 + '&ds4=' + ds4 + '&mo1=' + mo1 + '&mo2=' + mo2 + '&mo3=' + mo3 + '&mo4=' + mo4 + '&ln1=' + ln1 + '&ln2=' + ln2 + '&ln3=' + ln3 + '&ln4=' + ln4 + '&avg_ll=' + avg_ll + '&avg_pl=' + avg_pl + '&plastic_limit=' + plastic_limit + '&pi_value=' + pi_value + '&liquide_limit=' + liquide_limit + '&ulr=' + ulr + '&chk_pha=' + chk_pha + '&ph_s1_1=' + ph_s1_1 + '&ph_s1_2=' + ph_s1_2 + '&ph_s2_1=' + ph_s2_1 + '&ph_s2_2=' + ph_s2_2 + '&avg_ph=' + avg_ph + '&chk_clr=' + chk_clr + '&clr_s1_1=' + clr_s1_1 + '&clr_s1_2=' + clr_s1_2 + '&clr_s1_3=' + clr_s1_3 + '&clr_s1_4=' + clr_s1_4 + '&clr_s1_5=' + clr_s1_5 + '&clr_s1_6=' + clr_s1_6 + '&clr_s1_7=' + clr_s1_7 + '&clr_s2_1=' + clr_s2_1 + '&clr_s2_2=' + clr_s2_2 + '&clr_s2_3=' + clr_s2_3 + '&clr_s2_4=' + clr_s2_4 + '&clr_s2_5=' + clr_s2_5 + '&clr_s2_6=' + clr_s2_6 + '&clr_s2_7=' + clr_s2_7 + '&avg_clr=' + avg_clr + '&chk_slp=' + chk_slp + '&slp_s1_1=' + slp_s1_1 + '&slp_s1_2=' + slp_s1_2 + '&slp_s1_3=' + slp_s1_3 + '&slp_s1_4=' + slp_s1_4 + '&slp_s1_5=' + slp_s1_5 + '&slp_s2_1=' + slp_s2_1 + '&slp_s2_2=' + slp_s2_2 + '&slp_s2_3=' + slp_s2_3 + '&slp_s2_4=' + slp_s2_4 + '&slp_s2_5=' + slp_s2_5 + '&avg_sul=' + avg_sul + '&chk_dtm=' + chk_dtm + '&dele_1_1=' + dele_1_1 + '&dele_1_2=' + dele_1_2 + '&dele_1_3=' + dele_1_3 + '&dele_1_4=' + dele_1_4 + '&dele_2_1=' + dele_2_1 + '&dele_2_2=' + dele_2_2 + '&dele_2_3=' + dele_2_3 + '&dele_3_1=' + dele_3_1 + '&dele_3_2=' + dele_3_2 + '&dele_3_3=' + dele_3_3 + '&dele_4_1=' + dele_4_1 + '&dele_4_2=' + dele_4_2 + '&dele_4_3=' + dele_4_3 + '&chk_aoi=' + chk_aoi + '&aoi_1=' + aoi_1 + '&aoi_2=' + aoi_2 + '&aoi_3=' + aoi_3 + '&aoi_4=' + aoi_4;

			} else if (type == 'edit') {

				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();

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
						var sieve_1 = "40";
						var sieve_2 = "20";
						var sieve_3 = "10";
						var sieve_4 = "4.75";
						var sample_taken = $('#sample_taken').val();
						var blank_extra = $('#blank_extra').val();
						var blank_extra1 = $('#blank_extra1').val();
						var blank_extra2 = $('#blank_extra2').val();
						var blank_extra3 = $('#blank_extra3').val();

						var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
						var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
						var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
						var cum_wt_gm_4 = $('#cum_wt_gm_4').val();
						var cum_wt_gm_5 = $('#cum_wt_gm_5').val();
						var cum_wt_gm_6 = $('#cum_wt_gm_6').val();
						var cum_wt_gm_7 = $('#cum_wt_gm_7').val();
						var cum_wt_gm_8 = $('#cum_wt_gm_8').val();
						var cum_wt_gm_9 = $('#cum_wt_gm_9').val();
						var cum_wt_gm_10 = $('#cum_wt_gm_10').val();
						var cum_wt_gm_11 = $('#cum_wt_gm_11').val();
						var cum_wt_gm_12 = $('#cum_wt_gm_12').val();
						var cum_wt_gm_13 = $('#cum_wt_gm_13').val();


						var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
						var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
						var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
						var ret_wt_gm_4 = $('#ret_wt_gm_4').val();
						var ret_wt_gm_5 = $('#ret_wt_gm_5').val();
						var ret_wt_gm_6 = $('#ret_wt_gm_6').val();
						var ret_wt_gm_7 = $('#ret_wt_gm_7').val();
						var ret_wt_gm_8 = $('#ret_wt_gm_8').val();
						var ret_wt_gm_9 = $('#ret_wt_gm_9').val();
						var ret_wt_gm_10 = $('#ret_wt_gm_10').val();
						var ret_wt_gm_11 = $('#ret_wt_gm_11').val();
						var ret_wt_gm_12 = $('#ret_wt_gm_12').val();
						var ret_wt_gm_13 = $('#ret_wt_gm_13').val();


						var cum_ret_1 = $('#cum_ret_1').val();
						var cum_ret_2 = $('#cum_ret_2').val();
						var cum_ret_3 = $('#cum_ret_3').val();
						var cum_ret_4 = $('#cum_ret_4').val();
						var cum_ret_5 = $('#cum_ret_5').val();
						var cum_ret_6 = $('#cum_ret_6').val();
						var cum_ret_7 = $('#cum_ret_7').val();
						var cum_ret_8 = $('#cum_ret_8').val();
						var cum_ret_9 = $('#cum_ret_9').val();
						var cum_ret_10 = $('#cum_ret_10').val();
						var cum_ret_11 = $('#cum_ret_11').val();
						var cum_ret_12 = $('#cum_ret_12').val();
						var cum_ret_13 = $('#cum_ret_13').val();


						var pass_sample_1 = $('#pass_sample_1').val();
						var pass_sample_2 = $('#pass_sample_2').val();
						var pass_sample_3 = $('#pass_sample_3').val();
						var pass_sample_4 = $('#pass_sample_4').val();
						var pass_sample_5 = $('#pass_sample_5').val();
						var pass_sample_6 = $('#pass_sample_6').val();
						var pass_sample_7 = $('#pass_sample_7').val();
						var pass_sample_8 = $('#pass_sample_8').val();
						var pass_sample_9 = $('#pass_sample_9').val();
						var pass_sample_10 = $('#pass_sample_10').val();
						var pass_sample_11 = $('#pass_sample_11').val();
						var pass_sample_12 = $('#pass_sample_12').val();
						var pass_sample_13 = $('#pass_sample_13').val();


						break;
					} else {
						var chk_grd = "0";
						var cum_wt_gm_1 = "0";
						var cum_wt_gm_2 = "0";
						var cum_wt_gm_3 = "0";
						var cum_wt_gm_4 = "0";
						var cum_wt_gm_5 = "0";
						var cum_wt_gm_6 = "0";
						var cum_wt_gm_7 = "0";
						var cum_wt_gm_8 = "0";
						var cum_wt_gm_9 = "0";
						var cum_wt_gm_10 = "0";
						var cum_wt_gm_11 = "0";
						var cum_wt_gm_12 = "0";
						var cum_wt_gm_13 = "0";


						var ret_wt_gm_1 = "0";
						var ret_wt_gm_2 = "0";
						var ret_wt_gm_3 = "0";
						var ret_wt_gm_4 = "0";
						var ret_wt_gm_5 = "0";
						var ret_wt_gm_6 = "0";
						var ret_wt_gm_7 = "0";
						var ret_wt_gm_8 = "0";
						var ret_wt_gm_9 = "0";
						var ret_wt_gm_10 = "0";
						var ret_wt_gm_11 = "0";
						var ret_wt_gm_12 = "0";
						var ret_wt_gm_13 = "0";


						var cum_ret_1 = "0";
						var cum_ret_2 = "0";
						var cum_ret_3 = "0";
						var cum_ret_4 = "0";
						var cum_ret_5 = "0";
						var cum_ret_6 = "0";
						var cum_ret_7 = "0";
						var cum_ret_8 = "0";
						var cum_ret_9 = "0";
						var cum_ret_10 = "0";
						var cum_ret_11 = "0";
						var cum_ret_12 = "0";
						var cum_ret_13 = "0";

						var pass_sample_1 = "0";
						var pass_sample_2 = "0";
						var pass_sample_3 = "0";
						var pass_sample_4 = "0";
						var pass_sample_5 = "0";
						var pass_sample_6 = "0";
						var pass_sample_7 = "0";
						var pass_sample_8 = "0";
						var pass_sample_9 = "0";
						var pass_sample_10 = "0";
						var pass_sample_11 = "0";
						var pass_sample_12 = "0";
						var pass_sample_13 = "0";


						var blank_extra = "0";
						var blank_extra1 = "0";
						var blank_extra2 = "0";
						var blank_extra3 = "0";
						var sample_taken = "0";
					}

				}

				//IMPACT
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "imp") {

						if (document.getElementById('chk_impact').checked) {
							var chk_impact = "1";
						} else {
							var chk_impact = "0";
						}
						//impact value-3
						var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
						var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
						var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
						var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
						var imp_w_m_c_1 = $('#imp_w_m_c_1').val();
						var imp_w_m_c_2 = $('#imp_w_m_c_2').val();
						var imp_value_1 = $('#imp_value_1').val();
						var imp_value_2 = $('#imp_value_2').val();
						var imp_value = $('#imp_value').val();
						break;
					} else {
						var chk_impact = "0";
						var imp_value = "0";
						var imp_value_1 = "0";
						var imp_value_2 = "0";
						var imp_w_m_a_1 = "0";
						var imp_w_m_b_1 = "0";
						var imp_w_m_c_1 = "0";
						var imp_w_m_a_2 = "0";
						var imp_w_m_b_2 = "0";
						var imp_w_m_c_2 = "0";

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
						var m31 = $('#m31').val();
						var m32 = $('#m32').val();
						var m33 = $('#m33').val();
						var avg_wom = $('#avg_wom').val();
						var avg_wom1 = $('#avg_wom').val();
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
						var m31 = "0";
						var m32 = "0";
						var m33 = "0";
						var avg_wom = "0";
						var avg_wom1 = "0";
						var vol = "0";
						var bdl = "0";
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
						var sp_w_sur_3 = $('#sp_w_sur_3').val();
						var sp_w_sur_4 = $('#sp_w_sur_4').val();
						var sp_w_sur_5 = $('#sp_w_sur_5').val();
						var sp_w_sur_6 = $('#sp_w_sur_6').val();
						var sp_w_s_1 = $('#sp_w_s_1').val();
						var sp_w_s_2 = $('#sp_w_s_2').val();
						var sp_w_s_3 = $('#sp_w_s_3').val();
						var sp_w_s_4 = $('#sp_w_s_4').val();
						var sp_w_s_5 = $('#sp_w_s_5').val();
						var sp_w_s_6 = $('#sp_w_s_6').val();
						var taken_1 = $('#taken_1').val();
						var taken_2 = $('#taken_2').val();
						var sp_wt_st_1 = $('#sp_wt_st_1').val();
						var sp_wt_st_2 = $('#sp_wt_st_2').val();
						var sp_wt_st_3 = $('#sp_wt_st_3').val();
						var sp_wt_st_4 = $('#sp_wt_st_4').val();
						var sp_wt_st_5 = $('#sp_wt_st_5').val();
						var sp_wt_st_6 = $('#sp_wt_st_6').val();
						var sp_agg1 = $('#sp_agg1').val();
						var sp_agg2 = $('#sp_agg2').val();
						var sp_agg3 = $('#sp_agg3').val();
						var sp_agg4 = $('#sp_agg4').val();
						var sp_agg5 = $('#sp_agg5').val();
						var sp_agg6 = $('#sp_agg6').val();
						var sp_wat1 = $('#sp_wat1').val();
						var sp_wat2 = $('#sp_wat2').val();
						var sp_wat3 = $('#sp_wat3').val();
						var sp_wat4 = $('#sp_wat4').val();
						var sp_wat5 = $('#sp_wat5').val();
						var sp_wat6 = $('#sp_wat6').val();
						var sp_specific_gravity_b2 = $('#sp_specific_gravity_b2').val();
						var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
						var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
						var sp_specific_gravity_3 = $('#sp_specific_gravity_3').val();
						var sp_specific_gravity = $('#sp_specific_gravity').val();
						var sp_water_abr = $('#sp_water_abr').val();
						var sp_water_abr_1 = $('#sp_water_abr_1').val();
						var sp_water_abr_2 = $('#sp_water_abr_2').val();
						var sp_water_abr_3 = $('#sp_water_abr_3').val();

						break;
					} else {
						var chk_sp = "0";
						var sp_w_sur_1 = "0";
						var sp_w_s_1 = "0";
						var sp_wt_st_1 = "0";
						var sp_wt_st_4 = "0";
						var sp_wt_st_5 = "0";
						var sp_wt_st_6 = "0";
						var taken_1 = "0";
						var taken_2 = "0";
						var sp_w_sur_2 = "0";
						var sp_w_s_2 = "0";
						var sp_wt_st_2 = "0";
						var sp_w_sur_3 = "0";
						var sp_w_sur_4 = "0";
						var sp_w_sur_5 = "0";
						var sp_w_sur_6 = "0";
						var sp_w_s_3 = "0";
						var sp_w_s_4 = "0";
						var sp_w_s_5 = "0";
						var sp_w_s_6 = "0";
						var sp_wt_st_3 = "0";
						var sp_agg1 = "0";
						var sp_agg2 = "0";
						var sp_agg3 = "0";
						var sp_agg4 = "0";
						var sp_agg5 = "0";
						var sp_agg6 = "0";
						var sp_wat1 = "0";
						var sp_wat2 = "0";
						var sp_wat3 = "0";
						var sp_wat4 = "0";
						var sp_wat5 = "0";
						var sp_wat6 = "0";
						var sp_specific_gravity_b2 = "0";
						var sp_specific_gravity_1 = "0";
						var sp_specific_gravity_2 = "0";
						var sp_specific_gravity_3 = "0";
						var sp_specific_gravity = "0";
						var sp_water_abr_1 = "0";
						var sp_water_abr_2 = "0";
						var sp_water_abr_3 = "0";
						var sp_water_abr = "0";


					}

				}

				//ABRASION VALUE
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "abr") {
						if (document.getElementById('chk_abr').checked) {
							var chk_abr = "1";
						} else {
							var chk_abr = "0";
						}
						//Abrasion-2
						var abr_index = $('#abr_index').val();
						var abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
						var abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
						var abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
						var abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();
						var abr_wt_t_c_1 = $('#abr_wt_t_c_1').val();
						var abr_wt_t_c_2 = $('#abr_wt_t_c_2').val();
						var abr_1 = $('#abr_1').val();
						var abr_2 = $('#abr_2').val();
						var abr_grading = $('#abr_grading').val();
						var abr_num_revo = $('#abr_num_revo').val();
						var abr_weight_charge = $('#abr_weight_charge').val();
						var abr_sphere = $('#abr_sphere').val();
						break;
					} else {
						var chk_abr = "0";
						var abr_wt_t_a_1 = "0";
						var abr_wt_t_b_1 = "0";
						var abr_wt_t_c_1 = "0";
						var abr_wt_t_a_2 = "0";
						var abr_wt_t_b_2 = "0";
						var abr_grading = "0";
						var abr_wt_t_c_2 = "0";
						var abr_1 = "0";
						var abr_2 = "0";
						var abr_index = "0";
						var abr_sphere = "0";
						var abr_num_revo = "0";
						var abr_weight_charge = "0";
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


						var s31 = $('#s31').val();
						var s32 = $('#s32').val();
						var s33 = $('#s33').val();
						var s34 = $('#s34').val();
						var s35 = $('#s35').val();
						var s36 = $('#s36').val();
						var s37 = $('#s37').val();
						var s38 = $('#s38').val();
						var s39 = $('#s39').val();
						var s30 = $('#s30').val();
						var s41 = $('#s41').val();
						var s42 = $('#s42').val();
						var s43 = $('#s43').val();
						var s44 = $('#s44').val();
						var s45 = $('#s45').val();
						var s46 = $('#s46').val();
						var s47 = $('#s47').val();
						var s48 = $('#s48').val();
						var s49 = $('#s49').val();
						var s40 = $('#s40').val();
						var s51 = $('#s51').val();
						var s52 = $('#s52').val();
						var s53 = $('#s53').val();
						var s54 = $('#s54').val();
						var s55 = $('#s55').val();
						var s56 = $('#s56').val();
						var s57 = $('#s57').val();
						var s58 = $('#s58').val();
						var s59 = $('#s59').val();
						var s50 = $('#s50').val();
						var s61 = $('#s61').val();
						var s62 = $('#s62').val();
						var s63 = $('#s63').val();
						var s64 = $('#s64').val();
						var s65 = $('#s65').val();
						var s66 = $('#s66').val();
						var s67 = $('#s67').val();
						var s68 = $('#s68').val();
						var s69 = $('#s69').val();
						var s60 = $('#s60').val();
						var s6total = $('#s6total').val();
						var soundness = $('#soundness').val();


						break;
					} else {
						var chk_sou = "0";
						var s31 = "0";
						var s32 = "0";
						var s33 = "0";
						var s34 = "0";
						var s35 = "0";
						var s36 = "0";
						var s37 = "0";
						var s38 = "0";
						var s39 = "0";
						var s30 = "0";
						var s41 = "0";
						var s42 = "0";
						var s43 = "0";
						var s44 = "0";
						var s45 = "0";
						var s46 = "0";
						var s47 = "0";
						var s48 = "0";
						var s49 = "0";
						var s40 = "0";
						var s51 = "0";
						var s52 = "0";
						var s53 = "0";
						var s54 = "0";
						var s55 = "0";
						var s56 = "0";
						var s57 = "0";
						var s58 = "0";
						var s59 = "0";
						var s50 = "0";
						var s61 = "0";
						var s62 = "0";
						var s63 = "0";
						var s64 = "0";
						var s65 = "0";
						var s66 = "0";
						var s67 = "0";
						var s68 = "0";
						var s69 = "0";
						var s60 = "0";
						var s6total = "0";
						var soundness = "0";
					}

				}

				//FLAKINESS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "flk") {

						if (document.getElementById('chk_flk').checked) {
							var chk_flk = "1";
						} else {
							var chk_flk = "0";

						}
						//Flakiness INDEX

						var ei_index = $('#ei_index').val();
						var fi_index = $('#fi_index').val();
						var combined_index = $('#combined_index').val();
						var a1 = $('#a1').val();
						var a2 = $('#a2').val();
						var a3 = $('#a3').val();
						var a4 = $('#a4').val();
						var a5 = $('#a5').val();
						var a6 = $('#a6').val();
						var a7 = $('#a7').val();
						var a8 = $('#a8').val();
						var a9 = $('#a9').val();
						var suma = $('#suma').val();

						var b1 = $('#b1').val();
						var b2 = $('#b2').val();
						var b3 = $('#b3').val();
						var b4 = $('#b4').val();
						var b5 = $('#b5').val();
						var b6 = $('#b6').val();
						var b7 = $('#b7').val();
						var b8 = $('#b8').val();
						var b9 = $('#b9').val();
						var sumb = $('#sumb').val();


						var aa1 = $('#aa1').val();
						var aa2 = $('#aa2').val();
						var aa3 = $('#aa3').val();
						var aa4 = $('#aa4').val();
						var aa5 = $('#aa5').val();
						var aa6 = $('#aa6').val();
						var aa7 = $('#aa7').val();
						var aa8 = $('#aa8').val();
						var aa9 = $('#aa9').val();
						var sumaa = $('#sumaa').val();

						var dd1 = $('#dd1').val();
						var dd2 = $('#dd2').val();
						var dd3 = $('#dd3').val();
						var dd4 = $('#dd4').val();
						var dd5 = $('#dd5').val();
						var dd6 = $('#dd6').val();
						var dd7 = $('#dd7').val();
						var dd8 = $('#dd8').val();
						var dd9 = $('#dd9').val();
						var sumdd = $('#sumdd').val();

						var x1 = $('#x1').val();
						var x2 = $('#x2').val();
						var x3 = $('#x3').val();
						var x4 = $('#x4').val();
						var x5 = $('#x5').val();
						var x6 = $('#x6').val();
						var x7 = $('#x7').val();
						var x8 = $('#x8').val();
						var x9 = $('#x9').val();
						var sumx = $('#sumx').val();

						var y1 = $('#y1').val();
						var y2 = $('#y2').val();
						var y3 = $('#y3').val();
						var y4 = $('#y4').val();
						var y5 = $('#y5').val();
						var y6 = $('#y6').val();
						var y7 = $('#y7').val();
						var y8 = $('#y8').val();
						var y9 = $('#y9').val();
						var sumy = $('#sumy').val();

						var s11 = $('#s11').val();
						var s12 = $('#s12').val();
						var s13 = $('#s13').val();
						var s14 = $('#s14').val();
						var s15 = $('#s15').val();
						var s16 = $('#s16').val();
						var s17 = $('#s17').val();
						var s18 = $('#s18').val();
						var s19 = $('#s19').val();

						var s1 = $('#s1').val();
						var s2 = $('#s2').val();
						var s3 = $('#s3').val();
						var s4 = $('#s4').val();
						var s5 = $('#s5').val();
						var s6 = $('#s6').val();
						var s7 = $('#s7').val();

						var m1 = $('#m1').val();
						var m2 = $('#m2').val();
						var m3 = $('#m3').val();
						var m4 = $('#m4').val();
						var m5 = $('#m5').val();
						var m6 = $('#m6').val();
						var m7 = $('#m7').val();

						var p1 = $('#p1').val();
						var p2 = $('#p2').val();
						var p3 = $('#p3').val();
						var p4 = $('#p4').val();
						var p5 = $('#p5').val();
						var p6 = $('#p6').val();
						var p7 = $('#p7').val();

						var pp1 = $('#pp1').val();
						var pp2 = $('#pp2').val();
						var pp3 = $('#pp3').val();
						var pp4 = $('#pp4').val();
						var pp5 = $('#pp5').val();
						var pp6 = $('#pp6').val();
						var pp7 = $('#pp7').val();

						var w1 = $('#w1').val();
						var w2 = $('#w2').val();
						var w3 = $('#w3').val();
						var w4 = $('#w4').val();
						var w5 = $('#w5').val();
						var w6 = $('#w6').val();
						var w7 = $('#w7').val();

						var suma1 = $('#suma1').val();
						var suma2 = $('#suma2').val();
						var sumdd = $('#sumdd').val();

						var fi_index = $('#fi_index').val();
						var fi_index1 = $('#fi_index1').val();



						break;
					} else {
						var chk_flk = "0";
						var fi_index = "0";
						var ei_index = "0";
						var combined_index = "0";

						var s1 = "0";
						var s2 = "0";
						var s3 = "0";
						var s4 = "0";
						var s5 = "0";
						var s6 = "0";
						var s7 = "0";
						var suma1 = "0";
						var suma2 = "0";


						var m1 = "0";
						var m2 = "0";
						var m3 = "0";
						var m4 = "0";
						var m5 = "0";
						var m6 = "0";
						var m7 = "0";

						var p1 = "0";
						var p2 = "0";
						var p3 = "0";
						var p4 = "0";
						var p5 = "0";
						var p6 = "0";
						var p7 = "0";

						var pp1 = "0";
						var pp2 = "0";
						var pp3 = "0";
						var pp4 = "0";
						var pp5 = "0";
						var pp6 = "0";
						var pp7 = "0";

						var w1 = "0";
						var w2 = "0";
						var w3 = "0";
						var w4 = "0";
						var w5 = "0";
						var w6 = "0";
						var w7 = "0";
						var sumdd1 = "0";
						var fi_index1 = "0";

						var a1 = "0";
						var a2 = "0";
						var a3 = "0";
						var a4 = "0";
						var a5 = "0";
						var a6 = "0";
						var a7 = "0";
						var a8 = "0";
						var a9 = "0";
						var suma = "0";

						var b1 = "0";
						var b2 = "0";
						var b3 = "0";
						var b4 = "0";
						var b5 = "0";
						var b6 = "0";
						var b7 = "0";
						var b8 = "0";
						var b9 = "0";
						var sumb = "0";

						var aa1 = "0";
						var aa2 = "0";
						var aa3 = "0";
						var aa4 = "0";
						var aa5 = "0";
						var aa6 = "0";
						var aa7 = "0";
						var aa8 = "0";
						var aa9 = "0";
						var sumaa = "0";


						var dd1 = "0";
						var dd2 = "0";
						var dd3 = "0";
						var dd4 = "0";
						var dd5 = "0";
						var dd6 = "0";
						var dd7 = "0";
						var dd8 = "0";
						var dd9 = "0";
						var sumdd = "0";

						var x1 = "0";
						var x2 = "0";
						var x3 = "0";
						var x4 = "0";
						var x5 = "0";
						var x6 = "0";
						var x7 = "0";
						var x8 = "0";
						var x9 = "0";
						var sumx = "0";

						var y1 = "0";
						var y2 = "0";
						var y3 = "0";
						var y4 = "0";
						var y5 = "0";
						var y6 = "0";
						var y7 = "0";
						var y8 = "0";
						var y9 = "0";
						var sumy = "0";

						var s11 = "";
						var s12 = "";
						var s13 = "";
						var s14 = "";
						var s15 = "";
						var s16 = "";
						var s17 = "";
						var s18 = "";
						var s19 = "";
					}

				}


				//FINEVALUES
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "fin") {
						if (document.getElementById('chk_fines').checked) {
							var chk_fines = "1";
						} else {
							var chk_fines = "0";
						}
						//alkali strip and fines_value
						var fines_value = $('#fines_value').val();
						var f_a_1 = $('#f_a_1').val();
						var f_a_2 = $('#f_a_2').val();
						var f_b_1 = $('#f_b_1').val();
						var f_b_2 = $('#f_b_2').val();
						var f_c_1 = $('#f_c_1').val();
						var f_c_2 = $('#f_c_2').val();
						var f_d_1 = $('#f_d_1').val();
						var f_d_2 = $('#f_d_2').val();
						var avg_f_d = $('#avg_f_d').val();
						var avg_f_c = $('#avg_f_c').val();
						break;
					} else {
						var chk_fines = "0";
						var fines_value = "0";
						var f_a_1 = "0";
						var f_a_2 = "0";
						var f_b_1 = "0";
						var f_b_2 = "0";
						var f_c_1 = "0";
						var f_c_2 = "0";
						var f_d_1 = "0";
						var f_d_2 = "0";
						var avg_f_d = "0";
						var avg_f_c = "0";
					}
				}

				//ALKALI REACTION
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "alk") {
						if (document.getElementById('chk_alkali').checked) {
							var chk_alkali = "1";
						} else {
							var chk_alkali = "0";
						}
						var alk_1 = $('#alk_1').val();
						var alk_2 = $('#alk_2').val();
						var alk_3 = $('#alk_3').val();
						var alk_4 = $('#alk_4').val();
						var alk_5 = $('#alk_5').val();
						var alk_6 = $('#alk_6').val();
						var alk_7 = $('#alk_7').val();
						var alk_8 = $('#alk_8').val();
						var alk_9 = $('#alk_9').val();
						var alk_10 = $('#alk_10').val();
						var alk_11 = $('#alk_11').val();
						break;
					} else {
						var chk_alkali = "0";
						var alk_1 = "0";
						var alk_2 = "0";
						var alk_3 = "0";
						var alk_4 = "0";
						var alk_5 = "0";
						var alk_6 = "0";
						var alk_7 = "0";
						var alk_8 = "0";
						var alk_9 = "0";
						var alk_10 = "0";
						var alk_11 = "0";
					}
				}

				//CRUSHING
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "cru") {
						if (document.getElementById('chk_crushing').checked) {
							var chk_crushing = "1";
						} else {
							var chk_crushing = "0";
						}
						//crushing value-4

						var cru_value = $('#cru_value').val();
						var cru_value_1 = $('#cru_value_1').val();
						var cru_value_2 = $('#cru_value_2').val();
						var cr_a_1 = $('#cr_a_1').val();
						var cr_a_2 = $('#cr_a_2').val();
						var cr_b_1 = $('#cr_b_1').val();
						var cr_b_2 = $('#cr_b_2').val();

						break;
					} else {
						var chk_crushing = "0";
						var cru_value = "0";
						var cru_value_1 = "0";
						var cr_a_1 = "0";
						var cr_a_2 = "0";
						var cr_b_1 = "0";
						var cru_value_2 = "0";
						var cr_b_2 = "0";

					}
				}


				//LIQUIDE LIMIT AND PLASTICITY VALUE
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "lll") { //ll and pl
						if (document.getElementById('chk_ll').checked) {
							var chk_ll = "1";
						} else {
							var chk_ll = "0";
						}

						var pen1 = $('#pen1').val();
						var pen2 = $('#pen2').val();
						var pen3 = $('#pen3').val();
						var pen4 = $('#pen4').val();

						var cont1 = $('#cont1').val();
						var cont2 = $('#cont2').val();
						var cont3 = $('#cont3').val();
						var cont4 = $('#cont4').val();

						var wc1 = $('#wc1').val();
						var wc2 = $('#wc2').val();
						var wc3 = $('#wc3').val();
						var wc4 = $('#wc4').val();

						var od1 = $('#od1').val();
						var od2 = $('#od2').val();
						var od3 = $('#od3').val();
						var od4 = $('#od4').val();

						var ww1 = $('#ww1').val();
						var ww2 = $('#ww2').val();
						var ww3 = $('#ww3').val();
						var ww4 = $('#ww4').val();

						var wf1 = $('#wf1').val();
						var wf2 = $('#wf2').val();
						var wf3 = $('#wf3').val();
						var wf4 = $('#wf4').val();

						var ds1 = $('#ds1').val();
						var ds2 = $('#ds2').val();
						var ds3 = $('#ds3').val();
						var ds4 = $('#ds4').val();

						var mo1 = $('#mo1').val();
						var mo2 = $('#mo2').val();
						var mo3 = $('#mo3').val();
						var mo4 = $('#mo4').val();

						var ln1 = $('#ln1').val();
						var ln2 = $('#ln2').val();
						var ln3 = $('#ln3').val();
						var ln4 = $('#ln4').val();


						var plastic_limit = $('#plastic_limit').val();
						var pi_value = $('#pi_value').val();
						var liquide_limit = $('#liquide_limit').val();
						var avg_ll = $('#avg_ll').val();
						var avg_pl = $('#avg_pl').val();

						break;
					} else {
						var chk_ll = "0";
						var pen1 = "0";
						var pen2 = "0";
						var pen3 = "0";
						var pen4 = "0";


						var cont1 = "0";
						var cont2 = "0";
						var cont3 = "0";
						var cont4 = "0";

						var wc1 = "0";
						var wc2 = "0";
						var wc3 = "0";
						var wc4 = "0";

						var od1 = "0";
						var od2 = "0";
						var od3 = "0";
						var od4 = "0";

						var ww1 = "0";
						var ww2 = "0";
						var ww3 = "0";
						var ww4 = "0";

						var wf1 = "0";
						var wf2 = "0";
						var wf3 = "0";
						var wf4 = "0";

						var ds1 = "0";
						var ds2 = "0";
						var ds3 = "0";
						var ds4 = "0";

						var mo1 = "0";
						var mo2 = "0";
						var mo3 = "0";
						var mo4 = "0";

						var ln1 = "0";
						var ln2 = "0";
						var ln3 = "0";
						var ln4 = "0";

						var plastic_limit = "0";
						var pi_value = "0";
						var liquide_limit = "0";
						var avg_ll = "0";
						var avg_pl = "0";

					}

				}

				//Ph
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "pha") {
						if (document.getElementById('chk_pha').checked) {
							var chk_pha = "1";
						} else {
							var chk_pha = "0";
						}

						var ph_s1_1 = $('#ph_s1_1').val();
						var ph_s1_2 = $('#ph_s1_2').val();
						var ph_s2_1 = $('#ph_s2_1').val();
						var ph_s2_2 = $('#ph_s2_2').val();
						var avg_ph = $('#avg_ph').val();
						break;
					} else {
						var chk_pha = "0";
						var ph_s1_1 = "0";
						var ph_s1_2 = "0";
						var ph_s2_1 = "0";
						var ph_s2_2 = "0";
						var avg_ph = "0";
					}
				}


				//aoi
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "aoi") {
						if (document.getElementById('chk_aoi').checked) {
							var chk_aoi = "1";
						} else {
							var chk_aoi = "0";
						}

						var aoi_1 = $('#aoi_1').val();
						var aoi_2 = $('#aoi_2').val();
						var aoi_3 = $('#aoi_3').val();
						var aoi_4 = $('#aoi_4').val();

						break;
					} else {
						var chk_aoi = "0";
						var aoi_1 = "0";
						var aoi_2 = "0";
						var aoi_3 = "0";
						var aoi_4 = "0";

					}
				}


				//CLR
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "clr") {
						if (document.getElementById('chk_clr').checked) {
							var chk_clr = "1";
						} else {
							var chk_clr = "0";
						}

						var clr_s1_1 = $('#clr_s1_1').val();
						var clr_s1_2 = $('#clr_s1_2').val();
						var clr_s1_3 = $('#clr_s1_3').val();
						var clr_s1_4 = $('#clr_s1_4').val();
						var clr_s1_5 = $('#clr_s1_5').val();
						var clr_s1_6 = $('#clr_s1_6').val();
						var clr_s1_7 = $('#clr_s1_7').val();
						var clr_s2_1 = $('#clr_s1_1').val();
						var clr_s2_2 = $('#clr_s1_2').val();
						var clr_s2_3 = $('#clr_s1_3').val();
						var clr_s2_4 = $('#clr_s1_4').val();
						var clr_s2_5 = $('#clr_s1_5').val();
						var clr_s2_6 = $('#clr_s1_6').val();
						var clr_s2_7 = $('#clr_s1_7').val();
						var avg_clr = $('#av_clr').val();
						break;
					} else {
						var chk_clr = "0";
						var clr_s1_1 = "0";
						var clr_s1_2 = "0";
						var clr_s1_3 = "0";
						var clr_s1_4 = "0";
						var clr_s1_5 = "0";
						var clr_s1_6 = "0";
						var clr_s1_7 = "0";
						var clr_s2_1 = "0";
						var clr_s2_2 = "0";
						var clr_s2_3 = "0";
						var clr_s2_4 = "0";
						var clr_s2_5 = "0";
						var clr_s2_6 = "0";
						var clr_s2_7 = "0";
						var avg_clr = "0";
					}
				}

				//SLP
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "slp") {
						if (document.getElementById('chk_slp').checked) {
							var chk_slp = "1";
						} else {
							var chk_slp = "0";
						}

						var slp_s1_1 = $('#slp_s1_1').val();
						var slp_s1_2 = $('#slp_s1_2').val();
						var slp_s1_3 = $('#slp_s1_3').val();
						var slp_s1_4 = $('#slp_s1_4').val();
						var slp_s1_5 = $('#slp_s1_5').val();
						var slp_s2_1 = $('#slp_s1_1').val();
						var slp_s2_2 = $('#slp_s1_2').val();
						var slp_s2_3 = $('#slp_s1_3').val();
						var slp_s2_4 = $('#slp_s1_4').val();
						var slp_s2_5 = $('#slp_s1_5').val();
						var avg_sul = $('#avg_sul').val();
						break;
					} else {
						var chk_slp = "0";
						var slp_s1_1 = "0";
						var slp_s1_2 = "0";
						var slp_s1_3 = "0";
						var slp_s1_4 = "0";
						var slp_s1_5 = "0";
						var slp_s2_1 = "0";
						var slp_s2_2 = "0";
						var slp_s2_3 = "0";
						var slp_s2_4 = "0";
						var slp_s2_5 = "0";
						var avg_sul = $('#avg_sul').val();
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


				billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_sou=' + chk_sou + '&s6total=' + s6total + '&soundness=' + soundness + '&s31=' + s31 + '&s32=' + s32 + '&s33=' + s33 + '&s34=' + s34 + '&s35=' + s35 + '&s36=' + s36 + '&s37=' + s37 + '&s38=' + s38 + '&s39=' + s39 + '&s30=' + s30 + '&s41=' + s41 + '&s42=' + s42 + '&s43=' + s43 + '&s44=' + s44 + '&s45=' + s45 + '&s46=' + s46 + '&s47=' + s47 + '&s48=' + s48 + '&s49=' + s49 + '&s40=' + s40 + '&s51=' + s51 + '&s52=' + s52 + '&s53=' + s53 + '&s54=' + s54 + '&s55=' + s55 + '&s56=' + s56 + '&s57=' + s57 + '&s58=' + s58 + '&s59=' + s59 + '&s50=' + s50 + '&s61=' + s61 + '&s62=' + s62 + '&s63=' + s63 + '&s64=' + s64 + '&s65=' + s65 + '&s66=' + s66 + '&s67=' + s67 + '&s68=' + s68 + '&s69=' + s69 + '&s60=' + s60 + '&chk_sp=' + chk_sp + '&sp_w_sur_1=' + sp_w_sur_1 + '&sp_w_sur_2=' + sp_w_sur_2 + '&sp_w_sur_3=' + sp_w_sur_3 + '&sp_w_sur_4=' + sp_w_sur_4 + '&sp_w_sur_5=' + sp_w_sur_5 + '&sp_w_sur_6=' + sp_w_sur_6 + '&sp_w_s_1=' + sp_w_s_1 + '&sp_w_s_2=' + sp_w_s_2 + '&sp_w_s_3=' + sp_w_s_3 + '&sp_w_s_4=' + sp_w_s_4 + '&sp_w_s_5=' + sp_w_s_5 + '&sp_w_s_6=' + sp_w_s_6 + '&taken_1=' + taken_1 + '&taken_2=' + taken_2 + '&sp_wt_st_1=' + sp_wt_st_1 + '&sp_wt_st_2=' + sp_wt_st_2 + '&sp_wt_st_3=' + sp_wt_st_3 + '&sp_wt_st_4=' + sp_wt_st_4 + '&sp_wt_st_5=' + sp_wt_st_5 + '&sp_wt_st_6=' + sp_wt_st_6 + '&sp_agg1=' + sp_agg1 + '&sp_agg2=' + sp_agg2 + '&sp_agg3=' + sp_agg3 + '&sp_agg4=' + sp_agg4 + '&sp_agg5=' + sp_agg5 + '&sp_agg6=' + sp_agg6 + '&sp_wat1=' + sp_wat1 + '&sp_wat2=' + sp_wat2 + '&sp_wat3=' + sp_wat3 + '&sp_wat4=' + sp_wat4 + '&sp_wat5=' + sp_wat5 + '&sp_wat6=' + sp_wat6 + '&sp_specific_gravity=' + sp_specific_gravity + '&sp_specific_gravity_1=' + sp_specific_gravity_1 + '&sp_specific_gravity_2=' + sp_specific_gravity_2 + '&sp_specific_gravity_3=' + sp_specific_gravity_3 + '&sp_water_abr=' + sp_water_abr + '&sp_water_abr_1=' + sp_water_abr_1 + '&sp_water_abr_2=' + sp_water_abr_2 + '&sp_water_abr_3=' + sp_water_abr_3 + '&chk_abr=' + chk_abr + '&abr_index=' + abr_index + '&abr_wt_t_a_1=' + abr_wt_t_a_1 + '&abr_wt_t_a_2=' + abr_wt_t_a_2 + '&abr_wt_t_b_1=' + abr_wt_t_b_1 + '&abr_wt_t_b_2=' + abr_wt_t_b_2 + '&abr_wt_t_c_1=' + abr_wt_t_c_1 + '&abr_wt_t_c_2=' + abr_wt_t_c_2 + '&abr_1=' + abr_1 + '&abr_2=' + abr_2 + '&abr_grading=' + abr_grading + '&abr_weight_charge=' + abr_weight_charge + '&abr_sphere=' + abr_sphere + '&abr_num_revo=' + abr_num_revo + '&chk_alkali=' + chk_alkali + '&alk_1=' + alk_1 + '&alk_2=' + alk_2 + '&alk_3=' + alk_3 + '&alk_4=' + alk_4 + '&alk_5=' + alk_5 + '&alk_6=' + alk_6 + '&alk_7=' + alk_7 + '&alk_8=' + alk_8 + '&alk_9=' + alk_9 + '&alk_10=' + alk_10 + '&alk_11=' + alk_11 + '&chk_den=' + chk_den + '&m11=' + m11 + '&m12=' + m12 + '&m13=' + m13 + '&m21=' + m21 + '&m22=' + m22 + '&m23=' + m23 + '&m31=' + m31 + '&m32=' + m32 + '&m33=' + m33 + '&avg_wom=' + avg_wom + '&vol=' + vol + '&bdl=' + bdl + '&chk_crushing=' + chk_crushing + '&cru_value=' + cru_value + '&cr_a_1=' + cr_a_1 + '&cr_a_2=' + cr_a_2 + '&cr_b_1=' + cr_b_1 + '&cr_b_2=' + cr_b_2 + '&cru_value_1=' + cru_value_1 + '&cru_value_2=' + cru_value_2 + '&chk_fines=' + chk_fines + '&fines_value=' + fines_value + '&f_a_1=' + f_a_1 + '&f_a_2=' + f_a_2 + '&f_b_1=' + f_b_1 + '&f_b_2=' + f_b_2 + '&f_c_1=' + f_c_1 + '&f_c_2=' + f_c_2 + '&f_d_1=' + f_d_1 + '&f_d_2=' + f_d_2 + '&avg_f_d=' + avg_f_d + '&avg_f_c=' + avg_f_c + '&chk_flk=' + chk_flk + '&fi_index=' + fi_index + '&sp_specific_gravity_b2=' + sp_specific_gravity_b2 + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&a4=' + a4 + '&a5=' + a5 + '&a6=' + a6 + '&a7=' + a7 + '&a8=' + a8 + '&a9=' + a9 + '&suma=' + suma + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&b4=' + b4 + '&b5=' + b5 + '&b6=' + b6 + '&b7=' + b7 + '&b8=' + b8 + '&b9=' + b9 + '&s11=' + s11 + '&s12=' + s12 + '&s13=' + s13 + '&s14=' + s14 + '&s15=' + s15 + '&s16=' + s16 + '&s17=' + s17 + '&s18=' + s18 + '&s19=' + s19 + '&ei_index=' + ei_index + '&aa1=' + aa1 + '&aa2=' + aa2 + '&aa3=' + aa3 + '&aa4=' + aa4 + '&aa5=' + aa5 + '&aa6=' + aa6 + '&aa7=' + aa7 + '&aa8=' + aa8 + '&aa9=' + aa9 + '&dd1=' + dd1 + '&dd2=' + dd2 + '&dd3=' + dd3 + '&dd4=' + dd4 + '&dd5=' + dd5 + '&dd6=' + dd6 + '&dd7=' + dd7 + '&dd8=' + dd8 + '&dd9=' + dd9 + '&x1=' + x1 + '&x2=' + x2 + '&x3=' + x3 + '&x4=' + x4 + '&x5=' + x5 + '&x6=' + x6 + '&x7=' + x7 + '&x8=' + x8 + '&x9=' + x9 + '&sumx=' + sumx + '&y1=' + y1 + '&y2=' + y2 + '&y3=' + y3 + '&y4=' + y4 + '&y5=' + y5 + '&y6=' + y6 + '&y7=' + y7 + '&y8=' + y8 + '&y9=' + y9 + '&sumy=' + sumy + '&combined_index=' + combined_index + '&sumb=' + sumb + '&sumaa=' + sumaa + '&sumdd=' + sumdd + '&chk_grd=' + chk_grd + '&sieve_1=' + sieve_1 + '&sieve_2=' + sieve_2 + '&sieve_3=' + sieve_3 + '&sieve_4=' + sieve_4 + '&cum_wt_gm_1=' + cum_wt_gm_1 + '&cum_wt_gm_2=' + cum_wt_gm_2 + '&cum_wt_gm_3=' + cum_wt_gm_3 + '&cum_wt_gm_4=' + cum_wt_gm_4 + '&cum_wt_gm_5=' + cum_wt_gm_5 + '&cum_wt_gm_6=' + cum_wt_gm_6 + '&cum_wt_gm_7=' + cum_wt_gm_7 + '&cum_wt_gm_8=' + cum_wt_gm_8 + '&cum_wt_gm_9=' + cum_wt_gm_9 + '&cum_wt_gm_10=' + cum_wt_gm_10 + '&cum_wt_gm_11=' + cum_wt_gm_11 + '&cum_wt_gm_12=' + cum_wt_gm_12 + '&cum_wt_gm_13=' + cum_wt_gm_13 + '&ret_wt_gm_1=' + ret_wt_gm_1 + '&ret_wt_gm_2=' + ret_wt_gm_2 + '&ret_wt_gm_3=' + ret_wt_gm_3 + '&ret_wt_gm_4=' + ret_wt_gm_4 + '&ret_wt_gm_5=' + ret_wt_gm_5 + '&ret_wt_gm_6=' + ret_wt_gm_6 + '&ret_wt_gm_7=' + ret_wt_gm_7 + '&ret_wt_gm_8=' + ret_wt_gm_8 + '&ret_wt_gm_9=' + ret_wt_gm_9 + '&ret_wt_gm_10=' + ret_wt_gm_10 + '&ret_wt_gm_11=' + ret_wt_gm_11 + '&ret_wt_gm_12=' + ret_wt_gm_12 + '&ret_wt_gm_13=' + ret_wt_gm_13 + '&cum_ret_1=' + cum_ret_1 + '&cum_ret_2=' + cum_ret_2 + '&cum_ret_3=' + cum_ret_3 + '&cum_ret_4=' + cum_ret_4 + '&cum_ret_5=' + cum_ret_5 + '&cum_ret_6=' + cum_ret_6 + '&cum_ret_7=' + cum_ret_7 + '&cum_ret_8=' + cum_ret_8 + '&cum_ret_9=' + cum_ret_9 + '&cum_ret_10=' + cum_ret_10 + '&cum_ret_11=' + cum_ret_11 + '&cum_ret_12=' + cum_ret_12 + '&cum_ret_13=' + cum_ret_13 + '&pass_sample_1=' + pass_sample_1 + '&pass_sample_2=' + pass_sample_2 + '&pass_sample_3=' + pass_sample_3 + '&pass_sample_4=' + pass_sample_4 + '&pass_sample_5=' + pass_sample_5 + '&pass_sample_6=' + pass_sample_6 + '&pass_sample_7=' + pass_sample_7 + '&pass_sample_8=' + pass_sample_8 + '&pass_sample_9=' + pass_sample_9 + '&pass_sample_10=' + pass_sample_10 + '&pass_sample_11=' + pass_sample_11 + '&pass_sample_12=' + pass_sample_12 + '&pass_sample_13=' + pass_sample_13 + '&blank_extra=' + blank_extra + '&blank_extra1=' + blank_extra1 + '&blank_extra2=' + blank_extra2 + '&blank_extra3=' + blank_extra3 + '&sample_taken=' + sample_taken + '&chk_impact=' + chk_impact + '&imp_w_m_a_1=' + imp_w_m_a_1 + '&imp_w_m_a_2=' + imp_w_m_a_2 + '&imp_w_m_b_1=' + imp_w_m_b_1 + '&imp_w_m_b_2=' + imp_w_m_b_2 + '&imp_w_m_c_1=' + imp_w_m_c_1 + '&imp_w_m_c_2=' + imp_w_m_c_2 + '&imp_value_1=' + imp_value_1 + '&imp_value_2=' + imp_value_2 + '&imp_value=' + imp_value + '&chk_ll=' + chk_ll + '&pen1=' + pen1 + '&pen2=' + pen2 + '&pen3=' + pen3 + '&pen4=' + pen4 + '&cont1=' + cont1 + '&cont2=' + cont2 + '&cont3=' + cont3 + '&cont4=' + cont4 + '&wc1=' + wc1 + '&wc2=' + wc2 + '&wc3=' + wc3 + '&wc4=' + wc4 + '&od1=' + od1 + '&od2=' + od2 + '&od3=' + od3 + '&od4=' + od4 + '&ww1=' + ww1 + '&ww2=' + ww2 + '&ww3=' + ww3 + '&ww4=' + ww4 + '&wf1=' + wf1 + '&wf2=' + wf2 + '&wf3=' + wf3 + '&wf4=' + wf4 + '&ds1=' + ds1 + '&ds2=' + ds2 + '&ds3=' + ds3 + '&ds4=' + ds4 + '&mo1=' + mo1 + '&mo2=' + mo2 + '&mo3=' + mo3 + '&mo4=' + mo4 + '&ln1=' + ln1 + '&ln2=' + ln2 + '&ln3=' + ln3 + '&ln4=' + ln4 + '&avg_ll=' + avg_ll + '&avg_pl=' + avg_pl + '&plastic_limit=' + plastic_limit + '&pi_value=' + pi_value + '&liquide_limit=' + liquide_limit + '&ulr=' + ulr + '&chk_pha=' + chk_pha + '&ph_s1_1=' + ph_s1_1 + '&ph_s1_2=' + ph_s1_2 + '&ph_s2_1=' + ph_s2_1 + '&ph_s2_2=' + ph_s2_2 + '&avg_ph=' + avg_ph + '&chk_clr=' + chk_clr + '&clr_s1_1=' + clr_s1_1 + '&clr_s1_2=' + clr_s1_2 + '&clr_s1_3=' + clr_s1_3 + '&clr_s1_4=' + clr_s1_4 + '&clr_s1_5=' + clr_s1_5 + '&clr_s1_6=' + clr_s1_6 + '&clr_s1_7=' + clr_s1_7 + '&clr_s2_1=' + clr_s2_1 + '&clr_s2_2=' + clr_s2_2 + '&clr_s2_3=' + clr_s2_3 + '&clr_s2_4=' + clr_s2_4 + '&clr_s2_5=' + clr_s2_5 + '&clr_s2_6=' + clr_s2_6 + '&clr_s2_7=' + clr_s2_7 + '&avg_clr=' + avg_clr + '&chk_slp=' + chk_slp + '&slp_s1_1=' + slp_s1_1 + '&slp_s1_2=' + slp_s1_2 + '&slp_s1_3=' + slp_s1_3 + '&slp_s1_4=' + slp_s1_4 + '&slp_s1_5=' + slp_s1_5 + '&slp_s2_1=' + slp_s2_1 + '&slp_s2_2=' + slp_s2_2 + '&slp_s2_3=' + slp_s2_3 + '&slp_s2_4=' + slp_s2_4 + '&slp_s2_5=' + slp_s2_5 + '&avg_sul=' + avg_sul + '&chk_dtm=' + chk_dtm + '&dele_1_1=' + dele_1_1 + '&dele_1_2=' + dele_1_2 + '&dele_1_3=' + dele_1_3 + '&dele_1_4=' + dele_1_4 + '&dele_2_1=' + dele_2_1 + '&dele_2_2=' + dele_2_2 + '&dele_2_3=' + dele_2_3 + '&dele_3_1=' + dele_3_1 + '&dele_3_2=' + dele_3_2 + '&dele_3_3=' + dele_3_3 + '&dele_4_1=' + dele_4_1 + '&dele_4_2=' + dele_4_2 + '&dele_4_3=' + dele_4_3 + '&chk_aoi=' + chk_aoi + '&aoi_1=' + aoi_1 + '&aoi_2=' + aoi_2 + '&aoi_3=' + aoi_3 + '&aoi_4=' + aoi_4 + '&fi_index1=' + fi_index1 + '&s1=' + s1 + '&s2=' + s2 + '&s3=' + s3 + '&s4=' + s4 + '&s5=' + s5 + '&s6=' + s6 + '&s7=' + s7 + '&p1=' + p1 + '&p2=' + p2 + '&p3=' + p3 + '&p4=' + p4 + '&p5=' + p5 + '&p6=' + p6 + '&p7=' + p7 + '&pp1=' + pp1 + '&pp2=' + pp2 + '&pp3=' + pp3 + '&pp4=' + pp4 + '&pp5=' + pp5 + '&pp6=' + pp6 + '&pp7=' + pp7 + '&m1=' + m1 + '&m2=' + m2 + '&m3=' + m3 + '&m4=' + m4 + '&m5=' + m5 + '&m6=' + m6 + '&m7=' + m7 + '&w1=' + w1 + '&w2=' + w2 + '&w3=' + w3 + '&w4=' + w4 + '&w5=' + w5 + '&w6=' + w6 + '&w7=' + w7 + '&suma1=' + suma1 + '&suma2=' + suma2 + '&sumdd1=' + sumdd1;
			} else {
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
			}

			$.ajax({
				type: 'POST',
				url: '<?php echo $base_url; ?>save_20.php',
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
				url: '<?php echo $base_url; ?>save_20.php',
				data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
				success: function(data) {
					$('#idEdit').val(data.id);
					var idEdit = $('#idEdit').val();
					$('#report_no').val(data.report_no);
					$('#job_no').val(data.job_no);
					$('#lab_no').val(data.lab_no);
					$('#ulr').val(data.ulr);

					var temp = $('#test_list').val();
					var aa = temp.split(",");

					//PH
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "pha") {
							var chk_pha = data.chk_pha;
							if (chk_pha == "1") {
								$('#txtpha').css("background-color", "var(--success)");
								$("#chk_pha").prop("checked", true);
							} else {
								$('#txtpha').css("background-color", "white");
								$("#chk_pha").prop("checked", false);
							}
							$('#ph_s1_1').val(data.ph_s1_1);
							$('#ph_s1_2').val(data.ph_s1_2);
							$('#ph_s2_1').val(data.ph_s2_1);
							$('#ph_s2_2').val(data.ph_s2_2);
							$('#avg_ph').val(data.avg_ph);
							break;
						} else {

						}
					}

					//aoi
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "aoi") {
							var chk_aoi = data.chk_aoi;
							if (chk_aoi == "1") {
								$('#txtaoi').css("background-color", "var(--success)");
								$("#chk_aoi").prop("checked", true);
							} else {
								$('#txtaoi').css("background-color", "white");
								$("#chk_aoi").prop("checked", false);
							}
							$('#aoi_1').val(data.aoi_1);
							$('#aoi_2').val(data.aoi_2);
							$('#aoi_3').val(data.aoi_3);
							$('#aoi_4').val(data.aoi_4);

							break;
						} else {

						}
					}

					//clr
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "clr") {
							var chk_clr = data.chk_clr;
							if (chk_clr == "1") {
								$('#txtclr').css("background-color", "var(--success)");
								$("#chk_clr").prop("checked", true);
							} else {
								$('#txtclr').css("background-color", "white");
								$("#chk_clr").prop("checked", false);
							}
							$('#clr_s1_1').val(data.clr_s1_1);
							$('#clr_s1_2').val(data.clr_s1_2);
							$('#clr_s1_3').val(data.clr_s1_3);
							$('#clr_s1_4').val(data.clr_s1_4);
							$('#clr_s1_5').val(data.clr_s1_5);
							$('#clr_s1_6').val(data.clr_s1_6);
							$('#clr_s1_7').val(data.clr_s1_7);
							$('#clr_s2_1').val(data.clr_s2_1);
							$('#clr_s2_2').val(data.clr_s2_2);
							$('#clr_s2_3').val(data.clr_s2_3);
							$('#clr_s2_4').val(data.clr_s2_4);
							$('#clr_s2_5').val(data.clr_s2_5);
							$('#clr_s2_6').val(data.clr_s2_6);
							$('#clr_s2_7').val(data.clr_s2_7);
							$('#av_clr').val(data.avg_clr);
							break;
						} else {

						}
					}

					//spl
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "slp") {
							var chk_slp = data.chk_slp;
							if (chk_slp == "1") {
								$('#txtslp').css("background-color", "var(--success)");
								$("#chk_slp").prop("checked", true);
							} else {
								$('#txtslp').css("background-color", "white");
								$("#chk_slp").prop("checked", false);
							}
							$('#slp_s1_1').val(data.slp_s1_1);
							$('#slp_s1_2').val(data.slp_s1_2);
							$('#slp_s1_3').val(data.slp_s1_3);
							$('#slp_s1_4').val(data.slp_s1_4);
							$('#slp_s1_5').val(data.slp_s1_5);
							$('#slp_s2_1').val(data.slp_s2_1);
							$('#slp_s2_2').val(data.slp_s2_2);
							$('#slp_s2_3').val(data.slp_s2_3);
							$('#slp_s2_4').val(data.slp_s2_4);
							$('#slp_s2_5').val(data.slp_s2_5);
							$('#avg_sul').val(data.avg_sul);
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

					//soundness
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "sou") {
							//SOUNDNESS
							$('#soundness').val(data.soundness);
							$('#s6total').val(data.s6total);
							$('#s31').val(data.s31);
							$('#s32').val(data.s32);
							$('#s33').val(data.s33);
							$('#s34').val(data.s34);
							$('#s35').val(data.s35);
							$('#s36').val(data.s36);
							$('#s37').val(data.s37);
							$('#s38').val(data.s38);
							$('#s39').val(data.s39);
							$('#s30').val(data.s30);

							$('#s41').val(data.s41);
							$('#s42').val(data.s42);
							$('#s43').val(data.s43);
							$('#s44').val(data.s44);
							$('#s45').val(data.s45);
							$('#s46').val(data.s46);
							$('#s47').val(data.s47);
							$('#s48').val(data.s48);
							$('#s49').val(data.s49);
							$('#s40').val(data.s40);

							$('#s51').val(data.s51);
							$('#s52').val(data.s52);
							$('#s53').val(data.s53);
							$('#s54').val(data.s54);
							$('#s55').val(data.s55);
							$('#s56').val(data.s56);
							$('#s57').val(data.s57);
							$('#s58').val(data.s58);
							$('#s59').val(data.s59);
							$('#s50').val(data.s50);

							$('#s61').val(data.s61);
							$('#s62').val(data.s62);
							$('#s63').val(data.s63);
							$('#s64').val(data.s64);
							$('#s65').val(data.s65);
							$('#s66').val(data.s66);
							$('#s67').val(data.s67);
							$('#s68').val(data.s68);
							$('#s69').val(data.s69);
							$('#s60').val(data.s60);


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
							$('#sp_w_sur_1').val(data.sp_w_sur_1);
							$('#sp_w_sur_2').val(data.sp_w_sur_2);
							$('#sp_w_sur_3').val(data.sp_w_sur_3);
							$('#sp_w_sur_4').val(data.sp_w_sur_4);
							$('#sp_w_sur_5').val(data.sp_w_sur_5);
							$('#sp_w_sur_6').val(data.sp_w_sur_6);
							$('#sp_w_s_1').val(data.sp_w_s_1);
							$('#sp_w_s_2').val(data.sp_w_s_2);
							$('#sp_w_s_3').val(data.sp_w_s_3);
							$('#sp_w_s_4').val(data.sp_w_s_4);
							$('#sp_w_s_5').val(data.sp_w_s_5);
							$('#sp_w_s_6').val(data.sp_w_s_6);
							$('#sp_wt_st_1').val(data.sp_wt_st_1);
							$('#sp_wt_st_2').val(data.sp_wt_st_2);
							$('#sp_wt_st_3').val(data.sp_wt_st_3);
							$('#sp_wt_st_4').val(data.sp_wt_st_4);
							$('#sp_wt_st_5').val(data.sp_wt_st_5);
							$('#sp_wt_st_6').val(data.sp_wt_st_6);
							$('#taken_1').val(data.taken_1);
							$('#taken_2').val(data.taken_2);
							$('#sp_agg1').val(data.sp_agg1);
							$('#sp_agg2').val(data.sp_agg2);
							$('#sp_agg3').val(data.sp_agg3);
							$('#sp_agg4').val(data.sp_agg4);
							$('#sp_agg5').val(data.sp_agg5);
							$('#sp_agg6').val(data.sp_agg6);
							$('#sp_wat1').val(data.sp_wat1);
							$('#sp_wat2').val(data.sp_wat2);
							$('#sp_wat3').val(data.sp_wat3);
							$('#sp_wat4').val(data.sp_wat4);
							$('#sp_wat5').val(data.sp_wat5);
							$('#sp_wat6').val(data.sp_wat6);
							$('#sp_specific_gravity_b2').val(data.sp_specific_gravity_b2);
							$('#sp_specific_gravity_1').val(data.sp_specific_gravity_1);
							$('#sp_specific_gravity_2').val(data.sp_specific_gravity_2);
							$('#sp_specific_gravity_3').val(data.sp_specific_gravity_3);
							$('#sp_specific_gravity').val(data.sp_specific_gravity);
							$('#sp_water_abr').val(data.sp_water_abr);
							$('#sp_water_abr_1').val(data.sp_water_abr_1);
							$('#sp_water_abr_2').val(data.sp_water_abr_2);
							$('#sp_water_abr_3').val(data.sp_water_abr_3);

							break;
						} else {

						}

					}

					//ABRASION
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "abr") {
							$('#abr_index').val(data.abr_index);
							$('#abr_wt_t_a_1').val(data.abr_wt_t_a_1);
							$('#abr_wt_t_b_1').val(data.abr_wt_t_b_1);
							$('#abr_wt_t_c_1').val(data.abr_wt_t_c_1);
							$('#abr_wt_t_a_2').val(data.abr_wt_t_a_2);
							$('#abr_wt_t_b_2').val(data.abr_wt_t_b_2);
							$('#abr_wt_t_c_2').val(data.abr_wt_t_c_2);
							$('#abr_1').val(data.abr_1);
							$('#abr_2').val(data.abr_2);
							$('#abr_grading').val(data.abr_grading);
							$('#abr_weight_charge').val(data.abr_weight_charge);
							$('#abr_num_revo').val(data.abr_num_revo);
							$('#abr_sphere').val(data.abr_sphere);

							var chk_abr = data.chk_abr;
							if (chk_abr == "1") {
								$('#txtabr').css("background-color", "var(--success)");
								$("#chk_abr").prop("checked", true);
							} else {
								$('#txtabr').css("background-color", "white");
								$("#chk_abr").prop("checked", false);
							}
							break;
						} else {

						}
					}
					//ALKALI REACTION
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "alk") {
							$('#alk_1').val(data.alk_1);
							$('#alk_2').val(data.alk_2);
							$('#alk_3').val(data.alk_3);
							$('#alk_4').val(data.alk_4);
							$('#alk_5').val(data.alk_5);
							$('#alk_6').val(data.alk_6);
							$('#alk_7').val(data.alk_7);
							$('#alk_8').val(data.alk_8);
							$('#alk_9').val(data.alk_9);
							$('#alk_10').val(data.alk_10);
							$('#alk_11').val(data.alk_11);
							var chk_alkali = data.chk_alkali;
							if (chk_alkali == "1") {
								$('#txtalk').css("background-color", "var(--success)");
								$("#chk_alkali").prop("checked", true);
							} else {
								$('#txtalk').css("background-color", "white");
								$("#chk_alkali").prop("checked", false);
							}
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
							$('#m31').val(data.m31);
							$('#m32').val(data.m32);
							$('#m33').val(data.m33);
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
					//crushing
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "cru") {
							$('#cr_a_1').val(data.cr_a_1);
							$('#cr_a_2').val(data.cr_a_2);
							$('#cr_b_1').val(data.cr_b_1);
							$('#cr_b_2').val(data.cr_b_2);
							$('#cru_value_1').val(data.cru_value_1);
							$('#cru_value_2').val(data.cru_value_2);
							$('#cru_value').val(data.cru_value);

							var chk_crushing = data.chk_crushing;
							if (chk_crushing == "1") {
								$('#txtcru').css("background-color", "var(--success)");
								$("#chk_crushing").prop("checked", true);
							} else {
								$('#txtcru').css("background-color", "white");
								$("#chk_crushing").prop("checked", false);
							}
							break;
						} else {

						}
					}
					//FINES
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "fin") {
							$('#fines_value').val(data.fines_value);
							var chk_fines = data.chk_fines;
							if (chk_fines == "1") {
								$('#txtfin').css("background-color", "var(--success)");
								$("#chk_fines").prop("checked", true);
							} else {
								$('#txtfin').css("background-color", "white");
								$("#chk_fines").prop("checked", false);
							}
							$('#fines_value').val(data.fines_value);
							$('#f_a_1').val(data.f_a_1);
							$('#f_a_2').val(data.f_a_2);
							$('#f_b_1').val(data.f_b_1);
							$('#f_b_2').val(data.f_b_2);
							$('#f_c_1').val(data.f_c_1);
							$('#f_c_2').val(data.f_c_2);
							$('#f_d_1').val(data.f_d_1);
							$('#f_d_2').val(data.f_d_2);
							$('#avg_f_c').val(data.avg_f_c);
							$('#avg_f_d').val(data.avg_f_d);
							break;
						} else {

						}
					}
					//flakiness
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "flk") {


							$('#fi_index').val(data.fi_index);
							$('#s1').val(data.s1);
							$('#s2').val(data.s2);
							$('#s3').val(data.s3);
							$('#s4').val(data.s4);
							$('#s5').val(data.s5);
							$('#s6').val(data.s6);
							$('#s7').val(data.s7);
							$('#suma1').val(data.suma1);
							$('#suma2').val(data.suma2);


							$('#m1').val(data.m1);
							$('#m2').val(data.m2);
							$('#m3').val(data.m3);
							$('#m4').val(data.m4);
							$('#m5').val(data.m5);
							$('#m6').val(data.m6);
							$('#m7').val(data.m7);

							$('#p1').val(data.p1);
							$('#p2').val(data.p2);
							$('#p3').val(data.p3);
							$('#p4').val(data.p4);
							$('#p5').val(data.p5);
							$('#p6').val(data.p6);
							$('#p7').val(data.p7);

							$('#pp1').val(data.pp1);
							$('#pp2').val(data.pp2);
							$('#pp3').val(data.pp3);
							$('#pp4').val(data.pp4);
							$('#pp5').val(data.pp5);
							$('#pp6').val(data.pp6);
							$('#pp7').val(data.pp7);

							$('#w1').val(data.w1);
							$('#w2').val(data.w2);
							$('#w3').val(data.w3);
							$('#w4').val(data.w4);
							$('#w5').val(data.w5);
							$('#w6').val(data.w6);
							$('#w7').val(data.w7);
							$('#sumdd1').val(data.sumdd1);
							$('#fi_index1').val(data.fi_index1);

							$('#a1').val(data.a1);
							$('#a2').val(data.a2);
							$('#a3').val(data.a3);
							$('#a4').val(data.a4);
							$('#a5').val(data.a5);
							$('#a6').val(data.a6);
							$('#a7').val(data.a7);
							$('#a8').val(data.a8);
							$('#a9').val(data.a9);
							$('#suma').val(data.suma);

							$('#b1').val(data.b1);
							$('#b2').val(data.b2);
							$('#b3').val(data.b3);
							$('#b4').val(data.b4);
							$('#b5').val(data.b5);
							$('#b6').val(data.b6);
							$('#b7').val(data.b7);
							$('#b8').val(data.b8);
							$('#b9').val(data.b9);
							$('#sumb').val(data.sumb);

							$('#ei_index').val(data.ei_index);

							$('#aa1').val(data.aa1);
							$('#aa2').val(data.aa2);
							$('#aa3').val(data.aa3);
							$('#aa4').val(data.aa4);
							$('#aa5').val(data.aa5);
							$('#aa6').val(data.aa6);
							$('#aa7').val(data.aa7);
							$('#aa8').val(data.aa8);
							$('#aa9').val(data.aa9);
							$('#sumaa').val(data.sumaa);

							$('#dd1').val(data.dd1);
							$('#dd2').val(data.dd2);
							$('#dd3').val(data.dd3);
							$('#dd4').val(data.dd4);
							$('#dd5').val(data.dd5);
							$('#dd6').val(data.dd6);
							$('#dd7').val(data.dd7);
							$('#dd8').val(data.dd8);
							$('#dd9').val(data.dd9);
							$('#sumdd').val(data.sumdd);

							$('#x1').val(data.x1);
							$('#x2').val(data.x2);
							$('#x3').val(data.x3);
							$('#x4').val(data.x4);
							$('#x5').val(data.x5);
							$('#x6').val(data.x6);
							$('#x7').val(data.x7);
							$('#x8').val(data.x8);
							$('#x9').val(data.x9);
							$('#sumx').val(data.sumx);

							$('#y1').val(data.y1);
							$('#y2').val(data.y2);
							$('#y3').val(data.y3);
							$('#y4').val(data.y4);
							$('#y5').val(data.y5);
							$('#y6').val(data.y6);
							$('#y7').val(data.y7);
							$('#y8').val(data.y8);
							$('#y9').val(data.y9);
							$('#sumy').val(data.sumy);

							$('#combined_index').val(data.combined_index);

							$('#s11').val(data.s11);
							$('#s12').val(data.s12);
							$('#s13').val(data.s13);
							$('#s14').val(data.s14);
							$('#s15').val(data.s15);
							$('#s16').val(data.s16);
							$('#s17').val(data.s17);
							$('#s18').val(data.s18);
							$('#s19').val(data.s19);

							var chk_flk = data.chk_flk;
							if (chk_flk == "1") {
								$('#txtflk').css("background-color", "var(--success)");
								$("#chk_flk").prop("checked", true);
							} else {
								$('#txtflk').css("background-color", "white");
								$("#chk_flk").prop("checked", false);
							}
							break;
						} else {

						}

					}
					//GRADATION
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "grd") {

							var chk_grd = data.chk_grd;
							if (chk_grd == "1") {
								$('#txtgrd').css("background-color", "var(--success)");
								$("#chk_grd").prop("checked", true);
							} else {
								$('#txtgrd').css("background-color", "white");
								$("#chk_grd").prop("checked", false);
							}
							//GRADATION DATA FETCH-1
							$('#sample_taken').val(data.sample_taken);

							$('#cum_wt_gm_1').val(data.cum_wt_gm_1);
							$('#cum_wt_gm_2').val(data.cum_wt_gm_2);
							$('#cum_wt_gm_3').val(data.cum_wt_gm_3);
							$('#cum_wt_gm_4').val(data.cum_wt_gm_4);
							$('#cum_wt_gm_5').val(data.cum_wt_gm_5);
							$('#cum_wt_gm_6').val(data.cum_wt_gm_6);
							$('#cum_wt_gm_7').val(data.cum_wt_gm_7);
							$('#cum_wt_gm_8').val(data.cum_wt_gm_8);
							$('#cum_wt_gm_9').val(data.cum_wt_gm_9);
							$('#cum_wt_gm_10').val(data.cum_wt_gm_10);
							$('#cum_wt_gm_11').val(data.cum_wt_gm_11);
							$('#cum_wt_gm_12').val(data.cum_wt_gm_12);
							$('#cum_wt_gm_13').val(data.cum_wt_gm_13);

							$('#ret_wt_gm_1').val(data.ret_wt_gm_1);
							$('#ret_wt_gm_2').val(data.ret_wt_gm_2);
							$('#ret_wt_gm_3').val(data.ret_wt_gm_3);
							$('#ret_wt_gm_4').val(data.ret_wt_gm_4);
							$('#ret_wt_gm_5').val(data.ret_wt_gm_5);
							$('#ret_wt_gm_6').val(data.ret_wt_gm_6);
							$('#ret_wt_gm_7').val(data.ret_wt_gm_7);
							$('#ret_wt_gm_8').val(data.ret_wt_gm_8);
							$('#ret_wt_gm_9').val(data.ret_wt_gm_9);
							$('#ret_wt_gm_10').val(data.ret_wt_gm_10);
							$('#ret_wt_gm_11').val(data.ret_wt_gm_11);
							$('#ret_wt_gm_12').val(data.ret_wt_gm_12);
							$('#ret_wt_gm_13').val(data.ret_wt_gm_13);


							$('#cum_ret_1').val(data.cum_ret_1);
							$('#cum_ret_2').val(data.cum_ret_2);
							$('#cum_ret_3').val(data.cum_ret_3);
							$('#cum_ret_4').val(data.cum_ret_4);
							$('#cum_ret_5').val(data.cum_ret_5);
							$('#cum_ret_6').val(data.cum_ret_6);
							$('#cum_ret_7').val(data.cum_ret_7);
							$('#cum_ret_8').val(data.cum_ret_8);
							$('#cum_ret_9').val(data.cum_ret_9);
							$('#cum_ret_10').val(data.cum_ret_10);
							$('#cum_ret_11').val(data.cum_ret_11);
							$('#cum_ret_12').val(data.cum_ret_12);
							$('#cum_ret_13').val(data.cum_ret_13);


							$('#pass_sample_1').val(data.pass_sample_1);
							$('#pass_sample_2').val(data.pass_sample_2);
							$('#pass_sample_3').val(data.pass_sample_3);
							$('#pass_sample_4').val(data.pass_sample_4);
							$('#pass_sample_5').val(data.pass_sample_5);
							$('#pass_sample_6').val(data.pass_sample_6);
							$('#pass_sample_7').val(data.pass_sample_7);
							$('#pass_sample_8').val(data.pass_sample_8);
							$('#pass_sample_9').val(data.pass_sample_9);
							$('#pass_sample_10').val(data.pass_sample_10);
							$('#pass_sample_11').val(data.pass_sample_11);
							$('#pass_sample_12').val(data.pass_sample_12);
							$('#pass_sample_13').val(data.pass_sample_13);


							$('#blank_extra').val(data.blank_extra);
							$('#blank_extra1').val(data.blank_extra1);
							$('#blank_extra2').val(data.blank_extra2);
							$('#blank_extra3').val(data.blank_extra3);

							sieve_1 = data.sieve_1;
							sieve_2 = data.sieve_2;
							sieve_3 = data.sieve_3;
							sieve_4 = data.sieve_4;

							break;
						} else {

						}

					}

					//impact
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "imp") {

							//impact value
							$('#imp_w_m_a_1').val(data.imp_w_m_a_1);
							$('#imp_w_m_a_2').val(data.imp_w_m_a_2);
							$('#imp_w_m_b_1').val(data.imp_w_m_b_1);
							$('#imp_w_m_b_2').val(data.imp_w_m_b_2);
							$('#imp_w_m_c_1').val(data.imp_w_m_c_1);
							$('#imp_w_m_c_2').val(data.imp_w_m_c_2);
							$('#imp_value_1').val(data.imp_value_1);
							$('#imp_value_2').val(data.imp_value_2);
							$('#imp_value').val(data.imp_value);

							var chk_impact = data.chk_impact;
							if (chk_impact == "1") {
								$('#txtimp').css("background-color", "var(--success)");
								$("#chk_impact").prop("checked", true);
							} else {
								$('#txtimp').css("background-color", "white");
								$("#chk_impact").prop("checked", false);
							}
							break;
						} else {

						}

					}

					//LIQUIDE LIMIT AND PLASTICITY VALUE
					for (var i = 0; i < aa.length; i++) {
						if (aa[i] == "lll") { //ll and pl

							var chk_ll = data.chk_ll;
							if (chk_ll == "1") {
								$('#txtlll').css("background-color", "var(--success)");
								$("#chk_ll").prop("checked", true);
							} else {
								$('#txtlll').css("background-color", "white");
								$("#chk_ll").prop("checked", false);
							}
							$('#pen1').val(data.pen1);
							$('#pen2').val(data.pen2);
							$('#pen3').val(data.pen3);
							$('#pen4').val(data.pen4);

							$('#cont1').val(data.cont1);
							$('#cont2').val(data.cont2);
							$('#cont3').val(data.cont3);
							$('#cont4').val(data.cont4);

							$('#wc1').val(data.wc1);
							$('#wc2').val(data.wc2);
							$('#wc3').val(data.wc3);
							$('#wc4').val(data.wc4);

							$('#od1').val(data.od1);
							$('#od2').val(data.od2);
							$('#od3').val(data.od3);
							$('#od4').val(data.od4);

							$('#ww1').val(data.ww1);
							$('#ww2').val(data.ww2);
							$('#ww3').val(data.ww3);
							$('#ww4').val(data.ww4);

							$('#wf1').val(data.wf1);
							$('#wf2').val(data.wf2);
							$('#wf3').val(data.wf3);
							$('#wf4').val(data.wf4);

							$('#ds1').val(data.ds1);
							$('#ds2').val(data.ds2);
							$('#ds3').val(data.ds3);
							$('#ds4').val(data.ds4);

							$('#mo1').val(data.mo1);
							$('#mo2').val(data.mo2);
							$('#mo3').val(data.mo3);
							$('#mo4').val(data.mo4);

							$('#ln1').val(data.ln1);
							$('#ln2').val(data.ln2);
							$('#ln3').val(data.ln3);
							$('#ln4').val(data.ln4);


							$('#plastic_limit').val(data.plastic_limit);
							$('#pi_value').val(data.pi_value);
							$('#liquide_limit').val(data.liquide_limit);
							$('#avg_ll').val(data.avg_ll);
							$('#avg_pl').val(data.avg_pl);



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