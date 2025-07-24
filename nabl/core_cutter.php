<?php
session_start();
include("header.php");
include("connection.php");
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
}
if (isset($_GET['ulr'])) {
	$ulr = $_GET['ulr'];
}
if (isset($_GET['lab_no'])) {
	$lab_no = $_GET['lab_no'];
	$aa	= $_GET['lab_no'];
}

$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
$result_select4 = mysqli_query($conn, $select_query4);

if (mysqli_num_rows($result_select4) > 0) {
	$row_select4 = mysqli_fetch_assoc($result_select4);
	$chain = $row_select4['chainage_no'];
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
						<h2 style="text-align:center;">CORE CUTTER</h2>
					</div>
					<!--<div class="box-default">-->
					<form class="form" id="Glazed" method="post">
						<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
						<div class="row">
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
							<div class="col-lg-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Remark:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control inputs" tabindex="4" id="remark" name="remark">
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-4 control-label">Sheet No:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control inputs" tabindex="4" id="sheet" name="sheet">
									</div>
								</div>
							</div>
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
										<!--<button type="button" class="btn btn-info pull-right" id="btn_auto" name="btn_auto" tabindex="14" >Auto</button>-->
										<!-- HIDDEN FIELD VAIBHAV-->
										<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)">Back</button>
										<input type="hidden" class="form-control" name="id" id="idEdit" />
									</div>
									<div class="col-sm-2">
										<!-- SAVE BUTTON LOGIC VAIBHAV-->
										<?php
										$querys_job1 = "SELECT * FROM core_cutter WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
									// if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl"  || $_SESSION['nabl_type']=="direct_non_nabl"|| $_SESSION['nabl_type']=="non_nabl") {
									?>
									<div class="col-sm-2">
										<a target='_blank' href="<?php echo $base_url; ?>print_report/print_core_cutter.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>&&ulr=<?php echo $ulr; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
									</div>
									<div class="col-sm-2">

										<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_core_cutter.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Report</b></a>
									</div>

									<?php //} 
									?>
								</div>
							</div>
						</div>
						<hr>
						<br>
						<div class="panel-group" id="accordion">
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
														</tr>
														<?php
														$query_file = "select * from excel_upload_from_report WHERE lab_no='$lab_no' and job_no='$job_no_main' and report_no='$report_no'";
														$result_file = mysqli_query($conn, $query_file);
														if (mysqli_num_rows($result_file) > 0) {
															while ($r_file = mysqli_fetch_array($result_file)) {
														?>
																<tr>
																	<td><a href="<?php echo $base_url . $r_file['excel_sheet']; ?>" download><?php echo $r_file['excel_sheet']; ?></a></td>
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

							<?php
							$test_check;
							$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
							$result_select1 = mysqli_query($conn, $select_query1);
							while ($r1 = mysqli_fetch_array($result_select1)) {

								if ($r1['test_code'] == "cor") {
									$test_check .= "cor,";
							?>

									<div class="panel panel-default" id="den">
										<div class="panel-heading" id="txtden">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
													<h4 class="panel-title">
														<b>FIELD DRY DENSITY BY CORE CUTTER</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse2" class="panel-collapse collapse">
											<div class="panel-body">
												<br>
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_den">1.</label>
																<input type="checkbox" class="visually-hidden" name="chk_den" id="chk_den" value="chk_den"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">FIELD DRY DENSITY BY CORE CUTTER</label>
														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Diameter - (D)</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_1" name="fdd_1">
															</div>
															<!-- <div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_1_1" name="fdd_1_1">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_1_2" name="fdd_1_2">
															</div> -->

														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Height - (H)</label>

															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="mc_soil" name="mc_soil">
															</div>

														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Weight of Core Cutter and Wet soil - Ws</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="field_mdd" name="field_mdd">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="field_mdd1" name="field_mdd1">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="field_mdd2" name="field_mdd2">
															</div>

														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Weight of Core Cutter - Wc</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="chainage_no" name="chainage_no" value="<?php echo $chain; ?>">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="chainage_no1" name="chainage_no1">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="chainage_no2" name="chainage_no2">
															</div>

														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Wt. of Wet Soil - Ww = (Ws-Wc)</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="empty_core" name="empty_core" disabled>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="empty_core1" name="empty_core1" disabled>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="empty_core2" name="empty_core2" disabled>
															</div>

														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Volume of Core Cutter - Vc = 3.14/4*D<sup>2</sup> * H</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="vol_core" name="vol_core" disabled>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="vol_core1" name="vol_core1" disabled>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="vol_core2" name="vol_core2" disabled>
															</div>

														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Bulk Density of Soil - Yb= Ww/Vc</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="soil_core" name="soil_core" disabled>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="soil_core1" name="soil_core1" disabled>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="soil_core2" name="soil_core2" disabled>
															</div>

														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Container Number</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wet_soil_core" name="wet_soil_core">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wet_soil_core1" name="wet_soil_core1">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wet_soil_core2" name="wet_soil_core2">
															</div>

														</div>
													</div>
												</div>
												<br>

												<br>
												<!-- 										
										
										 -->
												<!-- <div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Container No.<input type="radio" id="mo_meter" name="mo_meter" value="mo_con" checked/></label>	
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="con_no" name="con_no">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="con_no1" name="con_no1">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="con_no2" name="con_no2">
															</div>

														</div>
													</div>
												</div> -->
												<!-- <br> -->

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Weight of Container - W1</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="con_weight" name="con_weight">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="con_weight1" name="con_weight1">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="con_weight2" name="con_weight2">
															</div>

														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Wt. of Container + Wet Soil (gm) - W2</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wt_con_wt_soil" name="wt_con_wt_soil">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wt_con_wt_soil1" name="wt_con_wt_soil1">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wt_con_wt_soil2" name="wt_con_wt_soil2">
															</div>

														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Wt. of Container + Dry Soil (gm) - W3</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wt_con_dry_soil" name="wt_con_dry_soil">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wt_con_dry_soil1" name="wt_con_dry_soil1">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wt_con_dry_soil2" name="wt_con_dry_soil2">
															</div>

														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Field Moisture Content - W = (W2-W3)/(W3-W1)*100</label>
																<input type="hidden" style="text-align:center;" class="form-control inputs" tabindex="4" id="xy" name="xy">
																<input type="hidden" style="text-align:center;" class="form-control inputs" tabindex="4" id="xans" name="xans">
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_2" name="fdd_2" disabled>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_2_1" name="fdd_2_1" disabled>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_2_2" name="fdd_2_2" disabled>
															</div>

														</div>
													</div>
												</div>

												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-3">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Field Dry Density Yd = (100 Yb/100+W)</label>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_3" name="fdd_3" disabled>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_3_1" name="fdd_3_1" disabled>
															</div>
															<div class="col-md-3">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_3_2" name="fdd_3_2" disabled>
															</div>

														</div>
													</div>
												</div>
												<br>

												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-6">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Percentage of Compaction (%) = (FDD/ MDD) x 100</label>
															</div>
															<div class="col-md-6">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_4" name="fdd_4" disabled>
															</div>

														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-6">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Average of Field Moisture Content</label>
															</div>
															<div class="col-md-6">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="avg_moi" name="avg_moi" disabled>
															</div>

														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-6">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Average of Field Dry Density</label>
															</div>
															<div class="col-md-6">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="avg_dry" name="avg_dry" disabled>
															</div>

														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">

														<div class="form-group">
															<div class="col-md-6">
																<label for="inputEmail3" class="control-label" style="text-align:left;">Maximum Dry Density (MDD)</label>
															</div>
															<div class="col-md-6">
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="mdd_1" name="mdd_1" disabled>
															</div>

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
										$query = "select * from core_cutter WHERE lab_no='$aa'  and `is_deleted`='0'";

										$result = mysqli_query($conn, $query);

										$cnt = 0;
										$detail = 0;
										if (mysqli_num_rows($result) > 0) {
											while ($r = mysqli_fetch_array($result)) {
												if ($r['is_deleted'] == 0) {
										?>
													<tr>

														<td style="text-align:center;" width="10%">

															<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
															<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>

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
	</section>
</div>
<?php include("footer.php"); ?>
<script>
	$('.startdate_class').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	});


	$(function() {
		$('.select2').select2();
	})
	$("#btn_upload_excel").click(function() {
		form_data = new FormData();
		var acb = $('#upload_excel').val();
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

	$(document).ready(function() {

		$('#btn_edit_data').hide();
		$('#alert').hide();
		var method = "mo_con";
		/* var conno = randomNumberFromRange(1,321).toFixed();			
		$('#con_no').val(conno);			
		var con_no = $('#con_no').val();			
		getWeight(con_no); */



		function auto() {
			console.log("=============Vivek-Called==================");

			$('#fdd_1').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#mc_soil').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#field_mdd').val(randomNumberFromRange(1100.10, 9985).toFixed(2));
			$('#field_mdd1').val(randomNumberFromRange(1100.10, 9985.10).toFixed(2));
			$('#field_mdd2').val(randomNumberFromRange(1100.10, 9985.10).toFixed(2));
			$('#chainage_no').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#chainage_no1').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#chainage_no2').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#wet_soil_core').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#wet_soil_core1').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#wet_soil_core2').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#con_weight').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#con_weight1').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#con_weight2').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#wt_con_wt_soil').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#wt_con_wt_soil1').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#wt_con_wt_soil2').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#wt_con_dry_soil').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#wt_con_dry_soil1').val(randomNumberFromRange(10.10, 99.85).toFixed(2));
			$('#wt_con_dry_soil2').val(randomNumberFromRange(10.10, 99.85).toFixed(2));

			var fdd_1 = $('#fdd_1').val();
			var mc_soil = $('#mc_soil').val();
			var field_mdd = $('#field_mdd').val();
			var field_mdd1 = $('#field_mdd1').val();
			var field_mdd2 = $('#field_mdd2').val();
			var chainage_no = $('#chainage_no').val();
			var chainage_no1 = $('#chainage_no1').val();
			var chainage_no2 = $('#chainage_no2').val();
			var wet_soil_core = $('#wet_soil_core').val();
			var wet_soil_core1 = $('#wet_soil_core1').val();
			var wet_soil_core2 = $('#wet_soil_core2').val();
			var con_weight = $('#con_weight').val();
			var con_weight1 = $('#con_weight1').val();
			var con_weight2 = $('#con_weight2').val();
			var wt_con_wt_soil = $('#wt_con_wt_soil').val();
			var wt_con_wt_soil1 = $('#wt_con_wt_soil1').val();
			var wt_con_wt_soil2 = $('#wt_con_wt_soil2').val();
			var wt_con_dry_soil = $('#wt_con_dry_soil').val();
			var wt_con_dry_soil1 = $('#wt_con_dry_soil1').val();
			var wt_con_dry_soil2 = $('#wt_con_dry_soil2').val();



			var empty_core = ((+field_mdd) - (+chainage_no));
			$('#empty_core').val((+empty_core).toFixed(2));
			var empty_core = $('#empty_core').val();

			var empty_core1 = ((+field_mdd1) - (+chainage_no1));
			$('#empty_core1').val((+empty_core1).toFixed(2));
			var empty_core1 = $('#empty_core1').val();

			var empty_core2 = ((+field_mdd2) - (+chainage_no2));
			$('#empty_core2').val((+empty_core2).toFixed(2));
			var empty_core2 = $('#empty_core2').val();

			var vol_core = ((+3.14) / (+4) * ((+fdd_1) * (+fdd_1)) * (+mc_soil));
			$('#vol_core').val((+vol_core).toFixed(2));
			var vol_core = $('#vol_core').val();

			var vol_core1 = ((+3.14) / (+4) * ((+fdd_1) * (+fdd_1)) * (+mc_soil));
			$('#vol_core1').val((+vol_core1).toFixed(2));
			var vol_core1 = $('#vol_core1').val();

			var vol_core2 = ((+3.14) / (+4) * ((+fdd_1) * (+fdd_1)) * (+mc_soil));
			$('#vol_core2').val((+vol_core2).toFixed(2));
			var vol_core2 = $('#vol_core2').val();

			var soil_core = ((+empty_core) / (+vol_core));
			$('#soil_core').val((+soil_core).toFixed(2));
			var soil_core = $('#soil_core').val();

			var soil_core1 = ((+empty_core1) / (+vol_core1));
			$('#soil_core1').val((+soil_core1).toFixed(2));
			var soil_core1 = $('#soil_core1').val();

			var soil_core2 = ((+empty_core2) / (+vol_core2));
			$('#soil_core2').val((+soil_core2).toFixed(2));
			var soil_core2 = $('#soil_core2').val();

			var fdd_2 = ((((+wt_con_wt_soil) - (+wt_con_dry_soil)) / ((+wt_con_dry_soil) - (+con_weight))) * (+100));
			$('#fdd_2').val((+fdd_2).toFixed(2));
			var fdd_2 = $('#fdd_2').val();

			var fdd_2_1 = ((((+wt_con_wt_soil1) - (+wt_con_dry_soil1)) / ((+wt_con_dry_soil1) - (+con_weight1))) * (+100));
			$('#fdd_2_1').val((+fdd_2_1).toFixed(2));
			var fdd_2_1 = $('#fdd_2_1').val();

			var fdd_2_2 = ((((+wt_con_wt_soil2) - (+wt_con_dry_soil2)) / ((+wt_con_dry_soil2) - (+con_weight2))) * (+100));
			$('#fdd_2_2').val((+fdd_2_2).toFixed(2));
			var fdd_2_2 = $('#fdd_2_2').val();


			var fdd_3 = ((+100) * (+soil_core)) / ((+100) + (+fdd_2));
			$('#fdd_3').val((+fdd_3).toFixed(2));
			var fdd_3 = $('#fdd_3').val();

			var fdd_3_1 = ((+100) * (+soil_core1)) / ((+100) + (+fdd_2_1));
			$('#fdd_3_1').val((+fdd_3_1).toFixed(2));
			var fdd_3_1 = $('#fdd_3_1').val();

			var fdd_3_2 = ((+100) * (+soil_core2)) / ((+100) + (+fdd_2_2));
			$('#fdd_3_2').val((+fdd_3_2).toFixed(2));
			var fdd_3_2 = $('#fdd_3_2').val();



			var avg_moi = ((+fdd_2) + (+fdd_2_1) + (+fdd_2_2)) / (+3);
			$('#avg_moi').val((+avg_moi).toFixed(2));
			var avg_moi = $('#avg_moi').val();


			var avg_dry = ((+fdd_3) + (+fdd_3_1) + (+fdd_3_2)) / (+3);
			$('#avg_dry').val((+avg_dry).toFixed(2));
			var avg_dry = $('#avg_dry').val();

			var mdd_1 = ((+fdd_3) + (+fdd_3_1) + (+fdd_3_2)) / (+3);
			$('#mdd_1').val((+mdd_1).toFixed(2));
			var mdd_1 = $('#mdd_1').val();

			var fdd_4 = (((+fdd_3) + (+fdd_3_1) + (+fdd_3_2)) / (+mdd_1)) * (+100);
			$('#fdd_4').val((+fdd_4).toFixed(2));
			var fdd_4 = $('#fdd_4').val();

			var fdd_3_2 = ((+fdd_3) + (+fdd_3_1) + (+fdd_3_2)) / (+3);
			$('#fdd_3_2').val((+fdd_3_2).toFixed(2));
			var fdd_3_2 = $('#fdd_3_2').val();




















			// var conweight = "";
			// if (method == "mo_con") {

			// 	var fdd4 = randomNumberFromRange(95.10, 99.85).toFixed(2);
			// 	$('#fdd_4').val(fdd4);
			// 	var fdd_4 = $('#fdd_4').val();

			// 	var fieldmdd = randomNumberFromRange(1.74, 1.79).toFixed(3);
			// 	$('#field_mdd').val(fieldmdd);
			// 	var field_mdd = $('#field_mdd').val();

			// 	var fdd3 = ((+fdd_4) / 100) * (+field_mdd);
			// 	$('#fdd_3').val(fdd3.toFixed(3));
			// 	var fdd_3 = $('#fdd_3').val();

			// 	var fdd2 = randomNumberFromRange(11.8, 14.5).toFixed(2);
			// 	$('#fdd_2').val(fdd2);
			// 	var fdd_2 = $('#fdd_2').val();

			// 	var x_y = randomNumberFromRange(32, 40).toFixed();
			// 	$('#xy').val(x_y);
			// 	var xy = $('#xy').val();
			// 	var xx = ((+fdd_2) / (+100)) * (+xy);
			// 	$('#xans').val(xx.toFixed(2));
			// 	var xans = $('#xans').val();



			// 	var conweight = $('#con_weight').val();

			// 	var wt_con_drysoil = (+conweight) + (+xy);
			// 	$('#wt_con_dry_soil').val(wt_con_drysoil.toFixed(2));
			// 	var wt_con_dry_soil = $('#wt_con_dry_soil').val();

			// 	var fdd1 = (((+100) + (+fdd_2)) * (+fdd_3)) / 100;
			// 	$('#fdd_1').val(fdd1.toFixed(3));
			// 	var fdd_1 = $('#fdd_1').val();

			// 	var eq = (+xy) + (+xans);
			// 	var wt_con_wtsoil = ((+conweight) + (+eq));


			// 	$('#wt_con_wt_soil').val(wt_con_wtsoil.toFixed(2));
			// 	var wt_con_wt_soil = $('#wt_con_wt_soil').val();
			// 	var vol_core = 1020.5;
			// 	var wetsoil_core = (+fdd_1) * (+vol_core);
			// 	$('#wet_soil_core').val(wetsoil_core.toFixed());
			// 	var wet_soil_core = $('#wet_soil_core').val();




			// 	var items1 = Array(980, 1000, 1039, 1040, 1061, 1082, 1050, 1038, 990, 1017);
			// 	var ab_1 = parseInt(items1.length) - 1;
			// 	var randomNumber1 = rand(0, ab_1);
			// 	var randomItem1 = items1[randomNumber1];
			// 	var emptycore = randomItem1;
			// 	$('#empty_core').val(emptycore);
			// 	var empty_core = $('#empty_core').val();


			// 	var soilcore = (+wet_soil_core) + (+empty_core);
			// 	$('#soil_core').val(soilcore.toFixed());
			// 	var soil_core = $('#soil_core').val();


			// 	var f_mdd = $('#field_mdd').val();
			// 	var ec = $('#empty_core').val();
			// 	var volc = $('#vol_core').val();
			// 	var soco = $('#soil_core').val();
			// 	//var ws = $('#wet_soil_core').val();
			// 	//var wd = $('#fdd_1').val();
			// 	//var mc = $('#mc_soil').val();
			// 	var cono = $('#con_no').val();
			// 	var cowt = $('#con_weight').val();
			// 	//var cowts = $('#wt_con_wt_soil').val();
			// 	//var codrs = $('#wt_con_dry_soil').val();
			// 	//var mcdr = $('#fdd_2').val();
			// 	//var fdrd = $('#fdd_3').val();
			// 	//var compac = $('#fdd_4').val();


			// 	var w_s = (+soco) - (+ec);
			// 	$('#wet_soil_core').val(w_s.toFixed());
			// 	var ws = $('#wet_soil_core').val();
			// 	var w_d = (+ws) / (+volc);
			// 	$('#fdd_1').val(w_d.toFixed(3));
			// 	var wd = $('#fdd_1').val();

			// 	var eq1 = (+xy) + (+xans);
			// 	var wt_con_wt_soil_1 = ((+cowt) + (+eq1));
			// 	$('#wt_con_wt_soil').val(wt_con_wt_soil_1.toFixed(2));
			// 	var cowts = $('#wt_con_wt_soil').val();

			// 	var wt_con_dry_soil_1 = (+cowt) + (+xy);
			// 	$('#wt_con_dry_soil').val(wt_con_dry_soil_1.toFixed(2))
			// 	var codrs = $('#wt_con_dry_soil').val();

			// 	var fdd__2 = ((+cowts) - (+codrs)) / ((+codrs) - (+cowt)) * (+100);
			// 	$('#fdd_2').val(fdd__2.toFixed(2));
			// 	var mcdr = $('#fdd_2').val();

			// 	var fd1 = (+wd) * (+100);
			// 	var fd2 = (+mcdr) + (+100);
			// 	var finaleq = (+fd1) / (+fd2);
			// 	$('#fdd_3').val(finaleq.toFixed(3));
			// 	var fdrd = $('#fdd_3').val();

			// 	var erq1 = (+fdrd) / (+f_mdd);

			// 	var comp = (+erq1) * (+100);
			// 	$('#fdd_4').val(comp.toFixed(2));
			// 	var compac = $('#fdd_4').val();
			// } else {
			// 	var fdd4 = randomNumberFromRange(95.10, 99.85).toFixed(2);
			// 	$('#fdd_4').val(fdd4);
			// 	var fdd_4 = $('#fdd_4').val();

			// 	var fieldmdd = randomNumberFromRange(1.74, 1.79).toFixed(3);
			// 	$('#field_mdd').val(fieldmdd);
			// 	var field_mdd = $('#field_mdd').val();

			// 	var fdd3 = ((+fdd_4) / 100) * (+field_mdd);
			// 	$('#fdd_3').val(fdd3.toFixed(3));
			// 	var fdd_3 = $('#fdd_3').val();

			// 	var vol_core = 1020.5;
			// 	var items1 = Array(980, 1000, 1039, 1040, 1061, 1082, 1050, 1038, 990, 1017);
			// 	var ab_1 = parseInt(items1.length) - 1;
			// 	var randomNumber1 = rand(0, ab_1);
			// 	var randomItem1 = items1[randomNumber1];
			// 	var emptycore = randomItem1;
			// 	$('#empty_core').val(emptycore);
			// 	var empty_core = $('#empty_core').val();
			// 	var mcsoil = randomNumberFromRange(11.8, 14.5).toFixed(2);
			// 	$('#mc_soil').val(mcsoil);
			// 	var mc_soil = $('#mc_soil').val();

			// 	var eq1 = (+100) + (+mc_soil);
			// 	var eq2 = (+eq1) * (+fdd_3);
			// 	var fdd1 = (+eq2) / (+100);
			// 	$('#fdd_1').val(fdd1.toFixed(3));
			// 	var fdd_1 = $('#fdd_1').val();

			// 	var wet_soilcore = (+fdd_1) * (+vol_core);
			// 	$('#wet_soil_core').val(wet_soilcore.toFixed());
			// 	var ws = $('#wet_soil_core').val();

			// 	var soilcore = (+ws) + (+empty_core);
			// 	$('#soil_core').val(soilcore.toFixed());


			// }


		}

		function rand(min, max) {
			var offset = min;
			var range = (max - min) + 1;

			var randomNumber = Math.floor(Math.random() * range) + offset;
			return randomNumber;
		}

		function getWeight(wt1) {
			$.ajax({
				dataType: 'JSON',
				type: 'POST',
				url: '<?php echo $base_url; ?>get_contanier.php',
				data: 'action_type=get_excel_record&wt=' + wt1,
				beforeSend: function() {
					document.getElementById("overlay_div").style.display = "block";
				},
				success: function(data) {
					$('#con_weight').val(data.id);
					document.getElementById("overlay_div").style.display = "none";

				}
			});

		}

		// $("input[name='mo_meter']").change(function(e) {
		// 	var methods = $('input[name=mo_meter]:checked').val();
		// 	if (methods == "mo_meter") {
		// 		method = "mo_meter";
		// 		$('#con_no').val("");
		// 		$('#con_weight').val("");
		// 		$('#wt_con_dry_soil').val("");
		// 		$('#wt_con_wt_soil').val("");
		// 		$('#fdd_2').val("");
		// 	} else {

		// 		method = "mo_con";
		// 		var conno = randomNumberFromRange(1, 321).toFixed();
		// 		$('#con_no').val(conno);
		// 		$('#mc_soil').val("");
		// 		var con_no = $('#con_no').val();
		// 		getWeight(con_no);
		// 	}
		// 	$('#field_mdd').val(null);
		// 	$('#empty_core').val(null);
		// 	$('#soil_core').val(null);
		// 	$('#wet_soil_core').val(null);
		// 	$('#fdd_1').val(null);
		// 	$('#fdd_2').val(null);
		// 	$('#fdd_3').val(null);
		// 	$('#fdd_4').val(null);
		// 	$('#mc_soil').val(null);
		// });

		// Vivek : Change

		$('#fdd_1,#mc_soil,#field_mdd,#field_mdd1,#field_mdd2,#chainage_no,#chainage_no1,#chainage_no2,#wet_soil_core,#wet_soil_core1,#wet_soil_core2,#con_weight,#con_weight1,#con_weight2,#wt_con_dry_soil,#wt_con_dry_soil1,#wt_con_dry_soil2,#wt_con_wt_soil,#wt_con_wt_soil1,#wt_con_wt_soil2').change(function() {
			var fdd_1 = $('#fdd_1').val();
			var mc_soil = $('#mc_soil').val();
			var field_mdd = $('#field_mdd').val();
			var field_mdd1 = $('#field_mdd1').val();
			var field_mdd2 = $('#field_mdd2').val();
			var chainage_no = $('#chainage_no').val();
			var chainage_no1 = $('#chainage_no1').val();
			var chainage_no2 = $('#chainage_no2').val();
			var wet_soil_core = $('#wet_soil_core').val();
			var wet_soil_core1 = $('#wet_soil_core1').val();
			var wet_soil_core2 = $('#wet_soil_core2').val();
			var con_weight = $('#con_weight').val();
			var con_weight1 = $('#con_weight1').val();
			var con_weight2 = $('#con_weight2').val();
			var wt_con_wt_soil = $('#wt_con_wt_soil').val();
			var wt_con_wt_soil1 = $('#wt_con_wt_soil1').val();
			var wt_con_wt_soil2 = $('#wt_con_wt_soil2').val();
			var wt_con_dry_soil = $('#wt_con_dry_soil').val();
			var wt_con_dry_soil1 = $('#wt_con_dry_soil1').val();
			var wt_con_dry_soil2 = $('#wt_con_dry_soil2').val();



			var empty_core = ((+field_mdd) - (+chainage_no));
			$('#empty_core').val((+empty_core).toFixed(2));
			var empty_core = $('#empty_core').val();

			var empty_core1 = ((+field_mdd1) - (+chainage_no1));
			$('#empty_core1').val((+empty_core1).toFixed(2));
			var empty_core1 = $('#empty_core1').val();

			var empty_core2 = ((+field_mdd2) - (+chainage_no2));
			$('#empty_core2').val((+empty_core2).toFixed(2));
			var empty_core2 = $('#empty_core2').val();

			var vol_core = ((+3.14) / (+4) * ((+fdd_1) * (+fdd_1)) * (+mc_soil));
			$('#vol_core').val((+vol_core).toFixed(2));
			var vol_core = $('#vol_core').val();

			var vol_core1 = ((+3.14) / (+4) * ((+fdd_1) * (+fdd_1)) * (+mc_soil));
			$('#vol_core1').val((+vol_core1).toFixed(2));
			var vol_core1 = $('#vol_core1').val();

			var vol_core2 = ((+3.14) / (+4) * ((+fdd_1) * (+fdd_1)) * (+mc_soil));
			$('#vol_core2').val((+vol_core2).toFixed(2));
			var vol_core2 = $('#vol_core2').val();

			var soil_core = ((+empty_core) / (+vol_core));
			$('#soil_core').val((+soil_core).toFixed(2));
			var soil_core = $('#soil_core').val();

			var soil_core1 = ((+empty_core1) / (+vol_core1));
			$('#soil_core1').val((+soil_core1).toFixed(2));
			var soil_core1 = $('#soil_core1').val();

			var soil_core2 = ((+empty_core2) / (+vol_core2));
			$('#soil_core2').val((+soil_core2).toFixed(2));
			var soil_core2 = $('#soil_core2').val();

			var fdd_2 = ((((+wt_con_wt_soil) - (+wt_con_dry_soil)) / ((+wt_con_dry_soil) - (+con_weight))) * (+100));
			$('#fdd_2').val((+fdd_2).toFixed(2));
			var fdd_2 = $('#fdd_2').val();

			var fdd_2_1 = ((((+wt_con_wt_soil1) - (+wt_con_dry_soil1)) / ((+wt_con_dry_soil1) - (+con_weight1))) * (+100));
			$('#fdd_2_1').val((+fdd_2_1).toFixed(2));
			var fdd_2_1 = $('#fdd_2_1').val();

			var fdd_2_2 = ((((+wt_con_wt_soil2) - (+wt_con_dry_soil2)) / ((+wt_con_dry_soil2) - (+con_weight2))) * (+100));
			$('#fdd_2_2').val((+fdd_2_2).toFixed(2));
			var fdd_2_2 = $('#fdd_2_2').val();


			var fdd_3 = ((+100) * (+soil_core)) / ((+100) + (+fdd_2));
			$('#fdd_3').val((+fdd_3).toFixed(2));
			var fdd_3 = $('#fdd_3').val();

			var fdd_3_1 = ((+100) * (+soil_core1)) / ((+100) + (+fdd_2_1));
			$('#fdd_3_1').val((+fdd_3_1).toFixed(2));
			var fdd_3_1 = $('#fdd_3_1').val();

			var fdd_3_2 = ((+100) * (+soil_core2)) / ((+100) + (+fdd_2_2));
			$('#fdd_3_2').val((+fdd_3_2).toFixed(2));
			var fdd_3_2 = $('#fdd_3_2').val();



			var avg_moi = ((+fdd_2) + (+fdd_2_1) + (+fdd_2_2)) / (+3);
			$('#avg_moi').val((+avg_moi).toFixed(2));
			var avg_moi = $('#avg_moi').val();


			var avg_dry = ((+fdd_3) + (+fdd_3_1) + (+fdd_3_2)) / (+3);
			$('#avg_dry').val((+avg_dry).toFixed(2));
			var avg_dry = $('#avg_dry').val();

			var mdd_1 = ((+fdd_3) + (+fdd_3_1) + (+fdd_3_2)) / (+3);
			$('#mdd_1').val((+mdd_1).toFixed(2));
			var mdd_1 = $('#mdd_1').val();

			var fdd_4 = (((+fdd_3) + (+fdd_3_1) + (+fdd_3_2)) / (+mdd_1)) * (+100);
			$('#fdd_4').val((+fdd_4).toFixed(2));
			var fdd_4 = $('#fdd_4').val();

			var fdd_3_2 = ((+fdd_3) + (+fdd_3_1) + (+fdd_3_2)) / (+3);
			$('#fdd_3_2').val((+fdd_3_2).toFixed(2));
			var fdd_3_2 = $('#fdd_3_2').val();



		});



		$('#chk_auto').change(function() {
			$('#txtden').css("background-color", "var(--success)");
			auto();
		});


		$('#chk_den').change(function() {
			if (this.checked) {
				$('#txtden').css("background-color", "var(--success)");
				auto();
			} else {
				$('#txtden').css("background-color", "white");
				$('#empty_core').val(null);
				$('#soil_core').val(null);
				$('#wet_soil_core').val(null);
				$('#fdd_1').val(null);
				$('#mc_soil').val(null);
				$('#con_no').val(null);
				$('#con_weight').val(null);
				$('#wt_con_dry_soil').val(null);
				$('#wt_con_wt_soil').val(null);
				$('#fdd_2').val(null);
				$('#fdd_3').val(null);
				$('#fdd_4').val(null);
				$('#field_mdd').val(null);

				$('#field_mdd1').val(null);
				$('#field_mdd2').val(null);
				$('#chainage_no1').val(null);
				$('#chainage_no2').val(null);
				$('#empty_core1').val(null);
				$('#empty_core2').val(null);
				$('#vol_core1').val(null);
				$('#vol_core2').val(null);
				$('#wet_soil_core1').val(null);
				$('#wet_soil_core2').val(null);
				$('#fdd_1_1').val(null);
				$('#fdd_1_2').val(null);
				$('#con_no1').val(null);
				$('#con_no2').val(null);
				$('#wt_con_wt_soil1').val(null);
				$('#wt_con_wt_soil2').val(null);
				$('#wt_con_dry_soil1').val(null);
				$('#wt_con_dry_soil2').val(null);
				$('#fdd_2_1').val(null);
				$('#fdd_2_2').val(null);
				$('#fdd_3_1').val(null);
				$('#fdd_3_2').val(null);
				$('#avg_moi').val(null);
				$('#avg_dry').val(null);
				$('#mdd_1').val(null);

				$('#con_weight1').val(null);
				$('#con_weight2').val(null);
				$('#soil_core1').val(null);
				$('#soil_core2').val(null);
			}
		});




	});


	// code start//
	function randomNumberFromRange(min, max) {
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
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
			url: '<?php echo $base_url; ?>save_core_cutter.php',
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
			var remark = $('#remark').val();
			var sheet = $('#sheet').val();
			var field_mdd = $('#field_mdd').val();

			if (document.getElementById('chk_den').checked) {
				var chk_den = "1";
			} else {
				var chk_den = "0";
			}


			var fdd_1 = $('#fdd_1').val();
			var fdd_2 = $('#fdd_2').val();
			var fdd_3 = $('#fdd_3').val();
			var fdd_4 = $('#fdd_4').val();
			var empty_core = $('#empty_core').val();
			var vol_core = $('#vol_core').val();
			var soil_core = $('#soil_core').val();
			var wet_soil_core = $('#wet_soil_core').val();
			var mc_soil = $('#mc_soil').val();
			var con_no = $('#con_no').val();
			var con_weight = $('#con_weight').val();
			var wt_con_dry_soil = $('#wt_con_dry_soil').val();
			var wt_con_wt_soil = $('#wt_con_wt_soil').val();


			var field_mdd1 = $('#field_mdd1').val();
			var field_mdd2 = $('#field_mdd2').val();
			var chainage_no = $('#chainage_no').val();
			var chainage_no1 = $('#chainage_no1').val();
			var chainage_no2 = $('#chainage_no2').val();
			var empty_core1 = $('#empty_core1').val();
			var empty_core2 = $('#empty_core2').val();
			var vol_core1 = $('#vol_core1').val();
			var vol_core2 = $('#vol_core2').val();
			var wet_soil_core1 = $('#wet_soil_core1').val();
			var wet_soil_core2 = $('#wet_soil_core2').val();
			var fdd_1_1 = $('#fdd_1_1').val();
			var fdd_1_2 = $('#fdd_1_2').val();
			var con_no1 = $('#con_no1').val();
			var con_no2 = $('#con_no2').val();
			var wt_con_wt_soil1 = $('#wt_con_wt_soil1').val();
			var wt_con_wt_soil2 = $('#wt_con_wt_soil2').val();
			var wt_con_dry_soil1 = $('#wt_con_dry_soil1').val();
			var wt_con_dry_soil2 = $('#wt_con_dry_soil2').val();
			var fdd_2_1 = $('#fdd_2_1').val();
			var fdd_2_2 = $('#fdd_2_2').val();
			var fdd_3_1 = $('#fdd_3_1').val();
			var fdd_3_2 = $('#fdd_3_2').val();
			var avg_moi = $('#avg_moi').val();
			var avg_dry = $('#avg_dry').val();
			var mdd_1 = $('#mdd_1').val();

			var con_weight1 = $('#con_weight1').val();
			var con_weight2 = $('#con_weight2').val();
			var soil_core1 = $('#soil_core1').val();
			var soil_core2 = $('#soil_core2').val();


			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&field_mdd=' + field_mdd + '&chk_den=' + chk_den + '&fdd_1=' + fdd_1 + '&fdd_2=' + fdd_2 + '&fdd_3=' + fdd_3 + '&fdd_4=' + fdd_4 + '&ulr=' + ulr + '&empty_core=' + empty_core + '&vol_core=' + vol_core + '&soil_core=' + soil_core + '&wet_soil_core=' + wet_soil_core + '&mc_soil=' + mc_soil + '&con_no=' + con_no + '&con_weight=' + con_weight + '&wt_con_dry_soil=' + wt_con_dry_soil + '&wt_con_wt_soil=' + wt_con_wt_soil + '&field_mdd1=' + field_mdd1 + '&field_mdd2=' + field_mdd2 + '&chainage_no=' + chainage_no + '&chainage_no1=' + chainage_no1 + '&chainage_no2=' + chainage_no2 + '&empty_core1=' + empty_core1 + '&empty_core2=' + empty_core2 + '&vol_core1=' + vol_core1 + '&vol_core2=' + vol_core2 + '&wet_soil_core1=' + wet_soil_core1 + '&wet_soil_core2=' + wet_soil_core2 + '&fdd_1_1=' + fdd_1_1 + '&fdd_1_2=' + fdd_1_2 + '&con_no1=' + con_no1 + '&con_no2=' + con_no2 + '&wt_con_wt_soil1=' + wt_con_wt_soil1 + '&wt_con_wt_soil2=' + wt_con_wt_soil2 + '&wt_con_dry_soil1=' + wt_con_dry_soil1 + '&wt_con_dry_soil2=' + wt_con_dry_soil2 + '&fdd_2_1=' + fdd_2_1 + '&fdd_2_2=' + fdd_2_2 + '&fdd_3_1=' + fdd_3_1 + '&fdd_3_2=' + fdd_3_2 + '&avg_moi=' + avg_moi + '&avg_dry=' + avg_dry + '&mdd_1=' + mdd_1 + '&con_weight1=' + con_weight1 + '&con_weight2=' + con_weight2 + '&soil_core1=' + soil_core1 + '&soil_core2=' + soil_core2 + '&remark=' + remark + '&sheet=' + sheet;

		} else if (type == 'edit') {

			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();
			var remark = $('#remark').val();
			var sheet = $('#sheet').val();
			var field_mdd = $('#field_mdd').val();

			if (document.getElementById('chk_den').checked) {
				var chk_den = "1";
			} else {
				var chk_den = "0";
			}


			var fdd_1 = $('#fdd_1').val();
			var fdd_2 = $('#fdd_2').val();
			var fdd_3 = $('#fdd_3').val();
			var fdd_4 = $('#fdd_4').val();
			var empty_core = $('#empty_core').val();
			var vol_core = $('#vol_core').val();
			var soil_core = $('#soil_core').val();
			var wet_soil_core = $('#wet_soil_core').val();
			var mc_soil = $('#mc_soil').val();
			var con_no = $('#con_no').val();
			var con_weight = $('#con_weight').val();
			var wt_con_dry_soil = $('#wt_con_dry_soil').val();
			var wt_con_wt_soil = $('#wt_con_wt_soil').val();

			var field_mdd1 = $('#field_mdd1').val();
			var field_mdd2 = $('#field_mdd2').val();
			var chainage_no = $('#chainage_no').val();
			var chainage_no1 = $('#chainage_no1').val();
			var chainage_no2 = $('#chainage_no2').val();
			var empty_core1 = $('#empty_core1').val();
			var empty_core2 = $('#empty_core2').val();
			var vol_core1 = $('#vol_core1').val();
			var vol_core2 = $('#vol_core2').val();
			var wet_soil_core1 = $('#wet_soil_core1').val();
			var wet_soil_core2 = $('#wet_soil_core2').val();
			var fdd_1_1 = $('#fdd_1_1').val();
			var fdd_1_2 = $('#fdd_1_2').val();
			var con_no1 = $('#con_no1').val();
			var con_no2 = $('#con_no2').val();
			var wt_con_wt_soil1 = $('#wt_con_wt_soil1').val();
			var wt_con_wt_soil2 = $('#wt_con_wt_soil2').val();
			var wt_con_dry_soil1 = $('#wt_con_dry_soil1').val();
			var wt_con_dry_soil2 = $('#wt_con_dry_soil2').val();
			var fdd_2_1 = $('#fdd_2_1').val();
			var fdd_2_2 = $('#fdd_2_2').val();
			var fdd_3_1 = $('#fdd_3_1').val();
			var fdd_3_2 = $('#fdd_3_2').val();
			var avg_moi = $('#avg_moi').val();
			var avg_dry = $('#avg_dry').val();
			var mdd_1 = $('#mdd_1').val();

			var con_weight1 = $('#con_weight1').val();
			var con_weight2 = $('#con_weight2').val();
			var soil_core1 = $('#soil_core1').val();
			var soil_core2 = $('#soil_core2').val();


			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&field_mdd=' + field_mdd + '&chk_den=' + chk_den + '&fdd_1=' + fdd_1 + '&fdd_2=' + fdd_2 + '&fdd_3=' + fdd_3 + '&fdd_4=' + fdd_4 + '&ulr=' + ulr + '&empty_core=' + empty_core + '&vol_core=' + vol_core + '&soil_core=' + soil_core + '&wet_soil_core=' + wet_soil_core + '&mc_soil=' + mc_soil + '&con_no=' + con_no + '&con_weight=' + con_weight + '&wt_con_dry_soil=' + wt_con_dry_soil + '&wt_con_wt_soil=' + wt_con_wt_soil + '&field_mdd1=' + field_mdd1 + '&field_mdd2=' + field_mdd2 + '&chainage_no=' + chainage_no + '&chainage_no1=' + chainage_no1 + '&chainage_no2=' + chainage_no2 + '&empty_core1=' + empty_core1 + '&empty_core2=' + empty_core2 + '&vol_core1=' + vol_core1 + '&vol_core2=' + vol_core2 + '&wet_soil_core1=' + wet_soil_core1 + '&wet_soil_core2=' + wet_soil_core2 + '&fdd_1_1=' + fdd_1_1 + '&fdd_1_2=' + fdd_1_2 + '&con_no1=' + con_no1 + '&con_no2=' + con_no2 + '&wt_con_wt_soil1=' + wt_con_wt_soil1 + '&wt_con_wt_soil2=' + wt_con_wt_soil2 + '&wt_con_dry_soil1=' + wt_con_dry_soil1 + '&wt_con_dry_soil2=' + wt_con_dry_soil2 + '&fdd_2_1=' + fdd_2_1 + '&fdd_2_2=' + fdd_2_2 + '&fdd_3_1=' + fdd_3_1 + '&fdd_3_2=' + fdd_3_2 + '&avg_moi=' + avg_moi + '&avg_dry=' + avg_dry + '&mdd_1=' + mdd_1 + '&con_weight1=' + con_weight1 + '&con_weight2=' + con_weight2 + '&soil_core1=' + soil_core1 + '&soil_core2=' + soil_core2 + '&remark=' + remark + '&sheet=' + sheet;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_core_cutter.php',
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
			url: '<?php echo $base_url; ?>save_core_cutter.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);
				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);
				$('#ulr').val(data.ulr);
				$('#remark').val(data.remark);
				$('#sheet').val(data.sheet);
				$('#field_mdd').val(data.field_mdd);

				var chk_den = data.chk_den;

				if (chk_den == "1") {
					$('#txtden').css("background-color", "var(--success)");
					$("#chk_den").prop("checked", true);
				} else {
					$('#txtden').css("background-color", "var(--success)");
					$("#chk_den").prop("checked", false);
				}



				$('#fdd_1').val(data.fdd_1);
				$('#fdd_2').val(data.fdd_2);
				$('#fdd_3').val(data.fdd_3);
				$('#fdd_4').val(data.fdd_4);
				$('#empty_core').val(data.empty_core);
				$('#vol_core').val(data.vol_core);
				$('#soil_core').val(data.soil_core);
				$('#wet_soil_core').val(data.wet_soil_core);
				$('#mc_soil').val(data.mc_soil);
				$('#con_no').val(data.con_no);
				$('#con_weight').val(data.con_weight);
				$('#wt_con_wt_soil').val(data.wt_con_wt_soil);
				$('#wt_con_dry_soil').val(data.wt_con_dry_soil);

				$('#field_mdd1').val(data.field_mdd1);
				$('#field_mdd2').val(data.field_mdd2);
				$('#chainage_no').val(data.chainage_no);
				$('#chainage_no1').val(data.chainage_no1);
				$('#chainage_no2').val(data.chainage_no2);
				$('#empty_core1').val(data.empty_core1);
				$('#empty_core2').val(data.empty_core2);
				$('#vol_core1').val(data.vol_core1);
				$('#vol_core2').val(data.vol_core2);
				$('#wet_soil_core1').val(data.wet_soil_core1);
				$('#wet_soil_core2').val(data.wet_soil_core2);
				$('#fdd_1_1').val(data.fdd_1_1);
				$('#fdd_1_2').val(data.fdd_1_2);
				$('#con_no1').val(data.con_no1);
				$('#con_no2').val(data.con_no2);
				$('#wt_con_wt_soil1').val(data.wt_con_wt_soil1);
				$('#wt_con_wt_soil2').val(data.wt_con_wt_soil2);
				$('#wt_con_dry_soil1').val(data.wt_con_dry_soil1);
				$('#wt_con_dry_soil2').val(data.wt_con_dry_soil2);
				$('#fdd_2_1').val(data.fdd_2_1);
				$('#fdd_2_2').val(data.fdd_2_2);
				$('#fdd_3_1').val(data.fdd_3_1);
				$('#fdd_3_2').val(data.fdd_3_2);
				$('#avg_moi').val(data.avg_moi);
				$('#avg_dry').val(data.avg_dry);
				$('#mdd_1').val(data.mdd_1);

				$('#con_weight1').val(data.con_weight1);
				$('#con_weight2').val(data.con_weight2);
				$('#soil_core1').val(data.soil_core1);
				$('#soil_core2').val(data.soil_core2);



				$('#btn_edit_data').show();
				$('#btn_save').hide();
			}
		});
	}
</script>