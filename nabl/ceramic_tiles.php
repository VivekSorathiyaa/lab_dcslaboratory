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
}

?>
<div class="content-wrapper" style="margin-left:0px !important;">

	<section class="content common_material p-0">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">CERAMIC TILES</h2>
					</div>
					<div class="box-default">
						<form class="form" id="Glazed" method="post">
							<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row"><br>
								<div class="col-lg-6">
									<div class="form-group">
										<div class="col-sm-10">
											<input type="hidden" class="form-control" id="report_no" value="<?php echo $report_no; ?>" name="report_no" ReadOnly>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<div class="col-sm-10">
											<input type="hidden" class="form-control" tabindex="1" value="<?php echo $job_no; ?>" id="job_no" name="job_no" ReadOnly>
										</div>
									</div>
								</div>
							</div>
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
										<div class="col-sm-4">
											<label for="chk_auto">TILES TYPE :</label>
										</div>
										<div class="col-sm-8">
											<select class="form-control" id="tiles_type" name="tiles_type">
												<option value="modular">Modular Tiles</option>
												<option value="non-modular">Non - Modular Tiles</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<div class="col-sm-4">
											<label for="chk_auto">TILES GRADE :</label>
										</div>
										<div class="col-sm-8">
											<select class="form-control" id="tiles_grade" name="tiles_grade">
												<option value="M10 x 10">M10 x 10</option>
												<option value="M15 x 15">M15 x 15</option>
												<option value="M15 x 10">M15 x 10</option>
												<option value="M20 x 10">M20 x 10</option>
												<option value="M20 x 15">M20 x 15</option>
												<option value="M20 x 20">M20 x 20</option>
												<option value="M20 x 30">M20 x 30</option>
												<option value="M20 x 40">M20 x 40</option>
												<option value="M25 x 25">M25 x 25</option>
												<option value="M30 x 15">M30 x 15</option>
												<option value="M30 x 30">M30 x 30</option>
												<option value="M30 x 45">M30 x 45</option>
												<option value="M30 x 60">M30 x 60</option>
												<option value="M30 x 75">M30 x 75</option>
												<option value="M30 x 30">M30 x 30</option>
												<option value="M40 x 30">M40 x 30</option>
												<option value="M40 x 40">M40 x 40</option>
												<option value="M45 x 45">M45 x 45</option>
												<option value="M40 x 80">M40 x 80</option>
												<option value="M45 x 90">M45 x 90</option>
												<option value="M50 x 50">M50 x 50</option>
												<option value="M60 x 60">M60 x 60</option>
												<option value="M60 x 90">M60 x 90</option>
												<option value="M80 x 80">M80 x 80</option>
												<option value="M90 x 90">M90 x 90</option>
												<option value="M60 x 120">M60 x 120</option>
												<option value="M100 x 100">M100 x 100</option>
												<option value="M90 x 120">M90 x 120</option>
												<option value="M120 x 120">M120 x 120</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">

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
											$querys_job1 = "SELECT * FROM ceramic_tiles WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
										/*$val =  $_SESSION['isadmin'];
											if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {*/
										?>
										<div class="col-sm-2">
											<a target='_blank' href="<?php echo $base_url; ?>print_report/report_ceramic_tiles.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

										</div>

										<?php //}
										?>
										<div class="col-sm-2">
											<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_ceramic_tiles.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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

										if ($r1['test_code'] == "MOR") {
											$test_check .= "MOR,";
									?>
											<div class="panel panel-default" id="MOR">
												<div class="panel-heading" id="txtstr">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse_str">
															<h4 class="panel-title">
																<b>MODULUS OF RUPTURE AND BREAKING STRENGTH</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse_str" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">
															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_str">1.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_str" id="chk_str" value="chk_str"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">MODUAS OF RUPTURE AND BREAKING STRENGTH</label>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Sr No</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Length <br>(a)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Width <br>(b)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Thickness</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Span of Support <br>rods in <br>mm (L)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Kg</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">N</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Breaking <br> Strength in <br> N S = FL/b</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Modulas of Repture Strength in N/mm<sup>2</sup> = 3FL/2bh<sup>2<sup></label>
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
																	<input type="text" class="form-control" id="dima1" name="dima1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimb1" name="dimb1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimh1" name="dimh1">
																	<input type="text" class="form-control" id="dimh1" name="dimh1">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l1" name="l1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="wa1" name="wa1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load1" name="load1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="str1" name="str1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="rstr1" name="rstr1">
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
																	<input type="text" class="form-control" id="dima2" name="dima2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimb2" name="dimb2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimh2" name="dimh2">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l2" name="l2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="wa2" name="wa2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load2" name="load2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="str2" name="str2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="rstr2" name="rstr2">
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
																	<input type="text" class="form-control" id="dima3" name="dima3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimb3" name="dimb3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimh3" name="dimh3">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l3" name="l3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="wa3" name="wa3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load3" name="load3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="str3" name="str3">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="rstr3" name="rstr3">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">4.</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dima4" name="dima4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimb4" name="dimb4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimh4" name="dimh4">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l4" name="l4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="wa4" name="wa4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load4" name="load4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="str4" name="str4">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="rstr4" name="rstr4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">5.</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dima5" name="dima5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimb5" name="dimb5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimh5" name="dimh5">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l5" name="l5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="wa5" name="wa5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load5" name="load5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="str5" name="str5">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="rstr5" name="rstr5">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">6.</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dima6" name="dima6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimb6" name="dimb6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimh6" name="dimh6">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l6" name="l6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="wa6" name="wa6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load6" name="load6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="str6" name="str6">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="rstr6" name="rstr6">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">7.</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dima7" name="dima7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimb7" name="dimb7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dimh7" name="dimh7">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l7" name="l7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="wa7" name="wa7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load7" name="load7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="str7" name="str7">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="rstr7" name="rstr7">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">&nbsp;</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">&nbsp;</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">&nbsp;</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">&nbsp;</label>
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">&nbsp;</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">

																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Average</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="avg_str" name="avg_str">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="avg_rstr" name="avg_rstr">
																</div>
															</div>
														</div>



													</div>
												</div>
											</div>



										<?php
										}
										if ($r1['test_code'] == "shs") {
											$test_check .= "shs,";
										?>
											<div class="panel panel-default" id="shs">
												<div class="panel-heading" id="txtscr">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse_scr">
															<h4 class="panel-title">
																<b>SCRATCH HARDNESS OF SURFACE (MOHS' SCALE)</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse_scr" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_scr">2.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_scr" id="chk_scr" value="chk_scr"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">SCRATCH HARDNESS OF SURFACE (MOHS' SCALE)</label>
																</div>
															</div>

														</div>
														<br>
														<div class="row">

															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Sr No.</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">1.</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">2.</label>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">3.</label>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-2">
																<label for="inputEmail3" class="control-label text-center">Mohs' Scale No.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="s1" name="s1">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="s2" name="s2">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="s3" name="s3">
																</div>
															</div>
														</div>

														<br>
														<div class="row">

															<div class="col-md-2">

															</div>

															<div class="col-md-3">

															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-right">Average:</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="avg_s" name="avg_s">
																</div>
															</div>

															<div class="col-md-2">

															</div>


														</div>

													</div>
												</div>
											</div>





										<?php
										}
										if ($r1['test_code'] == "WAT") {
											$test_check .= "WAT,";
										?>
											<div class="panel panel-default" id="WAT">
												<div class="panel-heading" id="txtwtr">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse_wab">
															<h4 class="panel-title">
																<b>WATER ABSORPTION</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse_wab" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_wtr">3.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_wtr" id="chk_wtr" value="chk_wtr"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">WATER ABSORPTION</label>
																</div>
															</div>

														</div>
														<br>
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Sr No.</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Weight of Oven Dry Sample in g (A)</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Weight of saturate Dry in g (B)</label>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Water Absorption in % = 100(B-A)/A</label>
																</div>
															</div>
															<div class="col-md-2">

															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label text-center">1.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="a1" name="a1">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="b1" name="b1">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr1" name="wtr1">
																</div>
															</div>

															<div class="col-md-2">

															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label text-center">2.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="a2" name="a2">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="b2" name="b2">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr2" name="wtr1">
																</div>
															</div>

															<div class="col-md-2">

															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label text-center">3.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="a3" name="a3">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="b3" name="b3">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr3" name="wtr3">
																</div>
															</div>

															<div class="col-md-2">

															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label text-center">4.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="a4" name="a4">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="b4" name="b4">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr4" name="wtr4">
																</div>
															</div>

															<div class="col-md-2">

															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label text-center">5.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="a5" name="a5">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="b5" name="b5">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr5" name="wtr5">
																</div>
															</div>

															<div class="col-md-2">

															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label text-center">6.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="a6" name="a6">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="b6" name="b6">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr6" name="wtr6">
																</div>
															</div>

															<div class="col-md-2">

															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label text-center">7.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="a7" name="a7">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="b7" name="b7">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr7" name="wtr7">
																</div>
															</div>

															<div class="col-md-2">

															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label text-center">8.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="a8" name="a8">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="b8" name="b8">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr8" name="wtr8">
																</div>
															</div>

															<div class="col-md-2">

															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label text-center">9.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="a9" name="a9">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="b9" name="b9">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr9" name="wtr9">
																</div>
															</div>

															<div class="col-md-2">

															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label text-center">10.</label>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="a10" name="a10">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="b10" name="b10">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="wtr10" name="wtr10">
																</div>
															</div>

															<div class="col-md-2">

															</div>
														</div>

														<br>
														<div class="row">

															<div class="col-md-1">

															</div>

															<div class="col-md-3">

															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-right">Average:</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="avg_wtr" name="avg_wtr">
																</div>
															</div>

															<div class="col-md-2">

															</div>


														</div>

													</div>
												</div>
											</div>





										<?php
										}
										if ($r1['test_code'] == "dim") {
											$test_check .= "dim,";
										?>
											<div class="panel panel-default" id="dim">
												<div class="panel-heading" id="txtdim">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse_dim">
															<h4 class="panel-title">
																<b>DIMENTION AND SURFACE QUALITY</b>
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
																		<label for="chk_dim">4.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_dim" id="chk_dim" value="chk_dim"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">DIMENTION AND SURFACE QUALITY</label>
																</div>
															</div>

														</div>
														<br>
														<div class="row">
															<div class="col-sm-4">
																<div class="form-group">
																	<label class="control-label text-center">LENGTH</label>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<label class="control-label text-center">WIDTH</label>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<label class="control-label text-center">THICKNESS</label>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-2">
																<div class="form-group" style="border-bottom:1px solid black;">
																	<label class="control-label text-center">Side -1</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group" style="border-bottom:1px solid black;">
																	<label class="control-label text-center">Side -2</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group" style="border-bottom:1px solid black;">
																	<label class="control-label text-center">Side -1</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group" style="border-bottom:1px solid black;">
																	<label class="control-label text-center">Side -2</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group" style="border-bottom:1px solid black;">
																	<label class="control-label text-center">Side -1</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group" style="border-bottom:1px solid black;">
																	<label class="control-label text-center">Side -2</label>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_1_1" id="length_1_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_1_2" id="length_1_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_1_3" id="length_1_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_1_4" id="length_1_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_1_1" id="width_1_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_1_2" id="width_1_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_1_3" id="width_1_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_1_4" id="width_1_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_1_1" id="thick_1_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_1_2" id="thick_1_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_1_3" id="thick_1_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_1_4" id="thick_1_4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_2_1" id="length_2_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_2_2" id="length_2_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_2_3" id="length_2_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_2_4" id="length_2_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_2_1" id="width_2_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_2_2" id="width_2_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_2_3" id="width_2_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_2_4" id="width_2_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_2_1" id="thick_2_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_2_2" id="thick_2_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_2_3" id="thick_2_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_2_4" id="thick_2_4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_3_1" id="length_3_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_3_2" id="length_3_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_3_3" id="length_3_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_3_4" id="length_3_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_3_1" id="width_3_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_3_2" id="width_3_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_3_3" id="width_3_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_3_4" id="width_3_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_3_1" id="thick_3_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_3_2" id="thick_3_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_3_3" id="thick_3_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_3_4" id="thick_3_4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_4_1" id="length_4_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_4_2" id="length_4_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_4_3" id="length_4_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_4_4" id="length_4_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_4_1" id="width_4_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_4_2" id="width_4_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_4_3" id="width_4_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_4_4" id="width_4_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_4_1" id="thick_4_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_4_2" id="thick_4_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_4_3" id="thick_4_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_4_4" id="thick_4_4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_5_1" id="length_5_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_5_2" id="length_5_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_5_3" id="length_5_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_5_4" id="length_5_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_5_1" id="width_5_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_5_2" id="width_5_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_5_3" id="width_5_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_5_4" id="width_5_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_5_1" id="thick_5_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_5_2" id="thick_5_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_5_3" id="thick_5_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_5_4" id="thick_5_4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_6_1" id="length_6_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_6_2" id="length_6_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_6_3" id="length_6_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_6_4" id="length_6_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_6_1" id="width_6_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_6_2" id="width_6_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_6_3" id="width_6_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_6_4" id="width_6_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_6_1" id="thick_6_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_6_2" id="thick_6_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_6_3" id="thick_6_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_6_4" id="thick_6_4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_7_1" id="length_7_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_7_2" id="length_7_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_7_3" id="length_7_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_7_4" id="length_7_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_7_1" id="width_7_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_7_2" id="width_7_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_7_3" id="width_7_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_7_4" id="width_7_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_7_1" id="thick_7_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_7_2" id="thick_7_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_7_3" id="thick_7_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_7_4" id="thick_7_4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_8_1" id="length_8_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_8_2" id="length_8_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_8_3" id="length_8_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_8_4" id="length_8_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_8_1" id="width_8_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_8_2" id="width_8_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_8_3" id="width_8_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_8_4" id="width_8_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_8_1" id="thick_8_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_8_2" id="thick_8_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_8_3" id="thick_8_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_8_4" id="thick_8_4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_9_1" id="length_9_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_9_2" id="length_9_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_9_3" id="length_9_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_9_4" id="length_9_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_9_1" id="width_9_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_9_2" id="width_9_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_9_3" id="width_9_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_9_4" id="width_9_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_9_1" id="thick_9_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_9_2" id="thick_9_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_9_3" id="thick_9_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_9_4" id="thick_9_4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_10_1" id="length_10_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_10_2" id="length_10_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_10_3" id="length_10_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="length_10_4" id="length_10_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_10_1" id="width_10_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_10_2" id="width_10_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_10_3" id="width_10_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="width_10_4" id="width_10_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_10_1" id="thick_10_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_10_2" id="thick_10_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_10_3" id="thick_10_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="thick_10_4" id="thick_10_4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-2">
																<div class="form-group">
																	<label class="control-label text-center">Average</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<label class="control-label text-center">Average</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<label class="control-label text-center">Average</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<label class="control-label text-center">Average</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<label class="control-label text-center">Average</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<label class="control-label text-center">Average</label>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_1" id="avg_1_1">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_2" id="avg_1_2">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_3" id="avg_1_3">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_4" id="avg_1_4">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_5" id="avg_1_5">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_6" id="avg_1_6">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_7" id="avg_1_7">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_8" id="avg_1_8">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_9" id="avg_1_9">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_10" id="avg_1_10">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_11" id="avg_1_11">
																</div>
															</div>
															<div class="col-sm-1">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1_12" id="avg_1_12">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_1" id="avg_1">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_2" id="avg_2">
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group">
																	<input type="text" class="form-control" name="avg_3" id="avg_3">
																</div>
															</div>
														</div>
														<br>
													</div>
												</div>
											</div>


										<?php
										}
										if ($r1['test_code'] == "DEN") {
											$test_check .= "DEN,";
										?>

											<div class="panel panel-default" id="den">
												<div class="panel-heading" id="txtden">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse_den">
															<h4 class="panel-title">
																<b>DENSITY</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse_den" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_den">5.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_den" id="chk_den" value="chk_den"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">DENSITY</label>
																</div>
															</div>

														</div>

														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Sr No</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Length <br> (mm)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Width <br> (mm)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Thickness <br> (mm)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Volume <br> (mm<sup>3</sup>)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Weight <br> (gm)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">Density <br> (gm/cc)</label>
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
																	<input type="text" class="form-control" id="dl1" name="dl1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dw1" name="dw1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dt1" name="dt1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="vol1" name="vol1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dweight1" name="dweight1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="den1" name="den1">
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
																	<input type="text" class="form-control" id="dl2" name="dl2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dw2" name="dw2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dt2" name="dt2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="vol2" name="vol2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dweight2" name="dweight2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="den2" name="den2">
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
																	<input type="text" class="form-control" id="dl3" name="dl3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dw3" name="dw3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dt3" name="dt3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="vol3" name="vol3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dweight3" name="dweight3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="den3" name="den3">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">4.</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dl4" name="dl4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dw4" name="dw4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dt4" name="dt4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="vol4" name="vol4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dweight4" name="dweight4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="den4" name="den4">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">5.</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dl5" name="dl5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dw5" name="dw5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dt5" name="dt5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="vol5" name="vol5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dweight5" name="dweight5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="den5" name="den5">
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label text-center">6.</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dl6" name="dl6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dw6" name="dw6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dt6" name="dt6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="vol6" name="vol6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dweight6" name="dweight6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="den6" name="den6">
																</div>
															</div>
														</div>
														<br>
														<div class="row">

															<div class="col-md-5">

															</div>
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label">Average</label>
															</div>
															<div class="col-md-1">
																<input type="text" class="form-control" id="avg_den" name="avg_den">
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
													$query = "select * from ceramic_tiles WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	$(function() {
		$('.select2').select2();
	})
	$('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });
	$(document).ready(function() {

		$('#btn_edit_data').hide();
		$('#alert').hide();

		$('#tiles_type').change(function() {
			if ($(this).val() == "modular") {
				$('#tiles_grade').html('<option value="M10 x 10">M10 x 10</option><option value="M15 x 15">M15 x 15</option><option value="M15 x 10">M15 x 10</option><option value="M20 x 10">M20 x 10</option><option value="M20 x 15">M20 x 15</option><option value="M20 x 20">M20 x 20</option><option value="M20 x 30">M20 x 30</option><option value="M20 x 40">M20 x 40</option><option value="M25 x 25">M25 x 25</option><option value="M30 x 15">M30 x 15</option><option value="M30 x 30">M30 x 30</option><option value="M30 x 45">M30 x 45</option><option value="M30 x 60">M30 x 60</option><option value="M30 x 75">M30 x 75</option><option value="M30 x 30">M30 x 30</option><option value="M40 x 30">M40 x 30</option><option value="M40 x 40">M40 x 40</option><option value="M45 x 45">M45 x 45</option><option value="M40 x 80">M40 x 80</option><option value="M45 x 90">M45 x 90</option><option value="M50 x 50">M50 x 50</option><option value="M60 x 60">M60 x 60</option><option value="M60 x 90">M60 x 90</option><option value="M80 x 80">M80 x 80</option><option value="M90 x 90">M90 x 90</option><option value="M60 x 120">M60 x 120</option><option value="M100 x 100">M100 x 100</option><option value="M90 x 120">M90 x 120</option><option value="M120 x 120">M120 x 120</option>');
			} else {
				$('#tiles_grade').html('<option value="10.8 x 10.8">10.8 x 10.8</option><option value="15 x 7.5">15 x 7.5</option><option value="15.2 x 7.6">15.2 x 7.6</option><option value="15.2 x 15.2">15.2 x 15.2</option><option value="21.6 x 10.8">21.6 x 10.8</option><option value="25 x 33">25 x 33</option><option value="31.5 x 42">31.5 x 42</option><option value="32 x 32">32 x 32</option><option value="25 x 38">25 x 38</option><option value="32 x 40">32 x 40</option><option value="32 x 48">32 x 48</option><option value="32 x 60">32 x 60</option><option value="33 x 33">33 x 33</option><option value="33 x 48">33 x 48</option><option value="33 x 60">33 x 60</option><option value="33 x 90">33 x 90</option><option value="30.6 x 30.6">30.6 x 30.6</option><option value="31.5 x 31.5">31.5 x 31.5</option><option value="40.6 x 40.6">40.6 x 40.6</option><option value="60.5 x 60.5">60.5 x 60.5</option><option value="81.5 x 81.5">81.5 x 81.5</option>');
			}



		})







		function str_auto() {
			$('#txtstr').css("background-color", "var(--success)");
			$('#dima1').val(1);
			$('#dima2').val(1);
			$('#dima3').val(1);
			$('#dima4').val(1);
			$('#dima5').val(1);
			$('#dima6').val(1);
			$('#dima7').val(1);
			$('#dimb1').val(1);
			$('#dimb2').val(1);
			$('#dimb3').val(1);
			$('#dimb4').val(1);
			$('#dimb5').val(1);
			$('#dimb6').val(1);
			$('#dimb7').val(1);
			$('#dimh1').val(1);
			$('#dimh2').val(1);
			$('#dimh3').val(1);
			$('#dimh4').val(1);
			$('#dimh5').val(1);
			$('#dimh6').val(1);
			$('#dimh7').val(1);
			$('#l1').val(1);
			$('#l2').val(1);
			$('#l3').val(1);
			$('#l4').val(1);
			$('#l5').val(1);
			$('#l6').val(1);
			$('#l7').val(1);
			$('#load1').val(1);
			$('#load2').val(1);
			$('#load3').val(1);
			$('#load4').val(1);
			$('#load5').val(1);
			$('#load6').val(1);
			$('#load7').val(1);
			$('#wa1').val(1);
			$('#wa2').val(1);
			$('#wa3').val(1);
			$('#wa4').val(1);
			$('#wa5').val(1);
			$('#wa6').val(1);
			$('#wa7').val(1);
			$('#str1').val(1);
			$('#str2').val(1);
			$('#str3').val(1);
			$('#str4').val(1);
			$('#str5').val(1);
			$('#str6').val(1);
			$('#str7').val(1);
			$('#rstr1').val(1);
			$('#rstr2').val(1);
			$('#rstr3').val(1);
			$('#rstr4').val(1);
			$('#rstr5').val(1);
			$('#rstr6').val(1);
			$('#rstr7').val(1);
			$('#avg_str').val(1);
			$('#avg_rstr').val(1);
		}

		//MODUAS OF RUPTURE
		$('#chk_str').change(function() {
			if (this.checked) {
				str_auto();

			} else {
				$('#txtstr').css("background-color", "white");
				$('#dima1').val(null);
				$('#dima2').val(null);
				$('#dima3').val(null);
				$('#dima4').val(null);
				$('#dima5').val(null);
				$('#dima6').val(null);
				$('#dima7').val(null);
				$('#dimb1').val(null);
				$('#dimb2').val(null);
				$('#dimb3').val(null);
				$('#dimb4').val(null);
				$('#dimb5').val(null);
				$('#dimb6').val(null);
				$('#dimb7').val(null);
				$('#dimh1').val(null);
				$('#dimh2').val(null);
				$('#dimh3').val(null);
				$('#dimh4').val(null);
				$('#dimh5').val(null);
				$('#dimh6').val(null);
				$('#dimh7').val(null);
				$('#l1').val(null);
				$('#l2').val(null);
				$('#l3').val(null);
				$('#l4').val(null);
				$('#l5').val(null);
				$('#l6').val(null);
				$('#l7').val(null);
				$('#load1').val(null);
				$('#load2').val(null);
				$('#load3').val(null);
				$('#load4').val(null);
				$('#load5').val(null);
				$('#load6').val(null);
				$('#load7').val(null);
				$('#wa1').val(null);
				$('#wa2').val(null);
				$('#wa3').val(null);
				$('#wa4').val(null);
				$('#wa5').val(null);
				$('#wa6').val(null);
				$('#wa7').val(null);
				$('#str1').val(null);
				$('#str2').val(null);
				$('#str3').val(null);
				$('#str4').val(null);
				$('#str5').val(null);
				$('#str6').val(null);
				$('#str7').val(null);
				$('#rstr1').val(null);
				$('#rstr2').val(null);
				$('#rstr3').val(null);
				$('#rstr4').val(null);
				$('#rstr5').val(null);
				$('#rstr6').val(null);
				$('#rstr7').val(null);
				$('#avg_str').val(null);
				$('#avg_rstr').val(null);

			}
		});



		function scr_auto() {
			$('#txtscr').css("background-color", "var(--success)");
			$('#s1').val(1);
			$('#s2').val(1);
			$('#s3').val(1);
			$('#avg_s').val(1);
			$('#chk_dim').val(1);
			$('#len1').val(1);
			$('#len2').val(1);
			$('#len3').val(1);
			$('#len4').val(1);
			$('#len5').val(1);
			$('#len6').val(1);
			$('#len7').val(1);
			$('#len8').val(1);
			$('#len9').val(1);
			$('#len10').val(1);
			$('#width1').val(1);
			$('#width2').val(1);
			$('#width3').val(1);
			$('#width4').val(1);
			$('#width5').val(1);
			$('#width6').val(1);
			$('#width7').val(1);
			$('#width8').val(1);
			$('#width9').val(1);
			$('#width10').val(1);
			$('#thk1').val(1);
			$('#thk2').val(1);
			$('#thk3').val(1);
			$('#thk4').val(1);
			$('#thk5').val(1);
			$('#thk6').val(1);
			$('#thk7').val(1);
			$('#thk8').val(1);
			$('#thk9').val(1);
			$('#thk10').val(1);
			$('#avg_len').val(1);
			$('#avg_width').val(1);
			$('#avg_thk').val(1);

		}


		$('#chk_scr').change(function() {
			if (this.checked) {
				scr_auto();

			} else {
				$('#txtscr').css("background-color", "white");
				$('#s1').val(null);
				$('#s2').val(null);
				$('#s3').val(null);
				$('#avg_s').val(null);
				$('#chk_dim').val(null);
				$('#len1').val(null);
				$('#len2').val(null);
				$('#len3').val(null);
				$('#len4').val(null);
				$('#len5').val(null);
				$('#len6').val(null);
				$('#len7').val(null);
				$('#len8').val(null);
				$('#len9').val(null);
				$('#len10').val(null);
				$('#width1').val(null);
				$('#width2').val(null);
				$('#width3').val(null);
				$('#width4').val(null);
				$('#width5').val(null);
				$('#width6').val(null);
				$('#width7').val(null);
				$('#width8').val(null);
				$('#width9').val(null);
				$('#width10').val(null);
				$('#thk1').val(null);
				$('#thk2').val(null);
				$('#thk3').val(null);
				$('#thk4').val(null);
				$('#thk5').val(null);
				$('#thk6').val(null);
				$('#thk7').val(null);
				$('#thk8').val(null);
				$('#thk9').val(null);
				$('#thk10').val(null);
				$('#avg_len').val(null);
				$('#avg_width').val(null);
				$('#avg_thk').val(null);

			}
		});

		function wtr_auto() {
			$('#txtwtr').css("background-color", "var(--success)");
			$('#a1').val(1);
			$('#a2').val(1);
			$('#a3').val(1);
			$('#a4').val(1);
			$('#a5').val(1);
			$('#a6').val(1);
			$('#a7').val(1);
			$('#a8').val(1);
			$('#a9').val(1);
			$('#a10').val(1);
			$('#b1').val(1);
			$('#b2').val(1);
			$('#b3').val(1);
			$('#b4').val(1);
			$('#b5').val(1);
			$('#b6').val(1);
			$('#b7').val(1);
			$('#b8').val(1);
			$('#b9').val(1);
			$('#b10').val(1);
			$('#wtr1').val(1);
			$('#wtr2').val(1);
			$('#wtr3').val(1);
			$('#wtr4').val(1);
			$('#wtr5').val(1);
			$('#wtr6').val(1);
			$('#wtr7').val(1);
			$('#wtr8').val(1);
			$('#wtr9').val(1);
			$('#wtr10').val(1);
			$('#avg_wtr').val(1);
		}

		//Flatness
		$('#chk_wtr').change(function() {
			if (this.checked) {
				wtr_auto();

			} else {
				$('#txtwtr').css("background-color", "white");
				$('#a1').val(null);
				$('#a2').val(null);
				$('#a3').val(null);
				$('#a4').val(null);
				$('#a5').val(null);
				$('#a6').val(null);
				$('#a7').val(null);
				$('#a8').val(null);
				$('#a9').val(null);
				$('#a10').val(null);
				$('#b1').val(null);
				$('#b2').val(null);
				$('#b3').val(null);
				$('#b4').val(null);
				$('#b5').val(null);
				$('#b6').val(null);
				$('#b7').val(null);
				$('#b8').val(null);
				$('#b9').val(null);
				$('#b10').val(null);
				$('#wtr1').val(null);
				$('#wtr2').val(null);
				$('#wtr3').val(null);
				$('#wtr4').val(null);
				$('#wtr5').val(null);
				$('#wtr6').val(null);
				$('#wtr7').val(null);
				$('#wtr8').val(null);
				$('#wtr9').val(null);
				$('#wtr10').val(null);
				$('#avg_wtr').val(null);

			}
		});

		function tiles_boxed() {
			var tiles_grade = $('#tiles_grade').val();
			if ((tiles_grade == "M10 x 10") || (tiles_grade == "M15 x 15") || (tiles_grade == "M15 x 10") || (tiles_grade == "M20 x 10") || (tiles_grade == "M20 x 15") || (tiles_grade == "M20 x 20") || (tiles_grade == "M20 x 30") || (tiles_grade == "M20 x 40") || (tiles_grade == "M25 x 25") || (tiles_grade == "M30 x 15") || (tiles_grade == "M30 x 30") || (tiles_grade == "10.8 x 10.8") || (tiles_grade == "15 x 7.5") || (tiles_grade == "15.2 x 7.6") || (tiles_grade == "15.2 x 15.2") || (tiles_grade == "21.6 x 10.8") || (tiles_grade == "25 x 33")) {
				$('#length_1_1, #length_1_2, #length_1_3, #length_1_4, #length_2_1, #length_2_2, #length_2_3, #length_2_4, #length_3_1, #length_3_2, #length_3_3, #length_3_4, #length_4_1, #length_4_2, #length_4_3, #length_4_4, #length_5_1, #length_5_2, #length_5_3, #length_5_4, #length_6_1, #length_6_2, #length_6_3, #length_6_4, #length_7_1, #length_7_2, #length_7_3, #length_7_4, #length_8_1, #length_8_2, #length_8_3, #length_8_4, #length_9_1, #length_9_2, #length_9_3, #length_9_4, #length_10_1, #length_10_2, #length_10_3, #length_10_4, #width_1_1, #width_1_2, #width_1_3, #width_1_4, #width_2_1, #width_2_2, #width_2_3, #width_2_4, #width_3_1, #width_3_2, #width_3_3, #width_3_4, #width_4_1, #width_4_2, #width_4_3, #width_4_4, #width_5_1, #width_5_2, #width_5_3, #width_5_4, #width_6_1, #width_6_2, #width_6_3, #width_6_4, #width_7_1, #width_7_2, #width_7_3, #width_7_4, #width_8_1, #width_8_2, #width_8_3, #width_8_4, #width_9_1, #width_9_2, #width_9_3, #width_9_4, #width_10_1, #width_10_2, #width_10_3, #width_10_4, #thick_1_1, #thick_1_2, #thick_1_3, #thick_1_4, #thick_2_1, #thick_2_2, #thick_2_3, #thick_2_4, #thick_3_1, #thick_3_2, #thick_3_3, #thick_3_4, #thick_4_1, #thick_4_2, #thick_4_3, #thick_4_4, #thick_5_1, #thick_5_2, #thick_5_3, #thick_5_4, #thick_6_1, #thick_6_2, #thick_6_3, #thick_6_4, #thick_7_1, #thick_7_2, #thick_7_3, #thick_7_4, #thick_8_1, #thick_8_2, #thick_8_3, #thick_8_4, #thick_9_1, #thick_9_2, #thick_9_3, #thick_9_4, #thick_10_1, #thick_10_2, #thick_10_3, #thick_10_4').show();
			} else if ((tiles_grade == "M30 x 45") || (tiles_grade == "M30 x 60") || (tiles_grade == "M30 x 75") || (tiles_grade == "M30 x 30") || (tiles_grade == "M40 x 30") || (tiles_grade == "M40 x 40") || (tiles_grade == "M45 x 45") || (tiles_grade == "M40 x 80") || (tiles_grade == "M45 x 90") || (tiles_grade == "M50 x 50") || (tiles_grade == "M60 x 60") || (tiles_grade == "25 x 38") || (tiles_grade == "31.5 x 42") || (tiles_grade == "32 x 32") || (tiles_grade == "32 x 40") || (tiles_grade == "32 x 48") || (tiles_grade == "32 x 60") || (tiles_grade == "33 x 33") || (tiles_grade == "33 x 48") || (tiles_grade == "33 x 60") || (tiles_grade == "33 x 90") || (tiles_grade == "30.6 x 30.6") || (tiles_grade == "31.5 x 31.5") || (tiles_grade == "40.6 x 40.6")) {
				$('#length_1_1, #length_1_2, #length_1_3, #length_1_4, #length_2_1, #length_2_2, #length_2_3, #length_2_4, #length_3_1, #length_3_2, #length_3_3, #length_3_4, #length_4_1, #length_4_2, #length_4_3, #length_4_4, #length_5_1, #length_5_2, #length_5_3, #length_5_4, #length_6_1, #length_6_2, #length_6_3, #length_6_4, #length_7_1, #length_7_2, #length_7_3, #length_7_4, #length_8_1, #length_8_2, #length_8_3, #length_8_4, #length_9_1, #length_9_2, #length_9_3, #length_9_4, #length_10_1, #length_10_2, #length_10_3, #length_10_4, #width_1_1, #width_1_2, #width_1_3, #width_1_4, #width_2_1, #width_2_2, #width_2_3, #width_2_4, #width_3_1, #width_3_2, #width_3_3, #width_3_4, #width_4_1, #width_4_2, #width_4_3, #width_4_4, #width_5_1, #width_5_2, #width_5_3, #width_5_4, #width_6_1, #width_6_2, #width_6_3, #width_6_4, #width_7_1, #width_7_2, #width_7_3, #width_7_4, #width_8_1, #width_8_2, #width_8_3, #width_8_4, #width_9_1, #width_9_2, #width_9_3, #width_9_4, #width_10_1, #width_10_2, #width_10_3, #width_10_4, #thick_1_1, #thick_1_2, #thick_1_3, #thick_1_4, #thick_2_1, #thick_2_2, #thick_2_3, #thick_2_4, #thick_3_1, #thick_3_2, #thick_3_3, #thick_3_4, #thick_4_1, #thick_4_2, #thick_4_3, #thick_4_4, #thick_5_1, #thick_5_2, #thick_5_3, #thick_5_4, #thick_6_1, #thick_6_2, #thick_6_3, #thick_6_4, #thick_7_1, #thick_7_2, #thick_7_3, #thick_7_4, #thick_8_1, #thick_8_2, #thick_8_3, #thick_8_4, #thick_9_1, #thick_9_2, #thick_9_3, #thick_9_4, #thick_10_1, #thick_10_2, #thick_10_3, #thick_10_4').show();

				$('#length_8_1, #length_8_2, #length_8_3, #length_8_4, #length_9_1, #length_9_2, #length_9_3, #length_9_4, #length_10_1, #length_10_2, #length_10_3, #length_10_4, #width_8_1, #width_8_2, #width_8_3, #width_8_4, #width_9_1, #width_9_2, #width_9_3, #width_9_4, #width_10_1, #width_10_2, #width_10_3, #width_10_4, #thick_8_1, #thick_8_2, #thick_8_3, #thick_8_4, #thick_9_1, #thick_9_2, #thick_9_3, #thick_9_4, #thick_10_1, #thick_10_2, #thick_10_3, #thick_10_4').hide();
			} else if ((tiles_grade == "M60 x 90") || (tiles_grade == "M80 x 80") || (tiles_grade == "M90 x 90") || (tiles_grade == "M60 x 120") || (tiles_grade == "M100 x 100") || (tiles_grade == "M90 x 120") || (tiles_grade == "M120 x 120") || (tiles_grade == "60.5 x 60.5") || (tiles_grade == "81.5 x 81.5")) {
				$('#length_1_1, #length_1_2, #length_1_3, #length_1_4, #length_2_1, #length_2_2, #length_2_3, #length_2_4, #length_3_1, #length_3_2, #length_3_3, #length_3_4, #length_4_1, #length_4_2, #length_4_3, #length_4_4, #length_5_1, #length_5_2, #length_5_3, #length_5_4, #length_6_1, #length_6_2, #length_6_3, #length_6_4, #length_7_1, #length_7_2, #length_7_3, #length_7_4, #length_8_1, #length_8_2, #length_8_3, #length_8_4, #length_9_1, #length_9_2, #length_9_3, #length_9_4, #length_10_1, #length_10_2, #length_10_3, #length_10_4, #width_1_1, #width_1_2, #width_1_3, #width_1_4, #width_2_1, #width_2_2, #width_2_3, #width_2_4, #width_3_1, #width_3_2, #width_3_3, #width_3_4, #width_4_1, #width_4_2, #width_4_3, #width_4_4, #width_5_1, #width_5_2, #width_5_3, #width_5_4, #width_6_1, #width_6_2, #width_6_3, #width_6_4, #width_7_1, #width_7_2, #width_7_3, #width_7_4, #width_8_1, #width_8_2, #width_8_3, #width_8_4, #width_9_1, #width_9_2, #width_9_3, #width_9_4, #width_10_1, #width_10_2, #width_10_3, #width_10_4, #thick_1_1, #thick_1_2, #thick_1_3, #thick_1_4, #thick_2_1, #thick_2_2, #thick_2_3, #thick_2_4, #thick_3_1, #thick_3_2, #thick_3_3, #thick_3_4, #thick_4_1, #thick_4_2, #thick_4_3, #thick_4_4, #thick_5_1, #thick_5_2, #thick_5_3, #thick_5_4, #thick_6_1, #thick_6_2, #thick_6_3, #thick_6_4, #thick_7_1, #thick_7_2, #thick_7_3, #thick_7_4, #thick_8_1, #thick_8_2, #thick_8_3, #thick_8_4, #thick_9_1, #thick_9_2, #thick_9_3, #thick_9_4, #thick_10_1, #thick_10_2, #thick_10_3, #thick_10_4').show();
				$('#length_6_1, #length_6_2, #length_6_3, #length_6_4, #length_7_1, #length_7_2, #length_7_3, #length_7_4, #length_8_1, #length_8_2, #length_8_3, #length_8_4, #length_9_1, #length_9_2, #length_9_3, #length_9_4, #length_10_1, #length_10_2, #length_10_3, #length_10_4, #width_6_1, #width_6_2, #width_6_3, #width_6_4, #width_7_1, #width_7_2, #width_7_3, #width_7_4, #width_8_1, #width_8_2, #width_8_3, #width_8_4, #width_9_1, #width_9_2, #width_9_3, #width_9_4, #width_10_1, #width_10_2, #width_10_3, #width_10_4, #thick_6_1, #thick_6_2, #thick_6_3, #thick_6_4, #thick_7_1, #thick_7_2, #thick_7_3, #thick_7_4, #thick_8_1, #thick_8_2, #thick_8_3, #thick_8_4, #thick_9_1, #thick_9_2, #thick_9_3, #thick_9_4, #thick_10_1, #thick_10_2, #thick_10_3, #thick_10_4').hide();
			}
		}

		$('#tiles_grade').change(function() {
			tiles_boxed();
		})

		function dim_auto() {
			$('#txtdim').css("background-color", "var(--success)");
			var tiles_type = $('#tiles_type').val();
			var tiles_grade = $('#tiles_grade').val();

			if (tiles_grade == "M10 x 10") {
				var dim_length = randomNumberFromRange(100.00, 100.00).toFixed(2);
				var dim_width = randomNumberFromRange(100.00, 100.00).toFixed(2);
			} else if (tiles_grade == "M15 x 15") {
				var dim_length = randomNumberFromRange(150.00, 150.00).toFixed(2);
				var dim_width = randomNumberFromRange(150.00, 150.00).toFixed(2);
			} else if (tiles_grade == "M15 x 10") {
				var dim_length = randomNumberFromRange(150.00, 150.00).toFixed(2);
				var dim_width = randomNumberFromRange(100.00, 100.00).toFixed(2);
			} else if (tiles_grade == "M20 x 10") {
				var dim_length = randomNumberFromRange(200.00, 200.00).toFixed(2);
				var dim_width = randomNumberFromRange(100.00, 100.00).toFixed(2);
			} else if (tiles_grade == "M20 x 15") {
				var dim_length = randomNumberFromRange(200.00, 200.00).toFixed(2);
				var dim_width = randomNumberFromRange(150.00, 150.00).toFixed(2);
			} else if (tiles_grade == "M20 x 20") {
				var dim_length = randomNumberFromRange(200.00, 200.00).toFixed(2);
				var dim_width = randomNumberFromRange(200.00, 200.00).toFixed(2);
			} else if (tiles_grade == "M20 x 30") {
				var dim_length = randomNumberFromRange(300.00, 300.00).toFixed(2);
				var dim_width = randomNumberFromRange(200.00, 200.00).toFixed(2);
			} else if (tiles_grade == "M20 x 40") {
				var dim_length = randomNumberFromRange(400.00, 400.00).toFixed(2);
				var dim_width = randomNumberFromRange(200.00, 200.00).toFixed(2);
			} else if (tiles_grade == "M25 x 25") {
				var dim_length = randomNumberFromRange(250.00, 250.00).toFixed(2);
				var dim_width = randomNumberFromRange(250.00, 250.00).toFixed(2);
			} else if (tiles_grade == "M30 x 15") {
				var dim_length = randomNumberFromRange(300.00, 300.00).toFixed(2);
				var dim_width = randomNumberFromRange(150.00, 150.00).toFixed(2);
			} else if (tiles_grade == "M30 x 30") {
				var dim_length = randomNumberFromRange(300.00, 300.00).toFixed(2);
				var dim_width = randomNumberFromRange(300.00, 300.00).toFixed(2);
			} else if (tiles_grade == "M30 x 45") {
				var dim_length = randomNumberFromRange(450.00, 450.00).toFixed(2);
				var dim_width = randomNumberFromRange(300.00, 300.00).toFixed(2);
			} else if (tiles_grade == "M30 x 60") {
				var dim_length = randomNumberFromRange(600.00, 600.00).toFixed(2);
				var dim_width = randomNumberFromRange(300.00, 300.00).toFixed(2);
			} else if (tiles_grade == "M30 x 75") {
				var dim_length = randomNumberFromRange(750.00, 750.00).toFixed(2);
				var dim_width = randomNumberFromRange(300.00, 300.00).toFixed(2);
			} else if (tiles_grade == "M30 x 30") {
				var dim_length = randomNumberFromRange(300.00, 300.00).toFixed(2);
				var dim_width = randomNumberFromRange(300.00, 300.00).toFixed(2);
			} else if (tiles_grade == "M40 x 30") {
				var dim_length = randomNumberFromRange(400.00, 400.00).toFixed(2);
				var dim_width = randomNumberFromRange(300.00, 300.00).toFixed(2);
			} else if (tiles_grade == "M40 x 40") {
				var dim_length = randomNumberFromRange(400.00, 400.00).toFixed(2);
				var dim_width = randomNumberFromRange(400.00, 400.00).toFixed(2);
			} else if (tiles_grade == "M45 x 45") {
				var dim_length = randomNumberFromRange(450.00, 450.00).toFixed(2);
				var dim_width = randomNumberFromRange(450.00, 450.00).toFixed(2);
			} else if (tiles_grade == "M40 x 80") {
				var dim_length = randomNumberFromRange(800.00, 800.00).toFixed(2);
				var dim_width = randomNumberFromRange(400.00, 400.00).toFixed(2);
			} else if (tiles_grade == "M45 x 90") {
				var dim_length = randomNumberFromRange(900.00, 900.00).toFixed(2);
				var dim_width = randomNumberFromRange(450.00, 450.00).toFixed(2);
			} else if (tiles_grade == "M50 x 50") {
				var dim_length = randomNumberFromRange(500.00, 500.00).toFixed(2);
				var dim_width = randomNumberFromRange(500.00, 500.00).toFixed(2);
			} else if (tiles_grade == "M60 x 60") {
				var dim_length = randomNumberFromRange(600.00, 600.00).toFixed(2);
				var dim_width = randomNumberFromRange(600.00, 600.00).toFixed(2);
			} else if (tiles_grade == "M60 x 90") {
				var dim_length = randomNumberFromRange(900.00, 900.00).toFixed(2);
				var dim_width = randomNumberFromRange(600.00, 600.00).toFixed(2);
			} else if (tiles_grade == "M80 x 80") {
				var dim_length = randomNumberFromRange(800.00, 800.00).toFixed(2);
				var dim_width = randomNumberFromRange(800.00, 800.00).toFixed(2);
			} else if (tiles_grade == "M90 x 90") {
				var dim_length = randomNumberFromRange(900.00, 900.00).toFixed(2);
				var dim_width = randomNumberFromRange(900.00, 900.00).toFixed(2);
			} else if (tiles_grade == "M60 x 120") {
				var dim_length = randomNumberFromRange(1200.00, 1200.00).toFixed(2);
				var dim_width = randomNumberFromRange(600.00, 600.00).toFixed(2);
			} else if (tiles_grade == "M100 x 100") {
				var dim_length = randomNumberFromRange(1000.00, 1000.00).toFixed(2);
				var dim_width = randomNumberFromRange(1000.00, 1000.00).toFixed(2);
			} else if (tiles_grade == "M90 x 120") {
				var dim_length = randomNumberFromRange(1200.00, 1200.00).toFixed(2);
				var dim_width = randomNumberFromRange(900.00, 900.00).toFixed(2);
			} else if (tiles_grade == "M120 x 120") {
				var dim_length = randomNumberFromRange(1200.00, 1200.00).toFixed(2);
				var dim_width = randomNumberFromRange(1200.00, 1200.00).toFixed(2);
			} else if (tiles_grade == "10.8 x 10.8") {
				var dim_length = randomNumberFromRange(108.00, 108.00).toFixed(2);
				var dim_width = randomNumberFromRange(108.00, 108.00).toFixed(2);
			} else if (tiles_grade == "15 x 7.5") {
				var dim_length = randomNumberFromRange(150.00, 150.00).toFixed(2);
				var dim_width = randomNumberFromRange(75.00, 75.00).toFixed(2);
			} else if (tiles_grade == "15.2 x 7.6") {
				var dim_length = randomNumberFromRange(152.00, 152.00).toFixed(2);
				var dim_width = randomNumberFromRange(76.00, 76.00).toFixed(2);
			} else if (tiles_grade == "15.2 x 15.2") {
				var dim_length = randomNumberFromRange(152.00, 152.00).toFixed(2);
				var dim_width = randomNumberFromRange(152.00, 152.00).toFixed(2);
			} else if (tiles_grade == "21.6 x 10.8") {
				var dim_length = randomNumberFromRange(216.00, 216.00).toFixed(2);
				var dim_width = randomNumberFromRange(108.00, 108.00).toFixed(2);
			} else if (tiles_grade == "25 x 33") {
				var dim_length = randomNumberFromRange(330.00, 330.00).toFixed(2);
				var dim_width = randomNumberFromRange(250.00, 250.00).toFixed(2);
			} else if (tiles_grade == "31.5 x 42") {
				var dim_length = randomNumberFromRange(420.00, 420.00).toFixed(2);
				var dim_width = randomNumberFromRange(315.00, 315.00).toFixed(2);
			} else if (tiles_grade == "32 x 32") {
				var dim_length = randomNumberFromRange(320.00, 320.00).toFixed(2);
				var dim_width = randomNumberFromRange(320.00, 320.00).toFixed(2);
			} else if (tiles_grade == "25 x 38") {
				var dim_length = randomNumberFromRange(380.00, 380.00).toFixed(2);
				var dim_width = randomNumberFromRange(250.00, 250.00).toFixed(2);
			} else if (tiles_grade == "32 x 40") {
				var dim_length = randomNumberFromRange(400.00, 400.00).toFixed(2);
				var dim_width = randomNumberFromRange(320.00, 320.00).toFixed(2);
			} else if (tiles_grade == "32 x 48") {
				var dim_length = randomNumberFromRange(480.00, 480.00).toFixed(2);
				var dim_width = randomNumberFromRange(320.00, 320.00).toFixed(2);
			} else if (tiles_grade == "32 x 60") {
				var dim_length = randomNumberFromRange(600.00, 600.00).toFixed(2);
				var dim_width = randomNumberFromRange(320.00, 320.00).toFixed(2);
			} else if (tiles_grade == "33 x 33") {
				var dim_length = randomNumberFromRange(330.00, 330.00).toFixed(2);
				var dim_width = randomNumberFromRange(330.00, 330.00).toFixed(2);
			} else if (tiles_grade == "33 x 48") {
				var dim_length = randomNumberFromRange(480.00, 480.00).toFixed(2);
				var dim_width = randomNumberFromRange(330.00, 330.00).toFixed(2);
			} else if (tiles_grade == "33 x 60") {
				var dim_length = randomNumberFromRange(600.00, 600.00).toFixed(2);
				var dim_width = randomNumberFromRange(330.00, 330.00).toFixed(2);
			} else if (tiles_grade == "33 x 90") {
				var dim_length = randomNumberFromRange(900.00, 900.00).toFixed(2);
				var dim_width = randomNumberFromRange(330.00, 330.00).toFixed(2);
			} else if (tiles_grade == "30.6 x 30.6") {
				var dim_length = randomNumberFromRange(306.00, 306.00).toFixed(2);
				var dim_width = randomNumberFromRange(306.00, 306.00).toFixed(2);
			} else if (tiles_grade == "31.5 x 31.5") {
				var dim_length = randomNumberFromRange(315.00, 315.00).toFixed(2);
				var dim_width = randomNumberFromRange(315.00, 315.00).toFixed(2);
			} else if (tiles_grade == "40.6 x 40.6") {
				var dim_length = randomNumberFromRange(406.00, 406.00).toFixed(2);
				var dim_width = randomNumberFromRange(406.00, 406.00).toFixed(2);
			} else if (tiles_grade == "60.5 x 60.5") {
				var dim_length = randomNumberFromRange(605.00, 605.00).toFixed(2);
				var dim_width = randomNumberFromRange(605.00, 605.00).toFixed(2);
			} else if (tiles_grade == "81.5 x 81.5") {
				var dim_length = randomNumberFromRange(815.00, 815.00).toFixed(2);
				var dim_width = randomNumberFromRange(815.00, 815.00).toFixed(2);
			}

			var length_1_1 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_1_2 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_1_3 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_1_4 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_2_1 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_2_2 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_2_3 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_2_4 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_3_1 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_3_2 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_3_3 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_3_4 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_4_1 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_4_2 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_4_3 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_4_4 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_5_1 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_5_2 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_5_3 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_5_4 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_6_1 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_6_2 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_6_3 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_6_4 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_7_1 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_7_2 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_7_3 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_7_4 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_8_1 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_8_2 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_8_3 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_8_4 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_9_1 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_9_2 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_9_3 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_9_4 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_10_1 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_10_2 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_10_3 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));
			var length_10_4 = (+dim_length) + (+randomNumberFromRange(-0.15, 0.30));

			var width_1_1 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_1_2 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_1_3 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_1_4 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_2_1 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_2_2 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_2_3 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_2_4 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_3_1 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_3_2 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_3_3 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_3_4 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_4_1 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_4_2 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_4_3 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_4_4 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_5_1 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_5_2 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_5_3 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_5_4 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_6_1 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_6_2 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_6_3 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_6_4 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_7_1 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_7_2 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_7_3 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_7_4 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_8_1 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_8_2 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_8_3 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_8_4 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_9_1 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_9_2 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_9_3 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_9_4 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_10_1 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_10_2 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_10_3 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));
			var width_10_4 = (+dim_width) + (+randomNumberFromRange(-0.15, 0.30));





			var thick_1_1 = randomNumberFromRange(600.10, 600.70);
			var thick_1_2 = randomNumberFromRange(600.10, 600.70);
			var thick_1_3 = randomNumberFromRange(600.10, 600.70);
			var thick_1_4 = randomNumberFromRange(600.10, 600.70);
			var thick_2_1 = randomNumberFromRange(600.10, 600.70);
			var thick_2_2 = randomNumberFromRange(600.10, 600.70);
			var thick_2_3 = randomNumberFromRange(600.10, 600.70);
			var thick_2_4 = randomNumberFromRange(600.10, 600.70);
			var thick_3_1 = randomNumberFromRange(600.10, 600.70);
			var thick_3_2 = randomNumberFromRange(600.10, 600.70);
			var thick_3_3 = randomNumberFromRange(600.10, 600.70);
			var thick_3_4 = randomNumberFromRange(600.10, 600.70);
			var thick_4_1 = randomNumberFromRange(600.10, 600.70);
			var thick_4_2 = randomNumberFromRange(600.10, 600.70);
			var thick_4_3 = randomNumberFromRange(600.10, 600.70);
			var thick_4_4 = randomNumberFromRange(600.10, 600.70);
			var thick_5_1 = randomNumberFromRange(600.10, 600.70);
			var thick_5_2 = randomNumberFromRange(600.10, 600.70);
			var thick_5_3 = randomNumberFromRange(600.10, 600.70);
			var thick_5_4 = randomNumberFromRange(600.10, 600.70);
			var thick_6_1 = randomNumberFromRange(600.10, 600.70);
			var thick_6_2 = randomNumberFromRange(600.10, 600.70);
			var thick_6_3 = randomNumberFromRange(600.10, 600.70);
			var thick_6_4 = randomNumberFromRange(600.10, 600.70);
			var thick_7_1 = randomNumberFromRange(600.10, 600.70);
			var thick_7_2 = randomNumberFromRange(600.10, 600.70);
			var thick_7_3 = randomNumberFromRange(600.10, 600.70);
			var thick_7_4 = randomNumberFromRange(600.10, 600.70);
			var thick_8_1 = randomNumberFromRange(600.10, 600.70);
			var thick_8_2 = randomNumberFromRange(600.10, 600.70);
			var thick_8_3 = randomNumberFromRange(600.10, 600.70);
			var thick_8_4 = randomNumberFromRange(600.10, 600.70);
			var thick_9_1 = randomNumberFromRange(600.10, 600.70);
			var thick_9_2 = randomNumberFromRange(600.10, 600.70);
			var thick_9_3 = randomNumberFromRange(600.10, 600.70);
			var thick_9_4 = randomNumberFromRange(600.10, 600.70);
			var thick_10_1 = randomNumberFromRange(600.10, 600.70);
			var thick_10_2 = randomNumberFromRange(600.10, 600.70);
			var thick_10_3 = randomNumberFromRange(600.10, 600.70);
			var thick_10_4 = randomNumberFromRange(600.10, 600.70);


			if (tiles_type == "modular") {
				if ((tiles_grade == "M10 x 10") || (tiles_grade == "M15 x 15") || (tiles_grade == "M15 x 10") || (tiles_grade == "M20 x 10") || (tiles_grade == "M20 x 15") || (tiles_grade == "M20 x 20") || (tiles_grade == "M20 x 30") || (tiles_grade == "M20 x 40") || (tiles_grade == "M25 x 25") || (tiles_grade == "M30 x 15") || (tiles_grade == "M30 x 30")) {
					$('#length_1_1').val((+length_1_1).toFixed(2));
					$('#length_1_2').val((+length_1_2).toFixed(2));
					$('#length_1_3').val((+length_1_3).toFixed(2));
					$('#length_1_4').val((+length_1_4).toFixed(2));
					$('#length_2_1').val((+length_2_1).toFixed(2));
					$('#length_2_2').val((+length_2_2).toFixed(2));
					$('#length_2_3').val((+length_2_3).toFixed(2));
					$('#length_2_4').val((+length_2_4).toFixed(2));
					$('#length_3_1').val((+length_3_1).toFixed(2));
					$('#length_3_2').val((+length_3_2).toFixed(2));
					$('#length_3_3').val((+length_3_3).toFixed(2));
					$('#length_3_4').val((+length_3_4).toFixed(2));
					$('#length_4_1').val((+length_4_1).toFixed(2));
					$('#length_4_2').val((+length_4_2).toFixed(2));
					$('#length_4_3').val((+length_4_3).toFixed(2));
					$('#length_4_4').val((+length_4_4).toFixed(2));
					$('#length_5_1').val((+length_5_1).toFixed(2));
					$('#length_5_2').val((+length_5_2).toFixed(2));
					$('#length_5_3').val((+length_5_3).toFixed(2));
					$('#length_5_4').val((+length_5_4).toFixed(2));
					$('#length_6_1').val((+length_6_1).toFixed(2));
					$('#length_6_2').val((+length_6_2).toFixed(2));
					$('#length_6_3').val((+length_6_3).toFixed(2));
					$('#length_6_4').val((+length_6_4).toFixed(2));
					$('#length_7_1').val((+length_7_1).toFixed(2));
					$('#length_7_2').val((+length_7_2).toFixed(2));
					$('#length_7_3').val((+length_7_3).toFixed(2));
					$('#length_7_4').val((+length_7_4).toFixed(2));
					$('#length_8_1').val((+length_8_1).toFixed(2));
					$('#length_8_2').val((+length_8_2).toFixed(2));
					$('#length_8_3').val((+length_8_3).toFixed(2));
					$('#length_8_4').val((+length_8_4).toFixed(2));
					$('#length_9_1').val((+length_9_1).toFixed(2));
					$('#length_9_2').val((+length_9_2).toFixed(2));
					$('#length_9_3').val((+length_9_3).toFixed(2));
					$('#length_9_4').val((+length_9_4).toFixed(2));
					$('#length_10_1').val((+length_10_1).toFixed(2));
					$('#length_10_2').val((+length_10_2).toFixed(2));
					$('#length_10_3').val((+length_10_3).toFixed(2));
					$('#length_10_4').val((+length_10_4).toFixed(2));

					$('#width_1_1').val((+width_1_1).toFixed(2));
					$('#width_1_2').val((+width_1_2).toFixed(2));
					$('#width_1_3').val((+width_1_3).toFixed(2));
					$('#width_1_4').val((+width_1_4).toFixed(2));
					$('#width_2_1').val((+width_2_1).toFixed(2));
					$('#width_2_2').val((+width_2_2).toFixed(2));
					$('#width_2_3').val((+width_2_3).toFixed(2));
					$('#width_2_4').val((+width_2_4).toFixed(2));
					$('#width_3_1').val((+width_3_1).toFixed(2));
					$('#width_3_2').val((+width_3_2).toFixed(2));
					$('#width_3_3').val((+width_3_3).toFixed(2));
					$('#width_3_4').val((+width_3_4).toFixed(2));
					$('#width_4_1').val((+width_4_1).toFixed(2));
					$('#width_4_2').val((+width_4_2).toFixed(2));
					$('#width_4_3').val((+width_4_3).toFixed(2));
					$('#width_4_4').val((+width_4_4).toFixed(2));
					$('#width_5_1').val((+width_5_1).toFixed(2));
					$('#width_5_2').val((+width_5_2).toFixed(2));
					$('#width_5_3').val((+width_5_3).toFixed(2));
					$('#width_5_4').val((+width_5_4).toFixed(2));
					$('#width_6_1').val((+width_6_1).toFixed(2));
					$('#width_6_2').val((+width_6_2).toFixed(2));
					$('#width_6_3').val((+width_6_3).toFixed(2));
					$('#width_6_4').val((+width_6_4).toFixed(2));
					$('#width_7_1').val((+width_7_1).toFixed(2));
					$('#width_7_2').val((+width_7_2).toFixed(2));
					$('#width_7_3').val((+width_7_3).toFixed(2));
					$('#width_7_4').val((+width_7_4).toFixed(2));
					$('#width_8_1').val((+width_8_1).toFixed(2));
					$('#width_8_2').val((+width_8_2).toFixed(2));
					$('#width_8_3').val((+width_8_3).toFixed(2));
					$('#width_8_4').val((+width_8_4).toFixed(2));
					$('#width_9_1').val((+width_9_1).toFixed(2));
					$('#width_9_2').val((+width_9_2).toFixed(2));
					$('#width_9_3').val((+width_9_3).toFixed(2));
					$('#width_9_4').val((+width_9_4).toFixed(2));
					$('#width_10_1').val((+width_10_1).toFixed(2));
					$('#width_10_2').val((+width_10_2).toFixed(2));
					$('#width_10_3').val((+width_10_3).toFixed(2));
					$('#width_10_4').val((+width_10_4).toFixed(2));

					$('#thick_1_1').val((+thick_1_1).toFixed(2));
					$('#thick_1_2').val((+thick_1_2).toFixed(2));
					$('#thick_1_3').val((+thick_1_3).toFixed(2));
					$('#thick_1_4').val((+thick_1_4).toFixed(2));
					$('#thick_2_1').val((+thick_2_1).toFixed(2));
					$('#thick_2_2').val((+thick_2_2).toFixed(2));
					$('#thick_2_3').val((+thick_2_3).toFixed(2));
					$('#thick_2_4').val((+thick_2_4).toFixed(2));
					$('#thick_3_1').val((+thick_3_1).toFixed(2));
					$('#thick_3_2').val((+thick_3_2).toFixed(2));
					$('#thick_3_3').val((+thick_3_3).toFixed(2));
					$('#thick_3_4').val((+thick_3_4).toFixed(2));
					$('#thick_4_1').val((+thick_4_1).toFixed(2));
					$('#thick_4_2').val((+thick_4_2).toFixed(2));
					$('#thick_4_3').val((+thick_4_3).toFixed(2));
					$('#thick_4_4').val((+thick_4_4).toFixed(2));
					$('#thick_5_1').val((+thick_5_1).toFixed(2));
					$('#thick_5_2').val((+thick_5_2).toFixed(2));
					$('#thick_5_3').val((+thick_5_3).toFixed(2));
					$('#thick_5_4').val((+thick_5_4).toFixed(2));
					$('#thick_6_1').val((+thick_6_1).toFixed(2));
					$('#thick_6_2').val((+thick_6_2).toFixed(2));
					$('#thick_6_3').val((+thick_6_3).toFixed(2));
					$('#thick_6_4').val((+thick_6_4).toFixed(2));
					$('#thick_7_1').val((+thick_7_1).toFixed(2));
					$('#thick_7_2').val((+thick_7_2).toFixed(2));
					$('#thick_7_3').val((+thick_7_3).toFixed(2));
					$('#thick_7_4').val((+thick_7_4).toFixed(2));
					$('#thick_8_1').val((+thick_8_1).toFixed(2));
					$('#thick_8_2').val((+thick_8_2).toFixed(2));
					$('#thick_8_3').val((+thick_8_3).toFixed(2));
					$('#thick_8_4').val((+thick_8_4).toFixed(2));
					$('#thick_9_1').val((+thick_9_1).toFixed(2));
					$('#thick_9_2').val((+thick_9_2).toFixed(2));
					$('#thick_9_3').val((+thick_9_3).toFixed(2));
					$('#thick_9_4').val((+thick_9_4).toFixed(2));
					$('#thick_10_1').val((+thick_10_1).toFixed(2));
					$('#thick_10_2').val((+thick_10_2).toFixed(2));
					$('#thick_10_3').val((+thick_10_3).toFixed(2));
					$('#thick_10_4').val((+thick_10_4).toFixed(2));

					var length_1_1 = $('#length_1_1').val();
					var length_2_1 = $('#length_2_1').val();
					var length_3_1 = $('#length_3_1').val();
					var length_4_1 = $('#length_4_1').val();
					var length_5_1 = $('#length_5_1').val();
					var length_6_1 = $('#length_6_1').val();
					var length_7_1 = $('#length_7_1').val();
					var length_8_1 = $('#length_8_1').val();
					var length_9_1 = $('#length_9_1').val();
					var length_10_1 = $('#length_10_1').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1) + (+length_6_1) + (+length_7_1) + (+length_8_1) + (+length_9_1) + (+length_10_1)) / 10;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));


					var length_1_2 = $('#length_1_2').val();
					var length_2_2 = $('#length_2_2').val();
					var length_3_2 = $('#length_3_2').val();
					var length_4_2 = $('#length_4_2').val();
					var length_5_2 = $('#length_5_2').val();
					var length_6_2 = $('#length_6_2').val();
					var length_7_2 = $('#length_7_2').val();
					var length_8_2 = $('#length_8_2').val();
					var length_9_2 = $('#length_9_2').val();
					var length_10_2 = $('#length_10_2').val();

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2) + (+length_6_2) + (+length_7_2) + (+length_8_2) + (+length_9_2) + (+length_10_2)) / 10;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var length_1_3 = $('#length_1_3').val();
					var length_2_3 = $('#length_2_3').val();
					var length_3_3 = $('#length_3_3').val();
					var length_4_3 = $('#length_4_3').val();
					var length_5_3 = $('#length_5_3').val();
					var length_6_3 = $('#length_6_3').val();
					var length_7_3 = $('#length_7_3').val();
					var length_8_3 = $('#length_8_3').val();
					var length_9_3 = $('#length_9_3').val();
					var length_10_3 = $('#length_10_3').val();

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3) + (+length_6_3) + (+length_7_3) + (+length_8_3) + (+length_9_3) + (+length_10_3)) / 10;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));


					var length_1_4 = $('#length_1_4').val();
					var length_2_4 = $('#length_2_4').val();
					var length_3_4 = $('#length_3_4').val();
					var length_4_4 = $('#length_4_4').val();
					var length_5_4 = $('#length_5_4').val();
					var length_6_4 = $('#length_6_4').val();
					var length_7_4 = $('#length_7_4').val();
					var length_8_4 = $('#length_8_4').val();
					var length_9_4 = $('#length_9_4').val();
					var length_10_4 = $('#length_10_4').val();

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4) + (+length_6_4) + (+length_7_4) + (+length_8_4) + (+length_9_4) + (+length_10_4)) / 10;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));


					var width_1_1 = $('#width_1_1').val();
					var width_2_1 = $('#width_2_1').val();
					var width_3_1 = $('#width_3_1').val();
					var width_4_1 = $('#width_4_1').val();
					var width_5_1 = $('#width_5_1').val();
					var width_6_1 = $('#width_6_1').val();
					var width_7_1 = $('#width_7_1').val();
					var width_8_1 = $('#width_8_1').val();
					var width_9_1 = $('#width_9_1').val();
					var width_10_1 = $('#width_10_1').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1) + (+width_6_1) + (+width_7_1) + (+width_8_1) + (+width_9_1) + (+width_10_1)) / 10;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));


					var width_1_2 = $('#width_1_2').val();
					var width_2_2 = $('#width_2_2').val();
					var width_3_2 = $('#width_3_2').val();
					var width_4_2 = $('#width_4_2').val();
					var width_5_2 = $('#width_5_2').val();
					var width_6_2 = $('#width_6_2').val();
					var width_7_2 = $('#width_7_2').val();
					var width_8_2 = $('#width_8_2').val();
					var width_9_2 = $('#width_9_2').val();
					var width_10_2 = $('#width_10_2').val();

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2) + (+width_6_2) + (+width_7_2) + (+width_8_2) + (+width_9_2) + (+width_10_2)) / 10;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var width_1_3 = $('#width_1_3').val();
					var width_2_3 = $('#width_2_3').val();
					var width_3_3 = $('#width_3_3').val();
					var width_4_3 = $('#width_4_3').val();
					var width_5_3 = $('#width_5_3').val();
					var width_6_3 = $('#width_6_3').val();
					var width_7_3 = $('#width_7_3').val();
					var width_8_3 = $('#width_8_3').val();
					var width_9_3 = $('#width_9_3').val();
					var width_10_3 = $('#width_10_3').val();

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3) + (+width_6_3) + (+width_7_3) + (+width_8_3) + (+width_9_3) + (+width_10_3)) / 10;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));


					var width_1_4 = $('#width_1_4').val();
					var width_2_4 = $('#width_2_4').val();
					var width_3_4 = $('#width_3_4').val();
					var width_4_4 = $('#width_4_4').val();
					var width_5_4 = $('#width_5_4').val();
					var width_6_4 = $('#width_6_4').val();
					var width_7_4 = $('#width_7_4').val();
					var width_8_4 = $('#width_8_4').val();
					var width_9_4 = $('#width_9_4').val();
					var width_10_4 = $('#width_10_4').val();

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4) + (+width_6_4) + (+width_7_4) + (+width_8_4) + (+width_9_4) + (+width_10_4)) / 10;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var thick_1_1 = $('#thick_1_1').val();
					var thick_2_1 = $('#thick_2_1').val();
					var thick_3_1 = $('#thick_3_1').val();
					var thick_4_1 = $('#thick_4_1').val();
					var thick_5_1 = $('#thick_5_1').val();
					var thick_6_1 = $('#thick_6_1').val();
					var thick_7_1 = $('#thick_7_1').val();
					var thick_8_1 = $('#thick_8_1').val();
					var thick_9_1 = $('#thick_9_1').val();
					var thick_10_1 = $('#thick_10_1').val();

					var avg_1_9 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1) + (+thick_6_1) + (+thick_7_1) + (+thick_8_1) + (+thick_9_1) + (+thick_10_1)) / 10;
					$('#avg_1_9').val((+avg_1_9).toFixed(2));

					var thick_1_2 = $('#thick_1_2').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_8_2 = $('#thick_8_2').val();
					var thick_9_2 = $('#thick_9_2').val();
					var thick_10_2 = $('#thick_10_2').val();

					var avg_1_10 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2) + (+thick_6_2) + (+thick_7_2) + (+thick_8_2) + (+thick_9_2) + (+thick_10_2)) / 10;
					$('#avg_1_10').val((+avg_1_10).toFixed(2));

					var thick_1_3 = $('#thick_1_3').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_8_3 = $('#thick_8_3').val();
					var thick_9_3 = $('#thick_9_3').val();
					var thick_10_3 = $('#thick_10_3').val();

					var avg_1_11 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3) + (+thick_6_3) + (+thick_7_3) + (+thick_8_3) + (+thick_9_3) + (+thick_10_3)) / 10;
					$('#avg_1_11').val((+avg_1_11).toFixed(2));


					var thick_1_4 = $('#thick_1_4').val();
					var thick_2_4 = $('#thick_2_4').val();
					var thick_3_4 = $('#thick_3_4').val();
					var thick_4_4 = $('#thick_4_4').val();
					var thick_5_4 = $('#thick_5_4').val();
					var thick_6_4 = $('#thick_6_4').val();
					var thick_7_4 = $('#thick_7_4').val();
					var thick_8_4 = $('#thick_8_4').val();
					var thick_9_4 = $('#thick_9_4').val();
					var thick_10_4 = $('#thick_10_4').val();

					var avg_1_12 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4) + (+thick_6_4) + (+thick_7_4) + (+thick_8_4) + (+thick_9_4) + (+thick_10_4)) / 10;
					$('#avg_1_12').val((+avg_1_12).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();
					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();
					var avg_1_9 = $('#avg_1_9').val();
					var avg_1_10 = $('#avg_1_10').val();
					var avg_1_11 = $('#avg_1_11').val();
					var avg_1_12 = $('#avg_1_12').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					var avg_3 = ((+avg_1_9) + (+avg_1_10) + (+avg_1_11) + (+avg_1_12)) / 4;

					$('#avg_1').val((+avg_1).toFixed(2));
					$('#avg_2').val((+avg_2).toFixed(2));
					$('#avg_3').val((+avg_3).toFixed(2));
				} else if ((tiles_grade == "M30 x 45") || (tiles_grade == "M30 x 60") || (tiles_grade == "M30 x 75") || (tiles_grade == "M30 x 30") || (tiles_grade == "M40 x 30") || (tiles_grade == "M40 x 40") || (tiles_grade == "M45 x 45") || (tiles_grade == "M40 x 80") || (tiles_grade == "M45 x 90") || (tiles_grade == "M50 x 50") || (tiles_grade == "M60 x 60")) {
					$('#length_1_1').val((+length_1_1).toFixed(2));
					$('#length_1_2').val((+length_1_2).toFixed(2));
					$('#length_1_3').val((+length_1_3).toFixed(2));
					$('#length_1_4').val((+length_1_4).toFixed(2));
					$('#length_2_1').val((+length_2_1).toFixed(2));
					$('#length_2_2').val((+length_2_2).toFixed(2));
					$('#length_2_3').val((+length_2_3).toFixed(2));
					$('#length_2_4').val((+length_2_4).toFixed(2));
					$('#length_3_1').val((+length_3_1).toFixed(2));
					$('#length_3_2').val((+length_3_2).toFixed(2));
					$('#length_3_3').val((+length_3_3).toFixed(2));
					$('#length_3_4').val((+length_3_4).toFixed(2));
					$('#length_4_1').val((+length_4_1).toFixed(2));
					$('#length_4_2').val((+length_4_2).toFixed(2));
					$('#length_4_3').val((+length_4_3).toFixed(2));
					$('#length_4_4').val((+length_4_4).toFixed(2));
					$('#length_5_1').val((+length_5_1).toFixed(2));
					$('#length_5_2').val((+length_5_2).toFixed(2));
					$('#length_5_3').val((+length_5_3).toFixed(2));
					$('#length_5_4').val((+length_5_4).toFixed(2));
					$('#length_6_1').val((+length_6_1).toFixed(2));
					$('#length_6_2').val((+length_6_2).toFixed(2));
					$('#length_6_3').val((+length_6_3).toFixed(2));
					$('#length_6_4').val((+length_6_4).toFixed(2));
					$('#length_7_1').val((+length_7_1).toFixed(2));
					$('#length_7_2').val((+length_7_2).toFixed(2));
					$('#length_7_3').val((+length_7_3).toFixed(2));
					$('#length_7_4').val((+length_7_4).toFixed(2));

					$('#width_1_1').val((+width_1_1).toFixed(2));
					$('#width_1_2').val((+width_1_2).toFixed(2));
					$('#width_1_3').val((+width_1_3).toFixed(2));
					$('#width_1_4').val((+width_1_4).toFixed(2));
					$('#width_2_1').val((+width_2_1).toFixed(2));
					$('#width_2_2').val((+width_2_2).toFixed(2));
					$('#width_2_3').val((+width_2_3).toFixed(2));
					$('#width_2_4').val((+width_2_4).toFixed(2));
					$('#width_3_1').val((+width_3_1).toFixed(2));
					$('#width_3_2').val((+width_3_2).toFixed(2));
					$('#width_3_3').val((+width_3_3).toFixed(2));
					$('#width_3_4').val((+width_3_4).toFixed(2));
					$('#width_4_1').val((+width_4_1).toFixed(2));
					$('#width_4_2').val((+width_4_2).toFixed(2));
					$('#width_4_3').val((+width_4_3).toFixed(2));
					$('#width_4_4').val((+width_4_4).toFixed(2));
					$('#width_5_1').val((+width_5_1).toFixed(2));
					$('#width_5_2').val((+width_5_2).toFixed(2));
					$('#width_5_3').val((+width_5_3).toFixed(2));
					$('#width_5_4').val((+width_5_4).toFixed(2));
					$('#width_6_1').val((+width_6_1).toFixed(2));
					$('#width_6_2').val((+width_6_2).toFixed(2));
					$('#width_6_3').val((+width_6_3).toFixed(2));
					$('#width_6_4').val((+width_6_4).toFixed(2));
					$('#width_7_1').val((+width_7_1).toFixed(2));
					$('#width_7_2').val((+width_7_2).toFixed(2));
					$('#width_7_3').val((+width_7_3).toFixed(2));
					$('#width_7_4').val((+width_7_4).toFixed(2));

					$('#thick_1_1').val((+thick_1_1).toFixed(2));
					$('#thick_1_2').val((+thick_1_2).toFixed(2));
					$('#thick_1_3').val((+thick_1_3).toFixed(2));
					$('#thick_1_4').val((+thick_1_4).toFixed(2));
					$('#thick_2_1').val((+thick_2_1).toFixed(2));
					$('#thick_2_2').val((+thick_2_2).toFixed(2));
					$('#thick_2_3').val((+thick_2_3).toFixed(2));
					$('#thick_2_4').val((+thick_2_4).toFixed(2));
					$('#thick_3_1').val((+thick_3_1).toFixed(2));
					$('#thick_3_2').val((+thick_3_2).toFixed(2));
					$('#thick_3_3').val((+thick_3_3).toFixed(2));
					$('#thick_3_4').val((+thick_3_4).toFixed(2));
					$('#thick_4_1').val((+thick_4_1).toFixed(2));
					$('#thick_4_2').val((+thick_4_2).toFixed(2));
					$('#thick_4_3').val((+thick_4_3).toFixed(2));
					$('#thick_4_4').val((+thick_4_4).toFixed(2));
					$('#thick_5_1').val((+thick_5_1).toFixed(2));
					$('#thick_5_2').val((+thick_5_2).toFixed(2));
					$('#thick_5_3').val((+thick_5_3).toFixed(2));
					$('#thick_5_4').val((+thick_5_4).toFixed(2));
					$('#thick_6_1').val((+thick_6_1).toFixed(2));
					$('#thick_6_2').val((+thick_6_2).toFixed(2));
					$('#thick_6_3').val((+thick_6_3).toFixed(2));
					$('#thick_6_4').val((+thick_6_4).toFixed(2));
					$('#thick_7_1').val((+thick_7_1).toFixed(2));
					$('#thick_7_2').val((+thick_7_2).toFixed(2));
					$('#thick_7_3').val((+thick_7_3).toFixed(2));
					$('#thick_7_4').val((+thick_7_4).toFixed(2));


					var length_1_1 = $('#length_1_1').val();
					var length_2_1 = $('#length_2_1').val();
					var length_3_1 = $('#length_3_1').val();
					var length_4_1 = $('#length_4_1').val();
					var length_5_1 = $('#length_5_1').val();
					var length_6_1 = $('#length_6_1').val();
					var length_7_1 = $('#length_7_1').val();
					var length_8_1 = $('#length_8_1').val();
					var length_9_1 = $('#length_9_1').val();
					var length_10_1 = $('#length_10_1').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1) + (+length_6_1) + (+length_7_1) + (+length_8_1) + (+length_9_1) + (+length_10_1)) / 7;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));


					var length_1_2 = $('#length_1_2').val();
					var length_2_2 = $('#length_2_2').val();
					var length_3_2 = $('#length_3_2').val();
					var length_4_2 = $('#length_4_2').val();
					var length_5_2 = $('#length_5_2').val();
					var length_6_2 = $('#length_6_2').val();
					var length_7_2 = $('#length_7_2').val();
					var length_8_2 = $('#length_8_2').val();
					var length_9_2 = $('#length_9_2').val();
					var length_10_2 = $('#length_10_2').val();

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2) + (+length_6_2) + (+length_7_2) + (+length_8_2) + (+length_9_2) + (+length_10_2)) / 7;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var length_1_3 = $('#length_1_3').val();
					var length_2_3 = $('#length_2_3').val();
					var length_3_3 = $('#length_3_3').val();
					var length_4_3 = $('#length_4_3').val();
					var length_5_3 = $('#length_5_3').val();
					var length_6_3 = $('#length_6_3').val();
					var length_7_3 = $('#length_7_3').val();
					var length_8_3 = $('#length_8_3').val();
					var length_9_3 = $('#length_9_3').val();
					var length_10_3 = $('#length_10_3').val();

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3) + (+length_6_3) + (+length_7_3) + (+length_8_3) + (+length_9_3) + (+length_10_3)) / 7;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));


					var length_1_4 = $('#length_1_4').val();
					var length_2_4 = $('#length_2_4').val();
					var length_3_4 = $('#length_3_4').val();
					var length_4_4 = $('#length_4_4').val();
					var length_5_4 = $('#length_5_4').val();
					var length_6_4 = $('#length_6_4').val();
					var length_7_4 = $('#length_7_4').val();
					var length_8_4 = $('#length_8_4').val();
					var length_9_4 = $('#length_9_4').val();
					var length_10_4 = $('#length_10_4').val();

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4) + (+length_6_4) + (+length_7_4) + (+length_8_4) + (+length_9_4) + (+length_10_4)) / 7;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));


					var width_1_1 = $('#width_1_1').val();
					var width_2_1 = $('#width_2_1').val();
					var width_3_1 = $('#width_3_1').val();
					var width_4_1 = $('#width_4_1').val();
					var width_5_1 = $('#width_5_1').val();
					var width_6_1 = $('#width_6_1').val();
					var width_7_1 = $('#width_7_1').val();
					var width_8_1 = $('#width_8_1').val();
					var width_9_1 = $('#width_9_1').val();
					var width_10_1 = $('#width_10_1').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1) + (+width_6_1) + (+width_7_1) + (+width_8_1) + (+width_9_1) + (+width_10_1)) / 7;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));


					var width_1_2 = $('#width_1_2').val();
					var width_2_2 = $('#width_2_2').val();
					var width_3_2 = $('#width_3_2').val();
					var width_4_2 = $('#width_4_2').val();
					var width_5_2 = $('#width_5_2').val();
					var width_6_2 = $('#width_6_2').val();
					var width_7_2 = $('#width_7_2').val();
					var width_8_2 = $('#width_8_2').val();
					var width_9_2 = $('#width_9_2').val();
					var width_10_2 = $('#width_10_2').val();

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2) + (+width_6_2) + (+width_7_2) + (+width_8_2) + (+width_9_2) + (+width_10_2)) / 7;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var width_1_3 = $('#width_1_3').val();
					var width_2_3 = $('#width_2_3').val();
					var width_3_3 = $('#width_3_3').val();
					var width_4_3 = $('#width_4_3').val();
					var width_5_3 = $('#width_5_3').val();
					var width_6_3 = $('#width_6_3').val();
					var width_7_3 = $('#width_7_3').val();
					var width_8_3 = $('#width_8_3').val();
					var width_9_3 = $('#width_9_3').val();
					var width_10_3 = $('#width_10_3').val();

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3) + (+width_6_3) + (+width_7_3) + (+width_8_3) + (+width_9_3) + (+width_10_3)) / 7;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));


					var width_1_4 = $('#width_1_4').val();
					var width_2_4 = $('#width_2_4').val();
					var width_3_4 = $('#width_3_4').val();
					var width_4_4 = $('#width_4_4').val();
					var width_5_4 = $('#width_5_4').val();
					var width_6_4 = $('#width_6_4').val();
					var width_7_4 = $('#width_7_4').val();
					var width_8_4 = $('#width_8_4').val();
					var width_9_4 = $('#width_9_4').val();
					var width_10_4 = $('#width_10_4').val();

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4) + (+width_6_4) + (+width_7_4) + (+width_8_4) + (+width_9_4) + (+width_10_4)) / 7;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));


					var thick_1_1 = $('#thick_1_1').val();
					var thick_2_1 = $('#thick_2_1').val();
					var thick_3_1 = $('#thick_3_1').val();
					var thick_4_1 = $('#thick_4_1').val();
					var thick_5_1 = $('#thick_5_1').val();
					var thick_6_1 = $('#thick_6_1').val();
					var thick_7_1 = $('#thick_7_1').val();
					var thick_8_1 = $('#thick_8_1').val();
					var thick_9_1 = $('#thick_9_1').val();
					var thick_10_1 = $('#thick_10_1').val();

					var avg_1_9 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1) + (+thick_6_1) + (+thick_7_1) + (+thick_8_1) + (+thick_9_1) + (+thick_10_1)) / 7;
					$('#avg_1_9').val((+avg_1_9).toFixed(2));


					var thick_1_2 = $('#thick_1_2').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_8_2 = $('#thick_8_2').val();
					var thick_9_2 = $('#thick_9_2').val();
					var thick_10_2 = $('#thick_10_2').val();

					var avg_1_10 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2) + (+thick_6_2) + (+thick_7_2) + (+thick_8_2) + (+thick_9_2) + (+thick_10_2)) / 7;
					$('#avg_1_10').val((+avg_1_10).toFixed(2));

					var thick_1_3 = $('#thick_1_3').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_8_3 = $('#thick_8_3').val();
					var thick_9_3 = $('#thick_9_3').val();
					var thick_10_3 = $('#thick_10_3').val();

					var avg_1_11 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3) + (+thick_6_3) + (+thick_7_3) + (+thick_8_3) + (+thick_9_3) + (+thick_10_3)) / 7;
					$('#avg_1_11').val((+avg_1_11).toFixed(2));


					var thick_1_4 = $('#thick_1_4').val();
					var thick_2_4 = $('#thick_2_4').val();
					var thick_3_4 = $('#thick_3_4').val();
					var thick_4_4 = $('#thick_4_4').val();
					var thick_5_4 = $('#thick_5_4').val();
					var thick_6_4 = $('#thick_6_4').val();
					var thick_7_4 = $('#thick_7_4').val();
					var thick_8_4 = $('#thick_8_4').val();
					var thick_9_4 = $('#thick_9_4').val();
					var thick_10_4 = $('#thick_10_4').val();

					var avg_1_12 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4) + (+thick_6_4) + (+thick_7_4) + (+thick_8_4) + (+thick_9_4) + (+thick_10_4)) / 7;
					$('#avg_1_12').val((+avg_1_12).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();
					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();
					var avg_1_9 = $('#avg_1_9').val();
					var avg_1_10 = $('#avg_1_10').val();
					var avg_1_11 = $('#avg_1_11').val();
					var avg_1_12 = $('#avg_1_12').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					var avg_3 = ((+avg_1_9) + (+avg_1_10) + (+avg_1_11) + (+avg_1_12)) / 4;

					$('#avg_1').val((+avg_1).toFixed(2));
					$('#avg_2').val((+avg_2).toFixed(2));
					$('#avg_3').val((+avg_3).toFixed(2));
				} else if ((tiles_grade == "M60 x 90") || (tiles_grade == "M80 x 80") || (tiles_grade == "M90 x 90") || (tiles_grade == "M60 x 120") || (tiles_grade == "M100 x 100") || (tiles_grade == "M90 x 120") || (tiles_grade == "M120 x 120")) {
					$('#length_1_1').val((+length_1_1).toFixed(2));
					$('#length_1_2').val((+length_1_2).toFixed(2));
					$('#length_1_3').val((+length_1_3).toFixed(2));
					$('#length_1_4').val((+length_1_4).toFixed(2));
					$('#length_2_1').val((+length_2_1).toFixed(2));
					$('#length_2_2').val((+length_2_2).toFixed(2));
					$('#length_2_3').val((+length_2_3).toFixed(2));
					$('#length_2_4').val((+length_2_4).toFixed(2));
					$('#length_3_1').val((+length_3_1).toFixed(2));
					$('#length_3_2').val((+length_3_2).toFixed(2));
					$('#length_3_3').val((+length_3_3).toFixed(2));
					$('#length_3_4').val((+length_3_4).toFixed(2));
					$('#length_4_1').val((+length_4_1).toFixed(2));
					$('#length_4_2').val((+length_4_2).toFixed(2));
					$('#length_4_3').val((+length_4_3).toFixed(2));
					$('#length_4_4').val((+length_4_4).toFixed(2));
					$('#length_5_1').val((+length_5_1).toFixed(2));
					$('#length_5_2').val((+length_5_2).toFixed(2));
					$('#length_5_3').val((+length_5_3).toFixed(2));
					$('#length_5_4').val((+length_5_4).toFixed(2));

					$('#width_1_1').val((+width_1_1).toFixed(2));
					$('#width_1_2').val((+width_1_2).toFixed(2));
					$('#width_1_3').val((+width_1_3).toFixed(2));
					$('#width_1_4').val((+width_1_4).toFixed(2));
					$('#width_2_1').val((+width_2_1).toFixed(2));
					$('#width_2_2').val((+width_2_2).toFixed(2));
					$('#width_2_3').val((+width_2_3).toFixed(2));
					$('#width_2_4').val((+width_2_4).toFixed(2));
					$('#width_3_1').val((+width_3_1).toFixed(2));
					$('#width_3_2').val((+width_3_2).toFixed(2));
					$('#width_3_3').val((+width_3_3).toFixed(2));
					$('#width_3_4').val((+width_3_4).toFixed(2));
					$('#width_4_1').val((+width_4_1).toFixed(2));
					$('#width_4_2').val((+width_4_2).toFixed(2));
					$('#width_4_3').val((+width_4_3).toFixed(2));
					$('#width_4_4').val((+width_4_4).toFixed(2));
					$('#width_5_1').val((+width_5_1).toFixed(2));
					$('#width_5_2').val((+width_5_2).toFixed(2));
					$('#width_5_3').val((+width_5_3).toFixed(2));
					$('#width_5_4').val((+width_5_4).toFixed(2));

					$('#thick_1_1').val((+thick_1_1).toFixed(2));
					$('#thick_1_2').val((+thick_1_2).toFixed(2));
					$('#thick_1_3').val((+thick_1_3).toFixed(2));
					$('#thick_1_4').val((+thick_1_4).toFixed(2));
					$('#thick_2_1').val((+thick_2_1).toFixed(2));
					$('#thick_2_2').val((+thick_2_2).toFixed(2));
					$('#thick_2_3').val((+thick_2_3).toFixed(2));
					$('#thick_2_4').val((+thick_2_4).toFixed(2));
					$('#thick_3_1').val((+thick_3_1).toFixed(2));
					$('#thick_3_2').val((+thick_3_2).toFixed(2));
					$('#thick_3_3').val((+thick_3_3).toFixed(2));
					$('#thick_3_4').val((+thick_3_4).toFixed(2));
					$('#thick_4_1').val((+thick_4_1).toFixed(2));
					$('#thick_4_2').val((+thick_4_2).toFixed(2));
					$('#thick_4_3').val((+thick_4_3).toFixed(2));
					$('#thick_4_4').val((+thick_4_4).toFixed(2));
					$('#thick_5_1').val((+thick_5_1).toFixed(2));
					$('#thick_5_2').val((+thick_5_2).toFixed(2));
					$('#thick_5_3').val((+thick_5_3).toFixed(2));
					$('#thick_5_4').val((+thick_5_4).toFixed(2));

					var length_1_1 = $('#length_1_1').val();
					var length_2_1 = $('#length_2_1').val();
					var length_3_1 = $('#length_3_1').val();
					var length_4_1 = $('#length_4_1').val();
					var length_5_1 = $('#length_5_1').val();
					var length_6_1 = $('#length_6_1').val();
					var length_7_1 = $('#length_7_1').val();
					var length_8_1 = $('#length_8_1').val();
					var length_9_1 = $('#length_9_1').val();
					var length_10_1 = $('#length_10_1').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1) + (+length_6_1) + (+length_7_1) + (+length_8_1) + (+length_9_1) + (+length_10_1)) / 5;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));


					var length_1_2 = $('#length_1_2').val();
					var length_2_2 = $('#length_2_2').val();
					var length_3_2 = $('#length_3_2').val();
					var length_4_2 = $('#length_4_2').val();
					var length_5_2 = $('#length_5_2').val();
					var length_6_2 = $('#length_6_2').val();
					var length_7_2 = $('#length_7_2').val();
					var length_8_2 = $('#length_8_2').val();
					var length_9_2 = $('#length_9_2').val();
					var length_10_2 = $('#length_10_2').val();

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2) + (+length_6_2) + (+length_7_2) + (+length_8_2) + (+length_9_2) + (+length_10_2)) / 5;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var length_1_3 = $('#length_1_3').val();
					var length_2_3 = $('#length_2_3').val();
					var length_3_3 = $('#length_3_3').val();
					var length_4_3 = $('#length_4_3').val();
					var length_5_3 = $('#length_5_3').val();
					var length_6_3 = $('#length_6_3').val();
					var length_7_3 = $('#length_7_3').val();
					var length_8_3 = $('#length_8_3').val();
					var length_9_3 = $('#length_9_3').val();
					var length_10_3 = $('#length_10_3').val();

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3) + (+length_6_3) + (+length_7_3) + (+length_8_3) + (+length_9_3) + (+length_10_3)) / 5;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));


					var length_1_4 = $('#length_1_4').val();
					var length_2_4 = $('#length_2_4').val();
					var length_3_4 = $('#length_3_4').val();
					var length_4_4 = $('#length_4_4').val();
					var length_5_4 = $('#length_5_4').val();
					var length_6_4 = $('#length_6_4').val();
					var length_7_4 = $('#length_7_4').val();
					var length_8_4 = $('#length_8_4').val();
					var length_9_4 = $('#length_9_4').val();
					var length_10_4 = $('#length_10_4').val();

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4) + (+length_6_4) + (+length_7_4) + (+length_8_4) + (+length_9_4) + (+length_10_4)) / 5;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));


					var width_1_1 = $('#width_1_1').val();
					var width_2_1 = $('#width_2_1').val();
					var width_3_1 = $('#width_3_1').val();
					var width_4_1 = $('#width_4_1').val();
					var width_5_1 = $('#width_5_1').val();
					var width_6_1 = $('#width_6_1').val();
					var width_7_1 = $('#width_7_1').val();
					var width_8_1 = $('#width_8_1').val();
					var width_9_1 = $('#width_9_1').val();
					var width_10_1 = $('#width_10_1').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1) + (+width_6_1) + (+width_7_1) + (+width_8_1) + (+width_9_1) + (+width_10_1)) / 5;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));


					var width_1_2 = $('#width_1_2').val();
					var width_2_2 = $('#width_2_2').val();
					var width_3_2 = $('#width_3_2').val();
					var width_4_2 = $('#width_4_2').val();
					var width_5_2 = $('#width_5_2').val();
					var width_6_2 = $('#width_6_2').val();
					var width_7_2 = $('#width_7_2').val();
					var width_8_2 = $('#width_8_2').val();
					var width_9_2 = $('#width_9_2').val();
					var width_10_2 = $('#width_10_2').val();

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2) + (+width_6_2) + (+width_7_2) + (+width_8_2) + (+width_9_2) + (+width_10_2)) / 5;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var width_1_3 = $('#width_1_3').val();
					var width_2_3 = $('#width_2_3').val();
					var width_3_3 = $('#width_3_3').val();
					var width_4_3 = $('#width_4_3').val();
					var width_5_3 = $('#width_5_3').val();
					var width_6_3 = $('#width_6_3').val();
					var width_7_3 = $('#width_7_3').val();
					var width_8_3 = $('#width_8_3').val();
					var width_9_3 = $('#width_9_3').val();
					var width_10_3 = $('#width_10_3').val();

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3) + (+width_6_3) + (+width_7_3) + (+width_8_3) + (+width_9_3) + (+width_10_3)) / 5;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));


					var width_1_4 = $('#width_1_4').val();
					var width_2_4 = $('#width_2_4').val();
					var width_3_4 = $('#width_3_4').val();
					var width_4_4 = $('#width_4_4').val();
					var width_5_4 = $('#width_5_4').val();
					var width_6_4 = $('#width_6_4').val();
					var width_7_4 = $('#width_7_4').val();
					var width_8_4 = $('#width_8_4').val();
					var width_9_4 = $('#width_9_4').val();
					var width_10_4 = $('#width_10_4').val();

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4) + (+width_6_4) + (+width_7_4) + (+width_8_4) + (+width_9_4) + (+width_10_4)) / 5;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));


					var thick_1_1 = $('#thick_1_1').val();
					var thick_2_1 = $('#thick_2_1').val();
					var thick_3_1 = $('#thick_3_1').val();
					var thick_4_1 = $('#thick_4_1').val();
					var thick_5_1 = $('#thick_5_1').val();
					var thick_6_1 = $('#thick_6_1').val();
					var thick_7_1 = $('#thick_7_1').val();
					var thick_8_1 = $('#thick_8_1').val();
					var thick_9_1 = $('#thick_9_1').val();
					var thick_10_1 = $('#thick_10_1').val();

					var avg_1_9 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1) + (+thick_6_1) + (+thick_7_1) + (+thick_8_1) + (+thick_9_1) + (+thick_10_1)) / 5;
					$('#avg_1_9').val((+avg_1_9).toFixed(2));


					var thick_1_2 = $('#thick_1_2').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_8_2 = $('#thick_8_2').val();
					var thick_9_2 = $('#thick_9_2').val();
					var thick_10_2 = $('#thick_10_2').val();

					var avg_1_10 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2) + (+thick_6_2) + (+thick_7_2) + (+thick_8_2) + (+thick_9_2) + (+thick_10_2)) / 5;
					$('#avg_1_10').val((+avg_1_10).toFixed(2));

					var thick_1_3 = $('#thick_1_3').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_8_3 = $('#thick_8_3').val();
					var thick_9_3 = $('#thick_9_3').val();
					var thick_10_3 = $('#thick_10_3').val();

					var avg_1_11 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3) + (+thick_6_3) + (+thick_7_3) + (+thick_8_3) + (+thick_9_3) + (+thick_10_3)) / 5;
					$('#avg_1_11').val((+avg_1_11).toFixed(2));


					var thick_1_4 = $('#thick_1_4').val();
					var thick_2_4 = $('#thick_2_4').val();
					var thick_3_4 = $('#thick_3_4').val();
					var thick_4_4 = $('#thick_4_4').val();
					var thick_5_4 = $('#thick_5_4').val();
					var thick_6_4 = $('#thick_6_4').val();
					var thick_7_4 = $('#thick_7_4').val();
					var thick_8_4 = $('#thick_8_4').val();
					var thick_9_4 = $('#thick_9_4').val();
					var thick_10_4 = $('#thick_10_4').val();

					var avg_1_12 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4) + (+thick_6_4) + (+thick_7_4) + (+thick_8_4) + (+thick_9_4) + (+thick_10_4)) / 5;
					$('#avg_1_12').val((+avg_1_12).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();
					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();
					var avg_1_9 = $('#avg_1_9').val();
					var avg_1_10 = $('#avg_1_10').val();
					var avg_1_11 = $('#avg_1_11').val();
					var avg_1_12 = $('#avg_1_12').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					var avg_3 = ((+avg_1_9) + (+avg_1_10) + (+avg_1_11) + (+avg_1_12)) / 4;

					$('#avg_1').val((+avg_1).toFixed(2));
					$('#avg_2').val((+avg_2).toFixed(2));
					$('#avg_3').val((+avg_3).toFixed(2));
				}
			} else if (tiles_type == "non-modular") {
				if ((tiles_grade == "10.8 x 10.8") || (tiles_grade == "15 x 7.5") || (tiles_grade == "15.2 x 7.6") || (tiles_grade == "15.2 x 15.2") || (tiles_grade == "21.6 x 10.8") || (tiles_grade == "25 x 33")) {
					$('#length_1_1').val((+length_1_1).toFixed(2));
					$('#length_1_2').val((+length_1_2).toFixed(2));
					$('#length_1_3').val((+length_1_3).toFixed(2));
					$('#length_1_4').val((+length_1_4).toFixed(2));
					$('#length_2_1').val((+length_2_1).toFixed(2));
					$('#length_2_2').val((+length_2_2).toFixed(2));
					$('#length_2_3').val((+length_2_3).toFixed(2));
					$('#length_2_4').val((+length_2_4).toFixed(2));
					$('#length_3_1').val((+length_3_1).toFixed(2));
					$('#length_3_2').val((+length_3_2).toFixed(2));
					$('#length_3_3').val((+length_3_3).toFixed(2));
					$('#length_3_4').val((+length_3_4).toFixed(2));
					$('#length_4_1').val((+length_4_1).toFixed(2));
					$('#length_4_2').val((+length_4_2).toFixed(2));
					$('#length_4_3').val((+length_4_3).toFixed(2));
					$('#length_4_4').val((+length_4_4).toFixed(2));
					$('#length_5_1').val((+length_5_1).toFixed(2));
					$('#length_5_2').val((+length_5_2).toFixed(2));
					$('#length_5_3').val((+length_5_3).toFixed(2));
					$('#length_5_4').val((+length_5_4).toFixed(2));
					$('#length_6_1').val((+length_6_1).toFixed(2));
					$('#length_6_2').val((+length_6_2).toFixed(2));
					$('#length_6_3').val((+length_6_3).toFixed(2));
					$('#length_6_4').val((+length_6_4).toFixed(2));
					$('#length_7_1').val((+length_7_1).toFixed(2));
					$('#length_7_2').val((+length_7_2).toFixed(2));
					$('#length_7_3').val((+length_7_3).toFixed(2));
					$('#length_7_4').val((+length_7_4).toFixed(2));
					$('#length_8_1').val((+length_8_1).toFixed(2));
					$('#length_8_2').val((+length_8_2).toFixed(2));
					$('#length_8_3').val((+length_8_3).toFixed(2));
					$('#length_8_4').val((+length_8_4).toFixed(2));
					$('#length_9_1').val((+length_9_1).toFixed(2));
					$('#length_9_2').val((+length_9_2).toFixed(2));
					$('#length_9_3').val((+length_9_3).toFixed(2));
					$('#length_9_4').val((+length_9_4).toFixed(2));
					$('#length_10_1').val((+length_10_1).toFixed(2));
					$('#length_10_2').val((+length_10_2).toFixed(2));
					$('#length_10_3').val((+length_10_3).toFixed(2));
					$('#length_10_4').val((+length_10_4).toFixed(2));

					$('#width_1_1').val((+width_1_1).toFixed(2));
					$('#width_1_2').val((+width_1_2).toFixed(2));
					$('#width_1_3').val((+width_1_3).toFixed(2));
					$('#width_1_4').val((+width_1_4).toFixed(2));
					$('#width_2_1').val((+width_2_1).toFixed(2));
					$('#width_2_2').val((+width_2_2).toFixed(2));
					$('#width_2_3').val((+width_2_3).toFixed(2));
					$('#width_2_4').val((+width_2_4).toFixed(2));
					$('#width_3_1').val((+width_3_1).toFixed(2));
					$('#width_3_2').val((+width_3_2).toFixed(2));
					$('#width_3_3').val((+width_3_3).toFixed(2));
					$('#width_3_4').val((+width_3_4).toFixed(2));
					$('#width_4_1').val((+width_4_1).toFixed(2));
					$('#width_4_2').val((+width_4_2).toFixed(2));
					$('#width_4_3').val((+width_4_3).toFixed(2));
					$('#width_4_4').val((+width_4_4).toFixed(2));
					$('#width_5_1').val((+width_5_1).toFixed(2));
					$('#width_5_2').val((+width_5_2).toFixed(2));
					$('#width_5_3').val((+width_5_3).toFixed(2));
					$('#width_5_4').val((+width_5_4).toFixed(2));
					$('#width_6_1').val((+width_6_1).toFixed(2));
					$('#width_6_2').val((+width_6_2).toFixed(2));
					$('#width_6_3').val((+width_6_3).toFixed(2));
					$('#width_6_4').val((+width_6_4).toFixed(2));
					$('#width_7_1').val((+width_7_1).toFixed(2));
					$('#width_7_2').val((+width_7_2).toFixed(2));
					$('#width_7_3').val((+width_7_3).toFixed(2));
					$('#width_7_4').val((+width_7_4).toFixed(2));
					$('#width_8_1').val((+width_8_1).toFixed(2));
					$('#width_8_2').val((+width_8_2).toFixed(2));
					$('#width_8_3').val((+width_8_3).toFixed(2));
					$('#width_8_4').val((+width_8_4).toFixed(2));
					$('#width_9_1').val((+width_9_1).toFixed(2));
					$('#width_9_2').val((+width_9_2).toFixed(2));
					$('#width_9_3').val((+width_9_3).toFixed(2));
					$('#width_9_4').val((+width_9_4).toFixed(2));
					$('#width_10_1').val((+width_10_1).toFixed(2));
					$('#width_10_2').val((+width_10_2).toFixed(2));
					$('#width_10_3').val((+width_10_3).toFixed(2));
					$('#width_10_4').val((+width_10_4).toFixed(2));

					$('#thick_1_1').val((+thick_1_1).toFixed(2));
					$('#thick_1_2').val((+thick_1_2).toFixed(2));
					$('#thick_1_3').val((+thick_1_3).toFixed(2));
					$('#thick_1_4').val((+thick_1_4).toFixed(2));
					$('#thick_2_1').val((+thick_2_1).toFixed(2));
					$('#thick_2_2').val((+thick_2_2).toFixed(2));
					$('#thick_2_3').val((+thick_2_3).toFixed(2));
					$('#thick_2_4').val((+thick_2_4).toFixed(2));
					$('#thick_3_1').val((+thick_3_1).toFixed(2));
					$('#thick_3_2').val((+thick_3_2).toFixed(2));
					$('#thick_3_3').val((+thick_3_3).toFixed(2));
					$('#thick_3_4').val((+thick_3_4).toFixed(2));
					$('#thick_4_1').val((+thick_4_1).toFixed(2));
					$('#thick_4_2').val((+thick_4_2).toFixed(2));
					$('#thick_4_3').val((+thick_4_3).toFixed(2));
					$('#thick_4_4').val((+thick_4_4).toFixed(2));
					$('#thick_5_1').val((+thick_5_1).toFixed(2));
					$('#thick_5_2').val((+thick_5_2).toFixed(2));
					$('#thick_5_3').val((+thick_5_3).toFixed(2));
					$('#thick_5_4').val((+thick_5_4).toFixed(2));
					$('#thick_6_1').val((+thick_6_1).toFixed(2));
					$('#thick_6_2').val((+thick_6_2).toFixed(2));
					$('#thick_6_3').val((+thick_6_3).toFixed(2));
					$('#thick_6_4').val((+thick_6_4).toFixed(2));
					$('#thick_7_1').val((+thick_7_1).toFixed(2));
					$('#thick_7_2').val((+thick_7_2).toFixed(2));
					$('#thick_7_3').val((+thick_7_3).toFixed(2));
					$('#thick_7_4').val((+thick_7_4).toFixed(2));
					$('#thick_8_1').val((+thick_8_1).toFixed(2));
					$('#thick_8_2').val((+thick_8_2).toFixed(2));
					$('#thick_8_3').val((+thick_8_3).toFixed(2));
					$('#thick_8_4').val((+thick_8_4).toFixed(2));
					$('#thick_9_1').val((+thick_9_1).toFixed(2));
					$('#thick_9_2').val((+thick_9_2).toFixed(2));
					$('#thick_9_3').val((+thick_9_3).toFixed(2));
					$('#thick_9_4').val((+thick_9_4).toFixed(2));
					$('#thick_10_1').val((+thick_10_1).toFixed(2));
					$('#thick_10_2').val((+thick_10_2).toFixed(2));
					$('#thick_10_3').val((+thick_10_3).toFixed(2));
					$('#thick_10_4').val((+thick_10_4).toFixed(2));

					var length_1_1 = $('#length_1_1').val();
					var length_2_1 = $('#length_2_1').val();
					var length_3_1 = $('#length_3_1').val();
					var length_4_1 = $('#length_4_1').val();
					var length_5_1 = $('#length_5_1').val();
					var length_6_1 = $('#length_6_1').val();
					var length_7_1 = $('#length_7_1').val();
					var length_8_1 = $('#length_8_1').val();
					var length_9_1 = $('#length_9_1').val();
					var length_10_1 = $('#length_10_1').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1) + (+length_6_1) + (+length_7_1) + (+length_8_1) + (+length_9_1) + (+length_10_1)) / 10;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));


					var length_1_2 = $('#length_1_2').val();
					var length_2_2 = $('#length_2_2').val();
					var length_3_2 = $('#length_3_2').val();
					var length_4_2 = $('#length_4_2').val();
					var length_5_2 = $('#length_5_2').val();
					var length_6_2 = $('#length_6_2').val();
					var length_7_2 = $('#length_7_2').val();
					var length_8_2 = $('#length_8_2').val();
					var length_9_2 = $('#length_9_2').val();
					var length_10_2 = $('#length_10_2').val();

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2) + (+length_6_2) + (+length_7_2) + (+length_8_2) + (+length_9_2) + (+length_10_2)) / 10;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var length_1_3 = $('#length_1_3').val();
					var length_2_3 = $('#length_2_3').val();
					var length_3_3 = $('#length_3_3').val();
					var length_4_3 = $('#length_4_3').val();
					var length_5_3 = $('#length_5_3').val();
					var length_6_3 = $('#length_6_3').val();
					var length_7_3 = $('#length_7_3').val();
					var length_8_3 = $('#length_8_3').val();
					var length_9_3 = $('#length_9_3').val();
					var length_10_3 = $('#length_10_3').val();

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3) + (+length_6_3) + (+length_7_3) + (+length_8_3) + (+length_9_3) + (+length_10_3)) / 10;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));


					var length_1_4 = $('#length_1_4').val();
					var length_2_4 = $('#length_2_4').val();
					var length_3_4 = $('#length_3_4').val();
					var length_4_4 = $('#length_4_4').val();
					var length_5_4 = $('#length_5_4').val();
					var length_6_4 = $('#length_6_4').val();
					var length_7_4 = $('#length_7_4').val();
					var length_8_4 = $('#length_8_4').val();
					var length_9_4 = $('#length_9_4').val();
					var length_10_4 = $('#length_10_4').val();

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4) + (+length_6_4) + (+length_7_4) + (+length_8_4) + (+length_9_4) + (+length_10_4)) / 10;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));


					var width_1_1 = $('#width_1_1').val();
					var width_2_1 = $('#width_2_1').val();
					var width_3_1 = $('#width_3_1').val();
					var width_4_1 = $('#width_4_1').val();
					var width_5_1 = $('#width_5_1').val();
					var width_6_1 = $('#width_6_1').val();
					var width_7_1 = $('#width_7_1').val();
					var width_8_1 = $('#width_8_1').val();
					var width_9_1 = $('#width_9_1').val();
					var width_10_1 = $('#width_10_1').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1) + (+width_6_1) + (+width_7_1) + (+width_8_1) + (+width_9_1) + (+width_10_1)) / 10;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));


					var width_1_2 = $('#width_1_2').val();
					var width_2_2 = $('#width_2_2').val();
					var width_3_2 = $('#width_3_2').val();
					var width_4_2 = $('#width_4_2').val();
					var width_5_2 = $('#width_5_2').val();
					var width_6_2 = $('#width_6_2').val();
					var width_7_2 = $('#width_7_2').val();
					var width_8_2 = $('#width_8_2').val();
					var width_9_2 = $('#width_9_2').val();
					var width_10_2 = $('#width_10_2').val();

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2) + (+width_6_2) + (+width_7_2) + (+width_8_2) + (+width_9_2) + (+width_10_2)) / 10;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var width_1_3 = $('#width_1_3').val();
					var width_2_3 = $('#width_2_3').val();
					var width_3_3 = $('#width_3_3').val();
					var width_4_3 = $('#width_4_3').val();
					var width_5_3 = $('#width_5_3').val();
					var width_6_3 = $('#width_6_3').val();
					var width_7_3 = $('#width_7_3').val();
					var width_8_3 = $('#width_8_3').val();
					var width_9_3 = $('#width_9_3').val();
					var width_10_3 = $('#width_10_3').val();

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3) + (+width_6_3) + (+width_7_3) + (+width_8_3) + (+width_9_3) + (+width_10_3)) / 10;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));


					var width_1_4 = $('#width_1_4').val();
					var width_2_4 = $('#width_2_4').val();
					var width_3_4 = $('#width_3_4').val();
					var width_4_4 = $('#width_4_4').val();
					var width_5_4 = $('#width_5_4').val();
					var width_6_4 = $('#width_6_4').val();
					var width_7_4 = $('#width_7_4').val();
					var width_8_4 = $('#width_8_4').val();
					var width_9_4 = $('#width_9_4').val();
					var width_10_4 = $('#width_10_4').val();

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4) + (+width_6_4) + (+width_7_4) + (+width_8_4) + (+width_9_4) + (+width_10_4)) / 10;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var thick_1_1 = $('#thick_1_1').val();
					var thick_2_1 = $('#thick_2_1').val();
					var thick_3_1 = $('#thick_3_1').val();
					var thick_4_1 = $('#thick_4_1').val();
					var thick_5_1 = $('#thick_5_1').val();
					var thick_6_1 = $('#thick_6_1').val();
					var thick_7_1 = $('#thick_7_1').val();
					var thick_8_1 = $('#thick_8_1').val();
					var thick_9_1 = $('#thick_9_1').val();
					var thick_10_1 = $('#thick_10_1').val();

					var avg_1_9 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1) + (+thick_6_1) + (+thick_7_1) + (+thick_8_1) + (+thick_9_1) + (+thick_10_1)) / 10;
					$('#avg_1_9').val((+avg_1_9).toFixed(2));

					var thick_1_2 = $('#thick_1_2').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_8_2 = $('#thick_8_2').val();
					var thick_9_2 = $('#thick_9_2').val();
					var thick_10_2 = $('#thick_10_2').val();

					var avg_1_10 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2) + (+thick_6_2) + (+thick_7_2) + (+thick_8_2) + (+thick_9_2) + (+thick_10_2)) / 10;
					$('#avg_1_10').val((+avg_1_10).toFixed(2));

					var thick_1_3 = $('#thick_1_3').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_8_3 = $('#thick_8_3').val();
					var thick_9_3 = $('#thick_9_3').val();
					var thick_10_3 = $('#thick_10_3').val();

					var avg_1_11 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3) + (+thick_6_3) + (+thick_7_3) + (+thick_8_3) + (+thick_9_3) + (+thick_10_3)) / 10;
					$('#avg_1_11').val((+avg_1_11).toFixed(2));


					var thick_1_4 = $('#thick_1_4').val();
					var thick_2_4 = $('#thick_2_4').val();
					var thick_3_4 = $('#thick_3_4').val();
					var thick_4_4 = $('#thick_4_4').val();
					var thick_5_4 = $('#thick_5_4').val();
					var thick_6_4 = $('#thick_6_4').val();
					var thick_7_4 = $('#thick_7_4').val();
					var thick_8_4 = $('#thick_8_4').val();
					var thick_9_4 = $('#thick_9_4').val();
					var thick_10_4 = $('#thick_10_4').val();

					var avg_1_12 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4) + (+thick_6_4) + (+thick_7_4) + (+thick_8_4) + (+thick_9_4) + (+thick_10_4)) / 10;
					$('#avg_1_12').val((+avg_1_12).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();
					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();
					var avg_1_9 = $('#avg_1_9').val();
					var avg_1_10 = $('#avg_1_10').val();
					var avg_1_11 = $('#avg_1_11').val();
					var avg_1_12 = $('#avg_1_12').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					var avg_3 = ((+avg_1_9) + (+avg_1_10) + (+avg_1_11) + (+avg_1_12)) / 4;

					$('#avg_1').val((+avg_1).toFixed(2));
					$('#avg_2').val((+avg_2).toFixed(2));
					$('#avg_3').val((+avg_3).toFixed(2));
				} else if ((tiles_grade == "25 x 38") || (tiles_grade == "31.5 x 42") || (tiles_grade == "32 x 32") || (tiles_grade == "32 x 40") || (tiles_grade == "32 x 48") || (tiles_grade == "32 x 60") || (tiles_grade == "33 x 33") || (tiles_grade == "33 x 48") || (tiles_grade == "33 x 60") || (tiles_grade == "33 x 90") || (tiles_grade == "30.6 x 30.6") || (tiles_grade == "31.5 x 31.5") || (tiles_grade == "40.6 x 40.6")) {
					$('#length_1_1').val((+length_1_1).toFixed(2));
					$('#length_1_2').val((+length_1_2).toFixed(2));
					$('#length_1_3').val((+length_1_3).toFixed(2));
					$('#length_1_4').val((+length_1_4).toFixed(2));
					$('#length_2_1').val((+length_2_1).toFixed(2));
					$('#length_2_2').val((+length_2_2).toFixed(2));
					$('#length_2_3').val((+length_2_3).toFixed(2));
					$('#length_2_4').val((+length_2_4).toFixed(2));
					$('#length_3_1').val((+length_3_1).toFixed(2));
					$('#length_3_2').val((+length_3_2).toFixed(2));
					$('#length_3_3').val((+length_3_3).toFixed(2));
					$('#length_3_4').val((+length_3_4).toFixed(2));
					$('#length_4_1').val((+length_4_1).toFixed(2));
					$('#length_4_2').val((+length_4_2).toFixed(2));
					$('#length_4_3').val((+length_4_3).toFixed(2));
					$('#length_4_4').val((+length_4_4).toFixed(2));
					$('#length_5_1').val((+length_5_1).toFixed(2));
					$('#length_5_2').val((+length_5_2).toFixed(2));
					$('#length_5_3').val((+length_5_3).toFixed(2));
					$('#length_5_4').val((+length_5_4).toFixed(2));
					$('#length_6_1').val((+length_6_1).toFixed(2));
					$('#length_6_2').val((+length_6_2).toFixed(2));
					$('#length_6_3').val((+length_6_3).toFixed(2));
					$('#length_6_4').val((+length_6_4).toFixed(2));
					$('#length_7_1').val((+length_7_1).toFixed(2));
					$('#length_7_2').val((+length_7_2).toFixed(2));
					$('#length_7_3').val((+length_7_3).toFixed(2));
					$('#length_7_4').val((+length_7_4).toFixed(2));

					$('#width_1_1').val((+width_1_1).toFixed(2));
					$('#width_1_2').val((+width_1_2).toFixed(2));
					$('#width_1_3').val((+width_1_3).toFixed(2));
					$('#width_1_4').val((+width_1_4).toFixed(2));
					$('#width_2_1').val((+width_2_1).toFixed(2));
					$('#width_2_2').val((+width_2_2).toFixed(2));
					$('#width_2_3').val((+width_2_3).toFixed(2));
					$('#width_2_4').val((+width_2_4).toFixed(2));
					$('#width_3_1').val((+width_3_1).toFixed(2));
					$('#width_3_2').val((+width_3_2).toFixed(2));
					$('#width_3_3').val((+width_3_3).toFixed(2));
					$('#width_3_4').val((+width_3_4).toFixed(2));
					$('#width_4_1').val((+width_4_1).toFixed(2));
					$('#width_4_2').val((+width_4_2).toFixed(2));
					$('#width_4_3').val((+width_4_3).toFixed(2));
					$('#width_4_4').val((+width_4_4).toFixed(2));
					$('#width_5_1').val((+width_5_1).toFixed(2));
					$('#width_5_2').val((+width_5_2).toFixed(2));
					$('#width_5_3').val((+width_5_3).toFixed(2));
					$('#width_5_4').val((+width_5_4).toFixed(2));
					$('#width_6_1').val((+width_6_1).toFixed(2));
					$('#width_6_2').val((+width_6_2).toFixed(2));
					$('#width_6_3').val((+width_6_3).toFixed(2));
					$('#width_6_4').val((+width_6_4).toFixed(2));
					$('#width_7_1').val((+width_7_1).toFixed(2));
					$('#width_7_2').val((+width_7_2).toFixed(2));
					$('#width_7_3').val((+width_7_3).toFixed(2));
					$('#width_7_4').val((+width_7_4).toFixed(2));

					$('#thick_1_1').val((+thick_1_1).toFixed(2));
					$('#thick_1_2').val((+thick_1_2).toFixed(2));
					$('#thick_1_3').val((+thick_1_3).toFixed(2));
					$('#thick_1_4').val((+thick_1_4).toFixed(2));
					$('#thick_2_1').val((+thick_2_1).toFixed(2));
					$('#thick_2_2').val((+thick_2_2).toFixed(2));
					$('#thick_2_3').val((+thick_2_3).toFixed(2));
					$('#thick_2_4').val((+thick_2_4).toFixed(2));
					$('#thick_3_1').val((+thick_3_1).toFixed(2));
					$('#thick_3_2').val((+thick_3_2).toFixed(2));
					$('#thick_3_3').val((+thick_3_3).toFixed(2));
					$('#thick_3_4').val((+thick_3_4).toFixed(2));
					$('#thick_4_1').val((+thick_4_1).toFixed(2));
					$('#thick_4_2').val((+thick_4_2).toFixed(2));
					$('#thick_4_3').val((+thick_4_3).toFixed(2));
					$('#thick_4_4').val((+thick_4_4).toFixed(2));
					$('#thick_5_1').val((+thick_5_1).toFixed(2));
					$('#thick_5_2').val((+thick_5_2).toFixed(2));
					$('#thick_5_3').val((+thick_5_3).toFixed(2));
					$('#thick_5_4').val((+thick_5_4).toFixed(2));
					$('#thick_6_1').val((+thick_6_1).toFixed(2));
					$('#thick_6_2').val((+thick_6_2).toFixed(2));
					$('#thick_6_3').val((+thick_6_3).toFixed(2));
					$('#thick_6_4').val((+thick_6_4).toFixed(2));
					$('#thick_7_1').val((+thick_7_1).toFixed(2));
					$('#thick_7_2').val((+thick_7_2).toFixed(2));
					$('#thick_7_3').val((+thick_7_3).toFixed(2));
					$('#thick_7_4').val((+thick_7_4).toFixed(2));


					var length_1_1 = $('#length_1_1').val();
					var length_2_1 = $('#length_2_1').val();
					var length_3_1 = $('#length_3_1').val();
					var length_4_1 = $('#length_4_1').val();
					var length_5_1 = $('#length_5_1').val();
					var length_6_1 = $('#length_6_1').val();
					var length_7_1 = $('#length_7_1').val();
					var length_8_1 = $('#length_8_1').val();
					var length_9_1 = $('#length_9_1').val();
					var length_10_1 = $('#length_10_1').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1) + (+length_6_1) + (+length_7_1) + (+length_8_1) + (+length_9_1) + (+length_10_1)) / 7;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));


					var length_1_2 = $('#length_1_2').val();
					var length_2_2 = $('#length_2_2').val();
					var length_3_2 = $('#length_3_2').val();
					var length_4_2 = $('#length_4_2').val();
					var length_5_2 = $('#length_5_2').val();
					var length_6_2 = $('#length_6_2').val();
					var length_7_2 = $('#length_7_2').val();
					var length_8_2 = $('#length_8_2').val();
					var length_9_2 = $('#length_9_2').val();
					var length_10_2 = $('#length_10_2').val();

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2) + (+length_6_2) + (+length_7_2) + (+length_8_2) + (+length_9_2) + (+length_10_2)) / 7;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var length_1_3 = $('#length_1_3').val();
					var length_2_3 = $('#length_2_3').val();
					var length_3_3 = $('#length_3_3').val();
					var length_4_3 = $('#length_4_3').val();
					var length_5_3 = $('#length_5_3').val();
					var length_6_3 = $('#length_6_3').val();
					var length_7_3 = $('#length_7_3').val();
					var length_8_3 = $('#length_8_3').val();
					var length_9_3 = $('#length_9_3').val();
					var length_10_3 = $('#length_10_3').val();

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3) + (+length_6_3) + (+length_7_3) + (+length_8_3) + (+length_9_3) + (+length_10_3)) / 7;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));


					var length_1_4 = $('#length_1_4').val();
					var length_2_4 = $('#length_2_4').val();
					var length_3_4 = $('#length_3_4').val();
					var length_4_4 = $('#length_4_4').val();
					var length_5_4 = $('#length_5_4').val();
					var length_6_4 = $('#length_6_4').val();
					var length_7_4 = $('#length_7_4').val();
					var length_8_4 = $('#length_8_4').val();
					var length_9_4 = $('#length_9_4').val();
					var length_10_4 = $('#length_10_4').val();

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4) + (+length_6_4) + (+length_7_4) + (+length_8_4) + (+length_9_4) + (+length_10_4)) / 7;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));


					var width_1_1 = $('#width_1_1').val();
					var width_2_1 = $('#width_2_1').val();
					var width_3_1 = $('#width_3_1').val();
					var width_4_1 = $('#width_4_1').val();
					var width_5_1 = $('#width_5_1').val();
					var width_6_1 = $('#width_6_1').val();
					var width_7_1 = $('#width_7_1').val();
					var width_8_1 = $('#width_8_1').val();
					var width_9_1 = $('#width_9_1').val();
					var width_10_1 = $('#width_10_1').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1) + (+width_6_1) + (+width_7_1) + (+width_8_1) + (+width_9_1) + (+width_10_1)) / 7;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));


					var width_1_2 = $('#width_1_2').val();
					var width_2_2 = $('#width_2_2').val();
					var width_3_2 = $('#width_3_2').val();
					var width_4_2 = $('#width_4_2').val();
					var width_5_2 = $('#width_5_2').val();
					var width_6_2 = $('#width_6_2').val();
					var width_7_2 = $('#width_7_2').val();
					var width_8_2 = $('#width_8_2').val();
					var width_9_2 = $('#width_9_2').val();
					var width_10_2 = $('#width_10_2').val();

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2) + (+width_6_2) + (+width_7_2) + (+width_8_2) + (+width_9_2) + (+width_10_2)) / 7;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var width_1_3 = $('#width_1_3').val();
					var width_2_3 = $('#width_2_3').val();
					var width_3_3 = $('#width_3_3').val();
					var width_4_3 = $('#width_4_3').val();
					var width_5_3 = $('#width_5_3').val();
					var width_6_3 = $('#width_6_3').val();
					var width_7_3 = $('#width_7_3').val();
					var width_8_3 = $('#width_8_3').val();
					var width_9_3 = $('#width_9_3').val();
					var width_10_3 = $('#width_10_3').val();

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3) + (+width_6_3) + (+width_7_3) + (+width_8_3) + (+width_9_3) + (+width_10_3)) / 7;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));


					var width_1_4 = $('#width_1_4').val();
					var width_2_4 = $('#width_2_4').val();
					var width_3_4 = $('#width_3_4').val();
					var width_4_4 = $('#width_4_4').val();
					var width_5_4 = $('#width_5_4').val();
					var width_6_4 = $('#width_6_4').val();
					var width_7_4 = $('#width_7_4').val();
					var width_8_4 = $('#width_8_4').val();
					var width_9_4 = $('#width_9_4').val();
					var width_10_4 = $('#width_10_4').val();

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4) + (+width_6_4) + (+width_7_4) + (+width_8_4) + (+width_9_4) + (+width_10_4)) / 7;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));


					var thick_1_1 = $('#thick_1_1').val();
					var thick_2_1 = $('#thick_2_1').val();
					var thick_3_1 = $('#thick_3_1').val();
					var thick_4_1 = $('#thick_4_1').val();
					var thick_5_1 = $('#thick_5_1').val();
					var thick_6_1 = $('#thick_6_1').val();
					var thick_7_1 = $('#thick_7_1').val();
					var thick_8_1 = $('#thick_8_1').val();
					var thick_9_1 = $('#thick_9_1').val();
					var thick_10_1 = $('#thick_10_1').val();

					var avg_1_9 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1) + (+thick_6_1) + (+thick_7_1) + (+thick_8_1) + (+thick_9_1) + (+thick_10_1)) / 7;
					$('#avg_1_9').val((+avg_1_9).toFixed(2));


					var thick_1_2 = $('#thick_1_2').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_8_2 = $('#thick_8_2').val();
					var thick_9_2 = $('#thick_9_2').val();
					var thick_10_2 = $('#thick_10_2').val();

					var avg_1_10 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2) + (+thick_6_2) + (+thick_7_2) + (+thick_8_2) + (+thick_9_2) + (+thick_10_2)) / 7;
					$('#avg_1_10').val((+avg_1_10).toFixed(2));

					var thick_1_3 = $('#thick_1_3').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_8_3 = $('#thick_8_3').val();
					var thick_9_3 = $('#thick_9_3').val();
					var thick_10_3 = $('#thick_10_3').val();

					var avg_1_11 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3) + (+thick_6_3) + (+thick_7_3) + (+thick_8_3) + (+thick_9_3) + (+thick_10_3)) / 7;
					$('#avg_1_11').val((+avg_1_11).toFixed(2));


					var thick_1_4 = $('#thick_1_4').val();
					var thick_2_4 = $('#thick_2_4').val();
					var thick_3_4 = $('#thick_3_4').val();
					var thick_4_4 = $('#thick_4_4').val();
					var thick_5_4 = $('#thick_5_4').val();
					var thick_6_4 = $('#thick_6_4').val();
					var thick_7_4 = $('#thick_7_4').val();
					var thick_8_4 = $('#thick_8_4').val();
					var thick_9_4 = $('#thick_9_4').val();
					var thick_10_4 = $('#thick_10_4').val();

					var avg_1_12 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4) + (+thick_6_4) + (+thick_7_4) + (+thick_8_4) + (+thick_9_4) + (+thick_10_4)) / 7;
					$('#avg_1_12').val((+avg_1_12).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();
					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();
					var avg_1_9 = $('#avg_1_9').val();
					var avg_1_10 = $('#avg_1_10').val();
					var avg_1_11 = $('#avg_1_11').val();
					var avg_1_12 = $('#avg_1_12').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					var avg_3 = ((+avg_1_9) + (+avg_1_10) + (+avg_1_11) + (+avg_1_12)) / 4;

					$('#avg_1').val((+avg_1).toFixed(2));
					$('#avg_2').val((+avg_2).toFixed(2));
					$('#avg_3').val((+avg_3).toFixed(2));
				} else if ((tiles_grade == "60.5 x 60.5") || (tiles_grade == "81.5 x 81.5")) {
					$('#length_1_1').val((+length_1_1).toFixed(2));
					$('#length_1_2').val((+length_1_2).toFixed(2));
					$('#length_1_3').val((+length_1_3).toFixed(2));
					$('#length_1_4').val((+length_1_4).toFixed(2));
					$('#length_2_1').val((+length_2_1).toFixed(2));
					$('#length_2_2').val((+length_2_2).toFixed(2));
					$('#length_2_3').val((+length_2_3).toFixed(2));
					$('#length_2_4').val((+length_2_4).toFixed(2));
					$('#length_3_1').val((+length_3_1).toFixed(2));
					$('#length_3_2').val((+length_3_2).toFixed(2));
					$('#length_3_3').val((+length_3_3).toFixed(2));
					$('#length_3_4').val((+length_3_4).toFixed(2));
					$('#length_4_1').val((+length_4_1).toFixed(2));
					$('#length_4_2').val((+length_4_2).toFixed(2));
					$('#length_4_3').val((+length_4_3).toFixed(2));
					$('#length_4_4').val((+length_4_4).toFixed(2));
					$('#length_5_1').val((+length_5_1).toFixed(2));
					$('#length_5_2').val((+length_5_2).toFixed(2));
					$('#length_5_3').val((+length_5_3).toFixed(2));
					$('#length_5_4').val((+length_5_4).toFixed(2));

					$('#width_1_1').val((+width_1_1).toFixed(2));
					$('#width_1_2').val((+width_1_2).toFixed(2));
					$('#width_1_3').val((+width_1_3).toFixed(2));
					$('#width_1_4').val((+width_1_4).toFixed(2));
					$('#width_2_1').val((+width_2_1).toFixed(2));
					$('#width_2_2').val((+width_2_2).toFixed(2));
					$('#width_2_3').val((+width_2_3).toFixed(2));
					$('#width_2_4').val((+width_2_4).toFixed(2));
					$('#width_3_1').val((+width_3_1).toFixed(2));
					$('#width_3_2').val((+width_3_2).toFixed(2));
					$('#width_3_3').val((+width_3_3).toFixed(2));
					$('#width_3_4').val((+width_3_4).toFixed(2));
					$('#width_4_1').val((+width_4_1).toFixed(2));
					$('#width_4_2').val((+width_4_2).toFixed(2));
					$('#width_4_3').val((+width_4_3).toFixed(2));
					$('#width_4_4').val((+width_4_4).toFixed(2));
					$('#width_5_1').val((+width_5_1).toFixed(2));
					$('#width_5_2').val((+width_5_2).toFixed(2));
					$('#width_5_3').val((+width_5_3).toFixed(2));
					$('#width_5_4').val((+width_5_4).toFixed(2));

					$('#thick_1_1').val((+thick_1_1).toFixed(2));
					$('#thick_1_2').val((+thick_1_2).toFixed(2));
					$('#thick_1_3').val((+thick_1_3).toFixed(2));
					$('#thick_1_4').val((+thick_1_4).toFixed(2));
					$('#thick_2_1').val((+thick_2_1).toFixed(2));
					$('#thick_2_2').val((+thick_2_2).toFixed(2));
					$('#thick_2_3').val((+thick_2_3).toFixed(2));
					$('#thick_2_4').val((+thick_2_4).toFixed(2));
					$('#thick_3_1').val((+thick_3_1).toFixed(2));
					$('#thick_3_2').val((+thick_3_2).toFixed(2));
					$('#thick_3_3').val((+thick_3_3).toFixed(2));
					$('#thick_3_4').val((+thick_3_4).toFixed(2));
					$('#thick_4_1').val((+thick_4_1).toFixed(2));
					$('#thick_4_2').val((+thick_4_2).toFixed(2));
					$('#thick_4_3').val((+thick_4_3).toFixed(2));
					$('#thick_4_4').val((+thick_4_4).toFixed(2));
					$('#thick_5_1').val((+thick_5_1).toFixed(2));
					$('#thick_5_2').val((+thick_5_2).toFixed(2));
					$('#thick_5_3').val((+thick_5_3).toFixed(2));
					$('#thick_5_4').val((+thick_5_4).toFixed(2));

					var length_1_1 = $('#length_1_1').val();
					var length_2_1 = $('#length_2_1').val();
					var length_3_1 = $('#length_3_1').val();
					var length_4_1 = $('#length_4_1').val();
					var length_5_1 = $('#length_5_1').val();
					var length_6_1 = $('#length_6_1').val();
					var length_7_1 = $('#length_7_1').val();
					var length_8_1 = $('#length_8_1').val();
					var length_9_1 = $('#length_9_1').val();
					var length_10_1 = $('#length_10_1').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1) + (+length_6_1) + (+length_7_1) + (+length_8_1) + (+length_9_1) + (+length_10_1)) / 5;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));


					var length_1_2 = $('#length_1_2').val();
					var length_2_2 = $('#length_2_2').val();
					var length_3_2 = $('#length_3_2').val();
					var length_4_2 = $('#length_4_2').val();
					var length_5_2 = $('#length_5_2').val();
					var length_6_2 = $('#length_6_2').val();
					var length_7_2 = $('#length_7_2').val();
					var length_8_2 = $('#length_8_2').val();
					var length_9_2 = $('#length_9_2').val();
					var length_10_2 = $('#length_10_2').val();

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2) + (+length_6_2) + (+length_7_2) + (+length_8_2) + (+length_9_2) + (+length_10_2)) / 5;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var length_1_3 = $('#length_1_3').val();
					var length_2_3 = $('#length_2_3').val();
					var length_3_3 = $('#length_3_3').val();
					var length_4_3 = $('#length_4_3').val();
					var length_5_3 = $('#length_5_3').val();
					var length_6_3 = $('#length_6_3').val();
					var length_7_3 = $('#length_7_3').val();
					var length_8_3 = $('#length_8_3').val();
					var length_9_3 = $('#length_9_3').val();
					var length_10_3 = $('#length_10_3').val();

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3) + (+length_6_3) + (+length_7_3) + (+length_8_3) + (+length_9_3) + (+length_10_3)) / 5;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));


					var length_1_4 = $('#length_1_4').val();
					var length_2_4 = $('#length_2_4').val();
					var length_3_4 = $('#length_3_4').val();
					var length_4_4 = $('#length_4_4').val();
					var length_5_4 = $('#length_5_4').val();
					var length_6_4 = $('#length_6_4').val();
					var length_7_4 = $('#length_7_4').val();
					var length_8_4 = $('#length_8_4').val();
					var length_9_4 = $('#length_9_4').val();
					var length_10_4 = $('#length_10_4').val();

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4) + (+length_6_4) + (+length_7_4) + (+length_8_4) + (+length_9_4) + (+length_10_4)) / 5;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));


					var width_1_1 = $('#width_1_1').val();
					var width_2_1 = $('#width_2_1').val();
					var width_3_1 = $('#width_3_1').val();
					var width_4_1 = $('#width_4_1').val();
					var width_5_1 = $('#width_5_1').val();
					var width_6_1 = $('#width_6_1').val();
					var width_7_1 = $('#width_7_1').val();
					var width_8_1 = $('#width_8_1').val();
					var width_9_1 = $('#width_9_1').val();
					var width_10_1 = $('#width_10_1').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1) + (+width_6_1) + (+width_7_1) + (+width_8_1) + (+width_9_1) + (+width_10_1)) / 5;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));


					var width_1_2 = $('#width_1_2').val();
					var width_2_2 = $('#width_2_2').val();
					var width_3_2 = $('#width_3_2').val();
					var width_4_2 = $('#width_4_2').val();
					var width_5_2 = $('#width_5_2').val();
					var width_6_2 = $('#width_6_2').val();
					var width_7_2 = $('#width_7_2').val();
					var width_8_2 = $('#width_8_2').val();
					var width_9_2 = $('#width_9_2').val();
					var width_10_2 = $('#width_10_2').val();

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2) + (+width_6_2) + (+width_7_2) + (+width_8_2) + (+width_9_2) + (+width_10_2)) / 5;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var width_1_3 = $('#width_1_3').val();
					var width_2_3 = $('#width_2_3').val();
					var width_3_3 = $('#width_3_3').val();
					var width_4_3 = $('#width_4_3').val();
					var width_5_3 = $('#width_5_3').val();
					var width_6_3 = $('#width_6_3').val();
					var width_7_3 = $('#width_7_3').val();
					var width_8_3 = $('#width_8_3').val();
					var width_9_3 = $('#width_9_3').val();
					var width_10_3 = $('#width_10_3').val();

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3) + (+width_6_3) + (+width_7_3) + (+width_8_3) + (+width_9_3) + (+width_10_3)) / 5;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));


					var width_1_4 = $('#width_1_4').val();
					var width_2_4 = $('#width_2_4').val();
					var width_3_4 = $('#width_3_4').val();
					var width_4_4 = $('#width_4_4').val();
					var width_5_4 = $('#width_5_4').val();
					var width_6_4 = $('#width_6_4').val();
					var width_7_4 = $('#width_7_4').val();
					var width_8_4 = $('#width_8_4').val();
					var width_9_4 = $('#width_9_4').val();
					var width_10_4 = $('#width_10_4').val();

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4) + (+width_6_4) + (+width_7_4) + (+width_8_4) + (+width_9_4) + (+width_10_4)) / 5;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));


					var thick_1_1 = $('#thick_1_1').val();
					var thick_2_1 = $('#thick_2_1').val();
					var thick_3_1 = $('#thick_3_1').val();
					var thick_4_1 = $('#thick_4_1').val();
					var thick_5_1 = $('#thick_5_1').val();
					var thick_6_1 = $('#thick_6_1').val();
					var thick_7_1 = $('#thick_7_1').val();
					var thick_8_1 = $('#thick_8_1').val();
					var thick_9_1 = $('#thick_9_1').val();
					var thick_10_1 = $('#thick_10_1').val();

					var avg_1_9 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1) + (+thick_6_1) + (+thick_7_1) + (+thick_8_1) + (+thick_9_1) + (+thick_10_1)) / 5;
					$('#avg_1_9').val((+avg_1_9).toFixed(2));


					var thick_1_2 = $('#thick_1_2').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_8_2 = $('#thick_8_2').val();
					var thick_9_2 = $('#thick_9_2').val();
					var thick_10_2 = $('#thick_10_2').val();

					var avg_1_10 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2) + (+thick_6_2) + (+thick_7_2) + (+thick_8_2) + (+thick_9_2) + (+thick_10_2)) / 5;
					$('#avg_1_10').val((+avg_1_10).toFixed(2));

					var thick_1_3 = $('#thick_1_3').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_8_3 = $('#thick_8_3').val();
					var thick_9_3 = $('#thick_9_3').val();
					var thick_10_3 = $('#thick_10_3').val();

					var avg_1_11 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3) + (+thick_6_3) + (+thick_7_3) + (+thick_8_3) + (+thick_9_3) + (+thick_10_3)) / 5;
					$('#avg_1_11').val((+avg_1_11).toFixed(2));


					var thick_1_4 = $('#thick_1_4').val();
					var thick_2_4 = $('#thick_2_4').val();
					var thick_3_4 = $('#thick_3_4').val();
					var thick_4_4 = $('#thick_4_4').val();
					var thick_5_4 = $('#thick_5_4').val();
					var thick_6_4 = $('#thick_6_4').val();
					var thick_7_4 = $('#thick_7_4').val();
					var thick_8_4 = $('#thick_8_4').val();
					var thick_9_4 = $('#thick_9_4').val();
					var thick_10_4 = $('#thick_10_4').val();

					var avg_1_12 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4) + (+thick_6_4) + (+thick_7_4) + (+thick_8_4) + (+thick_9_4) + (+thick_10_4)) / 5;
					$('#avg_1_12').val((+avg_1_12).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();
					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();
					var avg_1_9 = $('#avg_1_9').val();
					var avg_1_10 = $('#avg_1_10').val();
					var avg_1_11 = $('#avg_1_11').val();
					var avg_1_12 = $('#avg_1_12').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					var avg_3 = ((+avg_1_9) + (+avg_1_10) + (+avg_1_11) + (+avg_1_12)) / 4;

					$('#avg_1').val((+avg_1).toFixed(2));
					$('#avg_2').val((+avg_2).toFixed(2));
					$('#avg_3').val((+avg_3).toFixed(2));
				}
			} else {
				alert('Please Select Tiles Grade');
			}
		}
		$('#chk_dim').change(function() {
			if (this.checked) {
				dim_auto();
			} else {
				$('#txtdim').css("background-color", "white");
				$('#length_1_1').val(null);
				$('#length_1_2').val(null);
				$('#length_1_3').val(null);
				$('#length_1_4').val(null);
				$('#length_2_1').val(null);
				$('#length_2_2').val(null);
				$('#length_2_3').val(null);
				$('#length_2_4').val(null);
				$('#length_3_1').val(null);
				$('#length_3_2').val(null);
				$('#length_3_3').val(null);
				$('#length_3_4').val(null);
				$('#length_4_1').val(null);
				$('#length_4_2').val(null);
				$('#length_4_3').val(null);
				$('#length_4_4').val(null);
				$('#length_5_1').val(null);
				$('#length_5_2').val(null);
				$('#length_5_3').val(null);
				$('#length_5_4').val(null);
				$('#length_6_1').val(null);
				$('#length_6_2').val(null);
				$('#length_6_3').val(null);
				$('#length_6_4').val(null);
				$('#length_7_1').val(null);
				$('#length_7_2').val(null);
				$('#length_7_3').val(null);
				$('#length_7_4').val(null);
				$('#length_8_1').val(null);
				$('#length_8_2').val(null);
				$('#length_8_3').val(null);
				$('#length_8_4').val(null);
				$('#length_9_1').val(null);
				$('#length_9_2').val(null);
				$('#length_9_3').val(null);
				$('#length_9_4').val(null);
				$('#length_10_1').val(null);
				$('#length_10_2').val(null);
				$('#length_10_3').val(null);
				$('#length_10_4').val(null);
				$('#width_1_1').val(null);
				$('#width_1_2').val(null);
				$('#width_1_3').val(null);
				$('#width_1_4').val(null);
				$('#width_2_1').val(null);
				$('#width_2_2').val(null);
				$('#width_2_3').val(null);
				$('#width_2_4').val(null);
				$('#width_3_1').val(null);
				$('#width_3_2').val(null);
				$('#width_3_3').val(null);
				$('#width_3_4').val(null);
				$('#width_4_1').val(null);
				$('#width_4_2').val(null);
				$('#width_4_3').val(null);
				$('#width_4_4').val(null);
				$('#width_5_1').val(null);
				$('#width_5_2').val(null);
				$('#width_5_3').val(null);
				$('#width_5_4').val(null);
				$('#width_6_1').val(null);
				$('#width_6_2').val(null);
				$('#width_6_3').val(null);
				$('#width_6_4').val(null);
				$('#width_7_1').val(null);
				$('#width_7_2').val(null);
				$('#width_7_3').val(null);
				$('#width_7_4').val(null);
				$('#width_8_1').val(null);
				$('#width_8_2').val(null);
				$('#width_8_3').val(null);
				$('#width_8_4').val(null);
				$('#width_9_1').val(null);
				$('#width_9_2').val(null);
				$('#width_9_3').val(null);
				$('#width_9_4').val(null);
				$('#width_10_1').val(null);
				$('#width_10_2').val(null);
				$('#width_10_3').val(null);
				$('#width_10_4').val(null);
				$('#thick_1_1').val(null);
				$('#thick_1_2').val(null);
				$('#thick_1_3').val(null);
				$('#thick_1_4').val(null);
				$('#thick_2_1').val(null);
				$('#thick_2_2').val(null);
				$('#thick_2_3').val(null);
				$('#thick_2_4').val(null);
				$('#thick_3_1').val(null);
				$('#thick_3_2').val(null);
				$('#thick_3_3').val(null);
				$('#thick_3_4').val(null);
				$('#thick_4_1').val(null);
				$('#thick_4_2').val(null);
				$('#thick_4_3').val(null);
				$('#thick_4_4').val(null);
				$('#thick_5_1').val(null);
				$('#thick_5_2').val(null);
				$('#thick_5_3').val(null);
				$('#thick_5_4').val(null);
				$('#thick_6_1').val(null);
				$('#thick_6_2').val(null);
				$('#thick_6_3').val(null);
				$('#thick_6_4').val(null);
				$('#thick_7_1').val(null);
				$('#thick_7_2').val(null);
				$('#thick_7_3').val(null);
				$('#thick_7_4').val(null);
				$('#thick_8_1').val(null);
				$('#thick_8_2').val(null);
				$('#thick_8_3').val(null);
				$('#thick_8_4').val(null);
				$('#thick_9_1').val(null);
				$('#thick_9_2').val(null);
				$('#thick_9_3').val(null);
				$('#thick_9_4').val(null);
				$('#thick_10_1').val(null);
				$('#thick_10_2').val(null);
				$('#thick_10_3').val(null);
				$('#thick_10_4').val(null);

			}
		});

		$('#length_1_1, #length_1_2, #length_1_3, #length_1_4, #length_2_1, #length_2_2, #length_2_3, #length_2_4, #length_3_1, #length_3_2, #length_3_3, #length_3_4, #length_4_1, #length_4_2, #length_4_3, #length_4_4, #length_5_1, #length_5_2, #length_5_3, #length_5_4, #length_6_1, #length_6_2, #length_6_3, #length_6_4, #length_7_1, #length_7_2, #length_7_3, #length_7_4, #length_8_1, #length_8_2, #length_8_3, #length_8_4, #length_9_1, #length_9_2, #length_9_3, #length_9_4, #length_10_1, #length_10_2, #length_10_3, #length_10_4').change(function() {
			var tiles_type = $('#tiles_type').val();
			var tiles_grade = $('#tiles_grade').val();
			if (tiles_type == "modular") {
				if ((tiles_grade == "M10 x 10") || (tiles_grade == "M15 x 15") || (tiles_grade == "M15 x 10") || (tiles_grade == "M20 x 10") || (tiles_grade == "M20 x 15") || (tiles_grade == "M20 x 20") || (tiles_grade == "M20 x 30") || (tiles_grade == "M20 x 40") || (tiles_grade == "M25 x 25") || (tiles_grade == "M30 x 15") || (tiles_grade == "M30 x 30")) {
					var length_1_1 = $('#length_1_1').val();
					var length_1_2 = $('#length_1_2').val();
					var length_1_3 = $('#length_1_3').val();
					var length_1_4 = $('#length_1_4').val();

					var length_2_1 = $('#length_2_1').val();
					var length_2_2 = $('#length_2_2').val();
					var length_2_3 = $('#length_2_3').val();
					var length_2_4 = $('#length_2_4').val();

					var length_3_1 = $('#length_3_1').val();
					var length_3_2 = $('#length_3_2').val();
					var length_3_3 = $('#length_3_3').val();
					var length_3_4 = $('#length_3_4').val();

					var length_4_1 = $('#length_4_1').val();
					var length_4_2 = $('#length_4_2').val();
					var length_4_3 = $('#length_4_3').val();
					var length_4_4 = $('#length_4_4').val();

					var length_5_1 = $('#length_5_1').val();
					var length_5_2 = $('#length_5_2').val();
					var length_5_3 = $('#length_5_3').val();
					var length_5_4 = $('#length_5_4').val();

					var length_6_1 = $('#length_6_1').val();
					var length_6_2 = $('#length_6_2').val();
					var length_6_3 = $('#length_6_3').val();
					var length_6_4 = $('#length_6_4').val();

					var length_7_1 = $('#length_7_1').val();
					var length_7_2 = $('#length_7_2').val();
					var length_7_3 = $('#length_7_3').val();
					var length_7_4 = $('#length_7_4').val();

					var length_8_1 = $('#length_8_1').val();
					var length_8_2 = $('#length_8_2').val();
					var length_8_3 = $('#length_8_3').val();
					var length_8_4 = $('#length_8_4').val();

					var length_9_1 = $('#length_9_1').val();
					var length_9_2 = $('#length_9_2').val();
					var length_9_3 = $('#length_9_3').val();
					var length_9_4 = $('#length_9_4').val();

					var length_10_1 = $('#length_10_1').val();
					var length_10_2 = $('#length_10_2').val();
					var length_10_3 = $('#length_10_3').val();
					var length_10_4 = $('#length_10_4').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1) + (+length_6_1) + (+length_7_1) + (+length_8_1) + (+length_9_1) + (+length_10_1)) / 10;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2) + (+length_6_2) + (+length_7_2) + (+length_8_2) + (+length_9_2) + (+length_10_2)) / 10;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3) + (+length_6_3) + (+length_7_3) + (+length_8_3) + (+length_9_3) + (+length_10_3)) / 10;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4) + (+length_6_4) + (+length_7_4) + (+length_8_4) + (+length_9_4) + (+length_10_4)) / 10;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					$('#avg_1').val((+avg_1).toFixed(2));
				} else if ((tiles_grade == "M30 x 45") || (tiles_grade == "M30 x 60") || (tiles_grade == "M30 x 75") || (tiles_grade == "M30 x 30") || (tiles_grade == "M40 x 30") || (tiles_grade == "M40 x 40") || (tiles_grade == "M45 x 45") || (tiles_grade == "M40 x 80") || (tiles_grade == "M45 x 90") || (tiles_grade == "M50 x 50") || (tiles_grade == "M60 x 60")) {
					var length_1_1 = $('#length_1_1').val();
					var length_1_2 = $('#length_1_2').val();
					var length_1_3 = $('#length_1_3').val();
					var length_1_4 = $('#length_1_4').val();

					var length_2_1 = $('#length_2_1').val();
					var length_2_2 = $('#length_2_2').val();
					var length_2_3 = $('#length_2_3').val();
					var length_2_4 = $('#length_2_4').val();

					var length_3_1 = $('#length_3_1').val();
					var length_3_2 = $('#length_3_2').val();
					var length_3_3 = $('#length_3_3').val();
					var length_3_4 = $('#length_3_4').val();

					var length_4_1 = $('#length_4_1').val();
					var length_4_2 = $('#length_4_2').val();
					var length_4_3 = $('#length_4_3').val();
					var length_4_4 = $('#length_4_4').val();

					var length_5_1 = $('#length_5_1').val();
					var length_5_2 = $('#length_5_2').val();
					var length_5_3 = $('#length_5_3').val();
					var length_5_4 = $('#length_5_4').val();

					var length_6_1 = $('#length_6_1').val();
					var length_6_2 = $('#length_6_2').val();
					var length_6_3 = $('#length_6_3').val();
					var length_6_4 = $('#length_6_4').val();

					var length_7_1 = $('#length_7_1').val();
					var length_7_2 = $('#length_7_2').val();
					var length_7_3 = $('#length_7_3').val();
					var length_7_4 = $('#length_7_4').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1) + (+length_6_1) + (+length_7_1)) / 7;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2) + (+length_6_2) + (+length_7_2)) / 7;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3) + (+length_6_3) + (+length_7_3)) / 7;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4) + (+length_6_4) + (+length_7_4)) / 7;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					$('#avg_1').val((+avg_1).toFixed(2));

				} else if ((tiles_grade == "M60 x 90") || (tiles_grade == "M80 x 80") || (tiles_grade == "M90 x 90") || (tiles_grade == "M60 x 120") || (tiles_grade == "M100 x 100") || (tiles_grade == "M90 x 120") || (tiles_grade == "M120 x 120")) {
					var length_1_1 = $('#length_1_1').val();
					var length_1_2 = $('#length_1_2').val();
					var length_1_3 = $('#length_1_3').val();
					var length_1_4 = $('#length_1_4').val();

					var length_2_1 = $('#length_2_1').val();
					var length_2_2 = $('#length_2_2').val();
					var length_2_3 = $('#length_2_3').val();
					var length_2_4 = $('#length_2_4').val();

					var length_3_1 = $('#length_3_1').val();
					var length_3_2 = $('#length_3_2').val();
					var length_3_3 = $('#length_3_3').val();
					var length_3_4 = $('#length_3_4').val();

					var length_4_1 = $('#length_4_1').val();
					var length_4_2 = $('#length_4_2').val();
					var length_4_3 = $('#length_4_3').val();
					var length_4_4 = $('#length_4_4').val();

					var length_5_1 = $('#length_5_1').val();
					var length_5_2 = $('#length_5_2').val();
					var length_5_3 = $('#length_5_3').val();
					var length_5_4 = $('#length_5_4').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1)) / 5;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2)) / 5;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3)) / 5;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4)) / 5;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					$('#avg_1').val((+avg_1).toFixed(2));
				}
			} else if (tiles_type == "non-modular") {
				if ((tiles_grade == "10.8 x 10.8") || (tiles_grade == "15 x 7.5") || (tiles_grade == "15.2 x 7.6") || (tiles_grade == "15.2 x 15.2") || (tiles_grade == "21.6 x 10.8") || (tiles_grade == "25 x 33")) {
					var length_1_1 = $('#length_1_1').val();
					var length_1_2 = $('#length_1_2').val();
					var length_1_3 = $('#length_1_3').val();
					var length_1_4 = $('#length_1_4').val();

					var length_2_1 = $('#length_2_1').val();
					var length_2_2 = $('#length_2_2').val();
					var length_2_3 = $('#length_2_3').val();
					var length_2_4 = $('#length_2_4').val();

					var length_3_1 = $('#length_3_1').val();
					var length_3_2 = $('#length_3_2').val();
					var length_3_3 = $('#length_3_3').val();
					var length_3_4 = $('#length_3_4').val();

					var length_4_1 = $('#length_4_1').val();
					var length_4_2 = $('#length_4_2').val();
					var length_4_3 = $('#length_4_3').val();
					var length_4_4 = $('#length_4_4').val();

					var length_5_1 = $('#length_5_1').val();
					var length_5_2 = $('#length_5_2').val();
					var length_5_3 = $('#length_5_3').val();
					var length_5_4 = $('#length_5_4').val();

					var length_6_1 = $('#length_6_1').val();
					var length_6_2 = $('#length_6_2').val();
					var length_6_3 = $('#length_6_3').val();
					var length_6_4 = $('#length_6_4').val();

					var length_7_1 = $('#length_7_1').val();
					var length_7_2 = $('#length_7_2').val();
					var length_7_3 = $('#length_7_3').val();
					var length_7_4 = $('#length_7_4').val();

					var length_8_1 = $('#length_8_1').val();
					var length_8_2 = $('#length_8_2').val();
					var length_8_3 = $('#length_8_3').val();
					var length_8_4 = $('#length_8_4').val();

					var length_9_1 = $('#length_9_1').val();
					var length_9_2 = $('#length_9_2').val();
					var length_9_3 = $('#length_9_3').val();
					var length_9_4 = $('#length_9_4').val();

					var length_10_1 = $('#length_10_1').val();
					var length_10_2 = $('#length_10_2').val();
					var length_10_3 = $('#length_10_3').val();
					var length_10_4 = $('#length_10_4').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1) + (+length_6_1) + (+length_7_1) + (+length_8_1) + (+length_9_1) + (+length_10_1)) / 10;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2) + (+length_6_2) + (+length_7_2) + (+length_8_2) + (+length_9_2) + (+length_10_2)) / 10;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3) + (+length_6_3) + (+length_7_3) + (+length_8_3) + (+length_9_3) + (+length_10_3)) / 10;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4) + (+length_6_4) + (+length_7_4) + (+length_8_4) + (+length_9_4) + (+length_10_4)) / 10;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					$('#avg_1').val((+avg_1).toFixed(2));
				} else if ((tiles_grade == "25 x 38") || (tiles_grade == "31.5 x 42") || (tiles_grade == "32 x 32") || (tiles_grade == "32 x 40") || (tiles_grade == "32 x 48") || (tiles_grade == "32 x 60") || (tiles_grade == "33 x 33") || (tiles_grade == "33 x 48") || (tiles_grade == "33 x 60") || (tiles_grade == "33 x 90") || (tiles_grade == "30.6 x 30.6") || (tiles_grade == "31.5 x 31.5") || (tiles_grade == "40.6 x 40.6")) {
					var length_1_1 = $('#length_1_1').val();
					var length_1_2 = $('#length_1_2').val();
					var length_1_3 = $('#length_1_3').val();
					var length_1_4 = $('#length_1_4').val();

					var length_2_1 = $('#length_2_1').val();
					var length_2_2 = $('#length_2_2').val();
					var length_2_3 = $('#length_2_3').val();
					var length_2_4 = $('#length_2_4').val();

					var length_3_1 = $('#length_3_1').val();
					var length_3_2 = $('#length_3_2').val();
					var length_3_3 = $('#length_3_3').val();
					var length_3_4 = $('#length_3_4').val();

					var length_4_1 = $('#length_4_1').val();
					var length_4_2 = $('#length_4_2').val();
					var length_4_3 = $('#length_4_3').val();
					var length_4_4 = $('#length_4_4').val();

					var length_5_1 = $('#length_5_1').val();
					var length_5_2 = $('#length_5_2').val();
					var length_5_3 = $('#length_5_3').val();
					var length_5_4 = $('#length_5_4').val();

					var length_6_1 = $('#length_6_1').val();
					var length_6_2 = $('#length_6_2').val();
					var length_6_3 = $('#length_6_3').val();
					var length_6_4 = $('#length_6_4').val();

					var length_7_1 = $('#length_7_1').val();
					var length_7_2 = $('#length_7_2').val();
					var length_7_3 = $('#length_7_3').val();
					var length_7_4 = $('#length_7_4').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1) + (+length_6_1) + (+length_7_1)) / 7;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2) + (+length_6_2) + (+length_7_2)) / 7;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3) + (+length_6_3) + (+length_7_3)) / 7;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4) + (+length_6_4) + (+length_7_4)) / 7;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					$('#avg_1').val((+avg_1).toFixed(2));
				} else if ((tiles_grade == "60.5 x 60.5") || (tiles_grade == "81.5 x 81.5")) {
					var length_1_1 = $('#length_1_1').val();
					var length_1_2 = $('#length_1_2').val();
					var length_1_3 = $('#length_1_3').val();
					var length_1_4 = $('#length_1_4').val();

					var length_2_1 = $('#length_2_1').val();
					var length_2_2 = $('#length_2_2').val();
					var length_2_3 = $('#length_2_3').val();
					var length_2_4 = $('#length_2_4').val();

					var length_3_1 = $('#length_3_1').val();
					var length_3_2 = $('#length_3_2').val();
					var length_3_3 = $('#length_3_3').val();
					var length_3_4 = $('#length_3_4').val();

					var length_4_1 = $('#length_4_1').val();
					var length_4_2 = $('#length_4_2').val();
					var length_4_3 = $('#length_4_3').val();
					var length_4_4 = $('#length_4_4').val();

					var length_5_1 = $('#length_5_1').val();
					var length_5_2 = $('#length_5_2').val();
					var length_5_3 = $('#length_5_3').val();
					var length_5_4 = $('#length_5_4').val();

					var avg_1_1 = ((+length_1_1) + (+length_2_1) + (+length_3_1) + (+length_4_1) + (+length_5_1)) / 5;
					$('#avg_1_1').val((+avg_1_1).toFixed(2));

					var avg_1_2 = ((+length_1_2) + (+length_2_2) + (+length_3_2) + (+length_4_2) + (+length_5_2)) / 5;
					$('#avg_1_2').val((+avg_1_2).toFixed(2));

					var avg_1_3 = ((+length_1_3) + (+length_2_3) + (+length_3_3) + (+length_4_3) + (+length_5_3)) / 5;
					$('#avg_1_3').val((+avg_1_3).toFixed(2));

					var avg_1_4 = ((+length_1_4) + (+length_2_4) + (+length_3_4) + (+length_4_4) + (+length_5_4)) / 5;
					$('#avg_1_4').val((+avg_1_4).toFixed(2));

					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();

					var avg_1 = ((+avg_1_1) + (+avg_1_2) + (+avg_1_3) + (+avg_1_4)) / 4;
					$('#avg_1').val((+avg_1).toFixed(2));
				}
			} else {
				alert('Please Select Tiles Grade');
			}
		})

		$('#width_1_1, #width_1_2, #width_1_3, #width_1_4, #width_2_1, #width_2_2, #width_2_3, #width_2_4, #width_3_1, #width_3_2, #width_3_3, #width_3_4, #width_4_1, #width_4_2, #width_4_3, #width_4_4, #width_5_1, #width_5_2, #width_5_3, #width_5_4, #width_6_1, #width_6_2, #width_6_3, #width_6_4, #width_7_1, #width_7_2, #width_7_3, #width_7_4, #width_8_1, #width_8_2, #width_8_3, #width_8_4, #width_9_1, #width_9_2, #width_9_3, #width_9_4, #width_10_1, #width_10_2, #width_10_3, #width_10_4').change(function() {
			var tiles_type = $('#tiles_type').val();
			var tiles_grade = $('#tiles_grade').val();

			if (tiles_type == "modular") {
				if ((tiles_grade == "M10 x 10") || (tiles_grade == "M15 x 15") || (tiles_grade == "M15 x 10") || (tiles_grade == "M20 x 10") || (tiles_grade == "M20 x 15") || (tiles_grade == "M20 x 20") || (tiles_grade == "M20 x 30") || (tiles_grade == "M20 x 40") || (tiles_grade == "M25 x 25") || (tiles_grade == "M30 x 15") || (tiles_grade == "M30 x 30")) {
					var width_1_1 = $('#width_1_1').val();
					var width_1_2 = $('#width_1_2').val();
					var width_1_3 = $('#width_1_3').val();
					var width_1_4 = $('#width_1_4').val();

					var width_2_1 = $('#width_2_1').val();
					var width_2_2 = $('#width_2_2').val();
					var width_2_3 = $('#width_2_3').val();
					var width_2_4 = $('#width_2_4').val();

					var width_3_1 = $('#width_3_1').val();
					var width_3_2 = $('#width_3_2').val();
					var width_3_3 = $('#width_3_3').val();
					var width_3_4 = $('#width_3_4').val();

					var width_4_1 = $('#width_4_1').val();
					var width_4_2 = $('#width_4_2').val();
					var width_4_3 = $('#width_4_3').val();
					var width_4_4 = $('#width_4_4').val();

					var width_5_1 = $('#width_5_1').val();
					var width_5_2 = $('#width_5_2').val();
					var width_5_3 = $('#width_5_3').val();
					var width_5_4 = $('#width_5_4').val();

					var width_6_1 = $('#width_6_1').val();
					var width_6_2 = $('#width_6_2').val();
					var width_6_3 = $('#width_6_3').val();
					var width_6_4 = $('#width_6_4').val();

					var width_7_1 = $('#width_7_1').val();
					var width_7_2 = $('#width_7_2').val();
					var width_7_3 = $('#width_7_3').val();
					var width_7_4 = $('#width_7_4').val();

					var width_8_1 = $('#width_8_1').val();
					var width_8_2 = $('#width_8_2').val();
					var width_8_3 = $('#width_8_3').val();
					var width_8_4 = $('#width_8_4').val();

					var width_9_1 = $('#width_9_1').val();
					var width_9_2 = $('#width_9_2').val();
					var width_9_3 = $('#width_9_3').val();
					var width_9_4 = $('#width_9_4').val();

					var width_10_1 = $('#width_10_1').val();
					var width_10_2 = $('#width_10_2').val();
					var width_10_3 = $('#width_10_3').val();
					var width_10_4 = $('#width_10_4').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1) + (+width_6_1) + (+width_7_1) + (+width_8_1) + (+width_9_1) + (+width_10_1)) / 10;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2) + (+width_6_2) + (+width_7_2) + (+width_8_2) + (+width_9_2) + (+width_10_2)) / 10;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3) + (+width_6_3) + (+width_7_3) + (+width_8_3) + (+width_9_3) + (+width_10_3)) / 10;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4) + (+width_6_4) + (+width_7_4) + (+width_8_4) + (+width_9_4) + (+width_10_4)) / 10;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));
				} else if ((tiles_grade == "M30 x 45") || (tiles_grade == "M30 x 60") || (tiles_grade == "M30 x 75") || (tiles_grade == "M30 x 30") || (tiles_grade == "M40 x 30") || (tiles_grade == "M40 x 40") || (tiles_grade == "M45 x 45") || (tiles_grade == "M40 x 80") || (tiles_grade == "M45 x 90") || (tiles_grade == "M50 x 50") || (tiles_grade == "M60 x 60")) {
					var width_1_1 = $('#width_1_1').val();
					var width_1_2 = $('#width_1_2').val();
					var width_1_3 = $('#width_1_3').val();
					var width_1_4 = $('#width_1_4').val();

					var width_2_1 = $('#width_2_1').val();
					var width_2_2 = $('#width_2_2').val();
					var width_2_3 = $('#width_2_3').val();
					var width_2_4 = $('#width_2_4').val();

					var width_3_1 = $('#width_3_1').val();
					var width_3_2 = $('#width_3_2').val();
					var width_3_3 = $('#width_3_3').val();
					var width_3_4 = $('#width_3_4').val();

					var width_4_1 = $('#width_4_1').val();
					var width_4_2 = $('#width_4_2').val();
					var width_4_3 = $('#width_4_3').val();
					var width_4_4 = $('#width_4_4').val();

					var width_5_1 = $('#width_5_1').val();
					var width_5_2 = $('#width_5_2').val();
					var width_5_3 = $('#width_5_3').val();
					var width_5_4 = $('#width_5_4').val();

					var width_6_1 = $('#width_6_1').val();
					var width_6_2 = $('#width_6_2').val();
					var width_6_3 = $('#width_6_3').val();
					var width_6_4 = $('#width_6_4').val();

					var width_7_1 = $('#width_7_1').val();
					var width_7_2 = $('#width_7_2').val();
					var width_7_3 = $('#width_7_3').val();
					var width_7_4 = $('#width_7_4').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1) + (+width_6_1) + (+width_7_1)) / 7;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2) + (+width_6_2) + (+width_7_2)) / 7;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3) + (+width_6_3) + (+width_7_3)) / 7;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4) + (+width_6_4) + (+width_7_4)) / 7;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));

				} else if ((tiles_grade == "M60 x 90") || (tiles_grade == "M80 x 80") || (tiles_grade == "M90 x 90") || (tiles_grade == "M60 x 120") || (tiles_grade == "M100 x 100") || (tiles_grade == "M90 x 120") || (tiles_grade == "M120 x 120")) {
					var width_1_1 = $('#width_1_1').val();
					var width_1_2 = $('#width_1_2').val();
					var width_1_3 = $('#width_1_3').val();
					var width_1_4 = $('#width_1_4').val();

					var width_2_1 = $('#width_2_1').val();
					var width_2_2 = $('#width_2_2').val();
					var width_2_3 = $('#width_2_3').val();
					var width_2_4 = $('#width_2_4').val();

					var width_3_1 = $('#width_3_1').val();
					var width_3_2 = $('#width_3_2').val();
					var width_3_3 = $('#width_3_3').val();
					var width_3_4 = $('#width_3_4').val();

					var width_4_1 = $('#width_4_1').val();
					var width_4_2 = $('#width_4_2').val();
					var width_4_3 = $('#width_4_3').val();
					var width_4_4 = $('#width_4_4').val();

					var width_5_1 = $('#width_5_1').val();
					var width_5_2 = $('#width_5_2').val();
					var width_5_3 = $('#width_5_3').val();
					var width_5_4 = $('#width_5_4').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1)) / 5;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2)) / 5;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3)) / 5;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4)) / 5;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));
				}
			} else if (tiles_type == "non-modular") {
				if ((tiles_grade == "10.8 x 10.8") || (tiles_grade == "15 x 7.5") || (tiles_grade == "15.2 x 7.6") || (tiles_grade == "15.2 x 15.2") || (tiles_grade == "21.6 x 10.8") || (tiles_grade == "25 x 33")) {
					var width_1_1 = $('#width_1_1').val();
					var width_1_2 = $('#width_1_2').val();
					var width_1_3 = $('#width_1_3').val();
					var width_1_4 = $('#width_1_4').val();

					var width_2_1 = $('#width_2_1').val();
					var width_2_2 = $('#width_2_2').val();
					var width_2_3 = $('#width_2_3').val();
					var width_2_4 = $('#width_2_4').val();

					var width_3_1 = $('#width_3_1').val();
					var width_3_2 = $('#width_3_2').val();
					var width_3_3 = $('#width_3_3').val();
					var width_3_4 = $('#width_3_4').val();

					var width_4_1 = $('#width_4_1').val();
					var width_4_2 = $('#width_4_2').val();
					var width_4_3 = $('#width_4_3').val();
					var width_4_4 = $('#width_4_4').val();

					var width_5_1 = $('#width_5_1').val();
					var width_5_2 = $('#width_5_2').val();
					var width_5_3 = $('#width_5_3').val();
					var width_5_4 = $('#width_5_4').val();

					var width_6_1 = $('#width_6_1').val();
					var width_6_2 = $('#width_6_2').val();
					var width_6_3 = $('#width_6_3').val();
					var width_6_4 = $('#width_6_4').val();

					var width_7_1 = $('#width_7_1').val();
					var width_7_2 = $('#width_7_2').val();
					var width_7_3 = $('#width_7_3').val();
					var width_7_4 = $('#width_7_4').val();

					var width_8_1 = $('#width_8_1').val();
					var width_8_2 = $('#width_8_2').val();
					var width_8_3 = $('#width_8_3').val();
					var width_8_4 = $('#width_8_4').val();

					var width_9_1 = $('#width_9_1').val();
					var width_9_2 = $('#width_9_2').val();
					var width_9_3 = $('#width_9_3').val();
					var width_9_4 = $('#width_9_4').val();

					var width_10_1 = $('#width_10_1').val();
					var width_10_2 = $('#width_10_2').val();
					var width_10_3 = $('#width_10_3').val();
					var width_10_4 = $('#width_10_4').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1) + (+width_6_1) + (+width_7_1) + (+width_8_1) + (+width_9_1) + (+width_10_1)) / 10;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2) + (+width_6_2) + (+width_7_2) + (+width_8_2) + (+width_9_2) + (+width_10_2)) / 10;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3) + (+width_6_3) + (+width_7_3) + (+width_8_3) + (+width_9_3) + (+width_10_3)) / 10;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4) + (+width_6_4) + (+width_7_4) + (+width_8_4) + (+width_9_4) + (+width_10_4)) / 10;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));
				} else if ((tiles_grade == "25 x 38") || (tiles_grade == "31.5 x 42") || (tiles_grade == "32 x 32") || (tiles_grade == "32 x 40") || (tiles_grade == "32 x 48") || (tiles_grade == "32 x 60") || (tiles_grade == "33 x 33") || (tiles_grade == "33 x 48") || (tiles_grade == "33 x 60") || (tiles_grade == "33 x 90") || (tiles_grade == "30.6 x 30.6") || (tiles_grade == "31.5 x 31.5") || (tiles_grade == "40.6 x 40.6")) {
					var width_1_1 = $('#width_1_1').val();
					var width_1_2 = $('#width_1_2').val();
					var width_1_3 = $('#width_1_3').val();
					var width_1_4 = $('#width_1_4').val();

					var width_2_1 = $('#width_2_1').val();
					var width_2_2 = $('#width_2_2').val();
					var width_2_3 = $('#width_2_3').val();
					var width_2_4 = $('#width_2_4').val();

					var width_3_1 = $('#width_3_1').val();
					var width_3_2 = $('#width_3_2').val();
					var width_3_3 = $('#width_3_3').val();
					var width_3_4 = $('#width_3_4').val();

					var width_4_1 = $('#width_4_1').val();
					var width_4_2 = $('#width_4_2').val();
					var width_4_3 = $('#width_4_3').val();
					var width_4_4 = $('#width_4_4').val();

					var width_5_1 = $('#width_5_1').val();
					var width_5_2 = $('#width_5_2').val();
					var width_5_3 = $('#width_5_3').val();
					var width_5_4 = $('#width_5_4').val();

					var width_6_1 = $('#width_6_1').val();
					var width_6_2 = $('#width_6_2').val();
					var width_6_3 = $('#width_6_3').val();
					var width_6_4 = $('#width_6_4').val();

					var width_7_1 = $('#width_7_1').val();
					var width_7_2 = $('#width_7_2').val();
					var width_7_3 = $('#width_7_3').val();
					var width_7_4 = $('#width_7_4').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1) + (+width_6_1) + (+width_7_1)) / 7;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2) + (+width_6_2) + (+width_7_2)) / 7;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3) + (+width_6_3) + (+width_7_3)) / 7;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4) + (+width_6_4) + (+width_7_4)) / 7;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));



				} else if ((tiles_grade == "60.5 x 60.5") || (tiles_grade == "81.5 x 81.5")) {
					var width_1_1 = $('#width_1_1').val();
					var width_1_2 = $('#width_1_2').val();
					var width_1_3 = $('#width_1_3').val();
					var width_1_4 = $('#width_1_4').val();

					var width_2_1 = $('#width_2_1').val();
					var width_2_2 = $('#width_2_2').val();
					var width_2_3 = $('#width_2_3').val();
					var width_2_4 = $('#width_2_4').val();

					var width_3_1 = $('#width_3_1').val();
					var width_3_2 = $('#width_3_2').val();
					var width_3_3 = $('#width_3_3').val();
					var width_3_4 = $('#width_3_4').val();

					var width_4_1 = $('#width_4_1').val();
					var width_4_2 = $('#width_4_2').val();
					var width_4_3 = $('#width_4_3').val();
					var width_4_4 = $('#width_4_4').val();

					var width_5_1 = $('#width_5_1').val();
					var width_5_2 = $('#width_5_2').val();
					var width_5_3 = $('#width_5_3').val();
					var width_5_4 = $('#width_5_4').val();

					var avg_1_5 = ((+width_1_1) + (+width_2_1) + (+width_3_1) + (+width_4_1) + (+width_5_1)) / 5;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+width_1_2) + (+width_2_2) + (+width_3_2) + (+width_4_2) + (+width_5_2)) / 5;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+width_1_3) + (+width_2_3) + (+width_3_3) + (+width_4_3) + (+width_5_3)) / 5;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+width_1_4) + (+width_2_4) + (+width_3_4) + (+width_4_4) + (+width_5_4)) / 5;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));
				}
			} else {
				alert('Please Select Tiles Grade');
			}

		})

		$('#thick_1_1, #thick_1_2, #thick_1_3, #thick_1_4, #thick_2_1, #thick_2_2, #thick_2_3, #thick_2_4, #thick_3_1, #thick_3_2, #thick_3_3, #thick_3_4, #thick_4_1, #thick_4_2, #thick_4_3, #thick_4_4, #thick_5_1, #thick_5_2, #thick_5_3, #thick_5_4, #thick_6_1, #thick_6_2, #thick_6_3, #thick_6_4, #thick_7_1, #thick_7_2, #thick_7_3, #thick_7_4, #thick_8_1, #thick_8_2, #thick_8_3, #thick_8_4, #thick_9_1, #thick_9_2, #thick_9_3, #thick_9_4, #thick_10_1, #thick_10_2, #thick_10_3, #thick_10_4').change(function() {
			var tiles_type = $('#tiles_type').val();
			var tiles_grade = $('#tiles_grade').val();

			if (tiles_type == "modular") {
				if ((tiles_grade == "M10 x 10") || (tiles_grade == "M15 x 15") || (tiles_grade == "M15 x 10") || (tiles_grade == "M20 x 10") || (tiles_grade == "M20 x 15") || (tiles_grade == "M20 x 20") || (tiles_grade == "M20 x 30") || (tiles_grade == "M20 x 40") || (tiles_grade == "M25 x 25") || (tiles_grade == "M30 x 15") || (tiles_grade == "M30 x 30")) {
					var thick_1_1 = $('#thick_1_1').val();
					var thick_1_2 = $('#thick_1_2').val();
					var thick_1_3 = $('#thick_1_3').val();
					var thick_1_4 = $('#thick_1_4').val();

					var thick_2_1 = $('#thick_2_1').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_2_4 = $('#thick_2_4').val();

					var thick_3_1 = $('#thick_3_1').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_3_4 = $('#thick_3_4').val();

					var thick_4_1 = $('#thick_4_1').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_4_4 = $('#thick_4_4').val();

					var thick_5_1 = $('#thick_5_1').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_5_4 = $('#thick_5_4').val();

					var thick_6_1 = $('#thick_6_1').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_6_4 = $('#thick_6_4').val();

					var thick_7_1 = $('#thick_7_1').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_7_4 = $('#thick_7_4').val();

					var thick_8_1 = $('#thick_8_1').val();
					var thick_8_2 = $('#thick_8_2').val();
					var thick_8_3 = $('#thick_8_3').val();
					var thick_8_4 = $('#thick_8_4').val();

					var thick_9_1 = $('#thick_9_1').val();
					var thick_9_2 = $('#thick_9_2').val();
					var thick_9_3 = $('#thick_9_3').val();
					var thick_9_4 = $('#thick_9_4').val();

					var thick_10_1 = $('#thick_10_1').val();
					var thick_10_2 = $('#thick_10_2').val();
					var thick_10_3 = $('#thick_10_3').val();
					var thick_10_4 = $('#thick_10_4').val();

					var avg_1_5 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1) + (+thick_6_1) + (+thick_7_1) + (+thick_8_1) + (+thick_9_1) + (+thick_10_1)) / 10;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2) + (+thick_6_2) + (+thick_7_2) + (+thick_8_2) + (+thick_9_2) + (+thick_10_2)) / 10;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3) + (+thick_6_3) + (+thick_7_3) + (+thick_8_3) + (+thick_9_3) + (+thick_10_3)) / 10;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4) + (+thick_6_4) + (+thick_7_4) + (+thick_8_4) + (+thick_9_4) + (+thick_10_4)) / 10;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));
				} else if ((tiles_grade == "M30 x 45") || (tiles_grade == "M30 x 60") || (tiles_grade == "M30 x 75") || (tiles_grade == "M30 x 30") || (tiles_grade == "M40 x 30") || (tiles_grade == "M40 x 40") || (tiles_grade == "M45 x 45") || (tiles_grade == "M40 x 80") || (tiles_grade == "M45 x 90") || (tiles_grade == "M50 x 50") || (tiles_grade == "M60 x 60")) {
					var thick_1_1 = $('#thick_1_1').val();
					var thick_1_2 = $('#thick_1_2').val();
					var thick_1_3 = $('#thick_1_3').val();
					var thick_1_4 = $('#thick_1_4').val();

					var thick_2_1 = $('#thick_2_1').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_2_4 = $('#thick_2_4').val();

					var thick_3_1 = $('#thick_3_1').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_3_4 = $('#thick_3_4').val();

					var thick_4_1 = $('#thick_4_1').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_4_4 = $('#thick_4_4').val();

					var thick_5_1 = $('#thick_5_1').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_5_4 = $('#thick_5_4').val();

					var thick_6_1 = $('#thick_6_1').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_6_4 = $('#thick_6_4').val();

					var thick_7_1 = $('#thick_7_1').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_7_4 = $('#thick_7_4').val();

					var avg_1_5 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1) + (+thick_6_1) + (+thick_7_1)) / 7;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2) + (+thick_6_2) + (+thick_7_2)) / 7;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3) + (+thick_6_3) + (+thick_7_3)) / 7;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4) + (+thick_6_4) + (+thick_7_4)) / 7;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));

				} else if ((tiles_grade == "M60 x 90") || (tiles_grade == "M80 x 80") || (tiles_grade == "M90 x 90") || (tiles_grade == "M60 x 120") || (tiles_grade == "M100 x 100") || (tiles_grade == "M90 x 120") || (tiles_grade == "M120 x 120")) {
					var thick_1_1 = $('#thick_1_1').val();
					var thick_1_2 = $('#thick_1_2').val();
					var thick_1_3 = $('#thick_1_3').val();
					var thick_1_4 = $('#thick_1_4').val();

					var thick_2_1 = $('#thick_2_1').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_2_4 = $('#thick_2_4').val();

					var thick_3_1 = $('#thick_3_1').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_3_4 = $('#thick_3_4').val();

					var thick_4_1 = $('#thick_4_1').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_4_4 = $('#thick_4_4').val();

					var thick_5_1 = $('#thick_5_1').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_5_4 = $('#thick_5_4').val();

					var avg_1_5 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1)) / 5;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2)) / 5;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3)) / 5;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4)) / 5;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));
				}
			} else if (tiles_type == "non-modular") {
				if ((tiles_grade == "10.8 x 10.8") || (tiles_grade == "15 x 7.5") || (tiles_grade == "15.2 x 7.6") || (tiles_grade == "15.2 x 15.2") || (tiles_grade == "21.6 x 10.8") || (tiles_grade == "25 x 33")) {
					var thick_1_1 = $('#thick_1_1').val();
					var thick_1_2 = $('#thick_1_2').val();
					var thick_1_3 = $('#thick_1_3').val();
					var thick_1_4 = $('#thick_1_4').val();

					var thick_2_1 = $('#thick_2_1').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_2_4 = $('#thick_2_4').val();

					var thick_3_1 = $('#thick_3_1').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_3_4 = $('#thick_3_4').val();

					var thick_4_1 = $('#thick_4_1').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_4_4 = $('#thick_4_4').val();

					var thick_5_1 = $('#thick_5_1').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_5_4 = $('#thick_5_4').val();

					var thick_6_1 = $('#thick_6_1').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_6_4 = $('#thick_6_4').val();

					var thick_7_1 = $('#thick_7_1').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_7_4 = $('#thick_7_4').val();

					var thick_8_1 = $('#thick_8_1').val();
					var thick_8_2 = $('#thick_8_2').val();
					var thick_8_3 = $('#thick_8_3').val();
					var thick_8_4 = $('#thick_8_4').val();

					var thick_9_1 = $('#thick_9_1').val();
					var thick_9_2 = $('#thick_9_2').val();
					var thick_9_3 = $('#thick_9_3').val();
					var thick_9_4 = $('#thick_9_4').val();

					var thick_10_1 = $('#thick_10_1').val();
					var thick_10_2 = $('#thick_10_2').val();
					var thick_10_3 = $('#thick_10_3').val();
					var thick_10_4 = $('#thick_10_4').val();

					var avg_1_5 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1) + (+thick_6_1) + (+thick_7_1) + (+thick_8_1) + (+thick_9_1) + (+thick_10_1)) / 10;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2) + (+thick_6_2) + (+thick_7_2) + (+thick_8_2) + (+thick_9_2) + (+thick_10_2)) / 10;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3) + (+thick_6_3) + (+thick_7_3) + (+thick_8_3) + (+thick_9_3) + (+thick_10_3)) / 10;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4) + (+thick_6_4) + (+thick_7_4) + (+thick_8_4) + (+thick_9_4) + (+thick_10_4)) / 10;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));
				} else if ((tiles_grade == "25 x 38") || (tiles_grade == "31.5 x 42") || (tiles_grade == "32 x 32") || (tiles_grade == "32 x 40") || (tiles_grade == "32 x 48") || (tiles_grade == "32 x 60") || (tiles_grade == "33 x 33") || (tiles_grade == "33 x 48") || (tiles_grade == "33 x 60") || (tiles_grade == "33 x 90") || (tiles_grade == "30.6 x 30.6") || (tiles_grade == "31.5 x 31.5") || (tiles_grade == "40.6 x 40.6")) {
					var thick_1_1 = $('#thick_1_1').val();
					var thick_1_2 = $('#thick_1_2').val();
					var thick_1_3 = $('#thick_1_3').val();
					var thick_1_4 = $('#thick_1_4').val();

					var thick_2_1 = $('#thick_2_1').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_2_4 = $('#thick_2_4').val();

					var thick_3_1 = $('#thick_3_1').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_3_4 = $('#thick_3_4').val();

					var thick_4_1 = $('#thick_4_1').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_4_4 = $('#thick_4_4').val();

					var thick_5_1 = $('#thick_5_1').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_5_4 = $('#thick_5_4').val();

					var thick_6_1 = $('#thick_6_1').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_6_4 = $('#thick_6_4').val();

					var thick_7_1 = $('#thick_7_1').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_7_4 = $('#thick_7_4').val();

					var avg_1_5 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1) + (+thick_6_1) + (+thick_7_1)) / 7;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2) + (+thick_6_2) + (+thick_7_2)) / 7;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3) + (+thick_6_3) + (+thick_7_3)) / 7;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4) + (+thick_6_4) + (+thick_7_4)) / 7;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));



				} else if ((tiles_grade == "60.5 x 60.5") || (tiles_grade == "81.5 x 81.5")) {
					var thick_1_1 = $('#thick_1_1').val();
					var thick_1_2 = $('#thick_1_2').val();
					var thick_1_3 = $('#thick_1_3').val();
					var thick_1_4 = $('#thick_1_4').val();

					var thick_2_1 = $('#thick_2_1').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_2_4 = $('#thick_2_4').val();

					var thick_3_1 = $('#thick_3_1').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_3_4 = $('#thick_3_4').val();

					var thick_4_1 = $('#thick_4_1').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_4_4 = $('#thick_4_4').val();

					var thick_5_1 = $('#thick_5_1').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_5_4 = $('#thick_5_4').val();

					var avg_1_5 = ((+thick_1_1) + (+thick_2_1) + (+thick_3_1) + (+thick_4_1) + (+thick_5_1)) / 5;
					$('#avg_1_5').val((+avg_1_5).toFixed(2));

					var avg_1_6 = ((+thick_1_2) + (+thick_2_2) + (+thick_3_2) + (+thick_4_2) + (+thick_5_2)) / 5;
					$('#avg_1_6').val((+avg_1_6).toFixed(2));

					var avg_1_7 = ((+thick_1_3) + (+thick_2_3) + (+thick_3_3) + (+thick_4_3) + (+thick_5_3)) / 5;
					$('#avg_1_7').val((+avg_1_7).toFixed(2));

					var avg_1_8 = ((+thick_1_4) + (+thick_2_4) + (+thick_3_4) + (+thick_4_4) + (+thick_5_4)) / 5;
					$('#avg_1_8').val((+avg_1_8).toFixed(2));

					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();

					var avg_2 = ((+avg_1_5) + (+avg_1_6) + (+avg_1_7) + (+avg_1_8)) / 4;
					$('#avg_2').val((+avg_2).toFixed(2));
				}
			} else {
				alert('Please Select Tiles Grade');
			}
		})



		function den_auto() {
			$('#txtden').css("background-color", "var(--success)");
			$('#dl1').val(1);
			$('#dl2').val(1);
			$('#dl3').val(1);
			$('#dl4').val(1);
			$('#dl5').val(1);
			$('#dl6').val(1);
			$('#dw1').val(1);
			$('#dw2').val(1);
			$('#dw3').val(1);
			$('#dw4').val(1);
			$('#dw5').val(1);
			$('#dw6').val(1);
			$('#dt1').val(1);
			$('#dt2').val(1);
			$('#dt3').val(1);
			$('#dt4').val(1);
			$('#dt5').val(1);
			$('#dt6').val(1);
			$('#vol1').val(1);
			$('#vol2').val(1);
			$('#vol3').val(1);
			$('#vol4').val(1);
			$('#vol5').val(1);
			$('#vol6').val(1);
			$('#dweight1').val(1);
			$('#dweight2').val(1);
			$('#dweight3').val(1);
			$('#dweight4').val(1);
			$('#dweight5').val(1);
			$('#dweight6').val(1);
			$('#den1').val(1);
			$('#den2').val(1);
			$('#den3').val(1);
			$('#den4').val(1);
			$('#den5').val(1);
			$('#den6').val(1);
			$('#avg_den').val(1);


		}
		$('#chk_den').change(function() {
			if (this.checked) {
				den_auto();


			} else {
				$('#txtden').css("background-color", "white");
				$('#dl1').val(null);
				$('#dl2').val(null);
				$('#dl3').val(null);
				$('#dl4').val(null);
				$('#dl5').val(null);
				$('#dl6').val(null);
				$('#dw1').val(null);
				$('#dw2').val(null);
				$('#dw3').val(null);
				$('#dw4').val(null);
				$('#dw5').val(null);
				$('#dw6').val(null);
				$('#dt1').val(null);
				$('#dt2').val(null);
				$('#dt3').val(null);
				$('#dt4').val(null);
				$('#dt5').val(null);
				$('#dt6').val(null);
				$('#vol1').val(null);
				$('#vol2').val(null);
				$('#vol3').val(null);
				$('#vol4').val(null);
				$('#vol5').val(null);
				$('#vol6').val(null);
				$('#dweight1').val(null);
				$('#dweight2').val(null);
				$('#dweight3').val(null);
				$('#dweight4').val(null);
				$('#dweight5').val(null);
				$('#dweight6').val(null);
				$('#den1').val(null);
				$('#den2').val(null);
				$('#den3').val(null);
				$('#den4').val(null);
				$('#den5').val(null);
				$('#den6').val(null);
				$('#avg_den').val(null);

			}
		});
		//chk_auto
		$('#chk_auto').change(function() {
			if (this.checked) {
				//$('#txtabr').css("background-color","var(--success)");
				//$('#txtwtr').css("background-color","var(--success)");


				var temp = $('#test_list').val();
				var aa = temp.split(",");

				//BREAKING STRENGTH
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "MOR") {
						$('#txtstr').css("background-color", "var(--success)");
						$("#chk_str").prop("checked", true);
						str_auto();
						break;
					}
				}

				//WATER ABSORPTION
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "WAT") {
						$('#txtwtr').css("background-color", "var(--success)");
						$("#chk_wtr").prop("checked", true);
						wtr_auto();
						break;
					}
				}

				//SCRATCH HARDNESS OF SURFACE
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "shs") {
						$('#txtscr').css("background-color", "var(--success)");
						$("#chk_scr").prop("checked", true);
						scr_auto();
						break;
					}
				}

				//DIMENTION AND SURFACE QUALITY
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "dim") {
						$('#txtdim').css("background-color", "var(--success)");
						$("#chk_dim").prop("checked", true);
						dim_auto();
						break;
					}
				}

				//DENSITY
				for (var i = 0; i < aa.length; i++) {

					if (aa[i] == "DEN") {
						$('#txtden').css("background-color", "var(--success)");
						$("#chk_den").prop("checked", true);
						den_auto();
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
			url: '<?php echo $base_url; ?>save_ceramic_tiles.php',
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
			var tiles_brand = $('#tiles_brand').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//DIMENTIONS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "dim") {
					if (document.getElementById('chk_dim').checked) {
						var chk_dim = "1";
					} else {
						var chk_dim = "0";
					}
					var length_1_1 = $('#length_1_1').val();
					var length_1_2 = $('#length_1_2').val();
					var length_1_3 = $('#length_1_3').val();
					var length_1_4 = $('#length_1_4').val();
					var length_2_1 = $('#length_2_1').val();
					var length_2_2 = $('#length_2_2').val();
					var length_2_3 = $('#length_2_3').val();
					var length_2_4 = $('#length_2_4').val();
					var length_3_1 = $('#length_3_1').val();
					var length_3_2 = $('#length_3_2').val();
					var length_3_3 = $('#length_3_3').val();
					var length_3_4 = $('#length_3_4').val();
					var length_4_1 = $('#length_4_1').val();
					var length_4_2 = $('#length_4_2').val();
					var length_4_3 = $('#length_4_3').val();
					var length_4_4 = $('#length_4_4').val();
					var length_5_1 = $('#length_5_1').val();
					var length_5_2 = $('#length_5_2').val();
					var length_5_3 = $('#length_5_3').val();
					var length_5_4 = $('#length_5_4').val();
					var length_6_1 = $('#length_6_1').val();
					var length_6_2 = $('#length_6_2').val();
					var length_6_3 = $('#length_6_3').val();
					var length_6_4 = $('#length_6_4').val();
					var length_7_1 = $('#length_7_1').val();
					var length_7_2 = $('#length_7_2').val();
					var length_7_3 = $('#length_7_3').val();
					var length_7_4 = $('#length_7_4').val();
					var length_8_1 = $('#length_8_1').val();
					var length_8_2 = $('#length_8_2').val();
					var length_8_3 = $('#length_8_3').val();
					var length_8_4 = $('#length_8_4').val();
					var length_9_1 = $('#length_9_1').val();
					var length_9_2 = $('#length_9_2').val();
					var length_9_3 = $('#length_9_3').val();
					var length_9_4 = $('#length_9_4').val();
					var length_10_1 = $('#length_10_1').val();
					var length_10_2 = $('#length_10_2').val();
					var length_10_3 = $('#length_10_3').val();
					var length_10_4 = $('#length_10_4').val();
					var width_1_1 = $('#width_1_1').val();
					var width_1_2 = $('#width_1_2').val();
					var width_1_3 = $('#width_1_3').val();
					var width_1_4 = $('#width_1_4').val();
					var width_2_1 = $('#width_2_1').val();
					var width_2_2 = $('#width_2_2').val();
					var width_2_3 = $('#width_2_3').val();
					var width_2_4 = $('#width_2_4').val();
					var width_3_1 = $('#width_3_1').val();
					var width_3_2 = $('#width_3_2').val();
					var width_3_3 = $('#width_3_3').val();
					var width_3_4 = $('#width_3_4').val();
					var width_4_1 = $('#width_4_1').val();
					var width_4_2 = $('#width_4_2').val();
					var width_4_3 = $('#width_4_3').val();
					var width_4_4 = $('#width_4_4').val();
					var width_5_1 = $('#width_5_1').val();
					var width_5_2 = $('#width_5_2').val();
					var width_5_3 = $('#width_5_3').val();
					var width_5_4 = $('#width_5_4').val();
					var width_6_1 = $('#width_6_1').val();
					var width_6_2 = $('#width_6_2').val();
					var width_6_3 = $('#width_6_3').val();
					var width_6_4 = $('#width_6_4').val();
					var width_7_1 = $('#width_7_1').val();
					var width_7_2 = $('#width_7_2').val();
					var width_7_3 = $('#width_7_3').val();
					var width_7_4 = $('#width_7_4').val();
					var width_8_1 = $('#width_8_1').val();
					var width_8_2 = $('#width_8_2').val();
					var width_8_3 = $('#width_8_3').val();
					var width_8_4 = $('#width_8_4').val();
					var width_9_1 = $('#width_9_1').val();
					var width_9_2 = $('#width_9_2').val();
					var width_9_3 = $('#width_9_3').val();
					var width_9_4 = $('#width_9_4').val();
					var width_10_1 = $('#width_10_1').val();
					var width_10_2 = $('#width_10_2').val();
					var width_10_3 = $('#width_10_3').val();
					var width_10_4 = $('#width_10_4').val();
					var thick_1_1 = $('#thick_1_1').val();
					var thick_1_2 = $('#thick_1_2').val();
					var thick_1_3 = $('#thick_1_3').val();
					var thick_1_4 = $('#thick_1_4').val();
					var thick_2_1 = $('#thick_2_1').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_2_4 = $('#thick_2_4').val();
					var thick_3_1 = $('#thick_3_1').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_3_4 = $('#thick_3_4').val();
					var thick_4_1 = $('#thick_4_1').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_4_4 = $('#thick_4_4').val();
					var thick_5_1 = $('#thick_5_1').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_5_4 = $('#thick_5_4').val();
					var thick_6_1 = $('#thick_6_1').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_6_4 = $('#thick_6_4').val();
					var thick_7_1 = $('#thick_7_1').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_7_4 = $('#thick_7_4').val();
					var thick_8_1 = $('#thick_8_1').val();
					var thick_8_2 = $('#thick_8_2').val();
					var thick_8_3 = $('#thick_8_3').val();
					var thick_8_4 = $('#thick_8_4').val();
					var thick_9_1 = $('#thick_9_1').val();
					var thick_9_2 = $('#thick_9_2').val();
					var thick_9_3 = $('#thick_9_3').val();
					var thick_9_4 = $('#thick_9_4').val();
					var thick_10_1 = $('#thick_10_1').val();
					var thick_10_2 = $('#thick_10_2').val();
					var thick_10_3 = $('#thick_10_3').val();
					var thick_10_4 = $('#thick_10_4').val();
					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();
					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();
					var avg_1_9 = $('#avg_1_9').val();
					var avg_1_10 = $('#avg_1_10').val();
					var avg_1_11 = $('#avg_1_11').val();
					var avg_1_12 = $('#avg_1_12').val();
					var avg_1 = $('#avg_1').val();
					var avg_2 = $('#avg_2').val();
					var avg_3 = $('#avg_3').val();
					break;
				} else {
					var chk_dim = "0";
					var length_1_1 = "0";
					var length_1_2 = "0";
					var length_1_3 = "0";
					var length_1_4 = "0";
					var length_2_1 = "0";
					var length_2_2 = "0";
					var length_2_3 = "0";
					var length_2_4 = "0";
					var length_3_1 = "0";
					var length_3_2 = "0";
					var length_3_3 = "0";
					var length_3_4 = "0";
					var length_4_1 = "0";
					var length_4_2 = "0";
					var length_4_3 = "0";
					var length_4_4 = "0";
					var length_5_1 = "0";
					var length_5_2 = "0";
					var length_5_3 = "0";
					var length_5_4 = "0";
					var length_6_1 = "0";
					var length_6_2 = "0";
					var length_6_3 = "0";
					var length_6_4 = "0";
					var length_7_1 = "0";
					var length_7_2 = "0";
					var length_7_3 = "0";
					var length_7_4 = "0";
					var length_8_1 = "0";
					var length_8_2 = "0";
					var length_8_3 = "0";
					var length_8_4 = "0";
					var length_9_1 = "0";
					var length_9_2 = "0";
					var length_9_3 = "0";
					var length_9_4 = "0";
					var length_10_1 = "0";
					var length_10_2 = "0";
					var length_10_3 = "0";
					var length_10_4 = "0";
					var width_1_1 = "0";
					var width_1_2 = "0";
					var width_1_3 = "0";
					var width_1_4 = "0";
					var width_2_1 = "0";
					var width_2_2 = "0";
					var width_2_3 = "0";
					var width_2_4 = "0";
					var width_3_1 = "0";
					var width_3_2 = "0";
					var width_3_3 = "0";
					var width_3_4 = "0";
					var width_4_1 = "0";
					var width_4_2 = "0";
					var width_4_3 = "0";
					var width_4_4 = "0";
					var width_5_1 = "0";
					var width_5_2 = "0";
					var width_5_3 = "0";
					var width_5_4 = "0";
					var width_6_1 = "0";
					var width_6_2 = "0";
					var width_6_3 = "0";
					var width_6_4 = "0";
					var width_7_1 = "0";
					var width_7_2 = "0";
					var width_7_3 = "0";
					var width_7_4 = "0";
					var width_8_1 = "0";
					var width_8_2 = "0";
					var width_8_3 = "0";
					var width_8_4 = "0";
					var width_9_1 = "0";
					var width_9_2 = "0";
					var width_9_3 = "0";
					var width_9_4 = "0";
					var width_10_1 = "0";
					var width_10_2 = "0";
					var width_10_3 = "0";
					var width_10_4 = "0";
					var thick_1_1 = "0";
					var thick_1_2 = "0";
					var thick_1_3 = "0";
					var thick_1_4 = "0";
					var thick_2_1 = "0";
					var thick_2_2 = "0";
					var thick_2_3 = "0";
					var thick_2_4 = "0";
					var thick_3_1 = "0";
					var thick_3_2 = "0";
					var thick_3_3 = "0";
					var thick_3_4 = "0";
					var thick_4_1 = "0";
					var thick_4_2 = "0";
					var thick_4_3 = "0";
					var thick_4_4 = "0";
					var thick_5_1 = "0";
					var thick_5_2 = "0";
					var thick_5_3 = "0";
					var thick_5_4 = "0";
					var thick_6_1 = "0";
					var thick_6_2 = "0";
					var thick_6_3 = "0";
					var thick_6_4 = "0";
					var thick_7_1 = "0";
					var thick_7_2 = "0";
					var thick_7_3 = "0";
					var thick_7_4 = "0";
					var thick_8_1 = "0";
					var thick_8_2 = "0";
					var thick_8_3 = "0";
					var thick_8_4 = "0";
					var thick_9_1 = "0";
					var thick_9_2 = "0";
					var thick_9_3 = "0";
					var thick_9_4 = "0";
					var thick_10_1 = "0";
					var thick_10_2 = "0";
					var thick_10_3 = "0";
					var thick_10_4 = "0";
					var avg_1_1 = "0";
					var avg_1_2 = "0";
					var avg_1_3 = "0";
					var avg_1_4 = "0";
					var avg_1_5 = "0";
					var avg_1_6 = "0";
					var avg_1_7 = "0";
					var avg_1_8 = "0";
					var avg_1_9 = "0";
					var avg_1_10 = "0";
					var avg_1_11 = "0";
					var avg_1_12 = "0";
					var avg_1 = "0";
					var avg_2 = "0";
					var avg_3 = "0";
				}
			}

			//WATER ABSORPTION
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WAT") {
					if (document.getElementById('chk_wtr').checked) {
						var chk_wtr = "1";
					} else {
						var chk_wtr = "0";
					}
					var a1 = $('#a1').val();
					var a2 = $('#a2').val();
					var a3 = $('#a3').val();
					var a4 = $('#a4').val();
					var a5 = $('#a5').val();
					var a6 = $('#a6').val();
					var a7 = $('#a7').val();
					var a8 = $('#a8').val();
					var a9 = $('#a9').val();
					var a10 = $('#a10').val();
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
					var wtr1 = $('#wtr1').val();
					var wtr2 = $('#wtr2').val();
					var wtr3 = $('#wtr3').val();
					var wtr4 = $('#wtr4').val();
					var wtr5 = $('#wtr5').val();
					var wtr6 = $('#wtr6').val();
					var wtr7 = $('#wtr7').val();
					var wtr8 = $('#wtr8').val();
					var wtr9 = $('#wtr9').val();
					var wtr10 = $('#wtr10').val();
					var avg_wtr = $('#avg_wtr').val();
					break;
				} else {
					var chk_wtr = "0";
					var a1 = "0";
					var a2 = "0";
					var a3 = "0";
					var a4 = "0";
					var a5 = "0";
					var a6 = "0";
					var a7 = "0";
					var a8 = "0";
					var a9 = "0";
					var a10 = "0";
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
					var wtr1 = "0";
					var wtr2 = "0";
					var wtr3 = "0";
					var wtr4 = "0";
					var wtr5 = "0";
					var wtr6 = "0";
					var wtr7 = "0";
					var wtr8 = "0";
					var wtr9 = "0";
					var wtr10 = "0";
					var avg_wtr = "0";

				}
			}


			//BREAKING STRENGTH
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "MOR") {
					if (document.getElementById('chk_str').checked) {
						var chk_str = "1";
					} else {
						var chk_str = "0";
					}
					var dima1 = $('#dima1').val();
					var dima2 = $('#dima2').val();
					var dima3 = $('#dima3').val();
					var dima4 = $('#dima4').val();
					var dima5 = $('#dima5').val();
					var dima6 = $('#dima6').val();
					var dima7 = $('#dima7').val();
					var dimb1 = $('#dimb1').val();
					var dimb2 = $('#dimb2').val();
					var dimb3 = $('#dimb3').val();
					var dimb4 = $('#dimb4').val();
					var dimb5 = $('#dimb5').val();
					var dimb6 = $('#dimb6').val();
					var dimb7 = $('#dimb7').val();
					var dimh1 = $('#dimh1').val();
					var dimh2 = $('#dimh2').val();
					var dimh3 = $('#dimh3').val();
					var dimh4 = $('#dimh4').val();
					var dimh5 = $('#dimh5').val();
					var dimh6 = $('#dimh6').val();
					var dimh7 = $('#dimh7').val();
					var l1 = $('#l1').val();
					var l2 = $('#l2').val();
					var l3 = $('#l3').val();
					var l4 = $('#l4').val();
					var l5 = $('#l5').val();
					var l6 = $('#l6').val();
					var l7 = $('#l7').val();
					var wa1 = $('#wa1').val();
					var wa2 = $('#wa2').val();
					var wa3 = $('#wa3').val();
					var wa4 = $('#wa4').val();
					var wa5 = $('#wa5').val();
					var wa6 = $('#wa6').val();
					var wa7 = $('#wa7').val();
					var load1 = $('#load1').val();
					var load2 = $('#load2').val();
					var load3 = $('#load3').val();
					var load4 = $('#load4').val();
					var load5 = $('#load5').val();
					var load6 = $('#load6').val();
					var load7 = $('#load7').val();
					var str1 = $('#str1').val();
					var str2 = $('#str2').val();
					var str3 = $('#str3').val();
					var str4 = $('#str4').val();
					var str5 = $('#str5').val();
					var str6 = $('#str6').val();
					var str7 = $('#str7').val();
					var rstr1 = $('#rstr1').val();
					var rstr2 = $('#rstr2').val();
					var rstr3 = $('#rstr3').val();
					var rstr4 = $('#rstr4').val();
					var rstr5 = $('#rstr5').val();
					var rstr6 = $('#rstr6').val();
					var rstr7 = $('#rstr7').val();
					var avg_str = $('#avg_str').val();
					var avg_rstr = $('#avg_rstr').val();
					break;
				} else {
					var chk_str = "0";
					var dima1 = "0";
					var dima2 = "0";
					var dima3 = "0";
					var dima4 = "0";
					var dima5 = "0";
					var dima6 = "0";
					var dima7 = "0";
					var dimb1 = "0";
					var dimb2 = "0";
					var dimb3 = "0";
					var dimb4 = "0";
					var dimb5 = "0";
					var dimb6 = "0";
					var dimb7 = "0";
					var dimh1 = "0";
					var dimh2 = "0";
					var dimh3 = "0";
					var dimh4 = "0";
					var dimh5 = "0";
					var dimh6 = "0";
					var dimh7 = "0";
					var l1 = "0";
					var l2 = "0";
					var l3 = "0";
					var l4 = "0";
					var l5 = "0";
					var l6 = "0";
					var l7 = "0";
					var wa1 = "0";
					var wa2 = "0";
					var wa3 = "0";
					var wa4 = "0";
					var wa5 = "0";
					var wa6 = "0";
					var wa7 = "0";
					var load1 = "0";
					var load2 = "0";
					var load3 = "0";
					var load4 = "0";
					var load5 = "0";
					var load6 = "0";
					var load7 = "0";
					var str1 = "0";
					var str2 = "0";
					var str3 = "0";
					var str4 = "0";
					var str5 = "0";
					var str6 = "0";
					var str7 = "0";
					var rstr1 = "0";
					var rstr2 = "0";
					var rstr3 = "0";
					var rstr4 = "0";
					var rstr5 = "0";
					var rstr6 = "0";
					var rstr7 = "0";
					var avg_str = "0";
					var avg_rstr = "0";


				}
			}

			//SCRATCH HARDNESS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "shs") {
					if (document.getElementById('chk_scr').checked) {
						var chk_scr = "1";
					} else {
						var chk_scr = "0";
					}
					var s1 = $('#s1').val();
					var s2 = $('#s2').val();
					var s3 = $('#s3').val();
					var avg_s = $('#avg_s').val();

					break;
				} else {
					var chk_scr = "0";
					var s1 = "0";
					var s2 = "0";
					var s3 = "0";
					var avg_s = "0";



				}
			}


			//DENSITY
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "DEN") {
					if (document.getElementById('chk_den').checked) {
						var chk_den = "1";
					} else {
						var chk_den = "0";
					}

					var dl1 = $('#dl1').val();
					var dl2 = $('#dl2').val();
					var dl3 = $('#dl3').val();
					var dl4 = $('#dl4').val();
					var dl5 = $('#dl5').val();
					var dl6 = $('#dl6').val();
					var dw1 = $('#dw1').val();
					var dw2 = $('#dw2').val();
					var dw3 = $('#dw3').val();
					var dw4 = $('#dw4').val();
					var dw5 = $('#dw5').val();
					var dw6 = $('#dw6').val();
					var dt1 = $('#dt1').val();
					var dt2 = $('#dt2').val();
					var dt3 = $('#dt3').val();
					var dt4 = $('#dt4').val();
					var dt5 = $('#dt5').val();
					var dt6 = $('#dt6').val();
					var vol1 = $('#vol1').val();
					var vol2 = $('#vol2').val();
					var vol3 = $('#vol3').val();
					var vol4 = $('#vol4').val();
					var vol5 = $('#vol5').val();
					var vol6 = $('#vol6').val();
					var dweight1 = $('#dweight1').val();
					var dweight2 = $('#dweight2').val();
					var dweight3 = $('#dweight3').val();
					var dweight4 = $('#dweight4').val();
					var dweight5 = $('#dweight5').val();
					var dweight6 = $('#dweight6').val();
					var den1 = $('#den1').val();
					var den2 = $('#den2').val();
					var den3 = $('#den3').val();
					var den4 = $('#den4').val();
					var den5 = $('#den5').val();
					var den6 = $('#den6').val();
					var avg_den = $('#avg_den').val();

					break;
				} else {
					var chk_den = "0";
					var dl1 = "0";
					var dl2 = "0";
					var dl3 = "0";
					var dl4 = "0";
					var dl5 = "0";
					var dl6 = "0";
					var dw1 = "0";
					var dw2 = "0";
					var dw3 = "0";
					var dw4 = "0";
					var dw5 = "0";
					var dw6 = "0";
					var dt1 = "0";
					var dt2 = "0";
					var dt3 = "0";
					var dt4 = "0";
					var dt5 = "0";
					var dt6 = "0";
					var vol1 = "0";
					var vol2 = "0";
					var vol3 = "0";
					var vol4 = "0";
					var vol5 = "0";
					var vol6 = "0";
					var dweight1 = "0";
					var dweight2 = "0";
					var dweight3 = "0";
					var dweight4 = "0";
					var dweight5 = "0";
					var dweight6 = "0";
					var den1 = "0";
					var den2 = "0";
					var den3 = "0";
					var den4 = "0";
					var den5 = "0";
					var den6 = "0";
					var avg_den = "0";
				}
			}



			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&tiles_brand=' + tiles_brand + '&chk_str=' + chk_str + '&dima1=' + dima1 + '&dima2=' + dima2 + '&dima3=' + dima3 + '&dima4=' + dima4 + '&dima5=' + dima5 + '&dima6=' + dima6 + '&dima7=' + dima7 + '&dimb1=' + dimb1 + '&dimb2=' + dimb2 + '&dimb3=' + dimb3 + '&dimb4=' + dimb4 + '&dimb5=' + dimb5 + '&dimb6=' + dimb6 + '&dimb7=' + dimb7 + '&dimh1=' + dimh1 + '&dimh2=' + dimh2 + '&dimh3=' + dimh3 + '&dimh4=' + dimh4 + '&dimh5=' + dimh5 + '&dimh6=' + dimh6 + '&dimh7=' + dimh7 + '&l1=' + l1 + '&l2=' + l2 + '&l3=' + l3 + '&l4=' + l4 + '&l5=' + l5 + '&l6=' + l6 + '&l7=' + l7 + '&load1=' + load1 + '&load2=' + load2 + '&load3=' + load3 + '&load4=' + load4 + '&load5=' + load5 + '&load6=' + load6 + '&load7=' + load7 + '&wa1=' + wa1 + '&wa2=' + wa2 + '&wa3=' + wa3 + '&wa4=' + wa4 + '&wa5=' + wa5 + '&wa6=' + wa6 + '&wa7=' + wa7 + '&str1=' + str1 + '&str2=' + str2 + '&str3=' + str3 + '&str4=' + str4 + '&str5=' + str5 + '&str6=' + str6 + '&str7=' + str7 + '&rstr1=' + rstr1 + '&rstr2=' + rstr2 + '&rstr3=' + rstr3 + '&rstr4=' + rstr4 + '&rstr5=' + rstr5 + '&rstr6=' + rstr6 + '&rstr7=' + rstr7 + '&avg_str=' + avg_str + '&avg_rstr=' + avg_rstr + '&chk_scr=' + chk_scr + '&s1=' + s1 + '&s2=' + s2 + '&s3=' + s3 + '&avg_s=' + avg_s + '&chk_dim=' + chk_dim + '&length_1_1=' + length_1_1 + '&length_1_2=' + length_1_2 + '&length_1_3=' + length_1_3 + '&length_1_4=' + length_1_4 + '&length_2_1=' + length_2_1 + '&length_2_2=' + length_2_2 + '&length_2_3=' + length_2_3 + '&length_2_4=' + length_2_4 + '&length_3_1=' + length_3_1 + '&length_3_2=' + length_3_2 + '&length_3_3=' + length_3_3 + '&length_3_4=' + length_3_4 + '&length_4_1=' + length_4_1 + '&length_4_2=' + length_4_2 + '&length_4_3=' + length_4_3 + '&length_4_4=' + length_4_4 + '&length_5_1=' + length_5_1 + '&length_5_2=' + length_5_2 + '&length_5_3=' + length_5_3 + '&length_5_4=' + length_5_4 + '&length_6_1=' + length_6_1 + '&length_6_2=' + length_6_2 + '&length_6_3=' + length_6_3 + '&length_6_4=' + length_6_4 + '&length_7_1=' + length_7_1 + '&length_7_2=' + length_7_2 + '&length_7_3=' + length_7_3 + '&length_7_4=' + length_7_4 + '&length_8_1=' + length_8_1 + '&length_8_2=' + length_8_2 + '&length_8_3=' + length_8_3 + '&length_8_4=' + length_8_4 + '&length_9_1=' + length_9_1 + '&length_9_2=' + length_9_2 + '&length_9_3=' + length_9_3 + '&length_9_4=' + length_9_4 + '&length_10_1=' + length_10_1 + '&length_10_2=' + length_10_2 + '&length_10_3=' + length_10_3 + '&length_10_4=' + length_10_4 + '&width_1_1=' + width_1_1 + '&width_1_2=' + width_1_2 + '&width_1_3=' + width_1_3 + '&width_1_4=' + width_1_4 + '&width_2_1=' + width_2_1 + '&width_2_2=' + width_2_2 + '&width_2_3=' + width_2_3 + '&width_2_4=' + width_2_4 + '&width_3_1=' + width_3_1 + '&width_3_2=' + width_3_2 + '&width_3_3=' + width_3_3 + '&width_3_4=' + width_3_4 + '&width_4_1=' + width_4_1 + '&width_4_2=' + width_4_2 + '&width_4_3=' + width_4_3 + '&width_4_4=' + width_4_4 + '&width_5_1=' + width_5_1 + '&width_5_2=' + width_5_2 + '&width_5_3=' + width_5_3 + '&width_5_4=' + width_5_4 + '&width_6_1=' + width_6_1 + '&width_6_2=' + width_6_2 + '&width_6_3=' + width_6_3 + '&width_6_4=' + width_6_4 + '&width_7_1=' + width_7_1 + '&width_7_2=' + width_7_2 + '&width_7_3=' + width_7_3 + '&width_7_4=' + width_7_4 + '&width_8_1=' + width_8_1 + '&width_8_2=' + width_8_2 + '&width_8_3=' + width_8_3 + '&width_8_4=' + width_8_4 + '&width_9_1=' + width_9_1 + '&width_9_2=' + width_9_2 + '&width_9_3=' + width_9_3 + '&width_9_4=' + width_9_4 + '&width_10_1=' + width_10_1 + '&width_10_2=' + width_10_2 + '&width_10_3=' + width_10_3 + '&width_10_4=' + width_10_4 + '&thick_1_1=' + thick_1_1 + '&thick_1_2=' + thick_1_2 + '&thick_1_3=' + thick_1_3 + '&thick_1_4=' + thick_1_4 + '&thick_2_1=' + thick_2_1 + '&thick_2_2=' + thick_2_2 + '&thick_2_3=' + thick_2_3 + '&thick_2_4=' + thick_2_4 + '&thick_3_1=' + thick_3_1 + '&thick_3_2=' + thick_3_2 + '&thick_3_3=' + thick_3_3 + '&thick_3_4=' + thick_3_4 + '&thick_4_1=' + thick_4_1 + '&thick_4_2=' + thick_4_2 + '&thick_4_3=' + thick_4_3 + '&thick_4_4=' + thick_4_4 + '&thick_5_1=' + thick_5_1 + '&thick_5_2=' + thick_5_2 + '&thick_5_3=' + thick_5_3 + '&thick_5_4=' + thick_5_4 + '&thick_6_1=' + thick_6_1 + '&thick_6_2=' + thick_6_2 + '&thick_6_3=' + thick_6_3 + '&thick_6_4=' + thick_6_4 + '&thick_7_1=' + thick_7_1 + '&thick_7_2=' + thick_7_2 + '&thick_7_3=' + thick_7_3 + '&thick_7_4=' + thick_7_4 + '&thick_8_1=' + thick_8_1 + '&thick_8_2=' + thick_8_2 + '&thick_8_3=' + thick_8_3 + '&thick_8_4=' + thick_8_4 + '&thick_9_1=' + thick_9_1 + '&thick_9_2=' + thick_9_2 + '&thick_9_3=' + thick_9_3 + '&thick_9_4=' + thick_9_4 + '&thick_10_1=' + thick_10_1 + '&thick_10_2=' + thick_10_2 + '&thick_10_3=' + thick_10_3 + '&thick_10_4=' + thick_10_4 + '&avg_1_1=' + avg_1_1 + '&avg_1_2=' + avg_1_2 + '&avg_1_3=' + avg_1_3 + '&avg_1_4=' + avg_1_4 + '&avg_1_5=' + avg_1_5 + '&avg_1_6=' + avg_1_6 + '&avg_1_7=' + avg_1_7 + '&avg_1_8=' + avg_1_8 + '&avg_1_9=' + avg_1_9 + '&avg_1_10=' + avg_1_10 + '&avg_1_11=' + avg_1_11 + '&avg_1_12=' + avg_1_12 + '&avg_1=' + avg_1 + '&avg_2=' + avg_2 + '&avg_3=' + avg_3 + '&chk_wtr=' + chk_wtr + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&a4=' + a4 + '&a5=' + a5 + '&a6=' + a6 + '&a7=' + a7 + '&a8=' + a8 + '&a9=' + a9 + '&a10=' + a10 + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&b4=' + b4 + '&b5=' + b5 + '&b6=' + b6 + '&b7=' + b7 + '&b8=' + b8 + '&b9=' + b9 + '&b10=' + b10 + '&wtr1=' + wtr1 + '&wtr2=' + wtr2 + '&wtr3=' + wtr3 + '&wtr4=' + wtr4 + '&wtr5=' + wtr5 + '&wtr6=' + wtr6 + '&wtr7=' + wtr7 + '&wtr8=' + wtr8 + '&wtr9=' + wtr9 + '&wtr10=' + wtr10 + '&avg_wtr=' + avg_wtr + '&chk_den=' + chk_den + '&dl1=' + dl1 + '&dl2=' + dl2 + '&dl3=' + dl3 + '&dl4=' + dl4 + '&dl5=' + dl5 + '&dl6=' + dl6 + '&dw1=' + dw1 + '&dw2=' + dw2 + '&dw3=' + dw3 + '&dw4=' + dw4 + '&dw5=' + dw5 + '&dw6=' + dw6 + '&dt1=' + dt1 + '&dt2=' + dt2 + '&dt3=' + dt3 + '&dt4=' + dt4 + '&dt5=' + dt5 + '&dt6=' + dt6 + '&vol1=' + vol1 + '&vol2=' + vol2 + '&vol3=' + vol3 + '&vol4=' + vol4 + '&vol5=' + vol5 + '&vol6=' + vol6 + '&dweight1=' + dweight1 + '&dweight2=' + dweight2 + '&dweight3=' + dweight3 + '&dweight4=' + dweight4 + '&dweight5=' + dweight5 + '&dweight6=' + dweight6 + '&den1=' + den1 + '&den2=' + den2 + '&den3=' + den3 + '&den4=' + den4 + '&den5=' + den5 + '&den6=' + den6 + '&avg_den=' + avg_den+ '&amend_date=' + amend_date;

		} else if (type == 'edit') {

			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var tiles_brand = $('#tiles_brand').val();
			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//DIMENTIONS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "dim") {
					if (document.getElementById('chk_dim').checked) {
						var chk_dim = "1";
					} else {
						var chk_dim = "0";
					}
					var length_1_1 = $('#length_1_1').val();
					var length_1_2 = $('#length_1_2').val();
					var length_1_3 = $('#length_1_3').val();
					var length_1_4 = $('#length_1_4').val();
					var length_2_1 = $('#length_2_1').val();
					var length_2_2 = $('#length_2_2').val();
					var length_2_3 = $('#length_2_3').val();
					var length_2_4 = $('#length_2_4').val();
					var length_3_1 = $('#length_3_1').val();
					var length_3_2 = $('#length_3_2').val();
					var length_3_3 = $('#length_3_3').val();
					var length_3_4 = $('#length_3_4').val();
					var length_4_1 = $('#length_4_1').val();
					var length_4_2 = $('#length_4_2').val();
					var length_4_3 = $('#length_4_3').val();
					var length_4_4 = $('#length_4_4').val();
					var length_5_1 = $('#length_5_1').val();
					var length_5_2 = $('#length_5_2').val();
					var length_5_3 = $('#length_5_3').val();
					var length_5_4 = $('#length_5_4').val();
					var length_6_1 = $('#length_6_1').val();
					var length_6_2 = $('#length_6_2').val();
					var length_6_3 = $('#length_6_3').val();
					var length_6_4 = $('#length_6_4').val();
					var length_7_1 = $('#length_7_1').val();
					var length_7_2 = $('#length_7_2').val();
					var length_7_3 = $('#length_7_3').val();
					var length_7_4 = $('#length_7_4').val();
					var length_8_1 = $('#length_8_1').val();
					var length_8_2 = $('#length_8_2').val();
					var length_8_3 = $('#length_8_3').val();
					var length_8_4 = $('#length_8_4').val();
					var length_9_1 = $('#length_9_1').val();
					var length_9_2 = $('#length_9_2').val();
					var length_9_3 = $('#length_9_3').val();
					var length_9_4 = $('#length_9_4').val();
					var length_10_1 = $('#length_10_1').val();
					var length_10_2 = $('#length_10_2').val();
					var length_10_3 = $('#length_10_3').val();
					var length_10_4 = $('#length_10_4').val();
					var width_1_1 = $('#width_1_1').val();
					var width_1_2 = $('#width_1_2').val();
					var width_1_3 = $('#width_1_3').val();
					var width_1_4 = $('#width_1_4').val();
					var width_2_1 = $('#width_2_1').val();
					var width_2_2 = $('#width_2_2').val();
					var width_2_3 = $('#width_2_3').val();
					var width_2_4 = $('#width_2_4').val();
					var width_3_1 = $('#width_3_1').val();
					var width_3_2 = $('#width_3_2').val();
					var width_3_3 = $('#width_3_3').val();
					var width_3_4 = $('#width_3_4').val();
					var width_4_1 = $('#width_4_1').val();
					var width_4_2 = $('#width_4_2').val();
					var width_4_3 = $('#width_4_3').val();
					var width_4_4 = $('#width_4_4').val();
					var width_5_1 = $('#width_5_1').val();
					var width_5_2 = $('#width_5_2').val();
					var width_5_3 = $('#width_5_3').val();
					var width_5_4 = $('#width_5_4').val();
					var width_6_1 = $('#width_6_1').val();
					var width_6_2 = $('#width_6_2').val();
					var width_6_3 = $('#width_6_3').val();
					var width_6_4 = $('#width_6_4').val();
					var width_7_1 = $('#width_7_1').val();
					var width_7_2 = $('#width_7_2').val();
					var width_7_3 = $('#width_7_3').val();
					var width_7_4 = $('#width_7_4').val();
					var width_8_1 = $('#width_8_1').val();
					var width_8_2 = $('#width_8_2').val();
					var width_8_3 = $('#width_8_3').val();
					var width_8_4 = $('#width_8_4').val();
					var width_9_1 = $('#width_9_1').val();
					var width_9_2 = $('#width_9_2').val();
					var width_9_3 = $('#width_9_3').val();
					var width_9_4 = $('#width_9_4').val();
					var width_10_1 = $('#width_10_1').val();
					var width_10_2 = $('#width_10_2').val();
					var width_10_3 = $('#width_10_3').val();
					var width_10_4 = $('#width_10_4').val();
					var thick_1_1 = $('#thick_1_1').val();
					var thick_1_2 = $('#thick_1_2').val();
					var thick_1_3 = $('#thick_1_3').val();
					var thick_1_4 = $('#thick_1_4').val();
					var thick_2_1 = $('#thick_2_1').val();
					var thick_2_2 = $('#thick_2_2').val();
					var thick_2_3 = $('#thick_2_3').val();
					var thick_2_4 = $('#thick_2_4').val();
					var thick_3_1 = $('#thick_3_1').val();
					var thick_3_2 = $('#thick_3_2').val();
					var thick_3_3 = $('#thick_3_3').val();
					var thick_3_4 = $('#thick_3_4').val();
					var thick_4_1 = $('#thick_4_1').val();
					var thick_4_2 = $('#thick_4_2').val();
					var thick_4_3 = $('#thick_4_3').val();
					var thick_4_4 = $('#thick_4_4').val();
					var thick_5_1 = $('#thick_5_1').val();
					var thick_5_2 = $('#thick_5_2').val();
					var thick_5_3 = $('#thick_5_3').val();
					var thick_5_4 = $('#thick_5_4').val();
					var thick_6_1 = $('#thick_6_1').val();
					var thick_6_2 = $('#thick_6_2').val();
					var thick_6_3 = $('#thick_6_3').val();
					var thick_6_4 = $('#thick_6_4').val();
					var thick_7_1 = $('#thick_7_1').val();
					var thick_7_2 = $('#thick_7_2').val();
					var thick_7_3 = $('#thick_7_3').val();
					var thick_7_4 = $('#thick_7_4').val();
					var thick_8_1 = $('#thick_8_1').val();
					var thick_8_2 = $('#thick_8_2').val();
					var thick_8_3 = $('#thick_8_3').val();
					var thick_8_4 = $('#thick_8_4').val();
					var thick_9_1 = $('#thick_9_1').val();
					var thick_9_2 = $('#thick_9_2').val();
					var thick_9_3 = $('#thick_9_3').val();
					var thick_9_4 = $('#thick_9_4').val();
					var thick_10_1 = $('#thick_10_1').val();
					var thick_10_2 = $('#thick_10_2').val();
					var thick_10_3 = $('#thick_10_3').val();
					var thick_10_4 = $('#thick_10_4').val();
					var avg_1_1 = $('#avg_1_1').val();
					var avg_1_2 = $('#avg_1_2').val();
					var avg_1_3 = $('#avg_1_3').val();
					var avg_1_4 = $('#avg_1_4').val();
					var avg_1_5 = $('#avg_1_5').val();
					var avg_1_6 = $('#avg_1_6').val();
					var avg_1_7 = $('#avg_1_7').val();
					var avg_1_8 = $('#avg_1_8').val();
					var avg_1_9 = $('#avg_1_9').val();
					var avg_1_10 = $('#avg_1_10').val();
					var avg_1_11 = $('#avg_1_11').val();
					var avg_1_12 = $('#avg_1_12').val();
					var avg_1 = $('#avg_1').val();
					var avg_2 = $('#avg_2').val();
					var avg_3 = $('#avg_3').val();
					break;
				} else {
					var chk_dim = "0";
					var length_1_1 = "0";
					var length_1_2 = "0";
					var length_1_3 = "0";
					var length_1_4 = "0";
					var length_2_1 = "0";
					var length_2_2 = "0";
					var length_2_3 = "0";
					var length_2_4 = "0";
					var length_3_1 = "0";
					var length_3_2 = "0";
					var length_3_3 = "0";
					var length_3_4 = "0";
					var length_4_1 = "0";
					var length_4_2 = "0";
					var length_4_3 = "0";
					var length_4_4 = "0";
					var length_5_1 = "0";
					var length_5_2 = "0";
					var length_5_3 = "0";
					var length_5_4 = "0";
					var length_6_1 = "0";
					var length_6_2 = "0";
					var length_6_3 = "0";
					var length_6_4 = "0";
					var length_7_1 = "0";
					var length_7_2 = "0";
					var length_7_3 = "0";
					var length_7_4 = "0";
					var length_8_1 = "0";
					var length_8_2 = "0";
					var length_8_3 = "0";
					var length_8_4 = "0";
					var length_9_1 = "0";
					var length_9_2 = "0";
					var length_9_3 = "0";
					var length_9_4 = "0";
					var length_10_1 = "0";
					var length_10_2 = "0";
					var length_10_3 = "0";
					var length_10_4 = "0";
					var width_1_1 = "0";
					var width_1_2 = "0";
					var width_1_3 = "0";
					var width_1_4 = "0";
					var width_2_1 = "0";
					var width_2_2 = "0";
					var width_2_3 = "0";
					var width_2_4 = "0";
					var width_3_1 = "0";
					var width_3_2 = "0";
					var width_3_3 = "0";
					var width_3_4 = "0";
					var width_4_1 = "0";
					var width_4_2 = "0";
					var width_4_3 = "0";
					var width_4_4 = "0";
					var width_5_1 = "0";
					var width_5_2 = "0";
					var width_5_3 = "0";
					var width_5_4 = "0";
					var width_6_1 = "0";
					var width_6_2 = "0";
					var width_6_3 = "0";
					var width_6_4 = "0";
					var width_7_1 = "0";
					var width_7_2 = "0";
					var width_7_3 = "0";
					var width_7_4 = "0";
					var width_8_1 = "0";
					var width_8_2 = "0";
					var width_8_3 = "0";
					var width_8_4 = "0";
					var width_9_1 = "0";
					var width_9_2 = "0";
					var width_9_3 = "0";
					var width_9_4 = "0";
					var width_10_1 = "0";
					var width_10_2 = "0";
					var width_10_3 = "0";
					var width_10_4 = "0";
					var thick_1_1 = "0";
					var thick_1_2 = "0";
					var thick_1_3 = "0";
					var thick_1_4 = "0";
					var thick_2_1 = "0";
					var thick_2_2 = "0";
					var thick_2_3 = "0";
					var thick_2_4 = "0";
					var thick_3_1 = "0";
					var thick_3_2 = "0";
					var thick_3_3 = "0";
					var thick_3_4 = "0";
					var thick_4_1 = "0";
					var thick_4_2 = "0";
					var thick_4_3 = "0";
					var thick_4_4 = "0";
					var thick_5_1 = "0";
					var thick_5_2 = "0";
					var thick_5_3 = "0";
					var thick_5_4 = "0";
					var thick_6_1 = "0";
					var thick_6_2 = "0";
					var thick_6_3 = "0";
					var thick_6_4 = "0";
					var thick_7_1 = "0";
					var thick_7_2 = "0";
					var thick_7_3 = "0";
					var thick_7_4 = "0";
					var thick_8_1 = "0";
					var thick_8_2 = "0";
					var thick_8_3 = "0";
					var thick_8_4 = "0";
					var thick_9_1 = "0";
					var thick_9_2 = "0";
					var thick_9_3 = "0";
					var thick_9_4 = "0";
					var thick_10_1 = "0";
					var thick_10_2 = "0";
					var thick_10_3 = "0";
					var thick_10_4 = "0";
					var avg_1_1 = "0";
					var avg_1_2 = "0";
					var avg_1_3 = "0";
					var avg_1_4 = "0";
					var avg_1_5 = "0";
					var avg_1_6 = "0";
					var avg_1_7 = "0";
					var avg_1_8 = "0";
					var avg_1_9 = "0";
					var avg_1_10 = "0";
					var avg_1_11 = "0";
					var avg_1_12 = "0";
					var avg_1 = "0";
					var avg_2 = "0";
					var avg_3 = "0";
				}
			}
			//WATER ABSORPTION
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "WAT") {
					if (document.getElementById('chk_wtr').checked) {
						var chk_wtr = "1";
					} else {
						var chk_wtr = "0";
					}
					var a1 = $('#a1').val();
					var a2 = $('#a2').val();
					var a3 = $('#a3').val();
					var a4 = $('#a4').val();
					var a5 = $('#a5').val();
					var a6 = $('#a6').val();
					var a7 = $('#a7').val();
					var a8 = $('#a8').val();
					var a9 = $('#a9').val();
					var a10 = $('#a10').val();
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
					var wtr1 = $('#wtr1').val();
					var wtr2 = $('#wtr2').val();
					var wtr3 = $('#wtr3').val();
					var wtr4 = $('#wtr4').val();
					var wtr5 = $('#wtr5').val();
					var wtr6 = $('#wtr6').val();
					var wtr7 = $('#wtr7').val();
					var wtr8 = $('#wtr8').val();
					var wtr9 = $('#wtr9').val();
					var wtr10 = $('#wtr10').val();
					var avg_wtr = $('#avg_wtr').val();
					break;
				} else {
					var chk_wtr = "0";
					var a1 = "0";
					var a2 = "0";
					var a3 = "0";
					var a4 = "0";
					var a5 = "0";
					var a6 = "0";
					var a7 = "0";
					var a8 = "0";
					var a9 = "0";
					var a10 = "0";
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
					var wtr1 = "0";
					var wtr2 = "0";
					var wtr3 = "0";
					var wtr4 = "0";
					var wtr5 = "0";
					var wtr6 = "0";
					var wtr7 = "0";
					var wtr8 = "0";
					var wtr9 = "0";
					var wtr10 = "0";
					var avg_wtr = "0";

				}
			}

			//BREAKING STRENGTH
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "MOR") {
					if (document.getElementById('chk_str').checked) {
						var chk_str = "1";
					} else {
						var chk_str = "0";
					}
					var dima1 = $('#dima1').val();
					var dima2 = $('#dima2').val();
					var dima3 = $('#dima3').val();
					var dima4 = $('#dima4').val();
					var dima5 = $('#dima5').val();
					var dima6 = $('#dima6').val();
					var dima7 = $('#dima7').val();
					var dimb1 = $('#dimb1').val();
					var dimb2 = $('#dimb2').val();
					var dimb3 = $('#dimb3').val();
					var dimb4 = $('#dimb4').val();
					var dimb5 = $('#dimb5').val();
					var dimb6 = $('#dimb6').val();
					var dimb7 = $('#dimb7').val();
					var dimh1 = $('#dimh1').val();
					var dimh2 = $('#dimh2').val();
					var dimh3 = $('#dimh3').val();
					var dimh4 = $('#dimh4').val();
					var dimh5 = $('#dimh5').val();
					var dimh6 = $('#dimh6').val();
					var dimh7 = $('#dimh7').val();
					var l1 = $('#l1').val();
					var l2 = $('#l2').val();
					var l3 = $('#l3').val();
					var l4 = $('#l4').val();
					var l5 = $('#l5').val();
					var l6 = $('#l6').val();
					var l7 = $('#l7').val();
					var wa1 = $('#wa1').val();
					var wa2 = $('#wa2').val();
					var wa3 = $('#wa3').val();
					var wa4 = $('#wa4').val();
					var wa5 = $('#wa5').val();
					var wa6 = $('#wa6').val();
					var wa7 = $('#wa7').val();
					var load1 = $('#load1').val();
					var load2 = $('#load2').val();
					var load3 = $('#load3').val();
					var load4 = $('#load4').val();
					var load5 = $('#load5').val();
					var load6 = $('#load6').val();
					var load7 = $('#load7').val();
					var str1 = $('#str1').val();
					var str2 = $('#str2').val();
					var str3 = $('#str3').val();
					var str4 = $('#str4').val();
					var str5 = $('#str5').val();
					var str6 = $('#str6').val();
					var str7 = $('#str7').val();
					var rstr1 = $('#rstr1').val();
					var rstr2 = $('#rstr2').val();
					var rstr3 = $('#rstr3').val();
					var rstr4 = $('#rstr4').val();
					var rstr5 = $('#rstr5').val();
					var rstr6 = $('#rstr6').val();
					var rstr7 = $('#rstr7').val();
					var avg_str = $('#avg_str').val();
					var avg_rstr = $('#avg_rstr').val();
					break;
				} else {
					var chk_str = "0";
					var dima1 = "0";
					var dima2 = "0";
					var dima3 = "0";
					var dima4 = "0";
					var dima5 = "0";
					var dima6 = "0";
					var dima7 = "0";
					var dimb1 = "0";
					var dimb2 = "0";
					var dimb3 = "0";
					var dimb4 = "0";
					var dimb5 = "0";
					var dimb6 = "0";
					var dimb7 = "0";
					var dimh1 = "0";
					var dimh2 = "0";
					var dimh3 = "0";
					var dimh4 = "0";
					var dimh5 = "0";
					var dimh6 = "0";
					var dimh7 = "0";
					var l1 = "0";
					var l2 = "0";
					var l3 = "0";
					var l4 = "0";
					var l5 = "0";
					var l6 = "0";
					var l7 = "0";
					var wa1 = "0";
					var wa2 = "0";
					var wa3 = "0";
					var wa4 = "0";
					var wa5 = "0";
					var wa6 = "0";
					var wa7 = "0";
					var load1 = "0";
					var load2 = "0";
					var load3 = "0";
					var load4 = "0";
					var load5 = "0";
					var load6 = "0";
					var load7 = "0";
					var str1 = "0";
					var str2 = "0";
					var str3 = "0";
					var str4 = "0";
					var str5 = "0";
					var str6 = "0";
					var str7 = "0";
					var rstr1 = "0";
					var rstr2 = "0";
					var rstr3 = "0";
					var rstr4 = "0";
					var rstr5 = "0";
					var rstr6 = "0";
					var rstr7 = "0";
					var avg_str = "0";
					var avg_rstr = "0";


				}
			}

			//SCRATCH HARDNESS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "shs") {
					if (document.getElementById('chk_scr').checked) {
						var chk_scr = "1";
					} else {
						var chk_scr = "0";
					}
					var s1 = $('#s1').val();
					var s2 = $('#s2').val();
					var s3 = $('#s3').val();
					var avg_s = $('#avg_s').val();

					break;
				} else {
					var chk_scr = "0";
					var s1 = "0";
					var s2 = "0";
					var s3 = "0";
					var avg_s = "0";



				}
			}


			//DENSITY
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "DEN") {
					if (document.getElementById('chk_den').checked) {
						var chk_den = "1";
					} else {
						var chk_den = "0";
					}

					var dl1 = $('#dl1').val();
					var dl2 = $('#dl2').val();
					var dl3 = $('#dl3').val();
					var dl4 = $('#dl4').val();
					var dl5 = $('#dl5').val();
					var dl6 = $('#dl6').val();
					var dw1 = $('#dw1').val();
					var dw2 = $('#dw2').val();
					var dw3 = $('#dw3').val();
					var dw4 = $('#dw4').val();
					var dw5 = $('#dw5').val();
					var dw6 = $('#dw6').val();
					var dt1 = $('#dt1').val();
					var dt2 = $('#dt2').val();
					var dt3 = $('#dt3').val();
					var dt4 = $('#dt4').val();
					var dt5 = $('#dt5').val();
					var dt6 = $('#dt6').val();
					var vol1 = $('#vol1').val();
					var vol2 = $('#vol2').val();
					var vol3 = $('#vol3').val();
					var vol4 = $('#vol4').val();
					var vol5 = $('#vol5').val();
					var vol6 = $('#vol6').val();
					var dweight1 = $('#dweight1').val();
					var dweight2 = $('#dweight2').val();
					var dweight3 = $('#dweight3').val();
					var dweight4 = $('#dweight4').val();
					var dweight5 = $('#dweight5').val();
					var dweight6 = $('#dweight6').val();
					var den1 = $('#den1').val();
					var den2 = $('#den2').val();
					var den3 = $('#den3').val();
					var den4 = $('#den4').val();
					var den5 = $('#den5').val();
					var den6 = $('#den6').val();
					var avg_den = $('#avg_den').val();

					break;
				} else {
					var chk_den = "0";
					var dl1 = "0";
					var dl2 = "0";
					var dl3 = "0";
					var dl4 = "0";
					var dl5 = "0";
					var dl6 = "0";
					var dw1 = "0";
					var dw2 = "0";
					var dw3 = "0";
					var dw4 = "0";
					var dw5 = "0";
					var dw6 = "0";
					var dt1 = "0";
					var dt2 = "0";
					var dt3 = "0";
					var dt4 = "0";
					var dt5 = "0";
					var dt6 = "0";
					var vol1 = "0";
					var vol2 = "0";
					var vol3 = "0";
					var vol4 = "0";
					var vol5 = "0";
					var vol6 = "0";
					var dweight1 = "0";
					var dweight2 = "0";
					var dweight3 = "0";
					var dweight4 = "0";
					var dweight5 = "0";
					var dweight6 = "0";
					var den1 = "0";
					var den2 = "0";
					var den3 = "0";
					var den4 = "0";
					var den5 = "0";
					var den6 = "0";
					var avg_den = "0";
				}
			}




			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&tiles_brand=' + tiles_brand + '&chk_str=' + chk_str + '&dima1=' + dima1 + '&dima2=' + dima2 + '&dima3=' + dima3 + '&dima4=' + dima4 + '&dima5=' + dima5 + '&dima6=' + dima6 + '&dima7=' + dima7 + '&dimb1=' + dimb1 + '&dimb2=' + dimb2 + '&dimb3=' + dimb3 + '&dimb4=' + dimb4 + '&dimb5=' + dimb5 + '&dimb6=' + dimb6 + '&dimb7=' + dimb7 + '&dimh1=' + dimh1 + '&dimh2=' + dimh2 + '&dimh3=' + dimh3 + '&dimh4=' + dimh4 + '&dimh5=' + dimh5 + '&dimh6=' + dimh6 + '&dimh7=' + dimh7 + '&l1=' + l1 + '&l2=' + l2 + '&l3=' + l3 + '&l4=' + l4 + '&l5=' + l5 + '&l6=' + l6 + '&l7=' + l7 + '&load1=' + load1 + '&load2=' + load2 + '&load3=' + load3 + '&load4=' + load4 + '&load5=' + load5 + '&load6=' + load6 + '&load7=' + load7 + '&wa1=' + wa1 + '&wa2=' + wa2 + '&wa3=' + wa3 + '&wa4=' + wa4 + '&wa5=' + wa5 + '&wa6=' + wa6 + '&wa7=' + wa7 + '&str1=' + str1 + '&str2=' + str2 + '&str3=' + str3 + '&str4=' + str4 + '&str5=' + str5 + '&str6=' + str6 + '&str7=' + str7 + '&rstr1=' + rstr1 + '&rstr2=' + rstr2 + '&rstr3=' + rstr3 + '&rstr4=' + rstr4 + '&rstr5=' + rstr5 + '&rstr6=' + rstr6 + '&rstr7=' + rstr7 + '&avg_str=' + avg_str + '&avg_rstr=' + avg_rstr + '&chk_scr=' + chk_scr + '&s1=' + s1 + '&s2=' + s2 + '&s3=' + s3 + '&avg_s=' + avg_s + '&chk_dim=' + chk_dim + '&length_1_1=' + length_1_1 + '&length_1_2=' + length_1_2 + '&length_1_3=' + length_1_3 + '&length_1_4=' + length_1_4 + '&length_2_1=' + length_2_1 + '&length_2_2=' + length_2_2 + '&length_2_3=' + length_2_3 + '&length_2_4=' + length_2_4 + '&length_3_1=' + length_3_1 + '&length_3_2=' + length_3_2 + '&length_3_3=' + length_3_3 + '&length_3_4=' + length_3_4 + '&length_4_1=' + length_4_1 + '&length_4_2=' + length_4_2 + '&length_4_3=' + length_4_3 + '&length_4_4=' + length_4_4 + '&length_5_1=' + length_5_1 + '&length_5_2=' + length_5_2 + '&length_5_3=' + length_5_3 + '&length_5_4=' + length_5_4 + '&length_6_1=' + length_6_1 + '&length_6_2=' + length_6_2 + '&length_6_3=' + length_6_3 + '&length_6_4=' + length_6_4 + '&length_7_1=' + length_7_1 + '&length_7_2=' + length_7_2 + '&length_7_3=' + length_7_3 + '&length_7_4=' + length_7_4 + '&length_8_1=' + length_8_1 + '&length_8_2=' + length_8_2 + '&length_8_3=' + length_8_3 + '&length_8_4=' + length_8_4 + '&length_9_1=' + length_9_1 + '&length_9_2=' + length_9_2 + '&length_9_3=' + length_9_3 + '&length_9_4=' + length_9_4 + '&length_10_1=' + length_10_1 + '&length_10_2=' + length_10_2 + '&length_10_3=' + length_10_3 + '&length_10_4=' + length_10_4 + '&width_1_1=' + width_1_1 + '&width_1_2=' + width_1_2 + '&width_1_3=' + width_1_3 + '&width_1_4=' + width_1_4 + '&width_2_1=' + width_2_1 + '&width_2_2=' + width_2_2 + '&width_2_3=' + width_2_3 + '&width_2_4=' + width_2_4 + '&width_3_1=' + width_3_1 + '&width_3_2=' + width_3_2 + '&width_3_3=' + width_3_3 + '&width_3_4=' + width_3_4 + '&width_4_1=' + width_4_1 + '&width_4_2=' + width_4_2 + '&width_4_3=' + width_4_3 + '&width_4_4=' + width_4_4 + '&width_5_1=' + width_5_1 + '&width_5_2=' + width_5_2 + '&width_5_3=' + width_5_3 + '&width_5_4=' + width_5_4 + '&width_6_1=' + width_6_1 + '&width_6_2=' + width_6_2 + '&width_6_3=' + width_6_3 + '&width_6_4=' + width_6_4 + '&width_7_1=' + width_7_1 + '&width_7_2=' + width_7_2 + '&width_7_3=' + width_7_3 + '&width_7_4=' + width_7_4 + '&width_8_1=' + width_8_1 + '&width_8_2=' + width_8_2 + '&width_8_3=' + width_8_3 + '&width_8_4=' + width_8_4 + '&width_9_1=' + width_9_1 + '&width_9_2=' + width_9_2 + '&width_9_3=' + width_9_3 + '&width_9_4=' + width_9_4 + '&width_10_1=' + width_10_1 + '&width_10_2=' + width_10_2 + '&width_10_3=' + width_10_3 + '&width_10_4=' + width_10_4 + '&thick_1_1=' + thick_1_1 + '&thick_1_2=' + thick_1_2 + '&thick_1_3=' + thick_1_3 + '&thick_1_4=' + thick_1_4 + '&thick_2_1=' + thick_2_1 + '&thick_2_2=' + thick_2_2 + '&thick_2_3=' + thick_2_3 + '&thick_2_4=' + thick_2_4 + '&thick_3_1=' + thick_3_1 + '&thick_3_2=' + thick_3_2 + '&thick_3_3=' + thick_3_3 + '&thick_3_4=' + thick_3_4 + '&thick_4_1=' + thick_4_1 + '&thick_4_2=' + thick_4_2 + '&thick_4_3=' + thick_4_3 + '&thick_4_4=' + thick_4_4 + '&thick_5_1=' + thick_5_1 + '&thick_5_2=' + thick_5_2 + '&thick_5_3=' + thick_5_3 + '&thick_5_4=' + thick_5_4 + '&thick_6_1=' + thick_6_1 + '&thick_6_2=' + thick_6_2 + '&thick_6_3=' + thick_6_3 + '&thick_6_4=' + thick_6_4 + '&thick_7_1=' + thick_7_1 + '&thick_7_2=' + thick_7_2 + '&thick_7_3=' + thick_7_3 + '&thick_7_4=' + thick_7_4 + '&thick_8_1=' + thick_8_1 + '&thick_8_2=' + thick_8_2 + '&thick_8_3=' + thick_8_3 + '&thick_8_4=' + thick_8_4 + '&thick_9_1=' + thick_9_1 + '&thick_9_2=' + thick_9_2 + '&thick_9_3=' + thick_9_3 + '&thick_9_4=' + thick_9_4 + '&thick_10_1=' + thick_10_1 + '&thick_10_2=' + thick_10_2 + '&thick_10_3=' + thick_10_3 + '&thick_10_4=' + thick_10_4 + '&avg_1_1=' + avg_1_1 + '&avg_1_2=' + avg_1_2 + '&avg_1_3=' + avg_1_3 + '&avg_1_4=' + avg_1_4 + '&avg_1_5=' + avg_1_5 + '&avg_1_6=' + avg_1_6 + '&avg_1_7=' + avg_1_7 + '&avg_1_8=' + avg_1_8 + '&avg_1_9=' + avg_1_9 + '&avg_1_10=' + avg_1_10 + '&avg_1_11=' + avg_1_11 + '&avg_1_12=' + avg_1_12 + '&avg_1=' + avg_1 + '&avg_2=' + avg_2 + '&avg_3=' + avg_3 + '&chk_wtr=' + chk_wtr + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&a4=' + a4 + '&a5=' + a5 + '&a6=' + a6 + '&a7=' + a7 + '&a8=' + a8 + '&a9=' + a9 + '&a10=' + a10 + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&b4=' + b4 + '&b5=' + b5 + '&b6=' + b6 + '&b7=' + b7 + '&b8=' + b8 + '&b9=' + b9 + '&b10=' + b10 + '&wtr1=' + wtr1 + '&wtr2=' + wtr2 + '&wtr3=' + wtr3 + '&wtr4=' + wtr4 + '&wtr5=' + wtr5 + '&wtr6=' + wtr6 + '&wtr7=' + wtr7 + '&wtr8=' + wtr8 + '&wtr9=' + wtr9 + '&wtr10=' + wtr10 + '&avg_wtr=' + avg_wtr + '&chk_den=' + chk_den + '&dl1=' + dl1 + '&dl2=' + dl2 + '&dl3=' + dl3 + '&dl4=' + dl4 + '&dl5=' + dl5 + '&dl6=' + dl6 + '&dw1=' + dw1 + '&dw2=' + dw2 + '&dw3=' + dw3 + '&dw4=' + dw4 + '&dw5=' + dw5 + '&dw6=' + dw6 + '&dt1=' + dt1 + '&dt2=' + dt2 + '&dt3=' + dt3 + '&dt4=' + dt4 + '&dt5=' + dt5 + '&dt6=' + dt6 + '&vol1=' + vol1 + '&vol2=' + vol2 + '&vol3=' + vol3 + '&vol4=' + vol4 + '&vol5=' + vol5 + '&vol6=' + vol6 + '&dweight1=' + dweight1 + '&dweight2=' + dweight2 + '&dweight3=' + dweight3 + '&dweight4=' + dweight4 + '&dweight5=' + dweight5 + '&dweight6=' + dweight6 + '&den1=' + den1 + '&den2=' + den2 + '&den3=' + den3 + '&den4=' + den4 + '&den5=' + den5 + '&den6=' + den6 + '&avg_den=' + avg_den+ '&amend_date=' + amend_date;

		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}


		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_ceramic_tiles.php',
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
			url: '<?php echo $base_url; ?>save_ceramic_tiles.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);

				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);
				$('#ulr').val(data.ulr);
				$('#amend_date').val(data.amend_date);
				$('#tiles_brand').val(data.tiles_brand);

				var temp = $('#test_list').val();
				var aa = temp.split(",");

				//DIMENTION
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
						$('#length_1_1').val(data.length_1_1);
						$('#length_1_2').val(data.length_1_2);
						$('#length_1_3').val(data.length_1_3);
						$('#length_1_4').val(data.length_1_4);
						$('#length_2_1').val(data.length_2_1);
						$('#length_2_2').val(data.length_2_2);
						$('#length_2_3').val(data.length_2_3);
						$('#length_2_4').val(data.length_2_4);
						$('#length_3_1').val(data.length_3_1);
						$('#length_3_2').val(data.length_3_2);
						$('#length_3_3').val(data.length_3_3);
						$('#length_3_4').val(data.length_3_4);
						$('#length_4_1').val(data.length_4_1);
						$('#length_4_2').val(data.length_4_2);
						$('#length_4_3').val(data.length_4_3);
						$('#length_4_4').val(data.length_4_4);
						$('#length_5_1').val(data.length_5_1);
						$('#length_5_2').val(data.length_5_2);
						$('#length_5_3').val(data.length_5_3);
						$('#length_5_4').val(data.length_5_4);
						$('#length_6_1').val(data.length_6_1);
						$('#length_6_2').val(data.length_6_2);
						$('#length_6_3').val(data.length_6_3);
						$('#length_6_4').val(data.length_6_4);
						$('#length_7_1').val(data.length_7_1);
						$('#length_7_2').val(data.length_7_2);
						$('#length_7_3').val(data.length_7_3);
						$('#length_7_4').val(data.length_7_4);
						$('#length_8_1').val(data.length_8_1);
						$('#length_8_2').val(data.length_8_2);
						$('#length_8_3').val(data.length_8_3);
						$('#length_8_4').val(data.length_8_4);
						$('#length_9_1').val(data.length_9_1);
						$('#length_9_2').val(data.length_9_2);
						$('#length_9_3').val(data.length_9_3);
						$('#length_9_4').val(data.length_9_4);
						$('#length_10_1').val(data.length_10_1);
						$('#length_10_2').val(data.length_10_2);
						$('#length_10_3').val(data.length_10_3);
						$('#length_10_4').val(data.length_10_4);
						$('#width_1_1').val(data.width_1_1);
						$('#width_1_2').val(data.width_1_2);
						$('#width_1_3').val(data.width_1_3);
						$('#width_1_4').val(data.width_1_4);
						$('#width_2_1').val(data.width_2_1);
						$('#width_2_2').val(data.width_2_2);
						$('#width_2_3').val(data.width_2_3);
						$('#width_2_4').val(data.width_2_4);
						$('#width_3_1').val(data.width_3_1);
						$('#width_3_2').val(data.width_3_2);
						$('#width_3_3').val(data.width_3_3);
						$('#width_3_4').val(data.width_3_4);
						$('#width_4_1').val(data.width_4_1);
						$('#width_4_2').val(data.width_4_2);
						$('#width_4_3').val(data.width_4_3);
						$('#width_4_4').val(data.width_4_4);
						$('#width_5_1').val(data.width_5_1);
						$('#width_5_2').val(data.width_5_2);
						$('#width_5_3').val(data.width_5_3);
						$('#width_5_4').val(data.width_5_4);
						$('#width_6_1').val(data.width_6_1);
						$('#width_6_2').val(data.width_6_2);
						$('#width_6_3').val(data.width_6_3);
						$('#width_6_4').val(data.width_6_4);
						$('#width_7_1').val(data.width_7_1);
						$('#width_7_2').val(data.width_7_2);
						$('#width_7_3').val(data.width_7_3);
						$('#width_7_4').val(data.width_7_4);
						$('#width_8_1').val(data.width_8_1);
						$('#width_8_2').val(data.width_8_2);
						$('#width_8_3').val(data.width_8_3);
						$('#width_8_4').val(data.width_8_4);
						$('#width_9_1').val(data.width_9_1);
						$('#width_9_2').val(data.width_9_2);
						$('#width_9_3').val(data.width_9_3);
						$('#width_9_4').val(data.width_9_4);
						$('#width_10_1').val(data.width_10_1);
						$('#width_10_2').val(data.width_10_2);
						$('#width_10_3').val(data.width_10_3);
						$('#width_10_4').val(data.width_10_4);
						$('#thick_1_1').val(data.thick_1_1);
						$('#thick_1_2').val(data.thick_1_2);
						$('#thick_1_3').val(data.thick_1_3);
						$('#thick_1_4').val(data.thick_1_4);
						$('#thick_2_1').val(data.thick_2_1);
						$('#thick_2_2').val(data.thick_2_2);
						$('#thick_2_3').val(data.thick_2_3);
						$('#thick_2_4').val(data.thick_2_4);
						$('#thick_3_1').val(data.thick_3_1);
						$('#thick_3_2').val(data.thick_3_2);
						$('#thick_3_3').val(data.thick_3_3);
						$('#thick_3_4').val(data.thick_3_4);
						$('#thick_4_1').val(data.thick_4_1);
						$('#thick_4_2').val(data.thick_4_2);
						$('#thick_4_3').val(data.thick_4_3);
						$('#thick_4_4').val(data.thick_4_4);
						$('#thick_5_1').val(data.thick_5_1);
						$('#thick_5_2').val(data.thick_5_2);
						$('#thick_5_3').val(data.thick_5_3);
						$('#thick_5_4').val(data.thick_5_4);
						$('#thick_6_1').val(data.thick_6_1);
						$('#thick_6_2').val(data.thick_6_2);
						$('#thick_6_3').val(data.thick_6_3);
						$('#thick_6_4').val(data.thick_6_4);
						$('#thick_7_1').val(data.thick_7_1);
						$('#thick_7_2').val(data.thick_7_2);
						$('#thick_7_3').val(data.thick_7_3);
						$('#thick_7_4').val(data.thick_7_4);
						$('#thick_8_1').val(data.thick_8_1);
						$('#thick_8_2').val(data.thick_8_2);
						$('#thick_8_3').val(data.thick_8_3);
						$('#thick_8_4').val(data.thick_8_4);
						$('#thick_9_1').val(data.thick_9_1);
						$('#thick_9_2').val(data.thick_9_2);
						$('#thick_9_3').val(data.thick_9_3);
						$('#thick_9_4').val(data.thick_9_4);
						$('#thick_10_1').val(data.thick_10_1);
						$('#thick_10_2').val(data.thick_10_2);
						$('#thick_10_3').val(data.thick_10_3);
						$('#thick_10_4').val(data.thick_10_4);
						$('#avg_1_1').val(data.avg_1_1);
						$('#avg_1_2').val(data.avg_1_2);
						$('#avg_1_3').val(data.avg_1_3);
						$('#avg_1_4').val(data.avg_1_4);
						$('#avg_1_5').val(data.avg_1_5);
						$('#avg_1_6').val(data.avg_1_6);
						$('#avg_1_7').val(data.avg_1_7);
						$('#avg_1_8').val(data.avg_1_8);
						$('#avg_1_9').val(data.avg_1_9);
						$('#avg_1_10').val(data.avg_1_10);
						$('#avg_1_11').val(data.avg_1_11);
						$('#avg_1_12').val(data.avg_1_12);
						$('#avg_1').val(data.avg_1);
						$('#avg_2').val(data.avg_2);
						$('#avg_3').val(data.avg_3);
						break;
					}
				}

				//WATER ABSORPTION
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "WAT") {

						var chk_wtr = data.chk_wtr;
						if (chk_wtr == "1") {
							$('#txtwtr').css("background-color", "var(--success)");
							$("#chk_wtr").prop("checked", true);
						} else {
							$('#txtwtr').css("background-color", "white");
							$("#chk_wtr").prop("checked", false);
						}

						$('#a1').val(data.a1);
						$('#a2').val(data.a2);
						$('#a3').val(data.a3);
						$('#a4').val(data.a4);
						$('#a5').val(data.a5);
						$('#a6').val(data.a6);
						$('#a7').val(data.a7);
						$('#a8').val(data.a8);
						$('#a9').val(data.a9);
						$('#a10').val(data.a10);
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
						$('#wtr1').val(data.wtr1);
						$('#wtr2').val(data.wtr2);
						$('#wtr3').val(data.wtr3);
						$('#wtr4').val(data.wtr4);
						$('#wtr5').val(data.wtr5);
						$('#wtr6').val(data.wtr6);
						$('#wtr7').val(data.wtr7);
						$('#wtr8').val(data.wtr8);
						$('#wtr9').val(data.wtr9);
						$('#wtr10').val(data.wtr10);
						$('#avg_wtr').val(data.avg_wtr);

						break;
					} else {

					}

				}

				//BREAKING STRENGTH
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "MOR") {

						var chk_str = data.chk_str;
						if (chk_str == "1") {
							$('#txtstr').css("background-color", "var(--success)");
							$("#chk_str").prop("checked", true);
						} else {
							$('#txtstr').css("background-color", "white");
							$("#chk_str").prop("checked", false);
						}
						$('#dima1').val(data.dima1);
						$('#dima2').val(data.dima2);
						$('#dima3').val(data.dima3);
						$('#dima4').val(data.dima4);
						$('#dima5').val(data.dima5);
						$('#dima6').val(data.dima6);
						$('#dima7').val(data.dima7);
						$('#dimb1').val(data.dimb1);
						$('#dimb2').val(data.dimb2);
						$('#dimb3').val(data.dimb3);
						$('#dimb4').val(data.dimb4);
						$('#dimb5').val(data.dimb5);
						$('#dimb6').val(data.dimb6);
						$('#dimb7').val(data.dimb7);
						$('#dimh1').val(data.dimh1);
						$('#dimh2').val(data.dimh2);
						$('#dimh3').val(data.dimh3);
						$('#dimh4').val(data.dimh4);
						$('#dimh5').val(data.dimh5);
						$('#dimh6').val(data.dimh6);
						$('#dimh7').val(data.dimh7);
						$('#l1').val(data.l1);
						$('#l2').val(data.l2);
						$('#l3').val(data.l3);
						$('#l4').val(data.l4);
						$('#l5').val(data.l5);
						$('#l6').val(data.l6);
						$('#l7').val(data.l7);
						$('#wa1').val(data.wa1);
						$('#wa2').val(data.wa2);
						$('#wa3').val(data.wa3);
						$('#wa4').val(data.wa4);
						$('#wa5').val(data.wa5);
						$('#wa6').val(data.wa6);
						$('#wa7').val(data.wa7);
						$('#load1').val(data.load1);
						$('#load2').val(data.load2);
						$('#load3').val(data.load3);
						$('#load4').val(data.load4);
						$('#load5').val(data.load5);
						$('#load6').val(data.load6);
						$('#load7').val(data.load7);
						$('#str1').val(data.str1);
						$('#str2').val(data.str2);
						$('#str3').val(data.str3);
						$('#str4').val(data.str4);
						$('#str5').val(data.str5);
						$('#str6').val(data.str6);
						$('#str7').val(data.str7);
						$('#rstr1').val(data.rstr1);
						$('#rstr2').val(data.rstr2);
						$('#rstr3').val(data.rstr3);
						$('#rstr4').val(data.rstr4);
						$('#rstr5').val(data.rstr5);
						$('#rstr6').val(data.rstr6);
						$('#rstr7').val(data.rstr7);
						$('#avg_str').val(data.avg_str);
						$('#avg_rstr').val(data.avg_rstr);
						break;
					} else {

					}

				}


				//SCRATCH HARDNESS OF SURFACE
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "shs") {

						var chk_scr = data.chk_scr;
						if (chk_scr == "1") {
							$('#txtscr').css("background-color", "var(--success)");
							$("#chk_scr").prop("checked", true);
						} else {
							$('#txtscr').css("background-color", "white");
							$("#chk_scr").prop("checked", false);
						}

						$('#s1').val(data.s1);
						$('#s2').val(data.s2);
						$('#s3').val(data.s3);
						$('#avg_s').val(data.avg_s);

						break;
					} else {

					}

				}


				//DENSITY
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "DEN") {

						var chk_den = data.chk_den;
						if (chk_den == "1") {
							$('#txtden').css("background-color", "var(--success)");
							$("#chk_den").prop("checked", true);
						} else {
							$('#txtden').css("background-color", "white");
							$("#chk_den").prop("checked", false);
						}

						$('#dl1').val(data.dl1);
						$('#dl2').val(data.dl2);
						$('#dl3').val(data.dl3);
						$('#dl4').val(data.dl4);
						$('#dl5').val(data.dl5);
						$('#dl6').val(data.dl6);
						$('#dw1').val(data.dw1);
						$('#dw2').val(data.dw2);
						$('#dw3').val(data.dw3);
						$('#dw4').val(data.dw4);
						$('#dw5').val(data.dw5);
						$('#dw6').val(data.dw6);
						$('#dt1').val(data.dt1);
						$('#dt2').val(data.dt2);
						$('#dt3').val(data.dt3);
						$('#dt4').val(data.dt4);
						$('#dt5').val(data.dt5);
						$('#dt6').val(data.dt6);
						$('#vol1').val(data.vol1);
						$('#vol2').val(data.vol2);
						$('#vol3').val(data.vol3);
						$('#vol4').val(data.vol4);
						$('#vol5').val(data.vol5);
						$('#vol6').val(data.vol6);
						$('#dweight1').val(data.dweight1);
						$('#dweight2').val(data.dweight2);
						$('#dweight3').val(data.dweight3);
						$('#dweight4').val(data.dweight4);
						$('#dweight5').val(data.dweight5);
						$('#dweight6').val(data.dweight6);
						$('#den1').val(data.den1);
						$('#den2').val(data.den2);
						$('#den3').val(data.den3);
						$('#den4').val(data.den4);
						$('#den5').val(data.den5);
						$('#den6').val(data.den6);
						$('#avg_den').val(data.avg_den);

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
