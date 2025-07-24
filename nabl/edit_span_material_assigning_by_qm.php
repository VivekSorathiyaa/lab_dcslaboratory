<?php include("header.php");?>
<?php 
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}

$sel_final="select * from final_material_assign_master where `trf_no`='$_GET[trf_no]'";
$query_final=mysqli_query($conn,$sel_final);
$get_counts_of_final=mysqli_num_rows($query_final);

?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}





.mede_class{
	color:red;
}
.select2{
	
	width:200px;
}
.visually-hidden {
    position: absolute;
    left: -100vw;
    
    /* Note, you may want to position the checkbox over top the label and set the opacity to zero instead. It can be better for accessibilty on some touch devices for discoverability. */
}

</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   <?php
  //set session job and report no
  ?>
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		Material Selection
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									
									<div class="col-lg-12">
									<label for="inputEmail3" class="col-sm-2 control-label">Token No:</label>
											
										  <div class="col-sm-2">
											<input type="text" class="form-control" value="<?php echo $_GET['trf_no'];?>" id="txt_trf_no" name="txt_trf_no" readonly>
										  </div>
										<div class="form-group">
										
										  <!--<label for="inputEmail3" class="col-sm-2 control-label">Lab No:</label>-->
										  
										  <div class="col-sm-3">
												<div class="input-group date">
													<input type="hidden" class="form-control" value="<?php echo $_GET['trf_no'];?>" id="txt_job_no" name="txt_job_no" >
											</div>
										</div>
									</div>
								
								</div>
							</div>
							<hr>
							<h1>Total Materials Is : <?php echo $get_counts_of_final;?></h1>
							<hr>
							<div class="panel-group">
							  <?php 
							  $final_mat_id_array=array();
							  $report_no_array=array();
							  $lab_no_array=array();
							  $ulr_no_array=array();
							  if($get_counts_of_final > 0)
							  {
								 $counts=1;
								 while($one_final=mysqli_fetch_array($query_final))
								  {
									if($one_final['material_category'] =="")
									{
									array_push($report_no_array,$one_final['report_no']);
									array_push($lab_no_array,$one_final['lab_no']);
									array_push($ulr_no_array,$one_final['ulr_no']);
									array_push($final_mat_id_array,$one_final['final_material_id']);
									}
									
									if($one_final['material_category'] !="")
									{
									  $sel_cate="select * from material_category where `material_cat_id`=".$one_final['material_category'];
										$result_cat=mysqli_query($conn,$sel_cate);
										$row_cat=mysqli_fetch_array($result_cat);
										
										$sel_mat="select * from material where `id`=".$one_final['material_id'];
										$result_mat=mysqli_query($conn,$sel_mat);
										$row_mat=mysqli_fetch_array($result_mat);
							  ?>
								<a data-toggle="collapse" href="#collapse<?php echo $counts;?>" class="btn btn-primary" style="width:90%;margin-top: 2%;font-size: 20px;" id="add_material_button">Category : <?php echo $row_cat['material_cat_name']."&nbsp;&nbsp;&nbsp;Material : ".$row_mat['mt_name'];?></a>
								<button type="button" class="btn btn-info delete_materials" data-id="<?php echo $one_final['final_material_id']."|".$row_mat['table_name']."|".$one_final['report_no']?>"  id="#" name="btn_add_data" style="width:100px;font-size:20px;margin-top: 2%;" >
								<i class="fa fa-trash" aria-hidden="true"></i>
								</button>
								<div id="collapse<?php echo $counts;?>" class="panel-collapse collapse">
								<br>
								<table class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Test Name</th>
										<!--<th style="text-align:center;">Action</th>-->
										<!--<th style="text-align:center;">Action</th>-->
									</tr>
										
								</thead>
								<tbody>
									<?php
									$sel_span="select * from span_material_assign where `final_material_id`='$one_final[final_material_id]'";
									$query_span=mysqli_query($conn,$sel_span);
									$counts_span=mysqli_num_rows($query_span);
									if($counts_span > 0)
									{
									$counting=1;
									while($one_span=mysqli_fetch_array($query_span))
									{	
										$sel_test="select * from test_master where `test_id`=".$one_span['test'];
										$result_test=mysqli_query($conn,$sel_test);
										$get_test=mysqli_fetch_array($result_test);
										$test_name=$get_test["test_name"];
									?>
									    <tr id="tr_<?php echo $one_span['material_assign_id']?>">
										<td style="white-space:nowrap;text-align:center;"><?php echo $counting;?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $test_name;?></td>
										<!--<td style="text-align:center;">
											<button type="button" class="btn btn-info delete_test" data-id="<?php //echo $one_span['test'].'|'.$one_span['material_id'].'|'.$one_span['material_category'].'|'.$one_span['final_material_id'].'|'.$one_span['material_assign_id'].'|'.$one_span['trf_no'];?>"  id="#" name="btn_add_data" style="width:100px;font-size:20px;" >Delete</button>
										</td>-->
										</tr>
									<?php 
									$counting++;
									}
									} 
									?>
									
								</tbody>
								
							  </table>
								</div>
								
							  <?php 
							  $counts++;
							  }
							  }
							  }							  
							  ?>
							</div>
							
							</div>
							<hr>
							<div class="row">
								<div class="col-lg-12">
								<?php
								if(!empty($report_no_array))
								{
									
									?>
									<a data-toggle="collapse" href="#collapse" class="btn btn-primary" style="width:100%;margin-top: 2%;font-size: 20px;" id="add_material_button">ADD NEW MATERIAL</a>
									<div id="collapse" class="panel-collapse collapse">
									<br>
									<input type="hidden" name="txt_report_no" id="reportno" value="<?php echo $report_no_array[0];?>"> 
									<input type="hidden" name="txt_lab_no" id="labno" value="<?php echo $lab_no_array[0];?>"> 
									<input type="hidden" name="txt_ulr_no" id="ulrno" value="<?php echo $ulr_no_array[0];?>"> 
									<input type="hidden" name="txt_finalmatno" id="finalmatno" value="<?php echo $final_mat_id_array[0];?>"> 
									
									
									<div class="row">
									<div class="col-md-4">
									<label for="exampleInputEmail1">Select Category<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-4">
									<label for="exampleInputEmail1">Select Material<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-4">
									<label for="exampleInputEmail1">Expec. submission Date:</label>
									</div>
									
									</div>
									
									<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control select2" name="select_material_category" id="select_material_category" >
													<option value="">Select Category</option>
													<?php 
													$sql = "select * from material_category where `material_cat_status`='1' AND `material_cat_isdelete`='0'";
												
													$result = mysqli_query($conn, $sql);

													if (mysqli_num_rows($result) > 0) {
														while($row = mysqli_fetch_assoc($result)) {
													
													?>
			
													<option value="<?php echo $row['material_cat_id'];?>"><?php echo $row['material_cat_name'];?></option>
													<?php }}?>
												</select>
											</div>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
											<select class="form-control select2" name="select_material" id="select_material">
													<option value="">Select Material</option>
													
											</select>
												<!--<a href="javascript:void(0)" id="get_more" class=" btn btn-primary"><i class="fa fa-undo" aria-hidden="true"></i></a>-->
												<!--<input type="hidden" value="20" id="get_more_count">-->
											</div>
											
										</div>
									</div>
									
								
									
									<div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
												<div class="col-sm-12">
												<input type="text"  style="height:30px;" name="ex_date_submission" id="ex_date_submission" value="<?php echo date('d/m/Y')?>">
											</div>
											</div>
										</div>
									</div>
									</div>
									
									<br>
								<div class="row">
									<div class="col-md-4">
									<label for="exampleInputEmail1">Sample Conditon:</label><br>
									
									</div>
									<div class="col-md-4">
									<label for="exampleInputEmail1">Location:</label><br>
									
									</div>
									
									
								</div>
								<div class="row">
									<div class="col-md-4">
									<div class="form-group">
											
											<div class="col-sm-12">
									<select class="form-control select2" name="select_samp_condition" id="select_samp_condition">
										<option value="">Select Conditon</option>
										<option value="1" selected>Sealed</option>
										<option value="2">Unsealed</option>
										<option value="3">Good</option>
										<option value="4">Poor</option>
									</select>
									</div>
									</div>
									</div>
									<div class="col-md-4">
									<div class="form-group">
											
											<div class="col-sm-12">
									<select class="form-control select2" name="select_location" id="select_location">
										<option value="">Select Location</option>
										<option value="1" selected>In Laboratory</option>
										<option value="2">On Site</option>
									</select>
									</div>
									</div>
									</div>
									
									
									</div>
									<br>
									
									<div class="row">
									<div class="col-md-12">
										<div class="box box-info">
											<form class="form" id="billing" method="post">
												<div class="panel-group">
													<div class="panel panel-default">
														<br>
														<div class="panel-heading">
															<h4 class="panel-title" style="text-align:center;">
																<a data-toggle="collapse" href="#collapsings" class="btn btn-primary" style="color:white;width:20%;"><b>Type Of Sample</b></a>
															</h4>
														</div><br>
														<div id="collapsings" class="panel-collapse collapse">
															<div class="panel-body">
																<div class="row material_class" id="CM">
																	<div class="col-md-12">
																		<h4 style="text-align:center;"><b>Cement</b></h4>
																	</div>
																	<hr style="border: 1px solid #ddd;">
																		<div class="col-md-3">
																			<div class="box-body">
																				<div class="form-group">
																					<label>Type Of Cement</label>
																					<select class="form-control" id="type_of_cement" name="type_of_cement">
																						<option value="OPC">OPC</option>
																						<option value="PPC">PPC</option>
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="box-body">
																				<div class="form-group">
																					<label>Grade</label>
																					<select class="form-control" id="cement_grade" name="cement_grade">
																						<option value="53 OPC">53 OPC</option>
																						<option value="43 OPC">43 OPC</option>
																						<option value="33 OPC">33 OPC</option>
																						<option value="PPC">PPC</option>
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="box-body">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Brand</label>
																				  <input type="text" class="form-control" id="cement_brand" name="cement_brand" placeholder="Brand">
																				</div>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="box-body">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Week No.</label>
																				  <input type="text" class="form-control" id="week_no" name="week_no" placeholder="Week No.">
																				</div>
																			</div>
																		</div>
																	</div>
																		
																	<div class="row material_class" id="CA">
																	<div class="col-md-12">
																		<h4 style="text-align:center;"><b>Aggregate</b></h4>
																	</div>
																	<hr style="border: 1px solid #ddd;">
																		<div class="col-md-3">
																				<div class="box-body">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Source</label>
																					  <input type="text" class="form-control" id="brick_source" name="brick_source" placeholder="Source">
																					</div>
																				</div>
																	</div>
																	<div class="col-md-3">
																		<div class="box-body">
																			<div class="form-group">
																			  <label for="exampleInputEmail1">Sample Description</label>
																			  <input type="text" class="form-control" id="sample_de" name="sample_de" placeholder="Sample Description">
																			</div>
																		</div>
																	</div>
																	</div>
																	
																	<div class="row material_class" id="BR">
																		<div class="col-md-12">
																			<h4 style="text-align:center;"><b>Brick</b></h4>
																		</div>
																		<hr style="border: 1px solid #ddd;">
																		
																			
																			<div class="col-md-6">
																				<div class="box-body">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Mark</label>
																					  <input type="text" class="form-control" id="mark" name="mark" style="text-transform:uppercase;" placeholder="Mark">
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="box-body">
																					<div class="form-group">
																						<label>Specification</label>
																						<select class="form-control" id="brick_specification" name="brick_specification">
																							<option value="3.5">3.5</option>
																							<option value="5">5</option>
																							<option value="7.5">7.5</option>
																							<option value="10">10</option>
																							<option value="12.5">12.5</option>
																							<option value="15">15</option>
																							<option value="17.5">17.5</option>
																							<option value="20">20</option>
																							<option value="25">25</option>
																							<option value="30">30</option>
																							<option value="35">35</option>
																						</select>
																					</div>
																				</div>
																			</div>
																		
																	</div>
																	
																	
																	<div class="row material_class" id="BT">
																	<div class="col-md-12">
																		<h4 style="text-align:center;"><b>Bitumin</b></h4>
																	</div>
																	<hr style="border: 1px solid #ddd;">
																		<div class="col-md-3">
																			<div class="box-body">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Tanker No.</label>
																				  <input type="text" class="form-control" id="tanker_no" name="tanker_no" placeholder="Tanker No">
																				</div>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="box-body">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Lot No.</label>
																				  <input type="text" class="form-control" id="lot_no" name="lot_no" placeholder="Lot No.">
																				</div>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="box-body">
																				<div class="form-group">
																					<label>Grade</label>
																					<select class="form-control" id="bitumin_grade" name="bitumin_grade">
																						<option value="vg-10">VG-10</option>
																						<option value="vg-20">VG-20</option>
																						<option value="vg-30">VG-30</option>
																						<option value="vg-40">VG-40</option>
																						
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="box-body">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Make</label>
																				  <input type="text" class="form-control" id="make" name="make" placeholder="Make">
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	
																	<div class="row material_class" id="CC">
																	<div class="col-md-12">
																		<!--<h4 style="text-align:center;"><b>C C Cube</b></h4>-->
																	</div>
																	<hr style="border: 1px solid #ddd;">
																		<div class="col-md-4">
																			<div class="box-body col-sm-6">
																				<div class="form-group">
																					<label>Grade</label>
																					<select class="form-control" id="cube_grade" name="cube_grade">
																						<option value="">Grade</option>
																						<option value="M-10">M - 10</option>
																						<option value="M-15">M - 15</option>
																						<option value="M-20">M - 20</option>
																						<option value="M-25">M - 25</option>
																						<option value="M-30">M - 30</option>
																						<option value="M-35">M - 35</option>
																						<option value="M-40">M - 40</option>
																						<option value="1:3:6">1:3:6</option>
																						<option value="1:2:4">1:2:4</option>
																						<option value="1:1.5:3">1:1.5:3</option>
																						<option value="1:5">1:5</option>
																						<option value="1:3">1:3</option>
																						
																					</select>
																				</div>
																			</div>
																			
																			<div class="box-body col-sm-5">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Casting Date</label>
																			<input type="text" class="form-control" id="casting_date" name="casting_date" placeholder="Casting Date" value="">
																				</div>
																			</div>
																			
																		</div>
																		<div class="col-md-4">
																			
																			<div class="box-body col-sm-4">
																				<div class="form-group">
																					<label>Day</label>
																				<select class="form-control" id="day" name="day">
																					<option value="7">7 Days</option>
																					<option value="28">28 Days</option>
																					<!--<option value="7_28">7 & 28 Days</option>-->
																					<option value="other">Other</option>
																						
																					</select>
																				</div>
																			</div>
																			
																			<div class="box-body col-sm-6 only_remark">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Remarks</label>
																				  <input type="text" class="form-control" id="day_remark" name="day_remark" placeholder="Remarks">
																				</div>
																			</div>
																		
																		</div>
																		<div class="col-md-2">
																			<div class="box-body">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Identification Mark</label>
																				  <input type="text" class="form-control" id="cc_identification" name="cc_identification" placeholder="Identification Mark" Value="">
																				</div>
																			</div>
																		</div>
																		
																		<input type="hidden" class="form-control" id="set_of_cube" name="set_of_cube"  Value="1">
																				
																		
																		<input type="hidden" class="form-control" id="no_of_cube" name="no_of_cube" value="3" disabled>
																				
																	</div>
																	
																	
																	<div class="row material_class" id="PB">
																		<div class="col-md-12">
																		<h4 style="text-align:center;"><b>Paver Block</b></h4>
																		</div>
																		<hr style="border: 1px solid #ddd;">
																		<div class="col-md-5">
																			<div class="box-body col-sm-6">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Shape</label>
																				  <select class="form-control" id="shape" name="shape">
																					<option value="i_shape">I - Shape</option>
																					<option value="zigzag">Zigzag</option>
																					<option value="damru">Damru</option>
																					<option value="plain">Plain</option>
																				   </select>
																				  
																				</div>
																			</div>
																		
																			<div class="box-body col-sm-6">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Age</label>
																				  <input type="text" class="form-control" id="age" name="age" placeholder="Age">
																				</div>
																			</div>
																		</div>
																		<div class="col-md-5">
																			<div class="box-body col-sm-6">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Color</label>
																				  <input type="text" class="form-control" id="color" name="color" placeholder="Color">
																				</div>
																			</div>
																		
																			<div class="box-body col-sm-6">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Thickness(mm)</label>
																				  <select class="form-control" id="thickness" name="thickness">
																					<option value="">Select Thickness</option>
																					<option value="50">50</option>
																					<option value="60">60</option>
																					<option value="80">80</option>
																					<option value="100">100</option>
																					<option value="120">120</option>
																					
																				   </select>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-2">
																			<div class="box-body">
																				<div class="form-group">
																				  <label for="exampleInputEmail1">Grade</label>
																				  <select class="form-control" id="paver_grade" name="paver_grade">
																					<option value="">Select Grade</option>
																					<option value="M-20">M - 20</option>
																					<option value="M-25">M - 25</option>
																					<option value="M-30">M - 30</option>
																					<option value="M-35">M - 35</option>
																					<option value="M-40">M - 40</option>
																					<option value="M-45">M - 45</option>
																					<option value="M-50">M - 50</option>
																					<option value="M-55">M - 55</option>
																					<option value="M-60">M - 60</option>
																					
																					
																				   </select>
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	<div class="row material_class" id="SO">
																	<div class="col-md-12">
																		<h4 style="text-align:center;"><b>Soil</b></h4>
																	</div>
																	<hr style="border: 1px solid #ddd;">
																	<div class="col-md-2">
																				<div class="box-body">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Sample Type</label>
																					  <input type="text" class="form-control" id="sample_type" name="sample_type" placeholder="Sample Type">
																					</div>
																				</div>
																			</div>
																	<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Source</label>
															  <input type="text" class="form-control" id="soil_source" name="soil_source" placeholder="Soil Source">
															</div>
														</div>
												</div>
																	</div>
																	
																	<div class="row  material_class" id="ST">
																		
																		<div class="col-md-12">
																			<h4 style="text-align:center;"><b>Steel</b></h4>
																		</div>
																		<hr style="border: 1px solid #ddd;">
																				<div class="box-body col-md-4" >
																					<div class="form-group">
																						<label>Dia (mm)</label>
																						<input type="text" class="form-control" id="dia" name="dia" placeholder="Dia">
																						
																					</div>
																				</div>
																				<div class="box-body col-md-4" >
																					<div class="form-group">
																						<label>Grade</label>
																						<select class="form-control" id="steel_grade" name="steel_grade">
																							<option value="FE 415">FE 415</option>
																							<option value="FE 415 D">FE 415 D</option>
																							<option value="FE 500">FE 500</option>
																							<option value="FE 500 D">FE 500 D</option>
																							<option value="FE 550">FE 550</option>
																							<option value="FE 550 D">FE 550 D</option>
																							
																						</select>
																					</div>
																				</div>
																				<div class="box-body col-md-4">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Brand</label>
																					  <input type="text" class="form-control" id="steel_brand" name="steel_brand" placeholder="Brand">
																					</div>
																				</div>
																			
																	
																	</div>
																	
																	<div class="row  material_class" id="WA">
																	<div class="col-md-12">
																		<h4 style="text-align:center;"><b>Water</b></h4>
																	</div>
																	<hr style="border: 1px solid #ddd;">
																	<div class="box-body col-md-3">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Source</label>
																					  <input type="text" class="form-control" id="tile_source" name="tile_source" placeholder="Source">
																					</div>
																				</div>
																	
																	</div>
																											
																	<div class="row  material_class" id="TI">
																		
																			<div class="col-md-12">
																				<h4 style="text-align:center;"><b>Tiles</b></h4>
																			</div>
																		<hr style="border: 1px solid #ddd;">	
																			
																			<div class="col-md-6">
																				<div class="box-body">
																					<div class="form-group">
																						<label>Specification</label>
																						<input type="text" class="form-control" id="tiles_specification" name="tiles_specification" placeholder="Specification">
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				
																				<div class="box-body">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Brand</label>
																					  <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand">
																					</div>
																				</div>
																			</div>
																			
																		
																	</div>
																	
																	<div class="row  material_class" id="FA">
																		
																			<div class="col-md-12">
																				<h4 style="text-align:center;"><b>Fine Aggregate</b></h4>
																			</div>
																		<hr style="border: 1px solid #ddd;">	
																			
																			<div class="col-md-6">
																				
																				<div class="box-body">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Fine Aggregate Source</label>
																					  <input type="text" class="form-control" id="fine_agg_source" name="fine_agg_source" placeholder="Fine Aggregate Source">
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				
																				<div class="box-body">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Fine Aggregate Type</label>
																					  <input type="text" class="form-control" id="fine_agg_type" name="fine_agg_type" placeholder="Fine Aggregate Type">
																					</div>
																				</div>
																			</div>
																			
																			
																	</div>
																	
																	<div class="row  material_class" id="QU">
																		
																			<div class="col-md-12">
																				<h4 style="text-align:center;"><b>Quarry Spall</b></h4>
																			</div>
																		<hr style="border: 1px solid #ddd;">	
																			
																			<div class="col-md-6">
																				
																				<div class="box-body">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Quarry Spall Source</label>
																					  <input type="text" class="form-control" id="qa_spall_source" name="qa_spall_source" placeholder="Quarry Spall Source">
																					</div>
																				</div>
																			</div>
																			
																			
																	</div>
																	
																	
																	<div class="row  material_class" id="FT">
																		
																			<div class="col-md-12">
																				<h4 style="text-align:center;"><b>Field Test</b></h4>
																			</div>
																		<hr style="border: 1px solid #ddd;">	
																			
																			<div class="col-md-6">
																				
																				<div class="box-body">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Chainage No.</label>
																					  <input type="text" class="form-control" id="chainage_no" name="chainage_no" placeholder="Enter Chainage No.">
																					</div>
																				</div>
																			</div><div class="col-md-6">
																				
																				<div class="box-body">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Sample Description.</label>
																					  <input type="text" class="form-control" id="fdd_desc_sample" name="fdd_desc_sample" placeholder="Enter Sample Description." Value="GSB">
																					</div>
																				</div>
																			</div>
																			
																			
																	</div>
																	
																	<div class="row  material_class" id="BM">
																		
																			<div class="col-md-12">
																				<h4 style="text-align:center;"><b>Bitumin Mix</b></h4>
																			</div>
																		<hr style="border: 1px solid #ddd;">	
																			
																			<div class="col-md-6">
																				
																				<div class="box-body">
																					<div class="form-group">
																					  <label for="exampleInputEmail1">Bitumin Specification</label>
																					  
																					  <select class="form-control" id="bitumin_mix" name="bitumin_mix">
																							<option value="BC-I">BC-I</option>
																							<option value="BC-II">BC-II</option>
																							<option value="DBM-I">DBM-I</option>
																							<option value="DBM-II">DBM-II</option>
																							<option value="SDBC-I">SDBC-I</option>
																							<option value="SDBC-II">SDBC-II</option>
																							
																						</select>
																					</div>
																				</div>
																			</div>
																			
																			
																	</div>
																	</div>
																  <!-- /.box-body -->

																  
															
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
									<hr style="border:var(--primary) 2px solid;">
									
									<div class="row">
									<div class="col-md-1">
									<label for="chk_for_star">
									Select Test<span class="mede_class" id="id_for_star"></span>:<label>
									<input type="hidden" name="txt_is_sample" id="txt_is_sample" value="0">
									<input type="checkbox" class="visually-hidden" name="chk_for_star"  id="chk_for_star" value="0">									
									</div>
									<div class="col-md-2">
									<div id="put_all_chk_box">
									</div>
									</div>
									<!--<div class="col-md-2">
									<label for="exampleInputEmail1">Admin Supply:<span class="mede_class">*</span>:</label>
									
									</div>-->
									<div class="col-md-2">
									<label for="exampleInputEmail1">Tested By<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-3">
									<label for="exampleInputEmail1">Reported By<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-4">
										<label for="exampleInputEmail1">Excel Uploaded<span class="mede_class">*</span>:</label>
									</div>
									</div>
									
									<div class="row">
									<div class="col-md-2">
											<div class="form-group">
												
												<div class="col-sm-3">
													<select class="form-control" name="select_test" id="select_test" multiple="multiple">
														
													</select>
												</div>
												
											</div>
									</div>
									<div class="col-md-2">
									<input type="hidden" name="radio" value="r">
										<div class="form-group">
											
											<div class="col-sm-12">
												
												<select class="form-control " name="sel_tested_by" id="sel_tested_by" style="height:50px;">
													
												</select>
											</div>
										</div>
									</div>
								
								<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
											<select class="form-control " name="reported_by" id="reported_by" style="height:50px;">
													<?php 
													
													$sel_staff="select * from multi_login where `staff_isadmin`='5'";
													$query_staff=mysqli_query($conn,$sel_staff);
													if(mysqli_num_rows($query_staff) > 0)
													{
														while($rowss=mysqli_fetch_array($query_staff))
														{
															
															?>
																<option value="<?php echo $rowss['id']?>"><?php echo $rowss['staff_fullname']?></option>
													
												<?php 		
														}
													}
												?>
												</select>
												
											</div>
										</div>
								</div>
								
								<div class="col-md-4">
										<div class="form-group">
											
											<div class="col-sm-12">
												<input type="radio" style="width:33px;height:25px;" name="exel_radio" value="y"><span style="font-size:35px;" ><b>YES</b></span>
												<input type="radio" style="width:33px;height:25px;"name="exel_radio" value="n" checked><span style="font-size:35px;"><b>No<b></span>
											</div>
										</div>
								</div>
								</div>
								<br>
								<br>
								<div class="row">
								
								<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<button type="button" class="btn btn-info"  onclick="addData('add_material_in_edit')" name="btn_add_data" id="btn_add_data" style="width:100%;font-size:20px;margin-left:160%;" >Save</button>
											</div>
										</div>
								</div>
								</div>
								
									</div>
									<?php 								
									
									
								}
								?>
								</div>
							</div>
							
							</div>
						
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>
<link rel="stylesheet" href="bower_components/custom/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="bower_components/custom/bootstrap-multiselect.js"></script>
		  	  
