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

// get data for edit from save_material_assign table
	$get_report_no=  $_GET["report_no"];
	$get_job_no=  $_GET["job_no"];
	$sel_save_mate="select * from save_material_assign where `report_no`='$get_report_no' AND `job_no`='$get_job_no'";
	
	$query_save_mate= mysqli_query($conn,$sel_save_mate);
	$result_save_mate=mysqli_fetch_array($query_save_mate);

if(isset($_POST["update_all_material"]))
{
	$txt_final_report_no= $_POST["txt_final_report_no"];
	$txt_final_job_no= $_POST["txt_final_job_no"];

	// update in span_material_assign table
	$update_span_master="update span_material_assign set `is_save`=1 where `report_no`='$txt_final_report_no' AND `job_number`='$txt_final_job_no'";
	$result_span_master=mysqli_query($conn,$update_span_master);
	
	// Delete in span_material_assign table
	$del_span="delete from span_material_assign where `isdeleted`=1";
	$result_del_span=mysqli_query($conn,$del_span);
	
	?>
	<script >
	window.location.href="<?php echo $base_url; ?>edit_span_material_assigning.php?report_no=<?php echo $txt_final_report_no; ?>&&job_no=<?php echo $txt_final_job_no; ?>";
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




.mede_class{
	color:red;
}

</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   
  
<section class="content p-0">
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
									<label for="inputEmail3" class="col-sm-2 control-label">Report No:</label>
											
										  <div class="col-sm-2">
											<input type="text" class="form-control" value="<?php echo $get_report_no;?>" id="txt_report_no" name="txt_report_no" >
										  </div>
										<div class="form-group">
										
										  <label for="inputEmail3" class="col-sm-2 control-label">Job No:</label>
											<div class="col-sm-3">
												<div class="input-group date">
													<input type="text" class="form-control" value="<?php echo $get_job_no;?>" id="txt_job_no" name="txt_job_no" >
											</div>
										</div>
									</div>
								
								</div>
							</div>
							<div class="panel-group">
							  
								<a data-toggle="collapse" href="#collapse1" class="btn btn-primary" style="width: 100%;margin-top: 2%;font-size: 20px;" id="add_material_button">Add Material</a>
								<div id="collapse1" class="panel-collapse collapse">
								<br>
								<form class="form" id="add_mate_form" method="post">
									<div class="row">
									<div class="col-md-3">
									<label for="exampleInputEmail1">Select Category<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-3">
									<label for="exampleInputEmail1">Select Material<span class="mede_class">*</span>:</label>
									</div>
									<div class="col-md-3">
									<label for="exampleInputEmail1">Lab No:</label>
									</div>
									<div class="col-md-3">
									<label for="exampleInputEmail1">Expec. submission Date:</label>
									</div>
								</div>
								  <div class="row">
								  <div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control " name="select_material_category" id="select_material_category" >
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
									
									<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control " name="select_material" id="select_material" >
													<option value="">Select Material</option>
													
												</select>
											</div>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<div class="col-sm-2">
												<input type="text"  style="height:50px;" name="txt_lab_no" id="txt_lab_no" placeholder="Lab No">
											</div>
											</div>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<div class="col-sm-2">
												<input type="text"  style="height:50px;" name="ex_date_submission" id="ex_date_submission" value="<?php echo date('d/m/Y')?>">
											</div>
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
											<a data-toggle="collapse" href="#collapse2" class="btn btn-primary" style="color:white;width:100%;"><b>Type Of Sample</b></a>
										</h4>
									</div><br>
									<div id="collapse2" class="panel-collapse collapse">
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
													<h4 style="text-align:center;"><b>C C Cube</b></h4>
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
																	<option value="M-45">M - 45</option>
																	<option value="M-50">M - 50</option>
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
															  <input type="text" class="form-control" id="casting_date" name="casting_date" placeholder="Casting Date" <?php echo date("d-m-Y");?>>
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
																<option value="7_28">7 & 28 Days</option>
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
															  <label for="exampleInputEmail1">Set Of Cube</label>
															  <input type="text" class="form-control" id="set_of_cube" name="set_of_cube" placeholder="Set Of Cube" Value="1">
															</div>
														</div>
													</div>
													
													<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">No Of Cube</label>
															  <input type="text" class="form-control" id="no_of_cube" name="no_of_cube" placeholder="No Of Cube" value="3" disabled>
															</div>
														</div>
													</div>
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
															  <label for="exampleInputEmail1">Thickness</label>
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
																  <label for="exampleInputEmail1">Location</label>
																  <input type="text" class="form-control" id="location" name="location" placeholder="Location">
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
												</div>
											  <!-- /.box-body -->

											  
										
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
								<div class="row">
									<div class="col-md-2">
									<label for="exampleInputEmail1">Select Test<span class="mede_class">*</span>:<label>
									
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
									<div class="col-md-2">
										<label for="exampleInputEmail1">Excel Uploaded<span class="mede_class">*</span>:</label>
									</div>
								</div>
								<div class="row">
								<div class="col-md-2">
										<div class="form-group">
											
											<div class="col-sm-12">
											
												 <select class="form-control" name="select_test" id="select_test" multiple="multiple"> 
												
												</select>
												<!--<select class="form-control " name="select_test" id="select_test" >
													<option value="">Select Test</option>
													
												</select>-->
											</div>
										</div>
								</div>
								
								<!--<div class="col-md-2">
										<div class="form-group">
											
											<div class="col-sm-12">
												<input type="radio" style="width:33px;height:25px;" name="radio" value="m" checked><span style="font-size:35px;" ><b>M</b></span>
												<input type="radio" style="width:33px;height:25px;"name="radio" value="r"><span style="font-size:35px;"><b>R<b></span>
											</div>
										</div>
								</div>-->
								
								<div class="col-md-2">
								<input type="hidden" name="radio" value="r">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control " name="tested_by" id="tested_by" style="height:50px;">
													<option value="">Select Enginner</option>
													<?php 
													$sel_staff="select * from staff where `staff_isadmin`=4";
													$query_staff=mysqli_query($conn,$sel_staff);
													if(mysqli_num_rows($query_staff) > 0){
													while($rowss=mysqli_fetch_array($query_staff)){?>
													<option value="<?php echo $rowss['id']?>"><?php echo $rowss['staff_fullname']?></option>
													
													<?php }}?>
												</select>
											</div>
										</div>
								</div>
								
								<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<select class="form-control " name="reported_by" id="reported_by" style="height:50px;">
													<option value="">Select Quality Manager</option>
													<?php 
													$sel_staff="select * from staff where `staff_isadmin`=5";
													$query_staff=mysqli_query($conn,$sel_staff);
													if(mysqli_num_rows($query_staff) > 0){
													while($rowss=mysqli_fetch_array($query_staff)){?>
													<option value="<?php echo $rowss['id']?>"><?php echo $rowss['staff_fullname']?></option>
													
													<?php }}?>
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
								
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12" style="">
												<button type="button" class="btn btn-info"  onclick="addData('add_material_assinging')" name="btn_add_data" id="btn_add_data" style="width:100%;font-size:20px;margin-left:160%;" >Add Test</button>
											</div>
										</div>
								</div>
								</div>
								</div>
							</div>
							</form>
							<div class="row">
									<div class="col-lg-12">
									<div id="display_data">
									<input type="hidden" name="hidden_lab_no" id="hidden_lab_no" value="<?php echo $get_lab_no;?>">
									</div>
									</div>
							</div>
							<div class="box-footer">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
									
											<div class="col-sm-12">
												<button type="button" class="btn btn-info"  onclick="savedata('add_material_assinging_save')" name="btn_add_data_save" id="btn_add_data_save" style="width:100%;font-size:20px;display:none;" >Save Test</button>
											</div>
											
										</div>
									</div>
								</div>	
								<div class="row">
								<div class="col-lg-12">
										<div class="form-group">
												<div class="col-sm-12">
												
												
												<form name="frm_update" method="post">
												<input type="hidden" value="<?php echo $_GET['report_no']?>" name="txt_final_report_no">
												<input type="hidden" value="<?php echo $_GET['job_no']?>" name="txt_final_job_no">
												<input type="submit" class="btn btn-info" name="update_all_material" id="update_all_material" style="width:100%;font-size:20px;display:none;" value="UPDATE">
												</form>
												</div>
								</div>
										</div>
										
								</div>
								
							</div>
							<br>
							<br>
							<div class="row">
									<div class="col-lg-12">
									<div id="display_data_after_save">
									
									<table class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;">Lab Id</th>
										<th style="text-align:center;">Material Category</th>
										<th style="text-align:center;">Material</th>
										<!--<th style="text-align:center;">Action</th>-->
									</tr>
										
								</thead>
								<tbody>
									<?php 
										$count=0;
										$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$get_job_no' ORDER BY final_material_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											
										$sel_cate="select * from material_category where `material_cat_id`=".$row['material_category'];
										$result_cat=mysqli_query($conn,$sel_cate);
										$row_cat=mysqli_fetch_array($result_cat);
										
										$sel_mat="select * from material where `id`=".$row['material_id'];
										$result_mat=mysqli_query($conn,$sel_mat);
										$row_mat=mysqli_fetch_array($result_mat);
										
										
									?>
										<tr>
										<td style="white-space:nowrap;text-align:center;">
										<button type="button" class="btn btn-info"  onclick="editData('edit_material','<?php echo $row['lab_no']."|".$row['job_no']."|".$row['report_no'];?>','<?php echo $row['material_category']."|".$row['material_id']."|".$row['report_no']."|".$row['expected_date'];?>')" name="btn_add_data" style="width:100px;font-size:20px;" >Edit</button>
										
										<button type="button" class="btn btn-info"  onclick="deleteData('delete_particular_material','<?php echo $row['lab_no']."|".$row['job_no']."|".$row['report_no']."|".$row['final_material_id'];?>')" name="btn_add_data" style="width:100px;font-size:20px;" >Delete</button>
										</td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row['lab_no'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_cat['material_cat_name'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_mat['mt_name'];?></td>
										
										<!--<td style="text-align:center;">
											<button type="button" class="btn btn-info"  onclick="addData('delete_final_entry',<?php //echo $row['final_material_id'];?>)" name="btn_add_data" style="width:100px;font-size:20px;" >Delete</button>
										</td>-->
										</tr>
									<?php
										}	
									?>
								</tbody>
								
							  </table>
									</div>
									</div>
							</div>
							<form name="frm-save" method="post">
							<div class="row">
								<div class="col-lg-12">
									<a href="rec2_pending_job_for_est.php" class="btn btn-info"style="width:50%;font-size:20px;margin-left: 24%;">Save</a>
								</div>
							</div>
							</form>
							</div>
						
					</div>
				</div>
</section>	
</div>

<?php include("footer.php");?>		
<link rel="stylesheet" href="https://www.jquery-az.com/boots/css/bootstrap-multiselect/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="https://www.jquery-az.com/boots/js/bootstrap-multiselect/bootstrap-multiselect.js"></script>
  	  
<script>
$(document).ready(function(){
	 $('#select_test').multiselect();
	$(".only_remark").hide();	
	$(".material_class").hide();
});

$('#casting_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	})
	
$('#ex_date_submission').datepicker({
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
				    $('#txt_lab_no').val(data.final_lab_id);
				    $('#hidden_lab_no').val(data.final_lab_id);
					$('#select_test').html(data.out_tests);	
						$('#select_test').multiselect('rebuild');
					
					var set_sample_id= "#"+data.cate_prefix;
					$(".material_class").hide();
					$(set_sample_id).show();
				 
				 }
			});
});


