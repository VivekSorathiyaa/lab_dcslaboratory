<?php 
include("header.php");
include("connection.php");
error_reporting(0);
session_start(); 

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
		if(isset($_GET['lab_no'])){
			$lab_no=$_GET['lab_no'];
			$aa	=$_GET['lab_no'];
			
		}if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
			
		}
		
		 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					/* $tank_no= $row_select4['tanker_no'];
					$lot_no= $row_select4['lot_no'];
					$bitumin_grade= $row_select4['bitumin_grade'];
					$bitumin_make= $row_select4['bitumin_make']; */
				}
		
		
?>
	<!-- STYLE PUT VAIBHAV-->
	<div class="content-wrapper" style="margin-left:0px !important;">
	<!-- Content Header (Page header) -->
		<section class="content">
		<!-- MENU INCLUDE VAIBHAV-->
		
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h2  style="text-align:center;">DRINKING WATER</h2>
						</div>
						<!--<div class="box-default">-->
						<form class="form" id="Glazed" method="post">
							<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">
							<Br>
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
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" readonly>
										</div>
									</div>
								</div>
							</div>
							<br>
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
												$querys_job1 = "SELECT * FROM water_drink WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
										//$val1 =  $_SESSION['isadmin'];
										 // $val2 =  $_SESSION['is_special'];
										// if($val1 =="0" || $val1 =="5" || $val1 =="44" || $val2 =="1"){
										?>
										<div class="col-sm-1">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_water_d.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>
										<!--<div class="col-sm-1">
											<a target = '_blank' href="<?php //echo $base_url; ?>print_report/print_water_full.php?job_no=<?php //echo $_GET['job_no'];?>&&report_no=<?php //echo $_GET['report_no'];?>&&lab_no=<?php //echo $_GET['lab_no'];?>&&trf_no=<?php //echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Full Report</b></a>
										</div>
										<div class="col-sm-1">
											<a target = '_blank' href="<?php //echo $base_url; ?>print_report/print_water_r1.php?job_no=<?php //echo $_GET['job_no'];?>&&report_no=<?php //echo $_GET['report_no'];?>&&lab_no=<?php //echo $_GET['lab_no'];?>&&trf_no=<?php //echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>R1 Report</b></a>
										</div>
										<div class="col-sm-1">
											<a target = '_blank' href="<?php //echo $base_url; ?>print_report/print_water_r2.php?job_no=<?php //echo $_GET['job_no'];?>&&report_no=<?php //echo $_GET['report_no'];?>&&lab_no=<?php //echo $_GET['lab_no'];?>&&trf_no=<?php //echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>R2 Report</b></a>
										</div>-->
										<?php //} ?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_water_d.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
											
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

		
							<?php
					$test_check;
					$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
						$result_select1 = mysqli_query($conn, $select_query1);
						while($r1 = mysqli_fetch_array($result_select1)){
							
							if($r1['test_code']=="phv")
							{
								
								$test_check.="phv,";
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
													<input type="checkbox" class="visually-hidden" name="chk_phv"  id="chk_phv" value="chk_phv"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">PH VALUE</label>
										</div>
								</div>
								<div class="col-lg-6">
									
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">SR No</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Before Set</label>
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">After Set</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">pH</label>
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">1</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="p1" name="p1" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="pa1" name="pa1" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="ph1" name="ph1" >
										</div>
									</div>
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">2</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="p2" name="p2" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="pa2" name="pa2" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="ph2" name="ph2" >
										</div>
									</div>
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">3</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="p3" name="p3" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="pa3" name="pa3" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="ph3" name="ph3" >
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">AVERAGE PH VALUE</label>
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
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="avgp" name="avgp" >
										</div>
									</div>
									
								</div>
								
							</div>
						</div>
							
								
							
							<br>
							
							
								
						
						</div>
				  
				
		
					</div>	
			<?php }
				
			else if($r1['test_code']=="tur")
			{ $test_check.="tur,";?>
		
			<div class="panel panel-default" id="tur">
					<div class="panel-heading" id="txttur">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse5tur">
								<h4 class="panel-title">
								<b>TURBIDITY</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse5tur" class="panel-collapse collapse">
						<div class="panel-body">
							<br>
							<div class="row">									
								
								<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_tur">2.</label>
													<input type="checkbox" class="visually-hidden" name="chk_tur"  id="chk_tur" value="chk_tur"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">TURBIDITY</label>
										</div>
								</div>
								<div class="col-lg-6">
									
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">SR No</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Celebration Reading (NTU)</label>
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Sample Reading Turbiduty (NTU)</label>
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">1</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="t1" name="t1" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="nt1" name="nt1" >
										</div>
									</div>
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">2</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="t2" name="t2" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="nt2" name="nt2" >
										</div>
									</div>
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">3</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="t3" name="t3" >
										</div>
									</div>									
									<div class="col-md-3">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="nt3" name="nt3" >
										</div>
									</div>
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">AVERAGE</label>
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
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="avgtur" name="avgtur" >
										</div>
									</div>
									
								</div>
								
							</div>
						</div>
							
								
							
							<br>
							
							
								
						
						</div>
				  
				
		
					</div>
					<?php }
				
			else if($r1['test_code']=="pla")
			{ $test_check.="pla,";?>
		
				<div class="panel panel-default" id="pla">
		<div class="panel-heading" id="txtpla">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31pla">
					<h4 class="panel-title">
					<b>PHENOPHTHEIN ALKALINITY</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31pla" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_pla">3.</label>
													<input type="checkbox" class="visually-hidden" name="chk_pla"  id="chk_pla" value="chk_pla"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">PHENOPHTHEIN ALKALINITY</label>
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
									  <label for="inputEmail3" class="col-sm-12 control-label">Blank Reading (ml)<br>(A)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Burette Reading (ml)<br>(B)</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Different<br> M = B-A</label>
									  
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)<br>(SV)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">P.A.=<br>M X N X 50000/SV</label>
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
										<input type="text" class="form-control" id="pla1" name="pla1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="plb1" name="plb1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="plc1" name="plc1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pld1" name="pld1" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pl1" name="pl1" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="avgpla" name="avgpla">
									</div>
								    </div>
								</div>
								
							</div>
							<br>
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pla2" name="pla2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="plb2" name="plb2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="plc2" name="plc2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pld2" name="pld2" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pl2" name="pl2" >
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
										<input type="text" class="form-control" id="pla3" name="pla3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="plb3" name="plb3" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="plc3" name="plc3" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pld3" name="pld3" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="pl3" name="pl3" >
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
															
						</div>
				  </div>
	</div>
			<?php }
				
			else if($r1['test_code']=="tla")
			{ $test_check.="tla,";?>
		
				<div class="panel panel-default" id="tla">
		<div class="panel-heading" id="txttla">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31tla">
					<h4 class="panel-title">
					<b>TOTAL ALKALINITY</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31tla" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_tla">4.</label>
													<input type="checkbox" class="visually-hidden" name="chk_tla"  id="chk_tla" value="chk_tla"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">TOTAL ALKALINITY</label>
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
									  <label for="inputEmail3" class="col-sm-12 control-label">Blank Reading (ml)<br>(A)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Burette Reading (ml)<br>(B)</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Different<br> M = B-A</label>
									  
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)<br>(SV)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">T.A.=<br>M X N X 50000/SV</label>
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
										<input type="text" class="form-control" id="tla1" name="tla1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tlb1" name="tlb1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tlc1" name="tlc1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tld1" name="tld1" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tl1" name="tl1" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="avgtla" name="avgtla">
									</div>
								    </div>
								</div>
								
							</div>
							<br>
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tla2" name="tla2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tlb2" name="tlb2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tlc2" name="tlc2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tld2" name="tld2" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tl2" name="tl2" >
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
										<input type="text" class="form-control" id="tla3" name="tla3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tlb3" name="tlb3" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tlc3" name="tlc3" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tld3" name="tld3" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tl3" name="tl3" >
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
															
						</div>
				  </div>
	</div>
			
			<?php }
				
			else if($r1['test_code']=="bic")
			{ $test_check.="bic,";?>
				
			<div class="panel panel-default" id="bic">
		<div class="panel-heading" id="txtbic">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31bic">
					<h4 class="panel-title">
					<b>CARBONATE BICARBONATE CALCULATION</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31bic" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_bic">5.</label>
													<input type="checkbox" class="visually-hidden" name="chk_bic"  id="chk_bic" value="chk_bic"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CARBONATE BICARBONATE CALCULATION</label>
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
									  <label for="inputEmail3" class="col-sm-12 control-label">Condition of Your Sample</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Hydroxide Alkalinity</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Carbonate Alkalinity</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Bicarbonate Alkalinity</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  
									</div>
									</div>

									<div class="col-lg-2">
									<div class="form-group">
									  
									</div>
									</div>
									
									
									
											
								</div>
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="avgsample" name="avgsample" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="avghyd" name="avghyd" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="avgcar" name="avgcar" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="avgbic" name="avgbic" >
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
								
							</div>
							
						</div>
				  </div>
	</div>
	
	<?php }
				
			else if($r1['test_code']=="tds")
			{ $test_check.="tds,";?>
				
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
													<input type="checkbox" class="visually-hidden" name="chk_tds"  id="chk_tds" value="chk_tds"><br>
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
								<div class="row">
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
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tda1" name="tda1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tdb1" name="tdb1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tdc1" name="tdc1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tdd1" name="tdd1" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="td1" name="td1" >
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
								
							</div>
							<br>
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tda2" name="tda2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tdb2" name="tdb2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tdc2" name="tdc2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tdd2" name="tdd2" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="td2" name="td2" >
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
										<input type="text" class="form-control" id="tda3" name="tda3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tdb3" name="tdb3" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tdc3" name="tdc3" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="tdd3" name="tdd3" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="td3" name="td3" >
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
								
						</div>
				  </div>
	</div>
				
			<?php }
				
			else if($r1['test_code']=="cal")
			{ $test_check.="cal,";?>
				
			<div class="panel panel-default" id="cal">
		<div class="panel-heading" id="txtcal">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31cal">
					<h4 class="panel-title">
					<b>TOTAL CALCIUM</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31cal" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_cal">7.</label>
													<input type="checkbox" class="visually-hidden" name="chk_cal"  id="chk_cal" value="chk_cal"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">TOTAL CALCIUM</label>
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
									  <label for="inputEmail3" class="col-sm-12 control-label">Blank Reading (ml)<br>(A)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Burette Reading (ml)<br>(B)</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Different<br> M = B-A</label>
									  
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)<br>(SV)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">T.C.=<br>M X 0.40078 X 1000/SV</label>
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
										<input type="text" class="form-control" id="caa1" name="caa1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cab1" name="cab1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cac1" name="cac1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cad1" name="cad1" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ca1" name="ca1" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="avgca" name="avgca">
									</div>
								    </div>
								</div>
								
							</div>
							<br>
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="caa2" name="caa2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cab2" name="cab2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cac2" name="cac2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cad2" name="cad2" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ca2" name="ca2" >
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
							<Br>
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="caa3" name="caa3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cab3" name="cab3" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cac3" name="cac3" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cad3" name="cad3" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ca3" name="ca3" >
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
								
						</div>
				  </div>
	</div>
				
			<?php }
				
			else if($r1['test_code']=="mag")
			{ $test_check.="mag,";?>
				
			<div class="panel panel-default" id="mag">
		<div class="panel-heading" id="txtmag">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31mag">
					<h4 class="panel-title">
					<b>MAGNESIUM</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31mag" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_mag">8.</label>
													<input type="checkbox" class="visually-hidden" name="chk_mag"  id="chk_mag" value="chk_mag"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">MAGNESIUM</label>
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
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">mg = </label>
									</div>
									</div>
									
									<div class="col-lg-6">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">(Total Hardness - Calcium Reading) x 0.02435 x 1000 / Sample Volume</label>
									</div>
									</div>
									
									
									<div class="col-lg-3">
									<div class="form-group">
									 <input type="text" class="form-control" id="avgmag" name="avgmag" >
									</div>
									</div>
									
									
									
									
									
											
								</div>
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								
						</div>
				  </div>
	</div>
			<?php }
				
			else if($r1['test_code']=="con")
			{ $test_check.="con,";?>
				
			<div class="panel panel-default" id="con">
		<div class="panel-heading" id="txtcon">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31con">
					<h4 class="panel-title">
					<b>CONDUCTIVITY</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31con" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_con">11.</label>
													<input type="checkbox" class="visually-hidden" name="chk_con"  id="chk_con" value="chk_con"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CONDUCTIVITY</label>
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
									<div class="col-lg-5">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Celebration Reading for 0.01 M Kel Solution at 25 &deg;C</label>
									</div>
									</div>
									
									<div class="col-lg-5">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Conductivity of Sample <br> (MMoh/cm)</label>
									</div>
									</div>
									
											
								</div>
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									<div class="col-lg-5">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="con1" name="con1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-5">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cos1" name="cos1" >
									  </div>
									</div>
									</div>
									
									
								
							</div>
							<br>
								<div class="row">
									<div class="col-lg-5">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="con2" name="con2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-5">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cos2" name="cos2" >
									  </div>
									</div>
									</div>
									
									
								
							</div>
							<br>
								<div class="row">
									<div class="col-lg-5">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="con3" name="con3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-5">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cos3" name="cos3" >
									  </div>
									</div>
									</div>
									
									
								
							</div>
							<br>
								<div class="row">
									<div class="col-lg-5">
									<div class="form-group">
									  <div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
									  </div>
									</div>
									</div>
									<div class="col-lg-5">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="avgcon" name="avgcon" >
									  </div>
									</div>
									</div>
									
									
								
							</div>
						</div>
				  </div>
	</div>
			<?php }
				
			else if($r1['test_code']=="chl")
			{ $test_check.="chl,";?>
				
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
													<input type="checkbox" class="visually-hidden" name="chk_chl"  id="chk_chl" value="chk_chl"><br>
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
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Blank Reading<br>(A)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Burette Reading <br>(B)</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">
									 Different <br>M = B - A</label>
									  
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)<br>(SV)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Chloride =<br>M X N X 35450/SV</label>
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
										<input type="text" class="form-control" id="cha1" name="cha1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="chb1" name="chb1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="chc1" name="chc1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="chd1" name="chd1" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ch1" name="ch1" >
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
								
							</div>
							<br>
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="cha2" name="cha2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="chb2" name="chb2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="chc2" name="chc2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="chd2" name="chd2" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ch2" name="ch2" >
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
										<input type="text" class="form-control" id="cha3" name="cha3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="chb3" name="chb3" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="chc3" name="chc3" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="chd3" name="chd3" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="ch3" name="ch3" >
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
								
						</div>
				  </div>
	</div>
			<?php }
				
			else if($r1['test_code']=="sul")
			{ $test_check.="sul,";?>
				
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
													<input type="checkbox" class="visually-hidden" name="chk_sul"  id="chk_sul" value="chk_sul"><br>
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
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Wt. of empty platinum crucible(g)<br>(M1)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Wt.of Crucible+ residue(g)<br>(M2)</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Diff. in Wt. in mg<br> M = M2 - M1</label>
									
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample<br>ml(SV)</label>
									  
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Total Sulphites (mg/l)=<br>M X 411.5 X 1000/Volume of smaple</label>
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
										<input type="text" class="form-control" id="sua1" name="sua1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sub1" name="sub1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="suc1" name="suc1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sud1" name="sud1" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="su1" name="su1" >
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
								
							</div>
							<br>
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sua2" name="sua2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sub2" name="sub2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="suc2" name="suc2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sud2" name="sud2" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="su2" name="su2" >
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
										<input type="text" class="form-control" id="sua3" name="sua3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sub3" name="sub3" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="suc3" name="suc3" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sud3" name="sud3" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="su3" name="su3" >
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
							
								
						</div>
				  </div>
				  </div>
	
				<?php }
				
			else if($r1['test_code']=="hrd")
			{ $test_check.="hrd,";?>
				
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
													<label for="chk_hrd">6.</label>
													<input type="checkbox" class="visually-hidden" name="chk_hrd"  id="chk_hrd" value="chk_hrd"><br>
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
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Blank Reading (ml)<br>(A)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Burette Reading (ml)<br>(B)</label>
									</div>
									</div>
									
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Different<br> M = B-A</label>
									  
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									 <label for="inputEmail3" class="col-sm-12 control-label">Volume of Sample (ml)<br>(SV)</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">T.H.=<br>M X CF X 1000/SV</label>
									</div>
									</div>

									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Average</label>
									</div>
									</div>
									
									
									
											
								</div>
								<br>
								
								
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hra1" name="hra1" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hrb1" name="hrb1" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hrc1" name="hrc1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hrd1" name="hrd1" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hr1" name="hr1" >
									  </div>									
								     </div>
									</div>								
								<div class="col-lg-2">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="avghr" name="avghr">
									</div>
								    </div>
								</div>
								
							</div>
							<br>
							<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hra2" name="hra2" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hrb2" name="hrb2" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hrc2" name="hrc2" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hrd2" name="hrd2" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hr2" name="hr2" >
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
										<input type="text" class="form-control" id="hra3" name="hra3" >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hrb3" name="hrb3" >
									  </div>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hrc3" name="hrc3" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hrd3" name="hrd3" >
									  </div>
									</div>
									</div>													
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hr3" name="hr3" >
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
										<label for="inputEmail3" class="col-sm-12 control-label">CF = </label>
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="hrcf" name="hrcf" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
	
				<?php }
				
			else if($r1['test_code']=="col")
			{ $test_check.="col,";?>
				
			<div class="panel panel-default" id="col">
		<div class="panel-heading" id="txtcol">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31col">
					<h4 class="panel-title">
					<b>COLOUR HAZEEN UNIT</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31col" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_col">12.</label>
													<input type="checkbox" class="visually-hidden" name="chk_col"  id="chk_col" value="chk_col"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">COLOUR HAZEEN UNIT</label>
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
										<input type="text" class="form-control" id="avgcol" name="avgcol" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="tas")
			{ $test_check.="tas,";?>
				
			<div class="panel panel-default" id="tas">
		<div class="panel-heading" id="txttas">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31tas">
					<h4 class="panel-title">
					<b>TASTE</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31tas" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_tas">13.</label>
													<input type="checkbox" class="visually-hidden" name="chk_tas"  id="chk_tas" value="chk_tas"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">TASTE</label>
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
										<input type="text" class="form-control" id="avgtas" name="avgtas" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="odo")
			{ $test_check.="odo,";?>
				
			<div class="panel panel-default" id="odo">
		<div class="panel-heading" id="txtodo">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31odo">
					<h4 class="panel-title">
					<b>ODOUR</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31odo" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_odo">14.</label>
													<input type="checkbox" class="visually-hidden" name="chk_odo"  id="chk_odo" value="chk_odo"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">ODOUR</label>
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
										<input type="text" class="form-control" id="avgodo" name="avgodo" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="ins")
			{ $test_check.="ins,";?>
				
			<div class="panel panel-default" id="ins">
		<div class="panel-heading" id="txtins">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ins">
					<h4 class="panel-title">
					<b>INSOLUBLE</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31ins" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_ins">15.</label>
													<input type="checkbox" class="visually-hidden" name="chk_ins"  id="chk_ins" value="chk_ins"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">INSOLUBLE</label>
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
										<input type="text" class="form-control" id="avgins" name="avgins" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="spg")
			{ $test_check.="spg,";?>
				
			<div class="panel panel-default" id="spg">
		<div class="panel-heading" id="txtspg">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#spglapse31spg">
					<h4 class="panel-title">
					<b>SPECIFIC GRAVITY</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="spglapse31spg" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_spg">16.</label>
													<input type="checkbox" class="visually-hidden" name="chk_spg"  id="chk_spg" value="chk_spg"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SPECIFIC GRAVITY</label>
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
										<input type="text" class="form-control" id="avgspg" name="avgspg" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="alu")
			{ $test_check.="alu,";?>
				
			<div class="panel panel-default" id="alu">
		<div class="panel-heading" id="txtalu">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31alu">
					<h4 class="panel-title">
					<b>ALUMINUM</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31alu" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_alu">17.</label>
													<input type="checkbox" class="visually-hidden" name="chk_alu"  id="chk_alu" value="chk_alu"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">ALUMINUM</label>
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
										<input type="text" class="form-control" id="avgalu" name="avgalu" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="amm")
			{ $test_check.="amm,";?>
				
			<div class="panel panel-default" id="amm">
		<div class="panel-heading" id="txtamm">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31amm">
					<h4 class="panel-title">
					<b>AMMONIA</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31amm" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_amm">18.</label>
													<input type="checkbox" class="visually-hidden" name="chk_amm"  id="chk_amm" value="chk_amm"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">AMMONIA</label>
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
										<input type="text" class="form-control" id="avgamm" name="avgamm" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="ani")
			{ $test_check.="ani,";?>
				
			<div class="panel panel-default" id="ani">
		<div class="panel-heading" id="txtani">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ani">
					<h4 class="panel-title">
					<b>ANIONIC DETERGENT</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31ani" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_ani">19.</label>
													<input type="checkbox" class="visually-hidden" name="chk_ani"  id="chk_ani" value="chk_ani"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">ANIONIC DETERGENT</label>
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
										<input type="text" class="form-control" id="avgani" name="avgani" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="bar")
			{ $test_check.="bar,";?>
				
			<div class="panel panel-default" id="bar">
		<div class="panel-heading" id="txtbar">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31bar">
					<h4 class="panel-title">
					<b>BARIUM</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31bar" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_bar">20.</label>
													<input type="checkbox" class="visually-hidden" name="chk_bar"  id="chk_bar" value="chk_bar"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">BARIUM</label>
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
										<input type="text" class="form-control" id="avgbar" name="avgbar" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="bor")
			{ $test_check.="bor,";?>
				
			<div class="panel panel-default" id="bor">
		<div class="panel-heading" id="txtbor">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31bor">
					<h4 class="panel-title">
					<b>BORON</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31bor" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_bor">21.</label>
													<input type="checkbox" class="visually-hidden" name="chk_bor"  id="chk_bor" value="chk_bor"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">BORON</label>
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
										<input type="text" class="form-control" id="avgbor" name="avgbor" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="cra")
			{ $test_check.="cra,";?>
				
			<div class="panel panel-default" id="cra">
		<div class="panel-heading" id="txtcra">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31cra">
					<h4 class="panel-title">
					<b>CHLORINE</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31cra" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_cra">22.</label>
													<input type="checkbox" class="visually-hidden" name="chk_cra"  id="chk_cra" value="chk_cra"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CHLORINE</label>
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
										<input type="text" class="form-control" id="avgcra" name="avgcra" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="flu")
			{ $test_check.="flu,";?>
				
			<div class="panel panel-default" id="flu">
		<div class="panel-heading" id="txtflu">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31flu">
					<h4 class="panel-title">
					<b>FLUORIDE</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31flu" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_flu">23.</label>
													<input type="checkbox" class="visually-hidden" name="chk_flu"  id="chk_flu" value="chk_flu"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">FLUORIDE</label>
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
										<input type="text" class="form-control" id="avgflu" name="avgflu" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="frc")
			{ $test_check.="frc,";?>
				
			<div class="panel panel-default" id="frc">
		<div class="panel-heading" id="txtfrc">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31frc">
					<h4 class="panel-title">
					<b>FREE RESIDUAL CHLORINE</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31frc" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_frc">24.</label>
													<input type="checkbox" class="visually-hidden" name="chk_frc"  id="chk_frc" value="chk_frc"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">FREE RESIDUAL CHLORINE</label>
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
										<input type="text" class="form-control" id="avgfrc" name="avgfrc" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="iro")
			{ $test_check.="iro,";?>
				
			<div class="panel panel-default" id="iro">
		<div class="panel-heading" id="txtiro">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31iro">
					<h4 class="panel-title">
					<b>IRON</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31iro" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_iro">25.</label>
													<input type="checkbox" class="visually-hidden" name="chk_iro"  id="chk_iro" value="chk_iro"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">IRON</label>
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
										<input type="text" class="form-control" id="avgiro" name="avgiro" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="man")
			{ $test_check.="man,";?>
				
			<div class="panel panel-default" id="man">
		<div class="panel-heading" id="txtman">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31man">
					<h4 class="panel-title">
					<b>MANGANESE</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31man" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_man">26.</label>
													<input type="checkbox" class="visually-hidden" name="chk_man"  id="chk_man" value="chk_man"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">MANGANESE</label>
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
										<input type="text" class="form-control" id="avgman" name="avgman" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="min")
			{ $test_check.="min,";?>
				
			<div class="panel panel-default" id="min">
		<div class="panel-heading" id="txtmin">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31min">
					<h4 class="panel-title">
					<b>MINERAL</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31min" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_min">27.</label>
													<input type="checkbox" class="visually-hidden" name="chk_min"  id="chk_min" value="chk_min"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">MINERAL</label>
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
										<input type="text" class="form-control" id="avgmin" name="avgmin" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="nit")
			{ $test_check.="nit,";?>
				
			<div class="panel panel-default" id="nit">
		<div class="panel-heading" id="txtnit">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31nit">
					<h4 class="panel-title">
					<b>NITRATE</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31nit" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_nit">28.</label>
													<input type="checkbox" class="visually-hidden" name="chk_nit"  id="chk_nit" value="chk_nit"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">NITRATE</label>
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
										<input type="text" class="form-control" id="avgnit" name="avgnit" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="phe")
			{ $test_check.="phe,";?>
				
			<div class="panel panel-default" id="phe">
		<div class="panel-heading" id="txtphe">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31phe">
					<h4 class="panel-title">
					<b>PHENOLIC COMPOUND</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31phe" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_phe">29.</label>
													<input type="checkbox" class="visually-hidden" name="chk_phe"  id="chk_phe" value="chk_phe"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">PHENOLIC COMPOUND</label>
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
										<input type="text" class="form-control" id="avgphe" name="avgphe" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="sel")
			{ $test_check.="sel,";?>
				
			<div class="panel panel-default" id="sel">
		<div class="panel-heading" id="txtsel">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31sel">
					<h4 class="panel-title">
					<b>SELENIUM</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31sel" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_sel">30.</label>
													<input type="checkbox" class="visually-hidden" name="chk_sel"  id="chk_sel" value="chk_sel"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SELENIUM</label>
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
										<input type="text" class="form-control" id="avgsel" name="avgsel" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="sil")
			{ $test_check.="sil,";?>
				
			<div class="panel panel-default" id="sil">
		<div class="panel-heading" id="txtsil">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31sill">
					<h4 class="panel-title">
					<b>SILVER</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31sill" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_sil">31.</label>
													<input type="checkbox" class="visually-hidden" name="chk_sil"  id="chk_sil" value="chk_sil"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SILVER</label>
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
										<input type="text" class="form-control" id="avgsil" name="avgsil" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="zin")
			{ $test_check.="zin,";?>
				
			<div class="panel panel-default" id="zin">
		<div class="panel-heading" id="txtzin">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31zin">
					<h4 class="panel-title">
					<b>ZINC</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31zin" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_zin">32.</label>
													<input type="checkbox" class="visually-hidden" name="chk_zin"  id="chk_zin" value="chk_zin"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">ZINC</label>
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
										<input type="text" class="form-control" id="avgzin" name="avgzin" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="cop")
			{ $test_check.="cop,";?>
				
			<div class="panel panel-default" id="cop">
		<div class="panel-heading" id="txtcop">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31cop">
					<h4 class="panel-title">
					<b>COPPER</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31cop" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_cop">33.</label>
													<input type="checkbox" class="visually-hidden" name="chk_cop"  id="chk_cop" value="chk_cop"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">COPPER</label>
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
										<input type="text" class="form-control" id="avgcop" name="avgcop" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="lea")
			{ $test_check.="lea,";?>
				
			<div class="panel panel-default" id="lea">
		<div class="panel-heading" id="txtlea">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31lea">
					<h4 class="panel-title">
					<b>LEAD</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31lea" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_lea">34.</label>
													<input type="checkbox" class="visually-hidden" name="chk_lea"  id="chk_lea" value="chk_lea"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">LEAD</label>
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
										<input type="text" class="form-control" id="avglea" name="avglea" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="cyn")
			{ $test_check.="cyn,";?>
				
			<div class="panel panel-default" id="cyn">
		<div class="panel-heading" id="txtcyn">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31cyn">
					<h4 class="panel-title">
					<b>CYANIDE</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31cyn" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_cyn">35.</label>
													<input type="checkbox" class="visually-hidden" name="chk_cyn"  id="chk_cyn" value="chk_cyn"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CYANIDE</label>
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
										<input type="text" class="form-control" id="avgcyn" name="avgcyn" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="tot")
			{ $test_check.="tot,";?>
				
			<div class="panel panel-default" id="tot">
		<div class="panel-heading" id="txttot">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31tot">
					<h4 class="panel-title">
					<b>TOTAL ARSENIC</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31tot" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_tot">36.</label>
													<input type="checkbox" class="visually-hidden" name="chk_tot"  id="chk_tot" value="chk_tot"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">TOTAL ARSENIC</label>
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
										<input type="text" class="form-control" id="avgtot" name="avgtot" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="cad")
			{ $test_check.="cad,";?>
				
			<div class="panel panel-default" id="cad">
		<div class="panel-heading" id="txtcad">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31cad">
					<h4 class="panel-title">
					<b>CADMIUM</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31cad" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_cad">37.</label>
													<input type="checkbox" class="visually-hidden" name="chk_cad"  id="chk_cad" value="chk_cad"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CADMIUM</label>
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
										<input type="text" class="form-control" id="avgcad" name="avgcad" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="bec")
			{ $test_check.="bec,";?>
				
			<div class="panel panel-default" id="bec">
		<div class="panel-heading" id="txtbec">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31bec">
					<h4 class="panel-title">
					<b>TOTAL COIL FORM BECTERIA</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31bec" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_bec">38.</label>
													<input type="checkbox" class="visually-hidden" name="chk_bec"  id="chk_bec" value="chk_bec"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">TOTAL COIL FORM BECTERIA</label>
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
										<input type="text" class="form-control" id="avgbec" name="avgbec" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
					<?php }
				
			else if($r1['test_code']=="eco")
			{ $test_check.="eco,";?>
				
			<div class="panel panel-default" id="eco">
		<div class="panel-heading" id="txteco">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31eco">
					<h4 class="panel-title">
					<b>E-COLI</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31eco" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_eco">40.</label>
													<input type="checkbox" class="visually-hidden" name="chk_eco"  id="chk_eco" value="chk_eco"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">E-COLI</label>
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
										<input type="text" class="form-control" id="avgeco" name="avgeco" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
		
				
				
				
				
				
				
				
				<?php }
				
			else if($r1['test_code']=="spd")
			{ $test_check.="spd,";?>
				
			<div class="panel panel-default" id="spd">
		<div class="panel-heading" id="txtspd">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ospd">
					<h4 class="panel-title">
					<b>SULPHIDE</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse31ospd" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-6">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_spd">41.</label>
													<input type="checkbox" class="visually-hidden" name="chk_spd"  id="chk_spd" value="chk_spd"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SULPHIDE</label>
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
										<input type="text" class="form-control" id="avgspd" name="avgspd" >
									  </div>
									</div>
									</div>
									
									
								</div>
								
							</div>
								
						</div>
				  </div>
	
				
			
				
			<?php }
		}?>					
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
							 $query = "select * from water_drink WHERE lab_no='$aa'  and `is_deleted`='0'";

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
		</div>
		
			<!-- TEST LIST FILD VAIBHAV-->
		<input type="hidden" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ',');?>">
							
							
							
							
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php include("footer.php");?>
	<script>
	 $(function () {
    $('.select2').select2();
  });
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();
	



	$('#chk_phv').change(function(){
        if(this.checked)
		{
			$('#txtphv').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtphv').css("background-color","white");	
		}
		
	});
	
	$('#chk_tur').change(function(){
        if(this.checked)
		{
			$('#txttur').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txttur').css("background-color","white");	
		}
		
	});
	
	$('#chk_pla').change(function(){
        if(this.checked)
		{
			$('#txtpla').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtpla').css("background-color","white");	
		}
		
	});
	
	$('#chk_tla').change(function(){
        if(this.checked)
		{
			$('#txttla').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txttla').css("background-color","white");	
		}
		
	});
	
	
	$('#chk_bic').change(function(){
        if(this.checked)
		{
			$('#txtbic').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtbic').css("background-color","white");	
		}
		
	});
	
	$('#chk_hrd').change(function(){
        if(this.checked)
		{
			$('#txthrd').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txthrd').css("background-color","white");	
		}
		
	});
	
	$('#chk_cal').change(function(){
        if(this.checked)
		{
			$('#txtcal').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtcal').css("background-color","white");	
		}
		
	});
	
	$('#chk_mag').change(function(){
        if(this.checked)
		{
			$('#txtmag').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtmag').css("background-color","white");	
		}
		
	});
	
	$('#chk_chl').change(function(){
        if(this.checked)
		{
			$('#txtchl').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtchl').css("background-color","white");	
		}
		
	});
	
	$('#chk_sul').change(function(){
        if(this.checked)
		{
			$('#txtsul').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtsul').css("background-color","white");	
		}
		
	});
	
	$('#chk_tds').change(function(){
        if(this.checked)
		{
			$('#txttds').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txttds').css("background-color","white");	
		}
		
	});
	
	
	
	$('#chk_con').change(function(){
        if(this.checked)
		{
			$('#txtcon').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtcon').css("background-color","white");	
		}
		
	});
	
	$('#chk_col').change(function(){
        if(this.checked)
		{
			$('#txtcol').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtcol').css("background-color","white");	
		}
		
	});
	
	$('#chk_tas').change(function(){
        if(this.checked)
		{
			$('#txttas').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txttas').css("background-color","white");	
		}
		
	});
	$('#chk_odo').change(function(){
        if(this.checked)
		{
			$('#txtodo').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtodo').css("background-color","white");	
		}
		
	});
	$('#chk_ins').change(function(){
        if(this.checked)
		{
			$('#txtins').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtins').css("background-color","white");	
		}
		
	});
	$('#chk_spg').change(function(){
        if(this.checked)
		{
			$('#txtspg').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtspg').css("background-color","white");	
		}
		
	});
	$('#chk_alu').change(function(){
        if(this.checked)
		{
			$('#txtalu').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtalu').css("background-color","white");	
		}
		
	});
	$('#chk_amm').change(function(){
        if(this.checked)
		{
			$('#txtamm').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtamm').css("background-color","white");	
		}
		
	});
	$('#chk_ani').change(function(){
        if(this.checked)
		{
			$('#txtani').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtani').css("background-color","white");	
		}
		
	});
	$('#chk_bar').change(function(){
        if(this.checked)
		{
			$('#txtbar').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtbar').css("background-color","white");	
		}
		
	});
	$('#chk_bor').change(function(){
        if(this.checked)
		{
			$('#txtbor').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtbor').css("background-color","white");	
		}
		
	});
	$('#chk_cra').change(function(){
        if(this.checked)
		{
			$('#txtcra').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtcra').css("background-color","white");	
		}
		
	});
	$('#chk_flu').change(function(){
        if(this.checked)
		{
			$('#txtflu').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtflu').css("background-color","white");	
		}
		
	});
	$('#chk_frc').change(function(){
        if(this.checked)
		{
			$('#txtfrc').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtfrc').css("background-color","white");	
		}
		
	});
	$('#chk_iro').change(function(){
        if(this.checked)
		{
			$('#txtiro').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtiro').css("background-color","white");	
		}
		
	});
	$('#chk_man').change(function(){
        if(this.checked)
		{
			$('#txtman').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtman').css("background-color","white");	
		}
		
	});
	$('#chk_min').change(function(){
        if(this.checked)
		{
			$('#txtmin').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtmin').css("background-color","white");	
		}
		
	});
	$('#chk_nit').change(function(){
        if(this.checked)
		{
			$('#txtnit').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtnit').css("background-color","white");	
		}
		
	});
	$('#chk_phe').change(function(){
        if(this.checked)
		{
			$('#txtphe').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtphe').css("background-color","white");	
		}
		
	});
	$('#chk_sel').change(function(){
        if(this.checked)
		{
			$('#txtsel').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtsel').css("background-color","white");	
		}
		
	});
	$('#chk_sil').change(function(){
        if(this.checked)
		{
			$('#txtsil').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtsil').css("background-color","white");	
		}
		
	});
	$('#chk_spd').change(function(){
        if(this.checked)
		{
			$('#txtspd').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtspd').css("background-color","white");	
		}
		
	});
	$('#chk_zin').change(function(){
        if(this.checked)
		{
			$('#txtzin').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtzin').css("background-color","white");	
		}
		
	});
	$('#chk_cop').change(function(){
        if(this.checked)
		{
			$('#txtcop').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtcop').css("background-color","white");	
		}
		
	});
	$('#chk_lea').change(function(){
        if(this.checked)
		{
			$('#txtlea').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtlea').css("background-color","white");	
		}
		
	});
	$('#chk_cyn').change(function(){
        if(this.checked)
		{
			$('#txtcyn').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtcyn').css("background-color","white");	
		}
		
	});
	$('#chk_tot').change(function(){
        if(this.checked)
		{
			$('#txttot').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txttot').css("background-color","white");	
		}
		
	});
	$('#chk_cad').change(function(){
        if(this.checked)
		{
			$('#txtcad').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtcad').css("background-color","white");	
		}
		
	});
	$('#chk_bec').change(function(){
        if(this.checked)
		{
			$('#txtbec').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txtbec').css("background-color","white");	
		}
		
	});
	
	$('#chk_eco').change(function(){
        if(this.checked)
		{
			$('#txteco').css("background-color","var(--primary)");	
		}
		else
		{
			$('#txteco').css("background-color","white");	
		}
		
	});
	
	
	
	function phv_auto()
	{
		
		
		var p1 = randomNumberFromRange(6.96,6.98).toFixed(2);
		var p2 = randomNumberFromRange(6.96,6.98).toFixed(2);
		var p3 = randomNumberFromRange(6.96,6.98).toFixed(2);
		$('#p1').val(p1);
		$('#p2').val(p2);
		$('#p3').val(p3);
		var pa1 = randomNumberFromRange(7.20,7.22).toFixed(2);
		var pa2 = randomNumberFromRange(7.20,7.22).toFixed(2);
		var pa3 = randomNumberFromRange(7.20,7.22).toFixed(2);
		$('#pa1').val(pa1);
		$('#pa2').val(pa2);
		$('#pa3').val(pa3);
		var ph1 = randomNumberFromRange(7.20,7.22).toFixed(2);
		var ph2 = randomNumberFromRange(7.20,7.22).toFixed(2);
		var ph3 = randomNumberFromRange(7.20,7.22).toFixed(2);
		$('#ph1').val(ph1);
		$('#ph2').val(ph2);
		$('#ph3').val(ph3);
		
		var ph_1 = $('#ph1').val();
		var ph_2 = $('#ph2').val();
		var ph_3 = $('#ph3').val();
		
		 var avgp = ((+ph_1) + (+ph_2) + (+ph_3))/3;
		 $('#avgp').val(avgp.toFixed(2));
		
		
			
	}
	
	$('#chk_phv').change(function(){
        if(this.checked)
		{  
			phv_auto();
			
		}
		else
		{
			$('#avgp').val(null);
			$('#p1').val(null);
			$('#p2').val(null);
			$('#p3').val(null);
			$('#pa1').val(null);
			$('#pa2').val(null);
			$('#pa3').val(null);
			$('#ph1').val(null);
			$('#ph2').val(null);
			$('#ph3').val(null);
			
			
		}
	});
	
	
	$('#ph1,#ph2,#ph3').change(function(){
		$('#txtphv').css("background-color","var(--primary)");	
		var ph_1 = $('#ph1').val();
		var ph_2 = $('#ph2').val();
		var ph_3 = $('#ph3').val();
		
		 var avgp = ((+ph_1) + (+ph_2) + (+ph_3))/3;
		 $('#avgp').val(avgp.toFixed(2));
		 
		
	});
	
	
	function tur_auto()
	{
		var t1 = randomNumberFromRange(39.9,40.1).toFixed(1);
		var t2 = randomNumberFromRange(39.9,40.1).toFixed(1);
		var t3 = randomNumberFromRange(39.9,40.1).toFixed(1);
		$('#t1').val(t1);
		$('#t2').val(t2);
		$('#t3').val(t3);
		
		$('#nt1').val("NIL");
		$('#nt2').val("NIL");
		$('#nt3').val("NIL");
		$('#avgtur').val("NIL");
			
	}
	
	$('#chk_tur').change(function(){
        if(this.checked)
		{  
			tur_auto();
			
		}
		else
		{
			$('#avgtur').val(null);
			$('#t1').val(null);
			$('#t2').val(null);
			$('#t3').val(null);
			$('#nt1').val(null);
			$('#nt2').val(null);
			$('#nt3').val(null);
			
			
		}
	});
	
	
	
	
	
	function pla_auto()
	{
		var pla1  = randomNumberFromRange(0.0000,0.0000).toFixed(4);
		var pla2  = randomNumberFromRange(0.0000,0.0000).toFixed(4);
		var pla3  = randomNumberFromRange(0.0000,0.0000).toFixed(4);
		$('#pla1').val(pla1);
		$('#pla2').val(pla2);
		$('#pla3').val(pla3);

		var pla_1 = $('#pla1').val();
		var pla_2 = $('#pla2').val();
		var pla_3 = $('#pla3').val();
		
		var plb1  = randomNumberFromRange(0.0000,0.0000).toFixed(4);
		var plb2  = randomNumberFromRange(0.0000,0.0000).toFixed(4);
		var plb3  = randomNumberFromRange(0.0000,0.0000).toFixed(4);
		$('#plb1').val(plb1);
		$('#plb2').val(plb2);
		$('#plb3').val(plb3);

		var plb_1 = $('#plb1').val();
		var plb_2 = $('#plb2').val();
		var plb_3 = $('#plb3').val();
		
		var plc1 = (+plb_1) - (+pla_1);
		var plc2 = (+plb_2) - (+pla_2);
		var plc3 = (+plb_3) - (+pla_3);
		
		if (isNaN(plc1)) plc1 = 0;
		if (isNaN(plc2)) plc2 = 0;
		if (isNaN(plc3)) plc3 = 0;
		
		$('#plc1').val(plc1.toFixed(4));
		$('#plc2').val(plc2.toFixed(4));
		$('#plc3').val(plc3.toFixed(4));
		
		var plc_1 = $('#plc1').val();
		var plc_2 = $('#plc2').val();
		var plc_3 = $('#plc3').val();
		
		var pld1  = randomNumberFromRange(0.0000,0.0000).toFixed(1);
		var pld2  = randomNumberFromRange(0.0000,0.0000).toFixed(1);
		var pld3  = randomNumberFromRange(0.0000,0.0000).toFixed(1);
		$('#pld1').val(pld1);
		$('#pld2').val(pld2);
		$('#pld3').val(pld3);

		var pld_1 = $('#pld1').val();
		var pld_2 = $('#pld2').val();
		var pld_3 = $('#pld3').val();
		
		var pl1 = ((+plc_1) * (+0.0141) * (+50000)) / (+pld_1);
		var pl2 = ((+plc_2) * (+0.0141) * (+50000)) / (+pld_2);
		var pl3 = ((+plc_3) * (+0.0141) * (+50000)) / (+pld_3);
		if (isNaN(pl1)) pl1 = 0;
		if (isNaN(pl2)) pl2 = 0;
		if (isNaN(pl3)) pl3 = 0;
		$('#pl1').val(pl1.toFixed(2));
		$('#pl2').val(pl2.toFixed(2));
		$('#pl3').val(pl3.toFixed(2));
		
		var pl_1 = $('#pl1').val();
		var pl_2 = $('#pl2').val();
		var pl_3 = $('#pl3').val();
		
		var avgpla = ((+pl_1) + (+pl_2) + (+pl_3))/3;
		if (isNaN(avgpla)) avgpla = 0;
		 $('#avgpla').val(avgpla.toFixed(2));
		
		
	}
	
	$('#chk_pla').change(function(){
        if(this.checked)
		{  
			pla_auto();
			
		}
		else
		{
			$('#avgpla').val(null);
			$('#pla1').val(null);
			$('#pla2').val(null);
			$('#pla3').val(null);
			$('#plb1').val(null);
			$('#plb2').val(null);
			$('#plb3').val(null);
			$('#plc1').val(null);
			$('#plc2').val(null);
			$('#plc3').val(null);
			$('#pld1').val(null);
			$('#pld2').val(null);
			$('#pld3').val(null);
			$('#pl1').val(null);
			$('#pl2').val(null);
			$('#pl3').val(null);
			
			
		}
	});
	
	
	$('#pla1,#pla2,#pla3,#plb1,#plb2,#plb3,#pld1,#pld2,#pld3').change(function(){
		$('#txtpla').css("background-color","var(--primary)");	
		
		var pla_1 = $('#pla1').val();
		var pla_2 = $('#pla2').val();
		var pla_3 = $('#pla3').val();
		
		
		var plb_1 = $('#plb1').val();
		var plb_2 = $('#plb2').val();
		var plb_3 = $('#plb3').val();
		
		var plc1 = (+plb_1) - (+pla_1);
		var plc2 = (+plb_2) - (+pla_2);
		var plc3 = (+plb_3) - (+pla_3);
		
		if (isNaN(plc1)) plc1 = 0;
		if (isNaN(plc2)) plc2 = 0;
		if (isNaN(plc3)) plc3 = 0;
		
		$('#plc1').val(plc1.toFixed(4));
		$('#plc2').val(plc2.toFixed(4));
		$('#plc3').val(plc3.toFixed(4));
		
		var plc_1 = $('#plc1').val();
		var plc_2 = $('#plc2').val();
		var plc_3 = $('#plc3').val();
		
		
		var pld_1 = $('#pld1').val();
		var pld_2 = $('#pld2').val();
		var pld_3 = $('#pld3').val();
		
		var pl1 = ((+plc_1) * (+0.0141) * (+50000)) / (+pld_1);
		var pl2 = ((+plc_2) * (+0.0141) * (+50000)) / (+pld_2);
		var pl3 = ((+plc_3) * (+0.0141) * (+50000)) / (+pld_3);
		if (isNaN(pl1)) pl1 = 0;
		if (isNaN(pl2)) pl2 = 0;
		if (isNaN(pl3)) pl3 = 0;
		$('#pl1').val(pl1.toFixed(2));
		$('#pl2').val(pl2.toFixed(2));
		$('#pl3').val(pl3.toFixed(2));
		
		var pl_1 = $('#pl1').val();
		var pl_2 = $('#pl2').val();
		var pl_3 = $('#pl3').val();
		
		var avgpla = ((+pl_1) + (+pl_2) + (+pl_3))/3;
		if (isNaN(avgpla)) avgpla = 0;
		 $('#avgpla').val(avgpla.toFixed(2));
	});
	
	
	function tla_auto()
	{
		var tla1  = randomNumberFromRange(0.1,0.1).toFixed(1);
		var tla2  = randomNumberFromRange(0.1,0.1).toFixed(1);
		var tla3  = randomNumberFromRange(0.1,0.1).toFixed(1);
		$('#tla1').val(tla1);
		$('#tla2').val(tla2);
		$('#tla3').val(tla3);

		var tla_1 = $('#tla1').val();
		var tla_2 = $('#tla2').val();
		var tla_3 = $('#tla3').val();
		
		var tlb1  = randomNumberFromRange(1.3,2.0).toFixed(1);
		var tlb2  = randomNumberFromRange(1.3,2.0).toFixed(1);
		var tlb3  = randomNumberFromRange(1.3,2.0).toFixed(1);
		$('#tlb1').val(tlb1);
		$('#tlb2').val(tlb2);
		$('#tlb3').val(tlb3);

		var tlb_1 = $('#tlb1').val();
		var tlb_2 = $('#tlb2').val();
		var tlb_3 = $('#tlb3').val();
		
		var tlc1 = (+tlb_1) - (+tla_1);
		var tlc2 = (+tlb_2) - (+tla_2);
		var tlc3 = (+tlb_3) - (+tla_3);
		
		if (isNaN(tlc1)) tlc1 = 0;
		if (isNaN(tlc2)) tlc2 = 0;
		if (isNaN(tlc3)) tlc3 = 0;
		
		$('#tlc1').val(tlc1.toFixed(1));
		$('#tlc2').val(tlc2.toFixed(1));
		$('#tlc3').val(tlc3.toFixed(1));
		
		var tlc_1 = $('#tlc1').val();
		var tlc_2 = $('#tlc2').val();
		var tlc_3 = $('#tlc3').val();
		
		var tld1  = randomNumberFromRange(25.0,25.0).toFixed(1);
		var tld2  = randomNumberFromRange(25.0,25.0).toFixed(1);
		var tld3  = randomNumberFromRange(25.0,25.0).toFixed(1);
		$('#tld1').val(tld1);
		$('#tld2').val(tld2);
		$('#tld3').val(tld3);

		var tld_1 = $('#tld1').val();
		var tld_2 = $('#tld2').val();
		var tld_3 = $('#tld3').val();
		
		var tl1 = ((+tlc_1) * (+0.0141) * (+50000)) / (+tld_1);
		var tl2 = ((+tlc_2) * (+0.0141) * (+50000)) / (+tld_2);
		var tl3 = ((+tlc_3) * (+0.0141) * (+50000)) / (+tld_3);
		if (isNaN(tl1)) tl1 = 0;
		if (isNaN(tl2)) tl2 = 0;
		if (isNaN(tl3)) tl3 = 0;
		$('#tl1').val(tl1.toFixed(2));
		$('#tl2').val(tl2.toFixed(2));
		$('#tl3').val(tl3.toFixed(2));
		
		var tl_1 = $('#tl1').val();
		var tl_2 = $('#tl2').val();
		var tl_3 = $('#tl3').val();
		
		var avgtla = ((+tl_1) + (+tl_2) + (+tl_3))/3;
		if (isNaN(avgtla)) avgtla = 0;
		 $('#avgtla').val(avgtla.toFixed(2));
		
		
	}
	
	$('#chk_tla').change(function(){
        if(this.checked)
		{  
			tla_auto();
			
		}
		else
		{
			$('#avgtla').val(null);
			$('#tla1').val(null);
			$('#tla2').val(null);
			$('#tla3').val(null);
			$('#tlb1').val(null);
			$('#tlb2').val(null);
			$('#tlb3').val(null);
			$('#tlc1').val(null);
			$('#tlc2').val(null);
			$('#tlc3').val(null);
			$('#tld1').val(null);
			$('#tld2').val(null);
			$('#tld3').val(null);
			$('#tl1').val(null);
			$('#tl2').val(null);
			$('#tl3').val(null);
			
			
		}
	});
	
	
	$('#tla1,#tla2,#tla3,#tlb1,#tlb2,#tlb3,#tld1,#tld2,#tld3').change(function(){
		$('#txttla').css("background-color","var(--primary)");	
		
		var tla_1 = $('#tla1').val();
		var tla_2 = $('#tla2').val();
		var tla_3 = $('#tla3').val();
		
		
		var tlb_1 = $('#tlb1').val();
		var tlb_2 = $('#tlb2').val();
		var tlb_3 = $('#tlb3').val();
		
		var tlc1 = (+tlb_1) - (+tla_1);
		var tlc2 = (+tlb_2) - (+tla_2);
		var tlc3 = (+tlb_3) - (+tla_3);
		
		if (isNaN(tlc1)) tlc1 = 0;
		if (isNaN(tlc2)) tlc2 = 0;
		if (isNaN(tlc3)) tlc3 = 0;
		
		$('#tlc1').val(tlc1.toFixed(1));
		$('#tlc2').val(tlc2.toFixed(1));
		$('#tlc3').val(tlc3.toFixed(1));
		
		var tlc_1 = $('#tlc1').val();
		var tlc_2 = $('#tlc2').val();
		var tlc_3 = $('#tlc3').val();
		
		
		var tld_1 = $('#tld1').val();
		var tld_2 = $('#tld2').val();
		var tld_3 = $('#tld3').val();
		
		var tl1 = ((+tlc_1) * (+0.0141) * (+50000)) / (+tld_1);
		var tl2 = ((+tlc_2) * (+0.0141) * (+50000)) / (+tld_2);
		var tl3 = ((+tlc_3) * (+0.0141) * (+50000)) / (+tld_3);
		if (isNaN(tl1)) tl1 = 0;
		if (isNaN(tl2)) tl2 = 0;
		if (isNaN(tl3)) tl3 = 0;
		$('#tl1').val(tl1.toFixed(2));
		$('#tl2').val(tl2.toFixed(2));
		$('#tl3').val(tl3.toFixed(2));
		
		var tl_1 = $('#tl1').val();
		var tl_2 = $('#tl2').val();
		var tl_3 = $('#tl3').val();
		
		var avgtla = ((+tl_1) + (+tl_2) + (+tl_3))/3;
		if (isNaN(avgtla)) avgtla = 0;
		 $('#avgtla').val(avgtla.toFixed(2));
	});
	
	
	
	function bic_auto()
	{
		
		$('#avgsample').val("PA = 0");
		$('#avghyd').val("0");
		$('#avgcar').val("0");
		$('#avgbic').val($('#avgtla').val());
			
	}
	
	$('#chk_bic').change(function(){
        if(this.checked)
		{  
			bic_auto();
			
		}
		else
		{
			$('#avgsample').val(null);
			$('#avghyd').val(null);
			$('#avgcar').val(null);
			$('#avgbic').val(null);
			
			
		}
	});
	
	
	function hrd_auto()
	{
		
		var hrcf_ = 0.9806;
		$('#hrcf').val(hrcf_);
		var hrcf = $('#hrcf').val();
		
		var hra1 = randomNumberFromRange(0.05,0.05).toFixed(2);
		var hra2 = randomNumberFromRange(0.05,0.05).toFixed(2);
		var hra3 = randomNumberFromRange(0.05,0.05).toFixed(2);
		$('#hra1').val(hra1);
		$('#hra2').val(hra2);
		$('#hra3').val(hra3);
		var hrb1 = randomNumberFromRange(2.00,3.00).toFixed(2);
		var hrb2 = randomNumberFromRange(2.00,3.00).toFixed(2);
		var hrb3 = randomNumberFromRange(2.00,3.00).toFixed(2);
		$('#hrb1').val(hrb1);
		$('#hrb2').val(hrb2);
		$('#hrb3').val(hrb3);
		
		var hra_1 = $('#hra1').val();
		var hra_2 = $('#hra2').val();				
		var hra_3 = $('#hra3').val();				
		var hrb_1 = $('#hrb1').val();
		var hrb_2 = $('#hrb2').val();
		var hrb_3 = $('#hrb3').val();
		
		
		
		var hrc1 = (+hrb_1)-(+hra_1);
		var hrc2 = (+hrb_2)-(+hra_2);
		var hrc3 = (+hrb_3)-(+hra_3);
		$('#hrc1').val(hrc1.toFixed(2));
		$('#hrc2').val(hrc2.toFixed(2));
		$('#hrc3').val(hrc3.toFixed(2));
		
		var hrc_1 = $('#hrc1').val();
		var hrc_2 = $('#hrc2').val();
		var hrc_3 = $('#hrc3').val();
		var hrd1 = randomNumberFromRange(25,25).toFixed();
		var hrd2 = randomNumberFromRange(25,25).toFixed();
		var hrd3 = randomNumberFromRange(25,25).toFixed();
		
		$('#hrd1').val(hrd1);
		$('#hrd2').val(hrd2);
		$('#hrd3').val(hrd3);
		
		
		
		
		
		var hrd_1 = $('#hrd1').val();
		var hrd_2 = $('#hrd2').val();
		var hrd_3 = $('#hrd3').val();
		
		var hr1 = ((+hrc_1) * (+hrcf) * (+1000)) / (+hrd_1);
		var hr2 = ((+hrc_2) * (+hrcf) * (+1000)) / (+hrd_2);
		var hr3 = ((+hrc_3) * (+hrcf) * (+1000)) / (+hrd_3);
		$('#hr1').val(hr1.toFixed(2));
		$('#hr2').val(hr2.toFixed(2));
		$('#hr3').val(hr3.toFixed(2));
		
		var hr_1 = $('#hr1').val();
		var hr_2 = $('#hr2').val();
		var hr_3 = $('#hr3').val();
		
		var avghr = ((+hr_1) + (+hr_2)+ (+hr_3))  / 3;
		$('#avghr').val(avghr.toFixed(2));
		
			
	}
	
	$('#chk_hrd').change(function(){
        if(this.checked)
		{  
			hrd_auto();
			
		}
		else
		{
			$('#hra1').val(null);
			$('#hra2').val(null);
			$('#hra3').val(null);
			$('#hrb1').val(null);
			$('#hrb2').val(null);
			$('#hrb3').val(null);
			$('#hrc1').val(null);
			$('#hrc2').val(null);
			$('#hrc3').val(null);
			$('#hrd1').val(null);
			$('#hrd2').val(null);
			$('#hrd3').val(null);
			$('#hr1').val(null);
			$('#hr2').val(null);
			$('#hr3').val(null);
			
			$('#avghr').val(null);
			$('#hrcf').val(null);
			
			
			
		}
	});
	
	
	
	$('#hra1,#hra2,#hra3,#hrb1,#hrb2,#hrb3,#hrd1,#hrd2,#hrd3,#hrcf').change(function(){
		$('#txthrd').css("background-color","var(--primary)");	
		
		var hrcf = $('#hrcf').val();
		
		
		var hra_1 = $('#hra1').val();
		var hra_2 = $('#hra2').val();				
		var hra_3 = $('#hra3').val();				
		var hrb_1 = $('#hrb1').val();
		var hrb_2 = $('#hrb2').val();
		var hrb_3 = $('#hrb3').val();
		
		
		
		var hrc1 = (+hrb_1)-(+hra_1);
		var hrc2 = (+hrb_2)-(+hra_2);
		var hrc3 = (+hrb_3)-(+hra_3);
		$('#hrc1').val(hrc1.toFixed(2));
		$('#hrc2').val(hrc2.toFixed(2));
		$('#hrc3').val(hrc3.toFixed(2));
		
		var hrc_1 = $('#hrc1').val();
		var hrc_2 = $('#hrc2').val();
		var hrc_3 = $('#hrc3').val();
		
		var hrd_1 = $('#hrd1').val();
		var hrd_2 = $('#hrd2').val();
		var hrd_3 = $('#hrd3').val();
		
		var hr1 = ((+hrc_1) * (+hrcf) * (+1000)) / (+hrd_1);
		var hr2 = ((+hrc_2) * (+hrcf) * (+1000)) / (+hrd_2);
		var hr3 = ((+hrc_3) * (+hrcf) * (+1000)) / (+hrd_3);
		$('#hr1').val(hr1.toFixed(2));
		$('#hr2').val(hr2.toFixed(2));
		$('#hr3').val(hr3.toFixed(2));
		
		var hr_1 = $('#hr1').val();
		var hr_2 = $('#hr2').val();
		var hr_3 = $('#hr3').val();
		
		var avghr = ((+hr_1) + (+hr_2)+ (+hr_3))  / 3;
		$('#avghr').val(avghr.toFixed(2));
		
	});
	
	
	function cal_auto()
	{
		
		
		
		var caa1 = randomNumberFromRange(0.05,0.05).toFixed(2);
		var caa2 = randomNumberFromRange(0.05,0.05).toFixed(2);
		var caa3 = randomNumberFromRange(0.05,0.05).toFixed(2);
		$('#caa1').val(caa1);
		$('#caa2').val(caa2);
		$('#caa3').val(caa3);
		var cab1 = randomNumberFromRange(1.00,1.20).toFixed(2);
		var cab2 = randomNumberFromRange(1.00,1.20).toFixed(2);
		var cab3 = randomNumberFromRange(1.00,1.20).toFixed(2);
		$('#cab1').val(cab1);
		$('#cab2').val(cab2);
		$('#cab3').val(cab3);
		
		var caa_1 = $('#caa1').val();
		var caa_2 = $('#caa2').val();				
		var caa_3 = $('#caa3').val();				
		var cab_1 = $('#cab1').val();
		var cab_2 = $('#cab2').val();
		var cab_3 = $('#cab3').val();
		
		
		
		var cac1 = (+cab_1)-(+caa_1);
		var cac2 = (+cab_2)-(+caa_2);
		var cac3 = (+cab_3)-(+caa_3);
		$('#cac1').val(cac1.toFixed(2));
		$('#cac2').val(cac2.toFixed(2));
		$('#cac3').val(cac3.toFixed(2));
		
		var cac_1 = $('#cac1').val();
		var cac_2 = $('#cac2').val();
		var cac_3 = $('#cac3').val();
		var cad1 = randomNumberFromRange(25,25).toFixed();
		var cad2 = randomNumberFromRange(25,25).toFixed();
		var cad3 = randomNumberFromRange(25,25).toFixed();
		
		$('#cad1').val(cad1);
		$('#cad2').val(cad2);
		$('#cad3').val(cad3);
		
		
		
		
		
		var cad_1 = $('#cad1').val();
		var cad_2 = $('#cad2').val();
		var cad_3 = $('#cad3').val();
		
		var ca1 = ((+cac_1) * (+0.40078) * (+1000)) / (+cad_1);
		var ca2 = ((+cac_2) * (+0.40078) * (+1000)) / (+cad_2);
		var ca3 = ((+cac_3) * (+0.40078) * (+1000)) / (+cad_3);
		$('#ca1').val(ca1.toFixed(2));
		$('#ca2').val(ca2.toFixed(2));
		$('#ca3').val(ca3.toFixed(2));
		
		var ca_1 = $('#ca1').val();
		var ca_2 = $('#ca2').val();
		var ca_3 = $('#ca3').val();
		
		var avgca = ((+ca_1) + (+ca_2)+ (+ca_3))  / 3;
		$('#avgca').val(avgca.toFixed(2));
		
			
	}
	
	$('#chk_cal').change(function(){
        if(this.checked)
		{  
			cal_auto();
			
		}
		else
		{
			$('#caa1').val(null);
			$('#caa2').val(null);
			$('#caa3').val(null);
			$('#cab1').val(null);
			$('#cab2').val(null);
			$('#cab3').val(null);
			$('#cac1').val(null);
			$('#cac2').val(null);
			$('#cac3').val(null);
			$('#cad1').val(null);
			$('#cad2').val(null);
			$('#cad3').val(null);
			$('#ca1').val(null);
			$('#ca2').val(null);
			$('#ca3').val(null);
			
			$('#avgca').val(null);
		
			
			
			
		}
	});
	
	
	
	$('#caa1,#caa2,#caa3,#cab1,#cab2,#cab3,#cad1,#cad2,#cad3').change(function(){
		$('#txtcal').css("background-color","var(--primary)");	
		
	
		
		
		var caa_1 = $('#caa1').val();
		var caa_2 = $('#caa2').val();				
		var caa_3 = $('#caa3').val();				
		var cab_1 = $('#cab1').val();
		var cab_2 = $('#cab2').val();
		var cab_3 = $('#cab3').val();
		
		
		
		var cac1 = (+cab_1)-(+caa_1);
		var cac2 = (+cab_2)-(+caa_2);
		var cac3 = (+cab_3)-(+caa_3);
		$('#cac1').val(cac1.toFixed(2));
		$('#cac2').val(cac2.toFixed(2));
		$('#cac3').val(cac3.toFixed(2));
		
		var cac_1 = $('#cac1').val();
		var cac_2 = $('#cac2').val();
		var cac_3 = $('#cac3').val();
		
		var cad_1 = $('#cad1').val();
		var cad_2 = $('#cad2').val();
		var cad_3 = $('#cad3').val();
		
		var ca1 = ((+cac_1) * (+0.40078) * (+1000)) / (+cad_1);
		var ca2 = ((+cac_2) * (+0.40078) * (+1000)) / (+cad_2);
		var ca3 = ((+cac_3) * (+0.40078) * (+1000)) / (+cad_3);
		$('#ca1').val(ca1.toFixed(2));
		$('#ca2').val(ca2.toFixed(2));
		$('#ca3').val(ca3.toFixed(2));
		
		var ca_1 = $('#ca1').val();
		var ca_2 = $('#ca2').val();
		var ca_3 = $('#ca3').val();
		
		var avgca = ((+ca_1) + (+ca_2)+ (+ca_3))  / 3;
		$('#avgca').val(avgca.toFixed(2));
		
	});
	
	
	function mag_auto()
	{
		
		
		var totalhard = $('#hrc1').val();
		var totalcal = $('#cac1').val();
		
		var calcu = (+totalhard) - (+totalcal);
		var finalca = ((+calcu) * (+0.02435) * (+1000)) / (+25);
		$('#avgmag').val(finalca.toFixed(2));
		
			
	}
	
	$('#chk_mag').change(function(){
        if(this.checked)
		{  
			mag_auto();
			
		}
		else
		{
			$('#avgmag').val(null);
			
		}
	});
	
	function chl_auto()
	{
		
		
		
		var cha1 = randomNumberFromRange(0.10,0.10).toFixed(1);
		var cha2 = randomNumberFromRange(0.10,0.10).toFixed(1);
		var cha3 = randomNumberFromRange(0.10,0.10).toFixed(1);
		$('#cha1').val(cha1);
		$('#cha2').val(cha2);
		$('#cha3').val(cha3);
		var chb1 = randomNumberFromRange(2.50,2.80).toFixed(1);
		var chb2 = randomNumberFromRange(2.50,2.80).toFixed(1);
		var chb3 = randomNumberFromRange(2.50,2.80).toFixed(1);
		$('#chb1').val(chb1);
		$('#chb2').val(chb2);
		$('#chb3').val(chb3);
		
		var cha_1 = $('#cha1').val();
		var cha_2 = $('#cha2').val();				
		var cha_3 = $('#cha3').val();				
		var chb_1 = $('#chb1').val();
		var chb_2 = $('#chb2').val();
		var chb_3 = $('#chb3').val();
		
		
		
		var chc1 = (+chb_1)-(+cha_1);
		var chc2 = (+chb_2)-(+cha_2);
		var chc3 = (+chb_3)-(+cha_3);
		$('#chc1').val(chc1.toFixed(1));
		$('#chc2').val(chc2.toFixed(1));
		$('#chc3').val(chc3.toFixed(1));
		
		var chc_1 = $('#chc1').val();
		var chc_2 = $('#chc2').val();
		var chc_3 = $('#chc3').val();
		var chd1 = randomNumberFromRange(25,25).toFixed();
		var chd2 = randomNumberFromRange(25,25).toFixed();
		var chd3 = randomNumberFromRange(25,25).toFixed();
		
		$('#chd1').val(chd1);
		$('#chd2').val(chd2);
		$('#chd3').val(chd3);
		
		
		
		
		
		var chd_1 = $('#chd1').val();
		var chd_2 = $('#chd2').val();
		var chd_3 = $('#chd3').val();
		
		var ch1 = ((+chc_1) * (+0.01382) * (+35450)) / (+chd_1);
		var ch2 = ((+chc_2) * (+0.01382) * (+35450)) / (+chd_2);
		var ch3 = ((+chc_3) * (+0.01382) * (+35450)) / (+chd_3);
		$('#ch1').val(ch1.toFixed(2));
		$('#ch2').val(ch2.toFixed(2));
		$('#ch3').val(ch3.toFixed(2));
		
		var ch_1 = $('#ch1').val();
		var ch_2 = $('#ch2').val();
		var ch_3 = $('#ch3').val();
		
		var avgch = ((+ch_1) + (+ch_2)+ (+ch_3))  / 3;
		$('#avgch').val(avgch.toFixed(2));
		
			
	}
	
	$('#chk_chl').change(function(){
        if(this.checked)
		{  
			chl_auto();
			
		}
		else
		{
			$('#cha1').val(null);
			$('#cha2').val(null);
			$('#cha3').val(null);
			$('#chb1').val(null);
			$('#chb2').val(null);
			$('#chb3').val(null);
			$('#chc1').val(null);
			$('#chc2').val(null);
			$('#chc3').val(null);
			$('#chd1').val(null);
			$('#chd2').val(null);
			$('#chd3').val(null);
			$('#ch1').val(null);
			$('#ch2').val(null);
			$('#ch3').val(null);
			
			$('#avgch').val(null);
		
			
			
			
		}
	});
	
	
	
	$('#cha1,#cha2,#cha3,#chb1,#chb2,#chb3,#chd1,#chd2,#chd3').change(function(){
		$('#txtchl').css("background-color","#3chF35");	
		
	
		
		
		var cha_1 = $('#cha1').val();
		var cha_2 = $('#cha2').val();				
		var cha_3 = $('#cha3').val();				
		var chb_1 = $('#chb1').val();
		var chb_2 = $('#chb2').val();
		var chb_3 = $('#chb3').val();
		
		
		
		var chc1 = (+chb_1)-(+cha_1);
		var chc2 = (+chb_2)-(+cha_2);
		var chc3 = (+chb_3)-(+cha_3);
		$('#chc1').val(chc1.toFixed(1));
		$('#chc2').val(chc2.toFixed(1));
		$('#chc3').val(chc3.toFixed(1));
		
		var chc_1 = $('#chc1').val();
		var chc_2 = $('#chc2').val();
		var chc_3 = $('#chc3').val();
		
		var chd_1 = $('#chd1').val();
		var chd_2 = $('#chd2').val();
		var chd_3 = $('#chd3').val();
		
		var ch1 = ((+chc_1) * (+0.01382) * (+35450)) / (+chd_1);
		var ch2 = ((+chc_2) * (+0.01382) * (+35450)) / (+chd_2);
		var ch3 = ((+chc_3) * (+0.01382) * (+35450)) / (+chd_3);
		$('#ch1').val(ch1.toFixed(2));
		$('#ch2').val(ch2.toFixed(2));
		$('#ch3').val(ch3.toFixed(2));
		
		var ch_1 = $('#ch1').val();
		var ch_2 = $('#ch2').val();
		var ch_3 = $('#ch3').val();
		
		var avgch = ((+ch_1) + (+ch_2)+ (+ch_3))  / 3;
		$('#avgch').val(avgch.toFixed(2));
		
	});
	
	
	
	function sul_auto()
	{
		
		var sua1 = randomNumberFromRange(32.9894,32.9898).toFixed(4);
		var sua2 = randomNumberFromRange(32.9894,32.9898).toFixed(4);
		var sua3 = randomNumberFromRange(32.9894,32.9898).toFixed(4);
		$('#sua1').val(sua1);
		$('#sua2').val(sua2);
		$('#sua3').val(sua3);
		
		var sua_1 = $('#sua1').val();
		var sua_2 = $('#sua2').val();
		var sua_3 = $('#sua3').val();
		
		var sub1 = randomNumberFromRange(32.9985,32.9989).toFixed(4);
		var sub2 = randomNumberFromRange(32.9985,32.9989).toFixed(4);
		var sub3 = randomNumberFromRange(32.9985,32.9989).toFixed(4);
		$('#sub1').val(sub1);
		$('#sub2').val(sub2);
		$('#sub3').val(sub3);
		
		var sub_1 = $('#sub1').val();
		var sub_2 = $('#sub2').val();
		var sub_3 = $('#sub3').val();
		
		
		var suc1 = (+sub_1) - (+sua_1);
		var suc2 = (+sub_2) - (+sua_2);
		var suc3 = (+sub_3) - (+sua_3);
		$('#suc1').val(suc1.toFixed(4));
		$('#suc2').val(suc2.toFixed(4));
		$('#suc3').val(suc3.toFixed(4));
		
		var suc_1 = $('#suc1').val();
		var suc_2 = $('#suc2').val();
		var suc_3 = $('#suc3').val();
		
		var sud1 = randomNumberFromRange(150,150).toFixed();
		var sud2 = randomNumberFromRange(150,150).toFixed();
		var sud3 = randomNumberFromRange(150,150).toFixed();
		$('#sud1').val(sud1);
		$('#sud2').val(sud2);
		$('#sud3').val(sud3);
		
		var sud_1 = $('#sud1').val();
		var sud_2 = $('#sud2').val();
		var sud_3 = $('#sud3').val();
		
		var su1 = ((+suc_1) * (+411500)) / (+sud_1);
		var su2 = ((+suc_2) * (+411500)) / (+sud_2);
		var su3 = ((+suc_3) * (+411500)) / (+sud_3);
		$('#su1').val(su1.toFixed(2));
		$('#su2').val(su2.toFixed(2));
		$('#su3').val(su3.toFixed(2));
		
		var su_1 = $('#su1').val();
		var su_2 = $('#su2').val();
		var su_3 = $('#su3').val();
		
		var avgsu = ((+su_1) + (+su_2)+ (+su_3))  / 3;
		$('#avgsu').val(avgsu.toFixed(2));
		
			
	}
	
	$('#chk_sul').change(function(){
        if(this.checked)
		{  
			sul_auto();
			
		}
		else
		{
			$('#sua1').val(null);
			$('#sua2').val(null);
			$('#sua3').val(null);
			$('#sub1').val(null);
			$('#sub2').val(null);
			$('#sub3').val(null);
			$('#suc1').val(null);
			$('#suc2').val(null);
			$('#suc3').val(null);
			$('#sud1').val(null);
			$('#sud2').val(null);
			$('#sud3').val(null);
			$('#su1').val(null);
			$('#su2').val(null);
			$('#su3').val(null);
			
			$('#avgsu').val(null);
			
			
		}
	});
	
	
	
	$('#sua1,#sua2,#sua3,#sub1,#sub2,#sub3,#sud1,#sud2,#sud3').change(function(){
		$('#txtsul').css("background-color","var(--primary)");	
		
		
		var sua_1 = $('#sua1').val();
		var sua_2 = $('#sua2').val();
		var sua_2 = $('#sua2').val();
		
		
		var sub_1 = $('#sub1').val();
		var sub_2 = $('#sub2').val();
		var sub_2 = $('#sub2').val();
		
		
		var suc1 = (+sub_1) - (+sua_1);
		var suc2 = (+sub_2) - (+sua_2);
		var suc2 = (+sub_2) - (+sua_2);
		$('#suc1').val(suc1.toFixed(4));
		$('#suc2').val(suc2.toFixed(4));
		$('#suc2').val(suc2.toFixed(4));
		
		var suc_1 = $('#suc1').val();
		var suc_2 = $('#suc2').val();
		var suc_2 = $('#suc2').val();
		
		
		var sud_1 = $('#sud1').val();
		var sud_2 = $('#sud2').val();
		var sud_2 = $('#sud2').val();
		
		var su1 = ((+suc_1) * (+411500)) / (+sud_1);
		var su2 = ((+suc_2) * (+411500)) / (+sud_2);
		var su2 = ((+suc_2) * (+411500)) / (+sud_2);
		$('#su1').val(su1.toFixed(2));
		$('#su2').val(su2.toFixed(2));
		$('#su2').val(su2.toFixed(2));
		
		var su_1 = $('#su1').val();
		var su_2 = $('#su2').val();
		var su_2 = $('#su2').val();
		
		var avgsu = ((+su_1) + (+su_2)+ (+su_3))  / 3;
		$('#avgsu').val(avgsu.toFixed(2));
		
	});
	
	

	function tds_auto()
	{
		
		var tda1 = randomNumberFromRange(31.3958,31.3962).toFixed(4);
		var tda2 = randomNumberFromRange(31.3958,31.3962).toFixed(4);
		var tda3 = randomNumberFromRange(31.3958,31.3962).toFixed(4);
		$('#tda1').val(tda1);
		$('#tda2').val(tda2);
		$('#tda3').val(tda3);
		
		var tda_1 = $('#tda1').val();
		var tda_2 = $('#tda2').val();
		var tda_3 = $('#tda3').val();
		
		var tdb1 = randomNumberFromRange(31.3989,31.3993).toFixed(4);
		var tdb2 = randomNumberFromRange(31.3989,31.3993).toFixed(4);
		var tdb3 = randomNumberFromRange(31.3989,31.3993).toFixed(4);
		$('#tdb1').val(tdb1);
		$('#tdb2').val(tdb2);
		$('#tdb3').val(tdb3);
		
		var tdb_1 = $('#tdb1').val();
		var tdb_2 = $('#tdb2').val();
		var tdb_3 = $('#tdb3').val();
		
		
		var tdc1 = (+tdb_1) - (+tda_1);
		var tdc2 = (+tdb_2) - (+tda_2);
		var tdc3 = (+tdb_3) - (+tda_3);
		$('#tdc1').val(tdc1.toFixed(4));
		$('#tdc2').val(tdc2.toFixed(4));
		$('#tdc3').val(tdc3.toFixed(4));
		
		var tdc_1 = $('#tdc1').val();
		var tdc_2 = $('#tdc2').val();
		var tdc_3 = $('#tdc3').val();
		
		var tdd1 = randomNumberFromRange(25,25).toFixed();
		var tdd2 = randomNumberFromRange(25,25).toFixed();
		var tdd3 = randomNumberFromRange(25,25).toFixed();
		$('#tdd1').val(tdd1);
		$('#tdd2').val(tdd2);
		$('#tdd3').val(tdd3);
		
		var tdd_1 = $('#tdd1').val();
		var tdd_2 = $('#tdd2').val();
		var tdd_3 = $('#tdd3').val();
		
		var td1 = ((+tdc_1) * (+1000) * (+1000)) / (+tdd_1);
		var td2 = ((+tdc_2) * (+1000) * (+1000)) / (+tdd_2);
		var td3 = ((+tdc_3) * (+1000) * (+1000)) / (+tdd_3);
		$('#td1').val(td1.toFixed());
		$('#td2').val(td2.toFixed());
		$('#td3').val(td3.toFixed());
		
		var td_1 = $('#td1').val();
		var td_2 = $('#td2').val();
		var td_3 = $('#td3').val();
		
		var avgtd = ((+td_1) + (+td_2)+ (+td_3))  / 3;
		$('#avgtd').val(avgtd.toFixed());
		
			
	}
	
	$('#chk_tds').change(function(){
        if(this.checked)
		{  
			tds_auto();
			
		}
		else
		{
			$('#tda1').val(null);
			$('#tda2').val(null);
			$('#tda3').val(null);
			$('#tdb1').val(null);
			$('#tdb2').val(null);
			$('#tdb3').val(null);
			$('#tdc1').val(null);
			$('#tdc2').val(null);
			$('#tdc3').val(null);
			$('#tdd1').val(null);
			$('#tdd2').val(null);
			$('#tdd3').val(null);
			$('#td1').val(null);
			$('#td2').val(null);
			$('#td3').val(null);
			
			$('#avgtd').val(null);
			
			
			
		}
	});
	
	
	
	$('#tda1,#tda2#tda3,#tdb1,#tdb2,#tdb3,#tdd1,#tdd2,#tdd3').change(function(){
		$('#txttds').css("background-color","var(--primary)");	
		
		var tda_1 = $('#tda1').val();
		var tda_2 = $('#tda2').val();
		var tda_3 = $('#tda3').val();
		
		
		var tdb_1 = $('#tdb1').val();
		var tdb_2 = $('#tdb2').val();
		var tdb_3 = $('#tdb3').val();
		
		
		var tdc1 = (+tdb_1) - (+tda_1);
		var tdc2 = (+tdb_2) - (+tda_2);
		var tdc3 = (+tdb_3) - (+tda_3);
		$('#tdc1').val(tdc1.toFixed(4));
		$('#tdc2').val(tdc2.toFixed(4));
		$('#tdc3').val(tdc3.toFixed(4));
		
		var tdc_1 = $('#tdc1').val();
		var tdc_2 = $('#tdc2').val();
		var tdc_3 = $('#tdc3').val();
		
		
		var tdd_1 = $('#tdd1').val();
		var tdd_2 = $('#tdd2').val();
		var tdd_3 = $('#tdd3').val();
		
		var td1 = ((+tdc_1) * (+1000) * (+1000)) / (+tdd_1);
		var td2 = ((+tdc_2) * (+1000) * (+1000)) / (+tdd_2);
		var td3 = ((+tdc_3) * (+1000) * (+1000)) / (+tdd_3);
		$('#td1').val(td1.toFixed());
		$('#td2').val(td2.toFixed());
		$('#td3').val(td3.toFixed());
		
		var td_1 = $('#td1').val();
		var td_2 = $('#td2').val();
		var td_3 = $('#td3').val();
		
		var avgtd = ((+td_1) + (+td_2) + (+td_3))  / 3;
		$('#avgtd').val(avgtd.toFixed());
		
	});
	
	
	
	
	function con_auto()
	{
		
		var con1 = randomNumberFromRange(1413,1413).toFixed();
		var con2 = randomNumberFromRange(1413,1413).toFixed();
		var con3 = randomNumberFromRange(1413,1413).toFixed();
		$('#con1').val(con1);
		$('#con2').val(con2);
		$('#con3').val(con3);
		
		
		
		var cos1 = randomNumberFromRange(0.05,1.00).toFixed(2);
		var cos2 = randomNumberFromRange(0.05,1.00).toFixed(2);
		var cos3 = randomNumberFromRange(0.05,1.00).toFixed(2);
		$('#cos1').val(cos1);
		$('#cos2').val(cos2);
		$('#cos3').val(cos3);
		
		var cos_1 = $('#cos1').val();
		var cos_2 = $('#cos2').val();
		var cos_3 = $('#cos3').val();
		
		var avgcon = ((+cos_1) + (+cos_2)+ (+cos_3))  / 3;
		$('#avgcon').val(avgcon.toFixed(2));
		
			
	}
	
	$('#chk_con').change(function(){
        if(this.checked)
		{  
			con_auto();
			
		}
		else
		{
			$('#con1').val(null);
			$('#con2').val(null);
			$('#con3').val(null);
			$('#cos1').val(null);
			$('#cos2').val(null);
			$('#cos3').val(null);
			
			
			$('#avgcon').val(null);
			
			
			
		}
	});
	
	
	
	$('#cos1,#cos2,#cos3').change(function(){
		$('#txtcon').css("background-color","var(--primary)");	
		
		var cos_1 = $('#cos1').val();
		var cos_2 = $('#cos2').val();
		var cos_3 = $('#cos3').val();
		
		var avgcon = ((+cos_1) + (+cos_2)+ (+cos_3))  / 3;
		$('#avgcon').val(avgcon.toFixed(2));
		
	});
	
	
	
	
	function col_auto()
	{
		var avgcol = randomNumberFromRange(5,14).toFixed();
		$('#avgcol').val(avgcol);
	}
	
	$('#chk_col').change(function(){
        if(this.checked)
		{  
			col_auto();	
		}
		else
		{
			$('#avgcol').val(null);
		}
	});
	
	function tas_auto()
	{
		var avgtas = "Agreeable";
		$('#avgtas').val(avgtas);
	}
	
	$('#chk_tas').change(function(){
        if(this.checked)
		{  
			tas_auto();	
		}
		else
		{
			$('#avgtas').val(null);
		}
	});
	
	function odo_auto()
	{
		var avgodo = "Agreeable";
		$('#avgodo').val(avgodo);
	}
	
	$('#chk_odo').change(function(){
        if(this.checked)
		{  
			odo_auto();	
		}
		else
		{
			$('#avgodo').val(null);
		}
	});
	
	function ins_auto()
	{
		var avgins = "-";
		$('#avgins').val(avgins);
	}
	
	$('#chk_ins').change(function(){
        if(this.checked)
		{  
			ins_auto();	
		}
		else
		{
			$('#avgins').val(null);
		}
	});
	
	function spg_auto()
	{
		var avgspg = randomNumberFromRange(1.00,1.02).toFixed(2);
		$('#avgspg').val(avgspg);
	}
	
	$('#chk_spg').change(function(){
        if(this.checked)
		{  
			spg_auto();	
		}
		else
		{
			$('#avgspg').val(null);
		}
	});
	
	function alu_auto()
	{
		var avgalu = randomNumberFromRange(0.05,1.00).toFixed(2);
		$('#avgalu').val(avgalu);
	}
	
	$('#chk_alu').change(function(){
        if(this.checked)
		{  
			alu_auto();	
		}
		else
		{
			$('#avgalu').val(null);
		}
	});
	
	function amm_auto()
	{
		var avgamm = randomNumberFromRange(0.10,0.25).toFixed(2);
		$('#avgamm').val(avgamm);
	}
	
	$('#chk_amm').change(function(){
        if(this.checked)
		{  
			amm_auto();	
		}
		else
		{
			$('#avgamm').val(null);
		}
	});
	
	function ani_auto()
	{
		var avgani = randomNumberFromRange(0.05,0.20).toFixed(2);
		$('#avgani').val(avgani);
	}
	
	$('#chk_ani').change(function(){
        if(this.checked)
		{  
			ani_auto();	
		}
		else
		{
			$('#avgani').val(null);
		}
	});
	
	function bar_auto()
	{
		var avgbar = randomNumberFromRange(0.05,0.50).toFixed(1);
		$('#avgbar').val(avgbar);
	}
	
	$('#chk_bar').change(function(){
        if(this.checked)
		{  
			bar_auto();	
		}
		else
		{
			$('#avgbar').val(null);
		}
	});
	
	function bor_auto()
	{
		var avgbor = randomNumberFromRange(0.1,0.3).toFixed(1);
		$('#avgbor').val(avgbor);
	}
	
	$('#chk_bor').change(function(){
        if(this.checked)
		{  
			bor_auto();	
		}
		else
		{
			$('#avgbor').val(null);
		}
	});
	
	function cra_auto()
	{
		var avgcra = randomNumberFromRange(0.2,2.0).toFixed(1);
		$('#avgcra').val(avgcra);
	}
	
	$('#chk_cra').change(function(){
        if(this.checked)
		{  
			cra_auto();	
		}
		else
		{
			$('#avgcra').val(null);
		}
	});
	
	function flu_auto()
	{
		var avgflu = randomNumberFromRange(0.0,0.5).toFixed(1);
		$('#avgflu').val(avgflu);
	}
	
	$('#chk_flu').change(function(){
        if(this.checked)
		{  
			flu_auto();	
		}
		else
		{
			$('#avgflu').val(null);
		}
	});
	
	function frc_auto()
	{
		var avgfrc = randomNumberFromRange(0.5,0.7).toFixed(1);
		$('#avgfrc').val(avgfrc);
	}
	
	$('#chk_frc').change(function(){
        if(this.checked)
		{  
			frc_auto();	
		}
		else
		{
			$('#avgfrc').val(null);
		}
	});
	
	function iro_auto()
	{
		var avgiro = randomNumberFromRange(0.0,0.1).toFixed(1);
		$('#avgiro').val(avgiro);
	}
	
	$('#chk_iro').change(function(){
        if(this.checked)
		{  
			iro_auto();	
		}
		else
		{
			$('#avgiro').val(null);
		}
	});
	
	function man_auto()
	{
		var avgman = randomNumberFromRange(0.0,0.2).toFixed(1);
		$('#avgman').val(avgman);
	}
	
	$('#chk_man').change(function(){
        if(this.checked)
		{  
			man_auto();	
		}
		else
		{
			$('#avgman').val(null);
		}
	});
	
	function min_auto()
	{
		var avgmin = randomNumberFromRange(0.0,0.3).toFixed(1);
		$('#avgmin').val(avgmin);
	}
	
	$('#chk_min').change(function(){
        if(this.checked)
		{  
			min_auto();	
		}
		else
		{
			$('#avgmin').val(null);
		}
	});
	
	function nit_auto()
	{
		var avgnit = randomNumberFromRange(5,10).toFixed();
		$('#avgnit').val(avgnit);
	}
	
	$('#chk_nit').change(function(){
        if(this.checked)
		{  
			nit_auto();	
		}
		else
		{
			$('#avgnit').val(null);
		}
	});
	
	function phe_auto()
	{
		var avgphe = randomNumberFromRange(0.000,0.001).toFixed(3);
		$('#avgphe').val(avgphe);
	}
	
	$('#chk_phe').change(function(){
        if(this.checked)
		{  
			phe_auto();	
		}
		else
		{
			$('#avgphe').val(null);
		}
	});
	
	function sel_auto()
	{
		var avgsel = randomNumberFromRange(0.000,0.005).toFixed(3);
		$('#avgsel').val(avgsel);
	}
	
	$('#chk_sel').change(function(){
        if(this.checked)
		{  
			sel_auto();	
		}
		else
		{
			$('#avgsel').val(null);
		}
	});
	
	function sil_auto()
	{
		var avgsil = randomNumberFromRange(0.000,0.005).toFixed(3);
		$('#avgsil').val(avgsil);
	}
	
	$('#chk_sil').change(function(){
        if(this.checked)
		{  
			sil_auto();	
		}
		else
		{
			$('#avgsil').val(null);
		}
	});
	
	function spd_auto()
	{
		var avgspd = randomNumberFromRange(0.00,0.01).toFixed(2);
		$('#avgspd').val(avgspd);
	}
	
	$('#chk_spd').change(function(){
        if(this.checked)
		{  
			spd_auto();	
		}
		else
		{
			$('#avgspd').val(null);
		}
	});
	
	function zin_auto()
	{
		var avgzin = randomNumberFromRange(0,5).toFixed();
		$('#avgzin').val(avgzin);
	}
	
	$('#chk_zin').change(function(){
        if(this.checked)
		{  
			zin_auto();	
		}
		else
		{
			$('#avgzin').val(null);
		}
	});
	
	function cop_auto()
	{
		var avgcop = randomNumberFromRange(0.01,0.03).toFixed(2);
		$('#avgcop').val(avgcop);
	}
	
	$('#chk_cop').change(function(){
        if(this.checked)
		{  
			cop_auto();	
		}
		else
		{
			$('#avgcop').val(null);
		}
	});
	
	function lea_auto()
	{
		var avglea = randomNumberFromRange(0.005,0.007).toFixed(3);
		$('#avglea').val(avglea);
	}
	
	$('#chk_lea').change(function(){
        if(this.checked)
		{  
			lea_auto();	
		}
		else
		{
			$('#avglea').val(null);
		}
	});
	
	function cyn_auto()
	{
		var avgcyn = randomNumberFromRange(0.001,0.011).toFixed(3);
		$('#avgcyn').val(avgcyn);
	}
	
	$('#chk_cyn').change(function(){
        if(this.checked)
		{  
			cyn_auto();	
		}
		else
		{
			$('#avgcyn').val(null);
		}
	});
	
	function tot_auto()
	{
		var avgtot = randomNumberFromRange(0.001,0.005).toFixed(3);
		$('#avgtot').val(avgtot);
	}
	
	$('#chk_tot').change(function(){
        if(this.checked)
		{  
			tot_auto();	
		}
		else
		{
			$('#avgtot').val(null);
		}
	});
	
	function cad_auto()
	{
		var avgcad = randomNumberFromRange(0.005,0.007).toFixed(3);
		$('#avgcad').val(avgcad);
	}
	
	$('#chk_cad').change(function(){
        if(this.checked)
		{  
			cad_auto();	
		}
		else
		{
			$('#avgcad').val(null);
		}
	});
	
	function bec_auto()
	{
		var avgbec = "Absent";
		$('#avgbec').val(avgbec);
	}
	
	$('#chk_bec').change(function(){
        if(this.checked)
		{  
			bec_auto();	
		}
		else
		{
			$('#avgbec').val(null);
		}
	});
	
	function eco_auto()
	{
		var avgeco = "Absent";
		$('#avgeco').val(avgeco);
	}
	
	$('#chk_eco').change(function(){
        if(this.checked)
		{  
			eco_auto();	
		}
		else
		{
			$('#avgeco').val(null);
		}
	});
	
	
	
	
	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","var(--primary)"); 
			//$('#txtwtr').css("background-color","var(--primary)"); 
			
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				
				//phv
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phv")
					{
						$('#txtphv').css("background-color","var(--primary)");
						$("#chk_phv").prop("checked", true); 
						phv_auto();
						break;
					}					
				}
				
				//tur
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tur")
					{
						$('#txttur').css("background-color","var(--primary)");
						$("#chk_tur").prop("checked", true); 
						 tur_auto()
						break;
					}					
				}
		
				//pla
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pla")
					{
						$('#txtpla').css("background-color","var(--primary)");	
						$("#chk_pla").prop("checked", true); 
						pla_auto();
						break;
					}					
				}
				
				//tla
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tla")
					{
						$('#txttla').css("background-color","var(--primary)"); 
						$("#chk_tla").prop("checked", true); 
						tla_auto();
						break;
					}					
				}
				
				//bic
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bic")
					{
						$('#txtbic').css("background-color","var(--primary)"); 
						$("#chk_bic").prop("checked", true); 
						bic_auto();
						break;
					}					
				}
			
				//hrd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="hrd")
					{
						$('#txthrd').css("background-color","var(--primary)"); 
						$("#chk_hrd").prop("checked", true); 
						hrd_auto();
						break;
					}					
				}
				
				//cal
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cal")
					{
						$('#txtcal').css("background-color","var(--primary)"); 
						$("#chk_cal").prop("checked", true); 
						cal_auto();
						break;
					}					
				}
				
				//mag
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mag")
					{
						$('#txtmag').css("background-color","var(--primary)"); 
						$("#chk_mag").prop("checked", true); 
						mag_auto();
						break;
					}					
				}
				
				//chl
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="chl")
					{
						$('#txtchl').css("background-color","var(--primary)"); 
						$("#chk_chl").prop("checked", true); 
						chl_auto();
						break;
					}					
				}
				
				//sul
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sul")
					{
						$('#txtsul').css("background-color","var(--primary)"); 
						$("#chk_sul").prop("checked", true); 
						sul_auto();
						break;
					}					
				}
				
				//tds
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tds")
					{
						$('#txttds').css("background-color","var(--primary)"); 
						$("#chk_tds").prop("checked", true); 
						tds_auto();
						break;
					}					
				}
				
				//con
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="con")
					{
						$('#txtcon').css("background-color","var(--primary)"); 
						$("#chk_con").prop("checked", true); 
						con_auto();
						break;
					}					
				}
				
				//col
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="col")
					{
						$('#txtcol').css("background-color","var(--primary)"); 
						$("#chk_col").prop("checked", true); 
						col_auto();
						break;
					}					
				}
				
				//tas
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tas")
					{
						$('#txttas').css("background-color","var(--primary)"); 
						$("#chk_tas").prop("checked", true); 
						tas_auto();
						break;
					}					
				}
				
				//odo
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="odo")
					{
						$('#txtodo').css("background-color","var(--primary)"); 
						$("#chk_odo").prop("checked", true); 
						odo_auto();
						break;
					}					
				}
				
				//ins
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ins")
					{
						$('#txtins').css("background-color","var(--primary)"); 
						$("#chk_ins").prop("checked", true); 
						ins_auto();
						break;
					}					
				}
				
				//spg
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spg")
					{
						$('#txtspg').css("background-color","var(--primary)"); 
						$("#chk_spg").prop("checked", true); 
						spg_auto();
						break;
					}					
				}
				
				//alu
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alu")
					{
						$('#txtalu').css("background-color","var(--primary)"); 
						$("#chk_alu").prop("checked", true); 
						alu_auto();
						break;
					}					
				}
				
				//amm
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="amm")
					{
						$('#txtamm').css("background-color","var(--primary)"); 
						$("#chk_amm").prop("checked", true); 
						amm_auto();
						break;
					}					
				}
				
				//ani
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ani")
					{
						$('#txtani').css("background-color","var(--primary)"); 
						$("#chk_ani").prop("checked", true); 
						ani_auto();
						break;
					}					
				}
				
				//bar
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bar")
					{
						$('#txtbar').css("background-color","var(--primary)"); 
						$("#chk_bar").prop("checked", true); 
						bar_auto();
						break;
					}					
				}
				
				//bor
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bor")
					{
						$('#txtbor').css("background-color","var(--primary)"); 
						$("#chk_bor").prop("checked", true); 
						bor_auto();
						break;
					}					
				}
				
				//cra
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cra")
					{
						$('#txtcra').css("background-color","var(--primary)"); 
						$("#chk_cra").prop("checked", true); 
						cra_auto();
						break;
					}					
				}
				
				//flu
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flu")
					{
						$('#txtflu').css("background-color","var(--primary)"); 
						$("#chk_flu").prop("checked", true); 
						flu_auto();
						break;
					}					
				}
				
				//frc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="frc")
					{
						$('#txtfrc').css("background-color","var(--primary)"); 
						$("#chk_frc").prop("checked", true); 
						frc_auto();
						break;
					}					
				}
				
				//iro
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="iro")
					{
						$('#txtiro').css("background-color","var(--primary)"); 
						$("#chk_iro").prop("checked", true); 
						iro_auto();
						break;
					}					
				}
				
				//man
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="man")
					{
						$('#txtman').css("background-color","var(--primary)"); 
						$("#chk_man").prop("checked", true); 
						man_auto();
						break;
					}					
				}
				
				//min
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="min")
					{
						$('#txtmin').css("background-color","var(--primary)"); 
						$("#chk_min").prop("checked", true); 
						min_auto();
						break;
					}					
				}
				
				//nit
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="nit")
					{
						$('#txtnit').css("background-color","var(--primary)"); 
						$("#chk_nit").prop("checked", true); 
						nit_auto();
						break;
					}					
				}
				
				//phe
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phe")
					{
						$('#txtphe').css("background-color","var(--primary)"); 
						$("#chk_phe").prop("checked", true); 
						phe_auto();
						break;
					}					
				}
				//sel
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sel")
					{
						$('#txtsel').css("background-color","var(--primary)"); 
						$("#chk_sel").prop("checked", true); 
						sel_auto();
						break;
					}					
				}
				//sil
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sil")
					{
						$('#txtsil').css("background-color","var(--primary)"); 
						$("#chk_sil").prop("checked", true); 
						sil_auto();
						break;
					}					
				}
				//spd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spd")
					{
						$('#txtspd').css("background-color","var(--primary)"); 
						$("#chk_spd").prop("checked", true); 
						spd_auto();
						break;
					}					
				}
				//zin
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="zin")
					{
						$('#txtzin').css("background-color","var(--primary)"); 
						$("#chk_zin").prop("checked", true); 
						zin_auto();
						break;
					}					
				}
				//cop
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cop")
					{
						$('#txtcop').css("background-color","var(--primary)"); 
						$("#chk_cop").prop("checked", true); 
						cop_auto();
						break;
					}					
				}
				//lea
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lea")
					{
						$('#txtlea').css("background-color","var(--primary)"); 
						$("#chk_lea").prop("checked", true); 
						lea_auto();
						break;
					}					
				}
				//cyn
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cyn")
					{
						$('#txtcyn').css("background-color","var(--primary)"); 
						$("#chk_cyn").prop("checked", true); 
						cyn_auto();
						break;
					}					
				}
				//tot
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tot")
					{
						$('#txttot').css("background-color","var(--primary)"); 
						$("#chk_tot").prop("checked", true); 
						tot_auto();
						break;
					}					
				}
				//cad
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cad")
					{
						$('#txtcad').css("background-color","var(--primary)"); 
						$("#chk_cad").prop("checked", true); 
						cad_auto();
						break;
					}					
				}
				//bec
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bec")
					{
						$('#txtbec').css("background-color","var(--primary)"); 
						$("#chk_bec").prop("checked", true); 
						bec_auto();
						break;
					}					
				}
				//eco
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="eco")
					{
						$('#txteco').css("background-color","var(--primary)"); 
						$("#chk_eco").prop("checked", true); 
						eco_auto();
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


			$("#btn_edit_data").click(function(){
			$('#btn_edit_data').hide();

	});
	
	function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}
