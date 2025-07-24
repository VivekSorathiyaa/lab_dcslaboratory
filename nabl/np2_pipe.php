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
					$np_dia= $row_select4['np_dia'];
					
					
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
							<h2  style="text-align:center;">RCC PIPES</h2>
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
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
										<div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="np_dia" value="<?php echo $np_dia;?>" name="np_dia" ReadOnly>
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
												$querys_job1 = "SELECT * FROM np2_pipe WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_np2_pipe.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>
										<!--<div class="col-sm-2">
											
											<a target = '_blank' href="<?php //echo $base_url; ?>back_cal_report/print_np2_pipe.php?job_no=<?php// echo $_GET['job_no'];?>&&report_no=<?php //echo $_GET['report_no'];?>&&lab_no=<?php //echo $_GET['lab_no'];?>&&trf_no=<?php //echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Report</b></a>
										</div>-->
										<?php// } ?>
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
									
									if($r1['test_code']=="dia")
									{
										$test_check.="dia,";
									?>
								
								<div class="panel panel-default" id="dia">
									<div class="panel-heading" id="txtdia">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
												<h4 class="panel-title">
												<b>DIAMETER</b>
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
																	<label for="chk_dia">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_dia"  id="chk_dia" value="chk_dia"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">DIAMETER</label>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">DiaMeter of Pipe</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="avg_dia" name="avg_dia">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
											
										</div>
									</div>
								</div>
								<?php }if($r1['test_code']=="col")
									{
										$test_check.="col,";
									?>
								
								<div class="panel panel-default" id="col">
									<div class="panel-heading" id="txtcol">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsecol">
												<h4 class="panel-title">
												<b>COLLAR DIMENTION</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapsecol" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_col">2.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_col"  id="chk_col" value="chk_col"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">COLLAR DIMENTION</label>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Minimum Caulking </label>	
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="col1" name="col1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Minimum Thickness </label>	
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="col2" name="col2">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Minimum Length </label>	
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="col3" name="col3">
															</div>
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
								<?php }
								else if($r1['test_code']=="thk")
								{ $test_check.="thk,";
							
								?>
								
								<div class="panel panel-default" id="thk">
									<div class="panel-heading" id="txtthk">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse21">
												<h4 class="panel-title">
												<b>THICKNESS</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapse21" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_thk">3.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_thk"  id="chk_thk" value="chk_thk"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">THICKNESS</label>
															<input type="hidden" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="thickness" name="thickness">
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Barrel Wall  Thickness</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="avg_thk" name="avg_thk">
																	</div>
														</div>
													</div>
												</div>
												<br>
										
											
										</div>
									</div>
								</div>
								<?php }
								else if($r1['test_code']=="ini")
								{ $test_check.="ini,";
							
								?>
								<div class="panel panel-default" id="ini">
									<div class="panel-heading" id="txtini">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseini">
												<h4 class="panel-title">
												<b>INTERNAL DIAMETER OF PIPE</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapseini" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_ini">4.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_ini"  id="chk_ini" value="chk_ini"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">INTERNAL DIAMETER OF PIPE</label>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-6">  
														<div class="form-group">											
															<div class="col-md-3">
																<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Nominal</label>	
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="ini1" name="ini1">
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-6">  
														<div class="form-group">											
															<div class="col-md-3">
																<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Actual</label>	
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="ini2" name="ini2">
															</div>
														</div>
													</div>
												</div>
												<br>
										
											
										</div>
									</div>
								</div>
								<?php }
								else if($r1['test_code']=="str")
								{ $test_check.="str,";
							
								?>
								<div class="panel panel-default" id="str">
									<div class="panel-heading" id="txtstr">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsestr">
												<h4 class="panel-title">
												<b>CRUSHING STRENGTH</b>
												</h4>
											</a>
										</h4>
									</div>
									<div id="collapsestr" class="panel-collapse collapse">
										<div class="panel-body">
											<br>
												<div class="row">									
													<div class="col-lg-12">
														<div class="form-group">
																<div class="col-sm-1">
																	<label for="chk_str">5.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_str"  id="chk_str" value="chk_str"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">CRUSHING STRENGTH</label>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">Crushing strength</label>	
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="avg_str" name="avg_str">
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
							 $query = "select * from np2_pipe WHERE lab_no='$aa'  and `is_deleted`='0'";

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
})

