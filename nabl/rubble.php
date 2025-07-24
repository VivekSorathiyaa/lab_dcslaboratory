 
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
			
		}if(isset($_GET['ulr'])){
			$ulr=$_GET['ulr'];
			
			
		}
		
		 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$mark= $row_select4['mark'];
					$speci= $row_select4['brick_specification'];
				}
		
?>
<div class="content-wrapper" style="margin-left:0px !important;">
	
	<section class="content">
		<?php include("menu.php") ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h2 style="text-align:center;">RUBBLE</h2>
						<input type="hidden" class="form-control inputs" tabindex="4" id="speci" value="<?php echo $speci;?>" name="speci">
					</div>
					<div class="box-default">
					<form class="form" id="Glazed" method="post">
						<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">
								<br>
								<div class="col-lg-6">
									<div class="form-group">
									
									<!--  <label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->

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
										 

										  <div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
										  </div>
										</div>
									</div>
									
								</div>
								
								
								<hr>
								<br>
  <div class="panel-group" id="accordion">
  <?php 
  $is_upload = "select * from span_material_assign WHERE `excel_upload`='y' and `trf_no`='$trf_no' and `job_number`='$job_no' and isdeleted='0'"; 
  
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
    
	<?php	} ?>	 
   

				
	<!-- TEST WISE LOGIC VAIBHAV-->
  <?php
	$test_check;
	$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
		$result_select1 = mysqli_query($conn, $select_query1);
		while($r1 = mysqli_fetch_array($result_select1)){
			
			if($r1['test_code']=="wtr")
			{
				$test_check.="wtr,";
			?>
			<div class="panel panel-default" id="wtr">
		<div class="panel-heading" id="txtwtr">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
					<h4 class="panel-title">
						<b>SPECIFIC GRAVITY & WATER ABSORPTION</b>
					</h4>
				</a>
			</h4>
		</div>
		<div id="collapse3" class="panel-collapse collapse">
						<div class="panel-body">
								<div class="row">									
									
									<div class="col-lg-8">
										<div class="form-group">
												<div class="col-sm-2">
													<label for="chk_sp">2/3.</label>
													<input type="checkbox" class="visually-hidden" name="chk_sp"  id="chk_sp" value="chk_sp"><br>
												</div>
											<label for="inputEmail3" class="col-sm-10 control-label label-right">SPECIFIC GRAVITY & WATER ABSORPTION</label>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
												<div class="col-sm-8">
													<input type="hidden" class="form-control" id="sp_temp" name="sp_temp" ><br>
												</div>
										</div>
									</div>
									
								</div>
								<div class="row">
									
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Wt. of Saturated Surface Dry (g) A</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Wt. of Oven Dry (g) B</label>
									</div>
									</div>
									
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Wt. of Sample in Water (g) C</label>
									</div>
									</div>
									
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Specific Gravity G=(B)/(A-C)</label>
									</div>
									</div>
									
									<div class="col-lg-1">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-12 control-label">Water Absorption =100 X (A-B)/B</label>
									</div>
									</div>
											
								</div>
								<br>
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 1-->
								<div class="row">
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_wt_st_1" name="sp_wt_st_1" >
									  </div>
									</div>
									</div>				
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_s_1" name="sp_w_s_1">
									  </div>									
								     </div>
									</div>								
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_sur_1" name="sp_w_sur_1" >
									  </div>
									</div>
									</div>													
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="sp_specific_gravity_1" name="sp_specific_gravity_1" readonly>
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="sp_water_abr_1" name="sp_water_abr_1" readonly>
									</div>
								    </div>
								</div>
							</div>
							<br>						
							<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE SR 2-->
								<div class="row">
									
									
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_wt_st_2" name="sp_wt_st_2"  >
									  </div>
									</div>
									</div>
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_s_2" name="sp_w_s_2">
									  </div>									
								     </div>
									</div>										
									<div class="col-lg-2">
									<div class="form-group">
									  <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_w_sur_2" name="sp_w_sur_2" >
									  </div>
									</div>
									</div>													
																
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="sp_specific_gravity_2" name="sp_specific_gravity_2" readonly>
									</div>
								    </div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
									<div class="col-sm-12">	
										<input type="text" class="form-control" id="sp_water_abr_2" name="sp_water_abr_2" readonly>
									</div>
								    </div>
								</div>
							</div>
								<br>
								<div class="row">
									<div class="col-lg-2">
									<div class="form-group">
									  
									</div>
									</div>	
									<div class="col-lg-2">
									<div class="col-sm-12">
										<input type="hidden" class="form-control" id="sp_sample_ca" name="sp_sample_ca" >
									  </div>
									</div>	
									<div class="col-lg-2">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-6 control-label">AVERAGE :</label>
									</div>
									</div>
									<div class="col-sm-1">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_specific_gravity" name="sp_specific_gravity" >
									  </div>
									</div>
									</div>																										
									<div class="col-sm-1">
									<div class="form-group">
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="sp_water_abr" name="sp_water_abr" >
									  </div>
									</div>
									</div>																										
								</div>
								
								<!--SPECIFIC GRAVITY & WATER ABSORPTION VALUE OVER-->
						
						
						</div>
				  </div>
	</div>
		

			
		<?php }
		}?>	
	
