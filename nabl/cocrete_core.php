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
						<h2 style="text-align:center;">CONCRETE CORE TEST</h2>
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
										$querys_job1 = "SELECT * FROM cocrete_core WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_cocrete_core.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>
									<?php// } ?>
									<div class="col-sm-2">
										<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/back_cocrete_core.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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

									if ($r1['test_code'] == "com") {

										$test_check .= "com,";
								?>
										<div class="panel panel-default" id="com">
											<div class="panel-heading" id="txtcom">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
														<h4 class="panel-title">
															<b>COMPRESSIVE STRENGTH TEST</b>
														</h4>
													</a>
												</h4>
											</div>
											<div id="collapse5" class="panel-collapse collapse">
												<div class="panel-body">
													<br>
													<div class="row">

														<div class="col-lg-6">
															<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_com">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_com" id="chk_com" value="chk_com"><br>
																</div>
																<label for="inputEmail3" class="col-sm-6 control-label label-right">COMPRESSIVE STRENGTH TEST</label>
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
																	<label for="inputEmail3" class="control-label">I.D.Marks</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="mar_1" name="mar_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="mar_2" name="mar_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="mar_3" name="mar_3">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Lenth</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="len_1" name="len_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="len_2" name="len_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="len_3" name="len_3">
																</div>
															</div>
														</div>

													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Diameter</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="dia_1" name="dia_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="dia_2" name="dia_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="dia_3" name="dia_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Correction factor L/D Ratio </label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_1" name="corr_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_2" name="corr_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr_3" name="corr_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Load</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_1" name="load_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_2" name="load_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_3" name="load_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Cylindrical Comp.Strength</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_1" name="com_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_2" name="com_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_3" name="com_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Correction Cylindrical Comp. Strength for L/D Ratio</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ccc_1" name="ccc_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ccc_2" name="ccc_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ccc_3" name="ccc_3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Equivalent Cube Strenghth</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ecs_1" name="ecs_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ecs_2" name="ecs_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ecs_3" name="ecs_3">
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

									if ($r1['test_code'] == "wtr") {

										$test_check .= "wtr,";
								?>
										<!--div class="panel panel-default" id="wtr">
					<div class="panel-heading" id="txtwtr">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								<h4 class="panel-title">
								<b>WATER ABSORPTION TEST</b>
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
													<label for="chk_wtr">2.</label>
													<input type="checkbox" class="visually-hidden" name="chk_wtr"  id="chk_wtr" value="chk_wtr"><br>
												</div>
											<label for="inputEmail3" class="col-sm-6 control-label label-right">WATER ABSORPTION TEST</label>
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
											<label for="inputEmail3" class="control-label">Mass in g of the container with its lid at room temperature(M1)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m1_1" name="m1_1" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m1_2" name="m1_2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m1_3" name="m1_3" >
										</div>
									</div>
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Mass in g of the container with its lid and the sample at room temperature(M2)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m2_1" name="m2_1" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m2_2" name="m2_2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m2_3" name="m2_3" >
										</div>
									</div>
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Mass in g of the container with its lid and the sample after drying(M3) </label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m3_1" name="m3_1" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m3_2" name="m3_2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m3_3" name="m3_3" >
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
													<label for="chk_den">3.</label>
													<input type="checkbox" class="visually-hidden" name="chk_den"  id="chk_den" value="chk_den"><br>
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
											<label for="inputEmail3" class="control-label">Saturated-submerged mass of basket alone,M1</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m11" name="m11" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m12" name="m12" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m13" name="m13" >
										</div>
									</div>
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Saturated-submerged mass of basket + specimen, M2</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m21" name="m21" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m22" name="m22" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m23" name="m23" >
										</div>
									</div>
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Mass of container and lid, M3 </label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m31" name="m31" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m32" name="m32" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m33" name="m33" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Saturated surface dry mass of the sample + container, M4 </label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m41" name="m41" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m42" name="m42" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m43" name="m43" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Dried mass of the container with sample, M5 </label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m51" name="m51" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m52" name="m52" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="m53" name="m53" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Dry Density of Rock</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="den_1" name="den_1" >
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="den_2" name="den_2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="den_3" name="den_3" >
										</div>
									</div>
								</div>
							</div>
							<br>
							
						</div>
							
								
							
							<br>
							
							
								
						
						</div>
				  
				
		
					</div-->


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
												$query = "select * from cocrete_core WHERE lab_no='$aa'  and `is_deleted`='0'";

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



		$('#chk_com').change(function() {
			if (this.checked) {
				$('#txtcom').css("background-color", "var(--success)");
			} else {
				$('#txtcom').css("background-color", "white");
			}

		});
		// $('#chk_wtr').change(function(){
		// if(this.checked)
		// {
		// $('#txtwtr').css("background-color","var(--success)");	
		// }
		// else
		// {
		// $('#txtwtr').css("background-color","white");	
		// }

		// });
		// $('#chk_den').change(function(){
		// if(this.checked)
		// {
		// $('#txtden').css("background-color","var(--success)");	
		// }
		// else
		// {
		// $('#txtden').css("background-color","white");	
		// }

		// });


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
				//com
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "com") {
						$('#txtcom').css("background-color", "var(--success)");
						$("#chk_com").prop("checked", true);
						chk_auto();
						break;
					}
				}
				//wtr
				// for(var i=0;i<aa.length;i++)
				// {
				// if(aa[i]=="wtr")
				// {
				// $('#txtwtr').css("background-color","var(--success)");
				// $("#chk_wtr").prop("checked", true); 
				// chk_auto();
				// break;
				// }					
				// }
				//den
				// for(var i=0;i<aa.length;i++)
				// {
				// if(aa[i]=="den")
				// {
				// $('#txtden').css("background-color","var(--success)");
				// $("#chk_den").prop("checked", true); 
				// chk_auto();
				// break;
				// }					
				// }




			}

		});



		// $('#chk_com').change(function(){
		// if(this.checked)
		// {  

		// }
		// else
		// {
		// $('#mar_1').val(80);
		// $('#mar_2').val(80);
		// $('#mar_3').val(80);
		// $('#len_1').val(80);
		// $('#len_2').val(80);
		// $('#len_3').val(80);
		// $('#dia_1').val(80);
		// $('#dia_2').val(80);
		// $('#dia_3').val(80);
		// $('#corr_1').val(80);
		// $('#corr_2').val(80);
		// $('#corr_3').val(80);
		// $('#load_1').val(80);
		// $('#load_2').val(80);
		// $('#load_3').val(80);
		// $('#com_1').val(80);
		// $('#com_2').val(80);
		// $('#com_3').val(80);
		// $('#ccc_1').val(80);
		// $('#ccc_2').val(80);
		// $('#ccc_3').val(80);
		// $('#ecs_1').val(80);
		// $('#ecs_2').val(80);
		// $('#ecs_3').val(80);

		// }
		// });

	});

	function chk_auto() {
		$('#txtcom').css("background-color", "var(--success)");
		$('#mar_1').val(1);
		$('#mar_2').val(1);
		$('#mar_3').val(1);
		$('#len_1').val(1);
		$('#len_2').val(1);
		$('#len_3').val(1);
		$('#dia_1').val(1);
		$('#dia_2').val(1);
		$('#dia_3').val(1);
		$('#corr_1').val(1);
		$('#corr_2').val(1);
		$('#corr_3').val(1);
		$('#load_1').val(1);
		$('#load_2').val(1);
		$('#load_3').val(1);
		$('#com_1').val(1);
		$('#com_2').val(1);
		$('#com_3').val(1);
		$('#ccc_1').val(1);
		$('#ccc_2').val(1);
		$('#ccc_3').val(1);
		$('#ecs_1').val(1);
		$('#ecs_2').val(1);
		$('#ecs_3').val(1);
	}

	$('#chk_com').change(function() {
		if (this.checked) {
			chk_auto();
		} else {
			$('#txtcom').css("background-color", "white");
			$('#mar_1').val(null);
			$('#mar_2').val(null);
			$('#mar_3').val(null);
			$('#len_1').val(null);
			$('#len_2').val(null);
			$('#len_3').val(null);
			$('#dia_1').val(null);
			$('#dia_2').val(null);
			$('#dia_3').val(null);
			$('#corr_1').val(null);
			$('#corr_2').val(null);
			$('#corr_3').val(null);
			$('#load_1').val(null);
			$('#load_2').val(null);
			$('#load_3').val(null);
			$('#com_1').val(null);
			$('#com_2').val(null);
			$('#com_3').val(null);
			$('#ccc_1').val(null);
			$('#ccc_2').val(null);
			$('#ccc_3').val(null);
			$('#ecs_1').val(null);
			$('#ecs_2').val(null);
			$('#ecs_3').val(null);
		}
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
			url: '<?php echo $base_url; ?>save_cocrete_core.php',
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

			//com
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "com") {
					if (document.getElementById('chk_com').checked) {
						var chk_com = "1";
					} else {
						var chk_com = "0";
					}

					var mar_1 = $('#mar_1').val();
					var mar_2 = $('#mar_2').val();
					var mar_3 = $('#mar_3').val();
					var len_1 = $('#len_1').val();
					var len_2 = $('#len_2').val();
					var len_3 = $('#len_3').val();
					var dia_1 = $('#dia_1').val();
					var dia_2 = $('#dia_2').val();
					var dia_3 = $('#dia_3').val();
					var corr_1 = $('#corr_1').val();
					var corr_2 = $('#corr_2').val();
					var corr_3 = $('#corr_3').val();
					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();
					var com_1 = $('#com_1').val();
					var com_2 = $('#com_2').val();
					var com_3 = $('#com_3').val();
					var ccc_1 = $('#ccc_1').val();
					var ccc_2 = $('#ccc_2').val();
					var ccc_3 = $('#ccc_3').val();
					var ecs_1 = $('#ecs_1').val();
					var ecs_2 = $('#ecs_2').val();
					var ecs_3 = $('#ecs_3').val();

					break;
				} else {
					var mar_1 = "0";
					var mar_2 = "0";
					var mar_3 = "0";
					var len_1 = "0";
					var len_2 = "0";
					var len_3 = "0";
					var dia_1 = "0";
					var dia_2 = "0";
					var dia_3 = "0";
					var corr_1 = "0";
					var corr_2 = "0";
					var corr_3 = "0";
					var load_1 = "0";
					var load_2 = "0";
					var load_3 = "0";
					var com_1 = "0";
					var com_2 = "0";
					var com_3 = "0";
					var ccc_1 = "0";
					var ccc_2 = "0";
					var ccc_3 = "0";
					var ecs_1 = "0";
					var ecs_2 = "0";
					var ecs_3 = "0";

				}

			}

			//wtr
			// for(var i=0;i<aa.length;i++)
			// {
			// if(aa[i]=="wtr")
			// {
			// if(document.getElementById('chk_wtr').checked) {
			// var chk_wtr = "1";
			// }
			// else{
			// var chk_wtr = "0";
			// }	

			// var m1_1 = $('#m1_1').val();													
			// var m1_2 = $('#m1_2').val();													
			// var m1_3 = $('#m1_3').val();												
			// var m2_1 = $('#m2_1').val();													
			// var m2_2 = $('#m2_2').val();													
			// var m2_3 = $('#m2_3').val();												
			// var m3_1 = $('#m3_1').val();													
			// var m3_2 = $('#m3_2').val();													
			// var m3_3 = $('#m3_3').val();										

			// break;
			// }
			// else
			// {
			// var m1_1 = "0";
			// var m1_2 = "0";
			// var m1_3 = "0";
			// var m2_1 = "0";
			// var m2_2 = "0";
			// var m2_3 = "0";
			// var m3_1 = "0";
			// var m3_2 = "0";
			// var m3_3 = "0";
			// }

			// }

			//den
			// for(var i=0;i<aa.length;i++)
			// {
			// if(aa[i]=="den")
			// {
			// if(document.getElementById('chk_den').checked) {
			// var chk_den = "1";
			// }
			// else{
			// var chk_den = "0";
			// }	

			// var m11 = $('#m11').val();													
			// var m12 = $('#m12').val();													
			// var m13 = $('#m13').val();												
			// var m21 = $('#m21').val();													
			// var m22 = $('#m22').val();													
			// var m23 = $('#m23').val();												
			// var m31 = $('#m31').val();													
			// var m32 = $('#m32').val();													
			// var m33 = $('#m33').val();										
			// var m41 = $('#m41').val();													
			// var m42 = $('#m42').val();													
			// var m43 = $('#m43').val();										
			// var m51 = $('#m51').val();													
			// var m52 = $('#m52').val();													
			// var m53 = $('#m53').val();										
			// var den_1 = $('#den_1').val();													
			// var den_2 = $('#den_2').val();													
			// var den_3 = $('#den_3').val();										

			// break;
			// }
			// else
			// {
			// var m11 = "0";
			// var m12 = "0";
			// var m13 = "0";
			// var m21 = "0";
			// var m22 = "0";
			// var m23 = "0";
			// var m31 = "0";
			// var m32 = "0";
			// var m33 = "0";
			// var m41 = "0";
			// var m42 = "0";
			// var m43 = "0";
			// var m51 = "0";
			// var m52 = "0";
			// var m53 = "0";
			// var den_1 = "0";
			// var den_2 = "0";
			// var den_3 = "0";

			// }

			// }






			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_com=' + chk_com + '&mar_1=' + mar_1 + '&mar_2=' + mar_2 + '&mar_3=' + mar_3 + '&len_1=' + len_1 + '&len_2=' + len_2 + '&len_3=' + len_3 + '&dia_1=' + dia_1 + '&dia_2=' + dia_2 + '&dia_3=' + dia_3 + '&corr_1=' + corr_1 + '&corr_2=' + corr_2 + '&corr_3=' + corr_3 + '&load_1=' + load_1 + '&load_2=' + load_2 + '&load_3=' + load_3 + '&com_1=' + com_1 + '&com_2=' + com_2 + '&com_3=' + com_3 + '&ccc_1=' + ccc_1 + '&ccc_2=' + ccc_2 + '&ccc_3=' + ccc_3 + '&ecs_1=' + ecs_1 + '&ecs_2=' + ecs_2 + '&ecs_3=' + ecs_3 + '&ulr=' + ulr;

		} else if (type == 'edit') {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();

			var temp = $('#test_list').val();
			var room_temp = $('#room_temp').val();
			var aa = temp.split(",");

			//com
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "com") {
					if (document.getElementById('chk_com').checked) {
						var chk_com = "1";
					} else {
						var chk_com = "0";
					}

					var mar_1 = $('#mar_1').val();
					var mar_2 = $('#mar_2').val();
					var mar_3 = $('#mar_3').val();
					var len_1 = $('#len_1').val();
					var len_2 = $('#len_2').val();
					var len_3 = $('#len_3').val();
					var dia_1 = $('#dia_1').val();
					var dia_2 = $('#dia_2').val();
					var dia_3 = $('#dia_3').val();
					var corr_1 = $('#corr_1').val();
					var corr_2 = $('#corr_2').val();
					var corr_3 = $('#corr_3').val();
					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();
					var com_1 = $('#com_1').val();
					var com_2 = $('#com_2').val();
					var com_3 = $('#com_3').val();
					var ccc_1 = $('#ccc_1').val();
					var ccc_2 = $('#ccc_2').val();
					var ccc_3 = $('#ccc_3').val();
					var ecs_1 = $('#ecs_1').val();
					var ecs_2 = $('#ecs_2').val();
					var ecs_3 = $('#ecs_3').val();

					break;
				} else {
					var mar_1 = "0";
					var mar_2 = "0";
					var mar_3 = "0";
					var len_1 = "0";
					var len_2 = "0";
					var len_3 = "0";
					var dia_1 = "0";
					var dia_2 = "0";
					var dia_3 = "0";
					var corr_1 = "0";
					var corr_2 = "0";
					var corr_3 = "0";
					var load_1 = "0";
					var load_2 = "0";
					var load_3 = "0";
					var com_1 = "0";
					var com_2 = "0";
					var com_3 = "0";
					var ccc_1 = "0";
					var ccc_2 = "0";
					var ccc_3 = "0";
					var ecs_1 = "0";
					var ecs_2 = "0";
					var ecs_3 = "0";

				}

			}

			//wtr
			// for(var i=0;i<aa.length;i++)
			// {
			// if(aa[i]=="wtr")
			// {
			// if(document.getElementById('chk_wtr').checked) {
			// var chk_wtr = "1";
			// }
			// else{
			// var chk_wtr = "0";
			// }	

			// var m1_1 = $('#m1_1').val();													
			// var m1_2 = $('#m1_2').val();													
			// var m1_3 = $('#m1_3').val();												
			// var m2_1 = $('#m2_1').val();													
			// var m2_2 = $('#m2_2').val();													
			// var m2_3 = $('#m2_3').val();												
			// var m3_1 = $('#m3_1').val();													
			// var m3_2 = $('#m3_2').val();													
			// var m3_3 = $('#m3_3').val();										

			// break;
			// }
			// else
			// {
			// var m1_1 = "0";
			// var m1_2 = "0";
			// var m1_3 = "0";
			// var m2_1 = "0";
			// var m2_2 = "0";
			// var m2_3 = "0";
			// var m3_1 = "0";
			// var m3_2 = "0";
			// var m3_3 = "0";
			// }

			// }

			//den
			// for(var i=0;i<aa.length;i++)
			// {
			// if(aa[i]=="den")
			// {
			// if(document.getElementById('chk_den').checked) {
			// var chk_den = "1";
			// }
			// else{
			// var chk_den = "0";
			// }	

			// var m11 = $('#m11').val();													
			// var m12 = $('#m12').val();													
			// var m13 = $('#m13').val();												
			// var m21 = $('#m21').val();													
			// var m22 = $('#m22').val();													
			// var m23 = $('#m23').val();												
			// var m31 = $('#m31').val();													
			// var m32 = $('#m32').val();													
			// var m33 = $('#m33').val();										
			// var m41 = $('#m41').val();													
			// var m42 = $('#m42').val();													
			// var m43 = $('#m43').val();										
			// var m51 = $('#m51').val();													
			// var m52 = $('#m52').val();													
			// var m53 = $('#m53').val();										
			// var den_1 = $('#den_1').val();													
			// var den_2 = $('#den_2').val();													
			// var den_3 = $('#den_3').val();										

			// break;
			// }
			// else
			// {
			// var m11 = "0";
			// var m12 = "0";
			// var m13 = "0";
			// var m21 = "0";
			// var m22 = "0";
			// var m23 = "0";
			// var m31 = "0";
			// var m32 = "0";
			// var m33 = "0";
			// var m41 = "0";
			// var m42 = "0";
			// var m43 = "0";
			// var m51 = "0";
			// var m52 = "0";
			// var m53 = "0";
			// var den_1 = "0";
			// var den_2 = "0";
			// var den_3 = "0";

			// }

			// }




			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&mar_1=' + mar_1 + '&mar_2=' + mar_2 + '&mar_3=' + mar_3 + '&len_1=' + len_1 + '&len_2=' + len_2 + '&len_3=' + len_3 + '&dia_1=' + dia_1 + '&dia_2=' + dia_2 + '&dia_3=' + dia_3 + '&corr_1=' + corr_1 + '&corr_2=' + corr_2 + '&corr_3=' + corr_3 + '&load_1=' + load_1 + '&load_2=' + load_2 + '&load_3=' + load_3 + '&com_1=' + com_1 + '&com_2=' + com_2 + '&com_3=' + com_3 + '&ccc_1=' + ccc_1 + '&ccc_2=' + ccc_2 + '&ccc_3=' + ccc_3 + '&ecs_1=' + ecs_1 + '&ecs_2=' + ecs_2 + '&ecs_3=' + ecs_3 + '&ulr=' + ulr;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_cocrete_core.php',
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
			url: '<?php echo $base_url; ?>save_cocrete_core.php',
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
				//com
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "com") {

						var chk_com = data.chk_com;
						if (chk_com == "1") {
							$('#txtcom').css("background-color", "var(--success)");
							$("#chk_com").prop("checked", true);


						} else {
							$('#txtcom').css("background-color", "var(--success)");
							$("#chk_com").prop("checked", false);

						}

						$('#mar_1').val(data.mar_1);
						$('#mar_2').val(data.mar_2);
						$('#mar_3').val(data.mar_3);
						$('#len_1').val(data.len_1);
						$('#len_2').val(data.len_2);
						$('#len_3').val(data.len_3);
						$('#dia_1').val(data.dia_1);
						$('#dia_2').val(data.dia_2);
						$('#dia_3').val(data.dia_3);
						$('#corr_1').val(data.corr_1);
						$('#corr_2').val(data.corr_2);
						$('#corr_3').val(data.corr_3);
						$('#load_1').val(data.load_1);
						$('#load_2').val(data.load_2);
						$('#load_3').val(data.load_3);
						$('#com_1').val(data.com_1);
						$('#com_2').val(data.com_2);
						$('#com_3').val(data.com_3);
						$('#ccc_1').val(data.ccc_1);
						$('#ccc_2').val(data.ccc_2);
						$('#ccc_3').val(data.ccc_3);
						$('#ecs_1').val(data.ecs_1);
						$('#ecs_2').val(data.ecs_2);
						$('#ecs_3').val(data.ecs_3);

						break;
					} else {

					}

				}

				//wtr
				// for(var i=0;i<aa.length;i++)
				// {
				// if(aa[i]=="wtr")
				// {

				// var chk_wtr = data.chk_wtr;
				// if(chk_wtr=="1")
				// {
				// $('#txtwtr').css("background-color","var(--success)");	
				// $("#chk_wtr").prop("checked", true);

				// $('#m1_1').val(data.m1_1);
				// $('#m1_2').val(data.m1_2);
				// $('#m1_3').val(data.m1_3);
				// $('#m2_1').val(data.m2_1);
				// $('#m2_2').val(data.m2_2);
				// $('#m2_3').val(data.m2_3);
				// $('#m3_1').val(data.m3_1);
				// $('#m3_2').val(data.m3_2);
				// $('#m3_3').val(data.m3_3);

				// }else{
				// $('#txtwtr').css("background-color","white");	
				// $("#chk_wtr").prop("checked", false);

				// }



				// break;
				// }
				// else
				// {

				// }

				// }

				//den
				// for(var i=0;i<aa.length;i++)
				// {
				// if(aa[i]=="den")
				// {

				// var chk_den = data.chk_den;
				// if(chk_den=="1")
				// {
				// $('#txtden').css("background-color","var(--success)");	
				// $("#chk_den").prop("checked", true);

				// $('#m11').val(data.m11);
				// $('#m12').val(data.m12);
				// $('#m13').val(data.m13);
				// $('#m21').val(data.m21);
				// $('#m22').val(data.m22);
				// $('#m23').val(data.m23);
				// $('#m31').val(data.m31);
				// $('#m32').val(data.m32);
				// $('#m33').val(data.m33);
				// $('#m41').val(data.m41);
				// $('#m42').val(data.m42);
				// $('#m43').val(data.m43);
				// $('#m51').val(data.m51);
				// $('#m52').val(data.m52);
				// $('#m53').val(data.m53);
				// $('#den_1').val(data.den_1);
				// $('#den_2').val(data.den_2);
				// $('#den_3').val(data.den_3);

				// }else{
				// $('#txtden').css("background-color","white");	
				// $("#chk_den").prop("checked", false);

				// }



				// break;
				// }
				// else
				// {

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