function dia_auto(){
	$('#txtdia').css("background-color","var(--success)");
	var np_dia = $('#np_dia').val();
		
	$('#avg_dia').val(np_dia.replace("mm",''));
		
}
$('#chk_dia').change(function(){
    if(this.checked)
	{
		dia_auto();	
	}
	else
	{
		$('#txtdia').css("background-color","white");
		$('#avg_dia').val(null);
	}
});

function col_auto(){
	$('#txtcol').css("background-color","var(--success)");
	var np_dia = $('#np_dia').val();
	if(np_dia=="80 mm"){
		$('#col1').val("13");
		$('#col2').val("25");
		$('#col3').val("150");
	}else if(np_dia=="100 mm"){
		$('#col1').val("13");
		$('#col2').val("25");
		$('#col3').val("150");
	}else if(np_dia=="150 mm"){
		$('#col1').val("13");
		$('#col2').val("25");
		$('#col3').val("150");
	}else if(np_dia=="200 mm"){
		$('#col1').val("13");
		$('#col2').val("25");
		$('#col3').val("150");
	}else if(np_dia=="225 mm"){
		$('#col1').val("13");
		$('#col2').val("25");
		$('#col3').val("150");
	}else if(np_dia=="250 mm"){
		$('#col1').val("13");
		$('#col2').val("25");
		$('#col3').val("150");
	}else if(np_dia=="300 mm"){
		$('#col1').val("16");
		$('#col2').val("30");
		$('#col3').val("150");
	}else if(np_dia=="350 mm"){
		$('#col1').val("16");
		$('#col2').val("32");
		$('#col3').val("150");
	}else if(np_dia=="400 mm"){
		$('#col1').val("16");
		$('#col2').val("32");
		$('#col3').val("150");
	}else if(np_dia=="450 mm"){
		$('#col1').val("19");
		$('#col2').val("35");
		$('#col3').val("200");
	}else if(np_dia=="500 mm"){
		$('#col1').val("19");
		$('#col2').val("35");
		$('#col3').val("200");
	}else if(np_dia=="600 mm"){
		$('#col1').val("19");
		$('#col2').val("40");
		$('#col3').val("200");
	}else if(np_dia=="700 mm"){
		$('#col1').val("19");
		$('#col2').val("40");
		$('#col3').val("200");
	}else if(np_dia=="800 mm"){
		$('#col1').val("19");
		$('#col2').val("45");
		$('#col3').val("200");
	}else if(np_dia=="900 mm"){
		$('#col1').val("19");
		$('#col2').val("50");
		$('#col3').val("200");
	}else if(np_dia=="1000 mm"){
		$('#col1').val("19");
		$('#col2').val("55");
		$('#col3').val("200");
	}else if(np_dia=="1100 mm"){
		$('#col1').val("19");
		$('#col2').val("60");
		$('#col3').val("200");
	}else if(np_dia=="1200 mm"){
		$('#col1').val("19");
		$('#col2').val("65");
		$('#col3').val("200");
	}else if(np_dia=="1400 mm"){
		$('#col1').val("19");
		$('#col2').val("75");
		$('#col3').val("200");
	}else if(np_dia=="1600 mm"){
		$('#col1').val("19");
		$('#col2').val("80");
		$('#col3').val("200");
	}else if(np_dia=="1800 mm"){
		$('#col1').val("19");
		$('#col2').val("90");
		$('#col3').val("200");
	}else if(np_dia=="2000 mm"){
		$('#col1').val("19");
		$('#col2').val("100");
		$('#col3').val("200");
	}else if(np_dia=="2200 mm"){
		$('#col1').val("19");
		$('#col2').val("110");
		$('#col3').val("200");
	}
	
	
}
$('#chk_col').change(function(){
    if(this.checked)
	{
		col_auto();	
	}
	else
	{
		$('#txtcol').css("background-color","white");
		$('#col1').val(null);
		$('#col2').val(null);
		$('#col3').val(null);
	}
});

