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
					$pvc_dia= $row_select4['pvc_dia'];
					$pvc_kg= $row_select4['pvc_kg'];
					
					
				}
				
				if($pvc_kg=="2.5 kg")
				{
					$avg_class="Class 1";
					$avg_dia=$pvc_dia;
					$avg_color="Red";
					$avg_thick="No Crack";
				}
				else if($pvc_kg=="4.0 kg")
				{
					$avg_class="Class 2";
					$avg_dia=$pvc_dia;
					$avg_color="Blue";
					$avg_thick="No Crack";
				}
				else if($pvc_kg=="6.0 kg")
				{
					$avg_class="Class 3";
					$avg_dia=$pvc_dia;
					$avg_color="Green";
					$avg_thick="No Crack";
				}
				else if($pvc_kg=="8.0 kg")
				{
					$avg_class="Class 4";
					$avg_dia=$pvc_dia;
					$avg_color="Brown";
					$avg_thick="No Crack";
				}
				else if($pvc_kg=="10.0 kg")
				{
					$avg_class="Class 5";
					$avg_dia=$pvc_dia;
					$avg_color="Yellow";
					$avg_thick="No Crack";
				}
				else if($pvc_kg=="12.5 kg")
				{
					$avg_class="Class 6";
					$avg_dia=$pvc_dia;
					$avg_color="Black";
					$avg_thick="No Crack";
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
							<h2  style="text-align:center;">PVC PIPES</h2>
						</div>
						<!--<div class="box-default">-->
						<form class="form" id="Glazed" method="post">
							<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">
							<Br>
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
								<div class="col-lg-3">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
											<input type="hidden" class="form-control inputs" id="pvc_kg"  name="pvc_kg" value="<?php echo $pvc_kg;?>">
											<input type="hidden" class="form-control inputs" id="pvc_dia"  name="pvc_dia" value="<?php echo $pvc_dia;?>">
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<div class="col-sm-3">
											<label for="chk_auto">Class of Pipe:</label>
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="avg_class" name="avg_class" value ="<?php echo $avg_class;?>">
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<div class="col-sm-3">
											<label for="chk_auto">Diameter of Pipe:</label>
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="avg_dia" name="avg_dia" value ="<?php echo $avg_dia;?>">
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<div class="col-sm-3">
											<label for="chk_auto">Color of Pipe:</label>
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="avg_color" name="avg_color" value ="<?php echo $avg_color;?>">
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<div class="col-sm-3">
											<label for="chk_auto">Crack Thickness:</label>
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="avg_thick" name="avg_thick" value ="<?php echo $avg_thick;?>">
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
												$querys_job1 = "SELECT * FROM pvc_pipe WHERE `is_deleted`='0' and lab_no='$lab_no' and job_no='$job_no' ";
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
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_pvc_pipe.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>
										<!--<div class="col-sm-2">
											
											<a target = '_blank' href="<?php //echo $base_url; ?>back_cal_report/print_pvc_pipe.php?job_no=<?php// echo $_GET['job_no'];?>&&report_no=<?php //echo $_GET['report_no'];?>&&lab_no=<?php //echo $_GET['lab_no'];?>&&trf_no=<?php //echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Report</b></a>
										</div>-->
										<?php //} ?>
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
							
							<?php
							$test_check;
							$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
								$result_select1 = mysqli_query($conn, $select_query1);
								while($r1 = mysqli_fetch_array($result_select1)){
									
									if($r1['test_code']=="out")
									{
										$test_check.="out,";
									?>
								
								<div class="panel panel-default" id="out">
									<div class="panel-heading" id="txtout">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse_out">
												<h4 class="panel-title">
												<b>Crushing laod kg</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse_out" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_out">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_out"  id="chk_out" value="chk_out"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">Crushing laod kg</label>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Crushing laod kg</label>	
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;width:150px" class="form-control inputs" id="avg_out" name="avg_out">
															</div>
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
								<?php }
								else if($r1['test_code']=="mea")
								{ $test_check.="mea,";
							
								?>
								
								<div class="panel panel-default" id="mea">
									<div class="panel-heading" id="txtmea">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse_mea">
												<h4 class="panel-title">
												<b>Loss on Ignition (%)</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse_mea" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_mea">2.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_mea"  id="chk_mea" value="chk_mea"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">Loss on Ignition (%)</label>
															<input type="hidden" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="thickness" name="thickness">
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Loss on Ignition (%)</label>	
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;width:150px" class="form-control inputs" id="avg_mea" name="avg_mea">
															</div>
														</div>
													</div>
												</div>
												<br>
										
											
										</div>
									</div>
								</div>
								<?php }
								else if($r1['test_code']=="any")
								{ $test_check.="any,";
							
								?>
								<div class="panel panel-default" id="any">
									<div class="panel-heading" id="txtany">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseany">
												<h4 class="panel-title">
												<b>Plastic resistance to alkali</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapseany" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_any">3.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_any"  id="chk_any" value="chk_any"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">Plastic resistance to alkali</label>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Plastic resistance to alkali</label>	
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;width:150px" class="form-control" tabindex="4" id="avg_any" name="avg_any"></div>
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
								<?php }
								else if($r1['test_code']=="pre")
								{ $test_check.="pre,";
							
								?>
								<div class="panel panel-default" id="pre">
									<div class="panel-heading" id="txtpre">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsepre">
												<h4 class="panel-title">
												<b>Plastic resistance to acid</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapsepre" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_pre">4.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_pre"  id="chk_pre" value="chk_pre"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">Plastic resistance to acid</label>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
														<div class="form-group">											
															<div class="col-md-3">
																<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Plastic resistance to acid</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="avg_pre" name="avg_pre">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
											
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
							 $query = "select * from pvc_pipe WHERE lab_no='$aa'  and `is_deleted`='0' AND `job_no`='$job_no'";

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
});

	//Nominal Outside Diameter
	function out_auto()
	{
		$('#txtout').css("background-color","var(--success)");
		var pvc_dia = $('#pvc_dia').val();
		var pvc_kg = $('#pvc_kg').val();
		
		$('#avg_out').val(pvc_dia.replace("mm",''));
		
	}
	$('#chk_out').change(function(){
        if(this.checked)
		{  
			out_auto();
			
		}
		else
		{
			$('#txtout').css("background-color","white");
			$('#avg_out').val(null);
			
		}
	});
	
	
	//Mean Outside Diameter
	function mea_auto()
	{
		$('#txtmea').css("background-color","var(--success)");
		var pvc_dia = $('#pvc_dia').val();
		var pvc_kg = $('#pvc_kg').val();
		
			if(pvc_dia=="20 mm"){
				$('#avg_mea').val(randomNumberFromRange(20.0,20.3).toFixed(1));
			}else if(pvc_dia=="25 mm"){
				$('#avg_mea').val(randomNumberFromRange(25.0,25.0).toFixed(1));
			}else if(pvc_dia=="32 mm"){
				$('#avg_mea').val(randomNumberFromRange(32.0,32.3).toFixed(1));
			}else if(pvc_dia=="40 mm"){
				$('#avg_mea').val(randomNumberFromRange(40.0,40.3).toFixed(1));
			}else if(pvc_dia=="50 mm"){
				$('#avg_mea').val(randomNumberFromRange(50.0,50.3).toFixed(1));
			}else if(pvc_dia=="63 mm"){
				$('#avg_mea').val(randomNumberFromRange(63.0,63.3).toFixed(1));
			}else if(pvc_dia=="75 mm"){
				$('#avg_mea').val(randomNumberFromRange(75.0,75.3).toFixed(1));
			}else if(pvc_dia=="90 mm"){
				$('#avg_mea').val(randomNumberFromRange(90.0,90.3).toFixed(1));
			}else if(pvc_dia=="110 mm"){
				$('#avg_mea').val(randomNumberFromRange(110.0,110.4).toFixed(1));
			}else if(pvc_dia=="125 mm"){
				$('#avg_mea').val(randomNumberFromRange(125.0,125.4).toFixed(1));
			}else if(pvc_dia=="140 mm"){
				$('#avg_mea').val(randomNumberFromRange(140.0,140.5).toFixed(1));
			}else if(pvc_dia=="160 mm"){
				$('#avg_mea').val(randomNumberFromRange(160.0,160.5).toFixed(1));
			}else if(pvc_dia=="180 mm"){
				$('#avg_mea').val(randomNumberFromRange(180.0,180.6).toFixed(1));
			}else if(pvc_dia=="200 mm"){
				$('#avg_mea').val(randomNumberFromRange(200.0,200.6).toFixed(1));
			}else if(pvc_dia=="225 mm"){
				$('#avg_mea').val(randomNumberFromRange(225.0,225.7).toFixed(1));
			}else if(pvc_dia=="250 mm"){
				$('#avg_mea').val(randomNumberFromRange(250.0,250.8).toFixed(1));
			}else if(pvc_dia=="280 mm"){
				$('#avg_mea').val(randomNumberFromRange(280.0,280.9).toFixed(1));
			}else if(pvc_dia=="315 mm"){
				$('#avg_mea').val(randomNumberFromRange(315.0,315.9).toFixed(1));
			}else if(pvc_dia=="355 mm"){
				$('#avg_mea').val(randomNumberFromRange(355.0,355.9).toFixed(1));
			}else if(pvc_dia=="400 mm"){
				$('#avg_mea').val(randomNumberFromRange(400.0,401.1).toFixed(1));
			}else if(pvc_dia=="450 mm"){
				$('#avg_mea').val(randomNumberFromRange(450.0,451.1).toFixed(1));
			}else if(pvc_dia=="500 mm"){
				$('#avg_mea').val(randomNumberFromRange(500.0,501.2).toFixed(1));
			}else if(pvc_dia=="560 mm"){
				$('#avg_mea').val(randomNumberFromRange(560.0,561.5).toFixed(1));
			}else if(pvc_dia=="630 mm"){
				$('#avg_mea').val(randomNumberFromRange(630.0,631.6).toFixed(1));
			}
		
		
	}
	$('#chk_mea').change(function(){
        if(this.checked)
		{  
			mea_auto();
			
		}
		else
		{
			$('#txtmea').css("background-color","white");
			$('#avg_mea').val(null);
			
		}
	});
	
	//Outside Diameter at Any Point
	function any_auto()
	{
		$('#txtany').css("background-color","var(--success)");
			var pvc_dia = $('#pvc_dia').val();
		var pvc_kg = $('#pvc_kg').val();
		if(pvc_dia=="20 mm"){
				$('#avg_any').val(randomNumberFromRange(19.5,20.3).toFixed(1));
			}else if(pvc_dia=="25 mm"){
				$('#avg_any').val(randomNumberFromRange(24.5,25.3).toFixed(1));
			}else if(pvc_dia=="32 mm"){
				$('#avg_any').val(randomNumberFromRange(31.5,32.3).toFixed(1));
			}else if(pvc_dia=="40 mm"){
				$('#avg_any').val(randomNumberFromRange(39.5,40.3).toFixed(1));
			}else if(pvc_dia=="50 mm"){
				$('#avg_any').val(randomNumberFromRange(49.4,50.6).toFixed(1));
			}else if(pvc_dia=="63 mm"){
				$('#avg_any').val(randomNumberFromRange(62.2,63.8).toFixed(1));
			}else if(pvc_dia=="75 mm"){
				$('#avg_any').val(randomNumberFromRange(74.1,75.9).toFixed(1));
			}else if(pvc_dia=="90 mm"){
				$('#avg_any').val(randomNumberFromRange(88.9,91.1).toFixed(1));
			}else if(pvc_dia=="110 mm"){
				$('#avg_any').val(randomNumberFromRange(108.6,111.4).toFixed(1));
			}else if(pvc_dia=="125 mm"){
				$('#avg_any').val(randomNumberFromRange(123.5,126.5).toFixed(1));
			}else if(pvc_dia=="140 mm"){
				$('#avg_any').val(randomNumberFromRange(138.3,141.7).toFixed(1));
			}else if(pvc_dia=="160 mm"){
				$('#avg_any').val(randomNumberFromRange(158.0,162.0).toFixed(1));
			}else if(pvc_dia=="180 mm"){
				$('#avg_any').val(randomNumberFromRange(177.8,182.2).toFixed(1));
			}else if(pvc_dia=="200 mm"){
				$('#avg_any').val(randomNumberFromRange(197.6,202.4).toFixed(1));
			}else if(pvc_dia=="225 mm"){
				$('#avg_any').val(randomNumberFromRange(222.3,227.7).toFixed(1));
			}else if(pvc_dia=="250 mm"){
				$('#avg_any').val(randomNumberFromRange(247.0,253.0).toFixed(1));
			}else if(pvc_dia=="280 mm"){
				$('#avg_any').val(randomNumberFromRange(276.6,283.4).toFixed(1));
			}else if(pvc_dia=="315 mm"){
				$('#avg_any').val(randomNumberFromRange(311.2,318.8).toFixed(1));
			}else if(pvc_dia=="355 mm"){
				$('#avg_any').val(randomNumberFromRange(350.7,359.3).toFixed(1));
			}else if(pvc_dia=="400 mm"){
				$('#avg_any').val(randomNumberFromRange(395.2,404.8).toFixed(1));
			}else if(pvc_dia=="450 mm"){
				$('#avg_any').val(randomNumberFromRange(444.6,455.4).toFixed(1));
			}else if(pvc_dia=="500 mm"){
				$('#avg_any').val(randomNumberFromRange(494.0,506.0).toFixed(1));
			}else if(pvc_dia=="560 mm"){
				$('#avg_any').val(randomNumberFromRange(553.2,566.8).toFixed(1));
			}else if(pvc_dia=="630 mm"){
				$('#avg_any').val(randomNumberFromRange(622.4,637.6).toFixed(1));
			}
	}
	$('#chk_any').change(function(){
        if(this.checked)
		{  
			any_auto();
			
		}
		else
		{
			$('#txtany').css("background-color","white");
			$('#avg_any').val(null);
			
		}
	});
	
	//Working Pressure mpa 1.0
	function pre_auto()
	{
		$('#txtpre').css("background-color","var(--success)");
		var pvc_dia = $('#pvc_dia').val();
		var pvc_kg = $('#pvc_kg').val();
		if(pvc_kg=="2.5 kg")
		{
			if(pvc_dia=="20 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="25 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="32 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="40 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="50 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="63 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="75 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="90 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.3,1.7).toFixed(1));
			}else if(pvc_dia=="110 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.6,2.0).toFixed(1));
			}else if(pvc_dia=="125 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.8,2.2).toFixed(1));
			}else if(pvc_dia=="140 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.0,2.4).toFixed(1));
			}else if(pvc_dia=="160 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.3,2.8).toFixed(1));
			}else if(pvc_dia=="180 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.6,3.1).toFixed(1));
			}else if(pvc_dia=="200 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.9,3.4).toFixed(1));
			}else if(pvc_dia=="225 mm"){
				$('#avg_pre').val(randomNumberFromRange(3.3,3.9).toFixed(1));
			}else if(pvc_dia=="250 mm"){
				$('#avg_pre').val(randomNumberFromRange(3.6,4.2).toFixed(1));
			}else if(pvc_dia=="280 mm"){
				$('#avg_pre').val(randomNumberFromRange(4.1,4.8).toFixed(1));
			}else if(pvc_dia=="315 mm"){
				$('#avg_pre').val(randomNumberFromRange(4.6,5.3).toFixed(1));
			}else if(pvc_dia=="355 mm"){
				$('#avg_pre').val(randomNumberFromRange(5.1,5.9).toFixed(1));
			}else if(pvc_dia=="400 mm"){
				$('#avg_pre').val(randomNumberFromRange(5.8,6.7).toFixed(1));
			}else if(pvc_dia=="450 mm"){
				$('#avg_pre').val(randomNumberFromRange(6.5,7.5).toFixed(1));
			}else if(pvc_dia=="500 mm"){
				$('#avg_pre').val(randomNumberFromRange(7.2,8.3).toFixed(1));
			}else if(pvc_dia=="560 mm"){
				$('#avg_pre').val(randomNumberFromRange(8.1,9.4).toFixed(1));
			}else if(pvc_dia=="630 mm"){
				$('#avg_pre').val(randomNumberFromRange(9.1,10.5).toFixed(1));
			}
		}
		else if(pvc_kg=="4.0 kg")
		{
			if(pvc_dia=="20 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="25 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="32 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="40 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="50 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="63 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.5,1.9).toFixed(1));
			}else if(pvc_dia=="75 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.8,2.2).toFixed(1));
			}else if(pvc_dia=="90 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.1,2.6).toFixed(1));
			}else if(pvc_dia=="110 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.5,3.0).toFixed(1));
			}else if(pvc_dia=="125 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.9,3.4).toFixed(1));
			}else if(pvc_dia=="140 mm"){
				$('#avg_pre').val(randomNumberFromRange(3.2,3.8).toFixed(1));
			}else if(pvc_dia=="160 mm"){
				$('#avg_pre').val(randomNumberFromRange(3.7,4.3).toFixed(1));
			}else if(pvc_dia=="180 mm"){
				$('#avg_pre').val(randomNumberFromRange(4.2,4.9).toFixed(1));
			}else if(pvc_dia=="200 mm"){
				$('#avg_pre').val(randomNumberFromRange(4.6,5.3).toFixed(1));
			}else if(pvc_dia=="225 mm"){
				$('#avg_pre').val(randomNumberFromRange(5.2,6.0).toFixed(1));
			}else if(pvc_dia=="250 mm"){
				$('#avg_pre').val(randomNumberFromRange(5.7,6.5).toFixed(1));
			}else if(pvc_dia=="280 mm"){
				$('#avg_pre').val(randomNumberFromRange(6.4,7.4).toFixed(1));
			}else if(pvc_dia=="315 mm"){
				$('#avg_pre').val(randomNumberFromRange(7.2,8.3).toFixed(1));
			}else if(pvc_dia=="355 mm"){
				$('#avg_pre').val(randomNumberFromRange(8.1,9.4).toFixed(1));
			}else if(pvc_dia=="400 mm"){
				$('#avg_pre').val(randomNumberFromRange(9.1,10.5).toFixed(1));
			}else if(pvc_dia=="450 mm"){
				$('#avg_pre').val(randomNumberFromRange(10.3,11.9).toFixed(1));
			}else if(pvc_dia=="500 mm"){
				$('#avg_pre').val(randomNumberFromRange(11.4,13.2).toFixed(1));
			}else if(pvc_dia=="560 mm"){
				$('#avg_pre').val(randomNumberFromRange(12.8,14.8).toFixed(1));
			}else if(pvc_dia=="630 mm"){
				$('#avg_pre').val(randomNumberFromRange(14.4,16.6).toFixed(1));
			}
		}
		else if(pvc_kg=="6.0 kg")
		{
			if(pvc_dia=="20 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="25 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="32 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="40 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.4,1.8).toFixed(1));
			}else if(pvc_dia=="50 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.7,2.1).toFixed(1));
			}else if(pvc_dia=="63 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.2,2.7).toFixed(1));
			}else if(pvc_dia=="75 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.6,3.1).toFixed(1));
			}else if(pvc_dia=="90 mm"){
				$('#avg_pre').val(randomNumberFromRange(3.1,3.7).toFixed(1));
			}else if(pvc_dia=="110 mm"){
				$('#avg_pre').val(randomNumberFromRange(3.7,4.3).toFixed(1));
			}else if(pvc_dia=="125 mm"){
				$('#avg_pre').val(randomNumberFromRange(4.3,5.0).toFixed(1));
			}else if(pvc_dia=="140 mm"){
				$('#avg_pre').val(randomNumberFromRange(4.8,5.5).toFixed(1));
			}else if(pvc_dia=="160 mm"){
				$('#avg_pre').val(randomNumberFromRange(5.4,6.2).toFixed(1));
			}else if(pvc_dia=="180 mm"){
				$('#avg_pre').val(randomNumberFromRange(6.1,7.1).toFixed(1));
			}else if(pvc_dia=="200 mm"){
				$('#avg_pre').val(randomNumberFromRange(6.8,7.9).toFixed(1));
			}else if(pvc_dia=="225 mm"){
				$('#avg_pre').val(randomNumberFromRange(7.6,8.8).toFixed(1));
			}else if(pvc_dia=="250 mm"){
				$('#avg_pre').val(randomNumberFromRange(8.5,9.8).toFixed(1));
			}else if(pvc_dia=="280 mm"){
				$('#avg_pre').val(randomNumberFromRange(9.5,11.0).toFixed(1));
			}else if(pvc_dia=="315 mm"){
				$('#avg_pre').val(randomNumberFromRange(10.7,12.4).toFixed(1));
			}else if(pvc_dia=="355 mm"){
				$('#avg_pre').val(randomNumberFromRange(12.0,13.8).toFixed(1));
			}else if(pvc_dia=="400 mm"){
				$('#avg_pre').val(randomNumberFromRange(13.5,15.6).toFixed(1));
			}else if(pvc_dia=="450 mm"){
				$('#avg_pre').val(randomNumberFromRange(15.2,17.5).toFixed(1));
			}else if(pvc_dia=="500 mm"){
				$('#avg_pre').val(randomNumberFromRange(16.9,19.5).toFixed(1));
			}else if(pvc_dia=="560 mm"){
				$('#avg_pre').val(randomNumberFromRange(18.9,21.8).toFixed(1));
			}else if(pvc_dia=="630 mm"){
				$('#avg_pre').val(randomNumberFromRange(21.3,24.5).toFixed(1));
			}
		}
		else if(pvc_kg=="8.0 kg")
		{
			if(pvc_dia=="20 mm"){
				$('#avg_pre').val("-");
			}else if(pvc_dia=="25 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.2,1.6).toFixed(1));
			}else if(pvc_dia=="32 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.5,1.9).toFixed(1));
			}else if(pvc_dia=="40 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.8,2.2).toFixed(1));
			}else if(pvc_dia=="50 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.3,2.8).toFixed(1));
			}else if(pvc_dia=="63 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.8,3.3).toFixed(1));
			}else if(pvc_dia=="75 mm"){
				$('#avg_pre').val(randomNumberFromRange(3.4,4.0).toFixed(1));
			}else if(pvc_dia=="90 mm"){
				$('#avg_pre').val(randomNumberFromRange(4.0,4.6).toFixed(1));
			}else if(pvc_dia=="110 mm"){
				$('#avg_pre').val(randomNumberFromRange(4.9,5.6).toFixed(1));
			}else if(pvc_dia=="125 mm"){
				$('#avg_pre').val(randomNumberFromRange(5.6,6.4).toFixed(1));
			}else if(pvc_dia=="140 mm"){
				$('#avg_pre').val(randomNumberFromRange(6.3,7.3).toFixed(1));
			}else if(pvc_dia=="160 mm"){
				$('#avg_pre').val(randomNumberFromRange(7.2,8.3).toFixed(1));
			}else if(pvc_dia=="180 mm"){
				$('#avg_pre').val(randomNumberFromRange(8.0,9.2).toFixed(1));
			}else if(pvc_dia=="200 mm"){
				$('#avg_pre').val(randomNumberFromRange(8.9,10.3).toFixed(1));
			}else if(pvc_dia=="225 mm"){
				$('#avg_pre').val(randomNumberFromRange(10.0,11.5).toFixed(1));
			}else if(pvc_dia=="250 mm"){
				$('#avg_pre').val(randomNumberFromRange(11.2,12.9).toFixed(1));
			}else if(pvc_dia=="280 mm"){
				$('#avg_pre').val(randomNumberFromRange(12.5,14.4).toFixed(1));
			}else if(pvc_dia=="315 mm"){
				$('#avg_pre').val(randomNumberFromRange(14.0,16.1).toFixed(1));
			}else if(pvc_dia=="355 mm"){
				$('#avg_pre').val(randomNumberFromRange(15.8,18.2).toFixed(1));
			}else if(pvc_dia=="400 mm"){
				$('#avg_pre').val(randomNumberFromRange(17.8,20.5).toFixed(1));
			}else if(pvc_dia=="450 mm"){
				$('#avg_pre').val(randomNumberFromRange(20.0,23.0).toFixed(1));
			}else if(pvc_dia=="500 mm"){
				$('#avg_pre').val(randomNumberFromRange(22.3,25.7).toFixed(1));
			}else if(pvc_dia=="560 mm"){
				$('#avg_pre').val(randomNumberFromRange(24.9,28.7).toFixed(1));
			}else if(pvc_dia=="630 mm"){
				$('#avg_pre').val(randomNumberFromRange(28.0,32.2).toFixed(1));
			}
		}
		else if(pvc_kg=="10.0 kg")
		{
			if(pvc_dia=="20 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.1,1.5).toFixed(1));
			}else if(pvc_dia=="25 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.4,1.8).toFixed(1));
			}else if(pvc_dia=="32 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.8,2.2).toFixed(1));
			}else if(pvc_dia=="40 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.2,2.7).toFixed(1));
			}else if(pvc_dia=="50 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.8,3.3).toFixed(1));
			}else if(pvc_dia=="63 mm"){
				$('#avg_pre').val(randomNumberFromRange(3.5,4.1).toFixed(1));
			}else if(pvc_dia=="75 mm"){
				$('#avg_pre').val(randomNumberFromRange(4.2,4.9).toFixed(1));
			}else if(pvc_dia=="90 mm"){
				$('#avg_pre').val(randomNumberFromRange(5.0,5.7).toFixed(1));
			}else if(pvc_dia=="110 mm"){
				$('#avg_pre').val(randomNumberFromRange(6.1,7.1).toFixed(1));
			}else if(pvc_dia=="125 mm"){
				$('#avg_pre').val(randomNumberFromRange(6.9,8.0).toFixed(1));
			}else if(pvc_dia=="140 mm"){
				$('#avg_pre').val(randomNumberFromRange(7.7,8.9).toFixed(1));
			}else if(pvc_dia=="160 mm"){
				$('#avg_pre').val(randomNumberFromRange(8.8,10.2).toFixed(1));
			}else if(pvc_dia=="180 mm"){
				$('#avg_pre').val(randomNumberFromRange(9.9,11.4).toFixed(1));
			}else if(pvc_dia=="200 mm"){
				$('#avg_pre').val(randomNumberFromRange(11.0,12.7).toFixed(1));
			}else if(pvc_dia=="225 mm"){
				$('#avg_pre').val(randomNumberFromRange(12.4,14.3).toFixed(1));
			}else if(pvc_dia=="250 mm"){
				$('#avg_pre').val(randomNumberFromRange(13.8,15.9).toFixed(1));
			}else if(pvc_dia=="280 mm"){
				$('#avg_pre').val(randomNumberFromRange(15.4,17.8).toFixed(1));
			}else if(pvc_dia=="315 mm"){
				$('#avg_pre').val(randomNumberFromRange(17.3,19.9).toFixed(1));
			}else if(pvc_dia=="355 mm"){
				$('#avg_pre').val(randomNumberFromRange(19.6,22.6).toFixed(1));
			}else if(pvc_dia=="400 mm"){
				$('#avg_pre').val(randomNumberFromRange(22.0,25.3).toFixed(1));
			}else if(pvc_dia=="450 mm"){
				$('#avg_pre').val(randomNumberFromRange(24.8,28.6).toFixed(1));
			}else if(pvc_dia=="500 mm"){
				$('#avg_pre').val(randomNumberFromRange(27.5,31.7).toFixed(1));
			}else if(pvc_dia=="560 mm"){
				$('#avg_pre').val(randomNumberFromRange(30.8,35.5).toFixed(1));
			}else if(pvc_dia=="630 mm"){
				$('#avg_pre').val(randomNumberFromRange(34.7,40.0).toFixed(1));
			}
		}
		else if(pvc_kg=="12.5 kg")
		{
			if(pvc_dia=="20 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.4,1.8).toFixed(1));
			}else if(pvc_dia=="25 mm"){
				$('#avg_pre').val(randomNumberFromRange(1.7,2.1).toFixed(1));
			}else if(pvc_dia=="32 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.2,2.7).toFixed(1));
			}else if(pvc_dia=="40 mm"){
				$('#avg_pre').val(randomNumberFromRange(2.8,3.3).toFixed(1));
			}else if(pvc_dia=="50 mm"){
				$('#avg_pre').val(randomNumberFromRange(3.4,4.0).toFixed(1));
			}else if(pvc_dia=="63 mm"){
				$('#avg_pre').val(randomNumberFromRange(4.3,5.0).toFixed(1));
			}else if(pvc_dia=="75 mm"){
				$('#avg_pre').val(randomNumberFromRange(5.1,5.9).toFixed(1));
			}else if(pvc_dia=="90 mm"){
				$('#avg_pre').val(randomNumberFromRange(6.1,7.1).toFixed(1));
			}else if(pvc_dia=="110 mm"){
				$('#avg_pre').val(randomNumberFromRange(7.5,8.7).toFixed(1));
			}else if(pvc_dia=="125 mm"){
				$('#avg_pre').val(randomNumberFromRange(8.5,9.8).toFixed(1));
			}else if(pvc_dia=="140 mm"){
				$('#avg_pre').val(randomNumberFromRange(9.5,11.0).toFixed(1));
			}else if(pvc_dia=="160 mm"){
				$('#avg_pre').val(randomNumberFromRange(10.9,12.6).toFixed(1));
			}else if(pvc_dia=="180 mm"){
				$('#avg_pre').val(randomNumberFromRange(12.2,14.1).toFixed(1));
			}else if(pvc_dia=="200 mm"){
				$('#avg_pre').val(randomNumberFromRange(13.6,15.7).toFixed(1));
			}else if(pvc_dia=="225 mm"){
				$('#avg_pre').val(randomNumberFromRange(15.3,17.6).toFixed(1));
			}else if(pvc_dia=="250 mm"){
				$('#avg_pre').val(randomNumberFromRange(17.0,19.6).toFixed(1));
			}else if(pvc_dia=="280 mm"){
				$('#avg_pre').val(randomNumberFromRange(19.0,21.9).toFixed(1));
			}else if(pvc_dia=="315 mm"){
				$('#avg_pre').val(randomNumberFromRange(21.4,24.7).toFixed(1));
			}else if(pvc_dia=="355 mm"){
				$('#avg_pre').val(randomNumberFromRange(24.1,27.8).toFixed(1));
			}else if(pvc_dia=="400 mm"){
				$('#avg_pre').val(randomNumberFromRange(27.2,31.3).toFixed(1));
			}else if(pvc_dia=="450 mm"){
				$('#avg_pre').val(randomNumberFromRange(30.5,35.1).toFixed(1));
			}else if(pvc_dia=="500 mm"){
				$('#avg_pre').val(randomNumberFromRange(33.9,39.0).toFixed(1));
			}else if(pvc_dia=="560 mm"){
				$('#avg_pre').val(randomNumberFromRange(38.0,43.7).toFixed(1));
			}else if(pvc_dia=="630 mm"){
				$('#avg_pre').val(randomNumberFromRange(42.7,49.2).toFixed(1));
			}
		}
		
	}
	$('#chk_pre').change(function(){
        if(this.checked)
		{  
			pre_auto();
			
		}
		else
		{
			$('#txtpre').css("background-color","white");
			$('#avg_pre').val(null);
			
		}
	});


	$('#chk_auto').change(function(){
        if(this.checked)
		{ 
				var temp = $('#test_list').val();
				var aa= temp.split(",");
				//out
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="out")
					{
						$('#txtout').css("background-color","var(--success)");
						$("#chk_out").prop("checked", true); 
						out_auto();
						break;
					}					
				}
				
				//mea
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mea")
					{
						$('#txtmea').css("background-color","var(--success)");
						$("#chk_mea").prop("checked", true); 
						mea_auto();
						break;
					}					
				}
				
				//any
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="any")
					{
						$('#txtany').css("background-color","var(--success)");
						$("#chk_any").prop("checked", true); 
						any_auto();
						break;
					}					
				}
				
				//pre
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pre")
					{
						$('#txtpre').css("background-color","var(--success)");
						$("#chk_pre").prop("checked", true); 
						pre_auto();
						break;
					}					
				}
		}
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
        url: '<?php echo $base_url; ?>save_pvc_pipe.php',
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
				var pvc_kg = $('#pvc_kg').val();
				var pvc_dia = $('#pvc_dia').val();
				var avg_class = $('#avg_class').val();
				var avg_dia = $('#avg_dia').val();
				var avg_color = $('#avg_color').val();
				var avg_thick = $('#avg_thick').val();
				var temp = $('#test_list').val();
				var aa= temp.split(",");			
				
				//out
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="out")
					{
						if(document.getElementById('chk_out').checked) {
								var chk_out = "1";
						}
						else{
								var chk_out = "0";
						}
						var avg_out = $('#avg_out').val();							
						break;
					}
					else
					{
						var chk_out = "0";	
						var avg_out ="0";
					}
				}
				
				//mea
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mea")
					{
						if(document.getElementById('chk_mea').checked) {
								var chk_mea = "1";
						}
						else{
								var chk_mea = "0";
						}
						var avg_mea = $('#avg_mea').val();							
						break;
					}
					else
					{
						var chk_mea = "0";	
						var avg_mea ="0";
					}
				}
				
				//any
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="any")
					{
						if(document.getElementById('chk_any').checked) {
								var chk_any = "1";
						}
						else{
								var chk_any = "0";
						}
						var avg_any = $('#avg_any').val();							
						break;
					}
					else
					{
						var chk_any = "0";	
						var avg_any ="0";
					}
				}
				
				//pre
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pre")
					{
						if(document.getElementById('chk_pre').checked) {
								var chk_pre = "1";
						}
						else{
								var chk_pre = "0";
						}
						var avg_pre = $('#avg_pre').val();							
						break;
					}
					else
					{
						var chk_pre = "0";	
						var avg_pre ="0";
					}
				}
				
				
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&pvc_kg='+pvc_kg+'&pvc_dia='+pvc_dia+'&avg_class='+avg_class+'&avg_dia='+avg_dia+'&avg_color='+avg_color+'&avg_thick='+avg_thick+'&chk_out='+chk_out+'&avg_out='+avg_out+'&chk_mea='+chk_mea+'&avg_mea='+avg_mea+'&chk_any='+chk_any+'&avg_any='+avg_any+'&chk_pre='+chk_pre+'&avg_pre='+avg_pre+'&ulr='+ulr;
				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				var pvc_kg = $('#pvc_kg').val();
				var pvc_dia = $('#pvc_dia').val();
				var avg_class = $('#avg_class').val();
				var avg_dia = $('#avg_dia').val();
				var avg_color = $('#avg_color').val();
				var avg_thick = $('#avg_thick').val();
				var temp = $('#test_list').val();
				var aa= temp.split(",");
				
				//out
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="out")
					{
						if(document.getElementById('chk_out').checked) {
								var chk_out = "1";
						}
						else{
								var chk_out = "0";
						}
						var avg_out = $('#avg_out').val();							
						break;
					}
					else
					{
						var chk_out = "0";	
						var avg_out ="0";
					}
				}
				
				//mea
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="mea")
					{
						if(document.getElementById('chk_mea').checked) {
								var chk_mea = "1";
						}
						else{
								var chk_mea = "0";
						}
						var avg_mea = $('#avg_mea').val();							
						break;
					}
					else
					{
						var chk_mea = "0";	
						var avg_mea ="0";
					}
				}
				
				//any
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="any")
					{
						if(document.getElementById('chk_any').checked) {
								var chk_any = "1";
						}
						else{
								var chk_any = "0";
						}
						var avg_any = $('#avg_any').val();							
						break;
					}
					else
					{
						var chk_any = "0";	
						var avg_any ="0";
					}
				}
				
				//pre
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="pre")
					{
						if(document.getElementById('chk_pre').checked) {
								var chk_pre = "1";
						}
						else{
								var chk_pre = "0";
						}
						var avg_pre = $('#avg_pre').val();							
						break;
					}
					else
					{
						var chk_pre = "0";	
						var avg_pre ="0";
					}
				}
				
								
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&pvc_kg='+pvc_kg+'&pvc_dia='+pvc_dia+'&avg_class='+avg_class+'&avg_dia='+avg_dia+'&avg_color='+avg_color+'&avg_thick='+avg_thick+'&chk_out='+chk_out+'&avg_out='+avg_out+'&chk_mea='+chk_mea+'&avg_mea='+avg_mea+'&chk_any='+chk_any+'&avg_any='+avg_any+'&chk_pre='+chk_pre+'&avg_pre='+avg_pre+'&ulr='+ulr;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_pvc_pipe.php',
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
        url: '<?php echo $base_url; ?>save_pvc_pipe.php',
       data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#pvc_kg').val(data.pvc_kg);
			$('#pvc_dia').val(data.pvc_dia);
			$('#avg_class').val(data.avg_class);
			$('#avg_color').val(data.avg_color);
			$('#avg_thick').val(data.avg_thick);
			$('#avg_dia').val(data.avg_dia);
           var temp = $('#test_list').val();
		   var aa= temp.split(",");
         
			//out
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="out")
				{
					$('#avg_out').val(data.avg_out);
					var chk_out = data.chk_out;
					if(chk_out=="1")
					{
					   $('#txtout').css("background-color","var(--success)");			
					   $("#chk_out").prop("checked", true); 
					}else{
						$('#txtout').css("background-color","white");			
						$("#chk_out").prop("checked", false); 
					}	
					break;
				}
				else
				{
				
				}
			}
			
			//mea
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="mea")
				{
					$('#avg_mea').val(data.avg_mea);
					var chk_mea = data.chk_mea;
					if(chk_mea=="1")
					{
					   $('#txtmea').css("background-color","var(--success)");			
					   $("#chk_mea").prop("checked", true); 
					}else{
						$('#txtmea').css("background-color","white");			
						$("#chk_mea").prop("checked", false); 
					}	
					break;
				}
				else
				{
				
				}
			}
			
			//any
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="any")
				{
					$('#avg_any').val(data.avg_any);
					var chk_any = data.chk_any;
					if(chk_any=="1")
					{
					   $('#txtany').css("background-color","var(--success)");			
					   $("#chk_any").prop("checked", true); 
					}else{
						$('#txtany').css("background-color","white");			
						$("#chk_any").prop("checked", false); 
					}	
					break;
				}
				else
				{
				
				}
			}
			
			//pre
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="pre")
				{
					$('#avg_pre').val(data.avg_pre);
					var chk_pre = data.chk_pre;
					if(chk_pre=="1")
					{
						$('#txtpre').css("background-color","var(--success)");			
						$("#chk_pre").prop("checked", true); 
					}else{
						$('#txtpre').css("background-color","white");			
						$("#chk_pre").prop("checked", false); 
					}	
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