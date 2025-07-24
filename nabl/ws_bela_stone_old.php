<?php 
session_start(); 
include("header.php");
//REMOVE SIDE BAR
/*include("sidebar.php");*/
include("connection.php");
error_reporting(0);
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
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
		if(isset($_GET['report_no'])){
			$report_no=$_GET['report_no'];
		}
		if(isset($_GET['trf_no'])){
			$trf_no=$_GET['trf_no'];
			
		}
		if(isset($_GET['job_no'])){
			$job_no=$_GET['job_no'];
		}
		if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
		}
		if(isset($_GET['lab_no'])){
			$lab_no=$_GET['lab_no'];
			$aa	=$_GET['lab_no'];
		}
		
?>
 
 
 <div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">WS BELLA STONE</h2>
					</div>
					<div class="box-default">
					<form class="form" id="Glazed" method="post">
						<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">

								<div class="col-lg-6">
									<div class="form-group">
									
									  <!--<label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->

									  <div class="col-sm-10">
										<input type="hidden" class="form-control" id="report_no" value="<?php echo $report_no;?>" name="report_no" ReadOnly >
									  </div>

										
									</div>
								</div>
									<div class="col-lg-6">
										<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-2 control-label">Job No.:</label>-->
											<div class="col-sm-10">											
													<input type="hidden" class="form-control" tabindex="1"  value="<?php echo $job_no;?>" id="job_no" name="job_no" ReadOnly>
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
													<input type="checkbox" class="visually-hidden" name="chk_auto"  id="chk_auto" value="chk_auto">
												</div>

										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no;?>" name="lab_no" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										

										  <div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
										  </div>
										</div>
									</div>
									
								</div>
								
								<br>
									
								
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

		
	<!-- TEST WISE LOGIC VAIBHAV-->
  <?php
	$test_check;
	$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
	$result_select1 = mysqli_query($conn, $select_query1);
	while($r1 = mysqli_fetch_array($result_select1)){
		if($r1['test_code']=="tsg")
		{
			$test_check.="tsg,";
	?>
	<div class="panel panel-default" id ="tsg">
		<div class="panel-heading" id="txttsg">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_tsg">
					<h4 class="panel-title"><b>TRUE SPECIFIC GRAVITY</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_tsg" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_tsg">1.</label>
								<input type="checkbox" class="visually-hidden" name="chk_tsg"  id="chk_tsg" value="chk_tsg"><br>
							</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">True Specific Gravity</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<label class="control-label text-center">Sr No</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label text-center">Description</label>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label class="control-label text-center">Results</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<label class="control-label text-center">1</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label text-center">Room Temperature, t in <sup>o</sup>C</label>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="tsg1"  id="tsg1">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<label class="control-label text-center">2</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label text-center">Weight of the empty specific gravity bottle with stopper, W1in g. </label>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="tsg2"  id="tsg2">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<label class="control-label text-center">3</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label text-center">Weight of the bottle with stopper and powder,  W2 in g</label>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="tsg3"  id="tsg3">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<label class="control-label text-center">4</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label text-center">Weight of the bottle with stopper, powder and distilled water to fill rest of the bottle at room temperature,  W3 in g</label>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="tsg4"  id="tsg4">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<label class="control-label text-center">5</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label text-center">Weight of the bottle with stopper filled with distilled water at room temperature, W4 in g</label>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="tsg5"  id="tsg5">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<label class="control-label text-center">6</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label text-center">True Specific Gravity @t °C - (W2 - W1) / ((W4 - W2) - (W3 - W2))</label>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<input type="text" class="form-control" name="tsg6"  id="tsg6">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
				
			
<?php	
		}else if($r1['test_code']=="asg")
		{
			$test_check.="asg,";
	?>
			<div class="panel panel-default" id ="asg">
				<div class="panel-heading" id="txtasg">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse_asg">
							<h4 class="panel-title"><b>APPARENT SPECIFIC GRAVITY</b></h4>
						</a>
					</h4>
				</div>
				<div id="collapse_asg" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">									
							<div class="col-lg-12">
								<div class="form-group">
									<div class="col-sm-1">
										<label for="chk_asg">2.</label>
										<input type="checkbox" class="visually-hidden" name="chk_asg"  id="chk_asg" value="chk_asg"><br>
									</div>
									<label for="inputEmail3" class="col-sm-4 control-label label-right">Apparent Specific Gravity</label>
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">Sr No</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Description</label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label class="control-label text-center">Results</label>
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">1</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Weight of oven dry test piece, A in g. </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="asg1"  id="asg1">
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">2</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Quantity of water added in 1000 ml jar containing the test piece, C in g. </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="asg2"  id="asg2">
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">3</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Apparent Specific Gravity - A / (1000 - C)</label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="asg3"  id="asg3">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php	
		}else if($r1['test_code']=="wtr")
		{
			$test_check.="wtr,";
	?>
			<div class="panel panel-default" id ="wtr">
				<div class="panel-heading" id="txtwtr">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse_wtr">
							<h4 class="panel-title"><b>WATER ABSORPTION</b></h4>
						</a>
					</h4>
				</div>
				<div id="collapse_wtr" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">									
							<div class="col-lg-12">
								<div class="form-group">
									<div class="col-sm-1">
										<label for="chk_wtr">3.</label>
										<input type="checkbox" class="visually-hidden" name="chk_wtr"  id="chk_wtr" value="chk_wtr"><br>
									</div>
									<label for="inputEmail3" class="col-sm-4 control-label label-right">Water Absorption</label>
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">Sr No</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Description</label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label class="control-label text-center">Results</label>
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">1</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Weight of oven dry test piece, A in 8  </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="wtr1"  id="wtr1">
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">2</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Weight of saturated surface dry test piece, B in g. </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="wtr2"  id="wtr2">
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">3</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Water absorption - ((B - A) / A) x 100</label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="wtr3"  id="wtr3">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php	
		}else if($r1['test_code']=="com")
		{
			$test_check.="com,";
	?>
			<div class="panel panel-default" id ="com">
				<div class="panel-heading" id="txtcom">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse_com">
							<h4 class="panel-title"><b>COMPRESSIVE STRENGTH</b></h4>
						</a>
					</h4>
				</div>
				<div id="collapse_com" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">									
							<div class="col-lg-12">
								<div class="form-group">
									<div class="col-sm-1">
										<label for="chk_com">3.</label>
										<input type="checkbox" class="visually-hidden" name="chk_com"  id="chk_com" value="chk_com"><br>
									</div>
									<label for="inputEmail3" class="col-sm-4 control-label label-right">Compressive Strength</label>
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">Sr No</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Description</label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label class="control-label text-center">Results</label>
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">1</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Length of specimen, </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="com1"  id="com1">
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">2</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Diameter of specimen, </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="com2"  id="com2">
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">3</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Length to diameter ratio (Must be between 2 to 3)</label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="com3"  id="com3">
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">4</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Rate of loading (stress),</label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="com4"  id="com4">
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">5</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Load at failure,</label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="com5"  id="com5">
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">6</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Area</label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="com6"  id="com6">
								</div>
							</div>
						</div>
						<br>
						<div class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">7</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Compressive strength, </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="com7"  id="com7">
								</div>
							</div>
						</div>
						<br>
						<di v class="row">									
							<div class="col-sm-1">
								<div class="form-group">
									<label class="control-label text-center">8</label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label text-center">Mode of failure </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" class="form-control" name="com8"  id="com8">
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
	<br>
	<hr>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<div class="col-sm-2">
					<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
				<input type="hidden" class="form-control" name="idEdit" id="idEdit"/>

				</div>
				<div class="col-sm-2">
					<!-- SAVE BUTTON LOGIC VAIBHAV-->
					<?php   
						$querys_job1 = "SELECT * FROM ws_bela_stone WHERE `is_deleted`='0' and lab_no='$lab_no'";
						$qrys_jobno = mysqli_query($conn,$querys_job1);
						$rows=mysqli_num_rows($qrys_jobno);
						if($rows < 1){ ?>
							<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
							<?php }													
								?>
					

				</div>
				<div class="col-sm-2">
					<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>

				</div>
				<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
				<?php
				// $val1 =  $_SESSION['isadmin'];
										 // $val2 =  $_SESSION['is_special'];
										//if($val1 =="0" || $val1 =="5" || $val1 =="44" || $val2 =="1"){
				?>
				<div class="col-sm-2">
					<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_ws_bela_stone.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
				</div>
				<?php //} ?>
				<div class="col-sm-2">
					<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_ws_bela_stone.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&tbl_name=ws_bela_stone" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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
							 $query = "select * from ws_bela_stone WHERE lab_no='$aa'  and `is_deleted`='0'";

								$result = mysqli_query($conn, $query);
			

								if (mysqli_num_rows($result) > 0) {
							while($r = mysqli_fetch_array($result)){
					
										if($r['is_deleted'] == 0){
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
										<!--<td style="text-align:center;"><?php //echo $r['report_no'];?></td>-->
										<td style="text-align:center;"><?php echo $r['job_no'];?></td>
										<td style="text-align:center;"><?php echo $r['lab_no'];?></td>					
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
		</div>		<!-- TEST LIST FILD VAIBHAV-->
		<input type="hidden" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ',');?>">		
				</form>
	</div>
		
			</div>
		</div>
		</div>
	</section>
				
</div>	
	

	
	
		
<?php include("footer.php");?>
<script>

 $(function () {
    $('.select2').select2();
  })
	
	//True Specific Gravity
	function tsg_auto()
	{
		$('#txttsg').css("background-color","var(--primary)");
		
		var tsg1 = randomNumberFromRange(26.00,30.00).toFixed();
		var tsg2 = randomNumberFromRange(43.00,48.00).toFixed(2);
		var tsg3 = randomNumberFromRange(58.00,65.00).toFixed(2);
		var tsg4 = randomNumberFromRange(100.00,105.00).toFixed(2);
		var tsg5 = randomNumberFromRange(105.00,108.00).toFixed(2);
		
		$('#tsg1').val((+tsg1).toFixed(0));
		$('#tsg2').val((+tsg2).toFixed(2));
		$('#tsg3').val((+tsg3).toFixed(2));
		$('#tsg4').val((+tsg4).toFixed(2));
		$('#tsg5').val((+tsg5).toFixed(2));
		
		var tsg1 = $('#tsg1').val();
		var tsg2 = $('#tsg2').val();
		var tsg3 = $('#tsg3').val();
		var tsg4 = $('#tsg4').val();
		var tsg5 = $('#tsg5').val();
		
		var tsg6 = ((+tsg3) - (+tsg2)) / (((+tsg5) - (+tsg3)) - ((+tsg4) - (+tsg3)));
		$('#tsg6').val((+tsg6).toFixed(2));
		
		
	}
	$('#chk_tsg').change(function(){
        if(this.checked)
		{
			tsg_auto();
		}
        else
		{
			$('#txttsg').css("background-color","white");
			$('#tsg1').val(null);
			$('#tsg2').val(null);
			$('#tsg3').val(null);
			$('#tsg4').val(null);
			$('#tsg5').val(null);
			$('#tsg6').val(null);
		}
    });
	$('#tsg1,#tsg2,#tsg3,#tsg4,#tsg5').change(function(){
		$('#txttsg').css("background-color","var(--primary)");
		var tsg1 = $('#tsg1').val();
		var tsg2 = $('#tsg2').val();
		var tsg3 = $('#tsg3').val();
		var tsg4 = $('#tsg4').val();
		var tsg5 = $('#tsg5').val();
		
		var tsg6 = ((+tsg3) - (+tsg2)) / (((+tsg5) - (+tsg3)) - ((+tsg4) - (+tsg3)));
		$('#tsg6').val((+tsg6).toFixed(2));
	})
	
	
	
	
	//Apparent Specific Gravity
	function asg_auto()
	{
		$('#txtasg').css("background-color","var(--primary)");
		var asg1 = randomNumberFromRange(930.00,970.00).toFixed()
		var asg2 = randomNumberFromRange(630.00,670.00).toFixed()
		
		$('#asg1').val((+asg1).toFixed());
		$('#asg2').val((+asg2).toFixed());
		
		var asg1 = $('#asg1').val();
		var asg2 = $('#asg2').val();
		
		var asg3 = (+asg1) / (1000 - (+asg2));
		$('#asg3').val((+asg3).toFixed(2));
	}
	$('#chk_asg').change(function(){
        if(this.checked)
		{
			asg_auto();
		}
        else
		{
			$('#txtasg').css("background-color","white");
			$('#asg1').val(null);
			$('#asg2').val(null);
			$('#asg3').val(null);
		}      
    });
	
	$('#asg1,#asg2').change(function(){
		$('#txtasg').css("background-color","var(--primary)");
		var asg1 = $('#asg1').val();
		var asg2 = $('#asg2').val();
		
		var asg3 = (+asg1) / (1000 - (+asg2));
		$('#asg3').val((+asg3).toFixed(2));
	})
	
	
	
	//Water Absorption
	function wtr_auto()
	{
		$('#txtwtr').css("background-color","var(--primary)");
		var wtr1 = randomNumberFromRange(960.00,970.00).toFixed();
		var wtr2 = randomNumberFromRange(971.00,985.00).toFixed();
		
		$('#wtr1').val((+wtr1).toFixed());
		$('#wtr2').val((+wtr2).toFixed());
		
		var wtr1 = $('#wtr1').val();
		var wtr2 = $('#wtr2').val();
		
		var wtr3 = (((+wtr2) - (+wtr1)) / (+wtr1)) * 100;
		$('#wtr3').val((+wtr3).toFixed(2));
	}
	$('#chk_wtr').change(function(){
        if(this.checked)
		{
			wtr_auto();
		}
        else
		{
			$('#txtwtr').css("background-color","white");
			$('#wtr1').val(null);
			$('#wtr2').val(null);
			$('#wtr3').val(null);
		}       
    });
	
	$('#wtr1,#wtr2').change(function(){
		$('#txtwtr').css("background-color","var(--primary)");
		var wtr1 = $('#wtr1').val();
		var wtr2 = $('#wtr2').val();
		
		var wtr3 = (((+wtr2) - (+wtr1)) / (+wtr1)) * 100;
		$('#wtr3').val((+wtr3).toFixed(2));
	})
	
	
	
	//Compressive Strength
	function com_auto()
	{
		$('#txtcom').css("background-color","var(--primary)");
		
		var com1 = randomNumberFromRange(150.00,160.00).toFixed(1);
		var com2 = randomNumberFromRange(53.00,58.00).toFixed(2);
		var com3 = randomNumberFromRange(2.00,3.80).toFixed(2);
		var com4 = randomNumberFromRange(170.00,180.00).toFixed(2);
		var com5 = randomNumberFromRange(655.00,680.00).toFixed(1);
		var com6 = randomNumberFromRange(2200.00,2400.00).toFixed(1);
		var com7 = randomNumberFromRange(251.00,290.00).toFixed(2);
		var com8 = randomNumberFromRange(8.10,12.80).toFixed(2);
		
		$('#com1').val(com1);
		$('#com2').val(com2);
		$('#com3').val(com3);
		$('#com4').val(com4);
		$('#com5').val(com5);
		$('#com6').val(com6);
		$('#com7').val(com7);
		$('#com8').val(com8);
		
	}
	$('#chk_com').change(function(){
        if(this.checked)
		{
			com_auto();
		}
        else
		{
			$('#txtcom').css("background-color","white");
			$('#com1').val(null);
			$('#com2').val(null);
			$('#com3').val(null);
			$('#com4').val(null);
			$('#com5').val(null);
			$('#com6').val(null);
			$('#com7').val(null);
			$('#com8').val(null);
		}
    });

  
  
  
  
  
  
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();
});

$('#chk_auto').change(function(){
	if(this.checked)
	{ 
		var temp = $('#test_list').val();
		var aa= temp.split(",");
		
		//tsg
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="tsg")
			{
				$("#chk_tsg").prop("checked", true); 
				tsg_auto();
				break;
			}					
		}
		//asg
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="asg")
			{
				$("#chk_asg").prop("checked", true); 
				asg_auto();
				break;
			}					
		}
		//wtr
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="wtr")
			{
				$("#chk_wtr").prop("checked", true); 
				wtr_auto();
				break;
			}					
		}
		//com
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="com")
			{
				$("#chk_com").prop("checked", true); 
				com_auto();
				break;
			}					
		}
	}
});
	
	
	
