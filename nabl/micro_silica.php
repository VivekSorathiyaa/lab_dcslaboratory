

<?php 
include("header.php");
//REMOVE SIDE BAR
/*include("sidebar.php");*/
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
			
		}
		if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
			
		}
		
		$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$type_of_cement= $row_select4['type_of_cement'];
					$cement_grade= $row_select4['cement_grade'];
					$cement_brand= $row_select4['cement_brand'];
					$week_number= $row_select4['week_number'];					
				}
		$select_query3 = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0' ";
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$rec_sample_date= $row_select3['sample_rec_date'];					
				}
				
				$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
			$result_select2 = mysqli_query($conn, $select_query2);

			if (mysqli_num_rows($result_select2) > 0) {
				$row_select2 = mysqli_fetch_assoc($result_select2);
				$start_date= $row_select2['start_date'];
				$end_date= $row_select2['end_date'];
								
				
				
			}
				
	
?>
<div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">Micro Silica</h2>
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
											<input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no;?>" name="lab_no" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										 <div class="col-sm-4">
													<label>Amend Date. :</label>
												</div>								 
										  <div class="col-sm-8">
											<input type="text" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-2 control-label">Type Of Cement :</label>								 -->
											<div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="type_of_cement" value="<?php echo $type_of_cement;?>" name="type_of_cement" ReadOnly>
											</div>
											
											<!--<label for="inputEmail3" class="col-sm-2 control-label">Grade :</label>								 -->
											<div class="col-sm-4">
											<input type="hidden" class="form-control inputs" tabindex="4" id="cement_grade" value="<?php echo $cement_grade;?>" name="cement_grade" ReadOnly>
											</div>
											
											
											
											
										</div>
									</div>
									
								</div>
								
								<br>
							<!-- LAB NO PUT VAIBHAV-->
								<div class="row">
									<div class="col-lg-6">

										<div class="form-group">
										 <!--<label for="inputEmail3" class="col-sm-2 control-label">Received Sample Date:</label>	-->								 
										  <div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="rec_sample_date" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>" name="rec_sample_date" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-2 control-label">Brand :</label>	-->							 
											<div class="col-sm-4">
											<input type="hidden" class="form-control inputs" tabindex="4" id="cement_brand" value="<?php echo $cement_brand;?>" name="cement_brand" ReadOnly>
											</div>
											
											<!--<label for="inputEmail3" class="col-sm-2 control-label">Week No :</label>-->								 
											<div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="week_number" value="<?php echo $week_number;?>" name="week_number" ReadOnly>
											</div>
											
										</div>
									</div>
									
									
								</div>
								<br>
								<div class="row">
								<div class="col-lg-6">

										<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Report Date :</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="report_date" name="report_date" value="<?php echo date('d/m/Y', strtotime($end_date)); ?>">
												</div>
											</div>
									</div>
								</div>
								<div class="col-lg-6">

										<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">ULR No.:</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
													
												</div>
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
													$querys_job1 = "SELECT * FROM micro_silica WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
											//if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
											?>
											<div class="col-sm-3">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_micro_silica.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>"class="btn btn-info" id="btn_report" name="btn_report"><b>Report</b></a> 
												<!--<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_micro_silica.php.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>"class="btn btn-info" id="btn_report" name="btn_report"><b>Chemical Report</b></a> -->
												
											</div>

											
											
											<?php //} ?>
											<div class="col-sm-3">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_micro_silica.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>"class="btn btn-info" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
												<!--<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_chem_cement.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>"class="btn btn-info" id="btn_cal_report" name="btn_cal_report"><b>Chemical Calculation Report</b></a>-->
												

											</div>
										</div>
									</div>
								</div>
								
								<hr>
								<br>	
					<hr style="border-top: 1px solid;">
								<!--Nikunj Code Start-->
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

	<div class="panel panel-default">
	

  <div class="panel-group" id="accordion">
  	<?php
	$test_check;
	$select_query12 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select12 = mysqli_query($conn, $select_query12);
		while($r12 = mysqli_fetch_array($result_select12)){
			
			if($r12['test_code']=="r15")
			{
				$test_check.="r15,";
			?>
  
  <div class="panel panel-default" id="r15">
      <div class="panel-heading" id="r15s">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
			<h4 class="panel-title">
			<b>PARTICLE RETAINED ON 150&#xb5; / 300&#xb5; sieve (DRY)</b>
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
													<label for="chk_dry">1.</label>
													<input type="checkbox" class="visually-hidden" name="chk_dry"  id="chk_dry" value="chk_dry"><br>
												</div>
											<label for="inputEmail3" class="col-sm-6 control-label label-right">PARTICLE RETAINED ON 150&#xb5; / 300&#xb5; sieve (DRY)</label>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>Identification</b></center>
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>S-1</b></center>
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>S-2</b></center>
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>Initial Weight (gm)</b></center>
												
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="d1_1" name="d1_1" >
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="d1_2" name="d1_2" >
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>Final Weight (gm)</b></center>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="d2_1" name="d2_1" >
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="d2_2" name="d2_2" >
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>Particle Ret. On 150&#xb5; / 300&#xb5; Sieve(%)</b></center>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="d3_1" name="d3_1" >
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="d3_2" name="d3_2" >
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>Avg. of Two Sample(%)</b></center>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="avg_dry" name="avg_dry" >
											</div>
										</div>
									</div>
								</div>
								
						</div>
					  </div>
					</div>
			
			<?php
			}
		}
		
		$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		while($r1 = mysqli_fetch_array($result_select1)){
			 
			 if($r1['test_code']=="r45")
			{
				$test_check.="r45,";
		?>
			<div class="panel panel-default" id="r45">
      <div class="panel-heading" id="r45s">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
			<h4 class="panel-title">
			<b>PARTICLE RETAINED ON 45&#xb5; / 75&#xb5; Sieve (WET)</b>
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
													<label for="chk_wet">5.</label>
													<input type="checkbox" class="visually-hidden" name="chk_wet"  id="chk_wet" value="chk_wet"><br>
												</div>
											<label for="inputEmail3" class="col-sm-6 control-label label-right">PARTICLE RETAINED ON 45&#xb5; / 75&#xb5; Sieve (Wet)</label>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>Identification</b></center>
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>S-1</b></center>
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>S-2</b></center>
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>Initial Weight (gm)</b></center>
												
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="w1_1" name="w1_1" >
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="w1_2" name="w1_2" >
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>Final Weight (gm)</b></center>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="w2_1" name="w2_1" >
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="w2_2" name="w2_2" >
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>Particle Ret. On 45&#xb5; / 75&#xb5; Sieve(%)</b></center>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="w3_1" name="w3_1" >
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="w3_2" name="w3_2" >
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><b>Avg. of Two Sample(%)</b></center>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="avg_wet" name="avg_wet" >
											</div>
										</div>
									</div>
								</div>
								
						</div>
					  </div>
					</div>
		
		
		
		
		<?php
			}
			else if($r1['test_code']=="sou")
			{
				$test_check.="sou,";
			?>


	<div class="panel panel-default" id="sou">
      <div class="panel-heading" id="sound">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
			<h4 class="panel-title">
			<b>SOUNDNESS BY LE-CHATELIER</b>
			</h4>
		</a>
		</h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
				<div class="panel-body">
								<div class="row">									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_sou">6.</label>
													<input type="checkbox" class="visually-hidden" name="chk_sou"  id="chk_sou" value="chk_sou"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SOUNDNESS BY LE-CHATELIER</label>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">0.2 N:0.8</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Bar No.</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Distance between two point after 24 hours in water (mm)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Distance between two point after three hours boiling in water (mm)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Average (mm)</label>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">N = </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="bar1" name="bar1" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="dis1_1" name="dis1_1" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="dis1_2" name="dis1_2" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="avg_sou" name="avg_sou" >
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label"></label>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="bar2" name="bar2" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="dis2_1" name="dis2_1" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="dis2_2" name="dis2_2" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												
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
			else if($r1['test_code']=="fin" )
			{
				$test_check.="fin,";
			?>
	<div class="panel panel-default" id="fin">
      <div class="panel-heading" id="fins">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
			<h4 class="panel-title">
			<b>FINENESS BLAINE AIR PERMEABILITY</b>
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
													<label for="chk_fine">3.</label>
													<input type="checkbox" class="visually-hidden" name="chk_fine"  id="chk_fine" value="chk_fine"><br>
												</div>
											<label for="inputEmail3" class="col-sm-6 control-label label-right">FINENESS BLAINE AIR PERMEABILITY</label>
										</div>
									</div>
								</div>
								
								<br>
								<div class="row">	
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight of Flyash (A), gm </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="w1" name="w1" >
											</div>
										</div>
									</div>								
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Time for Bed 1 (sec)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="t1" name="t1" >
											</div>
										</div>
									</div>
								</div>
								
								<br>
								<div class="row">	
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Initial Vol. of Le-Chat. Flask (B), ml </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="w2" name="w2" >
											</div>
										</div>
									</div>								
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Time for Bed 1 (sec)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="t2" name="t2" >
											</div>
										</div>
									</div>
								</div>
								
								<br>
								<div class="row">	
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Final Vol. of Le-Chat. Flask (C), ml </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="w3" name="w3" >
											</div>
										</div>
									</div>								
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Time for Bed 2 (sec)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="t3" name="t3" >
											</div>
										</div>
									</div>
								</div>
								
								<br>
								<div class="row">	
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Sp. Gravity of Flyash [A/(C - B)]</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="w4" name="w4" >
											</div>
										</div>
									</div>								
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Time for Bed 2 (sec)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="t4" name="t4" >
											</div>
										</div>
									</div>
								</div>
								
								<br>
								<div class="row">	
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Mass of Flyash Req. for Flyash Bed (0.500*1.89*S.G of Flyash)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="avg_mass" name="avg_mass" >
											</div>
										</div>
									</div>								
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Avg. Time for (t) (sec)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="avg_t" name="avg_t" >
											</div>
										</div>
									</div>
								</div>
								
								<br>
								<div class="row">	
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Fineness = cm<sup>2</sup>/g</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">(Ss x P<sub>s</sub> x &#x221A;T)/(P x &#x221A;T<sub>s</sub>)=</label>
											</div>
										</div>
									</div>		
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="avg_fines" name="avg_fines" >
											</div>
										</div>
									</div>
								</div>
									<br>
								
									
						</div>
					<br>
					<br>
					</div>
					  </div>
		
			<?php
			}
			else if($r1['test_code']=="shr")
			{
				$test_check.="shr,";
			?>
	<div class="panel panel-default" id="shr">
      <div class="panel-heading" id="shr_heading">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
			<h4 class="panel-title">
			<b>DRYING SHRINKAGE</b>
			</h4>
		</a>
		</h4>
      </div>
      <div id="collapse6" class="panel-collapse collapse">
				<div class="panel-body">
								<div class="row">									
									<div class="col-lg-6">
										<div class="form-group">
											<div class="col-sm-1">
													<label for="chk_shr">2.</label>
													<input type="checkbox" class="visually-hidden" name="chk_shr"  id="chk_shr" value="chk_shr"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">DRYING SHRINKAGE</label>
										</div>
									</div>
									
									<div class="col-lg-4">
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
								<br>
								<div class="row">
									<div class="col-lg-8">	
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Temp.(&#8451;):</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="shr_temp" name="shr_temp" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-8">	
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Humidity (%) :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="shr_humidity" name="shr_humidity" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-8">	
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">N =  :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ans_n" name="ans_n" >
												</div>
											</div>
									</div>
								</div>
								<br>
								
								<div class="row">
									<div class="col-lg-8">	
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Pozzolana,gm = 60xN</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="ans_po" name="ans_po" >
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-8">	
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Flow between 100 & 115 percent = </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="per" name="per" >
											</div>
										</div>
									</div>
								</div>
								
								<br>
								<div class="row">
								<div class="col-lg-4">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Age</label>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Date</label>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Sample ID</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Ref Bar (mm)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Length of specimen after 7 Days (mm)</label>
											</div>
										</div>
									</div>																		
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Length of specimen after 35 Days (mm)</label>
											</div>
										</div>
									</div>
									</div>
									
								<div class="col-lg-4">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Difference (mm)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Drying Shrinkage %</label>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Average</label>
											</div>
										</div>
									</div>
									
								</div>
								</div>
								<br>
									<div class="row">
									
									<div class="col-lg-4">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="t_age" name="t_age" value="35">
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="t_date" name="t_date" value="<?php echo date('d/m/Y', strtotime($start_date. ' + 35 days')); ?>">
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="s1" name="s1" >
												</div>
											</div>
									</div>
									</div>
									<div class="col-lg-4">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="rbar1" name="rbar1" >
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="len1" name="len1" >
												</div>
											</div>
									</div>									
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="lena1" name="lena1" >
												</div>
											</div>
									</div>
									</div>
									<div class="col-lg-4">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dif1" name="dif1" >
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dry1" name="dry1" >
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
												<input type="text" class="form-control" id="avg_shr" name="avg_shr" >
												</div>
											</div>
									</div>
								</div>
								</div>
								
							
								<br>
									<div class="row">
									
									<div class="col-lg-4">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="s2" name="s2" >
												</div>
											</div>
									</div>
									</div>
									<div class="col-lg-4">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="rbar2" name="rbar2" >
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="len2" name="len2" >
												</div>
											</div>
									</div>									
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="lena2" name="lena2" >
												</div>
											</div>
									</div>
									</div>
									<div class="col-lg-4">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dif2" name="dif2" >
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dry2" name="dry2" >
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
									</div>
								</div>
								</div>
								
								
								<br>
									<div class="row">
									
									<div class="col-lg-4">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="s3" name="s3" >
												</div>
											</div>
									</div>
									</div>
									<div class="col-lg-4">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="rbar3" name="rbar3" >
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="len3" name="len3" >
												</div>
											</div>
									</div>									
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="lena3" name="lena3" >
												</div>
											</div>
									</div>
									</div>
									<div class="col-lg-4">
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dif3" name="dif3" >
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dry3" name="dry3" >
												</div>
											</div>
									</div>
									<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
												
												</div>
											</div>
									</div>
								</div>
								</div>
								
							
								<br>
							<br>								
						</div>
					<br>
					<br>
					</div>
					  </div>
			<?php
			}
			else if($r1['test_code']=="mou")
			{
				$test_check.="mou,";
			?>
			<div class="panel panel-default" id="mou">
				<div class="panel-heading" id="mous">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
							<h4 class="panel-title">
								<b>MOISTURE CONTENT</b>
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
									<label for="chk_mou">7.</label>
									<input type="checkbox" class="visually-hidden" name="chk_mou"  id="chk_mou" value="chk_mou"><br>
								</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">MOISTURE CONTERNT</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<!--<div class="col-sm-6">					
						<div class="col-md-3">
							<h6 class="panel-title">
								<b>NOS OF BRICKS:</b>
							</h6>
						</div>
						<div class="col-md-9">
								<input type="text" class="form-control" id="no_of_brick" name="no_of_brick">
						</div>
					</div>-->
				</div>
				<br>
				<div class="row">
					
					<div class="col-sm-3">
						<label for="inputEmail3" class="col-sm-12 control-label label-right">Initial weight in (gm) (W1)</label>
					</div>
					<div class="col-sm-3">
						<label for="inputEmail3" class="col-sm-12 control-label label-right">Oven dry weight in (gm) (W2)</label>
					</div>
					<div class="col-sm-3">
						<label for="inputEmail3" class="col-sm-12 control-label label-right">Moisture Content (%) = (W1 - W2/W1) x 100</label>
					</div>
					<div class="col-sm-3">
						<label for="inputEmail3" class="col-sm-12 control-label label-right">Average Moisture Content (%) </label>
					</div>
				</div>
				
				<div class="row">
					
					<div class="col-sm-3">
						<input type="text" class="form-control" id="in_w1" name="in_w1" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="fn_w1" name="fn_w1" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="mo1" name="mo1" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="avg_mo" name="avg_mo" >
					</div>
				</div>
				<br>
				<div class="row">
					
					<div class="col-sm-3">
						<input type="text" class="form-control" id="in_w2" name="in_w2" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="fn_w2" name="fn_w2" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="mo2" name="mo2" >
					</div>
					<div class="col-sm-3">
						
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
      <div class="panel-heading" id="comp">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
			<h4 class="panel-title">
			<b>COMPRESSIVE STRENGTH</b>
			</h4>
		</a>
		</h4>
      </div>
      <div id="collapse7" class="panel-collapse collapse">
				<div class="panel-body">
								<div class="row">																		
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_com">4.</label>
													<input type="checkbox" class="visually-hidden" name="chk_com"  id="chk_com" value="chk_com"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">COMPRESSIVE STRENGTH</label>
										</div>
									</div>
								</div>
									<!--<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="com_date_test" name="com_date_test" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-8">	
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
								<br>
								<div class="row">
									<div class="col-lg-8">	
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
								<br>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight of cement (gm):</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="weight_of_cement" name="weight_of_cement" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label"></label>
											</div>
										</div>
									</div>
								</div>
								<br>
									<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight of Std. Sand (gm):</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="weight_of_sand" name="weight_of_sand" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label"></label>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
										<div class="col-lg-1">
										</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label"></label>
											</div>
										</div>
									</div>
									</div>
									<div class="row">
										
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Water = [consistency (%) / 4] + 3 x 8 = (gm)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="weight_of_water" name="weight_of_water" >
												</div>
											</div>
									</div>
									</div>-
									
									<div class="row">
										<div class="col-lg-1">
										</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label"></label>
											</div>
										</div>
									</div>
									</div>
									<br>
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Temp. (&deg;C)</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="sp_1" name="sp_1" readonly>
													<input type="text" class="form-control" id="com_temp" name="com_temp" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="sp_2" name="sp_2" readonly>
													<input type="text" class="form-control" id="com_temp1" name="com_temp1" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="sp_3" name="sp_3" readonly>
													<input type="text" class="form-control" id="com_temp2" name="com_temp2" >
												</div>
											</div>
									</div>
									</div>-->
									<br>
									
									
									<div class="row">									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<!--<label for="inputEmail3" class="col-sm-12 control-label">Hmdty (%)</label> -->
												</div>
											</div>
										</div>
										<div class="col-lg-3">
												<div class="form-group">
													<div class="col-sm-12">
														<center><label for="inputEmail3" class="col-sm-12 control-label">Compressive Strength (Lime Rectivity)(N/mm<sup>2</sup>)</label></center>
													</div>
												</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<center><label for="inputEmail3" class="col-sm-12 control-label">Compressive Strength (Cement Mortar)(28 Days)(N/mm<sup>2</sup>)</label></center>
												</div>
											</div>
										</div>
										<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><label for="inputEmail3" class="col-sm-12 control-label">Compressive Strength (Fyash Cube)(28 Days)(N/mm<sup>2</sup>)</label></center>
											</div>
										</div>
									</div>
									</div>
									<br>
									
									
									<div class="row">	
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">Date & Time of Testing</label> 
												</div>
											</div>
										</div>
										
										<div class="col-lg-3">
												<div class="form-group">
													<div class="col-sm-12">
														
														<input type="text" class="form-control" id="caste_date1" name="caste_date1" >
													</div>
												</div>
										</div>
										<div class="col-lg-3">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="text" class="form-control" id="caste_date2" name="caste_date2" >
													</div>
												</div>
										</div>
										<div class="col-lg-3">
												<div class="form-group">
													<div class="col-sm-12">
														<input type="text" class="form-control" id="caste_date3" name="caste_date3" >
													</div>
												</div>
										</div>
									</div>
									<br>
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Date & Time of Testing</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													
													<input type="text" class="form-control" id="test_date1" name="test_date1" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="test_date2" name="test_date2" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="test_date3" name="test_date3" >
												</div>
											</div>
									</div>
									</div>
									<br>
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Age at the Time of Testing</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													
													<input type="text" class="form-control" id="age1" name="age1" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="age2" name="age2" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="age3" name="age3" >
												</div>
											</div>
									</div>
									</div>
									
									<br>
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">ID</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="id1" name="id1" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="id2" name="id2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="id3" name="id3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="id4" name="id4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="id5" name="id5" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="id6" name="id6" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="id7" name="id7" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="id8" name="id8" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="id9" name="id9" >
												</div>
											</div>
									</div>
									
									</div>
									<br>
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Length, mm</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="l1" name="l1" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="l2" name="l2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="l3" name="l3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="l4" name="l4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="l5" name="l5" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="l6" name="l6" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="l7" name="l7" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="l8" name="l8" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="l9" name="l9" >
												</div>
											</div>
									</div>
									
									</div>
									<br>
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Width, mm</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="wi1" name="wi1" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="wi2" name="wi2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="wi3" name="wi3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="wi4" name="wi4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="wi5" name="wi5" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="wi6" name="wi6" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="wi7" name="wi7" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="wi8" name="wi8" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="wi9" name="wi9" >
												</div>
											</div>
									</div>
									
									</div>
									<br>
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Area(mm<sup>2</sup>)</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="a1" name="a1" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="a2" name="a2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="a3" name="a3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="a4" name="a4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="a5" name="a5" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="a6" name="a6" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="a7" name="a7" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="a8" name="a8" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="a9" name="a9" >
												</div>
											</div>
									</div>
									
									</div>
									<br>
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Load, kN</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="load_1" name="load_1" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="load_2" name="load_2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="load_3" name="load_3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="load_4" name="load_4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="load_5" name="load_5" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="load_6" name="load_6" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="load_7" name="load_7" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="load_8" name="load_8" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="load_9" name="load_9" >
												</div>
											</div>
									</div>
									
									</div>
									<br>
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Compressive Strength (N/mm<sup>2</sup>)</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="com_1" name="com_1" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="com_2" name="com_2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="com_3" name="com_3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="com_4" name="com_4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="com_5" name="com_5" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="com_6" name="com_6" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="com_7" name="com_7" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="com_8" name="com_8" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="com_9" name="com_9" >
												</div>
											</div>
									</div>
									
									</div>
									<br>
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Avg. Compressive Strength (N/mm<sup>2</sup>)</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="avg_lime" name="avg_lime" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="avg_cem" name="avg_cem" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="avg_fly" name="avg_fly" >
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
			
			
			}?>	
	<hr>
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
							 $query = "select * from micro_silica WHERE lab_no='$aa'  and `is_deleted`='0'";

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
 $('#con_date_test').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	$('#report_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	$('#shr_start_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
	$('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });
	
	$('.datess').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
	$('.t_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
	$('#chk_con').change(function(){
        if(this.checked)
		{
			$('#consis').css("background-color","var(--success)");	
		}
		else
		{
			$('#consis').css("background-color","white");	
		}
		
	});
	$('#chk_sou').change(function(){
        if(this.checked)
		{
			$('#sound').css("background-color","var(--success)");	
		}
		else
		{
			$('#sound').css("background-color","white");	
		}
		
	});
	$('#chk_set').change(function(){
        if(this.checked)
		{
			$('#sett').css("background-color","var(--success)");	
		}
		else
		{
			$('#sett').css("background-color","white");	
		}
		
	});
	$('#chk_den').change(function(){
        if(this.checked)
		{
			$('#dens').css("background-color","var(--success)");	
		}
		else
		{
			$('#dens').css("background-color","white");	
		}
		
	});
	/*$('#chk_shr').change(function(){
        if(this.checked)
		{
			$('#fins').css("background-color","var(--success)");	
		}
		else
		{
			$('#fins').css("background-color","white");	
		}
		
	});*/
	$('#chk_com').change(function(){
        if(this.checked)
		{
			
			$('#comp').css("background-color","var(--success)");	
		}
		else
		{
			$('#comp').css("background-color","white");	
		}
		
	});
	$('#chk_che').change(function(){
        if(this.checked)
		{
			$('#chemi').css("background-color","var(--success)");	
		}
		else
		{
			$('#chemi').css("background-color","white");	
		}
		
	});
	
	$('#chk_fbs').change(function(){
        if(this.checked)
		{
			$('#txtfbs').css("background-color","var(--success)");	
		}
		else
		{
			$('#txtfbs').css("background-color","white");	
		}
		
	});
	
	
	
	$('#caste_date1').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    }).on("change", function() {
		
			var top = 10;
			var date_input = document.getElementById("caste_date1").value.split('/');						
			var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);					
			var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			if(mm <= 9)
			mm = '0'+mm;
			if(dd <= 9)
			dd = '0'+dd;
			var someFormattedDate = dd + '/' + mm + '/' + y;				
			document.getElementById('test_date1').value = someFormattedDate;		
			document.getElementById('age1').value = top;		
			
		});
	
	$('#caste_date2').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    }).on("change", function() {
		
			var top = 28;
			var date_input = document.getElementById("caste_date2").value.split('/');						
			var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);					
			var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			if(mm <= 9)
			mm = '0'+mm;
			if(dd <= 9)
			dd = '0'+dd;
			var someFormattedDate = dd + '/' + mm + '/' + y;				
			document.getElementById('test_date2').value = someFormattedDate;		
			document.getElementById('age2').value = top;		
			
		});
	
	$('#caste_date3').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    }).on("change", function() {
		
			var top = 28;
			var date_input = document.getElementById("caste_date3").value.split('/');						
			var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);					
			var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			if(mm <= 9)
			mm = '0'+mm;
			if(dd <= 9)
			dd = '0'+dd;
			var someFormattedDate = dd + '/' + mm + '/' + y;				
			document.getElementById('test_date3').value = someFormattedDate;	
			document.getElementById('age3').value = top;					
			
		});
		
		$('#shr_start_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    }).on("change", function() {
		
			var top = 35;
			var date_input = document.getElementById("shr_start_date").value.split('/');						
			var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);					
			var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			if(mm <= 9)
			mm = '0'+mm;
			if(dd <= 9)
			dd = '0'+dd;
			var someFormattedDate = dd + '/' + mm + '/' + y;				
			document.getElementById('shr_end_date').value = someFormattedDate;	
								
			
		});
 


  $(function () {
    $('.select2').select2();
  })
