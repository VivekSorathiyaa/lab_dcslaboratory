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
			
			$com_test_method = "IS 1727:1967 (RA 2018)";
			$com_test_req = "IS 3812(Part-1):2013 (RA 2017)";
			$com_test_limit_1 = "Min. 70";
			$com_test_limit_2 = "Min. 50";
			
			$sio_test_method = "IS 1727:1967 (RA 2018)";
			$sio_test_req = "IS 3812(Part-1):2013 (RA 2017)";
			$sio_test_limit_1 = "Min. 35";
			$sio_test_limit_2 = "Min. 25";
			
			$mang_test_method = "IS 1727:1967 (RA 2018)";
			$mang_test_req = "IS 3812(Part-1):2013 (RA 2017)";
			$mang_test_limit_1 = "Max. 5.0";
			$mang_test_limit_2 = "Max. 5.0";
			
			$tot_test_method = "IS 1727:1967 (RA 2018)";
			$tot_test_req = "IS 3812(Part-1):2013 (RA 2017)";
			$tot_test_limit_1 = "Max. 3.0";
			$tot_test_limit_2 = "Max. 3.0";
			
			$alk_test_method = "IS 3812(Part-1):2013 (RA 2017) ANNEX C";
			$alk_test_req = "IS 3812(Part-1):2013 (RA 2017)";
			$alk_test_limit_1 = "Max. 1.5";
			$alk_test_limit_2 = "Max. 1.5";
			
			$chl_test_method = "IS 4032:1985 (RA 2019)";
			$chl_test_req = "IS 3812(Part-1):2013 (RA 2017)";
			$chl_test_limit_1 = "Max. 0.05";
			$chl_test_limit_2 = "Max. 0.05";
			
			$los_test_method = "IS 1727:1967 (RA 2018)";
			$los_test_req = "IS 3812(Part-1):2013 (RA 2017)";
			$los_test_limit_1 = "Max. 5.0";
			$los_test_limit_2 = "Max. 5.0";
				
	
