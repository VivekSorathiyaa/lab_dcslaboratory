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
						<h2 style="text-align:center;">BITUMINOUS CONCRETE TEST</h2>
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
										$querys_job1 = "SELECT * FROM bitumin_con WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
									// if ($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type'] == "direct_nabl" || $_SESSION['nabl_type'] == "direct_non_nabl") {
									?>
										<div class="col-sm-2">
											<a target='_blank' href="<?php echo $base_url; ?>print_report/report_bitumin_con.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>

									<?php// } ?>
									<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/back_bitumin_con.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
											
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

									if ($r1['test_code'] == "bic") {

										$test_check .= "bic,";
								?>
										<div class="panel panel-default" id="bic">
											<div class="panel-heading" id="txtbic">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
														<h4 class="panel-title">
															<b>BINDER CONTENT TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse1" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_bic">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_bic" id="chk_bic" value="chk_bic"><br>
																</div>
																<label for="inputEmail3" class="col-sm-6 control-label label-right">BINDER CONTENT TEST</label>
															</div>
														</div>
													</div>

													<br>

													
													<br>
													<div class="row">
														<div class="col-md-12">
															
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Sr.No</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight of Mix<br>(w1) gm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Initial Weight of Filter Paper<br>(F) gm</label>
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight of Aggregate After Extraction<br>(w2) gm</label>
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight of Aggregate After Extraction with Fine Materials<br>(w3) gm</label>
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Increased Weight of Filter<br>(w4 = w3 - F)</label>
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight of Binder<br>(w5 = w1 - (w2+w4))</label>
																</div>
															</div> 
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Binder Content<br>(w5/w1*100)</label>
																</div>
															</div> 
														</div>

													</div>
													
													<br>
													<div class="row">
														<div class="col-md-12">
															
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_srn_1" name="bit_srn_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w1_1" name="bit_w1_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_f_1" name="bit_f_1">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w2_1" name="bit_w2_1">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w3_1" name="bit_w3_1">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w4_1" name="bit_w4_1" ReadOnly>
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w5_1" name="bit_w5_1" ReadOnly>
																</div>
															</div> 
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_bc_1" name="bit_bc_1" ReadOnly>
																</div>
															</div> 
														</div>

													</div>
													
													<br>
													<div class="row">
														<div class="col-md-12">
															
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_srn_2" name="bit_srn_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w1_2" name="bit_w1_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_f_2" name="bit_f_2">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w2_2" name="bit_w2_2">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w3_2" name="bit_w3_2">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w4_2" name="bit_w4_2" ReadOnly>
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w5_2" name="bit_w5_2" ReadOnly>
																</div>
															</div> 
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_bc_2" name="bit_bc_2" ReadOnly>
																</div>
															</div> 
														</div>

													</div>
													
													<br>
													<div class="row">
														<div class="col-md-12">
															
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_srn_3" name="bit_srn_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w1_3" name="bit_w1_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_f_3" name="bit_f_3">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w2_3" name="bit_w2_3">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w3_3" name="bit_w3_3">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w4_3" name="bit_w4_3" ReadOnly>
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w5_3" name="bit_w5_3" ReadOnly>
																</div>
															</div> 
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_bc_3" name="bit_bc_3" ReadOnly>
																</div>
															</div> 
														</div>

													</div>
													
													<br>
													<div class="row">
														<div class="col-md-12">
															
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_srn_4" name="bit_srn_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w1_4" name="bit_w1_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_f_4" name="bit_f_4">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w2_4" name="bit_w2_4">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w3_4" name="bit_w3_4">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w4_4" name="bit_w4_4" ReadOnly>
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w5_4" name="bit_w5_4" ReadOnly>
																</div>
															</div> 
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_bc_4" name="bit_bc_4" ReadOnly>
																</div>
															</div> 
														</div>

													</div>
													
													<br>
													<div class="row">
														<div class="col-md-12">
															
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_srn_5" name="bit_srn_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w1_5" name="bit_w1_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_f_5" name="bit_f_5">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w2_5" name="bit_w2_5">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w3_5" name="bit_w3_5">
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w4_5" name="bit_w4_5" ReadOnly>
																</div>
															</div> 
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_w5_5" name="bit_w5_5" ReadOnly>
																</div>
															</div> 
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bit_bc_5" name="bit_bc_5" ReadOnly>
																</div>
															</div> 
														</div>

													
													
													</div>
													
																										
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

									if ($r1['test_code'] == "den") {

										$test_check .= "den,";
								?>
										<div class="panel panel-default" id="den">
											<div class="panel-heading" id="txtden">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
														<h4 class="panel-title">
															<b>DENSITY TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse2" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_den">2.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_den" id="chk_den" value="chk_den"><br>
																</div>
																<label for="inputEmail3" class="col-sm-6 control-label label-right">DENSITY TEST</label>
															</div>
														</div>
													</div>

													<br>

													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Description</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">I</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">II</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">III</label>
																</div>
															</div>
														</div>

													</div>
<br>

                                                    <div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">location / Chainage</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="s1" name="s1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="s2" name="s2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="s3" name="s3">
																</div>
															</div>
														</div>

													</div>

<br>

                                                    <div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Thickness (mm)</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="t1" name="t1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="t2" name="t2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="t3" name="t3">
																</div>
															</div>
														</div>

													</div>

<br>

                                                    <div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Wt. in Air (g)</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="a1" name="a1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="a2" name="a2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="a3" name="a3">
																</div>
															</div>
														</div>

													</div>

<br>

                                                    <div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Wt. in Water (g)</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="b1" name="b1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="b2" name="b2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="b3" name="b3">
																</div>
															</div>
														</div>

													</div>

<br>

                                                    <div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">S.S.D. Wt. (g)</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="c1" name="c1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="c2" name="c2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="c3" name="c3">
																</div>
															</div>
														</div>

													</div>

<br>

                                                    <div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Volume in cc</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="d1" name="d1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="d2" name="d2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="d3" name="d3">
																</div>
															</div>
														</div>

													</div>


                                                    

													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Density</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="den_1" name="den_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="den_2" name="den_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="den_3" name="den_3">
																</div>
															</div>
														</div>

													</div>

                                                    


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

									if ($r1['test_code'] == "mas") {

										$test_check .= "mas,";
								?>
										<div class="panel panel-default" id="mas">
											<div class="panel-heading" id="txtmas">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
														<h4 class="panel-title">
															<b>MARSHALL STABILITY TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse3" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_mas">3.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_mas" id="chk_mas" value="chk_mas"><br>
																</div>
																<label for="inputEmail3" class="col-sm-6 control-label label-right">MARSHALL STABILITY TEST</label>
															</div>
														</div>
													</div>

													<br>

													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Description</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">I</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">II</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">III</label>
																</div>
															</div>
														</div>

													</div>

													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Marshall Stability</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ms_1" name="ms_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ms_2" name="ms_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ms_3" name="ms_3">
																</div>
															</div>
														</div>

													</div>
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
												$query = "select * from bitumin_con WHERE lab_no='$aa'  and `is_deleted`='0'";

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

		/* $('#caste_date1,#caste_date2,#caste_date3,#test_date1,#test_date2,#test_date3').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
	});
	 */
         function bct_auto() {
			 
			$('#txtbic').css("background-color", "var(--success)");
			var bit_srn_1 = $('#bit_srn_1').val(randomNumberFromRange(1,10).toFixed(2));
			var bit_srn_2 = $('#bit_srn_2').val(randomNumberFromRange(1,10).toFixed(2));
			var bit_srn_3 = $('#bit_srn_3').val(randomNumberFromRange(1,10).toFixed(2));
			var bit_srn_4 = $('#bit_srn_4').val(randomNumberFromRange(1,10).toFixed(2));
			var bit_srn_5 = $('#bit_srn_5').val(randomNumberFromRange(1,10).toFixed(2));
			
			var bit_w1_1 = $('#bit_w1_1').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w1_2 = $('#bit_w1_2').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w1_3 = $('#bit_w1_3').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w1_4 = $('#bit_w1_4').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w1_5 = $('#bit_w1_5').val(randomNumberFromRange(10,20).toFixed(2));
			
			var bit_f_1 = $('#bit_f_1').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_f_2 = $('#bit_f_2').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_f_3 = $('#bit_f_3').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_f_4 = $('#bit_f_4').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_f_5 = $('#bit_f_5').val(randomNumberFromRange(10,20).toFixed(2));
			
			var bit_w2_1 = $('#bit_w2_1').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w2_2 = $('#bit_w2_2').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w2_3 = $('#bit_w2_3').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w2_4 = $('#bit_w2_4').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w2_5 = $('#bit_w2_5').val(randomNumberFromRange(10,20).toFixed(2));
			
			var bit_w3_1 = $('#bit_w3_1').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w3_2 = $('#bit_w3_2').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w3_3 = $('#bit_w3_3').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w3_4 = $('#bit_w3_4').val(randomNumberFromRange(10,20).toFixed(2));
			var bit_w3_5 = $('#bit_w3_5').val(randomNumberFromRange(10,20).toFixed(2)); 
			
			var bit_w4_1 = $('#bit_w3_1').val() - $('#bit_f_1').val();
			var bit_w4_2 = $('#bit_w3_2').val() - $('#bit_f_2').val();
			var bit_w4_3 = $('#bit_w3_3').val() - $('#bit_f_3').val();
			var bit_w4_4 = $('#bit_w3_4').val() - $('#bit_f_4').val();
			var bit_w4_5 = $('#bit_w3_5').val() - $('#bit_f_5').val();
			
			$('#bit_w4_1').val(+bit_w4_1.toFixed());
            $('#bit_w4_2').val(+bit_w4_2.toFixed());
            $('#bit_w4_3').val(+bit_w4_3.toFixed());
            $('#bit_w4_4').val(+bit_w4_4.toFixed());
            $('#bit_w4_5').val(+bit_w4_5.toFixed());
			
			var bit_w5_1 = $('#bit_w1_1').val() - ($('#bit_w2_1').val() + $('#bit_w4_1').val());
			var bit_w5_2 = $('#bit_w1_2').val() - ($('#bit_w2_2').val() + $('#bit_w4_2').val());
			var bit_w5_3 = $('#bit_w1_3').val() - ($('#bit_w2_3').val() + $('#bit_w4_3').val());
			var bit_w5_4 = $('#bit_w1_4').val() - ($('#bit_w2_4').val() + $('#bit_w4_4').val());
			var bit_w5_5 = $('#bit_w1_5').val() - ($('#bit_w2_5').val() + $('#bit_w4_5').val());
			
			
			$('#bit_w5_1').val(+bit_w5_1.toFixed());
            $('#bit_w5_2').val(+bit_w5_2.toFixed());
            $('#bit_w5_3').val(+bit_w5_3.toFixed());
            $('#bit_w5_4').val(+bit_w5_4.toFixed());
            $('#bit_w5_5').val(+bit_w5_5.toFixed());
			
			var bit_bc_1 = $('#bit_w5_1').val() / $('#bit_w1_1').val() * 100;
			var bit_bc_2 = $('#bit_w5_2').val() / $('#bit_w1_2').val() * 100;
			var bit_bc_3 = $('#bit_w5_3').val() / $('#bit_w1_3').val() * 100;
			var bit_bc_4 = $('#bit_w5_4').val() / $('#bit_w1_4').val() * 100;
			var bit_bc_5 = $('#bit_w5_5').val() / $('#bit_w1_5').val() * 100;
			
			$('#bit_bc_1').val(bit_bc_1.toFixed());
			$('#bit_bc_2').val(bit_bc_2.toFixed());
			$('#bit_bc_3').val(bit_bc_3.toFixed());
			$('#bit_bc_4').val(bit_bc_4.toFixed());
			$('#bit_bc_5').val(bit_bc_5.toFixed());
			
			
		}
		


		$('#chk_mas').change(function() {
			if (this.checked) {
				$('#txtmas').css("background-color", "var(--success)");
				
				var ms_1 = $('#ms_1').val(randomNumberFromRange(10,20).toFixed(2));
				var ms_2 = $('#ms_2').val(randomNumberFromRange(10,20).toFixed(2));
				var ms_3 = $('#ms_3').val(randomNumberFromRange(10,20).toFixed(2));
				
			} else {
				$('#txtmas').css("background-color", "white");

                 $('#ms_1').val(null);
                 $('#ms_2').val(null);
                 $('#ms_3').val(null);
			}

		});
		 $('#chk_bic').change(function() {
			if (this.checked) {
				bct_auto();
			} else {
				$('#txtbic').css("background-color", "white");
				
				$('#bit_srn_1').val(null);
			    $('#bit_srn_2').val(null);
			    $('#bit_srn_3').val(null);
			    $('#bit_srn_4').val(null);
			    $('#bit_srn_5').val(null);
			    
			    $('#bit_w1_1').val(null);
			    $('#bit_w1_2').val(null);
			    $('#bit_w1_3').val(null);
			    $('#bit_w1_4').val(null);
			    $('#bit_w1_5').val(null);
			    
			    $('#bit_f_1').val(null);
			    $('#bit_f_2').val(null);
			    $('#bit_f_3').val(null);
			    $('#bit_f_4').val(null);
			    $('#bit_f_5').val(null);
			    
			    $('#bit_w2_1').val(null);
			    $('#bit_w2_2').val(null);
			    $('#bit_w2_3').val(null);
			    $('#bit_w2_4').val(null);
			    $('#bit_w2_5').val(null);
			    
			    $('#bit_w3_1').val(null);
			    $('#bit_w3_2').val(null);
			    $('#bit_w3_3').val(null);
			    $('#bit_w3_4').val(null);
			    $('#bit_w3_5').val(null);
			    
			    $('#bit_w4_1').val(null);
			    $('#bit_w4_2').val(null);
			    $('#bit_w4_3').val(null);
			    $('#bit_w4_4').val(null);
			    $('#bit_w4_5').val(null);
			        
			    $('#bit_w5_1').val(null);
			    $('#bit_w5_2').val(null);
			    $('#bit_w5_3').val(null);
			    $('#bit_w5_4').val(null);
			    $('#bit_w5_5').val(null);
			    
			    $('#bit_bc_1').val(null);
			    $('#bit_bc_2').val(null);
			    $('#bit_bc_3').val(null);
			    $('#bit_bc_4').val(null);
			    $('#bit_bc_5').val(null);
			}

		}); 
		
		$('#chk_den').change(function() {
			if (this.checked) {
				$('#txtden').css("background-color", "var(--success)");
				
				var den_1 = $('#den_1').val(randomNumberFromRange(10,20).toFixed(2));
				var den_2 = $('#den_2').val(randomNumberFromRange(10,20).toFixed(2));
				var den_3 = $('#den_3').val(randomNumberFromRange(10,20).toFixed(2));

                var s1 = $('#s1').val(randomNumberFromRange(10,20).toFixed(2));
				var s2 = $('#s2').val(randomNumberFromRange(10,20).toFixed(2));
				var s3 = $('#s3').val(randomNumberFromRange(10,20).toFixed(2));
                
                var a1 = $('#a1').val(randomNumberFromRange(10,20).toFixed(2));
				var a2 = $('#a2').val(randomNumberFromRange(10,20).toFixed(2));
				var a3 = $('#a3').val(randomNumberFromRange(10,20).toFixed(2));

                var b1 = $('#b1').val(randomNumberFromRange(10,20).toFixed(2));
				var b2 = $('#b2').val(randomNumberFromRange(10,20).toFixed(2));
				var b3 = $('#b3').val(randomNumberFromRange(10,20).toFixed(2)); 

                var c1 = $('#c1').val(randomNumberFromRange(10,20).toFixed(2));
				var c2 = $('#c2').val(randomNumberFromRange(10,20).toFixed(2));
				var c3 = $('#c3').val(randomNumberFromRange(10,20).toFixed(2)); 

                var d1 = $('#d1').val(randomNumberFromRange(10,20).toFixed(2));
				var d2 = $('#d2').val(randomNumberFromRange(10,20).toFixed(2));
				var d3 = $('#d3').val(randomNumberFromRange(10,20).toFixed(2)); 

                var t1 = $('#t1').val(randomNumberFromRange(10,20).toFixed(2));
				var t2 = $('#t2').val(randomNumberFromRange(10,20).toFixed(2));
				var t3 = $('#t3').val(randomNumberFromRange(10,20).toFixed(2)); 
				
			} else {
				$('#txtden').css("background-color", "white");

                 $('#den_1').val(null);
                 $('#den_2').val(null);
                 $('#den_3').val(null);

                 $('#s1').val(null);
				 $('#s2').val(null);
				 $('#s3').val(null);
							  
                 $('#a1').val(null);
				 $('#a2').val(null);
				 $('#a3').val(null);
							 
                 $('#b1').val(null);
				 $('#b2').val(null);
				 $('#b3').val(null); 
							  
                 $('#c1').val(null);
				 $('#c2').val(null);
				 $('#c3').val(null); 
							 
                 $('#d1').val(null);
				 $('#d2').val(null);
				 $('#d3').val(null); 

                 $('#t1').val(null);
				 $('#t2').val(null);
				 $('#t3').val(null); 
 			}

		});
		
		
		$('#bit_srn_1,#bit_srn_2,#bit_srn_3,#bit_srn_4,#bit_srn_5,#bit_w1_1,#bit_w1_2,#bit_w1_3,#bit_w1_4,#bit_w1_5,#bit_f_1,#bit_f_2,#bit_f_3,#bit_f_4,#bit_f_5,#bit_w2_1,#bit_w2_2,#bit_w2_3,#bit_w2_4,#bit_w2_5,#bit_w3_1,#bit_w3_2,#bit_w3_3,#bit_w3_4,#bit_w3_5').change(function() {
			
			var bit_srn_1 = $('#bit_srn_1').val();
			var bit_srn_2 = $('#bit_srn_2').val();
			var bit_srn_3 = $('#bit_srn_3').val();
			var bit_srn_4 = $('#bit_srn_4').val();
			var bit_srn_5 = $('#bit_srn_5').val();
			
			var bit_w1_1 = $('#bit_w1_1').val();
			var bit_w1_2 = $('#bit_w1_2').val();
			var bit_w1_3 = $('#bit_w1_3').val();
			var bit_w1_4 = $('#bit_w1_4').val();
			var bit_w1_5 = $('#bit_w1_5').val();
			
			var bit_f_1 = $('#bit_f_1').val();
			var bit_f_2 = $('#bit_f_2').val();
			var bit_f_3 = $('#bit_f_3').val();
			var bit_f_4 = $('#bit_f_4').val();
			var bit_f_5 = $('#bit_f_5').val();
			
			var bit_w2_1 = $('#bit_w2_1').val();
			var bit_w2_2 = $('#bit_w2_2').val();
			var bit_w2_3 = $('#bit_w2_3').val();
			var bit_w2_4 = $('#bit_w2_4').val();
			var bit_w2_5 = $('#bit_w2_5').val();
			
			var bit_w3_1 = $('#bit_w3_1').val();
			var bit_w3_2 = $('#bit_w3_2').val();
			var bit_w3_3 = $('#bit_w3_3').val();
			var bit_w3_4 = $('#bit_w3_4').val();
			var bit_w3_5 = $('#bit_w3_5').val();
			
			var bit_w4_1 = (+bit_w3_1) - (+bit_f_1);
			var bit_w4_2 = (+bit_w3_2) - (+bit_f_2);
			var bit_w4_3 = (+bit_w3_3) - (+bit_f_3);
			var bit_w4_4 = (+bit_w3_4) - (+bit_f_4);
			var bit_w4_5 = (+bit_w3_5) - (+bit_f_5);
			
			$('#bit_w4_1').val(+bit_w4_1.toFixed());
            $('#bit_w4_2').val(+bit_w4_2.toFixed());
            $('#bit_w4_3').val(+bit_w4_3.toFixed());
            $('#bit_w4_4').val(+bit_w4_4.toFixed());
            $('#bit_w4_5').val(+bit_w4_5.toFixed());
			
			var bit_w5_1 = (+bit_w1_1) - ((+bit_w2_1) + (+bit_w4_1));
			var bit_w5_2 = (+bit_w1_2) - ((+bit_w2_2) + (+bit_w4_2));
			var bit_w5_3 = (+bit_w1_3) - ((+bit_w2_3) + (+bit_w4_3));
			var bit_w5_4 = (+bit_w1_4) - ((+bit_w2_4) + (+bit_w4_4));
			var bit_w5_5 = (+bit_w1_5) - ((+bit_w2_5) + (+bit_w4_5));
			
			$('#bit_w5_1').val(bit_w5_1.toFixed());
			$('#bit_w5_2').val(bit_w5_2.toFixed());
			$('#bit_w5_3').val(bit_w5_3.toFixed());
			$('#bit_w5_4').val(bit_w5_4.toFixed());
			$('#bit_w5_5').val(bit_w5_5.toFixed());
			
			var bit_bc_1 = (+bit_w5_1) / (+bit_w1_1) * 100;
			var bit_bc_2 = (+bit_w5_2) / (+bit_w1_2) * 100;
			var bit_bc_3 = (+bit_w5_3) / (+bit_w1_3) * 100;
			var bit_bc_4 = (+bit_w5_4) / (+bit_w1_4) * 100;
			var bit_bc_5 = (+bit_w5_5) / (+bit_w1_5) * 100;
			
			$('#bit_bc_1').val(bit_bc_1.toFixed());
			$('#bit_bc_2').val(bit_bc_2.toFixed());
			$('#bit_bc_3').val(bit_bc_3.toFixed());
			$('#bit_bc_4').val(bit_bc_4.toFixed());
			$('#bit_bc_5').val(bit_bc_5.toFixed());
			
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
				//$('#txtbic').css("background-color","var(--success)"); 


				var temp = $('#test_list').val();
				var temp = $('#temp').val();
				var aa = temp.split(",");
				//mas
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "mas") {
						$('#txtmas').css("background-color", "var(--success)");
						$("#chk_mas").prop("checked", true);
						chk_auto();
						break;
					}
				}
				//bic
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "bic") {
						
						$("#chk_bic").prop("checked", true);
						bct_auto();
						break;
					}
				}
				//den
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "den") {
						$('#txtden').css("background-color", "var(--success)");
						$("#chk_den").prop("checked", true);
						chk_auto();
						break;
					}
				}




			}

		});

		/* $('#chk_bic').change(function() {
			if (this.checked) {
                
			} else {
				$('#bic_1').val(80);
				$('#den_1').val(45);
				$('#den_2').val(50);
				$('#den_3').val(60);
				$('#ms_1').val(85);
				$('#ms_2').val(55);
				$('#ms_3').val(96);

			}
		}); */

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
			url: '<?php echo $base_url; ?>save_bitumin_con.php',
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
			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//mas
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "mas") {
					if (document.getElementById('chk_mas').checked) {
						var chk_mas = "1";
					} else {
						var chk_mas = "0";
					}

					var ms_1 = $('#ms_1').val();
					var ms_2 = $('#ms_2').val();
					var ms_3 = $('#ms_3').val();

					break;
				} else {
					var ms_1 = "0";
					var ms_2 = "0";
					var ms_3 = "0";
				}

			}

			//bic
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "bic") {
					if (document.getElementById('chk_bic').checked) {
						var chk_bic = "1";
					} else {
						var chk_bic = "0";
					}
                    
					var bic_1 = $('#bic_1').val();
					var bit_srn_1 = $('#bit_srn_1').val();
			        var bit_srn_2 = $('#bit_srn_2').val();
			        var bit_srn_3 = $('#bit_srn_3').val();
			        var bit_srn_4 = $('#bit_srn_4').val();
			        var bit_srn_5 = $('#bit_srn_5').val();
			        
			        var bit_w1_1 = $('#bit_w1_1').val();
			        var bit_w1_2 = $('#bit_w1_2').val();
			        var bit_w1_3 = $('#bit_w1_3').val();
			        var bit_w1_4 = $('#bit_w1_4').val();
			        var bit_w1_5 = $('#bit_w1_5').val();
			        
			        var bit_f_1 = $('#bit_f_1').val();
			        var bit_f_2 = $('#bit_f_2').val();
			        var bit_f_3 = $('#bit_f_3').val();
			        var bit_f_4 = $('#bit_f_4').val();
			        var bit_f_5 = $('#bit_f_5').val();
			        
			        var bit_w2_1 = $('#bit_w2_1').val();
			        var bit_w2_2 = $('#bit_w2_2').val();
			        var bit_w2_3 = $('#bit_w2_3').val();
			        var bit_w2_4 = $('#bit_w2_4').val();
			        var bit_w2_5 = $('#bit_w2_5').val();
			        
			        var bit_w3_1 = $('#bit_w3_1').val();
			        var bit_w3_2 = $('#bit_w3_2').val();
			        var bit_w3_3 = $('#bit_w3_3').val();
			        var bit_w3_4 = $('#bit_w3_4').val();
			        var bit_w3_5 = $('#bit_w3_5').val();
			        
			        var bit_w4_1 = $('#bit_w4_1').val();
			        var bit_w4_2 = $('#bit_w4_2').val();
			        var bit_w4_3 = $('#bit_w4_3').val();
			        var bit_w4_4 = $('#bit_w4_4').val();
			        var bit_w4_5 = $('#bit_w4_5').val();
			        
			        var bit_w5_1 = $('#bit_w5_1').val();
			        var bit_w5_2 = $('#bit_w5_2').val();
			        var bit_w5_3 = $('#bit_w5_3').val();
			        var bit_w5_4 = $('#bit_w5_4').val();
			        var bit_w5_5 = $('#bit_w5_5').val();
			        
			        var bit_bc_1 = $('#bit_bc_1').val();
			        var bit_bc_2 = $('#bit_bc_2').val();
			        var bit_bc_3 = $('#bit_bc_3').val();
			        var bit_bc_4 = $('#bit_bc_4').val();
			        var bit_bc_5 = $('#bit_bc_5').val();
			        
					break;
				} else {
					
					var bic_1 = "";
					var bit_srn_1 = "";
			        var bit_srn_2 = "";
			        var bit_srn_3 = "";
			        var bit_srn_4 = "";
			        var bit_srn_5 = "";
			        
			        var bit_w1_1 = "";
			        var bit_w1_2 = "";
			        var bit_w1_3 = "";
			        var bit_w1_4 = "";
			        var bit_w1_5 = "";
			        
			        var bit_f_1 = "";
			        var bit_f_2 = "";
			        var bit_f_3 = "";
			        var bit_f_4 = "";
			        var bit_f_5 = "";
			        
			        var bit_w2_1 = "";
			        var bit_w2_2 = "";
			        var bit_w2_3 = "";
			        var bit_w2_4 = "";
			        var bit_w2_5 = "";
			        
			        var bit_w3_1 = "";
			        var bit_w3_2 = "";
			        var bit_w3_3 = "";
			        var bit_w3_4 = "";
			        var bit_w3_5 = "";
			        
			        var bit_w4_1 = "";
			        var bit_w4_2 = "";
			        var bit_w4_3 = "";
			        var bit_w4_4 = "";
			        var bit_w4_5 = "";
			        
			        var bit_w5_1 = "";
			        var bit_w5_2 = "";
			        var bit_w5_3 = "";
			        var bit_w5_4 = "";
			        var bit_w5_5 = "";
			        
			        var bit_bc_1 = "";
			        var bit_bc_2 = "";
			        var bit_bc_3 = "";
			        var bit_bc_4 = "";
			        var bit_bc_5 = "";
					
				}

			}

			//den
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "den") {
					if (document.getElementById('chk_den').checked) {
						var chk_den = "1";
					} else {
						var chk_den = "0";
					}

					var den_1 = $('#den_1').val();
					var den_2 = $('#den_2').val();
					var den_3 = $('#den_3').val();

                var s1 = $('#s1').val();
				var s2 = $('#s2').val();
				var s3 = $('#s3').val();
                
                var a1 = $('#a1').val();
				var a2 = $('#a2').val();
				var a3 = $('#a3').val();

                var b1 = $('#b1').val();
				var b2 = $('#b2').val();
				var b3 = $('#b3').val(); 

                var c1 = $('#c1').val();
				var c2 = $('#c2').val();
				var c3 = $('#c3').val(); 

                var d1 = $('#d1').val();
				var d2 = $('#d2').val();
				var d3 = $('#d3').val(); 

                var t1 = $('#t1').val();
				var t2 = $('#t2').val();
				var t3 = $('#t3').val(); 

					break;
				} else {
					var den_1 = "0";
					var den_2 = "0";
					var den_3 = "0";

                var s1 = "";
				var s2 = "";
				var s3 = "";
						
                var a1 = "";
				var a2 = "";
				var a3 = "";
						
                var b1 = "";
				var b2 = "";
				var b3 = ""; 
						
                var c1 = "";
				var c2 = "";
				var c3 = ""; 
						
                var d1 = "";
				var d2 = "";
				var d3 = "";
  
                var t1 = "";
				var t2 = "";
				var t3 = "";  

				}

			}






			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_mas=' + chk_mas + '&chk_bic=' + chk_bic + '&chk_den=' + chk_den + '&bic_1=' + bic_1 + '&ms_1=' + ms_1 + '&ms_2=' + ms_2 + '&ms_3=' + ms_3 + '&den_1=' + den_1 + '&den_2=' + den_2 + '&den_3=' + den_3 + '&ulr=' + ulr+ '&amend_date=' + amend_date + '&bit_srn_1=' + bit_srn_1 + '&bit_srn_2=' + bit_srn_2 + '&bit_srn_3=' + bit_srn_3 + '&bit_srn_4=' + bit_srn_4 + '&bit_srn_5=' + bit_srn_5 + '&bit_w1_1=' + bit_w1_1 + '&bit_w1_2=' + bit_w1_2 + '&bit_w1_3=' + bit_w1_3 + '&bit_w1_4=' + bit_w1_4 + '&bit_w1_5=' + bit_w1_5 + '&bit_f_1=' + bit_f_1 + '&bit_f_2=' + bit_f_2 + '&bit_f_3=' + bit_f_3 + '&bit_f_4=' + bit_f_4 + '&bit_f_5=' + bit_f_5 + '&bit_w2_1=' + bit_w2_1 + '&bit_w2_2=' + bit_w2_2 + '&bit_w2_3=' + bit_w2_3 + '&bit_w2_4=' + bit_w2_4 + '&bit_w2_5=' + bit_w2_5 + '&bit_w3_1=' + bit_w3_1 + '&bit_w3_2=' + bit_w3_2 + '&bit_w3_3=' + bit_w3_3 + '&bit_w3_4=' + bit_w3_4 + '&bit_w3_5=' + bit_w3_5 + '&bit_w4_1=' + bit_w4_1 + '&bit_w4_2=' + bit_w4_2 + '&bit_w4_3=' + bit_w4_3 + '&bit_w4_4=' + bit_w4_4 + '&bit_w4_5=' + bit_w4_5 + '&bit_w5_1=' + bit_w5_1 + '&bit_w5_2=' + bit_w5_2 + '&bit_w5_3=' + bit_w5_3 + '&bit_w5_4=' + bit_w5_4 + '&bit_w5_5=' + bit_w5_5 + '&bit_bc_1=' + bit_bc_1 + '&bit_bc_2=' + bit_bc_2 + '&bit_bc_3=' + bit_bc_3 + '&bit_bc_4=' + bit_bc_4 + '&bit_bc_5=' + bit_bc_5 + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&s1=' + s1 + '&s2=' + s2 + '&s3=' + s3 + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&c1=' + c1 + '&c2=' + c2 + '&c3=' + c3 + '&d1=' + d1 + '&d2=' + d2 + '&d3=' + d3 + '&t1=' + t1 + '&t2=' + t2 + '&t3=' + t3;

		} else if (type == 'edit') {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();

			var temp = $('#test_list').val();
			var room_temp = $('#room_temp').val();
			var aa = temp.split(",");

			//mas
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "mas") {
					if (document.getElementById('chk_mas').checked) {
						var chk_mas = "1";
					} else {
						var chk_mas = "0";
					}

					var ms_1 = $('#ms_1').val();
					var ms_2 = $('#ms_2').val();
					var ms_3 = $('#ms_3').val();

					break;
				} else {
					var ms_1 = "0";
					var ms_2 = "0";
					var ms_3 = "0";
				}

			}

			//bic
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "bic") {
					if (document.getElementById('chk_bic').checked) {
						var chk_bic = "1";
					} else {
						var chk_bic = "0";
					}
					
					
                    var bic_1 = $('#bic_1').val();
					var bit_srn_1 = $('#bit_srn_1').val();
			        var bit_srn_2 = $('#bit_srn_2').val();
			        var bit_srn_3 = $('#bit_srn_3').val();
			        var bit_srn_4 = $('#bit_srn_4').val();
			        var bit_srn_5 = $('#bit_srn_5').val();
			        
			        var bit_w1_1 = $('#bit_w1_1').val();
			        var bit_w1_2 = $('#bit_w1_2').val();
			        var bit_w1_3 = $('#bit_w1_3').val();
			        var bit_w1_4 = $('#bit_w1_4').val();
			        var bit_w1_5 = $('#bit_w1_5').val();
			        
			        var bit_f_1 = $('#bit_f_1').val();
			        var bit_f_2 = $('#bit_f_2').val();
			        var bit_f_3 = $('#bit_f_3').val();
			        var bit_f_4 = $('#bit_f_4').val();
			        var bit_f_5 = $('#bit_f_5').val();
			        
			        var bit_w2_1 = $('#bit_w2_1').val();
			        var bit_w2_2 = $('#bit_w2_2').val();
			        var bit_w2_3 = $('#bit_w2_3').val();
			        var bit_w2_4 = $('#bit_w2_4').val();
			        var bit_w2_5 = $('#bit_w2_5').val();
			        
			        var bit_w3_1 = $('#bit_w3_1').val();
			        var bit_w3_2 = $('#bit_w3_2').val();
			        var bit_w3_3 = $('#bit_w3_3').val();
			        var bit_w3_4 = $('#bit_w3_4').val();
			        var bit_w3_5 = $('#bit_w3_5').val();
			        
			        var bit_w4_1 = $('#bit_w4_1').val();
			        var bit_w4_2 = $('#bit_w4_2').val();
			        var bit_w4_3 = $('#bit_w4_3').val();
			        var bit_w4_4 = $('#bit_w4_4').val();
			        var bit_w4_5 = $('#bit_w4_5').val();
			        
			        var bit_w5_1 = $('#bit_w5_1').val();
			        var bit_w5_2 = $('#bit_w5_2').val();
			        var bit_w5_3 = $('#bit_w5_3').val();
			        var bit_w5_4 = $('#bit_w5_4').val();
			        var bit_w5_5 = $('#bit_w5_5').val();
			        
			        var bit_bc_1 = $('#bit_bc_1').val();
			        var bit_bc_2 = $('#bit_bc_2').val();
			        var bit_bc_3 = $('#bit_bc_3').val();
			        var bit_bc_4 = $('#bit_bc_4').val();
			        var bit_bc_5 = $('#bit_bc_5').val();
			        
					break;
				} else {
					
					var bic_1 = "";
					var bit_srn_1 = "";
			        var bit_srn_2 = "";
			        var bit_srn_3 = "";
			        var bit_srn_4 = "";
			        var bit_srn_5 = "";
			        
			        var bit_w1_1 = "";
			        var bit_w1_2 = "";
			        var bit_w1_3 = "";
			        var bit_w1_4 = "";
			        var bit_w1_5 = "";
			        
			        var bit_f_1 = "";
			        var bit_f_2 = "";
			        var bit_f_3 = "";
			        var bit_f_4 = "";
			        var bit_f_5 = "";
			        
			        var bit_w2_1 = "";
			        var bit_w2_2 = "";
			        var bit_w2_3 = "";
			        var bit_w2_4 = "";
			        var bit_w2_5 = "";
			        
			        var bit_w3_1 = "";
			        var bit_w3_2 = "";
			        var bit_w3_3 = "";
			        var bit_w3_4 = "";
			        var bit_w3_5 = "";
			        
			        var bit_w4_1 = "";
			        var bit_w4_2 = "";
			        var bit_w4_3 = "";
			        var bit_w4_4 = "";
			        var bit_w4_5 = "";
			        
			        var bit_w5_1 = "";
			        var bit_w5_2 = "";
			        var bit_w5_3 = "";
			        var bit_w5_4 = "";
			        var bit_w5_5 = "";
			        
			        var bit_bc_1 = "";
			        var bit_bc_2 = "";
			        var bit_bc_3 = "";
			        var bit_bc_4 = "";
			        var bit_bc_5 = "";
					
				}

			}



			//den
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "den") {
					if (document.getElementById('chk_den').checked) {
						var chk_den = "1";
					} else {
						var chk_den = "0";
					}

					var den_1 = $('#den_1').val();
					var den_2 = $('#den_2').val();
					var den_3 = $('#den_3').val();

                var s1 = $('#s1').val();
				var s2 = $('#s2').val();
				var s3 = $('#s3').val();
                
                var a1 = $('#a1').val();
				var a2 = $('#a2').val();
				var a3 = $('#a3').val();

                var b1 = $('#b1').val();
				var b2 = $('#b2').val();
				var b3 = $('#b3').val(); 

                var c1 = $('#c1').val();
				var c2 = $('#c2').val();
				var c3 = $('#c3').val(); 

                var d1 = $('#d1').val();
				var d2 = $('#d2').val();
				var d3 = $('#d3').val(); 

                var t1 = $('#t1').val();
				var t2 = $('#t2').val();
				var t3 = $('#t3').val(); 

					break;
				} else {
					var den_1 = "0";
					var den_2 = "0";
					var den_3 = "0";

                var s1 = "";
				var s2 = "";
				var s3 = "";
						
                var a1 = "";
				var a2 = "";
				var a3 = "";
						
                var b1 = "";
				var b2 = "";
				var b3 = ""; 
						
                var c1 = "";
				var c2 = "";
				var c3 = ""; 
						
                var d1 = "";
				var d2 = "";
				var d3 = "";  

                var t1 = "";
				var t2 = "";
				var t3 = "";  

				}

			}




			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_mas=' + chk_mas  + '&bic_1=' + bic_1 + '&ms_1=' + ms_1 + '&ms_2=' + ms_2 + '&ms_3=' + ms_3 + '&den_1=' + den_1 + '&den_2=' + den_2 + '&den_3=' + den_3 + '&ulr=' + ulr+ '&amend_date=' + amend_date + '&bit_srn_1=' + bit_srn_1 + '&bit_srn_2=' + bit_srn_2 + '&bit_srn_3=' + bit_srn_3 + '&bit_srn_4=' + bit_srn_4 + '&bit_srn_5=' + bit_srn_5 + '&bit_w1_1=' + bit_w1_1 + '&bit_w1_2=' + bit_w1_2 + '&bit_w1_3=' + bit_w1_3 + '&bit_w1_4=' + bit_w1_4 + '&bit_w1_5=' + bit_w1_5 + '&bit_f_1=' + bit_f_1 + '&bit_f_2=' + bit_f_2 + '&bit_f_3=' + bit_f_3 + '&bit_f_4=' + bit_f_4 + '&bit_f_5=' + bit_f_5 + '&bit_w2_1=' + bit_w2_1 + '&bit_w2_2=' + bit_w2_2 + '&bit_w2_3=' + bit_w2_3 + '&bit_w2_4=' + bit_w2_4 + '&bit_w2_5=' + bit_w2_5 + '&bit_w3_1=' + bit_w3_1 + '&bit_w3_2=' + bit_w3_2 + '&bit_w3_3=' + bit_w3_3 + '&bit_w3_4=' + bit_w3_4 + '&bit_w3_5=' + bit_w3_5 + '&bit_w4_1=' + bit_w4_1 + '&bit_w4_2=' + bit_w4_2 + '&bit_w4_3=' + bit_w4_3 + '&bit_w4_4=' + bit_w4_4 + '&bit_w4_5=' + bit_w4_5 + '&bit_w5_1=' + bit_w5_1 + '&bit_w5_2=' + bit_w5_2 + '&bit_w5_3=' + bit_w5_3 + '&bit_w5_4=' + bit_w5_4 + '&bit_w5_5=' + bit_w5_5 + '&bit_bc_1=' + bit_bc_1 + '&bit_bc_2=' + bit_bc_2 + '&bit_bc_3=' + bit_bc_3 + '&bit_bc_4=' + bit_bc_4 + '&bit_bc_5=' + bit_bc_5 + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&s1=' + s1 + '&s2=' + s2 + '&s3=' + s3 + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&c1=' + c1 + '&c2=' + c2 + '&c3=' + c3 + '&d1=' + d1 + '&d2=' + d2 + '&d3=' + d3 + '&t1=' + t1 + '&t2=' + t2 + '&t3=' + t3;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_bitumin_con.php',
			data: billData,
			dataType: 'html',
			success: function(msg) {
				console.log(lab_no);
				$('#btn_save').hide();
				getGlazedTiles();
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				//window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;
			}
		});
	}

