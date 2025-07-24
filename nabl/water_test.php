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
	$tank_no = $row_select4['tanker_no'];
	$lot_no = $row_select4['lot_no'];
	$bitumin_grade = $row_select4['bitumin_grade'];
	$bitumin_make = $row_select4['bitumin_make'];
}

$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
$result_select2 = mysqli_query($conn, $select_query2);

if (mysqli_num_rows($result_select2) > 0) {
	$row_select2 = mysqli_fetch_assoc($result_select2);
	$start_date = $row_select2['start_date'];
	$end_date = $row_select2['end_date'];
	$day = $row_select2['days'];
	$pk_id = $row_select2['job_eng_id'];
}


?>
<!-- STYLE PUT VAIBHAV-->
<div class="content-wrapper" style="margin-left:0px !important;">
	<!-- Content Header (Page header) -->
	<section class="content">
		<!-- MENU INCLUDE VAIBHAV-->
		<?php include "menu.php";?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">CONSTRUCTION WATER</h2>
					</div>
					<!--<div class="box-default">-->
					<form class="form" id="Glazed" method="post">
						<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
						<div class="row">
							<Br>
						
							<div class="col-lg-6">
								<div class="form-group">
									<!--<label for="inputEmail3" class="col-sm-2 control-label">Job No.:</label>-->
									<div class="col-sm-2">
										<label for="chk_auto">Job No. :</label>
										<input type="checkbox" class="visually-hidden" name="chk_auto" id="chk_auto" value="chk_auto">
									</div>
									<div class="col-sm-10">
										<input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" ReadOnly>
										<!--<input type="hidden" class="form-control inputs"  id="edta" value="<?php echo $edta; ?>" name="edta" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="agno25" value="<?php echo $agno25; ?>" name="agno25" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="agno41" value="<?php echo $agno41; ?>" name="agno41" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="nh4" value="<?php echo $nh4; ?>" name="nh4" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="kmno" value="<?php echo $kmno; ?>" name="kmno" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="hcl" value="<?php echo $hcl; ?>" name="hcl" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="nh4_1" value="<?php echo $nh4_1; ?>" name="nh4_1" ReadOnly>-->
									</div>
								</div>
							</div>
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
									<div class="col-sm-2">
										<input type="hidden" class="form-control" tabindex="1" value="<?php echo $job_no; ?>" id="job_no" name="job_no" ReadOnly>
									</div>
								</div>
							</div>

						</div>
						<!-- </div> -->
						<br>
						<!-- LAB NO PUT VAIBHAV->
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									
									
									<div class="col-sm-10">
										<input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" ReadOnly>
										<input type="hidden" class="form-control inputs"  id="edta" value="<?php echo $edta; ?>" name="edta" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="agno25" value="<?php echo $agno25; ?>" name="agno25" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="agno41" value="<?php echo $agno41; ?>" name="agno41" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="nh4" value="<?php echo $nh4; ?>" name="nh4" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="kmno" value="<?php echo $kmno; ?>" name="kmno" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="hcl" value="<?php echo $hcl; ?>" name="hcl" ReadOnly>
											<input type="hidden" class="form-control inputs"  id="nh4_1" value="<?php echo $nh4_1; ?>" name="nh4_1" ReadOnly>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<div class="col-sm-2">
										<label for="chk_auto">Plant. :</label>
										<input type="checkbox" class="visually-hidden" name="chk_auto" id="chk_auto" value="chk_auto">
									</div>
									<div class="col-sm-8">
										<input type="text" class="form-control inputs" tabindex="4" id="plant" name="plant">
									</div>
								</div>
							</div>-->

						</div>
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
										<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" readonly>
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
										$querys_job1 = "SELECT * FROM water WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
									//$val1 =  $_SESSION['isadmin'];
										// $val2 =  $_SESSION['is_special'];
									//	if($val1 =="0" || $val1 =="5" || $val1 =="44" || $val2 =="1"){
									?>
										<div class="col-sm-2">
											<a target='_blank' href="<?php echo $base_url; ?>print_report/report_water_test.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>
									<?php //} ?>
										<div class="col-sm-2">
											<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_water.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

										</div>
								</div>
							</div>
						</div>
						<hr>
						<br>
						<div class="panel-group" id="accordion">
												<!--Nikunj Code Start-->
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

															<div class="col-md-3">
																<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>&&lab_no=<?php echo $lab_no; ?>">Row Data</a>
															</div>
															<div class="col-md-3">
																<label for="inputEmail3" class="col-md-12 control-label">Upload Excel :</label>
															</div>
															<div class="col-md-3">
																<input type="file" class="form-control" id="upload_excel" name="upload_excel">
															</div>
															<div class="col-md-3">
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
											<br>
										</div>
									<?php }	 ?>

		
									
								</div>
							<?php //}	 ?>

							<?php
							$test_check;
							$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
							$result_select1 = mysqli_query($conn, $select_query1);
							while ($r1 = mysqli_fetch_array($result_select1)) {

								if ($r1['test_code'] == "phv") {

									$test_check .= "phv,";
							?>
									<div class="panel panel-default" id="phv">
										<div class="panel-heading" id="txtphv">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
													<h4 class="panel-title">
														<b>PH VALUE</b>
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
																<label for="chk_phv">1.</label>
																<input type="checkbox" class="visually-hidden" name="chk_phv" id="chk_phv" value="chk_phv"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">PH VALUE</label>
														</div>
													</div>
													<div class="col-lg-6">

													</div>
												</div>
												<br>
												<!-- <div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Description</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">1</label>
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">2</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">3</label>
										</div>
									</div>
									
								</div>
								
							</div> -->


												<!-- <div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">OBSERVED VALUE</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="p1" name="p1" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="p2" name="p2" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="p3" name="p3" >
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br> -->
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">pH (at 25'C) (Pt.11)</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="text" class="form-control" id="avgp" name="avgp">
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

													</div>

												</div>
											</div>



											<br>




										</div>



									</div>
								<?php } else if ($r1['test_code'] == "hso") {
									$test_check .= "hso,"; ?>

									<div class="panel panel-default" id="hso">
										<div class="panel-heading" id="txthso">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse150">
													<h4 class="panel-title">
														<b>QUANTITY OF 0.02N H<sub>2</sub>SO<sub>4</sub> REQUIRED TO NEUTRALIZE 100 ML OF WATER (Alkalinity)</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse150" class="panel-collapse collapse">
											<div class="panel-body">
												<br>
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_hso">2.</label>
																<input type="checkbox" class="visually-hidden" name="chk_hso" id="chk_hso" value="chk_hso"><br>
															</div>
															<label for="inputEmail3" class="col-sm-8 control-label label-right">QUANTITY OF 0.02N H<sub>2</sub>SO<sub>4</sub> REQUIRED TO NEUTRALIZE 100 ML OF WATER </label>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature :</label>-->

														</div>
													</div>
												</div>
												<br>
												<!-- <div class="row">
													<div class="col-md-12">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">DESCRIPTION</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">1</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">2</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">3</label>
															</div>
														</div>

													</div>

												</div>

												<br>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">OBSERVED VALUE (ml)</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="text" class="form-control" id="h1" name="h1">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="text" class="form-control" id="h2" name="h2">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="text" class="form-control" id="h3" name="h3">
															</div>
														</div>

													</div>

												</div> -->

												<br>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">Volume of 0.02 normal H2SO4 required to neutralize 100 ml sample of water, using mixed indicator, </label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="text" class="form-control" id="avgh" name="avgh">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">ml</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">

															</div>
														</div>

													</div>

												</div>
											</div>



											<br>




										</div>



									</div>
								<?php } else if ($r1['test_code'] == "nao") {
									$test_check .= "nao,"; ?>

									<div class="panel panel-default" id="nao">
										<div class="panel-heading" id="txtnao">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse1501">
													<h4 class="panel-title">
														<b>QUANTITY OF 0.02N NaOH REQUIRED TO NEUTRALIZE 100 ML OF WATER (Acidity)</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse1501" class="panel-collapse collapse">
											<div class="panel-body">
												<br>
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_nao">3.</label>
																<input type="checkbox" class="visually-hidden" name="chk_nao" id="chk_nao" value="chk_nao"><br>
															</div>
															<label for="inputEmail3" class="col-sm-8 control-label label-right">QUANTITY OF 0.02N NaOH REQUIRED TO NEUTRALIZE 100 ML OF WATER </label>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature :</label>-->

														</div>
													</div>
												</div>
												<br>
												<!-- <div class="row">
													<div class="col-md-12">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">DESCRIPTION</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">1</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">2</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">3</label>
															</div>
														</div>

													</div>

												</div>

												<br> -->
												<!-- <div class="row">
													<div class="col-md-12">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">OBSERVED VALUE (ml)</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="text" class="form-control" id="n1" name="n1">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="text" class="form-control" id="n2" name="n2">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="text" class="form-control" id="n3" name="n3">
															</div>
														</div>

													</div>

												</div>

												<br> -->
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">Volume of 0.02 normal NaOH required to neutralize 100 ml sample of water, using phenolphthalein as an indicator , </label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<input type="text" class="form-control" id="avgn" name="avgn">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-12 control-label">ml</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">

															</div>
														</div>

													</div>

												</div>
											</div>



											<br>




										</div>



									</div>

								<?php } else if ($r1['test_code'] == "TSS") {
									$test_check .= "TSS,"; ?>

									<div class="panel panel-default" id="TSS">
										<div class="panel-heading" id="txtsoi">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31">
													<h4 class="panel-title">
														<b>DETERMINATION OF TOTAL SUSPENDED SOLIDS</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse31" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_tso">4.</label>
																<input type="checkbox" class="visually-hidden" name="chk_tso" id="chk_tso" value="chk_tso"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">DETERMINATION OF TOTAL SUSPENDED SOLIDS</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
															<div class="col-sm-8">

															</div>
														</div>
													</div>

												</div>

												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Wt. of empty<br>beaker (g)<br>A</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Wt. of beaker +<br>residue (g)<br>B </label>
														</div>
													</div>


													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Diff. in Wt. (M)<br> B - A</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Total Solids (mg/l)=<br>M X 1000 X 1000/Volume of Sample</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
														</div>
													</div>




												</div> -->
												<br>
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsa1" name="tsa1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsb1" name="tsb1">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsc1" name="tsc1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsd1" name="tsd1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ts1" name="ts1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgts" name="avgts">
															</div>
														</div>
													</div>

												</div> -->
												<br>
												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsa2" name="tsa2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsb2" name="tsb2">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsc2" name="tsc2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsd2" name="tsd2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ts2" name="ts2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">

															</div>
														</div>
													</div>

												</div> -->

												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">1 . Volume of sample taken ,ml =</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsa1" name="tsa1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">2 . weight of Petri dish+ GFC filter paper before sample filtration and  oven drying,gm</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsb1" name="tsb1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">3 . W = weight of Petri dish+ filter paper after sample filtration and oven drying, hm</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsc1" name="tsc1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">4 . Diff.in wt., gm= </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tsd1" name="tsd1" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">5 . soi=   diff.in wt * 1000 * 1000 / volume of sample taken</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgts" name="avgts" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>

											</div>
										</div>
									</div>

								<?php } else if ($r1['test_code'] == "tds") {
									$test_check .= "tds,"; ?>

									<div class="panel panel-default" id="tds">
										<div class="panel-heading" id="txttds">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31o">
													<h4 class="panel-title">
														<b>DETERMINATION OF DISSOLVED SOLIDS</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse31o" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_tds">5.</label>
																<input type="checkbox" class="visually-hidden" name="chk_tds" id="chk_tds" value="chk_tds"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">DETERMINATION OF DISSOLVED SOLIDS</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
															<div class="col-sm-8">

															</div>
														</div>
													</div>

												</div>
												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Wt. of empty<br>beaker (g)<br>A</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Wt. of beaker +<br>residue (g)<br>B </label>
														</div>
													</div>


													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Diff. in Wt. (M)<br> B - A</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Total Dissolved Solids (mg/l)=<br>M X 1000 X 1000/Volume of Sample</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
														</div>
													</div>




												</div>
												<br> -->
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tda1" name="tda1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tdb1" name="tdb1">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tdc1" name="tdc1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tdd1" name="tdd1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="td1" name="td1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgtd" name="avgtd">
															</div>
														</div>
													</div>

												</div> -->
												<br>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">1 . volume of sample taken ,ml =</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tda1" name="tda1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">2 . wt.of evaporating dish+ residue after drying 105 &plusmn; 2&deg;C,ml = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tdb1" name="tdb1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">3. wt of empty evaporating,gm =</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tdc1" name="tdc1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">4. Diff.in wt., gm= </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tdd1" name="tdd1" disabled>
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-12">
																<input type="hidden" class="form-control" id="td1" name="td1" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">5. Total dissolve  Solid = diff.in wt *1000*1000 / volume of sample taken</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgtd" name="avgtd" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>
												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tda2" name="tda2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tdb2" name="tdb2">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tdc2" name="tdc2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="tdd2" name="tdd2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="td2" name="td2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">

															</div>
														</div>
													</div>

												</div> -->

											</div>
										</div>
									</div>

								<?php } else if ($r1['test_code'] == "sus") {
									$test_check .= "sus,"; ?>

									<div class="panel panel-default" id="sus">
										<div class="panel-heading" id="txtsus">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31op">
													<h4 class="panel-title">
														<b>DETERMINATION OF SUSPENDED SOLID (sus)</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse31op" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_sus">6.</label>
																<input type="checkbox" class="visually-hidden" name="chk_sus" id="chk_sus" value="chk_sus"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">DETERMINATION OF SUSPENDED SOLID</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
															<div class="col-sm-8">

															</div>
														</div>
													</div>

												</div>
												<div class="row">
												<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">1) Volume of Sample (ml)</label>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">2)weight of Petri dish+ GFC filter paper before sample filtration and  oven drying,gm</label>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">3) W = weight of Petri dish+ filter paper after sample filtration and oven drying, hm</label>
														</div>
													</div>


													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">4) Diff.in wt., gm=</label>
														</div>
													</div>

													

													
													

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">soi (mg/l)=<br>Diff. in Wt X 1000 X 1000/Volume of Sample</label>
														</div>
													</div>

												



												</div>
												<br>
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="uua1" name="uua1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="uub1" name="uub1">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="uuc1" name="uuc1" >
															</div>
														</div>
													</div>
													
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="uu1" name="uu1" disabled>
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avguu" name="avguu" disabled>
															</div>
														</div>
													</div>

												</div>
												
											</div>
										</div>
									</div>

								<?php } else if ($r1['test_code'] == "org") {
									$test_check .= "org,"; ?>

									<div class="panel panel-default" id="org">
										<div class="panel-heading" id="txtorg">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31osp">
													<h4 class="panel-title">
														<b>DETERMINATION OF ORGANIC SOLID</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse31osp" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_org">7.</label>
																<input type="checkbox" class="visually-hidden" name="chk_org" id="chk_org" value="chk_org"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">DETERMINATION OF ORGANIC SOLID</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
															<div class="col-sm-8">

															</div>
														</div>
													</div>

												</div>


												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">1 . volume of sample taken ,ml= </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ora1" name="ora1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">2 . wt.of evaporating dish+ residue after drying 105 &plusmn; 2&deg;C,ml = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="orb1" name="orb1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">3 . wt.of evaporating dish+ residue after , ignite 550&deg; C,ml = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="orc1" name="orc1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">4 . difference in wt.,gm= </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ord1" name="ord1" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">5 . Organic Solid= diff.in wt *1000*1000 / volume of sample taken</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgor" name="avgor" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>
												<!-- <div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Wt. of Empty Evaporating Dish after evaporation of water at 105° C (g)<br>A</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Wt. of Evaporating Dish after evaporation of water at 550° C (g)<br>B </label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Diff. in Wt. (M)<br>(mg.)<br> A - B</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Total Organic Matter (mg/l)=<br>M X 1000 X 1000/Volume of Sample</label>
									</div>
									</div>

									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Average</label>
									</div>
									</div>
								
											
								</div> -->
												<br>
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<!-- <div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ora1" name="ora1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="orb1" name="orb1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="orc1" name="orc1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ord1" name="ord1" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="or1" name="or1" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="avgor" name="avgor">
									</div>
								    </div>
								</div>
								
							
							
							</div> -->
												<br>
												<!-- <div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ora2" name="ora2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="orb2" name="orb2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="orc2" name="orc2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ord2" name="ord2" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="or2" name="or2" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										
									</div>
								    </div>
								</div>
								
							</div>
								 -->
											</div>
										</div>
									</div>
								<?php } else if ($r1['test_code'] == "ino") {
									$test_check .= "ino,"; ?>

									<div class="panel panel-default" id="ino">
										<div class="panel-heading" id="txtino">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ospi">
													<h4 class="panel-title">
														<b>DETERMINATION OF INORGANIC SOLID</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse31ospi" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_ino">8.</label>
																<input type="checkbox" class="visually-hidden" name="chk_ino" id="chk_ino" value="chk_ino"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">DETERMINATION OF INORGANIC SOLID</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
															<div class="col-sm-8">

															</div>
														</div>
													</div>

												</div>

												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">1 . volume of sample taken ,ml= </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ina1" name="ina1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">2 . wt.of evaporating dish+ residue after ignite 550 &plusmn; 2&deg;C , gm = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="inb1" name="inb1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">3 .wt of empty evaporating,gm = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="inc1" name="inc1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">4 . difference in wt.,gm= </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ind1" name="ind1" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">5 . In - Organic Solid= diff.in wt *1000*1000 / volume of sample taken</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgin" name="avgin" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>

												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Wt. of Empty Evaporating Dish after evaporation of water at 105° C (g)<br>A</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Wt. of Evaporating Dish after evaporation of water at 550° C (g)<br>B </label>
														</div>
													</div>


													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Diff. in Wt. (M)<br> B - A</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Total Inorganic Matter (mg/l)=<br>M X 1000 X 1000/Volume of Sample</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
														</div>
													</div>




												</div> -->
												<!-- <br> -->
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ina1" name="ina1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="inb1" name="inb1">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="inc1" name="inc1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ind1" name="ind1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="in1" name="in1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgin" name="avgin">
															</div>
														</div>
													</div>

												</div> -->
												<!-- <br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ina2" name="ina2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="inb2" name="inb2">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="inc2" name="inc2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ind2" name="ind2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="in2" name="in2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">

															</div>
														</div>
													</div>

												</div> -->

											</div>
										</div>
									</div>
								<?php } else if ($r1['test_code'] == "chl") {
									$test_check .= "chl,"; ?>

									<div class="panel panel-default" id="chl">
										<div class="panel-heading" id="txtchl">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ospichl">
													<h4 class="panel-title">
														<b>DETERMINATION OF CHLORIDE</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse31ospichl" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_chl">9.</label>
																<input type="checkbox" class="visually-hidden" name="chk_chl" id="chk_chl" value="chk_chl"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">DETERMINATION OF CHLORIDE</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
															<div class="col-sm-8">

															</div>
														</div>
													</div>

												</div>

												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">1 . volume of sample taken ,ml= </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="cha1" name="cha1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">2 . burette reading of sample ,ml=</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chb1" name="chb1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">3 . burette reading of blank,ml =</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chc1" name="chc1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">4 . difference in reading,ml = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chd1" name="chd1" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">5 . normality of AgNO<sub>3</sub>  ,N=</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ch1" name="ch1" value="<?php echo $agno41;?>">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">6 . Chloride= diff.in reading*N *35450 / volume of sample taken</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgch" name="avgch" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>
												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Burate Reading<br>(A)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Burate Reading blank<br>(B)</label>
														</div>
													</div>


													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)<br>(V)</label>

														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">N (AgNo<sub>3</sub>)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Chloride (mg/l)=<br>(A - B) X N X 35450/V</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
														</div>
													</div>




												</div> -->
												<!-- <br> -->
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="cha1" name="cha1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chb1" name="chb1">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chc1" name="chc1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chd1" name="chd1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ch1" name="ch1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgch" name="avgch">
															</div>
														</div>
													</div>

												</div> -->
												<!-- <br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="cha2" name="cha2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chb2" name="chb2">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chc2" name="chc2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chd2" name="chd2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ch2" name="ch2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">

															</div>
														</div>
													</div>

												</div> -->

											</div>
										</div>
									</div>
								<?php } else if ($r1['test_code'] == "sul") {
									$test_check .= "sul,"; ?>

									<div class="panel panel-default" id="sul">
										<div class="panel-heading" id="txtsul">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ospisul">
													<h4 class="panel-title">
														<b>SULPHATE</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse31ospisul" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_sul">10.</label>
																<input type="checkbox" class="visually-hidden" name="chk_sul" id="chk_sul" value="chk_sul"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">SULPHATE</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
															<div class="col-sm-8">

															</div>
														</div>
													</div>
												</div>

												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">1 . volume of sample taken</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sua1" name="sua1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">2 . wt.of crucible+residue after ignition.</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sub1" name="sub1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">3 . wt.of empty crucible. =</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="suc1" name="suc1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">4 . Diff.in wt. = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sud1" name="sud1" disabled>
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">5 . SO4 =      Diff.in wt..*343*1000 / volume of sample taken</label>
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgsu" name="avgsu" disabled>
															</div>
														</div>
													</div>
												</div>
												
												<br>

												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Wt. of empty platinum crucible(g)<br>(M1)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Wt.of platinum Crucible+ residue(g)<br>(M2)</label>
														</div>
													</div>


													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Diff. in Wt. in mg<br> M = M2 - M1</label>

														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)</label>

														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Total Sulphites (mg/l)=<br>M X 343110/Volume of smaple</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
														</div>
													</div>




												</div>
												<br> -->
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<!-- <div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sua1" name="sua1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sub1" name="sub1">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="suc1" name="suc1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sud1" name="sud1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="su1" name="su1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgsu" name="avgsu">
															</div>
														</div>
													</div>

												</div> -->
												<!-- <br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sua2" name="sua2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sub2" name="sub2">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="suc2" name="suc2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sud2" name="sud2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="su2" name="su2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">

															</div>
														</div>
													</div>

												</div>
												<br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">Total = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sutotal" name="sutotal">mg/l
															</div>
														</div>
													</div>


												</div> -->

											</div>

										</div>
									</div>

								<?php } else if ($r1['test_code'] == "hrd") {
									$test_check .= "hrd,"; ?>

									<div class="panel panel-default" id="hrd">
										<div class="panel-heading" id="txthrd">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ospihrd">
													<h4 class="panel-title">
														<b>TOTAL HARDNESS</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse31ospihrd" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_hrd">11.</label>
																<input type="checkbox" class="visually-hidden" name="chk_hrd" id="chk_hrd" value="chk_hrd"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">TOTAL HARDNESS</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
															<div class="col-sm-8">

															</div>
														</div>
													</div>

												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center">A</label>
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center">V</label>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center">Reading in ml<br> N (EDTA)</label>
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center">Volume of Sample (ml)</label>
														</div>
													</div>




													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Total Hardness as CaCo<sub>3</sub> (mg/l)=<br>(A X CF X 1000)/V</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
														</div>
													</div>




												</div>
												<br>
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hra1" name="hra1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hrb1" name="hrb1">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hrc1" name="hrc1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hrd1" name="hrd1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hr1" name="hr1" disabled>
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avghr" name="avghr" disabled>
															</div>
														</div>
													</div>

												</div>
												<br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hra2" name="hra2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hrb2" name="hrb2">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hrc2" name="hrc2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hrd2" name="hrd2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hr2" name="hr2" disabled>
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">

															</div>
														</div>
													</div>

												</div>
												<br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">Total = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="hrtotal" name="hrtotal" disabled>mg/l
															</div>
														</div>
													</div>


												</div>

											</div>

										</div>
									</div>

								<?php } else if ($r1['test_code'] == "bod") {
									$test_check .= "bod,"; ?>

									<div class="panel panel-default" id="bod">
										<div class="panel-heading" id="txtbod">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ospibod">
													<h4 class="panel-title">
														<b>BIO CHEMICAL OXYGEN DEMAND</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse31ospibod" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_bod">12.</label>
																<input type="checkbox" class="visually-hidden" name="chk_bod" id="chk_bod" value="chk_bod"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">BIO CHEMICAL OXYGEN DEMAND</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
															<div class="col-sm-8">

															</div>
														</div>
													</div>

												</div>
												<br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">AVEGRAGE = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgbo" name="avgbo">mg/l
															</div>
														</div>
													</div>


												</div>

											</div>

										</div>
									</div>

								<?php } else if ($r1['test_code'] == "cod") {
									$test_check .= "cod,"; ?>

									<div class="panel panel-default" id="cod">
										<div class="panel-heading" id="txtcod">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ospicod">
													<h4 class="panel-title">
														<b>CHEMICAL OXYGEN DEMAND</b>
													</h4>
												</a>
											</h4>
										</div>
										<div id="collapse31ospicod" class="panel-collapse collapse">
											<div class="panel-body">
												<div class="row">

													<div class="col-lg-6">
														<div class="form-group">
															<div class="col-sm-1">
																<label for="chk_cod">13.</label>
																<input type="checkbox" class="visually-hidden" name="chk_cod" id="chk_cod" value="chk_cod"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">CHEMICAL OXYGEN DEMAND</label>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<!--<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature</label>-->
															<div class="col-sm-8">

															</div>
														</div>
													</div>

												</div>
												<br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<label for="inputEmail3" class="col-sm-12 control-label">AVEGRAGE = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="avgco" name="avgco">mg/l
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
										$query = "select * from water WHERE lab_no='$aa'  and `is_deleted`='0'";

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




		$('#chk_phv').change(function() {
			if (this.checked) {
				$('#txtphv').css("background-color", "var(--primary)");
			} else {
				$('#txtphv').css("background-color", "white");
			}

		});

		$('#chk_hso').change(function() {
			if (this.checked) {
				$('#txthso').css("background-color", "var(--primary)");
			} else {
				$('#txthso').css("background-color", "white");
			}

		});



		$('#chk_nao').change(function() {
			if (this.checked) {
				$('#txtnao').css("background-color", "var(--primary)");
			} else {
				$('#txtnao').css("background-color", "white");
			}

		});



		$('#chk_tso').change(function() {
			if (this.checked) {
				$('#txtsoi').css("background-color", "var(--primary)");
			} else {
				$('#txtsoi').css("background-color", "white");
			}

		});

		$('#chk_tds').change(function() {
			if (this.checked) {
				$('#txttds').css("background-color", "var(--primary)");
			} else {
				$('#txttds').css("background-color", "white");
			}

		});

		$('#chk_sus').change(function() {
			if (this.checked) {
				$('#txtsus').css("background-color", "var(--primary)");
			} else {
				$('#txtsus').css("background-color", "white");
			}

		});

		$('#chk_org').change(function() {
			if (this.checked) {
				$('#txtorg').css("background-color", "var(--primary)");
			} else {
				$('#txtorg').css("background-color", "white");
			}

		});

		$('#chk_ino').change(function() {
			if (this.checked) {
				$('#txtino').css("background-color", "var(--primary)");
			} else {
				$('#txtino').css("background-color", "white");
			}

		});

		$('#chk_chl').change(function() {
			if (this.checked) {
				$('#txtchl').css("background-color", "var(--primary)");
			} else {
				$('#txtchl').css("background-color", "white");
			}

		});

		$('#chk_sul').change(function() {
			if (this.checked) {
				$('#txtsul').css("background-color", "var(--primary)");
			} else {
				$('#txtsul').css("background-color", "white");
			}

		});

		$('#chk_hrd').change(function() {
			if (this.checked) {
				$('#txthrd').css("background-color", "var(--primary)");
			} else {
				$('#txthrd').css("background-color", "white");
			}

		});

		$('#chk_bod').change(function() {
			if (this.checked) {
				$('#txtbod').css("background-color", "var(--primary)");
			} else {
				$('#txtbod').css("background-color", "white");
			}

		});

		$('#chk_cod').change(function() {
			if (this.checked) {
				$('#txtcod').css("background-color", "var(--primary)");
			} else {
				$('#txtcod').css("background-color", "white");
			}

		});



		function phv_auto() {
			var avgp = randomNumberFromRange(7.10, 8.10);
			$('#avgp').val(avgp.toFixed(2));
			var avgp = $('#avgp').val();
			
			

			/* var i = randomNumberFromRange(-99, 99).toFixed();
			if (i % 2 == 0) {
				if (i < 99) {
					var p1 = (+avg_p) + (+0.02);
					var p2 = (+avg_p) - (+0.03);
					var p3 = (+avg_p) + (+0.01);
				} else {
					var p1 = (+avg_p) - (+0.02);
					var p2 = (+avg_p) + (+0.03);
					var p3 = (+avg_p) - (+0.01);
				}
			} else {
				if (i < 99) {
					var p1 = (+avg_p) - (+0.02);
					var p2 = (+avg_p) - (+0.01);
					var p3 = (+avg_p) + (+0.03);
				} else {
					var p1 = (+avg_p) + (+0.02);
					var p2 = (+avg_p) + (+0.01);
					var p3 = (+avg_p) - (+0.03);
				}
			}
			$('#p1').val(p1.toFixed(2));
			$('#p2').val(p2.toFixed(2));
			$('#p3').val(p3.toFixed(2)); */

		}

		$('#chk_phv').change(function() {
			if (this.checked) {
				phv_auto();

			} else {
				$('#avgp').val(null);
				// $('#p1').val(null);
				// $('#p2').val(null);
				// $('#p3').val(null);


			}
		});
		
		$('#avgp').change(function() {
			
			$('#txtphv').css("background-color", "var(--primary)");
			
		});
		
		

		/* $('#avgp').change(function() {
			if ($("#chk_phv").is(':checked')) {
				$('#txtphv').css("background-color", "var(--primary)");
				var avg_p = $('#avgp').val();

				var i = randomNumberFromRange(-99, 99).toFixed();
				if (i % 2 == 0) {
					if (i < 99) {
						var p1 = (+avg_p) + (+0.14);
						var p2 = (+avg_p) - (+0.35);
						var p3 = (+avg_p) + (+0.21);
					} else {
						var p1 = (+avg_p) - (+0.33);
						var p2 = (+avg_p) + (+0.42);
						var p3 = (+avg_p) - (+0.09);
					}
				} else {
					if (i < 99) {
						var p1 = (+avg_p) - (+0.11);
						var p2 = (+avg_p) - (+0.17);
						var p3 = (+avg_p) + (+0.28);
					} else {
						var p1 = (+avg_p) + (+0.19);
						var p2 = (+avg_p) + (+0.23);
						var p3 = (+avg_p) - (+0.42);
					}
				}
				$('#p1').val(p1.toFixed(2));
				$('#p2').val(p2.toFixed(2));
				$('#p3').val(p3.toFixed(2));
			} else {
				$('#txtphv').css("background-color", "var(--primary)");
			}

		});

		$('#p1,#p2,#p3').change(function() {
			$('#txtpen').css("background-color", "var(--primary)");
			var p1 = $('#p1').val();
			var p2 = $('#p2').val();
			var p3 = $('#p3').val();

			var avgp = ((+p1) + (+p2) + (+p3)) / 3;
			$('#avgp').val(avgp.toFixed(2));
		}); */


		function hso_auto() {
			
			var avgh = randomNumberFromRange(4,9);
			$('#avgh').val(avgh.toFixed(1));
			var avgh = $('#avgh').val();
			
			/* var avgh = randomNumberFromRange(1.50, 18.20).toFixed(1);

			var ii = randomNumberFromRange(1, 9).toFixed();
			if (ii % 2 == 0) {
				var h1 = (+avgh) + (+0.1);
				var h2 = (+avgh);
				var h3 = (+avgh) + (+0.1);
			} else {
				var h1 = (+avgh) - (+0.1);
				var h2 = (+avgh) - (+0.1);
				var h3 = (+avgh);
			}
			$('#h1').val((+h1).toFixed(1));
			$('#h2').val((+h2).toFixed(1));
			$('#h3').val((+h3).toFixed(1));

			var h1 = $('#h1').val();
			var h2 = $('#h2').val();
			var h3 = $('#h3').val();

			var avg_h = ((+h1) + (+h2) + (+h3)) / 3;
			$('#avgh').val((+avg_h).toFixed(1)); */


		}

		$('#chk_hso').change(function() {
			if (this.checked) {
				hso_auto();

			} else {
				$('#avgh').val(null);
				$('#h1').val(null);
				$('#h2').val(null);
				$('#h3').val(null);


			}
		});
		
		$('#avgh').change(function() {
			
			$('#txthso').css("background-color", "var(--primary)");
			
		});
		
		

		/* $('#avgh').change(function() {
			if ($("#chk_hso").is(':checked')) {
				$('#txthso').css("background-color", "var(--primary)");
				var avg_h = $('#avgh').val();

				var i = randomNumberFromRange(-99, 99).toFixed();
				if (i % 2 == 0) {
					if (i < 99) {
						var h1 = (+avg_h) + (+0.02);
						var h2 = (+avg_h) - (+0.03);
						var h3 = (+avg_h) + (+0.01);
					} else {
						var h1 = (+avg_h) - (+0.01);
						var h2 = (+avg_h) + (+0.03);
						var h3 = (+avg_h) - (+0.02);
					}
				} else {
					if (i < 99) {
						var h1 = (+avg_h) - (+0.02);
						var h2 = (+avg_h) - (+0.02);
						var h3 = (+avg_h) + (+0.04);
					} else {
						var h1 = (+avg_h) + (+0.01);
						var h2 = (+avg_h) + (+0.01);
						var h3 = (+avg_h) - (+0.02);
					}
				}
				$('#h1').val(h1.toFixed(2));
				$('#h2').val(h2.toFixed(2));
				$('#h3').val(h3.toFixed(2));
			} else {
				$('#txthso').css("background-color", "var(--primary)");
			}

		});

		$('#h1,#h2,#h3').change(function() {
			$('#txtpen').css("background-color", "var(--primary)");
			var h1 = $('#h1').val();
			var h2 = $('#h2').val();
			var h3 = $('#h3').val();

			var avgh = ((+h1) + (+h2) + (+h3)) / 3;
			$('#avgh').val(avgh.toFixed(2));
		}); */



		function nao_auto() {
			
			var avgn = randomNumberFromRange(0.1, 1);
			$('#avgn').val(avgn.toFixed(1));
			

			// var nn = randomNumberFromRange(1, 9).toFixed();
			// if (nn % 2 == 0) {
				// var n1 = (+avgn) + (+0.1);
				// var n2 = (+avgn);
				// var n3 = (+avgn) + (+0.1);
			// } else {
				// var n1 = (+avgn) - (+0.1);
				// var n2 = (+avgn) - (+0.1);
				// var n3 = (+avgn);
			// }
			// $('#n1').val((+n1).toFixed(1));
			// $('#n2').val((+n2).toFixed(1));
			// $('#n3').val((+n3).toFixed(1));

			// var n1 = $('#n1').val();
			// var n2 = $('#n2').val();
			// var n3 = $('#n3').val();

			// var avg_n = ((+n1) + (+n2) + (+n3)) / 3;
			// $('#avgn').val((+avg_n).toFixed(1));

		}

		$('#chk_nao').change(function() {
			if (this.checked) {
				nao_auto();

			} else {
				$('#avgn').val(null);
				$('#n1').val(null);
				$('#n2').val(null);
				$('#n3').val(null);


			}
		});
		
		$('#avgn').change(function() {
			
			$('#txtnao').css("background-color", "var(--primary)");
			
		});

		/* $('#avgn').change(function() {
			if ($("#chk_nao").is(':checked')) {
				$('#txtnao').css("background-color", "var(--primary)");
				var avg_n = $('#avgn').val();

				var i = randomNumberFromRange(-99, 99).toFixed();
				if (i % 2 == 0) {
					if (i < 99) {
						var n1 = (+avg_n) + (+0.02);
						var n2 = (+avg_n) - (+0.03);
						var n3 = (+avg_n) + (+0.01);
					} else {
						var n1 = (+avg_n) - (+0.01);
						var n2 = (+avg_n) + (+0.03);
						var n3 = (+avg_n) - (+0.02);
					}
				} else {
					if (i < 99) {
						var n1 = (+avg_n) - (+0.02);
						var n2 = (+avg_n) - (+0.02);
						var n3 = (+avg_n) + (+0.04);
					} else {
						var n1 = (+avg_n) + (+0.01);
						var n2 = (+avg_n) + (+0.01);
						var n3 = (+avg_n) - (+0.02);
					}
				}
				$('#n1').val(n1.toFixed(2));
				$('#n2').val(n2.toFixed(2));
				$('#n3').val(n3.toFixed(2));
			} else {
				$('#txtnao').css("background-color", "var(--primary)");
			}

		});

		$('#n1,#n2,#n3').change(function() {
			$('#txtpen').css("background-color", "var(--primary)");
			var n1 = $('#n1').val();
			var n2 = $('#n2').val();
			var n3 = $('#n3').val();

			var avgn = ((+n1) + (+n2) + (+n3)) / 3;
			$('#avgn').val(avgn.toFixed(2));
		}); */


		function tso_auto() {
			
			var avgts = randomNumberFromRange(6, 12).toFixed(0);
			$('#avgts').val(avgts);
			var avgts = $('#avgts').val();
			
			var tsa1 = randomNumberFromRange(1000, 1000).toFixed(0);
			$('#tsa1').val(tsa1);
			var tsa1 = $('#tsa1').val();
			
			var tsb1 = randomNumberFromRange(54.8560, 54.8600).toFixed(4);
			$('#tsb1').val((+tsb1).toFixed(4));
			var tsb1 = $('#tsb1').val();
			
			var tsd1 = (+avgts) / 1000;
			$('#tsd1').val(tsd1.toFixed(4));
			var tsd1 = $('#tsd1').val();
			
			var tsc1 = (+tsb1) + (+tsd1);
			$('#tsc1').val(tsc1.toFixed(4));
			var tsc1 = $('#tsc1').val();
			
			//sidhu
			
			var tsd_1 = (+tsc1) - (+tsb1);
			$('#tsd1').val(tsd_1.toFixed(4));
			var tsd__1 = $('#tsd1').val();
			
			var avgts1 = ((+tsd__1) * (+1000) * (+1000)) / (+tsa1);
			$('#avgts').val(avgts1.toFixed(1));

			/* var tsa1 = randomNumberFromRange(28.0281, 28.0284).toFixed(4);
			var tsa2 = (+tsa1) + 0.0001;
			$('#tsa1').val((+tsa1).toFixed(4));
			$('#tsa2').val((+tsa2).toFixed(4));

			var tsa_1 = $('#tsa1').val();
			var tsa_2 = $('#tsa2').val();

			var tsb1 = randomNumberFromRange(28.0469, 28.0470).toFixed(4);
			var tsb2 = (+tsb1) + 0.0001;

			$('#tsb1').val((+tsb1).toFixed(4));
			$('#tsb2').val((+tsb2).toFixed(4));

			var tsb_1 = $('#tsb1').val();
			var tsb_2 = $('#tsb2').val();


			var tsc1 = (+tsb_1) - (+tsa_1);
			var tsc2 = (+tsb_2) - (+tsa_2);
			$('#tsc1').val(tsc1.toFixed(4));
			$('#tsc2').val(tsc2.toFixed(4));

			var tsc_1 = $('#tsc1').val();
			var tsc_2 = $('#tsc2').val();

			var tsd1 = randomNumberFromRange(25, 25).toFixed();
			var tsd2 = randomNumberFromRange(25, 25).toFixed();
			$('#tsd1').val(tsd1);
			$('#tsd2').val(tsd2);

			var tsd_1 = $('#tsd1').val();
			var tsd_2 = $('#tsd2').val();

			var ts1 = ((+tsc_1) * (+1000) * (+1000)) / (+tsd_1);
			var ts2 = ((+tsc_2) * (+1000) * (+1000)) / (+tsd_2);
			$('#ts1').val(ts1.toFixed());
			$('#ts2').val(ts2.toFixed());

			var ts_1 = $('#ts1').val();
			var ts_2 = $('#ts2').val();

			var avgts = ((+ts_1) + (+ts_2)) / 2;
			$('#avgts').val(avgts.toFixed()); */


		}

		$('#chk_tso').change(function() {
			if (this.checked) {
				tso_auto();

			} else {
				$('#tsa1').val(null);
				$('#tsa2').val(null);
				$('#tsb1').val(null);
				$('#tsb2').val(null);
				$('#tsc1').val(null);
				$('#tsc2').val(null);
				$('#tsd1').val(null);
				$('#tsd2').val(null);
				$('#ts1').val(null);
				$('#ts2').val(null);

				$('#avgts').val(null);



			}
		});



		$('#tsa1,#tsb1,#tsc1').change(function() {
			$('#txtsoi').css("background-color", "var(--primary)");

			var tsa1 = $('#tsa1').val();
			var tsb1 = $('#tsb1').val();
			var tsc1 = $('#tsc1').val();
			
			var tsd1 = (+tsc1) - (+tsb1);
			$('#tsd1').val(tsd1.toFixed(4));
			var tsd1 = $('#tsd1').val();
			
			var avgts = ((+tsd1) * (+1000) * (+1000)) / (+tsa1);
			$('#avgts').val(avgts.toFixed(1));

		});
		

		function tds_auto() {
			
			

			var avgtd = randomNumberFromRange(120, 210).toFixed(0);
			$('#avgtd').val(avgtd);
			var avgtd = $('#avgtd').val();
			
			var tda1 = randomNumberFromRange(100, 100).toFixed(0);
			$('#tda1').val(tda1);
			var tda1 = $('#tda1').val();
			
			var tdb1 = randomNumberFromRange(64.9700, 64.9722).toFixed(4);
			$('#tdb1').val((+tdb1).toFixed(4));
			var tdb1 = $('#tdb1').val();
			
			var tdd1 = (+avgtd) / 10000;
			$('#tdd1').val(tdd1.toFixed(4));
			var tdd1 = $('#tdd1').val();
			
			var tdc1 = (+tdb1) - (+tdd1);
			$('#tdc1').val(tdc1.toFixed(4));
			var tdc1 = $('#tdc1').val();
			
			//sidhu
			
			var tdd1 = (+tdb1) - (+tdc1);
			$('#tdd1').val(tdd1.toFixed(4));
			var tdd1 = $('#tdd1').val();
			
			var avgtd1 = ((+tdd1) * (+1000) * (+1000)) / (+tda1);
			$('#avgtd').val(avgtd1.toFixed(0));
			
			


			/* var tdc1 = (+tdb_1) - (+tda_1);
			var tdc2 = (+tdb_2) - (+tda_2);
			$('#tdc1').val(tdc1.toFixed(4));
			$('#tdc2').val(tdc2.toFixed(4));

			var tdc_1 = $('#tdc1').val();
			var tdc_2 = $('#tdc2').val();

			var tdd1 = randomNumberFromRange(25, 25).toFixed();
			var tdd2 = randomNumberFromRange(25, 25).toFixed();
			$('#tdd1').val(tdd1);
			$('#tdd2').val(tdd2);

			var tdd_1 = $('#tdd1').val();
			var tdd_2 = $('#tdd2').val();

			var td1 = ((+tdc_1) * (+1000) * (+1000)) / (+tdd_1);
			var td2 = ((+tdc_2) * (+1000) * (+1000)) / (+tdd_2);
			$('#td1').val(td1.toFixed());
			$('#td2').val(td2.toFixed());

			var td_1 = $('#td1').val();
			var td_2 = $('#td2').val();

			var avgtd = ((+td_1) + (+td_2)) / 2;
			$('#avgtd').val(avgtd.toFixed()); */


		}
		
		

		$('#chk_tds').change(function() {
			if (this.checked) {
				tds_auto();

			} else {
				$('#tda1').val(null);
				$('#tda2').val(null);
				$('#tdb1').val(null);
				$('#tdb2').val(null);
				$('#tdc1').val(null);
				$('#tdc2').val(null);
				$('#tdd1').val(null);
				$('#tdd2').val(null);
				$('#td1').val(null);
				$('#td2').val(null);

				$('#avgtd').val(null);



			}
		});



		$('#tda1,#tdb1,#tdc1,#inc1,#orc1').change(function() {
			$('#txttds').css("background-color", "var(--primary)");
			
			var tda1 = $('#tda1').val();
			var tdb1 = $('#tdb1').val();
			var tdc1 = $('#tdc1').val();
			var orc1 = $('#orc1').val();
			
			var tdd1 = (+tdb1) - (+tdc1);
			$('#tdd1').val(tdd1.toFixed(4));
			var tdd1 = $('#tdd1').val();
			
			var avgtd = ((+tdd1) * (+1000) * (+1000)) / (+tda1);
			$('#avgtd').val(avgtd.toFixed(0));
			var avgtd = $('#avgtd').val();
			
			var ora1 = (+tda1);
			$('#ora1').val(ora1);
			var ora1 = $('#ora1').val();
			
			var orb1 = (+tdb1);
			$('#orb1').val(orb1);
			var orb1 = $('#orb1').val();
			
			// var ora1 = $('#ora1').val();
			var orb1 = $('#orb1').val();
			var orc1 = $('#orc1').val();
			
			var ord1 = (+orb1) - (+orc1);
			$('#ord1').val(ord1.toFixed(4));
			var ord1 = $('#ord1').val();
			
			var avgor = ((+ord1) * (+1000) * (+1000)) / (+ora1);
			$('#avgor').val(avgor.toFixed(0));
			var avgor = $('#avgor').val();
			
			var ina1 = (+tda1)
			$('#ina1').val(ina1);
			var ina1 = $('#ina1').val();
			
			var inb1 = (+orc1)
			$('#inb1').val(inb1);
			var inb1 = $('#inb1').val();
			
			var inc1 = (+tdc1)
			$('#inc1').val(inc1);
			var inc1 = $('#inc1').val();
			
			var ind1 = (+inb1) - (+inc1);
			$('#ind1').val(ind1.toFixed(4));
			var ind1 = $('#ind1').val();
			
			//sidhu
			
			var avgin = ((+ind1) * (+1000) * (+1000)) / (+ina1);
			$('#avgin').val(avgin.toFixed(0));
			var avgin = $('#avgin').val();
			
			

		});



		function sus_auto() {
			
			var avguu_ = randomNumberFromRange(6,12).toFixed(1);
			$('#avguu').val(avguu_);
			var avguu = $('#avguu').val();
			
			var uua1_ = randomNumberFromRange(1000, 1000).toFixed();			
			$('#uua1').val(uua1_);
			var uua1 = $('#uua1').val();

			var uub1_ = randomNumberFromRange(54.8560, 54.8600).toFixed(4);			
			$('#uub1').val(uub1_);			
			var uub1 = $('#uub1').val();	

			var uu1_ = (+avguu) / (+1000);
			$('#uu1').val(uu1_.toFixed(4));
			var uu1 = $('#uu1').val();
			
			var uuc1_ = (+uub1) + (+uu1);
			$('#uuc1').val(uuc1_.toFixed(4));			
			var uuc1 = $('#uuc1').val();
			
			//sidhu
			var v1 = $('#uua1').val();
			var v2 = $('#uub1').val();
			var v3 = $('#uuc1').val();
			
			var v4 = (+v3) - (+v2);
			$('#uu1').val(v4.toFixed(4));
			var uu_1 = $('#uu1').val();
			
			var v5 = ((+uu_1) * (+1000) * (+1000)) / (+v1);
			$('#avguu').val(v5.toFixed(1));
			

		}

		$('#chk_sus').change(function() {
			if (this.checked) {
				sus_auto();

			} else {
				$('#uua1').val(null);
			
				$('#uub1').val(null);
				
				$('#uuc1').val(null);
				
				
				$('#uu1').val(null);
				

				$('#avguu').val(null);



			}
		});



		$('#uua1,#uub1,#uuc1').change(function() {
			$('#txtsus').css("background-color", "var(--primary)");

			var v1 = $('#uua1').val();
			var v2 = $('#uub1').val();
			var v3 = $('#uuc1').val();
			
			var v4 = (+v3) - (+v2);
			$('#uu1').val(v4.toFixed(4));
			var uu_1 = $('#uu1').val();
			
			var v5 = ((+uu_1) * (+1000) * (+1000)) / (+v1);
			$('#avguu').val(v5.toFixed(1));
			
			
			

		});


		function org_auto() {
			
			// var tda1 = $('#tda1').val();
			// var tdb1 = $('#tdb1').val();
			// var tdc1 = $('#tdc1').val();
			
			var avgor = randomNumberFromRange(35, 60).toFixed(0);
			$('#avgor').val(avgor);
			var avgor = $('#avgor').val();
			
			var ora1 = $('#tda1').val();
			$('#ora1').val(ora1);
			var ora1 = $('#ora1').val();
			
			var orb_1 = $('#tdb1').val();			
			$('#orb1').val(orb_1);
			var orb1 = $('#orb1').val();
			
			var ord1 = (+avgor) / 10000;
			$('#ord1').val(ord1.toFixed(4));
			var ord1 = $('#ord1').val();
			
			var orc1 = (+orb1) - (+ord1);
			$('#orc1').val(orc1.toFixed(4));
			var orc1 = $('#orc1').val();
			
			//sidhu
			
			var ord1 = (+orb1) - (+orc1);
			$('#ord1').val(ord1.toFixed(4));
			var ord1 = $('#ord1').val();
			
			var avgor1 = ((+ord1) * (+1000) * (+1000)) / (+ora1);
			$('#avgor').val(avgor1.toFixed(0));
			
			/* 
			var gg = randomNumberFromRange(1, 9).toFixed();
			if (gg % 2 == 0) {
				var ora1 = randomNumberFromRange(32.9056, 32.9061).toFixed(4);
				var ora2 = (+ora1) + 0.0001;
				$('#ora1').val((+ora1).toFixed(4));
				$('#ora2').val((+ora2).toFixed(4));

				var orb1 = randomNumberFromRange(32.9026, 32.9030).toFixed(4);
				var orb2 = (+orb1) - 0.0001;
				$('#orb1').val((+orb1).toFixed(4));
				$('#orb2').val((+orb2).toFixed(4));

			} else {
				var ora1 = randomNumberFromRange(32.9056, 32.9061).toFixed(4);
				var ora2 = (+ora1) - 0.0001;
				$('#ora1').val((+ora1).toFixed(4));
				$('#ora2').val((+ora2).toFixed(4));

				var orb1 = randomNumberFromRange(32.9026, 32.9030).toFixed(4);
				var orb2 = (+orb1) + 0.0001;
				$('#orb1').val((+orb1).toFixed(4));
				$('#orb2').val((+orb2).toFixed(4));
			}


			var ora_1 = $('#ora1').val();
			var ora_2 = $('#ora2').val();

			var orb_1 = $('#orb1').val();
			var orb_2 = $('#orb2').val();


			var orc1 = (+ora_1) - (+orb_1);
			var orc2 = (+ora_2) - (+orb_2);
			$('#orc1').val(orc1.toFixed(4));
			$('#orc2').val(orc2.toFixed(4));

			var orc_1 = $('#orc1').val();
			var orc_2 = $('#orc2').val();

			var ord1 = randomNumberFromRange(25, 25).toFixed();
			var ord2 = randomNumberFromRange(25, 25).toFixed();
			$('#ord1').val(ord1);
			$('#ord2').val(ord2);

			var ord_1 = $('#ord1').val();
			var ord_2 = $('#ord2').val();

			var or1 = ((+orc_1) * (+1000) * (+1000)) / (+ord_1);
			var or2 = ((+orc_2) * (+1000) * (+1000)) / (+ord_2);
			$('#or1').val(or1.toFixed());
			$('#or2').val(or2.toFixed());

			var or_1 = $('#or1').val();
			var or_2 = $('#or2').val();

			var avgor = ((+or_1) + (+or_2)) / 2;
			$('#avgor').val(avgor.toFixed()); */


		}

		$('#chk_org').change(function() {
			if (this.checked) {
				org_auto();

			} else {
				$('#ora1').val(null);
				$('#ora2').val(null);
				$('#orb1').val(null);
				$('#orb2').val(null);
				$('#orc1').val(null);
				$('#orc2').val(null);
				$('#ord1').val(null);
				$('#ord2').val(null);
				$('#or1').val(null);
				$('#or2').val(null);

				$('#avgor').val(null);



			}
		});



		// $('#ora1,#orb1,#ord1,#orc1').change(function() {
			// $('#txtorg').css("background-color", "var(--primary)");

			// var ora1 = $('#tda1').val();
			// var orb1 = $('#orb1').val();
			// var orc1 = $('#orc1').val();
			
			// var ord1 = (+orb1) - (+orc1);
			// $('#ord1').val(ord1.toFixed(4));
			// var ord1 = $('#ord1').val();
			
			// var avgor = ((+ord1) * (+1000) * (+1000)) / (+ora1);
			// $('#avgor').val(avgor.toFixed(0));
			// var avgor = $('#avgor').val();

		// });

		function ino_auto() {
			
			
			// var avgin = randomNumberFromRange(50, 100).toFixed(0);
			// $('#avgin').val(avgin);
			// var avgin = $('#avgin').val();
			
			var orc1 = $('#orc1').val();
			var tdc1 = $('#tdc1').val();
			
			var ina1 = $('#ora1').val();
			$('#ina1').val(ina1);
			var ina1 = $('#ina1').val();
			
			$('#inb1').val((+orc1).toFixed(4));
			var inb1 = $('#inb1').val();
			
			$('#inc1').val((+tdc1).toFixed(4));
			var inc1 = $('#inc1').val();
			
			var ind1 = (+inb1) - (+inc1);
			$('#ind1').val(ind1.toFixed(4));
			var ind1 = $('#ind1').val();
			
			//sidhu
			
			var avgin = ((+ind1) * (+1000) * (+1000)) / (+ina1);
			$('#avgin').val(avgin.toFixed(0));
			var avgin = $('#avgin').val();
			
			

		}

		$('#chk_ino').change(function() {
			if (this.checked) {
				ino_auto();

			} else {
				$('#ina1').val(null);
				$('#ina2').val(null);
				$('#inb1').val(null);
				$('#inb2').val(null);
				$('#inc1').val(null);
				$('#inc2').val(null);
				$('#ind1').val(null);
				$('#ind2').val(null);
				$('#in1').val(null);
				$('#in2').val(null);

				$('#avgin').val(null);



			}
		});



		// $('#ina1,#inb1,#inc1').change(function() {
			// $('#txtino').css("background-color", "var(--primary)");

			// var ina1 = $('#ora1').val();
			// var inb1 = $('#orc1').val();
			// var inc1 = $('#inc1').val();
			
			

			// var ind1 = (+inb1) - (+inc1);
			// $('#ind1').val(ind1.toFixed(4));
			// var ind1 = $('#ind1').val();
			
			// sidhu
			
			// var avgin = ((+ind1) * (+1000) * (+1000)) / (+ina1);
			// $('#avgin').val(avgin.toFixed(0));
			// var avgin = $('#avgin').val();

		// });


		function chl_auto() {
			
			var avgch = randomNumberFromRange(40, 60).toFixed(2);
			$('#avgch').val(avgch);
			var avgch = $('#avgch').val();
			
			var cha1 = randomNumberFromRange(100, 100).toFixed(0);
			$('#cha1').val(cha1);
			var cha1 = $('#cha1').val();
			
			var chc1 = randomNumberFromRange(0.4, 0.6).toFixed(1);
			$('#chc1').val(chc1);
			var chc1 = $('#chc1').val();
			
			/* var ch1 = randomNumberFromRange(0.0140, 0.0140).toFixed(4);
			$('#ch1').val(ch1); */
			var ch1 = randomNumberFromRange(0.0141, 0.0141).toFixed(4);
			$('#ch1').val(ch1);

			var chd_1 = $('#chd1').val();
			var ch1 = $('#ch1').val();
			
			var chd1 = ((+avgch) * (+cha1)) / ((+ch1) * 35450);
			$('#chd1').val(chd1.toFixed(1));
			var chd1 = $('#chd1').val();
			
			var chb1 = (+chd1) * (+chc1);
			$('#chb1').val(chb1.toFixed(1));
			var chb1 = $('#chb1').val();
			
			
			//sidhu
			
			var chd_1 = (+chb1) - (+chc1);
			$('#chd1').val(chd_1.toFixed(1));
			var chd__1 = $('#chd1').val();
			
			var avgch1 = ((+chd__1) * (+ch1) * (+35450)) / (+cha1);
			$('#avgch').val(avgch1.toFixed(2));
			
			
			/* 
			var kk = randomNumberFromRange(1, 9).toFixed();
			if (kk % 2 == 0) {
				var cha1 = randomNumberFromRange(2.00, 5.00).toFixed(1);
				var cha2 = (+cha1) + 0.1;
				$('#cha1').val((+cha1).toFixed(1));
				$('#cha2').val((+cha2).toFixed(1));

			} else {
				var cha1 = randomNumberFromRange(2.00, 5.00).toFixed(1);
				var cha2 = (+cha1) - 0.1;
				$('#cha1').val((+cha1).toFixed(1));
				$('#cha2').val((+cha2).toFixed(1));
			}


			var cha_1 = $('#cha1').val();
			var cha_2 = $('#cha2').val();

			var chb1 = randomNumberFromRange(0.10, 0.10).toFixed(2);
			var chb2 = randomNumberFromRange(0.10, 0.10).toFixed(2);
			$('#chb1').val(chb1);
			$('#chb2').val(chb2);

			var chb_1 = $('#chb1').val();
			var chb_2 = $('#chb2').val();


			var chc1 = randomNumberFromRange(25, 25).toFixed();
			var chc2 = randomNumberFromRange(25, 25).toFixed();
			$('#chc1').val(chc1);
			$('#chc2').val(chc2);

			var chc_1 = $('#chc1').val();
			var chc_2 = $('#chc2').val();

			var chd1 = randomNumberFromRange(0.0141, 0.0141).toFixed(4);
			var chd2 = randomNumberFromRange(0.0141, 0.0141).toFixed(4);
			$('#chd1').val(chd1);
			$('#chd2').val(chd2);

			var chd_1 = $('#chd1').val();
			var chd_2 = $('#chd2').val();

			var ch1 = (((+cha_1) - (+chb_1)) * (+chd_1) * (+35450)) / (+chc_1);
			var ch2 = (((+cha_2) - (+chb_2)) * (+chd_2) * (+35450)) / (+chc_2);
			$('#ch1').val(ch1.toFixed(2));
			$('#ch2').val(ch2.toFixed(2));

			var ch_1 = $('#ch1').val();
			var ch_2 = $('#ch2').val();

			var avgch = ((+ch_1) + (+ch_2)) / 2;
			$('#avgch').val(avgch.toFixed(2)); */


		}

		$('#chk_chl').change(function() {
			if (this.checked) {
				chl_auto();

			} else {
				$('#cha1').val(null);
				$('#cha2').val(null);
				$('#chb1').val(null);
				$('#chb2').val(null);
				$('#chc1').val(null);
				$('#chc2').val(null);
				$('#chd1').val(null);
				$('#chd2').val(null);
				//$('#ch1').val(null);
				$('#ch2').val(null);

				$('#avgch').val(null);



			}
		});



		$('#cha1,#chb1,#ch1,#chc1').change(function() {
			$('#txtchl').css("background-color", "var(--primary)");


			var cha1 = $('#cha1').val();
			var chb1 = $('#chb1').val();
			var chc1 = $('#chc1').val();
			var ch1 = $('#ch1').val();
			
			var chd1 = (+chb1) - (+chc1);
			$('#chd1').val(chd1.toFixed(1));
			var chd1 = $('#chd1').val();
			
			var avgch1 = ((+chd1) * (+ch1) * (+35450)) / (+cha1);
			$('#avgch').val(avgch1.toFixed(2));

		});


		function sul_auto() {
			
			var avgsu = randomNumberFromRange(50, 70).toFixed(2);
			$('#avgsu').val(avgsu);
			var avgsu = $('#avgsu').val();
			
			var sua1 = randomNumberFromRange(100, 100).toFixed(0);
			$('#sua1').val(sua1);
			var sua1 = $('#sua1').val();
			
			var sub1 = randomNumberFromRange(28.7700, 28.7795).toFixed(4);
			$('#sub1').val(sub1);
			var sub1 = $('#sub1').val();
			
			var sud1 = (+avgsu) * ((+sua1) / (+343000));
			$('#sud1').val(sud1.toFixed(3));
			var sud1 = $('#sud1').val();
			
			var suc1 = (+sub1) - (+sud1);
			$('#suc1').val(suc1.toFixed(4));
			var suc1 = $('#suc1').val();
			
			
			//sidhu
			
			var sud_1 = (+sub1) - (+suc1);
			$('#sud1').val(sud_1.toFixed(3));
			var sud__1 = $('#sud1').val();
			
			var avgsu1 = ((+sud__1) * (+343) * (+1000)) / (+sua1);
			$('#avgsu').val(avgsu1.toFixed(2));
			
			/* 
			var kk = randomNumberFromRange(1, 9).toFixed();
			if (kk % 2 == 0) {
				var sua1 = randomNumberFromRange(40.1910, 40.1914).toFixed(4);
				var sua2 = (+sua1) + 0.0001;
				$('#sua1').val((+sua1).toFixed(4));
				$('#sua2').val((+sua2).toFixed(4));

				var sub1 = randomNumberFromRange(40.2788, 40.2798).toFixed(4);
				var sub2 = (+sub1) - 0.0001;
				$('#sub1').val((+sub1).toFixed(4));
				$('#sub2').val((+sub2).toFixed(4));
			} else {
				var sua1 = randomNumberFromRange(40.1910, 40.1914).toFixed(4);
				var sua2 = (+sua1) - 0.0001;
				$('#sua1').val((+sua1).toFixed(4));
				$('#sua2').val((+sua2).toFixed(4));

				var sub1 = randomNumberFromRange(40.2788, 40.2798).toFixed(4);
				var sub2 = (+sub1) + 0.0001;
				$('#sub1').val((+sub1).toFixed(4));
				$('#sub2').val((+sub2).toFixed(4));
			}




			var sua_1 = $('#sua1').val();
			var sua_2 = $('#sua2').val();

			var sub_1 = $('#sub1').val();
			var sub_2 = $('#sub2').val();


			var suc1 = (+sub_1) - (+sua_1);
			var suc2 = (+sub_2) - (+sua_2);
			$('#suc1').val(suc1.toFixed(4));
			$('#suc2').val(suc2.toFixed(4));

			var suc_1 = $('#suc1').val();
			var suc_2 = $('#suc2').val();

			var sud1 = randomNumberFromRange(150, 150).toFixed();
			var sud2 = randomNumberFromRange(150, 150).toFixed();
			$('#sud1').val(sud1);
			$('#sud2').val(sud2);

			var sud_1 = $('#sud1').val();
			var sud_2 = $('#sud2').val();

			var su1 = ((+suc_1) * (+343110)) / (+sud_1);
			var su2 = ((+suc_2) * (+343110)) / (+sud_2);
			$('#su1').val(su1.toFixed());
			$('#su2').val(su2.toFixed());

			var su_1 = $('#su1').val();
			var su_2 = $('#su2').val();

			var avgsu = ((+su_1) + (+su_2)) / 2;
			$('#avgsu').val(avgsu.toFixed()); */
		}

		$('#chk_sul').change(function() {
			if (this.checked) {
				sul_auto();

			} else {
				$('#sua1').val(null);
				$('#sua2').val(null);
				$('#sub1').val(null);
				$('#sub2').val(null);
				$('#suc1').val(null);
				$('#suc2').val(null);
				$('#sud1').val(null);
				$('#sud2').val(null);
				$('#su1').val(null);
				$('#su2').val(null);

				$('#avgsu').val(null);
				$('#sutotal').val(null);



			}
		});



		$('#sua1,#sub1,#suc1').change(function() {
			$('#txtsul').css("background-color", "var(--primary)");


			var sua1 = $('#sua1').val();
			var sub1 = $('#sub1').val();
			var suc1 = $('#suc1').val();
			
			var sud1 = (+sub1) - (+suc1);
			$('#sud1').val(sud1.toFixed(4));
			var sud1 = $('#sud1').val();
			
			var avgsu = ((+sud1) * (+343) * (+1000)) / (+sua1);
			$('#avgsu').val(avgsu.toFixed(2));

		});

		function hrd_auto() {

			var hra1 = randomNumberFromRange(0.10, 0.10).toFixed(2);
			var hra2 = randomNumberFromRange(0.10, 0.10).toFixed(2);
			$('#hra1').val(hra1);
			$('#hra2').val(hra2);
			var uu = randomNumberFromRange(1, 9).toFixed();
			if (uu % 2 == 0) {
				var hardness_b = randomNumberFromRange(7.00, 9.00).toFixed(1);
				var hrb1 = (+hardness_b);
				var hrb2 = (+hardness_b) + 0.1;

				$('#hrb1').val((+hrb1).toFixed(1));
				$('#hrb2').val((+hrb2).toFixed(1));
			} else {
				var hardness_b = randomNumberFromRange(7.00, 9.00).toFixed(1);
				var hrb1 = (+hardness_b) + 0.1;
				var hrb2 = (+hardness_b);

				$('#hrb1').val((+hrb1).toFixed(1));
				$('#hrb2').val((+hrb2).toFixed(1));
			}

			var hra_1 = $('#hra1').val();
			var hra_2 = $('#hra2').val();

			var hrb_1 = $('#hrb1').val();
			var hrb_2 = $('#hrb2').val();

			var hrtotal = (+hrb_1) + (+hrb_2);
			$('#hrtotal').val((+hrtotal).toFixed(1));

			var hrb_diff1 = (+hrb_1) - (+hra_1);
			var hrb_diff2 = (+hrb_2) - (+hra_2);


			var hrc1 = randomNumberFromRange(0.9909, 0.9909).toFixed(4);
			var hrc2 = randomNumberFromRange(0.9909, 0.9909).toFixed(4);
			var hrd1 = randomNumberFromRange(25, 25).toFixed();
			var hrd2 = randomNumberFromRange(25, 25).toFixed();
			$('#hrc1').val(hrc1);
			$('#hrc2').val(hrc2);
			$('#hrd1').val(hrd1);
			$('#hrd2').val(hrd2);


			var hrc_1 = $('#hrc1').val();
			var hrc_2 = $('#hrc2').val();

			var hrd_1 = $('#hrd1').val();
			var hrd_2 = $('#hrd2').val();

			var hr1 = ((+hrb_diff1) * (+hrc_1) * (+1000)) / (+hrd_1);
			var hr2 = ((+hrb_diff2) * (+hrc_2) * (+1000)) / (+hrd_2);
			$('#hr1').val(hr1.toFixed(2));
			$('#hr2').val(hr2.toFixed(2));

			var hr_1 = $('#hr1').val();
			var hr_2 = $('#hr2').val();

			var avghr = ((+hr_1) + (+hr_2)) / 2;
			$('#avghr').val(avghr.toFixed(2));


		}

		$('#chk_hrd').change(function() {
			if (this.checked) {
				hrd_auto();

			} else {
				$('#hra1').val(null);
				$('#hra2').val(null);
				$('#hrb1').val(null);
				$('#hrb2').val(null);
				$('#hrc1').val(null);
				$('#hrc2').val(null);
				$('#hrd1').val(null);
				$('#hrd2').val(null);
				$('#hr1').val(null);
				$('#hr2').val(null);

				$('#avghr').val(null);
				$('#hrtotal').val(null);



			}
		});



		$('#hra1,#hra2,#hrb1,#hrb2,#hrd1,#hrd2').change(function() {
			$('#txthrd').css("background-color", "var(--primary)");



			var hra_1 = $('#hra1').val();
			var hra_2 = $('#hra2').val();
			var hrb_1 = $('#hrb1').val();
			var hrb_2 = $('#hrb2').val();





			var hrc_1 = $('#hrc1').val();
			var hrc_2 = $('#hrc2').val();


			var hrd_1 = $('#hrd1').val();
			var hrd_2 = $('#hrd2').val();

			var hr1 = ((+hrb_1) * (+hrc_1) * (+1000)) / (+hrd_1);
			var hr2 = ((+hrb_2) * (+hrc_2) * (+1000)) / (+hrd_2);
			$('#hr1').val(hr1.toFixed(2));
			$('#hr2').val(hr2.toFixed(2));

			var hr_1 = $('#hr1').val();
			var hr_2 = $('#hr2').val();

			var avghr = ((+hr_1) + (+hr_2)) / 2;
			$('#avghr').val(avghr.toFixed(2));

		});

		function bod_auto() {

			var avgbo = randomNumberFromRange(32.00, 35.00).toFixed(2);

			$('#avgbo').val(avgbo);




		}

		$('#chk_bod').change(function() {
			if (this.checked) {
				bod_auto();

			} else {

				$('#avgbo').val(null);


			}
		});

		function cod_auto() {

			var avgco = randomNumberFromRange(170.00, 175.00).toFixed(2);

			$('#avgco').val(avgco);




		}

		$('#chk_cod').change(function() {
			if (this.checked) {
				cod_auto();

			} else {

				$('#avgco').val(null);


			}
		});




		$('#chk_auto').change(function() {
			if (this.checked) {
				//$('#txtabr').css("background-color","var(--primary)"); 
				//$('#txtwtr').css("background-color","var(--primary)"); 


				var temp = $('#test_list').val();
				var aa = temp.split(",");

				//phv
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "phv") {
						$('#txtphv').css("background-color", "var(--primary)");
						$("#chk_phv").prop("checked", true);
						phv_auto();
						break;
					}
				}

				//hso
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "hso") {
						$('#txthso').css("background-color", "var(--primary)");
						$("#chk_hso").prop("checked", true);
						hso_auto()
						break;
					}
				}

				//nao
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "nao") {
						$('#txtnao').css("background-color", "var(--primary)");
						$("#chk_nao").prop("checked", true);
						nao_auto();
						break;
					}
				}

				//TSS
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "TSS") {
						$('#txtsoi').css("background-color", "var(--primary)");
						$("#chk_tso").prop("checked", true);
						tso_auto();
						break;
					}
				}

				//tds
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "tds") {
						$('#txttds').css("background-color", "var(--primary)");
						$("#chk_tds").prop("checked", true);
						tds_auto();
						break;
					}
				}

				//sus
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sus") {
						$('#txtsus').css("background-color", "var(--primary)");
						$("#chk_sus").prop("checked", true);
						sus_auto();
						break;
					}
				}

				//org
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "org") {
						$('#txtorg').css("background-color", "var(--primary)");
						$("#chk_org").prop("checked", true);
						org_auto();
						break;
					}
				}

				//ino
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "ino") {
						$('#txtino').css("background-color", "var(--primary)");
						$("#chk_ino").prop("checked", true);
						ino_auto();
						break;
					}
				}

				//chl
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "chl") {
						$('#txtchl').css("background-color", "var(--primary)");
						$("#chk_chl").prop("checked", true);
						chl_auto();
						break;
					}
				}

				//sul
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sul") {
						$('#txtsul').css("background-color", "var(--primary)");
						$("#chk_sul").prop("checked", true);
						sul_auto();
						break;
					}
				}

				//hrd
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "hrd") {
						$('#txthrd').css("background-color", "var(--primary)");
						$("#chk_hrd").prop("checked", true);
						hrd_auto();
						break;
					}
				}

				//bod
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "bod") {
						$('#txtbod').css("background-color", "var(--primary)");
						$("#chk_bod").prop("checked", true);
						bod_auto();
						break;
					}
				}

				//cod
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "cod") {
						$('#txtcod').css("background-color", "var(--primary)");
						$("#chk_cod").prop("checked", true);
						cod_auto();
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

	function randomNumberFromRange(min, max) {
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}

	function getGlazedTiles() {
		var lab_no = $('#lab_no').val();
		var report_no = $('#report_no').val();
		var job_no = $('#job_no').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_water_span.php',
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
			var plant = $('#plant').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//phv
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "phv") {
					if (document.getElementById('chk_phv').checked) {
						var chk_phv = "1";
					} else {
						var chk_phv = "0";
					}


					var p1 = $('#p1').val();
					var p2 = $('#p2').val();
					var p3 = $('#p3').val();
					var avgp = $('#avgp').val();

					break;
				} else {
					var chk_phv = "0";

					var p1 = "0";
					var p2 = "0";
					var p3 = "0";
					var avgp = "0";
				}

			}


			//hso
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "hso") {
					if (document.getElementById('chk_hso').checked) {
						var chk_hso = "1";
					} else {
						var chk_hso = "0";
					}


					var h1 = $('#h1').val();
					var h2 = $('#h2').val();
					var h3 = $('#h3').val();
					var avgh = $('#avgh').val();

					break;
				} else {
					var chk_hso = "0";

					var h1 = "0";
					var h2 = "0";
					var h3 = "0";
					var avgh = "0";
				}

			}


			//nao
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "nao") {
					if (document.getElementById('chk_nao').checked) {
						var chk_nao = "1";
					} else {
						var chk_nao = "0";
					}


					var n1 = $('#n1').val();
					var n2 = $('#n2').val();
					var n3 = $('#n3').val();
					var avgn = $('#avgn').val();

					break;
				} else {
					var chk_nao = "0";

					var n1 = "0";
					var n2 = "0";
					var n3 = "0";
					var avgn = "0";
				}

			}


			//TSS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "TSS") {
					if (document.getElementById('chk_tso').checked) {
						var chk_tso = "1";
					} else {
						var chk_tso = "0";
					}
					//specific gravity and water abrasion-5							
					var tsa1 = $('#tsa1').val();
					var tsa2 = $('#tsa2').val();
					var tsb1 = $('#tsb1').val();
					var tsb2 = $('#tsb2').val();
					var tsc1 = $('#tsc1').val();
					var tsc2 = $('#tsc2').val();
					var tsd1 = $('#tsd1').val();
					var tsd2 = $('#tsd2').val();
					var ts1 = $('#ts1').val();
					var ts2 = $('#ts2').val();
					var avgts = $('#avgts').val();

					break;
				} else {
					var chk_tso = "0";
					var tsa1 = "0";
					var tsa2 = "0";
					var tsb1 = "0";
					var tsb2 = "0";
					var tsc1 = "0";
					var tsc2 = "0";
					var tsd1 = "0";
					var tsd2 = "0";
					var ts1 = "0";
					var ts2 = "0";
					var avgts = "0";
				}

			}

			//tds
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "tds") {
					if (document.getElementById('chk_tds').checked) {
						var chk_tds = "1";
					} else {
						var chk_tds = "0";
					}
					//specific gravity and water abrasion-5							
					var tda1 = $('#tda1').val();
					var tda2 = $('#tda2').val();
					var tdb1 = $('#tdb1').val();
					var tdb2 = $('#tdb2').val();
					var tdc1 = $('#tdc1').val();
					var tdc2 = $('#tdc2').val();
					var tdd1 = $('#tdd1').val();
					var tdd2 = $('#tdd2').val();
					var td1 = $('#td1').val();
					var td2 = $('#td2').val();
					var avgtd = $('#avgtd').val();

					break;
				} else {
					var chk_tds = "0";
					var tda1 = "0";
					var tda2 = "0";
					var tdb1 = "0";
					var tdb2 = "0";
					var tdc1 = "0";
					var tdc2 = "0";
					var tdd1 = "0";
					var tdd2 = "0";
					var td1 = "0";
					var td2 = "0";
					var avgtd = "0";
				}

			}

			//sus
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sus") {
					if (document.getElementById('chk_sus').checked) {
						var chk_sus = "1";
					} else {
						var chk_sus = "0";
					}
					//specific gravity and water abrasion-5							
					var uua1 = $('#uua1').val();
					var uua2 = "";
					var uub1 = $('#uub1').val();
					var uub2 = "";
					var uuc1 = $('#uuc1').val();
					var uuc2 = "";
					var uud1 = "";
					var uud2 = "";
					var uu1 = $('#uu1').val();
					var uu2 = "";
					var avguu = $('#avguu').val();

					break;
				} else {
					var chk_sus = "0";
					var uua1 = "0";
					var uua2 = "0";
					var uub1 = "0";
					var uub2 = "0";
					var uuc1 = "0";
					var uuc2 = "0";
					var uud1 = "0";
					var uud2 = "0";
					var uu1 = "0";
					var uu2 = "0";
					var avguu = "0";
				}

			}

			//org
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "org") {
					if (document.getElementById('chk_org').checked) {
						var chk_org = "1";
					} else {
						var chk_org = "0";
					}
					//specific gravity and water abrasion-5							
					var ora1 = $('#ora1').val();
					var ora2 = $('#ora2').val();
					var orb1 = $('#orb1').val();
					var orb2 = $('#orb2').val();
					var orc1 = $('#orc1').val();
					var orc2 = $('#orc2').val();
					var ord1 = $('#ord1').val();
					var ord2 = $('#ord2').val();
					var or1 = $('#or1').val();
					var or2 = $('#or2').val();
					var avgor = $('#avgor').val();

					break;
				} else {
					var chk_org = "0";
					var ora1 = "0";
					var ora2 = "0";
					var orb1 = "0";
					var orb2 = "0";
					var orc1 = "0";
					var orc2 = "0";
					var ord1 = "0";
					var ord2 = "0";
					var or1 = "0";
					var or2 = "0";
					var avgor = "0";
				}

			}

			//ino
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "ino") {
					if (document.getElementById('chk_ino').checked) {
						var chk_ino = "1";
					} else {
						var chk_ino = "0";
					}
					//specific gravity and water abrasion-5							
					var ina1 = $('#ina1').val();
					var ina2 = $('#ina2').val();
					var inb1 = $('#inb1').val();
					var inb2 = $('#inb2').val();
					var inc1 = $('#inc1').val();
					var inc2 = $('#inc2').val();
					var ind1 = $('#ind1').val();
					var ind2 = $('#ind2').val();
					var in1 = $('#in1').val();
					var in2 = $('#in2').val();
					var avgin = $('#avgin').val();

					break;
				} else {
					var chk_ino = "0";
					var ina1 = "0";
					var ina2 = "0";
					var inb1 = "0";
					var inb2 = "0";
					var inc1 = "0";
					var inc2 = "0";
					var ind1 = "0";
					var ind2 = "0";
					var in1 = "0";
					var in2 = "0";
					var avgin = "0";
				}

			}

			//chl
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "chl") {
					if (document.getElementById('chk_chl').checked) {
						var chk_chl = "1";
					} else {
						var chk_chl = "0";
					}
					//specific gravity and water abrasion-5							
					var cha1 = $('#cha1').val();
					var cha2 = $('#cha2').val();
					var chb1 = $('#chb1').val();
					var chb2 = $('#chb2').val();
					var chc1 = $('#chc1').val();
					var chc2 = $('#chc2').val();
					var chd1 = $('#chd1').val();
					var chd2 = $('#chd2').val();
					var ch1 = $('#ch1').val();
					var ch2 = $('#ch2').val();
					var avgch = $('#avgch').val();

					break;
				} else {
					var chk_chl = "0";
					var cha1 = "0";
					var cha2 = "0";
					var chb1 = "0";
					var chb2 = "0";
					var chc1 = "0";
					var chc2 = "0";
					var chd1 = "0";
					var chd2 = "0";
					var ch1 = "0";
					var ch2 = "0";
					var avgch = "0";
				}

			}

			//sul
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sul") {
					if (document.getElementById('chk_sul').checked) {
						var chk_sul = "1";
					} else {
						var chk_sul = "0";
					}
					//specific gravity and water abrasion-5							
					var sua1 = $('#sua1').val();
					var sua2 = $('#sua2').val();
					var sub1 = $('#sub1').val();
					var sub2 = $('#sub2').val();
					var suc1 = $('#suc1').val();
					var suc2 = $('#suc2').val();
					var sud1 = $('#sud1').val();
					var sud2 = $('#sud2').val();
					var su1 = $('#su1').val();
					var su2 = $('#su2').val();
					var avgsu = $('#avgsu').val();
					var sutotal = $('#sutotal').val();

					break;
				} else {
					var chk_sul = "0";
					var sua1 = "0";
					var sua2 = "0";
					var sub1 = "0";
					var sub2 = "0";
					var suc1 = "0";
					var suc2 = "0";
					var sud1 = "0";
					var sud2 = "0";
					var su1 = "0";
					var su2 = "0";
					var avgsu = "0";
					var sutotal = "0";
				}

			}

			//hrd
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "hrd") {
					if (document.getElementById('chk_hrd').checked) {
						var chk_hrd = "1";
					} else {
						var chk_hrd = "0";
					}
					//specific gravity and water abrasion-5							
					var hra1 = $('#hra1').val();
					var hra2 = $('#hra2').val();
					var hrb1 = $('#hrb1').val();
					var hrb2 = $('#hrb2').val();
					var hrc1 = $('#hrc1').val();
					var hrc2 = $('#hrc2').val();
					var hrd1 = $('#hrd1').val();
					var hrd2 = $('#hrd2').val();
					var hr1 = $('#hr1').val();
					var hr2 = $('#hr2').val();
					var avghr = $('#avghr').val();
					var hrtotal = $('#hrtotal').val();

					break;
				} else {
					var chk_hrd = "0";
					var hra1 = "0";
					var hra2 = "0";
					var hrb1 = "0";
					var hrb2 = "0";
					var hrc1 = "0";
					var hrc2 = "0";
					var hrd1 = "0";
					var hrd2 = "0";
					var hr1 = "0";
					var hr2 = "0";
					var avghr = "0";
					var hrtotal = "0";
				}

			}

			//bod
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "bod") {
					if (document.getElementById('chk_bod').checked) {
						var chk_bod = "1";
					} else {
						var chk_bod = "0";
					}

					var avgbo = $('#avgbo').val();

					break;
				} else {
					var chk_bod = "0";
					var avgbo = "0";

				}

			}

			//cod
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "cod") {
					if (document.getElementById('chk_cod').checked) {
						var chk_cod = "1";
					} else {
						var chk_cod = "0";
					}

					var avgco = $('#avgco').val();

					break;
				} else {
					var chk_cod = "0";
					var avgco = "0";

				}

			}




			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_phv=' + chk_phv + '&p1=' + p1 + '&p2=' + p2 + '&p3=' + p3 + '&avgp=' + avgp + '&chk_hso=' + chk_hso + '&h1=' + h1 + '&h2=' + h2 + '&h3=' + h3 + '&avgh=' + avgh + '&chk_nao=' + chk_nao + '&n1=' + n1 + '&n2=' + n2 + '&n3=' + n3 + '&avgn=' + avgn + '&chk_tso=' + chk_tso + '&tsa1=' + tsa1 + '&tsa2=' + tsa2 + '&tsb1=' + tsb1 + '&tsb2=' + tsb2 + '&tsc1=' + tsc1 + '&tsc2=' + tsc2 + '&tsd1=' + tsd1 + '&tsd2=' + tsd2 + '&ts1=' + ts1 + '&ts2=' + ts2 + '&avgts=' + avgts + '&chk_tds=' + chk_tds + '&tda1=' + tda1 + '&tda2=' + tda2 + '&tdb1=' + tdb1 + '&tdb2=' + tdb2 + '&tdc1=' + tdc1 + '&tdc2=' + tdc2 + '&tdd1=' + tdd1 + '&tdd2=' + tdd2 + '&td1=' + td1 + '&td2=' + td2 + '&avgtd=' + avgtd + '&chk_sus=' + chk_sus + '&uua1=' + uua1 + '&uua2=' + uua2 + '&uub1=' + uub1 + '&uub2=' + uub2 + '&uuc1=' + uuc1 + '&uuc2=' + uuc2 + '&uud1=' + uud1 + '&uud2=' + uud2 + '&uu1=' + uu1 + '&uu2=' + uu2 + '&avguu=' + avguu + '&chk_org=' + chk_org + '&ora1=' + ora1 + '&ora2=' + ora2 + '&orb1=' + orb1 + '&orb2=' + orb2 + '&orc1=' + orc1 + '&orc2=' + orc2 + '&ord1=' + ord1 + '&ord2=' + ord2 + '&or1=' + or1 + '&or2=' + or2 + '&avgor=' + avgor + '&chk_ino=' + chk_ino + '&ina1=' + ina1 + '&ina2=' + ina2 + '&inb1=' + inb1 + '&inb2=' + inb2 + '&inc1=' + inc1 + '&inc2=' + inc2 + '&ind1=' + ind1 + '&ind2=' + ind2 + '&in1=' + in1 + '&in2=' + in2 + '&avgin=' + avgin + '&chk_chl=' + chk_chl + '&cha1=' + cha1 + '&cha2=' + cha2 + '&chb1=' + chb1 + '&chb2=' + chb2 + '&chc1=' + chc1 + '&chc2=' + chc2 + '&chd1=' + chd1 + '&chd2=' + chd2 + '&ch1=' + ch1 + '&ch2=' + ch2 + '&avgch=' + avgch + '&chk_sul=' + chk_sul + '&sua1=' + sua1 + '&sua2=' + sua2 + '&sub1=' + sub1 + '&sub2=' + sub2 + '&suc1=' + suc1 + '&suc2=' + suc2 + '&sud1=' + sud1 + '&sud2=' + sud2 + '&su1=' + su1 + '&su2=' + su2 + '&avgsu=' + avgsu + '&sutotal=' + sutotal + '&chk_hrd=' + chk_hrd + '&hra1=' + hra1 + '&hra2=' + hra2 + '&hrb1=' + hrb1 + '&hrb2=' + hrb2 + '&hrc1=' + hrc1 + '&hrc2=' + hrc2 + '&hrd1=' + hrd1 + '&hrd2=' + hrd2 + '&hr1=' + hr1 + '&hr2=' + hr2 + '&avghr=' + avghr + '&hrtotal=' + hrtotal + '&chk_bod=' + chk_bod + '&avgbo=' + avgbo + '&chk_cod=' + chk_cod + '&avgco=' + avgco + '&plant=' + plant + '&ulr=' + ulr;

		} else if (type == 'edit') {
			var report_no = $('#report_no').val();
			var plant = $('#plant').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			var ulr = $('#ulr').val();

			var temp = $('#test_list').val();
			var aa = temp.split(",");

			//phv
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "phv") {
					if (document.getElementById('chk_phv').checked) {
						var chk_phv = "1";
					} else {
						var chk_phv = "0";
					}


					var p1 = $('#p1').val();
					var p2 = $('#p2').val();
					var p3 = $('#p3').val();
					var avgp = $('#avgp').val();

					break;
				} else {
					var chk_phv = "0";

					var p1 = "0";
					var p2 = "0";
					var p3 = "0";
					var avgp = "0";
				}

			}


			//hso
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "hso") {
					if (document.getElementById('chk_hso').checked) {
						var chk_hso = "1";
					} else {
						var chk_hso = "0";
					}


					var h1 = $('#h1').val();
					var h2 = $('#h2').val();
					var h3 = $('#h3').val();
					var avgh = $('#avgh').val();

					break;
				} else {
					var chk_hso = "0";

					var h1 = "0";
					var h2 = "0";
					var h3 = "0";
					var avgh = "0";
				}

			}


			//nao
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "nao") {
					if (document.getElementById('chk_nao').checked) {
						var chk_nao = "1";
					} else {
						var chk_nao = "0";
					}


					var n1 = $('#n1').val();
					var n2 = $('#n2').val();
					var n3 = $('#n3').val();
					var avgn = $('#avgn').val();

					break;
				} else {
					var chk_nao = "0";

					var n1 = "0";
					var n2 = "0";
					var n3 = "0";
					var avgn = "0";
				}

			}


			//TSS
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "TSS") {
					if (document.getElementById('chk_tso').checked) {
						var chk_tso = "1";
					} else {
						var chk_tso = "0";
					}
					//specific gravity and water abrasion-5							
					var tsa1 = $('#tsa1').val();
					var tsa2 = $('#tsa2').val();
					var tsb1 = $('#tsb1').val();
					var tsb2 = $('#tsb2').val();
					var tsc1 = $('#tsc1').val();
					var tsc2 = $('#tsc2').val();
					var tsd1 = $('#tsd1').val();
					var tsd2 = $('#tsd2').val();
					var ts1 = $('#ts1').val();
					var ts2 = $('#ts2').val();
					var avgts = $('#avgts').val();

					break;
				} else {
					var chk_tso = "0";
					var tsa1 = "0";
					var tsa2 = "0";
					var tsb1 = "0";
					var tsb2 = "0";
					var tsc1 = "0";
					var tsc2 = "0";
					var tsd1 = "0";
					var tsd2 = "0";
					var ts1 = "0";
					var ts2 = "0";
					var avgts = "0";
				}

			}

			//tds
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "tds") {
					if (document.getElementById('chk_tds').checked) {
						var chk_tds = "1";
					} else {
						var chk_tds = "0";
					}
					//specific gravity and water abrasion-5							
					var tda1 = $('#tda1').val();
					var tda2 = $('#tda2').val();
					var tdb1 = $('#tdb1').val();
					var tdb2 = $('#tdb2').val();
					var tdc1 = $('#tdc1').val();
					var tdc2 = $('#tdc2').val();
					var tdd1 = $('#tdd1').val();
					var tdd2 = $('#tdd2').val();
					var td1 = $('#td1').val();
					var td2 = $('#td2').val();
					var avgtd = $('#avgtd').val();

					break;
				} else {
					var chk_tds = "0";
					var tda1 = "0";
					var tda2 = "0";
					var tdb1 = "0";
					var tdb2 = "0";
					var tdc1 = "0";
					var tdc2 = "0";
					var tdd1 = "0";
					var tdd2 = "0";
					var td1 = "0";
					var td2 = "0";
					var avgtd = "0";
				}

			}

			//sus
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sus") {
					if (document.getElementById('chk_sus').checked) {
						var chk_sus = "1";
					} else {
						var chk_sus = "0";
					}
					//specific gravity and water abrasion-5							
					var uua1 = $('#uua1').val();
					var uua2 = "";
					var uub1 = $('#uub1').val();
					var uub2 = "";
					var uuc1 = $('#uuc1').val();
					var uuc2 = "";
					var uud1 = "";
					var uud2 = "";
					var uu1 = $('#uu1').val();
					var uu2 = "";
					var avguu = $('#avguu').val();

					break;
				} else {
					var chk_sus = "0";
					var uua1 = "0";
					var uua2 = "0";
					var uub1 = "0";
					var uub2 = "0";
					var uuc1 = "0";
					var uuc2 = "0";
					var uud1 = "0";
					var uud2 = "0";
					var uu1 = "0";
					var uu2 = "0";
					var avguu = "0";
				}

			}

			//org
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "org") {
					if (document.getElementById('chk_org').checked) {
						var chk_org = "1";
					} else {
						var chk_org = "0";
					}
					//specific gravity and water abrasion-5							
					var ora1 = $('#ora1').val();
					var ora2 = $('#ora2').val();
					var orb1 = $('#orb1').val();
					var orb2 = $('#orb2').val();
					var orc1 = $('#orc1').val();
					var orc2 = $('#orc2').val();
					var ord1 = $('#ord1').val();
					var ord2 = $('#ord2').val();
					var or1 = $('#or1').val();
					var or2 = $('#or2').val();
					var avgor = $('#avgor').val();

					break;
				} else {
					var chk_org = "0";
					var ora1 = "0";
					var ora2 = "0";
					var orb1 = "0";
					var orb2 = "0";
					var orc1 = "0";
					var orc2 = "0";
					var ord1 = "0";
					var ord2 = "0";
					var or1 = "0";
					var or2 = "0";
					var avgor = "0";
				}

			}

			//ino
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "ino") {
					if (document.getElementById('chk_ino').checked) {
						var chk_ino = "1";
					} else {
						var chk_ino = "0";
					}
					//specific gravity and water abrasion-5							
					var ina1 = $('#ina1').val();
					var ina2 = $('#ina2').val();
					var inb1 = $('#inb1').val();
					var inb2 = $('#inb2').val();
					var inc1 = $('#inc1').val();
					var inc2 = $('#inc2').val();
					var ind1 = $('#ind1').val();
					var ind2 = $('#ind2').val();
					var in1 = $('#in1').val();
					var in2 = $('#in2').val();
					var avgin = $('#avgin').val();

					break;
				} else {
					var chk_ino = "0";
					var ina1 = "0";
					var ina2 = "0";
					var inb1 = "0";
					var inb2 = "0";
					var inc1 = "0";
					var inc2 = "0";
					var ind1 = "0";
					var ind2 = "0";
					var in1 = "0";
					var in2 = "0";
					var avgin = "0";
				}

			}

			//chl
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "chl") {
					if (document.getElementById('chk_chl').checked) {
						var chk_chl = "1";
					} else {
						var chk_chl = "0";
					}
					//specific gravity and water abrasion-5							
					var cha1 = $('#cha1').val();
					var cha2 = $('#cha2').val();
					var chb1 = $('#chb1').val();
					var chb2 = $('#chb2').val();
					var chc1 = $('#chc1').val();
					var chc2 = $('#chc2').val();
					var chd1 = $('#chd1').val();
					var chd2 = $('#chd2').val();
					var ch1 = $('#ch1').val();
					var ch2 = $('#ch2').val();
					var avgch = $('#avgch').val();

					break;
				} else {
					var chk_chl = "0";
					var cha1 = "0";
					var cha2 = "0";
					var chb1 = "0";
					var chb2 = "0";
					var chc1 = "0";
					var chc2 = "0";
					var chd1 = "0";
					var chd2 = "0";
					var ch1 = "0";
					var ch2 = "0";
					var avgch = "0";
				}

			}

			//sul
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sul") {
					if (document.getElementById('chk_sul').checked) {
						var chk_sul = "1";
					} else {
						var chk_sul = "0";
					}
					//specific gravity and water abrasion-5							
					var sua1 = $('#sua1').val();
					var sua2 = $('#sua2').val();
					var sub1 = $('#sub1').val();
					var sub2 = $('#sub2').val();
					var suc1 = $('#suc1').val();
					var suc2 = $('#suc2').val();
					var sud1 = $('#sud1').val();
					var sud2 = $('#sud2').val();
					var su1 = $('#su1').val();
					var su2 = $('#su2').val();
					var avgsu = $('#avgsu').val();
					var sutotal = $('#sutotal').val();

					break;
				} else {
					var chk_sul = "0";
					var sua1 = "0";
					var sua2 = "0";
					var sub1 = "0";
					var sub2 = "0";
					var suc1 = "0";
					var suc2 = "0";
					var sud1 = "0";
					var sud2 = "0";
					var su1 = "0";
					var su2 = "0";
					var avgsu = "0";
					var sutotal = "0";
				}

			}

			//hrd
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "hrd") {
					if (document.getElementById('chk_hrd').checked) {
						var chk_hrd = "1";
					} else {
						var chk_hrd = "0";
					}
					//specific gravity and water abrasion-5							
					var hra1 = $('#hra1').val();
					var hra2 = $('#hra2').val();
					var hrb1 = $('#hrb1').val();
					var hrb2 = $('#hrb2').val();
					var hrc1 = $('#hrc1').val();
					var hrc2 = $('#hrc2').val();
					var hrd1 = $('#hrd1').val();
					var hrd2 = $('#hrd2').val();
					var hr1 = $('#hr1').val();
					var hr2 = $('#hr2').val();
					var avghr = $('#avghr').val();
					var hrtotal = $('#hrtotal').val();

					break;
				} else {
					var chk_hrd = "0";
					var hra1 = "0";
					var hra2 = "0";
					var hrb1 = "0";
					var hrb2 = "0";
					var hrc1 = "0";
					var hrc2 = "0";
					var hrd1 = "0";
					var hrd2 = "0";
					var hr1 = "0";
					var hr2 = "0";
					var avghr = "0";
					var hrtotal = "0";
				}

			}

			//bod
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "bod") {
					if (document.getElementById('chk_bod').checked) {
						var chk_bod = "1";
					} else {
						var chk_bod = "0";
					}

					var avgbo = $('#avgbo').val();

					break;
				} else {
					var chk_bod = "0";
					var avgbo = "0";

				}

			}

			//cod
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "cod") {
					if (document.getElementById('chk_cod').checked) {
						var chk_cod = "1";
					} else {
						var chk_cod = "0";
					}

					var avgco = $('#avgco').val();

					break;
				} else {
					var chk_cod = "0";
					var avgco = "0";

				}

			}


			var idEdit = $('#idEdit').val();

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_phv=' + chk_phv + '&p1=' + p1 + '&p2=' + p2 + '&p3=' + p3 + '&avgp=' + avgp + '&chk_hso=' + chk_hso + '&h1=' + h1 + '&h2=' + h2 + '&h3=' + h3 + '&avgh=' + avgh + '&chk_nao=' + chk_nao + '&n1=' + n1 + '&n2=' + n2 + '&n3=' + n3 + '&avgn=' + avgn + '&chk_tso=' + chk_tso + '&tsa1=' + tsa1 + '&tsa2=' + tsa2 + '&tsb1=' + tsb1 + '&tsb2=' + tsb2 + '&tsc1=' + tsc1 + '&tsc2=' + tsc2 + '&tsd1=' + tsd1 + '&tsd2=' + tsd2 + '&ts1=' + ts1 + '&ts2=' + ts2 + '&avgts=' + avgts + '&chk_tds=' + chk_tds + '&tda1=' + tda1 + '&tda2=' + tda2 + '&tdb1=' + tdb1 + '&tdb2=' + tdb2 + '&tdc1=' + tdc1 + '&tdc2=' + tdc2 + '&tdd1=' + tdd1 + '&tdd2=' + tdd2 + '&td1=' + td1 + '&td2=' + td2 + '&avgtd=' + avgtd + '&chk_sus=' + chk_sus + '&uua1=' + uua1 + '&uua2=' + uua2 + '&uub1=' + uub1 + '&uub2=' + uub2 + '&uuc1=' + uuc1 + '&uuc2=' + uuc2 + '&uud1=' + uud1 + '&uud2=' + uud2 + '&uu1=' + uu1 + '&uu2=' + uu2 + '&avguu=' + avguu + '&chk_org=' + chk_org + '&ora1=' + ora1 + '&ora2=' + ora2 + '&orb1=' + orb1 + '&orb2=' + orb2 + '&orc1=' + orc1 + '&orc2=' + orc2 + '&ord1=' + ord1 + '&ord2=' + ord2 + '&or1=' + or1 + '&or2=' + or2 + '&avgor=' + avgor + '&chk_ino=' + chk_ino + '&ina1=' + ina1 + '&ina2=' + ina2 + '&inb1=' + inb1 + '&inb2=' + inb2 + '&inc1=' + inc1 + '&inc2=' + inc2 + '&ind1=' + ind1 + '&ind2=' + ind2 + '&in1=' + in1 + '&in2=' + in2 + '&avgin=' + avgin + '&chk_chl=' + chk_chl + '&cha1=' + cha1 + '&cha2=' + cha2 + '&chb1=' + chb1 + '&chb2=' + chb2 + '&chc1=' + chc1 + '&chc2=' + chc2 + '&chd1=' + chd1 + '&chd2=' + chd2 + '&ch1=' + ch1 + '&ch2=' + ch2 + '&avgch=' + avgch + '&chk_sul=' + chk_sul + '&sua1=' + sua1 + '&sua2=' + sua2 + '&sub1=' + sub1 + '&sub2=' + sub2 + '&suc1=' + suc1 + '&suc2=' + suc2 + '&sud1=' + sud1 + '&sud2=' + sud2 + '&su1=' + su1 + '&su2=' + su2 + '&avgsu=' + avgsu + '&sutotal=' + sutotal + '&chk_hrd=' + chk_hrd + '&hra1=' + hra1 + '&hra2=' + hra2 + '&hrb1=' + hrb1 + '&hrb2=' + hrb2 + '&hrc1=' + hrc1 + '&hrc2=' + hrc2 + '&hrd1=' + hrd1 + '&hrd2=' + hrd2 + '&hr1=' + hr1 + '&hr2=' + hr2 + '&avghr=' + avghr + '&hrtotal=' + hrtotal + '&chk_bod=' + chk_bod + '&avgbo=' + avgbo + '&chk_cod=' + chk_cod + '&avgco=' + avgco + '&plant=' + plant + '&ulr=' + ulr;
		} else {
			var report_no = $('#report_no').val();
			var job_no = $('#job_no').val();
			var lab_no = $('#lab_no').val();
			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_water_span.php',
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
			url: '<?php echo $base_url; ?>save_water_span.php',
			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
			success: function(data) {
				$('#idEdit').val(data.id);
				var idEdit = $('#idEdit').val();
				$('#report_no').val(data.report_no);
				$('#plant').val(data.plant);
				$('#job_no').val(data.job_no);
				$('#lab_no').val(data.lab_no);
				$('#ulr').val(data.ulr);

				var temp = $('#test_list').val();
				var aa = temp.split(",");

				//phv
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "phv") {

						var chk_phv = data.chk_phv;
						if (chk_phv == "1") {
							$('#txtphv').css("background-color", "var(--primary)");
							$("#chk_phv").prop("checked", true);

						} else {
							$('#txtphv').css("background-color", "white");
							$("#chk_phv").prop("checked", false);

						}


						$('#p1').val(data.p1);
						$('#p2').val(data.p2);
						$('#p3').val(data.p3);
						$('#avgp').val(data.avgp);


						break;
					} else {

					}

				}

				//hso
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "hso") {

						var chk_hso = data.chk_hso;
						if (chk_hso == "1") {
							$('#txthso').css("background-color", "var(--primary)");
							$("#chk_hso").prop("checked", true);

						} else {
							$('#txthso').css("background-color", "white");
							$("#chk_hso").prop("checked", false);

						}


						$('#h1').val(data.h1);
						$('#h2').val(data.h2);
						$('#h3').val(data.h3);
						$('#avgh').val(data.avgh);


						break;
					} else {

					}

				}

				//nao
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "nao") {

						var chk_nao = data.chk_nao;
						if (chk_nao == "1") {
							$('#txtnao').css("background-color", "var(--primary)");
							$("#chk_nao").prop("checked", true);

						} else {
							$('#txtnao').css("background-color", "white");
							$("#chk_nao").prop("checked", false);

						}


						$('#n1').val(data.n1);
						$('#n2').val(data.n2);
						$('#n3').val(data.n3);
						$('#avgn').val(data.avgn);


						break;
					} else {

					}

				}




				//TSS 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "TSS") {
						var chk_tso = data.chk_tso;
						if (chk_tso == "1") {
							$('#txtsoi').css("background-color", "var(--primary)");
							$("#chk_tso").prop("checked", true);
						} else {
							$('#txtsoi').css("background-color", "white");
							$("#chk_tso").prop("checked", false);
						}
						//specific gravity

						$('#tsa1').val(data.tsa1);
						$('#tsa2').val(data.tsa2);
						$('#tsb1').val(data.tsb1);
						$('#tsb2').val(data.tsb2);
						$('#tsc1').val(data.tsc1);
						$('#tsc2').val(data.tsc2);
						$('#tsd1').val(data.tsd1);
						$('#tsd2').val(data.tsd2);
						$('#ts1').val(data.ts1);
						$('#ts2').val(data.ts2);
						$('#avgts').val(data.avgts);
						break;
					} else {

					}

				}

				//tds 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "tds") {
						var chk_tds = data.chk_tds;
						if (chk_tds == "1") {
							$('#txttds').css("background-color", "var(--primary)");
							$("#chk_tds").prop("checked", true);
						} else {
							$('#txttds').css("background-color", "white");
							$("#chk_tds").prop("checked", false);
						}
						//specific gravity

						$('#tda1').val(data.tda1);
						$('#tda2').val(data.tda2);
						$('#tdb1').val(data.tdb1);
						$('#tdb2').val(data.tdb2);
						$('#tdc1').val(data.tdc1);
						$('#tdc2').val(data.tdc2);
						$('#tdd1').val(data.tdd1);
						$('#tdd2').val(data.tdd2);
						$('#td1').val(data.td1);
						$('#td2').val(data.td2);
						$('#avgtd').val(data.avgtd);
						break;
					} else {

					}

				}

				//sus 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sus") {
						var chk_sus = data.chk_sus;
						if (chk_sus == "1") {
							$('#txtsus').css("background-color", "var(--primary)");
							$("#chk_sus").prop("checked", true);
						} else {
							$('#txtsus').css("background-color", "white");
							$("#chk_sus").prop("checked", false);
						}
						//specific gravity

						$('#uua1').val(data.uua1);
						
						$('#uub1').val(data.uub1);
						
						$('#uuc1').val(data.uuc1);
						$('#uu1').val(data.uu1);
						$('#avguu').val(data.avguu);
						break;
					} else {

					}

				}

				//org 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "org") {
						var chk_org = data.chk_org;
						if (chk_org == "1") {
							$('#txtorg').css("background-color", "var(--primary)");
							$("#chk_org").prop("checked", true);
						} else {
							$('#txtorg').css("background-color", "white");
							$("#chk_org").prop("checked", false);
						}


						$('#ora1').val(data.ora1);
						$('#ora2').val(data.ora2);
						$('#orb1').val(data.orb1);
						$('#orb2').val(data.orb2);
						$('#orc1').val(data.orc1);
						$('#orc2').val(data.orc2);
						$('#ord1').val(data.ord1);
						$('#ord2').val(data.ord2);
						$('#or1').val(data.or1);
						$('#or2').val(data.or2);
						$('#avgor').val(data.avgor);
						break;
					} else {

					}

				}

				//ino 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "ino") {
						var chk_ino = data.chk_ino;
						if (chk_ino == "1") {
							$('#txtino').css("background-color", "var(--primary)");
							$("#chk_ino").prop("checked", true);
						} else {
							$('#txtino').css("background-color", "white");
							$("#chk_ino").prop("checked", false);
						}


						$('#ina1').val(data.ina1);
						$('#ina2').val(data.ina2);
						$('#inb1').val(data.inb1);
						$('#inb2').val(data.inb2);
						$('#inc1').val(data.inc1);
						$('#inc2').val(data.inc2);
						$('#ind1').val(data.ind1);
						$('#ind2').val(data.ind2);
						$('#in1').val(data.in1);
						$('#in2').val(data.in2);
						$('#avgin').val(data.avgin);
						break;
					} else {

					}

				}

				//chl 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "chl") {
						var chk_chl = data.chk_chl;
						if (chk_chl == "1") {
							$('#txtchl').css("background-color", "var(--primary)");
							$("#chk_chl").prop("checked", true);
						} else {
							$('#txtchl').css("background-color", "white");
							$("#chk_chl").prop("checked", false);
						}


						$('#cha1').val(data.cha1);
						$('#cha2').val(data.cha2);
						$('#chb1').val(data.chb1);
						$('#chb2').val(data.chb2);
						$('#chc1').val(data.chc1);
						$('#chc2').val(data.chc2);
						$('#chd1').val(data.chd1);
						$('#chd2').val(data.chd2);
						$('#ch1').val(data.ch1);
						$('#ch2').val(data.ch2);
						$('#avgch').val(data.avgch);
						break;
					} else {

					}

				}

				//sul 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sul") {
						var chk_sul = data.chk_sul;
						if (chk_sul == "1") {
							$('#txtsul').css("background-color", "var(--primary)");
							$("#chk_sul").prop("checked", true);
						} else {
							$('#txtsul').css("background-color", "white");
							$("#chk_sul").prop("checked", false);
						}


						$('#sua1').val(data.sua1);
						$('#sua2').val(data.sua2);
						$('#sub1').val(data.sub1);
						$('#sub2').val(data.sub2);
						$('#suc1').val(data.suc1);
						$('#suc2').val(data.suc2);
						$('#sud1').val(data.sud1);
						$('#sud2').val(data.sud2);
						$('#su1').val(data.su1);
						$('#su2').val(data.su2);
						$('#avgsu').val(data.avgsu);
						$('#sutotal').val(data.sutotal);
						break;
					} else {

					}

				}

				//hrd 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "hrd") {
						var chk_hrd = data.chk_hrd;
						if (chk_hrd == "1") {
							$('#txthrd').css("background-color", "var(--primary)");
							$("#chk_hrd").prop("checked", true);
						} else {
							$('#txthrd').css("background-color", "white");
							$("#chk_hrd").prop("checked", false);
						}


						$('#hra1').val(data.hra1);
						$('#hra2').val(data.hra2);
						$('#hrb1').val(data.hrb1);
						$('#hrb2').val(data.hrb2);
						$('#hrc1').val(data.hrc1);
						$('#hrc2').val(data.hrc2);
						$('#hrd1').val(data.hrd1);
						$('#hrd2').val(data.hrd2);
						$('#hr1').val(data.hr1);
						$('#hr2').val(data.hr2);
						$('#avghr').val(data.avghr);
						$('#hrtotal').val(data.hrtotal);
						break;
					} else {

					}

				}

				//bod 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "bod") {
						var chk_bod = data.chk_bod;
						if (chk_bod == "1") {
							$('#txtbod').css("background-color", "var(--primary)");
							$("#chk_bod").prop("checked", true);
						} else {
							$('#txtbod').css("background-color", "white");
							$("#chk_bod").prop("checked", false);
						}



						$('#avgbo').val(data.avgbo);

						break;
					} else {

					}

				}

				//cod 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "cod") {
						var chk_cod = data.chk_cod;
						if (chk_cod == "1") {
							$('#txtcod').css("background-color", "var(--primary)");
							$("#chk_cod").prop("checked", true);
						} else {
							$('#txtcod').css("background-color", "white");
							$("#chk_cod").prop("checked", false);
						}



						$('#avgco').val(data.avgco);

						break;
					} else {

					}

				}




				$('#btn_edit_data').show();
				$('#btn_save').hide();
			}
		});


	}
</script>
</script>