// on material change

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
					
					$('#ex_date_submission').val(someFormattedDate);
				 
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
    if (type == 'add_material_assinging') {
				var txt_report_no = $('#txt_report_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				var txt_lab_no = $('#txt_lab_no').val(); 
				var type_of_cement = $('#type_of_cement').val(); 
				var cement_grade = $('#cement_grade').val(); 
				var cement_brand = $('#cement_brand').val(); 
				var week_no = $('#week_no').val(); 
				var brick_source = $('#brick_source').val(); 
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
				var shape = $('#shape').val();
				var age = $('#age').val();
				var color = $('#color').val();
				var thickness = $('#thickness').val();
				var paver_grade = $('#paver_grade').val();
				var location = $('#location').val();
				var dia = $('#dia').val();
				var steel_grade = $('#steel_grade').val();
				var steel_brand = $('#steel_brand').val();
				var tile_source = $('#tile_source').val();
				var tiles_specification = $('#tiles_specification').val();
				var fine_agg_source = $('#fine_agg_source').val();
				var qa_spall_source = $('#qa_spall_source').val();
				var brand = $('#brand').val();
				var select_test = $('#select_test').val();
				
				var tested_by = $('#tested_by').val();
				var reported_by = $('#reported_by').val();
				var ex_date_submission = $('#ex_date_submission').val();
				var chkmorr = $("input[name='radio']:checked").val();
				var exel_radio = $("input[name='exel_radio']:checked").val();
				
				
				if(txt_report_no !="" && select_material_category !="" && select_material !=""&& select_test !=""  && tested_by !="" && reported_by !=""){
					
				billData = '&action_type='+type+'&id='+id+'&txt_report_no='+txt_report_no+'&txt_job_no='+txt_job_no+'&select_material_category='+select_material_category+'&select_material='+select_material+'&txt_lab_no='+txt_lab_no+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_no='+week_no+'&brick_source='+brick_source+'&mark='+mark+'&brick_specification='+brick_specification+'&tanker_no='+tanker_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&make='+make+'&cube_grade='+cube_grade+'&day_remark='+day_remark+'&casting_date='+casting_date+'&day='+day+'&set_of_cube='+set_of_cube+'&no_of_cube='+no_of_cube+'&shape='+shape+'&age='+age+'&color='+color+'&thickness='+thickness+'&paver_grade='+paver_grade+'&location='+location+'&dia='+dia+'&steel_grade='+steel_grade+'&steel_brand='+tile_source+'&tiles_specification='+tiles_specification+'&brand='+brand+'&select_test='+select_test+'&tested_by='+tested_by+'&reported_by='+reported_by+'&ex_date_submission='+ex_date_submission+'&chkmorr='+chkmorr+'&exel_radio='+exel_radio+'&fine_agg_source='+fine_agg_source+'&qa_spall_source='+qa_spall_source;
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
          get_span_assign_in_edit();
		  $("#btn_add_data_save").css("display", "block");
		 // $("#update_all_material").css("display", "block");
        }
    });
}

