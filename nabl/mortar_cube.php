
<?php 
session_start(); 
include("header.php");
//REMOVE SIDE BAR
/*include("sidebar.php");*/
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
					$cc_grade= $row_select4['cc_grade'];
					$cc_day= $row_select4['cc_day'];
					$cc_set_of_cube= $row_select4['cc_set_of_cube'];
					$cc_no_of_cube= $row_select4['cc_no_of_cube'];
					$day_remark= $row_select4['day_remark'];
					$casting_date= $row_select4['casting_date'];
					$cc_qty= $row_select4['cc_qty'];
					//$cc_qty= "10";
					$cc_identification_mark= $row_select4['cc_identification_mark'];
				}
				
				
		
?>
<div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content common_material p-0">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">MORTAR CUBE</h2>
					</div>
					<div class="box-default">
					<form class="form" id="Glazed" method="post">
						<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">

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
											<label for="inputEmail3" class="col-sm-2 control-label"> QTY. :</label>									 
										  <div class="col-sm-4">
											<input type="text" class="form-control inputs" tabindex="4" id="cc_qty" value="2" name="cc_qty" >
										  </div>
										  <label for="inputEmail3" class="col-sm-2 control-label"> ID MARK. :</label>									 
										  <div class="col-sm-4">
											<input type="text" class="form-control inputs" tabindex="4" id="cc_identification_mark" value="<?php echo $cc_identification_mark;?>" name="cc_identification_mark" >
										  </div>
										  </div>
									</div>
									
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
											<input type="text" class="form-control inputs" tabindex="4" id="top_grade" value="<?php echo $cc_grade;?>" name="top_grade" ReadOnly>
										  </div>
										  
										  <label for="inputEmail3" class="col-sm-2 control-label">Casting Date :</label>								 
										  <div class="col-sm-2">
										  <input type="text" class="form-control startdate_class" id="casting_date" name="casting_date" placeholder="Casting Date" value="">
											<input type="text" class="form-control inputs" tabindex="4" id="top_casting_date" value="<?php echo date('d/m/Y', strtotime($casting_date));?>" name="top_casting_date" ReadOnly>
										  </div>
										  
										   <label for="inputEmail3" class="col-sm-2 control-label">Day :</label>								 
										  <div class="col-sm-2">
										  <select class="form-control" id="day" name="day">
																<option value="7">7 Days</option>
																<option value="28">28 Days</option>
																<!--<option value="7_28">7 & 28 Days</option>-->
																<option value="other">Other</option>
																	
																</select>
											<input type="text" class="form-control inputs" tabindex="4" id="top_days" value="<?php echo $cc_day;?>" name="top_days" >
										  </div>
										  
										</div>
									</div>
									
								</div>
								
								<br>
							<!-- LAB NO PUT VAIBHAV-->
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">Remarks.:</label>-->
										 

										  <div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_remark" value="<?php echo $day_remark;?>" name="top_remark" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										<!--	<label for="inputEmail3" class="col-sm-2 control-label">Cube Set :</label>	-->								 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_set" value="<?php echo $cc_set_of_cube;?>" name="top_set" ReadOnly>
										  </div>
										  
										 <!-- <label for="inputEmail3" class="col-sm-2 control-label">No. Of Cube :</label>	-->								 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_no_of_cube" value="<?php echo $cc_no_of_cube;?>" name="top_no_of_cube" ReadOnly>
										  </div> 
										 <!-- <label for="inputEmail3" class="col-sm-2 control-label">ULR No. :</label>	-->								 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
										  </div>
										  
										  
										  
										</div>
									</div>
									
								</div>
								
								<br>
									<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
										
											<div class="col-sm-1">
												<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="idEdit" id="idEdit"/>

											</div>
											
											<?php   
													/*$querys_job1 = "SELECT * FROM mortar_cube WHERE `is_deleted`='0' and lab_no='$lab_no'";
													$qrys_jobno = mysqli_query($conn,$querys_job1);
													$rows=mysqli_num_rows($qrys_jobno);
													if($rows < 1){*/ ?>
											<div class="col-sm-2">
												<!-- SAVE BUTTON LOGIC VAIBHAV-->
												
														
														<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >save</button>
														
											</div>
											
											<?php
													/*}*/
													
											?>
											<div class="col-sm-1">
												<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>

											</div>
											<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
											<?php
											$val =  $_SESSION['isadmin'];
											//if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
											?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_mortar_cube.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											
											<?php //} ?>
											<!--<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_c_c_cube.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

											</div-->
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
			
			if($r1['test_code']=="com")
			{
				$test_check.="com,";
			?>
				<div class="panel panel-default" id="com">
					<div class="panel-heading" id="txtdim">
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
							<br>
							<div class="row">									
								
								<div class="col-lg-12">
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
								<div class="col-md-5">
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Grade</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<!--<label for="inputEmail3" class="control-label">Mark on Cube</label>-->
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Date of Casting</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Age of Testing (Days)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Actual Date of Testing</label>
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Dimensions of cube L MM</label>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Dimensions of cube B MM</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Dimensions of cube H MM</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Cross Sectional Area (mm2)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Weight of Cube (kg)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Maximum load (KN)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Compressive Strength (N/mm 2 )</label>
										</div>
									</div>
								</div>
								<div class="col-md-1">
									
									<div class="col-md-10">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Average of Compressive Strength (N/mm2)</label>
										</div>
									</div>
								</div>
								<div class="col-md-1">
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Failure Pattern</label>
										</div>
									</div>
								</div>
								
							</div>
						
							<div class="panel-body">
								
							<br>
							<!--Flakiness Index VALUE SR 1-->
								<div class="row">
								<div class="col-md-5">
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="grade1" name="grade1" readonly>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">																					
											<input type="text" class="form-control  startdate_class" id="caste_date1" name="caste_date1" readonly>
									
										</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="day1" name="day1" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="test_date1" name="test_date1" readonly>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l1" name="l1" >
										</div>
									</div>
								</div>
								<div class="col-md-5">
									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b1" name="b1" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h1" name="h1" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="cross_1" name="cross_1" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="mass_1" name="mass_1" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="load_1" name="load_1" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="comp_1" name="comp_1" >
										</div>
									</div>
								</div>
								<div class="col-md-1">									
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_com_s_1" name="avg_com_s_1" >						
										</div>
										
									</div>
								</div>
								<div class="col-md-1">									
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="fail_pat_1" name="fail_pat_1" >						
										</div>
										
									</div>
								</div>
								
							</div>
							<br>						
							<!--Flakiness Index VALUE SR 2-->
								<div class="row">
								<div class="col-md-5">
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
										
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l2" name="l2" >
										</div>
									</div>
								</div>
								<div class="col-md-5">
									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b2" name="b2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h2" name="h2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="cross_2" name="cross_2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="mass_2" name="mass_2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="load_2" name="load_2" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="comp_2" name="comp_2" >
										</div>
									</div>
								</div>
								<div class="col-md-1">
									<div class="col-sm-12">
											
										</div>
									
								</div>
								<div class="col-md-1">									
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="fail_pat_2" name="fail_pat_2" >						
										</div>
										
									</div>
								</div>
							</div>
							<br>
							<!--Flakiness Index VALUE SR 3-->
								<div class="row">
								<div class="col-md-5">
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="l3" name="l3" >
										</div>
									</div>
								</div>
								<div class="col-md-5">
									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b3" name="b3" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h3" name="h3" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="cross_3" name="cross_3" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="mass_3" name="mass_3" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="load_3" name="load_3" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="comp_3" name="comp_3" >
										</div>
									</div>
								</div>
								<div class="col-md-1">
									
									
								</div>
								<div class="col-md-1">									
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="fail_pat_3" name="fail_pat_3" >						
										</div>
										
									</div>
								</div>
							</div>						
							<br>
							<br>
							<div class="row">
							
									<div class="col-md-1">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Remarks : </label>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<input type="text" class="form-control" id="remarks" name="remarks" >
										</div>
									</div>
								</div>
							
								
						
						</div>
				  </div>
				</div>
				
		
		
					</div>	
					
					
				<?php } else if ($r1['test_code'] == "chl") {
									$test_check .= "chl,"; ?>

									<div class="panel panel-default" id="chl">
										<div class="panel-heading" id="txtchl">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ospichl">
													<h4 class="panel-title">
														<b>CHLORIDE</b>
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
																<input type="checkbox" class="visually-hidden" name="chk_chl" id="chk_chl" value="chk_chl"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">CHLORIDE</label>
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

													<div class="col-lg-3">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Test Method</label>
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group">
																<input type="text" class="form-control" id="chl_test_method" name="chl_test_method" Value="<?php echo $r1["test_method"]; ?>">
																<input type="hidden" class="form-control" id="chl_test_id" name="chl_test_id" Value="<?php echo $r1["test"]; ?>">
																<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"]; ?>">
																<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"]; ?>">
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Requirement IS</label>
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group">
																<input type="text" class="form-control" id="chl_test_req" name="chl_test_req" Value="">
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Limit</label>
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group">
																<input type="text" class="form-control" id="chl_test_limit" name="chl_test_limit" Value="">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="col-md-3">
															<div class="form-group">
																<button type="button" class="btn btn-info pull-right" onclick="saveIs('update_chl','<?php echo $r1["test"]; ?>','<?php echo $r1["material_category"]; ?>','<?php echo $r1["material_id"]; ?>')" name="btn_update_is" id="btn_update_is" tabindex="14">Update IS</button>
															</div>
														</div>

													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Burate Reading<br>(A)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Burate Reading blank<br>(B)</label>
														</div>
													</div>


													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Volume of Sample (ml)<br>(V)</label>

														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">N (AgNo<sub>3</sub>)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Chloride (mg/l)=<br>(A - B) X N X 35450/V</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Average</label>
														</div>
													</div>




												</div>
												<br>
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="cha1" name="cha1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chb1" name="chb1">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chc1" name="chc1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chd1" name="chd1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ch1" name="ch1">
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
																<input type="text" class="form-control" id="cha2" name="cha2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chb2" name="chb2">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chc2" name="chc2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="chd2" name="chd2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="ch2" name="ch2">
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
								<?php } else if ($r1['test_code'] == "sul") {
									$test_check .= "sul,"; ?>

									<div class="panel panel-default" id="sul">
										<div class="panel-heading" id="txtsul">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse31ospisul">
													<h4 class="panel-title">
														<b>SULPHETES</b>
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
																<input type="checkbox" class="visually-hidden" name="chk_sul" id="chk_sul" value="chk_sul"><br>
															</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">SULPHETES</label>
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

													<div class="col-lg-3">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Test Method</label>
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group">
																<input type="text" class="form-control" id="sul_test_method" name="sul_test_method" Value="<?php echo $r1["test_method"]; ?>">
																<input type="hidden" class="form-control" id="sul_test_id" name="sul_test_id" Value="<?php echo $r1["test"]; ?>">
																<input type="hidden" class="form-control" id="material_category" name="material_category" Value="<?php echo $r1["material_category"]; ?>">
																<input type="hidden" class="form-control" id="material_id" name="material_id" Value="<?php echo $r1["material_id"]; ?>">
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Requirement IS</label>
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group">
																<input type="text" class="form-control" id="sul_test_req" name="sul_test_req" Value="">
															</div>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="col-md-3">
															<div class="form-group">
																<label for="inputEmail3" class="control-label">Limit</label>
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group">
																<input type="text" class="form-control" id="sul_test_limit" name="sul_test_limit" Value="">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="col-md-3">
															<div class="form-group">
																<button type="button" class="btn btn-info pull-right" onclick="saveIs('update_sul','<?php echo $r1["test"]; ?>','<?php echo $r1["material_category"]; ?>','<?php echo $r1["material_id"]; ?>')" name="btn_update_is" id="btn_update_is" tabindex="14">Update IS</button>
															</div>
														</div>

													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Wt. of empty platinum crucible(g)<br>(M1)</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Wt.of platinum Crucible+ residue(g)<br>(M2)</label>
														</div>
													</div>


													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Diff. in Wt. in mg<br> M = M2 - M1</label>

														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Volume of Sample (ml)</label>

														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Total Sulphites (mg/l)=<br>M X 343110/Volume of smaple</label>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<label for="inputEmail3" class="control-label">Average</label>
														</div>
													</div>




												</div>
												<br>
												<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
												<div class="row">
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sua1" name="sua1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sub1" name="sub1">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="suc1" name="suc1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sud1" name="sud1">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="su1" name="su1">
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
																<input type="text" class="form-control" id="sua2" name="sua2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sub2" name="sub2">
															</div>
														</div>
													</div>

													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="suc2" name="suc2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sud2" name="sud2">
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="su2" name="su2">
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
																<label for="inputEmail3" class="control-label">Total = </label>
															</div>
														</div>
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="sutotal" name="sutotal">mg/l
															</div>
														</div>
													</div>


												</div>

											</div>

										</div>
									</div>	

			<?php }
		}?>	
			
			<hr>
		<!-- DISPLAY DATA LOGIC VAIBHAV-->
		<div id="display_data">	
		<div class="row">
					<div class="col-lg-12">
						<table border="1px solid black" align="center" width="100%" id="aaaa">
							<tr>
								<th style="text-align:center;" width="10%"><label>Actions</label></th>											
								<th style="text-align:center;"><label>Sr. No.</label></th>	
								<th style="text-align:center;"><label>Lab No.</label></th>	
								<th style="text-align:center;"><label>Job No.</label></th>	
								<th style="text-align:center;"><label>Casting Date</label></th>	
								<th style="text-align:center;"><label>Testing Date</label></th>	
								<th style="text-align:center;"><label>Days</label></th>	
								<th style="text-align:center;"><label>Grade</label></th>	
								<th style="text-align:center;"><label>Identification Mark</label></th>	
								<th style="text-align:center;"><label>Avg. Compressive Strength</label></th>	
							
							
																		

							</tr>
								<?php
							 $query = "select * from mortar_cube WHERE lab_no='$aa'  and `is_deleted`='0' ORDER BY `id`";

								$result = mysqli_query($conn, $query);
			
								$cnt=0;
								$detail=0;
								if (mysqli_num_rows($result) > 0) {
							while($r = mysqli_fetch_array($result)){
										$cnt++;
										$detail+=2;
										if($r['is_deleted'] == 0){
										?>
										<tr>
																				
										<td style="text-align:center;" width="10%">	
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="ccDelete('<?php echo $r['id']; ?>')"></a>
										
										</td>
										
										<td style="text-align:center;"><?php echo $cnt;?></td>
										<td style="text-align:center;"><?php echo $r['job_no'];?></td>
										<td style="text-align:center;"><?php echo $r['lab_no'];?></td>					
										<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['caste_date1']));?></td>	
										<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['test_date1']));?></td>	
										<td style="text-align:center;"><?php echo $r['day1'];?></td>					
										<td style="text-align:center;"><?php echo $r['cc_grade'];?></td>					
										<td style="text-align:center;"><?php echo $r['cc_identification_mark'];?></td>					
										<td style="text-align:center;"><?php echo $r['avg_com_s_1'];?></td>					
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
getGlazedTiles();	


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
	 
	$('.startdate_class').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	});
	

  $(function () {
    $('.select2').select2();
  });
  function com_auto()
	{
		var cast = $('#top_casting_date').val();
				document.getElementById('caste_date1').value = cast;
				var top_days = $('#top_days').val();
				var top_grade = $('#top_grade').val();
					
				if(top_days=="7")
				{
						var top = 7;
						var date_input = document.getElementById("caste_date1").value.split('/');
						//alert(date_input);
						var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);
						//alert(date);
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
					   $('#day1').val(top);
						
						var mass_1 = randomNumberFromRange(8.10, 8.80);
						var mass_2 = randomNumberFromRange(8.10, 8.80);
						var mass_3 = randomNumberFromRange(8.10, 8.80);
						
					if(top_grade =="M-5")
					{
						var avg_com_s_1 = randomNumberFromRange(3.70, 4.40);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					
					if(top_grade =="M-7.5")
					{
						var avg_com_s_1 = randomNumberFromRange(5.40, 6.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					
					if(top_grade =="M-10")
					{
						var avg_com_s_1 = randomNumberFromRange(7.40, 9.10);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-15")
					{
						var avg_com_s_1 = randomNumberFromRange(11.80, 13.30);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
						
					}
					else if(top_grade=="M-20")
					{
						var avg_com_s_1 = randomNumberFromRange(14.50, 17.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-25")
					{
						var avg_com_s_1 = randomNumberFromRange(19.00, 22.00);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-30")
					{
						var avg_com_s_1 = randomNumberFromRange(22.00, 25.00);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-35")
					{
						var avg_com_s_1 = randomNumberFromRange(25.80, 29.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.80,1.80);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.80,1.80);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="M-40")
					{
						var avg_com_s_1 = randomNumberFromRange(30.10, 34.00);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-45")
					{
						var avg_com_s_1 = randomNumberFromRange(32.50, 36.20);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
					
					}
					else if(top_grade=="M-50")
					{
						var avg_com_s_1 = randomNumberFromRange(36.50, 41.00);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:3:6")
					{
						var avg_com_s_1 = randomNumberFromRange(7.40, 9.10);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
					
					}
					else if(top_grade=="1:2:4")
					{
						var avg_com_s_1 = randomNumberFromRange(11.80, 13.30);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1.5:3")
					{
						var avg_com_s_1 = randomNumberFromRange(14.50, 17.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1:2")
					{
						var avg_com_s_1 = randomNumberFromRange(19.00, 22.00);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					
					
				}
				else if(top_days=="28")
				{	
						var top = 28;
						var date_input = document.getElementById("caste_date1").value.split('/');
						//alert(date_input);
						var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);
						//alert(date);
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
					   $('#day1').val(top);
						
						var mass_1 = randomNumberFromRange(8.10, 8.80);
						var mass_2 = randomNumberFromRange(8.10, 8.80);
						var mass_3 = randomNumberFromRange(8.10, 8.80);
						
					if(top_grade =="M-5")
					{
						var avg_com_s_1 = randomNumberFromRange(5.20, 6.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					
					if(top_grade =="M-7.5")
					{
						var avg_com_s_1 = randomNumberFromRange(7.70, 9.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					
					if(top_grade =="M-10")
					{
						var avg_com_s_1 = randomNumberFromRange(11.10, 13.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-15")
					{
						var avg_com_s_1 = randomNumberFromRange(16.30, 18.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-20")
					{
						var avg_com_s_1 = randomNumberFromRange(22.00, 23.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-25")
					{
						var avg_com_s_1 = randomNumberFromRange(26.50, 29.10);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.50,0.50);
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.50,0.50);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-30")
					{
						var avg_com_s_1 = randomNumberFromRange(32.00, 33.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-35")
					{
						var avg_com_s_1 = randomNumberFromRange(37.00, 38.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-40")
					{
						var avg_com_s_1 = randomNumberFromRange(42.00, 43.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-45")
					{
						var avg_com_s_1 = randomNumberFromRange(47.00, 48.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-50")
					{
						var avg_com_s_1 = randomNumberFromRange(52.00, 53.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="1:3:6")
					{
						var avg_com_s_1 = randomNumberFromRange(11.10, 13.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="1:2:4")
					{
						var avg_com_s_1 = randomNumberFromRange(16.30, 18.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="1:1.5:3")
					{
						var avg_com_s_1 = randomNumberFromRange(22.00, 23.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="1:1:2")
					{
						var avg_com_s_1 = randomNumberFromRange(26.50, 29.10);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
						
					
				}
				
				else if(top_days=="other")
				{
						
						var day1 = ('#day1').val();
						var date_input = document.getElementById("caste_date1").value.split('/');
						//alert(date_input);
						var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);
						//alert(date);
						var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + parseInt(day1));
						var dd = newdate.getDate();
						var mm = newdate.getMonth() + 1;
						var y = newdate.getFullYear();
						if(mm <= 9)
						mm = '0'+mm;
						if(dd <= 9)
						dd = '0'+dd;
						var someFormattedDate = dd + '/' + mm + '/' + y;				
						document.getElementById('test_date1').value = someFormattedDate;
						document.getElementById('test_date2').value = someFormattedDate;
						document.getElementById('test_date3').value = someFormattedDate;						
						$('#day2').val(day1);
						$('#day3').val(day1);
						
						var mass_1 = randomNumberFromRange(8.10, 8.80);
						var mass_2 = randomNumberFromRange(8.10, 8.80);
						var mass_3 = randomNumberFromRange(8.10, 8.80);
						
						
					if(top_grade =="M-5")
					{
						var avg_com_s_1 = randomNumberFromRange(3.70, 4.40);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					
					if(top_grade =="M-7.5")
					{
						var avg_com_s_1 = randomNumberFromRange(5.40, 6.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}

					if(top_grade =="M-10")
					{
						var avg_com_s_1 = randomNumberFromRange(7.40, 9.10);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-15")
					{
						var avg_com_s_1 = randomNumberFromRange(11.80, 13.30);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
						
					}
					else if(top_grade=="M-20")
					{
						var avg_com_s_1 = randomNumberFromRange(14.50, 17.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-25")
					{
						var avg_com_s_1 = randomNumberFromRange(19.00, 22.00);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-30")
					{
						var avg_com_s_1 = randomNumberFromRange(22.00, 26.00);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-35")
					{
						var avg_com_s_1 = randomNumberFromRange(26.60, 31.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.80,1.80);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.80,1.80);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="M-40")
					{
						var avg_com_s_1 = randomNumberFromRange(30.10, 34.00);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-45")
					{
						var avg_com_s_1 = randomNumberFromRange(32.50, 36.20);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
					
					}
					else if(top_grade=="M-50")
					{
						var avg_com_s_1 = randomNumberFromRange(36.50, 46.00);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-2.00,2.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:3:6")
					{
						var avg_com_s_1 = randomNumberFromRange(7.40, 9.10);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
					
					}
					else if(top_grade=="1:2:4")
					{
						var avg_com_s_1 = randomNumberFromRange(11.80, 13.30);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.30,0.80);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1.5:3")
					{
						var avg_com_s_1 = randomNumberFromRange(14.50, 17.50);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.00,1.00);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1:2")
					{
						var avg_com_s_1 = randomNumberFromRange(19.00, 22.00);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-1.50,1.50);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var sums = (+com1)+(+com2);
						var comp_3 = ((+avg_com_s1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
						
					
					
				}
		
				var rr = $('#lab_no').val();
				var grade = $('#top_grade').val();
				var grade1 = grade;
				$('#grade1').val(grade1);
				var l1 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var l2 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var l3 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				
				$('#l1').val(l1);
				$('#l2').val(l2);
				$('#l3').val(l3);
				var b1 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var b2 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var b3 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				$('#b1').val(b1);
				$('#b2').val(b2);
				$('#b3').val(b3);
				var h1 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var h2 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var h3 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				$('#h1').val(h1);
				$('#h2').val(h2);
				$('#h3').val(h3);
				var l_1  = $('#l1').val();
				var l_2  = $('#l2').val();
				var l_3  = $('#l3').val();
				var b_1  = $('#b1').val();
				var b_2  = $('#b2').val();
				var b_3  = $('#b3').val();
				var cross_1 = (+l1) * (+b1);
				var cross_2 = (+l2) * (+b2);
				var cross_3 = (+l3) * (+b3);
				$('#cross_1').val(cross_1.toFixed(1));
				$('#cross_2').val(cross_2.toFixed(1));
				$('#cross_3').val(cross_3.toFixed(1));
				
				
				
				$('#mass_1').val(mass_1.toFixed(2));
				$('#mass_2').val(mass_2.toFixed(2));
				$('#mass_3').val(mass_3.toFixed(2));
				
				var cr1= $('#cross_1').val();
				var cr2= $('#cross_2').val();
				var cr3= $('#cross_3').val();
				
				var com1 = $('#comp_1').val();
				var com2 = $('#comp_2').val();
				var com3 = $('#comp_3').val();
				
				var load_1 = ((+cr1)*(+com1))/1000;
				var load_2 = ((+cr2)*(+com2))/1000;
				var load_3 = ((+cr3)*(+com3))/1000;
				
				$('#load_1').val(load_1.toFixed(1));
				$('#load_2').val(load_2.toFixed(1));
				$('#load_3').val(load_3.toFixed(1));
				
				var load1 = $('#load_1').val();
				var load2 = $('#load_2').val();
				var load3 = $('#load_3').val();
				
				var comp1 = ((+load1)*1000)/(+cr1);
				var comp2 = ((+load2)*1000)/(+cr2);
				var comp3 = ((+load3)*1000)/(+cr3);
				
				$('#comp_1').val(comp1.toFixed(2));
				$('#comp_2').val(comp2.toFixed(2));
				$('#comp_3').val(comp3.toFixed(2));
				
				var c_om1 = $('#comp_1').val();
				var c_om2 = $('#comp_2').val();
				var c_om3 = $('#comp_3').val();
				
				var ags = ((+c_om1) + (+c_om2) + (+c_om3))/3;
				$('#avg_com_s_1').val(ags.toFixed(2));
				
				
				
	}
	
	
	
	
		function chl_auto() {
			var kk = randomNumberFromRange(1, 9).toFixed();
			if (kk % 2 == 0) {
				var cha1 = randomNumberFromRange(2.00, 5.00).toFixed(1);
				var cha2 = (+cha1) + 0.1;
				$('#cha1').val((+cha1).toFixed(1));
				$('#cha2').val((+cha2).toFixed(1));

			} else {
				var cha1 = randomNumberFromRange(2.00, 5.00).toFixed(1);
				var cha2 = (+cha1) - 0.1;
				$('#cha1').val((+cha1).toFixed(1));
				$('#cha2').val((+cha2).toFixed(1));
			}


			var cha_1 = $('#cha1').val();
			var cha_2 = $('#cha2').val();

			var chb1 = randomNumberFromRange(0.10, 0.10).toFixed(2);
			var chb2 = randomNumberFromRange(0.10, 0.10).toFixed(2);
			$('#chb1').val(chb1);
			$('#chb2').val(chb2);

			var chb_1 = $('#chb1').val();
			var chb_2 = $('#chb2').val();


			var chc1 = randomNumberFromRange(25, 25).toFixed();
			var chc2 = randomNumberFromRange(25, 25).toFixed();
			$('#chc1').val(chc1);
			$('#chc2').val(chc2);

			var chc_1 = $('#chc1').val();
			var chc_2 = $('#chc2').val();

			var chd1 = randomNumberFromRange(0.0141, 0.0141).toFixed(4);
			var chd2 = randomNumberFromRange(0.0141, 0.0141).toFixed(4);
			$('#chd1').val(chd1);
			$('#chd2').val(chd2);

			var chd_1 = $('#chd1').val();
			var chd_2 = $('#chd2').val();

			var ch1 = (((+cha_1) - (+chb_1)) * (+chd_1) * (+35450)) / (+chc_1);
			var ch2 = (((+cha_2) - (+chb_2)) * (+chd_2) * (+35450)) / (+chc_2);
			$('#ch1').val(ch1.toFixed(2));
			$('#ch2').val(ch2.toFixed(2));

			var ch_1 = $('#ch1').val();
			var ch_2 = $('#ch2').val();

			var avgch = ((+ch_1) + (+ch_2)) / 2;
			$('#avgch').val(avgch.toFixed(2));


		}

		$('#chk_chl').change(function() {
			if (this.checked) {
				chl_auto();

			} else {
				$('#cha1').val(null);
				$('#cha2').val(null);
				$('#chb1').val(null);
				$('#chb2').val(null);
				$('#chc1').val(null);
				$('#chc2').val(null);
				$('#chd1').val(null);
				$('#chd2').val(null);
				$('#ch1').val(null);
				$('#ch2').val(null);

				$('#avgch').val(null);



			}
		});



		$('#cha1,#cha2,#chb1,#chb2,#chd1,#chd2,#chc1,#chc2').change(function() {
			$('#txtchl').css("background-color", "var(--success)");


			var cha_1 = $('#cha1').val();
			var cha_2 = $('#cha2').val();


			var chb_1 = $('#chb1').val();
			var chb_2 = $('#chb2').val();



			var chc_1 = $('#chc1').val();
			var chc_2 = $('#chc2').val();


			var chd_1 = $('#chd1').val();
			var chd_2 = $('#chd2').val();

			var ch1 = (((+cha_1) - (+chb_1)) * (+chd_1) * (+35450)) / (+chc_1);
			var ch2 = (((+cha_2) - (+chb_2)) * (+chd_2) * (+35450)) / (+chc_2);
			$('#ch1').val(ch1.toFixed(2));
			$('#ch2').val(ch2.toFixed(2));

			var ch_1 = $('#ch1').val();
			var ch_2 = $('#ch2').val();

			var avgch = ((+ch_1) + (+ch_2)) / 2;
			$('#avgch').val(avgch.toFixed(2));

		});


		function sul_auto() {
			var kk = randomNumberFromRange(1, 9).toFixed();
			if (kk % 2 == 0) {
				var sua1 = randomNumberFromRange(40.1910, 40.1914).toFixed(4);
				var sua2 = (+sua1) + 0.0001;
				$('#sua1').val((+sua1).toFixed(4));
				$('#sua2').val((+sua2).toFixed(4));

				var sub1 = randomNumberFromRange(40.2788, 40.2798).toFixed(4);
				var sub2 = (+sub1) - 0.0001;
				$('#sub1').val((+sub1).toFixed(4));
				$('#sub2').val((+sub2).toFixed(4));
			} else {
				var sua1 = randomNumberFromRange(40.1910, 40.1914).toFixed(4);
				var sua2 = (+sua1) - 0.0001;
				$('#sua1').val((+sua1).toFixed(4));
				$('#sua2').val((+sua2).toFixed(4));

				var sub1 = randomNumberFromRange(40.2788, 40.2798).toFixed(4);
				var sub2 = (+sub1) + 0.0001;
				$('#sub1').val((+sub1).toFixed(4));
				$('#sub2').val((+sub2).toFixed(4));
			}




			var sua_1 = $('#sua1').val();
			var sua_2 = $('#sua2').val();

			var sub_1 = $('#sub1').val();
			var sub_2 = $('#sub2').val();


			var suc1 = (+sub_1) - (+sua_1);
			var suc2 = (+sub_2) - (+sua_2);
			$('#suc1').val(suc1.toFixed(4));
			$('#suc2').val(suc2.toFixed(4));

			var suc_1 = $('#suc1').val();
			var suc_2 = $('#suc2').val();

			var sud1 = randomNumberFromRange(150, 150).toFixed();
			var sud2 = randomNumberFromRange(150, 150).toFixed();
			$('#sud1').val(sud1);
			$('#sud2').val(sud2);

			var sud_1 = $('#sud1').val();
			var sud_2 = $('#sud2').val();

			var su1 = ((+suc_1) * (+343110)) / (+sud_1);
			var su2 = ((+suc_2) * (+343110)) / (+sud_2);
			$('#su1').val(su1.toFixed());
			$('#su2').val(su2.toFixed());

			var su_1 = $('#su1').val();
			var su_2 = $('#su2').val();

			var avgsu = ((+su_1) + (+su_2)) / 2;
			$('#avgsu').val(avgsu.toFixed());
		}

		$('#chk_sul').change(function() {
			if (this.checked) {
				sul_auto();

			} else {
				$('#sua1').val(null);
				$('#sua2').val(null);
				$('#sub1').val(null);
				$('#sub2').val(null);
				$('#suc1').val(null);
				$('#suc2').val(null);
				$('#sud1').val(null);
				$('#sud2').val(null);
				$('#su1').val(null);
				$('#su2').val(null);

				$('#avgsu').val(null);
				$('#sutotal').val(null);



			}
		});



		$('#sua1,#sua2,#sub1,#sub2,#sud1,#sud2').change(function() {
			$('#txtsul').css("background-color", "var(--success)");


			var sua_1 = $('#sua1').val();
			var sua_2 = $('#sua2').val();


			var sub_1 = $('#sub1').val();
			var sub_2 = $('#sub2').val();


			var suc1 = (+sub_1) - (+sua_1);
			var suc2 = (+sub_2) - (+sua_2);
			$('#suc1').val(suc1.toFixed(4));
			$('#suc2').val(suc2.toFixed(4));

			var suc_1 = $('#suc1').val();
			var suc_2 = $('#suc2').val();


			var sud_1 = $('#sud1').val();
			var sud_2 = $('#sud2').val();

			var su1 = ((+suc_1) * (+411500)) / (+sud_1);
			var su2 = ((+suc_2) * (+411500)) / (+sud_2);
			$('#su1').val(su1.toFixed());
			$('#su2').val(su2.toFixed());

			var su_1 = $('#su1').val();
			var su_2 = $('#su2').val();

			var avgsu = ((+su_1) + (+su_2)) / 2;
			$('#avgsu').val(avgsu.toFixed());

		});

	
	
	
	
	
	
	
$(document).ready(function(){ 
			   
	$('#btn_edit_data').hide();
	$('#alert').hide();
	
	
	$('#day').change(function(){
		
		$('#top_days').val($('#day').val());			
		$('#day1').val($('#day').val());
		var cast = $('#top_casting_date').val();
		document.getElementById('caste_date1').value = cast;
		var top = $('#top_days').val();
		var date_input = document.getElementById("caste_date1").value.split('/');
		//alert(date_input);
		var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);
		//alert(date);
		var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + (+top));
		var dd = newdate.getDate();
		var mm = newdate.getMonth() + 1;
		var y = newdate.getFullYear();
		if(mm <= 9)
		mm = '0'+mm;
		if(dd <= 9)
		dd = '0'+dd;
		var someFormattedDate = dd + '/' + mm + '/' + y;				
	  document.getElementById('test_date1').value = someFormattedDate;
	});
	$('#top_days').change(function(){
		
		
		$('#day1').val($('#top_days').val());
		var cast = $('#top_casting_date').val();
		document.getElementById('caste_date1').value = cast;
		var top = $('#top_days').val();
		var date_input = document.getElementById("caste_date1").value.split('/');
		//alert(date_input);
		var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);
		//alert(date);
		var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + (+top));
		var dd = newdate.getDate();
		var mm = newdate.getMonth() + 1;
		var y = newdate.getFullYear();
		if(mm <= 9)
		mm = '0'+mm;
		if(dd <= 9)
		dd = '0'+dd;
		var someFormattedDate = dd + '/' + mm + '/' + y;				
	  document.getElementById('test_date1').value = someFormattedDate;
	});
	
	$('#cube_grade').change(function(){
		
		$('#top_grade').val($('#cube_grade').val());			
		$('#grade1').val($('#cube_grade').val());			
	});
	
	$('#casting_date').change(function(){
		
		$('#top_casting_date').val($('#casting_date').val());			
		$('#caste_date1').val($('#casting_date').val());

		var cast = $('#top_casting_date').val();
		document.getElementById('caste_date1').value = cast;
		var top = $('#top_days').val();
		var date_input = document.getElementById("caste_date1").value.split('/');
		//alert(date_input);
		var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);
		//alert(date);
		var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + (+top));
		var dd = newdate.getDate();
		var mm = newdate.getMonth() + 1;
		var y = newdate.getFullYear();
		if(mm <= 9)
		mm = '0'+mm;
		if(dd <= 9)
		dd = '0'+dd;
		var someFormattedDate = dd + '/' + mm + '/' + y;				
	  document.getElementById('test_date1').value = someFormattedDate;
	});
	
	
	
	$('#grade1').val($('#top_grade').val());
	var cast = $('#top_casting_date').val();
	document.getElementById('caste_date1').value = cast;
	var top = $('#top_days').val();
	var date_input = document.getElementById("caste_date1").value.split('/');
	//alert(date_input);
	var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);
	//alert(date);
	var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + (+top));
	var dd = newdate.getDate();
	var mm = newdate.getMonth() + 1;
	var y = newdate.getFullYear();
	if(mm <= 9)
	mm = '0'+mm;
	if(dd <= 9)
	dd = '0'+dd;
	var someFormattedDate = dd + '/' + mm + '/' + y;				
  document.getElementById('test_date1').value = someFormattedDate;
   $('#day1').val(top);
   
   $('#chk_auto').change(function(){
        if(this.checked)
		{ 
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				//flx
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						$('#txtdim').css("background-color","var(--success)");
						$("#chk_com").prop("checked", true); 
						com_auto();
						break;
					}					
				}
				
				//chl
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "chl") {
						$('#txtchl').css("background-color", "var(--success)");
						$("#chk_chl").prop("checked", true);
						chl_auto();
						break;
					}
				}

				//sul
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sul") {
						$('#txtsul').css("background-color", "var(--success)");
						$("#chk_sul").prop("checked", true);
						sul_auto();
						break;
					}
				}

		}
	});
	
	
	$('#chk_com').change(function(){
		if(this.checked)
		{ 
			com_auto();	
				
		}
		else
		{
			$('#caste_date1').val(null);
			$('#day1').val(null);
			$('#test_date1').val(null);
	
			$('#grade1').val(grade1);
			$('#l1').val(null);
			$('#l2').val(null);
			$('#l3').val(null);
			$('#b1').val(null);
			$('#b2').val(null);
			$('#b3').val(null);
			$('#h1').val(null);
			$('#h2').val(null);
			$('#h3').val(null);
			$('#cross_1').val(null);
			$('#cross_2').val(null);
			$('#cross_3').val(null);
			$('#mass_1').val(null);
			$('#mass_2').val(null);
			$('#mass_3').val(null);
			$('#load_1').val(null);
			$('#load_2').val(null);
			$('#load_3').val(null);
			$('#comp_1').val(null);
			$('#comp_2').val(null);
			$('#comp_3').val(null);
			$('#avg_com_s_1').val(null);
		}
		
	});
	
	
	
	function func_set_1_l_b()
	{		
		
			var l1 = $('#l1').val();
			var l2 = $('#l2').val();
			var l3 = $('#l3').val();
			var b1 = $('#b1').val();
			var b2 = $('#b2').val();
			var b3 = $('#b3').val();
			var cross_1 = (+l1) * (+b1);
			var cross_2 = (+l2) * (+b2);
			var cross_3 = (+l3) * (+b3);
			$('#cross_1').val(cross_1.toFixed(1));
			$('#cross_2').val(cross_2.toFixed(1));
			$('#cross_3').val(cross_3.toFixed(1));
			
			var cr1= $('#cross_1').val();
			var cr2= $('#cross_2').val();
			var cr3= $('#cross_3').val();
			var comp_1 = $('#comp_1').val();
			var comp_2 = $('#comp_2').val();
			var comp_3 = $('#comp_3').val();
			
			var load_1 = ((+cr1)*(+comp_1))/1000;
			var load_2 = ((+cr2)*(+comp_2))/1000;
			var load_3 = ((+cr3)*(+comp_3))/1000;
			$('#load_1').val(load_1.toFixed(1));
			$('#load_2').val(load_2.toFixed(1));
			$('#load_3').val(load_3.toFixed(1));
			
			var load1 = $('#load_1').val();
			var load2 = $('#load_2').val();
			var load3 = $('#load_3').val();
			
			var comp1 = ((+load1)*1000)/(+cr1);
			var comp2 = ((+load2)*1000)/(+cr2);
			var comp3 = ((+load3)*1000)/(+cr3);
			
			$('#comp_1').val(comp1.toFixed(2));
			$('#comp_2').val(comp2.toFixed(2));
			$('#comp_3').val(comp3.toFixed(2));
			
			var c_om1 = $('#comp_1').val();
			var c_om2 = $('#comp_2').val();
			var c_om3 = $('#comp_3').val();
			
			var ags = ((+c_om1) + (+c_om2) + (+c_om3))/3;
			$('#avg_com_s_1').val(ags.toFixed(2));
	}
	
	
	
	$('#avg_com_s_1').change(function(){
		if($('#chk_com'). prop("checked") == true){
						var avg_com_s_1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var sums = (+comp_1)+(+comp_2);
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);						
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));	
						var cross_1 = $('#cross_1').val();
						var cross_2 = $('#cross_2').val();
						var cross_3 = $('#cross_3').val();
						var load_1 = ((+cross_1)*(+comp_1))/1000;
						var load_2 = ((+cross_2)*(+comp_2))/1000;
						var load_3 = ((+cross_3)*(+comp_3))/1000;
						$('#load_1').val(load_1.toFixed(1));
						$('#load_2').val(load_2.toFixed(1));
						$('#load_3').val(load_3.toFixed(1));
		}
		else
		{
			
		}
						
	});
	
	function comp_cross_set_1()
	{
						
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();						
						var comp_3 = $('#comp_3').val();										
						var cross_1 = $('#cross_1').val();
						var cross_2 = $('#cross_2').val();
						var cross_3 = $('#cross_3').val();
						var load_1 = ((+cross_1)*(+comp_1))/1000;
						var load_2 = ((+cross_2)*(+comp_2))/1000;
						var load_3 = ((+cross_3)*(+comp_3))/1000;
						$('#load_1').val(load_1.toFixed(1));
						$('#load_2').val(load_2.toFixed(1));
						$('#load_3').val(load_3.toFixed(1));
						var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3))/3;
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
		
	}
	
	$('#comp_1').change(function(){
		comp_cross_set_1();
						
	});
	$('#comp_2').change(function(){
		comp_cross_set_1();
						
	});
	$('#comp_3').change(function(){
		comp_cross_set_1();
						
	});
	$('#cross_1').change(function(){
		comp_cross_set_1();
						
	});
	$('#cross_2').change(function(){
		comp_cross_set_1();
						
	});
	$('#cross_3').change(function(){
		comp_cross_set_1();
						
	});
	
	
	$('#l1').change(function(){
		
		func_set_1_l_b();
	});
	$('#l2').change(function(){
		
		func_set_1_l_b();
	});
	$('#l3').change(function(){
		
		func_set_1_l_b();
	});
	$('#b1').change(function(){
		
		func_set_1_l_b();
	});
	$('#b2').change(function(){
		
		func_set_1_l_b();
	});
	$('#b3').change(function(){
		
		func_set_1_l_b();
	});
	
	function load_set_1()
	{
														
						var cross_1 = $('#cross_1').val();
						var cross_2 = $('#cross_2').val();
						var cross_3 = $('#cross_3').val();
						var load_1 = $('#load_1').val();
						var load_2 = $('#load_2').val();
						var load_3 = $('#load_3').val();
						var comp_1 = ((+load_1)/(+cross_1))*1000;
						var comp_2 = ((+load_2)/(+cross_2))*1000;
						var comp_3 = ((+load_3)/(+cross_3))*1000;
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3))/3;
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
		
	}
	
	$('#load_1').change(function(){
		
		load_set_1();
	});
	$('#load_2').change(function(){
		
		load_set_1();
	});
	$('#load_3').change(function(){
		
		load_set_1();
	});
	
	
	
	
	
	$('#caste_date1').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    }).on("change", function() {
						var dayss = $('#day1').val();
						var dateString = $('#caste_date1').val(); // Oct 23					
						
						var dateParts = dateString.split("/");
						var dateObject = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]); 
						var someDate = new Date(dateObject);							
						someDate.setDate(someDate.getDate() + parseInt(dayss));
						var dd = someDate.getDate();
						var mm = someDate.getMonth() + 1;
						var y = someDate.getFullYear();
						if(mm <= 9)
						mm = '0'+mm;
						if(dd <= 9)
						dd = '0'+dd;
						var someFormattedDate = dd + '/'+ mm + '/'+ y;
						
						$('#test_date1').val(someFormattedDate);
						  var ref = $('#caste_date1').val();
						
	});
	
	$('#day1').change(function(e){
		var dayss = $('#day1').val();
		var dateString = $('#caste_date1').val(); // Oct 23
		var dateParts = dateString.split("/");
		var dateObject = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]); 
		var someDate = new Date(dateObject);			
		someDate.setDate(someDate.getDate() + parseInt(dayss));
		var dd = someDate.getDate();
		var mm = someDate.getMonth() + 1;
		var y = someDate.getFullYear();
		if(mm <= 9)
		mm = '0'+mm;
		if(dd <= 9)
		dd = '0'+dd;
		var someFormattedDate = dd + '/'+ mm + '/'+ y;
		$('#test_date1').val(someFormattedDate);
		
	});
	
	

	
	$('#chk_com').change(function(){
        if(this.checked)
		{ $('#txtdim').css("background-color","var(--success)"); 
		}
		else
		{
			$('#txtdim').css("background-color","white");
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
        url: '<?php echo $base_url; ?>save_mortar_cube.php',
         data: 'action_type=view&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
			success:function(html){
            $('#display_data').html(html);
			
        }
    });
	
	 $.ajax({
        type: 'POST',
		dataType: 'JSON',
        url: '<?php echo $base_url; ?>save_mortar_cube.php',
         data: 'action_type=chk&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
			success:function(data){
            var save_data = data.total_row;
			var up_data = $('#cc_qty').val();
			
			if(save_data < up_data)
			{
				$('#btn_save').show();
			}
			else
			{
				$('#btn_save').hide();
			}

        }
    });
	
	
}

function saveMetal(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
	
	function add_data()
	{
		var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");

				//Compressive Strength
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
					
						
						var remarks = $('#remarks').val();
						var caste_date1 = $('#caste_date1').val();
						
						var test_date1 = $('#test_date1').val();
						
						
						var day1 = $('#day1').val();
						
						var grade1 = $('#grade1').val();
						
						var l1 = $('#l1').val();
						var l2 = $('#l2').val();
						var l3 = $('#l3').val();
						
						var b1 = $('#b1').val();
						var b2 = $('#b2').val();
						var b3 = $('#b3').val();
						
						var h1 = $('#h1').val();
						var h2 = $('#h2').val();
						var h3 = $('#h3').val();
					
						
						var cross_1 = $('#cross_1').val();
						var cross_2 = $('#cross_2').val();
						var cross_3 = $('#cross_3').val();
						
						var mass_1 = $('#mass_1').val();
						var mass_2 = $('#mass_2').val();
						var mass_3 = $('#mass_3').val();
						
						
						var load_1 = $('#load_1').val();
						var load_2 = $('#load_2').val();
						var load_3 = $('#load_3').val();
						
						
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						var comp_3 = $('#comp_3').val();
					
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var fail_pat_1 = $('#fail_pat_1').val();
						var fail_pat_2 = $('#fail_pat_2').val();
						var fail_pat_3 = $('#fail_pat_3').val();
						
						
						
						var top_casting_date = $('#top_casting_date').val();
						var top_days = $('#top_days').val();
						var top_grade = $('#top_grade').val();
						var top_no_of_cube = $('#top_no_of_cube').val();
						var top_remark = $('#top_remark').val();
						var top_set = $('#top_set').val();
						var cc_qty = $('#cc_qty').val();
						var p = $('#cc_identification_mark').val();
						var cc_identification_mark= p.replace('+', 'school');
						break;
					}
					else
					{
						var chk_com = "0";
							
						var remarks = "";
						var avg_com_s_1 = "";
						var top_casting_date = "";
						var top_days = "";
						var top_grade = "";
						var top_no_of_cube = "";
						var top_remark = "";
						var top_set = "";
						
						var caste_date1 = "";
					
						var test_date1 = "";
					
						var day1 = "";
						
						var grade1 = "";
						
						var l1 = "";
						var l2 = "";
						var l3 = "";
						
						var b1 = "";
						var b2 = "";
						var b3 = "";
						
						var h1 = "";
						var h2 = "";
						var h3 = "";
						
						var cross_1 = "";
						var cross_2 = "";
						var cross_3 = "";
						
						var mass_1 = "";
						var mass_2 = "";
						var mass_3 = "";
						
						var load_1 = "";
						var load_2 = "";
						var load_3 = "";
					
						var comp_1 = "";
						var comp_2 = "";
						var comp_3 = "";
						var cc_qty = "";
						var cc_identification_mark = "";
						
						var fail_pat_1 = "";
						var fail_pat_2 = "";
						var fail_pat_3 = "";
						
					}
														
				}
				
				//chl
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "chl") {
					if (document.getElementById('chk_chl').checked) {
						var chk_chl = "1";
					} else {
						var chk_chl = "0";
					}
					//specific gravity and water abrasion-5							
					var cha1 = $('#cha1').val();
					var cha2 = $('#cha2').val();
					var chb1 = $('#chb1').val();
					var chb2 = $('#chb2').val();
					var chc1 = $('#chc1').val();
					var chc2 = $('#chc2').val();
					var chd1 = $('#chd1').val();
					var chd2 = $('#chd2').val();
					var ch1 = $('#ch1').val();
					var ch2 = $('#ch2').val();
					var avgch = $('#avgch').val();
					var chl_test_method = $('#chl_test_method').val();
					var chl_test_req = $('#chl_test_req').val();
					var chl_test_limit = $('#chl_test_limit').val();
					break;
				} else {
					var chk_chl = "0";
					var cha1 = "0";
					var cha2 = "0";
					var chb1 = "0";
					var chb2 = "0";
					var chc1 = "0";
					var chc2 = "0";
					var chd1 = "0";
					var chd2 = "0";
					var ch1 = "0";
					var ch2 = "0";
					var avgch = "0";
					var chl_test_method = "";
					var chl_test_req = "";
					var chl_test_limit = "";
				}

			}

			//sul
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sul") {
					if (document.getElementById('chk_sul').checked) {
						var chk_sul = "1";
					} else {
						var chk_sul = "0";
					}
					//specific gravity and water abrasion-5							
					var sua1 = $('#sua1').val();
					var sua2 = $('#sua2').val();
					var sub1 = $('#sub1').val();
					var sub2 = $('#sub2').val();
					var suc1 = $('#suc1').val();
					var suc2 = $('#suc2').val();
					var sud1 = $('#sud1').val();
					var sud2 = $('#sud2').val();
					var su1 = $('#su1').val();
					var su2 = $('#su2').val();
					var avgsu = $('#avgsu').val();
					var sutotal = $('#sutotal').val();
					var sul_test_method = $('#sul_test_method').val();
					var sul_test_req = $('#sul_test_req').val();
					var sul_test_limit = $('#sul_test_limit').val();
					break;
				} else {
					var chk_sul = "0";
					var sua1 = "0";
					var sua2 = "0";
					var sub1 = "0";
					var sub2 = "0";
					var suc1 = "0";
					var suc2 = "0";
					var sud1 = "0";
					var sud2 = "0";
					var su1 = "0";
					var su2 = "0";
					var avgsu = "0";
					var sutotal = "0";
					var sul_test_method = "";
					var sul_test_req = "";
					var sul_test_limit = "";
				}

			}

						
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_com='+chk_com+'&top_casting_date='+top_casting_date+'&top_days='+top_days+'&top_grade='+top_grade+'&top_no_of_cube='+top_no_of_cube+'&top_remark='+top_remark+'&top_set='+top_set+'&avg_com_s_1='+avg_com_s_1+'&comp_1='+comp_1+'&comp_2='+comp_2+'&comp_3='+comp_3+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&mass_1='+mass_1+'&mass_2='+mass_2+'&mass_3='+mass_3+'&cross_1='+cross_1+'&cross_2='+cross_2+'&cross_3='+cross_3+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&grade1='+grade1+'&day1='+day1+'&test_date1='+test_date1+'&caste_date1='+caste_date1+'&ulr='+ulr+'&cc_identification_mark='+cc_identification_mark+'&fail_pat_1='+fail_pat_1+'&fail_pat_2='+fail_pat_2+'&fail_pat_3='+fail_pat_3+'&cc_qty='+cc_qty+'&remarks='+remarks+'&chk_chl=' + chk_chl + '&cha1=' + cha1 + '&cha2=' + cha2 + '&chb1=' + chb1 + '&chb2=' + chb2 + '&chc1=' + chc1 + '&chc2=' + chc2 + '&chd1=' + chd1 + '&chd2=' + chd2 + '&ch1=' + ch1 + '&ch2=' + ch2 + '&avgch=' + avgch + '&chk_sul=' + chk_sul + '&sua1=' + sua1 + '&sua2=' + sua2 + '&sub1=' + sub1 + '&sub2=' + sub2 + '&suc1=' + suc1 + '&suc2=' + suc2 + '&sud1=' + sud1 + '&sud2=' + sud2 + '&su1=' + su1 + '&su2=' + su2 + '&avgsu=' + avgsu + '&sutotal=' + sutotal;
	}
    if (type == 'add') {
				
		add_data();			
					
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");

				//Compressive Strength
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
						
						var remarks = $('#remarks').val();
						var caste_date1 = $('#caste_date1').val();
					
						var test_date1 = $('#test_date1').val();
						
						
						var day1 = $('#day1').val();
						
						var grade1 = $('#grade1').val();
						
						var l1 = $('#l1').val();
						var l2 = $('#l2').val();
						var l3 = $('#l3').val();
						
						var b1 = $('#b1').val();
						var b2 = $('#b2').val();
						var b3 = $('#b3').val();
						
						var h1 = $('#h1').val();
						var h2 = $('#h2').val();
						var h3 = $('#h3').val();
					
						
						var cross_1 = $('#cross_1').val();
						var cross_2 = $('#cross_2').val();
						var cross_3 = $('#cross_3').val();
						
						var mass_1 = $('#mass_1').val();
						var mass_2 = $('#mass_2').val();
						var mass_3 = $('#mass_3').val();
						
						
						var load_1 = $('#load_1').val();
						var load_2 = $('#load_2').val();
						var load_3 = $('#load_3').val();
						
						
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						var comp_3 = $('#comp_3').val();
					
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var fail_pat_1 = $('#fail_pat_1').val();
						var fail_pat_2 = $('#fail_pat_2').val();
						var fail_pat_3 = $('#fail_pat_3').val();
					
						
						var top_casting_date = $('#top_casting_date').val();
						var top_days = $('#top_days').val();
						var top_grade = $('#top_grade').val();
						var top_no_of_cube = $('#top_no_of_cube').val();
						var top_remark = $('#top_remark').val();
						var top_set = $('#top_set').val();
						var cc_qty = $('#cc_qty').val();
						var p = $('#cc_identification_mark').val();
						var cc_identification_mark= p.replace('+', 'school');
						
						break;
					}
					else
					{
						var chk_com = "0";
						var avg_com_s_1 = "";
						var remarks = "";
						var top_casting_date = "";
						var top_days = "";
						var top_grade = "";
						var top_no_of_cube = "";
						var top_remark = "";
						var top_set = "";
						
					
						var caste_date1 = "";
						
						var test_date1 = "";
						
						var day1 = "";
						
						var grade1 = "";
						
						var l1 = "";
						var l2 = "";
						var l3 = "";
						
						var b1 = "";
						var b2 = "";
						var b3 = "";
						
						var h1 = "";
						var h2 = "";
						var h3 = "";
						
						var cross_1 = "";
						var cross_2 = "";
						var cross_3 = "";
						
						var mass_1 = "";
						var mass_2 = "";
						var mass_3 = "";
						
						var load_1 = "";
						var load_2 = "";
						var load_3 = "";
					
						var comp_1 = "";
						var comp_2 = "";
						var comp_3 = "";
						var cc_qty = "";
						var cc_identification_mark = "";
						
						var fail_pat_1 = "";
						var fail_pat_2 = "";
						var fail_pat_3 = "";
					
						
					}
														
				}
				
				
			//chl
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "chl") {
					if (document.getElementById('chk_chl').checked) {
						var chk_chl = "1";
					} else {
						var chk_chl = "0";
					}
					//specific gravity and water abrasion-5							
					var cha1 = $('#cha1').val();
					var cha2 = $('#cha2').val();
					var chb1 = $('#chb1').val();
					var chb2 = $('#chb2').val();
					var chc1 = $('#chc1').val();
					var chc2 = $('#chc2').val();
					var chd1 = $('#chd1').val();
					var chd2 = $('#chd2').val();
					var ch1 = $('#ch1').val();
					var ch2 = $('#ch2').val();
					var avgch = $('#avgch').val();
					var chl_test_method = $('#chl_test_method').val();
					var chl_test_req = $('#chl_test_req').val();
					var chl_test_limit = $('#chl_test_limit').val();
					break;
				} else {
					var chk_chl = "0";
					var cha1 = "0";
					var cha2 = "0";
					var chb1 = "0";
					var chb2 = "0";
					var chc1 = "0";
					var chc2 = "0";
					var chd1 = "0";
					var chd2 = "0";
					var ch1 = "0";
					var ch2 = "0";
					var avgch = "0";
					var chl_test_method = "";
					var chl_test_req = "";
					var chl_test_limit = "";
				}

			}

			//sul
			for (var i = 0; i < aa.length; i++) {
				if (aa[i] == "sul") {
					if (document.getElementById('chk_sul').checked) {
						var chk_sul = "1";
					} else {
						var chk_sul = "0";
					}
					//specific gravity and water abrasion-5							
					var sua1 = $('#sua1').val();
					var sua2 = $('#sua2').val();
					var sub1 = $('#sub1').val();
					var sub2 = $('#sub2').val();
					var suc1 = $('#suc1').val();
					var suc2 = $('#suc2').val();
					var sud1 = $('#sud1').val();
					var sud2 = $('#sud2').val();
					var su1 = $('#su1').val();
					var su2 = $('#su2').val();
					var avgsu = $('#avgsu').val();
					var sutotal = $('#sutotal').val();
					var sul_test_method = $('#sul_test_method').val();
					var sul_test_req = $('#sul_test_req').val();
					var sul_test_limit = $('#sul_test_limit').val();
					break;
				} else {
					var chk_sul = "0";
					var sua1 = "0";
					var sua2 = "0";
					var sub1 = "0";
					var sub2 = "0";
					var suc1 = "0";
					var suc2 = "0";
					var sud1 = "0";
					var sud2 = "0";
					var su1 = "0";
					var su2 = "0";
					var avgsu = "0";
					var sutotal = "0";
					var sul_test_method = "";
					var sul_test_req = "";
					var sul_test_limit = "";
				}

			}

				
				
				
																
				var idEdit = $('#idEdit').val(); 
		
				billData =  $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_com='+chk_com+'&top_casting_date='+top_casting_date+'&top_days='+top_days+'&top_grade='+top_grade+'&top_no_of_cube='+top_no_of_cube+'&top_remark='+top_remark+'&top_set='+top_set+'&avg_com_s_1='+avg_com_s_1+'&comp_1='+comp_1+'&comp_2='+comp_2+'&comp_3='+comp_3+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&mass_1='+mass_1+'&mass_2='+mass_2+'&mass_3='+mass_3+'&cross_1='+cross_1+'&cross_2='+cross_2+'&cross_3='+cross_3+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&grade1='+grade1+'&day1='+day1+'&test_date1='+test_date1+'&caste_date1='+caste_date1+'&ulr='+ulr+'&cc_identification_mark='+cc_identification_mark+'&fail_pat_1='+fail_pat_1+'&fail_pat_2='+fail_pat_2+'&fail_pat_3='+fail_pat_3+'&cc_qty='+cc_qty+'&remarks='+remarks+'&chk_chl=' + chk_chl + '&cha1=' + cha1 + '&cha2=' + cha2 + '&chb1=' + chb1 + '&chb2=' + chb2 + '&chc1=' + chc1 + '&chc2=' + chc2 + '&chd1=' + chd1 + '&chd2=' + chd2 + '&ch1=' + ch1 + '&ch2=' + ch2 + '&avgch=' + avgch + '&chk_sul=' + chk_sul + '&sua1=' + sua1 + '&sua2=' + sua2 + '&sub1=' + sub1 + '&sub2=' + sub2 + '&suc1=' + suc1 + '&suc2=' + suc2 + '&sud1=' + sud1 + '&sud2=' + sud2 + '&su1=' + su1 + '&su2=' + su2 + '&avgsu=' + avgsu + '&sutotal=' + sutotal;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
					/*if(document.getElementById('chk_auto').checked) {
							if (type == 'add') {
								var savedata;
								var lab_no = $('#lab_no').val();
								 $.ajax({
										type: 'POST',
										dataType: 'JSON',
										url: '<?php echo $base_url; ?>save_mortar_cube.php',
										 data: 'action_type=chk'+'&lab_no='+lab_no,
											success:function(data){
											 savedata = data.total_row;										
								
										
											var cc_qty = $('#cc_qty').val();
											if(cc_qty >= 0 && savedata > 0)
											{
												var i = savedata;
												for(i=savedata;i<cc_qty;i++)
												{
													com_auto();
													add_data();
													var d = new Date();

													var month = d.getMonth()+1;
													var day = d.getDate();

													var output = d.getFullYear() + '/' +
														(month<10 ? '0' : '') + month + '/' +
														(day<10 ? '0' : '') + day;
													var CurrentDate = output;
													var testing_date = $('#test_date1').val();
													var year = moment(testing_date, "DD/MM/YYYY").format("YYYY/MM/DD");
													/* var month = moment(testing_date, "DD/MM/YYYY").format("MM");
													var dates1 = moment(testing_date, "DD/MM/YYYY").format("DD"); */
												/*	var SelectedDate = year;
													
													if(CurrentDate >= SelectedDate){
														$.ajax({
														type: 'POST',
														url: '<?php echo $base_url; ?>save_mortar_cube.php',
														data: billData,
														dataType: 'JSON',
														success:function(msg){
															
															  
																var report_no = $('#report_no').val(); 
																var job_no = $('#job_no').val();
													
														}
													});
													}
													
													
													
												}
												 getGlazedTiles();
											}
											else if(cc_qty >= 0 && savedata ==0)
											{	
												var i = 1;
												for(i=1;i<=cc_qty;i++)
												{
													com_auto();
													add_data();	
													var d = new Date();

													var month = d.getMonth()+1;
													var day = d.getDate();

													var output = d.getFullYear() + '/' +
														(month<10 ? '0' : '') + month + '/' +
														(day<10 ? '0' : '') + day;
													var CurrentDate = output;
													var testing_date = $('#test_date1').val();
													var year = moment(testing_date, "DD/MM/YYYY").format("YYYY/MM/DD");
													/* var month = moment(testing_date, "DD/MM/YYYY").format("MM");
													var dates1 = moment(testing_date, "DD/MM/YYYY").format("DD"); */
													/*var SelectedDate = year;
													
													if(CurrentDate >= SelectedDate){
														$.ajax({
														type: 'POST',
														url: '<?php echo $base_url; ?>save_mortar_cube.php',
														data: billData,
														dataType: 'JSON',
														success:function(msg){
															
															  
																var report_no = $('#report_no').val(); 
																var job_no = $('#job_no').val();
													
														}
													});
													}
													
													
												}
												 getGlazedTiles();
											}
											
											}
									});
							}
						}
						else
						{*/
							 $.ajax({
									type: 'POST',
									url: '<?php echo $base_url; ?>save_mortar_cube.php',
									data: billData,
									dataType: 'JSON',
									success:function(msg){
										
										   getGlazedTiles();
											var report_no = $('#report_no').val(); 
											var job_no = $('#job_no').val();
											//location.reload();
									}
								});
						/*}*/
						
	
   
}

function ccDelete(id)
{
		var lab_no = $('#lab_no').val(); 
	 $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_mortar_cube.php',
        data: 'action_type=delete&id='+id+'&lab_no='+lab_no,
		dataType: 'JSON',
        success:function(msg){
         
               getGlazedTiles();
				
	
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
        url: '<?php echo $base_url; ?>save_mortar_cube.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
            $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();
	
             $('#idEdit').val(data.id);
	
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			
            var temp = $('#test_list').val();
           
			var aa= temp.split(",");				
				//DIMENSION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="com")
					{
						var chk_com = data.chk_com;
						if(chk_com=="1")
						{
						 $('#txtdim').css("background-color","var(--success)"); 
						   $("#chk_com").prop("checked", true); 
						}else{
							$('#txtdim').css("background-color","white"); 
							$("#chk_com").prop("checked", false); 
						}
						
						
						  
						 
							 $('#remarks').val(data.remarks);
							 $('#caste_date1').val(data.caste_date1);
							 $('#test_date1').val(data.test_date1);
							 $('#day1').val(data.day1);
							  $('#l1').val(data.l1);
							 $('#l2').val(data.l2);
							 $('#l3').val(data.l3);
							  $('#b1').val(data.b1);
							 $('#b2').val(data.b2);
							 $('#b3').val(data.b3);
							  $('#h1').val(data.h1);
							 $('#h2').val(data.h2);
							 $('#h3').val(data.h3);
							  $('#cross_1').val(data.cross_1);
							 $('#cross_2').val(data.cross_2);
							 $('#cross_3').val(data.cross_3);
							 $('#mass_1').val(data.mass_1);
							 $('#mass_2').val(data.mass_2);
							 $('#mass_3').val(data.mass_3);
							  $('#load_1').val(data.load_1);
							 $('#load_2').val(data.load_2);
							 $('#load_3').val(data.load_3);
							  $('#comp_1').val(data.comp_1);
							 $('#comp_2').val(data.comp_2);
							 $('#comp_3').val(data.comp_3);
							  $('#avg_com_s_1').val(data.avg_com_s_1);
							  $('#grade1').val(data.grade1);
						
						
						 $('#top_casting_date').val(data.top_casting_date);
						 $('#top_days').val(data.top_days);
						 $('#top_grade').val(data.top_grade);
						 $('#top_no_of_cube').val(data.top_no_of_cube);
						 $('#top_remark').val(data.top_remark);
						 $('#top_set').val(data.top_set);
						 $('#cc_qty').val(data.cc_qty);
						 $('#cc_identification_mark').val(data.cc_identification_mark);
						 $('#fail_pat_1').val(data.fail_pat_1);
						 $('#fail_pat_2').val(data.fail_pat_2);
						 $('#fail_pat_3').val(data.fail_pat_3);
						 
						
						  
						 
						 
						 
						
						 
						 
						 
						 
						
					}
				}
				
				
				//chl 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "chl") {
						var chk_chl = data.chk_chl;
						if (chk_chl == "1") {
							$('#txtchl').css("background-color", "var(--success)");
							$("#chk_chl").prop("checked", true);
						} else {
							$('#txtchl').css("background-color", "white");
							$("#chk_chl").prop("checked", false);
						}


						$('#cha1').val(data.cha1);
						$('#cha2').val(data.cha2);
						$('#chb1').val(data.chb1);
						$('#chb2').val(data.chb2);
						$('#chc1').val(data.chc1);
						$('#chc2').val(data.chc2);
						$('#chd1').val(data.chd1);
						$('#chd2').val(data.chd2);
						$('#ch1').val(data.ch1);
						$('#ch2').val(data.ch2);
						$('#avgch').val(data.avgch);
						$('#chl_test_method').val(data.chl_test_method);
						$('#chl_test_req').val(data.chl_test_req);
						$('#chl_test_limit').val(data.chl_test_limit);
						break;
					} else {

					}

				}

				//sul 
				for (var i = 0; i < aa.length; i++) {
					if (aa[i] == "sul") {
						var chk_sul = data.chk_sul;
						if (chk_sul == "1") {
							$('#txtsul').css("background-color", "var(--success)");
							$("#chk_sul").prop("checked", true);
						} else {
							$('#txtsul').css("background-color", "white");
							$("#chk_sul").prop("checked", false);
						}


						$('#sua1').val(data.sua1);
						$('#sua2').val(data.sua2);
						$('#sub1').val(data.sub1);
						$('#sub2').val(data.sub2);
						$('#suc1').val(data.suc1);
						$('#suc2').val(data.suc2);
						$('#sud1').val(data.sud1);
						$('#sud2').val(data.sud2);
						$('#su1').val(data.su1);
						$('#su2').val(data.su2);
						$('#avgsu').val(data.avgsu);
						$('#sutotal').val(data.sutotal);
						$('#sul_test_method').val(data.sul_test_method);
						$('#sul_test_req').val(data.sul_test_req);
						$('#sul_test_limit').val(data.sul_test_limit);
						break;
					} else {

					}

				}

				
				
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}



</script>