function randomNumberFromRange(min,max)
	{
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



$("#btn_edit_data").click(function(){ 
			$('#btn_edit_data').hide();

	});
function getGlazedTiles(){
				var lab_no = $('#lab_no').val(); 
				var report_no = $('#report_no').val(); 
				var job_no=$('#job_no').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_ws_bela_stone.php',
		data: 'action_type=view&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
		success:function(html){
		$('#display_data').html(html);

        }
    });
}



function saveMetal(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {
		var report_no = $('#report_no').val();
		var job_no = $('#job_no').val();
		var lab_no = $('#lab_no').val();
		var ulr = $('#ulr').val();
		
		var temp = $('#test_list').val();
		var aa= temp.split(",");	
		
		//True Specific Gravity
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="tsg")
			{
				if(document.getElementById('chk_tsg').checked) {
					var chk_tsg = "1";
				}
				else{
					var chk_tsg = "0";
				}
				var tsg1 = $('#tsg1').val();
				var tsg2 = $('#tsg2').val();
				var tsg3 = $('#tsg3').val();
				var tsg4 = $('#tsg4').val();
				var tsg5 = $('#tsg5').val();
				var tsg6 = $('#tsg6').val();
				
				break;
			}
			else
			{
				var chk_grd = "0";
				var tsg1 = "0";
				var tsg2 = "0";
				var tsg3 = "0";
				var tsg4 = "0";
				var tsg5 = "0";
				var tsg6 = "0";
			}
		}
		
		//Apparent Specific Gravity
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="asg")
			{
				if(document.getElementById('chk_asg').checked) {
					var chk_asg  = "1";
				}
				else{
					var chk_asg  = "0";
				}
				var asg1 = $('#asg1').val();
				var asg2 = $('#asg2').val();
				var asg3 = $('#asg3').val();
				
				break;
			}
			else
			{
				var chk_asg  = "0";
				var asg1 = "0";
				var asg2 = "0";
				var asg3 = "0";
			}
		}
		
		//Water Absorption
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="wtr")
			{
				if(document.getElementById('chk_wtr').checked) {
					var chk_wtr  = "1";
				}
				else{
					var chk_wtr  = "0";
				}
				
				var wtr1 = $('#wtr1').val();
				var wtr2 = $('#wtr2').val();
				var wtr3 = $('#wtr3').val();
				
				break;
			}
			else
			{
				var chk_wtr	= "0";
				var wtr1 = "0";
				var wtr2 = "0";
				var wtr3 = "0";
			}
		}
			
		//Compressive Strength
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="com")
			{
				if(document.getElementById('chk_com').checked) {
					var chk_com  = "1";
				}
				else{
					var chk_com  = "0";
				}
				
				var com1 = $('#com1').val();
				var com2 = $('#com2').val();
				var com3 = $('#com3').val();
				var com4 = $('#com4').val();
				var com5 = $('#com5').val();
				var com6 = $('#com6').val();
				var com7 = $('#com7').val();
				var com8 = $('#com8').val();
				
				break;
			}
			else
			{
				var chk_com	= "0";
				var com1 = "0";
				var com2 = "0";
				var com3 = "0";
				var com4 = "0";
				var com5 = "0";
				var com6 = "0";
				var com7 = "0";
				var com8 = "0";
			}
		}
				
				

		billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&ulr='+ulr+'&chk_tsg='+chk_tsg+'&tsg1='+tsg1+'&tsg2='+tsg2+'&tsg3='+tsg3+'&tsg4='+tsg4+'&tsg5='+tsg5+'&tsg6='+tsg6+'&chk_asg='+chk_asg+'&asg1='+asg1+'&asg2='+asg2+'&asg3='+asg3+'&chk_wtr='+chk_wtr+'&wtr1='+wtr1+'&wtr2='+wtr2+'&wtr3='+wtr3+'&chk_com='+chk_com+'&com1='+com1+'&com2='+com2+'&com3='+com3+'&com4='+com4+'&com5='+com5+'&com6='+com6+'&com7='+com7+'&com8='+com8;
						
	}
	else if (type == 'edit'){
		var report_no = $('#report_no').val();
		var job_no = $('#job_no').val();
		var lab_no = $('#lab_no').val();
		var ulr = $('#ulr').val();
		
		var temp = $('#test_list').val();
		var aa= temp.split(",");	
		
		//True Specific Gravity
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="tsg")
			{
				if(document.getElementById('chk_tsg').checked) {
					var chk_tsg = "1";
				}
				else{
					var chk_tsg = "0";
				}
				var tsg1 = $('#tsg1').val();
				var tsg2 = $('#tsg2').val();
				var tsg3 = $('#tsg3').val();
				var tsg4 = $('#tsg4').val();
				var tsg5 = $('#tsg5').val();
				var tsg6 = $('#tsg6').val();
				
				break;
			}
			else
			{
				var chk_grd = "0";
				var tsg1 = "0";
				var tsg2 = "0";
				var tsg3 = "0";
				var tsg4 = "0";
				var tsg5 = "0";
				var tsg6 = "0";
			}
		}
		
		//Apparent Specific Gravity
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="asg")
			{
				if(document.getElementById('chk_asg').checked) {
					var chk_asg  = "1";
				}
				else{
					var chk_asg  = "0";
				}
				var asg1 = $('#asg1').val();
				var asg2 = $('#asg2').val();
				var asg3 = $('#asg3').val();
				
				break;
			}
			else
			{
				var chk_asg  = "0";
				var asg1 = "0";
				var asg2 = "0";
				var asg3 = "0";
			}
		}
		
		//Water Absorption
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="wtr")
			{
				if(document.getElementById('chk_wtr').checked) {
					var chk_wtr  = "1";
				}
				else{
					var chk_wtr  = "0";
				}
				
				var wtr1 = $('#wtr1').val();
				var wtr2 = $('#wtr2').val();
				var wtr3 = $('#wtr3').val();
				
				break;
			}
			else
			{
				var chk_wtr	= "0";
				var wtr1 = "0";
				var wtr2 = "0";
				var wtr3 = "0";
			}
		}
			
		//Compressive Strength
		for(var i=0;i<aa.length;i++)
		{
			if(aa[i]=="com")
			{
				if(document.getElementById('chk_com').checked) {
					var chk_com  = "1";
				}
				else{
					var chk_com  = "0";
				}
				
				var com1 = $('#com1').val();
				var com2 = $('#com2').val();
				var com3 = $('#com3').val();
				var com4 = $('#com4').val();
				var com5 = $('#com5').val();
				var com6 = $('#com6').val();
				var com7 = $('#com7').val();
				var com8 = $('#com8').val();
				
				break;
			}
			else
			{
				var chk_com	= "0";
				var com1 = "0";
				var com2 = "0";
				var com3 = "0";
				var com4 = "0";
				var com5 = "0";
				var com6 = "0";
				var com7 = "0";
				var com8 = "0";
			}
		}
		
		var idEdit = $('#idEdit').val(); 
		
		
		billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&ulr='+ulr+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_tsg='+chk_tsg+'&tsg1='+tsg1+'&tsg2='+tsg2+'&tsg3='+tsg3+'&tsg4='+tsg4+'&tsg5='+tsg5+'&tsg6='+tsg6+'&chk_asg='+chk_asg+'&asg1='+asg1+'&asg2='+asg2+'&asg3='+asg3+'&chk_wtr='+chk_wtr+'&wtr1='+wtr1+'&wtr2='+wtr2+'&wtr3='+wtr3+'&chk_com='+chk_com+'&com1='+com1+'&com2='+com2+'&com3='+com3+'&com4='+com4+'&com5='+com5+'&com6='+com6+'&com7='+com7+'&com8='+com8;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	

    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_ws_bela_stone.php',
        data: billData,
		dataType: 'JSON',
        success:function(msg){
		$('#btn_save').hide();
		getGlazedTiles();
		var report_no = $('#report_no').val(); 
		var job_no = $('#job_no').val();
		//window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;
        }
    });
}
function editData(id){
	var lab_no = $('#lab_no').val(); 
	var report_no = $('#report_no').val(); 
	var job_no= $('#job_no').val();
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: '<?php echo $base_url; ?>save_ws_bela_stone.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			
			$('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();
			
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			
            var temp = $('#test_list').val();
			var aa= temp.split(",");				
				
			//tsg
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="tsg")
				{
					var chk_tsg = data.chk_tsg;
					if(chk_tsg=="1")
					{
						$('#txttsg').css("background-color","var(--primary)");	
						$("#chk_tsg").prop("checked", true); 
					}else{
						$('#txttsg').css("background-color","white");	
						$("#chk_tsg").prop("checked", false); 
					}
					$('#tsg1').val(data.tsg1);
					$('#tsg2').val(data.tsg2);
					$('#tsg3').val(data.tsg3);
					$('#tsg4').val(data.tsg4);
					$('#tsg5').val(data.tsg5);
					$('#tsg6').val(data.tsg6);	
					break;
				}
				else
				{
				}
			}
			
			//asg
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="asg")
				{
					var chk_asg = data.chk_asg;
					if(chk_asg=="1")
					{
						$('#txtasg').css("background-color","var(--primary)");	
						$("#chk_asg").prop("checked", true); 
					}else{
						$('#txtasg').css("background-color","white");	
						$("#chk_asg").prop("checked", false); 
					}
					$('#asg1').val(data.asg1);
					$('#asg2').val(data.asg2);
					$('#asg3').val(data.asg3);
					break;
				}
				else
				{
				}
			}
			
			//wtr
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="wtr")
				{
					var chk_wtr = data.chk_wtr;
					if(chk_wtr=="1")
					{
						$('#txtwtr').css("background-color","var(--primary)");	
						$("#chk_wtr").prop("checked", true); 
					}else{
						$('#txtwtr').css("background-color","white");	
						$("#chk_wtr").prop("checked", false); 
					}
					$('#wtr1').val(data.wtr1);
					$('#wtr2').val(data.wtr2);
					$('#wtr3').val(data.wtr3);
					break;
				}
				else
				{
				}
			}
			
			//com
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="com")
				{
					var chk_com = data.chk_com;
					if(chk_com=="1")
					{
						$('#txtcom').css("background-color","var(--primary)");	
						$("#chk_com").prop("checked", true); 
					}else{
						$('#txtcom').css("background-color","white");	
						$("#chk_com").prop("checked", false); 
					}
					$('#com1').val(data.com1);
					$('#com2').val(data.com2);
					$('#com3').val(data.com3);
					$('#com4').val(data.com4);
					$('#com5').val(data.com5);
					$('#com6').val(data.com6);
					$('#com7').val(data.com7);
					$('#com8').val(data.com8);
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


</script>