// edit material
function editData(type,id,for_cate_mate){
    id = (typeof id == "undefined")?'':id;
	var splited= for_cate_mate.split("|");
	var splited_only_id= id.split("|");
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'edit_material') {
		billData = '&action_type='+type+'&id='+id;
	}
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: billData,
        success:function(msg){
          $('#display_data').html(msg);
		  set_cate_mate_function(splited[0],splited[1],splited[2]);
          $('#txt_lab_no').val(splited_only_id[0]);
		  $('#select_material_category option[value="'+splited[0]+'"]').prop('selected', true);
		  $('#select_material').append('<option value="'+splited[1]+'">'+splited[1]+'</option>');
		  
		  dArr = splited[3].split("-"); 
			var dateObjects =dArr[2]+ "/" +dArr[1]+ "/" +dArr[0].substring(2); 

		  $('#ex_date_submission').val(dateObjects);
		  
		  $("#update_all_material").css("display", "block");
		  
		  $("#btn_add_data_save").css("display", "none");
		  $("#btn_add_data_save").remove();
		  
		  
		  if($('#add_material_button').hasClass('collapsed')) {
    // accordion is open
			$("#add_material_button").click();
			}
			
		  
		  
		  
        }
    });
}


//function to set select box cartegory and material

function set_cate_mate_function(category_ids,material_ids,report_no){
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
		dataType:'JSON',
        data: 'action_type=set_cate_mate_function&category_ids='+category_ids+'&material_ids='+material_ids+'&report_no='+report_no,
        success:function(html){
			$('#select_material_category option[value="'+category_ids+'"]').prop('selected', true);
            $('#select_material').html(html.mates);
            $('#select_test').html(html.tests);
				$('#select_test').multiselect('rebuild');
			
			$("input[name=radio][value=" + html.admin_supply + "]").attr('checked', 'checked');
			$('#tested_by option[value="'+html.tested_by+'"]').prop('selected', true);
			$('#reported_by option[value="'+html.reported_by+'"]').prop('selected', true);
			$("input[name=exel_radio][value=" + html.excel_upload + "]").attr('checked', 'checked');
			
        }
    });
}