function thk_auto(){
	$('#txtthk').css("background-color","var(--success)");
	var np_dia = $('#np_dia').val();
	if(np_dia=="80 mm"){
		$('#avg_thk').val("25");
		
	}else if(np_dia=="100 mm"){
		$('#avg_thk').val("25");
	}else if(np_dia=="150 mm"){
		$('#avg_thk').val("25");
	}else if(np_dia=="200 mm"){
		$('#avg_thk').val("25");
	}else if(np_dia=="225 mm"){
		$('#avg_thk').val("25");
	}else if(np_dia=="250 mm"){
		$('#avg_thk').val("25");
	}else if(np_dia=="300 mm"){
		$('#avg_thk').val("30");
	}else if(np_dia=="350 mm"){
		$('#avg_thk').val("32");
	}else if(np_dia=="400 mm"){
		$('#avg_thk').val("32");
	}else if(np_dia=="450 mm"){
		$('#avg_thk').val("35");
	}else if(np_dia=="500 mm"){
		$('#avg_thk').val("35");
	}else if(np_dia=="600 mm"){
		$('#avg_thk').val("45");
	}else if(np_dia=="700 mm"){
		$('#avg_thk').val("50");
	}else if(np_dia=="800 mm"){
		$('#avg_thk').val("50");
	}else if(np_dia=="900 mm"){
		$('#avg_thk').val("55");
	}else if(np_dia=="1000 mm"){
		$('#avg_thk').val("60");
	}else if(np_dia=="1100 mm"){
		$('#avg_thk').val("65");
	}else if(np_dia=="1200 mm"){
		$('#avg_thk').val("70");
	}else if(np_dia=="1400 mm"){
		$('#avg_thk').val("75");
	}else if(np_dia=="1600 mm"){
		$('#avg_thk').val("80");
	}else if(np_dia=="1800 mm"){
		$('#avg_thk').val("90");
	}else if(np_dia=="2000 mm"){
		$('#avg_thk').val("100");
	}else if(np_dia=="2200 mm"){
		$('#avg_thk').val("110");
	}
}
$('#chk_thk').change(function(){
    if(this.checked)
	{
		thk_auto();	
	}
	else
	{
		$('#txtthk').css("background-color","white");
		$('#avg_thk').val(null);
	}
});

function ini_auto(){
	$('#txtini').css("background-color","var(--success)");
	var np_dia = $('#np_dia').val();
	if(np_dia=="80 mm"){
		$('#ini1').val("80");
		$('#ini2').val(randomNumberFromRange(80,83).toFixed());
	}else if(np_dia=="100 mm"){
		$('#ini1').val("100");
		$('#ini2').val(randomNumberFromRange(100,103).toFixed());
	}else if(np_dia=="150 mm"){
		$('#ini1').val("150");
		$('#ini2').val(randomNumberFromRange(150,153).toFixed());
	}else if(np_dia=="200 mm"){
		$('#ini1').val("200");
		$('#ini2').val(randomNumberFromRange(198,204).toFixed());
	}else if(np_dia=="225 mm"){
		$('#ini1').val("225");
		$('#ini2').val(randomNumberFromRange(223,225).toFixed());
	}else if(np_dia=="250 mm"){
		$('#ini1').val("250");
		$('#ini2').val(randomNumberFromRange(248,252).toFixed());
	}else if(np_dia=="300 mm"){
		$('#ini1').val("300");
		$('#ini2').val(randomNumberFromRange(298,302).toFixed());
	}else if(np_dia=="350 mm"){
		$('#ini1').val("350");
		$('#ini2').val(randomNumberFromRange(348,352).toFixed());
	}else if(np_dia=="400 mm"){
		$('#ini1').val("400");
		$('#ini2').val(randomNumberFromRange(398,402).toFixed());
	}else if(np_dia=="450 mm"){
		$('#ini1').val("450");
		$('#ini2').val(randomNumberFromRange(448,452).toFixed());
	}else if(np_dia=="500 mm"){
		$('#ini1').val("500");
		$('#ini2').val(randomNumberFromRange(498,502).toFixed());
	}else if(np_dia=="600 mm"){
		$('#ini1').val("600");
		$('#ini2').val(randomNumberFromRange(598,602).toFixed());
	}else if(np_dia=="700 mm"){
		$('#ini1').val("700");
		$('#ini2').val(randomNumberFromRange(695,705).toFixed());
	}else if(np_dia=="800 mm"){
		$('#ini1').val("800");
		$('#ini2').val(randomNumberFromRange(795,805).toFixed());
	}else if(np_dia=="900 mm"){
		$('#ini1').val("900");
		$('#ini2').val(randomNumberFromRange(895,905).toFixed());
	}else if(np_dia=="1000 mm"){
		$('#ini1').val("1000");
		$('#ini2').val(randomNumberFromRange(995,1005).toFixed());
	}else if(np_dia=="1100 mm"){
		$('#ini1').val("1100");
		$('#ini2').val(randomNumberFromRange(1095,1105).toFixed());
	}else if(np_dia=="1200 mm"){
		$('#ini1').val("1200");
		$('#ini2').val(randomNumberFromRange(1195,1205).toFixed());
	}else if(np_dia=="1400 mm"){
		$('#ini1').val("1400");
		$('#ini2').val(randomNumberFromRange(1395,1405).toFixed());
	}else if(np_dia=="1600 mm"){
		$('#ini1').val("1600");
		$('#ini2').val(randomNumberFromRange(1595,1605).toFixed());
	}else if(np_dia=="1800 mm"){
		$('#ini1').val("1800");
		$('#ini2').val(randomNumberFromRange(1795,1805).toFixed());
	}else if(np_dia=="2000 mm"){
		$('#ini1').val("2000");
		$('#ini2').val(randomNumberFromRange(1995,2005).toFixed());
	}else if(np_dia=="2200 mm"){
		$('#ini1').val("2200");
		$('#ini2').val(randomNumberFromRange(2195,2205).toFixed());
	}
}
$('#chk_ini').change(function(){
    if(this.checked)
	{
		ini_auto();	
	}
	else
	{
		$('#txtini').css("background-color","white");
		$('#ini1').val(null);
		$('#ini2').val(null);
	}
});

