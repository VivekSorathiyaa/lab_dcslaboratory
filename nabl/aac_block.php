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
	$in_l = $row_select4['in_l'];
	$in_w = $row_select4['in_w'];
	$in_h = $row_select4['in_h'];
	$in_den = $row_select4['in_den'];
	$in_grade = $row_select4['in_grade'];
}

?>
<div class="content-wrapper" style="margin-left:0px !important;">

	<section class="content common_material p-0">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">AAC BLOCK</h2>
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
								<div class="col-lg-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Density :</label>


										<div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="in_den" value="<?php echo $in_den; ?>" name="in_den">
											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_den"  name="in_den" ReadOnly value="451 to 550">-->
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Grade :</label>
										<div class="col-sm-8">
											<input type="text" class="form-control inputs" tabindex="4" id="in_grade" value="<?php echo $in_grade; ?>" name="in_grade">
											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_grade" 	 name="in_grade" ReadOnly value="grade 1">-->
										</div>
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No. :</label>	-->
										<div class="col-sm-6">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" ReadOnly>
										</div>

									</div>
								</div>
								<div class="col-lg-4">
										<div class="form-group">
										 <div class="col-sm-4">
													<!--<label>Amend Date. :</label>-->
												</div>								 
										  <div class="col-sm-8">
											<input type="hidden" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
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
											$querys_job1 = "SELECT * FROM aac_block WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
												<a target='_blank' href="<?php echo $base_url; ?>print_report/print_aac_block.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

											</div>

										<?php //} ?>
										<div class="col-sm-2">
											<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_aac_block.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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
																	<label for="inputEmail3" class="control-label">Breadth in mm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Height in mm</label>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Moisture Content (10 &plusmn; 2)</label>
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
															<div class="col-md-1">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Wt of Specimen (W1)</label>
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
																	<input type="text" class="form-control" id="mc_1" name="mc_1">
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
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_1" name="w1_1">
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
																	<input type="text" class="form-control" id="mc_2" name="mc_2">
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
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_2" name="w1_2">
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
																	<input type="text" class="form-control" id="mc_3" name="mc_3">
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
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_3" name="w1_3">
																</div>
															</div>
															
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_3" name="com_3">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_4" name="sample_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_4" name="l_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_4" name="w_4">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_4" name="h_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mc_4" name="mc_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_4" name="load_4">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_4" name="area_4" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_4" name="w1_4">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_4" name="com_4">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_5" name="sample_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_5" name="l_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_5" name="w_5">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_5" name="h_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mc_5" name="mc_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_5" name="load_5">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_5" name="area_5" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_5" name="w1_5">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_5" name="com_5">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_6" name="sample_6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_6" name="l_6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_6" name="w_6">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_6" name="h_6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mc_6" name="mc_6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_6" name="load_6">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_6" name="area_6" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_6" name="w1_6">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_6" name="com_6">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_7" name="sample_7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_7" name="l_7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_7" name="w_7">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_7" name="h_7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mc_7" name="mc_7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_7" name="load_7">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_7" name="area_7" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_7" name="w1_7">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_7" name="com_7">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_8" name="sample_8">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_8" name="l_8">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_8" name="w_8">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_8" name="h_8">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mc_8" name="mc_8">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_8" name="load_8">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_8" name="area_8" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_8" name="w1_8">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_8" name="com_8">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_9" name="sample_9">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_9" name="l_9">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_9" name="w_9">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_9" name="h_9">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mc_9" name="mc_9">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_9" name="load_9">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_9" name="area_9" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_9" name="w1_9">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_9" name="com_9">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_10" name="sample_10">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_10" name="l_10">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_10" name="w_10">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_10" name="h_10">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mc_10" name="mc_10">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_10" name="load_10">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_10" name="area_10" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_10" name="w1_10">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_10" name="com_10">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_11" name="sample_11">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_11" name="l_11">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_11" name="w_11">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_11" name="h_11">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mc_11" name="mc_11">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_11" name="load_11">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_11" name="area_11" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_11" name="w1_11">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_11" name="com_11">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="sample_12" name="sample_12">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="l_12" name="l_12">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w_12" name="w_12">
																</div>
															</div>

															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="h_12" name="h_12">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="mc_12" name="mc_12">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="load_12" name="load_12">
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="area_12" name="area_12" readonly>
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<input type="text" class="form-control" id="w1_12" name="w1_12">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" id="com_12" name="com_12">
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
															<div class="col-md-3">
																<div class="form-group">
																	<label for="inputEmail3" class="control-label">Block ID</label>
																</div>
															</div>

														</div>


														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

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

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block1" name="dim_block1">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

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

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block2" name="dim_block2">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

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

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block3" name="dim_block3">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

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

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block4" name="dim_block4">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l5" name="dim_l5">
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

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block5" name="dim_block5">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l6" name="dim_l6">
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

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block6" name="dim_block6">
																</div>
															</div>


														</div>
														<br>
														<!--Flakiness Index VALUE SR 1-->
														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l7" name="dim_l7">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w7" name="dim_w7">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h7" name="dim_h7">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block7" name="dim_block7">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l8" name="dim_l8">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w8" name="dim_w8">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h8" name="dim_h8">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block8" name="dim_block8">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l9" name="dim_l9">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w9" name="dim_w9">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h9" name="dim_h9">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block9" name="dim_block9">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l10" name="dim_l10">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w10" name="dim_w10">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h10" name="dim_h10">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block10" name="dim_block10">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l11" name="dim_l11">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w11" name="dim_w11">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h11" name="dim_h11">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block11" name="dim_block11">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l12" name="dim_l12">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w12" name="dim_w12">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h12" name="dim_h12">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block12" name="dim_block12">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l13" name="dim_l13">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w13" name="dim_w13">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h13" name="dim_h13">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block13" name="dim_block13">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l14" name="dim_l14">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w14" name="dim_w14">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h14" name="dim_h14">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block14" name="dim_block14">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l15" name="dim_l15">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w15" name="dim_w15">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h15" name="dim_h15">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block15" name="dim_block15">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l16" name="dim_l16">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w16" name="dim_w16">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h16" name="dim_h16">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block16" name="dim_block16">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l17" name="dim_l17">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w17" name="dim_w17">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h17" name="dim_h17">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block17" name="dim_block17">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l18" name="dim_l18">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w18" name="dim_w18">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h18" name="dim_h18">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block18" name="dim_block18">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l19" name="dim_l19">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w19" name="dim_w19">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h19" name="dim_h19">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block19" name="dim_block19">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l20" name="dim_l20">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w20" name="dim_w20">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h20" name="dim_h20">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block20" name="dim_block20">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l21" name="dim_l21">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w21" name="dim_w21">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h21" name="dim_h21">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block21" name="dim_block21">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l22" name="dim_l22">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w22" name="dim_w22">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h22" name="dim_h22">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block22" name="dim_block22">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l23" name="dim_l23">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w23" name="dim_w23">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h23" name="dim_h23">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block23" name="dim_block23">
																</div>
															</div>
														</div>

														<div class="row">

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_l24" name="dim_l24">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_w24" name="dim_w24">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_h24" name="dim_h24">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<input type="text" class="form-control" id="dim_block24" name="dim_block24">
																</div>
															</div>
														</div>


														<br>
														<div class="row">

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
																	<label for="inputEmail3" class="control-label">Breadth in mm</label>
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
																	<label for="inputEmail3" class="control-label">Moisture Content (%)</label>
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
			if($r1['test_code']=="thr")
			{	
				$test_check.="thr,";
				?>
		<div class="panel panel-default" id="thr">
					<div class="panel-heading" id="txtthr">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse3thr">
								<h4 class="panel-title">
								<b>THERMAL CONDUCTIVITY</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse3thr" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_thr">5.</label>
													<input type="checkbox" class="visually-hidden" name="chk_thr"  id="chk_thr" value="chk_thr"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">THERMAL CONDUCTIVITY</label>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">START DATE</label>
													<input type="text" class="form-control" id="the_s_d" name="the_s_d" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>">
												</div>
											</div>
										</div>
										<div class="col-lg-2">
												<div class="form-group">
													<div class="col-sm-12">
														<label for="inputEmail3" class="col-sm-4 control-label label-right">END DATE</label>
														<input type="text" class="form-control" id="the_e_d" name="the_e_d" value="<?php echo date('d/m/Y', strtotime("$start_date +2 day")); ?>">
													</div>
												</div>
										</div>
									
							</div>								
								<br>
							<br>								
							<div class="row">
								
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Diemention in  meter </label>
										</div>
									</div>
									
									
								
							</div>
							<br>								
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">L </label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tl_1" name="tl_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tl_2" name="tl_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tl_3" name="tl_3">
										</div>
									</div>
									
								
							</div>
							<br>								
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">B </label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tw_1" name="tw_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tw_2" name="tw_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tw_3" name="tw_3">
										</div>
									</div>
									
								
							</div>
							<br>								
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">H </label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="th_1" name="th_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="th_2" name="th_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="th_3" name="th_3">
										</div>
									</div>
									
								
							</div>
							<br>								
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Area in m <sub>3</sub> (A) </label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tarea_1" name="tarea_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tarea_2" name="tarea_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tarea_3" name="tarea_3">
										</div>
									</div>
									
								
							</div>
							<br>								
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Voltage (W) </label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tvolt_1" name="tvolt_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tvolt_2" name="tvolt_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tvolt_3" name="tvolt_3">
										</div>
									</div>
									
								
							</div>
							
							<br>								
							<div class="row">
								
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">HOT FACE TERMPERATURE in K (TH) </label>
										</div>
									</div>
									
									
								
							</div>
														
							<br>
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">1</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_1_1" name="tf_1_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_1_2" name="tf_1_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_1_3" name="tf_1_3">
										</div>
									</div>
									
								
							</div>
							<br>
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">2</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_2_1" name="tf_2_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_2_2" name="tf_2_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_2_3" name="tf_2_3">
										</div>
									</div>
									
								
							</div>
							<br>
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">3</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_3_1" name="tf_3_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_3_2" name="tf_3_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_3_3" name="tf_3_3">
										</div>
									</div>
									
								
							</div>
							<br>
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">AVERAGE</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_avg_1" name="tf_avg_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_avg_2" name="tf_avg_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tf_avg_3" name="tf_avg_3">
										</div>
									</div>
									
								
							</div>
							<br>								
							<div class="row">
								
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">COLD FACE TERMPERATURE in K (TC) </label>
										</div>
									</div>
									
									
								
							</div>
														
							<br>
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">1</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_1_1" name="tc_1_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_1_2" name="tc_1_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_1_3" name="tc_1_3">
										</div>
									</div>
									
								
							</div>
							<br>
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">2</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_2_1" name="tc_2_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_2_2" name="tc_2_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_2_3" name="tc_2_3">
										</div>
									</div>
									
								
							</div>
							<br>
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">3</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_3_1" name="tc_3_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_3_2" name="tc_3_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_3_3" name="tc_3_3">
										</div>
									</div>
									
								
							</div>
							<br>
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">AVERAGE</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_avg_1" name="tc_avg_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_avg_2" name="tc_avg_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="tc_avg_3" name="tc_avg_3">
										</div>
									</div>
									
								
							</div>
							
							
							<br>
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Thermal Conductivity</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="thr_1" name="thr_1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="thr_2" name="thr_2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="thr_3" name="thr_3">
										</div>
									</div>
									
								
							</div>
							<br>
							<div class="row">
								
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_thr" name="avg_thr">
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
													$query = "select * from aac_block WHERE lab_no='$aa'  and `is_deleted`='0'";

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
				var dim_l5 = (+dimlength) + (+2);
				var dim_l6 = (+dimlength) - (+1);
				var dim_l7 = (+dimlength) + (+1);
				var dim_l8 = (+dimlength) - (+2);
				var dim_l9 = (+dimlength) + (+2);
				var dim_l10 = (+dimlength) - (+1);
				var dim_l11 = (+dimlength) + (+1);
				var dim_l12 = (+dimlength) - (+2);
				var dim_l13 = (+dimlength) + (+2);
				var dim_l14 = (+dimlength) - (+1);
				var dim_l15 = (+dimlength) + (+1);
				var dim_l16 = (+dimlength) - (+2);
				var dim_l17 = (+dimlength) + (+2);
				var dim_l18 = (+dimlength) - (+1);
				var dim_l19 = (+dimlength) + (+1);
				var dim_l20 = (+dimlength) - (+2);
				var dim_l21 = (+dimlength) + (+2);
				var dim_l22 = (+dimlength) - (+1);
				var dim_l23 = (+dimlength) + (+1);
				var dim_l24 = (+dimlength) - (+2);
			} else {
				var dim_l1 = (+dimlength) - (+2);
				var dim_l2 = (+dimlength) + (+1);
				var dim_l3 = (+dimlength) - (+1);
				var dim_l4 = (+dimlength) + (+2);
				var dim_l5 = (+dimlength) - (+2);
				var dim_l6 = (+dimlength) + (+1);
				var dim_l7 = (+dimlength) - (+1);
				var dim_l8 = (+dimlength) + (+2);
				var dim_l9 = (+dimlength) - (+2);
				var dim_l10 = (+dimlength) + (+1);
				var dim_l11 = (+dimlength) - (+1);
				var dim_l12 = (+dimlength) + (+2);
				var dim_l13 = (+dimlength) - (+2);
				var dim_l14 = (+dimlength) + (+1);
				var dim_l15 = (+dimlength) - (+1);
				var dim_l16 = (+dimlength) + (+2);
				var dim_l17 = (+dimlength) - (+2);
				var dim_l18 = (+dimlength) + (+1);
				var dim_l19 = (+dimlength) - (+1);
				var dim_l20 = (+dimlength) + (+2);
				var dim_l21 = (+dimlength) - (+2);
				var dim_l22 = (+dimlength) + (+1);
				var dim_l23 = (+dimlength) - (+1);
				var dim_l24 = (+dimlength) + (+2);

			}
			$('#dim_l1').val(dim_l1);
			$('#dim_l2').val(dim_l2);
			$('#dim_l3').val(dim_l3);
			$('#dim_l4').val(dim_l4);
			$('#dim_l5').val(dim_l5);
			$('#dim_l6').val(dim_l6);
			$('#dim_l7').val(dim_l7);
			$('#dim_l8').val(dim_l8);
			$('#dim_l9').val(dim_l9);
			$('#dim_l10').val(dim_l10);
			$('#dim_l11').val(dim_l11);
			$('#dim_l12').val(dim_l12);
			$('#dim_l13').val(dim_l13);
			$('#dim_l14').val(dim_l14);
			$('#dim_l15').val(dim_l15);
			$('#dim_l16').val(dim_l16);
			$('#dim_l17').val(dim_l17);
			$('#dim_l18').val(dim_l18);
			$('#dim_l19').val(dim_l19);
			$('#dim_l20').val(dim_l20);
			$('#dim_l21').val(dim_l21);
			$('#dim_l22').val(dim_l22);
			$('#dim_l23').val(dim_l23);
			$('#dim_l24').val(dim_l24);

			var diml1 = $('#dim_l1').val();
			var diml2 = $('#dim_l2').val();
			var diml3 = $('#dim_l3').val();
			var diml4 = $('#dim_l4').val();
			var diml5 = $('#dim_l5').val();
			var diml6 = $('#dim_l6').val();
			var diml7 = $('#dim_l7').val();
			var diml8 = $('#dim_l8').val();
			var diml9 = $('#dim_l9').val();
			var diml10 = $('#dim_l10').val();
			var diml11 = $('#dim_l11').val();
			var diml12 = $('#dim_l12').val();
			var diml13 = $('#dim_l13').val();
			var diml14 = $('#dim_l14').val();
			var diml15 = $('#dim_l15').val();
			var diml16 = $('#dim_l16').val();
			var diml17 = $('#dim_l17').val();
			var diml18 = $('#dim_l18').val();
			var diml19 = $('#dim_l19').val();
			var diml20 = $('#dim_l20').val();
			var diml21 = $('#dim_l21').val();
			var diml22 = $('#dim_l22').val();
			var diml23 = $('#dim_l23').val();
			var diml24 = $('#dim_l24').val();

			var sum = ((+diml1) + (+diml2) + (+diml3) + (+diml4) + (+diml5) + (+diml6) + (+diml7) + (+diml8) + (+diml9) + (+diml10) + (+diml11) + (+diml12) + (+diml13) + (+diml14) + (+diml15) + (+diml16) + (+diml17) + (+diml18) + (+diml19) + (+diml20) + (+diml21) + (+diml22) + (+diml23) + (+diml24)) / 24;
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
				var dim_h7 = (+dimheight) + (+1);
				var dim_h8 = (+dimheight) - (+2);
				var dim_h9 = (+dimheight) + (+3);
				var dim_h10 = (+dimheight) - (+3);
				var dim_h11 = (+dimheight) + (+2);
				var dim_h12 = (+dimheight) - (+1);
				var dim_h13 = (+dimheight) + (+1);
				var dim_h14 = (+dimheight) - (+2);
				var dim_h15 = (+dimheight) + (+3);
				var dim_h16 = (+dimheight) - (+3);
				var dim_h17 = (+dimheight) + (+2);
				var dim_h18 = (+dimheight) - (+1);
				var dim_h19 = (+dimheight) + (+1);
				var dim_h20 = (+dimheight) - (+2);
				var dim_h21 = (+dimheight) + (+3);
				var dim_h22 = (+dimheight) - (+3);
				var dim_h23 = (+dimheight) + (+2);
				var dim_h24 = (+dimheight) - (+1);
			} else {
				var dim_h1 = (+dimheight) - (+1);
				var dim_h2 = (+dimheight) + (+2);
				var dim_h3 = (+dimheight) - (+3);
				var dim_h4 = (+dimheight) + (+3);
				var dim_h5 = (+dimheight) - (+2);
				var dim_h6 = (+dimheight) + (+1);
				var dim_h7 = (+dimheight) - (+1);
				var dim_h8 = (+dimheight) + (+2);
				var dim_h9 = (+dimheight) - (+3);
				var dim_h10 = (+dimheight) + (+3);
				var dim_h11 = (+dimheight) - (+2);
				var dim_h12 = (+dimheight) + (+1);
				var dim_h13 = (+dimheight) - (+1);
				var dim_h14 = (+dimheight) + (+2);
				var dim_h15 = (+dimheight) - (+3);
				var dim_h16 = (+dimheight) + (+3);
				var dim_h17 = (+dimheight) - (+2);
				var dim_h18 = (+dimheight) + (+1);
				var dim_h19 = (+dimheight) - (+1);
				var dim_h20 = (+dimheight) + (+2);
				var dim_h21 = (+dimheight) - (+3);
				var dim_h22 = (+dimheight) + (+3);
				var dim_h23 = (+dimheight) - (+2);
				var dim_h24 = (+dimheight) + (+1);
			}
			$('#dim_h1').val(dim_h1);
			$('#dim_h2').val(dim_h2);
			$('#dim_h3').val(dim_h3);
			$('#dim_h4').val(dim_h4);
			$('#dim_h5').val(dim_h5);
			$('#dim_h6').val(dim_h6);
			$('#dim_h7').val(dim_h7);
			$('#dim_h8').val(dim_h8);
			$('#dim_h9').val(dim_h9);
			$('#dim_h10').val(dim_h10);
			$('#dim_h11').val(dim_h11);
			$('#dim_h12').val(dim_h12);
			$('#dim_h13').val(dim_h13);
			$('#dim_h14').val(dim_h14);
			$('#dim_h15').val(dim_h15);
			$('#dim_h16').val(dim_h16);
			$('#dim_h17').val(dim_h17);
			$('#dim_h18').val(dim_h18);
			$('#dim_h19').val(dim_h19);
			$('#dim_h20').val(dim_h20);
			$('#dim_h21').val(dim_h21);
			$('#dim_h22').val(dim_h22);
			$('#dim_h23').val(dim_h23);
			$('#dim_h24').val(dim_h24);

			var dimh1 = $('#dim_h1').val();
			var dimh2 = $('#dim_h2').val();
			var dimh3 = $('#dim_h3').val();
			var dimh4 = $('#dim_h4').val();
			var dimh5 = $('#dim_h5').val();
			var dimh6 = $('#dim_h6').val();
			var dimh7 = $('#dim_h7').val();
			var dimh8 = $('#dim_h8').val();
			var dimh9 = $('#dim_h9').val();
			var dimh10 = $('#dim_h10').val();
			var dimh11 = $('#dim_h11').val();
			var dimh12 = $('#dim_h12').val();
			var dimh13 = $('#dim_h13').val();
			var dimh14 = $('#dim_h14').val();
			var dimh15 = $('#dim_h15').val();
			var dimh16 = $('#dim_h16').val();
			var dimh17 = $('#dim_h17').val();
			var dimh18 = $('#dim_h18').val();
			var dimh19 = $('#dim_h19').val();
			var dimh20 = $('#dim_h20').val();
			var dimh21 = $('#dim_h21').val();
			var dimh22 = $('#dim_h22').val();
			var dimh23 = $('#dim_h23').val();
			var dimh24 = $('#dim_h24').val();

			var sum1 = ((+dimh1) + (+dimh2) + (+dimh3) + (+dimh4) + (+dimh5) + (+dimh6) + (+dimh7) + (+dimh8) + (+dimh9) + (+dimh10) + (+dimh11) + (+dimh12) + (+dimh13) + (+dimh14) + (+dimh15) + (+dimh16) + (+dimh17) + (+dimh18) + (+dimh19) + (+dimh20) + (+dimh21) + (+dimh22) + (+dimh23) + (+dimh24)) / 24;
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
				var dim_w7 = (+dimwidth) + (+1);
				var dim_w8 = (+dimwidth) - (+2);
				var dim_w9 = (+dimwidth) + (+3);
				var dim_w10 = (+dimwidth) - (+3);
				var dim_w11 = (+dimwidth) + (+2);
				var dim_w12 = (+dimwidth) - (+1);
				var dim_w13 = (+dimwidth) + (+1);
				var dim_w14 = (+dimwidth) - (+2);
				var dim_w15 = (+dimwidth) + (+3);
				var dim_w16 = (+dimwidth) - (+3);
				var dim_w17 = (+dimwidth) + (+2);
				var dim_w18 = (+dimwidth) - (+1);
				var dim_w19 = (+dimwidth) + (+1);
				var dim_w20 = (+dimwidth) - (+2);
				var dim_w21 = (+dimwidth) + (+3);
				var dim_w22 = (+dimwidth) - (+3);
				var dim_w23 = (+dimwidth) + (+2);
				var dim_w24 = (+dimwidth) - (+1);
			} else {
				var dim_w2 = (+dimwidth) - (+3);
				var dim_w3 = (+dimwidth) + (+2);
				var dim_w4 = (+dimwidth) - (+1);
				var dim_w5 = (+dimwidth) + (+3);
				var dim_w6 = (+dimwidth) - (+1);
				var dim_w7 = (+dimwidth) + (+2);
				var dim_w1 = (+dimwidth) - (+3);
				var dim_w8 = (+dimwidth) + (+2);
				var dim_w9 = (+dimwidth) - (+1);
				var dim_w10 = (+dimwidth) + (+3);
				var dim_w11 = (+dimwidth) - (+1);
				var dim_w12 = (+dimwidth) + (+2);
				var dim_w13 = (+dimwidth) - (+3);
				var dim_w14 = (+dimwidth) + (+2);
				var dim_w15 = (+dimwidth) - (+1);
				var dim_w16 = (+dimwidth) + (+3);
				var dim_w17 = (+dimwidth) - (+1);
				var dim_w18 = (+dimwidth) + (+2);
				var dim_w19 = (+dimwidth) - (+3);
				var dim_w20 = (+dimwidth) + (+2);
				var dim_w21 = (+dimwidth) - (+1);
				var dim_w22 = (+dimwidth) + (+3);
				var dim_w23 = (+dimwidth) - (+1);
				var dim_w24 = (+dimwidth) + (+2);
			}
			$('#dim_w1').val(dim_w1);
			$('#dim_w2').val(dim_w2);
			$('#dim_w3').val(dim_w3);
			$('#dim_w4').val(dim_w4);
			$('#dim_w5').val(dim_w5);
			$('#dim_w6').val(dim_w6);
			$('#dim_w7').val(dim_w7);
			$('#dim_w8').val(dim_w8);
			$('#dim_w9').val(dim_w9);
			$('#dim_w10').val(dim_w10);
			$('#dim_w11').val(dim_w11);
			$('#dim_w12').val(dim_w12);
			$('#dim_w13').val(dim_w13);
			$('#dim_w14').val(dim_w14);
			$('#dim_w15').val(dim_w15);
			$('#dim_w16').val(dim_w16);
			$('#dim_w17').val(dim_w17);
			$('#dim_w18').val(dim_w18);
			$('#dim_w19').val(dim_w19);
			$('#dim_w20').val(dim_w20);
			$('#dim_w21').val(dim_w21);
			$('#dim_w22').val(dim_w22);
			$('#dim_w23').val(dim_w23);
			$('#dim_w24').val(dim_w24);

			var dimw1 = $('#dim_w1').val();
			var dimw2 = $('#dim_w2').val();
			var dimw3 = $('#dim_w3').val();
			var dimw4 = $('#dim_w4').val();
			var dimw5 = $('#dim_w5').val();
			var dimw6 = $('#dim_w6').val();
			var dimw7 = $('#dim_w7').val();
			var dimw8 = $('#dim_w8').val();
			var dimw9 = $('#dim_w9').val();
			var dimw10 = $('#dim_w10').val();
			var dimw11 = $('#dim_w11').val();
			var dimw12 = $('#dim_w12').val();
			var dimw13 = $('#dim_w13').val();
			var dimw14 = $('#dim_w14').val();
			var dimw15 = $('#dim_w15').val();
			var dimw16 = $('#dim_w16').val();
			var dimw17 = $('#dim_w17').val();
			var dimw18 = $('#dim_w18').val();
			var dimw19 = $('#dim_w19').val();
			var dimw20 = $('#dim_w20').val();
			var dimw21 = $('#dim_w21').val();
			var dimw22 = $('#dim_w22').val();
			var dimw23 = $('#dim_w23').val();
			var dimw24 = $('#dim_w24').val();

			var sum2 = ((+dimw1) + (+dimw2) + (+dimw3) + (+dimw4) + (+dimw5) + (+dimw6) + (+dimw7) + (+dimw8) + (+dimw9) + (+dimw10) + (+dimw11) + (+dimw12) + (+dimw13) + (+dimw14) + (+dimw15) + (+dimw16) + (+dimw17) + (+dimw18) + (+dimw19) + (+dimw20) + (+dimw21) + (+dimw22) + (+dimw23) + (+dimw24)) / 24;
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
				$('#dim_w7').val(null);
				$('#dim_w8').val(null);
				$('#dim_w9').val(null);
				$('#dim_w10').val(null);
				$('#dim_w11').val(null);
				$('#dim_w12').val(null);
				$('#dim_w13').val(null);
				$('#dim_w14').val(null);
				$('#dim_w15').val(null);
				$('#dim_w16').val(null);
				$('#dim_w17').val(null);
				$('#dim_w18').val(null);
				$('#dim_w19').val(null);
				$('#dim_w20').val(null);
				$('#dim_w21').val(null);
				$('#dim_w22').val(null);
				$('#dim_w23').val(null);
				$('#dim_w24').val(null);
				$('#dim_h1').val(null);
				$('#dim_h2').val(null);
				$('#dim_h3').val(null);
				$('#dim_h4').val(null);
				$('#dim_h5').val(null);
				$('#dim_h6').val(null);
				$('#dim_h7').val(null);
				$('#dim_h8').val(null);
				$('#dim_h9').val(null);
				$('#dim_h10').val(null);
				$('#dim_h11').val(null);
				$('#dim_h12').val(null);
				$('#dim_h13').val(null);
				$('#dim_h14').val(null);
				$('#dim_h15').val(null);
				$('#dim_h16').val(null);
				$('#dim_h17').val(null);
				$('#dim_h18').val(null);
				$('#dim_h19').val(null);
				$('#dim_h20').val(null);
				$('#dim_h21').val(null);
				$('#dim_h22').val(null);
				$('#dim_h23').val(null);
				$('#dim_h24').val(null);
				$('#dim_l1').val(null);
				$('#dim_l2').val(null);
				$('#dim_l3').val(null);
				$('#dim_l4').val(null);
				$('#dim_l5').val(null);
				$('#dim_l6').val(null);
				$('#dim_l7').val(null);
				$('#dim_l8').val(null);
				$('#dim_l9').val(null);
				$('#dim_l10').val(null);
				$('#dim_l11').val(null);
				$('#dim_l12').val(null);
				$('#dim_l13').val(null);
				$('#dim_l14').val(null);
				$('#dim_l15').val(null);
				$('#dim_l16').val(null);
				$('#dim_l17').val(null);
				$('#dim_l18').val(null);
				$('#dim_l19').val(null);
				$('#dim_l20').val(null);
				$('#dim_l21').val(null);
				$('#dim_l22').val(null);
				$('#dim_l23').val(null);
				$('#dim_l24').val(null);

			}
		});


		$('#dim_l1,#dim_l2,#dim_l3,#dim_l4,#dim_l5,#dim_l6,#dim_l7,#dim_l8,#dim_l9,#dim_l10,#dim_l11,#dim_l12,#dim_l13,#dim_l14,#dim_l15,#dim_l16,#dim_l17,#dim_l18,#dim_l19,#dim_l20,#dim_l21,#dim_l22,#dim_l23,#dim_l24').change(function() {
			$('#txtdim').css("background-color", "var(--success)");
			var diml1 = $('#dim_l1').val();
			var diml2 = $('#dim_l2').val();
			var diml3 = $('#dim_l3').val();
			var diml4 = $('#dim_l4').val();
			var diml5 = $('#dim_l5').val();
			var diml6 = $('#dim_l6').val();
			var diml7 = $('#dim_l7').val();
			var diml8 = $('#dim_l8').val();
			var diml9 = $('#dim_l9').val();
			var diml10 = $('#dim_l10').val();
			var diml11 = $('#dim_l11').val();
			var diml12 = $('#dim_l12').val();
			var diml13 = $('#dim_l13').val();
			var diml14 = $('#dim_l14').val();
			var diml15 = $('#dim_l15').val();
			var diml16 = $('#dim_l16').val();
			var diml17 = $('#dim_l17').val();
			var diml18 = $('#dim_l18').val();
			var diml19 = $('#dim_l19').val();
			var diml20 = $('#dim_l20').val();
			var diml21 = $('#dim_l21').val();
			var diml22 = $('#dim_l22').val();
			var diml23 = $('#dim_l23').val();
			var diml24 = $('#dim_l24').val();

			var sum = ((+diml1) + (+diml2) + (+diml3) + (+diml4) + (+diml5) + (+diml6) + (+diml7) + (+diml8) + (+diml9) + (+diml10) + (+diml11) + (+diml12) + (+diml13) + (+diml14) + (+diml15) + (+diml16) + (+diml17) + (+diml18) + (+diml19) + (+diml20) + (+diml21) + (+diml22) + (+diml23) + (+diml24)) / 24;
			$('#dim_length').val(sum.toFixed());

		});

		$('#dim_w1,#dim_w2,#dim_w3,#dim_w4,#dim_w5,#dim_w6,#dim_w7,#dim_w8,#dim_w9,#dim_w10,#dim_w11,#dim_w12,#dim_w13,#dim_w14,#dim_w15,#dim_w16,#dim_w17,#dim_w18,#dim_w19,#dim_w20,#dim_w21,#dim_w22,#dim_w23,#dim_w24').change(function() {
			$('#txtdim').css("background-color", "var(--success)");
			var dimw1 = $('#dim_w1').val();
			var dimw2 = $('#dim_w2').val();
			var dimw3 = $('#dim_w3').val();
			var dimw4 = $('#dim_w4').val();
			var dimw5 = $('#dim_w5').val();
			var dimw6 = $('#dim_w6').val();
			var dimw7 = $('#dim_w7').val();
			var dimw8 = $('#dim_w8').val();
			var dimw9 = $('#dim_w9').val();
			var dimw10 = $('#dim_w10').val();
			var dimw11 = $('#dim_w11').val();
			var dimw12 = $('#dim_w12').val();
			var dimw13 = $('#dim_w13').val();
			var dimw14 = $('#dim_w14').val();
			var dimw15 = $('#dim_w15').val();
			var dimw16 = $('#dim_w16').val();
			var dimw17 = $('#dim_w17').val();
			var dimw18 = $('#dim_w18').val();
			var dimw19 = $('#dim_w19').val();
			var dimw20 = $('#dim_w20').val();
			var dimw21 = $('#dim_w21').val();
			var dimw22 = $('#dim_w22').val();
			var dimw23 = $('#dim_w23').val();
			var dimw24 = $('#dim_w24').val();

			var sum2 = ((+dimw1) + (+dimw2) + (+dimw3) + (+dimw4) + (+dimw5) + (+dimw6) + (+dimw7) + (+dimw8) + (+dimw9) + (+dimw10) + (+dimw11) + (+dimw12) + (+dimw13) + (+dimw14) + (+dimw15) + (+dimw16) + (+dimw17) + (+dimw18) + (+dimw19) + (+dimw20) + (+dimw21) + (+dimw22) + (+dimw23) + (+dimw24)) / 24;
			$('#dim_width').val(sum2.toFixed());

		});

		$('#dim_h1,#dim_h2,#dim_h3,#dim_h4,#dim_h5,#dim_h6,#dim_h7,#dim_h8,#dim_h9,#dim_h10,#dim_h11,#dim_h12,#dim_h13,#dim_h14,#dim_h15,#dim_h16,#dim_h17,#dim_h18,#dim_h19,#dim_h20,#dim_h21,#dim_h22,#dim_h23,#dim_h24').change(function() {
			$('#txtdim').css("background-color", "var(--success)");
			var dimh1 = $('#dim_h1').val();
			var dimh2 = $('#dim_h2').val();
			var dimh3 = $('#dim_h3').val();
			var dimh4 = $('#dim_h4').val();
			var dimh5 = $('#dim_h5').val();
			var dimh6 = $('#dim_h6').val();
			var dimh7 = $('#dim_h7').val();
			var dimh8 = $('#dim_h8').val();
			var dimh9 = $('#dim_h9').val();
			var dimh10 = $('#dim_h10').val();
			var dimh12 = $('#dim_h12').val();
			var dimh11 = $('#dim_h11').val();
			var dimh13 = $('#dim_h13').val();
			var dimh14 = $('#dim_h14').val();
			var dimh15 = $('#dim_h15').val();
			var dimh16 = $('#dim_h16').val();
			var dimh17 = $('#dim_h17').val();
			var dimh18 = $('#dim_h18').val();
			var dimh19 = $('#dim_h19').val();
			var dimh20 = $('#dim_h20').val();
			var dimh21 = $('#dim_h21').val();
			var dimh22 = $('#dim_h22').val();
			var dimh23 = $('#dim_h23').val();
			var dimh24 = $('#dim_h24').val();

			var sum1 = ((+dimh1) + (+dimh2) + (+dimh3) + (+dimh4) + (+dimh5) + (+dimh6) + (+dimh7) + (+dimh8) + (+dimh9) + (+dimh10) + (+dimh11) + (+dimh12) + (+dimh13) + (+dimh14) + (+dimh15) + (+dimh16) + (+dimh17) + (+dimh18) + (+dimh19) + (+dimh20) + (+dimh21) + (+dimh22) + (+dimh23) + (+dimh24)) / 24;
			$('#dim_height').val(sum1.toFixed());

		});



		function com_auto() {
			$('#txtcom').css("background-color", "var(--success)");
			var sample_1 = "s1";
			var sample_2 = "s2";
			var sample_3 = "s3";
			var sample_4 = "s4";
			var sample_5 = "s5";
			var sample_6 = "s6";
			var sample_7 = "s7";
			var sample_8 = "s8";
			var sample_9 = "s9";
			var sample_10 = "s10";
			var sample_11 = "s11";
			var sample_12 = "s12";

			$('#sample_1').val(sample_1);
			$('#sample_2').val(sample_2);
			$('#sample_3').val(sample_3);
			$('#sample_4').val(sample_4);
			$('#sample_5').val(sample_5);
			$('#sample_6').val(sample_6);
			$('#sample_7').val(sample_7);
			$('#sample_8').val(sample_8);
			$('#sample_9').val(sample_9);
			$('#sample_10').val(sample_10);
			$('#sample_11').val(sample_11);
			$('#sample_12').val(sample_12);


			var mc_1 = randomNumberFromRange(9, 11).toFixed();
			var mc_2 = randomNumberFromRange(9, 11).toFixed();
			var mc_3 = randomNumberFromRange(9, 11).toFixed();
			var mc_4 = randomNumberFromRange(9, 11).toFixed();
			var mc_5 = randomNumberFromRange(9, 11).toFixed();
			var mc_6 = randomNumberFromRange(9, 11).toFixed();
			var mc_7 = randomNumberFromRange(9, 11).toFixed();
			var mc_8 = randomNumberFromRange(9, 11).toFixed();
			var mc_9 = randomNumberFromRange(9, 11).toFixed();
			var mc_10 = randomNumberFromRange(9, 11).toFixed();
			var mc_11 = randomNumberFromRange(9, 11).toFixed();
			var mc_12 = randomNumberFromRange(9, 11).toFixed();

			$('#mc_1').val(mc_1);
			$('#mc_2').val(mc_2);
			$('#mc_3').val(mc_3);
			$('#mc_4').val(mc_4);
			$('#mc_5').val(mc_5);
			$('#mc_6').val(mc_6);
			$('#mc_7').val(mc_7);
			$('#mc_8').val(mc_8);
			$('#mc_9').val(mc_9);
			$('#mc_10').val(mc_10);
			$('#mc_11').val(mc_11);
			$('#mc_12').val(mc_12);
			
			$('#w1_1').val(10);
			$('#w1_2').val(11);
			$('#w1_3').val(12);
			$('#w1_4').val(13);
			$('#w1_5').val(14);
			$('#w1_6').val(15);
			$('#w1_7').val(16);
			$('#w1_8').val(17);
			$('#w1_9').val(18);
			$('#w1_10').val(19);
			$('#w1_11').val(20);
			$('#w1_12').val(21);
			
			

			var a1 = $('#dim_height').val();
			var a2 = $('#dim_width').val();
			var a3 = $('#dim_length').val();
			var ans = Math.min(a1, a2, a3);



			if (ans < 150) {
				var l_1 = randomNumberFromRange(98, 102).toFixed();
				var l_2 = randomNumberFromRange(98, 102).toFixed();
				var l_3 = randomNumberFromRange(98, 102).toFixed();
				var l_4 = randomNumberFromRange(98, 102).toFixed();
				var l_5 = randomNumberFromRange(98, 102).toFixed();
				var l_6 = randomNumberFromRange(98, 102).toFixed();
				var l_7 = randomNumberFromRange(98, 102).toFixed();
				var l_8 = randomNumberFromRange(98, 102).toFixed();
				var l_9 = randomNumberFromRange(98, 102).toFixed();
				var l_10 = randomNumberFromRange(98, 102).toFixed();
				var l_11 = randomNumberFromRange(98, 102).toFixed();
				var l_12 = randomNumberFromRange(98, 102).toFixed();

				var w_1 = randomNumberFromRange(98, 102).toFixed();
				var w_2 = randomNumberFromRange(98, 102).toFixed();
				var w_3 = randomNumberFromRange(98, 102).toFixed();
				var w_4 = randomNumberFromRange(98, 102).toFixed();
				var w_5 = randomNumberFromRange(98, 102).toFixed();
				var w_6 = randomNumberFromRange(98, 102).toFixed();
				var w_7 = randomNumberFromRange(98, 102).toFixed();
				var w_8 = randomNumberFromRange(98, 102).toFixed();
				var w_9 = randomNumberFromRange(98, 102).toFixed();
				var w_10 = randomNumberFromRange(98, 102).toFixed();
				var w_11 = randomNumberFromRange(98, 102).toFixed();
				var w_12 = randomNumberFromRange(98, 102).toFixed();

				var h_1 = randomNumberFromRange(98, 102).toFixed();
				var h_2 = randomNumberFromRange(98, 102).toFixed();
				var h_3 = randomNumberFromRange(98, 102).toFixed();
				var h_4 = randomNumberFromRange(98, 102).toFixed();
				var h_5 = randomNumberFromRange(98, 102).toFixed();
				var h_6 = randomNumberFromRange(98, 102).toFixed();
				var h_7 = randomNumberFromRange(98, 102).toFixed();
				var h_8 = randomNumberFromRange(98, 102).toFixed();
				var h_9 = randomNumberFromRange(98, 102).toFixed();
				var h_10 = randomNumberFromRange(98, 102).toFixed();
				var h_11 = randomNumberFromRange(98, 102).toFixed();
				var h_12 = randomNumberFromRange(98, 102).toFixed();

			} else {
				var l_1 = randomNumberFromRange(148, 152).toFixed();
				var l_2 = randomNumberFromRange(148, 152).toFixed();
				var l_3 = randomNumberFromRange(148, 152).toFixed();
				var l_4 = randomNumberFromRange(148, 152).toFixed();
				var l_5 = randomNumberFromRange(148, 152).toFixed();
				var l_6 = randomNumberFromRange(148, 152).toFixed();
				var l_7 = randomNumberFromRange(148, 152).toFixed();
				var l_8 = randomNumberFromRange(148, 152).toFixed();
				var l_9 = randomNumberFromRange(148, 152).toFixed();
				var l_10 = randomNumberFromRange(148, 152).toFixed();
				var l_11 = randomNumberFromRange(148, 152).toFixed();
				var l_12 = randomNumberFromRange(148, 152).toFixed();


				var w_1 = randomNumberFromRange(148, 152).toFixed();
				var w_2 = randomNumberFromRange(148, 152).toFixed();
				var w_3 = randomNumberFromRange(148, 152).toFixed();
				var w_4 = randomNumberFromRange(148, 152).toFixed();
				var w_5 = randomNumberFromRange(148, 152).toFixed();
				var w_6 = randomNumberFromRange(148, 152).toFixed();
				var w_7 = randomNumberFromRange(148, 152).toFixed();
				var w_8 = randomNumberFromRange(148, 152).toFixed();
				var w_9 = randomNumberFromRange(148, 152).toFixed();
				var w_10 = randomNumberFromRange(148, 152).toFixed();
				var w_11 = randomNumberFromRange(148, 152).toFixed();
				var w_12 = randomNumberFromRange(148, 152).toFixed();


				var h_1 = randomNumberFromRange(148, 152).toFixed();
				var h_2 = randomNumberFromRange(148, 152).toFixed();
				var h_3 = randomNumberFromRange(148, 152).toFixed();
				var h_4 = randomNumberFromRange(148, 152).toFixed();
				var h_5 = randomNumberFromRange(148, 152).toFixed();
				var h_6 = randomNumberFromRange(148, 152).toFixed();
				var h_7 = randomNumberFromRange(148, 152).toFixed();
				var h_8 = randomNumberFromRange(148, 152).toFixed();
				var h_9 = randomNumberFromRange(148, 152).toFixed();
				var h_10 = randomNumberFromRange(148, 152).toFixed();
				var h_11 = randomNumberFromRange(148, 152).toFixed();
				var h_12 = randomNumberFromRange(148, 152).toFixed();

			}



			$('#l_1').val(l_1);
			$('#l_2').val(l_2);
			$('#l_3').val(l_3);
			$('#l_4').val(l_4);
			$('#l_5').val(l_5);
			$('#l_6').val(l_6);
			$('#l_7').val(l_7);
			$('#l_8').val(l_8);
			$('#l_9').val(l_9);
			$('#l_10').val(l_10);
			$('#l_11').val(l_11);
			$('#l_12').val(l_12);

			var l1 = $('#l_1').val();
			var l2 = $('#l_2').val();
			var l3 = $('#l_3').val();
			var l4 = $('#l_4').val();
			var l5 = $('#l_5').val();
			var l6 = $('#l_6').val();
			var l7 = $('#l_7').val();
			var l8 = $('#l_8').val();
			var l9 = $('#l_9').val();
			var l10 = $('#l_10').val();
			var l11 = $('#l_11').val();
			var l12 = $('#l_12').val();


			$('#w_1').val(w_1);
			$('#w_2').val(w_2);
			$('#w_3').val(w_3);
			$('#w_4').val(w_4);
			$('#w_5').val(w_5);
			$('#w_6').val(w_6);
			$('#w_7').val(w_7);
			$('#w_8').val(w_8);
			$('#w_9').val(w_9);
			$('#w_10').val(w_10);
			$('#w_11').val(w_11);
			$('#w_12').val(w_12);

			var w1 = $('#w_1').val();
			var w2 = $('#w_2').val();
			var w3 = $('#w_3').val();
			var w4 = $('#w_4').val();
			var w5 = $('#w_5').val();
			var w6 = $('#w_6').val();
			var w7 = $('#w_7').val();
			var w8 = $('#w_8').val();
			var w9 = $('#w_9').val();
			var w10 = $('#w_10').val();
			var w11 = $('#w_11').val();
			var w12 = $('#w_12').val();

			$('#h_1').val(h_1);
			$('#h_2').val(h_2);
			$('#h_3').val(h_3);
			$('#h_4').val(h_4);
			$('#h_5').val(h_5);
			$('#h_6').val(h_6);
			$('#h_7').val(h_7);
			$('#h_8').val(h_8);
			$('#h_9').val(h_9);
			$('#h_10').val(h_10);
			$('#h_11').val(h_11);
			$('#h_12').val(h_12);

			var h1 = $('#h_1').val();
			var h2 = $('#h_2').val();
			var h3 = $('#h_3').val();
			var h4 = $('#h_4').val();
			var h5 = $('#h_5').val();
			var h6 = $('#h_6').val();
			var h7 = $('#h_7').val();
			var h8 = $('#h_8').val();
			var h9 = $('#h_9').val();
			var h10 = $('#h_10').val();
			var h11 = $('#h_11').val();
			var h12 = $('#h_12').val();


			var area_1 = (+l1) * (+w1);
			var area_2 = (+l2) * (+w2);
			var area_3 = (+l3) * (+w3);
			var area_4 = (+l4) * (+w4);
			var area_5 = (+l5) * (+w5);
			var area_6 = (+l6) * (+w6);
			var area_7 = (+l7) * (+w7);
			var area_8 = (+l8) * (+w8);
			var area_9 = (+l9) * (+w9);
			var area_10 = (+l10) * (+w10);
			var area_11 = (+l11) * (+w11);
			var area_12 = (+l12) * (+w12);

			$('#area_1').val(area_1.toFixed());
			$('#area_2').val(area_2.toFixed());
			$('#area_3').val(area_3.toFixed());
			$('#area_4').val(area_4.toFixed());
			$('#area_5').val(area_5.toFixed());
			$('#area_6').val(area_6.toFixed());
			$('#area_7').val(area_7.toFixed());
			$('#area_8').val(area_8.toFixed());
			$('#area_9').val(area_9.toFixed());
			$('#area_10').val(area_10.toFixed());
			$('#area_11').val(area_11.toFixed());
			$('#area_12').val(area_12.toFixed());

			var area1 = $('#area_1').val();
			var area2 = $('#area_2').val();
			var area3 = $('#area_3').val();
			var area4 = $('#area_4').val();
			var area5 = $('#area_5').val();
			var area6 = $('#area_6').val();
			var area7 = $('#area_7').val();
			var area8 = $('#area_8').val();
			var area9 = $('#area_9').val();
			var area10 = $('#area_10').val();
			var area11 = $('#area_11').val();
			var area12 = $('#area_12').val();

			var grade = $('#in_grade').val();
			var in_den = $('#in_den').val();
			if (grade == "grade 1") {
				if (in_den == "451 to 550") {
					var avg_com = randomNumberFromRange(3.00, 3.50).toFixed(2);
				} else if (in_den == "551 to 650") {
					var avg_com = randomNumberFromRange(4.50, 4.80).toFixed(2);
				} else if (in_den == "651 to 750") {
					var avg_com = randomNumberFromRange(5.50, 5.80).toFixed(2);
				} else if (in_den == "751 to 850") {
					var avg_com = randomNumberFromRange(6.50, 6.80).toFixed(2);
				} else if (in_den == "851 to 1000") {
					var avg_com = randomNumberFromRange(7.50, 7.80).toFixed(2);
				}


			} else {
				if (in_den == "451 to 550") {
					var avg_com = randomNumberFromRange(2.50, 2.80).toFixed(2);
				} else if (in_den == "551 to 650") {
					var avg_com = randomNumberFromRange(3.50, 3.80).toFixed(2);
				} else if (in_den == "651 to 750") {
					var avg_com = randomNumberFromRange(4.50, 4.80).toFixed(2);
				} else if (in_den == "751 to 850") {
					var avg_com = randomNumberFromRange(5.50, 5.80).toFixed(2);
				} else if (in_den == "851 to 1000") {
					var avg_com = randomNumberFromRange(6.50, 6.80).toFixed(2);
				}
			}
			$('#avg_com').val(avg_com);

			var avgcom = $('#avg_com').val();
			var ss = randomNumberFromRange(1, 9).toFixed();
			if (ss % 2 == 0) {
				var com_1 = (+avgcom) + 0.01;
				var com_3 = (+avgcom) + 0.02;
				var com_5 = (+avgcom) + 0.03;
				var com_7 = (+avgcom) + 0.04;
				var com_9 = (+avgcom) + 0.03;
				var com_11 = (+avgcom) + 0.02;

				var com_2 = (+avgcom) - 0.01;
				var com_4 = (+avgcom) - 0.02;
				var com_6 = (+avgcom) - 0.03;
				var com_8 = (+avgcom) - 0.04;
				var com_10 = (+avgcom) - 0.03;
				var com_12 = (+avgcom) - 0.02;

			} else {
				var com_1 = (+avgcom) - 0.01;
				var com_3 = (+avgcom) - 0.02;
				var com_5 = (+avgcom) - 0.03;
				var com_7 = (+avgcom) - 0.04;
				var com_9 = (+avgcom) - 0.03;
				var com_11 = (+avgcom) - 0.02;

				var com_2 = (+avgcom) + 0.01;
				var com_4 = (+avgcom) + 0.02;
				var com_6 = (+avgcom) + 0.03;
				var com_8 = (+avgcom) + 0.04;
				var com_10 = (+avgcom) + 0.03;
				var com_12 = (+avgcom) + 0.02;

			}

			$('#com_1').val(com_1.toFixed(2));
			$('#com_2').val(com_2.toFixed(2));
			$('#com_3').val(com_3.toFixed(2));
			$('#com_4').val(com_4.toFixed(2));
			$('#com_5').val(com_5.toFixed(2));
			$('#com_6').val(com_6.toFixed(2));
			$('#com_7').val(com_7.toFixed(2));
			$('#com_8').val(com_8.toFixed(2));
			$('#com_9').val(com_9.toFixed(2));
			$('#com_10').val(com_10.toFixed(2));
			$('#com_11').val(com_11.toFixed(2));
			$('#com_12').val(com_12.toFixed(2));

			var com1 = $('#com_1').val();
			var com2 = $('#com_2').val();
			var com3 = $('#com_3').val();
			var com4 = $('#com_4').val();
			var com5 = $('#com_5').val();
			var com6 = $('#com_6').val();
			var com7 = $('#com_7').val();
			var com8 = $('#com_8').val();
			var com9 = $('#com_9').val();
			var com10 = $('#com_10').val();
			var com11 = $('#com_11').val();
			var com12 = $('#com_12').val();

			var load_1 = ((+area1) * (+com1)) / 1000;
			var load_2 = ((+area2) * (+com2)) / 1000;
			var load_3 = ((+area3) * (+com3)) / 1000;
			var load_4 = ((+area4) * (+com4)) / 1000;
			var load_5 = ((+area5) * (+com5)) / 1000;
			var load_6 = ((+area6) * (+com6)) / 1000;
			var load_7 = ((+area7) * (+com7)) / 1000;
			var load_8 = ((+area8) * (+com8)) / 1000;
			var load_9 = ((+area9) * (+com9)) / 1000;
			var load_10 = ((+area10) * (+com10)) / 1000;
			var load_11 = ((+area11) * (+com11)) / 1000;
			var load_12 = ((+area12) * (+com12)) / 1000;


			$('#load_1').val(load_1.toFixed(2));
			$('#load_2').val(load_2.toFixed(2));
			$('#load_3').val(load_3.toFixed(2));
			$('#load_4').val(load_4.toFixed(2));
			$('#load_5').val(load_5.toFixed(2));
			$('#load_6').val(load_6.toFixed(2));
			$('#load_7').val(load_7.toFixed(2));
			$('#load_8').val(load_8.toFixed(2));
			$('#load_9').val(load_9.toFixed(2));
			$('#load_10').val(load_10.toFixed(2));
			$('#load_11').val(load_11.toFixed(2));
			$('#load_12').val(load_12.toFixed(2));

			var load1 = $('#load_1').val();
			var load2 = $('#load_2').val();
			var load3 = $('#load_3').val();
			var load4 = $('#load_4').val();
			var load5 = $('#load_5').val();
			var load6 = $('#load_6').val();
			var load7 = $('#load_7').val();
			var load8 = $('#load_8').val();
			var load9 = $('#load_9').val();
			var load10 = $('#load_10').val();
			var load11 = $('#load_11').val();
			var load12 = $('#load_12').val();


			var co_m1 = ((+load1) / (+area1)) * 1000;
			var co_m2 = ((+load2) / (+area2)) * 1000;
			var co_m3 = ((+load3) / (+area3)) * 1000;
			var co_m4 = ((+load4) / (+area4)) * 1000;
			var co_m5 = ((+load5) / (+area5)) * 1000;
			var co_m6 = ((+load6) / (+area6)) * 1000;
			var co_m7 = ((+load7) / (+area7)) * 1000;
			var co_m8 = ((+load8) / (+area8)) * 1000;
			var co_m9 = ((+load9) / (+area9)) * 1000;
			var co_m10 = ((+load10) / (+area10)) * 1000;
			var co_m11 = ((+load11) / (+area11)) * 1000;
			var co_m12 = ((+load12) / (+area12)) * 1000;

			$('#com_1').val(co_m1.toFixed(2));
			$('#com_2').val(co_m2.toFixed(2));
			$('#com_3').val(co_m3.toFixed(2));
			$('#com_4').val(co_m4.toFixed(2));
			$('#com_5').val(co_m5.toFixed(2));
			$('#com_6').val(co_m6.toFixed(2));
			$('#com_7').val(co_m7.toFixed(2));
			$('#com_8').val(co_m8.toFixed(2));
			$('#com_9').val(co_m9.toFixed(2));
			$('#com_10').val(co_m10.toFixed(2));
			$('#com_11').val(co_m11.toFixed(2));
			$('#com_12').val(co_m12.toFixed(2));

			var c_om1 = $('#com_1').val();
			var c_om2 = $('#com_2').val();
			var c_om3 = $('#com_3').val();
			var c_om4 = $('#com_4').val();
			var c_om5 = $('#com_5').val();
			var c_om6 = $('#com_6').val();
			var c_om7 = $('#com_7').val();
			var c_om8 = $('#com_8').val();
			var c_om9 = $('#com_9').val();
			var c_om10 = $('#com_10').val();
			var c_om11 = $('#com_11').val();
			var c_om12 = $('#com_12').val();

			var anss = ((+c_om1) + (+c_om2) + (+c_om3) + (+c_om4) + (+c_om5) + (+c_om6) + (+c_om7) + (+c_om8) + (+c_om9) + (+c_om10) + (+c_om11) + (+c_om12)) / 12;
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
				$('#com_4').val(null);
				$('#com_5').val(null);
				$('#com_6').val(null);
				$('#com_7').val(null);
				$('#com_8').val(null);
				$('#com_9').val(null);
				$('#com_10').val(null);
				$('#com_11').val(null);
				$('#com_12').val(null);
				$('#area_1').val(null);
				$('#area_2').val(null);
				$('#area_3').val(null);
				$('#area_4').val(null);
				$('#area_5').val(null);
				$('#area_6').val(null);
				$('#area_7').val(null);
				$('#area_8').val(null);
				$('#area_9').val(null);
				$('#area_10').val(null);
				$('#area_11').val(null);
				$('#area_12').val(null);
				$('#load_1').val(null);
				$('#load_2').val(null);
				$('#load_3').val(null);
				$('#load_4').val(null);
				$('#load_5').val(null);
				$('#load_6').val(null);
				$('#load_7').val(null);
				$('#load_8').val(null);
				$('#load_9').val(null);
				$('#load_10').val(null);
				$('#load_11').val(null);
				$('#load_12').val(null);
				$('#mc_1').val(null);
				$('#mc_2').val(null);
				$('#mc_3').val(null);
				$('#mc_4').val(null);
				$('#mc_5').val(null);
				$('#mc_6').val(null);
				$('#mc_7').val(null);
				$('#mc_8').val(null);
				$('#mc_9').val(null);
				$('#mc_10').val(null);
				$('#mc_11').val(null);
				$('#mc_12').val(null);
				$('#w1_1').val(null);
				$('#w1_2').val(null);
				$('#w1_3').val(null);
				$('#w1_4').val(null);
				$('#w1_5').val(null);
				$('#w1_6').val(null);
				$('#w1_7').val(null);
				$('#w1_8').val(null);
				$('#w1_9').val(null);
				$('#w1_10').val(null);
				$('#w1_11').val(null);
				$('#w1_12').val(null);
				$('#h_1').val(null);
				$('#h_2').val(null);
				$('#h_3').val(null);
				$('#h_4').val(null);
				$('#h_5').val(null);
				$('#h_6').val(null);
				$('#h_7').val(null);
				$('#h_8').val(null);
				$('#h_9').val(null);
				$('#h_10').val(null);
				$('#h_11').val(null);
				$('#h_12').val(null);
				$('#w_1').val(null);
				$('#w_2').val(null);
				$('#w_3').val(null);
				$('#w_4').val(null);
				$('#w_5').val(null);
				$('#w_6').val(null);
				$('#w_7').val(null);
				$('#w_8').val(null);
				$('#w_9').val(null);
				$('#w_10').val(null);
				$('#w_11').val(null);
				$('#w_12').val(null);
				$('#l_1').val(null);
				$('#l_2').val(null);
				$('#l_3').val(null);
				$('#l_4').val(null);
				$('#l_5').val(null);
				$('#l_6').val(null);
				$('#l_7').val(null);
				$('#l_8').val(null);
				$('#l_9').val(null);
				$('#l_10').val(null);
				$('#l_11').val(null);
				$('#l_12').val(null);
				$('#sample_1').val(null);
				$('#sample_2').val(null);
				$('#sample_3').val(null);
				$('#sample_4').val(null);
				$('#sample_5').val(null);
				$('#sample_6').val(null);
				$('#sample_7').val(null);
				$('#sample_8').val(null);
				$('#sample_9').val(null);
				$('#sample_10').val(null);
				$('#sample_11').val(null);
				$('#sample_12').val(null);
				$('#mc_1').val(null);
				$('#mc_2').val(null);
				$('#mc_3').val(null);



			}
		});

		$('#l_1,#l_2,#l_3,#l_4,#l_5,#l_6,#l_7,#l_8,#l_9,#l_10,#l_11,#l_12,#h_1,#h_2,#h_3,#h_4,#h_5,#h_6,#h_7,#h_8,#h_9,#h_10,#h_11,#h_12,#w_1,#w_2,#w_3,#w_4,#w_5,#w_6,#w_7,#w_8,#w_9,#w_10,#w_11,#w_12,#load_1,#load_2,#load_3,#load_4,#load_5,#load_6,#load_7,#load_8,#load_9,#load_10,#load_11,#load_12').change(function() {
			$('#txtcom').css("background-color", "var(--success)");
			var l1 = $('#l_1').val();
			var l2 = $('#l_2').val();
			var l3 = $('#l_3').val();
			var l4 = $('#l_4').val();
			var l5 = $('#l_5').val();
			var l6 = $('#l_6').val();
			var l7 = $('#l_7').val();
			var l8 = $('#l_8').val();
			var l9 = $('#l_9').val();
			var l10 = $('#l_10').val();
			var l11 = $('#l_11').val();
			var l12 = $('#l_12').val();


			var w1 = $('#w_1').val();
			var w2 = $('#w_2').val();
			var w3 = $('#w_3').val();
			var w4 = $('#w_4').val();
			var w5 = $('#w_5').val();
			var w6 = $('#w_6').val();
			var w7 = $('#w_7').val();
			var w8 = $('#w_8').val();
			var w9 = $('#w_9').val();
			var w10 = $('#w_10').val();
			var w11 = $('#w_11').val();
			var w12 = $('#w_12').val();

			var h1 = $('#h_1').val();
			var h2 = $('#h_2').val();
			var h3 = $('#h_3').val();
			var h4 = $('#h_4').val();
			var h5 = $('#h_5').val();
			var h6 = $('#h_6').val();
			var h7 = $('#h_7').val();
			var h8 = $('#h_8').val();
			var h9 = $('#h_9').val();
			var h10 = $('#h_10').val();
			var h11 = $('#h_11').val();
			var h12 = $('#h_12').val();

			var load1 = $('#load_1').val();
			var load2 = $('#load_2').val();
			var load3 = $('#load_3').val();
			var load4 = $('#load_4').val();
			var load5 = $('#load_5').val();
			var load6 = $('#load_6').val();
			var load7 = $('#load_7').val();
			var load8 = $('#load_8').val();
			var load9 = $('#load_9').val();
			var load10 = $('#load_10').val();
			var load11 = $('#load_11').val();
			var load12 = $('#load_12').val();

			var area_1 = (+l1) * (+w1);
			var area_2 = (+l2) * (+w2);
			var area_3 = (+l3) * (+w3);
			var area_4 = (+l4) * (+w4);
			var area_5 = (+l5) * (+w5);
			var area_6 = (+l6) * (+w6);
			var area_7 = (+l7) * (+w7);
			var area_8 = (+l8) * (+w8);
			var area_9 = (+l9) * (+w9);
			var area_10 = (+l10) * (+w10);
			var area_11 = (+l11) * (+w11);
			var area_12 = (+l12) * (+w12);

			$('#area_1').val(area_1.toFixed());
			$('#area_2').val(area_2.toFixed());
			$('#area_3').val(area_3.toFixed());
			$('#area_4').val(area_4.toFixed());
			$('#area_5').val(area_5.toFixed());
			$('#area_6').val(area_6.toFixed());
			$('#area_7').val(area_7.toFixed());
			$('#area_8').val(area_8.toFixed());
			$('#area_9').val(area_9.toFixed());
			$('#area_10').val(area_10.toFixed());
			$('#area_11').val(area_11.toFixed());
			$('#area_12').val(area_12.toFixed());

			var area1 = $('#area_1').val();
			var area2 = $('#area_2').val();
			var area3 = $('#area_3').val();
			var area4 = $('#area_4').val();
			var area5 = $('#area_5').val();
			var area6 = $('#area_6').val();
			var area7 = $('#area_7').val();
			var area8 = $('#area_8').val();
			var area9 = $('#area_9').val();
			var area10 = $('#area_10').val();
			var area11 = $('#area_11').val();
			var area12 = $('#area_12').val();

			var co_m1 = ((+load1) / (+area1)) * 1000;
			var co_m2 = ((+load2) / (+area2)) * 1000;
			var co_m3 = ((+load3) / (+area3)) * 1000;
			var co_m4 = ((+load4) / (+area4)) * 1000;
			var co_m5 = ((+load5) / (+area5)) * 1000;
			var co_m6 = ((+load6) / (+area6)) * 1000;
			var co_m7 = ((+load7) / (+area7)) * 1000;
			var co_m8 = ((+load8) / (+area8)) * 1000;
			var co_m9 = ((+load9) / (+area9)) * 1000;
			var co_m10 = ((+load10) / (+area10)) * 1000;
			var co_m11 = ((+load11) / (+area11)) * 1000;
			var co_m12 = ((+load12) / (+area12)) * 1000;

			$('#com_1').val(co_m1.toFixed(2));
			$('#com_2').val(co_m2.toFixed(2));
			$('#com_3').val(co_m3.toFixed(2));
			$('#com_4').val(co_m4.toFixed(2));
			$('#com_5').val(co_m5.toFixed(2));
			$('#com_6').val(co_m6.toFixed(2));
			$('#com_7').val(co_m7.toFixed(2));
			$('#com_8').val(co_m8.toFixed(2));
			$('#com_9').val(co_m9.toFixed(2));
			$('#com_10').val(co_m10.toFixed(2));
			$('#com_11').val(co_m11.toFixed(2));
			$('#com_12').val(co_m12.toFixed(2));

			var c_om1 = $('#com_1').val();
			var c_om2 = $('#com_2').val();
			var c_om3 = $('#com_3').val();
			var c_om4 = $('#com_4').val();
			var c_om5 = $('#com_5').val();
			var c_om6 = $('#com_6').val();
			var c_om7 = $('#com_7').val();
			var c_om8 = $('#com_8').val();
			var c_om9 = $('#com_9').val();
			var c_om10 = $('#com_10').val();
			var c_om11 = $('#com_11').val();
			var c_om12 = $('#com_12').val();

			var anss = ((+c_om1) + (+c_om2) + (+c_om3) + (+c_om4) + (+c_om5) + (+c_om6) + (+c_om7) + (+c_om8) + (+c_om9) + (+c_om10) + (+c_om11) + (+c_om12)) / 12;
			$('#avg_com').val(anss.toFixed(2));




		});

		$('#com_1,#com_2,#com_3,#com_4,#com_5,#com_6,#com_7,#com_8,#com_9,#com_10,#com_11,#com_12').change(function() {
			$('#txtcom').css("background-color", "var(--success)");

			var c_om1 = $('#com_1').val();
			var c_om2 = $('#com_2').val();
			var c_om3 = $('#com_3').val();
			var c_om4 = $('#com_4').val();
			var c_om5 = $('#com_5').val();
			var c_om6 = $('#com_6').val();
			var c_om7 = $('#com_7').val();
			var c_om8 = $('#com_8').val();
			var c_om9 = $('#com_9').val();
			var c_om10 = $('#com_10').val();
			var c_om11 = $('#com_11').val();
			var c_om12 = $('#com_12').val();

			var anss = ((+c_om1) + (+c_om2) + (+c_om3) + (+c_om4) + (+c_om5) + (+c_om6) + (+c_om7) + (+c_om8) + (+c_om9) + (+c_om10) + (+c_om11) + (+c_om12)) / 12;
			$('#avg_com').val(anss.toFixed(2));

			var com1 = $('#com_1').val();
			var com2 = $('#com_2').val();
			var com3 = $('#com_3').val();
			var com4 = $('#com_4').val();
			var com5 = $('#com_5').val();
			var com6 = $('#com_6').val();
			var com7 = $('#com_7').val();
			var com8 = $('#com_8').val();
			var com9 = $('#com_9').val();
			var com10 = $('#com_10').val();
			var com11 = $('#com_11').val();
			var com12 = $('#com_12').val();

			var area1 = $('#area_1').val();
			var area2 = $('#area_2').val();
			var area3 = $('#area_3').val();
			var area4 = $('#area_4').val();
			var area5 = $('#area_5').val();
			var area6 = $('#area_6').val();
			var area7 = $('#area_7').val();
			var area8 = $('#area_8').val();
			var area9 = $('#area_9').val();
			var area10 = $('#area_10').val();
			var area11 = $('#area_11').val();
			var area12 = $('#area_12').val();

			var load_1 = ((+area1) * (+com1)) / 1000;
			var load_2 = ((+area2) * (+com2)) / 1000;
			var load_3 = ((+area3) * (+com3)) / 1000;
			var load_4 = ((+area4) * (+com4)) / 1000;
			var load_5 = ((+area5) * (+com5)) / 1000;
			var load_6 = ((+area6) * (+com6)) / 1000;
			var load_7 = ((+area7) * (+com7)) / 1000;
			var load_8 = ((+area8) * (+com8)) / 1000;
			var load_9 = ((+area9) * (+com9)) / 1000;
			var load_10 = ((+area10) * (+com10)) / 1000;
			var load_11 = ((+area11) * (+com11)) / 1000;
			var load_12 = ((+area12) * (+com12)) / 1000;


			$('#load_1').val(load_1.toFixed(2));
			$('#load_2').val(load_2.toFixed(2));
			$('#load_3').val(load_3.toFixed(2));
			$('#load_4').val(load_4.toFixed(2));
			$('#load_5').val(load_5.toFixed(2));
			$('#load_6').val(load_6.toFixed(2));
			$('#load_7').val(load_7.toFixed(2));
			$('#load_8').val(load_8.toFixed(2));
			$('#load_9').val(load_9.toFixed(2));
			$('#load_10').val(load_10.toFixed(2));
			$('#load_11').val(load_11.toFixed(2));
			$('#load_12').val(load_12.toFixed(2));








		});

		$("#avg_com").change(function() {
			$('#txtcom').css("background-color", "var(--success)");
			if ($("#chk_com").is(':checked')) {

				var sample_1 = "s1";
				var sample_2 = "s2";
				var sample_3 = "s3";
				var sample_4 = "s4";
				var sample_5 = "s5";
				var sample_6 = "s6";
				var sample_7 = "s7";
				var sample_8 = "s8";
				var sample_9 = "s9";
				var sample_10 = "s10";
				var sample_11 = "s11";
				var sample_12 = "s12";

				$('#sample_1').val(sample_1);
				$('#sample_2').val(sample_2);
				$('#sample_3').val(sample_3);
				$('#sample_4').val(sample_4);
				$('#sample_5').val(sample_5);
				$('#sample_6').val(sample_6);
				$('#sample_7').val(sample_7);
				$('#sample_8').val(sample_8);
				$('#sample_9').val(sample_9);
				$('#sample_10').val(sample_10);
				$('#sample_11').val(sample_11);
				$('#sample_12').val(sample_12);


				var mc_1 = randomNumberFromRange(9, 11).toFixed();
				var mc_2 = randomNumberFromRange(9, 11).toFixed();
				var mc_3 = randomNumberFromRange(9, 11).toFixed();
				var mc_4 = randomNumberFromRange(9, 11).toFixed();
				var mc_5 = randomNumberFromRange(9, 11).toFixed();
				var mc_6 = randomNumberFromRange(9, 11).toFixed();
				var mc_7 = randomNumberFromRange(9, 11).toFixed();
				var mc_8 = randomNumberFromRange(9, 11).toFixed();
				var mc_9 = randomNumberFromRange(9, 11).toFixed();
				var mc_10 = randomNumberFromRange(9, 11).toFixed();
				var mc_11 = randomNumberFromRange(9, 11).toFixed();
				var mc_12 = randomNumberFromRange(9, 11).toFixed();

				$('#mc_1').val(mc_1);
				$('#mc_2').val(mc_2);
				$('#mc_3').val(mc_3);
				$('#mc_4').val(mc_4);
				$('#mc_5').val(mc_5);
				$('#mc_6').val(mc_6);
				$('#mc_7').val(mc_7);
				$('#mc_8').val(mc_8);
				$('#mc_9').val(mc_9);
				$('#mc_10').val(mc_10);
				$('#mc_11').val(mc_11);
				$('#mc_12').val(mc_12);

				var a1 = $('#dim_height').val();
				var a2 = $('#dim_width').val();
				var a3 = $('#dim_length').val();
				var ans = Math.min(a1, a2, a3);



				if (ans < 150) {
					var l_1 = randomNumberFromRange(98, 102).toFixed();
					var l_2 = randomNumberFromRange(98, 102).toFixed();
					var l_3 = randomNumberFromRange(98, 102).toFixed();
					var l_4 = randomNumberFromRange(98, 102).toFixed();
					var l_5 = randomNumberFromRange(98, 102).toFixed();
					var l_6 = randomNumberFromRange(98, 102).toFixed();
					var l_7 = randomNumberFromRange(98, 102).toFixed();
					var l_8 = randomNumberFromRange(98, 102).toFixed();
					var l_9 = randomNumberFromRange(98, 102).toFixed();
					var l_10 = randomNumberFromRange(98, 102).toFixed();
					var l_11 = randomNumberFromRange(98, 102).toFixed();
					var l_12 = randomNumberFromRange(98, 102).toFixed();

					var w_1 = randomNumberFromRange(98, 102).toFixed();
					var w_2 = randomNumberFromRange(98, 102).toFixed();
					var w_3 = randomNumberFromRange(98, 102).toFixed();
					var w_4 = randomNumberFromRange(98, 102).toFixed();
					var w_5 = randomNumberFromRange(98, 102).toFixed();
					var w_6 = randomNumberFromRange(98, 102).toFixed();
					var w_7 = randomNumberFromRange(98, 102).toFixed();
					var w_8 = randomNumberFromRange(98, 102).toFixed();
					var w_9 = randomNumberFromRange(98, 102).toFixed();
					var w_10 = randomNumberFromRange(98, 102).toFixed();
					var w_11 = randomNumberFromRange(98, 102).toFixed();
					var w_12 = randomNumberFromRange(98, 102).toFixed();

					var h_1 = randomNumberFromRange(98, 102).toFixed();
					var h_2 = randomNumberFromRange(98, 102).toFixed();
					var h_3 = randomNumberFromRange(98, 102).toFixed();
					var h_4 = randomNumberFromRange(98, 102).toFixed();
					var h_5 = randomNumberFromRange(98, 102).toFixed();
					var h_6 = randomNumberFromRange(98, 102).toFixed();
					var h_7 = randomNumberFromRange(98, 102).toFixed();
					var h_8 = randomNumberFromRange(98, 102).toFixed();
					var h_9 = randomNumberFromRange(98, 102).toFixed();
					var h_10 = randomNumberFromRange(98, 102).toFixed();
					var h_11 = randomNumberFromRange(98, 102).toFixed();
					var h_12 = randomNumberFromRange(98, 102).toFixed();

				} else {
					var l_1 = randomNumberFromRange(148, 152).toFixed();
					var l_2 = randomNumberFromRange(148, 152).toFixed();
					var l_3 = randomNumberFromRange(148, 152).toFixed();
					var l_4 = randomNumberFromRange(148, 152).toFixed();
					var l_5 = randomNumberFromRange(148, 152).toFixed();
					var l_6 = randomNumberFromRange(148, 152).toFixed();
					var l_7 = randomNumberFromRange(148, 152).toFixed();
					var l_8 = randomNumberFromRange(148, 152).toFixed();
					var l_9 = randomNumberFromRange(148, 152).toFixed();
					var l_10 = randomNumberFromRange(148, 152).toFixed();
					var l_11 = randomNumberFromRange(148, 152).toFixed();
					var l_12 = randomNumberFromRange(148, 152).toFixed();


					var w_1 = randomNumberFromRange(148, 152).toFixed();
					var w_2 = randomNumberFromRange(148, 152).toFixed();
					var w_3 = randomNumberFromRange(148, 152).toFixed();
					var w_4 = randomNumberFromRange(148, 152).toFixed();
					var w_5 = randomNumberFromRange(148, 152).toFixed();
					var w_6 = randomNumberFromRange(148, 152).toFixed();
					var w_7 = randomNumberFromRange(148, 152).toFixed();
					var w_8 = randomNumberFromRange(148, 152).toFixed();
					var w_9 = randomNumberFromRange(148, 152).toFixed();
					var w_10 = randomNumberFromRange(148, 152).toFixed();
					var w_11 = randomNumberFromRange(148, 152).toFixed();
					var w_12 = randomNumberFromRange(148, 152).toFixed();


					var h_1 = randomNumberFromRange(148, 152).toFixed();
					var h_2 = randomNumberFromRange(148, 152).toFixed();
					var h_3 = randomNumberFromRange(148, 152).toFixed();
					var h_4 = randomNumberFromRange(148, 152).toFixed();
					var h_5 = randomNumberFromRange(148, 152).toFixed();
					var h_6 = randomNumberFromRange(148, 152).toFixed();
					var h_7 = randomNumberFromRange(148, 152).toFixed();
					var h_8 = randomNumberFromRange(148, 152).toFixed();
					var h_9 = randomNumberFromRange(148, 152).toFixed();
					var h_10 = randomNumberFromRange(148, 152).toFixed();
					var h_11 = randomNumberFromRange(148, 152).toFixed();
					var h_12 = randomNumberFromRange(148, 152).toFixed();

				}



				$('#l_1').val(l_1);
				$('#l_2').val(l_2);
				$('#l_3').val(l_3);
				$('#l_4').val(l_4);
				$('#l_5').val(l_5);
				$('#l_6').val(l_6);
				$('#l_7').val(l_7);
				$('#l_8').val(l_8);
				$('#l_9').val(l_9);
				$('#l_10').val(l_10);
				$('#l_11').val(l_11);
				$('#l_12').val(l_12);

				var l1 = $('#l_1').val();
				var l2 = $('#l_2').val();
				var l3 = $('#l_3').val();
				var l4 = $('#l_4').val();
				var l5 = $('#l_5').val();
				var l6 = $('#l_6').val();
				var l7 = $('#l_7').val();
				var l8 = $('#l_8').val();
				var l9 = $('#l_9').val();
				var l10 = $('#l_10').val();
				var l11 = $('#l_11').val();
				var l12 = $('#l_12').val();


				$('#w_1').val(w_1);
				$('#w_2').val(w_2);
				$('#w_3').val(w_3);
				$('#w_4').val(w_4);
				$('#w_5').val(w_5);
				$('#w_6').val(w_6);
				$('#w_7').val(w_7);
				$('#w_8').val(w_8);
				$('#w_9').val(w_9);
				$('#w_10').val(w_10);
				$('#w_11').val(w_11);
				$('#w_12').val(w_12);

				var w1 = $('#w_1').val();
				var w2 = $('#w_2').val();
				var w3 = $('#w_3').val();
				var w4 = $('#w_4').val();
				var w5 = $('#w_5').val();
				var w6 = $('#w_6').val();
				var w7 = $('#w_7').val();
				var w8 = $('#w_8').val();
				var w9 = $('#w_9').val();
				var w10 = $('#w_10').val();
				var w11 = $('#w_11').val();
				var w12 = $('#w_12').val();

				$('#h_1').val(h_1);
				$('#h_2').val(h_2);
				$('#h_3').val(h_3);
				$('#h_4').val(h_4);
				$('#h_5').val(h_5);
				$('#h_6').val(h_6);
				$('#h_7').val(h_7);
				$('#h_8').val(h_8);
				$('#h_9').val(h_9);
				$('#h_10').val(h_10);
				$('#h_11').val(h_11);
				$('#h_12').val(h_12);

				var h1 = $('#h_1').val();
				var h2 = $('#h_2').val();
				var h3 = $('#h_3').val();
				var h4 = $('#h_4').val();
				var h5 = $('#h_5').val();
				var h6 = $('#h_6').val();
				var h7 = $('#h_7').val();
				var h8 = $('#h_8').val();
				var h9 = $('#h_9').val();
				var h10 = $('#h_10').val();
				var h11 = $('#h_11').val();
				var h12 = $('#h_12').val();


				var area_1 = (+l1) * (+w1);
				var area_2 = (+l2) * (+w2);
				var area_3 = (+l3) * (+w3);
				var area_4 = (+l4) * (+w4);
				var area_5 = (+l5) * (+w5);
				var area_6 = (+l6) * (+w6);
				var area_7 = (+l7) * (+w7);
				var area_8 = (+l8) * (+w8);
				var area_9 = (+l9) * (+w9);
				var area_10 = (+l10) * (+w10);
				var area_11 = (+l11) * (+w11);
				var area_12 = (+l12) * (+w12);

				$('#area_1').val(area_1.toFixed());
				$('#area_2').val(area_2.toFixed());
				$('#area_3').val(area_3.toFixed());
				$('#area_4').val(area_4.toFixed());
				$('#area_5').val(area_5.toFixed());
				$('#area_6').val(area_6.toFixed());
				$('#area_7').val(area_7.toFixed());
				$('#area_8').val(area_8.toFixed());
				$('#area_9').val(area_9.toFixed());
				$('#area_10').val(area_10.toFixed());
				$('#area_11').val(area_11.toFixed());
				$('#area_12').val(area_12.toFixed());

				var area1 = $('#area_1').val();
				var area2 = $('#area_2').val();
				var area3 = $('#area_3').val();
				var area4 = $('#area_4').val();
				var area5 = $('#area_5').val();
				var area6 = $('#area_6').val();
				var area7 = $('#area_7').val();
				var area8 = $('#area_8').val();
				var area9 = $('#area_9').val();
				var area10 = $('#area_10').val();
				var area11 = $('#area_11').val();
				var area12 = $('#area_12').val();


				var avgcom = $('#avg_com').val();
				var ss = randomNumberFromRange(1, 9).toFixed();
				if (ss % 2 == 0) {
					var com_1 = (+avgcom) + 0.01;
					var com_3 = (+avgcom) + 0.02;
					var com_5 = (+avgcom) + 0.03;
					var com_7 = (+avgcom) + 0.04;
					var com_9 = (+avgcom) + 0.03;
					var com_11 = (+avgcom) + 0.02;

					var com_2 = (+avgcom) - 0.01;
					var com_4 = (+avgcom) - 0.02;
					var com_6 = (+avgcom) - 0.03;
					var com_8 = (+avgcom) - 0.04;
					var com_10 = (+avgcom) - 0.03;
					var com_12 = (+avgcom) - 0.02;

				} else {
					var com_1 = (+avgcom) - 0.01;
					var com_3 = (+avgcom) - 0.02;
					var com_5 = (+avgcom) - 0.03;
					var com_7 = (+avgcom) - 0.04;
					var com_9 = (+avgcom) - 0.03;
					var com_11 = (+avgcom) - 0.02;

					var com_2 = (+avgcom) + 0.01;
					var com_4 = (+avgcom) + 0.02;
					var com_6 = (+avgcom) + 0.03;
					var com_8 = (+avgcom) + 0.04;
					var com_10 = (+avgcom) + 0.03;
					var com_12 = (+avgcom) + 0.02;

				}

				$('#com_1').val(com_1.toFixed(2));
				$('#com_2').val(com_2.toFixed(2));
				$('#com_3').val(com_3.toFixed(2));
				$('#com_4').val(com_4.toFixed(2));
				$('#com_5').val(com_5.toFixed(2));
				$('#com_6').val(com_6.toFixed(2));
				$('#com_7').val(com_7.toFixed(2));
				$('#com_8').val(com_8.toFixed(2));
				$('#com_9').val(com_9.toFixed(2));
				$('#com_10').val(com_10.toFixed(2));
				$('#com_11').val(com_11.toFixed(2));
				$('#com_12').val(com_12.toFixed(2));

				var com1 = $('#com_1').val();
				var com2 = $('#com_2').val();
				var com3 = $('#com_3').val();
				var com4 = $('#com_4').val();
				var com5 = $('#com_5').val();
				var com6 = $('#com_6').val();
				var com7 = $('#com_7').val();
				var com8 = $('#com_8').val();
				var com9 = $('#com_9').val();
				var com10 = $('#com_10').val();
				var com11 = $('#com_11').val();
				var com12 = $('#com_12').val();

				var load_1 = ((+area1) * (+com1)) / 1000;
				var load_2 = ((+area2) * (+com2)) / 1000;
				var load_3 = ((+area3) * (+com3)) / 1000;
				var load_4 = ((+area4) * (+com4)) / 1000;
				var load_5 = ((+area5) * (+com5)) / 1000;
				var load_6 = ((+area6) * (+com6)) / 1000;
				var load_7 = ((+area7) * (+com7)) / 1000;
				var load_8 = ((+area8) * (+com8)) / 1000;
				var load_9 = ((+area9) * (+com9)) / 1000;
				var load_10 = ((+area10) * (+com10)) / 1000;
				var load_11 = ((+area11) * (+com11)) / 1000;
				var load_12 = ((+area12) * (+com12)) / 1000;


				$('#load_1').val(load_1.toFixed(2));
				$('#load_2').val(load_2.toFixed(2));
				$('#load_3').val(load_3.toFixed(2));
				$('#load_4').val(load_4.toFixed(2));
				$('#load_5').val(load_5.toFixed(2));
				$('#load_6').val(load_6.toFixed(2));
				$('#load_7').val(load_7.toFixed(2));
				$('#load_8').val(load_8.toFixed(2));
				$('#load_9').val(load_9.toFixed(2));
				$('#load_10').val(load_10.toFixed(2));
				$('#load_11').val(load_11.toFixed(2));
				$('#load_12').val(load_12.toFixed(2));

				var load1 = $('#load_1').val();
				var load2 = $('#load_2').val();
				var load3 = $('#load_3').val();
				var load4 = $('#load_4').val();
				var load5 = $('#load_5').val();
				var load6 = $('#load_6').val();
				var load7 = $('#load_7').val();
				var load8 = $('#load_8').val();
				var load9 = $('#load_9').val();
				var load10 = $('#load_10').val();
				var load11 = $('#load_11').val();
				var load12 = $('#load_12').val();


				var co_m1 = ((+load1) / (+area1)) * 1000;
				var co_m2 = ((+load2) / (+area2)) * 1000;
				var co_m3 = ((+load3) / (+area3)) * 1000;
				var co_m4 = ((+load4) / (+area4)) * 1000;
				var co_m5 = ((+load5) / (+area5)) * 1000;
				var co_m6 = ((+load6) / (+area6)) * 1000;
				var co_m7 = ((+load7) / (+area7)) * 1000;
				var co_m8 = ((+load8) / (+area8)) * 1000;
				var co_m9 = ((+load9) / (+area9)) * 1000;
				var co_m10 = ((+load10) / (+area10)) * 1000;
				var co_m11 = ((+load11) / (+area11)) * 1000;
				var co_m12 = ((+load12) / (+area12)) * 1000;

				$('#com_1').val(co_m1.toFixed(2));
				$('#com_2').val(co_m2.toFixed(2));
				$('#com_3').val(co_m3.toFixed(2));
				$('#com_4').val(co_m4.toFixed(2));
				$('#com_5').val(co_m5.toFixed(2));
				$('#com_6').val(co_m6.toFixed(2));
				$('#com_7').val(co_m7.toFixed(2));
				$('#com_8').val(co_m8.toFixed(2));
				$('#com_9').val(co_m9.toFixed(2));
				$('#com_10').val(co_m10.toFixed(2));
				$('#com_11').val(co_m11.toFixed(2));
				$('#com_12').val(co_m12.toFixed(2));

				var c_om1 = $('#com_1').val();
				var c_om2 = $('#com_2').val();
				var c_om3 = $('#com_3').val();
				var c_om4 = $('#com_4').val();
				var c_om5 = $('#com_5').val();
				var c_om6 = $('#com_6').val();
				var c_om7 = $('#com_7').val();
				var c_om8 = $('#com_8').val();
				var c_om9 = $('#com_9').val();
				var c_om10 = $('#com_10').val();
				var c_om11 = $('#com_11').val();
				var c_om12 = $('#com_12').val();

				var anss = ((+c_om1) + (+c_om2) + (+c_om3) + (+c_om4) + (+c_om5) + (+c_om6) + (+c_om7) + (+c_om8) + (+c_om9) + (+c_om10) + (+c_om11) + (+c_om12)) / 12;
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

			if (in_den1 == "451 to 550") {
				var bdl = randomNumberFromRange(0.4600, 0.4900).toFixed(3);
			} else if (in_den1 == "551 to 650") {
				var bdl = randomNumberFromRange(0.5600, 0.5900).toFixed(3);
			} else if (in_den1 == "651 to 750") {
				var bdl = randomNumberFromRange(0.6600, 0.6900).toFixed(3);
			} else if (in_den1 == "751 to 850") {
				var bdl = randomNumberFromRange(0.7600, 0.7900).toFixed(3);
			} else if (in_den1 == "851 to 1000") {
				var bdl = randomNumberFromRange(0.8700, 0.9200).toFixed(3);
			}
			$('#bdl').val(bdl);
			var bd_l = $('#bdl').val();
			var mc = randomNumberFromRange(15.00, 25.00).toFixed(2);
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
		
		//THR
	function thr_auto()
	{
		$('#txtthr').css("background-color","var(--success)"); 
		$('#tl_1').val("1");
			$('#tl_2').val("1");
			$('#tl_3').val("1");
			$('#tw_1').val("1");
			$('#tw_2').val("1");
			$('#tw_3').val("1");
			$('#th_1').val("1");
			$('#th_2').val("1");
			$('#th_3').val("1");
			$('#tarea_1').val("1");
			$('#tarea_2').val("1");
			$('#tarea_3').val("1");
			$('#tvolt_1').val("1");
			$('#tvolt_2').val("1");
			$('#tvolt_3').val("1");
			$('#tf_1_1').val("1");
			$('#tf_1_2').val("1");
			$('#tf_1_3').val("1");
			$('#tf_2_1').val("1");
			$('#tf_2_2').val("1");
			$('#tf_2_3').val("1");
			$('#tf_3_1').val("1");
			$('#tf_3_2').val("1");
			$('#tf_3_3').val("1");
			$('#tf_avg_1').val("1");
			$('#tf_avg_2').val("1");
			$('#tf_avg_3').val("1");
			$('#tc_1_1').val("1");
			$('#tc_1_2').val("1");
			$('#tc_1_3').val("1");
			$('#tc_2_1').val("1");
			$('#tc_2_2').val("1");
			$('#tc_2_3').val("1");
			$('#tc_3_1').val("1");
			$('#tc_3_2').val("1");
			$('#tc_3_3').val("1");
			$('#tc_avg_1').val("1");
			$('#tc_avg_2').val("1");
			$('#tc_avg_3').val("1");
			$('#thr_1').val("1");
			$('#thr_2').val("1");
			$('#thr_3').val("1");
			$('#avg_thr').val("1");
		
		
	}
	$('#chk_thr').change(function(){
        if(this.checked)
		{ 
			thr_auto();
		}
		else
		{
			$('#txtthr').css("background-color","white");
			$('#tl_1').val(null);
			$('#tl_2').val(null);
			$('#tl_3').val(null);
			$('#tw_1').val(null);
			$('#tw_2').val(null);
			$('#tw_3').val(null);
			$('#th_1').val(null);
			$('#th_2').val(null);
			$('#th_3').val(null);
			$('#tarea_1').val(null);
			$('#tarea_2').val(null);
			$('#tarea_3').val(null);
			$('#tvolt_1').val(null);
			$('#tvolt_2').val(null);
			$('#tvolt_3').val(null);
			$('#tf_1_1').val(null);
			$('#tf_1_2').val(null);
			$('#tf_1_3').val(null);
			$('#tf_2_1').val(null);
			$('#tf_2_2').val(null);
			$('#tf_2_3').val(null);
			$('#tf_3_1').val(null);
			$('#tf_3_2').val(null);
			$('#tf_3_3').val(null);
			$('#tf_avg_1').val(null);
			$('#tf_avg_2').val(null);
			$('#tf_avg_3').val(null);
			$('#tc_1_1').val(null);
			$('#tc_1_2').val(null);
			$('#tc_1_3').val(null);
			$('#tc_2_1').val(null);
			$('#tc_2_2').val(null);
			$('#tc_2_3').val(null);
			$('#tc_3_1').val(null);
			$('#tc_3_2').val(null);
			$('#tc_3_3').val(null);
			$('#tc_avg_1').val(null);
			$('#tc_avg_2').val(null);
			$('#tc_avg_3').val(null);
			$('#thr_1').val(null);
			$('#thr_2').val(null);
			$('#thr_3').val(null);
			$('#avg_thr').val(null);
			
			
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
				
				//Thermal Conductivity
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="thr")
					{
						$('#txtthr').css("background-color","var(--success)");
						$("#chk_thr").prop("checked", true); 
						thr_auto();
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
		$('#btn_save').show();

	});

	function getGlazedTiles() {
		var lab_no = $('#lab_no').val();
		var report_no = $('#report_no').val();
		var job_no = $('#job_no').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_aac_block.php',
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
					var sample_4 = $('#sample_4').val();
					var sample_5 = $('#sample_5').val();
					var sample_6 = $('#sample_6').val();
					var sample_7 = $('#sample_7').val();
					var sample_8 = $('#sample_8').val();
					var sample_9 = $('#sample_9').val();
					var sample_10 = $('#sample_10').val();
					var sample_11 = $('#sample_11').val();
					var sample_12 = $('#sample_12').val();

					var l_1 = $('#l_1').val();
					var l_2 = $('#l_2').val();
					var l_3 = $('#l_3').val();
					var l_4 = $('#l_4').val();
					var l_5 = $('#l_5').val();
					var l_6 = $('#l_6').val();
					var l_7 = $('#l_7').val();
					var l_8 = $('#l_8').val();
					var l_9 = $('#l_9').val();
					var l_10 = $('#l_10').val();
					var l_11 = $('#l_11').val();
					var l_12 = $('#l_12').val();

					var w_1 = $('#w_1').val();
					var w_2 = $('#w_2').val();
					var w_3 = $('#w_3').val();
					var w_4 = $('#w_4').val();
					var w_5 = $('#w_5').val();
					var w_6 = $('#w_6').val();
					var w_7 = $('#w_7').val();
					var w_8 = $('#w_8').val();
					var w_9 = $('#w_9').val();
					var w_10 = $('#w_10').val();
					var w_11 = $('#w_11').val();
					var w_12 = $('#w_12').val();

					var h_1 = $('#h_1').val();
					var h_2 = $('#h_2').val();
					var h_3 = $('#h_3').val();
					var h_4 = $('#h_4').val();
					var h_5 = $('#h_5').val();
					var h_6 = $('#h_6').val();
					var h_7 = $('#h_7').val();
					var h_8 = $('#h_8').val();
					var h_9 = $('#h_9').val();
					var h_10 = $('#h_10').val();
					var h_11 = $('#h_11').val();
					var h_12 = $('#h_12').val();

					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();
					var load_4 = $('#load_4').val();
					var load_5 = $('#load_5').val();
					var load_6 = $('#load_6').val();
					var load_7 = $('#load_7').val();
					var load_8 = $('#load_8').val();
					var load_9 = $('#load_9').val();
					var load_10 = $('#load_10').val();
					var load_11 = $('#load_11').val();
					var load_12 = $('#load_12').val();

					var area_1 = $('#area_1').val();
					var area_2 = $('#area_2').val();
					var area_3 = $('#area_3').val();
					var area_4 = $('#area_4').val();
					var area_5 = $('#area_5').val();
					var area_6 = $('#area_6').val();
					var area_7 = $('#area_7').val();
					var area_8 = $('#area_8').val();
					var area_9 = $('#area_9').val();
					var area_10 = $('#area_10').val();
					var area_11 = $('#area_11').val();
					var area_12 = $('#area_12').val();

					var com_1 = $('#com_1').val();
					var com_2 = $('#com_2').val();
					var com_3 = $('#com_3').val();
					var com_4 = $('#com_4').val();
					var com_5 = $('#com_5').val();
					var com_6 = $('#com_6').val();
					var com_7 = $('#com_7').val();
					var com_8 = $('#com_8').val();
					var com_9 = $('#com_9').val();
					var com_10 = $('#com_10').val();
					var com_11 = $('#com_11').val();
					var com_12 = $('#com_12').val();

					var mc_1 = $('#mc_1').val();
					var mc_2 = $('#mc_2').val();
					var mc_3 = $('#mc_3').val();
					var mc_4 = $('#mc_4').val();
					var mc_5 = $('#mc_5').val();
					var mc_6 = $('#mc_6').val();
					var mc_7 = $('#mc_7').val();
					var mc_8 = $('#mc_8').val();
					var mc_9 = $('#mc_9').val();
					var mc_10 = $('#mc_10').val();
					var mc_11 = $('#mc_11').val();
					var mc_12 = $('#mc_12').val();
					
					var w1_1 = $('#w1_1').val();
					var w1_2 = $('#w1_2').val();
					var w1_3 = $('#w1_3').val();
					var w1_4 = $('#w1_4').val();
					var w1_5 = $('#w1_5').val();
					var w1_6 = $('#w1_6').val();
					var w1_7 = $('#w1_7').val();
					var w1_8 = $('#w1_8').val();
					var w1_9 = $('#w1_9').val();
					var w1_10 = $('#w1_10').val();
					var w1_11 = $('#w1_11').val();
					var w1_12 = $('#w1_12').val();
					
					


					var avg_com = $('#avg_com').val();
					break;
				} else {
					var chk_com = "0";
					var sample_1 = "";
					var sample_2 = "";
					var sample_3 = "";
					var sample_4 = "";
					var sample_5 = "";
					var sample_6 = "";
					var sample_7 = "";
					var sample_8 = "";
					var sample_9 = "";
					var sample_10 = "";
					var sample_11 = "";
					var sample_12 = "";

					var l_1 = "";
					var l_2 = "";
					var l_3 = "";
					var l_4 = "";
					var l_5 = "";
					var l_6 = "";
					var l_7 = "";
					var l_8 = "";
					var l_9 = "";
					var l_10 = "";
					var l_11 = "";
					var l_12 = "";

					var w_1 = "";
					var w_2 = "";
					var w_3 = "";
					var w_4 = "";
					var w_5 = "";
					var w_6 = "";
					var w_7 = "";
					var w_8 = "";
					var w_9 = "";
					var w_10 = "";
					var w_11 = "";
					var w_12 = "";

					var h_1 = "";
					var h_2 = "";
					var h_3 = "";
					var h_4 = "";
					var h_5 = "";
					var h_6 = "";
					var h_7 = "";
					var h_8 = "";
					var h_9 = "";
					var h_10 = "";
					var h_11 = "";
					var h_12 = "";

					var load_1 = "";
					var load_2 = "";
					var load_3 = "";
					var load_4 = "";
					var load_5 = "";
					var load_6 = "";
					var load_7 = "";
					var load_8 = "";
					var load_9 = "";
					var load_10 = "";
					var load_11 = "";
					var load_12 = "";

					var area_1 = "";
					var area_2 = "";
					var area_3 = "";
					var area_4 = "";
					var area_5 = "";
					var area_6 = "";
					var area_7 = "";
					var area_8 = "";
					var area_9 = "";
					var area_10 = "";
					var area_11 = "";
					var area_12 = "";

					var com_1 = "";
					var com_2 = "";
					var com_3 = "";
					var com_4 = "";
					var com_5 = "";
					var com_6 = "";
					var com_7 = "";
					var com_8 = "";
					var com_9 = "";
					var com_10 = "";
					var com_11 = "";
					var com_12 = "";


					var mc_1 = "";
					var mc_2 = "";
					var mc_3 = "";
					var mc_4 = "";
					var mc_5 = "";
					var mc_6 = "";
					var mc_7 = "";
					var mc_8 = "";
					var mc_9 = "";
					var mc_10 = "";
					var mc_11 = "";
					var mc_12 = "";
					
					var w1_1 = "";
					var w1_2 = "";
					var w1_3 = "";
					var w1_4 = "";
					var w1_5 = "";
					var w1_6 = "";
					var w1_7 = "";
					var w1_8 = "";
					var w1_9 = "";
					var w1_10 = "";
					var w1_11 = "";
					var w1_12 = "";
					


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
					var dim_l5 = $('#dim_l5').val();
					var dim_l6 = $('#dim_l6').val();
					var dim_l7 = $('#dim_l7').val();
					var dim_l8 = $('#dim_l8').val();
					var dim_l9 = $('#dim_l9').val();
					var dim_l10 = $('#dim_l10').val();
					var dim_l11 = $('#dim_l11').val();
					var dim_l12 = $('#dim_l12').val();
					var dim_l13 = $('#dim_l13').val();
					var dim_l14 = $('#dim_l14').val();
					var dim_l15 = $('#dim_l15').val();
					var dim_l16 = $('#dim_l16').val();
					var dim_l17 = $('#dim_l17').val();
					var dim_l18 = $('#dim_l18').val();
					var dim_l19 = $('#dim_l19').val();
					var dim_l20 = $('#dim_l20').val();
					var dim_l21 = $('#dim_l21').val();
					var dim_l22 = $('#dim_l22').val();
					var dim_l23 = $('#dim_l23').val();
					var dim_l24 = $('#dim_l24').val();
					var dim_h1 = $('#dim_h1').val();
					var dim_h2 = $('#dim_h2').val();
					var dim_h3 = $('#dim_h3').val();
					var dim_h4 = $('#dim_h4').val();
					var dim_h5 = $('#dim_h5').val();
					var dim_h6 = $('#dim_h6').val();
					var dim_h7 = $('#dim_h7').val();
					var dim_h8 = $('#dim_h8').val();
					var dim_h9 = $('#dim_h9').val();
					var dim_h10 = $('#dim_h10').val();
					var dim_h11 = $('#dim_h11').val();
					var dim_h12 = $('#dim_h12').val();
					var dim_h13 = $('#dim_h13').val();
					var dim_h14 = $('#dim_h14').val();
					var dim_h15 = $('#dim_h15').val();
					var dim_h16 = $('#dim_h16').val();
					var dim_h17 = $('#dim_h17').val();
					var dim_h18 = $('#dim_h18').val();
					var dim_h19 = $('#dim_h19').val();
					var dim_h20 = $('#dim_h20').val();
					var dim_h21 = $('#dim_h21').val();
					var dim_h22 = $('#dim_h22').val();
					var dim_h23 = $('#dim_h23').val();
					var dim_h24 = $('#dim_h24').val();
					var dim_w1 = $('#dim_w1').val();
					var dim_w2 = $('#dim_w2').val();
					var dim_w3 = $('#dim_w3').val();
					var dim_w4 = $('#dim_w4').val();
					var dim_w5 = $('#dim_w5').val();
					var dim_w6 = $('#dim_w6').val();
					var dim_w7 = $('#dim_w7').val();
					var dim_w8 = $('#dim_w8').val();
					var dim_w9 = $('#dim_w9').val();
					var dim_w10 = $('#dim_w10').val();
					var dim_w11 = $('#dim_w11').val();
					var dim_w12 = $('#dim_w12').val();
					var dim_w13 = $('#dim_w13').val();
					var dim_w14 = $('#dim_w14').val();
					var dim_w15 = $('#dim_w15').val();
					var dim_w16 = $('#dim_w16').val();
					var dim_w17 = $('#dim_w17').val();
					var dim_w18 = $('#dim_w18').val();
					var dim_w19 = $('#dim_w19').val();
					var dim_w20 = $('#dim_w20').val();
					var dim_w21 = $('#dim_w21').val();
					var dim_w22 = $('#dim_w22').val();
					var dim_w23 = $('#dim_w23').val();
					var dim_w24 = $('#dim_w24').val();
					var dim_block1 = $('#dim_block1').val();
					var dim_block2 = $('#dim_block2').val();
					var dim_block3 = $('#dim_block3').val();
					var dim_block4 = $('#dim_block4').val();
					var dim_block5 = $('#dim_block5').val();
					var dim_block6 = $('#dim_block6').val();
					var dim_block7 = $('#dim_block7').val();
					var dim_block8 = $('#dim_block8').val();
					var dim_block9 = $('#dim_block9').val();
					var dim_block10 = $('#dim_block10').val();
					var dim_block11 = $('#dim_block11').val();
					var dim_block12 = $('#dim_block12').val();
					var dim_block13 = $('#dim_block13').val();
					var dim_block14 = $('#dim_block14').val();
					var dim_block15 = $('#dim_block15').val();
					var dim_block16 = $('#dim_block16').val();
					var dim_block17 = $('#dim_block17').val();
					var dim_block18 = $('#dim_block18').val();
					var dim_block19 = $('#dim_block19').val();
					var dim_block20 = $('#dim_block20').val();
					var dim_block21 = $('#dim_block21').val();
					var dim_block22 = $('#dim_block22').val();
					var dim_block23 = $('#dim_block23').val();
					var dim_block24 = $('#dim_block24').val();



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
					var dim_l5 = "";
					var dim_l6 = "";
					var dim_l7 = "";
					var dim_l8 = "";
					var dim_l9 = "";
					var dim_l10 = "";
					var dim_l11 = "";
					var dim_l12 = "";
					var dim_l13 = "";
					var dim_l14 = "";
					var dim_l15 = "";
					var dim_l16 = "";
					var dim_l17 = "";
					var dim_l18 = "";
					var dim_l19 = "";
					var dim_l20 = "";
					var dim_l21 = "";
					var dim_l22 = "";
					var dim_l23 = "";
					var dim_l24 = "";
					var dim_h1 = "";
					var dim_h2 = "";
					var dim_h3 = "";
					var dim_h4 = "";
					var dim_h5 = "";
					var dim_h6 = "";
					var dim_h7 = "";
					var dim_h8 = "";
					var dim_h9 = "";
					var dim_h10 = "";
					var dim_h11 = "";
					var dim_h12 = "";
					var dim_h13 = "";
					var dim_h14 = "";
					var dim_h15 = "";
					var dim_h16 = "";
					var dim_h17 = "";
					var dim_h18 = "";
					var dim_h19 = "";
					var dim_h20 = "";
					var dim_h21 = "";
					var dim_h22 = "";
					var dim_h23 = "";
					var dim_h24 = "";
					var dim_w1 = "";
					var dim_w2 = "";
					var dim_w3 = "";
					var dim_w4 = "";
					var dim_w5 = "";
					var dim_w6 = "";
					var dim_w7 = "";
					var dim_w8 = "";
					var dim_w9 = "";
					var dim_w10 = "";
					var dim_w11 = "";
					var dim_w12 = "";
					var dim_w13 = "";
					var dim_w14 = "";
					var dim_w15 = "";
					var dim_w16 = "";
					var dim_w17 = "";
					var dim_w18 = "";
					var dim_w19 = "";
					var dim_w20 = "";
					var dim_w21 = "";
					var dim_w22 = "";
					var dim_w23 = "";
					var dim_w24 = "";
					var dim_block1 = "";
					var dim_block2 = "";
					var dim_block3 = "";
					var dim_block4 = "";
					var dim_block5 = "";
					var dim_block6 = "";
					var dim_block7 = "";
					var dim_block8 = "";
					var dim_block9 = "";
					var dim_block10 = "";
					var dim_block11 = "";
					var dim_block12 = "";
					var dim_block13 = "";
					var dim_block14 = "";
					var dim_block15 = "";
					var dim_block16 = "";
					var dim_block17 = "";
					var dim_block18 = "";
					var dim_block19 = "";
					var dim_block20 = "";
					var dim_block21 = "";
					var dim_block22 = "";
					var dim_block23 = "";
					var dim_block24 = "";


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
			
			//THERMAL CONDUCTIVITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="thr")
					{
						if(document.getElementById('chk_thr').checked) {
								var chk_thr = "1";
						}
						else{
								var chk_thr = "0";
						}
																		
							var tl_1 = $('#tl_1').val();
							var tl_2 = $('#tl_2').val();
							var tl_3 = $('#tl_3').val();
							
							var th_1 = $('#th_1').val();
							var th_2 = $('#th_2').val();
							var th_3 = $('#th_3').val();
						
							var tw_1 = $('#tw_1').val();
							var tw_2 = $('#tw_2').val();
							var tw_3 = $('#tw_3').val();
						
							var tarea_1 = $('#tarea_1').val();
							var tarea_2 = $('#tarea_2').val();
							var tarea_3 = $('#tarea_3').val();
							
							var tvolt_1 = $('#tvolt_1').val();
							var tvolt_2 = $('#tvolt_2').val();
							var tvolt_3 = $('#tvolt_3').val();
							
							var tf_1_1 = $('#tf_1_1').val();
							var tf_1_2 = $('#tf_1_2').val();
							var tf_1_3 = $('#tf_1_3').val();
							
							var tf_2_1 = $('#tf_2_1').val();
							var tf_2_2 = $('#tf_2_2').val();
							var tf_2_3 = $('#tf_2_3').val();
							
							var tf_3_1 = $('#tf_3_1').val();
							var tf_3_2 = $('#tf_3_2').val();
							var tf_3_3 = $('#tf_3_3').val();
							
							var tf_avg_1 = $('#tf_avg_1').val();
							var tf_avg_2 = $('#tf_avg_2').val();
							var tf_avg_3 = $('#tf_avg_3').val();
							
							var tc_1_1 = $('#tc_1_1').val();
							var tc_1_2 = $('#tc_1_2').val();
							var tc_1_3 = $('#tc_1_3').val();
							
							var tc_2_1 = $('#tc_2_1').val();
							var tc_2_2 = $('#tc_2_2').val();
							var tc_2_3 = $('#tc_2_3').val();
							
							var tc_3_1 = $('#tc_3_1').val();
							var tc_3_2 = $('#tc_3_2').val();
							var tc_3_3 = $('#tc_3_3').val();
							
							var tc_avg_1 = $('#tc_avg_1').val();
							var tc_avg_2 = $('#tc_avg_2').val();
							var tc_avg_3 = $('#tc_avg_3').val();
							
							var thr_1 = $('#thr_1').val();
							var thr_2 = $('#thr_2').val();
							var thr_3 = $('#thr_3').val();
							
							
							var avg_thr = $('#avg_thr').val();
							var the_s_d = $('#the_s_d').val();
							var the_e_d = $('#the_e_d').val();
							
						break;
					}
					else
					{
						var chk_thr = "0";	
						var tl_1 = "";
						var tl_2 = "";
						var tl_3 = "";
						
						var th_1 = "";
						var th_2 = "";
						var th_3 = "";
					
						var tw_1 = "";
						var tw_2 = "";
						var tw_3 = "";
					
						var tarea_1 = "";
						var tarea_2 = "";
						var tarea_3 = "";
						
						var tvolt_1 = "";
						var tvolt_2 = "";
						var tvolt_3 = "";
						
						var tf_1_1 = "";
						var tf_1_2 = "";
						var tf_1_3 = "";
						
						var tf_2_1 = "";
						var tf_2_2 = "";
						var tf_2_3 = "";
						
						var tf_3_1 = "";
						var tf_3_2 = "";
						var tf_3_3 = "";
						
						var tf_avg_1 = "";
						var tf_avg_2 = "";
						var tf_avg_3 = "";
						
						var tc_1_1 = "";
						var tc_1_2 = "";
						var tc_1_3 = "";
						
						var tc_2_1 = "";
						var tc_2_2 = "";
						var tc_2_3 = "";
						
						var tc_3_1 = "";
						var tc_3_2 = "";
						var tc_3_3 = "";
						
						var tc_avg_1 = "";
						var tc_avg_2 = "";
						var tc_avg_3 = "";
						
						var thr_1 = "";
						var thr_2 = "";
						var thr_3 = "";
						
						var the_s_d = "";
						var the_e_d = "";
						var avg_thr = "";
						
					}
				}


			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_com=' + chk_com + '&avg_com=' + avg_com + '&sample_1=' + sample_1 + '&sample_2=' + sample_2 + '&sample_3=' + sample_3 + '&sample_4=' + sample_4 + '&sample_5=' + sample_5 + '&sample_6=' + sample_6 + '&sample_7=' + sample_7 + '&sample_8=' + sample_8 + '&sample_9=' + sample_9 + '&sample_10=' + sample_10 + '&sample_11=' + sample_11 + '&sample_12=' + sample_12 + '&l_1=' + l_1 + '&l_2=' + l_2 + '&l_3=' + l_3 + '&l_4=' + l_4 + '&l_5=' + l_5 + '&l_6=' + l_6 + '&l_7=' + l_7 + '&l_8=' + l_8 + '&l_9=' + l_9 + '&l_10=' + l_10 + '&l_11=' + l_11 + '&l_12=' + l_12 + '&w_1=' + w_1 + '&w_2=' + w_2 + '&w_3=' + w_3 + '&w_4=' + w_4 + '&w_5=' + w_5 + '&w_6=' + w_6 + '&w_7=' + w_7 + '&w_8=' + w_8 + '&w_9=' + w_9 + '&w_10=' + w_10 + '&w_11=' + w_11 + '&w_12=' + w_12 + '&h_1=' + h_1 + '&h_2=' + h_2 + '&h_3=' + h_3 + '&h_4=' + h_4 + '&h_5=' + h_5 + '&h_6=' + h_6 + '&h_7=' + h_7 + '&h_8=' + h_8 + '&h_9=' + h_9 + '&h_10=' + h_10 + '&h_11=' + h_11 + '&h_12=' + h_12 + '&load_1=' + load_1 + '&load_2=' + load_2 + '&load_3=' + load_3 + '&load_4=' + load_4 + '&load_5=' + load_5 + '&load_6=' + load_6 + '&load_7=' + load_7 + '&load_8=' + load_8 + '&load_9=' + load_9 + '&load_10=' + load_10 + '&load_11=' + load_11 + '&load_12=' + load_12 + '&area_1=' + area_1 + '&area_2=' + area_2 + '&area_3=' + area_3 + '&area_4=' + area_4 + '&area_5=' + area_5 + '&area_6=' + area_6 + '&area_7=' + area_7 + '&area_8=' + area_8 + '&area_9=' + area_9 + '&area_10=' + area_10 + '&area_11=' + area_11 + '&area_12=' + area_12 + '&com_1=' + com_1 + '&com_2=' + com_2 + '&com_3=' + com_3 + '&com_4=' + com_4 + '&com_5=' + com_5 + '&com_6=' + com_6 + '&com_7=' + com_7 + '&com_8=' + com_8 + '&com_9=' + com_9 + '&com_10=' + com_10 + '&com_11=' + com_11 + '&com_12=' + com_12 + '&mc_1=' + mc_1 + '&mc_2=' + mc_2 + '&mc_3=' + mc_3 + '&mc_4=' + mc_4 + '&mc_5=' + mc_5 + '&mc_6=' + mc_6 + '&mc_7=' + mc_7 + '&mc_8=' + mc_8 + '&mc_9=' + mc_9 + '&mc_10=' + mc_10 + '&mc_11=' + mc_11 + '&mc_12=' + mc_12 + '&w1_1=' + w1_1+ '&w1_2=' + w1_2+ '&w1_3=' + w1_3+ '&w1_4=' + w1_4+ '&w1_5=' + w1_5+ '&w1_6=' + w1_6+ '&w1_7=' + w1_7+ '&w1_8=' + w1_8+ '&w1_9=' + w1_9+ '&w1_10=' + w1_10+ '&w1_11=' + w1_11+ '&w1_12=' + w1_12+ '&chk_dim=' + chk_dim + '&dim_height=' + dim_height + '&dim_width=' + dim_width + '&dim_length=' + dim_length + '&dim_l1=' + dim_l1 + '&dim_l2=' + dim_l2 + '&dim_l3=' + dim_l3 + '&dim_l4=' + dim_l4 + '&dim_l5=' + dim_l5 + '&dim_l6=' + dim_l6 + '&dim_l7=' + dim_l7 + '&dim_l8=' + dim_l8 + '&dim_l9=' + dim_l9 + '&dim_l10=' + dim_l10 + '&dim_l11=' + dim_l11 + '&dim_l12=' + dim_l12 + '&dim_l13=' + dim_l13 + '&dim_l14=' + dim_l14 + '&dim_l15=' + dim_l15 + '&dim_l16=' + dim_l16 + '&dim_l17=' + dim_l17 + '&dim_l18=' + dim_l18 + '&dim_l19=' + dim_l19 + '&dim_l20=' + dim_l20 + '&dim_l21=' + dim_l21 + '&dim_l22=' + dim_l22 + '&dim_l23=' + dim_l23 + '&dim_l24=' + dim_l24 + '&dim_h1=' + dim_h1 + '&dim_h2=' + dim_h2 + '&dim_h3=' + dim_h3 + '&dim_h4=' + dim_h4 + '&dim_h5=' + dim_h5 + '&dim_h6=' + dim_h6 + '&dim_h7=' + dim_h7 + '&dim_h8=' + dim_h8 + '&dim_h9=' + dim_h9 + '&dim_h10=' + dim_h10 + '&dim_h11=' + dim_h11 + '&dim_h12=' + dim_h12 + '&dim_h13=' + dim_h13 + '&dim_h14=' + dim_h14 + '&dim_h15=' + dim_h15 + '&dim_h16=' + dim_h16 + '&dim_h17=' + dim_h17 + '&dim_h18=' + dim_h18 + '&dim_h19=' + dim_h19 + '&dim_h20=' + dim_h20 + '&dim_h21=' + dim_h21 + '&dim_h22=' + dim_h22 + '&dim_h23=' + dim_h23 + '&dim_h24=' + dim_h24 + '&dim_w1=' + dim_w1 + '&dim_w2=' + dim_w2 + '&dim_w3=' + dim_w3 + '&dim_w4=' + dim_w4 + '&dim_w5=' + dim_w5 + '&dim_w6=' + dim_w6 + '&dim_w7=' + dim_w7 + '&dim_w8=' + dim_w8 + '&dim_w9=' + dim_w9 + '&dim_w10=' + dim_w10 + '&dim_w11=' + dim_w11 + '&dim_w12=' + dim_w12 + '&dim_w13=' + dim_w13 + '&dim_w14=' + dim_w14 + '&dim_w15=' + dim_w15 + '&dim_w16=' + dim_w16 + '&dim_w17=' + dim_w17 + '&dim_w18=' + dim_w18 + '&dim_w19=' + dim_w19 + '&dim_w20=' + dim_w20 + '&dim_w21=' + dim_w21 + '&dim_w22=' + dim_w22 + '&dim_w23=' + dim_w23 + '&dim_w24=' + dim_w24 + '&dim_block1=' + dim_block1 + '&dim_block2=' + dim_block2 + '&dim_block3=' + dim_block3 + '&dim_block4=' + dim_block4 + '&dim_block5=' + dim_block5 + '&dim_block6=' + dim_block6 + '&dim_block7=' + dim_block7 + '&dim_block8=' + dim_block8 + '&dim_block9=' + dim_block9 + '&dim_block10=' + dim_block10 + '&dim_block11=' + dim_block11 + '&dim_block12=' + dim_block12 + '&dim_block13=' + dim_block13 + '&dim_block14=' + dim_block14 + '&dim_block15=' + dim_block15 + '&dim_block16=' + dim_block16 + '&dim_block17=' + dim_block17 + '&dim_block18=' + dim_block18 + '&dim_block19=' + dim_block19 + '&dim_block20=' + dim_block20 + '&dim_block21=' + dim_block21 + '&dim_block22=' + dim_block22 + '&dim_block23=' + dim_block23 + '&dim_block24=' + dim_block24 + '&chk_den=' + chk_den + '&dl_1=' + dl_1 + '&dl_2=' + dl_2 + '&dl_3=' + dl_3 + '&dw_1=' + dw_1 + '&dw_2=' + dw_2 + '&dw_3=' + dw_3 + '&dh_1=' + dh_1 + '&dh_2=' + dh_2 + '&dh_3=' + dh_3 + '&vol_1=' + vol_1 + '&vol_2=' + vol_2 + '&vol_3=' + vol_3 + '&weight_1=' + weight_1 + '&weight_2=' + weight_2 + '&weight_3=' + weight_3 + '&den_1=' + den_1 + '&den_2=' + den_2 + '&den_3=' + den_3 + '&wa_1=' + wa_1 + '&wa_2=' + wa_2 + '&wa_3=' + wa_3 + '&w1=' + w1 + '&w2=' + w2 + '&w3=' + w3 + '&bdl=' + bdl + '&bdl_kg=' + bdl_kg + '&mc=' + mc + '&chk_shr=' + chk_shr + '&con_1=' + con_1 + '&con_2=' + con_2 + '&con_3=' + con_3 + '&fr_1=' + fr_1 + '&fr_2=' + fr_2 + '&fr_3=' + fr_3 + '&fi_1=' + fi_1 + '&fi_2=' + fi_2 + '&fi_3=' + fi_3 + '&ds_1=' + ds_1 + '&ds_2=' + ds_2 + '&ds_3=' + ds_3 + '&avg_shrink=' + avg_shrink + '&in_l=' + in_l + '&in_w=' + in_w + '&in_h=' + in_h + '&in_den=' + in_den + '&in_grade=' + in_grade + '&con_wid_1=' + con_wid_1 + '&con_wid_2=' + con_wid_2 + '&con_wid_3=' + con_wid_3 + '&con_thi_1=' + con_thi_1 + '&con_thi_2=' + con_thi_2 + '&con_thi_3=' + con_thi_3+'&chk_thr='+chk_thr+'&tl_1='+tl_1+'&tl_2='+tl_2+'&tl_3='+tl_3+'&tw_1='+tw_1+'&tw_2='+tw_2+'&tw_3='+tw_3+'&th_1='+th_1+'&th_2='+th_2+'&th_3='+th_3+'&tarea_1='+tarea_1+'&tarea_2='+tarea_2+'&tarea_3='+tarea_3+'&tvolt_1='+tvolt_1+'&tvolt_2='+tvolt_2+'&tvolt_3='+tvolt_3+'&tf_1_1='+tf_1_1+'&tf_1_2='+tf_1_2+'&tf_1_3='+tf_1_3+'&tf_2_1='+tf_2_1+'&tf_2_2='+tf_2_2+'&tf_2_3='+tf_2_3+'&tf_3_1='+tf_3_1+'&tf_3_2='+tf_3_2+'&tf_3_3='+tf_3_3+'&tf_avg_1='+tf_avg_1+'&tf_avg_2='+tf_avg_2+'&tf_avg_3='+tf_avg_3+'&tc_1_1='+tc_1_1+'&tc_1_2='+tc_1_2+'&tc_1_3='+tc_1_3+'&tc_2_1='+tc_2_1+'&tc_2_2='+tc_2_2+'&tc_2_3='+tc_2_3+'&tc_3_1='+tc_3_1+'&tc_3_2='+tc_3_2+'&tc_3_3='+tc_3_3+'&tc_avg_1='+tc_avg_1+'&tc_avg_2='+tc_avg_2+'&tc_avg_3='+tc_avg_3+'&thr_1='+thr_1+'&thr_2='+thr_2+'&thr_3='+thr_3+'&avg_thr='+avg_thr+'&the_s_d='+the_s_d+'&the_e_d='+the_e_d+'&amend_date='+amend_date;




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
					var sample_4 = $('#sample_4').val();
					var sample_5 = $('#sample_5').val();
					var sample_6 = $('#sample_6').val();
					var sample_7 = $('#sample_7').val();
					var sample_8 = $('#sample_8').val();
					var sample_9 = $('#sample_9').val();
					var sample_10 = $('#sample_10').val();
					var sample_11 = $('#sample_11').val();
					var sample_12 = $('#sample_12').val();

					var l_1 = $('#l_1').val();
					var l_2 = $('#l_2').val();
					var l_3 = $('#l_3').val();
					var l_4 = $('#l_4').val();
					var l_5 = $('#l_5').val();
					var l_6 = $('#l_6').val();
					var l_7 = $('#l_7').val();
					var l_8 = $('#l_8').val();
					var l_9 = $('#l_9').val();
					var l_10 = $('#l_10').val();
					var l_11 = $('#l_11').val();
					var l_12 = $('#l_12').val();

					var w_1 = $('#w_1').val();
					var w_2 = $('#w_2').val();
					var w_3 = $('#w_3').val();
					var w_4 = $('#w_4').val();
					var w_5 = $('#w_5').val();
					var w_6 = $('#w_6').val();
					var w_7 = $('#w_7').val();
					var w_8 = $('#w_8').val();
					var w_9 = $('#w_9').val();
					var w_10 = $('#w_10').val();
					var w_11 = $('#w_11').val();
					var w_12 = $('#w_12').val();

					var h_1 = $('#h_1').val();
					var h_2 = $('#h_2').val();
					var h_3 = $('#h_3').val();
					var h_4 = $('#h_4').val();
					var h_5 = $('#h_5').val();
					var h_6 = $('#h_6').val();
					var h_7 = $('#h_7').val();
					var h_8 = $('#h_8').val();
					var h_9 = $('#h_9').val();
					var h_10 = $('#h_10').val();
					var h_11 = $('#h_11').val();
					var h_12 = $('#h_12').val();

					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();
					var load_4 = $('#load_4').val();
					var load_5 = $('#load_5').val();
					var load_6 = $('#load_6').val();
					var load_7 = $('#load_7').val();
					var load_8 = $('#load_8').val();
					var load_9 = $('#load_9').val();
					var load_10 = $('#load_10').val();
					var load_11 = $('#load_11').val();
					var load_12 = $('#load_12').val();

					var area_1 = $('#area_1').val();
					var area_2 = $('#area_2').val();
					var area_3 = $('#area_3').val();
					var area_4 = $('#area_4').val();
					var area_5 = $('#area_5').val();
					var area_6 = $('#area_6').val();
					var area_7 = $('#area_7').val();
					var area_8 = $('#area_8').val();
					var area_9 = $('#area_9').val();
					var area_10 = $('#area_10').val();
					var area_11 = $('#area_11').val();
					var area_12 = $('#area_12').val();

					var com_1 = $('#com_1').val();
					var com_2 = $('#com_2').val();
					var com_3 = $('#com_3').val();
					var com_4 = $('#com_4').val();
					var com_5 = $('#com_5').val();
					var com_6 = $('#com_6').val();
					var com_7 = $('#com_7').val();
					var com_8 = $('#com_8').val();
					var com_9 = $('#com_9').val();
					var com_10 = $('#com_10').val();
					var com_11 = $('#com_11').val();
					var com_12 = $('#com_12').val();

					var mc_1 = $('#mc_1').val();
					var mc_2 = $('#mc_2').val();
					var mc_3 = $('#mc_3').val();
					var mc_4 = $('#mc_4').val();
					var mc_5 = $('#mc_5').val();
					var mc_6 = $('#mc_6').val();
					var mc_7 = $('#mc_7').val();
					var mc_8 = $('#mc_8').val();
					var mc_9 = $('#mc_9').val();
					var mc_10 = $('#mc_10').val();
					var mc_11 = $('#mc_11').val();
					var mc_12 = $('#mc_12').val();
					
					var w1_1 = $('#w1_1').val();
					var w1_2 = $('#w1_2').val();
					var w1_3 = $('#w1_3').val();
					var w1_4 = $('#w1_4').val();
					var w1_5 = $('#w1_5').val();
					var w1_6 = $('#w1_6').val();
					var w1_7 = $('#w1_7').val();
					var w1_8 = $('#w1_8').val();
					var w1_9 = $('#w1_9').val();
					var w1_10 = $('#w1_10').val();
					var w1_11 = $('#w1_11').val();
					var w1_12 = $('#w1_12').val();
					
					


					var avg_com = $('#avg_com').val();
					break;
				} else {
					var chk_com = "0";
					var sample_1 = "";
					var sample_2 = "";
					var sample_3 = "";
					var sample_4 = "";
					var sample_5 = "";
					var sample_6 = "";
					var sample_7 = "";
					var sample_8 = "";
					var sample_9 = "";
					var sample_10 = "";
					var sample_11 = "";
					var sample_12 = "";

					var l_1 = "";
					var l_2 = "";
					var l_3 = "";
					var l_4 = "";
					var l_5 = "";
					var l_6 = "";
					var l_7 = "";
					var l_8 = "";
					var l_9 = "";
					var l_10 = "";
					var l_11 = "";
					var l_12 = "";

					var w_1 = "";
					var w_2 = "";
					var w_3 = "";
					var w_4 = "";
					var w_5 = "";
					var w_6 = "";
					var w_7 = "";
					var w_8 = "";
					var w_9 = "";
					var w_10 = "";
					var w_11 = "";
					var w_12 = "";

					var h_1 = "";
					var h_2 = "";
					var h_3 = "";
					var h_4 = "";
					var h_5 = "";
					var h_6 = "";
					var h_7 = "";
					var h_8 = "";
					var h_9 = "";
					var h_10 = "";
					var h_11 = "";
					var h_12 = "";

					var load_1 = "";
					var load_2 = "";
					var load_3 = "";
					var load_4 = "";
					var load_5 = "";
					var load_6 = "";
					var load_7 = "";
					var load_8 = "";
					var load_9 = "";
					var load_10 = "";
					var load_11 = "";
					var load_12 = "";

					var area_1 = "";
					var area_2 = "";
					var area_3 = "";
					var area_4 = "";
					var area_5 = "";
					var area_6 = "";
					var area_7 = "";
					var area_8 = "";
					var area_9 = "";
					var area_10 = "";
					var area_11 = "";
					var area_12 = "";

					var com_1 = "";
					var com_2 = "";
					var com_3 = "";
					var com_4 = "";
					var com_5 = "";
					var com_6 = "";
					var com_7 = "";
					var com_8 = "";
					var com_9 = "";
					var com_10 = "";
					var com_11 = "";
					var com_12 = "";


					var mc_1 = "";
					var mc_2 = "";
					var mc_3 = "";
					var mc_4 = "";
					var mc_5 = "";
					var mc_6 = "";
					var mc_7 = "";
					var mc_8 = "";
					var mc_9 = "";
					var mc_10 = "";
					var mc_11 = "";
					var mc_12 = "";
					
					var w1_1 = "";
					var w1_2 = "";
					var w1_3 = "";
					var w1_4 = "";
					var w1_5 = "";
					var w1_6 = "";
					var w1_7 = "";
					var w1_8 = "";
					var w1_9 = "";
					var w1_10 = "";
					var w1_11 = "";
					var w1_12 = "";
					


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
					var dim_l5 = $('#dim_l5').val();
					var dim_l6 = $('#dim_l6').val();
					var dim_l7 = $('#dim_l7').val();
					var dim_l8 = $('#dim_l8').val();
					var dim_l9 = $('#dim_l9').val();
					var dim_l10 = $('#dim_l10').val();
					var dim_l11 = $('#dim_l11').val();
					var dim_l12 = $('#dim_l12').val();
					var dim_l13 = $('#dim_l13').val();
					var dim_l14 = $('#dim_l14').val();
					var dim_l15 = $('#dim_l15').val();
					var dim_l16 = $('#dim_l16').val();
					var dim_l17 = $('#dim_l17').val();
					var dim_l18 = $('#dim_l18').val();
					var dim_l19 = $('#dim_l19').val();
					var dim_l20 = $('#dim_l20').val();
					var dim_l21 = $('#dim_l21').val();
					var dim_l22 = $('#dim_l22').val();
					var dim_l23 = $('#dim_l23').val();
					var dim_l24 = $('#dim_l24').val();
					var dim_h1 = $('#dim_h1').val();
					var dim_h2 = $('#dim_h2').val();
					var dim_h3 = $('#dim_h3').val();
					var dim_h4 = $('#dim_h4').val();
					var dim_h5 = $('#dim_h5').val();
					var dim_h6 = $('#dim_h6').val();
					var dim_h7 = $('#dim_h7').val();
					var dim_h8 = $('#dim_h8').val();
					var dim_h9 = $('#dim_h9').val();
					var dim_h10 = $('#dim_h10').val();
					var dim_h11 = $('#dim_h11').val();
					var dim_h12 = $('#dim_h12').val();
					var dim_h13 = $('#dim_h13').val();
					var dim_h14 = $('#dim_h14').val();
					var dim_h15 = $('#dim_h15').val();
					var dim_h16 = $('#dim_h16').val();
					var dim_h17 = $('#dim_h17').val();
					var dim_h18 = $('#dim_h18').val();
					var dim_h19 = $('#dim_h19').val();
					var dim_h20 = $('#dim_h20').val();
					var dim_h21 = $('#dim_h21').val();
					var dim_h22 = $('#dim_h22').val();
					var dim_h23 = $('#dim_h23').val();
					var dim_h24 = $('#dim_h24').val();
					var dim_w1 = $('#dim_w1').val();
					var dim_w2 = $('#dim_w2').val();
					var dim_w3 = $('#dim_w3').val();
					var dim_w4 = $('#dim_w4').val();
					var dim_w5 = $('#dim_w5').val();
					var dim_w6 = $('#dim_w6').val();
					var dim_w7 = $('#dim_w7').val();
					var dim_w8 = $('#dim_w8').val();
					var dim_w9 = $('#dim_w9').val();
					var dim_w10 = $('#dim_w10').val();
					var dim_w11 = $('#dim_w11').val();
					var dim_w12 = $('#dim_w12').val();
					var dim_w13 = $('#dim_w13').val();
					var dim_w14 = $('#dim_w14').val();
					var dim_w15 = $('#dim_w15').val();
					var dim_w16 = $('#dim_w16').val();
					var dim_w17 = $('#dim_w17').val();
					var dim_w18 = $('#dim_w18').val();
					var dim_w19 = $('#dim_w19').val();
					var dim_w20 = $('#dim_w20').val();
					var dim_w21 = $('#dim_w21').val();
					var dim_w22 = $('#dim_w22').val();
					var dim_w23 = $('#dim_w23').val();
					var dim_w24 = $('#dim_w24').val();
					var dim_block1 = $('#dim_block1').val();
					var dim_block2 = $('#dim_block2').val();
					var dim_block3 = $('#dim_block3').val();
					var dim_block4 = $('#dim_block4').val();
					var dim_block5 = $('#dim_block5').val();
					var dim_block6 = $('#dim_block6').val();
					var dim_block7 = $('#dim_block7').val();
					var dim_block8 = $('#dim_block8').val();
					var dim_block9 = $('#dim_block9').val();
					var dim_block10 = $('#dim_block10').val();
					var dim_block11 = $('#dim_block11').val();
					var dim_block12 = $('#dim_block12').val();
					var dim_block13 = $('#dim_block13').val();
					var dim_block14 = $('#dim_block14').val();
					var dim_block15 = $('#dim_block15').val();
					var dim_block16 = $('#dim_block16').val();
					var dim_block17 = $('#dim_block17').val();
					var dim_block18 = $('#dim_block18').val();
					var dim_block19 = $('#dim_block19').val();
					var dim_block20 = $('#dim_block20').val();
					var dim_block21 = $('#dim_block21').val();
					var dim_block22 = $('#dim_block22').val();
					var dim_block23 = $('#dim_block23').val();
					var dim_block24 = $('#dim_block24').val();


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
					var dim_l5 = "";
					var dim_l6 = "";
					var dim_l7 = "";
					var dim_l8 = "";
					var dim_l9 = "";
					var dim_l10 = "";
					var dim_l11 = "";
					var dim_l12 = "";
					var dim_l13 = "";
					var dim_l14 = "";
					var dim_l15 = "";
					var dim_l16 = "";
					var dim_l17 = "";
					var dim_l18 = "";
					var dim_l19 = "";
					var dim_l20 = "";
					var dim_l21 = "";
					var dim_l22 = "";
					var dim_l23 = "";
					var dim_l24 = "";
					var dim_h1 = "";
					var dim_h2 = "";
					var dim_h3 = "";
					var dim_h4 = "";
					var dim_h5 = "";
					var dim_h6 = "";
					var dim_h7 = "";
					var dim_h8 = "";
					var dim_h9 = "";
					var dim_h10 = "";
					var dim_h11 = "";
					var dim_h12 = "";
					var dim_h13 = "";
					var dim_h14 = "";
					var dim_h15 = "";
					var dim_h16 = "";
					var dim_h17 = "";
					var dim_h18 = "";
					var dim_h19 = "";
					var dim_h20 = "";
					var dim_h21 = "";
					var dim_h22 = "";
					var dim_h23 = "";
					var dim_h24 = "";
					var dim_w1 = "";
					var dim_w2 = "";
					var dim_w3 = "";
					var dim_w4 = "";
					var dim_w5 = "";
					var dim_w6 = "";
					var dim_w7 = "";
					var dim_w8 = "";
					var dim_w9 = "";
					var dim_w10 = "";
					var dim_w11 = "";
					var dim_w12 = "";
					var dim_w13 = "";
					var dim_w14 = "";
					var dim_w15 = "";
					var dim_w16 = "";
					var dim_w17 = "";
					var dim_w18 = "";
					var dim_w19 = "";
					var dim_w20 = "";
					var dim_w21 = "";
					var dim_w22 = "";
					var dim_w23 = "";
					var dim_w24 = "";
					var dim_block1 = "";
					var dim_block2 = "";
					var dim_block3 = "";
					var dim_block4 = "";
					var dim_block5 = "";
					var dim_block6 = "";
					var dim_block7 = "";
					var dim_block8 = "";
					var dim_block9 = "";
					var dim_block10 = "";
					var dim_block11 = "";
					var dim_block12 = "";
					var dim_block13 = "";
					var dim_block14 = "";
					var dim_block15 = "";
					var dim_block16 = "";
					var dim_block17 = "";
					var dim_block18 = "";
					var dim_block19 = "";
					var dim_block20 = "";
					var dim_block21 = "";
					var dim_block22 = "";
					var dim_block23 = "";
					var dim_block24 = "";


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
			
			//THERMAL CONDUCTIVITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="thr")
					{
						if(document.getElementById('chk_thr').checked) {
								var chk_thr = "1";
						}
						else{
								var chk_thr = "0";
						}
																		
							var tl_1 = $('#tl_1').val();
							var tl_2 = $('#tl_2').val();
							var tl_3 = $('#tl_3').val();
							
							var th_1 = $('#th_1').val();
							var th_2 = $('#th_2').val();
							var th_3 = $('#th_3').val();
						
							var tw_1 = $('#tw_1').val();
							var tw_2 = $('#tw_2').val();
							var tw_3 = $('#tw_3').val();
						
							var tarea_1 = $('#tarea_1').val();
							var tarea_2 = $('#tarea_2').val();
							var tarea_3 = $('#tarea_3').val();
							
							var tvolt_1 = $('#tvolt_1').val();
							var tvolt_2 = $('#tvolt_2').val();
							var tvolt_3 = $('#tvolt_3').val();
							
							var tf_1_1 = $('#tf_1_1').val();
							var tf_1_2 = $('#tf_1_2').val();
							var tf_1_3 = $('#tf_1_3').val();
							
							var tf_2_1 = $('#tf_2_1').val();
							var tf_2_2 = $('#tf_2_2').val();
							var tf_2_3 = $('#tf_2_3').val();
							
							var tf_3_1 = $('#tf_3_1').val();
							var tf_3_2 = $('#tf_3_2').val();
							var tf_3_3 = $('#tf_3_3').val();
							
							var tf_avg_1 = $('#tf_avg_1').val();
							var tf_avg_2 = $('#tf_avg_2').val();
							var tf_avg_3 = $('#tf_avg_3').val();
							
							var tc_1_1 = $('#tc_1_1').val();
							var tc_1_2 = $('#tc_1_2').val();
							var tc_1_3 = $('#tc_1_3').val();
							
							var tc_2_1 = $('#tc_2_1').val();
							var tc_2_2 = $('#tc_2_2').val();
							var tc_2_3 = $('#tc_2_3').val();
							
							var tc_3_1 = $('#tc_3_1').val();
							var tc_3_2 = $('#tc_3_2').val();
							var tc_3_3 = $('#tc_3_3').val();
							
							var tc_avg_1 = $('#tc_avg_1').val();
							var tc_avg_2 = $('#tc_avg_2').val();
							var tc_avg_3 = $('#tc_avg_3').val();
							
							var thr_1 = $('#thr_1').val();
							var thr_2 = $('#thr_2').val();
							var thr_3 = $('#thr_3').val();
							
							
							var avg_thr = $('#avg_thr').val();
							var the_s_d = $('#the_s_d').val();
							var the_e_d = $('#the_e_d').val();
							
						break;
					}
					else
					{
						var chk_thr = "0";	
						var tl_1 = "";
						var tl_2 = "";
						var tl_3 = "";
						
						var th_1 = "";
						var th_2 = "";
						var th_3 = "";
					
						var tw_1 = "";
						var tw_2 = "";
						var tw_3 = "";
					
						var tarea_1 = "";
						var tarea_2 = "";
						var tarea_3 = "";
						
						var tvolt_1 = "";
						var tvolt_2 = "";
						var tvolt_3 = "";
						
						var tf_1_1 = "";
						var tf_1_2 = "";
						var tf_1_3 = "";
						
						var tf_2_1 = "";
						var tf_2_2 = "";
						var tf_2_3 = "";
						
						var tf_3_1 = "";
						var tf_3_2 = "";
						var tf_3_3 = "";
						
						var tf_avg_1 = "";
						var tf_avg_2 = "";
						var tf_avg_3 = "";
						
						var tc_1_1 = "";
						var tc_1_2 = "";
						var tc_1_3 = "";
						
						var tc_2_1 = "";
						var tc_2_2 = "";
						var tc_2_3 = "";
						
						var tc_3_1 = "";
						var tc_3_2 = "";
						var tc_3_3 = "";
						
						var tc_avg_1 = "";
						var tc_avg_2 = "";
						var tc_avg_3 = "";
						
						var thr_1 = "";
						var thr_2 = "";
						var thr_3 = "";
						
						var the_s_d = "";
						var the_e_d = "";
						var avg_thr = "";
						
					}
				}

			var idEdit = $('#idEdit').val();

			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_com=' + chk_com + '&avg_com=' + avg_com + '&sample_1=' + sample_1 + '&sample_2=' + sample_2 + '&sample_3=' + sample_3 + '&sample_4=' + sample_4 + '&sample_5=' + sample_5 + '&sample_6=' + sample_6 + '&sample_7=' + sample_7 + '&sample_8=' + sample_8 + '&sample_9=' + sample_9 + '&sample_10=' + sample_10 + '&sample_11=' + sample_11 + '&sample_12=' + sample_12 + '&l_1=' + l_1 + '&l_2=' + l_2 + '&l_3=' + l_3 + '&l_4=' + l_4 + '&l_5=' + l_5 + '&l_6=' + l_6 + '&l_7=' + l_7 + '&l_8=' + l_8 + '&l_9=' + l_9 + '&l_10=' + l_10 + '&l_11=' + l_11 + '&l_12=' + l_12 + '&w_1=' + w_1 + '&w_2=' + w_2 + '&w_3=' + w_3 + '&w_4=' + w_4 + '&w_5=' + w_5 + '&w_6=' + w_6 + '&w_7=' + w_7 + '&w_8=' + w_8 + '&w_9=' + w_9 + '&w_10=' + w_10 + '&w_11=' + w_11 + '&w_12=' + w_12 + '&h_1=' + h_1 + '&h_2=' + h_2 + '&h_3=' + h_3 + '&h_4=' + h_4 + '&h_5=' + h_5 + '&h_6=' + h_6 + '&h_7=' + h_7 + '&h_8=' + h_8 + '&h_9=' + h_9 + '&h_10=' + h_10 + '&h_11=' + h_11 + '&h_12=' + h_12 + '&load_1=' + load_1 + '&load_2=' + load_2 + '&load_3=' + load_3 + '&load_4=' + load_4 + '&load_5=' + load_5 + '&load_6=' + load_6 + '&load_7=' + load_7 + '&load_8=' + load_8 + '&load_9=' + load_9 + '&load_10=' + load_10 + '&load_11=' + load_11 + '&load_12=' + load_12 + '&area_1=' + area_1 + '&area_2=' + area_2 + '&area_3=' + area_3 + '&area_4=' + area_4 + '&area_5=' + area_5 + '&area_6=' + area_6 + '&area_7=' + area_7 + '&area_8=' + area_8 + '&area_9=' + area_9 + '&area_10=' + area_10 + '&area_11=' + area_11 + '&area_12=' + area_12 + '&com_1=' + com_1 + '&com_2=' + com_2 + '&com_3=' + com_3 + '&com_4=' + com_4 + '&com_5=' + com_5 + '&com_6=' + com_6 + '&com_7=' + com_7 + '&com_8=' + com_8 + '&com_9=' + com_9 + '&com_10=' + com_10 + '&com_11=' + com_11 + '&com_12=' + com_12 + '&mc_1=' + mc_1 + '&mc_2=' + mc_2 + '&mc_3=' + mc_3 + '&mc_4=' + mc_4 + '&mc_5=' + mc_5 + '&mc_6=' + mc_6 + '&mc_7=' + mc_7 + '&mc_8=' + mc_8 + '&mc_9=' + mc_9 + '&mc_10=' + mc_10 + '&mc_11=' + mc_11 + '&mc_12=' + mc_12 + '&w1_1=' + w1_1+ '&w1_2=' + w1_2+ '&w1_3=' + w1_3+ '&w1_4=' + w1_4+ '&w1_5=' + w1_5+ '&w1_6=' + w1_6+ '&w1_7=' + w1_7+ '&w1_8=' + w1_8+ '&w1_9=' + w1_9+ '&w1_10=' + w1_10+ '&w1_11=' + w1_11+ '&w1_12=' + w1_12+ '&chk_dim=' + chk_dim + '&dim_height=' + dim_height + '&dim_width=' + dim_width + '&dim_length=' + dim_length + '&dim_l1=' + dim_l1 + '&dim_l2=' + dim_l2 + '&dim_l3=' + dim_l3 + '&dim_l4=' + dim_l4 + '&dim_l5=' + dim_l5 + '&dim_l6=' + dim_l6 + '&dim_l7=' + dim_l7 + '&dim_l8=' + dim_l8 + '&dim_l9=' + dim_l9 + '&dim_l10=' + dim_l10 + '&dim_l11=' + dim_l11 + '&dim_l12=' + dim_l12 + '&dim_l13=' + dim_l13 + '&dim_l14=' + dim_l14 + '&dim_l15=' + dim_l15 + '&dim_l16=' + dim_l16 + '&dim_l17=' + dim_l17 + '&dim_l18=' + dim_l18 + '&dim_l19=' + dim_l19 + '&dim_l20=' + dim_l20 + '&dim_l21=' + dim_l21 + '&dim_l22=' + dim_l22 + '&dim_l23=' + dim_l23 + '&dim_l24=' + dim_l24 + '&dim_h1=' + dim_h1 + '&dim_h2=' + dim_h2 + '&dim_h3=' + dim_h3 + '&dim_h4=' + dim_h4 + '&dim_h5=' + dim_h5 + '&dim_h6=' + dim_h6 + '&dim_h7=' + dim_h7 + '&dim_h8=' + dim_h8 + '&dim_h9=' + dim_h9 + '&dim_h10=' + dim_h10 + '&dim_h11=' + dim_h11 + '&dim_h12=' + dim_h12 + '&dim_h13=' + dim_h13 + '&dim_h14=' + dim_h14 + '&dim_h15=' + dim_h15 + '&dim_h16=' + dim_h16 + '&dim_h17=' + dim_h17 + '&dim_h18=' + dim_h18 + '&dim_h19=' + dim_h19 + '&dim_h20=' + dim_h20 + '&dim_h21=' + dim_h21 + '&dim_h22=' + dim_h22 + '&dim_h23=' + dim_h23 + '&dim_h24=' + dim_h24 + '&dim_w1=' + dim_w1 + '&dim_w2=' + dim_w2 + '&dim_w3=' + dim_w3 + '&dim_w4=' + dim_w4 + '&dim_w5=' + dim_w5 + '&dim_w6=' + dim_w6 + '&dim_w7=' + dim_w7 + '&dim_w8=' + dim_w8 + '&dim_w9=' + dim_w9 + '&dim_w10=' + dim_w10 + '&dim_w11=' + dim_w11 + '&dim_w12=' + dim_w12 + '&dim_w13=' + dim_w13 + '&dim_w14=' + dim_w14 + '&dim_w15=' + dim_w15 + '&dim_w16=' + dim_w16 + '&dim_w17=' + dim_w17 + '&dim_w18=' + dim_w18 + '&dim_w19=' + dim_w19 + '&dim_w20=' + dim_w20 + '&dim_w21=' + dim_w21 + '&dim_w22=' + dim_w22 + '&dim_w23=' + dim_w23 + '&dim_w24=' + dim_w24 + '&dim_block1=' + dim_block1 + '&dim_block2=' + dim_block2 + '&dim_block3=' + dim_block3 + '&dim_block4=' + dim_block4 + '&dim_block5=' + dim_block5 + '&dim_block6=' + dim_block6 + '&dim_block7=' + dim_block7 + '&dim_block8=' + dim_block8 + '&dim_block9=' + dim_block9 + '&dim_block10=' + dim_block10 + '&dim_block11=' + dim_block11 + '&dim_block12=' + dim_block12 + '&dim_block13=' + dim_block13 + '&dim_block14=' + dim_block14 + '&dim_block15=' + dim_block15 + '&dim_block16=' + dim_block16 + '&dim_block17=' + dim_block17 + '&dim_block18=' + dim_block18 + '&dim_block19=' + dim_block19 + '&dim_block20=' + dim_block20 + '&dim_block21=' + dim_block21 + '&dim_block22=' + dim_block22 + '&dim_block23=' + dim_block23 + '&dim_block24=' + dim_block24 + '&chk_den=' + chk_den + '&dl_1=' + dl_1 + '&dl_2=' + dl_2 + '&dl_3=' + dl_3 + '&dw_1=' + dw_1 + '&dw_2=' + dw_2 + '&dw_3=' + dw_3 + '&dh_1=' + dh_1 + '&dh_2=' + dh_2 + '&dh_3=' + dh_3 + '&vol_1=' + vol_1 + '&vol_2=' + vol_2 + '&vol_3=' + vol_3 + '&weight_1=' + weight_1 + '&weight_2=' + weight_2 + '&weight_3=' + weight_3 + '&den_1=' + den_1 + '&den_2=' + den_2 + '&den_3=' + den_3 + '&wa_1=' + wa_1 + '&wa_2=' + wa_2 + '&wa_3=' + wa_3 + '&w1=' + w1 + '&w2=' + w2 + '&w3=' + w3 + '&bdl=' + bdl + '&bdl_kg=' + bdl_kg + '&mc=' + mc + '&chk_shr=' + chk_shr + '&con_1=' + con_1 + '&con_2=' + con_2 + '&con_3=' + con_3 + '&fr_1=' + fr_1 + '&fr_2=' + fr_2 + '&fr_3=' + fr_3 + '&fi_1=' + fi_1 + '&fi_2=' + fi_2 + '&fi_3=' + fi_3 + '&ds_1=' + ds_1 + '&ds_2=' + ds_2 + '&ds_3=' + ds_3 + '&avg_shrink=' + avg_shrink + '&in_l=' + in_l + '&in_w=' + in_w + '&in_h=' + in_h + '&in_den=' + in_den + '&in_grade=' + in_grade + '&con_wid_1=' + con_wid_1 + '&con_wid_2=' + con_wid_2 + '&con_wid_3=' + con_wid_3 + '&con_thi_1=' + con_thi_1 + '&con_thi_2=' + con_thi_2 + '&con_thi_3=' + con_thi_3 +'&chk_thr='+chk_thr+'&tl_1='+tl_1+'&tl_2='+tl_2+'&tl_3='+tl_3+'&tw_1='+tw_1+'&tw_2='+tw_2+'&tw_3='+tw_3+'&th_1='+th_1+'&th_2='+th_2+'&th_3='+th_3+'&tarea_1='+tarea_1+'&tarea_2='+tarea_2+'&tarea_3='+tarea_3+'&tvolt_1='+tvolt_1+'&tvolt_2='+tvolt_2+'&tvolt_3='+tvolt_3+'&tf_1_1='+tf_1_1+'&tf_1_2='+tf_1_2+'&tf_1_3='+tf_1_3+'&tf_2_1='+tf_2_1+'&tf_2_2='+tf_2_2+'&tf_2_3='+tf_2_3+'&tf_3_1='+tf_3_1+'&tf_3_2='+tf_3_2+'&tf_3_3='+tf_3_3+'&tf_avg_1='+tf_avg_1+'&tf_avg_2='+tf_avg_2+'&tf_avg_3='+tf_avg_3+'&tc_1_1='+tc_1_1+'&tc_1_2='+tc_1_2+'&tc_1_3='+tc_1_3+'&tc_2_1='+tc_2_1+'&tc_2_2='+tc_2_2+'&tc_2_3='+tc_2_3+'&tc_3_1='+tc_3_1+'&tc_3_2='+tc_3_2+'&tc_3_3='+tc_3_3+'&tc_avg_1='+tc_avg_1+'&tc_avg_2='+tc_avg_2+'&tc_avg_3='+tc_avg_3+'&thr_1='+thr_1+'&thr_2='+thr_2+'&thr_3='+thr_3+'&avg_thr='+avg_thr + '&the_s_d='+the_s_d+'&the_e_d='+the_e_d + '&idEdit=' + idEdit+ '&amend_date=' + amend_date;



		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}


		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_aac_block.php',
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
			url: '<?php echo $base_url; ?>save_aac_block.php',
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
						$('#sample_4').val(data.sample_4);
						$('#sample_5').val(data.sample_5);
						$('#sample_6').val(data.sample_6);
						$('#sample_7').val(data.sample_7);
						$('#sample_8').val(data.sample_8);
						$('#sample_9').val(data.sample_9);
						$('#sample_10').val(data.sample_10);
						$('#sample_11').val(data.sample_11);
						$('#sample_12').val(data.sample_12);


						$('#l_1').val(data.l_1);
						$('#l_2').val(data.l_2);
						$('#l_3').val(data.l_3);
						$('#l_4').val(data.l_4);
						$('#l_5').val(data.l_5);
						$('#l_6').val(data.l_6);
						$('#l_7').val(data.l_7);
						$('#l_8').val(data.l_8);
						$('#l_9').val(data.l_9);
						$('#l_10').val(data.l_10);
						$('#l_11').val(data.l_11);
						$('#l_12').val(data.l_12);

						$('#w_1').val(data.w_1);
						$('#w_2').val(data.w_2);
						$('#w_3').val(data.w_3);
						$('#w_4').val(data.w_4);
						$('#w_5').val(data.w_5);
						$('#w_6').val(data.w_6);
						$('#w_7').val(data.w_7);
						$('#w_8').val(data.w_8);
						$('#w_9').val(data.w_9);
						$('#w_10').val(data.w_10);
						$('#w_11').val(data.w_11);
						$('#w_12').val(data.w_12);

						$('#h_1').val(data.h_1);
						$('#h_2').val(data.h_2);
						$('#h_3').val(data.h_3);
						$('#h_4').val(data.h_4);
						$('#h_5').val(data.h_5);
						$('#h_6').val(data.h_6);
						$('#h_7').val(data.h_7);
						$('#h_8').val(data.h_8);
						$('#h_9').val(data.h_9);
						$('#h_10').val(data.h_10);
						$('#h_11').val(data.h_11);
						$('#h_12').val(data.h_12);

						$('#load_1').val(data.load_1);
						$('#load_2').val(data.load_2);
						$('#load_3').val(data.load_3);
						$('#load_4').val(data.load_4);
						$('#load_5').val(data.load_5);
						$('#load_6').val(data.load_6);
						$('#load_7').val(data.load_7);
						$('#load_8').val(data.load_8);
						$('#load_9').val(data.load_9);
						$('#load_10').val(data.load_10);
						$('#load_11').val(data.load_11);
						$('#load_12').val(data.load_12);

						$('#area_1').val(data.area_1);
						$('#area_2').val(data.area_2);
						$('#area_3').val(data.area_3);
						$('#area_4').val(data.area_4);
						$('#area_5').val(data.area_5);
						$('#area_6').val(data.area_6);
						$('#area_7').val(data.area_7);
						$('#area_8').val(data.area_8);
						$('#area_9 ').val(data.area_9);
						$('#area_10').val(data.area_10);
						$('#area_11').val(data.area_11);
						$('#area_12').val(data.area_12);

						$('#com_1').val(data.com_1);
						$('#com_2').val(data.com_2);
						$('#com_3').val(data.com_3);
						$('#com_4').val(data.com_4);
						$('#com_5').val(data.com_5);
						$('#com_6').val(data.com_6);
						$('#com_7').val(data.com_7);
						$('#com_8').val(data.com_8);
						$('#com_9').val(data.com_9);
						$('#com_10').val(data.com_10);
						$('#com_11').val(data.com_11);
						$('#com_12').val(data.com_12);

						$('#mc_1').val(data.mc_1);
						$('#mc_2').val(data.mc_2);
						$('#mc_3').val(data.mc_3);
						$('#mc_4').val(data.mc_4);
						$('#mc_5').val(data.mc_5);
						$('#mc_6').val(data.mc_6);
						$('#mc_7').val(data.mc_7);
						$('#mc_8').val(data.mc_8);
						$('#mc_9').val(data.mc_9);
						$('#mc_10').val(data.mc_10);
						$('#mc_11').val(data.mc_11);
						$('#mc_12').val(data.mc_12);
						
						$('#w1_1').val(data.w1_1);
						$('#w1_2').val(data.w1_2);
						$('#w1_3').val(data.w1_3);
						$('#w1_4').val(data.w1_4);
						$('#w1_5').val(data.w1_5);
						$('#w1_6').val(data.w1_6);
						$('#w1_7').val(data.w1_7);
						$('#w1_8').val(data.w1_8);
						$('#w1_9').val(data.w1_9);
						$('#w1_10').val(data.w1_10);
						$('#w1_11').val(data.w1_11);
						$('#w1_12').val(data.w1_12);
						
						


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
						$('#dim_l5').val(data.dim_l5);
						$('#dim_l6').val(data.dim_l6);
						$('#dim_l7').val(data.dim_l7);
						$('#dim_l8').val(data.dim_l8);
						$('#dim_l9').val(data.dim_l9);
						$('#dim_l10').val(data.dim_l10);
						$('#dim_l11').val(data.dim_l11);
						$('#dim_l12').val(data.dim_l12);
						$('#dim_l13').val(data.dim_l13);
						$('#dim_l14').val(data.dim_l14);
						$('#dim_l15').val(data.dim_l15);
						$('#dim_l16').val(data.dim_l16);
						$('#dim_l17').val(data.dim_l17);
						$('#dim_l18').val(data.dim_l18);
						$('#dim_l19').val(data.dim_l19);
						$('#dim_l20').val(data.dim_l20);
						$('#dim_l21').val(data.dim_l21);
						$('#dim_l22').val(data.dim_l22);
						$('#dim_l23').val(data.dim_l23);
						$('#dim_l24').val(data.dim_l24);


						$('#dim_h1').val(data.dim_h1);
						$('#dim_h2').val(data.dim_h2);
						$('#dim_h3').val(data.dim_h3);
						$('#dim_h4').val(data.dim_h4);
						$('#dim_h5').val(data.dim_h5);
						$('#dim_h6').val(data.dim_h6);
						$('#dim_h7').val(data.dim_h7);
						$('#dim_h8').val(data.dim_h8);
						$('#dim_h9').val(data.dim_h9);
						$('#dim_h10').val(data.dim_h10);
						$('#dim_h11').val(data.dim_h11);
						$('#dim_h12').val(data.dim_h12);
						$('#dim_h13').val(data.dim_h13);
						$('#dim_h14').val(data.dim_h14);
						$('#dim_h15').val(data.dim_h15);
						$('#dim_h16').val(data.dim_h16);
						$('#dim_h17').val(data.dim_h17);
						$('#dim_h18').val(data.dim_h18);
						$('#dim_h19').val(data.dim_h19);
						$('#dim_h20').val(data.dim_h20);
						$('#dim_h21').val(data.dim_h21);
						$('#dim_h22').val(data.dim_h22);
						$('#dim_h23').val(data.dim_h23);
						$('#dim_h24').val(data.dim_h24);

						$('#dim_w1').val(data.dim_w1);
						$('#dim_w2').val(data.dim_w2);
						$('#dim_w3').val(data.dim_w3);
						$('#dim_w4').val(data.dim_w4);
						$('#dim_w5').val(data.dim_w5);
						$('#dim_w6').val(data.dim_w6);
						$('#dim_w7').val(data.dim_w7);
						$('#dim_w8').val(data.dim_w8);
						$('#dim_w9').val(data.dim_w9);
						$('#dim_w10').val(data.dim_w10);
						$('#dim_w11').val(data.dim_w11);
						$('#dim_w12').val(data.dim_w12);
						$('#dim_w13').val(data.dim_w13);
						$('#dim_w14').val(data.dim_w14);
						$('#dim_w15').val(data.dim_w15);
						$('#dim_w16').val(data.dim_w16);
						$('#dim_w17').val(data.dim_w17);
						$('#dim_w18').val(data.dim_w18);
						$('#dim_w19').val(data.dim_w19);
						$('#dim_w20').val(data.dim_w20);
						$('#dim_w21').val(data.dim_w21);
						$('#dim_w22').val(data.dim_w22);
						$('#dim_w23').val(data.dim_w23);
						$('#dim_w24').val(data.dim_w24);

						$('#dim_block1').val(data.dim_block1);
						$('#dim_block2').val(data.dim_block2);
						$('#dim_block3').val(data.dim_block3);
						$('#dim_block4').val(data.dim_block4);
						$('#dim_block5').val(data.dim_block5);
						$('#dim_block6').val(data.dim_block6);
						$('#dim_block7').val(data.dim_block7);
						$('#dim_block8').val(data.dim_block8);
						$('#dim_block9').val(data.dim_block9);
						$('#dim_block10').val(data.dim_block10);
						$('#dim_block11').val(data.dim_block11);
						$('#dim_block12').val(data.dim_block12);
						$('#dim_block13').val(data.dim_block13);
						$('#dim_block14').val(data.dim_block14);
						$('#dim_block15').val(data.dim_block15);
						$('#dim_block16').val(data.dim_block16);
						$('#dim_block17').val(data.dim_block17);
						$('#dim_block18').val(data.dim_block18);
						$('#dim_block19').val(data.dim_block19);
						$('#dim_block20').val(data.dim_block20);
						$('#dim_block21').val(data.dim_block21);
						$('#dim_block22').val(data.dim_block22);
						$('#dim_block23').val(data.dim_block23);
						$('#dim_block24').val(data.dim_block24);

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
				
				//THERMAL CONDUCTIVITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="thr")
					{
						
						var chk_thr = data.chk_thr;
						if(chk_thr=="1")
						{
							$('#txtthr').css("background-color","var(--success)"); 
						   $("#chk_thr").prop("checked", true); 
						}else{
							$('#txtthr').css("background-color","white"); 
							$("#chk_thr").prop("checked", false); 
						}
								
						$('#avg_thr').val(data.avg_thr);
						
						$('#tl_1').val(data.tl_1);
						$('#tl_2').val(data.tl_2);
						$('#tl_3').val(data.tl_3);
						$('#tw_1').val(data.tw_1);
						$('#tw_2').val(data.tw_2);
						$('#tw_3').val(data.tw_3);
						$('#th_1').val(data.th_1);
						$('#th_2').val(data.th_2);
						$('#th_3').val(data.th_3);
						
						$('#tarea_1').val(data.tarea_1);
						$('#tarea_2').val(data.tarea_2);
						$('#tarea_3').val(data.tarea_3);
						
						$('#tf_1_1').val(data.tf_1_1);
						$('#tf_1_2').val(data.tf_1_2);
						$('#tf_1_3').val(data.tf_1_3);
						
						$('#tf_2_1').val(data.tf_2_1);
						$('#tf_2_2').val(data.tf_2_2);
						$('#tf_2_3').val(data.tf_2_3);
						
						$('#tf_3_1').val(data.tf_3_1);
						$('#tf_3_2').val(data.tf_3_2);
						$('#tf_3_3').val(data.tf_3_3);
						
						$('#tf_avg_1').val(data.tf_avg_1);
						$('#tf_avg_2').val(data.tf_avg_2);
						$('#tf_avg_3').val(data.tf_avg_3);
						
						$('#tc_1_1').val(data.tc_1_1);
						$('#tc_1_2').val(data.tc_1_2);
						$('#tc_1_3').val(data.tc_1_3);
						
						$('#tc_2_1').val(data.tc_2_1);
						$('#tc_2_2').val(data.tc_2_2);
						$('#tc_2_3').val(data.tc_2_3);
						
						$('#tc_3_1').val(data.tc_3_1);
						$('#tc_3_2').val(data.tc_3_2);
						$('#tc_3_3').val(data.tc_3_3);
						
						$('#tc_avg_1').val(data.tc_avg_1);
						$('#tc_avg_2').val(data.tc_avg_2);
						$('#tc_avg_3').val(data.tc_avg_3);
						
						$('#thr_1').val(data.thr_1);
						$('#thr_2').val(data.thr_2);
						$('#thr_3').val(data.thr_3);
						
						$('#tvolt_1').val(data.tvolt_1);
						$('#tvolt_2').val(data.tvolt_2);
						$('#tvolt_3').val(data.tvolt_3);
						
						
						$('#thr_1').val(data.thr_1);
						$('#thr_2').val(data.thr_2);
						$('#thr_3').val(data.thr_3);
						
						$('#the_s_d').val(data.the_s_d);
						$('#the_e_d').val(data.the_e_d);
						
																	
						break;
					}
					else
					{
						
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