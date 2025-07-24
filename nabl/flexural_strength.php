
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
	
	<section class="content common_material p-0">
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

								<div class="col-lg-6">
									<br>
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
											<input type="text" class="form-control inputs" tabindex="4" id="top_grade" value="<?php echo $cc_grade;?>" name="top_grade" ReadOnly>
										  </div>
										  
										 <!-- <label for="inputEmail3" class="col-sm-2 control-label">Casting Date :</label>					-->				 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_casting_date" value="<?php echo date('d/m/Y', strtotime($casting_date));?>" name="top_casting_date" ReadOnly>
										  </div>
										  
										   <!--<label for="inputEmail3" class="col-sm-2 control-label">Day :</label>	-->								 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_days" value="<?php echo $cc_day;?>" name="top_days" ReadOnly>
											<select class="form-control" id="f_size" name="f_size">
																	<option value="">-Select-</option>
																	<option value="700,150,150">700 X 150 X 150</option>
																	<option value="500,100,100">500 X 100 X 100</option>
																																
											</select>
										  </div>
										   <div class="col-sm-2" id="dts">
											<select class="form-control f_con" id="f_con" name="f_con">
											<option value="" id="">--SELECT--</option>
											
											<option value="a_200" id="a_200">a&gt;200</option>
											<option value="200_a" id="200_a">a&lt;200</option>
											
											<option value="a_133" id="a_133">a&gt;133</option>
											<option value="133_a" id="133_a">a&lt;133</option>
											
											</select>
											
										  </div>
										  
										</div>
									</div>
									
								</div>
								<br>


							<div class="row">
								<div class="col-lg-6">
										<div class="form-group">
										 <div class="col-sm-2">
													<label>Amend Date :</label>
												</div>								 
										  <div class="col-sm-3">
											<input type="text" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
										  </div>
										</div>
								</div>
							</div>

							<!-- LAB NO PUT VAIBHAV-->
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										 <!-- <label for="inputEmail3" class="col-sm-2 control-label">Remarks.:</label>-->
										 

										  <div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_remark" value="<?php echo $day_remark;?>" name="top_remark" ReadOnly>
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
											<!--<label for="inputEmail3" class="col-sm-2 control-label">Cube Set :</label>-->									 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_set" value="<?php echo $cc_set_of_cube;?>" name="top_set" ReadOnly>
										  </div>
										  
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">No. Of Cube :</label>	-->								 
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_no_of_cube" value="<?php echo $cc_no_of_cube;?>" name="top_no_of_cube" ReadOnly>
										  </div>
										 <!--  <label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>		-->							 
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
													$querys_job1 = "SELECT * FROM flexure_beam WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_flexure.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											
											<?php// } ?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_flexure.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

											</div>
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
			
			if($r1['test_code']=="flx")
			{
				$test_check.="flx,";
			?>
				<div class="panel panel-default" id="com">
					<div class="panel-heading" id="txtdim">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
								<h4 class="panel-title">
								<b>FLEXURAL STRENGTH</b>
								</h4>
							</a>
						</h4>
					</div>
					<div id="collapse5" class="panel-collapse collapse">
						<div class="panel-body">
							<br>
							<div class="row">									
								
								<div class="col-lg-8">
									<div class="form-group">
											<div class="col-sm-1">
												<label for="chk_com">1.</label>
												<input type="checkbox" class="visually-hidden" name="chk_com"  id="chk_com" value="chk_com"><br>
											</div>
										<label for="inputEmail3" class="col-sm-4 control-label label-right">FLEXURAL STRENGTH</label>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
											<div class="col-sm-6">
												<label>WATER TEMPRATURE</label>
											</div>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="wat_temp" name="wat_temp" >
											</div>
											
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
											<label for="inputEmail3" class="control-label">Mark on Cube</label>
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
											<label for="inputEmail3" class="control-label">L in MM</label>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label"> B in MM</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">H in MM</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Position of fracture (a) (cm)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Weight of Cube (kg)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Maximum load at Failure(KN)</label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Flexural Strength (N/mm<sup>2</sup>)</label>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">Average of Flexural Strength (N/mm2)</label>
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
											<input type="text" class="form-control" id="mark_1" name="mark_1" >
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
											<input type="text" class="form-control" id="mark_2" name="mark_2" >
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
											<input type="text" class="form-control" id="mark_3" name="mark_3" >
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
							 $query = "select * from flexure_beam WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	$('#alert').hide();caste_date1

	
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
	
	function com_auto()
	{
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
				var top_days = $('#top_days').val();
				var top_grade = $('#top_grade').val();
					
				if(top_days=="7")
				{						
						var mass_1 = randomNumberFromRange(8.10, 8.80);
						var mass_2 = randomNumberFromRange(8.10, 8.80);
						var mass_3 = randomNumberFromRange(8.10, 8.80);
						
					if(top_grade =="M-10")
					{
						var avg_com_s1 = randomNumberFromRange(1.65,1.60).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-15")
					{
						var avg_com_s1 = randomNumberFromRange(2.00,2.10).toFixed(2);						
						
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
						
					}
					else if(top_grade=="M-20")
					{
						var avg_com_s1 = randomNumberFromRange(2.30,2.40).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-25")
					{
						var avg_com_s1 = randomNumberFromRange(2.55,2.56).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.09);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.09);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-30")
					{
						var avg_com_s1 = randomNumberFromRange(2.80,2.85).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-35")
					{
						var avg_com_s1 = randomNumberFromRange(3.00,3.05).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.04);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.04);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="M-40")
					{
						var avg_com_s1 = randomNumberFromRange(3.15,3.20).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.05,0.08);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.05,0.08);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-45")
					{
						var avg_com_s1 = randomNumberFromRange(3.35,3.40).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.05,0.06);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.05,0.06);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
					
					}
					else if(top_grade=="M-50")
					{
						var avg_com_s1 = randomNumberFromRange(3.55,3.60).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.06,0.06);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.06,0.06);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:3:6")
					{
						var avg_com_s1 = randomNumberFromRange(1.65,1.60).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
					
					}
					else if(top_grade=="1:2:4")
					{
						var avg_com_s1 = randomNumberFromRange(2.00,2.10).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1.5:3")
					{
						var avg_com_s1 = randomNumberFromRange(2.30,2.40).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1:2")
					{
						var avg_com_s1 = randomNumberFromRange(2.55,2.56).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.09);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.09);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					
					
				}
				else if(top_days=="28")
				{	
				
						var mass_1 = randomNumberFromRange(8.10, 8.80);
						var mass_2 = randomNumberFromRange(8.10, 8.80);
						var mass_3 = randomNumberFromRange(8.10, 8.80);
						
					if(top_grade =="M-10")
					{
						var avg_com_s1 = randomNumberFromRange(2.40,2.50).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.18,0.20);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.18,0.20);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-15")
					{
						var avg_com_s1 = randomNumberFromRange(2.80,2.90).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.08,0.11);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.08,0.11);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
					}
					else if(top_grade=="M-20")
					{
						var avg_com_s1 = randomNumberFromRange(3.20,3.40).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.06,0.10);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.06,0.10);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-25")
					{
						var avg_com_s1 = randomNumberFromRange(3.60,3.70).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-30")
					{
						var avg_com_s1 = randomNumberFromRange(3.95,4.00).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.14);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.14);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-35")
					{
						var avg_com_s1 = randomNumberFromRange(4.25,4.30).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.11);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.11);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-40")
					{
						var avg_com_s1 = randomNumberFromRange(4.50,4.60).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.06,0.09);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.06,0.09);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-45")
					{
						var avg_com_s1 = randomNumberFromRange(4.80,4.90).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.04);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.04);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-50")
					{
						var avg_com_s1 = randomNumberFromRange(5.00,5.10).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.04,0.10);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.04,0.10);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="1:3:6")
					{
						var avg_com_s1 = randomNumberFromRange(2.40,2.50).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.18,0.20);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.18,0.20);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="1:2:4")
					{
						var avg_com_s1 = randomNumberFromRange(2.80,2.90).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.08,0.11);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.08,0.11);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					
					}
					else if(top_grade=="1:1.5:3")
					{
						var avg_com_s1 = randomNumberFromRange(3.20,3.40).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.06,0.10);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.06,0.10);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="1:1:2")
					{
						var avg_com_s1 = randomNumberFromRange(3.60,3.70).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
						
					
				}
				
				else if(top_days=="other")
				{
					
						var mass_1 = randomNumberFromRange(8.10, 8.80);
						var mass_2 = randomNumberFromRange(8.10, 8.80);
						var mass_3 = randomNumberFromRange(8.10, 8.80);
						
						
						if(top_grade =="M-10")
					{
						var avg_com_s1 = randomNumberFromRange(1.65,1.60).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-15")
					{
						var avg_com_s1 = randomNumberFromRange(2.00,2.10).toFixed(2);						
						
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
						
						
					}
					else if(top_grade=="M-20")
					{
						var avg_com_s1 = randomNumberFromRange(2.30,2.40).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-25")
					{
						var avg_com_s1 = randomNumberFromRange(2.55,2.56).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.09);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.09);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
						
					}
					else if(top_grade=="M-30")
					{
						var avg_com_s1 = randomNumberFromRange(2.80,2.85).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-35")
					{
						var avg_com_s1 = randomNumberFromRange(3.00,3.05).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.04);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.04);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					
					}
					else if(top_grade=="M-40")
					{
						var avg_com_s1 = randomNumberFromRange(3.15,3.20).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.05,0.08);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.05,0.08);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="M-45")
					{
						var avg_com_s1 = randomNumberFromRange(3.35,3.40).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.05,0.06);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.05,0.06);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
					
					}
					else if(top_grade=="M-50")
					{
						var avg_com_s1 = randomNumberFromRange(3.55,3.60).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.06,0.06);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.06,0.06);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:3:6")
					{
						var avg_com_s1 = randomNumberFromRange(1.65,1.60).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.30);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
					
					}
					else if(top_grade=="1:2:4")
					{
						var avg_com_s1 = randomNumberFromRange(2.00,2.10).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.10);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1.5:3")
					{
						var avg_com_s1 = randomNumberFromRange(2.30,2.40).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.10,0.05);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
					else if(top_grade=="1:1:2")
					{
						var avg_com_s1 = randomNumberFromRange(2.55,2.56).toFixed(2);
						$('#avg_com_s_1').val(avg_com_s1);
						var avg_com_s_1 = $('#avg_com_s_1').val();
						
						var comp1 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.09);
						var comp2 = (+avg_com_s_1) + randomNumberFromRange(-0.09,0.09);
						$('#comp_1').val(comp1.toFixed(2));
						$('#comp_2').val(comp2.toFixed(2));
						var comp_1 = $('#comp_1').val();
						var comp_2 = $('#comp_2').val();
						
						var sums = (+comp_1)+(+comp_2);
						
						var comp_3 = ((+avg_com_s_1)*3)-(+sums);
						$('#comp_3').val(comp_3.toFixed(2));
						
					}
						
					
					
				}
		
				
				
				var rr = $('#lab_no').val();
				var grade = $('#top_grade').val();
				var grade1 = grade;
				$('#grade1').val(grade1);
				
				var f_size = $('#f_size').val();
				var f_con = $('#f_con').val();
				
				if(f_size=="700,150,150")
				{
					var l1 = randomNumberFromRange(700.0, 700.0).toFixed(1);
					var l2 = randomNumberFromRange(700.0, 700.0).toFixed(1);
					var l3 = randomNumberFromRange(700.0, 700.0).toFixed(1);
					
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
				}
				else
				{
					var l1 = randomNumberFromRange(500.0, 500.0).toFixed(1);
					var l2 = randomNumberFromRange(500.0, 500.0).toFixed(1);
					var l3 = randomNumberFromRange(500.0, 500.0).toFixed(1);
					
					$('#l1').val(l1);
					$('#l2').val(l2);
					$('#l3').val(l3);
					var b1 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					var b2 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					var b3 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					$('#b1').val(b1);
					$('#b2').val(b2);
					$('#b3').val(b3);
					var h1 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					var h2 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					var h3 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					$('#h1').val(h1);
					$('#h2').val(h2);
					$('#h3').val(h3);
				}
				$('#mass_1').val(mass_1.toFixed(2));
				$('#mass_2').val(mass_2.toFixed(2));
				$('#mass_3').val(mass_3.toFixed(2));
				if(f_con=="a_200")
				{
					var cross_2 = randomNumberFromRange(205.0, 245.0).toFixed(0);
					var cross_3 = randomNumberFromRange(205.0, 245.0).toFixed(0);
					var cross_1 = randomNumberFromRange(205.0, 245.0).toFixed(0);
					$('#cross_1').val(cross_1);
					$('#cross_2').val(cross_2);
					$('#cross_3').val(cross_3);
					
					var com1 = $('#comp_1').val();
					var com2 = $('#comp_2').val();
					var com3 = $('#comp_3').val();
					
					var load_1 = ((+5.625)*(+com1));
					var load_2 = ((+5.625)*(+com2));
					var load_3 = ((+5.625)*(+com3));
					
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));				
					$('#load_3').val(load_3.toFixed(1));
					var load1 = $('#load_1').val();
					var load2 = $('#load_2').val();
					var load3 = $('#load_3').val();
					
					var c_om1 = (+load1)/5.625;
					var c_om2 = (+load2)/5.625;
					var c_om3 = (+load3)/5.625;
					
					$('#comp_1').val(c_om1.toFixed(2));
					$('#comp_2').val(c_om2.toFixed(2));
					$('#comp_3').val(c_om3.toFixed(2));
					
					var co1 = $('#comp_1').val();
					var co2 = $('#comp_2').val();
					var co3 = $('#comp_3').val();
					
					var avg  = ((+co1) + (+co2) + (+co3)) / 3;
					$('#avg_com_s_1').val(avg.toFixed(2));	
					
					
				}
				else if(f_con=="a_133")
				{
					var cross_1 = randomNumberFromRange(135.0, 160.0).toFixed(0);
					var cross_2 = randomNumberFromRange(135.0, 160.0).toFixed(0);
					var cross_3 = randomNumberFromRange(135.0, 160.0).toFixed(0);
					$('#cross_1').val(cross_1);
					$('#cross_2').val(cross_2);
					$('#cross_3').val(cross_3);
					
					var com1 = $('#comp_1').val();
					var com2 = $('#comp_2').val();
					var com3 = $('#comp_3').val();
					
					var load_1 = ((+2.5)*(+com1));
					var load_2 = ((+2.5)*(+com2));
					var load_3 = ((+2.5)*(+com3));
					
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));				
					$('#load_3').val(load_3.toFixed(1));
					var load1 = $('#load_1').val();
					var load2 = $('#load_2').val();
					var load3 = $('#load_3').val();
					
					var c_om1 = (+load1)/2.5;
					var c_om2 = (+load2)/2.5;
					var c_om3 = (+load3)/2.5;
					
					$('#comp_1').val(c_om1.toFixed(2));
					$('#comp_2').val(c_om2.toFixed(2));
					$('#comp_3').val(c_om3.toFixed(2));
					
					var co1 = $('#comp_1').val();
					var co2 = $('#comp_2').val();
					var co3 = $('#comp_3').val();
					
					var avg  = ((+co1) + (+co2) + (+co3)) / 3;
					$('#avg_com_s_1').val(avg.toFixed(2));
				}
				else if(f_con=="200_a")
				{
					var cross_2 = randomNumberFromRange(170.0, 198.0).toFixed(0);
					var cross_3 = randomNumberFromRange(170.0, 198.0).toFixed(0);
					var cross_1 = randomNumberFromRange(170.0, 198.0).toFixed(0);
					$('#cross_1').val(cross_1);
					$('#cross_2').val(cross_2);
					$('#cross_3').val(cross_3);
					
					var a1 = $('#cross_1').val();
					var a2 = $('#cross_2').val();
					var a3 = $('#cross_3').val();
					
					var com1 = $('#comp_1').val();
					var com2 = $('#comp_2').val();
					var com3 = $('#comp_3').val();
					
					var load_1 = (((+1125)/(+a1))*(+com1));
					var load_2 = (((+1125)/(+a2))*(+com2));
					var load_3 = (((+1125)/(+a3))*(+com3));
					
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));				
					$('#load_3').val(load_3.toFixed(1));
					var load1 = $('#load_1').val();
					var load2 = $('#load_2').val();
					var load3 = $('#load_3').val();
					
					var c_om1 = ((+load1)*(+a1))/1125;
					var c_om2 = ((+load2)*(+a2))/1125;
					var c_om3 = ((+load3)*(+a3))/1125;
					
					$('#comp_1').val(c_om1.toFixed(2));
					$('#comp_2').val(c_om2.toFixed(2));
					$('#comp_3').val(c_om3.toFixed(2));
					
					var co1 = $('#comp_1').val();
					var co2 = $('#comp_2').val();
					var co3 = $('#comp_3').val();
					
					var avg  = ((+co1) + (+co2) + (+co3)) / 3;
					$('#avg_com_s_1').val(avg.toFixed(2));
					
				}
				else if(f_con=="133_a")
				{
					var cross_2 = randomNumberFromRange(110.0, 130.0).toFixed(0);
					var cross_3 = randomNumberFromRange(110.0, 130.0).toFixed(0);
					var cross_1 = randomNumberFromRange(110.0, 130.0).toFixed(0);
					$('#cross_1').val(cross_1);
					$('#cross_2').val(cross_2);
					$('#cross_3').val(cross_3);
					
					var a1 = $('#cross_1').val();
					var a2 = $('#cross_2').val();
					var a3 = $('#cross_3').val();
					
					var com1 = $('#comp_1').val();
					var com2 = $('#comp_2').val();
					var com3 = $('#comp_3').val();
					
					var load_1 = (((+333.33)/(+a1))*(+com1));
					var load_2 = (((+333.33)/(+a2))*(+com2));
					var load_3 = (((+333.33)/(+a3))*(+com3));
					
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));				
					$('#load_3').val(load_3.toFixed(1));
					var load1 = $('#load_1').val();
					var load2 = $('#load_2').val();
					var load3 = $('#load_3').val();
					
					var c_om1 = ((+load1)*(+a1))/333.33;
					var c_om2 = ((+load2)*(+a2))/333.33;
					var c_om3 = ((+load3)*(+a3))/333.33;
					
					$('#comp_1').val(c_om1.toFixed(2));
					$('#comp_2').val(c_om2.toFixed(2));
					$('#comp_3').val(c_om3.toFixed(2));
					
					var co1 = $('#comp_1').val();
					var co2 = $('#comp_2').val();
					var co3 = $('#comp_3').val();
					
					var avg  = ((+co1) + (+co2) + (+co3)) / 3;
					$('#avg_com_s_1').val(avg.toFixed(2));
				}
				
				
				
				
				
				
				
				
				
				
				
				
				
					
				
	}
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			var temp = $('#test_list').val();
				var aa= temp.split(",");
				//flx
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flx")
					{
						$('#txtdim').css("background-color","var(--success)");
						$("#chk_com").prop("checked", true); 
						com_auto();
						break;
					}					
				}
		}
	});
	
	$('#chk_com').change(function(){
		if(this.checked)
		{ 
				/*var cast = $('#top_casting_date').val();
				document.getElementById('caste_date1').value = cast;*/
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
			$('#wat_temp').val(null);
			$('#mark_1').val(null);
			$('#mark_2').val(null);
			$('#mark_3').val(null);
		}
		
	});
	
	
	
	
	
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
						
						
						
						
				var f_size = $('#f_size').val();
				var f_con = $('#f_con').val();
				
				if(f_size=="700,150,150")
				{
					var l1 = randomNumberFromRange(700.0, 700.0).toFixed(1);
					var l2 = randomNumberFromRange(700.0, 700.0).toFixed(1);
					var l3 = randomNumberFromRange(700.0, 700.0).toFixed(1);
					
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
				}
				else
				{
					var l1 = randomNumberFromRange(500.0, 500.0).toFixed(1);
					var l2 = randomNumberFromRange(500.0, 500.0).toFixed(1);
					var l3 = randomNumberFromRange(500.0, 500.0).toFixed(1);
					
					$('#l1').val(l1);
					$('#l2').val(l2);
					$('#l3').val(l3);
					var b1 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					var b2 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					var b3 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					$('#b1').val(b1);
					$('#b2').val(b2);
					$('#b3').val(b3);
					var h1 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					var h2 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					var h3 = randomNumberFromRange(100.0, 100.0).toFixed(1);
					$('#h1').val(h1);
					$('#h2').val(h2);
					$('#h3').val(h3);
				}
				
				
				if(f_con=="a_200")
				{
					var cross_2 = randomNumberFromRange(205.0, 245.0).toFixed(0);
					var cross_3 = randomNumberFromRange(205.0, 245.0).toFixed(0);
					var cross_1 = randomNumberFromRange(205.0, 245.0).toFixed(0);
					$('#cross_1').val(cross_1);
					$('#cross_2').val(cross_2);
					$('#cross_3').val(cross_3);
					
					var com1 = $('#comp_1').val();
					var com2 = $('#comp_2').val();
					var com3 = $('#comp_3').val();
					
					var load_1 = ((+5.625)*(+com1));
					var load_2 = ((+5.625)*(+com2));
					var load_3 = ((+5.625)*(+com3));
					
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));				
					$('#load_3').val(load_3.toFixed(1));
					var load1 = $('#load_1').val();
					var load2 = $('#load_2').val();
					var load3 = $('#load_3').val();
					
					var c_om1 = (+load1)/5.625;
					var c_om2 = (+load2)/5.625;
					var c_om3 = (+load3)/5.625;
					
					$('#comp_1').val(c_om1.toFixed(2));
					$('#comp_2').val(c_om2.toFixed(2));
					$('#comp_3').val(c_om3.toFixed(2));
					
					var co1 = $('#comp_1').val();
					var co2 = $('#comp_2').val();
					var co3 = $('#comp_3').val();
					
					var avg  = ((+co1) + (+co2) + (+co3)) / 3;
					$('#avg_com_s_1').val(avg.toFixed(2));	
					
					
				}
				else if(f_con=="a_133")
				{
					var cross_1 = randomNumberFromRange(135.0, 160.0).toFixed(0);
					var cross_2 = randomNumberFromRange(135.0, 160.0).toFixed(0);
					var cross_3 = randomNumberFromRange(135.0, 160.0).toFixed(0);
					$('#cross_1').val(cross_1);
					$('#cross_2').val(cross_2);
					$('#cross_3').val(cross_3);
					
					var com1 = $('#comp_1').val();
					var com2 = $('#comp_2').val();
					var com3 = $('#comp_3').val();
					
					var load_1 = ((+2.5)*(+com1));
					var load_2 = ((+2.5)*(+com2));
					var load_3 = ((+2.5)*(+com3));
					
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));				
					$('#load_3').val(load_3.toFixed(1));
					var load1 = $('#load_1').val();
					var load2 = $('#load_2').val();
					var load3 = $('#load_3').val();
					
					var c_om1 = (+load1)/2.5;
					var c_om2 = (+load2)/2.5;
					var c_om3 = (+load3)/2.5;
					
					$('#comp_1').val(c_om1.toFixed(2));
					$('#comp_2').val(c_om2.toFixed(2));
					$('#comp_3').val(c_om3.toFixed(2));
					
					var co1 = $('#comp_1').val();
					var co2 = $('#comp_2').val();
					var co3 = $('#comp_3').val();
					
					var avg  = ((+co1) + (+co2) + (+co3)) / 3;
					$('#avg_com_s_1').val(avg.toFixed(2));
				}
				else if(f_con=="200_a")
				{
					var cross_2 = randomNumberFromRange(170.0, 198.0).toFixed(0);
					var cross_3 = randomNumberFromRange(170.0, 198.0).toFixed(0);
					var cross_1 = randomNumberFromRange(170.0, 198.0).toFixed(0);
					$('#cross_1').val(cross_1);
					$('#cross_2').val(cross_2);
					$('#cross_3').val(cross_3);
					
					var a1 = $('#cross_1').val();
					var a2 = $('#cross_2').val();
					var a3 = $('#cross_3').val();
					
					var com1 = $('#comp_1').val();
					var com2 = $('#comp_2').val();
					var com3 = $('#comp_3').val();
					
					var load_1 = (((+1125)/(+a1))*(+com1));
					var load_2 = (((+1125)/(+a2))*(+com2));
					var load_3 = (((+1125)/(+a3))*(+com3));
					
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));				
					$('#load_3').val(load_3.toFixed(1));
					var load1 = $('#load_1').val();
					var load2 = $('#load_2').val();
					var load3 = $('#load_3').val();
					
					var c_om1 = ((+load1)*(+a1))/1125;
					var c_om2 = ((+load2)*(+a2))/1125;
					var c_om3 = ((+load3)*(+a3))/1125;
					
					$('#comp_1').val(c_om1.toFixed(2));
					$('#comp_2').val(c_om2.toFixed(2));
					$('#comp_3').val(c_om3.toFixed(2));
					
					var co1 = $('#comp_1').val();
					var co2 = $('#comp_2').val();
					var co3 = $('#comp_3').val();
					
					var avg  = ((+co1) + (+co2) + (+co3)) / 3;
					$('#avg_com_s_1').val(avg.toFixed(2));
					
				}
				else if(f_con=="133_a")
				{
					var cross_2 = randomNumberFromRange(110.0, 130.0).toFixed(0);
					var cross_3 = randomNumberFromRange(110.0, 130.0).toFixed(0);
					var cross_1 = randomNumberFromRange(110.0, 130.0).toFixed(0);
					$('#cross_1').val(cross_1);
					$('#cross_2').val(cross_2);
					$('#cross_3').val(cross_3);
					
					var a1 = $('#cross_1').val();
					var a2 = $('#cross_2').val();
					var a3 = $('#cross_3').val();
					
					var com1 = $('#comp_1').val();
					var com2 = $('#comp_2').val();
					var com3 = $('#comp_3').val();
					
					var load_1 = (((+333.33)/(+a1))*(+com1));
					var load_2 = (((+333.33)/(+a2))*(+com2));
					var load_3 = (((+333.33)/(+a3))*(+com3));
					
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));				
					$('#load_3').val(load_3.toFixed(1));
					var load1 = $('#load_1').val();
					var load2 = $('#load_2').val();
					var load3 = $('#load_3').val();
					
					var c_om1 = ((+load1)*(+a1))/333.33;
					var c_om2 = ((+load2)*(+a2))/333.33;
					var c_om3 = ((+load3)*(+a3))/333.33;
					
					$('#comp_1').val(c_om1.toFixed(2));
					$('#comp_2').val(c_om2.toFixed(2));
					$('#comp_3').val(c_om3.toFixed(2));
					
					var co1 = $('#comp_1').val();
					var co2 = $('#comp_2').val();
					var co3 = $('#comp_3').val();
					
					var avg  = ((+co1) + (+co2) + (+co3)) / 3;
					$('#avg_com_s_1').val(avg.toFixed(2));
				}
				
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
					
					
					
						var f_con = $('#f_con').val();
				if(f_con=="a_200")
				{
					var load_1 = ((+5.625)*(+comp_1));
					var load_2 = ((+5.625)*(+comp_2));
					var load_3 = ((+5.625)*(+comp_3));
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));
					$('#load_3').val(load_3.toFixed(1));
					var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3))/3;
					$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));	
					
					
				}
				else if(f_con=="a_133")
				{
					var load_1 = ((+2.5)*(+comp_1));
					var load_2 = ((+2.5)*(+comp_2));
					var load_3 = ((+2.5)*(+comp_3));
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));
					$('#load_3').val(load_3.toFixed(1));
					var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3))/3;
					$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
				}
				else if(f_con=="200_a")
				{
					var a1 = $('#cross_1').val();
					var a2 = $('#cross_2').val();						
					var a3 = $('#cross_3').val();
					var load_1 = (((+1125)/(+a1))*(+comp_1));
					var load_2 = (((+1125)/(+a2))*(+comp_2));
					var load_3 = (((+1125)/(+a3))*(+comp_3));
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));
					$('#load_3').val(load_3.toFixed(1));
					var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3))/3;
					$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
				}
				else if(f_con=="133_a")
				{
					var a1 = $('#cross_1').val();
					var a2 = $('#cross_2').val();						
					var a3 = $('#cross_3').val();
					var load_1 = (((+333.33)/(+a1))*(+comp_1));
					var load_2 = (((+333.33)/(+a2))*(+comp_2));
					var load_3 = (((+333.33)/(+a3))*(+comp_3));
					$('#load_1').val(load_1.toFixed(1));
					$('#load_2').val(load_2.toFixed(1));
					$('#load_3').val(load_3.toFixed(1));
					var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3))/3;
					$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
				}
				
				
						
		
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
	
	
	
	
	
	function load_set_1()
	{
														
						$('#txtdim').css("background-color","var(--success)"); 
						
						
						var f_con = $('#f_con').val();
				if(f_con=="a_200")
				{
					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();
					var comp_1 = ((+load_1)/(+5.625));
					var comp_2 = ((+load_2)/(+5.625));
					var comp_3 = ((+load_3)/(+5.625));
					$('#comp_1').val(comp_1.toFixed(2));
					$('#comp_2').val(comp_2.toFixed(2));
					$('#comp_3').val(comp_3.toFixed(2));
					var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3))/3;
					$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
					
					
				}
				else if(f_con=="a_133")
				{
					var load_1 = $('#load_1').val();
						var load_2 = $('#load_2').val();
						var load_3 = $('#load_3').val();
						var comp_1 = ((+load_1)/(+2.5));
						var comp_2 = ((+load_2)/(+2.5));
						var comp_3 = ((+load_3)/(+2.5));
						$('#comp_1').val(comp_1.toFixed(2));
						$('#comp_2').val(comp_2.toFixed(2));
						$('#comp_3').val(comp_3.toFixed(2));
						var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3))/3;
						$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
				}
				else if(f_con=="200_a")
				{
					var a1 = $('#cross_1').val();
					var a2 = $('#cross_2').val();						
					var a3 = $('#cross_3').val();
					
					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();
					var comp_1 = ((+load_1)*(+a1))/1125;
					var comp_2 = ((+load_2)*(+a2))/1125;
					var comp_3 = ((+load_3)*(+a3))/1125;
					$('#comp_1').val(comp_1.toFixed(2));
					$('#comp_2').val(comp_2.toFixed(2));
					$('#comp_3').val(comp_3.toFixed(2));
					var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3))/3;
					$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
				}
				else if(f_con=="133_a")
				{
					var a1 = $('#cross_1').val();
					var a2 = $('#cross_2').val();						
					var a3 = $('#cross_3').val();
					var load_1 = $('#load_1').val();
					var load_2 = $('#load_2').val();
					var load_3 = $('#load_3').val();
					var comp_1 = ((+load_1)*(+a1))/333.33;
					var comp_2 = ((+load_2)*(+a2))/333.33;
					var comp_3 = ((+load_3)*(+a3))/333.33;
					$('#comp_1').val(comp_1.toFixed(2));
					$('#comp_2').val(comp_2.toFixed(2));
					$('#comp_3').val(comp_3.toFixed(2));
					var avg_com_s_1 = ((+comp_1)+(+comp_2)+(+comp_3))/3;
					$('#avg_com_s_1').val(avg_com_s_1.toFixed(2));
				}
		
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
	
	
	
	$('#f_size').change(function(){
        var dt = $('#f_size').val(); 
		
		if(dt=="700,150,150")
		{
			
			 $('#133_a'). prop('disabled', true);
			 $('#a_133'). prop('disabled', true);
			 $('#200_a'). prop('disabled', false);
			 $('#a_200'). prop('disabled', false);
			
		}
		if(dt=="500,100,100")
		{
			
			 $('#200_a'). prop('disabled', true);
			 $('#a_200'). prop('disabled', true);
			 $('#133_a'). prop('disabled', false);
			 $('#a_133'). prop('disabled', false);
			
		}
		 
    });
	

	});
	
	

	

	