?>
<div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">FLYASH CHEMICAL</h2>
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
								
							<!-- LAB NO PUT VAIBHAV-->
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">Remarks.:</label>-->
										  <div class="col-sm-2">
										  <label for="inputEmail3" class="col-sm-2 control-label">REMARKS :</label>								 
											</div>
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="rem_data" value="" name="rem_data">
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
													$querys_job1 = "SELECT * FROM flyash_chemical WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_flyash_chem.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>"class="btn btn-info" id="btn_report" name="btn_report"><b>Report</b></a> 
												<!--<a target = '_blank' href="<?php //echo $base_url; ?>print_report/print_span_chem_cement.php?job_no=<?php// echo $_GET['job_no'];?>&&report_no=<?php// echo $_GET['report_no'];?>&&lab_no=<?php// echo $_GET['lab_no'];?>"class="btn btn-info " id="btn_report" name="btn_report" style="margin-left:5px;"><b>Chemical Report</b></a>-->
 
											</div>

											
											
											<?php //} ?>
											<div class="col-sm-3">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_flyash_chem.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>"class="btn btn-info" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
												<!--<a target = '_blank' href="<?php// echo $base_url; ?>back_cal_report/print_chem_cement.php?job_no=<?php// echo $_GET['job_no'];?>&&report_no=<?php// echo $_GET['report_no'];?>&&lab_no=<?php// echo $_GET['lab_no'];?>"class="btn btn-info" id="btn_cal_report1" name="btn_cal_report1" style="margin-left:5px;"><b>Chemical Calculation Report</b></a>-->

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
			
			if($r12['test_code']=="con")
			{
				$test_check.="con,";
			?>
  
  <div class="panel panel-default" id="con">
      <div class="panel-heading" id="consis">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
			<h4 class="panel-title">
			<b>CONSISTENCY TEST</b>
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
													<label for="chk_con">1.</label>
													<input type="checkbox" class="visually-hidden" name="chk_con"  id="chk_con" value="chk_con"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CONSISTENCY TEST</label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="con_date_test" name="con_date_test" >
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
												<label for="inputEmail3" class="col-sm-12 control-label">Temp.(&#8451;) :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con_temp" name="con_temp" >
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
													<input type="text" class="form-control" id="con_humidity" name="con_humidity" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement (gm) :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="con_weight" name="con_weight" value="400" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									
									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">Weight of water (ml)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">% Consistency</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">Penetration (mm)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-2 control-label">Remakes</label>-->
											</div>
										</div>
									</div>
								</div>
								</br>
								<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="vol_1" name="vol_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_1" name="wtr_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="reading_1" name="reading_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="remark_1" name="remark_1
													" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="vol_2" name="vol_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_2" name="wtr_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="reading_2" name="reading_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="remark_2" name="remark_2
													" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="vol_3" name="vol_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_3" name="wtr_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="reading_3" name="reading_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="remark_3" name="remark_3
													" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="vol_4" name="vol_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_4" name="wtr_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="reading_4" name="reading_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="remark_4" name="remark_4
													" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="vol_5" name="vol_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="wtr_5" name="wtr_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="reading_5" name="reading_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="remark_5" name="remark_5
													" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="vol_6" name="vol_6" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="wtr_6" name="wtr_6" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="reading_6" name="reading_6" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="remark_6" name="remark_6
													" >
												</div>
											</div>
										</div>
								</div>
								<br>
								<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="vol_7" name="vol_7" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="wtr_7" name="wtr_7" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="reading_7" name="reading_7" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="remark_7" name="remark_7
													" >
												</div>
											</div>
										</div>
								</div>
									<br>
								<div class="row">
										
										<div class="col-lg-3">
											<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Final Consistency (%) :</label>
											</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="final_consistency" name="final_consistency" >
												</div>
											</div>
										</div>
										<div class="col-lg-2">
											
										</div>
										<div class="col-lg-2">
											
										</div>
										<div class="col-lg-2">
											
										</div>
								</div>
								<br>
								</div>
					  </div>
					</div>
			
			<?php
			}
		}
		
		$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		while($r1 = mysqli_fetch_array($result_select1)){
			 if($r1['test_code']=="sou")
			{
				$test_check.="sou,";
			?>
  
	<div class="panel panel-default" id="sou">
      <div class="panel-heading" id="sound">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
			<h4 class="panel-title">
			<b>SOUNDNESS BY LE-CHATELIER</b>
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
													<label for="chk_sou">5.</label>
													<input type="checkbox" class="visually-hidden" name="chk_sou"  id="chk_sou" value="chk_sou"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SOUNDNESS BY LE-CHATELIER</label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="sou_date_test" name="sou_date_test" >
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
												<label for="inputEmail3" class="col-sm-12 control-label">Temp. (&#8451;):</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sou_temp" name="sou_temp" >
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
													<input type="text" class="form-control" id="sou_humidity" name="sou_humidity" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement (gm) :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sou_weight" name="sou_weight" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Water (gm) = (0.78 x Consistency in %) x 2 </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sou_water" name="sou_water" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									
									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Distance between two points
												after 24 hours in water (mm)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Reading after 3 hrs. in boiling (mm)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">Difference (mm)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">Average (mm)</label>
											</div>
										</div>
									</div>
								</div>
								</br>
								<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dis_1_1" name="dis_1_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dis_2_1" name="dis_2_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="diff_1" name="diff_1" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="soundness" name="soundness
													" >
												</div>
											</div>
										</div>
								</div>
								<br>
									<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dis_1_2" name="dis_1_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="dis_2_2" name="dis_2_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="diff_2" name="diff_2" readonly>
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
			else if($r1['test_code']=="set")
			{
				$test_check.="set,";
			?>
	<div class="panel panel-default" id="set">
      <div class="panel-heading" id="sett">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
			<h4 class="panel-title">
			<b>SETTING TIME</b>
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
													<label for="chk_set">3.</label>
													<input type="checkbox" class="visually-hidden" name="chk_set"  id="chk_set" value="chk_set"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">SETTING TIME</label>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="set_date_test" name="set_date_test" >
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
												<label for="inputEmail3" class="col-sm-12 control-label">Temp. (&#8451;):</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="set_temp" name="set_temp" >
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
													<input type="text" class="form-control" id="set_humidity" name="set_humidity" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="set_weight" name="set_weight" >
												</div>
											</div>
									
									</div>
										<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">gm </label>
											</div>
										</div>
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Water = 0.85 x Consistency (%)  x 4 = </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="set_wtr" name="set_wtr" >
												</div>
											</div>
									
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">gm </label>
											</div>
										</div>
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">a) Time when water added : </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="hr_a" name="hr_a" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">hr/min </label>
											</div>
										</div>
									</div>
									
								</div>
								</br>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">b) Initial setting time :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="hr_b" name="hr_b" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">hr/min </label>
											</div>
										</div>
									</div>
								
								</div>
								</br>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">c) Final setting time : </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="hr_c" name="hr_c" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">hr/min </label>
											</div>
										</div>
									</div>
								
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Initial setting time :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="initial_time" name="initial_time" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">min.</label>
											</div>
										</div>
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Final setting time :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="final_time" name="final_time" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">min.</label>
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
			else if($r1['test_code']=="den")
			{
				$test_check.="den,";
			?>
	<div class="panel panel-default" id="den">
      <div class="panel-heading" id="dens">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
			<h4 class="panel-title">
			<b>DENSITY OF CEMENT &amp; FINENESS BLAIN AIR PERMEABILITY</b>
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
													<label for="chk_den">6.</label>
													<input type="checkbox" class="visually-hidden" name="chk_den"  id="chk_den" value="chk_den"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">DENSITY OF CEMENT &amp; FINENESS BLAIN AIR PERMEABILITY</label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="den_date_test" name="den_date_test" >
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
												<label for="inputEmail3" class="col-sm-12 control-label">Temp. (&#8451;):</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="den_temp" name="den_temp" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">	
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement : - </label>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="den_cement" name="den_cement" >
											</div>
										</div>
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
													<input type="text" class="form-control" id="den_humidity" name="den_humidity" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">Test - 1, A</label>
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">Test - 2, B</label>
												</div>
											</div>
									</div>
								</div>
								
								<br>
								
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Initial Reading of kerosene =</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="den_intial" name="den_intial" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="den_intial1" name="den_intial1" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="den_intial2" name="den_intial2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">ml</label>
											</div>
										</div>
									</div>
									
								</div>
								</br>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Final Reading of kerosene with Cement =</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="den_final" name="den_final" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="den_final1" name="den_final1" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="den_final2" name="den_final2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">ml</label>
											</div>
										</div>
									</div>
									
									</div>
									<br>
									<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Displaced Volume = Final Reading – Initial Reading =</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="den_displaced" name="den_displaced" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="den_displaced1" name="den_displaced1" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="den_displaced2" name="den_displaced2" >
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
												<label for="inputEmail3" class="col-sm-12 control-label">Mass of Cement in Gram</label>
											</div>
										</div>
									</div>
									</div>
									<div class="row">
										
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Density (P	) = ------------------------------------ =</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="density" name="density" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="density1" name="density1" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="density2" name="density2" >
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
												<label for="inputEmail3" class="col-sm-12 control-label">Displaced Volume in cm 3</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="avg_density" name="avg_density" >
												</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">g/cm<sup>3</sup></label>
											</div>
										</div>
									</div>
									</div>
									<br>
									<div class="row">
										
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Density = (A + B) / 2</label>-->
											</div>
										</div>
									</div>
									</div>
									<Br>
									<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label"><b>Volume of Cement</b></label>-->
											</div>
										</div>
									</div>
									</div>
									<br>
									<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">m2 = Weight of Mercury (Full Cell) in gm</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="den_m2" name="den_m2" >
												</div>
											</div>
									</div>
																	
								</div>
								<br>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">m2 = m3 = Weight of Mercury (With Cement) in gm = </label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="den_m3" name="den_m3" >
												</div>
											</div>
									</div>
																	
								</div>
								<br>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">D = Density of Mercury =</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="den_d" name="den_d" >
												</div>
											</div>
									</div>
																	
								</div>
									<br>
									<div class="row">
										<div class="col-lg-2">
										</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">m2 – m3</label>-->
											</div>
										</div>
									</div>
									</div>
									<div class="row">
										
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Volume of Cement (V) = ----------------------- cm 3 =</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="den_volume" name="den_volume" >
												</div>
											</div>
									</div>
									</div>
									<div class="row">
										<div class="col-lg-2">
										</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">D</label>-->
											</div>
										</div>
									</div>
									</div>
									<br>
									<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement = 0.5 x (p) x (V) =</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="den_weight" name="den_weight" >
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
			else if($r1['test_code']=="fin")
			{
				$test_check.="fin,";
			?>
	<div class="panel panel-default" id="fin">
      <div class="panel-heading" id="fins">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
			<h4 class="panel-title">
			<b>BLAIN AIR PERMEABILITY</b>
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
													<label for="chk_fines">2.</label>
													<input type="checkbox" class="visually-hidden" name="chk_fines"  id="chk_fines" value="chk_fines"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">BLAIN AIR PERMEABILITY</label>
										</div>
									</div>
									
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Apparatus Constant (K)=1.414 S<sub>o</sub> P<sub>o</sub>  &#8730;0.1 n<sub>o</sub> / &#8730;to </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="constant_k" name="constant_k" >
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
													<input type="text" class="form-control" id="fine_temp" name="fine_temp" >
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
													<input type="text" class="form-control" id="fine_humidity" name="fine_humidity" >
												</div>
											</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Time in seconds T : 1)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="fines_t_1" name="fines_t_1" >
												</div>
											</div>
									</div>
								</div>
								<br>
									<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Time in seconds T : 2)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="fines_t_2" name="fines_t_2" >
												</div>
											</div>
									</div>
								</div>
								<br>
									<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Time in seconds T : 3)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="fines_t_3" name="fines_t_3" >
												</div>
											</div>
									</div>
								</div>
								<br>
									<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Average :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="avg_fines_time" name="avg_fines_time" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">sec</label>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Specific surface area S = 521.08 x K x √to / P = </label>
											</div>
										</div>
									</div>
									</div>
									<br>
									<div class="row">
									<div class="col-lg-12">
											<div class="form-group">
												<div class="col-sm-1">
													<label for="inputEmail3" class="col-sm-12 control-label">521.08 X </label>
												</div>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="constant_k_1" name="constant_k_1" readonly> 
												</div>
												<div class="col-sm-1">
													 <label for="inputEmail3" class="col-sm-6 control-label">X</label>
												</div>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="fines_val1" name="fines_val1">  
												</div>
												<div class="col-sm-1">
													 <label for="inputEmail3" class="col-sm-6 control-label">/</label>  
												</div>
												<div class="col-sm-2">
													  <input type="text" class="form-control" id="fines_val2" name="fines_val2"> 
												</div>
											</div>
									</div>
									
									
								</div>
								<br>
								<div class="row">
								<div class="col-lg-1">
								</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label"> = </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ss_area" name="ss_area" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">m 2 /Kg</label>
											</div>
										</div>
									</div>
									
								</div>
								<br>
							<!--	<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
									<div class="col-sm-12">
											<label for="inputEmail3" class="col-sm-12 control-label"> FINENESS BY DRY SEIVING (IS : 4031 - Part I) RA:2016 </label>
											</div>
										</div>
								
								</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">Sr. No.</label>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">Particulars</label>
												</div>
											</div>
										</div>																		
									</div>
									<div class="col-md-6">
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">Trial - 1</label>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">Trial - 2</label>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">Trial - 3</label>
												</div>
											</div>
										</div>																	
									</div>
								</div>
								</br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">1</label>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">Dry weight of Cement(g)</label>
												</div>
											</div>
										</div>																		
									</div>
									<div class="col-md-6">
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d_t_1" name="d_t_1" >
												</div>
												
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d_t_2" name="d_t_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="d_t_3" name="d_t_3" >
												</div>
											</div>
										</div>																	
									</div>
								</div>
								</br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">2</label>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">weight of Cement residue on 90 mic. Sieve (g)</label>
												</div>
											</div>
										</div>																		
									</div>
									<div class="col-md-6">
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="w_t_1" name="w_t_1" >
												</div>
												
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="w_t_2" name="w_t_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="w_t_3" name="w_t_3" >
												</div>
											</div>
										</div>																	
									</div>
								</div>
								</br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">3</label>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label">Cement residue on the 90 mic. Sieve(%)</label>
												</div>
											</div>
										</div>																		
									</div>
									<div class="col-md-6">
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="c_t_1" name="c_t_1" >
												</div>
												
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="c_t_2" name="c_t_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="c_t_3" name="c_t_3" >
												</div>
											</div>
										</div>																	
									</div>
								</div>
								</br>
								<br>
								<div class="row">
								<div class="col-lg-1">
								</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label"> Average Fineness : </label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ss_area_1" name="ss_area_1" >
												</div>
											</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												
											</div>
										</div>
									</div>
									
								</div>-->
								<br>
							<br>								
						</div>
					<br>
					<br>
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
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
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
												<label for="inputEmail3" class="col-sm-12 control-label">Temp.(&#8451;) :</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="com_temp" name="com_temp" >
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
													<input type="text" class="form-control" id="com_humidity" name="com_humidity" >
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
									</div>
									
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
									<div class="col-md-6">
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Specification</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Date of Casting</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Actual Date of Testing</label>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Age of Testing (Days)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">L</label>-->
											</div>
										</div>
									</div>
									
									</div>
									<div class="col-md-6">
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">B</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">H</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-1">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Cross Sectional Area(mm 2 )</label>-->
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Maximum load (KN)</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Compressive Strength (N/mm 2 )</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Average
												Compressive Strength (N/mm 2 )</label>
											</div>
										</div>
									</div>
								</div>
								</div>
								</br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="sp_1" name="sp_1" readonly>
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
													<input type="text" class="form-control" id="test_date1" name="test_date1" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="day_1" name="day_1" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="l1" name="l1
													" >
												</div>
											</div>
										</div> 
										</div> 
									<div class="col-md-6">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="b1" name="b1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="h1" name="h1" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="area_1" name="area_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="load_1" name="load_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="com_1" name="com_1" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="avg_com_1" name="avg_com_1" >
												
												</div>
											
											</div>
										</div>
										
										</div>
										
					  </div>
					  <br>
					  <div class="row">
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
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
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="l2" name="l2
													" >
												</div>
											</div>
										</div> 
										</div> 
									<div class="col-md-6">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="b2" name="b2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="h2" name="h2" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="area_2" name="area_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="load_2" name="load_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="com_2" name="com_2" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">													
												<label for="chk_chk1">For 3 Days</label>
													<input type="checkbox" class="visually-hidden" name="chk_chk1"  id="chk_chk1" value="chk_chk1"><br>
												</div>
												
											</div>
										</div>
										
										</div>
										
					  </div>
						  <br>
					  <div class="row">
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
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
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="l3" name="l3
													" >
												</div>
											</div>
										</div> 
										</div> 
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="b3" name="b3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="h3" name="h3" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="area_3" name="area_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="load_3" name="load_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="com_3" name="com_3" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
												
												</div>
											</div>
										</div>
										
										</div>
										
					  </div>
						<br>
							<div class="row">
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="sp_2" name="sp_2" readonly>
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
													<input type="text" class="form-control" id="test_date2" name="test_date2" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="day_2" name="day_2" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="l4" name="l4
													" >
												</div>
											</div>
										</div> 
										</div> 
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="b4" name="b4" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="h4" name="h4" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="area_4" name="area_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="load_4" name="load_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="com_4" name="com_4" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="avg_com_2" name="avg_com_2" >
												</div>
												
												
											</div>
										</div>
										
										</div>
										
					  </div>
					  <br>

					  <div class="row">
									<div class="col-md-6">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
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
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="l5" name="l5
													" >
												</div>
											</div>
										</div> 
										</div> 
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="b5" name="b5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="h5" name="h5" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="area_5" name="area_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="load_5" name="load_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="com_5" name="com_5" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">													
												<label for="chk_chk2">For 7 Days</label>
													<input type="checkbox" class="visually-hidden" name="chk_chk2"  id="chk_chk2" value="chk_chk2"><br>
												</div>
												
											</div>
										</div>
										
										</div>
										
					  </div>
					<br>

					  <div class="row">
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
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
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="l6" name="l6
													" >
												</div>
											</div>
										</div> 
										</div> 
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="b6" name="b6" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="h6" name="h6" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="area_6" name="area_6" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="load_6" name="load_6" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="com_6" name="com_6" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
												
												</div>
											</div>
										</div>
										
										</div>
										
					  </div>
					<br>
						<div class="row">
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="sp_3" name="sp_3" readonly>
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
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="test_date3" name="test_date3" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="day_3" name="day_3" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="l7" name="l7
													" >
												</div>
											</div>
										</div> 
										</div> 
									<div class="col-md-6">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="b7" name="b7" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="h7" name="h7" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="area_7" name="area_7" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="load_7" name="load_7" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="com_7" name="com_7" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="avg_com_3" name="avg_com_3" >
												</div>
												
											</div>
										</div>
										
										</div>
										
					  </div>
					 	  <br>
						  <div class="row">
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
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
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="l8" name="l8
													" >
												</div>
											</div>
										</div> 
										</div> 
									<div class="col-md-6">
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="b8" name="b8" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="h8" name="h8" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="area_8" name="area_8" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="load_8" name="load_8" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="com_8" name="com_8" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">													
												<label for="chk_chk3">For 28 Days</label>
													<input type="checkbox" class="visually-hidden" name="chk_chk3"  id="chk_chk3" value="chk_chk3"><br>
												</div>
												
											</div>
										</div>
										
										</div>
										
					  </div>
					<br>
					 
						  <div class="row">
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													
												</div>
											</div>
										</div>
										<div class="col-lg-3">
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
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="l9" name="l9
													" >
												</div>
											</div>
										</div> 
										</div> 
									<div class="col-md-6">
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="b9" name="b9" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="h9" name="h9" >
												</div>
											</div>
										</div>
										<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="area_9" name="area_9" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="load_9" name="load_9" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="com_9" name="com_9" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
												
												</div>
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
			else if($r1['test_code']=="che")
			{
				$test_check.="che,";
			?>
			<div class="panel panel-default" id="che">
      <div class="panel-heading" id="chemi">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
			<h4 class="panel-title">
			<b>CHEMICAL PROPERTIES</b>
			</h4>
		</a>
		</h4>
      </div>
      <div id="collapse8" class="panel-collapse collapse">
				<div class="panel-body">
								<div class="row">									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_che">8.</label>
													<input type="checkbox" class="visually-hidden" name="chk_che"  id="chk_che" value="chk_che"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CHEMICAL PROPERTIES</label>
										</div>
									</div>																
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-4 control-label label-right">1. CaO</label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cao1" name="cao1" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">2. Weight of Empty Crucible (W1), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cao2" name="cao2" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">3. Weight of Crucible after Ignition (W2), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cao3" name="cao3" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">4. R = (W2 - W1 / W) X 100</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cao4" name="cao4" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>	
								<hr>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">2. Sulphuric Anhydride, SO<sub>3</sub></label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="so1" name="so1" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">2. Weight of Empty Crucible (W1), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="so2" name="so2" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">3. Weight of Crucible after Ignition (W2), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="so3" name="so3" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">4. R = (W2 - W1 / W) X 34.3</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="so4" name="so4" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>	
								<hr>
								<br>
								
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">3.   R<sub>2</sub>O<sub>3</sub></label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="r2o1" name="r2o1" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">2. Weight of Empty Crucible (W1), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="r2o2" name="r2o2" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">3. Weight of Crucible after Ignition (W2), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="r2o3" name="r2o3" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">4. Weight of Crucible after HF(W3) , gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="r2o4" name="r2o4" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">5. R1(BEFORE HF) = ((W2 - W1) / W) x 100</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="r2o5" name="r2o5" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">6. R2(AFTER HF R<sub>2</sub>O<sub>3</sub>) = ((W2 - W3) / W) x 100</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="r2o6" name="r2o6" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">7. R = R1 - R2</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="r2o7" name="r2o7" >
												</div>
											</div>
										</div>
										 
									</div> 
									
									
								</div>	
								
								
								<hr>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">4. Silica, SiO<sub>2</sub></label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sio1" name="sio1" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">2. Weight of Empty Crucible (W1), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sio2" name="sio2" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">3. Weight of Crucible after Ignition (W2), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sio3" name="sio3" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">4. Weight of Crucible after HF(W3) , gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sio4" name="sio4" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">5. R1(BEFORE HF Sio<sub>2</sub>) = ((W2 - W1) / W) x 100</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sio5" name="sio5" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">6. R2(AFTER HF Sio<sub>2</sub>) = ((W2 - W3) / W) x 100</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sio6" name="sio6" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">7. R = R1 - R2</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sior7" name="sior7" >
												</div>
											</div>
										</div>
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">8. Sio<sub>2</sub>(PURE SILICA)= (SILICA AFTER HF) + R2(FROM R<sub>2</sub>O<sub>3</sub>)</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="sio7" name="sio7" >
												</div>
											</div>
										</div>
									</div> 
									
									
								</div>	
								<hr>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">5. Iron Oxide, Fe<sub>2</sub>O<sub>3</sub></label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="feo1" name="feo1" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">2. Titrant (V), ml</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="feo2" name="feo2" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">4. R = 0.7985 x V / W</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="feo3" name="feo3" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>	
								<hr>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">6. Alumina, Aluminum Oxide Al<sub>2</sub>O<sub>3</sub></label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>								
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. Al<sub>2</sub>O<sub>3</sub> = R<sub>2</sub>O<sub>3</sub> - Fe<sub>2</sub>O<sub>3</sub></label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="alo1" name="alo1" >
												</div>
											</div>
										</div>
										 
									</div> 
									
									
								</div>
								<hr>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">7. Ratio Percentage of Lime to Percentage of Silica, Alumina And Iron Oxide</label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>								
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. (SiO<sub>2</sub> +  Al<sub>2</sub>O<sub>3</sub> + Fe<sub>2</sub>O<sub>3</sub>)</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="per1" name="per1" >
												</div>
											</div>
										</div>
										 
									</div> 
									
									
								</div>
								
								<hr>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<!-- <label for="inputEmail3" class="col-sm-12 control-label label-right">8. Insoluble Residue</label> -->
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<!-- <label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label> -->
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="res1" name="res1" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<!-- <label for="inputEmail3" class="col-sm-12 control-label label-right">2. Weight of Empty Crucible (W1), gm</label> -->
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="res2" name="res2" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<!-- <label for="inputEmail3" class="col-sm-12 control-label label-right">3. Weight of Crucible after Ignition (W2), gm</label> -->
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="res3" name="res3" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<!-- <label for="inputEmail3" class="col-sm-12 control-label label-right">4. R = (W2 - W1 / W) X 100</label> -->
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="res4" name="res4" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>	
								<hr>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">7. Magnesia, MgO</label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mgo1" name="mgo1" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">2. Weight of Empty Crucible (W1), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mgo2" name="mgo2" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">3. Weight of Crucible after Ignition (W2), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mgo3" name="mgo3" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">4. R = (W2 - W1 / W) X 36.22</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="mgo4" name="mgo4" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>	
								<hr>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">8. Loss on Ignition</label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ig1" name="ig1" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">2. Weight of Empty Crucible (W1), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ig2" name="ig2" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">3. Weight of Crucible + Sample (W2), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="igw2" name="igw2" >
												</div>
											</div>
										</div>
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">3. Weight of Crucible after Ignition (W3), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ig3" name="ig3" >
												</div>
											</div>
										</div>
									</div> 
									
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">4. R = (W2 - W3 / W) X 100</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="ig4" name="ig4" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<hr>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">9. Chloride, Cl</label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cl1" name="cl1" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">2. Titrant used for Sample (X), ml</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cl2" name="cl2" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">3. Titrant used for Blank (Y), ml</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cl3" name="cl3" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">4. Z = [10-(X-Y)]</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cl4" name="cl4" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">5. N = Normality of AgNo<sub>3</sub></label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cl5" name="cl5" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">6. R = (Z x 0.03546 x N x 100) / W</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="cl6" name="cl6" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>	
								<hr>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">10. Alkali Content, Na<sub>2</sub>O</label>
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="alk1" name="alk1" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<label for="inputEmail3" class="col-sm-12 control-label label-right">Alkali Content Na<sub>2</sub>O Equivalent %</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-4">
													<input type="text" class="form-control" id="alk2" name="alk2" >
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="alk3" name="alk3" >
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="alk4" name="alk4" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<hr>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<!-- <label for="inputEmail3" class="col-sm-12 control-label label-right">10. Alkali Content, K<sub>2</sub>O</label> -->
												</div>
											</div>
										</div>
										
										 
									</div> 																		
								</div>
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<!-- <label for="inputEmail3" class="col-sm-12 control-label label-right">1. Weight of Sample (W), gm</label> -->
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="alk5" name="alk5" >
												</div>
											</div>
										</div>
										 
									</div> 
									<div class="col-md-6">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-12">
													<!-- <label for="inputEmail3" class="col-sm-12 control-label label-right">Alkali Content K<sub>2</sub>O Equivalent %</label> -->
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<div class="col-sm-4">
													<input type="hidden" class="form-control" id="alk6" name="alk6" >
												</div>
												<div class="col-sm-4">
													<input type="hidden" class="form-control" id="alk7" name="alk7" >
												</div>
												<div class="col-sm-4">
													<input type="hidden" class="form-control" id="alk8" name="alk8" >
												</div>
											</div>
										</div>
										 
									</div>
									
								</div>
								<hr>
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">1. SiO<sub>2</sub> + Al<sub>2</sub>O<sub>3</sub> + Fe<sub>2</sub>O<sub>3</sub> %</label>
											</div>
										</div>
										
									</div>			
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="com_test_method" name="com_test_method" Value="<?php echo $com_test_method;?>">
												<input type="hidden" class="form-control" id="com_test_id" name="com_test_id" Value="<?php echo $r1["test"];?>">
												<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
												<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="com_test_req" name="com_test_req" Value="<?php echo $com_test_req;?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="com_test_limit_1" name="com_test_limit_1" Value="<?php echo $com_test_limit_1;?>">
												<input type="text" class="form-control" id="com_test_limit_2" name="com_test_limit_2" Value="<?php echo $com_test_limit_2;?>">
												
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-12">
											<div class="form-group">
												<!-- <button type="button" class="btn btn-info pull-right" onclick="saveIs('update_che','<?php// echo $r1["test"];?>','<?php //echo $r1["material_category"];?>','<?php //echo $r1["material_id"];?>')" name="btn_update_is" id="btn_update_is" tabindex="14" >Update IS</button> -->
											</div>
										</div>
										
									</div>
												
												
								</div>
								
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">2. Silicon Dioxide as SiO<sub>2</sub> %</label>
											</div>
										</div>
										
									</div>			
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="sio_test_method" name="sio_test_method" Value="<?php echo $sio_test_method;?>">
												<input type="hidden" class="form-control" id="sio_test_id" name="sio_test_id" Value="<?php echo $r1["test"];?>">
												<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
												<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="sio_test_req" name="sio_test_req" Value="<?php echo $sio_test_req;?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="sio_test_limit_1" name="sio_test_limit_1" Value="<?php echo $sio_test_limit_1;?>">
												<input type="text" class="form-control" id="sio_test_limit_2" name="sio_test_limit_2" Value="<?php echo $sio_test_limit_2;?>">
												
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-12">
											<div class="form-group">
												
											</div>
										</div>
										
									</div>
												
												
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">3. Mangnesium oxide (Mgo) %</label>
											</div>
										</div>
										
									</div>			
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="mang_test_method" name="mang_test_method" Value="<?php echo $mang_test_method;?>">
												<input type="hidden" class="form-control" id="mang_test_id" name="mang_test_id" Value="<?php echo $r1["test"];?>">
												<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
												<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="mang_test_req" name="mang_test_req" Value="<?php echo $mang_test_req;?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="mang_test_limit_1" name="mang_test_limit_1" Value="<?php echo $mang_test_limit_1;?>">
												<input type="text" class="form-control" id="mang_test_limit_2" name="mang_test_limit_2" Value="<?php echo $mang_test_limit_2;?>">
												
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-12">
											<div class="form-group">
												
											</div>
										</div>
										
									</div>												
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">4. Total Sulphur as sulphur trioxide (SO<sub>3</sub>) %</label>
											</div>
										</div>
										
									</div>			
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="tot_test_method" name="tot_test_method" Value="<?php echo $tot_test_method;?>">
												<input type="hidden" class="form-control" id="tot_test_id" name="tot_test_id" Value="<?php echo $r1["test"];?>">
												<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
												<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="tot_test_req" name="tot_test_req" Value="<?php echo $tot_test_req;?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="tot_test_limit_1" name="tot_test_limit_1" Value="<?php echo $tot_test_limit_1;?>">
												<input type="text" class="form-control" id="tot_test_limit_2" name="tot_test_limit_2" Value="<?php echo $tot_test_limit_2;?>">
												
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-12">
											<div class="form-group">
												
											</div>
										</div>
										
									</div>												
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">5. Alkali's Content Na<sub>2</sub>O %</label>
											</div>
										</div>
										
									</div>			
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="alk_test_method" name="alk_test_method" Value="<?php echo $alk_test_method;?>">
												<input type="hidden" class="form-control" id="alk_test_id" name="alk_test_id" Value="<?php echo $r1["test"];?>">
												<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
												<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="alk_test_req" name="alk_test_req" Value="<?php echo $alk_test_req;?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="alk_test_limit_1" name="alk_test_limit_1" Value="<?php echo $alk_test_limit_1;?>">
												<input type="text" class="form-control" id="alk_test_limit_2" name="alk_test_limit_2" Value="<?php echo $alk_test_limit_2;?>">
												
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-12">
											<div class="form-group">
												
											</div>
										</div>
										
									</div>												
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">6. Total Chlorides %</label>
											</div>
										</div>
										
									</div>			
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="chl_test_method" name="chl_test_method" Value="<?php echo $chl_test_method;?>">
												<input type="hidden" class="form-control" id="chl_test_id" name="chl_test_id" Value="<?php echo $r1["test"];?>">
												<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
												<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="chl_test_req" name="chl_test_req" Value="<?php echo $chl_test_req;?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="chl_test_limit_1" name="chl_test_limit_1" Value="<?php echo $chl_test_limit_1;?>">
												<input type="text" class="form-control" id="chl_test_limit_2" name="chl_test_limit_2" Value="<?php echo $chl_test_limit_2;?>">
												
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-12">
											<div class="form-group">
												
											</div>
										</div>
										
									</div>												
								</div>
								<br>
								<div class="row">									
									<div class="col-lg-4">
										<div class="col-md-12">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">7. Total loss on Ignition %</label>
											</div>
										</div>
										
									</div>			
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Test Method</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="los_test_method" name="los_test_method" Value="<?php echo $los_test_method;?>">
												<input type="hidden" class="form-control" id="los_test_id" name="los_test_id" Value="<?php echo $r1["test"];?>">
												<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"];?>">
												<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"];?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Requirement IS</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="los_test_req" name="los_test_req" Value="<?php echo $los_test_req;?>">
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-12 control-label">Limit</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<input type="text" class="form-control" id="los_test_limit_1" name="los_test_limit_1" Value="<?php echo $los_test_limit_1;?>">
												<input type="text" class="form-control" id="los_test_limit_2" name="los_test_limit_2" Value="<?php echo $los_test_limit_2;?>">
												
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="col-md-12">
											<div class="form-group">
												
											</div>
										</div>
										
									</div>												
								</div>
								
								
								
								<br>
							</div>
			</div>
				
			<?php
			}
			else if($r1['test_code']=="fbs")
			{
				$test_check.="fbs,";
			?>
			<div class="panel panel-default" id="fbs">
      <div class="panel-heading" id="txtfbs">
	  <h4 class="panel-title">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse31">
			<h4 class="panel-title">
			<b>FINENESS BY DRY SIEVING</b>
			</h4>
		</a>
		</h4>
      </div>
      <div id="collapse31" class="panel-collapse collapse">
				<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-1">
													<label for="chk_fbs">6.</label>
													<input type="checkbox" class="visually-hidden" name="chk_fbs"  id="chk_fbs" value="chk_fbs"><br>
												</div>
											<label for="inputEmail3" class="col-sm-4 control-label label-right">FINENESS BY DRY SIEVING</label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<div class="col-sm-12">
												<!--<label for="inputEmail3" class="col-sm-12 control-label">Date of test :</label>-->
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
												<label for="inputEmail3" class="col-sm-12 control-label">Temp. (&#8451;):</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="fbs_temp" name="fbs_temp" >
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
													<input type="text" class="form-control" id="fbs_humidity" name="fbs_humidity" >
												</div>
											</div>
									</div>
								</div>
								<br>
								
								<div class="row">
									
									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Weight of Cement, gm</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">90 Micron Retained Weight, gm</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">Percentage</label>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-2 control-label">Average (%)</label>
											</div>
										</div>
									</div>
								</div>
								</br>
								<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="fbs_w1" name="fbs_w1" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="fbs_m1" name="fbs_m1" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="fbs_p1" name="fbs_p1" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="avg_fbs" name="avg_fbs
													" >
												</div>
											</div>
										</div>
								</div>
								<br>
									<div class="row">
									
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="fbs_w2" name="fbs_w2" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="fbs_m2" name="fbs_m2" >
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="fbs_p2" name="fbs_p2" readonly>
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
							 $query = "select * from flyash_chemical WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	$('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });
 $('#con_date_test').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	$('#report_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
	$('.datess').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
	$('#chk_con').change(function(){
        if(this.checked)
		{
			$('#consis').css("background-color","#3CAF35");	
		}
		else
		{
			$('#consis').css("background-color","white");	
		}
		
	});
	$('#chk_sou').change(function(){
        if(this.checked)
		{
			$('#sound').css("background-color","#3CAF35");	
		}
		else
		{
			$('#sound').css("background-color","white");	
		}
		
	});
	$('#chk_set').change(function(){
        if(this.checked)
		{
			$('#sett').css("background-color","#3CAF35");	
		}
		else
		{
			$('#sett').css("background-color","white");	
		}
		
	});
	$('#chk_den').change(function(){
        if(this.checked)
		{
			$('#dens').css("background-color","#3CAF35");	
		}
		else
		{
			$('#dens').css("background-color","white");	
		}
		
	});
	$('#chk_fines').change(function(){
        if(this.checked)
		{
			$('#fins').css("background-color","#3CAF35");	
		}
		else
		{
			$('#fins').css("background-color","white");	
		}
		
	});
	$('#chk_com').change(function(){
        if(this.checked)
		{
			
			$('#comp').css("background-color","#3CAF35");	
		}
		else
		{
			$('#comp').css("background-color","white");	
		}
		
	});
	$('#chk_che').change(function(){
        if(this.checked)
		{
			$('#chemi').css("background-color","#3CAF35");	
		}
		else
		{
			$('#chemi').css("background-color","white");	
		}
		
	});
	
	$('#chk_fbs').change(function(){
        if(this.checked)
		{
			$('#txtfbs').css("background-color","#3CAF35");	
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
		
			var top = 3;
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
			document.getElementById('day_1').value = top;		
			
		});
	
	$('#caste_date2').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    }).on("change", function() {
		
			var top = 7;
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
			document.getElementById('day_2').value = top;		
			
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
			document.getElementById('day_3').value = top;					
			
		});
 


  $(function () {
    $('.select2').select2();
  })
$(document).ready(function(){ 
	
	$('#btn_edit_data').hide();
	$('#alert').hide();
    	
	
	var report_date;
	var con_date_test;
	var con_temp;
	var con_humidity;
	var con_weight;
	var vol_1;
	var vol_2;
	var vol_3;
	var vol_4;
	var vol_5;
	var vol_6;
	var vol_7;
	var wtr_1;
	var wtr_2;
	var wtr_3;
	var wtr_4;
	var wtr_5;
	var wtr_6;
	var wtr_7;
	var reading_1;
	var reading_2;
	var reading_3;
	var reading_4;
	var reading_5;
	var reading_6;
	var reading_7;
	var remark_1;
	var remark_2;
	var remark_3;
	var remark_4;
	var remark_5;
	var remark_6;
	var remark_7;
	var final_consistency;
	
	function consistency_auto()
	{
		$('#consis').css("background-color","#3CAF35");	
			con_temp = randomNumberFromRange(26.0,28.0);
			$('#con_temp').val(con_temp.toFixed(1));
			con_date_test = $('#rec_sample_date').val();
			$('#con_date_test').val(con_date_test);
			con_humidity = randomNumberFromRange(65.0,68.0);
			$('#con_humidity').val(con_humidity.toFixed(1));
			con_weight = 400;
			$('#con_weight').val(con_weight.toFixed());
			
			var t = randomNumberFromRange(1,50);
			if(t%2==0)
			{	

				var grades = $('#cement_grade').val();			
				if(grades=="53 OPC")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);		
				}
				else if (grades=="43 OPC")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);			
				}
				else if (grades=="33 OPC")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);			
				}
				else if (grades=="33_grade")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);			
				}
				else if (grades=="flyash_type" || grades=="calcimed_clay_type")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);			
				}
				else if (grades=="OPC - 43 S")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);			
				}
				else if (grades=="OPC - 53 S")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);				
				}
				else if (grades=="PORTLAND SLAG")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);				
				}
				var ab = parseInt(items.length) - 1;
				
				randomNumber = rand(0, ab);
				
				randomItem = items[randomNumber];		
				 final_consistency = randomItem;
				$('#final_consistency').val(final_consistency);
				wtr_4 = final_consistency;
				reading_4 = randomNumberFromRange(5.00, 6.00);
				var wt = $('#con_weight').val();
				vol_4 = ((+wtr_4) * (+wt))/100;
				$('#vol_4').val(vol_4.toFixed(0));
				$('#reading_4').val(reading_4.toFixed(0));
				$('#wtr_4').val(wtr_4.toFixed(1));
				
				
				wtr_1 = (+wtr_4) - (+1.5);
				wtr_3 = (+wtr_4) - (+1.0);
				wtr_2 = (+wtr_4) - (+0.5);
				$('#wtr_3').val(wtr_3.toFixed(1));
				$('#wtr_2').val(wtr_2.toFixed(1));
				$('#wtr_1').val(wtr_1.toFixed(1));
				
				var wtr1 = $('#wtr_1').val();
				var wtr2 = $('#wtr_2').val();
				var wtr3 = $('#wtr_3').val();
				
				reading_1 = randomNumberFromRange(11.00, 12.00);
				reading_2 = randomNumberFromRange(9.00, 10.00);
				reading_3 = randomNumberFromRange(7.00, 8.00);
				
				vol_3 = ((+wtr3) * (+wt))/100;
				vol_1 = ((+wtr1) * (+wt))/100;
				vol_2 = ((+wtr2) * (+wt))/100;
				
				$('#vol_3').val(vol_3.toFixed(0));
				$('#vol_2').val(vol_2.toFixed(0));
				$('#vol_1').val(vol_1.toFixed(0));
				$('#reading_3').val(reading_3.toFixed(0));			
				$('#reading_2').val(reading_2.toFixed(0));				
				$('#reading_1').val(reading_1.toFixed(0));
				
			}
			else
			{
				
				var grades = $('#cement_grade').val();			
				if(grades=="53 OPC")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);		
				}
				else if (grades=="43 OPC")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);			
				}
				else if (grades=="33 OPC")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);			
				}
				else if (grades=="33_grade")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);			
				}
				else if (grades=="flyash_type" || grades=="calcimed_clay_type")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);			
				}
				else if (grades=="OPC - 43 S")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);			
				}
				else if (grades=="OPC - 53 S")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);				
				}
				else if (grades=="PORTLAND SLAG")
				{
					var items = Array(28.3,28.5,28.8,29.0,29.3,29.5,29.8,30.0,30.3,30.5,30.8,31.0,31.3,31.5,31.8,32.0,32.3,32.5,32.8,33.0);				
				}
			
				var abss = parseInt(items.length) - 1; 
				randomNumber = rand(0, abss);
				randomItem = items[randomNumber];		
				 final_consistency = randomItem;
				$('#final_consistency').val(final_consistency);
				wtr_4 = final_consistency;
				reading_4 = randomNumberFromRange(5.00, 7.00);
				var wt = $('#con_weight').val();
				vol_4 = ((+wtr_4) * (+wt))/100;
				$('#vol_4').val(vol_4.toFixed(0));
				$('#reading_4').val(reading_4.toFixed(0));
				$('#wtr_4').val(wtr_4.toFixed(1));
				
				
				wtr_1 = (+wtr_4) - (+1.5);
				wtr_2 = (+wtr_4) - (+1.0);
				wtr_3 = (+wtr_4) - (+0.5);
				
				$('#wtr_3').val(wtr_3.toFixed(1));
				$('#wtr_2').val(wtr_2.toFixed(1));
				$('#wtr_1').val(wtr_1.toFixed(1));
				
				var wtr1 = $('#wtr_1').val();
				var wtr2 = $('#wtr_2').val();
				var wtr3 = $('#wtr_3').val();
				
				reading_1 = randomNumberFromRange(13.00, 15.00);
				reading_2 = randomNumberFromRange(10.00, 12.00);
				reading_3 = randomNumberFromRange(8.00, 9.00);
				
				vol_3 = ((+wtr3) * (+wt))/100;
				vol_1 = ((+wtr1) * (+wt))/100;
				vol_2 = ((+wtr2) * (+wt))/100;
				
				$('#vol_3').val(vol_3.toFixed(0));
				$('#vol_2').val(vol_2.toFixed(0));
				$('#vol_1').val(vol_1.toFixed(0));
				$('#reading_3').val(reading_3.toFixed(0));			
				$('#reading_2').val(reading_2.toFixed(0));				
				$('#reading_1').val(reading_1.toFixed(0));
				
			}
			
	}
	
	
	//CHECK CONSISTENCY
	$('#chk_con').change(function(){
        if(this.checked)
		{  
			consistency_auto();
		}
		else
		{
			$('#consis').css("background-color","white");	
			$('#con_temp').val(null);
			$('#con_date_test').val(null);
			$('#con_humidity').val(null);
			$('#con_weight').val(null);
			$('#final_consistency').val(null);
			$('#vol_3').val(null);
			$('#reading_3').val(null);
			$('#wtr_3').val(null);
			$('#vol_2').val(null);
			$('#reading_2').val(null);
			$('#wtr_2').val(null);
			$('#vol_1').val(null);
			$('#reading_1').val(null);
			$('#wtr_1').val(null);
			$('#vol_4').val(null);
			$('#reading_4').val(null);
			$('#wtr_4').val(null);
			
		}
	});
	

	
	$('#final_consistency').change(function(){
		$('#consis').css("background-color","#3CAF35");	
		if ($("#chk_con").is(':checked')) {
					
					con_weight = $('#con_weight').val();			
					var t = randomNumberFromRange(1,50);
						if(t%2==0)
						{			
								
							final_consistency = $('#final_consistency').val();		
										
							wtr_4 = final_consistency;
							reading_4 = randomNumberFromRange(5.00, 7.00);
							vol_4 = ((+wtr_4) * (+con_weight))/100;
							$('#vol_4').val(vol_4.toFixed(0));
							$('#reading_4').val(reading_4.toFixed(0));
							$('#wtr_4').val(wtr_4.toFixed(1));
							var wtr4 = $('#wtr_4').val();
							if(final_consistency=="28.0" || final_consistency=="28.5")
							{
								wtr_1 = (+wtr4) + (+1.5);
								wtr_3 = (+wtr4) + (+1.0);
								wtr_2 = (+wtr4) + (+0.5);
								$('#wtr_3').val(wtr_3.toFixed(1));
								$('#wtr_2').val(wtr_2.toFixed(1));
								$('#wtr_1').val(wtr_1.toFixed(1));
								
								var wtr1 = $('#wtr_1').val();
								var wtr2 = $('#wtr_2').val();
								var wtr3 = $('#wtr_3').val();
								reading_1 = randomNumberFromRange(13.00, 15.00);
								reading_2 = randomNumberFromRange(10.00, 12.00);
								reading_3 = randomNumberFromRange(8.00, 9.00);
								
								vol_3 = ((+wtr3) * (+con_weight))/100;
								vol_1 = ((+wtr1) * (+con_weight))/100;
								vol_2 = ((+wtr2) * (+con_weight))/100;
								$('#vol_3').val(vol_3.toFixed(0));
								$('#reading_3').val(reading_3.toFixed(0));
								$('#vol_2').val(vol_2.toFixed(0));
								$('#reading_2').val(reading_2.toFixed(0));
								$('#vol_1').val(vol_1.toFixed(0));
								$('#reading_1').val(reading_1.toFixed(0));
							}
							else
							{
								
									wtr_1 = parseFloat(wtr_4) - 1.5;
									wtr_3 = parseFloat(wtr_4) - 1.0;
									wtr_2 = parseFloat(wtr_4) - 0.5;
									$('#wtr_3').val(wtr_3.toFixed(1));
									$('#wtr_2').val(wtr_2.toFixed(1));
									$('#wtr_1').val(wtr_1.toFixed(1));
									
									var wtr1 = $('#wtr_1').val();
									var wtr2 = $('#wtr_2').val();
									var wtr3 = $('#wtr_3').val();
									reading_1 = randomNumberFromRange(13.00, 15.00);
									reading_2 = randomNumberFromRange(10.00, 12.00);
									reading_3 = randomNumberFromRange(8.00, 9.00);
									
									vol_3 = ((+wtr3) * (+con_weight))/100;
									vol_1 = ((+wtr1) * (+con_weight))/100;
									vol_2 = ((+wtr2) * (+con_weight))/100;
									$('#vol_3').val(vol_3.toFixed(0));
									$('#reading_3').val(reading_3.toFixed(0));
									$('#vol_2').val(vol_2.toFixed(0));
									$('#reading_2').val(reading_2.toFixed(0));
									$('#vol_1').val(vol_1.toFixed(0));
									$('#reading_1').val(reading_1.toFixed(0));
								
							}
							
						}
						else
						{
							final_consistency = $('#final_consistency').val();	
											
							wtr_4 = parseFloat(final_consistency);
							reading_4 = randomNumberFromRange(5.00, 7.00);
							vol_4 = (parseFloat(wtr_4) * parseFloat(con_weight))/100;
							$('#vol_4').val(vol_4.toFixed(0));
							$('#reading_4').val(reading_4.toFixed(0));
							$('#wtr_4').val(wtr_4.toFixed(1));
							var wtr4 = $('#wtr_4').val();
							if(final_consistency=="28.0" || final_consistency=="28.5" || final_consistency=="28.3")
							{
									
									wtr_1 = (+wtr4) + (+1.5);
									wtr_2 = (+wtr4) + (+1.0);
									wtr_3 = (+wtr4) + (+0.5);
									$('#wtr_3').val(wtr_3.toFixed(1));
									$('#wtr_2').val(wtr_2.toFixed(1));
									$('#wtr_1').val(wtr_1.toFixed(1));
									var wtr1 = $('#wtr_1').val();
									var wtr2 = $('#wtr_2').val();
									var wtr3 = $('#wtr_3').val();
									reading_1 = randomNumberFromRange(13.00, 15.00);
									reading_2 = randomNumberFromRange(10.00, 12.00);
									reading_3 = randomNumberFromRange(8.00, 9.00);
									
									vol_3 = ((+wtr3) * (+con_weight))/100;
									vol_1 = ((+wtr1) * (+con_weight))/100;
									vol_2 = ((+wtr2) * (+con_weight))/100;
									$('#vol_3').val(vol_3.toFixed(0));
									$('#reading_3').val(reading_3.toFixed(0));
									$('#vol_2').val(vol_2.toFixed(0));
									$('#reading_2').val(reading_2.toFixed(0));
									$('#vol_1').val(vol_1.toFixed(0));
									$('#reading_1').val(reading_1.toFixed(0));
							
							
							
							}
							else
							{
									wtr_1 = (+wtr4) - (+1.5);
									wtr_2 = (+wtr4) - (+1.0);
									wtr_3 = (+wtr4) - (+0.5);
									$('#wtr_3').val(wtr_3.toFixed(1));
									$('#wtr_2').val(wtr_2.toFixed(1));
									$('#wtr_1').val(wtr_1.toFixed(1));
									var wtr1 = $('#wtr_1').val();
									var wtr2 = $('#wtr_2').val();
									var wtr3 = $('#wtr_3').val();
									reading_1 = randomNumberFromRange(13.00, 15.00);
									reading_2 = randomNumberFromRange(10.00, 12.00);
									reading_3 = randomNumberFromRange(8.00, 9.00);
									
									vol_3 = ((+wtr3) * (+con_weight))/100;
									vol_1 = ((+wtr1) * (+con_weight))/100;
									vol_2 = ((+wtr2) * (+con_weight))/100;
									$('#vol_3').val(vol_3.toFixed(0));
									$('#reading_3').val(reading_3.toFixed(0));
									$('#vol_2').val(vol_2.toFixed(0));
									$('#reading_2').val(reading_2.toFixed(0));
									$('#vol_1').val(vol_1.toFixed(0));
									$('#reading_1').val(reading_1.toFixed(0));
							}
							
						}
	
					
					
			}
			else
			{
				$(this).val("");
				$( "#vol_1" ).focus();
			}
		
		});
	
	$('#vol_1').change(function(){
				$('#consis').css("background-color","#3CAF35");	
				con_weight = $('#con_weight').val();
				vol_1 = $('#vol_1').val();
				wtr_1 = ((+vol_1)* 100)/(+con_weight);
				$('#wtr_1').val(wtr_1.toFixed(1));
				$('#final_consistency').val(wtr_1.toFixed(1));
				$('#consis').css("background-color","#3CAF35");	
				
	});
	$('#vol_2').change(function(){
				$('#consis').css("background-color","#3CAF35");	
				con_weight = $('#con_weight').val();
				vol_2 = $('#vol_2').val();
				wtr_2 = ((+vol_2)* 100)/(+con_weight);
				$('#wtr_2').val(wtr_2.toFixed(1));
				$('#final_consistency').val(wtr_2.toFixed(1));
				$('#consis').css("background-color","#3CAF35");	
				
	});
	$('#vol_3').change(function(){
				$('#consis').css("background-color","#3CAF35");	
				con_weight = $('#con_weight').val();
				vol_3 = $('#vol_3').val();
				wtr_3 = ((+vol_3)* 100)/(+con_weight);
				$('#wtr_3').val(wtr_3.toFixed(1));
				$('#final_consistency').val(wtr_3.toFixed(1));
				$('#consis').css("background-color","#3CAF35");	
				
	});
	$('#vol_4').change(function(){
				$('#consis').css("background-color","#3CAF35");	
				con_weight = $('#con_weight').val();
				vol_4 = $('#vol_4').val();
				wtr_4 = ((+vol_4)* 100)/(+con_weight);
				$('#wtr_4').val(wtr_4.toFixed(1));
				$('#final_consistency').val(wtr_4.toFixed(1));
				$('#consis').css("background-color","#3CAF35");	
				
	});
	$('#vol_5').change(function(){
				$('#consis').css("background-color","#3CAF35");	
				con_weight = $('#con_weight').val();
				vol_5 = $('#vol_5').val();
				wtr_5 = ((+vol_5)* 100)/(+con_weight);
				$('#wtr_5').val(wtr_5.toFixed(1));
				$('#final_consistency').val(wtr_5.toFixed(1));
				$('#consis').css("background-color","#3CAF35");	
				
	});
	
	
	$('#con_weight').change(function(){
				
				/*con_weight = $('#con_weight').val();
				wtr_1 = $('#wtr_1').val();
				wtr_2 = $('#wtr_2').val();
				wtr_3 = $('#wtr_3').val();
				wtr_4 = $('#wtr_4').val();
				
				vol_1 = (parseFloat(wtr_1) * parseFloat(con_weight))/100;
				vol_2 = (parseFloat(wtr_2) * parseFloat(con_weight))/100;
				vol_3 = (parseFloat(wtr_3) * parseFloat(con_weight))/100;
				vol_4 = (parseFloat(wtr_4) * parseFloat(con_weight))/100;				
				$('#vol_1').val(vol_1.toFixed(0));
				$('#vol_2').val(vol_2.toFixed(0));
				$('#vol_3').val(vol_3.toFixed(0));
				$('#vol_4').val(vol_4.toFixed(0));*/
				$('#consis').css("background-color","#3CAF35");	
	});
	
	
	var fbs_temp;
	var fbs_humidity;
	var fbs_w1;
	var fbs_w2;
	var fbs_m1;
	var fbs_m2;
	var fbs_p1;
	var fbs_p2;
	var avg_fbs;
	
	function fbs_auto()
	{
		  $('#txtfbs').css("background-color","#3CAF35");	
			fbs_temp = randomNumberFromRange(26.0,28.0);
			$('#fbs_temp').val(fbs_temp.toFixed(1));
			fbs_humidity = randomNumberFromRange(65.0,69.0); 
			$('#fbs_humidity').val(fbs_humidity.toFixed(1));
			
			fbsw1 = randomNumberFromRange(9.95,10.05).toFixed(2);
			fbsw2 = randomNumberFromRange(9.95,10.05).toFixed(2);
			$('#fbs_w1').val(fbsw1);
			$('#fbs_w2').val(fbsw2);
			var fbs_w1 = $('#fbs_w1').val();
			var fbs_w2 = $('#fbs_w2').val();
			var avgfbs = randomNumberFromRange(1.10,1.50).toFixed(1);
			$('#avg_fbs').val(avgfbs);
			var avg_fbs = $('#avg_fbs').val();
			
			fbsp1 = (+avg_fbs) + randomNumberFromRange(-0.10,0.10);
			$('#fbs_p1').val(fbsp1.toFixed(2));
			var fbs_p1 = $('#fbs_p1').val();
			fbsp2 = ((+avg_fbs)* (+2)) - (+fbsp1);
			$('#fbs_p2').val(fbsp2.toFixed(2));
			var fbs_p2 = $('#fbs_p2').val();
			
			var m1 = (+fbs_w1) * (+fbs_p1);
			var m2 = (+fbs_w2) * (+fbs_p2);
			 
			var ans1 = (+m1) / 100;
			var ans2 = (+m2) / 100;
			$('#fbs_m1').val(ans1.toFixed(2));
			$('#fbs_m2').val(ans2.toFixed(2));
			
			//SIDHU
			var f_bsw1 = $('#fbs_w1').val();
			var f_bsw2 = $('#fbs_w2').val();
			
			var f_bsm1 = $('#fbs_m1').val();
			var f_bsm2 = $('#fbs_m2').val();
			
			var cal1 = (+100) * (+f_bsm1);
			var cal2 = (+100) * (+f_bsm2);	
			
			var anss1 = (+cal1) / (+f_bsw1);
			var anss2 = (+cal2) / (+f_bsw2);
			
			$('#fbs_p1').val(anss1.toFixed(2));
			$('#fbs_p2').val(anss2.toFixed(2));
			
			var f_bsp1 = $('#fbs_p1').val();
			var f_bsp2 = $('#fbs_p2').val();
			
			var avg = ((+f_bsp1) + (+f_bsp2)) / 2;
			$('#avg_fbs').val(avg.toFixed(1));
			
	}
	
	$('#chk_fbs').change(function(){
        if(this.checked)
		{  
			fbs_auto();
		}
		else
		{
			$('#txtfbs').css("background-color","white");	
			$('#fbs_temp').val(null);			
			$('#fbs_humidity').val(null);
			$('#fbs_w1').val(null);
			$('#fbs_w2').val(null);
			$('#fbs_m1').val(null);
			$('#fbs_m2').val(null);
			$('#fbs_p1').val(null);
			$('#fbs_p2').val(null);
			$('#avg_fbs').val(null);
			
			
		}
	});
	
	$('#avg_fbs').change(function(){
		$('#txtfbs').css("background-color","#3CAF35");	
			fbs_temp = randomNumberFromRange(26.0,28.0);
			$('#fbs_temp').val(fbs_temp.toFixed(1));
			fbs_humidity = randomNumberFromRange(65.0,69.0); 
			$('#fbs_humidity').val(fbs_humidity.toFixed(1));
			
			fbsw1 = randomNumberFromRange(9.95,10.05).toFixed(2);
			fbsw2 = randomNumberFromRange(9.95,10.05).toFixed(2);
			$('#fbs_w1').val(fbsw1);
			$('#fbs_w2').val(fbsw2);
			var fbs_w1 = $('#fbs_w1').val();
			var fbs_w2 = $('#fbs_w2').val();			
			var avg_fbs = $('#avg_fbs').val();
			
			fbsp1 = (+avg_fbs) + randomNumberFromRange(-0.10,0.10);
			$('#fbs_p1').val(fbsp1.toFixed(2));
			var fbs_p1 = $('#fbs_p1').val();
			fbsp2 = ((+avg_fbs)* (+2)) - (+fbsp1);
			$('#fbs_p2').val(fbsp2.toFixed(2));
			var fbs_p2 = $('#fbs_p2').val();
			
			var m1 = (+fbs_w1) * (+fbs_p1);
			var m2 = (+fbs_w2) * (+fbs_p2);
			 
			var ans1 = (+m1) / 100;
			var ans2 = (+m2) / 100;
			$('#fbs_m1').val(ans1.toFixed(2));
			$('#fbs_m2').val(ans2.toFixed(2));
			
			//SIDHU
			var f_bsw1 = $('#fbs_w1').val();
			var f_bsw2 = $('#fbs_w2').val();
			
			var f_bsm1 = $('#fbs_m1').val();
			var f_bsm2 = $('#fbs_m2').val();
			
			var cal1 = (+100) * (+f_bsm1);
			var cal2 = (+100) * (+f_bsm2);	
			
			var anss1 = (+cal1) / (+f_bsw1);
			var anss2 = (+cal2) / (+f_bsw2);
			
			$('#fbs_p1').val(anss1.toFixed(2));
			$('#fbs_p2').val(anss2.toFixed(2));
			
			var f_bsp1 = $('#fbs_p1').val();
			var f_bsp2 = $('#fbs_p2').val();
			
			var avg = ((+f_bsp1) + (+f_bsp2)) / 2;
			$('#avg_fbs').val(avg.toFixed(1));
       
	});
	
	
	$('#fbs_w1,#fbs_w2,#fbs_m1,#fbs_m2').change(function(){
		var f_bsw1 = $('#fbs_w1').val();
		var f_bsw2 = $('#fbs_w2').val();
		
		var f_bsm1 = $('#fbs_m1').val();
		var f_bsm2 = $('#fbs_m2').val();
		
		var cal1 = (+100) * (+f_bsm1);
		var cal2 = (+100) * (+f_bsm2);	
		
		var anss1 = (+cal1) / (+f_bsw1);
		var anss2 = (+cal2) / (+f_bsw2);
		
		$('#fbs_p1').val(anss1.toFixed(2));
		$('#fbs_p2').val(anss2.toFixed(2));
		
		var f_bsp1 = $('#fbs_p1').val();
		var f_bsp2 = $('#fbs_p2').val();
		
		var avg = ((+f_bsp1) + (+f_bsp2)) / 2;
		$('#avg_fbs').val(avg.toFixed(1));
		
	});
	var sou_weight;
	var sou_water;
	var sou_temp;
	var sou_date_test;
	var sou_humidity;
	var dis_1_1;
	var dis_1_2;
	var dis_2_1;
	var dis_2_2;
	var diff_1;
	var diff_2;
	var soundness;
	
	function soundness_auto()
	{
		$('#sound').css("background-color","#3CAF35");	
			sou_temp = randomNumberFromRange(26.0,28.0);
			$('#sou_temp').val(sou_temp.toFixed(1));		
			var top = 2;
			//var date_input = document.getElementById("con_date_test").value.split('/');
			var date_input = $('#rec_sample_date').val().split('/');			
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
			document.getElementById('sou_date_test').value = someFormattedDate;	
			
			sou_humidity = randomNumberFromRange(65.0,69.0); 
			$('#sou_humidity').val(sou_humidity.toFixed(1));
			sou_weight = 200;
			$('#sou_weight').val(sou_weight.toFixed(2));
			
			var consis = $('#final_consistency').val();
			
			sou_water = (0.78 * parseFloat(consis))*2;
			$('#sou_water').val(sou_water.toFixed(1));
				
				
			var items1 = randomNumberFromRange(0.60,1.20).toFixed(2);			
			
			soundness = items1;
			$('#soundness').val(soundness);
			diff_1 = (+soundness) + randomNumberFromRange(-0.08,0.07);
			$('#diff_1').val(diff_1.toFixed(2));
			var diff1 = $('#diff_1').val();
			diff_2 = ((+soundness)* (+2)) - (+diff1);
			$('#diff_2').val(diff_2.toFixed(2));
			var diff2 = $('#diff_2').val();
			dis_2_1 = randomNumberFromRange(9.00, 12.00);
			dis_2_2 = randomNumberFromRange(9.00, 12.00);
			$('#dis_2_1').val(dis_2_1.toFixed(2));
			$('#dis_2_2').val(dis_2_2.toFixed(2));
			var dis_2_1 = $('#dis_2_1').val();
			var dis_2_2 = $('#dis_2_2').val();
			dis_1_1 = (+dis_2_1) - (+diff1);
			dis_1_2 = (+dis_2_2) - (+diff2);
			$('#dis_1_1').val(dis_1_1.toFixed(2));
			$('#dis_1_2').val(dis_1_2.toFixed(2));
	}
	
	
	$('#chk_sou').change(function(){
        if(this.checked)
		{  
			soundness_auto();
		}
		else
		{
			$('#sound').css("background-color","white");	
			$('#sou_temp').val(null);
			$('#sou_date_test').val(null);
			$('#sou_humidity').val(null);
			$('#sou_weight').val(null);
			$('#soundness').val(null);
			$('#sou_water').val(null);
			$('#diff_1').val(null);
			$('#diff_2').val(null);
			$('#dis_2_1').val(null);
			$('#dis_2_2').val(null);
			$('#dis_1_1').val(null);
			$('#dis_1_2').val(null);
			
		}
	});
	
	function sou_dis_2()
	{
		$('#sound').css("background-color","#3CAF35");	
		if ($("#chk_sou").is(':checked')) {
				soundness = $('#soundness').val();				
				diff_1 = (+soundness) + randomNumberFromRange(-0.08,0.07).toFixed(2);
				$('#diff_1').val(diff_1.toFixed(2));
				var diff1 = $('#diff_1').val();
				diff_2 = ((+soundness)* (+2)) - (+diff1);
				$('#diff_2').val(diff_2.toFixed(2));
				var diff2 = $('#diff_2').val();
				dis_2_1 = $('#dis_2_1').val();	
				dis_2_2 = $('#dis_2_2').val();					
				dis_1_1 = (+dis_2_1) - (+diff_1);
				dis_1_2 = (+dis_2_2) - (+diff_2);
				$('#dis_1_1').val(dis_1_1.toFixed(2));
				$('#dis_1_2').val(dis_1_2.toFixed(2));
		}
	}
	$('#soundness').change(function(){
		sou_dis_2();					
	});
	$('#dis_2_1').change(function(){
		$('#sound').css("background-color","#3CAF35");	
		
		dis_1_1 = $('#dis_1_1').val();	
		dis_1_2 = $('#dis_1_2').val();	
		dis_2_1 = $('#dis_2_1').val();	
		dis_2_2 = $('#dis_2_2').val();
		
		diff_1 = (+dis_2_1) - (+dis_1_1);
		diff_2 = (+dis_2_2) - (+dis_1_2);
		$('#diff_1').val(diff_1.toFixed(2));
		$('#diff_2').val(diff_2.toFixed(2));
		var diff1 = $('#diff_1').val();
		var diff2 = $('#diff_2').val();
		soundness = ((+diff_1)+(+diff_2))/2;
		$('#soundness').val(soundness.toFixed(2));	
				
	});
	$('#dis_2_2').change(function(){
		$('#sound').css("background-color","#3CAF35");	
		
		dis_1_1 = $('#dis_1_1').val();	
		dis_1_2 = $('#dis_1_2').val();	
		dis_2_1 = $('#dis_2_1').val();	
		dis_2_2 = $('#dis_2_2').val();
		
		diff_1 = (+dis_2_1) - (+dis_1_1);
		diff_2 = (+dis_2_2) - (+dis_1_2);
		$('#diff_1').val(diff_1.toFixed(2));
		$('#diff_2').val(diff_2.toFixed(2));
		var diff1 = $('#diff_1').val();
		var diff2 = $('#diff_2').val();
		soundness = ((+diff_1)+(+diff_2))/2;
		$('#soundness').val(soundness.toFixed(2));	
				
	});
	$('#dis_1_1').change(function(){
		$('#sound').css("background-color","#3CAF35");	
		
		dis_1_1 = $('#dis_1_1').val();	
		dis_1_2 = $('#dis_1_2').val();	
		dis_2_1 = $('#dis_2_1').val();	
		dis_2_2 = $('#dis_2_2').val();
		
		diff_1 = (+dis_2_1) - (+dis_1_1);
		diff_2 = (+dis_2_2) - (+dis_1_2);
		$('#diff_1').val(diff_1.toFixed(2));
		$('#diff_2').val(diff_2.toFixed(2));
		var diff1 = $('#diff_1').val();
		var diff2 = $('#diff_2').val();
		soundness = ((+diff_1)+(+diff_2))/2;
		$('#soundness').val(soundness.toFixed(2));	
		
		
	});
	
	$('#dis_1_2').change(function(){
		$('#sound').css("background-color","#3CAF35");	
		
		dis_1_1 = $('#dis_1_1').val();	
		dis_1_2 = $('#dis_1_2').val();	
		dis_2_1 = $('#dis_2_1').val();	
		dis_2_2 = $('#dis_2_2').val();
		
		diff_1 = (+dis_2_1) - (+dis_1_1);
		diff_2 = (+dis_2_2) - (+dis_1_2);
		$('#diff_1').val(diff_1.toFixed(2));
		$('#diff_2').val(diff_2.toFixed(2));
		var diff1 = $('#diff_1').val();
		var diff2 = $('#diff_2').val();
		soundness = ((+diff_1)+(+diff_2))/2;
		$('#soundness').val(soundness.toFixed(2));	
		
		
	});
	
	$('#sou_weight').change(function(){
		$('#sound').css("background-color","#3CAF35");	
		
		var consis = $('#final_consistency').val();
			
			sou_water = (0.78 * parseFloat(consis))*2;
			$('#sou_water').val(sou_water.toFixed(1));
			
		
		
	});
	
	function timeConvert(n) {
		var num = n;
		var hours = (num / 60);
		var rhours = Math.floor(hours);
		var minutes = (hours - rhours) * 60;
		var rminutes = Math.round(minutes);
		return rhours + ":" + rminutes +":00" ;
		}
	function addTimes (startTime, endTime) {
	  var times = [ 0, 0, 0 ]
	  var max = times.length

	  var a = (startTime || '').split(':')
	  var b = (endTime || '').split(':')

	  // normalize time values
	  for (var i = 0; i < max; i++) {
		a[i] = isNaN(parseInt(a[i])) ? 0 : parseInt(a[i])
		b[i] = isNaN(parseInt(b[i])) ? 0 : parseInt(b[i])
	  }

	  // store time values
	  for (var i = 0; i < max; i++) {
		times[i] = a[i] + b[i]
	  }

	  var hours = times[0]
	  var minutes = times[1]
	  var seconds = times[2]

	  if (seconds >= 60) {
		var m = (seconds / 60) << 0
		minutes += m
		seconds -= 60 * m
	  }

	  if (minutes >= 60) {
		var h = (minutes / 60) << 0
		hours += h
		minutes -= 60 * h
	  }

	  return ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);
}

	var set_temp;
	var set_date_test;
	var set_weight;
	var set_wtr;
	var set_humidity;
	var hr_a;
	var hr_b;
	var hr_c;
	var initial_time;
	var final_time;
	
	function set_auto()
	{
		$('#sett').css("background-color","#3CAF35");	
			set_temp = randomNumberFromRange(26.0,28.0);
			$('#set_temp').val(set_temp.toFixed(1));		
			var top = 1;
			//var date_input = document.getElementById("con_date_test").value.split('/');	
			var date_input = $('#rec_sample_date').val().split('/');				
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
			document.getElementById('set_date_test').value = someFormattedDate;	
			
			set_humidity = randomNumberFromRange(65.0,69.0);
			$('#set_humidity').val(set_humidity.toFixed(1));			
			
			var consis = $('#final_consistency').val();
			
			set_wtr = (0.85 * (+consis))*4;
			$('#set_wtr').val(set_wtr.toFixed(1));
			
			var grades = $('#cement_grade').val();			
				if(grades=="53 OPC")
				{
					initial_time = Array(110,115,120,125,130,135,140,145,150);
					var df = Array(60,65,70,75,80);
					var abss2 = parseInt(df.length) - 1;
					random1 = rand(0, abss2);
					items33 = df[random1];
					final_time = items33;		
				}
				else if (grades=="43 OPC")
				{
					initial_time = Array(110,115,120,125,130,135,140,145,150);
					var df = Array(60,65,70,75,80);
					
					var abss2 = parseInt(df.length) - 1;
					random1 = rand(0, abss2);
					items33 = df[random1];
					final_time = items33;
				}
				else if (grades=="33 OPC")
				{
					initial_time = Array(110,115,120,125,130,135,140,145,150);
					var df = Array(60,65,70,75,80);
					var abss2 = parseInt(df.length) - 1;
					random1 = rand(0, abss2);
					items33 = df[random1];
					final_time = items33;
				}
				else if (grades=="33_grade")
				{
					initial_time = Array(110,115,120,125,130,135,140,145,150);
					var df = Array(60,65,70,75,80);
					var abss2 = parseInt(df.length) - 1;
					random1 = rand(0, abss2);
					items33 = df[random1];
					final_time = items33;
				}
				else if (grades=="flyash_type" || grades=="calcimed_clay_type")
				{
					initial_time = Array(110,115,120,125,130,135,140,145,150);
					var df = Array(60,65,70,75,80);
					var abss2 = parseInt(df.length) - 1;
					random1 = rand(0, abss2);
					items33 = df[random1];
					final_time = items33;	
				}
				else if (grades=="OPC - 43 S")
				{
					initial_time = Array(130,135,140,145,150,155,160,165);
					var df = Array(60,65,70,75,80);
					var abss2 = parseInt(df.length) - 1;
					random1 = rand(0, abss2);
					items33 = df[random1];
					final_time = items33;
				}
				else if (grades=="OPC - 53 S")
				{
					initial_time = Array(110,115,120,125,130,135,140,145,150);
					var df = Array(60,65,70,75,80);
					var abss2 = parseInt(df.length) - 1;
					random1 = rand(0, abss2);
					items33 = df[random1];
					final_time = items33;
				}	
				else if (grades=="PORTLAND SLAG")
				{
					initial_time = Array(110,115,120,125,130,135,140,145,150);
						var df = Array(60,65,70,75,80);
					var abss2 = parseInt(df.length) - 1;
					random1 = rand(0, abss2);
					items33 = df[random1];
					final_time = items33;
					
				}
				var set_weight =400;
				$('#set_weight').val(set_weight.toFixed(0));
				var abss1 = parseInt(initial_time.length) - 1; 
				randomNumber1 = rand(0, abss1);
				randomItem1 = initial_time[randomNumber1];
				final_time1 = parseInt(final_time)+parseInt(randomItem1);
				
				$('#initial_time').val(randomItem1.toFixed(0));
				$('#final_time').val(final_time1.toFixed(0));
				
				
				
				var a_time_hr = randomNumberFromRange(09, 15).toFixed();
				var a_time_min = randomNumberFromRange(0, 55).toFixed();
				var a_times = a_time_hr+":"+a_time_min+":00";
				
				var intitalq =  timeConvert(randomItem1);
				var finals =  timeConvert(final_time1);
				
				var hr_b = addTimes(intitalq , a_times);
				var hr_c = addTimes(finals , a_times);
				//alert("WATER: "+ a_times + "\n INTIAL : "+ intitalq + "\n FINLS : "+finals + "\n MIN "+randomItem1);
				$('#hr_a').val(a_times);
				$('#hr_b').val(hr_b);
				$('#hr_c').val(hr_c);
	}
	
	$('#chk_set').change(function(){
        if(this.checked)
		{  
			set_auto();
		}
		else
		{
			$('#sett').css("background-color","white");	
			 $('#set_temp').val(null);
			$('#set_date_test').val(null);
			$('#set_humidity').val(null);			
			$('#set_wtr').val(null);
			$('#initial_time').val(null);
			$('#final_time').val(null);
			$('#hr_a').val(null);			
			$('#hr_b').val(null);			
			$('#hr_c').val(null);
			$('#set_weight').val(null); 
			
		}
	});
	
	$('#initial_time').change(function(){
		
			if ($("#chk_set").is(':checked')) {
			initial_time = $('#initial_time').val();
			var a_times = $('#hr_a').val();
			var intital =  timeConvert(initial_time);						
			var hr_b = addTimes(intital , a_times);
			$('#hr_b').val(hr_b);
				
			}
			$('#sett').css("background-color","#3CAF35");
		
			
	});
	$('#final_time').change(function(){
			
			if ($("#chk_set").is(':checked')) {
			final_time = $('#final_time').val();	
			var a_times = $('#hr_a').val();			
			var finals =  timeConvert(final_time);					
			var hr_c = addTimes(finals , a_times);
			$('#hr_c').val(hr_c);
			}
			$('#sett').css("background-color","#3CAF35");
			
	});
	
	
	$('#hr_b').change(function(){
			/*if ($("#chk_set").is(':checked')) {*/
			hr_b = $('#hr_b').val();
			var tims = hr_b.split(":");
			var hrs = tims[0];
			var mins = tims[1];
			var hr_cal = parseInt(hrs)*60;
			var total = parseInt(hr_cal)+parseInt(mins);
			var a_times = $('#hr_a').val();
			var wtr_time = a_times.split(":");
			var hrs1 = wtr_time[0];
			var mins1 = wtr_time[1];
			var hr_cal1 = parseInt(hrs1)*60;
			var water_final = parseInt(hr_cal1)+parseInt(mins1);
			var ans = (+total) - (+water_final);
			$('#initial_time').val(ans.toFixed(0));
		/*	}*/
			$('#sett').css("background-color","#3CAF35");
	});
	
	
	$('#hr_c').change(function(){
		/*if ($("#chk_set").is(':checked')) {*/
			hr_c = $('#hr_c').val();
			var tims = hr_c.split(":");
			var hrs = tims[0];
			var mins = tims[1];
			var hr_cal = parseInt(hrs)*60;
			var total = parseInt(hr_cal)+parseInt(mins);
			var a_times = $('#hr_a').val();
			var wtr_time = a_times.split(":");
			var hrs1 = wtr_time[0];
			var mins1 = wtr_time[1];
			var hr_cal1 = parseInt(hrs1)*60;
			var water_final = parseInt(hr_cal1)+parseInt(mins1);
			var ans = (+total) - (+water_final);			
			$('#final_time').val(ans.toFixed(0));
		/*}*/
		$('#sett').css("background-color","#3CAF35");
			
	});
	$('#set_weight').change(function(){
		
			var consis = $('#final_consistency').val();			
			set_wtr = (0.85 * (+consis))*4;
			$('#set_wtr').val(set_wtr.toFixed(1));
			
	});
	
	
	var den_intial1;
	var den_intial;
	var den_intial2;
	var den_final1;
	var den_final2;
	var den_final;
	var den_temp;
	var den_date_test;
	var den_humidity;
	var den_displaced;
	var den_displaced1;
	var den_displaced2;
	var density;
	var density1;
	var density2;
	var avg_density;
	var den_m2;
	var den_m3;
	var den_d;
	var den_weight;
	var den_volume;
	
	function den_auto()
	{
			$('#dens').css("background-color","#3CAF35");	
			den_temp = randomNumberFromRange(26.0,28.0);
			$('#den_temp').val(den_temp.toFixed(1));		
			$('#den_cement').val(64);		
			
			var top = 1;
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
			document.getElementById('den_date_test').value = someFormattedDate;	
			
			den_humidity = randomNumberFromRange(65.0,69.0);
			$('#den_humidity').val(den_humidity.toFixed(1));			
			
			var grades = $('#cement_grade').val();			
			if(grades=="53 OPC")
			{
				avg_density = randomNumberFromRange(3.11,3.18);
			}
			else if (grades=="43 OPC")
			{
				avg_density = randomNumberFromRange(3.11,3.18);
			}
			else if (grades=="33 OPC")
			{
				avg_density = randomNumberFromRange(3.11,3.18);
			}
			else if (grades=="33_grade")
			{
				avg_density = randomNumberFromRange(2.88,2.95);
			}
			else if (grades=="flyash_type" || grades=="calcimed_clay_type")
			{
				avg_density = randomNumberFromRange(2.80,2.85);
			}
			else if (grades=="OPC - 43 S")
			{
				avg_density = randomNumberFromRange(3.11,3.18);
			}
			else if (grades=="OPC - 53 S")
			{
				avg_density = randomNumberFromRange(3.11,3.18);
			}
			else if (grades=="PORTLAND SLAG")
			{
				avg_density = randomNumberFromRange(3.11,3.18);
			}
			
			$('#avg_density').val(avg_density.toFixed(2));
			var avgdensity = $('#avg_density').val();
			var rans = randomNumberFromRange(-0.020,0.010).toFixed(2);
			density = (+avgdensity) + (+rans);
			var tempo = (+avgdensity) * 2;
			density1 = (+tempo) - (+density);
			density2 = (+tempo) - (+density);
			$('#density').val(density.toFixed(2));
			$('#density1').val(density1.toFixed(2));
			$('#density2').val(density2.toFixed(2));
			var den1 = $('#density').val();
			var den2 = $('#density1').val();
			var den3 = $('#density2').val();
			den_displaced = (+64)/(+den1);
			den_displaced1 = (+64)/(+den2);
			den_displaced2 = (+64)/(+den3);
			$('#den_displaced').val(den_displaced.toFixed(1));
			$('#den_displaced1').val(den_displaced1.toFixed(1));
			$('#den_displaced2').val(den_displaced2.toFixed(1));
			var dendisplaced = $('#den_displaced').val();
			var dendisplaced1 = $('#den_displaced1').val();
			var dendisplaced2 = $('#den_displaced2').val();
			den_intial2 = randomNumberFromRange(0.1, 0.9);
			den_intial1 = randomNumberFromRange(0.1, 0.9);
			den_intial = randomNumberFromRange(0.1, 0.9);
			$('#den_intial').val(den_intial.toFixed(1));
			$('#den_intial1').val(den_intial1.toFixed(1));
			$('#den_intial2').val(den_intial2.toFixed(1));
			var denintial = $('#den_intial').val();
			var denintial1 = $('#den_intial1').val();
			var denintial2 = $('#den_intial2').val();
			den_final = (+denintial) + (+dendisplaced);
			den_final1 = (+denintial1) + (+dendisplaced1);
			den_final2 = (+denintial2) + (+dendisplaced2);
			$('#den_final').val(den_final.toFixed(1));
			$('#den_final1').val(den_final1.toFixed(1));
			$('#den_final2').val(den_final2.toFixed(1));
			
			var denf = $('#den_final').val();
			var denf1 = $('#den_final1').val();
			var denf2 = $('#den_final2').val();
			
			var den_displaced_0 = (+denf) - (+denintial);
			var den_displaced_1 = (+denf1) - (+denintial1);
			var den_displaced_2 = (+denf2) - (+denintial2);
			$('#den_displaced').val(den_displaced_0.toFixed(1));
			$('#den_displaced1').val(den_displaced_1.toFixed(1));
			$('#den_displaced2').val(den_displaced_2.toFixed(1));
			
			var den_displaced0 = $('#den_displaced').val();
			var den_displaced1 = $('#den_displaced1').val();
			var den_displaced2 = $('#den_displaced2').val();
			
			var density_f_0 = (+64) / (+den_displaced0);
			var density_f_1 = (+64) / (+den_displaced1);
			var density_f_2 = (+64) / (+den_displaced2);
			$('#density').val(density_f_0.toFixed(2));
			$('#density1').val(density_f_1.toFixed(2));
			$('#density2').val(density_f_2.toFixed(2));
			var den__1 = $('#density').val();
			var den__2 = $('#density1').val();
			var den__3 = $('#density2').val();
			
			var ans = ((+den__1) + (+den__2) + (+den__3)) / 3;
			$('#avg_density').val(ans.toFixed(2));
			
			
			
			
	}
	
	$('#chk_den').change(function(){
        if(this.checked)
		{  
			
			den_auto();
		
		}
		else
		{
			$('#den_temp').val(null);
			$('#den_date_test').val(null);
			$('#den_humidity').val(null);			
			$('#den_final1').val(null);
			$('#den_final').val(null);
			$('#den_final2').val(null);
			$('#den_intial1').val(null);
			$('#den_intial').val(null);
			$('#den_intial2').val(null);
			$('#den_displaced1').val(null);
			$('#den_displaced2').val(null);
			$('#den_displaced').val(null);
			$('#density').val(null);	
			$('#density1').val(null);	
			$('#density2').val(null);	
			$('#avg_density').val(null);	
			$('#den_cement').val(null);	
		}
	});
	
	$('#density').change(function(){
		$('#dens').css("background-color","#3CAF35");
		if ($("#chk_den").is(':checked')) {
			density = $('#density').val();			
			density1 = $('#density1').val();
			density2 = $('#density2').val();
			avg_density = (((+density) + (+density1) + (+density2))/3);
			$('#avg_density').val(avg_density.toFixed(2));
			
			den_displaced = 64/(+density);
			$('#den_displaced').val(den_displaced.toFixed(1));
			var dendisplaced = $('#den_displaced').val();
			den_intial = randomNumberFromRange(0.1, 0.9);
			$('#den_intial').val(den_intial.toFixed(1));
			var denintial = $('#den_intial').val();
			den_final = (+denintial) + (+dendisplaced);
			$('#den_final').val(den_final.toFixed(1));
		}
	});
	$('#avg_density').change(function(){
		$('#dens').css("background-color","#3CAF35");
		if ($("#chk_den").is(':checked')) {	
			var avgdensity = $('#avg_density').val();
			density = (+avgdensity) + randomNumberFromRange(-0.02,0.01);
			density1 = (((+avgdensity) * 2) - (+density));
			density2 = (((+avgdensity) * 2) - (+density));
			$('#density').val(density.toFixed(2));
			$('#density1').val(density1.toFixed(2));
			$('#density2').val(density2.toFixed(2));
			var den1 = $('#density').val();
			var den2 = $('#density1').val();
			var den3 = $('#density2').val();
			den_displaced = 64/(+den1);
			den_displaced1 = 64/(+den2);
			den_displaced2 = 64/(+den3);
			$('#den_displaced').val(den_displaced.toFixed(1));
			$('#den_displaced1').val(den_displaced1.toFixed(1));
			$('#den_displaced2').val(den_displaced2.toFixed(1));
			var dendisplaced = $('#den_displaced').val();
			var dendisplaced1 = $('#den_displaced1').val();
			var dendisplaced2 = $('#den_displaced2').val();
			den_intial1 = randomNumberFromRange(0.1, 0.9);
			den_intial = randomNumberFromRange(0.1, 0.9);
			den_intial2 = randomNumberFromRange(0.1, 0.9);
			$('#den_intial').val(den_intial.toFixed(1));
			$('#den_intial1').val(den_intial1.toFixed(1));
			$('#den_intial2').val(den_intial2.toFixed(1));
			var denintial = $('#den_intial').val();
			var denintial1 = $('#den_intial1').val();
			var denintial2 = $('#den_intial2').val();
			den_final = (+denintial) + (+dendisplaced);
			den_final1 = (+denintial1) + (+dendisplaced1);
			den_final2 = (+denintial2) + (+dendisplaced2);
			$('#den_final').val(den_final.toFixed(1));
			$('#den_final1').val(den_final1.toFixed(1));
			$('#den_final2').val(den_final2.toFixed(1));
			
			var denf = $('#den_final').val();
			var denf1 = $('#den_final1').val();
			var denf2 = $('#den_final2').val();
			
			var den_displaced_0 = (+denf) - (+denintial);
			var den_displaced_1 = (+denf1) - (+denintial1);
			var den_displaced_2 = (+denf2) - (+denintial2);
			$('#den_displaced').val(den_displaced_0.toFixed(1));
			$('#den_displaced1').val(den_displaced_1.toFixed(1));
			$('#den_displaced2').val(den_displaced_2.toFixed(1));
			
			var den_displaced0 = $('#den_displaced').val();
			var den_displaced1 = $('#den_displaced1').val();
			var den_displaced2 = $('#den_displaced2').val();
			
			var density_f_0 = (+64) / (+den_displaced0);
			var density_f_1 = (+64) / (+den_displaced1);
			var density_f_2 = (+64) / (+den_displaced2);
			$('#density').val(density_f_0.toFixed(2));
			$('#density1').val(density_f_1.toFixed(2));
			$('#density2').val(density_f_2.toFixed(2));
			var den__1 = $('#density').val();
			var den__2 = $('#density1').val();
			var den__3 = $('#density3').val();
			
			var ans = ((+den__1) + (+den__2) + (+den_3)) / 3;
			$('#avg_density').val(ans.toFixed(2));
		}
	});
	$('#density1').change(function(){
		$('#dens').css("background-color","#3CAF35");
			if ($("#chk_den").is(':checked')) {
			density = $('#density').val();			
			density1 = $('#density1').val();
			avg_density = (((+density) + (+density1))/2);
			$('#avg_density').val(avg_density.toFixed(2));
			
			den_displaced1 = 64/(+density1);
			$('#den_displaced1').val(den_displaced1.toFixed(1));
			var dendisplaced1 = $('#den_displaced1').val();
			den_intial1 = randomNumberFromRange(0.1, 0.9);
			$('#den_intial1').val(den_intial1.toFixed(1));
			var denintial1 = $('#den_intial1').val();
			den_final1 = (+denintial1) + (+dendisplaced1);
			$('#den_final1').val(den_final1.toFixed(1));
			}
	});
	
	$('#den_intial').change(function(){
		$('#dens').css("background-color","#3CAF35");
			density = $('#density').val();			
			den_displaced = 64/(+density);
			$('#den_displaced').val(den_displaced.toFixed(1));
			var dendisplaced = $('#den_displaced').val();
			den_intial = $('#den_intial').val();			
			den_final = (+den_intial) + (+dendisplaced);
			$('#den_final').val(den_final.toFixed(1));
	});
	$('#den_intial1').change(function(){
		$('#dens').css("background-color","#3CAF35");
			density1 = $('#density1').val();			
			den_displaced1 = 64/(+density1);
			$('#den_displaced1').val(den_displaced1.toFixed(1));
			var dendisplaced1 = $('#den_displaced1').val();
			den_intial1 = $('#den_intial1').val();			
			den_final1 = (+den_intial1) + (+dendisplaced1);
			$('#den_final1').val(den_final1.toFixed(1));
	});
	
	$('#den_final').change(function(){
		$('#dens').css("background-color","#3CAF35");
			den_intial = $('#den_intial').val();			
			den_final = $('#den_final').val();			
			den_displaced = (+den_final) - (+den_intial);
			$('#den_displaced').val(den_displaced.toFixed(1));
			var dendisplaced = $('#den_displaced').val();
			density = 64/(+dendisplaced);					
			$('#density').val(density.toFixed(2));
			var den1 = $('#density').val();
			var den2 = $('#density1').val();
			avg_density = (((+den1) + (+den2))/2);
			$('#avg_density').val(avg_density.toFixed(2));
	});
	$('#den_final1').change(function(){
		$('#dens').css("background-color","#3CAF35");
			den_intial1 = $('#den_intial1').val();			
			den_final1 = $('#den_final1').val();			
			den_displaced1 = (+den_final1) - (+den_intial1);
			$('#den_displaced1').val(den_displaced1.toFixed(1));
			var dendisplaced1 = $('#den_displaced1').val();
			density1 = 64/(+dendisplaced1);					
			$('#density1').val(density1.toFixed(2));
			var den1 = $('#density').val();
			var den2 = $('#density1').val();
			avg_density = (((+den1) + (+den2))/2);
			$('#avg_density').val(avg_density.toFixed(2));
	});
	

	$('#den_displaced').change(function(){
		$('#dens').css("background-color","#3CAF35");
		if ($("#chk_den").is(':checked')) {
			den_displaced = $('#den_displaced').val();									
			den_intial = $('#den_intial').val();			
			den_final = (+den_intial) + (+den_displaced);
			$('#den_final').val(den_final.toFixed(1));
			density = 64/(+den_displaced);					
			$('#density').val(density.toFixed(2));
			var den1 = $('#density').val();
			var den2 = $('#density1').val();
			avg_density = (((+den1) + (+den2))/2);
			$('#avg_density').val(avg_density.toFixed(2));
		}
	});
	$('#den_displaced1').change(function(){
		$('#dens').css("background-color","#3CAF35");
		if ($("#chk_den").is(':checked')) {
			den_displaced1 = $('#den_displaced1').val();									
			den_intial1 = $('#den_intial1').val();			
			den_final1 = (+den_intial1) + (+den_displaced1);
			$('#den_final1').val(den_final.toFixed(1));
			density1 = 64/(+den_displaced1);					
			$('#density1').val(density1.toFixed(2));
			var den1 = $('#density').val();
			var den2 = $('#density1').val();
			avg_density = (((+den1) + (+den2))/2);
			$('#avg_density').val(avg_density.toFixed(2));
		}
	});
	
	var constant_k;
	var constant_k_1;	
	var avg_fines_time;
	var fines_t_1;
	var fines_t_2;
	var fines_t_3;
	var ss_area;

	function fines_auto()
	{
			$('#fins').css("background-color","#3CAF35");	
			constant_k = 0.22;		
			constant_k_1 = 0.22;
			var fine_humidity = randomNumberFromRange(60.0,64.5).toFixed(1);
			var fine_temp = randomNumberFromRange(25.2,28.8).toFixed(1);
			$('#fine_humidity').val(fine_humidity);	
			$('#fine_temp').val(fine_temp);	
			$('#constant_k_1').val(constant_k_1.toFixed(2));	
			$('#constant_k').val(constant_k.toFixed(2));	
			var grades = $('#cement_grade').val();			
			if(grades=="53 OPC")
			{
				ss_area = randomNumberFromRange(230, 350);
			}
			else if (grades=="43 OPC")
			{
				ss_area = randomNumberFromRange(230, 350);
			}
			else if (grades=="33 OPC")
			{
				ss_area = randomNumberFromRange(230, 350);
			}
			else if (grades=="33_grade")
			{
				ss_area = randomNumberFromRange(230, 350);
			}
			else if (grades=="flyash_type" || grades=="calcimed_clay_type")
			{
				ss_area = randomNumberFromRange(320, 370);
			}
			else if (grades=="OPC - 43 S")
			{
				ss_area = randomNumberFromRange(230, 350);
			}
			else if (grades=="OPC - 53 S")
			{
				ss_area = randomNumberFromRange(230, 350);
			}
			else if (grades=="PORTLAND SLAG")
			{
				ss_area = randomNumberFromRange(230, 350);
			}

			
			
			$('#ss_area').val(ss_area.toFixed(0));
			var fines_val2 = randomNumberFromRange(3.11,3.17).toFixed(2);
			$('#fines_val2').val(fines_val2);
			
			
			var eq1 = (+fines_val2) * (+ss_area);
			var eq2 = 521.08 * (+constant_k);
			var anss = eq1 / eq2;
			var fines_val1 = anss * anss;
			
			$('#fines_val1').val(anss.toFixed(2));
			
			avg_fines_time = fines_val1.toFixed(2);
			$('#avg_fines_time').val(avg_fines_time);
			var rvg = $('#avg_fines_time').val();
			
			var tt = randomNumberFromRange(0,9).toFixed(0);
			if(tt%2==0)
			{
			fines_t_1 = (+rvg) + 0.17;
			fines_t_2 = (+rvg) - 0.30;
			fines_t_3 = (+rvg) + 0.13;
			}
			else
			{
			fines_t_1 = (+rvg) - 0.13;
			fines_t_2 = (+rvg) + 0.25;
			fines_t_3 = (+rvg) - 0.12;	
			}
			$('#fines_t_1').val(fines_t_1.toFixed(2));
			$('#fines_t_2').val(fines_t_2.toFixed(2));
			$('#fines_t_3').val(fines_t_3.toFixed(2));
	}
	
	$('#chk_fines').change(function(){
        if(this.checked)
		{  
			fines_auto();
			
		
		}
		else
		{
			$('#constant_k_1').val(null);
			$('#constant_k').val(null);
			$('#ss_area').val(null);			
			$('#avg_fines_time').val(null);
			//$('#avg_fines_time_1').val(null);
			$('#fines_t_1').val(null);
			$('#fines_t_2').val(null);	
			$('#fines_t_3').val(null);	
			$('#fines_val1').val(null);	
			$('#fines_val2').val(null);	
			$('#fine_temp').val(null);	
			$('#fine_humidity').val(null);	
			/* $('#w_t_1').val(null);
			$('#w_t_2').val(null);	
			$('#w_t_3').val(null);	
			$('#c_t_1').val(null);
			$('#c_t_2').val(null);	
			$('#c_t_3').val(null);	
			$('#d_t_1').val(null);
			$('#d_t_2').val(null);	
			$('#d_t_3').val(null);	
			$('#ss_area_1').val(null);	 */
		}
	});
	
	$('#constant_k').change(function(){
		
					constant_k = $('#constant_k').val();			
					constant_k_1 = parseFloat(constant_k);	
					$('#constant_k_1').val(constant_k_1.toFixed(2));	
					if ($("#chk_fines").is(':checked')) {
					
					var grades = $('#cement_grade').val();			
					if(grades=="53 OPC")
					{
						ss_area = randomNumberFromRange(230, 350);
					}
					else if (grades=="43 OPC")
					{
						ss_area = randomNumberFromRange(230, 350);
					}
					else if (grades=="33 OPC")
					{
						ss_area = randomNumberFromRange(230, 350);
					}
					else if (grades=="33_grade")
					{
						ss_area = randomNumberFromRange(230, 350);
					}
					else if (grades=="flyash_type" || grades=="calcimed_clay_type")
					{
						ss_area = randomNumberFromRange(230, 350);
					}
					else if (grades=="OPC - 43 S")
					{
						ss_area = randomNumberFromRange(230, 350);
					}
					else if (grades=="OPC - 53 S")
					{
						ss_area = randomNumberFromRange(230, 350);
					}
					else if (grades=="PORTLAND SLAG")
					{
						ss_area = randomNumberFromRange(230, 350);
					}

					
					
					$('#ss_area').val(ss_area.toFixed(0));
					var fines_val2 = randomNumberFromRange(3.11,3.17).toFixed(2);
					$('#fines_val2').val(fines_val2);
					
					
					var eq1 = (+fines_val2) * (+ss_area);
					var eq2 = 521.08 * (+constant_k);
					var anss = eq1 / eq2;
					var fines_val1 = anss * anss;
					
					$('#fines_val1').val(anss.toFixed(2));
					
					avg_fines_time = fines_val1.toFixed(2);
					$('#avg_fines_time').val(avg_fines_time);
					var rvg = $('#avg_fines_time').val();
					
					var tt = randomNumberFromRange(0,9).toFixed(0);
					if(tt%2==0)
					{
					fines_t_1 = (+rvg) + 0.17;
					fines_t_2 = (+rvg) - 0.30;
					fines_t_3 = (+rvg) + 0.13;
					}
					else
					{
					fines_t_1 = (+rvg) - 0.13;
					fines_t_2 = (+rvg) + 0.25;
					fines_t_3 = (+rvg) - 0.12;	
					}
					$('#fines_t_1').val(fines_t_1.toFixed(2));
					$('#fines_t_2').val(fines_t_2.toFixed(2));
					$('#fines_t_3').val(fines_t_3.toFixed(2));
			}
			else
			{
				
			}
			$('#fins').css("background-color","#3CAF35");
	});
	
	$('#ss_area').change(function(){
			
			if ($("#chk_fines").is(':checked')) {
				
				constant_k = $('#constant_k').val();			
				constant_k_1 = parseFloat(constant_k);	
				$('#constant_k_1').val(constant_k_1.toFixed(2));	
				ss_area = $('#ss_area').val();				
				var fines_val2 = randomNumberFromRange(3.11,3.17).toFixed(2);
				$('#fines_val2').val(fines_val2);
				ans1 = (+ss_area)* (+fines_val2);
				ans2 = 521.08 * (+constant_k);
				ans = (+ans1) / (+ans2);
				avg_fines_time = (+ans) * (+ans);			
				$('#avg_fines_time').val(avg_fines_time.toFixed(2));				
				$('#fines_val1').val(ans.toFixed(2));				
				var rvg = $('#avg_fines_time').val();
				
				var tt = randomNumberFromRange(0,9).toFixed(0);
				if(tt%2==0)
				{
				fines_t_1 = (+rvg) + 0.17;
				fines_t_2 = (+rvg) - 0.30;
				fines_t_3 = (+rvg) + 0.13;
				}
				else
				{
				fines_t_1 = (+rvg) - 0.13;
				fines_t_2 = (+rvg) + 0.25;
				fines_t_3 = (+rvg) - 0.12;	
				}
				$('#fines_t_1').val(fines_t_1.toFixed(2));
				$('#fines_t_2').val(fines_t_2.toFixed(2));
				$('#fines_t_3').val(fines_t_3.toFixed(2));
			}
			else
			{
				
			}
			$('#fins').css("background-color","#3CAF35");
	});
	
	
	$('#avg_fines_time').change(function(){
		
			if ($("#chk_fines").is(':checked')) {
			constant_k = $('#constant_k').val();			
			constant_k_1 = (+constant_k);	
			$('#constant_k_1').val(constant_k_1.toFixed(2));	
			avg_fines_time = $('#avg_fines_time').val();
			var fine_humidity = randomNumberFromRange(60.0,64.5).toFixed(1);
			var fine_temp = randomNumberFromRange(25.2,28.8).toFixed(1);
			$('#fine_humidity').val(fine_humidity);	
			$('#fine_temp').val(fine_temp);	
			
			ss_area = parseFloat(constant_k) * Math.sqrt(parseFloat(avg_fines_time));
			$('#ss_area').val(ss_area.toFixed(0));	
			
			var rvg = $('#avg_fines_time').val();
				
				var tt = randomNumberFromRange(0,9).toFixed(0);
				if(tt%2==0)
				{
				fines_t_1 = (+rvg) + 0.17;
				fines_t_2 = (+rvg) - 0.30;
				fines_t_3 = (+rvg) + 0.13;
				}
				else
				{
				fines_t_1 = (+rvg) - 0.13;
				fines_t_2 = (+rvg) + 0.25;
				fines_t_3 = (+rvg) - 0.12;	
				}
				$('#fines_t_1').val(fines_t_1.toFixed(2));
				$('#fines_t_2').val(fines_t_2.toFixed(2));
				$('#fines_t_3').val(fines_t_3.toFixed(2));	
				
			}
			else
			{
				
			}	
			$('#fins').css("background-color","#3CAF35");
	});
	
	$('#fines_t_1').change(function(){
			fines_t_1 = $('#fines_t_1').val();	
			fines_t_2 = $('#fines_t_2').val();	
			fines_t_3 = $('#fines_t_3').val();	
			fines_val2 = $('#fines_val2').val();	
			constant_k = $('#constant_k').val();			
			avg_fines_time = ((+fines_t_1) + (+fines_t_2) + (+fines_t_3))/3;
			$('#avg_fines_time').val(avg_fines_time.toFixed(2));
			fines_val1 = Math.sqrt($('#avg_fines_time').val());
			$('#fines_val1').val(fines_val1.toFixed(2));
			
			
			var eq2 = 521.08 * (+constant_k) * (+fines_val1);
			var ss_area = (+eq2) / (+fines_val2);
			$('#ss_area').val(ss_area.toFixed(0));
			$('#fins').css("background-color","#3CAF35");			
	});
	
	$('#fines_t_2').change(function(){
			fines_t_1 = $('#fines_t_1').val();	
			fines_t_2 = $('#fines_t_2').val();	
			fines_t_3 = $('#fines_t_3').val();	
			fines_val2 = $('#fines_val2').val();	
			constant_k = $('#constant_k').val();			
			avg_fines_time = ((+fines_t_1) + (+fines_t_2) + (+fines_t_3))/3;
			$('#avg_fines_time').val(avg_fines_time.toFixed(2));
			fines_val1 = Math.sqrt($('#avg_fines_time').val());
			$('#fines_val1').val(fines_val1.toFixed(2));
			
			
			var eq2 = 521.08 * (+constant_k) * (+fines_val1);
			var ss_area = eq2 / (+fines_val2);
			$('#ss_area').val(ss_area.toFixed(0));
			$('#fins').css("background-color","#3CAF35");			
	});
	
	$('#fines_t_3').change(function(){
			fines_t_1 = $('#fines_t_1').val();	
			fines_t_2 = $('#fines_t_2').val();	
			fines_t_3 = $('#fines_t_3').val();	
			fines_val2 = $('#fines_val2').val();	
			constant_k = $('#constant_k').val();			
			avg_fines_time = ((+fines_t_1) + (+fines_t_2) + (+fines_t_3))/3;
			$('#avg_fines_time').val(avg_fines_time.toFixed(2));
			fines_val1 = Math.sqrt($('#avg_fines_time').val());
			$('#fines_val1').val(fines_val1.toFixed(2));
			
			
			var eq2 = 521.08 * (+constant_k) * (+fines_val1);
			var ss_area = eq2 / (+fines_val2);
			$('#ss_area').val(ss_area.toFixed(0));	
			$('#fins').css("background-color","#3CAF35");			
	});
	$('#fines_val2').change(function(){
			fines_t_1 = $('#fines_t_1').val();	
			fines_t_2 = $('#fines_t_2').val();	
			fines_t_3 = $('#fines_t_3').val();	
			fines_val2 = $('#fines_val2').val();	
			constant_k = $('#constant_k').val();			
			avg_fines_time = ((+fines_t_1) + (+fines_t_2) + (+fines_t_3))/3;
			$('#avg_fines_time').val(avg_fines_time.toFixed(2));
			fines_val1 = Math.sqrt($('#avg_fines_time').val());
			$('#fines_val1').val(fines_val1.toFixed(2));
			
			
			var eq2 = 521.08 * (+constant_k) * (+fines_val1);
			var ss_area = eq2 / (+fines_val2);
			$('#ss_area').val(ss_area.toFixed(0));
			$('#fins').css("background-color","#3CAF35");			
	});
	
	
	
	var com_date_test;
	var com_temp;
	var com_humidity;
	var weight_of_cement;
	var weight_of_water;
	var weight_of_sand;
	var sp_1;
	var sp_2;
	var sp_3;
	var caste_date1;
	var caste_date2;
	var caste_date3;
	var test_date1;
	var test_date2;
	var test_date3;
	var day_1;
	var day_2;
	var day_3;
	var avg_com_1;
	var avg_com_2;
	var avg_com_3;
	var l1;
	var l2;
	var l3;
	var l4;
	var l5;
	var l6;
	var l7;
	var l8;
	var l9;
	var b1;
	var b2;
	var b3;
	var b4;
	var b5;
	var b6;
	var b7;
	var b8;
	var b9;
	var h1;
	var h2;
	var h3;
	var h4;
	var h5;
	var h6;
	var h7;
	var h8;
	var h9;
	var area_1;
	var area_2;
	var area_3;
	var area_4;
	var area_5;
	var area_6;
	var area_7;
	var area_8;
	var area_9;
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
		$('#comp').css("background-color","#3CAF35");
			com_temp = randomNumberFromRange(26.0,28.0);
			$('#com_temp').val(com_temp.toFixed(1));		
			
			var top = 1;
			//var date_input = document.getElementById("con_date_test").value.split('/');	
			var date_input = $('#rec_sample_date').val().split('/');			
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
			document.getElementById('com_date_test').value = someFormattedDate;	
			
			com_humidity = randomNumberFromRange(65.0,69.0);
			$('#com_humidity').val(com_humidity.toFixed(1));			
			
			weight_of_cement = 200;
			$('#weight_of_cement').val(weight_of_cement.toFixed(0));

			weight_of_sand = 600;
			$('#weight_of_sand').val(weight_of_sand.toFixed(0));

			
			
			var consis = $('#final_consistency').val();
			var temp = ((parseFloat(consis)/4)+3);
			weight_of_water = (parseFloat(temp)*8);
			$('#weight_of_water').val(weight_of_water.toFixed(1));
			
			/*com_3_day();
			com_7_day();
			com_28_day();*/
	}
	
	
	$('#chk_com').change(function(){
        if(this.checked)
		{  
			com_auto();
		
		}
		else
		{
			$('#comp').css("background-color","#3CAF35");
			 $('#com_temp').val(null);
			$('#com_date_test').val(null);
			$('#com_humidity').val(null);			
			$('#weight_of_cement').val(null);
			$('#weight_of_sand').val(null);
			$('#weight_of_water').val(null);
			$('#caste_date1').val(null);
			$('#test_date1').val(null);
			$('#sp_1').val(null);				
			$('#day_1').val(null);				
			$('#avg_com_1').val(null);
			$('#com_1').val(null);
			$('#com_2').val(null);
			$('#com_3').val(null);	
			$('#l1').val(null);
			$('#l2').val(null);
			$('#l3').val(null);
			$('#b1').val(null);
			$('#b2').val(null);
			$('#b3').val(null);
			$('#h1').val(null);
			$('#h2').val(null);
			$('#h3').val(null);
			$('#area_1').val(null);
			$('#area_2').val(null);
			$('#area_3').val(null);
			$('#load_1').val(null);
			$('#load_2').val(null);
			$('#load_3').val(null);
			$('#caste_date2').val(null);
			$('#test_date2').val(null);
			$('#sp_2').val(null);				
			$('#day_2').val(null);				
			$('#avg_com_2').val(null);
			$('#com_4').val(null);
			$('#com_5').val(null);
			$('#com_6').val(null);	
			$('#l4').val(null);
			$('#l5').val(null);
			$('#l6').val(null);
			$('#b4').val(null);
			$('#b5').val(null);
			$('#b6').val(null);
			$('#h4').val(null);
			$('#h5').val(null);
			$('#h6').val(null);
			$('#area_4').val(null);
			$('#area_5').val(null);
			$('#area_6').val(null);
			$('#load_4').val(null);
			$('#load_5').val(null);
			$('#load_6').val(null);
			$('#caste_date3').val(null);
			$('#test_date3').val(null);
			$('#sp_3').val(null);				
			$('#day_3').val(null);				
			$('#avg_com_3').val(null);
			$('#com_7').val(null);
			$('#com_8').val(null);
			$('#com_9').val(null);	
			$('#l7').val(null);
			$('#l8').val(null);
			$('#l9').val(null);
			$('#b7').val(null);
			$('#b8').val(null);
			$('#b9').val(null);
			$('#h7').val(null);
			$('#h8').val(null);
			$('#h9').val(null);
			$('#area_7').val(null);
			$('#area_8').val(null);
			$('#area_9').val(null);
			$('#load_7').val(null);
			$('#load_8').val(null);
			$('#load_9').val(null);
		}
	});
	
	
	
	function com_3_day()
	{
		$('#comp').css("background-color","#3CAF35");
		if ($("#chk_com").is(':checked')) {
		var grades = $('#cement_grade').val();
			var date_of_casting = $('#com_date_test').val();
			$('#caste_date1').val(date_of_casting);
			day_1 = 3;
			l1=70.6;
			l2=70.6;
			l3=70.6;
			b1=70.6;
			b2=70.6;
			b3=70.6;
			h1=70.6;
			h2=70.6;
			h3=70.6;
			if(grades=="53 OPC")
			{
				sp_1 = 27;
				avg_com_1 = randomNumberFromRange(28.00, 32.50);
			}
			else if (grades=="43 OPC")
			{
				sp_1 = 23;
				avg_com_1 = randomNumberFromRange(24.00, 28.00);
			}
			else if (grades=="33 OPC")
			{
				sp_1 = 16;
				avg_com_1 = randomNumberFromRange(17.00, 20.00);
			}
			else if (grades=="33_grade")
			{
				sp_1 = 16;
				avg_com_1 = randomNumberFromRange(17.00, 20.00);
			}
			else if (grades=="flyash_type" || grades=="calcimed_clay_type")
			{
				sp_1 = 16;
				avg_com_1 = randomNumberFromRange(17.00, 20.00);
			}
			else if (grades=="OPC - 43 S")
			{
				sp_1 = 16;
				avg_com_1 = randomNumberFromRange(28.00, 32.50);
			}
			else if (grades=="OPC - 53 S")
			{
				sp_1 = 16;
				avg_com_1 = randomNumberFromRange(28.00, 32.50);
			}
			else if (grades=="PORTLAND SLAG")
			{
				sp_1 = 16;
				avg_com_1 = randomNumberFromRange(28.00, 32.50);
			}
						
			$('#sp_1').val(sp_1);					
			$('#day_1').val(day_1);					
			$('#avg_com_1').val(avg_com_1.toFixed(2));
			var avg_com1 = $('#avg_com_1').val();
			com_1 = (+avg_com1) + 0.34;
			com_2 = (+avg_com1) - 0.56;
			com_3 = (+avg_com1) + 0.22;
			$('#com_1').val(com_1.toFixed(2));
			$('#com_2').val(com_2.toFixed(2));
			$('#com_3').val(com_3.toFixed(2));
			
			var com1 = $('#com_1').val();
			var com2 = $('#com_2').val();
			var com3 = $('#com_3').val();
			
			$('#l1').val(l1.toFixed(1));
			$('#l2').val(l2.toFixed(1));
			$('#l3').val(l3.toFixed(1));
			$('#b1').val(b1.toFixed(1));
			$('#b2').val(b2.toFixed(1));
			$('#b3').val(b3.toFixed(1));
			$('#h1').val(h1.toFixed(1));
			$('#h2').val(h2.toFixed(1));
			$('#h3').val(h3.toFixed(1));
			
			var l_1 = $('#l1').val();
			var l_2 = $('#l2').val();
			var l_3 = $('#l3').val();
			
			var b_1 = $('#b1').val();
			var b_2 = $('#b2').val();
			var b_3 = $('#b3').val();
			
			var h_1 = $('#h1').val();
			var h_2 = $('#h2').val();
			var h_3 = $('#h3').val();
			
			area_1 = (+l_1) * (+b_1);
			area_2 = (+l_2) * (+b_2);
			area_3 = (+l_3) * (+b_3);

			$('#area_1').val(area_1.toFixed(2));
			$('#area_2').val(area_2.toFixed(2));
			$('#area_3').val(area_3.toFixed(2));
			
			var area1 = $('#area_1').val();
			var area2 = $('#area_2').val();
			var area3 = $('#area_3').val();
			
			load_1 = ((+area1) *  (+com1)) / 1000;
			load_2 = ((+area2) *  (+com2)) / 1000;
			load_3 = ((+area3) *  (+com3)) / 1000;
			
			$('#load_1').val(load_1.toFixed(1));
			$('#load_2').val(load_2.toFixed(1));
			$('#load_3').val(load_3.toFixed(1));
			
			
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
			
			var avgs = ((+co1) + (+co2) + (+co3))/3;
			$('#avg_com_1').val(avgs.toFixed(2));
			
			
			
			
							
			var top = parseInt(day_1);
			var date_input = document.getElementById("com_date_test").value.split('/');						
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
		}
		
	}
	
	$('#chk_chk1').change(function(){
		 if(this.checked)
		{  
			com_3_day();			
		}
		else
		{
			$('#caste_date1').val(null);
			$('#test_date1').val(null);
			$('#sp_1').val(null);				
			$('#day_1').val(null);				
			$('#avg_com_1').val(null);
			$('#com_1').val(null);
			$('#com_2').val(null);
			$('#com_3').val(null);	
			$('#l1').val(null);
			$('#l2').val(null);
			$('#l3').val(null);
			$('#b1').val(null);
			$('#b2').val(null);
			$('#b3').val(null);
			$('#h1').val(null);
			$('#h2').val(null);
			$('#h3').val(null);
			$('#area_1').val(null);
			$('#area_2').val(null);
			$('#area_3').val(null);
			$('#load_1').val(null);
			$('#load_2').val(null);
			$('#load_3').val(null);
		}
	});
	
	function com_7_day()
	{
			$('#comp').css("background-color","#3CAF35");
			if ($("#chk_com").is(':checked')) {
			var grades = $('#cement_grade').val();
			var date_of_casting = $('#com_date_test').val();
			$('#caste_date2').val(date_of_casting);
			day_2 = 7;
			l4=70.6;
			l5=70.6;
			l6=70.6;
			b4=70.6;
			b5=70.6;
			b6=70.6;
			h4=70.6;
			h5=70.6;
			h6=70.6;
			if(grades=="53 OPC")
			{
				sp_2 = 37;
				avg_com_2 = randomNumberFromRange(38.00, 43.50);
			}
			else if (grades=="43 OPC")
			{
				sp_2 = 33;
				avg_com_2 = randomNumberFromRange(34.00, 38.00);
			}
			else if (grades=="33 OPC")
			{
				sp_2 = 22;
				avg_com_2 = randomNumberFromRange(23.00, 27.00);
			}
			else if (grades=="33_grade")
			{
				sp_2 = 22;
				avg_com_2 = randomNumberFromRange(23.00, 27.00);
			}
			else if (grades=="flyash_type" || grades=="calcimed_clay_type")
			{
				sp_2 = 22;
				avg_com_2 = randomNumberFromRange(23.00, 27.00);
			}
			else if (grades=="OPC - 43 S")
			{
				sp_2 = 43;
				avg_com_2 = randomNumberFromRange(38.00, 43.50);
			}
			else if (grades=="OPC - 53 S")
			{
				sp_2 = 53;
				avg_com_2 = randomNumberFromRange(38.00, 43.50);
			}
			else if (grades=="PORTLAND SLAG")
			{
				sp_2 = 22;
				avg_com_2 = randomNumberFromRange(38.00, 43.50);
			}
						
			$('#sp_2').val(sp_2);					
			$('#day_2').val(day_2);					
			$('#avg_com_2').val(avg_com_2.toFixed(2));
			var avg_com2 = $('#avg_com_2').val();
			com_4 = (+avg_com2) + (+0.32);
			com_5 = (+avg_com2) - (+0.78);
			com_6 = (+avg_com2) + (+0.46);
			$('#com_4').val(com_4.toFixed(2));
			$('#com_5').val(com_5.toFixed(2));
			$('#com_6').val(com_6.toFixed(2));
			
			var com4 = $('#com_4').val();
			var com5 = $('#com_5').val();
			var com6 = $('#com_6').val();
			
			$('#l4').val(l4.toFixed(1));
			$('#l5').val(l5.toFixed(1));
			$('#l6').val(l6.toFixed(1));
			$('#b4').val(b4.toFixed(1));
			$('#b5').val(b5.toFixed(1));
			$('#b6').val(b6.toFixed(1));
			$('#h4').val(h4.toFixed(1));
			$('#h5').val(h5.toFixed(1));
			$('#h6').val(h6.toFixed(1));
			
			var l_4 = $('#l4').val();
			var l_5 = $('#l5').val();
			var l_6 = $('#l6').val();
			
			var b_4 = $('#b4').val();
			var b_5 = $('#b5').val();
			var b_6 = $('#b6').val();
			
			var h_4 = $('#h4').val();
			var h_5 = $('#h5').val();
			var h_6 = $('#h6').val();
			
			area_4 = (+l_4) * (+b_4);
			area_5 = (+l_5) * (+b_5);
			area_6 = (+l_6) * (+b_6);
						
			$('#area_4').val(area_4.toFixed(2));
			$('#area_5').val(area_5.toFixed(2));
			$('#area_6').val(area_6.toFixed(2));
			
			var area4 = $('#area_4').val();
			var area5 = $('#area_5').val();
			var area6 = $('#area_6').val();
			
			load_4 = ((+area4) *  (+com4)) / 1000;
			load_5 = ((+area5) *  (+com5)) / 1000;
			load_6 = ((+area6) *  (+com6)) / 1000;
			
			$('#load_4').val(load_4.toFixed(1));
			$('#load_5').val(load_5.toFixed(1));
			$('#load_6').val(load_6.toFixed(1));
			
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
			
			var avgs1 = ((+co4) + (+co5) + (+co6))/3;
			$('#avg_com_2').val(avgs1.toFixed(2));
							
			var top = parseInt(day_2);
			var date_input = document.getElementById("com_date_test").value.split('/');						
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
			}
	}
	
	$('#chk_chk2').change(function(){
		 if(this.checked)
		{  
			
				com_7_day();
			
			
		}
		else
		{
			$('#caste_date2').val(null);
			$('#test_date2').val(null);
			$('#sp_2').val(null);				
			$('#day_2').val(null);				
			$('#avg_com_2').val(null);
			$('#com_4').val(null);
			$('#com_5').val(null);
			$('#com_6').val(null);	
			$('#l4').val(null);
			$('#l5').val(null);
			$('#l6').val(null);
			$('#b4').val(null);
			$('#b5').val(null);
			$('#b6').val(null);
			$('#h4').val(null);
			$('#h5').val(null);
			$('#h6').val(null);
			$('#area_4').val(null);
			$('#area_5').val(null);
			$('#area_6').val(null);
			$('#load_4').val(null);
			$('#load_5').val(null);
			$('#load_6').val(null);
		}
	});
	
	function com_28_day()
	{
		$('#comp').css("background-color","#3CAF35");
		if ($("#chk_com").is(':checked')) {
		var grades = $('#cement_grade').val();
			var date_of_casting = $('#com_date_test').val();
			$('#caste_date3').val(date_of_casting);
			day_3 = 28;
			l7=70.6;
			l8=70.6;
			l9=70.6;
			b7=70.6;
			b8=70.6;
			b9=70.6;
			h7=70.6;
			h8=70.6;
			h9=70.6;
			if(grades=="53 OPC")
			{
				sp_3 = 53;
				avg_com_3 = randomNumberFromRange(54.00, 58.50);
			}
			else if (grades=="43 OPC")
			{
				sp_3 = 43;
				avg_com_3 = randomNumberFromRange(45.00, 55.00);
			}
			else if (grades=="33 OPC")
			{
				sp_3 = 33;
				avg_com_3 = randomNumberFromRange(35.00, 40.00);
			}
			else if (grades=="33_grade")
			{
				sp_3 = 33;
				avg_com_3 = randomNumberFromRange(35.00, 40.00);
			}
			else if (grades=="flyash_type" || grades=="calcimed_clay_type")
			{
				sp_3 = 33;
				avg_com_3 = randomNumberFromRange(34.00, 38.00);
			}
			else if (grades=="OPC - 43 S")
			{
				sp_3 = 43;
				avg_com_3 = randomNumberFromRange(54.00, 58.50);
			}
			else if (grades=="OPC - 53 S")
			{
				sp_3 = 53;
				avg_com_3 = randomNumberFromRange(54.00, 58.50);
			}
			else if (grades=="PORTLAND SLAG")
			{
				sp_3 = 33;
				avg_com_3 = randomNumberFromRange(54.00, 58.50);
			}
			
						
			$('#sp_3').val(sp_3);					
			$('#day_3').val(day_3);					
			$('#avg_com_3').val(avg_com_3.toFixed(2));
			var avg_com3 = $('#avg_com_3').val();
			com_7 = (+avg_com3) + (+0.32);
			com_8 = (+avg_com3) - (+0.78);
			com_9 = (+avg_com3) + (+0.46);
			$('#com_7').val(com_7.toFixed(2));
			$('#com_8').val(com_8.toFixed(2));
			$('#com_9').val(com_9.toFixed(2));
			
			var com7 = $('#com_7').val();
			var com8 = $('#com_8').val();
			var com9 = $('#com_9').val();
			
			$('#l7').val(l7.toFixed(1));
			$('#l8').val(l8.toFixed(1));
			$('#l9').val(l9.toFixed(1));
			$('#b7').val(b7.toFixed(1));
			$('#b8').val(b8.toFixed(1));
			$('#b9').val(b9.toFixed(1));
			$('#h7').val(h7.toFixed(1));
			$('#h8').val(h8.toFixed(1));
			$('#h9').val(h9.toFixed(1));
			
			var l_7 = $('#l7').val();
			var l_8 = $('#l8').val();
			var l_9 = $('#l9').val();
			
			var b_7 = $('#b7').val();
			var b_8 = $('#b8').val();
			var b_9 = $('#b9').val();
			
			var h_7 = $('#h7').val();
			var h_8 = $('#h8').val();
			var h_9 = $('#h9').val();
			
			area_7 = (+l_7) * (+b_7);
			area_8 = (+l_8) * (+b_8);
			area_9 = (+l_9) * (+b_9);
			
			$('#area_7').val(area_7.toFixed(2));
			$('#area_8').val(area_8.toFixed(2));
			$('#area_9').val(area_9.toFixed(2));
			
			var area7 = $('#area_7').val();
			var area8 = $('#area_8').val();
			var area9 = $('#area_9').val();
			
			load_7 = ((+area7) *  (+com7)) / 1000;
			load_8 = ((+area8) *  (+com8)) / 1000;
			load_9 = ((+area9) *  (+com9)) / 1000;
			
			$('#load_7').val(load_7.toFixed(1));
			$('#load_8').val(load_8.toFixed(1));
			$('#load_9').val(load_9.toFixed(1));
			
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
			
			var avgs2 = ((+co7) + (+co8) + (+co9))/3;
			$('#avg_com_3').val(avgs2.toFixed(2));
							
			var top = parseInt(day_3);
			var date_input = document.getElementById("com_date_test").value.split('/');						
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
		}			
	}
	
	$('#chk_chk3').change(function(){
		 if(this.checked)
		{  
			com_28_day();
		}
		else
		{
			$('#caste_date3').val(null);
			$('#test_date3').val(null);
			$('#sp_3').val(null);				
			$('#day_3').val(null);				
			$('#avg_com_3').val(null);
			$('#com_7').val(null);
			$('#com_8').val(null);
			$('#com_9').val(null);	
			$('#l7').val(null);
			$('#l8').val(null);
			$('#l9').val(null);
			$('#b7').val(null);
			$('#b8').val(null);
			$('#b9').val(null);
			$('#h7').val(null);
			$('#h8').val(null);
			$('#h9').val(null);
			$('#area_7').val(null);
			$('#area_8').val(null);
			$('#area_9').val(null);
			$('#load_7').val(null);
			$('#load_8').val(null);
			$('#load_9').val(null);
		}
	});
	
	function l1_l2_l3()
	{
		
		if ($("#chk_com").is(':checked')) {
		l1 = $('#l1').val();
		l2 = $('#l2').val();
		l3 = $('#l3').val();
		b1 = $('#b1').val();
		b2 = $('#b2').val();
		b3 = $('#b3').val();
		
		area_1 = (+l1) * (+b1);  
		area_2 = (+l2) * (+b2);  
		area_3 = (+l3) * (+b3);
		
		$('#area_1').val(area_1.toFixed(2));
		$('#area_2').val(area_2.toFixed(2));
		$('#area_3').val(area_3.toFixed(2));
				
		var area1 = $('#area_1').val();
		var area2 = $('#area_2').val();
		var area3 = $('#area_3').val();
		
		
		com_1 = $('#com_1').val();
		com_2 = $('#com_2').val();
		com_3 = $('#com_3').val();
		
		avg_com_1 = ((+com_1) + (+com_2) + (+com_3))/3;
		$('#avg_com_1').val(avg_com_1.toFixed(2));
		
		load_1 = ((+area1) *  (+com_1)) / 1000;
		load_2 = ((+area2) *  (+com_2)) / 1000;
		load_3 = ((+area3) *  (+com_3)) / 1000;
		
		$('#load_1').val(load_1.toFixed(1));
		$('#load_2').val(load_2.toFixed(1));
		$('#load_3').val(load_3.toFixed(1));
		}
		$('#comp').css("background-color","#3CAF35");

	}
	
	function load_3_day()
	{
		/*if ($("#chk_com").is(':checked')) {*/
		l1 = $('#l1').val();
		l2 = $('#l2').val();
		l3 = $('#l3').val();
		b1 = $('#b1').val();
		b2 = $('#b2').val();
		b3 = $('#b3').val();
		
		area_1 = (+l1) * (+b1);  
		area_2 = (+l2) * (+b2);  
		area_3 = (+l3) * (+b3);
		
		$('#area_1').val(area_1.toFixed(2));
		$('#area_2').val(area_2.toFixed(2));
		$('#area_3').val(area_3.toFixed(2));	
		
		area1 = $('#area_1').val();
		area2 = $('#area_2').val();
		area3 = $('#area_3').val();
		
		load_1 = $('#load_1').val();
		load_2 = $('#load_2').val();
		load_3 = $('#load_3').val();
		
		
		
		com_1 = (1000 *  (+load_1)) / (+area1);
		com_2 = (1000 *  (+load_2)) / (+area2);
		com_3 = (1000 *  (+load_3)) / (+area3);
		
		avg_com_1 = ((+com_1) + (+com_2) + (+com_3))/3;
		$('#avg_com_1').val(avg_com_1.toFixed(2));
		
		$('#com_1').val(com_1.toFixed(2));
		$('#com_2').val(com_2.toFixed(2));
		$('#com_3').val(com_3.toFixed(2));
		/*}*/
		$('#comp').css("background-color","#3CAF35");
	}
	
	function load_7_day()
	{
		/*if ($("#chk_com").is(':checked')) {*/
		l4 = $('#l4').val();
		l5 = $('#l5').val();
		l6 = $('#l6').val();
		b4 = $('#b4').val();
		b5 = $('#b5').val();
		b6 = $('#b6').val();
		
		area_4 = (+l4) * (+b4);  
		area_5 = (+l5) * (+b5);  
		area_6 = (+l6) * (+b6);
		
		$('#area_4').val(area_4.toFixed(2));
		$('#area_5').val(area_5.toFixed(2));
		$('#area_6').val(area_6.toFixed(2));
		
		area4 = $('#area_4').val();
		area5 = $('#area_5').val();
		area6 = $('#area_6').val();
		
		load_4 = $('#load_4').val();
		load_5 = $('#load_5').val();
		load_6 = $('#load_6').val();
		
		
		
		com_4 = (1000 *  (+load_4)) / (+area4);
		com_5 = (1000 *  (+load_5)) / (+area5);
		com_6 = (1000 *  (+load_6)) / (+area6);
		
		avg_com_2 = ((+com_4) + (+com_5) + (+com_6))/3;
		$('#avg_com_2').val(avg_com_2.toFixed(2));
		
		$('#com_4').val(com_4.toFixed(2));
		$('#com_5').val(com_5.toFixed(2));
		$('#com_6').val(com_6.toFixed(2));
		/*}*/
		$('#comp').css("background-color","#3CAF35");
	}
	function load_28_day()
	{
		/*if ($("#chk_com").is(':checked')) {*/
		l7 = $('#l7').val();
		l8 = $('#l8').val();
		l9 = $('#l9').val();
		b7 = $('#b7').val();
		b8 = $('#b8').val();
		b9 = $('#b9').val();
		
		area_7 = (+l7) * (+b7);  
		area_8 = (+l8) * (+b8);  
		area_9 = (+l9) * (+b9);
		
		$('#area_7').val(area_7.toFixed(2));
		$('#area_8').val(area_8.toFixed(2));
		$('#area_9').val(area_9.toFixed(2));
		
		area7 = $('#area_7').val();
		area8 = $('#area_8').val();
		area9 = $('#area_9').val();
		
		load_7 = $('#load_7').val();
		load_8 = $('#load_8').val();
		load_9 = $('#load_9').val();
		
		
		
		com_7 = (1000 *  (+load_7)) / (+area7);
		com_8 = (1000 *  (+load_8)) / (+area8);
		com_9 = (1000 *  (+load_9)) / (+area9);
		
		avg_com_3 = ((+com_7) + (+com_8) + (+com_9))/3;
		$('#avg_com_3').val(avg_com_3.toFixed(2));
		
		$('#com_7').val(com_7.toFixed(2));
		$('#com_8').val(com_8.toFixed(2));
		$('#com_9').val(com_9.toFixed(2));
		/*}*/	
		$('#comp').css("background-color","#3CAF35");
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
	
	$('#l1').change(function(){
		l1_l2_l3();
	});
	$('#l2').change(function(){
		l1_l2_l3();
	});
	$('#l3').change(function(){
		l1_l2_l3();
	});
	$('#b1').change(function(){
		l1_l2_l3();
	});
	$('#b2').change(function(){
		l1_l2_l3();
	});
	$('#b3').change(function(){
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
	
	$('#avg_com_1').change(function(){
		
		if ($("#chk_com").is(':checked')) {
		var avg_com1 = $('#avg_com_1').val();
		com_1 = (+avg_com1) + (+0.42);
		com_2 = (+avg_com1) - (+0.55);
		com_3 = (+avg_com1) + (+0.13);
		$('#com_1').val(com_1.toFixed(2));
		$('#com_2').val(com_2.toFixed(2));
		$('#com_3').val(com_3.toFixed(2));
		
		l1 = $('#l1').val();
		l2 = $('#l2').val();
		l3 = $('#l3').val();
		b1 = $('#b1').val();
		b2 = $('#b2').val();
		b3 = $('#b3').val();
		
		area_1 = (+l1) * (+b1);  
		area_2 = (+l2) * (+b2);  
		area_3 = (+l3) * (+b3);
		
		$('#area_1').val(area_1.toFixed(2));
		$('#area_2').val(area_2.toFixed(2));
		$('#area_3').val(area_3.toFixed(2));
		
		area1 = $('#area_1').val();
		area2 = $('#area_2').val();
		area3 = $('#area_3').val();
		
		com1 = $('#com_1').val();
		com2 = $('#com_2').val();
		com3 = $('#com_3').val();
		
		load_1 = ((+area1) *  (+com1)) / 1000;
		load_2 = ((+area2) *  (+com2)) / 1000;
		load_3 = ((+area3) *  (+com3)) / 1000;
		
		$('#load_1').val(load_1.toFixed(1));
		$('#load_2').val(load_2.toFixed(1));
		$('#load_3').val(load_3.toFixed(1));
		
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
		
		var avgs = ((+co1) + (+co2) + (+co3))/3;
		$('#avg_com_1').val(avgs.toFixed(2));
		
		
		}
		$('#comp').css("background-color","#3CAF35");
	});
	
	function l4_l5_l6()
	{
		if ($("#chk_com").is(':checked')) {
	
		l4 = $('#l4').val();
		l5 = $('#l5').val();
		l6 = $('#l6').val();
		b4 = $('#b4').val();
		b5 = $('#b5').val();
		b6 = $('#b6').val();
		
		area_4 = (+l4) * (+b4);  
		area_5 = (+l5) * (+b5);  
		area_6 = (+l6) * (+b6);
		
		$('#area_4').val(area_4.toFixed(2));
		$('#area_5').val(area_5.toFixed(2));
		$('#area_6').val(area_6.toFixed(2));
		
		var area4 = $('#area_4').val();
		var area5 = $('#area_5').val();
		var area6 = $('#area_6').val();
		
		com_4 = $('#com_4').val();
		com_5 = $('#com_5').val();
		com_6 = $('#com_6').val();
		
		avg_com_2 = ((+com_4) + (+com_5) + (+com_6))/3;
		$('#avg_com_2').val(avg_com_2.toFixed(2));
		
		load_4 = ((+area4) *  (+com_4)) / 1000;
		load_5 = ((+area5) *  (+com_5)) / 1000;
		load_6 = ((+area6) *  (+com_6)) / 1000;
		
		$('#load_4').val(load_4.toFixed(1));
		$('#load_5').val(load_5.toFixed(1));
		$('#load_6').val(load_6.toFixed(1));
		}
		$('#comp').css("background-color","#3CAF35");

	}
	
	$('#avg_com_2').change(function(){
		if ($("#chk_com").is(':checked')) {
		avg_com_2 = $('#avg_com_2').val();
		com_4 = (+avg_com_2) + 0.63;
		com_5 = (+avg_com_2) - 0.71;
		com_6 = (+avg_com_2) + 0.08;
		$('#com_4').val(com_4.toFixed(2));
		$('#com_5').val(com_5.toFixed(2));
		$('#com_6').val(com_6.toFixed(2));
		
		var com4 = $('#com_4').val();
		var com5 = $('#com_5').val();
		var com6 = $('#com_6').val();
		
		l4 = $('#l4').val();
		l5 = $('#l5').val();
		l6 = $('#l6').val();
		b4 = $('#b4').val();
		b5 = $('#b5').val();
		b6 = $('#b6').val();
				
		
		area_4 = (+l4) * (+b4);  
		area_5 = (+l5) * (+b5);  
		area_6 = (+l6) * (+b6);
		
		$('#area_4').val(area_4.toFixed(2));
		$('#area_5').val(area_5.toFixed(2));
		$('#area_6').val(area_6.toFixed(2));
		
		var area4 = $('#area_4').val();
		var area5 = $('#area_5').val();
		var area6 = $('#area_6').val();
		
		load_4 = ((+area4) *  (+com4)) / 1000;
		load_5 = ((+area5) *  (+com5)) / 1000;
		load_6 = ((+area6) *  (+com6)) / 1000;
		
		$('#load_4').val(load_4.toFixed(1));
		$('#load_5').val(load_5.toFixed(1));
		$('#load_6').val(load_6.toFixed(1));
		
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
		
		var avgs1 = ((+co4) + (+co5) + (+co6))/3;
		$('#avg_com_2').val(avgs1.toFixed(2));
		}
		$('#comp').css("background-color","#3CAF35");
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
	$('#b4').change(function(){
		l4_l5_l6();
	});
	$('#b5').change(function(){
		l4_l5_l6();
	});
	$('#b6').change(function(){
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
	
	function l7_l8_l9()
	{
		if ($("#chk_com").is(':checked')) {
		
		l7 = $('#l7').val();
		l8 = $('#l8').val();
		l9 = $('#l9').val();
		b7 = $('#b7').val();
		b8 = $('#b8').val();
		b9 = $('#b9').val();
		
		area_7 = (+l7) * (+b7);  
		area_8 = (+l8) * (+b8);  
		area_9 = (+l9) * (+b9);
		
		$('#area_7').val(area_7.toFixed(2));
		$('#area_8').val(area_8.toFixed(2));
		$('#area_9').val(area_9.toFixed(2));
		
		var area7 = $('#area_7').val();
		var area8 = $('#area_8').val();
		var area9 = $('#area_9').val();		
		
		com_7 = $('#com_7').val();
		com_8 = $('#com_8').val();
		com_9 = $('#com_9').val();
		
		avg_com_3 = ((+com_7) + (+com_8) + (+com_9))/3;
		$('#avg_com_3').val(avg_com_3.toFixed(2));
		
		load_7 = ((+area7) *  (+com_7)) / 1000;
		load_8 = ((+area8) *  (+com_8)) / 1000;
		load_9 = ((+area9) *  (+com_9)) / 1000;
		
		$('#load_7').val(load_7.toFixed(1));
		$('#load_8').val(load_8.toFixed(1));
		$('#load_9').val(load_9.toFixed(1));
		}
		$('#comp').css("background-color","#3CAF35");

	}
	
	$('#avg_com_3').change(function(){
		if ($("#chk_com").is(':checked')) {
		avg_com_3 = $('#avg_com_3').val();
		com_7 = (+avg_com_3) + 0.93;
		com_8 = (+avg_com_3) - 0.71;
		com_9 = (+avg_com_3) + 0.08;
		$('#com_7').val(com_7.toFixed(2));
		$('#com_8').val(com_8.toFixed(2));
		$('#com_9').val(com_9.toFixed(2));
		
		var com7 = $('#com_7').val();
		var com8 = $('#com_8').val();
		var com9 = $('#com_9').val();
		
		l7 = $('#l7').val();
		l8 = $('#l8').val();
		l9 = $('#l9').val();
		b7 = $('#b7').val();
		b8 = $('#b8').val();
		b9 = $('#b9').val();
		
		area_7 = (+l7) * (+b7);  
		area_8 = (+l8) * (+b8);  
		area_9 = (+l9) * (+b9);
		
		$('#area_7').val(area_7.toFixed(2));
		$('#area_8').val(area_8.toFixed(2));
		$('#area_9').val(area_9.toFixed(2));
		
		var area7 = $('#area_7').val();
		var area8 = $('#area_8').val();
		var area9 = $('#area_9').val();		
		
		
		load_7 = ((+area7) *  (+com7)) / 1000;
		load_8 = ((+area8) *  (+com8)) / 1000;
		load_9 = ((+area9) *  (+com9)) / 1000;
		
		$('#load_7').val(load_7.toFixed(1));
		$('#load_8').val(load_8.toFixed(1));
		$('#load_9').val(load_7.toFixed(1));
		
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
		
		var avgs2 = ((+co7) + (+co8) + (+co9))/3;
		$('#avg_com_3').val(avgs2.toFixed(2));
		}
		$('#comp').css("background-color","#3CAF35");
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
	$('#b7').change(function(){
		l7_l8_l9();
	});
	$('#b8').change(function(){
		l7_l8_l9();
	});
	$('#b9').change(function(){
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
	$('#weight_of_cement').change(function(){
		$('#comp').css("background-color","#3CAF35");
		var consis = $('#final_consistency').val();
			var temp = ((parseFloat(consis)/4)+3);
			weight_of_water = (parseFloat(temp)*8);
			$('#weight_of_water').val(weight_of_water.toFixed(1));
	});
	$('#weight_of_sand').change(function(){
		$('#comp').css("background-color","#3CAF35");
		var consis = $('#final_consistency').val();
			var temp = ((parseFloat(consis)/4)+3);
			weight_of_water = (parseFloat(temp)*8);
			$('#weight_of_water').val(weight_of_water.toFixed(1));
	});
	$('#weight_of_water').change(function(){
		$('#comp').css("background-color","#3CAF35");
		
	});
	
	
	
	
	
	function chem_auto()
	{
		$('#chemi').css("background-color","#3CAF35");
		
			//CAO
			var cao1 = randomNumberFromRange(1.0001,1.0002).toFixed(4);
			$('#cao1').val(cao1);
			var cao_1 = $('#cao1').val();
			var cao2 = randomNumberFromRange(29.9715,29.9719).toFixed(4);
			$('#cao2').val(cao2);
			var cao_2 = $('#cao2').val();
			var cao3 = randomNumberFromRange(29.9817,30.0917).toFixed(4);
			$('#cao3').val(cao3);
			var cao_3 = $('#cao3').val();
			
			var caocal1 = ((+cao_3) - (+cao_2));
			var caocal2 = ((+caocal1) / (+cao_1));
			var caocal3 = ((+caocal2) * (+100));			
			$('#cao4').val(caocal3.toFixed(2));
			var cao_4 = $('#cao4').val();
			
			
			//SO
			var so1 = randomNumberFromRange(1.0001,1.0002).toFixed(4);
			$('#so1').val(so1);
			var so_1 = $('#so1').val();
			var so2 = randomNumberFromRange(29.9715,29.9719).toFixed(4);
			$('#so2').val(so2);
			var so_2 = $('#so2').val();
			var so3 = randomNumberFromRange(29.9862,30.0591).toFixed(4);
			$('#so3').val(so3);
			var so_3 = $('#so3').val();
			
			var socal1 = ((+so_3) - (+so_2));
			var socal2 = ((+socal1) / (+so_1));
			var socal3 = ((+socal2) * (+34.3));			
			$('#so4').val(socal3.toFixed(2));
			var so_4 = $('#so4').val();
			
			//R2O3
			var r2o1 = randomNumberFromRange(1.0001,1.0002).toFixed(4);
			$('#r2o1').val(r2o1);
			var r2o_1 = $('#r2o1').val();
			var r2o2 = randomNumberFromRange(29.9716,29.9719).toFixed(4);
			$('#r2o2').val(r2o2);
			var r2o_2 = $('#r2o2').val();
			var r2o3 = randomNumberFromRange(30.1817,30.2519).toFixed(4);
			$('#r2o3').val(r2o3);
			var r2o_3 = $('#r2o3').val();
			var r2o4 = (+r2o_3) - (+randomNumberFromRange(0.0001,0.0005));
			$('#r2o4').val(r2o4.toFixed(4));
			var r2o_4 = $('#r2o4').val();
			
			var r2ocal1 = ((+r2o_3) - (+r2o_2));
			var r2ocal2 = ((+r2ocal1) / (+r2o_1));
			var r2ocal3 = ((+r2ocal2) * (+100));			
			$('#r2o5').val(r2ocal3.toFixed(2));
			var r2o_5 = $('#r2o5').val();
			
			var r2ocal11 = ((+r2o_3) - (+r2o_4));
			var r2ocal21 = ((+r2ocal11) / (+r2o_1));
			var r2ocal31 = ((+r2ocal21) * (+100));			
			$('#r2o6').val(r2ocal31.toFixed(2));
			var r2o_6 = $('#r2o6').val();
			
			var r2o7 = (+r2o_5)-(+r2o_6);
			$('#r2o7').val(r2o7.toFixed(2));
			var r2o_7 = $('#r2o7').val();
			
			
			//sio
			var sio1 = randomNumberFromRange(1.0001,1.0002).toFixed(4);
			$('#sio1').val(sio1);
			var sio_1 = $('#sio1').val();
			var sio2 = randomNumberFromRange(29.9716,29.9719).toFixed(4);
			$('#sio2').val(sio2);
			var sio_2 = $('#sio2').val();
			var sio3 = randomNumberFromRange(30.5217,30.5917).toFixed(4);
			$('#sio3').val(sio3);
			var sio_3 = $('#sio3').val();
			var sio4 = (+sio_3) - (+randomNumberFromRange(0.0001,0.0005));
			$('#sio4').val(sio4.toFixed(4));
			var sio_4 = $('#sio4').val();
			
			var siocal1 = ((+sio_3) - (+sio_2));
			var siocal2 = ((+siocal1) / (+sio_1));
			var siocal3 = ((+siocal2) * (+100));			
			$('#sio5').val(siocal3.toFixed(2));
			var sio_5 = $('#sio5').val();
			
			var siocal11 = ((+sio_3) - (+sio_4));
			var siocal21 = ((+siocal11) / (+sio_1));
			var siocal31 = ((+siocal21) * (+100));			
			$('#sio6').val(siocal31.toFixed(2));
			var sio_6 = $('#sio6').val();
			
			var sior7 = (+sio_5) - (+sio_6);
			$('#sior7').val((+sior7).toFixed(2));
			var sior7 = $('#sior7').val();
			
			var sio7 = (+sior7)+(+r2o_6);
			$('#sio7').val(sio7.toFixed(2));
			var sio_7 = $('#sio7').val();
			
			
			//Fe2O3
			var feo1 = randomNumberFromRange(1.0001,1.0002).toFixed(4);
			$('#feo1').val(feo1);
			var feo_1 = $('#feo1').val();
			var feo2 = randomNumberFromRange(2.5,6.5).toFixed(1);
			$('#feo2').val(feo2);
			var feo_2 = $('#feo2').val();
			
			
			var feocal1 = ((+0.7985) * (+feo_2));
			var feocal2 = ((+feocal1) / (+feo_1));					
			$('#feo3').val(feocal2.toFixed(2));
			var feo_3 = $('#feo3').val();
			
			
			//AL2O3
			var alo1 = (+r2o_7) - (+feo_3);
			$('#alo1').val(alo1.toFixed(2));
			var alo_1 = $('#alo1').val();
			
			//RATION
			var ratio1 = ((+sio_7) + (+r2o_7));
			$('#per1').val((+ratio1).toFixed(2));
			var per_1 = $('#per1').val();
			
			/*var ratio1 = ((+cao_4) - ((+0.7)*(+so_4)));
			var ratio2 = (+sio_7) + (+alo_1) + (+feo_3);
			var ans = (+ratio1) / (+ratio2);
			$('#per1').val(ratio2.toFixed(2));
			var per_1 = $('#per1').val();*/
			
			
			//RES
			var res1 = randomNumberFromRange(1.0001,1.0002).toFixed(4);
			$('#res1').val(res1);
			var res_1 = $('#res1').val();
			var res2 = randomNumberFromRange(29.9703,29.9703).toFixed(4);
			$('#res2').val(res2);
			var res_2 = $('#res2').val();
			var res3 = randomNumberFromRange(29.9812,29.9815).toFixed(4);
			$('#res3').val(res3);
			var res_3 = $('#res3').val();
			
			var rescal1 = ((+res_3) - (+res_2));
			var rescal2 = ((+rescal1) / (+res_1));
			var rescal3 = ((+rescal2) * (+100));			
			$('#res4').val(rescal3.toFixed(2));
			var res_4 = $('#res4').val();
			
			//MGO
			var mgo1 = randomNumberFromRange(1.0001,1.0002).toFixed(4);
			$('#mgo1').val(mgo1);
			var mgo_1 = $('#mgo1').val();
			var mgo2 = randomNumberFromRange(29.9715,29.9719).toFixed(4);
			$('#mgo2').val(mgo2);
			var mgo_2 = $('#mgo2').val();
			var mgo3 = randomNumberFromRange(29.9993,30.0545).toFixed(4);
			$('#mgo3').val(mgo3);
			var mgo_3 = $('#mgo3').val();
			
			var mgocal1 = ((+mgo_3) - (+mgo_2));
			var mgocal2 = ((+mgocal1) / (+mgo_1));
			var mgocal3 = ((+mgocal2) * (+36.22));			
			$('#mgo4').val(mgocal3.toFixed(2));
			var mgo_4 = $('#mgo4').val();
			
			//Loss on heat
			var ig1 = randomNumberFromRange(1.0001,1.0002).toFixed(4);
			$('#ig1').val(ig1);
			var ig_1 = $('#ig1').val();
			var ig2 = randomNumberFromRange(29.9714,29.9719).toFixed(4);
			$('#ig2').val(ig2);
			var ig_2 = $('#ig2').val();
			var igw2 = (+ig_1) + (+ig_2);
			$('#igw2').val((+igw2).toFixed(4));
			
			var ig3 = randomNumberFromRange(30.9302,30.9422).toFixed(4);
			$('#ig3').val(ig3);
			var ig_3 = $('#ig3').val();
			
			var igcal1 = ( ((+ig_2) + (+ig_1)) - (+ig_3));
			var igcal2 = ((+igcal1) / (+ig_1));
			var igcal3 = ((+igcal2) * (+100));			
			$('#ig4').val(igcal3.toFixed(2));
			var ig_4 = $('#ig4').val();
			
			
			
			//cloride
			var cl1 = randomNumberFromRange(2.0001,2.0002).toFixed(4);
			$('#cl1').val(cl1);
			var cl_1 = $('#cl1').val();
			var cl2 = randomNumberFromRange(9.8,9.9).toFixed(1);
			$('#cl2').val(cl2);
			var cl_2 = $('#cl2').val();
			
			var cl3 = randomNumberFromRange(0.01,0.02).toFixed(2);
			$('#cl3').val(cl3);
			var cl_3 = $('#cl3').val();
			
			
			
			var cl4 = (+10) - ((+cl_2) - (+cl_3));
			$('#cl4').val((+cl4).toFixed(2));
			var cl_4 = $('#cl4').val();
			
			var cl5 = 0.025;
			$('#cl5').val(cl5);
			var cl_5 = $('#cl5').val();
			
			
			
			var clcal1 = ((+cl_4) * (+0.03546) * (+cl_5) * (+100));
			var clcal2 = ((+clcal1) / (+cl_1));					
			$('#cl6').val(clcal2.toFixed(3));
			var cl_6 = $('#cl6').val();
			
			
			
			//alkali
			var alk_1 = randomNumberFromRange(5.0008,5.0008).toFixed(4);
			$('#alk1').val(alk_1);
			var alk1 = $('#alk1').val();
			var alk_2 = randomNumberFromRange(0.2,1.5).toFixed(2);
			$('#alk2').val(alk_2);
			var alk2 = $('#alk2').val();
			var alk_3 = alk_2;
			$('#alk3').val(alk_3);
			var alk3 = $('#alk3').val();
			var alk_4 = alk_2;
			$('#alk4').val(alk_4);
			var alk4 = $('#alk4').val();
			
			var alk_5 = randomNumberFromRange(1.000,1.000).toFixed(3);
			$('#alk5').val(alk_5);
			var alk5 = $('#alk5').val();
			
			var alk_8 = randomNumberFromRange(0.41,0.43).toFixed(2);
			$('#alk8').val(alk_8);
			var alk8 = $('#alk8').val();
			var alk_6 = alk_8;
			$('#alk6').val(alk_6);
			var alk6 = $('#alk6').val();			
			var alk_7 = alk_8;
			$('#alk7').val(alk_7);
			var alk7 = $('#alk7').val();
			
			
	}
	
	$('#cao1,#cao2,#cao3,#so1,#so2,#so3,#r2o1,#r2o2,#r2o3,#r2o4,#sio1,#sio2,#sio3,#sio4,#feo1,#feo2,#res1,#res2,#res3,#mgo1,#mgo2,#mgo3,#ig1,#igw2,#ig2,#ig3,#cl1,#cl2,#cl3').change(function(){
		$('#chemi').css("background-color","#3CAF35");
		//CAO			
			var cao_1 = $('#cao1').val();			
			var cao_2 = $('#cao2').val();			
			var cao_3 = $('#cao3').val();
			
			var caocal1 = ((+cao_3) - (+cao_2));
			var caocal2 = ((+caocal1) / (+cao_1));
			var caocal3 = ((+caocal2) * (+100));			
			$('#cao4').val(caocal3.toFixed(2));
			var cao_4 = $('#cao4').val();
			
			
			//SO			
			var so_1 = $('#so1').val();			
			var so_2 = $('#so2').val();			
			var so_3 = $('#so3').val();
			
			var socal1 = ((+so_3) - (+so_2));
			var socal2 = ((+socal1) / (+so_1));
			var socal3 = ((+socal2) * (+34.3));			
			$('#so4').val(socal3.toFixed(2));
			var so_4 = $('#so4').val();
			
			//R2O3			
			var r2o_1 = $('#r2o1').val();			
			var r2o_2 = $('#r2o2').val();			
			var r2o_3 = $('#r2o3').val();			
			var r2o_4 = $('#r2o4').val();
			
			var r2ocal1 = ((+r2o_3) - (+r2o_2));
			var r2ocal2 = ((+r2ocal1) / (+r2o_1));
			var r2ocal3 = ((+r2ocal2) * (+100));			
			$('#r2o5').val(r2ocal3.toFixed(2));
			var r2o_5 = $('#r2o5').val();
			
			
			var r2ocal11 = ((+r2o_3) - (+r2o_4));
			var r2ocal21 = ((+r2ocal11) / (+r2o_1));
			var r2ocal31 = ((+r2ocal21) * (+100));			
			$('#r2o6').val(r2ocal31.toFixed(2));
			var r2o_6 = $('#r2o6').val();
			
			var r2o7 = (+r2o_5)-(+r2o_6);
			$('#r2o7').val(r2o7.toFixed(2));
			var r2o_7 = $('#r2o7').val();
			
			
			//sio
		
			var sio_1 = $('#sio1').val();
			var sio_2 = $('#sio2').val();
			var sio_3 = $('#sio3').val();
			var sio_4 = $('#sio4').val();
			
			var siocal1 = ((+sio_3) - (+sio_2));
			var siocal2 = ((+siocal1) / (+sio_1));
			var siocal3 = ((+siocal2) * (+100));			
			$('#sio5').val(siocal3.toFixed(2));
			var sio_5 = $('#sio5').val();
			
			var siocal11 = ((+sio_3) - (+sio_4));
			var siocal21 = ((+siocal11) / (+sio_1));
			var siocal31 = ((+siocal21) * (+100));			
			$('#sio6').val(siocal31.toFixed(2));
			var sio_6 = $('#sio6').val();
			
			var sio7 = (+sio_6)+(+r2o_7);
			$('#sio7').val(sio7.toFixed(2));
			var sio_7 = $('#sio7').val();
			
			var sio_5 = $('#sio5').val();
			var sio_6 = $('#sio6').val();
			var sior7 = (+sio_5) - (+sio_6);
			$('#sior7').val((+sior7).toFixed(2));
			var sior7 = $('#sior7').val();
			var r2o6 = $('#r2o6').val();
			
			var sio7 = (+sior7) + (+r2o6);
			$('#sio7').val((+sio7).toFixed(2));
			var sio_7 = $('#sio7').val();
			
			//Fe2O3
			var feo_1 = $('#feo1').val();
			var feo_2 = $('#feo2').val();
			
			
			var feocal1 = ((+0.7985) * (+feo_2));
			var feocal2 = ((+feocal1) / (+feo_1));					
			$('#feo3').val(feocal2.toFixed(2));
			var feo_3 = $('#feo3').val();
			
			
			//AL2O3
			var alo1 = (+r2o_7) - (+feo_3);
			$('#alo1').val(alo1.toFixed(2));
			var alo_1 = $('#alo1').val();
			
			//RATION
			var ratio1 = ((+sio_7) + (+r2o_7));
			$('#per1').val((+ratio1).toFixed(2));
			var per_1 = $('#per1').val();
			
			/*//RATION
			var ratio1 = ((+cao_4) - ((+0.7)*(+so_4)));
			var ratio2 = (((+2.8)*(+sio_7)) + ((+1.2)*(+alo_1)) + ((+0.65) * (+feo_3)));
			var ans = (+ratio1) / (+ratio2);
			$('#per1').val(ans.toFixed(2));
			var per_1 = $('#per1').val();*/
			
			
			//RES
			var res_1 = $('#res1').val();
			var res_2 = $('#res2').val();
			var res_3 = $('#res3').val();
			
			var rescal1 = ((+res_3) - (+res_2));
			var rescal2 = ((+rescal1) / (+res_1));
			var rescal3 = ((+rescal2) * (+100));			
			$('#res4').val(rescal3.toFixed(2));
			var res_4 = $('#res4').val();
			
			//MGO
			var mgo_1 = $('#mgo1').val();
			var mgo_2 = $('#mgo2').val();
			var mgo_3 = $('#mgo3').val();
			
			var mgocal1 = ((+mgo_3) - (+mgo_2));
			var mgocal2 = ((+mgocal1) / (+mgo_1));
			var mgocal3 = ((+mgocal2) * (+36.22));			
			$('#mgo4').val(mgocal3.toFixed(2));
			var mgo_4 = $('#mgo4').val();
			
			//Loss on heat
			var ig_1 = $('#ig1').val();
			var ig_2 = $('#ig2').val();
			var ig_3 = $('#ig3').val();
			var igw2 = $('#igw2').val();
			
			var igcal1 = ((+igw2) - (+ig_3));
			var igcal2 = ((+igcal1) / (+ig_1));
			var igcal3 = ((+igcal2) * (+100));			
			$('#ig4').val(igcal3.toFixed(2));
			var ig_4 = $('#ig4').val();
			
			//cloride
			var cl_1 = $('#cl1').val();
			var cl_2 = $('#cl2').val();
			var cl_3 = $('#cl3').val();
			
			var cl4 = (+10) - ((+cl_2) - (+cl_3));
			$('#cl4').val(cl4.toFixed(2));
			var cl_4 = $('#cl4').val();
			
			var cl5 = 0.1;
			$('#cl5').val(cl5);
			var cl_5 = $('#cl5').val();
			
			var clcal1 = ((+cl_4) * (+0.03546) * (+cl_5) * (+100));
			var clcal2 = ((+clcal1) / (+cl_1));					
			$('#cl6').val(clcal2.toFixed(3));
			var cl_6 = $('#cl6').val();
	});
	
	$('#chk_che').change(function(){
		 if(this.checked)
		{  
			chem_auto();
		}
		else
		{
			$('#cao1').val(null);
			$('#cao2').val(null);
			$('#cao3').val(null);
			$('#cao4').val(null);
			
			$('#so1').val(null);
			$('#so2').val(null);
			$('#so3').val(null);
			$('#so4').val(null);
			
			
			
			$('#r2o1').val(null);
			$('#r2o2').val(null);
			$('#r2o3').val(null);
			$('#r2o4').val(null);
			$('#r2o5').val(null);
			$('#r2o6').val(null);
			$('#r2o7').val(null);
			
			$('#sio1').val(null);
			$('#sio2').val(null);
			$('#sio3').val(null);
			$('#sio4').val(null);
			$('#sio5').val(null);
			$('#sio6').val(null);
			$('#sio7').val(null);
			
			$('#feo1').val(null);
			$('#feo2').val(null);
			$('#feo3').val(null);
			
			$('#sio1').val(null);
			$('#sio2').val(null);
			$('#sio3').val(null);
			$('#sio4').val(null);
			
			
			
			
			$('#alo1').val(null);
			$('#alo2').val(null);
			$('#alo3').val(null);
			$('#alo4').val(null);
			$('#alo5').val(null);
			
			$('#res1').val(null);
			$('#res2').val(null);
			$('#res3').val(null);
			$('#res4').val(null);
			
			$('#mgo1').val(null);
			$('#mgo2').val(null);
			$('#mgo3').val(null);
			$('#mgo4').val(null);
			
			$('#ig1').val(null);
			$('#ig2').val(null);
			$('#ig3').val(null);
			$('#ig4').val(null);
			
			$('#cl1').val(null);
			$('#cl2').val(null);
			$('#cl3').val(null);
			$('#cl4').val(null);
			$('#cl5').val(null);
			$('#cl6').val(null);
			
		}
	});
	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			//$('#txtabr').css("background-color","#3CAF35"); 
			//$('#txtwtr').css("background-color","#3CAF35"); 
			
			
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				//Consistency
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="con")
					{
						$('#consis').css("background-color","#3CAF35");
						$("#chk_con").prop("checked", true); 
						consistency_auto();
						break;
					}					
				}
				
				//Soundness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="sou")
					{
						
						$("#chk_sou").prop("checked", true); 
						soundness_auto();
						break;
					}					
				}
		
				//SETTING TIME
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="set")
					{
						
						$("#chk_set").prop("checked", true); 
						set_auto();
						break;
					}					
				}
				
				//DENSITY
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="den")
					{
						
						$("#chk_den").prop("checked", true); 
						den_auto();
						break;
					}					
				}
				//FINES
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{
						
						$("#chk_fines").prop("checked", true); 
						fines_auto();
						break;
					}					
				}
				//DRY SIEVEING
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fbs")
					{
						
						$("#chk_fbs").prop("checked", true); 
						fbs_auto();
						break;
					}					
				}
				//FINES
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="che")
					{
						
						$("#chk_che").prop("checked", true); 
						chem_auto();
						break;
					}					
				}
				//COMPRESSIVE
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						
						$("#chk_com").prop("checked", true); 
						com_auto();
						com_3_day();
						com_7_day();
						com_28_day();
						break;
					}					
				}
		
		
		}
		
	});
	
	
	
});

	
function saveIs(type,test,material_category,material_id)
{
	 /*if (type == 'update_che') {
		 
		 var rat_test_method = $('#rat_test_method').val();
		 var rat_test_req = $('#rat_test_req').val();
		 var rat_test_limit = $('#rat_test_limit').val() +","+$('#alu_test_limit').val()+","+$('#ins_test_limit').val()+","+$('#mang_test_limit').val()+","+$('#tot_test_limit').val()+","+$('#los_test_limit').val()+","+$('#alk_test_limit').val()+","+$('#chl_test_limit').val()+","+$('#tit_test_limit').val()+","+$('#sul_test_limit').val(); 
		 
			  $.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_test_data.php',
			data: 'action_type=add&test='+test+'&material_category='+material_category+'&material_id='+material_id+'&test_method='+rat_test_method+'&req_is='+rat_test_req+'&req_limit='+rat_test_limit,
			dataType: 'JSON',
			success:function(msg){
			   //get_is_data();
		
				}
			});		 		 
			}*/
	
}
	
	
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
        url: '<?php echo $base_url; ?>saveflyashchemical.php',
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
				var cement_grade = $('#cement_grade').val();
				var cement_brand = $('#cement_brand').val();
				var type_of_cement = $('#type_of_cement').val();
				var week_number= $('#week_number').val();
				var report_date = $('#report_date').val();
				var rem_data = $('#rem_data').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				//Consistency
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
							
							var con_date_test = $('#con_date_test').val();
							var con_temp = $('#con_temp').val();
							var con_humidity = $('#con_humidity').val();							
							var con_weight = $('#con_weight').val();							
							var vol_1 = $('#vol_1').val();							
							var vol_2 = $('#vol_2').val();							
							var vol_3 = $('#vol_3').val();							
							var vol_4 = $('#vol_4').val();							
							var vol_5 = $('#vol_5').val();							
							var vol_6 = $('#vol_6').val();							
							var vol_7 = $('#vol_7').val();

							var wtr_1 = $('#wtr_1').val();							
							var wtr_2 = $('#wtr_2').val();							
							var wtr_3 = $('#wtr_3').val();							
							var wtr_4 = $('#wtr_4').val();							
							var wtr_5 = $('#wtr_5').val();							
							var wtr_6 = $('#wtr_6').val();							
							var wtr_7 = $('#wtr_7').val();
							
							var reading_1 = $('#reading_1').val();							
							var reading_2 = $('#reading_2').val();							
							var reading_3 = $('#reading_3').val();							
							var reading_4 = $('#reading_4').val();							
							var reading_5 = $('#reading_5').val();							
							var reading_6 = $('#reading_6').val();							
							var reading_7 = $('#reading_7').val();
							
							var remark_1 = $('#remark_1').val();							
							var remark_2 = $('#remark_2').val();							
							var remark_3 = $('#remark_3').val();							
							var remark_4 = $('#remark_4').val();							
							var remark_5 = $('#remark_5').val();							
							var remark_6 = $('#remark_6').val();							
							var remark_7 = $('#remark_7').val();
							var final_consistency = $('#final_consistency').val();
						break;
					}
					else
					{
							var chk_con = "0";
							var con_date_test = "00/00/0000";
							var con_temp = "0";
							var con_humidity = "0";
							var con_weight = "0";
							var vol_1 = "0";
							var vol_2 = "0";
							var vol_3 = "0";
							var vol_4 = "0";
							var vol_5 = "0";
							var vol_6 = "0";
							var vol_7 = "0";

							var wtr_1 = "0";
							var wtr_2 = "0";
							var wtr_3 = "0";
							var wtr_4 = "0";
							var wtr_5 = "0";
							var wtr_6 = "0";
							var wtr_7 = "0";
							
							var reading_1 = "0";
							var reading_2 = "0";
							var reading_3 = "0";
							var reading_4 = "0";
							var reading_5 = "0";
							var reading_6 = "0";
							var reading_7 = "0";
							
							var remark_1 = "0";							
							var remark_2 = "0";							
							var remark_3 = "0";							
							var remark_4 = "0";						
							var remark_5 = "0";							
							var remark_6 = "0";							
							var remark_7 = "0";
							var final_consistency = "0";
						
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
							var sou_date_test = $('#sou_date_test').val();							
							var sou_temp = $('#sou_temp').val();
							var sou_humidity = $('#sou_humidity').val();							
							var sou_water = $('#sou_water').val();							
							var sou_weight = $('#sou_weight').val();							
							var dis_1_1 = $('#dis_1_1').val();							
							var dis_1_2 = $('#dis_1_2').val();							
							var dis_2_1 = $('#dis_2_1').val();							
							var dis_2_2 = $('#dis_2_2').val();	
							var diff_1 = $('#diff_1').val();							
							var diff_2 = $('#diff_2').val();							
							var soundness = $('#soundness').val();							
						break;
					}
					else
					{
						
						var chk_sou = "0";	
						var sou_date_test ="00/00/0000";
						var sou_temp ="0";
						var sou_humidity ="0";
						var sou_water ="0";
						var sou_weight ="0";
						var dis_1_1 ="0";
						var dis_1_2 ="0";
						var dis_2_1 ="0";
						var dis_2_2 ="0";
						var diff_1 ="0";
						var diff_2 ="0";
						var soundness ="0";
						
					}
														
				}
				
				
				//Setting Time
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="set")
					{
						if(document.getElementById('chk_set').checked) {
								var chk_set = "1";
						}
						else{
								var chk_set = "0";
						}
							var set_date_test = $('#set_date_test').val();
							var set_temp = $('#set_temp').val();
							var set_wtr = $('#set_wtr').val();							
							var set_humidity = $('#set_humidity').val();							
							var hr_a = $('#hr_a').val();							
							var hr_b = $('#hr_b').val();							
							var hr_c = $('#hr_c').val();
							var initial_time = $('#initial_time').val();							
							var final_time = $('#final_time').val();							
							var set_weight = $('#set_weight').val();							
						break;
					}
					else
					{
						var chk_set = "0";	
						var set_date_test ="00/00/0000";
						var set_temp ="0";
						var set_wtr ="0";
						var set_humidity ="0";
						var hr_a ="0";
						var hr_b ="0";
						var hr_c ="0";
						var initial_time ="0";
						var final_time ="0";
						var set_weight ="0";
						
					}
														
				}
				
				//density
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="den")
					{
						if(document.getElementById('chk_den').checked) {
								var chk_den = "1";
						}
						else{
								var chk_den = "0";
						}
							var den_date_test = $('#den_date_test').val();
							var den_temp = $('#den_temp').val();
							var den_humidity = $('#den_humidity').val();							
							var den_intial = $('#den_intial').val();							
							var den_intial1 = $('#den_intial1').val();							
							var den_intial2 = $('#den_intial2').val();							
							var den_final = $('#den_final').val();							
							var den_final1 = $('#den_final1').val();							
							var den_final2 = $('#den_final2').val();							
							var den_displaced = $('#den_displaced').val();							
							var den_displaced1 = $('#den_displaced1').val();							
							var den_displaced2 = $('#den_displaced2').val();							
							var density = $('#density').val();							
							var avg_density = $('#avg_density').val();							
							var density1 = $('#density1').val();							
							var density2 = $('#density2').val();							
							var den_m2 = $('#den_m2').val();							
							var den_m3 = $('#den_m3').val();							
							var den_d = $('#den_d').val();							
							var den_volume = $('#den_volume').val();							
							var den_weight = $('#den_weight').val();							
						break;
					}
					else
					{
						var chk_den = "0";	
						var den_date_test ="00/00/0000";
						var den_temp ="0";
						var den_humidity ="0";
						var den_intial ="0";
						var den_intial1 ="0";
						var den_intial2 ="0";
						var den_final ="0";
						var den_final1 ="0";
						var den_final2 ="0";
						var den_displaced ="0";
						var den_displaced1 ="0";
						var den_displaced2 ="0";
						var density ="0";
						var density1 ="0";
						var density2 ="0";
						var avg_density ="0";
						var den_m2 ="0";
						var den_m3 ="0";
						var den_d ="0";
						var den_volume="0";
						var den_weight="0";
					}
														
				}
				
				//Fineness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{
						if(document.getElementById('chk_fines').checked) {
								var chk_fines = "1";
						}
						else{
								var chk_fines = "0";
						}
							var constant_k = $('#constant_k').val();
							var constant_k_1 = $('#constant_k_1').val();
							var fines_t_1 = $('#fines_t_1').val();
							var fines_t_2 = $('#fines_t_2').val();
							var fines_t_3 = $('#fines_t_3').val();
							var avg_fines_time = $('#avg_fines_time').val();							
						//	var avg_fines_time_1 = $('#avg_fines_time_1').val();							
							var ss_area = $('#ss_area').val();							
							var fine_temp = $('#fine_temp').val();							
							var fine_humidity = $('#fine_humidity').val();							
							//var ss_area_1 = $('#ss_area_1').val();							
							/*var w_t_1 = $('#w_t_1').val();							
							var w_t_2 = $('#w_t_2').val();							
							var w_t_3 = $('#w_t_3').val();
							var d_t_1 = $('#d_t_1').val();							
							var d_t_2 = $('#d_t_2').val();							
							var d_t_3 = $('#d_t_3').val();	
							var c_t_1 = $('#c_t_1').val();							
							var c_t_2 = $('#c_t_2').val();							
							var c_t_3 = $('#c_t_3').val();							*/
							var fines_val1 = $('#fines_val1').val();							
							var fines_val2 = $('#fines_val2').val();							
						break;
					}
					else
					{
						var chk_fines = "0";	
						var constant_k ="0";
						var constant_k_1 ="0";
						var fines_t_1 ="0";
						var fines_t_2 ="0";
						var fines_t_3 ="0";
						var avg_fines_time ="0";
						//var avg_fines_time_1 ="0";
						var ss_area ="0";
						var fine_temp ="0";
						var fine_humidity ="0";						
						//var ss_area_1 ="0";
						/* var w_t_1 ="0";
						var w_t_2 ="0";
						var w_t_3 ="0";
						var d_t_1 ="0";
						var d_t_2 ="0";
						var d_t_3 ="0";
						var c_t_1 ="0";
						var c_t_2 ="0";
						var c_t_3 ="0"; */
						var fines_val1 ="0";
						var fines_val2 ="0";
						
					}
														
				}

				
				//Compressive
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
						
						
							var com_date_test = $('#com_date_test').val();
							var com_temp = $('#com_temp').val();
							var com_humidity = $('#com_humidity').val();							
							var weight_of_cement = $('#weight_of_cement').val();							
							var weight_of_sand = $('#weight_of_sand').val();							
							var weight_of_water = $('#weight_of_water').val();							
							var sp_1 = $('#sp_1').val();							
							var sp_2 = $('#sp_2').val();							
							var sp_3 = $('#sp_3').val();							
							var caste_date1 = $('#caste_date1').val();							
							var caste_date2 = $('#caste_date2').val();							
							var caste_date3 = $('#caste_date3').val();							
							var test_date1 = $('#test_date1').val();							
							var test_date2 = $('#test_date2').val();							
							var test_date3 = $('#test_date3').val();
							var day_1 = $('#day_1').val();							
							var day_2 = $('#day_2').val();							
							var day_3 = $('#day_3').val();	
							var avg_com_1 = $('#avg_com_1').val();							
							var avg_com_2 = $('#avg_com_2').val();							
							var avg_com_3 = $('#avg_com_3').val();	
							var l1 = $('#l1').val();
							var l2 = $('#l2').val();
							var l3 = $('#l3').val();
							var l4 = $('#l4').val();
							var l5 = $('#l5').val();
							var l6 = $('#l6').val();
							var l7 = $('#l7').val();
							var l8 = $('#l8').val();
							var l9 = $('#l9').val();
							
							var b1 = $('#b1').val();
							var b2 = $('#b2').val();
							var b3 = $('#b3').val();
							var b4 = $('#b4').val();
							var b5 = $('#b5').val();
							var b6 = $('#b6').val();
							var b7 = $('#b7').val();
							var b8 = $('#b8').val();
							var b9 = $('#b9').val();
							
							var h1 = $('#h1').val();
							var h2 = $('#h2').val();
							var h3 = $('#h3').val();
							var h4 = $('#h4').val();
							var h5 = $('#h5').val();
							var h6 = $('#h6').val();
							var h7 = $('#h7').val();
							var h8 = $('#h8').val();
							var h9 = $('#h9').val();
							
							var area_1 = $('#area_1').val();
							var area_2 = $('#area_2').val();
							var area_3 = $('#area_3').val();
							var area_4 = $('#area_4').val();
							var area_5 = $('#area_5').val();
							var area_6 = $('#area_6').val();
							var area_7 = $('#area_7').val();
							var area_8 = $('#area_8').val();
							var area_9 = $('#area_9').val();
							
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
						break;
					}
					else
					{
						var chk_com = "0";	
						/* var chk_chk3 = "0";	
						var chk_chk2 = "0";	
						var chk_chk1 = "0"; */	
						var com_date_test ="0";
						var com_temp ="0";
						var com_humidity ="0";
						var weight_of_cement ="0";
						var weight_of_sand ="0";
						var weight_of_water ="0";
						var sp_1 ="0";
						var sp_2 ="0";
						var sp_3 ="0";
						var caste_date1 ="00/00/0000";
						var caste_date2 ="00/00/0000";
						var caste_date3 ="00/00/0000";
						var test_date1 ="00/00/0000";
						var test_date2 ="00/00/0000";
						var test_date3 ="00/00/0000";
						var day_1 ="0";
						var day_2 ="0";
						var day_3 ="0";
						
						var avg_com_1 = "0";
						var avg_com_2 = "0";
						var avg_com_3 = "0";
						var l1 = "0";
						var l2 = "0";
						var l3 = "0";
						var l4 = "0";
						var l5 = "0";
						var l6 = "0";
						var l7 = "0";
						var l8 = "0";
						var l9 = "0";
						
						var b1 = "0";
						var b2 = "0";
						var b3 = "0";
						var b4 = "0";
						var b5 = "0";
						var b6 = "0";
						var b7 = "0";
						var b8 = "0";
						var b9 = "0";
						
						var h1 = "0";
						var h2 = "0";
						var h3 = "0";
						var h4 = "0";
						var h5 = "0";
						var h6 = "0";
						var h7 = "0";
						var h8 = "0";
						var h9 = "0";
						
						var area_1 = "0";
						var area_2 = "0";
						var area_3 = "0";
						var area_4 = "0";
						var area_5 = "0";
						var area_6 = "0";
						var area_7 = "0";
						var area_8 = "0";
						var area_9 = "0";
						
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
					}
														
				}
				
				//chemical test
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="che")
					{
						if(document.getElementById('chk_che').checked) {
								var chk_che = "1";
						}
						else{
								var chk_che = "0";
						}
																
							var cao1 = $('#cao1').val();
							var cao2 = $('#cao2').val();
							var cao3 = $('#cao3').val();
							var cao4 = $('#cao4').val();
							
							var so1 = $('#so1').val();
							var so2 = $('#so2').val();
							var so3 = $('#so3').val();
							var so4 = $('#so4').val();
							
							var sio1 = $('#sio1').val();
							var sio2 = $('#sio2').val();
							var sio3 = $('#sio3').val();
							var sio4 = $('#sio4').val();
							var sio5 = $('#sio5').val();
							var sio6 = $('#sio6').val();
							var sio7 = $('#sio7').val();
							
							var r2o1 = $('#r2o1').val();
							var r2o2 = $('#r2o2').val();
							var r2o3 = $('#r2o3').val();
							var r2o4 = $('#r2o4').val();
							var r2o5 = $('#r2o5').val();
							var r2o6 = $('#r2o6').val();
							var r2o7 = $('#r2o7').val();
							
							var feo1 = $('#feo1').val();
							var feo2 = $('#feo2').val();
							var feo3 = $('#feo3').val();
							
							var alo1 = $('#alo1').val();
							var per1 = $('#per1').val();
							
							var res1 = $('#res1').val();
							var res2 = $('#res2').val();
							var res3 = $('#res3').val();
							var res4 = $('#res4').val();
							
							var mgo1 = $('#mgo1').val();
							var mgo2 = $('#mgo2').val();
							var mgo3 = $('#mgo3').val();
							var mgo4 = $('#mgo4').val();
							
							var ig1 = $('#ig1').val();
							var ig2 = $('#ig2').val();
							var ig3 = $('#ig3').val();
							var ig4 = $('#ig4').val();
							
							var cl1 = $('#cl1').val();
							var cl2 = $('#cl2').val();
							var cl3 = $('#cl3').val();
							var cl4 = $('#cl4').val();
							var cl5 = $('#cl5').val();
							var cl6 = $('#cl6').val();
							
							var alk1 = $('#alk1').val();
							var alk2 = $('#alk2').val();
							var alk3 = $('#alk3').val();
							var alk4 = $('#alk4').val();
							var alk5 = $('#alk5').val();
							var alk6 = $('#alk6').val();
							var alk7 = $('#alk7').val();
							var alk8 = $('#alk8').val();
							
							var com_test_method = $('#com_test_method').val();
							var com_test_req = $('#com_test_req').val();
							var com_test_limit_1 = $('#com_test_limit_1').val();
							var com_test_limit_2 = $('#com_test_limit_2').val();
							
							var sio_test_method = $('#sio_test_method').val();
							var sio_test_req = $('#sio_test_req').val();
							var sio_test_limit_1 = $('#sio_test_limit_1').val();
							var sio_test_limit_2 = $('#sio_test_limit_2').val();
							
							var mang_test_method = $('#mang_test_method').val();
							var mang_test_req = $('#mang_test_req').val();
							var mang_test_limit_1 = $('#mang_test_limit_1').val();
							var mang_test_limit_2 = $('#mang_test_limit_2').val();
							
							var tot_test_method = $('#tot_test_method').val();
							var tot_test_req = $('#tot_test_req').val();
							var tot_test_limit_1 = $('#tot_test_limit_1').val();
							var tot_test_limit_2 = $('#tot_test_limit_2').val();
							
							var alk_test_method = $('#alk_test_method').val();
							var alk_test_req = $('#alk_test_req').val();
							var alk_test_limit_1 = $('#alk_test_limit_1').val();
							var alk_test_limit_2 = $('#alk_test_limit_2').val();
							
							var chl_test_method = $('#chl_test_method').val();
							var chl_test_req = $('#chl_test_req').val();
							var chl_test_limit_1 = $('#chl_test_limit_1').val();
							var chl_test_limit_2 = $('#chl_test_limit_2').val();
							
							var los_test_method = $('#los_test_method').val();
							var los_test_req = $('#los_test_req').val();
							var los_test_limit_1 = $('#los_test_limit_1').val();
							var los_test_limit_2 = $('#los_test_limit_2').val();
							
							
						
							
						break;
					}
					else
					{
						var chk_che = "0";	
						var cao1 = "";
						var cao2 = "";
						var cao3 = "";
						var cao4 = "";
						
						var so1 = "";
						var so2 = "";
						var so3 = "";
						var so4 = "";
						
						var sio1 = "";
						var sio2 = "";
						var sio3 = "";
						var sio4 = "";
						var sio5 = "";
						var sio6 = "";
						var sio7 = "";
						
						var r2o1 = "";
						var r2o2 = "";
						var r2o3 = "";
						var r2o4 = "";
						var r2o5 = "";
						var r2o6 = "";
						var r2o7 = "";
						
						var feo1 = "";
						var feo2 = "";
						var feo3 = "";
						
						var alo1 = "";
						var per1 = "";
						
						var res1 = "";
						var res2 = "";
						var res3 = "";
						var res4 = "";
						
						var mgo1 = "";
						var mgo2 = "";
						var mgo3 = "";
						var mgo4 = "";
						
						var ig1 = "";
						var ig2 = "";
						var ig3 = "";
						var ig4 = "";
						
						var cl1 = "";
						var cl2 = "";
						var cl3 = "";
						var cl4 = "";
						var cl5 = "";
						var cl6 = "";
						
						var alk1 = "";
						var alk2 = "";
						var alk3 = "";
						var alk4 = "";
						var alk5 = "";
						var alk6 = "";
						var alk7 = "";
						var alk8 = "";
						
						var com_test_method = "";
						var com_test_req = "";
						var com_test_limit_1 = "";
						var com_test_limit_2 = "";
						
						var sio_test_method = "";
						var sio_test_req = "";
						var sio_test_limit_1 = "";
						var sio_test_limit_2 = "";
						
						var mang_test_method = "";
						var mang_test_req = "";
						var mang_test_limit_1 = "";
						var mang_test_limit_2 = "";
						
						var tot_test_method = "";
						var tot_test_req = "";
						var tot_test_limit_1 = "";
						var tot_test_limit_2 = "";
						
						var alk_test_method = "";
						var alk_test_req = "";
						var alk_test_limit_1 = "";
						var alk_test_limit_2 = "";
						
						var chl_test_method = "";
						var chl_test_req = "";
						var chl_test_limit_1 = "";
						var chl_test_limit_2 = "";
						
						var los_test_method = "";
						var los_test_req = "";
						var los_test_limit_1 = "";
						var los_test_limit_2 = "";
						
					}
														
				}
					
				//Fineness by dry
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fbs")
					{
						if(document.getElementById('chk_fbs').checked) {
								var chk_fbs = "1";
						}
						else{
								var chk_fbs = "0";
						}
							var fbs_temp = $('#fbs_temp').val();							
							var fbs_humidity = $('#fbs_humidity').val();	
							
							var fbs_w1 = $('#fbs_w1').val();
							var fbs_w2 = $('#fbs_w2').val();
							
							var fbs_m1 = $('#fbs_m1').val();
							var fbs_m2 = $('#fbs_m2').val();
							
							var fbs_p1 = $('#fbs_p1').val();
							var fbs_p2 = $('#fbs_p2').val();
							var avg_fbs = $('#avg_fbs').val();
							
														
						break;
					}
					else
					{
						var chk_fbs = "0";	
						var fbs_temp = "";							
						var fbs_humidity = "";	
						
						var fbs_w1 = "";
						var fbs_w2 = "";
						
						var fbs_m1 = "";
						var fbs_m2 = "";
						
						var fbs_p1 = "";
						var fbs_p2 = "";
						var avg_fbs = "";
						
					}
														
				}
	
					
					billData = '&action_type='+type+'&report_no='+report_no+'&ulr='+ulr+'&job_no='+job_no+'&lab_no='+lab_no+'&cement_grade='+cement_grade+'&type_of_cement='+type_of_cement+'&cement_brand='+cement_brand+'&week_number='+week_number+'&chk_con='+chk_con+'&con_date_test='+con_date_test+'&report_date='+report_date+'&con_temp='+con_temp+'&con_humidity='+con_humidity+'&con_weight='+con_weight+'&vol_1='+vol_1+'&vol_2='+vol_2+'&vol_3='+vol_3+'&vol_4='+vol_4+'&vol_5='+vol_5+'&vol_6='+vol_6+'&vol_7='+vol_7+'&wtr_1='+wtr_1+'&wtr_2='+wtr_2+'&wtr_3='+wtr_3+'&wtr_4='+wtr_4+'&wtr_5='+wtr_5+'&wtr_6='+wtr_6+'&wtr_7='+wtr_7+'&reading_1='+reading_1+'&reading_2='+reading_2+'&reading_3='+reading_3+'&reading_4='+reading_4+'&reading_5='+reading_5+'&reading_6='+reading_6+'&reading_7='+reading_7+'&remark_1='+remark_1+'&remark_2='+remark_2+'&remark_3='+remark_3+'&remark_4='+remark_4+'&remark_5='+remark_5+'&remark_6='+remark_6+'&remark_7='+remark_7+'&final_consistency='+final_consistency+'&chk_sou='+chk_sou+'&sou_date_test='+sou_date_test+'&sou_humidity='+sou_humidity+'&sou_temp='+sou_temp+'&sou_water='+sou_water+'&sou_weight='+sou_weight+'&soundness='+soundness+'&dis_1_1='+dis_1_1+'&dis_1_2='+dis_1_2+'&dis_2_1='+dis_2_1+'&dis_2_2='+dis_2_2+'&diff_1='+diff_1+'&diff_2='+diff_2+'&chk_set='+chk_set+'&set_date_test='+set_date_test+'&set_weight='+set_weight+'&set_temp='+set_temp+'&set_wtr='+set_wtr+'&set_humidity='+set_humidity+'&hr_a='+hr_a+'&hr_b='+hr_b+'&hr_c='+hr_c+'&initial_time='+initial_time+'&final_time='+final_time+'&chk_den='+chk_den+'&den_date_test='+den_date_test+'&den_temp='+den_temp+'&den_humidity='+den_humidity+'&den_intial='+den_intial+'&den_final='+den_final+'&den_displaced='+den_displaced+'&density='+density+'&den_m2='+den_m2+'&den_m3='+den_m3+'&den_d='+den_d+'&den_volume='+den_volume+'&den_weight='+den_weight+'&chk_fines='+chk_fines+'&fines_t_1='+fines_t_1+'&fines_t_2='+fines_t_2+'&fines_t_3='+fines_t_3+'&avg_fines_time='+avg_fines_time+'&constant_k='+constant_k+'&constant_k_1='+constant_k_1+'&ss_area='+ss_area+'&chk_com='+chk_com+'&com_date_test='+com_date_test+'&com_temp='+com_temp+'&com_humidity='+com_humidity+'&weight_of_cement='+weight_of_cement+'&weight_of_sand='+weight_of_sand+'&weight_of_water='+weight_of_water+'&sp_1='+sp_1+'&sp_2='+sp_2+'&sp_3='+sp_3+'&caste_date1='+caste_date1+'&caste_date2='+caste_date2+'&caste_date3='+caste_date3+'&test_date1='+test_date1+'&test_date2='+test_date2+'&test_date3='+test_date3+'&day_1='+day_1+'&day_2='+day_2+'&day_3='+day_3+'&avg_com_1='+avg_com_1+'&avg_com_2='+avg_com_2+'&avg_com_3='+avg_com_3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&l6='+l6+'&l7='+l7+'&l8='+l8+'&l9='+l9+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&b4='+b4+'&b5='+b5+'&b6='+b6+'&b7='+b7+'&b8='+b8+'&b9='+b9+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&h4='+h4+'&h5='+h5+'&h6='+h6+'&h7='+h7+'&h8='+h8+'&h9='+h9+'&area_1='+area_1+'&area_2='+area_2+'&area_3='+area_3+'&area_4='+area_4+'&area_5='+area_5+'&area_6='+area_6+'&area_7='+area_7+'&area_8='+area_8+'&area_9='+area_9+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&load_6='+load_6+'&load_7='+load_7+'&load_8='+load_8+'&load_9='+load_9+'&com_1='+com_1+'&com_2='+com_2+'&com_3='+com_3+'&com_4='+com_4+'&com_5='+com_5+'&com_6='+com_6+'&com_7='+com_7+'&com_8='+com_8+'&com_9='+com_9+'&fines_val1='+fines_val1+'&fines_val2='+fines_val2+'&den_intial1='+den_intial1+'&den_intial2='+den_intial2+'&den_final1='+den_final1+'&den_final2='+den_final2+'&den_displaced1='+den_displaced1+'&den_displaced2='+den_displaced2+'&density1='+density1+'&density2='+density2+'&avg_density='+avg_density+'&fine_temp='+fine_temp+'&fine_humidity='+fine_humidity+'&chk_che='+chk_che+'&cao1='+cao1+'&cao2='+cao2+'&cao3='+cao3+'&cao4='+cao4+'&so1='+so1+'&so2='+so2+'&so3='+so3+'&so4='+so4+'&sio1='+sio1+'&sio2='+sio2+'&sio3='+sio3+'&sio4='+sio4+'&sio5='+sio5+'&sio6='+sio6+'&sio7='+sio7+'&r2o1='+r2o1+'&r2o2='+r2o2+'&r2o3='+r2o3+'&r2o4='+r2o4+'&r2o5='+r2o5+'&r2o6='+r2o6+'&r2o7='+r2o7+'&feo1='+feo1+'&feo2='+feo2+'&feo3='+feo3+'&alo1='+alo1+'&per1='+per1+'&res1='+res1+'&res2='+res2+'&res3='+res3+'&res4='+res4+'&mgo1='+mgo1+'&mgo2='+mgo2+'&mgo3='+mgo3+'&mgo4='+mgo4+'&ig1='+ig1+'&ig2='+ig2+'&ig3='+ig3+'&ig4='+ig4+'&cl1='+cl1+'&cl2='+cl2+'&cl3='+cl3+'&cl4='+cl4+'&cl5='+cl5+'&cl6='+cl6+'&chk_fbs='+chk_fbs+'&fbs_temp='+fbs_temp+'&fbs_humidity='+fbs_humidity+'&fbs_w1='+fbs_w1+'&fbs_w2='+fbs_w2+'&fbs_m1='+fbs_m1+'&fbs_m2='+fbs_m2+'&fbs_p1='+fbs_p1+'&fbs_p2='+fbs_p2+'&avg_fbs='+avg_fbs+'&alk1='+alk1+'&alk2='+alk2+'&alk3='+alk3+'&alk4='+alk4+'&alk5='+alk5+'&alk6='+alk6+'&alk7='+alk7+'&alk8='+alk8+'&com_test_method='+com_test_method+'&com_test_req='+com_test_req+'&com_test_limit_1='+com_test_limit_1+'&com_test_limit_2='+com_test_limit_2+'&sio_test_method='+sio_test_method+'&sio_test_req='+sio_test_req+'&sio_test_limit_1='+sio_test_limit_1+'&sio_test_limit_2='+sio_test_limit_2+'&mang_test_method='+mang_test_method+'&mang_test_req='+mang_test_req+'&mang_test_limit_1='+mang_test_limit_1+'&mang_test_limit_2='+mang_test_limit_2+'&tot_test_method='+tot_test_method+'&tot_test_req='+tot_test_req+'&tot_test_limit_1='+tot_test_limit_1+'&tot_test_limit_2='+tot_test_limit_2+'&alk_test_method='+alk_test_method+'&alk_test_req='+alk_test_req+'&alk_test_limit_1='+alk_test_limit_1+'&alk_test_limit_2='+alk_test_limit_2+'&chl_test_method='+chl_test_method+'&chl_test_req='+chl_test_req+'&chl_test_limit_1='+chl_test_limit_1+'&chl_test_limit_2='+chl_test_limit_2+'&los_test_method='+los_test_method+'&los_test_req='+los_test_req+'&los_test_limit_1='+los_test_limit_1+'&los_test_limit_2='+los_test_limit_2+'&rem_data='+rem_data+'&amend_date='+amend_date;
					
					
					
					
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var cement_grade = $('#cement_grade').val();
				var cement_brand = $('#cement_brand').val();
				var type_of_cement = $('#type_of_cement').val();
				var week_number= $('#week_number').val();
				var report_date = $('#report_date').val();
				var ulr = $('#ulr').val();
				var amend_date = $('#amend_date').val();
				var rem_data = $('#rem_data').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				//Consistency
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
							var con_date_test = $('#con_date_test').val();
							var con_temp = $('#con_temp').val();
							var con_humidity = $('#con_humidity').val();							
							var con_weight = $('#con_weight').val();							
							var vol_1 = $('#vol_1').val();							
							var vol_2 = $('#vol_2').val();							
							var vol_3 = $('#vol_3').val();							
							var vol_4 = $('#vol_4').val();							
							var vol_5 = $('#vol_5').val();							
							var vol_6 = $('#vol_6').val();							
							var vol_7 = $('#vol_7').val();

							var wtr_1 = $('#wtr_1').val();							
							var wtr_2 = $('#wtr_2').val();							
							var wtr_3 = $('#wtr_3').val();							
							var wtr_4 = $('#wtr_4').val();							
							var wtr_5 = $('#wtr_5').val();							
							var wtr_6 = $('#wtr_6').val();							
							var wtr_7 = $('#wtr_7').val();
							
							var reading_1 = $('#reading_1').val();							
							var reading_2 = $('#reading_2').val();							
							var reading_3 = $('#reading_3').val();							
							var reading_4 = $('#reading_4').val();							
							var reading_5 = $('#reading_5').val();							
							var reading_6 = $('#reading_6').val();							
							var reading_7 = $('#reading_7').val();
							
							var remark_1 = $('#remark_1').val();							
							var remark_2 = $('#remark_2').val();							
							var remark_3 = $('#remark_3').val();							
							var remark_4 = $('#remark_4').val();							
							var remark_5 = $('#remark_5').val();							
							var remark_6 = $('#remark_6').val();							
							var remark_7 = $('#remark_7').val();
							var final_consistency = $('#final_consistency').val();
						break;
					}
					else
					{
							var chk_con = "0";
							var con_date_test = "00/00/0000";
							var con_temp = "0";
							var con_humidity = "0";
							var con_weight = "0";
							var vol_1 = "0";
							var vol_2 = "0";
							var vol_3 = "0";
							var vol_4 = "0";
							var vol_5 = "0";
							var vol_6 = "0";
							var vol_7 = "0";

							var wtr_1 = "0";
							var wtr_2 = "0";
							var wtr_3 = "0";
							var wtr_4 = "0";
							var wtr_5 = "0";
							var wtr_6 = "0";
							var wtr_7 = "0";
							
							var reading_1 = "0";
							var reading_2 = "0";
							var reading_3 = "0";
							var reading_4 = "0";
							var reading_5 = "0";
							var reading_6 = "0";
							var reading_7 = "0";
							
							var remark_1 = "0";							
							var remark_2 = "0";							
							var remark_3 = "0";							
							var remark_4 = "0";						
							var remark_5 = "0";							
							var remark_6 = "0";							
							var remark_7 = "0";
							var final_consistency = "0";
						
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
							var sou_date_test = $('#sou_date_test').val();
							var sou_temp = $('#sou_temp').val();
							var sou_humidity = $('#sou_humidity').val();							
							var sou_water = $('#sou_water').val();							
							var sou_weight = $('#sou_weight').val();							
							var dis_1_1 = $('#dis_1_1').val();							
							var dis_1_2 = $('#dis_1_2').val();							
							var dis_2_1 = $('#dis_2_1').val();							
							var dis_2_2 = $('#dis_2_2').val();	
							var diff_1 = $('#diff_1').val();							
							var diff_2 = $('#diff_2').val();							
							var soundness = $('#soundness').val();							
						break;
					}
					else
					{
						var chk_sou = "0";	
						var sou_date_test ="00/00/0000";
						var sou_temp ="0";
						var sou_humidity ="0";
						var sou_water ="0";
						var sou_weight ="0";
						var dis_1_1 ="0";
						var dis_1_2 ="0";
						var dis_2_1 ="0";
						var dis_2_2 ="0";
						var diff_1 ="0";
						var diff_2 ="0";
						var soundness ="0";
						
					}
														
				}
				
				
				//Setting Time
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="set")
					{
						if(document.getElementById('chk_set').checked) {
								var chk_set = "1";
						}
						else{
								var chk_set = "0";
						}
							var set_date_test = $('#set_date_test').val();
							var set_temp = $('#set_temp').val();
							var set_wtr = $('#set_wtr').val();							
							var set_humidity = $('#set_humidity').val();							
							var hr_a = $('#hr_a').val();							
							var hr_b = $('#hr_b').val();							
							var hr_c = $('#hr_c').val();
							var initial_time = $('#initial_time').val();							
							var final_time = $('#final_time').val();							
							var set_weight = $('#set_weight').val();							
						break;
					}
					else
					{
						var chk_set = "0";	
						var set_date_test ="00/00/0000";
						var set_temp ="0";
						var set_wtr ="0";
						var set_humidity ="0";
						var hr_a ="0";
						var hr_b ="0";
						var hr_c ="0";
						var initial_time ="0";
						var final_time ="0";
						var set_weight ="0";
						
					}
														
				}
				
				//density
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="den")
					{
						if(document.getElementById('chk_den').checked) {
								var chk_den = "1";
						}
						else{
								var chk_den = "0";
						}
							var den_date_test = $('#den_date_test').val();
							var den_temp = $('#den_temp').val();
							var den_humidity = $('#den_humidity').val();							
							var den_intial = $('#den_intial').val();							
							var den_intial1 = $('#den_intial1').val();							
							var den_intial2 = $('#den_intial2').val();							
							var den_final = $('#den_final').val();							
							var den_final1 = $('#den_final1').val();							
							var den_final2 = $('#den_final2').val();							
							var den_displaced = $('#den_displaced').val();							
							var den_displaced1 = $('#den_displaced1').val();							
							var den_displaced2 = $('#den_displaced2').val();							
							var density = $('#density').val();							
							var avg_density = $('#avg_density').val();							
							var density1 = $('#density1').val();							
							var density2 = $('#density2').val();							
							var den_m2 = $('#den_m2').val();							
							var den_m3 = $('#den_m3').val();							
							var den_d = $('#den_d').val();							
							var den_volume = $('#den_volume').val();							
							var den_weight = $('#den_weight').val();							
						break;
					}
					else
					{
						var chk_den = "0";	
						var den_date_test ="00/00/0000";
						var den_temp ="0";
						var den_humidity ="0";
						var den_intial ="0";
						var den_intial1 ="0";
						var den_intial2 ="0";
						var den_final ="0";
						var den_final1 ="0";
						var den_final2 ="0";
						var den_displaced ="0";
						var den_displaced1 ="0";
						var den_displaced2 ="0";
						var density ="0";
						var density1 ="0";
						var density2 ="0";
						var avg_density ="0";
						var den_m2 ="0";
						var den_m3 ="0";
						var den_d ="0";
						var den_volume="0";
						var den_weight="0";
					}
														
				}
				
				//Fineness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{
						if(document.getElementById('chk_fines').checked) {
								var chk_fines = "1";
						}
						else{
								var chk_fines = "0";
						}
							var constant_k = $('#constant_k').val();
							var constant_k_1 = $('#constant_k_1').val();
							var fines_t_1 = $('#fines_t_1').val();
							var fines_t_2 = $('#fines_t_2').val();
							var fines_t_3 = $('#fines_t_3').val();
							var avg_fines_time = $('#avg_fines_time').val();							
						//	var avg_fines_time_1 = $('#avg_fines_time_1').val();							
							var ss_area = $('#ss_area').val();							
							var fine_humidity = $('#fine_humidity').val();							
							var fine_temp = $('#fine_temp').val();							
							//var ss_area_1 = $('#ss_area_1').val();							
							/*var w_t_1 = $('#w_t_1').val();							
							var w_t_2 = $('#w_t_2').val();							
							var w_t_3 = $('#w_t_3').val();
							var d_t_1 = $('#d_t_1').val();							
							var d_t_2 = $('#d_t_2').val();							
							var d_t_3 = $('#d_t_3').val();	
							var c_t_1 = $('#c_t_1').val();							
							var c_t_2 = $('#c_t_2').val();							
							var c_t_3 = $('#c_t_3').val();*/
							var fines_val1 = $('#fines_val1').val();							
							var fines_val2 = $('#fines_val2').val();							
						break;
					}
					else
					{
						var chk_fines = "0";	
						var constant_k ="0";
						var constant_k_1 ="0";
						var fines_t_1 ="0";
						var fines_t_2 ="0";
						var fines_t_3 ="0";
						var avg_fines_time ="0";
						var fine_humidity ="0";
						var fine_temp ="0";
						//var avg_fines_time_1 ="0";
						var ss_area ="0";
						//var ss_area_1 ="0";
						/* var w_t_1 ="0";
						var w_t_2 ="0";
						var w_t_3 ="0";
						var d_t_1 ="0";
						var d_t_2 ="0";
						var d_t_3 ="0";
						var c_t_1 ="0";
						var c_t_2 ="0";
						var c_t_3 ="0"; */
						var fines_val1 ="0";
						var fines_val2 ="0";
						
					}
														
				}

				
				//Compressive
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
						
						/* if(document.getElementById('chk_chk1').checked) {
								var chk_chk1 = "1";
						}
						else{
								var chk_chk1 = "0";
						}
						
						if(document.getElementById('chk_chk2').checked) {
								var chk_chk2 = "1";
						}
						else{
								var chk_chk2 = "0";
						}
						
						if(document.getElementById('chk_chk3').checked) {
								var chk_chk3 = "1";
						}
						else{
								var chk_chk3 = "0";
						} */
							var com_date_test = $('#com_date_test').val();
							var com_temp = $('#com_temp').val();
							var com_humidity = $('#com_humidity').val();							
							var weight_of_cement = $('#weight_of_cement').val();							
							var weight_of_sand = $('#weight_of_sand').val();							
							var weight_of_water = $('#weight_of_water').val();							
							var sp_1 = $('#sp_1').val();							
							var sp_2 = $('#sp_2').val();							
							var sp_3 = $('#sp_3').val();							
							var caste_date1 = $('#caste_date1').val();							
							var caste_date2 = $('#caste_date2').val();							
							var caste_date3 = $('#caste_date3').val();							
							var test_date1 = $('#test_date1').val();							
							var test_date2 = $('#test_date2').val();							
							var test_date3 = $('#test_date3').val();
							var day_1 = $('#day_1').val();							
							var day_2 = $('#day_2').val();							
							var day_3 = $('#day_3').val();	
							var avg_com_1 = $('#avg_com_1').val();							
							var avg_com_2 = $('#avg_com_2').val();							
							var avg_com_3 = $('#avg_com_3').val();	
							var l1 = $('#l1').val();
							var l2 = $('#l2').val();
							var l3 = $('#l3').val();
							var l4 = $('#l4').val();
							var l5 = $('#l5').val();
							var l6 = $('#l6').val();
							var l7 = $('#l7').val();
							var l8 = $('#l8').val();
							var l9 = $('#l9').val();
							
							var b1 = $('#b1').val();
							var b2 = $('#b2').val();
							var b3 = $('#b3').val();
							var b4 = $('#b4').val();
							var b5 = $('#b5').val();
							var b6 = $('#b6').val();
							var b7 = $('#b7').val();
							var b8 = $('#b8').val();
							var b9 = $('#b9').val();
							
							var h1 = $('#h1').val();
							var h2 = $('#h2').val();
							var h3 = $('#h3').val();
							var h4 = $('#h4').val();
							var h5 = $('#h5').val();
							var h6 = $('#h6').val();
							var h7 = $('#h7').val();
							var h8 = $('#h8').val();
							var h9 = $('#h9').val();
							
							var area_1 = $('#area_1').val();
							var area_2 = $('#area_2').val();
							var area_3 = $('#area_3').val();
							var area_4 = $('#area_4').val();
							var area_5 = $('#area_5').val();
							var area_6 = $('#area_6').val();
							var area_7 = $('#area_7').val();
							var area_8 = $('#area_8').val();
							var area_9 = $('#area_9').val();
							
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
						break;
					}
					else
					{
						var chk_com = "0";	
						/* var chk_chk3 = "0";	
						var chk_chk2 = "0";	
						var chk_chk1 = "0";	 */
						var com_date_test ="0";
						var com_temp ="0";
						var com_humidity ="0";
						var weight_of_cement ="0";
						var weight_of_sand ="0";
						var weight_of_water ="0";
						var sp_1 ="0";
						var sp_2 ="0";
						var sp_3 ="0";
						var caste_date1 ="00/00/0000";
						var caste_date2 ="00/00/0000";
						var caste_date3 ="00/00/0000";
						var test_date1 ="00/00/0000";
						var test_date2 ="00/00/0000";
						var test_date3 ="00/00/0000";
						var day_1 ="0";
						var day_2 ="0";
						var day_3 ="0";
						
						var avg_com_1 = "0";
						var avg_com_2 = "0";
						var avg_com_3 = "0";
						var l1 = "0";
						var l2 = "0";
						var l3 = "0";
						var l4 = "0";
						var l5 = "0";
						var l6 = "0";
						var l7 = "0";
						var l8 = "0";
						var l9 = "0";
						
						var b1 = "0";
						var b2 = "0";
						var b3 = "0";
						var b4 = "0";
						var b5 = "0";
						var b6 = "0";
						var b7 = "0";
						var b8 = "0";
						var b9 = "0";
						
						var h1 = "0";
						var h2 = "0";
						var h3 = "0";
						var h4 = "0";
						var h5 = "0";
						var h6 = "0";
						var h7 = "0";
						var h8 = "0";
						var h9 = "0";
						
						var area_1 = "0";
						var area_2 = "0";
						var area_3 = "0";
						var area_4 = "0";
						var area_5 = "0";
						var area_6 = "0";
						var area_7 = "0";
						var area_8 = "0";
						var area_9 = "0";
						
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
					}
														
				}
				
				//chemical test
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="che")
					{
						if(document.getElementById('chk_che').checked) {
								var chk_che = "1";
						}
						else{
								var chk_che = "0";
						}
																
							var cao1 = $('#cao1').val();
							var cao2 = $('#cao2').val();
							var cao3 = $('#cao3').val();
							var cao4 = $('#cao4').val();
							
							var so1 = $('#so1').val();
							var so2 = $('#so2').val();
							var so3 = $('#so3').val();
							var so4 = $('#so4').val();
							
							var sio1 = $('#sio1').val();
							var sio2 = $('#sio2').val();
							var sio3 = $('#sio3').val();
							var sio4 = $('#sio4').val();
							var sio5 = $('#sio5').val();
							var sio6 = $('#sio6').val();
							var sio7 = $('#sio7').val();
							
							var r2o1 = $('#r2o1').val();
							var r2o2 = $('#r2o2').val();
							var r2o3 = $('#r2o3').val();
							var r2o4 = $('#r2o4').val();
							var r2o5 = $('#r2o5').val();
							var r2o6 = $('#r2o6').val();
							var r2o7 = $('#r2o7').val();
							
							var feo1 = $('#feo1').val();
							var feo2 = $('#feo2').val();
							var feo3 = $('#feo3').val();
							
							var alo1 = $('#alo1').val();
							var per1 = $('#per1').val();
							
							var res1 = $('#res1').val();
							var res2 = $('#res2').val();
							var res3 = $('#res3').val();
							var res4 = $('#res4').val();
							
							var mgo1 = $('#mgo1').val();
							var mgo2 = $('#mgo2').val();
							var mgo3 = $('#mgo3').val();
							var mgo4 = $('#mgo4').val();
							
							var ig1 = $('#ig1').val();
							var ig2 = $('#ig2').val();
							var ig3 = $('#ig3').val();
							var ig4 = $('#ig4').val();
							
							var cl1 = $('#cl1').val();
							var cl2 = $('#cl2').val();
							var cl3 = $('#cl3').val();
							var cl4 = $('#cl4').val();
							var cl5 = $('#cl5').val();
							var cl6 = $('#cl6').val();
							
							var alk1 = $('#alk1').val();
							var alk2 = $('#alk2').val();
							var alk3 = $('#alk3').val();
							var alk4 = $('#alk4').val();
							var alk5 = $('#alk5').val();
							var alk6 = $('#alk6').val();
							var alk7 = $('#alk7').val();
							var alk8 = $('#alk8').val();
							
							var com_test_method = $('#com_test_method').val();
							var com_test_req = $('#com_test_req').val();
							var com_test_limit_1 = $('#com_test_limit_1').val();
							var com_test_limit_2 = $('#com_test_limit_2').val();
							
							var sio_test_method = $('#sio_test_method').val();
							var sio_test_req = $('#sio_test_req').val();
							var sio_test_limit_1 = $('#sio_test_limit_1').val();
							var sio_test_limit_2 = $('#sio_test_limit_2').val();
							
							var mang_test_method = $('#mang_test_method').val();
							var mang_test_req = $('#mang_test_req').val();
							var mang_test_limit_1 = $('#mang_test_limit_1').val();
							var mang_test_limit_2 = $('#mang_test_limit_2').val();
							
							var tot_test_method = $('#tot_test_method').val();
							var tot_test_req = $('#tot_test_req').val();
							var tot_test_limit_1 = $('#tot_test_limit_1').val();
							var tot_test_limit_2 = $('#tot_test_limit_2').val();
							
							var alk_test_method = $('#alk_test_method').val();
							var alk_test_req = $('#alk_test_req').val();
							var alk_test_limit_1 = $('#alk_test_limit_1').val();
							var alk_test_limit_2 = $('#alk_test_limit_2').val();
							
							var chl_test_method = $('#chl_test_method').val();
							var chl_test_req = $('#chl_test_req').val();
							var chl_test_limit_1 = $('#chl_test_limit_1').val();
							var chl_test_limit_2 = $('#chl_test_limit_2').val();
							
							var los_test_method = $('#los_test_method').val();
							var los_test_req = $('#los_test_req').val();
							var los_test_limit_1 = $('#los_test_limit_1').val();
							var los_test_limit_2 = $('#los_test_limit_2').val();
							
							
						
							
						break;
					}
					else
					{
						var chk_che = "0";	
						var cao1 = "";
						var cao2 = "";
						var cao3 = "";
						var cao4 = "";
						
						var so1 = "";
						var so2 = "";
						var so3 = "";
						var so4 = "";
						
						var sio1 = "";
						var sio2 = "";
						var sio3 = "";
						var sio4 = "";
						var sio5 = "";
						var sio6 = "";
						var sio7 = "";
						
						var r2o1 = "";
						var r2o2 = "";
						var r2o3 = "";
						var r2o4 = "";
						var r2o5 = "";
						var r2o6 = "";
						var r2o7 = "";
						
						var feo1 = "";
						var feo2 = "";
						var feo3 = "";
						
						var alo1 = "";
						var per1 = "";
						
						var res1 = "";
						var res2 = "";
						var res3 = "";
						var res4 = "";
						
						var mgo1 = "";
						var mgo2 = "";
						var mgo3 = "";
						var mgo4 = "";
						
						var ig1 = "";
						var ig2 = "";
						var ig3 = "";
						var ig4 = "";
						
						var cl1 = "";
						var cl2 = "";
						var cl3 = "";
						var cl4 = "";
						var cl5 = "";
						var cl6 = "";
						
						var alk1 = "";
						var alk2 = "";
						var alk3 = "";
						var alk4 = "";
						var alk5 = "";
						var alk6 = "";
						var alk7 = "";
						var alk8 = "";
						
						var com_test_method = "";
						var com_test_req = "";
						var com_test_limit_1 = "";
						var com_test_limit_2 = "";
						
						var sio_test_method = "";
						var sio_test_req = "";
						var sio_test_limit_1 = "";
						var sio_test_limit_2 = "";
						
						var mang_test_method = "";
						var mang_test_req = "";
						var mang_test_limit_1 = "";
						var mang_test_limit_2 = "";
						
						var tot_test_method = "";
						var tot_test_req = "";
						var tot_test_limit_1 = "";
						var tot_test_limit_2 = "";
						
						var alk_test_method = "";
						var alk_test_req = "";
						var alk_test_limit_1 = "";
						var alk_test_limit_2 = "";
						
						var chl_test_method = "";
						var chl_test_req = "";
						var chl_test_limit_1 = "";
						var chl_test_limit_2 = "";
						
						var los_test_method = "";
						var los_test_req = "";
						var los_test_limit_1 = "";
						var los_test_limit_2 = "";
						
					}
														
				}
					
				//Fineness by dry
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fbs")
					{
						if(document.getElementById('chk_fbs').checked) {
								var chk_fbs = "1";
						}
						else{
								var chk_fbs = "0";
						}
							var fbs_temp = $('#fbs_temp').val();							
							var fbs_humidity = $('#fbs_humidity').val();	
							
							var fbs_w1 = $('#fbs_w1').val();
							var fbs_w2 = $('#fbs_w2').val();
							
							var fbs_m1 = $('#fbs_m1').val();
							var fbs_m2 = $('#fbs_m2').val();
							
							var fbs_p1 = $('#fbs_p1').val();
							var fbs_p2 = $('#fbs_p2').val();
							var avg_fbs = $('#avg_fbs').val();
							
														
						break;
					}
					else
					{
						var chk_fbs = "0";	
						var fbs_temp = "";							
						var fbs_humidity = "";	
						
						var fbs_w1 = "";
						var fbs_w2 = "";
						
						var fbs_m1 = "";
						var fbs_m2 = "";
						
						var fbs_p1 = "";
						var fbs_p2 = "";
						var avg_fbs = "";
						
					}
														
				}
				
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&ulr='+ulr+'&job_no='+job_no+'&lab_no='+lab_no+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_number='+week_number+'&chk_con='+chk_con+'&con_date_test='+con_date_test+'&report_date='+report_date+'&con_temp='+con_temp+'&con_humidity='+con_humidity+'&con_weight='+con_weight+'&vol_1='+vol_1+'&vol_2='+vol_2+'&vol_3='+vol_3+'&vol_4='+vol_4+'&vol_5='+vol_5+'&vol_6='+vol_6+'&vol_7='+vol_7+'&wtr_1='+wtr_1+'&wtr_2='+wtr_2+'&wtr_3='+wtr_3+'&wtr_4='+wtr_4+'&wtr_5='+wtr_5+'&wtr_6='+wtr_6+'&wtr_7='+wtr_7+'&reading_1='+reading_1+'&reading_2='+reading_2+'&reading_3='+reading_3+'&reading_4='+reading_4+'&reading_5='+reading_5+'&reading_6='+reading_6+'&reading_7='+reading_7+'&remark_1='+remark_1+'&remark_2='+remark_2+'&remark_3='+remark_3+'&remark_4='+remark_4+'&remark_5='+remark_5+'&remark_6='+remark_6+'&remark_7='+remark_7+'&final_consistency='+final_consistency+'&chk_sou='+chk_sou+'&sou_date_test='+sou_date_test+'&sou_humidity='+sou_humidity+'&sou_temp='+sou_temp+'&sou_water='+sou_water+'&sou_weight='+sou_weight+'&soundness='+soundness+'&dis_1_1='+dis_1_1+'&dis_1_2='+dis_1_2+'&dis_2_1='+dis_2_1+'&dis_2_2='+dis_2_2+'&diff_1='+diff_1+'&diff_2='+diff_2+'&chk_set='+chk_set+'&set_date_test='+set_date_test+'&set_temp='+set_temp+'&set_wtr='+set_wtr+'&set_humidity='+set_humidity+'&hr_a='+hr_a+'&hr_b='+hr_b+'&hr_c='+hr_c+'&initial_time='+initial_time+'&final_time='+final_time+'&chk_den='+chk_den+'&den_date_test='+den_date_test+'&den_temp='+den_temp+'&den_humidity='+den_humidity+'&den_intial='+den_intial+'&den_final='+den_final+'&den_displaced='+den_displaced+'&density='+density+'&den_m2='+den_m2+'&den_m3='+den_m3+'&den_d='+den_d+'&den_volume='+den_volume+'&den_weight='+den_weight+'&chk_fines='+chk_fines+'&fines_t_1='+fines_t_1+'&fines_t_2='+fines_t_2+'&fines_t_3='+fines_t_3+'&avg_fines_time='+avg_fines_time+'&constant_k='+constant_k+'&constant_k_1='+constant_k_1+'&ss_area='+ss_area+'&chk_com='+chk_com+'&com_date_test='+com_date_test+'&com_temp='+com_temp+'&com_humidity='+com_humidity+'&weight_of_cement='+weight_of_cement+'&weight_of_sand='+weight_of_sand+'&weight_of_water='+weight_of_water+'&sp_1='+sp_1+'&sp_2='+sp_2+'&sp_3='+sp_3+'&caste_date1='+caste_date1+'&caste_date2='+caste_date2+'&caste_date3='+caste_date3+'&test_date1='+test_date1+'&test_date2='+test_date2+'&test_date3='+test_date3+'&day_1='+day_1+'&day_2='+day_2+'&day_3='+day_3+'&avg_com_1='+avg_com_1+'&avg_com_2='+avg_com_2+'&avg_com_3='+avg_com_3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&l6='+l6+'&l7='+l7+'&l8='+l8+'&l9='+l9+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&b4='+b4+'&b5='+b5+'&b6='+b6+'&b7='+b7+'&b8='+b8+'&b9='+b9+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&h4='+h4+'&h5='+h5+'&h6='+h6+'&h7='+h7+'&h8='+h8+'&h9='+h9+'&area_1='+area_1+'&area_2='+area_2+'&area_3='+area_3+'&area_4='+area_4+'&area_5='+area_5+'&area_6='+area_6+'&area_7='+area_7+'&area_8='+area_8+'&area_9='+area_9+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&load_6='+load_6+'&load_7='+load_7+'&load_8='+load_8+'&load_9='+load_9+'&com_1='+com_1+'&com_2='+com_2+'&com_3='+com_3+'&com_4='+com_4+'&com_5='+com_5+'&com_6='+com_6+'&com_7='+com_7+'&com_8='+com_8+'&com_9='+com_9+'&fines_val1='+fines_val1+'&fines_val2='+fines_val2+'&den_intial1='+den_intial1+'&den_intial2='+den_intial2+'&den_final1='+den_final1+'&den_final2='+den_final2+'&den_displaced1='+den_displaced1+'&den_displaced2='+den_displaced2+'&density1='+density1+'&density2='+density2+'&avg_density='+avg_density+'&fine_temp='+fine_temp+'&fine_humidity='+fine_humidity+'&chk_che='+chk_che+'&cao1='+cao1+'&cao2='+cao2+'&cao3='+cao3+'&cao4='+cao4+'&so1='+so1+'&so2='+so2+'&so3='+so3+'&so4='+so4+'&sio1='+sio1+'&sio2='+sio2+'&sio3='+sio3+'&sio4='+sio4+'&sio5='+sio5+'&sio6='+sio6+'&sio7='+sio7+'&r2o1='+r2o1+'&r2o2='+r2o2+'&r2o3='+r2o3+'&r2o4='+r2o4+'&r2o5='+r2o5+'&r2o6='+r2o6+'&r2o7='+r2o7+'&feo1='+feo1+'&feo2='+feo2+'&feo3='+feo3+'&alo1='+alo1+'&per1='+per1+'&res1='+res1+'&res2='+res2+'&res3='+res3+'&res4='+res4+'&mgo1='+mgo1+'&mgo2='+mgo2+'&mgo3='+mgo3+'&mgo4='+mgo4+'&ig1='+ig1+'&ig2='+ig2+'&ig3='+ig3+'&ig4='+ig4+'&cl1='+cl1+'&cl2='+cl2+'&cl3='+cl3+'&cl4='+cl4+'&cl5='+cl5+'&cl6='+cl6+'&chk_fbs='+chk_fbs+'&fbs_temp='+fbs_temp+'&fbs_humidity='+fbs_humidity+'&fbs_w1='+fbs_w1+'&fbs_w2='+fbs_w2+'&fbs_m1='+fbs_m1+'&fbs_m2='+fbs_m2+'&fbs_p1='+fbs_p1+'&fbs_p2='+fbs_p2+'&avg_fbs='+avg_fbs+'&alk1='+alk1+'&alk2='+alk2+'&alk3='+alk3+'&alk4='+alk4+'&alk5='+alk5+'&alk6='+alk6+'&alk7='+alk7+'&alk8='+alk8+'&com_test_method='+com_test_method+'&com_test_req='+com_test_req+'&com_test_limit_1='+com_test_limit_1+'&com_test_limit_2='+com_test_limit_2+'&sio_test_method='+sio_test_method+'&sio_test_req='+sio_test_req+'&sio_test_limit_1='+sio_test_limit_1+'&sio_test_limit_2='+sio_test_limit_2+'&mang_test_method='+mang_test_method+'&mang_test_req='+mang_test_req+'&mang_test_limit_1='+mang_test_limit_1+'&mang_test_limit_2='+mang_test_limit_2+'&tot_test_method='+tot_test_method+'&tot_test_req='+tot_test_req+'&tot_test_limit_1='+tot_test_limit_1+'&tot_test_limit_2='+tot_test_limit_2+'&alk_test_method='+alk_test_method+'&alk_test_req='+alk_test_req+'&alk_test_limit_1='+alk_test_limit_1+'&alk_test_limit_2='+alk_test_limit_2+'&chl_test_method='+chl_test_method+'&chl_test_req='+chl_test_req+'&chl_test_limit_1='+chl_test_limit_1+'&chl_test_limit_2='+chl_test_limit_2+'&los_test_method='+los_test_method+'&los_test_req='+los_test_req+'&los_test_limit_1='+los_test_limit_1+'&los_test_limit_2='+los_test_limit_2+'&rem_data='+rem_data+'&amend_date='+amend_date;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>saveflyashchemical.php',
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
        url: '<?php echo $base_url; ?>saveflyashchemical.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
            $('#idEdit').val(data.id);
	
	
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#type_of_cement').val(data.type_of_cement);
            $('#cement_brand').val(data.cement_brand);
            $('#cement_grade').val(data.cement_grade);
            $('#week_number').val(data.week_number);
			$('#report_date').val(data.report_date);
			$('#ulr').val(data.ulr);
			$('#amend_date').val(data.amend_date);
			$('#rem_data').val(data.rem_data);
            var temp = $('#test_list').val();
				var aa= temp.split(",");				
				
			//Consistency
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="con")
					{
						
						var chk_con = data.chk_con;
						if(chk_con=="1")
						{
							$('#consis').css("background-color","#3CAF35");
						   $("#chk_con").prop("checked", true); 
						}else{
							 $('#consis').css("background-color","white");
							$("#chk_con").prop("checked", false); 
						}
								
						$('#con_date_test').val(data.con_date_test);						
						$('#con_temp').val(data.con_temp);
						$('#con_humidity').val(data.con_humidity);
						$('#con_weight').val(data.con_weight);
						$('#final_consistency').val(data.final_consistency);
						$('#vol_1').val(data.vol_1);
						$('#vol_2').val(data.vol_2);
						$('#vol_3').val(data.vol_3);
						$('#vol_4').val(data.vol_4);
						$('#vol_5').val(data.vol_5);
						$('#vol_6').val(data.vol_6);
						$('#vol_7').val(data.vol_7);
						
						$('#wtr_1').val(data.wtr_1);
						$('#wtr_2').val(data.wtr_2);
						$('#wtr_3').val(data.wtr_3);
						$('#wtr_4').val(data.wtr_4);
						$('#wtr_5').val(data.wtr_5);
						$('#wtr_6').val(data.wtr_6);
						$('#wtr_7').val(data.wtr_7);
												
						$('#reading_1').val(data.reading_1);
						$('#reading_2').val(data.reading_2);
						$('#reading_3').val(data.reading_3);
						$('#reading_4').val(data.reading_4);
						$('#reading_5').val(data.reading_5);
						$('#reading_6').val(data.reading_6);
						$('#reading_7').val(data.reading_7);
						
						$('#remark_1').val(data.remark_1);
						$('#remark_2').val(data.remark_2);
						$('#remark_3').val(data.remark_3);
						$('#remark_4').val(data.remark_4);
						$('#remark_5').val(data.remark_5);
						$('#remark_6').val(data.remark_6);
						$('#remark_7').val(data.remark_7);
						
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
							$('#sound').css("background-color","#3CAF35");
						   $("#chk_sou").prop("checked", true); 
						}else{
							 $('#sound').css("background-color","white");
							$("#chk_sou").prop("checked", false); 
						}
								
						$('#sou_date_test').val(data.sou_date_test);						
						$('#sou_temp').val(data.sou_temp);
						$('#sou_humidity').val(data.sou_humidity);
						$('#sou_weight').val(data.sou_weight);
						$('#sou_water').val(data.sou_water);
						$('#dis_1_1').val(data.dis_1_1);
						$('#dis_1_2').val(data.dis_1_2);
						$('#dis_2_1').val(data.dis_2_1);
						$('#dis_2_2').val(data.dis_2_2);
						$('#diff_1').val(data.diff_1);
						$('#diff_2').val(data.diff_2);
						$('#soundness').val(data.soundness);
						
						
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
							$('#sett').css("background-color","#3CAF35");
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

				//Density
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="den")
					{
						
						var chk_den = data.chk_den;
						if(chk_den=="1")
						{
							$('#dens').css("background-color","#3CAF35");
						    $("#chk_den").prop("checked", true); 
						}else{
							$('#dens').css("background-color","white");
							$("#chk_den").prop("checked", false); 
						}
						
						$('#den_date_test').val(data.den_date_test);						
						$('#den_temp').val(data.den_temp);
						$('#den_humidity').val(data.den_humidity);						
						$('#den_intial').val(data.den_intial);
						$('#den_intial1').val(data.den_intial1);
						$('#den_intial2').val(data.den_intial2);
						$('#den_final').val(data.den_final);
						$('#den_final1').val(data.den_final1);
						$('#den_final2').val(data.den_final2);
						$('#den_displaced').val(data.den_displaced);
						$('#den_displaced1').val(data.den_displaced1);
						$('#den_displaced2').val(data.den_displaced2);
						$('#density').val(data.density);
						$('#density1').val(data.density1);
						$('#density2').val(data.density2);
						$('#avg_density').val(data.avg_density);
						$('#den_m2').val(data.den_m2);
						$('#den_m3').val(data.den_m3);
						$('#den_d').val(data.den_d);
						$('#den_volume').val(data.den_volume);
						$('#den_weight').val(data.den_weight);						
						
						
						break;
					}
					else
					{
						
					}
														
				}	

				//Fineness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fin")
					{
						
						var chk_fines = data.chk_fines;
						if(chk_fines=="1")
						{
							$('#fins').css("background-color","#3CAF35");
						   $("#chk_fines").prop("checked", true); 
						}else{
							 $('#fins').css("background-color","white");
							$("#chk_fines").prop("checked", false); 
						}
								
						$('#constant_k').val(data.constant_k);						
						$('#constant_k_1').val(data.constant_k_1);
						$('#fines_t_1').val(data.fines_t_1);						
						$('#fines_t_2').val(data.fines_t_2);
						$('#fines_t_3').val(data.fines_t_3);
						$('#avg_fines_time').val(data.avg_fines_time);
						$('#fine_temp').val(data.fine_temp);
						$('#fine_humidity').val(data.fine_humidity);
						$('#ss_area').val(data.ss_area);
						/* $('#ss_area_1').val(data.ss_area_1);
						$('#w_t_1').val(data.w_t_1);
						$('#w_t_2').val(data.w_t_2);
						$('#w_t_3').val(data.w_t_3);
						$('#d_t_1').val(data.d_t_1);
						$('#d_t_2').val(data.d_t_2);
						$('#d_t_3').val(data.d_t_3);
						$('#c_t_1').val(data.c_t_1);
						$('#c_t_2').val(data.c_t_2);
						$('#c_t_3').val(data.c_t_3); */
						$('#fines_val1').val(data.fines_val1);
						$('#fines_val2').val(data.fines_val2);
						
						break;
					}
					else
					{
						
					}
														
				}	

				//Fineness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="fbs")
					{
						
						var chk_fbs = data.chk_fbs;
						if(chk_fbs=="1")
						{
							$('#txtfbs').css("background-color","#3CAF35");
						   $("#chk_fbs").prop("checked", true); 
						}else{
							 $('#txtfbs').css("background-color","white");
							$("#chk_fbs").prop("checked", false); 
						}
								
						
						$('#fbs_temp').val(data.fbs_temp);
						$('#fbs_humidity').val(data.fbs_humidity);
						
						$('#fbs_w1').val(data.fbs_w1);
						$('#fbs_w2').val(data.fbs_w2);
						$('#fbs_m1').val(data.fbs_m1);
						$('#fbs_m2').val(data.fbs_m2);
						$('#fbs_p1').val(data.fbs_p1);
						$('#fbs_p2').val(data.fbs_p2);
						$('#avg_fbs').val(data.avg_fbs);
						
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
							$('#comp').css("background-color","#3CAF35");
						   $("#chk_com").prop("checked", true); 
						}else{
							 $('#comp').css("background-color","white");
							$("#chk_com").prop("checked", false); 
						}
								
						$('#com_date_test').val(data.com_date_test);						
						$('#com_temp').val(data.com_temp);
						$('#com_humidity').val(data.com_humidity);						
						$('#weight_of_cement').val(data.weight_of_cement);
						$('#weight_of_sand').val(data.weight_of_sand);
						$('#weight_of_water').val(data.weight_of_water);
						$('#sp_1').val(data.sp_1);
						$('#sp_2').val(data.sp_2);
						$('#sp_3').val(data.sp_3);
						$('#caste_date1').val(data.caste_date1);
						$('#caste_date2').val(data.caste_date2);
						$('#caste_date3').val(data.caste_date3);
						$('#test_date1').val(data.test_date1);
						$('#test_date2').val(data.test_date2);
						$('#test_date3').val(data.test_date3);
						$('#day_1').val(data.day_1);
						$('#day_2').val(data.day_2);
						$('#day_3').val(data.day_3);
						
						
						
						$('#l1').val(data.l1);
						$('#l2').val(data.l2);
						$('#l3').val(data.l3);
						$('#l4').val(data.l4);
						$('#l5').val(data.l5);
						$('#l6').val(data.l6);
						$('#l7').val(data.l7);
						$('#l8').val(data.l8);
						$('#l9').val(data.l9);
						
						$('#b1').val(data.b1);
						$('#b2').val(data.b2);
						$('#b3').val(data.b3);
						$('#b4').val(data.b4);
						$('#b5').val(data.b5);
						$('#b6').val(data.b6);
						$('#b7').val(data.b7);
						$('#b8').val(data.b8);
						$('#b9').val(data.b9);
						
						$('#h1').val(data.h1);
						$('#h2').val(data.h2);
						$('#h3').val(data.h3);
						$('#h4').val(data.h4);
						$('#h5').val(data.h5);
						$('#h6').val(data.h6);
						$('#h7').val(data.h7);
						$('#h8').val(data.h8);
						$('#h9').val(data.h9);
						
						$('#area_1').val(data.area_1);
						$('#area_2').val(data.area_2);
						$('#area_3').val(data.area_3);
						$('#area_4').val(data.area_4);
						$('#area_5').val(data.area_5);
						$('#area_6').val(data.area_6);
						$('#area_7').val(data.area_7);
						$('#area_8').val(data.area_8);
						$('#area_9').val(data.area_9);
						
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
						
						$('#avg_com_1').val(data.avg_com_1);
						$('#avg_com_2').val(data.avg_com_2);
						$('#avg_com_3').val(data.avg_com_3);
											
						
						break;
					}
					else
					{
						
					}
														
				}				
				
				//chemical
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="che")
					{
						
						var chk_che = data.chk_che;
						
						
						if(chk_che=="1")
						{
						 $('#chemi').css("background-color","#3CAF35");
						   $("#chk_che").prop("checked", true); 
						}else{
							 $('#chemi').css("background-color","white");
							$("#chk_che").prop("checked", false); 
						}

						
				
						$('#cao1').val(data.cao1);						
						$('#cao2').val(data.cao2);
						$('#cao3').val(data.cao3);						
						$('#cao4').val(data.cao4);
						$('#so1').val(data.so1);						
						$('#so2').val(data.so2);
						$('#so3').val(data.so3);						
						$('#so4').val(data.so4);
						$('#sio1').val(data.sio1);						
						$('#sio2').val(data.sio2);
						$('#sio3').val(data.sio3);						
						$('#sio4').val(data.sio4);
						$('#sio5').val(data.sio5);
						$('#sio6').val(data.sio6);
						$('#sio7').val(data.sio7);
						$('#r2o1').val(data.r2o1);						
						$('#r2o2').val(data.r2o2);
						$('#r2o3').val(data.r2o3);						
						$('#r2o4').val(data.r2o4);
						$('#r2o5').val(data.r2o5);
						$('#r2o6').val(data.r2o6);
						$('#r2o7').val(data.r2o7);
						$('#feo1').val(data.feo1);						
						$('#feo2').val(data.feo2);
						$('#feo3').val(data.feo3);
						$('#alo1').val(data.alo1);
						$('#per1').val(data.per1);
						$('#res1').val(data.res1);						
						$('#res2').val(data.res2);
						$('#res3').val(data.res3);						
						$('#res4').val(data.res4);
						$('#mgo1').val(data.mgo1);						
						$('#mgo2').val(data.mgo2);
						$('#mgo3').val(data.mgo3);						
						$('#mgo4').val(data.mgo4);
						$('#ig1').val(data.ig1);						
						$('#ig2').val(data.ig2);
						$('#ig3').val(data.ig3);						
						$('#ig4').val(data.ig4);
						$('#cl1').val(data.cl1);						
						$('#cl2').val(data.cl2);
						$('#cl3').val(data.cl3);						
						$('#cl4').val(data.cl4);
						$('#cl5').val(data.cl5);
						$('#cl6').val(data.cl6);
						$('#alk1').val(data.alk1);						
						$('#alk2').val(data.alk2);
						$('#alk3').val(data.alk3);						
						$('#alk4').val(data.alk4);
						$('#alk5').val(data.alk5);
						$('#alk6').val(data.alk6);
						$('#alk7').val(data.alk7);
						$('#alk8').val(data.alk8);
						
						$('#com_test_method').val(data.com_test_method);
						$('#com_test_req').val(data.com_test_req);
						$('#com_test_limit_1').val(data.com_test_limit_1);
						$('#com_test_limit_2').val(data.com_test_limit_2);
						
						$('#sio_test_method').val(data.sio_test_method);
						$('#sio_test_req').val(data.sio_test_req);
						$('#sio_test_limit_1').val(data.sio_test_limit_1);
						$('#sio_test_limit_2').val(data.sio_test_limit_2);
						
						$('#mang_test_method').val(data.mang_test_method);
						$('#mang_test_req').val(data.mang_test_req);
						$('#mang_test_limit_1').val(data.mang_test_limit_1);
						$('#mang_test_limit_2').val(data.mang_test_limit_2);
						
						$('#tot_test_method').val(data.tot_test_method);
						$('#tot_test_req').val(data.tot_test_req);
						$('#tot_test_limit_1').val(data.tot_test_limit_1);
						$('#tot_test_limit_2').val(data.tot_test_limit_2);
						
						$('#alk_test_method').val(data.alk_test_method);
						$('#alk_test_req').val(data.alk_test_req);
						$('#alk_test_limit_1').val(data.alk_test_limit_1);
						$('#alk_test_limit_2').val(data.alk_test_limit_2);
						
						$('#chl_test_method').val(data.chl_test_method);
						$('#chl_test_req').val(data.chl_test_req);
						$('#chl_test_limit_1').val(data.chl_test_limit_1);
						$('#chl_test_limit_2').val(data.chl_test_limit_2);
						
						$('#los_test_method').val(data.los_test_method);
						$('#los_test_req').val(data.los_test_req);
						$('#los_test_limit_1').val(data.los_test_limit_1);
						$('#los_test_limit_2').val(data.los_test_limit_2);
					
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