<script>
$(function () {
    $('.select2').select2();
  });
$(document).ready(function(){
	   $('#select_test').multiselect();
	$(".only_remark").hide();
	$(".material_class").hide();
	get_span_assign_after_save();
	//get_span_assign();
	get_span_set_sam_rec_date("0","onload");
});

$('#casting_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	})
	
	$('#fortest_casting_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	})
	
$('#ex_date_submission').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	})
	
	$('#ex_date_submission_for_test').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	})
   // on category change 
$("#select_material_category").change(function(){
      var select_material_category = $('#select_material_category').val(); 
	  var txt_report_no = $('#txt_report_no').val();
	   var txt_job_no = $('#txt_job_no').val();
	  var postData = 'action_type=get_material_by_category&select_material_category='+select_material_category+'&txt_report_no='+txt_report_no+'&txt_job_no='+txt_job_no;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					$('#select_material').html(data.all_material);	
				    //$('#txt_lab_no').val(data.final_lab_id);
				    $('#hidden_lab_no').val(data.final_lab_id);
					$('#select_test').html(data.out_tests);
					$('#put_all_chk_box').html(data.put_chk_box);
					$('#sel_tested_by').html(data.out_materials_engineer);
					$('#select_test').multiselect('rebuild');

				    $('#get_more_count').val(20);
					$("#get_more").prop("disabled", false);
					
					var set_sample_id= "#"+data.cate_prefix;
					$(".material_class").hide();
					$(set_sample_id).show();
				 
				 }
			});
});