function randomNumberFromRange(min,max)
	{
		//return Math.floor(Math.random()*(max-min+1)+min);
		return Math.random() * (max - min) + min;
	}

$("#btn_save").click(function(){
			$('#btn_save').hide();

	});
	
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
        url: '<?php echo $base_url; ?>save_flexure.php',
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
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");

				//Compressive Strength
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flx")
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
						
						var wat_temp = $('#wat_temp').val();
						var mark_1 = $('#mark_1').val();
						var mark_2 = $('#mark_2').val();
						var mark_3 = $('#mark_3').val();
					
						var avg_com_s_1 = $('#avg_com_s_1').val();
						var remarks = $('#remarks').val();
						
						
						
						var top_casting_date = $('#top_casting_date').val();
						var top_days = $('#top_days').val();
						var top_grade = $('#top_grade').val();
						var top_no_of_cube = $('#top_no_of_cube').val();
						var top_remark = $('#top_remark').val();
						var top_set = $('#top_set').val();
						var f_con = $('#f_con').val();
						var f_size = $('#f_size').val();
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
						var wat_temp = "";
						var mark_1 = "";
						var mark_2 = "";
						var mark_3 = "";
						
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
						var remarks = "";
						var f_con = "";
						var f_size = "";
						
					}
														
				}
						
				
				
						billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_com='+chk_com+'&top_casting_date='+top_casting_date+'&top_days='+top_days+'&top_grade='+top_grade+'&top_no_of_cube='+top_no_of_cube+'&top_remark='+top_remark+'&top_set='+top_set+'&avg_com_s_1='+avg_com_s_1+'&comp_1='+comp_1+'&comp_2='+comp_2+'&comp_3='+comp_3+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&mass_1='+mass_1+'&mass_2='+mass_2+'&mass_3='+mass_3+'&cross_1='+cross_1+'&cross_2='+cross_2+'&cross_3='+cross_3+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&grade1='+grade1+'&day1='+day1+'&test_date1='+test_date1+'&caste_date1='+caste_date1+'&remarks='+remarks+'&ulr='+ulr+'&f_con='+f_con+'&wat_temp='+wat_temp+'&mark_1='+mark_1+'&mark_2='+mark_2+'&mark_3='+mark_3+'&f_size='+f_size +'&amend_date=' + amend_date;
					
					
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				var amend_date = $('#amend_date').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");

				//Compressive Strength
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flx")
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
						var remarks = $('#remarks').val();										
						var top_casting_date = $('#top_casting_date').val();
						var top_days = $('#top_days').val();
						var top_grade = $('#top_grade').val();
						var top_no_of_cube = $('#top_no_of_cube').val();
						var top_remark = $('#top_remark').val();
						var top_set = $('#top_set').val();
						var f_con = $('#f_con').val();
						var f_size = $('#f_size').val();
						var wat_temp = $('#wat_temp').val();
						var mark_1 = $('#mark_1').val();
						var mark_2 = $('#mark_2').val();
						var mark_3 = $('#mark_3').val();
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
						var remarks = "";	
						var f_con = "";
						var f_size = "";
						var wat_temp = "";
						var mark_1 = "";
						var mark_2 = "";
						var mark_3 = "";
					}
														
				}
																
				var idEdit = $('#idEdit').val(); 
		
				billData =  $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_com='+chk_com+'&top_casting_date='+top_casting_date+'&top_days='+top_days+'&top_grade='+top_grade+'&top_no_of_cube='+top_no_of_cube+'&top_remark='+top_remark+'&top_set='+top_set+'&avg_com_s_1='+avg_com_s_1+'&comp_1='+comp_1+'&comp_2='+comp_2+'&comp_3='+comp_3+'&load_1='+load_1+'&load_2='+load_2+'&load_3='+load_3+'&mass_1='+mass_1+'&mass_2='+mass_2+'&mass_3='+mass_3+'&cross_1='+cross_1+'&cross_2='+cross_2+'&cross_3='+cross_3+'&h1='+h1+'&h2='+h2+'&h3='+h3+'&b1='+b1+'&b2='+b2+'&b3='+b3+'&l1='+l1+'&l2='+l2+'&l3='+l3+'&grade1='+grade1+'&day1='+day1+'&test_date1='+test_date1+'&caste_date1='+caste_date1+'&remarks='+remarks+'&wat_temp='+wat_temp+'&mark_1='+mark_1+'&mark_2='+mark_2+'&mark_3='+mark_3+'&ulr='+ulr+'&f_con='+f_con+'&f_size='+f_size+'&amend_date='+amend_date;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_flexure.php',
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
			url: '<?php echo $base_url; ?>save_flexure.php',
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
        url: '<?php echo $base_url; ?>save_flexure.php',
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
            $('#amend_date').val(data.amend_date);
			
            var temp = $('#test_list').val();
           
			var aa= temp.split(",");				
				//DIMENSION
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="flx")
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
							  $('#remarks').val(data.remarks);
							  $('#wat_temp').val(data.wat_temp);
							  $('#mark_1').val(data.mark_1);
							  $('#mark_2').val(data.mark_2);
							  $('#mark_3').val(data.mark_3);
						
						
						 $('#top_casting_date').val(data.top_casting_date);
						 $('#top_days').val(data.top_days);
						 $('#top_grade').val(data.top_grade);
						 $('#top_no_of_cube').val(data.top_no_of_cube);
						 $('#top_remark').val(data.top_remark);
						 $('#top_set').val(data.top_set);					
						 $('#f_con').val(data.f_con);					
						 $('#f_size').val(data.f_size);					
					}
				}
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}



</script>


