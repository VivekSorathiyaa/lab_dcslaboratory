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
					$type_of_material= $row_select4['fdd_desc_sample'];
					$chain= $row_select4['chainage_no'];
					 $qty= $row_select4['fdd_qty'];
					
				}
		
?>
	<!-- STYLE PUT VAIBHAV-->
	<div class="content-wrapper" style="margin-left:0px !important;">
	<!-- Content Header (Page header) -->
		<section class="content">
		<!-- MENU INCLUDE VAIBHAV-->
		
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h2  style="text-align:center;">SAND REPLACEMENT</h2>
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
											<input type="text" class="form-control inputs" tabindex="4" id="" value="<?php echo $job_no;?>" name="lab_no" ReadOnly>
                                        <input type="hidden" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" ReadOnly>
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
										<div class="col-sm-10">
											<input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr;?>" name="ulr" ReadOnly>
												<input type="text" class="form-control inputs" tabindex="4" id="qty" value="<?php echo $qty;?>" name="qty" ReadOnly>
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
										<div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="type_of_material" value="<?php echo $type_of_material;?>" name="type_of_material" ReadOnly>
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
												$querys_job1 = "SELECT * FROM soil_calibration WHERE `is_deleted`='0' and lab_no='$lab_no'";
												$qrys_jobno = mysqli_query($conn,$querys_job1);
												$rows=mysqli_num_rows($qrys_jobno);
												if($rows < $qty){ ?>
													<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >Save</button>
													<?php }													
														?>
										</div>
										<div class="col-sm-2">
											<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')"  id="btn_edit_data" name="btn_edit_data" >Update</button>
										</div>
										<!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
										<?php
										// $val1 =  $_SESSION['isadmin'];
										 // $val2 =  $_SESSION['is_special'];
										// if($val1 =="0" || $val1 =="5" || $val1 =="44" || $val2 =="1"){
										?>
										<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_soil_cal.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>
										<?php //} ?>
										<div class="col-sm-2">
											
											<a target = '_blank' href="<?php echo $base_url; ?>back_cal_report/print_soil_cal.php?job_no=<?php echo $_GET['job_no'];?>&&report_no=<?php echo $_GET['report_no'];?>&&lab_no=<?php echo $_GET['lab_no'];?>&&trf_no=<?php echo $_GET['trf_no'];?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Calculation Report</b></a>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<br>	
																		<!--Nikunj Code Start-->
							<?php
								$is_upload = "select * from span_material_assign WHERE `trf_no`='$trf_no' and `job_number`='$job_no'and isdeleted='0'";

								$result_upload = mysqli_query($conn, $is_upload);
								if (mysqli_num_rows($result_upload) > 0) { ?>

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

															<div class="col-md-3">
																<a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>&&lab_no=<?php echo $lab_no; ?>">Row Data</a>
															</div>
															<div class="col-md-3">
																<label for="inputEmail3" class="col-md-12 control-label">Upload Excel :</label>
															</div>
															<div class="col-md-3">
																<input type="file" class="form-control" id="upload_excel" name="upload_excel">
															</div>
															<div class="col-md-3">
																<button type="button" class="btn btn-info pull-right" id="btn_upload_excel" name="btn_upload_excel" tabindex="14">Upload</button>
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
																if (mysqli_num_rows($result_file) > 0) {
																	while ($r_file = mysqli_fetch_array($result_file)) {
																?>
																		<tr>
																			<td><a href="<?php echo $base_url . $r_file['excel_sheet']; ?>" download><?php echo $r_file['excel_sheet']; ?></a></td>
																			<td><a href="javascript:void(0);" class="delete_excels" data-id="<?php echo $r_file['id']; ?>">Delete</a></td>
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
											<br>
										</div>
									<?php }	 ?>

							
							<?php
							$test_check;
							$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'"; 
								$result_select1 = mysqli_query($conn, $select_query1);
								while($r1 = mysqli_fetch_array($result_select1)){
									
									if($r1['test_code']=="cal")
									{
										$test_check.="cal,";
									?>
								
								<div class="panel panel-default" id="den">
									<div class="panel-heading" id="txtden">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
												<h4 class="panel-title">
												<b>FIELD DRY DENSITY TEST BY SAND REPLACEMENT</b>
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
																	<label for="chk_cali">1.</label>
																	<input type="checkbox" class="visually-hidden" name="chk_cali"  id="chk_cali" value="chk_cali"><br>
																</div>
															<label for="inputEmail3" class="col-sm-4 control-label label-right">FIELD DRY DENSITY TEST BY SAND REPLACEMENT</label>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-3">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">MDD OF MATERIAL</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="cal_mdd" name="cal_mdd">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">DENSITY OF SAND</label>	
															</div>
															
														</div>
													</div>
												</div>
											<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >1. Wt. of Sand in Cone W2, gm</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="c1" name="c1">
																	</div>
															
														</div>
													</div>
												</div>	
											<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label">2. Vol. of calibrating Contanier V,cc</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="c2" name="c2">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >3. Wt. of sand+cylinder before  pouring W1, gm</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="c3" name="c3">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >4. Wt. of sand+cylinder after  pouring W3, gm</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="c4" name="c4">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >5. Wt. of sand to fill calibrating cylinder Wa = W1-W3-W2, gm</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="c5" name="c5">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
										
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >6. Bulk Density of sand Ds = Wa/V, gm/cc</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="c6" name="c6">
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
															<div class="col-md-12">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:center;">FIELD DRY DENSITY TEST BY SAND REPLACMENT</label>	
															</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:left;">1. Chainage No. \ Location</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="chainage_no" name="chainage_no" value="<?php echo $chain;?>" >
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:left;">2. Layer of Material</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="layer_mt" name="layer_mt">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" style="text-align:left;">3. Wt. of wet Sample from Hole W<sub>W</sub> (gm)</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="d1" name="d1">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >4. Wt. of Sand + Cylinder before Pouring W<sub>1</sub> (gm)</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="d2" name="d2">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >5. Wt. of Sand + Cylinder after Pouring W<sub>4</sub> (gm)</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="d3" name="d3">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >6. Wt. of Sand to Fill Hole W<sub>b</sub> = W<sub>1</sub> - W<sub>4</sub> - W<sub>2</sub> (gm)</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="d4" name="d4">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >7. Wet Density of Sample, D<sub>wet</sub> = (W<sub>W</sub>/W<sub>b</sub>) x D<sub>S</sub></label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="d5" name="d5">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >8. Moisture content of Soil from moisture meter (%)<input type="radio" id="mo_meter" name="mo_meter" value="mo_meter"/></label>	
															</div>
															<div class="col-md-3"> 
																		<input type="hidden" style="text-align:center;" class="form-control inputs" tabindex="4" id="xy" name="xy">
																	<input type="hidden" style="text-align:center;" class="form-control inputs" tabindex="4" id="xans" name="xans">
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="d6" name="d6">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >9. Container No.<input type="radio" id="mo_meter" name="mo_meter" value="mo_con" checked/></label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="con_no" name="con_no">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >10. Container Empty Wt. (gm)</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="con_weight" name="con_weight">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >11. Wt. of Container + Wet Soil (gm)</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="wt_con_wt_soil" name="wt_con_wt_soil">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >12. Wt. of Container + Dry Soil (gm)</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="wt_con_dry_soil" name="wt_con_dry_soil">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >13. Moisture Content in Soil(%)</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="mc_od" name="mc_od">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >14. D<sub>dry</sub> = 100 X D<sub>wet</sub>/ (100 + w%) (gm/cc)</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="d7" name="d7">
																	</div>
															
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-md-12">  
													
														<div class="form-group">											
															<div class="col-md-8">
															<label for="inputEmail3" class="col-sm-12 control-label" >15. Compaction (%) = (D<sub>dry</sub> / MDD) x 100</label>	
															</div>
															<div class="col-md-3"> 
																		<input type="text" style="text-align:center;width:150px" class="form-control inputs" tabindex="4" id="d8" name="d8">
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
								<th style="text-align:center;"><label>Job No.</label></th>
								<th style="text-align:center;"><label>Unique Identity No.</label></th>
							
							
																		

							</tr>
								<?php
							 $query = "select * from soil_calibration WHERE lab_no='$aa'  and `is_deleted`='0'";

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
getGlazedTiles();	

  $(function () {
    $('.select2').select2();
  })
	
	$("#btn_upload_excel").click(function() {
		form_data = new FormData();
		var acb = $('#upload_excel').val();
		if (acb == "") {
			alert("Upload excel First");
			return false;
		}
		var lab_no = "<?php echo $lab_no; ?>";
		var job_no = "<?php echo $job_no_main; ?>";
		var report_no = "<?php echo $report_no; ?>";

		var file_data = $('#upload_excel').prop('files')[0];
		var form_data = new FormData(); // Create a FormData object
		form_data.append('file', file_data); // Append all element in FormData  object
		form_data.append('lab_no', lab_no); // Append all element in FormData  object
		form_data.append('job_no', job_no); // Append all element in FormData  object
		form_data.append('report_no', report_no); // Append all element in FormData  object

		$.ajax({
			url: '<?php $base_url; ?>excel_upload_test.php', // point to server-side PHP script 
			dataType: 'text', // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function(output) {
				get_excel_record(); // display response from the PHP script, if any
			}
		});
		$('#upload_excel').val('');


	});

	function get_excel_record() {
		var lab_no = "<?php echo $lab_no; ?>";
		var job_no = "<?php echo $job_no_main; ?>";
		var report_no = "<?php echo $report_no; ?>";
		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>excel_upload_test.php',
			data: 'action_type=get_excel_record&lab_no=' + lab_no + '&job_no=' + job_no + '&report_no=' + report_no,
			success: function(html) {
				$('#view_excel_from_table').html(html);

			}
		});
	}


$(document).ready(function(){ 
			   
	$('#btn_edit_data').hide();
	$('#alert').hide();
	var method="mo_con";
	$('#chk_auto').change(function(){
        if(this.checked)
		{ $('#txtden').css("background-color","var(--primary)"); 
			$('#c1').val("354");
			$('#c2').val("1177.5");
			$('#c3').val("6000");
			$('#d1').val("6000");
			$('#c4').val("3964");
			$('#c5').val("1682");
			$('#c6').val("1.43");
			$val = $('#type_of_material').val();
			$('#layer_mt').val($val);
			var calmdd = randomNumberFromRange(1.74,1.79).toFixed(3);
			$('#cal_mdd').val(calmdd);
			autos();
			
		}
		else
		{
			 $('#txtden').css("background-color","White"); 
			 $('#c1').val(null);
			$('#c2').val(null);
			$('#c3').val(null);
			$('#c4').val(null);
			$('#c5').val(null);
			$('#c6').val(null);
		}
	});
	
	
	$('#chk_cali').change(function(){
        if(this.checked)
		{ $('#txtden').css("background-color","var(--primary)"); 
			$('#c1').val("354");
			$('#c2').val("1177.5");
			$('#c3').val("6000");
			$('#d2').val("6000");
			$('#c4').val("3964");
			$('#c5').val("1682");
			$('#c6').val("1.43");
			$val = $('#type_of_material').val();
			$('#layer_mt').val($val);
			var calmdd = randomNumberFromRange(1.74,1.79).toFixed(3);
			$('#cal_mdd').val(calmdd);
			
			autos();
		}
		else
		{
			 $('#txtden').css("background-color","White"); 
			 $('#c1').val(null);
			$('#c2').val(null);
			$('#c3').val(null);
			$('#c4').val(null);
			$('#c5').val(null);
			$('#c6').val(null);
		}
	});
	
	function autos()
	{
		var layer_mt = $('#layer_mt').val();
		
		if(layer_mt=="SOIL" || layer_mt=="Soil")
		{
			var d_1 = randomNumberFromRange(1350,1500).toFixed();
			$('#d1').val(d_1);
			var d_8 = randomNumberFromRange(96.00,99.70).toFixed();
			$('#d8').val(d_8);
		}
		else if(layer_mt=="Stabilize Soil" || layer_mt=="STABILIZE SOIL")
		{
			var d_1 = randomNumberFromRange(1450,1700).toFixed();
			$('#d1').val(d_1);
			var d_8 = randomNumberFromRange(96.00,99.70).toFixed();
			$('#d8').val(d_8);
		}
		else if(layer_mt=="GSB" || layer_mt=="gsb")
		{
			var d_1 = randomNumberFromRange(2150,2500).toFixed();
			$('#d1').val(d_1);
			var d_8 = randomNumberFromRange(98.00,99.70).toFixed();
			$('#d8').val(d_8);
		}
		else if(layer_mt=="WMM" || layer_mt=="wmm")
		{
			var d_1 = randomNumberFromRange(2300,2700).toFixed();
			$('#d1').val(d_1);
			var d_8 = randomNumberFromRange(98.00,99.70).toFixed();
			$('#d8').val(d_8);
		}else if(layer_mt=="Murrum" || layer_mt=="MURRUM")
		{
			var d_1 = randomNumberFromRange(1700,2000).toFixed();
			$('#d1').val(d_1);
			var d_8 = randomNumberFromRange(98.00,99.70).toFixed();
			$('#d8').val(d_8);
		}
		var d8 = $('#d8').val();
		var cal_mdd = $('#cal_mdd').val();
		var d_7 = ((+d8) / 100) * (+cal_mdd);
		$('#d7').val(d_7.toFixed(3));
		var d7 = $('#d7').val();
		
		var mc_o_d = randomNumberFromRange(11.8,14.5).toFixed(2);
		$('#mc_od').val(mc_o_d);
		var mc_od = $('#mc_od').val();
		
		var x_y = randomNumberFromRange(32,40).toFixed();
		$('#xy').val(x_y);
		
		var xy = $('#xy').val();
		var xx = ((+mc_od) / (+100)) * (+xy);
		$('#xans').val(xx.toFixed(2));
		var xans = $('#xans').val();
		
		var conweight = $('#con_weight').val();
		
		var wt_con_drysoil = (+conweight) + (+xy);
		$('#wt_con_dry_soil').val(wt_con_drysoil.toFixed(2));			
		var wt_con_dry_soil = $('#wt_con_dry_soil').val();
		
		var temp = (+mc_od) + (+100);
		var temp2 = (+temp) * (+d7);
		var d_5 = (+temp2) / 100;
		$('#d5').val(d_5.toFixed(3));
		var d5 = $('#d5').val();
			
		var eq = (+xy) + (+xans);
		var wt_con_wtsoil = ((+conweight) + (+eq)); 
		
			
		$('#wt_con_wt_soil').val(wt_con_wtsoil.toFixed(2));	
		
		
		
		var c6 = $('#c6').val();
		
		
		$('#d2').val("6000");
		var d_2 = $('#d2').val();
		
		
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		var c_4 = $('#c4').val();
		
		var c_5 = (+c_3) - (+c_4) - (+c_1);
		$('#c5').val(c_5.toFixed());
		var c5  = $('#c5').val();
		var c_6 = (+c5)/(+c_2);
		$('#c6').val(c_6.toFixed(2));
		var c6  = $('#c6').val();
		
		
		
		var d1 = $('#d1').val();
		var d5 = $('#d5').val();
		
		var temps1 = (+d1) * (+c6);
		var d_4 = (+temps1) / (+d5);

		$('#d4').val(d_4.toFixed());
		var d4 = $('#d4').val();
		
		
		var d_3 = (+d1) + (+d4);
		$('#d3').val(d_3.toFixed());
		
		var cc_1 = $('#c1').val();
		var cc_6 = $('#c6').val();
		var dd_1 = $('#d1').val();
		var dd_2 = $('#d2').val();
		var dd_3 = $('#d3').val();
		
		var dd4 = (+dd_2) - (+dd_3) - (+cc_1);
		
		$('#d4').val(dd4.toFixed());
		var dd_4 = $('#d4').val();
		
		var stemp = (+dd_1) / (+dd_4);
		var dd5 = (+stemp) * (+cc_6);
		$('#d5').val(dd5.toFixed(3));
		var dd_5 = $('#d5').val();
		
		var mcod1 = $('#mc_od').val();
		
		var stemps1 = (+dd_5) * (+100);
		var stemps2 = (+mcod1) + (+100);
		
		var dd7 = (+stemps1) / (+stemps2);
		$('#d7').val(dd7.toFixed(3));
		var dd_7 = $('#d7').val();
		var cal_mdd1 = $('#cal_mdd').val();
		
		var anss = (+dd_7) / (+cal_mdd1);
		var dd_8 = (+anss) * (+100);
		$('#d8').val(dd_8.toFixed(2));
		
		
		
	}
	
	$('#d8').change(function(){
		
		
		var d8 = $('#d8').val();
		var cal_mdd = $('#cal_mdd').val();
		var d_7 = ((+d8) / 100) * (+cal_mdd);
		$('#d7').val(d_7.toFixed(3));
		var d7 = $('#d7').val();
		
		var mc_o_d = randomNumberFromRange(11.8,14.5).toFixed(2);
		$('#mc_od').val(mc_o_d);
		var mc_od = $('#mc_od').val();
		
		var x_y = randomNumberFromRange(32,40).toFixed();
		$('#xy').val(x_y);
		
		var xy = $('#xy').val();
		var xx = ((+mc_od) / (+100)) * (+xy);
		$('#xans').val(xx.toFixed(2));
		var xans = $('#xans').val();
		
		var conweight = $('#con_weight').val();
		
		var wt_con_drysoil = (+conweight) + (+xy);
		$('#wt_con_dry_soil').val(wt_con_drysoil.toFixed(2));			
		var wt_con_dry_soil = $('#wt_con_dry_soil').val();
		
		var d5 = $('#d5').val();
			
		var eq = (+xy) + (+xans);
		var wt_con_wtsoil = ((+conweight) + (+eq)); 
		
			
		$('#wt_con_wt_soil').val(wt_con_wtsoil.toFixed(2));	
		
		
		
		var c6 = $('#c6').val();
		
		var temp = (+mc_od) + (+100);
		var temp2 = (+temp) * (+d7);
		var d_5 = (+temp2) / 100;
		$('#d5').val(d_5.toFixed(3));
		$('#d2').val("6000");
		var d_2 = $('#d2').val();
		var layer_mt = $('#layer_mt').val();
		
		if(layer_mt=="SOIL" || layer_mt=="Soil")
		{
			var d_1 = randomNumberFromRange(1350,1500).toFixed();
			$('#d1').val(d_1);
		}
		else if(layer_mt=="Stabilize Soil" || layer_mt=="STABILIZE SOIL")
		{
			var d_1 = randomNumberFromRange(1450,1700).toFixed();
			$('#d1').val(d_1);
		}
		else if(layer_mt=="GSB" || layer_mt=="gsb")
		{
			var d_1 = randomNumberFromRange(2150,2500).toFixed();
			$('#d1').val(d_1);
		}
		else if(layer_mt=="WMM" || layer_mt=="wmm")
		{
			var d_1 = randomNumberFromRange(2300,2700).toFixed();
			$('#d1').val(d_1);
		}else if(layer_mt=="Murrum" || layer_mt=="MURRUM")
		{
			var d_1 = randomNumberFromRange(1700,2000).toFixed();
			$('#d1').val(d_1);
		}
		
		var c_1 = $('#c1').val();
		var c_2 = $('#c2').val();
		var c_3 = $('#c3').val();
		var c_4 = $('#c4').val();
		
		var c_5 = (+c_3) - (+c_4) - (+c_1);
		$('#c5').val(c_5.toFixed());
		var c5  = $('#c5').val();
		
		var c_6 = (+c5)/(+c_2);
		$('#c6').val(c_6.toFixed(2));
		var c6  = $('#c6').val();
		
		var d1 = $('#d1').val();
		var d5 = $('#d5').val();
		
		var temps1 = (+d1) * (+c6);
		var d_4 = (+temps1) / (+d5);

		$('#d4').val(d_4.toFixed());
		var d4 = $('#d4').val();
		
		
		var d_3 = (+d1) + (+d4);
		$('#d3').val(d_3.toFixed());
		
		
		//SIDHU
		var cc_1 = $('#c1').val();
		var cc_6 = $('#c6').val();
		var dd_1 = $('#d1').val();
		var dd_2 = $('#d2').val();
		var dd_3 = $('#d3').val();
		
		var dd4 = (+dd_2) - (+dd_3) - (+cc_1);
		
		$('#d4').val(dd4.toFixed());
		var dd_4 = $('#d4').val();
		
		var stemp = (+dd_1) / (+dd_4);
		var dd5 = (+stemp) * (+cc_6);
		$('#d5').val(dd5.toFixed(3));
		var dd_5 = $('#d5').val();
		
		var mcod1 = $('#mc_od').val();
		
		var stemps1 = (+dd_5) * (+100);
		var stemps2 = (+mcod1) + (+100);
		
		var dd7 = (+stemps1) / (+stemps2);
		$('#d7').val(dd7.toFixed(3));
		var dd_7 = $('#d7').val();
		var cal_mdd1 = $('#cal_mdd').val();
		
		var anss = (+dd_7) / (+cal_mdd1);
		var dd_8 = (+anss) * (+100);
		$('#d8').val(dd_8.toFixed(2));
	
	});
	
	/* 
	$('#cal_mdd,#c1,#c2,#c3,#c4,#d1,#d2,#d3').change(function()
	{
		var cal_mdd = $('#cal_mdd').val();
		var c1 = $('#c1').val();
		var c2 = $('#c2').val();
		var c3 = $('#c3').val();
		var c4 = $('#c4').val();
		var c5 = $('#c5').val();
		
		var c5 = ((+c3)-(+c4)-(+c1));
		$('#c5').val(c5.toFixed(1));
		
		var c6 = $('#c6').val();
		var c6 = (+c5)/(+c2);
		$('#c6').val(c6.toFixed(1));
		
		var d2 = $('#d2').val();
		var d3 = $('#d3').val();
		var d4 = $('#d4').val();
		
		var d4 = ((+d2)-(+d3)-(+c1));
		$('#d4').val(d4.toFixed(1));
		
		var d1
		
		
	});	 */
	
	
	$('#cal_mdd,#c1,#c2,#c3,#c4,#d1,#d2,#d3,#d6,#con_no,#con_weight,#wt_con_wt_soil,#wt_con_dry_soil').change(function()
	{
		
		var cal_mdd = $('#cal_mdd').val();
		var c1 = $('#c1').val();
		var c2 = $('#c2').val();
		var c3 = $('#c3').val();
		var c4 = $('#c4').val();
		var c6 = $('#c6').val();
		var d1 = $('#d1').val();
		var d2 = $('#d2').val();
		var d3 = $('#d3').val();
		var d6 = $('#d6').val();
		var con_no = $('#con_no').val();
		var con_weight = $('#con_weight').val();
		var wt_con_wt_soil = $('#wt_con_wt_soil').val();
		var wt_con_dry_soil = $('#wt_con_dry_soil').val();

		
		
		var conweight="";
		if(method == "mo_con")
		{
			var d4 = ((+d2)-(+d3)-(+c1));
			$('#d4').val(d4.toFixed(1));
			var d4 = $('#d4').val();
			
			var d5 = ((+d1)/(+d4)*(+c6));
			$('#d5').val(d5.toFixed(3));
			var d5 = $('#d5').val();
			
			var c5 = ((+c3)-(+c4)-(+c1));
			$('#c5').val(c5.toFixed(1));
			var c5 = $('#c5').val();
			
			var c6 = ((+c5)/(+c2));
			$('#c6').val(c6.toFixed(2));
			var c6 = $('#c6').val();
			
			var mc_od = ((+wt_con_wt_soil)-(+wt_con_dry_soil))/((+wt_con_dry_soil)-(+con_weight))*(+100);
			$('#mc_od').val(mc_od.toFixed(2));
			var mc_od = $('#mc_od').val();
			
			var d7 = (+d5)/((+1)+((+mc_od)/(+100)));
			$('#d7').val(d7.toFixed(3));
			var d7 = $('#d7').val();
			
			var d8 = (+d7)/(+cal_mdd)*(+100);
			$('#d8').val(d8.toFixed(2));
			var d8 = $('#d8').val();
			
		
		}
		else
		{
			
			var c5 = ((+c3)-(+c4)-(+c1));
			$('#c5').val(c5.toFixed(1));
			var c5 = $('#c5').val();
			
			var c6 = ((+c5)/(+c2));
			$('#c6').val(c6.toFixed(2));
			var c6 = $('#c6').val();
			
			
			var mc_od = ((+d6)/((+100)-(+d6))*(+100));
			$('#mc_od').val(mc_od.toFixed(2));
			var mc_od = $('#mc_od').val();
			

			var d4 = ((+d2)-(+d3)-(+c1));
			$('#d4').val(d4.toFixed(1));
			var d4 = $('#d4').val();
			
			var d5 = ((+d1)/(+d4)*(+c6));
			$('#d5').val(d5.toFixed(3));
			var d5 = $('#d5').val();
			
			var d7 = (+d5)/((+1)+((+mc_od)/(+100)));
			$('#d7').val(d7.toFixed(3));
			var d7 = $('#d7').val();
			
			var d8 = (+d7)/(+cal_mdd)*(+100);
			$('#d8').val(d8.toFixed(2));
			var d8 = $('#d8').val();
			
			
			
		}
		
		
		
	});
	
	
/* function c_test()
	{
		
		var conweight="";
		if(method == "mo_con")
		{
		
		
		var cc_1 = $('#c1').val();
		var cc_6 = $('#c6').val();
		var dd_1 = $('#d1').val();
		var dd_2 = $('#d2').val();
		var dd_3 = $('#d3').val();
		
		var dd4 = (+dd_2) - (+dd_3) - (+cc_1);
		
		$('#d4').val(dd4.toFixed());
		var dd_4 = $('#d4').val();
		
		var stemp = (+dd_1) / (+dd_4);
		var dd5 = (+stemp) * (+cc_6);
		$('#d5').val(dd5.toFixed(3));
		var dd_5 = $('#d5').val();
		
		var mcod1 = $('#mc_od').val();
		
		var stemps1 = (+dd_5) * (+100);
		var stemps2 = (+mcod1) + (+100);
		
		var dd7 = (+stemps1) / (+stemps2);
		$('#d7').val(dd7.toFixed(3));
		var dd_7 = $('#d7').val();
		var cal_mdd1 = $('#cal_mdd').val();
		
		var anss = (+dd_7) / (+cal_mdd1);
		var dd_8 = (+anss) * (+100);
		$('#d8').val(dd_8.toFixed(2));	
		
		}
		else
		{
			var d_6 = randomNumberFromRange(11.8,14.5).toFixed(2);
			$('#d6').val(d_6);
			var d6 = $('#d6').val();
			
			var cc_1 = $('#c1').val();
			var cc_6 = $('#c6').val();
			var dd_1 = $('#d1').val();
			var dd_2 = $('#d2').val();
			var dd_3 = $('#d3').val();
			
			var dd4 = (+dd_2) - (+dd_3) - (+cc_1);
			
			$('#d4').val(dd4.toFixed());
			var dd_4 = $('#d4').val();
			
			var stemp = (+dd_1) / (+dd_4);
			var dd5 = (+stemp) * (+cc_6);
			$('#d5').val(dd5.toFixed(3));
			var dd_5 = $('#d5').val();
			
			//var mcod1 = $('#mc_od').val();
			
			var stemps1 = (+dd_5) * (+100);
			var stemps2 = (+d6) + (+100);
			
			var dd7 = (+stemps1) / (+stemps2);
			$('#d7').val(dd7.toFixed(3));
			var dd_7 = $('#d7').val();
			var cal_mdd1 = $('#cal_mdd').val();
			
			var anss = (+dd_7) / (+cal_mdd1);
			var dd_8 = (+anss) * (+100);
			$('#d8').val(dd_8.toFixed(2));
			
			
		}
		
		
	} */
	
	/* $('#c1').change(function(){
			
			 $('#txtden').css("background-color","var(--primary)");
			c_test();			 
	});
	
	$('#c1').change(function(){
			
			 $('#txtden').css("background-color","var(--primary)");
			c_test();			 
	});
	$('#c2').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();
	});
	$('#c3').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");			
			 c_test();
	});
	$('#c4').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");			
			 c_test();
	});
	$('#c5').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");	
			c_test();
	});
	$('#c6').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");	
			c_test();
	});
	$('#d1').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");	
				c_test();
	});
	$('#d2').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();			 
	});
	$('#d3').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();
	});
	$('#d4').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();
	});
	$('#d5').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();			 
	});
	$('#d6').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();
	});
	$('#d7').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();
	});
	/*$('#d8').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();
	});
	$('#mc_od').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();
	});
	$('#wt_con_dry_soil').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();
	});
	$('#wt_con_wt_soil').change(function(){
		
			 $('#txtden').css("background-color","var(--primary)");
			c_test();
	}); */
	
	
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
	
	function rand(min, max) {
  var offset = min;
  var range = (max - min) + 1;

  var randomNumber = Math.floor( Math.random() * range) + offset;
  return randomNumber;
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
			$('#mc_od').val("");
		}
		else
		{
			
			 method="mo_con";
			var conno = randomNumberFromRange(1,321).toFixed();			
			$('#con_no').val(conno);
			$('#d6').val("");			
			var con_no = $('#con_no').val();			
			getWeight(con_no);
		}
			/*$('#field_mdd').val(null);	
			$('#empty_core').val(null);	
			$('#soil_core').val(null);	
			$('#wet_soil_core').val(null);	
			$('#fdd_1').val(null);	
			$('#fdd_2').val(null);	
			$('#fdd_3').val(null);	
			$('#fdd_4').val(null);	*/
			$('#mc_soil').val(null);	
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
        url: '<?php echo $base_url; ?>save_soil_calibration.php',
        data: 'action_type=view&'+$("#Glazed").serialize()+'&lab_no='+lab_no,
		success:function(html){
		$('#display_data').html(html);
        }
    });
	
	$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: '<?php echo $base_url; ?>save_soil_calibration.php',
			data: 'action_type=chk&' + $("#Glazed").serialize() + '&lab_no=' + lab_no,
			success: function(data) {
				var up_data = $('#qty').val();
				// var up_data =3;

				var save_data = data.total_row;
				console.log("-------save_data--->> " + save_data);
				console.log("-------up_data--->> " + up_data);

				if (save_data < up_data) {
					$('#btn_save').show();
				} else {

					$('#btn_save').hide();
				}

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
				var cal_mdd = $('#cal_mdd').val();
							
				if(document.getElementById('chk_cali').checked) {
									var chk_cali = "1";
								}
								else{
									var chk_cali = "0";
								}
				
				
				var c1 = $('#c1').val();
				var c2 = $('#c2').val();
				var c3 = $('#c3').val();
				var c4 = $('#c4').val();
				var c5 = $('#c5').val();
				var c6 = $('#c6').val();
				
				var d1 = $('#d1').val();
				var d2 = $('#d2').val();
				var d3 = $('#d3').val();
				var d4 = $('#d4').val();
				var d5 = $('#d5').val();
				var d6 = $('#d6').val();
				var d7 = $('#d7').val();
				var d8 = $('#d8').val();
				var layer_mt = $('#layer_mt').val();
				var con_no = $('#con_no').val();
				var con_weight = $('#con_weight').val();
				var wt_con_dry_soil = $('#wt_con_dry_soil').val();
				var wt_con_wt_soil = $('#wt_con_wt_soil').val();
				var mc_od = $('#mc_od').val();
				
				
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&cal_mdd='+cal_mdd+'&chk_cali='+chk_cali+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&c4='+c4+'&c5='+c5+'&c6='+c6+'&d1='+d1+'&d2='+d2+'&d3='+d3+'&d4='+d4+'&d5='+d5+'&d6='+d6+'&d7='+d7+'&d8='+d8+'&ulr='+ulr+'&layer_mt='+layer_mt+'&con_no='+con_no+'&con_weight='+con_weight+'&wt_con_dry_soil='+wt_con_dry_soil+'&wt_con_wt_soil='+wt_con_wt_soil+'&mc_od='+mc_od;
				
	}
	else if (type == 'edit'){
		
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var lab_no = $('#lab_no').val();
				var ulr = $('#ulr').val();
				var cal_mdd = $('#cal_mdd').val();
							
				if(document.getElementById('chk_cali').checked) {
									var chk_cali = "1";
								}
								else{
									var chk_cali = "0";
								}
				
				
				var c1 = $('#c1').val();
				var c2 = $('#c2').val();
				var c3 = $('#c3').val();
				var c4 = $('#c4').val();
				var c5 = $('#c5').val();
				var c6 = $('#c6').val();
				
				var d1 = $('#d1').val();
				var d2 = $('#d2').val();
				var d3 = $('#d3').val();
				var d4 = $('#d4').val();
				var d5 = $('#d5').val();
				var d6 = $('#d6').val();
				var d7 = $('#d7').val();
				var d8 = $('#d8').val();
				var layer_mt = $('#layer_mt').val();
				var con_no = $('#con_no').val();
				var con_weight = $('#con_weight').val();
				var wt_con_dry_soil = $('#wt_con_dry_soil').val();
				var wt_con_wt_soil = $('#wt_con_wt_soil').val();
				var mc_od = $('#mc_od').val();
				
								
				var idEdit = $('#idEdit').val(); 
		
				billData = $("#Glazed").find('.form').serialize()+'&action_type='+type+'&idEdit='+idEdit+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no+'&cal_mdd='+cal_mdd+'&chk_cali='+chk_cali+'&c1='+c1+'&c2='+c2+'&c3='+c3+'&c4='+c4+'&c5='+c5+'&c6='+c6+'&d1='+d1+'&d2='+d2+'&d3='+d3+'&d4='+d4+'&d5='+d5+'&d6='+d6+'&d7='+d7+'&d8='+d8+'&ulr='+ulr+'&layer_mt='+layer_mt+'&con_no='+con_no+'&con_weight='+con_weight+'&wt_con_dry_soil='+wt_con_dry_soil+'&wt_con_wt_soil='+wt_con_wt_soil+'&mc_od='+mc_od;
    }
	else{
				var report_no = $('#report_no').val(); 
				var job_no = $('#job_no').val(); 
				var lab_no = $('#lab_no').val(); 
				billData = 'action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&lab_no='+lab_no;
    }
	
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>save_soil_calibration.php',
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
        url: '<?php echo $base_url; ?>save_soil_calibration.php',
       data: 'action_type=data&id='+id+'&lab_no='+lab_no,
        success:function(data){
			 $('#idEdit').val(data.id);
			var idEdit = $('#idEdit').val();	          	                    
            $('#report_no').val(data.report_no);
            $('#job_no').val(data.job_no);
            $('#lab_no').val(data.lab_no);
            $('#ulr').val(data.ulr);
			$('#cal_mdd').val(data.cal_mdd);
           
            var chk_cali = data.chk_cali;
           
			if(chk_cali=="1")
			{
			   $('#txtden').css("background-color","var(--primary)");			
			   $("#chk_cali").prop("checked", true); 
			}else{
				$('#txtden').css("background-color","white");			
				$("#chk_cali").prop("checked", false); 
			}

			
            
            $('#c1').val(data.c1);
            $('#c2').val(data.c2);
            $('#c3').val(data.c3);
            $('#c4').val(data.c4);
            $('#c5').val(data.c5);
            $('#c6').val(data.c6);
            
			$('#d1').val(data.d1);
            $('#d2').val(data.d2);
            $('#d3').val(data.d3);
            $('#d4').val(data.d4);
            $('#d5').val(data.d5);
            $('#d6').val(data.d6);
            $('#d7').val(data.d7);
            $('#d8').val(data.d8);
            $('#layer_mt').val(data.layer_mt);
            $('#con_no').val(data.con_no);
            $('#con_weight').val(data.con_weight);
            $('#wt_con_wt_soil').val(data.wt_con_wt_soil);
            $('#wt_con_dry_soil').val(data.wt_con_dry_soil);
            $('#mc_od').val(data.mc_od);
            
			
			
			$('#btn_edit_data').show();
			$('#btn_save').hide();
        }
    });
}

	</script>