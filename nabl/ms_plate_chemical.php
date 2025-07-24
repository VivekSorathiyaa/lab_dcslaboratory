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
			$job_no_main=$_GET['job_no'];
			
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
					$ms_grade= $row_select4['ms_grade'];
					
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
							<h2  style="text-align:center;">STRUCTURAL STEEL CHEMICAL</h2>
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
											<input type="hidden" class="form-control" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly >
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
								<div class="col-lg-3">
										<div class="form-group">
										 <div class="col-sm-4">
													<label>Amend Date. :</label>
												</div>								 
										  <div class="col-sm-8">
											<input type="text" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
										  </div>
										</div>
									</div>
								<div class="col-lg-3">
									<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Grade.:</label>
										<div class="col-sm-10">
											<select class="form-control" id="grades" name="grades">
																	<option value="">Grade</option>
																	<option value="E 250 A">E 250 A</option>
																	<option value="E 250 BR">E 250 BR</option>
																	<option value="E 250 B0">E 250 B0</option>
																	<option value="E 250 C">E 250 C</option>
																	<option value="E 275 A">E 275 A</option>
																	<option value="E 275 BR">E 275 BR</option>
																	<option value="E 275 B0">E 275 B0</option>
																	<option value="E 275 C">E 275 C</option>
																	<option value="E 300 A">E 300 A</option>
																	<option value="E 300 BR">E 300 BR</option>
																	<option value="E 300 B0">E 300 B0</option>
																	<option value="E 300 C">E 300 C</option>
																	<option value="E 350 A">E 350 A</option>
																	<option value="E 350 BR">E 350 BR</option>
																	<option value="E 350 B0">E 350 B0</option>
																	<option value="E 350 C">E 350 C</option>
																	<option value="E 410 A">E 410 A</option>
																	<option value="E 410 BR">E 410 BR</option>
																	<option value="E 410 B0">E 410 B0</option>
																	<option value="E 410 C">E 410 C</option>
																	<option value="E 450 A">E 450 A</option>
																	<option value="E 450 BR">E 450 BR</option>
																	<option value="E 550 A">E 550 A</option>
																	<option value="E 550 BR">E 550 BR</option>
																	<option value="E 600 A">E 600 A</option>
																	<option value="E 600 BR">E 600 BR</option>
																	<option value="E 650 A">E 650 A</option>
																	<option value="E 650 BR">E 650 BR</option>
																	
																	
											</select>
											<input type="text" class="form-control inputs" tabindex="4" id="ms_grade" value="<?php echo $ms_grade;?>" name="ms_grade" ReadOnly>
											
										</div>
									</div>
								</div>
							</div>
							
							<br>
						
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
												$querys_job1 = "SELECT * FROM ms_plate_chemical WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
										$val =  $_SESSION['isadmin'];
										
										?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_ms_plate_chemical.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>
										
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_ms_plate_chemical.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
											
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
	if(mysqli_num_rows($result_upload)>0){ ?>
		
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
									<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no;?>&&reports_nos=<?php echo $report_no;?>">Row Data</a>
								</div>
								<div class="col-sm-4">
									<label for="inputEmail3" class="col-sm-12 control-label">Upload Excel :</label>
								</div>
								<div class="col-sm-4">
									<input type="file" class="form-control" id="upload_excel" name="upload_excel" >
								</div>
								<div class="col-sm-4">
									<button type="button" class="btn btn-info pull-right" id="btn_upload_excel" name="btn_upload_excel" tabindex="14" >Upload</button>
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
									if (mysqli_num_rows($result_file) > 0)
									{
										while($r_file = mysqli_fetch_array($result_file))
										{
										?>
										<tr>
											<td><a href="<?php echo $base_url.$r_file['excel_sheet'];?>" download><?php echo $r_file['excel_sheet'];?></a></td>
											<td><a href="javascript:void(0);" class="delete_excels" data-id="<?php echo $r_file['id'];?>">Delete</a></td>
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
	<br>
		<?php }	 ?>	  	

							<?php
					$test_check;
					$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
						$result_select1 = mysqli_query($conn, $select_query1);
						while($r1 = mysqli_fetch_array($result_select1)){
							$test_check.=$r1['test_code'].",";
							if($r1['test_code']=="yld")
							{
								
								//$test_check.="dia,";
			?>
						<div class="panel panel-default" id="dia">
					<div class="panel-heading" id="txtdia"><h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
								<h4 class="panel-title">
								<b>PHYSICAL TEST</b>
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
													<label for="chk_dia">1.</label>
													<input type="checkbox" class="visually-hidden" name="chk_dia"  id="chk_dia" value="chk_dia"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">PHYSICAL TEST</label>
										</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
											<div class="col-sm-8">
												<label for="inputEmail3" class="col-sm-12 control-label label-right">Actual Thickness / Diameter</label>
												<input type="text" class="form-control" id="tube_temp" name="tube_temp" >
												<input type="hidden" class="form-control" id="tube_humidity" name="tube_humidity" >
											</div>
									</div>
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-12">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Overall Dimension</label>
										</div>
									</div>
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Length (mm)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="l1" name="l1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Width (mm)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="w1" name="w1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Thickness (mm)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="t1" name="t1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Outer Diameter</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="out1" name="out1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-12">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Test Parameter</label>
										</div>
									</div>
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight (kg)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="weight1" name="weight1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Length (mm)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="len1" name="len1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Mass/meter (kg/m)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="mass1" name="mass1" readonly>
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Dia. (mm)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="dia1" name="dia1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Width (mm)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="width1" name="width1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Thickness (mm)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="thk1" name="thk1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Area (mm<sup>2</sup>)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="area1" name="area1" readonly>
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Yield Load (kN)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="load1" name="load1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Yield stress (N/mm<sup>2</sup>)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="str1" name="str1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Ultimate Load (kN)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="ult1" name="ult1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Ultimate Tensile Strength (N/mm<sup>2</sup>)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="ten1" name="ten1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Initial Gauge Length (mm)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="initial1" name="initial1" readonly>
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Final Gauge Length (mm)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="final1" name="final1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>	
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Elongation (%)</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="elo1" name="elo1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Location Of Fracture</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="location1" name="location1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Bend Test</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" id="bend1" name="bend1" >
										</div>
									</div>									
									
									
								</div>
								
							</div>


						</div>
							
								
							
							<br>
							
							
								
						
						</div>
				  
				
		
					</div>	
			<?php }
			
				if($r1['test_code']=="oes")
							{
								$test_check.="oes,";
								
								?>
			<div class="panel panel-default" id="chem">
									<div class="panel-heading" id="txtchem">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
												<h4 class="panel-title">
												<b>CHEMICAL PROPERTIES</b>
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
										<div class="col-lg-8">
												<div class="form-group">
														<div class="col-sm-1">
															<label for="chk_chem">2.</label>
															<input type="checkbox" class="visually-hidden" name="chk_chem"  id="chk_chem" value="chk_chem"><br>
														</div>
													<label for="inputEmail3" class="col-sm-4 control-label label-right">CHEMICAL PROPERTIES</label>
												</div>
											</div>
									</div>
								</div>
							</div>
							
											<br>
								
												<div class="row">
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">C (%)</label>	
															</div>
															
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Si (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Mn (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">P (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">S (%)</label>	
															</div>
															
															
														</div>
													</div>
													
													
													
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Cr (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Mo (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Ni (%)</label>	
															</div>
															
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Cu (%)</label>	
															</div>
															
															
															
														</div>
													</div>
													
													
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Nb (%)</label>	
															</div>
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">V (%)</label>	
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">B (%)</label>	
															</div>
															
														</div>
													</div>
													
												</div>																												
												<br>
												<div class="row">
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c1" name="c1">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c4" name="c4">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c5" name="c5">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c3" name="c3">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c2" name="c2">
															</div>
															
															
														</div>
													</div>
													
													
													
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c6" name="c6">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c9" name="c9">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c8" name="c8">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c7" name="c7">
															</div>
															
															
														</div>
													</div>
												
													
													
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c10" name="c10">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c11" name="c11">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c12" name="c12">
															</div>
															
															
														</div>
													</div>
													
													
												</div>
												<br>
											
											
											
											<div class="row">
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Ti (%)</label>	
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12s control-label" style="text-align:center;">N (%)</label>	
															</div>
															
														</div>
													</div>
												</div>	
												<br>
												<div class="row">
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c13" name="c13">
															</div>
															
															
														</div>
													</div>
													<div class="col-md-1">
													
														<div class="form-group">											
															
															<div class="col-md-12">
															<input type="text" style="text-align:center;width:65px" class="form-control inputs" tabindex="4" id="c14" name="c14">
															</div>
															
															
														</div>
													</div>
												</div>												
								
											
											
											
										</div>
									</div>
								</div>
						
				
		<?php
						}	
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
							  $query = "select * from ms_plate_chemical WHERE lab_no='$aa'  and `is_deleted`='0'";

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
		$('.amend_date').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd'
		});
	 $(function () {
    $('.select2').select2();
  });
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();
	
	function phy_auto(){
		$('#txtdia').css("background-color","var(--success)");
		
		var l1 = $('#l1').val();
		var w1 = $('#w1').val();
		var t1 = $('#t1').val();
		var out1 = $('#out1').val();
		var weight1 = $('#weight1').val();
		var len1 = $('#len1').val();
		
		var mas_1 = (+weight1) / (+len1);
		$('#mass1').val(mas_1.toFixed(3));
		var mass1 = $('#mass1').val();
		
		var dia1 = $('#dia1').val();
		var width1 = $('#width1').val();
		var thk1 = $('#thk1').val();
		
		if(dia1!="")
		{
			var ar1 = (+3.14)/(+4);
			var area_1 = (+ar1) * (+dia1) * (+dia1); 
			
		}
		else
		{
				if(width1!="" && thk1!="")
				{
					var area_1 = (+width1) * (+thk1) ;
				}
				else
				{
					alert("Please Enter First Dia Or Width And Thickness..!!");
				}
				
		}
		$('#area1').val(area_1.toFixed(2));
		var area1 = $('#area1').val();	
		var ms_grade = $('#ms_grade').val();
		var tube_temp = $('#tube_temp').val();
		
		if(ms_grade=="E 250 A" || ms_grade=="E 250 BR" || ms_grade=="E 250 B0" || ms_grade=="E 250 C")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(275,310).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(275,310).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(275,310).toFixed();
			}
		}
		else if(ms_grade=="E 275 A" || ms_grade=="E 275 BR" || ms_grade=="E 275 B0" || ms_grade=="E 275 C")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(295,330).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(295,330).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(295,330).toFixed();
			}
		}		
		else if(ms_grade=="E 300 A" || ms_grade=="E 300 BR" || ms_grade=="E 300 B0" || ms_grade=="E 300 C")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(317,350).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(317,350).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(317,350).toFixed();
			}
		}
		else if(ms_grade=="E 350 A" || ms_grade=="E 350 BR" || ms_grade=="E 350 B0" || ms_grade=="E 350 C")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(370,405).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(370,405).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(370,405).toFixed();
			}
		}
		else if(ms_grade=="E 410 A" || ms_grade=="E 410 BR" || ms_grade=="E 410 B0" || ms_grade=="E 410 C")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(417,440).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(417,440).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(417,440).toFixed();
			}
		}
		else if(ms_grade=="E 450 A" || ms_grade=="E 450 BR")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(460,490).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(460,490).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(460,490).toFixed();
			}
		}
		else if(ms_grade=="E 550 A" || ms_grade=="E 550 BR")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(565,600).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(565,600).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(565,600).toFixed();
			}
		}
		else if(ms_grade=="E 600 A" || ms_grade=="E 600 BR")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(612,635).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(612,635).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(612,635).toFixed();
			}
		}
		else if(ms_grade=="E 650 A" || ms_grade=="E 650 BR")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(655,687).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(655,687).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(655,687).toFixed();
			}
		}
		else
		{
			alert("Select Grade First");
		}
		
		$('#str1').val(str1);
		var str_1 = $('#str1').val();
		
		
		
		
		if(ms_grade=="E 250 A" || ms_grade=="E 250 BR" || ms_grade=="E 250 B0" || ms_grade=="E 250 C")
		{			
			var ten1 = randomNumberFromRange(425,460).toFixed();
			var elo1 = randomNumberFromRange(24,32).toFixed();
		}
		else if(ms_grade=="E 275 A" || ms_grade=="E 275 BR" || ms_grade=="E 275 B0" || ms_grade=="E 275 C")
		{
			var ten1 = randomNumberFromRange(450,485).toFixed();
			var elo1 = randomNumberFromRange(24,32).toFixed();
		}		
		else if(ms_grade=="E 300 A" || ms_grade=="E 300 BR" || ms_grade=="E 300 B0" || ms_grade=="E 300 C")
		{
			var ten1 = randomNumberFromRange(453,485).toFixed();
			var elo1 = randomNumberFromRange(24,28).toFixed();
		}
		else if(ms_grade=="E 350 A" || ms_grade=="E 350 BR" || ms_grade=="E 350 B0" || ms_grade=="E 350 C")
		{
			var ten1 = randomNumberFromRange(503,535).toFixed();
			var elo1 = randomNumberFromRange(23,27).toFixed();
		}
		else if(ms_grade=="E 410 A" || ms_grade=="E 410 BR" || ms_grade=="E 410 B0" || ms_grade=="E 410 C")
		{
			var ten1 = randomNumberFromRange(550,590).toFixed();
			var elo1 = randomNumberFromRange(21,24).toFixed();
		}
		else if(ms_grade=="E 450 A" || ms_grade=="E 450 BR")
		{
			var ten1 = randomNumberFromRange(582,605).toFixed();
			var elo1 = randomNumberFromRange(21,23).toFixed();
		}
		else if(ms_grade=="E 550 A" || ms_grade=="E 550 BR")
		{
			var ten1 = randomNumberFromRange(665,700).toFixed();
			var elo1 = randomNumberFromRange(13,15).toFixed();
		}
		else if(ms_grade=="E 600 A" || ms_grade=="E 600 BR")
		{
			var ten1 = randomNumberFromRange(742,775).toFixed();
			var elo1 = randomNumberFromRange(13,15).toFixed();
		}
		else if(ms_grade=="E 650 A" || ms_grade=="E 650 BR")
		{
			var ten1 = randomNumberFromRange(800,845).toFixed();
			var elo1 = randomNumberFromRange(13,15).toFixed();
		}
		else
		{
			alert("Select Grade First");
		}
		
		$('#ten1').val(ten1);
		$('#elo1').val(elo1);
		var ten_1 = $('#ten1').val();
		var elo_1 = $('#elo1').val();
		
		var load_1 = ((+str_1) * (+area1)) / 1000;
		$('#load1').val(load_1.toFixed(2));
		
		var ult_1 = ((+ten_1) * (+area1)) / 1000;
		$('#ult1').val(ult_1.toFixed(2));
		
		 var initial_1 = ((+5.65) * Math.sqrt(area1));;	
		 $('#initial1').val(initial_1.toFixed());
		 var initial_1=$('#initial1').val();						 
		
		
		var final1 = (((+initial_1)*(+elo_1))/100)+(+initial_1);
		 $('#final1').val(final1.toFixed(2));	
		var final_1 = $('#final1').val();	
			
		
			
			
			$('#location1').val("WGL");
			$('#bend1').val("Satisfactory");
			
		
	}
	
	$('#elo1').change(function(){
		$('#txtdia').css("background-color","var(--success)");
		var elo_1 = $('#elo1').val();
		var initial_1=$('#initial1').val();
		var final1 = (((+initial_1)*(+elo_1))/100)+(+initial_1);
		 $('#final1').val(final1.toFixed(2));	
		var final_1 = $('#final1').val();
	});
	
	$('#weight1,#len1').change(function(){
		$('#txtdia').css("background-color","var(--success)");
		var weight1 = $('#weight1').val();
		var len1 = $('#len1').val();
		var mas_1 = (+weight1) / (+len1);
		$('#mass1').val(mas_1.toFixed(3));
		var mass1 = $('#mass1').val();
	});
	
	$('#load1').change(function(){
		$('#txtdia').css("background-color","var(--success)");
		var load_1 = $('#load1').val();
		var area_1 = $('#area1').val();
		var yeld_s1 = ((+load_1)*1000) / (+area_1);
		$('#str1').val(yeld_s1.toFixed());
		
	});
	
	$('#str1').change(function(){
		$('#txtdia').css("background-color","var(--success)");
		var str_1 = $('#str1').val();
		var area_1 = $('#area1').val();
		var load_1 = ((+str_1) * (+area_1)) / 1000;
		$('#load1').val(load_1.toFixed(2));
		
	});
	
	$('#ult1').change(function(){
		$('#txtdia').css("background-color","var(--success)");
		var ult_1 = $('#ult1').val();
		var area_1 = $('#area1').val();
		var yeld_s11 = ((+ult_1)*1000) / (+area_1);
		$('#ten1').val(yeld_s11.toFixed());
		
	});
	$('#ten1').change(function(){
		$('#txtdia').css("background-color","var(--success)");
		var ten_1 = $('#ten1').val();
		var area_1 = $('#area1').val();
		var ult_1 = ((+ten_1) * (+area_1)) / 1000;
		$('#ult1').val(ult_1.toFixed(2));
		
	});
	
	$('#final1').change(function(){
		$('#txtdia').css("background-color","var(--success)");
		var final_1 = $('#final1').val();
		var initial_1=$('#initial1').val();
		 var eq1 = (+final_1) - (+initial_1);
		 var eq2 = (+eq1) * 100;
		 var elong_1 = (+eq2) / (+initial_1);
		 $('#elo1').val(elong_1.toFixed());
	});
	
	$('#width1,#thk1').change(function(){
		$('#txtdia').css("background-color","var(--success)");
		var thk_1 = $('#thk1').val();
		var width_1=$('#width1').val();
		
		
		var area_1 = (+width_1) * (+thk_1) ;		
		$('#area1').val(area_1.toFixed(2));
		var area1 = $('#area1').val();	
		
		var str_1 = $('#str1').val();
		var ten_1 = $('#ten1').val();
		var elo_1 = $('#elo1').val();
		
		var load_1 = ((+str_1) * (+area1)) / 1000;
		$('#load1').val(load_1.toFixed(2));
		
		var ult_1 = ((+ten_1) * (+area1)) / 1000;
		$('#ult1').val(ult_1.toFixed(2));
		
		 var initial_1 = ((+5.65) * Math.sqrt(area1));;	
		 $('#initial1').val(initial_1.toFixed());
		 var initial_1=$('#initial1').val();						 
		
		
		var final1 = (((+initial_1)*(+elo_1))/100)+(+initial_1);
		 $('#final1').val(final1.toFixed(2));	
		var final_1 = $('#final1').val();
		
	});
	
	
	$('#tube_temp').change(function(){
		$('#txtdia').css("background-color","var(--success)");
		var l1 = $('#l1').val();
		var w1 = $('#w1').val();
		var t1 = $('#t1').val();
		var out1 = $('#out1').val();
		var weight1 = $('#weight1').val();
		var len1 = $('#len1').val();
		
		var mas_1 = (+weight1) / (+len1);
		$('#mass1').val(mas_1.toFixed(3));
		var mass1 = $('#mass1').val();
		
		var dia1 = $('#dia1').val();
		var width1 = $('#width1').val();
		var thk1 = $('#thk1').val();
		
		if(dia1!="")
		{
			var ar1 = (+3.14)/(+4);
			var area_1 = (+ar1) * (+dia1) * (+dia1); 
			
		}
		else
		{
				if(width1!="" && thk1!="")
				{
					var area_1 = (+width1) * (+thk1) ;
				}
				
		}
		$('#area1').val(area_1.toFixed(2));
		var area1 = $('#area1').val();	
		var ms_grade = $('#ms_grade').val();
		var tube_temp = $('#tube_temp').val();
		
		if(ms_grade=="E 250 A" || ms_grade=="E 250 BR" || ms_grade=="E 250 B0" || ms_grade=="E 250 C")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(275,310).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(275,310).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(275,310).toFixed();
			}
		}
		else if(ms_grade=="E 275 A" || ms_grade=="E 275 BR" || ms_grade=="E 275 B0" || ms_grade=="E 275 C")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(295,330).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(295,330).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(295,330).toFixed();
			}
		}		
		else if(ms_grade=="E 300 A" || ms_grade=="E 300 BR" || ms_grade=="E 300 B0" || ms_grade=="E 300 C")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(317,350).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(317,350).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(317,350).toFixed();
			}
		}
		else if(ms_grade=="E 350 A" || ms_grade=="E 350 BR" || ms_grade=="E 350 B0" || ms_grade=="E 350 C")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(370,405).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(370,405).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(370,405).toFixed();
			}
		}
		else if(ms_grade=="E 410 A" || ms_grade=="E 410 BR" || ms_grade=="E 410 B0" || ms_grade=="E 410 C")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(417,440).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(417,440).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(417,440).toFixed();
			}
		}
		else if(ms_grade=="E 450 A" || ms_grade=="E 450 BR")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(460,490).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(460,490).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(460,490).toFixed();
			}
		}
		else if(ms_grade=="E 550 A" || ms_grade=="E 550 BR")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(565,600).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(565,600).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(565,600).toFixed();
			}
		}
		else if(ms_grade=="E 600 A" || ms_grade=="E 600 BR")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(612,635).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(612,635).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(612,635).toFixed();
			}
		}
		else if(ms_grade=="E 650 A" || ms_grade=="E 650 BR")
		{
			if(tube_temp>=0 && tube_temp<20)
			{
				var str1 = randomNumberFromRange(655,687).toFixed();
			}
			else if(tube_temp>=20 && tube_temp<=40)
			{
				var str1 = randomNumberFromRange(655,687).toFixed();
			}
			else if(tube_temp>40)
			{
				var str1 = randomNumberFromRange(655,687).toFixed();
			}
		}
		
		$('#str1').val(str1);
		var str_1 = $('#str1').val();
		
		
		
		
		if(ms_grade=="E 250 A" || ms_grade=="E 250 BR" || ms_grade=="E 250 B0" || ms_grade=="E 250 C")
		{			
			var ten1 = randomNumberFromRange(425,460).toFixed();
			var elo1 = randomNumberFromRange(24,32).toFixed();
		}
		else if(ms_grade=="E 275 A" || ms_grade=="E 275 BR" || ms_grade=="E 275 B0" || ms_grade=="E 275 C")
		{
			var ten1 = randomNumberFromRange(450,485).toFixed();
			var elo1 = randomNumberFromRange(24,32).toFixed();
		}		
		else if(ms_grade=="E 300 A" || ms_grade=="E 300 BR" || ms_grade=="E 300 B0" || ms_grade=="E 300 C")
		{
			var ten1 = randomNumberFromRange(453,485).toFixed();
			var elo1 = randomNumberFromRange(24,28).toFixed();
		}
		else if(ms_grade=="E 350 A" || ms_grade=="E 350 BR" || ms_grade=="E 350 B0" || ms_grade=="E 350 C")
		{
			var ten1 = randomNumberFromRange(503,535).toFixed();
			var elo1 = randomNumberFromRange(23,27).toFixed();
		}
		else if(ms_grade=="E 410 A" || ms_grade=="E 410 BR" || ms_grade=="E 410 B0" || ms_grade=="E 410 C")
		{
			var ten1 = randomNumberFromRange(550,590).toFixed();
			var elo1 = randomNumberFromRange(21,24).toFixed();
		}
		else if(ms_grade=="E 450 A" || ms_grade=="E 450 BR")
		{
			var ten1 = randomNumberFromRange(582,605).toFixed();
			var elo1 = randomNumberFromRange(21,23).toFixed();
		}
		else if(ms_grade=="E 550 A" || ms_grade=="E 550 BR")
		{
			var ten1 = randomNumberFromRange(665,700).toFixed();
			var elo1 = randomNumberFromRange(13,15).toFixed();
		}
		else if(ms_grade=="E 600 A" || ms_grade=="E 600 BR")
		{
			var ten1 = randomNumberFromRange(742,775).toFixed();
			var elo1 = randomNumberFromRange(13,15).toFixed();
		}
		else if(ms_grade=="E 650 A" || ms_grade=="E 650 BR")
		{
			var ten1 = randomNumberFromRange(800,845).toFixed();
			var elo1 = randomNumberFromRange(13,15).toFixed();
		}
		
		$('#ten1').val(ten1);
		$('#elo1').val(elo1);
		var ten_1 = $('#ten1').val();
		var elo_1 = $('#elo1').val();
		
		var load_1 = ((+str_1) * (+area1)) / 1000;
		$('#load1').val(load_1.toFixed(2));
		
		var ult_1 = ((+ten_1) * (+area1)) / 1000;
		$('#ult1').val(ult_1.toFixed(2));
		
		 var initial_1 = ((+5.65) * Math.sqrt(area1));;	
		 $('#initial1').val(initial_1.toFixed());
		 var initial_1=$('#initial1').val();						 
		
		
		var final1 = (((+initial_1)*(+elo_1))/100)+(+initial_1);
		 $('#final1').val(final1.toFixed(2));	
		var final_1 = $('#final1').val();	
			
	});
	

	

	$('#grades').change(function(){
		
		$('#ms_grade').val($('#grades').val());
	});


	$('#chk_dia').change(function(){
        if(this.checked)
		{
			phy_auto();
		}
		else
		{
			$('#txtdia').css("background-color","white");	
			
			
			$('#mass1').val(null);
			$('#area1').val(null);
			$('#load1').val(null);
			$('#str1').val(null);
			$('#ult1').val(null);
			$('#ten1').val(null);
			$('#initial1').val(null);
			$('#final1').val(null);
			$('#elo1').val(null);
			$('#location1').val(null);
			$('#bend1').val(null);
			$('#tube_temp').val(null);
			$('#tube_humidity').val(null);
		}
		
	});
	
	$('#c1').change(function(){
		$('#chk_chem').prop('checked', true);
	});
	
	
	function chem_data()
	{
			$('#txtchem').css("background-color","var(--success)");	
		var ms_grade = $("#ms_grade").val();
		
		if(ms_grade=="E 250 A" || ms_grade=="E 250 BR" || ms_grade=="E 250 B0")
		{			
			var c1 = randomNumberFromRange(0.15,0.21).toFixed(2);
			var c4 = randomNumberFromRange(0.15,0.35).toFixed(2);
			var c5 = randomNumberFromRange(0.50,1.30).toFixed(2);
			var c3 = randomNumberFromRange(0.020,0.043).toFixed(3);
			var c2 = randomNumberFromRange(0.020,0.043).toFixed(3);
			
			var c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
			var c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
			var c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
			var c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
			var c10 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c11 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c13 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
			var c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
		}
		else if(ms_grade=="E 250 C")
		{
			var c1 = randomNumberFromRange(0.12,0.18).toFixed(2);
			var c4 = randomNumberFromRange(0.15,0.35).toFixed(2);
			var c5 = randomNumberFromRange(0.50,1.30).toFixed(2);
			var c3 = randomNumberFromRange(0.020,0.038).toFixed(3);
			var c2 = randomNumberFromRange(0.020,0.038).toFixed(3);
			
			var c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
			var c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
			var c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
			var c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
			var c10 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c11 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c13 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
			var c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
		}
		else if(ms_grade=="E 275 A" || ms_grade=="E 275 BR" || ms_grade=="E 275 B0")
		{
			var c1 = randomNumberFromRange(0.15,0.21).toFixed(2);
			var c4 = randomNumberFromRange(0.15,0.35).toFixed(2);
			var c5 = randomNumberFromRange(0.50,1.30).toFixed(2);
			var c3 = randomNumberFromRange(0.020,0.043).toFixed(3);
			var c2 = randomNumberFromRange(0.020,0.043).toFixed(3);
			
			var c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
			var c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
			var c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
			var c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
			var c10 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c11 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c13 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
			var c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
		}
		else if(ms_grade=="E 275 C")
		{
			var c1 = randomNumberFromRange(0.12,0.18).toFixed(2);
			var c4 = randomNumberFromRange(0.15,0.35).toFixed(2);
			var c5 = randomNumberFromRange(0.50,1.30).toFixed(2);
			var c3 = randomNumberFromRange(0.020,0.038).toFixed(3);
			var c2 = randomNumberFromRange(0.020,0.038).toFixed(3);
			
			var c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
			var c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
			var c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
			var c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
			var c10 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c11 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c13 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
			var c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
		}		
		else if(ms_grade=="E 300 A" || ms_grade=="E 300 BR" || ms_grade=="E 300 B0" || ms_grade=="E 350 A" || ms_grade=="E 350 BR" || ms_grade=="E 350 B0" || ms_grade=="E 410 A" || ms_grade=="E 410 BR" || ms_grade=="E 410 B0")
		{
			var c1 = randomNumberFromRange(0.12,0.18).toFixed(2);
			var c4 = randomNumberFromRange(0.15,0.35).toFixed(2);
			var c5 = randomNumberFromRange(0.50,1.30).toFixed(2);
			var c3 = randomNumberFromRange(0.020,0.043).toFixed(3);
			var c2 = randomNumberFromRange(0.020,0.043).toFixed(3);
			
			var c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
			var c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
			var c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
			var c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
			var c10 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c11 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c13 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
			var c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
		}
		else if(ms_grade=="E 300 C" || ms_grade=="E 350 C" || ms_grade=="E 410 C")
		{
			var c1 = randomNumberFromRange(0.12,0.18).toFixed(2);
			var c4 = randomNumberFromRange(0.15,0.35).toFixed(2);
			var c5 = randomNumberFromRange(0.50,1.30).toFixed(2);
			var c3 = randomNumberFromRange(0.020,0.038).toFixed(3);
			var c2 = randomNumberFromRange(0.020,0.038).toFixed(3);
			
			var c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
			var c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
			var c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
			var c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
			var c10 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c11 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c13 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
			var c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
		}				
		else if(ms_grade=="E 450 A" || ms_grade=="E 450 BR")
		{
			var c1 = randomNumberFromRange(0.15,0.21).toFixed(2);
			var c4 = randomNumberFromRange(0.15,0.35).toFixed(2);
			var c5 = randomNumberFromRange(0.50,1.55).toFixed(2);
			var c3 = randomNumberFromRange(0.020,0.043).toFixed(3);
			var c2 = randomNumberFromRange(0.020,0.043).toFixed(3);
			
			var c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
			var c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
			var c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
			var c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
			var c10 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c11 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c13 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
			var c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
		}
		else if(ms_grade=="E 550 A" || ms_grade=="E 550 BR")
		{
			var c1 = randomNumberFromRange(0.15,0.21).toFixed(2);
			var c4 = randomNumberFromRange(0.15,0.35).toFixed(2);
			var c5 = randomNumberFromRange(0.50,1.55).toFixed(2);
			var c3 = randomNumberFromRange(0.012,0.023).toFixed(3);
			var c2 = randomNumberFromRange(0.010,0.018).toFixed(3);
			
			var c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
			var c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
			var c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
			var c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
			var c10 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c11 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c13 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
			var c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
		}
		else if(ms_grade=="E 600 A" || ms_grade=="E 600 BR")
		{
			var c1 = randomNumberFromRange(0.15,0.21).toFixed(2);
			var c4 = randomNumberFromRange(0.15,0.35).toFixed(2);
			var c5 = randomNumberFromRange(0.50,1.60).toFixed(2);
			var c3 = randomNumberFromRange(0.012,0.023).toFixed(3);
			var c2 = randomNumberFromRange(0.010,0.018).toFixed(3);
			
			var c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
			var c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
			var c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
			var c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
			var c10 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c11 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c13 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
			var c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
		}
		else if(ms_grade=="E 650 A" || ms_grade=="E 650 BR")
		{
			var c1 = randomNumberFromRange(0.15,0.21).toFixed(2);
			var c4 = randomNumberFromRange(0.15,0.35).toFixed(2);
			var c5 = randomNumberFromRange(0.50,1.60).toFixed(2);
			var c3 = randomNumberFromRange(0.012,0.023).toFixed(3);
			var c2 = randomNumberFromRange(0.008,0.013).toFixed(3);
			
			var c6 = randomNumberFromRange(0.030,0.050).toFixed(3);
			var c9 = randomNumberFromRange(0.001,0.002).toFixed(3);
			var c8 = randomNumberFromRange(0.010,0.020).toFixed(3);
			var c7 = randomNumberFromRange(0.005,0.008).toFixed(3);
			
			var c10 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c11 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c13 = randomNumberFromRange(0.10,0.20).toFixed(2);
			var c12 = randomNumberFromRange(0.0002,0.0005).toFixed(4);
			var c14 = randomNumberFromRange(0.005,0.008).toFixed(3);
		}
		
			 $('#c1').val(c1);
			 $('#c2').val(c2);
			 $('#c3').val(c3);
			 $('#c4').val(c4);
			 $('#c5').val(c5);
			 $('#c6').val(c6);
			 $('#c7').val(c7);
			 $('#c8').val(c8);
			 $('#c9').val(c9);
			 $('#c10').val(c10);
			 $('#c11').val(c11);
			 $('#c12').val(c12);
			 $('#c13').val(c13);
			 $('#c14').val(c14);
			 
	}

	$('#chk_chem').change(function(){
        if(this.checked)
		{
			$('#txtchem').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtchem').css("background-color","white");	
		}
		
	});
	
	$('#chk_chem').change(function(){
        if(this.checked)
		{
			
			chem_data();
		}
		else
		{					
			$('#c1').val(null);
			$('#c2').val(null);
			$('#c3').val(null);
			$('#c4').val(null);
			$('#c5').val(null);
			$('#c6').val(null);
			$('#c7').val(null);
			$('#c8').val(null);
			$('#c9').val(null);
			$('#c10').val(null);
			$('#c11').val(null);
			$('#c12').val(null);
			$('#c13').val(null);
			$('#c14').val(null);
			
			
			
		}
		
	});
	
	
	