</div>	
<hr>
<br>
									<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											
											<div class="col-sm-2">
												<!-- SAVE BUTTON LOGIC VAIBHAV-->
												<?php   
													$querys_job1 = "SELECT * FROM rubble WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
											<div class="col-sm-2">
												<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="idEdit" id="idEdit"/>

											</div>
											<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
											<?php
											// $val =  $_SESSION['isadmin'];
											// if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
											?>
											<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_rubble.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
 
											</div>
											<!--<div class="col-sm-2">
												<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_rubble.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

											</div-->
											<?php// } ?>
											
										</div>
									</div>
								</div>
								<br>
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
							 $query = "select * from rubble WHERE lab_no='$aa'  and `is_deleted`='0'";

								$result = mysqli_query($conn, $query);
			

								if (mysqli_num_rows($result) > 0) {
							while($r = mysqli_fetch_array($result)){
					
										if($r['is_deleted'] == 0){
										?>
										<tr>
										<td style="text-align:center;" width="10%">	
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
										<?php
											//$val =  $_SESSION['isadmin'];
											//if($val == 0 || $val == 5){
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
  $(function () {
    $('.select2').select2();
  })
  $('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });
$(document).ready(function(){ 
	$('#btn_edit_data').hide();
	$('#alert').hide();
	
	
	
	function sp_auto()
	{
		$('#txtwtr').css("background-color","var(--success)");
			var sp_specific_gravity = randomNumberFromRange(2.830,2.855).toFixed(3);  //(sp_specific_gravity)
			var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.010,0.010); //(sp_specific_gravity_1)_1
			 var tems1 = (parseFloat(sp_specific_gravity) * 2);
			var sp_specific_gravity_2 = (parseFloat(tems1)-parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
			var sp_water_abr = randomNumberFromRange(0.85,0.90).toFixed(2);// (sp_water_abr)_1
			var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.02,0.02)////(sp_water_abr_1)_1
			 var tems11 = (parseFloat(sp_water_abr) * 2);
			var sp_water_abr_2 = (parseFloat(tems11)-parseFloat(sp_water_abr_1));// (sp_water_abr_2)_1 
			
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 4));				
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 4));				
			$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 4));				
			$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));	
			$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));	
			$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
			$('#sp_wt_st_1').val(2000);				
			$('#sp_wt_st_2').val(2000);				
			
			var a1 = $('#sp_wt_st_1').val();
			var a2 = $('#sp_wt_st_2').val();
			var g1 = $('#sp_specific_gravity_1').val();
			var g2 = $('#sp_specific_gravity_2').val();
			var wtr1 = $('#sp_water_abr_1').val();
			var wtr2 = $('#sp_water_abr_2').val();
			var equp1  = a1 * 100;
			var equp2  = a2 * 100;
			var eqdn1  = (+wtr1) + 100;
			var eqdn2  = (+wtr2) + 100;
			var sp_w_s_1 = equp1 / eqdn1;
			var sp_w_s_2 = equp2 / eqdn2;
			$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));	
			$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));				
			var b1 = $('#sp_w_s_1').val();
			var b2 = $('#sp_w_s_2').val();
			var sp_w_sur_1 = (+a1) - ((+b1) / (+g1));
			var sp_w_sur_2 = (+a2) - ((+b2) / (+g2));						
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));					
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
			$('#sp_sample_ca').val(sp_sample_ca);
	}
	//SPECIFIC GRAVITY
	$('#chk_sp').change(function(){
        if(this.checked)
		{  
			sp_auto();
			
		}
		else
		{
			$('#txtwtr').css("background-color","white");
			$('#sp_w_sur_1').val(null);
			$('#sp_w_s_1').val(null);
			$('#sp_wt_st_1').val(null);
			
			
			$('#sp_w_sur_2').val(null);
			$('#sp_w_s_2').val(null);
			$('#sp_wt_st_2').val(null);
								
			$('#sp_specific_gravity_1').val(null);
			$('#sp_specific_gravity_2').val(null);
			$('#sp_specific_gravity').val(null);
			$('#sp_water_abr_1').val(null);
			$('#sp_water_abr_2').val(null);
			$('#sp_water_abr').val(null);
			$('#sp_sample_ca').val(null);
		}
	});

	$('#sp_specific_gravity').change(function(){
		
			$('#txtwtr').css("background-color","var(--success)");
			if ($("#chk_sp").is(':checked')) {
			var sp_temp = randomNumberFromRange(25.0,27.0);			
			$('#sp_temp').val(sp_temp.toString().substring(0, sp_temp.toString().indexOf(".") + 2));
			var sp_specific_gravity = $("#sp_specific_gravity").val();  //(sp_specific_gravity)
			var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.010,0.010); //(sp_specific_gravity_1)_1
			 var tems1 = (parseFloat(sp_specific_gravity) * 2);
			var sp_specific_gravity_2 = (parseFloat(tems1)-parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
			var sp_water_abr = randomNumberFromRange(0.85,0.90).toFixed(2);// (sp_water_abr)_1
			var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.02,0.02)////(sp_water_abr_1)_1
			 var tems11 = (parseFloat(sp_water_abr) * 2);
			var sp_water_abr_2 = (parseFloat(tems11)-parseFloat(sp_water_abr_1));// (sp_water_abr_2)_1 
			
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 4));				
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 4));								
			$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));	
			$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));	
			$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
			$('#sp_wt_st_1').val(2000);				
			$('#sp_wt_st_2').val(2000);				
			
			var a1 = $('#sp_wt_st_1').val();
			var a2 = $('#sp_wt_st_2').val();
			var g1 = $('#sp_specific_gravity_1').val();
			var g2 = $('#sp_specific_gravity_2').val();
			var wtr1 = $('#sp_water_abr_1').val();
			var wtr2 = $('#sp_water_abr_2').val();
			var equp1  = a1 * 100;
			var equp2  = a2 * 100;
			var eqdn1  = (+wtr1) + 100;
			var eqdn2  = (+wtr2) + 100;
			var sp_w_s_1 = equp1 / eqdn1;
			var sp_w_s_2 = equp2 / eqdn2;
			$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));	
			$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));				
			var b1 = $('#sp_w_s_1').val();
			var b2 = $('#sp_w_s_2').val();
			var sp_w_sur_1 = (+a1) - ((+b1) / (+g1));
			var sp_w_sur_2 = (+a2) - ((+b2) / (+g2));						
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));					
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
			}
			
		
	});

	$('#sp_water_abr').change(function(){			
			$('#txtwtr').css("background-color","var(--success)");
			if ($("#chk_sp").is(':checked')) {
			var sp_temp = randomNumberFromRange(25.0,27.0);			
			$('#sp_temp').val(sp_temp.toString().substring(0, sp_temp.toString().indexOf(".") + 2));
			var sp_specific_gravity = $("#sp_specific_gravity").val();  //(sp_specific_gravity)
			var sp_specific_gravity_1 = parseFloat(sp_specific_gravity) + randomNumberFromRange(-0.010,0.010); //(sp_specific_gravity_1)_1
			 var tems1 = (parseFloat(sp_specific_gravity) * 2);
			var sp_specific_gravity_2 = (parseFloat(tems1)-parseFloat(sp_specific_gravity_1)); //(sp_specific_gravity_2)_2
			var sp_water_abr = $("#sp_water_abr").val();// (sp_water_abr)_1
			var sp_water_abr_1 = parseFloat(sp_water_abr) + randomNumberFromRange(-0.02,0.02)////(sp_water_abr_1)_1
			 var tems11 = (parseFloat(sp_water_abr) * 2);
			var sp_water_abr_2 = (parseFloat(tems11)-parseFloat(sp_water_abr_1));// (sp_water_abr_2)_1 
			
			$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 4));				
			$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 4));								
			$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));	
			$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));	
			
			$('#sp_wt_st_1').val(2000);				
			$('#sp_wt_st_2').val(2000);				
			
			var a1 = $('#sp_wt_st_1').val();
			var a2 = $('#sp_wt_st_2').val();
			var g1 = $('#sp_specific_gravity_1').val();
			var g2 = $('#sp_specific_gravity_2').val();
			var wtr1 = $('#sp_water_abr_1').val();
			var wtr2 = $('#sp_water_abr_2').val();
			var equp1  = a1 * 100;
			var equp2  = a2 * 100;
			var eqdn1  = (+wtr1) + 100;
			var eqdn2  = (+wtr2) + 100;
			var sp_w_s_1 = equp1 / eqdn1;
			var sp_w_s_2 = equp2 / eqdn2;
			$('#sp_w_s_1').val(sp_w_s_1.toString().substring(0, sp_w_s_1.toString().indexOf(".") + 2));	
			$('#sp_w_s_2').val(sp_w_s_2.toString().substring(0, sp_w_s_2.toString().indexOf(".") + 2));				
			var b1 = $('#sp_w_s_1').val();
			var b2 = $('#sp_w_s_2').val();
			var sp_w_sur_1 = (+a1) - ((+b1) / (+g1));
			var sp_w_sur_2 = (+a2) - ((+b2) / (+g2));						
			$('#sp_w_sur_1').val(sp_w_sur_1.toFixed(1));					
			$('#sp_w_sur_2').val(sp_w_sur_2.toFixed(1));
			}
			
	});

	
	$("#sp_w_sur_1").change(function(){
		$('#txtwtr').css("background-color","var(--success)");
		var sp_w_sur_1 = $('#sp_w_sur_1').val();
		sp_wt_st_1 = $('#sp_wt_st_1').val();
		var sp_w_s_1 = $('#sp_w_s_1').val();
		sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_wt_st_1)-parseFloat(sp_w_sur_1));
		$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 4));
		sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 4));
		sp_water_abr_1 = (100*(parseFloat(sp_w_sur_1)-parseFloat(sp_w_s_1)))/parseFloat(sp_w_s_1);
		$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));
		sp_water_abr_2 = $('#sp_water_abr_2').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
	});
	
	$("#sp_w_sur_2").change(function(){
		$('#txtwtr').css("background-color","var(--success)");
		var sp_w_sur_2 = $('#sp_w_sur_2').val();
		sp_wt_st_2 = $('#sp_wt_st_2').val();
		var sp_w_s_2 = $('#sp_w_s_2').val();
		sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_w_sur_1)-parseFloat(sp_w_sur_2));
		$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 4));
		sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 4));
		
		sp_water_abr_2 = (100*(parseFloat(sp_w_sur_2)-parseFloat(sp_w_s_2)))/parseFloat(sp_w_s_2);
		$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));
		sp_water_abr_1 = $('#sp_water_abr_1').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
	});
	$("#sp_w_s_1").change(function(){
		$('#txtwtr').css("background-color","var(--success)");
		var sp_w_sur_1 = $('#sp_w_sur_1').val();
		sp_wt_st_1 = $('#sp_wt_st_1').val();
		var sp_w_s_1 = $('#sp_w_s_1').val();
		sp_specific_gravity_1 = parseFloat(sp_w_s_1)/(parseFloat(sp_wt_st_1)-parseFloat(sp_w_sur_1));
		$('#sp_specific_gravity_1').val(sp_specific_gravity_1.toString().substring(0, sp_specific_gravity_1.toString().indexOf(".") + 4));
		sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 4));
		
		sp_water_abr_1 = (100*(parseFloat(sp_w_sur_1)-parseFloat(sp_w_s_1)))/parseFloat(sp_w_s_1);
		$('#sp_water_abr_1').val(sp_water_abr_1.toString().substring(0, sp_water_abr_1.toString().indexOf(".") + 3));
		sp_water_abr_2 = $('#sp_water_abr_2').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
	});
	$("#sp_w_s_2").change(function(){
		$('#txtwtr').css("background-color","var(--success)");
		var sp_w_sur_2 = $('#sp_w_sur_2').val();
		sp_wt_st_2 = $('#sp_wt_st_2').val();
		var sp_w_s_2 = $('#sp_w_s_2').val();
		sp_specific_gravity_2 = parseFloat(sp_w_s_2)/(parseFloat(sp_wt_st_2)-parseFloat(sp_w_sur_2));
		$('#sp_specific_gravity_2').val(sp_specific_gravity_2.toString().substring(0, sp_specific_gravity_2.toString().indexOf(".") + 4));
		sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
		var sp_specific_gravity=(parseFloat(sp_specific_gravity_1)+parseFloat(sp_specific_gravity_2))/2;
		$('#sp_specific_gravity').val(sp_specific_gravity.toString().substring(0, sp_specific_gravity.toString().indexOf(".") + 4));
		sp_water_abr_2 = (100*(parseFloat(sp_w_sur_2)-parseFloat(sp_w_s_2)))/parseFloat(sp_w_s_2);		
		$('#sp_water_abr_2').val(sp_water_abr_2.toString().substring(0, sp_water_abr_2.toString().indexOf(".") + 3));
		sp_water_abr_1 = $('#sp_water_abr_1').val();
		var sp_water_abr=(parseFloat(sp_water_abr_1)+parseFloat(sp_water_abr_2))/2;	
		$('#sp_water_abr').val(sp_water_abr.toString().substring(0, sp_water_abr.toString().indexOf(".") + 3));
	});
	
	
	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
				var temp = $('#test_list').val();
				var aa= temp.split(",");
				
				
				//wtr&sp
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{
						$('#txtwtr').css("background-color","var(--success)");
						$("#chk_sp").prop("checked", true); 
						sp_auto();
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
	});
