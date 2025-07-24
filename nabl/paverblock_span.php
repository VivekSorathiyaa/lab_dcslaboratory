

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
			$job_no_main=$_GET['job_no'];
			
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
					$paver_shape= $row_select4['paver_shape'];
					$paver_age= $row_select4['paver_age'];
					$paver_color= $row_select4['paver_color'];
					$paver_thickNess= $row_select4['paver_thickness'];
					$paver_grade= $row_select4['paver_grade'];					
				}
		
?>
<div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">PAVER BLOCK</h2>
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
												</div>
											

										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="" value="<?php echo $job_no;?>" name="lab_no" ReadOnly>
                                        <input type="hidden" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-2 control-label">Color :</label>	-->								 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_color" value="<?php echo $paver_color;?>" name="top_color" ReadOnly>
										  </div>
										  
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">Grade :</label>-->									 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_grade" value="<?php echo $paver_grade;?>" name="top_grade" ReadOnly>
										  </div>
										  
										   <label for="inputEmail3" class="col-sm-2 control-label">ThickNess :</label>								 
										  <div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="top_thickNess" value="<?php echo $paver_thickNess;?>" name="top_thickNess" >
										  </div>
										  
										</div>
									</div>
									
								</div>
								<br><br>
								<div class="row">
								<div class="col-lg-10">
									<div class="form-group">
										<div class="col-sm-3">
											<label>Sample Description.:</label>
										</div>
										<div class="col-sm-3">
											<input type="text" name="s_des" id="s_des">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-3">
											<label>Residual Sample.:</label>
										</div> 
										<div class="col-sm-3">
											<input type="text" name="r_sam"  id="r_sam">
										</div>
									</div>
								</div>
								</div>
								<div class="row">
								<div class="col-lg-10">
									<div class="form-group">
										<div class="col-sm-3">
											<label> Sample Retention.:</label>
										</div>
										<div class="col-sm-3">
											<input type="text"  name="s_ret" id="s_ret">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-3">
											<label>qty.:</label>
										</div>
									    <div class="col-sm-3">
											<input type="text"  name="qty_1" id="qty_1">
									    </div>
								    </div>
								</div>
								</div>
							
								<br>
								<br>
							<!-- LAB NO PUT VAIBHAV-->
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										 <!-- <label for="inputEmail3" class="col-sm-2 control-label">Shape :</label>-->
										 

										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="top_shape" value="<?php echo $paver_shape;?>" name="top_shape" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">	 
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Age :</label>									 -->
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_age" value="<?php echo $paver_age;?>" name="top_age" ReadOnly>
										  </div>
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No. :</label>	-->
										  <div class="col-sm-6">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
										  </div>																			  									
										  
										</div>
									</div>
									
								</div>
								<br>
							<!-- LAB NO PUT VAIBHAV-->
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Weight,gm :</label>										
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="wt1" name="wt1">
										  </div>
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="wt2" name="wt2">
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Area,mm<sup>2</sup> :</label>										
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="ar1" name="ar1">
										  </div>
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="ar2" name="ar2">
										  </div>
										</div>
									</div>
									
								</div>
								<br>
							<!-- LAB NO PUT VAIBHAV-->
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Splitting Length,mm :</label>										
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="sp_len" name="sp_len">
										  </div>
										  
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Flexural Full Length,mm :</label>										
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="full_len" name="full_len">
										  </div>
										  
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Flexural Full width,mm :</label>										
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="full_width" name="full_width">
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
											<div class="col-sm-1">
												<!-- SAVE BUTTON LOGIC VAIBHAV-->
												<?php   
													$querys_job1 = "SELECT * FROM span_paver_block WHERE `is_deleted`='0' and lab_no='$lab_no'";
													$qrys_jobno = mysqli_query($conn,$querys_job1);
													$rows=mysqli_num_rows($qrys_jobno);
													if($rows < 1){ ?>
														<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
														<?php }													
															?>
												

											</div>
											
											<div class="col-sm-1">
												<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>

											</div>
											<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
											<?php
											//$val =  $_SESSION['isadmin'];
											//if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
											?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/span_paver_block.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											<!--<div class="col-sm-2">
 													<a target='_blank' href="<?php echo $base_url; ?>back_cal_report_blank/span_paver_block.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>&&ulr=<?php echo $ulr; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Blank</b></a>

 												</div>-->
											<?php //} ?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_paverblock_span.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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
									<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no;?>&&reports_nos=<?php echo $report_no;?>&&lab_no=<?php echo $lab_no;?>">Row Data</a>
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
  	<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_req">
								<h4 class="panel-title">
								<b>SPECIFICATION</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_req" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_wtr">1.</label>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SPECIFICATION</label>
										</div>
									</div>
									
							</div>								
								<br>
							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Test Parameter</label>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
										</div>
									</div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Compressive Strength</label>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<input type="text" class="form-control" id="req_1" name="req_1" >
										</div>
									</div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Dimension Length</label>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<input type="text" class="form-control" id="den_1" name="den_1" value="±2      ±3">
										</div>
									</div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Dimension width</label>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<input type="text" class="form-control" id="den_2" name="den_2" value="±2      ±3">
										</div>
									</div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Dimension height</label>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<input type="text" class="form-control" id="req_2" name="req_2" value="±3      ±4">
										</div>
									</div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Water Absorption</label>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<input type="text" class="form-control" id="req_3" name="req_3" value="Individual Max. 7">
										</div>
									</div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label"></label>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<input type="text" class="form-control" id="req_4" name="req_4" value="Average    Max 6">
										</div>
									</div>
							</div>
							
						</div>
				  </div>
				</div>
				
	<?php
	$test_check;
	$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		while($r1 = mysqli_fetch_array($result_select1)){
			
			if($r1['test_code']=="com")
			{
				$test_check.="com,";	
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
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of Standard Card Board (100 mm X 200 mm) (gm)</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of Sample Card Board (gm)</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Grade</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">ThickNess (mm) thick</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Area (mm<sup>2</sup>)</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Maximum load (kN)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Compressive Strength (load/Area) (N/mm<sup>2</sup> )</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Correction factor for thickNess &amp; block type (table 5)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Corrected Compressive Strength (N/mm<sup>2</sup>)</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-12 control-label">Sample Mark</label>-->
										</div>
									</div>
								
							</div>
														
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="lab_1" name="lab_1" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="m1" name="m1">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="grade_1" name="grade_1" readonly>
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="thick_1" name="thick_1" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="area_1" name="area_1" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="load_1" name="load_1" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="com_1" name="com_1" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="factor_1" name="factor_1" readonly>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="corr_1" name="corr_1" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="hidden" class="form-control" id="den_1" name="den_1" >
											<input type="hidden" class="form-control" id="sm1" name="sm1" >
										</div>
									</div>
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="lab_2" name="lab_2" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="m2" name="m2" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="grade_2" name="grade_2" readonly>
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="thick_2" name="thick_2" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="area_2" name="area_2" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="load_2" name="load_2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="com_2" name="com_2" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="factor_2" name="factor_2" readonly>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="corr_2" name="corr_2" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="hidden" class="form-control" id="den_2" name="den_2" >
											<input type="hidden" class="form-control" id="sm2" name="sm2" >
										</div>
									</div>
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="lab_3" name="lab_3" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="m3" name="m3">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="grade_3" name="grade_3" readonly>
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="thick_3" name="thick_3" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="area_3" name="area_3" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="load_3" name="load_3" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="com_3" name="com_3" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="factor_3" name="factor_3" readonly>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="corr_3" name="corr_3" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="hidden" class="form-control" id="den_3" name="den_3" >
											<input type="hidden" class="form-control" id="sm3" name="sm3" >
										</div>
									</div>
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="lab_4" name="lab_4" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="m4" name="m4">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="grade_4" name="grade_4" readonly>
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="thick_4" name="thick_4" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="area_4" name="area_4" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="load_4" name="load_4" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="com_4" name="com_4" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="factor_4" name="factor_4" readonly>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="corr_4" name="corr_4" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="hidden" class="form-control" id="den_4" name="den_4" >
											<input type="hidden" class="form-control" id="sm4" name="sm4" >
										</div>
									</div>
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="lab_5" name="lab_5" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="m5" name="m5">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="grade_5" name="grade_5" readonly>
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="thick_5" name="thick_5" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="area_5" name="area_5" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="load_5" name="load_5" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="com_5" name="com_5" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="factor_5" name="factor_5" readonly>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="corr_5" name="corr_5" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="hidden" class="form-control" id="den_5" name="den_5" >
											<input type="hidden" class="form-control" id="sm5" name="sm5" >
										</div>
									</div>
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="lab_6" name="lab_6" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="m6" name="m6">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="grade_6" name="grade_6" readonly>
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="thick_6" name="thick_6" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="area_6" name="area_6" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="load_6" name="load_6" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="com_6" name="com_6" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="factor_6" name="factor_6" readonly>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="corr_6" name="corr_6" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="hidden" class="form-control" id="den_6" name="den_6" >
											<input type="hidden" class="form-control" id="sm6" name="sm6" >
										</div>
									</div>
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
							<div class="row">
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="lab_7" name="lab_7" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="m7" name="m7">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="grade_7" name="grade_7" readonly>
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="thick_7" name="thick_7" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="area_7" name="area_7" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="load_7" name="load_7" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="com_7" name="com_7" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="factor_7" name="factor_7" readonly >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="corr_7" name="corr_7" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="hidden" class="form-control" id="den_7" name="den_7" >
											<input type="hidden" class="form-control" id="sm7" name="sm7" >
										</div>
									</div>
								
								
							</div>
							<br>
							<div class="row">
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="lab_8" name="lab_8" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="m8" name="m8">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="grade_8" name="grade_8" readonly>
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="thick_8" name="thick_8" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="area_8" name="area_8" readonly>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="load_8" name="load_8" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="com_8" name="com_8" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="factor_8" name="factor_8" readonly>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="corr_8" name="corr_8" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="hidden" class="form-control" id="den_8" name="den_8" >
											<input type="hidden" class="form-control" id="sm8" name="sm8" >
										</div>
									</div>
								
								
							</div>
							
						
							<br>
							<div class="row">
								<div class="col-md-4">
								</div>
								<div class="col-md-3">
								</div>								
								<div class="col-md-2">
									<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control" id="avg_corr" name="avg_corr"disabled >
								</div>
								<div class="col-md-1">
									<input type="hidden" class="form-control" id="avg_den" name="avg_den" >
								</div>
							</DIV>
							
								
						
						</div>
				  </div>
				</div>
				
		
						
				<?php
			}
			if($r1['test_code']=="wtr")
			{	
				$test_check.="wtr,";
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
									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_wtr">2.</label>
													<input type="checkbox" class="visually-hidden" name="chk_wtr"  id="chk_wtr" value="chk_wtr"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">WATER ABSORPTION</label>
										</div>
									</div>
									
							</div>								
								<br>
							<div class="row">
								
									<div class="col-md-1">

									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of sample after saturation(gm) (W1)</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Weight of Oven dry sample (gm) (W2)</label>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Water Absorption (%) (W1 – W2) x 100/W2</label>
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
											<input type="text" class="form-control" id="wtr_w1_1" name="wtr_w1_1" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="wtr_w2_1" name="wtr_w2_1" >
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="wtr_1" name="wtr_1"disabled>
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
											<input type="text" class="form-control" id="wtr_w1_2" name="wtr_w1_2" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="wtr_w2_2" name="wtr_w2_2" >
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="wtr_2" name="wtr_2"disabled>
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
											<input type="text" class="form-control" id="wtr_w1_3" name="wtr_w1_3" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="wtr_w2_3" name="wtr_w2_3" >
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="wtr_3" name="wtr_3"disabled>
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
										
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_wtr" name="avg_wtr"disabled>
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
			if($r1['test_code']=="dim")
			{	
				$test_check.="dim,";
				?>
				<div class="panel panel-default" id="dim">
					<div class="panel-heading" id="txtdim">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
								<h4 class="panel-title">
								<b>Dimension</b>
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
												<label for="chk_dim">3.</label>
												<input type="checkbox" class="visually-hidden" name="chk_dim"  id="chk_dim" value="chk_dim"><br>
											</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">Dimension</label>
									</div>
								</div>
							</div>	
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-sm-2">
									</div>
									<div class="col-sm-2">
										<label for="inputEmail3" class="col-sm-12 control-label">Height</label>
									</div>
									
									<div class="col-sm-2">
										<label for="inputEmail3" class="col-sm-12 control-label">Length</label>
									</div>
								
									<div class="col-sm-2">
										<label for="inputEmail3" class="col-sm-12 control-label">Width</label>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
								<div class="col-sm-2">
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h1_1" name="h1_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l1_1" name="l1_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="w1_1" name="w1_1" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
								<div class="col-sm-2">
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h2_1" name="h2_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l2_1" name="l2_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="w2_1" name="w2_1" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
								<div class="col-sm-2">
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h3_1" name="h3_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l3_1" name="l3_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="w3_1" name="w3_1" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
								<div class="col-sm-2">
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h4_1" name="h4_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l4_1" name="l4_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="w4_1" name="w4_1" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
								<div class="col-sm-2">
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h5_1" name="h5_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l5_1" name="l5_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="w5_1" name="w5_1" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
								<div class="col-sm-2">
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h6_1" name="h6_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l6_1" name="l6_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="w6_1" name="w6_1" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
								<div class="col-sm-2">
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h7_1" name="h7_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l7_1" name="l7_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="w7_1" name="w7_1" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
								<div class="col-sm-2">
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h8_1" name="h8_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l8_1" name="l8_1" >
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="w8_1" name="w8_1" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-sm-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="height_avg" name="height_avg" disabled>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="length_avg" name="length_avg" disabled>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<input type="text" class="form-control" id="width_avg" name="width_avg" disabled>
										</div>
									</div>
								</div>
							</div>
							<br>
							
						</div>
				  </div>
				</div>
				
		
			<?php
			}
			if($r1['test_code']=="ten")
			{	
				$test_check.="ten,";
				?>
				
				<div class="panel panel-default" id="ten">
					<div class="panel-heading" id="txtten">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse51">
								<h4 class="panel-title">
								<b>TENSILE SPLITTING STRENGTH</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse51" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_ten">4.</label>
													<input type="checkbox" class="visually-hidden" name="chk_ten"  id="chk_ten" value="chk_ten"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">TENSILE SPLITTING STRENGTH</label>
										</div>
									</div>
									
							</div>								
									
							<br>								
							<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Sample Mark</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">ThickNess Measure 1</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">ThickNess Measure 2</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">ThickNess Measure 3</label>
										</div>
									</div>									
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">ThickNess of Paver block</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Failure Length Measure 1</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Failure Length Measure 2</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Failure Length, mm</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Area of Failure, mm<sup>2</sup></label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Load, kN</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Tensile Splitting Strength(T), Mpa</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Failure Load(F), N/mm</label>
										</div>
									</div>
									
								
							</div>
														
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm15" name="sm15" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t11" name="t11" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t21" name="t21">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t31" name="t31">
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgt1" name="avgt1">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f11" name="f11">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f21" name="f21" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgf1" name="avgf1" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="farea1" name="farea1">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="spload1" name="spload1" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sten1" name="sten1" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="fload1" name="fload1" >
										</div>
									</div>
									
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm16" name="sm16" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t12" name="t12" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t22" name="t22">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t32" name="t32">
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgt2" name="avgt2">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f12" name="f12">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f22" name="f22" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgf2" name="avgf2" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="farea2" name="farea2">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="spload2" name="spload2" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sten2" name="sten2" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="fload2" name="fload2" >
										</div>
									</div>
									
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm17" name="sm17" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t13" name="t13" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t23" name="t23">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t33" name="t33">
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgt3" name="avgt3">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f13" name="f13">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f23" name="f23" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgf3" name="avgf3" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="farea3" name="farea3">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="spload3" name="spload3" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sten3" name="sten3" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="fload3" name="fload3" >
										</div>
									</div>
									
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm18" name="sm18" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t14" name="t14" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t24" name="t24">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t34" name="t34">
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgt4" name="avgt4">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f14" name="f14">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f24" name="f24" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgf4" name="avgf4" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="farea4" name="farea4">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="spload4" name="spload4" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sten4" name="sten4" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="fload4" name="fload4" >
										</div>
									</div>
									
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm19" name="sm19" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t15" name="t15" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t25" name="t25">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t35" name="t35">
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgt5" name="avgt5">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f15" name="f15">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f25" name="f25" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgf5" name="avgf5" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="farea5" name="farea5">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="spload5" name="spload5" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sten5" name="sten5" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="fload5" name="fload5" >
										</div>
									</div>
									
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm20" name="sm20" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t16" name="t16" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t26" name="t26">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t36" name="t36">
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgt6" name="avgt6">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f16" name="f16">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f26" name="f26" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgf6" name="avgf6" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="farea6" name="farea6">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="spload6" name="spload6" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sten6" name="sten6" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="fload6" name="fload6" >
										</div>
									</div>
									
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm21" name="sm21" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t17" name="t17" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t27" name="t27">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t37" name="t37">
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgt7" name="avgt7">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f17" name="f17">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f27" name="f27" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgf7" name="avgf7" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="farea7" name="farea7">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="spload7" name="spload7" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sten7" name="sten7" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="fload7" name="fload7" >
										</div>
									</div>
									
								
								
							</div>
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm22" name="sm22" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t18" name="t18" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t28" name="t28">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="t38" name="t38">
										</div>
									</div>									
								
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgt8" name="avgt8">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f18" name="f18">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="f28" name="f28" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="avgf8" name="avgf8" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="farea8" name="farea8">
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="spload8" name="spload8" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sten8" name="sten8" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="fload8" name="fload8" >
										</div>
									</div>
									
								
								
							</div>
							<br>
							
						
							<br>
							<div class="row">
								
								<div class="col-md-8">
								</div>								
								<div class="col-md-2">
									<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
								</div>
								<div class="col-md-1">
									<input type="text" class="form-control" id="avg_tensile" name="avg_tensile" >
								</div>
								<div class="col-md-1">
									<input type="text" class="form-control" id="avg_load" name="avg_load" >
								</div>
							</DIV>
							
								
						
						</div>
				  </div>
				</div>
				<?php
			}
			if($r1['test_code']=="fle")
			{	
				$test_check.="fle,";
				?>
				
				<div class="panel panel-default" id="fle">
					<div class="panel-heading" id="txtfle">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse512">
								<h4 class="panel-title">
								<b>FLEXURAL STRENGTH</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse512" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_fle">5.</label>
													<input type="checkbox" class="visually-hidden" name="chk_fle"  id="chk_fle" value="chk_fle"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">FLEXURAL STRENGTH</label>
										</div>
									</div>
									
							</div>								
									
							<br>								
							<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Sample Mark</label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Length, mm</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Width, mm</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">ThickNess, mm</label>
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Distance between Roller, mm</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Load kN</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-12 control-label">Flexural Strength Mpa</label>
										</div>
									</div>
									
								
							</div>
														
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm23" name="sm23" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="flen1" name="flen1" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fwid1" name="fwid1">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fthk1" name="fthk1">
										</div>
									</div>									
								
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fdis1" name="fdis1">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="floa1" name="floa1">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fle1" name="fle1" >
										</div>
									</div>									
							</div>
							
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm24" name="sm24" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="flen2" name="flen2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fwid2" name="fwid2">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fthk2" name="fthk2">
										</div>
									</div>									
								
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fdis2" name="fdis2">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="floa2" name="floa2">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fle2" name="fle2" >
										</div>
									</div>									
							</div>
							
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm25" name="sm25" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="flen3" name="flen3" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fwid3" name="fwid3">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fthk3" name="fthk3">
										</div>
									</div>									
								
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fdis3" name="fdis3">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="floa3" name="floa3">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fle3" name="fle3" >
										</div>
									</div>									
							</div>
							
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm26" name="sm26" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="flen4" name="flen4" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fwid4" name="fwid4">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fthk4" name="fthk4">
										</div>
									</div>									
								
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fdis4" name="fdis4">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="floa4" name="floa4">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fle4" name="fle4" >
										</div>
									</div>									
							</div>
							
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm27" name="sm27" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="flen5" name="flen5" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fwid5" name="fwid5">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fthk5" name="fthk5">
										</div>
									</div>									
								
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fdis5" name="fdis5">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="floa5" name="floa5">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fle5" name="fle5" >
										</div>
									</div>									
							</div>
							
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm28" name="sm28" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="flen6" name="flen6" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fwid6" name="fwid6">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fthk6" name="fthk6">
										</div>
									</div>									
								
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fdis6" name="fdis6">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="floa6" name="floa6">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fle6" name="fle6" >
										</div>
									</div>									
							</div>
							
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm29" name="sm29" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="flen7" name="flen7" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fwid7" name="fwid7">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fthk7" name="fthk7">
										</div>
									</div>									
								
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fdis7" name="fdis7">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="floa7" name="floa7">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fle7" name="fle7" >
										</div>
									</div>									
							</div>
							
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="sm30" name="sm30" >
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<input type="text" class="form-control" id="flen8" name="flen8" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fwid8" name="fwid8">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fthk8" name="fthk8">
										</div>
									</div>									
								
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fdis8" name="fdis8">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="floa8" name="floa8">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="fle8" name="fle8" >
										</div>
									</div>									
							</div>
						
							<br>
							<div class="row">
								
								<div class="col-md-8">
								</div>								
								<div class="col-md-2">
									<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control" id="avg_fle" name="avg_fle" >
								</div>
								
							</DIV>
							
								
						
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
								<th style="text-align:center;"><label>Job No.</label></th>
														<th style="text-align:center;"><label>Unique Identity No.</label></th>
								
																		

							</tr>
								<?php
							 $query = "select * from span_paver_block WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	
	
	$('#ar1,#ar2').change(function(){
		var we1 = $('#wt1').val();
		var we2 = $('#wt2').val();
		var arr1 = $('#ar1').val();
		var arr2 = $('#ar2').val();
		var thickNess  = $('#top_thickNess').val();
       if(we1=="" ||we1==null ||we1=="0")
	   {
		   var ans = (+arr1) * (+thickNess) * (+0.00265);
		   $('#wt1').val(ans.toFixed());
	   }
	   
	   if(we2=="" ||we2==null ||we2=="0")
	   {
		   var ans2 = (+arr2) * (+thickNess) * (+0.00265);
		   $('#wt2').val(ans2.toFixed());
	   }
	});
	
	
	var chk_wtr;
	var avg_wtr;
	var wtr_w1_1;
	var wtr_w1_2;
	var wtr_w1_3;
	var wtr_1;
	var wtr_2;
	var wtr_3;
	var wtr_w2_1;
	var wtr_w2_2;
	var wtr_w2_3;
	
	$('#chk_com').change(function(){
        if(this.checked)
		{ $('#txtcom').css("background-color","var(--success)"); 
		}
		else
		{
			$('#txtcom').css("background-color","white");
		}
	});
	
	$('#chk_wtr').change(function(){
        if(this.checked)
		{ $('#txtwtr').css("background-color","var(--success)"); 
		}
		else
		{
			$('#txtwtr').css("background-color","white");
		}
	});
	$('#chk_abr').change(function(){
        if(this.checked)
		{ $('#txtabr').css("background-color","var(--success)"); 
		}
		else
		{
			$('#txtabr').css("background-color","white");
		}
	});
	
	$('#chk_ten').change(function(){
        if(this.checked)
		{ $('#txtten').css("background-color","var(--success)"); 
		}
		else
		{
			$('#txtten').css("background-color","white");
		}
	});
	
	$('#chk_fle').change(function(){
        if(this.checked)
		{ $('#txtfle').css("background-color","var(--success)"); 
		}
		else
		{
			$('#txtfle').css("background-color","white");
		}
	});
	
	function check_fle()
	{
		$('#sm23').val("PB/23");
		$('#sm24').val("PB/24");
		$('#sm25').val("PB/25");
		$('#sm26').val("PB/26");
		$('#sm27').val("PB/27");
		$('#sm28').val("PB/28");
		$('#sm29').val("PB/29");
		$('#sm30').val("PB/30");
		
		var full_len = $('#full_len').val();
		var full_width = $('#full_width').val();
		var thickNess = $('#top_thickNess').val();
		
		var flen1 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen2 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen3 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen4 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen5 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen6 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen7 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen8 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		
		var fwid1 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid2 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid3 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid4 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid5 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid6 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid7 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid8 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		
		var fthk1 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk2 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk3 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk4 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk5 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk6 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk7 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk8 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		
		$('#flen1').val(flen1.toFixed(2));
		$('#flen2').val(flen2.toFixed(2));
		$('#flen3').val(flen3.toFixed(2));
		$('#flen4').val(flen4.toFixed(2));
		$('#flen5').val(flen5.toFixed(2));
		$('#flen6').val(flen6.toFixed(2));
		$('#flen7').val(flen7.toFixed(2));
		$('#flen8').val(flen8.toFixed(2));
		
		$('#fwid1').val(fwid1.toFixed(2));
		$('#fwid2').val(fwid2.toFixed(2));
		$('#fwid3').val(fwid3.toFixed(2));
		$('#fwid4').val(fwid4.toFixed(2));
		$('#fwid5').val(fwid5.toFixed(2));
		$('#fwid6').val(fwid6.toFixed(2));
		$('#fwid7').val(fwid7.toFixed(2));
		$('#fwid8').val(fwid8.toFixed(2));
		
		$('#fthk1').val(fthk1.toFixed(2));
		$('#fthk2').val(fthk2.toFixed(2));
		$('#fthk3').val(fthk3.toFixed(2));
		$('#fthk4').val(fthk4.toFixed(2));
		$('#fthk5').val(fthk5.toFixed(2));
		$('#fthk6').val(fthk6.toFixed(2));
		$('#fthk7').val(fthk7.toFixed(2));
		$('#fthk8').val(fthk8.toFixed(2));
		
		var flen_1 = $('#flen1').val();
		var flen_2 = $('#flen2').val();
		var flen_3 = $('#flen3').val();
		var flen_4 = $('#flen4').val();
		var flen_5 = $('#flen5').val();
		var flen_6 = $('#flen6').val();
		var flen_7 = $('#flen7').val();
		var flen_8 = $('#flen8').val();
		
		var fdis_1 = (+flen_1) - (+50);
		var fdis_2 = (+flen_2) - (+50);
		var fdis_3 = (+flen_3) - (+50);
		var fdis_4 = (+flen_4) - (+50);
		var fdis_5 = (+flen_5) - (+50);
		var fdis_6 = (+flen_6) - (+50);
		var fdis_7 = (+flen_7) - (+50);
		var fdis_8 = (+flen_8) - (+50);
		
		$('#fdis1').val(fdis_1.toFixed());
		$('#fdis2').val(fdis_2.toFixed());
		$('#fdis3').val(fdis_3.toFixed());
		$('#fdis4').val(fdis_4.toFixed());
		$('#fdis5').val(fdis_5.toFixed());
		$('#fdis6').val(fdis_6.toFixed());
		$('#fdis7').val(fdis_7.toFixed());
		$('#fdis8').val(fdis_8.toFixed());
		
		var grade  = $('#top_grade').val();
		
		if(grade=="M-20")
		 {
			var avgfle = randomNumberFromRange(2.35,2.60).toFixed(2);
				 				 
		 }
		 else if(grade=="M-25")
		 {
			var avgfle = randomNumberFromRange(2.90,3.15).toFixed(2);	
		 }
		 else if(grade=="M-30")
		 {
			var avgfle = randomNumberFromRange(3.45,3.60).toFixed(2);	 
				
		 }
		 else if(grade=="M-35")
		 {
			var avgfle = randomNumberFromRange(4.00,4.25).toFixed(2);	
		 }
		 else if(grade=="M-40")
		 {
			var avgfle = randomNumberFromRange(4.55,4.70).toFixed(2);		 
				
		 }
		 else if(grade=="M-45")
		 {
			var avgfle = randomNumberFromRange(5.10,5.35).toFixed(2);		 	
		 }
		 else if(grade=="M-50")
		 {
			var avgfle = randomNumberFromRange(5.65,5.90).toFixed(2);		 	
		 }
		 else if(grade=="M-55")
		 {
			var avgfle = randomNumberFromRange(6.20,6.30).toFixed(2);		 
		 }
		 else if(grade=="M-60")
		 {
			var avgfle = randomNumberFromRange(6.20,6.30).toFixed(2);		 	
		 }
		 
		  $('#avg_fle').val(avgfle);		
			 var avg_fle = $('#avg_fle').val();
			 var sd = randomNumberFromRange(1,9).toFixed();
			 if(sd%2==0)
			 {
				  var fle1 = (+avg_fle) + 0.08;
				  var fle3 = (+avg_fle) + 0.12;
				  var fle5 = (+avg_fle) + 0.03;
				  var fle7 = (+avg_fle) + 0.09;
				  var fle2 = (+avg_fle) - 0.06;
				  var fle4 = (+avg_fle) - 0.07;
				  var fle6 = (+avg_fle) - 0.14;
				  var fle8 = (+avg_fle) - 0.05;
			 }
			 else
			 {
				  var fle1 = (+avg_fle) - 0.08;
				  var fle3 = (+avg_fle) - 0.12;
				  var fle5 = (+avg_fle) - 0.03;
				  var fle7 = (+avg_fle) - 0.09;
				  var fle2 = (+avg_fle) + 0.06;
				  var fle4 = (+avg_fle) + 0.07;
				  var fle6 = (+avg_fle) + 0.14;
				  var fle8 = (+avg_fle) + 0.05;
			 }
			  $('#fle1').val(fle1.toFixed(2));
			  $('#fle2').val(fle2.toFixed(2));
			  $('#fle3').val(fle3.toFixed(2));
			  $('#fle4').val(fle4.toFixed(2));
			  $('#fle5').val(fle5.toFixed(2));
			  $('#fle6').val(fle6.toFixed(2));
			  $('#fle7').val(fle7.toFixed(2));
			  $('#fle8').val(fle8.toFixed(2));
			  
			  var fle1 = $('#fle1').val();
			  var fle2 = $('#fle2').val();
			  var fle3 = $('#fle3').val();
			  var fle4 = $('#fle4').val();
			  var fle5 = $('#fle5').val();
			  var fle6 = $('#fle6').val();
			  var fle7 = $('#fle7').val();
			  var fle8 = $('#fle8').val();
			  
			  var fwid1 = $('#fwid1').val();
			  var fwid2 = $('#fwid2').val();
			  var fwid3 = $('#fwid3').val();
			  var fwid4 = $('#fwid4').val();
			  var fwid5 = $('#fwid5').val();
			  var fwid6 = $('#fwid6').val();
			  var fwid7 = $('#fwid7').val();
			  var fwid8 = $('#fwid8').val();
			  
			  var fthk1 = $('#fthk1').val();
			  var fthk2 = $('#fthk2').val();
			  var fthk3 = $('#fthk3').val();
			  var fthk4 = $('#fthk4').val();
			  var fthk5 = $('#fthk5').val();
			  var fthk6 = $('#fthk6').val();
			  var fthk7 = $('#fthk7').val();
			  var fthk8 = $('#fthk8').val();
			  
			  var fdis1 = $('#fdis1').val();
			  var fdis2 = $('#fdis2').val();
			  var fdis3 = $('#fdis3').val();
			  var fdis4 = $('#fdis4').val();
			  var fdis5 = $('#fdis5').val();
			  var fdis6 = $('#fdis6').val();
			  var fdis7 = $('#fdis7').val();
			  var fdis8 = $('#fdis8').val();
			  
			  var for1 = (+fle1) * (+2) * (+fwid1) * (+fthk1) * (+fthk1);
			  var for2 = (+fle2) * (+2) * (+fwid2) * (+fthk2) * (+fthk2);
			  var for3 = (+fle3) * (+2) * (+fwid3) * (+fthk3) * (+fthk3);
			  var for4 = (+fle4) * (+2) * (+fwid4) * (+fthk4) * (+fthk4);
			  var for5 = (+fle5) * (+2) * (+fwid5) * (+fthk5) * (+fthk5);
			  var for6 = (+fle6) * (+2) * (+fwid6) * (+fthk6) * (+fthk6);
			  var for7 = (+fle7) * (+2) * (+fwid7) * (+fthk7) * (+fthk7);
			  var for8 = (+fle8) * (+2) * (+fwid8) * (+fthk8) * (+fthk8);
			  
			  var dow1 = (+3) * (+fdis1) * (+1000);
			  var dow2 = (+3) * (+fdis2) * (+1000);
			  var dow3 = (+3) * (+fdis3) * (+1000);
			  var dow4 = (+3) * (+fdis4) * (+1000);
			  var dow5 = (+3) * (+fdis5) * (+1000);
			  var dow6 = (+3) * (+fdis6) * (+1000);
			  var dow7 = (+3) * (+fdis7) * (+1000);
			  var dow8 = (+3) * (+fdis8) * (+1000);
			  
			  var floa1 = (+for1)/ (+dow1);
			  var floa2 = (+for2)/ (+dow2);
			  var floa3 = (+for3)/ (+dow3);
			  var floa4 = (+for4)/ (+dow4);
			  var floa5 = (+for5)/ (+dow5);
			  var floa6 = (+for6)/ (+dow6);
			  var floa7 = (+for7)/ (+dow7);
			  var floa8 = (+for8)/ (+dow8);
			  
			  $('#floa1').val(floa1.toFixed(2));
			  $('#floa2').val(floa2.toFixed(2));
			  $('#floa3').val(floa3.toFixed(2));
			  $('#floa4').val(floa4.toFixed(2));
			  $('#floa5').val(floa5.toFixed(2));
			  $('#floa6').val(floa6.toFixed(2));
			  $('#floa7').val(floa7.toFixed(2));
			  $('#floa8').val(floa8.toFixed(2));
			  
			  
			  //SIDHU
			  var f_wid1 = $('#fwid1').val();
			  var f_wid2 = $('#fwid2').val();
			  var f_wid3 = $('#fwid3').val();
			  var f_wid4 = $('#fwid4').val();
			  var f_wid5 = $('#fwid5').val();
			  var f_wid6 = $('#fwid6').val();
			  var f_wid7 = $('#fwid7').val();
			  var f_wid8 = $('#fwid8').val();
			  
			  var f_thk1 = $('#fthk1').val();
			  var f_thk2 = $('#fthk2').val();
			  var f_thk3 = $('#fthk3').val();
			  var f_thk4 = $('#fthk4').val();
			  var f_thk5 = $('#fthk5').val();
			  var f_thk6 = $('#fthk6').val();
			  var f_thk7 = $('#fthk7').val();
			  var f_thk8 = $('#fthk8').val();
			  
			  var f_dis1 = $('#fdis1').val();
			  var f_dis2 = $('#fdis2').val();
			  var f_dis3 = $('#fdis3').val();
			  var f_dis4 = $('#fdis4').val();
			  var f_dis5 = $('#fdis5').val();
			  var f_dis6 = $('#fdis6').val();
			  var f_dis7 = $('#fdis7').val();
			  var f_dis8 = $('#fdis8').val();
			  
			  var f_loa1 = $('#floa1').val();
			  var f_loa2 = $('#floa2').val();
			  var f_loa3 = $('#floa3').val();
			  var f_loa4 = $('#floa4').val();
			  var f_loa5 = $('#floa5').val();
			  var f_loa6 = $('#floa6').val();
			  var f_loa7 = $('#floa7').val();
			  var f_loa8 = $('#floa8').val();
			  
			  var up1 = (+3) * (+f_loa1) * (+f_dis1) * (+1000);
			  var up2 = (+3) * (+f_loa2) * (+f_dis2) * (+1000);
			  var up3 = (+3) * (+f_loa3) * (+f_dis3) * (+1000);
			  var up4 = (+3) * (+f_loa4) * (+f_dis4) * (+1000);
			  var up5 = (+3) * (+f_loa5) * (+f_dis5) * (+1000);
			  var up6 = (+3) * (+f_loa6) * (+f_dis6) * (+1000);
			  var up7 = (+3) * (+f_loa7) * (+f_dis7) * (+1000);
			  var up8 = (+3) * (+f_loa8) * (+f_dis8) * (+1000);
			  
			  var down1  = (+2) * (+f_wid1) * (+f_thk1) * (+f_thk1);
			  var down2  = (+2) * (+f_wid2) * (+f_thk2) * (+f_thk2);
			  var down3  = (+2) * (+f_wid3) * (+f_thk3) * (+f_thk3);
			  var down4  = (+2) * (+f_wid4) * (+f_thk4) * (+f_thk4);
			  var down5  = (+2) * (+f_wid5) * (+f_thk5) * (+f_thk5);
			  var down6  = (+2) * (+f_wid6) * (+f_thk6) * (+f_thk6);
			  var down7  = (+2) * (+f_wid7) * (+f_thk7) * (+f_thk7);
			  var down8  = (+2) * (+f_wid8) * (+f_thk8) * (+f_thk8);
			  
			  var f_le1 = (+up1) / (+down1);
			  var f_le2 = (+up2) / (+down2);
			  var f_le3 = (+up3) / (+down3);
			  var f_le4 = (+up4) / (+down4);
			  var f_le5 = (+up5) / (+down5);
			  var f_le6 = (+up6) / (+down6);
			  var f_le7 = (+up7) / (+down7);
			  var f_le8 = (+up8) / (+down8);
			  
			  $('#fle1').val(f_le1.toFixed(2));
			  $('#fle2').val(f_le2.toFixed(2));
			  $('#fle3').val(f_le3.toFixed(2));
			  $('#fle4').val(f_le4.toFixed(2));
			  $('#fle5').val(f_le5.toFixed(2));
			  $('#fle6').val(f_le6.toFixed(2));
			  $('#fle7').val(f_le7.toFixed(2));
			  $('#fle8').val(f_le8.toFixed(2));
			  
			  var f__le1 = $('#fle1').val();
			  var f__le2 = $('#fle2').val();
			  var f__le3 = $('#fle3').val();
			  var f__le4 = $('#fle4').val();
			  var f__le5 = $('#fle5').val();
			  var f__le6 = $('#fle6').val();
			  var f__le7 = $('#fle7').val();
			  var f__le8 = $('#fle8').val();
			  
			  var ans = ((+f__le1) + (+f__le2) + (+f__le3) + (+f__le4) + (+f__le5) + (+f__le6) + (+f__le7) + (+f__le8))/8;
			  $('#avg_fle').val(ans.toFixed(2));
				
				
	}
	
	$('#avg_fle').change(function(){
		var full_len = $('#full_len').val();
		var full_width = $('#full_width').val();
		var thickNess = $('#top_thickNess').val();
		
		var flen1 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen2 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen3 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen4 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen5 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen6 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen7 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var flen8 = (+full_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		
		var fwid1 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid2 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid3 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid4 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid5 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid6 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid7 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fwid8 = (+full_width) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		
		var fthk1 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk2 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk3 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk4 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk5 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk6 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk7 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var fthk8 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		
		$('#flen1').val(flen1.toFixed(2));
		$('#flen2').val(flen2.toFixed(2));
		$('#flen3').val(flen3.toFixed(2));
		$('#flen4').val(flen4.toFixed(2));
		$('#flen5').val(flen5.toFixed(2));
		$('#flen6').val(flen6.toFixed(2));
		$('#flen7').val(flen7.toFixed(2));
		$('#flen8').val(flen8.toFixed(2));
		
		$('#fwid1').val(fwid1.toFixed(2));
		$('#fwid2').val(fwid2.toFixed(2));
		$('#fwid3').val(fwid3.toFixed(2));
		$('#fwid4').val(fwid4.toFixed(2));
		$('#fwid5').val(fwid5.toFixed(2));
		$('#fwid6').val(fwid6.toFixed(2));
		$('#fwid7').val(fwid7.toFixed(2));
		$('#fwid8').val(fwid8.toFixed(2));
		
		$('#fthk1').val(fthk1.toFixed(2));
		$('#fthk2').val(fthk2.toFixed(2));
		$('#fthk3').val(fthk3.toFixed(2));
		$('#fthk4').val(fthk4.toFixed(2));
		$('#fthk5').val(fthk5.toFixed(2));
		$('#fthk6').val(fthk6.toFixed(2));
		$('#fthk7').val(fthk7.toFixed(2));
		$('#fthk8').val(fthk8.toFixed(2));
		
		var flen_1 = $('#flen1').val();
		var flen_2 = $('#flen2').val();
		var flen_3 = $('#flen3').val();
		var flen_4 = $('#flen4').val();
		var flen_5 = $('#flen5').val();
		var flen_6 = $('#flen6').val();
		var flen_7 = $('#flen7').val();
		var flen_8 = $('#flen8').val();
		
		var fdis_1 = (+flen_1) - (+50);
		var fdis_2 = (+flen_2) - (+50);
		var fdis_3 = (+flen_3) - (+50);
		var fdis_4 = (+flen_4) - (+50);
		var fdis_5 = (+flen_5) - (+50);
		var fdis_6 = (+flen_6) - (+50);
		var fdis_7 = (+flen_7) - (+50);
		var fdis_8 = (+flen_8) - (+50);
		
		$('#fdis1').val(fdis_1.toFixed());
		$('#fdis2').val(fdis_2.toFixed());
		$('#fdis3').val(fdis_3.toFixed());
		$('#fdis4').val(fdis_4.toFixed());
		$('#fdis5').val(fdis_5.toFixed());
		$('#fdis6').val(fdis_6.toFixed());
		$('#fdis7').val(fdis_7.toFixed());
		$('#fdis8').val(fdis_8.toFixed());
		
				
			 var avg_fle = $('#avg_fle').val();
			 var sd = randomNumberFromRange(1,9).toFixed();
			 if(sd%2==0)
			 {
				  var fle1 = (+avg_fle) + 0.08;
				  var fle3 = (+avg_fle) + 0.12;
				  var fle5 = (+avg_fle) + 0.03;
				  var fle7 = (+avg_fle) + 0.09;
				  var fle2 = (+avg_fle) - 0.06;
				  var fle4 = (+avg_fle) - 0.07;
				  var fle6 = (+avg_fle) - 0.14;
				  var fle8 = (+avg_fle) - 0.05;
			 }
			 else
			 {
				  var fle1 = (+avg_fle) - 0.08;
				  var fle3 = (+avg_fle) - 0.12;
				  var fle5 = (+avg_fle) - 0.03;
				  var fle7 = (+avg_fle) - 0.09;
				  var fle2 = (+avg_fle) + 0.06;
				  var fle4 = (+avg_fle) + 0.07;
				  var fle6 = (+avg_fle) + 0.14;
				  var fle8 = (+avg_fle) + 0.05;
			 }
			  $('#fle1').val(fle1.toFixed(2));
			  $('#fle2').val(fle2.toFixed(2));
			  $('#fle3').val(fle3.toFixed(2));
			  $('#fle4').val(fle4.toFixed(2));
			  $('#fle5').val(fle5.toFixed(2));
			  $('#fle6').val(fle6.toFixed(2));
			  $('#fle7').val(fle7.toFixed(2));
			  $('#fle8').val(fle8.toFixed(2));
			  
			  var fle1 = $('#fle1').val();
			  var fle2 = $('#fle2').val();
			  var fle3 = $('#fle3').val();
			  var fle4 = $('#fle4').val();
			  var fle5 = $('#fle5').val();
			  var fle6 = $('#fle6').val();
			  var fle7 = $('#fle7').val();
			  var fle8 = $('#fle8').val();
			  
			  var fwid1 = $('#fwid1').val();
			  var fwid2 = $('#fwid2').val();
			  var fwid3 = $('#fwid3').val();
			  var fwid4 = $('#fwid4').val();
			  var fwid5 = $('#fwid5').val();
			  var fwid6 = $('#fwid6').val();
			  var fwid7 = $('#fwid7').val();
			  var fwid8 = $('#fwid8').val();
			  
			  var fthk1 = $('#fthk1').val();
			  var fthk2 = $('#fthk2').val();
			  var fthk3 = $('#fthk3').val();
			  var fthk4 = $('#fthk4').val();
			  var fthk5 = $('#fthk5').val();
			  var fthk6 = $('#fthk6').val();
			  var fthk7 = $('#fthk7').val();
			  var fthk8 = $('#fthk8').val();
			  
			  var fdis1 = $('#fdis1').val();
			  var fdis2 = $('#fdis2').val();
			  var fdis3 = $('#fdis3').val();
			  var fdis4 = $('#fdis4').val();
			  var fdis5 = $('#fdis5').val();
			  var fdis6 = $('#fdis6').val();
			  var fdis7 = $('#fdis7').val();
			  var fdis8 = $('#fdis8').val();
			  
			  var for1 = (+fle1) * (+2) * (+fwid1) * (+fthk1) * (+fthk1);
			  var for2 = (+fle2) * (+2) * (+fwid2) * (+fthk2) * (+fthk2);
			  var for3 = (+fle3) * (+2) * (+fwid3) * (+fthk3) * (+fthk3);
			  var for4 = (+fle4) * (+2) * (+fwid4) * (+fthk4) * (+fthk4);
			  var for5 = (+fle5) * (+2) * (+fwid5) * (+fthk5) * (+fthk5);
			  var for6 = (+fle6) * (+2) * (+fwid6) * (+fthk6) * (+fthk6);
			  var for7 = (+fle7) * (+2) * (+fwid7) * (+fthk7) * (+fthk7);
			  var for8 = (+fle8) * (+2) * (+fwid8) * (+fthk8) * (+fthk8);
			  
			  var dow1 = (+3) * (+fdis1) * (+1000);
			  var dow2 = (+3) * (+fdis2) * (+1000);
			  var dow3 = (+3) * (+fdis3) * (+1000);
			  var dow4 = (+3) * (+fdis4) * (+1000);
			  var dow5 = (+3) * (+fdis5) * (+1000);
			  var dow6 = (+3) * (+fdis6) * (+1000);
			  var dow7 = (+3) * (+fdis7) * (+1000);
			  var dow8 = (+3) * (+fdis8) * (+1000);
			  
			  var floa1 = (+for1)/ (+dow1);
			  var floa2 = (+for2)/ (+dow2);
			  var floa3 = (+for3)/ (+dow3);
			  var floa4 = (+for4)/ (+dow4);
			  var floa5 = (+for5)/ (+dow5);
			  var floa6 = (+for6)/ (+dow6);
			  var floa7 = (+for7)/ (+dow7);
			  var floa8 = (+for8)/ (+dow8);
			  
			  $('#floa1').val(floa1.toFixed(2));
			  $('#floa2').val(floa2.toFixed(2));
			  $('#floa3').val(floa3.toFixed(2));
			  $('#floa4').val(floa4.toFixed(2));
			  $('#floa5').val(floa5.toFixed(2));
			  $('#floa6').val(floa6.toFixed(2));
			  $('#floa7').val(floa7.toFixed(2));
			  $('#floa8').val(floa8.toFixed(2));
			  
			  
			  //SIDHU
			  var f_wid1 = $('#fwid1').val();
			  var f_wid2 = $('#fwid2').val();
			  var f_wid3 = $('#fwid3').val();
			  var f_wid4 = $('#fwid4').val();
			  var f_wid5 = $('#fwid5').val();
			  var f_wid6 = $('#fwid6').val();
			  var f_wid7 = $('#fwid7').val();
			  var f_wid8 = $('#fwid8').val();
			  
			  var f_thk1 = $('#fthk1').val();
			  var f_thk2 = $('#fthk2').val();
			  var f_thk3 = $('#fthk3').val();
			  var f_thk4 = $('#fthk4').val();
			  var f_thk5 = $('#fthk5').val();
			  var f_thk6 = $('#fthk6').val();
			  var f_thk7 = $('#fthk7').val();
			  var f_thk8 = $('#fthk8').val();
			  
			  var f_dis1 = $('#fdis1').val();
			  var f_dis2 = $('#fdis2').val();
			  var f_dis3 = $('#fdis3').val();
			  var f_dis4 = $('#fdis4').val();
			  var f_dis5 = $('#fdis5').val();
			  var f_dis6 = $('#fdis6').val();
			  var f_dis7 = $('#fdis7').val();
			  var f_dis8 = $('#fdis8').val();
			  
			  var f_loa1 = $('#floa1').val();
			  var f_loa2 = $('#floa2').val();
			  var f_loa3 = $('#floa3').val();
			  var f_loa4 = $('#floa4').val();
			  var f_loa5 = $('#floa5').val();
			  var f_loa6 = $('#floa6').val();
			  var f_loa7 = $('#floa7').val();
			  var f_loa8 = $('#floa8').val();
			  
			  var up1 = (+3) * (+f_loa1) * (+f_dis1) * (+1000);
			  var up2 = (+3) * (+f_loa2) * (+f_dis2) * (+1000);
			  var up3 = (+3) * (+f_loa3) * (+f_dis3) * (+1000);
			  var up4 = (+3) * (+f_loa4) * (+f_dis4) * (+1000);
			  var up5 = (+3) * (+f_loa5) * (+f_dis5) * (+1000);
			  var up6 = (+3) * (+f_loa6) * (+f_dis6) * (+1000);
			  var up7 = (+3) * (+f_loa7) * (+f_dis7) * (+1000);
			  var up8 = (+3) * (+f_loa8) * (+f_dis8) * (+1000);
			  
			  var down1  = (+2) * (+f_wid1) * (+f_thk1) * (+f_thk1);
			  var down2  = (+2) * (+f_wid2) * (+f_thk2) * (+f_thk2);
			  var down3  = (+2) * (+f_wid3) * (+f_thk3) * (+f_thk3);
			  var down4  = (+2) * (+f_wid4) * (+f_thk4) * (+f_thk4);
			  var down5  = (+2) * (+f_wid5) * (+f_thk5) * (+f_thk5);
			  var down6  = (+2) * (+f_wid6) * (+f_thk6) * (+f_thk6);
			  var down7  = (+2) * (+f_wid7) * (+f_thk7) * (+f_thk7);
			  var down8  = (+2) * (+f_wid8) * (+f_thk8) * (+f_thk8);
			  
			  var f_le1 = (+up1) / (+down1);
			  var f_le2 = (+up2) / (+down2);
			  var f_le3 = (+up3) / (+down3);
			  var f_le4 = (+up4) / (+down4);
			  var f_le5 = (+up5) / (+down5);
			  var f_le6 = (+up6) / (+down6);
			  var f_le7 = (+up7) / (+down7);
			  var f_le8 = (+up8) / (+down8);
			  
			  $('#fle1').val(f_le1.toFixed(2));
			  $('#fle2').val(f_le2.toFixed(2));
			  $('#fle3').val(f_le3.toFixed(2));
			  $('#fle4').val(f_le4.toFixed(2));
			  $('#fle5').val(f_le5.toFixed(2));
			  $('#fle6').val(f_le6.toFixed(2));
			  $('#fle7').val(f_le7.toFixed(2));
			  $('#fle8').val(f_le8.toFixed(2));
			  
			  var f__le1 = $('#fle1').val();
			  var f__le2 = $('#fle2').val();
			  var f__le3 = $('#fle3').val();
			  var f__le4 = $('#fle4').val();
			  var f__le5 = $('#fle5').val();
			  var f__le6 = $('#fle6').val();
			  var f__le7 = $('#fle7').val();
			  var f__le8 = $('#fle8').val();
			  
			  var ans = ((+f__le1) + (+f__le2) + (+f__le3) + (+f__le4) + (+f__le5) + (+f__le6) + (+f__le7) + (+f__le8))/8;
			  $('#avg_fle').val(ans.toFixed(2));
		
		
	});
	
	$('#chk_fle').change(function(){
        if(this.checked)
		{
			check_fle();
			
		}	
		else
		{
			$('#sm23').val(null);
			$('#sm24').val(null);
			$('#sm25').val(null);
			$('#sm26').val(null);
			$('#sm27').val(null);
			$('#sm28').val(null);
			$('#sm29').val(null);
			$('#sm30').val(null);
			
			
			$('#flen1').val(null);
			$('#flen2').val(null);
			$('#flen3').val(null);
			$('#flen4').val(null);
			$('#flen5').val(null);
			$('#flen6').val(null);
			$('#flen7').val(null);
			$('#flen8').val(null);
			$('#fwid1').val(null);
			$('#fwid2').val(null);
			$('#fwid3').val(null);
			$('#fwid4').val(null);
			$('#fwid5').val(null);
			$('#fwid6').val(null);
			$('#fwid7').val(null);
			$('#fwid8').val(null);
			$('#fthk1').val(null);
			$('#fthk2').val(null);
			$('#fthk3').val(null);
			$('#fthk4').val(null);
			$('#fthk5').val(null);
			$('#fthk6').val(null);
			$('#fthk7').val(null);
			$('#fthk8').val(null);
			$('#fdis1').val(null);
			$('#fdis2').val(null);
			$('#fdis3').val(null);
			$('#fdis4').val(null);
			$('#fdis5').val(null);
			$('#fdis6').val(null);
			$('#fdis7').val(null);
			$('#fdis8').val(null);
			$('#floa1').val(null);
			$('#floa2').val(null);
			$('#floa3').val(null);
			$('#floa4').val(null);
			$('#floa5').val(null);
			$('#floa6').val(null);
			$('#floa7').val(null);
			$('#floa8').val(null);
			$('#fle1').val(null);
			$('#fle2').val(null);
			$('#fle3').val(null);
			$('#fle4').val(null);
			$('#fle5').val(null);
			$('#fle6').val(null);
			$('#fle7').val(null);
			$('#fle8').val(null);
			
			
			$('#avg_fle').val(null);
			
			
			
			
		}
	});
	
	
	$('#fwid1,#fwid2,#fwid3,#fwid4,#fwid5,#fwid6,#fwid7,#fwid8,#fthk1,#fthk2,#fthk3,#fthk4,#fthk5,#fthk6,#fthk7,#fthk8,#floa1,#floa2,#floa3,#floa4,#floa5,#floa6,#floa7,#floa8,#fdis1,#fdis2,#fdis3,#fdis4,#fdis5,#fdis6,#fdis7,#fdis8').change(function(){
		manual_flexural();
	});
	
	$('#flen1,#flen2,#flen3,#flen4,#flen5,#flen6,#flen7,#flen8').change(function(){
		 var f_len1 = $('#flen1').val();
		  var f_len2 = $('#flen2').val();
		  var f_len3 = $('#flen3').val();
		  var f_len4 = $('#flen4').val();
		  var f_len5 = $('#flen5').val();
		  var f_len6 = $('#flen6').val();
		  var f_len7 = $('#flen7').val();
		  var f_len8 = $('#flen8').val();
		  
		   var fdis_1 = (+f_len1) - (+50);
		  var fdis_2 = (+f_len2) - (+50);
		  var fdis_3 = (+f_len3) - (+50);
		  var fdis_4 = (+f_len4) - (+50);
		  var fdis_5 = (+f_len5) - (+50);
		  var fdis_6 = (+f_len6) - (+50);
		  var fdis_7 = (+f_len7) - (+50);
		  var fdis_8 = (+f_len8) - (+50);
		
		  $('#fdis1').val(fdis_1.toFixed());
		  $('#fdis2').val(fdis_2.toFixed());
		  $('#fdis3').val(fdis_3.toFixed());
		  $('#fdis4').val(fdis_4.toFixed());
		  $('#fdis5').val(fdis_5.toFixed());
		  $('#fdis6').val(fdis_6.toFixed());
		  $('#fdis7').val(fdis_7.toFixed());
		  $('#fdis8').val(fdis_8.toFixed());
		  
		  
	});
	
	
	
	function manual_flexural()
	{
		
		  
		  var f_wid1 = $('#fwid1').val();
		  var f_wid2 = $('#fwid2').val();
		  var f_wid3 = $('#fwid3').val();
		  var f_wid4 = $('#fwid4').val();
		  var f_wid5 = $('#fwid5').val();
		  var f_wid6 = $('#fwid6').val();
		  var f_wid7 = $('#fwid7').val();
		  var f_wid8 = $('#fwid8').val();
		  
		  var f_thk1 = $('#fthk1').val();
		  var f_thk2 = $('#fthk2').val();
		  var f_thk3 = $('#fthk3').val();
		  var f_thk4 = $('#fthk4').val();
		  var f_thk5 = $('#fthk5').val();
		  var f_thk6 = $('#fthk6').val();
		  var f_thk7 = $('#fthk7').val();
		  var f_thk8 = $('#fthk8').val();
		  
		 
		  
		  var f_dis1 = $('#fdis1').val();
		  var f_dis2 = $('#fdis2').val();
		  var f_dis3 = $('#fdis3').val();
		  var f_dis4 = $('#fdis4').val();
		  var f_dis5 = $('#fdis5').val();
		  var f_dis6 = $('#fdis6').val();
		  var f_dis7 = $('#fdis7').val();
		  var f_dis8 = $('#fdis8').val();
		  
		  var f_loa1 = $('#floa1').val();
		  var f_loa2 = $('#floa2').val();
		  var f_loa3 = $('#floa3').val();
		  var f_loa4 = $('#floa4').val();
		  var f_loa5 = $('#floa5').val();
		  var f_loa6 = $('#floa6').val();
		  var f_loa7 = $('#floa7').val();
		  var f_loa8 = $('#floa8').val();
		  
	      var up1 = (+3) * (+f_loa1) * (+f_dis1) * (+1000);
		  var up2 = (+3) * (+f_loa2) * (+f_dis2) * (+1000);
		  var up3 = (+3) * (+f_loa3) * (+f_dis3) * (+1000);
		  var up4 = (+3) * (+f_loa4) * (+f_dis4) * (+1000);
		  var up5 = (+3) * (+f_loa5) * (+f_dis5) * (+1000);
		  var up6 = (+3) * (+f_loa6) * (+f_dis6) * (+1000);
		  var up7 = (+3) * (+f_loa7) * (+f_dis7) * (+1000);
		  var up8 = (+3) * (+f_loa8) * (+f_dis8) * (+1000);
		  
		  var down1  = (+2) * (+f_wid1) * (+f_thk1) * (+f_thk1);
		  var down2  = (+2) * (+f_wid2) * (+f_thk2) * (+f_thk2);
		  var down3  = (+2) * (+f_wid3) * (+f_thk3) * (+f_thk3);
		  var down4  = (+2) * (+f_wid4) * (+f_thk4) * (+f_thk4);
		  var down5  = (+2) * (+f_wid5) * (+f_thk5) * (+f_thk5);
		  var down6  = (+2) * (+f_wid6) * (+f_thk6) * (+f_thk6);
		  var down7  = (+2) * (+f_wid7) * (+f_thk7) * (+f_thk7);
		  var down8  = (+2) * (+f_wid8) * (+f_thk8) * (+f_thk8);
		  
		  var f_le1 = (+up1) / (+down1);
		  var f_le2 = (+up2) / (+down2);
		  var f_le3 = (+up3) / (+down3);
		  var f_le4 = (+up4) / (+down4);
		  var f_le5 = (+up5) / (+down5);
		  var f_le6 = (+up6) / (+down6);
		  var f_le7 = (+up7) / (+down7);
		  var f_le8 = (+up8) / (+down8);
		  
		  $('#fle1').val(f_le1.toFixed(2));
		  $('#fle2').val(f_le2.toFixed(2));
		  $('#fle3').val(f_le3.toFixed(2));
		  $('#fle4').val(f_le4.toFixed(2));
		  $('#fle5').val(f_le5.toFixed(2));
		  $('#fle6').val(f_le6.toFixed(2));
		  $('#fle7').val(f_le7.toFixed(2));
		  $('#fle8').val(f_le8.toFixed(2));
		  
		  var f__le1 = $('#fle1').val();
		  var f__le2 = $('#fle2').val();
		  var f__le3 = $('#fle3').val();
		  var f__le4 = $('#fle4').val();
		  var f__le5 = $('#fle5').val();
		  var f__le6 = $('#fle6').val();
		  var f__le7 = $('#fle7').val();
		  var f__le8 = $('#fle8').val();
		  
		  var ans = ((+f__le1) + (+f__le2) + (+f__le3) + (+f__le4) + (+f__le5) + (+f__le6) + (+f__le7) + (+f__le8))/8;
		  $('#avg_fle').val(ans.toFixed(2));
		  
		  
		  
	}
	
	
	function check_ten()
	{
		$('#sm15').val("PB/15");
		$('#sm16').val("PB/16");
		$('#sm17').val("PB/17");
		$('#sm18').val("PB/18");
		$('#sm19').val("PB/19");
		$('#sm20').val("PB/20");
		$('#sm21').val("PB/21");
		$('#sm22').val("PB/22");
		var thickNess = $('#top_thickNess').val();
		//1st
		var t_11 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_21 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_31 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t11').val(t_11);
		$('#t21').val(t_21);
		$('#t31').val(t_31);
		var t11 = $('#t11').val();
		var t21 = $('#t21').val();
		var t31 = $('#t31').val();
		
		var avgt_1 = ((+t11) + (+t21) +( +t31)) / 3;
		$('#avgt1').val(avgt_1.toFixed(2));
		
		//2nd
		var t_12 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_22 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_32 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t12').val(t_12);
		$('#t22').val(t_22);
		$('#t32').val(t_32);
		var t12 = $('#t12').val();
		var t22 = $('#t22').val();
		var t32 = $('#t32').val();
		
		var avgt_2 = ((+t12) + (+t22) +( +t32)) / 3;
		$('#avgt2').val(avgt_2.toFixed(2));
		
		//3rd
		var t_13 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_23 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_33 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t13').val(t_13);
		$('#t23').val(t_23);
		$('#t33').val(t_33);
		var t13 = $('#t13').val();
		var t23 = $('#t23').val();
		var t33 = $('#t33').val();
		
		var avgt_3 = ((+t13) + (+t23) +( +t33)) / 3;
		$('#avgt3').val(avgt_3.toFixed(2));
		
		//4th
		var t_14 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_24 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_34 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t14').val(t_14);
		$('#t24').val(t_24);
		$('#t34').val(t_34);
		var t14 = $('#t14').val();
		var t24 = $('#t24').val();
		var t34 = $('#t34').val();
		
		var avgt_4 = ((+t14) + (+t24) +( +t34)) / 3;
		$('#avgt4').val(avgt_4.toFixed(2));
		
		//5th
		var t_15 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_25 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_35 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t15').val(t_15);
		$('#t25').val(t_25);
		$('#t35').val(t_35);
		var t15 = $('#t15').val();
		var t25 = $('#t25').val();
		var t35 = $('#t35').val();
		
		var avgt_5 = ((+t15) + (+t25) +( +t35)) / 3;
		$('#avgt5').val(avgt_5.toFixed(2));
		
		//6th
		var t_16 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_26 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_36 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t16').val(t_16);
		$('#t26').val(t_26);
		$('#t36').val(t_36);
		var t16 = $('#t16').val();
		var t26 = $('#t26').val();
		var t36 = $('#t36').val();
		
		var avgt_6 = ((+t16) + (+t26) +( +t36)) / 3;
		$('#avgt6').val(avgt_6.toFixed(2));
		
		//7th
		var t_17 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_27 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_37 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t17').val(t_17);
		$('#t27').val(t_27);
		$('#t37').val(t_37);
		var t17 = $('#t17').val();
		var t27 = $('#t27').val();
		var t37 = $('#t37').val();
		
		var avgt_7 = ((+t17) + (+t27) +( +t37)) / 3;
		$('#avgt7').val(avgt_7.toFixed(2));
		
		//8th
		var t_18 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_28 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_38 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t18').val(t_18);
		$('#t28').val(t_28);
		$('#t38').val(t_38);
		var t18 = $('#t18').val();
		var t28 = $('#t28').val();
		var t38 = $('#t38').val();
		
		var avgt_8 = ((+t18) + (+t28) +( +t38)) / 3;
		$('#avgt8').val(avgt_8.toFixed(2));
		
		//LENGTH
		var sp_len = $('#sp_len').val();
		
		//1st
		var f_11 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_21 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f11').val(f_11);
		$('#f21').val(f_21);		
		var f11 = $('#f11').val();
		var f21 = $('#f21').val();				
		var avgf_1 = ((+f11) + (+f21) ) / 2;
		$('#avgf1').val(avgf_1.toFixed(2));
		
		//2st
		var f_12 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_22 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f12').val(f_12);
		$('#f22').val(f_22);		
		var f12 = $('#f12').val();
		var f22 = $('#f22').val();				
		var avgf_2 = ((+f12) + (+f22) ) / 2;
		$('#avgf2').val(avgf_2.toFixed(2));
		
		//3st
		var f_13 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_23 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f13').val(f_13);
		$('#f23').val(f_23);		
		var f13 = $('#f13').val();
		var f23 = $('#f23').val();				
		var avgf_3 = ((+f13) + (+f23) ) / 2;
		$('#avgf3').val(avgf_3.toFixed(2));
		
		//4st
		var f_14 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_24 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f14').val(f_14);
		$('#f24').val(f_24);		
		var f14 = $('#f14').val();
		var f24 = $('#f24').val();				
		var avgf_4 = ((+f14) + (+f24) ) / 2;
		$('#avgf4').val(avgf_4.toFixed(2));
		
		//5st
		var f_15 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_25 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f15').val(f_15);
		$('#f25').val(f_25);		
		var f15 = $('#f15').val();
		var f25 = $('#f25').val();				
		var avgf_5 = ((+f15) + (+f25) ) / 2;
		$('#avgf5').val(avgf_5.toFixed(2));
		
		//6st
		var f_16 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_26 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f16').val(f_16);
		$('#f26').val(f_26);		
		var f16 = $('#f16').val();
		var f26 = $('#f26').val();				
		var avgf_6 = ((+f16) + (+f26) ) / 2;
		$('#avgf6').val(avgf_6.toFixed(2));
		
		//7st
		var f_17 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_27 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f17').val(f_17);
		$('#f27').val(f_27);		
		var f17 = $('#f17').val();
		var f27 = $('#f27').val();				
		var avgf_7 = ((+f17) + (+f27) ) / 2;
		$('#avgf7').val(avgf_7.toFixed(2));
		
		//8st
		var f_18 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_28 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f18').val(f_18);
		$('#f28').val(f_28);		
		var f18 = $('#f18').val();
		var f28 = $('#f28').val();				
		var avgf_8 = ((+f18) + (+f28) ) / 2;
		$('#avgf8').val(avgf_8.toFixed(2));
		
		var avgt1 = $('#avgt1').val();
		var avgt2 = $('#avgt2').val();
		var avgt3 = $('#avgt3').val();
		var avgt4 = $('#avgt4').val();
		var avgt5 = $('#avgt5').val();
		var avgt6 = $('#avgt6').val();
		var avgt7 = $('#avgt7').val();
		var avgt8 = $('#avgt8').val();
		
		var avgf1 = $('#avgf1').val();
		var avgf2 = $('#avgf2').val();
		var avgf3 = $('#avgf3').val();
		var avgf4 = $('#avgf4').val();
		var avgf5 = $('#avgf5').val();
		var avgf6 = $('#avgf6').val();
		var avgf7 = $('#avgf7').val();
		var avgf8 = $('#avgf8').val();
		
		var farea_1 = (+avgt1) * (+avgf1);
		var farea_2 = (+avgt2) * (+avgf2);
		var farea_3 = (+avgt3) * (+avgf3);
		var farea_4 = (+avgt4) * (+avgf4);
		var farea_5 = (+avgt5) * (+avgf5);
		var farea_6 = (+avgt6) * (+avgf6);
		var farea_7 = (+avgt7) * (+avgf7);
		var farea_8 = (+avgt8) * (+avgf8);
		
		$('#farea1').val(farea_1.toFixed());
		$('#farea2').val(farea_2.toFixed());
		$('#farea3').val(farea_3.toFixed());
		$('#farea4').val(farea_4.toFixed());
		$('#farea5').val(farea_5.toFixed());
		$('#farea6').val(farea_6.toFixed());
		$('#farea7').val(farea_7.toFixed());
		$('#farea8').val(farea_8.toFixed());
		
		var grade  = $('#top_grade').val();
		
		if(grade=="M-20")
		 {
			var avgtensile = randomNumberFromRange(1.90,2.10).toFixed(2);
				 				 
		 }
		 else if(grade=="M-25")
		 {
			var avgtensile = randomNumberFromRange(2.30,2.50).toFixed(2);	
		 }
		 else if(grade=="M-30")
		 {
			var avgtensile = randomNumberFromRange(2.75,3.00).toFixed(2);	 
				
		 }
		 else if(grade=="M-35")
		 {
			var avgtensile = randomNumberFromRange(3.15,3.60).toFixed(2);	
		 }
		 else if(grade=="M-40")
		 {
			var avgtensile = randomNumberFromRange(3.85,4.00).toFixed(2);		 
				
		 }
		 else if(grade=="M-45")
		 {
			var avgtensile = randomNumberFromRange(3.95,4.00).toFixed(2);		 	
		 }
		 else if(grade=="M-50")
		 {
			var avgtensile = randomNumberFromRange(3.95,4.00).toFixed(2);		 	
		 }
		 else if(grade=="M-55")
		 {
			var avgtensile = randomNumberFromRange(3.95,4.00).toFixed(2);		 
		 }
		 else if(grade=="M-60")
		 {
			var avgtensile = randomNumberFromRange(3.95,4.00).toFixed(2);		 	
		 }
		 
		  $('#avg_tensile').val(avgtensile);		
			 var avg_ten = $('#avg_tensile').val();
			 var sd = randomNumberFromRange(1,9).toFixed();
			 if(sd%2==0)
			 {
				  var sten1 = (+avg_ten) + 0.08;
				  var sten3 = (+avg_ten) + 0.12;
				  var sten5 = (+avg_ten) + 0.03;
				  var sten7 = (+avg_ten) + 0.09;
				  var sten2 = (+avg_ten) - 0.06;
				  var sten4 = (+avg_ten) - 0.07;
				  var sten6 = (+avg_ten) - 0.14;
				  var sten8 = (+avg_ten) - 0.05;
			 }
			 else
			 {
				  var sten1 = (+avg_ten) - 0.08;
				  var sten3 = (+avg_ten) - 0.12;
				  var sten5 = (+avg_ten) - 0.03;
				  var sten7 = (+avg_ten) - 0.09;
				  var sten2 = (+avg_ten) + 0.06;
				  var sten4 = (+avg_ten) + 0.07;
				  var sten6 = (+avg_ten) + 0.14;
				  var sten8 = (+avg_ten) + 0.05;
			 }
			  $('#sten1').val(sten1.toFixed(2));
			  $('#sten2').val(sten2.toFixed(2));
			  $('#sten3').val(sten3.toFixed(2));
			  $('#sten4').val(sten4.toFixed(2));
			  $('#sten5').val(sten5.toFixed(2));
			  $('#sten6').val(sten6.toFixed(2));
			  $('#sten7').val(sten7.toFixed(2));
			  $('#sten8').val(sten8.toFixed(2));
			  
			  var farea1 = $('#farea1').val();
			  var farea2 = $('#farea2').val();
			  var farea3 = $('#farea3').val();
			  var farea4 = $('#farea4').val();
			  var farea5 = $('#farea5').val();
			  var farea6 = $('#farea6').val();
			  var farea7 = $('#farea7').val();
			  var farea8 = $('#farea8').val();
			  
			  var sten1 = $('#sten1').val();
			  var sten2 = $('#sten2').val();
			  var sten3 = $('#sten3').val();
			  var sten4 = $('#sten4').val();
			  var sten5 = $('#sten5').val();
			  var sten6 = $('#sten6').val();
			  var sten7 = $('#sten7').val();
			  var sten8 = $('#sten8').val();
			  
			  var spl_1 = (+sten1) * (+farea1); 
			  var spl_2 = (+sten2) * (+farea2); 
			  var spl_3 = (+sten3) * (+farea3); 
			  var spl_4 = (+sten4) * (+farea4); 
			  var spl_5 = (+sten5) * (+farea5); 
			  var spl_6 = (+sten6) * (+farea6); 
			  var spl_7 = (+sten7) * (+farea7); 
			  var spl_8 = (+sten8) * (+farea8);
			  
			  if(thickNess=="50")
			  {
				  var k = 0.79;
			  }
			  else if(thickNess=="60")
			  {
				  var k = 0.87;
			  }
			  else if(thickNess=="80")
			  {
				  var k = 1.00;
			  }
			  else if(thickNess=="100")
			  {
				  var k = 1.11;
			  }
			  else if(thickNess=="120")
			  {
				  var k = 1.19;
			  }

			 var splo_1 = (+0.637) * 1000 * (+k);
			 var splo_2 = (+0.637) * 1000 * (+k);
			 var splo_3 = (+0.637) * 1000 * (+k);
			 var splo_4 = (+0.637) * 1000 * (+k);
			 var splo_5 = (+0.637) * 1000 * (+k);
			 var splo_6 = (+0.637) * 1000 * (+k);
			 var splo_7 = (+0.637) * 1000 * (+k);
			 var splo_8 = (+0.637) * 1000 * (+k);
			 
			 var spload_1 = (+spl_1) / (+splo_1);
			 var spload_2 = (+spl_2) / (+splo_2);
			 var spload_3 = (+spl_3) / (+splo_3);
			 var spload_4 = (+spl_4) / (+splo_4);
			 var spload_5 = (+spl_5) / (+splo_5);
			 var spload_6 = (+spl_6) / (+splo_6);
			 var spload_7 = (+spl_7) / (+splo_7);
			 var spload_8 = (+spl_8) / (+splo_8);
			
			  $('#spload1').val(spload_1.toFixed(2));
			  $('#spload2').val(spload_2.toFixed(2));
			  $('#spload3').val(spload_3.toFixed(2));
			  $('#spload4').val(spload_4.toFixed(2));
			  $('#spload5').val(spload_5.toFixed(2));
			  $('#spload6').val(spload_6.toFixed(2));
			  $('#spload7').val(spload_7.toFixed(2));
			  $('#spload8').val(spload_8.toFixed(2));
			  
			  var spload1 = $('#spload1').val();
			  var spload2 = $('#spload2').val();
			  var spload3 = $('#spload3').val();
			  var spload4 = $('#spload4').val();
			  var spload5 = $('#spload5').val();
			  var spload6 = $('#spload6').val();
			  var spload7 = $('#spload7').val();
			  var spload8 = $('#spload8').val();
			  
			  var avgf1 = $('#avgf1').val();
			  var avgf2 = $('#avgf2').val();
			  var avgf3 = $('#avgf3').val();
			  var avgf4 = $('#avgf4').val();
			  var avgf5 = $('#avgf5').val();
			  var avgf6 = $('#avgf6').val();
			  var avgf7 = $('#avgf7').val();
			  var avgf8 = $('#avgf8').val();
			  
			  var f_load1 = ((+spload1) / (+1000)) * (+avgf1);
			  var f_load2 = ((+spload2) / (+1000)) * (+avgf2);
			  var f_load3 = ((+spload3) / (+1000)) * (+avgf3);
			  var f_load4 = ((+spload4) / (+1000)) * (+avgf4);
			  var f_load5 = ((+spload5) / (+1000)) * (+avgf5);
			  var f_load6 = ((+spload6) / (+1000)) * (+avgf6);
			  var f_load7 = ((+spload7) / (+1000)) * (+avgf7);
			  var f_load8 = ((+spload8) / (+1000)) * (+avgf8);
			  
			  $('#fload1').val(f_load1.toFixed(2));
			  $('#fload2').val(f_load2.toFixed(2));
			  $('#fload3').val(f_load3.toFixed(2));
			  $('#fload4').val(f_load4.toFixed(2));
			  $('#fload5').val(f_load5.toFixed(2));
			  $('#fload6').val(f_load6.toFixed(2));
			  $('#fload7').val(f_load7.toFixed(2));
			  $('#fload8').val(f_load8.toFixed(2));
			  
			  var fload1 = $('#fload1').val();
			  var fload2 = $('#fload2').val();
			  var fload3 = $('#fload3').val();
			  var fload4 = $('#fload4').val();
			  var fload5 = $('#fload5').val();
			  var fload6 = $('#fload6').val();
			  var fload7 = $('#fload7').val();
			  var fload8 = $('#fload8').val();
			  
			  var avg = ((+fload1) + (+fload2) + (+fload3) + (+fload4) + (+fload5) + (+fload6) + (+fload7) + (+fload8)) / 8;
			  $('#avg_load').val(avg.toFixed(2));
			 
			//sidhu
			  var cal1 = (+0.637) * (+k) * (+spload1) * (+1000);
			  var cal2 = (+0.637) * (+k) * (+spload2) * (+1000);
			  var cal3 = (+0.637) * (+k) * (+spload3) * (+1000);
			  var cal4 = (+0.637) * (+k) * (+spload4) * (+1000);
			  var cal5 = (+0.637) * (+k) * (+spload5) * (+1000);
			  var cal6 = (+0.637) * (+k) * (+spload6) * (+1000);
			  var cal7 = (+0.637) * (+k) * (+spload7) * (+1000);
			  var cal8 = (+0.637) * (+k) * (+spload8) * (+1000);
			  
			  var tensile1 = (+cal1) / (+farea1);
			  var tensile2 = (+cal2) / (+farea2);
			  var tensile3 = (+cal3) / (+farea3);
			  var tensile4 = (+cal4) / (+farea4);
			  var tensile5 = (+cal5) / (+farea5);
			  var tensile6 = (+cal6) / (+farea6);
			  var tensile7 = (+cal7) / (+farea7);
			  var tensile8 = (+cal8) / (+farea8);
			  
			  $('#sten1').val(tensile1.toFixed(2));
			  $('#sten2').val(tensile2.toFixed(2));
			  $('#sten3').val(tensile3.toFixed(2));
			  $('#sten4').val(tensile4.toFixed(2));
			  $('#sten5').val(tensile5.toFixed(2));
			  $('#sten6').val(tensile6.toFixed(2));
			  $('#sten7').val(tensile7.toFixed(2));
			  $('#sten8').val(tensile8.toFixed(2));
			  			 
			  
			  var ten_1 = $('#sten1').val();
			  var ten_2 = $('#sten2').val();
			  var ten_3 = $('#sten3').val();
			  var ten_4 = $('#sten4').val();
			  var ten_5 = $('#sten5').val();
			  var ten_6 = $('#sten6').val();
			  var ten_7 = $('#sten7').val();
			  var ten_8 = $('#sten8').val();
			  
			  var avg_ten = ((+ten_1) + (+ten_2) + (+ten_3) + (+ten_4) + (+ten_5) + (+ten_6) + (+ten_7) + (+ten_8)) / 8;
			  $('#avg_tensile').val(avg_ten.toFixed(2));
			  
			  
				
				
				
	}
	
	$('#avg_tensile').change(function(){
        
			var thickNess = $('#top_thickNess').val();
		//1st
		var t_11 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_21 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_31 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t11').val(t_11);
		$('#t21').val(t_21);
		$('#t31').val(t_31);
		var t11 = $('#t11').val();
		var t21 = $('#t21').val();
		var t31 = $('#t31').val();
		
		var avgt_1 = ((+t11) + (+t21) +( +t31)) / 3;
		$('#avgt1').val(avgt_1.toFixed(2));
		
		//2nd
		var t_12 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_22 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_32 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t12').val(t_12);
		$('#t22').val(t_22);
		$('#t32').val(t_32);
		var t12 = $('#t12').val();
		var t22 = $('#t22').val();
		var t32 = $('#t32').val();
		
		var avgt_2 = ((+t12) + (+t22) +( +t32)) / 3;
		$('#avgt2').val(avgt_2.toFixed(2));
		
		//3rd
		var t_13 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_23 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_33 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t13').val(t_13);
		$('#t23').val(t_23);
		$('#t33').val(t_33);
		var t13 = $('#t13').val();
		var t23 = $('#t23').val();
		var t33 = $('#t33').val();
		
		var avgt_3 = ((+t13) + (+t23) +( +t33)) / 3;
		$('#avgt3').val(avgt_3.toFixed(2));
		
		//4th
		var t_14 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_24 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_34 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t14').val(t_14);
		$('#t24').val(t_24);
		$('#t34').val(t_34);
		var t14 = $('#t14').val();
		var t24 = $('#t24').val();
		var t34 = $('#t34').val();
		
		var avgt_4 = ((+t14) + (+t24) +( +t34)) / 3;
		$('#avgt4').val(avgt_4.toFixed(2));
		
		//5th
		var t_15 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_25 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_35 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t15').val(t_15);
		$('#t25').val(t_25);
		$('#t35').val(t_35);
		var t15 = $('#t15').val();
		var t25 = $('#t25').val();
		var t35 = $('#t35').val();
		
		var avgt_5 = ((+t15) + (+t25) +( +t35)) / 3;
		$('#avgt5').val(avgt_5.toFixed(2));
		
		//6th
		var t_16 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_26 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_36 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t16').val(t_16);
		$('#t26').val(t_26);
		$('#t36').val(t_36);
		var t16 = $('#t16').val();
		var t26 = $('#t26').val();
		var t36 = $('#t36').val();
		
		var avgt_6 = ((+t16) + (+t26) +( +t36)) / 3;
		$('#avgt6').val(avgt_6.toFixed(2));
		
		//7th
		var t_17 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_27 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_37 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t17').val(t_17);
		$('#t27').val(t_27);
		$('#t37').val(t_37);
		var t17 = $('#t17').val();
		var t27 = $('#t27').val();
		var t37 = $('#t37').val();
		
		var avgt_7 = ((+t17) + (+t27) +( +t37)) / 3;
		$('#avgt7').val(avgt_7.toFixed(2));
		
		//8th
		var t_18 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_28 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var t_38 = (+thickNess) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		$('#t18').val(t_18);
		$('#t28').val(t_28);
		$('#t38').val(t_38);
		var t18 = $('#t18').val();
		var t28 = $('#t28').val();
		var t38 = $('#t38').val();
		
		var avgt_8 = ((+t18) + (+t28) +( +t38)) / 3;
		$('#avgt8').val(avgt_8.toFixed(2));
		
		//LENGTH
		var sp_len = $('#sp_len').val();
		
		//1st
		var f_11 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_21 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f11').val(f_11);
		$('#f21').val(f_21);		
		var f11 = $('#f11').val();
		var f21 = $('#f21').val();				
		var avgf_1 = ((+f11) + (+f21) ) / 2;
		$('#avgf1').val(avgf_1.toFixed(2));
		
		//2st
		var f_12 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_22 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f12').val(f_12);
		$('#f22').val(f_22);		
		var f12 = $('#f12').val();
		var f22 = $('#f22').val();				
		var avgf_2 = ((+f12) + (+f22) ) / 2;
		$('#avgf2').val(avgf_2.toFixed(2));
		
		//3st
		var f_13 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_23 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f13').val(f_13);
		$('#f23').val(f_23);		
		var f13 = $('#f13').val();
		var f23 = $('#f23').val();				
		var avgf_3 = ((+f13) + (+f23) ) / 2;
		$('#avgf3').val(avgf_3.toFixed(2));
		
		//4st
		var f_14 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_24 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f14').val(f_14);
		$('#f24').val(f_24);		
		var f14 = $('#f14').val();
		var f24 = $('#f24').val();				
		var avgf_4 = ((+f14) + (+f24) ) / 2;
		$('#avgf4').val(avgf_4.toFixed(2));
		
		//5st
		var f_15 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_25 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f15').val(f_15);
		$('#f25').val(f_25);		
		var f15 = $('#f15').val();
		var f25 = $('#f25').val();				
		var avgf_5 = ((+f15) + (+f25) ) / 2;
		$('#avgf5').val(avgf_5.toFixed(2));
		
		//6st
		var f_16 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_26 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f16').val(f_16);
		$('#f26').val(f_26);		
		var f16 = $('#f16').val();
		var f26 = $('#f26').val();				
		var avgf_6 = ((+f16) + (+f26) ) / 2;
		$('#avgf6').val(avgf_6.toFixed(2));
		
		//7st
		var f_17 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_27 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f17').val(f_17);
		$('#f27').val(f_27);		
		var f17 = $('#f17').val();
		var f27 = $('#f27').val();				
		var avgf_7 = ((+f17) + (+f27) ) / 2;
		$('#avgf7').val(avgf_7.toFixed(2));
		
		//8st
		var f_18 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));
		var f_28 = (+sp_len) + (+randomNumberFromRange(-2.00,2.00).toFixed(2));		
		$('#f18').val(f_18);
		$('#f28').val(f_28);		
		var f18 = $('#f18').val();
		var f28 = $('#f28').val();				
		var avgf_8 = ((+f18) + (+f28) ) / 2;
		$('#avgf8').val(avgf_8.toFixed(2));
		
		var avgt1 = $('#avgt1').val();
		var avgt2 = $('#avgt2').val();
		var avgt3 = $('#avgt3').val();
		var avgt4 = $('#avgt4').val();
		var avgt5 = $('#avgt5').val();
		var avgt6 = $('#avgt6').val();
		var avgt7 = $('#avgt7').val();
		var avgt8 = $('#avgt8').val();
		
		var avgf1 = $('#avgf1').val();
		var avgf2 = $('#avgf2').val();
		var avgf3 = $('#avgf3').val();
		var avgf4 = $('#avgf4').val();
		var avgf5 = $('#avgf5').val();
		var avgf6 = $('#avgf6').val();
		var avgf7 = $('#avgf7').val();
		var avgf8 = $('#avgf8').val();
		
		var farea_1 = (+avgt1) * (+avgf1);
		var farea_2 = (+avgt2) * (+avgf2);
		var farea_3 = (+avgt3) * (+avgf3);
		var farea_4 = (+avgt4) * (+avgf4);
		var farea_5 = (+avgt5) * (+avgf5);
		var farea_6 = (+avgt6) * (+avgf6);
		var farea_7 = (+avgt7) * (+avgf7);
		var farea_8 = (+avgt8) * (+avgf8);
		
		$('#farea1').val(farea_1.toFixed());
		$('#farea2').val(farea_2.toFixed());
		$('#farea3').val(farea_3.toFixed());
		$('#farea4').val(farea_4.toFixed());
		$('#farea5').val(farea_5.toFixed());
		$('#farea6').val(farea_6.toFixed());
		$('#farea7').val(farea_7.toFixed());
		$('#farea8').val(farea_8.toFixed());
				
			 var avg_ten = $('#avg_tensile').val();
			 var sd = randomNumberFromRange(1,9).toFixed();
			 if(sd%2==0)
			 {
				  var sten1 = (+avg_ten) + 0.08;
				  var sten3 = (+avg_ten) + 0.12;
				  var sten5 = (+avg_ten) + 0.03;
				  var sten7 = (+avg_ten) + 0.09;
				  var sten2 = (+avg_ten) - 0.06;
				  var sten4 = (+avg_ten) - 0.07;
				  var sten6 = (+avg_ten) - 0.14;
				  var sten8 = (+avg_ten) - 0.05;
			 }
			 else
			 {
				  var sten1 = (+avg_ten) - 0.08;
				  var sten3 = (+avg_ten) - 0.12;
				  var sten5 = (+avg_ten) - 0.03;
				  var sten7 = (+avg_ten) - 0.09;
				  var sten2 = (+avg_ten) + 0.06;
				  var sten4 = (+avg_ten) + 0.07;
				  var sten6 = (+avg_ten) + 0.14;
				  var sten8 = (+avg_ten) + 0.05;
			 }
			  $('#sten1').val(sten1.toFixed(2));
			  $('#sten2').val(sten2.toFixed(2));
			  $('#sten3').val(sten3.toFixed(2));
			  $('#sten4').val(sten4.toFixed(2));
			  $('#sten5').val(sten5.toFixed(2));
			  $('#sten6').val(sten6.toFixed(2));
			  $('#sten7').val(sten7.toFixed(2));
			  $('#sten8').val(sten8.toFixed(2));
			  
			  var farea1 = $('#farea1').val();
			  var farea2 = $('#farea2').val();
			  var farea3 = $('#farea3').val();
			  var farea4 = $('#farea4').val();
			  var farea5 = $('#farea5').val();
			  var farea6 = $('#farea6').val();
			  var farea7 = $('#farea7').val();
			  var farea8 = $('#farea8').val();
			  
			  var sten1 = $('#sten1').val();
			  var sten2 = $('#sten2').val();
			  var sten3 = $('#sten3').val();
			  var sten4 = $('#sten4').val();
			  var sten5 = $('#sten5').val();
			  var sten6 = $('#sten6').val();
			  var sten7 = $('#sten7').val();
			  var sten8 = $('#sten8').val();
			  
			  var spl_1 = (+sten1) * (+farea1); 
			  var spl_2 = (+sten2) * (+farea2); 
			  var spl_3 = (+sten3) * (+farea3); 
			  var spl_4 = (+sten4) * (+farea4); 
			  var spl_5 = (+sten5) * (+farea5); 
			  var spl_6 = (+sten6) * (+farea6); 
			  var spl_7 = (+sten7) * (+farea7); 
			  var spl_8 = (+sten8) * (+farea8);
			  
			  if(thickNess=="50")
			  {
				  var k = 0.79;
			  }
			  else if(thickNess=="60")
			  {
				  var k = 0.87;
			  }
			  else if(thickNess=="80")
			  {
				  var k = 1.00;
			  }
			  else if(thickNess=="100")
			  {
				  var k = 1.11;
			  }
			  else if(thickNess=="120")
			  {
				  var k = 1.19;
			  }

			 var splo_1 = (+0.637) * 1000 * (+k);
			 var splo_2 = (+0.637) * 1000 * (+k);
			 var splo_3 = (+0.637) * 1000 * (+k);
			 var splo_4 = (+0.637) * 1000 * (+k);
			 var splo_5 = (+0.637) * 1000 * (+k);
			 var splo_6 = (+0.637) * 1000 * (+k);
			 var splo_7 = (+0.637) * 1000 * (+k);
			 var splo_8 = (+0.637) * 1000 * (+k);
			 
			 var spload_1 = (+spl_1) / (+splo_1);
			 var spload_2 = (+spl_2) / (+splo_2);
			 var spload_3 = (+spl_3) / (+splo_3);
			 var spload_4 = (+spl_4) / (+splo_4);
			 var spload_5 = (+spl_5) / (+splo_5);
			 var spload_6 = (+spl_6) / (+splo_6);
			 var spload_7 = (+spl_7) / (+splo_7);
			 var spload_8 = (+spl_8) / (+splo_8);
			
			  $('#spload1').val(spload_1.toFixed(2));
			  $('#spload2').val(spload_2.toFixed(2));
			  $('#spload3').val(spload_3.toFixed(2));
			  $('#spload4').val(spload_4.toFixed(2));
			  $('#spload5').val(spload_5.toFixed(2));
			  $('#spload6').val(spload_6.toFixed(2));
			  $('#spload7').val(spload_7.toFixed(2));
			  $('#spload8').val(spload_8.toFixed(2));
			  
			  var spload1 = $('#spload1').val();
			  var spload2 = $('#spload2').val();
			  var spload3 = $('#spload3').val();
			  var spload4 = $('#spload4').val();
			  var spload5 = $('#spload5').val();
			  var spload6 = $('#spload6').val();
			  var spload7 = $('#spload7').val();
			  var spload8 = $('#spload8').val();
			  
			  var avgf1 = $('#avgf1').val();
			  var avgf2 = $('#avgf2').val();
			  var avgf3 = $('#avgf3').val();
			  var avgf4 = $('#avgf4').val();
			  var avgf5 = $('#avgf5').val();
			  var avgf6 = $('#avgf6').val();
			  var avgf7 = $('#avgf7').val();
			  var avgf8 = $('#avgf8').val();
			  
			  var f_load1 = ((+spload1) / (+1000)) * (+avgf1);
			  var f_load2 = ((+spload2) / (+1000)) * (+avgf2);
			  var f_load3 = ((+spload3) / (+1000)) * (+avgf3);
			  var f_load4 = ((+spload4) / (+1000)) * (+avgf4);
			  var f_load5 = ((+spload5) / (+1000)) * (+avgf5);
			  var f_load6 = ((+spload6) / (+1000)) * (+avgf6);
			  var f_load7 = ((+spload7) / (+1000)) * (+avgf7);
			  var f_load8 = ((+spload8) / (+1000)) * (+avgf8);
			  
			  $('#fload1').val(f_load1.toFixed(2));
			  $('#fload2').val(f_load2.toFixed(2));
			  $('#fload3').val(f_load3.toFixed(2));
			  $('#fload4').val(f_load4.toFixed(2));
			  $('#fload5').val(f_load5.toFixed(2));
			  $('#fload6').val(f_load6.toFixed(2));
			  $('#fload7').val(f_load7.toFixed(2));
			  $('#fload8').val(f_load8.toFixed(2));
			  
			  var fload1 = $('#fload1').val();
			  var fload2 = $('#fload2').val();
			  var fload3 = $('#fload3').val();
			  var fload4 = $('#fload4').val();
			  var fload5 = $('#fload5').val();
			  var fload6 = $('#fload6').val();
			  var fload7 = $('#fload7').val();
			  var fload8 = $('#fload8').val();
			  
			  var avg = ((+fload1) + (+fload2) + (+fload3) + (+fload4) + (+fload5) + (+fload6) + (+fload7) + (+fload8)) / 8;
			  $('#avg_load').val(avg.toFixed(2));
			 
			//sidhu
			  var cal1 = (+0.637) * (+k) * (+spload1) * (+1000);
			  var cal2 = (+0.637) * (+k) * (+spload2) * (+1000);
			  var cal3 = (+0.637) * (+k) * (+spload3) * (+1000);
			  var cal4 = (+0.637) * (+k) * (+spload4) * (+1000);
			  var cal5 = (+0.637) * (+k) * (+spload5) * (+1000);
			  var cal6 = (+0.637) * (+k) * (+spload6) * (+1000);
			  var cal7 = (+0.637) * (+k) * (+spload7) * (+1000);
			  var cal8 = (+0.637) * (+k) * (+spload8) * (+1000);
			  
			  var tensile1 = (+cal1) / (+farea1);
			  var tensile2 = (+cal2) / (+farea2);
			  var tensile3 = (+cal3) / (+farea3);
			  var tensile4 = (+cal4) / (+farea4);
			  var tensile5 = (+cal5) / (+farea5);
			  var tensile6 = (+cal6) / (+farea6);
			  var tensile7 = (+cal7) / (+farea7);
			  var tensile8 = (+cal8) / (+farea8);
			  
			  $('#sten1').val(tensile1.toFixed(2));
			  $('#sten2').val(tensile2.toFixed(2));
			  $('#sten3').val(tensile3.toFixed(2));
			  $('#sten4').val(tensile4.toFixed(2));
			  $('#sten5').val(tensile5.toFixed(2));
			  $('#sten6').val(tensile6.toFixed(2));
			  $('#sten7').val(tensile7.toFixed(2));
			  $('#sten8').val(tensile8.toFixed(2));
			  			 
			  
			  var ten_1 = $('#sten1').val();
			  var ten_2 = $('#sten2').val();
			  var ten_3 = $('#sten3').val();
			  var ten_4 = $('#sten4').val();
			  var ten_5 = $('#sten5').val();
			  var ten_6 = $('#sten6').val();
			  var ten_7 = $('#sten7').val();
			  var ten_8 = $('#sten8').val();
			  
			  var avg_ten = ((+ten_1) + (+ten_2) + (+ten_3) + (+ten_4) + (+ten_5) + (+ten_6) + (+ten_7) + (+ten_8)) / 8;
			  $('#avg_tensile').val(avg_ten.toFixed(2));
			  
			  
			  
			  
			
			
			
		
	});
	
	$('#t11,#t21,#t31,#t12,#t22,#t32,#t13,#t23,#t33,#t14,#t24,#t34,#t15,#t25,#t35,#t16,#t26,#t36,#t17,#t27,#t37,#t18,#t28,#t38,#f11,#f21,#f12,#f22,#f13,#f23,#f14,#f24,#f15,#f25,#f16,#f26,#f17,#f27,#f18,#f28,#spload1,#spload2,#spload3,#spload4,#spload5,#spload6,#spload7,#spload8,#farea1,#farea2,#farea3,#farea4,#farea5,#farea6,#farea7,#farea8').change(function(){
		thickNess_t();
	});
	
	function thickNess_t()
	{
	  var t11 = $('#t11').val();
	  var t21 = $('#t21').val();
	  var t31 = $('#t31').val();
	  var avgt_1 = ((+t11) + (+t21) +( +t31)) / 3;
	  $('#avgt1').val(avgt_1.toFixed(2));
	  
	  var t12 = $('#t12').val();
	  var t22 = $('#t22').val();
	  var t32 = $('#t32').val();
	  var avgt_2 = ((+t12) + (+t22) +( +t32)) / 3;
	  $('#avgt2').val(avgt_2.toFixed(2));
	  
	  var t13 = $('#t13').val();
	  var t23 = $('#t23').val();
	  var t33 = $('#t33').val();
	  var avgt_3 = ((+t13) + (+t23) +( +t33)) / 3;
	  $('#avgt3').val(avgt_3.toFixed(2));
	  
	  var t14 = $('#t14').val();
	  var t24 = $('#t24').val();
	  var t34 = $('#t34').val();
	  var avgt_4 = ((+t14) + (+t24) +( +t34)) / 3;
	  $('#avgt4').val(avgt_4.toFixed(2));
	  
	  var t15 = $('#t15').val();
	  var t25 = $('#t25').val();
	  var t35 = $('#t35').val();
	  var avgt_5 = ((+t15) + (+t25) +( +t35)) / 3;
	  $('#avgt5').val(avgt_5.toFixed(2));
	  
	  var t16 = $('#t16').val();
	  var t26 = $('#t26').val();
	  var t36 = $('#t36').val();
	  var avgt_6 = ((+t16) + (+t26) +(+t36)) / 3;
	  $('#avgt6').val(avgt_6.toFixed(2));
	  
	  var t17 = $('#t17').val();
	  var t27 = $('#t27').val();
	  var t37 = $('#t37').val();
	  var avgt_7 = ((+t17) + (+t27) +(+t37)) / 3;
	  $('#avgt7').val(avgt_7.toFixed(2));
	  
	  var t18 = $('#t18').val();
	  var t28 = $('#t28').val();
	  var t38 = $('#t38').val();
	  var avgt_8 = ((+t18) + (+t28) +(+t38)) / 3;
	  $('#avgt8').val(avgt_8.toFixed(2));
	  
	  
	  var f11 = $('#f11').val();
	  var f21 = $('#f21').val();
	 
	  var avgf_1 = ((+f11) + (+f21)) / 2;
	  $('#avgf1').val(avgf_1.toFixed(2));
	  
	  var f12 = $('#f12').val();
	  var f22 = $('#f22').val();
	 
	  var avgf_2 = ((+f12) + (+f22)) / 2;
	  $('#avgf2').val(avgf_2.toFixed(2));
	  
	  var f13 = $('#f13').val();
	  var f23 = $('#f23').val();
	 
	  var avgf_3 = ((+f13) + (+f23)) / 2;
	  $('#avgf3').val(avgf_3.toFixed(2));
	  
	  var f14 = $('#f14').val();
	  var f24 = $('#f24').val();
	  
	  var avgf_4 = ((+f14) + (+f24)) / 2;
	  $('#avgf4').val(avgf_4.toFixed(2));
	  
	  var f15 = $('#f15').val();
	  var f25 = $('#f25').val();
	  
	  var avgf_5 = ((+f15) + (+f25) ) / 2;
	  $('#avgf5').val(avgf_5.toFixed(2));
	  
	  var f16 = $('#f16').val();
	  var f26 = $('#f26').val();
	 
	  var avgf_6 = ((+f16) + (+f26)) / 2;
	  $('#avgf6').val(avgf_6.toFixed(2));
	  
	  var f17 = $('#f17').val();
	  var f27 = $('#f27').val();
	 
	  var avgf_7 = ((+f17) + (+f27) ) / 2;
	  $('#avgf7').val(avgf_7.toFixed(2));
	  
	  var f18 = $('#f18').val();
	  var f28 = $('#f28').val();
	 
	  var avgf_8 = ((+f18) + (+f28)) / 2;
	  $('#avgf8').val(avgf_8.toFixed(2));
	  
	  
	    var avgt1 = $('#avgt1').val();
		var avgt2 = $('#avgt2').val();
		var avgt3 = $('#avgt3').val();
		var avgt4 = $('#avgt4').val();
		var avgt5 = $('#avgt5').val();
		var avgt6 = $('#avgt6').val();
		var avgt7 = $('#avgt7').val();
		var avgt8 = $('#avgt8').val();
		
		var avgf1 = $('#avgf1').val();
		var avgf2 = $('#avgf2').val();
		var avgf3 = $('#avgf3').val();
		var avgf4 = $('#avgf4').val();
		var avgf5 = $('#avgf5').val();
		var avgf6 = $('#avgf6').val();
		var avgf7 = $('#avgf7').val();
		var avgf8 = $('#avgf8').val();
		
		var farea_1 = (+avgt1) * (+avgf1);
		var farea_2 = (+avgt2) * (+avgf2);
		var farea_3 = (+avgt3) * (+avgf3);
		var farea_4 = (+avgt4) * (+avgf4);
		var farea_5 = (+avgt5) * (+avgf5);
		var farea_6 = (+avgt6) * (+avgf6);
		var farea_7 = (+avgt7) * (+avgf7);
		var farea_8 = (+avgt8) * (+avgf8);
		
		$('#farea1').val(farea_1.toFixed());
		$('#farea2').val(farea_2.toFixed());
		$('#farea3').val(farea_3.toFixed());
		$('#farea4').val(farea_4.toFixed());
		$('#farea5').val(farea_5.toFixed());
		$('#farea6').val(farea_6.toFixed());
		$('#farea7').val(farea_7.toFixed());
		$('#farea8').val(farea_8.toFixed());
		
		var spload1 = $('#spload1').val();
		var spload2 = $('#spload2').val();
		var spload3 = $('#spload3').val();
		var spload4 = $('#spload4').val();
		var spload5 = $('#spload5').val();
		var spload6 = $('#spload6').val();
		var spload7 = $('#spload7').val();
		var spload8 = $('#spload8').val();
		
		var farea1 = $('#farea1').val();
		var farea2 = $('#farea2').val();
		var farea3 = $('#farea3').val();
		var farea4 = $('#farea4').val();
		var farea5 = $('#farea5').val();
		var farea6 = $('#farea6').val();
		var farea7 = $('#farea7').val();
		var farea8 = $('#farea8').val();
		
		if(thickNess=="50")
			  {
				  var k = 0.79;
			  }
			  else if(thickNess=="60")
			  {
				  var k = 0.87;
			  }
			  else if(thickNess=="80")
			  {
				  var k = 1.00;
			  }
			  else if(thickNess=="100")
			  {
				  var k = 1.11;
			  }
			  else if(thickNess=="120")
			  {
				  var k = 1.19;
			  }
	  
		
			//sidhu
			  var cal1 = (+0.637) * (+k) * (+spload1) * (+1000);
			  var cal2 = (+0.637) * (+k) * (+spload2) * (+1000);
			  var cal3 = (+0.637) * (+k) * (+spload3) * (+1000);
			  var cal4 = (+0.637) * (+k) * (+spload4) * (+1000);
			  var cal5 = (+0.637) * (+k) * (+spload5) * (+1000);
			  var cal6 = (+0.637) * (+k) * (+spload6) * (+1000);
			  var cal7 = (+0.637) * (+k) * (+spload7) * (+1000);
			  var cal8 = (+0.637) * (+k) * (+spload8) * (+1000);
			  
			  var tensile1 = (+cal1) / (+farea1);
			  var tensile2 = (+cal2) / (+farea2);
			  var tensile3 = (+cal3) / (+farea3);
			  var tensile4 = (+cal4) / (+farea4);
			  var tensile5 = (+cal5) / (+farea5);
			  var tensile6 = (+cal6) / (+farea6);
			  var tensile7 = (+cal7) / (+farea7);
			  var tensile8 = (+cal8) / (+farea8);
			  
			  $('#sten1').val(tensile1.toFixed(2));
			  $('#sten2').val(tensile2.toFixed(2));
			  $('#sten3').val(tensile3.toFixed(2));
			  $('#sten4').val(tensile4.toFixed(2));
			  $('#sten5').val(tensile5.toFixed(2));
			  $('#sten6').val(tensile6.toFixed(2));
			  $('#sten7').val(tensile7.toFixed(2));
			  $('#sten8').val(tensile8.toFixed(2));
			  			 
			  
			  var ten_1 = $('#sten1').val();
			  var ten_2 = $('#sten2').val();
			  var ten_3 = $('#sten3').val();
			  var ten_4 = $('#sten4').val();
			  var ten_5 = $('#sten5').val();
			  var ten_6 = $('#sten6').val();
			  var ten_7 = $('#sten7').val();
			  var ten_8 = $('#sten8').val();
			  
			  var avg_ten = ((+ten_1) + (+ten_2) + (+ten_3) + (+ten_4) + (+ten_5) + (+ten_6) + (+ten_7) + (+ten_8)) / 8;
			  $('#avg_tensile').val(avg_ten.toFixed(2));
			  
			  var f_load1 = ((+spload1) / (+1000)) * (+avgf1);
			  var f_load2 = ((+spload2) / (+1000)) * (+avgf2);
			  var f_load3 = ((+spload3) / (+1000)) * (+avgf3);
			  var f_load4 = ((+spload4) / (+1000)) * (+avgf4);
			  var f_load5 = ((+spload5) / (+1000)) * (+avgf5);
			  var f_load6 = ((+spload6) / (+1000)) * (+avgf6);
			  var f_load7 = ((+spload7) / (+1000)) * (+avgf7);
			  var f_load8 = ((+spload8) / (+1000)) * (+avgf8);
			  
			  $('#fload1').val(f_load1.toFixed(2));
			  $('#fload2').val(f_load2.toFixed(2));
			  $('#fload3').val(f_load3.toFixed(2));
			  $('#fload4').val(f_load4.toFixed(2));
			  $('#fload5').val(f_load5.toFixed(2));
			  $('#fload6').val(f_load6.toFixed(2));
			  $('#fload7').val(f_load7.toFixed(2));
			  $('#fload8').val(f_load8.toFixed(2));
			  
			  var fload1 = $('#fload1').val();
			  var fload2 = $('#fload2').val();
			  var fload3 = $('#fload3').val();
			  var fload4 = $('#fload4').val();
			  var fload5 = $('#fload5').val();
			  var fload6 = $('#fload6').val();
			  var fload7 = $('#fload7').val();
			  var fload8 = $('#fload8').val();
			  
			  var avg = ((+fload1) + (+fload2) + (+fload3) + (+fload4) + (+fload5) + (+fload6) + (+fload7) + (+fload8)) / 8;
			  $('#avg_load').val(avg.toFixed(2));
	  
	}
	
	$('#chk_ten').change(function(){
        if(this.checked)
		{
			check_ten();
			
		}	
		else
		{
			$('#sm15').val(null);
			$('#sm16').val(null);
			$('#sm17').val(null);
			$('#sm18').val(null);
			$('#sm19').val(null);
			$('#sm20').val(null);
			$('#sm21').val(null);
			$('#sm22').val(null);
			
			
			$('#t11').val(null);
			$('#t12').val(null);
			$('#t13').val(null);
			$('#t14').val(null);
			$('#t15').val(null);
			$('#t16').val(null);
			$('#t17').val(null);
			$('#t18').val(null);
			$('#t21').val(null);
			$('#t22').val(null);
			$('#t23').val(null);
			$('#t24').val(null);
			$('#t25').val(null);
			$('#t26').val(null);
			$('#t27').val(null);
			$('#t28').val(null);
			$('#t31').val(null);
			$('#t32').val(null);
			$('#t33').val(null);
			$('#t34').val(null);
			$('#t35').val(null);
			$('#t36').val(null);
			$('#t37').val(null);
			$('#t38').val(null);
			$('#avgt1').val(null);
			$('#avgt2').val(null);
			$('#avgt3').val(null);
			$('#avgt4').val(null);
			$('#avgt5').val(null);
			$('#avgt6').val(null);
			$('#avgt7').val(null);
			$('#avgt8').val(null);
			$('#f11').val(null);
			$('#f12').val(null);
			$('#f13').val(null);
			$('#f14').val(null);
			$('#f15').val(null);
			$('#f16').val(null);
			$('#f17').val(null);
			$('#f18').val(null);
			$('#f21').val(null);
			$('#f22').val(null);
			$('#f23').val(null);
			$('#f24').val(null);
			$('#f25').val(null);
			$('#f26').val(null);
			$('#f27').val(null);
			$('#f28').val(null);
			
			$('#avgf1').val(null);
			$('#avgf2').val(null);
			$('#avgf3').val(null);
			$('#avgf4').val(null);
			$('#avgf5').val(null);
			$('#avgf6').val(null);
			$('#avgf7').val(null);
			$('#avgf8').val(null);
			
			$('#farea1').val(null);
			$('#farea2').val(null);
			$('#farea3').val(null);
			$('#farea4').val(null);
			$('#farea5').val(null);
			$('#farea6').val(null);
			$('#farea7').val(null);
			$('#farea8').val(null);
			$('#spload1').val(null);
			$('#spload2').val(null);
			$('#spload3').val(null);
			$('#spload4').val(null);
			$('#spload5').val(null);
			$('#spload6').val(null);
			$('#spload7').val(null);
			$('#spload8').val(null);
			$('#sten1').val(null);
			$('#sten2').val(null);
			$('#sten3').val(null);
			$('#sten4').val(null);
			$('#sten5').val(null);
			$('#sten6').val(null);
			$('#sten7').val(null);
			$('#sten8').val(null);
			$('#fload1').val(null);
			$('#fload2').val(null);
			$('#fload3').val(null);
			$('#fload4').val(null);
			$('#fload5').val(null);
			$('#fload6').val(null);
			$('#fload7').val(null);
			$('#fload8').val(null);
			
			
			$('#avg_tensile').val(null);
			$('#avg_load').val(null);
			
			
			
			
		}
	});
	
	function check_abr()
	{
			$('#sm9').val("PB/9");
			$('#sm10').val("PB/10");
			$('#sm11').val("PB/11");
			$('#sm12').val("PB/12");
			$('#sm13').val("PB/13");
			$('#sm14').val("PB/14");
			var l1 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var l2 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var l3 = randomNumberFromRange(70.80,71.30).toFixed(2);
			
			var l4 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var l5 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var l6 = randomNumberFromRange(70.80,71.30).toFixed(2);
			
			var w1 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var w2 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var w3 = randomNumberFromRange(70.80,71.30).toFixed(2);
			
			var w4 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var w5 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var w6 = randomNumberFromRange(70.80,71.30).toFixed(2);
			$('#l1').val(l1);
			$('#l2').val(l2);
			$('#l3').val(l3);
			$('#l4').val(l4);
			$('#l5').val(l5);
			$('#l6').val(l6);
			
			$('#w1').val(w1);
			$('#w2').val(w2);
			$('#w3').val(w3);
			$('#w4').val(w4);
			$('#w5').val(w5);
			$('#w6').val(w6);
			var l_1 = $('#l1').val();
			var l_2 = $('#l2').val();
			var l_3 = $('#l3').val();
			var l_4 = $('#l4').val();
			var l_5 = $('#l5').val();
			var l_6 = $('#l6').val();
			var w_1 = $('#w1').val();
			var w_2 = $('#w2').val();
			var w_3 = $('#w3').val();
			var w_4 = $('#w4').val();
			var w_5 = $('#w5').val();
			var w_6 = $('#w6').val();
			
			var thickNess = $('#top_thickNess').val();
			
			var im_1 = (+l_1) * (+w_1) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			var im_2 = (+l_2) * (+w_2) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			var im_3 = (+l_3) * (+w_3) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			var im_4 = (+l_4) * (+w_4) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			var im_5 = (+l_5) * (+w_5) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			var im_6 = (+l_6) * (+w_6) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			
			$('#im1').val(im_1.toFixed(2));
			$('#im2').val(im_2.toFixed(2));
			$('#im3').val(im_3.toFixed(2));
			$('#im4').val(im_4.toFixed(2));
			$('#im5').val(im_5.toFixed(2));
			$('#im6').val(im_6.toFixed(2));
			
			var avgv1 = randomNumberFromRange(4200,6800);
			$('#avgv').val(avgv1.toFixed());
			var avg1 = $('#avgv').val();
			
			var avg12 = (+avg1) + (+randomNumberFromRange(600,1200).toFixed());
			$('#avgv2').val(avg12.toFixed());
			var avg2 = $('#avgv2').val();
			
			var yu = randomNumberFromRange(0,99).toFixed();
			if(yu%2==0)
			{
				var v1 = (+avg1) - 82;
				var v2 = (+avg1) + 161;
				var v3 = (+avg1) - 79;
				
				var v4 = (+avg2) + 74;
				var v5 = (+avg2) - 157;
				var v6 = (+avg2) + 83;
			}
			else
			{
				var v4 = (+avg2) - 82;
				var v5 = (+avg2) + 161;
				var v6 = (+avg2) - 79;
				
				var v1 = (+avg1) + 74;
				var v2 = (+avg1) - 157;
				var v3 = (+avg1) + 83;
			}
			$('#v1').val(v1.toFixed());
			$('#v2').val(v2.toFixed());
			$('#v3').val(v3.toFixed());
			$('#v4').val(v4.toFixed());
			$('#v5').val(v5.toFixed());
			$('#v6').val(v6.toFixed());
			
			var v_1 = $('#v1').val();
			var v_2 = $('#v2').val();
			var v_3 = $('#v3').val();
			var v_4 = $('#v4').val();
			var v_5 = $('#v5').val();
			var v_6 = $('#v6').val();
			
			var im_1= $('#im1').val();
			var im_2= $('#im2').val();
			var im_3= $('#im3').val();
			var im_4= $('#im4').val();
			var im_5= $('#im5').val();
			var im_6= $('#im6').val();
			
			var prte1 = (+l_1) * (+w_1) * (+thickNess);
			var prte2 = (+l_2) * (+w_2) * (+thickNess);
			var prte3 = (+l_3) * (+w_3) * (+thickNess);
			var prte4 = (+l_4) * (+w_4) * (+thickNess);
			var prte5 = (+l_5) * (+w_5) * (+thickNess);
			var prte6 = (+l_6) * (+w_6) * (+thickNess);
			
			var pr1 = (+im_1) / (+prte1);
			var pr2 = (+im_2) / (+prte2);
			var pr3 = (+im_3) / (+prte3);
			var pr4 = (+im_4) / (+prte4);
			var pr5 = (+im_5) / (+prte5);
			var pr6 = (+im_6) / (+prte6);
			
			$('#pr1').val(pr1.toFixed(5));
			$('#pr2').val(pr2.toFixed(5));
			$('#pr3').val(pr3.toFixed(5));
			$('#pr4').val(pr4.toFixed(5));
			$('#pr5').val(pr5.toFixed(5));
			$('#pr6').val(pr6.toFixed(5));
			
			var p1 = $('#pr1').val();
			var p2 = $('#pr2').val();
			var p3 = $('#pr3').val();
			var p4 = $('#pr4').val();
			var p5 = $('#pr5').val();
			var p6 = $('#pr6').val();
			
			var lm1 = (+p1) * (+v_1);
			var lm2 = (+p2) * (+v_2);
			var lm3 = (+p3) * (+v_3);
			var lm4 = (+p4) * (+v_4);
			var lm5 = (+p5) * (+v_5);
			var lm6 = (+p6) * (+v_6);
			
			$('#lm1').val(lm1.toFixed(2));
			$('#lm2').val(lm2.toFixed(2));
			$('#lm3').val(lm3.toFixed(2));
			$('#lm4').val(lm4.toFixed(2));
			$('#lm5').val(lm5.toFixed(2));
			$('#lm6').val(lm6.toFixed(2));
			
			var lm_1 = $('#lm1').val();
			var lm_2 = $('#lm2').val();
			var lm_3 = $('#lm3').val();
			var lm_4 = $('#lm4').val();
			var lm_5 = $('#lm5').val();
			var lm_6 = $('#lm6').val();
			
			var im_1 = $('#im1').val();
			var im_2 = $('#im2').val();
			var im_3 = $('#im3').val();
			var im_4 = $('#im4').val();
			var im_5 = $('#im5').val();
			var im_6 = $('#im6').val();
			
			var om_1 = (+im_1) - (+lm_1);
			var om_2 = (+im_2) - (+lm_2);
			var om_3 = (+im_3) - (+lm_3);
			var om_4 = (+im_4) - (+lm_4);
			var om_5 = (+im_5) - (+lm_5);
			var om_6 = (+im_6) - (+lm_6);
			
			$('#om1').val(om_1.toFixed(2));
			$('#om2').val(om_2.toFixed(2));
			$('#om3').val(om_3.toFixed(2));
			$('#om4').val(om_4.toFixed(2));
			$('#om5').val(om_5.toFixed(2));
			$('#om6').val(om_6.toFixed(2));
			
			var l_m1 = (+im_1) - (+om_1);
			var l_m2 = (+im_2) - (+om_2);
			var l_m3 = (+im_3) - (+om_3);
			var l_m4 = (+im_4) - (+om_4);
			var l_m5 = (+im_5) - (+om_5);
			var l_m6 = (+im_6) - (+om_6);
			
			
			
			$('#lm1').val(l_m1.toFixed(2));
			$('#lm2').val(l_m2.toFixed(2));
			$('#lm3').val(l_m3.toFixed(2));
			$('#lm4').val(l_m4.toFixed(2));
			$('#lm5').val(l_m5.toFixed(2));
			$('#lm6').val(l_m6.toFixed(2));
			
			var tm1 = (+l_1) * (+w_1) * (+thickNess);
			var tm2 = (+l_2) * (+w_2) * (+thickNess);
			var tm3 = (+l_3) * (+w_3) * (+thickNess);
			var tm4 = (+l_4) * (+w_4) * (+thickNess);
			var tm5 = (+l_5) * (+w_5) * (+thickNess);
			var tm6 = (+l_6) * (+w_6) * (+thickNess);
			
			var p_r1 = (+im_1) / (+tm1);
			var p_r2 = (+im_2) / (+tm2);
			var p_r3 = (+im_3) / (+tm3);
			var p_r4 = (+im_4) / (+tm4);
			var p_r5 = (+im_5) / (+tm5);
			var p_r6 = (+im_6) / (+tm6);
			
			$('#pr1').val(p_r1.toFixed(5));
			$('#pr2').val(p_r2.toFixed(5));
			$('#pr3').val(p_r3.toFixed(5));
			$('#pr4').val(p_r4.toFixed(5));
			$('#pr5').val(p_r5.toFixed(5));
			$('#pr6').val(p_r6.toFixed(5));
			
			var pp1 = $('#pr1').val();
			var pp2 = $('#pr2').val();
			var pp3 = $('#pr3').val();
			var pp4 = $('#pr4').val();
			var pp5 = $('#pr5').val();
			var pp6 = $('#pr6').val();
			
			var lm_1 = $('#lm1').val();
			var lm_2 = $('#lm2').val();
			var lm_3 = $('#lm3').val();
			var lm_4 = $('#lm4').val();
			var lm_5 = $('#lm5').val();
			var lm_6 = $('#lm6').val();
			
			var v_1 = (+lm_1) / (+pp1);
			var v_2 = (+lm_2) / (+pp2);
			var v_3 = (+lm_3) / (+pp3);
			var v_4 = (+lm_4) / (+pp4);
			var v_5 = (+lm_5) / (+pp5);
			var v_6 = (+lm_6) / (+pp6);
			
			$('#v1').val(v_1.toFixed());
			$('#v2').val(v_2.toFixed());
			$('#v3').val(v_3.toFixed());
			$('#v4').val(v_4.toFixed());
			$('#v5').val(v_5.toFixed());
			$('#v6').val(v_6.toFixed());
			
			var v__1 = $('#v1').val();
			var v__2 = $('#v2').val();
			var v__3 = $('#v3').val();
			var v__4 = $('#v4').val();
			var v__5 = $('#v5').val();
			var v__6 = $('#v6').val();
			
			var ans = ((+v__1) + (+v__2) + (+v__3))/3;
			$('#avgv').val(ans.toFixed());
			
			
			var ans1 = ((+v__4) + (+v__5) + (+v__6))/3;
			$('#avgv2').val(ans1.toFixed());
			
	}
	
	
	$('#chk_abr').change(function(){
        if(this.checked)
		{
			check_abr();
			
		}	
		else
		{
			$('#sm9').val(null);
			$('#sm10').val(null);
			$('#sm11').val(null);
			$('#sm12').val(null);
			$('#sm13').val(null);
			$('#sm14').val(null);
			$('#sm9').val(null);
			$('#sm10').val(null);
			$('#sm11').val(null);
			$('#sm12').val(null);
			$('#sm13').val(null);
			$('#sm14').val(null);
			
			
			$('#l1').val(null);
			$('#l2').val(null);
			$('#l3').val(null);
			$('#l4').val(null);
			$('#l5').val(null);
			$('#l6').val(null);
			$('#w1').val(null);
			$('#w2').val(null);
			$('#w3').val(null);
			$('#w4').val(null);
			$('#w5').val(null);
			$('#w6').val(null);
			$('#im1').val(null);
			$('#im2').val(null);
			$('#im3').val(null);
			$('#im4').val(null);
			$('#im5').val(null);
			$('#im6').val(null);
			$('#om1').val(null);
			$('#om2').val(null);
			$('#om3').val(null);
			$('#om4').val(null);
			$('#om5').val(null);
			$('#om6').val(null);
			$('#lm1').val(null);
			$('#lm2').val(null);
			$('#lm3').val(null);
			$('#lm4').val(null);
			$('#lm5').val(null);
			$('#lm6').val(null);
			$('#pr1').val(null);
			$('#pr2').val(null);
			$('#pr3').val(null);
			$('#pr4').val(null);
			$('#pr5').val(null);
			$('#pr6').val(null);
			$('#v1').val(null);
			$('#v2').val(null);
			$('#v3').val(null);
			$('#v4').val(null);
			$('#v5').val(null);
			$('#v6').val(null);
			
			$('#avgv').val(null);
			$('#avgv2').val(null);
			
			
			
		}
	});
	
	$("#l1,#l2,#l3,#l4,#l5,#l6,#w1,#w2,#w3,#w4,#w5,#w6,#im1,#im2,#im3,#im4,#im5,#im6,#om1,#om2,#om3,#om4,#om5,#om6").change(function(){
		lm_data();	       						
    });
	
	
	
	$("#avgv,#avgv2").change(function(){
		
		 $('#txtabr').css("background-color","var(--success)"); 
		if ($("#chk_abr").is(':checked')) {
			var avg1 = $('#avgv').val();
			var avg2 = $('#avgv2').val();
			var l1 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var l2 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var l3 = randomNumberFromRange(70.80,71.30).toFixed(2);
			
			var l4 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var l5 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var l6 = randomNumberFromRange(70.80,71.30).toFixed(2);
			
			var w1 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var w2 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var w3 = randomNumberFromRange(70.80,71.30).toFixed(2);
			
			var w4 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var w5 = randomNumberFromRange(70.80,71.30).toFixed(2);
			var w6 = randomNumberFromRange(70.80,71.30).toFixed(2);
			$('#l1').val(l1);
			$('#l2').val(l2);
			$('#l3').val(l3);
			$('#l4').val(l4);
			$('#l5').val(l5);
			$('#l6').val(l6);
			
			$('#w1').val(w1);
			$('#w2').val(w2);
			$('#w3').val(w3);
			$('#w4').val(w4);
			$('#w5').val(w5);
			$('#w6').val(w6);
			var l_1 = $('#l1').val();
			var l_2 = $('#l2').val();
			var l_3 = $('#l3').val();
			var l_4 = $('#l4').val();
			var l_5 = $('#l5').val();
			var l_6 = $('#l6').val();
			var w_1 = $('#w1').val();
			var w_2 = $('#w2').val();
			var w_3 = $('#w3').val();
			var w_4 = $('#w4').val();
			var w_5 = $('#w5').val();
			var w_6 = $('#w6').val();
			
			var thickNess = $('#top_thickNess').val();
			
			var im_1 = (+l_1) * (+w_1) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			var im_2 = (+l_2) * (+w_2) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			var im_3 = (+l_3) * (+w_3) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			var im_4 = (+l_4) * (+w_4) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			var im_5 = (+l_5) * (+w_5) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			var im_6 = (+l_6) * (+w_6) * (+thickNess) * randomNumberFromRange(0.00255,0.00275).toFixed(5);
			
			$('#im1').val(im_1.toFixed(2));
			$('#im2').val(im_2.toFixed(2));
			$('#im3').val(im_3.toFixed(2));
			$('#im4').val(im_4.toFixed(2));
			$('#im5').val(im_5.toFixed(2));
			$('#im6').val(im_6.toFixed(2));
			
			
			
			var yu = randomNumberFromRange(0,99).toFixed();
			if(yu%2==0)
			{
				var v1 = (+avg1) - 82;
				var v2 = (+avg1) + 161;
				var v3 = (+avg1) - 79;
				
				var v4 = (+avg2) + 74;
				var v5 = (+avg2) - 157;
				var v6 = (+avg2) + 83;
			}
			else
			{
				var v4 = (+avg2) - 82;
				var v5 = (+avg2) + 161;
				var v6 = (+avg2) - 79;
				
				var v1 = (+avg1) + 74;
				var v2 = (+avg1) - 157;
				var v3 = (+avg1) + 83;
			}
			$('#v1').val(v1.toFixed());
			$('#v2').val(v2.toFixed());
			$('#v3').val(v3.toFixed());
			$('#v4').val(v4.toFixed());
			$('#v5').val(v5.toFixed());
			$('#v6').val(v6.toFixed());
			
			var v_1 = $('#v1').val();
			var v_2 = $('#v2').val();
			var v_3 = $('#v3').val();
			var v_4 = $('#v4').val();
			var v_5 = $('#v5').val();
			var v_6 = $('#v6').val();
			
			var im_1= $('#im1').val();
			var im_2= $('#im2').val();
			var im_3= $('#im3').val();
			var im_4= $('#im4').val();
			var im_5= $('#im5').val();
			var im_6= $('#im6').val();
			
			var prte1 = (+l_1) * (+w_1) * (+thickNess);
			var prte2 = (+l_2) * (+w_2) * (+thickNess);
			var prte3 = (+l_3) * (+w_3) * (+thickNess);
			var prte4 = (+l_4) * (+w_4) * (+thickNess);
			var prte5 = (+l_5) * (+w_5) * (+thickNess);
			var prte6 = (+l_6) * (+w_6) * (+thickNess);
			
			var pr1 = (+im_1) / (+prte1);
			var pr2 = (+im_2) / (+prte2);
			var pr3 = (+im_3) / (+prte3);
			var pr4 = (+im_4) / (+prte4);
			var pr5 = (+im_5) / (+prte5);
			var pr6 = (+im_6) / (+prte6);
			
			$('#pr1').val(pr1.toFixed(5));
			$('#pr2').val(pr2.toFixed(5));
			$('#pr3').val(pr3.toFixed(5));
			$('#pr4').val(pr4.toFixed(5));
			$('#pr5').val(pr5.toFixed(5));
			$('#pr6').val(pr6.toFixed(5));
			
			var p1 = $('#pr1').val();
			var p2 = $('#pr2').val();
			var p3 = $('#pr3').val();
			var p4 = $('#pr4').val();
			var p5 = $('#pr5').val();
			var p6 = $('#pr6').val();
			
			var lm1 = (+p1) * (+v_1);
			var lm2 = (+p2) * (+v_2);
			var lm3 = (+p3) * (+v_3);
			var lm4 = (+p4) * (+v_4);
			var lm5 = (+p5) * (+v_5);
			var lm6 = (+p6) * (+v_6);
			
			$('#lm1').val(lm1.toFixed(2));
			$('#lm2').val(lm2.toFixed(2));
			$('#lm3').val(lm3.toFixed(2));
			$('#lm4').val(lm4.toFixed(2));
			$('#lm5').val(lm5.toFixed(2));
			$('#lm6').val(lm6.toFixed(2));
			
			var lm_1 = $('#lm1').val();
			var lm_2 = $('#lm2').val();
			var lm_3 = $('#lm3').val();
			var lm_4 = $('#lm4').val();
			var lm_5 = $('#lm5').val();
			var lm_6 = $('#lm6').val();
			
			var im_1 = $('#im1').val();
			var im_2 = $('#im2').val();
			var im_3 = $('#im3').val();
			var im_4 = $('#im4').val();
			var im_5 = $('#im5').val();
			var im_6 = $('#im6').val();
			
			var om_1 = (+im_1) - (+lm_1);
			var om_2 = (+im_2) - (+lm_2);
			var om_3 = (+im_3) - (+lm_3);
			var om_4 = (+im_4) - (+lm_4);
			var om_5 = (+im_5) - (+lm_5);
			var om_6 = (+im_6) - (+lm_6);
			
			$('#om1').val(om_1.toFixed(2));
			$('#om2').val(om_2.toFixed(2));
			$('#om3').val(om_3.toFixed(2));
			$('#om4').val(om_4.toFixed(2));
			$('#om5').val(om_5.toFixed(2));
			$('#om6').val(om_6.toFixed(2));
			
			var l_m1 = (+im_1) - (+om_1);
			var l_m2 = (+im_2) - (+om_2);
			var l_m3 = (+im_3) - (+om_3);
			var l_m4 = (+im_4) - (+om_4);
			var l_m5 = (+im_5) - (+om_5);
			var l_m6 = (+im_6) - (+om_6);
			
			
			
			$('#lm1').val(l_m1.toFixed(2));
			$('#lm2').val(l_m2.toFixed(2));
			$('#lm3').val(l_m3.toFixed(2));
			$('#lm4').val(l_m4.toFixed(2));
			$('#lm5').val(l_m5.toFixed(2));
			$('#lm6').val(l_m6.toFixed(2));
			
			var tm1 = (+l_1) * (+w_1) * (+thickNess);
			var tm2 = (+l_2) * (+w_2) * (+thickNess);
			var tm3 = (+l_3) * (+w_3) * (+thickNess);
			var tm4 = (+l_4) * (+w_4) * (+thickNess);
			var tm5 = (+l_5) * (+w_5) * (+thickNess);
			var tm6 = (+l_6) * (+w_6) * (+thickNess);
			
			var p_r1 = (+im_1) / (+tm1);
			var p_r2 = (+im_2) / (+tm2);
			var p_r3 = (+im_3) / (+tm3);
			var p_r4 = (+im_4) / (+tm4);
			var p_r5 = (+im_5) / (+tm5);
			var p_r6 = (+im_6) / (+tm6);
			
			$('#pr1').val(p_r1.toFixed(5));
			$('#pr2').val(p_r2.toFixed(5));
			$('#pr3').val(p_r3.toFixed(5));
			$('#pr4').val(p_r4.toFixed(5));
			$('#pr5').val(p_r5.toFixed(5));
			$('#pr6').val(p_r6.toFixed(5));
			
			var pp1 = $('#pr1').val();
			var pp2 = $('#pr2').val();
			var pp3 = $('#pr3').val();
			var pp4 = $('#pr4').val();
			var pp5 = $('#pr5').val();
			var pp6 = $('#pr6').val();
			
			var lm_1 = $('#lm1').val();
			var lm_2 = $('#lm2').val();
			var lm_3 = $('#lm3').val();
			var lm_4 = $('#lm4').val();
			var lm_5 = $('#lm5').val();
			var lm_6 = $('#lm6').val();
			
			var v_1 = (+lm_1) / (+pp1);
			var v_2 = (+lm_2) / (+pp2);
			var v_3 = (+lm_3) / (+pp3);
			var v_4 = (+lm_4) / (+pp4);
			var v_5 = (+lm_5) / (+pp5);
			var v_6 = (+lm_6) / (+pp6);
			
			$('#v1').val(v_1.toFixed());
			$('#v2').val(v_2.toFixed());
			$('#v3').val(v_3.toFixed());
			$('#v4').val(v_4.toFixed());
			$('#v5').val(v_5.toFixed());
			$('#v6').val(v_6.toFixed());
			
			var v__1 = $('#v1').val();
			var v__2 = $('#v2').val();
			var v__3 = $('#v3').val();
			var v__4 = $('#v4').val();
			var v__5 = $('#v5').val();
			var v__6 = $('#v6').val();
			
			var ans = ((+v__1) + (+v__2) + (+v__3))/3;
			$('#avgv').val(ans.toFixed());
			
			
			var ans1 = ((+v__4) + (+v__5) + (+v__6))/3;
			$('#avgv2').val(ans1.toFixed());
			
			
			
			
		}			
    });
	
	
	
	function lm_data()
	{
		 $('#txtabr').css("background-color","var(--success)"); 
		 var l_1 = $('#l1').val();
			var l_2 = $('#l2').val();
			var l_3 = $('#l3').val();
			var l_4 = $('#l4').val();
			var l_5 = $('#l5').val();
			var l_6 = $('#l6').val();
			var w_1 = $('#w1').val();
			var w_2 = $('#w2').val();
			var w_3 = $('#w3').val();
			var w_4 = $('#w4').val();
			var w_5 = $('#w5').val();
			var w_6 = $('#w6').val();
			
			var thickNess = $('#top_thickNess').val();
			
			
			var im_1 = $('#im1').val();
			var im_2 = $('#im2').val();
			var im_3 = $('#im3').val();
			var im_4 = $('#im4').val();
			var im_5 = $('#im5').val();
			var im_6 = $('#im6').val();
			
			var om_1 = $('#om1').val();
			var om_2 = $('#om2').val();
			var om_3 = $('#om3').val();
			var om_4 = $('#om4').val();
			var om_5 = $('#om5').val();
			var om_6 = $('#om6').val();
			
			
			
			
			
			
			
			
			var l_m1 = (+im_1) - (+om_1);
			var l_m2 = (+im_2) - (+om_2);
			var l_m3 = (+im_3) - (+om_3);
			var l_m4 = (+im_4) - (+om_4);
			var l_m5 = (+im_5) - (+om_5);
			var l_m6 = (+im_6) - (+om_6);
			
			
			
			$('#lm1').val(l_m1.toFixed(2));
			$('#lm2').val(l_m2.toFixed(2));
			$('#lm3').val(l_m3.toFixed(2));
			$('#lm4').val(l_m4.toFixed(2));
			$('#lm5').val(l_m5.toFixed(2));
			$('#lm6').val(l_m6.toFixed(2));
			
			var tm1 = (+l_1) * (+w_1) * (+thickNess);
			var tm2 = (+l_2) * (+w_2) * (+thickNess);
			var tm3 = (+l_3) * (+w_3) * (+thickNess);
			var tm4 = (+l_4) * (+w_4) * (+thickNess);
			var tm5 = (+l_5) * (+w_5) * (+thickNess);
			var tm6 = (+l_6) * (+w_6) * (+thickNess);
			
			var p_r1 = (+im_1) / (+tm1);
			var p_r2 = (+im_2) / (+tm2);
			var p_r3 = (+im_3) / (+tm3);
			var p_r4 = (+im_4) / (+tm4);
			var p_r5 = (+im_5) / (+tm5);
			var p_r6 = (+im_6) / (+tm6);
			
			$('#pr1').val(p_r1.toFixed(5));
			$('#pr2').val(p_r2.toFixed(5));
			$('#pr3').val(p_r3.toFixed(5));
			$('#pr4').val(p_r4.toFixed(5));
			$('#pr5').val(p_r5.toFixed(5));
			$('#pr6').val(p_r6.toFixed(5));
			
			var pp1 = $('#pr1').val();
			var pp2 = $('#pr2').val();
			var pp3 = $('#pr3').val();
			var pp4 = $('#pr4').val();
			var pp5 = $('#pr5').val();
			var pp6 = $('#pr6').val();
			
			var lm_1 = $('#lm1').val();
			var lm_2 = $('#lm2').val();
			var lm_3 = $('#lm3').val();
			var lm_4 = $('#lm4').val();
			var lm_5 = $('#lm5').val();
			var lm_6 = $('#lm6').val();
			
			var v_1 = (+lm_1) / (+pp1);
			var v_2 = (+lm_2) / (+pp2);
			var v_3 = (+lm_3) / (+pp3);
			var v_4 = (+lm_4) / (+pp4);
			var v_5 = (+lm_5) / (+pp5);
			var v_6 = (+lm_6) / (+pp6);
			
			$('#v1').val(v_1.toFixed());
			$('#v2').val(v_2.toFixed());
			$('#v3').val(v_3.toFixed());
			$('#v4').val(v_4.toFixed());
			$('#v5').val(v_5.toFixed());
			$('#v6').val(v_6.toFixed());
			
			var v__1 = $('#v1').val();
			var v__2 = $('#v2').val();
			var v__3 = $('#v3').val();
			var v__4 = $('#v4').val();
			var v__5 = $('#v5').val();
			var v__6 = $('#v6').val();
			
			var ans = ((+v__1) + (+v__2) + (+v__3))/3;
			$('#avgv').val(ans.toFixed());
			
			
			var ans1 = ((+v__4) + (+v__5) + (+v__6))/3;
			$('#avgv2').val(ans1.toFixed());
	}
	
	
	
	function check_wtr()
	{
		var thickNess  = $('#top_thickNess').val();
			if(thickNess=="60")
			 {
					var rnad = randomNumberFromRange(0,100).toFixed();
					if(rnad%2==0)
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_1 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						 wtr_w2_2 = (+wtr_w2_1) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_3 = (+wtr_w2_2) + (+randomNumberFromRange(-70,70).toFixed());
					}
					else
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_3 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						 
						 wtr_w2_1 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_2 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
					}
					
			 }
			 else if(thickNess=="80")
			 {
					var rnad = randomNumberFromRange(0,100).toFixed();
					if(rnad%2==0)
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_1 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						
						 wtr_w2_2 = (+wtr_w2_1) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_3 = (+wtr_w2_1) + (+randomNumberFromRange(-70,70).toFixed());
					}
					else
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_3 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						 
						 wtr_w2_1 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_2 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
					}
					
			 }
			 else
			 {
				  var rnad = randomNumberFromRange(0,100).toFixed();
					if(rnad%2==0)
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_1 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						
						 wtr_w2_2 = (+wtr_w2_1) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_3 = (+wtr_w2_1) + (+randomNumberFromRange(-70,70).toFixed());
					}
					else
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_3 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						 
						 wtr_w2_1 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_2 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
					}
			 }
			
			
			$('#wtr_w2_1').val(wtr_w2_1);
			$('#wtr_w2_2').val(wtr_w2_2);
			$('#wtr_w2_3').val(wtr_w2_3);
			
			avg_wtr1 = randomNumberFromRange(4.70,5.50).toFixed(2);
			$('#avg_wtr').val(avg_wtr1);		
			var avgwtr1 = $('#avg_wtr').val();		
			
			var ss = randomNumberFromRange(0,9).toFixed();
			if(ss==0)
			{
				wtr_1 = (+avgwtr1) - 0.32;
				wtr_2 = (+avgwtr1) + 0.44;
				wtr_3 = (+avgwtr1) - 0.12;
			}
			else if(ss%2==0)
			{
				wtr_1 = (+avgwtr1) + 0.48;
				wtr_2 = (+avgwtr1) - 0.22;
				wtr_3 = (+avgwtr1) - 0.26;
			}
			else
			{
				wtr_1 = (+avgwtr1) - 0.40;
				wtr_2 = (+avgwtr1) + 0.18;
				wtr_3 = (+avgwtr1) + 0.22;
			}
			

			$('#wtr_1').val(wtr_1.toFixed(2));		
			$('#wtr_2').val(wtr_2.toFixed(2));		
			$('#wtr_3').val(wtr_3.toFixed(2));	

			var wrt1 = $('#wtr_1').val();		
			var wrt2 = $('#wtr_2').val();		
			var wrt3 = $('#wtr_3').val();
			
			var wtrw2_1 = $('#wtr_w2_1').val();
			var wtrw2_2 = $('#wtr_w2_2').val();
			var wtrw2_3 = $('#wtr_w2_3').val();
			
			wtr_w1_1 = ((((+wrt1)/100)*(+wtrw2_1))+(+wtrw2_1));
			wtr_w1_2 = ((((+wrt2)/100)*(+wtrw2_2))+(+wtrw2_2));
			wtr_w1_3 = ((((+wrt3)/100)*(+wtrw2_3))+(+wtrw2_3));

			$('#wtr_w1_1').val(wtr_w1_1.toFixed());	
			$('#wtr_w1_2').val(wtr_w1_2.toFixed());	
			$('#wtr_w1_3').val(wtr_w1_3.toFixed());	
			
			var wtrw1_1 = $('#wtr_w1_1').val();
			var wtrw1_2 = $('#wtr_w1_2').val();
			var wtrw1_3 = $('#wtr_w1_3').val();
			
			var diff1 = (+wtrw1_1) - (+wtrw2_1);
			var diff2 = (+wtrw1_2) - (+wtrw2_2);
			var diff3 = (+wtrw1_3) - (+wtrw2_3);
			
			var into1 = (+diff1) * 100;
			var into2 = (+diff2) * 100;
			var into3 = (+diff3) * 100;
			
			var wtr1 = (+into1) / (+wtrw2_1);
			var wtr2 = (+into2) / (+wtrw2_2);
			var wtr3 = (+into3) / (+wtrw2_3);
			
			$('#wtr_1').val(wtr1.toFixed(2));		
			$('#wtr_2').val(wtr2.toFixed(2));		
			$('#wtr_3').val(wtr3.toFixed(2));

			var wr1 = $('#wtr_1').val();		
			var wr2 = $('#wtr_2').val();		
			var wr3 = $('#wtr_3').val();	

			var acvgs = ((+wr1) + (+wr2) + (+wr3)) / 3;
			$('#avg_wtr').val(acvgs.toFixed(2));
	}
	
	
	$('#chk_wtr').change(function(){
        if(this.checked)
		{
			
			check_wtr();
			
			
		}	
		else
		{
			$('#wtr_w1_1').val(null);
			$('#wtr_w1_2').val(null);
			$('#wtr_w1_3').val(null);
			$('#avg_wtr').val(null);
			$('#wtr_1').val(null);
			$('#wtr_2').val(null);
			$('#wtr_3').val(null);
			$('#wtr_w2_1').val(null);
			$('#wtr_w2_2').val(null);	
			$('#wtr_w2_3').val(null);
			
		}
	});
	
	
	function wtr_w1_func()
	{
			$('#txtwtr').css("background-color","var(--success)"); 
			 wtr_w1_1 = $('#wtr_w1_1').val();
			 wtr_w1_2 = $('#wtr_w1_2').val();
			 wtr_w1_3 = $('#wtr_w1_3').val();
		
			 wtr_w2_1 = $('#wtr_w2_1').val();
			 wtr_w2_2 = $('#wtr_w2_2').val();
			 wtr_w2_3 = $('#wtr_w2_3').val();
														
			 var wtr_1 = (((+wtr_w1_1)-(+wtr_w2_1)) * 100) /(+wtr_w2_1);
			 var wtr_2 = (((+wtr_w1_2)-(+wtr_w2_2)) * 100) /(+wtr_w2_2);
			 var wtr_3 = (((+wtr_w1_3)-(+wtr_w2_3)) * 100) /(+wtr_w2_3);
			
			$('#wtr_1').val(wtr_1.toFixed(2));		
			$('#wtr_2').val(wtr_2.toFixed(2));		
			$('#wtr_3').val(wtr_3.toFixed(2));	

			var wrt1 = $('#wtr_1').val();		
			var wrt2 = $('#wtr_2').val();		
			var wrt3 = $('#wtr_3').val();
			
			 var avgwtr = ((+wrt1)+(+wrt2)+(+wrt3))/3;
			
			$('#avg_wtr').val(avgwtr.toFixed(2));		
			
		}

	$("#wtr_w1_1").change(function(){
		wtr_w1_func();	       						
    });
	$("#wtr_w1_2").change(function(){
		wtr_w1_func();	       						
    });
	$("#wtr_w1_3").change(function(){
		wtr_w1_func();	       						
    });
	
	$("#wtr_w2_1").change(function(){
		wtr_w1_func();	       						
    });
	$("#wtr_w2_2").change(function(){
		wtr_w1_func();	       						
    });
	$("#wtr_w2_3").change(function(){
		wtr_w1_func();	       						
    });
	
	function wtr_func()
	{
		$('#txtwtr').css("background-color","var(--success)"); 
		 if ($("#chk_wtr").is(':checked')) {
			
 			 var wtr_1 = $('#wtr_1').val();
			 var wtr_2 = $('#wtr_2').val();
			 var wtr_3 = $('#wtr_3').val();
			
			
			 var wtr_w2_1 = $('#wtr_w2_1').val();
			 var wtr_w2_2 = $('#wtr_w2_2').val();
			 var wtr_w2_3 = $('#wtr_w2_3').val();
			
			
			
		
			 wtr_w1_1 = ((((+wtr_1)/100)*(+wtr_w2_1))+(+wtr_w2_1));
			 wtr_w1_2 = ((((+wtr_2)/100)*(+wtr_w2_2))+(+wtr_w2_2));
			 wtr_w1_3 = ((((+wtr_3)/100)*(+wtr_w2_3))+(+wtr_w2_3));
			
			$('#wtr_w1_1').val(wtr_w1_1.toFixed());	
			$('#wtr_w1_2').val(wtr_w1_2.toFixed());	
			$('#wtr_w1_3').val(wtr_w1_3.toFixed());	
			
			
			var wtrw2_1 = $('#wtr_w2_1').val();
			var wtrw2_2 = $('#wtr_w2_2').val();
			var wtrw2_3 = $('#wtr_w2_3').val();
			
			
			
			var wtrw1_1 = $('#wtr_w1_1').val();
			var wtrw1_2 = $('#wtr_w1_2').val();
			var wtrw1_3 = $('#wtr_w1_3').val();
			
			var diff1 = (+wtrw1_1) - (+wtrw2_1);
			var diff2 = (+wtrw1_2) - (+wtrw2_2);
			var diff3 = (+wtrw1_3) - (+wtrw2_3);
			
			var into1 = (+diff1) * 100;
			var into2 = (+diff2) * 100;
			var into3 = (+diff3) * 100;
			
			var wtr1 = (+into1) / (+wtrw2_1);
			var wtr2 = (+into2) / (+wtrw2_2);
			var wtr3 = (+into3) / (+wtrw2_3);
			
			$('#wtr_1').val(wtr1.toFixed(2));		
			$('#wtr_2').val(wtr2.toFixed(2));		
			$('#wtr_3').val(wtr3.toFixed(2));

			var wr1 = $('#wtr_1').val();		
			var wr2 = $('#wtr_2').val();		
			var wr3 = $('#wtr_3').val();	

			var acvgs = ((+wr1) + (+wr2) + (+wr3)) / 3;
			$('#avg_wtr').val(acvgs.toFixed(2));
			
			
			
		 }
	}
	
	
	$("#wtr_1").change(function(){
		wtr_func();	       						
    });
	$("#wtr_2").change(function(){
		wtr_func();	       						
    });
	$("#wtr_3").change(function(){
		wtr_func();	       						
    });
	
	$("#avg_wtr").change(function(){
		
		$('#txtwtr').css("background-color","var(--success)"); 
		 if ($("#chk_wtr").is(':checked')) {
			var thickNess  = $('#top_thickNess').val();
			if(thickNess=="60")
			 {
					var rnad = randomNumberFromRange(0,100).toFixed();
					if(rnad%2==0)
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_1 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						 wtr_w2_2 = (+wtr_w2_1) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_3 = (+wtr_w2_2) + (+randomNumberFromRange(-70,70).toFixed());
					}
					else
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_3 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						 
						 wtr_w2_1 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_2 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
					}
					
			 }
			 else if(thickNess=="80")
			 {
					var rnad = randomNumberFromRange(0,100).toFixed();
					if(rnad%2==0)
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_1 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						
						 wtr_w2_2 = (+wtr_w2_1) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_3 = (+wtr_w2_1) + (+randomNumberFromRange(-70,70).toFixed());
					}
					else
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_3 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						 
						 wtr_w2_1 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_2 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
					}
					
			 }
			 else
			 {
				  var rnad = randomNumberFromRange(0,100).toFixed();
					if(rnad%2==0)
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_1 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						
						 wtr_w2_2 = (+wtr_w2_1) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_3 = (+wtr_w2_1) + (+randomNumberFromRange(-70,70).toFixed());
					}
					else
					{
						var wt1 = $('#wt1').val();
						var wt2 = $('#wt2').val();
						 wtr_w2_3 = randomNumberFromRange((+wt1),(+wt2)).toFixed();
						 
						 wtr_w2_1 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
						 wtr_w2_2 = (+wtr_w2_3) + (+randomNumberFromRange(-70,70).toFixed());
					}
			 }
			
			
			$('#wtr_w2_1').val(wtr_w2_1);
			$('#wtr_w2_2').val(wtr_w2_2);
			$('#wtr_w2_3').val(wtr_w2_3);
			
					
			var avgwtr1 = $('#avg_wtr').val();		
			
			var ss = randomNumberFromRange(0,9).toFixed();
			if(ss==0)
			{
				wtr_1 = (+avgwtr1) - 0.99;
				wtr_2 = (+avgwtr1) + 1.07;
				wtr_3 = (+avgwtr1) - 0.08;
			}
			else if(ss%2==0)
			{
				wtr_1 = (+avgwtr1) + 1.02;
				wtr_2 = (+avgwtr1) - 0.83;
				wtr_3 = (+avgwtr1) - 0.19;
			}
			else
			{
				wtr_1 = (+avgwtr1) - 1.02;
				wtr_2 = (+avgwtr1) + 0.83;
				wtr_3 = (+avgwtr1) + 0.19;
			}
			

			$('#wtr_1').val(wtr_1.toFixed(2));		
			$('#wtr_2').val(wtr_2.toFixed(2));		
			$('#wtr_3').val(wtr_3.toFixed(2));	

			var wrt1 = $('#wtr_1').val();		
			var wrt2 = $('#wtr_2').val();		
			var wrt3 = $('#wtr_3').val();
			
			var wtrw2_1 = $('#wtr_w2_1').val();
			var wtrw2_2 = $('#wtr_w2_2').val();
			var wtrw2_3 = $('#wtr_w2_3').val();
			
			wtr_w1_1 = ((((+wrt1)/100)*(+wtrw2_1))+(+wtrw2_1));
			wtr_w1_2 = ((((+wrt2)/100)*(+wtrw2_2))+(+wtrw2_2));
			wtr_w1_3 = ((((+wrt3)/100)*(+wtrw2_3))+(+wtrw2_3));

			$('#wtr_w1_1').val(wtr_w1_1.toFixed());	
			$('#wtr_w1_2').val(wtr_w1_2.toFixed());	
			$('#wtr_w1_3').val(wtr_w1_3.toFixed());	
			
			var wtrw1_1 = $('#wtr_w1_1').val();
			var wtrw1_2 = $('#wtr_w1_2').val();
			var wtrw1_3 = $('#wtr_w1_3').val();
			
			var diff1 = (+wtrw1_1) - (+wtrw2_1);
			var diff2 = (+wtrw1_2) - (+wtrw2_2);
			var diff3 = (+wtrw1_3) - (+wtrw2_3);
			
			var into1 = (+diff1) * 100;
			var into2 = (+diff2) * 100;
			var into3 = (+diff3) * 100;
			
			var wtr1 = (+into1) / (+wtrw2_1);
			var wtr2 = (+into2) / (+wtrw2_2);
			var wtr3 = (+into3) / (+wtrw2_3);
			
			$('#wtr_1').val(wtr1.toFixed(2));		
			$('#wtr_2').val(wtr2.toFixed(2));		
			$('#wtr_3').val(wtr3.toFixed(2));

			var wr1 = $('#wtr_1').val();		
			var wr2 = $('#wtr_2').val();		
			var wr3 = $('#wtr_3').val();	

			var acvgs = ((+wr1) + (+wr2) + (+wr3)) / 3;
			$('#avg_wtr').val(acvgs.toFixed(2));	
		 }
			     						
    });
	
	
	var chk_com;
	var thickNess;
	var grade;
	var shape;
	var lab_1,lab_2,lab_3,lab_4,lab_5,lab_6,lab_7,lab_8;
	var m1,m2,m3,m4,m5,m6,m7,m8;
	var grade_1,grade_2,grade_3,grade_4,grade_5,grade_6,grade_7,grade_8;
	var thick_1,thick_2,thick_3,thick_4,thick_5,thick_6,thick_7,thick_8;	
	var area_1,area_2,area_3,area_4,area_5,area_6,area_7,area_8;
	var factor_1,factor_2,factor_3,factor_4,factor_5,factor_6,factor_7,factor_8;
	var load_1,load_2,load_3,load_4,load_5,load_6,load_7,load_8;
	var com_1,com_2,com_3,com_4,com_5,com_6,com_7,com_8;
	var corr_1,corr_2,corr_3,corr_4,corr_5,corr_6,corr_7,corr_8,avr_corr;
	var den_1,den_2,den_3,den_4,den_5,den_6,den_7,den_8,avg_den;
	var thickNess  = $('#top_thickNess').val();
	var grade  = $('#top_grade').val();
	var shape  = $('#top_shape').val();
	 $('#thick_1').val(thickNess);
	 $('#thick_2').val(thickNess);
	 $('#thick_3').val(thickNess);
	 $('#thick_4').val(thickNess);
	 $('#thick_5').val(thickNess);
	 $('#thick_6').val(thickNess);
	 $('#thick_7').val(thickNess);
	 $('#thick_8').val(thickNess);
	 
	 $('#grade_1').val(grade);
	 $('#grade_2').val(grade);
	 $('#grade_3').val(grade);
	 $('#grade_4').val(grade);
	 $('#grade_5').val(grade);
	 $('#grade_6').val(grade);
	 $('#grade_7').val(grade);
	 $('#grade_8').val(grade);
	 
	 /* if(thickNess=="50")
		{
			 factor_1 = 1.03;
			 factor_2 = 1.03;
			 factor_3 = 1.03;
			 factor_4 = 1.03;
			 factor_5 = 1.03;
			 factor_6 = 1.03;
			 factor_7 = 1.03;
			 factor_8 = 1.03;
		}
		else if(thickNess=="60")
		{
			 factor_1 = 1.06;
			 factor_2 = 1.06;
			 factor_3 = 1.06;
			 factor_4 = 1.06;
			 factor_5 = 1.06;
			 factor_6 = 1.06;
			 factor_7 = 1.06;
			 factor_8 = 1.06;
		}
		else if(thickNess=="80")
		{
			 factor_1 = 1.18;
			 factor_2 = 1.18;
			 factor_3 = 1.18;
			 factor_4 = 1.18;
			 factor_5 = 1.18;
			 factor_6 = 1.18;
			 factor_7 = 1.18;
			 factor_8 = 1.18;
		}
		else if(thickNess=="100")
		{
			 factor_1 = 1.24;
			 factor_2 = 1.24;
			 factor_3 = 1.24;
			 factor_4 = 1.24;
			 factor_5 = 1.24;
			 factor_6 = 1.24;
			 factor_7 = 1.24;
			 factor_8 = 1.24;
		}
		else if(thickNess=="120")
		{
			 factor_1 = 1.34;
			 factor_2 = 1.34;
			 factor_3 = 1.34;
			 factor_4 = 1.34;
			 factor_5 = 1.34;
			 factor_6 = 1.34;
			 factor_7 = 1.34;
			 factor_8 = 1.34;
		}
		$('#factor_1').val(factor_1.toFixed(2));
		 $('#factor_2').val(factor_2.toFixed(2));
		 $('#factor_3').val(factor_3.toFixed(2));
		 $('#factor_4').val(factor_4.toFixed(2));
		 $('#factor_5').val(factor_5.toFixed(2));
		 $('#factor_6').val(factor_6.toFixed(2));
		 $('#factor_7').val(factor_7.toFixed(2));
		 $('#factor_8').val(factor_8.toFixed(2)); */
	
	function check_com()
	{
			$('#sm1').val("PB/1");
			$('#sm2').val("PB/2");
			$('#sm3').val("PB/3");
			$('#sm4').val("PB/4");
			$('#sm5').val("PB/5");
			$('#sm6').val("PB/6");
			$('#sm7').val("PB/7");
			$('#sm8').val("PB/8");
			 thickNess  = $('#top_thickNess').val();
			 grade  = $('#top_grade').val();
			 shape  = $('#top_shape').val();
		     $('#thick_1').val(thickNess);
		     $('#thick_2').val(thickNess);
		     $('#thick_3').val(thickNess);
		     $('#thick_4').val(thickNess);
		     $('#thick_5').val(thickNess);
		     $('#thick_6').val(thickNess);
		     $('#thick_7').val(thickNess);
		     $('#thick_8').val(thickNess);
			 
		     $('#grade_1').val(grade);
		     $('#grade_2').val(grade);
		     $('#grade_3').val(grade);
		     $('#grade_4').val(grade);
		     $('#grade_5').val(grade);
		     $('#grade_6').val(grade);
		     $('#grade_7').val(grade);
		     $('#grade_8').val(grade);
			
			
			 
			if(grade=="M-20")
			 {
					 den_1 = parseInt(randomNumberFromRange(4200,5000));
					 den_2 = parseInt(randomNumberFromRange(4200,5000));
					 den_3 = parseInt(randomNumberFromRange(4200,5000));
					 den_4 = parseInt(randomNumberFromRange(4200,5000));
					 den_5 = parseInt(randomNumberFromRange(4200,5000));
					 den_6 = parseInt(randomNumberFromRange(4200,5000));
					 den_7 = parseInt(randomNumberFromRange(4200,5000));
					 den_8 = parseInt(randomNumberFromRange(4200,5000));					 
			 }
			 else if(grade=="M-25")
			 {
					 den_1 = parseInt(randomNumberFromRange(4800,5600));
					 den_2 = parseInt(randomNumberFromRange(4800,5600));
					 den_3 = parseInt(randomNumberFromRange(4800,5600));
					 den_4 = parseInt(randomNumberFromRange(4800,5600));
					 den_5 = parseInt(randomNumberFromRange(4800,5600));
					 den_6 = parseInt(randomNumberFromRange(4800,5600));
					 den_7 = parseInt(randomNumberFromRange(4800,5600));
					 den_8 = parseInt(randomNumberFromRange(4800,5600));
					 den_9 = parseInt(randomNumberFromRange(4800,5600));
			 }
			 else if(grade=="M-30")
			 {
					 den_1 = parseInt(randomNumberFromRange(5300,6000));
					 den_2 = parseInt(randomNumberFromRange(5300,6000));
					 den_3 = parseInt(randomNumberFromRange(5300,6000));
					 den_4 = parseInt(randomNumberFromRange(5300,6000));
					 den_5 = parseInt(randomNumberFromRange(5300,6000));
					 den_6 = parseInt(randomNumberFromRange(5300,6000));
					 den_7 = parseInt(randomNumberFromRange(5300,6000));
					 den_8 = parseInt(randomNumberFromRange(5300,6000));
			 }
			 else if(grade=="M-35")
			 {
					 den_1 = parseInt(randomNumberFromRange(5700,6200));
					 den_2 = parseInt(randomNumberFromRange(5700,6200));
					 den_3 = parseInt(randomNumberFromRange(5700,6200));
					 den_4 = parseInt(randomNumberFromRange(5700,6200));
					 den_5 = parseInt(randomNumberFromRange(5700,6200));
					 den_6 = parseInt(randomNumberFromRange(5700,6200));
					 den_7 = parseInt(randomNumberFromRange(5700,6200));
					 den_8 = parseInt(randomNumberFromRange(5700,6200));
			 }
			 else if(grade=="M-40")
			 {
					 den_1 = parseInt(randomNumberFromRange(6000,6400));
					 den_2 = parseInt(randomNumberFromRange(6000,6400));
					 den_3 = parseInt(randomNumberFromRange(6000,6400));
					 den_4 = parseInt(randomNumberFromRange(6000,6400));
					 den_5 = parseInt(randomNumberFromRange(6000,6400));
					 den_6 = parseInt(randomNumberFromRange(6000,6400));
					 den_7 = parseInt(randomNumberFromRange(6000,6400));
					 den_8 = parseInt(randomNumberFromRange(6000,6400));
			 }
			 else if(grade=="M-45")
			 {
					 den_1 = parseInt(randomNumberFromRange(6300,6800));
					 den_2 = parseInt(randomNumberFromRange(6300,6800));
					 den_3 = parseInt(randomNumberFromRange(6300,6800));
					 den_4 = parseInt(randomNumberFromRange(6300,6800));
					 den_5 = parseInt(randomNumberFromRange(6300,6800));
					 den_6 = parseInt(randomNumberFromRange(6300,6800));
					 den_7 = parseInt(randomNumberFromRange(6300,6800));
					 den_8 = parseInt(randomNumberFromRange(6300,6800));
			 }
			 else if(grade=="M-50")
			 {
					 den_1 = parseInt(randomNumberFromRange(6860,7500));
					 den_2 = parseInt(randomNumberFromRange(6860,7500));
					 den_3 = parseInt(randomNumberFromRange(6860,7500));
					 den_4 = parseInt(randomNumberFromRange(6860,7500));
					 den_5 = parseInt(randomNumberFromRange(6860,7500));
					 den_6 = parseInt(randomNumberFromRange(6860,7500));
					 den_7 = parseInt(randomNumberFromRange(6860,7500));
					 den_8 = parseInt(randomNumberFromRange(6860,7500));
			 }
			 else if(grade=="M-55")
			 {
					 den_1 = parseInt(randomNumberFromRange(7200,8000));
					 den_2 = parseInt(randomNumberFromRange(7200,8000));
					 den_3 = parseInt(randomNumberFromRange(7200,8000));
					 den_4 = parseInt(randomNumberFromRange(7200,8000));
					 den_5 = parseInt(randomNumberFromRange(7200,8000));
					 den_6 = parseInt(randomNumberFromRange(7200,8000));
					 den_7 = parseInt(randomNumberFromRange(7200,8000));
					 den_8 = parseInt(randomNumberFromRange(7200,8000));
			 }
			 else if(grade=="M-60")
			 {
					 den_1 = parseInt(randomNumberFromRange(7600,8500));
					 den_2 = parseInt(randomNumberFromRange(7600,8500));
					 den_3 = parseInt(randomNumberFromRange(7600,8500));
					 den_4 = parseInt(randomNumberFromRange(7600,8500));
					 den_5 = parseInt(randomNumberFromRange(7600,8500));
					 den_6 = parseInt(randomNumberFromRange(7600,8500));
					 den_7 = parseInt(randomNumberFromRange(7600,8500));
					 den_8 = parseInt(randomNumberFromRange(7600,8500));
			 }
				
			
			
			
			
			
			/* 
			if(shape=="i_shape")
			 {
				 
				 
				 area_1 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_2 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_3 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_4 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_5 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_6 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_7 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_8 = randomNumberFromRange((+ar1),(+ar2)).toFixed();	
				 
				 $('#area_1').val(area_1);
				 $('#area_2').val(area_2);
				 $('#area_3').val(area_3);
				 $('#area_4').val(area_4);
				 $('#area_5').val(area_5);
				 $('#area_6').val(area_6);
				 $('#area_7').val(area_7);
				 $('#area_8').val(area_8);
				
				if(thickNess=="50")
				{
					 factor_1 = 1.03;
					 factor_2 = 1.03;
					 factor_3 = 1.03;
					 factor_4 = 1.03;
					 factor_5 = 1.03;
					 factor_6 = 1.03;
					 factor_7 = 1.03;
					 factor_8 = 1.03;
				}
				else if(thickNess=="60")
				{
					 factor_1 = 1.06;
					 factor_2 = 1.06;
					 factor_3 = 1.06;
					 factor_4 = 1.06;
					 factor_5 = 1.06;
					 factor_6 = 1.06;
					 factor_7 = 1.06;
					 factor_8 = 1.06;
					 
					lab_1 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_2 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_3 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_4 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_5 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_6 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_7 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_8 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 $('#lab_1').val(lab_1);
					 $('#lab_2').val(lab_2);
					 $('#lab_3').val(lab_3);
					 $('#lab_4').val(lab_4);
					 $('#lab_5').val(lab_5);
					 $('#lab_6').val(lab_6);
					 $('#lab_7').val(lab_7);
					 $('#lab_8').val(lab_8);
					 
					 var l1 = $('#lab_1').val();
					 var l2 = $('#lab_2').val();
					 var l3 = $('#lab_3').val();
					 var l4 = $('#lab_4').val();
					 var l5 = $('#lab_5').val();
					 var l6 = $('#lab_6').val();
					 var l7 = $('#lab_7').val();
					 var l8 = $('#lab_8').val();
					 
					 
					 
					  var a1 = $('#area_1').val();
					 var a2 = $('#area_2').val();
					 var a3 = $('#area_3').val();
					 var a4 = $('#area_4').val();
					 var a5 = $('#area_5').val();
					 var a6 = $('#area_6').val();
					 var a7 = $('#area_7').val();
					 var a8 = $('#area_8').val();  
					 
					 var temp1 = (+a1) * (+l1);
					 var temp2 = (+a2) * (+l2);
					 var temp3 = (+a3) * (+l3);
					 var temp4 = (+a4) * (+l4);
					 var temp5 = (+a5) * (+l5);
					 var temp6 = (+a6) * (+l6);
					 var temp7 = (+a7) * (+l7);
					 var temp8 = (+a8) * (+l8);
					 
					 m1 = ((+temp1)/20000);
					 m2 = ((+temp2)/20000);
					 m3 = ((+temp3)/20000);
					 m4 = ((+temp4)/20000);
					 m5 = ((+temp5)/20000);
					 m6 = ((+temp6)/20000);
					 m7 = ((+temp7)/20000);
					 m8 = ((+temp8)/20000);
					 
					 $('#m1').val(m1.toFixed(1));
					 $('#m2').val(m2.toFixed(1));
					 $('#m3').val(m3.toFixed(1));
					 $('#m4').val(m4.toFixed(1));
					 $('#m5').val(m5.toFixed(1));
					 $('#m6').val(m6.toFixed(1));
					 $('#m7').val(m7.toFixed(1));
					 $('#m8').val(m8.toFixed(1));
				}
				else if(thickNess=="80")
				{
					 factor_1 = 1.18;
					 factor_2 = 1.18;
					 factor_3 = 1.18;
					 factor_4 = 1.18;
					 factor_5 = 1.18;
					 factor_6 = 1.18;
					 factor_7 = 1.18;
					 factor_8 = 1.18;
					 
					 lab_1 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_2 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_3 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_4 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_5 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_6 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_7 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					lab_8 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 $('#lab_1').val(lab_1);
					 $('#lab_2').val(lab_2);
					 $('#lab_3').val(lab_3);
					 $('#lab_4').val(lab_4);
					 $('#lab_5').val(lab_5);
					 $('#lab_6').val(lab_6);
					 $('#lab_7').val(lab_7);
					 $('#lab_8').val(lab_8);
					 
					 var l1 = $('#lab_1').val();
					 var l2 = $('#lab_2').val();
					 var l3 = $('#lab_3').val();
					 var l4 = $('#lab_4').val();
					 var l5 = $('#lab_5').val();
					 var l6 = $('#lab_6').val();
					 var l7 = $('#lab_7').val();
					 var l8 = $('#lab_8').val();
					 
					 
					 
					  var a1 = $('#area_1').val();
					 var a2 = $('#area_2').val();
					 var a3 = $('#area_3').val();
					 var a4 = $('#area_4').val();
					 var a5 = $('#area_5').val();
					 var a6 = $('#area_6').val();
					 var a7 = $('#area_7').val();
					 var a8 = $('#area_8').val();  
					 
					 var temp1 = (+a1) * (+l1);
					 var temp2 = (+a2) * (+l2);
					 var temp3 = (+a3) * (+l3);
					 var temp4 = (+a4) * (+l4);
					 var temp5 = (+a5) * (+l5);
					 var temp6 = (+a6) * (+l6);
					 var temp7 = (+a7) * (+l7);
					 var temp8 = (+a8) * (+l8);
					 
					 m1 = ((+temp1)/20000);
					 m2 = ((+temp2)/20000);
					 m3 = ((+temp3)/20000);
					 m4 = ((+temp4)/20000);
					 m5 = ((+temp5)/20000);
					 m6 = ((+temp6)/20000);
					 m7 = ((+temp7)/20000);
					 m8 = ((+temp8)/20000);
					 
					 $('#m1').val(m1.toFixed(1));
					 $('#m2').val(m2.toFixed(1));
					 $('#m3').val(m3.toFixed(1));
					 $('#m4').val(m4.toFixed(1));
					 $('#m5').val(m5.toFixed(1));
					 $('#m6').val(m6.toFixed(1));
					 $('#m7').val(m7.toFixed(1));
					 $('#m8').val(m8.toFixed(1));
				}
				else if(thickNess=="100")
				{
					 factor_1 = 1.24;
					 factor_2 = 1.24;
					 factor_3 = 1.24;
					 factor_4 = 1.24;
					 factor_5 = 1.24;
					 factor_6 = 1.24;
					 factor_7 = 1.24;
					 factor_8 = 1.24;
				}
				else if(thickNess=="120")
				{
					 factor_1 = 1.34;
					 factor_2 = 1.34;
					 factor_3 = 1.34;
					 factor_4 = 1.34;
					 factor_5 = 1.34;
					 factor_6 = 1.34;
					 factor_7 = 1.34;
					 factor_8 = 1.34;
				}
				 
			 }
			 else if(shape=="zigzag")
			 {
				 
				 area_1 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_2 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_3 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_4 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_5 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_6 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_7 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_8 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				
				 $('#area_1').val(area_1);
				 $('#area_2').val(area_2);
				 $('#area_3').val(area_3);
				 $('#area_4').val(area_4);
				 $('#area_5').val(area_5);
				 $('#area_6').val(area_6);
				 $('#area_7').val(area_7);
				 $('#area_8').val(area_8);
				
				
				 
				 if(thickNess=="50")
				{
					factor_1 = 1.03;
					factor_2 = 1.03;
					factor_3 = 1.03;
					factor_4 = 1.03;
					factor_5 = 1.03;
					factor_6 = 1.03;
					factor_7 = 1.03;
					factor_8 = 1.03;
				}
				else if(thickNess=="60")
				{
					 factor_1 = 1.06;
					 factor_2 = 1.06;
					 factor_3 = 1.06;
					 factor_4 = 1.06;
					 factor_5 = 1.06;
					 factor_6 = 1.06;
					 factor_7 = 1.06;
					 factor_8 = 1.06;
					 
				 lab_1 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_2 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_3 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_4 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_5 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_6 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_7 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_8 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 $('#lab_1').val(lab_1);
					 $('#lab_2').val(lab_2);
					 $('#lab_3').val(lab_3);
					 $('#lab_4').val(lab_4);
					 $('#lab_5').val(lab_5);
					 $('#lab_6').val(lab_6);
					 $('#lab_7').val(lab_7);
					 $('#lab_8').val(lab_8);
					 
					 var l1 = $('#lab_1').val();
					 var l2 = $('#lab_2').val();
					 var l3 = $('#lab_3').val();
					 var l4 = $('#lab_4').val();
					 var l5 = $('#lab_5').val();
					 var l6 = $('#lab_6').val();
					 var l7 = $('#lab_7').val();
					 var l8 = $('#lab_8').val();
					 
					 
					 
					  var a1 = $('#area_1').val();
					 var a2 = $('#area_2').val();
					 var a3 = $('#area_3').val();
					 var a4 = $('#area_4').val();
					 var a5 = $('#area_5').val();
					 var a6 = $('#area_6').val();
					 var a7 = $('#area_7').val();
					 var a8 = $('#area_8').val();  
					 
					 var temp1 = (+a1) * (+l1);
					 var temp2 = (+a2) * (+l2);
					 var temp3 = (+a3) * (+l3);
					 var temp4 = (+a4) * (+l4);
					 var temp5 = (+a5) * (+l5);
					 var temp6 = (+a6) * (+l6);
					 var temp7 = (+a7) * (+l7);
					 var temp8 = (+a8) * (+l8);
					 
					 m1 = ((+temp1)/20000);
					 m2 = ((+temp2)/20000);
					 m3 = ((+temp3)/20000);
					 m4 = ((+temp4)/20000);
					 m5 = ((+temp5)/20000);
					 m6 = ((+temp6)/20000);
					 m7 = ((+temp7)/20000);
					 m8 = ((+temp8)/20000);
					 
					 $('#m1').val(m1.toFixed(2));
					 $('#m2').val(m2.toFixed(2));
					 $('#m3').val(m3.toFixed(2));
					 $('#m4').val(m4.toFixed(2));
					 $('#m5').val(m5.toFixed(2));
					 $('#m6').val(m6.toFixed(2));
					 $('#m7').val(m7.toFixed(2));
					 $('#m8').val(m8.toFixed(2));
					 
				}
				else if(thickNess=="80")
				{
					 factor_1 = 1.18;
					 factor_2 = 1.18;
					 factor_3 = 1.18;
					 factor_4 = 1.18;
					 factor_5 = 1.18;
					 factor_6 = 1.18;
					 factor_7 = 1.18;
					 factor_8 = 1.18;
					 
					 lab_1 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_2 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_3 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_4 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_5 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_6 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_7 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_8 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 $('#lab_1').val(lab_1);
					 $('#lab_2').val(lab_2);
					 $('#lab_3').val(lab_3);
					 $('#lab_4').val(lab_4);
					 $('#lab_5').val(lab_5);
					 $('#lab_6').val(lab_6);
					 $('#lab_7').val(lab_7);
					 $('#lab_8').val(lab_8);
					 
					 var l1 = $('#lab_1').val();
					 var l2 = $('#lab_2').val();
					 var l3 = $('#lab_3').val();
					 var l4 = $('#lab_4').val();
					 var l5 = $('#lab_5').val();
					 var l6 = $('#lab_6').val();
					 var l7 = $('#lab_7').val();
					 var l8 = $('#lab_8').val();
					 
					 
					 
					  var a1 = $('#area_1').val();
					 var a2 = $('#area_2').val();
					 var a3 = $('#area_3').val();
					 var a4 = $('#area_4').val();
					 var a5 = $('#area_5').val();
					 var a6 = $('#area_6').val();
					 var a7 = $('#area_7').val();
					 var a8 = $('#area_8').val();  
					 
					 var temp1 = (+a1) * (+l1);
					 var temp2 = (+a2) * (+l2);
					 var temp3 = (+a3) * (+l3);
					 var temp4 = (+a4) * (+l4);
					 var temp5 = (+a5) * (+l5);
					 var temp6 = (+a6) * (+l6);
					 var temp7 = (+a7) * (+l7);
					 var temp8 = (+a8) * (+l8);
					 
					 m1 = ((+temp1)/20000);
					 m2 = ((+temp2)/20000);
					 m3 = ((+temp3)/20000);
					 m4 = ((+temp4)/20000);
					 m5 = ((+temp5)/20000);
					 m6 = ((+temp6)/20000);
					 m7 = ((+temp7)/20000);
					 m8 = ((+temp8)/20000);
					 
					  $('#m1').val(m1.toFixed(2));
					 $('#m2').val(m2.toFixed(2));
					 $('#m3').val(m3.toFixed(2));
					 $('#m4').val(m4.toFixed(2));
					 $('#m5').val(m5.toFixed(2));
					 $('#m6').val(m6.toFixed(2));
					 $('#m7').val(m7.toFixed(2));
					 $('#m8').val(m8.toFixed(2));
					 
				}
				else if(thickNess=="100")
				{
					 factor_1 = 1.24;
					 factor_2 = 1.24;
					 factor_3 = 1.24;
					 factor_4 = 1.24;
					 factor_5 = 1.24;
					 factor_6 = 1.24;
					 factor_7 = 1.24;
					 factor_8 = 1.24;
				}
				else if(thickNess=="120")
				{
					 factor_1 = 1.34;
					 factor_2 = 1.34;
					 factor_3 = 1.34;
					 factor_4 = 1.34;
					 factor_5 = 1.34;
					 factor_6 = 1.34;
					 factor_7 = 1.34;
					 factor_8 = 1.34;
				}
			 }
			 else if(shape=="damru")
			 {
				 
				 area_1 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_2 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_3 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_4 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_5 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_6 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_7 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_8 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 
				 if(thickNess=="50")
				{
					 factor_1 = 1.03;
					 factor_2 = 1.03;
					 factor_3 = 1.03;
					 factor_4 = 1.03;
					 factor_5 = 1.03;
					 factor_6 = 1.03;
					 factor_7 = 1.03;
					 factor_8 = 1.03;
				}
				else if(thickNess=="60")
				{
					 factor_1 = 1.06;
					 factor_2 = 1.06;
					 factor_3 = 1.06;
					 factor_4 = 1.06;
					 factor_5 = 1.06;
					 factor_6 = 1.06;
					 factor_7 = 1.06;
					 factor_8 = 1.06;
				}
				else if(thickNess=="80")
				{
					 factor_1 = 1.18;
					 factor_2 = 1.18;
					 factor_3 = 1.18;
					 factor_4 = 1.18;
					 factor_5 = 1.18;
					 factor_6 = 1.18;
					 factor_7 = 1.18;
					 factor_8 = 1.18;
				}
				else if(thickNess=="100")
				{
					 factor_1 = 1.24;
					 factor_2 = 1.24;
					 factor_3 = 1.24;
					 factor_4 = 1.24;
					 factor_5 = 1.24;
					 factor_6 = 1.24;
					 factor_7 = 1.24;
					 factor_8 = 1.24;
				}
				else if(thickNess=="120")
				{
					 factor_1 = 1.34;
					 factor_2 = 1.34;
					 factor_3 = 1.34;
					 factor_4 = 1.34;
					 factor_5 = 1.34;
					 factor_6 = 1.34;
					 factor_7 = 1.34;
					 factor_8 = 1.34;
				}
			 }
			 else if(shape=="plain")
			 {
			
				  area_1 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_2 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_3 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_4 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_5 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_6 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_7 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_8 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				
				 $('#area_1').val(area_1);
				 $('#area_2').val(area_2);
				 $('#area_3').val(area_3);
				 $('#area_4').val(area_4);
				 $('#area_5').val(area_5);
				 $('#area_6').val(area_6);
				 $('#area_7').val(area_7);
				 $('#area_8').val(area_8);
				 
				 if(thickNess=="50")
				{
					 factor_1 = 0.96;
					 factor_2 = 0.96;
					 factor_3 = 0.96;
					 factor_4 = 0.96;
					 factor_5 = 0.96;
					 factor_6 = 0.96;
					 factor_7 = 0.96;
					 factor_8 = 0.96;
				}
				else if(thickNess=="60")
				{
					 factor_1 = 1.00;
					 factor_2 = 1.00;
					 factor_3 = 1.00;
					 factor_4 = 1.00;
					 factor_5 = 1.00;
					 factor_6 = 1.00;
					 factor_7 = 1.00;
					 factor_8 = 1.00;
					 
				 lab_1 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_2 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_3 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_4 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_5 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_6 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_7 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 lab_8 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 $('#lab_1').val(lab_1);
					 $('#lab_2').val(lab_2);
					 $('#lab_3').val(lab_3);
					 $('#lab_4').val(lab_4);
					 $('#lab_5').val(lab_5);
					 $('#lab_6').val(lab_6);
					 $('#lab_7').val(lab_7);
					 $('#lab_8').val(lab_8);
					 
					 var l1 = $('#lab_1').val();
					 var l2 = $('#lab_2').val();
					 var l3 = $('#lab_3').val();
					 var l4 = $('#lab_4').val();
					 var l5 = $('#lab_5').val();
					 var l6 = $('#lab_6').val();
					 var l7 = $('#lab_7').val();
					 var l8 = $('#lab_8').val();
					 
					 
					 
					  var a1 = $('#area_1').val();
					 var a2 = $('#area_2').val();
					 var a3 = $('#area_3').val();
					 var a4 = $('#area_4').val();
					 var a5 = $('#area_5').val();
					 var a6 = $('#area_6').val();
					 var a7 = $('#area_7').val();
					 var a8 = $('#area_8').val();  
					 
					 var temp1 = (+a1) * (+l1);
					 var temp2 = (+a2) * (+l2);
					 var temp3 = (+a3) * (+l3);
					 var temp4 = (+a4) * (+l4);
					 var temp5 = (+a5) * (+l5);
					 var temp6 = (+a6) * (+l6);
					 var temp7 = (+a7) * (+l7);
					 var temp8 = (+a8) * (+l8);
					 
					 m1 = ((+temp1)/20000);
					 m2 = ((+temp2)/20000);
					 m3 = ((+temp3)/20000);
					 m4 = ((+temp4)/20000);
					 m5 = ((+temp5)/20000);
					 m6 = ((+temp6)/20000);
					 m7 = ((+temp7)/20000);
					 m8 = ((+temp8)/20000);
					 
					  $('#m1').val(m1.toFixed(2));
					 $('#m2').val(m2.toFixed(2));
					 $('#m3').val(m3.toFixed(2));
					 $('#m4').val(m4.toFixed(2));
					 $('#m5').val(m5.toFixed(2));
					 $('#m6').val(m6.toFixed(2));
					 $('#m7').val(m7.toFixed(2));
					 $('#m8').val(m8.toFixed(2));
				}
				else if(thickNess=="80")
				{
					 factor_1 = 1.12;
					 factor_2 = 1.12;
					 factor_3 = 1.12;
					 factor_4 = 1.12;
					 factor_5 = 1.12;
					 factor_6 = 1.12;
					 factor_7 = 1.12;
					 factor_8 = 1.12;
					 lab_1 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_2 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_3 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_4 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_5 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_6 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_7 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 lab_8 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
					 $('#lab_1').val(lab_1);
					 $('#lab_2').val(lab_2);
					 $('#lab_3').val(lab_3);
					 $('#lab_4').val(lab_4);
					 $('#lab_5').val(lab_5);
					 $('#lab_6').val(lab_6);
					 $('#lab_7').val(lab_7);
					 $('#lab_8').val(lab_8);
					 
					 var l1 = $('#lab_1').val();
					 var l2 = $('#lab_2').val();
					 var l3 = $('#lab_3').val();
					 var l4 = $('#lab_4').val();
					 var l5 = $('#lab_5').val();
					 var l6 = $('#lab_6').val();
					 var l7 = $('#lab_7').val();
					 var l8 = $('#lab_8').val();
					 
					 
					 
					  var a1 = $('#area_1').val();
					 var a2 = $('#area_2').val();
					 var a3 = $('#area_3').val();
					 var a4 = $('#area_4').val();
					 var a5 = $('#area_5').val();
					 var a6 = $('#area_6').val();
					 var a7 = $('#area_7').val();
					 var a8 = $('#area_8').val();  
					 
					 var temp1 = (+a1) * (+l1);
					 var temp2 = (+a2) * (+l2);
					 var temp3 = (+a3) * (+l3);
					 var temp4 = (+a4) * (+l4);
					 var temp5 = (+a5) * (+l5);
					 var temp6 = (+a6) * (+l6);
					 var temp7 = (+a7) * (+l7);
					 var temp8 = (+a8) * (+l8);
					 
					 m1 = ((+temp1)/20000);
					 m2 = ((+temp2)/20000);
					 m3 = ((+temp3)/20000);
					 m4 = ((+temp4)/20000);
					 m5 = ((+temp5)/20000);
					 m6 = ((+temp6)/20000);
					 m7 = ((+temp7)/20000);
					 m8 = ((+temp8)/20000);
					 
					  $('#m1').val(m1.toFixed(2));
					 $('#m2').val(m2.toFixed(2));
					 $('#m3').val(m3.toFixed(2));
					 $('#m4').val(m4.toFixed(2));
					 $('#m5').val(m5.toFixed(2));
					 $('#m6').val(m6.toFixed(2));
					 $('#m7').val(m7.toFixed(2));
					 $('#m8').val(m8.toFixed(2));
				}
				else if(thickNess=="100")
				{
					 factor_1 = 1.18;
					 factor_2 = 1.18;
					 factor_3 = 1.18;
					 factor_4 = 1.18;
					 factor_5 = 1.18;
					 factor_6 = 1.18;
					 factor_7 = 1.18;
					 factor_8 = 1.18;
				}
				else if(thickNess=="120")
				{
					 factor_1 = 1.28;
					 factor_2 = 1.28;
					 factor_3 = 1.28;
					 factor_4 = 1.28;
					 factor_5 = 1.28;
					 factor_6 = 1.28;
					 factor_7 = 1.28;
					 factor_8 = 1.28;
				}
			 } */
			 
			 var block_type = $('#block_type').val();
			var thickNess = $('#top_thickNess').val();
			if (block_type == "Chamfered Block") {
				if (thickNess == "50") {
					factor_1 = 1.03;
					factor_2 = 1.03;
					factor_3 = 1.03;
					factor_4 = 1.03;
					factor_5 = 1.03;
					factor_6 = 1.03;
					factor_7 = 1.03;
					factor_8 = 1.03;
				} else if (thickNess == "60") {
					factor_1 = 1.06;
					factor_2 = 1.06;
					factor_3 = 1.06;
					factor_4 = 1.06;
					factor_5 = 1.06;
					factor_6 = 1.06;
					factor_7 = 1.06;
					factor_8 = 1.06;
				} else if (thickNess == "75") {
					factor_1 = 1.18;
					factor_2 = 1.18;
					factor_3 = 1.18;
					factor_4 = 1.18;
					factor_5 = 1.18;
					factor_6 = 1.18;
					factor_7 = 1.18;
					factor_8 = 1.18;
				} else if (thickNess == "80") {
					factor_1 = 1.18;
					factor_2 = 1.18;
					factor_3 = 1.18;
					factor_4 = 1.18;
					factor_5 = 1.18;
					factor_6 = 1.18;
					factor_7 = 1.18;
					factor_8 = 1.18;
				} else if (thickNess == "100") {
					factor_1 = 1.24;
					factor_2 = 1.24;
					factor_3 = 1.24;
					factor_4 = 1.24;
					factor_5 = 1.24;
					factor_6 = 1.24;
					factor_7 = 1.24;
					factor_8 = 1.24;
				} else if (thickNess == "120") {
					factor_1 = 1.34;
					factor_2 = 1.34;
					factor_3 = 1.34;
					factor_4 = 1.34;
					factor_5 = 1.34;
					factor_6 = 1.34;
					factor_7 = 1.34;
					factor_8 = 1.34;
				}
			} else {
				if (thickNess == "50") {
					factor_1 = 0.96;
					factor_2 = 0.96;
					factor_3 = 0.96;
					factor_4 = 0.96;
					factor_5 = 0.96;
					factor_6 = 0.96;
					factor_7 = 0.96;
					factor_8 = 0.96;
				} else if (thickNess == "60") {
					factor_1 = 1.00;
					factor_2 = 1.00;
					factor_3 = 1.00;
					factor_4 = 1.00;
					factor_5 = 1.00;
					factor_6 = 1.00;
					factor_7 = 1.00;
					factor_8 = 1.00;
				} else if (thickNess == "75") {
					factor_1 = 1.12;
					factor_2 = 1.12;
					factor_3 = 1.12;
					factor_4 = 1.12;
					factor_5 = 1.12;
					factor_6 = 1.12;
					factor_7 = 1.12;
					factor_8 = 1.12;
				} else if (thickNess == "80") {
					factor_1 = 1.12;
					factor_2 = 1.12;
					factor_3 = 1.12;
					factor_4 = 1.12;
					factor_5 = 1.12;
					factor_6 = 1.12;
					factor_7 = 1.12;
					factor_8 = 1.12;
				} else if (thickNess == "100") {
					factor_1 = 1.18;
					factor_2 = 1.18;
					factor_3 = 1.18;
					factor_4 = 1.18;
					factor_5 = 1.18;
					factor_6 = 1.18;
					factor_7 = 1.18;
					factor_8 = 1.18;
				} else if (thickNess == "120") {
					factor_1 = 1.28;
					factor_2 = 1.28;
					factor_3 = 1.28;
					factor_4 = 1.28;
					factor_5 = 1.28;
					factor_6 = 1.28;
					factor_7 = 1.28;
					factor_8 = 1.28;
				}
			}
			
		$('#factor_1').val(factor_1);
		 $('#factor_2').val(factor_2);
		 $('#factor_3').val(factor_3);
		 $('#factor_4').val(factor_4);
		 $('#factor_5').val(factor_5);
		 $('#factor_6').val(factor_6);
		 $('#factor_7').val(factor_7);
		 $('#factor_8').val(factor_8);
			 
			var ar1 = $('#ar1').val();
			var ar2 = $('#ar2').val();

			
			
				 area_1 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 area_2 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 area_3 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 area_4 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 area_5 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 area_6 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 area_7 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);
				 area_8 = parseFloat(randomNumberFromRange(30000, 32000)).toFixed(2);	
				 
				 $('#area_1').val(area_1);
				 $('#area_2').val(area_2);
				 $('#area_3').val(area_3);
				 $('#area_4').val(area_4);
				 $('#area_5').val(area_5);
				 $('#area_6').val(area_6);
				 $('#area_7').val(area_7);
				 $('#area_8').val(area_8);
			
			
			
			
				 lab_1 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 lab_2 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 lab_3 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 lab_4 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 lab_5 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 lab_6 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 lab_7 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 lab_8 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 $('#lab_1').val(lab_1);
				 $('#lab_2').val(lab_2);
				 $('#lab_3').val(lab_3);
				 $('#lab_4').val(lab_4);
				 $('#lab_5').val(lab_5);
				 $('#lab_6').val(lab_6);
				 $('#lab_7').val(lab_7);
				 $('#lab_8').val(lab_8);
				 
				 var l1 = $('#lab_1').val();
				 var l2 = $('#lab_2').val();
				 var l3 = $('#lab_3').val();
				 var l4 = $('#lab_4').val();
				 var l5 = $('#lab_5').val();
				 var l6 = $('#lab_6').val();
				 var l7 = $('#lab_7').val();
				 var l8 = $('#lab_8').val();
				 
				 
				 
				  var a1 = $('#area_1').val();
				 var a2 = $('#area_2').val();
				 var a3 = $('#area_3').val();
				 var a4 = $('#area_4').val();
				 var a5 = $('#area_5').val();
				 var a6 = $('#area_6').val();
				 var a7 = $('#area_7').val();
				 var a8 = $('#area_8').val();  
				 
				 var temp1 = (+a1) * (+l1);
				 var temp2 = (+a2) * (+l2);
				 var temp3 = (+a3) * (+l3);
				 var temp4 = (+a4) * (+l4);
				 var temp5 = (+a5) * (+l5);
				 var temp6 = (+a6) * (+l6);
				 var temp7 = (+a7) * (+l7);
				 var temp8 = (+a8) * (+l8);
				 
				 m1 = ((+temp1)/20000);
				 m2 = ((+temp2)/20000);
				 m3 = ((+temp3)/20000);
				 m4 = ((+temp4)/20000);
				 m5 = ((+temp5)/20000);
				 m6 = ((+temp6)/20000);
				 m7 = ((+temp7)/20000);
				 m8 = ((+temp8)/20000);
				 
				 $('#m1').val(m1.toFixed(1));
				 $('#m2').val(m2.toFixed(1));
				 $('#m3').val(m3.toFixed(1));
				 $('#m4').val(m4.toFixed(1));
				 $('#m5').val(m5.toFixed(1));
				 $('#m6').val(m6.toFixed(1));
				 $('#m7').val(m7.toFixed(1));
				 $('#m8').val(m8.toFixed(1));
			
			 // $('#factor_1').val(factor_1.toFixed(2));
		     // $('#factor_2').val(factor_2.toFixed(2));
		     // $('#factor_3').val(factor_3.toFixed(2));
		     // $('#factor_4').val(factor_4.toFixed(2));
		     // $('#factor_5').val(factor_5.toFixed(2));
		     // $('#factor_6').val(factor_6.toFixed(2));
		     // $('#factor_7').val(factor_7.toFixed(2));
		     // $('#factor_8').val(factor_8.toFixed(2));
			 
			 $('#den_1').val(den_1);
		     $('#den_2').val(den_2);
		     $('#den_3').val(den_3);
		     $('#den_4').val(den_4);
		     $('#den_5').val(den_5);
		     $('#den_6').val(den_6);
		     $('#den_7').val(den_7);
		     $('#den_8').val(den_8);
			 
			 avg_den = ((+den_1)+(+den_2)+(+den_3)+(+den_4)+(+den_5)+(+den_6)+(+den_7)+(+den_8))/8;			  
			 $('#avg_den').val(avg_den.toString().substring(0, avg_den.toString().indexOf(".") + 3));
			  
			
			
			
			 /* if(grade=="M-20")
			 {
				 avg_corr = parseFloat(randomNumberFromRange(21.00, 25.00)).toFixed(2);
			 }
			 else if(grade=="M-25")
			 {
				 avg_corr = parseFloat(randomNumberFromRange(26.00, 30.00)).toFixed(2);
			 }
			 else if(grade=="M-30")
			 {
				 avg_corr = parseFloat(randomNumberFromRange(31.00, 35.00)).toFixed(2);
			 } */
			  if(grade=="M-35")
			 {
				 avg_corr = parseFloat(randomNumberFromRange(35.00, 40.00)).toFixed(2);
			 }
			  else if(grade=="M-40")
			 {
				avg_corr = parseFloat(randomNumberFromRange(41.00, 45.00)).toFixed(2); 
			 }
			/* else if(grade=="M-45")
			 {
				avg_corr = parseFloat(randomNumberFromRange(46.00, 50.00)).toFixed(2); 
			 }
			 else if(grade=="M-50")
			 {
				avg_corr = parseFloat(randomNumberFromRange(51.00, 55.00)).toFixed(2); 
			 }
			 else if(grade=="M-55")
			 {
				avg_corr = parseFloat(randomNumberFromRange(56.00, 60.00)).toFixed(2); 
			 }
			 else if(grade=="M-60")
			 {
				avg_corr = parseFloat(randomNumberFromRange(61.00, 65.00)).toFixed(2); 
			 }
			  */
			 $('#avg_corr').val(avg_corr);		
			 var avg_corrr = $('#avg_corr').val();
			 var sd = randomNumberFromRange(1,9).toFixed();
			 if(sd%2==0)
			 {
				  corr_1 = (+avg_corrr) + 0.05;
				  corr_3 = (+avg_corrr) + 0.30;
				  corr_5 = (+avg_corrr) + 1.50;
				  corr_7 = (+avg_corrr) + 0.08;
				  corr_2 = (+avg_corrr) - 0.30;
				  corr_4 = (+avg_corrr) - 0.05;
				  corr_6 = (+avg_corrr) - 0.08;
				  corr_8 = (+avg_corrr) - 1.50;
			 }
			 else
			 {
				  corr_1 = (+avg_corrr) - 0.05;
				  corr_3 = (+avg_corrr) - 0.30;
				  corr_5 = (+avg_corrr) - 1.50;
				  corr_7 = (+avg_corrr) - 0.08;
				  corr_2 = (+avg_corrr) + 0.30;
				  corr_4 = (+avg_corrr) + 0.05;
				  corr_6 = (+avg_corrr) + 0.08;
				  corr_8 = (+avg_corrr) + 1.50;
			 }
			 
			  $('#corr_1').val(corr_1.toFixed(2));
			  $('#corr_2').val(corr_2.toFixed(2));
			  $('#corr_3').val(corr_3.toFixed(2));
			  $('#corr_4').val(corr_4.toFixed(2));
			  $('#corr_5').val(corr_5.toFixed(2));
			  $('#corr_6').val(corr_6.toFixed(2));
			  $('#corr_7').val(corr_7.toFixed(2));
			  $('#corr_8').val(corr_8.toFixed(2));
			 
			 var corrr_1 = $('#corr_1').val();
			 var corrr_2 = $('#corr_2').val();
			 var corrr_3 = $('#corr_3').val();
			 var corrr_4 = $('#corr_4').val();
			 var corrr_5 = $('#corr_5').val();
			 var corrr_6 = $('#corr_6').val();
			 var corrr_7 = $('#corr_7').val();
			 var corrr_8 = $('#corr_8').val();
			 
			  com_1 = (+corrr_1)/(+factor_1);
			  com_2 = (+corrr_2)/(+factor_2);
			  com_3 = (+corrr_3)/(+factor_3);
			  com_4 = (+corrr_4)/(+factor_4);
			  com_5 = (+corrr_5)/(+factor_5);
			  com_6 = (+corrr_6)/(+factor_6);
			  com_7 = (+corrr_7)/(+factor_7);
			  com_8 = (+corrr_8)/(+factor_8);
			 
			 $('#com_1').val(com_1.toFixed(2));
			 $('#com_2').val(com_2.toFixed(2));
			 $('#com_3').val(com_3.toFixed(2));
			 $('#com_4').val(com_4.toFixed(2));
			 $('#com_5').val(com_5.toFixed(2));
			 $('#com_6').val(com_6.toFixed(2));
			 $('#com_7').val(com_7.toFixed(2));
			 $('#com_8').val(com_8.toFixed(2));
			 
			 var comm_1 = $('#com_1').val();
			 var comm_2 = $('#com_2').val();
			 var comm_3 = $('#com_3').val();
			 var comm_4 = $('#com_4').val();
			 var comm_5 = $('#com_5').val();
			 var comm_6 = $('#com_6').val();
			 var comm_7 = $('#com_7').val();
			 var comm_8 = $('#com_8').val();
			 
			  load_1 = ((comm_1)*(+l1))/1000;
			  load_2 = ((comm_2)*(+l2))/1000;
			  load_3 = ((comm_3)*(+l3))/1000;
			  load_4 = ((comm_4)*(+l4))/1000;
			  load_5 = ((comm_5)*(+l5))/1000;
			  load_6 = ((comm_6)*(+l6))/1000;
			  load_7 = ((comm_7)*(+l7))/1000;
			  load_8 = ((comm_8)*(+l8))/1000;
			 
			  $('#load_1').val(load_1.toFixed(1));
			  $('#load_2').val(load_2.toFixed(1));
			  $('#load_3').val(load_3.toFixed(1));
			  $('#load_4').val(load_4.toFixed(1));
			  $('#load_5').val(load_5.toFixed(1));
			  $('#load_6').val(load_6.toFixed(1));
			  $('#load_7').val(load_7.toFixed(1));
			  $('#load_8').val(load_8.toFixed(1));
			  
			  var ww1 = $('#lab_1').val();
			  var ww2 = $('#lab_2').val();
			  var ww3 = $('#lab_3').val();
			  var ww4 = $('#lab_4').val();
			  var ww5 = $('#lab_5').val();
			  var ww6 = $('#lab_6').val();
			  var ww7 = $('#lab_7').val();
			  var ww8 = $('#lab_8').val();
			  
			  var mm1 = $('#m1').val();
			  var mm2 = $('#m2').val();
			  var mm3 = $('#m3').val();
			  var mm4 = $('#m4').val();
			  var mm5 = $('#m5').val();
			  var mm6 = $('#m6').val();
			  var mm7 = $('#m7').val();
			  var mm8 = $('#m8').val();
			  
			  var minus1 = (+mm1) * (+20000);
			  var minus2 = (+mm2) * (+20000);
			  var minus3 = (+mm3) * (+20000);
			  var minus4 = (+mm4) * (+20000);
			  var minus5 = (+mm5) * (+20000);
			  var minus6 = (+mm6) * (+20000);
			  var minus7 = (+mm7) * (+20000);
			  var minus8 = (+mm8) * (+20000);
			  
			  var area1 = ((+minus1) / (+ww1));
			  var area2 = ((+minus2) / (+ww2));
			  var area3 = ((+minus3) / (+ww3));
			  var area4 = ((+minus4) / (+ww4));
			  var area5 = ((+minus5) / (+ww5));
			  var area6 = ((+minus6) / (+ww6));
			  var area7 = ((+minus7) / (+ww7));
			  var area8 = ((+minus8) / (+ww8));
			  
			  $('#area_1').val(area1.toFixed());
			  $('#area_2').val(area2.toFixed());
			  $('#area_3').val(area3.toFixed());
			  $('#area_4').val(area4.toFixed());
			  $('#area_5').val(area5.toFixed());
			  $('#area_6').val(area6.toFixed());
			  $('#area_7').val(area7.toFixed());
			  $('#area_8').val(area8.toFixed());
			
		      var aa1 = $('#area_1').val();
			  var aa2 = $('#area_2').val();
			  var aa3 = $('#area_3').val();
			  var aa4 = $('#area_4').val();
			  var aa5 = $('#area_5').val();
			  var aa6 = $('#area_6').val();
			  var aa7 = $('#area_7').val();
			  var aa8 = $('#area_8').val();
			  
			  var load1 = $('#load_1').val();
			  var load2 = $('#load_2').val();
			  var load3 = $('#load_3').val();
			  var load4 = $('#load_4').val();
			  var load5 = $('#load_5').val();
			  var load6 = $('#load_6').val();
			  var load7 = $('#load_7').val();
			  var load8 = $('#load_8').val();
			  
			  var compres1 = ((+load1) * 1000) / (+aa1);
			  var compres2 = ((+load2) * 1000) / (+aa2);
			  var compres3 = ((+load3) * 1000) / (+aa3);
			  var compres4 = ((+load4) * 1000) / (+aa4);
			  var compres5 = ((+load5) * 1000) / (+aa5);
			  var compres6 = ((+load6) * 1000) / (+aa6);
			  var compres7 = ((+load7) * 1000) / (+aa7);
			  var compres8 = ((+load8) * 1000) / (+aa8);
			  
			 $('#com_1').val(compres1.toFixed(2));
			 $('#com_2').val(compres2.toFixed(2));
			 $('#com_3').val(compres3.toFixed(2));
			 $('#com_4').val(compres4.toFixed(2));
			 $('#com_5').val(compres5.toFixed(2));
			 $('#com_6').val(compres6.toFixed(2));
			 $('#com_7').val(compres7.toFixed(2));
			 $('#com_8').val(compres8.toFixed(2));
			 
			 var come_1 = $('#com_1').val();
			 var come_2 = $('#com_2').val();
			 var come_3 = $('#com_3').val();
			 var come_4 = $('#com_4').val();
			 var come_5 = $('#com_5').val();
			 var come_6 = $('#com_6').val();
			 var come_7 = $('#com_7').val();
			 var come_8 = $('#com_8').val();
			 
			 var corrw_1 = (+come_1)*(+factor_1);
			 var corrw_2 = (+come_2)*(+factor_2);
			 var corrw_3 = (+come_3)*(+factor_3);
			 var corrw_4 = (+come_4)*(+factor_4);
		     var corrw_5 = (+come_5)*(+factor_5);
		     var corrw_6 = (+come_6)*(+factor_6);
		     var corrw_7 = (+come_7)*(+factor_7);
			 var corrw_8 = (+come_8)*(+factor_8);
			 
			 
			  $('#corr_1').val(corrw_1.toFixed(2));
			  $('#corr_2').val(corrw_2.toFixed(2));
			  $('#corr_3').val(corrw_3.toFixed(2));
			  $('#corr_4').val(corrw_4.toFixed(2));
			  $('#corr_5').val(corrw_5.toFixed(2));
			  $('#corr_6').val(corrw_6.toFixed(2));
			  $('#corr_7').val(corrw_7.toFixed(2));
			  $('#corr_8').val(corrw_8.toFixed(2));
			  
			  var corr12_1 = $('#corr_1').val();
			  var corr12_2 = $('#corr_2').val();
			  var corr12_3 = $('#corr_3').val();
			  var corr12_4 = $('#corr_4').val();
			  var corr12_5 = $('#corr_5').val();
			  var corr12_6 = $('#corr_6').val();
			  var corr12_7 = $('#corr_7').val();
			  var corr12_8 = $('#corr_8').val();
			  
			  var ansf = ((+corr12_1) + (+corr12_2) + (+corr12_3) + (+corr12_4) + (+corr12_5) + (+corr12_6) + (+corr12_7) + (+corr12_8)) / 8;
			  $('#avg_corr').val(ansf.toFixed(2));
	}
	
	$('#chk_com').change(function(){
        if(this.checked)
		{ 
			check_com();
			  
		}
		else
		{
			$('#sm1').val(null);
			$('#sm2').val(null);
			$('#sm3').val(null);
			$('#sm4').val(null);
			$('#sm5').val(null);
			$('#sm6').val(null);
			$('#sm7').val(null);
			$('#sm8').val(null);
			$('#area_1').val(null);
			$('#area_2').val(null);
			$('#area_3').val(null);
		    $('#area_4').val(null);
		    $('#area_5').val(null);
		    $('#area_6').val(null);
		    $('#area_7').val(null);
		    $('#area_8').val(null);
		
			 $('#lab_1').val(null);
		     $('#lab_2').val(null);
		     $('#lab_3').val(null);
		     $('#lab_4').val(null);
		     $('#lab_5').val(null);
		     $('#lab_6').val(null);
		     $('#lab_7').val(null);
		     $('#lab_8').val(null);
			 
			 
			 $('#m1').val(null);
		     $('#m2').val(null);
		     $('#m3').val(null);
		     $('#m4').val(null);
		     $('#m5').val(null);
		     $('#m6').val(null);
		     $('#m7').val(null);
		     $('#m8').val(null);
		     $('#avg_den').val(null);
			 
			 $('#avg_corr').val(null);
			 $('#corr_1').val(null);
		     $('#corr_2').val(null);
		     $('#corr_3').val(null);
		     $('#corr_4').val(null);
		     $('#corr_5').val(null);
		     $('#corr_6').val(null);
		     $('#corr_7').val(null);
		     $('#corr_8').val(null);
			 
			 $('#com_1').val(null);
		     $('#com_2').val(null);
		     $('#com_3').val(null);
		     $('#com_4').val(null);
		     $('#com_5').val(null);
		     $('#com_6').val(null);
		     $('#com_7').val(null);
		     $('#com_8').val(null);
			 
			 $('#load_1').val(null);
		     $('#load_2').val(null);
		     $('#load_3').val(null);
		     $('#load_4').val(null);
		     $('#load_5').val(null);
		     $('#load_6').val(null);
		     $('#load_7').val(null);
		     $('#load_8').val(null);
		}
	});
	
	$('#corr_1').change(function(){
        
		coree();	
	});
	$('#corr_2').change(function(){
        
		coree();	
	});
	$('#corr_3').change(function(){
        
		coree();	
	});
	$('#corr_4').change(function(){
        
		coree();	
	});
	$('#corr_5').change(function(){
        
		coree();	
	});
	$('#corr_6').change(function(){
        
		coree();	
	});
	$('#corr_7').change(function(){
        
		coree();	
	});
	$('#corr_8').change(function(){
        
		coree();	
	});
	
	function coree()
	{
		$('#txtcom').css("background-color","var(--success)"); 
		 if ($("#chk_com").is(':checked')) {
		 factor_1 = parseFloat($('#factor_1').val()).toFixed(2); 
		 factor_2 = parseFloat($('#factor_2').val()).toFixed(2); 
		 factor_3 = parseFloat($('#factor_3').val()).toFixed(2); 
		 factor_4 = parseFloat($('#factor_4').val()).toFixed(2); 
		 factor_5 = parseFloat($('#factor_5').val()).toFixed(2); 
		 factor_6 = parseFloat($('#factor_6').val()).toFixed(2); 
		 factor_7 = parseFloat($('#factor_7').val()).toFixed(2); 
		 factor_8 = parseFloat($('#factor_8').val()).toFixed(2);
		 
		 corr_1 = parseFloat($('#corr_1').val()).toFixed(2); 
		 corr_2 = parseFloat($('#corr_2').val()).toFixed(2); 
		 corr_3 = parseFloat($('#corr_3').val()).toFixed(2); 
		 corr_4 = parseFloat($('#corr_4').val()).toFixed(2); 
		 corr_5 = parseFloat($('#corr_5').val()).toFixed(2); 
		 corr_6 = parseFloat($('#corr_6').val()).toFixed(2); 
		 corr_7 = parseFloat($('#corr_7').val()).toFixed(2); 
		 corr_8 = parseFloat($('#corr_8').val()).toFixed(2);
		 
		 area_1 = $('#area_1').val(); 
		 area_2 = $('#area_2').val(); 
		 area_3 = $('#area_3').val(); 
		 area_4 = $('#area_4').val(); 
		 area_5 = $('#area_5').val(); 
		 area_6 = $('#area_6').val(); 
		 area_7 = $('#area_7').val(); 
		 area_8 = $('#area_8').val();
		 
		 
		  com_1 = (+corr_1)/(+factor_1);
		  com_2 = (+corr_2)/(+factor_2);
		  com_3 = (+corr_3)/(+factor_3);
		  com_4 = (+corr_4)/(+factor_4);
		  com_5 = (+corr_5)/(+factor_5);
		  com_6 = (+corr_6)/(+factor_6);
		  com_7 = (+corr_7)/(+factor_7);
		  com_8 = (+corr_8)/(+factor_8);
		  
		 $('#com_1').val(com_1.toFixed(2));
		 $('#com_2').val(com_2.toFixed(2));
		 $('#com_3').val(com_3.toFixed(2));
		 $('#com_4').val(com_4.toFixed(2));
		 $('#com_5').val(com_5.toFixed(2));
		 $('#com_6').val(com_6.toFixed(2));
		 $('#com_7').val(com_7.toFixed(2));
		 $('#com_8').val(com_8.toFixed(2));
		 
		 var comm_1 = $('#com_1').val();
		 var comm_2 = $('#com_2').val();
		 var comm_3 = $('#com_3').val();
		 var comm_4 = $('#com_4').val();
		 var comm_5 = $('#com_5').val();
		 var comm_6 = $('#com_6').val();
		 var comm_7 = $('#com_7').val();
		 var comm_8 = $('#com_8').val();
		 
		  load_1 = ((comm_1)*(+area_1))/1000;
		  load_2 = ((comm_2)*(+area_2))/1000;
		  load_3 = ((comm_3)*(+area_3))/1000;
		  load_4 = ((comm_4)*(+area_4))/1000;
		  load_5 = ((comm_5)*(+area_5))/1000;
		  load_6 = ((comm_6)*(+area_6))/1000;
		  load_7 = ((comm_7)*(+area_7))/1000;
		  load_8 = ((comm_8)*(+area_8))/1000;
		  
		  
		  $('#load_1').val(load_1.toFixed(1));
		  $('#load_2').val(load_2.toFixed(1));
		  $('#load_3').val(load_3.toFixed(1));
		  $('#load_4').val(load_4.toFixed(1));
		  $('#load_5').val(load_5.toFixed(1));
		  $('#load_6').val(load_6.toFixed(1));
		  $('#load_7').val(load_7.toFixed(1));
		  $('#load_8').val(load_8.toFixed(1));
		  
		      var ww1 = $('#lab_1').val();
			  var ww2 = $('#lab_2').val();
			  var ww3 = $('#lab_3').val();
			  var ww4 = $('#lab_4').val();
			  var ww5 = $('#lab_5').val();
			  var ww6 = $('#lab_6').val();
			  var ww7 = $('#lab_7').val();
			  var ww8 = $('#lab_8').val();
			  
			  var mm1 = $('#m1').val();
			  var mm2 = $('#m2').val();
			  var mm3 = $('#m3').val();
			  var mm4 = $('#m4').val();
			  var mm5 = $('#m5').val();
			  var mm6 = $('#m6').val();
			  var mm7 = $('#m7').val();
			  var mm8 = $('#m8').val();
			  
			  var minus1 = (+mm1) * (+20000);
			  var minus2 = (+mm2) * (+20000);
			  var minus3 = (+mm3) * (+20000);
			  var minus4 = (+mm4) * (+20000);
			  var minus5 = (+mm5) * (+20000);
			  var minus6 = (+mm6) * (+20000);
			  var minus7 = (+mm7) * (+20000);
			  var minus8 = (+mm8) * (+20000);
			  
			  var area1 = ((+minus1) / (+ww1));
			  var area2 = ((+minus2) / (+ww2));
			  var area3 = ((+minus3) / (+ww3));
			  var area4 = ((+minus4) / (+ww4));
			  var area5 = ((+minus5) / (+ww5));
			  var area6 = ((+minus6) / (+ww6));
			  var area7 = ((+minus7) / (+ww7));
			  var area8 = ((+minus8) / (+ww8));
			  
			  $('#area_1').val(area1.toFixed());
			  $('#area_2').val(area2.toFixed());
			  $('#area_3').val(area3.toFixed());
			  $('#area_4').val(area4.toFixed());
			  $('#area_5').val(area5.toFixed());
			  $('#area_6').val(area6.toFixed());
			  $('#area_7').val(area7.toFixed());
			  $('#area_8').val(area8.toFixed());
			  
			 
			
		      var aa1 = $('#area_1').val();
			  var aa2 = $('#area_2').val();
			  var aa3 = $('#area_3').val();
			  var aa4 = $('#area_4').val();
			  var aa5 = $('#area_5').val();
			  var aa6 = $('#area_6').val();
			  var aa7 = $('#area_7').val();
			  var aa8 = $('#area_8').val();
			  
			  var load1 = $('#load_1').val();
			  var load2 = $('#load_2').val();
			  var load3 = $('#load_3').val();
			  var load4 = $('#load_4').val();
			  var load5 = $('#load_5').val();
			  var load6 = $('#load_6').val();
			  var load7 = $('#load_7').val();
			  var load8 = $('#load_8').val();
			  
			  var compres1 = ((+load1) * 1000) / (+aa1);
			  var compres2 = ((+load2) * 1000) / (+aa2);
			  var compres3 = ((+load3) * 1000) / (+aa3);
			  var compres4 = ((+load4) * 1000) / (+aa4);
			  var compres5 = ((+load5) * 1000) / (+aa5);
			  var compres6 = ((+load6) * 1000) / (+aa6);
			  var compres7 = ((+load7) * 1000) / (+aa7);
			  var compres8 = ((+load8) * 1000) / (+aa8);
			  
			 $('#com_1').val(compres1.toFixed(2));
			 $('#com_2').val(compres2.toFixed(2));
			 $('#com_3').val(compres3.toFixed(2));
			 $('#com_4').val(compres4.toFixed(2));
			 $('#com_5').val(compres5.toFixed(2));
			 $('#com_6').val(compres6.toFixed(2));
			 $('#com_7').val(compres7.toFixed(2));
			 $('#com_8').val(compres8.toFixed(2));
			 
			 var come_1 = $('#com_1').val();
			 var come_2 = $('#com_2').val();
			 var come_3 = $('#com_3').val();
			 var come_4 = $('#com_4').val();
			 var come_5 = $('#com_5').val();
			 var come_6 = $('#com_6').val();
			 var come_7 = $('#com_7').val();
			 var come_8 = $('#com_8').val();
			 
			 var corrw_1 = (+come_1)*(+factor_1);
			 var corrw_2 = (+come_2)*(+factor_2);
			 var corrw_3 = (+come_3)*(+factor_3);
			 var corrw_4 = (+come_4)*(+factor_4);
		     var corrw_5 = (+come_5)*(+factor_5);
		     var corrw_6 = (+come_6)*(+factor_6);
		     var corrw_7 = (+come_7)*(+factor_7);
			 var corrw_8 = (+come_8)*(+factor_8);
			 
			 
			  $('#corr_1').val(corrw_1.toFixed(2));
			  $('#corr_2').val(corrw_2.toFixed(2));
			  $('#corr_3').val(corrw_3.toFixed(2));
			  $('#corr_4').val(corrw_4.toFixed(2));
			  $('#corr_5').val(corrw_5.toFixed(2));
			  $('#corr_6').val(corrw_6.toFixed(2));
			  $('#corr_7').val(corrw_7.toFixed(2));
			  $('#corr_8').val(corrw_8.toFixed(2));
			  
			  var corr12_1 = $('#corr_1').val();
			  var corr12_2 = $('#corr_2').val();
			  var corr12_3 = $('#corr_3').val();
			  var corr12_4 = $('#corr_4').val();
			  var corr12_5 = $('#corr_5').val();
			  var corr12_6 = $('#corr_6').val();
			  var corr12_7 = $('#corr_7').val();
			  var corr12_8 = $('#corr_8').val();
			  
			  var ansf = ((+corr12_1) + (+corr12_2) + (+corr12_3) + (+corr12_4) + (+corr12_5) + (+corr12_6) + (+corr12_7) + (+corr12_8)) / 8;
			  $('#avg_corr').val(ansf.toFixed(2));
		  
		 var block_type = $('#block_type').val();
			var thickNess = $('#top_thickNess').val();
			if (block_type == "Chamfered Block") {
				if (thickNess == "50") {
					factor_1 = 1.03;
					factor_2 = 1.03;
					factor_3 = 1.03;
					factor_4 = 1.03;
					factor_5 = 1.03;
					factor_6 = 1.03;
					factor_7 = 1.03;
					factor_8 = 1.03;
				} else if (thickNess == "60") {
					factor_1 = 1.06;
					factor_2 = 1.06;
					factor_3 = 1.06;
					factor_4 = 1.06;
					factor_5 = 1.06;
					factor_6 = 1.06;
					factor_7 = 1.06;
					factor_8 = 1.06;
				} else if (thickNess == "75") {
					factor_1 = 1.18;
					factor_2 = 1.18;
					factor_3 = 1.18;
					factor_4 = 1.18;
					factor_5 = 1.18;
					factor_6 = 1.18;
					factor_7 = 1.18;
					factor_8 = 1.18;
				} else if (thickNess == "80") {
					factor_1 = 1.18;
					factor_2 = 1.18;
					factor_3 = 1.18;
					factor_4 = 1.18;
					factor_5 = 1.18;
					factor_6 = 1.18;
					factor_7 = 1.18;
					factor_8 = 1.18;
				} else if (thickNess == "100") {
					factor_1 = 1.24;
					factor_2 = 1.24;
					factor_3 = 1.24;
					factor_4 = 1.24;
					factor_5 = 1.24;
					factor_6 = 1.24;
					factor_7 = 1.24;
					factor_8 = 1.24;
				} else if (thickNess == "120") {
					factor_1 = 1.34;
					factor_2 = 1.34;
					factor_3 = 1.34;
					factor_4 = 1.34;
					factor_5 = 1.34;
					factor_6 = 1.34;
					factor_7 = 1.34;
					factor_8 = 1.34;
				}
			} else {
				if (thickNess == "50") {
					factor_1 = 0.96;
					factor_2 = 0.96;
					factor_3 = 0.96;
					factor_4 = 0.96;
					factor_5 = 0.96;
					factor_6 = 0.96;
					factor_7 = 0.96;
					factor_8 = 0.96;
				} else if (thickNess == "60") {
					factor_1 = 1.00;
					factor_2 = 1.00;
					factor_3 = 1.00;
					factor_4 = 1.00;
					factor_5 = 1.00;
					factor_6 = 1.00;
					factor_7 = 1.00;
					factor_8 = 1.00;
				} else if (thickNess == "75") {
					factor_1 = 1.12;
					factor_2 = 1.12;
					factor_3 = 1.12;
					factor_4 = 1.12;
					factor_5 = 1.12;
					factor_6 = 1.12;
					factor_7 = 1.12;
					factor_8 = 1.12;
				} else if (thickNess == "80") {
					factor_1 = 1.12;
					factor_2 = 1.12;
					factor_3 = 1.12;
					factor_4 = 1.12;
					factor_5 = 1.12;
					factor_6 = 1.12;
					factor_7 = 1.12;
					factor_8 = 1.12;
				} else if (thickNess == "100") {
					factor_1 = 1.18;
					factor_2 = 1.18;
					factor_3 = 1.18;
					factor_4 = 1.18;
					factor_5 = 1.18;
					factor_6 = 1.18;
					factor_7 = 1.18;
					factor_8 = 1.18;
				} else if (thickNess == "120") {
					factor_1 = 1.28;
					factor_2 = 1.28;
					factor_3 = 1.28;
					factor_4 = 1.28;
					factor_5 = 1.28;
					factor_6 = 1.28;
					factor_7 = 1.28;
					factor_8 = 1.28;
				}
			}
			
		$('#factor_1').val(factor_1);
		 $('#factor_2').val(factor_2);
		 $('#factor_3').val(factor_3);
		 $('#factor_4').val(factor_4);
		 $('#factor_5').val(factor_5);
		 $('#factor_6').val(factor_6);
		 $('#factor_7').val(factor_7);
		 $('#factor_8').val(factor_8);
			 
		 }   
			   
	}
	
	
	
	function area_load()
	{
			 area_1 = $('#area_1').val(); 
			 area_2 = $('#area_2').val(); 
			 area_3 = $('#area_3').val(); 
			 area_4 = $('#area_4').val(); 
			 area_5 = $('#area_5').val(); 
			 area_6 = $('#area_6').val(); 
			 area_7 = $('#area_7').val(); 
			 area_8 = $('#area_8').val(); 
			
			 load_1 = $('#load_1').val(); 
			 load_2 = $('#load_2').val(); 
			 load_3 = $('#load_3').val(); 
			 load_4 = $('#load_4').val(); 
			 load_5 = $('#load_5').val(); 
			 load_6 = $('#load_6').val(); 
			 load_7 = $('#load_7').val(); 
			 load_8 = $('#load_8').val();
			
			 com_1 = ((+load_1)/(+area_1))*1000;
			 com_2 = ((+load_2)/(+area_2))*1000;
			 com_3 = ((+load_3)/(+area_3))*1000;
			 com_4 = ((+load_4)/(+area_4))*1000;
			 com_5 = ((+load_5)/(+area_5))*1000;
			 com_6 = ((+load_6)/(+area_6))*1000;
			 com_7 = ((+load_7)/(+area_7))*1000;
			 com_8 = ((+load_8)/(+area_8))*1000;
			
			 $('#com_1').val(com_1.toFixed(2));
			 $('#com_2').val(com_2.toFixed(2));
			 $('#com_3').val(com_3.toFixed(2));
			 $('#com_4').val(com_4.toFixed(2));
			 $('#com_5').val(com_5.toFixed(2));
			 $('#com_6').val(com_6.toFixed(2));
			 $('#com_7').val(com_7.toFixed(2));
			 $('#com_8').val(com_8.toFixed(2));
			 
			  var comm_1 = $('#com_1').val();
			 var comm_2 = $('#com_2').val();
			 var comm_3 = $('#com_3').val();
			 var comm_4 = $('#com_4').val();
			 var comm_5 = $('#com_5').val();
			 var comm_6 = $('#com_6').val();
			 var comm_7 = $('#com_7').val();
			 var comm_8 = $('#com_8').val();
			 
			 factor_1 = $('#factor_1').val(); 
			 factor_2 = $('#factor_2').val(); 
			 factor_3 = $('#factor_3').val(); 
			 factor_4 = $('#factor_4').val(); 
			 factor_5 = $('#factor_5').val(); 
			 factor_6 = $('#factor_6').val(); 
			 factor_7 = $('#factor_7').val(); 
			 factor_8 = $('#factor_8').val();
			 
			 corr_1 = (+comm_1) * (+factor_1);
			 corr_2 = (+comm_2) * (+factor_2);
			 corr_3 = (+comm_3) * (+factor_3);
			 corr_4 = (+comm_4) * (+factor_4);
			 corr_5 = (+comm_5) * (+factor_5);
			 corr_6 = (+comm_6) * (+factor_6);
			 corr_7 = (+comm_7) * (+factor_7);
			 corr_8 = (+comm_8) * (+factor_8);
			
			 $('#corr_1').val(corr_1.toFixed(2));
			 $('#corr_2').val(corr_2.toFixed(2));
			 $('#corr_3').val(corr_3.toFixed(2));
			 $('#corr_4').val(corr_4.toFixed(2));
			 $('#corr_5').val(corr_5.toFixed(2));
			 $('#corr_6').val(corr_6.toFixed(2));
			 $('#corr_7').val(corr_7.toFixed(2));
			 $('#corr_8').val(corr_8.toFixed(2));
			 
			 corrr_1 = $('#corr_1').val(); 
			 corrr_2 = $('#corr_2').val(); 
			 corrr_3 = $('#corr_3').val(); 
			 corrr_4 = $('#corr_4').val(); 
			 corrr_5 = $('#corr_5').val(); 
			 corrr_6 = $('#corr_6').val(); 
			 corrr_7 = $('#corr_7').val(); 
			 corrr_8 = $('#corr_8').val();
			 
			 avg_corr = ((+corrr_1)+(+corrr_2)+(+corrr_3)+(+corrr_4)+(+corrr_5)+(+corrr_6)+(+corrr_7)+(+corrr_8))/8;
		
			 $('#avg_corr').val(avg_corr.toFixed(2));
		 	var block_type = $('#block_type').val();
			var thickNess = $('#top_thickNess').val();
			if (block_type == "Chamfered Block") {
				if (thickNess == "50") {
					factor_1 = 1.03;
					factor_2 = 1.03;
					factor_3 = 1.03;
					factor_4 = 1.03;
					factor_5 = 1.03;
					factor_6 = 1.03;
					factor_7 = 1.03;
					factor_8 = 1.03;
				} else if (thickNess == "60") {
					factor_1 = 1.06;
					factor_2 = 1.06;
					factor_3 = 1.06;
					factor_4 = 1.06;
					factor_5 = 1.06;
					factor_6 = 1.06;
					factor_7 = 1.06;
					factor_8 = 1.06;
				} else if (thickNess == "75") {
					factor_1 = 1.18;
					factor_2 = 1.18;
					factor_3 = 1.18;
					factor_4 = 1.18;
					factor_5 = 1.18;
					factor_6 = 1.18;
					factor_7 = 1.18;
					factor_8 = 1.18;
				} else if (thickNess == "80") {
					factor_1 = 1.18;
					factor_2 = 1.18;
					factor_3 = 1.18;
					factor_4 = 1.18;
					factor_5 = 1.18;
					factor_6 = 1.18;
					factor_7 = 1.18;
					factor_8 = 1.18;
				} else if (thickNess == "100") {
					factor_1 = 1.24;
					factor_2 = 1.24;
					factor_3 = 1.24;
					factor_4 = 1.24;
					factor_5 = 1.24;
					factor_6 = 1.24;
					factor_7 = 1.24;
					factor_8 = 1.24;
				} else if (thickNess == "120") {
					factor_1 = 1.34;
					factor_2 = 1.34;
					factor_3 = 1.34;
					factor_4 = 1.34;
					factor_5 = 1.34;
					factor_6 = 1.34;
					factor_7 = 1.34;
					factor_8 = 1.34;
				}
			} else {
				if (thickNess == "50") {
					factor_1 = 0.96;
					factor_2 = 0.96;
					factor_3 = 0.96;
					factor_4 = 0.96;
					factor_5 = 0.96;
					factor_6 = 0.96;
					factor_7 = 0.96;
					factor_8 = 0.96;
				} else if (thickNess == "60") {
					factor_1 = 1.00;
					factor_2 = 1.00;
					factor_3 = 1.00;
					factor_4 = 1.00;
					factor_5 = 1.00;
					factor_6 = 1.00;
					factor_7 = 1.00;
					factor_8 = 1.00;
				} else if (thickNess == "75") {
					factor_1 = 1.12;
					factor_2 = 1.12;
					factor_3 = 1.12;
					factor_4 = 1.12;
					factor_5 = 1.12;
					factor_6 = 1.12;
					factor_7 = 1.12;
					factor_8 = 1.12;
				} else if (thickNess == "80") {
					factor_1 = 1.12;
					factor_2 = 1.12;
					factor_3 = 1.12;
					factor_4 = 1.12;
					factor_5 = 1.12;
					factor_6 = 1.12;
					factor_7 = 1.12;
					factor_8 = 1.12;
				} else if (thickNess == "100") {
					factor_1 = 1.18;
					factor_2 = 1.18;
					factor_3 = 1.18;
					factor_4 = 1.18;
					factor_5 = 1.18;
					factor_6 = 1.18;
					factor_7 = 1.18;
					factor_8 = 1.18;
				} else if (thickNess == "120") {
					factor_1 = 1.28;
					factor_2 = 1.28;
					factor_3 = 1.28;
					factor_4 = 1.28;
					factor_5 = 1.28;
					factor_6 = 1.28;
					factor_7 = 1.28;
					factor_8 = 1.28;
				}
			}
			
		$('#factor_1').val(factor_1);
		 $('#factor_2').val(factor_2);
		 $('#factor_3').val(factor_3);
		 $('#factor_4').val(factor_4);
		 $('#factor_5').val(factor_5);
		 $('#factor_6').val(factor_6);
		 $('#factor_7').val(factor_7);
		 $('#factor_8').val(factor_8);
	}
	
	
	
	$('#avg_corr').change(function(){
        $('#txtcom').css("background-color","var(--success)"); 
		 if ($("#chk_com").is(':checked')) {
		thickNess  = $('#top_thickNess').val();
			 grade  = $('#top_grade').val();
			 shape  = $('#top_shape').val();
		     $('#thick_1').val(thickNess);
		     $('#thick_2').val(thickNess);
		     $('#thick_3').val(thickNess);
		     $('#thick_4').val(thickNess);
		     $('#thick_5').val(thickNess);
		     $('#thick_6').val(thickNess);
		     $('#thick_7').val(thickNess);
		     $('#thick_8').val(thickNess);
			 
		     $('#grade_1').val(grade);
		     $('#grade_2').val(grade);
		     $('#grade_3').val(grade);
		     $('#grade_4').val(grade);
		     $('#grade_5').val(grade);
		     $('#grade_6').val(grade);
		     $('#grade_7').val(grade);
		     $('#grade_8').val(grade);
			
			
			 if(grade=="M-20")
			 {
					 den_1 = parseInt(randomNumberFromRange(4200,5000));
					 den_2 = parseInt(randomNumberFromRange(4200,5000));
					 den_3 = parseInt(randomNumberFromRange(4200,5000));
					 den_4 = parseInt(randomNumberFromRange(4200,5000));
					 den_5 = parseInt(randomNumberFromRange(4200,5000));
					 den_6 = parseInt(randomNumberFromRange(4200,5000));
					 den_7 = parseInt(randomNumberFromRange(4200,5000));
					 den_8 = parseInt(randomNumberFromRange(4200,5000));					 
			 }
			 else if(grade=="M-25")
			 {
					 den_1 = parseInt(randomNumberFromRange(4800,5600));
					 den_2 = parseInt(randomNumberFromRange(4800,5600));
					 den_3 = parseInt(randomNumberFromRange(4800,5600));
					 den_4 = parseInt(randomNumberFromRange(4800,5600));
					 den_5 = parseInt(randomNumberFromRange(4800,5600));
					 den_6 = parseInt(randomNumberFromRange(4800,5600));
					 den_7 = parseInt(randomNumberFromRange(4800,5600));
					 den_8 = parseInt(randomNumberFromRange(4800,5600));
					 den_9 = parseInt(randomNumberFromRange(4800,5600));
			 }
			 else if(grade=="M-30")
			 {
					 den_1 = parseInt(randomNumberFromRange(5300,6000));
					 den_2 = parseInt(randomNumberFromRange(5300,6000));
					 den_3 = parseInt(randomNumberFromRange(5300,6000));
					 den_4 = parseInt(randomNumberFromRange(5300,6000));
					 den_5 = parseInt(randomNumberFromRange(5300,6000));
					 den_6 = parseInt(randomNumberFromRange(5300,6000));
					 den_7 = parseInt(randomNumberFromRange(5300,6000));
					 den_8 = parseInt(randomNumberFromRange(5300,6000));
			 }
			 else if(grade=="M-35")
			 {
					 den_1 = parseInt(randomNumberFromRange(5700,6200));
					 den_2 = parseInt(randomNumberFromRange(5700,6200));
					 den_3 = parseInt(randomNumberFromRange(5700,6200));
					 den_4 = parseInt(randomNumberFromRange(5700,6200));
					 den_5 = parseInt(randomNumberFromRange(5700,6200));
					 den_6 = parseInt(randomNumberFromRange(5700,6200));
					 den_7 = parseInt(randomNumberFromRange(5700,6200));
					 den_8 = parseInt(randomNumberFromRange(5700,6200));
			 }
			 else if(grade=="M-40")
			 {
					 den_1 = parseInt(randomNumberFromRange(6000,6400));
					 den_2 = parseInt(randomNumberFromRange(6000,6400));
					 den_3 = parseInt(randomNumberFromRange(6000,6400));
					 den_4 = parseInt(randomNumberFromRange(6000,6400));
					 den_5 = parseInt(randomNumberFromRange(6000,6400));
					 den_6 = parseInt(randomNumberFromRange(6000,6400));
					 den_7 = parseInt(randomNumberFromRange(6000,6400));
					 den_8 = parseInt(randomNumberFromRange(6000,6400));
			 }
			 else if(grade=="M-45")
			 {
					 den_1 = parseInt(randomNumberFromRange(6300,6800));
					 den_2 = parseInt(randomNumberFromRange(6300,6800));
					 den_3 = parseInt(randomNumberFromRange(6300,6800));
					 den_4 = parseInt(randomNumberFromRange(6300,6800));
					 den_5 = parseInt(randomNumberFromRange(6300,6800));
					 den_6 = parseInt(randomNumberFromRange(6300,6800));
					 den_7 = parseInt(randomNumberFromRange(6300,6800));
					 den_8 = parseInt(randomNumberFromRange(6300,6800));
			 }
			 else if(grade=="M-50")
			 {
					 den_1 = parseInt(randomNumberFromRange(6860,7500));
					 den_2 = parseInt(randomNumberFromRange(6860,7500));
					 den_3 = parseInt(randomNumberFromRange(6860,7500));
					 den_4 = parseInt(randomNumberFromRange(6860,7500));
					 den_5 = parseInt(randomNumberFromRange(6860,7500));
					 den_6 = parseInt(randomNumberFromRange(6860,7500));
					 den_7 = parseInt(randomNumberFromRange(6860,7500));
					 den_8 = parseInt(randomNumberFromRange(6860,7500));
			 }
			 else if(grade=="M-55")
			 {
					 den_1 = parseInt(randomNumberFromRange(7200,8000));
					 den_2 = parseInt(randomNumberFromRange(7200,8000));
					 den_3 = parseInt(randomNumberFromRange(7200,8000));
					 den_4 = parseInt(randomNumberFromRange(7200,8000));
					 den_5 = parseInt(randomNumberFromRange(7200,8000));
					 den_6 = parseInt(randomNumberFromRange(7200,8000));
					 den_7 = parseInt(randomNumberFromRange(7200,8000));
					 den_8 = parseInt(randomNumberFromRange(7200,8000));
			 }
			 else if(grade=="M-60")
			 {
					 den_1 = parseInt(randomNumberFromRange(7600,8500));
					 den_2 = parseInt(randomNumberFromRange(7600,8500));
					 den_3 = parseInt(randomNumberFromRange(7600,8500));
					 den_4 = parseInt(randomNumberFromRange(7600,8500));
					 den_5 = parseInt(randomNumberFromRange(7600,8500));
					 den_6 = parseInt(randomNumberFromRange(7600,8500));
					 den_7 = parseInt(randomNumberFromRange(7600,8500));
					 den_8 = parseInt(randomNumberFromRange(7600,8500));
			 }
				
			
			var ar1 = $('#ar1').val();
			var ar2 = $('#ar2').val();


			if(shape=="i_shape")
			 {
				 
				 
				 area_1 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_2 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_3 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_4 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_5 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_6 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_7 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_8 = randomNumberFromRange((+ar1),(+ar2)).toFixed();	
				 
				 $('#area_1').val(area_1);
				 $('#area_2').val(area_2);
				 $('#area_3').val(area_3);
				 $('#area_4').val(area_4);
				 $('#area_5').val(area_5);
				 $('#area_6').val(area_6);
				 $('#area_7').val(area_7);
				 $('#area_8').val(area_8);
				
				if(thickNess=="50")
				{
					 factor_1 = 1.03;
					 factor_2 = 1.03;
					 factor_3 = 1.03;
					 factor_4 = 1.03;
					 factor_5 = 1.03;
					 factor_6 = 1.03;
					 factor_7 = 1.03;
					 factor_8 = 1.03;
				}
				else if(thickNess=="60")
				{
					 factor_1 = 1.06;
					 factor_2 = 1.06;
					 factor_3 = 1.06;
					 factor_4 = 1.06;
					 factor_5 = 1.06;
					 factor_6 = 1.06;
					 factor_7 = 1.06;
					 factor_8 = 1.06;
					 
					  lab_1 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_2 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_3 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_4 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_5 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_6 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_7 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_8 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 $('#lab_1').val(lab_1);
					 $('#lab_2').val(lab_2);
					 $('#lab_3').val(lab_3);
					 $('#lab_4').val(lab_4);
					 $('#lab_5').val(lab_5);
					 $('#lab_6').val(lab_6);
					 $('#lab_7').val(lab_7);
					 $('#lab_8').val(lab_8);
					 
					 var l1 = $('#lab_1').val();
					 var l2 = $('#lab_2').val();
					 var l3 = $('#lab_3').val();
					 var l4 = $('#lab_4').val();
					 var l5 = $('#lab_5').val();
					 var l6 = $('#lab_6').val();
					 var l7 = $('#lab_7').val();
					 var l8 = $('#lab_8').val();
					 
					 
					 
					  var a1 = $('#area_1').val();
					 var a2 = $('#area_2').val();
					 var a3 = $('#area_3').val();
					 var a4 = $('#area_4').val();
					 var a5 = $('#area_5').val();
					 var a6 = $('#area_6').val();
					 var a7 = $('#area_7').val();
					 var a8 = $('#area_8').val();  
					 
					 var temp1 = (+a1) * (+l1);
					 var temp2 = (+a2) * (+l2);
					 var temp3 = (+a3) * (+l3);
					 var temp4 = (+a4) * (+l4);
					 var temp5 = (+a5) * (+l5);
					 var temp6 = (+a6) * (+l6);
					 var temp7 = (+a7) * (+l7);
					 var temp8 = (+a8) * (+l8);
					 
					 m1 = ((+temp1)/20000);
					 m2 = ((+temp2)/20000);
					 m3 = ((+temp3)/20000);
					 m4 = ((+temp4)/20000);
					 m5 = ((+temp5)/20000);
					 m6 = ((+temp6)/20000);
					 m7 = ((+temp7)/20000);
					 m8 = ((+temp8)/20000);
					 
					 $('#m1').val(m1.toFixed(1));
					 $('#m2').val(m2.toFixed(1));
					 $('#m3').val(m3.toFixed(1));
					 $('#m4').val(m4.toFixed(1));
					 $('#m5').val(m5.toFixed(1));
					 $('#m6').val(m6.toFixed(1));
					 $('#m7').val(m7.toFixed(1));
					 $('#m8').val(m8.toFixed(1));
				}
				else if(thickNess=="80")
				{
					 factor_1 = 1.18;
					 factor_2 = 1.18;
					 factor_3 = 1.18;
					 factor_4 = 1.18;
					 factor_5 = 1.18;
					 factor_6 = 1.18;
					 factor_7 = 1.18;
					 factor_8 = 1.18;
				}
				else if(thickNess=="100")
				{
					 factor_1 = 1.24;
					 factor_2 = 1.24;
					 factor_3 = 1.24;
					 factor_4 = 1.24;
					 factor_5 = 1.24;
					 factor_6 = 1.24;
					 factor_7 = 1.24;
					 factor_8 = 1.24;
				}
				else if(thickNess=="120")
				{
					 factor_1 = 1.34;
					 factor_2 = 1.34;
					 factor_3 = 1.34;
					 factor_4 = 1.34;
					 factor_5 = 1.34;
					 factor_6 = 1.34;
					 factor_7 = 1.34;
					 factor_8 = 1.34;
				}
				 
			 }
			 else if(shape=="zigzag")
			 {
				 
				 area_1 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_2 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_3 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_4 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_5 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_6 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_7 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_8 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				
				 $('#area_1').val(area_1);
				 $('#area_2').val(area_2);
				 $('#area_3').val(area_3);
				 $('#area_4').val(area_4);
				 $('#area_5').val(area_5);
				 $('#area_6').val(area_6);
				 $('#area_7').val(area_7);
				 $('#area_8').val(area_8);
				
				
				 
				 if(thickNess=="50")
				{
					factor_1 = 1.03;
					factor_2 = 1.03;
					factor_3 = 1.03;
					factor_4 = 1.03;
					factor_5 = 1.03;
					factor_6 = 1.03;
					factor_7 = 1.03;
					factor_8 = 1.03;
				}
				else if(thickNess=="60")
				{
					 factor_1 = 1.06;
					 factor_2 = 1.06;
					 factor_3 = 1.06;
					 factor_4 = 1.06;
					 factor_5 = 1.06;
					 factor_6 = 1.06;
					 factor_7 = 1.06;
					 factor_8 = 1.06;
					 
					 lab_1 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_2 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_3 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_4 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_5 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_6 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_7 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_8 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 $('#lab_1').val(lab_1);
					 $('#lab_2').val(lab_2);
					 $('#lab_3').val(lab_3);
					 $('#lab_4').val(lab_4);
					 $('#lab_5').val(lab_5);
					 $('#lab_6').val(lab_6);
					 $('#lab_7').val(lab_7);
					 $('#lab_8').val(lab_8);
					 
					 var l1 = $('#lab_1').val();
					 var l2 = $('#lab_2').val();
					 var l3 = $('#lab_3').val();
					 var l4 = $('#lab_4').val();
					 var l5 = $('#lab_5').val();
					 var l6 = $('#lab_6').val();
					 var l7 = $('#lab_7').val();
					 var l8 = $('#lab_8').val();
					 
					 
					 
					  var a1 = $('#area_1').val();
					 var a2 = $('#area_2').val();
					 var a3 = $('#area_3').val();
					 var a4 = $('#area_4').val();
					 var a5 = $('#area_5').val();
					 var a6 = $('#area_6').val();
					 var a7 = $('#area_7').val();
					 var a8 = $('#area_8').val();  
					 
					 var temp1 = (+a1) * (+l1);
					 var temp2 = (+a2) * (+l2);
					 var temp3 = (+a3) * (+l3);
					 var temp4 = (+a4) * (+l4);
					 var temp5 = (+a5) * (+l5);
					 var temp6 = (+a6) * (+l6);
					 var temp7 = (+a7) * (+l7);
					 var temp8 = (+a8) * (+l8);
					 
					 m1 = ((+temp1)/20000);
					 m2 = ((+temp2)/20000);
					 m3 = ((+temp3)/20000);
					 m4 = ((+temp4)/20000);
					 m5 = ((+temp5)/20000);
					 m6 = ((+temp6)/20000);
					 m7 = ((+temp7)/20000);
					 m8 = ((+temp8)/20000);
					 
					 $('#m1').val(m1.toFixed(2));
					 $('#m2').val(m2.toFixed(2));
					 $('#m3').val(m3.toFixed(2));
					 $('#m4').val(m4.toFixed(2));
					 $('#m5').val(m5.toFixed(2));
					 $('#m6').val(m6.toFixed(2));
					 $('#m7').val(m7.toFixed(2));
					 $('#m8').val(m8.toFixed(2));
					 
				}
				else if(thickNess=="80")
				{
					 factor_1 = 1.18;
					 factor_2 = 1.18;
					 factor_3 = 1.18;
					 factor_4 = 1.18;
					 factor_5 = 1.18;
					 factor_6 = 1.18;
					 factor_7 = 1.18;
					 factor_8 = 1.18;
					 
					 lab_1 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 lab_2 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 lab_3 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 lab_4 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 lab_5 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 lab_6 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 lab_7 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 lab_8 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 $('#lab_1').val(lab_1);
					 $('#lab_2').val(lab_2);
					 $('#lab_3').val(lab_3);
					 $('#lab_4').val(lab_4);
					 $('#lab_5').val(lab_5);
					 $('#lab_6').val(lab_6);
					 $('#lab_7').val(lab_7);
					 $('#lab_8').val(lab_8);
					 
					 var l1 = $('#lab_1').val();
					 var l2 = $('#lab_2').val();
					 var l3 = $('#lab_3').val();
					 var l4 = $('#lab_4').val();
					 var l5 = $('#lab_5').val();
					 var l6 = $('#lab_6').val();
					 var l7 = $('#lab_7').val();
					 var l8 = $('#lab_8').val();
					 
					 
					 
					  var a1 = $('#area_1').val();
					 var a2 = $('#area_2').val();
					 var a3 = $('#area_3').val();
					 var a4 = $('#area_4').val();
					 var a5 = $('#area_5').val();
					 var a6 = $('#area_6').val();
					 var a7 = $('#area_7').val();
					 var a8 = $('#area_8').val();  
					 
					 var temp1 = (+a1) * (+l1);
					 var temp2 = (+a2) * (+l2);
					 var temp3 = (+a3) * (+l3);
					 var temp4 = (+a4) * (+l4);
					 var temp5 = (+a5) * (+l5);
					 var temp6 = (+a6) * (+l6);
					 var temp7 = (+a7) * (+l7);
					 var temp8 = (+a8) * (+l8);
					 
					 m1 = ((+temp1)/20000);
					 m2 = ((+temp2)/20000);
					 m3 = ((+temp3)/20000);
					 m4 = ((+temp4)/20000);
					 m5 = ((+temp5)/20000);
					 m6 = ((+temp6)/20000);
					 m7 = ((+temp7)/20000);
					 m8 = ((+temp8)/20000);
					 
					  $('#m1').val(m1.toFixed(2));
					 $('#m2').val(m2.toFixed(2));
					 $('#m3').val(m3.toFixed(2));
					 $('#m4').val(m4.toFixed(2));
					 $('#m5').val(m5.toFixed(2));
					 $('#m6').val(m6.toFixed(2));
					 $('#m7').val(m7.toFixed(2));
					 $('#m8').val(m8.toFixed(2));
					 
				}
				else if(thickNess=="100")
				{
					 factor_1 = 1.24;
					 factor_2 = 1.24;
					 factor_3 = 1.24;
					 factor_4 = 1.24;
					 factor_5 = 1.24;
					 factor_6 = 1.24;
					 factor_7 = 1.24;
					 factor_8 = 1.24;
				}
				else if(thickNess=="120")
				{
					 factor_1 = 1.34;
					 factor_2 = 1.34;
					 factor_3 = 1.34;
					 factor_4 = 1.34;
					 factor_5 = 1.34;
					 factor_6 = 1.34;
					 factor_7 = 1.34;
					 factor_8 = 1.34;
				}
			 }
			 else if(shape=="damru")
			 {
				 
				 area_1 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_2 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_3 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_4 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_5 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_6 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_7 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_8 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 
				 if(thickNess=="50")
				{
					 factor_1 = 1.03;
					 factor_2 = 1.03;
					 factor_3 = 1.03;
					 factor_4 = 1.03;
					 factor_5 = 1.03;
					 factor_6 = 1.03;
					 factor_7 = 1.03;
					 factor_8 = 1.03;
				}
				else if(thickNess=="60")
				{
					 factor_1 = 1.06;
					 factor_2 = 1.06;
					 factor_3 = 1.06;
					 factor_4 = 1.06;
					 factor_5 = 1.06;
					 factor_6 = 1.06;
					 factor_7 = 1.06;
					 factor_8 = 1.06;
				}
				else if(thickNess=="80")
				{
					 factor_1 = 1.18;
					 factor_2 = 1.18;
					 factor_3 = 1.18;
					 factor_4 = 1.18;
					 factor_5 = 1.18;
					 factor_6 = 1.18;
					 factor_7 = 1.18;
					 factor_8 = 1.18;
				}
				else if(thickNess=="100")
				{
					 factor_1 = 1.24;
					 factor_2 = 1.24;
					 factor_3 = 1.24;
					 factor_4 = 1.24;
					 factor_5 = 1.24;
					 factor_6 = 1.24;
					 factor_7 = 1.24;
					 factor_8 = 1.24;
				}
				else if(thickNess=="120")
				{
					 factor_1 = 1.34;
					 factor_2 = 1.34;
					 factor_3 = 1.34;
					 factor_4 = 1.34;
					 factor_5 = 1.34;
					 factor_6 = 1.34;
					 factor_7 = 1.34;
					 factor_8 = 1.34;
				}
			 }
			 else if(shape=="plain")
			 {
			
				  area_1 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_2 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_3 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_4 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_5 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_6 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_7 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				 area_8 = randomNumberFromRange((+ar1),(+ar2)).toFixed();
				
				 $('#area_1').val(area_1);
				 $('#area_2').val(area_2);
				 $('#area_3').val(area_3);
				 $('#area_4').val(area_4);
				 $('#area_5').val(area_5);
				 $('#area_6').val(area_6);
				 $('#area_7').val(area_7);
				 $('#area_8').val(area_8);
				 
				 if(thickNess=="50")
				{
					 factor_1 = 0.96;
					 factor_2 = 0.96;
					 factor_3 = 0.96;
					 factor_4 = 0.96;
					 factor_5 = 0.96;
					 factor_6 = 0.96;
					 factor_7 = 0.96;
					 factor_8 = 0.96;
				}
				else if(thickNess=="60")
				{
					 factor_1 = 1.00;
					 factor_2 = 1.00;
					 factor_3 = 1.00;
					 factor_4 = 1.00;
					 factor_5 = 1.00;
					 factor_6 = 1.00;
					 factor_7 = 1.00;
					 factor_8 = 1.00;
					 
				 lab_1 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_2 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_3 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_4 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_5 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_6 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_7 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
				 lab_8 = parseFloat(randomNumberFromRange(46.90, 47.30)).toFixed(2);
					 $('#lab_1').val(lab_1);
					 $('#lab_2').val(lab_2);
					 $('#lab_3').val(lab_3);
					 $('#lab_4').val(lab_4);
					 $('#lab_5').val(lab_5);
					 $('#lab_6').val(lab_6);
					 $('#lab_7').val(lab_7);
					 $('#lab_8').val(lab_8);
					 
					 var l1 = $('#lab_1').val();
					 var l2 = $('#lab_2').val();
					 var l3 = $('#lab_3').val();
					 var l4 = $('#lab_4').val();
					 var l5 = $('#lab_5').val();
					 var l6 = $('#lab_6').val();
					 var l7 = $('#lab_7').val();
					 var l8 = $('#lab_8').val();
					 
					 
					 
					  var a1 = $('#area_1').val();
					 var a2 = $('#area_2').val();
					 var a3 = $('#area_3').val();
					 var a4 = $('#area_4').val();
					 var a5 = $('#area_5').val();
					 var a6 = $('#area_6').val();
					 var a7 = $('#area_7').val();
					 var a8 = $('#area_8').val();  
					 
					 var temp1 = (+a1) * (+l1);
					 var temp2 = (+a2) * (+l2);
					 var temp3 = (+a3) * (+l3);
					 var temp4 = (+a4) * (+l4);
					 var temp5 = (+a5) * (+l5);
					 var temp6 = (+a6) * (+l6);
					 var temp7 = (+a7) * (+l7);
					 var temp8 = (+a8) * (+l8);
					 
					 m1 = ((+temp1)/20000);
					 m2 = ((+temp2)/20000);
					 m3 = ((+temp3)/20000);
					 m4 = ((+temp4)/20000);
					 m5 = ((+temp5)/20000);
					 m6 = ((+temp6)/20000);
					 m7 = ((+temp7)/20000);
					 m8 = ((+temp8)/20000);
					 
					  $('#m1').val(m1.toFixed(2));
					 $('#m2').val(m2.toFixed(2));
					 $('#m3').val(m3.toFixed(2));
					 $('#m4').val(m4.toFixed(2));
					 $('#m5').val(m5.toFixed(2));
					 $('#m6').val(m6.toFixed(2));
					 $('#m7').val(m7.toFixed(2));
					 $('#m8').val(m8.toFixed(2));
				}
				else if(thickNess=="80")
				{
					 factor_1 = 1.12;
					 factor_2 = 1.12;
					 factor_3 = 1.12;
					 factor_4 = 1.12;
					 factor_5 = 1.12;
					 factor_6 = 1.12;
					 factor_7 = 1.12;
					 factor_8 = 1.12;
				}
				else if(thickNess=="100")
				{
					 factor_1 = 1.18;
					 factor_2 = 1.18;
					 factor_3 = 1.18;
					 factor_4 = 1.18;
					 factor_5 = 1.18;
					 factor_6 = 1.18;
					 factor_7 = 1.18;
					 factor_8 = 1.18;
				}
				else if(thickNess=="120")
				{
					 factor_1 = 1.28;
					 factor_2 = 1.28;
					 factor_3 = 1.28;
					 factor_4 = 1.28;
					 factor_5 = 1.28;
					 factor_6 = 1.28;
					 factor_7 = 1.28;
					 factor_8 = 1.28;
				}
			 }
			
			 $('#factor_1').val(factor_1.toFixed(2));
		     $('#factor_2').val(factor_2.toFixed(2));
		     $('#factor_3').val(factor_3.toFixed(2));
		     $('#factor_4').val(factor_4.toFixed(2));
		     $('#factor_5').val(factor_5.toFixed(2));
		     $('#factor_6').val(factor_6.toFixed(2));
		     $('#factor_7').val(factor_7.toFixed(2));
		     $('#factor_8').val(factor_8.toFixed(2));
			 
			 $('#den_1').val(den_1);
		     $('#den_2').val(den_2);
		     $('#den_3').val(den_3);
		     $('#den_4').val(den_4);
		     $('#den_5').val(den_5);
		     $('#den_6').val(den_6);
		     $('#den_7').val(den_7);
		     $('#den_8').val(den_8);
			 
			 avg_den = ((+den_1)+(+den_2)+(+den_3)+(+den_4)+(+den_5)+(+den_6)+(+den_7)+(+den_8))/8;			  
			 $('#avg_den').val(avg_den.toString().substring(0, avg_den.toString().indexOf(".") + 3));
			  
					
			 var avg_corrr = $('#avg_corr').val();
			 var sd = randomNumberFromRange(1,9).toFixed();
			 if(sd%2==0)
			 {
				  corr_1 = (+avg_corrr) + 0.05;
				  corr_3 = (+avg_corrr) + 0.30;
				  corr_5 = (+avg_corrr) + 1.50;
				  corr_7 = (+avg_corrr) + 0.08;
				  corr_2 = (+avg_corrr) - 0.30;
				  corr_4 = (+avg_corrr) - 0.05;
				  corr_6 = (+avg_corrr) - 0.08;
				  corr_8 = (+avg_corrr) - 1.50;
			 }
			 else
			 {
				  corr_1 = (+avg_corrr) - 0.05;
				  corr_3 = (+avg_corrr) - 0.30;
				  corr_5 = (+avg_corrr) - 1.50;
				  corr_7 = (+avg_corrr) - 0.08;
				  corr_2 = (+avg_corrr) + 0.30;
				  corr_4 = (+avg_corrr) + 0.05;
				  corr_6 = (+avg_corrr) + 0.08;
				  corr_8 = (+avg_corrr) + 1.50;
			 }
			 
			  $('#corr_1').val(corr_1.toFixed(2));
			  $('#corr_2').val(corr_2.toFixed(2));
			  $('#corr_3').val(corr_3.toFixed(2));
			  $('#corr_4').val(corr_4.toFixed(2));
			  $('#corr_5').val(corr_5.toFixed(2));
			  $('#corr_6').val(corr_6.toFixed(2));
			  $('#corr_7').val(corr_7.toFixed(2));
			  $('#corr_8').val(corr_8.toFixed(2));
			 
			 var corrr_1 = $('#corr_1').val();
			 var corrr_2 = $('#corr_2').val();
			 var corrr_3 = $('#corr_3').val();
			 var corrr_4 = $('#corr_4').val();
			 var corrr_5 = $('#corr_5').val();
			 var corrr_6 = $('#corr_6').val();
			 var corrr_7 = $('#corr_7').val();
			 var corrr_8 = $('#corr_8').val();
			 
			  com_1 = (+corrr_1)/(+factor_1);
			  com_2 = (+corrr_2)/(+factor_2);
			  com_3 = (+corrr_3)/(+factor_3);
			  com_4 = (+corrr_4)/(+factor_4);
			  com_5 = (+corrr_5)/(+factor_5);
			  com_6 = (+corrr_6)/(+factor_6);
			  com_7 = (+corrr_7)/(+factor_7);
			  com_8 = (+corrr_8)/(+factor_8);
			 
			 $('#com_1').val(com_1.toFixed(2));
			 $('#com_2').val(com_2.toFixed(2));
			 $('#com_3').val(com_3.toFixed(2));
			 $('#com_4').val(com_4.toFixed(2));
			 $('#com_5').val(com_5.toFixed(2));
			 $('#com_6').val(com_6.toFixed(2));
			 $('#com_7').val(com_7.toFixed(2));
			 $('#com_8').val(com_8.toFixed(2));
			 
			 var comm_1 = $('#com_1').val();
			 var comm_2 = $('#com_2').val();
			 var comm_3 = $('#com_3').val();
			 var comm_4 = $('#com_4').val();
			 var comm_5 = $('#com_5').val();
			 var comm_6 = $('#com_6').val();
			 var comm_7 = $('#com_7').val();
			 var comm_8 = $('#com_8').val();
			 
			  load_1 = ((comm_1)*(+a1))/1000;
			  load_2 = ((comm_2)*(+a2))/1000;
			  load_3 = ((comm_3)*(+a3))/1000;
			  load_4 = ((comm_4)*(+a4))/1000;
			  load_5 = ((comm_5)*(+a5))/1000;
			  load_6 = ((comm_6)*(+a6))/1000;
			  load_7 = ((comm_7)*(+a7))/1000;
			  load_8 = ((comm_8)*(+a8))/1000;
			 
			  $('#load_1').val(load_1.toFixed(1));
			  $('#load_2').val(load_2.toFixed(1));
			  $('#load_3').val(load_3.toFixed(1));
			  $('#load_4').val(load_4.toFixed(1));
			  $('#load_5').val(load_5.toFixed(1));
			  $('#load_6').val(load_6.toFixed(1));
			  $('#load_7').val(load_7.toFixed(1));
			  $('#load_8').val(load_8.toFixed(1));
			  
			  var ww1 = $('#lab_1').val();
			  var ww2 = $('#lab_2').val();
			  var ww3 = $('#lab_3').val();
			  var ww4 = $('#lab_4').val();
			  var ww5 = $('#lab_5').val();
			  var ww6 = $('#lab_6').val();
			  var ww7 = $('#lab_7').val();
			  var ww8 = $('#lab_8').val();
			  
			  var mm1 = $('#m1').val();
			  var mm2 = $('#m2').val();
			  var mm3 = $('#m3').val();
			  var mm4 = $('#m4').val();
			  var mm5 = $('#m5').val();
			  var mm6 = $('#m6').val();
			  var mm7 = $('#m7').val();
			  var mm8 = $('#m8').val();
			  
			  var minus1 = (+mm1) * (+20000);
			  var minus2 = (+mm2) * (+20000);
			  var minus3 = (+mm3) * (+20000);
			  var minus4 = (+mm4) * (+20000);
			  var minus5 = (+mm5) * (+20000);
			  var minus6 = (+mm6) * (+20000);
			  var minus7 = (+mm7) * (+20000);
			  var minus8 = (+mm8) * (+20000);
			  
			  var area1 = ((+minus1) / (+ww1));
			  var area2 = ((+minus2) / (+ww2));
			  var area3 = ((+minus3) / (+ww3));
			  var area4 = ((+minus4) / (+ww4));
			  var area5 = ((+minus5) / (+ww5));
			  var area6 = ((+minus6) / (+ww6));
			  var area7 = ((+minus7) / (+ww7));
			  var area8 = ((+minus8) / (+ww8));
			  
			  $('#area_1').val(area1.toFixed());
			  $('#area_2').val(area2.toFixed());
			  $('#area_3').val(area3.toFixed());
			  $('#area_4').val(area4.toFixed());
			  $('#area_5').val(area5.toFixed());
			  $('#area_6').val(area6.toFixed());
			  $('#area_7').val(area7.toFixed());
			  $('#area_8').val(area8.toFixed());
			
		      var aa1 = $('#area_1').val();
			  var aa2 = $('#area_2').val();
			  var aa3 = $('#area_3').val();
			  var aa4 = $('#area_4').val();
			  var aa5 = $('#area_5').val();
			  var aa6 = $('#area_6').val();
			  var aa7 = $('#area_7').val();
			  var aa8 = $('#area_8').val();
			  
			  var load1 = $('#load_1').val();
			  var load2 = $('#load_2').val();
			  var load3 = $('#load_3').val();
			  var load4 = $('#load_4').val();
			  var load5 = $('#load_5').val();
			  var load6 = $('#load_6').val();
			  var load7 = $('#load_7').val();
			  var load8 = $('#load_8').val();
			  
			  var compres1 = ((+load1) * 1000) / (+aa1);
			  var compres2 = ((+load2) * 1000) / (+aa2);
			  var compres3 = ((+load3) * 1000) / (+aa3);
			  var compres4 = ((+load4) * 1000) / (+aa4);
			  var compres5 = ((+load5) * 1000) / (+aa5);
			  var compres6 = ((+load6) * 1000) / (+aa6);
			  var compres7 = ((+load7) * 1000) / (+aa7);
			  var compres8 = ((+load8) * 1000) / (+aa8);
			  
			 $('#com_1').val(compres1.toFixed(2));
			 $('#com_2').val(compres2.toFixed(2));
			 $('#com_3').val(compres3.toFixed(2));
			 $('#com_4').val(compres4.toFixed(2));
			 $('#com_5').val(compres5.toFixed(2));
			 $('#com_6').val(compres6.toFixed(2));
			 $('#com_7').val(compres7.toFixed(2));
			 $('#com_8').val(compres8.toFixed(2));
			 
			 var come_1 = $('#com_1').val();
			 var come_2 = $('#com_2').val();
			 var come_3 = $('#com_3').val();
			 var come_4 = $('#com_4').val();
			 var come_5 = $('#com_5').val();
			 var come_6 = $('#com_6').val();
			 var come_7 = $('#com_7').val();
			 var come_8 = $('#com_8').val();
			 
			 var corrw_1 = (+come_1)*(+factor_1);
			 var corrw_2 = (+come_2)*(+factor_2);
			 var corrw_3 = (+come_3)*(+factor_3);
			 var corrw_4 = (+come_4)*(+factor_4);
		     var corrw_5 = (+come_5)*(+factor_5);
		     var corrw_6 = (+come_6)*(+factor_6);
		     var corrw_7 = (+come_7)*(+factor_7);
			 var corrw_8 = (+come_8)*(+factor_8);
			 
			 
			  $('#corr_1').val(corrw_1.toFixed(2));
			  $('#corr_2').val(corrw_2.toFixed(2));
			  $('#corr_3').val(corrw_3.toFixed(2));
			  $('#corr_4').val(corrw_4.toFixed(2));
			  $('#corr_5').val(corrw_5.toFixed(2));
			  $('#corr_6').val(corrw_6.toFixed(2));
			  $('#corr_7').val(corrw_7.toFixed(2));
			  $('#corr_8').val(corrw_8.toFixed(2));
			  
			  var corr12_1 = $('#corr_1').val();
			  var corr12_2 = $('#corr_2').val();
			  var corr12_3 = $('#corr_3').val();
			  var corr12_4 = $('#corr_4').val();
			  var corr12_5 = $('#corr_5').val();
			  var corr12_6 = $('#corr_6').val();
			  var corr12_7 = $('#corr_7').val();
			  var corr12_8 = $('#corr_8').val();
			  
			  var ansf = ((+corr12_1) + (+corr12_2) + (+corr12_3) + (+corr12_4) + (+corr12_5) + (+corr12_6) + (+corr12_7) + (+corr12_8)) / 8;
			  $('#avg_corr').val(ansf.toFixed(2));
			
			  
		 }	 
	});
	
	
	
	
	
	
	
	$('#load_1').change(function(){
        
		area_load();	
	});
	
	$('#load_2').change(function(){
        
		area_load();	
	});
	
	$('#load_3').change(function(){
        
		area_load();	
	});
	
	$('#load_4').change(function(){
        
		area_load();	
	});
	
	$('#load_5').change(function(){
        
		area_load();	
	});
	
	$('#load_6').change(function(){
        
		area_load();	
	});
	
	$('#load_7').change(function(){
        
		area_load();	
	});
	
	$('#load_8').change(function(){
        
		area_load();	
	});
	
	function comp_changes()
	{
		$('#txtcom').css("background-color","var(--success)"); 
		 if ($("#chk_com").is(':checked')) {
		 com_1 = $('#com_1').val(); 
		 com_2 = $('#com_2').val(); 
		 com_3 = $('#com_3').val(); 
		 com_4 = $('#com_4').val(); 
		 com_5 = $('#com_5').val(); 
		 com_6 = $('#com_6').val(); 
		 com_7 = $('#com_7').val(); 
		 com_8 = $('#com_8').val(); 
		
		 area_1 = $('#area_1').val(); 
		 area_2 = $('#area_2').val(); 
		 area_3 = $('#area_3').val(); 
		 area_4 = $('#area_4').val(); 
		 area_5 = $('#area_5').val(); 
		 area_6 = $('#area_6').val(); 
		 area_7 = $('#area_7').val(); 
		 area_8 = $('#area_8').val(); 
		
		 load_1 = ((+com_1)*(+area_1))/1000;
		 load_2 = ((+com_2)*(+area_2))/1000;
		 load_3 = ((+com_3)*(+area_3))/1000;
		 load_4 = ((+com_4)*(+area_4))/1000;
		 load_5 = ((+com_5)*(+area_5))/1000;
		 load_6 = ((+com_6)*(+area_6))/1000;
		 load_7 = ((+com_7)*(+area_7))/1000;
		 load_8 = ((+com_8)*(+area_8))/1000;
			 
	  $('#load_1').val(load_1.toFixed(1));
	  $('#load_2').val(load_2.toFixed(1));
	  $('#load_3').val(load_3.toFixed(1));
	  $('#load_4').val(load_4.toFixed(1));
	  $('#load_5').val(load_5.toFixed(1));
	  $('#load_6').val(load_6.toFixed(1));
	  $('#load_7').val(load_7.toFixed(1));
	  $('#load_8').val(load_8.toFixed(1));
		
		 factor_1 = $('#factor_1').val(); 
		 factor_2 = $('#factor_2').val(); 
		 factor_3 = $('#factor_3').val(); 
		 factor_4 = $('#factor_4').val(); 
		 factor_5 = $('#factor_5').val(); 
		 factor_6 = $('#factor_6').val(); 
		 factor_7 = $('#factor_7').val(); 
		 factor_8 = $('#factor_8').val();
		
		 corr_1 = (+com_1) * (+factor_1);
		 corr_2 = (+com_2) * (+factor_2);
		 corr_3 = (+com_3) * (+factor_3);
		 corr_4 = (+com_4) * (+factor_4);
		 corr_5 = (+com_5) * (+factor_5);
		 corr_6 = (+com_6) * (+factor_6);
		 corr_7 = (+com_7) * (+factor_7);
		 corr_8 = (+com_8) * (+factor_8);
		 $('#corr_1').val(corr_1.toFixed(2));
		 $('#corr_2').val(corr_2.toFixed(2));
		 $('#corr_3').val(corr_3.toFixed(2));
		 $('#corr_4').val(corr_4.toFixed(2));
		 $('#corr_5').val(corr_5.toFixed(2));
		 $('#corr_6').val(corr_6.toFixed(2));
		 $('#corr_7').val(corr_7.toFixed(2));
		 $('#corr_8').val(corr_8.toFixed(2));
			
		 corrr_1 = $('#corr_1').val(); 
		 corrr_2 = $('#corr_2').val(); 
		 corrr_3 = $('#corr_3').val(); 
		 corrr_4 = $('#corr_4').val(); 
		 corrr_5 = $('#corr_5').val(); 
		 corrr_6 = $('#corr_6').val(); 
		 corrr_7 = $('#corr_7').val(); 
		 corrr_8 = $('#corr_8').val();
			 
			 avg_corr = ((+corrr_1)+(+corrr_2)+(+corrr_3)+(+corrr_4)+(+corrr_5)+(+corrr_6)+(+corrr_7)+(+corrr_8))/8;
		
			
			 $('#avg_corr').val(avg_corr.toFixed(2));
		
		 }
	}
	
	$('#com_1').change(function(){
        
		comp_changes();	
	});
	
	$('#com_2').change(function(){
        
		comp_changes();	
	});
	
	$('#com_3').change(function(){
        
		comp_changes();
	});
	
	$('#com_4').change(function(){
        
		comp_changes();
	});
	
	$('#com_5').change(function(){
        
		comp_changes();	
	});
	
	$('#com_6').change(function(){
        
		comp_changes();
	});
	
	$('#com_7').change(function(){
        
		comp_changes();
	});
	
	$('#com_8').change(function(){
        
		comp_changes();
	});
	
	
	
	$('#lab_1').change(function(){
        $('#txtcom').css("background-color","var(--success)"); 
		
		var l1 = $('#lab_1').val();
		var m1 = $('#m1').val();
		var thick_1 = $('#thick_1').val();
		var temp1 = (+m1)-(+l1);
		var area_1 = ((+temp1)/(+thick_1))*1000;
		 $('#area_1').val(area_1.toFixed(2));
		 var a1 = $('#area_1').val();
		
			
			  
	});
	$('#lab_2').change(function(){
         $('#txtcom').css("background-color","var(--success)"); 
		var l2 = $('#lab_2').val();
		var m2 = $('#m2').val();
		var thick_2 = $('#thick_2').val();
		var temp2 = (+m2)-(+l2);
		var area_2 = ((+temp2)/(+thick_2))*1000;
		 $('#area_2').val(area_2.toFixed(2));
		 var a2 = $('#area_2').val();
		
			
			  
	});
	$('#lab_3').change(function(){
        $('#txtcom').css("background-color","var(--success)");  
		var l3 = $('#lab_3').val();
		var m3 = $('#m3').val();
		var thick_3 = $('#thick_3').val();
		var temp3 = (+m3)-(+l3);
		var area_3 = ((+temp3)/(+thick_3))*1000;
		 $('#area_3').val(area_3.toFixed(2));
		 var a3 = $('#area_3').val();
		
			
			  
	});
	$('#lab_4').change(function(){
         $('#txtcom').css("background-color","var(--success)"); 
		var l4 = $('#lab_4').val();
		var m4 = $('#m4').val();
		var thick_4 = $('#thick_4').val();
		var temp4 = (+m4)-(+l4);
		var area_4 = ((+temp4)/(+thick_4))*1000;
		 $('#area_4').val(area_4.toFixed(2));
		 var a4 = $('#area_4').val();
		
			
			  
	});
	$('#lab_5').change(function(){
        $('#txtcom').css("background-color","var(--success)");  
		var l5 = $('#lab_5').val();
		var m5 = $('#m5').val();
		var thick_5 = $('#thick_5').val();
		var temp5 = (+m5)-(+l5);
		var area_5 = ((+temp5)/(+thick_5))*1000;
		 $('#area_5').val(area_5.toFixed(2));
		 var a5 = $('#area_5').val();
		
			
			  
	});
	$('#lab_6').change(function(){
        $('#txtcom').css("background-color","var(--success)");  
		var l6 = $('#lab_6').val();
		var m6 = $('#m6').val();
		var thick_6 = $('#thick_6').val();
		var temp6 = (+m6)-(+l6);
		var area_6 = ((+temp6)/(+thick_6))*1000;
		 $('#area_6').val(area_6.toFixed(2));
		 var a6 = $('#area_6').val();
		
			
			  
	});
	$('#lab_7').change(function(){
      $('#txtcom').css("background-color","var(--success)");    
		var l7 = $('#lab_7').val();
		var m7 = $('#m7').val();
		var thick_7 = $('#thick_7').val();
		var temp7 = (+m7)-(+l7);
		var area_7 = ((+temp7)/(+thick_7))*1000;
		 $('#area_7').val(area_7.toFixed(2));
		 var a7 = $('#area_7').val();
		
			
			  
	});
	$('#lab_8').change(function(){
        $('#txtcom').css("background-color","var(--success)");  
		var l8 = $('#lab_8').val();
		var m8 = $('#m8').val();
		var thick_8 = $('#thick_8').val();
		var temp8 = (+m8)-(+l8);
		var area_8 = ((+temp8)/(+thick_8))*1000;
		 $('#area_8').val(area_8.toFixed(2));
		 var a8 = $('#area_8').val();
		
			
			  
	});
	
	
	$('#m1').change(function(){
        $('#txtcom').css("background-color","var(--success)");  
		var l1 = $('#lab_1').val();
		var m1 = $('#m1').val();
		var thick_1 = $('#thick_1').val();
		var temp1 = (+m1)-(+l1);
		var area_1 = ((+temp1)/(+thick_1))*1000;
		 $('#area_1').val(area_1.toFixed(2));
		 var a1 = $('#area_1').val();
		
			
			  
	});
	$('#m2').change(function(){
         $('#txtcom').css("background-color","var(--success)"); 
		var l2 = $('#lab_2').val();
		var m2 = $('#m2').val();
		var thick_2 = $('#thick_2').val();
		var temp2 = (+m2)-(+l2);
		var area_2 = ((+temp2)/(+thick_2))*1000;
		 $('#area_2').val(area_2.toFixed(2));
		 var a2 = $('#area_2').val();
		
			
			  
	});
	$('#m3').change(function(){
        $('#txtcom').css("background-color","var(--success)");  
		var l3 = $('#lab_3').val();
		var m3 = $('#m3').val();
		var thick_3 = $('#thick_3').val();
		var temp3 = (+m3)-(+l3);
		var area_3 = ((+temp3)/(+thick_3))*1000;
		 $('#area_3').val(area_3.toFixed(2));
		 var a3 = $('#area_3').val();
		
			
			  
	});
	$('#m4').change(function(){
        $('#txtcom').css("background-color","var(--success)");  
		var l4 = $('#lab_4').val();
		var m4 = $('#m4').val();
		var thick_4 = $('#thick_4').val();
		var temp4 = (+m4)-(+l4);
		var area_4 = ((+temp4)/(+thick_4))*1000;
		 $('#area_4').val(area_4.toFixed(2));
		 var a4 = $('#area_4').val();
		
			
			  
	});
	$('#m5').change(function(){
        $('#txtcom').css("background-color","var(--success)");  
		var l5 = $('#lab_5').val();
		var m5 = $('#m5').val();
		var thick_5 = $('#thick_5').val();
		var temp5 = (+m5)-(+l5);
		var area_5 = ((+temp5)/(+thick_5))*1000;
		 $('#area_5').val(area_5.toFixed(2));
		 var a5 = $('#area_5').val();
		
			
			  
	});
	$('#m6').change(function(){
       $('#txtcom').css("background-color","var(--success)");   
		var l6 = $('#lab_6').val();
		var m6 = $('#m6').val();
		var thick_6 = $('#thick_6').val();
		var temp6 = (+m6)-(+l6);
		var area_6 = ((+temp6)/(+thick_6))*1000;
		 $('#area_6').val(area_6.toFixed(2));
		 var a6 = $('#area_6').val();
		
			
			  
	});
	$('#m7').change(function(){
        $('#txtcom').css("background-color","var(--success)");  
		var l7 = $('#lab_7').val();
		var m7 = $('#m7').val();
		var thick_7 = $('#thick_7').val();
		var temp7 = (+m7)-(+l7);
		var area_7 = ((+temp7)/(+thick_7))*1000;
		 $('#area_7').val(area_7.toFixed(2));
		 var a7 = $('#area_7').val();
		
			
			  
	});
	$('#m8').change(function(){
         $('#txtcom').css("background-color","var(--success)"); 
		var l8 = $('#lab_8').val();
		var m8 = $('#m8').val();
		var thick_8 = $('#thick_8').val();
		var temp8 = (+m8)-(+l8);
		var area_8 = ((+temp8)/(+thick_8))*1000;
		 $('#area_8').val(area_8.toFixed(2));
		 var a8 = $('#area_8').val();
		
			
			  
	});
	
	/* $('#h1_1,#h2_1,#h3_1,#h4_1,#h5_1,#h6_1,#h7_1,#h8_1,#l1_1,#l2_1,#l3_1,#l4_1,#l5_1,#l6_1,#l7_1,#l8_1,#w1_1,#w2_1,#w3_1,#w4_1,#w5_1,#w6_1,#w7_1,#w8_1').change(function(){
		
		var h1_1 = $('#h1_1').val();
		var h2_1 = $('#h2_1').val();
		var h3_1 = $('#h3_1').val();
		var h4_1 = $('#h4_1').val();
		var h5_1 = $('#h5_1').val();
		var h6_1 = $('#h6_1').val();
		var h7_1 = $('#h7_1').val();
		var h8_1 = $('#h8_1').val();
		var l1_1 = $('#l1_1').val();
		var l2_1 = $('#l2_1').val();
		var l3_1 = $('#l3_1').val();
		var l4_1 = $('#l4_1').val();
		var l5_1 = $('#l5_1').val();
		var l6_1 = $('#l6_1').val();
		var l7_1 = $('#l7_1').val();
		var l8_1 = $('#l8_1').val();
		var w1_1 = $('#w1_1').val();
		var w2_1 = $('#w2_1').val();
		var w3_1 = $('#w3_1').val();
		var w4_1 = $('#w4_1').val();
		var w5_1 = $('#w5_1').val();
		var w6_1 = $('#w6_1').val();
		var w7_1 = $('#w7_1').val();
		var w8_1 = $('#w8_1').val();
		
		var height_avg = ((+h1_1) + (+h2_1) + (+h3_1) + (+h4_1) + (+h5_1) + (+h6_1) + (+h7_1) + (+h8_1)) / (+8);
		$('#height_avg').val(height_avg.toFixed(2));
		var length_avg = ((+l1_1) + (+l2_1) + (+l3_1) + (+l4_1) + (+l5_1) + (+l6_1) + (+l7_1) + (+l8_1)) / (+8);
		$('#length_avg').val(length_avg.toFixed(2));
		var width_avg = ((+w1_1) + (+w2_1) + (+w3_1) + (+w4_1) + (+w5_1) + (+w6_1) + (+w7_1) + (+w8_1)) / (+8);
		$('#width_avg').val(width_avg.toFixed(2));
		
	}); */
	function check_dim()
	{
		$('#txtdim').css("background-color","var(--success)"); 
		 if ($("#chk_dim").is(':checked')) {
			 
		var h1_1 = randomNumberFromRange(100,150).toFixed();
		var h2_1 = randomNumberFromRange(100,150).toFixed();
		var h3_1 = randomNumberFromRange(100,150).toFixed();
		var h4_1 = randomNumberFromRange(100,150).toFixed();
		var h5_1 = randomNumberFromRange(100,150).toFixed();
		var h6_1 = randomNumberFromRange(100,150).toFixed();
		var h7_1 = randomNumberFromRange(100,150).toFixed();
		var h8_1 = randomNumberFromRange(100,150).toFixed();
		var l1_1 = randomNumberFromRange(100,150).toFixed();
		var l2_1 = randomNumberFromRange(100,150).toFixed();
		var l3_1 = randomNumberFromRange(100,150).toFixed();
		var l4_1 = randomNumberFromRange(100,150).toFixed();
		var l5_1 = randomNumberFromRange(100,150).toFixed();
		var l6_1 = randomNumberFromRange(100,150).toFixed();
		var l7_1 = randomNumberFromRange(100,150).toFixed();
		var l8_1 = randomNumberFromRange(100,150).toFixed();
		var w1_1 = randomNumberFromRange(100,150).toFixed();
		var w2_1 = randomNumberFromRange(100,150).toFixed();
		var w3_1 = randomNumberFromRange(100,150).toFixed();
		var w4_1 = randomNumberFromRange(100,150).toFixed();
		var w5_1 = randomNumberFromRange(100,150).toFixed();
		var w6_1 = randomNumberFromRange(100,150).toFixed();
		var w7_1 = randomNumberFromRange(100,150).toFixed();
		var w8_1 = randomNumberFromRange(100,150).toFixed();
		
		$('#h1_1').val(h1_1);
		$('#h2_1').val(h2_1);
		$('#h3_1').val(h3_1);
		$('#h4_1').val(h4_1);
		$('#h5_1').val(h5_1);
		$('#h6_1').val(h6_1);
		$('#h7_1').val(h7_1);
		$('#h8_1').val(h8_1);
		$('#l1_1').val(l1_1);
		$('#l2_1').val(l2_1);
		$('#l3_1').val(l3_1);
		$('#l4_1').val(l4_1);
		$('#l5_1').val(l5_1);
		$('#l6_1').val(l6_1);
		$('#l7_1').val(l7_1);
		$('#l8_1').val(l8_1);
		$('#w1_1').val(w1_1);
		$('#w2_1').val(w2_1);
		$('#w3_1').val(w3_1);
		$('#w4_1').val(w4_1);
		$('#w5_1').val(w5_1);
		$('#w6_1').val(w6_1);
		$('#w7_1').val(w7_1);
		$('#w8_1').val(w8_1);
		
		var height_avg = ((+h1_1) + (+h2_1) + (+h3_1) + (+h4_1) + (+h5_1) + (+h6_1) + (+h7_1) + (+h8_1)) / (+8);
		$('#height_avg').val(height_avg.toFixed(0));
		var length_avg = ((+l1_1) + (+l2_1) + (+l3_1) + (+l4_1) + (+l5_1) + (+l6_1) + (+l7_1) + (+l8_1)) / (+8);
		$('#length_avg').val(length_avg.toFixed(0));
		var width_avg = ((+w1_1) + (+w2_1) + (+w3_1) + (+w4_1) + (+w5_1) + (+w6_1) + (+w7_1) + (+w8_1)) / (+8);
		$('#width_avg').val(width_avg.toFixed(0));
		
		 }
	}
	
	$('#chk_dim').change(function(){
        if(this.checked)
		{ 
			check_dim();
			  
		}
		else
		{
			$('#h1_1').val(null);
			$('#h2_1').val(null);
			$('#h3_1').val(null);
			$('#h4_1').val(null);
			$('#h5_1').val(null);
			$('#h6_1').val(null);
			$('#h7_1').val(null);
			$('#h8_1').val(null);
			$('#l1_1').val(null);
			$('#l2_1').val(null);
			$('#l3_1').val(null);
			$('#l4_1').val(null);
			$('#l5_1').val(null);
			$('#l6_1').val(null);
			$('#l7_1').val(null);
			$('#l8_1').val(null);
			$('#w1_1').val(null);
			$('#w2_1').val(null);
			$('#w3_1').val(null);
			$('#w4_1').val(null);
			$('#w5_1').val(null);
			$('#w6_1').val(null);
			$('#w7_1').val(null);
			$('#w8_1').val(null);
		}
	});
	
	
	
	$('#h1_1,#h2_1,#h3_1,#h4_1,#h5_1,#h6_1,#h7_1,#h8_1,#l1_1,#l2_1,#l3_1,#l4_1,#l5_1,#l6_1,#l7_1,#l8_1,#w1_1,#w2_1,#w3_1,#w4_1,#w5_1,#w6_1,#w7_1,#w8_1').change(function() {
    
    function calculateAverage(prefix) {
        let sum = 0;
        let count = 0;
        for (let i = 1; i <= 8; i++) {
            let val = parseFloat($(`#${prefix}${i}_1`).val());
            if (!isNaN(val)) {
                sum += val;
                count++;
            }
        }
        return count > 0 ? (sum / count).toFixed(2) : '';
    }

    $('#height_avg').val(calculateAverage('h'));
    $('#length_avg').val(calculateAverage('l'));
    $('#width_avg').val(calculateAverage('w'));

});

	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","var(--success)"); 
			//$('#txtwtr').css("background-color","var(--success)"); 
			
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				//Compressive strength
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						$('#txtcom').css("background-color","var(--success)");
						$("#chk_com").prop("checked", true); 
						check_com();
						break;
					}					
				}
				
				//Water
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{
						$('#txtwtr').css("background-color","var(--success)");
						$("#chk_wtr").prop("checked", true); 
						check_wtr();
						break;
					}					
				}
				
				//Dimension
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dim")
					{
						$('#txtdim').css("background-color","var(--success)");
						$("#chk_dim").prop("checked", true); 
						check_dim();
						break;
					}					
				}
				
				
		
				//ABRASION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="abr")
					{
						$('#txtabr').css("background-color","var(--success)");
						$("#chk_abr").prop("checked", true); 
						check_abr();
						break;
					}					
				}
				
				//tensile
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ten")
					{
						$('#txtten').css("background-color","var(--success)");
						$("#chk_ten").prop("checked", true); 
						check_ten();
						break;
					}					
				}
				
				//flexural
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fle")
					{
						$('#txtfle').css("background-color","var(--success)");
						$("#chk_fle").prop("checked", true); 
						check_fle();
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
        url: '<?php echo $base_url; ?>savespan_paveblock.php',
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
				var paver_shape = $('#top_shape').val();
				var paver_age = $('#top_age').val();
				var paver_color = $('#top_color').val();							
				var paver_thickNess = $('#top_thickNess').val();	
				var paver_grade = $('#top_grade').val();	
				var ulr = $('#ulr').val();	
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");				
									
				//Compressive strength
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
						
							
							lab_1 = $('#lab_1').val();
							lab_2 = $('#lab_2').val();
							lab_3 = $('#lab_3').val();
							lab_4 = $('#lab_4').val();
							lab_5 = $('#lab_5').val();
							lab_6 = $('#lab_6').val();
							lab_7 = $('#lab_7').val();
							lab_8 = $('#lab_8').val();
							
							var m1 = $('#m1').val();
							var m2 = $('#m2').val();
							var m3 = $('#m3').val();
							var m4 = $('#m4').val();
							var m5 = $('#m5').val();
							var m6 = $('#m6').val();
							var m7 = $('#m7').val();
							var m8 = $('#m8').val();
							var s_des = $('#s_des').val();
                            var r_sam = $('#r_sam').val();
                            var s_ret = $('#s_ret').val();
                            var qty_1 = $('#qty_1').val();

							
							var grade = $('#grade_1').val();
							var thick = $('#thick_1').val();
							var factor = $('#factor_1').val();
							
							var area_1 = $('#area_1').val();
							var area_2 = $('#area_2').val();
							var area_3 = $('#area_3').val();
							var area_4 = $('#area_4').val();
							var area_5 = $('#area_5').val();
							var area_6 = $('#area_6').val();
							var area_7 = $('#area_7').val();
							var area_8 = $('#area_8').val();
							
							var load_1 = $('#load_1').val();
							var load_2 = $('#load_2').val();
							var load_3 = $('#load_3').val();
							var load_4 = $('#load_4').val();
							var load_5 = $('#load_5').val();
							var load_6 = $('#load_6').val();
							var load_7 = $('#load_7').val();
							var load_8 = $('#load_8').val();
							
							var com_1 = $('#com_1').val();
							var com_2 = $('#com_2').val();
							var com_3 = $('#com_3').val();
							var com_4 = $('#com_4').val();
							var com_5 = $('#com_5').val();
							var com_6 = $('#com_6').val();
							var com_7 = $('#com_7').val();
							var com_8 = $('#com_8').val();
							
							var corr_1 = $('#corr_1').val();
							var corr_2 = $('#corr_2').val();
							var corr_3 = $('#corr_3').val();
							var corr_4 = $('#corr_4').val();
							var corr_5 = $('#corr_5').val();
							var corr_6 = $('#corr_6').val();
							var corr_7 = $('#corr_7').val();
							var corr_8 = $('#corr_8').val();
							var avg_corr = $('#avg_corr').val();
							
							var den_1 = $('#den_1').val();
							var den_2 = $('#den_2').val();
							var den_3 = $('#den_3').val();
							var den_4 = $('#den_4').val();
							var den_5 = $('#den_5').val();
							var den_6 = $('#den_6').val();
							var den_7 = $('#den_7').val();
							var den_8 = $('#den_8').val();
							var avg_den = $('#avg_den').val();
							
							var sm1 = $('#sm1').val();
							var sm2 = $('#sm2').val();
							var sm3 = $('#sm3').val();
							var sm4 = $('#sm4').val();
							var sm5 = $('#sm5').val();
							var sm6 = $('#sm6').val();
							var sm7 = $('#sm7').val();
							var sm8 = $('#sm8').val();
							var sm9 = $('#sm9').val();
							var sm10 = $('#sm10').val();
							var sm11 = $('#sm11').val();
							var sm12 = $('#sm12').val();
							var sm13 = $('#sm13').val();
							var sm14 = $('#sm14').val();
							var sm15 = $('#sm15').val();
							var sm16 = $('#sm16').val();
							var sm17 = $('#sm17').val();
							var sm18 = $('#sm18').val();
							var sm19 = $('#sm19').val();
							var sm20 = $('#sm20').val();
							var sm21 = $('#sm21').val();
							var sm22 = $('#sm22').val();
							var sm23 = $('#sm23').val();
							var sm24 = $('#sm24').val();
							var sm25 = $('#sm25').val();
							var sm26 = $('#sm26').val();
							var sm27 = $('#sm27').val();
							var sm28 = $('#sm28').val();
							var sm29 = $('#sm29').val();
							var sm30 = $('#sm30').val();
						break;
					}
					else
					{
							var chk_com = "0";
							
							
							lab_1 = "";
							lab_2 = "";	
							lab_3 = "";
							lab_4 = "";
							lab_5 = "";
							lab_6 = "";
							lab_7 = "";
							lab_8 = "";
							
							var m1 = "";
							var m2 = "";
							var m3 = "";
							var m4 = "";
							var m5 = "";
							var m6 = "";
							var m7 = "";
							var m8 = "";
							var s_des = "";
                            var r_sam = "";
                            var s_ret = "";
                            var qty_1 = "";

							
							var grade = "";
							var thick = "";
							var factor = "";
							
							var area_1 = "";
							var area_2 = "";
							var area_3 = "";
							var area_4 = "";
							var area_5 = "";
							var area_6 = "";
							var area_7 = "";
							var area_8 = "";
							
							var load_1 = "";
							var load_2 = "";
							var load_3 = "";
							var load_4 = "";
							var load_5 = "";
							var load_6 = "";
							var load_7 = "";
							var load_8 = "";
							
							var com_1 = "";
							var com_2 = "";
							var com_3 = "";
							var com_4 = "";
							var com_5 = "";
							var com_6 = "";
							var com_7 = ""; 
							var com_8 = "";
							
							var corr_1 = "";
							var corr_2 = "";
							var corr_3 = "";
							var corr_4 = "";
							var corr_5 = "";
							var corr_6 = "";
							var corr_7 = "";
							var corr_8 = "";
							var avg_corr = $('#avg_corr').val();
							
							var den_1 = "";
							var den_2 = "";
							var den_3 = "";
							var den_4 = "";
							var den_5 = "";
							var den_6 = "";
							var den_7 = "";
							var den_8 = "";
							var avg_den = $('#avg_den').val();
							
							var sm1 = "";
							var sm2 = "";
							var sm3 = "";
							var sm4 = "";
							var sm5 = "";
							var sm6 = "";
							var sm7 = "";
							var sm8 = "";
							var sm9 = "";
							var sm10 = "";
							var sm11 = "";
							var sm12 = "";
							var sm13 = "";
							var sm14 = "";
							var sm15 = "";
							var sm16 = "";
							var sm17 = "";
							var sm18 = "";
							var sm19 = "";
							var sm20 = "";
							var sm21 = "";
							var sm22 = "";
							var sm23 = "";
							var sm24 = "";
							var sm25 = "";
							var sm26 = "";
							var sm27 = "";
							var sm28 = "";
							var sm29 = "";
							var sm30 = "";
					}
				}
				
				//DIMENSION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dim")
					{
						if(document.getElementById('chk_dim').checked) {
								var chk_dim = "1";
						}
						else{
								var chk_dim = "0";
						}
							var chk_dim = $('#chk_dim').val();
							var h1_1 = $('#h1_1').val();
							var h2_1 = $('#h2_1').val();
							var h3_1 = $('#h3_1').val();
							var h4_1 = $('#h4_1').val();
							var h5_1 = $('#h5_1').val();
							var h6_1 = $('#h6_1').val();
							var h7_1 = $('#h7_1').val();
							var h8_1 = $('#h8_1').val();
							var l1_1 = $('#l1_1').val();
							var l2_1 = $('#l2_1').val();
							var l3_1 = $('#l3_1').val();
							var l4_1 = $('#l4_1').val();
							var l5_1 = $('#l5_1').val();
							var l6_1 = $('#l6_1').val();
							var l7_1 = $('#l7_1').val();
							var l8_1 = $('#l8_1').val();
							var w1_1 = $('#w1_1').val();
							var w2_1 = $('#w2_1').val();
							var w3_1 = $('#w3_1').val();
							var w4_1 = $('#w4_1').val();
							var w5_1 = $('#w5_1').val();
							var w6_1 = $('#w6_1').val();
							var w7_1 = $('#w7_1').val();
							var w8_1 = $('#w8_1').val();
							var height_avg = $('#height_avg').val();
							var length_avg = $('#length_avg').val();
							var width_avg = $('#width_avg').val();


								
							
						break;
					}
					else
					{
							
							var chk_dim = "";
							var h1_1 = "";
							var h2_1 = "";
							var h3_1 = "";
							var h4_1 = "";
							var h5_1 = "";
							var h6_1 = "";
							var h7_1 = "";
							var h8_1 = "";
							var l1_1 = "";
							var l2_1 = "";
							var l3_1 = "";
							var l4_1 = "";
							var l5_1 = "";
							var l6_1 = "";
							var l7_1 = "";
							var l8_1 = "";
							var w1_1 = "";
							var w2_1 = "";
							var w3_1 = "";
							var w4_1 = "";
							var w5_1 = "";
							var w6_1 = "";
							var w7_1 = "";
							var w8_1 = "";
							var height_avg = "";
							var length_avg = "";
							var width_avg = "";

							
							
							
							
					}
				}
				
				//Tensile Strength
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ten")
					{
						if(document.getElementById('chk_ten').checked) {
								var chk_ten = "1";
						}
						else{
								var chk_ten = "0";
						}
							var sm15 = $('#sm15').val();
							var sm16 = $('#sm16').val();
							var sm17 = $('#sm17').val();
							var sm18 = $('#sm18').val();
							var sm19 = $('#sm19').val();
							var sm20 = $('#sm20').val();
							var sm21 = $('#sm21').val();
							var sm22 = $('#sm22').val();
						
							var t11 = $('#t11').val();
							var t12 = $('#t12').val();
							var t13 = $('#t13').val();
							var t14 = $('#t14').val();
							var t15 = $('#t15').val();
							var t16 = $('#t16').val();
							var t17 = $('#t17').val();
							var t18 = $('#t18').val();
							
							var t21 = $('#t21').val();
							var t22 = $('#t22').val();
							var t23 = $('#t23').val();
							var t24 = $('#t24').val();
							var t25 = $('#t25').val();
							var t26 = $('#t26').val();
							var t27 = $('#t27').val();
							var t28 = $('#t28').val();
							
							var t31 = $('#t31').val();
							var t32 = $('#t32').val();
							var t33 = $('#t33').val();
							var t34 = $('#t34').val();
							var t35 = $('#t35').val();
							var t36 = $('#t36').val();
							var t37 = $('#t37').val();
							var t38 = $('#t38').val();
							
							var avgt1 = $('#avgt1').val();
							var avgt2 = $('#avgt2').val();
							var avgt3 = $('#avgt3').val();
							var avgt4 = $('#avgt4').val();
							var avgt5 = $('#avgt5').val();
							var avgt6 = $('#avgt6').val();
							var avgt7 = $('#avgt7').val();
							var avgt8 = $('#avgt8').val();
							
							var f11 = $('#f11').val();
							var f12 = $('#f12').val();
							var f13 = $('#f13').val();
							var f14 = $('#f14').val();
							var f15 = $('#f15').val();
							var f16 = $('#f16').val();
							var f17 = $('#f17').val();
							var f18 = $('#f18').val();
							var f21 = $('#f21').val();
							var f22 = $('#f22').val();
							var f23 = $('#f23').val();
							var f24 = $('#f24').val();
							var f25 = $('#f25').val();
							var f26 = $('#f26').val();
							var f27 = $('#f27').val();
							var f28 = $('#f28').val();
							
							var avgf1 = $('#avgf1').val();
							var avgf2 = $('#avgf2').val();
							var avgf3 = $('#avgf3').val();
							var avgf4 = $('#avgf4').val();
							var avgf5 = $('#avgf5').val();
							var avgf6 = $('#avgf6').val();
							var avgf7 = $('#avgf7').val();
							var avgf8 = $('#avgf8').val();
							
							var farea1 = $('#farea1').val();
							var farea2 = $('#farea2').val();
							var farea3 = $('#farea3').val();
							var farea4 = $('#farea4').val();
							var farea5 = $('#farea5').val();
							var farea6 = $('#farea6').val();
							var farea7 = $('#farea7').val();
							var farea8 = $('#farea8').val();
							
							var spload1 = $('#spload1').val();
							var spload2 = $('#spload2').val();
							var spload3 = $('#spload3').val();
							var spload4 = $('#spload4').val();
							var spload5 = $('#spload5').val();
							var spload6 = $('#spload6').val();
							var spload7 = $('#spload7').val();
							var spload8 = $('#spload8').val();
							
							var sten1 = $('#sten1').val();
							var sten2 = $('#sten2').val();
							var sten3 = $('#sten3').val();
							var sten4 = $('#sten4').val();
							var sten5 = $('#sten5').val();
							var sten6 = $('#sten6').val();
							var sten7 = $('#sten7').val();
							var sten8 = $('#sten8').val();
							
							var fload1 = $('#fload1').val();
							var fload2 = $('#fload2').val();
							var fload3 = $('#fload3').val();
							var fload4 = $('#fload4').val();
							var fload5 = $('#fload5').val();
							var fload6 = $('#fload6').val();
							var fload7 = $('#fload7').val();
							var fload8 = $('#fload8').val();
							var avg_tensile = $('#avg_tensile').val();
							var avg_load = $('#avg_load').val();
							
							
								
							
						break;
					}
					else
					{
							var chk_ten = "0";
							var avg_tensile = "";
							var avg_load = "";
							
							var sm15 = "";
							var sm16 = "";
							var sm17 = "";
							var sm18 = "";
							var sm19 = "";
							var sm20 = "";
							var sm21 = "";
							var sm22 = "";
						
							var t11 = "";
							var t12 = "";
							var t13 = "";
							var t14 = "";
							var t15 = "";
							var t16 = "";
							var t17 = "";
							var t18 = "";
							
							var t21 = "";
							var t22 = "";
							var t23 = "";
							var t24 = "";
							var t25 = "";
							var t26 = "";
							var t27 = "";
							var t28 = "";
							
							var t31 = "";
							var t32 = "";
							var t33 = "";
							var t34 = "";
							var t35 = "";
							var t36 = "";
							var t37 = "";
							var t38 = "";
							
							var avgt1 = "";
							var avgt2 = "";
							var avgt3 = "";
							var avgt4 = "";
							var avgt5 = "";
							var avgt6 = "";
							var avgt7 = "";
							var avgt8 = "";
							
							var f11 = "";
							var f12 = "";
							var f13 = "";
							var f14 = "";
							var f15 = "";
							var f16 = "";
							var f17 = "";
							var f18 = "";
							var f21 = "";
							var f22 = "";
							var f23 = "";
							var f24 = "";
							var f25 = "";
							var f26 = "";
							var f27 = "";
							var f28 = "";
							
							var avgf1 = "";
							var avgf2 = "";
							var avgf3 = "";
							var avgf4 = "";
							var avgf5 = "";
							var avgf6 = "";
							var avgf7 = "";
							var avgf8 = "";
							
							var farea1 = "";
							var farea2 = "";
							var farea3 = "";
							var farea4 = "";
							var farea5 = "";
							var farea6 = "";
							var farea7 = "";
							var farea8 = "";
							
							var spload1 = "";
							var spload2 = "";
							var spload3 = "";
							var spload4 = "";
							var spload5 = "";
							var spload6 = "";
							var spload7 = "";
							var spload8 = "";
							
							var sten1 = "";
							var sten2 = "";
							var sten3 = "";
							var sten4 = "";
							var sten5 = "";
							var sten6 = "";
							var sten7 = "";
							var sten8 = "";
							
							var fload1 = "";
							var fload2 = "";
							var fload3 = "";
							var fload4 = "";
							var fload5 = "";
							var fload6 = "";
							var fload7 = "";
							var fload8 = "";
							
							
					}
				}
				
				//Flexural Strength
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
							var sm23 = $('#sm23').val();
							var sm24 = $('#sm24').val();
							var sm25 = $('#sm25').val();
							var sm26 = $('#sm26').val();
							var sm27 = $('#sm27').val();
							var sm28 = $('#sm28').val();
							var sm29 = $('#sm29').val();
							var sm30 = $('#sm30').val();
						
							var flen1 = $('#flen1').val();
							var flen2 = $('#flen2').val();
							var flen3 = $('#flen3').val();
							var flen4 = $('#flen4').val();
							var flen5 = $('#flen5').val();
							var flen6 = $('#flen6').val();
							var flen7 = $('#flen7').val();
							var flen8 = $('#flen8').val();
							
							var fwid1 = $('#fwid1').val();
							var fwid2 = $('#fwid2').val();
							var fwid3 = $('#fwid3').val();
							var fwid4 = $('#fwid4').val();
							var fwid5 = $('#fwid5').val();
							var fwid6 = $('#fwid6').val();
							var fwid7 = $('#fwid7').val();
							var fwid8 = $('#fwid8').val();
							
							var fthk1 = $('#fthk1').val();
							var fthk2 = $('#fthk2').val();
							var fthk3 = $('#fthk3').val();
							var fthk4 = $('#fthk4').val();
							var fthk5 = $('#fthk5').val();
							var fthk6 = $('#fthk6').val();
							var fthk7 = $('#fthk7').val();
							var fthk8 = $('#fthk8').val();
							
							var fdis1 = $('#fdis1').val();
							var fdis2 = $('#fdis2').val();
							var fdis3 = $('#fdis3').val();
							var fdis4 = $('#fdis4').val();
							var fdis5 = $('#fdis5').val();
							var fdis6 = $('#fdis6').val();
							var fdis7 = $('#fdis7').val();
							var fdis8 = $('#fdis8').val();
							
							var floa1 = $('#floa1').val();
							var floa2 = $('#floa2').val();
							var floa3 = $('#floa3').val();
							var floa4 = $('#floa4').val();
							var floa5 = $('#floa5').val();
							var floa6 = $('#floa6').val();
							var floa7 = $('#floa7').val();
							var floa8 = $('#floa8').val();
							
							var fle1 = $('#fle1').val();
							var fle2 = $('#fle2').val();
							var fle3 = $('#fle3').val();
							var fle4 = $('#fle4').val();
							var fle5 = $('#fle5').val();
							var fle6 = $('#fle6').val();
							var fle7 = $('#fle7').val();
							var fle8 = $('#fle8').val();
							
							var avg_fle = $('#avg_fle').val();
							
								
							
						break;
					}
					else
					{
							var chk_fle = "0";
							var avg_fle = "0";
							
							var sm23 = "";
							var sm24 = "";
							var sm25 = "";
							var sm26 = "";
							var sm27 = "";
							var sm28 = "";
							var sm29 = "";
							var sm30 = "";
						
							var flen1 = "";
							var flen2 = "";
							var flen3 = "";
							var flen4 = "";
							var flen5 = "";
							var flen6 = "";
							var flen7 = "";
							var flen8 = "";
							
							var fwid1 = "";
							var fwid2 = "";
							var fwid3 = "";
							var fwid4 = "";
							var fwid5 = "";
							var fwid6 = "";
							var fwid7 = "";
							var fwid8 = "";
							
							var fthk1 = "";
							var fthk2 = "";
							var fthk3 = "";
							var fthk4 = "";
							var fthk5 = "";
							var fthk6 = "";
							var fthk7 = "";
							var fthk8 = "";
							
							var fdis1 = "";
							var fdis2 = "";
							var fdis3 = "";
							var fdis4 = "";
							var fdis5 = "";
							var fdis6 = "";
							var fdis7 = "";
							var fdis8 = "";
							
							var floa1 = "";
							var floa2 = "";
							var floa3 = "";
							var floa4 = "";
							var floa5 = "";
							var floa6 = "";
							var floa7 = "";
							var floa8 = "";
							
							var fle1 = "";
							var fle2 = "";
							var fle3 = "";
							var fle4 = "";
							var fle5 = "";
							var fle6 = "";
							var fle7 = "";
							var fle8 = "";
							
							
					}
				}
				
				
				//water absorption
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{
						if(document.getElementById('chk_wtr').checked) {
								var chk_wtr = "1";
						}
						else{
								var chk_wtr = "0";
						}
																		
							var wtr_w1_1 = $('#wtr_w1_1').val();
							var wtr_w1_2 = $('#wtr_w1_2').val();
							var wtr_w1_3 = $('#wtr_w1_3').val();
							
							
							var wtr_w2_1 = $('#wtr_w2_1').val();
							var wtr_w2_2 = $('#wtr_w2_2').val();
							var wtr_w2_3 = $('#wtr_w2_3').val();
							
							var wtr_1 = $('#wtr_1').val();
							var wtr_2 = $('#wtr_2').val();
							var wtr_3 = $('#wtr_3').val();
							
							var avg_wtr = $('#avg_wtr').val();
							
						break;
					}
					else
					{
						var chk_wtr = "0";	
						var wtr_w1_1 = "";						
						var wtr_w1_2 = "";
						var wtr_w1_3 = "";
						
						
						var wtr_w2_1 = "";
						var wtr_w2_2 = "";
						var wtr_w2_3 = "";
						
						var wtr_1 = "";
						var wtr_2 = "";
						var wtr_3 = "";
						
						var avg_wtr = "";
					}
				}
				
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_com='+chk_com+'&wtr_w1_1='+wtr_w1_1+'&wtr_w1_2='+wtr_w1_2+'&wtr_w1_3='+wtr_w1_3+'&wtr_w2_1='+wtr_w2_1+'&wtr_w2_2='+wtr_w2_2+'&wtr_w2_3='+wtr_w2_3+'&wtr_1='+wtr_1+'&wtr_2='+wtr_2+'&wtr_3='+wtr_3+'&avg_wtr='+avg_wtr+'&paver_shape='+paver_shape+'&paver_age='+paver_age+'&paver_color='+paver_color+'&paver_thickNess='+paver_thickNess+'&paver_grade='+paver_grade+'&lab_1='+lab_1+'&lab_2='+lab_2+'&lab_3='+lab_3+'&lab_4='+lab_4+'&lab_5='+lab_5+'&lab_6='+lab_6+'&lab_7='+lab_7+'&lab_8='+lab_8+'&m1='+m1+'&m2='+m2+'&m3='+m3+'&m4='+m4+'&m5='+m5+'&m6='+m6+'&m7='+m7+'&m8='+m8+'&grade='+grade+'&thick='+thick+'&area_1='+area_1+'&area_2='+area_2+'&area_3='+area_3+'&area_4='+area_4+'&area_5='+area_5+'&area_6='+area_6+'&area_7='+area_7+'&area_8='+area_8+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&load_6='+load_6+'&load_7='+load_7+'&load_8='+load_8+'&com_1='+com_1+'&com_2='+com_2+'&com_3='+com_3+'&com_4='+com_4+'&com_5='+com_5+'&com_6='+com_6+'&com_7='+com_7+'&com_8='+com_8+'&factor='+factor+'&corr_1='+corr_1+'&corr_2='+corr_2+'&corr_3='+corr_3+'&corr_4='+corr_4+'&corr_5='+corr_5+'&corr_6='+corr_6+'&corr_7='+corr_7+'&corr_8='+corr_8+'&avg_corr='+avg_corr+'&den_1='+den_1+'&den_2='+den_2+'&den_3='+den_3+'&den_4='+den_4+'&den_5='+den_5+'&den_6='+den_6+'&den_7='+den_7+'&den_8='+den_8+'&avg_den='+avg_den+'&chk_wtr='+chk_wtr+'&ulr='+ulr+'&sm1='+sm1+'&sm2='+sm2+'&sm3='+sm3+'&sm4='+sm4+'&sm5='+sm5+'&sm6='+sm6+'&sm7='+sm7+'&sm8='+sm8+'&sm9='+sm9+'&sm10='+sm10+'&sm11='+sm11+'&sm12='+sm12+'&sm13='+sm13+'&sm14='+sm14+'&sm15='+sm15+'&sm16='+sm16+'&sm17='+sm17+'&sm18='+sm18+'&sm19='+sm19+'&sm20='+sm20+'&sm21='+sm21+'&sm22='+sm22+'&sm23='+sm23+'&sm24='+sm24+'&sm25='+sm25+'&sm26='+sm26+'&sm27='+sm27+'&sm28='+sm28+'&sm29='+sm29+'&sm30='+sm30+'&chk_ten='+chk_ten+'&t11='+t11+'&t12='+t12+'&t13='+t13+'&t14='+t14+'&t15='+t15+'&t16='+t16+'&t17='+t17+'&t18='+t18+'&t21='+t21+'&t22='+t22+'&t23='+t23+'&t24='+t24+'&t25='+t25+'&t26='+t26+'&t27='+t27+'&t28='+t28+'&t31='+t31+'&t32='+t32+'&t33='+t33+'&t34='+t34+'&t35='+t35+'&t36='+t36+'&t37='+t37+'&t38='+t38+'&avgt1='+avgt1+'&avgt2='+avgt2+'&avgt3='+avgt3+'&avgt4='+avgt4+'&avgt5='+avgt5+'&avgt6='+avgt6+'&avgt7='+avgt7+'&avgt8='+avgt8+'&f11='+f11+'&f12='+f12+'&f13='+f13+'&f14='+f14+'&f15='+f15+'&f16='+f16+'&f17='+f17+'&f18='+f18+'&f21='+f21+'&f22='+f22+'&f23='+f23+'&f24='+f24+'&f25='+f25+'&f26='+f26+'&f27='+f27+'&f28='+f28+'&avgf1='+avgf1+'&avgf2='+avgf2+'&avgf3='+avgf3+'&avgf4='+avgf4+'&avgf5='+avgf5+'&avgf6='+avgf6+'&avgf7='+avgf7+'&avgf8='+avgf8+'&farea1='+farea1+'&farea2='+farea2+'&farea3='+farea3+'&farea4='+farea4+'&farea5='+farea5+'&farea6='+farea6+'&farea7='+farea7+'&farea8='+farea8+'&spload1='+spload1+'&spload2='+spload2+'&spload3='+spload3+'&spload4='+spload4+'&spload5='+spload5+'&spload6='+spload6+'&spload7='+spload7+'&spload8='+spload8+'&sten1='+sten1+'&sten2='+sten2+'&sten3='+sten3+'&sten4='+sten4+'&sten5='+sten5+'&sten6='+sten6+'&sten7='+sten7+'&sten8='+sten8+'&fload1='+fload1+'&fload2='+fload2+'&fload3='+fload3+'&fload4='+fload4+'&fload5='+fload5+'&fload6='+fload6+'&fload7='+fload7+'&fload8='+fload8+'&avg_tensile='+avg_tensile+'&avg_load='+avg_load+'&chk_fle='+chk_fle+'&flen1='+flen1+'&flen2='+flen2+'&flen3='+flen3+'&flen4='+flen4+'&flen5='+flen5+'&flen6='+flen6+'&flen7='+flen7+'&flen8='+flen8+'&fwid1='+fwid1+'&fwid2='+fwid2+'&fwid3='+fwid3+'&fwid4='+fwid4+'&fwid5='+fwid5+'&fwid6='+fwid6+'&fwid7='+fwid7+'&fwid8='+fwid8+'&fthk1='+fthk1+'&fthk2='+fthk2+'&fthk3='+fthk3+'&fthk4='+fthk4+'&fthk5='+fthk5+'&fthk6='+fthk6+'&fthk7='+fthk7+'&fthk8='+fthk8+'&fdis1='+fdis1+'&fdis2='+fdis2+'&fdis3='+fdis3+'&fdis4='+fdis4+'&fdis5='+fdis5+'&fdis6='+fdis6+'&fdis7='+fdis7+'&fdis8='+fdis8+'&floa1='+floa1+'&floa2='+floa2+'&floa3='+floa3+'&floa4='+floa4+'&floa5='+floa5+'&floa6='+floa6+'&floa7='+floa7+'&floa8='+floa8+'&fle1='+fle1+'&fle2='+fle2+'&fle3='+fle3+'&fle4='+fle4+'&fle5='+fle5+'&fle6='+fle6+'&fle7='+fle7+'&fle8='+fle8+'&avg_fle='+avg_fle+  '&s_des=' + s_des +  '&r_sam=' + r_sam +  '&s_ret=' + s_ret +  '&qty_1=' + qty_1 +  '&chk_dim=' + chk_dim +  '&h1_1=' + h1_1 +  '&h2_1=' + h2_1 +  '&h3_1=' + h3_1 +  '&h4_1=' + h4_1 +  '&h5_1=' + h5_1 +  '&h6_1=' + h6_1 +  '&h7_1=' + h7_1 +  '&h8_1=' + h8_1 +  '&l1_1=' + l1_1 +  '&l2_1=' + l2_1 +  '&l3_1=' + l3_1 +  '&l4_1=' + l4_1 +  '&l5_1=' + l5_1 +  '&l6_1=' + l6_1 +  '&l7_1=' + l7_1 +  '&l8_1=' + l8_1 +  '&w1_1=' + w1_1 +  '&w2_1=' + w2_1 +  '&w3_1=' + w3_1 +  '&w4_1=' + w4_1 +  '&w5_1=' + w5_1 +  '&w6_1=' + w6_1 +  '&w7_1=' + w7_1 +  '&w8_1=' + w8_1 +  '&height_avg=' + height_avg +  '&length_avg=' + length_avg +  '&width_avg=' + width_avg  ;

				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var paver_shape = $('#top_shape').val();
				var paver_age = $('#top_age').val();
				var paver_color = $('#top_color').val();							
				var paver_thickNess = $('#top_thickNess').val();	
				var paver_grade = $('#top_grade').val();	
				var ulr = $('#ulr').val();	
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	

				
				//Compressive strength
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
						
							
							lab_1 = $('#lab_1').val();
							lab_2 = $('#lab_2').val();
							lab_3 = $('#lab_3').val();
							lab_4 = $('#lab_4').val();
							lab_5 = $('#lab_5').val();
							lab_6 = $('#lab_6').val();
							lab_7 = $('#lab_7').val();
							lab_8 = $('#lab_8').val();
							
							var m1 = $('#m1').val();
							var m2 = $('#m2').val();
							var m3 = $('#m3').val();
							var m4 = $('#m4').val();
							var m5 = $('#m5').val();
							var m6 = $('#m6').val();
							var m7 = $('#m7').val();
							var m8 = $('#m8').val();
							var s_des = $('#s_des').val();
                            var r_sam = $('#r_sam').val();
                            var s_ret = $('#s_ret').val();
                            var qty_1 = $('#qty_1').val();

							
							var grade = $('#grade_1').val();
							var thick = $('#thick_1').val();
							var factor = $('#factor_1').val();
							
							var area_1 = $('#area_1').val();
							var area_2 = $('#area_2').val();
							var area_3 = $('#area_3').val();
							var area_4 = $('#area_4').val();
							var area_5 = $('#area_5').val();
							var area_6 = $('#area_6').val();
							var area_7 = $('#area_7').val();
							var area_8 = $('#area_8').val();
							
							var load_1 = $('#load_1').val();
							var load_2 = $('#load_2').val();
							var load_3 = $('#load_3').val();
							var load_4 = $('#load_4').val();
							var load_5 = $('#load_5').val();
							var load_6 = $('#load_6').val();
							var load_7 = $('#load_7').val();
							var load_8 = $('#load_8').val();
							
							var com_1 = $('#com_1').val();
							var com_2 = $('#com_2').val();
							var com_3 = $('#com_3').val();
							var com_4 = $('#com_4').val();
							var com_5 = $('#com_5').val();
							var com_6 = $('#com_6').val();
							var com_7 = $('#com_7').val();
							var com_8 = $('#com_8').val();
							
							var corr_1 = $('#corr_1').val();
							var corr_2 = $('#corr_2').val();
							var corr_3 = $('#corr_3').val();
							var corr_4 = $('#corr_4').val();
							var corr_5 = $('#corr_5').val();
							var corr_6 = $('#corr_6').val();
							var corr_7 = $('#corr_7').val();
							var corr_8 = $('#corr_8').val();
							var avg_corr = $('#avg_corr').val();
							
							var den_1 = $('#den_1').val();
							var den_2 = $('#den_2').val();
							var den_3 = $('#den_3').val();
							var den_4 = $('#den_4').val();
							var den_5 = $('#den_5').val();
							var den_6 = $('#den_6').val();
							var den_7 = $('#den_7').val();
							var den_8 = $('#den_8').val();
							var avg_den = $('#avg_den').val();
							
							var sm1 = $('#sm1').val();
							var sm2 = $('#sm2').val();
							var sm3 = $('#sm3').val();
							var sm4 = $('#sm4').val();
							var sm5 = $('#sm5').val();
							var sm6 = $('#sm6').val();
							var sm7 = $('#sm7').val();
							var sm8 = $('#sm8').val();
							var sm9 = $('#sm9').val();
							var sm10 = $('#sm10').val();
							var sm11 = $('#sm11').val();
							var sm12 = $('#sm12').val();
							var sm13 = $('#sm13').val();
							var sm14 = $('#sm14').val();
							var sm15 = $('#sm15').val();
							var sm16 = $('#sm16').val();
							var sm17 = $('#sm17').val();
							var sm18 = $('#sm18').val();
							var sm19 = $('#sm19').val();
							var sm20 = $('#sm20').val();
							var sm21 = $('#sm21').val();
							var sm22 = $('#sm22').val();
							var sm23 = $('#sm23').val();
							var sm24 = $('#sm24').val();
							var sm25 = $('#sm25').val();
							var sm26 = $('#sm26').val();
							var sm27 = $('#sm27').val();
							var sm28 = $('#sm28').val();
							var sm29 = $('#sm29').val();
							var sm30 = $('#sm30').val();
						break;
					}
					else
					{
							var chk_com = "0";
							
							
							lab_1 = "";
							lab_2 = "";	
							lab_3 = "";
							lab_4 = "";
							lab_5 = "";
							lab_6 = "";
							lab_7 = "";
							lab_8 = "";
							
							var m1 = "";
							var m2 = "";
							var m3 = "";
							var m4 = "";
							var m5 = "";
							var m6 = "";
							var m7 = "";
							var m8 = "";
							var s_des = "";
                            var r_sam = "";
                            var s_ret = "";
                            var qty_1 = "";

							
							var grade = "";
							var thick = "";
							var factor = "";
							
							var area_1 = "";
							var area_2 = "";
							var area_3 = "";
							var area_4 = "";
							var area_5 = "";
							var area_6 = "";
							var area_7 = "";
							var area_8 = "";
							
							var load_1 = "";
							var load_2 = "";
							var load_3 = "";
							var load_4 = "";
							var load_5 = "";
							var load_6 = "";
							var load_7 = "";
							var load_8 = "";
							
							var com_1 = "";
							var com_2 = "";
							var com_3 = "";
							var com_4 = "";
							var com_5 = "";
							var com_6 = "";
							var com_7 = ""; 
							var com_8 = "";
							
							var corr_1 = "";
							var corr_2 = "";
							var corr_3 = "";
							var corr_4 = "";
							var corr_5 = "";
							var corr_6 = "";
							var corr_7 = "";
							var corr_8 = "";
							var avg_corr = $('#avg_corr').val();
							
							var den_1 = "";
							var den_2 = "";
							var den_3 = "";
							var den_4 = "";
							var den_5 = "";
							var den_6 = "";
							var den_7 = "";
							var den_8 = "";
							var avg_den = $('#avg_den').val();
							
							var sm1 = "";
							var sm2 = "";
							var sm3 = "";
							var sm4 = "";
							var sm5 = "";
							var sm6 = "";
							var sm7 = "";
							var sm8 = "";
							var sm9 = "";
							var sm10 = "";
							var sm11 = "";
							var sm12 = "";
							var sm13 = "";
							var sm14 = "";
							var sm15 = "";
							var sm16 = "";
							var sm17 = "";
							var sm18 = "";
							var sm19 = "";
							var sm20 = "";
							var sm21 = "";
							var sm22 = "";
							var sm23 = "";
							var sm24 = "";
							var sm25 = "";
							var sm26 = "";
							var sm27 = "";
							var sm28 = "";
							var sm29 = "";
							var sm30 = "";
					}
				}
				
				//DIMENSION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dim")
					{
						if(document.getElementById('chk_dim').checked) {
								var chk_dim = "1";
						}
						else{
								var chk_dim = "0";
						}
							var chk_dim = $('#chk_dim').val();
							var h1_1 = $('#h1_1').val();
							var h2_1 = $('#h2_1').val();
							var h3_1 = $('#h3_1').val();
							var h4_1 = $('#h4_1').val();
							var h5_1 = $('#h5_1').val();
							var h6_1 = $('#h6_1').val();
							var h7_1 = $('#h7_1').val();
							var h8_1 = $('#h8_1').val();
							var l1_1 = $('#l1_1').val();
							var l2_1 = $('#l2_1').val();
							var l3_1 = $('#l3_1').val();
							var l4_1 = $('#l4_1').val();
							var l5_1 = $('#l5_1').val();
							var l6_1 = $('#l6_1').val();
							var l7_1 = $('#l7_1').val();
							var l8_1 = $('#l8_1').val();
							var w1_1 = $('#w1_1').val();
							var w2_1 = $('#w2_1').val();
							var w3_1 = $('#w3_1').val();
							var w4_1 = $('#w4_1').val();
							var w5_1 = $('#w5_1').val();
							var w6_1 = $('#w6_1').val();
							var w7_1 = $('#w7_1').val();
							var w8_1 = $('#w8_1').val();
							var height_avg = $('#height_avg').val();
							var length_avg = $('#length_avg').val();
							var width_avg = $('#width_avg').val();


								
							
						break;
					}
					else
					{
							
							var chk_dim = "";
							var h1_1 = "";
							var h2_1 = "";
							var h3_1 = "";
							var h4_1 = "";
							var h5_1 = "";
							var h6_1 = "";
							var h7_1 = "";
							var h8_1 = "";
							var l1_1 = "";
							var l2_1 = "";
							var l3_1 = "";
							var l4_1 = "";
							var l5_1 = "";
							var l6_1 = "";
							var l7_1 = "";
							var l8_1 = "";
							var w1_1 = "";
							var w2_1 = "";
							var w3_1 = "";
							var w4_1 = "";
							var w5_1 = "";
							var w6_1 = "";
							var w7_1 = "";
							var w8_1 = "";
							var height_avg = "";
							var length_avg = "";
							var width_avg = "";

							
							
							
							
					}
				}
				//Tensile Strength
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ten")
					{
						if(document.getElementById('chk_ten').checked) {
								var chk_ten = "1";
						}
						else{
								var chk_ten = "0";
						}
							var sm15 = $('#sm15').val();
							var sm16 = $('#sm16').val();
							var sm17 = $('#sm17').val();
							var sm18 = $('#sm18').val();
							var sm19 = $('#sm19').val();
							var sm20 = $('#sm20').val();
							var sm21 = $('#sm21').val();
							var sm22 = $('#sm22').val();
						
							var t11 = $('#t11').val();
							var t12 = $('#t12').val();
							var t13 = $('#t13').val();
							var t14 = $('#t14').val();
							var t15 = $('#t15').val();
							var t16 = $('#t16').val();
							var t17 = $('#t17').val();
							var t18 = $('#t18').val();
							
							var t21 = $('#t21').val();
							var t22 = $('#t22').val();
							var t23 = $('#t23').val();
							var t24 = $('#t24').val();
							var t25 = $('#t25').val();
							var t26 = $('#t26').val();
							var t27 = $('#t27').val();
							var t28 = $('#t28').val();
							
							var t31 = $('#t31').val();
							var t32 = $('#t32').val();
							var t33 = $('#t33').val();
							var t34 = $('#t34').val();
							var t35 = $('#t35').val();
							var t36 = $('#t36').val();
							var t37 = $('#t37').val();
							var t38 = $('#t38').val();
							
							var avgt1 = $('#avgt1').val();
							var avgt2 = $('#avgt2').val();
							var avgt3 = $('#avgt3').val();
							var avgt4 = $('#avgt4').val();
							var avgt5 = $('#avgt5').val();
							var avgt6 = $('#avgt6').val();
							var avgt7 = $('#avgt7').val();
							var avgt8 = $('#avgt8').val();
							
							var f11 = $('#f11').val();
							var f12 = $('#f12').val();
							var f13 = $('#f13').val();
							var f14 = $('#f14').val();
							var f15 = $('#f15').val();
							var f16 = $('#f16').val();
							var f17 = $('#f17').val();
							var f18 = $('#f18').val();
							var f21 = $('#f21').val();
							var f22 = $('#f22').val();
							var f23 = $('#f23').val();
							var f24 = $('#f24').val();
							var f25 = $('#f25').val();
							var f26 = $('#f26').val();
							var f27 = $('#f27').val();
							var f28 = $('#f28').val();
							
							var avgf1 = $('#avgf1').val();
							var avgf2 = $('#avgf2').val();
							var avgf3 = $('#avgf3').val();
							var avgf4 = $('#avgf4').val();
							var avgf5 = $('#avgf5').val();
							var avgf6 = $('#avgf6').val();
							var avgf7 = $('#avgf7').val();
							var avgf8 = $('#avgf8').val();
							
							var farea1 = $('#farea1').val();
							var farea2 = $('#farea2').val();
							var farea3 = $('#farea3').val();
							var farea4 = $('#farea4').val();
							var farea5 = $('#farea5').val();
							var farea6 = $('#farea6').val();
							var farea7 = $('#farea7').val();
							var farea8 = $('#farea8').val();
							
							var spload1 = $('#spload1').val();
							var spload2 = $('#spload2').val();
							var spload3 = $('#spload3').val();
							var spload4 = $('#spload4').val();
							var spload5 = $('#spload5').val();
							var spload6 = $('#spload6').val();
							var spload7 = $('#spload7').val();
							var spload8 = $('#spload8').val();
							
							var sten1 = $('#sten1').val();
							var sten2 = $('#sten2').val();
							var sten3 = $('#sten3').val();
							var sten4 = $('#sten4').val();
							var sten5 = $('#sten5').val();
							var sten6 = $('#sten6').val();
							var sten7 = $('#sten7').val();
							var sten8 = $('#sten8').val();
							
							var fload1 = $('#fload1').val();
							var fload2 = $('#fload2').val();
							var fload3 = $('#fload3').val();
							var fload4 = $('#fload4').val();
							var fload5 = $('#fload5').val();
							var fload6 = $('#fload6').val();
							var fload7 = $('#fload7').val();
							var fload8 = $('#fload8').val();
							var avg_tensile = $('#avg_tensile').val();
							var avg_load = $('#avg_load').val();
							
							
								
							
						break;
					}
					else
					{
							var chk_ten = "0";
							var avg_tensile = "";
							var avg_load = "";
							
							var sm15 = "";
							var sm16 = "";
							var sm17 = "";
							var sm18 = "";
							var sm19 = "";
							var sm20 = "";
							var sm21 = "";
							var sm22 = "";
						
							var t11 = "";
							var t12 = "";
							var t13 = "";
							var t14 = "";
							var t15 = "";
							var t16 = "";
							var t17 = "";
							var t18 = "";
							
							var t21 = "";
							var t22 = "";
							var t23 = "";
							var t24 = "";
							var t25 = "";
							var t26 = "";
							var t27 = "";
							var t28 = "";
							
							var t31 = "";
							var t32 = "";
							var t33 = "";
							var t34 = "";
							var t35 = "";
							var t36 = "";
							var t37 = "";
							var t38 = "";
							
							var avgt1 = "";
							var avgt2 = "";
							var avgt3 = "";
							var avgt4 = "";
							var avgt5 = "";
							var avgt6 = "";
							var avgt7 = "";
							var avgt8 = "";
							
							var f11 = "";
							var f12 = "";
							var f13 = "";
							var f14 = "";
							var f15 = "";
							var f16 = "";
							var f17 = "";
							var f18 = "";
							var f21 = "";
							var f22 = "";
							var f23 = "";
							var f24 = "";
							var f25 = "";
							var f26 = "";
							var f27 = "";
							var f28 = "";
							
							var avgf1 = "";
							var avgf2 = "";
							var avgf3 = "";
							var avgf4 = "";
							var avgf5 = "";
							var avgf6 = "";
							var avgf7 = "";
							var avgf8 = "";
							
							var farea1 = "";
							var farea2 = "";
							var farea3 = "";
							var farea4 = "";
							var farea5 = "";
							var farea6 = "";
							var farea7 = "";
							var farea8 = "";
							
							var spload1 = "";
							var spload2 = "";
							var spload3 = "";
							var spload4 = "";
							var spload5 = "";
							var spload6 = "";
							var spload7 = "";
							var spload8 = "";
							
							var sten1 = "";
							var sten2 = "";
							var sten3 = "";
							var sten4 = "";
							var sten5 = "";
							var sten6 = "";
							var sten7 = "";
							var sten8 = "";
							
							var fload1 = "";
							var fload2 = "";
							var fload3 = "";
							var fload4 = "";
							var fload5 = "";
							var fload6 = "";
							var fload7 = "";
							var fload8 = "";
							
							
					}
				}
				
				//Flexural Strength
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
							var sm23 = $('#sm23').val();
							var sm24 = $('#sm24').val();
							var sm25 = $('#sm25').val();
							var sm26 = $('#sm26').val();
							var sm27 = $('#sm27').val();
							var sm28 = $('#sm28').val();
							var sm29 = $('#sm29').val();
							var sm30 = $('#sm30').val();
						
							var flen1 = $('#flen1').val();
							var flen2 = $('#flen2').val();
							var flen3 = $('#flen3').val();
							var flen4 = $('#flen4').val();
							var flen5 = $('#flen5').val();
							var flen6 = $('#flen6').val();
							var flen7 = $('#flen7').val();
							var flen8 = $('#flen8').val();
							
							var fwid1 = $('#fwid1').val();
							var fwid2 = $('#fwid2').val();
							var fwid3 = $('#fwid3').val();
							var fwid4 = $('#fwid4').val();
							var fwid5 = $('#fwid5').val();
							var fwid6 = $('#fwid6').val();
							var fwid7 = $('#fwid7').val();
							var fwid8 = $('#fwid8').val();
							
							var fthk1 = $('#fthk1').val();
							var fthk2 = $('#fthk2').val();
							var fthk3 = $('#fthk3').val();
							var fthk4 = $('#fthk4').val();
							var fthk5 = $('#fthk5').val();
							var fthk6 = $('#fthk6').val();
							var fthk7 = $('#fthk7').val();
							var fthk8 = $('#fthk8').val();
							
							var fdis1 = $('#fdis1').val();
							var fdis2 = $('#fdis2').val();
							var fdis3 = $('#fdis3').val();
							var fdis4 = $('#fdis4').val();
							var fdis5 = $('#fdis5').val();
							var fdis6 = $('#fdis6').val();
							var fdis7 = $('#fdis7').val();
							var fdis8 = $('#fdis8').val();
							
							var floa1 = $('#floa1').val();
							var floa2 = $('#floa2').val();
							var floa3 = $('#floa3').val();
							var floa4 = $('#floa4').val();
							var floa5 = $('#floa5').val();
							var floa6 = $('#floa6').val();
							var floa7 = $('#floa7').val();
							var floa8 = $('#floa8').val();
							
							var fle1 = $('#fle1').val();
							var fle2 = $('#fle2').val();
							var fle3 = $('#fle3').val();
							var fle4 = $('#fle4').val();
							var fle5 = $('#fle5').val();
							var fle6 = $('#fle6').val();
							var fle7 = $('#fle7').val();
							var fle8 = $('#fle8').val();
							
							var avg_fle = $('#avg_fle').val();
							
								
							
						break;
					}
					else
					{
							var chk_fle = "0";
							var avg_fle = "0";
							
							var sm23 = "";
							var sm24 = "";
							var sm25 = "";
							var sm26 = "";
							var sm27 = "";
							var sm28 = "";
							var sm29 = "";
							var sm30 = "";
						
							var flen1 = "";
							var flen2 = "";
							var flen3 = "";
							var flen4 = "";
							var flen5 = "";
							var flen6 = "";
							var flen7 = "";
							var flen8 = "";
							
							var fwid1 = "";
							var fwid2 = "";
							var fwid3 = "";
							var fwid4 = "";
							var fwid5 = "";
							var fwid6 = "";
							var fwid7 = "";
							var fwid8 = "";
							
							var fthk1 = "";
							var fthk2 = "";
							var fthk3 = "";
							var fthk4 = "";
							var fthk5 = "";
							var fthk6 = "";
							var fthk7 = "";
							var fthk8 = "";
							
							var fdis1 = "";
							var fdis2 = "";
							var fdis3 = "";
							var fdis4 = "";
							var fdis5 = "";
							var fdis6 = "";
							var fdis7 = "";
							var fdis8 = "";
							
							var floa1 = "";
							var floa2 = "";
							var floa3 = "";
							var floa4 = "";
							var floa5 = "";
							var floa6 = "";
							var floa7 = "";
							var floa8 = "";
							
							var fle1 = "";
							var fle2 = "";
							var fle3 = "";
							var fle4 = "";
							var fle5 = "";
							var fle6 = "";
							var fle7 = "";
							var fle8 = "";
							
							
					}
				}
				
				
				//water absorption
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{
						if(document.getElementById('chk_wtr').checked) {
								var chk_wtr = "1";
						}
						else{
								var chk_wtr = "0";
						}
																		
							var wtr_w1_1 = $('#wtr_w1_1').val();
							var wtr_w1_2 = $('#wtr_w1_2').val();
							var wtr_w1_3 = $('#wtr_w1_3').val();
							
							
							var wtr_w2_1 = $('#wtr_w2_1').val();
							var wtr_w2_2 = $('#wtr_w2_2').val();
							var wtr_w2_3 = $('#wtr_w2_3').val();
							
							var wtr_1 = $('#wtr_1').val();
							var wtr_2 = $('#wtr_2').val();
							var wtr_3 = $('#wtr_3').val();
							
							var avg_wtr = $('#avg_wtr').val();
							
						break;
					}
					else
					{
						var chk_wtr = "0";	
						var wtr_w1_1 = "";						
						var wtr_w1_2 = "";
						var wtr_w1_3 = "";
						
						
						var wtr_w2_1 = "";
						var wtr_w2_2 = "";
						var wtr_w2_3 = "";
						
						var wtr_1 = "";
						var wtr_2 = "";
						var wtr_3 = "";
						
						var avg_wtr = "";
					}
				}
				
				
				var idEdit = $('#idEdit').val(); 

				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_com='+chk_com+'&wtr_w1_1='+wtr_w1_1+'&wtr_w1_2='+wtr_w1_2+'&wtr_w1_3='+wtr_w1_3+'&wtr_w2_1='+wtr_w2_1+'&wtr_w2_2='+wtr_w2_2+'&wtr_w2_3='+wtr_w2_3+'&wtr_1='+wtr_1+'&wtr_2='+wtr_2+'&wtr_3='+wtr_3+'&avg_wtr='+avg_wtr+'&paver_shape='+paver_shape+'&paver_age='+paver_age+'&paver_color='+paver_color+'&paver_thickNess='+paver_thickNess+'&paver_grade='+paver_grade+'&lab_1='+lab_1+'&lab_2='+lab_2+'&lab_3='+lab_3+'&lab_4='+lab_4+'&lab_5='+lab_5+'&lab_6='+lab_6+'&lab_7='+lab_7+'&lab_8='+lab_8+'&m1='+m1+'&m2='+m2+'&m3='+m3+'&m4='+m4+'&m5='+m5+'&m6='+m6+'&m7='+m7+'&m8='+m8+'&grade='+grade+'&thick='+thick+'&area_1='+area_1+'&area_2='+area_2+'&area_3='+area_3+'&area_4='+area_4+'&area_5='+area_5+'&area_6='+area_6+'&area_7='+area_7+'&area_8='+area_8+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&load_6='+load_6+'&load_7='+load_7+'&load_8='+load_8+'&com_1='+com_1+'&com_2='+com_2+'&com_3='+com_3+'&com_4='+com_4+'&com_5='+com_5+'&com_6='+com_6+'&com_7='+com_7+'&com_8='+com_8+'&factor='+factor+'&corr_1='+corr_1+'&corr_2='+corr_2+'&corr_3='+corr_3+'&corr_4='+corr_4+'&corr_5='+corr_5+'&corr_6='+corr_6+'&corr_7='+corr_7+'&corr_8='+corr_8+'&avg_corr='+avg_corr+'&den_1='+den_1+'&den_2='+den_2+'&den_3='+den_3+'&den_4='+den_4+'&den_5='+den_5+'&den_6='+den_6+'&den_7='+den_7+'&den_8='+den_8+'&avg_den='+avg_den+'&chk_wtr='+chk_wtr+'&ulr='+ulr+'&sm1='+sm1+'&sm2='+sm2+'&sm3='+sm3+'&sm4='+sm4+'&sm5='+sm5+'&sm6='+sm6+'&sm7='+sm7+'&sm8='+sm8+'&sm9='+sm9+'&sm10='+sm10+'&sm11='+sm11+'&sm12='+sm12+'&sm13='+sm13+'&sm14='+sm14+'&sm15='+sm15+'&sm16='+sm16+'&sm17='+sm17+'&sm18='+sm18+'&sm19='+sm19+'&sm20='+sm20+'&sm21='+sm21+'&sm22='+sm22+'&sm23='+sm23+'&sm24='+sm24+'&sm25='+sm25+'&sm26='+sm26+'&sm27='+sm27+'&sm28='+sm28+'&sm29='+sm29+'&sm30='+sm30+'&chk_ten='+chk_ten+'&t11='+t11+'&t12='+t12+'&t13='+t13+'&t14='+t14+'&t15='+t15+'&t16='+t16+'&t17='+t17+'&t18='+t18+'&t21='+t21+'&t22='+t22+'&t23='+t23+'&t24='+t24+'&t25='+t25+'&t26='+t26+'&t27='+t27+'&t28='+t28+'&t31='+t31+'&t32='+t32+'&t33='+t33+'&t34='+t34+'&t35='+t35+'&t36='+t36+'&t37='+t37+'&t38='+t38+'&avgt1='+avgt1+'&avgt2='+avgt2+'&avgt3='+avgt3+'&avgt4='+avgt4+'&avgt5='+avgt5+'&avgt6='+avgt6+'&avgt7='+avgt7+'&avgt8='+avgt8+'&f11='+f11+'&f12='+f12+'&f13='+f13+'&f14='+f14+'&f15='+f15+'&f16='+f16+'&f17='+f17+'&f18='+f18+'&f21='+f21+'&f22='+f22+'&f23='+f23+'&f24='+f24+'&f25='+f25+'&f26='+f26+'&f27='+f27+'&f28='+f28+'&avgf1='+avgf1+'&avgf2='+avgf2+'&avgf3='+avgf3+'&avgf4='+avgf4+'&avgf5='+avgf5+'&avgf6='+avgf6+'&avgf7='+avgf7+'&avgf8='+avgf8+'&farea1='+farea1+'&farea2='+farea2+'&farea3='+farea3+'&farea4='+farea4+'&farea5='+farea5+'&farea6='+farea6+'&farea7='+farea7+'&farea8='+farea8+'&spload1='+spload1+'&spload2='+spload2+'&spload3='+spload3+'&spload4='+spload4+'&spload5='+spload5+'&spload6='+spload6+'&spload7='+spload7+'&spload8='+spload8+'&sten1='+sten1+'&sten2='+sten2+'&sten3='+sten3+'&sten4='+sten4+'&sten5='+sten5+'&sten6='+sten6+'&sten7='+sten7+'&sten8='+sten8+'&fload1='+fload1+'&fload2='+fload2+'&fload3='+fload3+'&fload4='+fload4+'&fload5='+fload5+'&fload6='+fload6+'&fload7='+fload7+'&fload8='+fload8+'&avg_tensile='+avg_tensile+'&avg_load='+avg_load+'&chk_fle='+chk_fle+'&flen1='+flen1+'&flen2='+flen2+'&flen3='+flen3+'&flen4='+flen4+'&flen5='+flen5+'&flen6='+flen6+'&flen7='+flen7+'&flen8='+flen8+'&fwid1='+fwid1+'&fwid2='+fwid2+'&fwid3='+fwid3+'&fwid4='+fwid4+'&fwid5='+fwid5+'&fwid6='+fwid6+'&fwid7='+fwid7+'&fwid8='+fwid8+'&fthk1='+fthk1+'&fthk2='+fthk2+'&fthk3='+fthk3+'&fthk4='+fthk4+'&fthk5='+fthk5+'&fthk6='+fthk6+'&fthk7='+fthk7+'&fthk8='+fthk8+'&fdis1='+fdis1+'&fdis2='+fdis2+'&fdis3='+fdis3+'&fdis4='+fdis4+'&fdis5='+fdis5+'&fdis6='+fdis6+'&fdis7='+fdis7+'&fdis8='+fdis8+'&floa1='+floa1+'&floa2='+floa2+'&floa3='+floa3+'&floa4='+floa4+'&floa5='+floa5+'&floa6='+floa6+'&floa7='+floa7+'&floa8='+floa8+'&fle1='+fle1+'&fle2='+fle2+'&fle3='+fle3+'&fle4='+fle4+'&fle5='+fle5+'&fle6='+fle6+'&fle7='+fle7+'&fle8='+fle8+'&avg_fle='+avg_fle+  '&s_des=' + s_des +  '&r_sam=' + r_sam +  '&s_ret=' + s_ret +  '&qty_1=' + qty_1 +  '&chk_dim=' + chk_dim +  '&h1_1=' + h1_1 +  '&h2_1=' + h2_1 +  '&h3_1=' + h3_1 +  '&h4_1=' + h4_1 +  '&h5_1=' + h5_1 +  '&h6_1=' + h6_1 +  '&h7_1=' + h7_1 +  '&h8_1=' + h8_1 +  '&l1_1=' + l1_1 +  '&l2_1=' + l2_1 +  '&l3_1=' + l3_1 +  '&l4_1=' + l4_1 +  '&l5_1=' + l5_1 +  '&l6_1=' + l6_1 +  '&l7_1=' + l7_1 +  '&l8_1=' + l8_1 +  '&w1_1=' + w1_1 +  '&w2_1=' + w2_1 +  '&w3_1=' + w3_1 +  '&w4_1=' + w4_1 +  '&w5_1=' + w5_1 +  '&w6_1=' + w6_1 +  '&w7_1=' + w7_1 +  '&w8_1=' + w8_1 +  '&height_avg=' + height_avg +  '&length_avg=' + length_avg +  '&width_avg=' + width_avg ;
		
				
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>savespan_paveblock.php',
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
        url: '<?php echo $base_url; ?>savespan_paveblock.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
            $('#idEdit').val(data.id);
	
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#s_des').val(data.s_des);
			$('#r_sam').val(data.r_sam);
			$('#s_ret').val(data.s_ret);
			$('#qty_1').val(data.qty_1);
			
			
            var temp = $('#test_list').val();
				var aa= temp.split(",");	
			
			//Water Absorption	
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{
						
						var chk_wtr = data.chk_wtr;
						if(chk_wtr=="1")
						{
							$('#txtwtr').css("background-color","var(--success)"); 
						   $("#chk_wtr").prop("checked", true); 
						}else{
							$('#txtwtr').css("background-color","white"); 
							$("#chk_wtr").prop("checked", false); 
						}
								
						$('#avg_wtr').val(data.avg_wtr);
					
						$('#wtr_w1_1').val(data.wtr_w1_1);
						$('#wtr_w1_2').val(data.wtr_w1_2);
						$('#wtr_w1_3').val(data.wtr_w1_3);
						
						$('#wtr_w2_1').val(data.wtr_w2_1);
						$('#wtr_w2_2').val(data.wtr_w2_2);
						$('#wtr_w2_3').val(data.wtr_w2_3);
						
						$('#wtr_1').val(data.wtr_1);
						$('#wtr_2').val(data.wtr_2);
						$('#wtr_3').val(data.wtr_3);
						
						break;
					}
					else
					{
						
					}
														
				}
			
				//Compressive Strength
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
								
						$('#avg_corr').val(data.avg_corr);
						$('#avg_den').val(data.avg_den);
						
						$('#lab_1').val(data.lab_1);
						$('#lab_2').val(data.lab_2);
						$('#lab_3').val(data.lab_3);
						$('#lab_4').val(data.lab_4);
						$('#lab_5').val(data.lab_5);
						$('#lab_6').val(data.lab_6);
						$('#lab_7').val(data.lab_7);
						$('#lab_8').val(data.lab_8);

						$('#m1').val(data.m1);
						$('#m2').val(data.m2);
						$('#m3').val(data.m3);
						$('#m4').val(data.m4);
						$('#m5').val(data.m5);
						$('#m6').val(data.m6);
						$('#m7').val(data.m7);
						$('#m8').val(data.m8);

						$('#grade_1').val(data.grade);
						$('#grade_2').val(data.grade);
						$('#grade_3').val(data.grade);
						$('#grade_4').val(data.grade);
						$('#grade_5').val(data.grade);
						$('#grade_6').val(data.grade);
						$('#grade_7').val(data.grade);
						$('#grade_8').val(data.grade);

						$('#thick_1').val(data.thick);
						$('#thick_2').val(data.thick);
						$('#thick_3').val(data.thick);
						$('#thick_4').val(data.thick);
						$('#thick_5').val(data.thick);
						$('#thick_6').val(data.thick);
						$('#thick_7').val(data.thick);
						$('#thick_8').val(data.thick);

						$('#factor_1').val(data.factor);
						$('#factor_2').val(data.factor);
						$('#factor_3').val(data.factor);
						$('#factor_4').val(data.factor);
						$('#factor_5').val(data.factor);
						$('#factor_6').val(data.factor);
						$('#factor_7').val(data.factor);
						$('#factor_8').val(data.factor);

						$('#area_1').val(data.area_1);
						$('#area_2').val(data.area_2);
						$('#area_3').val(data.area_3);
						$('#area_4').val(data.area_4);
						$('#area_5').val(data.area_5);
						$('#area_6').val(data.area_6);
						$('#area_7').val(data.area_7);
						$('#area_8').val(data.area_8);

						$('#load_1').val(data.load_1);
						$('#load_2').val(data.load_2);
						$('#load_3').val(data.load_3);
						$('#load_4').val(data.load_4);
						$('#load_5').val(data.load_5);
						$('#load_6').val(data.load_6);
						$('#load_7').val(data.load_7);
						$('#load_8').val(data.load_8);

						$('#com_1').val(data.com_1);
						$('#com_2').val(data.com_2);
						$('#com_3').val(data.com_3);
						$('#com_4').val(data.com_4);
						$('#com_5').val(data.com_5);
						$('#com_6').val(data.com_6);
						$('#com_7').val(data.com_7);
						$('#com_8').val(data.com_8);

						$('#corr_1').val(data.corr_1);
						$('#corr_2').val(data.corr_2);
						$('#corr_3').val(data.corr_3);
						$('#corr_4').val(data.corr_4);
						$('#corr_5').val(data.corr_5);
						$('#corr_6').val(data.corr_6);
						$('#corr_7').val(data.corr_7);
						$('#corr_8').val(data.corr_8);
						
						$('#den_1').val(data.den_1);
						$('#den_2').val(data.den_2);
						$('#den_3').val(data.den_3);
						$('#den_4').val(data.den_4);
						$('#den_5').val(data.den_5);
						$('#den_6').val(data.den_6);
						$('#den_7').val(data.den_7);
						$('#den_8').val(data.den_8);
						
						$('#sm1').val(data.sm1);
						$('#sm2').val(data.sm2);
						$('#sm3').val(data.sm3);
						$('#sm4').val(data.sm4);
						$('#sm5').val(data.sm5);
						$('#sm6').val(data.sm6);
						$('#sm7').val(data.sm7);
						$('#sm8').val(data.sm8);
																	
						break;
					}
					else
					{
						
					}
														
				}
				
				//DIMENSION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dim")
					{
						
						var chk_dim = data.chk_dim;
						if(chk_dim=="1")
						{
							$('#txtdim').css("background-color","var(--success)"); 
						   $("#chk_dim").prop("checked", true); 
						}else{
							$('#txtdim').css("background-color","white"); 
							$("#chk_dim").prop("checked", false); 
						}
								
						$('#chk_dim').val(data.chk_dim);
						$('#h1_1').val(data.h1_1);
						$('#h2_1').val(data.h2_1);
						$('#h3_1').val(data.h3_1);
						$('#h4_1').val(data.h4_1);
						$('#h5_1').val(data.h5_1);
						$('#h6_1').val(data.h6_1);
						$('#h7_1').val(data.h7_1);
						$('#h8_1').val(data.h8_1);
						$('#l1_1').val(data.l1_1);
						$('#l2_1').val(data.l2_1);
						$('#l3_1').val(data.l3_1);
						$('#l4_1').val(data.l4_1);
						$('#l5_1').val(data.l5_1);
						$('#l6_1').val(data.l6_1);
						$('#l7_1').val(data.l7_1);
						$('#l8_1').val(data.l8_1);
						$('#w1_1').val(data.w1_1);
						$('#w2_1').val(data.w2_1);
						$('#w3_1').val(data.w3_1);
						$('#w4_1').val(data.w4_1);
						$('#w5_1').val(data.w5_1);
						$('#w6_1').val(data.w6_1);
						$('#w7_1').val(data.w7_1);
						$('#w8_1').val(data.w8_1);
						$('#height_avg').val(data.height_avg);
						$('#length_avg').val(data.length_avg);
						$('#width_avg').val(data.width_avg);
						
																	
						break;
					}
					else
					{
						
					}
														
				}
				
				
				//TENSILE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ten")
					{
						
						var chk_ten = data.chk_ten;
						if(chk_ten=="1")
						{
							$('#txtten').css("background-color","var(--success)"); 
						   $("#chk_ten").prop("checked", true); 
						}else{
							$('#txtten').css("background-color","white"); 
							$("#chk_ten").prop("checked", false); 
						}
								
						$('#sm15').val(data.sm15);
						$('#sm16').val(data.sm16);
						$('#sm17').val(data.sm17);
						$('#sm18').val(data.sm18);
						$('#sm19').val(data.sm19);
						$('#sm20').val(data.sm20);
						$('#sm21').val(data.sm21);
						$('#sm22').val(data.sm22);
						
						$('#t11').val(data.t11);
						$('#t12').val(data.t12);
						$('#t13').val(data.t13);
						$('#t14').val(data.t14);
						$('#t15').val(data.t15);
						$('#t16').val(data.t16);
						$('#t17').val(data.t17);
						$('#t18').val(data.t18);
						
						$('#t21').val(data.t21);
						$('#t22').val(data.t22);
						$('#t23').val(data.t23);
						$('#t24').val(data.t24);
						$('#t25').val(data.t25);
						$('#t26').val(data.t26);
						$('#t27').val(data.t27);
						$('#t28').val(data.t28);
						
						$('#t31').val(data.t31);
						$('#t32').val(data.t32);
						$('#t33').val(data.t33);
						$('#t34').val(data.t34);
						$('#t35').val(data.t35);
						$('#t36').val(data.t36);
						$('#t37').val(data.t37);
						$('#t38').val(data.t38);
						
						$('#avgt1').val(data.avgt1);
						$('#avgt2').val(data.avgt2);
						$('#avgt3').val(data.avgt3);
						$('#avgt4').val(data.avgt4);
						$('#avgt5').val(data.avgt5);
						$('#avgt6').val(data.avgt6);
						$('#avgt7').val(data.avgt7);
						$('#avgt8').val(data.avgt8);
						
						$('#f11').val(data.f11);
						$('#f12').val(data.f12);
						$('#f13').val(data.f13);
						$('#f14').val(data.f14);
						$('#f15').val(data.f15);
						$('#f16').val(data.f16);
						$('#f17').val(data.f17);
						$('#f18').val(data.f18);
						
						$('#f21').val(data.f21);
						$('#f22').val(data.f22);
						$('#f23').val(data.f23);
						$('#f24').val(data.f24);
						$('#f25').val(data.f25);
						$('#f26').val(data.f26);
						$('#f27').val(data.f27);
						$('#f28').val(data.f28);
						
						$('#avgf1').val(data.avgf1);
						$('#avgf2').val(data.avgf2);
						$('#avgf3').val(data.avgf3);
						$('#avgf4').val(data.avgf4);
						$('#avgf5').val(data.avgf5);
						$('#avgf6').val(data.avgf6);
						$('#avgf7').val(data.avgf7);
						$('#avgf8').val(data.avgf8);
						
						$('#farea1').val(data.farea1);
						$('#farea2').val(data.farea2);
						$('#farea3').val(data.farea3);
						$('#farea4').val(data.farea4);
						$('#farea5').val(data.farea5);
						$('#farea6').val(data.farea6);
						$('#farea7').val(data.farea7);
						$('#farea8').val(data.farea8);
						
						$('#spload1').val(data.spload1);
						$('#spload2').val(data.spload2);
						$('#spload3').val(data.spload3);
						$('#spload4').val(data.spload4);
						$('#spload5').val(data.spload5);
						$('#spload6').val(data.spload6);
						$('#spload7').val(data.spload7);
						$('#spload8').val(data.spload8);
						
						$('#sten1').val(data.sten1);
						$('#sten2').val(data.sten2);
						$('#sten3').val(data.sten3);
						$('#sten4').val(data.sten4);
						$('#sten5').val(data.sten5);
						$('#sten6').val(data.sten6);
						$('#sten7').val(data.sten7);
						$('#sten8').val(data.sten8);
						
						$('#fload1').val(data.fload1);
						$('#fload2').val(data.fload2);
						$('#fload3').val(data.fload3);
						$('#fload4').val(data.fload4);
						$('#fload5').val(data.fload5);
						$('#fload6').val(data.fload6);
						$('#fload7').val(data.fload7);
						$('#fload8').val(data.fload8);
						
						$('#avg_tensile').val(data.avg_tensile);
						$('#avg_load').val(data.avg_load);
						

						
																	
						break;
					}
					else
					{
						
					}
														
				}
				
				
				//FLEXURAL
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
								
						$('#sm23').val(data.sm23);
						$('#sm24').val(data.sm24);
						$('#sm25').val(data.sm25);
						$('#sm26').val(data.sm26);
						$('#sm27').val(data.sm27);
						$('#sm28').val(data.sm28);
						$('#sm29').val(data.sm29);
						$('#sm30').val(data.sm30);
						
						$('#flen1').val(data.flen1);
						$('#flen2').val(data.flen2);
						$('#flen3').val(data.flen3);
						$('#flen4').val(data.flen4);
						$('#flen5').val(data.flen5);
						$('#flen6').val(data.flen6);
						$('#flen7').val(data.flen7);
						$('#flen8').val(data.flen8);
						
						$('#fwid1').val(data.fwid1);
						$('#fwid2').val(data.fwid2);
						$('#fwid3').val(data.fwid3);
						$('#fwid4').val(data.fwid4);
						$('#fwid5').val(data.fwid5);
						$('#fwid6').val(data.fwid6);
						$('#fwid7').val(data.fwid7);
						$('#fwid8').val(data.fwid8);
						
						$('#fthk1').val(data.fthk1);
						$('#fthk2').val(data.fthk2);
						$('#fthk3').val(data.fthk3);
						$('#fthk4').val(data.fthk4);
						$('#fthk5').val(data.fthk5);
						$('#fthk6').val(data.fthk6);
						$('#fthk7').val(data.fthk7);
						$('#fthk8').val(data.fthk8);
						
						$('#fdis1').val(data.fdis1);
						$('#fdis2').val(data.fdis2);
						$('#fdis3').val(data.fdis3);
						$('#fdis4').val(data.fdis4);
						$('#fdis5').val(data.fdis5);
						$('#fdis6').val(data.fdis6);
						$('#fdis7').val(data.fdis7);
						$('#fdis8').val(data.fdis8);
						
						$('#floa1').val(data.floa1);
						$('#floa2').val(data.floa2);
						$('#floa3').val(data.floa3);
						$('#floa4').val(data.floa4);
						$('#floa5').val(data.floa5);
						$('#floa6').val(data.floa6);
						$('#floa7').val(data.floa7);
						$('#floa8').val(data.floa8);
						
						$('#fle1').val(data.fle1);
						$('#fle2').val(data.fle2);
						$('#fle3').val(data.fle3);
						$('#fle4').val(data.fle4);
						$('#fle5').val(data.fle5);
						$('#fle6').val(data.fle6);
						$('#fle7').val(data.fle7);
						$('#fle8').val(data.fle8);
						$('#s_des').val(data.s_des);
                        $('#r_sam').val(data.r_sam);
                        $('#s_ret').val(data.s_ret);
                        $('#qty_1').val(data.qty_1);


						
						$('#avg_fle').val(data.avg_fle);
						

						
																	
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


