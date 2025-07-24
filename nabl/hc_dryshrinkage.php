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
					date_default_timezone_set('Asia/Kolkata');
					date_default_timezone_get();
					$casting_date = date('Y-m-d');					
					$casting_time = date('H:i:s');					
				}
		
?>
<div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">DRY SHRINKAGE CONCRETE</h2>
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
										  <label for="inputEmail3" class="col-sm-4 control-label"> ID MARK. :</label>									 
										  <div class="col-sm-8">
											<input type="text" class="form-control inputs" tabindex="4" id="cc_identification_mark" value="<?php ?>" name="cc_identification_mark" >
										  </div>
										  </div>
									</div><!--
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
									</div>-->
								</div>
								<br>
								<div class="row">
									

									<div class="col-lg-12">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Grade :</label>									 
										  <div class="col-sm-2">
											<select class="form-control" id="cube_grade" name="cube_grade">
												<option value="">Grade</option>
												<option value="M-5">M - 5</option>
												<option value="M-7.5">M - 7.5</option>
												<option value="M-10">M - 10</option>
												<option value="M-15">M - 15</option>
												<option value="M-20">M - 20</option>
												<option value="M-25">M - 25</option>
												<option value="M-30">M - 30</option>
												<option value="M-35">M - 35</option>
												<option value="M-40">M - 40</option>
												<option value="M-45">M - 45</option>
												<option value="M-50">M - 50</option>
												<option value="1:3:6">1:3:6</option>
												<option value="1:2:4">1:2:4</option>
												<option value="1:1.5:3">1:1.5:3</option>
												<option value="1:5">1:5</option>
												<option value="1:3">1:3</option>
											</select>
											<input type="text" class="form-control inputs" tabindex="4" id="top_grade" value="<?php echo $top_grade;?>" name="top_grade" ReadOnly>
										  </div>
										</div>
									</div>
									
								</div>

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
											// $val =  $_SESSION['isadmin'];
											// if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
											?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_hc_dryshrinkage.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											<?php //} ?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_hc_dryshrinkage.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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
			
			if($r1['test_code']=="SHR")
			{
				$test_check.="SHR,";	
				?>											
				<div class="panel panel-default" id="dry">
					<div class="panel-heading" id="txtdry">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_dry">
								<h4 class="panel-title">
								<b>DRYING SHRINKAGE & MOISTURE MOVEMENT</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse_dry" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">									
								<div class="col-md-6">
									<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_dry">1.</label>
												<input type="checkbox" class="visually-hidden" name="chk_dry"  id="chk_dry" value="chk_dry"><br>
											</div>
										<label for="inputEmail3" class="col-sm-8 control-label label-right">DRYING SHRINKAGE & MOISTURE MOVEMENT</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-6">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<select class="form-control" id="dry_size">
												<option value="300 MM">300 MM</option>
												<option value="150 MM">150 MM</option>
											</select>
										</div>
									</div>
								</div>
							</div>	
							<br>
							<br>
							<div class="row">									
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label"></label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label"></label>
									</div>
								</div>
								<div class="col-md-5" style="border-bottom:1px solid black">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">(Average of 5 reading)</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label"></label>
									</div>
								</div>
								
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label"></label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label"></label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label"></label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-12 control-label"></label>
									</div>
								</div>
							</div>	
							<br>
							<div class="row">									
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">Sr No</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">Average Weight of 5 Consuctive Reading</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">R1</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">R2</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">R3</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">R4</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">R5</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">R6</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">Effective Length (mm) </label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">Drying Shrinkage</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">Wet Measurement after 4 days of immersion in water</label></center>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<center><label for="inputEmail3" class="col-sm-12 control-label">Moisture Movement (%)</label></center>
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
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_avg_1' name='dry_avg_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r1_1' name='dry_r1_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r2_1' name='dry_r2_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r3_1' name='dry_r3_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r4_1' name='dry_r4_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r5_1' name='dry_r5_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r6_1' name='dry_r6_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_len_1' name='dry_len_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_shr_1' name='dry_shr_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_wtr_1' name='dry_wtr_1'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_moi_1' name='dry_moi_1'>
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
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_avg_2' name='dry_avg_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r1_2' name='dry_r1_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r2_2' name='dry_r2_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r3_2' name='dry_r3_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r4_2' name='dry_r4_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r5_2' name='dry_r5_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r6_2' name='dry_r6_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_len_2' name='dry_len_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_shr_2' name='dry_shr_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_wtr_2' name='dry_wtr_2'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_moi_2' name='dry_moi_2'>
									</div>
								</div>
							</div>							
							<br>								
							<div class="row">
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">3.</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_avg_3' name='dry_avg_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r1_3' name='dry_r1_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r2_3' name='dry_r2_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r3_3' name='dry_r3_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r4_3' name='dry_r4_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r5_3' name='dry_r5_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_r6_3' name='dry_r6_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_len_3' name='dry_len_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_shr_3' name='dry_shr_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_wtr_3' name='dry_wtr_3'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='dry_moi_3' name='dry_moi_3'>
									</div>
								</div>
							</div>
							<br>								
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center"></label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center">Average</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_dry_shr' name='avg_dry_shr'>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="inputEmail3" class="control-label text-center"></label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_moi' name='avg_moi'>
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
	
	$('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });
  $(function () {
    $('.select2').select2();
  })
  
$(document).ready(function(){ 
				   
	$('#btn_edit_data').hide();
	$('#alert').hide();
	
	
	
	$('#cube_grade').change(function(){
		
		$('#top_grade').val($('#cube_grade').val());			
		//$('#grade1').val($('#cube_grade').val());			
	});
	
	
	function dry_auto()
	{
		$('#txtdry').css("background-color","var(--success)"); 
		var avg_dry_shr = randomNumberFromRange(0.010,0.035);
		var avg_moi = randomNumberFromRange(0.20,0.60);
		
		$('#avg_dry_shr').val((+avg_dry_shr).toFixed(4));
		$('#avg_moi').val((+avg_moi).toFixed(2));
		
		var avg_dry_shr = $('#avg_dry_shr').val();
		var avg_moi = $('#avg_moi').val();
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var dry_shr_1 = (+avg_dry_shr) + (+0.0023);
			var dry_shr_2 = (+avg_dry_shr) + (+0.0031);
			var dry_shr_3 = (+avg_dry_shr) - (+0.0054);
			
			var dry_moi_1 = (+avg_moi) - (+0.07);
			var dry_moi_2 = (+avg_moi) + (+0.03);
			var dry_moi_3 = (+avg_moi) + (+0.04);
		}else{
			var dry_shr_1 = (+avg_dry_shr) - (+0.0045);
			var dry_shr_2 = (+avg_dry_shr) + (+0.0033);
			var dry_shr_3 = (+avg_dry_shr) + (+0.0012);
			
			var dry_moi_1 = (+avg_moi) + (+0.06);
			var dry_moi_2 = (+avg_moi) + (+0.02);
			var dry_moi_3 = (+avg_moi) - (+0.08);
		}
		
		$('#dry_shr_1').val((+dry_shr_1).toFixed(4));
		$('#dry_shr_2').val((+dry_shr_2).toFixed(4));
		$('#dry_shr_3').val((+dry_shr_3).toFixed(4));
		
		$('#dry_moi_1').val((+dry_moi_1).toFixed(2));
		$('#dry_moi_2').val((+dry_moi_2).toFixed(2));
		$('#dry_moi_3').val((+dry_moi_3).toFixed(2));
		
		var dry_size = $('#dry_size').val();
		
		if(dry_size == "300 MM"){
			var dry_weight = randomNumberFromRange(4.050,4.250).toFixed(3);
			var dry_avg_1 = (+dry_weight) - 0.011;
			var dry_avg_2 = (+dry_weight) + 0.016;
			var dry_avg_3 = (+dry_weight) + 0.028;
		}else{
			var dry_weight = randomNumberFromRange(2.050,2.200).toFixed(3);
			var dry_avg_1 = (+dry_weight) - 0.018;
			var dry_avg_2 = (+dry_weight) - 0.026;
			var dry_avg_3 = (+dry_weight) + 0.010;
		}
		
		$('#dry_avg_1').val((+dry_avg_1).toFixed(3));
		$('#dry_avg_2').val((+dry_avg_2).toFixed(3));
		$('#dry_avg_3').val((+dry_avg_3).toFixed(3));
		
		
		var dry_r1 = randomNumberFromRange(1.000,9.000).toFixed(3);
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var dry_r1_1 = (+dry_r1) - 0.111;
			var dry_r1_2 = (+dry_r1) + 0.032;
			var dry_r1_3 = (+dry_r1) + 0.072;
		}else{                           
			var dry_r1_1 = (+dry_r1) - 0.076;
			var dry_r1_2 = (+dry_r1) - 0.013;
			var dry_r1_3 = (+dry_r1) + 0.110;
		}
		$('#dry_r1_1').val((+dry_r1_1).toFixed(3));
		$('#dry_r1_2').val((+dry_r1_2).toFixed(3));
		$('#dry_r1_3').val((+dry_r1_3).toFixed(3));
		
		$('#dry_len_1').val(250);
		$('#dry_len_2').val(250);
		$('#dry_len_3').val(250);
		
		var dry_shr_1 = $('#dry_shr_1').val();
		var dry_shr_2 = $('#dry_shr_2').val();
		var dry_shr_3 = $('#dry_shr_3').val();
		
		var dry_len_1 = $('#dry_len_1').val();
		var dry_len_2 = $('#dry_len_2').val();
		var dry_len_3 = $('#dry_len_3').val();
		
		var dry_r1_1 = $('#dry_r1_1').val();
		var dry_r1_2 = $('#dry_r1_2').val();
		var dry_r1_3 = $('#dry_r1_3').val();
		
		var dry_r6_1 = (+dry_r1_1) - (((+dry_shr_1) * (+dry_len_1)) / 100);
		var dry_r6_2 = (+dry_r1_2) - (((+dry_shr_2) * (+dry_len_2)) / 100);
		var dry_r6_3 = (+dry_r1_3) - (((+dry_shr_3) * (+dry_len_3)) / 100);
		
		$('#dry_r6_1').val((+dry_r6_1).toFixed(3));
		$('#dry_r6_2').val((+dry_r6_2).toFixed(3));
		$('#dry_r6_3').val((+dry_r6_3).toFixed(3));
		
		
		var dry_r6_1 = $('#dry_r6_1').val();
		var dry_r6_2 = $('#dry_r6_2').val();
		var dry_r6_3 = $('#dry_r6_3').val();

		var dry_moi_1 = $('#dry_moi_1').val();
		var dry_moi_2 = $('#dry_moi_2').val();
		var dry_moi_3 = $('#dry_moi_3').val();

		var dry_wtr_1 = (((+dry_moi_1) * (+dry_r6_1)) / 100) + (+dry_r6_1);
		var dry_wtr_2 = (((+dry_moi_2) * (+dry_r6_2)) / 100) + (+dry_r6_2);
		var dry_wtr_3 = (((+dry_moi_3) * (+dry_r6_3)) / 100) + (+dry_r6_3);

		$('#dry_wtr_1').val((+dry_wtr_1).toFixed(3));
		$('#dry_wtr_2').val((+dry_wtr_2).toFixed(3));
		$('#dry_wtr_3').val((+dry_wtr_3).toFixed(3));

		var dry_r1_1 = $('#dry_r1_1').val();
		var dry_r1_2 = $('#dry_r1_2').val();
		var dry_r1_3 = $('#dry_r1_3').val();
		
		var dry_r2_1 = (+dry_r1_1) - 0.004;
		var dry_r2_2 = (+dry_r1_2) - 0.003;
		var dry_r2_3 = (+dry_r1_3) - 0.002;
		
		$('#dry_r2_1').val((+dry_r2_1).toFixed(3));
		$('#dry_r2_2').val((+dry_r2_2).toFixed(3));
		$('#dry_r2_3').val((+dry_r2_3).toFixed(3));
		
		var dry_r2_1 = $('#dry_r2_1').val();
		var dry_r2_2 = $('#dry_r2_2').val();
		var dry_r2_3 = $('#dry_r2_3').val();
		
		var dry_r3_1 = (+dry_r2_1) - 0.004;
		var dry_r3_2 = (+dry_r2_2) - 0.004;
		var dry_r3_3 = (+dry_r2_3) - 0.003;
		
		$('#dry_r3_1').val((+dry_r3_1).toFixed(3));
		$('#dry_r3_2').val((+dry_r3_2).toFixed(3));
		$('#dry_r3_3').val((+dry_r3_3).toFixed(3));
		
		var dry_r3_1 = $('#dry_r3_1').val();
		var dry_r3_2 = $('#dry_r3_2').val();
		var dry_r3_3 = $('#dry_r3_3').val();
		
		var dry_r4_1 = randomNumberFromRange((+dry_r6_1),(+dry_r3_1));
		var dry_r4_2 = randomNumberFromRange((+dry_r6_2),(+dry_r3_2));
		var dry_r4_3 = randomNumberFromRange((+dry_r6_3),(+dry_r3_3));
		
		$('#dry_r4_1').val((+dry_r4_1).toFixed(3));
		$('#dry_r4_2').val((+dry_r4_2).toFixed(3));
		$('#dry_r4_3').val((+dry_r4_3).toFixed(3));
		
		var dry_r4_1 = $('#dry_r4_1').val();
		var dry_r4_2 = $('#dry_r4_2').val();
		var dry_r4_3 = $('#dry_r4_3').val();
		
		var dry_r5_1 = randomNumberFromRange((+dry_r6_1),(+dry_r4_1));
		var dry_r5_2 = randomNumberFromRange((+dry_r6_2),(+dry_r4_2));
		var dry_r5_3 = randomNumberFromRange((+dry_r6_3),(+dry_r4_3));
		
		$('#dry_r5_1').val((+dry_r5_1).toFixed(3));
		$('#dry_r5_2').val((+dry_r5_2).toFixed(3));
		$('#dry_r5_3').val((+dry_r5_3).toFixed(3));

		//Siddhu Calculation

		var dry_avg_1 = $('#dry_avg_1').val();
		var dry_avg_2 = $('#dry_avg_2').val();
		var dry_avg_3 = $('#dry_avg_3').val();
		
		var dry_r1_1 = $('#dry_r1_1').val();
		var dry_r1_2 = $('#dry_r1_2').val();
		var dry_r1_3 = $('#dry_r1_3').val();
		
		var dry_r2_1 = $('#dry_r2_1').val();
		var dry_r2_2 = $('#dry_r2_2').val();
		var dry_r2_3 = $('#dry_r2_3').val();
		
		var dry_r3_1 = $('#dry_r3_1').val();
		var dry_r3_2 = $('#dry_r3_2').val();
		var dry_r3_3 = $('#dry_r3_3').val();
		
		var dry_r4_1 = $('#dry_r4_1').val();
		var dry_r4_2 = $('#dry_r4_2').val();
		var dry_r4_3 = $('#dry_r4_3').val();
		
		var dry_r5_1 = $('#dry_r5_1').val();
		var dry_r5_2 = $('#dry_r5_2').val();
		var dry_r5_3 = $('#dry_r5_3').val();
		
		var dry_r6_1 = $('#dry_r6_1').val();
		var dry_r6_2 = $('#dry_r6_2').val();
		var dry_r6_3 = $('#dry_r6_3').val();
		
		var dry_len_1 = $('#dry_len_1').val();
		var dry_len_2 = $('#dry_len_2').val();
		var dry_len_3 = $('#dry_len_3').val();
		 
		var dry_shr_1 = (((+dry_r1_1) - (+dry_r6_1)) / (+dry_len_1)) * 100;
		var dry_shr_2 = (((+dry_r1_2) - (+dry_r6_2)) / (+dry_len_2)) * 100;
		var dry_shr_3 = (((+dry_r1_3) - (+dry_r6_3)) / (+dry_len_3)) * 100;
		
		$('#dry_shr_1').val((+dry_shr_1).toFixed(4));
		$('#dry_shr_2').val((+dry_shr_2).toFixed(4));
		$('#dry_shr_3').val((+dry_shr_3).toFixed(4));
		
		var dry_shr_1 = $('#dry_shr_1').val();
		var dry_shr_2 = $('#dry_shr_2').val();
		var dry_shr_3 = $('#dry_shr_3').val();
		
		var avg_dry_shr = ((+dry_shr_1) + (+dry_shr_2) + (+dry_shr_3)) / 3;
		$('#avg_dry_shr').val((+avg_dry_shr).toFixed(4));
		
		var dry_wtr_1 = $('#dry_wtr_1').val();
		var dry_wtr_2 = $('#dry_wtr_2').val();
		var dry_wtr_3 = $('#dry_wtr_3').val();
		
		var dry_moi_1 = (((+dry_wtr_1) - (+dry_r6_1)) / (+dry_r6_1)) * 100;
		var dry_moi_2 = (((+dry_wtr_2) - (+dry_r6_2)) / (+dry_r6_2)) * 100;
		var dry_moi_3 = (((+dry_wtr_3) - (+dry_r6_3)) / (+dry_r6_3)) * 100;
		
		$('#dry_moi_1').val((+dry_moi_1).toFixed(2));
		$('#dry_moi_2').val((+dry_moi_2).toFixed(2));
		$('#dry_moi_3').val((+dry_moi_3).toFixed(2));
		
		var dry_moi_1 = $('#dry_moi_1').val();
		var dry_moi_2 = $('#dry_moi_2').val();
		var dry_moi_3 = $('#dry_moi_3').val();
		
		var avg_moi = ((+dry_moi_1) + (+dry_moi_2) + (+dry_moi_3)) / 3;
		$('#avg_moi').val((+avg_moi).toFixed(2));
	}
	
	
	$('#chk_dry').change(function(){
        if(this.checked)
		{
			dry_auto();
		}
		else
		{
			$('#txtdry').css("background-color","white");
			$('#dry_avg_1').val(null);
			$('#dry_avg_2').val(null);
			$('#dry_avg_3').val(null);
			$('#dry_r1_1').val(null);
			$('#dry_r1_2').val(null);
			$('#dry_r1_3').val(null);
			$('#dry_r2_1').val(null);
			$('#dry_r2_2').val(null);
			$('#dry_r2_3').val(null);
			$('#dry_r3_1').val(null);
			$('#dry_r3_2').val(null);
			$('#dry_r3_3').val(null);
			$('#dry_r4_1').val(null);
			$('#dry_r4_2').val(null);
			$('#dry_r4_3').val(null);
			$('#dry_r5_1').val(null);
			$('#dry_r5_2').val(null);
			$('#dry_r5_3').val(null);
			$('#dry_r6_1').val(null);
			$('#dry_r6_2').val(null);
			$('#dry_r6_3').val(null);
			$('#dry_len_1').val(null);
			$('#dry_len_2').val(null);
			$('#dry_len_3').val(null);
			$('#dry_shr_1').val(null);
			$('#dry_shr_2').val(null);
			$('#dry_shr_3').val(null);
			$('#dry_wtr_1').val(null);
			$('#dry_wtr_2').val(null);
			$('#dry_wtr_3').val(null);
			$('#dry_moi_1').val(null);
			$('#dry_moi_2').val(null);
			$('#dry_moi_3').val(null);
			$('#avg_dry_shr').val(null);
			$('#avg_moi').val(null);
		}
	});
	
	
	$('#dry_avg_1, #dry_avg_2, #dry_avg_3, #dry_r1_1, #dry_r1_2, #dry_r1_3, #dry_r2_1, #dry_r2_2, #dry_r2_3, #dry_r3_1, #dry_r3_2, #dry_r3_3, #dry_r4_1, #dry_r4_2, #dry_r4_3,  #dry_r5_1, #dry_r5_2, #dry_r5_3, #dry_r6_1, #dry_r6_2, #dry_r6_3, #dry_len_1, #dry_len_2, #dry_len_3, #dry_wtr_1, #dry_wtr_2, #dry_wtr_3').change(function(){
		
		$('#txtdry').css("background-color","var(--success)");
		
		var dry_avg_1 = $('#dry_avg_1').val();
		var dry_avg_2 = $('#dry_avg_2').val();
		var dry_avg_3 = $('#dry_avg_3').val();
		
		var dry_r1_1 = $('#dry_r1_1').val();
		var dry_r1_2 = $('#dry_r1_2').val();
		var dry_r1_3 = $('#dry_r1_3').val();
		
		var dry_r2_1 = $('#dry_r2_1').val();
		var dry_r2_2 = $('#dry_r2_2').val();
		var dry_r2_3 = $('#dry_r2_3').val();
		
		var dry_r3_1 = $('#dry_r3_1').val();
		var dry_r3_2 = $('#dry_r3_2').val();
		var dry_r3_3 = $('#dry_r3_3').val();
		
		var dry_r4_1 = $('#dry_r4_1').val();
		var dry_r4_2 = $('#dry_r4_2').val();
		var dry_r4_3 = $('#dry_r4_3').val();
		
		var dry_r5_1 = $('#dry_r5_1').val();
		var dry_r5_2 = $('#dry_r5_2').val();
		var dry_r5_3 = $('#dry_r5_3').val();
		
		var dry_r6_1 = $('#dry_r6_1').val();
		var dry_r6_2 = $('#dry_r6_2').val();
		var dry_r6_3 = $('#dry_r6_3').val();
		
		var dry_len_1 = $('#dry_len_1').val();
		var dry_len_2 = $('#dry_len_2').val();
		var dry_len_3 = $('#dry_len_3').val();
		 
		var dry_shr_1 = (((+dry_r1_1) - (+dry_r6_1)) / (+dry_len_1)) * 100;
		var dry_shr_2 = (((+dry_r1_2) - (+dry_r6_2)) / (+dry_len_2)) * 100;
		var dry_shr_3 = (((+dry_r1_3) - (+dry_r6_3)) / (+dry_len_3)) * 100;
		
		$('#dry_shr_1').val((+dry_shr_1).toFixed(4));
		$('#dry_shr_2').val((+dry_shr_2).toFixed(4));
		$('#dry_shr_3').val((+dry_shr_3).toFixed(4));
		
		var dry_shr_1 = $('#dry_shr_1').val();
		var dry_shr_2 = $('#dry_shr_2').val();
		var dry_shr_3 = $('#dry_shr_3').val();
		
		var avg_dry_shr = ((+dry_shr_1) + (+dry_shr_2) + (+dry_shr_3)) / 3;
		$('#avg_dry_shr').val((+avg_dry_shr).toFixed(4));
		
		var dry_wtr_1 = $('#dry_wtr_1').val();
		var dry_wtr_2 = $('#dry_wtr_2').val();
		var dry_wtr_3 = $('#dry_wtr_3').val();
		
		var dry_moi_1 = (((+dry_wtr_1) - (+dry_r6_1)) / (+dry_r6_1)) * 100;
		var dry_moi_2 = (((+dry_wtr_2) - (+dry_r6_2)) / (+dry_r6_2)) * 100;
		var dry_moi_3 = (((+dry_wtr_3) - (+dry_r6_3)) / (+dry_r6_3)) * 100;
		
		$('#dry_moi_1').val((+dry_moi_1).toFixed(2));
		$('#dry_moi_2').val((+dry_moi_2).toFixed(2));
		$('#dry_moi_3').val((+dry_moi_3).toFixed(2));
		
		var dry_moi_1 = $('#dry_moi_1').val();
		var dry_moi_2 = $('#dry_moi_2').val();
		var dry_moi_3 = $('#dry_moi_3').val();
		
		var avg_moi = ((+dry_moi_1) + (+dry_moi_2) + (+dry_moi_3)) / 3;
		$('#avg_moi').val((+avg_moi).toFixed(2));
	})
	
	$('#avg_dry_shr, #avg_moi').change(function(){
		$('#txtdry').css("background-color","var(--success)");
		if(document.getElementById('chk_dry').checked){
			var avg_dry_shr = $('#avg_dry_shr').val();
			var avg_moi = $('#avg_moi').val();
			if((+randomNumberFromRange(1,9).toFixed())%2==0){
				var dry_shr_1 = (+avg_dry_shr) + (+0.0023);
				var dry_shr_2 = (+avg_dry_shr) + (+0.0031);
				var dry_shr_3 = (+avg_dry_shr) - (+0.0054);
				
				var dry_moi_1 = (+avg_moi) - (+0.07);
				var dry_moi_2 = (+avg_moi) + (+0.03);
				var dry_moi_3 = (+avg_moi) + (+0.04);
			}else{
				var dry_shr_1 = (+avg_dry_shr) - (+0.0045);
				var dry_shr_2 = (+avg_dry_shr) + (+0.0033);
				var dry_shr_3 = (+avg_dry_shr) + (+0.0012);
				
				var dry_moi_1 = (+avg_moi) + (+0.06);
				var dry_moi_2 = (+avg_moi) + (+0.02);
				var dry_moi_3 = (+avg_moi) - (+0.08);
			}
			
			$('#dry_shr_1').val((+dry_shr_1).toFixed(4));
			$('#dry_shr_2').val((+dry_shr_2).toFixed(4));
			$('#dry_shr_3').val((+dry_shr_3).toFixed(4));
			
			$('#dry_moi_1').val((+dry_moi_1).toFixed(2));
			$('#dry_moi_2').val((+dry_moi_2).toFixed(2));
			$('#dry_moi_3').val((+dry_moi_3).toFixed(2));
			
			var dry_size = $('#dry_size').val();
			
			if(dry_size == "300 MM"){
				var dry_weight = randomNumberFromRange(4.050,4.250).toFixed(3);
				var dry_avg_1 = (+dry_weight) - 0.011;
				var dry_avg_2 = (+dry_weight) + 0.016;
				var dry_avg_3 = (+dry_weight) + 0.028;
			}else{
				var dry_weight = randomNumberFromRange(2.050,2.200).toFixed(3);
				var dry_avg_1 = (+dry_weight) - 0.018;
				var dry_avg_2 = (+dry_weight) - 0.026;
				var dry_avg_3 = (+dry_weight) + 0.010;
			}
			
			$('#dry_avg_1').val((+dry_avg_1).toFixed(3));
			$('#dry_avg_2').val((+dry_avg_2).toFixed(3));
			$('#dry_avg_3').val((+dry_avg_3).toFixed(3));
			
			
			var dry_r1 = randomNumberFromRange(1.000,9.000).toFixed(3);
			if((+randomNumberFromRange(1,1).toFixed())%2==0){
				var dry_r1_1 = (+dry_r1) - 0.111;
				var dry_r1_2 = (+dry_r1) + 0.032;
				var dry_r1_3 = (+dry_r1) + 0.072;
			}else{                           
				var dry_r1_1 = (+dry_r1) - 0.076;
				var dry_r1_2 = (+dry_r1) - 0.013;
				var dry_r1_3 = (+dry_r1) + 0.110;
			}
			$('#dry_r1_1').val((+dry_r1_1).toFixed(3));
			$('#dry_r1_2').val((+dry_r1_2).toFixed(3));
			$('#dry_r1_3').val((+dry_r1_3).toFixed(3));
			
			$('#dry_len_1').val(250);
			$('#dry_len_2').val(250);
			$('#dry_len_3').val(250);
			
			var dry_shr_1 = $('#dry_shr_1').val();
			var dry_shr_2 = $('#dry_shr_2').val();
			var dry_shr_3 = $('#dry_shr_3').val();
			
			var dry_len_1 = $('#dry_len_1').val();
			var dry_len_2 = $('#dry_len_2').val();
			var dry_len_3 = $('#dry_len_3').val();
			
			var dry_r1_1 = $('#dry_r1_1').val();
			var dry_r1_2 = $('#dry_r1_2').val();
			var dry_r1_3 = $('#dry_r1_3').val();
			
			var dry_r6_1 = (+dry_r1_1) - (((+dry_shr_1) * (+dry_len_1)) / 100);
			var dry_r6_2 = (+dry_r1_2) - (((+dry_shr_2) * (+dry_len_2)) / 100);
			var dry_r6_3 = (+dry_r1_3) - (((+dry_shr_3) * (+dry_len_3)) / 100);
			
			$('#dry_r6_1').val((+dry_r6_1).toFixed(3));
			$('#dry_r6_2').val((+dry_r6_2).toFixed(3));
			$('#dry_r6_3').val((+dry_r6_3).toFixed(3));
			
			
			var dry_r6_1 = $('#dry_r6_1').val();
			var dry_r6_2 = $('#dry_r6_2').val();
			var dry_r6_3 = $('#dry_r6_3').val();

			var dry_moi_1 = $('#dry_moi_1').val();
			var dry_moi_2 = $('#dry_moi_2').val();
			var dry_moi_3 = $('#dry_moi_3').val();

			var dry_wtr_1 = (((+dry_moi_1) * (+dry_r6_1)) / 100) + (+dry_r6_1);
			var dry_wtr_2 = (((+dry_moi_2) * (+dry_r6_2)) / 100) + (+dry_r6_2);
			var dry_wtr_3 = (((+dry_moi_3) * (+dry_r6_3)) / 100) + (+dry_r6_3);

			$('#dry_wtr_1').val((+dry_wtr_1).toFixed(3));
			$('#dry_wtr_2').val((+dry_wtr_2).toFixed(3));
			$('#dry_wtr_3').val((+dry_wtr_3).toFixed(3));

			var dry_r1_1 = $('#dry_r1_1').val();
			var dry_r1_2 = $('#dry_r1_2').val();
			var dry_r1_3 = $('#dry_r1_3').val();
			
			var dry_r2_1 = (+dry_r1_1) - 0.004;
			var dry_r2_2 = (+dry_r1_2) - 0.003;
			var dry_r2_3 = (+dry_r1_3) - 0.002;
			
			$('#dry_r2_1').val((+dry_r2_1).toFixed(3));
			$('#dry_r2_2').val((+dry_r2_2).toFixed(3));
			$('#dry_r2_3').val((+dry_r2_3).toFixed(3));
			
			var dry_r2_1 = $('#dry_r2_1').val();
			var dry_r2_2 = $('#dry_r2_2').val();
			var dry_r2_3 = $('#dry_r2_3').val();
			
			var dry_r3_1 = (+dry_r2_1) - 0.004;
			var dry_r3_2 = (+dry_r2_2) - 0.004;
			var dry_r3_3 = (+dry_r2_3) - 0.003;
			
			$('#dry_r3_1').val((+dry_r3_1).toFixed(3));
			$('#dry_r3_2').val((+dry_r3_2).toFixed(3));
			$('#dry_r3_3').val((+dry_r3_3).toFixed(3));
			
			var dry_r3_1 = $('#dry_r3_1').val();
			var dry_r3_2 = $('#dry_r3_2').val();
			var dry_r3_3 = $('#dry_r3_3').val();
			
			var dry_r4_1 = randomNumberFromRange((+dry_r6_1),(+dry_r3_1));
			var dry_r4_2 = randomNumberFromRange((+dry_r6_2),(+dry_r3_2));
			var dry_r4_3 = randomNumberFromRange((+dry_r6_3),(+dry_r3_3));
			
			$('#dry_r4_1').val((+dry_r4_1).toFixed(3));
			$('#dry_r4_2').val((+dry_r4_2).toFixed(3));
			$('#dry_r4_3').val((+dry_r4_3).toFixed(3));
			
			var dry_r4_1 = $('#dry_r4_1').val();
			var dry_r4_2 = $('#dry_r4_2').val();
			var dry_r4_3 = $('#dry_r4_3').val();
			
			var dry_r5_1 = randomNumberFromRange((+dry_r6_1),(+dry_r4_1));
			var dry_r5_2 = randomNumberFromRange((+dry_r6_2),(+dry_r4_2));
			var dry_r5_3 = randomNumberFromRange((+dry_r6_3),(+dry_r4_3));
			
			$('#dry_r5_1').val((+dry_r5_1).toFixed(3));
			$('#dry_r5_2').val((+dry_r5_2).toFixed(3));
			$('#dry_r5_3').val((+dry_r5_3).toFixed(3));
		}
	})
	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","var(--success)"); 
			//$('#txtwtr').css("background-color","var(--success)"); 
			
			
			var temp = $('#test_list').val();
			var aa= temp.split(",");
				
				
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="SHR")
				{
					$('#txtdry').css("background-color","var(--success)");
					$("#chk_dry").prop("checked", true); 
					dry_auto();
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
				var amend_date = $('#amend_date').val();	
				var grade_fresh = $('#grade_fresh').val();
				var top_grade = $('#top_grade').val();
				var cc_identification_mark = $('#cc_identification_mark').val();
				var slump_req = $('#slump_req').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");				
									
				//SHR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="SHR")
					{
						if(document.getElementById('chk_dry').checked) {
								var chk_dry = "1";
						}
						else{
								var chk_dry = "0";
						}
						var dry_avg_1 = $('#dry_avg_1').val();
						var dry_avg_2 = $('#dry_avg_2').val();
						var dry_avg_3 = $('#dry_avg_3').val();
						var dry_r1_1 = $('#dry_r1_1').val();
						var dry_r1_2 = $('#dry_r1_2').val();
						var dry_r1_3 = $('#dry_r1_3').val();
						var dry_r2_1 = $('#dry_r2_1').val();
						var dry_r2_2 = $('#dry_r2_2').val();
						var dry_r2_3 = $('#dry_r2_3').val();
						var dry_r3_1 = $('#dry_r3_1').val();
						var dry_r3_2 = $('#dry_r3_2').val();
						var dry_r3_3 = $('#dry_r3_3').val();
						var dry_r4_1 = $('#dry_r4_1').val();
						var dry_r4_2 = $('#dry_r4_2').val();
						var dry_r4_3 = $('#dry_r4_3').val();
						var dry_r5_1 = $('#dry_r5_1').val();
						var dry_r5_2 = $('#dry_r5_2').val();
						var dry_r5_3 = $('#dry_r5_3').val();
						var dry_r6_1 = $('#dry_r6_1').val();
						var dry_r6_2 = $('#dry_r6_2').val();
						var dry_r6_3 = $('#dry_r6_3').val();
						var dry_len_1 = $('#dry_len_1').val();
						var dry_len_2 = $('#dry_len_2').val();
						var dry_len_3 = $('#dry_len_3').val();
						var dry_shr_1 = $('#dry_shr_1').val();
						var dry_shr_2 = $('#dry_shr_2').val();
						var dry_shr_3 = $('#dry_shr_3').val();
						var dry_wtr_1 = $('#dry_wtr_1').val();
						var dry_wtr_2 = $('#dry_wtr_2').val();
						var dry_wtr_3 = $('#dry_wtr_3').val();
						var dry_moi_1 = $('#dry_moi_1').val();
						var dry_moi_2 = $('#dry_moi_2').val();
						var dry_moi_3 = $('#dry_moi_3').val();
						var avg_dry_shr = $('#avg_dry_shr').val();
						var avg_moi = $('#avg_moi').val();
						break;
					}
					else
					{
						var chk_dry = "0";
						var dry_avg_1 = "0";
						var dry_avg_2 = "0";
						var dry_avg_3 = "0";
						var dry_r1_1 = "0";
						var dry_r1_2 = "0";
						var dry_r1_3 = "0";
						var dry_r2_1 = "0";
						var dry_r2_2 = "0";
						var dry_r2_3 = "0";
						var dry_r3_1 = "0";
						var dry_r3_2 = "0";
						var dry_r3_3 = "0";
						var dry_r4_1 = "0";
						var dry_r4_2 = "0";
						var dry_r4_3 = "0";
						var dry_r5_1 = "0";
						var dry_r5_2 = "0";
						var dry_r5_3 = "0";
						var dry_r6_1 = "0";
						var dry_r6_2 = "0";
						var dry_r6_3 = "0";
						var dry_len_1 = "0";
						var dry_len_2 = "0";
						var dry_len_3 = "0";
						var dry_shr_1 = "0";
						var dry_shr_2 = "0";
						var dry_shr_3 = "0";
						var dry_wtr_1 = "0";
						var dry_wtr_2 = "0";
						var dry_wtr_3 = "0";
						var dry_moi_1 = "0";
						var dry_moi_2 = "0";
						var dry_moi_3 = "0";
						var avg_dry_shr = "0";
						var avg_moi = "0";
					}
				}
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&ulr='+ulr+'&chk_dry='+chk_dry+'&dry_avg_1='+dry_avg_1+'&dry_avg_2='+dry_avg_2+'&dry_avg_3='+dry_avg_3+'&dry_r1_1='+dry_r1_1+'&dry_r1_2='+dry_r1_2+'&dry_r1_3='+dry_r1_3+'&dry_r2_1='+dry_r2_1+'&dry_r2_2='+dry_r2_2+'&dry_r2_3='+dry_r2_3+'&dry_r3_1='+dry_r3_1+'&dry_r3_2='+dry_r3_2+'&dry_r3_3='+dry_r3_3+'&dry_r4_1='+dry_r4_1+'&dry_r4_2='+dry_r4_2+'&dry_r4_3='+dry_r4_3+'&dry_r5_1='+dry_r5_1+'&dry_r5_2='+dry_r5_2+'&dry_r5_3='+dry_r5_3+'&dry_r6_1='+dry_r6_1+'&dry_r6_2='+dry_r6_2+'&dry_r6_3='+dry_r6_3+'&dry_len_1='+dry_len_1+'&dry_len_2='+dry_len_2+'&dry_len_3='+dry_len_3+'&dry_shr_1='+dry_shr_1+'&dry_shr_2='+dry_shr_2+'&dry_shr_3='+dry_shr_3+'&dry_wtr_1='+dry_wtr_1+'&dry_wtr_2='+dry_wtr_2+'&dry_wtr_3='+dry_wtr_3+'&dry_moi_1='+dry_moi_1+'&dry_moi_2='+dry_moi_2+'&dry_moi_3='+dry_moi_3+'&avg_dry_shr='+avg_dry_shr+'&avg_moi='+avg_moi+'&top_grade='+top_grade+'&cc_identification_mark='+cc_identification_mark+'&amend_date='+amend_date;
				
				
				
				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();	
				var amend_date = $('#amend_date').val();	
				
				var top_grade = $('#top_grade').val();
				var cc_identification_mark = $('#cc_identification_mark').val();
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//SHR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="SHR")
					{
						if(document.getElementById('chk_dry').checked) {
								var chk_dry = "1";
						}
						else{
								var chk_dry = "0";
						}
						var dry_avg_1 = $('#dry_avg_1').val();
						var dry_avg_2 = $('#dry_avg_2').val();
						var dry_avg_3 = $('#dry_avg_3').val();
						var dry_r1_1 = $('#dry_r1_1').val();
						var dry_r1_2 = $('#dry_r1_2').val();
						var dry_r1_3 = $('#dry_r1_3').val();
						var dry_r2_1 = $('#dry_r2_1').val();
						var dry_r2_2 = $('#dry_r2_2').val();
						var dry_r2_3 = $('#dry_r2_3').val();
						var dry_r3_1 = $('#dry_r3_1').val();
						var dry_r3_2 = $('#dry_r3_2').val();
						var dry_r3_3 = $('#dry_r3_3').val();
						var dry_r4_1 = $('#dry_r4_1').val();
						var dry_r4_2 = $('#dry_r4_2').val();
						var dry_r4_3 = $('#dry_r4_3').val();
						var dry_r5_1 = $('#dry_r5_1').val();
						var dry_r5_2 = $('#dry_r5_2').val();
						var dry_r5_3 = $('#dry_r5_3').val();
						var dry_r6_1 = $('#dry_r6_1').val();
						var dry_r6_2 = $('#dry_r6_2').val();
						var dry_r6_3 = $('#dry_r6_3').val();
						var dry_len_1 = $('#dry_len_1').val();
						var dry_len_2 = $('#dry_len_2').val();
						var dry_len_3 = $('#dry_len_3').val();
						var dry_shr_1 = $('#dry_shr_1').val();
						var dry_shr_2 = $('#dry_shr_2').val();
						var dry_shr_3 = $('#dry_shr_3').val();
						var dry_wtr_1 = $('#dry_wtr_1').val();
						var dry_wtr_2 = $('#dry_wtr_2').val();
						var dry_wtr_3 = $('#dry_wtr_3').val();
						var dry_moi_1 = $('#dry_moi_1').val();
						var dry_moi_2 = $('#dry_moi_2').val();
						var dry_moi_3 = $('#dry_moi_3').val();
						var avg_dry_shr = $('#avg_dry_shr').val();
						var avg_moi = $('#avg_moi').val();
						break;
					}
					else
					{
						var chk_dry = "0";
						var dry_avg_1 = "0";
						var dry_avg_2 = "0";
						var dry_avg_3 = "0";
						var dry_r1_1 = "0";
						var dry_r1_2 = "0";
						var dry_r1_3 = "0";
						var dry_r2_1 = "0";
						var dry_r2_2 = "0";
						var dry_r2_3 = "0";
						var dry_r3_1 = "0";
						var dry_r3_2 = "0";
						var dry_r3_3 = "0";
						var dry_r4_1 = "0";
						var dry_r4_2 = "0";
						var dry_r4_3 = "0";
						var dry_r5_1 = "0";
						var dry_r5_2 = "0";
						var dry_r5_3 = "0";
						var dry_r6_1 = "0";
						var dry_r6_2 = "0";
						var dry_r6_3 = "0";
						var dry_len_1 = "0";
						var dry_len_2 = "0";
						var dry_len_3 = "0";
						var dry_shr_1 = "0";
						var dry_shr_2 = "0";
						var dry_shr_3 = "0";
						var dry_wtr_1 = "0";
						var dry_wtr_2 = "0";
						var dry_wtr_3 = "0";
						var dry_moi_1 = "0";
						var dry_moi_2 = "0";
						var dry_moi_3 = "0";
						var avg_dry_shr = "0";
						var avg_moi = "0";
					}
				}
				
				
			var idEdit = $('#idEdit').val(); 

			billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&ulr='+ulr+'&chk_dry='+chk_dry+'&dry_avg_1='+dry_avg_1+'&dry_avg_2='+dry_avg_2+'&dry_avg_3='+dry_avg_3+'&dry_r1_1='+dry_r1_1+'&dry_r1_2='+dry_r1_2+'&dry_r1_3='+dry_r1_3+'&dry_r2_1='+dry_r2_1+'&dry_r2_2='+dry_r2_2+'&dry_r2_3='+dry_r2_3+'&dry_r3_1='+dry_r3_1+'&dry_r3_2='+dry_r3_2+'&dry_r3_3='+dry_r3_3+'&dry_r4_1='+dry_r4_1+'&dry_r4_2='+dry_r4_2+'&dry_r4_3='+dry_r4_3+'&dry_r5_1='+dry_r5_1+'&dry_r5_2='+dry_r5_2+'&dry_r5_3='+dry_r5_3+'&dry_r6_1='+dry_r6_1+'&dry_r6_2='+dry_r6_2+'&dry_r6_3='+dry_r6_3+'&dry_len_1='+dry_len_1+'&dry_len_2='+dry_len_2+'&dry_len_3='+dry_len_3+'&dry_shr_1='+dry_shr_1+'&dry_shr_2='+dry_shr_2+'&dry_shr_3='+dry_shr_3+'&dry_wtr_1='+dry_wtr_1+'&dry_wtr_2='+dry_wtr_2+'&dry_wtr_3='+dry_wtr_3+'&dry_moi_1='+dry_moi_1+'&dry_moi_2='+dry_moi_2+'&dry_moi_3='+dry_moi_3+'&avg_dry_shr='+avg_dry_shr+'&avg_moi='+avg_moi+'&top_grade='+top_grade+'&cc_identification_mark='+cc_identification_mark+'&amend_date='+amend_date;

		
				
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
            $('#top_grade').val(data.top_grade);
            $('#cc_identification_mark').val(data.cc_identification_mark);
            $('#ulr').val(data.ulr);
			$('#amend_date').val(data.amend_date);
            var temp = $('#test_list').val();
			var aa= temp.split(",");	
			
			//SHR
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="SHR")
				{
					var chk_dry = data.chk_dry;
					if(chk_dry=="1")
					{
						$('#txtdry').css("background-color","var(--success)"); 
					   $("#chk_dry").prop("checked", true); 
					}else{
						$('#txtdry').css("background-color","white"); 
						$("#chk_dry").prop("checked", false); 
					}
					$('#dry_avg_1').val(data.dry_avg_1);
					$('#dry_avg_2').val(data.dry_avg_2);
					$('#dry_avg_3').val(data.dry_avg_3);
					$('#dry_r1_1').val(data.dry_r1_1);
					$('#dry_r1_2').val(data.dry_r1_2);
					$('#dry_r1_3').val(data.dry_r1_3);
					$('#dry_r2_1').val(data.dry_r2_1);
					$('#dry_r2_2').val(data.dry_r2_2);
					$('#dry_r2_3').val(data.dry_r2_3);
					$('#dry_r3_1').val(data.dry_r3_1);
					$('#dry_r3_2').val(data.dry_r3_2);
					$('#dry_r3_3').val(data.dry_r3_3);
					$('#dry_r4_1').val(data.dry_r4_1);
					$('#dry_r4_2').val(data.dry_r4_2);
					$('#dry_r4_3').val(data.dry_r4_3);
					$('#dry_r5_1').val(data.dry_r5_1);
					$('#dry_r5_2').val(data.dry_r5_2);
					$('#dry_r5_3').val(data.dry_r5_3);
					$('#dry_r6_1').val(data.dry_r6_1);
					$('#dry_r6_2').val(data.dry_r6_2);
					$('#dry_r6_3').val(data.dry_r6_3);
					$('#dry_len_1').val(data.dry_len_1);
					$('#dry_len_2').val(data.dry_len_2);
					$('#dry_len_3').val(data.dry_len_3);
					$('#dry_shr_1').val(data.dry_shr_1);
					$('#dry_shr_2').val(data.dry_shr_2);
					$('#dry_shr_3').val(data.dry_shr_3);
					$('#dry_wtr_1').val(data.dry_wtr_1);
					$('#dry_wtr_2').val(data.dry_wtr_2);
					$('#dry_wtr_3').val(data.dry_wtr_3);
					$('#dry_moi_1').val(data.dry_moi_1);
					$('#dry_moi_2').val(data.dry_moi_2);
					$('#dry_moi_3').val(data.dry_moi_3);
					$('#avg_dry_shr').val(data.avg_dry_shr);	
					$('#avg_moi').val(data.avg_moi);	
					break;
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