$(document).ready(function(){ 
	
	$('#btn_edit_data').hide();
	$('#alert').hide();
    	
	
	var d1_1 = "";
	var d1_2 = "";
	var d2_1 = "";
	var d2_2 = "";
	var d3_1 = "";
	var d3_2 = "";
	var avg_dry = "";
	
	//PARTICLE RETAINED ON 150µ / 300µ sieve (DRY)
	function dry_auto()
	{
		$('#r15s').css("background-color","var(--success)");
		
		var avg_dry = randomNumberFromRange(2.0,5.0);
		var initial_w1 = randomNumberFromRange(50.000,51.000);
		var initial_w2 = randomNumberFromRange(50.000,51.000);
		
		$('#d1_1').val(initial_w1.toFixed(3));
		$('#d1_2').val(initial_w2.toFixed(3));
		$('#avg_dry').val(avg_dry.toFixed());
		
		//get weight from box
		var get_i_weight1 = $('#d1_1').val();
		var get_i_weight2 = $('#d1_2').val();
		
		//get avg from box
		var get_avgdry =  $('#avg_dry').val();
		
		var par1 = (+get_avgdry) + randomNumberFromRange(-0.10,0.10);
		$('#d3_1').val(par1.toFixed(2));
		
		var par_1 = $('#d3_1').val();
		var par2 = ((+get_avgdry) * (+2)) - (+par1);
		$('#d3_2').val(par2.toFixed(2));
		
		var par_2 = $('#d3_2').val();
		
		var final1 = (+get_i_weight1) * (+par_1);
		var final2 = (+get_i_weight2) * (+par_2);
		
		var fnl_ans1 = (+final1) / 100;
		var fnl_ans2 = (+final2) / 100;
		
		$('#d2_1').val(fnl_ans1.toFixed(3));
		$('#d2_2').val(fnl_ans2.toFixed(3));
		
		//Calculation
		
		let ini_weight1 = $('#d1_1').val();
		let ini_weight2 = $('#d1_2').val();
		
		let f_weight1 = $('#d2_1').val();
		let f_weight2 = $('#d2_2').val();
		
		let particle_1 = (+f_weight1) / (+ini_weight1);
		let particle_2 = (+f_weight2) / (+ini_weight2);
		
		let particle1 = (+particle_1) * 100;
		let particle2 = (+particle_2) * 100;
		
		$('#d3_1').val(particle1.toFixed(2));
		$('#d3_2').val(particle2.toFixed(2));
		
		let avg_sample = (particle1 + particle2) / 2;
		
		$('#avg_dry').val(avg_sample.toFixed());
		
		
	}
	
	$('#chk_dry').change(function(){
        if(this.checked)
		{  
			dry_auto();
		}
		else
		{
			$('#r15s').css("background-color","white");	
			
			$('#d1_1').val(null);
			$('#d1_2').val(null);
			
			$('#d2_1').val(null);
			$('#d2_2').val(null);
			
			$('#d3_1').val(null);
			$('#d3_2').val(null);
			
			$('#avg_dry').val(null);
			
		}
	});
	
	
	$('#avg_dry').change(function(){
		$('#r15s').css("background-color","var(--success)");
		
		var avg_dry = $('#avg_dry').val();
		var initial_w1 = randomNumberFromRange(100.000,103.000);
		var initial_w2 = randomNumberFromRange(100.000,103.000);
		
		$('#d1_1').val(initial_w1.toFixed(3));
		$('#d1_2').val(initial_w2.toFixed(3));
		
		//get weight from box
		var get_i_weight1 = $('#d1_1').val();
		var get_i_weight2 = $('#d1_2').val();
		
		//get avg from box
		var get_avgdry =  $('#avg_dry').val();
		
		var par1 = (+get_avgdry) + randomNumberFromRange(-0.10,0.10);
		$('#d3_1').val(par1.toFixed(2));
		
		var par_1 = $('#d3_1').val();
		var par2 = ((+get_avgdry) * (+2)) - (+par1);
		$('#d3_2').val(par2.toFixed(2));
		
		var par_2 = $('#d3_2').val();
		
		var final1 = (+get_i_weight1) * (+par_1);
		var final2 = (+get_i_weight2) * (+par_2);
		
		var fnl_ans1 = (+final1) / 100;
		var fnl_ans2 = (+final2) / 100;
		
		$('#d2_1').val(fnl_ans1.toFixed(3));
		$('#d2_2').val(fnl_ans2.toFixed(3));
		
		//Calculation
		
		let ini_weight1 = $('#d1_1').val();
		let ini_weight2 = $('#d1_2').val();
		
		let f_weight1 = $('#d2_1').val();
		let f_weight2 = $('#d2_2').val();
		
		let particle_1 = (+f_weight1) / (+ini_weight1);
		let particle_2 = (+f_weight2) / (+ini_weight2);
		
		let particle1 = (+particle_1) * 100;
		let particle2 = (+particle_2) * 100;
		
		$('#d3_1').val(particle1.toFixed(2));
		$('#d3_2').val(particle2.toFixed(2));
		
		let avg_sample = (particle1 + particle2) / 2;
		
		$('#avg_dry').val(avg_sample.toFixed());
	});
	
	//DRYING SHRINKAGE
	function shr_auto()
	{
		$('#shr_heading').css("background-color","var(--success)");
		/*var top = 35;
		var date_input = document.getElementById("con_date_test").value.split('/');						
		var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);					
		var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
		var dd = newdate.getDate();
		var mm = newdate.getMonth() + 1;
		var y = newdate.getFullYear();
		if(mm <= 9)
		mm = '0'+mm;
		if(dd <= 9)
		dd = '0'+dd;
		var someFormattedDate = dd + '/' + mm + '/' + y;				
		document.getElementById('shr_end_date').value = someFormattedDate;	
		document.getElementById('shr_start_date').value = document.getElementById("con_date_test").value;
		*/
		
		shr_temp = randomNumberFromRange(25.0,29.0);
		$('#shr_temp').val(shr_temp.toFixed(1));	
		shr_humidity = randomNumberFromRange(65.0,69.0);
		$('#shr_humidity').val(shr_humidity.toFixed());
		flow_per = randomNumberFromRange(105,112);
		$('#per').val(flow_per.toFixed());
		
		var samp_1 = 1;
		var samp_2 = 2;
		var samp_3 = 3;
		$('#s1').val(samp_1);
		$('#s2').val(samp_2);
		$('#s3').val(samp_3);
		
		var ref_1 = 250;
		var ref_2 = 250;
		var ref_3 = 250;
		$('#rbar1').val(ref_1);
		$('#rbar2').val(ref_2);
		$('#rbar3').val(ref_3);
		
		var ref1 = $('#rbar1').val();
		var ref2 = $('#rbar2').val();
		var ref3 = $('#rbar3').val();
		
		var avg_shr = randomNumberFromRange(0.015,0.035).toFixed(3);
		$('#avg_shr').val(avg_shr);
		
		var avgshr = $('#avg_shr').val();
		
		var tt =  randomNumberFromRange(0,50).toFixed();
		if(tt%2==0)
		{
			var shr_1 = (+avgshr) + (0.003);
			var shr_2 = (+avgshr) 
			var shr_3 = (+avgshr) - (0.003);
		}
		else
		{
			var shr_2 = (+avgshr) + (0.002);
			var shr_1 = (+avgshr) 
			var shr_3 = (+avgshr) - (0.002);
		}
		
		$('#dry1').val(shr_1.toFixed(3));
		$('#dry2').val(shr_2.toFixed(3));
		$('#dry3').val(shr_3.toFixed(3));
		
		var shr1 = $('#dry1').val();
		var shr2 = $('#dry2').val();
		var shr3 = $('#dry3').val();
		
		var ldiff_1 = ((+ref1) * (+shr1))/(+100);
		var ldiff_2 = ((+ref2) * (+shr2))/(+100);
		var ldiff_3 = ((+ref3) * (+shr3))/(+100);
		
		$('#dif1').val(ldiff_1.toFixed(3));
		$('#dif2').val(ldiff_2.toFixed(3));
		$('#dif3').val(ldiff_3.toFixed(3));
		
		var ldiff1 = $('#dif1').val();
		var ldiff2 = $('#dif2').val();
		var ldiff3 = $('#dif3').val();
		
		var l7_1 = randomNumberFromRange(2.000,10.000);
		var l7_2 = (+l7_1) + (+randomNumberFromRange(-2.000,2.000).toFixed(3));
		var l7_3 = (+l7_1) - (+randomNumberFromRange(-2.000,2.000).toFixed(3));
		
		$('#len1').val(l7_1.toFixed(3));
	    $('#len2').val(l7_2.toFixed(3));
	    $('#len3').val(l7_3.toFixed(3));
		
		var l71 = $('#len1').val();
		var l72 = $('#len2').val();
		var l73 = $('#len3').val();
		
		
		var l35_1 = (+l71) - (+ldiff1);
		var l35_2 = (+l72) - (+ldiff2);
		var l35_3 = (+l73) - (+ldiff3);
		
		$('#lena1').val(l35_1.toFixed(3));
	    $('#lena2').val(l35_2.toFixed(3));
	    $('#lena3').val(l35_3.toFixed(3));
		
		
		//sidhu
		var ref_1 = $('#rbar1').val();
		var ref_2 = $('#rbar2').val();
		var ref_3 = $('#rbar3').val();
		var l_71 = $('#len1').val();
		var l_72 = $('#len2').val();
		var l_73 = $('#len3').val();
		var l_351 = $('#lena1').val();
		var l_352 = $('#lena2').val();
		var l_353 = $('#lena3').val();
		
		var ldif1 = (+l_71) - (+l_351);
		var ldif2 = (+l_72) - (+l_352);
		var ldif3 = (+l_73) - (+l_353);
		$('#dif1').val(ldif1.toFixed(3));
		$('#dif2').val(ldif2.toFixed(3));
		$('#dif3').val(ldif3.toFixed(3));
		
		var ldi1 = $('#dif1').val();
		var ldi2 = $('#dif2').val();
		var ldi3 = $('#dif3').val();
		
		var s_hr1 = ((+ldi1) / (+ref_1)) * 100;
		var s_hr2 = ((+ldi2) / (+ref_2)) * 100;
		var s_hr3 = ((+ldi3) / (+ref_3)) * 100;
		$('#dry1').val(s_hr1.toFixed(3));
		$('#dry2').val(s_hr2.toFixed(3));
		$('#dry3').val(s_hr3.toFixed(3));
		
		var sh_r1 = $('#dry1').val();
		var sh_r2 = $('#dry2').val();
		var sh_r3 = $('#dry3').val();
		
		var avd = ((+sh_r1) + (+sh_r2) + (+sh_r3)) / 3;
		$('#avg_shr').val(avd.toFixed(2));

	}
	
	$('#chk_shr').change(function(){
        if(this.checked)
		{  
			shr_auto();
		}
		else
		{
			$('#shr_heading').css("background-color","white");	
			
			$('#shr_temp').val(null);
			$('#shr_humidity').val(null);
			$('#ans_n').val(null);
			$('#ans_po').val(null);
			$('#per').val(null);
			$('#t_age').val(null);
			$('#t_date').val(null);
			$('#s1').val(null);
			$('#s2').val(null);
			$('#s3').val(null);
			$('#rbar1').val(null);
			$('#rbar2').val(null);
			$('#rbar3').val(null);
			$('#len1').val(null);
			$('#len2').val(null);
			$('#len3').val(null);
			$('#lena1').val(null);
			$('#lena2').val(null);
			$('#lena3').val(null);
			$('#dif1').val(null);
			$('#dif2').val(null);
			$('#dif3').val(null);
			$('#dry1').val(null);
			$('#dry2').val(null);
			$('#dry3').val(null);
			$('#avg_shr').val(null);
			
		}
	});
	
	$('#avg_shr').change(function(){
		$('#shr_heading').css("background-color","var(--success)");
		if ($("#chk_shr").is(':checked')) {
			
			shr_temp = randomNumberFromRange(25.0,29.0);
		$('#shr_temp').val(shr_temp.toFixed(1));	
		shr_humidity = randomNumberFromRange(65.0,69.0);
		$('#shr_humidity').val(shr_humidity.toFixed());
		flow_per = randomNumberFromRange(105,112);
		$('#per').val(flow_per.toFixed());
		
		var samp_1 = 1;
		var samp_2 = 2;
		var samp_3 = 3;
		$('#s1').val(samp_1);
		$('#s2').val(samp_2);
		$('#s3').val(samp_3);
		
		var ref_1 = 250;
		var ref_2 = 250;
		var ref_3 = 250;
		$('#rbar1').val(ref_1);
		$('#rbar2').val(ref_2);
		$('#rbar3').val(ref_3);
		
		var ref1 = $('#rbar1').val();
		var ref2 = $('#rbar2').val();
		var ref3 = $('#rbar3').val();
		
		
		var avgshr = $('#avg_shr').val();
		
		var tt =  randomNumberFromRange(0,50).toFixed();
		if(tt%2==0)
		{
			var shr_1 = (+avgshr) + (0.003);
			var shr_2 = (+avgshr) 
			var shr_3 = (+avgshr) - (0.003);
		}
		else
		{
			var shr_2 = (+avgshr) + (0.002);
			var shr_1 = (+avgshr) 
			var shr_3 = (+avgshr) - (0.002);
		}
		
		$('#dry1').val(shr_1.toFixed(3));
		$('#dry2').val(shr_2.toFixed(3));
		$('#dry3').val(shr_3.toFixed(3));
		
		var shr1 = $('#dry1').val();
		var shr2 = $('#dry2').val();
		var shr3 = $('#dry3').val();
		
		var ldiff_1 = ((+ref1) * (+shr1))/(+100);
		var ldiff_2 = ((+ref2) * (+shr2))/(+100);
		var ldiff_3 = ((+ref3) * (+shr3))/(+100);
		
		$('#dif1').val(ldiff_1.toFixed(3));
		$('#dif2').val(ldiff_2.toFixed(3));
		$('#dif3').val(ldiff_3.toFixed(3));
		
		var ldiff1 = $('#dif1').val();
		var ldiff2 = $('#dif2').val();
		var ldiff3 = $('#dif3').val();
		
		var l7_1 = randomNumberFromRange(2.000,10.000);
		var l7_2 = (+l7_1) + (+randomNumberFromRange(-2.000,2.000).toFixed(3));
		var l7_3 = (+l7_1) - (+randomNumberFromRange(-2.000,2.000).toFixed(3));
		
		$('#len1').val(l7_1.toFixed(3));
	    $('#len2').val(l7_2.toFixed(3));
	    $('#len3').val(l7_3.toFixed(3));
		
		var l71 = $('#len1').val();
		var l72 = $('#len2').val();
		var l73 = $('#len3').val();
		
		
		var l35_1 = (+l71) - (+ldiff1);
		var l35_2 = (+l72) - (+ldiff2);
		var l35_3 = (+l73) - (+ldiff3);
		
		$('#lena1').val(l35_1.toFixed(3));
	    $('#lena2').val(l35_2.toFixed(3));
	    $('#lena3').val(l35_3.toFixed(3));
		}			
	});
	$('#rbar1,#rbar2,#rbar3,#len1,#len2,#len3,#lena1,#lena2,#lena3').change(function(){
		var ref_1 = $('#rbar1').val();
		var ref_2 = $('#rbar2').val();
		var ref_3 = $('#rbar3').val();
		var l_71 = $('#len1').val();
		var l_72 = $('#len2').val();
		var l_73 = $('#len3').val();
		var l_351 = $('#lena1').val();
		var l_352 = $('#lena2').val();
		var l_353 = $('#lena3').val();
			
		var ldif1 = (+l_71) - (+l_351);
		var ldif2 = (+l_72) - (+l_352);
		var ldif3 = (+l_73) - (+l_353);
			
			$('#dif1').val(ldif1.toFixed(3));
			$('#dif2').val(ldif2.toFixed(3));
			$('#dif3').val(ldif3.toFixed(3));
			
			var ldi1 = $('#dif1').val();
			var ldi2 = $('#dif2').val();
			var ldi3 = $('#dif3').val();
			
			var s_hr1 = ((+ldi1) / (+ref_1)) * 100;
			var s_hr2 = ((+ldi2) / (+ref_2)) * 100;
			var s_hr3 = ((+ldi3) / (+ref_3)) * 100;
			$('#dry1').val(s_hr1.toFixed(3));
			$('#dry2').val(s_hr2.toFixed(3));
			$('#dry3').val(s_hr3.toFixed(3));
			
			var sh_r1 = $('#dry1').val();
			var sh_r2 = $('#dry2').val();
			var sh_r3 = $('#dry3').val();
			
			var avd = ((+sh_r1) + (+sh_r2) + (+sh_r3)) / 3;
			$('#avg_shr').val(avd.toFixed(2));
	});
	
	
	var avg_fines = "";
	
	//FINENESS BLAINE AIR PERMEABILITY
	function fines_auto()
	{
		$('#fins').css("background-color","var(--success)");
		
		var avg_dry = (+$('#avg_wet').val());
		
		if((avg_dry >= 20) && (avg_dry <= 22))
		{
			avg_fines = randomNumberFromRange(350,365);
		}
		else if((avg_dry >= 23) && (avg_dry <= 25))
		{
			avg_fines = randomNumberFromRange(340,349);
		}
		else if((avg_dry >= 26) && (avg_dry <= 28))
		{
			avg_fines = randomNumberFromRange(325,339);
		}
		else
		{
			avg_fines = randomNumberFromRange(325,365);
		}
		
		$('#avg_fines').val(avg_fines.toFixed());
		var avg_fines = $('#avg_fines').val();
		
		var w1 = randomNumberFromRange(42.0000,48.0000);
		$('#w1').val(w1.toFixed(4));
		var fly_weight = $('#w1').val();
		
		var w2 = randomNumberFromRange(0.1,0.9);
		$('#w2').val(w2.toFixed(1));
		var initial_vol = $('#w2').val();
		
		var w3 = randomNumberFromRange(18.5,23.1);
		$('#w3').val(w3.toFixed(1));
		var final_vol = $('#w3').val();
		
		//A/C-B formula
		
		var sp_a = (+final_vol) - (+initial_vol);
		var sp_fly = (+fly_weight) / (+sp_a);
		
		$('#w4').val(sp_fly.toFixed(2));
		var sp_gravity = $('#w4').val();
		
		var avg_mass = (+sp_gravity) * 0.500 * 1.89;
		$('#avg_mass').val(avg_mass.toFixed(4));
		
		
		var for1 = (+avg_fines) * (+sp_gravity) * (+5.80);
		var for2 = (+333) * (+2.23);
		
		var finla1 = (+for1) / (+for2);
		
		var avgt = (+finla1) * (+finla1);
		
		$('#avg_t').val(avgt.toFixed(2));
		var avg_t = $('#avg_t').val();
		
		var tt = randomNumberFromRange(1,9).toFixed();
		if(tt%2==0)
		{
			var t_1 = (+avg_t) -  (0.22);
			var t_2 = (+avg_t) -  (0.34);
			var t_3 = (+avg_t) +  (0.27)
			var t_4 = (+avg_t) +  (0.29);
		}
		else
		{
			var t_1 = (+avg_t) -  (0.19);
			var t_2 = (+avg_t) -  (0.23);
			var t_3 = (+avg_t) +  (0.09)
			var t_4 = (+avg_t) +  (0.33);
		}
		
		
		$('#t1').val(t_1.toFixed(2));
		$('#t2').val(t_2.toFixed(2));
		$('#t3').val(t_3.toFixed(2));
		$('#t4').val(t_4.toFixed(2));
		
		
		
	}
	
	$('#avg_fines').change(function(){
		$('#fins').css("background-color","var(--success)");
		
		
		var avg_fines = $('#avg_fines').val();
		
		var w1 = randomNumberFromRange(42.0000,48.0000);
		$('#w1').val(w1.toFixed(4));
		var fly_weight = $('#w1').val();
		
		var w2 = randomNumberFromRange(0.1,0.9);
		$('#w2').val(w2.toFixed(1));
		var initial_vol = $('#w2').val();
		
		var w3 = randomNumberFromRange(18.5,23.1);
		$('#w3').val(w3.toFixed(1));
		var final_vol = $('#w3').val();
		
		//A/C-B formula
		
		var sp_a = (+final_vol) - (+initial_vol);
		var sp_fly = (+fly_weight) / (+sp_a);
		
		$('#w4').val(sp_fly.toFixed(2));
		var sp_gravity = $('#w4').val();
		
		var avg_mass = (+sp_gravity) * 0.500 * 1.89;
		$('#avg_mass').val(avg_mass.toFixed(4));
		
		
		var for1 = (+avg_fines) * (+sp_gravity) * (+5.80);
		var for2 = (+333) * (+2.23);
		
		var finla1 = (+for1) / (+for2);
		
		var avgt = (+finla1) * (+finla1);
		
		$('#avg_t').val(avgt.toFixed(2));
		var avg_t = $('#avg_t').val();
		
		var tt = randomNumberFromRange(1,9).toFixed();
		if(tt%2==0)
		{
			var t_1 = (+avg_t) -  (0.22);
			var t_2 = (+avg_t) -  (0.34);
			var t_3 = (+avg_t) +  (0.27)
			var t_4 = (+avg_t) +  (0.29);
		}
		else
		{
			var t_1 = (+avg_t) -  (0.19);
			var t_2 = (+avg_t) -  (0.23);
			var t_3 = (+avg_t) +  (0.09)
			var t_4 = (+avg_t) +  (0.33);
		}
		
		
		$('#t1').val(t_1.toFixed(2));
		$('#t2').val(t_2.toFixed(2));
		$('#t3').val(t_3.toFixed(2));
		$('#t4').val(t_4.toFixed(2));
		
	});
	
	$('#chk_fine').change(function(){
        if(this.checked)
		{  
			fines_auto();
		}
		else
		{
			$('#fins').css("background-color","white");	
			
			$('#w1').val(null);
			$('#w2').val(null);
			$('#w3').val(null);
			$('#w4').val(null);
			$('#t1').val(null);
			$('#t2').val(null);
			$('#t3').val(null);
			$('#t4').val(null);
			$('#avg_mass').val(null);
			$('#avg_t').val(null);
			$('#avg_fines').val(null);
			
		}
	});
	
	
	
	
	//PARTICLE RETAINED ON 45µ / 75µ Sieve (Wet)
	function wet_auto()
	{
		
		$('#r45s').css("background-color","var(--success)");
		
		var avg_wet = randomNumberFromRange(2.0,7.0);
		var initial_w1 = randomNumberFromRange(100.000,103.000);
		var initial_w2 = randomNumberFromRange(100.000,103.000);
		
		$('#w1_1').val(initial_w1.toFixed(3));
		$('#w1_2').val(initial_w2.toFixed(3));
		$('#avg_wet').val(avg_wet.toFixed());
		
		//get weight from box
		var get_i_weight1 = $('#w1_1').val();
		var get_i_weight2 = $('#w1_2').val();
		
		//get avg from box
		var get_avgdry =  $('#avg_wet').val();
		
		var par1 = (+get_avgdry) + randomNumberFromRange(-0.10,0.10);
		$('#w3_1').val(par1.toFixed(2));
		
		var par_1 = $('#w3_1').val();
		var par2 = ((+get_avgdry) * (+2)) - (+par1);
		$('#w2_2').val(par2.toFixed(2));
		
		var par_2 = $('#w2_2').val();
		
		var final1 = (+get_i_weight1) * (+par_1);
		var final2 = (+get_i_weight2) * (+par_2);
		
		var fnl_ans1 = (+final1) / 100;
		var fnl_ans2 = (+final2) / 100;
		
		$('#w2_1').val(fnl_ans1.toFixed(3));
		$('#w2_2').val(fnl_ans2.toFixed(3));
		
		//Calculation
		
		let ini_weight1 = $('#w1_1').val();
		let ini_weight2 = $('#w1_2').val();
		
		let f_weight1 = $('#w2_1').val();
		let f_weight2 = $('#w2_2').val();
		
		let particle_1 = (+f_weight1) / (+ini_weight1);
		let particle_2 = (+f_weight2) / (+ini_weight2);
		
		let particle1 = (+particle_1) * 100;
		let particle2 = (+particle_2) * 100;
		
		$('#w3_1').val(particle1.toFixed(2));
		$('#w3_2').val(particle2.toFixed(2));
		
		let avg_sample = (particle1 + particle2) / 2;
		
		$('#avg_wet').val(avg_sample.toFixed());
	}
	
	$('#chk_wet').change(function(){
        if(this.checked)
		{  
			wet_auto();
		}
		else
		{
			$('#r45s').css("background-color","white");	
			
			$('#w1_1').val(null);
			$('#w1_2').val(null);
			$('#w2_1').val(null);
			$('#w2_2').val(null);
			$('#w3_1').val(null);
			$('#w3_2').val(null);
			
			$('#avg_wet').val(null);
			
		}
	});
	
	$('#avg_wet').change(function(){
		$('#r15s').css("background-color","var(--success)");
		
		//get weight from box
		var get_i_weight1 = $('#w1_1').val();
		var get_i_weight2 = $('#w1_2').val();
		
		//get avg from box
		var get_avgdry =  $('#avg_wet').val();
		
		var par1 = (+get_avgdry) + randomNumberFromRange(-0.10,0.10);
		$('#w3_1').val(par1.toFixed(2));
		
		var par_1 = $('#w3_1').val();
		var par2 = ((+get_avgdry) * (+2)) - (+par1);
		$('#w2_2').val(par2.toFixed(2));
		
		var par_2 = $('#w2_2').val();
		
		var final1 = (+get_i_weight1) * (+par_1);
		var final2 = (+get_i_weight2) * (+par_2);
		
		var fnl_ans1 = (+final1) / 100;
		var fnl_ans2 = (+final2) / 100;
		
		$('#w2_1').val(fnl_ans1.toFixed(3));
		$('#w2_2').val(fnl_ans2.toFixed(3));
		
		//Calculation
		
		let ini_weight1 = $('#w1_1').val();
		let ini_weight2 = $('#w1_2').val();
		
		let f_weight1 = $('#w2_1').val();
		let f_weight2 = $('#w2_2').val();
		
		let particle_1 = (+f_weight1) / (+ini_weight1);
		let particle_2 = (+f_weight2) / (+ini_weight2);
		
		let particle1 = (+particle_1) * 100;
		let particle2 = (+particle_2) * 100;
		
		$('#w3_1').val(particle1.toFixed(2));
		$('#w3_2').val(particle2.toFixed(2));
		
		let avg_sample = (particle1 + particle2) / 2;
		
		$('#avg_wet').val(avg_sample.toFixed());
		
	});
	
	
	
	
	//SOUNDNESS BY LE-CHATELIER
	function sou_auto()
	{
		
		$('#bar1').val(1);
		$('#bar2').val(2);					
		$('#sound').css("background-color","var(--success)");	
			
		var items1 = randomNumberFromRange(0.60,1.20).toFixed(2);			
		
		avg_sou = items1;
		$('#avg_sou').val(avg_sou);
		diff1 = (+avg_sou) + randomNumberFromRange(-0.08,0.07);
		
	
		diff2 = ((+avg_sou)* (+2)) - (+diff1);		
		dis1__1 = randomNumberFromRange(15.00, 23.00);
		dis2__1 = randomNumberFromRange(15.00, 23.00);
		$('#dis1_1').val(dis1__1.toFixed(2));
		$('#dis2_1').val(dis2__1.toFixed(2));
		var dis1_1 = $('#dis1_1').val();
		var dis2_1 = $('#dis2_1').val();
		dis1_2 = (+dis1_1) + (+diff1);
		dis2_2 = (+dis2_1) + (+diff2);
		$('#dis1_2').val(dis1_2.toFixed(2));
		$('#dis2_2').val(dis2_2.toFixed(2));
	}
	
	$('#chk_sou').change(function(){
        if(this.checked)
		{  
			sou_auto();
		}
		else
		{
			$('#sound').css("background-color","white");	
			
			$('#bar1').val(null);
			$('#bar2').val(null);
			$('#dis1_1').val(null);
			$('#dis1_2').val(null);
			$('#dis2_1').val(null);
			$('#dis2_2').val(null);
			$('#avg_sou').val(null);
			
		}
	});
	
	$('#avg_sou').change(function(){
		
		var avg_sou = $('#avg_sou').val();
		diff1 = (+avg_sou) + randomNumberFromRange(-0.08,0.07);
		
	
		diff2 = ((+avg_sou)* (+2)) - (+diff1);		
		dis1__1 = randomNumberFromRange(15.00, 23.00);
		dis2__1 = randomNumberFromRange(15.00, 23.00);
		$('#dis1_1').val(dis1__1.toFixed(2));
		$('#dis2_1').val(dis2__1.toFixed(2));
		var dis1_1 = $('#dis1_1').val();
		var dis2_1 = $('#dis2_1').val();
		dis1_2 = (+dis1_1) + (+diff1);
		dis2_2 = (+dis2_1) + (+diff2);
		$('#dis1_2').val(dis1_2.toFixed(2));
		$('#dis2_2').val(dis2_2.toFixed(2));
		
	});
	
	
	//MOISTURE CONTERNT
	function mo_auto()
	{
		$('#mous').css("background-color", "var(--success)");
		
		
		
		var avgmo = randomNumberFromRange(0.05, 2.50).toFixed(1);
		var in_w_1 = randomNumberFromRange(99.000,102.000).toFixed(3);
		var in_w_2 = randomNumberFromRange(99.000,102.000).toFixed(3);
		$('#in_w1').val(in_w_1);
		$('#in_w2').val(in_w_2);				
		
		var in_w1 = $('#in_w1').val();
		var in_w2 = $('#in_w2').val();
		$('#avg_mo').val(avgmo);
		
		var get_avgdry =  $('#avg_mo').val();
		
		
		var par1 = (+get_avgdry) + randomNumberFromRange(-0.05,0.05);
		$('#mo1').val(par1.toFixed(2));
		
		var par_1 = $('#mo1').val();
		var par2 = ((+get_avgdry) * (+2)) - (+par1);
		$('#mo2').val(par2.toFixed(2));
		
		var par_2 = $('#mo2').val();
		
		var final1 = (+in_w1) * (+par_1);
		var final2 = (+in_w2) * (+par_2);
		
		var fnl_ans_1 = (+final1) / 100;
		var fnl_ans_2 = (+final2) / 100;
		
		var fnl_ans1 =  (+in_w1) - (+fnl_ans_1);
		var fnl_ans2 =  (+in_w2) - (+fnl_ans_2);
		
		$('#fn_w1').val(fnl_ans1.toFixed(3));
		$('#fn_w2').val(fnl_ans2.toFixed(3));
	
	}
	
	$('#chk_mou').change(function(){
        if(this.checked)
		{  
			mo_auto();
		}
		else
		{
			$('#mous').css("background-color","white");	
			
			$('#in_w1').val(null);
			$('#in_w2').val(null);
			$('#fn_w1').val(null);
			$('#fn_w2').val(null);
			$('#mo1').val(null);
			$('#mo2').val(null);
			$('#avg_mo').val(null);
			
		}
	});
	
	$('#avg_mo').change(function(){
		$('#mous').css("background-color","var(--success)");
		
		
		
		
		var in_w_1 = randomNumberFromRange(99.000,102.000).toFixed(3);
		var in_w_2 = randomNumberFromRange(99.000,102.000).toFixed(3);
		$('#in_w1').val(in_w_1);
		$('#in_w2').val(in_w_2);				
		
		var in_w1 = $('#in_w1').val();
		var in_w2 = $('#in_w2').val();
		
		var get_avgdry =  $('#avg_mo').val();
		
		
		var par1 = (+get_avgdry) + randomNumberFromRange(-0.05,0.05);
		$('#mo1').val(par1.toFixed(2));
		
		var par_1 = $('#mo1').val();
		var par2 = ((+get_avgdry) * (+2)) - (+par1);
		$('#mo2').val(par2.toFixed(2));
		
		var par_2 = $('#mo2').val();
		
		var final1 = (+in_w1) * (+par_1);
		var final2 = (+in_w2) * (+par_2);
		
		var fnl_ans_1 = (+final1) / 100;
		var fnl_ans_2 = (+final2) / 100;
		
		var fnl_ans1 =  (+in_w1) - (+fnl_ans_1);
		var fnl_ans2 =  (+in_w2) - (+fnl_ans_2);
		
		$('#fn_w1').val(fnl_ans1.toFixed(3));
		$('#fn_w2').val(fnl_ans2.toFixed(3));
	});
	
	
	
	
	
	
	var caste_date1;
	var caste_date2;
	var caste_date3;
	var test_date1;
	var test_date2;
	var test_date3;
	var age1;
	var age2;
	var age3;
	var id1;
	var id2;
	var id3;
	var id4;
	var id5;
	var id6;
	var id7;
	var id8;
	var id9;
	var l1;
	var l2;
	var l3;
	var l4;
	var l5;
	var l6;
	var l7;
	var l8;
	var l9;
	var wi1;
	var wi2;
	var wi3;
	var wi4;
	var wi5;
	var wi6;
	var wi7;
	var wi8;
	var wi9;
	var a1;
	var a2;
	var a3;
	var a4;
	var a5;
	var a6;
	var a7;
	var a8;
	var a9;
	var load_1;
	var load_2;
	var load_3;
	var load_4;
	var load_5;
	var load_6;
	var load_7;
	var load_8;
	var load_9;
	var com_1;
	var com_2;
	var com_3;
	var com_4;
	var com_5;
	var com_6;
	var com_7;
	var com_8;
	var com_9;
	
	function com_auto()
	{
		
			var caste_date1 = $('#rec_sample_date').val();		
			var caste_date2 = $('#rec_sample_date').val();		
			var caste_date3 = $('#rec_sample_date').val();		
			
			$('#caste_date1').val(caste_date1);
			$('#caste_date2').val(caste_date2);
			$('#caste_date3').val(caste_date3);
			
			var top = 10;
			var date_input = document.getElementById("caste_date1").value.split('/');						
			var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);					
			var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + top);
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			if(mm <= 9)
			mm = '0'+mm;
			if(dd <= 9)
			dd = '0'+dd;
			var someFormattedDate = dd + '/' + mm + '/' + y;				
			document.getElementById('test_date1').value = someFormattedDate;		
			document.getElementById('age1').value = top+ ' Days';
			
			var top1 = 7;
			var date_input1 = document.getElementById("caste_date2").value.split('/');						
			var date1 = new Date(date_input1[2], date_input1[1]- 1, date_input1[0]);					
			var newdate1 = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate() + top1);
			var dd1 = newdate1.getDate();
			var mm1 = newdate1.getMonth() + 1;
			var y1 = newdate1.getFullYear();
			if(mm1 <= 9)
			mm1 = '0'+mm1;
			if(dd1 <= 9)
			dd1 = '0'+dd1;
			var someFormattedDate1 = dd1 + '/' + mm1 + '/' + y1;				
			document.getElementById('test_date2').value = someFormattedDate1;		
			document.getElementById('age2').value = top1+ ' Days';
			
			var top2 = 7;
			var date_input2 = document.getElementById("caste_date3").value.split('/');						
			var date2 = new Date(date_input2[2], date_input2[1]- 1, date_input2[0]);					
			var newdate2 = new Date(date2.getFullYear(), date2.getMonth(), date2.getDate() + top2);
			var dd2 = newdate2.getDate();
			var mm2 = newdate2.getMonth() + 1;
			var y2 = newdate2.getFullYear();
			if(mm2 <= 9)
			mm2 = '0'+mm2;
			if(dd2 <= 9)
			dd2 = '0'+dd2;
			var someFormattedDate2 = dd2 + '/' + mm2 + '/' + y2;				
			document.getElementById('test_date3').value = someFormattedDate2;		
			document.getElementById('age3').value = top2 + ' Days';
			
			com_3_day();
			
	}
	
	
	$('#chk_com').change(function(){
        if(this.checked)
		{  
			com_auto();
		
		}
		else
		{
			$('#comp').css("background-color","var(--success)");
			$('#caste_date1').val(null);
			$('#caste_date2').val(null);
			$('#caste_date3').val(null);
			$('#test_date1').val(null);
			$('#test_date2').val(null);
			$('#test_date3').val(null);
			$('#age1').val(null);
			$('#age2').val(null);
			$('#age3').val(null);
			$('#id1').val(null);
			$('#id2').val(null);
			$('#id3').val(null);
			$('#id4').val(null);
			$('#id5').val(null);
			$('#id6').val(null);
			$('#id7').val(null);
			$('#id8').val(null);
			$('#id9').val(null);
			$('#l1').val(null);
			$('#l2').val(null);
			$('#l3').val(null);
			$('#l4').val(null);
			$('#l5').val(null);
			$('#l6').val(null);
			$('#l7').val(null);
			$('#l8').val(null);
			$('#l9').val(null);
			$('#wi1').val(null);
			$('#wi2').val(null);
			$('#wi3').val(null);
			$('#wi4').val(null);
			$('#wi5').val(null);
			$('#wi6').val(null);
			$('#wi7').val(null);
			$('#wi8').val(null);
			$('#wi9').val(null);
			$('#a1').val(null);
			$('#a2').val(null);
			$('#a3').val(null);
			$('#a4').val(null);
			$('#a5').val(null);
			$('#a6').val(null);
			$('#a7').val(null);
			$('#a8').val(null);
			$('#a9').val(null);
			$('#load_1').val(null);
			$('#load_2').val(null);
			$('#load_3').val(null);
			$('#load_4').val(null);
			$('#load_5').val(null);
			$('#load_6').val(null);
			$('#load_7').val(null);
			$('#load_8').val(null);
			$('#load_9').val(null);
			$('#com_1').val(null);
			$('#com_2').val(null);
			$('#com_3').val(null);
			$('#com_4').val(null);
			$('#com_5').val(null);
			$('#com_6').val(null);
			$('#com_7').val(null);
			$('#com_8').val(null);
			$('#com_9').val(null);
		}
	});
	
	
	
	function com_3_day()
	{
		$('#comp').css("background-color","var(--success)");
		if ($("#chk_com").is(':checked')) {
			
			var id1 = 1;
			var id2 = 2;
			var id3 = 3;
			var id4 = 1;
			var id5 = 2;
			var id6 = 3;
			var id7 = 1;
			var id8 = 2;
			var id9 = 3;
			$('#id1').val(id1);
			$('#id2').val(id2);
			$('#id3').val(id3);
			$('#id4').val(id4);
			$('#id5').val(id5);
			$('#id6').val(id6);
			$('#id7').val(id7);
			$('#id8').val(id8);
			$('#id9').val(id9);
			
			var l1=randomNumberFromRange(49.5,50.5).toFixed(1);
			var l2=randomNumberFromRange(49.5,50.5).toFixed(1);
			var l3=randomNumberFromRange(49.5,50.5).toFixed(1);
			var l4=randomNumberFromRange(49.5,50.5).toFixed(1);
			var l5=randomNumberFromRange(49.5,50.5).toFixed(1);
			var l6=randomNumberFromRange(49.5,50.5).toFixed(1);
			var l7=randomNumberFromRange(49.5,50.5).toFixed(1);
			var l8=randomNumberFromRange(49.5,50.5).toFixed(1);
			var l9=randomNumberFromRange(49.5,50.5).toFixed(1);
			
			$('#l1').val(l1);
			$('#l2').val(l2);
			$('#l3').val(l3);
			$('#l4').val(l4);
			$('#l5').val(l5);
			$('#l6').val(l6);
			$('#l7').val(l7);
			$('#l8').val(l8);
			$('#l9').val(l9);
			
			var l_1 = $('#l1').val();
			var l_2 = $('#l2').val();
			var l_3 = $('#l3').val();
			var l_4 = $('#l4').val();
			var l_5 = $('#l5').val();
			var l_6 = $('#l6').val();
			var l_7 = $('#l7').val();
			var l_8 = $('#l8').val();
			var l_9 = $('#l9').val();
			
			var wi1=randomNumberFromRange(49.5,50.5).toFixed(1);
			var wi2=randomNumberFromRange(49.5,50.5).toFixed(1);
			var wi3=randomNumberFromRange(49.5,50.5).toFixed(1);
			var wi4=randomNumberFromRange(49.5,50.5).toFixed(1);
			var wi5=randomNumberFromRange(49.5,50.5).toFixed(1);
			var wi6=randomNumberFromRange(49.5,50.5).toFixed(1);
			var wi7=randomNumberFromRange(49.5,50.5).toFixed(1);
			var wi8=randomNumberFromRange(49.5,50.5).toFixed(1);
			var wi9=randomNumberFromRange(49.5,50.5).toFixed(1);
			
			$('#wi1').val(wi1);
			$('#wi2').val(wi2);
			$('#wi3').val(wi3);
			$('#wi4').val(wi4);
			$('#wi5').val(wi5);
			$('#wi6').val(wi6);
			$('#wi7').val(wi7);
			$('#wi8').val(wi8);
			$('#wi9').val(wi9);
			
			
			var wi_1 = $('#wi1').val();
			var wi_2 = $('#wi2').val();
			var wi_3 = $('#wi3').val();
			var wi_4 = $('#wi4').val();
			var wi_5 = $('#wi5').val();
			var wi_6 = $('#wi6').val();
			var wi_7 = $('#wi7').val();
			var wi_8 = $('#wi8').val();
			var wi_9 = $('#wi9').val();
			
			var avg_lime = randomNumberFromRange(5.1, 8.0).toFixed(1);
			$('#avg_lime').val(avg_lime);
			var avglime = $('#avg_lime').val();
			var avg_cem = randomNumberFromRange(25, 30).toFixed();
			$('#avg_cem').val(avg_cem);
			var avgcem = $('#avg_cem').val();
			var avg_fly = (+avgcem) - (+randomNumberFromRange(1, 3).toFixed());
			$('#avg_fly').val(avg_fly);
			var avgfly = $('#avg_fly').val();
			
			var com_1 = (+avglime) + 0.34;
			var com_2 = (+avglime) - 0.56;
			var com_3 = (+avglime) + 0.22;
			$('#com_1').val(com_1.toFixed(2));
			$('#com_2').val(com_2.toFixed(2));
			$('#com_3').val(com_3.toFixed(2));	
			
			var com1 = $('#com_1').val();
			var com2 = $('#com_2').val();
			var com3 = $('#com_3').val();
			
			var com_4 = (+avgcem) + 0.63;
			var com_5 = (+avgcem) - 0.71;
			var com_6 = (+avgcem) + 0.08;
			$('#com_4').val(com_4.toFixed(2));
			$('#com_5').val(com_5.toFixed(2));
			$('#com_6').val(com_6.toFixed(2));
			
			var com4 = $('#com_4').val();
			var com5 = $('#com_5').val();
			var com6 = $('#com_6').val();
			
			var com_7 = (+avgfly) + 0.93;
			var com_8 = (+avgfly) - 0.71;
			var com_9 = (+avgfly) + 0.08;
			$('#com_7').val(com_7.toFixed(2));
			$('#com_8').val(com_8.toFixed(2));
			$('#com_9').val(com_9.toFixed(2));
			
			var com7 = $('#com_7').val();
			var com8 = $('#com_8').val();
			var com9 = $('#com_9').val();
								
			
			
			var a1 = (+l_1) * (+wi_1);
			var a2 = (+l_2) * (+wi_2);
			var a3 = (+l_3) * (+wi_3);
			var a4 = (+l_4) * (+wi_4);
			var a5 = (+l_5) * (+wi_5);
			var a6 = (+l_6) * (+wi_6);
			var a7 = (+l_7) * (+wi_7);
			var a8 = (+l_8) * (+wi_8);
			var a9 = (+l_9) * (+wi_9);

			$('#a1').val(a1.toFixed(2));
			$('#a2').val(a2.toFixed(2));
			$('#a3').val(a3.toFixed(2));
			$('#a4').val(a4.toFixed(2));
			$('#a5').val(a5.toFixed(2));
			$('#a6').val(a6.toFixed(2));
			$('#a7').val(a7.toFixed(2));
			$('#a8').val(a8.toFixed(2));
			$('#a9').val(a9.toFixed(2));
			
			var area1 = $('#a1').val();
			var area2 = $('#a2').val();
			var area3 = $('#a3').val();
			var area4 = $('#a4').val();
			var area5 = $('#a5').val();
			var area6 = $('#a6').val();
			var area7 = $('#a7').val();
			var area8 = $('#a8').val();
			var area9 = $('#a9').val();
			
			var load_1 = ((+area1) *  (+com1)) / 1000;
			var load_2 = ((+area2) *  (+com2)) / 1000;
			var load_3 = ((+area3) *  (+com3)) / 1000;
			var load_4 = ((+area4) *  (+com4)) / 1000;
			var load_5 = ((+area5) *  (+com5)) / 1000;
			var load_6 = ((+area6) *  (+com6)) / 1000;
			var load_7 = ((+area7) *  (+com7)) / 1000;
			var load_8 = ((+area8) *  (+com8)) / 1000;
			var load_9 = ((+area9) *  (+com9)) / 1000;
			
			$('#load_1').val(load_1.toFixed(2));
			$('#load_2').val(load_2.toFixed(2));
			$('#load_3').val(load_3.toFixed(2));
			$('#load_4').val(load_4.toFixed(2));
			$('#load_5').val(load_5.toFixed(2));
			$('#load_6').val(load_6.toFixed(2));
			$('#load_7').val(load_7.toFixed(2));
			$('#load_8').val(load_8.toFixed(2));
			$('#load_9').val(load_9.toFixed(2));
			
			
			var load1 = $('#load_1').val();
			var load2 = $('#load_2').val();
			var load3 = $('#load_3').val();
			var load4 = $('#load_4').val();
			var load5 = $('#load_5').val();
			var load6 = $('#load_6').val();
			var load7 = $('#load_7').val();
			var load8 = $('#load_8').val();
			var load9 = $('#load_9').val();
			
			
			
			var coms1 = (1000 *  (+load1)) / (+area1);
			var coms2 = (1000 *  (+load2)) / (+area2);
			var coms3 = (1000 *  (+load3)) / (+area3);
			var coms4 = (1000 *  (+load4)) / (+area4);
			var coms5 = (1000 *  (+load5)) / (+area5);
			var coms6 = (1000 *  (+load6)) / (+area6);
			var coms7 = (1000 *  (+load7)) / (+area7);
			var coms8 = (1000 *  (+load8)) / (+area8);
			var coms9 = (1000 *  (+load9)) / (+area9);
			
			$('#com_1').val(coms1.toFixed(2));
			$('#com_2').val(coms2.toFixed(2));
			$('#com_3').val(coms3.toFixed(2));
			$('#com_4').val(coms4.toFixed(2));
			$('#com_5').val(coms5.toFixed(2));
			$('#com_6').val(coms6.toFixed(2));
			$('#com_7').val(coms7.toFixed(2));
			$('#com_8').val(coms8.toFixed(2));
			$('#com_9').val(coms9.toFixed(2));
			
			
			var co1 = $('#com_1').val();
			var co2 = $('#com_2').val();
			var co3 = $('#com_3').val();
			var co4 = $('#com_4').val();
			var co5 = $('#com_5').val();
			var co6 = $('#com_6').val();
			var co7 = $('#com_7').val();
			var co8 = $('#com_8').val();
			var co9 = $('#com_9').val();
			
			var avg__lime = ((+co1) + (+co2) + (+co3))/3;
			$('#avg_lime').val(avg__lime.toFixed(1));
			
			var avg__cem = ((+co4) + (+co5) + (+co6))/3;
			$('#avg_cem').val(avg__cem.toFixed());
			
			var avg__fly = ((+co7) + (+co8) + (+co9))/3;
			$('#avg_fly').val(avg__fly.toFixed());
			
		}
		
	}
	
	
	
	function l1_l2_l3()
	{
		
		if ($("#chk_com").is(':checked')) {
			
		var l_1 = $('#l1').val();
		var l_2 = $('#l2').val();
		var l_3 = $('#l3').val();
		
		var wi_1 = $('#wi1').val();
		var wi_2 = $('#wi2').val();
		var wi_3 = $('#wi3').val();
		
		var a1 = (+l_1) * (+wi_1);
		var a2 = (+l_2) * (+wi_2);
		var a3 = (+l_3) * (+wi_3);
		
		$('#a1').val(a1.toFixed(2));
		$('#a2').val(a2.toFixed(2));
		$('#a3').val(a3.toFixed(2));
		
		var area1 = $('#a1').val();
		var area2 = $('#a2').val();
		var area3 = $('#a3').val();
		var area4 = $('#a4').val();
		
		
		var co1 = $('#com_1').val();
		var co2 = $('#com_2').val();
		var co3 = $('#com_3').val();
	
		var avg__lime = ((+co1) + (+co2) + (+co3))/3;
		$('#avg_lime').val(avg__lime.toFixed(1));
		
		var load_1 = ((+area1) *  (+co1)) / 1000;
		var load_2 = ((+area2) *  (+co2)) / 1000;
		var load_3 = ((+area3) *  (+co3)) / 1000;
		
		$('#load_1').val(load_1.toFixed(2));
		$('#load_2').val(load_2.toFixed(2));
		$('#load_3').val(load_3.toFixed(2));
		
		
		}
		$('#comp').css("background-color","var(--success)");

	}
	
	function l4_l5_l6()
	{
		
		if ($("#chk_com").is(':checked')) {
			
		var l_4 = $('#l4').val();
		var l_5 = $('#l5').val();
		var l_6 = $('#l6').val();
		
		var wi_4 = $('#wi4').val();
		var wi_5 = $('#wi5').val();
		var wi_6 = $('#wi6').val();
		
		var a4 = (+l_4) * (+wi_4);
		var a5 = (+l_5) * (+wi_5);
		var a6 = (+l_6) * (+wi_6);
		
		$('#a4').val(a4.toFixed(2));
		$('#a5').val(a5.toFixed(2));
		$('#a6').val(a6.toFixed(2));
		
		var area4 = $('#a4').val();
		var area5 = $('#a5').val();
		var area6 = $('#a6').val();
		
		
		var co4 = $('#com_4').val();
		var co5 = $('#com_5').val();
		var co6 = $('#com_6').val();
		
		
		var avg__cem = ((+co4) + (+co5) + (+co6))/3;
		$('#avg_cem').val(avg__cem.toFixed());
		
		
		var load_4 = ((+area4) *  (+co4)) / 1000;
		var load_5 = ((+area5) *  (+co5)) / 1000;
		var load_6 = ((+area6) *  (+co6)) / 1000;
		
		$('#load_4').val(load_4.toFixed(2));
		$('#load_5').val(load_5.toFixed(2));
		$('#load_6').val(load_6.toFixed(2));
		
		
		}
		$('#comp').css("background-color","var(--success)");

	}
	
	function l7_l8_l9()
	{
		
		if ($("#chk_com").is(':checked')) {
			
		var l_7 = $('#l7').val();
		var l_8 = $('#l8').val();
		var l_9 = $('#l9').val();
		
		var wi_7 = $('#wi7').val();
		var wi_8 = $('#wi8').val();
		var wi_9 = $('#wi9').val();
		
		var a7 = (+l_7) * (+wi_7);
		var a8 = (+l_8) * (+wi_8);
		var a9 = (+l_9) * (+wi_9);

		$('#a7').val(a7.toFixed(2));
		$('#a8').val(a8.toFixed(2));
		$('#a9').val(a9.toFixed(2));
		
		var area7 = $('#a7').val();
		var area8 = $('#a8').val();
		var area9 = $('#a9').val();
		
		
		var co7 = $('#com_7').val();
		var co8 = $('#com_8').val();
		var co9 = $('#com_9').val();
		
		var avg__fly = ((+co7) + (+co8) + (+co9))/3;
		$('#avg_fly').val(avg__fly.toFixed());
		
		var load_7 = ((+area7) *  (+co7)) / 1000;
		var load_8 = ((+area8) *  (+co8)) / 1000;
		var load_9 = ((+area9) *  (+co9)) / 1000;
		
		$('#load_7').val(load_7.toFixed(2));
		$('#load_8').val(load_8.toFixed(2));
		$('#load_9').val(load_9.toFixed(2));
		
		
		}
		$('#comp').css("background-color","var(--success)");

	}
	
	
	
	
	function load_3_day()
	{
		
		var l1 = $('#l1').val();
		var l2 = $('#l2').val();
		var l3 = $('#l3').val();
		
		var wi1 = $('#wi1').val();
		var wi2 = $('#wi2').val();
		var wi3 = $('#wi3').val();
		
		
		var area_1 = (+l1) * (+b1);  
		var area_2 = (+l2) * (+b2);  
		var area_3 = (+l3) * (+b3);
		
		$('#a1').val(area_1.toFixed(2));
		$('#a2').val(area_2.toFixed(2));
		$('#a3').val(area_3.toFixed(2));	
		
		var area1 = $('#a1').val();
		var area2 = $('#a2').val();
		var area3 = $('#a3').val();
		
		var load_1 = $('#load_1').val();
		var load_2 = $('#load_2').val();
		var load_3 = $('#load_3').val();
		
		
		var com_1 = (1000 *  (+load_1)) / (+area1);
		var com_2 = (1000 *  (+load_2)) / (+area2);
		var com_3 = (1000 *  (+load_3)) / (+area3);
		
			
		$('#com_1').val(coms1.toFixed(2));
		$('#com_2').val(coms2.toFixed(2));
		$('#com_3').val(coms3.toFixed(2));
		
		
		var co1 = $('#com_1').val();
		var co2 = $('#com_2').val();
		var co3 = $('#com_3').val();
		
		var avg__lime = ((+co1) + (+co2) + (+co3))/3;
		$('#avg_lime').val(avg__lime.toFixed(1));
		
		
		$('#comp').css("background-color","var(--success)");
	}
	
	
	function load_7_day()
	{
		var l4 = $('#l4').val();
		var l5 = $('#l5').val();
		var l6 = $('#l6').val();
		
		
		var wi4 = $('#wi4').val();
		var wi5 = $('#wi5').val();
		var wi6 = $('#wi6').val();
		
		
		
		var area_4 = (+l4) * (+b4);
		var area_5 = (+l5) * (+b5);
		var area_6 = (+l6) * (+b6);
		
		$('#a4').val(area_4.toFixed(2));	
		$('#a5').val(area_5.toFixed(2));	
		$('#a6').val(area_6.toFixed(2));	
		
		var area4 = $('#a4').val();
		var area5 = $('#a5').val();
		var area6 = $('#a6').val();
		
		var load_4 = $('#load_4').val();
		var load_5 = $('#load_5').val();
		var load_6 = $('#load_6').val();
		
		
		var com_4 = (1000 *  (+load_4)) / (+area4);
		var com_5 = (1000 *  (+load_5)) / (+area5);
		var com_6 = (1000 *  (+load_6)) / (+area6);
		
		
			
		$('#com_4').val(coms4.toFixed(2));
		$('#com_5').val(coms5.toFixed(2));
		$('#com_6').val(coms6.toFixed(2));
		
		
		var co4 = $('#com_4').val();
		var co5 = $('#com_5').val();
		var co6 = $('#com_6').val();
		
	
		var avg__cem = ((+co4) + (+co5) + (+co6))/3;
		$('#avg_cem').val(avg__cem.toFixed());
		
		
		$('#comp').css("background-color","var(--success)");
	}
	
	
	function load_28_day()
	{
		var l7 = $('#l7').val();
		var l8 = $('#l8').val();
		var l9 = $('#l9').val();
		
		
		var wi7 = $('#wi7').val();
		var wi8 = $('#wi8').val();
		var wi9 = $('#wi9').val();
		
		
		
		var area_7 = (+l7) * (+b7);
		var area_8 = (+l8) * (+b8);
		var area_9 = (+l9) * (+b9);
		
		$('#a7').val(area_7.toFixed(2));	
		$('#a8').val(area_8.toFixed(2));	
		$('#a9').val(area_9.toFixed(2));	
		
		var area7 = $('#a7').val();
		var area8 = $('#a8').val();
		var area9 = $('#a9').val();
		
		var load_7 = $('#load_7').val();
		var load_8 = $('#load_8').val();
		var load_9 = $('#load_9').val();
	
		
		
		var com_7 = (1000 *  (+load_7)) / (+area7);
		var com_8 = (1000 *  (+load_8)) / (+area8);
		var com_9 = (1000 *  (+load_9)) / (+area9);
		
		
			
		$('#com_7').val(coms7.toFixed(2));
		$('#com_8').val(coms8.toFixed(2));
		$('#com_9').val(coms9.toFixed(2));
		
		
		var co7 = $('#com_7').val();
		var co8 = $('#com_8').val();
		var co9 = $('#com_9').val();
		
		
		var avg__fly = ((+co7) + (+co8) + (+co9))/3;
		$('#avg_fly').val(avg__fly.toFixed());
		
		
		$('#comp').css("background-color","var(--success)");
	}
	
	
	$('#load_1').change(function(){
		load_3_day();
	});
	$('#load_2').change(function(){
		load_3_day();
	});
	$('#load_3').change(function(){
		load_3_day();
	});
	$('#load_4').change(function(){
		load_7_day();
	});
	$('#load_5').change(function(){
		load_7_day();
	});
	$('#load_6').change(function(){
		load_7_day();
	});
	$('#load_7').change(function(){
		load_28_day();
	});
	$('#load_8').change(function(){
		load_28_day();
	});
	$('#load_9').change(function(){
		load_28_day();
	});

	$('#load_10').change(function(){
		load_1_day();
	});
	$('#load_11').change(function(){
		load_1_day();
	});
	$('#load_12').change(function(){
		load_1_day();
	});
	
	$('#l1').change(function(){
		l1_l2_l3();
	});
	$('#l2').change(function(){
		l1_l2_l3();
	});
	$('#l3').change(function(){
		l1_l2_l3();
	});
	$('#wi1').change(function(){
		l1_l2_l3();
	});
	$('#wi2').change(function(){
		l1_l2_l3();
	});
	$('#wi3').change(function(){
		l1_l2_l3();
	});

	
	$('#com_1').change(function(){
		l1_l2_l3();
	});
	$('#com_2').change(function(){
		l1_l2_l3();
	});
	$('#com_3').change(function(){
		l1_l2_l3();
	});
	
	$('#avg_lime').change(function(){
		
			
			
			var l_1 = $('#l1').val();
			var l_2 = $('#l2').val();
			var l_3 = $('#l3').val();
		
			var wi_1 = $('#wi1').val();
			var wi_2 = $('#wi2').val();
			var wi_3 = $('#wi3').val();
			
			var avglime = $('#avg_lime').val();
			
			var com_1 = (+avglime) + 0.34;
			var com_2 = (+avglime) - 0.56;
			var com_3 = (+avglime) + 0.22;
			$('#com_1').val(com_1.toFixed(2));
			$('#com_2').val(com_2.toFixed(2));
			$('#com_3').val(com_3.toFixed(2));	
			
			var com1 = $('#com_1').val();
			var com2 = $('#com_2').val();
			var com3 = $('#com_3').val();
			
			var a1 = (+l_1) * (+wi_1);
			var a2 = (+l_2) * (+wi_2);
			var a3 = (+l_3) * (+wi_3);
			
			
			$('#a1').val(a1.toFixed(2));
			$('#a2').val(a2.toFixed(2));
			$('#a3').val(a3.toFixed(2));
			
			var area1 = $('#a1').val();
			var area2 = $('#a2').val();
			var area3 = $('#a3').val();
			
			var load_1 = ((+area1) *  (+com1)) / 1000;
			var load_2 = ((+area2) *  (+com2)) / 1000;
			var load_3 = ((+area3) *  (+com3)) / 1000;
		
			$('#load_1').val(load_1.toFixed(2));
			$('#load_2').val(load_2.toFixed(2));
			$('#load_3').val(load_3.toFixed(2));
			
			var load1 = $('#load_1').val();
			var load2 = $('#load_2').val();
			var load3 = $('#load_3').val();
		
			
			var coms1 = (1000 *  (+load1)) / (+area1);
			var coms2 = (1000 *  (+load2)) / (+area2);
			var coms3 = (1000 *  (+load3)) / (+area3);
			
			$('#com_1').val(coms1.toFixed(2));
			$('#com_2').val(coms2.toFixed(2));
			$('#com_3').val(coms3.toFixed(2));
			
			
			var co1 = $('#com_1').val();
			var co2 = $('#com_2').val();
			var co3 = $('#com_3').val();
		
			var avg__lime = ((+co1) + (+co2) + (+co3))/3;
			$('#avg_lime').val(avg__lime.toFixed(1));
			
		
		$('#comp').css("background-color","var(--success)");
	});
	
	
	$('#avg_cem').change(function(){
					
			var l_4 = $('#l4').val();
			var l_5 = $('#l5').val();
			var l_6 = $('#l6').val();
			
			
			
			var wi_4 = $('#wi4').val();
			var wi_5 = $('#wi5').val();
			var wi_6 = $('#wi6').val();
			
			var avgcem = $('#avg_cem').val();
			
		
			var com_4 = (+avgcem) + 0.63;
			var com_5 = (+avgcem) - 0.71;
			var com_6 = (+avgcem) + 0.08;
			$('#com_4').val(com_4.toFixed(2));
			$('#com_5').val(com_5.toFixed(2));
			$('#com_6').val(com_6.toFixed(2));
			
			var com4 = $('#com_4').val();
			var com5 = $('#com_5').val();
			var com6 = $('#com_6').val();
			
			
								
			
			
			var a4 = (+l_4) * (+wi_4);
			var a5 = (+l_5) * (+wi_5);
			var a6 = (+l_6) * (+wi_6);
			
			$('#a4').val(a4.toFixed(2));
			$('#a5').val(a5.toFixed(2));
			$('#a6').val(a6.toFixed(2));
			
			var area4 = $('#a4').val();
			var area5 = $('#a5').val();
			var area6 = $('#a6').val();
			
			var load_4 = ((+area4) *  (+com4)) / 1000;
			var load_5 = ((+area5) *  (+com5)) / 1000;
			var load_6 = ((+area6) *  (+com6)) / 1000;
			
			$('#load_4').val(load_4.toFixed(2));
			$('#load_5').val(load_5.toFixed(2));
			$('#load_6').val(load_6.toFixed(2));
		
			
			var load4 = $('#load_4').val();
			var load5 = $('#load_5').val();
			var load6 = $('#load_6').val();
			
			
			
			var coms4 = (1000 *  (+load4)) / (+area4);
			var coms5 = (1000 *  (+load5)) / (+area5);
			var coms6 = (1000 *  (+load6)) / (+area6);
			
			$('#com_4').val(coms4.toFixed(2));
			$('#com_5').val(coms5.toFixed(2));
			$('#com_6').val(coms6.toFixed(2));
			
			
			var co4 = $('#com_4').val();
			var co5 = $('#com_5').val();
			var co6 = $('#com_6').val();
			
			
			var avg__cem = ((+co4) + (+co5) + (+co6))/3;
			$('#avg_cem').val(avg__cem.toFixed());
			
			
		$('#comp').css("background-color","var(--success)");
	});
	
	
	$('#avg_fly').change(function(){
			
			
			var l_7 = $('#l7').val();
			var l_8 = $('#l8').val();
			var l_9 = $('#l9').val();
			
			var wi_7 = $('#wi7').val();
			var wi_8 = $('#wi8').val();
			var wi_9 = $('#wi9').val();
			
			var avgfly = $('#avg_fly').val();
			
			
			var com_7 = (+avgfly) + 0.93;
			var com_8 = (+avgfly) - 0.71;
			var com_9 = (+avgfly) + 0.08;
			$('#com_7').val(com_7.toFixed(2));
			$('#com_8').val(com_8.toFixed(2));
			$('#com_9').val(com_9.toFixed(2));
			
			var com7 = $('#com_7').val();
			var com8 = $('#com_8').val();
			var com9 = $('#com_9').val();
								
			
			
			var a7 = (+l_7) * (+wi_7);
			var a8 = (+l_8) * (+wi_8);
			var a9 = (+l_9) * (+wi_9);

			$('#a7').val(a7.toFixed(2));
			$('#a8').val(a8.toFixed(2));
			$('#a9').val(a9.toFixed(2));
			
			var area7 = $('#a7').val();
			var area8 = $('#a8').val();
			var area9 = $('#a9').val();
			
			var load_7 = ((+area7) *  (+com7)) / 1000;
			var load_8 = ((+area8) *  (+com8)) / 1000;
			var load_9 = ((+area9) *  (+com9)) / 1000;
			
			$('#load_7').val(load_7.toFixed(2));
			$('#load_8').val(load_8.toFixed(2));
			$('#load_9').val(load_9.toFixed(2));
			
			
			var load7 = $('#load_7').val();
			var load8 = $('#load_8').val();
			var load9 = $('#load_9').val();
			
			
			
			var coms7 = (1000 *  (+load7)) / (+area7);
			var coms8 = (1000 *  (+load8)) / (+area8);
			var coms9 = (1000 *  (+load9)) / (+area9);
			
			$('#com_7').val(coms7.toFixed(2));
			$('#com_8').val(coms8.toFixed(2));
			$('#com_9').val(coms9.toFixed(2));
			
			
			var co7 = $('#com_7').val();
			var co8 = $('#com_8').val();
			var co9 = $('#com_9').val();
			
			
			var avg__fly = ((+co7) + (+co8) + (+co9))/3;
			$('#avg_fly').val(avg__fly.toFixed());
		$('#comp').css("background-color","var(--success)");
	});
	
	
	
	$('#l4').change(function(){
		l4_l5_l6();
	});
	$('#l5').change(function(){
		l4_l5_l6();
	});
	$('#l6').change(function(){
		l4_l5_l6();
	});
	$('#wi4').change(function(){
		l4_l5_l6();
	});
	$('#wi5').change(function(){
		l4_l5_l6();
	});
	$('#wi6').change(function(){
		l4_l5_l6();
	});

	
	$('#com_4').change(function(){
		l4_l5_l6();
	});
	$('#com_5').change(function(){
		l4_l5_l6();
	});
	$('#com_6').change(function(){
		l4_l5_l6();
	});
	
	
	
	
	$('#l7').change(function(){
		l7_l8_l9();
	});
	$('#l8').change(function(){
		l7_l8_l9();
	});
	$('#l9').change(function(){
		l7_l8_l9();
	});
	$('#wi7').change(function(){
		l7_l8_l9();
	});
	$('#wi8').change(function(){
		l7_l8_l9();
	});
	$('#wi9').change(function(){
		l7_l8_l9();
	});

	
	$('#com_7').change(function(){
		l7_l8_l9();
	});
	$('#com_8').change(function(){
		l7_l8_l9();
	});
	$('#com_9').change(function(){
		l7_l8_l9();
	});
	
	
	
	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","var(--success)"); 
			//$('#txtwtr').css("background-color","var(--success)"); 
			
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				
				//com  
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						$('#comp').css("background-color","var(--success)");
						$("#chk_com").prop("checked", true); 
						com_auto();
						break;
					}					
				}
				//r15  
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="r15")
					{
						$('#r15s').css("background-color","var(--success)");
						$("#chk_dry").prop("checked", true); 
						dry_auto();
						break;
					}					
				}
				
				//Soundness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{
						
						$("#chk_sou").prop("checked", true); 
						sou_auto();
						break;
					}					
				}
		
				//r45
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="r45")
					{
						
						$("#chk_wet").prop("checked", true); 
						wet_auto();
						break;
					}					
				}
				
				//mou
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mou")
					{
						
						$("#chk_mou").prop("checked", true); 
						mo_auto();
						break;
					}					
				}
				//DRY SHRINKAGE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="shr")
					{
						
						$("#chk_shr").prop("checked", true); 
						shr_auto();
						break;
					}					
				}
				//FINES
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{
						
						$("#chk_fine").prop("checked", true); 
						fines_auto();
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
	function rand(min, max) {
  var offset = min;
  var range = (max - min) + 1;

  var randomNumber = Math.floor( Math.random() * range) + offset;
  return randomNumber;
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
        url: '<?php echo $base_url; ?>save_micro_silica.php',
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
				
				var report_date = $('#report_date').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				
				//r15
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="r15")
					{
						if(document.getElementById('chk_dry').checked) {
								var chk_dry = "1";
						}
						else{
								var chk_dry = "0";
						}
							
							var d1_1 = $('#d1_1').val();
							var d1_2 = $('#d1_2').val();
							var d2_1 = $('#d2_1').val();
							var d2_2 = $('#d2_2').val();
							var d3_1 = $('#d3_1').val();
							var d3_2 = $('#d3_2').val();
							var avg_dry = $('#avg_dry').val();

						break;
					}
					else
					{
							var chk_dry = "0";
							var d1_1 = "0";
							var d1_2 = "0";
							var d2_1 = "0";
							var d2_2 = "0";
							var d3_1 = "0";
							var d3_2 = "0";
							var avg_dry = "0";
						
					}
														
				}
				
				//soundness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{
						if(document.getElementById('chk_sou').checked) {
								var chk_sou = "1";
						}
						else{
								var chk_sou = "0";
						}
							var bar1 = $('#bar1').val();
							var bar2 = $('#bar2').val();
							var dis1_1 = $('#dis1_1').val();
							var dis1_2 = $('#dis1_2').val();
							var dis2_1 = $('#dis2_1').val();
							var dis2_2 = $('#dis2_2').val();
							var avg_sou = $('#avg_sou').val();						
						break;
					}
					else
					{
						
						var chk_sou = "0";	
						var bar1 = "0";
						var bar2 = "0";
						var dis1_1 = "0";
						var dis1_2 = "0";
						var dis2_1 = "0";
						var dis2_2 = "0";
						var avg_sou = "0";
						
					}
														
				}
				
				
				//compressive strength
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						if(document.getElementById('chk_com').checked) {
								var chk_com = "1";
								var chk_lime = "1";
								var chk_cem = "1";
								var chk_fly = "1";
						}
						else{
								var chk_com = "0";
								var chk_lime = "0";
							var chk_cem = "0";
							var chk_fly = "0";
						}
							
							var caste_date1 = $('#caste_date1').val();
							var caste_date2 = $('#caste_date2').val();
							var caste_date3 = $('#caste_date3').val();
							var test_date1 = $('#test_date1').val();
							var test_date2 = $('#test_date2').val();
							var test_date3 = $('#test_date3').val();
							var age1 = $('#age1').val();
							var age2 = $('#age2').val();
							var age3 = $('#age3').val();
							var id1 = $('#id1').val();
							var id2 = $('#id2').val();
							var id3 = $('#id3').val();
							var id4 = $('#id4').val();
							var id5 = $('#id5').val();
							var id6 = $('#id6').val();
							var id7 = $('#id7').val();
							var id8 = $('#id8').val();
							var id9 = $('#id9').val();
							var l1 = $('#l1').val();
							var l2 = $('#l2').val();
							var l3 = $('#l3').val();
							var l4 = $('#l4').val();
							var l5 = $('#l5').val();
							var l6 = $('#l6').val();
							var l7 = $('#l7').val();
							var l8 = $('#l8').val();
							var l9 = $('#l9').val();
							var wi1 = $('#wi1').val();
							var wi2 = $('#wi2').val();
							var wi3 = $('#wi3').val();
							var wi4 = $('#wi4').val();
							var wi5 = $('#wi5').val();
							var wi6 = $('#wi6').val();
							var wi7 = $('#wi7').val();
							var wi8 = $('#wi8').val();
							var wi9 = $('#wi9').val();
							var a1 = $('#a1').val();
							var a2 = $('#a2').val();
							var a3 = $('#a3').val();
							var a4 = $('#a4').val();
							var a5 = $('#a5').val();
							var a6 = $('#a6').val();
							var a7 = $('#a7').val();
							var a8 = $('#a8').val();
							var a9 = $('#a9').val();
							var load_1 = $('#load_1').val();
							var load_2 = $('#load_2').val();
							var load_3 = $('#load_3').val();
							var load_4 = $('#load_4').val();
							var load_5 = $('#load_5').val();
							var load_6 = $('#load_6').val();
							var load_7 = $('#load_7').val();
							var load_8 = $('#load_8').val();
							var load_9 = $('#load_9').val();
							var com_1 = $('#com_1').val();
							var com_2 = $('#com_2').val();
							var com_3 = $('#com_3').val();
							var com_4 = $('#com_4').val();
							var com_5 = $('#com_5').val();
							var com_6 = $('#com_6').val();
							var com_7 = $('#com_7').val();
							var com_8 = $('#com_8').val();
							var com_9 = $('#com_9').val();
							var avg_lime = $('#avg_lime').val();
							var avg_cem = $('#avg_cem').val();
							var avg_fly = $('#avg_fly').val();							
						break;
					}
					else
					{
							var chk_com = "0";	
							var chk_lime = "0";
							var chk_cem = "0";
							var chk_fly = "0";
							var caste_date1 = "0";
							var caste_date2 = "0";
							var caste_date3 = "0";
							var test_date1 = "0";
							var test_date2 = "0";
							var test_date3 = "0";
							var age1 = "0";
							var age2 = "0";
							var age3 = "0";
							var id1 = "0";
							var id2 = "0";
							var id3 = "0";
							var id4 = "0";
							var id5 = "0";
							var id6 = "0";
							var id7 = "0";
							var id8 = "0";
							var id9 = "0";
							var l1 = "0";
							var l2 = "0";
							var l3 = "0";
							var l4 = "0";
							var l5 = "0";
							var l6 = "0";
							var l7 = "0";
							var l8 = "0";
							var l9 = "0";
							var wi1 = "0";
							var wi2 = "0";
							var wi3 = "0";
							var wi4 = "0";
							var wi5 = "0";
							var wi6 = "0";
							var wi7 = "0";
							var wi8 = "0";
							var wi9 = "0";
							var a1 = "0";
							var a2 = "0";
							var a3 = "0";
							var a4 = "0";
							var a5 = "0";
							var a6 = "0";
							var a7 = "0";
							var a8 = "0";
							var a9 = "0";
							var load_1 = "0";
							var load_2 = "0";
							var load_3 = "0";
							var load_4 = "0";
							var load_5 = "0";
							var load_6 = "0";
							var load_7 = "0";
							var load_8 = "0";
							var load_9 = "0";
							var com_1 = "0";
							var com_2 = "0";
							var com_3 = "0";
							var com_4 = "0";
							var com_5 = "0";
							var com_6 = "0";
							var com_7 = "0";
							var com_8 = "0";
							var com_9 = "0";
							var avg_lime = "0";
							var avg_cem = "0";
							var avg_fly = "0";	
					}
														
				}
				
				//dry shrinkage
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="shr")
					{
						if(document.getElementById('chk_shr').checked) {
								var chk_shr = "1";
						}
						else{
								var chk_shr = "0";
						}
							var shr_temp = $('#shr_temp').val();
							var shr_humidity = $('#shr_humidity').val();
							var ans_n = $('#ans_n').val();
							var ans_po = $('#ans_po').val();
							var per = $('#per').val();
							var t_age = $('#t_age').val();
							var t_date = $('#t_date').val();
							var s1 = $('#s1').val();
							var s2 = $('#s2').val();
							var s3 = $('#s3').val();
							var rbar1 = $('#rbar1').val();
							var rbar2 = $('#rbar2').val();
							var rbar3 = $('#rbar3').val();
							var len1 = $('#len1').val();
							var len2 = $('#len2').val();
							var len3 = $('#len3').val();
							var lena1 = $('#lena1').val();
							var lena2 = $('#lena2').val();
							var lena3 = $('#lena3').val();
							var dif1 = $('#dif1').val();
							var dif2 = $('#dif2').val();
							var dif3 = $('#dif3').val();
							var dry1 = $('#dry1').val();
							var dry2 = $('#dry2').val();
							var dry3 = $('#dry3').val();
							var avg_shr = $('#avg_shr').val();							
												
						break;
					}
					else
					{
						var chk_shr = "0";	
						var shr_temp = "0";
						var shr_humidity = "0";
						var ans_n = "0";
						var ans_po = "0";
						var per = "0";
						var t_age = "0";
						var t_date = "0";
						var s1 = "0";
						var s2 = "0";
						var s3 = "0";
						var rbar1 = "0";	
						var rbar2 = "0";	
						var rbar3 = "0";	
						var len1 = "0";
						var len2 = "0";
						var len3 = "0";
						var lena1 = "0";
						var lena2 = "0";
						var lena3 = "0";
						var dif1 = "0";
						var dif2 = "0";
						var dif3 = "0";
						var dry1 = "0";
						var dry2 = "0";
						var dry3 = "0";
						var avg_shr = "0";
					}
														
				}
				
				

				
				//fineneess
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{
						if(document.getElementById('chk_fine').checked) {
								var chk_fine = "1";
						}
						else{
								var chk_fine = "0";
						}
						
						var w1 = $('#w1').val();
						var w2 = $('#w2').val();
						var w3 = $('#w3').val();
						var w4 = $('#w4').val();
						var t1 = $('#t1').val();
						var t2 = $('#t2').val();
						var t3 = $('#t3').val();
						var t4 = $('#t4').val();
						var avg_mass = $('#avg_mass').val();
						var avg_t = $('#avg_t').val();
						var avg_fines = $('#avg_fines').val();
						break;
					}
					else
					{
						var chk_fine = "0";	
						var w1 = "0";
						var w2 = "0";
						var w3 = "0";
						var w4 = "0";
						var t1 = "0";
						var t2 = "0";
						var t3 = "0";
						var t4 = "0";
						var avg_mass = "0";
						var avg_t = "0";
						var avg_fines = "0";
					}
														
				}
				
				//r45
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="r45")
					{
						if(document.getElementById('chk_wet').checked) {
								var chk_wet = "1";
						}
						else{
								var chk_wet = "0";
						}
																
							var w1_1 = $('#w1_1').val();
							var w1_2 = $('#w1_2').val();
							var w2_1 = $('#w2_1').val();
							var w2_2 = $('#w2_2').val();
							var w3_1 = $('#w3_1').val();
							var w3_2 = $('#w3_2').val();
							var avg_wet = $('#avg_wet').val();
						
							
						break;
					}
					else
					{
						var chk_wet = "0";	
						var w1_1 = "0";	
						var w1_2 = "0";	
						var w2_1 = "0";	
						var w2_2 = "0";	
						var w3_1 = "0";	
						var w3_2 = "0";	
						var avg_wet = "0";	
						
					}
														
				}
					
				//chk_mou
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mou")
					{
						if(document.getElementById('chk_mou').checked) {
								var chk_mou = "1";
						}
						else{
								var chk_mou = "0";
						}
							var in_w1 = $('#in_w1').val();							
							var in_w2 = $('#in_w2').val();	
							
							var fn_w1 = $('#fn_w1').val();
							var fn_w2 = $('#fn_w2').val();
							
							var fbs_m1 = $('#fbs_m1').val();
							var fbs_m2 = $('#fbs_m2').val();
							
							var mo1 = $('#mo1').val();
							var mo2 = $('#mo2').val();
							var avg_mo = $('#avg_mo').val();
							
														
						break;
					}
					else
					{
							var chk_mou = "0";
							var in_w1 = "0";						
							var in_w2 = "0";
							
							var fn_w1 = "0";
							var fn_w2 = "0";
							
							var fbs_m1 = "0";
							var fbs_m2 = "0";
							
							var mo1 = "0";
							var mo2 = "0";
							var avg_mo = "0";
						
					}
														
				}
	
					
					billData = '&action_type='+type+'&report_no='+report_no+'&ulr='+ulr+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_dry='+chk_dry+'&d1_1='+d1_1+'&d1_2='+d1_2+'&d2_1='+d2_1+'&d2_2='+d2_2+'&d3_1='+d3_1+'&d3_2='+d3_2+'&avg_dry='+avg_dry+'&chk_wet='+chk_wet+'&w1_1='+w1_1+'&w1_2='+w1_2+'&w2_1='+w2_1+'&w2_2='+w2_2+'&w3_1='+w3_1+'&w3_2='+w3_2+'&avg_wet='+avg_wet+'&chk_fine='+chk_fine+'&w1='+w1+'&w2='+w2+'&w3='+w3+'&w4='+w4+'&t1='+t1+'&t2='+t2+'&t3='+t3+'&t4='+t4+'&avg_mass='+avg_mass+'&avg_t='+avg_t+'&avg_fines='+avg_fines+'&chk_sou='+chk_sou+'&bar1='+bar1+'&bar2='+bar2+'&dis1_1='+dis1_1+'&dis1_2='+dis1_2+'&dis2_1='+dis2_1+'&dis2_2='+dis2_2+'&avg_sou='+avg_sou+'&chk_lime='+chk_lime+'&chk_cem='+chk_cem+'&chk_fly='+chk_fly+'&caste_date1='+caste_date1+'&caste_date2='+caste_date2+'&caste_date3='+caste_date3+'&test_date1='+test_date1+'&test_date2='+test_date2+'&test_date3='+test_date3+'&age1='+age1+'&age2='+age2+'&age3='+age3+'&id1='+id1+'&id2='+id2+'&id3='+id3+'&id4='+id4+'&id5='+id5+'&id6='+id6+'&id7='+id7+'&id8='+id8+'&id9='+id9+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&l6='+l6+'&l7='+l7+'&l8='+l8+'&l9='+l9+'&wi1='+wi1+'&wi2='+wi2+'&wi3='+wi3+'&wi4='+wi4+'&wi5='+wi5+'&wi6='+wi6+'&wi7='+wi7+'&wi8='+wi8+'&wi9='+wi9+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&a4='+a4+'&a5='+a5+'&a6='+a6+'&a7='+a7+'&a8='+a8+'&a9='+a9+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&load_6='+load_6+'&load_7='+load_7+'&load_8='+load_8+'&load_9='+load_9+'&com_1='+com_1+'&com_2='+com_2+'&com_3='+com_3+'&com_4='+com_4+'&com_5='+com_5+'&com_6='+com_6+'&com_7='+com_7+'&com_8='+com_8+'&com_9='+com_9+'&avg_lime='+avg_lime+'&avg_cem='+avg_cem+'&avg_fly='+avg_fly+'&chk_shr='+chk_shr+'&shr_temp='+shr_temp+'&shr_humidity='+shr_humidity+'&ans_n='+ans_n+'&ans_po='+ans_po+'&per='+per+'&t_age='+t_age+'&t_date='+t_date+'&s1='+s1+'&s2='+s2+'&s3='+s3+'&rbar1='+rbar1+'&rbar2='+rbar2+'&rbar3='+rbar3+'&len1='+len1+'&len2='+len2+'&len3='+len3+'&lena1='+lena1+'&lena2='+lena2+'&lena3='+lena3+'&dif1='+dif1+'&dif2='+dif2+'&dif3='+dif3+'&dry1='+dry1+'&dry2='+dry2+'&dry3='+dry3+'&avg_shr='+avg_shr+'&chk_mass='+chk_mou+'&in_w1='+in_w1+'&in_w2='+in_w2+'&fn_w1='+fn_w1+'&fn_w2='+fn_w2+'&mo1='+mo1+'&mo2='+mo2+'&avg_mo='+avg_mo+'&amend_date='+amend_date;
			
					
					
					
					
					
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var report_date = $('#report_date').val();
				var ulr = $('#ulr').val();
				var amend_date = $('#amend_date').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//r15
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="r15")
					{
						if(document.getElementById('chk_dry').checked) {
								var chk_dry = "1";
						}
						else{
								var chk_dry = "0";
						}
							
							var d1_1 = $('#d1_1').val();
							var d1_2 = $('#d1_2').val();
							var d2_1 = $('#d2_1').val();
							var d2_2 = $('#d2_2').val();
							var d3_1 = $('#d3_1').val();
							var d3_2 = $('#d3_2').val();
							var avg_dry = $('#avg_dry').val();

						break;
					}
					else
					{
							var chk_dry = "0";
							var d1_1 = "0";
							var d1_2 = "0";
							var d2_1 = "0";
							var d2_2 = "0";
							var d3_1 = "0";
							var d3_2 = "0";
							var avg_dry = "0";
						
					}
														
				}
				
				//soundness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{
						if(document.getElementById('chk_sou').checked) {
								var chk_sou = "1";
						}
						else{
								var chk_sou = "0";
						}
							var bar1 = $('#bar1').val();
							var bar2 = $('#bar2').val();
							var dis1_1 = $('#dis1_1').val();
							var dis1_2 = $('#dis1_2').val();
							var dis2_1 = $('#dis2_1').val();
							var dis2_2 = $('#dis2_2').val();
							var avg_sou = $('#avg_sou').val();						
						break;
					}
					else
					{
						
						var chk_sou = "0";	
						var bar1 = "0";
						var bar2 = "0";
						var dis1_1 = "0";
						var dis1_2 = "0";
						var dis2_1 = "0";
						var dis2_2 = "0";
						var avg_sou = "0";
						
					}
														
				}
				
				
				//compressive strength
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						if(document.getElementById('chk_com').checked) {
								var chk_com = "1";
								var chk_lime = "1";
								var chk_cem = "1";
								var chk_fly = "1";
						}
						else{
								var chk_com = "0";
								var chk_lime = "0";
							var chk_cem = "0";
							var chk_fly = "0";
						}
							
							var caste_date1 = $('#caste_date1').val();
							var caste_date2 = $('#caste_date2').val();
							var caste_date3 = $('#caste_date3').val();
							var test_date1 = $('#test_date1').val();
							var test_date2 = $('#test_date2').val();
							var test_date3 = $('#test_date3').val();
							var age1 = $('#age1').val();
							var age2 = $('#age2').val();
							var age3 = $('#age3').val();
							var id1 = $('#id1').val();
							var id2 = $('#id2').val();
							var id3 = $('#id3').val();
							var id4 = $('#id4').val();
							var id5 = $('#id5').val();
							var id6 = $('#id6').val();
							var id7 = $('#id7').val();
							var id8 = $('#id8').val();
							var id9 = $('#id9').val();
							var l1 = $('#l1').val();
							var l2 = $('#l2').val();
							var l3 = $('#l3').val();
							var l4 = $('#l4').val();
							var l5 = $('#l5').val();
							var l6 = $('#l6').val();
							var l7 = $('#l7').val();
							var l8 = $('#l8').val();
							var l9 = $('#l9').val();
							var wi1 = $('#wi1').val();
							var wi2 = $('#wi2').val();
							var wi3 = $('#wi3').val();
							var wi4 = $('#wi4').val();
							var wi5 = $('#wi5').val();
							var wi6 = $('#wi6').val();
							var wi7 = $('#wi7').val();
							var wi8 = $('#wi8').val();
							var wi9 = $('#wi9').val();
							var a1 = $('#a1').val();
							var a2 = $('#a2').val();
							var a3 = $('#a3').val();
							var a4 = $('#a4').val();
							var a5 = $('#a5').val();
							var a6 = $('#a6').val();
							var a7 = $('#a7').val();
							var a8 = $('#a8').val();
							var a9 = $('#a9').val();
							var load_1 = $('#load_1').val();
							var load_2 = $('#load_2').val();
							var load_3 = $('#load_3').val();
							var load_4 = $('#load_4').val();
							var load_5 = $('#load_5').val();
							var load_6 = $('#load_6').val();
							var load_7 = $('#load_7').val();
							var load_8 = $('#load_8').val();
							var load_9 = $('#load_9').val();
							var com_1 = $('#com_1').val();
							var com_2 = $('#com_2').val();
							var com_3 = $('#com_3').val();
							var com_4 = $('#com_4').val();
							var com_5 = $('#com_5').val();
							var com_6 = $('#com_6').val();
							var com_7 = $('#com_7').val();
							var com_8 = $('#com_8').val();
							var com_9 = $('#com_9').val();
							var avg_lime = $('#avg_lime').val();
							var avg_cem = $('#avg_cem').val();
							var avg_fly = $('#avg_fly').val();							
						break;
					}
					else
					{
							var chk_com = "0";	
							var chk_lime = "0";
							var chk_cem = "0";
							var chk_fly = "0";
							var caste_date1 = "0";
							var caste_date2 = "0";
							var caste_date3 = "0";
							var test_date1 = "0";
							var test_date2 = "0";
							var test_date3 = "0";
							var age1 = "0";
							var age2 = "0";
							var age3 = "0";
							var id1 = "0";
							var id2 = "0";
							var id3 = "0";
							var id4 = "0";
							var id5 = "0";
							var id6 = "0";
							var id7 = "0";
							var id8 = "0";
							var id9 = "0";
							var l1 = "0";
							var l2 = "0";
							var l3 = "0";
							var l4 = "0";
							var l5 = "0";
							var l6 = "0";
							var l7 = "0";
							var l8 = "0";
							var l9 = "0";
							var wi1 = "0";
							var wi2 = "0";
							var wi3 = "0";
							var wi4 = "0";
							var wi5 = "0";
							var wi6 = "0";
							var wi7 = "0";
							var wi8 = "0";
							var wi9 = "0";
							var a1 = "0";
							var a2 = "0";
							var a3 = "0";
							var a4 = "0";
							var a5 = "0";
							var a6 = "0";
							var a7 = "0";
							var a8 = "0";
							var a9 = "0";
							var load_1 = "0";
							var load_2 = "0";
							var load_3 = "0";
							var load_4 = "0";
							var load_5 = "0";
							var load_6 = "0";
							var load_7 = "0";
							var load_8 = "0";
							var load_9 = "0";
							var com_1 = "0";
							var com_2 = "0";
							var com_3 = "0";
							var com_4 = "0";
							var com_5 = "0";
							var com_6 = "0";
							var com_7 = "0";
							var com_8 = "0";
							var com_9 = "0";
							var avg_lime = "0";
							var avg_cem = "0";
							var avg_fly = "0";	
					}
														
				}
				
				//dry shrinkage
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="shr")
					{
						if(document.getElementById('chk_shr').checked) {
								var chk_shr = "1";
						}
						else{
								var chk_shr = "0";
						}
							var shr_temp = $('#shr_temp').val();
							var shr_humidity = $('#shr_humidity').val();
							var ans_n = $('#ans_n').val();
							var ans_po = $('#ans_po').val();
							var per = $('#per').val();
							var t_age = $('#t_age').val();
							var t_date = $('#t_date').val();
							var s1 = $('#s1').val();
							var s2 = $('#s2').val();
							var s3 = $('#s3').val();
							var rbar1 = $('#rbar1').val();
							var rbar2 = $('#rbar2').val();
							var rbar3 = $('#rbar3').val();
							var len1 = $('#len1').val();
							var len2 = $('#len2').val();
							var len3 = $('#len3').val();
							var lena1 = $('#lena1').val();
							var lena2 = $('#lena2').val();
							var lena3 = $('#lena3').val();
							var dif1 = $('#dif1').val();
							var dif2 = $('#dif2').val();
							var dif3 = $('#dif3').val();
							var dry1 = $('#dry1').val();
							var dry2 = $('#dry2').val();
							var dry3 = $('#dry3').val();
							var avg_shr = $('#avg_shr').val();							
												
						break;
					}
					else
					{
						var chk_shr = "0";	
						var shr_temp = "0";
						var shr_humidity = "0";
						var ans_n = "0";
						var ans_po = "0";
						var per = "0";
						var t_age = "0";
						var t_date = "0";
						var s1 = "0";
						var s2 = "0";
						var s3 = "0";
						var rbar1 = "0";	
						var rbar2 = "0";	
						var rbar3 = "0";	
						var len1 = "0";
						var len2 = "0";
						var len3 = "0";
						var lena1 = "0";
						var lena2 = "0";
						var lena3 = "0";
						var dif1 = "0";
						var dif2 = "0";
						var dif3 = "0";
						var dry1 = "0";
						var dry2 = "0";
						var dry3 = "0";
						var avg_shr = "0";
					}
														
				}
				
				

				
				//fineneess
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{
						if(document.getElementById('chk_fine').checked) {
								var chk_fine = "1";
						}
						else{
								var chk_fine = "0";
						}
						
						var w1 = $('#w1').val();
						var w2 = $('#w2').val();
						var w3 = $('#w3').val();
						var w4 = $('#w4').val();
						var t1 = $('#t1').val();
						var t2 = $('#t2').val();
						var t3 = $('#t3').val();
						var t4 = $('#t4').val();
						var avg_mass = $('#avg_mass').val();
						var avg_t = $('#avg_t').val();
						var avg_fines = $('#avg_fines').val();
						break;
					}
					else
					{
						var chk_fine = "0";	
						var w1 = "0";
						var w2 = "0";
						var w3 = "0";
						var w4 = "0";
						var t1 = "0";
						var t2 = "0";
						var t3 = "0";
						var t4 = "0";
						var avg_mass = "0";
						var avg_t = "0";
						var avg_fines = "0";
					}
														
				}
				
				//r45
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="r45")
					{
						if(document.getElementById('chk_wet').checked) {
								var chk_wet = "1";
						}
						else{
								var chk_wet = "0";
						}
																
							var w1_1 = $('#w1_1').val();
							var w1_2 = $('#w1_2').val();
							var w2_1 = $('#w2_1').val();
							var w2_2 = $('#w2_2').val();
							var w3_1 = $('#w3_1').val();
							var w3_2 = $('#w3_2').val();
							var avg_wet = $('#avg_wet').val();
						
							
						break;
					}
					else
					{
						var chk_che = "0";	
						var w1_1 = "0";	
						var w1_2 = "0";	
						var w2_1 = "0";	
						var w2_2 = "0";	
						var w3_1 = "0";	
						var w3_2 = "0";	
						var avg_wet = "0";	
						
					}
														
				}
					
				//chk_mou
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mou")
					{
						if(document.getElementById('chk_mou').checked) {
								var chk_mou = "1";
						}
						else{
								var chk_mou = "0";
						}
							var in_w1 = $('#in_w1').val();							
							var in_w2 = $('#in_w2').val();	
							
							var fn_w1 = $('#fn_w1').val();
							var fn_w2 = $('#fn_w2').val();
							
							var fbs_m1 = $('#fbs_m1').val();
							var fbs_m2 = $('#fbs_m2').val();
							
							var mo1 = $('#mo1').val();
							var mo2 = $('#mo2').val();
							var avg_mo = $('#avg_mo').val();
							
														
						break;
					}
					else
					{
							var chk_mou = "0";
							var in_w1 = "0";						
							var in_w2 = "0";
							
							var fn_w1 = "0";
							var fn_w2 = "0";
							
							var fbs_m1 = "0";
							var fbs_m2 = "0";
							
							var mo1 = "0";
							var mo2 = "0";
							var avg_mo = "0";
						
					}
														
				}
	
					
				
					
			
				
				var idEdit = $('#idEdit').val(); 
		
				billData = '&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&ulr='+ulr+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_dry='+chk_dry+'&d1_1='+d1_1+'&d1_2='+d1_2+'&d2_1='+d2_1+'&d2_2='+d2_2+'&d3_1='+d3_1+'&d3_2='+d3_2+'&avg_dry='+avg_dry+'&chk_wet='+chk_wet+'&w1_1='+w1_1+'&w1_2='+w1_2+'&w2_1='+w2_1+'&w2_2='+w2_2+'&w3_1='+w3_1+'&w3_2='+w3_2+'&avg_wet='+avg_wet+'&chk_fine='+chk_fine+'&w1='+w1+'&w2='+w2+'&w3='+w3+'&w4='+w4+'&t1='+t1+'&t2='+t2+'&t3='+t3+'&t4='+t4+'&avg_mass='+avg_mass+'&avg_t='+avg_t+'&avg_fines='+avg_fines+'&chk_sou='+chk_sou+'&bar1='+bar1+'&bar2='+bar2+'&dis1_1='+dis1_1+'&dis1_2='+dis1_2+'&dis2_1='+dis2_1+'&dis2_2='+dis2_2+'&avg_sou='+avg_sou+'&chk_lime='+chk_lime+'&chk_cem='+chk_cem+'&chk_fly='+chk_fly+'&caste_date1='+caste_date1+'&caste_date2='+caste_date2+'&caste_date3='+caste_date3+'&test_date1='+test_date1+'&test_date2='+test_date2+'&test_date3='+test_date3+'&age1='+age1+'&age2='+age2+'&age3='+age3+'&id1='+id1+'&id2='+id2+'&id3='+id3+'&id4='+id4+'&id5='+id5+'&id6='+id6+'&id7='+id7+'&id8='+id8+'&id9='+id9+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&l6='+l6+'&l7='+l7+'&l8='+l8+'&l9='+l9+'&wi1='+wi1+'&wi2='+wi2+'&wi3='+wi3+'&wi4='+wi4+'&wi5='+wi5+'&wi6='+wi6+'&wi7='+wi7+'&wi8='+wi8+'&wi9='+wi9+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&a4='+a4+'&a5='+a5+'&a6='+a6+'&a7='+a7+'&a8='+a8+'&a9='+a9+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&load_6='+load_6+'&load_7='+load_7+'&load_8='+load_8+'&load_9='+load_9+'&com_1='+com_1+'&com_2='+com_2+'&com_3='+com_3+'&com_4='+com_4+'&com_5='+com_5+'&com_6='+com_6+'&com_7='+com_7+'&com_8='+com_8+'&com_9='+com_9+'&avg_lime='+avg_lime+'&avg_cem='+avg_cem+'&avg_fly='+avg_fly+'&chk_shr='+chk_shr+'&shr_temp='+shr_temp+'&shr_humidity='+shr_humidity+'&ans_n='+ans_n+'&ans_po='+ans_po+'&per='+per+'&t_age='+t_age+'&t_date='+t_date+'&s1='+s1+'&s2='+s2+'&s3='+s3+'&rbar1='+rbar1+'&rbar2='+rbar2+'&rbar3='+rbar3+'&len1='+len1+'&len2='+len2+'&len3='+len3+'&lena1='+lena1+'&lena2='+lena2+'&lena3='+lena3+'&dif1='+dif1+'&dif2='+dif2+'&dif3='+dif3+'&dry1='+dry1+'&dry2='+dry2+'&dry3='+dry3+'&avg_shr='+avg_shr+'&chk_mass='+chk_mou+'&in_w1='+in_w1+'&in_w2='+in_w2+'&fn_w1='+fn_w1+'&fn_w2='+fn_w2+'&mo1='+mo1+'&mo2='+mo2+'&avg_mo='+avg_mo+'&amend_date='+amend_date;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_micro_silica.php',
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
        url: '<?php echo $base_url; ?>save_micro_silica.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
            $('#idEdit').val(data.id);
	
	
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
			$('#report_date').val(data.report_date);
			$('#ulr').val(data.ulr);
			$('#amend_date').val(data.amend_date);
            var temp = $('#test_list').val();
				var aa= temp.split(",");				
			//R15
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="r15")
					{
						
						var chk_dry = data.chk_dry;
						if(chk_dry=="1")
						{
							$('#r15s').css("background-color","var(--success)");
						   $("#chk_dry").prop("checked", true); 
						}else{
							 $('#r15s').css("background-color","white");
							$("#chk_dry").prop("checked", false); 
						}
								
						$('#d1_1').val(data.d1_1);						
						$('#d1_2').val(data.d1_2);
						$('#d2_1').val(data.d2_1);						
						$('#d2_2').val(data.d2_2);
						$('#d3_1').val(data.d3_1);						
						$('#d3_2').val(data.d3_2);
						$('#avg_dry').val(data.avg_dry);
						
						break;
					}
					else
					{
						
					}
														
				}	
				
				//soundness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{
						
						var chk_sou = data.chk_sou;
						if(chk_sou=="1")
						{
							$('#sound').css("background-color","var(--success)");
							$("#chk_sou").prop("checked", true); 
						}else{
							 $('#sound').css("background-color","white");
							 $("#chk_sou").prop("checked", false); 
						}
								
						$('#bar1').val(data.bar1);						
						$('#bar2').val(data.bar2);
						$('#dis1_1').val(data.dis1_1);
						$('#dis1_2').val(data.dis1_2);
						$('#dis2_1').val(data.dis2_1);
						$('#dis2_2').val(data.dis2_2);
						$('#avg_sou').val(data.avg_sou);
						
						
						break;
					}
					else
					{
						
					}
														
				}

				//setting time
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="set")
					{
						
						var chk_set = data.chk_set;
						if(chk_set=="1")
						{
							$('#sett').css("background-color","var(--success)");
						   $("#chk_set").prop("checked", true); 
						}else{
							 $('#sett').css("background-color","white");
							$("#chk_set").prop("checked", false); 
						}
								
						$('#set_date_test').val(data.set_date_test);						
						$('#set_temp').val(data.set_temp);
						$('#set_humidity').val(data.set_humidity);						
						$('#set_wtr').val(data.set_wtr);
						$('#hr_a').val(data.hr_a);
						$('#hr_b').val(data.hr_b);
						$('#hr_c').val(data.hr_c);
						$('#initial_time').val(data.initial_time);
						$('#final_time').val(data.final_time);
						$('#set_weight').val(data.set_weight);
						
						
						break;
					}
					else
					{
						
					}
														
				}	

				//DRYING SHRINKAGE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="shr")
					{
						
						var chk_shr = data.chk_shr;
						if(chk_shr=="1")
						{
							$('#shr_heading').css("background-color","var(--success)");
						    $("#chk_shr").prop("checked", true); 
						}else{
							$('#shr_heading').css("background-color","white");
							$("#chk_shr").prop("checked", false); 
						}
						
						$('#shr_temp').val(data.shr_temp);						
						$('#shr_humidity').val(data.shr_humidity);
						$('#ans_n').val(data.ans_n);
						$('#ans_po').val(data.ans_po);
						$('#t_age').val(data.t_age);
						$('#t_date').val(data.t_date);
						$('#per').val(data.per);
						$('#s1').val(data.s1);						
						$('#s2').val(data.s2);						
						$('#s3').val(data.s3);						
						$('#rbar1').val(data.rbar1);						
						$('#rbar2').val(data.rbar2);						
						$('#rbar3').val(data.rbar3);						
						$('#len1').val(data.len1);						
						$('#len2').val(data.len2);						
						$('#len3').val(data.len3);
						$('#lena1').val(data.lena1);						
						$('#lena2').val(data.lena2);						
						$('#lena3').val(data.lena3);						
						$('#dif1').val(data.dif1);						
						$('#dif2').val(data.dif2);						
						$('#dif3').val(data.dif3);						
						$('#dry1').val(data.dry1);
						$('#dry2').val(data.dry2);
						$('#dry3').val(data.dry3);
						$('#avg_shr').val(data.avg_shr);
						
						break;
					}
					else
					{
						
					}
														
				}	

				//Finneess
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{
						
						var chk_fine = data.chk_fine;
						if(chk_fine=="1")
						{
							$('#fins').css("background-color","var(--success)");
						   $("#chk_fine").prop("checked", true); 
						}else{
							 $('#fins').css("background-color","white");
							$("#chk_fine").prop("checked", false); 
						}
						$('#w1').val(data.w1);
						$('#w2').val(data.w2);
						$('#w3').val(data.w3);
						$('#w4').val(data.w4);
						$('#t1').val(data.t1);
						$('#t2').val(data.t2);
						$('#t3').val(data.t3);
						$('#t4').val(data.t4);
						$('#avg_mass').val(data.avg_mass);	
						$('#avg_t').val(data.avg_t);	
						$('#avg_fines').val(data.avg_fines);
						
						
						break;
					}
					else
					{
						
					}
														
				}	

				//Fineness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="r45")
					{
						
						var chk_wet = data.chk_wet;
						if(chk_wet=="1")
						{
							$('#r45s').css("background-color","var(--success)");
						   $("#chk_wet").prop("checked", true); 
						}else{
							 $('#txtfbs').css("background-color","white");
							$("#chk_wet").prop("checked", false); 
						}
								
						
						$('#w1_1').val(data.w1_1);
						$('#w2_1').val(data.w2_1);
						$('#w3_1').val(data.w3_1);
						
						$('#w1_2').val(data.w1_2);
						$('#w2_2').val(data.w2_2);
						$('#w3_2').val(data.w3_2);
						
						$('#avg_wet').val(data.avg_wet);
						break;
					}
					else
					{
						
					}
														
				}	

				
				//compressive
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						
						var chk_com = data.chk_com;
						
						if(chk_com=="1")
						{
							$('#comp').css("background-color","var(--success)");
						   $("#chk_com").prop("checked", true); 
						}else{
							 $('#comp').css("background-color","white");
							$("#chk_com").prop("checked", false); 
						}
								
						
						$('#caste_date1').val(data.caste_date1);
						$('#caste_date2').val(data.caste_date2);
						$('#caste_date3').val(data.caste_date3);
						
						$('#test_date1').val(data.test_date1);
						$('#test_date2').val(data.test_date2);
						$('#test_date3').val(data.test_date3);
						
						$('#age1').val(data.age1);
						$('#age2').val(data.age2);
						$('#age3').val(data.age3);
						
						$('#id1').val(data.id1);
						$('#id2').val(data.id2);
						$('#id3').val(data.id3);
						$('#id4').val(data.id4);
						$('#id5').val(data.id5);
						$('#id6').val(data.id6);
						$('#id7').val(data.id7);
						$('#id8').val(data.id8);
						$('#id9').val(data.id9);
						
						$('#l1').val(data.l1);
						$('#l2').val(data.l2);
						$('#l3').val(data.l3);
						$('#l4').val(data.l4);
						$('#l5').val(data.l5);
						$('#l6').val(data.l6);
						$('#l7').val(data.l7);
						$('#l8').val(data.l8);
						$('#l9').val(data.l9);
						
						$('#wi1').val(data.wi1);
						$('#wi2').val(data.wi2);
						$('#wi3').val(data.wi3);
						$('#wi4').val(data.wi4);
						$('#wi5').val(data.wi5);
						$('#wi6').val(data.wi6);
						$('#wi7').val(data.wi7);
						$('#wi8').val(data.wi8);
						$('#wi9').val(data.wi9);
						
						
						$('#a1').val(data.a1);
						$('#a2').val(data.a2);
						$('#a3').val(data.a3);
						$('#a4').val(data.a4);
						$('#a5').val(data.a5);
						$('#a6').val(data.a6);
						$('#a7').val(data.a7);
						$('#a8').val(data.a8);
						$('#a9').val(data.a9);
						
						$('#load_1').val(data.load_1);
						$('#load_2').val(data.load_2);
						$('#load_3').val(data.load_3);
						$('#load_4').val(data.load_4);
						$('#load_5').val(data.load_5);
						$('#load_6').val(data.load_6);
						$('#load_7').val(data.load_7);
						$('#load_8').val(data.load_8);
						$('#load_9').val(data.load_9);
						
						$('#com_1').val(data.com_1);
						$('#com_2').val(data.com_2);
						$('#com_3').val(data.com_3);
						$('#com_4').val(data.com_4);
						$('#com_5').val(data.com_5);
						$('#com_6').val(data.com_6);
						$('#com_7').val(data.com_7);
						$('#com_8').val(data.com_8);
						$('#com_9').val(data.com_9);
						
						$('#avg_lime').val(data.avg_lime);
						$('#avg_cem').val(data.avg_cem);
						$('#avg_fly').val(data.avg_fly);
											
						
						break;
					}
					else
					{
						
					}
														
				}				
				
				//Moisture Contrent
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mou")
					{
						
						var chk_mou = data.chk_mass;
						
						if(chk_mou=="1")
						{
						 $('#mous').css("background-color","var(--success)");
						   $("#chk_mou").prop("checked", true); 
						}else{
							 $('#mous').css("background-color","white");
							$("#chk_mou").prop("checked", false); 
						}

						$('#in_w1').val(data.in_w1);						
						$('#in_w2').val(data.in_w2);
						$('#fn_w1').val(data.fn_w1);						
						$('#fn_w2').val(data.fn_w2);
						$('#mo1').val(data.mo1);						
						$('#mo2').val(data.mo2);
						
					
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



