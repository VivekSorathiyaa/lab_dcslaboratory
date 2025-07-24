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
		if(isset($_GET['lab_no'])){
			$lab_no=$_GET['lab_no'];
			$aa	=$_GET['lab_no'];
			
		}
		if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
			
		}
		
		  $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$in_l= $row_select4['in_l'];
					$in_w= $row_select4['in_w'];
					$in_h= $row_select4['in_h'];
					$in_den= $row_select4['in_den'];
					$in_grade= $row_select4['in_grade'];					
				}
		
?>
<div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">FLEXURAL BEAM</h2>
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
												<input type="hidden" class="form-control" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no;?>" name="lab_no" ReadOnly>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<div class="col-sm-3">
												<label for="beam_size">Flexural Beam Size:</label>
											</div>
											<div class="col-sm-3">
												<select class="form-control" id="beam_size" name="beam_size">
													<option value="700_mm">700 MM</option>
													<option value="500_mm">500 MM</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<br>

							<!-- LAB NO PUT VAIBHAV-->
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
													$querys_job1 = "SELECT * FROM hard_concrete WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
											/*$val =  $_SESSION['isadmin'];
											if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {*/
											?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_flexural_beam.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											<?php //} ?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_flexural_beam.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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
	<?php }	 ?>
  	
				<?php
	$test_check;
	$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		while($r1 = mysqli_fetch_array($result_select1)){
			
			if($r1['test_code']=="fle")
			{
				$test_check.="fle,";	
				?>											
				<div class="panel panel-default" id="fle">
					<div class="panel-heading" id="txtfle">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_fle">
								<h4 class="panel-title">
								<b>FLEXURE STRENGTH</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_fle" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-md-6">
									<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_fle">2.</label>
												<input type="checkbox" class="visually-hidden" name="chk_fle"  id="chk_fle" value="chk_fle"><br>
											</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">FLEXURE STRENGTH</label>
									</div>
								</div>
							</div>	
							<div class="row">									
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Sr No</label>
									</div>
								</div>
								<!--<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Age of specimen (Days)</label>
									</div>
								</div>-->
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Width <br>(B)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Depth <br> (D)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Span Length <br> (L)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Distance of Fracture from Nearest Roller in mm <br> (A)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Beam Type</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Load (kN) <br> (P)</label>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Flexural Strength (N/mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
									</div>
								</div>
							</div>								
							<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">1.</label>
									</div>
								</div>
								<!--<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='age1' name='age1'>
									</div>
								</div>-->
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='b1' name='b1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='d1' name='d1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='l1' name='l1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='len1' name='len1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='pos1' name='pos1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='max1' name='max1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mod1' name='mod1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg1' name='avg1'>
									</div>
								</div>
							</div>
							<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">2.</label>
									</div>
								</div>
								<!--<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='age2' name='age2'>
									</div>
								</div>-->
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='b2' name='b2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='d2' name='d2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='l2' name='l2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='len2' name='len2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='pos2' name='pos2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='max2' name='max2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mod2' name='mod2'>
									</div>
								</div>
								<!--<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg2' name='avg2'>
									</div>
								</div>-->
							</div>
							<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">3.</label>
									</div>
								</div>
								<!--<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='age3' name='age3'>
									</div>
								</div>-->
								
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='b3' name='b3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='d3' name='d3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='l3' name='l3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='len3' name='len3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='pos3' name='pos3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='max3' name='max3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='mod3' name='mod3'>
									</div>
								</div>
								<!--<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg3' name='avg3'>
									</div>
								</div>-->
							</div>
						</div>
				  </div>
				</div>
				
		
						
				<?php
			}
			if($r1['test_code']=="com")
			{	
				$test_check.="com,";
				?>
				<div class="panel panel-default" id="com">
					<div class="panel-heading" id="txtcom">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_com">
								<h4 class="panel-title">
								<b>COMPRESSIVE STRENGTH</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_com" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-lg-8">
									<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_com">1.</label>
											<input type="checkbox" class="visually-hidden" name="chk_com"  id="chk_com" value="chk_com"><br>
										</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">COMPRESSIVE STRENGTH</label>
									</div>
								</div>
							</div>								
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Sr No.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">1.</label>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<label for="inputEmail3" class="col-sm-12 control-label text-center">2.</label>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<label for="inputEmail3" class="col-sm-12 control-label text-center">3.</label>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<label for="inputEmail3" class="col-sm-12 control-label text-center">4.</label>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<label for="inputEmail3" class="col-sm-12 control-label text-center">5.</label>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<label for="inputEmail3" class="col-sm-12 control-label text-center">6.</label>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<label for="inputEmail3" class="col-sm-12 control-label text-center">7.</label>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<label for="inputEmail3" class="col-sm-12 control-label text-center">8.</label>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<label for="inputEmail3" class="col-sm-12 control-label text-center">9.</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Location</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='loc1' name='loc1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='loc2' name='loc2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='loc3' name='loc3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='loc4' name='loc4'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='loc5' name='loc5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='loc6' name='loc6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='loc7' name='loc7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='loc8' name='loc8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='loc9' name='loc9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Weight (g)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='weight1' name='weight1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='weight2' name='weight2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='weight3' name='weight3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='weight4' name='weight5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='weight5' name='weight5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='weight6' name='weight6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='weight7' name='weight8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='weight8' name='weight8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='weight9' name='weight9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Dia (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dia1' name='dia1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='dia2' name='dia2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='dia3' name='dia3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='dia4' name='dia5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='dia5' name='dia5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='dia6' name='dia6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='dia7' name='dia7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='dia8' name='dia8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='dia9' name='dia9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Height (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='height1' name='height1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='height2' name='height2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='height3' name='height3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='height4' name='height4'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='height5' name='height5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='height6' name='height6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='height7' name='height7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='height8' name='height8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='height9' name='height9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">H/D Ratio</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='ratio1' name='ratio1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='ratio2' name='ratio2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='ratio3' name='ratio3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='ratio4' name='ratio4'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='ratio5' name='ratio5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='ratio6' name='ratio6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='ratio7' name='ratio7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='ratio8' name='ratio8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='ratio9' name='ratio9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Cross Sectional Area (mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='area1' name='area1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='area2' name='area2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='area3' name='area3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='area4' name='area4'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='area5' name='area5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='area6' name='area6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='area7' name='area7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='area8' name='area8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='area9' name='area9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Load (KN)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='load1' name='load1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='load2' name='load2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='load3' name='load3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='load4' name='load4'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='load5' name='load5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='load6' name='load6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='load7' name='load7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='load8' name='load8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='load9' name='load9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Comp Strength (N/mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='com1' name='com1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='com2' name='com2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='com3' name='com3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='com4' name='com4'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='com5' name='com5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='com6' name='com6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='com7' name='com7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='com8' name='com8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='com9' name='com9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">(H/D) as per IS 516(p-4)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='cor_a1' name='cor_a1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_a2' name='cor_a2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_a3' name='cor_a3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_a4' name='cor_a4'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_a5' name='cor_a5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_a6' name='cor_a6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_a7' name='cor_a7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_a8' name='cor_a8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_a9' name='cor_a9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">DIA as per IS 516(P-4)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='cor_b1' name='cor_b1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_b2' name='cor_b2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_b3' name='cor_b3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_b4' name='cor_b4'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_b5' name='cor_b5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_b6' name='cor_b6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_b7' name='cor_b7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_b8' name='cor_b8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_b9' name='cor_b9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Corrected Comp Strength (N/mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='cor_str1' name='cor_str1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_str2' name='cor_str2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_str3' name='cor_str3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_str4' name='cor_str4'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_str5' name='cor_str5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_str6' name='cor_str6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_str7' name='cor_str7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_str8' name='cor_str8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cor_str9' name='cor_str9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Equivalent Cube Strength (N/mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='cube_str1' name='cube_str1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cube_str2' name='cube_str2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cube_str3' name='cube_str3'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cube_str4' name='cube_str4'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cube_str5' name='cube_str5'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cube_str6' name='cube_str6'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cube_str7' name='cube_str7'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cube_str8' name='cube_str8'>
									</div>
								</div>
								<div class="col-md-1">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cube_str9' name='cube_str9'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Average Cube Strength (N/mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control" id='cube_avg1' name='cube_avg1'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cube_avg2' name='cube_avg2'>
									</div>                                                              
								</div>                                                                  
								<div class="col-md-3">                                                  
									<div class="form-group">                                            
										<input type="text" class="form-control" id='cube_avg3' name='cube_avg3'>
									</div>
								</div>
							</div>
							
						</div>
				  </div>
				</div>
						
				
					
			<?php
			}
			if($r1['test_code']=="spl")
			{	
				$test_check.="spl,";
				?>
				<div class="panel panel-default" id="spl">
					<div class="panel-heading" id="txtspl">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_spl">
								<h4 class="panel-title">
								<b>SPLITING TENSILE STRENGTH</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_spl" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_spl">3.</label>
													<input type="checkbox" class="visually-hidden" name="chk_spl"  id="chk_spl" value="chk_spl"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SPLITING TENSILE STRENGTH</label>
										</div>
									</div>
									
							</div>								
							<br>								
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Particular</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Specimen - 1</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Specimen - 2</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Specimen - 3</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading - 1</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='d_read1_1' name='d_read1_1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='d_read1_2' name='d_read1_2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='d_read1_3' name='d_read1_3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading - 2</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='d_read2_1' name='d_read2_1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='d_read2_2' name='d_read2_2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='d_read2_3' name='d_read2_3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading - 3</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='d_read3_1' name='d_read3_1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='d_read3_2' name='d_read3_2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='d_read3_3' name='d_read3_3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Average Diameter (mm)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_dia1' name='avg_dia1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_dia2' name='avg_dia2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_dia3' name='avg_dia3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading - 1</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='l_read1_1' name='l_read1_1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='l_read1_2' name='l_read1_2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='l_read1_3' name='l_read1_3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Reading - 2</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='l_read2_1' name='l_read2_1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='l_read2_2' name='l_read2_2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='l_read2_3' name='l_read2_3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Average Length</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_len1' name='avg_len1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_len2' name='avg_len2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_len3' name='avg_len3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Load (p) (KN)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='spl_load1' name='spl_load1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='spl_load2' name='spl_load2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='spl_load3' name='spl_load3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Splitting Strength (N/mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='spl_str1' name='spl_str1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='spl_str2' name='spl_str2'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='average' name='average'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label text-center">Average (N/mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='spl_avg1' name='spl_avg1'>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='spl_avg2' name='spl_avg12'>
									</div>
								</div>
								
							</div>
							
						</div>
				  </div>
				</div>
				
					
			
				
				
			<?php
			}
			if($r1['test_code']=="acc")
			{	
				$test_check.="acc,";
				?>
				<div class="panel panel-default" id="acc">
					<div class="panel-heading" id="txtacc">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_acc">
								<h4 class="panel-title">
								<b>ACCELERATED CURING</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_acc" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-lg-8">
									<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_acc">4.</label>
												<input type="checkbox" class="visually-hidden" name="chk_acc"  id="chk_acc" value="chk_acc"><br>
											</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">ACCELERATED CURING</label>
									</div>
								</div>
							</div>								
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Immersion Time (Curring Tank):</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" id='acc1' name='acc1'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Removal Time (Curring Tank):</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" id='acc2' name='acc2'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Immersion Time (Cooling Tank):</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" id='acc3' name='acc3'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Removal Time (Cooling Tank):</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" id='acc4' name='acc4'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Time of Commpresive Strength Test:</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" id='acc5' name='acc5'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Age of Specimen:</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control" id='acc6' name='acc6'>
									</div>
								</div>
							</div>
							<br>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Sr No</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">identification</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Weight (kg)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Length (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Width (mm)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Area (mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Load (KN)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Compressive Srength (N/mm<sup>2</sup>)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">Average Comp. Strength (N/mm<sup>2</sup>) </label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">1.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_id1' name='acc_id1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_w1' name='acc_w1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_l1' name='acc_l1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_width1' name='acc_width1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_area1' name='acc_area1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_load1' name='acc_load1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_com1' name='acc_com1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_avg1' name='acc_avg1'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">2.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_id2' name='acc_id2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_w2' name='acc_w2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_l2' name='acc_l2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_width2' name='acc_width2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_area2' name='acc_area2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_load2' name='acc_load2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_com2' name='acc_com2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_avg2' name='acc_avg2'>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label">3.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_id3' name='acc_id3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_w3' name='acc_w3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_l3' name='acc_l3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_width3' name='acc_width3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_area3' name='acc_area3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_load3' name='acc_load3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_com3' name='acc_com3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='acc_avg3' name='acc_avg3'>
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
							 $query = "select * from hard_concrete WHERE lab_no='$aa'  and `is_deleted`='0'";

								$result = mysqli_query($conn, $query);
			
								
								if (mysqli_num_rows($result) > 0) {
							while($r = mysqli_fetch_array($result)){
									
										if($r['is_deleted'] == 0){
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
$(document).ready(function(){ 
				   
	$('#btn_edit_data').hide();
	$('#alert').hide();
	
	
	
	function fle_auto()
	{
		$('#txtfle').css("background-color","var(--success)"); 
		var avg1 = randomNumberFromRange(4.50,6.30);
		$('#avg1').val((+avg1).toFixed(2));
		
		var avg1 = $('#avg1').val();
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var mod1 = (+avg1) + 0.11;
			var mod2 = (+avg1) - 0.18;
			var mod3 = (+avg1) + 0.07;
		}else{
			var mod1 = (+avg1) - 0.06;
			var mod2 = (+avg1) - 0.09;
			var mod3 = (+avg1) + 0.15;
		}
		$('#mod1').val((+mod1).toFixed(2));
		$('#mod2').val((+mod2).toFixed(2));
		$('#mod3').val((+mod3).toFixed(2));
		
		var beam_size = $('#beam_size').val();
		
		if(beam_size == '700_mm'){
			var b1 = randomNumberFromRange(149.80,150.20);
			var b2 = randomNumberFromRange(149.80,150.20);
			var b3 = randomNumberFromRange(149.80,150.20);
			
			$('#b1').val((+b1).toFixed(1));
			$('#b2').val((+b2).toFixed(1));
			$('#b3').val((+b3).toFixed(1));
			
			var d1 = randomNumberFromRange(149.80,150.20);
			var d2 = randomNumberFromRange(149.80,150.20);
			var d3 = randomNumberFromRange(149.80,150.20);
			
			$('#d1').val((+d1).toFixed(1));
			$('#d2').val((+d2).toFixed(1));
			$('#d3').val((+d3).toFixed(1));
			
			$('#l1').val(600);
			$('#l2').val(600);
			$('#l3').val(600);
		}else{
			var b1 = randomNumberFromRange(99.80,100.20);
			var b2 = randomNumberFromRange(99.80,100.20);
			var b3 = randomNumberFromRange(99.80,100.20);
			
			$('#b1').val((+b1).toFixed(1));
			$('#b2').val((+b2).toFixed(1));
			$('#b3').val((+b3).toFixed(1));
			
			var d1 = randomNumberFromRange(99.80,100.20);
			var d2 = randomNumberFromRange(99.80,100.20);
			var d3 = randomNumberFromRange(99.80,100.20);
			
			$('#d1').val((+d1).toFixed(1));
			$('#d2').val((+d2).toFixed(1));
			$('#d3').val((+d3).toFixed(1));
			
			$('#l1').val(400);
			$('#l2').val(400);
			$('#l3').val(400);
		}
		
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var a = randomNumberFromRange(170,195).toFixed();
			if((+randomNumberFromRange(1,9).toFixed())%2==0){
				var len1 = (+a) + (+2);
				var len2 = (+a) - (+1);
				var len3 = (+a) - (+2);
			}else{
				var len1 = (+a) - (+3);
				var len2 = (+a) + (+2);
				var len3 = (+a) - (+2);
			}
		}else{
			var a = randomNumberFromRange(205,250).toFixed();
			if((+randomNumberFromRange(1,9).toFixed())%2==0){
				var len1 = (+a) + (+3);
				var len2 = (+a) + (+1);
				var len3 = (+a) - (+2);
			}else{
				var len1 = (+a) - (+3);
				var len2 = (+a) + (+2);
				var len3 = (+a) - (+2);
			}
		}
		$('#len1').val((+len1).toFixed());
		$('#len2').val((+len2).toFixed());
		$('#len3').val((+len3).toFixed());
		
		var len1 = $('#len1').val();
		var len2 = $('#len2').val();
		var len3 = $('#len3').val();
		
		var mod1 = $('#mod1').val();
		var mod2 = $('#mod2').val();
		var mod3 = $('#mod3').val();
		
		var b1 = $('#b1').val();
		var b2 = $('#b2').val();
		var b3 = $('#b3').val();
		
		var d1 = $('#d1').val();
		var d2 = $('#d2').val();
		var d3 = $('#d3').val();
		
		var l1 = $('#l1').val();
		var l2 = $('#l2').val();
		var l3 = $('#l3').val();
		
		if((+len1) >= 200){
			var max1 = ((+mod1) * (+b1) * (+d1) * (+d1)) / ((+l1) * (+1000));
			$('#pos1').val('A');
		}else{
			var max1 = ((+mod1) * (+b1) * (+d1) * (+d1)) / (3 * (+len1) * (+1000));
			$('#pos1').val('B');
		}
		
		if((+len1) >= 200){
			var max2 = ((+mod2) * (+b2) * (+d2) * (+d2)) / ((+l2) * (+1000));
			$('#pos2').val('A');
		}else{
			var max2 = ((+mod2) * (+b2) * (+d2) * (+d2)) / (3 * (+len2) * (+1000));
			$('#pos2').val('B');
		}
		
		if((+len1) >= 200){
			var max3 = ((+mod3) * (+b3) * (+d3) * (+d3)) / ((+l3) * (+1000));
			$('#pos3').val('A');
		}else{
			var max3 = ((+mod3) * (+b3) * (+d3) * (+d3)) / (3 * (+len3) * (+1000));
			$('#pos3').val('B');
		}
		
		$('#max1').val((+max1).toFixed(1));
		$('#max2').val((+max2).toFixed(1));
		$('#max3').val((+max3).toFixed(1));
		
		
		/*
		$('#pos1').val(1);
		$('#pos2').val(1);
		$('#pos3').val(1);*/
		
	}
	
	
	$('#chk_fle').change(function(){
        if(this.checked)
		{
			fle_auto();
		}
		else
		{
			$('#txtfle').css("background-color","white");
			$('#age1').val(null);
			$('#age2').val(null);
			$('#age3').val(null);
			$('#l1').val(null);
			$('#l2').val(null);
			$('#l3').val(null);
			$('#b1').val(null);
			$('#b2').val(null);
			$('#b3').val(null);
			$('#d1').val(null);
			$('#d2').val(null);
			$('#d3').val(null);
			$('#len1').val(null);
			$('#len2').val(null);
			$('#len3').val(null);
			$('#max1').val(null);
			$('#max2').val(null);
			$('#max3').val(null);
			$('#pos1').val(null);
			$('#pos2').val(null);
			$('#pos3').val(null);
			$('#mod1').val(null);
			$('#mod2').val(null);
			$('#mod3').val(null);
			$('#avg1').val(null);
			$('#avg2').val(null);
			$('#avg3').val(null);
			
		}
	});
	
	
	$('#l1,#l2,#l3,#b1,#b2,#b3,#d1,#d2,#d3,#len1,#len2,#len3,#max1,#max2,#max3').change(function(){
		
		$('#txtfle').css("background-color","var(--success)");
		
		var l1 = $('#l1').val();
		var l2 = $('#l2').val();
		var l3 = $('#l3').val();
		
		var b1 = $('#b1').val();
		var b2 = $('#b2').val();
		var b3 = $('#b3').val();
		
		var d1 = $('#d1').val();
		var d2 = $('#d2').val();
		var d3 = $('#d3').val();
		
		var len1 = $('#len1').val();
		var len2 = $('#len2').val();
		var len3 = $('#len3').val();
		
		var max1 = $('#max1').val();
		var max2 = $('#max2').val();
		var max3 = $('#max3').val();
		
		if((+len1) >= 200){
			var mod1 = ((+max1) * (+l1) * (+1000)) / ((+b1) * (+d1) * (+d1));
		}else{
			var mod1 = ((+3) * (+max1) * (+len1) * (+1000)) / ((+b1) * (+d1) * (+d1));
		}
		
		if((+len2) >= 200){
			var mod2 = ((+max2) * (+l2) * (+1000)) / ((+b2) * (+d2) * (+d2));
		}else{
			var mod2 = ((+3) * (+max2) * (+len2) * (+1000)) / ((+b2) * (+d2) * (+d2));
		}
		
		if((+len3) >= 200){
			var mod3 = ((+max3) * (+l3) * (+1000)) / ((+b3) * (+d3) * (+d3));
		}else{
			var mod3 = ((+3) * (+max3) * (+len3) * (+1000)) / ((+b3) * (+d3) * (+d3));
		}
		
		$('#mod1').val((+mod1).toFixed(2));
		$('#mod2').val((+mod2).toFixed(2));
		$('#mod3').val((+mod3).toFixed(2));
		
		var mod1 = $('#mod1').val();
		var mod2 = $('#mod2').val();
		var mod3 = $('#mod3').val();
		
		var avg1 = ((+mod1) + (+mod2) + (+mod3))/3;
		$('#avg1').val((+avg1).toFixed(2));
	})
	
	$('#avg1').change(function(){
		$('#txtfle').css("background-color","var(--success)");
		
		var avg1 = $('#avg1').val();
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var mod1 = (+avg1) + 0.11;
			var mod2 = (+avg1) - 0.18;
			var mod3 = (+avg1) + 0.07;
		}else{
			var mod1 = (+avg1) - 0.06;
			var mod2 = (+avg1) - 0.09;
			var mod3 = (+avg1) + 0.15;
		}
		$('#mod1').val((+mod1).toFixed(2));
		$('#mod2').val((+mod2).toFixed(2));
		$('#mod3').val((+mod3).toFixed(2));
		
		var beam_size = $('#beam_size').val();
		
		if(beam_size == '700_mm'){
			var b1 = randomNumberFromRange(149.80,150.20);
			var b2 = randomNumberFromRange(149.80,150.20);
			var b3 = randomNumberFromRange(149.80,150.20);
			
			$('#b1').val((+b1).toFixed(1));
			$('#b2').val((+b2).toFixed(1));
			$('#b3').val((+b3).toFixed(1));
			
			var d1 = randomNumberFromRange(149.80,150.20);
			var d2 = randomNumberFromRange(149.80,150.20);
			var d3 = randomNumberFromRange(149.80,150.20);
			
			$('#d1').val((+d1).toFixed(1));
			$('#d2').val((+d2).toFixed(1));
			$('#d3').val((+d3).toFixed(1));
			
			$('#l1').val(600);
			$('#l2').val(600);
			$('#l3').val(600);
		}else{
			var b1 = randomNumberFromRange(99.80,100.20);
			var b2 = randomNumberFromRange(99.80,100.20);
			var b3 = randomNumberFromRange(99.80,100.20);
			
			$('#b1').val((+b1).toFixed(1));
			$('#b2').val((+b2).toFixed(1));
			$('#b3').val((+b3).toFixed(1));
			
			var d1 = randomNumberFromRange(99.80,100.20);
			var d2 = randomNumberFromRange(99.80,100.20);
			var d3 = randomNumberFromRange(99.80,100.20);
			
			$('#d1').val((+d1).toFixed(1));
			$('#d2').val((+d2).toFixed(1));
			$('#d3').val((+d3).toFixed(1));
			
			$('#l1').val(400);
			$('#l2').val(400);
			$('#l3').val(400);
		}
		
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var a = randomNumberFromRange(170,195).toFixed();
			if((+randomNumberFromRange(1,9).toFixed())%2==0){
				var len1 = (+a) + (+2);
				var len2 = (+a) - (+1);
				var len3 = (+a) - (+2);
			}else{
				var len1 = (+a) - (+3);
				var len2 = (+a) + (+2);
				var len3 = (+a) - (+2);
			}
		}else{
			var a = randomNumberFromRange(205,250).toFixed();
			if((+randomNumberFromRange(1,9).toFixed())%2==0){
				var len1 = (+a) + (+3);
				var len2 = (+a) + (+1);
				var len3 = (+a) - (+2);
			}else{
				var len1 = (+a) - (+3);
				var len2 = (+a) + (+2);
				var len3 = (+a) - (+2);
			}
		}
		$('#len1').val((+len1).toFixed());
		$('#len2').val((+len2).toFixed());
		$('#len3').val((+len3).toFixed());
		
		var len1 = $('#len1').val();
		var len2 = $('#len2').val();
		var len3 = $('#len3').val();
		
		var mod1 = $('#mod1').val();
		var mod2 = $('#mod2').val();
		var mod3 = $('#mod3').val();
		
		var b1 = $('#b1').val();
		var b2 = $('#b2').val();
		var b3 = $('#b3').val();
		
		var d1 = $('#d1').val();
		var d2 = $('#d2').val();
		var d3 = $('#d3').val();
		
		var l1 = $('#l1').val();
		var l2 = $('#l2').val();
		var l3 = $('#l3').val();
		
		if((+len1) >= 200){
			var max1 = ((+mod1) * (+b1) * (+d1) * (+d1)) / ((+l1) * (+1000));
			$('#pos1').val('A');
		}else{
			var max1 = ((+mod1) * (+b1) * (+d1) * (+d1)) / (3 * (+len1) * (+1000));
			$('#pos1').val('B');
		}
		
		if((+len1) >= 200){
			var max2 = ((+mod2) * (+b2) * (+d2) * (+d2)) / ((+l2) * (+1000));
			$('#pos2').val('A');
		}else{
			var max2 = ((+mod2) * (+b2) * (+d2) * (+d2)) / (3 * (+len2) * (+1000));
			$('#pos2').val('B');
		}
		
		if((+len1) >= 200){
			var max3 = ((+mod3) * (+b3) * (+d3) * (+d3)) / ((+l3) * (+1000));
			$('#pos3').val('A');
		}else{
			var max3 = ((+mod3) * (+b3) * (+d3) * (+d3)) / (3 * (+len3) * (+1000));
			$('#pos3').val('B');
		}
		
		$('#max1').val((+max1).toFixed(1));
		$('#max2').val((+max2).toFixed(1));
		$('#max3').val((+max3).toFixed(1));
	})
	
	
	
	
	function com_auto()
	{
		$('#txtcom').css("background-color","var(--success)"); 
		$('#loc1').val(1);
		$('#loc2').val(1);
		$('#loc3').val(1);
		$('#loc4').val(1);
		$('#loc5').val(1);
		$('#loc6').val(1);
		$('#loc7').val(1);
		$('#loc8').val(1);
		$('#loc9').val(1);
		$('#weight1').val(1);
		$('#weight2').val(1);
		$('#weight3').val(1);
		$('#weight4').val(1);
		$('#weight5').val(1);
		$('#weight6').val(1);
		$('#weight7').val(1);
		$('#weight8').val(1);
		$('#weight9').val(1);
		$('#dia1').val(1);
		$('#dia2').val(1);
		$('#dia3').val(1);
		$('#dia4').val(1);
		$('#dia5').val(1);
		$('#dia6').val(1);
		$('#dia7').val(1);
		$('#dia8').val(1);
		$('#dia9').val(1);
		$('#height1').val(1);
		$('#height2').val(1);
		$('#height3').val(1);
		$('#height4').val(1);
		$('#height5').val(1);
		$('#height6').val(1);
		$('#height7').val(1);
		$('#height8').val(1);
		$('#height9').val(1);
		$('#ratio1').val(1);
		$('#ratio2').val(1);
		$('#ratio3').val(1);
		$('#ratio4').val(1);
		$('#ratio5').val(1);
		$('#ratio6').val(1);
		$('#ratio7').val(1);
		$('#ratio8').val(1);
		$('#ratio9').val(1);
		$('#area1').val(1);
		$('#area2').val(1);
		$('#area3').val(1);
		$('#area4').val(1);
		$('#area5').val(1);
		$('#area6').val(1);
		$('#area7').val(1);
		$('#area8').val(1);
		$('#area9').val(1);
		$('#load1').val(1);
		$('#load2').val(1);
		$('#load3').val(1);
		$('#load4').val(1);
		$('#load5').val(1);
		$('#load6').val(1);
		$('#load7').val(1);
		$('#load8').val(1);
		$('#load9').val(1);
		$('#com1').val(1);
		$('#com2').val(1);
		$('#com3').val(1);
		$('#com4').val(1);
		$('#com5').val(1);
		$('#com6').val(1);
		$('#com7').val(1);
		$('#com8').val(1);
		$('#com9').val(1);
		$('#cor_a1').val(1);
		$('#cor_a2').val(1);
		$('#cor_a3').val(1);
		$('#cor_a4').val(1);
		$('#cor_a5').val(1);
		$('#cor_a6').val(1);
		$('#cor_a7').val(1);
		$('#cor_a8').val(1);
		$('#cor_a9').val(1);
		$('#cor_b1').val(1);
		$('#cor_b2').val(1);
		$('#cor_b3').val(1);
		$('#cor_b4').val(1);
		$('#cor_b5').val(1);
		$('#cor_b6').val(1);
		$('#cor_b7').val(1);
		$('#cor_b8').val(1);
		$('#cor_b9').val(1);
		$('#cor_str1').val(1);
		$('#cor_str2').val(1);
		$('#cor_str3').val(1);
		$('#cor_str4').val(1);
		$('#cor_str5').val(1);
		$('#cor_str6').val(1);
		$('#cor_str7').val(1);
		$('#cor_str8').val(1);
		$('#cor_str9').val(1);
		$('#cube_str1').val(1);
		$('#cube_str2').val(1);
		$('#cube_str3').val(1);
		$('#cube_str4').val(1);
		$('#cube_str5').val(1);
		$('#cube_str6').val(1);
		$('#cube_str7').val(1);
		$('#cube_str8').val(1);
		$('#cube_str9').val(1);
		$('#cube_avg1').val(1);
		$('#cube_avg2').val(1);
		$('#cube_avg3').val(1);
	}
	
	
	$('#chk_com').change(function(){
        if(this.checked)
		{
			com_auto();
		}
		else
		{
			$('#txtcom').css("background-color","white");
			$('#loc1').val(null);
			$('#loc2').val(null);
			$('#loc3').val(null);
			$('#loc4').val(null);
			$('#loc5').val(null);
			$('#loc6').val(null);
			$('#loc7').val(null);
			$('#loc8').val(null);
			$('#loc9').val(null);
			$('#weight1').val(null);
			$('#weight2').val(null);
			$('#weight3').val(null);
			$('#weight4').val(null);
			$('#weight5').val(null);
			$('#weight6').val(null);
			$('#weight7').val(null);
			$('#weight8').val(null);
			$('#weight9').val(null);
			$('#dia1').val(null);
			$('#dia2').val(null);
			$('#dia3').val(null);
			$('#dia4').val(null);
			$('#dia5').val(null);
			$('#dia6').val(null);
			$('#dia7').val(null);
			$('#dia8').val(null);
			$('#dia9').val(null);
			$('#height1').val(null);
			$('#height2').val(null);
			$('#height3').val(null);
			$('#height4').val(null);
			$('#height5').val(null);
			$('#height6').val(null);
			$('#height7').val(null);
			$('#height8').val(null);
			$('#height9').val(null);
			$('#ratio1').val(null);
			$('#ratio2').val(null);
			$('#ratio3').val(null);
			$('#ratio4').val(null);
			$('#ratio5').val(null);
			$('#ratio6').val(null);
			$('#ratio7').val(null);
			$('#ratio8').val(null);
			$('#ratio9').val(null);
			$('#area1').val(null);
			$('#area2').val(null);
			$('#area3').val(null);
			$('#area4').val(null);
			$('#area5').val(null);
			$('#area6').val(null);
			$('#area7').val(null);
			$('#area8').val(null);
			$('#area9').val(null);
			$('#load1').val(null);
			$('#load2').val(null);
			$('#load3').val(null);
			$('#load4').val(null);
			$('#load5').val(null);
			$('#load6').val(null);
			$('#load7').val(null);
			$('#load8').val(null);
			$('#load9').val(null);
			$('#com1').val(null);
			$('#com2').val(null);
			$('#com3').val(null);
			$('#com4').val(null);
			$('#com5').val(null);
			$('#com6').val(null);
			$('#com7').val(null);
			$('#com8').val(null);
			$('#com9').val(null);
			$('#cor_a1').val(null);
			$('#cor_a2').val(null);
			$('#cor_a3').val(null);
			$('#cor_a4').val(null);
			$('#cor_a5').val(null);
			$('#cor_a6').val(null);
			$('#cor_a7').val(null);
			$('#cor_a8').val(null);
			$('#cor_a9').val(null);
			$('#cor_b1').val(null);
			$('#cor_b2').val(null);
			$('#cor_b3').val(null);
			$('#cor_b4').val(null);
			$('#cor_b5').val(null);
			$('#cor_b6').val(null);
			$('#cor_b7').val(null);
			$('#cor_b8').val(null);
			$('#cor_b9').val(null);
			$('#cor_str1').val(null);
			$('#cor_str2').val(null);
			$('#cor_str3').val(null);
			$('#cor_str4').val(null);
			$('#cor_str5').val(null);
			$('#cor_str6').val(null);
			$('#cor_str7').val(null);
			$('#cor_str8').val(null);
			$('#cor_str9').val(null);
			$('#cube_str1').val(null);
			$('#cube_str2').val(null);
			$('#cube_str3').val(null);
			$('#cube_str4').val(null);
			$('#cube_str5').val(null);
			$('#cube_str6').val(null);
			$('#cube_str7').val(null);
			$('#cube_str8').val(null);
			$('#cube_str9').val(null);
			$('#cube_avg1').val(null);
			$('#cube_avg2').val(null);
			$('#cube_avg3').val(null);
		}
	});
	
	
	
	function spl_auto()
	{
		$('#txtspl').css("background-color","var(--success)"); 
		$('#d_read1_1').val(1);
		$('#d_read1_2').val(1);
		$('#d_read1_3').val(1);
		$('#d_read2_1').val(1);
		$('#d_read2_2').val(1);
		$('#d_read2_3').val(1);
		$('#d_read3_1').val(1);
		$('#d_read3_2').val(1);
		$('#d_read3_3').val(1);
		$('#avg_dia1').val(1);
		$('#avg_dia2').val(1);
		$('#avg_dia3').val(1);
		$('#l_read1_1').val(1);
		$('#l_read1_2').val(1);
		$('#l_read1_3').val(1);
		$('#l_read2_1').val(1);
		$('#l_read2_2').val(1);
		$('#l_read2_3').val(1);
		$('#avg_len1').val(1);
		$('#avg_len2').val(1);
		$('#avg_len3').val(1);
		$('#spl_load1').val(1);
		$('#spl_load2').val(1);
		$('#spl_load3').val(1);
		$('#spl_str1').val(1);
		$('#spl_str2').val(1);
		$('#spl_avg1').val(1);
		$('#spl_avg2').val(1);
		$('#average').val(1);
	}
	
	
	$('#chk_spl').change(function(){
        if(this.checked)
		{
			spl_auto();
		}
		else
		{
			$('#txtspl').css("background-color","white");
			$('#d_read1_1').val(null);
			$('#d_read1_2').val(null);
			$('#d_read1_3').val(null);
			$('#d_read2_1').val(null);
			$('#d_read2_2').val(null);
			$('#d_read2_3').val(null);
			$('#d_read3_1').val(null);
			$('#d_read3_2').val(null);
			$('#d_read3_3').val(null);
			$('#avg_dia1').val(null);
			$('#avg_dia2').val(null);
			$('#avg_dia3').val(null);
			$('#l_read1_1').val(null);
			$('#l_read1_2').val(null);
			$('#l_read1_3').val(null);
			$('#l_read2_1').val(null);
			$('#l_read2_2').val(null);
			$('#l_read2_3').val(null);
			$('#avg_len1').val(null);
			$('#avg_len2').val(null);
			$('#avg_len3').val(null);
			$('#spl_load1').val(null);
			$('#spl_load2').val(null);
			$('#spl_load3').val(null);
			$('#spl_str1').val(null);
			$('#spl_str2').val(null);
			$('#spl_avg1').val(null);
			$('#spl_avg2').val(null);
			$('#average').val(null);
		}
	});
	
	
	
	function acc_auto()
	{
		$('#txtacc').css("background-color","var(--success)"); 
		$('#acc1').val(1);
		$('#acc2').val(1);
		$('#acc3').val(1);
		$('#acc4').val(1);
		$('#acc5').val(1);
		$('#acc6').val(1);
		$('#acc_id1').val(1);
		$('#acc_id2').val(1);
		$('#acc_id3').val(1);
		$('#acc_w1').val(1);
		$('#acc_w2').val(1);
		$('#acc_w3').val(1);
		$('#acc_l1').val(1);
		$('#acc_l2').val(1);
		$('#acc_l3').val(1);
		$('#acc_width1').val(1);
		$('#acc_width2').val(1);
		$('#acc_width3').val(1);
		$('#acc_area1').val(1);
		$('#acc_area2').val(1);
		$('#acc_area3').val(1);
		$('#acc_load1').val(1);
		$('#acc_load2').val(1);
		$('#acc_load3').val(1);
		$('#acc_com1').val(1);
		$('#acc_com2').val(1);
		$('#acc_com3').val(1);
		$('#acc_avg1').val(1);
		$('#acc_avg2').val(1);
		$('#acc_avg3').val(1);
	}
	
	
	$('#chk_acc').change(function(){
        if(this.checked)
		{
			acc_auto();
		}
		else
		{
			$('#txtacc').css("background-color","white");
			$('#acc1').val(null);
			$('#acc2').val(null);
			$('#acc3').val(null);
			$('#acc4').val(null);
			$('#acc5').val(null);
			$('#acc6').val(null);
			$('#acc_id1').val(null);
			$('#acc_id2').val(null);
			$('#acc_id3').val(null);
			$('#acc_w1').val(null);
			$('#acc_w2').val(null);
			$('#acc_w3').val(null);
			$('#acc_l1').val(null);
			$('#acc_l2').val(null);
			$('#acc_l3').val(null);
			$('#acc_width1').val(null);
			$('#acc_width2').val(null);
			$('#acc_width3').val(null);
			$('#acc_area1').val(null);
			$('#acc_area2').val(null);
			$('#acc_area3').val(null);
			$('#acc_load1').val(null);
			$('#acc_load2').val(null);
			$('#acc_load3').val(null);
			$('#acc_com1').val(null);
			$('#acc_com2').val(null);
			$('#acc_com3').val(null);
			$('#acc_avg1').val(null);
			$('#acc_avg2').val(null);
			$('#acc_avg3').val(null);
		}
	});
	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","var(--success)"); 
			//$('#txtwtr').css("background-color","var(--success)"); 
			
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				
				
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fle")
					{
						$('#txtfle').css("background-color","var(--success)");
						$("#chk_fle").prop("checked", true); 
						fle_auto();
						break;
					}					
				}
				
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						$('#txtcom').css("background-color","var(--success)");
						$("#chk_com").prop("checked", true); 
						com_auto();
						break;
					}					
				}
				
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spl")
					{
						$('#txtspl').css("background-color","var(--success)");
						$("#chk_spl").prop("checked", true); 
						spl_auto();
						break;
					}					
				}
				
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="acc")
					{
						$('#txtacc').css("background-color","var(--success)");
						$("#chk_acc").prop("checked", true); 
						acc_auto();
						break;
					}					
				}
				
		}
		
	});
	
	});


