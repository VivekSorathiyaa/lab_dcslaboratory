
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
				}
				
				
		
?>
<div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">DLC CUBE TEST</h2>
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
											<!--<label for="inputEmail3" class="col-sm-2 control-label">Grade :</label>-->									 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_grade" value="DLC" name="top_grade" ReadOnly>
										  </div>
										  
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">Casting Date :</label>-->									 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_casting_date" value="<?php echo date('d/m/Y', strtotime($casting_date));?>" name="top_casting_date" ReadOnly>
										  </div>
										  
										  <!-- <label for="inputEmail3" class="col-sm-2 control-label">Day :</label>-->									 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_days" value="<?php echo $cc_day;?>" name="top_days" ReadOnly>
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
										
											<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="idEdit" id="idEdit"/>

											</div>
											<?php   
													$querys_job1 = "SELECT * FROM dlc_cube WHERE `is_deleted`='0' and lab_no='$lab_no'";
													$qrys_jobno = mysqli_query($conn,$querys_job1);
													$rows=mysqli_num_rows($qrys_jobno);
													if($rows < 1){ ?>
											<div class="col-sm-2">
												<!-- SAVE BUTTON LOGIC VAIBHAV-->
												
														<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
											</div>
											<?php
													}
													
											?>
											<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>

											</div>
											<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
											<?php
											$val =  $_SESSION['isadmin'];
											if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
											?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_dlc_cube.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_dlc_cube.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

											</div>
											<?php } ?>
											
										</div>
									</div>
								</div>
								
								<hr>
								<br>
	<div class="panel-group" id="accordion">
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
								<div class="col-md-2">
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Average of Compressive Strength (N/mm2)</label>
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
											<input type="text" class="form-control" id="grade1" name="grade1" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">																					
											<input type="text" class="form-control  startdate_class" id="caste_date1" name="caste_date1">
									
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
								<div class="col-md-2">									
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_com_s_1" name="avg_com_s_1" >						
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
								<div class="col-md-2">
									<div class="col-sm-12">
											
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
								<div class="col-md-2">
									
									
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
											<input type="text" class="form-control" id="l4" name="l4" >
										</div>
									</div>
								</div>
								<div class="col-md-5">
									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b4" name="b4" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h4" name="h4" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="cross_4" name="cross_4" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="mass_4" name="mass_4" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="load_4" name="load_4" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="comp_4" name="comp_4" >
										</div>
									</div>
								</div>
								<div class="col-md-2">
									
									
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
											<input type="text" class="form-control" id="l5" name="l5" >
										</div>
									</div>
								</div>
								<div class="col-md-5">
									
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="b5" name="b5" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="h5" name="h5" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="cross_5" name="cross_5" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="mass_5" name="mass_5" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="load_5" name="load_5" >
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" id="comp_5" name="comp_5" >
										</div>
									</div>
								</div>
								<div class="col-md-2">
									
									
								</div>
							</div>
							<br>
							
							
								
						
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
								<!--<th style="text-align:center;"><label>Report No.</label></th>-->	
								<th style="text-align:center;"><label>Lab No.</label></th>	
								<th style="text-align:center;"><label>Job No.</label></th>	
							
							
																		

							</tr>
								<?php
							 $query = "select * from dlc_cube WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	
	 
	$('.startdate_class').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	});


  $(function () {
    $('.select2').select2();
  })
