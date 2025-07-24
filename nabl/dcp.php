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
							<h2  style="text-align:center;">DCP TEST</h2>
						</div>
						<!--<div class="box-default">-->
						<form class="form" id="Glazed" method="post">
							<!-- REPORT NO AND JOB NO PUT VAIBHAV-->
							<div class="row">
								<br>
								<div class="col-lg-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="report_no" value="<?php echo $report_no;?>" name="report_no" ReadOnly >
										</div>
									</div>
								</div>
								<div class="col-lg-5">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Job No.:</label>
										<div class="col-sm-10">											
											<input type="text" class="form-control" tabindex="1"  value="<?php echo $job_no;?>" id="job_no" name="job_no" ReadOnly>
										</div>
									</div>												
								</div>
								<div class="col-lg-3">
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
							<!-- </div> -->
							<br>
							<!-- LAB NO PUT VAIBHAV-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										 <div class="col-sm-2">
													<label for="chk_auto">Lab No. :</label>
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
												$querys_job1 = "SELECT * FROM dcp WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
										if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
										?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_dcp.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
											
										</div>
										
										
										<?php } ?>
										<div class="col-sm-2">
											
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_dcp.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>&&ulr=<?php echo $_GET['ulr'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Report</b></a>
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
									
									if($r1['test_code']=="cbr")
									{
										$test_check.="cbr,";
									?>
								
								<div class="panel panel-default" id="den">
									<div class="panel-heading" id="txtden">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
												<h4 class="panel-title">
												<b>DYNAMIC CONE PENETROMETER TEST</b>
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
																	<label for="chk_cbr">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_cbr"  id="chk_cbr" value="chk_cbr"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">DYNAMIC CONE PENETROMETER TEST</label>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="control-label" >Layer Of Material</label>	
															</div>
															
															<div class="col-md-3">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="layer_mt" name="layer_mt">												
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="control-label" >Field Moisture</label>	
															</div>
															
															<div class="col-md-3">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="field_mos" name="field_mos">												
															</div>
															
															
														</div>
													</div>
												</div>
												<br>
												<br>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >DCP BLOWS</label>	
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >Scale Reading (mm)</label>												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >DCP BLOWS</label>	
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >Scale Reading (mm)</label>												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >DCP BLOWS</label>	
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >Scale Reading (mm)</label>												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >DCP BLOWS</label>	
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >Scale Reading (mm)</label>												
															</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >0</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_0" name="hsr_0">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >13</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_13" name="hsr_13">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >26</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_26" name="hsr_26">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >39</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_39" name="hsr_39">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >1</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_1" name="hsr_1">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >14</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_14" name="hsr_14">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >27</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_27" name="hsr_27">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >40</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_40" name="hsr_40">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >2</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_2" name="hsr_2">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >15</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_15" name="hsr_15">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >28</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_28" name="hsr_28">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >41</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_41" name="hsr_41">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >3</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_3" name="hsr_3">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >16</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_16" name="hsr_16">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >29</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_29" name="hsr_29">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >42</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_42" name="hsr_42">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >4</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_4" name="hsr_4">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >17</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_17" name="hsr_17">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >30</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_30" name="hsr_30">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >43</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_43" name="hsr_43">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >5</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_5" name="hsr_5">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >18</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_18" name="hsr_18">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >31</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_31" name="hsr_31">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >44</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_44" name="hsr_44">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >6</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_6" name="hsr_6">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >19</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_19" name="hsr_19">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >32</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_32" name="hsr_32">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >45</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_45" name="hsr_45">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >7</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_7" name="hsr_7">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >20</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_20" name="hsr_20">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >33</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_33" name="hsr_33">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >46</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_46" name="hsr_46">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >8</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_8" name="hsr_8">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >21</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_21" name="hsr_21">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >34</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_34" name="hsr_34">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >47</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_47" name="hsr_47">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >9</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_9" name="hsr_9">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >22</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_22" name="hsr_22">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >35</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_35" name="hsr_35">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >48</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_48" name="hsr_48">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >10</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_10" name="hsr_10">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >23</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_23" name="hsr_23">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >36</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_36" name="hsr_36">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >49</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_49" name="hsr_49">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >11</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_11" name="hsr_11">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >24</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_24" name="hsr_24">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >37</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_37" name="hsr_37">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >50</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_50" name="hsr_50">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >12</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_12" name="hsr_12">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >25</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_25" name="hsr_25">												
															</div>
															
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >38</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_38" name="hsr_38">												
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >51</label>	
															</div>
															
															<div class="col-md-1">
															<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="hsr_51" name="hsr_51">												
															</div>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >DCP BLOW<br>FROM</label>	
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >DCP BLOW<br>TO</label>	
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >SCALE READING (MM)</label>
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >INCREMENTAL PENETRATION (MM)</label>														
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >PENETRATION BETWEEN BLOW (MM)</label>														
															</div>
															<div class="col-md-1">
															<label for="inputEmail3" class="control-label" >PENETRATION PER BLOW (DCP VALUE) mm/Blow</label>														
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="control-label" >AVERAGE DCP</label>														
															</div>
															<div class="col-md-3">
															<label for="inputEmail3" class="control-label" >CBR VALUE ACCORDING TO THE IRC 37,2012</label>														
															</div>
															
														</div>
													</div>
												</div>	
											<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">															
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="f1" name="f1">
															</div>
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="t1" name="t1">
															</div>
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="s1" name="s1">
															</div>
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="p1" name="p1">
															</div>
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="b1" name="b1">
															</div>
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="c1" name="c1">
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="avg_c" name="avg_c">
															</div>
															<div class="col-md-3"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="cbr" name="cbr">
															</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">															
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="f2" name="f2">
															</div>
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="t2" name="t2">
															</div>
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="s2" name="s2">
															</div>
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="p2" name="p2">
															</div>
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="b2" name="b2">
															</div>
															<div class="col-md-1"> 
																<input type="text" style="text-align:center;" class="form-control inputs" tabindex="4" id="c2" name="c2">
															</div>
															<div class="col-md-3"> 
																
															</div>
															<div class="col-md-3"> 
																
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
							 $query = "select * from dcp WHERE lab_no='$aa'  and `is_deleted`='0'";

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
	
	$('#chk_cbr').change(function(){
        if(this.checked)
		{ $('#txtden').css("background-color","var(--success)"); 
		}
		else
		{
			 $('#txtden').css("background-color","White"); 
		}
	});
	
	
	$('#f1').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#f2').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#t1').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#t2').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#s1').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#s2').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#p1').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#p2').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#b1').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#b2').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#c1').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#c2').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#avg_c').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
	});
	$('#cbr').change(function(){
		
			 $('#txtden').css("background-color","var(--success)");			
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
        url: '<?php echo $base_url; ?>save_dcp.php',
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
						
				if(document.getElementById('chk_cbr').checked) {
									var chk_cbr = "1";
								}
								else{
									var chk_cbr = "0";
								}
				
				
				var f1 = $('#f1').val();
				var f2 = $('#f2').val();
				var t1 = $('#t1').val();
				var t2 = $('#t2').val();
				var s1 = $('#s1').val();
				var s2 = $('#s2').val();
				var p1 = $('#p1').val();
				var p2 = $('#p2').val();
				var b1 = $('#b1').val();
				var b2 = $('#b2').val();
				var c1 = $('#c1').val();
				var c2 = $('#c2').val();
				var avg_c = $('#avg_c').val();
				var cbr = $('#cbr').val();
				var layer_mt = $('#layer_mt').val();
				var field_mos = $('#field_mos').val();
				var hsr_0 = $('#hsr_0').val();
				var hsr_1 = $('#hsr_1').val();
				var hsr_2 = $('#hsr_2').val();
				var hsr_3 = $('#hsr_3').val();
				var hsr_4 = $('#hsr_4').val();
				var hsr_5 = $('#hsr_5').val();
				var hsr_6 = $('#hsr_6').val();
				var hsr_7 = $('#hsr_7').val();
				var hsr_8 = $('#hsr_8').val();
				var hsr_9 = $('#hsr_9').val();
				var hsr_10 = $('#hsr_10').val();
				var hsr_11 = $('#hsr_11').val();
				var hsr_12 = $('#hsr_12').val();
				var hsr_13 = $('#hsr_13').val();
				var hsr_14 = $('#hsr_14').val();
				var hsr_15 = $('#hsr_15').val();
				var hsr_16 = $('#hsr_16').val();
				var hsr_17 = $('#hsr_17').val();
				var hsr_18 = $('#hsr_18').val();
				var hsr_19 = $('#hsr_19').val();
				var hsr_20 = $('#hsr_20').val();
				var hsr_21 = $('#hsr_21').val();
				var hsr_22 = $('#hsr_22').val();
				var hsr_23 = $('#hsr_23').val();
				var hsr_24 = $('#hsr_24').val();
				var hsr_25 = $('#hsr_25').val();
				var hsr_26 = $('#hsr_26').val();
				var hsr_27 = $('#hsr_27').val();
				var hsr_28 = $('#hsr_28').val();
				var hsr_29 = $('#hsr_29').val();
				var hsr_30 = $('#hsr_30').val();
				var hsr_31 = $('#hsr_31').val();
				var hsr_32 = $('#hsr_32').val();
				var hsr_33 = $('#hsr_33').val();
				var hsr_34 = $('#hsr_34').val();
				var hsr_35 = $('#hsr_35').val();
				var hsr_36 = $('#hsr_36').val();
				var hsr_37 = $('#hsr_37').val();
				var hsr_38 = $('#hsr_38').val();
				var hsr_39 = $('#hsr_39').val();
				var hsr_40 = $('#hsr_40').val();
				var hsr_41 = $('#hsr_41').val();
				
				
				
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_cbr='+chk_cbr+'&f1='+f1+'&f2='+f2+'&t1='+t1+'&t2='+t2+'&s1='+s1+'&s2='+s2+'&p1='+p1+'&p2='+p2+'&b1='+b1+'&b2='+b2+'&c1='+c1+'&c2='+c2+'&avg_c='+avg_c+'&cbr='+cbr+'&ulr='+ulr+'&layer_mt='+layer_mt+'&field_mos='+field_mos+'&hsr_0='+hsr_0+'&hsr_1='+hsr_1+'&hsr_2='+hsr_2+'&hsr_3='+hsr_3+'&hsr_4='+hsr_4+'&hsr_5='+hsr_5+'&hsr_6='+hsr_6+'&hsr_7='+hsr_7+'&hsr_8='+hsr_8+'&hsr_9='+hsr_9+'&hsr_10='+hsr_10+'&hsr_11='+hsr_11+'&hsr_12='+hsr_12+'&hsr_13='+hsr_13+'&hsr_14='+hsr_14+'&hsr_15='+hsr_15+'&hsr_16='+hsr_16+'&hsr_17='+hsr_17+'&hsr_18='+hsr_18+'&hsr_19='+hsr_19+'&hsr_20='+hsr_20+'&hsr_21='+hsr_21+'&hsr_22='+hsr_22+'&hsr_23='+hsr_23+'&hsr_24='+hsr_24+'&hsr_25='+hsr_25+'&hsr_26='+hsr_26+'&hsr_27='+hsr_27+'&hsr_28='+hsr_28+'&hsr_29='+hsr_29+'&hsr_30='+hsr_30+'&hsr_31='+hsr_31+'&hsr_32='+hsr_32+'&hsr_33='+hsr_33+'&hsr_34='+hsr_34+'&hsr_35='+hsr_35+'&hsr_36='+hsr_36+'&hsr_37='+hsr_37+'&hsr_38='+hsr_38+'&hsr_39='+hsr_39+'&hsr_40='+hsr_40+'&hsr_41='+hsr_41+'&amend_date='+amend_date;
				
				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				var amend_date = $('#amend_date').val();
							
				if(document.getElementById('chk_cbr').checked) {
									var chk_cbr = "1";
								}
								else{
									var chk_cbr = "0";
								}
				
				
				var f1 = $('#f1').val();
				var f2 = $('#f2').val();
				var t1 = $('#t1').val();
				var t2 = $('#t2').val();
				var s1 = $('#s1').val();
				var s2 = $('#s2').val();
				var p1 = $('#p1').val();
				var p2 = $('#p2').val();
				var b1 = $('#b1').val();
				var b2 = $('#b2').val();
				var c1 = $('#c1').val();
				var c2 = $('#c2').val();
				var avg_c = $('#avg_c').val();
				var cbr = $('#cbr').val();
				var layer_mt = $('#layer_mt').val();
				var field_mos = $('#field_mos').val();
				var hsr_0 = $('#hsr_0').val();
				var hsr_1 = $('#hsr_1').val();
				var hsr_2 = $('#hsr_2').val();
				var hsr_3 = $('#hsr_3').val();
				var hsr_4 = $('#hsr_4').val();
				var hsr_5 = $('#hsr_5').val();
				var hsr_6 = $('#hsr_6').val();
				var hsr_7 = $('#hsr_7').val();
				var hsr_8 = $('#hsr_8').val();
				var hsr_9 = $('#hsr_9').val();
				var hsr_10 = $('#hsr_10').val();
				var hsr_11 = $('#hsr_11').val();
				var hsr_12 = $('#hsr_12').val();
				var hsr_13 = $('#hsr_13').val();
				var hsr_14 = $('#hsr_14').val();
				var hsr_15 = $('#hsr_15').val();
				var hsr_16 = $('#hsr_16').val();
				var hsr_17 = $('#hsr_17').val();
				var hsr_18 = $('#hsr_18').val();
				var hsr_19 = $('#hsr_19').val();
				var hsr_20 = $('#hsr_20').val();
				var hsr_21 = $('#hsr_21').val();
				var hsr_22 = $('#hsr_22').val();
				var hsr_23 = $('#hsr_23').val();
				var hsr_24 = $('#hsr_24').val();
				var hsr_25 = $('#hsr_25').val();
				var hsr_26 = $('#hsr_26').val();
				var hsr_27 = $('#hsr_27').val();
				var hsr_28 = $('#hsr_28').val();
				var hsr_29 = $('#hsr_29').val();
				var hsr_30 = $('#hsr_30').val();
				var hsr_31 = $('#hsr_31').val();
				var hsr_32 = $('#hsr_32').val();
				var hsr_33 = $('#hsr_33').val();
				var hsr_34 = $('#hsr_34').val();
				var hsr_35 = $('#hsr_35').val();
				var hsr_36 = $('#hsr_36').val();
				var hsr_37 = $('#hsr_37').val();
				var hsr_38 = $('#hsr_38').val();
				var hsr_39 = $('#hsr_39').val();
				var hsr_40 = $('#hsr_40').val();
				var hsr_41 = $('#hsr_41').val();
				
								
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&chk_cbr='+chk_cbr+'&f1='+f1+'&f2='+f2+'&t1='+t1+'&t2='+t2+'&s1='+s1+'&s2='+s2+'&p1='+p1+'&p2='+p2+'&b1='+b1+'&b2='+b2+'&c1='+c1+'&c2='+c2+'&avg_c='+avg_c+'&cbr='+cbr+'&ulr='+ulr+'&layer_mt='+layer_mt+'&field_mos='+field_mos+'&hsr_0='+hsr_0+'&hsr_1='+hsr_1+'&hsr_2='+hsr_2+'&hsr_3='+hsr_3+'&hsr_4='+hsr_4+'&hsr_5='+hsr_5+'&hsr_6='+hsr_6+'&hsr_7='+hsr_7+'&hsr_8='+hsr_8+'&hsr_9='+hsr_9+'&hsr_10='+hsr_10+'&hsr_11='+hsr_11+'&hsr_12='+hsr_12+'&hsr_13='+hsr_13+'&hsr_14='+hsr_14+'&hsr_15='+hsr_15+'&hsr_16='+hsr_16+'&hsr_17='+hsr_17+'&hsr_18='+hsr_18+'&hsr_19='+hsr_19+'&hsr_20='+hsr_20+'&hsr_21='+hsr_21+'&hsr_22='+hsr_22+'&hsr_23='+hsr_23+'&hsr_24='+hsr_24+'&hsr_25='+hsr_25+'&hsr_26='+hsr_26+'&hsr_27='+hsr_27+'&hsr_28='+hsr_28+'&hsr_29='+hsr_29+'&hsr_30='+hsr_30+'&hsr_31='+hsr_31+'&hsr_32='+hsr_32+'&hsr_33='+hsr_33+'&hsr_34='+hsr_34+'&hsr_35='+hsr_35+'&hsr_36='+hsr_36+'&hsr_37='+hsr_37+'&hsr_38='+hsr_38+'&hsr_39='+hsr_39+'&hsr_40='+hsr_40+'&hsr_41='+hsr_41+'&amend_date='+amend_date;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_dcp.php',
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
        url: '<?php echo $base_url; ?>save_dcp.php',
       data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#amend_date').val(data.amend_date);
		
            var chk_cbr = data.chk_cbr;
           
			if(chk_cbr=="1")
			{
			   $('#txtden').css("background-color","var(--success)");			
			   $("#chk_cbr").prop("checked", true); 
			}else{
				$('#txtden').css("background-color","white");			
				$("#chk_cbr").prop("checked", false); 
			}

			
            
            $('#f1').val(data.f1);
            $('#f2').val(data.f2);
            $('#t1').val(data.t1);
            $('#t2').val(data.t2);
            $('#s1').val(data.s1);
            $('#s2').val(data.s2);
            $('#p1').val(data.p1);
            $('#p2').val(data.p2);
            $('#b1').val(data.b1);
            $('#b2').val(data.b2);
            $('#c1').val(data.c1);
            $('#c2').val(data.c2);
            $('#avg_c').val(data.avg_c);
            $('#cbr').val(data.cbr);
            $('#layer_mt').val(data.layer_mt);
            $('#field_mos').val(data.field_mos);
            $('#hsr_0').val(data.hsr_0);
            $('#hsr_1').val(data.hsr_1);
            $('#hsr_2').val(data.hsr_2);
            $('#hsr_3').val(data.hsr_3);
            $('#hsr_4').val(data.hsr_4);
            $('#hsr_5').val(data.hsr_5);
            $('#hsr_6').val(data.hsr_6);
            $('#hsr_7').val(data.hsr_7);
            $('#hsr_8').val(data.hsr_8);
            $('#hsr_9').val(data.hsr_9);
            $('#hsr_10').val(data.hsr_10);
			$('#hsr_11').val(data.hsr_11);
            $('#hsr_12').val(data.hsr_12);
            $('#hsr_13').val(data.hsr_13);
            $('#hsr_14').val(data.hsr_14);
            $('#hsr_15').val(data.hsr_15);
            $('#hsr_16').val(data.hsr_16);
            $('#hsr_17').val(data.hsr_17);
            $('#hsr_18').val(data.hsr_18);
            $('#hsr_19').val(data.hsr_19);
            $('#hsr_20').val(data.hsr_20);
            $('#hsr_21').val(data.hsr_21);
            $('#hsr_22').val(data.hsr_22);
            $('#hsr_23').val(data.hsr_23);
            $('#hsr_24').val(data.hsr_24);
            $('#hsr_25').val(data.hsr_25);
            $('#hsr_26').val(data.hsr_26);
            $('#hsr_27').val(data.hsr_27);
            $('#hsr_28').val(data.hsr_28);
            $('#hsr_29').val(data.hsr_29);
            $('#hsr_30').val(data.hsr_30);
            $('#hsr_31').val(data.hsr_31);
            $('#hsr_32').val(data.hsr_32);
            $('#hsr_33').val(data.hsr_33);
            $('#hsr_34').val(data.hsr_34);
            $('#hsr_35').val(data.hsr_35);
            $('#hsr_36').val(data.hsr_36);
            $('#hsr_37').val(data.hsr_37);
            $('#hsr_38').val(data.hsr_38);
            $('#hsr_39').val(data.hsr_39);
            $('#hsr_40').val(data.hsr_40);
            $('#hsr_41').val(data.hsr_41);
           
            
			
			
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}

	</script>