$("#select_material_category_for_test").change(function(){
      var get_concates = $('#select_material_category_for_test').val(); 
	  var splited = get_concates.split("|");
	  var select_material_category= splited[0];
	  
	  $("#finalmatno_for_test").val(splited[1]);
	  $("#labno_for_test").val(splited[2]);
	  var txt_report_no = $('#txt_report_no').val();
	   var txt_job_no = $('#txt_job_no').val();
	  var postData = 'action_type=get_material_by_category&select_material_category='+select_material_category+'&txt_report_no='+txt_report_no+'&txt_job_no='+txt_job_no;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					$('#select_material_for_test').html(data.all_material);	
				    //$('#txt_lab_no').val(data.final_lab_id);
				    $('#hidden_lab_no').val(data.final_lab_id);
					$('#select_test_for_test').html(data.out_tests);
					$('#put_all_chk_box').html(data.put_chk_box);
					$('#sel_tested_by_for_test').html(data.out_materials_engineer);
					$('#select_test_for_test').multiselect('rebuild');

				    $('#get_more_count').val(20);
					$("#get_more").prop("disabled", false);
					
					var set_sample_id= "#fortest_"+data.cate_prefix;
					$(".material_class").hide();
					$(set_sample_id).show();
				 
				 }
			});
});


// on material change

