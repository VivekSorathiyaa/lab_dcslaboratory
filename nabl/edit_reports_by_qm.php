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



	$txt_trf_no= $_GET["trf_no"];
	$txt_jobs= $_GET["job_no"];  
	$lab_no= $_GET["lab_no"];  
	$report_no= $_GET["report_no"];  
	$ulr_nos= $_GET["ulr"];  
	$table_names= $_GET["table_names"];  
	$mt_prefix= $_GET["mt_prefix"];  
	$filename= $_GET["filename"];  
// code for get test by report no and job no


?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}
</style>



<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   
  
<section class="content p-0 edit-reports-by-qm-box">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		Edit Reports
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body">
							<br>
								<div class="row">
									<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-2 control-label">S.R.F. No:</label>
									</div>
									
									<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-2 control-label">Job No:</label>
									</div>
									
								</div>
								<div class="row">
										  <div class="col-sm-6">
											<input type="text" class="form-control" value="<?php echo $_GET['trf_no'];?>" id="txt_trf_no" name="txt_trf_no" disabled>
											<input type="hidden" class="form-control" value="<?php echo $filename;?>" id="filename" name="filename" disabled>
										  </div>
										
											<div class="col-sm-6">
													<input type="text" class="form-control" value="<?php echo $_GET['job_no'];?>" id="txt_job_no" name="txt_job_no" disabled>
											</div>
								</div>
								<br>
								
								<div class="row">
									<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-2 control-label">Report No:</label>
									</div>
									
									<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-2 control-label">Lab No:</label>
									</div>
									
								</div>
								<div class="row">
										  <div class="col-sm-6">
											<input type="text" class="form-control" value="<?php echo $_GET['report_no'];?>" id="txt_report_no" name="txt_report_no" disabled>
										  </div>
										  
										<div class="col-sm-6">
												<input type="text" class="form-control" value="<?php echo $lab_no;?>" id="txt_lab_no" name="txt_lab_no" disabled>

												<input type="hidden" class="form-control" value="<?php echo $table_names;?>" id="table_names" name="table_names" disabled>
												
												<input type="hidden" class="form-control" value="<?php echo $mt_prefix;?>" id="mt_prefix" name="mt_prefix" disabled>
										</div>
								</div>
								
								
							<div class="panel-group">
								<div class="box box-info-inner">
									<div class="box-body">
									  <div class="table-responsive" id="display_data">
										<?php
										$sel_span_table="select * from span_material_assign where `lab_no`='$lab_no' ORDER BY material_assign_id DESC";
										$result_span_table=mysqli_query($conn,$sel_span_table);
										$get_span_table=mysqli_fetch_assoc($result_span_table);
										
										?>
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
																	<option value="OPC" <?php if($get_span_table["type_of_cement"]=="OPC"){ echo "selected"; }?>>OPC</option>
																	<option value="PPC" <?php if($get_span_table["type_of_cement"]=="PPC"){ echo "selected"; }?>>PPC</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
																<label>Grade</label>
																<select class="form-control" id="cement_grade" name="cement_grade">
																	<option value="53 OPC" <?php if($get_span_table["cement_grade"]=="53 OPC"){ echo "selected"; }?>>53 OPC</option>
																	<option value="43 OPC" <?php if($get_span_table["cement_grade"]=="43 OPC"){ echo "selected"; }?>>43 OPC</option>
																	<option value="33 OPC" <?php if($get_span_table["cement_grade"]=="33 OPC"){ echo "selected"; }?>>33 OPC</option>
																	<option value="PPC" <?php if($get_span_table["cement_grade"]=="PPC"){ echo "selected"; }?>>PPC</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Brand</label>
															  <input type="text" class="form-control" id="cement_brand" name="cement_brand" placeholder="Brand" value="<?php echo $get_span_table['cement_brand']; ?>">
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Week No.</label>
															  <input type="text" class="form-control" id="week_no" name="week_no" placeholder="Week No." value="<?php echo $get_span_table['week_number']; ?>">
															</div>
														</div>
													</div>
												</div>
													
												<div class="row material_class" id="CA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Aggregate</b></h4>
												</div>
												<hr style="border: 1px solid black;">
													<div class="col-md-3">
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Source</label>
																  <input type="text" class="form-control" id="brick_source" name="brick_source" placeholder="Source" value="<?php echo $get_span_table['agg_source']; ?>">
																</div>
															</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
																<label for="exampleInputEmail1">Sample Description</label>
																	<input type="text" class="form-control" id="sample_de" name="sample_de" placeholder="Sample Description" value="<?php echo $get_span_table['sample_de']; ?>">
															</div>
														</div>
													</div>
												
												</div>
												
												<div class="row material_class" id="BR">
													<div class="col-md-12">
														<h4 style="text-align:center;"><b>Brick</b></h4>
													</div>
													<hr style="border: 1px solid black;">
													
														
														<div class="col-md-6">
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Mark</label>
																  <input type="text" class="form-control" id="mark" name="mark" style="text-transform:uppercase;" placeholder="Mark" value="<?php echo $get_span_table['brick_mark']; ?>">
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="box-body">
																<div class="form-group">
																	<label>Specification</label>
																	<select class="form-control" id="brick_specification" name="brick_specification">
																		<option value="3.5" <?php if($get_span_table["brick_specification"]=="3.5"){ echo "selected"; }?>>3.5</option>
																		<option value="5" <?php if($get_span_table["brick_specification"]=="5"){ echo "selected"; }?>>5</option>
																		<option value="7.5" <?php if($get_span_table["brick_specification"]=="7.5"){ echo "selected"; }?>>7.5</option>
																		<option value="10" <?php if($get_span_table["brick_specification"]=="10"){ echo "selected"; }?>>10</option>
																		<option value="12.5" <?php if($get_span_table["brick_specification"]=="12.5"){ echo "selected"; }?>>12.5</option>
																		<option value="15" <?php if($get_span_table["brick_specification"]=="15"){ echo "selected"; }?>>15</option>
																		<option value="17.5" <?php if($get_span_table["brick_specification"]=="17.5"){ echo "selected"; }?>>17.5</option>
																		<option value="20" <?php if($get_span_table["brick_specification"]=="20"){ echo "selected"; }?>>20</option>
																		<option value="25" <?php if($get_span_table["brick_specification"]=="25"){ echo "selected"; }?>>25</option>
																		<option value="30" <?php if($get_span_table["brick_specification"]=="30"){ echo "selected"; }?>>30</option>
																		<option value="35" <?php if($get_span_table["brick_specification"]=="35"){ echo "selected"; }?>>35</option>
																	</select>
																</div>
															</div>
														</div>
													
												</div>
												
												
												<div class="row material_class" id="BT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin</b></h4>
												</div>
												<hr style="border: 1px solid black;">
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Tanker No.</label>
															  <input type="text" class="form-control" id="tanker_no" name="tanker_no" placeholder="Tanker No" value="<?php echo $get_span_table['tanker_no']; ?>">
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Lot No.</label>
															  <input type="text" class="form-control" id="lot_no" name="lot_no" placeholder="Lot No."  value="<?php echo $get_span_table['lot_no']; ?>">
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
																<label>Grade</label>
																<select class="form-control" id="bitumin_grade" name="bitumin_grade">
																	<option value="vg-10" <?php if($get_span_table["bitumin_grade"]=="vg-10"){ echo "selected"; }?>>VG-10</option>
																	<option value="vg-20" <?php if($get_span_table["bitumin_grade"]=="vg-20"){ echo "selected"; }?>>VG-20</option>
																	<option value="vg-30" <?php if($get_span_table["bitumin_grade"]=="vg-30"){ echo "selected"; }?>>VG-30</option>
																	<option value="vg-40" <?php if($get_span_table["bitumin_grade"]=="vg-40"){ echo "selected"; }?>>VG-40</option>
																	
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Make</label>
															  <input type="text" class="form-control" id="make" name="make" placeholder="Make" value="<?php echo $get_span_table['bitumin_make']; ?>">
															</div>
														</div>
													</div>
												</div>
												
												
												<div class="row material_class" id="CC">
												<div class="col-md-12">
													<!--<h4 style="text-align:center;"><b>C C Cube</b></h4>-->
												</div>
												<hr style="border: 1px solid black;">
													<div class="col-md-4">
														<div class="box-body col-sm-6">
															<div class="form-group">
																<label>Grade</label>
																<select class="form-control" id="cube_grade" name="cube_grade">
																	<option value="">Grade</option>
																	<option value="M-10" <?php if($get_span_table["cc_grade"]=="M-10"){ echo "selected"; }?>>M - 10</option>
																	<option value="M-15" <?php if($get_span_table["cc_grade"]=="M-15"){ echo "selected"; }?>>M - 15</option>
																	<option value="M-20" <?php if($get_span_table["cc_grade"]=="M-20"){ echo "selected"; }?>>M - 20</option>
																	<option value="M-25" <?php if($get_span_table["cc_grade"]=="M-25"){ echo "selected"; }?>>M - 25</option>
																	<option value="M-30" <?php if($get_span_table["cc_grade"]=="M-30"){ echo "selected"; }?>>M - 30</option>
																	<option value="M-35" <?php if($get_span_table["cc_grade"]=="M-35"){ echo "selected"; }?>>M - 35</option>
																	<option value="M-40" <?php if($get_span_table["cc_grade"]=="M-40"){ echo "selected"; }?>>M - 40</option>
																	<option value="M-45" <?php if($get_span_table["cc_grade"]=="M-45"){ echo "selected"; }?>>M - 45</option>
																	<option value="M-50" <?php if($get_span_table["cc_grade"]=="M-50"){ echo "selected"; }?>>M - 50</option>
																	<option value="1:3:6"  <?php if($get_span_table["cc_grade"]=="1:3:6"){ echo "selected"; }?>>1:3:6</option>
																	<option value="1:2:4"  <?php if($get_span_table["cc_grade"]=="1:2:4"){ echo "selected"; }?>>1:2:4</option>
																	<option value="1:1.5:3"  <?php if($get_span_table["cc_grade"]=="1:1.5:3"){ echo "selected"; }?>>1:1.5:3</option>
																	<option value="1:5"  <?php if($get_span_table["cc_grade"]=="1:5"){ echo "selected"; }?>>1:5</option>
																	<option value="1:3"  <?php if($get_span_table["cc_grade"]=="1:3"){ echo "selected"; }?>>1:3</option>
																	
																</select>
															</div>
														</div>
														
														<div class="box-body col-sm-5">
															<div class="form-group">
															
															<?php 
															if($get_span_table["casting_date"]=="0000-00-00")
															{ 
															$cated_dates= date('d/m/Y',strtotime("0000-00-00"));
															}else
															{
															$cated_dates= date('d/m/Y',strtotime($get_span_table["casting_date"]));
															}
															?>
															  <label for="exampleInputEmail1">Casting Date</label>
														<input type="text" class="form-control casting_date" id="casting_date" name="casting_date" placeholder="Casting Date" value="<?php echo $cated_dates;?>">
															</div>
														</div>
														
													</div>
													<div class="col-md-4">
														
														<div class="box-body col-sm-4">
															<div class="form-group">
																<label>Day</label>
															<select class="form-control" id="day" name="day">
																<option value="7" <?php if($get_span_table["cc_day"]=="7"){ echo "selected"; }?>>7 Days</option>
																<option value="28" <?php if($get_span_table["cc_day"]=="28"){ echo "selected"; }?>>28 Days</option>
																<!--<option value="7_28">7 & 28 Days</option>-->
																<option value="other" <?php if($get_span_table["cc_day"]=="other"){ echo "selected"; }?>>Other</option>
																	
																</select>
															</div>
														</div>
														
														<div class="box-body col-sm-6 only_remark">
															<div class="form-group">
															  <label for="exampleInputEmail1">Souce of Sample</label>
															  <input type="text" class="form-control" id="day_remark" name="day_remark" placeholder="Remarks" value="<?php echo $get_span_table['day_remark']; ?>">
															</div>
														</div>
													
													</div>
													<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Identification Mark</label>
															  <input type="text" class="form-control" id="cc_identification" name="cc_identification" placeholder="Identification Mark" Value="<?php echo $get_span_table['cc_identification_mark']; ?>">
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
													<hr style="border: 1px solid black;">
													<div class="col-md-5">
														<div class="box-body col-sm-6">
															<div class="form-group">
															  <label for="exampleInputEmail1">Shape</label>
															  <select class="form-control" id="shape" name="shape">
																<option value="i_shape" <?php if($get_span_table["paver_shape"]=="i_shape"){ echo "selected"; }?>>I - Shape</option>
																<option value="zigzag" <?php if($get_span_table["paver_shape"]=="zigzag"){ echo "selected"; }?>>Zigzag</option>
																<option value="damru" <?php if($get_span_table["paver_shape"]=="damru"){ echo "selected"; }?>>Damru</option>
																<option value="plain" <?php if($get_span_table["paver_shape"]=="plain"){ echo "selected"; }?>>Plain</option>
															   </select>
															  
															</div>
														</div>
													
														<div class="box-body col-sm-6">
															<div class="form-group">
															  <label for="exampleInputEmail1">Age</label>
															  <input type="text" class="form-control" id="age" name="age" placeholder="Age" Value="<?php echo $get_span_table['paver_age']; ?>">
															</div>
														</div>
													</div>
													<div class="col-md-5">
														<div class="box-body col-sm-6">
															<div class="form-group">
															  <label for="exampleInputEmail1">Color</label>
															  <input type="text" class="form-control" id="color" name="color" placeholder="Color" Value="<?php echo $get_span_table['paver_color']; ?>">
															</div>
														</div>
													
														<div class="box-body col-sm-6">
															<div class="form-group">
															  <label for="exampleInputEmail1">Thickness(mm)</label>
															  <select class="form-control" id="thickness" name="thickness">
																<option value="" <?php if($get_span_table["paver_thickness"]==""){ echo "selected"; }?>>Select Thickness</option>
																<option value="50" <?php if($get_span_table["paver_thickness"]=="50"){ echo "selected"; }?>>50</option>
																<option value="60" <?php if($get_span_table["paver_thickness"]=="60"){ echo "selected"; }?>>60</option>
																<option value="80" <?php if($get_span_table["paver_thickness"]=="80"){ echo "selected"; }?>>80</option>
																<option value="100" <?php if($get_span_table["paver_thickness"]=="100"){ echo "selected"; }?>>100</option>
																<option value="120" <?php if($get_span_table["paver_thickness"]=="120"){ echo "selected"; }?>>120</option>
																
															   </select>
															</div>
														</div>
													</div>
													<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Grade</label>
															  <select class="form-control" id="paver_grade" name="paver_grade">
																<option value="" <?php if($get_span_table["paver_grade"]==""){ echo "selected"; }?>>Select Grade</option>
																<option value="M-20" <?php if($get_span_table["paver_grade"]=="M-20"){ echo "selected"; }?>>M - 20</option>
																<option value="M-25" <?php if($get_span_table["paver_grade"]=="M-25"){ echo "selected"; }?>>M - 25</option>
																<option value="M-30" <?php if($get_span_table["paver_grade"]=="M-30"){ echo "selected"; }?>>M - 30</option>
																<option value="M-35" <?php if($get_span_table["paver_grade"]=="M-35"){ echo "selected"; }?>>M - 35</option>
																<option value="M-40" <?php if($get_span_table["paver_grade"]=="M-40"){ echo "selected"; }?>>M - 40</option>
																<option value="M-45" <?php if($get_span_table["paver_grade"]=="M-45"){ echo "selected"; }?>>M - 45</option>
																<option value="M-50" <?php if($get_span_table["paver_grade"]=="M-50"){ echo "selected"; }?>>M - 50</option>
																<option value="M-55" <?php if($get_span_table["paver_grade"]=="M-55"){ echo "selected"; }?>>M - 55</option>
																<option value="M-60" <?php if($get_span_table["paver_grade"]=="M-60"){ echo "selected"; }?>>M - 60</option>
																
																
															   </select>
															</div>
														</div>
													</div>
												</div>
												
												<div class="row material_class" id="SO">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Soil</b></h4>
												</div>
												<hr style="border: 1px solid black;">
												<div class="col-md-2">
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Sample Type</label>
																  <input type="text" class="form-control" id="sample_type" name="sample_type" placeholder="Sample Type" value="<?php echo $get_span_table['soil_location']; ?>">
																</div>
															</div>
														</div>
												<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Source</label>
															  <input type="text" class="form-control" id="soil_source" name="soil_source" placeholder="Soil Source" value="<?php echo $get_span_table['soil_location']; ?>">
															</div>
														</div>
												</div>
												</div>
												
												<div class="row  material_class" id="ST">
													
													<div class="col-md-12">
														<h4 style="text-align:center;"><b>Steel</b></h4>
													</div>
													<hr style="border: 1px solid black;">
													<div class="col-md-2">
															<label>Select Grade:</label>
															<select class="form-control" name="steel_grade" id="steel_grade">
														<option value="-">SELECT-GRADE</option>
														<option value="-">-</option>
														<option value="FE 415" <?php if($get_span_table["steel_grade"]=="FE 415"){ echo "selected"; }?>>Fe 415</option>
														<option value="FE 415 D" <?php if($get_span_table["steel_grade"]=="FE 415 D"){ echo "selected"; }?>>Fe 415D</option>
														<option value="FE 415 S" <?php if($get_span_table["steel_grade"]=="FE 415 S"){ echo "selected"; }?>>Fe 415S</option>
														<option value="FE 500" <?php if($get_span_table["steel_grade"]=="FE 500"){ echo "selected"; }?>>Fe 500</option>
														<option value="FE 500 D" <?php if($get_span_table["steel_grade"]=="FE 500 D"){ echo "selected"; }?>>Fe 500D</option>
														<option value="FE 500 S" <?php if($get_span_table["steel_grade"]=="FE 500 S"){ echo "selected"; }?>>Fe 500S</option>
														<option value="FE 550" <?php if($get_span_table["steel_grade"]=="FE 550"){ echo "selected"; }?>>Fe 550</option>
														<option value="FE 550 D" <?php if($get_span_table["steel_grade"]=="FE 550 D"){ echo "selected"; }?>>Fe 550D</option>
														<option value="FE 600" <?php if($get_span_table["steel_grade"]=="FE 600"){ echo "selected"; }?>>Fe 600</option>
														<option value="FE 650" <?php if($get_span_table["steel_grade"]=="FE 650"){ echo "selected"; }?>>Fe 650</option>
														<option value="FE 750" <?php if($get_span_table["steel_grade"]=="FE 750"){ echo "selected"; }?>>Fe 750</option>
														<option value="FE 415 CRS" <?php if($get_span_table["steel_grade"]=="FE 415 CRS"){ echo "selected"; }?>>Fe 415 CRS</option>
														<option value="FE 415 D CRS" <?php if($get_span_table["steel_grade"]=="FE 415 D CRS"){ echo "selected"; }?>>Fe 415D CRS</option>
														<option value="FE 415 S CRS" <?php if($get_span_table["steel_grade"]=="FE 415 S CRS"){ echo "selected"; }?>>Fe 415S CRS</option>
														<option value="FE 500 CRS" <?php if($get_span_table["steel_grade"]=="FE 500 CRS"){ echo "selected"; }?>>Fe 500 CRS</option>
														<option value="FE 500 D CRS" <?php if($get_span_table["steel_grade"]=="FE 500 D CRS"){ echo "selected"; }?>>Fe 500D CRS</option>
														<option value="FE 500 S CRS" <?php if($get_span_table["steel_grade"]=="FE 500 S CRS"){ echo "selected"; }?>>Fe 500S CRS</option>
														<option value="FE 550 CRS" <?php if($get_span_table["steel_grade"]=="FE 550 CRS"){ echo "selected"; }?>>Fe 550 CRS</option>
														<option value="FE 550 D CRS" <?php if($get_span_table["steel_grade"]=="FE 550 D CRS"){ echo "selected"; }?>>Fe 550D CRS</option>
														<option value="FE 600 CRS" <?php if($get_span_table["steel_grade"]=="FE 600 CRS"){ echo "selected"; }?>>Fe 600 CRS</option>
														<option value="FE 650 CRS" <?php if($get_span_table["steel_grade"]=="FE 650 CRS"){ echo "selected"; }?>>Fe 650 CRS</option>
														<option value="FE 750 CRS" <?php if($get_span_table["steel_grade"]=="FE 750 CRS"){ echo "selected"; }?>>Fe 750 CRS</option>
														
													</select>
												</div>
												<div class="col-md-8">
												<label>Enrter Name Of Source:</label>
												<input type="text" class="form-control" id="steel_source_name" name="steel_source_name" placeholder="Enter Name Of Source"  style="width:300px;" value="<?php echo $get_span_table['steel_source_name']; ?>">
												</div>
															<div class="box-body col-md-3" >
																<div class="form-group">
																	<label>Dia (mm)</label>
																	<input type="text" class="form-control" id="dia" name="dia" placeholder="Dia" value="<?php echo $get_span_table['steel_dia']; ?>">
																	
																</div>
															</div>
															<div class="box-body col-md-2">
																<div class="form-group">
																  <label for="exampleInputEmail1">Brand</label>
																  <input type="text" class="form-control" id="steel_brand" name="steel_brand" placeholder="Brand" value="<?php echo $get_span_table['steel_brand']; ?>">
																</div>
															</div>
															<div class="box-body col-md-2">
																<div class="form-group">
																  <label for="exampleInputEmail1">Mill Heat No</label>
																  <input type="text" class="form-control" id="steel_heat" name="steel_heat" placeholder="Heat" value="<?php echo $get_span_table['steel_heat']; ?>">
																</div>
															</div>
															<div class="box-body col-md-2">
														<div class="form-group">
														  <label for="exampleInputEmail1">Sample Quantity</label>
														  <input type="text" class="form-control steel_sample_qty" id="steel_sample_qty" name="steel_sample_qty" placeholder="Sample Quantity">
														</div>
													</div>
														
												
												</div>
												
												<div class="row  material_class" id="WA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Water</b></h4>
												</div>
												<hr style="border: 1px solid black;">
												<div class="box-body col-md-3">
																<div class="form-group">
																  <label for="exampleInputEmail1">Source</label>
																  <input type="text" class="form-control" id="tile_source" name="tile_source" placeholder="Source" value="<?php echo $get_span_table['water_source']; ?>">
																</div>
															</div>
												
												</div>
																						
												<div class="row  material_class" id="TI">
													
														<div class="col-md-12">
															<h4 style="text-align:center;"><b>Tiles</b></h4>
														</div>
													<hr style="border: 1px solid black;">	
														
														<div class="col-md-6">
															<div class="box-body">
																<div class="form-group">
																	<label>Specification</label>
																	<input type="text" class="form-control" id="tiles_specification" name="tiles_specification" placeholder="Specification" value="<?php echo $get_span_table['water_specification']; ?>">
																</div>
															</div>
														</div>
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Brand</label>
																  <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand" value="<?php echo $get_span_table['water_brand']; ?>">
																</div>
															</div>
														</div>
														
													
												</div>
												
												<div class="row  material_class" id="FI">
													
														<div class="col-md-12">
															<h4 style="text-align:center;"><b>Fine Aggregate</b></h4>
														</div>
													<hr style="border: 1px solid black;">	
														
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Fine Aggregate Source</label>
																  <input type="text" class="form-control" id="fine_agg_source" name="fine_agg_source" placeholder="Fine Aggregate Source" value="<?php echo $get_span_table['fine_aggregate_source']; ?>">
																</div>
															</div>
														</div>
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Fine Aggregate Type</label>
																  <input type="text" class="form-control" id="fine_agg_type" name="fine_agg_type" placeholder="Fine Aggregate Type" value="<?php echo $get_span_table['fine_agg_type']; ?>">
																</div>
															</div>
														</div>
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Zone</label>
																<select class="form-control grd_zone" id="grd_zone" name="grd_zone">
						<option value="Zone II" <?php if($get_span_table['grd_zone']=="Zone II"){ echo "selected";}?>>Zone II</option>
						<option value="Zone I" <?php if($get_span_table['grd_zone']=="Zone I"){ echo "selected";}?>>Zone I</option>
						<option value="Zone III" <?php if($get_span_table['grd_zone']=="Zone III"){ echo "selected";}?>>Zone III</option>
						<option value="Zone IV" <?php if($get_span_table['grd_zone']=="Zone IV"){ echo "selected";}?>>Zone IV</option>
																		</select>
																</div>
															</div>
														</div>
														
														
												</div>
												
												<div class="row  material_class" id="QU">
													
														<div class="col-md-12">
															<h4 style="text-align:center;"><b>Quarry Spall</b></h4>
														</div>
													<hr style="border: 1px solid black;">	
														
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Quarry Spall Source</label>
																  <input type="text" class="form-control" id="qa_spall_source" name="qa_spall_source" placeholder="Quarry Spall Source" value="<?php echo $get_span_table['quarry_spall_source']; ?>">
																</div>
															</div>
														</div>
														
														
												</div>
												
												
												<div class="row  material_class" id="FT">
													
														<div class="col-md-12">
															<h4 style="text-align:center;"><b>Field Test</b></h4>
														</div>
													<hr style="border: 1px solid black;">	
														
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Chainage No.</label>
																  <input type="text" class="form-control" id="chainage_no" name="chainage_no" placeholder="Enter Chainage No." value="<?php echo $get_span_table['chainage_no']; ?>">
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
													<hr style="border: 1px solid black;">	
														
														<div class="col-md-6">
															
															<div class="box-body">
																<div class="form-group">
																  <label for="exampleInputEmail1">Bitumin Specification</label>
																  
																  <select class="form-control" id="bitumin_mix" name="bitumin_mix">
																		<option value="BC-I" <?php if($get_span_table["bit_mix"]=="BC-I"){ echo "selected"; }?>>BC-I</option>
																		<option value="BC-II" <?php if($get_span_table["bit_mix"]=="BC-II"){ echo "selected"; }?>>BC-II</option>
																		<option value="DBM-I" <?php if($get_span_table["bit_mix"]=="DBM-I"){ echo "selected"; }?>>DBM-I</option>
																		<option value="DBM-II" <?php if($get_span_table["bit_mix"]=="DBM-II"){ echo "selected"; }?>>DBM-II</option>
																		<option value="SDBC-I" <?php if($get_span_table["bit_mix"]=="SDBC-I"){ echo "selected"; }?>>SDBC-I</option>
																		<option value="SDBC-II" <?php if($get_span_table["bit_mix"]=="SDBC-II"){ echo "selected"; }?>>SDBC-II</option>
																		
																	</select>
																</div>
															</div>
														</div>
														
														
												</div>
												
												
												<div class="row material_class" id="CL">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>CLC BLOCK</b></h4>
												</div>
												<hr style="border: 1px solid black;">
													<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Length</label>
															  <input type="text" class="form-control inl" id="inl" name="inl" value="<?php echo $get_span_table['inl']; ?>">
															</div>
														</div>
													</div>
													<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Width</label>
															  <input type="text" class="form-control inw" id="inw" name="inw" value="<?php echo $get_span_table['inw']; ?>">
															</div>
														</div>
													</div>
													<div class="col-md-2">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Height</label>
															  <input type="text" class="form-control inh" id="inh" name="inh" value="<?php echo $get_span_table['inh']; ?>">
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Grade</label>
															   <select class="form-control ingrade"  name="ingrade" id="ingrade">
																   <option value="--SELECT--" <?php if($get_span_table["ingrade"]=="--SELECT--"){ echo "selected"; }?>>--SELECT--</option>
																	<option value="G-2.5" <?php if($get_span_table["ingrade"]=="G-2.5"){ echo "selected"; }?>>G-2.5</option>
																	<option value="G-3.5" <?php if($get_span_table["ingrade"]=="G-3.5"){ echo "selected"; }?>>G-3.5</option>
																	<option value="G-6.5" <?php if($get_span_table["ingrade"]=="G-6.5"){ echo "selected"; }?>>G-6.5</option>
																	<option value="G-12" <?php if($get_span_table["ingrade"]=="G-12"){ echo "selected"; }?>>G-12</option>
																	<option value="G-17.5" <?php if($get_span_table["ingrade"]=="G-17.5"){ echo "selected"; }?>>G-17.5</option>
																	<option value="G-25" <?php if($get_span_table["ingrade"]=="G-25"){ echo "selected"; }?>>G-25</option>
																	
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="box-body">
															<div class="form-group">
															  <label for="exampleInputEmail1">Density</label>
																<input type="text" class="form-control inden" id="inden" name="inden" value="<?php echo $get_span_table['inden']; ?>">
															</div>
														</div>
													</div>
												
												</div>
												
												<div class="row material_class" id="testing">
													<div class="col-md-12">
														<h4 style="text-align:center;"><b>Excel Upload</b></h4>
													</div>
													<hr style="border: 1px solid black;">';
													<div class="col-md-6">
														<div class="form-group">
															  <label for="exampleInputEmail1">Description</label>
															  <input type="text" class="form-control excel_description" id="excel_description" name="excel_description"   placeholder="Description" value="<?php echo $get_span_table['excel_description']; ?>">
															</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															  <label for="exampleInputEmail1">Qty.</label>
															  <input type="text" class="form-control excel_qty" id="excel_qty" name="excel_qty"  placeholder="Qty" value="<?php echo $get_span_table['excel_qty']; ?>">
															</div>
													</div>
												</div>
												
												
												
												
											  
												<div class="row material_class" id="AC">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>AAC BLOCK</b></h4>
												</div>
												<hr style="border: 1px solid black;">
												<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Length</label>
										  <input type="text" class="form-control in_l" id="in_l" name="in_l" value="<?php echo $get_span_table['in_l']; ?>">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Width</label>
										  <input type="text" class="form-control in_w" id="in_w" name="in_w" value="<?php echo $get_span_table['in_w']; ?>">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Height</label>
										  <input type="text" class="form-control in_h" id="in_h" name="in_h" value="<?php echo $get_span_table['in_h']; ?>">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Density</label>
										   <select class="form-control in_den" id="in_den" name="in_den">
												<option value="451 to 550" <?php if($get_span_table["in_den"]=="451 to 550"){ echo "selected"; }?>>451 to 550</option>
												<option value="551 to 650" <?php if($get_span_table["in_den"]=="551 to 650"){ echo "selected"; }?>>551 to 650</option>
												<option value="651 to 750" <?php if($get_span_table["in_den"]=="651 to 750"){ echo "selected"; }?>>651 to 750</option>
												<option value="751 to 850" <?php if($get_span_table["in_den"]=="751 to 850"){ echo "selected"; }?>>751 to 850</option>
												<option value="851 to 1000" <?php if($get_span_table["in_den"]=="851 to 1000"){ echo "selected"; }?>>851 to 1000</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Grade</label>
										   <select class="form-control in_grade" id="in_grade" name="in_grade">
												<option value="grade 1" <?php if($get_span_table["in_grade"]=="grade 1"){ echo "selected"; }?>>grade 1</option>
												<option value="grade 2" <?php if($get_span_table["in_grade"]=="grade 2"){ echo "selected"; }?>>grade 2</option>
												
											</select>
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
									<div class="col-md-6">
									<div class="form-group">
											
											<div class="col-sm-12">
									<select class="form-control select2" name="select_samp_condition" id="select_samp_condition">
										<option value="">Select Conditon</option>
										<option value="1" <?php if($get_span_table["material_condition"]=="1"){ echo "selected"; }?>>Sealed</option>
										<option value="2" <?php if($get_span_table["material_condition"]=="2"){ echo "selected"; }?>>Unsealed</option>
										<option value="3" <?php if($get_span_table["material_condition"]=="3"){ echo "selected"; }?>>Good</option>
										<option value="4" <?php if($get_span_table["material_condition"]=="4"){ echo "selected"; }?>>Poor</option>
									</select>
									</div>
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
											
											<div class="col-sm-12">
									<select class="form-control select2" name="select_location" id="select_location">
										<option value="">Select Location</option>
										<option value="1" <?php if($get_span_table["material_location"]=="1"){ echo "selected"; }?>>In Laboratory</option>
										<option value="2" <?php if($get_span_table["material_location"]=="2"){ echo "selected"; }?>>On Site</option>
									</select>
									</div>
									</div>
									</div>
									
									
								</div>
				<br>
				<div class="row">
									<div class="col-md-6">
									<div class="form-group">
											
											<div class="col-sm-12">
									<select class="form-control select2" name="sample_note" id="sample_note">
										<option value="">Select Sample Note</option>
										<option value="The Samples have been Submitted to us by the Customer.|The above given Results Refer only to the sample submitted by the customer for testing."  <?php if($get_span_table["sample_note"]=="The Samples have been Submitted to us by the Customer.|The above given Results Refer only to the sample submitted by the customer for testing."){ echo "selected"; }?> >The Samples have been Submitted to us by the Customer.</option>
										<option value="The test has been conducted on samples collected from site.|The above given results refer only to the samples collected for testing."  <?php if($get_span_table["sample_note"]=="The test has been conducted on samples collected from site.|The above given results refer only to the samples collected for testing."){ echo "selected"; }?>>The test has been conducted on samples collected from site.</option>
									</select>
									</div>
									</div>
									</div>
									
									
								</div>
				<br>
				<div class="row">
								
								<div class="col-md-3">
										<div class="form-group">
											
											<div class="col-sm-12">
												<button type="button" class="btn btn-info"  onclick="addData('update_reports')" name="btn_add_data" id="btn_add_data" style="width:100%;font-size:20px;margin-left:180%;" >Update</button>
											</div>
										</div>
								</div>
								</div>
								<br>
						</div>
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>
	  	  
