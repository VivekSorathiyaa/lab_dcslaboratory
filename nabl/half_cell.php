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
						<h2 style="text-align:center;">HALF CELL POTENTIAL TEST</h2>
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
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-5">
										<label for="chk_auto">TEMPERATURE :-</label>
										<input type="checkbox" class="visually-hidden" name="chk_auto" id="chk_auto" value="chk_auto">
									</div>
									<div class="col-sm-7">
										<input type="text" class="form-control inputs" tabindex="4" id="temp" name="temp">
									</div>
								</div>
							</div>
							<div class="col-lg-3">
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
										$querys_job1 = "SELECT * FROM half_cell WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
										<a target='_blank' href="<?php echo $base_url; ?>print_report/report_half_cell.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
									</div>

									<?php //} 
									?>
									<div class="col-sm-2">
										<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/back_half_cell.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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

									if ($r1['test_code'] == "hcp") {

										$test_check .= "hcp,";
								?>
										<div class="panel panel-default" id="hcp">
											<div class="panel-heading" id="txthcp">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
														<h4 class="panel-title">
															<b>HALF CELL POTENTIAL TEST</b>
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
																	<label for="chk_hcp">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_hcp" id="chk_hcp" value="chk_hcp"><br>
																</div>
																<label for="inputEmail3" class="col-sm-11 control-label label-right">HALF CELL POTENTIAL TEST</label>
															</div>
														</div>
														<!--div class="col-lg-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature :</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="hcp_temp" name="hcp_temp" >
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

													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Points</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">1</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">2</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">3</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">4</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">5</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">6</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">7</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">8</label>
																</div>
															</div>
														</div>

													</div>

													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Concrete Element location</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="loc_1" name="loc_1">
																</div>
															</div>
															<!--div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="loc_2" name="loc_2" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="loc_3" name="loc_3" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="loc_4" name="loc_4" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="loc_5" name="loc_5" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="loc_6" name="loc_6" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="loc_7" name="loc_7" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="loc_8" name="loc_8" >
										</div>
									</div-->

														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Measured Potential value (mV/CSE)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="val_1" name="val_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="val_2" name="val_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="val_3" name="val_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="val_4" name="val_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="val_5" name="val_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="val_6" name="val_6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="val_7" name="val_7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="val_8" name="val_8">
																</div>
															</div>

														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Chances of active steel corrosion</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_1" name="corr_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_2" name="corr_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_3" name="corr_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_4" name="corr_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_5" name="corr_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_6" name="corr_6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_7" name="corr_7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_8" name="corr_8">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Concrete Elements</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_1" name="con_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_2" name="con_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_3" name="con_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_4" name="con_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_5" name="con_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_6" name="con_6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_7" name="con_7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_8" name="con_8">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Voltmeter Reading,V CSE</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="volt_1" name="volt_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="volt_2" name="volt_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="volt_3" name="volt_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="volt_4" name="volt_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="volt_5" name="volt_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="volt_6" name="volt_6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="volt_7" name="volt_7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="volt_8" name="volt_8">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">REMARKS</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rem_1" name="rem_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rem_2" name="rem_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rem_3" name="rem_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rem_4" name="rem_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rem_5" name="rem_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rem_6" name="rem_6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rem_7" name="rem_7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="rem_8" name="rem_8">
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
												$query = "select * from half_cell WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	});
	$(document).ready(function() {
		$('#btn_edit_data').hide();
		$('#alert').hide();

		/* $('#caste_date1,#caste_date2,#caste_date3,#test_date1,#test_date2,#test_date3').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
	});
	 */



		$('#chk_hcp').change(function() {
			if (this.checked) {
				$('#txthcp').css("background-color", "var(--success)");
			} else {
				$('#txthcp').css("background-color", "white");
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


		function hcp_auto() {

			$('#txtcrb').css("background-color", "var(--success)");
			$('#loc_1').val(1);
			$('#val_1').val(1);
			$('#val_2').val(1);
			$('#val_3').val(1);
			$('#val_4').val(1);
			$('#val_5').val(1);
			$('#val_6').val(1);
			$('#val_7').val(1);
			$('#val_8').val(1);
			$('#corr_1').val(1);
			$('#corr_2').val(1);
			$('#corr_3').val(1);
			$('#corr_4').val(1);
			$('#corr_5').val(1);
			$('#corr_6').val(1);
			$('#corr_7').val(1);
			$('#corr_8').val(1);
			$('#con_1').val(1);
			$('#con_2').val(1);
			$('#con_3').val(1);
			$('#con_4').val(1);
			$('#con_5').val(1);
			$('#con_6').val(1);
			$('#con_7').val(1);
			$('#con_8').val(1);
			$('#volt_1').val(1);
			$('#volt_2').val(1);
			$('#volt_3').val(1);
			$('#volt_4').val(1);
			$('#volt_5').val(1);
			$('#volt_6').val(1);
			$('#volt_7').val(1);
			$('#volt_8').val(1);
			$('#rem_1').val(1);
			$('#rem_2').val(1);
			$('#rem_3').val(1);
			$('#rem_4').val(1);
			$('#rem_5').val(1);
			$('#rem_6').val(1);
			$('#rem_7').val(1);
			$('#rem_8').val(1);

		}

		$('#chk_hcp').change(function() {
			if (this.checked) {
				hcp_auto();
			} else {
				$('#loc_1').val(null);
				$('#val_1').val(null);
				$('#val_2').val(null);
				$('#val_3').val(null);
				$('#val_4').val(null);
				$('#val_5').val(null);
				$('#val_6').val(null);
				$('#val_7').val(null);
				$('#val_8').val(null);
				$('#corr_1').val(null);
				$('#corr_2').val(null);
				$('#corr_3').val(null);
				$('#corr_4').val(null);
				$('#corr_5').val(null);
				$('#corr_6').val(null);
				$('#corr_7').val(null);
				$('#corr_8').val(null);
				$('#con_1').val(null);
				$('#con_2').val(null);
				$('#con_3').val(null);
				$('#con_4').val(null);
				$('#con_5').val(null);
				$('#con_6').val(null);
				$('#con_7').val(null);
				$('#con_8').val(null);
				$('#volt_1').val(null);
				$('#volt_2').val(null);
				$('#volt_3').val(null);
				$('#volt_4').val(null);
				$('#volt_5').val(null);
				$('#volt_6').val(null);
				$('#volt_7').val(null);
				$('#volt_8').val(null);
				$('#rem_1').val(null);
				$('#rem_2').val(null);
				$('#rem_3').val(null);
				$('#rem_4').val(null);
				$('#rem_5').val(null);
				$('#rem_6').val(null);
				$('#rem_7').val(null);
				$('#rem_8').val(null);
			}
		});


		$('#chk_auto').change(function() {
			if (this.checked) {
				//$('#txtabr').css("background-color","var(--success)"); 
				//$('#txtwtr').css("background-color","var(--success)"); 


				var temp = $('#test_list').val();
				var temp = $('#temp').val();
				var aa = temp.split(",");
				//hcp
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "hcp") {
						$('#txthcp').css("background-color", "var(--success)");
						$("#chk_hcp").prop("checked", true);
						chk_auto();
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
			url: '<?php echo $base_url; ?>save_half_cell.php',
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

			//hcp
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "hcp") {
					if (document.getElementById('chk_hcp').checked) {
						var chk_hcp = "1";
					} else {
						var chk_hcp = "0";
					}
					var loc_1 = $('#loc_1').val();
					var loc_2 = $('#loc_2').val();
					var loc_3 = $('#loc_3').val();
					var loc_4 = $('#loc_4').val();
					var loc_5 = $('#loc_5').val();
					var loc_6 = $('#loc_6').val();
					var loc_7 = $('#loc_7').val();
					var loc_8 = $('#loc_8').val();
					var val_1 = $('#val_1').val();
					var val_2 = $('#val_2').val();
					var val_3 = $('#val_3').val();
					var val_4 = $('#val_4').val();
					var val_5 = $('#val_5').val();
					var val_6 = $('#val_6').val();
					var val_7 = $('#val_7').val();
					var val_8 = $('#val_8').val();
					var corr_1 = $('#corr_1').val();
					var corr_2 = $('#corr_2').val();
					var corr_3 = $('#corr_3').val();
					var corr_4 = $('#corr_4').val();
					var corr_5 = $('#corr_5').val();
					var corr_6 = $('#corr_6').val();
					var corr_7 = $('#corr_7').val();
					var corr_8 = $('#corr_8').val();
					var con_1 = $('#con_1').val();
					var con_2 = $('#con_2').val();
					var con_3 = $('#con_3').val();
					var con_4 = $('#con_4').val();
					var con_5 = $('#con_5').val();
					var con_6 = $('#con_6').val();
					var con_7 = $('#con_7').val();
					var con_8 = $('#con_8').val();
					var volt_1 = $('#volt_1').val();
					var volt_2 = $('#volt_2').val();
					var volt_3 = $('#volt_3').val();
					var volt_4 = $('#volt_4').val();
					var volt_5 = $('#volt_5').val();
					var volt_6 = $('#volt_6').val();
					var volt_7 = $('#volt_7').val();
					var volt_8 = $('#volt_8').val();
					var rem_1 = $('#rem_1').val();
					var rem_2 = $('#rem_2').val();
					var rem_3 = $('#rem_3').val();
					var rem_4 = $('#rem_4').val();
					var rem_5 = $('#rem_5').val();
					var rem_6 = $('#rem_6').val();
					var rem_7 = $('#rem_7').val();
					var rem_8 = $('#rem_8').val();
					var temp = $('#temp').val();


					break;
				} else {
					var loc_1 = "0";
					var loc_2 = "0";
					var loc_3 = "0";
					var loc_4 = "0";
					var loc_5 = "0";
					var loc_6 = "0";
					var loc_7 = "0";
					var loc_8 = "0";
					var val_1 = "0";
					var val_2 = "0";
					var val_3 = "0";
					var val_4 = "0";
					var val_5 = "0";
					var val_6 = "0";
					var val_7 = "0";
					var val_8 = "0";
					var corr_1 = "0";
					var corr_2 = "0";
					var corr_3 = "0";
					var corr_4 = "0";
					var corr_5 = "0";
					var corr_6 = "0";
					var corr_7 = "0";
					var corr_8 = "0";
					var temp = "0";
					var con_1 = "0";
					var con_2 = "0";
					var con_3 = "0";
					var con_4 = "0";
					var con_5 = "0";
					var con_6 = "0";
					var con_7 = "0";
					var con_8 = "0";
					var volt_1 = "0";
					var volt_2 = "0";
					var volt_3 = "0";
					var volt_4 = "0";
					var volt_5 = "0";
					var volt_6 = "0";
					var volt_7 = "0";
					var volt_8 = "0";
					var rem_1 = "0";
					var rem_2 = "0";
					var rem_3 = "0";
					var rem_4 = "0";
					var rem_5 = "0";
					var rem_6 = "0";
					var rem_7 = "0";
					var rem_8 = "0";

				}

			}






			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_hcp=' + chk_hcp + '&loc_1=' + loc_1 + '&loc_2=' + loc_2 + '&loc_3=' + loc_3 + '&loc_4=' + loc_4 + '&loc_5=' + loc_5 + '&loc_6=' + loc_6 + '&loc_7=' + loc_7 + '&loc_8=' + loc_8 + '&val_1=' + val_1 + '&val_2=' + val_2 + '&val_3=' + val_3 + '&val_4=' + val_4 + '&val_5=' + val_5 + '&val_6=' + val_6 + '&val_7=' + val_7 + '&val_8=' + val_8 + '&corr_1=' + corr_1 + '&corr_2=' + corr_2 + '&corr_3=' + corr_3 + '&corr_4=' + corr_4 + '&corr_5=' + corr_5 + '&corr_6=' + corr_6 + '&corr_7=' + corr_7 + '&corr_8=' + corr_8 + '&volt_1=' + volt_1 + '&volt_2=' + volt_2 + '&volt_3=' + volt_3 + '&volt_4=' + volt_4 + '&volt_5=' + volt_5 + '&volt_6=' + volt_6 + '&volt_7=' + volt_7 + '&volt_8=' + volt_8 + '&con_1=' + con_1 + '&con_2=' + con_2 + '&con_3=' + con_3 + '&con_4=' + con_4 + '&con_5=' + con_5 + '&con_6=' + con_6 + '&con_7=' + con_7 + '&con_8=' + con_8 + '&rem_1=' + rem_1 + '&rem_2=' + rem_2 + '&rem_3=' + rem_3 + '&rem_4=' + rem_4 + '&rem_5=' + rem_5 + '&rem_6=' + rem_6 + '&rem_7=' + rem_7 + '&rem_8=' + rem_8 + '&temp=' + temp + '&ulr=' + ulr+ '&amend_date=' + amend_date;

		} else if (type == 'edit') {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();

			var temp = $('#test_list').val();
			var room_temp = $('#room_temp').val();
			var aa = temp.split(",");

			//penetration
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "hcp") {
					if (document.getElementById('chk_hcp').checked) {
						var chk_hcp = "1";
					} else {
						var chk_hcp = "0";
					}

					var loc_1 = $('#loc_1').val();
					var loc_2 = $('#loc_2').val();
					var loc_3 = $('#loc_3').val();
					var loc_4 = $('#loc_4').val();
					var loc_5 = $('#loc_5').val();
					var loc_6 = $('#loc_6').val();
					var loc_7 = $('#loc_7').val();
					var loc_8 = $('#loc_8').val();
					var val_1 = $('#val_1').val();
					var val_2 = $('#val_2').val();
					var val_3 = $('#val_3').val();
					var val_4 = $('#val_4').val();
					var val_5 = $('#val_5').val();
					var val_6 = $('#val_6').val();
					var val_7 = $('#val_7').val();
					var val_8 = $('#val_8').val();
					var corr_1 = $('#corr_1').val();
					var corr_2 = $('#corr_2').val();
					var corr_3 = $('#corr_3').val();
					var corr_4 = $('#corr_4').val();
					var corr_5 = $('#corr_5').val();
					var corr_6 = $('#corr_6').val();
					var corr_7 = $('#corr_7').val();
					var corr_8 = $('#corr_8').val();
					var con_1 = $('#con_1').val();
					var con_2 = $('#con_2').val();
					var con_3 = $('#con_3').val();
					var con_4 = $('#con_4').val();
					var con_5 = $('#con_5').val();
					var con_6 = $('#con_6').val();
					var con_7 = $('#con_7').val();
					var con_8 = $('#con_8').val();
					var volt_1 = $('#volt_1').val();
					var volt_2 = $('#volt_2').val();
					var volt_3 = $('#volt_3').val();
					var volt_4 = $('#volt_4').val();
					var volt_5 = $('#volt_5').val();
					var volt_6 = $('#volt_6').val();
					var volt_7 = $('#volt_7').val();
					var volt_8 = $('#volt_8').val();
					var rem_1 = $('#rem_1').val();
					var rem_2 = $('#rem_2').val();
					var rem_3 = $('#rem_3').val();
					var rem_4 = $('#rem_4').val();
					var rem_5 = $('#rem_5').val();
					var rem_6 = $('#rem_6').val();
					var rem_7 = $('#rem_7').val();
					var rem_8 = $('#rem_8').val();
					var temp = $('#temp').val();

					break;
				} else {
					var loc_1 = "0";
					var loc_2 = "0";
					var loc_3 = "0";
					var loc_4 = "0";
					var loc_5 = "0";
					var loc_6 = "0";
					var loc_7 = "0";
					var loc_8 = "0";
					var val_1 = "0";
					var val_2 = "0";
					var val_3 = "0";
					var val_4 = "0";
					var val_5 = "0";
					var val_6 = "0";
					var val_7 = "0";
					var val_8 = "0";
					var corr_1 = "0";
					var corr_2 = "0";
					var corr_3 = "0";
					var corr_4 = "0";
					var corr_5 = "0";
					var corr_6 = "0";
					var corr_7 = "0";
					var corr_8 = "0";
					var temp = "0";
					var con_1 = "0";
					var con_2 = "0";
					var con_3 = "0";
					var con_4 = "0";
					var con_5 = "0";
					var con_6 = "0";
					var con_7 = "0";
					var con_8 = "0";
					var volt_1 = "0";
					var volt_2 = "0";
					var volt_3 = "0";
					var volt_4 = "0";
					var volt_5 = "0";
					var volt_6 = "0";
					var volt_7 = "0";
					var volt_8 = "0";
					var rem_1 = "0";
					var rem_2 = "0";
					var rem_3 = "0";
					var rem_4 = "0";
					var rem_5 = "0";
					var rem_6 = "0";
					var rem_7 = "0";
					var rem_8 = "0";
				}

			}





			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&loc_1=' + loc_1 + '&loc_2=' + loc_2 + '&loc_3=' + loc_3 + '&loc_4=' + loc_4 + '&loc_5=' + loc_5 + '&loc_6=' + loc_6 + '&loc_7=' + loc_7 + '&loc_8=' + loc_8 + '&val_1=' + val_1 + '&val_2=' + val_2 + '&val_3=' + val_3 + '&val_4=' + val_4 + '&val_5=' + val_5 + '&val_6=' + val_6 + '&val_7=' + val_7 + '&val_8=' + val_8 + '&corr_1=' + corr_1 + '&corr_2=' + corr_2 + '&corr_3=' + corr_3 + '&corr_4=' + corr_4 + '&corr_5=' + corr_5 + '&corr_6=' + corr_6 + '&corr_7=' + corr_7 + '&corr_8=' + corr_8 + '&volt_1=' + volt_1 + '&volt_2=' + volt_2 + '&volt_3=' + volt_3 + '&volt_4=' + volt_4 + '&volt_5=' + volt_5 + '&volt_6=' + volt_6 + '&volt_7=' + volt_7 + '&volt_8=' + volt_8 + '&con_1=' + con_1 + '&con_2=' + con_2 + '&con_3=' + con_3 + '&con_4=' + con_4 + '&con_5=' + con_5 + '&con_6=' + con_6 + '&con_7=' + con_7 + '&con_8=' + con_8 + '&rem_1=' + rem_1 + '&rem_2=' + rem_2 + '&rem_3=' + rem_3 + '&rem_4=' + rem_4 + '&rem_5=' + rem_5 + '&rem_6=' + rem_6 + '&rem_7=' + rem_7 + '&rem_8=' + rem_8 + '&temp=' + temp + '&ulr=' + ulr+ '&amend_date=' + amend_date;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_half_cell.php',
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
			url: '<?php echo $base_url; ?>save_half_cell.php',
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
				//penetration
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "hcp") {

						var chk_hcp = data.chk_hcp;
						if (chk_hcp == "1") {
							$('#txthcp').css("background-color", "var(--success)");
							$("#chk_hcp").prop("checked", true);



						} else {
							$('#txtpen').css("background-color", "white");
							$("#chk_hcp").prop("checked", false);

						}
						$('#loc_1').val(data.loc_1);
						$('#loc_2').val(data.loc_2);
						$('#loc_3').val(data.loc_3);
						$('#loc_4').val(data.loc_4);
						$('#loc_5').val(data.loc_5);
						$('#loc_6').val(data.loc_6);
						$('#loc_7').val(data.loc_7);
						$('#loc_8').val(data.loc_8);
						$('#val_1').val(data.val_1);
						$('#val_2').val(data.val_2);
						$('#val_3').val(data.val_3);
						$('#val_4').val(data.val_4);
						$('#val_5').val(data.val_5);
						$('#val_6').val(data.val_6);
						$('#val_7').val(data.val_7);
						$('#val_8').val(data.val_8);
						$('#corr_1').val(data.corr_1);
						$('#corr_2').val(data.corr_2);
						$('#corr_3').val(data.corr_3);
						$('#corr_4').val(data.corr_4);
						$('#corr_5').val(data.corr_5);
						$('#corr_6').val(data.corr_6);
						$('#corr_7').val(data.corr_7);
						$('#corr_8').val(data.corr_8);
						$('#con_1').val(data.con_1);
						$('#con_2').val(data.con_2);
						$('#con_3').val(data.con_3);
						$('#con_4').val(data.con_4);
						$('#con_5').val(data.con_5);
						$('#con_6').val(data.con_6);
						$('#con_7').val(data.con_7);
						$('#con_8').val(data.con_8);
						$('#volt_1').val(data.volt_1);
						$('#volt_2').val(data.volt_2);
						$('#volt_3').val(data.volt_3);
						$('#volt_4').val(data.volt_4);
						$('#volt_5').val(data.volt_5);
						$('#volt_6').val(data.volt_6);
						$('#volt_7').val(data.volt_7);
						$('#volt_8').val(data.volt_8);
						$('#rem_1').val(data.rem_1);
						$('#rem_2').val(data.rem_2);
						$('#rem_3').val(data.rem_3);
						$('#rem_4').val(data.rem_4);
						$('#rem_5').val(data.rem_5);
						$('#rem_6').val(data.rem_6);
						$('#rem_7').val(data.rem_7);
						$('#rem_8').val(data.rem_8);
						$('#temp').val(data.temp);


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