function getGlazedTiles(){
				var lab_no = $('#lab_no').val(); 
				var report_no = $('#report_no').val(); 
				var job_no=$('#job_no').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_rubble.php',
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
				
				//SP AND WATER ABR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{	
						if(document.getElementById('chk_sp').checked) {
							var chk_sp = "1";
						}
						else{
							var chk_sp = "0";
						}					
						//specific gravity and water abrasion-5							
						var sp_w_sur_1 = $('#sp_w_sur_1').val();						
						var sp_w_sur_2 = $('#sp_w_sur_2').val();						
						var sp_w_s_1 = $('#sp_w_s_1').val();														
						var sp_w_s_2 = $('#sp_w_s_2').val();				
						var sp_wt_st_1 = $('#sp_wt_st_1').val();				
						var sp_wt_st_2 = $('#sp_wt_st_2').val();				
						var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
						var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
						var sp_specific_gravity = $('#sp_specific_gravity').val();
						var sp_water_abr = $('#sp_water_abr').val(); 
						var sp_water_abr_1 = $('#sp_water_abr_1').val();
						var sp_water_abr_2 = $('#sp_water_abr_2').val();
						
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp_w_sur_1 ="0";
						var sp_w_s_1 ="0";
						var sp_wt_st_1 ="0";						
						var sp_w_sur_2 ="0";
						var sp_w_s_2 ="0";
						var sp_wt_st_2 ="0";										
						var sp_specific_gravity_1 ="0";
						var sp_specific_gravity_2 ="0";
						var sp_specific_gravity ="0";
						var sp_water_abr_1 ="0";
						var sp_water_abr_2 ="0";
						var sp_water_abr ="0";
						
					}
				
				}
					
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_sp='+chk_sp+'&sp_w_sur_1='+sp_w_sur_1+'&sp_w_sur_2='+sp_w_sur_2+'&sp_w_s_1='+sp_w_s_1+'&sp_w_s_2='+sp_w_s_2+'&sp_wt_st_1='+sp_wt_st_1+'&sp_wt_st_2='+sp_wt_st_2+'&sp_specific_gravity='+sp_specific_gravity+'&sp_specific_gravity_1='+sp_specific_gravity_1+'&sp_specific_gravity_2='+sp_specific_gravity_2+'&sp_water_abr='+sp_water_abr+'&sp_water_abr_1='+sp_water_abr_1+'&sp_water_abr_2='+sp_water_abr_2+'&ulr='+ulr+'&amend_date='+amend_date;
				
				
				
	}
	else if (type == 'edit'){
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				var amend_date = $('#amend_date').val();
				
				var temp = $('#test_list').val();
				var aa= temp.split(",");	
				
				//SP AND WATER ABR
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{	
						if(document.getElementById('chk_sp').checked) {
							var chk_sp = "1";
						}
						else{
							var chk_sp = "0";
						}					
						//specific gravity and water abrasion-5							
						var sp_w_sur_1 = $('#sp_w_sur_1').val();						
						var sp_w_sur_2 = $('#sp_w_sur_2').val();						
						var sp_w_s_1 = $('#sp_w_s_1').val();														
						var sp_w_s_2 = $('#sp_w_s_2').val();				
						var sp_wt_st_1 = $('#sp_wt_st_1').val();				
						var sp_wt_st_2 = $('#sp_wt_st_2').val();				
						var sp_specific_gravity_1 = $('#sp_specific_gravity_1').val();
						var sp_specific_gravity_2 = $('#sp_specific_gravity_2').val();
						var sp_specific_gravity = $('#sp_specific_gravity').val();
						var sp_water_abr = $('#sp_water_abr').val(); 
						var sp_water_abr_1 = $('#sp_water_abr_1').val();
						var sp_water_abr_2 = $('#sp_water_abr_2').val();
						
						break;
					}
					else
					{
						var chk_sp = "0";
						var sp_w_sur_1 ="0";
						var sp_w_s_1 ="0";
						var sp_wt_st_1 ="0";						
						var sp_w_sur_2 ="0";
						var sp_w_s_2 ="0";
						var sp_wt_st_2 ="0";										
						var sp_specific_gravity_1 ="0";
						var sp_specific_gravity_2 ="0";
						var sp_specific_gravity ="0";
						var sp_water_abr_1 ="0";
						var sp_water_abr_2 ="0";
						var sp_water_abr ="0";
						
					}
				
				}
				
				
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_sp='+chk_sp+'&sp_w_sur_1='+sp_w_sur_1+'&sp_w_sur_2='+sp_w_sur_2+'&sp_w_s_1='+sp_w_s_1+'&sp_w_s_2='+sp_w_s_2+'&sp_wt_st_1='+sp_wt_st_1+'&sp_wt_st_2='+sp_wt_st_2+'&sp_specific_gravity='+sp_specific_gravity+'&sp_specific_gravity_1='+sp_specific_gravity_1+'&sp_specific_gravity_2='+sp_specific_gravity_2+'&sp_water_abr='+sp_water_abr+'&sp_water_abr_1='+sp_water_abr_1+'&sp_water_abr_2='+sp_water_abr_2+'&ulr='+ulr+'&amend_date='+amend_date;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_rubble.php',
        data: billData,
		dataType: 'JSON',
        success:function(msg){
				$('#btn_save').hide();
				getGlazedTiles();
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val();
			//	window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;
	
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
        url: '<?php echo $base_url; ?>save_rubble.php',
        data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
	
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#amend_date').val(data.amend_date);
			
            var temp = $('#test_list').val();
				var aa= temp.split(",");				
				//sp and water
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="wtr")
					{	var chk_sp = data.chk_sp;
							if(chk_sp=="1")
							{
								$('#txtwtr').css("background-color","var(--success)");	
							   $("#chk_sp").prop("checked", true); 
							}else{
								$('#txtwtr').css("background-color","white");	
								$("#chk_sp").prop("checked", false); 
							}
						//specific gravity and water abr
						$('#sp_w_sur_1').val(data.sp_w_sur_1);
						$('#sp_w_sur_2').val(data.sp_w_sur_2);	
						$('#sp_w_s_1').val(data.sp_w_s_1);
						$('#sp_w_s_2').val(data.sp_w_s_2);		
						$('#sp_wt_st_1').val(data.sp_wt_st_1);
						$('#sp_wt_st_2').val(data.sp_wt_st_2);								
						$('#sp_specific_gravity_1').val(data.sp_specific_gravity_1);
						$('#sp_specific_gravity_2').val(data.sp_specific_gravity_2);										
						$('#sp_specific_gravity').val(data.sp_specific_gravity);										
						$('#sp_water_abr').val(data.sp_water_abr);										
						$('#sp_water_abr_1').val(data.sp_water_abr_1);										
						$('#sp_water_abr_2').val(data.sp_water_abr_2);
						
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


