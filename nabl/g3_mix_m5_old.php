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
						<h2 style="text-align:center;">GSB - III MIX (M5)</h2>
					</div>
					<div class="box-default">
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

								<div class="col-lg-6">
									<div class="form-group">


										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" ReadOnly>
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
																		<label for="inputEmail3" class="control-label">SAMPLE TAKEN :</label>
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
																		<label for="inputEmail3" class="col-sm-2 control-label">53</label>
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
																		<label for="inputEmail3" class="col-sm-2 control-label">26.5</label>
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
																		<label for="inputEmail3" class="col-sm-2 control-label">4.75</label>
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
																		<label for="inputEmail3" class="col-sm-2 control-label">0.075</label>
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
															<div class="col-lg-2">

															</div>
															<div class="col-lg-2">

															</div>
															<div class="col-lg-2">

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
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">FLAKINESS &amp; ELONGATION</label>
																</div>
															</div>

														</div>
														<div class="row">
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label"></label>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<!-- <label for="inputEmail3" class="control-label">Percentage(%)</label>-->
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Material Retained on Sieve, (gm) A</label>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Material Passing Through Thickness Gauge,(gm) B</label>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Material Retained Through Thickness Gauge,(gm) D=A-B</label>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Material Retained on Length Gauge, (gm), C</label>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<!--<label for="inputEmail3" class="control-label">weighted % of the mass passing trought thickness gague=(X x Y)/100</label>-->
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<!--<label for="inputEmail3" class="control-label">Retained Weight From Lenght gague (A1)(gm)</label>-->
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<!--<label for="inputEmail3" class="control-label">% of Mass of total number piece(X)=(A1/B1)x100</label>-->
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<!-- <label for="inputEmail3" class="control-label">Weighted % of the mass Retained thougth LENGTH gauge= (x) X (y) / 100</label>-->
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

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<!--<input type="text" class="form-control" id="p1" name="p1" >-->
																	</div>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="a1" name="a1">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="b1" name="b1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="aa1" name="aa1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="dd1" name="dd1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

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

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="a2" name="a2">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="b2" name="b2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="aa2" name="aa2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="dd2" name="dd2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

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
																		<input type="text" class="form-control" id="s13" name="s13" value="40MM - 31.5MM">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="a3" name="a3">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="b3" name="b3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="aa3" name="aa3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="dd3" name="dd3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

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
																		<input type="text" class="form-control" id="s14" name="s14" value="31.5MM - 25MM">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="a4" name="a4">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="b4" name="b4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="aa4" name="aa4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="dd4" name="dd4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

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
																		<input type="text" class="form-control" id="s15" name="s15" value="25MM - 20MM">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="a5" name="a5">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="b5" name="b5">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="aa5" name="aa5">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="dd5" name="dd5">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

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
																		<input type="text" class="form-control" id="s16" name="s16" value="20MM - 16MM">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="a6" name="a6">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="b6" name="b6">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="aa6" name="aa6">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="dd6" name="dd6">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

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
																		<input type="text" class="form-control" id="s17" name="s17" value="16MM - 12.5MM">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="a7" name="a7">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="b7" name="b7">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="aa7" name="aa7">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="dd7" name="dd7">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
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

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="a8" name="a8">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="b8" name="b8">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="aa8" name="aa8">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="dd8" name="dd8">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
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

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>


															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="a9" name="a9">
																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="b9" name="b9">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="aa9" name="aa9">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="dd9" name="dd9">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>
														</div>
														<br>


														<!--Flakiness Index TOTAL -->
														<div class="row">


															<div class="col-lg-12">
																<div class="form-group">
																	<div class="col-lg-2">
																	</div>
																	<div class="col-sm-1">
																		<label for="inputEmail3" class="control-label">A = </label>
																	</div>
																	<div class="col-sm-1">
																		<input type="text" class="form-control" id="suma" name="suma">
																	</div>
																	<div class="col-sm-1">
																		<input type="text" class="form-control" id="sumb" name="sumb">
																	</div>
																	<div class="col-sm-1">
																		<input type="text" class="form-control" id="sumaa" name="sumaa">
																	</div>
																	<div class="col-sm-1">
																		<input type="text" class="form-control" id="sumdd" name="sumdd">
																	</div>
																</div>
															</div>


														</div>
														<br>
														<div class="row">


															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-4">
																		<label for="inputEmail3" class="control-label">FLAKINESS INDEX, 100*B/A = </label>
																	</div>
																	<div class="col-sm-4">
																		<input type="text" class="form-control" id="fi_index" name="fi_index">
																	</div>
																	<div class="col-sm-4">
																		<label for="inputEmail3" class="control-label">%</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
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
															</div>

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


															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-6">
																		<label for="inputEmail3" class="control-label">Combined Flakiness and Elongation Index (%) =</label>
																	</div>
																	<div class="col-sm-6">
																		<input type="text" class="form-control" id="combined_index" name="combined_index">
																	</div>
																	<!--div class="col-sm-4">
										 <label for="inputEmail3" class="control-label">%</label>
									  </div-->
																</div>
															</div>

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

															<div class="col-lg-4">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_sp">2/3.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_sp" id="chk_sp" value="chk_sp"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">SPECIFIC GRAVITY & WATER ABSORPTION</label>
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
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
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
														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 2-->
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

														<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE OVER-->


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
															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Total weight taken in mould in g (A)</label>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight of material retianed on IS sieve in g (B)</label>
																</div>
															</div>


															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight of material passing through IS sieve 1.70mm C = A-B</label>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight of material passing Abrasion % = C/A X 100</label>
																</div>
															</div>

														</div>
														<br>
														<div class="row">
															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="abr_wt_t_a_1" name="abr_wt_t_a_1">
																	</div>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="abr_wt_t_b_1" name="abr_wt_t_b_1">
																	</div>
																</div>
															</div>


															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control two-digits" id="abr_wt_t_c_1" name="abr_wt_t_c_1">
																	</div>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control two-digits" id="abr_1" name="abr_1">
																	</div>
																</div>
															</div>
														</div>
														<br>
														<br>
														<div class="row">
															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="abr_wt_t_a_2" name="abr_wt_t_a_2">
																	</div>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="abr_wt_t_b_2" name="abr_wt_t_b_2">
																	</div>
																</div>
															</div>


															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control two-digits" id="abr_wt_t_c_2" name="abr_wt_t_c_2">
																	</div>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control two-digits" id="abr_2" name="abr_2">
																	</div>
																</div>
															</div>
														</div>
														<br>

														<div class="row">


															<div class="col-lg-12">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-10 control-label">Average Abrasion Value (%) :</label>

																	<div class="col-sm-2">
																		<input type="text" class="form-control two-digits" id="abr_index" name="abr_index">
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
															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Total Weight taken into Crushing mould in g (A)</label>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight of material passing thhrough IS sieve 2.36mm after crushing load applied in g(B)</label>
																</div>
															</div>




															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Crushing Value % = B/A X 100</label>
																</div>
															</div>

														</div>
														<br>
														<!--Crushing VALUE SR 1-->
														<div class="row">
															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="cr_a_1" name="cr_a_1">
																	</div>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="cr_b_1" name="cr_b_1">
																	</div>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="cru_value_1" name="cru_value_1">
																	</div>
																</div>
															</div>
														</div>
														<br>
														<!--Crushing VALUE SR 2-->
														<div class="row">
															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="cr_a_2" name="cr_a_2">
																	</div>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="cr_b_2" name="cr_b_2">
																	</div>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="cru_value_2" name="cru_value_2">
																	</div>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-lg-3">
																<div class="form-group">

																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-6 control-label">Crushing Value % :</label>
																</div>
															</div>
															<div class="col-sm-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="cru_value" name="cru_value">
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
																		<input type="text" class="form-control" id="soundness" name="soundness">
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
																			<label for="inputEmail3" class="control-label">Weight of Mould + Material in kg</label>
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
																			<label for="inputEmail3" class="control-label">Weight of Mould in kg</label>
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
																			<label for="inputEmail3" class="control-label">Weight of Material in kg</label>
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
																		<label for="inputEmail3" class="col-sm-6 control-label">Bulk Density = Weight of Material / Volume of Mould = </label>
																	</div>
																</div>
																<div class="col-lg-2">
																	<div class="form-group">
																		<input type="text" class="form-control" id="avg_wpm1" name="avg_wom1" readonly>
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
																		<input type="text" class="form-control" id="f_d_1" name="f_d_1" ReadOnly>
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
																		<input type="text" class="form-control" id="f_d_2" name="f_d_2" ReadOnly>
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
																	<input type="text" class="form-control" id="avg_f_d" name="avg_f_d">(Y)
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="avg_f_c" name="avg_f_c">(X)
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
																		<input type="text" class="form-control" id="fines_value" name="fines_value">
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
																	<input type="text" class="form-control" id="alk_4" name="alk_4"> milli mol/Lit.
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
																	<input type="text" class="form-control" id="alk_8" name="alk_8"> milli mol/Lit.
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
																	<label for="inputEmail3" class="control-label">Total Weight taken in mould in g (A):</label>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight of material Passing on IS sieve 2.36 mm in g (B) :</label>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight of material Retaubed on through IS sieve 2.36mm in g (C) :</label>
																</div>
															</div>

															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Aggregate Impact Value = B/A X 100</label>
																</div>
															</div>
														</div>
														<br>
														<!--IMPACT VALUE SR 1-->
														<div class="row">
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

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="imp_value_1" name="imp_value_1">
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

															<div class="col-lg-3">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="imp_value_2" name="imp_value_2">
																	</div>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-lg-3"></div>

															<div class="col-lg-3">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-6 control-label">Impact Value %:</label>
																</div>
															</div>
															<div class="col-sm-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="imp_value" name="imp_value">
																	</div>
																</div>
															</div>
															<div class="col-lg-1"></div>
														</div>
														<!--Impact VALUE OVER-->
													</div>
												</div>
											</div>


										<?php } else if ($r1['test_code'] == "mdd") {
											$test_check .= "mdd,"; ?>

											<div class="panel panel-default" id="mdd1">
												<div class="panel-heading" id="txtmdd">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse13">
															<h4 class="panel-title">
																<b>MDD</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse13" class="panel-collapse collapse">
													<div class="panel-body">
														<!--Impact VALUE Start-->
														<br>
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_mdd">13.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_mdd" id="chk_mdd" value="chk_mdd"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">MDD</label>
																</div>
															</div>

														</div>
														<div class="row">
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Maximum Dry Density</label>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="mdd" name="mdd">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<!--Impact VALUE OVER-->
													</div>
												</div>
											</div>

										<?php } else if ($r1['test_code'] == "omc") {
											$test_check .= "omc,"; ?>

											<div class="panel panel-default" id="omc1">
												<div class="panel-heading" id="txtomc">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse14">
															<h4 class="panel-title">
																<b>OMC</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse14" class="panel-collapse collapse">
													<div class="panel-body">
														<!--Impact VALUE Start-->
														<br>
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_omc">14.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_omc" id="chk_omc" value="chk_omc"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">OMC</label>
																</div>
															</div>

														</div>
														<div class="row">
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Optimum Moisture Content</label>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="omc" name="omc">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<!--Impact VALUE OVER-->
													</div>
												</div>
											</div>

										<?php } else if ($r1['test_code'] == "cbr") {
											$test_check .= "cbr,"; ?>

											<div class="panel panel-default" id="cbr1">
												<div class="panel-heading" id="txtcbr">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse50">
															<h4 class="panel-title">
																<b>CBR</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse50" class="panel-collapse collapse">
													<div class="panel-body">
														<!--Impact VALUE Start-->
														<br>
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_cbr">15.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_cbr" id="chk_cbr" value="chk_cbr"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">CBR</label>
																</div>
															</div>

														</div>
														<div class="row">
															<div class="col-lg-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">California Bearing Ratio</label>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="cbr" name="cbr">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<!--Impact VALUE OVER-->
													</div>
												</div>
											</div>


									<?php
										}
									}	?>
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
													$querys_job1 = "SELECT * FROM gsb_mix_3_m5 WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
														<a target='_blank' href="<?php echo $base_url; ?>print_report/print_g3_m5.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

													</div>

												<?php// } ?>
												<div class="col-sm-2">
													<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_kapchi_20.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>&&tbl_name=gsb_mix_3_m5" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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
													$query = "select * from gsb_mix_3_m5 WHERE lab_no='$aa'  and `is_deleted`='0'";

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

		function mdd_auto() {
			var mdd = randomNumberFromRange(2.17, 2.20).toFixed(2);
			$('#mdd').val(mdd);
			$('#txtmdd').css("background-color", "var(--success)");
		}

		$('#chk_mdd').change(function() {
			if (this.checked) {
				mdd_auto();
			} else {
				$('#mdd').val(null);
				$('#txtmdd').css("background-color", "white");
			}
		});
		$('#mdd').change(function() {
			$('#txtmdd').css("background-color", "var(--success)");
		});

		function omc_auto() {
			var omc = randomNumberFromRange(5.86, 6.15).toFixed(2);
			$('#omc').val(omc);
			$('#txtomc').css("background-color", "var(--success)");
		}
		$('#chk_omc').change(function() {
			if (this.checked) {
				omc_auto();
			} else {
				$('#omc').val(null);
				$('#txtomc').css("background-color", "white");
			}
		});
		$('#omc').change(function() {
			$('#txtomc').css("background-color", "var(--success)");
		});

		function cbr_auto() {
			var cbr = randomNumberFromRange(31.0, 33.0).toFixed(1);
			$('#cbr').val(cbr);
			$('#txtcbr').css("background-color", "var(--success)");
		}
		$('#chk_cbr').change(function() {
			if (this.checked) {
				cbr_auto();
			} else {
				$('#cbr').val(null);
				$('#txtcbr').css("background-color", "white");
			}
		});
		$('#cbr').change(function() {
			$('#txtcbr').css("background-color", "var(--success)");
		});

		//ABRASION INDEX
		function abr_auto() {
			$('#txtabr').css("background-color", "var(--success)");
			var abr_grading = $("#abr_grading").val();
			if (abr_grading == "A") {
				var abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
				var abr_sphere = 12;
				var abr_num_revo = 500;
				$('#abr_sphere').val(abr_sphere);
				$('#abr_num_revo').val(abr_num_revo);
				$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));

				var abr_index = randomNumberFromRange(16.0, 23.1);
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

				var abr_index = randomNumberFromRange(16.0, 23.1);
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

				var abr_index = randomNumberFromRange(16.0, 23.1);
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

				var abr_index = randomNumberFromRange(16.0, 23.1);
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

				var abr_index = randomNumberFromRange(16.0, 23.1);
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

				var abr_index = randomNumberFromRange(16.0, 23.1);
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

				var abr_index = randomNumberFromRange(16.0, 23.1);
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
		}
		$('#chk_abr').change(function() {
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

		$("#abr_wt_t_a_1").change(function() {

			$('#txtabr').css("background-color", "var(--success)");
			abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
			abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
			abr_wt_t_c_1 = (+abr_wt_t_a_1) - (+abr_wt_t_b_1);
			$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed());
			var abr_wt_t_c1 = $('#abr_wt_t_c_1').val();
			var temp = (+abr_wt_t_c1) / (+abr_wt_t_a_1);
			var abr_1 = (+temp) * 100;
			$('#abr_1').val(abr_1.toFixed(2));
			var abr1 = $('#abr_1').val();
			var abr2 = $('#abr_2').val();
			var abr_index = ((+abr1) + (+abr2)) / 2;
			$('#abr_index').val(abr_index.toFixed(1));

		});
		$("#abr_wt_t_a_2").change(function() {
			$('#txtabr').css("background-color", "var(--success)");
			abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
			abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();
			abr_wt_t_c_2 = (+abr_wt_t_a_2) - (+abr_wt_t_b_2);
			$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed());
			var abr_wt_t_c2 = $('#abr_wt_t_c_2').val();
			var temp2 = (+abr_wt_t_c2) / (+abr_wt_t_a_2);
			var abr_2 = (+temp2) * 100;
			$('#abr_2').val(abr_2.toFixed(2));
			var abr1 = $('#abr_1').val();
			var abr2 = $('#abr_2').val();
			var abr_index = ((+abr1) + (+abr2)) / 2;
			$('#abr_index').val(abr_index.toFixed(1));

		});

		$("#abr_wt_t_b_1").change(function() {

			$('#txtabr').css("background-color", "var(--success)");
			abr_wt_t_a_1 = $('#abr_wt_t_a_1').val();
			abr_wt_t_b_1 = $('#abr_wt_t_b_1').val();
			abr_wt_t_c_1 = (+abr_wt_t_a_1) - (+abr_wt_t_b_1);
			$('#abr_wt_t_c_1').val(abr_wt_t_c_1.toFixed());
			var abr_wt_t_c1 = $('#abr_wt_t_c_1').val();
			var temp = (+abr_wt_t_c1) / (+abr_wt_t_a_1);
			var abr_1 = (+temp) * 100;
			$('#abr_1').val(abr_1.toFixed(2));
			var abr1 = $('#abr_1').val();
			var abr2 = $('#abr_2').val();
			var abr_index = ((+abr1) + (+abr2)) / 2;
			$('#abr_index').val(abr_index.toFixed(1));

		});

		$("#abr_wt_t_b_2").change(function() {
			$('#txtabr').css("background-color", "var(--success)");
			abr_wt_t_a_2 = $('#abr_wt_t_a_2').val();
			abr_wt_t_b_2 = $('#abr_wt_t_b_2').val();
			abr_wt_t_c_2 = (+abr_wt_t_a_2) - (+abr_wt_t_b_2);
			$('#abr_wt_t_c_2').val(abr_wt_t_c_2.toFixed());
			var abr_wt_t_c2 = $('#abr_wt_t_c_2').val();
			var temp2 = (+abr_wt_t_c2) / (+abr_wt_t_a_2);
			var abr_2 = (+temp2) * 100;
			$('#abr_2').val(abr_2.toFixed(2));
			var abr1 = $('#abr_1').val();
			var abr2 = $('#abr_2').val();
			var abr_index = ((+abr1) + (+abr2)) / 2;
			$('#abr_index').val(abr_index.toFixed(1));

		});

		$("#abr_index").change(function() {
			$('#txtabr').css("background-color", "var(--success)");
			if ($("#chk_abr").is(':checked')) {
				abr_grading = $("#abr_grading").val();
				if (abr_grading == "A") {
					var abr_weight_charge = randomNumberFromRange(4975.00, 5025.00);
					var abr_sphere = 12;
					var abr_num_revo = 500;
					$('#abr_sphere').val(abr_sphere);
					$('#abr_num_revo').val(abr_num_revo);
					$('#abr_weight_charge').val(abr_weight_charge.toFixed(2));

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
			}


		});

		function sp_auto() {
			$('#txtwtr').css("background-color", "var(--success)");
			var sp_specific_gravity = randomNumberFromRange(2.700, 2.750).toFixed(3); //(sp_specific_gravity)
			var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.010, 0.010); //(sp_specific_gravity_1)_1
			var tems1 = (parseFloat(sp_specific_gravity) * 2);
			var sp_specific_gravity_2 = (parseFloat(tems1) - parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
			var sp_water_abr = randomNumberFromRange(1.00, 1.25).toFixed(2); // (sp_water_abr)_1
			var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.02, 0.02) ////(sp_water_abr_1)_1
			var tems11 = (parseFloat(sp_water_abr) * 2);
			var sp_water_abr_2 = (parseFloat(tems11) - parseFloat(sp_water_abr_1)); // (sp_water_abr_2)_1 

			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 4));
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 4));
			$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 4));
			$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));
			$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));
			$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
			$('#sp_wt_st_1').val(2000);
			$('#sp_wt_st_2').val(2000);

			var a1 = $('#sp_wt_st_1').val();
			var a2 = $('#sp_wt_st_2').val();
			var g1 = $('#sp_specific_gravity_1').val();
			var g2 = $('#sp_specific_gravity_2').val();
			var wtr1 = $('#sp_water_abr_1').val();
			var wtr2 = $('#sp_water_abr_2').val();
			var equp1 = a1 * 100;
			var equp2 = a2 * 100;
			var eqdn1 = (+wtr1) + 100;
			var eqdn2 = (+wtr2) + 100;
			var sp_w_s_1 = equp1 / eqdn1;
			var sp_w_s_2 = equp2 / eqdn2;
			$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));
			$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));
			var b1 = $('#sp_w_s_1').val();
			var b2 = $('#sp_w_s_2').val();
			var sp_w_sur_1 = (+a1) - ((+b1) / (+g1));
			var sp_w_sur_2 = (+a2) - ((+b2) / (+g2));
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
			$('#sp_sample_ca').val(sp_sample_ca);
			//sidhu
			var aa1 = $('#sp_wt_st_1').val();
			var aa2 = $('#sp_wt_st_2').val();
			var bb1 = $('#sp_w_s_1').val();
			var bb2 = $('#sp_w_s_2').val();
			var cc1 = $('#sp_w_sur_1').val();
			var cc2 = $('#sp_w_sur_2').val();


			var tempr1 = (+aa1) - (+cc1);
			var tempr2 = (+aa2) - (+cc2);
			var spg1 = (+bb1) / (+tempr1);
			var spg2 = (+bb2) / (+tempr2);

			$('#sp_specific_gravity_1').val(spg1.toFixed(3));
			$('#sp_specific_gravity_2').val(spg2.toFixed(3));

			var spg_1 = $('#sp_specific_gravity_1').val();
			var spg_2 = $('#sp_specific_gravity_2').val();

			var avg_t = (+spg_1) + (+spg_2);
			var sp_specific_ans = (+avg_t) / 2;
			$('#sp_specific_gravity').val(sp_specific_ans.toFixed(3));

			var temp_wtr1 = (+aa1) - (+bb1);
			var temp_wtr2 = (+aa2) - (+bb2);

			var t_wtr1 = (+temp_wtr1) / (+bb1);
			var t_wtr2 = (+temp_wtr2) / (+bb2);

			var wtr11 = (+t_wtr1) * 100;
			var wtr22 = (+t_wtr2) * 100;

			$('#sp_water_abr_1').val(wtr11.toFixed(2));
			$('#sp_water_abr_2').val(wtr22.toFixed(2));
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

				$('#sp_specific_gravity_1').val(null);
				$('#sp_specific_gravity_2').val(null);
				$('#sp_specific_gravity').val(null);
				$('#sp_water_abr_1').val(null);
				$('#sp_water_abr_2').val(null);
				$('#sp_water_abr').val(null);
				$('#sp_sample_ca').val(null);
			}
		});

		$('#sp_specific_gravity').change(function() {

			$('#txtwtr').css("background-color", "var(--success)");
			if ($("#chk_sp").is(':checked')) {
				var sp_temp = randomNumberFromRange(25.0, 27.0);
				$('#sp_temp').val(sp_temp.toString().substring(0, sp_temp.toString().indexOf(".") + 2));
				var sp_specific_gravity = $("#sp_specific_gravity").val(); //(sp_specific_gravity)
				var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.010, 0.010); //(sp_specific_gravity_1)_1
				var tems1 = (parseFloat(sp_specific_gravity) * 2);
				var sp_specific_gravity_2 = (parseFloat(tems1) - parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
				var sp_water_abr = randomNumberFromRange(1.00, 1.25).toFixed(2); // (sp_water_abr)_1
				var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.02, 0.02) ////(sp_water_abr_1)_1
				var tems11 = (parseFloat(sp_water_abr) * 2);
				var sp_water_abr_2 = (parseFloat(tems11) - parseFloat(sp_water_abr_1)); // (sp_water_abr_2)_1 

				$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 4));
				$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 4));
				$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));
				$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));
				$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
				$('#sp_wt_st_1').val(2000);
				$('#sp_wt_st_2').val(2000);

				var a1 = $('#sp_wt_st_1').val();
				var a2 = $('#sp_wt_st_2').val();
				var g1 = $('#sp_specific_gravity_1').val();
				var g2 = $('#sp_specific_gravity_2').val();
				var wtr1 = $('#sp_water_abr_1').val();
				var wtr2 = $('#sp_water_abr_2').val();
				var equp1 = a1 * 100;
				var equp2 = a2 * 100;
				var eqdn1 = (+wtr1) + 100;
				var eqdn2 = (+wtr2) + 100;
				var sp_w_s_1 = equp1 / eqdn1;
				var sp_w_s_2 = equp2 / eqdn2;
				$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));
				$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));
				var b1 = $('#sp_w_s_1').val();
				var b2 = $('#sp_w_s_2').val();
				var sp_w_sur_1 = (+a1) - ((+b1) / (+g1));
				var sp_w_sur_2 = (+a2) - ((+b2) / (+g2));
				$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));
				$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
			}


		});

		$('#sp_water_abr').change(function() {
			$('#txtwtr').css("background-color", "var(--success)");
			if ($("#chk_sp").is(':checked')) {
				var sp_temp = randomNumberFromRange(25.0, 27.0);
				$('#sp_temp').val(sp_temp.toString().substring(0, sp_temp.toString().indexOf(".") + 2));
				var sp_specific_gravity = $("#sp_specific_gravity").val(); //(sp_specific_gravity)
				var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.010, 0.010); //(sp_specific_gravity_1)_1
				var tems1 = (parseFloat(sp_specific_gravity) * 2);
				var sp_specific_gravity_2 = (parseFloat(tems1) - parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
				var sp_water_abr = $("#sp_water_abr").val(); // (sp_water_abr)_1
				var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.02, 0.02) ////(sp_water_abr_1)_1
				var tems11 = (parseFloat(sp_water_abr) * 2);
				var sp_water_abr_2 = (parseFloat(tems11) - parseFloat(sp_water_abr_1)); // (sp_water_abr_2)_1 

				$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 4));
				$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 4));
				$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));
				$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));

				$('#sp_wt_st_1').val(2000);
				$('#sp_wt_st_2').val(2000);

				var a1 = $('#sp_wt_st_1').val();
				var a2 = $('#sp_wt_st_2').val();
				var g1 = $('#sp_specific_gravity_1').val();
				var g2 = $('#sp_specific_gravity_2').val();
				var wtr1 = $('#sp_water_abr_1').val();
				var wtr2 = $('#sp_water_abr_2').val();
				var equp1 = a1 * 100;
				var equp2 = a2 * 100;
				var eqdn1 = (+wtr1) + 100;
				var eqdn2 = (+wtr2) + 100;
				var sp_w_s_1 = equp1 / eqdn1;
				var sp_w_s_2 = equp2 / eqdn2;
				$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));
				$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));
				var b1 = $('#sp_w_s_1').val();
				var b2 = $('#sp_w_s_2').val();
				var sp_w_sur_1 = (+a1) - ((+b1) / (+g1));
				var sp_w_sur_2 = (+a2) - ((+b2) / (+g2));
				$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));
				$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
			}

		});


		$("#sp_w_sur_1").change(function() {
			$('#txtwtr').css("background-color", "var(--success)");
			var sp_w_sur_1 = $('#sp_w_sur_1').val();
			sp_wt_st_1 = $('#sp_wt_st_1').val();
			var sp_w_s_1 = $('#sp_w_s_1').val();
			sp_specific_gravity_1 = parseFloat(sp_w_s_1) / (parseFloat(sp_wt_st_1) - parseFloat(sp_w_sur_1));
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 4));
			sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
			var sp_specific_gravity = (parseFloat(sp_specific_gravity_1) + parseFloat(sp_specific_gravity_2)) / 2;
			$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 4));
			sp_water_abr_1 = (100 * (parseFloat(sp_w_sur_1) - parseFloat(sp_w_s_1))) / parseFloat(sp_w_s_1);
			$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));
			sp_water_abr_2 = $('#sp_water_abr_2').val();
			var sp_water_abr = (parseFloat(sp_water_abr_1) + parseFloat(sp_water_abr_2)) / 2;
			$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
		});

		$("#sp_w_sur_2").change(function() {
			$('#txtwtr').css("background-color", "var(--success)");
			var sp_w_sur_2 = $('#sp_w_sur_2').val();
			sp_wt_st_2 = $('#sp_wt_st_2').val();
			var sp_w_s_2 = $('#sp_w_s_2').val();
			sp_specific_gravity_2 = parseFloat(sp_w_s_2) / (parseFloat(sp_w_sur_1) - parseFloat(sp_w_sur_2));
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 4));
			sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
			var sp_specific_gravity = (parseFloat(sp_specific_gravity_1) + parseFloat(sp_specific_gravity_2)) / 2;
			$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 4));

			sp_water_abr_2 = (100 * (parseFloat(sp_w_sur_2) - parseFloat(sp_w_s_2))) / parseFloat(sp_w_s_2);
			$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));
			sp_water_abr_1 = $('#sp_water_abr_1').val();
			var sp_water_abr = (parseFloat(sp_water_abr_1) + parseFloat(sp_water_abr_2)) / 2;
			$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
		});
		$("#sp_w_s_1").change(function() {
			$('#txtwtr').css("background-color", "var(--success)");
			var sp_w_sur_1 = $('#sp_w_sur_1').val();
			sp_wt_st_1 = $('#sp_wt_st_1').val();
			var sp_w_s_1 = $('#sp_w_s_1').val();
			sp_specific_gravity_1 = parseFloat(sp_w_s_1) / (parseFloat(sp_wt_st_1) - parseFloat(sp_w_sur_1));
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 4));
			sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
			var sp_specific_gravity = (parseFloat(sp_specific_gravity_1) + parseFloat(sp_specific_gravity_2)) / 2;
			$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 4));

			sp_water_abr_1 = (100 * (parseFloat(sp_w_sur_1) - parseFloat(sp_w_s_1))) / parseFloat(sp_w_s_1);
			$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));
			sp_water_abr_2 = $('#sp_water_abr_2').val();
			var sp_water_abr = (parseFloat(sp_water_abr_1) + parseFloat(sp_water_abr_2)) / 2;
			$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
		});
		$("#sp_w_s_2").change(function() {
			$('#txtwtr').css("background-color", "var(--success)");
			var sp_w_sur_2 = $('#sp_w_sur_2').val();
			sp_wt_st_2 = $('#sp_wt_st_2').val();
			var sp_w_s_2 = $('#sp_w_s_2').val();
			sp_specific_gravity_2 = parseFloat(sp_w_s_2) / (parseFloat(sp_wt_st_2) - parseFloat(sp_w_sur_2));
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 4));
			sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
			var sp_specific_gravity = (parseFloat(sp_specific_gravity_1) + parseFloat(sp_specific_gravity_2)) / 2;
			$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 4));
			sp_water_abr_2 = (100 * (parseFloat(sp_w_sur_2) - parseFloat(sp_w_s_2))) / parseFloat(sp_w_s_2);
			$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));
			sp_water_abr_1 = $('#sp_water_abr_1').val();
			var sp_water_abr = (parseFloat(sp_water_abr_1) + parseFloat(sp_water_abr_2)) / 2;
			$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
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

		$('#s6total').change(function() {
			$('#txtsou').css("background-color", "var(--success)");
			if ($("#chk_sou").is(':checked')) {

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
		});

		$('#s68,#s69').change(function() {
			$('#txtsou').css("background-color", "var(--success)");
			if ($("#chk_sou").is(':checked')) {

				var s_38 = $('#s38').val();
				var s_39 = $('#s39').val();
				var s_68 = $('#s68').val();
				var s_69 = $('#s69').val();
				var s6total1 = (+s_68) + (+s_69);
				$('#s6total').val(s6total1.toFixed(2));
				$('#soundness').val(s6total1.toFixed(1));
				/* $('#s61').val(soundness); */
				//$('#s67').val(s67.toFixed(2));
				/* $('#s64').val(soundness);
				$('#s60').val(soundness); */

				var s_temp1 = (+s_68) * 100;
				var s_temp2 = (+s_69) * 100;
				var s58 = (+s_temp1) / (+s_38);
				var s59 = (+s_temp2) / (+s_39);
				$('#s58').val(s58.toFixed(1));
				$('#s59').val(s59.toFixed(1));
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

		});

		$('#s58,#s38,#s59,#s39').change(function() {
			$('#txtsou').css("background-color", "var(--success)");
			var s_38 = $('#s38').val();
			var s_39 = $('#s39').val();
			var s_58 = $('#s58').val();
			var s_59 = $('#s59').val();
			var s_temp1 = (+s_38) * (+s_58);
			var s_temp2 = (+s_39) * (+s_59);
			var s68 = (+s_temp1) / 100;
			var s69 = (+s_temp2) / 100;
			$('#s68').val(s68.toFixed(2));
			$('#s69').val(s69.toFixed(2));
			var s_6_8 = $('#s68').val();
			var s_6_9 = $('#s69').val();
			var s6total_1 = (+s_6_8) + (+s_6_9);
			$('#s6total').val(s6total_1.toFixed(2));
			$('#soundness').val(s6total_1.toFixed(1));

		});


		function flk_auto() {
			$('#txtflk').css("background-color", "var(--success)");
			$('#fi_index').val(0);
			$('#ei_index').val(0);
			$('#combined_index').val(0);

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

			}

		});

		function general_flk_elo1() {
			$('#txtflk').css("background-color", "var(--success)");
			var combined_index = randomNumberFromRange(16.0, 25.0).toFixed(1);
			$('#combined_index').val(combined_index);
			var combined = $('#combined_index').val();

			var fi_index = (+combined) * 0.52;
			$('#fi_index').val(fi_index.toFixed(1));
			var fiindex = $('#fi_index').val();

			var ei_index = (+combined) - (+fiindex);
			$('#ei_index').val(ei_index.toFixed(1));
			var eiindex = $('#ei_index').val();

			var suma = randomNumberFromRange(11500, 14500).toFixed();
			$('#suma').val(suma);
			var sum_a = $('#suma').val();

			var sumb = ((+fiindex) * (+sum_a)) / 100;
			$('#sumb').val(sumb.toFixed());
			var sum_b = $('#sumb').val();

			//var a1 = (+sum_a) * 0.40;
			//$('#a1').val(a1.toFixed());
			var a_1 = $('#a1').val();
			//var a2 = (+sum_a) * 0.40;
			//$('#a2').val(a2.toFixed());
			var a_2 = $('#a2').val();
			//var a3 = (+sum_a) * 0.40;
			//$('#a3').val(a3.toFixed());
			var a_3 = $('#a3').val();
			//var a4 = (+sum_a) * 0.40;
			//$('#a4').val(a4.toFixed());
			var a_4 = $('#a4').val();

			var a5 = (+sum_a) * 0.40;
			$('#a5').val(a5.toFixed());
			var a_5 = $('#a5').val();
			var a6 = (+sum_a) * 0.27;
			$('#a6').val(a6.toFixed());
			var a_6 = $('#a6').val();
			var a7 = (+sum_a) * 0.19;
			$('#a7').val(a7.toFixed());
			var a_7 = $('#a7').val();
			var a8 = (+sum_a) * 0.10;
			$('#a8').val(a8.toFixed());
			var a_8 = $('#a8').val();
			var a9 = (+sum_a) - ((+a_1) + (+a_2) + (+a_3) + (+a_4) + (+a_5) + (+a_6) + (+a_7) + (+a_8));
			$('#a9').val(a9.toFixed());
			var a_9 = $('#a9').val();


			//var b1 = (+sum_b) * 0.40;
			//$('#b1').val(b1.toFixed());
			var b_1 = $('#b1').val();
			//var b2 = (+sum_b) * 0.40;
			//$('#b2').val(b2.toFixed());
			var b_2 = $('#b2').val();
			//var b3 = (+sum_b) * 0.40;
			//$('#b3').val(b3.toFixed());
			var b_3 = $('#b3').val();
			//var b4 = (+sum_b) * 0.40;
			//$('#b4').val(b4.toFixed());
			var b_4 = $('#b4').val();

			var b5 = (+sum_b) * 0.41;
			$('#b5').val(b5.toFixed());
			var b_5 = $('#b5').val();
			var b6 = (+sum_b) * 0.255;
			$('#b6').val(b6.toFixed());
			var b_6 = $('#b6').val();
			var b7 = (+sum_b) * 0.205;
			$('#b7').val(b7.toFixed());
			var b_7 = $('#b7').val();
			var b8 = (+sum_b) * 0.07;
			$('#b8').val(b8.toFixed());
			var b_8 = $('#b8').val();
			var b9 = (+sum_b) - ((+b_1) + (+b_2) + (+b_3) + (+b_4) + (+b_5) + (+b_6) + (+b_7) + (+b_8));
			$('#b9').val(b9.toFixed());
			var b_9 = $('#b9').val();

			//var aa1 = (+a_1) - (+b_1);
			//$('#aa1').val(aa1.toFixed());
			var aa_1 = $('#aa1').val();
			//var aa2 = (+a_2) - (+b_2);
			//$('#aa2').val(aa2.toFixed());
			var aa_2 = $('#aa2').val();
			//var aa3 = (+a_3) - (+b_3);
			//$('#aa3').val(aa3.toFixed());
			var aa_3 = $('#aa3').val();
			//var aa4 = (+a_4) - (+b_4);
			//$('#aa4').val(aa4.toFixed());
			var aa_4 = $('#aa4').val();
			var aa5 = (+a_5) - (+b_5);
			$('#aa5').val(aa5.toFixed());
			var aa_5 = $('#aa5').val();
			var aa6 = (+a_6) - (+b_6);
			$('#aa6').val(aa6.toFixed());
			var aa_6 = $('#aa6').val();
			var aa7 = (+a_7) - (+b_7);
			$('#aa7').val(aa7.toFixed());
			var aa_7 = $('#aa7').val();
			var aa8 = (+a_8) - (+b_8);
			$('#aa8').val(aa8.toFixed());
			var aa_8 = $('#aa8').val();
			var aa9 = (+a_9) - (+b_9);
			$('#aa9').val(aa9.toFixed());
			var aa_9 = $('#aa9').val();

			var sumaa = (+aa_1) + (+aa_2) + (+aa_3) + (+aa_4) + (+aa_5) + (+aa_6) + (+aa_7) + (+aa_8) + (+aa_9);
			$('#sumaa').val(sumaa.toFixed());
			var sum_aa = $('#sumaa').val();

			var sumdd = ((+eiindex) / (+100)) * (+sum_aa);
			$('#sumdd').val(sumdd.toFixed());
			var sum_dd = $('#sumdd').val();


			//var dd1 = (+sum_dd) * 0.40;
			//$('#dd1').val(dd1.toFixed());
			var dd_1 = $('#dd1').val();
			//var dd2 = (+sum_dd) * 0.40;
			//$('#dd2').val(dd2.toFixed());
			var dd_2 = $('#dd2').val();
			//var dd3 = (+sum_dd) * 0.40;
			//$('#dd3').val(dd3.toFixed());
			var dd_3 = $('#dd3').val();
			//var dd4 = (+sum_dd) * 0.40;
			//$('#dd4').val(dd4.toFixed());
			var dd_4 = $('#dd4').val();

			var dd5 = (+sum_dd) * 0.4;
			$('#dd5').val(dd5.toFixed());
			var dd_5 = $('#dd5').val();
			var dd6 = (+sum_dd) * 0.25;
			$('#dd6').val(dd6.toFixed());
			var dd_6 = $('#dd6').val();
			var dd7 = (+sum_dd) * 0.21;
			$('#dd7').val(dd7.toFixed());
			var dd_7 = $('#dd7').val();
			var dd8 = (+sum_dd) * 0.075;
			$('#dd8').val(dd8.toFixed());
			var dd_8 = $('#dd8').val();
			var dd9 = (+sum_dd) - ((+dd_1) + (+dd_2) + (+dd_3) + (+dd_4) + (+dd_5) + (+dd_6) + (+dd_7) + (+dd_8));
			$('#dd9').val(dd9.toFixed());
			var dd_9 = $('#dd9').val();




		}

		$('#combined_index').change(function() {
			$('#txtflk').css("background-color", "var(--success)");
			if ($("#chk_flk").is(':checked')) {
				//var combined_index = randomNumberFromRange(25.8,27.0).toFixed(1);
				//$('#combined_index').val(combined_index);
				var combined = $('#combined_index').val();

				var fi_index = (+combined) * 0.52;
				$('#fi_index').val(fi_index.toFixed(1));
				var fiindex = $('#fi_index').val();

				var ei_index = (+combined) - (+fiindex);
				$('#ei_index').val(ei_index.toFixed(1));
				var eiindex = $('#ei_index').val();

				var suma = randomNumberFromRange(11500, 14500).toFixed();
				$('#suma').val(suma);
				var sum_a = $('#suma').val();

				var sumb = ((+fiindex) * (+sum_a)) / 100;
				$('#sumb').val(sumb.toFixed());
				var sum_b = $('#sumb').val();

				//var a1 = (+sum_a) * 0.40;
				//$('#a1').val(a1.toFixed());
				var a_1 = $('#a1').val();
				//var a2 = (+sum_a) * 0.40;
				//$('#a2').val(a2.toFixed());
				var a_2 = $('#a2').val();
				//var a3 = (+sum_a) * 0.40;
				//$('#a3').val(a3.toFixed());
				var a_3 = $('#a3').val();
				//var a4 = (+sum_a) * 0.40;
				//$('#a4').val(a4.toFixed());
				var a_4 = $('#a4').val();

				var a5 = (+sum_a) * 0.40;
				$('#a5').val(a5.toFixed());
				var a_5 = $('#a5').val();
				var a6 = (+sum_a) * 0.27;
				$('#a6').val(a6.toFixed());
				var a_6 = $('#a6').val();
				var a7 = (+sum_a) * 0.19;
				$('#a7').val(a7.toFixed());
				var a_7 = $('#a7').val();
				var a8 = (+sum_a) * 0.10;
				$('#a8').val(a8.toFixed());
				var a_8 = $('#a8').val();
				var a9 = (+sum_a) - ((+a_1) + (+a_2) + (+a_3) + (+a_4) + (+a_5) + (+a_6) + (+a_7) + (+a_8));
				$('#a9').val(a9.toFixed());
				var a_9 = $('#a9').val();


				//var b1 = (+sum_b) * 0.40;
				//$('#b1').val(b1.toFixed());
				var b_1 = $('#b1').val();
				//var b2 = (+sum_b) * 0.40;
				//$('#b2').val(b2.toFixed());
				var b_2 = $('#b2').val();
				//var b3 = (+sum_b) * 0.40;
				//$('#b3').val(b3.toFixed());
				var b_3 = $('#b3').val();
				//var b4 = (+sum_b) * 0.40;
				//$('#b4').val(b4.toFixed());
				var b_4 = $('#b4').val();

				var b5 = (+sum_b) * 0.41;
				$('#b5').val(b5.toFixed());
				var b_5 = $('#b5').val();
				var b6 = (+sum_b) * 0.255;
				$('#b6').val(b6.toFixed());
				var b_6 = $('#b6').val();
				var b7 = (+sum_b) * 0.205;
				$('#b7').val(b7.toFixed());
				var b_7 = $('#b7').val();
				var b8 = (+sum_b) * 0.07;
				$('#b8').val(b8.toFixed());
				var b_8 = $('#b8').val();
				var b9 = (+sum_b) - ((+b_1) + (+b_2) + (+b_3) + (+b_4) + (+b_5) + (+b_6) + (+b_7) + (+b_8));
				$('#b9').val(b9.toFixed());
				var b_9 = $('#b9').val();

				//var aa1 = (+a_1) - (+b_1);
				//$('#aa1').val(aa1.toFixed());
				var aa_1 = $('#aa1').val();
				//var aa2 = (+a_2) - (+b_2);
				//$('#aa2').val(aa2.toFixed());
				var aa_2 = $('#aa2').val();
				//var aa3 = (+a_3) - (+b_3);
				//$('#aa3').val(aa3.toFixed());
				var aa_3 = $('#aa3').val();
				//var aa4 = (+a_4) - (+b_4);
				//$('#aa4').val(aa4.toFixed());
				var aa_4 = $('#aa4').val();
				var aa5 = (+a_5) - (+b_5);
				$('#aa5').val(aa5.toFixed());
				var aa_5 = $('#aa5').val();
				var aa6 = (+a_6) - (+b_6);
				$('#aa6').val(aa6.toFixed());
				var aa_6 = $('#aa6').val();
				var aa7 = (+a_7) - (+b_7);
				$('#aa7').val(aa7.toFixed());
				var aa_7 = $('#aa7').val();
				var aa8 = (+a_8) - (+b_8);
				$('#aa8').val(aa8.toFixed());
				var aa_8 = $('#aa8').val();
				var aa9 = (+a_9) - (+b_9);
				$('#aa9').val(aa9.toFixed());
				var aa_9 = $('#aa9').val();

				var sumaa = (+aa_1) + (+aa_2) + (+aa_3) + (+aa_4) + (+aa_5) + (+aa_6) + (+aa_7) + (+aa_8) + (+aa_9);
				$('#sumaa').val(sumaa.toFixed());
				var sum_aa = $('#sumaa').val();

				var sumdd = ((+eiindex) / (+100)) * (+sum_aa);
				$('#sumdd').val(sumdd.toFixed());
				var sum_dd = $('#sumdd').val();


				//var dd1 = (+sum_dd) * 0.40;
				//$('#dd1').val(dd1.toFixed());
				var dd_1 = $('#dd1').val();
				//var dd2 = (+sum_dd) * 0.40;
				//$('#dd2').val(dd2.toFixed());
				var dd_2 = $('#dd2').val();
				//var dd3 = (+sum_dd) * 0.40;
				//$('#dd3').val(dd3.toFixed());
				var dd_3 = $('#dd3').val();
				//var dd4 = (+sum_dd) * 0.40;
				//$('#dd4').val(dd4.toFixed());
				var dd_4 = $('#dd4').val();

				var dd5 = (+sum_dd) * 0.4;
				$('#dd5').val(dd5.toFixed());
				var dd_5 = $('#dd5').val();
				var dd6 = (+sum_dd) * 0.25;
				$('#dd6').val(dd6.toFixed());
				var dd_6 = $('#dd6').val();
				var dd7 = (+sum_dd) * 0.21;
				$('#dd7').val(dd7.toFixed());
				var dd_7 = $('#dd7').val();
				var dd8 = (+sum_dd) * 0.075;
				$('#dd8').val(dd8.toFixed());
				var dd_8 = $('#dd8').val();
				var dd9 = (+sum_dd) - ((+dd_1) + (+dd_2) + (+dd_3) + (+dd_4) + (+dd_5) + (+dd_6) + (+dd_7) + (+dd_8));
				$('#dd9').val(dd9.toFixed());
				var dd_9 = $('#dd9').val();
			}

		});

		function fi_ei() {
			$('#txtflk').css("background-color", "var(--success)");
			if ($("#chk_flk").is(':checked')) {
				var fiindex = $('#fi_index').val();
				var eiindex = $('#ei_index').val();

				var combined_index = (+fiindex) + (+eiindex);
				$('#combined_index').val(combined_index.toFixed(1));
				var combined = $('#combined_index').val();

				var suma = randomNumberFromRange(11500, 14500).toFixed();
				$('#suma').val(suma);
				var sum_a = $('#suma').val();

				var sumb = ((+fiindex) * (+sum_a)) / 100;
				$('#sumb').val(sumb.toFixed());
				var sum_b = $('#sumb').val();

				//var a1 = (+sum_a) * 0.40;
				//$('#a1').val(a1.toFixed());
				var a_1 = $('#a1').val();
				//var a2 = (+sum_a) * 0.40;
				//$('#a2').val(a2.toFixed());
				var a_2 = $('#a2').val();
				//var a3 = (+sum_a) * 0.40;
				//$('#a3').val(a3.toFixed());
				var a_3 = $('#a3').val();
				//var a4 = (+sum_a) * 0.40;
				//$('#a4').val(a4.toFixed());
				var a_4 = $('#a4').val();

				var a5 = (+sum_a) * 0.40;
				$('#a5').val(a5.toFixed());
				var a_5 = $('#a5').val();
				var a6 = (+sum_a) * 0.27;
				$('#a6').val(a6.toFixed());
				var a_6 = $('#a6').val();
				var a7 = (+sum_a) * 0.19;
				$('#a7').val(a7.toFixed());
				var a_7 = $('#a7').val();
				var a8 = (+sum_a) * 0.10;
				$('#a8').val(a8.toFixed());
				var a_8 = $('#a8').val();
				var a9 = (+sum_a) - ((+a_1) + (+a_2) + (+a_3) + (+a_4) + (+a_5) + (+a_6) + (+a_7) + (+a_8));
				$('#a9').val(a9.toFixed());
				var a_9 = $('#a9').val();


				//var b1 = (+sum_b) * 0.40;
				//$('#b1').val(b1.toFixed());
				var b_1 = $('#b1').val();
				//var b2 = (+sum_b) * 0.40;
				//$('#b2').val(b2.toFixed());
				var b_2 = $('#b2').val();
				//var b3 = (+sum_b) * 0.40;
				//$('#b3').val(b3.toFixed());
				var b_3 = $('#b3').val();
				//var b4 = (+sum_b) * 0.40;
				//$('#b4').val(b4.toFixed());
				var b_4 = $('#b4').val();

				var b5 = (+sum_b) * 0.41;
				$('#b5').val(b5.toFixed());
				var b_5 = $('#b5').val();
				var b6 = (+sum_b) * 0.255;
				$('#b6').val(b6.toFixed());
				var b_6 = $('#b6').val();
				var b7 = (+sum_b) * 0.205;
				$('#b7').val(b7.toFixed());
				var b_7 = $('#b7').val();
				var b8 = (+sum_b) * 0.07;
				$('#b8').val(b8.toFixed());
				var b_8 = $('#b8').val();
				var b9 = (+sum_b) - ((+b_1) + (+b_2) + (+b_3) + (+b_4) + (+b_5) + (+b_6) + (+b_7) + (+b_8));
				$('#b9').val(b9.toFixed());
				var b_9 = $('#b9').val();

				//var aa1 = (+a_1) - (+b_1);
				//$('#aa1').val(aa1.toFixed());
				var aa_1 = $('#aa1').val();
				//var aa2 = (+a_2) - (+b_2);
				//$('#aa2').val(aa2.toFixed());
				var aa_2 = $('#aa2').val();
				//var aa3 = (+a_3) - (+b_3);
				//$('#aa3').val(aa3.toFixed());
				var aa_3 = $('#aa3').val();
				//var aa4 = (+a_4) - (+b_4);
				//$('#aa4').val(aa4.toFixed());
				var aa_4 = $('#aa4').val();
				var aa5 = (+a_5) - (+b_5);
				$('#aa5').val(aa5.toFixed());
				var aa_5 = $('#aa5').val();
				var aa6 = (+a_6) - (+b_6);
				$('#aa6').val(aa6.toFixed());
				var aa_6 = $('#aa6').val();
				var aa7 = (+a_7) - (+b_7);
				$('#aa7').val(aa7.toFixed());
				var aa_7 = $('#aa7').val();
				var aa8 = (+a_8) - (+b_8);
				$('#aa8').val(aa8.toFixed());
				var aa_8 = $('#aa8').val();
				var aa9 = (+a_9) - (+b_9);
				$('#aa9').val(aa9.toFixed());
				var aa_9 = $('#aa9').val();

				var sumaa = (+aa_1) + (+aa_2) + (+aa_3) + (+aa_4) + (+aa_5) + (+aa_6) + (+aa_7) + (+aa_8) + (+aa_9);
				$('#sumaa').val(sumaa.toFixed());
				var sum_aa = $('#sumaa').val();

				var sumdd = ((+eiindex) / (+100)) * (+sum_aa);
				$('#sumdd').val(sumdd.toFixed());
				var sum_dd = $('#sumdd').val();


				//var dd1 = (+sum_dd) * 0.40;
				//$('#dd1').val(dd1.toFixed());
				var dd_1 = $('#dd1').val();
				//var dd2 = (+sum_dd) * 0.40;
				//$('#dd2').val(dd2.toFixed());
				var dd_2 = $('#dd2').val();
				//var dd3 = (+sum_dd) * 0.40;
				//$('#dd3').val(dd3.toFixed());
				var dd_3 = $('#dd3').val();
				//var dd4 = (+sum_dd) * 0.40;
				//$('#dd4').val(dd4.toFixed());
				var dd_4 = $('#dd4').val();

				var dd5 = (+sum_dd) * 0.4;
				$('#dd5').val(dd5.toFixed());
				var dd_5 = $('#dd5').val();
				var dd6 = (+sum_dd) * 0.25;
				$('#dd6').val(dd6.toFixed());
				var dd_6 = $('#dd6').val();
				var dd7 = (+sum_dd) * 0.21;
				$('#dd7').val(dd7.toFixed());
				var dd_7 = $('#dd7').val();
				var dd8 = (+sum_dd) * 0.075;
				$('#dd8').val(dd8.toFixed());
				var dd_8 = $('#dd8').val();
				var dd9 = (+sum_dd) - ((+dd_1) + (+dd_2) + (+dd_3) + (+dd_4) + (+dd_5) + (+dd_6) + (+dd_7) + (+dd_8));
				$('#dd9').val(dd9.toFixed());
				var dd_9 = $('#dd9').val();
			}
		}

		$('#fi_index,#ei_index').change(function() {
			fi_ei();

		});

		function a_b() {
			$('#txtflk').css("background-color", "var(--success)");
			// Weight B1(gm) (a)
			a_1 = $('#a1').val();
			a_2 = $('#a2').val();
			a_3 = $('#a3').val();
			a_4 = $('#a4').val();
			a_5 = $('#a5').val();
			a_6 = $('#a6').val();
			a_7 = $('#a7').val();
			a_8 = $('#a8').val();
			a_9 = $('#a9').val();



			suma = (+a_1) + (+a_2) + (+a_3) + (+a_4) + (+a_5) + (+a_6) + (+a_7) + (+a_8) + (+a_9);
			$('#suma').val(suma.toFixed());
			var sum_a = $('#suma').val();
			b_1 = $('#b1').val();
			b_2 = $('#b2').val();
			b_3 = $('#b3').val();
			b_4 = $('#b4').val();
			b_5 = $('#b5').val();
			b_6 = $('#b6').val();
			b_7 = $('#b7').val();
			b_8 = $('#b8').val();
			b_9 = $('#b9').val();

			sumb = (+b_1) + (+b_2) + (+b_3) + (+b_4) + (+b_5) + (+b_6) + (+b_7) + (+b_8) + (+b_9);
			$('#sumb').val(sumb.toFixed());
			var sum_b = $('#sumb').val();

			var fi_index = ((+sum_b) / (+sum_a)) * 100;
			$('#fi_index').val(fi_index.toFixed(1));
			var fiindex = $('#fi_index').val();


			if (a_1 != "" && b_1 != "") {
				var aa1 = (+a_1) - (+b_1);
				$('#aa1').val(aa1.toFixed());
				var aa_1 = $('#aa1').val();
			} else {
				var aa_1 = $('#aa1').val();
			}
			if (a_2 != "" && b_2 != "") {
				var aa2 = (+a_2) - (+b_2);
				$('#aa2').val(aa2.toFixed());
				var aa_2 = $('#aa2').val();
			} else {
				var aa_2 = $('#aa2').val();
			}
			if (a_3 != "" && b_3 != "") {
				var aa3 = (+a_3) - (+b_3);
				$('#aa3').val(aa3.toFixed());
				var aa_3 = $('#aa3').val();
			} else {
				var aa_3 = $('#aa3').val();
			}
			if (a_4 != "" && b_4 != "") {
				var aa4 = (+a_4) - (+b_4);
				$('#aa4').val(aa4.toFixed());
				var aa_4 = $('#aa4').val();
			} else {
				var aa_4 = $('#aa4').val();
			}
			if (a_5 != "" && b_5 != "") {
				var aa5 = (+a_5) - (+b_5);
				$('#aa5').val(aa5.toFixed());
				var aa_5 = $('#aa5').val();
			} else {
				var aa_5 = $('#aa5').val();
			}
			if (a_6 != "" && b_6 != "") {
				var aa6 = (+a_6) - (+b_6);
				$('#aa6').val(aa6.toFixed());
				var aa_6 = $('#aa6').val();
			} else {
				var aa_6 = $('#aa6').val();
			}
			if (a_7 != "" && b_7 != "") {
				var aa7 = (+a_7) - (+b_7);
				$('#aa7').val(aa7.toFixed());
				var aa_7 = $('#aa7').val();
			} else {
				var aa_7 = $('#aa7').val();
			}
			if (a_8 != "" && b_8 != "") {
				var aa8 = (+a_8) - (+b_8);
				$('#aa8').val(aa8.toFixed());
				var aa_8 = $('#aa8').val();
			} else {
				var aa_8 = $('#aa8').val();
			}
			if (a_9 != "" && b_9 != "") {
				var aa9 = (+a_9) - (+b_9);
				$('#aa9').val(aa9.toFixed());
				var aa_9 = $('#aa9').val();
			} else {
				var aa_9 = $('#aa9').val();
			}




			var sumaa = (+aa_1) + (+aa_2) + (+aa_3) + (+aa_4) + (+aa_5) + (+aa_6) + (+aa_7) + (+aa_8) + (+aa_9);
			$('#sumaa').val(sumaa.toFixed());
			var sum_aa = $('#sumaa').val();

			dd_1 = $('#dd1').val();
			dd_2 = $('#dd2').val();
			dd_3 = $('#dd3').val();
			dd_4 = $('#dd4').val();
			dd_5 = $('#dd5').val();
			dd_6 = $('#dd6').val();
			dd_7 = $('#dd7').val();
			dd_8 = $('#dd8').val();
			dd_9 = $('#dd9').val();

			var sumdd = (+dd_1) + (+dd_2) + (+dd_3) + (+dd_4) + (+dd_5) + (+dd_6) + (+dd_7) + (+dd_8) + (+dd_9);
			$('#sumdd').val(sumdd.toFixed());
			var sum_dd = $('#sumdd').val();

			var ei_index = ((+sum_dd) / (+sum_aa)) * 100;
			$('#ei_index').val(ei_index.toFixed(1));
			var eiindex = $('#ei_index').val();

			var combined_index = (+fiindex) + (+eiindex);
			$('#combined_index').val(combined_index.toFixed(1));
			var combined = $('#combined_index').val();



		}


		$('#a1,#a3,#a2,#a4,#a5,#a6,#a7,#a8,#a9,#b1,#b3,#b2,#b4,#b5,#b6,#b7,#b8,#b9,#aa1,#aa3,#aa2,#aa4,#aa5,#aa6,#aa7,#aa8,#aa9,#dd1,#dd3,#dd2,#dd4,#dd5,#dd6,#dd7,#dd8,#dd9').change(function() {

			a_b();

		});

		function imp_auto() {
			$('#txtimp').css("background-color", "var(--success)");
			var imp_value4 = randomNumberFromRange(14.00, 18.00);
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

		$("#imp_value").change(function() {
			$('#txtimp').css("background-color", "var(--success)");
			if ($("#chk_impact").is(':checked')) {

				var imp_w_m_a_1 = randomNumberFromRange(310.0, 335.0);
				var imp_w_m_a_2 = randomNumberFromRange(310.0, 335.0);
				$('#imp_w_m_a_1').val(imp_w_m_a_1.toFixed(1));
				$('#imp_w_m_a_2').val(imp_w_m_a_2.toFixed(1));
				var imp_wma1 = $('#imp_w_m_a_1').val();
				var imp_wma2 = $('#imp_w_m_a_2').val();

				var imp_value = $('#imp_value').val();
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


			}
		});

		function imp_data() {
			$('#txtimp').css("background-color", "var(--success)");
			var imp_w_m_a_1 = $('#imp_w_m_a_1').val();
			var imp_w_m_b_1 = $('#imp_w_m_b_1').val();
			var imp_w_m_c_1 = $('#imp_w_m_c_1').val();

			var imp_value_1 = ((+imp_w_m_b_1) / (+imp_w_m_a_1)) * 100;
			$('#imp_value_1').val(imp_value_1.toFixed(1));
			var imp_value1 = $('#imp_value_1').val();
			var imp_value_2 = $('#imp_value_2').val();
			var imp_value = ((+imp_value1) + (+imp_value_2)) / 2;
			$('#imp_value').val(imp_value.toFixed(1));

		}

		$("#imp_w_m_a_1").change(function() {
			imp_data();
		});

		$("#imp_w_m_b_1").change(function() {
			imp_data();
		});

		$("#imp_w_m_c_1").change(function() {
			imp_data();
		});

		function imp_data1() {
			$('#txtimp').css("background-color", "var(--success)");
			var imp_w_m_a_2 = $('#imp_w_m_a_2').val();
			var imp_w_m_b_2 = $('#imp_w_m_b_2').val();
			var imp_w_m_c_2 = $('#imp_w_m_c_2').val();

			var imp_value_2 = ((+imp_w_m_b_2) / (+imp_w_m_a_2)) * 100;
			$('#imp_value_2').val(imp_value_2.toFixed(1));
			var imp_value_1 = $('#imp_value_1').val();
			var imp_value2 = $('#imp_value_2').val();
			var imp_value = ((+imp_value_1) + (+imp_value2)) / 2;
			$('#imp_value').val(imp_value.toFixed(1));

		}

		$("#imp_w_m_a_2,#imp_w_m_b_2,#imp_w_m_c_2").change(function() {
			imp_data1();
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

		$('#fines_value').change(function() {
			$('#txtfin').css("background-color", "var(--success)");
			if ($("#chk_fines").is(':checked')) {
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
		});

		function fines_all() {
			$('#txtfin').css("background-color", "var(--success)");
			var f_a1 = $('#f_a_1').val();
			var f_a2 = $('#f_a_2').val();
			var f_c1 = $('#f_c_1').val();
			var f_c2 = $('#f_c_2').val();
			var f_b1 = $('#f_b_1').val();
			var f_b2 = $('#f_b_2').val();
			var tempd1 = (+f_c1) / (+f_a1);
			var tempd2 = (+f_c2) / (+f_a2);
			var f_d_1 = (+tempd1) * 100;
			var f_d_2 = (+tempd2) * 100;
			$('#f_d_1').val(f_d_1.toFixed(1));
			$('#f_d_2').val(f_d_2.toFixed(1));
			var f_d1 = $('#f_d_1').val();
			var f_d2 = $('#f_d_2').val();
			var avg_f_d = ((+f_d1) + (+f_d2)) / 2;
			var avg_f_c = ((+f_b1) + (+f_b2)) / 2;
			$('#avg_f_d').val(avg_f_d.toFixed(1));
			$('#avg_f_c').val(avg_f_c.toFixed(1));
			var avg_fd = $('#avg_f_d').val();
			var avg_fc = $('#avg_f_c').val();
			var tempe11 = 14 * (+avg_fc);
			var tempe21 = 4 + (+avg_fd);
			var fines_value = (+tempe11) / (+tempe21);
			$('#fines_value').val(fines_value.toFixed());

		}

		$('#f_a_1,#f_a_2,#f_b_1,#f_b_2,#f_c_1,#f_c_2').change(function() {
			fines_all();
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

		$('#alk_11').change(function() {
			$('#txtalk').css("background-color", "var(--success)");
			if ($("#chk_alkali").is(':checked')) {
				var alk11 = $('#alk_11').val();
				var alk8 = $('#alk_8').val();
				var alk_4 = (+alk8) * (+alk11);
				$('#alk_4').val(alk_4.toFixed(0));
				var alk_3 = randomNumberFromRange(0.001, 0.005).toFixed(3);
				$('#alk_3').val(alk_3);
				var alk3 = $('#alk_3').val();
				var alk4 = $('#alk_4').val();
				var alk_2 = (+alk4 / 3330) + (+alk3);
				$('#alk_2').val(alk_2.toFixed(3));
			}
		});
		$('#alk_8').change(function() {
			$('#txtalk').css("background-color", "var(--success)");
			if ($("#chk_alkali").is(':checked')) {
				var alk8 = $('#alk_8').val();
				var alk4 = $('#alk_4').val();
				var alk_11 = (+alk4) / (+alk8);
				var alk_9 = alk_11;
				$('#alk_11').val(alk_11.toFixed(3));
				$('#alk_9').val(alk_9.toFixed(3));
				var alk6 = $('#alk_6').val();
				var alk7 = $('#alk_7').val();
				var tes = (+alk6) - (+alk7);
				var N = 1;
				var eqw1 = (+N) * (+tes);
				var finale = (+eqw1) * 1000 * 20;
				var alk_5 = (+finale) / (+alk8);
				$('#alk_5').val(alk_5.toFixed(1));
			}
		});
		$('#alk_4').change(function() {
			$('#txtalk').css("background-color", "var(--success)");
			if ($("#chk_alkali").is(':checked')) {
				var alk8 = $('#alk_8').val();
				var alk4 = $('#alk_4').val();
				var alk_11 = (+alk4) / (+alk8);
				var alk_9 = alk_11;
				$('#alk_11').val(alk_11.toFixed(3));
				$('#alk_9').val(alk_9.toFixed(3));
				var alk_3 = randomNumberFromRange(0.001, 0.005).toFixed(3);
				$('#alk_3').val(alk_3);
				var alk3 = $('#alk_3').val();
				var alk_2 = (+alk4 / 3330) + (+alk3);
				$('#alk_2').val(alk_2.toFixed(3));
			}
		});

		function alk_2_3() {
			$('#txtalk').css("background-color", "var(--success)");
			var alk2 = $('#alk_2').val();
			var alk3 = $('#alk_3').val();
			var alk_4 = ((+alk2) - (+alk3)) * 3330;
			$('#alk_4').val(alk_4.toFixed(0));
			var alk8 = $('#alk_8').val();
			var alk4 = $('#alk_4').val();
			var alk_11 = (+alk4) / (+alk8);
			var alk_9 = alk_11;
			$('#alk_11').val(alk_11.toFixed(3));
			$('#alk_9').val(alk_9.toFixed(3));
		}

		$('#alk_2,#alk_3').change(function() {
			alk_2_3();
		});

		function alk_5_6_7() {
			$('#txtalk').css("background-color", "var(--success)");
			var alk5 = $('#alk_5').val();
			var alk6 = $('#alk_6').val();
			var alk7 = $('#alk_7').val();
			var tes = (+alk6) - (+alk7);
			var N = 1;
			var eqw1 = (+N) * (+tes);
			var finales = (+eqw1) * 20 * 1000;
			var alk_8 = (+finales) / (+alk5);
			$('#alk_8').val(alk_8.toFixed(0));
			var alk8 = $('#alk_8').val();
			var alk4 = $('#alk_4').val();
			var alk_11 = (+alk4) / (+alk8);
			var alk_9 = alk_11;
			$('#alk_11').val(alk_11.toFixed(3));
			$('#alk_9').val(alk_9.toFixed(3));
		}

		$('#alk_5,#alk_6,#alk_7').change(function() {
			alk_5_6_7();
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

		$("#cru_value").change(function() {
			$('#txtcru').css("background-color", "var(--success)");

			if ($("#chk_crushing").is(':checked')) {
				var cru_val = $('#cru_value').val();
				var r = randomNumberFromRange(-0.3, 0.3).toFixed(1);
				var cru_value_1 = (+cru_val) + (+r);
				var cru_value_2 = (+cru_val) - (+r);
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
				var er1 = (+cr_a1) / 100;
				var er2 = (+cr_a2) / 100;
				var cr_b_1 = (+er1) * (+cru_value1);
				var cr_b_2 = (+er2) * (+cru_value2);
				$('#cr_b_1').val(cr_b_1.toFixed(1));
				$('#cr_b_2').val(cr_b_2.toFixed(1));
			}

		});

		$("#cr_a_1,#cr_b_1").change(function() {
			$('#txtcru').css("background-color", "var(--success)");
			var cr_a_1 = $('#cr_a_1').val();
			var cr_b_1 = $('#cr_b_1').val();

			var cru_value_1 = ((+cr_b_1) / (+cr_a_1)) * 100;
			var cru_value_2 = $('#cru_value_2').val();
			$('#cru_value_1').val(cru_value_1.toFixed(1));
			var cru_value1 = $('#cru_value_1').val();
			var cru_value = ((+cru_value1) + (+cru_value_2)) / 2;
			$('#cru_value').val(cru_value.toFixed(1));
		});

		$("#cr_a_2,#cr_b_2").change(function() {
			$('#txtcru').css("background-color", "var(--success)");
			var cr_a_2 = $('#cr_a_2').val();
			var cr_b_2 = $('#cr_b_2').val();

			var cru_value_2 = ((+cr_b_2) / (+cr_a_2)) * 100;
			var cru_value_1 = $('#cru_value_1').val();
			$('#cru_value_2').val(cru_value_2.toFixed(1));
			var cru_value2 = $('#cru_value_2').val();
			var cru_value = ((+cru_value_1) + (+cru_value2)) / 2;
			$('#cru_value').val(cru_value.toFixed(1));
		});

		function lll_auto() {
			$('#txtlll').css("background-color", "var(--success)");
			var avg_ll = randomNumberFromRange(23.00, 24.00).toFixed(2);
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


		$("#avg_ll").change(function() {
			if ($("#chk_ll").is(':checked')) {
				ll();
			}
		});

		function pen_cont_wc_od() {
			var pen_1 = $('#pen1').val();
			var pen_2 = $('#pen2').val();
			var cont_1 = $('#cont1').val();
			var cont_2 = $('#cont2').val();
			var wc_1 = $('#wc1').val();
			var wc_2 = $('#wc2').val();
			var od_1 = $('#od1').val();
			var od_2 = $('#od2').val();
			getWeight(cont_1, cont_2);
			var wf_1 = $('#wf1').val();
			var wf_2 = $('#wf2').val();

			var ww1 = (+wc_1) - (+od_1);
			var ww2 = (+wc_2) - (+od_2);
			$('#ww1').val(ww1.toFixed(2));
			$('#ww2').val(ww2.toFixed(2));
			var ww_1 = $('#ww1').val();
			var ww_2 = $('#ww2').val();

			var ds1 = (+od_1) - (+wf_1);
			var ds2 = (+od_2) - (+wf_2);
			$('#ds1').val(ds1.toFixed(2));
			$('#ds2').val(ds2.toFixed(2));
			var ds_1 = $('#ds1').val();
			var ds_2 = $('#ds1').val();

			var mo1 = ((+ww_1) / (+ds_1)) * 100;
			var mo2 = ((+ww_2) / (+ds_2)) * 100;
			$('#mo1').val(mo1.toFixed(2));
			$('#mo2').val(mo2.toFixed(2));
			var mo_1 = $('#mo1').val();
			var mo_2 = $('#mo2').val();

			var temps1 = 0.0175 * (+pen_1);
			var temps2 = 0.0175 * (+pen_2);

			var tme1 = (+temps1) + (+0.65);
			var tme2 = (+temps2) + (+0.65);

			var ln1 = (+mo_1) / (+tme1);
			var ln2 = (+mo_2) / (+tme2);
			$('#ln1').val(ln1.toFixed(2));
			$('#ln2').val(ln2.toFixed(2));
			var ln_1 = $('#ln1').val();
			var ln_2 = $('#ln2').val();

			var avg_ll = ((+ln_1) + (+ln_2)) / 2;
			$('#avg_ll').val(avg_ll.toFixed(2));
			var avgll = $('#avg_ll').val();
			var liquide_limit = (+avgll);
			$('#liquide_limit').val(liquide_limit.toFixed());

		}

		$("#pen1,#pen2,#cont1,#cont2,#wc1,#wc2,#od1,#od2").change(function() {
			pen_cont_wc_od();

		});

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

		$('#bdl').change(function() {
			if ($("#chk_den").is(':checked')) {
				bulk_den();
			}
		});

		$('#avg_wom').change(function() {

			$('#txtden').css("background-color", "var(--success)");
			if ($("#chk_den").is(':checked')) {
				var avg = $('#avg_wom').val();
				$('#avg_wom').val(avg);
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
				var m21 = $('#m21').val();
				var m22 = $('#m22').val();
				var m23 = $('#m23').val();
				var m11 = (+m21) + (+wo1);
				var m12 = (+m22) + (+wo2);
				var m13 = (+m23) + (+wo3);
				$('#m11').val(m11.toFixed(2));
				$('#m12').val(m12.toFixed(2));
				$('#m13').val(m13.toFixed(2));

				var vol = $('#vol').val();
				var bdl = (+avg) / (+vol);
				$('#bdl').val(bdl.toFixed(2));
			}

		});

		function weigh_mould_material() {
			$('#txtden').css("background-color", "var(--success)");
			var m11 = $('#m11').val();
			var m12 = $('#m12').val();
			var m13 = $('#m13').val();
			var m21 = $('#m21').val();
			var m22 = $('#m22').val();
			var m23 = $('#m23').val();

			var m31 = (+m11) - (+m21);
			var m32 = (+m12) - (+m22);
			var m33 = (+m13) - (+m23);
			$('#m31').val(m31.toFixed(2));
			$('#m32').val(m32.toFixed(2));
			$('#m33').val(m33.toFixed(2));
			var wo1 = $('#m31').val();
			var wo2 = $('#m32').val();
			var wo3 = $('#m33').val();

			var avg_wom = ((+wo1) + (+wo2) + (+wo3)) / 3;
			$('#avg_wom').val(avg_wom.toFixed(2));
			$('#avg_wom1').val(avg_wom.toFixed(2));
			var avg = $('#avg_wom').val();
			var vol = $('#vol').val();
			var bdl = (+avg) / (+vol);
			$('#bdl').val(bdl.toFixed(2));

		}

		$('#m11,#m12,#m13,#m21,#m22,#m23,#vol').change(function() {
			weigh_mould_material()

		});

		function wom_123() {
			$('#txtden').css("background-color", "var(--success)");
			var m31 = $('#m31').val();
			var m32 = $('#m32').val();
			var m33 = $('#m33').val();
			var m21 = $('#m21').val();
			var m22 = $('#m22').val();
			var m23 = $('#m23').val();

			var avg_wom = ((+m31) + (+m32) + (+m33)) / 3;
			$('#avg_wom').val(avg_wom.toFixed(2));
			$('#avg_wom1').val(avg_wom.toFixed(2));

			var m11 = (+m31) + (+m21);
			var m12 = (+m32) + (+m22);
			var m13 = (+m33) + (+m23);

			$('#m11').val(m11.toFixed(2));
			$('#m12').val(m12.toFixed(2));
			$('#m13').val(m13.toFixed(2));
			var avg_m32 = $('#avg_wom').val();
			var vol = $('#vol').val();
			var bdl = (+avg_m32) / (+vol);
			$('#bdl').val(bdl.toFixed(2));


		}

		$('#m31,#m32,#m33').change(function() {

			wom_123();
		});


		function grd_auto() {
			$('#txtgrd').css("background-color", "var(--success)");
			var sieve_1 = "53";
			var sieve_2 = "26.5";
			var sieve_3 = "4.75";
			var sieve_4 = "0.075";


			var sample_taken = 15000;
			//PASSING RANGE
			var pass_sample_1 = randomNumberFromRange(100, 100).toFixed(2);
			var pass_sample_2 = randomNumberFromRange(60.00, 74.00).toFixed(2);
			var pass_sample_3 = randomNumberFromRange(20.00, 29.00).toFixed(2);
			var pass_sample_4 = randomNumberFromRange(1.00, 4.00).toFixed(2);



			$('#pass_sample_1').val(pass_sample_1);
			$('#pass_sample_2').val(pass_sample_2);
			$('#pass_sample_3').val(pass_sample_3);
			$('#pass_sample_4').val(pass_sample_4);

			var pass_sample1 = $('#pass_sample_1').val();
			var pass_sample2 = $('#pass_sample_2').val();
			var pass_sample3 = $('#pass_sample_3').val();
			var pass_sample4 = $('#pass_sample_4').val();


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
			var sieve_1 = "53";
			var sieve_2 = "26.5";
			var sieve_3 = "4.75";
			var sieve_4 = "0.075";

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

		}


		$('#sample_taken,#pass_sample_1,#pass_sample_2,#pass_sample_3,#pass_sample_4').change(function() {
			$('#txtgrd').css("background-color", "var(--success)");
			if ($("#chk_grd").is(':checked')) {
				grd_func();
			}
		});


		function weight_cum_gm() {
			var sieve_1 = "53";
			var sieve_2 = "26.5";
			var sieve_3 = "4.75";
			var sieve_4 = "0.075";

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

		$('#cum_wt_gm_1,#cum_wt_gm_2,#cum_wt_gm_3,#cum_wt_gm_4').change(function() {
			weight_cum_gm();
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
			url: '<?php echo $base_url; ?>save_g3_m5.php',
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


			//MDD
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "mdd") {
					if (document.getElementById('chk_mdd').checked) {
						var chk_mdd = "1";


					} else {
						var chk_mdd = "0";
					}
					var mdd = $('#mdd').val();
					break;
				} else {
					var chk_mdd = "0";
					var mdd = "";
				}

			}
			//OMC
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "omc") {
					if (document.getElementById('chk_omc').checked) {
						var chk_omc = "1";


					} else {
						var chk_omc = "0";
					}
					var omc = $('#omc').val();
					break;
				} else {
					var chk_omc = "0";
					var omc = "";
				}

			}
			//CBR
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "cbr") {
					if (document.getElementById('chk_cbr').checked) {
						var chk_cbr = "1";


					} else {
						var chk_cbr = "0";
					}
					var cbr = $('#cbr').val();
					break;
				} else {
					var chk_cbr = "0";
					var cbr = "";
				}

			}


			//GRADATION
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "grd") {
					if (document.getElementById('chk_grd').checked) {
						var chk_grd = "1";
					} else {
						var chk_grd = "0";
					}
					var sieve_1 = "53";
					var sieve_2 = "26.5";
					var sieve_3 = "4.75";
					var sieve_4 = "0.075";
					var sample_taken = $('#sample_taken').val();
					var blank_extra = $('#blank_extra').val();

					var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
					var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
					var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
					var cum_wt_gm_4 = $('#cum_wt_gm_4').val();

					var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
					var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
					var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
					var ret_wt_gm_4 = $('#ret_wt_gm_4').val();

					var cum_ret_1 = $('#cum_ret_1').val();
					var cum_ret_2 = $('#cum_ret_2').val();
					var cum_ret_3 = $('#cum_ret_3').val();
					var cum_ret_4 = $('#cum_ret_4').val();

					var pass_sample_1 = $('#pass_sample_1').val();
					var pass_sample_2 = $('#pass_sample_2').val();
					var pass_sample_3 = $('#pass_sample_3').val();
					var pass_sample_4 = $('#pass_sample_4').val();

					break;
				} else {
					var chk_grd = "0";
					var cum_wt_gm_1 = "0";
					var cum_wt_gm_2 = "0";
					var cum_wt_gm_3 = "0";
					var cum_wt_gm_4 = "0";

					var ret_wt_gm_1 = "0";
					var ret_wt_gm_2 = "0";
					var ret_wt_gm_3 = "0";
					var ret_wt_gm_4 = "0";


					var cum_ret_1 = "0";
					var cum_ret_2 = "0";
					var cum_ret_3 = "0";
					var cum_ret_4 = "0";

					var pass_sample_1 = "0";
					var pass_sample_2 = "0";
					var pass_sample_3 = "0";
					var pass_sample_4 = "0";

					var blank_extra = "0";
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
					var sp_w_s_1 = $('#sp_w_s_1').val();
					var sp_w_s_2 = $('#sp_w_s_2').val();
					var sp_wt_st_1 = $('#sp_wt_st_1').val();
					var sp_wt_st_2 = $('#sp_wt_st_2').val();
					var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
					var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
					var sp_specific_gravity = $('#sp_specific_gravity').val();
					var sp_water_abr = $('#sp_water_abr').val();
					var sp_water_abr_1 = $('#sp_water_abr_1').val();
					var sp_water_abr_2 = $('#sp_water_abr_2').val();

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
					var sp_water_abr_1 = "0";
					var sp_water_abr_2 = "0";
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

					var s11 = $('#s11').val();
					var s12 = $('#s12').val();
					var s13 = $('#s13').val();
					var s14 = $('#s14').val();
					var s15 = $('#s15').val();
					var s16 = $('#s16').val();
					var s17 = $('#s17').val();
					var s18 = $('#s18').val();
					var s19 = $('#s19').val();


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

			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_sou=' + chk_sou + '&s6total=' + s6total + '&soundness=' + soundness + '&s31=' + s31 + '&s32=' + s32 + '&s33=' + s33 + '&s34=' + s34 + '&s35=' + s35 + '&s36=' + s36 + '&s37=' + s37 + '&s38=' + s38 + '&s39=' + s39 + '&s30=' + s30 + '&s41=' + s41 + '&s42=' + s42 + '&s43=' + s43 + '&s44=' + s44 + '&s45=' + s45 + '&s46=' + s46 + '&s47=' + s47 + '&s48=' + s48 + '&s49=' + s49 + '&s40=' + s40 + '&s51=' + s51 + '&s52=' + s52 + '&s53=' + s53 + '&s54=' + s54 + '&s55=' + s55 + '&s56=' + s56 + '&s57=' + s57 + '&s58=' + s58 + '&s59=' + s59 + '&s50=' + s50 + '&s61=' + s61 + '&s62=' + s62 + '&s63=' + s63 + '&s64=' + s64 + '&s65=' + s65 + '&s66=' + s66 + '&s67=' + s67 + '&s68=' + s68 + '&s69=' + s69 + '&s60=' + s60 + '&chk_sp=' + chk_sp + '&sp_w_sur_1=' + sp_w_sur_1 + '&sp_w_sur_2=' + sp_w_sur_2 + '&sp_w_s_1=' + sp_w_s_1 + '&sp_w_s_2=' + sp_w_s_2 + '&sp_wt_st_1=' + sp_wt_st_1 + '&sp_wt_st_2=' + sp_wt_st_2 + '&sp_specific_gravity=' + sp_specific_gravity + '&sp_specific_gravity_1=' + sp_specific_gravity_1 + '&sp_specific_gravity_2=' + sp_specific_gravity_2 + '&sp_water_abr=' + sp_water_abr + '&sp_water_abr_1=' + sp_water_abr_1 + '&sp_water_abr_2=' + sp_water_abr_2 + '&chk_abr=' + chk_abr + '&abr_index=' + abr_index + '&abr_wt_t_a_1=' + abr_wt_t_a_1 + '&abr_wt_t_a_2=' + abr_wt_t_a_2 + '&abr_wt_t_b_1=' + abr_wt_t_b_1 + '&abr_wt_t_b_2=' + abr_wt_t_b_2 + '&abr_wt_t_c_1=' + abr_wt_t_c_1 + '&abr_wt_t_c_2=' + abr_wt_t_c_2 + '&abr_1=' + abr_1 + '&abr_2=' + abr_2 + '&abr_grading=' + abr_grading + '&abr_weight_charge=' + abr_weight_charge + '&abr_sphere=' + abr_sphere + '&abr_num_revo=' + abr_num_revo + '&chk_alkali=' + chk_alkali + '&alk_1=' + alk_1 + '&alk_2=' + alk_2 + '&alk_3=' + alk_3 + '&alk_4=' + alk_4 + '&alk_5=' + alk_5 + '&alk_6=' + alk_6 + '&alk_7=' + alk_7 + '&alk_8=' + alk_8 + '&alk_9=' + alk_9 + '&alk_10=' + alk_10 + '&alk_11=' + alk_11 + '&chk_den=' + chk_den + '&m11=' + m11 + '&m12=' + m12 + '&m13=' + m13 + '&m21=' + m21 + '&m22=' + m22 + '&m23=' + m23 + '&m31=' + m31 + '&m32=' + m32 + '&m33=' + m33 + '&avg_wom=' + avg_wom + '&vol=' + vol + '&bdl=' + bdl + '&chk_crushing=' + chk_crushing + '&cru_value=' + cru_value + '&cr_a_1=' + cr_a_1 + '&cr_a_2=' + cr_a_2 + '&cr_b_1=' + cr_b_1 + '&cr_b_2=' + cr_b_2 + '&cru_value_1=' + cru_value_1 + '&cru_value_2=' + cru_value_2 + '&chk_fines=' + chk_fines + '&fines_value=' + fines_value + '&f_a_1=' + f_a_1 + '&f_a_2=' + f_a_2 + '&f_b_1=' + f_b_1 + '&f_b_2=' + f_b_2 + '&f_c_1=' + f_c_1 + '&f_c_2=' + f_c_2 + '&f_d_1=' + f_d_1 + '&f_d_2=' + f_d_2 + '&avg_f_d=' + avg_f_d + '&avg_f_c=' + avg_f_c + '&chk_flk=' + chk_flk + '&fi_index=' + fi_index + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&a4=' + a4 + '&a5=' + a5 + '&a6=' + a6 + '&a7=' + a7 + '&a8=' + a8 + '&a9=' + a9 + '&suma=' + suma + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&b4=' + b4 + '&b5=' + b5 + '&b6=' + b6 + '&b7=' + b7 + '&b8=' + b8 + '&b9=' + b9 + '&s11=' + s11 + '&s12=' + s12 + '&s13=' + s13 + '&s14=' + s14 + '&s15=' + s15 + '&s16=' + s16 + '&s17=' + s17 + '&s18=' + s18 + '&s19=' + s19 + '&ei_index=' + ei_index + '&aa1=' + aa1 + '&aa2=' + aa2 + '&aa3=' + aa3 + '&aa4=' + aa4 + '&aa5=' + aa5 + '&aa6=' + aa6 + '&aa7=' + aa7 + '&aa8=' + aa8 + '&aa9=' + aa9 + '&dd1=' + dd1 + '&dd2=' + dd2 + '&dd3=' + dd3 + '&dd4=' + dd4 + '&dd5=' + dd5 + '&dd6=' + dd6 + '&dd7=' + dd7 + '&dd8=' + dd8 + '&dd9=' + dd9 + '&combined_index=' + combined_index + '&sumb=' + sumb + '&sumaa=' + sumaa + '&sumdd=' + sumdd + '&chk_impact=' + chk_impact + '&imp_w_m_a_1=' + imp_w_m_a_1 + '&imp_w_m_a_2=' + imp_w_m_a_2 + '&imp_w_m_b_1=' + imp_w_m_b_1 + '&imp_w_m_b_2=' + imp_w_m_b_2 + '&imp_w_m_c_1=' + imp_w_m_c_1 + '&imp_w_m_c_2=' + imp_w_m_c_2 + '&imp_value_1=' + imp_value_1 + '&imp_value_2=' + imp_value_2 + '&imp_value=' + imp_value + '&chk_ll=' + chk_ll + '&pen1=' + pen1 + '&pen2=' + pen2 + '&pen3=' + pen3 + '&pen4=' + pen4 + '&cont1=' + cont1 + '&cont2=' + cont2 + '&cont3=' + cont3 + '&cont4=' + cont4 + '&wc1=' + wc1 + '&wc2=' + wc2 + '&wc3=' + wc3 + '&wc4=' + wc4 + '&od1=' + od1 + '&od2=' + od2 + '&od3=' + od3 + '&od4=' + od4 + '&ww1=' + ww1 + '&ww2=' + ww2 + '&ww3=' + ww3 + '&ww4=' + ww4 + '&wf1=' + wf1 + '&wf2=' + wf2 + '&wf3=' + wf3 + '&wf4=' + wf4 + '&ds1=' + ds1 + '&ds2=' + ds2 + '&ds3=' + ds3 + '&ds4=' + ds4 + '&mo1=' + mo1 + '&mo2=' + mo2 + '&mo3=' + mo3 + '&mo4=' + mo4 + '&ln1=' + ln1 + '&ln2=' + ln2 + '&ln3=' + ln3 + '&ln4=' + ln4 + '&avg_ll=' + avg_ll + '&avg_pl=' + avg_pl + '&plastic_limit=' + plastic_limit + '&pi_value=' + pi_value + '&liquide_limit=' + liquide_limit + '&chk_grd=' + chk_grd + '&sieve_1=' + sieve_1 + '&sieve_2=' + sieve_2 + '&sieve_3=' + sieve_3 + '&sieve_4=' + sieve_4 + '&cum_wt_gm_1=' + cum_wt_gm_1 + '&cum_wt_gm_2=' + cum_wt_gm_2 + '&cum_wt_gm_3=' + cum_wt_gm_3 + '&cum_wt_gm_4=' + cum_wt_gm_4 + '&ret_wt_gm_1=' + ret_wt_gm_1 + '&ret_wt_gm_2=' + ret_wt_gm_2 + '&ret_wt_gm_3=' + ret_wt_gm_3 + '&ret_wt_gm_4=' + ret_wt_gm_4 + '&cum_ret_1=' + cum_ret_1 + '&cum_ret_2=' + cum_ret_2 + '&cum_ret_3=' + cum_ret_3 + '&cum_ret_4=' + cum_ret_4 + '&pass_sample_1=' + pass_sample_1 + '&pass_sample_2=' + pass_sample_2 + '&pass_sample_3=' + pass_sample_3 + '&pass_sample_4=' + pass_sample_4 + '&blank_extra=' + blank_extra + '&sample_taken=' + sample_taken + '&ulr=' + ulr + '&chk_mdd=' + chk_mdd + '&mdd=' + mdd + '&chk_omc=' + chk_omc + '&omc=' + omc + '&chk_cbr=' + chk_cbr + '&cbr=' + cbr+ '&amend_date=' + amend_date;

		} else if (type == 'edit') {

			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();
			var temp = $('#test_list').val();
			var aa = temp.split(",");


			//MDD
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "mdd") {
					if (document.getElementById('chk_mdd').checked) {
						var chk_mdd = "1";


					} else {
						var chk_mdd = "0";
					}
					var mdd = $('#mdd').val();
					break;
				} else {
					var chk_mdd = "0";
					var mdd = "";
				}

			}
			//OMC
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "omc") {
					if (document.getElementById('chk_omc').checked) {
						var chk_omc = "1";


					} else {
						var chk_omc = "0";
					}
					var omc = $('#omc').val();
					break;
				} else {
					var chk_omc = "0";
					var omc = "";
				}

			}
			//CBR
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "cbr") {
					if (document.getElementById('chk_cbr').checked) {
						var chk_cbr = "1";


					} else {
						var chk_cbr = "0";
					}
					var cbr = $('#cbr').val();
					break;
				} else {
					var chk_cbr = "0";
					var cbr = "";
				}

			}


			//GRADATION
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "grd") {
					if (document.getElementById('chk_grd').checked) {
						var chk_grd = "1";
					} else {
						var chk_grd = "0";
					}
					var sieve_1 = "53";
					var sieve_2 = "26.5";
					var sieve_3 = "4.75";
					var sieve_4 = "0.075";
					var sample_taken = $('#sample_taken').val();
					var blank_extra = $('#blank_extra').val();

					var cum_wt_gm_1 = $('#cum_wt_gm_1').val();
					var cum_wt_gm_2 = $('#cum_wt_gm_2').val();
					var cum_wt_gm_3 = $('#cum_wt_gm_3').val();
					var cum_wt_gm_4 = $('#cum_wt_gm_4').val();

					var ret_wt_gm_1 = $('#ret_wt_gm_1').val();
					var ret_wt_gm_2 = $('#ret_wt_gm_2').val();
					var ret_wt_gm_3 = $('#ret_wt_gm_3').val();
					var ret_wt_gm_4 = $('#ret_wt_gm_4').val();

					var cum_ret_1 = $('#cum_ret_1').val();
					var cum_ret_2 = $('#cum_ret_2').val();
					var cum_ret_3 = $('#cum_ret_3').val();
					var cum_ret_4 = $('#cum_ret_4').val();

					var pass_sample_1 = $('#pass_sample_1').val();
					var pass_sample_2 = $('#pass_sample_2').val();
					var pass_sample_3 = $('#pass_sample_3').val();
					var pass_sample_4 = $('#pass_sample_4').val();

					break;
				} else {
					var chk_grd = "0";
					var cum_wt_gm_1 = "0";
					var cum_wt_gm_2 = "0";
					var cum_wt_gm_3 = "0";
					var cum_wt_gm_4 = "0";

					var ret_wt_gm_1 = "0";
					var ret_wt_gm_2 = "0";
					var ret_wt_gm_3 = "0";
					var ret_wt_gm_4 = "0";


					var cum_ret_1 = "0";
					var cum_ret_2 = "0";
					var cum_ret_3 = "0";
					var cum_ret_4 = "0";

					var pass_sample_1 = "0";
					var pass_sample_2 = "0";
					var pass_sample_3 = "0";
					var pass_sample_4 = "0";

					var blank_extra = "0";
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
					var sp_w_s_1 = $('#sp_w_s_1').val();
					var sp_w_s_2 = $('#sp_w_s_2').val();
					var sp_wt_st_1 = $('#sp_wt_st_1').val();
					var sp_wt_st_2 = $('#sp_wt_st_2').val();
					var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
					var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
					var sp_specific_gravity = $('#sp_specific_gravity').val();
					var sp_water_abr = $('#sp_water_abr').val();
					var sp_water_abr_1 = $('#sp_water_abr_1').val();
					var sp_water_abr_2 = $('#sp_water_abr_2').val();

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
					var sp_water_abr_1 = "0";
					var sp_water_abr_2 = "0";
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

					var s11 = $('#s11').val();
					var s12 = $('#s12').val();
					var s13 = $('#s13').val();
					var s14 = $('#s14').val();
					var s15 = $('#s15').val();
					var s16 = $('#s16').val();
					var s17 = $('#s17').val();
					var s18 = $('#s18').val();
					var s19 = $('#s19').val();


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


			var idEdit = $('#idEdit').val();


			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_sou=' + chk_sou + '&s6total=' + s6total + '&soundness=' + soundness + '&s31=' + s31 + '&s32=' + s32 + '&s33=' + s33 + '&s34=' + s34 + '&s35=' + s35 + '&s36=' + s36 + '&s37=' + s37 + '&s38=' + s38 + '&s39=' + s39 + '&s30=' + s30 + '&s41=' + s41 + '&s42=' + s42 + '&s43=' + s43 + '&s44=' + s44 + '&s45=' + s45 + '&s46=' + s46 + '&s47=' + s47 + '&s48=' + s48 + '&s49=' + s49 + '&s40=' + s40 + '&s51=' + s51 + '&s52=' + s52 + '&s53=' + s53 + '&s54=' + s54 + '&s55=' + s55 + '&s56=' + s56 + '&s57=' + s57 + '&s58=' + s58 + '&s59=' + s59 + '&s50=' + s50 + '&s61=' + s61 + '&s62=' + s62 + '&s63=' + s63 + '&s64=' + s64 + '&s65=' + s65 + '&s66=' + s66 + '&s67=' + s67 + '&s68=' + s68 + '&s69=' + s69 + '&s60=' + s60 + '&chk_sp=' + chk_sp + '&sp_w_sur_1=' + sp_w_sur_1 + '&sp_w_sur_2=' + sp_w_sur_2 + '&sp_w_s_1=' + sp_w_s_1 + '&sp_w_s_2=' + sp_w_s_2 + '&sp_wt_st_1=' + sp_wt_st_1 + '&sp_wt_st_2=' + sp_wt_st_2 + '&sp_specific_gravity=' + sp_specific_gravity + '&sp_specific_gravity_1=' + sp_specific_gravity_1 + '&sp_specific_gravity_2=' + sp_specific_gravity_2 + '&sp_water_abr=' + sp_water_abr + '&sp_water_abr_1=' + sp_water_abr_1 + '&sp_water_abr_2=' + sp_water_abr_2 + '&chk_abr=' + chk_abr + '&abr_index=' + abr_index + '&abr_wt_t_a_1=' + abr_wt_t_a_1 + '&abr_wt_t_a_2=' + abr_wt_t_a_2 + '&abr_wt_t_b_1=' + abr_wt_t_b_1 + '&abr_wt_t_b_2=' + abr_wt_t_b_2 + '&abr_wt_t_c_1=' + abr_wt_t_c_1 + '&abr_wt_t_c_2=' + abr_wt_t_c_2 + '&abr_1=' + abr_1 + '&abr_2=' + abr_2 + '&abr_grading=' + abr_grading + '&abr_weight_charge=' + abr_weight_charge + '&abr_sphere=' + abr_sphere + '&abr_num_revo=' + abr_num_revo + '&chk_alkali=' + chk_alkali + '&alk_1=' + alk_1 + '&alk_2=' + alk_2 + '&alk_3=' + alk_3 + '&alk_4=' + alk_4 + '&alk_5=' + alk_5 + '&alk_6=' + alk_6 + '&alk_7=' + alk_7 + '&alk_8=' + alk_8 + '&alk_9=' + alk_9 + '&alk_10=' + alk_10 + '&alk_11=' + alk_11 + '&chk_den=' + chk_den + '&m11=' + m11 + '&m12=' + m12 + '&m13=' + m13 + '&m21=' + m21 + '&m22=' + m22 + '&m23=' + m23 + '&m31=' + m31 + '&m32=' + m32 + '&m33=' + m33 + '&avg_wom=' + avg_wom + '&vol=' + vol + '&bdl=' + bdl + '&chk_crushing=' + chk_crushing + '&cru_value=' + cru_value + '&cr_a_1=' + cr_a_1 + '&cr_a_2=' + cr_a_2 + '&cr_b_1=' + cr_b_1 + '&cr_b_2=' + cr_b_2 + '&cru_value_1=' + cru_value_1 + '&cru_value_2=' + cru_value_2 + '&chk_fines=' + chk_fines + '&fines_value=' + fines_value + '&f_a_1=' + f_a_1 + '&f_a_2=' + f_a_2 + '&f_b_1=' + f_b_1 + '&f_b_2=' + f_b_2 + '&f_c_1=' + f_c_1 + '&f_c_2=' + f_c_2 + '&f_d_1=' + f_d_1 + '&f_d_2=' + f_d_2 + '&avg_f_d=' + avg_f_d + '&avg_f_c=' + avg_f_c + '&chk_flk=' + chk_flk + '&fi_index=' + fi_index + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&a4=' + a4 + '&a5=' + a5 + '&a6=' + a6 + '&a7=' + a7 + '&a8=' + a8 + '&a9=' + a9 + '&suma=' + suma + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&b4=' + b4 + '&b5=' + b5 + '&b6=' + b6 + '&b7=' + b7 + '&b8=' + b8 + '&b9=' + b9 + '&s11=' + s11 + '&s12=' + s12 + '&s13=' + s13 + '&s14=' + s14 + '&s15=' + s15 + '&s16=' + s16 + '&s17=' + s17 + '&s18=' + s18 + '&s19=' + s19 + '&ei_index=' + ei_index + '&aa1=' + aa1 + '&aa2=' + aa2 + '&aa3=' + aa3 + '&aa4=' + aa4 + '&aa5=' + aa5 + '&aa6=' + aa6 + '&aa7=' + aa7 + '&aa8=' + aa8 + '&aa9=' + aa9 + '&dd1=' + dd1 + '&dd2=' + dd2 + '&dd3=' + dd3 + '&dd4=' + dd4 + '&dd5=' + dd5 + '&dd6=' + dd6 + '&dd7=' + dd7 + '&dd8=' + dd8 + '&dd9=' + dd9 + '&combined_index=' + combined_index + '&sumb=' + sumb + '&sumaa=' + sumaa + '&sumdd=' + sumdd + '&chk_impact=' + chk_impact + '&imp_w_m_a_1=' + imp_w_m_a_1 + '&imp_w_m_a_2=' + imp_w_m_a_2 + '&imp_w_m_b_1=' + imp_w_m_b_1 + '&imp_w_m_b_2=' + imp_w_m_b_2 + '&imp_w_m_c_1=' + imp_w_m_c_1 + '&imp_w_m_c_2=' + imp_w_m_c_2 + '&imp_value_1=' + imp_value_1 + '&imp_value_2=' + imp_value_2 + '&imp_value=' + imp_value + '&chk_ll=' + chk_ll + '&pen1=' + pen1 + '&pen2=' + pen2 + '&pen3=' + pen3 + '&pen4=' + pen4 + '&cont1=' + cont1 + '&cont2=' + cont2 + '&cont3=' + cont3 + '&cont4=' + cont4 + '&wc1=' + wc1 + '&wc2=' + wc2 + '&wc3=' + wc3 + '&wc4=' + wc4 + '&od1=' + od1 + '&od2=' + od2 + '&od3=' + od3 + '&od4=' + od4 + '&ww1=' + ww1 + '&ww2=' + ww2 + '&ww3=' + ww3 + '&ww4=' + ww4 + '&wf1=' + wf1 + '&wf2=' + wf2 + '&wf3=' + wf3 + '&wf4=' + wf4 + '&ds1=' + ds1 + '&ds2=' + ds2 + '&ds3=' + ds3 + '&ds4=' + ds4 + '&mo1=' + mo1 + '&mo2=' + mo2 + '&mo3=' + mo3 + '&mo4=' + mo4 + '&ln1=' + ln1 + '&ln2=' + ln2 + '&ln3=' + ln3 + '&ln4=' + ln4 + '&avg_ll=' + avg_ll + '&avg_pl=' + avg_pl + '&plastic_limit=' + plastic_limit + '&pi_value=' + pi_value + '&liquide_limit=' + liquide_limit + '&chk_grd=' + chk_grd + '&sieve_1=' + sieve_1 + '&sieve_2=' + sieve_2 + '&sieve_3=' + sieve_3 + '&sieve_4=' + sieve_4 + '&cum_wt_gm_1=' + cum_wt_gm_1 + '&cum_wt_gm_2=' + cum_wt_gm_2 + '&cum_wt_gm_3=' + cum_wt_gm_3 + '&cum_wt_gm_4=' + cum_wt_gm_4 + '&ret_wt_gm_1=' + ret_wt_gm_1 + '&ret_wt_gm_2=' + ret_wt_gm_2 + '&ret_wt_gm_3=' + ret_wt_gm_3 + '&ret_wt_gm_4=' + ret_wt_gm_4 + '&cum_ret_1=' + cum_ret_1 + '&cum_ret_2=' + cum_ret_2 + '&cum_ret_3=' + cum_ret_3 + '&cum_ret_4=' + cum_ret_4 + '&pass_sample_1=' + pass_sample_1 + '&pass_sample_2=' + pass_sample_2 + '&pass_sample_3=' + pass_sample_3 + '&pass_sample_4=' + pass_sample_4 + '&blank_extra=' + blank_extra + '&sample_taken=' + sample_taken + '&ulr=' + ulr + '&chk_mdd=' + chk_mdd + '&mdd=' + mdd + '&chk_omc=' + chk_omc + '&omc=' + omc + '&chk_cbr=' + chk_cbr + '&cbr=' + cbr+ '&amend_date=' + amend_date;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}


		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_g3_m5.php',
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
			url: '<?php echo $base_url; ?>save_g3_m5.php',
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
				var aa = temp.split(",");

				//MDD
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "mdd") {
						$('#mdd').val(data.mdd);
						var chk_mdd = data.chk_mdd;
						if (chk_mdd == "1") {
							$('#txtmdd').css("background-color", "var(--success)");
							$("#chk_mdd").prop("checked", true);
						} else {
							$('#txtmdd').css("background-color", "white");
							$("#chk_mdd").prop("checked", false);
						}
						break;
					}
				}

				//OMC
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "omc") {
						$('#omc').val(data.omc);
						var chk_omc = data.chk_omc;
						if (chk_mdd == "1") {
							$('#txtomc').css("background-color", "var(--success)");
							$("#chk_omc").prop("checked", true);
						} else {
							$('#txtomc').css("background-color", "white");
							$("#chk_omc").prop("checked", false);
						}
						break;
					}
				}

				//CBR
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "cbr") {
						$('#cbr').val(data.cbr);
						var chk_cbr = data.chk_cbr;
						if (chk_mdd == "1") {
							$('#txtcbr').css("background-color", "var(--success)");
							$("#chk_cbr").prop("checked", true);
						} else {
							$('#txtcbr').css("background-color", "white");
							$("#chk_cbr").prop("checked", false);
						}
						break;
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
						$('#sp_w_s_1').val(data.sp_w_s_1);
						$('#sp_w_s_2').val(data.sp_w_s_2);
						$('#sp_wt_st_1').val(data.sp_wt_st_1);
						$('#sp_wt_st_2').val(data.sp_wt_st_2);
						$('#sp_specific_gravity_1').val(data.sp_specific_gravity_1);
						$('#sp_specific_gravity_2').val(data.sp_specific_gravity_2);
						$('#sp_specific_gravity').val(data.sp_specific_gravity);
						$('#sp_water_abr').val(data.sp_water_abr);
						$('#sp_water_abr_1').val(data.sp_water_abr_1);
						$('#sp_water_abr_2').val(data.sp_water_abr_2);

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

						$('#ret_wt_gm_1').val(data.ret_wt_gm_1);
						$('#ret_wt_gm_2').val(data.ret_wt_gm_2);
						$('#ret_wt_gm_3').val(data.ret_wt_gm_3);
						$('#ret_wt_gm_4').val(data.ret_wt_gm_4);

						$('#cum_ret_1').val(data.cum_ret_1);
						$('#cum_ret_2').val(data.cum_ret_2);
						$('#cum_ret_3').val(data.cum_ret_3);
						$('#cum_ret_4').val(data.cum_ret_4);

						$('#pass_sample_1').val(data.pass_sample_1);
						$('#pass_sample_2').val(data.pass_sample_2);
						$('#pass_sample_3').val(data.pass_sample_3);
						$('#pass_sample_4').val(data.pass_sample_4);

						$('#blank_extra').val(data.blank_extra);

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