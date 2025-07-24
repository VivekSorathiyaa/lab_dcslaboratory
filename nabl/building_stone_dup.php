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
$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
$result_select4 = mysqli_query($conn, $select_query4);

if (mysqli_num_rows($result_select4) > 0) {
	$row_select4 = mysqli_fetch_assoc($result_select4);
	$bs_loacation = $row_select4['bs_location'];
	$bs_depth = $row_select4['bs_depth'];
	$bs_bhno = $row_select4['bs_bhno'];
}

?>


<div class="content-wrapper" style="margin-left:0px !important;">

	<section class="content common_material p-0">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">BULIDING STONE</h2>
					</div>
					<div class="box-default">
						<form class="form" id="Glazed" method="post">
							<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
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
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
															<h4 class="panel-title">
																<b>COMPRESSIVE STRENGTH</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse1" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">
															<div class="col-lg-4">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">COMPRESSIVE STRENGTH</label>
																	<div class="col-sm-8">
																		<input type="checkbox" name="chk_com" id="chk_com" value="chk_com"><br>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">DIA :</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="dia" name="dia">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">HEIGHT :</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="height" name="height">
																	</div>
																</div>
															</div>
														</div>
														<br>
														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">Observations</label>
																	</div>
																</div>
															</div>

															<div class="col-lg-5">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">Sample</label>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">I</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">II</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">III</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">IV</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">V</label>
																	</div>
																</div>
															</div>
														</div>
														</br>
														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Maximum load applied to the test piece before filure A (kg)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="a1" name="a1">
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
																		<input type="text" class="form-control" id="a3" name="a3">
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
																		<input type="text" class="form-control" id="a5" name="a5">
																	</div>
																</div>
															</div>
														</div>
														<br>

														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Area of bearing face of the test piece B (cm<sup>2</sup>)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="b1" name="b1">
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
																		<input type="text" class="form-control" id="b3" name="b3">
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
																		<input type="text" class="form-control" id="b5" name="b5">
																	</div>
																</div>
															</div>
														</div>
														<br>

														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">(i) When ratio of height to diameter is greater then compressive strength (C<sub>p</sub>) = A/B (kg/cm<sup>2</sup>)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="c1" name="c1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="c2" name="c2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="c3" name="c3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="c4" name="c4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="c5" name="c5">
																	</div>
																</div>
															</div>
														</div>
														<br>

														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">(ii) When ratio of height to diameter differs from unity by 25% or more compressive strength (C<sub>c</sub>) = (C<sub>p</sub>) / 0.778 + 0.222(b + h) (kg/cm<sup>2</sup>)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="comp_1" name="comp_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="comp_2" name="comp_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="comp_3" name="comp_3">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="comp_4" name="comp_4">
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="comp_5" name="comp_5">
																	</div>
																</div>
															</div>
														</div>
														<br>

														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Average Compressive Strength (kg/cm<sup>2</sup>)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-5">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="avg_comp" name="avg_comp">
																	</div>
																</div>
															</div>

														</div>
														<br>
													</div>
												</div>
											</div>

										<?php } else if ($r1['test_code'] == "wtr") {
											$test_check .= "wtr,";

										?>
											<div class="panel panel-default" id="wtr">
												<div class="panel-heading" id="txtwtr">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
															<h4 class="panel-title">
																<b>WATER ABSORPTION</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse2" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">WATER ABSORPTION</label>
																	<div class="col-sm-8">
																		<input type="checkbox" name="chk_wtr" id="chk_wtr" value="chk_wtr"><br>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">Observations</label>
																	</div>
																</div>
															</div>

															<div class="col-lg-5">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">Sample</label>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">I</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">II</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">III</label>
																	</div>
																</div>
															</div>

														</div>
														</br>
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Weight of the saturated surface dry test piece in W1 (gms)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="w1_d_1" name="w1_d_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w1_d_2" name="w1_d_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w1_d_3" name="w1_d_3">
																	</div>
																</div>
															</div>

														</div>
														</br>
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Weight of oven dry test piece in W2 (gms)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="w2_d_1" name="w2_d_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w2_d_2" name="w2_d_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w2_d_3" name="w2_d_3">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Water Absorption (%) (W1 - W2 / W2) X 100</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="sp_water_abr_1" name="sp_water_abr_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr_2" name="sp_water_abr_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_water_abr_3" name="sp_water_abr_3">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Average Water Absorption (%)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="sp_water_abr" name="sp_water_abr">
																	</div>
																</div>
															</div>


														</div>


														<br>
													</div>
												</div>
											</div>
										<?php } else if ($r1['test_code'] == "spg") {
											$test_check .= "spg,";

										?>
											<div class="panel panel-default" id="spg">
												<div class="panel-heading" id="txttsp">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
															<h4 class="panel-title">
																<b>TRUE SPECIFIC GRAVITY</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse3" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">TRUE SPECIFIC GRAVITY</label>
																	<div class="col-sm-8">
																		<input type="checkbox" name="chk_t_sp" id="chk_t_sp" value="chk_t_sp"><br>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">Observations</label>
																	</div>
																</div>
															</div>

															<div class="col-lg-5">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">Sample</label>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">I</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">II</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">III</label>
																	</div>
																</div>
															</div>

														</div>
														</br>
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Weight of the empty specific gravity bottle with stopper W1 (gms)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="w1_c_1" name="w1_c_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w1_c_2" name="w1_c_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w1_c_3" name="w1_c_3">
																	</div>
																</div>
															</div>

														</div>
														</br>
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Weight of specific gravity bottle with stopper and stone powder W2 (gms)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w2_c_1" name="w2_c_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w2_c_2" name="w2_c_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w2_c_3" name="w2_c_3">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Weight of specific gravity bottle with stopper and stone powder and distilled water W3 (gms)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="w3_c_1" name="w3_c_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w3_c_2" name="w3_c_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w3_c_3" name="w3_c_3">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Weight of specific gravity bottle with stopper and Fully filled with distilled water W4 (gms)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="w4_c_1" name="w4_c_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w4_c_2" name="w4_c_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="w4_c_3" name="w4_c_3">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">True Specific Gravity = W2 - W1 / [(W4 - W1)-(W3 - W2)]</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="sp_1" name="sp_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_2" name="sp_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sp_3" name="sp_3">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Average True Specific Gravity</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="avg_true_sp" name="avg_true_sp">
																	</div>
																</div>
															</div>


														</div>


														<br>
													</div>
												</div>
											</div>
										<?php } else if ($r1['test_code'] == "por") {
											$test_check .= "por,";

										?>
											<div class="panel panel-default" id="por">
												<div class="panel-heading" id="txtsp">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
															<h4 class="panel-title">
																<b>APPARENT SPECIFIC GRAVITY</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse4" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group">
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">APPARENT SPECIFIC GRAVITY</label>
																	<div class="col-sm-8">
																		<input type="checkbox" name="chk_sp" id="chk_sp" value="chk_sp"><br>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">Observations</label>
																	</div>
																</div>
															</div>

															<div class="col-lg-5">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="col-sm-2 control-label">Sample</label>
																	</div>
																</div>
															</div>

														</div>
														<br>
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">

																	</div>
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">I</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">II</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">III</label>
																	</div>
																</div>
															</div>

														</div>
														</br>
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Weight of Oven-Dry Sample (g) A</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="od_1" name="od_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="od_2" name="od_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="od_3" name="od_3">
																	</div>
																</div>
															</div>

														</div>
														</br>
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Weight of Saturated Surface Dry Sample (g) B</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sd_1" name="sd_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sd_2" name="sd_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="sd_3" name="sd_3">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Qunaity of Water Added in 1000 ML jar (g) C</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="wa_1" name="wa_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wa_2" name="wa_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="wa_3" name="wa_3">
																	</div>
																</div>
															</div>

														</div>
														<br>


														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Apparent Specific Gravity = A / (1000-C)</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="app_sp_1" name="app_sp_1">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="app_sp_2" name="app_sp_2">
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control" id="app_sp_3" name="app_sp_3">
																	</div>
																</div>
															</div>

														</div>
														<br>

														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<label for="inputEmail3" class="control-label">Average Apparent Specific Gravity</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<div class="col-sm-12">
																		<input type="text" class="form-control " id="avg_app_sp" name="avg_app_sp">
																	</div>
																</div>
															</div>


														</div>


														<br>
													</div>
												</div>
											</div>
									<?php }
									}	?>
									</div>
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
													$querys_job1 = "SELECT * FROM granite_stone WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
												if ($val == 0 || $val == 5 || $val == 6) {
												?>
													<div class="col-sm-2">
														<a target='_blank' href="<?php echo $base_url; ?>print_report/print_building_stone.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

													</div>
													<div class="col-sm-2">
														<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_building_stone.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

													</div>
												<?php } ?>

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
														<th style="text-align:center;"><label>Report No.</label></th>
														<th style="text-align:center;"><label>Job No.</label></th>
														<th style="text-align:center;"><label>Lab No.</label></th>



													</tr>
													<?php
													$query = "select * from span_building_stone WHERE lab_no='$aa'  and `is_deleted`='0'";

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

																	<td style="text-align:center;"><?php echo $r['report_no']; ?></td>
																	<td style="text-align:center;"><?php echo $r['job_no']; ?></td>
																	<td style="text-align:center;"><?php echo $r['lab_no']; ?></td>
																</tr>
													<?php
															}
														}
													}
													?>

													<?php
													// $query = "select * from span_building_stone WHERE lab_no='$aa'  and `is_deleted`='0'";

													// $result = mysqli_query($conn, $query);


													// if (mysqli_num_rows($result) > 0) {
													// while($r = mysqli_fetch_array($result)){

													// if($r['is_deleted'] == 0){
													?>
													<!--tr>
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
											<td style="text-align:center;"><?php echo $r['report_no']; ?></td>
											<td style="text-align:center;"><?php echo $r['job_no']; ?></td>
											<td style="text-align:center;"><?php echo $r['lab_no']; ?></td>					
											</tr-->
													<?php
													// }
													// }
													// }
													?>

												</table>
											</div>
										</div>

										<hr>
									</div> <!-- TEST LIST FILD VAIBHAV-->
									<input type="text" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ','); ?>">
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

	// $('#btn_save').click(function(){
	// $('#btn_save').hide();
	// });


	$(document).ready(function() {
		$('#btn_edit_data').hide();
		$('#alert').hide();

		$('#btn_save').click(function() {
			$('#btn_save').hide();
		});

		$('#chk_com').change(function() {
			if (this.checked) {
				$('#txtcom').css("background-color", "var(--success)");
			} else {
				$('#txtcom').css("background-color", "white");
			}

		});

		$('#chk_wtr').change(function() {
			if (this.checked) {
				$('#txtwtr').css("background-color", "var(--success)");
			} else {
				$('#txtwtr').css("background-color", "white");
			}

		});

		$('#chk_t_sp').change(function() {
			if (this.checked) {
				$('#txttsp').css("background-color", "var(--success)");
			} else {
				$('#txttsp').css("background-color", "white");
			}

		});

		$('#chk_sp').change(function() {
			if (this.checked) {
				$('#txtsp').css("background-color", "var(--success)");
			} else {
				$('#txtsp').css("background-color", "white");
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
			url: '<?php echo $base_url; ?>savebulding_stone.php',
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
			var bh_no = $('#bh_no').val();
			var location_source = $('#location_source').val();
			var depths = $('#depths').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");
			//WATERR ABSORPTION
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "wtr") {
					if (document.getElementById('chk_wtr').checked) {
						var chk_wtr = "1";
					} else {
						var chk_wtr = "0";
					}



					var w1_d_1 = $('#w1_d_1').val();
					var w1_d_2 = $('#w1_d_2').val();
					var w1_d_3 = $('#w1_d_3').val();
					var w2_d_1 = $('#w2_d_1').val();
					var w2_d_2 = $('#w2_d_2').val();
					var w2_d_3 = $('#w2_d_3').val();
					var sp_water_abr_1 = $('#sp_water_abr_1').val();
					var sp_water_abr_2 = $('#sp_water_abr_2').val();
					var sp_water_abr_3 = $('#sp_water_abr_3').val();
					var sp_water_abr = $('#sp_water_abr').val();

					break;
				} else {
					var chk_wtr = "0";
					var w1_d_1 = "0";
					var w1_d_2 = "0";
					var w1_d_3 = "0";
					var w2_d_1 = "0";
					var w2_d_2 = "0";
					var w2_d_3 = "0";
					var sp_water_abr_1 = "0";
					var sp_water_abr_2 = "0";
					var sp_water_abr_3 = "0";
					var sp_water_abr = "0";
				}

			}

			//COMPRESSIVE STRENGTH
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "com") {

					if (document.getElementById('chk_com').checked) {
						var chk_com = "1";
					} else {
						var chk_com = "0";
					}

					var dia = $('#dia').val();
					var height = $('#height').val();
					var a1 = $('#a1').val();
					var a2 = $('#a2').val();
					var a3 = $('#a3').val();
					var a4 = $('#a4').val();
					var a5 = $('#a5').val();
					var b1 = $('#b1').val();
					var b2 = $('#b2').val();
					var b3 = $('#b3').val();
					var b4 = $('#b4').val();
					var b5 = $('#b5').val();
					var c1 = $('#c1').val();
					var c2 = $('#c2').val();
					var c3 = $('#c3').val();
					var c4 = $('#c4').val();
					var c5 = $('#c5').val();
					var comp_1 = $('#comp_1').val();
					var comp_2 = $('#comp_2').val();
					var comp_3 = $('#comp_3').val();
					var comp_4 = $('#comp_4').val();
					var comp_5 = $('#comp_5').val();
					var avg_comp = $('#avg_comp').val();
					break;
				} else {
					var chk_com = "0";
					var dia = "0";
					var height = "0";
					var a1 = "0";
					var a2 = "0";
					var a3 = "0";
					var a4 = "0";
					var a5 = "0";
					var b1 = "0";
					var b2 = "0";
					var b3 = "0";
					var b4 = "0";
					var b5 = "0";
					var c1 = "0";
					var c2 = "0";
					var c3 = "0";
					var c4 = "0";
					var c5 = "0";
					var comp_1 = "0";
					var comp_2 = "0";
					var comp_3 = "0";
					var comp_4 = "0";
					var comp_5 = "0";
					var avg_comp = "0";
				}

			}

			// True SPECIFIC gravity
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "spg") {

					if (document.getElementById('chk_t_sp').checked) {
						var chk_t_sp = "1";
					} else {
						var chk_t_sp = "0";
					}

					var w1_c_1 = $('#w1_c_1').val();
					var w1_c_2 = $('#w1_c_2').val();
					var w1_c_3 = $('#w1_c_3').val();
					var w2_c_1 = $('#w2_c_1').val();
					var w2_c_2 = $('#w2_c_2').val();
					var w2_c_3 = $('#w2_c_3').val();
					var w3_c_1 = $('#w3_c_1').val();
					var w3_c_2 = $('#w3_c_2').val();
					var w3_c_3 = $('#w3_c_3').val();
					var w4_c_1 = $('#w4_c_1').val();
					var w4_c_2 = $('#w4_c_2').val();
					var w4_c_3 = $('#w4_c_3').val();
					var sp_1 = $('#sp_1').val();
					var sp_2 = $('#sp_2').val();
					var sp_3 = $('#sp_3').val();

					var avg_true_sp = $('#avg_true_sp').val();

					break;
				} else {
					var chk_t_sp = "0";
					var avg_true_sp = "0";
					var w1_c_1 = "0";
					var w1_c_2 = "0";
					var w1_c_3 = "0";
					var w2_c_1 = "0";
					var w2_c_2 = "0";
					var w2_c_3 = "0";
					var w3_c_1 = "0";
					var w3_c_2 = "0";
					var w3_c_3 = "0";
					var w4_c_1 = "0";
					var w4_c_2 = "0";
					var w4_c_3 = "0";
					var sp_1 = "0";
					var sp_2 = "0";
					var sp_3 = "0";

				}

			}


			//  Apparent gravity
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "por") {

					if (document.getElementById('chk_sp').checked) {
						var chk_sp = "1";
					} else {
						var chk_sp = "0";
					}

					var od_1 = $('#od_1').val();
					var od_2 = $('#od_2').val();
					var od_3 = $('#od_3').val();
					var sd_1 = $('#sd_1').val();
					var sd_2 = $('#sd_2').val();
					var sd_3 = $('#sd_3').val();
					var wa_1 = $('#wa_1').val();
					var wa_2 = $('#wa_2').val();
					var wa_3 = $('#wa_3').val();
					var app_sp_1 = $('#app_sp_1').val();
					var app_sp_2 = $('#app_sp_2').val();
					var app_sp_3 = $('#app_sp_3').val();
					var avg_app_sp = $('#avg_app_sp').val();


					break;
				} else {
					var chk_sp = "0";
					var od_1 = "0";
					var od_2 = "0";
					var od_3 = "0";
					var sd_1 = "0";
					var sd_2 = "0";
					var sd_3 = "0";
					var wa_1 = "0";
					var wa_2 = "0";
					var wa_3 = "0";
					var app_sp_1 = "0";
					var app_sp_2 = "0";
					var app_sp_3 = "0";
					var avg_app_sp = "0";


				}

			}



			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&location_source=' + location_source + '&bh_no=' + bh_no + '&depths=' + depths + '&chk_wtr=' + chk_wtr + '&w1_d_1=' + w1_d_1 + '&w1_d_2=' + w1_d_2 + '&w1_d_3=' + w1_d_3 + '&w2_d_1=' + w2_d_1 + '&w2_d_2=' + w2_d_2 + '&w2_d_3=' + w2_d_3 + '&sp_water_abr_1=' + sp_water_abr_1 + '&sp_water_abr_2=' + sp_water_abr_2 + '&sp_water_abr_3=' + sp_water_abr_3 + '&sp_water_abr=' + sp_water_abr + '&chk_com=' + chk_com + '&dia=' + dia + '&height=' + height + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&a4=' + a4 + '&a5=' + a5 + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&b4=' + b4 + '&b5=' + b5 + '&c1=' + c1 + '&c2=' + c2 + '&c3=' + c3 + '&c4=' + c4 + '&c5=' + c5 + '&comp_1=' + comp_1 + '&comp_2=' + comp_2 + '&comp_3=' + comp_3 + '&comp_4=' + comp_4 + '&comp_5=' + comp_5 + '&avg_comp=' + avg_comp + '&chk_t_sp=' + chk_t_sp + '&w1_c_1=' + w1_c_1 + '&w1_c_2=' + w1_c_2 + '&w1_c_3=' + w1_c_3 + '&w2_c_1=' + w2_c_1 + '&w2_c_2=' + w2_c_2 + '&w2_c_3=' + w2_c_3 + '&w3_c_1=' + w3_c_1 + '&w3_c_2=' + w3_c_2 + '&w3_c_3=' + w3_c_3 + '&w4_c_1=' + w4_c_1 + '&w4_c_2=' + w4_c_2 + '&w4_c_3=' + w4_c_3 + '&sp_1=' + sp_1 + '&sp_2=' + sp_2 + '&sp_3=' + sp_3 + '&avg_true_sp=' + avg_true_sp + '&chk_sp=' + chk_sp + '&od_1=' + od_1 + '&od_2=' + od_2 + '&od_3=' + od_3 + '&sd_1=' + sd_1 + '&sd_2=' + sd_2 + '&sd_3=' + sd_3 + '&wa_1=' + wa_1 + '&wa_2=' + wa_2 + '&wa_3=' + wa_3 + '&app_sp_1=' + app_sp_1 + '&app_sp_2=' + app_sp_2 + '&app_sp_3=' + app_sp_3 + '&avg_app_sp=' + avg_app_sp;
		} else if (type == 'edit') {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var bh_no = $('#bh_no').val();
			var location_source = $('#location_source').val();
			var depths = $('#depths').val();
			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//WATERR ABSORPTION
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "wtr") {
					if (document.getElementById('chk_wtr').checked) {
						var chk_wtr = "1";
					} else {
						var chk_wtr = "0";
					}



					var w1_d_1 = $('#w1_d_1').val();
					var w1_d_2 = $('#w1_d_2').val();
					var w1_d_3 = $('#w1_d_3').val();
					var w2_d_1 = $('#w2_d_1').val();
					var w2_d_2 = $('#w2_d_2').val();
					var w2_d_3 = $('#w2_d_3').val();
					var sp_water_abr_1 = $('#sp_water_abr_1').val();
					var sp_water_abr_2 = $('#sp_water_abr_2').val();
					var sp_water_abr_3 = $('#sp_water_abr_3').val();
					var sp_water_abr = $('#sp_water_abr').val();

					break;
				} else {
					var chk_wtr = "0";
					var w1_d_1 = "0";
					var w1_d_2 = "0";
					var w1_d_3 = "0";
					var w2_d_1 = "0";
					var w2_d_2 = "0";
					var w2_d_3 = "0";
					var sp_water_abr_1 = "0";
					var sp_water_abr_2 = "0";
					var sp_water_abr_3 = "0";
					var sp_water_abr = "0";
				}

			}

			//COMPRESSIVE STRENGTH
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "com") {

					if (document.getElementById('chk_com').checked) {
						var chk_com = "1";
					} else {
						var chk_com = "0";
					}

					var dia = $('#dia').val();
					var height = $('#height').val();
					var a1 = $('#a1').val();
					var a2 = $('#a2').val();
					var a3 = $('#a3').val();
					var a4 = $('#a4').val();
					var a5 = $('#a5').val();
					var b1 = $('#b1').val();
					var b2 = $('#b2').val();
					var b3 = $('#b3').val();
					var b4 = $('#b4').val();
					var b5 = $('#b5').val();
					var c1 = $('#c1').val();
					var c2 = $('#c2').val();
					var c3 = $('#c3').val();
					var c4 = $('#c4').val();
					var c5 = $('#c5').val();
					var comp_1 = $('#comp_1').val();
					var comp_2 = $('#comp_2').val();
					var comp_3 = $('#comp_3').val();
					var comp_4 = $('#comp_4').val();
					var comp_5 = $('#comp_5').val();
					var avg_comp = $('#avg_comp').val();
					break;
				} else {
					var chk_com = "0";
					var dia = "0";
					var height = "0";
					var a1 = "0";
					var a2 = "0";
					var a3 = "0";
					var a4 = "0";
					var a5 = "0";
					var b1 = "0";
					var b2 = "0";
					var b3 = "0";
					var b4 = "0";
					var b5 = "0";
					var c1 = "0";
					var c2 = "0";
					var c3 = "0";
					var c4 = "0";
					var c5 = "0";
					var comp_1 = "0";
					var comp_2 = "0";
					var comp_3 = "0";
					var comp_4 = "0";
					var comp_5 = "0";
					var avg_comp = "0";
				}

			}

			// True SPECIFIC gravity
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "spg") {

					if (document.getElementById('chk_t_sp').checked) {
						var chk_t_sp = "1";
					} else {
						var chk_t_sp = "0";
					}

					var w1_c_1 = $('#w1_c_1').val();
					var w1_c_2 = $('#w1_c_2').val();
					var w1_c_3 = $('#w1_c_3').val();
					var w2_c_1 = $('#w2_c_1').val();
					var w2_c_2 = $('#w2_c_2').val();
					var w2_c_3 = $('#w2_c_3').val();
					var w3_c_1 = $('#w3_c_1').val();
					var w3_c_2 = $('#w3_c_2').val();
					var w3_c_3 = $('#w3_c_3').val();
					var w4_c_1 = $('#w4_c_1').val();
					var w4_c_2 = $('#w4_c_2').val();
					var w4_c_3 = $('#w4_c_3').val();
					var sp_1 = $('#sp_1').val();
					var sp_2 = $('#sp_2').val();
					var sp_3 = $('#sp_3').val();

					var avg_true_sp = $('#avg_true_sp').val();

					break;
				} else {
					var chk_t_sp = "0";
					var avg_true_sp = "0";
					var w1_c_1 = "0";
					var w1_c_2 = "0";
					var w1_c_3 = "0";
					var w2_c_1 = "0";
					var w2_c_2 = "0";
					var w2_c_3 = "0";
					var w3_c_1 = "0";
					var w3_c_2 = "0";
					var w3_c_3 = "0";
					var w4_c_1 = "0";
					var w4_c_2 = "0";
					var w4_c_3 = "0";
					var sp_1 = "0";
					var sp_2 = "0";
					var sp_3 = "0";

				}

			}


			//  Apparent gravity
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "por") {

					if (document.getElementById('chk_sp').checked) {
						var chk_sp = "1";
					} else {
						var chk_sp = "0";
					}

					var od_1 = $('#od_1').val();
					var od_2 = $('#od_2').val();
					var od_3 = $('#od_3').val();
					var sd_1 = $('#sd_1').val();
					var sd_2 = $('#sd_2').val();
					var sd_3 = $('#sd_3').val();
					var wa_1 = $('#wa_1').val();
					var wa_2 = $('#wa_2').val();
					var wa_3 = $('#wa_3').val();
					var app_sp_1 = $('#app_sp_1').val();
					var app_sp_2 = $('#app_sp_2').val();
					var app_sp_3 = $('#app_sp_3').val();
					var avg_app_sp = $('#avg_app_sp').val();


					break;
				} else {
					var chk_sp = "0";
					var od_1 = "0";
					var od_2 = "0";
					var od_3 = "0";
					var sd_1 = "0";
					var sd_2 = "0";
					var sd_3 = "0";
					var wa_1 = "0";
					var wa_2 = "0";
					var wa_3 = "0";
					var app_sp_1 = "0";
					var app_sp_2 = "0";
					var app_sp_3 = "0";
					var avg_app_sp = "0";


				}

			}

			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&location_source=' + location_source + '&bh_no=' + bh_no + '&depths=' + depths + '&chk_wtr=' + chk_wtr + '&w1_d_1=' + w1_d_1 + '&w1_d_2=' + w1_d_2 + '&w1_d_3=' + w1_d_3 + '&w2_d_1=' + w2_d_1 + '&w2_d_2=' + w2_d_2 + '&w2_d_3=' + w2_d_3 + '&sp_water_abr_1=' + sp_water_abr_1 + '&sp_water_abr_2=' + sp_water_abr_2 + '&sp_water_abr_3=' + sp_water_abr_3 + '&sp_water_abr=' + sp_water_abr + '&chk_com=' + chk_com + '&dia=' + dia + '&height=' + height + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&a4=' + a4 + '&a5=' + a5 + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&b4=' + b4 + '&b5=' + b5 + '&c1=' + c1 + '&c2=' + c2 + '&c3=' + c3 + '&c4=' + c4 + '&c5=' + c5 + '&comp_1=' + comp_1 + '&comp_2=' + comp_2 + '&comp_3=' + comp_3 + '&comp_4=' + comp_4 + '&comp_5=' + comp_5 + '&avg_comp=' + avg_comp + '&chk_t_sp=' + chk_t_sp + '&w1_c_1=' + w1_c_1 + '&w1_c_2=' + w1_c_2 + '&w1_c_3=' + w1_c_3 + '&w2_c_1=' + w2_c_1 + '&w2_c_2=' + w2_c_2 + '&w2_c_3=' + w2_c_3 + '&w3_c_1=' + w3_c_1 + '&w3_c_2=' + w3_c_2 + '&w3_c_3=' + w3_c_3 + '&w4_c_1=' + w4_c_1 + '&w4_c_2=' + w4_c_2 + '&w4_c_3=' + w4_c_3 + '&sp_1=' + sp_1 + '&sp_2=' + sp_2 + '&sp_3=' + sp_3 + '&avg_true_sp=' + avg_true_sp + '&chk_sp=' + chk_sp + '&od_1=' + od_1 + '&od_2=' + od_2 + '&od_3=' + od_3 + '&sd_1=' + sd_1 + '&sd_2=' + sd_2 + '&sd_3=' + sd_3 + '&wa_1=' + wa_1 + '&wa_2=' + wa_2 + '&wa_3=' + wa_3 + '&app_sp_1=' + app_sp_1 + '&app_sp_2=' + app_sp_2 + '&app_sp_3=' + app_sp_3 + '&avg_app_sp=' + avg_app_sp;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>savebulding_stone.php',
			data: billData,
			dataType: 'JSON',
			success: function(msg) {
				$('#btn_save').hide();
				getGlazedTiles();
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				//window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+"&&job_no="+job_no;

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
			url: '<?php echo $base_url; ?>savebulding_stone.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);
				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);

				//WATER ABR
				var temp = $('#test_list').val();
				var aa = temp.split(",");
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "wtr") {
						var chk_wtr = data.chk_wtr;
						if (chk_wtr == "1") {
							$('#txtwtr').css("background-color", "var(--success)");
							$("#chk_wtr").prop("checked", true);
						} else {
							$('#txtwtr').css("background-color", "var(--success)");
							$("#chk_wtr").prop("checked", false);
						}
						//GRADATION DATA FETCH-1
						$('#w1_d_1').val(data.w1_d_1);
						$('#w1_d_2').val(data.w1_d_2);
						$('#w1_d_3').val(data.w1_d_3);
						$('#w2_d_1').val(data.w2_d_1);
						$('#w2_d_2').val(data.w2_d_2);
						$('#w2_d_3').val(data.w2_d_3);
						$('#sp_water_abr_1').val(data.sp_water_abr_1);
						$('#sp_water_abr_2').val(data.sp_water_abr_2);
						$('#sp_water_abr_3').val(data.sp_water_abr_3);
						$('#sp_water_abr').val(data.sp_water_abr);


						break;
					}


				}


				//Compressive Strength
				var temp = $('#test_list').val();
				var aa = temp.split(",");
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
						//GRADATION DATA FETCH-1
						$('#dia').val(data.dia);
						$('#height').val(data.height);
						$('#a1').val(data.a1);
						$('#a2').val(data.a2);
						$('#a3').val(data.a3);
						$('#a4').val(data.a4);
						$('#a5').val(data.a5);
						$('#b1').val(data.b1);
						$('#b2').val(data.b2);
						$('#b3').val(data.b3);
						$('#b4').val(data.b4);
						$('#b5').val(data.b5);
						$('#c1').val(data.c1);
						$('#c2').val(data.c2);
						$('#c3').val(data.c3);
						$('#c4').val(data.c4);
						$('#c5').val(data.c5);
						$('#comp_1').val(data.comp_1);
						$('#comp_2').val(data.comp_2);
						$('#comp_3').val(data.comp_3);
						$('#comp_4').val(data.comp_4);
						$('#comp_5').val(data.comp_5);
						$('#avg_comp').val(data.avg_comp);


						break;
					}


				}

				//True SPECIFIC GRAVITY
				var temp = $('#test_list').val();
				var aa = temp.split(",");
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "spg") {
						var chk_t_sp = data.chk_t_sp;
						if (chk_t_sp == "1") {
							$('#txttsp').css("background-color", "var(--success)");
							$("#chk_t_sp").prop("checked", true);
						} else {
							$('#txttsp').css("background-color", "var(--success)");
							$("#chk_t_sp").prop("checked", false);
						}

						$('#w1_c_1').val(data.w1_c_1);
						$('#w1_c_2').val(data.w1_c_2);
						$('#w1_c_3').val(data.w1_c_3);
						$('#w2_c_1').val(data.w2_c_1);
						$('#w2_c_2').val(data.w2_c_2);
						$('#w2_c_3').val(data.w2_c_3);
						$('#w3_c_1').val(data.w3_c_1);
						$('#w3_c_2').val(data.w3_c_2);
						$('#w3_c_3').val(data.w3_c_3);
						$('#w4_c_1').val(data.w4_c_1);
						$('#w4_c_2').val(data.w4_c_2);
						$('#w4_c_3').val(data.w4_c_3);
						$('#sp_1').val(data.sp_1);
						$('#sp_2').val(data.sp_2);
						$('#sp_3').val(data.sp_3);
						$('#avg_true_sp').val(data.avg_true_sp);

						break;
					}


				}

				//Apparent SPECIFIC GRAVITY
				var temp = $('#test_list').val();
				var aa = temp.split(",");
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "por") {
						var chk_sp = data.chk_sp;
						if (chk_sp == "1") {
							$('#txtsp').css("background-color", "var(--success)");
							$("#chk_sp").prop("checked", true);
						} else {
							$('#txtsp').css("background-color", "var(--success)");
							$("#chk_sp").prop("checked", false);
						}

						$('#od_1').val(data.od_1);
						$('#od_2').val(data.od_2);
						$('#od_3').val(data.od_3);
						$('#sd_1').val(data.sd_1);
						$('#sd_2').val(data.sd_2);
						$('#sd_3').val(data.sd_3);
						$('#wa_1').val(data.wa_1);
						$('#wa_2').val(data.wa_2);
						$('#wa_3').val(data.wa_3);
						$('#app_sp_1').val(data.app_sp_1);
						$('#app_sp_2').val(data.app_sp_2);
						$('#app_sp_3').val(data.app_sp_3);
						$('#avg_app_sp').val(data.avg_app_sp);


						break;
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


00