$("#select_material_for_test").change(function(){
      var select_material = $('#select_material_for_test').val(); 
      var txt_report_no = $('#txt_report_no').val(); 
      var get_concates = $('#select_material_category_for_test').val(); 
	  var splited = get_concates.split("|");
	  var select_material_category= splited[0]; 
      var txt_job_no = $('#txt_job_no').val(); 
	  var postData = 'action_type=get_lab_by_material&select_material='+select_material+'&txt_report_no='+txt_report_no+'&select_material_category='+select_material_category+'&txt_job_no='+txt_job_no;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php", 
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					
					var days=parseInt(data.material_per_day_limit);
					var someDate = new Date();
					someDate.setDate(someDate.getDate() + days);
					
					var dd = someDate.getDate();
					var mm = someDate.getMonth() + 1;
					var y = someDate.getFullYear();

					var someFormattedDate = dd + '/'+ mm + '/'+ y;
					
					//$('#ex_date_submission').val(someFormattedDate);
					
					$('#select_test_for_test').html(data.out_tests);
					$('#select_test_for_test').multiselect('rebuild');
					get_span_set_sam_rec_date(days,"changes");
					
				 }
			});
});


$("#select_material").change(function(){
      var select_material = $('#select_material').val(); 
      var txt_report_no = $('#txt_report_no').val(); 
      var select_material_category = $('#select_material_category').val(); 
      var txt_job_no = $('#txt_job_no').val(); 
	  var postData = 'action_type=get_lab_by_material&select_material='+select_material+'&txt_report_no='+txt_report_no+'&select_material_category='+select_material_category+'&txt_job_no='+txt_job_no;
			
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php", 
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
					
					var days=parseInt(data.material_per_day_limit);
					var someDate = new Date();
					someDate.setDate(someDate.getDate() + days);
					
					var dd = someDate.getDate();
					var mm = someDate.getMonth() + 1;
					var y = someDate.getFullYear();

					var someFormattedDate = dd + '/'+ mm + '/'+ y;
					
					//$('#ex_date_submission').val(someFormattedDate);
					
					$('#select_test').html(data.out_tests);
					$('#select_test').multiselect('rebuild');
					get_span_set_sam_rec_date(days,"changes");
					
				 }
			});
});