function getGlazedTiles(){
				var lab_no = $('#lab_no').val(); 
				var report_no = $('#report_no').val(); 
				var job_no=$('#job_no').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_water_span_d.php',
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
				
				//phv
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phv")
					{
						if(document.getElementById('chk_phv').checked) {
								var chk_phv = "1";
						}
						else{
								var chk_phv = "0";
						}	
							
																			
							var p1 = $('#p1').val();
							var p2 = $('#p2').val();
							var p3 = $('#p3').val();
							var pa1 = $('#pa1').val();
							var pa2 = $('#pa2').val();
							var pa3 = $('#pa3').val();
							var ph1 = $('#ph1').val();
							var ph2 = $('#ph2').val();
							var ph3 = $('#ph3').val();
							var avgp = $('#avgp').val();
						
						break;
					}
					else
					{
							var chk_phv = "0";
							var p1 = "0";
							var p2 = "0";
							var p3 = "0";
							var pa1 = "0";
							var pa2 = "0";
							var pa3 = "0";
							var ph1 = "0";
							var ph2 = "0";
							var ph3 = "0";
							
							var avgp = "0";
					}
														
				}
				
				
				//tur
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tur")
					{
						if(document.getElementById('chk_tur').checked) {
								var chk_tur = "1";
						}
						else{
								var chk_tur = "0";
						}	
							
																			
							var t1 = $('#t1').val();
							var t2 = $('#t2').val();
							var t3 = $('#t3').val();
							var nt1 = $('#nt1').val();
							var nt2 = $('#nt2').val();
							var nt3 = $('#nt3').val();
							var avgtur = $('#avgtur').val();
						
						break;
					}
					else
					{
							var chk_tur = "0";
							var t1 = "0";
							var t2 = "0";
							var t3 = "0";
							var nt1 = "0";
							var nt2 = "0";
							var nt3 = "0";
							var avgtur = "0";
					}
														
				}
				
				
				//pla
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pla")
					{
						if(document.getElementById('chk_pla').checked) {
								var chk_pla = "1";
						}
						else{
								var chk_pla = "0";
						}	
							
																			
							var pla1 = $('#pla1').val();
							var pla2 = $('#pla2').val();
							var pla3 = $('#pla3').val();
							var plb1 = $('#plb1').val();
							var plb2 = $('#plb2').val();
							var plb3 = $('#plb3').val();
							var plc1 = $('#plc1').val();
							var plc2 = $('#plc2').val();
							var plc3 = $('#plc3').val();
							var pld1 = $('#pld1').val();
							var pld2 = $('#pld2').val();
							var pld3 = $('#pld3').val();
							var pl1 = $('#pl1').val();
							var pl2 = $('#pl2').val();
							var pl3 = $('#pl3').val();
							var avgpla = $('#avgpla').val();
						
						break;
					}
					else
					{
							var chk_pla = "0";
							var pla1 = "0";
							var pla2 = "0";
							var pla3 = "0";
							var plb1 = "0";
							var plb2 = "0";
							var plb3 = "0";
							var plc1 = "0";
							var plc2 = "0";
							var plc3 = "0";
							var pld1 = "0";
							var pld2 = "0";
							var pld3 = "0";
							var pl1 = "0";
							var pl2 = "0";
							var pl3 = "0";
							var avgpla = "0";
					}
														
				}
				
				
				//tla
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tla")
					{
						if(document.getElementById('chk_tla').checked) {
								var chk_tla = "1";
						}
						else{
								var chk_tla = "0";
						}	
							
																			
							var tla1 = $('#tla1').val();
							var tla2 = $('#tla2').val();
							var tla3 = $('#tla3').val();
							var tlb1 = $('#tlb1').val();
							var tlb2 = $('#tlb2').val();
							var tlb3 = $('#tlb3').val();
							var tlc1 = $('#tlc1').val();
							var tlc2 = $('#tlc2').val();
							var tlc3 = $('#tlc3').val();
							var tld1 = $('#tld1').val();
							var tld2 = $('#tld2').val();
							var tld3 = $('#tld3').val();
							var tl1 = $('#tl1').val();
							var tl2 = $('#tl2').val();
							var tl3 = $('#tl3').val();
							var avgtla = $('#avgtla').val();
						
						break;
					}
					else
					{
							var chk_tla = "0";
							var tla1 = "0";
							var tla2 = "0";
							var tla3 = "0";
							var tlb1 = "0";
							var tlb2 = "0";
							var tlb3 = "0";
							var tlc1 = "0";
							var tlc2 = "0";
							var tlc3 = "0";
							var tld1 = "0";
							var tld2 = "0";
							var tld3 = "0";
							var tl1 = "0";
							var tl2 = "0";
							var tl3 = "0";
							var avgtla = "0";
					}
														
				}
				
				
				
				//bic
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bic")
					{	
						if(document.getElementById('chk_bic').checked) {
							var chk_bic = "1";
							var chk_car = "1";
						}
						else{
							var chk_bic = "0";
							var chk_car = "0";
						}					
						//specific gravity and water abrasion-5							
						var avgsample = $('#avgsample').val();			
						var avghyd = $('#avghyd').val();			
						var avgcar = $('#avgcar').val();			
						var avgbic = $('#avgbic').val();				
									
											
						break;
					}
					else
					{
						var chk_bic = "0";
						var chk_car = "0";
						var avgsample = "0";
						var avghyd = "0";			
						var avgcar = "0";			
						var avgbic = "0";	
					}
				
				}
				
				
				//hrd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="hrd")
					{
						if(document.getElementById('chk_hrd').checked) {
								var chk_hrd = "1";
						}
						else{
								var chk_hrd = "0";
						}	
							
																			
							var hra1 = $('#hra1').val();
							var hra2 = $('#hra2').val();
							var hra3 = $('#hra3').val();
							var hrb1 = $('#hrb1').val();
							var hrb2 = $('#hrb2').val();
							var hrb3 = $('#hrb3').val();
							var hrc1 = $('#hrc1').val();
							var hrc2 = $('#hrc2').val();
							var hrc3 = $('#hrc3').val();
							var hrd1 = $('#hrd1').val();
							var hrd2 = $('#hrd2').val();
							var hrd3 = $('#hrd3').val();
							var hr1 = $('#hr1').val();
							var hr2 = $('#hr2').val();
							var hr3 = $('#hr3').val();
							var avghr = $('#avghr').val();
							var hrcf = $('#hrcf').val();
						
						break;
					}
					else
					{
							var chk_hrd = "0";
							var hra1 = "0";
							var hra2 = "0";
							var hra3 = "0";
							var hrb1 = "0";
							var hrb2 = "0";
							var hrb3 = "0";
							var hrc1 = "0";
							var hrc2 = "0";
							var hrc3 = "0";
							var hrd1 = "0";
							var hrd2 = "0";
							var hrd3 = "0";
							var hr1 = "0";
							var hr2 = "0";
							var hr3 = "0";
							var hrcf = "0";
							var avghr = "0";
					}
														
				}
				
				//cal
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cal")
					{
						if(document.getElementById('chk_cal').checked) {
								var chk_cal = "1";
						}
						else{
								var chk_cal = "0";
						}	
							
																			
							var caa1 = $('#caa1').val();
							var caa2 = $('#caa2').val();
							var caa3 = $('#caa3').val();
							var cab1 = $('#cab1').val();
							var cab2 = $('#cab2').val();
							var cab3 = $('#cab3').val();
							var cac1 = $('#cac1').val();
							var cac2 = $('#cac2').val();
							var cac3 = $('#cac3').val();
							var cad1 = $('#cad1').val();
							var cad2 = $('#cad2').val();
							var cad3 = $('#cad3').val();
							var ca1 = $('#ca1').val();
							var ca2 = $('#ca2').val();
							var ca3 = $('#ca3').val();
							var avgca = $('#avgca').val();
						
						break;
					}
					else
					{
							var chk_cal = "0";
							var caa1 = "0";
							var caa2 = "0";
							var caa3 = "0";
							var cab1 = "0";
							var cab2 = "0";
							var cab3 = "0";
							var cac1 = "0";
							var cac2 = "0";
							var cac3 = "0";
							var cad1 = "0";
							var cad2 = "0";
							var cad3 = "0";
							var ca1 = "0";
							var ca2 = "0";
							var ca3 = "0";
							var avgca = "0";
					}
														
				}
				
				
				//mag
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mag")
					{	
						if(document.getElementById('chk_mag').checked) {
							var chk_mag = "1";
						}
						else{
							var chk_mag = "0";
						}					
								
						var avgmag = $('#avgmag').val();					
											
						break;
					}
					else
					{
						var chk_mag = "0";									
						var avgmag = "0";
					}
				
				}
				
				//chl
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="chl")
					{	
						if(document.getElementById('chk_chl').checked) {
							var chk_chl = "1";
						}
						else{
							var chk_chl = "0";
						}					
						//specific gravity and water abrasion-5							
						var cha1 = $('#cha1').val();			
						var cha2 = $('#cha2').val();			
						var cha3 = $('#cha3').val();			
						var chb1 = $('#chb1').val();			
						var chb2 = $('#chb2').val();				
						var chb3 = $('#chb3').val();				
						var chc1 = $('#chc1').val();						
						var chc2 = $('#chc2').val();						
						var chc3 = $('#chc3').val();						
						var chd1 = $('#chd1').val();														
						var chd2 = $('#chd2').val();				
						var chd3 = $('#chd3').val();				
						var ch1 = $('#ch1').val();				
						var ch2 = $('#ch2').val();				
						var ch3 = $('#ch3').val();				
						var avgch = $('#avgch').val();					
											
						break;
					}
					else
					{
						var chk_chl = "0";
						var cha1 = "0";			
						var cha2 = "0";			
						var cha3 = "0";			
						var chb1 = "0";			
						var chb2 = "0";				
						var chb3 = "0";				
						var chc1 = "0";						
						var chc2 = "0";						
						var chc3 = "0";						
						var chd1 = "0";														
						var chd2 = "0";				
						var chd3 = "0";				
						var ch1 = "0";				
						var ch2 = "0";				
						var ch3 = "0";				
						var avgch = "0";
					}
				
				}
				
				
				//sul
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sul")
					{
						if(document.getElementById('chk_sul').checked) {
								var chk_sul = "1";
						}
						else{
								var chk_sul = "0";
						}	
							
																			
							var sua1 = $('#sua1').val();
							var sua2 = $('#sua2').val();
							var sua3 = $('#sua3').val();
							var sub1 = $('#sub1').val();
							var sub2 = $('#sub2').val();
							var sub3 = $('#sub3').val();
							var suc1 = $('#suc1').val();
							var suc2 = $('#suc2').val();
							var suc3 = $('#suc3').val();
							var sud1 = $('#sud1').val();
							var sud2 = $('#sud2').val();
							var sud3 = $('#sud3').val();
							var su1 = $('#su1').val();
							var su2 = $('#su2').val();
							var su3 = $('#su3').val();
							var avgsu = $('#avgsu').val();
						
						break;
					}
					else
					{
							var chk_sul = "0";
							var sua1 = "0";
							var sua2 = "0";
							var sua3 = "0";
							var sub1 = "0";
							var sub2 = "0";
							var sub3 = "0";
							var suc1 = "0";
							var suc2 = "0";
							var suc3 = "0";
							var sud1 = "0";
							var sud2 = "0";
							var sud3 = "0";
							var su1 = "0";
							var su2 = "0";
							var su3 = "0";
							var avgsu = "0";
					}
														
				}
				
				//tds
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tds")
					{
						if(document.getElementById('chk_tds').checked) {
								var chk_tds = "1";
						}
						else{
								var chk_tds = "0";
						}	
							
																			
							var tda1 = $('#tda1').val();
							var tda2 = $('#tda2').val();
							var tda3 = $('#tda3').val();
							var tdb1 = $('#tdb1').val();
							var tdb2 = $('#tdb2').val();
							var tdb3 = $('#tdb3').val();
							var tdc1 = $('#tdc1').val();
							var tdc2 = $('#tdc2').val();
							var tdc3 = $('#tdc3').val();
							var tdd1 = $('#tdd1').val();
							var tdd2 = $('#tdd2').val();
							var tdd3 = $('#tdd3').val();
							var td1 = $('#td1').val();
							var td2 = $('#td2').val();
							var td3 = $('#td3').val();
							var avgtd = $('#avgtd').val();
						
						break;
					}
					else
					{
							var chk_tds = "0";
							var tda1 = "0";
							var tda2 = "0";
							var tda3 = "0";
							var tdb1 = "0";
							var tdb2 = "0";
							var tdb3 = "0";
							var tdc1 = "0";
							var tdc2 = "0";
							var tdc3 = "0";
							var tdd1 = "0";
							var tdd2 = "0";
							var tdd3 = "0";
							var td1 = "0";
							var td2 = "0";
							var td3 = "0";
							var avgtd = "0";
					}
														
				}
				
				
				//con
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="con")
					{	
						if(document.getElementById('chk_con').checked) {
							var chk_con = "1";
						}
						else{
							var chk_con = "0";
						}					
						//specific gravity and water abrasion-5							
						var con1 = $('#con1').val();			
						var con2 = $('#con2').val();			
						var con3 = $('#con3').val();			
						var cos1 = $('#cos1').val();			
						var cos2 = $('#cos2').val();				
						var cos3 = $('#cos3').val();						
									
						var avgcon = $('#avgcon').val();					
											
						break;
					}
					else
					{
						var chk_con = "0";
						var con1 = "0";			
						var con2 = "0";			
						var con3 = "0";			
						var cos1 = "0";			
						var cos2 = "0";				
						var cos3 = "0";						
									
						var avgcon = "0";
					}
				
				}
				
				
				
				//col
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="col")
					{	
						if(document.getElementById('chk_col').checked) {
							var chk_col = "1";
						}
						else{
							var chk_col = "0";
						}					
										
						var avgcol = $('#avgcol').val();					
											
						break;
					}
					else
					{
						var chk_col = "0";
						var avgcol = "0";
						
					}
				
				}
				
				//tas
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tas")
					{	
						if(document.getElementById('chk_tas').checked) {
							var chk_tas = "1";
						}
						else{
							var chk_tas = "0";
						}					
										
						var avgtas = $('#avgtas').val();					
											
						break;
					}
					else
					{
						var chk_tas = "0";
						var avgtas = "0";
						
					}
				
				}
				//odo
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="odo")
					{	
						if(document.getElementById('chk_odo').checked) {
							var chk_odo = "1";
						}
						else{
							var chk_odo = "0";
						}					
										
						var avgodo = $('#avgodo').val();					
											
						break;
					}
					else
					{
						var chk_odo = "0";
						var avgodo = "0";
						
					}
				
				}
				//ins
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ins")
					{	
						if(document.getElementById('chk_ins').checked) {
							var chk_ins = "1";
						}
						else{
							var chk_ins = "0";
						}					
										
						var avgins = $('#avgins').val();					
											
						break;
					}
					else
					{
						var chk_ins = "0";
						var avgins = "0";
						
					}
				
				}
				//spg
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spg")
					{	
						if(document.getElementById('chk_spg').checked) {
							var chk_spg = "1";
						}
						else{
							var chk_spg = "0";
						}					
										
						var avgspg = $('#avgspg').val();					
											
						break;
					}
					else
					{
						var chk_spg = "0";
						var avgspg = "0";
						
					}
				
				}
				//alu
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alu")
					{	
						if(document.getElementById('chk_alu').checked) {
							var chk_alu = "1";
						}
						else{
							var chk_alu = "0";
						}					
										
						var avgalu = $('#avgalu').val();					
											
						break;
					}
					else
					{
						var chk_alu = "0";
						var avgalu = "0";
						
					}
				
				}
				//amm
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="amm")
					{	
						if(document.getElementById('chk_amm').checked) {
							var chk_amm = "1";
						}
						else{
							var chk_amm = "0";
						}					
										
						var avgamm = $('#avgamm').val();					
											
						break;
					}
					else
					{
						var chk_amm = "0";
						var avgamm = "0";
						
					}
				
				}
				//ani
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ani")
					{	
						if(document.getElementById('chk_ani').checked) {
							var chk_ani = "1";
						}
						else{
							var chk_ani = "0";
						}					
										
						var avgani = $('#avgani').val();					
											
						break;
					}
					else
					{
						var chk_ani = "0";
						var avgani = "0";
						
					}
				
				}
				//bar
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bar")
					{	
						if(document.getElementById('chk_bar').checked) {
							var chk_bar = "1";
						}
						else{
							var chk_bar = "0";
						}					
										
						var avgbar = $('#avgbar').val();					
											
						break;
					}
					else
					{
						var chk_bar = "0";
						var avgbar = "0";
						
					}
				
				}
				//bor
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bor")
					{	
						if(document.getElementById('chk_bor').checked) {
							var chk_bor = "1";
						}
						else{
							var chk_bor = "0";
						}					
										
						var avgbor = $('#avgbor').val();					
											
						break;
					}
					else
					{
						var chk_bor = "0";
						var avgbor = "0";
						
					}
				
				}
				//cra
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cra")
					{	
						if(document.getElementById('chk_cra').checked) {
							var chk_cra = "1";
						}
						else{
							var chk_cra = "0";
						}					
										
						var avgcra = $('#avgcra').val();					
											
						break;
					}
					else
					{
						var chk_cra = "0";
						var avgcra = "0";
						
					}
				
				}
				//flu
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flu")
					{	
						if(document.getElementById('chk_flu').checked) {
							var chk_flu = "1";
						}
						else{
							var chk_flu = "0";
						}					
										
						var avgflu = $('#avgflu').val();					
											
						break;
					}
					else
					{
						var chk_flu = "0";
						var avgflu = "0";
						
					}
				
				}
				//frc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="frc")
					{	
						if(document.getElementById('chk_frc').checked) {
							var chk_frc = "1";
						}
						else{
							var chk_frc = "0";
						}					
										
						var avgfrc = $('#avgfrc').val();					
											
						break;
					}
					else
					{
						var chk_frc = "0";
						var avgfrc = "0";
						
					}
				
				}
				//iro
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="iro")
					{	
						if(document.getElementById('chk_iro').checked) {
							var chk_iro = "1";
						}
						else{
							var chk_iro = "0";
						}					
										
						var avgiro = $('#avgiro').val();					
											
						break;
					}
					else
					{
						var chk_iro = "0";
						var avgiro = "0";
						
					}
				
				}
				//man
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="man")
					{	
						if(document.getElementById('chk_man').checked) {
							var chk_man = "1";
						}
						else{
							var chk_man = "0";
						}					
										
						var avgman = $('#avgman').val();					
											
						break;
					}
					else
					{
						var chk_man = "0";
						var avgman = "0";
						
					}
				
				}
				//min
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="min")
					{	
						if(document.getElementById('chk_min').checked) {
							var chk_min = "1";
						}
						else{
							var chk_min = "0";
						}					
										
						var avgmin = $('#avgmin').val();					
											
						break;
					}
					else
					{
						var chk_min = "0";
						var avgmin = "0";
						
					}
				
				}
				//nit
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="nit")
					{	
						if(document.getElementById('chk_nit').checked) {
							var chk_nit = "1";
						}
						else{
							var chk_nit = "0";
						}					
										
						var avgnit = $('#avgnit').val();					
											
						break;
					}
					else
					{
						var chk_nit = "0";
						var avgnit = "0";
						
					}
				
				}
				//phe
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phe")
					{	
						if(document.getElementById('chk_phe').checked) {
							var chk_phe = "1";
						}
						else{
							var chk_phe = "0";
						}					
										
						var avgphe = $('#avgphe').val();					
											
						break;
					}
					else
					{
						var chk_phe = "0";
						var avgphe = "0";
						
					}
				
				}
				//sel
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sel")
					{	
						if(document.getElementById('chk_sel').checked) {
							var chk_sel = "1";
						}
						else{
							var chk_sel = "0";
						}					
										
						var avgsel = $('#avgsel').val();					
											
						break;
					}
					else
					{
						var chk_sel = "0";
						var avgsel = "0";
						
					}
				
				}
				//sil
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sil")
					{	
						if(document.getElementById('chk_sil').checked) {
							var chk_sil = "1";
						}
						else{
							var chk_sil = "0";
						}					
										
						var avgsil = $('#avgsil').val();					
											
						break;
					}
					else
					{
						var chk_sil = "0";
						var avgsil = "0";
						
					}
				
				}
				//spd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spd")
					{	
						if(document.getElementById('chk_spd').checked) {
							var chk_spd = "1";
						}
						else{
							var chk_spd = "0";
						}					
										
						var avgspd = $('#avgspd').val();					
											
						break;
					}
					else
					{
						var chk_spd = "0";
						var avgspd = "0";
						
					}
				
				}
				//zin
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="zin")
					{	
						if(document.getElementById('chk_zin').checked) {
							var chk_zin = "1";
						}
						else{
							var chk_zin = "0";
						}					
										
						var avgzin = $('#avgzin').val();					
											
						break;
					}
					else
					{
						var chk_zin = "0";
						var avgzin = "0";
						
					}
				
				}
				//cop
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cop")
					{	
						if(document.getElementById('chk_cop').checked) {
							var chk_cop = "1";
						}
						else{
							var chk_cop = "0";
						}					
										
						var avgcop = $('#avgcop').val();					
											
						break;
					}
					else
					{
						var chk_cop = "0";
						var avgcop = "0";
						
					}
				
				}
				//lea
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lea")
					{	
						if(document.getElementById('chk_lea').checked) {
							var chk_lea = "1";
						}
						else{
							var chk_lea = "0";
						}					
										
						var avglea = $('#avglea').val();					
											
						break;
					}
					else
					{
						var chk_lea = "0";
						var avglea = "0";
						
					}
				
				}
				//cyn
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cyn")
					{	
						if(document.getElementById('chk_cyn').checked) {
							var chk_cyn = "1";
						}
						else{
							var chk_cyn = "0";
						}					
										
						var avgcyn = $('#avgcyn').val();					
											
						break;
					}
					else
					{
						var chk_cyn = "0";
						var avgcyn = "0";
						
					}
				
				}
				//tot
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tot")
					{	
						if(document.getElementById('chk_tot').checked) {
							var chk_tot = "1";
						}
						else{
							var chk_tot = "0";
						}					
										
						var avgtot = $('#avgtot').val();					
											
						break;
					}
					else
					{
						var chk_tot = "0";
						var avgtot = "0";
						
					}
				
				}
				//cad
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cad")
					{	
						if(document.getElementById('chk_cad').checked) {
							var chk_cad = "1";
						}
						else{
							var chk_cad = "0";
						}					
										
						var avgcad = $('#avgcad').val();					
											
						break;
					}
					else
					{
						var chk_cad = "0";
						var avgcad = "0";
						
					}
				
				}
				//bec
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bec")
					{	
						if(document.getElementById('chk_bec').checked) {
							var chk_bec = "1";
						}
						else{
							var chk_bec = "0";
						}					
										
						var avgbec = $('#avgbec').val();					
											
						break;
					}
					else
					{
						var chk_bec = "0";
						var avgbec = "0";
						
					}
				
				}
				//eco
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="eco")
					{	
						if(document.getElementById('chk_eco').checked) {
							var chk_eco = "1";
						}
						else{
							var chk_eco = "0";
						}					
										
						var avgeco = $('#avgeco').val();					
											
						break;
					}
					else
					{
						var chk_eco = "0";
						var avgeco = "0";
						
					}
				
				}
				
				
				
				
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_phv='+chk_phv+'&p1='+p1+'&p2='+p2+'&p3='+p3+'&pa1='+pa1+'&pa2='+pa2+'&pa3='+pa3+'&ph1='+ph1+'&ph2='+ph2+'&ph3='+ph3+'&avgp='+avgp+'&chk_tur='+chk_tur+'&t1='+t1+'&t2='+t2+'&t3='+t3+'&nt1='+nt1+'&nt2='+nt2+'&nt3='+nt3+'&avgtur='+avgtur+'&chk_pla='+chk_pla+'&pla1='+pla1+'&pla2='+pla2+'&pla3='+pla3+'&plb1='+plb1+'&plb2='+plb2+'&plb3='+plb3+'&plc1='+plc1+'&plc2='+plc2+'&plc3='+plc3+'&pld1='+pld1+'&pld2='+pld2+'&pld3='+pld3+'&pl1='+pl1+'&pl2='+pl2+'&pl3='+pl3+'&avgpla='+avgpla+'&chk_tla='+chk_tla+'&tla1='+tla1+'&tla2='+tla2+'&tla3='+tla3+'&tlb1='+tlb1+'&tlb2='+tlb2+'&tlb3='+tlb3+'&tlc1='+tlc1+'&tlc2='+tlc2+'&tlc3='+tlc3+'&tld1='+tld1+'&tld2='+tld2+'&tld3='+tld3+'&tl1='+tl1+'&tl2='+tl2+'&tl3='+tl3+'&avgtla='+avgtla+'&chk_bic='+chk_bic+'&chk_car='+chk_car+'&avgsample='+avgsample+'&avghyd='+avghyd+'&avgcar='+avgcar+'&avgbic='+avgbic+'&chk_hrd='+chk_hrd+'&hra1='+hra1+'&hra2='+hra2+'&hra3='+hra3+'&hrb1='+hrb1+'&hrb2='+hrb2+'&hrb3='+hrb3+'&hrc1='+hrc1+'&hrc2='+hrc2+'&hrc3='+hrc3+'&hrd1='+hrd1+'&hrd2='+hrd2+'&hrd3='+hrd3+'&hr1='+hr1+'&hr2='+hr2+'&hr3='+hr3+'&avghr='+avghr+'&hrcf='+hrcf+'&chk_cal='+chk_cal+'&caa1='+caa1+'&caa2='+caa2+'&caa3='+caa3+'&cab1='+cab1+'&cab2='+cab2+'&cab3='+cab3+'&cac1='+cac1+'&cac2='+cac2+'&cac3='+cac3+'&cad1='+cad1+'&cad2='+cad2+'&cad3='+cad3+'&ca1='+ca1+'&ca2='+ca2+'&ca3='+ca3+'&avgca='+avgca+'&chk_mag='+chk_mag+'&avgmag='+avgmag+'&chk_chl='+chk_chl+'&cha1='+cha1+'&cha2='+cha2+'&cha3='+cha3+'&chb1='+chb1+'&chb2='+chb2+'&chb3='+chb3+'&chc1='+chc1+'&chc2='+chc2+'&chc3='+chc3+'&chd1='+chd1+'&chd2='+chd2+'&chd3='+chd3+'&ch1='+ch1+'&ch2='+ch2+'&ch3='+ch3+'&avgch='+avgch+'&chk_sul='+chk_sul+'&sua1='+sua1+'&sua2='+sua2+'&sua3='+sua3+'&sub1='+sub1+'&sub2='+sub2+'&sub3='+sub3+'&suc1='+suc1+'&suc2='+suc2+'&suc3='+suc3+'&sud1='+sud1+'&sud2='+sud2+'&sud3='+sud3+'&su1='+su1+'&su2='+su2+'&su3='+su3+'&avgsu='+avgsu+'&chk_tds='+chk_tds+'&tda1='+tda1+'&tda2='+tda2+'&tda3='+tda3+'&tdb1='+tdb1+'&tdb2='+tdb2+'&tdb3='+tdb3+'&tdc1='+tdc1+'&tdc2='+tdc2+'&tdc3='+tdc3+'&tdd1='+tdd1+'&tdd2='+tdd2+'&tdd3='+tdd3+'&td1='+td1+'&td2='+td2+'&td3='+td3+'&avgtd='+avgtd+'&chk_con='+chk_con+'&con1='+con1+'&con2='+con2+'&con3='+con3+'&cos1='+cos1+'&cos2='+cos2+'&cos3='+cos3+'&avgcon='+avgcon+'&chk_col='+chk_col+'&avgcol='+avgcol+'&chk_tas='+chk_tas+'&avgtas='+avgtas+'&chk_odo='+chk_odo+'&avgodo='+avgodo+'&chk_ins='+chk_ins+'&avgins='+avgins+'&chk_spg='+chk_spg+'&avgspg='+avgspg+'&chk_alu='+chk_alu+'&avgalu='+avgalu+'&chk_amm='+chk_amm+'&avgamm='+avgamm+'&chk_ani='+chk_ani+'&avgani='+avgani+'&chk_bar='+chk_bar+'&avgbar='+avgbar+'&chk_bor='+chk_bor+'&avgbor='+avgbor+'&chk_cra='+chk_cra+'&avgcra='+avgcra+'&chk_flu='+chk_flu+'&avgflu='+avgflu+'&chk_frc='+chk_frc+'&avgfrc='+avgfrc+'&chk_iro='+chk_iro+'&avgiro='+avgiro+'&chk_man='+chk_man+'&avgman='+avgman+'&chk_min='+chk_min+'&avgmin='+avgmin+'&chk_nit='+chk_nit+'&avgnit='+avgnit+'&chk_phe='+chk_phe+'&avgphe='+avgphe+'&chk_sel='+chk_sel+'&avgsel='+avgsel+'&chk_sil='+chk_sil+'&avgsil='+avgsil+'&chk_spd='+chk_spd+'&avgspd='+avgspd+'&chk_zin='+chk_zin+'&avgzin='+avgzin+'&chk_cop='+chk_cop+'&avgcop='+avgcop+'&chk_lea='+chk_lea+'&avglea='+avglea+'&chk_cyn='+chk_cyn+'&avgcyn='+avgcyn+'&chk_tot='+chk_tot+'&avgtot='+avgtot+'&chk_cad='+chk_cad+'&avgcad='+avgcad+'&chk_bec='+chk_bec+'&avgbec='+avgbec+'&chk_eco='+chk_eco+'&avgeco='+avgeco+'&ulr='+ulr;
						
	}
	else if (type == 'edit'){
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//phv
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phv")
					{
						if(document.getElementById('chk_phv').checked) {
								var chk_phv = "1";
						}
						else{
								var chk_phv = "0";
						}	
							
																			
							var p1 = $('#p1').val();
							var p2 = $('#p2').val();
							var p3 = $('#p3').val();
							var pa1 = $('#pa1').val();
							var pa2 = $('#pa2').val();
							var pa3 = $('#pa3').val();
							var ph1 = $('#ph1').val();
							var ph2 = $('#ph2').val();
							var ph3 = $('#ph3').val();
							var avgp = $('#avgp').val();
						
						break;
					}
					else
					{
							var chk_phv = "0";
							var p1 = "0";
							var p2 = "0";
							var p3 = "0";
							var pa1 = "0";
							var pa2 = "0";
							var pa3 = "0";
							var ph1 = "0";
							var ph2 = "0";
							var ph3 = "0";
							
							var avgp = "0";
					}
														
				}
				
				
				//tur
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tur")
					{
						if(document.getElementById('chk_tur').checked) {
								var chk_tur = "1";
						}
						else{
								var chk_tur = "0";
						}	
							
																			
							var t1 = $('#t1').val();
							var t2 = $('#t2').val();
							var t3 = $('#t3').val();
							var nt1 = $('#nt1').val();
							var nt2 = $('#nt2').val();
							var nt3 = $('#nt3').val();
							var avgtur = $('#avgtur').val();
						
						break;
					}
					else
					{
							var chk_tur = "0";
							var t1 = "0";
							var t2 = "0";
							var t3 = "0";
							var nt1 = "0";
							var nt2 = "0";
							var nt3 = "0";
							var avgtur = "0";
					}
														
				}
				
				
				//pla
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pla")
					{
						if(document.getElementById('chk_pla').checked) {
								var chk_pla = "1";
						}
						else{
								var chk_pla = "0";
						}	
							
																			
							var pla1 = $('#pla1').val();
							var pla2 = $('#pla2').val();
							var pla3 = $('#pla3').val();
							var plb1 = $('#plb1').val();
							var plb2 = $('#plb2').val();
							var plb3 = $('#plb3').val();
							var plc1 = $('#plc1').val();
							var plc2 = $('#plc2').val();
							var plc3 = $('#plc3').val();
							var pld1 = $('#pld1').val();
							var pld2 = $('#pld2').val();
							var pld3 = $('#pld3').val();
							var pl1 = $('#pl1').val();
							var pl2 = $('#pl2').val();
							var pl3 = $('#pl3').val();
							var avgpla = $('#avgpla').val();
						
						break;
					}
					else
					{
							var chk_pla = "0";
							var pla1 = "0";
							var pla2 = "0";
							var pla3 = "0";
							var plb1 = "0";
							var plb2 = "0";
							var plb3 = "0";
							var plc1 = "0";
							var plc2 = "0";
							var plc3 = "0";
							var pld1 = "0";
							var pld2 = "0";
							var pld3 = "0";
							var pl1 = "0";
							var pl2 = "0";
							var pl3 = "0";
							var avgpla = "0";
					}
														
				}
				
				
				//tla
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tla")
					{
						if(document.getElementById('chk_tla').checked) {
								var chk_tla = "1";
						}
						else{
								var chk_tla = "0";
						}	
							
																			
							var tla1 = $('#tla1').val();
							var tla2 = $('#tla2').val();
							var tla3 = $('#tla3').val();
							var tlb1 = $('#tlb1').val();
							var tlb2 = $('#tlb2').val();
							var tlb3 = $('#tlb3').val();
							var tlc1 = $('#tlc1').val();
							var tlc2 = $('#tlc2').val();
							var tlc3 = $('#tlc3').val();
							var tld1 = $('#tld1').val();
							var tld2 = $('#tld2').val();
							var tld3 = $('#tld3').val();
							var tl1 = $('#tl1').val();
							var tl2 = $('#tl2').val();
							var tl3 = $('#tl3').val();
							var avgtla = $('#avgtla').val();
						
						break;
					}
					else
					{
							var chk_tla = "0";
							var tla1 = "0";
							var tla2 = "0";
							var tla3 = "0";
							var tlb1 = "0";
							var tlb2 = "0";
							var tlb3 = "0";
							var tlc1 = "0";
							var tlc2 = "0";
							var tlc3 = "0";
							var tld1 = "0";
							var tld2 = "0";
							var tld3 = "0";
							var tl1 = "0";
							var tl2 = "0";
							var tl3 = "0";
							var avgtla = "0";
					}
														
				}
				
				
				
				//bic
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bic")
					{	
						if(document.getElementById('chk_bic').checked) {
							var chk_bic = "1";
							var chk_car = "1";
						}
						else{
							var chk_bic = "0";
							var chk_car = "0";
						}					
						//specific gravity and water abrasion-5							
						var avgsample = $('#avgsample').val();			
						var avghyd = $('#avghyd').val();			
						var avgcar = $('#avgcar').val();			
						var avgbic = $('#avgbic').val();				
									
											
						break;
					}
					else
					{
						var chk_bic = "0";
						var chk_car = "0";
						var avgsample = "0";
						var avghyd = "0";			
						var avgcar = "0";			
						var avgbic = "0";	
					}
				
				}
				
				
				//hrd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="hrd")
					{
						if(document.getElementById('chk_hrd').checked) {
								var chk_hrd = "1";
						}
						else{
								var chk_hrd = "0";
						}	
							
																			
							var hra1 = $('#hra1').val();
							var hra2 = $('#hra2').val();
							var hra3 = $('#hra3').val();
							var hrb1 = $('#hrb1').val();
							var hrb2 = $('#hrb2').val();
							var hrb3 = $('#hrb3').val();
							var hrc1 = $('#hrc1').val();
							var hrc2 = $('#hrc2').val();
							var hrc3 = $('#hrc3').val();
							var hrd1 = $('#hrd1').val();
							var hrd2 = $('#hrd2').val();
							var hrd3 = $('#hrd3').val();
							var hr1 = $('#hr1').val();
							var hr2 = $('#hr2').val();
							var hr3 = $('#hr3').val();
							var avghr = $('#avghr').val();
							var hrcf = $('#hrcf').val();
						
						break;
					}
					else
					{
							var chk_hrd = "0";
							var hra1 = "0";
							var hra2 = "0";
							var hra3 = "0";
							var hrb1 = "0";
							var hrb2 = "0";
							var hrb3 = "0";
							var hrc1 = "0";
							var hrc2 = "0";
							var hrc3 = "0";
							var hrd1 = "0";
							var hrd2 = "0";
							var hrd3 = "0";
							var hr1 = "0";
							var hr2 = "0";
							var hr3 = "0";
							var hrcf = "0";
							var avghr = "0";
					}
														
				}
				
				//cal
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cal")
					{
						if(document.getElementById('chk_cal').checked) {
								var chk_cal = "1";
						}
						else{
								var chk_cal = "0";
						}	
							
																			
							var caa1 = $('#caa1').val();
							var caa2 = $('#caa2').val();
							var caa3 = $('#caa3').val();
							var cab1 = $('#cab1').val();
							var cab2 = $('#cab2').val();
							var cab3 = $('#cab3').val();
							var cac1 = $('#cac1').val();
							var cac2 = $('#cac2').val();
							var cac3 = $('#cac3').val();
							var cad1 = $('#cad1').val();
							var cad2 = $('#cad2').val();
							var cad3 = $('#cad3').val();
							var ca1 = $('#ca1').val();
							var ca2 = $('#ca2').val();
							var ca3 = $('#ca3').val();
							var avgca = $('#avgca').val();
						
						break;
					}
					else
					{
							var chk_cal = "0";
							var caa1 = "0";
							var caa2 = "0";
							var caa3 = "0";
							var cab1 = "0";
							var cab2 = "0";
							var cab3 = "0";
							var cac1 = "0";
							var cac2 = "0";
							var cac3 = "0";
							var cad1 = "0";
							var cad2 = "0";
							var cad3 = "0";
							var ca1 = "0";
							var ca2 = "0";
							var ca3 = "0";
							var avgca = "0";
					}
														
				}
				
				
				//mag
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mag")
					{	
						if(document.getElementById('chk_mag').checked) {
							var chk_mag = "1";
						}
						else{
							var chk_mag = "0";
						}					
								
						var avgmag = $('#avgmag').val();					
											
						break;
					}
					else
					{
						var chk_mag = "0";									
						var avgmag = "0";
					}
				
				}
				
				//chl
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="chl")
					{	
						if(document.getElementById('chk_chl').checked) {
							var chk_chl = "1";
						}
						else{
							var chk_chl = "0";
						}					
						//specific gravity and water abrasion-5							
						var cha1 = $('#cha1').val();			
						var cha2 = $('#cha2').val();			
						var cha3 = $('#cha3').val();			
						var chb1 = $('#chb1').val();			
						var chb2 = $('#chb2').val();				
						var chb3 = $('#chb3').val();				
						var chc1 = $('#chc1').val();						
						var chc2 = $('#chc2').val();						
						var chc3 = $('#chc3').val();						
						var chd1 = $('#chd1').val();														
						var chd2 = $('#chd2').val();				
						var chd3 = $('#chd3').val();				
						var ch1 = $('#ch1').val();				
						var ch2 = $('#ch2').val();				
						var ch3 = $('#ch3').val();				
						var avgch = $('#avgch').val();					
											
						break;
					}
					else
					{
						var chk_chl = "0";
						var cha1 = "0";			
						var cha2 = "0";			
						var cha3 = "0";			
						var chb1 = "0";			
						var chb2 = "0";				
						var chb3 = "0";				
						var chc1 = "0";						
						var chc2 = "0";						
						var chc3 = "0";						
						var chd1 = "0";														
						var chd2 = "0";				
						var chd3 = "0";				
						var ch1 = "0";				
						var ch2 = "0";				
						var ch3 = "0";				
						var avgch = "0";
					}
				
				}
				
				
				//sul
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sul")
					{
						if(document.getElementById('chk_sul').checked) {
								var chk_sul = "1";
						}
						else{
								var chk_sul = "0";
						}	
							
																			
							var sua1 = $('#sua1').val();
							var sua2 = $('#sua2').val();
							var sua3 = $('#sua3').val();
							var sub1 = $('#sub1').val();
							var sub2 = $('#sub2').val();
							var sub3 = $('#sub3').val();
							var suc1 = $('#suc1').val();
							var suc2 = $('#suc2').val();
							var suc3 = $('#suc3').val();
							var sud1 = $('#sud1').val();
							var sud2 = $('#sud2').val();
							var sud3 = $('#sud3').val();
							var su1 = $('#su1').val();
							var su2 = $('#su2').val();
							var su3 = $('#su3').val();
							var avgsu = $('#avgsu').val();
						
						break;
					}
					else
					{
							var chk_sul = "0";
							var sua1 = "0";
							var sua2 = "0";
							var sua3 = "0";
							var sub1 = "0";
							var sub2 = "0";
							var sub3 = "0";
							var suc1 = "0";
							var suc2 = "0";
							var suc3 = "0";
							var sud1 = "0";
							var sud2 = "0";
							var sud3 = "0";
							var su1 = "0";
							var su2 = "0";
							var su3 = "0";
							var avgsu = "0";
					}
														
				}
				
				//tds
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tds")
					{
						if(document.getElementById('chk_tds').checked) {
								var chk_tds = "1";
						}
						else{
								var chk_tds = "0";
						}	
							
																			
							var tda1 = $('#tda1').val();
							var tda2 = $('#tda2').val();
							var tda3 = $('#tda3').val();
							var tdb1 = $('#tdb1').val();
							var tdb2 = $('#tdb2').val();
							var tdb3 = $('#tdb3').val();
							var tdc1 = $('#tdc1').val();
							var tdc2 = $('#tdc2').val();
							var tdc3 = $('#tdc3').val();
							var tdd1 = $('#tdd1').val();
							var tdd2 = $('#tdd2').val();
							var tdd3 = $('#tdd3').val();
							var td1 = $('#td1').val();
							var td2 = $('#td2').val();
							var td3 = $('#td3').val();
							var avgtd = $('#avgtd').val();
						
						break;
					}
					else
					{
							var chk_tds = "0";
							var tda1 = "0";
							var tda2 = "0";
							var tda3 = "0";
							var tdb1 = "0";
							var tdb2 = "0";
							var tdb3 = "0";
							var tdc1 = "0";
							var tdc2 = "0";
							var tdc3 = "0";
							var tdd1 = "0";
							var tdd2 = "0";
							var tdd3 = "0";
							var td1 = "0";
							var td2 = "0";
							var td3 = "0";
							var avgtd = "0";
					}
														
				}
				
				
				//con
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="con")
					{	
						if(document.getElementById('chk_con').checked) {
							var chk_con = "1";
						}
						else{
							var chk_con = "0";
						}					
						//specific gravity and water abrasion-5							
						var con1 = $('#con1').val();			
						var con2 = $('#con2').val();			
						var con3 = $('#con3').val();			
						var cos1 = $('#cos1').val();			
						var cos2 = $('#cos2').val();				
						var cos3 = $('#cos3').val();						
									
						var avgcon = $('#avgcon').val();					
											
						break;
					}
					else
					{
						var chk_con = "0";
						var con1 = "0";			
						var con2 = "0";			
						var con3 = "0";			
						var cos1 = "0";			
						var cos2 = "0";				
						var cos3 = "0";						
									
						var avgcon = "0";
					}
				
				}
				
				
				
				//col
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="col")
					{	
						if(document.getElementById('chk_col').checked) {
							var chk_col = "1";
						}
						else{
							var chk_col = "0";
						}					
										
						var avgcol = $('#avgcol').val();					
											
						break;
					}
					else
					{
						var chk_col = "0";
						var avgcol = "0";
						
					}
				
				}
				
				//tas
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tas")
					{	
						if(document.getElementById('chk_tas').checked) {
							var chk_tas = "1";
						}
						else{
							var chk_tas = "0";
						}					
										
						var avgtas = $('#avgtas').val();					
											
						break;
					}
					else
					{
						var chk_tas = "0";
						var avgtas = "0";
						
					}
				
				}
				//odo
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="odo")
					{	
						if(document.getElementById('chk_odo').checked) {
							var chk_odo = "1";
						}
						else{
							var chk_odo = "0";
						}					
										
						var avgodo = $('#avgodo').val();					
											
						break;
					}
					else
					{
						var chk_odo = "0";
						var avgodo = "0";
						
					}
				
				}
				//ins
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ins")
					{	
						if(document.getElementById('chk_ins').checked) {
							var chk_ins = "1";
						}
						else{
							var chk_ins = "0";
						}					
										
						var avgins = $('#avgins').val();					
											
						break;
					}
					else
					{
						var chk_ins = "0";
						var avgins = "0";
						
					}
				
				}
				//spg
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spg")
					{	
						if(document.getElementById('chk_spg').checked) {
							var chk_spg = "1";
						}
						else{
							var chk_spg = "0";
						}					
										
						var avgspg = $('#avgspg').val();					
											
						break;
					}
					else
					{
						var chk_spg = "0";
						var avgspg = "0";
						
					}
				
				}
				//alu
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alu")
					{	
						if(document.getElementById('chk_alu').checked) {
							var chk_alu = "1";
						}
						else{
							var chk_alu = "0";
						}					
										
						var avgalu = $('#avgalu').val();					
											
						break;
					}
					else
					{
						var chk_alu = "0";
						var avgalu = "0";
						
					}
				
				}
				//amm
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="amm")
					{	
						if(document.getElementById('chk_amm').checked) {
							var chk_amm = "1";
						}
						else{
							var chk_amm = "0";
						}					
										
						var avgamm = $('#avgamm').val();					
											
						break;
					}
					else
					{
						var chk_amm = "0";
						var avgamm = "0";
						
					}
				
				}
				//ani
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ani")
					{	
						if(document.getElementById('chk_ani').checked) {
							var chk_ani = "1";
						}
						else{
							var chk_ani = "0";
						}					
										
						var avgani = $('#avgani').val();					
											
						break;
					}
					else
					{
						var chk_ani = "0";
						var avgani = "0";
						
					}
				
				}
				//bar
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bar")
					{	
						if(document.getElementById('chk_bar').checked) {
							var chk_bar = "1";
						}
						else{
							var chk_bar = "0";
						}					
										
						var avgbar = $('#avgbar').val();					
											
						break;
					}
					else
					{
						var chk_bar = "0";
						var avgbar = "0";
						
					}
				
				}
				//bor
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bor")
					{	
						if(document.getElementById('chk_bor').checked) {
							var chk_bor = "1";
						}
						else{
							var chk_bor = "0";
						}					
										
						var avgbor = $('#avgbor').val();					
											
						break;
					}
					else
					{
						var chk_bor = "0";
						var avgbor = "0";
						
					}
				
				}
				//cra
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cra")
					{	
						if(document.getElementById('chk_cra').checked) {
							var chk_cra = "1";
						}
						else{
							var chk_cra = "0";
						}					
										
						var avgcra = $('#avgcra').val();					
											
						break;
					}
					else
					{
						var chk_cra = "0";
						var avgcra = "0";
						
					}
				
				}
				//flu
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flu")
					{	
						if(document.getElementById('chk_flu').checked) {
							var chk_flu = "1";
						}
						else{
							var chk_flu = "0";
						}					
										
						var avgflu = $('#avgflu').val();					
											
						break;
					}
					else
					{
						var chk_flu = "0";
						var avgflu = "0";
						
					}
				
				}
				//frc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="frc")
					{	
						if(document.getElementById('chk_frc').checked) {
							var chk_frc = "1";
						}
						else{
							var chk_frc = "0";
						}					
										
						var avgfrc = $('#avgfrc').val();					
											
						break;
					}
					else
					{
						var chk_frc = "0";
						var avgfrc = "0";
						
					}
				
				}
				//iro
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="iro")
					{	
						if(document.getElementById('chk_iro').checked) {
							var chk_iro = "1";
						}
						else{
							var chk_iro = "0";
						}					
										
						var avgiro = $('#avgiro').val();					
											
						break;
					}
					else
					{
						var chk_iro = "0";
						var avgiro = "0";
						
					}
				
				}
				//man
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="man")
					{	
						if(document.getElementById('chk_man').checked) {
							var chk_man = "1";
						}
						else{
							var chk_man = "0";
						}					
										
						var avgman = $('#avgman').val();					
											
						break;
					}
					else
					{
						var chk_man = "0";
						var avgman = "0";
						
					}
				
				}
				//min
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="min")
					{	
						if(document.getElementById('chk_min').checked) {
							var chk_min = "1";
						}
						else{
							var chk_min = "0";
						}					
										
						var avgmin = $('#avgmin').val();					
											
						break;
					}
					else
					{
						var chk_min = "0";
						var avgmin = "0";
						
					}
				
				}
				//nit
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="nit")
					{	
						if(document.getElementById('chk_nit').checked) {
							var chk_nit = "1";
						}
						else{
							var chk_nit = "0";
						}					
										
						var avgnit = $('#avgnit').val();					
											
						break;
					}
					else
					{
						var chk_nit = "0";
						var avgnit = "0";
						
					}
				
				}
				//phe
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phe")
					{	
						if(document.getElementById('chk_phe').checked) {
							var chk_phe = "1";
						}
						else{
							var chk_phe = "0";
						}					
										
						var avgphe = $('#avgphe').val();					
											
						break;
					}
					else
					{
						var chk_phe = "0";
						var avgphe = "0";
						
					}
				
				}
				//sel
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sel")
					{	
						if(document.getElementById('chk_sel').checked) {
							var chk_sel = "1";
						}
						else{
							var chk_sel = "0";
						}					
										
						var avgsel = $('#avgsel').val();					
											
						break;
					}
					else
					{
						var chk_sel = "0";
						var avgsel = "0";
						
					}
				
				}
				//sil
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sil")
					{	
						if(document.getElementById('chk_sil').checked) {
							var chk_sil = "1";
						}
						else{
							var chk_sil = "0";
						}					
										
						var avgsil = $('#avgsil').val();					
											
						break;
					}
					else
					{
						var chk_sil = "0";
						var avgsil = "0";
						
					}
				
				}
				//spd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spd")
					{	
						if(document.getElementById('chk_spd').checked) {
							var chk_spd = "1";
						}
						else{
							var chk_spd = "0";
						}					
										
						var avgspd = $('#avgspd').val();					
											
						break;
					}
					else
					{
						var chk_spd = "0";
						var avgspd = "0";
						
					}
				
				}
				//zin
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="zin")
					{	
						if(document.getElementById('chk_zin').checked) {
							var chk_zin = "1";
						}
						else{
							var chk_zin = "0";
						}					
										
						var avgzin = $('#avgzin').val();					
											
						break;
					}
					else
					{
						var chk_zin = "0";
						var avgzin = "0";
						
					}
				
				}
				//cop
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cop")
					{	
						if(document.getElementById('chk_cop').checked) {
							var chk_cop = "1";
						}
						else{
							var chk_cop = "0";
						}					
										
						var avgcop = $('#avgcop').val();					
											
						break;
					}
					else
					{
						var chk_cop = "0";
						var avgcop = "0";
						
					}
				
				}
				//lea
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lea")
					{	
						if(document.getElementById('chk_lea').checked) {
							var chk_lea = "1";
						}
						else{
							var chk_lea = "0";
						}					
										
						var avglea = $('#avglea').val();					
											
						break;
					}
					else
					{
						var chk_lea = "0";
						var avglea = "0";
						
					}
				
				}
				//cyn
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cyn")
					{	
						if(document.getElementById('chk_cyn').checked) {
							var chk_cyn = "1";
						}
						else{
							var chk_cyn = "0";
						}					
										
						var avgcyn = $('#avgcyn').val();					
											
						break;
					}
					else
					{
						var chk_cyn = "0";
						var avgcyn = "0";
						
					}
				
				}
				//tot
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tot")
					{	
						if(document.getElementById('chk_tot').checked) {
							var chk_tot = "1";
						}
						else{
							var chk_tot = "0";
						}					
										
						var avgtot = $('#avgtot').val();					
											
						break;
					}
					else
					{
						var chk_tot = "0";
						var avgtot = "0";
						
					}
				
				}
				//cad
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cad")
					{	
						if(document.getElementById('chk_cad').checked) {
							var chk_cad = "1";
						}
						else{
							var chk_cad = "0";
						}					
										
						var avgcad = $('#avgcad').val();					
											
						break;
					}
					else
					{
						var chk_cad = "0";
						var avgcad = "0";
						
					}
				
				}
				//bec
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bec")
					{	
						if(document.getElementById('chk_bec').checked) {
							var chk_bec = "1";
						}
						else{
							var chk_bec = "0";
						}					
										
						var avgbec = $('#avgbec').val();					
											
						break;
					}
					else
					{
						var chk_bec = "0";
						var avgbec = "0";
						
					}
				
				}
				//eco
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="eco")
					{	
						if(document.getElementById('chk_eco').checked) {
							var chk_eco = "1";
						}
						else{
							var chk_eco = "0";
						}					
										
						var avgeco = $('#avgeco').val();					
											
						break;
					}
					else
					{
						var chk_eco = "0";
						var avgeco = "0";
						
					}
				
				}
				
				
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_phv='+chk_phv+'&p1='+p1+'&p2='+p2+'&p3='+p3+'&pa1='+pa1+'&pa2='+pa2+'&pa3='+pa3+'&ph1='+ph1+'&ph2='+ph2+'&ph3='+ph3+'&avgp='+avgp+'&chk_tur='+chk_tur+'&t1='+t1+'&t2='+t2+'&t3='+t3+'&nt1='+nt1+'&nt2='+nt2+'&nt3='+nt3+'&avgtur='+avgtur+'&chk_pla='+chk_pla+'&pla1='+pla1+'&pla2='+pla2+'&pla3='+pla3+'&plb1='+plb1+'&plb2='+plb2+'&plb3='+plb3+'&plc1='+plc1+'&plc2='+plc2+'&plc3='+plc3+'&pld1='+pld1+'&pld2='+pld2+'&pld3='+pld3+'&pl1='+pl1+'&pl2='+pl2+'&pl3='+pl3+'&avgpla='+avgpla+'&chk_tla='+chk_tla+'&tla1='+tla1+'&tla2='+tla2+'&tla3='+tla3+'&tlb1='+tlb1+'&tlb2='+tlb2+'&tlb3='+tlb3+'&tlc1='+tlc1+'&tlc2='+tlc2+'&tlc3='+tlc3+'&tld1='+tld1+'&tld2='+tld2+'&tld3='+tld3+'&tl1='+tl1+'&tl2='+tl2+'&tl3='+tl3+'&avgtla='+avgtla+'&chk_bic='+chk_bic+'&chk_car='+chk_car+'&avgsample='+avgsample+'&avghyd='+avghyd+'&avgcar='+avgcar+'&avgbic='+avgbic+'&chk_hrd='+chk_hrd+'&hra1='+hra1+'&hra2='+hra2+'&hra3='+hra3+'&hrb1='+hrb1+'&hrb2='+hrb2+'&hrb3='+hrb3+'&hrc1='+hrc1+'&hrc2='+hrc2+'&hrc3='+hrc3+'&hrd1='+hrd1+'&hrd2='+hrd2+'&hrd3='+hrd3+'&hr1='+hr1+'&hr2='+hr2+'&hr3='+hr3+'&avghr='+avghr+'&hrcf='+hrcf+'&chk_cal='+chk_cal+'&caa1='+caa1+'&caa2='+caa2+'&caa3='+caa3+'&cab1='+cab1+'&cab2='+cab2+'&cab3='+cab3+'&cac1='+cac1+'&cac2='+cac2+'&cac3='+cac3+'&cad1='+cad1+'&cad2='+cad2+'&cad3='+cad3+'&ca1='+ca1+'&ca2='+ca2+'&ca3='+ca3+'&avgca='+avgca+'&chk_mag='+chk_mag+'&avgmag='+avgmag+'&chk_chl='+chk_chl+'&cha1='+cha1+'&cha2='+cha2+'&cha3='+cha3+'&chb1='+chb1+'&chb2='+chb2+'&chb3='+chb3+'&chc1='+chc1+'&chc2='+chc2+'&chc3='+chc3+'&chd1='+chd1+'&chd2='+chd2+'&chd3='+chd3+'&ch1='+ch1+'&ch2='+ch2+'&ch3='+ch3+'&avgch='+avgch+'&chk_sul='+chk_sul+'&sua1='+sua1+'&sua2='+sua2+'&sua3='+sua3+'&sub1='+sub1+'&sub2='+sub2+'&sub3='+sub3+'&suc1='+suc1+'&suc2='+suc2+'&suc3='+suc3+'&sud1='+sud1+'&sud2='+sud2+'&sud3='+sud3+'&su1='+su1+'&su2='+su2+'&su3='+su3+'&avgsu='+avgsu+'&chk_tds='+chk_tds+'&tda1='+tda1+'&tda2='+tda2+'&tda3='+tda3+'&tdb1='+tdb1+'&tdb2='+tdb2+'&tdb3='+tdb3+'&tdc1='+tdc1+'&tdc2='+tdc2+'&tdc3='+tdc3+'&tdd1='+tdd1+'&tdd2='+tdd2+'&tdd3='+tdd3+'&td1='+td1+'&td2='+td2+'&td3='+td3+'&avgtd='+avgtd+'&chk_con='+chk_con+'&con1='+con1+'&con2='+con2+'&con3='+con3+'&cos1='+cos1+'&cos2='+cos2+'&cos3='+cos3+'&avgcon='+avgcon+'&chk_col='+chk_col+'&avgcol='+avgcol+'&chk_tas='+chk_tas+'&avgtas='+avgtas+'&chk_odo='+chk_odo+'&avgodo='+avgodo+'&chk_ins='+chk_ins+'&avgins='+avgins+'&chk_spg='+chk_spg+'&avgspg='+avgspg+'&chk_alu='+chk_alu+'&avgalu='+avgalu+'&chk_amm='+chk_amm+'&avgamm='+avgamm+'&chk_ani='+chk_ani+'&avgani='+avgani+'&chk_bar='+chk_bar+'&avgbar='+avgbar+'&chk_bor='+chk_bor+'&avgbor='+avgbor+'&chk_cra='+chk_cra+'&avgcra='+avgcra+'&chk_flu='+chk_flu+'&avgflu='+avgflu+'&chk_frc='+chk_frc+'&avgfrc='+avgfrc+'&chk_iro='+chk_iro+'&avgiro='+avgiro+'&chk_man='+chk_man+'&avgman='+avgman+'&chk_min='+chk_min+'&avgmin='+avgmin+'&chk_nit='+chk_nit+'&avgnit='+avgnit+'&chk_phe='+chk_phe+'&avgphe='+avgphe+'&chk_sel='+chk_sel+'&avgsel='+avgsel+'&chk_sil='+chk_sil+'&avgsil='+avgsil+'&chk_spd='+chk_spd+'&avgspd='+avgspd+'&chk_zin='+chk_zin+'&avgzin='+avgzin+'&chk_cop='+chk_cop+'&avgcop='+avgcop+'&chk_lea='+chk_lea+'&avglea='+avglea+'&chk_cyn='+chk_cyn+'&avgcyn='+avgcyn+'&chk_tot='+chk_tot+'&avgtot='+avgtot+'&chk_cad='+chk_cad+'&avgcad='+avgcad+'&chk_bec='+chk_bec+'&avgbec='+avgbec+'&chk_eco='+chk_eco+'&avgeco='+avgeco+'&ulr='+ulr;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_water_span_d.php',
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
        url: '<?php echo $base_url; ?>save_water_span_d.php',
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
				
				//phv
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phv")
					{
						
						var chk_phv = data.chk_phv;
						if(chk_phv=="1")
						{
							$('#txtphv').css("background-color","var(--primary)");	
						   $("#chk_phv").prop("checked", true); 
						 
						}else{
							$('#txtphv').css("background-color","white");	
							$("#chk_phv").prop("checked", false);
						
						}
						
								
						$('#p1').val(data.p1);
						$('#p2').val(data.p2);
						$('#p3').val(data.p3);
						$('#pa1').val(data.pa1);
						$('#pa2').val(data.pa2);
						$('#pa3').val(data.pa3);
						$('#ph1').val(data.ph1);
						$('#ph2').val(data.ph2);
						$('#ph3').val(data.ph3);
						$('#avgp').val(data.avgp);
						
						
						break;
					}
					else
					{
						
					}
														
				}
			
				//tur
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tur")
					{
						
						var chk_tur = data.chk_tur;
						if(chk_tur=="1")
						{
							$('#txttur').css("background-color","var(--primary)");	
						   $("#chk_tur").prop("checked", true); 
						 
						}else{
							$('#txttur').css("background-color","white");	
							$("#chk_tur").prop("checked", false);
						
						}
						
								
						$('#t1').val(data.t1);
						$('#t2').val(data.t2);
						$('#t3').val(data.t3);
						$('#nt1').val(data.nt1);
						$('#nt2').val(data.nt2);
						$('#nt3').val(data.nt3);
						$('#avgtur').val(data.avgtur);
						
						
						break;
					}
					else
					{
						
					}
														
				}
				
				
				
				//pla 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pla")
					{	var chk_pla = data.chk_pla;
							if(chk_pla=="1")
							{
								$('#txtpla').css("background-color","var(--primary)");	
							   $("#chk_pla").prop("checked", true); 
							}else{
								$('#txtpla').css("background-color","white");	
								$("#chk_pla").prop("checked", false); 
							}
						//specific gravity
						
						$('#pla1').val(data.pla1);
						$('#pla2').val(data.pla2);
						$('#pla3').val(data.pla3);
						$('#plb1').val(data.plb1);
						$('#plb2').val(data.plb2);	
						$('#plb3').val(data.plb3);	
						$('#plc1').val(data.plc1);
						$('#plc2').val(data.plc2);	
						$('#plc3').val(data.plc3);	
						$('#pld1').val(data.pld1);
						$('#pld2').val(data.pld2);		
						$('#pld3').val(data.pld3);		
						$('#pl1').val(data.pl1);
						$('#pl2').val(data.pl2);														
						$('#pl3').val(data.pl3);														
						$('#avgpla').val(data.avgpla); 
						break;
					}
					else
					{
						
					}
				
				}
				
				//tla
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tla")
					{	var chk_tla = data.chk_tla;
							if(chk_tla=="1")
							{
								$('#txttla').css("background-color","var(--primary)");	
							   $("#chk_tla").prop("checked", true); 
							}else{
								$('#txttla').css("background-color","white");	
								$("#chk_tla").prop("checked", false); 
							}
						//specific gravity
						
						$('#tla1').val(data.tla1);
						$('#tla2').val(data.tla2);
						$('#tla3').val(data.tla3);
						$('#tlb1').val(data.tlb1);
						$('#tlb2').val(data.tlb2);	
						$('#tlb3').val(data.tlb3);	
						$('#tlc1').val(data.tlc1);
						$('#tlc2').val(data.tlc2);	
						$('#tlc3').val(data.tlc3);	
						$('#tld1').val(data.tld1);
						$('#tld2').val(data.tld2);		
						$('#tld3').val(data.tld3);		
						$('#tl1').val(data.tl1);
						$('#tl2').val(data.tl2);														
						$('#tl3').val(data.tl3);														
						$('#avgtla').val(data.avgtla); 
						break;
					}
					else
					{
						
					}
				
				}
				
				//tla
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tla")
					{	var chk_tla = data.chk_tla;
							if(chk_tla=="1")
							{
								$('#txttla').css("background-color","var(--primary)");	
							   $("#chk_tla").prop("checked", true); 
							}else{
								$('#txttla').css("background-color","white");	
								$("#chk_tla").prop("checked", false); 
							}
						//specific gravity
						
						$('#tla1').val(data.tla1);
						$('#tla2').val(data.tla2);
						$('#tla3').val(data.tla3);
						$('#tlb1').val(data.tlb1);
						$('#tlb2').val(data.tlb2);	
						$('#tlb3').val(data.tlb3);	
						$('#tlc1').val(data.tlc1);
						$('#tlc2').val(data.tlc2);	
						$('#tlc3').val(data.tlc3);	
						$('#tld1').val(data.tld1);
						$('#tld2').val(data.tld2);		
						$('#tld3').val(data.tld3);		
						$('#tl1').val(data.tl1);
						$('#tl2').val(data.tl2);														
						$('#tl3').val(data.tl3);														
						$('#avgtla').val(data.avgtla); 
						break;
					}
					else
					{
						
					}
				
				}

				//bic 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bic")
					{	var chk_bic = data.chk_bic;
							if(chk_bic=="1")
							{
								$('#txtbic').css("background-color","var(--primary)");	
							   $("#chk_bic").prop("checked", true); 
							}else{
								$('#txtbic').css("background-color","white");	
								$("#chk_bic").prop("checked", false); 
							}
						//specific gravity
						
						$('#avgsample').val(data.avgsample);
						$('#avghyd').val(data.avghyd);
						$('#avgcar').val(data.avgcar);
						$('#avgbic').val(data.avgbic);	
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//hrd
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="hrd")
					{	var chk_hrd = data.chk_hrd;
							if(chk_hrd=="1")
							{
								$('#txthrd').css("background-color","var(--primary)");	
							   $("#chk_hrd").prop("checked", true); 
							}else{
								$('#txthrd').css("background-color","white");	
								$("#chk_hrd").prop("checked", false); 
							}
						//specific gravity
						
						$('#hra1').val(data.hra1);
						$('#hra2').val(data.hra2);
						$('#hra3').val(data.hra3);
						$('#hrb1').val(data.hrb1);
						$('#hrb2').val(data.hrb2);	
						$('#hrb3').val(data.hrb3);	
						$('#hrc1').val(data.hrc1);
						$('#hrc2').val(data.hrc2);	
						$('#hrc3').val(data.hrc3);	
						$('#hrd1').val(data.hrd1);
						$('#hrd2').val(data.hrd2);		
						$('#hrd3').val(data.hrd3);		
						$('#hr1').val(data.hr1);
						$('#hr2').val(data.hr2);														
						$('#hr3').val(data.hr3);														
						$('#avghr').val(data.avghr); 
						$('#hrcf').val(data.hrcf); 
						break;
					}
					else
					{
						
					}
				
				}



				//cal
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cal")
					{	var chk_cal = data.chk_cal;
							if(chk_cal=="1")
							{
								$('#txtcal').css("background-color","var(--primary)");	
							   $("#chk_cal").prop("checked", true); 
							}else{
								$('#txtcal').css("background-color","white");	
								$("#chk_cal").prop("checked", false); 
							}
						//specific gravity
						
						$('#cla1').val(data.cla1);
						$('#cla2').val(data.cla2);
						$('#cla3').val(data.cla3);
						$('#clb1').val(data.clb1);
						$('#clb2').val(data.clb2);	
						$('#clb3').val(data.clb3);	
						$('#clc1').val(data.clc1);
						$('#clc2').val(data.clc2);	
						$('#clc3').val(data.clc3);	
						$('#cld1').val(data.cld1);
						$('#cld2').val(data.cld2);		
						$('#cld3').val(data.cld3);		
						$('#cl1').val(data.cl1);
						$('#cl2').val(data.cl2);														
						$('#cl3').val(data.cl3);														
						$('#avgca').val(data.avgca); 
						break;
					}
					else
					{
						
					}
				
				}
				
				
				
				
				//mag 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mag")
					{	var chk_mag = data.chk_mag;
							if(chk_mag=="1")
							{
								$('#txtmag').css("background-color","var(--primary)");	
							   $("#chk_mag").prop("checked", true); 
							}else{
								$('#txtmag').css("background-color","white");	
								$("#chk_mag").prop("checked", false); 
							}
						//specific gravity
						
																				
						$('#avgmag').val(data.avgmag); 
						break;
					}
					else
					{
						
					}
				
				}
				
				//chl
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="chl")
					{	var chk_chl = data.chk_chl;
							if(chk_chl=="1")
							{
								$('#txtchl').css("background-color","var(--primary)");	
							   $("#chk_chl").prop("checked", true); 
							}else{
								$('#txtchl').css("background-color","white");	
								$("#chk_chl").prop("checked", false); 
							}
						//specific gravity
						
						$('#cha1').val(data.cha1);
						$('#cha2').val(data.cha2);
						$('#cha3').val(data.cha3);
						$('#chb1').val(data.chb1);
						$('#chb2').val(data.chb2);	
						$('#chb3').val(data.chb3);	
						$('#chc1').val(data.chc1);
						$('#chc2').val(data.chc2);	
						$('#chc3').val(data.chc3);	
						$('#chd1').val(data.chd1);
						$('#chd2').val(data.chd2);		
						$('#chd3').val(data.chd3);		
						$('#ch1').val(data.ch1);
						$('#ch2').val(data.ch2);														
						$('#ch3').val(data.ch3);														
						$('#avgch').val(data.avgch); 
						break;
					}
					else
					{
						
					}
				
				}
				
				//sul
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sul")
					{	var chk_sul = data.chk_sul;
							if(chk_sul=="1")
							{
								$('#txtsul').css("background-color","var(--primary)");	
							   $("#chk_sul").prop("checked", true); 
							}else{
								$('#txtsul').css("background-color","white");	
								$("#chk_sul").prop("checked", false); 
							}
						//specific gravity
						
						$('#sua1').val(data.sua1);
						$('#sua2').val(data.sua2);
						$('#sua3').val(data.sua3);
						$('#sub1').val(data.sub1);
						$('#sub2').val(data.sub2);	
						$('#sub3').val(data.sub3);	
						$('#suc1').val(data.suc1);
						$('#suc2').val(data.suc2);	
						$('#suc3').val(data.suc3);	
						$('#sud1').val(data.sud1);
						$('#sud2').val(data.sud2);		
						$('#sud3').val(data.sud3);		
						$('#su1').val(data.su1);
						$('#su2').val(data.su2);														
						$('#su3').val(data.su3);														
						$('#avgsu').val(data.avgsu); 
						break;
					}
					else
					{
						
					}
				
				}
				
				//tds
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tds")
					{	var chk_tds = data.chk_tds;
							if(chk_tds=="1")
							{
								$('#txttds').css("background-color","var(--primary)");	
							   $("#chk_tds").prop("checked", true); 
							}else{
								$('#txttds').css("background-color","white");	
								$("#chk_tds").prop("checked", false); 
							}
						//specific gravity
						
						$('#tda1').val(data.tda1);
						$('#tda2').val(data.tda2);
						$('#tda3').val(data.tda3);
						$('#tdb1').val(data.tdb1);
						$('#tdb2').val(data.tdb2);	
						$('#tdb3').val(data.tdb3);	
						$('#tdc1').val(data.tdc1);
						$('#tdc2').val(data.tdc2);	
						$('#tdc3').val(data.tdc3);	
						$('#tdd1').val(data.tdd1);
						$('#tdd2').val(data.tdd2);		
						$('#tdd3').val(data.tdd3);		
						$('#td1').val(data.td1);
						$('#td2').val(data.td2);														
						$('#td3').val(data.td3);														
						$('#avgtd').val(data.avgtd); 
						break;
					}
					else
					{
						
					}
				
				}
				
				
				
	
				//con 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="con")
					{	var chk_con = data.chk_con;
							if(chk_con=="1")
							{
								$('#txtcon').css("background-color","var(--primary)");	
							   $("#chk_con").prop("checked", true); 
							}else{
								$('#txtcon').css("background-color","white");	
								$("#chk_con").prop("checked", false); 
							}
						
						
						$('#con1').val(data.con1);
						$('#con2').val(data.con2);
						$('#con3').val(data.con3);
						$('#cos1').val(data.cos1);	
						$('#cos2').val(data.cos2);
						$('#cos3').val(data.cos3);	
						$('#avgcon').val(data.avgcon);
						
						break;
					}
					else
					{
						
					}
				
				}
				
				
				//col 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="col")
					{	var chk_col = data.chk_col;
							if(chk_col=="1")
							{
								$('#txtcol').css("background-color","var(--primary)");	
							   $("#chk_col").prop("checked", true); 
							}else{
								$('#txtcol').css("background-color","white");	
								$("#chk_col").prop("checked", false); 
							}
						
						
																				
						$('#avgcol').val(data.avgcol); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//tas 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tas")
					{	var chk_tas = data.chk_tas;
							if(chk_tas=="1")
							{
								$('#txttas').css("background-color","var(--primary)");	
							   $("#chk_tas").prop("checked", true); 
							}else{
								$('#txttas').css("background-color","white");	
								$("#chk_tas").prop("checked", false); 
							}
						
						
																				
						$('#avgtas').val(data.avgtas); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//odo 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="odo")
					{	var chk_odo = data.chk_odo;
							if(chk_odo=="1")
							{
								$('#txtodo').css("background-color","var(--primary)");	
							   $("#chk_odo").prop("checked", true); 
							}else{
								$('#txtodo').css("background-color","white");	
								$("#chk_odo").prop("checked", false); 
							}
						
						
																				
						$('#avgodo').val(data.avgodo); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//ins 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ins")
					{	var chk_ins = data.chk_ins;
							if(chk_ins=="1")
							{
								$('#txtins').css("background-color","var(--primary)");	
							   $("#chk_ins").prop("checked", true); 
							}else{
								$('#txtins').css("background-color","white");	
								$("#chk_ins").prop("checked", false); 
							}
						
						
																				
						$('#avgins').val(data.avgins); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//spg 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spg")
					{	var chk_spg = data.chk_spg;
							if(chk_spg=="1")
							{
								$('#txtspg').css("background-color","var(--primary)");	
							   $("#chk_spg").prop("checked", true); 
							}else{
								$('#txtspg').css("background-color","white");	
								$("#chk_spg").prop("checked", false); 
							}
						
						
																				
						$('#avgspg').val(data.avgspg); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//alu 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="alu")
					{	var chk_alu = data.chk_alu;
							if(chk_alu=="1")
							{
								$('#txtalu').css("background-color","var(--primary)");	
							   $("#chk_alu").prop("checked", true); 
							}else{
								$('#txtalu').css("background-color","white");	
								$("#chk_alu").prop("checked", false); 
							}
						
						
																				
						$('#avgalu').val(data.avgalu); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//amm 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="amm")
					{	var chk_amm = data.chk_amm;
							if(chk_amm=="1")
							{
								$('#txtamm').css("background-color","var(--primary)");	
							   $("#chk_amm").prop("checked", true); 
							}else{
								$('#txtamm').css("background-color","white");	
								$("#chk_amm").prop("checked", false); 
							}
						
						
																				
						$('#avgamm').val(data.avgamm); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//ani 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ani")
					{	var chk_ani = data.chk_ani;
							if(chk_ani=="1")
							{
								$('#txtani').css("background-color","var(--primary)");	
							   $("#chk_ani").prop("checked", true); 
							}else{
								$('#txtani').css("background-color","white");	
								$("#chk_ani").prop("checked", false); 
							}
						
						
																				
						$('#avgani').val(data.avgani); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//bar 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bar")
					{	var chk_bar = data.chk_bar;
							if(chk_bar=="1")
							{
								$('#txtbar').css("background-color","var(--primary)");	
							   $("#chk_bar").prop("checked", true); 
							}else{
								$('#txtbar').css("background-color","white");	
								$("#chk_bar").prop("checked", false); 
							}
						
						
																				
						$('#avgbar').val(data.avgbar); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//bor 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bor")
					{	var chk_bor = data.chk_bor;
							if(chk_bor=="1")
							{
								$('#txtbor').css("background-color","var(--primary)");	
							   $("#chk_bor").prop("checked", true); 
							}else{
								$('#txtbor').css("background-color","white");	
								$("#chk_bor").prop("checked", false); 
							}
						
						
																				
						$('#avgbor').val(data.avgbor); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//cra 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cra")
					{	var chk_cra = data.chk_cra;
							if(chk_cra=="1")
							{
								$('#txtcra').css("background-color","var(--primary)");	
							   $("#chk_cra").prop("checked", true); 
							}else{
								$('#txtcra').css("background-color","white");	
								$("#chk_cra").prop("checked", false); 
							}
						
						
																				
						$('#avgcra').val(data.avgcra); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//flu 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flu")
					{	var chk_flu = data.chk_flu;
							if(chk_flu=="1")
							{
								$('#txtflu').css("background-color","var(--primary)");	
							   $("#chk_flu").prop("checked", true); 
							}else{
								$('#txtflu').css("background-color","white");	
								$("#chk_flu").prop("checked", false); 
							}
						
						
																				
						$('#avgflu').val(data.avgflu); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//frc 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="frc")
					{	var chk_frc = data.chk_frc;
							if(chk_frc=="1")
							{
								$('#txtfrc').css("background-color","var(--primary)");	
							   $("#chk_frc").prop("checked", true); 
							}else{
								$('#txtfrc').css("background-color","white");	
								$("#chk_frc").prop("checked", false); 
							}
						
						
																				
						$('#avgfrc').val(data.avgfrc); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//iro 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="iro")
					{	var chk_iro = data.chk_iro;
							if(chk_iro=="1")
							{
								$('#txtiro').css("background-color","var(--primary)");	
							   $("#chk_iro").prop("checked", true); 
							}else{
								$('#txtiro').css("background-color","white");	
								$("#chk_iro").prop("checked", false); 
							}
						
						
																				
						$('#avgiro').val(data.avgiro); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//man 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="man")
					{	var chk_man = data.chk_man;
							if(chk_man=="1")
							{
								$('#txtman').css("background-color","var(--primary)");	
							   $("#chk_man").prop("checked", true); 
							}else{
								$('#txtman').css("background-color","white");	
								$("#chk_man").prop("checked", false); 
							}
						
						
																				
						$('#avgman').val(data.avgman); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//min 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="min")
					{	var chk_min = data.chk_min;
							if(chk_min=="1")
							{
								$('#txtmin').css("background-color","var(--primary)");	
							   $("#chk_min").prop("checked", true); 
							}else{
								$('#txtmin').css("background-color","white");	
								$("#chk_min").prop("checked", false); 
							}
						
						
																				
						$('#avgmin').val(data.avgmin); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//nit 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="nit")
					{	var chk_nit = data.chk_nit;
							if(chk_nit=="1")
							{
								$('#txtnit').css("background-color","var(--primary)");	
							   $("#chk_nit").prop("checked", true); 
							}else{
								$('#txtnit').css("background-color","white");	
								$("#chk_nit").prop("checked", false); 
							}
						
						
																				
						$('#avgnit').val(data.avgnit); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//phe 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="phe")
					{	var chk_phe = data.chk_phe;
							if(chk_phe=="1")
							{
								$('#txtphe').css("background-color","var(--primary)");	
							   $("#chk_phe").prop("checked", true); 
							}else{
								$('#txtphe').css("background-color","white");	
								$("#chk_phe").prop("checked", false); 
							}
						
						
																				
						$('#avgphe').val(data.avgphe); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//sel 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sel")
					{	var chk_sel = data.chk_sel;
							if(chk_sel=="1")
							{
								$('#txtsel').css("background-color","var(--primary)");	
							   $("#chk_sel").prop("checked", true); 
							}else{
								$('#txtsel').css("background-color","white");	
								$("#chk_sel").prop("checked", false); 
							}
						
						
																				
						$('#avgsel').val(data.avgsel); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//sil 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sil")
					{	var chk_sil = data.chk_sil;
							if(chk_sil=="1")
							{
								$('#txtsil').css("background-color","var(--primary)");	
							   $("#chk_sil").prop("checked", true); 
							}else{
								$('#txtsil').css("background-color","white");	
								$("#chk_sil").prop("checked", false); 
							}
						
						
																				
						$('#avgsil').val(data.avgsil); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//spd 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spd")
					{	var chk_spd = data.chk_spd;
							if(chk_spd=="1")
							{
								$('#txtspd').css("background-color","var(--primary)");	
							   $("#chk_spd").prop("checked", true); 
							}else{
								$('#txtspd').css("background-color","white");	
								$("#chk_spd").prop("checked", false); 
							}
						
						
																				
						$('#avgspd').val(data.avgspd); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//zin 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="zin")
					{	var chk_zin = data.chk_zin;
							if(chk_zin=="1")
							{
								$('#txtzin').css("background-color","var(--primary)");	
							   $("#chk_zin").prop("checked", true); 
							}else{
								$('#txtzin').css("background-color","white");	
								$("#chk_zin").prop("checked", false); 
							}
						
						
																				
						$('#avgzin').val(data.avgzin); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//cop 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cop")
					{	var chk_cop = data.chk_cop;
							if(chk_cop=="1")
							{
								$('#txtcop').css("background-color","var(--primary)");	
							   $("#chk_cop").prop("checked", true); 
							}else{
								$('#txtcop').css("background-color","white");	
								$("#chk_cop").prop("checked", false); 
							}
						
						
																				
						$('#avgcop').val(data.avgcop); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//lea 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lea")
					{	var chk_lea = data.chk_lea;
							if(chk_lea=="1")
							{
								$('#txtlea').css("background-color","var(--primary)");	
							   $("#chk_lea").prop("checked", true); 
							}else{
								$('#txtlea').css("background-color","white");	
								$("#chk_lea").prop("checked", false); 
							}
						
						
																				
						$('#avglea').val(data.avglea); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				
				//cyn 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cyn")
					{	var chk_cyn = data.chk_cyn;
							if(chk_cyn=="1")
							{
								$('#txtcyn').css("background-color","var(--primary)");	
							   $("#chk_cyn").prop("checked", true); 
							}else{
								$('#txtcyn').css("background-color","white");	
								$("#chk_cyn").prop("checked", false); 
							}
						
						
																				
						$('#avgcyn').val(data.avgcyn); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//tot 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tot")
					{	var chk_tot = data.chk_tot;
							if(chk_tot=="1")
							{
								$('#txttot').css("background-color","var(--primary)");	
							   $("#chk_tot").prop("checked", true); 
							}else{
								$('#txttot').css("background-color","white");	
								$("#chk_tot").prop("checked", false); 
							}
						
						
																				
						$('#avgtot').val(data.avgtot); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//cad 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cad")
					{	var chk_cad = data.chk_cad;
							if(chk_cad=="1")
							{
								$('#txtcad').css("background-color","var(--primary)");	
							   $("#chk_cad").prop("checked", true); 
							}else{
								$('#txtcad').css("background-color","white");	
								$("#chk_cad").prop("checked", false); 
							}
						
						
																				
						$('#avgcad').val(data.avgcad); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//bec 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bec")
					{	var chk_bec = data.chk_bec;
							if(chk_bec=="1")
							{
								$('#txtbec').css("background-color","var(--primary)");	
							   $("#chk_bec").prop("checked", true); 
							}else{
								$('#txtbec').css("background-color","white");	
								$("#chk_bec").prop("checked", false); 
							}
						
						
																				
						$('#avgbec').val(data.avgbec); 
						
						break;
					}
					else
					{
						
					}
				
				}
				
				//eco 
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="eco")
					{	var chk_eco = data.chk_eco;
							if(chk_eco=="1")
							{
								$('#txteco').css("background-color","var(--primary)");	
							   $("#chk_eco").prop("checked", true); 
							}else{
								$('#txteco').css("background-color","white");	
								$("#chk_eco").prop("checked", false); 
							}
						
						
																				
						$('#avgeco').val(data.avgeco); 
						
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