$(document).ready(function(){ 
			   
	$('#btn_edit_data').hide();
	$('#alert').hide();
	
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
		}
	});
	
	function com_auto()
	{
		/*var cast = $('#top_casting_date').val();
				document.getElementById('caste_date1').value = cast;*/
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
						var mass_4 = randomNumberFromRange(8.10, 8.80);
						var mass_5 = randomNumberFromRange(8.10, 8.80);
						
					
						var avg_com_s_1 = randomNumberFromRange(11.10,12.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_3 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_4 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						$('#comp_4').val(comp_4.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var com3 = $('#comp_3').val();
						var com4 = $('#comp_4').val();
						var sums = (+com1)+(+com2)+(+com3)+(+com4);
						var comp_5 = ((+avg_com_s1)*5)-(+sums);
						$('#comp_5').val(comp_5.toFixed(2));
						
						
						
					
					
					
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
						var mass_4 = randomNumberFromRange(8.10, 8.80);
						var mass_5 = randomNumberFromRange(8.10, 8.80);
						
					
						var avg_com_s_1 = randomNumberFromRange(11.10, 13.70);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_3 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_4 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						$('#comp_4').val(comp_4.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var com3 = $('#comp_3').val();
						var com4 = $('#comp_4').val();
						var sums = (+com1)+(+com2)+(+com3)+(+com4);
						var comp_5 = ((+avg_com_s1)*5)-(+sums);
						$('#comp_5').val(comp_5.toFixed(2));
						
						
						
					
						
					
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
						var mass_4 = randomNumberFromRange(8.10, 8.80);
						var mass_5 = randomNumberFromRange(8.10, 8.80);
						
					
						var avg_com_s_1 = randomNumberFromRange(7.40, 9.10);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						var avg_com_s1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_3 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						var comp_4 = (+avg_com_s1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						$('#comp_4').val(comp_4.toFixed(2));
						var com1 = $('#comp_1').val();
						var com2 = $('#comp_2').val();
						var com3 = $('#comp_3').val();
						var com4 = $('#comp_4').val();
						var sums = (+com1)+(+com2)+(+com3)+(+com4);
						var comp_5 = ((+avg_com_s1)*5)-(+sums);
						$('#comp_5').val(comp_5.toFixed(2));
						
						
						
					
					
					
				}
		
				var rr = $('#lab_no').val();
				var grade = $('#top_grade').val();
				var grade1 = grade;
				$('#grade1').val(grade1);
				var l1 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var l2 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var l3 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var l4 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var l5 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				
				$('#l1').val(l1);
				$('#l2').val(l2);
				$('#l3').val(l3);
				$('#l4').val(l4);
				$('#l5').val(l5);
				var b1 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var b2 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var b3 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var b4 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var b5 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				$('#b1').val(b1);
				$('#b2').val(b2);
				$('#b3').val(b3);
				$('#b4').val(b4);
				$('#b5').val(b5);
				var h1 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var h2 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var h3 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var h4 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				var h5 = randomNumberFromRange(150.0, 150.0).toFixed(1);
				$('#h1').val(h1);
				$('#h2').val(h2);
				$('#h3').val(h3);
				$('#h4').val(h4);
				$('#h5').val(h5);
				var l_1  = $('#l1').val();
				var l_2  = $('#l2').val();
				var l_3  = $('#l3').val();
				var l_4  = $('#l4').val();
				var l_5  = $('#l5').val();
				var b_1  = $('#b1').val();
				var b_2  = $('#b2').val();
				var b_3  = $('#b3').val();
				var b_4  = $('#b4').val();
				var b_5  = $('#b5').val();
				var cross_1 = (+l1) * (+b1);
				var cross_2 = (+l2) * (+b2);
				var cross_3 = (+l3) * (+b3);
				var cross_4 = (+l4) * (+b4);
				var cross_5 = (+l5) * (+b5);
				$('#cross_1').val(cross_1.toFixed(1));
				$('#cross_2').val(cross_2.toFixed(1));
				$('#cross_3').val(cross_3.toFixed(1));
				$('#cross_4').val(cross_4.toFixed(1));
				$('#cross_5').val(cross_5.toFixed(1));
				
				
				
				$('#mass_1').val(mass_1.toFixed(2));
				$('#mass_2').val(mass_2.toFixed(2));
				$('#mass_3').val(mass_3.toFixed(2));
				$('#mass_4').val(mass_4.toFixed(2));
				$('#mass_5').val(mass_5.toFixed(2));
				
				var cr1= $('#cross_1').val();
				var cr2= $('#cross_2').val();
				var cr3= $('#cross_3').val();
				var cr4= $('#cross_4').val();
				var cr5= $('#cross_5').val();
				
				var com1 = $('#comp_1').val();
				var com2 = $('#comp_2').val();
				var com3 = $('#comp_3').val();
				var com4 = $('#comp_4').val();
				var com5 = $('#comp_5').val();
				
				var load_1 = ((+cr1)*(+com1))/1000;
				var load_2 = ((+cr2)*(+com2))/1000;
				var load_3 = ((+cr3)*(+com3))/1000;
				var load_4 = ((+cr4)*(+com4))/1000;
				var load_5 = ((+cr5)*(+com5))/1000;
				
				$('#load_1').val(load_1.toFixed(1));
				$('#load_2').val(load_2.toFixed(1));
				$('#load_3').val(load_3.toFixed(1));
				$('#load_4').val(load_4.toFixed(1));
				$('#load_5').val(load_5.toFixed(1));
				
				var load1 = $('#load_1').val();
				var load2 = $('#load_2').val();
				var load3 = $('#load_3').val();
				var load4 = $('#load_4').val();
				var load5 = $('#load_5').val();
				
				var comp1 = ((+load1)*1000)/(+cr1);
				var comp2 = ((+load2)*1000)/(+cr2);
				var comp3 = ((+load3)*1000)/(+cr3);
				var comp4 = ((+load4)*1000)/(+cr4);
				var comp5 = ((+load5)*1000)/(+cr5);
				
				$('#comp_1').val(comp1.toFixed(2));
				$('#comp_2').val(comp2.toFixed(2));
				$('#comp_3').val(comp3.toFixed(2));
				$('#comp_4').val(comp4.toFixed(2));
				$('#comp_5').val(comp5.toFixed(2));
				
				var c_om1 = $('#comp_1').val();
				var c_om2 = $('#comp_2').val();
				var c_om3 = $('#comp_3').val();
				var c_om4 = $('#comp_4').val();
				var c_om5 = $('#comp_5').val();
				
				var ags = ((+c_om1) + (+c_om2) + (+c_om3)+ (+c_om4)+ (+c_om5))/5;
				$('#avg_com_s_1').val(ags.toFixed(2));
				
				
				
	}
	
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
			$('#l4').val(null);
			$('#l5').val(null);
			$('#b1').val(null);
			$('#b2').val(null);
			$('#b3').val(null);
			$('#b4').val(null);
			$('#b5').val(null);
			$('#h1').val(null);
			$('#h2').val(null);
			$('#h3').val(null);
			$('#h4').val(null);
			$('#h5').val(null);
			$('#cross_1').val(null);
			$('#cross_2').val(null);
			$('#cross_3').val(null);
			$('#cross_4').val(null);
			$('#cross_5').val(null);
			$('#mass_1').val(null);
			$('#mass_2').val(null);
			$('#mass_3').val(null);
			$('#mass_4').val(null);
			$('#mass_5').val(null);
			$('#load_1').val(null);
			$('#load_2').val(null);
			$('#load_3').val(null);
			$('#load_4').val(null);
			$('#load_5').val(null);
			$('#comp_1').val(null);
			$('#comp_2').val(null);
			$('#comp_3').val(null);
			$('#comp_4').val(null);
			$('#comp_5').val(null);
			$('#avg_com_s_1').val(null);
		}
		
	});
	
	
	
	function func_set_1_l_b()
	{		
		
			var l1  = $('#l1').val();
			var l2  = $('#l2').val();
			var l3  = $('#l3').val();
			var l4  = $('#l4').val();
			var l5  = $('#l5').val();
			var b1  = $('#b1').val();
			var b2  = $('#b2').val();
			var b3  = $('#b3').val();
			var b4  = $('#b4').val();
			var b5  = $('#b5').val();
			var cross_1 = (+l1) * (+b1);
			var cross_2 = (+l2) * (+b2);
			var cross_3 = (+l3) * (+b3);
			var cross_4 = (+l4) * (+b4);
			var cross_5 = (+l5) * (+b5);
			$('#cross_1').val(cross_1.toFixed(1));
			$('#cross_2').val(cross_2.toFixed(1));
			$('#cross_3').val(cross_3.toFixed(1));
			$('#cross_4').val(cross_4.toFixed(1));
			$('#cross_5').val(cross_5.toFixed(1));
			
			var cr1= $('#cross_1').val();
			var cr2= $('#cross_2').val();
			var cr3= $('#cross_3').val();
			var cr4= $('#cross_4').val();
			var cr5= $('#cross_5').val();
			
			var comp_1 = $('#comp_1').val();
			var comp_2 = $('#comp_2').val();
			var comp_3 = $('#comp_3').val();
			var comp_4 = $('#comp_4').val();
			var comp_5 = $('#comp_5').val();
			
			var load_1 = ((+cr1)*(+comp_1))/1000;
			var load_2 = ((+cr2)*(+comp_2))/1000;
			var load_3 = ((+cr3)*(+comp_3))/1000;
			var load_4 = ((+cr4)*(+comp_4))/1000;
			var load_5 = ((+cr5)*(+comp_5))/1000;
			
			$('#load_1').val(load_1.toFixed(1));
			$('#load_2').val(load_2.toFixed(1));
			$('#load_3').val(load_3.toFixed(1));
			$('#load_4').val(load_4.toFixed(1));
			$('#load_5').val(load_5.toFixed(1));
			
			var load1 = $('#load_1').val();
			var load2 = $('#load_2').val();
			var load3 = $('#load_3').val();
			var load4 = $('#load_4').val();
			var load5 = $('#load_5').val();
			
			var comp1 = ((+load1)*1000)/(+cr1);
			var comp2 = ((+load2)*1000)/(+cr2);
			var comp3 = ((+load3)*1000)/(+cr3);
			var comp4 = ((+load4)*1000)/(+cr4);
			var comp5 = ((+load5)*1000)/(+cr5);
			
			$('#comp_1').val(comp1.toFixed(2));
			$('#comp_2').val(comp2.toFixed(2));
			$('#comp_3').val(comp3.toFixed(2));
			$('#comp_4').val(comp4.toFixed(2));
			$('#comp_5').val(comp5.toFixed(2));
			
			var c_om1 = $('#comp_1').val();
			var c_om2 = $('#comp_2').val();
			var c_om3 = $('#comp_3').val();
			var c_om4 = $('#comp_4').val();
			var c_om5 = $('#comp_5').val();
			
			var ags = ((+c_om1) + (+c_om2) + (+c_om3)+ (+c_om4)+ (+c_om5))/5;
			$('#avg_com_s_1').val(ags.toFixed(2));
	}
	
	
	
	$('#avg_com_s_1').change(function(){
		if($('#chk_com'). prop("checked") == true){
						var avg_com_s_1 = $('#avg_com_s_1').val();
						var comp_1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp_3 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp_4 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var sums = (+comp_1)+(+comp_2)+(+comp_3)+(+comp_4);
						var comp_5 = ((+avg_com_s_1)*5)-(+sums);						
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));	
						$('#comp_4').val(comp_4.toFixed(2));	
						$('#comp_5').val(comp_5.toFixed(2));	
						var cross_1 = $('#cross_1').val();
						var cross_2 = $('#cross_2').val();
						var cross_3 = $('#cross_3').val();
						var cross_4 = $('#cross_4').val();
						var cross_5 = $('#cross_5').val();
						var load_1 = ((+cross_1)*(+comp_1))/1000;
						var load_2 = ((+cross_2)*(+comp_2))/1000;
						var load_3 = ((+cross_3)*(+comp_3))/1000;
						var load_4 = ((+cross_4)*(+comp_4))/1000;
						var load_5 = ((+cross_5)*(+comp_5))/1000;
						$('#load_1').val(load_1.toFixed(1));
						$('#load_2').val(load_2.toFixed(1));
						$('#load_3').val(load_3.toFixed(1));
						$('#load_4').val(load_4.toFixed(1));
						$('#load_5').val(load_5.toFixed(1));
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
						var comp_4 = $('#comp_4').val();										
						var comp_5 = $('#comp_5').val();										
						var cross_1 = $('#cross_1').val();
						var cross_2 = $('#cross_2').val();
						var cross_3 = $('#cross_3').val();
						var cross_4 = $('#cross_4').val();
						var cross_5 = $('#cross_5').val();
						var load_1 = ((+cross_1)*(+comp_1))/1000;
						var load_2 = ((+cross_2)*(+comp_2))/1000;
						var load_3 = ((+cross_3)*(+comp_3))/1000;
						var load_4 = ((+cross_4)*(+comp_4))/1000;
						var load_5 = ((+cross_5)*(+comp_5))/1000;
						$('#load_1').val(load_1.toFixed(1));
						$('#load_2').val(load_2.toFixed(1));
						$('#load_3').val(load_3.toFixed(1));
						$('#load_4').val(load_4.toFixed(1));
						$('#load_5').val(load_5.toFixed(1));
						var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3)+(+comp_4)+(+comp_5))/5;
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
	$('#comp_4').change(function(){
		comp_cross_set_1();
						
	});
	$('#comp_5').change(function(){
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
	$('#cross_4').change(function(){
		comp_cross_set_1();
						
	});
	$('#cross_4').change(function(){
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
	$('#l4').change(function(){
		
		func_set_1_l_b();
	});
	$('#l5').change(function(){
		
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
	$('#b4').change(function(){
		
		func_set_1_l_b();
	});
	$('#b5').change(function(){
		
		func_set_1_l_b();
	});
	
	function load_set_1()
	{
														
						var cross_1 = $('#cross_1').val();
						var cross_2 = $('#cross_2').val();
						var cross_3 = $('#cross_3').val();
						var cross_4 = $('#cross_4').val();
						var cross_5 = $('#cross_5').val();
						var load_1 = $('#load_1').val();
						var load_2 = $('#load_2').val();
						var load_3 = $('#load_3').val();
						var load_4 = $('#load_4').val();
						var load_5 = $('#load_5').val();
						var comp_1 = ((+load_1)/(+cross_1))*1000;
						var comp_2 = ((+load_2)/(+cross_2))*1000;
						var comp_3 = ((+load_3)/(+cross_3))*1000;
						var comp_4 = ((+load_4)/(+cross_4))*1000;
						var comp_5 = ((+load_5)/(+cross_5))*1000;
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						$('#comp_4').val(comp_4.toFixed(2));
						$('#comp_5').val(comp_5.toFixed(2));
						var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3)+(+comp_4)+(+comp_5))/3;
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
        url: '<?php echo $base_url; ?>savedlc_cube_span.php',
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
					
						
						var caste_date1 = $('#caste_date1').val();
						
						var test_date1 = $('#test_date1').val();
						
						
						var day1 = $('#day1').val();
						
						var grade1 = $('#grade1').val();
						
						var l1 = $('#l1').val();
						var l2 = $('#l2').val();
						var l3 = $('#l3').val();
						var l4 = $('#l4').val();
						var l5 = $('#l5').val();
						
						var b1 = $('#b1').val();
						var b2 = $('#b2').val();
						var b3 = $('#b3').val();
						var b4 = $('#b4').val();
						var b5 = $('#b5').val();
						
						var h1 = $('#h1').val();
						var h2 = $('#h2').val();
						var h3 = $('#h3').val();
						var h4 = $('#h4').val();
						var h5 = $('#h5').val();
					
						
						var cross_1 = $('#cross_1').val();
						var cross_2 = $('#cross_2').val();
						var cross_3 = $('#cross_3').val();
						var cross_4 = $('#cross_4').val();
						var cross_5 = $('#cross_5').val();
						
						var mass_1 = $('#mass_1').val();
						var mass_2 = $('#mass_2').val();
						var mass_3 = $('#mass_3').val();
						var mass_4 = $('#mass_4').val();
						var mass_5 = $('#mass_5').val();
						
						
						var load_1 = $('#load_1').val();
						var load_2 = $('#load_2').val();
						var load_3 = $('#load_3').val();
						var load_4 = $('#load_4').val();
						var load_5 = $('#load_5').val();
						
						
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						var comp_3 = $('#comp_3').val();
						var comp_4 = $('#comp_4').val();
						var comp_5 = $('#comp_5').val();
					
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						
						
						var top_casting_date = $('#top_casting_date').val();
						var top_days = $('#top_days').val();
						var top_grade = $('#top_grade').val();
						var top_no_of_cube = $('#top_no_of_cube').val();
						var top_remark = $('#top_remark').val();
						var top_set = $('#top_set').val();
						break;
					}
					else
					{
						var chk_com = "0";
							
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
						var l4 = "";
						var l5 = "";
						
						var b1 = "";
						var b2 = "";
						var b3 = "";
						var b4 = "";
						var b5 = "";
						
						var h1 = "";
						var h2 = "";
						var h3 = "";
						var h4 = "";
						var h5 = "";
						
						var cross_1 = "";
						var cross_2 = "";
						var cross_3 = "";
						var cross_4 = "";
						var cross_5 = "";
						
						var mass_1 = "";
						var mass_2 = "";
						var mass_3 = "";
						var mass_4 = "";
						var mass_5 = "";
						
						var load_1 = "";
						var load_2 = "";
						var load_3 = "";
						var load_4 = "";
						var load_5 = "";
					
						var comp_1 = "";
						var comp_2 = "";
						var comp_3 = "";
						var comp_4 = "";
						var comp_5 = "";
					
						
					}
														
				}
						
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_com='+chk_com+'&top_casting_date='+top_casting_date+'&top_days='+top_days+'&top_grade='+top_grade+'&top_no_of_cube='+top_no_of_cube+'&top_remark='+top_remark+'&top_set='+top_set+'&avg_com_s_1='+avg_com_s_1+'&comp_1='+comp_1+'&comp_2='+comp_2+'&comp_3='+comp_3+'&comp_4='+comp_4+'&comp_5='+comp_5+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&mass_1='+mass_1+'&mass_2='+mass_2+'&mass_3='+mass_3+'&mass_4='+mass_4+'&mass_5='+mass_5+'&cross_1='+cross_1+'&cross_2='+cross_2+'&cross_3='+cross_3+'&cross_4='+cross_4+'&cross_5='+cross_5+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&h4='+h4+'&h5='+h5+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&b4='+b4+'&b5='+b5+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&grade1='+grade1+'&day1='+day1+'&test_date1='+test_date1+'&caste_date1='+caste_date1+'&ulr='+ulr;
					
					
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
					
						
						var caste_date1 = $('#caste_date1').val();
						
						var test_date1 = $('#test_date1').val();
						
						
						var day1 = $('#day1').val();
						
						var grade1 = $('#grade1').val();
						
						var l1 = $('#l1').val();
						var l2 = $('#l2').val();
						var l3 = $('#l3').val();
						var l4 = $('#l4').val();
						var l5 = $('#l5').val();
						
						var b1 = $('#b1').val();
						var b2 = $('#b2').val();
						var b3 = $('#b3').val();
						var b4 = $('#b4').val();
						var b5 = $('#b5').val();
						
						var h1 = $('#h1').val();
						var h2 = $('#h2').val();
						var h3 = $('#h3').val();
						var h4 = $('#h4').val();
						var h5 = $('#h5').val();
					
						
						var cross_1 = $('#cross_1').val();
						var cross_2 = $('#cross_2').val();
						var cross_3 = $('#cross_3').val();
						var cross_4 = $('#cross_4').val();
						var cross_5 = $('#cross_5').val();
						
						var mass_1 = $('#mass_1').val();
						var mass_2 = $('#mass_2').val();
						var mass_3 = $('#mass_3').val();
						var mass_4 = $('#mass_4').val();
						var mass_5 = $('#mass_5').val();
						
						
						var load_1 = $('#load_1').val();
						var load_2 = $('#load_2').val();
						var load_3 = $('#load_3').val();
						var load_4 = $('#load_4').val();
						var load_5 = $('#load_5').val();
						
						
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						var comp_3 = $('#comp_3').val();
						var comp_4 = $('#comp_4').val();
						var comp_5 = $('#comp_5').val();
					
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						
						
						var top_casting_date = $('#top_casting_date').val();
						var top_days = $('#top_days').val();
						var top_grade = $('#top_grade').val();
						var top_no_of_cube = $('#top_no_of_cube').val();
						var top_remark = $('#top_remark').val();
						var top_set = $('#top_set').val();
						break;
					}
					else
					{
						var chk_com = "0";
							
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
						var l4 = "";
						var l5 = "";
						
						var b1 = "";
						var b2 = "";
						var b3 = "";
						var b4 = "";
						var b5 = "";
						
						var h1 = "";
						var h2 = "";
						var h3 = "";
						var h4 = "";
						var h5 = "";
						
						var cross_1 = "";
						var cross_2 = "";
						var cross_3 = "";
						var cross_4 = "";
						var cross_5 = "";
						
						var mass_1 = "";
						var mass_2 = "";
						var mass_3 = "";
						var mass_4 = "";
						var mass_5 = "";
						
						var load_1 = "";
						var load_2 = "";
						var load_3 = "";
						var load_4 = "";
						var load_5 = "";
					
						var comp_1 = "";
						var comp_2 = "";
						var comp_3 = "";
						var comp_4 = "";
						var comp_5 = "";
					
						
					}
														
				}
																
				var idEdit = $('#idEdit').val(); 
		
				billData =  $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_com='+chk_com+'&top_casting_date='+top_casting_date+'&top_days='+top_days+'&top_grade='+top_grade+'&top_no_of_cube='+top_no_of_cube+'&top_remark='+top_remark+'&top_set='+top_set+'&avg_com_s_1='+avg_com_s_1+'&comp_1='+comp_1+'&comp_2='+comp_2+'&comp_3='+comp_3+'&comp_4='+comp_4+'&comp_5='+comp_5+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&load_4='+load_4+'&load_5='+load_5+'&mass_1='+mass_1+'&mass_2='+mass_2+'&mass_3='+mass_3+'&mass_4='+mass_4+'&mass_5='+mass_5+'&cross_1='+cross_1+'&cross_2='+cross_2+'&cross_3='+cross_3+'&cross_4='+cross_4+'&cross_5='+cross_5+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&h4='+h4+'&h5='+h5+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&b4='+b4+'&b5='+b5+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&l4='+l4+'&l5='+l5+'&grade1='+grade1+'&day1='+day1+'&test_date1='+test_date1+'&caste_date1='+caste_date1+'&ulr='+ulr;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>savedlc_cube_span.php',
        data: billData,
		dataType: 'JSON',
        success:function(msg){
			$('#btn_save').hide();
               getGlazedTiles();
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val();
	
        }
    });
}