//save in final

function savedata(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_material_assinging_save') {
				var txt_report_no = $('#txt_report_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				var txt_lab_no = $('#txt_lab_no').val(); 
				var expected_date = $('#ex_date_submission').val();
				
				//6/4
				var type_of_cement = $('#type_of_cement').val(); 
				var cement_grade = $('#cement_grade').val(); 
				var cement_brand = $('#cement_brand').val(); 
				var week_no = $('#week_no').val(); 
				var brick_source = $('#brick_source').val(); 
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
				var shape = $('#shape').val();
				var age = $('#age').val();
				var color = $('#color').val();
				var thickness = $('#thickness').val();
				var paver_grade = $('#paver_grade').val();
				var location = $('#location').val();
				var dia = $('#dia').val();
				var steel_grade = $('#steel_grade').val();
				var steel_brand = $('#steel_brand').val();
				var tile_source = $('#tile_source').val();
				var tiles_specification = $('#tiles_specification').val();
				var fine_agg_source = $('#fine_agg_source').val();
				var qa_spall_source = $('#qa_spall_source').val();
				var brand = $('#brand').val();
				var select_test = $('#select_test').val();
				
				var tested_by = $('#tested_by').val();
				var reported_by = $('#reported_by').val();
				var ex_date_submission = $('#ex_date_submission').val();
				var chkmorr = $("input[name='radio']:checked").val();
				var exel_radio = $("input[name='exel_radio']:checked").val();
								
				
				var qty = prompt("ENTER QUANTITY","1");
				if(qty == null)
				{
					alert("Process Cancel Successfully.");
				}
				else
				{
						if (qty != null || qty != "") {
							
								if(qty!=0)
								{
									if(qty > 0)
									{
						
										if(!isNaN(qty))
										{
												
													billData = '&action_type='+type+'&id='+id+'&txt_report_no='+txt_report_no+'&txt_job_no='+txt_job_no+'&select_material_category='+select_material_category+'&select_material='+select_material+'&txt_lab_no='+txt_lab_no+'&expected_date='+expected_date+'&qty='+qty+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_no='+week_no+'&brick_source='+brick_source+'&mark='+mark+'&brick_specification='+brick_specification+'&tanker_no='+tanker_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&make='+make+'&cube_grade='+cube_grade+'&day_remark='+day_remark+'&casting_date='+casting_date+'&day='+day+'&set_of_cube='+set_of_cube+'&no_of_cube='+no_of_cube+'&shape='+shape+'&age='+age+'&color='+color+'&thickness='+thickness+'&paver_grade='+paver_grade+'&location='+location+'&dia='+dia+'&steel_grade='+steel_grade+'&steel_brand='+tile_source+'&tiles_specification='+tiles_specification+'&brand='+brand+'&select_test='+select_test+'&tested_by='+tested_by+'&reported_by='+reported_by+'&ex_date_submission='+ex_date_submission+'&chkmorr='+chkmorr+'&exel_radio='+exel_radio+'&fine_agg_source='+fine_agg_source+'&qa_spall_source='+qa_spall_source;
													
													$.ajax({
													type: 'POST',
													url: '<?php $base_url; ?>span_save_material.php',
													data: billData,
													beforeSend: function(){
													document.getElementById("overlay_div").style.display="block";
													},
													success:function(msg){
													document.getElementById("overlay_div").style.display="none";
													  $('#display_data').html("");
													  $("#add_mate_form")[0].reset();
													  $("#add_material_button").click();
													 // $("#add_material_button").css("display", "none");
													  $("#update_all_material").css("display", "none");
													  $("#final_save").css("display", "block");
													  $("#after_save_portion").css("display", "block");
													  $("#btn_add_data_save").css("display", "none");
													  $("#update_all_material").css("display", "block");
													  get_span_assign_after_save_edit();
													  
													}
												});
										}
										else
										{
											alert("Please Input Valid Quantity.");
										}
									}
									else
									{
										alert("Please Input Valid Quantity.");
									}
								}
								else
								{
									alert("Please Input Valid Quantity.");
								}
						}
						else
						{
								alert("Please Input Valid Quantity.");
						}
				}			
    }
    
}



function get_span_assign_after_save_edit(){
		var str= '<?php echo $_GET["report_no"]?>';
		var txt_jb_id= str.slice(7);
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_assign_after_save_edit&txt_job_no='+txt_jb_id,
        success:function(html){
            $('#display_data_after_save').html(html);
        }
    });
}

function get_span_assign_in_edit(){
		var txt_jb_id= '<?php echo $_GET["report_no"]?>';
		var txt_hidden_lab_id= $("#hidden_lab_no").val();
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_span_assign_in_edit&txt_job_no='+txt_jb_id+'&txt_hidden_lab_id='+txt_hidden_lab_id,
        success:function(html){
            $('#display_data').html(html);
        }
    });
}

// delete particular material
function deleteData(type,id){
    id = (typeof id == "undefined")?'':id;
	
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'delete_particular_material') {
		billData = '&action_type='+type+'&id='+id;
	}
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: billData,
        success:function(msg){
          get_span_assign_after_save_edit()
		}
    });
}

	
</script>
