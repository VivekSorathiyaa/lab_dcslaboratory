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
		$mark = $row_select4['mark'];
		$speci = $row_select4['brick_specification'];
		$brick_size = $row_select4['brick_size'];
		if ($brick_size == "190 X 90 X 90") {
			$b_l = 190;
			$b_w = 90;
			$b_h = 90;
		} else if ($brick_size == "190 X 90 X 40") {
			$b_l = 190;
			$b_w = 90;
			$b_h = 40;
		} else if ($brick_size == "230 X 110 X 70") {
			$b_l = 230;
			$b_w = 110;
			$b_h = 70;
		} else if ($brick_size == "230 X 110 X 30") {
			$b_l = 230;
			$b_w = 110;
			$b_h = 30;
		} else if ($brick_size == "NS 225 X 100 X 75") {
			$b_l = 225;
			$b_w = 100;
			$b_h = 75;
		} else if ($brick_size == "Other") {
			$b_l = 0;
			$b_w = 0;
			$b_h = 0;
		} else {
			$b_l = 190;
			$b_w = 90;
			$b_h = 90;
		}
	}

	?>
 <div class="content-wrapper" style="margin-left:0px !important;">

 	<section class="content common_material p-0">
 		<?php include("menu.php") ?>
 		<div class="row">
 			<div class="col-md-12">
 				<div class="box box-info">
 					<div class="box-header with-border">
 						<h2 style="text-align:center;">BURNT CLY BRICKS</h2>

 					</div>
 					<div class="box-default">
 						<form class="form" id="Glazed" method="post">
 							<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
 							<div class="row">
 								<br>
 								<div class="col-lg-6">
 									<div class="form-group">

 										<!--  <label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->

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
 											<input type="text" class="form-control inputs" tabindex="4" id="" value="<?php echo $job_no;?>" name="lab_no" ReadOnly>
                                        <input type="hidden" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" ReadOnly>
 										</div>
 									</div>
 								</div>
 								<div class="col-lg-4">
 									<div class="form-group">
 										<div class="col-sm-3">
 											<label>Remarks :</label>
 										</div>

 										<div class="col-sm-9">
 											<input type="text" class="form-control inputs" tabindex="4" id="remarks" name="remarks">
 										</div>
 									</div>
 								</div>
								 <div class="col-lg-3">
										<div class="form-group">
										 <div class="col-sm-4">
													<!--<label>Amend Date. :</label>-->
												</div>								 
										  <div class="col-sm-8">
											<input type="hidden" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
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
 							<div class="row">
 								<div class="col-lg-6">
 									<div class="form-group">
 										<label for="inputEmail3" class="col-sm-2 control-label">Length :</label>
 										<div class="col-sm-2">
 											<input type="text" class="form-control inputs" tabindex="4" id="b_l" value="<?php echo $b_l; ?>" name="b_l">
 											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_l"  name="in_l" ReadOnly value="400">-->
 										</div>

 										<label for="inputEmail3" class="col-sm-2 control-label">Width :</label>
 										<div class="col-sm-2">
 											<input type="text" class="form-control inputs" tabindex="4" id="b_w" value="<?php echo $b_w; ?>" name="b_w">
 											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_w"  name="in_w" ReadOnly value="100">-->
 										</div>

 										<label for="inputEmail3" class="col-sm-2 control-label">Height :</label>
 										<div class="col-sm-2">
 											<input type="text" class="form-control inputs" tabindex="4" id="b_h" value="<?php echo $b_h; ?>" name="b_h">
 											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_h"  name="in_h" ReadOnly value="200">-->
 										</div>

 									</div>
 								</div>

 								<div class="col-lg-6">
 									<div class="form-group">
 										<label for="inputEmail3" class="col-sm-2 control-label">Class :</label>
 										<div class="col-sm-10">
 											<input type="text" class="form-control inputs" tabindex="4" id="speci" value="<?php echo $speci; ?>" name="speci">
 											<!--<input type="text" class="form-control inputs" tabindex="4" id="in_l"  name="in_l" ReadOnly value="400">-->
 										</div>



 									</div>
 								</div>

 							</div>
 							<hr>
 							<br>
 							<div class="panel-group" id="accordion">
 								<?php
									$is_upload = "select * from span_material_assign WHERE `trf_no`='$trf_no' and `job_number`='$job_no' and isdeleted='0'";

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

 									<?php	} ?>



 									<!-- TEST WISE LOGIC VAIBHAV-->
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
 														<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
 															<h4 class="panel-title">
 																<b>DIMENSION AND TOLERANCE</b>
 															</h4>
 														</a>
 													</h4>
 												</div>
 												<div id="collapse1" class="panel-collapse collapse">
 													<div class="panel-body">
 														<!--Impact VALUE Start-->
 														<br>
 														<div class="row">
 															<div class="col-lg-12">
 																<div class="form-group">
 																	<div class="col-sm-1">
 																		<label for="chk_dim">1.</label>
 																		<input type="checkbox" class="visually-hidden" name="chk_dim" id="chk_dim" value="chk_dim"><br>
 																	</div>
 																	<label for="inputEmail3" class="col-sm-4 control-label label-right">DIMENSION AND TOLERANCE</label>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-sm-4">
 																<div class="col-md-6">
 																	<h6 class="panel-title">
 																		<b>NOS OF BRICKS:</b>
 																	</h6>
 																</div>
 																<div class="col-md-6">
 																	<input type="text" class="form-control" id="no_of_brick" name="no_of_brick">
 																</div>
 															</div>
 															<div class="col-sm-3">
 																<div class="col-md-6">
 																	<h6 class="panel-title">
 																		<b>ID Mark:</b>
 																	</h6>
 																</div>
 																<div class="col-md-6">
 																	<input type="text" class="form-control" id="id_mark" name="id_mark">
 																</div>
 															</div>
 															<div class="col-sm-3">
 																<div class="col-md-6">
 																	<h6 class="panel-title">
 																		<b>Temprature:</b>
 																	</h6>
 																</div>
 																<div class="col-md-6">
 																	<input type="text" class="form-control" id="temp1" name="temp1">
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-sm-4">
 																<label for="inputEmail3" class="control-label label-right">Length (mm)</label>
 															</div>
 															<div class="col-sm-4">
 																<label for="inputEmail3" class="control-label label-right">Width (mm)</label>
 															</div>
 															<div class="col-sm-4">.
 																<label for="inputEmail3" class="control-label label-right">Height (mm)</label>
 															</div>
 														</div>

 														<div class="row">
 															<div class="col-sm-4">
 																<input type="text" class="form-control" id="dim_length" name="dim_length">
 															</div>
 															<div class="col-sm-4">
 																<input type="text" class="form-control" id="dim_width" name="dim_width">
 															</div>
 															<div class="col-sm-4">
 																<input type="text" class="form-control" id="dim_height" name="dim_height">
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-sm-4">
 																<input type="text" class="form-control" id="dim_length1" name="dim_length1">
 															</div>
 															<div class="col-sm-4">
 																<input type="text" class="form-control" id="dim_width1" name="dim_width1">
 															</div>
 															<div class="col-sm-4">
 																<input type="text" class="form-control" id="dim_height1" name="dim_height1">
 															</div>
 														</div>
 														<Br>
 														<div class="row">
 															<div class="col-sm-12">
 																<label for="inputEmail3" class="control-label label-right">Average</label>
 															</div>

 														</div>
 														<br>
 														<div class="row">
 															<div class="col-sm-4">
 																<input type="text" class="form-control" id="avg_length" name="avg_length" disabled>
 															</div>
 															<div class="col-sm-4">
 																<input type="text" class="form-control" id="avg_width" name="avg_width" disabled>
 															</div>
 															<div class="col-sm-4">
 																<input type="text" class="form-control" id="avg_height" name="avg_height" disabled>
 															</div>
 														</div>
 														<br>



 													</div>
 												</div>
 											</div>

 										<?php
											} else if ($r1['test_code'] == "wtr") {
												$test_check .= "wtr,";
											?>

 											<div class="panel panel-default" id="wtr">
 												<div class="panel-heading" id="txtwtr">
 													<h4 class="panel-title">
 														<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
 															<h4 class="panel-title">
 																<b>WATER ABSORPTION</b>
 															</h4>
 														</a>
 													</h4>
 												</div>
 												<div id="collapse3" class="panel-collapse collapse">
 													<div class="panel-body">

 														<!--ABRASION VALUE START-->
 														<div class="row">
 															<div class="col-lg-12">
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
 															<!-- <div class="col-sm-3"> -->
 															<!--<label for="inputEmail3" class="control-label label-right">Laboratory Ref. No</label>-->
 															<!-- </div> -->
 															<div class="col-sm-3">
 																<label for="inputEmail3" class="control-label label-right">Dry weight (M1)</label>
 															</div>
 															<div class="col-sm-3">
 																<label for="inputEmail3" class="control-label label-right">Wet Weight (M2)</label>
 															</div>
 															<div class="col-sm-3">
 																<label for="inputEmail3" class="control-label label-right">Water absorption (%) = (M2–M1 / M1) * 100</label>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<!-- <div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_lab_1" name="wtr_lab_1">
 															</div> -->
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w1_1" name="wtr_w1_1">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w2_1" name="wtr_w2_1">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_1" name="wtr_1" disabled>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<!-- <div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_lab_2" name="wtr_lab_2">
 															</div> -->
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w1_2" name="wtr_w1_2">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w2_2" name="wtr_w2_2">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_2" name="wtr_2" disabled>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<!-- <div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_lab_3" name="wtr_lab_3">
 															</div> -->
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w1_3" name="wtr_w1_3">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w2_3" name="wtr_w2_3">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_3" name="wtr_3" disabled>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<!-- <div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_lab_4" name="wtr_lab_4">
 															</div> -->
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w1_4" name="wtr_w1_4">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w2_4" name="wtr_w2_4">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_4" name="wtr_4" disabled>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<!-- <div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_lab_5" name="wtr_lab_5">
 															</div> -->
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w1_5" name="wtr_w1_5">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w2_5" name="wtr_w2_5">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_5" name="wtr_5" disabled>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w1_6" name="wtr_w1_6">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_w2_6" name="wtr_w2_6">
 															</div>
 															<div class="col-sm-3">
 																<input type="text" class="form-control" id="wtr_6" name="wtr_6" disabled>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-md-3">
 															</div>
 															<div class="col-md-3">
 																<label for="inputEmail3" class="control-label label-right">Average</label>
 															</div>
 															<div class="col-md-3">
 																<input type="text" class="form-control" id="avg_wtr" name="avg_wtr" disabled>
 															</div>
 														</div>

 													</div>
 												</div>
 											</div>



 										<?php } else if ($r1['test_code'] == "com") {
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

 															<!-- <div class="col-lg-4">
 																<div class="form-group">
 																	<div class="col-sm-6">
 																		<label for="inputEmail3" class="control-label label-right">Remarks</label>
 																	</div>
 																	<div class="col-sm-6">
 																		<input type="text" class="form-control" id="con_grade" name="con_grade">
 																	</div>
 																</div>
 															</div> -->
 														</div>
 														<br>

 														<div class="row">
 															<div class="col-md-6">
 																<div class="col-sm-3">
 																	<label for="inputEmail3" class="control-label label-right">Identification Mark</label>
 																</div>
 																<div class="col-sm-3">
 																	<label for="inputEmail3" class="control-label label-right"> (L) (mm)</label>
 																</div>
 																<div class="col-sm-3">
 																	<label for="inputEmail3" class="control-label label-right"> (W) (mm)</label>
 																</div>
 																<div class="col-sm-3">
 																	<label for="inputEmail3" class="control-label label-right"> (H) (mm)</label>
 																</div>
 															</div>
 															<div class="col-md-6">
 																<div class="col-sm-4">
 																	<label for="inputEmail3" class="control-label label-right">Area = L x W (mm<sup>2</sup>)</label>

 																</div>
 																<div class="col-sm-4">
 																	<label for="inputEmail3" class="control-label label-right">Load (P) (KN)</label>
 																</div>
 																<div class="col-sm-4">
 																	<label for="inputEmail3" class="control-label label-right">Compressive strength (P / (L * W) * 1000)<br>(N/mm<sup>2</sup>)</label>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-md-6">
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_lab_1" name="com_lab_1">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_l_1" name="com_l_1">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_b_1" name="com_b_1">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_h_1" name="com_h_1">
 																</div>
 															</div>
 															<div class="col-md-6">
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_area_1" name="com_area_1" disabled>
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_load_1" name="com_load_1">
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_1" name="com_1" disabled>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-md-6">
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_lab_2" name="com_lab_2">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_l_2" name="com_l_2">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_b_2" name="com_b_2">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_h_2" name="com_h_2">
 																</div>
 															</div>
 															<div class="col-md-6">
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_area_2" name="com_area_2" disabled>
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_load_2" name="com_load_2">
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_2" name="com_2" disabled>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-md-6">
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_lab_3" name="com_lab_3">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_l_3" name="com_l_3">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_b_3" name="com_b_3">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_h_3" name="com_h_3">
 																</div>
 															</div>
 															<div class="col-md-6">
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_area_3" name="com_area_3" disabled>
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_load_3" name="com_load_3">
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_3" name="com_3" disabled>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-md-6">
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_lab_4" name="com_lab_4">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_l_4" name="com_l_4">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_b_4" name="com_b_4">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_h_4" name="com_h_4">
 																</div>
 															</div>
 															<div class="col-md-6">
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_area_4" name="com_area_4" disabled>
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_load_4" name="com_load_4">
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_4" name="com_4" disabled>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-md-6">
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_lab_5" name="com_lab_5">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_l_5" name="com_l_5">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_b_5" name="com_b_5">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_h_5" name="com_h_5">
 																</div>
 															</div>
 															<div class="col-md-6">
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_area_5" name="com_area_5" disabled>
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_load_5" name="com_load_5">
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_5" name="com_5" disabled>
 																</div>
 															</div>
 														</div>
														<br>
 														<div class="row">
 															<div class="col-md-6">
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_lab_6" name="com_lab_6">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_l_6" name="com_l_6">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_b_6" name="com_b_6">
 																</div>
 																<div class="col-sm-3">
 																	<input type="text" class="form-control" id="com_h_6" name="com_h_6">
 																</div>
 															</div>
 															<div class="col-md-6">
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_area_6" name="com_area_6" disabled>
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_load_6" name="com_load_6">
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="com_6" name="com_6" disabled>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-md-6">
 															</div>
 															<div class="col-md-6">
 																<div class="col-sm-4">

 																</div>
 																<div class="col-sm-4">
 																	<label for="inputEmail3" class="control-label label-right">Average</label>
 																</div>
 																<div class="col-sm-4">
 																	<input type="text" class="form-control" id="avg_com" name="avg_com" disabled>
 																</div>
 															</div>
 														</div>

 													</div>
 												</div>
 											</div>
 										<?php } else if ($r1['test_code'] == "eff") {
												$test_check .= "eff,"; ?>

 											<div class="panel panel-default" id="eff">
 												<div class="panel-heading" id="txteff">
 													<h4 class="panel-title">
 														<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
 															<h4 class="panel-title">
 																<b>EFFLORESCENCE</b>
 															</h4>
 														</a>
 													</h4>
 												</div>
 												<div id="collapse6" class="panel-collapse collapse">
 													<div class="panel-body">

 														<div class="row">
 															<div class="col-lg-12">
 																<div class="form-group">
 																	<div class="col-sm-1">
 																		<label for="chk_efflo">4.</label>
 																		<input type="checkbox" class="visually-hidden" name="chk_efflo" id="chk_efflo" value="chk_efflo"><br>
 																	</div>
 																	<label for="inputEmail3" class="col-sm-4 control-label label-right">EFFLORESCENCE</label>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="col-md-6">
 																<div class="form-group">
 																	<label for="inputEmail3" class="control-label label-right">EFFLORESCENCE - 01</label>
 																</div>
 															</div>
 															<div class="col-md-6">
 																<div class="form-group">
 																	<input type="text" class="form-control" id="rbt_efflo1" name="rbt_efflo1">
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="row">
 																<div class="col-md-6">
 																	<div class="form-group">
 																		<label for="inputEmail3" class="control-label label-right">EFFLORESCENCE - 02</label>
 																	</div>
 																</div>
 																<div class="col-md-6">
 																	<div class="form-group">
 																		<input type="text" class="form-control" id="rbt_efflo2" name="rbt_efflo2">
 																	</div>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="row">
 																<div class="col-md-6">
 																	<div class="form-group">
 																		<label for="inputEmail3" class="control-label label-right">EFFLORESCENCE - 03</label>
 																	</div>
 																</div>
 																<div class="col-md-6">
 																	<div class="form-group">
 																		<input type="text" class="form-control" id="rbt_efflo3" name="rbt_efflo3">
 																	</div>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="row">
 																<div class="col-md-6">
 																	<div class="form-group">
 																		<label for="inputEmail3" class="control-label label-right">EFFLORESCENCE - 04</label>
 																	</div>
 																</div>
 																<div class="col-md-6">
 																	<div class="form-group">
 																		<input type="text" class="form-control" id="rbt_efflo4" name="rbt_efflo4">
 																	</div>
 																</div>
 															</div>
 														</div>
 														<br>
 														<div class="row">
 															<div class="row">
 																<div class="col-md-6">
 																	<div class="form-group">
 																		<label for="inputEmail3" class="control-label label-right">EFFLORESCENCE - 05</label>
 																	</div>
 																</div>
 																<div class="col-md-6">
 																	<div class="form-group">
 																		<input type="text" class="form-control" id="rbt_efflo5" name="rbt_efflo5">
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
 									<br>
 									<div class="row">
 										<div class="col-lg-12">
 											<div class="form-group">

 												<div class="col-sm-2">
 													<!-- SAVE BUTTON LOGIC VAIBHAV-->
 													<?php
														$querys_job1 = "SELECT * FROM span_brick WHERE `is_deleted`='0' and lab_no='$lab_no'";
														$qrys_jobno = mysqli_query($conn, $querys_job1);
														$rows = mysqli_num_rows($qrys_jobno);
														if ($rows < 1) { ?>
 														<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14">Save</button>
 													<?php }
														?>


 												</div>
 												<div class="col-sm-1">
 													<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')" id="btn_edit_data" name="btn_edit_data">Update</button>

 												</div>
 												<div class="col-sm-1">
 													<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)">Back</button>
 													<input type="hidden" class="form-control" name="idEdit" id="idEdit" />

 												</div>
 												<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
 												<?php
													// $val =  $_SESSION['isadmin'];
													// if ($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type'] == "direct_nabl" || $_SESSION['nabl_type'] == "direct_non_nabl") {
													?>
 												<div class="col-sm-2">
 													<a target='_blank' href="<?php echo $base_url; ?>print_report/print_brick.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>&&ulr=<?php echo $ulr; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

 												</div><!--
												<div class="col-sm-2">
 													<a target='_blank' href="<?php echo $base_url; ?>back_cal_report_blank/print_brick.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>&&ulr=<?php echo $ulr; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Blank</b></a>

 												</div>-->
												

 												<?php // } 
													?>
 												<div class="col-sm-2">
 													<a target='_blank' href="<?php echo $base_url; ?>back_cal_report/brick_test.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

 												</div>
 											</div>
 										</div>
 									</div>
 									<br>
 									<!-- DISPLAY DATA LOGIC VAIBHAV-->
 									<div id="display_data">
 										<div class="row">
 											<div class="col-lg-12">
 												<table border="1px solid black" align="center" width="100%" id="aaaa">
 													<tr>
 														<th style="text-align:center;" width="10%"><label>Actions</label></th>
 														<!--<th style="text-align:center;"><label>Report No.</label></th>-->
 														
 														<th style="text-align:center;"><label>Job No.</label></th>
														<th style="text-align:center;"><label>Unique Identity No.</label></th>



 													</tr>
 													<?php
														$query = "select * from span_brick WHERE lab_no='$aa'  and `is_deleted`='0'";

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

 		//IMPACT VALUE LOGIC
 		var no_of_brick;
 		var dim_height;
 		var dim_width;
 		var dim_length;
 		var dim_height1;
 		var dim_width1;
 		var dim_length1;
 		var avg_height;
 		var avg_width;
 		var avg_length;


 		// Vivek : Change
 		$('#com_l_1,#com_l_2,#com_l_3,#com_l_4,#com_l_5,#com_l_6,#com_b_1,#com_b_2,#com_b_3,#com_b_4,#com_b_5,#com_b_6,#com_load_1,#com_load_2,#com_load_3,#com_load_4,#com_load_5,#com_load_6').change(function() {

 			var com_l_1 = $('#com_l_1').val();
 			var com_l_2 = $('#com_l_2').val();
 			var com_l_3 = $('#com_l_3').val();
 			var com_l_4 = $('#com_l_4').val();
 			var com_l_5 = $('#com_l_5').val();
 			var com_l_6 = $('#com_l_6').val();

 			var com_b_1 = $('#com_b_1').val();
 			var com_b_2 = $('#com_b_2').val();
 			var com_b_3 = $('#com_b_3').val();
 			var com_b_4 = $('#com_b_4').val();
 			var com_b_5 = $('#com_b_5').val();
 			var com_b_6 = $('#com_b_6').val();

 			var com_load_1 = $('#com_load_1').val();
 			var com_load_2 = $('#com_load_2').val();
 			var com_load_3 = $('#com_load_3').val();
 			var com_load_4 = $('#com_load_4').val();
 			var com_load_5 = $('#com_load_5').val();
 			var com_load_6 = $('#com_load_6').val();

 			var com_area_1 = ((+com_l_1) * (+com_b_1));
 			$('#com_area_1').val(com_area_1.toFixed(2));
 			var com_area_1 = $('#com_area_1').val();

 			var com_area_2 = ((+com_l_2) * (+com_b_2));
 			$('#com_area_2').val(com_area_2.toFixed(2));
 			var com_area_2 = $('#com_area_2').val();

 			var com_area_3 = ((+com_l_3) * (+com_b_3));
 			$('#com_area_3').val(com_area_3.toFixed(2));
 			var com_area_3 = $('#com_area_3').val();

 			var com_area_4 = ((+com_l_4) * (+com_b_4));
 			$('#com_area_4').val(com_area_4.toFixed(2));
 			var com_area_4 = $('#com_area_4').val();

 			var com_area_5 = ((+com_l_5) * (+com_b_5));
 			$('#com_area_5').val(com_area_5.toFixed(2));
 			var com_area_5 = $('#com_area_5').val();

 			var com_area_6 = ((+com_l_6) * (+com_b_6));
 			$('#com_area_6').val(com_area_6.toFixed(2));
 			var com_area_6 = $('#com_area_6').val();

 			var com_1 = (((+com_load_1) / ((+com_l_1) * (+com_b_1))) * (+1000));
 			$('#com_1').val(com_1.toFixed(2));
 			var com_1 = $('#com_1').val();

 			var com_2 = ((+com_load_2) / ((+com_l_2) * (+com_b_2)) * (+1000));
 			$('#com_2').val(com_2.toFixed(2));
 			var com_2 = $('#com_2').val();

 			var com_3 = ((+com_load_3) / ((+com_l_3) * (+com_b_3)) * (+1000));
 			$('#com_3').val(com_3.toFixed(2));
 			var com_3 = $('#com_3').val();

 			var com_4 = ((+com_load_4) / ((+com_l_4) * (+com_b_4)) * (+1000));
 			$('#com_4').val(com_4.toFixed(2));
 			var com_4 = $('#com_4').val();

 			var com_5 = ((+com_load_5) / ((+com_l_5) * (+com_b_5)) * (+1000));
 			$('#com_5').val(com_5.toFixed(2));
 			var com_5 = $('#com_5').val();
			
			var com_6 = ((+com_load_6) / ((+com_l_6) * (+com_b_6)) * (+1000));
 			$('#com_6').val(com_6.toFixed(2));
 			var com_6 = $('#com_6').val();
			

 			var avg_com = (((+com_1) + (+com_2) + (+com_3) + (+com_4) + (+com_5) + (+com_6)) / (+6));
 			$('#avg_com').val(avg_com.toFixed(2));
 			var avg_com = $('#avg_com').val();



 		});
	// sahil Change DIMENSION AND TOLERANCE
	
	$('dim_length,dim_length1,dim_width,dim_width1,dim_height,#dim_height1').change(function() {
		
		var dim_length = $('#dim_length').val();	
		var dim_length1 = $('#dim_length1').val();	
		var dim_width = $('#dim_width').val();	
		var dim_width1 = $('#dim_width1').val();	
		var dim_height = $('#dim_height').val();	
		var dim_height1 = $('#dim_height1').val();	
			
			
		var avg_length = (((+dim_length) + (+dim_length1)) / (+2));
 		$('#avg_length').val(avg_length.toFixed(2));
	
		
		var avg_width = (((+dim_width) + (+dim_width1)) / (+2));
 		$('#avg_width').val(avg_width.toFixed(2));
	
		var avg_height = (((+dim_height) + (+dim_height1)) / (+2));
 		$('#avg_height').val(avg_height.toFixed(2));
	
	
	
	
	});
	

 		// Vivek : Change
 		$('wtr_w1_1,wtr_w1_2,wtr_w1_3,wtr_w1_4,wtr_w1_5,wtr_w1_6,#wtr_w2_1,#wtr_w2_2,#wtr_w2_3,#wtr_w2_4,#wtr_w2_5,#wtr_w2_6').change(function() {

 			var wtr_w1_1 = $('#wtr_w1_1').val();
 			var wtr_w1_2 = $('#wtr_w1_2').val();
 			var wtr_w1_3 = $('#wtr_w1_3').val();
 			var wtr_w1_4 = $('#wtr_w1_4').val();
 			var wtr_w1_5 = $('#wtr_w1_5').val();
 			var wtr_w1_6 = $('#wtr_w1_6').val();

 			var wtr_w2_1 = $('#wtr_w2_1').val();
 			var wtr_w2_2 = $('#wtr_w2_2').val();
 			var wtr_w2_3 = $('#wtr_w2_3').val();
 			var wtr_w2_4 = $('#wtr_w2_4').val();
 			var wtr_w2_5 = $('#wtr_w2_5').val();
 			var wtr_w2_6 = $('#wtr_w2_6').val();

 			var wtr_1 = (((+wtr_w2_1)-(+wtr_w1_1)) / (+wtr_w1_1) * (+100));
 			$('#wtr_1').val(wtr_1.toFixed(2));
 			var wtr_1 = $('#wtr_1').val();

 			var wtr_2 = (((+wtr_w2_2)-(+wtr_w1_2)) / (+wtr_w1_2) * (+100));
 			$('#wtr_2').val(wtr_2.toFixed(2));
 			var wtr_2 = $('#wtr_2').val();

 			var wtr_3 = (((+wtr_w2_3)-(+wtr_w1_3)) / (+wtr_w1_3) * (+100));
 			$('#wtr_3').val(wtr_3.toFixed(2));
 			var wtr_3 = $('#wtr_3').val();

 			var wtr_4 = (((+wtr_w2_4)-(+wtr_w1_4)) / (+wtr_w1_4) * (+100));
 			$('#wtr_4').val(wtr_4.toFixed(2));
 			var wtr_4 = $('#wtr_4').val();

 			var wtr_5 = (((+wtr_w2_5)-(+wtr_w1_5)) / (+wtr_w1_5) * (+100));
 			$('#wtr_5').val(wtr_5.toFixed(2));
 			var wtr_5 = $('#wtr_5').val();

 			var wtr_6 = (((+wtr_w2_6)-(+wtr_w1_6)) / (+wtr_w1_6) * (+100));
 			$('#wtr_6').val(wtr_6.toFixed(2));
 			var wtr_6 = $('#wtr_6').val();

 			var avg_wtr = (((+wtr_1) + (+wtr_2) + (+wtr_3) + (+wtr_4) + (+wtr_5) + (+wtr_6)) / (+6));
 			$('#avg_wtr').val(avg_wtr.toFixed(2));
 			var avg_wtr = $('#avg_wtr').val();
 		});

 		$('#chk_dim').change(function() {
 			if (this.checked) {
 				$('#txtdim').css("background-color", "var(--success)");
 			} else {
 				$('#txtdim').css("background-color", "white");
 			}
 		});

 		function dim_auto() {
 			$('#txtdim').css("background-color", "var(--success)");
 			no_of_brick = 20;
 			$('#no_of_brick').val(no_of_brick.toFixed(0));
 			var bl = $('#b_l').val();
 			var bb = $('#b_w').val();
 			var bh = $('#b_h').val();

 			var b_l1 = (+bl) * 20;
 			var b_l2 = (+bb) * 20;
 			var b_l3 = (+bh) * 20;

 			avg_length = randomNumberFromRange((+b_l1) - (+10), (+b_l1) + (+50)).toFixed();
 			avg_width = randomNumberFromRange((+b_l2) - (+10), (+b_l2) + (+30)).toFixed();
 			avg_height = randomNumberFromRange((+b_l3) - (+10), (+b_l3) + (+30)).toFixed();

 			dim_height = parseInt(avg_height) + parseInt(randomNumberFromRange(-2, 2).toFixed());
 			dim_width = parseInt(avg_width) + parseInt(randomNumberFromRange(-3, 3).toFixed());
 			dim_length = parseInt(avg_length) + parseInt(randomNumberFromRange(-3, 3).toFixed());

 			dim_height1 = ((parseInt(avg_height) * 2) - parseInt(dim_height));
 			dim_width1 = ((parseInt(avg_width) * 2) - parseInt(dim_width));
 			dim_length1 = ((parseInt(avg_length) * 2) - parseInt(dim_length));

 			$('#avg_height').val(avg_height);
 			$('#avg_width').val(avg_width);
 			$('#avg_length').val(avg_length);
 			$('#dim_height').val(dim_height);
 			$('#dim_width').val(dim_width);
 			$('#dim_length').val(dim_length);
 			$('#dim_height1').val(dim_height1.toFixed());
 			$('#dim_width1').val(dim_width1.toFixed());
 			$('#dim_length1').val(dim_length1.toFixed());
 		}


		
 		$('#chk_dim').change(function() {
 			if (this.checked) {
 				dim_auto();
 			} else {
 				$('#no_of_brick').val(null);
 				$('#id_mark').val(null);
 				$('#temp1').val(null);
 				$('#avg_height').val(null);
 				$('#avg_width').val(null);
 				$('#avg_length').val(null);
 				$('#dim_height').val(null);
 				$('#dim_width').val(null);
 				$('#dim_length').val(null);
 				$('#dim_height1').val(null);
 				$('#dim_width1').val(null);
 				$('#dim_length1').val(null);
 			}
 		});






 		var wtr_lab_1 = "";
 		var wtr_lab_2 = "";
 		var wtr_lab_3 = "";
 		var wtr_lab_4 = "";
 		var wtr_lab_5 = "";
 		var wtr_lab_6 = "";
 		var wtr_w1_1 = "";
 		var wtr_w1_2 = "";
 		var wtr_w1_3 = "";
 		var wtr_w1_4 = "";
 		var wtr_w1_5 = "";
 		var wtr_w1_6 = "";
 		var avg_wtr = "";
 		var wtr_1 = "";
 		var wtr_2 = "";
 		var wtr_3 = "";
 		var wtr_4 = "";
 		var wtr_5 = "";
 		var wtr_6 = "";
 		var wtr_w2_1 = "";
 		var wtr_w2_2 = "";
 		var wtr_w2_3 = "";
 		var wtr_w2_4 = "";
 		var wtr_w2_5 = "";
 		var wtr_w2_6 = "";

 		function wtr_auto() {
 			$('#txtwtr').css("background-color", "var(--success)");
 			var lab_ids = $('#lab_no').val();
 			wtr_lab_1 = "WA-01";
 			wtr_lab_2 = "WA-02";
 			wtr_lab_3 = "WA-03";
 			wtr_lab_4 = "WA-04";
 			wtr_lab_5 = "WA-05";
 			wtr_lab_6 = "WA-06";
 			$('#wtr_lab_1').val(wtr_lab_1);
 			$('#wtr_lab_2').val(wtr_lab_2);
 			$('#wtr_lab_3').val(wtr_lab_3);
 			$('#wtr_lab_4').val(wtr_lab_4);
 			$('#wtr_lab_5').val(wtr_lab_5);
 			$('#wtr_lab_6').val(wtr_lab_6);

 			wtr_w1_1 = randomNumberFromRange(2300, 2550).toFixed();
 			wtr_w1_2 = randomNumberFromRange(2300, 2550).toFixed();
 			wtr_w1_3 = randomNumberFromRange(2300, 2550).toFixed();
 			wtr_w1_4 = randomNumberFromRange(2300, 2550).toFixed();
 			wtr_w1_5 = randomNumberFromRange(2300, 2550).toFixed();
 			wtr_w1_6 = randomNumberFromRange(2300, 2550).toFixed();

 			$('#wtr_w1_1').val(wtr_w1_1);
 			$('#wtr_w1_2').val(wtr_w1_2);
 			$('#wtr_w1_3').val(wtr_w1_3);
 			$('#wtr_w1_4').val(wtr_w1_4);
 			$('#wtr_w1_5').val(wtr_w1_5);
 			$('#wtr_w1_6').val(wtr_w1_6);


 			avg_wtr = randomNumberFromRange(10.50, 15.50).toFixed(1);
 			$('#avg_wtr').val(avg_wtr);
 			var avgwtr = $('#avg_wtr').val();
 			var ty = randomNumberFromRange(1, 9).toFixed(0);
 			if (ty % 2 == 0) {
 				wtr_1 = (+avgwtr) + 0.58;
 				wtr_2 = (+avgwtr) + 1.02;
 				wtr_3 = (+avgwtr) + 1.00;
 				wtr_4 = (+avgwtr) - 1.09;
 				wtr_5 = (+avgwtr) - 1.01;
 				wtr_6 = (+avgwtr) - 0.50;
 			} else {
 				wtr_1 = (+avgwtr) - 1.08;
 				wtr_2 = (+avgwtr) - 1.02;
 				wtr_3 = (+avgwtr) + 1.00;
 				wtr_4 = (+avgwtr) + 0.58;
 				wtr_5 = (+avgwtr) + 1.02;
 				wtr_6 = (+avgwtr) - 0.50;
 			}

 			$('#wtr_1').val(wtr_1.toFixed(2));
 			$('#wtr_2').val(wtr_2.toFixed(2));
 			$('#wtr_3').val(wtr_3.toFixed(2));
 			$('#wtr_4').val(wtr_4.toFixed(2));
 			$('#wtr_5').val(wtr_5.toFixed(2));
 			$('#wtr_6').val(wtr_6.toFixed(2));

 			var wtr1 = $('#wtr_1').val();
 			var wtr2 = $('#wtr_2').val();
 			var wtr3 = $('#wtr_3').val();
 			var wtr4 = $('#wtr_4').val();
 			var wtr5 = $('#wtr_5').val();
 			var wtr6 = $('#wtr_6').val();

 			var wtr_w11 = $('#wtr_w1_1').val();
 			var wtr_w12 = $('#wtr_w1_2').val();
 			var wtr_w13 = $('#wtr_w1_3').val();
 			var wtr_w14 = $('#wtr_w1_4').val();
 			var wtr_w15 = $('#wtr_w1_5').val();
 			var wtr_w16 = $('#wtr_w1_6').val();

 			var eq1 = ((+wtr1) / 100) * (+wtr_w11);
 			var eq2 = ((+wtr2) / 100) * (+wtr_w12);
 			var eq3 = ((+wtr3) / 100) * (+wtr_w13);
 			var eq4 = ((+wtr4) / 100) * (+wtr_w14);
 			var eq5 = ((+wtr5) / 100) * (+wtr_w15);
 			var eq6 = ((+wtr6) / 100) * (+wtr_w16);

 			var wtr_w2_1 = (+eq1) + (+wtr_w11);
 			var wtr_w2_2 = (+eq2) + (+wtr_w12);
 			var wtr_w2_3 = (+eq3) + (+wtr_w13);
 			var wtr_w2_4 = (+eq4) + (+wtr_w14);
 			var wtr_w2_5 = (+eq5) + (+wtr_w15);
 			var wtr_w2_6 = (+eq6) + (+wtr_w16);

 			$('#wtr_w2_1').val(wtr_w2_1.toFixed());
 			$('#wtr_w2_2').val(wtr_w2_2.toFixed());
 			$('#wtr_w2_3').val(wtr_w2_3.toFixed());
 			$('#wtr_w2_4').val(wtr_w2_4.toFixed());
 			$('#wtr_w2_5').val(wtr_w2_5.toFixed());
 			$('#wtr_w2_6').val(wtr_w2_6.toFixed());

 			var wtrw11 = $('#wtr_w1_1').val();
 			var wtrw12 = $('#wtr_w1_2').val();
 			var wtrw13 = $('#wtr_w1_3').val();
 			var wtrw14 = $('#wtr_w1_4').val();
 			var wtrw15 = $('#wtr_w1_5').val();
 			var wtrw16 = $('#wtr_w1_6').val();

 			var wtrw21 = $('#wtr_w2_1').val();
 			var wtrw22 = $('#wtr_w2_2').val();
 			var wtrw23 = $('#wtr_w2_3').val();
 			var wtrw24 = $('#wtr_w2_4').val();
 			var wtrw25 = $('#wtr_w2_5').val();
 			var wtrw26 = $('#wtr_w2_6').val();

 			var wt_r1 = (((+wtrw21) - (+wtrw11)) / (+wtrw11)) * 100;
 			var wt_r2 = (((+wtrw22) - (+wtrw12)) / (+wtrw12)) * 100;
 			var wt_r3 = (((+wtrw23) - (+wtrw13)) / (+wtrw13)) * 100;
 			var wt_r4 = (((+wtrw24) - (+wtrw14)) / (+wtrw14)) * 100;
 			var wt_r5 = (((+wtrw25) - (+wtrw15)) / (+wtrw15)) * 100;
 			var wt_r6 = (((+wtrw26) - (+wtrw16)) / (+wtrw16)) * 100;
 			$('#wtr_1').val(wt_r1.toFixed(2));
 			$('#wtr_2').val(wt_r2.toFixed(2));
 			$('#wtr_3').val(wt_r3.toFixed(2));
 			$('#wtr_4').val(wt_r4.toFixed(2));
 			$('#wtr_5').val(wt_r5.toFixed(2));
 			$('#wtr_6').val(wt_r6.toFixed(2));

 			var w_tr1 = $('#wtr_1').val();
 			var w_tr2 = $('#wtr_2').val();
 			var w_tr3 = $('#wtr_3').val();
 			var w_tr4 = $('#wtr_4').val();
 			var w_tr5 = $('#wtr_5').val();
 			var w_tr6 = $('#wtr_6').val();

 			avg_wtr = ((+w_tr1) + (+w_tr2) + (+w_tr3) + (+w_tr4) + (+w_tr5) + (+w_tr6)) / 6;

 			$('#avg_wtr').val(avg_wtr.toFixed(2));


 		}

 		//IMPACT VALUE LOGIC
 		$('#chk_wtr').change(function() {
 			if (this.checked) {
 				wtr_auto();

 			} else {
 				$('#txtwtr').css("background-color", "white");
 				$('#wtr_lab_1').val(null);
 				$('#wtr_lab_2').val(null);
 				$('#wtr_lab_3').val(null);
 				$('#wtr_lab_4').val(null);
 				$('#wtr_lab_5').val(null);
 				$('#wtr_lab_6').val(null);
 				$('#wtr_w1_1').val(null);
 				$('#wtr_w1_2').val(null);
 				$('#wtr_w1_3').val(null);
 				$('#wtr_w1_4').val(null);
 				$('#wtr_w1_5').val(null);
 				$('#wtr_w1_6').val(null);
 				$('#avg_wtr').val(null);
 				$('#wtr_1').val(null);
 				$('#wtr_2').val(null);
 				$('#wtr_3').val(null);
 				$('#wtr_4').val(null);
 				$('#wtr_5').val(null);
 				$('#wtr_6').val(null);
 				$('#wtr_w2_1').val(null);
 				$('#wtr_w2_2').val(null);
 				$('#wtr_w2_3').val(null);
 				$('#wtr_w2_4').val(null);
 				$('#wtr_w2_5').val(null);
 				$('#wtr_w2_6').val(null);
 			}

 		});





 		var con_grade = "";
 		var com_lab_1 = "";
 		var com_lab_2 = "";
 		var com_lab_3 = "";
 		var com_lab_4 = "";
 		var com_lab_5 = "";
 		var com_lab_6 = "";
 		var com_l_1 = "";
 		var com_l_2 = "";
 		var com_l_3 = "";
 		var com_l_4 = "";
 		var com_l_5 = "";
 		var com_l_6 = "";
 		var com_b_1 = "";
 		var com_b_2 = "";
 		var com_b_3 = "";
 		var com_b_4 = "";
 		var com_b_5 = "";
 		var com_b_6 = "";
 		var com_h_1 = "";
 		var com_h_2 = "";
 		var com_h_3 = "";
 		var com_h_4 = "";
 		var com_h_5 = "";
 		var com_h_6 = "";

 		var com_area_1 = "";
 		var com_area_2 = "";
 		var com_area_3 = "";
 		var com_area_4 = "";
 		var com_area_5 = "";
 		var com_area_6 = "";

 		var com_load_1 = "";
 		var com_load_2 = "";
 		var com_load_3 = "";
 		var com_load_4 = "";
 		var com_load_5 = "";
 		var com_load_6 = "";

 		var com_1 = "";
 		var com_2 = "";
 		var com_3 = "";
 		var com_4 = "";
 		var com_5 = "";
 		var com_6 = "";
 		var avg_com = "";

 		function com_auto() {
 			$('#txtcom').css("background-color", "var(--success)");
 			var lab_ids = $('#lab_no').val();
 			com_lab_1 = "CS-01";
 			com_lab_2 = "CS-02";
 			com_lab_3 = "CS-03";
 			com_lab_4 = "CS-04";
 			com_lab_5 = "CS-05";
 			com_lab_6 = "CS-06";
 			$('#com_lab_1').val(com_lab_1);
 			$('#com_lab_2').val(com_lab_2);
 			$('#com_lab_3').val(com_lab_3);
 			$('#com_lab_4').val(com_lab_4);
 			$('#com_lab_5').val(com_lab_5);
 			$('#com_lab_6').val(com_lab_6);

 			com_l_1 = randomNumberFromRange(227, 233).toFixed();
 			com_l_2 = randomNumberFromRange(227, 233).toFixed();
 			com_l_3 = randomNumberFromRange(227, 233).toFixed();
 			com_l_4 = randomNumberFromRange(227, 233).toFixed();
 			com_l_5 = randomNumberFromRange(227, 233).toFixed();
 			com_l_6 = randomNumberFromRange(227, 233).toFixed();

 			$('#com_l_1').val(com_l_1);
 			$('#com_l_2').val(com_l_2);
 			$('#com_l_3').val(com_l_3);
 			$('#com_l_4').val(com_l_4);
 			$('#com_l_5').val(com_l_5);
 			$('#com_l_6').val(com_l_6);

 			com_b_1 = randomNumberFromRange(107, 113).toFixed();
 			com_b_2 = randomNumberFromRange(107, 113).toFixed();
 			com_b_3 = randomNumberFromRange(107, 113).toFixed();
 			com_b_4 = randomNumberFromRange(107, 113).toFixed();
 			com_b_5 = randomNumberFromRange(107, 113).toFixed();
 			com_b_6 = randomNumberFromRange(107, 113).toFixed();

 			$('#com_b_1').val(com_b_1);
 			$('#com_b_2').val(com_b_2);
 			$('#com_b_3').val(com_b_3);
 			$('#com_b_4').val(com_b_4);
 			$('#com_b_5').val(com_b_5);
 			$('#com_b_6').val(com_b_6);

 			com_h_1 = randomNumberFromRange(63, 70).toFixed();
 			com_h_3 = randomNumberFromRange(63, 70).toFixed();
 			com_h_2 = randomNumberFromRange(63, 70).toFixed();
 			com_h_4 = randomNumberFromRange(63, 70).toFixed();
 			com_h_5 = randomNumberFromRange(63, 70).toFixed();
 			com_h_6 = randomNumberFromRange(63, 70).toFixed();

 			$('#com_h_1').val(com_h_1);
 			$('#com_h_2').val(com_h_2);
 			$('#com_h_3').val(com_h_3);
 			$('#com_h_4').val(com_h_4);
 			$('#com_h_5').val(com_h_5);
 			$('#com_h_6').val(com_h_6);

 			com_l1 = $('#com_l_1').val();
 			com_l2 = $('#com_l_2').val();
 			com_l3 = $('#com_l_3').val();
 			com_l4 = $('#com_l_4').val();
 			com_l5 = $('#com_l_5').val();
 			com_l6 = $('#com_l_6').val();

 			com_b1 = $('#com_b_1').val();
 			com_b2 = $('#com_b_2').val();
 			com_b3 = $('#com_b_3').val();
 			com_b4 = $('#com_b_4').val();
 			com_b5 = $('#com_b_5').val();
 			com_b6 = $('#com_b_6').val();

 			com_h1 = $('#com_h_1').val();
 			com_h2 = $('#com_h_2').val();
 			com_h3 = $('#com_h_3').val();
 			com_h4 = $('#com_h_4').val();
 			com_h5 = $('#com_h_5').val();
 			com_h6 = $('#com_h_6').val();

 			com_area_1 = (+com_l1) * (+com_b1);
 			com_area_2 = (+com_l2) * (+com_b2);
 			com_area_3 = (+com_l3) * (+com_b3);
 			com_area_4 = (+com_l4) * (+com_b4);
 			com_area_5 = (+com_l5) * (+com_b5);
 			com_area_6 = (+com_l6) * (+com_b6);

 			$('#com_area_1').val(com_area_1.toFixed(1));
 			$('#com_area_2').val(com_area_2.toFixed(1));
 			$('#com_area_3').val(com_area_3.toFixed(1));
 			$('#com_area_4').val(com_area_4.toFixed(1));
 			$('#com_area_5').val(com_area_5.toFixed(1));
 			$('#com_area_6').val(com_area_6.toFixed(1));

 			var com_area1 = $('#com_area_1').val();
 			var com_area2 = $('#com_area_2').val();
 			var com_area3 = $('#com_area_3').val();
 			var com_area4 = $('#com_area_4').val();
 			var com_area5 = $('#com_area_5').val();
 			var com_area6 = $('#com_area_6').val();

 			var spec = $('#speci').val();
 			if (spec == "3.5") {
 				avg_com = randomNumberFromRange(4.80, 4.90).toFixed(2);
 			} else if (spec == "5") {
 				avg_com = randomNumberFromRange(5.55, 7.00).toFixed(2);
 			} else if (spec == "7.5") {
 				avg_com = randomNumberFromRange(7.80, 9.50).toFixed(2);
 			} else if (spec == "10") {
 				avg_com = randomNumberFromRange(10.50, 11.50).toFixed(2);
 			} else if (spec == "12.5") {
 				avg_com = randomNumberFromRange(13.00, 14.50).toFixed(2);
 			} else if (spec == "15") {
 				avg_com = randomNumberFromRange(15.50, 17.00).toFixed(2);
 			} else if (spec == "17.5") {
 				avg_com = randomNumberFromRange(18.00, 19.50).toFixed(2);
 			} else if (spec == "20") {
 				avg_com = randomNumberFromRange(20.50, 23.50).toFixed(2);
 			} else if (spec == "25") {
 				avg_com = randomNumberFromRange(25.50, 28.50).toFixed(2);
 			} else if (spec == "30") {
 				avg_com = randomNumberFromRange(30.50, 33.50).toFixed(2);
 			} else if (spec == "35") {
 				avg_com = randomNumberFromRange(35.50, 38.50).toFixed(2);
 			}
 			$('#avg_com').val(avg_com);
 			var avgcom = $('#avg_com').val();
 			var sd = randomNumberFromRange(1, 9).toFixed(0);
 			if (sd % 2 == 0) {
 				com_1 = (+avgcom) + (+0.58);
 				com_2 = (+avgcom) - (+0.98);
 				com_3 = (+avgcom) + (+0.66);
 				com_4 = (+avgcom) - (+0.41);
 				com_5 = (+avgcom) + (+0.76);
 				com_6 = (+avgcom) - (+0.61);
 			} else {
 				com_1 = (+avgcom) - (+0.58);
 				com_2 = (+avgcom) + (+0.98);
 				com_3 = (+avgcom) - (+0.65);
 				com_4 = (+avgcom) + (+0.51);
 				com_5 = (+avgcom) - (+0.76);
 				com_6 = (+avgcom) + (+0.50);
 			}


 			$('#com_1').val(com_1.toFixed(2));
 			$('#com_2').val(com_2.toFixed(2));
 			$('#com_3').val(com_3.toFixed(2));
 			$('#com_4').val(com_4.toFixed(2));
 			$('#com_5').val(com_5.toFixed(2));
 			$('#com_6').val(com_6.toFixed(2));

 			var com1 = $('#com_1').val();
 			var com2 = $('#com_2').val();
 			var com3 = $('#com_3').val();
 			var com4 = $('#com_4').val();
 			var com5 = $('#com_5').val();
 			var com6 = $('#com_6').val();

 			com_load_1 = ((+com_area1) * (+com1)) / 1000;
 			com_load_2 = ((+com_area2) * (+com2)) / 1000;
 			com_load_3 = ((+com_area3) * (+com3)) / 1000;
 			com_load_4 = ((+com_area4) * (+com4)) / 1000;
 			com_load_5 = ((+com_area5) * (+com5)) / 1000;
 			com_load_6 = ((+com_area6) * (+com6)) / 1000;

 			$('#com_load_1').val(com_load_1.toFixed(1));
 			$('#com_load_2').val(com_load_2.toFixed(1));
 			$('#com_load_3').val(com_load_3.toFixed(1));
 			$('#com_load_4').val(com_load_4.toFixed(1));
 			$('#com_load_5').val(com_load_5.toFixed(1));
 			$('#com_load_6').val(com_load_6.toFixed(1));

 			var comload1 = $('#com_load_1').val();
 			var comload2 = $('#com_load_2').val();
 			var comload3 = $('#com_load_3').val();
 			var comload4 = $('#com_load_4').val();
 			var comload5 = $('#com_load_5').val();
 			var comload6 = $('#com_load_6').val();

 			var newcom1 = ((+comload1) / (+com_area1)) * 1000;
 			var newcom2 = ((+comload2) / (+com_area2)) * 1000;
 			var newcom3 = ((+comload3) / (+com_area3)) * 1000;
 			var newcom4 = ((+comload4) / (+com_area4)) * 1000;
 			var newcom5 = ((+comload5) / (+com_area5)) * 1000;
 			var newcom6 = ((+comload6) / (+com_area6)) * 1000;

 			$('#com_1').val(newcom1.toFixed(2));
 			$('#com_2').val(newcom2.toFixed(2));
 			$('#com_3').val(newcom3.toFixed(2));
 			$('#com_4').val(newcom4.toFixed(2));
 			$('#com_5').val(newcom5.toFixed(2));
 			$('#com_6').val(newcom6.toFixed(2));

 			var comp_001 = $('#com_1').val();
 			var comp_002 = $('#com_2').val();
 			var comp_003 = $('#com_3').val();
 			var comp_004 = $('#com_4').val();
 			var comp_005 = $('#com_5').val();
 			var comp_006 = $('#com_6').val();

 			var avgs = ((+comp_001) + (+comp_002) + (+comp_003) + (+comp_004) + (+comp_005) + (+comp_006)) / 6;
 			$('#avg_com').val(avgs.toFixed(2));


 		}

 		$('#chk_com').change(function() {
 			if (this.checked) {

 				com_auto();

 			} else {
 				$('#txtcom').css("background-color", "white");
 				$('#con_grade').val(null);
 				$('#com_lab_1').val(null);
 				$('#com_lab_2').val(null);
 				$('#com_lab_3').val(null);
 				$('#com_lab_4').val(null);
 				$('#com_lab_5').val(null);
 				$('#com_l_1').val(null);
 				$('#com_l_2').val(null);
 				$('#com_l_3').val(null);
 				$('#com_l_4').val(null);
 				$('#com_l_5').val(null);
 				$('#com_b_1').val(null);
 				$('#com_b_2').val(null);
 				$('#com_b_3').val(null);
 				$('#com_b_4').val(null);
 				$('#com_b_5').val(null);
 				$('#com_h_1').val(null);
 				$('#com_h_2').val(null);
 				$('#com_h_3').val(null);
 				$('#com_h_4').val(null);
 				$('#com_h_5').val(null);
 				$('#com_area_1').val(null);
 				$('#com_area_2').val(null);
 				$('#com_area_3').val(null);
 				$('#com_area_4').val(null);
 				$('#com_area_5').val(null);
 				$('#avg_com').val(null);
 				$('#com_1').val(null);
 				$('#com_2').val(null);
 				$('#com_3').val(null);
 				$('#com_4').val(null);
 				$('#com_5').val(null);
 				$('#com_load_1').val(null);
 				$('#com_load_2').val(null);
 				$('#com_load_3').val(null);
 				$('#com_load_4').val(null);
 				$('#com_load_5').val(null);
 			}

 		});

 		function com_l_func() {
 			$('#txtcom').css("background-color", "var(--success)");
 			com_l_1 = $('#com_l_1').val();
 			com_l_2 = $('#com_l_2').val();
 			com_l_3 = $('#com_l_3').val();
 			com_l_4 = $('#com_l_4').val();
 			com_l_5 = $('#com_l_5').val();
 			com_l_6 = $('#com_l_6').val();

 			com_b_1 = $('#com_b_1').val();
 			com_b_2 = $('#com_b_2').val();
 			com_b_3 = $('#com_b_3').val();
 			com_b_4 = $('#com_b_4').val();
 			com_b_5 = $('#com_b_5').val();
 			com_b_6 = $('#com_b_6').val();

 			com_h_1 = $('#com_h_1').val();
 			com_h_2 = $('#com_h_2').val();
 			com_h_3 = $('#com_h_3').val();
 			com_h_4 = $('#com_h_4').val();
 			com_h_5 = $('#com_h_5').val();
 			com_h_6 = $('#com_h_6').val();


 			com_area_1 = (+com_l_1) * (+com_b_1);
 			com_area_2 = (+com_l_2) * (+com_b_2);
 			com_area_3 = (+com_l_3) * (+com_b_3);
 			com_area_4 = (+com_l_4) * (+com_b_4);
 			com_area_5 = (+com_l_5) * (+com_b_5);
 			com_area_6 = (+com_l_6) * (+com_b_6);

 			$('#com_area_1').val(com_area_1.toFixed(1));
 			$('#com_area_2').val(com_area_2.toFixed(1));
 			$('#com_area_3').val(com_area_3.toFixed(1));
 			$('#com_area_4').val(com_area_4.toFixed(1));
 			$('#com_area_5').val(com_area_5.toFixed(1));
 			$('#com_area_6').val(com_area_6.toFixed(1));
 			var com_area1 = $('#com_area_1').val();
 			var com_area2 = $('#com_area_2').val();
 			var com_area3 = $('#com_area_3').val();
 			var com_area4 = $('#com_area_4').val();
 			var com_area5 = $('#com_area_5').val();
 			var com_area6 = $('#com_area_6').val();

 			var avg_com1 = $('#avg_com').val();
			
			

 			

 			
			
			
 			var sd1 = randomNumberFromRange(1, 9).toFixed(0);
 			if (sd1 % 2 == 0) {
 				com_1 = (+avgcom) + (+0.58);
 				com_2 = (+avgcom) - (+0.98);
 				com_3 = (+avgcom) + (+0.66);
 				com_4 = (+avgcom) - (+0.41);
 				com_5 = (+avgcom) + (+0.76);
 				com_6 = (+avgcom) - (+0.61);
 			} else {
 				com_1 = (+avgcom) - (+0.58);
 				com_2 = (+avgcom) + (+0.98);
 				com_3 = (+avgcom) - (+0.65);
 				com_4 = (+avgcom) + (+0.51);
 				com_5 = (+avgcom) - (+0.76);
 				com_6 = (+avgcom) + (+0.50);
 			}

 			
			$('#com_1').val(com_1.toFixed(2));
 			$('#com_2').val(com_2.toFixed(2));
 			$('#com_3').val(com_3.toFixed(2));
 			$('#com_4').val(com_4.toFixed(2));
 			$('#com_5').val(com_5.toFixed(2));
 			$('#com_6').val(com_6.toFixed(2));

 			var com1 = $('#com_1').val();
 			var com2 = $('#com_2').val();
 			var com3 = $('#com_3').val();
 			var com4 = $('#com_4').val();
 			var com5 = $('#com_5').val();
 			var com6 = $('#com_6').val();

 			com_load_1 = ((+com_area1) * (+com1)) / 1000;
 			com_load_2 = ((+com_area2) * (+com2)) / 1000;
 			com_load_3 = ((+com_area3) * (+com3)) / 1000;
 			com_load_4 = ((+com_area4) * (+com4)) / 1000;
 			com_load_5 = ((+com_area5) * (+com5)) / 1000;
 			com_load_6 = ((+com_area6) * (+com6)) / 1000;

 			$('#com_load_1').val(com_load_1.toFixed(1));
 			$('#com_load_2').val(com_load_2.toFixed(1));
 			$('#com_load_3').val(com_load_3.toFixed(1));
 			$('#com_load_4').val(com_load_4.toFixed(1));
 			$('#com_load_5').val(com_load_5.toFixed(1));
 			$('#com_load_6').val(com_load_6.toFixed(1));

 			var comload1 = $('#com_load_1').val();
 			var comload2 = $('#com_load_2').val();
 			var comload3 = $('#com_load_3').val();
 			var comload4 = $('#com_load_4').val();
 			var comload5 = $('#com_load_5').val();
 			var comload6 = $('#com_load_6').val();

 			var newcom1 = ((+comload1) / (+com_area1)) * 1000;
 			var newcom2 = ((+comload2) / (+com_area2)) * 1000;
 			var newcom3 = ((+comload3) / (+com_area3)) * 1000;
 			var newcom4 = ((+comload4) / (+com_area4)) * 1000;
 			var newcom5 = ((+comload5) / (+com_area5)) * 1000;
 			var newcom6 = ((+comload6) / (+com_area6)) * 1000;

 			$('#com_1').val(newcom1.toFixed(2));
 			$('#com_2').val(newcom2.toFixed(2));
 			$('#com_3').val(newcom3.toFixed(2));
 			$('#com_4').val(newcom4.toFixed(2));
 			$('#com_5').val(newcom5.toFixed(2));
 			$('#com_6').val(newcom6.toFixed(2));

 			var comp_001 = $('#com_1').val();
 			var comp_002 = $('#com_2').val();
 			var comp_003 = $('#com_3').val();
 			var comp_004 = $('#com_4').val();
 			var comp_005 = $('#com_5').val();
 			var comp_006 = $('#com_6').val();

 			var avgs = ((+comp_001) + (+comp_002) + (+comp_003) + (+comp_004) + (+comp_005) + (+comp_006)) / 6;
 			$('#avg_com').val(avgs.toFixed(2));
 		}






 		function load_data() {
 			$('#txtcom').css("background-color", "var(--success)");
 			com_load_1 = $('#com_load_1').val();
 			com_load_2 = $('#com_load_2').val();
 			com_load_3 = $('#com_load_3').val();
 			com_load_4 = $('#com_load_4').val();
 			com_load_5 = $('#com_load_5').val();
 			com_load_6 = $('#com_load_6').val();


 			com_area_1 = $('#com_area_1').val();
 			com_area_2 = $('#com_area_2').val();
 			com_area_3 = $('#com_area_3').val();
 			com_area_4 = $('#com_area_4').val();
 			com_area_5 = $('#com_area_5').val();
 			com_area_6 = $('#com_area_6').val();

 			com_1 = ((+com_load_1) / (+com_area_1)) * 1000;
 			com_2 = ((+com_load_2) / (+com_area_2)) * 1000;
 			com_3 = ((+com_load_3) / (+com_area_3)) * 1000;
 			com_4 = ((+com_load_4) / (+com_area_4)) * 1000;
 			com_5 = ((+com_load_5) / (+com_area_5)) * 1000;
 			com_6 = ((+com_load_6) / (+com_area_6)) * 1000;

 			$('#com_1').val(com_1.toFixed(2));
 			$('#com_2').val(com_2.toFixed(2));
 			$('#com_3').val(com_3.toFixed(2));
 			$('#com_4').val(com_4.toFixed(2));
 			$('#com_5').val(com_5.toFixed(2));
 			$('#com_6').val(com_6.toFixed(2));

 			var com1 = $('#com_1').val();
 			var com2 = $('#com_2').val();
 			var com3 = $('#com_3').val();
 			var com4 = $('#com_4').val();
 			var com5 = $('#com_5').val();
 			var com6 = $('#com_6').val();
 			var avg_com = ((+com1) + (+com2) + (+com3) + (+com4) + (+com5) + (+com6)) / 6;

 			$('#avg_com').val(avg_com.toFixed(2));

 		}