function ccDelete(id)
{
		var lab_no = $('#lab_no').val(); 
	 $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>savedlc_cube_span.php',
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
        url: '<?php echo $base_url; ?>savedlc_cube_span.php',
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
						
						
						  
						 
							 $('#caste_date1').val(data.caste_date1);
							 $('#test_date1').val(data.test_date1);
							 $('#day1').val(data.day1);
							  $('#l1').val(data.l1);
							 $('#l2').val(data.l2);
							 $('#l3').val(data.l3);
							 $('#l4').val(data.l4);
							 $('#l5').val(data.l5);
							  $('#b1').val(data.b1);
							 $('#b2').val(data.b2);
							 $('#b3').val(data.b3);
							 $('#b4').val(data.b4);
							 $('#b5').val(data.b5);
							  $('#h1').val(data.h1);
							 $('#h2').val(data.h2);
							 $('#h3').val(data.h3);
							 $('#h4').val(data.h4);
							 $('#h5').val(data.h5);
							  $('#cross_1').val(data.cross_1);
							 $('#cross_2').val(data.cross_2);
							 $('#cross_3').val(data.cross_3);
							 $('#cross_4').val(data.cross_4);
							 $('#cross_5').val(data.cross_5);
							 $('#mass_1').val(data.mass_1);
							 $('#mass_2').val(data.mass_2);
							 $('#mass_3').val(data.mass_3);
							 $('#mass_4').val(data.mass_4);
							 $('#mass_5').val(data.mass_5);
							  $('#load_1').val(data.load_1);
							 $('#load_2').val(data.load_2);
							 $('#load_3').val(data.load_3);
							 $('#load_4').val(data.load_4);
							 $('#load_5').val(data.load_5);
							  $('#comp_1').val(data.comp_1);
							 $('#comp_2').val(data.comp_2);
							 $('#comp_3').val(data.comp_3);
							 $('#comp_4').val(data.comp_4);
							 $('#comp_5').val(data.comp_5);
							  $('#avg_com_s_1').val(data.avg_com_s_1);
							  $('#grade1').val(data.grade1);
						
						
						 $('#top_casting_date').val(data.top_casting_date);
						 $('#top_days').val(data.top_days);
						 $('#top_grade').val(data.top_grade);
						 $('#top_no_of_cube').val(data.top_no_of_cube);
						 $('#top_remark').val(data.top_remark);
						 $('#top_set').val(data.top_set);
						 
						
						  
						 
						 
						 
						
						 
						 
						 
						 
						
					}
				}
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}



</script>