<script>
$(document).ready(function(){
var mt_prefix = "<?php echo $mt_prefix; ?>";
var filename = $('#filename').val();
	if(mt_prefix=="FX"){
		mt_prefix="CC";
	}
$(".material_class").hide();
var set_sample_id= "#"+mt_prefix;

	if(filename != 'testings.php'){
		$(set_sample_id).show();
	}else{
		$('#testing').show();
	}


});

$('.casting_date').datepicker({
	  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	
	
// add data
function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'update_reports') {
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var txt_report_no = $('#txt_report_no').val(); 
				var txt_lab_no = $('#txt_lab_no').val(); 
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
				var steel_source_name = $('#steel_source_name').val();
				var steel_heat = $('#steel_heat').val();
				var steel_sample_qty = $('#steel_sample_qty').val();
				var tile_source = $('#tile_source').val();
				var tiles_specification = $('#tiles_specification').val();
				var fine_agg_source = $('#fine_agg_source').val();
				var fine_agg_type = $('#fine_agg_type').val();
				var grd_zone = $('#grd_zone').val();
				var qa_spall_source = $('#qa_spall_source').val();
				var bitumin_mix = $('#bitumin_mix').val();
				var tiles_specification = $('#tiles_specification').val();
				var brand = $('#brand').val();
				var select_samp_condition = $('#select_samp_condition').val();
				var select_location = $('#select_location').val();
				var sample_note = $('#sample_note').val();
				var ingrade = $('#ingrade').val();
				var inden = $('#inden').val();
				var inw = $('#inw').val();
				var inh = $('#inh').val();
				var inl = $('#inl').val();
				var in_l = $('#in_l').val();
				var in_h = $('#in_h').val();
				var in_w = $('#in_w').val();
				var in_den = $('#in_den').val();
				var in_grade = $('#in_grade').val();
				
				var mt_prefix = $('#mt_prefix').val();
				var table_names = $('#table_names').val();
				var excel_description = $('#excel_description').val();
				var excel_qty = $('#excel_qty').val();
				
				//alert(txt_lab_no);
				
			
				if(txt_lab_no !=""){
					
				billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&txt_report_no='+txt_report_no+'&txt_lab_no='+txt_lab_no+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_no='+week_no+'&brick_source='+brick_source+'&mark='+mark+'&brick_specification='+brick_specification+'&tanker_no='+tanker_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&make='+make+'&cube_grade='+cube_grade+'&day_remark='+day_remark+'&casting_date='+casting_date+'&day='+day+'&set_of_cube='+set_of_cube+'&no_of_cube='+no_of_cube+'&shape='+shape+'&age='+age+'&color='+color+'&thickness='+thickness+'&paver_grade='+paver_grade+'&sample_type='+sample_type+'&soil_source='+soil_source+'&dia='+dia+'&steel_grade='+steel_grade+'&steel_brand='+steel_brand+'&tile_source'+tile_source+'&tiles_specification='+tiles_specification+'&brand='+brand+'&fine_agg_source='+fine_agg_source+'&qa_spall_source='+qa_spall_source+'&bitumin_mix='+bitumin_mix+'&cc_identification='+cc_identification+'&chainage_no='+chainage_no+'&fine_agg_type='+fine_agg_type+'&fdd_desc_sample='+fdd_desc_sample+'&select_samp_condition='+select_samp_condition+'&select_location='+select_location+'&mt_prefix='+mt_prefix+'&table_names='+table_names+'&sample_de='+sample_de+'&steel_source_name='+steel_source_name+'&steel_heat='+steel_heat+'&grd_zone='+grd_zone+'&steel_sample_qty='+steel_sample_qty+'&inl='+inl+'&inh='+inh+'&inw='+inw+'&inden='+inden+'&ingrade='+ingrade+'&in_l='+in_l+'&in_h='+in_w+'&in_w='+in_w+'&in_den='+in_den+'&in_grade='+in_grade+'&excel_description='+excel_description+'&excel_qty='+excel_qty+'&sample_note='+sample_note;
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
        url: '<?php $base_url; ?>save_edit_reports_by_qm.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(msg){
		document.getElementById("overlay_div").style.display="none";
          
		  $("#btn_add_data_save").css("display", "block");
		  alert("Report Succesfully Updates");
		  location.reload();
         }
    }); 
}
	







</script>