// sahil
 		function efflo_auto() {
 			$('#txteff').css("background-color", "var(--success)");
 			var cont = 0;
 			var ef1 = randomNumberFromRange(0, 9).toFixed(0);
 			if (ef1 % 2 == 0) {
 				$('#rbt_efflo1').val("NIL");

 			} else {
 				$('#rbt_efflo1').val("SLIGHT");
 				cont++;
 			}

 			var ef2 = randomNumberFromRange(0, 9).toFixed(0);
 			if (ef2 % 2 == 0) {
 				$('#rbt_efflo2').val("NIL");
 			} else {
 				$('#rbt_efflo2').val("SLIGHT");
 				cont++;
 			}

 			var ef3 = randomNumberFromRange(0, 9).toFixed(0);
 			if (ef3 % 2 == 0) {
 				$('#rbt_efflo3').val("NIL");
 			} else {
 				$('#rbt_efflo3').val("SLIGHT");
 				cont++;
 			}
 			var ef4 = randomNumberFromRange(0, 9).toFixed(0);
 			if (ef4 % 2 == 0) {
 				$('#rbt_efflo4').val("NIL");
 			} else {
 				$('#rbt_efflo4').val("SLIGHT");
 				cont++;
 			}
 			var ef5 = randomNumberFromRange(0, 9).toFixed(0);
 			if (ef5 % 2 == 0) {
 				$('#rbt_efflo5').val("NIL");
 			} else {
 				$('#rbt_efflo5').val("SLIGHT");
 				cont++;
 			}

 			if (cont > 2) {
 				$('#rbt_efflo1').val("NIL");
 				$('#rbt_efflo3').val("NIL");
 				$('#rbt_efflo5').val("NIL");
 			}



 		}

 		$('#chk_efflo').change(function() {
 			if (this.checked) {
 				efflo_auto();
 			} else {
 				$('#txteff').css("background-color", "white");
 				$('#rbt_efflo1').val(null);
 				$('#rbt_efflo2').val(null);
 				$('#rbt_efflo3').val(null);
 				$('#rbt_efflo4').val(null);
 				$('#rbt_efflo5').val(null);


 			}

 		});


 		$('#chk_auto').change(function() {
 			if (this.checked) {
 				var temp = $('#test_list').val();
 				var aa = temp.split(",");
 				//chk_efflo
 				for (var i = 0; i < aa.length; i++) {
 					if (aa[i] == "eff") {

 						$("#chk_efflo").prop("checked", true);
 						efflo_auto();
 						break;
 					}
 				}

 				//chk_com
 				for (var i = 0; i < aa.length; i++) {
 					if (aa[i] == "com") {

 						$("#chk_com").prop("checked", true);
 						com_auto();
 						break;
 					}
 				}

 				//chk_wtr
 				for (var i = 0; i < aa.length; i++) {
 					if (aa[i] == "wtr") {

 						$("#chk_wtr").prop("checked", true);
 						wtr_auto();
 						break;
 					}
 				}

 				//chk_dim
 				for (var i = 0; i < aa.length; i++) {
 					if (aa[i] == "dim") {

 						$("#chk_dim").prop("checked", true);
 						dim_auto();
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
 	});

 	function getGlazedTiles() {
 		var lab_no = $('#lab_no').val();
 		var report_no = $('#report_no').val();
 		var job_no = $('#job_no').val();
 		$.ajax({
 			type: 'POST',
 			url: '<?php echo $base_url; ?>saveBricks.php',
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
 			var remarks = $('#remarks').val();

 			var temp = $('#test_list').val();
 			var aa = temp.split(",");

 			//DIMENSION AND Tolerance
 			for (var i = 0; i < aa.length; i++) {
 				if (aa[i] == "dim") {
 					if (document.getElementById('chk_dim').checked) {
 						var chk_dim = "1";
 					} else {
 						var chk_dim = "0";
 					}
 					var dim_height = $('#dim_height').val();
 					var dim_length = $('#dim_length').val();
 					var dim_width = $('#dim_width').val();
 					var dim_height1 = $('#dim_height1').val();
 					var dim_length1 = $('#dim_length1').val();
 					var dim_width1 = $('#dim_width1').val();
 					var avg_height = $('#avg_height').val();
 					var avg_length = $('#avg_length').val();
 					var avg_width = $('#avg_width').val();
 					var no_of_brick = $('#no_of_brick').val();
 					var id_mark = $('#id_mark').val();
 					var temp1 = $('#temp1').val();
 					break;
 				} else {
 					var chk_dim = "0";
 					var dim_height = "0";
 					var dim_length = "0";
 					var dim_width = "0";
 					var dim_height1 = "0";
 					var dim_length1 = "0";
 					var dim_width1 = "0";
 					var avg_height = "0";
 					var avg_length = "0";
 					var avg_width = "0";
 					var no_of_brick = "0";
 					var id_mark = "0";
 					var temp = "0";

 				}

 			}
			
 			//water absorption
 			for (var i = 0; i < aa.length; i++) {
 				if (aa[i] == "wtr") {
 					if (document.getElementById('chk_wtr').checked) {
 						var chk_wtr = "1";
 					} else {
 						var chk_wtr = "0";
 					}
 					//Fields

 					var wtr_lab_1 = $('#wtr_lab_1').val();
 					var wtr_lab_2 = $('#wtr_lab_2').val();
 					var wtr_lab_3 = $('#wtr_lab_3').val();
 					var wtr_lab_4 = $('#wtr_lab_4').val();
 					var wtr_lab_5 = $('#wtr_lab_5').val();
 					var wtr_lab_6 = $('#wtr_lab_6').val();

 					var wtr_w1_1 = $('#wtr_w1_1').val();
 					var wtr_w1_2 = $('#wtr_w1_2').val();
 					var wtr_w1_3 = $('#wtr_w1_3').val();
 					var wtr_w1_4 = $('#wtr_w1_4').val();
 					var wtr_w1_5 = $('#wtr_w1_5').val();
 					var wtr_w1_6 = $('#wtr_w1_6').val();

 					var wtr_w2_1 = $('#wtr_w2_1').val();
 					var wtr_w2_2 = $('#wtr_w2_2').val();
 					var wtr_w2_3 = $('#wtr_w2_3').val();
 					var wtr_w2_4 = $('#wtr_w2_4').val();
 					var wtr_w2_5 = $('#wtr_w2_5').val();
 					var wtr_w2_6 = $('#wtr_w2_6').val();

 					var wtr_1 = $('#wtr_1').val();
 					var wtr_2 = $('#wtr_2').val();
 					var wtr_3 = $('#wtr_3').val();
 					var wtr_4 = $('#wtr_4').val();
 					var wtr_5 = $('#wtr_5').val();
 					var wtr_6 = $('#wtr_6').val();

 					var avg_wtr = $('#avg_wtr').val();
 					break;
 				} else {
 					var chk_wtr = "0";
 					var avg_wtr = "0";

 					var wtr_lab_1 = "0";
 					var wtr_lab_2 = "0";
 					var wtr_lab_3 = "0";
 					var wtr_lab_4 = "0";
 					var wtr_lab_5 = "0";
 					var wtr_lab_6 = "0";

 					var wtr_w1_1 = "0";
 					var wtr_w1_2 = "0";
 					var wtr_w1_3 = "0";
 					var wtr_w1_4 = "0";
 					var wtr_w1_5 = "0";
 					var wtr_w1_6 = "0";

 					var wtr_w2_1 = "0";
 					var wtr_w2_2 = "0";
 					var wtr_w2_3 = "0";
 					var wtr_w2_4 = "0";
 					var wtr_w2_5 = "0";
 					var wtr_w2_6 = "0";

 					var wtr_1 = "0";
 					var wtr_2 = "0";
 					var wtr_3 = "0";
 					var wtr_4 = "0";
 					var wtr_5 = "0";
 					var wtr_6 = "0";

 				}
 			}

 			//Compressive Strength
 			for (var i = 0; i < aa.length; i++) {
 				if (aa[i] == "com") {

 					if (document.getElementById('chk_com').checked) {
 						var chk_com = "1";
 					} else {
 						var chk_com = "0";
 					}
 					//impact value-3
 					var con_grade = $('#con_grade').val();
 					var com_lab_1 = $('#com_lab_1').val();
 					var com_lab_2 = $('#com_lab_2').val();
 					var com_lab_3 = $('#com_lab_3').val();
 					var com_lab_4 = $('#com_lab_4').val();
 					var com_lab_5 = $('#com_lab_5').val();
 					var com_lab_6 = $('#com_lab_6').val();

 					var com_l_1 = $('#com_l_1').val();
 					var com_l_2 = $('#com_l_2').val();
 					var com_l_3 = $('#com_l_3').val();
 					var com_l_4 = $('#com_l_4').val();
 					var com_l_5 = $('#com_l_5').val();
 					var com_l_6 = $('#com_l_6').val();

 					var com_b_1 = $('#com_b_1').val();
 					var com_b_2 = $('#com_b_2').val();
 					var com_b_3 = $('#com_b_3').val();
 					var com_b_4 = $('#com_b_4').val();
 					var com_b_5 = $('#com_b_5').val();
 					var com_b_6 = $('#com_b_6').val();

 					var com_h_1 = $('#com_h_1').val();
 					var com_h_2 = $('#com_h_2').val();
 					var com_h_3 = $('#com_h_3').val();
 					var com_h_4 = $('#com_h_4').val();
 					var com_h_5 = $('#com_h_5').val();
 					var com_h_6 = $('#com_h_6').val();

 					var com_area_1 = $('#com_area_1').val();
 					var com_area_2 = $('#com_area_2').val();
 					var com_area_3 = $('#com_area_3').val();
 					var com_area_4 = $('#com_area_4').val();
 					var com_area_5 = $('#com_area_5').val();
 					var com_area_6 = $('#com_area_6').val();

 					var com_load_1 = $('#com_load_1').val();
 					var com_load_2 = $('#com_load_2').val();
 					var com_load_3 = $('#com_load_3').val();
 					var com_load_4 = $('#com_load_4').val();
 					var com_load_5 = $('#com_load_5').val();
 					var com_load_6 = $('#com_load_6').val();

 					var com_1 = $('#com_1').val();
 					var com_2 = $('#com_2').val();
 					var com_3 = $('#com_3').val();
 					var com_4 = $('#com_4').val();
 					var com_5 = $('#com_5').val();
 					var com_6 = $('#com_6').val();
 					var avg_com = $('#avg_com').val();

 					break;
 				} else {
 					var chk_com = "0";
 					var avg_com = "0";

 					var con_grade = "0";
 					var com_lab_1 = "0";
 					var com_lab_2 = "0";
 					var com_lab_3 = "0";
 					var com_lab_4 = "0";
 					var com_lab_5 = "0";
 					var com_lab_6 = "0";

 					var com_l_1 = "0";
 					var com_l_2 = "0";
 					var com_l_3 = "0";
 					var com_l_4 = "0";
 					var com_l_5 = "0";
 					var com_l_6 = "0";

 					var com_b_1 = "0";
 					var com_b_2 = "0";
 					var com_b_3 = "0";
 					var com_b_4 = "0";
 					var com_b_5 = "0";
 					var com_b_6 = "0";

 					var com_h_1 = "0";
 					var com_h_2 = "0";
 					var com_h_3 = "0";
 					var com_h_4 = "0";
 					var com_h_5 = "0";
 					var com_h_6 = "0";

 					var com_area_1 = "0";
 					var com_area_2 = "0";
 					var com_area_3 = "0";
 					var com_area_4 = "0";
 					var com_area_5 = "0";
 					var com_area_6 = "0";

 					var com_load_1 = "0";
 					var com_load_2 = "0";
 					var com_load_3 = "0";
 					var com_load_4 = "0";
 					var com_load_5 = "0";
 					var com_load_6 = "0";

 					var com_1 = "0";
 					var com_2 = "0";
 					var com_3 = "0";
 					var com_4 = "0";
 					var com_5 = "0";
 					var com_6 = "0";

 				}

 			}


 			//Efflorescence
 			for (var i = 0; i < aa.length; i++) {
 				if (aa[i] == "eff") {

 					if (document.getElementById('chk_efflo').checked) {
 						var chk_efflo = "1";
 					} else {
 						var chk_efflo = "0";
 					}
 					var rbt_efflo1 = $('#rbt_efflo1').val();
 					var rbt_efflo2 = $('#rbt_efflo2').val();
 					var rbt_efflo3 = $('#rbt_efflo3').val();
 					var rbt_efflo4 = $('#rbt_efflo4').val();
 					var rbt_efflo5 = $('#rbt_efflo5').val();

 					break;
 				} else {
 					var chk_efflo = "0";
 					var rbt_efflo1 = "";
 					var rbt_efflo2 = "";
 					var rbt_efflo3 = "";
 					var rbt_efflo4 = "";
 					var rbt_efflo5 = "";

 				}

 			}


 			billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_dim=' + chk_dim + '&dim_height=' + dim_height + '&dim_length=' + dim_length + '&dim_width=' + dim_width + '&dim_height1=' + dim_height1 + '&dim_length1=' + dim_length1 + '&dim_width1=' + dim_width1 + '&avg_height=' + avg_height + '&avg_length=' + avg_length + '&avg_width=' + avg_width + '&no_of_brick=' + no_of_brick + '&id_mark=' + id_mark + '&temp1=' + temp1 + '&chk_wtr=' + chk_wtr + '&wtr_lab_1=' + wtr_lab_1 + '&wtr_lab_2=' + wtr_lab_2 + '&wtr_lab_3=' + wtr_lab_3 + '&wtr_lab_4=' + wtr_lab_4 + '&wtr_lab_5=' + wtr_lab_5 + '&wtr_lab_6=' + wtr_lab_6 + '&wtr_w1_1=' + wtr_w1_1 + '&wtr_w1_2=' + wtr_w1_2 + '&wtr_w1_3=' + wtr_w1_3 + '&wtr_w1_4=' + wtr_w1_4 + '&wtr_w1_5=' + wtr_w1_5 + '&wtr_w1_6=' + wtr_w1_6 + '&wtr_w2_1=' + wtr_w2_1 + '&wtr_w2_2=' + wtr_w2_2 + '&wtr_w2_3=' + wtr_w2_3 + '&wtr_w2_4=' + wtr_w2_4 + '&wtr_w2_5=' + wtr_w2_5 + '&wtr_w2_6=' + wtr_w2_6 + '&wtr_1=' + wtr_1 + '&wtr_2=' + wtr_2 + '&wtr_3=' + wtr_3 + '&wtr_4=' + wtr_4 + '&wtr_5=' + wtr_5  + '&wtr_6=' + wtr_6 + '&avg_wtr=' + avg_wtr + '&chk_com=' + chk_com + '&avg_com=' + avg_com + '&con_grade=' + con_grade + '&com_lab_1=' + com_lab_1 + '&com_lab_2=' + com_lab_2 + '&com_lab_3=' + com_lab_3 + '&com_lab_4=' + com_lab_4 + '&com_lab_5=' + com_lab_5 + '&com_lab_6=' + com_lab_6 + '&com_l_1=' + com_l_1 + '&com_l_2=' + com_l_2 + '&com_l_3=' + com_l_3 + '&com_l_4=' + com_l_4 + '&com_l_5=' + com_l_5 + '&com_l_6=' + com_l_6 + '&com_b_1=' + com_b_1 + '&com_b_2=' + com_b_2 + '&com_b_3=' + com_b_3 + '&com_b_4=' + com_b_4 + '&com_b_5=' + com_b_5 + '&com_b_6=' + com_b_6 + '&com_h_1=' + com_h_1 + '&com_h_2=' + com_h_2 + '&com_h_3=' + com_h_3 + '&com_h_4=' + com_h_4 + '&com_h_5=' + com_h_5 + '&com_h_6=' + com_h_6 + '&com_area_1=' + com_area_1 + '&com_area_2=' + com_area_2 + '&com_area_3=' + com_area_3 + '&com_area_4=' + com_area_4 + '&com_area_5=' + com_area_5 + '&com_area_6=' + com_area_6 + '&com_load_1=' + com_load_1 + '&com_load_2=' + com_load_2 + '&com_load_3=' + com_load_3 + '&com_load_4=' + com_load_4 + '&com_load_5=' + com_load_5 + '&com_load_6=' + com_load_6 + '&com_1=' + com_1 + '&com_2=' + com_2 + '&com_3=' + com_3 + '&com_4=' + com_4 + '&com_5=' + com_5 + '&com_6=' + com_6 + '&chk_efflo=' + chk_efflo + '&rbt_efflo1=' + rbt_efflo1 + '&rbt_efflo2=' + rbt_efflo2 + '&rbt_efflo3=' + rbt_efflo3 + '&rbt_efflo4=' + rbt_efflo4 + '&rbt_efflo5=' + rbt_efflo5 + '&ulr=' + ulr + '&remarks=' + remarks+ '&amend_date=' + amend_date;



 		} else if (type == 'edit') {
 			var report_no = $('#report_no').val();
 			var job_no = $('#job_no').val();
 			var lab_no = $('#lab_no').val();
 			var ulr = $('#ulr').val();
			var amend_date = $('#amend_date').val();
 			var remarks = $('#remarks').val();

 			var temp = $('#test_list').val();
 			var aa = temp.split(",");

 			//DIMENSION AND Tolerance
 			for (var i = 0; i < aa.length; i++) {
 				if (aa[i] == "dim") {
 					if (document.getElementById('chk_dim').checked) {
 						var chk_dim = "1";
 					} else {
 						var chk_dim = "0";
 					}
 					var dim_height = $('#dim_height').val();
 					var dim_length = $('#dim_length').val();
 					var dim_width = $('#dim_width').val();
 					var dim_height1 = $('#dim_height1').val();
 					var dim_length1 = $('#dim_length1').val();
 					var dim_width1 = $('#dim_width1').val();
 					var avg_height = $('#avg_height').val();
 					var avg_length = $('#avg_length').val();
 					var avg_width = $('#avg_width').val();
 					var no_of_brick = $('#no_of_brick').val();
 					var id_mark = $('#id_mark').val();
 					var temp1 = $('#temp1').val();
 					break;
 				} else {
 					var chk_dim = "0";
 					var dim_height = "0";
 					var dim_length = "0";
 					var dim_width = "0";
 					var dim_height1 = "0";
 					var dim_length1 = "0";
 					var dim_width1 = "0";
 					var avg_height = "0";
 					var avg_length = "0";
 					var avg_width = "0";
 					var no_of_brick = "0";
 					var id_mark = "0";
 					var temp1 = "0";

 				}

 			}

 			
 			//water absorption
 			for (var i = 0; i < aa.length; i++) {
 				if (aa[i] == "wtr") {
 					if (document.getElementById('chk_wtr').checked) {
 						var chk_wtr = "1";
 					} else {
 						var chk_wtr = "0";
 					}
 					//Fields

 					var wtr_lab_1 = $('#wtr_lab_1').val();
 					var wtr_lab_2 = $('#wtr_lab_2').val();
 					var wtr_lab_3 = $('#wtr_lab_3').val();
 					var wtr_lab_4 = $('#wtr_lab_4').val();
 					var wtr_lab_5 = $('#wtr_lab_5').val();
 					var wtr_lab_6 = $('#wtr_lab_6').val();

 					var wtr_w1_1 = $('#wtr_w1_1').val();
 					var wtr_w1_2 = $('#wtr_w1_2').val();
 					var wtr_w1_3 = $('#wtr_w1_3').val();
 					var wtr_w1_4 = $('#wtr_w1_4').val();
 					var wtr_w1_5 = $('#wtr_w1_5').val();
 					var wtr_w1_6 = $('#wtr_w1_6').val();

 					var wtr_w2_1 = $('#wtr_w2_1').val();
 					var wtr_w2_2 = $('#wtr_w2_2').val();
 					var wtr_w2_3 = $('#wtr_w2_3').val();
 					var wtr_w2_4 = $('#wtr_w2_4').val();
 					var wtr_w2_5 = $('#wtr_w2_5').val();
 					var wtr_w2_6 = $('#wtr_w2_6').val();

 					var wtr_1 = $('#wtr_1').val();
 					var wtr_2 = $('#wtr_2').val();
 					var wtr_3 = $('#wtr_3').val();
 					var wtr_4 = $('#wtr_4').val();
 					var wtr_5 = $('#wtr_5').val();
 					var wtr_6 = $('#wtr_6').val();

 					var avg_wtr = $('#avg_wtr').val();
 					break;
 				} else {
 					var chk_wtr = "0";
 					var avg_wtr = "0";

 					var wtr_lab_1 = "0";
 					var wtr_lab_2 = "0";
 					var wtr_lab_3 = "0";
 					var wtr_lab_4 = "0";
 					var wtr_lab_5 = "0";
 					var wtr_lab_6 = "0";

 					var wtr_w1_1 = "0";
 					var wtr_w1_2 = "0";
 					var wtr_w1_3 = "0";
 					var wtr_w1_4 = "0";
 					var wtr_w1_5 = "0";
 					var wtr_w1_6 = "0";

 					var wtr_w2_1 = "0";
 					var wtr_w2_2 = "0";
 					var wtr_w2_3 = "0";
 					var wtr_w2_4 = "0";
 					var wtr_w2_5 = "0";
 					var wtr_w2_6 = "0";

 					var wtr_1 = "0";
 					var wtr_2 = "0";
 					var wtr_3 = "0";
 					var wtr_4 = "0";
 					var wtr_5 = "0";
 					var wtr_6 = "0";

 				}
 			}

 			//Compressive Strength
 			for (var i = 0; i < aa.length; i++) {
 				if (aa[i] == "com") {

 					if (document.getElementById('chk_com').checked) {
 						var chk_com = "1";
 					} else {
 						var chk_com = "0";
 					}
 					//impact value-3
 					var con_grade = $('#con_grade').val();
 					var com_lab_1 = $('#com_lab_1').val();
 					var com_lab_2 = $('#com_lab_2').val();
 					var com_lab_3 = $('#com_lab_3').val();
 					var com_lab_4 = $('#com_lab_4').val();
 					var com_lab_5 = $('#com_lab_5').val();
 					var com_lab_6 = $('#com_lab_6').val();

 					var com_l_1 = $('#com_l_1').val();
 					var com_l_2 = $('#com_l_2').val();
 					var com_l_3 = $('#com_l_3').val();
 					var com_l_4 = $('#com_l_4').val();
 					var com_l_5 = $('#com_l_5').val();
 					var com_l_6 = $('#com_l_6').val();

 					var com_b_1 = $('#com_b_1').val();
 					var com_b_2 = $('#com_b_2').val();
 					var com_b_3 = $('#com_b_3').val();
 					var com_b_4 = $('#com_b_4').val();
 					var com_b_5 = $('#com_b_5').val();
 					var com_b_6 = $('#com_b_6').val();

 					var com_h_1 = $('#com_h_1').val();
 					var com_h_2 = $('#com_h_2').val();
 					var com_h_3 = $('#com_h_3').val();
 					var com_h_4 = $('#com_h_4').val();
 					var com_h_5 = $('#com_h_5').val();
 					var com_h_6 = $('#com_h_6').val();

 					var com_area_1 = $('#com_area_1').val();
 					var com_area_2 = $('#com_area_2').val();
 					var com_area_3 = $('#com_area_3').val();
 					var com_area_4 = $('#com_area_4').val();
 					var com_area_5 = $('#com_area_5').val();
 					var com_area_6 = $('#com_area_6').val();

 					var com_load_1 = $('#com_load_1').val();
 					var com_load_2 = $('#com_load_2').val();
 					var com_load_3 = $('#com_load_3').val();
 					var com_load_4 = $('#com_load_4').val();
 					var com_load_5 = $('#com_load_5').val();
 					var com_load_6 = $('#com_load_6').val();

 					var com_1 = $('#com_1').val();
 					var com_2 = $('#com_2').val();
 					var com_3 = $('#com_3').val();
 					var com_4 = $('#com_4').val();
 					var com_5 = $('#com_5').val();
 					var com_6 = $('#com_6').val();
 					var avg_com = $('#avg_com').val();

 					break;
 				} else {
 					var chk_com = "0";
 					var avg_com = "0";

 					var con_grade = "0";
 					var com_lab_1 = "0";
 					var com_lab_2 = "0";
 					var com_lab_3 = "0";
 					var com_lab_4 = "0";
 					var com_lab_5 = "0";
 					var com_lab_6 = "0";

 					var com_l_1 = "0";
 					var com_l_2 = "0";
 					var com_l_3 = "0";
 					var com_l_4 = "0";
 					var com_l_5 = "0";
 					var com_l_6 = "0";

 					var com_b_1 = "0";
 					var com_b_2 = "0";
 					var com_b_3 = "0";
 					var com_b_4 = "0";
 					var com_b_5 = "0";
 					var com_b_6 = "0";

 					var com_h_1 = "0";
 					var com_h_2 = "0";
 					var com_h_3 = "0";
 					var com_h_4 = "0";
 					var com_h_5 = "0";
 					var com_h_6 = "0";

 					var com_area_1 = "0";
 					var com_area_2 = "0";
 					var com_area_3 = "0";
 					var com_area_4 = "0";
 					var com_area_5 = "0";
 					var com_area_6 = "0";

 					var com_load_1 = "0";
 					var com_load_2 = "0";
 					var com_load_3 = "0";
 					var com_load_4 = "0";
 					var com_load_5 = "0";
 					var com_load_6 = "0";

 					var com_1 = "0";
 					var com_2 = "0";
 					var com_3 = "0";
 					var com_4 = "0";
 					var com_5 = "0";
 					var com_6 = "0";

 				}

 			}




 			//Efflorescence
 			for (var i = 0; i < aa.length; i++) {
 				if (aa[i] == "eff") {

 					if (document.getElementById('chk_efflo').checked) {
 						var chk_efflo = "1";
 					} else {
 						var chk_efflo = "0";
 					}
 					var rbt_efflo1 = $('#rbt_efflo1').val();
 					var rbt_efflo2 = $('#rbt_efflo2').val();
 					var rbt_efflo3 = $('#rbt_efflo3').val();
 					var rbt_efflo4 = $('#rbt_efflo4').val();
 					var rbt_efflo5 = $('#rbt_efflo5').val();

 					break;
 				} else {
 					var chk_efflo = "0";
 					var rbt_efflo1 = "";
 					var rbt_efflo2 = "";
 					var rbt_efflo3 = "";
 					var rbt_efflo4 = "";
 					var rbt_efflo5 = "";

 				}

 			}


 			var idEdit = $('#idEdit').val();

 			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_dim=' + chk_dim + '&dim_height=' + dim_height + '&dim_length=' + dim_length + '&dim_width=' + dim_width + '&dim_height1=' + dim_height1 + '&dim_length1=' + dim_length1 + '&dim_width1=' + dim_width1 + '&avg_height=' + avg_height + '&avg_length=' + avg_length + '&avg_width=' + avg_width + '&no_of_brick=' + no_of_brick + '&id_mark=' + id_mark + '&temp1=' + temp1 + '&chk_wtr=' + chk_wtr + '&wtr_lab_1=' + wtr_lab_1 + '&wtr_lab_2=' + wtr_lab_2 + '&wtr_lab_3=' + wtr_lab_3 + '&wtr_lab_4=' + wtr_lab_4 + '&wtr_lab_5=' + wtr_lab_5 + '&wtr_lab_6=' + wtr_lab_6 + '&wtr_w1_1=' + wtr_w1_1 + '&wtr_w1_2=' + wtr_w1_2 + '&wtr_w1_3=' + wtr_w1_3 + '&wtr_w1_4=' + wtr_w1_4 + '&wtr_w1_5=' + wtr_w1_5 + '&wtr_w1_6=' + wtr_w1_6 + '&wtr_w2_1=' + wtr_w2_1 + '&wtr_w2_2=' + wtr_w2_2 + '&wtr_w2_3=' + wtr_w2_3 + '&wtr_w2_4=' + wtr_w2_4 + '&wtr_w2_5=' + wtr_w2_5 + '&wtr_w2_6=' + wtr_w2_6 + '&wtr_1=' + wtr_1 + '&wtr_2=' + wtr_2 + '&wtr_3=' + wtr_3 + '&wtr_4=' + wtr_4 + '&wtr_5=' + wtr_5  + '&wtr_6=' + wtr_6 + '&avg_wtr=' + avg_wtr + '&chk_com=' + chk_com + '&avg_com=' + avg_com + '&con_grade=' + con_grade + '&com_lab_1=' + com_lab_1 + '&com_lab_2=' + com_lab_2 + '&com_lab_3=' + com_lab_3 + '&com_lab_4=' + com_lab_4 + '&com_lab_5=' + com_lab_5 + '&com_lab_6=' + com_lab_6 + '&com_l_1=' + com_l_1 + '&com_l_2=' + com_l_2 + '&com_l_3=' + com_l_3 + '&com_l_4=' + com_l_4 + '&com_l_5=' + com_l_5 + '&com_l_6=' + com_l_6 + '&com_b_1=' + com_b_1 + '&com_b_2=' + com_b_2 + '&com_b_3=' + com_b_3 + '&com_b_4=' + com_b_4 + '&com_b_5=' + com_b_5 + '&com_b_6=' + com_b_6 + '&com_h_1=' + com_h_1 + '&com_h_2=' + com_h_2 + '&com_h_3=' + com_h_3 + '&com_h_4=' + com_h_4 + '&com_h_5=' + com_h_5 + '&com_h_6=' + com_h_6 + '&com_area_1=' + com_area_1 + '&com_area_2=' + com_area_2 + '&com_area_3=' + com_area_3 + '&com_area_4=' + com_area_4 + '&com_area_5=' + com_area_5 + '&com_area_6=' + com_area_6 + '&com_load_1=' + com_load_1 + '&com_load_2=' + com_load_2 + '&com_load_3=' + com_load_3 + '&com_load_4=' + com_load_4 + '&com_load_5=' + com_load_5 + '&com_load_6=' + com_load_6 + '&com_1=' + com_1 + '&com_2=' + com_2 + '&com_3=' + com_3 + '&com_4=' + com_4 + '&com_5=' + com_5 + '&com_6=' + com_6 + '&chk_efflo=' + chk_efflo + '&rbt_efflo1=' + rbt_efflo1 + '&rbt_efflo2=' + rbt_efflo2 + '&rbt_efflo3=' + rbt_efflo3 + '&rbt_efflo4=' + rbt_efflo4 + '&rbt_efflo5=' + rbt_efflo5 + '&ulr=' + ulr + '&remarks=' + remarks+ '&amend_date=' + amend_date;
 		} else {
 			var report_no = $('#report_no').val();
 			var job_no = $('#job_no').val();
 			var lab_no = $('#lab_no').val();
 			billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
 		}

 		$.ajax({
 			type: 'POST',
 			url: '<?php echo $base_url; ?>saveBricks.php',
 			data: billData,
 			dataType: 'JSON',
 			success: function(msg) {
 				$('#btn_save').hide();
 				getGlazedTiles();
 				var report_no = $('#report_no').val();
 				var job_no = $('#job_no').val();
 				//	window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;

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
 			url: '<?php echo $base_url; ?>saveBricks.php',
 			data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
 			success: function(data) {
 				$('#idEdit').val(data.id);

 				var idEdit = $('#idEdit').val();
 				$('#report_no').val(data.report_no);
 				$('#job_no').val(data.job_no);
 				$('#lab_no').val(data.lab_no);
 				$('#ulr').val(data.ulr);
				 $('#amend_date').val(data.amend_date);
 				$('#remarks').val(data.remarks);

 				var temp = $('#test_list').val();
 				var aa = temp.split(",");
 				//DIMENSION
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
 						//GRADATION DATA FETCH-1
 						$('#no_of_brick').val(data.no_of_brick);
 						$('#id_mark').val(data.id_mark);
 						$('#temp1').val(data.temp1);

 						$('#dim_height').val(data.dim_height);
 						$('#dim_length').val(data.dim_length);
 						$('#dim_width').val(data.dim_width);
 						$('#dim_height1').val(data.dim_height1);
 						$('#dim_length1').val(data.dim_length1);
 						$('#dim_width1').val(data.dim_width1);
 						$('#avg_height').val(data.avg_height);
 						$('#avg_length').val(data.avg_length);
 						$('#avg_width').val(data.avg_width);

 						break;
 					} else {

 					}

 				}

 				//Water Absorption	
 				for (var i = 0; i < aa.length; i++) {
 					if (aa[i] == "wtr") {

 						var chk_wtr = data.chk_wtr;
 						if (chk_wtr == "1") {
 							$('#txtwtr').css("background-color", "var(--success)");
 							$("#chk_wtr").prop("checked", true);
 						} else {
 							$('#txtwtr').css("background-color", "white");
 							$("#chk_wtr").prop("checked", false);
 						}

 						$('#avg_wtr').val(data.avg_wtr);

 						$('#wtr_lab_1').val(data.wtr_lab_1);
 						$('#wtr_lab_2').val(data.wtr_lab_2);
 						$('#wtr_lab_3').val(data.wtr_lab_3);
 						$('#wtr_lab_4').val(data.wtr_lab_4);
 						$('#wtr_lab_5').val(data.wtr_lab_5);
 						$('#wtr_lab_6').val(data.wtr_lab_6);

 						$('#wtr_w1_1').val(data.wtr_w1_1);
 						$('#wtr_w1_2').val(data.wtr_w1_2);
 						$('#wtr_w1_3').val(data.wtr_w1_3);
 						$('#wtr_w1_4').val(data.wtr_w1_4);
 						$('#wtr_w1_5').val(data.wtr_w1_5);
 						$('#wtr_w1_6').val(data.wtr_w1_6);

 						$('#wtr_w2_1').val(data.wtr_w2_1);
 						$('#wtr_w2_2').val(data.wtr_w2_2);
 						$('#wtr_w2_3').val(data.wtr_w2_3);
 						$('#wtr_w2_4').val(data.wtr_w2_4);
 						$('#wtr_w2_5').val(data.wtr_w2_5);
 						$('#wtr_w2_6').val(data.wtr_w2_6);

 						$('#wtr_1').val(data.wtr_1);
 						$('#wtr_2').val(data.wtr_2);
 						$('#wtr_3').val(data.wtr_3);
 						$('#wtr_4').val(data.wtr_4);
 						$('#wtr_5').val(data.wtr_5);
 						$('#wtr_6').val(data.wtr_6);

 						break;
 					} else {

 					}

 				}


 				//Compressive Strength
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

 						$('#con_grade').val(data.con_grade);
 						$('#com_lab_1').val(data.com_lab_1);
 						$('#com_lab_2').val(data.com_lab_2);
 						$('#com_lab_3').val(data.com_lab_3);
 						$('#com_lab_4').val(data.com_lab_4);
 						$('#com_lab_5').val(data.com_lab_5);
 						$('#com_lab_6').val(data.com_lab_6);

 						$('#com_l_1').val(data.com_l_1);
 						$('#com_l_2').val(data.com_l_2);
 						$('#com_l_3').val(data.com_l_3);
 						$('#com_l_4').val(data.com_l_4);
 						$('#com_l_5').val(data.com_l_5);
 						$('#com_l_6').val(data.com_l_6);

 						$('#com_b_1').val(data.com_b_1);
 						$('#com_b_2').val(data.com_b_2);
 						$('#com_b_3').val(data.com_b_3);
 						$('#com_b_4').val(data.com_b_4);
 						$('#com_b_5').val(data.com_b_5);
 						$('#com_b_6').val(data.com_b_6);

 						$('#com_h_1').val(data.com_h_1);
 						$('#com_h_2').val(data.com_h_2);
 						$('#com_h_3').val(data.com_h_3);
 						$('#com_h_4').val(data.com_h_4);
 						$('#com_h_5').val(data.com_h_5);
 						$('#com_h_6').val(data.com_h_6);

 						$('#com_area_1').val(data.com_area_1);
 						$('#com_area_2').val(data.com_area_2);
 						$('#com_area_3').val(data.com_area_3);
 						$('#com_area_4').val(data.com_area_4);
 						$('#com_area_5').val(data.com_area_5);
 						$('#com_area_6').val(data.com_area_6);

 						$('#com_load_1').val(data.com_load_1);
 						$('#com_load_2').val(data.com_load_2);
 						$('#com_load_3').val(data.com_load_3);
 						$('#com_load_4').val(data.com_load_4);
 						$('#com_load_5').val(data.com_load_5);
 						$('#com_load_6').val(data.com_load_6);

 						$('#com_1').val(data.com_1);
 						$('#com_2').val(data.com_2);
 						$('#com_3').val(data.com_3);
 						$('#com_4').val(data.com_4);
 						$('#com_5').val(data.com_5);
 						$('#com_6').val(data.com_6);

 						break;
 					} else {

 					}

 				}

 				//Efflorescence
 				for (var i = 0; i < aa.length; i++) {
 					if (aa[i] == "eff") {

 						var chk_efflo = data.chk_efflo;
 						if (chk_efflo == "1") {
 							$('#txteff').css("background-color", "var(--success)");
 							$("#chk_efflo").prop("checked", true);
 						} else {
 							$('#txteff').css("background-color", "white");
 							$("#chk_efflo").prop("checked", false);
 						}
 						$('#rbt_efflo1').val(data.rbt_efflo1);
 						$('#rbt_efflo2').val(data.rbt_efflo2);
 						$('#rbt_efflo3').val(data.rbt_efflo3);
 						$('#rbt_efflo4').val(data.rbt_efflo4);
 						$('#rbt_efflo5').val(data.rbt_efflo5);





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