function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}
	
		
	
	
	
	
	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","var(--success)"); 
			//$('#txtwtr').css("background-color","var(--success)"); 
			
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				
				
				
				//pen
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="yld")
					{
						$('#txtdia').css("background-color","var(--success)"); 
						$("#chk_dia").prop("checked", true); 
						phy_auto();
						break;
					}					
				}
				
				//oes
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="oes")
					{
						$("#chk_chem").prop("checked", true); 
						$("#txtchem").css("background-color","var(--success)");
						
						chem_data();
						break;
					}					
				}
		
		
		}
		
	});
	
	
	
});


	
	
		$("#btn_upload_excel").click(function()
		{
			form_data = new FormData();
				var acb = $('#upload_excel').val();
			if(acb ==""){
				alert("Upload excel First");
				return false;
			}
				var lab_no = "<?php echo $lab_no;?>";
				var job_no = "<?php echo $job_no_main;?>";
				var report_no = "<?php echo $report_no;?>";
				
				var file_data = $('#upload_excel').prop('files')[0];
				var form_data = new FormData();  // Create a FormData object
				form_data.append('file', file_data);  // Append all element in FormData  object
				form_data.append('lab_no', lab_no);  // Append all element in FormData  object
				form_data.append('job_no', job_no);  // Append all element in FormData  object
				form_data.append('report_no', report_no);  // Append all element in FormData  object

				$.ajax({
					url         : '<?php $base_url; ?>excel_upload_test.php',     // point to server-side PHP script 
					dataType    : 'text',           // what to expect back from the PHP script, if anything
					cache       : false,
					contentType : false,
					processData : false,
					data        : form_data,                         
					type        : 'post',
					success     : function(output){
					get_excel_record();            // display response from the PHP script, if any
					}
			 });
			 $('#upload_excel').val('');   
				
			
		});
		function get_excel_record()
		{
			var lab_no = "<?php echo $lab_no;?>";
			var job_no = "<?php echo $job_no_main;?>";
			var report_no = "<?php echo $report_no;?>";
			$.ajax({
				type: 'POST',
				url: '<?php echo $base_url; ?>excel_upload_test.php',
				data: 'action_type=get_excel_record&lab_no='+lab_no+'&job_no='+job_no+'&report_no='+report_no,
				success:function(html){
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
        url: '<?php echo $base_url; ?>save_ms_plate_chemical.php',
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
				var ms_grade = $('#ms_grade').val();				
				var ulr = $('#ulr').val();
				var amend_date = $('#amend_date').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//OUT DIAMETER
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="yld")
					{
						if(document.getElementById('chk_dia').checked) {
								var chk_dia = "1";
						}
						else{
								var	chk_dia = "0";
						}	
							
							var tube_humidity = $('#tube_humidity').val();													
							var tube_temp = $('#tube_temp').val();													
							var l1 = $('#l1').val();
							var w1 = $('#w1').val();
							var t1 = $('#t1').val();
							var out1 = $('#out1').val();
							var weight1 = $('#weight1').val();
							var len1 = $('#len1').val();							
							var dia1 = $('#dia1').val();
							var width1 = $('#width1').val();							
							var area1 = $('#area1').val();
							var load1 = $('#load1').val();							
							var ult1 = $('#ult1').val();							
							var initial1 = $('#initial1').val();
							var final1 = $('#final1').val();							
							var location1 = $('#location1').val();
							
						
						break;
					}
					else
					{
							var chk_dia = "0";
							var tube_humidity = "0";										
							var tube_temp = "0";
							var l1 = "0";
							var w1 = "0";
							var t1 = "0";
							var out1 = "0";
							var weight1 = "0";
							var len1 = "0";							
							var dia1 = "0";
							var width1 = "0";							
							var area1 = "0";
							var load1 = "0";							
							var ult1 = "0";							
							var initial1 = "0";
							var final1 = "0";							
							var location1 = "0";
							
					}
														
				}
				
				//bend
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bnd")
					{
						
							var chk_bend = "1";
						    var bend1 = $('#bend1').val();
						
							
						break;
					}
					else
					{
							var chk_bend = "0";
							var bend1 = "0";
							
					}
														
				}
				
				//elo1
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="elo")
					{
						
							var chk_elo = "1";
						    var elo1 = $('#elo1').val();
						
							
						break;
					}
					else
					{
							var chk_elo = "0";
							var elo1 = "0";
							
					}
														
				}
				//ten
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ten")
					{
						
							var chk_ten = "1";
						    var ten1 = $('#ten1').val();
						
							
						break;
					}
					else
					{
							var chk_ten = "0";
							var ten1 = "0";
							
					}
														
				}
				
				
				//yld
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="yld")
					{
						
							var chk_yled = "1";
						    var str1 = $('#str1').val();
						
							
						break;
					}
					else
					{
							var chk_yled = "0";
							var str1 = "0";
							
					}
														
				}
				
				
				//thk
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="thk")
					{
						
							var chk_thk = "1";
						    var thk1 = $('#thk1').val();
						
							
						break;
					}
					else
					{
							var chk_thk = "0";
							var thk1 = "0";
							
					}
														
				}

				//elo
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="elo")
					{
						
							var chk_elo = "1";
						    var t7 = $('#t7').val();
						
							
						break;
					}
					else
					{
							var chk_elo = "0";
							var t7 = "0";
							
					}
														
				}

				//mas
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mas")
					{
						
							var chk_mass = "1";
						    var mass1 = $('#mass1').val();
						
							
						break;
					}
					else
					{
							var chk_mass = "0";
							var mass1 = "0";
							
					}
														
				}
				
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="oes")
					{
						if(document.getElementById('chk_chem').checked) {
								var chk_chem = "1";
						}
						else{
								var chk_chem = "0";
						}
							
						var c1 = $('#c1').val();
				
						var c2 = $('#c2').val();
						var c3 = $('#c3').val();
						var c4 = $('#c4').val();
						var c5 = $('#c5').val();
						var c6 = $('#c6').val();
						var c7 = $('#c7').val();
						var c8 = $('#c8').val();
						var c9 = $('#c9').val(); 
						var c10 = $('#c10').val();
						var c11 = $('#c11').val();
						var c12 = $('#c12').val();
						var c13 = $('#c13').val();
						var c14 = $('#c14').val();			
						break;
					}
					else
					{
						var c1 = "0";				
						var c2 = "0";
						var c3 = "0";
						var c4 = "0";
						var c5 = "0";
						var c6 = "0";
						var c7 = "0";
						var c8 = "0";
						var c9 = "0";
						var c10 = "0";
						var c11 = "0";
						var c12 = "0";
						var c13 = "0";
						var c14 = "0";
					}
														
				}

				
			
			
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&tube_temp='+tube_temp+'&tube_humidity='+tube_humidity+'&chk_dia='+chk_dia+'&chk_elo='+chk_elo+'&chk_ten='+chk_ten+'&chk_yled='+chk_yled+'&chk_thk='+chk_thk+'&chk_mass='+chk_mass+'&ms_grade='+ms_grade+'&l1='+l1+'&w1='+w1+'&t1='+t1+'&out1='+out1+'&weight1='+weight1+'&len1='+len1+'&mass1='+mass1+'&dia1='+dia1+'&width1='+width1+'&thk1='+thk1+'&area1='+area1+'&load1='+load1+'&str1='+str1+'&ult1='+ult1+'&ten1='+ten1+'&initial1='+initial1+'&final1='+final1+'&elo1='+elo1+'&location1='+location1+'&chk_bend='+chk_bend+'&bend1='+bend1+'&ulr='+ulr+'&chk_chem='+chk_chem+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&c4='+c4+'&c5='+c5+'&c6='+c6+'&c7='+c7+'&c8='+c8+'&c9='+c9+'&c10='+c10+'&c11='+c11+'&c12='+c12+'&c13='+c13+'&c14='+c14+'&amend_date='+amend_date;
						
	}
	else if (type == 'edit'){
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var tube_dia = $('#tube_dia').val();
				var tube_brand = $('#tube_brand').val();				
				var ms_grade = $('#ms_grade').val();						
				var ulr = $('#ulr').val();
				var amend_date = $('#amend_date').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	

				//OUT DIAMETER
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="yld")
					{
						if(document.getElementById('chk_dia').checked) {
								var chk_dia = "1";
						}
						else{
								var	chk_dia = "0";
						}	
							
							var tube_humidity = $('#tube_humidity').val();													
							var tube_temp = $('#tube_temp').val();													
							var l1 = $('#l1').val();
							var w1 = $('#w1').val();
							var t1 = $('#t1').val();
							var out1 = $('#out1').val();
							var weight1 = $('#weight1').val();
							var len1 = $('#len1').val();							
							var dia1 = $('#dia1').val();
							var width1 = $('#width1').val();							
							var area1 = $('#area1').val();
							var load1 = $('#load1').val();							
							var ult1 = $('#ult1').val();							
							var initial1 = $('#initial1').val();
							var final1 = $('#final1').val();							
							var location1 = $('#location1').val();
							
						
						break;
					}
					else
					{
							var chk_dia = "0";
							var tube_humidity = "0";										
							var tube_temp = "0";
							var l1 = "0";
							var w1 = "0";
							var t1 = "0";
							var out1 = "0";
							var weight1 = "0";
							var len1 = "0";							
							var dia1 = "0";
							var width1 = "0";							
							var area1 = "0";
							var load1 = "0";							
							var ult1 = "0";							
							var initial1 = "0";
							var final1 = "0";							
							var location1 = "0";
							
					}
														
				}
				
				//bend
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="bnd")
					{
						
							var chk_bend = "1";
						    var bend1 = $('#bend1').val();
						
							
						break;
					}
					else
					{
							var chk_bend = "0";
							var bend1 = "0";
							
					}
														
				}

				
				//elo1
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="elo")
					{
						
							var chk_elo = "1";
						    var elo1 = $('#elo1').val();
						
							
						break;
					}
					else
					{
							var chk_elo = "0";
							var elo1 = "0";
							
					}
														
				}
				//ten
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ten")
					{
						
							var chk_ten = "1";
						    var ten1 = $('#ten1').val();
						
							
						break;
					}
					else
					{
							var chk_ten = "0";
							var ten1 = "0";
							
					}
														
				}
				
				
				//yld
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="yld")
					{
						
							var chk_yled = "1";
						    var str1 = $('#str1').val();
						
							
						break;
					}
					else
					{
							var chk_yled = "0";
							var str1 = "0";
							
					}
														
				}
				
				
				//thk
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="thk")
					{
						
							var chk_thk = "1";
						    var thk1 = $('#thk1').val();
						
							
						break;
					}
					else
					{
							var chk_thk = "0";
							var thk1 = "0";
							
					}
														
				}

				//elo
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="elo")
					{
						
							var chk_elo = "1";
						    var t7 = $('#t7').val();
						
							
						break;
					}
					else
					{
							var chk_elo = "0";
							var t7 = "0";
							
					}
														
				}

				//mas
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mas")
					{
						
							var chk_mass = "1";
						    var mass1 = $('#mass1').val();
						
							
						break;
					}
					else
					{
							var chk_mass = "0";
							var mass1 = "0";
							
					}
														
				}
				
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="oes")
					{
						if(document.getElementById('chk_chem').checked) {
								var chk_chem = "1";
						}
						else{
								var chk_chem = "0";
						}
							
						var c1 = $('#c1').val();
				
						var c2 = $('#c2').val();
						var c3 = $('#c3').val();
						var c4 = $('#c4').val();
						var c5 = $('#c5').val();
						var c6 = $('#c6').val();
						var c7 = $('#c7').val();
						var c8 = $('#c8').val();
						var c9 = $('#c9').val(); 
						var c10 = $('#c10').val();
						var c11 = $('#c11').val();
						var c12 = $('#c12').val();
						var c13 = $('#c13').val();
						var c14 = $('#c14').val();			
						break;
					}
					else
					{
						var c1 = "0";				
						var c2 = "0";
						var c3 = "0";
						var c4 = "0";
						var c5 = "0";
						var c6 = "0";
						var c7 = "0";
						var c8 = "0";
						var c9 = "0";
						var c10 = "0";
						var c11 = "0";
						var c12 = "0";
						var c13 = "0";
						var c14 = "0";
					}
														
				}

				
			
				
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&tube_temp='+tube_temp+'&tube_humidity='+tube_humidity+'&chk_dia='+chk_dia+'&chk_elo='+chk_elo+'&chk_ten='+chk_ten+'&chk_yled='+chk_yled+'&chk_thk='+chk_thk+'&chk_mass='+chk_mass+'&ms_grade='+ms_grade+'&l1='+l1+'&w1='+w1+'&t1='+t1+'&out1='+out1+'&weight1='+weight1+'&len1='+len1+'&mass1='+mass1+'&dia1='+dia1+'&width1='+width1+'&thk1='+thk1+'&area1='+area1+'&load1='+load1+'&str1='+str1+'&ult1='+ult1+'&ten1='+ten1+'&initial1='+initial1+'&final1='+final1+'&elo1='+elo1+'&location1='+location1+'&chk_bend='+chk_bend+'&bend1='+bend1+'&ulr='+ulr+'&chk_chem='+chk_chem+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&c4='+c4+'&c5='+c5+'&c6='+c6+'&c7='+c7+'&c8='+c8+'&c9='+c9+'&c10='+c10+'&c11='+c11+'&c12='+c12+'&c13='+c13+'&c14='+c14+'&c114='+c14+'&amend_date='+amend_date;
						
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_ms_plate_chemical.php',
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
        url: '<?php echo $base_url; ?>save_ms_plate_chemical.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);                       
            $('#ms_grade').val(data.ms_grade);            
            $('#ulr').val(data.ulr);
			$('#amend_date').val(data.amend_date);
			
            var temp = $('#test_list').val();
				var aa= temp.split(",");				
				//penetration
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="yld")
					{
						
						var chk_dia = data.chk_dia;
						if(chk_dia=="1")
						{
							$('#txtdia').css("background-color","var(--success)");	
						   $("#chk_dia").prop("checked", true); 
						 
						}else{
							$('#txtdia').css("background-color","white");	
							$("#chk_dia").prop("checked", false);
						
						}
						
								//GRADATION DATA FETCH-1
						$('#tube_temp').val(data.tube_temp);
						$('#tube_humidity').val(data.tube_humidity);
						$('#l1').val(data.l1);
						$('#w1').val(data.w1);
						$('#t1').val(data.t1);						
						$('#out1').val(data.out1);
						$('#weight1').val(data.weight1);
						$('#len1').val(data.len1);
						$('#mass1').val(data.mass1);
						$('#dia1').val(data.dia1);
						$('#width1').val(data.width1);
						$('#thk1').val(data.thk1);
						$('#area1').val(data.area1);
						$('#load1').val(data.load1);
						$('#str1').val(data.str1);
						$('#ult1').val(data.ult1);
						$('#ten1').val(data.ten1);
						$('#initial1').val(data.initial1);
						$('#final1').val(data.final1);
						$('#elo1').val(data.elo1);
						$('#location1').val(data.location1);
						$('#bend1').val(data.bend1);
						
						
						
						break;
					}
					else
					{
						
					}
														
				}
				
				//penetration
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="oes")
					{
						
						var chem = data.chk_chem;
						if(chk_dia=="1")
						{
							$('#txtchem').css("background-color","var(--success)");			
							$("#chk_chem").prop("checked", true); 
						 
						}else{
							$('#txtchem').css("background-color","white");	
							$("#chk_chem").prop("checked", false);
						
						}
						
								//GRADATION DATA FETCH-1
						$('#c1').val(data.c1);
						$('#c2').val(data.c2);
						$('#c3').val(data.c3);
						$('#c4').val(data.c4);
						$('#c5').val(data.c5);
						$('#c6').val(data.c6);
						$('#c7').val(data.c7);
						$('#c8').val(data.c8);
						$('#c9').val(data.c9);
						$('#c10').val(data.c10);
						$('#c11').val(data.c11);
						$('#c12').val(data.c12);
						$('#c13').val(data.c13);
						$('#c14').val(data.c14);
						
						
						
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
	
$(document).on("click", ".delete_excels", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Excel?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>excel_upload_test.php',
        data: 'action_type=delete_excels&clicked_id='+clicked_id,
        success:function(html){
			location.reload();
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});	
	</script>