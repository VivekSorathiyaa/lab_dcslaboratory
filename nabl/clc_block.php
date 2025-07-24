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
	$in_l = $row_select4['inl'];
	$in_w = $row_select4['inw'];
	$in_h = $row_select4['inh'];
	$in_den = $row_select4['inden'];
	$in_grade = $row_select4['ingrade'];
}

?>
<div class="content-wrapper" style="margin-left:0px !important;">

	<section class="content common_material p-0">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">CC BLOCK</h2>
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

								<div class="col-lg-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Length :</label>
										<div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="in_l" value="<?php echo $in_l; ?>" name="in_l">
											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_l"  name="in_l" ReadOnly value="400">-->
										</div>

										<label for="inputEmail3" class="col-sm-2 control-label">Width :</label>
										<div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="in_w" value="<?php echo $in_w; ?>" name="in_w">
											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_w"  name="in_w" ReadOnly value="100">-->
										</div>

										<label for="inputEmail3" class="col-sm-2 control-label">Height :</label>
										<div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="in_h" value="<?php echo $in_h; ?>" name="in_h">
											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_h"  name="in_h" ReadOnly value="200">-->
										</div>

									</div>
								</div>

							</div>
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Density :</label>


										<div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="in_den" value="<?php echo $in_den; ?>" name="in_den">
											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_den"  name="in_den" ReadOnly value="800">-->
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Grade :</label>
										<div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="in_grade" value="<?php echo $in_grade; ?>" name="in_grade">
											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_grade" 	 name="in_grade" ReadOnly value="G-2.5">-->
										</div>
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No. :</label>	-->
										<div class="col-sm-6">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" ReadOnly>
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
											$querys_job1 = "SELECT * FROM clc_block WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
										//$val =  $_SESSION['isadmin'];
										//if ($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type'] == "direct_nabl" || $_SESSION['nabl_type'] == "direct_non_nabl") {
										?>
											<div class="col-sm-2">
												<a target='_blank' href="<?php echo $base_url; ?>print_report/print_clc_block.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

											</div>
											<div class="col-sm-2">
												<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_clc_block.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

											</div>
										<?php //} ?>

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
																<b>COMPRESSIVE STRENGTH</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse5" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_com">2.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_com" id="chk_com" value="chk_com"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">COMPRESSIVE STRENGTH</label>
																</div>
															</div>

														</div>

														<br>
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Sample ID</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Length in mm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Width in mm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Height in mm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">

																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Load in KN</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Area (mm<sup>2</sup>)</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Compressive Strength (N/mm <sup>2</sup> )</label>
																</div>
															</div>



														</div>

														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_1" name="sample_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_1" name="l_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_1" name="w_1">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_1" name="h_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">

																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_1" name="load_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_1" name="area_1" readonly>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_1" name="com_1">
																</div>
															</div>



														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_2" name="sample_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_2" name="l_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_2" name="w_2">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_2" name="h_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">

																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_2" name="load_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_2" name="area_2" readonly>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_2" name="com_2">
																</div>
															</div>

														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_3" name="sample_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_3" name="l_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_3" name="w_3">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_3" name="h_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">

																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_3" name="load_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_3" name="area_3" readonly>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_3" name="com_3">
																</div>
															</div>


														</div>
														<br>

														<div class="row">
															<div class="col-md-4">
															</div>

															<div class="col-md-2">
																<label for="inputEmail3" class="control-label">Average</label>
															</div>
															<div class="col-md-2">
																<input type="text" class="form-control" id="avg_com" name="avg_com">
															</div>

														</DIV>



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
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
															<h4 class="panel-title">
																<b>DIMENSION</b>
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
																		<label for="chk_dim">1.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_dim" id="chk_dim" value="chk_dim"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">DIMENSION</label>
																</div>
															</div>

														</div>
														<br>
														<div class="row">

															<div class="col-md-1">

															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Length in mm</label>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Width in mm</label>
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Height in mm</label>
																</div>
															</div>
															<div class="col-md-2">

															</div>

														</div>


														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">

															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l1" name="dim_l1">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w1" name="dim_w1">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h1" name="dim_h1">
																</div>
															</div>

															<div class="col-md-2">

															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">

															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l2" name="dim_l2">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w2" name="dim_w2">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h2" name="dim_h2">
																</div>
															</div>

															<div class="col-md-2">

															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">

															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l3" name="dim_l3">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w3" name="dim_w3">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h3" name="dim_h3">
																</div>
															</div>

															<div class="col-md-2">

															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">

															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l4" name="dim_l4">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w4" name="dim_w4">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h4" name="dim_h4">
																</div>
															</div>

															<div class="col-md-2">

															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">

															</div>
															<div class="col-md-3">
																<div class="form-group">

																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w5" name="dim_w5">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h5" name="dim_h5">
																</div>
															</div>

															<div class="col-md-2">

															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">

															</div>
															<div class="col-md-3">
																<div class="form-group">

																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w6" name="dim_w6">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h6" name="dim_h6">
																</div>
															</div>

															<div class="col-md-2">

															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">

															</div>
															<div class="col-md-3">
																<div class="form-group">

																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">

																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">

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
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">AVERAGE</label>
																</div>
															</div>


														</div>
														<Br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">

															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_length" name="dim_length">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_width" name="dim_width">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_height" name="dim_height">
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
										if ($r1['test_code'] == "den") {
											$test_check .= "den,";
										?>
											<div class="panel panel-default" id="den">
												<div class="panel-heading" id="txtden">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
															<h4 class="panel-title">
																<b>BULK DENSITY &amp; MOSITURE CONTENT</b>
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
																		<label for="chk_den">3.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_den" id="chk_den" value="chk_den"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">BULK DENSITY &amp; MOSITURE CONTENT</label>
																</div>
															</div>

														</div>
														<br>
														<br>
														<div class="row">


															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Length in mm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Width in mm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Height in mm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Volume in (cm<sup>3</sup>)</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Weight, g</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Bulk Density (g/cm <sup>3</sup> )</label>
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Oven Dry Weight, g</label>
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Water Absorption (%)</label>
																</div>
															</div>



														</div>

														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">


															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dl_1" name="dl_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dw_1" name="dw_1">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dh_1" name="dh_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="vol_1" name="vol_1" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="weight_1" name="weight_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="den_1" name="den_1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1" name="w1">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="wa_1" name="wa_1">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">


															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dl_2" name="dl_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dw_2" name="dw_2">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dh_2" name="dh_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="vol_2" name="vol_2" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="weight_2" name="weight_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="den_2" name="den_2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w2" name="w2">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="wa_2" name="wa_2">
																</div>
															</div>

														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">


															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dl_3" name="dl_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dw_3" name="dw_3">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="dh_3" name="dh_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="vol_3" name="vol_3" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="weight_3" name="weight_3">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="den_3" name="den_3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w3" name="w3">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="wa_3" name="wa_3">
																</div>
															</div>


														</div>

														<br>
														<div class="row">
															<div class="col-md-3">
															</div>

															<div class="col-md-2">
																<label for="inputEmail3" class="control-label">Average</label>
															</div>
															<div class="col-md-2">
																<input type="text" class="form-control" id="bdl" name="bdl">
																<Br>
																<input type="text" class="form-control" id="bdl_kg" name="bdl_kg" readonly>
															</div>
															<div class="col-md-1">
																<label for="inputEmail3" class="control-label">Average</label>
															</div>
															<div class="col-md-1">
																<input type="text" class="form-control" id="mc" name="mc">
															</div>

														</DIV>
													</div>
												</div>
											</div>





										<?php
										}
										if ($r1['test_code'] == "shr") {
											$test_check .= "shr,";
										?>
											<div class="panel panel-default" id="shr">
												<div class="panel-heading" id="txtshr">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse311">
															<h4 class="panel-title">
																<b>DRYING SHRINKAGE</b>
															</h4>
														</a>
													</h4>
												</div>
												<div id="collapse311" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">

															<div class="col-lg-8">
																<div class="form-group">
																	<div class="col-sm-1">
																		<label for="chk_shr">5.</label>
																		<input type="checkbox" class="visually-hidden" name="chk_shr" id="chk_shr" value="chk_shr"><br>
																	</div>
																	<label for="inputEmail3" class="col-sm-4 control-label label-right">DRYING SHRINKAGE</label>
																</div>
															</div>

														</div>
														<br>
														<div class="row">


															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label"></label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">(I)</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">(II)</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">(III)</label>
																</div>
															</div>



														</div>


														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Constant Length, mm</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_1" name="con_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_2" name="con_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_3" name="con_3">
																</div>
															</div>




														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Width, mm</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_wid_1" name="con_wid_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_wid_2" name="con_wid_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_wid_3" name="con_wid_3">
																</div>
															</div>




														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Thickness, mm</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_thi_1" name="con_thi_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_thi_2" name="con_thi_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="con_thi_3" name="con_thi_3">
																</div>
															</div>




														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">First Reading, mm</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="fr_1" name="fr_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="fr_2" name="fr_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="fr_3" name="fr_3">
																</div>
															</div>



														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Final Reading, mm</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="fi_1" name="fi_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="fi_2" name="fi_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="fi_3" name="fi_3">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Drying Shrinkage, %</label>
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ds_1" name="ds_1">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ds_2" name="ds_2">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="ds_3" name="ds_3">
																</div>
															</div>



														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->

														<Br>
														<div class="row">

															<div class="col-md-4">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Average Drying Shrinkage,% :-</label>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<input type="text" class="form-control" id="avg_shrink" name="avg_shrink">
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
													$query = "select * from clc_block WHERE lab_no='$aa'  and `is_deleted`='0'";

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



		function dim_auto() {
			$('#txtdim').css("background-color", "var(--success)");



			var len = $('#in_l').val();
			var dim_length = (+len) + (+randomNumberFromRange(-4, 4).toFixed());
			$('#dim_length').val(dim_length);

			var dimlength = $('#dim_length').val();

			var se = randomNumberFromRange(1, 9).toFixed();
			if (se % 2 == 0) {
				var dim_l1 = (+dimlength) + (+2);
				var dim_l2 = (+dimlength) - (+1);
				var dim_l3 = (+dimlength) + (+1);
				var dim_l4 = (+dimlength) - (+2);
			} else {
				var dim_l1 = (+dimlength) - (+2);
				var dim_l2 = (+dimlength) + (+1);
				var dim_l3 = (+dimlength) - (+1);
				var dim_l4 = (+dimlength) + (+2);
			}
			$('#dim_l1').val(dim_l1);
			$('#dim_l2').val(dim_l2);
			$('#dim_l3').val(dim_l3);
			$('#dim_l4').val(dim_l4);

			var diml1 = $('#dim_l1').val();
			var diml2 = $('#dim_l2').val();
			var diml3 = $('#dim_l3').val();
			var diml4 = $('#dim_l4').val();

			var sum = ((+diml1) + (+diml2) + (+diml3) + (+diml4)) / 4;
			$('#dim_length').val(sum.toFixed());

			var hei = $('#in_h').val();
			var dim_height = (+hei) + (+randomNumberFromRange(-3, 3).toFixed());
			$('#dim_height').val(dim_height);


			var dimheight = $('#dim_height').val();

			var se1 = randomNumberFromRange(1, 9).toFixed();
			if (se1 % 2 == 0) {
				var dim_h1 = (+dimheight) + (+1);
				var dim_h2 = (+dimheight) - (+2);
				var dim_h3 = (+dimheight) + (+3);
				var dim_h4 = (+dimheight) - (+3);
				var dim_h5 = (+dimheight) + (+2);
				var dim_h6 = (+dimheight) - (+1);
			} else {
				var dim_h1 = (+dimheight) - (+3);
				var dim_h2 = (+dimheight) + (+2);
				var dim_h3 = (+dimheight) - (+1);
				var dim_h4 = (+dimheight) + (+3);
				var dim_h5 = (+dimheight) + (+1);
				var dim_h6 = (+dimheight) - (+2);
			}
			$('#dim_h1').val(dim_h1);
			$('#dim_h2').val(dim_h2);
			$('#dim_h3').val(dim_h3);
			$('#dim_h4').val(dim_h4);
			$('#dim_h5').val(dim_h5);
			$('#dim_h6').val(dim_h6);

			var dimh1 = $('#dim_h1').val();
			var dimh2 = $('#dim_h2').val();
			var dimh3 = $('#dim_h3').val();
			var dimh4 = $('#dim_h4').val();
			var dimh5 = $('#dim_h5').val();
			var dimh6 = $('#dim_h6').val();

			var sum1 = ((+dimh1) + (+dimh2) + (+dimh3) + (+dimh4) + (+dimh5) + (+dimh6)) / 6;
			$('#dim_height').val(sum1.toFixed());

			var wid = $('#in_w').val();
			var dim_width = (+wid) + (+randomNumberFromRange(-3, 3).toFixed());
			$('#dim_width').val(dim_width);

			var dimwidth = $('#dim_width').val();

			var se2 = randomNumberFromRange(1, 9).toFixed();
			if (se2 % 2 == 0) {
				var dim_w1 = (+dimwidth) + (+1);
				var dim_w2 = (+dimwidth) - (+2);
				var dim_w3 = (+dimwidth) + (+3);
				var dim_w4 = (+dimwidth) - (+3);
				var dim_w5 = (+dimwidth) + (+2);
				var dim_w6 = (+dimwidth) - (+1);

			} else {
				var dim_w2 = (+dimwidth) - (+3);
				var dim_w3 = (+dimwidth) + (+2);
				var dim_w4 = (+dimwidth) - (+1);
				var dim_w5 = (+dimwidth) + (+3);
				var dim_w6 = (+dimwidth) + (+1);

				var dim_w1 = (+dimwidth) + (+0);
			}
			$('#dim_w1').val(dim_w1);
			$('#dim_w2').val(dim_w2);
			$('#dim_w3').val(dim_w3);
			$('#dim_w4').val(dim_w4);
			$('#dim_w5').val(dim_w5);
			$('#dim_w6').val(dim_w6);


			var dimw1 = $('#dim_w1').val();
			var dimw2 = $('#dim_w2').val();
			var dimw3 = $('#dim_w3').val();
			var dimw4 = $('#dim_w4').val();
			var dimw5 = $('#dim_w5').val();
			var dimw6 = $('#dim_w6').val();


			var sum2 = ((+dimw1) + (+dimw2) + (+dimw3) + (+dimw4) + (+dimw5) + (+dimw6)) / 6;
			$('#dim_width').val(sum2.toFixed());
		}


		$('#chk_dim').change(function() {
			if (this.checked) {
				dim_auto();
			} else {
				$('#txtdim').css("background-color", "white");
				$('#dim_length').val(null);
				$('#dim_height').val(null);
				$('#dim_width').val(null);
				$('#dim_w1').val(null);
				$('#dim_w2').val(null);
				$('#dim_w3').val(null);
				$('#dim_w4').val(null);
				$('#dim_w5').val(null);
				$('#dim_w6').val(null);

				$('#dim_h1').val(null);
				$('#dim_h2').val(null);
				$('#dim_h3').val(null);
				$('#dim_h4').val(null);
				$('#dim_h5').val(null);
				$('#dim_h6').val(null);
				$('#dim_l1').val(null);
				$('#dim_l2').val(null);
				$('#dim_l3').val(null);
				$('#dim_l4').val(null);

			}
		});


		$('#dim_l1,#dim_l2,#dim_l3,#dim_l4').change(function() {
			$('#txtdim').css("background-color", "var(--success)");
			var diml1 = $('#dim_l1').val();
			var diml2 = $('#dim_l2').val();
			var diml3 = $('#dim_l3').val();
			var diml4 = $('#dim_l4').val();

			var sum = ((+diml1) + (+diml2) + (+diml3) + (+diml4)) / 4;
			$('#dim_length').val(sum.toFixed());

		});

		$('#dim_w1,#dim_w2,#dim_w3,#dim_w4,#dim_w5,#dim_w6').change(function() {
			$('#txtdim').css("background-color", "var(--success)");
			var dimw1 = $('#dim_w1').val();
			var dimw2 = $('#dim_w2').val();
			var dimw3 = $('#dim_w3').val();
			var dimw4 = $('#dim_w4').val();
			var dimw5 = $('#dim_w5').val();
			var dimw6 = $('#dim_w6').val();

			var sum2 = ((+dimw1) + (+dimw2) + (+dimw3) + (+dimw4) + (+dimw5) + (+dimw6)) / 6;
			$('#dim_width').val(sum2.toFixed());

		});

		$('#dim_h1,#dim_h2,#dim_h3,#dim_h4,#dim_h5,#dim_h6').change(function() {
			$('#txtdim').css("background-color", "var(--success)");
			var dimh1 = $('#dim_h1').val();
			var dimh2 = $('#dim_h2').val();
			var dimh3 = $('#dim_h3').val();
			var dimh4 = $('#dim_h4').val();
			var dimh5 = $('#dim_h5').val();
			var dimh6 = $('#dim_h6').val();

			var sum1 = ((+dimh1) + (+dimh2) + (+dimh3) + (+dimh4) + (+dimh5) + (+dimh6)) / 6;
			$('#dim_height').val(sum1.toFixed());

		});



		function com_auto() {
			$('#txtcom').css("background-color", "var(--success)");
			var sample_1 = "s1";
			var sample_2 = "s2";
			var sample_3 = "s3";

			$('#sample_1').val(sample_1);
			$('#sample_2').val(sample_2);
			$('#sample_3').val(sample_3);




			var a1 = $('#dim_height').val();
			var a2 = $('#dim_width').val();
			var a3 = $('#dim_length').val();
			var ans = Math.min(a1, a2, a3);



			if (ans < 150) {
				var l_1 = randomNumberFromRange(98, 102).toFixed();
				var l_2 = randomNumberFromRange(98, 102).toFixed();
				var l_3 = randomNumberFromRange(98, 102).toFixed();

				var w_1 = randomNumberFromRange(98, 102).toFixed();
				var w_2 = randomNumberFromRange(98, 102).toFixed();
				var w_3 = randomNumberFromRange(98, 102).toFixed();

				var h_1 = randomNumberFromRange(98, 102).toFixed();
				var h_2 = randomNumberFromRange(98, 102).toFixed();
				var h_3 = randomNumberFromRange(98, 102).toFixed();

			} else {
				var l_1 = randomNumberFromRange(148, 152).toFixed();
				var l_2 = randomNumberFromRange(148, 152).toFixed();
				var l_3 = randomNumberFromRange(148, 152).toFixed();


				var w_1 = randomNumberFromRange(148, 152).toFixed();
				var w_2 = randomNumberFromRange(148, 152).toFixed();
				var w_3 = randomNumberFromRange(148, 152).toFixed();


				var h_1 = randomNumberFromRange(148, 152).toFixed();
				var h_2 = randomNumberFromRange(148, 152).toFixed();
				var h_3 = randomNumberFromRange(148, 152).toFixed();

			}



			$('#l_1').val(l_1);
			$('#l_2').val(l_2);
			$('#l_3').val(l_3);

			var l1 = $('#l_1').val();
			var l2 = $('#l_2').val();
			var l3 = $('#l_3').val();


			$('#w_1').val(w_1);
			$('#w_2').val(w_2);
			$('#w_3').val(w_3);

			var w1 = $('#w_1').val();
			var w2 = $('#w_2').val();
			var w3 = $('#w_3').val();



			$('#h_1').val(h_1);
			$('#h_2').val(h_2);
			$('#h_3').val(h_3);

			var h1 = $('#h_1').val();
			var h2 = $('#h_2').val();
			var h3 = $('#h_3').val();

			var area_1 = (+l1) * (+w1);
			var area_2 = (+l2) * (+w2);
			var area_3 = (+l3) * (+w3);

			$('#area_1').val(area_1.toFixed());
			$('#area_2').val(area_2.toFixed());
			$('#area_3').val(area_3.toFixed());

			var area1 = $('#area_1').val();
			var area2 = $('#area_2').val();
			var area3 = $('#area_3').val();

			var grade = $('#in_grade').val();
			var in_den = $('#in_den').val();
			if (grade == "G-2.5" && in_den == "800") {
				var avg_com = randomNumberFromRange(2.52, 3.25).toFixed(2);
			} else if (grade == "G-3.5" && in_den == "1000") {
				var avg_com = randomNumberFromRange(3.72, 4.90).toFixed(2);
			} else if (grade == "G-6.5" && in_den == "1200") {
				var avg_com = randomNumberFromRange(6.70, 7.40).toFixed(2);
			} else if (grade == "G-12" && in_den == "1400") {
				var avg_com = randomNumberFromRange(12.50, 13.50).toFixed(2);
			} else if (grade == "G-17.5" && in_den == "1600") {
				var avg_com = randomNumberFromRange(17.65, 18.65).toFixed(2);
			} else if (grade == "G-25" && in_den == "1800") {
				var avg_com = randomNumberFromRange(25.70, 26.50).toFixed(2);
			}


			$('#avg_com').val(avg_com);

			var avgcom = $('#avg_com').val();
			var ss = randomNumberFromRange(1, 9).toFixed();
			if (ss % 2 == 0) {
				var com_1 = (+avgcom) + 0.02;
				var com_2 = (+avgcom) - 0.04;
				var com_3 = (+avgcom) + 0.02;

			} else {
				var com_1 = (+avgcom) - 0.02;
				var com_2 = (+avgcom) + 0.03;
				var com_3 = (+avgcom) - 0.01;

			}

			$('#com_1').val(com_1.toFixed(2));
			$('#com_2').val(com_2.toFixed(2));
			$('#com_3').val(com_3.toFixed(2));

			var com1 = $('#com_1').val();
			var com2 = $('#com_2').val();
			var com3 = $('#com_3').val();

			var load_1 = ((+area1) * (+com1)) / 1000;
			var load_2 = ((+area2) * (+com2)) / 1000;
			var load_3 = ((+area3) * (+com3)) / 1000;

			$('#load_1').val(load_1.toFixed(2));
			$('#load_2').val(load_2.toFixed(2));
			$('#load_3').val(load_3.toFixed(2));

			var load1 = $('#load_1').val();
			var load2 = $('#load_2').val();
			var load3 = $('#load_3').val();


			var co_m1 = ((+load1) / (+area1)) * 1000;
			var co_m2 = ((+load2) / (+area2)) * 1000;
			var co_m3 = ((+load3) / (+area3)) * 1000;

			$('#com_1').val(co_m1.toFixed(2));
			$('#com_2').val(co_m2.toFixed(2));
			$('#com_3').val(co_m3.toFixed(2));

			var c_om1 = $('#com_1').val();
			var c_om2 = $('#com_2').val();
			var c_om3 = $('#com_3').val();

			var anss = ((+c_om1) + (+c_om2) + (+c_om3)) / 3;
			$('#avg_com').val(anss.toFixed(2));


		}

		$('#chk_com').change(function() {
			if (this.checked) {
				com_auto();
			} else {
				$('#txtcom').css("background-color", "white");
				$('#avg_com').val(null);
				$('#com_1').val(null);
				$('#com_2').val(null);
				$('#com_3').val(null);
				$('#area_1').val(null);
				$('#area_2').val(null);
				$('#area_3').val(null);
				$('#load_1').val(null);
				$('#load_2').val(null);
				$('#load_3').val(null);
				$('#h_1').val(null);
				$('#h_2').val(null);
				$('#h_3').val(null);
				$('#w_1').val(null);
				$('#w_2').val(null);
				$('#w_3').val(null);
				$('#l_1').val(null);
				$('#l_2').val(null);
				$('#l_3').val(null);
				$('#sample_1').val(null);
				$('#sample_2').val(null);
				$('#sample_3').val(null);




			}
		});

		$('#l_1,#l_2,#l_3,#h_1,#h_2,#h_3,#w_1,#w_2,#w_3,#load_1,#load_2,#load_3').change(function() {
			$('#txtcom').css("background-color", "var(--success)");
			var l1 = $('#l_1').val();
			var l2 = $('#l_2').val();
			var l3 = $('#l_3').val();
			var w1 = $('#w_1').val();
			var w2 = $('#w_2').val();
			var w3 = $('#w_3').val();
			var h1 = $('#h_1').val();
			var h2 = $('#h_2').val();
			var h3 = $('#h_3').val();
			var load1 = $('#load_1').val();
			var load2 = $('#load_2').val();
			var load3 = $('#load_3').val();

			var area_1 = (+l1) * (+w1);
			var area_2 = (+l2) * (+w2);
			var area_3 = (+l3) * (+w3);

			$('#area_1').val(area_1.toFixed());
			$('#area_2').val(area_2.toFixed());
			$('#area_3').val(area_3.toFixed());

			var area1 = $('#area_1').val();
			var area2 = $('#area_2').val();
			var area3 = $('#area_3').val();

			var co_m1 = ((+load1) / (+area1)) * 1000;
			var co_m2 = ((+load2) / (+area2)) * 1000;
			var co_m3 = ((+load3) / (+area3)) * 1000;

			$('#com_1').val(co_m1.toFixed(2));
			$('#com_2').val(co_m2.toFixed(2));
			$('#com_3').val(co_m3.toFixed(2));

			var c_om1 = $('#com_1').val();
			var c_om2 = $('#com_2').val();
			var c_om3 = $('#com_3').val();

			var anss = ((+c_om1) + (+c_om2) + (+c_om3)) / 3;
			$('#avg_com').val(anss.toFixed(2));




		});

		$('#com_1,#com_2,#com_3').change(function() {
			$('#txtcom').css("background-color", "var(--success)");

			var c_om1 = $('#com_1').val();
			var c_om2 = $('#com_2').val();
			var c_om3 = $('#com_3').val();

			var anss = ((+c_om1) + (+c_om2) + (+c_om3)) / 3;
			$('#avg_com').val(anss.toFixed(2));

			var com1 = $('#com_1').val();
			var com2 = $('#com_2').val();
			var com3 = $('#com_3').val();

			var area1 = $('#area_1').val();
			var area2 = $('#area_2').val();
			var area3 = $('#area_3').val();

			var load_1 = ((+area1) * (+com1)) / 1000;
			var load_2 = ((+area2) * (+com2)) / 1000;
			var load_3 = ((+area3) * (+com3)) / 1000;

			$('#load_1').val(load_1.toFixed(2));
			$('#load_2').val(load_2.toFixed(2));
			$('#load_3').val(load_3.toFixed(2));






		});

		$("#avg_com").change(function() {
			$('#txtcom').css("background-color", "var(--success)");
			if ($("#chk_com").is(':checked')) {

				var sample_1 = "s1";
				var sample_2 = "s2";
				var sample_3 = "s3";

				$('#sample_1').val(sample_1);
				$('#sample_2').val(sample_2);
				$('#sample_3').val(sample_3);



				var a1 = $('#dim_height').val();
				var a2 = $('#dim_width').val();
				var a3 = $('#dim_length').val();
				var ans = Math.min(a1, a2, a3);



				if (ans < 150) {
					var l_1 = randomNumberFromRange(98, 102).toFixed();
					var l_2 = randomNumberFromRange(98, 102).toFixed();
					var l_3 = randomNumberFromRange(98, 102).toFixed();

					var w_1 = randomNumberFromRange(98, 102).toFixed();
					var w_2 = randomNumberFromRange(98, 102).toFixed();
					var w_3 = randomNumberFromRange(98, 102).toFixed();

					var h_1 = randomNumberFromRange(98, 102).toFixed();
					var h_2 = randomNumberFromRange(98, 102).toFixed();
					var h_3 = randomNumberFromRange(98, 102).toFixed();

				} else {
					var l_1 = randomNumberFromRange(148, 152).toFixed();
					var l_2 = randomNumberFromRange(148, 152).toFixed();
					var l_3 = randomNumberFromRange(148, 152).toFixed();


					var w_1 = randomNumberFromRange(148, 152).toFixed();
					var w_2 = randomNumberFromRange(148, 152).toFixed();
					var w_3 = randomNumberFromRange(148, 152).toFixed();


					var h_1 = randomNumberFromRange(148, 152).toFixed();
					var h_2 = randomNumberFromRange(148, 152).toFixed();
					var h_3 = randomNumberFromRange(148, 152).toFixed();

				}



				$('#l_1').val(l_1);
				$('#l_2').val(l_2);
				$('#l_3').val(l_3);

				var l1 = $('#l_1').val();
				var l2 = $('#l_2').val();
				var l3 = $('#l_3').val();


				$('#w_1').val(w_1);
				$('#w_2').val(w_2);
				$('#w_3').val(w_3);

				var w1 = $('#w_1').val();
				var w2 = $('#w_2').val();
				var w3 = $('#w_3').val();



				$('#h_1').val(h_1);
				$('#h_2').val(h_2);
				$('#h_3').val(h_3);

				var h1 = $('#h_1').val();
				var h2 = $('#h_2').val();
				var h3 = $('#h_3').val();

				var area_1 = (+l1) * (+w1);
				var area_2 = (+l2) * (+w2);
				var area_3 = (+l3) * (+w3);

				$('#area_1').val(area_1.toFixed());
				$('#area_2').val(area_2.toFixed());
				$('#area_3').val(area_3.toFixed());

				var area1 = $('#area_1').val();
				var area2 = $('#area_2').val();
				var area3 = $('#area_3').val();

				var grade = $('#in_grade').val();
				var in_den = $('#in_den').val();

				var avgcom = $('#avg_com').val();
				var ss = randomNumberFromRange(1, 9).toFixed();
				if (ss % 2 == 0) {
					var com_1 = (+avgcom) + 0.02;
					var com_2 = (+avgcom) - 0.04;
					var com_3 = (+avgcom) + 0.02;

				} else {
					var com_1 = (+avgcom) - 0.02;
					var com_2 = (+avgcom) + 0.03;
					var com_3 = (+avgcom) - 0.01;

				}

				$('#com_1').val(com_1.toFixed(2));
				$('#com_2').val(com_2.toFixed(2));
				$('#com_3').val(com_3.toFixed(2));

				var com1 = $('#com_1').val();
				var com2 = $('#com_2').val();
				var com3 = $('#com_3').val();

				var load_1 = ((+area1) * (+com1)) / 1000;
				var load_2 = ((+area2) * (+com2)) / 1000;
				var load_3 = ((+area3) * (+com3)) / 1000;

				$('#load_1').val(load_1.toFixed(2));
				$('#load_2').val(load_2.toFixed(2));
				$('#load_3').val(load_3.toFixed(2));

				var load1 = $('#load_1').val();
				var load2 = $('#load_2').val();
				var load3 = $('#load_3').val();


				var co_m1 = ((+load1) / (+area1)) * 1000;
				var co_m2 = ((+load2) / (+area2)) * 1000;
				var co_m3 = ((+load3) / (+area3)) * 1000;

				$('#com_1').val(co_m1.toFixed(2));
				$('#com_2').val(co_m2.toFixed(2));
				$('#com_3').val(co_m3.toFixed(2));

				var c_om1 = $('#com_1').val();
				var c_om2 = $('#com_2').val();
				var c_om3 = $('#com_3').val();

				var anss = ((+c_om1) + (+c_om2) + (+c_om3)) / 3;
				$('#avg_com').val(anss.toFixed(2));

			}
		});

		function den_auto() {
			$('#txtden').css("background-color", "var(--success)");
			var a11 = $('#dim_height').val();
			var a12 = $('#dim_width').val();
			var a13 = $('#dim_length').val();
			var ans1 = Math.min(a11, a12, a13);



			if (ans1 < 150) {
				var dl_1 = randomNumberFromRange(98, 102).toFixed();
				var dl_2 = randomNumberFromRange(98, 102).toFixed();
				var dl_3 = randomNumberFromRange(98, 102).toFixed();

				var dw_1 = randomNumberFromRange(98, 102).toFixed();
				var dw_2 = randomNumberFromRange(98, 102).toFixed();
				var dw_3 = randomNumberFromRange(98, 102).toFixed();

				var dh_1 = randomNumberFromRange(98, 102).toFixed();
				var dh_2 = randomNumberFromRange(98, 102).toFixed();
				var dh_3 = randomNumberFromRange(98, 102).toFixed();

			} else {
				var dl_1 = randomNumberFromRange(148, 152).toFixed();
				var dl_2 = randomNumberFromRange(148, 152).toFixed();
				var dl_3 = randomNumberFromRange(148, 152).toFixed();


				var dw_1 = randomNumberFromRange(148, 152).toFixed();
				var dw_2 = randomNumberFromRange(148, 152).toFixed();
				var dw_3 = randomNumberFromRange(148, 152).toFixed();


				var dh_1 = randomNumberFromRange(148, 152).toFixed();
				var dh_2 = randomNumberFromRange(148, 152).toFixed();
				var dh_3 = randomNumberFromRange(148, 152).toFixed();

			}



			$('#dl_1').val(dl_1);
			$('#dl_2').val(dl_2);
			$('#dl_3').val(dl_3);

			var dl1 = $('#dl_1').val();
			var dl2 = $('#dl_2').val();
			var dl3 = $('#dl_3').val();


			$('#dw_1').val(dw_1);
			$('#dw_2').val(dw_2);
			$('#dw_3').val(dw_3);

			var dw1 = $('#dw_1').val();
			var dw2 = $('#dw_2').val();
			var dw3 = $('#dw_3').val();



			$('#dh_1').val(dh_1);
			$('#dh_2').val(dh_2);
			$('#dh_3').val(dh_3);

			var dh1 = $('#dh_1').val();
			var dh2 = $('#dh_2').val();
			var dh3 = $('#dh_3').val();

			var vol_1 = ((+dl1) * (+dh1) * (+dw1)) / 1000;
			var vol_2 = ((+dl2) * (+dh2) * (+dw2)) / 1000;
			var vol_3 = ((+dl3) * (+dh3) * (+dw3)) / 1000;

			$('#vol_1').val(vol_1.toFixed(1));
			$('#vol_2').val(vol_2.toFixed(1));
			$('#vol_3').val(vol_3.toFixed(1));

			var vol1 = $('#vol_1').val();
			var vol2 = $('#vol_2').val();
			var vol3 = $('#vol_3').val();



			var in_den1 = $('#in_den').val();

			if (in_den1 == "800") {
				var bdl = randomNumberFromRange(0.830, 0.890).toFixed(3);
			} else if (in_den1 == "1000") {
				var bdl = randomNumberFromRange(1.020, 1.090).toFixed(3);
			} else if (in_den1 == "1200") {
				var bdl = randomNumberFromRange(1.230, 1.290).toFixed(3);
			} else if (in_den1 == "1400") {
				var bdl = randomNumberFromRange(1.420, 1.490).toFixed(3);
			} else if (in_den1 == "1600") {
				var bdl = randomNumberFromRange(1.620, 1.690).toFixed(3);
			} else if (in_den1 == "1800") {
				var bdl = randomNumberFromRange(1.820, 1.890).toFixed(3);
			}
			$('#bdl').val(bdl);
			var bd_l = $('#bdl').val();
			var mc = randomNumberFromRange(6.50, 7.30).toFixed(2);
			$('#mc').val(mc);
			var m_c = $('#mc').val();
			var gg = randomNumberFromRange(1, 15).toFixed();
			if (gg % 2 == 0) {
				var den_1 = (+bd_l) - (+0.003);
				var den_2 = (+bd_l) + (+0.001);
				var den_3 = (+bd_l) + (+0.002);

				var wa_1 = (+m_c) - (+0.24);
				var wa_2 = (+m_c) + (+0.32);
				var wa_3 = (+m_c) - (+0.08);
			} else {
				var den_1 = (+bd_l) + (+0.002);
				var den_2 = (+bd_l) - (+0.003);
				var den_3 = (+bd_l) + (+0.001);

				var wa_1 = (+m_c) + (+0.30);
				var wa_2 = (+m_c) - (+0.16);
				var wa_3 = (+m_c) - (+0.14);
			}
			$('#den_1').val(den_1.toFixed(3));
			$('#den_2').val(den_2.toFixed(3));
			$('#den_3').val(den_3.toFixed(3));

			var den1 = $('#den_1').val();
			var den2 = $('#den_2').val();
			var den3 = $('#den_3').val();

			var weight_1 = (+den1) * (+vol1);
			var weight_2 = (+den2) * (+vol2);
			var weight_3 = (+den3) * (+vol3);

			$('#weight_1').val(weight_1.toFixed(1));
			$('#weight_2').val(weight_2.toFixed(1));
			$('#weight_3').val(weight_3.toFixed(1));

			var weight1 = $('#weight_1').val();
			var weight2 = $('#weight_2').val();
			var weight3 = $('#weight_3').val();


			var den__1 = (+weight1) / (+vol1);
			var den__2 = (+weight2) / (+vol2);
			var den__3 = (+weight3) / (+vol3);

			$('#den_1').val(den__1.toFixed(3));
			$('#den_2').val(den__2.toFixed(3));
			$('#den_3').val(den__3.toFixed(3));

			var d_en1 = $('#den_1').val();
			var d_en2 = $('#den_2').val();
			var d_en3 = $('#den_3').val();

			var fnl_den = ((+d_en1) + (+d_en2) + (+d_en3)) / 3;
			$('#bdl').val(fnl_den.toFixed(3));
			var b_d_l = $('#bdl').val();

			var bdl_kg = (+b_d_l) * 1000;
			$('#bdl_kg').val(bdl_kg);

			$('#wa_1').val(wa_1.toFixed(2));
			$('#wa_2').val(wa_2.toFixed(2));
			$('#wa_3').val(wa_3.toFixed(2));

			var wa1 = $('#wa_1').val();
			var wa2 = $('#wa_2').val();
			var wa3 = $('#wa_3').val();

			var temp1 = (+wa1) / 100;
			var temp2 = (+wa2) / 100;
			var temp3 = (+wa3) / 100;

			var tems1 = (+weight1) * (+temp1);
			var tems2 = (+weight2) * (+temp2);
			var tems3 = (+weight3) * (+temp3);

			var w1 = (+weight1) - (+tems1);
			var w2 = (+weight2) - (+tems2);
			var w3 = (+weight3) - (+tems3);

			$('#w1').val(w1.toFixed(1));
			$('#w2').val(w2.toFixed(1));
			$('#w3').val(w3.toFixed(1));


			var w__1 = $('#w1').val();
			var w__2 = $('#w2').val();
			var w__3 = $('#w3').val();

			var s1 = (+w__1) * 100;
			var s2 = (+w__2) * 100;
			var s3 = (+w__3) * 100;

			var ss1 = (+s1) / (+weight1);
			var ss2 = (+s2) / (+weight2);
			var ss3 = (+s3) / (+weight3);

			var anss1 = (+100) - (+ss1);
			var anss2 = (+100) - (+ss2);
			var anss3 = (+100) - (+ss3);

			$('#wa_1').val(anss1.toFixed(2));
			$('#wa_2').val(anss2.toFixed(2));
			$('#wa_3').val(anss3.toFixed(2));

			var w_a1 = $('#wa_1').val();
			var w_a2 = $('#wa_2').val();
			var w_a3 = $('#wa_3').val();

			var avg = ((+w_a1) + (+w_a2) + (+w_a3)) / 3;
			$('#mc').val(avg.toFixed(2));

			var temp1 = (+wa1) / 100;
			var temp2 = (+wa2) / 100;
			var temp3 = (+wa3) / 100;

			var tems1 = (+weight1) * (+temp1);
			var tems2 = (+weight2) * (+temp2);
			var tems3 = (+weight3) * (+temp3);

			var w1 = (+weight1) - (+tems1);
			var w2 = (+weight2) - (+tems2);
			var w3 = (+weight3) - (+tems3);

			$('#w1').val(w1.toFixed(1));
			$('#w2').val(w2.toFixed(1));
			$('#w3').val(w3.toFixed(1));

		}

		$('#chk_den').change(function() {
			if (this.checked) {
				den_auto();
			} else {
				$('#txtden').css("background-color", "white");
				$('#bdl_kg').val(null);
				$('#bdl').val(null);
				$('#dl_1').val(null);
				$('#dl_2').val(null);
				$('#dl_3').val(null);
				$('#dh_1').val(null);
				$('#dh_2').val(null);
				$('#dh_3').val(null);
				$('#dw_1').val(null);
				$('#dw_2').val(null);
				$('#dw_3').val(null);
				$('#vol_1').val(null);
				$('#vol_2').val(null);
				$('#vol_3').val(null);
				$('#weight_1').val(null);
				$('#weight_2').val(null);
				$('#weight_3').val(null);
				$('#den_1').val(null);
				$('#den_2').val(null);
				$('#den_3').val(null);

				$('#w1').val(null);
				$('#w2').val(null);
				$('#w3').val(null);

				$('#wa_1').val(null);
				$('#wa_2').val(null);
				$('#wa_3').val(null);
				$('#mc').val(null);


			}
		});

		$('#dl_1,#dl_2,#dl_3,#dh_1,#dh_2,#dh_3,#dw_1,#dw_2,#dw_3,#weight_1,#weight_2,#weight_3,#w1,#w2,#w3').change(function() {
			$('#txtden').css("background-color", "var(--success)");
			var dl1 = $('#dl_1').val();
			var dl2 = $('#dl_2').val();
			var dl3 = $('#dl_3').val();
			var dw1 = $('#dw_1').val();
			var dw2 = $('#dw_2').val();
			var dw3 = $('#dw_3').val();
			var dh1 = $('#dh_1').val();
			var dh2 = $('#dh_2').val();
			var dh3 = $('#dh_3').val();
			var weight1 = $('#weight_1').val();
			var weight2 = $('#weight_2').val();
			var weight3 = $('#weight_3').val();

			var vol_1 = ((+dl1) * (+dh1) * (+dw1)) / 1000;
			var vol_2 = ((+dl2) * (+dh2) * (+dw2)) / 1000;
			var vol_3 = ((+dl3) * (+dh3) * (+dw3)) / 1000;

			$('#vol_1').val(vol_1.toFixed(1));
			$('#vol_2').val(vol_2.toFixed(1));
			$('#vol_3').val(vol_3.toFixed(1));

			var vol1 = $('#vol_1').val();
			var vol2 = $('#vol_2').val();
			var vol3 = $('#vol_3').val();


			var den__1 = (+weight1) / (+vol1);
			var den__2 = (+weight2) / (+vol2);
			var den__3 = (+weight3) / (+vol3);

			$('#den_1').val(den__1.toFixed(3));
			$('#den_2').val(den__2.toFixed(3));
			$('#den_3').val(den__3.toFixed(3));

			var d_en1 = $('#den_1').val();
			var d_en2 = $('#den_2').val();
			var d_en3 = $('#den_3').val();

			var fnl_den = ((+d_en1) + (+d_en2) + (+d_en3)) / 3;
			$('#bdl').val(fnl_den.toFixed(3));
			var b_d_l = $('#bdl').val();

			var bdl_kg = (+b_d_l) * 1000;
			$('#bdl_kg').val(bdl_kg);




			var w__1 = $('#w1').val();
			var w__2 = $('#w2').val();
			var w__3 = $('#w3').val();

			var s1 = (+w__1) * 100;
			var s2 = (+w__2) * 100;
			var s3 = (+w__3) * 100;

			var ss1 = (+s1) / (+weight1);
			var ss2 = (+s2) / (+weight2);
			var ss3 = (+s3) / (+weight3);

			var anss1 = (+100) - (+ss1);
			var anss2 = (+100) - (+ss2);
			var anss3 = (+100) - (+ss3);

			$('#wa_1').val(anss1.toFixed(2));
			$('#wa_2').val(anss2.toFixed(2));
			$('#wa_3').val(anss3.toFixed(2));

			var w_a1 = $('#wa_1').val();
			var w_a2 = $('#wa_2').val();
			var w_a3 = $('#wa_3').val();

			var avg = ((+w_a1) + (+w_a2) + (+w_a3)) / 3;
			$('#mc').val(avg.toFixed(2));




		});

		$('#den_1,#den_2,#den_3,#wa_1,#wa_2,#wa_3').change(function() {
			$('#txtcom').css("background-color", "var(--success)");

			var d_en1 = $('#den_1').val();
			var d_en2 = $('#den_2').val();
			var d_en3 = $('#den_3').val();

			var fnl_den = ((+d_en1) + (+d_en2) + (+d_en3)) / 3;
			$('#bdl').val(fnl_den.toFixed(3));
			var b_d_l = $('#bdl').val();

			var bdl_kg = (+b_d_l) * 1000;
			$('#bdl_kg').val(bdl_kg);

			var vol1 = $('#vol_1').val();
			var vol2 = $('#vol_2').val();
			var vol3 = $('#vol_3').val();

			var weight_1 = (+d_en1) * (+vol1);
			var weight_2 = (+d_en2) * (+vol2);
			var weight_3 = (+d_en3) * (+vol3);

			$('#weight_1').val(weight_1.toFixed(1));
			$('#weight_2').val(weight_2.toFixed(1));
			$('#weight_3').val(weight_3.toFixed(1));

			var weight1 = $('#weight_1').val();
			var weight2 = $('#weight_2').val();
			var weight3 = $('#weight_3').val();

			var w_a1 = $('#wa_1').val();
			var w_a2 = $('#wa_2').val();
			var w_a3 = $('#wa_3').val();

			var avg = ((+w_a1) + (+w_a2) + (+w_a3)) / 3;
			$('#mc').val(avg.toFixed(2));

			var wa1 = $('#wa_1').val();
			var wa2 = $('#wa_2').val();
			var wa3 = $('#wa_3').val();

			var temp1 = (+wa1) / 100;
			var temp2 = (+wa2) / 100;
			var temp3 = (+wa3) / 100;

			var tems1 = (+weight1) * (+temp1);
			var tems2 = (+weight2) * (+temp2);
			var tems3 = (+weight3) * (+temp3);

			var w1 = (+weight1) - (+tems1);
			var w2 = (+weight2) - (+tems2);
			var w3 = (+weight3) - (+tems3);

			$('#w1').val(w1.toFixed(1));
			$('#w2').val(w2.toFixed(1));
			$('#w3').val(w3.toFixed(1));






		});


		$("#bdl,#mc").change(function() {
			$('#txtden').css("background-color", "var(--success)");
			if ($("#chk_den").is(':checked')) {

				var a11 = $('#dim_height').val();
				var a12 = $('#dim_width').val();
				var a13 = $('#dim_length').val();
				var ans1 = Math.min(a11, a12, a13);



				if (ans1 < 150) {
					var dl_1 = randomNumberFromRange(98, 102).toFixed();
					var dl_2 = randomNumberFromRange(98, 102).toFixed();
					var dl_3 = randomNumberFromRange(98, 102).toFixed();

					var dw_1 = randomNumberFromRange(98, 102).toFixed();
					var dw_2 = randomNumberFromRange(98, 102).toFixed();
					var dw_3 = randomNumberFromRange(98, 102).toFixed();

					var dh_1 = randomNumberFromRange(98, 102).toFixed();
					var dh_2 = randomNumberFromRange(98, 102).toFixed();
					var dh_3 = randomNumberFromRange(98, 102).toFixed();

				} else {
					var dl_1 = randomNumberFromRange(148, 152).toFixed();
					var dl_2 = randomNumberFromRange(148, 152).toFixed();
					var dl_3 = randomNumberFromRange(148, 152).toFixed();


					var dw_1 = randomNumberFromRange(148, 152).toFixed();
					var dw_2 = randomNumberFromRange(148, 152).toFixed();
					var dw_3 = randomNumberFromRange(148, 152).toFixed();


					var dh_1 = randomNumberFromRange(148, 152).toFixed();
					var dh_2 = randomNumberFromRange(148, 152).toFixed();
					var dh_3 = randomNumberFromRange(148, 152).toFixed();

				}



				$('#dl_1').val(dl_1);
				$('#dl_2').val(dl_2);
				$('#dl_3').val(dl_3);

				var dl1 = $('#dl_1').val();
				var dl2 = $('#dl_2').val();
				var dl3 = $('#dl_3').val();


				$('#dw_1').val(dw_1);
				$('#dw_2').val(dw_2);
				$('#dw_3').val(dw_3);

				var dw1 = $('#dw_1').val();
				var dw2 = $('#dw_2').val();
				var dw3 = $('#dw_3').val();



				$('#dh_1').val(dh_1);
				$('#dh_2').val(dh_2);
				$('#dh_3').val(dh_3);

				var dh1 = $('#dh_1').val();
				var dh2 = $('#dh_2').val();
				var dh3 = $('#dh_3').val();

				var vol_1 = ((+dl1) * (+dh1) * (+dw1)) / 1000;
				var vol_2 = ((+dl2) * (+dh2) * (+dw2)) / 1000;
				var vol_3 = ((+dl3) * (+dh3) * (+dw3)) / 1000;

				$('#vol_1').val(vol_1.toFixed(1));
				$('#vol_2').val(vol_2.toFixed(1));
				$('#vol_3').val(vol_3.toFixed(1));

				var vol1 = $('#vol_1').val();
				var vol2 = $('#vol_2').val();
				var vol3 = $('#vol_3').val();

				var bd_l = $('#bdl').val();
				var m_c = $('#mc').val();
				var gg = randomNumberFromRange(1, 15).toFixed();
				if (gg % 2 == 0) {
					var den_1 = (+bd_l) - (+0.003);
					var den_2 = (+bd_l) + (+0.001);
					var den_3 = (+bd_l) + (+0.002);

					var wa_1 = (+m_c) - (+0.24);
					var wa_2 = (+m_c) + (+0.32);
					var wa_3 = (+m_c) - (+0.08);
				} else {
					var den_1 = (+bd_l) + (+0.002);
					var den_2 = (+bd_l) - (+0.003);
					var den_3 = (+bd_l) + (+0.001);

					var wa_1 = (+m_c) + (+0.30);
					var wa_2 = (+m_c) - (+0.16);
					var wa_3 = (+m_c) - (+0.14);
				}
				$('#den_1').val(den_1.toFixed(3));
				$('#den_2').val(den_2.toFixed(3));
				$('#den_3').val(den_3.toFixed(3));

				var den1 = $('#den_1').val();
				var den2 = $('#den_2').val();
				var den3 = $('#den_3').val();

				var weight_1 = (+den1) * (+vol1);
				var weight_2 = (+den2) * (+vol2);
				var weight_3 = (+den3) * (+vol3);

				$('#weight_1').val(weight_1.toFixed(1));
				$('#weight_2').val(weight_2.toFixed(1));
				$('#weight_3').val(weight_3.toFixed(1));

				var weight1 = $('#weight_1').val();
				var weight2 = $('#weight_2').val();
				var weight3 = $('#weight_3').val();


				var den__1 = (+weight1) / (+vol1);
				var den__2 = (+weight2) / (+vol2);
				var den__3 = (+weight3) / (+vol3);

				$('#den_1').val(den__1.toFixed(3));
				$('#den_2').val(den__2.toFixed(3));
				$('#den_3').val(den__3.toFixed(3));

				var d_en1 = $('#den_1').val();
				var d_en2 = $('#den_2').val();
				var d_en3 = $('#den_3').val();

				var fnl_den = ((+d_en1) + (+d_en2) + (+d_en3)) / 3;
				$('#bdl').val(fnl_den.toFixed(3));
				var b_d_l = $('#bdl').val();

				var bdl_kg = (+b_d_l) * 1000;
				$('#bdl_kg').val(bdl_kg);

				$('#wa_1').val(wa_1.toFixed(2));
				$('#wa_2').val(wa_2.toFixed(2));
				$('#wa_3').val(wa_3.toFixed(2));

				var wa1 = $('#wa_1').val();
				var wa2 = $('#wa_2').val();
				var wa3 = $('#wa_3').val();

				var temp1 = (+wa1) / 100;
				var temp2 = (+wa2) / 100;
				var temp3 = (+wa3) / 100;

				var tems1 = (+weight1) * (+temp1);
				var tems2 = (+weight2) * (+temp2);
				var tems3 = (+weight3) * (+temp3);

				var w1 = (+weight1) - (+tems1);
				var w2 = (+weight2) - (+tems2);
				var w3 = (+weight3) - (+tems3);

				$('#w1').val(w1.toFixed(1));
				$('#w2').val(w2.toFixed(1));
				$('#w3').val(w3.toFixed(1));


				var w__1 = $('#w1').val();
				var w__2 = $('#w2').val();
				var w__3 = $('#w3').val();

				var s1 = (+w__1) * 100;
				var s2 = (+w__2) * 100;
				var s3 = (+w__3) * 100;

				var ss1 = (+s1) / (+weight1);
				var ss2 = (+s2) / (+weight2);
				var ss3 = (+s3) / (+weight3);

				var anss1 = (+100) - (+ss1);
				var anss2 = (+100) - (+ss2);
				var anss3 = (+100) - (+ss3);

				$('#wa_1').val(anss1.toFixed(2));
				$('#wa_2').val(anss2.toFixed(2));
				$('#wa_3').val(anss3.toFixed(2));

				var w_a1 = $('#wa_1').val();
				var w_a2 = $('#wa_2').val();
				var w_a3 = $('#wa_3').val();

				var avg = ((+w_a1) + (+w_a2) + (+w_a3)) / 3;
				$('#mc').val(avg.toFixed(2));

				var temp1 = (+wa1) / 100;
				var temp2 = (+wa2) / 100;
				var temp3 = (+wa3) / 100;

				var tems1 = (+weight1) * (+temp1);
				var tems2 = (+weight2) * (+temp2);
				var tems3 = (+weight3) * (+temp3);

				var w1 = (+weight1) - (+tems1);
				var w2 = (+weight2) - (+tems2);
				var w3 = (+weight3) - (+tems3);

				$('#w1').val(w1.toFixed(1));
				$('#w2').val(w2.toFixed(1));
				$('#w3').val(w3.toFixed(1));

			}
		});

		function shr_auto() {
			$('#txtshr').css("background-color", "var(--success)");
			var con_1 = 300;
			var con_2 = 300;
			var con_3 = 300;
			$('#con_1').val(con_1);
			$('#con_2').val(con_2);
			$('#con_3').val(con_3);

			var con_wid_1 = randomNumberFromRange(24.00, 26.00).toFixed(2);
			var con_wid_2 = randomNumberFromRange(24.00, 26.00).toFixed(2);
			var con_wid_3 = randomNumberFromRange(24.00, 26.00).toFixed(2);
			$('#con_wid_1').val(con_wid_1);
			$('#con_wid_2').val(con_wid_2);
			$('#con_wid_3').val(con_wid_3);

			var con_thi_1 = randomNumberFromRange(24.00, 26.00).toFixed(2);
			var con_thi_2 = randomNumberFromRange(24.00, 26.00).toFixed(2);
			var con_thi_3 = randomNumberFromRange(24.00, 26.00).toFixed(2);
			$('#con_thi_1').val(con_thi_1);
			$('#con_thi_2').val(con_thi_2);
			$('#con_thi_3').val(con_thi_3);

			var fr_1 = randomNumberFromRange(1.000, 5.000).toFixed(3);
			var fr_2 = randomNumberFromRange(1.000, 5.000).toFixed(3);
			var fr_3 = randomNumberFromRange(1.000, 5.000).toFixed(3);

			$('#fr_1').val(fr_1);
			$('#fr_2').val(fr_2);
			$('#fr_3').val(fr_3);

			var fr1 = $('#fr_1').val();
			var fr2 = $('#fr_2').val();
			var fr3 = $('#fr_3').val();

			var avg_shrink = randomNumberFromRange(0.035, 0.040).toFixed(3);
			$('#avg_shrink').val(avg_shrink);

			var avgshrink = $('#avg_shrink').val();

			var rr = randomNumberFromRange(1, 20).toFixed();
			if (rr % 2 == 0) {
				var ds_1 = (+avgshrink) + (+0.003);
				var ds_2 = (+avgshrink) - (+0.004);
				var ds_3 = (+avgshrink) + (+0.001);
			} else {
				var ds_1 = (+avgshrink) - (+0.001);
				var ds_2 = (+avgshrink) + (+0.004);
				var ds_3 = (+avgshrink) - (+0.003);
			}
			$('#ds_1').val(ds_1.toFixed(3));
			$('#ds_2').val(ds_2.toFixed(3));
			$('#ds_3').val(ds_3.toFixed(3));

			var ds1 = $('#ds_1').val();
			var ds2 = $('#ds_2').val();
			var ds3 = $('#ds_3').val();

			var con1 = $('#con_1').val();
			var con2 = $('#con_2').val();
			var con3 = $('#con_3').val();

			var fi_1 = (((+con1) * (+ds1)) / 100) + (+con1);
			var fi_2 = (((+con2) * (+ds2)) / 100) + (+con2);
			var fi_3 = (((+con3) * (+ds3)) / 100) + (+con3);

			var temw1 = (+fi_1) - (+con1);
			var temw2 = (+fi_2) - (+con2);
			var temw3 = (+fi_3) - (+con3);

			var finl1 = (+temw1) + (+fr1);
			var finl2 = (+temw2) + (+fr2);
			var finl3 = (+temw3) + (+fr3);

			$('#fi_1').val(finl1.toFixed(3));
			$('#fi_2').val(finl2.toFixed(3));
			$('#fi_3').val(finl3.toFixed(3));

			var fi1 = $('#fi_1').val();
			var fi2 = $('#fi_2').val();
			var fi3 = $('#fi_3').val();

			var dif1 = ((+fi1) - (fr1)) + (+con1);
			var dif2 = ((+fi2) - (fr2)) + (+con2);
			var dif3 = ((+fi3) - (fr3)) + (+con3);

			var dipl1 = (((+dif1) * 100) / (+con1)) - 100;
			var dipl2 = (((+dif2) * 100) / (+con2)) - 100;
			var dipl3 = (((+dif3) * 100) / (+con3)) - 100;
			$('#ds_1').val(dipl1.toFixed(3));
			$('#ds_2').val(dipl2.toFixed(3));
			$('#ds_3').val(dipl3.toFixed(3));

			var fs1 = $('#ds_1').val();
			var fs2 = $('#ds_2').val();
			var fs3 = $('#ds_3').val();

			var finalans = ((+fs1) + (+fs2) + (+fs3)) / 3;
			$('#avg_shrink').val(finalans.toFixed(3));



		}

		$('#con_1,#con_2,#con_3,#fr_1,#fr_2,#fr_3,#fi_1,#fi_2,#fi_3').change(function() {
			$('#txtshr').css("background-color", "var(--success)");
			var con1 = $('#con_1').val();
			var con2 = $('#con_2').val();
			var con3 = $('#con_3').val();
			var fi1 = $('#fi_1').val();
			var fi2 = $('#fi_2').val();
			var fi3 = $('#fi_3').val();
			var fr1 = $('#fr_1').val();
			var fr2 = $('#fr_2').val();
			var fr3 = $('#fr_3').val();

			var dif1 = ((+fi1) - (fr1)) + (+con1);
			var dif2 = ((+fi2) - (fr2)) + (+con2);
			var dif3 = ((+fi3) - (fr3)) + (+con3);

			var dipl1 = (((+dif1) * 100) / (+con1)) - 100;
			var dipl2 = (((+dif2) * 100) / (+con2)) - 100;
			var dipl3 = (((+dif3) * 100) / (+con3)) - 100;
			$('#ds_1').val(dipl1.toFixed(3));
			$('#ds_2').val(dipl2.toFixed(3));
			$('#ds_3').val(dipl3.toFixed(3));

			var fs1 = $('#ds_1').val();
			var fs2 = $('#ds_2').val();
			var fs3 = $('#ds_3').val();

			var finalans = ((+fs1) + (+fs2) + (+fs3)) / 3;
			$('#avg_shrink').val(finalans.toFixed(3));

		});

		$('#ds_1,#ds_2,#ds_3').change(function() {
			$('#txtshr').css("background-color", "var(--success)");
			var fs1 = $('#ds_1').val();
			var fs2 = $('#ds_2').val();
			var fs3 = $('#ds_3').val();

			var finalans = ((+fs1) + (+fs2) + (+fs3)) / 3;
			$('#avg_shrink').val(finalans.toFixed(3));

			var fr_1 = randomNumberFromRange(1.000, 5.000).toFixed(3);
			var fr_2 = randomNumberFromRange(1.000, 5.000).toFixed(3);
			var fr_3 = randomNumberFromRange(1.000, 5.000).toFixed(3);

			$('#fr_1').val(fr_1);
			$('#fr_2').val(fr_2);
			$('#fr_3').val(fr_3);

			var fr1 = $('#fr_1').val();
			var fr2 = $('#fr_2').val();
			var fr3 = $('#fr_3').val();

			var ds1 = $('#ds_1').val();
			var ds2 = $('#ds_2').val();
			var ds3 = $('#ds_3').val();

			var con1 = $('#con_1').val();
			var con2 = $('#con_2').val();
			var con3 = $('#con_3').val();

			var fi_1 = (((+con1) * (+ds1)) / 100) + (+con1);
			var fi_2 = (((+con2) * (+ds2)) / 100) + (+con2);
			var fi_3 = (((+con3) * (+ds3)) / 100) + (+con3);

			var temw1 = (+fi_1) - (+con1);
			var temw2 = (+fi_2) - (+con2);
			var temw3 = (+fi_3) - (+con3);

			var finl1 = (+temw1) + (+fr1);
			var finl2 = (+temw2) + (+fr2);
			var finl3 = (+temw3) + (+fr3);

			$('#fi_1').val(finl1.toFixed(3));
			$('#fi_2').val(finl2.toFixed(3));
			$('#fi_3').val(finl3.toFixed(3));

		});

		$("#avg_shrink").change(function() {
			$('#txtden').css("background-color", "var(--success)");
			if ($("#chk_shr").is(':checked')) {
				var con_1 = 300;
				var con_2 = 300;
				var con_3 = 300;
				$('#con_1').val(con_1);
				$('#con_2').val(con_2);
				$('#con_3').val(con_3);

				var con_wid_1 = randomNumberFromRange(24.00, 26.00).toFixed(2);
				var con_wid_2 = randomNumberFromRange(24.00, 26.00).toFixed(2);
				var con_wid_3 = randomNumberFromRange(24.00, 26.00).toFixed(2);
				$('#con_wid_1').val(con_wid_1);
				$('#con_wid_2').val(con_wid_2);
				$('#con_wid_3').val(con_wid_3);

				var con_thi_1 = randomNumberFromRange(24.00, 26.00).toFixed(2);
				var con_thi_2 = randomNumberFromRange(24.00, 26.00).toFixed(2);
				var con_thi_3 = randomNumberFromRange(24.00, 26.00).toFixed(2);
				$('#con_thi_1').val(con_thi_1);
				$('#con_thi_2').val(con_thi_2);
				$('#con_thi_3').val(con_thi_3);

				var fr_1 = randomNumberFromRange(1.000, 5.000).toFixed(3);
				var fr_2 = randomNumberFromRange(1.000, 5.000).toFixed(3);
				var fr_3 = randomNumberFromRange(1.000, 5.000).toFixed(3);

				$('#fr_1').val(fr_1);
				$('#fr_2').val(fr_2);
				$('#fr_3').val(fr_3);

				var fr1 = $('#fr_1').val();
				var fr2 = $('#fr_2').val();
				var fr3 = $('#fr_3').val();


				var avgshrink = $('#avg_shrink').val();

				var rr = randomNumberFromRange(1, 20).toFixed();
				if (rr % 2 == 0) {
					var ds_1 = (+avgshrink) + (+0.003);
					var ds_2 = (+avgshrink) - (+0.004);
					var ds_3 = (+avgshrink) + (+0.001);
				} else {
					var ds_1 = (+avgshrink) - (+0.001);
					var ds_2 = (+avgshrink) + (+0.004);
					var ds_3 = (+avgshrink) - (+0.003);
				}
				$('#ds_1').val(ds_1.toFixed(3));
				$('#ds_2').val(ds_2.toFixed(3));
				$('#ds_3').val(ds_3.toFixed(3));

				var ds1 = $('#ds_1').val();
				var ds2 = $('#ds_2').val();
				var ds3 = $('#ds_3').val();

				var con1 = $('#con_1').val();
				var con2 = $('#con_2').val();
				var con3 = $('#con_3').val();

				var fi_1 = (((+con1) * (+ds1)) / 100) + (+con1);
				var fi_2 = (((+con2) * (+ds2)) / 100) + (+con2);
				var fi_3 = (((+con3) * (+ds3)) / 100) + (+con3);

				var temw1 = (+fi_1) - (+con1);
				var temw2 = (+fi_2) - (+con2);
				var temw3 = (+fi_3) - (+con3);

				var finl1 = (+temw1) + (+fr1);
				var finl2 = (+temw2) + (+fr2);
				var finl3 = (+temw3) + (+fr3);

				$('#fi_1').val(finl1.toFixed(3));
				$('#fi_2').val(finl2.toFixed(3));
				$('#fi_3').val(finl3.toFixed(3));

				var fi1 = $('#fi_1').val();
				var fi2 = $('#fi_2').val();
				var fi3 = $('#fi_3').val();

				var dif1 = ((+fi1) - (fr1)) + (+con1);
				var dif2 = ((+fi2) - (fr2)) + (+con2);
				var dif3 = ((+fi3) - (fr3)) + (+con3);

				var dipl1 = (((+dif1) * 100) / (+con1)) - 100;
				var dipl2 = (((+dif2) * 100) / (+con2)) - 100;
				var dipl3 = (((+dif3) * 100) / (+con3)) - 100;
				$('#ds_1').val(dipl1.toFixed(3));
				$('#ds_2').val(dipl2.toFixed(3));
				$('#ds_3').val(dipl3.toFixed(3));

				var fs1 = $('#ds_1').val();
				var fs2 = $('#ds_2').val();
				var fs3 = $('#ds_3').val();

				var finalans = ((+fs1) + (+fs2) + (+fs3)) / 3;
				$('#avg_shrink').val(finalans.toFixed(3));


			}
		});


		$('#chk_shr').change(function() {
			if (this.checked) {
				shr_auto();
			} else {
				$('#txtshr').css("background-color", "white");
				$('#con_1').val(null);
				$('#con_2').val(null);
				$('#con_3').val(null);
				$('#fr_1').val(null);
				$('#fr_2').val(null);
				$('#fr_3').val(null);
				$('#fi_1').val(null);
				$('#fi_2').val(null);
				$('#fi_3').val(null);
				$('#ds_1').val(null);
				$('#ds_2').val(null);
				$('#ds_3').val(null);
				$('#con_wid_1').val(null);
				$('#con_wid_2').val(null);
				$('#con_wid_3').val(null);
				$('#con_thi_1').val(null);
				$('#con_thi_2').val(null);
				$('#con_thi_3').val(null);
				$('#avg_shrink').val(null);
			}
		});




		$('#chk_auto').change(function() {
			if (this.checked) {
				//$('#txtabr').css("background-color","var(--success)"); 
				//$('#txtwtr').css("background-color","var(--success)"); 


				var temp = $('#test_list').val();
				var aa = temp.split(",");

				//dim
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "dim") {
						$('#txtdim').css("background-color", "var(--success)");
						$("#chk_dim").prop("checked", true);
						dim_auto();
						break;
					}
				}

				//Compressive strength
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "com") {
						$('#txtcom').css("background-color", "var(--success)");
						$("#chk_com").prop("checked", true);
						com_auto();
						break;
					}
				}



				//density
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "den") {
						$('#txtden').css("background-color", "var(--success)");
						$("#chk_den").prop("checked", true);
						den_auto();
						break;
					}
				}


				//moisture content
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "shr") {
						$('#txtshr').css("background-color", "var(--success)");
						$("#chk_shr").prop("checked", true);
						shr_auto();
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
			url: '<?php echo $base_url; ?>save_clc_block.php',
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
			var in_l = $('#in_l').val();
			var in_w = $('#in_w').val();
			var in_h = $('#in_h').val();
			var in_den = $('#in_den').val();
			var in_grade = $('#in_grade').val();
			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//Compressive strength
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "com") {
					if (document.getElementById('chk_com').checked) {
						var chk_com = "1";
					} else {
						var chk_com = "0";
					}


					var sample_1 = $('#sample_1').val();
					var sample_2 = $('#sample_2').val();
					var sample_3 = $('#sample_3').val();

					var l_1 = $('#l_1').val();
					var l_2 = $('#l_2').val();
					var l_3 = $('#l_3').val();

					var w_1 = $('#w_1').val();
					var w_2 = $('#w_2').val();
					var w_3 = $('#w_3').val();

					var h_1 = $('#h_1').val();
					var h_2 = $('#h_2').val();
					var h_3 = $('#h_3').val();

					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();

					var area_1 = $('#area_1').val();
					var area_2 = $('#area_2').val();
					var area_3 = $('#area_3').val();

					var com_1 = $('#com_1').val();
					var com_2 = $('#com_2').val();
					var com_3 = $('#com_3').val();



					var avg_com = $('#avg_com').val();
					break;
				} else {
					var chk_com = "0";
					var sample_1 = "";
					var sample_2 = "";
					var sample_3 = "";

					var l_1 = "";
					var l_2 = "";
					var l_3 = "";

					var w_1 = "";
					var w_2 = "";
					var w_3 = "";

					var h_1 = "";
					var h_2 = "";
					var h_3 = "";

					var load_1 = "";
					var load_2 = "";
					var load_3 = "";

					var area_1 = "";
					var area_2 = "";
					var area_3 = "";

					var com_1 = "";
					var com_2 = "";
					var com_3 = "";


					var avg_com = "";


				}
			}

			//dimenstion
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "dim") {
					if (document.getElementById('chk_dim').checked) {
						var chk_dim = "1";
					} else {
						var chk_dim = "0";
					}




					var dim_height = $('#dim_height').val();
					var dim_width = $('#dim_width').val();
					var dim_length = $('#dim_length').val();
					var dim_l1 = $('#dim_l1').val();
					var dim_l2 = $('#dim_l2').val();
					var dim_l3 = $('#dim_l3').val();
					var dim_l4 = $('#dim_l4').val();
					var dim_h1 = $('#dim_h1').val();
					var dim_h2 = $('#dim_h2').val();
					var dim_h3 = $('#dim_h3').val();
					var dim_h4 = $('#dim_h4').val();
					var dim_h5 = $('#dim_h5').val();
					var dim_h6 = $('#dim_h6').val();
					var dim_w1 = $('#dim_w1').val();
					var dim_w2 = $('#dim_w2').val();
					var dim_w3 = $('#dim_w3').val();
					var dim_w4 = $('#dim_w4').val();
					var dim_w5 = $('#dim_w5').val();
					var dim_w6 = $('#dim_w6').val();



					break;
				} else {
					var chk_dim = "0";


					var dim_height = "";
					var dim_width = "";
					var dim_height = "";

					var dim_l1 = "";
					var dim_l2 = "";
					var dim_l3 = "";
					var dim_l4 = "";
					var dim_h1 = "";
					var dim_h2 = "";
					var dim_h3 = "";
					var dim_h4 = "";
					var dim_h5 = "";
					var dim_h6 = "";
					var dim_w1 = "";
					var dim_w2 = "";
					var dim_w3 = "";
					var dim_w4 = "";
					var dim_w5 = "";
					var dim_w6 = "";



				}
			}


			//DENSITY
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "den") {
					if (document.getElementById('chk_den').checked) {
						var chk_den = "1";
					} else {
						var chk_den = "0";
					}

					var dl_1 = $('#dl_1').val();
					var dl_2 = $('#dl_2').val();
					var dl_3 = $('#dl_3').val();

					var dw_1 = $('#dw_1').val();
					var dw_2 = $('#dw_2').val();
					var dw_3 = $('#dw_3').val();

					var dh_1 = $('#dh_1').val();
					var dh_2 = $('#dh_2').val();
					var dh_3 = $('#dh_3').val();

					var vol_1 = $('#vol_1').val();
					var vol_2 = $('#vol_2').val();
					var vol_3 = $('#vol_3').val();

					var weight_1 = $('#weight_1').val();
					var weight_2 = $('#weight_2').val();
					var weight_3 = $('#weight_3').val();

					var den_1 = $('#den_1').val();
					var den_2 = $('#den_2').val();
					var den_3 = $('#den_3').val();

					var wa_1 = $('#wa_1').val();
					var wa_2 = $('#wa_2').val();
					var wa_3 = $('#wa_3').val();
					var w1 = $('#w1').val();
					var w2 = $('#w2').val();
					var w3 = $('#w3').val();


					var bdl = $('#bdl').val();
					var bdl_kg = $('#bdl_kg').val();
					var mc = $('#mc').val();

					break;
				} else {
					var chk_wtr = "0";
					var dl_1 = "";
					var dl_2 = "";
					var dl_3 = "";

					var dw_1 = "";
					var dw_2 = "";
					var dw_3 = "";

					var dh_1 = "";
					var dh_2 = "";
					var dh_3 = "";

					var vol_1 = "";
					var vol_2 = "";
					var vol_3 = "";

					var weight_1 = "";
					var weight_2 = "";
					var weight_3 = "";

					var den_1 = "";
					var den_2 = "";
					var den_3 = "";


					var wa_1 = "";
					var wa_2 = "";
					var wa_3 = "";
					var w1 = "";
					var w2 = "";
					var w3 = "";


					var bdl = "";
					var bdl_kg = "";
					var mc = "";
				}
			}



			//Drying Shrinkage
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "shr") {
					if (document.getElementById('chk_shr').checked) {
						var chk_shr = "1";
					} else {
						var chk_shr = "0";
					}

					var con_1 = $('#con_1').val();
					var con_2 = $('#con_2').val();
					var con_3 = $('#con_3').val();

					var fr_1 = $('#fr_1').val();
					var fr_2 = $('#fr_2').val();
					var fr_3 = $('#fr_3').val();

					var fi_1 = $('#fi_1').val();
					var fi_2 = $('#fi_2').val();
					var fi_3 = $('#fi_3').val();

					var ds_1 = $('#ds_1').val();
					var ds_2 = $('#ds_2').val();
					var ds_3 = $('#ds_3').val();

					var con_wid_1 = $('#con_wid_1').val();
					var con_wid_2 = $('#con_wid_2').val();
					var con_wid_3 = $('#con_wid_3').val();
					var con_thi_1 = $('#con_thi_1').val();
					var con_thi_2 = $('#con_thi_2').val();
					var con_thi_3 = $('#con_thi_3').val();

					var avg_shrink = $('#avg_shrink').val();


					break;
				} else {
					var chk_shr = "0";
					var con_1 = "";
					var con_2 = "";
					var con_3 = "";

					var fr_1 = "";
					var fr_2 = "";
					var fr_3 = "";

					var fi_1 = "";
					var fi_2 = "";
					var fi_3 = "";

					var ds_1 = "";
					var ds_2 = "";
					var ds_3 = "";
					var con_wid_1 = "";
					var con_wid_2 = "";
					var con_wid_3 = "";
					var con_thi_1 = "";
					var con_thi_2 = "";
					var con_thi_3 = "";

					var avg_shrink = "";

				}
			}



			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_com=' + chk_com + '&avg_com=' + avg_com + '&sample_1=' + sample_1 + '&sample_2=' + sample_2 + '&sample_3=' + sample_3 + '&l_1=' + l_1 + '&l_2=' + l_2 + '&l_3=' + l_3 + '&w_1=' + w_1 + '&w_2=' + w_2 + '&w_3=' + w_3 + '&h_1=' + h_1 + '&h_2=' + h_2 + '&h_3=' + h_3 + '&load_1=' + load_1 + '&load_2=' + load_2 + '&load_3=' + load_3 + '&area_1=' + area_1 + '&area_2=' + area_2 + '&area_3=' + area_3 + '&com_1=' + com_1 + '&com_2=' + com_2 + '&com_3=' + com_3 + '&chk_dim=' + chk_dim + '&dim_height=' + dim_height + '&dim_width=' + dim_width + '&dim_length=' + dim_length + '&dim_l1=' + dim_l1 + '&dim_l2=' + dim_l2 + '&dim_l3=' + dim_l3 + '&dim_l4=' + dim_l4 + '&dim_h1=' + dim_h1 + '&dim_h2=' + dim_h2 + '&dim_h3=' + dim_h3 + '&dim_h4=' + dim_h4 + '&dim_h5=' + dim_h5 + '&dim_h6=' + dim_h6 + '&dim_w1=' + dim_w1 + '&dim_w2=' + dim_w2 + '&dim_w3=' + dim_w3 + '&dim_w4=' + dim_w4 + '&dim_w5=' + dim_w5 + '&dim_w6=' + dim_w6 + '&chk_den=' + chk_den + '&dl_1=' + dl_1 + '&dl_2=' + dl_2 + '&dl_3=' + dl_3 + '&dw_1=' + dw_1 + '&dw_2=' + dw_2 + '&dw_3=' + dw_3 + '&dh_1=' + dh_1 + '&dh_2=' + dh_2 + '&dh_3=' + dh_3 + '&vol_1=' + vol_1 + '&vol_2=' + vol_2 + '&vol_3=' + vol_3 + '&weight_1=' + weight_1 + '&weight_2=' + weight_2 + '&weight_3=' + weight_3 + '&den_1=' + den_1 + '&den_2=' + den_2 + '&den_3=' + den_3 + '&wa_1=' + wa_1 + '&wa_2=' + wa_2 + '&wa_3=' + wa_3 + '&w1=' + w1 + '&w2=' + w2 + '&w3=' + w3 + '&bdl=' + bdl + '&bdl_kg=' + bdl_kg + '&mc=' + mc + '&chk_shr=' + chk_shr + '&con_1=' + con_1 + '&con_2=' + con_2 + '&con_3=' + con_3 + '&fr_1=' + fr_1 + '&fr_2=' + fr_2 + '&fr_3=' + fr_3 + '&fi_1=' + fi_1 + '&fi_2=' + fi_2 + '&fi_3=' + fi_3 + '&ds_1=' + ds_1 + '&ds_2=' + ds_2 + '&ds_3=' + ds_3 + '&avg_shrink=' + avg_shrink + '&in_l=' + in_l + '&in_w=' + in_w + '&in_h=' + in_h + '&in_den=' + in_den + '&in_grade=' + in_grade + '&con_wid_1=' + con_wid_1 + '&con_wid_2=' + con_wid_2 + '&con_wid_3=' + con_wid_3 + '&con_thi_1=' + con_thi_1 + '&con_thi_2=' + con_thi_2 + '&con_thi_3=' + con_thi_3+ '&amend_date=' + amend_date;




		} else if (type == 'edit') {

			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var in_l = $('#in_l').val();
			var in_w = $('#in_w').val();
			var in_h = $('#in_h').val();
			var in_den = $('#in_den').val();
			var in_grade = $('#in_grade').val();
			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//Compressive strength
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "com") {
					if (document.getElementById('chk_com').checked) {
						var chk_com = "1";
					} else {
						var chk_com = "0";
					}


					var sample_1 = $('#sample_1').val();
					var sample_2 = $('#sample_2').val();
					var sample_3 = $('#sample_3').val();

					var l_1 = $('#l_1').val();
					var l_2 = $('#l_2').val();
					var l_3 = $('#l_3').val();

					var w_1 = $('#w_1').val();
					var w_2 = $('#w_2').val();
					var w_3 = $('#w_3').val();

					var h_1 = $('#h_1').val();
					var h_2 = $('#h_2').val();
					var h_3 = $('#h_3').val();

					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();

					var area_1 = $('#area_1').val();
					var area_2 = $('#area_2').val();
					var area_3 = $('#area_3').val();

					var com_1 = $('#com_1').val();
					var com_2 = $('#com_2').val();
					var com_3 = $('#com_3').val();



					var avg_com = $('#avg_com').val();
					break;
				} else {
					var chk_com = "0";
					var sample_1 = "";
					var sample_2 = "";
					var sample_3 = "";

					var l_1 = "";
					var l_2 = "";
					var l_3 = "";

					var w_1 = "";
					var w_2 = "";
					var w_3 = "";

					var h_1 = "";
					var h_2 = "";
					var h_3 = "";

					var load_1 = "";
					var load_2 = "";
					var load_3 = "";

					var area_1 = "";
					var area_2 = "";
					var area_3 = "";

					var com_1 = "";
					var com_2 = "";
					var com_3 = "";


					var avg_com = "";


				}
			}

			//dimenstion
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "dim") {
					if (document.getElementById('chk_dim').checked) {
						var chk_dim = "1";
					} else {
						var chk_dim = "0";
					}




					var dim_height = $('#dim_height').val();
					var dim_width = $('#dim_width').val();
					var dim_length = $('#dim_length').val();
					var dim_l1 = $('#dim_l1').val();
					var dim_l2 = $('#dim_l2').val();
					var dim_l3 = $('#dim_l3').val();
					var dim_l4 = $('#dim_l4').val();
					var dim_h1 = $('#dim_h1').val();
					var dim_h2 = $('#dim_h2').val();
					var dim_h3 = $('#dim_h3').val();
					var dim_h4 = $('#dim_h4').val();
					var dim_h5 = $('#dim_h5').val();
					var dim_h6 = $('#dim_h6').val();
					var dim_w1 = $('#dim_w1').val();
					var dim_w2 = $('#dim_w2').val();
					var dim_w3 = $('#dim_w3').val();
					var dim_w4 = $('#dim_w4').val();
					var dim_w5 = $('#dim_w5').val();
					var dim_w6 = $('#dim_w6').val();



					break;
				} else {
					var chk_dim = "0";


					var dim_height = "";
					var dim_width = "";
					var dim_height = "";

					var dim_l1 = "";
					var dim_l2 = "";
					var dim_l3 = "";
					var dim_l4 = "";
					var dim_h1 = "";
					var dim_h2 = "";
					var dim_h3 = "";
					var dim_h4 = "";
					var dim_h5 = "";
					var dim_h6 = "";
					var dim_w1 = "";
					var dim_w2 = "";
					var dim_w3 = "";
					var dim_w4 = "";
					var dim_w5 = "";
					var dim_w6 = "";



				}
			}


			//DENSITY
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "den") {
					if (document.getElementById('chk_den').checked) {
						var chk_den = "1";
					} else {
						var chk_den = "0";
					}

					var dl_1 = $('#dl_1').val();
					var dl_2 = $('#dl_2').val();
					var dl_3 = $('#dl_3').val();

					var dw_1 = $('#dw_1').val();
					var dw_2 = $('#dw_2').val();
					var dw_3 = $('#dw_3').val();

					var dh_1 = $('#dh_1').val();
					var dh_2 = $('#dh_2').val();
					var dh_3 = $('#dh_3').val();

					var vol_1 = $('#vol_1').val();
					var vol_2 = $('#vol_2').val();
					var vol_3 = $('#vol_3').val();

					var weight_1 = $('#weight_1').val();
					var weight_2 = $('#weight_2').val();
					var weight_3 = $('#weight_3').val();

					var den_1 = $('#den_1').val();
					var den_2 = $('#den_2').val();
					var den_3 = $('#den_3').val();

					var wa_1 = $('#wa_1').val();
					var wa_2 = $('#wa_2').val();
					var wa_3 = $('#wa_3').val();
					var w1 = $('#w1').val();
					var w2 = $('#w2').val();
					var w3 = $('#w3').val();


					var bdl = $('#bdl').val();
					var bdl_kg = $('#bdl_kg').val();
					var mc = $('#mc').val();

					break;
				} else {
					var chk_wtr = "0";
					var dl_1 = "";
					var dl_2 = "";
					var dl_3 = "";

					var dw_1 = "";
					var dw_2 = "";
					var dw_3 = "";

					var dh_1 = "";
					var dh_2 = "";
					var dh_3 = "";

					var vol_1 = "";
					var vol_2 = "";
					var vol_3 = "";

					var weight_1 = "";
					var weight_2 = "";
					var weight_3 = "";

					var den_1 = "";
					var den_2 = "";
					var den_3 = "";


					var wa_1 = "";
					var wa_2 = "";
					var wa_3 = "";
					var w1 = "";
					var w2 = "";
					var w3 = "";


					var bdl = "";
					var bdl_kg = "";
					var mc = "";
				}
			}



			//Drying Shrinkage
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "shr") {
					if (document.getElementById('chk_shr').checked) {
						var chk_shr = "1";
					} else {
						var chk_shr = "0";
					}

					var con_1 = $('#con_1').val();
					var con_2 = $('#con_2').val();
					var con_3 = $('#con_3').val();

					var fr_1 = $('#fr_1').val();
					var fr_2 = $('#fr_2').val();
					var fr_3 = $('#fr_3').val();

					var fi_1 = $('#fi_1').val();
					var fi_2 = $('#fi_2').val();
					var fi_3 = $('#fi_3').val();

					var ds_1 = $('#ds_1').val();
					var ds_2 = $('#ds_2').val();
					var ds_3 = $('#ds_3').val();

					var con_wid_1 = $('#con_wid_1').val();
					var con_wid_2 = $('#con_wid_2').val();
					var con_wid_3 = $('#con_wid_3').val();
					var con_thi_1 = $('#con_thi_1').val();
					var con_thi_2 = $('#con_thi_2').val();
					var con_thi_3 = $('#con_thi_3').val();


					var avg_shrink = $('#avg_shrink').val();


					break;
				} else {
					var chk_shr = "0";
					var con_1 = "";
					var con_2 = "";
					var con_3 = "";

					var fr_1 = "";
					var fr_2 = "";
					var fr_3 = "";

					var fi_1 = "";
					var fi_2 = "";
					var fi_3 = "";

					var ds_1 = "";
					var ds_2 = "";
					var ds_3 = "";
					var con_wid_1 = "";
					var con_wid_2 = "";
					var con_wid_3 = "";
					var con_thi_1 = "";
					var con_thi_2 = "";
					var con_thi_3 = "";

					var avg_shrink = "";

				}
			}


			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_com=' + chk_com + '&avg_com=' + avg_com + '&sample_1=' + sample_1 + '&sample_2=' + sample_2 + '&sample_3=' + sample_3 + '&l_1=' + l_1 + '&l_2=' + l_2 + '&l_3=' + l_3 + '&w_1=' + w_1 + '&w_2=' + w_2 + '&w_3=' + w_3 + '&h_1=' + h_1 + '&h_2=' + h_2 + '&h_3=' + h_3 + '&load_1=' + load_1 + '&load_2=' + load_2 + '&load_3=' + load_3 + '&area_1=' + area_1 + '&area_2=' + area_2 + '&area_3=' + area_3 + '&com_1=' + com_1 + '&com_2=' + com_2 + '&com_3=' + com_3 + '&chk_dim=' + chk_dim + '&dim_height=' + dim_height + '&dim_width=' + dim_width + '&dim_length=' + dim_length + '&dim_l1=' + dim_l1 + '&dim_l2=' + dim_l2 + '&dim_l3=' + dim_l3 + '&dim_l4=' + dim_l4 + '&dim_h1=' + dim_h1 + '&dim_h2=' + dim_h2 + '&dim_h3=' + dim_h3 + '&dim_h4=' + dim_h4 + '&dim_h5=' + dim_h5 + '&dim_h6=' + dim_h6 + '&dim_w1=' + dim_w1 + '&dim_w2=' + dim_w2 + '&dim_w3=' + dim_w3 + '&dim_w4=' + dim_w4 + '&dim_w5=' + dim_w5 + '&dim_w6=' + dim_w6 + '&chk_den=' + chk_den + '&dl_1=' + dl_1 + '&dl_2=' + dl_2 + '&dl_3=' + dl_3 + '&dw_1=' + dw_1 + '&dw_2=' + dw_2 + '&dw_3=' + dw_3 + '&dh_1=' + dh_1 + '&dh_2=' + dh_2 + '&dh_3=' + dh_3 + '&vol_1=' + vol_1 + '&vol_2=' + vol_2 + '&vol_3=' + vol_3 + '&weight_1=' + weight_1 + '&weight_2=' + weight_2 + '&weight_3=' + weight_3 + '&den_1=' + den_1 + '&den_2=' + den_2 + '&den_3=' + den_3 + '&wa_1=' + wa_1 + '&wa_2=' + wa_2 + '&wa_3=' + wa_3 + '&w1=' + w1 + '&w2=' + w2 + '&w3=' + w3 + '&bdl=' + bdl + '&bdl_kg=' + bdl_kg + '&mc=' + mc + '&chk_shr=' + chk_shr + '&con_1=' + con_1 + '&con_2=' + con_2 + '&con_3=' + con_3 + '&fr_1=' + fr_1 + '&fr_2=' + fr_2 + '&fr_3=' + fr_3 + '&fi_1=' + fi_1 + '&fi_2=' + fi_2 + '&fi_3=' + fi_3 + '&ds_1=' + ds_1 + '&ds_2=' + ds_2 + '&ds_3=' + ds_3 + '&avg_shrink=' + avg_shrink + '&in_l=' + in_l + '&in_w=' + in_w + '&in_h=' + in_h + '&in_den=' + in_den + '&in_grade=' + in_grade + '&con_wid_1=' + con_wid_1 + '&con_wid_2=' + con_wid_2 + '&con_wid_3=' + con_wid_3 + '&con_thi_1=' + con_thi_1 + '&con_thi_2=' + con_thi_2 + '&con_thi_3=' + con_thi_3+ '&amend_date=' + amend_date;



		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}


		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_clc_block.php',
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
			url: '<?php echo $base_url; ?>save_clc_block.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);

				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);
				$('#ulr').val(data.ulr);
				$('#amend_date').val(data.amend_date);
				$('#in_l').val(data.in_l);
				$('#in_w').val(data.in_w);
				$('#in_h').val(data.in_h);
				$('#in_grade').val(data.in_grade);
				$('#in_den').val(data.in_den);

				var temp = $('#test_list').val();
				var aa = temp.split(",");

				//Water Absorption	
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "com") {

						var chk_com = data.chk_com;
						if (chk_com == "1") {
							$('#txtcom').css("background-color", "var(--success)");
							$("#chk_com").prop("checked", true);
						} else {
							$('#txtcom').css("background-color", "white");
							$("#chk_com").prop("checked", false);
						}

						$('#avg_com').val(data.avg_com);

						$('#sample_1').val(data.sample_1);
						$('#sample_2').val(data.sample_2);
						$('#sample_3').val(data.sample_3);

						$('#l_1').val(data.l_1);
						$('#l_2').val(data.l_2);
						$('#l_3').val(data.l_3);
						$('#w_1').val(data.w_1);
						$('#w_2').val(data.w_2);
						$('#w_3').val(data.w_3);
						$('#h_1').val(data.h_1);
						$('#h_2').val(data.h_2);
						$('#h_3').val(data.h_3);
						$('#load_1').val(data.load_1);
						$('#load_2').val(data.load_2);
						$('#load_3').val(data.load_3);
						$('#area_1').val(data.area_1);
						$('#area_2').val(data.area_2);
						$('#area_3').val(data.area_3);
						$('#com_1').val(data.com_1);
						$('#com_2').val(data.com_2);
						$('#com_3').val(data.com_3);


						break;
					} else {

					}

				}

				//dimenstion
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

						$('#dim_length').val(data.dim_length);
						$('#dim_width').val(data.dim_width);
						$('#dim_height').val(data.dim_height);

						$('#dim_l1').val(data.dim_l1);
						$('#dim_l2').val(data.dim_l2);
						$('#dim_l3').val(data.dim_l3);
						$('#dim_l4').val(data.dim_l4);


						$('#dim_h1').val(data.dim_h1);
						$('#dim_h2').val(data.dim_h2);
						$('#dim_h3').val(data.dim_h3);
						$('#dim_h4').val(data.dim_h4);
						$('#dim_h5').val(data.dim_h5);
						$('#dim_h6').val(data.dim_h6);

						$('#dim_w1').val(data.dim_w1);
						$('#dim_w2').val(data.dim_w2);
						$('#dim_w3').val(data.dim_w3);
						$('#dim_w4').val(data.dim_w4);
						$('#dim_w5').val(data.dim_w5);
						$('#dim_w6').val(data.dim_w6);


						break;
					} else {

					}

				}

				//DENSITY TEST
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "den") {

						var chk_den = data.chk_den;
						if (chk_den == "1") {
							$('#txtden').css("background-color", "var(--success)");
							$("#chk_den").prop("checked", true);
						} else {
							$('#txtden').css("background-color", "white");
							$("#chk_den").prop("checked", false);
						}

						$('#bdl').val(data.bdl);
						$('#bdl_kg').val(data.bdl_kg);
						$('#mc').val(data.mc);
						$('#dl_1').val(data.dl_1);
						$('#dl_2').val(data.dl_2);
						$('#dl_3').val(data.dl_3);
						$('#dw_1').val(data.dw_1);
						$('#dw_2').val(data.dw_2);
						$('#dw_3').val(data.dw_3);
						$('#dh_1').val(data.dh_1);
						$('#dh_2').val(data.dh_2);
						$('#dh_3').val(data.dh_3);

						$('#vol_1').val(data.vol_1);
						$('#vol_2').val(data.vol_2);
						$('#vol_3').val(data.vol_3);

						$('#weight_1').val(data.weight_1);
						$('#weight_2').val(data.weight_2);
						$('#weight_3').val(data.weight_3);

						$('#den_1').val(data.den_1);
						$('#den_2').val(data.den_2);
						$('#den_3').val(data.den_3);

						$('#wa_1').val(data.wa_1);
						$('#wa_2').val(data.wa_2);
						$('#wa_3').val(data.wa_3);

						$('#w1').val(data.w1);
						$('#w2').val(data.w2);
						$('#w3').val(data.w3);


						break;
					} else {

					}

				}


				//Drying Shrinkage
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "shr") {

						var chk_shr = data.chk_shr;
						if (chk_shr == "1") {
							$('#txtshr').css("background-color", "var(--success)");
							$("#chk_shr").prop("checked", true);
						} else {
							$('#txtshr').css("background-color", "white");
							$("#chk_shr").prop("checked", false);
						}

						$('#avg_shrink').val(data.avg_shrink);

						$('#con_1').val(data.con_1);
						$('#con_2').val(data.con_2);
						$('#con_3').val(data.con_3);
						$('#fr_1').val(data.fr_1);
						$('#fr_2').val(data.fr_2);
						$('#fr_3').val(data.fr_3);
						$('#fi_1').val(data.fi_1);
						$('#fi_2').val(data.fi_2);
						$('#fi_3').val(data.fi_3);

						$('#ds_1').val(data.ds_1);
						$('#ds_2').val(data.ds_2);
						$('#ds_3').val(data.ds_3);

						$('#con_wid_1').val(data.con_wid_1);
						$('#con_wid_2').val(data.con_wid_2);
						$('#con_wid_3').val(data.con_wid_3);

						$('#con_thi_1').val(data.con_thi_1);
						$('#con_thi_2').val(data.con_thi_2);
						$('#con_thi_3').val(data.con_thi_3);



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