//on day changes

$("#day").change(function(){
	var get_days=$("#day").val();
	var get_set_of_cube=$("#set_of_cube").val();
	
	if(get_days !="" && get_days=="other"){
		$(".only_remark").show();
	}else{
		$(".only_remark").hide();
	}
	
	if(get_days=="7_28"){
			var multi=6;
		}else{
			var multi=3;
			
		}
		
		var set_no_of_cobe= get_set_of_cube * multi;
		$("#no_of_cube").val(set_no_of_cobe);
	
	
	
});


//on ulr no  changes

$(document).on("blur",".class_ulr",function(){
	var txt_ulr_no= $(this).val();
	if(txt_ulr_no.length !=5){
		alert("Please Enter 5 Digit In Ulr No.");
		return false;
	}
	var txt_ulr_no_ids= $(this).attr("id");
	var set_first="#first_"+txt_ulr_no_ids;
	var set_third="#third_"+txt_ulr_no_ids;
	var first_ulr= $(set_first).val();
	var third_ulr= $(set_third).val();
	
	var postData = 'action_type=update_ulr_no_by_ids&txt_ulr_no='+txt_ulr_no+'&txt_ulr_no_ids='+txt_ulr_no_ids+'&first_ulr='+first_ulr+'&third_ulr='+third_ulr;
			
		$.ajax({
				url : "<?php $base_url; ?>span_save_material.php", 
				type: "POST",
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					document.getElementById("overlay_div").style.display="none";
				 }
			});
});

