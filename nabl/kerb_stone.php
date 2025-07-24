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
	$paver_shape = $row_select4['paver_shape'];
	$paver_age = $row_select4['paver_age'];
	$paver_color = $row_select4['paver_color'];
	$paver_thickness = $row_select4['paver_thickness'];
	$paver_grade = $row_select4['paver_grade'];
}

?>
<div class="content-wrapper" style="margin-left:0px !important;">

	<section class="content common_material p-0">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">KERB STONE</h2>
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
							</div>
							<br>
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<div class="col-sm-6">
											<label for="kerb_type">KERB TYPE :</label>
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="kerb_type" name="kerb_type">
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<div class="col-sm-6">
											<label for="kerb_grade">KERB GRADE :</label>
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="kerb_grade" name="kerb_grade">
										</div>
									</div>
								</div>

								<div class="col-lg-4">
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


							<!--<label for="inputEmail3" class="col-sm-2 control-label">Grade :</label>-								 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_grade" value="<?php echo $paver_grade; ?>" name="top_grade" ReadOnly>
										  </div>
										  
										   <label for="inputEmail3" class="col-sm-2 control-label">Thickness :</label>								 
										  <div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="top_thickness" value="<?php echo $paver_thickness; ?>" name="top_thickness" >
										  </div>
										  
										</div>
									</div>
									
								</div>
								<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<!-- <label for="inputEmail3" class="col-sm-2 control-label">Shape :</label>-->


										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_shape" value="<?php echo $paver_shape; ?>" name="top_shape" ReadOnly>
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Age :</label>									 -->
										<div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_age" value="<?php echo $paver_age; ?>" name="top_age" ReadOnly>
										</div>
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No. :</label>	-->
										<div class="col-sm-6">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" ReadOnly>
										</div>

									</div>
								</div>

							</div>
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<!--<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Weight,gm :</label>										
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="wt1" name="wt1">
										  </div>
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="wt2" name="wt2">
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Area,mm<sup>2</sup> :</label>										
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="ar1" name="ar1">
										  </div>
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="ar2" name="ar2">
										  </div>
										</div>
									</div>
									
								</div>-->
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<!--<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Splitting Length,mm :</label>										
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="sp_len" name="sp_len">
										  </div>
										  
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Flexural Full Length,mm :</label>										
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="full_len" name="full_len">
										  </div>
										  
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Flexural Full width,mm :</label>										
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="full_width" name="full_width">
										  </div>
										  
										</div>
									</div>

									
									
								</div>-->

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
											$querys_job1 = "SELECT * FROM kerb_stone WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
										//if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
										?>
										<div class="col-sm-2">
											<a target='_blank' href="<?php echo $base_url; ?>print_report/print_kerb_stone.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

										</div>

										<?php //} 
										?>
										<div class="col-sm-2">
											<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_kerb_stone.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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

										if ($r1['test_code'] == "dim") {
											$test_check .= "dim,";
									?>
											<div class="panel panel-default" id="dim">
												<div class="panel-heading" id="txtdim">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse_dim">
															<h4 class="panel-title">
																<b>DIMENTION AND TOLERANCE</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse_dim" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">
															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_dim">1.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_dim" id="chk_dim" value="chk_dim"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">DIMENTION AND TOLERANCE</label>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">LENGTH (mm)</label>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">WIDTH (mm)</label>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">THICKNESS (mm)</label>
																</div>
															</div>
														</div>

														<br>
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="length1" name="length1">
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="width1" name="width1">
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<input type="text" class="form-control" id="thickness1" name="thickness1">
																</div>
															</div>
														</div>

													</div>
												</div>
											</div>



										<?php
										}
										if ($r1['test_code'] == "wat") {
											$test_check .= "wat,";
										?>
											<div class="panel panel-default" id="wat">
												<div class="panel-heading" id="txtwtr">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse_wtr">
															<h4 class="panel-title">
																<b>WATER ABSORPTION</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse_wtr" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">

															<div class="col-lg-12">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_wtr">2.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_wtr" id="chk_wtr" value="chk_wtr"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-6 control-label label-right">WATER ABSORPTION</label>
																</div>
															</div>

														</div>
														<br>
														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Laboratory Ref. No</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Oven dry weight in (gm) (W1)</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Saturated surface dry weight in gm (W2)</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Water absorption (%) = (W2-W1/W1) x 100</label>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="" name="">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_1" name="w1_1">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="w2_1" name="w2_1">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr1" name="wtr1">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="" name="">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_2" name="w1_2">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="w2_2" name="w2_2">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr2" name="wtr2">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="" name="">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_3" name="w1_3">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="w2_3" name="w2_3">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr3" name="wtr3">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center"></label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center"></label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Average:</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="avg_wtr" name="avg_wtr">
																</div>
															</div>
														</div>

													</div>
												</div>
											</div>





										<?php
										}
										if ($r1['test_code'] == "ben") {
											$test_check .= "ben,";
										?>
											<div class="panel panel-default" id="ben">
												<div class="panel-heading" id="txttra">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse_tra">
															<h4 class="panel-title">
																<b>TRANSVERSE STRENGTH</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse_tra" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_tra">3.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_tra" id="chk_tra" value="chk_tra"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">TRANSVERSE STRENGTH</label>
																</div>
															</div>

														</div>
														<br>
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Laboratory Ref. No</label>
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Length (l) (cm)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Breadth (B) cm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Height (h) cm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Load (KN)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Againg Factor</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Corrected Load (KN)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Observation</label>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">1.</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="len1" name="len1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bre1" name="bre1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h1" name="h1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load1" name="load1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="factor1" name="factor1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr1" name="corr1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="obs1" name="obs1">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">2.</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="len2" name="len2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bre2" name="bre2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h2" name="h2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load2" name="load2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="factor2" name="factor2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr2" name="corr2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="obs2" name="obs2">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">3.</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="len3" name="len3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="bre3" name="bre3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h3" name="h3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load3" name="load3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="factor3" name="factor3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="corr3" name="corr3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="obs3" name="obs3">
																</div>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="col-md-7">
															<div class="form-group">
																<label for="inputEmail3" class="control-label text-right">Average:</label>
															</div>
														</div>

														<div class="col-md-1">
															<div class="form-group">
																<input type="text" class="form-control" id="avg_obs" name="avg_obs">
															</div>
														</div>
													</div>
												</div>
											</div>
									</div>






								<?php
										}
										if ($r1['test_code'] == "SUR") {
											$test_check .= "SUR,";
								?>
									<div class="panel panel-default" id="sur">
										<div class="panel-heading" id="txtsur">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse_sur">
													<h4 class="panel-title">
														<b>SURFACE LAYER THICKNESS</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse_sur" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-8">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_sur">4.</label>
																<input type="checkbox" class="visually-hidden" name="chk_sur" id="chk_sur" value="chk_sur"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">SURFACE LAYER THICKNESS</label>
														</div>
													</div>

												</div>
												<br>
												<div class="row">

													<div class="col-md-1">
														<div class="form-group">
															<label for="inputEmail3" class="control-label text-center">Average</label>
														</div>
													</div>
													<div class="col-md-1">
														<div class="form-group">
															<input type="text" class="form-control" id="avg_sur" name="avg_sur">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>


							<?php
										}
									}
							?>
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
											$query = "select * from kerb_stone WHERE lab_no='$aa'  and `is_deleted`='0'";

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
																//	}
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

		//DIMENTION AND TOLERANCE
		function dim_auto() {
			$('#txtdim').css("background-color", "var(--success)");
			$('#length1').val(1);
			$('#width1').val(1);
			$('#thickness1').val(1);
		}

		//WATER ABSORPTION
		function wtr_auto() {
			$('#txtwtr').css("background-color", "var(--success)");
			$('#w1_1').val(1);
			$('#w1_2').val(1);
			$('#w1_3').val(1);
			$('#w2_1').val(1);
			$('#w2_2').val(1);
			$('#w2_3').val(1);
			$('#wtr1').val(1);
			$('#wtr2').val(1);
			$('#wtr3').val(1);
			$('#avg_wtr').val(1);
		}

		//TRANSVERSE STRENGTH
		function tra_auto() {
			$('#txttra').css("background-color", "var(--success)");
			$('#len1').val(1);
			$('#len2').val(1);
			$('#len3').val(1);
			$('#bre1').val(1);
			$('#bre2').val(1);
			$('#bre3').val(1);
			$('#h1').val(1);
			$('#h2').val(1);
			$('#h3').val(1);
			$('#load1').val(1);
			$('#load2').val(1);
			$('#load3').val(1);
			$('#factor1').val(1);
			$('#factor2').val(1);
			$('#factor3').val(1);
			$('#corr1').val(1);
			$('#corr2').val(1);
			$('#corr3').val(1);
			$('#obs1').val(1);
			$('#obs2').val(1);
			$('#obs3').val(1);
			$('#avg_obs').val(1);
		}

		//SURFACE LAYER THICKNESS
		function sur_auto() {
			$('#txtsur').css("background-color", "var(--success)");
			$('#avg_sur').val(1);
		}




		//DIMENTION AND TOLERANCE
		$('#chk_dim').change(function() {
			if (this.checked) {
				dim_auto();
			} else {
				$('#txtdim').css("background-color", "white");
				$('#length1').val(null);
				$('#width1').val(null);
				$('#thickness1').val(null);
			}
		});

		//WATER ABSORPTION
		$('#chk_wtr').change(function() {
			if (this.checked) {
				wtr_auto();

			} else {
				$('#txtwtr').css("background-color", "white");
				$('#w1_1').val(null);
				$('#w1_2').val(null);
				$('#w1_3').val(null);
				$('#w2_1').val(null);
				$('#w2_2').val(null);
				$('#w2_3').val(null);
				$('#wtr1').val(null);
				$('#wtr2').val(null);
				$('#wtr3').val(null);
				$('#avg_wtr').val(null);
			}
		});

		//TRANSVERSE STRENGTH
		$('#chk_tra').change(function() {
			if (this.checked) {
				tra_auto();
			} else {
				$('#txttra').css("background-color", "white");
				$('#len1').val(null);
				$('#len2').val(null);
				$('#len3').val(null);
				$('#bre1').val(null);
				$('#bre2').val(null);
				$('#bre3').val(null);
				$('#h1').val(null);
				$('#h2').val(null);
				$('#h3').val(null);
				$('#load1').val(null);
				$('#load2').val(null);
				$('#load3').val(null);
				$('#factor1').val(null);
				$('#factor2').val(null);
				$('#factor3').val(null);
				$('#corr1').val(null);
				$('#corr2').val(null);
				$('#corr3').val(null);
				$('#obs1').val(null);
				$('#obs2').val(null);
				$('#obs3').val(null);
				$('#avg_obs').val(null);
			}
		});

		//SURFACE LAYER THICKNESS
		$('#chk_sur').change(function() {
			if (this.checked) {
				sur_auto();

			} else {
				$('#txtsur').css("background-color", "white");
				$('#avg_sur').val(null);
			}
		});




		//chk_auto
		$('#chk_auto').change(function() {
			if (this.checked) {
				//$('#txtabr').css("background-color","var(--success)"); 
				//$('#txtwtr').css("background-color","var(--success)"); 


				var temp = $('#test_list').val();
				var aa = temp.split(",");

				//DIMENTION AND TOLERANCE
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "dim") {
						$('#txtdim').css("background-color", "var(--success)");
						$("#chk_dim").prop("checked", true);
						dim_auto();
						break;
					}
				}

				//WATER ABSORPTION
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "wat") {
						$('#txtwtr').css("background-color", "var(--success)");
						$("#chk_wtr").prop("checked", true);
						wtr_auto();
						break;
					}
				}

				//TRANSVERSE STRENGTH
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "ben") {
						$('#txttra').css("background-color", "var(--success)");
						$("#chk_tra").prop("checked", true);
						tra_auto();
						break;
					}
				}

				//SURFACE LAYER THICKNESS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "SUR") {
						$('#txtsur').css("background-color", "var(--success)");
						$("#chk_sur").prop("checked", true);
						sur_auto();
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
			url: '<?php echo $base_url; ?>save_kerb_stone.php',
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
			var kerb_type = $('#kerb_type').val();
			var kerb_grade = $('#kerb_grade').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//DIMENTION AND TOLERANCE
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "dim") {
					if (document.getElementById('chk_dim').checked) {
						var chk_dim = "1";
					} else {
						var chk_dim = "0";
					}


					var length1 = $('#length1').val();
					var width1 = $('#width1').val();
					var thickness1 = $('#thickness1').val();
					break;
				} else {
					var chk_dim = "0";


					var length1 = "0";
					var width1 = "0";
					var thickness1 = "0";
				}
			}

			//WATER ABSORPTION
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "wat") {
					if (document.getElementById('chk_wtr').checked) {
						var chk_wtr = "1";
					} else {
						var chk_wtr = "0";
					}
					var w1_1 = $('#w1_1').val();
					var w1_2 = $('#w1_2').val();
					var w1_3 = $('#w1_3').val();
					var w2_1 = $('#w2_1').val();
					var w2_2 = $('#w2_2').val();
					var w2_3 = $('#w2_3').val();
					var wtr1 = $('#wtr1').val();
					var wtr2 = $('#wtr2').val();
					var wtr3 = $('#wtr3').val();
					var avg_wtr = $('#avg_wtr').val();
					break;
				} else {
					var chk_wtr = "0";
					var w1_1 = "0";
					var w1_2 = "0";
					var w1_3 = "0";
					var w2_1 = "0";
					var w2_2 = "0";
					var w2_3 = "0";
					var wtr1 = "0";
					var wtr2 = "0";
					var wtr3 = "0";
					var avg_wtr = "0";


				}
			}


			//SURFACE LAYER THICKNESS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "SUR") {
					if (document.getElementById('chk_sur').checked) {
						var chk_sur = "1";
					} else {
						var chk_sur = "0";
					}
					var avg_sur = $('#avg_sur').val();

					break;
				} else {
					var chk_sur = "0";
					var avg_sur = "0";


				}
			}

			//TRANSVERSE STRENGTH
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "ben") {
					if (document.getElementById('chk_tra').checked) {
						var chk_tra = "1";
					} else {
						var chk_tra = "0";
					}
					var len1 = $('#len1').val();
					var len2 = $('#len2').val();
					var len3 = $('#len3').val();
					var bre1 = $('#bre1').val();
					var bre2 = $('#bre2').val();
					var bre3 = $('#bre3').val();
					var h1 = $('#h1').val();
					var h2 = $('#h2').val();
					var h3 = $('#h3').val();
					var load1 = $('#load1').val();
					var load2 = $('#load2').val();
					var load3 = $('#load3').val();
					var factor1 = $('#factor1').val();
					var factor2 = $('#factor2').val();
					var factor3 = $('#factor3').val();
					var corr1 = $('#corr1').val();
					var corr2 = $('#corr2').val();
					var corr3 = $('#corr3').val();
					var obs1 = $('#obs1').val();
					var obs2 = $('#obs2').val();
					var obs3 = $('#obs3').val();
					var avg_obs = $('#avg_obs').val();

					break;
				} else {
					var chk_tra = "0";
					var len1 = "0";
					var len2 = "0";
					var len3 = "0";
					var bre1 = "0";
					var bre2 = "0";
					var bre3 = "0";
					var h1 = "0";
					var h2 = "0";
					var h3 = "0";
					var load1 = "0";
					var load2 = "0";
					var load3 = "0";
					var factor1 = "0";
					var factor2 = "0";
					var factor3 = "0";
					var corr1 = "0";
					var corr2 = "0";
					var corr3 = "0";
					var obs1 = "0";
					var obs2 = "0";
					var obs3 = "0";
					var avg_obs = "0";



				}
			}


			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&kerb_type=' + kerb_type + '&kerb_grade=' + kerb_grade + '&chk_dim=' + chk_dim + '&length1=' + length1 + '&width1=' + width1 + '&thickness1=' + thickness1 + '&chk_wtr=' + chk_wtr + '&w1_1=' + w1_1 + '&w1_2=' + w1_2 + '&w1_3=' + w1_3 + '&w2_1=' + w2_1 + '&w2_2=' + w2_2 + '&w2_3=' + w2_3 + '&wtr1=' + wtr1 + '&wtr2=' + wtr2 + '&wtr3=' + wtr3 + '&avg_wtr=' + avg_wtr + '&chk_sur=' + chk_sur + '&avg_sur=' + avg_sur + '&chk_tra=' + chk_tra + '&len1=' + len1 + '&len2=' + len2 + '&len3=' + len3 + '&bre1=' + bre1 + '&bre2=' + bre2 + '&bre3=' + bre3 + '&h1=' + h1 + '&h2=' + h2 + '&h3=' + h3 + '&load1=' + load1 + '&load2=' + load2 + '&load3=' + load3 + '&factor1=' + factor1 + '&factor2=' + factor2 + '&factor3=' + factor3 + '&corr1=' + corr1 + '&corr2=' + corr2 + '&corr3=' + corr3 + '&obs1=' + obs1 + '&obs2=' + obs2 + '&obs3=' + obs3 + '&avg_obs=' + avg_obs + '&ulr=' + ulr+ '&amend_date=' + amend_date;


		} else if (type == 'edit') {

			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var tiles_brand = $('#tiles_brand').val();
			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();
			var kerb_type = $('#kerb_type').val();
			var kerb_grade = $('#kerb_grade').val();
			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//DIMENTION AND TOLERANCE
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "dim") {
					if (document.getElementById('chk_dim').checked) {
						var chk_dim = "1";
					} else {
						var chk_dim = "0";
					}


					var length1 = $('#length1').val();
					var width1 = $('#width1').val();
					var thickness1 = $('#thickness1').val();
					break;
				} else {
					var chk_dim = "0";


					var length1 = "0";
					var width1 = "0";
					var thickness1 = "0";
				}
			}

			//WATER ABSORPTION
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "wat") {
					if (document.getElementById('chk_wtr').checked) {
						var chk_wtr = "1";
					} else {
						var chk_wtr = "0";
					}
					var w1_1 = $('#w1_1').val();
					var w1_2 = $('#w1_2').val();
					var w1_3 = $('#w1_3').val();
					var w2_1 = $('#w2_1').val();
					var w2_2 = $('#w2_2').val();
					var w2_3 = $('#w2_3').val();
					var wtr1 = $('#wtr1').val();
					var wtr2 = $('#wtr2').val();
					var wtr3 = $('#wtr3').val();
					var avg_wtr = $('#avg_wtr').val();
					break;
				} else {
					var chk_wtr = "0";
					var w1_1 = "0";
					var w1_2 = "0";
					var w1_3 = "0";
					var w2_1 = "0";
					var w2_2 = "0";
					var w2_3 = "0";
					var wtr1 = "0";
					var wtr2 = "0";
					var wtr3 = "0";
					var avg_wtr = "0";


				}
			}


			//SURFACE LAYER THICKNESS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "SUR") {
					if (document.getElementById('chk_sur').checked) {
						var chk_sur = "1";
					} else {
						var chk_sur = "0";
					}
					var avg_sur = $('#avg_sur').val();

					break;
				} else {
					var chk_sur = "0";
					var avg_sur = "0";


				}
			}

			//TRANSVERSE STRENGTH
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "ben") {
					if (document.getElementById('chk_tra').checked) {
						var chk_tra = "1";
					} else {
						var chk_tra = "0";
					}
					var len1 = $('#len1').val();
					var len2 = $('#len2').val();
					var len3 = $('#len3').val();
					var bre1 = $('#bre1').val();
					var bre2 = $('#bre2').val();
					var bre3 = $('#bre3').val();
					var h1 = $('#h1').val();
					var h2 = $('#h2').val();
					var h3 = $('#h3').val();
					var load1 = $('#load1').val();
					var load2 = $('#load2').val();
					var load3 = $('#load3').val();
					var factor1 = $('#factor1').val();
					var factor2 = $('#factor2').val();
					var factor3 = $('#factor3').val();
					var corr1 = $('#corr1').val();
					var corr2 = $('#corr2').val();
					var corr3 = $('#corr3').val();
					var obs1 = $('#obs1').val();
					var obs2 = $('#obs2').val();
					var obs3 = $('#obs3').val();
					var avg_obs = $('#avg_obs').val();

					break;
				} else {
					var chk_tra = "0";
					var len1 = "0";
					var len2 = "0";
					var len3 = "0";
					var bre1 = "0";
					var bre2 = "0";
					var bre3 = "0";
					var h1 = "0";
					var h2 = "0";
					var h3 = "0";
					var load1 = "0";
					var load2 = "0";
					var load3 = "0";
					var factor1 = "0";
					var factor2 = "0";
					var factor3 = "0";
					var corr1 = "0";
					var corr2 = "0";
					var corr3 = "0";
					var obs1 = "0";
					var obs2 = "0";
					var obs3 = "0";
					var avg_obs = "0";



				}
			}




			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&kerb_type=' + kerb_type + '&kerb_grade=' + kerb_grade + '&chk_dim=' + chk_dim + '&length1=' + length1 + '&width1=' + width1 + '&thickness1=' + thickness1 + '&chk_wtr=' + chk_wtr + '&w1_1=' + w1_1 + '&w1_2=' + w1_2 + '&w1_3=' + w1_3 + '&w2_1=' + w2_1 + '&w2_2=' + w2_2 + '&w2_3=' + w2_3 + '&wtr1=' + wtr1 + '&wtr2=' + wtr2 + '&wtr3=' + wtr3 + '&avg_wtr=' + avg_wtr + '&chk_sur=' + chk_sur + '&avg_sur=' + avg_sur + '&chk_tra=' + chk_tra + '&len1=' + len1 + '&len2=' + len2 + '&len3=' + len3 + '&bre1=' + bre1 + '&bre2=' + bre2 + '&bre3=' + bre3 + '&h1=' + h1 + '&h2=' + h2 + '&h3=' + h3 + '&load1=' + load1 + '&load2=' + load2 + '&load3=' + load3 + '&factor1=' + factor1 + '&factor2=' + factor2 + '&factor3=' + factor3 + '&corr1=' + corr1 + '&corr2=' + corr2 + '&corr3=' + corr3 + '&obs1=' + obs1 + '&obs2=' + obs2 + '&obs3=' + obs3 + '&avg_obs=' + avg_obs + '&ulr=' + ulr + '&amend_date=' + amend_date;

		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}


		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_kerb_stone.php',
			data: billData,
			dataType: 'JSON',
			success: function(msg) {
				$('#btn_save').hide();
				getGlazedTiles();
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
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
			url: '<?php echo $base_url; ?>save_kerb_stone.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);

				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);
				$('#ulr').val(data.ulr);
				$('#amend_date').val(data.amend_date);
				$('#kerb_type').val(data.kerb_type);
				$('#kerb_grade').val(data.kerb_grade);

				var temp = $('#test_list').val();
				var aa = temp.split(",");

				//DIMENTION AND TOLERANCE
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "dim") {

						var chk_dim = data.chk_dim;
						if (chk_dim == "1") {
							$('#txtdim').css("background-color", "var(--success)");
							$("#chk_dim").prop("checked", true);
						} else {
							$('#txtdim').css("background-color", "white");
							$("#chk_dim").prop("checked", false);
						}
						$('#length1').val(data.length1);
						$('#width1').val(data.width1);
						$('#thickness1').val(data.thickness1);

						break;
					} else {

					}

				}

				//WATER ABSORPTION
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "wat") {

						var chk_wtr = data.chk_wtr;
						if (chk_wtr == "1") {
							$('#txtwtr').css("background-color", "var(--success)");
							$("#chk_wtr").prop("checked", true);
						} else {
							$('#txtwtr').css("background-color", "white");
							$("#chk_wtr").prop("checked", false);
						}
						$('#w1_1').val(data.w1_1);
						$('#w1_2').val(data.w1_2);
						$('#w1_3').val(data.w1_3);
						$('#w2_1').val(data.w2_1);
						$('#w2_2').val(data.w2_2);
						$('#w2_3').val(data.w2_3);
						$('#wtr1').val(data.wtr1);
						$('#wtr2').val(data.wtr2);
						$('#wtr3').val(data.wtr3);
						$('#avg_wtr').val(data.avg_wtr);

						break;
					} else {

					}

				}

				//TRANSVERSE STRENGTH
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "ben") {

						var chk_tra = data.chk_tra;
						if (chk_tra == "1") {
							$('#txttra').css("background-color", "var(--success)");
							$("#chk_tra").prop("checked", true);
						} else {
							$('#txttra').css("background-color", "white");
							$("#chk_tra").prop("checked", false);
						}
						$('#len1').val(data.len1);
						$('#len2').val(data.len2);
						$('#len3').val(data.len3);
						$('#bre1').val(data.bre1);
						$('#bre2').val(data.bre2);
						$('#bre3').val(data.bre3);
						$('#h1').val(data.h1);
						$('#h2').val(data.h2);
						$('#h3').val(data.h3);
						$('#load1').val(data.load1);
						$('#load2').val(data.load2);
						$('#load3').val(data.load3);
						$('#factor1').val(data.factor1);
						$('#factor2').val(data.factor2);
						$('#factor3').val(data.factor3);
						$('#corr1').val(data.corr1);
						$('#corr2').val(data.corr2);
						$('#corr3').val(data.corr3);
						$('#obs1').val(data.obs1);
						$('#obs2').val(data.obs2);
						$('#obs3').val(data.obs3);
						$('#avg_obs').val(data.avg_obs);

						break;
					} else {

					}

				}


				//SURFACE LAYER THICKNESS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "SUR") {

						var chk_sur = data.chk_sur;
						if (chk_sur == "1") {
							$('#txtsur').css("background-color", "var(--success)");
							$("#chk_sur").prop("checked", true);
						} else {
							$('#txtsur').css("background-color", "white");
							$("#chk_sur").prop("checked", false);
						}
						$('#avg_sur').val(data.avg_sur);

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