function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}


$("#btn_edit_data").click(function(){
			$('#btn_edit_data').hide();
			$('#btn_save').show();

	});
function getGlazedTiles(){
				var lab_no = $('#lab_no').val(); 
				var report_no = $('#report_no').val(); 
				var job_no=$('#job_no').val();
     $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_hard_concrete.php',
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
				var grade_fresh = $('#grade_fresh').val();
				var slump_req = $('#slump_req').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");				
									
				//fle
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fle")
					{
						if(document.getElementById('chk_fle').checked) {
								var chk_fle = "1";
						}
						else{
								var chk_fle = "0";
						}
						var age1 = $('#age1').val();
						var age2 = $('#age2').val();
						var age3 = $('#age3').val();
						var l1 = $('#l1').val();
						var l2 = $('#l2').val();
						var l3 = $('#l3').val();
						var b1 = $('#b1').val();
						var b2 = $('#b2').val();
						var b3 = $('#b3').val();
						var d1 = $('#d1').val();
						var d2 = $('#d2').val();
						var d3 = $('#d3').val();
						var len1 = $('#len1').val();
						var len2 = $('#len2').val();
						var len3 = $('#len3').val();
						var max1 = $('#max1').val();
						var max2 = $('#max2').val();
						var max3 = $('#max3').val();
						var pos1 = $('#pos1').val();
						var pos2 = $('#pos2').val();
						var pos3 = $('#pos3').val();
						var mod1 = $('#mod1').val();
						var mod2 = $('#mod2').val();
						var mod3 = $('#mod3').val();
						var avg1 = $('#avg1').val();
						var avg2 = $('#avg2').val();
						var avg3 = $('#avg3').val();
							
						break;
					}
					else
					{
						var chk_fle = "0";
						var age1 = "0";
						var age2 = "0";
						var age3 = "0";
						var l1 = "0";
						var l2 = "0";
						var l3 = "0";
						var b1 = "0";
						var b2 = "0";
						var b3 = "0";
						var d1 = "0";
						var d2 = "0";
						var d3 = "0";
						var len1 = "0";
						var len2 = "0";
						var len3 = "0";
						var max1 = "0";
						var max2 = "0";
						var max3 = "0";
						var pos1 = "0";
						var pos2 = "0";
						var pos3 = "0";
						var mod1 = "0";
						var mod2 = "0";
						var mod3 = "0";
						var avg1 = "0";
						var avg2 = "0";
						var avg3 = "0";
					}
				}
				
				//com
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						if(document.getElementById('chk_com').checked) {
								var chk_com = "1";
						}
						else{
								var chk_com = "0";
						}
						var loc1 = $('#loc1').val();
						var loc2 = $('#loc2').val();
						var loc3 = $('#loc3').val();
						var loc4 = $('#loc4').val();
						var loc5 = $('#loc5').val();
						var loc6 = $('#loc6').val();
						var loc7 = $('#loc7').val();
						var loc8 = $('#loc8').val();
						var loc9 = $('#loc9').val();
						var weight1 = $('#weight1').val();
						var weight2 = $('#weight2').val();
						var weight3 = $('#weight3').val();
						var weight4 = $('#weight4').val();
						var weight5 = $('#weight5').val();
						var weight6 = $('#weight6').val();
						var weight7 = $('#weight7').val();
						var weight8 = $('#weight8').val();
						var weight9 = $('#weight9').val();
						var dia1 = $('#dia1').val();
						var dia2 = $('#dia2').val();
						var dia3 = $('#dia3').val();
						var dia4 = $('#dia4').val();
						var dia5 = $('#dia5').val();
						var dia6 = $('#dia6').val();
						var dia7 = $('#dia7').val();
						var dia8 = $('#dia8').val();
						var dia9 = $('#dia9').val();
						var height1 = $('#height1').val();
						var height2 = $('#height2').val();
						var height3 = $('#height3').val();
						var height4 = $('#height4').val();
						var height5 = $('#height5').val();
						var height6 = $('#height6').val();
						var height7 = $('#height7').val();
						var height8 = $('#height8').val();
						var height9 = $('#height9').val();
						var ratio1 = $('#ratio1').val();
						var ratio2 = $('#ratio2').val();
						var ratio3 = $('#ratio3').val();
						var ratio4 = $('#ratio4').val();
						var ratio5 = $('#ratio5').val();
						var ratio6 = $('#ratio6').val();
						var ratio7 = $('#ratio7').val();
						var ratio8 = $('#ratio8').val();
						var ratio9 = $('#ratio9').val();
						var area1 = $('#area1').val();
						var area2 = $('#area2').val();
						var area3 = $('#area3').val();
						var area4 = $('#area4').val();
						var area5 = $('#area5').val();
						var area6 = $('#area6').val();
						var area7 = $('#area7').val();
						var area8 = $('#area8').val();
						var area9 = $('#area9').val();
						var load1 = $('#load1').val();
						var load2 = $('#load2').val();
						var load3 = $('#load3').val();
						var load4 = $('#load4').val();
						var load5 = $('#load5').val();
						var load6 = $('#load6').val();
						var load7 = $('#load7').val();
						var load8 = $('#load8').val();
						var load9 = $('#load9').val();
						var com1 = $('#com1').val();
						var com2 = $('#com2').val();
						var com3 = $('#com3').val();
						var com4 = $('#com4').val();
						var com5 = $('#com5').val();
						var com6 = $('#com6').val();
						var com7 = $('#com7').val();
						var com8 = $('#com8').val();
						var com9 = $('#com9').val();
						var cor_a1 = $('#cor_a1').val();
						var cor_a2 = $('#cor_a2').val();
						var cor_a3 = $('#cor_a3').val();
						var cor_a4 = $('#cor_a4').val();
						var cor_a5 = $('#cor_a5').val();
						var cor_a6 = $('#cor_a6').val();
						var cor_a7 = $('#cor_a7').val();
						var cor_a8 = $('#cor_a8').val();
						var cor_a9 = $('#cor_a9').val();
						var cor_b1 = $('#cor_b1').val();
						var cor_b2 = $('#cor_b2').val();
						var cor_b3 = $('#cor_b3').val();
						var cor_b4 = $('#cor_b4').val();
						var cor_b5 = $('#cor_b5').val();
						var cor_b6 = $('#cor_b6').val();
						var cor_b7 = $('#cor_b7').val();
						var cor_b8 = $('#cor_b8').val();
						var cor_b9 = $('#cor_b9').val();
						var cor_str1 = $('#cor_str1').val();
						var cor_str2 = $('#cor_str2').val();
						var cor_str3 = $('#cor_str3').val();
						var cor_str4 = $('#cor_str4').val();
						var cor_str5 = $('#cor_str5').val();
						var cor_str6 = $('#cor_str6').val();
						var cor_str7 = $('#cor_str7').val();
						var cor_str8 = $('#cor_str8').val();
						var cor_str9 = $('#cor_str9').val();
						var cube_str1 = $('#cube_str1').val();
						var cube_str2 = $('#cube_str2').val();
						var cube_str3 = $('#cube_str3').val();
						var cube_str4 = $('#cube_str4').val();
						var cube_str5 = $('#cube_str5').val();
						var cube_str6 = $('#cube_str6').val();
						var cube_str7 = $('#cube_str7').val();
						var cube_str8 = $('#cube_str8').val();
						var cube_str9 = $('#cube_str9').val();
						var cube_avg1 = $('#cube_avg1').val();
						var cube_avg2 = $('#cube_avg2').val();
						var cube_avg3 = $('#cube_avg3').val();
							
						break;
					}
					else
					{
						var chk_com = "0";
						var loc1 = "0";
						var loc2 = "0";
						var loc3 = "0";
						var loc4 = "0";
						var loc5 = "0";
						var loc6 = "0";
						var loc7 = "0";
						var loc8 = "0";
						var loc9 = "0";
						var weight1 = "0";
						var weight2 = "0";
						var weight3 = "0";
						var weight4 = "0";
						var weight5 = "0";
						var weight6 = "0";
						var weight7 = "0";
						var weight8 = "0";
						var weight9 = "0";
						var dia1 = "0";
						var dia2 = "0";
						var dia3 = "0";
						var dia4 = "0";
						var dia5 = "0";
						var dia6 = "0";
						var dia7 = "0";
						var dia8 = "0";
						var dia9 = "0";
						var height1 = "0";
						var height2 = "0";
						var height3 = "0";
						var height4 = "0";
						var height5 = "0";
						var height6 = "0";
						var height7 = "0";
						var height8 = "0";
						var height9 = "0";
						var ratio1 = "0";
						var ratio2 = "0";
						var ratio3 = "0";
						var ratio4 = "0";
						var ratio5 = "0";
						var ratio6 = "0";
						var ratio7 = "0";
						var ratio8 = "0";
						var ratio9 = "0";
						var area1 = "0";
						var area2 = "0";
						var area3 = "0";
						var area4 = "0";
						var area5 = "0";
						var area6 = "0";
						var area7 = "0";
						var area8 = "0";
						var area9 = "0";
						var load1 = "0";
						var load2 = "0";
						var load3 = "0";
						var load4 = "0";
						var load5 = "0";
						var load6 = "0";
						var load7 = "0";
						var load8 = "0";
						var load9 = "0";
						var com1 = "0";
						var com2 = "0";
						var com3 = "0";
						var com4 = "0";
						var com5 = "0";
						var com6 = "0";
						var com7 = "0";
						var com8 = "0";
						var com9 = "0";
						var cor_a1 = "0";
						var cor_a2 = "0";
						var cor_a3 = "0";
						var cor_a4 = "0";
						var cor_a5 = "0";
						var cor_a6 = "0";
						var cor_a7 = "0";
						var cor_a8 = "0";
						var cor_a9 = "0";
						var cor_b1 = "0";
						var cor_b2 = "0";
						var cor_b3 = "0";
						var cor_b4 = "0";
						var cor_b5 = "0";
						var cor_b6 = "0";
						var cor_b7 = "0";
						var cor_b8 = "0";
						var cor_b9 = "0";
						var cor_str1 = "0";
						var cor_str2 = "0";
						var cor_str3 = "0";
						var cor_str4 = "0";
						var cor_str5 = "0";
						var cor_str6 = "0";
						var cor_str7 = "0";
						var cor_str8 = "0";
						var cor_str9 = "0";
						var cube_str1 = "0";
						var cube_str2 = "0";
						var cube_str3 = "0";
						var cube_str4 = "0";
						var cube_str5 = "0";
						var cube_str6 = "0";
						var cube_str7 = "0";
						var cube_str8 = "0";
						var cube_str9 = "0";
						var cube_avg1 = "0";
						var cube_avg2 = "0";
						var cube_avg3 = "0";
					}
				}
				
				//spl
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spl")
					{
						if(document.getElementById('chk_spl').checked) {
								var chk_spl = "1";
						}
						else{
								var chk_spl = "0";
						}
						var d_read1_1 = $('#d_read1_1').val();
						var d_read1_2 = $('#d_read1_2').val();
						var d_read1_3 = $('#d_read1_3').val();
						var d_read2_1 = $('#d_read2_1').val();
						var d_read2_2 = $('#d_read2_2').val();
						var d_read2_3 = $('#d_read2_3').val();
						var d_read3_1 = $('#d_read3_1').val();
						var d_read3_2 = $('#d_read3_2').val();
						var d_read3_3 = $('#d_read3_3').val();
						var avg_dia1 = $('#avg_dia1').val();
						var avg_dia2 = $('#avg_dia2').val();
						var avg_dia3 = $('#avg_dia3').val();
						var l_read1_1 = $('#l_read1_1').val();
						var l_read1_2 = $('#l_read1_2').val();
						var l_read1_3 = $('#l_read1_3').val();
						var l_read2_1 = $('#l_read2_1').val();
						var l_read2_2 = $('#l_read2_2').val();
						var l_read2_3 = $('#l_read2_3').val();
						var avg_len1 = $('#avg_len1').val();
						var avg_len2 = $('#avg_len2').val();
						var avg_len3 = $('#avg_len3').val();
						var spl_load1 = $('#spl_load1').val();
						var spl_load2 = $('#spl_load2').val();
						var spl_load3 = $('#spl_load3').val();
						var spl_str1 = $('#spl_str1').val();
						var spl_str2 = $('#spl_str2').val();
						var spl_avg1 = $('#spl_avg1').val();
						var spl_avg2 = $('#spl_avg2').val();
						var average = $('#average').val();
							
						break;
					}
					else
					{
						var chk_spl = "0";
						var d_read1_1 = "0";
						var d_read1_2 = "0";
						var d_read1_3 = "0";
						var d_read2_1 = "0";
						var d_read2_2 = "0";
						var d_read2_3 = "0";
						var d_read3_1 = "0";
						var d_read3_2 = "0";
						var d_read3_3 = "0";
						var avg_dia1 = "0";
						var avg_dia2 = "0";
						var avg_dia3 = "0";
						var l_read1_1 = "0";
						var l_read1_2 = "0";
						var l_read1_3 = "0";
						var l_read2_1 = "0";
						var l_read2_2 = "0";
						var l_read2_3 = "0";
						var avg_len1 = "0";
						var avg_len2 = "0";
						var avg_len3 = "0";
						var spl_load1 = "0";
						var spl_load2 = "0";
						var spl_load3 = "0";
						var spl_str1 = "0";
						var spl_str2 = "0";
						var spl_avg1 = "0";
						var spl_avg2 = "0";
						var average = "0";
					}
				}
				
				//acc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="acc")
					{
						if(document.getElementById('chk_acc').checked) {
								var chk_acc = "1";
						}
						else{
								var chk_acc = "0";
						}
						var acc1 = $('#acc1').val();
						var acc2 = $('#acc2').val();
						var acc3 = $('#acc3').val();
						var acc4 = $('#acc4').val();
						var acc5 = $('#acc5').val();
						var acc6 = $('#acc6').val();
						var acc_id1 = $('#acc_id1').val();
						var acc_id2 = $('#acc_id2').val();
						var acc_id3 = $('#acc_id3').val();
						var acc_w1 = $('#acc_w1').val();
						var acc_w2 = $('#acc_w2').val();
						var acc_w3 = $('#acc_w3').val();
						var acc_l1 = $('#acc_l1').val();
						var acc_l2 = $('#acc_l2').val();
						var acc_l3 = $('#acc_l3').val();
						var acc_width1 = $('#acc_width1').val();
						var acc_width2 = $('#acc_width2').val();
						var acc_width3 = $('#acc_width3').val();
						var acc_area1 = $('#acc_area1').val();
						var acc_area2 = $('#acc_area2').val();
						var acc_area3 = $('#acc_area3').val();
						var acc_load1 = $('#acc_load1').val();
						var acc_load2 = $('#acc_load2').val();
						var acc_load3 = $('#acc_load3').val();
						var acc_com1 = $('#acc_com1').val();
						var acc_com2 = $('#acc_com2').val();
						var acc_com3 = $('#acc_com3').val();
						var acc_avg1 = $('#acc_avg1').val();
						var acc_avg2 = $('#acc_avg2').val();
						var acc_avg3 = $('#acc_avg3').val();
							
						break;
					}
					else
					{
						var chk_acc = "0";
						var acc1 = "0";
						var acc2 = "0";
						var acc3 = "0";
						var acc4 = "0";
						var acc5 = "0";
						var acc6 = "0";
						var acc_id1 = "0";
						var acc_id2 = "0";
						var acc_id3 = "0";
						var acc_w1 = "0";
						var acc_w2 = "0";
						var acc_w3 = "0";
						var acc_l1 = "0";
						var acc_l2 = "0";
						var acc_l3 = "0";
						var acc_width1 = "0";
						var acc_width2 = "0";
						var acc_width3 = "0";
						var acc_area1 = "0";
						var acc_area2 = "0";
						var acc_area3 = "0";
						var acc_load1 = "0";
						var acc_load2 = "0";
						var acc_load3 = "0";
						var acc_com1 = "0";
						var acc_com2 = "0";
						var acc_com3 = "0";
						var acc_avg1 = "0";
						var acc_avg2 = "0";
						var acc_avg3 = "0";
					}
				}
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_fle='+chk_fle+'&age1='+age1+'&age2='+age2+'&age3='+age3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&d1='+d1+'&d2='+d2+'&d3='+d3+'&len1='+len1+'&len2='+len2+'&len3='+len3+'&max1='+max1+'&max2='+max2+'&max3='+max3+'&pos1='+pos1+'&pos2='+pos2+'&pos3='+pos3+'&mod1='+mod1+'&mod2='+mod2+'&mod3='+mod3+'&avg1='+avg1+'&avg2='+avg2+'&avg3='+avg3+'&chk_com='+chk_com+'&loc1='+loc1+'&loc2='+loc2+'&loc3='+loc3+'&loc4='+loc4+'&loc5='+loc5+'&loc6='+loc6+'&loc7='+loc7+'&loc8='+loc8+'&loc9='+loc9+'&weight1='+weight1+'&weight2='+weight2+'&weight3='+weight3+'&weight4='+weight4+'&weight5='+weight5+'&weight6='+weight6+'&weight7='+weight7+'&weight8='+weight8+'&weight9='+weight9+'&dia1='+dia1+'&dia2='+dia2+'&dia3='+dia3+'&dia4='+dia4+'&dia5='+dia5+'&dia6='+dia6+'&dia7='+dia7+'&dia8='+dia8+'&dia9='+dia9+'&height1='+height1+'&height2='+height2+'&height3='+height3+'&height4='+height4+'&height5='+height5+'&height6='+height6+'&height7='+height7+'&height8='+height8+'&height9='+height9+'&ratio1='+ratio1+'&ratio2='+ratio2+'&ratio3='+ratio3+'&ratio4='+ratio4+'&ratio5='+ratio5+'&ratio6='+ratio6+'&ratio7='+ratio7+'&ratio8='+ratio8+'&ratio9='+ratio9+'&area1='+area1+'&area2='+area2+'&area3='+area3+'&area4='+area4+'&area5='+area5+'&area6='+area6+'&area7='+area7+'&area8='+area8+'&area9='+area9+'&load1='+load1+'&load2='+load2+'&load3='+load3+'&load4='+load4+'&load5='+load5+'&load6='+load6+'&load7='+load7+'&load8='+load8+'&load9='+load9+'&com1='+com1+'&com2='+com2+'&com3='+com3+'&com4='+com4+'&com5='+com5+'&com6='+com6+'&com7='+com7+'&com8='+com8+'&com9='+com9+'&cor_a1='+cor_a1+'&cor_a2='+cor_a2+'&cor_a3='+cor_a3+'&cor_a4='+cor_a4+'&cor_a5='+cor_a5+'&cor_a6='+cor_a6+'&cor_a7='+cor_a7+'&cor_a8='+cor_a8+'&cor_a9='+cor_a9+'&cor_b1='+cor_b1+'&cor_b2='+cor_b2+'&cor_b3='+cor_b3+'&cor_b4='+cor_b4+'&cor_b5='+cor_b5+'&cor_b6='+cor_b6+'&cor_b7='+cor_b7+'&cor_b8='+cor_b8+'&cor_b9='+cor_b9+'&cor_str1='+cor_str1+'&cor_str2='+cor_str2+'&cor_str3='+cor_str3+'&cor_str4='+cor_str4+'&cor_str5='+cor_str5+'&cor_str6='+cor_str6+'&cor_str7='+cor_str7+'&cor_str8='+cor_str8+'&cor_str9='+cor_str9+'&cube_str1='+cube_str1+'&cube_str2='+cube_str2+'&cube_str3='+cube_str3+'&cube_str4='+cube_str4+'&cube_str5='+cube_str5+'&cube_str6='+cube_str6+'&cube_str7='+cube_str7+'&cube_str8='+cube_str8+'&cube_str9='+cube_str9+'&cube_avg1='+cube_avg1+'&cube_avg2='+cube_avg2+'&cube_avg3='+cube_avg3+'&chk_spl='+chk_spl+'&d_read1_1='+d_read1_1+'&d_read1_2='+d_read1_2+'&d_read1_3='+d_read1_3+'&d_read2_1='+d_read2_1+'&d_read2_2='+d_read2_2+'&d_read2_3='+d_read2_3+'&d_read3_1='+d_read3_1+'&d_read3_2='+d_read3_2+'&d_read3_3='+d_read3_3+'&avg_dia1='+avg_dia1+'&avg_dia2='+avg_dia2+'&avg_dia3='+avg_dia3+'&l_read1_1='+l_read1_1+'&l_read1_2='+l_read1_2+'&l_read1_3='+l_read1_3+'&l_read2_1='+l_read2_1+'&l_read2_2='+l_read2_2+'&l_read2_3='+l_read2_3+'&avg_len1='+avg_len1+'&avg_len2='+avg_len2+'&avg_len3='+avg_len3+'&spl_load1='+spl_load1+'&spl_load2='+spl_load2+'&spl_load3='+spl_load3+'&spl_str1='+spl_str1+'&spl_str2='+spl_str2+'&spl_avg1='+spl_avg1+'&spl_avg2='+spl_avg2+'&average='+average+'&chk_acc='+chk_acc+'&acc1='+acc1+'&acc2='+acc2+'&acc3='+acc3+'&acc4='+acc4+'&acc5='+acc5+'&acc6='+acc6+'&acc_id1='+acc_id1+'&acc_id2='+acc_id2+'&acc_id3='+acc_id3+'&acc_w1='+acc_w1+'&acc_w2='+acc_w2+'&acc_w3='+acc_w3+'&acc_l1='+acc_l1+'&acc_l2='+acc_l2+'&acc_l3='+acc_l3+'&acc_width1='+acc_width1+'&acc_width2='+acc_width2+'&acc_width3='+acc_width3+'&acc_area1='+acc_area1+'&acc_area2='+acc_area2+'&acc_area3='+acc_area3+'&acc_load1='+acc_load1+'&acc_load2='+acc_load2+'&acc_load3='+acc_load3+'&acc_com1='+acc_com1+'&acc_com2='+acc_com2+'&acc_com3='+acc_com3+'&acc_avg1='+acc_avg1+'&acc_avg2='+acc_avg2+'&acc_avg3='+acc_avg3;
				
				
				
				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();	
				var grade_fresh = $('#grade_fresh').val();
				var slump_req = $('#slump_req').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//fle
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fle")
					{
						if(document.getElementById('chk_fle').checked) {
								var chk_fle = "1";
						}
						else{
								var chk_fle = "0";
						}
						var age1 = $('#age1').val();
						var age2 = $('#age2').val();
						var age3 = $('#age3').val();
						var l1 = $('#l1').val();
						var l2 = $('#l2').val();
						var l3 = $('#l3').val();
						var b1 = $('#b1').val();
						var b2 = $('#b2').val();
						var b3 = $('#b3').val();
						var d1 = $('#d1').val();
						var d2 = $('#d2').val();
						var d3 = $('#d3').val();
						var len1 = $('#len1').val();
						var len2 = $('#len2').val();
						var len3 = $('#len3').val();
						var max1 = $('#max1').val();
						var max2 = $('#max2').val();
						var max3 = $('#max3').val();
						var pos1 = $('#pos1').val();
						var pos2 = $('#pos2').val();
						var pos3 = $('#pos3').val();
						var mod1 = $('#mod1').val();
						var mod2 = $('#mod2').val();
						var mod3 = $('#mod3').val();
						var avg1 = $('#avg1').val();
						var avg2 = $('#avg2').val();
						var avg3 = $('#avg3').val();
							
						break;
					}
					else
					{
						var chk_fle = "0";
						var age1 = "0";
						var age2 = "0";
						var age3 = "0";
						var l1 = "0";
						var l2 = "0";
						var l3 = "0";
						var b1 = "0";
						var b2 = "0";
						var b3 = "0";
						var d1 = "0";
						var d2 = "0";
						var d3 = "0";
						var len1 = "0";
						var len2 = "0";
						var len3 = "0";
						var max1 = "0";
						var max2 = "0";
						var max3 = "0";
						var pos1 = "0";
						var pos2 = "0";
						var pos3 = "0";
						var mod1 = "0";
						var mod2 = "0";
						var mod3 = "0";
						var avg1 = "0";
						var avg2 = "0";
						var avg3 = "0";
					}
				}
				
				//com
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						if(document.getElementById('chk_com').checked) {
								var chk_com = "1";
						}
						else{
								var chk_com = "0";
						}
						var loc1 = $('#loc1').val();
						var loc2 = $('#loc2').val();
						var loc3 = $('#loc3').val();
						var loc4 = $('#loc4').val();
						var loc5 = $('#loc5').val();
						var loc6 = $('#loc6').val();
						var loc7 = $('#loc7').val();
						var loc8 = $('#loc8').val();
						var loc9 = $('#loc9').val();
						var weight1 = $('#weight1').val();
						var weight2 = $('#weight2').val();
						var weight3 = $('#weight3').val();
						var weight4 = $('#weight4').val();
						var weight5 = $('#weight5').val();
						var weight6 = $('#weight6').val();
						var weight7 = $('#weight7').val();
						var weight8 = $('#weight8').val();
						var weight9 = $('#weight9').val();
						var dia1 = $('#dia1').val();
						var dia2 = $('#dia2').val();
						var dia3 = $('#dia3').val();
						var dia4 = $('#dia4').val();
						var dia5 = $('#dia5').val();
						var dia6 = $('#dia6').val();
						var dia7 = $('#dia7').val();
						var dia8 = $('#dia8').val();
						var dia9 = $('#dia9').val();
						var height1 = $('#height1').val();
						var height2 = $('#height2').val();
						var height3 = $('#height3').val();
						var height4 = $('#height4').val();
						var height5 = $('#height5').val();
						var height6 = $('#height6').val();
						var height7 = $('#height7').val();
						var height8 = $('#height8').val();
						var height9 = $('#height9').val();
						var ratio1 = $('#ratio1').val();
						var ratio2 = $('#ratio2').val();
						var ratio3 = $('#ratio3').val();
						var ratio4 = $('#ratio4').val();
						var ratio5 = $('#ratio5').val();
						var ratio6 = $('#ratio6').val();
						var ratio7 = $('#ratio7').val();
						var ratio8 = $('#ratio8').val();
						var ratio9 = $('#ratio9').val();
						var area1 = $('#area1').val();
						var area2 = $('#area2').val();
						var area3 = $('#area3').val();
						var area4 = $('#area4').val();
						var area5 = $('#area5').val();
						var area6 = $('#area6').val();
						var area7 = $('#area7').val();
						var area8 = $('#area8').val();
						var area9 = $('#area9').val();
						var load1 = $('#load1').val();
						var load2 = $('#load2').val();
						var load3 = $('#load3').val();
						var load4 = $('#load4').val();
						var load5 = $('#load5').val();
						var load6 = $('#load6').val();
						var load7 = $('#load7').val();
						var load8 = $('#load8').val();
						var load9 = $('#load9').val();
						var com1 = $('#com1').val();
						var com2 = $('#com2').val();
						var com3 = $('#com3').val();
						var com4 = $('#com4').val();
						var com5 = $('#com5').val();
						var com6 = $('#com6').val();
						var com7 = $('#com7').val();
						var com8 = $('#com8').val();
						var com9 = $('#com9').val();
						var cor_a1 = $('#cor_a1').val();
						var cor_a2 = $('#cor_a2').val();
						var cor_a3 = $('#cor_a3').val();
						var cor_a4 = $('#cor_a4').val();
						var cor_a5 = $('#cor_a5').val();
						var cor_a6 = $('#cor_a6').val();
						var cor_a7 = $('#cor_a7').val();
						var cor_a8 = $('#cor_a8').val();
						var cor_a9 = $('#cor_a9').val();
						var cor_b1 = $('#cor_b1').val();
						var cor_b2 = $('#cor_b2').val();
						var cor_b3 = $('#cor_b3').val();
						var cor_b4 = $('#cor_b4').val();
						var cor_b5 = $('#cor_b5').val();
						var cor_b6 = $('#cor_b6').val();
						var cor_b7 = $('#cor_b7').val();
						var cor_b8 = $('#cor_b8').val();
						var cor_b9 = $('#cor_b9').val();
						var cor_str1 = $('#cor_str1').val();
						var cor_str2 = $('#cor_str2').val();
						var cor_str3 = $('#cor_str3').val();
						var cor_str4 = $('#cor_str4').val();
						var cor_str5 = $('#cor_str5').val();
						var cor_str6 = $('#cor_str6').val();
						var cor_str7 = $('#cor_str7').val();
						var cor_str8 = $('#cor_str8').val();
						var cor_str9 = $('#cor_str9').val();
						var cube_str1 = $('#cube_str1').val();
						var cube_str2 = $('#cube_str2').val();
						var cube_str3 = $('#cube_str3').val();
						var cube_str4 = $('#cube_str4').val();
						var cube_str5 = $('#cube_str5').val();
						var cube_str6 = $('#cube_str6').val();
						var cube_str7 = $('#cube_str7').val();
						var cube_str8 = $('#cube_str8').val();
						var cube_str9 = $('#cube_str9').val();
						var cube_avg1 = $('#cube_avg1').val();
						var cube_avg2 = $('#cube_avg2').val();
						var cube_avg3 = $('#cube_avg3').val();
							
						break;
					}
					else
					{
						var chk_com = "0";
						var loc1 = "0";
						var loc2 = "0";
						var loc3 = "0";
						var loc4 = "0";
						var loc5 = "0";
						var loc6 = "0";
						var loc7 = "0";
						var loc8 = "0";
						var loc9 = "0";
						var weight1 = "0";
						var weight2 = "0";
						var weight3 = "0";
						var weight4 = "0";
						var weight5 = "0";
						var weight6 = "0";
						var weight7 = "0";
						var weight8 = "0";
						var weight9 = "0";
						var dia1 = "0";
						var dia2 = "0";
						var dia3 = "0";
						var dia4 = "0";
						var dia5 = "0";
						var dia6 = "0";
						var dia7 = "0";
						var dia8 = "0";
						var dia9 = "0";
						var height1 = "0";
						var height2 = "0";
						var height3 = "0";
						var height4 = "0";
						var height5 = "0";
						var height6 = "0";
						var height7 = "0";
						var height8 = "0";
						var height9 = "0";
						var ratio1 = "0";
						var ratio2 = "0";
						var ratio3 = "0";
						var ratio4 = "0";
						var ratio5 = "0";
						var ratio6 = "0";
						var ratio7 = "0";
						var ratio8 = "0";
						var ratio9 = "0";
						var area1 = "0";
						var area2 = "0";
						var area3 = "0";
						var area4 = "0";
						var area5 = "0";
						var area6 = "0";
						var area7 = "0";
						var area8 = "0";
						var area9 = "0";
						var load1 = "0";
						var load2 = "0";
						var load3 = "0";
						var load4 = "0";
						var load5 = "0";
						var load6 = "0";
						var load7 = "0";
						var load8 = "0";
						var load9 = "0";
						var com1 = "0";
						var com2 = "0";
						var com3 = "0";
						var com4 = "0";
						var com5 = "0";
						var com6 = "0";
						var com7 = "0";
						var com8 = "0";
						var com9 = "0";
						var cor_a1 = "0";
						var cor_a2 = "0";
						var cor_a3 = "0";
						var cor_a4 = "0";
						var cor_a5 = "0";
						var cor_a6 = "0";
						var cor_a7 = "0";
						var cor_a8 = "0";
						var cor_a9 = "0";
						var cor_b1 = "0";
						var cor_b2 = "0";
						var cor_b3 = "0";
						var cor_b4 = "0";
						var cor_b5 = "0";
						var cor_b6 = "0";
						var cor_b7 = "0";
						var cor_b8 = "0";
						var cor_b9 = "0";
						var cor_str1 = "0";
						var cor_str2 = "0";
						var cor_str3 = "0";
						var cor_str4 = "0";
						var cor_str5 = "0";
						var cor_str6 = "0";
						var cor_str7 = "0";
						var cor_str8 = "0";
						var cor_str9 = "0";
						var cube_str1 = "0";
						var cube_str2 = "0";
						var cube_str3 = "0";
						var cube_str4 = "0";
						var cube_str5 = "0";
						var cube_str6 = "0";
						var cube_str7 = "0";
						var cube_str8 = "0";
						var cube_str9 = "0";
						var cube_avg1 = "0";
						var cube_avg2 = "0";
						var cube_avg3 = "0";
					}
				}
				
				//spl
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spl")
					{
						if(document.getElementById('chk_spl').checked) {
								var chk_spl = "1";
						}
						else{
								var chk_spl = "0";
						}
						var d_read1_1 = $('#d_read1_1').val();
						var d_read1_2 = $('#d_read1_2').val();
						var d_read1_3 = $('#d_read1_3').val();
						var d_read2_1 = $('#d_read2_1').val();
						var d_read2_2 = $('#d_read2_2').val();
						var d_read2_3 = $('#d_read2_3').val();
						var d_read3_1 = $('#d_read3_1').val();
						var d_read3_2 = $('#d_read3_2').val();
						var d_read3_3 = $('#d_read3_3').val();
						var avg_dia1 = $('#avg_dia1').val();
						var avg_dia2 = $('#avg_dia2').val();
						var avg_dia3 = $('#avg_dia3').val();
						var l_read1_1 = $('#l_read1_1').val();
						var l_read1_2 = $('#l_read1_2').val();
						var l_read1_3 = $('#l_read1_3').val();
						var l_read2_1 = $('#l_read2_1').val();
						var l_read2_2 = $('#l_read2_2').val();
						var l_read2_3 = $('#l_read2_3').val();
						var avg_len1 = $('#avg_len1').val();
						var avg_len2 = $('#avg_len2').val();
						var avg_len3 = $('#avg_len3').val();
						var spl_load1 = $('#spl_load1').val();
						var spl_load2 = $('#spl_load2').val();
						var spl_load3 = $('#spl_load3').val();
						var spl_str1 = $('#spl_str1').val();
						var spl_str2 = $('#spl_str2').val();
						var spl_avg1 = $('#spl_avg1').val();
						var spl_avg2 = $('#spl_avg2').val();
						var average = $('#average').val();
							
						break;
					}
					else
					{
						var chk_spl = "0";
						var d_read1_1 = "0";
						var d_read1_2 = "0";
						var d_read1_3 = "0";
						var d_read2_1 = "0";
						var d_read2_2 = "0";
						var d_read2_3 = "0";
						var d_read3_1 = "0";
						var d_read3_2 = "0";
						var d_read3_3 = "0";
						var avg_dia1 = "0";
						var avg_dia2 = "0";
						var avg_dia3 = "0";
						var l_read1_1 = "0";
						var l_read1_2 = "0";
						var l_read1_3 = "0";
						var l_read2_1 = "0";
						var l_read2_2 = "0";
						var l_read2_3 = "0";
						var avg_len1 = "0";
						var avg_len2 = "0";
						var avg_len3 = "0";
						var spl_load1 = "0";
						var spl_load2 = "0";
						var spl_load3 = "0";
						var spl_str1 = "0";
						var spl_str2 = "0";
						var spl_avg1 = "0";
						var spl_avg2 = "0";
						var average = "0";
					}
				}
				
				//acc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="acc")
					{
						if(document.getElementById('chk_acc').checked) {
								var chk_acc = "1";
						}
						else{
								var chk_acc = "0";
						}
						var acc1 = $('#acc1').val();
						var acc2 = $('#acc2').val();
						var acc3 = $('#acc3').val();
						var acc4 = $('#acc4').val();
						var acc5 = $('#acc5').val();
						var acc6 = $('#acc6').val();
						var acc_id1 = $('#acc_id1').val();
						var acc_id2 = $('#acc_id2').val();
						var acc_id3 = $('#acc_id3').val();
						var acc_w1 = $('#acc_w1').val();
						var acc_w2 = $('#acc_w2').val();
						var acc_w3 = $('#acc_w3').val();
						var acc_l1 = $('#acc_l1').val();
						var acc_l2 = $('#acc_l2').val();
						var acc_l3 = $('#acc_l3').val();
						var acc_width1 = $('#acc_width1').val();
						var acc_width2 = $('#acc_width2').val();
						var acc_width3 = $('#acc_width3').val();
						var acc_area1 = $('#acc_area1').val();
						var acc_area2 = $('#acc_area2').val();
						var acc_area3 = $('#acc_area3').val();
						var acc_load1 = $('#acc_load1').val();
						var acc_load2 = $('#acc_load2').val();
						var acc_load3 = $('#acc_load3').val();
						var acc_com1 = $('#acc_com1').val();
						var acc_com2 = $('#acc_com2').val();
						var acc_com3 = $('#acc_com3').val();
						var acc_avg1 = $('#acc_avg1').val();
						var acc_avg2 = $('#acc_avg2').val();
						var acc_avg3 = $('#acc_avg3').val();
							
						break;
					}
					else
					{
						var chk_acc = "0";
						var acc1 = "0";
						var acc2 = "0";
						var acc3 = "0";
						var acc4 = "0";
						var acc5 = "0";
						var acc6 = "0";
						var acc_id1 = "0";
						var acc_id2 = "0";
						var acc_id3 = "0";
						var acc_w1 = "0";
						var acc_w2 = "0";
						var acc_w3 = "0";
						var acc_l1 = "0";
						var acc_l2 = "0";
						var acc_l3 = "0";
						var acc_width1 = "0";
						var acc_width2 = "0";
						var acc_width3 = "0";
						var acc_area1 = "0";
						var acc_area2 = "0";
						var acc_area3 = "0";
						var acc_load1 = "0";
						var acc_load2 = "0";
						var acc_load3 = "0";
						var acc_com1 = "0";
						var acc_com2 = "0";
						var acc_com3 = "0";
						var acc_avg1 = "0";
						var acc_avg2 = "0";
						var acc_avg3 = "0";
					}
				}
				
				
				var idEdit = $('#idEdit').val(); 

				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_fle='+chk_fle+'&age1='+age1+'&age2='+age2+'&age3='+age3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&d1='+d1+'&d2='+d2+'&d3='+d3+'&len1='+len1+'&len2='+len2+'&len3='+len3+'&max1='+max1+'&max2='+max2+'&max3='+max3+'&pos1='+pos1+'&pos2='+pos2+'&pos3='+pos3+'&mod1='+mod1+'&mod2='+mod2+'&mod3='+mod3+'&avg1='+avg1+'&avg2='+avg2+'&avg3='+avg3+'&chk_com='+chk_com+'&loc1='+loc1+'&loc2='+loc2+'&loc3='+loc3+'&loc4='+loc4+'&loc5='+loc5+'&loc6='+loc6+'&loc7='+loc7+'&loc8='+loc8+'&loc9='+loc9+'&weight1='+weight1+'&weight2='+weight2+'&weight3='+weight3+'&weight4='+weight4+'&weight5='+weight5+'&weight6='+weight6+'&weight7='+weight7+'&weight8='+weight8+'&weight9='+weight9+'&dia1='+dia1+'&dia2='+dia2+'&dia3='+dia3+'&dia4='+dia4+'&dia5='+dia5+'&dia6='+dia6+'&dia7='+dia7+'&dia8='+dia8+'&dia9='+dia9+'&height1='+height1+'&height2='+height2+'&height3='+height3+'&height4='+height4+'&height5='+height5+'&height6='+height6+'&height7='+height7+'&height8='+height8+'&height9='+height9+'&ratio1='+ratio1+'&ratio2='+ratio2+'&ratio3='+ratio3+'&ratio4='+ratio4+'&ratio5='+ratio5+'&ratio6='+ratio6+'&ratio7='+ratio7+'&ratio8='+ratio8+'&ratio9='+ratio9+'&area1='+area1+'&area2='+area2+'&area3='+area3+'&area4='+area4+'&area5='+area5+'&area6='+area6+'&area7='+area7+'&area8='+area8+'&area9='+area9+'&load1='+load1+'&load2='+load2+'&load3='+load3+'&load4='+load4+'&load5='+load5+'&load6='+load6+'&load7='+load7+'&load8='+load8+'&load9='+load9+'&com1='+com1+'&com2='+com2+'&com3='+com3+'&com4='+com4+'&com5='+com5+'&com6='+com6+'&com7='+com7+'&com8='+com8+'&com9='+com9+'&cor_a1='+cor_a1+'&cor_a2='+cor_a2+'&cor_a3='+cor_a3+'&cor_a4='+cor_a4+'&cor_a5='+cor_a5+'&cor_a6='+cor_a6+'&cor_a7='+cor_a7+'&cor_a8='+cor_a8+'&cor_a9='+cor_a9+'&cor_b1='+cor_b1+'&cor_b2='+cor_b2+'&cor_b3='+cor_b3+'&cor_b4='+cor_b4+'&cor_b5='+cor_b5+'&cor_b6='+cor_b6+'&cor_b7='+cor_b7+'&cor_b8='+cor_b8+'&cor_b9='+cor_b9+'&cor_str1='+cor_str1+'&cor_str2='+cor_str2+'&cor_str3='+cor_str3+'&cor_str4='+cor_str4+'&cor_str5='+cor_str5+'&cor_str6='+cor_str6+'&cor_str7='+cor_str7+'&cor_str8='+cor_str8+'&cor_str9='+cor_str9+'&cube_str1='+cube_str1+'&cube_str2='+cube_str2+'&cube_str3='+cube_str3+'&cube_str4='+cube_str4+'&cube_str5='+cube_str5+'&cube_str6='+cube_str6+'&cube_str7='+cube_str7+'&cube_str8='+cube_str8+'&cube_str9='+cube_str9+'&cube_avg1='+cube_avg1+'&cube_avg2='+cube_avg2+'&cube_avg3='+cube_avg3+'&chk_spl='+chk_spl+'&d_read1_1='+d_read1_1+'&d_read1_2='+d_read1_2+'&d_read1_3='+d_read1_3+'&d_read2_1='+d_read2_1+'&d_read2_2='+d_read2_2+'&d_read2_3='+d_read2_3+'&d_read3_1='+d_read3_1+'&d_read3_2='+d_read3_2+'&d_read3_3='+d_read3_3+'&avg_dia1='+avg_dia1+'&avg_dia2='+avg_dia2+'&avg_dia3='+avg_dia3+'&l_read1_1='+l_read1_1+'&l_read1_2='+l_read1_2+'&l_read1_3='+l_read1_3+'&l_read2_1='+l_read2_1+'&l_read2_2='+l_read2_2+'&l_read2_3='+l_read2_3+'&avg_len1='+avg_len1+'&avg_len2='+avg_len2+'&avg_len3='+avg_len3+'&spl_load1='+spl_load1+'&spl_load2='+spl_load2+'&spl_load3='+spl_load3+'&spl_str1='+spl_str1+'&spl_str2='+spl_str2+'&spl_avg1='+spl_avg1+'&spl_avg2='+spl_avg2+'&average='+average+'&chk_acc='+chk_acc+'&acc1='+acc1+'&acc2='+acc2+'&acc3='+acc3+'&acc4='+acc4+'&acc5='+acc5+'&acc6='+acc6+'&acc_id1='+acc_id1+'&acc_id2='+acc_id2+'&acc_id3='+acc_id3+'&acc_w1='+acc_w1+'&acc_w2='+acc_w2+'&acc_w3='+acc_w3+'&acc_l1='+acc_l1+'&acc_l2='+acc_l2+'&acc_l3='+acc_l3+'&acc_width1='+acc_width1+'&acc_width2='+acc_width2+'&acc_width3='+acc_width3+'&acc_area1='+acc_area1+'&acc_area2='+acc_area2+'&acc_area3='+acc_area3+'&acc_load1='+acc_load1+'&acc_load2='+acc_load2+'&acc_load3='+acc_load3+'&acc_com1='+acc_com1+'&acc_com2='+acc_com2+'&acc_com3='+acc_com3+'&acc_avg1='+acc_avg1+'&acc_avg2='+acc_avg2+'&acc_avg3='+acc_avg3;

		
				
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_hard_concrete.php',
        data: billData,
		dataType: 'JSON',
        success:function(msg){
				$('#btn_save').hide();
				getGlazedTiles();
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
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
        url: '<?php echo $base_url; ?>save_hard_concrete.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
            $('#idEdit').val(data.id);
	
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#grade_fresh').val(data.grade_fresh);
			$('#slump_req').val(data.slump_req);
            var temp = $('#test_list').val();
				var aa= temp.split(",");	
			
				//fle
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fle")
					{
						var chk_fle = data.chk_fle;
						if(chk_fle=="1")
						{
							$('#txtfle').css("background-color","var(--success)"); 
						   $("#chk_fle").prop("checked", true); 
						}else{
							$('#txtfle').css("background-color","white"); 
							$("#chk_fle").prop("checked", false); 
						}
						$('#age1').val(data.age1);
						$('#age2').val(data.age2);
						$('#age3').val(data.age3);
						$('#l1').val(data.l1);
						$('#l2').val(data.l2);
						$('#l3').val(data.l3);
						$('#b1').val(data.b1);
						$('#b2').val(data.b2);
						$('#b3').val(data.b3);
						$('#d1').val(data.d1);
						$('#d2').val(data.d2);
						$('#d3').val(data.d3);
						$('#len1').val(data.len1);
						$('#len2').val(data.len2);
						$('#len3').val(data.len3);
						$('#max1').val(data.max1);
						$('#max2').val(data.max2);
						$('#max3').val(data.max3);
						$('#pos1').val(data.pos1);
						$('#pos2').val(data.pos2);
						$('#pos3').val(data.pos3);
						$('#mod1').val(data.mod1);
						$('#mod2').val(data.mod2);
						$('#mod3').val(data.mod3);
						$('#avg1').val(data.avg1);
						$('#avg2').val(data.avg2);
						$('#avg3').val(data.avg3);	
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
							$('#txtcom').css("background-color","var(--success)"); 
						   $("#chk_com").prop("checked", true); 
						}else{
							$('#txtcom').css("background-color","white"); 
							$("#chk_com").prop("checked", false); 
						}
						$('#loc1').val(data.loc1);
						$('#loc2').val(data.loc2);
						$('#loc3').val(data.loc3);
						$('#loc4').val(data.loc4);
						$('#loc5').val(data.loc5);
						$('#loc6').val(data.loc6);
						$('#loc7').val(data.loc7);
						$('#loc8').val(data.loc8);
						$('#loc9').val(data.loc9);
						$('#weight1').val(data.weight1);
						$('#weight2').val(data.weight2);
						$('#weight3').val(data.weight3);
						$('#weight4').val(data.weight4);
						$('#weight5').val(data.weight5);
						$('#weight6').val(data.weight6);
						$('#weight7').val(data.weight7);
						$('#weight8').val(data.weight8);
						$('#weight9').val(data.weight9);
						$('#dia1').val(data.dia1);
						$('#dia2').val(data.dia2);
						$('#dia3').val(data.dia3);
						$('#dia4').val(data.dia4);
						$('#dia5').val(data.dia5);
						$('#dia6').val(data.dia6);
						$('#dia7').val(data.dia7);
						$('#dia8').val(data.dia8);
						$('#dia9').val(data.dia9);
						$('#height1').val(data.height1);
						$('#height2').val(data.height2);
						$('#height3').val(data.height3);
						$('#height4').val(data.height4);
						$('#height5').val(data.height5);
						$('#height6').val(data.height6);
						$('#height7').val(data.height7);
						$('#height8').val(data.height8);
						$('#height9').val(data.height9);
						$('#ratio1').val(data.ratio1);
						$('#ratio2').val(data.ratio2);
						$('#ratio3').val(data.ratio3);
						$('#ratio4').val(data.ratio4);
						$('#ratio5').val(data.ratio5);
						$('#ratio6').val(data.ratio6);
						$('#ratio7').val(data.ratio7);
						$('#ratio8').val(data.ratio8);
						$('#ratio9').val(data.ratio9);
						$('#area1').val(data.area1);
						$('#area2').val(data.area2);
						$('#area3').val(data.area3);
						$('#area4').val(data.area4);
						$('#area5').val(data.area5);
						$('#area6').val(data.area6);
						$('#area7').val(data.area7);
						$('#area8').val(data.area8);
						$('#area9').val(data.area9);
						$('#load1').val(data.load1);
						$('#load2').val(data.load2);
						$('#load3').val(data.load3);
						$('#load4').val(data.load4);
						$('#load5').val(data.load5);
						$('#load6').val(data.load6);
						$('#load7').val(data.load7);
						$('#load8').val(data.load8);
						$('#load9').val(data.load9);
						$('#com1').val(data.com1);
						$('#com2').val(data.com2);
						$('#com3').val(data.com3);
						$('#com4').val(data.com4);
						$('#com5').val(data.com5);
						$('#com6').val(data.com6);
						$('#com7').val(data.com7);
						$('#com8').val(data.com8);
						$('#com9').val(data.com9);
						$('#cor_a1').val(data.cor_a1);
						$('#cor_a2').val(data.cor_a2);
						$('#cor_a3').val(data.cor_a3);
						$('#cor_a4').val(data.cor_a4);
						$('#cor_a5').val(data.cor_a5);
						$('#cor_a6').val(data.cor_a6);
						$('#cor_a7').val(data.cor_a7);
						$('#cor_a8').val(data.cor_a8);
						$('#cor_a9').val(data.cor_a9);
						$('#cor_b1').val(data.cor_b1);
						$('#cor_b2').val(data.cor_b2);
						$('#cor_b3').val(data.cor_b3);
						$('#cor_b4').val(data.cor_b4);
						$('#cor_b5').val(data.cor_b5);
						$('#cor_b6').val(data.cor_b6);
						$('#cor_b7').val(data.cor_b7);
						$('#cor_b8').val(data.cor_b8);
						$('#cor_b9').val(data.cor_b9);
						$('#cor_str1').val(data.cor_str1);
						$('#cor_str2').val(data.cor_str2);
						$('#cor_str3').val(data.cor_str3);
						$('#cor_str4').val(data.cor_str4);
						$('#cor_str5').val(data.cor_str5);
						$('#cor_str6').val(data.cor_str6);
						$('#cor_str7').val(data.cor_str7);
						$('#cor_str8').val(data.cor_str8);
						$('#cor_str9').val(data.cor_str9);
						$('#cube_str1').val(data.cube_str1);
						$('#cube_str2').val(data.cube_str2);
						$('#cube_str3').val(data.cube_str3);
						$('#cube_str4').val(data.cube_str4);
						$('#cube_str5').val(data.cube_str5);
						$('#cube_str6').val(data.cube_str6);
						$('#cube_str7').val(data.cube_str7);
						$('#cube_str8').val(data.cube_str8);
						$('#cube_str9').val(data.cube_str9);
						$('#cube_avg1').val(data.cube_avg1);
						$('#cube_avg2').val(data.cube_avg2);
						$('#cube_avg3').val(data.cube_avg3);	
						break;
					}
					else
					{
							
					}
				}
				
				//spl
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="spl")
					{
						var chk_spl = data.chk_spl;
						if(chk_spl=="1")
						{
							$('#txtspl').css("background-color","var(--success)"); 
						   $("#chk_spl").prop("checked", true); 
						}else{
							$('#txtspl').css("background-color","white"); 
							$("#chk_spl").prop("checked", false); 
						}
						$('#d_read1_1').val(data.d_read1_1);
						$('#d_read1_2').val(data.d_read1_2);
						$('#d_read1_3').val(data.d_read1_3);
						$('#d_read2_1').val(data.d_read2_1);
						$('#d_read2_2').val(data.d_read2_2);
						$('#d_read2_3').val(data.d_read2_3);
						$('#d_read3_1').val(data.d_read3_1);
						$('#d_read3_2').val(data.d_read3_2);
						$('#d_read3_3').val(data.d_read3_3);
						$('#avg_dia1').val(data.avg_dia1);
						$('#avg_dia2').val(data.avg_dia2);
						$('#avg_dia3').val(data.avg_dia3);
						$('#l_read1_1').val(data.l_read1_1);
						$('#l_read1_2').val(data.l_read1_2);
						$('#l_read1_3').val(data.l_read1_3);
						$('#l_read2_1').val(data.l_read2_1);
						$('#l_read2_2').val(data.l_read2_2);
						$('#l_read2_3').val(data.l_read2_3);
						$('#avg_len1').val(data.avg_len1);
						$('#avg_len2').val(data.avg_len2);
						$('#avg_len3').val(data.avg_len3);
						$('#spl_load1').val(data.spl_load1);
						$('#spl_load2').val(data.spl_load2);
						$('#spl_load3').val(data.spl_load3);
						$('#spl_str1').val(data.spl_str1);
						$('#spl_str2').val(data.spl_str2);
						$('#spl_avg1').val(data.spl_avg1);
						$('#spl_avg2').val(data.spl_avg2);
						$('#average').val(data.average);	
						break;
					}
					else
					{
							
					}
				}
				
				//acc
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="acc")
					{
						var chk_acc = data.chk_acc;
						if(chk_acc=="1")
						{
							$('#txtacc').css("background-color","var(--success)"); 
						   $("#chk_acc").prop("checked", true); 
						}else{
							$('#txtacc').css("background-color","white"); 
							$("#chk_acc").prop("checked", false); 
						}
						$('#acc1').val(data.acc1);
						$('#acc2').val(data.acc2);
						$('#acc3').val(data.acc3);
						$('#acc4').val(data.acc4);
						$('#acc5').val(data.acc5);
						$('#acc6').val(data.acc6);
						$('#acc_id1').val(data.acc_id1);
						$('#acc_id2').val(data.acc_id2);
						$('#acc_id3').val(data.acc_id3);
						$('#acc_w1').val(data.acc_w1);
						$('#acc_w2').val(data.acc_w2);
						$('#acc_w3').val(data.acc_w3);
						$('#acc_l1').val(data.acc_l1);
						$('#acc_l2').val(data.acc_l2);
						$('#acc_l3').val(data.acc_l3);
						$('#acc_width1').val(data.acc_width1);
						$('#acc_width2').val(data.acc_width2);
						$('#acc_width3').val(data.acc_width3);
						$('#acc_area1').val(data.acc_area1);
						$('#acc_area2').val(data.acc_area2);
						$('#acc_area3').val(data.acc_area3);
						$('#acc_load1').val(data.acc_load1);
						$('#acc_load2').val(data.acc_load2);
						$('#acc_load3').val(data.acc_load3);
						$('#acc_com1').val(data.acc_com1);
						$('#acc_com2').val(data.acc_com2);
						$('#acc_com3').val(data.acc_com3);
						$('#acc_avg1').val(data.acc_avg1);
						$('#acc_avg2').val(data.acc_avg2);
						$('#acc_avg3').val(data.acc_avg3);	
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