//on delete final materials click

$(document).on("click",".delete_final_entry",function(){
	
	var id= $(this).attr("id");
	var postData = '&action_type=delete_final_entry&id='+id;
			
		$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This material?",
        buttons: {
			confirm: function () 
			{
				$.ajax({
						url : "<?php $base_url; ?>span_save_material.php", 
						type: "POST",
						data : postData,
						beforeSend: function(){
							document.getElementById("overlay_div").style.display="block";
						},
						success: function(data)
						 {
							document.getElementById("overlay_div").style.display="none";
							get_span_assign_after_save();
							get_span_set_sam_rec_date("0","onload");
						 }
					});
			},
            cancel: function () {
				return;
            }
			}
        })
});


// on set of cube blur
$(document).on("blur","#set_of_cube",function(){
	var get_days=$("#day").val();
	var get_set_of_cube=$("#set_of_cube").val();
	
	if(get_days !=""){
		if(get_days=="7_28"){
			var multi=6;
		}else{
			var multi=3;
			
		}
		
		var set_no_of_cobe= get_set_of_cube * multi;
		$("#no_of_cube").val(set_no_of_cobe);
		
	}else{
		alert("Select Days");
		$("#no_of_cube").val(0);
		return false;
	}
	
	
	
});

// add data
function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_material_in_edit') {
				var reportno = $('#reportno').val(); 
				var labno = $('#labno').val(); 
				var ulrno = $('#ulrno').val(); 
				var finalmatno = $('#finalmatno').val(); 
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				//var txt_lab_no = $('#txt_lab_no').val(); 
				var type_of_cement = $('#type_of_cement').val(); 
				var cement_grade = $('#cement_grade').val(); 
				var cement_brand = $('#cement_brand').val(); 
				var week_no = $('#week_no').val(); 
				var brick_source = $('#brick_source').val(); 
				var sample_de = $('#sample_de').val(); 
				var mark = $('#mark').val();
				var brick_specification = $('#brick_specification').val();
				var tanker_no = $('#tanker_no').val();
				var lot_no = $('#lot_no').val();
				var bitumin_grade = $('#bitumin_grade').val();
				var make = $('#make').val();
				var cube_grade = $('#cube_grade').val();
				var day_remark = $('#day_remark').val();
				var casting_date = $('#casting_date').val();
				var day = $('#day').val();
				var set_of_cube = $('#set_of_cube').val();
				var no_of_cube = $('#no_of_cube').val();
				var cc_identification = $('#cc_identification').val();
				var chainage_no = $('#chainage_no').val();
				var fdd_desc_sample = $('#fdd_desc_sample').val();
				var shape = $('#shape').val();
				var age = $('#age').val();
				var color = $('#color').val();
				var thickness = $('#thickness').val();
				var paver_grade = $('#paver_grade').val();
				var sample_type = $('#sample_type').val();
				var soil_source = $('#soil_source').val();
				var dia = $('#dia').val();
				var steel_grade = $('#steel_grade').val();
				var steel_brand = $('#steel_brand').val();
				var tile_source = $('#tile_source').val();
				var tiles_specification = $('#tiles_specification').val();
				var fine_agg_source = $('#fine_agg_source').val();
				var fine_agg_type = $('#fine_agg_type').val();
				var qa_spall_source = $('#qa_spall_source').val();
				var bitumin_mix = $('#bitumin_mix').val();
				var tiles_specification = $('#tiles_specification').val();
				var brand = $('#brand').val();
				var select_test = $('#select_test').val();
				var select_samp_condition = $('#select_samp_condition').val();
				var select_location = $('#select_location').val();
				var txt_is_sample = $('#txt_is_sample').val();
				
				
				var tested_by = $('#sel_tested_by').val();
				var reported_by = $('#reported_by').val();
				var ex_date_submission = $('#ex_date_submission').val();
				var chkmorr = $("input[name='radio']:checked").val();
				var exel_radio = $("input[name='exel_radio']:checked").val();
				
				// condition for steel_brand
				if(select_material_category !="" && select_material_category =="10" && dia=="")
				{
					alert("Please Enter Dia First...");
					return false;
				}
				
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="129" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="143" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
			
				if(txt_trf_no !="" && select_material_category !="" && select_material !=""&& select_test !="" && tested_by !=""&& reported_by !=""){
					
				billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&select_material_category='+select_material_category+'&select_material='+select_material+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_no='+week_no+'&brick_source='+brick_source+'&mark='+mark+'&brick_specification='+brick_specification+'&tanker_no='+tanker_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&make='+make+'&cube_grade='+cube_grade+'&day_remark='+day_remark+'&casting_date='+casting_date+'&day='+day+'&set_of_cube='+set_of_cube+'&no_of_cube='+no_of_cube+'&shape='+shape+'&age='+age+'&color='+color+'&thickness='+thickness+'&paver_grade='+paver_grade+'&sample_type='+sample_type+'&dia='+dia+'&steel_grade='+steel_grade+'&steel_brand='+steel_brand+'&tile_source'+tile_source+'&tiles_specification='+tiles_specification+'&brand='+brand+'&select_test='+select_test+'&tested_by='+tested_by+'&reported_by='+reported_by+'&ex_date_submission='+ex_date_submission+'&chkmorr='+chkmorr+'&exel_radio='+exel_radio+'&fine_agg_source='+fine_agg_source+'&qa_spall_source='+qa_spall_source+'&select_samp_condition='+select_samp_condition+'&select_location='+select_location+'&bitumin_mix='+bitumin_mix+'&txt_is_sample='+txt_is_sample+'&cc_identification='+cc_identification+'&chainage_no='+chainage_no+'&fine_agg_type='+fine_agg_type+'&fdd_desc_sample='+fdd_desc_sample+'&reportno='+reportno+'&labno='+labno+'&ulrno='+ulrno+'&finalmatno='+finalmatno+'&sample_de='+sample_de+'&soil_source='+soil_source;
				}else{
					alert(" All Filled Required");
					return false;
				}
				
				//exit();
				
    }else{
				
	
				billData = 'action_type='+type+'&id='+id;
				
    }
     $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(msg){
		document.getElementById("overlay_div").style.display="none";
		alert("Material Successfully Added.");
		location.reload();
         
        }
    }); 
}







