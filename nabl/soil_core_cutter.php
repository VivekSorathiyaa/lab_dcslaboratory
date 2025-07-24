<?php 
session_start(); 
include("header.php");
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
					$chain= $row_select4['chainage_no'];
					
				}
		
		
?>
	<!-- STYLE PUT VAIBHAV-->
	<div class="content-wrapper" style="margin-left:0px !important;">
	<!-- Content Header (Page header) -->
		<section class="content">
		<!-- MENU INCLUDE VAIBHAV-->
		<?php include("menu.php") ?>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h2  style="text-align:center;">CORE CUTTER</h2>
						</div>
						<!--<div class="box-default">-->
						<form class="form" id="Glazed" method="post">
							<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->
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
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
										<div class="col-sm-10">
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
											<!--<button type="button" class="btn btn-info pull-right" id="btn_auto" name="btn_auto" tabindex="14" >Auto</button>-->
											<!-- HIDDEN FIELD VAIBHAV-->
											<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="id" id="idEdit"/>
										</div>
										<div class="col-sm-2">
											<!-- SAVE BUTTON LOGIC VAIBHAV-->
											<?php   
												$querys_job1 = "SELECT * FROM core_cutter WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_core_cutter.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>
										
										
										<?php// } ?>
										<div class="col-sm-2">
											
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_core_cutter.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Report</b></a>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<br>	
							<div class="panel-group" id="accordion">
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
							
							<?php
							$test_check;
							$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
								$result_select1 = mysqli_query($conn, $select_query1);
								while($r1 = mysqli_fetch_array($result_select1)){
									
									if($r1['test_code']=="cor")
									{
										$test_check.="cor,";
									?>
								
								<div class="panel panel-default" id="den">
									<div class="panel-heading" id="txtden">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
												<h4 class="panel-title">
												<b>FIELD DRY DENSITY BY CORE CUTTER</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse2" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_den">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_den"  id="chk_den" value="chk_den"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">FIELD DRY DENSITY BY CORE CUTTER</label>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">MDD OF MATERIAL</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="field_mdd" name="field_mdd">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Chainage No.</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="chainage_no" name="chainage_no" readonly value="<?php echo $chain;?>">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Wt. of Empty Core Cutter (gm) (W<sub>1</sub>)</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="empty_core" name="empty_core">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Vol. of Core Cutter (cc) (V)</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="vol_core" name="vol_core" value="1020.5">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Wt. of Soil + Core Cutter (gm) (W<sub>2</sub>)</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="soil_core" name="soil_core">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Wt. of Wet Soil (gm) (W<sub>3</sub>) = (W<sub>2</sub>) - (W<sub>1</sub>)</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wet_soil_core" name="wet_soil_core">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Wet Density (gm/cc) W<sub>4</sub> - W<sub>3</sub> / V</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_1" name="fdd_1">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Moisture Content in Soil From Moisture Meter (%)<input type="radio" id="mo_meter" name="mo_meter" value="mo_meter"/></label>
															
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="mc_soil" name="mc_soil">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Container No.<input type="radio" id="mo_meter" name="mo_meter" value="mo_con" checked/></label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="con_no" name="con_no">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Container Empty wt. (gm)</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="con_weight" name="con_weight">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Wt. of Container + Wet Soil (gm)</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wt_con_wt_soil" name="wt_con_wt_soil">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Wt. of Container + Dry Soil (gm)</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="wt_con_dry_soil" name="wt_con_dry_soil">
																	</div>
															
														</div>
													</div>
												</div>
											<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Moisture Content in Soil from Oven Dry (%)</label>
															<input type="hidden" style="text-align:center;" class="form-control inputs" tabindex="4" id="xy" name="xy">
															<input type="hidden" style="text-align:center;" class="form-control inputs" tabindex="4" id="xans" name="xans">
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_2" name="fdd_2">
																	</div>
															
														</div>
													</div>
												</div>	
											
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Field Dry Density (gm/cc) D<sub>Dry</sub> = W<sub>4</sub> / ( 1 + (w/100))</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_3" name="fdd_3">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-6">
															<label for="inputEmail3" class="control-label" style="text-align:left;">Compaction (%) = (D<sub>Dry</sub>/ MDD) x 100</label>	
															</div>
															<div class="col-md-6"> 
																		<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="fdd_4" name="fdd_4">
																	</div>
															
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
								<?php }
		}?>	
			
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
							 $query = "select * from core_cutter WHERE lab_no='$aa'  and `is_deleted`='0'";

								$result = mysqli_query($conn, $query);
			
								$cnt=0;
								$detail=0;
								if (mysqli_num_rows($result) > 0) {
							while($r = mysqli_fetch_array($result)){										
										if($r['is_deleted'] == 0){
										?>
										<tr>
																				
										<td style="text-align:center;" width="10%">	
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
										
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
		$("#btn_upload_excel").click(function()
		{
			form_data = new FormData();
				var acb = $('#upload_excel').val();
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
	
$(document).ready(function(){ 
			   
	$('#btn_edit_data').hide();
	$('#alert').hide();
	var method="mo_con";
	/* var conno = randomNumberFromRange(1,321).toFixed();			
	$('#con_no').val(conno);			
	var con_no = $('#con_no').val();			
	getWeight(con_no); */
	function auto()
	{	
		var conweight="";
		if(method == "mo_con")
		{
			
			var fdd4 = randomNumberFromRange(95.10,99.85).toFixed(2);
			$('#fdd_4').val(fdd4);
			var fdd_4 = $('#fdd_4').val();
			
			var fieldmdd = randomNumberFromRange(1.74,1.79).toFixed(3);
			$('#field_mdd').val(fieldmdd);
			var field_mdd = $('#field_mdd').val();
			
			var fdd3 = ((+fdd_4) / 100) * (+field_mdd);
			$('#fdd_3').val(fdd3.toFixed(3));
			var fdd_3 = $('#fdd_3').val();
			
			var fdd2 = randomNumberFromRange(11.8,14.5).toFixed(2);
			$('#fdd_2').val(fdd2);
			var fdd_2 = $('#fdd_2').val();
			
			var x_y = randomNumberFromRange(32,40).toFixed();
			$('#xy').val(x_y);
			var xy = $('#xy').val();
			var xx = ((+fdd_2) / (+100)) * (+xy);
			$('#xans').val(xx.toFixed(2));
			var xans = $('#xans').val();
			
			
			
			var conweight = $('#con_weight').val();
			
			var wt_con_drysoil = (+conweight) + (+xy);
			$('#wt_con_dry_soil').val(wt_con_drysoil.toFixed(2));			
			var wt_con_dry_soil = $('#wt_con_dry_soil').val();
			
			var fdd1 = (((+100) + (+fdd_2)) * (+fdd_3))/100;
			$('#fdd_1').val(fdd1.toFixed(3));			
			var fdd_1 = $('#fdd_1').val();
			
			var eq = (+xy) + (+xans);
			var wt_con_wtsoil = ((+conweight) + (+eq)); 
			
			
			$('#wt_con_wt_soil').val(wt_con_wtsoil.toFixed(2));			
			var wt_con_wt_soil = $('#wt_con_wt_soil').val();
			var vol_core = 1020.5;
			var wetsoil_core = (+fdd_1) * (+vol_core);
			$('#wet_soil_core').val(wetsoil_core.toFixed());
			var wet_soil_core = $('#wet_soil_core').val();
			
			
			
			
			var items1 = Array(980,1000,1039,1040,1061,1082,1050,1038,990,1017);
			var ab_1 = parseInt(items1.length) - 1; 
			var randomNumber1 = rand(0, ab_1);
			var randomItem1 = items1[randomNumber1];	
			var emptycore = randomItem1;		
			$('#empty_core').val(emptycore);
			var empty_core = $('#empty_core').val();
			
			
			var soilcore = (+wet_soil_core) + (+empty_core);
			$('#soil_core').val(soilcore.toFixed());
			var soil_core = $('#soil_core').val();
			
			
			var f_mdd = $('#field_mdd').val();
			var ec = $('#empty_core').val();
			var volc = $('#vol_core').val();
			var soco = $('#soil_core').val();
			//var ws = $('#wet_soil_core').val();
			//var wd = $('#fdd_1').val();
			//var mc = $('#mc_soil').val();
			var cono = $('#con_no').val();
			var cowt = $('#con_weight').val();
			//var cowts = $('#wt_con_wt_soil').val();
			//var codrs = $('#wt_con_dry_soil').val();
			//var mcdr = $('#fdd_2').val();
			//var fdrd = $('#fdd_3').val();
			//var compac = $('#fdd_4').val();
			
			
			var w_s = (+soco) - (+ec);
			$('#wet_soil_core').val(w_s.toFixed());
			var ws = $('#wet_soil_core').val();
			var w_d = (+ws)/(+volc);
			$('#fdd_1').val(w_d.toFixed(3));
			var wd = $('#fdd_1').val();
			
			var eq1 = (+xy) + (+xans);
			var wt_con_wt_soil_1 = ((+cowt) + (+eq1)); 
			$('#wt_con_wt_soil').val(wt_con_wt_soil_1.toFixed(2));
			var cowts = $('#wt_con_wt_soil').val();
			
			var wt_con_dry_soil_1 = (+cowt) + (+xy);
			$('#wt_con_dry_soil').val(wt_con_dry_soil_1.toFixed(2))
			var codrs = $('#wt_con_dry_soil').val();
							
			var fdd__2 = ((+cowts) - (+codrs))/((+codrs) - (+cowt)) * (+100);		
			$('#fdd_2').val(fdd__2.toFixed(2));
			var mcdr = $('#fdd_2').val();
			
			var fd1 = (+wd) * (+100);
			var fd2 = (+mcdr) + (+100);
			var finaleq = (+fd1) / (+fd2);
			$('#fdd_3').val(finaleq.toFixed(3));
			var fdrd = $('#fdd_3').val();
			
			var erq1 = (+fdrd) / (+f_mdd);
			
			var comp = (+erq1) * (+100);
			$('#fdd_4').val(comp.toFixed(2));
			var compac = $('#fdd_4').val();
		}
		else
		{
			var fdd4 = randomNumberFromRange(95.10,99.85).toFixed(2);
			$('#fdd_4').val(fdd4);
			var fdd_4 = $('#fdd_4').val();
			
			var fieldmdd = randomNumberFromRange(1.74,1.79).toFixed(3);
			$('#field_mdd').val(fieldmdd);
			var field_mdd = $('#field_mdd').val();
			
			var fdd3 = ((+fdd_4) / 100) * (+field_mdd);
			$('#fdd_3').val(fdd3.toFixed(3));
			var fdd_3 = $('#fdd_3').val();
			
			var vol_core = 1020.5;
			var items1 = Array(980,1000,1039,1040,1061,1082,1050,1038,990,1017);
			var ab_1 = parseInt(items1.length) - 1; 
			var randomNumber1 = rand(0, ab_1);
			var randomItem1 = items1[randomNumber1];	
			var emptycore = randomItem1;		
			$('#empty_core').val(emptycore);
			var empty_core = $('#empty_core').val();
			var mcsoil = randomNumberFromRange(11.8,14.5).toFixed(2);
			$('#mc_soil').val(mcsoil);
			var mc_soil = $('#mc_soil').val();
			
			var eq1 = (+100) + (+mc_soil);
			var eq2 = (+eq1) * (+fdd_3);
			var fdd1= (+eq2) / (+100);
			$('#fdd_1').val(fdd1.toFixed(3));
			var fdd_1 = $('#fdd_1').val();
			
			var wet_soilcore = (+fdd_1) * (+vol_core);
			$('#wet_soil_core').val(wet_soilcore.toFixed());
			var ws = $('#wet_soil_core').val();
			
			var soilcore = (+ws) + (+empty_core);
			$('#soil_core').val(soilcore.toFixed());
			
			
		}
		
		
	}
	
	function rand(min, max) {
  var offset = min;
  var range = (max - min) + 1;

  var randomNumber = Math.floor( Math.random() * range) + offset;
  return randomNumber;
}
	
	function getWeight(wt1)
	{
			 $.ajax({			 
			dataType:'JSON',       
			type: 'POST',
			url: '<?php echo $base_url; ?>get_contanier.php',
			data: 'action_type=get_excel_record&wt='+wt1,
			beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
			success:function(data){
				$('#con_weight').val(data.id);
				document.getElementById("overlay_div").style.display="none";
				
			}
		});	
		
	}
	
	$("input[name='mo_meter']").change(function(e){
        var methods = $('input[name=mo_meter]:checked').val();
		if(methods == "mo_meter")
		{
			 method="mo_meter";
			$('#con_no').val("");
			$('#con_weight').val("");
			$('#wt_con_dry_soil').val("");
			$('#wt_con_wt_soil').val("");
			$('#fdd_2').val("");
		}
		else
		{
			
			 method="mo_con";
			var conno = randomNumberFromRange(1,321).toFixed();			
			$('#con_no').val(conno);
			$('#mc_soil').val("");			
			var con_no = $('#con_no').val();			
			getWeight(con_no);
		}
			$('#field_mdd').val(null);	
			$('#empty_core').val(null);	
			$('#soil_core').val(null);	
			$('#wet_soil_core').val(null);	
			$('#fdd_1').val(null);	
			$('#fdd_2').val(null);	
			$('#fdd_3').val(null);	
			$('#fdd_4').val(null);	
			$('#mc_soil').val(null);	
	});
	
	$('#chk_den').change(function(){
        if(this.checked)
		{ $('#txtden').css("background-color","var(--success)"); 
			auto();
		}
		else
		{
			$('#txtden').css("background-color","white");
			$('#empty_core').val(null);	
			$('#soil_core').val(null);	
			$('#wet_soil_core').val(null);	
			$('#fdd_1').val(null);	
			$('#mc_soil').val(null);	
			$('#con_no').val(null);	
			$('#con_weight').val(null);	
			$('#wt_con_dry_soil').val(null);	
			$('#wt_con_wt_soil').val(null);	
			$('#fdd_2').val(null);	
			$('#fdd_3').val(null);	
			$('#fdd_4').val(null);	
			$('#field_mdd').val(null);	
		}
	});
	
	function manual()
	{
			var f_mdd = $('#field_mdd').val();
			var ec = $('#empty_core').val();
			var volc = $('#vol_core').val();
			var soco = $('#soil_core').val();
			
		
			
			var w_s = (+soco) - (+ec);
			$('#wet_soil_core').val(w_s.toFixed());
			var ws = $('#wet_soil_core').val();
			var w_d = (+ws)/(+volc);
			$('#fdd_1').val(w_d.toFixed(3));
			var wd = $('#fdd_1').val();
			
			
			
			
			/*var x_y = randomNumberFromRange(32,40).toFixed();
			$('#xy').val(x_y);
			var xy = $('#xy').val();
			var xx = ((+fdd_2) / (+100)) * (+xy);
			$('#xans').val(xx.toFixed(2));
			var xans = $('#xans').val();*/
			if(method=="mo_meter")
			{
				var mcsoil = $('#mc_soil').val();
				var fd1 = (+wd) * (+100);
				var fd2 = (+mcsoil) + (+100);
				var finaleq = (+fd1) / (+fd2);
				$('#fdd_3').val(finaleq.toFixed(3));
				var fdrd = $('#fdd_3').val();
				
				
				/*alert(f_mdd);
				alert(fdrd);
				alert(erq1);*/
				var comp = (+fdrd) / (+f_mdd) * (+100);
				$('#fdd_4').val(comp.toFixed(2));
				var compac = $('#fdd_4').val();
			}
			else			
			{
			var cono = $('#con_no').val();
			var cowt = $('#con_weight').val();
			var cowts = $('#wt_con_wt_soil').val();
			var codrs = $('#wt_con_dry_soil').val();
			
			var fdd__2 = ((+cowts) - (+codrs))/((+codrs) - (+cowt)) * (+100);		
			$('#fdd_2').val(fdd__2.toFixed(2));
			var mcdr = $('#fdd_2').val();
			
			/*var eq1 = (+xy) + (+xans);
			var wt_con_wt_soil_1 = ((+cowt) + (+eq1)); 
			$('#wt_con_wt_soil').val(wt_con_wt_soil_1.toFixed(2));
			
			var wt_con_dry_soil_1 = (+cowt) + (+xy);
			$('#wt_con_dry_soil').val(wt_con_dry_soil_1.toFixed(2))
			*/
							
			
			
			var fd1 = (+wd) * (+100);
			var fd2 = (+mcdr) + (+100);
			var finaleq = (+fd1) / (+fd2);
			$('#fdd_3').val(finaleq.toFixed(3));
			var fdrd = $('#fdd_3').val();
			
			
			/*alert(f_mdd);
			alert(fdrd);
			alert(erq1);*/
			var comp = (+fdrd) / (+f_mdd) * (+100);
			$('#fdd_4').val(comp.toFixed(2));
			var compac = $('#fdd_4').val();
			}
			
			
	}
	
	
	$('#field_mdd').change(function(){
		$('#txtden').css("background-color","var(--success)"); 
			manual();			
	});
	$('#empty_core').change(function(){
		$('#txtden').css("background-color","var(--success)"); 
			manual();			
	});
	$('#vol_core').change(function(){
		$('#txtden').css("background-color","var(--success)"); 
			manual();			
	});
	$('#soil_core').change(function(){
		$('#txtmou').css("background-color","var(--success)"); 
			manual();			
	});
	$('#con_no').change(function(){
		$('#txtfdd').css("background-color","var(--success)"); 
			manual();			
	});
	$('#mc_soil').change(function(){
		$('#txtfdd').css("background-color","var(--success)"); 
			manual();			
	});
	$('#con_weight').change(function(){
		$('#txtcom').css("background-color","var(--success)"); 
			manual();			
	});
	$('#wt_con_dry_soil').change(function(){
		$('#txtcom').css("background-color","var(--success)"); 
			manual();			
	});
	$('#wt_con_wt_soil').change(function(){
		$('#txtcom').css("background-color","var(--success)"); 
			manual();			
	});
});

		
		// code start//
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
        url: '<?php echo $base_url; ?>save_core_cutter.php',
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
				var field_mdd = $('#field_mdd').val();
							
				if(document.getElementById('chk_den').checked) {
									var chk_den = "1";
								}
								else{
									var chk_den = "0";
								}
				
				
				var fdd_1 = $('#fdd_1').val();
				var fdd_2 = $('#fdd_2').val();
				var fdd_3 = $('#fdd_3').val();
				var fdd_4 = $('#fdd_4').val();
				var empty_core = $('#empty_core').val();
				var vol_core = $('#vol_core').val();
				var soil_core = $('#soil_core').val();
				var wet_soil_core = $('#wet_soil_core').val();
				var mc_soil = $('#mc_soil').val();
				var con_no = $('#con_no').val();
				var con_weight = $('#con_weight').val();
				var wt_con_dry_soil = $('#wt_con_dry_soil').val();
				var wt_con_wt_soil = $('#wt_con_wt_soil').val();
				
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&field_mdd='+field_mdd+'&chk_den='+chk_den+'&fdd_1='+fdd_1+'&fdd_2='+fdd_2+'&fdd_3='+fdd_3+'&fdd_4='+fdd_4+'&ulr='+ulr+'&empty_core='+empty_core+'&vol_core='+vol_core+'&soil_core='+soil_core+'&wet_soil_core='+wet_soil_core+'&mc_soil='+mc_soil+'&con_no='+con_no+'&con_weight='+con_weight+'&wt_con_dry_soil='+wt_con_dry_soil+'&wt_con_wt_soil='+wt_con_wt_soil;
				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				var field_mdd = $('#field_mdd').val();
							
				if(document.getElementById('chk_den').checked) {
									var chk_den = "1";
								}
								else{
									var chk_den = "0";
								}
				
				
				var fdd_1 = $('#fdd_1').val();
				var fdd_2 = $('#fdd_2').val();
				var fdd_3 = $('#fdd_3').val();
				var fdd_4 = $('#fdd_4').val();
				var empty_core = $('#empty_core').val();
				var vol_core = $('#vol_core').val();
				var soil_core = $('#soil_core').val();
				var wet_soil_core = $('#wet_soil_core').val();
				var mc_soil = $('#mc_soil').val();
				var con_no = $('#con_no').val();
				var con_weight = $('#con_weight').val();
				var wt_con_dry_soil = $('#wt_con_dry_soil').val();
				var wt_con_wt_soil = $('#wt_con_wt_soil').val();
				
								
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&field_mdd='+field_mdd+'&chk_den='+chk_den+'&fdd_1='+fdd_1+'&fdd_2='+fdd_2+'&fdd_3='+fdd_3+'&fdd_4='+fdd_4+'&ulr='+ulr+'&empty_core='+empty_core+'&vol_core='+vol_core+'&soil_core='+soil_core+'&wet_soil_core='+wet_soil_core+'&mc_soil='+mc_soil+'&con_no='+con_no+'&con_weight='+con_weight+'&wt_con_dry_soil='+wt_con_dry_soil+'&wt_con_wt_soil='+wt_con_wt_soil;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_core_cutter.php',
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
        url: '<?php echo $base_url; ?>save_core_cutter.php',
       data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#field_mdd').val(data.field_mdd);
           
            var chk_den = data.chk_den;
           
			if(chk_den=="1")
			{
			   $('#txtden').css("background-color","var(--success)");			
			   $("#chk_den").prop("checked", true); 
			}else{
				$('#txtden').css("background-color","white");			
				$("#chk_den").prop("checked", false); 
			}

			
            
            $('#fdd_1').val(data.fdd_1);
            $('#fdd_2').val(data.fdd_2);
            $('#fdd_3').val(data.fdd_3);
            $('#fdd_4').val(data.fdd_4);
            $('#empty_core').val(data.empty_core);
            $('#vol_core').val(data.vol_core);
            $('#soil_core').val(data.soil_core);
            $('#wet_soil_core').val(data.wet_soil_core);
            $('#mc_soil').val(data.mc_soil);
            $('#con_no').val(data.con_no);
            $('#con_weight').val(data.con_weight);
            $('#wt_con_wt_soil').val(data.wt_con_wt_soil);
            $('#wt_con_dry_soil').val(data.wt_con_dry_soil);
            
			
			
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