
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
		if(isset($_GET['job_no'])){
			$job_no=$_GET['job_no'];
			
		}
		if(isset($_GET['trf_no'])){
			$trf_no=$_GET['trf_no'];
			
		}
		if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
			
			
		}
		if(isset($_GET['lab_no'])){
			$lab_no=$_GET['lab_no'];
			$aa	=$_GET['lab_no'];
			
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
	
	<section class="content common_material p-0">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">CONCRETE CYLINDER</h2>
					</div>
					<div class="box-default">
					<form class="form" id="Glazed" method="post">
						<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">

								<div class="col-lg-6">
									<div class="form-group">
									
									  <label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>

									  <div class="col-sm-10">
										<input type="text" class="form-control" id="report_no" value="<?php echo $report_no;?>" name="report_no" ReadOnly >
									  </div>

										
									</div>
								</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Job No.:</label>
											<div class="col-sm-10">											
													<input type="text" class="form-control" tabindex="1"  value="<?php echo $job_no;?>" id="job_no" name="job_no" ReadOnly>
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
										  <label for="inputEmail3" class="col-sm-2 control-label">Lab No.:</label>
										 

										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no;?>" name="lab_no" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Grade :</label>									 
										  <div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="top_grade" value="<?php echo $cc_grade;?>" name="top_grade" ReadOnly>
										  </div>
										  
										  <label for="inputEmail3" class="col-sm-2 control-label">Casting Date :</label>									 
										  <div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="top_casting_date" value="<?php echo date('d/m/Y', strtotime($casting_date));?>" name="top_casting_date" ReadOnly>
										  </div>
										  
										   <label for="inputEmail3" class="col-sm-2 control-label">Day :</label>									 
										  <div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="top_days" value="<?php echo $cc_day;?>" name="top_days" ReadOnly>
										  </div>
										  
										</div>
									</div>
									
								</div>
								
								<br>
							<!-- LAB NO PUT VAIBHAV-->
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Remarks.:</label>
										 

										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="top_remark" value="<?php echo $day_remark;?>" name="top_remark" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">Cube Set :</label>									 
										  <div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="top_set" value="<?php echo $cc_set_of_cube;?>" name="top_set" ReadOnly>
										  </div>
										  
										  <label for="inputEmail3" class="col-sm-2 control-label">No. Of Cube :</label>									 
										  <div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="top_no_of_cube" value="<?php echo $cc_no_of_cube;?>" name="top_no_of_cube" ReadOnly>
										  </div>
										  
										  
										  
										</div>
									</div>
									
								</div>
								<br>
								<div class="row">
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
													$querys_job1 = "SELECT * FROM con_cylinder WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
											// $val =  $_SESSION['isadmin'];
											// if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
											?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_con_cylinder.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_con_cylinder.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

											</div>
											<?php //} ?>
											
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
										<input type="text" class="form-control" id='avg_dia1' name='avg_dia1' disabled>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_dia2' name='avg_dia2' disabled>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_dia3' name='avg_dia3' disabled>
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
										<input type="text" class="form-control" id='avg_len1' name='avg_len1' disabled>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_len2' name='avg_len2' disabled>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='avg_len3' name='avg_len3' disabled>
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
								<!--<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control" id='spl_avg2' name='spl_avg12'>
									</div>
								</div>-->
								
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
								<th style="text-align:center;"><label>Report No.</label></th>	
								<th style="text-align:center;"><label>Job No.</label></th>	
								<th style="text-align:center;"><label>Lab No.</label></th>	
							
							
																		

							</tr>
								<?php
							 $query = "select * from con_cylinder WHERE lab_no='$aa'  and `is_deleted`='0'";

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
										
										<td style="text-align:center;"><?php echo $r['report_no'];?></td>
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
	
   
   function spl_auto()
	{
		$('#txtspl').css("background-color","var(--success)"); 
		
		var spl_avg1 = randomNumberFromRange(3.00,5.80).toFixed(2);
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var spl_str1 = (+spl_avg1) - (+randomNumberFromRange(0.10,0.15).toFixed(2));
			var spl_str2 = (+spl_avg1) + (+randomNumberFromRange(0.07,0.14).toFixed(2));
			var spl_str3 = (+spl_avg1) + (+randomNumberFromRange(0.10,0.15).toFixed(2));
		}else{
			var spl_str1 = (+spl_avg1) - (+randomNumberFromRange(0.07,0.14).toFixed(2));
			var spl_str2 = (+spl_avg1) - (+randomNumberFromRange(0.10,0.15).toFixed(2));
			var spl_str3 = (+spl_avg1) + (+randomNumberFromRange(0.09,0.17).toFixed(2));
		}

		var spl_avg1 = ((+spl_str1) + (+spl_str2) + (+spl_str3)) / 3;
		$('#spl_avg1').val((+spl_avg1).toFixed(2));

		$('#spl_str1').val((+spl_str1).toFixed(2));
		$('#spl_str2').val((+spl_str2).toFixed(2));
		$('#average').val((+spl_str3).toFixed(2));

		var d_read1_1 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read1_2 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read1_3 = randomNumberFromRange(149.80,150.20).toFixed(2);
		
		var d_read2_1 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read2_2 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read2_3 = randomNumberFromRange(149.80,150.20).toFixed(2);
		
		var d_read3_1 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read3_2 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read3_3 = randomNumberFromRange(149.80,150.20).toFixed(2);
		
		var avg_dia1 = ((+d_read1_1) + (+d_read2_1) + (+d_read3_1)) / 3;
		var avg_dia2 = ((+d_read1_2) + (+d_read2_2) + (+d_read3_2)) / 3;
		var avg_dia3 = ((+d_read1_3) + (+d_read2_3) + (+d_read3_3)) / 3;
		
		$('#d_read1_1').val(d_read1_1);
		$('#d_read1_2').val(d_read1_2);
		$('#d_read1_3').val(d_read1_3);
		$('#d_read2_1').val(d_read2_1);
		$('#d_read2_2').val(d_read2_2);
		$('#d_read2_3').val(d_read2_3);
		$('#d_read3_1').val(d_read3_1);
		$('#d_read3_2').val(d_read3_2);
		$('#d_read3_3').val(d_read3_3);
		$('#avg_dia1').val((+avg_dia1).toFixed(2));
		$('#avg_dia2').val((+avg_dia2).toFixed(2));
		$('#avg_dia3').val((+avg_dia3).toFixed(2));

		var l_read1_1 = randomNumberFromRange(299.80,300.20).toFixed(2);
		var l_read1_2 = randomNumberFromRange(299.80,300.20).toFixed(2);
		var l_read1_3 = randomNumberFromRange(299.80,300.20).toFixed(2);

		var l_read2_1 = randomNumberFromRange(299.80,300.20).toFixed(2);
		var l_read2_2 = randomNumberFromRange(299.80,300.20).toFixed(2);
		var l_read2_3 = randomNumberFromRange(299.80,300.20).toFixed(2);

		var avg_len1 = ((+l_read1_1) + (+l_read2_1)) / 2;
		var avg_len2 = ((+l_read1_2) + (+l_read2_2)) / 2;
		var avg_len3 = ((+l_read1_3) + (+l_read2_3)) / 2;

		$('#l_read1_1').val(l_read1_1);
		$('#l_read1_2').val(l_read1_2);
		$('#l_read1_3').val(l_read1_3);
		$('#l_read2_1').val(l_read2_1);
		$('#l_read2_2').val(l_read2_2);
		$('#l_read2_3').val(l_read2_3);

		$('#avg_len1').val((+avg_len1).toFixed(2));
		$('#avg_len2').val((+avg_len2).toFixed(2));
		$('#avg_len3').val((+avg_len3).toFixed(2));

		var avg_dia1 = $('#avg_dia1').val();
		var avg_dia2 = $('#avg_dia2').val();
		var avg_dia3 = $('#avg_dia3').val();
		
		var avg_len1 = $('#avg_len1').val();
		var avg_len2 = $('#avg_len2').val();
		var avg_len3 = $('#avg_len3').val();
		
		var spl_str1 = $('#spl_str1').val();
		var spl_str2 = $('#spl_str2').val();
		var spl_str3 = $('#average').val();
		
		var spl_load1 = ((+spl_str1) * (+3.141592653589793238) * (+avg_len1) * (+avg_dia1)) / ((+2) * (+1000));
		var spl_load2 = ((+spl_str2) * (+3.141592653589793238) * (+avg_len2) * (+avg_dia2)) / ((+2) * (+1000));
		var spl_load3 = ((+spl_str3) * (+3.141592653589793238) * (+avg_len3) * (+avg_dia3)) / ((+2) * (+1000));
		
		$('#spl_load1').val((+spl_load1).toFixed(1));
		$('#spl_load2').val((+spl_load2).toFixed(1));
		$('#spl_load3').val((+spl_load3).toFixed(1));
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
	
	
	$('#d_read1_1, #d_read1_2, #d_read1_3, #d_read2_1, #d_read2_2, #d_read2_3, #d_read3_1, #d_read3_2, #d_read3_3, #l_read1_1, #l_read1_2, #l_read1_3, #l_read2_1, #l_read2_2, #l_read2_3, #spl_load1, #spl_load2, #spl_load3').change(function(){
		$('#txtspl').css("background-color","var(--success)"); 

		var d_read1_1 = $('#d_read1_1').val();
		var d_read1_2 = $('#d_read1_2').val();
		var d_read1_3 = $('#d_read1_3').val();
		
		var d_read2_1 = $('#d_read2_1').val();
		var d_read2_2 = $('#d_read2_2').val();
		var d_read2_3 = $('#d_read2_3').val();
		
		var d_read3_1 = $('#d_read3_1').val();
		var d_read3_2 = $('#d_read3_2').val();
		var d_read3_3 = $('#d_read3_3').val();
		
		var avg_dia1 = ((+d_read1_1) + (+d_read2_1) + (+d_read3_1)) / 3
		var avg_dia2 = ((+d_read1_2) + (+d_read2_2) + (+d_read3_2)) / 3
		var avg_dia3 = ((+d_read1_3) + (+d_read2_3) + (+d_read3_3)) / 3

		$('#avg_dia1').val((+avg_dia1).toFixed(2));
		$('#avg_dia2').val((+avg_dia2).toFixed(2));
		$('#avg_dia3').val((+avg_dia3).toFixed(2));

		var l_read1_1 = $('#l_read1_1').val();
		var l_read1_2 = $('#l_read1_2').val();
		var l_read1_3 = $('#l_read1_3').val();

		var l_read2_1 = $('#l_read2_1').val();
		var l_read2_2 = $('#l_read2_2').val();
		var l_read2_3 = $('#l_read2_3').val();

		var avg_len1 = ((+l_read1_1) + (+l_read2_1)) / 2;
		var avg_len2 = ((+l_read1_2) + (+l_read2_2)) / 2;
		var avg_len3 = ((+l_read1_3) + (+l_read2_3)) / 2;

		$('#avg_len1').val((+avg_len1).toFixed(2));
		$('#avg_len2').val((+avg_len2).toFixed(2));
		$('#avg_len3').val((+avg_len3).toFixed(2));

		var avg_dia1 = $('#avg_dia1').val();
		var avg_dia2 = $('#avg_dia2').val();
		var avg_dia3 = $('#avg_dia3').val();

		var avg_len1 = $('#avg_len1').val();
		var avg_len2 = $('#avg_len2').val();
		var avg_len3 = $('#avg_len3').val();

		var spl_load1 = $('#spl_load1').val();
		var spl_load2 = $('#spl_load2').val();
		var spl_load3 = $('#spl_load3').val();

		var spl_str1 = (((+2) * (+spl_load1)) / ((+3.141592653589793238) * (+avg_dia1) * (+avg_len1))) * 1000;
		var spl_str2 = (((+2) * (+spl_load2)) / ((+3.141592653589793238) * (+avg_dia2) * (+avg_len2))) * 1000;
		var spl_str3 = (((+2) * (+spl_load3)) / ((+3.141592653589793238) * (+avg_dia3) * (+avg_len3))) * 1000;

		$('#spl_str1').val((+spl_str1).toFixed(2));
		$('#spl_str2').val((+spl_str2).toFixed(2));
		$('#average').val((+spl_str3).toFixed(2));

		var spl_str1 = $('#spl_str1').val();
		var spl_str2 = $('#spl_str2').val();
		var spl_str3 = $('#average').val();

		var spl_avg1 = ((+spl_str1) + (+spl_str2) + (+spl_str3)) / 3;
		$('#spl_avg1').val((+spl_avg1).toFixed(2));
	})

	$('#spl_avg1').change(function(){
		$('#txtspl').css("background-color","var(--success)"); 


		var spl_avg1 = $('#spl_avg1').val();
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var spl_str1 = (+spl_avg1) - (+randomNumberFromRange(0.10,0.15).toFixed(2));
			var spl_str2 = (+spl_avg1) + ((+spl_avg1) - (+spl_str1)) - (0.03);
			var spl_str3 = (+spl_avg1) + (+0.03);
		}else{
			var spl_str1 = (+spl_avg1) + (+randomNumberFromRange(0.10,0.20).toFixed(2));
			var spl_str2 = (+spl_avg1) - ((+spl_str1) - (+spl_avg1)) - (+0.06);
			var spl_str3 = (+spl_avg1) + (+0.06);
		}

		$('#spl_str1').val((+spl_str1).toFixed(2));
		$('#spl_str2').val((+spl_str2).toFixed(2));
		$('#average').val((+spl_str3).toFixed(2));

		var d_read1_1 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read1_2 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read1_3 = randomNumberFromRange(149.80,150.20).toFixed(2);
		
		var d_read2_1 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read2_2 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read2_3 = randomNumberFromRange(149.80,150.20).toFixed(2);
		
		var d_read3_1 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read3_2 = randomNumberFromRange(149.80,150.20).toFixed(2);
		var d_read3_3 = randomNumberFromRange(149.80,150.20).toFixed(2);
		
		var avg_dia1 = ((+d_read1_1) + (+d_read2_1) + (+d_read3_1)) / 3;
		var avg_dia2 = ((+d_read1_2) + (+d_read2_2) + (+d_read3_2)) / 3;
		var avg_dia3 = ((+d_read1_3) + (+d_read2_3) + (+d_read3_3)) / 3;
		
		$('#d_read1_1').val(d_read1_1);
		$('#d_read1_2').val(d_read1_2);
		$('#d_read1_3').val(d_read1_3);
		$('#d_read2_1').val(d_read2_1);
		$('#d_read2_2').val(d_read2_2);
		$('#d_read2_3').val(d_read2_3);
		$('#d_read3_1').val(d_read3_1);
		$('#d_read3_2').val(d_read3_2);
		$('#d_read3_3').val(d_read3_3);
		$('#avg_dia1').val((+avg_dia1).toFixed(2));
		$('#avg_dia2').val((+avg_dia2).toFixed(2));
		$('#avg_dia3').val((+avg_dia3).toFixed(2));

		var l_read1_1 = randomNumberFromRange(299.80,300.20).toFixed(2);
		var l_read1_2 = randomNumberFromRange(299.80,300.20).toFixed(2);
		var l_read1_3 = randomNumberFromRange(299.80,300.20).toFixed(2);

		var l_read2_1 = randomNumberFromRange(299.80,300.20).toFixed(2);
		var l_read2_2 = randomNumberFromRange(299.80,300.20).toFixed(2);
		var l_read2_3 = randomNumberFromRange(299.80,300.20).toFixed(2);

		var avg_len1 = ((+l_read1_1) + (+l_read2_1)) / 2;
		var avg_len2 = ((+l_read1_2) + (+l_read2_2)) / 2;
		var avg_len3 = ((+l_read1_3) + (+l_read2_3)) / 2;

		$('#l_read1_1').val(l_read1_1);
		$('#l_read1_2').val(l_read1_2);
		$('#l_read1_3').val(l_read1_3);
		$('#l_read2_1').val(l_read2_1);
		$('#l_read2_2').val(l_read2_2);
		$('#l_read2_3').val(l_read2_3);

		$('#avg_len1').val((+avg_len1).toFixed(2));
		$('#avg_len2').val((+avg_len2).toFixed(2));
		$('#avg_len3').val((+avg_len3).toFixed(2));

		var avg_dia1 = $('#avg_dia1').val();
		var avg_dia2 = $('#avg_dia2').val();
		var avg_dia3 = $('#avg_dia3').val();
		
		var avg_len1 = $('#avg_len1').val();
		var avg_len2 = $('#avg_len2').val();
		var avg_len3 = $('#avg_len3').val();
		
		var spl_str1 = $('#spl_str1').val();
		var spl_str2 = $('#spl_str2').val();
		var spl_str3 = $('#average').val();
		
		var spl_load1 = ((+spl_str1) * (+3.141592653589793238) * (+avg_len1) * (+avg_dia1)) / ((+2) * (+1000));
		var spl_load2 = ((+spl_str2) * (+3.141592653589793238) * (+avg_len2) * (+avg_dia2)) / ((+2) * (+1000));
		var spl_load3 = ((+spl_str3) * (+3.141592653589793238) * (+avg_len3) * (+avg_dia3)) / ((+2) * (+1000));
		
		$('#spl_load1').val((+spl_load1).toFixed(1));
		$('#spl_load2').val((+spl_load2).toFixed(1));
		$('#spl_load3').val((+spl_load3).toFixed(1));
	})

	
	$('#chk_com').change(function(){
		if(this.checked)
		{ 
				/*var cast = $('#top_casting_date').val();
				document.getElementById('caste_date1').value = cast;*/
				var top_days = $('#top_days').val();
				var top_grade = $('#top_grade').val();
					
				if(top_days=="7")
				{
						/*var top = 7;
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
					   $('#day1').val(top);*/
						
						var mass_1 = randomNumberFromRange(8.10, 8.80);
						var mass_2 = randomNumberFromRange(8.10, 8.80);
						var mass_3 = randomNumberFromRange(8.10, 8.80);
						
					if(top_grade =="M-10")
					{
						var avg_com_s_1 = randomNumberFromRange(7.40, 9.10);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-15")
					{
						var avg_com_s_1 = randomNumberFromRange(11.80, 13.30);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.30,0.80);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.30,0.80);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-20")
					{
						var avg_com_s_1 = randomNumberFromRange(14.50, 17.50);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-25")
					{
						var avg_com_s_1 = randomNumberFromRange(19.00, 22.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.50,1.50);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.50,1.50);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-30")
					{
						var avg_com_s_1 = randomNumberFromRange(22.00, 26.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.50,1.50);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.50,1.50);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-35")
					{
						var avg_com_s_1 = randomNumberFromRange(26.60, 31.70);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.80,1.80);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.80,1.80);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="M-40")
					{
						var avg_com_s_1 = randomNumberFromRange(30.10, 34.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-2.00,2.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-2.00,2.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-45")
					{
						var avg_com_s_1 = randomNumberFromRange(32.50, 36.20);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-2.00,2.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-2.00,2.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
					
					}
					else if(top_grade=="M-50")
					{
						var avg_com_s_1 = randomNumberFromRange(36.50, 46.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-2.00,2.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-2.00,2.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:3:6")
					{
						var avg_com_s_1 = randomNumberFromRange(7.40, 9.10);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
					
					}
					else if(top_grade=="1:2:4")
					{
						var avg_com_s_1 = randomNumberFromRange(11.80, 13.30);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.30,0.80);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.30,0.80);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1.5:3")
					{
						var avg_com_s_1 = randomNumberFromRange(14.50, 17.50);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1:2")
					{
						var avg_com_s_1 = randomNumberFromRange(19.00, 22.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.50,1.50);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.50,1.50);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					
					
				}
				else if(top_days=="28")
				{	
						/*var top = 28;
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
					   $('#day1').val(top);*/
						
						var mass_1 = randomNumberFromRange(8.10, 8.80);
						var mass_2 = randomNumberFromRange(8.10, 8.80);
						var mass_3 = randomNumberFromRange(8.10, 8.80);
						
					if(top_grade =="M-10")
					{
						var avg_com_s_1 = randomNumberFromRange(11.10, 13.70);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-15")
					{
						var avg_com_s_1 = randomNumberFromRange(16.30, 18.70);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.30,0.80);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.30,0.80);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-20")
					{
						var avg_com_s_1 = randomNumberFromRange(22.00, 23.70);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-25")
					{
						var avg_com_s_1 = randomNumberFromRange(26.50, 29.10);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.50,0.50);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.50,0.50);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-30")
					{
						var avg_com_s_1 = randomNumberFromRange(32.00, 33.50);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-35")
					{
						var avg_com_s_1 = randomNumberFromRange(37.00, 38.50);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-40")
					{
						var avg_com_s_1 = randomNumberFromRange(42.00, 43.50);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-45")
					{
						var avg_com_s_1 = randomNumberFromRange(47.00, 48.50);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-50")
					{
						var avg_com_s_1 = randomNumberFromRange(52.00, 53.50);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="1:3:6")
					{
						var avg_com_s_1 = randomNumberFromRange(11.10, 13.70);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="1:2:4")
					{
						var avg_com_s_1 = randomNumberFromRange(16.30, 18.70);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.30,0.80);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.30,0.80);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="1:1.5:3")
					{
						var avg_com_s_1 = randomNumberFromRange(22.00, 23.70);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="1:1:2")
					{
						var avg_com_s_1 = randomNumberFromRange(26.50, 29.10);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-1.00,1.00);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
						
					
				}
				
				else if(top_days=="other")
				{
						
						/*var day1 = ('#day1').val();
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
						$('#day3').val(day1);*/
						
						var mass_1 = randomNumberFromRange(8.10, 8.80);
						var mass_2 = randomNumberFromRange(8.10, 8.80);
						var mass_3 = randomNumberFromRange(8.10, 8.80);
						
						
						if(top_grade =="M-10")
					{
						var avg_com_s_1 = randomNumberFromRange(8.00, 9.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
						
					}
					else if(top_grade=="M-15")
					{
						var avg_com_s_1 = randomNumberFromRange(11.00, 13.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-20")
					{
						var avg_com_s_1 = randomNumberFromRange(15.00, 17.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-25")
					{
						var avg_com_s_1 = randomNumberFromRange(18.50, 20.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="M-30")
					{
						var avg_com_s_1 = randomNumberFromRange(22.00, 24.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-35")
					{
						var avg_com_s_1 = randomNumberFromRange(26.00, 28.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-40")
					{
						var avg_com_s_1 = randomNumberFromRange(30.00, 32.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="1:3:6")
					{
						var avg_com_s_1 = randomNumberFromRange(8.00, 9.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="1:2:4")
					{
						var avg_com_s_1 = randomNumberFromRange(11.00, 13.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1.5:3")
					{
						var avg_com_s_1 = randomNumberFromRange(15.00, 17.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="1:5")
					{
						var avg_com_s_1 = randomNumberFromRange(3.50, 4.50);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="1:3")
					{
						var avg_com_s_1 = randomNumberFromRange(5.00, 6.00);
						var comp_1 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var comp_2 = parseFloat(avg_com_s_1) + randomNumberFromRange(-0.10,0.40);
						var sums = parseFloat(comp_1)+parseFloat(comp_2);
						var comp_3 = (parseFloat(avg_com_s_1)*3)-parseFloat(sums);
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
						
					
					
				}
		
				var rr = $('#lab_no').val();
				var grade = $('#top_grade').val();
				var grade1 = grade;
				$('#grade1').val(grade1);
				var l1 = parseFloat(randomNumberFromRange(150.0, 150.0)).toFixed(1);
				var l2 = parseFloat(randomNumberFromRange(150.0, 150.0)).toFixed(1);
				var l3 = parseFloat(randomNumberFromRange(150.0, 150.0)).toFixed(1);
				
				$('#l1').val(l1);
				$('#l2').val(l2);
				$('#l3').val(l3);
				var b1 = parseFloat(randomNumberFromRange(150.0, 150.0)).toFixed(1);
				var b2 = parseFloat(randomNumberFromRange(150.0, 150.0)).toFixed(1);
				var b3 =parseFloat( randomNumberFromRange(150.0, 150.0)).toFixed(1);
				$('#b1').val(b1);
				$('#b2').val(b2);
				$('#b3').val(b3);
				var h1 = parseFloat(randomNumberFromRange(150.0, 150.0)).toFixed(1);
				var h2 = parseFloat(randomNumberFromRange(150.0, 150.0)).toFixed(1);
				var h3 = parseFloat(randomNumberFromRange(150.0, 150.0)).toFixed(1);
				$('#h1').val(h1);
				$('#h2').val(h2);
				$('#h3').val(h3);
				var cross_1 = parseFloat(l1) * parseFloat(b1);
				var cross_2 = parseFloat(l2) * parseFloat(b2);
				var cross_3 = parseFloat(l3) * parseFloat(b3);
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
		$('#txtdim').css("background-color","var(--success)"); 
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
	}
	
	
	
	$('#avg_com_s_1').change(function(){
		$('#txtdim').css("background-color","var(--success)"); 
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
					$('#txtdim').css("background-color","var(--success)"); 	
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
							$('#txtdim').css("background-color","var(--success)"); 							
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
        url: '<?php echo $base_url; ?>save_con_cylinder.php',
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
				var amend_date = $('#amend_date').val();
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
					var remarks2 = $('#remarks2').val();
					var remarks3 = $('#remarks3').val();
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
						var cc_identification_mark = $('#cc_identification_mark').val();
						
						break;
					}
					else
					{
						var chk_com = "0";
							
						var remarks = "";
						var remarks2 = "";
						var remarks3 = "";
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
						
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_com='+chk_com+'&top_casting_date='+top_casting_date+'&top_days='+top_days+'&top_grade='+top_grade+'&top_no_of_cube='+top_no_of_cube+'&top_remark='+top_remark+'&top_set='+top_set+'&avg_com_s_1='+avg_com_s_1+'&comp_1='+comp_1+'&comp_2='+comp_2+'&comp_3='+comp_3+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&mass_1='+mass_1+'&mass_2='+mass_2+'&mass_3='+mass_3+'&cross_1='+cross_1+'&cross_2='+cross_2+'&cross_3='+cross_3+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&grade1='+grade1+'&day1='+day1+'&test_date1='+test_date1+'&caste_date1='+caste_date1+'&chk_spl='+chk_spl+'&d_read1_1='+d_read1_1+'&d_read1_2='+d_read1_2+'&d_read1_3='+d_read1_3+'&d_read2_1='+d_read2_1+'&d_read2_2='+d_read2_2+'&d_read2_3='+d_read2_3+'&d_read3_1='+d_read3_1+'&d_read3_2='+d_read3_2+'&d_read3_3='+d_read3_3+'&avg_dia1='+avg_dia1+'&avg_dia2='+avg_dia2+'&avg_dia3='+avg_dia3+'&l_read1_1='+l_read1_1+'&l_read1_2='+l_read1_2+'&l_read1_3='+l_read1_3+'&l_read2_1='+l_read2_1+'&l_read2_2='+l_read2_2+'&l_read2_3='+l_read2_3+'&avg_len1='+avg_len1+'&avg_len2='+avg_len2+'&avg_len3='+avg_len3+'&spl_load1='+spl_load1+'&spl_load2='+spl_load2+'&spl_load3='+spl_load3+'&spl_str1='+spl_str1+'&spl_str2='+spl_str2+'&spl_avg1='+spl_avg1+'&spl_avg2='+spl_avg2+'&average='+average+ '&ulr=' + ulr + '&cc_identification_mark=' + cc_identification_mark + '&fail_pat_1=' + fail_pat_1 + '&fail_pat_2=' + fail_pat_2 + '&fail_pat_3=' + fail_pat_3 + '&cc_qty=' + cc_qty + '&remarks=' + remarks + '&remarks2=' + remarks2 + '&remarks3=' + remarks3 + '&amend_date=' +amend_date;
					
					
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var amend_date = $('#amend_date').val();
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
					var remarks2 = $('#remarks2').val();
					var remarks3 = $('#remarks3').val();
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
						var cc_identification_mark = $('#cc_identification_mark').val();
						
						break;
					}
					else
					{
						var chk_com = "0";
							
						var remarks = "";
						var remarks2 = "";
						var remarks3 = "";
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
																
				var idEdit = $('#idEdit').val(); 
		
				billData =  $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_com='+chk_com+'&top_casting_date='+top_casting_date+'&top_days='+top_days+'&top_grade='+top_grade+'&top_no_of_cube='+top_no_of_cube+'&top_remark='+top_remark+'&top_set='+top_set+'&avg_com_s_1='+avg_com_s_1+'&comp_1='+comp_1+'&comp_2='+comp_2+'&comp_3='+comp_3+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&mass_1='+mass_1+'&mass_2='+mass_2+'&mass_3='+mass_3+'&cross_1='+cross_1+'&cross_2='+cross_2+'&cross_3='+cross_3+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&grade1='+grade1+'&day1='+day1+'&test_date1='+test_date1+'&caste_date1='+caste_date1+'&chk_spl='+chk_spl+'&d_read1_1='+d_read1_1+'&d_read1_2='+d_read1_2+'&d_read1_3='+d_read1_3+'&d_read2_1='+d_read2_1+'&d_read2_2='+d_read2_2+'&d_read2_3='+d_read2_3+'&d_read3_1='+d_read3_1+'&d_read3_2='+d_read3_2+'&d_read3_3='+d_read3_3+'&avg_dia1='+avg_dia1+'&avg_dia2='+avg_dia2+'&avg_dia3='+avg_dia3+'&l_read1_1='+l_read1_1+'&l_read1_2='+l_read1_2+'&l_read1_3='+l_read1_3+'&l_read2_1='+l_read2_1+'&l_read2_2='+l_read2_2+'&l_read2_3='+l_read2_3+'&avg_len1='+avg_len1+'&avg_len2='+avg_len2+'&avg_len3='+avg_len3+'&spl_load1='+spl_load1+'&spl_load2='+spl_load2+'&spl_load3='+spl_load3+'&spl_str1='+spl_str1+'&spl_str2='+spl_str2+'&spl_avg1='+spl_avg1+'&spl_avg2='+spl_avg2+'&average='+average+ '&ulr=' + ulr + '&cc_identification_mark=' + cc_identification_mark + '&fail_pat_1=' + fail_pat_1 + '&fail_pat_2=' + fail_pat_2 + '&fail_pat_3=' + fail_pat_3 + '&cc_qty=' + cc_qty + '&remarks=' + remarks + '&remarks2=' + remarks2 + '&remarks3=' + remarks3 + '&amend_date=' +amend_date;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_con_cylinder.php',
        data: billData,
		dataType: 'JSON',
        success:function(msg){
         
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
        url: '<?php echo $base_url; ?>save_con_cylinder.php',
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
        url: '<?php echo $base_url; ?>save_con_cylinder.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
            $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();
	
             $('#idEdit').val(data.id);
	
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
			$('#amend_date').val(data.amend_date);
			
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
				
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}



</script>