function get_span_assign_after_save(){
		
		var str= '<?php echo $_GET["temporary_trf_no"]?>';
		var txt_jb_id= str;
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_assign_after_save&temporary_trf_no='+str,
        success:function(html){
            $('#display_data_after_save').html(html);
        }
    });
}

function get_span_set_sam_rec_date(first,second){
		
		var str= '<?php echo $_GET["trf_no"]?>';
		var txt_jb_id= str;
		var first= first;
		var second= second;
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_set_sam_rec_date_for_edit&temporary_trf_no='+str+'&first='+first+'&second='+second,
        success:function(html){
			//alert(html);
            $('#ex_date_submission').val(html);
            $('#ex_date_submission_for_test').val(html);
        }
    });
}

function get_span_assign(){
		var str= '<?php echo $_GET["temporary_trf_no"]?>';
		var txt_jb_id= str;
		
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_assign&temporary_trf_no='+str,
        success:function(html){
            $('#display_data').html(html);
        }
    });
}


   // $(".open .dropdown-menu checkbox").prop('checked', $(this).prop("checked")); 




 //get more material by category 
$(document).on('click','.delete_test', function(event){
   
var clicked_id= $(this).attr('data-id');	
	var postData = 'action_type=delete_only_test&clicked_id='+clicked_id;
			
			$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Test?",
        buttons: {
			confirm: function () 
			{
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					//alert(data.msg);
					var set_ids= "#tr_" + data.span_main_id;
					$(set_ids).remove();
					document.getElementById("overlay_div").style.display="none";
					
					alert("Test Successfully Deleted.");
					location.reload();
				 
				 }
			});
			},
            cancel: function () {
				return;
            }
			}
        });
});
$(document).on('click','.delete_materials', function(event){
   
var clicked_id= $(this).attr('data-id');	
	var postData = 'action_type=delete_one_materials_and_report_also&clicked_id='+clicked_id;
			
			$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Materials?",
        buttons: {
			confirm: function () 
			{
			$.ajax({
				url : "<?php $base_url; ?>span_save_material.php",
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					//alert(data.msg);
					var set_ids= "#tr_" + data.span_main_id;
					$(set_ids).remove();
					document.getElementById("overlay_div").style.display="none";
					
					alert("Material Successfully Deleted.");
					location.reload();
					
				 
				 }
			});
			},
            cancel: function () {
				return;
            }
			}
        });
});

$('#chk_for_star').click(function() {
   
	var txt_is_sample= $("#txt_is_sample").val();
	
	if(txt_is_sample=="0")
	{
		$("#txt_is_sample").val("1");
		$('#id_for_star').text('*');
	}else
	{
		$("#txt_is_sample").val("0");
		$('#id_for_star').text('');
	}
});
	
</script>
