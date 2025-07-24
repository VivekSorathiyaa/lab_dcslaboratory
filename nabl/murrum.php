<?php 
session_start(); 
include("header.php");
include("connection.php");
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
	<!-- STYLE PUT VAIBHAV-->
	<div class="content-wrapper" style="margin-left:0px !important;">
	<!-- Content Header (Page header) -->
		<section class="content common_material p-0">
		<!-- MENU INCLUDE VAIBHAV-->
		<?php include("menu.php") ?>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h2  style="text-align:center;">MURRUM</h2>
						</div>
						<!--<div class="box-default">-->
						<form class="form" id="Glazed" method="post">
							<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">
								<br>
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
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
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
											<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="id" id="idEdit"/>
										</div>
										<div class="col-sm-2">
											<!-- SAVE BUTTON LOGIC VAIBHAV-->
											<?php   
												$querys_job1 = "SELECT * FROM murrum WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
										if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
										?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_murrum.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&tbl_name=murrum&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>
										
										<?php } ?>
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
															<div class="col-sm-2">
									<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no;?>&&reports_nos=<?php echo $report_no;?>&&lab_no=<?php echo $lab_no;?>">Row Data</a>
								</div>
								<div class="col-sm-4">
									<label for="inputEmail3" class="control-label">Upload Excel :</label>
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
								while($r1 = mysqli_fetch_array($result_select1)){
									
									if($r1['test_code']=="grn")
									{
										$test_check.="grn,";
									?>
								
								<div class="panel panel-default" id="grn">
									<div class="panel-heading" id="txtgrn">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
												<h4 class="panel-title">
												<b>GRAIN SIZE ANALYSIS</b>
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
																	<label for="chk_grn">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_grn"  id="chk_grn" value="chk_grn"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">GRAIN SIZE ANALYSIS</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Gravel, Above 4.75 MM %</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="g1" name="g1">
															</div>
															
														</div>
													</div>
												</div>	
											<br>
												
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Sand, 0.075 to 4.75 MM %</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="g2" name="g2">
															</div>
															
														</div>
													</div>
												</div>
											<br>
											
											<div class="row">
												<div class="col-md-12">  
												
													<div class="form-group">											
														<div class="col-md-6">
														<label for="inputEmail3" class="control-label" >Silt + Clay</label>	
														</div>
														<div class="col-md-6"> 
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="g3" name="g3">
														</div>
														
													</div>
												</div>
											</div>
											<br>
											
											<div class="row">
												<div class="col-md-12">  
												
													<div class="form-group">											
														<div class="col-md-6">
														<!--<label for="inputEmail3" class="control-label" >Clay, &lt; 0.002 MM %</label>	-->
														</div>
														<div class="col-md-6"> 
															<input type="hidden" style="text-align:center;" class="form-control inputs" tabindex="4" id="g4" name="g4">
														</div>
														
													</div>
												</div>
											</div>
											
											<br>
											
											<div class="row">
												<div class="col-md-12">  
												
													<div class="form-group">											
														<div class="col-md-12">
														<label for="inputEmail3" class="control-label" >GRADATION</label>	
														</div>
														
													</div>
												</div>
											</div>
											<br>
											
											<div class="row">
												<div class="col-md-12">  
												
													<div class="form-group">											
														<div class="col-md-6">
														<label for="inputEmail3" class="control-label" >4.75</label>	
														</div>
														<div class="col-md-6"> 
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="grd_1" name="grd_1">
														</div>
														
													</div>
												</div>
											</div>
											
											<br>
											
											<div class="row">
												<div class="col-md-12">  
												
													<div class="form-group">											
														<div class="col-md-6">
														<label for="inputEmail3" class="control-label" >2.36</label>	
														</div>
														<div class="col-md-6"> 
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="grd_2" name="grd_2">
														</div>
														
													</div>
												</div>
											</div>
											
											<br>
											
											<div class="row">
												<div class="col-md-12">  
												
													<div class="form-group">											
														<div class="col-md-6">
														<label for="inputEmail3" class="control-label" >2.00</label>	
														</div>
														<div class="col-md-6"> 
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="grd_3" name="grd_3">
														</div>
														
													</div>
												</div>
											</div>
											
											<br>
											
											<div class="row">
												<div class="col-md-12">  
												
													<div class="form-group">											
														<div class="col-md-6">
														<label for="inputEmail3" class="control-label" >0.425</label>	
														</div>
														<div class="col-md-6"> 
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="grd_4" name="grd_4">
														</div>
														
													</div>
												</div>
											</div>
											
											<br>
											
											<div class="row">
												<div class="col-md-12">  
												
													<div class="form-group">											
														<div class="col-md-6">
														<label for="inputEmail3" class="control-label" >0.60</label>	
														</div>
														<div class="col-md-6"> 
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="grd_5" name="grd_5">
														</div>
														
													</div>
												</div>
											</div>
											<br>
											
											<div class="row">
												<div class="col-md-12">  
												
													<div class="form-group">											
														<div class="col-md-6">
														<label for="inputEmail3" class="control-label" >0.075</label>	
														</div>
														<div class="col-md-6"> 
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="grd_6" name="grd_6">
														</div>
														
													</div>
												</div>
											</div>
												
											
												
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="sal")
									{
										$test_check.="sal,";
								?>
								
								<div class="panel panel-default" id="attr">
									<div class="panel-heading" id="txtattr">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse23">
												<h4 class="panel-title">
												<b>ATTERBERG LIMITS</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse23" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_attr">2.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_attr"  id="chk_attr" value="chk_attr"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">ATTERBERG LIMITS</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Liquid Limit %</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="a1" name="a1">
															</div>
															
														</div>
													</div>
												</div>	
											<br>
												
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Plastic Limit %</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="a2" name="a2">
															</div>
															
														</div>
													</div>
												</div>
											<br>
											
											<div class="row">
												<div class="col-md-12">  
												
													<div class="form-group">											
														<div class="col-md-6">
														<label for="inputEmail3" class="control-label" >Plasticity Limit %</label>	
														</div>
														<div class="col-md-6"> 
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="a3" name="a3">
														</div>
														
													</div>
												</div>
											</div>
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="shr")
									{
										$test_check.="shr,";
								?>
								<div class="panel panel-default" id="shr">
									<div class="panel-heading" id="txtshr">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse24">
												<h4 class="panel-title">
												<b>SHRINKAGE LIMIT</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse24" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_shrink">2.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_shrink"  id="chk_shrink" value="chk_shrink"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">SHRINKAGE LIMIT</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >SHRINKAGE LIMIT %</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="s1" name="s1">
															</div>
															
														</div>
													</div>
												</div>	
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="fsi")
									{
										$test_check.="fsi,";
								?>
								<div class="panel panel-default" id="fsi">
									<div class="panel-heading" id="txtfsi">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse25">
												<h4 class="panel-title">
												<b>FREE SWELL INDEX</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse25" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_swell">4.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_swell"  id="chk_swell" value="chk_swell"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">FREE SWELL INDEX %</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Free Swell Index %</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="f1" name="f1">
															</div>
															
														</div>
													</div>
												</div>	
											
																							
										</div>
									</div>
								</div>
								<?php
									}
									else if($r1['test_code']=="cla")
									{
										$test_check.="cla,";
								?>
								<div class="panel panel-default" id="cla">
									<div class="panel-heading" id="txtcla">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse26">
												<h4 class="panel-title">
												<b>SOIL CLASSIFICATIONS</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse26" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_class">5.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_class"  id="chk_class" value="chk_class"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">SOIL CLASSIFICATIONS</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Soil Classifications</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="so1" name="so1">
															</div>
															
														</div>
													</div>
												</div>	
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="lco")
									{
										$test_check.="lco,";
								?>
								<div class="panel panel-default" id="lco">
									<div class="panel-heading" id="txtlco">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse27">
												<h4 class="panel-title">
												<b>LIGHT COMPACTION</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse27" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_light">6.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_light"  id="chk_light" value="chk_light"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">LIGHT COMPACTION</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Maximum Dry Density gm/cc</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="l1" name="l1">
															</div>
															
														</div>
													</div>
												</div>	
											<br>
												
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Optimum Moisture Content %</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="l2" name="l2">
															</div>
															
														</div>
													</div>
												</div>
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="hco")
									{
										$test_check.="hco,";
								?>
								<div class="panel panel-default" id="hco">
									<div class="panel-heading" id="txthco">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse28">
												<h4 class="panel-title">
												<b>HEAVY COMPACTION</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse28" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_heavy">7.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_heavy"  id="chk_heavy" value="chk_heavy"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">HEAVY COMPACTION</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Maximum Dry Density gm/cc</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="h1" name="h1">
															</div>
															
														</div>
													</div>
												</div>	
											<br>
												
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Optimum Moisture Content %</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="h2" name="h2">
															</div>
															
														</div>
													</div>
												</div>
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="spg")
									{
										$test_check.="spg,";
								?>
								<div class="panel panel-default" id="spg">
									<div class="panel-heading" id="txtspg">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse20">
												<h4 class="panel-title">
												<b>SPECIFIC GRAVITY</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse20" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_sp">8.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_sp"  id="chk_sp" value="chk_sp"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">SPECIFIC GRAVITY</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Specific Gravity</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="sp1" name="sp1">
															</div>
															
														</div>
													</div>
												</div>	
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="duu")
									{
										$test_check.="duu,";
								?>
								
								<div class="panel panel-default" id="duu">
									<div class="panel-heading" id="txtduu">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse29">
												<h4 class="panel-title">
												<b>DIRECT SHEAR (DUU)</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse29" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_duu">9.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_duu"  id="chk_duu" value="chk_duu"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">DIRECT SHEAR (DUU)</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Cohesion ('C) kg/cm<sup>2</sup></label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="d1" name="d1">
															</div>
															
														</div>
													</div>
												</div>	
											<br>
												
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Friction Angel (&empty;) Degree</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="d2" name="d2">
															</div>
															
														</div>
													</div>
												</div>
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="con")
									{
										$test_check.="con,";
								?>
								
								<div class="panel panel-default" id="con">
									<div class="panel-heading" id="txtcon">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse201">
												<h4 class="panel-title">
												<b>CONSOLIDATION</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse201" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_con">10.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_con"  id="chk_con" value="chk_con"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">CONSOLIDATION</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Cc</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="c1" name="c1">
															</div>
															
														</div>
													</div>
												</div>	
											<br>
												
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Pc</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="c2" name="c2">
															</div>
															
														</div>
													</div>
												</div>
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="uns")
									{
										$test_check.="uns,";
								?>
								
								<div class="panel panel-default" id="uns">
									<div class="panel-heading" id="txtuns">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse202">
												<h4 class="panel-title">
												<b>CBR (UNSOAKED)</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse202" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_cbr1">11.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_cbr1"  id="chk_cbr1" value="chk_cbr1"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">CBR (UNSOAKED)</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >CBR (UNSOAKED) % </label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="cbr1" name="cbr1">
															</div>
															
														</div>
													</div>
												</div>	
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="soa")
									{
										$test_check.="soa,";
								?>
								
								<div class="panel panel-default" id="soa">
									<div class="panel-heading" id="txtsoa">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2023">
												<h4 class="panel-title">
												<b>CBR (SOAKED)</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse2023" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_cbr2">12.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_cbr2"  id="chk_cbr2" value="chk_cbr2"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">CBR (SOAKED)</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >CBR (SOAKED) % </label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="cbr2" name="cbr2">
															</div>
															
														</div>
													</div>
												</div>	
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="tri")
									{
										$test_check.="tri,";
								?>
								
								<div class="panel panel-default" id="tri">
									<div class="panel-heading" id="txttri">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2012">
												<h4 class="panel-title">
												<b>TRIAXIAL (UU)</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse2012" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_uu">13.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_uu"  id="chk_uu" value="chk_uu"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">TRIAXIAL (UU)</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Cohesion ('C) kg/cm<sup>2</sup></label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="t1" name="t1">
															</div>
															
														</div>
													</div>
												</div>	
											<br>
												
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Friction Angel (&empty;) Degree</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="t2" name="t2">
															</div>
															
														</div>
													</div>
												</div>
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="rde")
									{
										$test_check.="rde,";
								?>
								
								<div class="panel panel-default" id="rde">
									<div class="panel-heading" id="txtrde">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse206">
												<h4 class="panel-title">
												<b>RELATIVE DENSITY</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse206" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_den">12.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_den"  id="chk_den" value="chk_den"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">RELATIVE DENSITY</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Relative Density gm/cc</label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="r1" name="r1">
															</div>
															
														</div>
													</div>
												</div>	
											
																							
										</div>
									</div>
								</div>
								
								<?php
									}
									else if($r1['test_code']=="com")
									{
										$test_check.="com,";
								?>
								
								<div class="panel panel-default" id="com">
									<div class="panel-heading" id="txtcom">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2061">
												<h4 class="panel-title">
												<b>UNCONFINED COMPRESSIVE STRENGTH</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse2061" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_ucs">15.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_ucs"  id="chk_ucs" value="chk_ucs"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">UNCONFINED COMPRESSIVE STRENGTH</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Unconfined Compressive Strength (UCS) kg/cm<sup>2</sup></label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="u1" name="u1">
															</div>
															
														</div>
													</div>
												</div>	
											
																							
										</div>
									</div>
								</div>
								
								
								<?php
									}
									else if($r1['test_code']=="swe")
									{
										$test_check.="swe,";
								?>
								
								<div class="panel panel-default" id="swe">
									<div class="panel-heading" id="txtswe">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse20611">
												<h4 class="panel-title">
												<b>SWELLING PRESSURE</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse20611" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_press">16.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_press"  id="chk_press" value="chk_press"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">SWELLING PRESSURE</label>
														</div>
													</div>
												</div>
												
							
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" >Swelling Pressure kg/cm<sup>2</sup></label>	
															</div>
															<div class="col-md-6"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="sw1" name="sw1">
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
							 $query = "select * from murrum WHERE lab_no='$aa'  and `is_deleted`='0'";

								$result = mysqli_query($conn, $query);
			
								$cnt=0;
								$detail=0;
								if (mysqli_num_rows($result) > 0) {
							while($r = mysqli_fetch_array($result)){										
										if($r['is_deleted'] == 0){
										?>
										<tr>
																				
										<td style="text-align:center;" width="10%">	
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
										
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
		</section>
	</div>
	<?php include("footer.php");?>
	<script>
	$('.startdate_class').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	});
	$('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });

  $(function () {
    $('.select2').select2();
  })
		$("#btn_upload_excel").click(function()
		{
			form_data = new FormData();
				var acb = $('#upload_excel').val();
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
	
$(document).ready(function(){ 
			   
	$('#btn_edit_data').hide();
	$('#alert').hide();
	
	$('#chk_attr').change(function(){
        if(this.checked)
		{ 
			$('#txtattr').css("background-color","var(--success)"); 
			var g_3 = $('#g3').val();
			var temp = (+g_3);
			
			if(temp >= 42 && temp <= 44)
			{
				var a1 = randomNumberFromRange(34,35).toFixed();
				
			}
			else if(temp >= 44 && temp <= 48)
			{
				var a1 = randomNumberFromRange(36,37).toFixed();
				
			}
			else if(temp >= 46 && temp <= 49)
			{
				var a1 = randomNumberFromRange(38,39).toFixed();
				
			}
			else if(temp >= 50 && temp <= 58)
			{
				var a1 = randomNumberFromRange(39,41).toFixed();
				
			}
			
			if(temp >= 57 && temp <= 58)
			{
				var a3 = 18;
				
			}
			else if(temp >= 55 && temp <= 56)
			{
				var a3 = 17;
				
			}
			else if(temp >= 52 && temp <= 54)
			{
				var a3 = 16;
				
			}
			else if(temp >= 48 && temp <= 51)
			{
				var a3 = 15;
				
			}
			else if(temp >= 45 && temp <= 47)
			{
				var a3 = 14;
				
			}
			else if(temp >= 42 && temp <= 44)
			{
				var a3 = 13;
				
			}
			
			$('#a1').val(a1);
			$('#a3').val(a3);
			var a_1 = $('#a1').val();
			var a_3 = $('#a3').val();
			
			var a2 = (+a_1) - (+a_3);
			$('#a2').val(a2);
			
		}
		else
		{
			 $('#txtattr').css("background-color","White"); 
			 $('#a1').val(null);
			 $('#a2').val(null);
			 $('#a3').val(null);
		}
	});
	
	$('#a1').change(function(){
		$('#txtattr').css("background-color","var(--success)"); 
		 $("#chk_attr").prop("checked", true); 
	});
	 $("#chk_press").prop("checked", true); 
	$('#chk_cbr1').change(function(){
        if(this.checked)
		{ $('#txtuns').css("background-color","var(--success)"); 
		}
		else
		{
			 $('#txtuns').css("background-color","White"); 
		}
	});
	$('#chk_cbr2').change(function(){
        if(this.checked)
		{ 
			$('#txtsoa').css("background-color","var(--success)"); 
			var g_3 = $('#g3').val();
			
			var temp = (+g_3);
			
			if(temp >= 57 && temp <= 58)
			{
				var cbr2 = randomNumberFromRange(10.3,10.5).toFixed(1);
				
			}
			else if(temp >= 55 && temp <= 56)
			{
				var cbr2 = randomNumberFromRange(10.6,10.8).toFixed(1);
				
			}
			else if(temp >= 52 && temp <= 54)
			{
				var cbr2 = randomNumberFromRange(10.9,11.2).toFixed(1);
				
			}
			else if(temp >= 48 && temp <= 51)
			{
				var cbr2 = randomNumberFromRange(11.2,11.4).toFixed(1);
				
			}
			else if(temp >= 45 && temp <= 47)
			{
				var cbr2 = randomNumberFromRange(11.5,11.7).toFixed(1);
			}
			else if(temp >= 42 && temp <= 44)
			{
				var cbr2 = randomNumberFromRange(11.8,12.2).toFixed(1);
			
			}
			$('#cbr2').val(cbr2);
			
		}
		else
		{
			 $('#txtsoa').css("background-color","White"); 
			 $('#cbr2').val(null);
		}
	});
	$('#chk_class').change(function(){
        if(this.checked)
		{ 
			$('#txtcla').css("background-color","var(--success)"); 
			var g_3 = $('#g3').val();
			var g_4 = $('#g4').val();
			
			var R22 = (+g_3) + (+g_4);
			var R18 = $('#g1').val();
			var R19 = $('#g2').val();
			var R23 = $('#a1').val();
			var R25 = $('#a3').val();
			
			
			if(R22<=50 && R19>=R19 && R25=="NP")
			{
				$('#so1').val("GM");
			}
			else
			{
				if(R22<=50 && R18>=R19 && R25!="NP" && R25>0)
				{
					$('#so1').val("GC");
				}
				else
				{
					if(R22<=50 && R19>R18 && R25=="NP")
					{
						$('#so1').val("SM");		
					}
					else
					{
						if(R22<=50 && R19>R18 && R25!="NP" && R25>0)
						{
							$('#so1').val("SC");
						}
						else
						{
							var ansd = (+R23)-(+20);
							var ghd = (+ansd) * 0.73;
							if(R22>50 && R23<35 && (R25=="NP" || R25 < ghd))
							{
								$('#so1').val("ML");
							}
							else
							{
								if(R22>50 && R23<35 && R25!="NP" && R25>=ghd)
								{
									$('#so1').val("CL");
								}
								else
								{
									if(R22>50 && R23>=35 && R23<50 && R25<ghd)
									{
										$('#so1').val("MI");
									}
									else
									{
										if(R22>50 && R23>=35 && R23<50 && R25>=ghd)
										{
											$('#so1').val("CI");
										}
										else
										{
											if(R22>50 && R23>=50 && R23<70 && R25<ghd)
											{
												$('#so1').val("MH");
											}
											else
											{
												if(R22>50 && R23>=50 &&R23<70 && R25>=ghd)
												{
													$('#so1').val("CH");
												}
												else
												{
													if(R22>50 && R23>=70 && R25<ghd)
													{
														$('#so1').val("MV");
													}
													else
													{
														if(R22>50 && R23>=70 && R25>=ghd)
														{
															$('#so1').val("CV");
														}
														else
														{
															$('#so1').val("");
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			
		}
		else
		{
			 $('#txtcla').css("background-color","White"); 
			 $('#so1').val(null);
		}
	});
	$('#chk_con').change(function(){
        if(this.checked)
		{ $('#txtcon').css("background-color","var(--success)"); 
		}
		else
		{
			 $('#txtcon').css("background-color","White"); 
		}
	});
	$('#chk_den').change(function(){
        if(this.checked)
		{ $('#txtden').css("background-color","var(--success)"); 
		}
		else
		{
			 $('#txtden').css("background-color","White"); 
		}
	});
	$('#chk_duu').change(function(){
        if(this.checked)
		{ $('#txtduu').css("background-color","var(--success)"); 
		}
		else
		{
			 $('#txtduu').css("background-color","White"); 
		}
	});
	$('#chk_grn').change(function(){
        if(this.checked)
		{ $('#txtgrn').css("background-color","var(--success)"); 
		  var g1 = randomNumberFromRange(18,24).toFixed();
		  $('#g1').val(g1);
		  var g_1 = $('#g1').val();
			if(g_1 == "18")
			{
				var g2 = randomNumberFromRange(24,29).toFixed();
			}
			else if(g_1 == "19")
			{
				var g2 = randomNumberFromRange(25,30).toFixed();
			}
			else if(g_1 == "20")
			{
				var g2 = randomNumberFromRange(26,31).toFixed();
			}
			else if(g_1 == "21")
			{
				var g2 = randomNumberFromRange(27,31).toFixed();
			}
			else if(g_1 == "22")
			{
				var g2 = randomNumberFromRange(28,32).toFixed();
			}
			else if(g_1 == "23")
			{
				var g2 = randomNumberFromRange(29,33).toFixed();
			}
			else if(g_1 == "24")
			{
				var g2 = randomNumberFromRange(30,34).toFixed();
			}
			$('#g2').val(g2);
		    var g_2 = $('#g2').val();
			
			$('#g3').val("");
		    
			
			var g3 = (+100) - ((+g_1) + (+g_2));
			$('#g3').val(g3);
		    var g_3 = $('#g3').val();
		
		}
		else
		{
			 $('#txtgrn').css("background-color","White"); 
			 $('#g1').val(null);
			 $('#g2').val(null);
			 $('#g3').val(null);
			 $('#g4').val(null);
			 $('#grd_1').val(null);
			 $('#grd_2').val(null);
			 $('#grd_3').val(null);
			 $('#grd_4').val(null);
			 $('#grd_5').val(null);
			 $('#grd_6').val(null);
			 
		}
	});
	
	
	
	$('#chk_heavy').change(function(){
        if(this.checked)
		{ 
			$('#txthco').css("background-color","var(--success)"); 
			var g_3 = $('#g3').val();
		
			var temp = (+g_3);
			
			if(temp >= 57 && temp <= 58)
			{
				var h1 = randomNumberFromRange(1.89,1.91).toFixed(2);
				var h2 = randomNumberFromRange(12.5,12.9).toFixed(1);
				
			}
			else if(temp >= 55 && temp <= 56)
			{
				var h1 = randomNumberFromRange(1.90,1.92).toFixed(2);
				var h2 = randomNumberFromRange(12.1,12.5).toFixed(1);
				
			}
			else if(temp >= 52 && temp <= 54)
			{
				var h1 = randomNumberFromRange(1.91,1.93).toFixed(2);
				var h2 = randomNumberFromRange(11.6,12.0).toFixed(1);
				
			}
			else if(temp >= 48 && temp <= 51)
			{
				var h1 = randomNumberFromRange(1.92,1.94).toFixed(2);
				var h2 = randomNumberFromRange(11.0,11.5).toFixed(1);
				
			}
			else if(temp >= 45 && temp <= 47)
			{
				var h1 = randomNumberFromRange(1.93,1.95).toFixed(2);
				var h2 = randomNumberFromRange(10.0,10.5).toFixed(1);
				
			}
			else if(temp >= 42 && temp <= 44)
			{
				var h1 = randomNumberFromRange(1.94,1.96).toFixed(2);
				var h2 = randomNumberFromRange(9.5,10.4).toFixed(1);
				
			}
			$('#h1').val(h1);
			$('#h2').val(h2);
		}
		else
		{
			 $('#txthco').css("background-color","White");
			$('#h1').val(null);
			$('#h2').val(null);			 
		}
	});
	$('#chk_light').change(function(){
        if(this.checked)
		{ $('#txtlco').css("background-color","var(--success)"); 
		}
		else
		{
			 $('#txtlco').css("background-color","White"); 
		}
	});
	$('#chk_shrink').change(function(){
        if(this.checked)
		{ 
			$('#txtshr').css("background-color","var(--success)"); 
			var s1 = randomNumberFromRange(18.59,23.65).toFixed(2);
			$('#s1').val(s1);
		}
		else
		{
			 $('#txtshr').css("background-color","White");
			$('#s1').val(null);			 
		}
	});
	$('#chk_sp').change(function(){
        if(this.checked)
		{ 
			$('#txtspg').css("background-color","var(--success)"); 
			var sp1 = randomNumberFromRange(2.59,2.69).toFixed(2);
			$('#sp1').val(sp1);
		}
		else
		{
			 $('#txtspg').css("background-color","White"); 
			 $('#sp1').val(null);
		}
	});
	
	$('#chk_swell').change(function(){
        if(this.checked)
		{ 
			$('#txtfsi').css("background-color","var(--success)"); 
			var g_3 = $('#g3').val();
			var g_4 = $('#g4').val();
			
			var temp = (+g_3) + (+g_4);
			
			if(temp >= 71 && temp <= 73)
			{
				var f1 = randomNumberFromRange(31,33).toFixed();
				
			}
			else if(temp >= 74 && temp <= 77)
			{
				var f1 = randomNumberFromRange(34,37).toFixed();
				
			}
			else if(temp >= 78 && temp <= 80)
			{
				var f1 = randomNumberFromRange(35,38).toFixed();
			}
			else if(temp >= 81 && temp <= 83)
			{
				var f1 = randomNumberFromRange(36,39).toFixed();
			}
			else if(temp >= 84 && temp <= 86)
			{
				var f1 = randomNumberFromRange(39,41).toFixed();
			}
			else if(temp >= 87 && temp <= 88)
			{
				var f1 = randomNumberFromRange(41,43).toFixed();
			}
			else if(temp >= 89 && temp <= 90)
			{
				var f1 = randomNumberFromRange(42,45).toFixed();
			}
			$('#f1').val(f1);
			
		}
		else
		{
			 $('#txtfsi').css("background-color","White"); 
			 $('#f1').val(null);
		}
	});
	
	$('#chk_ucs').change(function(){
        if(this.checked)
		{ 
			$('#txtcom').css("background-color","var(--success)"); 
		}
		else
		{
			 $('#txtcom').css("background-color","White"); 
		}
	});
	$('#chk_uu').change(function(){
        if(this.checked)
		{ 
			$('#txttri').css("background-color","var(--success)"); 
		}
		else
		{
			 $('#txttri').css("background-color","White"); 
		}
	});
	$('#chk_press').change(function(){
        if(this.checked)
		{ 
			$('#txtswe').css("background-color","var(--success)"); 
		}
		else
		{
			 $('#txtswe').css("background-color","White"); 
		}
	});
	
	
	
	
});

		
		// code start//
function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
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
        url: '<?php echo $base_url; ?>save_murrum.php',
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
									
				//GRAIN SIZE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grn")
					{
						if(document.getElementById('chk_grn').checked) {
							var chk_grn = "1";
						}
						else{
							var chk_grn = "0";
						}
						var g1 = $('#g1').val();
						var g2 = $('#g2').val();
						var g3 = $('#g3').val();
						var g4 = $('#g4').val();
						var grd_1 = $('#grd_1').val();
						var grd_2 = $('#grd_2').val();
						var grd_3 = $('#grd_3').val();
						var grd_4 = $('#grd_4').val();
						var grd_5 = $('#grd_5').val();
						var grd_6 = $('#grd_6').val();
						
						
						break;
					}
					else
					{
						var chk_grn = "0";
						var g1 = "";
						var g2 = "";
						var g3 = "";
						var g4 = "";
						var grd_1 = "";
						var grd_2 = "";
						var grd_3 = "";
						var grd_4 = "";
						var grd_5 = "";
						var grd_6 = "";
					}
				}
				
				
				//ATTERBERG
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sal")
					{
						if(document.getElementById('chk_attr').checked) {
							var chk_attr = "1";
						}
						else{
							var chk_attr = "0";
						}
						var a1 = $('#a1').val();
						var a2 = $('#a2').val();
						var a3 = $('#a3').val();
						
						break;
					}
					else
					{
						var chk_attr = "0";
						var a1 = "";
						var a2 = "";
						var a3 = "";
						
					}
				}
				
				//SHRINKAGE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="shr")
					{
						if(document.getElementById('chk_shrink').checked) {
							var chk_shrink = "1";
						}
						else{
							var chk_shrink = "0";
						}
						var s1 = $('#s1').val();
					
						break;
					}
					else
					{
						var chk_shrink = "0";
						var s1 = "";
						
					}
				}
				
				//FREE SWELL
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fsi")
					{
						if(document.getElementById('chk_swell').checked) {
							var chk_swell = "1";
						}
						else{
							var chk_swell = "0";
						}
						var f1 = $('#f1').val();
					
						break;
					}
					else
					{
						var chk_swell = "0";
						var f1 = "";
						
					}
				}
				
				//SOIL CLASSIFICATIONS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cla")
					{
						if(document.getElementById('chk_class').checked) {
							var chk_class = "1";
						}
						else{
							var chk_class = "0";
						}
						var so1 = $('#so1').val();
					
						break;
					}
					else
					{
						var chk_class = "0";
						var so1 = "";
						
					}
				}
				
				//LIGHT
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lco")
					{
						if(document.getElementById('chk_light').checked) {
							var chk_light = "1";
						}
						else{
							var chk_light = "0";
						}
						var l1 = $('#l1').val();
						var l2 = $('#l2').val();
					
						break;
					}
					else
					{
						var chk_light = "0";
						var l1 = "";
						var l2 = "";
						
					}
				}
				
				//HEAVY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="hco")
					{
						if(document.getElementById('chk_heavy').checked) {
							var chk_heavy = "1";
						}
						else{
							var chk_heavy = "0";
						}
						var h1 = $('#h1').val();
						var h2 = $('#h2').val();
					
						break;
					}
					else
					{
						var chk_heavy = "0";
						var h1 = "";
						var h2 = "";
						
					}
				}
				
				//SPG
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spg")
					{
						if(document.getElementById('chk_sp').checked) {
							var chk_sp = "1";
						}
						else{
							var chk_sp = "0";
						}
						var sp1 = $('#sp1').val();
						
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp1 = "";
						
						
					}
				}
				
				//DIRECT SHEAR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="duu")
					{
						if(document.getElementById('chk_duu').checked) {
							var chk_duu = "1";
						}
						else{
							var chk_duu = "0";
						}
						var d1 = $('#d1').val();
						var d2 = $('#d2').val();
						
						break;
					}
					else
					{
						var chk_duu = "0";
						var d1 = "";
						var d2 = "";
						
						
					}
				}
				
				//CONSOLIDATION
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
						var c1 = $('#c1').val();
						var c2 = $('#c2').val();
						
						break;
					}
					else
					{
						var chk_con = "0";
						var c1 = "";
						var c2 = "";
						
						
					}
				}
				
				//CBR UNSOAKED
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="uns")
					{
						if(document.getElementById('chk_cbr1').checked) {
							var chk_cbr1 = "1";
						}
						else{
							var chk_cbr1 = "0";
						}
						var cbr1 = $('#cbr1').val();
						
						break;
					}
					else
					{
						var chk_cbr1 = "0";
						var cbr1 = "";
						
					}
				}
				
				//CBR SOAKED
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="soa")
					{
						if(document.getElementById('chk_cbr2').checked) {
							var chk_cbr2 = "1";
						}
						else{
							var chk_cbr2 = "0";
						}
						var cbr2 = $('#cbr2').val();
						
						break;
					}
					else
					{
						var chk_cbr2 = "0";
						var cbr2 = "";
						
					}
				}
				
				//TRIAXIAL
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tri")
					{
						if(document.getElementById('chk_uu').checked) {
							var chk_uu = "1";
						}
						else{
							var chk_uu = "0";
						}
						var t1 = $('#t1').val();
						var t2 = $('#t2').val();
						
						break;
					}
					else
					{
						var chk_uu = "0";
						var t1 = "";
						var t2 = "";
						
					}
				}
				
				//RELATIVE DENSITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="rde")
					{
						if(document.getElementById('chk_den').checked) {
							var chk_den = "1";
						}
						else{
							var chk_den = "0";
						}
						var r1 = $('#r1').val();
						
						break;
					}
					else
					{
						var chk_den = "0";
						var r1 = "";
						
					}
				}
				
				//COMPRESSIVE STRENGTH
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						if(document.getElementById('chk_ucs').checked) {
							var chk_ucs = "1";
						}
						else{
							var chk_ucs = "0";
						}
						var u1 = $('#u1').val();
						
						break;
					}
					else
					{
						var chk_ucs = "0";
						var u1 = "";
						
					}
				}
				
				//SWELLING PRESSURE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="swe")
					{
						if(document.getElementById('chk_press').checked) {
							var chk_press = "1";
						}
						else{
							var chk_press = "0";
						}
						var sw1 = $('#sw1').val();
						
						break;
					}
					else
					{
						var chk_press = "0";
						var sw1 = "";
						
					}
				}
				
				
				
				
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_grn='+chk_grn+'&g1='+g1+'&g2='+g2+'&g3='+g3+'&g4='+g4+'&chk_attr='+chk_attr+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&chk_shrink='+chk_shrink+'&s1='+s1+'&chk_swell='+chk_swell+'&f1='+f1+'&chk_class='+chk_class+'&so1='+so1+'&chk_light='+chk_light+'&l1='+l1+'&l2='+l2+'&chk_heavy='+chk_heavy+'&h1='+h1+'&h2='+h2+'&chk_sp='+chk_sp+'&sp1='+sp1+'&chk_duu='+chk_duu+'&d1='+d1+'&d2='+d2+'&chk_con='+chk_con+'&c1='+c1+'&c2='+c2+'&chk_cbr1='+chk_cbr1+'&cbr1='+cbr1+'&chk_cbr2='+chk_cbr2+'&cbr2='+cbr2+'&chk_uu='+chk_uu+'&t1='+t1+'&t2='+t2+'&chk_den='+chk_den+'&r1='+r1+'&chk_ucs='+chk_ucs+'&u1='+u1+'&chk_press='+chk_press+'&sw1='+sw1+'&ulr='+ulr+'&grd_1='+grd_1+'&grd_2='+grd_2+'&grd_3='+grd_3+'&grd_4='+grd_4+'&grd_5='+grd_5+'&grd_6='+grd_6;
				
				
				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");				
									
				//GRAIN SIZE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grn")
					{
						if(document.getElementById('chk_grn').checked) {
							var chk_grn = "1";
						}
						else{
							var chk_grn = "0";
						}
						var g1 = $('#g1').val();
						var g2 = $('#g2').val();
						var g3 = $('#g3').val();
						var g4 = $('#g4').val();
						var grd_1 = $('#grd_1').val();
						var grd_2 = $('#grd_2').val();
						var grd_3 = $('#grd_3').val();
						var grd_4 = $('#grd_4').val();
						var grd_5 = $('#grd_5').val();
						var grd_6 = $('#grd_6').val();
						
						
						break;
					}
					else
					{
						var chk_grn = "0";
						var g1 = "";
						var g2 = "";
						var g3 = "";
						var g4 = "";
						var grd_1 = "";
						var grd_2 = "";
						var grd_3 = "";
						var grd_4 = "";
						var grd_5 = "";
						var grd_6 = "";
					}
				}
				
				
				//ATTERBERG
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sal")
					{
						if(document.getElementById('chk_attr').checked) {
							var chk_attr = "1";
						}
						else{
							var chk_attr = "0";
						}
						var a1 = $('#a1').val();
						var a2 = $('#a2').val();
						var a3 = $('#a3').val();
						
						break;
					}
					else
					{
						var chk_attr = "0";
						var a1 = "";
						var a2 = "";
						var a3 = "";
						
					}
				}
				
				//SHRINKAGE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="shr")
					{
						if(document.getElementById('chk_shrink').checked) {
							var chk_shrink = "1";
						}
						else{
							var chk_shrink = "0";
						}
						var s1 = $('#s1').val();
					
						break;
					}
					else
					{
						var chk_shrink = "0";
						var s1 = "";
						
					}
				}
				
				//FREE SWELL
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fsi")
					{
						if(document.getElementById('chk_swell').checked) {
							var chk_swell = "1";
						}
						else{
							var chk_swell = "0";
						}
						var f1 = $('#f1').val();
					
						break;
					}
					else
					{
						var chk_swell = "0";
						var f1 = "";
						
					}
				}
				
				//SOIL CLASSIFICATIONS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cla")
					{
						if(document.getElementById('chk_class').checked) {
							var chk_class = "1";
						}
						else{
							var chk_class = "0";
						}
						var so1 = $('#so1').val();
					
						break;
					}
					else
					{
						var chk_class = "0";
						var so1 = "";
						
					}
				}
				
				//LIGHT
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lco")
					{
						if(document.getElementById('chk_light').checked) {
							var chk_light = "1";
						}
						else{
							var chk_light = "0";
						}
						var l1 = $('#l1').val();
						var l2 = $('#l2').val();
					
						break;
					}
					else
					{
						var chk_light = "0";
						var l1 = "";
						var l2 = "";
						
					}
				}
				
				//HEAVY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="hco")
					{
						if(document.getElementById('chk_heavy').checked) {
							var chk_heavy = "1";
						}
						else{
							var chk_heavy = "0";
						}
						var h1 = $('#h1').val();
						var h2 = $('#h2').val();
					
						break;
					}
					else
					{
						var chk_heavy = "0";
						var h1 = "";
						var h2 = "";
						
					}
				}
				
				//SPG
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spg")
					{
						if(document.getElementById('chk_sp').checked) {
							var chk_sp = "1";
						}
						else{
							var chk_sp = "0";
						}
						var sp1 = $('#sp1').val();
						
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp1 = "";
						
						
					}
				}
				
				//DIRECT SHEAR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="duu")
					{
						if(document.getElementById('chk_duu').checked) {
							var chk_duu = "1";
						}
						else{
							var chk_duu = "0";
						}
						var d1 = $('#d1').val();
						var d2 = $('#d2').val();
						
						break;
					}
					else
					{
						var chk_duu = "0";
						var d1 = "";
						var d2 = "";
						
						
					}
				}
				
				//CONSOLIDATION
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
						var c1 = $('#c1').val();
						var c2 = $('#c2').val();
						
						break;
					}
					else
					{
						var chk_con = "0";
						var c1 = "";
						var c2 = "";
						
						
					}
				}
				
				//CBR UNSOAKED
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="uns")
					{
						if(document.getElementById('chk_cbr1').checked) {
							var chk_cbr1 = "1";
						}
						else{
							var chk_cbr1 = "0";
						}
						var cbr1 = $('#cbr1').val();
						
						break;
					}
					else
					{
						var chk_cbr1 = "0";
						var cbr1 = "";
						
					}
				}
				
				//CBR SOAKED
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="soa")
					{
						if(document.getElementById('chk_cbr2').checked) {
							var chk_cbr2 = "1";
						}
						else{
							var chk_cbr2 = "0";
						}
						var cbr2 = $('#cbr2').val();
						
						break;
					}
					else
					{
						var chk_cbr2 = "0";
						var cbr2 = "";
						
					}
				}
				
				//TRIAXIAL
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tri")
					{
						if(document.getElementById('chk_uu').checked) {
							var chk_uu = "1";
						}
						else{
							var chk_uu = "0";
						}
						var t1 = $('#t1').val();
						var t2 = $('#t2').val();
						
						break;
					}
					else
					{
						var chk_uu = "0";
						var t1 = "";
						var t2 = "";
						
					}
				}
				
				//RELATIVE DENSITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="rde")
					{
						if(document.getElementById('chk_den').checked) {
							var chk_den = "1";
						}
						else{
							var chk_den = "0";
						}
						var r1 = $('#r1').val();
						
						break;
					}
					else
					{
						var chk_den = "0";
						var r1 = "";
						
					}
				}
				
				//COMPRESSIVE STRENGTH
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						if(document.getElementById('chk_ucs').checked) {
							var chk_ucs = "1";
						}
						else{
							var chk_ucs = "0";
						}
						var u1 = $('#u1').val();
						
						break;
					}
					else
					{
						var chk_ucs = "0";
						var u1 = "";
						
					}
				}
				
				//SWELLING PRESSURE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="swe")
					{
						if(document.getElementById('chk_press').checked) {
							var chk_press = "1";
						}
						else{
							var chk_press = "0";
						}
						var sw1 = $('#sw1').val();
						
						break;
					}
					else
					{
						var chk_press = "0";
						var sw1 = "";
						
					}
				}
				
								
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_grn='+chk_grn+'&g1='+g1+'&g2='+g2+'&g3='+g3+'&chk_attr='+chk_attr+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&a4='+a4+'&chk_shrink='+chk_shrink+'&s1='+s1+'&chk_swell='+chk_swell+'&f1='+f1+'&chk_class='+chk_class+'&so1='+so1+'&chk_light='+chk_light+'&l1='+l1+'&l2='+l2+'&chk_heavy='+chk_heavy+'&h1='+h1+'&h2='+h2+'&chk_sp='+chk_sp+'&sp1='+sp1+'&chk_duu='+chk_duu+'&d1='+d1+'&d2='+d2+'&chk_con='+chk_con+'&c1='+c1+'&c2='+c2+'&chk_cbr1='+chk_cbr1+'&cbr1='+cbr1+'&chk_cbr2='+chk_cbr2+'&cbr2='+cbr2+'&chk_uu='+chk_uu+'&t1='+t1+'&t2='+t2+'&chk_den='+chk_den+'&r1='+r1+'&chk_ucs='+chk_ucs+'&u1='+u1+'&chk_press='+chk_press+'&sw1='+sw1+'&ulr='+ulr+'&grd_1='+grd_1+'&grd_2='+grd_2+'&grd_3='+grd_3+'&grd_4='+grd_4+'&grd_5='+grd_5+'&grd_6='+grd_6;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_murrum.php',
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
        url: '<?php echo $base_url; ?>save_murrum.php',
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
			
				//GRAIN SIZE ANALYSIS
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="grn")
					{
						var chk_grn = data.chk_grn;
						if(chk_grn=="1")
						{
						   $('#txtgrn').css("background-color","var(--success)");		-	
						   $("#chk_grn").prop("checked", true); 
						   
							
						}
						else
						{
							$('#txtgrn').css("background-color","WHITE");		-	
						    $("#chk_grn").prop("checked", false);
						}
							$('#g1').val(data.g1);
							$('#g2').val(data.g2);
							$('#g3').val(data.g3);
							$('#g4').val(data.g4);
							 $('#grd_1').val(data.grd_1);
							$('#grd_2').val(data.grd_2);
							$('#grd_3').val(data.grd_3);
							$('#grd_4').val(data.grd_4);
							$('#grd_5').val(data.grd_5);
							$('#grd_6').val(data.grd_6);
						break;
					}					
					else
					{
					}
				}
				
				
				//ATTERBERG
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sal")
					{
						var chk_attr = data.chk_attr;
						if(chk_attr=="1")
						{
						   $('#txtattr').css("background-color","var(--success)");
						   $("#chk_attr").prop("checked", true); 
						}
						else
						{
							$("#chk_attr").prop("checked", false); 
							$('#txtattr').css("background-color","white");			
						}
							$('#a1').val(data.a1);
							$('#a2').val(data.a2);
							$('#a3').val(data.a3);
							
						break;
					}					
					else
					{
					}
				}
				
				//SHRINKAGE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="shr")
					{
						var chk_shrink = data.chk_shrink;
						if(chk_shrink=="1")
						{
						   $('#txtshr').css("background-color","var(--success)");		-	
						   $("#chk_shrink").prop("checked", true); 
						}else{
							$('#txtshr').css("background-color","white");			
							$("#chk_shrink").prop("checked", false); 
						}
							$('#s1').val(data.s1);
							
						break;
					}					
					else
					{
					}
				}
				
				//FREE Swell INDEX
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fsi")
					{
						 var chk_swell = data.chk_swell;
						if(chk_swell=="1")
						{
						   $('#txtfsi').css("background-color","var(--success)");		-	
						   $("#chk_swell").prop("checked", true); 
						}else{
							$('#txtfsi').css("background-color","white");			
							$("#chk_swell").prop("checked", false); 
						}
							$('#f1').val(data.f1);
							
						break;
					}					
					else
					{
					}
				}
           
		   
				//Soil Classifications
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="cla")
					{
						 var chk_class = data.chk_class;
						if(chk_class=="1")
						{
						   $('#txtcla').css("background-color","var(--success)");		-	
						   $("#chk_class").prop("checked", true); 
						}else{
							$('#txtcla').css("background-color","white");			
							$("#chk_class").prop("checked", false); 
						}
							$('#so1').val(data.so1);
							
						break;
					}					
					else
					{
					}
				}
           
				
				//LIGHT COMPACTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lco")
					{
						 var chk_light = data.chk_light;
						if(chk_light=="1")
						{
						   $('#txtlco').css("background-color","var(--success)");		-	
						   $("#chk_light").prop("checked", true); 
						}else{
							$('#txtlco').css("background-color","white");			
							$("#chk_light").prop("checked", false); 
						}
							$('#l1').val(data.l1);
							$('#l2').val(data.l2);
							
						break;
					}					
					else
					{
					}
				}
           
		   
				//HEAVY COMPACTION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="hco")
					{
						 var chk_heavy = data.chk_heavy;
						if(chk_heavy=="1")
						{
						   $('#txthco').css("background-color","var(--success)");		-	
						   $("#chk_heavy").prop("checked", true); 
						}else{
							$('#txthco').css("background-color","white");			
							$("#chk_heavy").prop("checked", false); 
						}
							$('#h1').val(data.h1);
							$('#h2').val(data.h2);
							
						break;
					}					
					else
					{
					}
				}
		   
		   
				//SPECIFIC GRAVITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spg")
					{
						 var chk_sp = data.chk_sp;
						if(chk_sp=="1")
						{
						   $('#txtspg').css("background-color","var(--success)");		-	
						   $("#chk_sp").prop("checked", true); 
						}else{
							$('#txtspg').css("background-color","white");			
							$("#chk_sp").prop("checked", false); 
						}
							$('#sp1').val(data.sp1);
							
							
						break;
					}					
					else
					{
					}
				}
				
				
				//DIRECT SHEAR (DUU)
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="duu")
					{
						 var chk_duu = data.chk_duu;
						if(chk_duu=="1")
						{
						   $('#txtduu').css("background-color","var(--success)");		-	
						   $("#chk_duu").prop("checked", true); 
						}else{
							$('#txtduu').css("background-color","white");			
							$("#chk_duu").prop("checked", false); 
						}
							$('#d1').val(data.d1);
							$('#d2').val(data.d2);
							
							
						break;
					}					
					else
					{
					}
				}
				
				//Consolidation
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="con")
					{
						 var chk_con = data.chk_con;
						if(chk_con=="1")
						{
						   $('#txtcon').css("background-color","var(--success)");		-	
						   $("#chk_con").prop("checked", true); 
						}else{
							$('#txtcon').css("background-color","white");			
							$("#chk_con").prop("checked", false); 
						}
							$('#c1').val(data.c1);
							$('#c2').val(data.c2);
							
							
						break;
					}					
					else
					{
					}
				}
				
				//CBR (UNSOAKED)
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="uns")
					{
						 var chk_cbr1 = data.chk_cbr1;
						if(chk_cbr1=="1")
						{
						   $('#txtuns').css("background-color","var(--success)");		-	
						   $("#chk_cbr1").prop("checked", true); 
						}else{
							$('#txtuns').css("background-color","white");			
							$("#chk_cbr1").prop("checked", false); 
						}
							$('#cbr1').val(data.cbr1);
							
							
							
						break;
					}					
					else
					{
					}
				}
				
				
				//CBR (SOAKED)
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="soa")
					{
						 var chk_cbr2 = data.chk_cbr2;
						if(chk_cbr2=="1")
						{
						   $('#txtsoa').css("background-color","var(--success)");		-	
						   $("#chk_cbr2").prop("checked", true); 
						}else{
							$('#txtsoa').css("background-color","white");			
							$("#chk_cbr2").prop("checked", false); 
						}
							$('#cbr2').val(data.cbr2);
							
							
							
						break;
					}					
					else
					{
					}
				}
				
				//TRIAXIAL
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="tri")
					{
						 var chk_uu = data.chk_uu;
						if(chk_uu=="1")
						{
						   $('#txttri').css("background-color","var(--success)");		-	
						   $("#chk_uu").prop("checked", true); 
						}else{
							$('#txttri').css("background-color","white");			
							$("#chk_uu").prop("checked", false); 
						}
							$('#t1').val(data.t1);
							$('#t2').val(data.t2);
							
							
							
						break;
					}					
					else
					{
					}
				}
				
				//RELATIVE DENSITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="rde")
					{
						 var chk_den = data.chk_den;
						if(chk_den=="1")
						{
						   $('#txtden').css("background-color","var(--success)");		-	
						   $("#chk_den").prop("checked", true); 
						}else{
							$('#txtden').css("background-color","white");			
							$("#chk_den").prop("checked", false); 
						}
							$('#r1').val(data.r1);
							
							
						break;
					}					
					else
					{
					}
				}
				
				//Compressive STRENGTH
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						 var chk_ucs = data.chk_ucs;
						if(chk_ucs=="1")
						{
						   $('#txtcom').css("background-color","var(--success)");		-	
						   $("#chk_ucs").prop("checked", true); 
						}else{
							$('#txtcom').css("background-color","white");			
							$("#chk_ucs").prop("checked", false); 
						}
							$('#u1').val(data.u1);
							
							
						break;
					}					
					else
					{
					}
				}
				
				//Compressive STRENGTH
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="swe")
					{
						 var chk_press = data.chk_press;
						if(chk_press=="1")
						{
						   $('#txtswe').css("background-color","var(--success)");		-	
						   $("#chk_press").prop("checked", true); 
						}else{
							$('#txtswe').css("background-color","white");			
							$("#chk_press").prop("checked", false); 
						}
							$('#sw1').val(data.sw1);
							
							
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
				