function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}
	
	

	function editData(id) {
		var lab_no = $('#lab_no').val();
		var report_no = $('#report_no').val();
		var job_no = $('#job_no').val();
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: '<?php echo $base_url; ?>save_bitumin_con.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);
				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);
				$('#ulr').val(data.ulr);
				$('#amend_date').val(data.amend_date);

				var temp = $('#test_list').val();
				var room_temp = $('#room_temp').val();
				var aa = temp.split(",");
				
				//mas
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "mas") {

						var chk_mas = data.chk_mas;
						if (chk_mas == "1") {
							$('#txtmas').css("background-color", "var(--success)");
							$("#chk_mas").prop("checked", true);


						} else {
							$('#txtmas').css("background-color", "white");
							$("#chk_mas").prop("checked", false);

						}

						$('#ms_1').val(data.ms_1);
						$('#ms_2').val(data.ms_2);
						$('#ms_3').val(data.ms_3);
						
						console.log(data.ms_1);

						break;
					} else {

					}

				}

				//bic
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "bic") {

						var chk_bic = data.chk_bic;
						if (chk_bic == "1") {
							$('#txtbic').css("background-color", "var(--success)");
							$("#chk_bic").prop("checked", true);


						} else {
							$('#txtbic').css("background-color", "var(--success)");
							$("#chk_bic").prop("checked", false);

						}

						$('#bic_1').val(data.bic_1);
						
						 $('#bit_srn_1').val(data.bit_srn_1);
			             $('#bit_srn_2').val(data.bit_srn_2);
			             $('#bit_srn_3').val(data.bit_srn_3);
			             $('#bit_srn_4').val(data.bit_srn_4);
			             $('#bit_srn_5').val(data.bit_srn_5);
			             $('#bit_w1_1').val(data.bit_w1_1);
			             $('#bit_w1_2').val(data.bit_w1_2);
			             $('#bit_w1_3').val(data.bit_w1_3);
			             $('#bit_w1_4').val(data.bit_w1_4);
			             $('#bit_w1_5').val(data.bit_w1_5);
			             $('#bit_f_1').val(data.bit_f_1);
			             $('#bit_f_2').val(data.bit_f_2);
			             $('#bit_f_3').val(data.bit_f_3);
			             $('#bit_f_4').val(data.bit_f_4);
			             $('#bit_f_5').val(data.bit_f_5);
			             $('#bit_w2_1').val(data.bit_w2_1);
			             $('#bit_w2_2').val(data.bit_w2_2);
			             $('#bit_w2_3').val(data.bit_w2_3);
			             $('#bit_w2_4').val(data.bit_w2_4);
			             $('#bit_w2_5').val(data.bit_w2_5);
			             $('#bit_w3_1').val(data.bit_w3_1);
			             $('#bit_w3_2').val(data.bit_w3_2);
			             $('#bit_w3_3').val(data.bit_w3_3);
			             $('#bit_w3_4').val(data.bit_w3_4);
			             $('#bit_w3_5').val(data.bit_w3_5);
			             $('#bit_w4_1').val(data.bit_w4_1);
			             $('#bit_w4_2').val(data.bit_w4_2);
			             $('#bit_w4_3').val(data.bit_w4_3);
			             $('#bit_w4_4').val(data.bit_w4_4);
			             $('#bit_w4_5').val(data.bit_w4_5);
			             $('#bit_w5_1').val(data.bit_w5_1);
			             $('#bit_w5_2').val(data.bit_w5_2);
			             $('#bit_w5_3').val(data.bit_w5_3);
			             $('#bit_w5_4').val(data.bit_w5_4);
			             $('#bit_w5_5').val(data.bit_w5_5);
			             $('#bit_bc_1').val(data.bit_bc_1);
			             $('#bit_bc_2').val(data.bit_bc_2);
			             $('#bit_bc_3').val(data.bit_bc_3);
			             $('#bit_bc_4').val(data.bit_bc_4);
			             $('#bit_bc_5').val(data.bit_bc_5);


						break;
					} else {

					}

				}

				//den
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "den") {

						var chk_den = data.chk_den;
						if (chk_den == "1") {
							$('#txtden').css("background-color", "var(--success)");
							$("#chk_den").prop("checked", true);


						} else {
							$('#txtden').css("background-color", "var(--success)");
							$("#chk_den").prop("checked", false);

						}

						$('#den_1').val(data.den_1);
						$('#den_2').val(data.den_2);
						$('#den_3').val(data.den_3);

                        $('#s1').val(data.s1);
				        $('#s2').val(data.s2);
				        $('#s3').val(data.s3);
									
                        $('#a1').val(data.a1);
				        $('#a2').val(data.a2);
				        $('#a3').val(data.a3);
									
                        $('#b1').val(data.b1);
				        $('#b2').val(data.b2);
				        $('#b3').val(data.b3); 
									 
                        $('#c1').val(data.c1);
				        $('#c2').val(data.c2);
				        $('#c3').val(data.c3); 
									 
                        $('#d1').val(data.d1);
				        $('#d2').val(data.d2);
				        $('#d3').val(data.d3);  

                        $('#t1').val(data.t1);
				        $('#t2').val(data.t2);
				        $('#t3').val(data.t3);  

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