function str_auto(){
	$('#txtstr').css("background-color","var(--success)");
	var np_dia = $('#np_dia').val();
	if(np_dia=="80 mm"){
		
		$('#avg_str').val(randomNumberFromRange(10.03,10.07).toFixed(2));
	}else if(np_dia=="100 mm"){
		
		$('#avg_str').val(randomNumberFromRange(10.03,10.07).toFixed(2));
	}else if(np_dia=="150 mm"){
		
		$('#avg_str').val(randomNumberFromRange(10.76,10.80).toFixed(2));
	}else if(np_dia=="200 mm"){
		
		$('#avg_str').val(randomNumberFromRange(11.76,11.80).toFixed(2));
	}else if(np_dia=="225 mm"){
	
		$('#avg_str').val(randomNumberFromRange(12.24,12.28).toFixed(2));
	}else if(np_dia=="250 mm"){
		
		$('#avg_str').val(randomNumberFromRange(12.53,12.56).toFixed(2));
	}else if(np_dia=="300 mm"){
	
		$('#avg_str').val(randomNumberFromRange(13.46,13.52).toFixed(2));
	}else if(np_dia=="350 mm"){
	
		$('#avg_str').val(randomNumberFromRange(14.40,14.50).toFixed(2));
	}else if(np_dia=="400 mm"){
	
		$('#avg_str').val(randomNumberFromRange(15.40,15.50).toFixed(2));
	}else if(np_dia=="450 mm"){
	
		$('#avg_str').val(randomNumberFromRange(16.10,16.22).toFixed(2));
	}else if(np_dia=="500 mm"){
	
		$('#avg_str').val(randomNumberFromRange(17.10,17.20).toFixed(2));
	}else if(np_dia=="600 mm"){
		
		$('#avg_str').val(randomNumberFromRange(18.80,18.90).toFixed(2));
	}else if(np_dia=="700 mm"){
		
		$('#avg_str').val(randomNumberFromRange(20.30,20.40).toFixed(2));
	}else if(np_dia=="800 mm"){
		
		$('#avg_str').val(randomNumberFromRange(21.55,21.60).toFixed(2));
	}else if(np_dia=="900 mm"){
		
		$('#avg_str').val(randomNumberFromRange(22.75,22.85).toFixed(2));
	}else if(np_dia=="1000 mm"){
		
		$('#avg_str').val(randomNumberFromRange(24.22,24.30).toFixed(2));
	}else if(np_dia=="1100 mm"){
		
		$('#avg_str').val(randomNumberFromRange(25.45,25.55).toFixed(2));
	}else if(np_dia=="1200 mm"){
		
		$('#avg_str').val(randomNumberFromRange(26.95,27.05).toFixed(2));
	}else if(np_dia=="1400 mm"){
		
		$('#avg_str').val(randomNumberFromRange(29.38,29.43).toFixed(2));
	}else if(np_dia=="1600 mm"){
		
		$('#avg_str').val(randomNumberFromRange(32.10,32.18).toFixed(2));
	}else if(np_dia=="1800 mm"){
		
		$('#avg_str').val(randomNumberFromRange(35.00,35.10).toFixed(2));
	}else if(np_dia=="2000 mm"){
		
		$('#avg_str').val(randomNumberFromRange(37.70,3.80).toFixed(2));
	}else if(np_dia=="2200 mm"){
		
		$('#avg_str').val(randomNumberFromRange(40.15,40.25).toFixed(2));
	}
}
$('#chk_str').change(function(){
    if(this.checked)
	{
		str_auto();	
	}
	else
	{
		$('#txtstr').css("background-color","white");
		$('#avg_str').val(null);
	}
});

