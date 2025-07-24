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
						<h2 style="text-align:center;">FLY ASH</h2>
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
													$querys_job1 = "SELECT * FROM fly_ash WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
											<div class="col-sm-3">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_flyash.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>"class="btn btn-info" id="btn_report" name="btn_report"><b>Report</b></a> 
												<!--<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_flyash.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>"class="btn btn-info" id="btn_report" name="btn_report"><b>Chemical Report</b></a> -->
												
											</div>

											
											
											<?php /*} */?>
											<div class="col-sm-3">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_flyash.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>"class="btn btn-info" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
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
		$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		while($r1 = mysqli_fetch_array($result_select1)){
			 
			 if($r1['test_code']=="set")
			{
				$test_check.="set,";
		?>
			<div class="panel panel-default" id="set">
				<div class="panel-heading" id="txtset">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseset">
							<h4 class="panel-title">
								<b>INITIAL AND FINAL SETTING TIME</b>
							</h4>
						</a>
					</h4>
				</div>
				<div id="collapseset" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">									
							<div class="col-lg-8">
								<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_set">1.</label>
											<input type="checkbox" class="visually-hidden" name="chk_set"  id="chk_set" value="chk_set"><br>
										</div>
									<label for="inputEmail3" class="col-sm-6 control-label label-right">INITIAL AND FINAL SETTING TIME</label>
								</div>
							</div>
						</div>
						<br>
							<div class="row">
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Setting Time</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Initial Time (I.T)</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Final Time (F.T)</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Time in Min. (I.T - F.T)</b></center>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Initial Setting Time</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="it_1" name="it_1" >
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="ft_1" name="ft_1" >
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="it_ft_1" name="it_ft_1" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Final Setting Time</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="it_2" name="it_2" >
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="ft_2" name="ft_2" >
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="it_ft_2" name="it_ft_2" >
										</div>
									</div>
								</div>
							</div>
							
							
							
							
						</div>
					  </div>
					</div>
		
		
		
		
		<?php
			}else if($r1['test_code']=="dry")
			{
				$test_check.="dry,";
		?>
			<div class="panel panel-default" id="dry">
				<div class="panel-heading" id="txtdry">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapsedry">
							<h4 class="panel-title">
								<b>FINENESS BY DRY SIEVEING</b>
							</h4>
						</a>
					</h4>
				</div>
				<div id="collapsedry" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">									
							<div class="col-lg-8">
								<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_dry">2.</label>
											<input type="checkbox" class="visually-hidden" name="chk_dry"  id="chk_dry" value="chk_dry"><br>
										</div>
									<label for="inputEmail3" class="col-sm-6 control-label label-right">FINENESS BY DRY SIEVEING</label>
								</div>
							</div>
						</div>
						<br>
							<div class="row">
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Description</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Sample - 1</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Sample - 2</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Sample - 3</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Average</b></center>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Weight of Sample Taken (A) gm</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_wt_1" name="dry_wt_1" >
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_wt_2" name="dry_wt_2" >
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_wt_3" name="dry_wt_3" >
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_wt_avg" name="dry_wt_avg" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>Weight of Reidue (B) gm <br> (retained Weight on 90micron I.S Sieve)</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_res_1" name="dry_res_1" >
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_res_2" name="dry_res_2" >
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_res_3" name="dry_res_3" >
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_res_avg" name="dry_res_avg" >
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-3 col-sm-3">
									<div class="form-group">
										<div class="col-sm-12">
											<center><b>% Retained on Sieve ((A - B)/A x 100)</b></center>
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_sieve_1" name="dry_sieve_1" >
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_sieve_2" name="dry_sieve_2" >
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_sieve_3" name="dry_sieve_3" >
										</div>
									</div>
								</div>
								<div class="col-lg-2 col-sm-2">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="dry_sieve_avg" name="dry_sieve_avg" >
										</div>
									</div>
								</div>
							</div>
						</div>
					  </div>
					</div>
		
		<?php
			}else if($r1['test_code']=="per")
			{
				$test_check.="per,";
		?>
			<div class="panel panel-default" id="per">
				<div class="panel-heading" id="txtper">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseper">
							<h4 class="panel-title">
								<b>FINENESS BY BLAIN AIR PERMEABILITY</b>
							</h4>
						</a>
					</h4>
				</div>
				<div id="collapseper" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">									
							<div class="col-lg-8">
								<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_per">3.</label>
											<input type="checkbox" class="visually-hidden" name="chk_per"  id="chk_per" value="chk_per"><br>
										</div>
									<label for="inputEmail3" class="col-sm-6 control-label label-right">FINENESS BY BLAIN AIR PERMEABILITY</label>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>Sr No.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>Description</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>I</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>II</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>III</b></center>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>1.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>M2 in gms (wt of mercury)</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_m2_1" name="per_m2_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_m2_2" name="per_m2_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_m2_3" name="per_m2_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>2.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>M3 in gms (wt of mercury after forming cement bed)</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_m3_1" name="per_m3_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_m3_2" name="per_m3_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_m3_3" name="per_m3_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>3.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>D is the density of mercury at the  test temprature taken from Table 1</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_d_1" name="per_d_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_d_2" name="per_d_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_d_3" name="per_d_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>4.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>The bed Volume V is given by: V = ((m2 - m3)/D)(cm<sup>3</sup>)</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_v_1" name="per_v_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_v_2" name="per_v_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_v_3" name="per_v_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>5.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>Quantity of Cement Calculated from (Poroosity e = 0.500) m1</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_m1_1" name="per_m1_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_m1_2" name="per_m1_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_m1_3" name="per_m1_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>6.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>Measure time of cement under test (t) (sec)</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_mea_1" name="per_mea_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_mea_2" name="per_mea_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_mea_3" name="per_mea_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>7.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>Mean time (sec)</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_mean_1" name="per_mean_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_mean_2" name="per_mean_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_mean_3" name="per_mean_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>8.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>Measured Temprature (<sup>o</sup>C)</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_temp_1" name="per_temp_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_temp_2" name="per_temp_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_temp_3" name="per_temp_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>9.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>Mean Temprature (<sup>o</sup>C)</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_mean_temp_1" name="per_mean_temp_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_mean_temp_2" name="per_mean_temp_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_mean_temp_3" name="per_mean_temp_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-1 col-sm-1">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>10.</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4">
								<div class="form-group">
									<div class="col-sm-12">
										<center><b>Specific Surfac, m<sup>2</sup>/kg</b></center>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_sur_1" name="per_sur_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_sur_2" name="per_sur_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="per_sur_3" name="per_sur_3" >
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
												<center><label for="inputEmail3" class="col-sm-12 control-label">Soundness by Le-Chatlier</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<center><label for="inputEmail3" class="col-sm-12 control-label">I</label></center>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<center><label for="inputEmail3" class="col-sm-12 control-label">II</label></center>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<center><label for="inputEmail3" class="col-sm-12 control-label">Average</label></center>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Initial Measurement</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="sou_1_1" name="sou_1_1" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="sou_2_1" name="sou_2_1" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="sou_avg1" name="sou_avg1" >
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Final Measurement</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="sou_1_2" name="sou_1_2" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="sou_2_2" name="sou_2_2" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="sou_avg2" name="sou_avg2" >
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Difference</label>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="sou_1_3" name="sou_1_3" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="sou_2_3" name="sou_2_3" >
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-sm-2">	
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="sou_avg3" name="sou_avg3" >
											</div>
										</div>
									</div>
								</div>
								
								
							</div>
					  </div>
					</div>
		</div>	
			<?php
			}else if($r1['test_code']=="lim")
			{
				$test_check.="lim,";
			?>
			<div class="panel panel-default" id="lim">
				<div class="panel-heading" id="txtlim">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapselim">
							<h4 class="panel-title">
								<b>LIME REACTIVITY</b>
							</h4>
						</a>
					</h4>
				</div>
		<div id="collapselim" class="panel-collapse collapse">
			<div class="panel-body">
			<!--Impact VALUE Start-->
				<br>
				<div class="row">									
					<div class="col-lg-12">
						<div class="form-group">
								<div class="col-sm-1">
									<label for="chk_lim">7.</label>
									<input type="checkbox" class="visually-hidden" name="chk_lim"  id="chk_lim" value="chk_lim"><br>
								</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">LIME REACTIVITY</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<label for="inputEmail3" class="col-sm-12 control-label label-right"><center>Sr No.</center></label>
					</div>
					<div class="col-sm-3">
						<label for="inputEmail3" class="col-sm-12 control-label label-right">% of Water in ml</label>
					</div>
					<div class="col-sm-3">
						<label for="inputEmail3" class="col-sm-12 control-label label-right">Meaured Flow in mm</label>
					</div>
					<div class="col-sm-3">
						<label for="inputEmail3" class="col-sm-12 control-label label-right">% of Flow</label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<center>1.</center>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_wtr_1" name="lim_wtr_1" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_mea_1" name="lim_mea_1" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_flow_1" name="lim_flow_1" >
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<center>2.</center>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_wtr_2" name="lim_wtr_2" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_mea_2" name="lim_mea_2" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_flow_2" name="lim_flow_2" >
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<center>3.</center>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_wtr_3" name="lim_wtr_3" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_mea_3" name="lim_mea_3" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_flow_3" name="lim_flow_3" >
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<center>4.</center>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_wtr_4" name="lim_wtr_4" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_mea_4" name="lim_mea_4" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_flow_4" name="lim_flow_4" >
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<center>5.</center>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_wtr_5" name="lim_wtr_5" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_mea_5" name="lim_mea_5" >
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="lim_flow_5" name="lim_flow_5" >
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-3">
						<label for="inputEmail3" class="col-sm-12 control-label label-right"><center>The Amount of Water</center></label>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="lim_wtr_amt" name="lim_wtr_amt" >
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<label for="inputEmail3" class="col-sm-12 control-label label-right"><center>No. of Days</center></label>
					</div>
					<div class="col-sm-1">
						<label for="inputEmail3" class="col-sm-12 control-label label-right"><center>Weight in gms</center></label>
					</div>
					<div class="col-sm-1">
						<label for="inputEmail3" class="col-sm-12 control-label label-right"><center>Length</center></label>
					</div>
					<div class="col-sm-1">
						<label for="inputEmail3" class="col-sm-12 control-label label-right"><center>Width</center></label>
					</div>
					<div class="col-sm-1">
						<label for="inputEmail3" class="col-sm-12 control-label label-right"><center>Height</center></label>
					</div>
					<div class="col-sm-1">
						<label for="inputEmail3" class="col-sm-12 control-label label-right"><center>C/s Area mm<sup>2</sup></center></label>
					</div>
					<div class="col-sm-1">
						<label for="inputEmail3" class="col-sm-12 control-label label-right"><center>Load in kN</center></label>
					</div>
					<div class="col-sm-2">
						<label for="inputEmail3" class="col-sm-12 control-label label-right"><center>Compresive Strength in (N/mm<sup>2</sup>)</center></label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_day_1" name="lim_day_1" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_wt_1" name="lim_wt_1" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_len_1" name="lim_len_1" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_w_1" name="lim_w_1" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_h_1" name="lim_h_1" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_area_1" name="lim_area_1" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_load_1" name="lim_load_1" >
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="lim_com_1" name="lim_com_1" >
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_day_2" name="lim_day_2" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_wt_2" name="lim_wt_2" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_len_2" name="lim_len_2" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_w_2" name="lim_w_2" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_h_2" name="lim_h_2" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_area_2" name="lim_area_2" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_load_2" name="lim_load_2" >
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="lim_com_2" name="lim_com_2" >
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_day_3" name="lim_day_3" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_wt_3" name="lim_wt_3" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_len_3" name="lim_len_3" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_w_3" name="lim_w_3" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_h_3" name="lim_h_3" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_area_3" name="lim_area_3" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_load_3" name="lim_load_3" >
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="lim_com_3" name="lim_com_3" >
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_day_4" name="lim_day_4" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_wt_4" name="lim_wt_4" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_len_4" name="lim_len_4" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_w_4" name="lim_w_4" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_h_4" name="lim_h_4" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_area_4" name="lim_area_4" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_load_4" name="lim_load_4" >
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="lim_com_4" name="lim_com_4" >
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_day_5" name="lim_day_5" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_wt_5" name="lim_wt_5" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_len_5" name="lim_len_5" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_w_5" name="lim_w_5" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_h_5" name="lim_h_5" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_area_5" name="lim_area_5" >
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" id="lim_load_5" name="lim_load_5" >
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="lim_com_5" name="lim_com_5" >
					</div>
				</div>
			
			</div>
		</div>
    </div>
				
				
			<?php
			}
			else if($r1['test_code']=="spg" )
			{
				$test_check.="spg,";
			?>
				<div class="panel panel-default" id="spg">
					<div class="panel-heading" id="txtspg">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapsespg">
								<h4 class="panel-title">
									<b>SPECIFIC GRAVITY</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapsespg" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">									
							<div class="col-lg-8">
								<div class="form-group">
										<div class="col-sm-1">
											<label for="chk_spg">7.</label>
											<input type="checkbox" class="visually-hidden" name="chk_spg"  id="chk_spg" value="chk_spg"><br>
										</div>
									<label for="inputEmail3" class="col-sm-6 control-label label-right">SPECIFIC GRAVITY</label>
								</div>
							</div>
						</div>
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Mass of Fly Ash in gm (A)</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_a_1" name="spg_a_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_a_2" name="spg_a_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_a_3" name="spg_a_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Displaced volume in cm3 (B)</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_b_1" name="spg_b_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_b_2" name="spg_b_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_b_3" name="spg_b_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Specific Gravity in gm/cm3 (A/B)</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_ab_1" name="spg_ab_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_ab_2" name="spg_ab_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_ab_3" name="spg_ab_3" >
									</div>
								</div>
							</div>
						</div>	
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">The bed Volume V is given by:</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_v_1" name="spg_v_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_v_2" name="spg_v_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_v_3" name="spg_v_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Quantity of FlyAsh Calculated from m1 = 0.500pv (g)</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_fly_1" name="spg_fly_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_fly_2" name="spg_fly_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_fly_3" name="spg_fly_3" >
									</div>
								</div>
							</div>
						</div>		
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Specific Surface of standard sample used in calibration Ss in cm2/gm</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_sur_1" name="spg_sur_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_sur_2" name="spg_sur_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_sur_3" name="spg_sur_3" >
									</div>
								</div>
							</div>
						</div>		
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Specific Gravity of standard sample Ps</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_std_1" name="spg_std_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_std_2" name="spg_std_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_std_3" name="spg_std_3" >
									</div>
								</div>
							</div>
						</div>		
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Porosity of prepared bed of standard sample e</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_por_std_1" name="spg_por_std_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_por_std_2" name="spg_por_std_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_por_std_3" name="spg_por_std_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Porosity of prepared bed of Test sample e</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_por_test_1" name="spg_por_test_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_por_test_2" name="spg_por_test_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_por_test_3" name="spg_por_test_3" >
									</div>
								</div>
							</div>
						</div>	
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Measured time interval in sec for test sample, T </label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mea_1" name="spg_mea_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mea_2" name="spg_mea_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mea_3" name="spg_mea_3" >
									</div>
								</div>
							</div>
						</div>	
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Mean Time (sec)</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mean_1" name="spg_mean_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mean_2" name="spg_mean_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mean_3" name="spg_mean_3" >
									</div>
								</div>
							</div>
						</div>		
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Measured time in sec for standard sample, T </label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mea_std_1" name="spg_mea_std_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mea_std_2" name="spg_mea_std_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mea_std_3" name="spg_mea_std_3" >
									</div>
								</div>
							</div>
						</div>	
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Measured Temprature (<sup>o</sup>C)</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mea_temp_1" name="spg_mea_temp_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mea_temp_2" name="spg_mea_temp_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mea_temp_3" name="spg_mea_temp_3" >
									</div>
								</div>
							</div>
						</div>	
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Mean Temprature (<sup>o</sup>C)</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mean_temp_1" name="spg_mean_temp_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mean_temp_2" name="spg_mean_temp_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_mean_temp_3" name="spg_mean_temp_3" >
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">	
							<div class="col-lg-3">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="inputEmail3" class="col-sm-12 control-label">Specific Surface of test sample in cm2/gm =</label>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_ss_1" name="spg_ss_1" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_ss_2" name="spg_ss_2" >
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="spg_ss_3" name="spg_ss_3" >
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
														<center><label for="inputEmail3" class="col-sm-12 control-label">I</label></center>
													</div>
												</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">
													<center><label for="inputEmail3" class="col-sm-12 control-label">II</label></center>
												</div>
											</div>
										</div>
										<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<center><label for="inputEmail3" class="col-sm-12 control-label">III</label></center>
											</div>
										</div>
									</div>
									</div>
									<br>
									
									<br>
									
									
									
									<div class="row">									
									<div class="col-lg-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="inputEmail3" class="col-sm-12 control-label">Days</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="day1" name="day1" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="day2" name="day2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="day3" name="day3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="day4" name="day4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="day5" name="day5" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="day6" name="day6" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="day7" name="day7" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="day8" name="day8" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="day9" name="day9" >
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
												<label for="inputEmail3" class="col-sm-12 control-label">Height (mm)</label> 
											</div>
										</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="h1" name="h1" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="h2" name="h2" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="h3" name="h3" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="h4" name="h4" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="h5" name="h5" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="h6" name="h6" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="h7" name="h7" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="h8" name="h8" >
												</div>
											</div>
									</div>
									<div class="col-lg-1">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="h9" name="h9" >
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
													<input type="text" class="form-control" id="avg_com1" name="avg_com1" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="avg_com2" name="avg_com2" >
												</div>
											</div>
									</div>
									<div class="col-lg-3">
											<div class="form-group">
												<div class="col-sm-12">													
													<input type="text" class="form-control" id="avg_com3" name="avg_com3" >
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
							 $query = "select * from fly_ash WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	$('#shr_start_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
	$('.datess').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
	$('.t_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
  $(function () {
    $('.select2').select2();
  })
  
  $(document).ready(function(){
	
	$('#btn_edit_data').hide();
	$('#alert').hide();
  })
  
	function set_auto(){
		$('#txtset').css("background-color","var(--success)");
		$('#it_1').val(1);
		$('#it_2').val(1);
		$('#ft_1').val(1);
		$('#ft_2').val(1);
		$('#it_ft_1').val(1);
		$('#it_ft_2').val(1);
	}
	$('#chk_set').change(function(){
        if(this.checked)
		{
			set_auto();	
		}
		else
		{
			$('#txtset').css("background-color","white");
			$('#it_1').val(null);
			$('#it_2').val(null);
			$('#ft_1').val(null);
			$('#ft_2').val(null);
			$('#it_ft_1').val(null);
			$('#it_ft_2').val(null);
		}
		
	});
	
	
	function dry_auto(){
		$('#txtdry').css("background-color","var(--success)");
		$('#dry_wt_1').val(1);
		$('#dry_wt_2').val(1);
		$('#dry_wt_3').val(1);
		$('#dry_wt_avg').val(1);
		$('#dry_res_1').val(1);
		$('#dry_res_2').val(1);
		$('#dry_res_3').val(1);
		$('#dry_res_avg').val(1);
		$('#dry_sieve_1').val(1);
		$('#dry_sieve_2').val(1);
		$('#dry_sieve_3').val(1);
		$('#dry_sieve_avg').val(1);
	}
	$('#chk_dry').change(function(){
        if(this.checked)
		{
			dry_auto();	
		}
		else
		{
			$('#txtdry').css("background-color","white");
			$('#dry_wt_1').val(null);
			$('#dry_wt_2').val(null);
			$('#dry_wt_3').val(null);
			$('#dry_wt_avg').val(null);
			$('#dry_res_1').val(null);
			$('#dry_res_2').val(null);
			$('#dry_res_3').val(null);
			$('#dry_res_avg').val(null);
			$('#dry_sieve_1').val(null);
			$('#dry_sieve_2').val(null);
			$('#dry_sieve_3').val(null);
			$('#dry_sieve_avg').val(null);
		}
		
	});
	
	
	function per_auto(){
		$('#txtper').css("background-color","var(--success)");
		
		$('#per_m2_1').val(1);
		$('#per_m2_2').val(1);
		$('#per_m2_3').val(1);
		$('#per_m3_1').val(1);
		$('#per_m3_2').val(1);
		$('#per_m3_3').val(1);
		$('#per_d_1').val(1);
		$('#per_d_2').val(1);
		$('#per_d_3').val(1);
		$('#per_v_1').val(1);
		$('#per_v_2').val(1);
		$('#per_v_3').val(1);
		$('#per_m1_1').val(1);
		$('#per_m1_2').val(1);
		$('#per_m1_3').val(1);
		$('#per_mea_1').val(1);
		$('#per_mea_2').val(1);
		$('#per_mea_3').val(1);
		$('#per_mean_1').val(1);
		$('#per_mean_2').val(1);
		$('#per_mean_3').val(1);
		$('#per_temp_1').val(1);
		$('#per_temp_2').val(1);
		$('#per_temp_3').val(1);
		$('#per_mean_temp_1').val(1);
		$('#per_mean_temp_2').val(1);
		$('#per_mean_temp_3').val(1);
		$('#per_sur_1').val(1);
		$('#per_sur_2').val(1);
		$('#per_sur_3').val(1);
	}
	$('#chk_per').change(function(){
        if(this.checked)
		{
			per_auto();	
		}
		else
		{
			$('#txtper').css("background-color","white");
			$('#per_m2_1').val(null);
			$('#per_m2_2').val(null);
			$('#per_m2_3').val(null);
			$('#per_m3_1').val(null);
			$('#per_m3_2').val(null);
			$('#per_m3_3').val(null);
			$('#per_d_1').val(null);
			$('#per_d_2').val(null);
			$('#per_d_3').val(null);
			$('#per_v_1').val(null);
			$('#per_v_2').val(null);
			$('#per_v_3').val(null);
			$('#per_m1_1').val(null);
			$('#per_m1_2').val(null);
			$('#per_m1_3').val(null);
			$('#per_mea_1').val(null);
			$('#per_mea_2').val(null);
			$('#per_mea_3').val(null);
			$('#per_mean_1').val(null);
			$('#per_mean_2').val(null);
			$('#per_mean_3').val(null);
			$('#per_temp_1').val(null);
			$('#per_temp_2').val(null);
			$('#per_temp_3').val(null);
			$('#per_mean_temp_1').val(null);
			$('#per_mean_temp_2').val(null);
			$('#per_mean_temp_3').val(null);
			$('#per_sur_1').val(null);
			$('#per_sur_2').val(null);
			$('#per_sur_3').val(null);
		}
		
	});
	
	function sou_auto(){
		$('#sound').css("background-color","var(--success)");
		
		$('#sou_1_1').val(1);
		$('#sou_1_2').val(1);
		$('#sou_1_3').val(1);
		$('#sou_2_1').val(1);
		$('#sou_2_2').val(1);
		$('#sou_2_3').val(1);
		$('#sou_avg1').val(1);
		$('#sou_avg2').val(1);
		$('#sou_avg3').val(1);
	}
	$('#chk_sou').change(function(){
        if(this.checked)
		{
			sou_auto();	
		}
		else
		{
			$('#sound').css("background-color","white");
			$('#sou_1_1').val(null);
			$('#sou_1_2').val(null);
			$('#sou_1_3').val(null);
			$('#sou_2_1').val(null);
			$('#sou_2_2').val(null);
			$('#sou_2_3').val(null);
			$('#sou_avg1').val(null);
			$('#sou_avg2').val(null);
			$('#sou_avg3').val(null);
		}
	});
	
	function com_auto(){
		$('#comp').css("background-color","var(--success)");
		$('#day1').val(1);
		$('#day2').val(1);
		$('#day3').val(1);
		$('#day4').val(1);
		$('#day5').val(1);
		$('#day6').val(1);
		$('#day7').val(1);
		$('#day8').val(1);
		$('#day9').val(1);
		$('#l1').val(1);
		$('#l2').val(1);
		$('#l3').val(1);
		$('#l4').val(1);
		$('#l5').val(1);
		$('#l6').val(1);
		$('#l7').val(1);
		$('#l8').val(1);
		$('#l9').val(1);
		$('#wi1').val(1);
		$('#wi2').val(1);
		$('#wi3').val(1);
		$('#wi4').val(1);
		$('#wi5').val(1);
		$('#wi6').val(1);
		$('#wi7').val(1);
		$('#wi8').val(1);
		$('#wi9').val(1);
		$('#h1').val(1);
		$('#h2').val(1);
		$('#h3').val(1);
		$('#h4').val(1);
		$('#h5').val(1);
		$('#h6').val(1);
		$('#h7').val(1);
		$('#h8').val(1);
		$('#h9').val(1);
		$('#a1').val(1);
		$('#a2').val(1);
		$('#a3').val(1);
		$('#a4').val(1);
		$('#a5').val(1);
		$('#a6').val(1);
		$('#a7').val(1);
		$('#a8').val(1);
		$('#a9').val(1);
		$('#load_1').val(1);
		$('#load_2').val(1);
		$('#load_3').val(1);
		$('#load_4').val(1);
		$('#load_5').val(1);
		$('#load_6').val(1);
		$('#load_7').val(1);
		$('#load_8').val(1);
		$('#load_9').val(1);
		$('#com_1').val(1);
		$('#com_2').val(1);
		$('#com_3').val(1);
		$('#com_4').val(1);
		$('#com_5').val(1);
		$('#com_6').val(1);
		$('#com_7').val(1);
		$('#com_8').val(1);
		$('#com_9').val(1);
		$('#avg_com1').val(1);
		$('#avg_com2').val(1);
		$('#avg_com3').val(1);
	}
	$('#chk_com').change(function(){
        if(this.checked)
		{
			com_auto();	
		}
		else
		{
			$('#comp').css("background-color","white");
			$('#day1').val(null);
			$('#day2').val(null);
			$('#day3').val(null);
			$('#day4').val(null);
			$('#day5').val(null);
			$('#day6').val(null);
			$('#day7').val(null);
			$('#day8').val(null);
			$('#day9').val(null);
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
			$('#h1').val(null);
			$('#h2').val(null);
			$('#h3').val(null);
			$('#h4').val(null);
			$('#h5').val(null);
			$('#h6').val(null);
			$('#h7').val(null);
			$('#h8').val(null);
			$('#h9').val(null);
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
			$('#avg_com1').val(null);
			$('#avg_com2').val(null);
			$('#avg_com3').val(null);
		}
	});
	
	function lim_auto(){
		$('#txtlim').css("background-color","var(--success)");
		
		$('#lim_wtr_1').val(1);
		$('#lim_wtr_2').val(1);
		$('#lim_wtr_3').val(1);
		$('#lim_wtr_4').val(1);
		$('#lim_wtr_5').val(1);
		$('#lim_mea_1').val(1);
		$('#lim_mea_2').val(1);
		$('#lim_mea_3').val(1);
		$('#lim_mea_4').val(1);
		$('#lim_mea_5').val(1);
		$('#lim_flow_1').val(1);
		$('#lim_flow_2').val(1);
		$('#lim_flow_3').val(1);
		$('#lim_flow_4').val(1);
		$('#lim_flow_5').val(1);
		$('#lim_day_1').val(1);
		$('#lim_day_2').val(1);
		$('#lim_day_3').val(1);
		$('#lim_day_4').val(1);
		$('#lim_day_5').val(1);
		$('#lim_wt_1').val(1);
		$('#lim_wt_2').val(1);
		$('#lim_wt_3').val(1);
		$('#lim_wt_4').val(1);
		$('#lim_wt_5').val(1);
		$('#lim_len_1').val(1);
		$('#lim_len_2').val(1);
		$('#lim_len_3').val(1);
		$('#lim_len_4').val(1);
		$('#lim_len_5').val(1);
		$('#lim_w_1').val(1);
		$('#lim_w_2').val(1);
		$('#lim_w_3').val(1);
		$('#lim_w_4').val(1);
		$('#lim_w_5').val(1);
		$('#lim_h_1').val(1);
		$('#lim_h_2').val(1);
		$('#lim_h_3').val(1);
		$('#lim_h_4').val(1);
		$('#lim_h_5').val(1);
		$('#lim_area_1').val(1);
		$('#lim_area_2').val(1);
		$('#lim_area_3').val(1);
		$('#lim_area_4').val(1);
		$('#lim_area_5').val(1);
		$('#lim_load_1').val(1);
		$('#lim_load_2').val(1);
		$('#lim_load_3').val(1);
		$('#lim_load_4').val(1);
		$('#lim_load_5').val(1);
		$('#lim_com_1').val(1);
		$('#lim_com_2').val(1);
		$('#lim_com_3').val(1);
		$('#lim_com_4').val(1);
		$('#lim_com_5').val(1);
	}
	$('#chk_lim').change(function(){
        if(this.checked)
		{
			lim_auto();	
		}
		else
		{
			$('#txtlim').css("background-color","white");
			$('#lim_wtr_1').val(null);
			$('#lim_wtr_2').val(null);
			$('#lim_wtr_3').val(null);
			$('#lim_wtr_4').val(null);
			$('#lim_wtr_5').val(null);
			$('#lim_mea_1').val(null);
			$('#lim_mea_2').val(null);
			$('#lim_mea_3').val(null);
			$('#lim_mea_4').val(null);
			$('#lim_mea_5').val(null);
			$('#lim_flow_1').val(null);
			$('#lim_flow_2').val(null);
			$('#lim_flow_3').val(null);
			$('#lim_flow_4').val(null);
			$('#lim_flow_5').val(null);
			$('#lim_day_1').val(null);
			$('#lim_day_2').val(null);
			$('#lim_day_3').val(null);
			$('#lim_day_4').val(null);
			$('#lim_day_5').val(null);
			$('#lim_wt_1').val(null);
			$('#lim_wt_2').val(null);
			$('#lim_wt_3').val(null);
			$('#lim_wt_4').val(null);
			$('#lim_wt_5').val(null);
			$('#lim_len_1').val(null);
			$('#lim_len_2').val(null);
			$('#lim_len_3').val(null);
			$('#lim_len_4').val(null);
			$('#lim_len_5').val(null);
			$('#lim_w_1').val(null);
			$('#lim_w_2').val(null);
			$('#lim_w_3').val(null);
			$('#lim_w_4').val(null);
			$('#lim_w_5').val(null);
			$('#lim_h_1').val(null);
			$('#lim_h_2').val(null);
			$('#lim_h_3').val(null);
			$('#lim_h_4').val(null);
			$('#lim_h_5').val(null);
			$('#lim_area_1').val(null);
			$('#lim_area_2').val(null);
			$('#lim_area_3').val(null);
			$('#lim_area_4').val(null);
			$('#lim_area_5').val(null);
			$('#lim_load_1').val(null);
			$('#lim_load_2').val(null);
			$('#lim_load_3').val(null);
			$('#lim_load_4').val(null);
			$('#lim_load_5').val(null);
			$('#lim_com_1').val(null);
			$('#lim_com_2').val(null);
			$('#lim_com_3').val(null);
			$('#lim_com_4').val(null);
			$('#lim_com_5').val(null);
		}
	});
	
	function spg_auto(){
		$('#txtspg').css("background-color","var(--success)");
		
		$('#spg_a_1').val(1);
		$('#spg_a_2').val(1);
		$('#spg_a_3').val(1);
		$('#spg_b_1').val(1);
		$('#spg_b_2').val(1);
		$('#spg_b_3').val(1);
		$('#spg_ab_1').val(1);
		$('#spg_ab_2').val(1);
		$('#spg_ab_3').val(1);
		$('#spg_v_1').val(1);
		$('#spg_v_2').val(1);
		$('#spg_v_3').val(1);
		$('#spg_fly_1').val(1);
		$('#spg_fly_2').val(1);
		$('#spg_fly_3').val(1);
		$('#spg_sur_1').val(1);
		$('#spg_sur_2').val(1);
		$('#spg_sur_3').val(1);
		$('#spg_std_1').val(1);
		$('#spg_std_2').val(1);
		$('#spg_std_3').val(1);
		$('#spg_por_std_1').val(1);
		$('#spg_por_std_2').val(1);
		$('#spg_por_std_3').val(1);
		$('#spg_por_test_1').val(1);
		$('#spg_por_test_2').val(1);
		$('#spg_por_test_3').val(1);
		$('#spg_mea_1').val(1);
		$('#spg_mea_2').val(1);
		$('#spg_mea_3').val(1);
		$('#spg_mean_1').val(1);
		$('#spg_mean_2').val(1);
		$('#spg_mean_3').val(1);
		$('#spg_mea_std_1').val(1);
		$('#spg_mea_std_2').val(1);
		$('#spg_mea_std_3').val(1);
		$('#spg_mea_temp_1').val(1);
		$('#spg_mea_temp_2').val(1);
		$('#spg_mea_temp_3').val(1);
		$('#spg_mean_temp_1').val(1);
		$('#spg_mean_temp_2').val(1);
		$('#spg_mean_temp_3').val(1);
		$('#spg_ss_1').val(1);
		$('#spg_ss_2').val(1);
		$('#spg_ss_3').val(1);
	}
	$('#chk_spg').change(function(){
        if(this.checked)
		{
			spg_auto();	
		}
		else
		{
			$('#txtspg').css("background-color","white");
			$('#spg_a_1').val(null);
			$('#spg_a_2').val(null);
			$('#spg_a_3').val(null);
			$('#spg_b_1').val(null);
			$('#spg_b_2').val(null);
			$('#spg_b_3').val(null);
			$('#spg_ab_1').val(null);
			$('#spg_ab_2').val(null);
			$('#spg_ab_3').val(null);
			$('#spg_v_1').val(null);
			$('#spg_v_2').val(null);
			$('#spg_v_3').val(null);
			$('#spg_fly_1').val(null);
			$('#spg_fly_2').val(null);
			$('#spg_fly_3').val(null);
			$('#spg_sur_1').val(null);
			$('#spg_sur_2').val(null);
			$('#spg_sur_3').val(null);
			$('#spg_std_1').val(null);
			$('#spg_std_2').val(null);
			$('#spg_std_3').val(null);
			$('#spg_por_std_1').val(null);
			$('#spg_por_std_2').val(null);
			$('#spg_por_std_3').val(null);
			$('#spg_por_test_1').val(null);
			$('#spg_por_test_2').val(null);
			$('#spg_por_test_3').val(null);
			$('#spg_mea_1').val(null);
			$('#spg_mea_2').val(null);
			$('#spg_mea_3').val(null);
			$('#spg_mean_1').val(null);
			$('#spg_mean_2').val(null);
			$('#spg_mean_3').val(null);
			$('#spg_mea_std_1').val(null);
			$('#spg_mea_std_2').val(null);
			$('#spg_mea_std_3').val(null);
			$('#spg_mea_temp_1').val(null);
			$('#spg_mea_temp_2').val(null);
			$('#spg_mea_temp_3').val(null);
			$('#spg_mean_temp_1').val(null);
			$('#spg_mean_temp_2').val(null);
			$('#spg_mean_temp_3').val(null);
			$('#spg_ss_1').val(null);
			$('#spg_ss_2').val(null);
			$('#spg_ss_3').val(null);
		}
	});
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			var temp = $('#test_list').val();
			var aa= temp.split(",");
			
			//set
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="set")
				{
					$("#chk_set").prop("checked", true); 
					set_auto();
					break;
				}					
			}
			
			//dry
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="dry")
				{
					$("#chk_dry").prop("checked", true); 
					dry_auto();
					break;
				}					
			}
			
			//per
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="per")
				{
					$("#chk_per").prop("checked", true); 
					per_auto();
					break;
				}					
			}
			
			//sou
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="sou")
				{
					$("#chk_sou").prop("checked", true); 
					sou_auto();
					break;
				}					
			}
			
			//lim
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="lim")
				{
					$("#chk_lim").prop("checked", true); 
					lim_auto();
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
			
			//spg
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="spg")
				{
					$("#chk_spg").prop("checked", true); 
					spg_auto();
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
        url: '<?php echo $base_url; ?>save_flyash.php',
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
				
				
				//set
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
						var it_1 = $('#it_1').val();
						var it_2 = $('#it_2').val();
						var ft_1 = $('#ft_1').val();
						var ft_2 = $('#ft_2').val();
						var it_ft_1 = $('#it_ft_1').val();
						var it_ft_2 = $('#it_ft_2').val();	

						break;
					}
					else
					{
						var chk_dry = "0";
						var it_1 = "0";
						var it_2 = "0";
						var ft_1 = "0";
						var ft_2 = "0";
						var it_ft_1 = "0";
						var it_ft_2 = "0";

					}
				}
				//dry
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dry")
					{
						if(document.getElementById('chk_dry').checked) {
								var chk_dry = "1";
						}
						else{
								var chk_dry = "0";
						}
						var dry_wt_1 = $('#dry_wt_1').val();
						var dry_wt_2 = $('#dry_wt_2').val();
						var dry_wt_3 = $('#dry_wt_3').val();
						var dry_wt_avg = $('#dry_wt_avg').val();
						var dry_res_1 = $('#dry_res_1').val();
						var dry_res_2 = $('#dry_res_2').val();
						var dry_res_3 = $('#dry_res_3').val();
						var dry_res_avg = $('#dry_res_avg').val();
						var dry_sieve_1 = $('#dry_sieve_1').val();
						var dry_sieve_2 = $('#dry_sieve_2').val();
						var dry_sieve_3 = $('#dry_sieve_3').val();
						var dry_sieve_avg = $('#dry_sieve_avg').val();
						break;
					}
					else
					{
						var chk_dry = "0";	
						var dry_wt_1 = "0";
						var dry_wt_2 = "0";
						var dry_wt_3 = "0";
						var dry_wt_avg = "0";
						var dry_res_1 = "0";
						var dry_res_2 = "0";
						var dry_res_3 = "0";
						var dry_res_avg = "0";
						var dry_sieve_1 = "0";
						var dry_sieve_2 = "0";
						var dry_sieve_3 = "0";
						var dry_sieve_avg = "0";
					}
				}
				
				//per
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="per")
					{
						if(document.getElementById('chk_per').checked) {
								var chk_per = "1";
						}
						else{
								var chk_per = "0";
						}
						var per_m2_1 = $('#per_m2_1').val();
						var per_m2_2 = $('#per_m2_2').val();
						var per_m2_3 = $('#per_m2_3').val();
						var per_m3_1 = $('#per_m3_1').val();
						var per_m3_2 = $('#per_m3_2').val();
						var per_m3_3 = $('#per_m3_3').val();
						var per_d_1 = $('#per_d_1').val();
						var per_d_2 = $('#per_d_2').val();
						var per_d_3 = $('#per_d_3').val();
						var per_v_1 = $('#per_v_1').val();
						var per_v_2 = $('#per_v_2').val();
						var per_v_3 = $('#per_v_3').val();
						var per_m1_1 = $('#per_m1_1').val();
						var per_m1_2 = $('#per_m1_2').val();
						var per_m1_3 = $('#per_m1_3').val();
						var per_mea_1 = $('#per_mea_1').val();
						var per_mea_2 = $('#per_mea_2').val();
						var per_mea_3 = $('#per_mea_3').val();
						var per_mean_1 = $('#per_mean_1').val();
						var per_mean_2 = $('#per_mean_2').val();
						var per_mean_3 = $('#per_mean_3').val();
						var per_temp_1 = $('#per_temp_1').val();
						var per_temp_2 = $('#per_temp_2').val();
						var per_temp_3 = $('#per_temp_3').val();
						var per_mean_temp_1 = $('#per_mean_temp_1').val();
						var per_mean_temp_2 = $('#per_mean_temp_2').val();
						var per_mean_temp_3 = $('#per_mean_temp_3').val();
						var per_sur_1 = $('#per_sur_1').val();
						var per_sur_2 = $('#per_sur_2').val();
						var per_sur_3 = $('#per_sur_3').val();
						break;
					}
					else
					{
						var chk_per = "0";	
						var per_m2_1 = "0";
						var per_m2_2 = "0";
						var per_m2_3 = "0";
						var per_m3_1 = "0";
						var per_m3_2 = "0";
						var per_m3_3 = "0";
						var per_d_1 = "0";
						var per_d_2 = "0";
						var per_d_3 = "0";
						var per_v_1 = "0";
						var per_v_2 = "0";
						var per_v_3 = "0";
						var per_m1_1 = "0";
						var per_m1_2 = "0";
						var per_m1_3 = "0";
						var per_mea_1 = "0";
						var per_mea_2 = "0";
						var per_mea_3 = "0";
						var per_mean_1 = "0";
						var per_mean_2 = "0";
						var per_mean_3 = "0";
						var per_temp_1 = "0";
						var per_temp_2 = "0";
						var per_temp_3 = "0";
						var per_mean_temp_1 = "0";
						var per_mean_temp_2 = "0";
						var per_mean_temp_3 = "0";
						var per_sur_1 = "0";
						var per_sur_2 = "0";
						var per_sur_3 = "0";

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
						var sou_1_1 = $('#sou_1_1').val();
						var sou_1_2 = $('#sou_1_2').val();
						var sou_1_3 = $('#sou_1_3').val();
						var sou_2_1 = $('#sou_2_1').val();
						var sou_2_2 = $('#sou_2_2').val();
						var sou_2_3 = $('#sou_2_3').val();
						var sou_avg1 = $('#sou_avg1').val();
						var sou_avg2 = $('#sou_avg2').val();
						var sou_avg3 = $('#sou_avg3').val();						
						break;
					}
					else
					{
						var chk_sou = "0";	
						var sou_1_1 = "0";
						var sou_1_2 = "0";
						var sou_1_3 = "0";
						var sou_2_1 = "0";
						var sou_2_2 = "0";
						var sou_2_3 = "0";
						var sou_avg1 = "0";
						var sou_avg2 = "0";
						var sou_avg3 = "0";				

					}
				}
				
				//lim
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lim")
					{
						if(document.getElementById('chk_lim').checked) {
								var chk_lim = "1";
						}
						else{
								var chk_lim = "0";
						}
						var lim_wtr_1 = $('#lim_wtr_1').val();
						var lim_wtr_2 = $('#lim_wtr_2').val();
						var lim_wtr_3 = $('#lim_wtr_3').val();
						var lim_wtr_4 = $('#lim_wtr_4').val();
						var lim_wtr_5 = $('#lim_wtr_5').val();
						var lim_mea_1 = $('#lim_mea_1').val();
						var lim_mea_2 = $('#lim_mea_2').val();
						var lim_mea_3 = $('#lim_mea_3').val();
						var lim_mea_4 = $('#lim_mea_4').val();
						var lim_mea_5 = $('#lim_mea_5').val();
						var lim_flow_1 = $('#lim_flow_1').val();
						var lim_flow_2 = $('#lim_flow_2').val();
						var lim_flow_3 = $('#lim_flow_3').val();
						var lim_flow_4 = $('#lim_flow_4').val();
						var lim_flow_5 = $('#lim_flow_5').val();
						var lim_day_1 = $('#lim_day_1').val();
						var lim_day_2 = $('#lim_day_2').val();
						var lim_day_3 = $('#lim_day_3').val();
						var lim_day_4 = $('#lim_day_4').val();
						var lim_day_5 = $('#lim_day_5').val();
						var lim_wt_1 = $('#lim_wt_1').val();
						var lim_wt_2 = $('#lim_wt_2').val();
						var lim_wt_3 = $('#lim_wt_3').val();
						var lim_wt_4 = $('#lim_wt_4').val();
						var lim_wt_5 = $('#lim_wt_5').val();
						var lim_len_1 = $('#lim_len_1').val();
						var lim_len_2 = $('#lim_len_2').val();
						var lim_len_3 = $('#lim_len_3').val();
						var lim_len_4 = $('#lim_len_4').val();
						var lim_len_5 = $('#lim_len_5').val();
						var lim_w_1 = $('#lim_w_1').val();
						var lim_w_2 = $('#lim_w_2').val();
						var lim_w_3 = $('#lim_w_3').val();
						var lim_w_4 = $('#lim_w_4').val();
						var lim_w_5 = $('#lim_w_5').val();
						var lim_h_1 = $('#lim_h_1').val();
						var lim_h_2 = $('#lim_h_2').val();
						var lim_h_3 = $('#lim_h_3').val();
						var lim_h_4 = $('#lim_h_4').val();
						var lim_h_5 = $('#lim_h_5').val();
						var lim_area_1 = $('#lim_area_1').val();
						var lim_area_2 = $('#lim_area_2').val();
						var lim_area_3 = $('#lim_area_3').val();
						var lim_area_4 = $('#lim_area_4').val();
						var lim_area_5 = $('#lim_area_5').val();
						var lim_load_1 = $('#lim_load_1').val();
						var lim_load_2 = $('#lim_load_2').val();
						var lim_load_3 = $('#lim_load_3').val();
						var lim_load_4 = $('#lim_load_4').val();
						var lim_load_5 = $('#lim_load_5').val();
						var lim_com_1 = $('#lim_com_1').val();
						var lim_com_2 = $('#lim_com_2').val();
						var lim_com_3 = $('#lim_com_3').val();
						var lim_com_4 = $('#lim_com_4').val();
						var lim_com_5 = $('#lim_com_5').val();
					
						break;
					}
					else
					{
						var chk_lim = "0";	
						var lim_wtr_1 = "0";	
						var lim_wtr_2 = "0";	
						var lim_wtr_3 = "0";	
						var lim_wtr_4 = "0";	
						var lim_wtr_5 = "0";	
						var lim_mea_1 = "0";	
						var lim_mea_2 = "0";	
						var lim_mea_3 = "0";	
						var lim_mea_4 = "0";	
						var lim_mea_5 = "0";	
						var lim_flow_1 = "0";	
						var lim_flow_2 = "0";	
						var lim_flow_3 = "0";	
						var lim_flow_4 = "0";	
						var lim_flow_5 = "0";	
						var lim_day_1 = "0";	
						var lim_day_2 = "0";	
						var lim_day_3 = "0";	
						var lim_day_4 = "0";	
						var lim_day_5 = "0";	
						var lim_wt_1 = "0";	
						var lim_wt_2 = "0";	
						var lim_wt_3 = "0";	
						var lim_wt_4 = "0";	
						var lim_wt_5 = "0";	
						var lim_len_1 = "0";	
						var lim_len_2 = "0";	
						var lim_len_3 = "0";	
						var lim_len_4 = "0";	
						var lim_len_5 = "0";	
						var lim_w_1 = "0";	
						var lim_w_2 = "0";	
						var lim_w_3 = "0";	
						var lim_w_4 = "0";	
						var lim_w_5 = "0";	
						var lim_h_1 = "0";	
						var lim_h_2 = "0";	
						var lim_h_3 = "0";	
						var lim_h_4 = "0";	
						var lim_h_5 = "0";	
						var lim_area_1 = "0";	
						var lim_area_2 = "0";	
						var lim_area_3 = "0";	
						var lim_area_4 = "0";	
						var lim_area_5 = "0";	
						var lim_load_1 = "0";	
						var lim_load_2 = "0";	
						var lim_load_3 = "0";	
						var lim_load_4 = "0";	
						var lim_load_5 = "0";	
						var lim_com_1 = "0";	
						var lim_com_2 = "0";	
						var lim_com_3 = "0";	
						var lim_com_4 = "0";	
						var lim_com_5 = "0";	
					}
				}
				
				//compressive strength
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
						var day1 = $('#day1').val();
						var day2 = $('#day2').val();
						var day3 = $('#day3').val();
						var day4 = $('#day4').val();
						var day5 = $('#day5').val();
						var day6 = $('#day6').val();
						var day7 = $('#day7').val();
						var day8 = $('#day8').val();
						var day9 = $('#day9').val();
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
						var h1 = $('#h1').val();
						var h2 = $('#h2').val();
						var h3 = $('#h3').val();
						var h4 = $('#h4').val();
						var h5 = $('#h5').val();
						var h6 = $('#h6').val();
						var h7 = $('#h7').val();
						var h8 = $('#h8').val();
						var h9 = $('#h9').val();
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
						var avg_com1 = $('#avg_com1').val();
						var avg_com2 = $('#avg_com2').val();
						var avg_com3 = $('#avg_com3').val();
						break;
					}
					else
					{
						var chk_com = "0";	
						var day1 = "0";	
						var day2 = "0";	
						var day3 = "0";	
						var day4 = "0";	
						var day5 = "0";	
						var day6 = "0";	
						var day7 = "0";	
						var day8 = "0";	
						var day9 = "0";	
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
						var h1 = "0";	
						var h2 = "0";	
						var h3 = "0";	
						var h4 = "0";	
						var h5 = "0";	
						var h6 = "0";	
						var h7 = "0";	
						var h8 = "0";	
						var h9 = "0";	
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
						var avg_com1 = "0";	
						var avg_com2 = "0";	
						var avg_com3 = "0";	
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
						var spg_a_1 = $('#spg_a_1').val();
						var spg_a_2 = $('#spg_a_2').val();
						var spg_a_3 = $('#spg_a_3').val();
						var spg_b_1 = $('#spg_b_1').val();
						var spg_b_2 = $('#spg_b_2').val();
						var spg_b_3 = $('#spg_b_3').val();
						var spg_ab_1 = $('#spg_ab_1').val();
						var spg_ab_2 = $('#spg_ab_2').val();
						var spg_ab_3 = $('#spg_ab_3').val();
						var spg_v_1 = $('#spg_v_1').val();
						var spg_v_2 = $('#spg_v_2').val();
						var spg_v_3 = $('#spg_v_3').val();
						var spg_fly_1 = $('#spg_fly_1').val();
						var spg_fly_2 = $('#spg_fly_2').val();
						var spg_fly_3 = $('#spg_fly_3').val();
						var spg_sur_1 = $('#spg_sur_1').val();
						var spg_sur_2 = $('#spg_sur_2').val();
						var spg_sur_3 = $('#spg_sur_3').val();
						var spg_std_1 = $('#spg_std_1').val();
						var spg_std_2 = $('#spg_std_2').val();
						var spg_std_3 = $('#spg_std_3').val();
						var spg_por_std_1 = $('#spg_por_std_1').val();
						var spg_por_std_2 = $('#spg_por_std_2').val();
						var spg_por_std_3 = $('#spg_por_std_3').val();
						var spg_por_test_1 = $('#spg_por_test_1').val();
						var spg_por_test_2 = $('#spg_por_test_2').val();
						var spg_por_test_3 = $('#spg_por_test_3').val();
						var spg_mea_1 = $('#spg_mea_1').val();
						var spg_mea_2 = $('#spg_mea_2').val();
						var spg_mea_3 = $('#spg_mea_3').val();
						var spg_mean_1 = $('#spg_mean_1').val();
						var spg_mean_2 = $('#spg_mean_2').val();
						var spg_mean_3 = $('#spg_mean_3').val();
						var spg_mea_std_1 = $('#spg_mea_std_1').val();
						var spg_mea_std_2 = $('#spg_mea_std_2').val();
						var spg_mea_std_3 = $('#spg_mea_std_3').val();
						var spg_mea_temp_1 = $('#spg_mea_temp_1').val();
						var spg_mea_temp_2 = $('#spg_mea_temp_2').val();
						var spg_mea_temp_3 = $('#spg_mea_temp_3').val();
						var spg_mean_temp_1 = $('#spg_mean_temp_1').val();
						var spg_mean_temp_2 = $('#spg_mean_temp_2').val();
						var spg_mean_temp_3 = $('#spg_mean_temp_3').val();
						var spg_ss_1 = $('#spg_ss_1').val();
						var spg_ss_2 = $('#spg_ss_2').val();
						var spg_ss_3 = $('#spg_ss_3').val();
						break;
					}
					else
					{
						var chk_spg = "0";	
						var spg_a_1 = "0";
						var spg_a_2 = "0";
						var spg_a_3 = "0";
						var spg_b_1 = "0";
						var spg_b_2 = "0";
						var spg_b_3 = "0";
						var spg_ab_1 = "0";
						var spg_ab_2 = "0";
						var spg_ab_3 = "0";
						var spg_v_1 = "0";
						var spg_v_2 = "0";
						var spg_v_3 = "0";
						var spg_fly_1 = "0";
						var spg_fly_2 = "0";
						var spg_fly_3 = "0";
						var spg_sur_1 = "0";
						var spg_sur_2 = "0";
						var spg_sur_3 = "0";
						var spg_std_1 = "0";
						var spg_std_2 = "0";
						var spg_std_3 = "0";
						var spg_por_std_1 = "0";
						var spg_por_std_2 = "0";
						var spg_por_std_3 = "0";
						var spg_por_test_1 = "0";
						var spg_por_test_2 = "0";
						var spg_por_test_3 = "0";
						var spg_mea_1 = "0";
						var spg_mea_2 = "0";
						var spg_mea_3 = "0";
						var spg_mean_1 = "0";
						var spg_mean_2 = "0";
						var spg_mean_3 = "0";
						var spg_mea_std_1 = "0";
						var spg_mea_std_2 = "0";
						var spg_mea_std_3 = "0";
						var spg_mea_temp_1 = "0";
						var spg_mea_temp_2 = "0";
						var spg_mea_temp_3 = "0";
						var spg_mean_temp_1 = "0";
						var spg_mean_temp_2 = "0";
						var spg_mean_temp_3 = "0";
						var spg_ss_1 = "0";
						var spg_ss_2 = "0";
						var spg_ss_3 = "0";
					}
				}
					
					
					billData = '&action_type='+type+'&report_no='+report_no+'&ulr='+ulr+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_set='+chk_set+'&it_1='+it_1+'&it_2='+it_2+'&ft_1='+ft_1+'&ft_2='+ft_2+'&it_ft_1='+it_ft_1+'&it_ft_2='+it_ft_2+'&chk_dry='+chk_dry+'&dry_wt_1='+dry_wt_1+'&dry_wt_2='+dry_wt_2+'&dry_wt_3='+dry_wt_3+'&dry_wt_avg='+dry_wt_avg+'&dry_res_1='+dry_res_1+'&dry_res_2='+dry_res_2+'&dry_res_3='+dry_res_3+'&dry_res_avg='+dry_res_avg+'&dry_sieve_1='+dry_sieve_1+'&dry_sieve_2='+dry_sieve_2+'&dry_sieve_3='+dry_sieve_3+'&dry_sieve_avg='+dry_sieve_avg+'&chk_per='+chk_per+'&per_m2_1='+per_m2_1+'&per_m2_2='+per_m2_2+'&per_m2_3='+per_m2_3+'&per_m3_1='+per_m3_1+'&per_m3_2='+per_m3_2+'&per_m3_3='+per_m3_3+'&per_d_1='+per_d_1+'&per_d_2='+per_d_2+'&per_d_3='+per_d_3+'&per_v_1='+per_v_1+'&per_v_2='+per_v_2+'&per_v_3='+per_v_3+'&per_m1_1='+per_m1_1+'&per_m1_2='+per_m1_2+'&per_m1_3='+per_m1_3+'&per_mea_1='+per_mea_1+'&per_mea_2='+per_mea_2+'&per_mea_3='+per_mea_3+'&per_mean_1='+per_mean_1+'&per_mean_2='+per_mean_2+'&per_mean_3='+per_mean_3+'&per_temp_1='+per_temp_1+'&per_temp_2='+per_temp_2+'&per_temp_3='+per_temp_3+'&per_mean_temp_1='+per_mean_temp_1+'&per_mean_temp_2='+per_mean_temp_2+'&per_mean_temp_3='+per_mean_temp_3+'&per_sur_1='+per_sur_1+'&per_sur_2='+per_sur_2+'&per_sur_3='+per_sur_3+'&chk_sou='+chk_sou+'&sou_1_1='+sou_1_1+'&sou_1_2='+sou_1_2+'&sou_1_3='+sou_1_3+'&sou_2_1='+sou_2_1+'&sou_2_2='+sou_2_2+'&sou_2_3='+sou_2_3+'&sou_avg1='+sou_avg1+'&sou_avg2='+sou_avg2+'&sou_avg3='+sou_avg3+'&chk_com='+chk_com+'&day1='+day1+'&day2='+day2+'&day3='+day3+'&day4='+day4+'&day5='+day5+'&day6='+day6+'&day7='+day7+'&day8='+day8+'&day9='+day9+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&l6='+l6+'&l7='+l7+'&l8='+l8+'&l9='+l9+'&wi1='+wi1+'&wi2='+wi2+'&wi3='+wi3+'&wi4='+wi4+'&wi5='+wi5+'&wi6='+wi6+'&wi7='+wi7+'&wi8='+wi8+'&wi9='+wi9+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&h4='+h4+'&h5='+h5+'&h6='+h6+'&h7='+h7+'&h8='+h8+'&h9='+h9+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&a4='+a4+'&a5='+a5+'&a6='+a6+'&a7='+a7+'&a8='+a8+'&a9='+a9+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&load_6='+load_6+'&load_7='+load_7+'&load_8='+load_8+'&load_9='+load_9+'&com_1='+com_1+'&com_2='+com_2+'&com_3='+com_3+'&com_4='+com_4+'&com_5='+com_5+'&com_6='+com_6+'&com_7='+com_7+'&com_8='+com_8+'&com_9='+com_9+'&avg_com1='+avg_com1+'&avg_com2='+avg_com2+'&avg_com3='+avg_com3+'&chk_lim='+chk_lim+'&lim_wtr_1='+lim_wtr_1+'&lim_wtr_2='+lim_wtr_2+'&lim_wtr_3='+lim_wtr_3+'&lim_wtr_4='+lim_wtr_4+'&lim_wtr_5='+lim_wtr_5+'&lim_mea_1='+lim_mea_1+'&lim_mea_2='+lim_mea_2+'&lim_mea_3='+lim_mea_3+'&lim_mea_4='+lim_mea_4+'&lim_mea_5='+lim_mea_5+'&lim_flow_1='+lim_flow_1+'&lim_flow_2='+lim_flow_2+'&lim_flow_3='+lim_flow_3+'&lim_flow_4='+lim_flow_4+'&lim_flow_5='+lim_flow_5+'&lim_day_1='+lim_day_1+'&lim_day_2='+lim_day_2+'&lim_day_3='+lim_day_3+'&lim_day_4='+lim_day_4+'&lim_day_5='+lim_day_5+'&lim_wt_1='+lim_wt_1+'&lim_wt_2='+lim_wt_2+'&lim_wt_3='+lim_wt_3+'&lim_wt_4='+lim_wt_4+'&lim_wt_5='+lim_wt_5+'&lim_len_1='+lim_len_1+'&lim_len_2='+lim_len_2+'&lim_len_3='+lim_len_3+'&lim_len_4='+lim_len_4+'&lim_len_5='+lim_len_5+'&lim_w_1='+lim_w_1+'&lim_w_2='+lim_w_2+'&lim_w_3='+lim_w_3+'&lim_w_4='+lim_w_4+'&lim_w_5='+lim_w_5+'&lim_h_1='+lim_h_1+'&lim_h_2='+lim_h_2+'&lim_h_3='+lim_h_3+'&lim_h_4='+lim_h_4+'&lim_h_5='+lim_h_5+'&lim_area_1='+lim_area_1+'&lim_area_2='+lim_area_2+'&lim_area_3='+lim_area_3+'&lim_area_4='+lim_area_4+'&lim_area_5='+lim_area_5+'&lim_load_1='+lim_load_1+'&lim_load_2='+lim_load_2+'&lim_load_3='+lim_load_3+'&lim_load_4='+lim_load_4+'&lim_load_5='+lim_load_5+'&lim_com_1='+lim_com_1+'&lim_com_2='+lim_com_2+'&lim_com_3='+lim_com_3+'&lim_com_4='+lim_com_4+'&lim_com_5='+lim_com_5+'&chk_spg='+chk_spg+'&spg_a_1='+spg_a_1+'&spg_a_2='+spg_a_2+'&spg_a_3='+spg_a_3+'&spg_b_1='+spg_b_1+'&spg_b_2='+spg_b_2+'&spg_b_3='+spg_b_3+'&spg_ab_1='+spg_ab_1+'&spg_ab_2='+spg_ab_2+'&spg_ab_3='+spg_ab_3+'&spg_v_1='+spg_v_1+'&spg_v_2='+spg_v_2+'&spg_v_3='+spg_v_3+'&spg_fly_1='+spg_fly_1+'&spg_fly_2='+spg_fly_2+'&spg_fly_3='+spg_fly_3+'&spg_sur_1='+spg_sur_1+'&spg_sur_2='+spg_sur_2+'&spg_sur_3='+spg_sur_3+'&spg_std_1='+spg_std_1+'&spg_std_2='+spg_std_2+'&spg_std_3='+spg_std_3+'&spg_por_std_1='+spg_por_std_1+'&spg_por_std_2='+spg_por_std_2+'&spg_por_std_3='+spg_por_std_3+'&spg_por_test_1='+spg_por_test_1+'&spg_por_test_2='+spg_por_test_2+'&spg_por_test_3='+spg_por_test_3+'&spg_mea_1='+spg_mea_1+'&spg_mea_2='+spg_mea_2+'&spg_mea_3='+spg_mea_3+'&spg_mean_1='+spg_mean_1+'&spg_mean_2='+spg_mean_2+'&spg_mean_3='+spg_mean_3+'&spg_mea_std_1='+spg_mea_std_1+'&spg_mea_std_2='+spg_mea_std_2+'&spg_mea_std_3='+spg_mea_std_3+'&spg_mea_temp_1='+spg_mea_temp_1+'&spg_mea_temp_2='+spg_mea_temp_2+'&spg_mea_temp_3='+spg_mea_temp_3+'&spg_mean_temp_1='+spg_mean_temp_1+'&spg_mean_temp_2='+spg_mean_temp_2+'&spg_mean_temp_3='+spg_mean_temp_3+'&spg_ss_1='+spg_ss_1+'&spg_ss_2='+spg_ss_2+'&spg_ss_3='+spg_ss_3+'&amend_date='+amend_date;
			
					
					
					
					
					
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
				
				//set
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
						var it_1 = $('#it_1').val();
						var it_2 = $('#it_2').val();
						var ft_1 = $('#ft_1').val();
						var ft_2 = $('#ft_2').val();
						var it_ft_1 = $('#it_ft_1').val();
						var it_ft_2 = $('#it_ft_2').val();	

						break;
					}
					else
					{
						var chk_dry = "0";
						var it_1 = "0";
						var it_2 = "0";
						var ft_1 = "0";
						var ft_2 = "0";
						var it_ft_1 = "0";
						var it_ft_2 = "0";

					}
				}
				//dry
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dry")
					{
						if(document.getElementById('chk_dry').checked) {
								var chk_dry = "1";
						}
						else{
								var chk_dry = "0";
						}
						var dry_wt_1 = $('#dry_wt_1').val();
						var dry_wt_2 = $('#dry_wt_2').val();
						var dry_wt_3 = $('#dry_wt_3').val();
						var dry_wt_avg = $('#dry_wt_avg').val();
						var dry_res_1 = $('#dry_res_1').val();
						var dry_res_2 = $('#dry_res_2').val();
						var dry_res_3 = $('#dry_res_3').val();
						var dry_res_avg = $('#dry_res_avg').val();
						var dry_sieve_1 = $('#dry_sieve_1').val();
						var dry_sieve_2 = $('#dry_sieve_2').val();
						var dry_sieve_3 = $('#dry_sieve_3').val();
						var dry_sieve_avg = $('#dry_sieve_avg').val();
						break;
					}
					else
					{
						var chk_dry = "0";	
						var dry_wt_1 = "0";
						var dry_wt_2 = "0";
						var dry_wt_3 = "0";
						var dry_wt_avg = "0";
						var dry_res_1 = "0";
						var dry_res_2 = "0";
						var dry_res_3 = "0";
						var dry_res_avg = "0";
						var dry_sieve_1 = "0";
						var dry_sieve_2 = "0";
						var dry_sieve_3 = "0";
						var dry_sieve_avg = "0";
					}
				}
				
				//per
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="per")
					{
						if(document.getElementById('chk_per').checked) {
								var chk_per = "1";
						}
						else{
								var chk_per = "0";
						}
						var per_m2_1 = $('#per_m2_1').val();
						var per_m2_2 = $('#per_m2_2').val();
						var per_m2_3 = $('#per_m2_3').val();
						var per_m3_1 = $('#per_m3_1').val();
						var per_m3_2 = $('#per_m3_2').val();
						var per_m3_3 = $('#per_m3_3').val();
						var per_d_1 = $('#per_d_1').val();
						var per_d_2 = $('#per_d_2').val();
						var per_d_3 = $('#per_d_3').val();
						var per_v_1 = $('#per_v_1').val();
						var per_v_2 = $('#per_v_2').val();
						var per_v_3 = $('#per_v_3').val();
						var per_m1_1 = $('#per_m1_1').val();
						var per_m1_2 = $('#per_m1_2').val();
						var per_m1_3 = $('#per_m1_3').val();
						var per_mea_1 = $('#per_mea_1').val();
						var per_mea_2 = $('#per_mea_2').val();
						var per_mea_3 = $('#per_mea_3').val();
						var per_mean_1 = $('#per_mean_1').val();
						var per_mean_2 = $('#per_mean_2').val();
						var per_mean_3 = $('#per_mean_3').val();
						var per_temp_1 = $('#per_temp_1').val();
						var per_temp_2 = $('#per_temp_2').val();
						var per_temp_3 = $('#per_temp_3').val();
						var per_mean_temp_1 = $('#per_mean_temp_1').val();
						var per_mean_temp_2 = $('#per_mean_temp_2').val();
						var per_mean_temp_3 = $('#per_mean_temp_3').val();
						var per_sur_1 = $('#per_sur_1').val();
						var per_sur_2 = $('#per_sur_2').val();
						var per_sur_3 = $('#per_sur_3').val();
						break;
					}
					else
					{
						var chk_per = "0";	
						var per_m2_1 = "0";
						var per_m2_2 = "0";
						var per_m2_3 = "0";
						var per_m3_1 = "0";
						var per_m3_2 = "0";
						var per_m3_3 = "0";
						var per_d_1 = "0";
						var per_d_2 = "0";
						var per_d_3 = "0";
						var per_v_1 = "0";
						var per_v_2 = "0";
						var per_v_3 = "0";
						var per_m1_1 = "0";
						var per_m1_2 = "0";
						var per_m1_3 = "0";
						var per_mea_1 = "0";
						var per_mea_2 = "0";
						var per_mea_3 = "0";
						var per_mean_1 = "0";
						var per_mean_2 = "0";
						var per_mean_3 = "0";
						var per_temp_1 = "0";
						var per_temp_2 = "0";
						var per_temp_3 = "0";
						var per_mean_temp_1 = "0";
						var per_mean_temp_2 = "0";
						var per_mean_temp_3 = "0";
						var per_sur_1 = "0";
						var per_sur_2 = "0";
						var per_sur_3 = "0";

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
						var sou_1_1 = $('#sou_1_1').val();
						var sou_1_2 = $('#sou_1_2').val();
						var sou_1_3 = $('#sou_1_3').val();
						var sou_2_1 = $('#sou_2_1').val();
						var sou_2_2 = $('#sou_2_2').val();
						var sou_2_3 = $('#sou_2_3').val();
						var sou_avg1 = $('#sou_avg1').val();
						var sou_avg2 = $('#sou_avg2').val();
						var sou_avg3 = $('#sou_avg3').val();						
						break;
					}
					else
					{
						var chk_sou = "0";	
						var sou_1_1 = "0";
						var sou_1_2 = "0";
						var sou_1_3 = "0";
						var sou_2_1 = "0";
						var sou_2_2 = "0";
						var sou_2_3 = "0";
						var sou_avg1 = "0";
						var sou_avg2 = "0";
						var sou_avg3 = "0";				

					}
				}
				
				//lim
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="lim")
					{
						if(document.getElementById('chk_lim').checked) {
								var chk_lim = "1";
						}
						else{
								var chk_lim = "0";
						}
						var lim_wtr_1 = $('#lim_wtr_1').val();
						var lim_wtr_2 = $('#lim_wtr_2').val();
						var lim_wtr_3 = $('#lim_wtr_3').val();
						var lim_wtr_4 = $('#lim_wtr_4').val();
						var lim_wtr_5 = $('#lim_wtr_5').val();
						var lim_mea_1 = $('#lim_mea_1').val();
						var lim_mea_2 = $('#lim_mea_2').val();
						var lim_mea_3 = $('#lim_mea_3').val();
						var lim_mea_4 = $('#lim_mea_4').val();
						var lim_mea_5 = $('#lim_mea_5').val();
						var lim_flow_1 = $('#lim_flow_1').val();
						var lim_flow_2 = $('#lim_flow_2').val();
						var lim_flow_3 = $('#lim_flow_3').val();
						var lim_flow_4 = $('#lim_flow_4').val();
						var lim_flow_5 = $('#lim_flow_5').val();
						var lim_day_1 = $('#lim_day_1').val();
						var lim_day_2 = $('#lim_day_2').val();
						var lim_day_3 = $('#lim_day_3').val();
						var lim_day_4 = $('#lim_day_4').val();
						var lim_day_5 = $('#lim_day_5').val();
						var lim_wt_1 = $('#lim_wt_1').val();
						var lim_wt_2 = $('#lim_wt_2').val();
						var lim_wt_3 = $('#lim_wt_3').val();
						var lim_wt_4 = $('#lim_wt_4').val();
						var lim_wt_5 = $('#lim_wt_5').val();
						var lim_len_1 = $('#lim_len_1').val();
						var lim_len_2 = $('#lim_len_2').val();
						var lim_len_3 = $('#lim_len_3').val();
						var lim_len_4 = $('#lim_len_4').val();
						var lim_len_5 = $('#lim_len_5').val();
						var lim_w_1 = $('#lim_w_1').val();
						var lim_w_2 = $('#lim_w_2').val();
						var lim_w_3 = $('#lim_w_3').val();
						var lim_w_4 = $('#lim_w_4').val();
						var lim_w_5 = $('#lim_w_5').val();
						var lim_h_1 = $('#lim_h_1').val();
						var lim_h_2 = $('#lim_h_2').val();
						var lim_h_3 = $('#lim_h_3').val();
						var lim_h_4 = $('#lim_h_4').val();
						var lim_h_5 = $('#lim_h_5').val();
						var lim_area_1 = $('#lim_area_1').val();
						var lim_area_2 = $('#lim_area_2').val();
						var lim_area_3 = $('#lim_area_3').val();
						var lim_area_4 = $('#lim_area_4').val();
						var lim_area_5 = $('#lim_area_5').val();
						var lim_load_1 = $('#lim_load_1').val();
						var lim_load_2 = $('#lim_load_2').val();
						var lim_load_3 = $('#lim_load_3').val();
						var lim_load_4 = $('#lim_load_4').val();
						var lim_load_5 = $('#lim_load_5').val();
						var lim_com_1 = $('#lim_com_1').val();
						var lim_com_2 = $('#lim_com_2').val();
						var lim_com_3 = $('#lim_com_3').val();
						var lim_com_4 = $('#lim_com_4').val();
						var lim_com_5 = $('#lim_com_5').val();
					
						break;
					}
					else
					{
						var chk_lim = "0";	
						var lim_wtr_1 = "0";	
						var lim_wtr_2 = "0";	
						var lim_wtr_3 = "0";	
						var lim_wtr_4 = "0";	
						var lim_wtr_5 = "0";	
						var lim_mea_1 = "0";	
						var lim_mea_2 = "0";	
						var lim_mea_3 = "0";	
						var lim_mea_4 = "0";	
						var lim_mea_5 = "0";	
						var lim_flow_1 = "0";	
						var lim_flow_2 = "0";	
						var lim_flow_3 = "0";	
						var lim_flow_4 = "0";	
						var lim_flow_5 = "0";	
						var lim_day_1 = "0";	
						var lim_day_2 = "0";	
						var lim_day_3 = "0";	
						var lim_day_4 = "0";	
						var lim_day_5 = "0";	
						var lim_wt_1 = "0";	
						var lim_wt_2 = "0";	
						var lim_wt_3 = "0";	
						var lim_wt_4 = "0";	
						var lim_wt_5 = "0";	
						var lim_len_1 = "0";	
						var lim_len_2 = "0";	
						var lim_len_3 = "0";	
						var lim_len_4 = "0";	
						var lim_len_5 = "0";	
						var lim_w_1 = "0";	
						var lim_w_2 = "0";	
						var lim_w_3 = "0";	
						var lim_w_4 = "0";	
						var lim_w_5 = "0";	
						var lim_h_1 = "0";	
						var lim_h_2 = "0";	
						var lim_h_3 = "0";	
						var lim_h_4 = "0";	
						var lim_h_5 = "0";	
						var lim_area_1 = "0";	
						var lim_area_2 = "0";	
						var lim_area_3 = "0";	
						var lim_area_4 = "0";	
						var lim_area_5 = "0";	
						var lim_load_1 = "0";	
						var lim_load_2 = "0";	
						var lim_load_3 = "0";	
						var lim_load_4 = "0";	
						var lim_load_5 = "0";	
						var lim_com_1 = "0";	
						var lim_com_2 = "0";	
						var lim_com_3 = "0";	
						var lim_com_4 = "0";	
						var lim_com_5 = "0";	
					}
				}
				
				//compressive strength
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
						var day1 = $('#day1').val();
						var day2 = $('#day2').val();
						var day3 = $('#day3').val();
						var day4 = $('#day4').val();
						var day5 = $('#day5').val();
						var day6 = $('#day6').val();
						var day7 = $('#day7').val();
						var day8 = $('#day8').val();
						var day9 = $('#day9').val();
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
						var h1 = $('#h1').val();
						var h2 = $('#h2').val();
						var h3 = $('#h3').val();
						var h4 = $('#h4').val();
						var h5 = $('#h5').val();
						var h6 = $('#h6').val();
						var h7 = $('#h7').val();
						var h8 = $('#h8').val();
						var h9 = $('#h9').val();
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
						var avg_com1 = $('#avg_com1').val();
						var avg_com2 = $('#avg_com2').val();
						var avg_com3 = $('#avg_com3').val();
						break;
					}
					else
					{
						var chk_com = "0";	
						var day1 = "0";	
						var day2 = "0";	
						var day3 = "0";	
						var day4 = "0";	
						var day5 = "0";	
						var day6 = "0";	
						var day7 = "0";	
						var day8 = "0";	
						var day9 = "0";	
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
						var h1 = "0";	
						var h2 = "0";	
						var h3 = "0";	
						var h4 = "0";	
						var h5 = "0";	
						var h6 = "0";	
						var h7 = "0";	
						var h8 = "0";	
						var h9 = "0";	
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
						var avg_com1 = "0";	
						var avg_com2 = "0";	
						var avg_com3 = "0";	
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
						var spg_a_1 = $('#spg_a_1').val();
						var spg_a_2 = $('#spg_a_2').val();
						var spg_a_3 = $('#spg_a_3').val();
						var spg_b_1 = $('#spg_b_1').val();
						var spg_b_2 = $('#spg_b_2').val();
						var spg_b_3 = $('#spg_b_3').val();
						var spg_ab_1 = $('#spg_ab_1').val();
						var spg_ab_2 = $('#spg_ab_2').val();
						var spg_ab_3 = $('#spg_ab_3').val();
						var spg_v_1 = $('#spg_v_1').val();
						var spg_v_2 = $('#spg_v_2').val();
						var spg_v_3 = $('#spg_v_3').val();
						var spg_fly_1 = $('#spg_fly_1').val();
						var spg_fly_2 = $('#spg_fly_2').val();
						var spg_fly_3 = $('#spg_fly_3').val();
						var spg_sur_1 = $('#spg_sur_1').val();
						var spg_sur_2 = $('#spg_sur_2').val();
						var spg_sur_3 = $('#spg_sur_3').val();
						var spg_std_1 = $('#spg_std_1').val();
						var spg_std_2 = $('#spg_std_2').val();
						var spg_std_3 = $('#spg_std_3').val();
						var spg_por_std_1 = $('#spg_por_std_1').val();
						var spg_por_std_2 = $('#spg_por_std_2').val();
						var spg_por_std_3 = $('#spg_por_std_3').val();
						var spg_por_test_1 = $('#spg_por_test_1').val();
						var spg_por_test_2 = $('#spg_por_test_2').val();
						var spg_por_test_3 = $('#spg_por_test_3').val();
						var spg_mea_1 = $('#spg_mea_1').val();
						var spg_mea_2 = $('#spg_mea_2').val();
						var spg_mea_3 = $('#spg_mea_3').val();
						var spg_mean_1 = $('#spg_mean_1').val();
						var spg_mean_2 = $('#spg_mean_2').val();
						var spg_mean_3 = $('#spg_mean_3').val();
						var spg_mea_std_1 = $('#spg_mea_std_1').val();
						var spg_mea_std_2 = $('#spg_mea_std_2').val();
						var spg_mea_std_3 = $('#spg_mea_std_3').val();
						var spg_mea_temp_1 = $('#spg_mea_temp_1').val();
						var spg_mea_temp_2 = $('#spg_mea_temp_2').val();
						var spg_mea_temp_3 = $('#spg_mea_temp_3').val();
						var spg_mean_temp_1 = $('#spg_mean_temp_1').val();
						var spg_mean_temp_2 = $('#spg_mean_temp_2').val();
						var spg_mean_temp_3 = $('#spg_mean_temp_3').val();
						var spg_ss_1 = $('#spg_ss_1').val();
						var spg_ss_2 = $('#spg_ss_2').val();
						var spg_ss_3 = $('#spg_ss_3').val();
						break;
					}
					else
					{
						var chk_spg = "0";	
						var spg_a_1 = "0";
						var spg_a_2 = "0";
						var spg_a_3 = "0";
						var spg_b_1 = "0";
						var spg_b_2 = "0";
						var spg_b_3 = "0";
						var spg_ab_1 = "0";
						var spg_ab_2 = "0";
						var spg_ab_3 = "0";
						var spg_v_1 = "0";
						var spg_v_2 = "0";
						var spg_v_3 = "0";
						var spg_fly_1 = "0";
						var spg_fly_2 = "0";
						var spg_fly_3 = "0";
						var spg_sur_1 = "0";
						var spg_sur_2 = "0";
						var spg_sur_3 = "0";
						var spg_std_1 = "0";
						var spg_std_2 = "0";
						var spg_std_3 = "0";
						var spg_por_std_1 = "0";
						var spg_por_std_2 = "0";
						var spg_por_std_3 = "0";
						var spg_por_test_1 = "0";
						var spg_por_test_2 = "0";
						var spg_por_test_3 = "0";
						var spg_mea_1 = "0";
						var spg_mea_2 = "0";
						var spg_mea_3 = "0";
						var spg_mean_1 = "0";
						var spg_mean_2 = "0";
						var spg_mean_3 = "0";
						var spg_mea_std_1 = "0";
						var spg_mea_std_2 = "0";
						var spg_mea_std_3 = "0";
						var spg_mea_temp_1 = "0";
						var spg_mea_temp_2 = "0";
						var spg_mea_temp_3 = "0";
						var spg_mean_temp_1 = "0";
						var spg_mean_temp_2 = "0";
						var spg_mean_temp_3 = "0";
						var spg_ss_1 = "0";
						var spg_ss_2 = "0";
						var spg_ss_3 = "0";
					}
				}
				
				var idEdit = $('#idEdit').val(); 
		
				billData = '&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&ulr='+ulr+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_set='+chk_set+'&it_1='+it_1+'&it_2='+it_2+'&ft_1='+ft_1+'&ft_2='+ft_2+'&it_ft_1='+it_ft_1+'&it_ft_2='+it_ft_2+'&chk_dry='+chk_dry+'&dry_wt_1='+dry_wt_1+'&dry_wt_2='+dry_wt_2+'&dry_wt_3='+dry_wt_3+'&dry_wt_avg='+dry_wt_avg+'&dry_res_1='+dry_res_1+'&dry_res_2='+dry_res_2+'&dry_res_3='+dry_res_3+'&dry_res_avg='+dry_res_avg+'&dry_sieve_1='+dry_sieve_1+'&dry_sieve_2='+dry_sieve_2+'&dry_sieve_3='+dry_sieve_3+'&dry_sieve_avg='+dry_sieve_avg+'&chk_per='+chk_per+'&per_m2_1='+per_m2_1+'&per_m2_2='+per_m2_2+'&per_m2_3='+per_m2_3+'&per_m3_1='+per_m3_1+'&per_m3_2='+per_m3_2+'&per_m3_3='+per_m3_3+'&per_d_1='+per_d_1+'&per_d_2='+per_d_2+'&per_d_3='+per_d_3+'&per_v_1='+per_v_1+'&per_v_2='+per_v_2+'&per_v_3='+per_v_3+'&per_m1_1='+per_m1_1+'&per_m1_2='+per_m1_2+'&per_m1_3='+per_m1_3+'&per_mea_1='+per_mea_1+'&per_mea_2='+per_mea_2+'&per_mea_3='+per_mea_3+'&per_mean_1='+per_mean_1+'&per_mean_2='+per_mean_2+'&per_mean_3='+per_mean_3+'&per_temp_1='+per_temp_1+'&per_temp_2='+per_temp_2+'&per_temp_3='+per_temp_3+'&per_mean_temp_1='+per_mean_temp_1+'&per_mean_temp_2='+per_mean_temp_2+'&per_mean_temp_3='+per_mean_temp_3+'&per_sur_1='+per_sur_1+'&per_sur_2='+per_sur_2+'&per_sur_3='+per_sur_3+'&chk_sou='+chk_sou+'&sou_1_1='+sou_1_1+'&sou_1_2='+sou_1_2+'&sou_1_3='+sou_1_3+'&sou_2_1='+sou_2_1+'&sou_2_2='+sou_2_2+'&sou_2_3='+sou_2_3+'&sou_avg1='+sou_avg1+'&sou_avg2='+sou_avg2+'&sou_avg3='+sou_avg3+'&chk_com='+chk_com+'&day1='+day1+'&day2='+day2+'&day3='+day3+'&day4='+day4+'&day5='+day5+'&day6='+day6+'&day7='+day7+'&day8='+day8+'&day9='+day9+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&l6='+l6+'&l7='+l7+'&l8='+l8+'&l9='+l9+'&wi1='+wi1+'&wi2='+wi2+'&wi3='+wi3+'&wi4='+wi4+'&wi5='+wi5+'&wi6='+wi6+'&wi7='+wi7+'&wi8='+wi8+'&wi9='+wi9+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&h4='+h4+'&h5='+h5+'&h6='+h6+'&h7='+h7+'&h8='+h8+'&h9='+h9+'&a1='+a1+'&a2='+a2+'&a3='+a3+'&a4='+a4+'&a5='+a5+'&a6='+a6+'&a7='+a7+'&a8='+a8+'&a9='+a9+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&load_6='+load_6+'&load_7='+load_7+'&load_8='+load_8+'&load_9='+load_9+'&com_1='+com_1+'&com_2='+com_2+'&com_3='+com_3+'&com_4='+com_4+'&com_5='+com_5+'&com_6='+com_6+'&com_7='+com_7+'&com_8='+com_8+'&com_9='+com_9+'&avg_com1='+avg_com1+'&avg_com2='+avg_com2+'&avg_com3='+avg_com3+'&chk_lim='+chk_lim+'&lim_wtr_1='+lim_wtr_1+'&lim_wtr_2='+lim_wtr_2+'&lim_wtr_3='+lim_wtr_3+'&lim_wtr_4='+lim_wtr_4+'&lim_wtr_5='+lim_wtr_5+'&lim_mea_1='+lim_mea_1+'&lim_mea_2='+lim_mea_2+'&lim_mea_3='+lim_mea_3+'&lim_mea_4='+lim_mea_4+'&lim_mea_5='+lim_mea_5+'&lim_flow_1='+lim_flow_1+'&lim_flow_2='+lim_flow_2+'&lim_flow_3='+lim_flow_3+'&lim_flow_4='+lim_flow_4+'&lim_flow_5='+lim_flow_5+'&lim_day_1='+lim_day_1+'&lim_day_2='+lim_day_2+'&lim_day_3='+lim_day_3+'&lim_day_4='+lim_day_4+'&lim_day_5='+lim_day_5+'&lim_wt_1='+lim_wt_1+'&lim_wt_2='+lim_wt_2+'&lim_wt_3='+lim_wt_3+'&lim_wt_4='+lim_wt_4+'&lim_wt_5='+lim_wt_5+'&lim_len_1='+lim_len_1+'&lim_len_2='+lim_len_2+'&lim_len_3='+lim_len_3+'&lim_len_4='+lim_len_4+'&lim_len_5='+lim_len_5+'&lim_w_1='+lim_w_1+'&lim_w_2='+lim_w_2+'&lim_w_3='+lim_w_3+'&lim_w_4='+lim_w_4+'&lim_w_5='+lim_w_5+'&lim_h_1='+lim_h_1+'&lim_h_2='+lim_h_2+'&lim_h_3='+lim_h_3+'&lim_h_4='+lim_h_4+'&lim_h_5='+lim_h_5+'&lim_area_1='+lim_area_1+'&lim_area_2='+lim_area_2+'&lim_area_3='+lim_area_3+'&lim_area_4='+lim_area_4+'&lim_area_5='+lim_area_5+'&lim_load_1='+lim_load_1+'&lim_load_2='+lim_load_2+'&lim_load_3='+lim_load_3+'&lim_load_4='+lim_load_4+'&lim_load_5='+lim_load_5+'&lim_com_1='+lim_com_1+'&lim_com_2='+lim_com_2+'&lim_com_3='+lim_com_3+'&lim_com_4='+lim_com_4+'&lim_com_5='+lim_com_5+'&chk_spg='+chk_spg+'&spg_a_1='+spg_a_1+'&spg_a_2='+spg_a_2+'&spg_a_3='+spg_a_3+'&spg_b_1='+spg_b_1+'&spg_b_2='+spg_b_2+'&spg_b_3='+spg_b_3+'&spg_ab_1='+spg_ab_1+'&spg_ab_2='+spg_ab_2+'&spg_ab_3='+spg_ab_3+'&spg_v_1='+spg_v_1+'&spg_v_2='+spg_v_2+'&spg_v_3='+spg_v_3+'&spg_fly_1='+spg_fly_1+'&spg_fly_2='+spg_fly_2+'&spg_fly_3='+spg_fly_3+'&spg_sur_1='+spg_sur_1+'&spg_sur_2='+spg_sur_2+'&spg_sur_3='+spg_sur_3+'&spg_std_1='+spg_std_1+'&spg_std_2='+spg_std_2+'&spg_std_3='+spg_std_3+'&spg_por_std_1='+spg_por_std_1+'&spg_por_std_2='+spg_por_std_2+'&spg_por_std_3='+spg_por_std_3+'&spg_por_test_1='+spg_por_test_1+'&spg_por_test_2='+spg_por_test_2+'&spg_por_test_3='+spg_por_test_3+'&spg_mea_1='+spg_mea_1+'&spg_mea_2='+spg_mea_2+'&spg_mea_3='+spg_mea_3+'&spg_mean_1='+spg_mean_1+'&spg_mean_2='+spg_mean_2+'&spg_mean_3='+spg_mean_3+'&spg_mea_std_1='+spg_mea_std_1+'&spg_mea_std_2='+spg_mea_std_2+'&spg_mea_std_3='+spg_mea_std_3+'&spg_mea_temp_1='+spg_mea_temp_1+'&spg_mea_temp_2='+spg_mea_temp_2+'&spg_mea_temp_3='+spg_mea_temp_3+'&spg_mean_temp_1='+spg_mean_temp_1+'&spg_mean_temp_2='+spg_mean_temp_2+'&spg_mean_temp_3='+spg_mean_temp_3+'&spg_ss_1='+spg_ss_1+'&spg_ss_2='+spg_ss_2+'&spg_ss_3='+spg_ss_3+'&amend_date='+amend_date;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_flyash.php',
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
        url: '<?php echo $base_url; ?>save_flyash.php',
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

				
			//set
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="set")
				{
					var chk_set = data.chk_set;
					if(chk_set=="1")
					{
						$('#txtset').css("background-color","var(--success)");
						$("#chk_set").prop("checked", true); 
					}else{
						$('#txtset').css("background-color","white");
						$("#chk_set").prop("checked", false); 
					}
					$('#it_1').val(data.it_1);
					$('#it_2').val(data.it_2);
					$('#ft_1').val(data.ft_1);
					$('#ft_2').val(data.ft_2);
					$('#it_ft_1').val(data.it_ft_1);
					$('#it_ft_2').val(data.it_ft_2);
					break;
				}
				else
				{
				}
			}
			
			//dry
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="dry")
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
					$('#dry_wt_1').val(data.dry_wt_1);
					$('#dry_wt_2').val(data.dry_wt_2);
					$('#dry_wt_3').val(data.dry_wt_3);
					$('#dry_wt_avg').val(data.dry_wt_avg);
					$('#dry_res_1').val(data.dry_res_1);
					$('#dry_res_2').val(data.dry_res_2);
					$('#dry_res_3').val(data.dry_res_3);
					$('#dry_res_avg').val(data.dry_res_avg);
					$('#dry_sieve_1').val(data.dry_sieve_1);
					$('#dry_sieve_2').val(data.dry_sieve_2);
					$('#dry_sieve_3').val(data.dry_sieve_3);
					$('#dry_sieve_avg').val(data.dry_sieve_avg);
					break;
				}
				else
				{
				}
			}
			
			//per
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="per")
				{
					var chk_per = data.chk_per;
					if(chk_per=="1")
					{
						$('#txtper').css("background-color","var(--success)");
						$("#chk_per").prop("checked", true); 
					}else{
						$('#txtper').css("background-color","white");
						$("#chk_per").prop("checked", false); 
					}
					$('#per_m2_1').val(data.per_m2_1);
					$('#per_m2_2').val(data.per_m2_2);
					$('#per_m2_3').val(data.per_m2_3);
					$('#per_m3_1').val(data.per_m3_1);
					$('#per_m3_2').val(data.per_m3_2);
					$('#per_m3_3').val(data.per_m3_3);
					$('#per_d_1').val(data.per_d_1);
					$('#per_d_2').val(data.per_d_2);
					$('#per_d_3').val(data.per_d_3);
					$('#per_v_1').val(data.per_v_1);
					$('#per_v_2').val(data.per_v_2);
					$('#per_v_3').val(data.per_v_3);
					$('#per_m1_1').val(data.per_m1_1);
					$('#per_m1_2').val(data.per_m1_2);
					$('#per_m1_3').val(data.per_m1_3);
					$('#per_mea_1').val(data.per_mea_1);
					$('#per_mea_2').val(data.per_mea_2);
					$('#per_mea_3').val(data.per_mea_3);
					$('#per_mean_1').val(data.per_mean_1);
					$('#per_mean_2').val(data.per_mean_2);
					$('#per_mean_3').val(data.per_mean_3);
					$('#per_temp_1').val(data.per_temp_1);
					$('#per_temp_2').val(data.per_temp_2);
					$('#per_temp_3').val(data.per_temp_3);
					$('#per_mean_temp_1').val(data.per_mean_temp_1);
					$('#per_mean_temp_2').val(data.per_mean_temp_2);
					$('#per_mean_temp_3').val(data.per_mean_temp_3);
					$('#per_sur_1').val(data.per_sur_1);
					$('#per_sur_2').val(data.per_sur_2);
					$('#per_sur_3').val(data.per_sur_3);
					break;
				}
				else
				{
				}
			}
			
			//sou
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
					$('#sou_1_1').val(data.sou_1_1);
					$('#sou_1_2').val(data.sou_1_2);
					$('#sou_1_3').val(data.sou_1_3);
					$('#sou_2_1').val(data.sou_2_1);
					$('#sou_2_2').val(data.sou_2_2);
					$('#sou_2_3').val(data.sou_2_3);
					$('#sou_avg1').val(data.sou_avg1);
					$('#sou_avg2').val(data.sou_avg2);
					$('#sou_avg3').val(data.sou_avg3);
					break;
				}
				else
				{
				}
			}
			
			//lim
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="lim")
				{
					var chk_lim = data.chk_lim;
					if(chk_lim=="1")
					{
						$('#txtlim').css("background-color","var(--success)");
						$("#chk_lim").prop("checked", true); 
					}else{
						$('#txtlim').css("background-color","white");
						$("#chk_lim").prop("checked", false); 
					}
					$('#lim_wtr_1').val(data.lim_wtr_1);
					$('#lim_wtr_2').val(data.lim_wtr_2);
					$('#lim_wtr_3').val(data.lim_wtr_3);
					$('#lim_wtr_4').val(data.lim_wtr_4);
					$('#lim_wtr_5').val(data.lim_wtr_5);
					$('#lim_mea_1').val(data.lim_mea_1);
					$('#lim_mea_2').val(data.lim_mea_2);
					$('#lim_mea_3').val(data.lim_mea_3);
					$('#lim_mea_4').val(data.lim_mea_4);
					$('#lim_mea_5').val(data.lim_mea_5);
					$('#lim_flow_1').val(data.lim_flow_1);
					$('#lim_flow_2').val(data.lim_flow_2);
					$('#lim_flow_3').val(data.lim_flow_3);
					$('#lim_flow_4').val(data.lim_flow_4);
					$('#lim_flow_5').val(data.lim_flow_5);
					$('#lim_day_1').val(data.lim_day_1);
					$('#lim_day_2').val(data.lim_day_2);
					$('#lim_day_3').val(data.lim_day_3);
					$('#lim_day_4').val(data.lim_day_4);
					$('#lim_day_5').val(data.lim_day_5);
					$('#lim_wt_1').val(data.lim_wt_1);
					$('#lim_wt_2').val(data.lim_wt_2);
					$('#lim_wt_3').val(data.lim_wt_3);
					$('#lim_wt_4').val(data.lim_wt_4);
					$('#lim_wt_5').val(data.lim_wt_5);
					$('#lim_len_1').val(data.lim_len_1);
					$('#lim_len_2').val(data.lim_len_2);
					$('#lim_len_3').val(data.lim_len_3);
					$('#lim_len_4').val(data.lim_len_4);
					$('#lim_len_5').val(data.lim_len_5);
					$('#lim_w_1').val(data.lim_w_1);
					$('#lim_w_2').val(data.lim_w_2);
					$('#lim_w_3').val(data.lim_w_3);
					$('#lim_w_4').val(data.lim_w_4);
					$('#lim_w_5').val(data.lim_w_5);
					$('#lim_h_1').val(data.lim_h_1);
					$('#lim_h_2').val(data.lim_h_2);
					$('#lim_h_3').val(data.lim_h_3);
					$('#lim_h_4').val(data.lim_h_4);
					$('#lim_h_5').val(data.lim_h_5);
					$('#lim_area_1').val(data.lim_area_1);
					$('#lim_area_2').val(data.lim_area_2);
					$('#lim_area_3').val(data.lim_area_3);
					$('#lim_area_4').val(data.lim_area_4);
					$('#lim_area_5').val(data.lim_area_5);
					$('#lim_load_1').val(data.lim_load_1);
					$('#lim_load_2').val(data.lim_load_2);
					$('#lim_load_3').val(data.lim_load_3);
					$('#lim_load_4').val(data.lim_load_4);
					$('#lim_load_5').val(data.lim_load_5);
					$('#lim_com_1').val(data.lim_com_1);
					$('#lim_com_2').val(data.lim_com_2);
					$('#lim_com_3').val(data.lim_com_3);
					$('#lim_com_4').val(data.lim_com_4);
					$('#lim_com_5').val(data.lim_com_5);
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
						$('#comp').css("background-color","var(--success)");
						$("#chk_com").prop("checked", true); 
					}else{
						$('#comp').css("background-color","white");
						$("#chk_com").prop("checked", false); 
					}
					$('#day1').val(data.day1);
					$('#day2').val(data.day2);
					$('#day3').val(data.day3);
					$('#day4').val(data.day4);
					$('#day5').val(data.day5);
					$('#day6').val(data.day6);
					$('#day7').val(data.day7);
					$('#day8').val(data.day8);
					$('#day9').val(data.day9);
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
					$('#h1').val(data.h1);
					$('#h2').val(data.h2);
					$('#h3').val(data.h3);
					$('#h4').val(data.h4);
					$('#h5').val(data.h5);
					$('#h6').val(data.h6);
					$('#h7').val(data.h7);
					$('#h8').val(data.h8);
					$('#h9').val(data.h9);
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
					$('#avg_com1').val(data.avg_com1);
					$('#avg_com2').val(data.avg_com2);
					$('#avg_com3').val(data.avg_com3);

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
				{
					var chk_spg = data.chk_spg;
					if(chk_spg=="1")
					{
						$('#txtspg').css("background-color","var(--success)");
						$("#chk_spg").prop("checked", true); 
					}else{
						$('#txtspg').css("background-color","white");
						$("#chk_spg").prop("checked", false); 
					}
					$('#spg_a_1').val(data.spg_a_1);
					$('#spg_a_2').val(data.spg_a_2);
					$('#spg_a_3').val(data.spg_a_3);
					$('#spg_b_1').val(data.spg_b_1);
					$('#spg_b_2').val(data.spg_b_2);
					$('#spg_b_3').val(data.spg_b_3);
					$('#spg_ab_1').val(data.spg_ab_1);
					$('#spg_ab_2').val(data.spg_ab_2);
					$('#spg_ab_3').val(data.spg_ab_3);
					$('#spg_v_1').val(data.spg_v_1);
					$('#spg_v_2').val(data.spg_v_2);
					$('#spg_v_3').val(data.spg_v_3);
					$('#spg_fly_1').val(data.spg_fly_1);
					$('#spg_fly_2').val(data.spg_fly_2);
					$('#spg_fly_3').val(data.spg_fly_3);
					$('#spg_sur_1').val(data.spg_sur_1);
					$('#spg_sur_2').val(data.spg_sur_2);
					$('#spg_sur_3').val(data.spg_sur_3);
					$('#spg_std_1').val(data.spg_std_1);
					$('#spg_std_2').val(data.spg_std_2);
					$('#spg_std_3').val(data.spg_std_3);
					$('#spg_por_std_1').val(data.spg_por_std_1);
					$('#spg_por_std_2').val(data.spg_por_std_2);
					$('#spg_por_std_3').val(data.spg_por_std_3);
					$('#spg_por_test_1').val(data.spg_por_test_1);
					$('#spg_por_test_2').val(data.spg_por_test_2);
					$('#spg_por_test_3').val(data.spg_por_test_3);
					$('#spg_mea_1').val(data.spg_mea_1);
					$('#spg_mea_2').val(data.spg_mea_2);
					$('#spg_mea_3').val(data.spg_mea_3);
					$('#spg_mean_1').val(data.spg_mean_1);
					$('#spg_mean_2').val(data.spg_mean_2);
					$('#spg_mean_3').val(data.spg_mean_3);
					$('#spg_mea_std_1').val(data.spg_mea_std_1);
					$('#spg_mea_std_2').val(data.spg_mea_std_2);
					$('#spg_mea_std_3').val(data.spg_mea_std_3);
					$('#spg_mea_temp_1').val(data.spg_mea_temp_1);
					$('#spg_mea_temp_2').val(data.spg_mea_temp_2);
					$('#spg_mea_temp_3').val(data.spg_mea_temp_3);
					$('#spg_mean_temp_1').val(data.spg_mean_temp_1);
					$('#spg_mean_temp_2').val(data.spg_mean_temp_2);
					$('#spg_mean_temp_3').val(data.spg_mean_temp_3);
					$('#spg_ss_1').val(data.spg_ss_1);
					$('#spg_ss_2').val(data.spg_ss_2);
					$('#spg_ss_3').val(data.spg_ss_3);
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