$('#chk_auto').change(function(){
        if(this.checked)
		{ 
			var temp = $('#test_list').val();
			var aa= temp.split(",");
			
			//dia
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="dia")
				{
					$("#chk_dia").prop("checked", true); 
					dia_auto();
					break;
				}					
			}
			
			//thk
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="thk")
				{
					$("#chk_thk").prop("checked", true); 
					thk_auto();
					break;
				}					
			}
			
			//col
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="col")
				{
					$("#chk_col").prop("checked", true); 
					col_auto();
					break;
				}					
			}

			//ini
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="ini")
				{
					$("#chk_ini").prop("checked", true); 
					ini_auto();
					break;
				}					
			}
			//str
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="str")
				{
					$("#chk_str").prop("checked", true); 
					str_auto();
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
        url: '<?php echo $base_url; ?>save_np2_pipe.php',
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
				var np_dia = $('#np_dia').val();
				var temp = $('#test_list').val();
				var aa= temp.split(",");			
				
				//dia
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dia")
					{
						
							if(document.getElementById('chk_dia').checked) {
									var chk_dia = "1";
							}
							else{
									var chk_dia = "0";
							}
							//impact value-3
							var avg_dia = $('#avg_dia').val();							
							break;
					}
					else
					{
						var chk_dia = "0";	
						var avg_dia ="0";
						
					}

				}
				
				
				//thickness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="thk")
					{
						
							if(document.getElementById('chk_thk').checked) {
									var chk_thk = "1";
							}
							else{
									var chk_thk = "0";
							}
							//impact value-3
							var avg_thk = $('#avg_thk').val();							
							break;
					}
					else
					{
						var chk_thk = "0";	
						var avg_thk ="0";
						
					}

				}
				
				
				//ini
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ini")
					{
						
							if(document.getElementById('chk_ini').checked) {
									var chk_ini = "1";
							}
							else{
									var chk_ini = "0";
							}
							//impact value-3
							var ini1 = $('#ini1').val();							
							var ini2 = $('#ini2').val();							
							break;
					}
					else
					{
						var chk_ini = "0";	
						var ini1 ="0";
						var ini2 ="0";
						
					}

				}
				//col
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="col")
					{
						
							if(document.getElementById('chk_col').checked) {
									var chk_col = "1";
							}
							else{
									var chk_col = "0";
							}
							
							var col1 = $('#col1').val();							
							var col2 = $('#col2').val();							
							var col3 = $('#col3').val();							
							break;
					}
					else
					{
						var chk_col = "0";	
						var col1 ="0";
						var col2 ="0";
						var col3 ="0";
						
					}
				}
				
				//str
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="str")
					{
						
							if(document.getElementById('chk_str').checked) {
									var chk_str = "1";
							}
							else{
									var chk_str = "0";
							}
							
							var avg_str = $('#avg_str').val();							
							break;
					}
					else
					{
						var chk_str = "0";	
						var avg_str ="0";
						
					}
				}
				
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&ulr='+ulr+'&chk_dia='+chk_dia+'&np_dia='+np_dia+'&avg_dia='+avg_dia+'&chk_col='+chk_col+'&col1='+col1+'&col2='+col2+'&col3='+col3+'&chk_thk='+chk_thk+'&avg_thk='+avg_thk+'&chk_ini='+chk_ini+'&ini1='+ini1+'&ini2='+ini2+'&chk_str='+chk_str+'&avg_str='+avg_str;
				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				var np_dia = $('#np_dia').val();
				var temp = $('#test_list').val();
				var aa= temp.split(",");			
				//dia
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dia")
					{
						
							if(document.getElementById('chk_dia').checked) {
									var chk_dia = "1";
							}
							else{
									var chk_dia = "0";
							}
							//impact value-3
							var avg_dia = $('#avg_dia').val();							
							break;
					}
					else
					{
						var chk_dia = "0";	
						var avg_dia ="0";
						
					}

				}
				
				
				//thickness
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="thk")
					{
						
							if(document.getElementById('chk_thk').checked) {
									var chk_thk = "1";
							}
							else{
									var chk_thk = "0";
							}
							//impact value-3
							var avg_thk = $('#avg_thk').val();							
							break;
					}
					else
					{
						var chk_thk = "0";	
						var avg_thk ="0";
						
					}

				}
				
				
				//ini
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ini")
					{
						
							if(document.getElementById('chk_ini').checked) {
									var chk_ini = "1";
							}
							else{
									var chk_ini = "0";
							}
							//impact value-3
							var ini1 = $('#ini1').val();							
							var ini2 = $('#ini2').val();							
							break;
					}
					else
					{
						var chk_ini = "0";	
						var ini1 ="0";
						var ini2 ="0";
						
					}

				}
				//col
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="col")
					{
						
							if(document.getElementById('chk_col').checked) {
									var chk_col = "1";
							}
							else{
									var chk_col = "0";
							}
							
							var col1 = $('#col1').val();							
							var col2 = $('#col2').val();							
							var col3 = $('#col3').val();							
							break;
					}
					else
					{
						var chk_col = "0";	
						var col1 ="0";
						var col2 ="0";
						var col3 ="0";
						
					}
				}
				
				//str
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="str")
					{
						
							if(document.getElementById('chk_str').checked) {
									var chk_str = "1";
							}
							else{
									var chk_str = "0";
							}
							
							var avg_str = $('#avg_str').val();							
							break;
					}
					else
					{
						var chk_str = "0";	
						var avg_str ="0";
						
					}
				}
				
								
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&ulr='+ulr+'&np_dia='+np_dia+'&chk_dia='+chk_dia+'&avg_dia='+avg_dia+'&chk_col='+chk_col+'&col1='+col1+'&col2='+col2+'&col3='+col3+'&chk_thk='+chk_thk+'&avg_thk='+avg_thk+'&chk_ini='+chk_ini+'&ini1='+ini1+'&ini2='+ini2+'&chk_str='+chk_str+'&avg_str='+avg_str;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_np2_pipe.php',
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
        url: '<?php echo $base_url; ?>save_np2_pipe.php',
       data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#np_dia').val(data.np_dia);
           var temp = $('#test_list').val();
			var aa= temp.split(",");
           //dia
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="dia")
					{
						
							//impact value
							$('#avg_dia').val(data.avg_dia);
							
							var chk_dia = data.chk_dia;
           
							if(chk_dia=="1")
							{
							   $('#txtdia').css("background-color","var(--success)");			
							   $("#chk_dia").prop("checked", true); 
							}else{
								$('#txtdia').css("background-color","white");			
								$("#chk_dia").prop("checked", false); 
							}	
							break;
					}
					else
					{
					
					}

				}
				
				
				//thk
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="thk")
					{
						
							//impact value
							$('#avg_thk').val(data.avg_thk);
							
							var chk_thk = data.chk_thk;
           
							if(chk_thk=="1")
							{
							   $('#txtthk').css("background-color","var(--success)");			
							   $("#chk_thk").prop("checked", true); 
							}else{
								$('#txtthk').css("background-color","white");			
								$("#chk_thk").prop("checked", false); 
							}	
							break;
					}
					else
					{
					
					}

				}
				
				//ini
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="ini")
					{
						
							//impact value
							$('#ini1').val(data.ini1);
							$('#ini2').val(data.ini2);
							
							var chk_ini = data.chk_ini;
           
							if(chk_ini=="1")
							{
							   $('#txtini').css("background-color","var(--success)");			
							   $("#chk_ini").prop("checked", true); 
							}else{
								$('#txtini').css("background-color","white");			
								$("#chk_ini").prop("checked", false); 
							}	
							break;
					}
					else
					{
					
					}

				}
				
				//col
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="col")
					{
						
							//impact value
							$('#col1').val(data.col1);
							$('#col2').val(data.col2);
							$('#col3').val(data.col3);
							
							var chk_col = data.chk_col;
           
							if(chk_col=="1")
							{
							   $('#txtcol').css("background-color","var(--success)");			
							   $("#chk_col").prop("checked", true); 
							}else{
								$('#txtcol').css("background-color","white");			
								$("#chk_col").prop("checked", false); 
							}	
							break;
					}
					else
					{
					
					}
				}
				
				//str
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="str")
					{
						
							//impact value
							$('#avg_str').val(data.avg_str);
							
							var chk_str = data.chk_str;
           
							if(chk_str=="1")
							{
							   $('#txtstr').css("background-color","var(--success)");			
							   $("#chk_str").prop("checked", true); 
							}else{
								$('#txtstr').css("background-color","white");			
								$("#chk_str").prop("checked", false); 
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